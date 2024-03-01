<?php


namespace app\index\controller;
use think\facade\Config;
use think\facade\Db;
use think\facade\Session;
use app\common\service\YpayUser as S;
use think\facade\View;
use think\facade\Request;
use app\common\service\AliPay;

class Index extends \app\BaseController
{

    public function index()
    {
        if (S::isLogin()){
            return redirect(Request::root().'/User/Index');
        }
        if(getConfig()['is_aff']){
            $aff = Request::param('aff');
            if(!empty($aff)){
              Session::set('aff_id',$aff);
            }
        }
        if(!getConfig()['is_weboff'])
        {
            return redirect(Request::root().'/User/Login');
        }
        $list = Db::table('ypay_navs')->where('status', 1)->order('sort','asc')->select();
        $news1 = Db::name('ypay_news')->where('type',1)->where('status',1)->order('id desc')->paginate(5);
        $news2 = Db::name('ypay_news')->where('type',2)->where('status',1)->order('id desc')->paginate(5);
        $news3 = Db::name('ypay_news')->where('type',3)->where('status',1)->order('id desc')->paginate(5);
        $is_login = 0;
        if (S::isLogin()){
            $is_login = 1;
        }
        View::assign([
            'news1'  => $news1,
            'news2' => $news2,
            'news3' => $news3,
            'nav' => $list,
            'is_login' => $is_login,
        ]);
        return $this->fetch('',$this->getSystem());
    }
    
    public function indexann()
    {
        return $this->fetch();
    }
    

    
    
    
    
}
