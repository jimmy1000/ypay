<?php
declare (strict_types = 1);

namespace app\admin\controller;
use think\facade\Db;
use think\facade\Config;
use think\facade\Request;
use think\facade\View;
use app\common\core\core;
require_once(base_path().'/common/core/functions_'.substr(PHP_VERSION, 0, 3).'.php');

class Update extends Base
{
    protected $middleware = ['AdminCheck','AdminPermission'];
    //进入更新页面
    public function index()
    {
       $update_info = self::check_ver();
       $ver = env('YuanVer');
       View::assign([
           'update_info'=>$update_info,
           'ver'=>$ver
           ]);
       return $this->fetch();
    }
    
    //检查是否有更新
    public function check_ver()
    {
       $admin = Db::table('admin_admin')->where('id', 1)->find();
       $core  = new Core();
       $res = $core->UpCheck($admin['ypay_ver']);
       $res = json_decode($res,true);
       if(empty($res['vertime'])){
          $vertime = date('Y-m-d'); 
       }else{
         $vertime    = date('Y-m-d',$res['vertime']);  
       }
       if($res['code']==100)
       {
           return ['code'=>100,'msg'=>'当前已是最新版本!','vername'=>$res['vername'],'vertime'=>$vertime];
       }
       if($res['code']==1)
       {
           return ['code'=>1,'msg'=>'获取成功','vertime'=>$vertime,'version'=>$res['version'],'updateMsg'=>$res['updateMsg']];
       }
       return ['code'=>0,'msg'=>$res['msg']];
    }
    
    public function checkver()
    {

       $admin = Db::table('admin_admin')->where('id', 1)->find();
       $core  = new Core();
       $res = $core->UpCheck($admin['ypay_ver']);
       $res = json_decode($res,true);
       if(empty($res['vertime'])){
          $vertime = date('Y-m-d'); 
       }else{
         $vertime    = date('Y-m-d',$res['vertime']);  
       }
       if($res['code']==100)
       {
           return json(['code'=>100,'msg'=>'当前已是最新版本!','vername'=>$res['vername'],'vertime'=>$vertime]);
       }
       if($res['code']==1)
       {
           return json(['code'=>1,'msg'=>'获取成功','vertime'=>$vertime,'version'=>$res['version'],'updateMsg'=>$res['updateMsg']]);
       }
       return ['code'=>0,'msg'=>$res['msg']];
    }
    
    
    //执行更新
    public function update_ver()
    {
        $admin = Db::table('admin_admin')->where('id', 1)->find();
        $core  = new Core();
        $res = $core->UpCheck($admin['ypay_ver']);
        $res = json_decode($res,true);
        if($res['code']==0)
        {
            return json(['code'=>0,'msg'=>$res['msg']]);
        }
        else
        {
            $file_url = $res['downurl'];
            $filename = basename($file_url);
            $dir = app()->getRootPath() . "runtime/upgrade/";
            if(!file_exists($dir))
            {
                mkdir($dir, 0777, true);
            }
            $path = file_exists($dir . $filename) ? $dir . $filename : $this->download_file($file_url, $dir, $filename);
            $zip = new \ZipArchive();
            //打开压缩包
            if ($zip->open($path) === true) {
                $toPath = app()->getRootPath();
                try {
                    //解压文件到toPath路径下，用于覆盖差异文件
                    $zip->extractTo($toPath);
                    unlink($path); //删除更新包
                } catch (\Exception $e) {
                    return json(["msg" => "没有该目录[" . $toPath . "]的写入权限", "code" => 0]);
                }
                //文件差异覆盖完成，开始更新数据库
                if(file_exists(app()->getRootPath() . "updatedata.sql"))
                {
                    //执行数据库
                    $dbpk ='';
                    $dbhost = Config::get('database.connections.mysql.hostname');
                    $dbport = Config::get('database.connections.mysql.hostport');
                    $dbname = Config::get('database.connections.mysql.database');
                    $dsn = "mysql:host=$dbhost:$dbport;dbname=$dbname";
                    $db = new \PDO($dsn, Config::get('database.connections.mysql.username'), Config::get('database.connections.mysql.password'));  
                    $info = self::createTables($db,$dbpk);
                    unlink(app()->getRootPath() . "updatedata.sql");
                }
                return json(['code'=>1,'msg'=>'版本更新成功请刷新缓存!']);
            }
            else
            {
                unlink($path); //删除更新包
                return json(["msg" => "更新包解压失败，请重试！", "code" => 0]);
            }
        }
       
        
    }
    
    //压缩包文件下载
    public function download_file($url, $dir, $filename = '')
    {
        if (empty($url)) {
            return false;
        }
        $ext = strrchr($url, '.');
        $dir = realpath($dir);
        //目录+文件
        $filename = (empty($filename) ? '/' . time() . '' . $ext : '/' . $filename);
        $filename = $dir . $filename;
        //开始捕捉
        ob_start();
        readfile($url);
        $img = ob_get_contents();
        ob_end_clean();
        $size = strlen($img);
        $fp2 = fopen($filename, "a");
        fwrite($fp2, $img);
        fclose($fp2);
        return $filename;
    }
    
    private function createTables($db,$pk) 
    {
        $sql = str_replace(['{{$pk}}'], 
        [$pk], 
        file_get_contents(app()->getRootPath().'updatedata.sql'));
        $sql_array = preg_split("/;[\r\n]+/", $sql);
        foreach ($sql_array as $k => $v) {
            if (!empty($v)) {
                if (substr($v, 0, 12) == 'CREATE TABLE') {
                        $name = preg_replace("/^CREATE TABLE `(\w+)` .*/s", "\\1", $v);
                        $msg = "创建数据表{$name}";
                        $res = $db->query($v);
                        if ($res == false) {
                            return $msg.'失败';
                        }
                } else {
                    $res = $db->query($v);
                    if ($res == false) {
                        return '数据插入失败';
                    }
                }
            }
        }
        return false; 
    }
    
    
    

}
