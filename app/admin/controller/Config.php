<?php
declare (strict_types = 1);

namespace app\admin\controller;
use think\facade\Db;
use think\facade\Request;
use app\common\model\YpayVip;

class Config extends Base
{
    protected $middleware = ['AdminCheck','AdminPermission'];
    
    // 系统配置
    public function index(){
        if(Request::isPost()){
            $data = Request::post('','','');
            return $this->getConfig($data);
        }
        return $this->fetch('',[
            'data' => $this->getConfig(),
            'vip'  => YpayVip::select()
        ]);
    }
}
