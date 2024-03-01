<?php
declare (strict_types = 1);

namespace app\index\controller;
use think\facade\Request;
use think\captcha\facade\Captcha;
use app\common\service\YpayUser as S;
use app\common\model\YpayUser as M;
use app\common\util\TenCloudSms;
use app\common\util\AliSms;
use app\common\util\SmsBao;
use app\common\util\Mail;
use think\facade\Session;
use think\facade\Cookie;
use think\facade\Config;
use think\facade\Db;
use think\facade\View;
use app\common\service\Third;

class User extends \app\BaseController
{
    /**
     * 首页
     */
    public function index()
    {
        // 如果未登录进入用户中心界面则跳转至登录界面
        if (!S::isLogin()){
            return redirect(Request::root().'/User/Login');
        }
        return $this->fetch('',$this->getSystem());
    }
     
    //登录
    public function login()
    {
        //如果已登录则进入用户中心
        if (S::isLogin()){
            return redirect(Request::root().'/User/Index');
        }
        //获取页面提交的数据传值
        if (Request::isAjax()){
            $this->getJson(S::login(Request::param('','','strip_tags')));
        }
        //调用清除缓存方法
        S::clear_captcha_session();
        return $this->fetch('',['config'=>getConfig()]);
    }
    
    
    // 注册
    public function reg()
    {
        // 如果已登录则进入用户中心
        if (S::isLogin())
        {
            return redirect(Request::root().'/User/Index');
        }
        // 获取页面提交的数据传值
        if (Request::isAjax()){
            // 根据是否开启付费注册利用不同方法返回参数
            if(getConfig()['paid_reg'] == 1 && getConfig()['paid_reg_price'] != 0){
               return json(S::register(Request::param('','','strip_tags'))); 
            }else{
               $this->getJson(S::register(Request::param('','','strip_tags')));
            }
        }
        // 调用清除验证码缓存方法
        S::clear_captcha_session();
        return $this->fetch('',['config'=>getConfig()]);
    }
    
    
    // 登录 - 获取短信
    public function getLoginCode($mobile='',$email='')
    {
       return $this->getJson(S::getCode('login',$mobile,$email));
    }
    
    // 注册 - 获取短信
    public function getRegCode($mobile='',$email='')
    {
         return $this->getJson(S::getCode('register',$mobile,$email));
    }
    
    
    // 找回 - 获取短信
    public function getLostCode($mobile='',$email='')
    {
         return $this->getJson(S::getCode('retrieve',$mobile,$email));
    }
    
    //绑定快捷登录
    public function bind()
    {
        if (S::isLogin())
        {
            return redirect(Request::root().'/User/Index');
        }
        if (Request::isAjax()){
            $this->getJson(S::bind(Request::param('','','strip_tags')));
        }
        $data = array(
            'type' => session('type'),
            'username' => session('username'),
            'sid'   => session(session('type').'_sid'),
            'is_bind'=> session('is_bind'.session('type'))
            ); 
        if(empty($data['type']) || empty($data['username']) || empty($data['sid']) || empty($data['is_bind'])){
            exit('对应参数为空,请重新使用快捷登录');
        }
        //调用清除缓存方法
        S::clear_captcha_session();
        View::assign('data', $data);
        View::assign('config', getConfig());
        return $this->fetch();
    }
    
    //找回密码
    public function lostpwd()
    {
        if (Request::isAjax()){
            $this->getJson(S::golostpwd(Request::param('','','strip_tags')));
        }
        
        //调用清除验证码缓存方法
        S::clear_captcha_session();
        return $this->fetch('',['config'=>getConfig()]);
    }
    
    //验证码
    public function verify(){
        ob_clean(); 
        return Captcha::create();
    }
    
    //退出登录
    public function logout(){
        S::logout();
        return redirect(Request::root().'/User/Login');
    }
    
    //发起聚合登录
    public function OAuthAccountLogin($type)
    {
        $loginurl = Third::OAuthAccountLogin($type);
        if($loginurl['code']!=0)
        {
            exit($loginurl['msg']);
        }
        View::assign('url', $loginurl['url']);
        return $this->fetch();
    }
    
    //发起QQ互联登录
    public function qqlogin()
    {
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        $qqOAuth = new \Yurun\OAuthLogin\QQ\OAuth2(getConfig()['qq_appid'], getConfig()['qq_appkey'],$http_type.$_SERVER['HTTP_HOST'].'/Notify/qqcallback');
        $url = $qqOAuth->getAuthUrl();
        Session::set('YURUN_QQ_STATE', $qqOAuth->state);
        header('location:' . $url);
        die;
    }
    
    //二次验证验证码
    public function Captcha()
    {   
        //获取提交数据
        $data = Request::param('','','strip_tags');
        
        return json(S::goCaptcha($data));
        
    }
    
}
