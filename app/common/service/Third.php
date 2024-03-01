<?php
declare (strict_types = 1);

namespace app\common\service;
use think\facade\Db;
use think\facade\Request;
use think\facade\Config;

class Third
{
    
    //第三方发起登录
    public static function OAuthAccountLogin($type)
    {
        //获取登录配置信息
        $appid = getConfig()['juhe_id'];
        $appkey= getConfig()['juhe_key'];
        $request = \think\facade\Request::instance();
        $siteurl = $request->root(true).'/Notify/CallBack';
        $url = getConfig()['juhe_url'].'connect.php?act=login&appid='.$appid.'&appkey='.$appkey.'&type='.$type.'&redirect_uri='.$siteurl;
        $res = get_curl($url);
        $res = json_decode($res,true);
        return $res;
    }
    
    public static function CallBackSid($type,$code)
    {
        //获取登录配置信息
        $appid = getConfig()['juhe_id'];
        $appkey= getConfig()['juhe_key'];
        //获取登录地址
        $url = getConfig()['juhe_url'].'connect.php?act=callback&appid='.$appid.'&appkey='.$appkey.'&type='.$type.'&code='.$code;
        $res = get_curl($url);
        $res = json_decode($res,true);
        return $res;
    }
    
    
    
    
    
}
