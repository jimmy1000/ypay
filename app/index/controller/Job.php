<?php


namespace app\index\controller;
use think\facade\Config;
use think\facade\Queue;
use think\facade\Db;

class Job extends \app\BaseController
{

    /**
     * @定时任务
     *
     * @return void
     */
    public function test($code,$task_key){
        //参数
        $params = ['code'=>$code];
        if($task_key!=getConfig()['diy_task_key'])
        {
            echo '监控密钥错误';
            exit;
        }
        
        $isPushed = Queue::later(3, \app\index\job\Order::class, $params, "order");
        if($isPushed !== false){
            echo date('Y-m-d H:i:s') . " 队列添加成功";
        }else{
            echo '队列添加失败';
        }
    }

}