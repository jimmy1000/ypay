<?php /*a:2:{s:55:"/www/wwwroot/1pay.q520.tk/view/install/index/step1.html";i:1669891216;s:65:"/www/wwwroot/1pay.q520.tk/view/install/common/install_header.html";i:1669972494;}*/ ?>
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
	            <div class="layui-step layui-line"></div>
	            <div class="layui-step">
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
						<span>1 运行环境检测</span>
						<span class="layui-card-version"><?php echo env('YuanVer'); ?></span>
					</div>
					<div class="layui-card-body">
				  		<table class="layui-table" lay-skin="nob" >
				            <thead>
				              <tr>
				                <th>检测项</th>
				                <th>所需环境</th>
				                <th>当前环境</th>
				              </tr>
				            </thead>
				            <tbody>
				              <tr>
				              	<td>php</td>
				              	<td> >= 7.3 </td>
				              		<td <elt style="color:red;" name="$checkEnv.php" value="7.3">  </elt> <?php echo htmlentities($checkEnv['php']); ?></td>
				              </tr>
				              <tr>
				              	<td>mysqli</td>
				              	<td>模块</td>
				              	<td>
				              	    <?php if($checkEnv['mysqli'] == 1): ?>
										<i class="layui-icon layui-icon-ok-circle"></i>
									<?php else: ?>
				              			<i class="layui-icon layui-icon-close-fill"></i>
				              		<?php endif; ?>
				              	</td>
				              </tr>
				              <tr>
				              	<td>redis</td>
				              	<td>模块/不限</td>
				              	<td>
				              	    <?php if($checkEnv['redis'] == 1): ?>
										<i class="layui-icon layui-icon-ok-circle"></i>
				              		<?php else: ?>
				              			<i class="layui-icon layui-icon-close-fill"></i>
				              		<?php endif; ?>
				              	</td>
				              </tr>
				              <tr>
				              	<td>curl</td>
				              	<td>扩展</td>
				              	<td>
				              	    <?php if($checkEnv['curl'] == 1): ?>
										<i class="layui-icon layui-icon-ok-circle"></i>
				              		<?php else: ?>
				              			<i class="layui-icon layui-icon-close-fill"></i>
				              		<?php endif; ?>
				              	</td>
				              </tr>
				              <tr>
				              	<td>exif</td>
				              	<td>扩展</td>
				              	<td>
				              	    <?php if($checkEnv['exif'] == 1): ?>
										<i class="layui-icon layui-icon-ok-circle"></i>
				              		<?php else: ?>
				              			<i class="layui-icon layui-icon-close-fill"></i>
				              		<?php endif; ?>
				              	</td>
				              </tr>
				              <tr>
				              	<td>fileinfo</td>
				              	<td>扩展</td>
				              	<td>
				              	    <?php if($checkEnv['fileinfo'] == 1): ?>
										<i class="layui-icon layui-icon-ok-circle"></i>
				              		<?php else: ?>
				              			<i class="layui-icon layui-icon-close-fill"></i>
				              	    <?php endif; ?>
				              	</td>
				              </tr>

				            </tbody>
	            		</table>

				  		<table class="layui-table dir" lay-skin="nob">
				            <thead>
				              <tr>
				                <th>目录名</th>
				                <th>写入权限</th>
				                <th>读取权限</th>
				              </tr> 
				            </thead>
				            <tbody> 
				            <?php if(is_array($checkfile) || $checkfile instanceof \think\Collection || $checkfile instanceof \think\Paginator): $i = 0; $__LIST__ = $checkfile;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				              <tr>
				                <td><?php echo htmlentities($vo[3]); ?></td>
				                <td><i class="layui-icon <?php echo htmlentities($vo[1]); ?>"></i></td>
				                <td><i class="layui-icon <?php echo htmlentities($vo[2]); ?>"></i></td>
				              </tr>
				            <?php endforeach; endif; else: echo "" ;endif; ?>
				            </tbody>
	            		</table>
						
					    <div class="layui-center">
							<button type="button" onclick="window.history.go(-1);" class="layui-btn layui-btn-normal">上一步</button>
							<button id="step" type="button" class="layui-btn layui-btn-normal">下一步</button>
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
	layui.use(['jquery','layer'],function() {
		var layer = layui.layer;
		var jquery = layui.jquery;

		jquery('#step').click(function(){
			jquery.post('/install.php/index/step1',[],function(res){
				if (res.code === 200) {
					location.href = res.url;
				}
				else {
					layer.msg(res.msg, {icon: 5});
				}
			})
		}) 

	})
</script>
</html>