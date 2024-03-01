<?php
declare (strict_types = 1);

namespace app\index\controller;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;
use app\common\service\YpayUser as S;
use app\common\model\YpayUser as M;
use think\facade\Db;
use app\common\model\YpayOrder;

class Jialan extends \app\BaseController
{
    protected $middleware = ['FrontCheck'];
    
    public function getReturn($code = 1, $msg = "成功", $data = null)
    {
        return array("code" => $code, "msg" => $msg, "data" => $data);
    }
    
    //控制台页面
    public function console()
    {
        $request = \think\facade\Request::instance();
        $plug = Db::table('ypay_plug')->where('status', 1)->select();
        View::assign('plug', $plug);
        $url = empty(getConfig()['pay_api']) ?$request->root(true).'/':getConfig()['pay_api'];
        View::assign('url', $url);
        View::assign('user', S::getUser());
        $data = 
        [
            "allordercount"       => YpayOrder::where('status',1)->where('user_id',S::getUserId())->count(),
            "dayordercount"     => YpayOrder::where('status',1)->where('user_id',S::getUserId())->whereDay('create_time')->count(),
            "allmoney" => YpayOrder::where('user_id',S::getUserId())->where('status',1)->sum('truemoney'),
            "daymoney" => YpayOrder::where('user_id',S::getUserId())->where('status',1)->whereDay('create_time')->sum('truemoney'),
            'wxcount'         => Db::name('ypay_account')->where('type','wxpay')->where('user_id',S::getUserId())->count(),
            'alicount'        => Db::name('ypay_account')->where('type','alipay')->where('user_id',S::getUserId())->count(),
            'qqcount'        => Db::name('ypay_account')->where('type','qqpay')->where('user_id',S::getUserId())->count(),
            'allcount'        => Db::name('ypay_account')->where('user_id',S::getUserId())->count(),
            'lixiancount'        => Db::name('ypay_account')->where('user_id',S::getUserId())->where('status',0)->count(),
            'yearmoney'       => YpayOrder::where('user_id',S::getUserId())->where('status',1)->whereTime('create_time', 'yesterday')->sum('truemoney'),
            'yearcount'       => YpayOrder::where('user_id',S::getUserId())->where('status',1)->whereTime('create_time', 'yesterday')->count(),
            'yuemoney' => YpayOrder::where('user_id',S::getUserId())->where('status',1)->whereTime('create_time', 'month')->sum('truemoney')
        ];
        View::assign('tj', $data);
        return $this->fetch();
    }
    
    //接口密钥页面
    public function apikey()
    {
        $request = \think\facade\Request::instance();
        $plug = Db::table('ypay_plug')->where('status', 1)->select();
        View::assign('plug', $plug);
        $url = empty(getConfig()['pay_api']) ?$request->root(true).'/':getConfig()['pay_api'];
        View::assign('url', $url);
        View::assign('user', S::getUser());
        return $this->fetch();
    }
    
    //重置密钥
    public function GeneratingKey()
    {
        return json(['key'=>S::goUserKey(),'code'=>1]);
    }
    

}
