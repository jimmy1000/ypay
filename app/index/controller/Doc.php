<?php


namespace app\index\controller;
use think\facade\Config;
use think\facade\Db;
use app\common\service\YpayUser as S;
use think\facade\View;
use think\facade\Request;

class Doc extends \app\BaseController
{

    public function index()
    {
        $list = Db::table('ypay_navs')->where('status', 1)->order('id','asc')->select();
        View::assign('nav', $list);
        return $this->fetch('',$this->getSystem());
    }
    
    public function api()
    {
        $list = Db::table('ypay_navs')->where('status', 1)->order('id','asc')->select();
        View::assign('nav', $list);
        return $this->fetch('',$this->getSystem());
    }
    
    public function result()
    {
        $list = Db::table('ypay_navs')->where('status', 1)->order('id','asc')->select();
        View::assign('nav', $list);
        return $this->fetch('',$this->getSystem());
    }
    
}
