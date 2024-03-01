<?php
declare (strict_types = 1);

namespace app\index\controller;
use think\facade\Session;
use think\facade\Request;
use app\common\model\YpayUser as M;
use think\facade\Config;
use think\facade\Db;
use app\common\util\Mail;
use app\common\service\Jialanshen;
use app\common\service\YiPay as epay;
use app\common\service\Third;
use app\common\service\YpayUser as S;

class Notify extends \app\BaseController
{
    
    //异步通知
    public function notify_epay()
    {
        $data = Request::param('','','strip_tags');
        if($data['type']=='wxpay'){
            $type = 'wx';
            $front_type = 'wechat';
        }else{
            $type = 'ali';
            $front_type = 'ali';
        }
        $user_key = getConfig()[$front_type.'_epay_key'];
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
                M::money($ods['money'],$ods['user_id'], '商户在线充值');
                $user = Db::name('ypay_user')->where('id', $ods['user_id'])->find();
                
                //判断是否开启返利功能
                if(getConfig()['is_aff'] && !empty($user['superior_id']) && !empty(getConfig()['aff_percentage']) && getConfig()['aff_type'] == 0){
                  $aff_money   = $ods['money']*getConfig()['aff_percentage'];
                 M::money("+".$aff_money,$user['superior_id'], '下级充值返利');
                 M::where('id',$user['superior_id'])->inc('money', $aff_money);
                }
                echo 'success'; die;
            }
            else
            {
                echo 'success'; die;
            }
        }
    }
    
    //充值同步通知
    public function return_epay()
    {
        $data = Request::param('','','strip_tags');
        if($data['type']=='wxpay'){
            $type = 'wx';
            $front_type = 'wechat';
        }else{
            $type = 'ali';
            $front_type = 'ali';
        }
        $user_key = getConfig()[$front_type.'_epay_key'];
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
                M::money($ods['money'],$ods['user_id'], '商户在线充值');
                $user = Db::name('ypay_user')->where('id', $ods['user_id'])->find();
                //判断是否开启返利功能
                if(getConfig()['is_aff'] && !empty($user['superior_id']) && !empty(getConfig()['aff_percentage']) && getConfig()['aff_type'] == 0){
                  $aff_money   = $ods['money']*getConfig()['aff_percentage'];
                 M::money("+".$aff_money,$user['superior_id'], '下级充值返利');
                 M::where('id',$user['superior_id'])->inc('money', $aff_money);
                }
                return redirect(Request::root().'/User/Index');
            }
            else
            {
                return redirect(Request::root().'/User/Index');
            }
        }
    }
    
    //付费注册异步通知
    public function regnotify_epay()
    {
        $data = Request::param('','','strip_tags');
        if($data['type']=='wxpay'){
            $type = 'wx';
            $front_type = 'wechat';
        }else{
            $type = 'ali';
            $front_type = 'ali';
        }
        $user_key = getConfig()[$front_type.'_epay_key'];
        $epay = new epay();
        $isSign = $epay->getEpaySignVeryfy($data,$data["sign"],$user_key); //生成签名结果
        if(!$isSign)
        {
            echo 'fail'; die;
        }
        else
        {
            $ods = Db::name('ypay_regorder')->where('out_trade_no', $data['out_trade_no'])->find();
            if($ods['status']==0)
            {
                //变更订单状态
                Db::name('ypay_regorder')->where('id', $ods['id'])->update(['status' =>1,'end_time'=>date('Y-m-d H:i:s', time())]);
                //创建用户
                try {
                    M::create(json_decode($ods['regdata'],true));
                    }catch (\Exception $e){
                        return ['msg'=>'操作失败'.$e->getMessage(),'code'=>201];
                    }
                
                echo 'success'; die;
            }
            else
            {
                echo 'success'; die;
            }
        }
    }
    
    public function regretify_epay()
    {
        return redirect(Request::root().'/User/Login');
    }
    
    //店员密钥验证
    public function shop_auth($apikey='')
    {
        $shopkey = getConfig()['clerk_key'];
        if(empty($apikey))
        {
            return json(['code'=>0,'msg'=>'请设置密钥信息!']);
        }
        if(empty($shopkey))
        {
            return json(['code'=>0,'msg'=>'请设置密钥信息!']);
        }
        if($shopkey!=$apikey)
        {
            return json(['code'=>0,'msg'=>'通讯密钥有误!']);
        }
        else
        {
            return json(['code'=>1,'msg'=>'密钥验证成功!']);
        }
    }
    
    //微信店员通知地址
    public function wechat_notify($apikey='',$money='',$wxname='')
    {
        $shopkey = getConfig()['clerk_key'];
        if(empty($apikey))
        {
            return json(['code'=>0,'msg'=>'请设置密钥信息!']);
        }
        if(empty($wxname))
        {
            return json(['code'=>0,'msg'=>'请修改收款账号的昵称!']);
        }
        if(empty($money))
        {
            return json(['code'=>0,'msg'=>'金额不可为空!']);
        }
        if(empty($shopkey))
        {
            return json(['code'=>0,'msg'=>'请设置密钥信息!']);
        }
        if($shopkey!=$apikey)
        {
            return json(['code'=>0,'msg'=>'通讯密钥有误!']);
        }
        $vaccount = Db::name('ypay_account')->where('wxname', $wxname)->find();
        if(empty($vaccount))
        {
            return json(['code'=>0,'msg'=>'收款账号昵称不存在!']);
        }
        $order = Db::name('ypay_order')->where('account_id',$vaccount['id'])->where('status',0)->where('type','wxpay')->where('truemoney',$money)->where('out_time','>',time())->order('id desc')->find();
        if(!empty($order))
        {
            $url = Jialanshen::creat_callback($order);
            get_curl($url['notify']);
            return json(['code'=>1,'msg'=>'回调成功!']);
        }
        else
        {
            return json(['code'=>0,'msg'=>'订单超时或者不存在!']);
        }
    }
    
    public function app_auth($apiid,$apikey)
    {
        $user = Db::name('ypay_user')->where('id',$apiid)->where('appkey',$apikey)->find();
        if(empty($user))
        {
            return json(['code'=>0,'msg'=>'商户不存在或密钥错误!']);
        }
        return json(['code'=>1,'msg'=>'密钥验证成功!']);
    }
    
    public function appnotify($apiid,$apikey,$money,$type,$channel)
    {
        $user = Db::name('ypay_user')->where('id',$apiid)->where('appkey',$apikey)->find();
        if(empty($user))
        {
            return json(['code'=>0,'msg'=>'商户不存在或密钥错误']);
        }
        if(empty($money) || empty($type) || empty($channel))
        {
            return json(['code'=>0,'msg'=>'参数不可为空']);
        }
        if($channel==0)
        {
            return json(['code'=>1,'msg'=>'不发起回调']);
        }
        $vaccount = Db::name('ypay_account')->where('id',$channel)->where('type', $type)->find();
        if(empty($vaccount))
        {
            return json(['code'=>0,'msg'=>'通道不存在']);
        }
        $order = Db::name('ypay_order')->where('account_id',$vaccount['id'])->where('status',0)->where('truemoney',$money)->where('out_time','>',time())->order('id desc')->find();
        if(!empty($order))
        {
            $url = Jialanshen::creat_callback($order);
            get_curl($url['notify']);
            return json(['code'=>1,'msg'=>'回调成功!']);
        }
        else
        {
            return json(['code'=>0,'msg'=>'订单超时或不存在']);
        }
    }
    
    public function ali_auth($apiid='',$apikey='',$channel='',$pid='')
    {
        if(empty($apiid)  || empty($apikey)  || empty($channel)  || empty($pid))
        {
            return json(['code'=>100,'msg'=>'参数不可为空']);
        }
        $user = Db::name('ypay_user')->where('id',$apiid)->where('appkey',$apikey)->find();
        if(empty($user))
        {
            return json(['code'=>0,'msg'=>'商户不存在或密钥错误!']);
        }
        //更新状态
        Db::name('ypay_account')->where('id', $channel)->update(['status' =>1,'zfb_pid'=>$pid]);
        return json(['code'=>1,'msg'=>'密钥验证成功!']);
    }
    
    public function ali_checkorder($apiid,$apikey,$channel)
    {
        $user = Db::name('ypay_user')->where('id',$apiid)->where('appkey',$apikey)->find();
        if(empty($user))
        {
            return json(['code'=>100,'msg'=>'商户不存在或密钥错误']);
        }
        if(empty($apiid)  || empty($apikey)  || empty($channel))
        {
            return json(['code'=>100,'msg'=>'参数不可为空']);
        }
        if($channel==0)
        {
            return json(['code'=>100,'msg'=>'不发起回调']);
        }
        $vaccount = Db::name('ypay_account')->where('id',$channel)->where('code', 'alipay_pc')->find();
        if(empty($vaccount))
        {
            return json(['code'=>100,'msg'=>'通道不存在']);
        }
        $order = Db::name('ypay_order')->where('account_id',$vaccount['id'])->where('status',0)->where('out_time','>',time())->order('id desc')->count();
        return json(['code'=>$order,'msg'=>'返回成功']);
    }
    
    public function alinotify($apiid,$apikey,$money,$channel,$memo)
    {
        $user = Db::name('ypay_user')->where('id',$apiid)->where('appkey',$apikey)->find();
        if(empty($user))
        {
            return json(['code'=>0,'msg'=>'商户不存在或密钥错误']);
        }
        if(empty($money) || empty($memo) || empty($channel))
        {
            return json(['code'=>0,'msg'=>'参数不可为空']);
        }
        if($channel==0)
        {
            return json(['code'=>1,'msg'=>'不发起回调']);
        }
        $vaccount = Db::name('ypay_account')->where('id',$channel)->where('code', 'alipay_pc')->find();
        if(empty($vaccount))
        {
            return json(['code'=>0,'msg'=>'通道不存在']);
        }
        $order = Db::name('ypay_order')->where('account_id',$vaccount['id'])->where('status',0)->where('out_trade_no',$memo)->where('truemoney',$money)->where('out_time','>',time())->order('id desc')->find();
        if(!empty($order))
        {
            $url = Jialanshen::creat_callback($order);
            get_curl($url['notify']);
            return json(['code'=>1,'msg'=>'回调成功!']);
        }
        else
        {
            return json(['code'=>0,'msg'=>'订单超时或不存在']);
        }
    }

        //聚合登录回调
    public function CallBack($type,$code)
    {
        $res = Third::CallBackSid($type,$code);
        if($res['code']!=0)
        {
            exit($res['msg']);
        }
        $sid = $res['social_uid'];
        if($type=='qq')
        {
            $user = Db::name('ypay_user')->where('is_bindqq', 1)->where('qq_sid', $sid)->find();
            if(empty($user))
            {
                if (!S::isLogin())
                {
                    $data = array(
                        'type' => $type,
                        'username' => 'qq_'.rand(1000,100000000),
                        'qq_sid'   => $sid,
                        'is_bindqq'=> 1
                        );
                    return redirect(Request::root().'/User/bind')->with($data);
                }
                else
                {
                    Db::name('ypay_user')->where('id', Session::get('front.id'))->update(['is_bindqq' =>1,'qq_sid'=>$sid]);
                    return redirect(Request::root().'/User/Index');
                }
            }
            else
            {
                
                //执行登录
                S::thirdlogin($user);
                     //开启了登录提醒
            if($user['login_email_tips'])
            {
                Mail::go($user['email'],'平台登录成功','你好,您的账号ID：'.$user['id'].'已登录成功');
            }
                return redirect(Request::root().'/User/Index');
            }
        }
        if($type=='wx')
        {
            $user = Db::name('ypay_user')->where('is_bindwx', 1)->where('wx_sid', $sid)->find();
            if(empty($user))
            {
                if (!S::isLogin())
                {
                    $data = array(
                        'type' => $type,
                        'username' => 'wx_'.rand(1000,100000000),
                        'wx_sid'   => $sid,
                        'is_bindwx'=> 1
                        );
                    return redirect(Request::root().'/User/bind')->with($data);
                }
                else
                {
                    Db::name('ypay_user')->where('id', Session::get('front.id'))->update(['is_bindwx' =>1,'wx_sid'=>$sid]);
                    return redirect(Request::root().'/User/Index');
                }
            }
            else
            {
                //执行登录
                S::thirdlogin($user);
                     //开启了登录提醒
            if($user['login_email_tips'])
            {
                Mail::go($user['email'],'平台登录成功','你好,您的账号ID：'.$user['id'].'已登录成功');
            }
                return redirect(Request::root().'/User/Index');
            }
        }
        
    }

    //QQ互联回调
    public function qqcallback($code='',$state='')
    {
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        $qqOAuth = new \Yurun\OAuthLogin\QQ\OAuth2(getConfig()['qq_appid'], getConfig()['qq_appkey'],$http_type.$_SERVER['HTTP_HOST'].'/Notify/qqcallback');
        // 获取accessToken
        $accessToken = $qqOAuth->getAccessToken($state);
        
        // 调用过getAccessToken方法后也可这么获取
        // $accessToken = $qqOAuth->accessToken;
        // 这是getAccessToken的api请求返回结果
        // $result = $qqOAuth->result;
        
        // 用户资料
        $userInfo = $qqOAuth->getUserInfo();
        
        // 这是getAccessToken的api请求返回结果
        // $result = $qqOAuth->result;
        
        // 用户唯一标识
        $openid = $qqOAuth->openid;
        
        $user = Db::name('ypay_user')->where('is_bindqq', 1)->where('qq_sid', $openid)->find();
        if(empty($user))
            {
                if (!S::isLogin())
                {
                    $data = array(
                        'type' => 'qq',
                        'username' => 'qq_'.rand(1000,100000000),
                        'qq_sid'   => $openid,
                        'is_bindqq'=> 1
                        );
                    return redirect(Request::root().'/User/bind')->with($data);
                }
                else
                {
                    Db::name('ypay_user')->where('id', Session::get('front.id'))->update(['is_bindqq' =>1,'qq_sid'=>$openid]);
                    return redirect(Request::root().'/User/Index');
                }
            }
            else
            {
                //执行登录
                S::thirdlogin($user);
                    //开启了登录提醒
            if($user['login_email_tips'])
            {
                Mail::go($user['email'],'平台登录成功','你好,您的账号ID：'.$user['id'].'已登录成功');
            }
                return redirect(Request::root().'/User/Index');
            }
        die;
    }
    
    public function alipay_dmf()
    {
        $data = Request::param('','','strip_tags');
        //record_log($data,"job_ok");
        if(!$data)
        {
            return json(['code'=>0,'msg'=>'数据不可为空!']);
        }
        $order = Db::name('ypay_order')->where('out_trade_no',$data['out_trade_no'])->find();
        if(empty($order))
        {
            return json(['code'=>0,'msg'=>'当前订单不存在!']);
        }
        $account = Db::name('ypay_account')->where('id',$order['account_id'])->where('code','alipay_dmf')->find();
        if(empty($account))
        {
            return json(['code'=>0,'msg'=>'通道不存在!']);
        }
        
        $priKey = $account['cookie'];
        $res = Jialanshen::rsaCheck($data,$priKey);
        if($res===true)
        {
            $url = Jialanshen::creat_callback($order);
            get_curl($url['notify']);
            return json(['code'=>1,'msg'=>'回调成功!']);
        }
        else
        {
            return json(['code'=>0,'msg'=>'订单超时或不存在']);
        }
    }
    
     public function dopay_dmf()
    {
        $data = Request::param('','','strip_tags');
        if(!$data)
        {
            return json(['code'=>0,'msg'=>'数据不可为空!']);
        }
        $order = Db::name('ypay_order')->where('out_trade_no',$data['out_trade_no'])->find();
        if(empty($order))
        {
            return json(['code'=>0,'msg'=>'当前订单不存在!']);
        }
        $priKey = getConfig()['dmf_openid'];
        $res = Jialanshen::rsaCheck($data,$priKey);
        if($res===true)
        {
            $url = Jialanshen::creat_callback($order);
            get_curl($url['notify']);
            return json(['code'=>1,'msg'=>'回调成功!']);
        }
        else
        {
            return json(['code'=>0,'msg'=>'订单超时或不存在']);
        }
    }
    
    //转接异步通知
    public function epay_returnzj()
    {
        $data = Request::param('','','strip_tags');
        //查询订单是否存在
        $order = Db::table('ypay_order')->where('out_trade_no', $data['out_trade_no'])->find();
        if(empty($order))
        {
            echo '该订单不存在'; die;
        }
        //获取配置信息
        $user = Db::table('ypay_user')->where('id', $order['user_id'])->find();
        if(empty($user))
        {
            echo '该商户不存在'; die;
        }
        //实例化配置信息
        $epayzj = new epay($user['switch_id'],$user['switch_key'],$user['switch_url']);
        $isSign = $epayzj->getEpaySignVeryfy($data,$data["sign"],$user['switch_key']); //生成签名结果
        if(!$isSign)
        {
            echo '验签失败，请检查配置信息'; die;
        }
        else
        {
            //验证通过
            $url = Jialanshen::creat_callback($order);
            $tj_url = $url['return'];
            //跳转
            header("Location:$tj_url");
        }
    }
    
    //转接易支付同步回调
    public function epay_notifyzj()
    {
        $data = Request::param('','','strip_tags');
        //查询订单是否存在
        $order = Db::table('ypay_order')->where('out_trade_no', $data['out_trade_no'])->find();
        if(empty($order))
        {
            echo 'fail'; die;
        }
        //获取配置信息
        $user = Db::table('ypay_user')->where('id', $order['user_id'])->find();
        if(empty($user))
        {
            echo 'fail'; die;
        }
        //实例化配置信息
        $epayzj = new epay($user['switch_id'],$user['switch_key'],$user['switch_url']);
        $isSign = $epayzj->getEpaySignVeryfy($data,$data["sign"],$user['switch_key']); //生成签名结果
        if(!$isSign)
        {
            echo 'fail'; die;
        }
        else
        {
            //验证通过
            $url = Jialanshen::creat_callback($order);
            get_curl($url['notify']);
            echo 'success'; die;
        }
    }
    
    
    
}
