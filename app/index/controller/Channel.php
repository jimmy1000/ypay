<?php
declare (strict_types = 1);

namespace app\index\controller;
use think\facade\Session;
use think\facade\Request;
use think\facade\View;
use app\common\util\Upload as Up;
use app\common\service\YpayUser as S;
use think\facade\Db;
use app\common\model\YpayOrder;
use app\common\model\YpayAccount as Yaccount ;
use app\common\service\YpayAccount;
use app\common\core\core;

class Channel extends \app\BaseController
{
    protected $middleware = ['FrontCheck','FrontAuth'];
    
    
    public function upload()
    {

        $res = Up::qrputFile(Request::file(),Request::post('path'));
        return $this->getJson($res);
    }
    
    //通道列表
    public function index()
    {

        $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
        $cloud_res = cloud_get_curl('http://cloud.yfxw.cn/API/Cloud/V6CheckAuth', ["Cloudkey"=>getConfig()['cloudkey'],"Host"=>$host]);
        if ($cloud_res != null){
             if($cloud_res->code!=1)
                 {
                 exit($cloud_res->msg);
               }
        }

        if (Request::isAjax()) {
            return $this->getJson(Yaccount::getUserList(S::getUserId()));
        }
        $channel = Db::table('admin_channel')->where(['status'=>1,'type'=>'wxpay'])->order('sort', 'desc')->select();
        
        // 获取云端地址
        $vCloud = empty(getConfig()['vcloudurl']) ? 0:getConfig()['vcloudurl'];
        switch (getConfig()['region_type']) {
            case 0:
                $xy=['items' =>array('id'=>$vCloud,'name'=>getConfig()['vcloudname'])];
                break;
            case 1:
                $xy[0] = array('id'=>$vCloud,'name'=>getConfig()['vcloudname']);
                $proxy = Db::table('ypay_proxy')->order('sort','asc')->where('status', 1)->select();
                $i = 1;
                foreach ($proxy as $key){
                    $xy[$i] = $key;
                    $i++;
                }
                break;
            default:
                $xy[0] = array('id'=>$vCloud,'name'=>getConfig()['vcloudname']);
                $cloud = Db::table('ypay_cloud')->order('sort','asc')->where('status', 1)->select();
                $i = 1;
                foreach ($cloud as $key){
                    $xy[$i] = $key;
                    $i++;
                }
                break;
        }
        View::assign('xy', $xy);
        View::assign('channel', $channel);
        View::assign('user', S::getUser());
        return $this->fetch();
    }
    
    //通道配置
    public function basic()
    {
        if (Request::isAjax()) {
            return $this->getJson(S::goEdit(Request::param('','','strip_tags'),S::getUserId()));
        }
        View::assign('user', S::getUser());
        return $this->fetch();
    }
    
    public function zhuanjie()
    {
        if (Request::isAjax()) {
            return $this->getJson(S::goEdit(Request::param('','','strip_tags'),S::getUserId()));
        }
        View::assign('user', S::getUser());
        return $this->fetch();
    }
    
    public function type()
    {
        $data = Request::param();
        $channel = Db::table('admin_channel')->where(['status'=>1,'type'=>$data['id']])->order('sort', 'desc')->select();
        return json(['code'=>1,'channel'=>$channel]);
    }
    
    public function addchannel()
    {
        // 定义解码API接口数组
        $api = array(
            ['id'=>1,'api'=>'https://cli.im/Api/Browser/deqr?data='],
            ['id'=>2,'api'=>'https://api.uomg.com/api/qr.encode?url='],
            ['id'=>3,'api'=>'https://tenapi.cn/jxqr/?url='],
            ['id'=>4,'api'=>'https://www.devtool.top/api/qrcode/decode/remote?url='],
        );
        $data = Request::param('','','strip_tags');

        if($data['code']=='wxpay_dy' || $data['code']=='wxpay_zg' || $data['code']=='wxpay_app')
        {
            if(strpos($data['qr_url'],'upload') !== false)
            {
                //下面写解码的代码
                $request = \think\facade\Request::instance();
//                $erweima = $request->root(true).$data['qr_url'];//二维码的网络地址
                $erweima ="https://testpay.lao6sp.com/httptestpay.com.png";//二维码的网络地址
                // 循环API接口数组分别解析获取数据
                foreach ($api as $key => $value){
                    $ret = get_curl($value['api'].$erweima);
                    $ret = json_decode($ret,true);
                    if(!empty($ret['data']['RawData']) && $value['id'] == 1){
                        $qr_url = $ret['data']['RawData'];
                        break;
                    }elseif(!empty($ret['qrurl']) && $value['id'] == 2){
                        $qr_url = $ret['qrurl'];
                        break;
                    }elseif(!empty($ret['data']['qrtext']) && $value['id'] == 3){
                        $qr_url = $ret['data']['qrtext'];
                        break;
                    }elseif(!empty($ret['data']['text']) && $value['id'] == 4){
                        $qr_url = $ret['data']['text'];
                        break;
                    }else{
                        continue;
                    }
                }
                if(!empty($qr_url))
                {
                    if (file_exists(app()->getRootPath().'public'.$data['qr_url'])) unlink(app()->getRootPath().'public'.$data['qr_url']);//删除本地文件
                    Db::table('admin_photo')->where('href',$data['qr_url'])->delete();
                    $data['qr_url'] = $qr_url;
                }
                else
                {
                    if (file_exists(app()->getRootPath().'public'.$data['qr_url'])) unlink(app()->getRootPath().'public'.$data['qr_url']);//删除本地文件
                    Db::table('admin_photo')->where('href',$data['qr_url'])->delete();
                    return json(['code'=>0,'msg'=>'二维码解码失败,请手动解码输入']);
                }
            }
        }
        return $this->getJson(YpayAccount::goAdd($data));
    }
    
    //获取二维码信息
    public function GetQrlistQrcode($id)
    {
        return json(YpayAccount::GetQrlistQrcode($id));
    }
    
    
    
    //获取扫码状态
    public function GetChannelLoginStatus($id='')
    {
        return json(YpayAccount::GetChannelLoginStatus($id));
    }
    
    //删除通道
    public function DelChannel($id='')
    {
        //查询通道，如果是云端QQ执行删除操作
        $account =  Db::table('ypay_account')->where('id',$id)->find();
        if($account['code']=='qqpay_cloud')
        {
            //执行删除
            $core  = new Core();
            $core->Api_DelQQ($account['qq']);
        }
        Db::table('ypay_account')->where('id',$id)->where('user_id',S::getUserId())->delete();
        return json(['code'=>1,'msg'=>'删除成功!']);
    }
    
    //更改收款状态
    public function SaveStatus($id='',$status='')
    {
        $a = Db::table('ypay_account')->where('id',$id)->where('user_id',S::getUserId())->find();
        if(empty($a))
        {
            return json(['code'=>0,'msg'=>'通道不存在!']);
        }
        YpayAccount::goIsStatus($status,$id);
        return json(['code'=>1,'msg'=>'操作成功!']);
    }
    
    //QQ软件通道获取二维码
    public function CreatQrCodeInfo($id='')
    {
        $a = Db::table('ypay_account')->where('id',$id)->where('user_id',S::getUserId())->find();
        if(empty($a))
        {
            return json(['code'=>0,'msg'=>'通道不存在!']);
        }
        $core  = new Core();
        $res = $core->Api_CreatQrCodeInfo();
        if(empty($res))
        {
            return json(['code'=>0,'msg'=>'QQ云端外网连接失败!']);
        }
        return json(['code'=>1,'qrid'=>$res['qr_id'],'qrfile'=>$res['qrurl']]);
    }
    
    //QQ软件通道扫码状态
    public function GetQrCodeStatus($id='',$QrId='')
    {
        $a = Db::table('ypay_account')->where('id',$id)->where('user_id',S::getUserId())->find();
        if(empty($a))
        {
            return json(['code'=>0,'msg'=>'通道不存在!']);
        }
        $core  = new Core();
        $res = $core->Api_GetQrCodeStatus($QrId);
        if(empty($res))
        {
            return json(['code'=>0,'msg'=>'QQ云端外网连接失败!']);
        }
        if($res==1)
        {
            return json(['code'=>0,'msg'=>'确认成功，正在登陆，请稍候...']);
        }
        if($res==2)
        {
            Db::name('ypay_account')->where('id', $id)->update(['status' =>1]);
            return json(['code'=>1,'msg'=>'登录成功']);
        }
        if($res==3)
        {
            return json(['code'=>0,'msg'=>'扫描成功，请在手机上点击确认...']);
        }
        if($res==4)
        {
            return json(['code'=>0,'msg'=>'二维码失效，请重新申请...']);
        }
        if($res==5)
        {
            return json(['code'=>0,'msg'=>'还未申请二维码...']);
        }
        return json(['code'=>0,'msg'=>'等待扫码中...']);
    }
    
    //检查当前账号状态
    public function VeryQQStatus($id='',$qq='')
    {
        $a = Db::table('ypay_account')->where('id',$id)->where('user_id',S::getUserId())->find();
        if(empty($a))
        {
            return json(['code'=>0,'msg'=>'通道不存在!']);
        }
        $res = $core->Api_GetOnlineQQlist();
        if(strpos($res,$qq) !== false)
        {
            if($a['status']==1)
            {
                return json(['code'=>0,'msg'=>'该QQ已登录，无需进行操作!']);
            }
            else
            {
                Db::name('ypay_account')->where('id', $id)->update(['status' =>1]);
                return json(['code'=>0,'msg'=>'登录成功，无需进行后续操作!']);
            }
        }
        $core  = new Core();
        $is_status = $core->Api_GetOffLineList();
        if(strpos($is_status,$qq) !== false)
        {
            return json(['code'=>2,'msg'=>'存在!']);
        }
        return json(['code'=>1,'msg'=>'不存在!']);
    }
    
    //密码登录
    public function VeryQQPwd($id='',$qq='',$pass='')
    {
        $core  = new Core();
        $a = Db::table('ypay_account')->where('id',$id)->where('user_id',S::getUserId())->find();
        if(empty($a))
        {
            return json(['code'=>0,'msg'=>'通道不存在!']);
        }
        $res = $core->Api_GetOnlineQQlist();
        if(strpos($res,$qq) !== false)
        {
            return json(['code'=>0,'msg'=>'该QQ已登录,无需进行操作!']);
        }
        $is_status = $core->Api_GetOffLineList();
        if(strpos($is_status,$qq) !== false)
        {
            $core->Api_DelQQ($qq);
        }
        $core->Api_AddQQ($qq,$pass);
        $core->Api_Login($qq);
        $qres = $core->Api_GetOnlineQQlist();
        if(strpos($qres,$qq) !== false)
        {
            Db::name('ypay_account')->where('id', $id)->update(['status' =>1]);
            return json(['code'=>1,'msg'=>'登录成功，无需进行后续操作!']);
        }
        else
        {
            return json(['code'=>0,'msg'=>'登录失败，出现滑块或密码错误!']);
        }
    }
    

    
    
}
