<?php


namespace app\index\controller;
use think\facade\Config;
use think\facade\Db;
use app\common\service\YpayRecharge;
use app\common\service\YiPay as epay;
use app\common\model\YpayUser as M;
use think\facade\View;
use think\facade\Request;

class Demo extends \app\BaseController
{

public function isMobile()
 {
       if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }
    if (isset($_SERVER['HTTP_VIA'])) {
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'textml') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'textml')))) {
            return true;
        }
    }
    return false;
  }
    public function index()
    {
        if(self::isMobile()){
            $list = Db::table('ypay_navs')->where('status', 1)->order('id','asc')->select();
            View::assign(['nav' => $list,]);
            return $this->fetch('mobile',$this->getSystem());
        }else{
            return $this->fetch('',$this->getSystem());
        }
        
    }
    
    public function demo_success(){
        return $this->fetch('',$this->getSystem());
    }
    
    public function dopay()
    {
        $data = Request::param('','','strip_tags');
        $request = \think\facade\Request::instance();
        $creat_data = 
        [
            "type"       => $data['type'],
            "out_trade_no"     => $data['out_trade_no'],
            "user_id" => getConfig()['epayid_demo'],
            "status" => 0, //商品名称
            "money"      => getConfig()['demopay_money'],//订单金额
        ];
        YpayRecharge::goAdd($creat_data);
        $datas = [
            "pid"         => getConfig()['epayid_demo'],//商户ID
            "type"       => $data['type'],//支付方式
            "out_trade_no"     => $data['out_trade_no'], //商户订单号
            "notify_url" =>  $request->root(true).'/Demo/notify_epay',//异步通知地址
            "return_url" =>  $request->root(true).'/Demo/return_epay',//同步通知地址
            "name" => getConfig()['demopay_name'], //商品名称
            "money"      => getConfig()['demopay_money'],//订单金额
        ];
        $epay = new epay(getConfig()['epayid_demo'],getConfig()['epaykey_demo'],getConfig()['epayurl_demo']);
        $res = $epay->buildRequestForm($datas);
        echo($res);
        die;
        //return $this->fetch();
    }
    
     //异步通知
    public function notify_epay()
    {
        $data = Request::param('','','strip_tags');
        $user_key = getConfig()['epaykey_demo'];
        $epay = new epay();
        $isSign = $epay->getEpaySignVeryfy($data,$data["sign"],$user_key); //生成签名结果
        if(!$isSign)
        {
            echo 'fail'; die;
        }
        else
        {
            $ods = Db::name('ypay_recharge')->where('out_trade_no', $data['out_trade_no'])->find();
            if($ods['status']==0)
            {
                //变更订单状态并且给客户加款
                Db::name('ypay_recharge')->where('id', $ods['id'])->update(['status' =>1,'end_time'=>date('Y-m-d H:i:s', time())]);
                M::money($ods['money'],$ods['user_id'], getConfig()['demopay_name']);
                echo 'success'; die;
            }
            else
            {
                echo 'error'; die;
            }
        }
    }
    
    //充值同步通知
    public function return_epay()
    {
        $data = Request::param('','','strip_tags');
        $user_key = getConfig()['epaykey_demo'];
        $epay = new epay();
        $isSign = $epay->getEpaySignVeryfy($data, $data["sign"],$user_key); //生成签名结果
        if(!$isSign)
        {
            echo 'fail'; die;
        }
        else
        {
            $ods = Db::name('ypay_recharge')->where('out_trade_no', $data['out_trade_no'])->find();
            if($ods['status']==0)
            {
                //变更订单状态并且给客户加款
                Db::name('ypay_recharge')->where('id', $ods['id'])->update(['status' =>1,'end_time'=>date('Y-m-d H:i:s', time())]);
                M::money($ods['money'],$ods['user_id'], getConfig()['demopay_name']);
                return redirect(Request::root().'/Demo/demo_success');
            }
            else
            {
                return redirect(Request::root().'/Demo/demo_success');
            }
        }
    }
}
