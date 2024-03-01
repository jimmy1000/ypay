<?php /*a:2:{s:54:"/www/wwwroot/hm.otbax.cn/view/install/index/step2.html";i:1669892470;s:64:"/www/wwwroot/hm.otbax.cn/view/install/common/install_header.html";i:1669972494;}*/ ?>
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
	            <div class="layui-step layui-line"></div>
	            <div class="layui-step">
	                <div class="layui-sort">3</div>
	                <div class="layui-desc">安装成功</div>
	            </div>
	    	</div>

			<div class="layui-col-md12">
				<div class="layui-card layui-fixed">
					<div class="layui-card-header">
						<span>2 创建数据库</span>
						<span class="layui-card-version"><?php echo env('YuanVer'); ?></span>
					</div>
					<div class="layui-card-body">
						<form class="layui-form" action="/install/index/step2" wid100>
				  		<div class="layui-form-item ">
	                       <label class="layui-form-label">数据库主机</label>
	                        <div class="layui-input-inline" >
	                            <input type="text" name="host" value="127.0.0.1" class="layui-input" lay-verType="tips" lay-verify="required" >
	                        </div>
	                        <div class="layui-form-mid layui-word-aux">* 数据库地址一般为127.0.0.1</div>
	                    </div> 
	                    <input type="" name="type" value="mysql" hidden="">
				  		<div class="layui-form-item ">
	                       <label class="layui-form-label">端口</label>
	                        <div class="layui-input-inline" >
	                            <input type="text" name="port" value="3306" class="layui-input" lay-verType="tips" lay-verify="required" >
	                        </div>
	                        <div class="layui-form-mid layui-word-aux">* 一般为3306端口号</div>
	                    </div> 
				  		<div class="layui-form-item ">
	                       <label class="layui-form-label">数据库名</label>
	                        <div class="layui-input-inline" >
	                            <input type="text" name="name"  class="layui-input" lay-verType="tips" lay-verify="required" >
	                        </div>
	                    </div> 	  
				  		<div class="layui-form-item ">
	                       <label class="layui-form-label">数据库用户名</label>
	                        <div class="layui-input-inline" >
	                            <input type="text" name="user"  class="layui-input" lay-verType="tips" lay-verify="required" >
	                        </div>
	                        <div class="layui-form-mid layui-word-aux"><font color="red">* </font>生产环境下建议使用独立账户</div>
	                    </div> 
				  		<div class="layui-form-item ">
	                       <label class="layui-form-label">数据库密码</label>
	                        <div class="layui-input-inline" >
	                            <input type="text" name="pass"  class="layui-input" lay-verType="tips" lay-verify="required" >
	                        </div>
	                    </div> 
						<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
						  <legend style="font-size: 16px">管理员信息</legend>
						</fieldset>
						<div class="layui-form-item ">
	                       <label class="layui-form-label">管理员昵称</label>
	                        <div class="layui-input-inline" >
	                            <input type="text" name="nickname" value="超级管理员" class="layui-input" lay-verType="tips" lay-verify="required" >
	                        </div>
							<div class="layui-form-mid layui-word-aux"><font color="red">* </font>请输入后台昵称</div>
	                    </div> 
				  		<div class="layui-form-item ">
	                       <label class="layui-form-label">管理员账号</label>
	                        <div class="layui-input-inline" >
	                            <input type="text" name="username" value="admin" class="layui-input" lay-verType="tips" lay-verify="required" >
	                        </div>
							<div class="layui-form-mid layui-word-aux"><font color="red">* </font>请输入后台账号</div>
	                    </div> 
				  		<div class="layui-form-item ">
	                       <label class="layui-form-label">管理员密码</label>
	                        <div class="layui-input-inline" >
	                            <input type="text" name="password" value="123456" class="layui-input" lay-verType="tips" lay-verify="required" >
	                        </div>
	                        <div class="layui-form-mid layui-word-aux"><font color="red">* </font>请输入后台密码</div>
	                    </div> 	  

              	        <blockquote class="layui-elem-quote layui-quote-nm">温馨提示:下一步的安装过程不能关闭窗口,否则安装失败</blockquote>        	      						
					    <div class="layui-center">
							<button type="button" onclick="window.history.go(-1);" class="layui-btn layui-btn-normal">上一步</button>
							<button class="layui-btn layui-btn-normal" lay-submit lay-filter="step" >下一步</button>
					    </div>
						</form>
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
	layui.use(['jquery','layer','form'],function() {
		var layer = layui.layer;
		var jquery = layui.jquery;
		var form = layui.form;

		form.on('submit(step)',function(data){
			jquery.post('/install.php/index/step2',data.field,function(res){
				if (res.code == 200) {
					location.href = res.url;
				}
				else {
					layer.msg(res.msg, {icon: 5});
				}
			},'json');
			return false;
		})
	})
</script>
</html>