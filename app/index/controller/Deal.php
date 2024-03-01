<?php
declare (strict_types = 1);

namespace app\index\controller;
use think\facade\Session;
use think\facade\Request;
use think\facade\View;
use app\common\service\YpayUser as S;
use app\common\model\YpayUser as M;
use app\common\model\MoneyLog;
use app\common\model\YpayOrder;
use think\facade\Db;
use app\common\model\YpayOrder as O;
use app\common\service\YiPay as epay;
use app\common\service\YpayRecharge;
use app\common\service\Jialanshen;
use think\facade\Config;

class Deal extends \app\BaseController
{
    protected $middleware = ['FrontCheck','FrontAuth'];
    
    //控制台页面
    public function recharge()
    {
        View::assign('user', S::getUser());
        return $this->fetch();
    }
    
    public function vip()
    {
        if (Request::isAjax()){
            $this->getJson(S::govip(Request::param('','','strip_tags')));
        }
        $user = S::getUser();
        $viplist = Db::table('ypay_vip')->where('status', 1)->order('sort','asc')->select();
        foreach ($viplist as $key => $value){
            if($value['id'] == $user['vip_id']){
                $user['vip_name'] = $value['name'];
                break;
            }
        }
        View::assign('viplist', $viplist);
        View::assign('user', $user);
        return $this->fetch();
    }
    
    public function moneylog()
    {
        if (Request::isAjax()){
            $this->getJson(MoneyLog::getUserList(S::getUserId()));
        }
        return $this->fetch();
    }
    
    public function orderlog()
    {
        if (Request::isAjax()){
            $this->getJson(YpayOrder::getUserList(S::getUserId()));
        }
        $data = 
        [
            "allordercount"       => YpayOrder::where('status',1)->where('user_id',S::getUserId())->count(),
            "dayordercount"     => YpayOrder::where('status',1)->where('user_id',S::getUserId())->whereDay('create_time')->count(),
            "allmoney" => YpayOrder::where('user_id',S::getUserId())->where('status',1)->sum('truemoney'),
            "daymoney" => YpayOrder::where('user_id',S::getUserId())->where('status',1)->whereDay('create_time')->sum('truemoney')
        ];
        View::assign('tj', $data);
        
        
        return $this->fetch();
    }
    
    public function dopay()
    {
        //获取微信通道参数
        $front_wechat_pay = getConfig()['front_wechat_pay'];
        //获取支付宝通道参数
        $front_ali_pay = getConfig()['front_ali_pay'];
        $data = Request::param('','','strip_tags');
        $request = \think\facade\Request::instance();
        $order_id = 'Y'.date("YmdHis").rand(11111,99999);
        // if(getConfig()['front_pay_code'] == 'alidmf' && $data['type'] =='alipay'){
        //     $user =M::where('id',S::getUserId())->find();
            
        //     $notifyUrl = $request->root(true).'/Notify/dopay_dmf';
        //     $appid = getConfig()['dmf_appid'];//https://open.alipay.com 账户中心->密钥管理->开放平台密钥，填写添加了电脑网站支付的应用的APPID
        //     $signType = 'RSA2';//签名算法类型，支持RSA2和RSA，推荐使用RSA2
        //     $rsaPrivateKey=getConfig()['dmf_key'];//商户私钥，填写对应签名算法类型的私钥，如何生成密钥参考：https://docs.open.alipay.com/291/105971和https://docs.open.alipay.com/200/105310
        //     $requestConfigs = array(
        //         'out_trade_no'=>$order_id,
        //         'total_amount'=>$data['money'], //单位 元
        //         'subject'=>'在线充值',  //订单标题
        //         'timeout_express'=>'2h'       //该笔订单允许的最晚付款时间，逾期将关闭交易。取值范围：1m～15d。m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。 该参数数值不接受小数点， 如 1.5h，可转换为 90m。
        //     );
        //     $commonConfigs = array(
        //         //公共参数
        //         'app_id' => $appid,
        //         'method' => 'alipay.trade.precreate',//接口名称
        //         'format' => 'JSON',
        //         'charset'=> 'utf-8',
        //         'sign_type'=>'RSA2',
        //         'timestamp'=>date('Y-m-d H:i:s'),
        //         'version'=>'1.0',
        //         'notify_url' => $notifyUrl,
        //         'biz_content'=>json_encode($requestConfigs),
        //     );
        //     $sign = Jialanshen::sign($rsaPrivateKey,Jialanshen::getSignContent($commonConfigs), $commonConfigs['sign_type']);
        //     if(!$sign)
        //     {
        //         exit("密钥错误");
        //     }
        //     $commonConfigs["sign"] = $sign;
        //     $result = Jialanshen::curlPost('https://openapi.alipay.com/gateway.do?charset=utf-8',$commonConfigs);
        //     $json = json_decode($result,TRUE);
        //     $json = $json['alipay_trade_precreate_response'];
        //     if($json['code'] && $json['code']=='10000')
        //     {
        //         $qrcode = $json['qr_code'];
        //     }
        //     else
        //     {
        //         exit("发起失败，请检查信息");
        //     }
        //     // 调用接口
        //     try{
        //         //$datas = $pay->execute($ali);
        //          //生成成功，将订单数据添加到数据库并返回
        //         if(empty($data['sitename']))
        //         {
        //             $data['sitename'] = "";
        //         }
                
        //         $money = $data['money'];
        //         //$qrcode = $datas['alipay_trade_precreate_response']['qr_code'];
        //         $h5url = "alipays://platformapi/startapp?appId=60000105&url=" .$qrcode;
        //         $feilv_money = $data['money'] * $user['feilv'] / 100;
        //         $odmodels = [
        //             'name' => '在线测试',
        //             'sitename' => getConfig()['sitename'],
        //             'type' => 'alipay',
        //             'trade_no' => $order_id,
        //             'out_trade_no' => $order_id,
        //             'user_id' => $user['id'],
        //             'money' => $data['money'],
        //             'truemoney' => $money,
        //             'feilvmoney' => $feilv_money,
        //             'status' => '0',
        //             'create_time' => date('Y-m-d H:i:s', time()),
        //             'qrcode' => $qrcode,
        //             'h5_qrurl' => $h5url,
        //             'out_time' => time() + $user['timeout_time'],
        //         ];
        //         try {
        //             O::create($odmodels);
        //             exit("<script>window.location.href='/Pay/console_dopay?trade_no={$order_id}';</script>");
        //         }catch (\Exception $e){
        //             return false;
        //         }
        //     }
        //     catch(Exception $e){
        //         var_dump($pay->response->body);
        //     }
        // }else{
        if($data['money']< getConfig()['min_recharge'])
        {
            View::assign('error_tips', "充值金额低于最低充值金额");
            return $this->fetch('pay/submit');
        }
        if( $data['money'] > getConfig()['max_recharge'])
        {
            View::assign('error_tips', "充值金额高于最高充值金额");
            return $this->fetch('pay/submit');
        }
            $creat_data = 
                [
                    "type"       => $data['type'],
                    "out_trade_no"     => $order_id,
                    "user_id" => S::getUserId(),
                    "status" => 0, //商品名称
                    "money"      => $data['money'],//订单金额
                ];
                YpayRecharge::goAdd($creat_data);
                if($data['type']=='wxpay'){
                    $type = 'wx';
                    $front_type = 'wechat';
                }else{
                    $type = 'ali';
                    $front_type = 'ali';
                }
                $datas = [
                    "pid"         => getConfig()[$front_type . '_epay_id'],//商户ID
                    "type"       => $data['type'],//支付方式
                    "out_trade_no"     => $order_id, //商户订单号
                    "notify_url" =>  $request->root(true).'/Notify/notify_epay',//异步通知地址
                    "return_url" =>  $request->root(true).'/Notify/return_epay',//同步通知地址
                    "name" => "在线充值", //商品名称
                    "money"      => $data['money'],//订单金额
                ];
                $epay = new epay(getConfig()[$front_type . '_epay_id'],getConfig()[$front_type . '_epay_key'],getConfig()[$front_type . '_epay_url']);
                $res = $epay->buildRequestForm($datas);
                echo($res);
                die;
        // }
        //return $this->fetch();
    }
    
    public function Reback($id)
    {
        $order = Db::name('ypay_order')->where('user_id',S::getUserId())->where('id',$id)->find();
        if(empty($order))
        {
            return json(['code'=>0,'msg'=>'订单不存在!']);
        }
        $url = Jialanshen::creat_callback($order);
        $res = get_curl($url['notify']);
        if($res=='success' || $res =="fail")
        {
            Db::name('ypay_order')->where('id',$id)->update(['api_memo' =>$res]);
        }
        else
        {
            Db::name('ypay_order')->where('id',$id)->update(['api_memo' =>'error']);
        }
        return json(['code'=>1,'msg'=>$res]);
    }
    
     

    
    
}
