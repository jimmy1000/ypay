<?php
declare (strict_types = 1);

namespace app\admin\controller\ypay;

use think\facade\Request;
use app\common\service\YpayUser as S;
use app\common\model\YpayVip as vip;
use app\common\model\YpayUser as M;

class User extends  \app\admin\controller\Base
{
    protected $middleware = ['AdminCheck','AdminPermission'];

    // 列表
    public function index(){
        if (Request::isAjax()) {
            return $this->getJson(M::getList());
        }
        return $this->fetch();
    }

    // 添加用户
    public function add(){
        if (Request::isAjax()) {
            return $this->getJson(S::goUserAdd(Request::post()));
        }
        return $this->fetch('',['vip' => vip::select()]);
    }

    // 编辑用户
    public function edit($id){
        if (Request::isAjax()) {
            return $this->getJson(S::goUserEdit(Request::post(),$id));
        }
        return $this->fetch('',['model' => M::find($id),'vip'=>vip::select()]);
    }
        
    //是否冻结该账户
    public function frozenstatus($id){
        return $this->getJson(S::goFrozenStatus(Request::post('is_frozen'),$id));
        }

    // 删除用户
    public function remove($id){
        return $this->getJson(S::goRemove($id));
        }

    // 批量删除用户
    public function batchRemove(){
        return $this->getJson(S::goBatchRemove(Request::post('ids')));
        }
}
