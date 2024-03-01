<?php
declare (strict_types = 1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\Validate;
use think\facade\View;
use think\facade\Db;
use think\facade\Request;
/**
 * 控制器基础类
 */
abstract class BaseController
{
    use \app\common\traits\Base;
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;
        require_once(base_path().'/common/core/functions_'.substr(PHP_VERSION, 0, 3).'.php');
        
    }


    // 获取系统参数
    protected function getSystem(){
        return [ 
            'os' => PHP_OS,
            'space' => round((disk_free_space('.')/(1024*1024)),2).'M',
            'addr' =>$_SERVER['HTTP_HOST'],
            'run' => $this->request->server('SERVER_SOFTWARE'),
            'php' => PHP_VERSION,
            'php_run' => php_sapi_name(),
            'mysql' => function_exists('mysql_get_server_info')?mysql_get_server_info():\think\facade\Db::query('SELECT VERSION() as mysql_version')[0]['mysql_version'],
            'think' => $this->app->version(),
            'upload' => ini_get('upload_max_filesize'),
            'max' => ini_get('max_execution_time').'秒',
            'ver' => env('YuanVer'),
        ];
    }
    
       // 获取系统配置
    protected function getConfig($config_data=''){
        //获取数据表信息 并以数组形式返回
        $config = Db::table('admin_config')->select()->toArray();
        if(!empty($config_data)){
            $code = 2;
            $msg = '数据未修改';
            //循环保存提交的数据
            foreach ($config_data as $key => $value){
                if($key == 'cloudkey'){
                    if(is_numeric($value)){
                       continue; 
                    }
                }
                $i = 0;//设置一个初始值
                //循环数据表信息
                foreach($config as $key2=>$value2){
                    //判断数据是否相同
                    if($key == $value2['config_name']  && $value == $value2['config_value']){
                        $i = 1;//如果数据相同就改变值为1 并退出循环
                        break;
                    }

                }
                $no = ["recommend","paytype","smsbao_xuanze"];
                if($i == 1 || in_array($key,$no)){
                    continue;
                }
                $where['config_name']=$key;
                $data['config_value']=$value;
                $result = Db::name('admin_config')->where($where)->save($data);
                $code = 1;
                $msg = '保存成功';
            }
            
            return ['code'=>$code,'msg'=>$msg];
        }
        foreach ($config as $key=>$value){
            if($value['config_name'] == 'cloudkey' && !empty($value['config_value'])){
                $value['config_value'] = rand(10000,1000000);
            }
            $data[$value['config_name']] = $value['config_value'];
        }
        return $data;
    }

    protected function getJson($json = [])
    {
        if('json' == strtolower($this->getResponseType())){
            return $this->json($json['msg']??'操作成功',$json['code']??200,$json['data']??[],$json['extend']??[]);
        }
    }

    //页面分配变量
    protected function assign($key,$value)
    {
        return View::assign($key,$value);
    }

    //页面渲染 
    protected function fetch($template = '',$data = [])
    {
        return View::fetch($template,$data);
    }

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }
    
    /**
     * 视图过滤
     *
     * @param $template
     * @param array $argc
     * @return \think\response\View
     */
    public function view($template = '', array $argc = []): \think\response\View
    {
        return view($template, $argc)->filter(function ($content) {

            if (saenv('compression_page')) {
                $content = preg_replace('/\s+/i', ' ', $content);
            }

            return $content;
        });
    }

}