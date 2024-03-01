<?php /*a:2:{s:58:"/www/wwwroot/testpay.lao6sp.com/view/admin/index/home.html";i:1682769390;s:61:"/www/wwwroot/testpay.lao6sp.com/view/admin/common/common.html";i:1670898484;}*/ ?>
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

 <link rel="stylesheet" href="/static/css/admin.css?v1.0.6" />
 <!--<link rel="stylesheet" href="http://preview.smartadmin.1024lab.net/css/home-header-41033179.css" />-->
 <!-- 主 题 更 换 -->
 <style id="pearadmin-bg-color"></style>
 <body class="pear-container">
 	<div class="ant-row" style="row-gap: 0px;">
 		<div class="user-header">
 			<div class="ant-page-header ant-page-header-ghost">
 				<!---->
 				<div class="ant-page-header-heading">
 					<div class="ant-page-header-heading-left">
 						<!---->
 						<!----><span class="ant-page-header-heading-title"><?php echo htmlentities($data['hello']); ?></span>
 						<!----><span class="ant-page-header-heading-tags"><span class="ant-tag ant-tag-blue">努力工作
 								<!---->
 							</span></span>
 					</div>
 					<span class="ant-page-header-heading-extra">
 						<p><?php echo htmlentities($data['time']); ?></p>
 					</span>
 				</div>
 				<div class="ant-page-header-content">
 					<div class="ant-row content" style="row-gap: 0px;"><span class="heart-sentence">
 							<h3><?php echo htmlentities($data['chicken']); ?></h3>
 							<div></div>
 						</span>
 						<div class="weather" ><iframe width="100%" scrolling="no" height="60"
 								frameborder="0" allowtransparency="true"
 								src="//i.tianqi.com/index.php?c=code&amp;id=12&amp;icon=1&amp;num=5&amp;site=12"
 								></iframe></div>
 					</div>
 				</div>
 				<!---->
 			</div>
 		</div>
 	</div>
 	<!-- 快捷方式 -->
 	<div class="layui-row layui-col-space15">
 		<div class="layui-col-sm6" style="padding-bottom: 0;">
 			<div class="layui-row layui-col-space15">
 				<div class="layui-col-xs6 layui-col-sm3">
 					<a href="/admin.php/config">
 						<div class="console-app-group">
 							<i class="console-app-icon layui-icon layui-icon-slider"
 								style="color: #ffc069;padding-top: 3px;margin-right: 6px;"></i>
 							<div class="console-app-name">系统配置</div>
 						</div>
 					</a>
 				</div>
 				<div class="layui-col-xs6 layui-col-sm3">
 					<a href="/admin.php/ypay.user">
 						<div class="console-app-group">
 							<i class="console-app-icon layui-icon layui-icon-group" style="font-size: 26px;"></i>
 							<div class="console-app-name">会员管理</div>
 						</div>
 					</a>
 				</div>
 				<div class="layui-col-xs6 layui-col-sm3">
 					<a href="/admin.php/ypay.shop">
 						<div class="console-app-group">
 							<i class="console-app-icon layui-icon layui-icon-chart-screen" style="color: #95de64;"></i>
 							<div class="console-app-name">商城总览</div>
 						</div>
 					</a>
 				</div>
 				<div class="layui-col-xs6 layui-col-sm3">
 					<a href="/admin.php/ypay.vip">
 						<div class="console-app-group">
 							<i class="console-app-icon layui-icon layui-icon-cart" style="color: #ff9c6e;"></i>
 							<div class="console-app-name">会员套餐</div>
 						</div>
 					</a>
 				</div>
 			</div>
 		</div>
 		<div class="layui-col-sm6" style="padding-bottom: 0;">

 			<div class="layui-row layui-col-space15">
 				<div class="layui-col-xs6 layui-col-sm3">
 					<a href="/admin.php/admin.photo">
 						<div class="console-app-group">
 							<i class="console-app-icon layui-icon layui-icon-picture"
 								style="color: #b37feb;font-size: 30px;"></i>
 							<div class="console-app-name">图片管理</div>
 						</div>
 					</a>
 				</div>
 				<div class="layui-col-xs6 layui-col-sm3">
 					<a href="/admin.php/ypay.account">
 						<div class="console-app-group">
 							<i class="console-app-icon layui-icon layui-icon-layer"
 								style="color: #ffd666;font-size: 34px;"></i>
 							<div class="console-app-name">通道管理</div>
 						</div>
 					</a>
 				</div>
 				<div class="layui-col-xs6 layui-col-sm3">
 					<a href="/admin.php/ypay.news">
 						<div class="console-app-group">
 							<i class="console-app-icon layui-icon layui-icon-email"
 								style="color: #5cdbd3;font-size: 36px;"></i>
 							<div class="console-app-name">通知公告</div>
 						</div>
 					</a>
 				</div>
 				<div class="layui-col-xs6 layui-col-sm3">
 					<a href="/admin.php/update">
 						<div class="console-app-group">
 							<i class="console-app-icon layui-icon layui-icon-auz"
 								style="color: #ff85c0;font-size: 28px;"></i>
 							<div class="console-app-name">在线更新</div>
 						</div>
 					</a>
 				</div>
 			</div>
 		</div>
 	</div>
 	<!--系统信息 AND 指示导航-->
 	<div class="layui-row layui-col-space15">
 		<div class="layui-col-md6">
 			<div class="layui-card">
 				<div class="layui-card-header">系统信息</div>
 				<div class="layui-card-body">
 					<table class="layui-table">
 						<colgroup>
 							<col width="50%">
 							<col>
 						</colgroup>
 						<tbody>
 							<tr>
 								<td>版本号</td>
 								<td><?php echo htmlentities($ver); ?></td>
 							</tr>
 							<tr>
 								<td>操作系统</td>
 								<td><?php echo htmlentities($os); ?></td>
 							</tr>
 							<tr>
 								<td>平台地址</td>
 								<td><?php echo htmlentities($addr); ?></td>
 							</tr>
 							<tr>
 								<td>PHP版本</td>
 								<td><?php echo htmlentities($php); ?></td>
 							</tr>
 							<tr>
 								<td>上传附件限制</td>
 								<td><?php echo htmlentities($upload); ?></td>
 							</tr>
 						</tbody>
 					</table>
 				</div>
 			</div>
 		</div>
 		<div class="layui-col-md6">
 			<div class="layui-card">
 				<div class="layui-card-header">快捷方式</div>
 				<div class="layui-card-body">
 					<a target="_blank" href="https://fttqq.cn/" class="pear-btn pear-btn-primary layui-btn-fluid"
 						style="height: 46px;line-height:46px;background-color: #2D8CF0 !important;">官 网</a>
 					<br>
 					<a target="_blank" href="https://jq.qq.com/?_wv=1027&k=KmPEbl02" class="pear-btn pear-btn-success  layui-btn-fluid"
 						style="margin-top: 8px;height: 45px;line-height: 45px;">文 档</a>
 					<br>
 					<a target="_blank" href="https://jq.qq.com/?_wv=1027&k=KmPEbl02"
 						class="pear-btn pear-btn-danger  layui-btn-fluid"
 						style="margin-top: 8px ;height: 45px;line-height: 45px;">授 权 查 询</a>
 					<br>
 					<a target="_blank" href="https://tool.gljlw.com/qq/?qq=1015443128"
 						class="pear-btn pear-btn-warming  layui-btn-fluid"
 						style="margin-top: 8px ;height: 45px;line-height: 45px;">官 方 客 服</a>
 				</div>
 			</div>
 		</div>
 	</div>
 	<!--</div>-->
 </body>
 </html>
