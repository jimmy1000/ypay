<?php
declare (strict_types = 1);

namespace app\index\controller;
use think\facade\Session;
use think\facade\Request;
use think\facade\View;
use app\common\service\YpayUser as S;
use app\common\model\YpayUser as M;
use app\common\validate\YpayUser as V;
use think\facade\Db;
use app\common\model\AdminFrontLog as Log;
use system\GoogleAuthenticator;

class My extends \app\BaseController
{
    protected $middleware = ['FrontCheck'];
    
    //控制台页面
    public function userpro()
    {
        View::assign('user', S::getUser());
        if (Request::isAjax()){
            $data = Request::param('','','strip_tags');
            $validate = new V;
            if(!$validate->scene('edit')->check($data))
            return ['msg'=>$validate->getError(),'code'=>201];
            Db::name('ypay_user')->where('id', S::getUserId())->update(['mobile'=>$data['mobile'],'email'=>$data['email']]);
            return json(['code'=>1,'msg'=>'个人信息修改成功!']);
        }
        return $this->fetch();
    }
    
     
    
    public function updatepwd()
    {
        View::assign('user', S::getUserId());
        if (Request::isAjax()){
            $this->getJson(S::goPass(Request::param('','','strip_tags')));
        }
        return $this->fetch();
    }
    
    public function aff()
    {
        $request = \think\facade\Request::instance();
        $aff_percentage = getConfig()['aff_percentage']*100;
        $aff_people = Db::name('ypay_user')->where('superior_id',S::getUserId())->count();
        $aff_money_array = Db::name('money_log')->where('user_id',S::getUserId())->select();
        $aff_money = 0;
        foreach ($aff_money_array as $key=>$value){
            if($value['memo'] == "下级购买会员套餐返利" || $value['memo'] == "下级充值返利"){
               $aff_money+= $value['money'];
            }
        }
         View::assign([
            'aff_percentage'  => $aff_percentage,
            'aff_url' => $request->root(true),
            'user' => S::getUserId(),
            'aff_people' => $aff_people,
            'aff_money' =>$aff_money
        ]);
        return $this->fetch();
    }
    
    public function JieBangWX()
    {
        Db::name('ypay_user')->where('id', S::getUserId())->update(['is_bindwx' => 0,'wx_sid'=>'']);
        return json(['code'=>1,'msg'=>'解绑成功!']);
    }
    
    
    public function JieBangQQ()
    {
        Db::name('ypay_user')->where('id', S::getUserId())->update(['is_bindqq' => 0,'qq_sid'=>'']);
        return json(['code'=>1,'msg'=>'解绑成功!']);
    }
    
    
    
    public function loginlog()
    {
       if (Request::isAjax()){
            $this->getJson(Log::getUserList(S::getUserId()));
        }
        return $this->fetch();
    }
    
    public function anquan()
    {
       $user = M::where('id',S::getUserId())->find();
       
       if(Session::get('front_auth'))
       {
           View::assign('front_auth',1);
       }else{
           View::assign('front_auth',0);
       }
       if(!empty($user['googlekey']))
       {
          View::assign('bd_status',1);
       }
       else
       {
          View::assign('bd_status',0);
          View::assign('front_auth',1);
       }
       
       return $this->fetch();
    }
    
    public function bind_googleauth()
    {
        $user = M::where('id',S::getUserId())->find();
        if(!empty($user['googlekey']))
        {
            return json(['code'=>0,'msg'=>'此账号已绑定']);
        }
        //谷歌验证码
        $google=new GoogleAuthenticator();
        //生成验证秘钥
        $secret=$google->createSecret();
        //生成验证二维码 $username 需要绑定的用户名
        $qrCodeUrl = $google->getQRCodeGoogleUrl(S::getUserId(), $secret);
        Session::set('secret', $secret);
        return json(['code'=>1,'msg'=>$qrCodeUrl]);
    }
    
    public function ebind_googleauth($code='')
    {
        $user = M::where('id',S::getUserId())->find();
        if(empty($user['googlekey']))
        {
            //获取session信息
            $secret = Session::get('secret');
            $google =new GoogleAuthenticator();
            $checkResult = $google->verifyCode($secret, $code, 4);
            if ($checkResult)
            {
                M::where('id', S::getUserId())->update(['googlekey' =>$secret]);
                return json(['code'=>1,'msg'=>'绑定成功']);
            }
            else
            {
                return json(['code'=>0,'msg'=>'谷歌验证码错误或未绑定']);
            }
        }
        else
        {
            return json(['code'=>0,'msg'=>'此账号已绑定']);
        }
       
    }
    
    public function very_googleauth()
    {
        $data = Request::param('','','strip_tags');
        //获取用户的密钥信息
        $google =new GoogleAuthenticator();
        $user = M::where('id',S::getUserId())->find();
        //$google_secret 存入的谷歌秘钥  ，$code 谷歌动态验证码
        $checkResult = $google->verifyCode($user['googlekey'], $data['code'], 4);
        if ($checkResult)
        {
            $info = [
            'id' => S::getUserId(),
            'auth' => 1
            ];
            Session::set('front_auth', $info);
            return json(['code'=>1,'msg'=>'保护模式解除']);
        }else
        {
            return json(['code'=>0,'msg'=>'谷歌验证码错误']);
        }
    }
    
    public function jiebang_googleauth()
    {
        $data = Request::param('','','strip_tags');
        //获取用户的密钥信息
        $google =new GoogleAuthenticator();
        $user = M::where('id',S::getUserId())->find();
        //$google_secret 存入的谷歌秘钥  ，$code 谷歌动态验证码
        $checkResult = $google->verifyCode($user['googlekey'], $data['code'], 4);
        if ($checkResult)
        {
            M::where('id', S::getUserId())->update(['googlekey' =>'']);
            return json(['code'=>1,'msg'=>'解绑完成']);
        }
        else
        {
            return json(['code'=>0,'msg'=>'谷歌验证码错误']);
        }
    }

    
    
}
