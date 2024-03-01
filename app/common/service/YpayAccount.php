<?php
declare (strict_types = 1);

namespace app\common\service;
use think\facade\Session;
use think\facade\Cookie;
use think\facade\Db;
use think\App;
use think\facade\Request;
use app\common\model\YpayAccount as M;
use app\common\validate\YpayAccount as V;
use app\common\service\YpayUser as S;
use think\facade\Config;
use app\common\core\core;

class YpayAccount
{
    // 添加
    public static function goAdd($data)
    {
        $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
        $cloud_res = cloud_get_curl('http://cloud.yfxw.cn/API/Cloud/V6CheckAuth', ["Cloudkey"=>getConfig()['cloudkey'],"Host"=>$host]);

        if ($cloud_res != null){
            if($cloud_res->code!=1)
            {
                exit($cloud_res->msg);
            }
        }
        //创建Core对象
       // $core  = new Core();
        $user = Db::table('ypay_user')->where('id',Session::get('front.id'))->find();

//        if(empty($user['vip_time'])){
//            return ['msg'=>"未开通套餐或套餐已过期",'code'=>201];
//        }
//        $time = strtotime($user['vip_time']);
//        if($time<time())
//        {
//            return ['msg'=>"未开通套餐或套餐已过期",'code'=>201];
//        }
//        $vip = Db::table('ypay_vip')->where('id',$user['vip_id'])->find();
//        //判断是否开启了通道绑定功能
//        if(!empty($vip['is_passage'])){
//            if($vip['is_passage'] && !strpos($vip['passage'],$data['code'])){
//                return ['msg'=>"该通道需要开启更高级的套餐才能使用",'code'=>201];
//            }
//        }
        $data['user_id'] = Session::get('front.id');
        $channel = Db::table('admin_channel')->where('code',$data['code'])->find();
        $data['type'] = $channel['type'];
        $data['succcount'] = 0;
        $data['succprice'] = 0;

        //验证
        $validate = new V;
        if(!$validate->scene('add')->check($data))
        return ['msg'=>$validate->getError(),'code'=>201];

        if(empty($channel))
        {
            return ['msg'=>"通道不存在或标识重复",'code'=>201];
        }
        if($data['type']=="wxpay" && $data['code']!="wxpay_dy" && $data['code']!="wxpay_app" && $data['code']!="wxpay_zg")
        {
            if($data['code']=='wxpay_ipad')
            {
                $res = Weipad::WXCreate(0);
                $data['wx_guid'] = $res->data->Guid;
                if($data['diyu']!=0)
                {
                    $daili= Db::table('ypay_proxy')->where('id',$data['diyu'])->find();
                    $res = Weipad::WXSetProxy($daili['address'],$daili['prot'],$daili['user'],$daili['pass'],$data['wx_guid']);
                }
            }
            else
            {
                //获取地域类型
                $region_type = getConfig()['region_type'];
                //创建GUID
                switch ($region_type) {
                    case 1:
                        $daili= Db::table('ypay_proxy')->where('id',$data['diyu'])->find();
                        if(empty($daili)){
                            $res = $core->WXCreate(0,$data['diyu']);
                            $data['vcloudurl'] = $data['diyu'];
                        }else{
                            $data = array('vcloudurl'=>getConfig()['vcloudurl'],'isdaili'=>1,'address'=>$daili['address'],'prot'=>$daili['prot'],'user'=>$daili['user'],'pass'=>$daili['pass']);
                            $res = $core->WXCreate($region_type,$data);
                            $data['vcloudurl'] = getConfig()['vcloudurl'];
                        }
                        break;
                    case 2:
                        $daili= Db::table('ypay_cloud')->where('id',$data['diyu'])->find();
                        if(empty($daili)){
                            $res = $core->WXCreate(0,$data['diyu']);
                            $data['vcloudurl'] = $data['diyu'];
                        }else{
                            $res = $core->WXCreate($region_type,$daili['address']);
                            $data['vcloudurl'] = $daili['address'];
                        }
                        
                        break;
                    default:
                        $res = $core->WXCreate($region_type,$data['diyu']);
                        $data['vcloudurl'] = $data['diyu'];
                        break;
                }
                if(empty($res))
                {
                    return ['msg'=>"云端连接失败或出现错误",'code'=>201];
                }
                if($res->code==0)
                {
                    return ['msg'=>$res->msg,'code'=>201];
                }
                $data['wx_guid'] = $res->msg;
            }
            
        }
        else
        {
            if($data['code']=="wxpay_dy")
            {
                if(empty($data['wxname']))
                {
                    return ['msg'=>"收款微信昵称不可为空",'code'=>201];
                }
                $verywx = M::where('wxname',$data['wxname'])->find();
                if(!empty($verywx))
                {
                    return ['msg'=>"收款微信昵称已存在,请检查",'code'=>201];
                }
                $data['status'] = 1;
            }
        }
        if($data['code']=='alipay_app' || $data['code']=='wxpay_app' || $data['code']=='wxpay_zg' )
        {
            $data['status'] = 1;
        }
        if(!empty($data['aliappkey'])){
            $data['qr_url'] = $data['aliappkey'];
        }
        if($data['code']=='alipay_dmf')
        {
            //检查是否存在
            $data['status'] = 1;
        }
        try {
            
            if(!empty($data['remark'])){
                $data['remark'] = strip_tags($data['remark']);
            }
            M::create($data);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }
    
    // 编辑
    public static function goEdit($data,$id)
    {
        //获取通道ID
        $new_data['id'] = $id;
        //获取更改后的微信昵称
        $new_data['wxname'] = $data['wxname'];
        //验证
        // $validate = new V;
        // if(!$validate->scene('edit')->check($data))
        // return ['msg'=>$validate->getError(),'code'=>201];
        try {
             M::update($new_data);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }

    // 状态
    public static function goStatus($data,$id)
    {
        $model =  M::find($id);
        if ($model->isEmpty())  return ['msg'=>'数据不存在','code'=>201];
        try{
            $model->save([
                'status' => $data,
            ]);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }
    
    public static function goIsStatus($data,$id)
    {
        $model =  M::find($id);
        if ($model->isEmpty())  return ['msg'=>'数据不存在','code'=>201];
        try{
            $model->save([
                'is_status' => $data,
            ]);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }

    // 删除
    public static function goRemove($id)
    {
        $model = M::find($id);
        if ($model->isEmpty()) return ['msg'=>'数据不存在','code'=>201];
        try{
           $model->delete();
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }

    // 批量删除
    public static function goBatchRemove($ids)
    {
        if (!is_array($ids)) return ['msg'=>'数据不存在','code'=>201];
        try{
            M::destroy($ids);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }
    
    // 一键清理所有离线通道
    public static function goAllRemove()
    {
        try{
            
            M::destroy(function($query){
                $query->where('status','=',0);
            },true);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }

    
    // 获取列表
    public static function goRecycle()
    {
        if (Request::isPost()){
            $ids = Request::param('ids');
            if (!is_array($ids)) return ['msg'=>'参数错误','code'=>'201'];
            try{
                if(Request::param('type')){
                    $data = M::onlyTrashed()->whereIn('id', $ids)->select();
                    foreach($data as $k){
                        $k->restore();
                    }
                }else{
                    M::destroy($ids,true);
                }
            }catch (\Exception $e){
                return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
            }
            return ['msg'=>'操作成功'];
        }
        //按用户名
        $where = [];
        $limit = input('get.limit');
        
               //按通道标识查找
               if ($code = input("code")) {
                   $where[] = ["code", "like", "%" . $code . "%"];
               }
               //按通道类型查找
               if ($type = input("type")) {
                   $where[] = ["type", "like", "%" . $type . "%"];
               }
               //按会员ID查找
               if ($user_id = input("user_id")) {
                   $where[] = ["user_id", "like", "%" . $user_id . "%"];
               }
               //按微信昵称查找
               if ($wxname = input("wxname")) {
                   $where[] = ["wxname", "like", "%" . $wxname . "%"];
               }
               //按状态查找
               if ($status = input("status")) {
                   $where[] = ["status", "like", "%" . $status . "%"];
               }
               //按是否启用查找
               if ($is_status = input("is_status")) {
                   $where[] = ["is_status", "like", "%" . $is_status . "%"];
               }
        $list = M::onlyTrashed()->where($where)->paginate($limit);
        return ['code'=>0,'data'=>$list->items(),'extend'=>['count' => $list->total(), 'limit' => $limit]];
    }
    
    //获取二维码信息
    public static function GetQrlistQrcode($id)
    {
        //创建Core对象
        $core  = new Core();
        $acc = Db::table('ypay_account')->where('id', $id)->where('user_id',S::getUserId())->find();
        if(empty($acc))
        {
            return ['code'=>0,'msg'=>'通道不存在!'];
        }
        if($acc['type']=="alipay")
        {
            //获取支付宝登录二维码
            $data = $core->GetAlipayLoginQrcode();
            Db::name('ypay_account')->where('id', $id)->update(['remark' => $data['loginid']]);
            return ['code'=>1,'msg'=>'获取成功!','qr'=>'/qrcode.php?text='.$data['qrcodeurl'],'loginid'=>$data['loginid']];
        }
        if($acc['type']=="wxpay" && $acc['code']!="wxpay_dy")
        {
            if($acc['code']=="wxpay_ipad")
            {
                $res = Weipad::wxGetLoginQrcode($acc['wx_guid'],1);
                Db::name('ypay_account')->where('id', $id)->update(['remark' =>$res->data->uuid]);
                return ['code'=>1,'msg'=>'获取成功!','uuid'=>$res->data->uuid,'qr_url'=>$res->data->qrcode,'guid'=>$acc['wx_guid']];
            }
            else
            {
                $res = $core->wxGetLoginQrcode($acc['vcloudurl'],$acc['wx_guid'],1);
                    if(empty($res))
                    {
                        $new_res = $core->WXCreate(2,$acc['vcloudurl']);

                        if(empty($new_res))
                        {
                            return ['code'=>0,'msg'=>'云端连接失败，请检查云端地址配置!'];
                        }
                        if($new_res->code==0)
                        {
                            return ['msg'=>$new_res->msg,'code'=>201];
                        }
                        Db::name('ypay_account')->where('id', $id)->update(['wx_guid'=>$new_res->msg]);
                        $res = $core->wxGetLoginQrcode($new_res->msg,1);
                    }
                    
                if($res->flag!=1)
                {
                    return ['code'=>0,'msg'=>'服务返回错误!'];
                }
                Db::name('ypay_account')->where('id', $id)->update(['remark' =>$res->data->uuid]);
                return ['code'=>1,'msg'=>'获取成功!','uuid'=>$res->data->uuid,'qr_url'=>$res->data->qrcode,'guid'=>$acc['wx_guid']];
            }
        }
        if($acc['code']=="qqpay_mg")
        {
            $res = $core->QCreate();
            if($res['code']==1)
            {
                Db::name('ypay_account')->where('id', $id)->update(['remark' => $res['qrsig']]);
            }
            return $res;
        }
        
        return ['code'=>0,'msg'=>'系统错误!'];
    }
    
    //获取扫码状态
    public static function GetChannelLoginStatus($id='')
    {
        //创建Core对象
        $core  = new Core();
        
        $acc = Db::table('ypay_account')->where('id',$id)->where('user_id', S::getUserId())->find();
        if(empty($acc))
        {
            return ['code'=>0,'msg'=>'通道不存在!'];
        }
        if($acc['type']=="alipay")
        {
            $data = $core->GetAlipayLoginStatus($acc['remark']);
            if($data['code']==1)
            {
                $pid = getSubstr(base64_decode($data['cookie']),"CLUB_ALIPAY_COM=",";");
                try{
                    $cloud_res = cloud_get_curl('http://cloud.yfxw.cn/API/Cloud/CheckAuthBack', ["type"=>'alipay',"code"=>$pid]);
                    if(!empty($cloud_res->code))
                    {
                        if($cloud_res->code!=1)
                        {
                            S::logout();
                            return ['code'=>$cloud_res->code,'msg'=>'账号登录失败!','nick'=>"此PID已拉黑，IP以及账号信息已记录"];
                        }
                    }
                }catch (Exception $exception){
                    
                }
                Db::name('ypay_account')->where('id', $id)->update(['cookie' => $data['cookie'],'status'=>1,'zfb_pid'=>$pid]);
                return ['code'=>1,'msg'=>'账号登录成功!','nick'=>"用户PID为：".$pid];
            }
            else
            {
                return $data;
            }
        }
        if($acc['type']=="wxpay" && $acc['code']!="wxpay_dy")
        {
            $res = $core->wxCheckLoginQrcode($acc['vcloudurl'],$acc['wx_guid'],$acc['remark']);
            if($res->data->state==0)
            {
                return ['code'=>0,'msg'=>'等待扫码中!'];
            }
            else if($res->data->state==1)
            {
                return ['code'=>0,'msg'=>'已扫码待确认!'];
            }
            else
            {
                $res = $core->WXLoginManual($acc['vcloudurl'],$acc['wx_guid'],$res->data->wxid,$res->data->wxnewpass);
                Db::name('ypay_account')->where('id', $id)->update(['status' =>1]);
            }
            return ['code'=>1,'msg'=>'账号登录成功!','nick'=>"登录成功,点击更新按钮即可!"];
        }
        
        if($acc['code']=="qqpay_mg")
        {
            $data = $core->GetQLoginStatus($acc['remark']);
            if($data['code']==1)
            {
                Db::name('ypay_account')->where('id', $id)->update(['cookie' => $data['cookie'],'status'=>1,'remark'=>'']);
                return ['code'=>1,'msg'=>'账号登录成功!','nick'=>"登录QQ为：".$acc['qq']];
            }
            else
            {
                return $data;
            }
        }
        return ['code'=>0,'msg'=>'系统错误!'];
    }
}
