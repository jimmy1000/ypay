<?php
declare (strict_types = 1);

namespace app\admin\controller\ypay;

use think\facade\Session;
use think\facade\Request;
use app\common\util\Upload as Up;
use app\common\model\AdminPhoto as P;
use app\common\service\AdminAdmin as S;
use think\facade\Db;
use app\common\model\YpayOrder;
use app\common\model\YpayRecharge;
use app\common\model\YpayAccount;
use think\facade\View;
use app\common\model\YpayUser;

class Shop extends  \app\admin\controller\Base
{
    protected $middleware = ['AdminCheck','AdminPermission'];

    // 列表
    public function index(){
        $total_water_order = YpayOrder::where('status',1)->count();//平台总流水订单
        $total_recharge_order = YpayRecharge::where('status',1)->count();//平台总充值订单
        
        //获取左边头部内容
        $arr_itme = [
	        ['name' => '今日','time' => 'today',],
	        ['name' => '本月','time' => 'month',],
	        ['name' => '今年','time' => 'year',],
        ];
        
        foreach ($arr_itme as $key => $value){
            $value['order_ok'] = YpayOrder::where('status',1)->whereTime('create_time',$value['time'])->count();
            $value['order'] = YpayOrder::whereTime('create_time',$value['time'])->count();
            $value['success'] = ($value['order_ok']==0 || $value['order']==0) ? 0 : sprintf("%.2f",$value['order_ok']/$value['order']*100);
            $value['money_ok'] = YpayOrder::where('status',1)->whereTime('create_time',$value['time'])->sum('truemoney');
            $value['money'] = YpayOrder::whereTime('create_time',$value['time'])->sum('truemoney');
            $top[$key] = $value;
        }
        
        //获取左边底部内容
        $day=[];
        $__day=[];
        // 获取30天时间
        for ($i=0; $i < 30; $i++) { 
	        $_day = 30-$i;
	        $time=mktime(0, 0, 0,(int)date('m'), date('d') - $_day, (int)date('Y'));
	   
	        $day[$i] = date('Y-m-d',$time);
	        $__day[$i] = date('Y-m-d',$time);
        }

        $__sum_data = [];
        $__sum_ok_data = [];
        $__sum_no_data = [];
        foreach ($__day as $k => $time) {
            $endTime = date("Y-m-d",strtotime($time ." + 1 day"));
        	$__sum_data[$k] = YpayOrder::whereTime('create_time', 'between', [$time, $endTime])->count();
        	$__sum_ok_data[$k] = YpayOrder::where('status',1)->whereTime('create_time', 'between', [$time, $endTime])->count();
        	$__sum_no_data[$k] = YpayOrder::where('status',0)->whereTime('create_time', 'between', [$time, $endTime])->count();
        }
        $time = [];
        $time['time_arr'] = str_replace('"',"'",json_encode($day));
        $time['__sum_data'] = json_encode($__sum_data);
        $time['__sum_ok_data'] = json_encode($__sum_ok_data);
        $time['__sum_no_data'] = json_encode($__sum_no_data);
        
        //获取右边头部内容
        $other_info =[
		         		array('title' => '总用户','value' => YpayUser::count() ),
		         		array('title' => '总订单','value' => $total_water_order + $total_recharge_order ),
		         		array('title' => '总余额池','value' => sprintf('%.2f',YpayUser::sum('money')) ),
		         		array('title' => '总在线通道','value' => YpayAccount::where('status',1)->count() ),
		         		array('title' => '总充值订单','value' => $total_recharge_order ),
		         		array('title' => '今日新增用户','value' => YpayUser::whereDay('create_time')->count() ),
		         		array('title' => '今日充值订单','value' => YpayRecharge::where('status',1)->whereDay('create_time')->count()),
		         		array('title' => 'QQ在线通道','value' => YpayAccount::where('status',1)->where('type','qqpay')->count() ),
		         		array('title' => '微信在线通道','value' => YpayAccount::where('status',1)->where('type','wxpay')->count() ),
		         		array('title' => '支付宝在线通道','value' => YpayAccount::where('status',1)->where('type','alipay')->count() ),
		         	];
        
        $data = 
        [
            //统计图 - 总流水
            "wechat_month_money" => YpayOrder::where('status',1)->whereTime('create_time', 'month')->where('type','wxpay')->sum('truemoney'),//微信本月总金额
            "wechat_week_money" => YpayOrder::where('status',1)->whereWeek('create_time')->where('type','wxpay')->sum('truemoney'),//微信本周总金额
            "wechat_today_money" => YpayOrder::where('status',1)->whereDay('create_time')->where('type','wxpay')->sum('truemoney'),//微信今日总金额
            
            "ali_month_money" => YpayOrder::where('status',1)->whereTime('create_time', 'month')->where('type','alipay')->sum('truemoney'),//支付宝本月总金额
            "ali_week_money" => YpayOrder::where('status',1)->whereWeek('create_time')->where('type','alipay')->sum('truemoney'),//支付宝本周总金额
            "ali_today_money" => YpayOrder::where('status',1)->whereDay('create_time')->where('type','alipay')->sum('truemoney'),//支付宝今日总金额
            
            "qq_month_money" => YpayOrder::where('status',1)->whereTime('create_time', 'month')->where('type','qqpay')->sum('truemoney'),//QQ本月总金额
            "qq_week_money" => YpayOrder::where('status',1)->whereWeek('create_time')->where('type','qqpay')->sum('truemoney'),//QQ本周总金额
            "qq_today_money" => YpayOrder::where('status',1)->whereDay('create_time')->where('type','qqpay')->sum('truemoney'),//QQ今日总金额
            
            //统计图 - 总充值
            "wechat_month_recharge" => YpayRecharge::where('status',1)->whereTime('create_time', 'month')->where('type','wxpay')->sum('money'),//微信本月总充值
            "wechat_week_recharge" => YpayRecharge::where('status',1)->whereWeek('create_time')->where('type','wxpay')->sum('money'),//微信本周总充值
            "wechat_today_recharge" => YpayRecharge::where('status',1)->whereDay('create_time')->where('type','wxpay')->sum('money'),//微信今日总充值
            
            "ali_month_recharge" => YpayRecharge::where('status',1)->whereTime('create_time', 'month')->where('type','alipay')->sum('money'),//支付宝本月总充值
            "ali_week_recharge" => YpayRecharge::where('status',1)->whereWeek('create_time')->where('type','alipay')->sum('money'),//支付宝本周总充值
            "ali_today_recharge" => YpayRecharge::where('status',1)->whereDay('create_time')->where('type','alipay')->sum('money'),//支付宝今日总充值
            
            "qq_month_recharge" => YpayRecharge::where('status',1)->whereTime('create_time', 'month')->where('type','qqpay')->sum('money'),//QQ本月总充值
            "qq_week_recharge" => YpayRecharge::where('status',1)->whereWeek('create_time')->where('type','qqpay')->sum('money'),//QQ本周总充值
            "qq_today_recharge" => YpayRecharge::where('status',1)->whereDay('create_time')->where('type','qqpay')->sum('money'),//QQ今日总充值
        ];
        View::assign(['data'=>$data,'top'=>$top,'time'=>$time,'other_info'=>$other_info,]);
        return $this->fetch();
    }

}
