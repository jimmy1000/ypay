<?php /*a:2:{s:55:"/www/wwwroot/1pay.q520.tk/view/install/index/step3.html";i:1669893610;s:65:"/www/wwwroot/1pay.q520.tk/view/install/common/install_header.html";i:1669972494;}*/ ?>
 <!DOCTYPE html>
<html>
<head>
<title>YPay安装向导</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-status-bar-style" content="black"> 
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="/static/component/layui/css/layui.css">
<link rel="stylesheet" href="/static/css/install.css">
<script src="/static/component/layui/layui.js"></script>
</head>
<body>

<div class="layui-header">
	<div class="layui-container">
		<div class="title">安装向导</div>
	</div>
</div>

<div class="layui-content" style="padding-top: 0px;">
	<div class="layui-container">
		<div class="layui-row">

			<div class="layui-step-group">
	            <div class="layui-step layui-active">
	                <div class="layui-sort">1</div>
	                <div class="layui-desc">检查安装环境</div>
	            </div>
	            <div class="layui-step layui-active layui-line"></div>
	            <div class="layui-step layui-active">
	                <div class="layui-sort">2</div>
	                <div class="layui-desc">创建数据库</div>
	            </div>
	            <div class="layui-step layui-active layui-line"></div>
	            <div class="layui-step layui-active ">
	                <div class="layui-sort">3</div>
	                <div class="layui-desc">安装成功</div>
	            </div>
	    	</div>

			<div class="layui-col-md12">
				<div class="layui-card layui-fixed">
					<div class="layui-card-header">
						<span>3 安装成功</span>
						<span class="layui-card-version"><?php echo config('app.version'); ?></span>
					</div>
					<div class="layui-card-body">
						<div class="layui-install">
							<div class="tips">正在安装，请勿刷新...</div>
						</div>
						<div class="layui-complete" style="display: none">
							<div class="layui-success">YPay安装成功</div>
							<blockquote class="layui-elem-quote layui-text" style="border-left: 0px;text-align: left;margin-bottom: 30px;">
							  1. <a href="/" target="_blank">请不要将后台地址泄露给他人，如有泄露请及时修改</a><br/>
							  2. <a href="/" target="_blank" class="layui-admin">后台地址：</a><br>
							</blockquote>
							<a href="/" target="_blank" class="layui-btn layui-btn-normal layui-btn-fixed">访问前台</a>
							<a href="/" target="_blank" class="layui-btn layui-btn-normal layui-btn-admin">访问后台</a>
						</div>
		    		</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<style>.layui-footer{    
		position: revert;
        padding: 0px;
    }</style>
<div class="layui-footer">copyright © 2023 源分享 all rights reserved.</div>
</body>

<script type="text/javascript">
	layui.use(['jquery','layer','element'],function() {
		var layer = layui.layer;
		var jquery = layui.jquery;

		// 加载数据信息
		jquery.get('/install.php/index/install',{},function(res){
			if (res.code === 200) {
				jquery('.layui-install').remove();
				var admin = jquery('.layui-admin');
				admin.attr('href','/admin.php');
				admin.html('后台地址：http://'+ location.host +'/admin.php');
				jquery('.layui-btn-admin').attr('href','/admin.php');
				jquery('.layui-complete').show();
			} else {
			    layer.msg(res.msg, {icon: 5});
			}
		});
	})
</script>
</html>