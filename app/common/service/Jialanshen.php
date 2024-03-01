<?php
declare (strict_types = 1);

namespace app\common\service;
use think\facade\Db;
use think\facade\Request;
use app\common\model\YpayOrder as M;

use app\common\model\YpayUser as S;
use app\common\util\Mail;
use app\common\core\core;


class Jialanshen
{
    
    //支付异步同调方法
    public static function creat_callback($data)
    {
        $userinfo = Db::name('ypay_user')->where('id',$data['user_id'])->find();
        $order = Db::name('ypay_order')->where('id',$data['id'])->find();
        $sign = MD5("money=".$data['money']."&name=".$data['name']."&out_trade_no=".$data['out_trade_no']."&pid=".$data['user_id']."&trade_no=".$data['trade_no']."&trade_status=TRADE_SUCCESS&type=".$data['type'].$userinfo['user_key']);
        $array=array('pid'=>$data['user_id'],'trade_no'=>$data['trade_no'],'out_trade_no'=>$data['out_trade_no'],'type'=>$data['type'],'name'=>$data['name'],'money'=>$data['money'],'trade_status'=>'TRADE_SUCCESS');
        if($data['status']==0)
        {
            if(!$order['is_order_tips'] && $userinfo['order_tips']){
                //调用邮箱通知方法
                self::order_tips($userinfo,$data);
                Db::name('ypay_order')->where('id', $data['id'])->update(['status' =>1,'is_order_tips'=>1,'end_time'=>date('Y-m-d H:i:s', time())]);
            }else{
                Db::name('ypay_order')->where('id', $data['id'])->update(['status' =>1,'end_time'=>date('Y-m-d H:i:s', time())]);
            }
            S::money("-".$data['feilvmoney'],$data['user_id'], '商户费率扣除');
        }
        $urlstr=http_build_query($array);
        //更改订单状态,商户单号、结束时间
        if(strpos($data['notify_url'],'?'))
        {
            $url['notify']=$data['notify_url'].'&'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
        }
        else
        {
            $url['notify']=$data['notify_url'].'?'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
        }
        if(strpos($data['return_url'],'?'))
        {
            $url['return']=$data['return_url'].'&'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
        }
        else
        {
            $url['return']=$data['return_url'].'?'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
        }
		return $url;
    }
    
    //邮箱订单通知
    public static function order_tips($userinfo,$data){
        if($data['type'] == 'alipay'){
            $type = '支付宝';
        }elseif($data['type'] == 'wxpay'){
            $type = '微信';
        }else{
            $type = 'QQ';
        }
        Mail::go($userinfo['email'],getConfig()['sitename'].'购买成功通知','你有一个新订单!请留意网站,订单号:'.$data['out_trade_no'].',商品名称:'.$data['name'].',商品金额:'.$data['money'].',收款通道:'.$type); 
    }
    //支付宝个人免挂
    public static function alipay_grmg($trade_no,$QR_row,$data,$user)
    {
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        while(true)
        {
            $ods = M::where('truemoney',$money)->where('status',0)->where('account_id',$QR_row['id'])->where('out_time','>',time())->order('id desc')->find();
            if(empty($ods))
            {
                break;
            }
            else
            {
                $money = $money + "0.01";
            }
        }
        $qrcode = "alipays%3A%2F%2Fplatformapi%2Fstartapp%3FappId%3D20000123%26actionType%3Dscan%26biz_data%3D%7B%22s%22%3A+%22money%22%2C+%22u%22%3A+%22".$QR_row['zfb_pid']."%22%2C+%22a%22%3A+%22".$money."%22%2C+%22m%22%3A+%22".$data['out_trade_no']."%22%7D";
        //$qrcode = "alipays%3A%2F%2Fplatformapi%2Fstartapp%3FappId%3D09999988%26actionType%3DtoAccount%26goBack%3DNO%26amount%3D".$money."%26userId%3D".$QR_row['zfb_pid']."%26memo%3D".$data['out_trade_no'];
        //$h5url = "alipays://platformapi/startapp?appId=09999988&actionType=toAccount&goBack=NO&amount=".$money."&userId=".$QR_row['zfb_pid']."&memo=".$data['out_trade_no'];
        $h5url = "alipays://platformapi/startapp?appId=60000105&url=https%3A%2F%2Fwww.alipay.com%2F%3FappId%3D20000123%26actionType%3Dscan%26biz_data%3D%257B%2522a%2522%253A%2522" .$money. "%2522%252C%2522s%2522%253A%2522money%2522%252C%2522u%2522%253A%2522" .$QR_row['zfb_pid']. "%2522%252C%2522m%2522%253A%2522" .$data['out_trade_no']. "%2522%257D";
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'alipay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => $qrcode,
            'h5_qrurl' => $h5url,
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels);
            return true;
        }catch (\Exception $e){
            return false;
        }
        
    }
    
    //支付宝通用版通道
    public static function alipay_allmg($trade_no,$QR_row,$data,$user)
    {
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        while(true)
        {
            $ods = M::where('truemoney',$money)->where('status',0)->where('account_id',$QR_row['id'])->where('out_time','>',time())->order('id desc')->find();
            if(empty($ods))
            {
                break;
            }
            else
            {
                $money = $money + "0.01";
            }
        }
        $qrcode = "alipays%3A%2F%2Fplatformapi%2Fstartapp%3FappId%3D20000123%26actionType%3Dscan%26biz_data%3D%7B%22s%22%3A+%22money%22%2C+%22u%22%3A+%22".$QR_row['zfb_pid']."%22%2C+%22a%22%3A+%22".$money."%22%2C+%22m%22%3A+%22".$data['out_trade_no']."%22%7D";
        $h5url = "alipays://platformapi/startapp?appId=60000105&url=https%3A%2F%2Fwww.alipay.com%2F%3FappId%3D20000123%26actionType%3Dscan%26biz_data%3D%257B%2522a%2522%253A%2522" .$money. "%2522%252C%2522s%2522%253A%2522money%2522%252C%2522u%2522%253A%2522" .$QR_row['zfb_pid']. "%2522%252C%2522m%2522%253A%2522" .$data['out_trade_no']. "%2522%257D";
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'alipay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => $qrcode,
            'h5_qrurl' => $h5url,
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
    
    //支付宝免挂商家版
    public static function alipay_mg($trade_no,$QR_row,$data,$user)
    {
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        $qrcode = "alipays%3A%2F%2Fplatformapi%2Fstartapp%3FappId%3D20000123%26actionType%3Dscan%26biz_data%3D%7B%22s%22%3A+%22money%22%2C+%22u%22%3A+%22".$QR_row['zfb_pid']."%22%2C+%22a%22%3A+%22".$money."%22%2C+%22m%22%3A+%22".$data['out_trade_no']."%22%7D";
        $h5url = "alipays://platformapi/startapp?appId=60000105&url=https%3A%2F%2Fwww.alipay.com%2F%3FappId%3D20000123%26actionType%3Dscan%26biz_data%3D%257B%2522a%2522%253A%2522" .$money. "%2522%252C%2522s%2522%253A%2522money%2522%252C%2522u%2522%253A%2522" .$QR_row['zfb_pid']. "%2522%252C%2522m%2522%253A%2522" .$data['out_trade_no']. "%2522%257D";
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'alipay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => $qrcode,
            'h5_qrurl' => $h5url,
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
    
    //微信店员
    public static function wxpay_dy($trade_no,$QR_row,$data,$user)
    {
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        while(true)
        {
            $ods = M::where('truemoney',$money)->where('status',0)->where('account_id',$QR_row['id'])->where('out_time','>',time())->order('id desc')->find();
            if(empty($ods))
            {
                break;
            }
            else
            {
                $money = $money + "0.01";
            }
        }
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'wxpay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => $QR_row['qr_url'],
            'h5_qrurl' => 'weixin://',
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels); 
            return true;
        }catch (\Exception $e){
            return false;
        }
        
    }
    
    //微信免输入
    public static function wxpay_cloud($trade_no,$QR_row,$data,$user)
    {
        // 创建core对象
        $core = new Core();
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        $wx_fen = intval(strval($money*100));
        //生成二维码
        $account = Db::name('ypay_account')->where('id', $QR_row['id'])->find();
        $res = $core->WXTransferSet($account['vcloudurl'],$QR_row['wx_guid'],$wx_fen,$data['out_trade_no']);
        if(!empty($res->data->reqText->buffer))
        {
            $wxres = json_decode($res->data->reqText->buffer,true);
            if(!empty($wxres))
            {
                if($wxres['retcode']==0)
                {
                    $wx_url = $wxres['pay_url'];
                }
                else
                {
                    $wx_url = "账号被风控!";
                    Db::name('ypay_account')->where('id', $QR_row['id'])->update(['status' =>0,'memo'=>"风控,强制下线!"]);
                    Mail::go($user['email'],'平台掉线通知','你好！，通道ID为：'.$row['id'].'的微信通道风控,已强制下线，请勿继续登录');
                    return false;
                }
            }
            else
            {
                $wx_url = '生成错误,请稍后再试!';
                Db::name('ypay_account')->where('id', $QR_row['id'])->update(['status' =>0]);
                Mail::go($user['email'],'平台掉线通知','你好！，通道ID为：'.$row['id'].'的微信通道已掉线');
                return false;
            }
        }
        else
        {
            $wx_url = '网络错误,请稍后再试!'; 
            Db::name('ypay_account')->where('id', $QR_row['id'])->update(['status' =>0,'memo'=>"云端连接异常"]);
            Mail::go($user['email'],'平台掉线通知','你好！，通道ID为：'.$row['id'].'的微信通道云端连接异常，已下线');
            return false;
        }
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'wxpay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => $wx_url,
            'h5_qrurl' => 'weixin://',
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
    
    //微信赞赏码
    public static function wxpay_cloudzs($trade_no,$QR_row,$data,$user)
    {
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'wxpay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => $QR_row['qr_url'],
            'h5_qrurl' => 'weixin://',
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
    
    //微信收款单
    public static function wxpay_skd($trade_no,$QR_row,$data,$user)
    {
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'wxpay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => $QR_row['qr_url'],
            'h5_qrurl' => 'weixin://',
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
    
    //QQ免挂版-本地
    public static function qqpay_mg($trade_no,$QR_row,$data,$user)
    {
        
        $core = new Core();
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        while(true)
        {
            $ods = M::where('truemoney',$money)->where('status',0)->where('account_id',$QR_row['id'])->where('out_time','>',time())->order('id desc')->find();
            if(empty($ods))
            {
                break;
            }
            else
            {
                $money = $money + "0.01";
            }
        }
        //金额确定后获取免输入二维码
        $cookie = base64_decode($QR_row['cookie']);
        $skey = getSubstr($cookie,"skey=",";");
        $pskey = getSubstr($cookie,"p_skey=",";");
        $qcode = $core->QTransferSet($QR_row['qq'],$trade_no,$money,$skey,$pskey);
        if($qcode=="生成失败")
        {
            $qcode = $QR_row['qr_url'];
        }
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'qqpay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => urlencode($qcode),
            'h5_qrurl' => '',
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels); 
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
    
    //QQ免挂版-软件
    public static function qqpay_cloud($trade_no,$QR_row,$data,$user)
    {
        $core = new Core();
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        while(true)
        {
            $ods = M::where('truemoney',$money)->where('status',0)->where('account_id',$QR_row['id'])->where('out_time','>',time())->order('id desc')->find();
            if(empty($ods))
            {
                break;
            }
            else
            {
                $money = $money + "0.01";
            }
        }
        $skey = $core->Api_GetCookies($QR_row['qq']);
        $pskey = $core->Api_GetTenPayPsKey($QR_row['qq']);
        $qcode = $core->QTransferSet($QR_row['qq'],$trade_no,$money,$skey,$pskey);
        if($qcode=="生成失败")
        {
            $qcode = $QR_row['qr_url'];
        }
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'qqpay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => urlencode($qcode),
            'h5_qrurl' => '',
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels); 
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
    
    //支付宝APP
    public static function alipay_app($trade_no,$QR_row,$data,$user)
    {
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        while(true)
        {
            $ods = M::where('truemoney',$money)->where('status',0)->where('account_id',$QR_row['id'])->where('out_time','>',time())->order('id desc')->find();
            if(empty($ods))
            {
                break;
            }
            else
            {
                $money = $money + "0.01";
            }
        }
        $qrcode = "alipays%3A%2F%2Fplatformapi%2Fstartapp%3FappId%3D20000123%26actionType%3Dscan%26biz_data%3D%7B%22s%22%3A+%22money%22%2C+%22u%22%3A+%22".$QR_row['zfb_pid']."%22%2C+%22a%22%3A+%22".$money."%22%2C+%22m%22%3A+%22".$data['out_trade_no']."%22%7D";
        $h5url = "alipays://platformapi/startapp?appId=60000105&url=https%3A%2F%2Fwww.alipay.com%2F%3FappId%3D20000123%26actionType%3Dscan%26biz_data%3D%257B%2522a%2522%253A%2522" .$money. "%2522%252C%2522s%2522%253A%2522money%2522%252C%2522u%2522%253A%2522" .$QR_row['zfb_pid']. "%2522%252C%2522m%2522%253A%2522" .$data['out_trade_no']. "%2522%257D";
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'alipay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => $qrcode,
            'h5_qrurl' => $h5url,
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels);
            return true;
        }catch (\Exception $e){
            return false;
        }
        
    }
    
    //微信APP
    public static function wxpay_app($trade_no,$QR_row,$data,$user)
    {
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        while(true)
        {
            $ods = M::where('truemoney',$money)->where('status',0)->where('account_id',$QR_row['id'])->where('out_time','>',time())->order('id desc')->find();
            if(empty($ods))
            {
                break;
            }
            else
            {
                $money = $money + "0.01";
            }
        }
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'wxpay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => $QR_row['qr_url'],
            'h5_qrurl' => 'weixin://',
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels); 
            return true;
        }catch (\Exception $e){
            return false;
        }
        
    }
    
    //微信自挂
    public static function wxpay_zg($trade_no,$QR_row,$data,$user)
    {
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        while(true)
        {
            $ods = M::where('truemoney',$money)->where('status',0)->where('account_id',$QR_row['id'])->where('out_time','>',time())->order('id desc')->find();
            if(empty($ods))
            {
                break;
            }
            else
            {
                $money = $money + "0.01";
            }
        }
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'wxpay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => $QR_row['qr_url'],
            'h5_qrurl' => 'weixin://',
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels); 
            return true;
        }catch (\Exception $e){
            return false;
        }
        
    }
    
    public static function alipay_pc($trade_no,$QR_row,$data,$user)
    {
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        $qrcode = "alipays%3A%2F%2Fplatformapi%2Fstartapp%3FappId%3D20000123%26actionType%3Dscan%26biz_data%3D%7B%22s%22%3A+%22money%22%2C+%22u%22%3A+%22".$QR_row['zfb_pid']."%22%2C+%22a%22%3A+%22".$money."%22%2C+%22m%22%3A+%22".$data['out_trade_no']."%22%7D";
        $h5url = "alipays://platformapi/startapp?appId=60000105&url=https%3A%2F%2Fwww.alipay.com%2F%3FappId%3D20000123%26actionType%3Dscan%26biz_data%3D%257B%2522a%2522%253A%2522" .$money. "%2522%252C%2522s%2522%253A%2522money%2522%252C%2522u%2522%253A%2522" .$QR_row['zfb_pid']. "%2522%252C%2522m%2522%253A%2522" .$data['out_trade_no']. "%2522%257D";
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => 'alipay',
            'account_id' => $QR_row['id'],
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => $qrcode,
            'h5_qrurl' => $h5url,
            'out_time' => time() + $user['timeout_time'],
        ];
        try {
            M::create($odmodels);
            return true;
        }catch (\Exception $e){
            return false;
        }
        
    }
    
    public static function alipay_dmf($trade_no,$QR_row,$data,$user)
    {
        $request = \think\facade\Request::instance();
        $notifyUrl = str_replace('/submit.php','',$request->root(true)).'/Notify/alipay_dmf';
        $appid = $QR_row['zfb_pid'];//https://open.alipay.com 账户中心->密钥管理->开放平台密钥，填写添加了电脑网站支付的应用的APPID
        $signType = 'RSA2';//签名算法类型，支持RSA2和RSA，推荐使用RSA2
        $rsaPrivateKey=$QR_row['qr_url'];//商户私钥，填写对应签名算法类型的私钥，如何生成密钥参考：https://docs.open.alipay.com/291/105971和https://docs.open.alipay.com/200/105310
        $requestConfigs = array(
            'out_trade_no'=>$data['out_trade_no'],
            'total_amount'=>$data['money'], //单位 元
            'subject'=>$data['name'],  //订单标题
            'timeout_express'=>'2h'       //该笔订单允许的最晚付款时间，逾期将关闭交易。取值范围：1m～15d。m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。 该参数数值不接受小数点， 如 1.5h，可转换为 90m。
        );
        $commonConfigs = array(
            //公共参数
            'app_id' => $appid,
            'method' => 'alipay.trade.precreate',//接口名称
            'format' => 'JSON',
            'charset'=> 'utf-8',
            'sign_type'=>'RSA2',
            'timestamp'=>date('Y-m-d H:i:s'),
            'version'=>'1.0',
            'notify_url' => $notifyUrl,
            'biz_content'=>json_encode($requestConfigs),
        );
        $sign = Jialanshen::sign($rsaPrivateKey,Jialanshen::getSignContent($commonConfigs), $commonConfigs['sign_type']);
        if(!$sign)
        {
            return '密钥错误';
        }
        $commonConfigs["sign"] = $sign;
        $result = Jialanshen::curlPost('https://openapi.alipay.com/gateway.do?charset=utf-8',$commonConfigs);
        $json = json_decode($result,TRUE);
        $json = $json['alipay_trade_precreate_response'];
        if($json['code'] && $json['code']=='10000')
        {
            //生成成功，将订单数据添加到数据库并返回
            if(empty($data['sitename']))
            {
               $data['sitename'] = "";
            }
            $money = $data['money'];
            $qrcode = $json['qr_code'];
            $h5url = "alipays://platformapi/startapp?appId=60000105&url=" .$json['qr_code'];
            $feilv_money = $data['money'] * $user['feilv'] / 100;
            $odmodels = [
                'name' => $data['name'],
                'sitename' => $data['sitename'],
                'type' => 'alipay',
                'account_id' => $QR_row['id'],
                'trade_no' => $trade_no,
                'out_trade_no' => $data['out_trade_no'],
                'notify_url' => $data['notify_url'],
                'return_url' => $data['return_url'],
                'user_id' => $user['id'],
                'money' => $data['money'],
                'truemoney' => $money,
                'feilvmoney' => $feilv_money,
                'status' => '0',
                'create_time' => date('Y-m-d H:i:s', time()),
                'qrcode' => $qrcode,
                'h5_qrurl' => $h5url,
                'out_time' => time() + $user['timeout_time'],
            ];
            try {
                M::create($odmodels);
                return true;
            }catch (\Exception $e){
                return false;
            }
        }
        else
        {
            return false;//返回失败信息
        }
    }

    
    public static function epay_zj($trade_no,$data,$user)
    {
        if(empty($data['sitename'])){
            $data['sitename'] = "";
        }
        $money = $data['money'];
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        $odmodels = [
            'name' => $data['name'],
            'sitename' => $data['sitename'],
            'type' => $data['type'],
            'account_id' => 0,
            'trade_no' => $trade_no,
            'out_trade_no' => $data['out_trade_no'],
            'notify_url' => $data['notify_url'],
            'return_url' => $data['return_url'],
            'user_id' => $user['id'],
            'money' => $data['money'],
            'truemoney' => $money,
            'feilvmoney' => $feilv_money,
            'status' => '0',
            'create_time' => date('Y-m-d H:i:s', time()),
            'qrcode' => '',
            'h5_qrurl' => '',
            'out_time' => time() + $user['timeout_time'],
            'pla_type'=>2
        ];
        try {
            M::create($odmodels);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
    
    
    
    public static function sign($priKey,$data, $signType = "RSA") {
        error_reporting(0);
        $res = "-----BEGIN RSA PRIVATE KEY-----\n" .
            wordwrap($priKey, 64, "\n", true) .
            "\n-----END RSA PRIVATE KEY-----";
        ($res) or die('');
        if ("RSA2" == $signType) {
            openssl_sign($data, $sign, $res, version_compare(PHP_VERSION,'5.4.0', '<') ? SHA256 : OPENSSL_ALGO_SHA256); //OPENSSL_ALGO_SHA256是php5.4.8以上版本才支持
        } else {
            openssl_sign($data, $sign, $res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }
    public static function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    public static function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === Jialanshen::checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = Jialanshen::characet($v, 'utf-8');
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }
    static function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = 'utf-8';
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
                //$data = iconv($fileType, $targetCharset.'//IGNORE', $data);
            }
        }
        return $data;
    }
    public static function curlPost($url = '', $postData = '', $options = array())
    {
        if (is_array($postData)) {
            $postData = http_build_query($postData);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //设置cURL允许执行的最长秒数
        if (!empty($options)) {
            curl_setopt_array($ch, $options);
        }
        //https请求 不验证证书和host
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    public static function rsaCheck($params,$priKey) {
        $sign = $params['sign'];
        $signType = $params['sign_type'];
        unset($params['sign_type']);
        unset($params['sign']);
        return Jialanshen::verify($priKey,Jialanshen::getSignContent($params),$sign,$signType);
    }
    public static function verify($priKey,$data,$sign,$signType = 'RSA') {
        
        $res = "-----BEGIN PUBLIC KEY-----\n" .
            wordwrap($priKey, 64, "\n", true) .
            "\n-----END PUBLIC KEY-----";
        ($res) or die('');
        //调用openssl内置方法验签，返回bool值
        if ("RSA2" == $signType) {
            $result = (bool)openssl_verify($data, base64_decode($sign), $res, version_compare(PHP_VERSION,'5.4.0', '<') ? SHA256 : OPENSSL_ALGO_SHA256);
        } else {
            $result = (bool)openssl_verify($data, base64_decode($sign), $res);
        }
        return $result;
    }
    
    
    
    
    
}
