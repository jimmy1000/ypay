<?php
declare (strict_types = 1);

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;
class YpayAccount extends Model
{
    use SoftDelete;
     protected $deleteTime = false;
    // 获取列表
    public static function getList()
    {
        $where = [];
        $limit = input('get.limit');
        
               //按通道标识查找
               if ($code = input("code")) {
                   $where[] = ["code", "like", "%" . $code . "%"];
               }
               //按通道类型查找
               if ($type = input("type")) {
                   $where[] = ["type", "like", "%" . $type . "%"];
               }
               //按会员ID查找
               if ($user_id = input("user_id")) {
                   $where[] = ["user_id", "like", "%" . $user_id . "%"];
               }
        $list = self::order('id','desc')->where($where)->paginate($limit);
        
        foreach ($list->items() as $item)
        {
            $item['succcount'] = YpayOrder::where('status',1)->where('account_id',$item['id'])->count();
            $item['code_name'] = AdminChannel::where('code',$item['code'])->field('name')->find()['name'];
            $item['succprice'] = YpayOrder::where('status',1)->where('account_id',$item['id'])->sum('truemoney');
            
        }
        return ['code'=>0,'data'=>$list->items(),'extend'=>['count' => $list->total(), 'limit' => $limit]];
    }
    
    public static function getUserList($user_id)
    {
        $where = [];
        $limit = input('get.limit');
        
               //按通道标识查找
              if ($code = input("code")) {
                  $where[] = ["code", "like", "%" . $code . "%"];
              }
               //按通道类型查找
               if ($type = input("type")) {
                   $where[] = ["type", "like", "%" . $type . "%"];
               }
              
               $status = input("status");
               //按状态查找
               if ($status == 1 || $status == 0) {
                   $where[] = ["status", "like", "%" . $status . "%"];
               }
               $where[] = ["user_id",'=',$user_id];
  
        $list = self::order('id','desc')->where($where)->paginate($limit);
        foreach ($list->items() as $item)
        {
            $item['succcount'] = YpayOrder::where('status',1)->where('account_id',$item['id'])->count();
            $item['succprice'] = YpayOrder::where('status',1)->where('account_id',$item['id'])->sum('truemoney');
        }
        
        
        return ['code'=>0,'data'=>$list->items(),'extend'=>['count' => $list->total(), 'limit' => $limit]];
    }
    
    public static function getUserInfo($id){
        $item = self::find($id);
        return $item;
    }
}
