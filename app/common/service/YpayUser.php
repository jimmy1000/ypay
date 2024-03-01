<?php
declare (strict_types = 1);

namespace app\common\service;
use think\facade\Session;
use think\facade\Cookie;
use think\facade\Request;
use think\facade\Db;
use app\common\model\YpayUser as M;
use app\common\validate\YpayUser as V;
use app\common\model\YpayVip;
use think\facade\Config;
use app\common\util\TenCloudSms;
use app\common\util\AliSms;
use app\common\util\SmsBao;
use app\common\util\Mail;
use app\common\model\AdminFrontLog as Log;
use app\common\model\YpayRegorder as Regorder;

class YpayUser
{
    // 添加
    public static function goAdd($data)
    {
        //验证
        $validate = new V;
        if(!$validate->scene('add')->check($data))
        return ['msg'=>$validate->getError(),'code'=>201];
        try {
            M::create($data);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }
     // 编辑
    public static function goEdit($data,$id)
    {
        $data['id'] = $id;
        //验证
        $validate = new V;
        if(!$validate->scene('edit')->check($data))
        return ['msg'=>$validate->getError(),'code'=>201];
        try {
             M::update($data);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }
    /*
     * 后台相关操作方法
     */
    
    // 添加用户
    public static function goUserAdd($data)
    {
        //验证
        $validate = new V;
        if(!$validate->scene('add')->check($data))
        return ['msg'=>$validate->getError(),'code'=>201];
        $data['password'] = set_password(trim($data['password']));
        if($data['vip_id'] != 0){
            $vip = YpayVip::where(['id'=>$data['vip_id']])->find();
            $data['vip_time'] = date("Y-m-d H:i:s",strtotime("+ ".$vip['viptime']." day"));
            $data['feilv'] = $vip['feilv'];
        }else{
            $data['vip_time'] =null; 
        }
        try {
            M::create($data);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }
    
    // 编辑用户信息
    public static function goUserEdit($data,$id)
    {
        $data['id'] = $id;
        //验证
        $validate = new V;
        if(!$validate->scene('edit')->check($data))
        return ['msg'=>$validate->getError(),'code'=>201];
        if(!empty($data['password']) && $data['password']!="")
        {
            $data['password'] = set_password(trim($data['password']));
        }
        else
        {
            $yuser = M::find($id);
            $data['password'] = $yuser['password'];
        }
        if($data['vip_id'] != 0){
            $vip = YpayVip::where(['id'=>$data['vip_id']])->find();
            $data['vip_time'] = empty($data['vip_time']) ? date("Y-m-d H:i:s",strtotime("+ ".$vip['viptime']." day")):$data['vip_time'];
            $data['feilv'] = empty($data['feilv']) ? $vip['feilv']:$data['feilv'];
        }else{
            $data['feilv'] =null; 
            $data['vip_time'] =null; 
        }

        try {
             M::update($data);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }
    
    // 冻结/解冻账户
     public static function goFrozenStatus($data,$id)
    {
        //查询是否有此用户
        $model =  M::find($id);
        if ($model->isEmpty())  return ['msg'=>'数据不存在','code'=>201];
        try{
            $model->save([
                'is_frozen' => $data,
            ]);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }

    // 根据ID删除用户
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

    // 批量删除用户
    public static function goBatchRemove($ids)
    {
        if (!is_array($ids)) return ['msg'=>'数据不存在','code'=>201];
        try{
            M::destroy($ids);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }
    
    /*
     * 前台相关操作方法
     */
    
    // 用户登录
    public static function login(array $data)
    {
        // getConfig()['captcha-type'] 获取验证码类型 Tips: 0:关闭验证码/1:普通验证码/2:腾讯防水墙
        // getConfig()['logincode-type'] 获取登录方式类型 Tips: 0:用户名+密码登录/1:手机号登录/2:邮箱登录
        $captcha_type = getConfig()['captcha-type'];
        $logincode_type = getConfig()['logincode-type'];
        $validate = new V;
        $user = null;
         //调用验证方法数据方法/传入验证码类型和验证码参数
        $ordinary_captcha = empty($data['ordinary_captcha']) ? "":$data['ordinary_captcha'];
        //获取验证验证码信息
        $is_captcha = self::is_captcha($captcha_type,$ordinary_captcha);
        //判断是否有值返回
        if(!empty($is_captcha)){
           return  $is_captcha;
        }
        // 判断登录类型切获取用户数据
        switch ($logincode_type) {
            case 0:
                //验证数据是否填写
                if(!$validate->scene('login')->check($data))return ['msg'=>$validate->getError(),'code'=>201];
                //验证是否存在此用户
                $user = M::where([
                    'username' => trim($data['username']),
                    'password' => set_password(trim($data['password']))
                ])->find();
                break;
            case 1:
                //验证数据是否填写
                if(!$validate->scene('mobile')->check($data))return ['msg'=>$validate->getError(),'code'=>201];
                $code = Session::get('ecode');
                if($data['captcha']==$code)//验证通过
                {
                    $user = M::where([
                    'mobile' => trim($data['mobile'])
                    ])->find();
                }else
                {
                    return ['msg'=>'验证码错误','code'=>201];
                }
                break;
                
            default:
                //验证数据是否填写
                if(!$validate->scene('email')->check($data))return ['msg'=>$validate->getError(),'code'=>201];
                $code = Session::get('ecode');
                if($data['captcha']==$code)//验证通过
                {
                    $user = M::where([
                    'email' => trim($data['email'])
                    ])->find();
                }
                else
                {
                    return ['msg'=>'验证码错误','code'=>201];
                }
                break;
        }
        
        //判断账户密码是否正确
        if(!$user){return ['msg'=>'用户名/密码错误','code'=>201];} 
        
        //判断该账户是否被冻结
        if($user['is_frozen']) return ['msg'=>'账号已被冻结,具体原因咨询站长','code'=>201];

        //调用清除缓存方法
        self::clear_captcha_session();
        $user->token = rand_string().$user->id.microtime(true);
        $user->save();
        //是否记住密码
        $time = 3600;
        if (isset($data['remember'])) $time = 30 * 86400;
        //缓存登录信息
        $info = [
            'id' => $user->id,
            'token' => $user->token
        ];
        Session::set('front', $info);
        Cookie::set('front_token',$user->token, $time);
        //记录登录日志
        $info = [
           'uid'       => $user->id,
           'url'      => Request::url(),
           'desc'    => '商户登录成功', 
           'ip'       => Request::ip(),
           'user_agent'=> Request::server('HTTP_USER_AGENT')
        ];
        Log::create($info);
        
        //开启了登录提醒
        if($user->login_email_tips)
        {
            Mail::go($user->email,'平台登录成功','你好,您的账号ID：'.$user->id.'已登录成功');
        }
        return ['msg'=>'登录成功','code'=>200];
    }
    
    // 用户注册
    public static function register($data)
    {
        return self::reg_or_bind('reg',$data);
     
    }
    
    // 快捷登录绑定信息
    public static function bind($data)
    {
         return self::reg_or_bind('bind',$data);

    }
    
    // 找回密码
    public static function golostpwd()
     {
        // getConfig()['captcha-type'] 获取验证码类型 Tips: 0:关闭验证码/1:普通验证码/2:腾讯防水墙
        // getConfig()['retrieve-type'] 获取找回方式类型 Tips: 0:关闭/1:手机号找回/2:邮箱找回
        $captcha_type = getConfig()['captcha-type'];
        $retrieve_type = getConfig()['retrieve-type'];
        $code = Session::get('ecode'); // 获取验证码信息
        $data = Request::post(); // 获取传递参数
        
        // 验证
        $validate = new V;
        
        //判断验证码是否正确
        if($retrieve_type != 0)
        {
            if($retrieve_type == 1){
                $where = ['mobile'=>$data['mobile']];
                if(!$validate->scene('mobile')->check($data))return ['msg'=>$validate->getError(),'code'=>201];
            }else{
                $where = ['email'=>$data['email']];
                if(!$validate->scene('email')->check($data))return ['msg'=>$validate->getError(),'code'=>201];
            }
        }
         //调用验证方法数据方法/传入验证码类型和验证码参数
        $ordinary_captcha = empty($data['ordinary_captcha']) ? "":$data['ordinary_captcha'];
        //获取验证验证码信息
        $is_captcha = self::is_captcha($captcha_type,$ordinary_captcha);
        //判断是否有值返回
        if(!empty($is_captcha)){
           return  $is_captcha;
        }
        //调用清除验证码缓存方法
        self::clear_captcha_session();
        
        //判断验证码正确就找回
        if($data['captcha'] == $code)
        {
            M::where($where)->update(['password' => set_password('123456')]);
            return ['msg'=>'密码找回成功','code'=>200];
        }else{
            return ['msg'=>'验证码错误!','code'=>201];
        }
        
     }
    
    // 判断是否登录
    public static function isLogin()
    {
        if(Cookie::has('front_token')){
            $user = M::where(['token'=>Cookie::get('front_token'),'is_frozen'=>0])->find();
            if(!$user) return false;
            Session::set('front',[
                'id' => $user->id,
                'token' => $user->token,
            ]); 
            return true;
        }
        return false;
    }
    
    //验证是否为保护模式
    public static function isAuth()
    {
        if(Session::get('front_auth')) return true;
        $user = M::where(['token'=>Cookie::get('front_token'),'is_frozen'=>0])->find();
        if(empty($user['googlekey']))
        {
            return true;
        }
        return false;
    }
    
    //获取用户ID
    public static function getUserId()
    {
        
        $user = M::where(['token'=>Cookie::get('front_token'),'is_frozen'=>0])->find();
        return $user->id;
    }
    
    // 退出登陆
    public static function logout()
    {
        Session::delete('front_auth');
        Session::delete('front');
        Cookie::delete('front_token');
        Cookie::delete('sign');
        return ['msg'=>'退出成功'];
    }
    
    // 修改密码
     public static function goPass()
     {
        $data = Request::post();
        $validate = new V;
        $user = M::where(['token'=>Cookie::get('front_token'),'is_frozen'=>0])->find();
        M::where('id',$user->id)->update(['password' => set_password(trim($data['newpwd']))]);
        self::logout();
     }

     //获取当前登录的用户信息
     public static function getUser()
     {
        $user = M::where(['token'=>Cookie::get('front_token'),'is_frozen'=>0])->find();
        return $user;
     }
     
     //重置密钥信息
     public static function goUserKey()
     {
        $user = M::where(['token'=>Cookie::get('front_token'),'is_frozen'=>0])->find();
        $data = rand_string();
        M::where('id',$user->id)->update(['user_key' => $data]);
        return $data;
     }
     
    //购买VIP套餐
     public static function govip($data)
    {
        if(empty($data['tcid']))
        {
            return ['msg'=>'请选择套餐','code'=>201];
        }
        $user = M::where(['token'=>Cookie::get('front_token'),'is_frozen'=>0])->find();
        if(!$user) return ['msg'=>'会员不存在','code'=>201];
        $vip = YpayVip::where(['id'=>$data['tcid']])->find();
        if(!$vip) return ['msg'=>'套餐不存在','code'=>201];
        if($user['money']<$vip['money'])
        {
            return ['msg'=>'余额不足请充值','code'=>201];
        }
        try {
            
            M::money("-".$vip['money'],$user->id, '购买套餐扣款');
            //判断是否开启返利功能
            if(getConfig()['is_aff'] && !empty($user['superior_id']) && !empty(getConfig()['aff_percentage']) && getConfig()['aff_type'] == 1){
              $aff_money   = $vip['money']*getConfig()['aff_percentage'];
             M::money("+".$aff_money,$user['superior_id'], '下级购买会员套餐返利');
             M::where('id',$user['superior_id'])->inc('money', $aff_money);
            }
            $viptime = $vip['viptime'];
            if(empty($user['vip_time']))
            {
                M::where('id',$user->id)->update(['vip_id' => $vip['id'],'vip_time' =>date("Y-m-d H:i:s",strtotime("+ $viptime day")),'feilv'=>$vip['feilv']]);
            }
            else
            {
                if($user['feilv'] == $vip['feilv'] )
                {
                    $sjc = strtotime($user['vip_time']);
                    if($sjc<time())
                    {
                        M::where('id',$user->id)->update(['vip_id' => $vip['id'],'vip_time' =>date("Y-m-d H:i:s",strtotime("+ $viptime day")),'feilv'=>$vip['feilv']]);
                    }
                    else
                    {
                        $uviptime = $user['vip_time'];
                        M::where('id',$user->id)->update(['vip_id' => $vip['id'],'vip_time' =>date("Y-m-d H:i:s",strtotime("$uviptime + $viptime day"))]);
                    }
                }
                else
                {
                     M::where('id',$user->id)->update(['vip_id' => $vip['id'],'vip_time' =>date("Y-m-d H:i:s",strtotime("+ $viptime day")),'feilv'=>$vip['feilv']]);
                }
            }
            return ['msg'=>'操作成功'];
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }
    
    //注册/找回公共方法
    public static function reg_or_bind($type,$data){
        // getConfig()['is_reg'] 检查是否开启注册 Tips: 0:关闭/1:开启
        // getConfig()['captcha-type'] 获取验证码类型 Tips: 0:关闭验证码/1:普通验证码/2:腾讯防水墙
        // getConfig()['regcode-type'] 获取注册方式类型 Tips: 0:用户名+密码+邮箱注册/1:手机号注册/2:邮箱注册
        $is_reg = getConfig()['is_reg'];
        $captcha_type = getConfig()['captcha-type'];
        $regcode_type = getConfig()['regcode-type'];
        
        // 判断注册功能是否开启0/1 = 关闭/开启
        if($is_reg !=1 )
        {
            return ['code'=>201,'msg'=>'注册功能已关闭!'];
        }
        
         // 验证
        $validate = new V;
        
        // 判断是否是推广链接注册
        if(!empty(session('aff_id'))){
            $data['superior_id'] = session('aff_id');
        }
        
        // 调用验证方法数据方法/传入验证码类型和验证码参数
        $ordinary_captcha = empty($data['ordinary_captcha']) ? "":$data['ordinary_captcha'];
        
        // 获取验证验证码信息
        $is_captcha = self::is_captcha($captcha_type,$ordinary_captcha);
        
        // 判断是否有值返回
        if(!empty($is_captcha)){
           return  $is_captcha;
        }
        
        //判断验证码是否正确
        if($regcode_type!=0)
        {
            if($regcode_type == 1){
                if(!$validate->scene('mobile')->check($data))return ['msg'=>$validate->getError(),'code'=>201];
            }else{
                if(!$validate->scene('email')->check($data))return ['msg'=>$validate->getError(),'code'=>201];
            }
            $code = Session::get('ecode');
            if($data['captcha']!=$code)
            {
                return ['msg'=>'验证码错误','code'=>201];
            }
        }
        
        // 验证提交数据
        if(!$validate->scene('add')->check($data))
        return ['msg'=>$validate->getError(),'code'=>201];
        
        // 调用清除验证码缓存方法
        self::clear_captcha_session();
        
        // 判断是否是快捷登录
        if($type == 'bind'){
            if($data['type'] == 'qq'){
                $data['is_bindqq'] = $data['is_bind'];
                $data['qq_sid'] = $data['open_id'];
            }else{
                $data['is_bindwx'] = $data['is_bind'];
                $data['wx_sid'] = $data['open_id'];
            }
        }
        $data['password'] = set_password(trim($data['password']));
        $data['user_key'] = rand_string();
        $data['username'] = htmlspecialchars($data['username']);
        $data['nickname'] = htmlspecialchars($data['username']);
        
        // 检查是否开启赠送会员功能
        // getConfig()['is_reg_give_vip'] 赠送VIP开关
        // getConfig()['reg_give_vip']  赠送VIP套餐ID
        $is_reg_vip = getConfig()['is_reg_give_vip'];
        if($is_reg_vip == 1){
            $reg_vip_id = getConfig()['reg_give_vip'];
            $vip = YpayVip::where('id',$reg_vip_id)->find(); //根据ID获取套餐
            $data['vip_id'] = $reg_vip_id;
            $data['vip_time'] = date("Y-m-d H:i:s",strtotime("+ ".$vip['viptime']." day"));
            $data['feilv'] = $vip['feilv'];
        }
        //检查是否开启赠送余额功能
        $zsoff = getConfig()['is_reg_give_price'];
        if($zsoff==1)
        {
            $data['money'] = getConfig()['reg_give_price'];
        }
        // 检查是否开启了付费注册
        if(getConfig()['paid_reg'] == 1 && getConfig()['paid_reg_price'] != 0){
            $alipay = getConfig()['front_ali_pay'];
            $wxpay  = getConfig()['front_wechat_pay'];
            if($alipay == 'close' && $wxpay == 'close')
            {
                return ['msg' => '无收款通道','code'=>201];
            }elseif($alipay != 'close' && $wxpay != 'close'){
                $paytype = [['name'=>'alipay','showname'=>'支付宝'],['name'=>'wxpay','showname'=>'微信']];
            }elseif($alipay != 'close'){
                $paytype = [['name'=>'alipay','showname'=>'支付宝']];
            }elseif($wxpay != 'close'){
                $paytype = [['name'=>'wxpay','showname'=>'微信']];
            }
            //付费注册创建订单，返回订单号，在发起支付页面查询并组装数据发起支付
            $order_id = 'Y'.date("YmdHis").rand(11111,99999);
            $reginfo = [
               'type'       => 'default',
               'out_trade_no'      => $order_id,
               'status'    => 0, 
               'create_time'       => date('Y-m-d H:i:s', time()),
               'end_time'=> date('Y-m-d H:i:s', time()),
               'regdata'    => json_encode($data), 
            ];
            Regorder::create($reginfo);
            return ['paytype'=>$paytype,'need'=>getConfig()['paid_reg_price'],'code'=>888,'trade_no'=>$order_id];
        }
        
        try {
            M::create($data);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
    }
    
    //二次验证验证码
    public static function goCaptcha($data){
        //获取数据库配置信息
        $config = getConfig();
        if($config['captcha-type'] == 2){
            header('Content-type:application/json; Charset=utf-8');
            $url = 'https://ssl.captcha.qq.com/ticket/verify';
            $appid = $config['tencent_CaptchaAppId'];
            $AppSecretKey = $config['tencent_CaptchaKey'];
            $Ticket = isset($data['ticket']) ? $data['ticket'] : '';
            $Randstr = isset($data['randstr']) ? $data['randstr'] : '';
            $UserIP = request()->ip();
            $params = array(
                "aid" => $appid,
                "AppSecretKey" => $AppSecretKey,
                "Ticket" => $Ticket,
                "Randstr" => $Randstr,
                "UserIP" => $UserIP
            );
            $data = http_build_query($params);
            $result = get_curl($url,$data);
            $res = json_decode($result, true);
            if (isset($res) && $res['response']==1) {
                Session::set('tencentCaptcha', 1);
                return ['code'=>200,'msg'=>session('tencentCaptcha')];
            }else{
                Session::set('tencentCaptcha', 0);
                return ['code'=>201,'msg'=>session('tencentCaptcha')];
            }
        }else{
            header('Content-type:application/x-www-form-urlencoded');
            $url = 'http://gcaptcha4.geetest.com/validate';
            $appid = $config['geetest_CaptchaAppId'];
            $AppSecretKey = $config['geetest_CaptchaKey'];
            $lot_number = $data['lot_number'];
            $captcha_output = $data['captcha_output'];
            $pass_token = $data['pass_token'];
            $gen_time = $data['gen_time'];
            // 生成签名
            $sign_token = hash_hmac('sha256', $lot_number, $AppSecretKey);
            // 4.上传校验参数到极验二次验证接口, 校验用户验证状态
            $query = array(
                'captcha_id' =>$appid,
                "lot_number" => $lot_number,
                "captcha_output" => $captcha_output,
                "pass_token" => $pass_token,
                "gen_time" => $gen_time,
                "sign_token" => $sign_token
            );
            $data = http_build_query($query);
            $result = get_curl($url,$data);
            $res = json_decode($result, true);
            if($res['result'] == 'success'){
                Session::set('geetestCaptcha', 1);
                return $res;
            }else{
                Session::set('geetestCaptcha', 0);
                return $res;
            }
            
        }
    }
    
    //清除第三方验证码缓存记录[极验4代/腾讯云防水墙]
    public static function clear_captcha_session(){
        //判断是否存在验证的Session并清除
        if(session('tencentCaptcha') || session('geetestCaptcha')){
            //清除关于腾讯防水墙的Session
            session('tencentCaptcha', null);
            //清除关于极验的Session
            session('geetestCaptcha', null);
        }
    }
    
    //判断验证码是否为空和验证
    public static function is_captcha($captcha_type,$ordinary_captcha=""){
        // 判断普通验证码是否为空
        if($captcha_type==1 &&  empty($ordinary_captcha) )
        {
            return ['msg'=>'请输入验证码','code'=>201];
        }
        // 判断腾讯防水墙是否验证
        if($captcha_type==2 && session('tencentCaptcha') !=1)
        {
            return ['msg'=>'请先完成验证码验证','code'=>201];
        }
        //判断极验是否验证
        if($captcha_type==3 && session('geetestCaptcha') !=1)
        {
            return ['msg'=>'请先完成验证码验证','code'=>201];
        }
        //判断验证码是否正确
        if($captcha_type==1 && !captcha_check($ordinary_captcha))
        {
              return ['msg'=>'验证码错误','code'=>201];
        }
    }
    
    // 快捷登录缓存用户信息
    public static function thirdlogin($user)
    {
        $user['token'] = rand_string().$user['id'].microtime(true);
        M::where('id',$user['id'])->update(['token' =>$user['token']]);
        //是否记住密码
        $time = 3600;
        if (isset($data['remember'])) $time = 30 * 86400;
        //缓存登录信息
        $info = [
            'id' => $user['id'],
            'token' => $user['token']
        ];
        Session::set('front', $info);
        Cookie::set('front_token',$user['token'], $time);
        try {
            $info = [
               'uid'       => $user['id'],
               'url'      => Request::url(),
               'desc'    => '商户快捷登录成功', 
               'ip'       => Request::ip(),
               'user_agent'=> Request::server('HTTP_USER_AGENT')
            ];
            Log::create($info);
        }catch (\Exception $e){
            return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
        }
        return ['msg'=>'登录成功'];
    }
    
    // 获取短信公共方法
    public static function getCode($type = '',$mobile='',$email='')
    {
        // 获取全部配置参数
        $config  = getConfig();
        
        $num = mt_rand(100000,999999);//生产随机验证码
        Session::set('ecode', $num);
        //获取短信注册类型 1/2/3 - 阿里云/腾讯云/短信宝
        $smsType = $config['smstype'];
        if($type == 'login' || $type == 'retrieve'){
            $code_type = 'logincode-type';
            $code_msg = '该手机号不存在!';
            $email_msg = '该邮箱不存在!';
            if($type == 'login'){
                $email_goMsg_title = '平台登录验证码';
            }else{
                $email_goMsg_title = '平台找回验证码';
            }
        }elseif($type == 'register'){
            $code_type = 'regcode-type';
            $code_msg = '该手机号已存在!';
            $email_msg = '该邮箱已存在!';
            $email_goMsg_title = '平台注册验证码';
        }
        
        //判断短信发送方法 1/2 短信/邮箱
        if($config[$code_type] == 1)
        {
            $model =  M::where('mobile',$mobile)->find();
            if(empty($model) && ($type == 'login' || $type == 'retrieve'))
            {
                return ['code'=>201,'msg'=>$code_msg];
            }elseif(!empty($model) && $type == 'register'){
                return ['code'=>201,'msg'=>$code_msg];
            }
            switch ($smsType) {
                case 1:
                    $res = AliSms::send($mobile,$num);
                    break;
                case 2:
                    if($type == 'login'){
                        $res = TenCloudSms::goLogin($mobile,$num);  
                    }else{
                        $res = TenCloudSms::goReg($mobile,$num); 
                    }
                    break;
                default:
                        $res = SmsBao::go($num,$mobile);
                    break;
            }
        }
        else
        {
            $model =  M::where('email',$email)->find();
            if(empty($model) && ($type == 'login' || $type == 'retrieve'))
            {
                return ['code'=>201,'msg'=>$email_msg];
            }elseif(!empty($model) && $type == 'register'){
                return ['code'=>201,'msg'=>$email_msg];
            }
            $res = Mail::go($email,$email_goMsg_title,'你好！，验证码为：'.$num.'，5分钟内有效');
        }
        if(!$res)
        {
            return ['code'=>201,'msg'=>'发送失败!'];
        }
        return ['code'=>200,'msg'=>'发送成功!'];
    }
}
