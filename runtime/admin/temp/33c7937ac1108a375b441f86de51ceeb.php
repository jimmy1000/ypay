<?php /*a:2:{s:62:"/www/wwwroot/hm.otbax.cn/view/admin/admin/photo/add_photo.html";i:1669980494;s:54:"/www/wwwroot/hm.otbax.cn/view/admin/common/common.html";i:1670898482;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> YPAY Admin - 专业的平台开发商! </title>
    <link rel="stylesheet" href="/static/component/pear/css/pear.css" />
    <link rel="stylesheet" href="/static/admin/css/soulTable.css" />
    <script src="/static/component/layui/layui.js"></script>
    <script src="/static/component/pear/pear.js"></script>
</head>
    <style>
        .pear-container{background-color:white;}
        body{margin: 10px;}
        .layui-upload-img {
            width: 92px;
            height: 92px;
        }
    </style>
<body>
<div class="layui-row layui-col-space15">
<div class="layui-col-md12">
    <div class="layui-card">
            <div class="layui-tab-content">
              <div class="layui-upload" style="text-align: center;">
                <div class="layui-upload-list">
                  <img class="layui-upload-img" id="img">
                  <p id="imgText"></p>
                </div>
                <button type="button" class="pear-btn pear-btn-primary" id="logo">上传图片</button>
              </div>   
            </div>
            <div class="layui-progress layui-progress-big" lay-showpercent="yes" lay-filter="img">
                <div class="layui-progress-bar" lay-percent=""></div>
              </div>
        </div>      
    </div>
</div>
<script>
    layui.use(['upload', 'element', 'layer'], function(){
  var $ = layui.jquery
  ,upload = layui.upload
  ,element = layui.element
  ,layer = layui.layer;

  var uploadInst = upload.render({
    elem: '#logo'
    ,url: '<?php echo htmlentities(app('request')->root()); ?>/index/upload'
    , data: {path: '<?php echo htmlentities($name); ?>'}
	,exts: 'jpg|png|gif|bmp|jpeg'
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#img').attr('src', result); //图片链接（base64）
      });
      element.progress('img', '0%'); //进度条复位
      layer.msg('上传中', {icon: 16, time: 0});
    }
    ,done: function(res){
      //如果上传失败
      if(res.code > 0){
        return layer.msg('上传失败');
      }else{
        setTimeout(function () {
           parent.layui.table.reload("dict-data-table");
        }, 1500);
      }
      $('#imgText').html(''); 
    }
    ,error: function(){
      var imgText = $('#imgText');
      imgText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs img-reload">重试</a>');
      imgText.find('.img-reload').on('click', function(){
        uploadInst.upload();
      });
    }
    //进度条
    ,progress: function(n, index, e){
      element.progress('img', n + '%'); 
      if(n == 100){
        layer.msg('上传成功',{icon:1})
      }else{
        layer.msg('上传失败', {icon: 2});
      }
    }
  });
  
});
</script>

</body>
</html>