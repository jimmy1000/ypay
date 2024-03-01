<?php


namespace app\index\controller;
use app\common\controller\Frontend;
use think\facade\Request;
use think\facade\View;
use app\common\service\YiPay as epay;
use think\facade\Db;
use think\facade\Config;
use app\common\service\Jialanshen;
use app\common\model\YpayRisk as Risk;
use app\common\model\YpayUser as YpayUser;

class Pay extends \app\BaseController
{
    /**
     * 发起支付
     */
    public function submit()
    {
        $data = Request::param('','','strip_tags');
        if(empty($data['pid']))
        {
            View::assign('error_tips', "PID不可为空");
            return $this->fetch();
        }
        if(empty($data['out_trade_no']))
        {
            View::assign('error_tips', "订单号不可为空");
            return $this->fetch();
        }
        if(empty($data['type']))
        {
            View::assign('error_tips', "支付类型不可为空");
            return $this->fetch();
        }
        if(empty($data['notify_url']))
        {
            View::assign('error_tips', "异步通知不可为空");
            return $this->fetch();
        }
        if(empty($data['return_url']))
        {
            View::assign('error_tips', "同步通知不可为空");
            return $this->fetch();
        }
        if(empty($data['name']))
        {
            View::assign('error_tips', "商品名称不可为空");
            return $this->fetch();
        }
        if(empty($data['money']))
        {
            View::assign('error_tips', "金额不可为空");
            return $this->fetch();
        }
        $user = YpayUser::where('id',$data['pid'])->find();
        if(empty($user))
        {
            View::assign('error_tips', "商户不存在");
            return $this->fetch();
        }
        if($user['is_frozen']!=0)
        {
            View::assign('error_tips', "该用户已被冻结，请联系站长");
            return $this->fetch();
        }
        $time = strtotime($user['vip_time']);
        if($time<time())
        {
            View::assign('error_tips', "未开通套餐或套餐已过期");
            return $this->fetch();
        }
        if($data['money']<=0)
        {
            View::assign('error_tips', "金额错误");
            return $this->fetch();
        }
        if($data['money']< getConfig()['min_orderprice'])
        {
            View::assign('error_tips', "订单金额低于最低发起金额");
            return $this->fetch();
        }
        if( $data['money'] > getConfig()['max_orderprice'])
        {
            View::assign('error_tips', "订单金额高于最高发起金额");
            return $this->fetch();
        }
        if(strpos($data['name'],"=") !== false)
        {
            View::assign('error_tips', "商品名称违规");
            return $this->fetch();
        }
        $shield_key = getConfig()['shield_key'];
        if(!empty($shield_key))
        {
            $weigui = explode('|',$shield_key);
            for($index=0;$index<count($weigui);$index++)
            {
                if(empty($weigui[$index]))
                {
                    continue;
                }
                if(strpos($data['name'],$weigui[$index]) !== false)
                {
                    $risk_data = [
                        'user_id' =>$data['pid'], 
                        'name' =>$data['name'],
                        'url' => $data['return_url']
                    ];
                    try {
                        Risk::create($risk_data);
                    }catch (\Exception $e){
                        View::assign('error_tips', getConfig()['shield_tips']);
                        return $this->fetch();
                    }
                    View::assign('error_tips', getConfig()['shield_tips']);
                    return $this->fetch();
                }
            }
        }
        
        //如果没开通会员套餐/或者老版本VIP体系则不进入限额
        if($user['vip_id'] != 0){
        
            $vip = Db::table('ypay_vip')->where('id',$user['vip_id'])->find();
            
            //判断是否开启收款限额
            if($vip['is_quota']){
                $today_money = Db::table('ypay_order')->where(['status' => 1,'user_id' => $user['id']])->whereDay('create_time')->sum('money');
                if( $today_money > $vip['today_quota']){
                    View::assign('error_tips', "今日收款累计超过".$vip['today_quota']."的收款限额");
                    return $this->fetch();
                }
            }
        }
        $feilv_money = $data['money'] * $user['feilv'] / 100;
        if($user['money']<$feilv_money)
        {
            View::assign('error_tips', "账户余额不足,无法发起支付");
            return $this->fetch();
        }
        $epay = new epay();
        $isSign = $epay->getEpaySignVeryfy($data,$data["sign"],$user['user_key']); //生成签名结果
        if(!$isSign)
        {
            View::assign('error_tips', "验签失败,请检查PID或者Key是否正确");
            return $this->fetch();
        }
        $is_orderNo = Db::table('ypay_order')->where('out_trade_no', $data['out_trade_no'])->find();
        if($is_orderNo && $is_orderNo['account_id'] != 0)
        {
            View::assign('error_tips', "订单号重复,请重新发起");
            return $this->fetch();
        }
        $trade_no='Y'.date("YmdHis").rand(11111,99999);
        $QR_row =  Db::name('ypay_account')->where('type',$data['type'])->where('user_id',$data['pid'])->where('status',1)->where('is_status',1)->orderRaw('rand()')->find();//随机获取通道
        if(empty($QR_row))
        {
            if($user['switch_type'] == 'epay')
                {
                    //转接订单
                    $orderdata = [
                        "pid"         => $data['pid'],//商户ID
                        "type"       => $data['type'],//支付方式
                        "out_trade_no"     => $data['out_trade_no'], //商户订单号
                        "notify_url" =>  $data['notify_url'],//异步通知地址
                        "return_url" =>  $data['return_url'],//同步通知地址
                        "name" => $data['name'], //商品名称
                        "money"      => $data['money'],//订单金额
                    ];
                    $res = Jialanshen::epay_zj($trade_no,$orderdata,$user);
                    //转接订单创建完毕
                    if($res)//进入转接流程
                    {
                        $request = \think\facade\Request::instance();
                        $notify_url = str_replace('/submit.php','',$request->root(true)).'/Notify/epay_notifyzj';
                        $return_url = str_replace('/submit.php','',$request->root(true)).'/Notify/epay_returnzj';
                        $datas = [
                            "pid"         => $user['switch_id'],//商户ID
                            "type"       => $data['type'],//支付方式
                            "out_trade_no"     => $data['out_trade_no'], //商户订单号
                            "notify_url" =>  $notify_url,//异步通知地址
                            "return_url" =>  $return_url,//同步通知地址
                            "name" => $data['name'], //商品名称
                            "money"      => $data['money'],//订单金额
                        ];
                        $epayzj = new epay($user['switch_id'],$user['switch_key'],$user['switch_url']);
                        $res = $epayzj->buildRequestForm($datas);
                        echo($res);
                        die;
                    }
                    else
                    {
                        View::assign('error_tips', "订单创建失败请重试");
                        return $this->fetch();
                    }
                }
            
            View::assign('error_tips', "暂无收款账号在线");
            return $this->fetch();
        }
        $action = $QR_row['code'];
        $res = Jialanshen::$action($trade_no,$QR_row,$data,$user);
        if($res)
        {
            exit("<script>window.location.href='/Pay/console?trade_no={$trade_no}';</script>");
        }
        else
        {
            View::assign('error_tips', "订单生成错误,请重新发起支付");
            return $this->fetch();
        }
    }
    
    public function console($trade_no='')
    {
        if (Request::isAjax()){
            $data = Request::param('','','strip_tags');
            $trade_no = $data['TradeNo'];
            if(empty($trade_no))
            {
                return json(['code'=>0,'msg'=>'订单号为空!']);
            }
            $order_row = Db::name('ypay_order')->where('trade_no', $trade_no)->find();
            if(empty($order_row))
            {
                return json(['code'=>0,'msg'=>'订单不存在!']);
            }
            if($order_row['status']==1)
            {
                $u = Jialanshen::creat_callback($order_row);
                return json(['code'=>200,'msg'=>'订单支付成功!','url'=>$u['return']]);
            }
            if($order_row['out_time']<time())
            {
                return json(['code'=>0,'msg'=>'订单超时!']);
            }
            $qr_row = Db::name('ypay_account')->where('id', $order_row['account_id'])->find();
            if(empty($qr_row))
            {
                return json(['code'=>0,'msg'=>'通道不存在!']);
            }
            if($qr_row['code']!='wxpay_cloudzs' && $qr_row['code']!='wxpay_skd')
            {
                $order_row['qrcode'] ='/qrcode.php?text='.$order_row['qrcode'];
            }
            return json(['code'=>100,'msg'=>'二维码获取成功!','qr_url'=>$order_row['qrcode']]);
        }
        $order = Db::name('ypay_order')->where('trade_no', $trade_no)->find();
        $user = Db::name('ypay_user')->where('id', $order['user_id'])->find();
        $acc = Db::name('ypay_account')->where('id', $order['account_id'])->find();
        $ms = $order['out_time']-time();
        View::assign('order',$order);
        View::assign('ms',$ms);
        View::assign('code',$acc['code']);
        View::assign('console_notity',$user['console_notity']);
        View::assign('timeout_url',$user['timeout_url']);
        View::assign('yuyin_tips',$user['yuyin_tips']);
        View::assign('is_payPopUp',$user['is_payPopUp']);
        return $this->fetch($user['console_temp']);
    }
    
    public function console_dopay($trade_no='')
    {
        if (Request::isAjax()){
            $data = Request::param('','','strip_tags');
            $trade_no = $data['TradeNo'];
            if(empty($trade_no))
            {
                return json(['code'=>0,'msg'=>'订单号为空!']);
            }
            $order_row = Db::name('ypay_order')->where('trade_no', $trade_no)->find();
            if(empty($order_row))
            {
                return json(['code'=>0,'msg'=>'订单不存在!']);
            }
            
            if($order_row['status']==1)
            {
                $u = Jialanshen::creat_callback($order_row);
                return json(['code'=>200,'msg'=>'订单支付成功!','url'=>$u['return']]);
            }
            if($order_row['out_time']<time())
            {
                return json(['code'=>0,'msg'=>'订单超时!']);
            }
            $order_row['qrcode'] ='/qrcode.php?text='.$order_row['qrcode'];
            return json(['code'=>100,'msg'=>'二维码获取成功!','qr_url'=>$order_row['qrcode']]);
        }
        $order = Db::name('ypay_order')->where('trade_no', $trade_no)->find();
        $user = Db::name('ypay_user')->where('id', $order['user_id'])->find();
        $ms = $order['out_time']-time();
        View::assign('order',$order);
        View::assign('ms',$ms);
        View::assign('code','alipay_dmf');
        View::assign('console_notity',$user['console_notity']);
        View::assign('timeout_url',$user['timeout_url']);
        View::assign('yuyin_tips',$user['yuyin_tips']);
        View::assign('is_payPopUp',$user['is_payPopUp']);
        return $this->fetch();
    }
    
    public function apisubmit()
    {
        $data = Request::param('','','strip_tags');
        if(empty($data['pid']))
        {
            return json(['code'=>0,'msg'=>'PID不可为空!']);
        }
        if(empty($data['out_trade_no']))
        {
            return json(['code'=>0,'msg'=>'订单号不可为空!']);
        }
        if(empty($data['type']))
        {
            return json(['code'=>0,'msg'=>'支付类型不可为空!']);
        }
        if(empty($data['notify_url']))
        {
            return json(['code'=>0,'msg'=>'异步通知不可为空!']);
        }
        if(empty($data['return_url']))
        {
            return json(['code'=>0,'msg'=>'同步通知不可为空!']);
        }
        if(empty($data['name']))
        {
            return json(['code'=>0,'msg'=>'商品名称不可为空!']);
        }
        if(empty($data['money']))
        {
            return json(['code'=>0,'msg'=>'金额不可为空!']);
        }
        $user = Db::table('ypay_user')->where('id',$data['pid'])->find();
        if(empty($user))
        {
            return json(['code'=>0,'msg'=>'商户不存在!']);
        }
        $time = strtotime($user['vip_time']);
        if($time<time())
        {
            return json(['code'=>0,'msg'=>'未开通套餐或套餐已过期!']);
        }
        if($data['money']<=0)
        {
            return json(['code'=>0,'msg'=>'金额错误!']);
        }
        if($data['money']< getConfig()['min_orderprice'])
        {
            return json(['code'=>0,'msg'=>'订单金额低于最低发起金额!']);
        }
        if( $data['money'] > getConfig()['max_orderprice'])
        {
            return json(['code'=>0,'msg'=>'订单金额高于最高发起金额!']);
        }
        if(!empty(getConfig()['shield_key']))
        {
            $weigui = explode('|',getConfig()['shield_key']);
            for($index=0;$index<count($weigui);$index++)
            {
                if(empty($weigui[$index]))
                {
                    continue;
                }
                if(strpos($data['name'],$weigui[$index]) !== false)
                {
                    $risk_data = [
                        'user_id' =>$data['pid'], 
                        'name' =>$data['name'],
                        'url' => $data['return_url']
                    ];
                    try {
                        Risk::create($risk_data);
                    }catch (\Exception $e){
                        View::assign('error_tips', "商品违规,已记录");
                        return $this->fetch();
                    }
                    View::assign('error_tips', "商品违规,已记录");
                    return $this->fetch();
                }
            }
        }
        $epay = new epay();
        $isSign = $epay->getEpaySignVeryfy($data,$data["sign"],$user['user_key']); //生成签名结果
        if(!$isSign)
        {
            return json(['code'=>0,'msg'=>'验签失败,请检查PID或者Key是否正确!']);
        }
        $is_orderNo = Db::table('ypay_order')->where('out_trade_no', $data['out_trade_no'])->find();
        if($is_orderNo)
        {
            return json(['code'=>0,'msg'=>'订单号重复,请重新发起!']);
        }
        $trade_no='Y'.date("YmdHis").rand(11111,99999);
        $QR_row =  Db::name('ypay_account')->where('type',$data['type'])->where('user_id',$data['pid'])->where('status',1)->where('is_status',1)->orderRaw('rand()')->find();//随机获取通道
        if(empty($QR_row))
        {
            return json(['code'=>0,'msg'=>'暂无收款账号在线!']);
        }
        $action = $QR_row['code'];
        $res = Jialanshen::$action($trade_no,$QR_row,$data,$user);
        if($res)
        {
            $order = Db::name('ypay_order')->where('trade_no', $trade_no)->find();
            $data = array(
                    'code'=>1,
                    'msg'=>'获取成功!',
                    'trade_no'=>$order['trade_no'],
                    'qrcode'=>$order['qrcode'],
                    'h5_qrurl'=>$order['h5_qrurl'],
                    'type'=>$order['type'],
                    'out_trade_no'=>$order['out_trade_no'],
                    'money'=>$order['truemoney'],
                );
            return json($data);
        }
        else
        {
            $data = array(
                    'code'=>0,
                    'msg'=>'订单生成错误,请重新发起支付!',
                );
            return json($data);
        }
    }
    
    
    public function chaorder($trade_no='')
    {
        if(empty($trade_no))
        {
            return json(['code'=>0,'msg'=>'请输入订单号!']);
        }
        $order = Db::name('ypay_order')->where('trade_no', $trade_no)->find();
        return json(['code'=>1,'msg'=>'获取成功!','data'=>$order]);
    }
    
    
    public function reg($trade_no='',$typeid='')
    {
        if(empty($trade_no))
        {
            exit('请输入订单号');
        }
        $order = Db::name('ypay_regorder')->where('out_trade_no', $trade_no)->find();
        if(empty($order))
        {
            exit('订单不存在');
        }
        if($typeid=="alipay")
        {
            $paytype = "alipay";
            $front_type ="ali";
        }
        else
        {
            $paytype = "wxpay";
            $front_type ="wechat";
        }
        //修改数据库订单支付方式标识
        Db::name('ypay_regorder')->where('id',$order['id'])->update(['type' =>$paytype]);
        $request = \think\facade\Request::instance();
        //组装支付数据
        $datas = [
            "pid"         => getConfig()[$front_type . '_epay_id'],//商户ID
            "type"       => $paytype,//支付方式
            "out_trade_no"     => $trade_no, //商户订单号
            "notify_url" =>  $request->root(true).'/Notify/regnotify_epay',//异步通知地址
            "return_url" =>  $request->root(true).'/Notify/regretify_epay',//同步通知地址
            "name" => "用户注册", //商品名称
            "money"      => getConfig()['paid_reg_price'],//订单金额
        ];
        $epay = new epay(getConfig()[$front_type . '_epay_id'],getConfig()[$front_type . '_epay_key'],getConfig()[$front_type . '_epay_url']);
        $res = $epay->buildRequestForm($datas);
        echo($res);
        die;
    }
    
    
    
}
