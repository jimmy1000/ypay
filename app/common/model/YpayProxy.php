<?php
declare (strict_types = 1);

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;
class YpayProxy extends Model
{
    //use SoftDelete;
     //protected $deleteTime = "delete_time";
    // 获取列表
    public static function getList()
    {
        $where = [];
        $limit = input('get.limit');
        
               //按地域名称查找
               if ($name = input("name")) {
                   $where[] = ["name", "like", "%" . $name . "%"];
               }
               //按IP地址查找
               if ($address = input("address")) {
                   $where[] = ["address", "like", "%" . $address . "%"];
               }
        $list = self::order('sort','asc')->where($where)->paginate($limit);
        return ['code'=>0,'data'=>$list->items(),'extend'=>['count' => $list->total(), 'limit' => $limit]];
    }
}
