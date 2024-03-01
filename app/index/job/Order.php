<?php


namespace app\index\job;


use think\facade\Db;
use think\queue\Job;
use app\common\service\Jialanshen;
use app\common\util\Mail;
use app\common\core\core;


class Order
{

    /**
     * 在宝塔里的  Supervisord管理器==添加手护进程
     * 名称就是 队列名称，启动命令是：php think queue:listen --queue +队列名
     * 启动用户：root
     * @队列执行
     * @param Job $job
     * @param [type] $param
     *
     * @return void
     */
    public function fire(Job $job, $param)
    {
        try {
            //参数
            $data = $param;
            /*操作开始 */
            $res = $this->handleOrder($data['code']);
            $job->delete();
        }catch (\Exception $exception){
            $job->delete();
            record_log($exception->getMessage(),"exception");
        }
    }

    /**
     * @处理数据
     * @param [type] $id
     *
     * @return void
     */
    public function handleOrder($code)
    {
        //创建core对象
        $core = new Core();
        //根据标识来进行处理心跳
        switch ($code) {
            case 'alipay_grmg'://支付宝个人免挂
                $list = Db::name('ypay_account')->where('code','alipay_grmg')->where('status', 1)->where('is_status', 1)->select();
                if(empty($list))
                {
                    break;
                }
                //执行保活
                foreach ($list as $row)
                {
                    $cookie = base64_decode($row['cookie']);
                    
                    
                    try {
                        $BeatMoney = $core->BaoHuo($cookie);
                        Db::name('ypay_account')->where('id', $row['id'])->update(['update_time'=>date('Y-m-d H:i:s', time())]);
                        if($BeatMoney== -1)
                        {
                            $BeatMoney = $core->BaoHuo2($cookie);
                        }
                    }catch (\Exception $exception){
                        $BeatMoney = -1 ;
                    }
                    
                    if($BeatMoney!= -1)
                    {
                        if($row['money']!=$BeatMoney)
                        {
                            Db::name('ypay_account')->where('id', $row['id'])->update(['money' =>$BeatMoney]);
                            $od_money = bcsub($BeatMoney, $row['money'], 2);
                            $order = Db::name('ypay_order')->where('account_id',$row['id'])->where('status',0)->where('truemoney',$od_money)->where('out_time','>',time())->order('id desc')->find();
                            if(!empty($order))
                            {
                                $url = Jialanshen::creat_callback($order);
                                get_curl($url['notify']);
                            }
                        }
                    }
                    else
                    {
                        Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                        $user = Db::name('ypay_user')->find($row['user_id']);
                        if($user['lose_tips'] == 1){
                             Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有支付宝通道已掉线，通道ID为：'.$row['id']);
                        }
                    }
                }
                break;
            case 'alipay_allmg'://支付宝通用通道
                $list = Db::name('ypay_account')->where('code','alipay_allmg')->where('status', 1)->where('is_status', 1)->select();
                if(empty($list))
                {
                    break;
                }
                foreach ($list as $row)
                {
                    $cookie = base64_decode($row['cookie']);
                    $allBeat = $core->BaoHuo($cookie);
                    if($allBeat == -1)
                    {
                        $allBeat = $core->BaoHuo2($cookie);
                    }
                    if($allBeat== -1)
                    {
                        Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                        $user = Db::name('ypay_user')->find($row['user_id']);
                        if($user['lose_tips'] == 1){
                        Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有支付宝通道已掉线，通道ID为：'.$row['id']);
                        }
                        continue;
                    }
                    $count = Db::name('ypay_order')->where('status',0)->where('account_id',$row['id'])->where('out_time','>',time())->count();
                    if($count>0)//有未完成的订单
                    {
                        $time = strtotime($row['update_time']);
                        if(($time + 5) < time())
                        {
                            Db::name('ypay_account')->where('id', $row['id'])->update(['update_time'=>date('Y-m-d H:i:s', time())]);
                            $m = $core->GetMobileOrderDetail($cookie,$row['zfb_pid']);
                            if(empty($m['result']))
                            {
                                Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                                $user = Db::name('ypay_user')->find($row['user_id']);
                                if($user['lose_tips'] == 1){
                                Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有支付宝通道已掉线，通道ID为：'.$row['id']);
                                }
                                continue;
                            }
                            else
                            {
                                $time = strtotime($m['result']['detail'][0]['gmtSuccess']);
                                $pdtime = time() - 300;
                                if($time>$pdtime)//订单为5分钟内的订单
                                {
                                    if($time>$row['tong_time'] ||empty($row['tong_time']))
                                    {
                                        $money = $m['result']['detail'][0]['transferAmount'];
                                        Db::name('ypay_account')->where('id', $row['id'])->update(['tong_time' =>$time]);
                                        $order = Db::name('ypay_order')->where('account_id',$row['id'])->where('status',0)->where('truemoney',$money)->where('out_time','>',time())->order('id desc')->find();
                                        if(!empty($order))
                                        {
                                            $url = Jialanshen::creat_callback($order);
                                            get_curl($url['notify']);
                                        }
                                    }
                                }
                
                            }
                        }
                    }
                    
                    
                }
                break;
            case 'alipay_mg'://支付宝商家版
                $mglist = Db::name('ypay_account')->where('code','alipay_mg')->where('status', 1)->where('is_status', 1)->select();
                if(empty($mglist))
                {
                    break;
                }
                foreach ($mglist as $row)
                {
                    $cookie = base64_decode($row['cookie']);
                    $Beat = $core->BaoHuo($cookie);
                    
                    if($Beat == -1)
                    {
                        $Beat = $core->BaoHuo2($cookie);
                    }
                    if($Beat == -1)
                    {
                        Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                        $user = Db::name('ypay_user')->find($row['user_id']);
                        if($user['lose_tips'] == 1){
                        Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有支付宝通道已掉线，通道ID为：'.$row['id']);
                        }
                        continue;
                    }
                    $count = Db::name('ypay_order')->where('status',0)->where('account_id',$row['id'])->where('out_time','>',time())->count();
                    if($count>0)//有未完成的订单
                    {
                        $time = strtotime($row['update_time']);
                        if(($time + 5) < time())
                        {
                            Db::name('ypay_account')->where('id', $row['id'])->update(['update_time'=>date('Y-m-d H:i:s', time())]);
                            $orders = $core->getAliOrder($cookie,$row['zfb_pid']);
                            if(empty($orders))
                            {
                                Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                                $user = Db::name('ypay_user')->find($row['user_id']);
                                if($user['lose_tips'] == 1){
                                Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有支付宝通道已掉线，通道ID为：'.$row['id']);
                                }
                                continue;
                            }
                            if($orders['status']==='deny')
                            {
                                Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                                $user = Db::name('ypay_user')->find($row['user_id']);
                                if($user['lose_tips'] == 1){
                                Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有支付宝通道已掉线，通道ID为：'.$row['id']);
                                }
                                continue;
                            }
                            $_orderlist=empty($orders['result']['detail'])?array():$orders['result']['detail'];
                            if(!empty($_orderlist))
                            {
                                //遍历订单
                                $_order=[];
                                $orderrow=null;
                                foreach ($_orderlist as $order)
                                {
                                    $orderrow=null;
                                    $pay_money=$order['tradeAmount'];//⾦额
                                    $pay_des=$order['transMemo'];//备注
                                    $tradeNo=$order['tradeNo'];//⽀付宝订单号
                                    if(!empty($pay_des) && $pay_des!="转账")
                                    {
                                        $orderrow = Db::name('ypay_order')->where('out_trade_no',$pay_des)->where('status',0)->where('account_id',$row['id'])->where('truemoney',sprintf("%.2f",$pay_money))->where('out_time','>',time())->order('id desc')->find();
                                        if(!empty($orderrow))
                                        {
                                            $url = Jialanshen::creat_callback($orderrow);
                                            get_curl($url['notify']);
                                        }
                                    }
                                    
                                }
                        
                            }
                        }
                        
                    }
                }
                break;
            case 'wxpay_cron'://微信云端通道
                $list = Db::name('ypay_account')->where('type','wxpay')->where('code','<>','wxpay_dy')->where('code','<>','wxpay_zg')->where('code','<>','wxpay_app')->where('status', 1)->where('is_status', 1)->select();
                if(empty($list))
                {
                    break;
                }
                foreach($list as $row)
                {
                    if($row['code']=='wxpay_ipad')
                    {
                        
                    }
                    else
                    {
                        $o_count = Db::name('ypay_order')->where('account_id',$row['id'])->where('out_time','>',time())->count();
                        
                        if($o_count>0)
                        {
                            $res = $core->SuccessOrder($row['vcloudurl'],$row['wx_guid'],$row['code']);
                            
                             if(!empty($res->data) && $res->code==1)
                             {
                                foreach ($res->data as $item)
                                {
                                    if($row['code']=='wxpay_cloudzs' || $row['code']=='wxpay_skd')
                                    {
                                        $order = Db::name('ypay_order')->where('account_id',$row['id'])->where('id',$item->trade_no)->where('status',0)->where('type','wxpay')->where('money',$item->money)->find();
                                        if(!empty($order))
                                        {
                                            $url = Jialanshen::creat_callback($order);
                                            get_curl($url['notify']);
                                        }
                                    }
                                    else
                                    {
                                        $order = Db::name('ypay_order')->where('out_trade_no',$item->trade_no)->where('status',0)->where('account_id',$row['id'])->where('money',$item->money)->find();
                                        if(!empty($order))
                                        {
                                            $url = Jialanshen::creat_callback($order);
                                            get_curl($url['notify']);
                                        }
                                    }
                                }
                             }
                        }
                        $time = strtotime($row['update_time']);
                        if($time + "120" < time())
                        {
                            $res = $core->WXKaleBeat($row['vcloudurl'],$row['wx_guid']);
                            Db::name('ypay_account')->where('id', $row['id'])->update(['update_time'=>date('Y-m-d H:i:s', time())]);
                            if(empty($res))
                            {
                                Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                                $user = Db::name('ypay_user')->find($row['user_id']);
                                if($user['lose_tips'] == 1){
                                Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有微信通道已掉线，通道ID为：'.$row['id']);
                                }
                            }
                            if($res->code!=1)
                            {
                                Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                                $user = Db::name('ypay_user')->find($row['user_id']);
                                if($user['lose_tips'] == 1){
                                Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有微信通道已掉线，通道ID为：'.$row['id']);
                                }
                            }
                        }
                    }
                    
                }
                break;
            case 'qqpay_cron'://QQ软件版通道监控
                $list = Db::name('ypay_account')->where('type','qqpay')->where('status', 1)->where('is_status', 1)->select();
                if(empty($list))
                {
                    break;
                }

                foreach ($list as $row)
                {
                    if($row['code']=="qqpay_cloud")//软件版
                    {
                        try {
                            //检查状态
                        //$onlist = $core->Api_GetOnlineQQlist();
                        if(empty($row['qq']))
                        {
                            Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                            $user = Db::name('ypay_user')->find($row['user_id']);
                            if($user['lose_tips'] == 1){
                            Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有QQ通道已掉线，通道ID为：'.$row['id']);
                            }
                            continue;
                        }
                    
                        if(empty($row['money']))
                        {
                            $row['money'] = 0;
                        }
                        //获取余额
                        $money = $core->Api_QueryBalance($row['qq']);
                        if($money>$row['money'])
                        {
                            Db::name('ypay_account')->where('id',$row['id'])->update(['money' =>$money]);
                            $order = Db::name('ypay_order')->where('account_id',$row['id'])->where('status',0)->where('truemoney',bcsub($money, $row['money'], 2))->where('out_time','>',time())->order('id desc')->find();
                            if(!empty($order))
                            {
                                $url = Jialanshen::creat_callback($order);
                                get_curl($url['notify']);
                            }
                        }
                        else
                        {
                            Db::name('ypay_account')->where('id',$row['id'])->update(['money' =>$money]);
                            continue;
                        }
                           
                        }catch (\Exception $exception)
                        {
                            Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                            $user = Db::name('ypay_user')->find($row['user_id']);
                            if($user['lose_tips'] == 1){
                            Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有QQ通道已掉线，通道ID为：'.$row['id']);
                            }
                            continue;
                        }
                        
                        
                    }
                    else//QQ本地免挂
                    { 
                        
                        try {
                            $cookie = base64_decode($row['cookie']);
                            $odlist = $core->GetOrder($row['qq'],$cookie);//获取订单
                            $arr = json_decode($odlist, true);
                            if(empty($arr))
                            {
                                Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                                $user = Db::name('ypay_user')->find($row['user_id']);
                                if($user['lose_tips'] == 1){
                                Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有QQ通道已掉线，通道ID为：'.$row['id']);
                                }
                                continue;
                            }
                            if($arr['retcode'] != 0 && $arr['retmsg'] != 'OK')
                            {
                                Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                                $user = Db::name('ypay_user')->find($row['user_id']);
                                if($user['lose_tips'] == 1){
                                Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有QQ通道已掉线，通道ID为：'.$row['id']);
                                }
                                continue;
                            }
                            if(!empty($arr['records'][0]))
                            {
                                $param = $arr['records'][0];
                                $money = $param['price'] / 100;
                                $sp_billno = $param['sp_billno'];
                                if($sp_billno!=$row['remark'])
                                {
                                    Db::name('ypay_account')->where('id',$row['id'])->update(['money' =>$money,'remark'=>$sp_billno]);
                                    $order = Db::name('ypay_order')->where('account_id',$row['id'])->where('status',0)->where('truemoney',$money)->where('out_time','>',time())->order('id desc')->find();
                                    if(!empty($order))
                                    {
                                        $url = Jialanshen::creat_callback($order);
                                        get_curl($url['notify']);
                                    }
                                }
                            }
                        
                        }catch (\Exception $exception)
                        {
                            Db::name('ypay_account')->where('id',$row['id'])->update(['status' => 0]);//掉线
                            $user = Db::name('ypay_user')->find($row['user_id']);
                            if($user['lose_tips'] == 1){
                            Mail::go($user['email'],getConfig()['sitename'].'平台掉线通知','你好！，您有QQ通道已掉线，通道ID为：'.$row['id']);
                            }
                            continue;
                        }
                        
                        
                    }
                }
                break;
            default:
                // code...
                //break;
        }
        return true;
    }

    /**
     * @执行失败
     * @param [type] $data
     *
     * @return void
     */
    public function failed($data){
        // 记录日志
        record_log($data,'job_error');
    }

}