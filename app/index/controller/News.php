<?php


namespace app\index\controller;
use think\facade\Config;
use think\facade\Db;
use think\facade\View;

class News extends \app\BaseController
{

    /**
     * 首页
     */
    public function index($type=1)
    {
        $news = Db::name('ypay_news')->where('type',$type)->where('status', 1)->order('id desc')->paginate(10);
        foreach ($news as $key => $value){
            $value['month'] = substr($value['create_time'],5,2);
            $value['day'] = substr($value['create_time'],8,2);
            $news[$key] = $value;
        }
        View::assign('news', $news);
        $list = Db::table('ypay_navs')->where('status', 1)->order('sort','asc')->select();
        View::assign('nav', $list);
        return $this->fetch();
    }
    
    public function detail($id='')
    {
        $news = Db::name('ypay_news')->where('id',$id)->where('status', 1)->find();
            switch ($news['type']) {
                case '1':
                        $news['class'] = '平台公告';
                    break;
                case '2':
                        $news['class'] = '行业动态';
                    break;
                default:
                        $news['class'] = '常见问题';
                    break;
            }
        View::assign('news', $news);
        $list = Db::table('ypay_navs')->where('status', 1)->order('id','desc')->select();
        View::assign('nav', $list);
        return $this->fetch();
    }
    
    public function indexann()
    {
        return $this->fetch();
    }
    
    
    
}
