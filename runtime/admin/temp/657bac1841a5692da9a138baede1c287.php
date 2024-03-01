<?php /*a:2:{s:48:"/mnt/projects/payyz/view/admin/config/index.html";i:1670815716;s:49:"/mnt/projects/payyz/view/admin/common/common.html";i:1670898484;}*/ ?>
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
	<body class="pear-container">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
					<form class="layui-form edit-form" method="post" action="">
						<div class="layui-tab" lay-filter="menu">
							<ul class="layui-tab-title">
								<li class="layui-this" lay-id="basic">基本设置</li>
								<li lay-id="code">发信设置</li>
								<li lay-id="upload">上传设置</li>
								<li lay-id="pay">支付设置</li>
								<li lay-id="notice">公告/弹窗</li>
								<li lay-id="key">密钥/云端</li>
								<li lay-id="lr">登录/注册</li>
								<li lay-id="enhance">功能增强</li>
							</ul>
							<div class="layui-tab-content">
								<!--基本设置-->
								<div class="layui-tab-item layui-show">
									<div class="layui-form-item">
										<label class="layui-form-label">
											网站名称
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" class="layui-input"
												placeholder="简短的名称，用于发信通知等场景，例如：xx平台" name="sitename"
												value="<?php echo isset($data['sitename']) ? htmlentities($data['sitename']) : ''; ?>" type="text" />
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											网站副标题
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" class="layui-input" name="title"
												value="<?php echo isset($data['title']) ? htmlentities($data['title']) : ''; ?>" type="text" />
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											网站关键词
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" class="layui-input" name="key"
												value="<?php echo isset($data['key']) ? htmlentities($data['key']) : ''; ?>" type="text" />
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											网站描述
										</label>
										<div class="layui-input-block">
											<textarea name="desc" class="layui-textarea"><?php echo isset($data['desc']) ? htmlentities($data['desc']) : ''; ?></textarea>
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											ICP备案号
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" class="layui-input" name="icp"
												value="<?php echo isset($data['icp']) ? htmlentities($data['icp']) : ''; ?>" type="text" />
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											支付API
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" class="layui-input" placeholder="自定义前台网关地址"
												name="pay_api" value="<?php echo isset($data['pay_api']) ? htmlentities($data['pay_api']) : ''; ?>" type="text" />
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											首页开关
										</label>
										<div class="layui-input-block">
											<?php if($data['is_weboff'] == 1): ?>
											<input type="radio" name="is_weboff" value="0" title="关闭">
											<input type="radio" name="is_weboff" value="1" title="开启" checked>
											<?php else: ?>
											<input type="radio" name="is_weboff" value="0" title="关闭" checked>
											<input type="radio" name="is_weboff" value="1" title="开启">
											<?php endif; ?>
										</div>

									</div>
									
									<div class="layui-form-item">
										<label class="layui-form-label">
											首页公告开关
										</label>
										<div class="layui-input-block">
											<?php if($data['is_notice'] == 1): ?>
											<input type="radio" name="is_notice" value="0" title="关闭">
											<input type="radio" name="is_notice" value="1" title="开启" checked>
											<?php else: ?>
											<input type="radio" name="is_notice" value="0" title="关闭" checked>
											<input type="radio" name="is_notice" value="1" title="开启">
											<?php endif; ?>
										</div>

									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											后台验证码
										</label>
										<div class="layui-input-block">
											<?php if($data['is_admin_captcha'] == 1): ?>
											<input type="radio" name="is_admin_captcha" value="0" title="关闭">
											<input type="radio" name="is_admin_captcha" value="1" title="开启" checked>
											<?php else: ?>
											<input type="radio" name="is_admin_captcha" value="0" title="关闭" checked>
											<input type="radio" name="is_admin_captcha" value="1" title="开启">
											<?php endif; ?>
										</div>

									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											网站LOGO
										</label>
										<div class="layui-input-block">
											<?php echo opt_photo('logo'); ?>
											<button class="pear-btn pear-btn-primary pear-btn-sm  upload-image"
												type="button">
												<i class="fa fa-image">
												</i>
												上传图片
											</button>
											<input lay-verify="uploadlogo" name="logo" type="hidden"
												value="<?php echo isset($data['logo']) ? htmlentities($data['logo']) : ''; ?>" />
											<div class="upload-image">
												<span>
												</span>
												<img class="upload-image" src="<?php echo isset($data['logo']) ? htmlentities($data['logo']) : ''; ?>" />
											</div>
										</div>
									</div>

									<div class="layui-form-item">
										<label class="layui-form-label">
											自定义JS
										</label>
										<div class="layui-input-block">
											<textarea name="diy_js" class="layui-textarea"
												placeholder="例如：<script>Js代码</script>"><?php echo isset($data['diy_js']) ? htmlentities($data['diy_js']) : ''; ?></textarea>
										</div>
									</div>
								</div>
								<!--发信设置-->
								<div class="layui-tab-item">
									<!--邮箱发信-->
									<div class="layui-form-item">
										<label class="layui-form-label">启用邮箱服务</label>
										<div class="layui-input-block">
											<input type="checkbox" id="email_switch" value="<?php echo isset($data['email_switch']) ? htmlentities($data['email_switch']) : ''; ?>"
												name="email_switch" lay-skin="switch" lay-filter="email_switch"
												lay-text="开|关" <?php if($data['email_switch'] == 1): ?> checked
												<?php endif; ?>>
										</div>
									</div>
									<div id="email" <?php if($data['email_switch'] != 1): ?> style="display: none;"
										<?php endif; ?>>
										<div class="layui-form-item">
											<label class="layui-form-label">
												SMTP主机
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" class="layui-input" name="smtp-host"
													value="<?php echo isset($data['smtp-host']) ? htmlentities($data['smtp-host']) : ''; ?>" type="text" />
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">加密类型</label>
											<div class="layui-input-block">
												<input type="radio" name="SmtpSecure" lay-filter="SmtpSecure" value="1"
													title="SSL/TLS" <?php if($data['SmtpSecure'] == 1): ?> checked
													<?php endif; ?>>
												<input type="radio" name="SmtpSecure" lay-filter="SmtpSecure" value="2"
													title="STARTTLS" <?php if($data['SmtpSecure'] == 2): ?> checked
													<?php endif; ?>>
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">
												SMTP端口
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" class="layui-input" name="smtp-port"
													value="<?php echo isset($data['smtp-port']) ? htmlentities($data['smtp-port']) : ''; ?>" type="text" />
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">
												SMTP用户名
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" class="layui-input" name="smtp-user"
													value="<?php echo isset($data['smtp-user']) ? htmlentities($data['smtp-user']) : ''; ?>" type="text" />
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">
												SMTP密码
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" class="layui-input" name="smtp-pass"
													value="<?php echo isset($data['smtp-pass']) ? htmlentities($data['smtp-pass']) : ''; ?>" type="text" />
											</div>
										</div>
									</div>
									<hr />
									<!--短信发信-->
									<div class="layui-form-item">
										<label class="layui-form-label">启用短信服务</label>
										<div class="layui-input-block">
											<input type="checkbox" id="code_switch" value="<?php echo isset($data['code_switch']) ? htmlentities($data['code_switch']) : ''; ?>"
												name="code_switch" lay-skin="switch" lay-filter="code_switch"
												lay-text="开|关" <?php if($data['code_switch'] == 1): ?> checked
												<?php endif; ?>>
										</div>
									</div>
									<div id="code" <?php if($data['code_switch'] != 1): ?> style="display: none;"
										<?php endif; ?>>
										<div class="layui-form-item">
											<label class="layui-form-label">短信配置</label>
											<div class="layui-input-block">
												<input type="radio" name="smstype" lay-filter="stype" value="1"
													title="阿里云" <?php if($data['smstype'] == 1): ?> checked <?php endif; ?>>
												<input type="radio" name="smstype" lay-filter="stype" value="2"
													title="腾讯云" <?php if($data['smstype'] == 2): ?> checked <?php endif; ?>>
												<input type="radio" name="smstype" lay-filter="stype" value="3"
													title="短信宝" <?php if($data['smstype'] == 3): ?> checked <?php endif; ?>>
											</div>
										</div>

										<div class="layui-form-item" id="alisms" <?php if($data['smstype'] != 1): ?> style="display: none;" <?php endif; ?>>
											<div class="layui-form-item">
												<label class="layui-form-label">AccessKeyId</label>
												<div class="layui-input-block">
													<input type="text" name="alisms-accessKeyId"
														value="<?php echo isset($data['alisms-accessKeyId']) ? htmlentities($data['alisms-accessKeyId']) : ''; ?>"
														placeholder="请输入AccessKeyId" class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">Secret</label>
												<div class="layui-input-block">
													<input type="password" name="alisms-Secret"
														value="<?php echo isset($data['alisms-Secret']) ? htmlentities($data['alisms-Secret']) : ''; ?>" placeholder="请输入Secret"
														class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">短信签名</label>
												<div class="layui-input-block">
													<input type="text" name="alisms-SignName"
														value="<?php echo isset($data['alisms-SignName']) ? htmlentities($data['alisms-SignName']) : ''; ?>" placeholder="请输入短信签名"
														class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">登录模板ID</label>
												<div class="layui-input-block">
													<input type="text" name="alisms-LoginCodeId"
														value="<?php echo isset($data['alisms-LoginCodeId']) ? htmlentities($data['alisms-LoginCodeId']) : ''; ?>"
														placeholder="请输入登录模板ID" class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">注册模板ID</label>
												<div class="layui-input-block">
													<input type="text" name="alisms-RegCodeId"
														value="<?php echo isset($data['alisms-RegCodeId']) ? htmlentities($data['alisms-RegCodeId']) : ''; ?>" placeholder="请输入注册模板ID"
														autocomplete="off" class="layui-input">
												</div>
											</div>
										</div>

										<div class="layui-form-item" id="tencentsms" <?php if($data['smstype'] != 2): ?> style="display: none;" <?php endif; ?>>
											<div class="layui-form-item">
												<label class="layui-form-label">SecretId</label>
												<div class="layui-input-block">
													<input type="text" name="tensms-accessKeyId"
														value="<?php echo isset($data['tensms-accessKeyId']) ? htmlentities($data['tensms-accessKeyId']) : ''; ?>"
														placeholder="请输入SecretId" autocomplete="off"
														class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">SecretKey</label>
												<div class="layui-input-block">
													<input type="text" name="tensms-Secret"
														value="<?php echo isset($data['tensms-Secret']) ? htmlentities($data['tensms-Secret']) : ''; ?>" placeholder="请输入SecretKey"
														autocomplete="off" class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">短信签名</label>
												<div class="layui-input-block">
													<input type="text" name="tensms-SignName"
														value="<?php echo isset($data['tensms-SignName']) ? htmlentities($data['tensms-SignName']) : ''; ?>" placeholder="请输入短信签名"
														autocomplete="off" class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">应用ID</label>
												<div class="layui-input-block">
													<input type="text" name="tensms-AppId"
														value="<?php echo isset($data['tensms-AppId']) ? htmlentities($data['tensms-AppId']) : ''; ?>" placeholder="请输入应用ID"
														autocomplete="off" class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">登录模板ID</label>
												<div class="layui-input-block">
													<input type="text" name="tensms-LoginCodeId"
														value="<?php echo isset($data['tensms-LoginCodeId']) ? htmlentities($data['tensms-LoginCodeId']) : ''; ?>"
														placeholder="请输入登录模板ID" autocomplete="off" class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">注册模板ID</label>
												<div class="layui-input-block">
													<input type="text" name="tensms-RegCodeId"
														value="<?php echo isset($data['tensms-RegCodeId']) ? htmlentities($data['tensms-RegCodeId']) : ''; ?>" placeholder="请输入注册模板ID"
														autocomplete="off" class="layui-input">
												</div>
											</div>
										</div>

										<div class="layui-form-item" id="smsbao" <?php if($data['smstype'] != 3): ?> style="display: none;" <?php endif; ?>>
											<div class="layui-form-item">


												<label class="layui-form-label">推荐平台</label>
												<div class="layui-input-block">
													<select name="smsbao_xuanze" lay-filter="smsbao_xuanze"
														lay-verify="" lay-search>
														<option value="http://api.smsbao.com/">短信宝</option>
														<option value="https://dx.5igx.com/">猪猪短信宝</option>
													</select>
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">
													平台地址
												</label>
												<div class="layui-input-block">
													<input type="text" id="smsbao-api" name="smsbao-api"
														value="<?php echo isset($data['smsbao-api']) ? htmlentities($data['smsbao-api']) : ''; ?>" placeholder="请输入平台地址"
														autocomplete="off" class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">用户名</label>
												<div class="layui-input-block">
													<input type="text" name="smsbao-user"
														value="<?php echo isset($data['smsbao-user']) ? htmlentities($data['smsbao-user']) : ''; ?>" placeholder="请输入用户名"
														autocomplete="off" class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">账户密码</label>
												<div class="layui-input-block">
													<input type="text" name="smsbao-pass"
														value="<?php echo isset($data['smsbao-pass']) ? htmlentities($data['smsbao-pass']) : ''; ?>" placeholder="请输入账户密码"
														autocomplete="off" class="layui-input">
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">短信签名</label>
												<div class="layui-input-block">
													<input type="text" name="smsbao-SignName"
														value="<?php echo isset($data['smsbao-SignName']) ? htmlentities($data['smsbao-SignName']) : ''; ?>" placeholder="请输入短信签名"
														autocomplete="off" class="layui-input">
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--上传设置-->
								<div class="layui-tab-item">
									<div class="layui-form-item">
										<label class="layui-form-label">存储方式</label>
										<div class="layui-input-block">
											<input type="radio" name="file-type" value="1" title="本地" <?php if($data['file-type'] == 1): ?> checked <?php endif; ?> lay-filter="type">
											<input type="radio" name="file-type" value="2" title="阿里云" <?php if($data['file-type'] == 2): ?> checked <?php endif; ?> lay-filter="type">
											<input type="radio" name="file-type" value="3" title="七牛云" <?php if($data['file-type'] == 3): ?> checked <?php endif; ?> lay-filter="type">
										</div>
									</div>
									<div class="layui-form-item" id="oss" <?php if($data['file-type'] != 2): ?>
										style="display: none;" <?php endif; ?>>
										<div class="layui-form-item">
											<label class="layui-form-label">Oss地址</label>
											<div class="layui-input-block">
												<input type="text" name="file-endpoint"
													value="<?php echo isset($data['file-endpoint']) ? htmlentities($data['file-endpoint']) : ''; ?>" placeholder="请输入Oss地址"
													autocomplete="off" class="layui-input">
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">空间名称</label>
											<div class="layui-input-block">
												<input type="text" name="file-OssName"
													value="<?php echo isset($data['file-OssName']) ? htmlentities($data['file-OssName']) : ''; ?>" placeholder="请输入空间名称"
													autocomplete="off" class="layui-input">
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">KeyId</label>
											<div class="layui-input-block">
												<input type="text" name="file-accessKeyId"
													value="<?php echo isset($data['file-accessKeyId']) ? htmlentities($data['file-accessKeyId']) : ''; ?>" placeholder="请输入KeyId"
													autocomplete="off" class="layui-input">
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">KeySecret</label>
											<div class="layui-input-block">
												<input type="text" name="file-accessKeySecret"
													value="<?php echo isset($data['file-accessKeySecret']) ? htmlentities($data['file-accessKeySecret']) : ''; ?>"
													placeholder="请输入KeySecret" autocomplete="off" class="layui-input">
											</div>
										</div>
									</div>

									<div class="layui-form-item" id="qiniu" <?php if($data['file-type'] != 3): ?>
										style="display: none;" <?php endif; ?>>
										<div class="layui-form-item">
											<label class="layui-form-label">空间域名</label>
											<div class="layui-input-block">
												<input type="text" name="qiniu-Domain"
													value="<?php echo isset($data['qiniu-Domain']) ? htmlentities($data['qiniu-Domain']) : ''; ?>" placeholder="请输入绑定空间域名"
													autocomplete="off" class="layui-input">
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">BUCKET</label>
											<div class="layui-input-block">
												<input type="text" name="qiniu-Bucket"
													value="<?php echo isset($data['qiniu-Bucket']) ? htmlentities($data['qiniu-Bucket']) : ''; ?>" placeholder="请输入空间BUCKET"
													autocomplete="off" class="layui-input">
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">AK</label>
											<div class="layui-input-block">
												<input type="text" name="qiniu-AK" value="<?php echo isset($data['qiniu-AK']) ? htmlentities($data['qiniu-AK']) : ''; ?>"
													placeholder="请输入AK" autocomplete="off" class="layui-input">
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">SK</label>
											<div class="layui-input-block">
												<input type="text" name="qiniu-SK" value="<?php echo isset($data['qiniu-SK']) ? htmlentities($data['qiniu-SK']) : ''; ?>"
													placeholder="请输入SK" autocomplete="off" class="layui-input">
											</div>
										</div>
									</div>
								</div>

								<!--支付设置-->
								<div class="layui-tab-item">
									<div class="layui-form-item">
										<label class="layui-form-label">
											订单金额限制
										</label>
										<div class="layui-input-block">
											<div class="layui-input-inline">
												<input type="text" name="min_orderprice" required lay-verify="required"
													value="<?php echo isset($data['min_orderprice']) ? htmlentities($data['min_orderprice']) : ''; ?>" placeholder="最小订单金额"
													autocomplete="off" class="layui-input">
											</div>

											<div class="layui-input-inline">
												<input type="text" name="max_orderprice" required lay-verify="required"
													value="<?php echo isset($data['max_orderprice']) ? htmlentities($data['max_orderprice']) : ''; ?>" placeholder="最大订单金额"
													autocomplete="off" class="layui-input">
											</div>
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											屏蔽关键字
										</label>
										<div class="layui-input-block">
											<textarea name="shield_key" placeholder="请输入内容"
												class="layui-textarea"><?php echo isset($data['shield_key']) ? htmlentities($data['shield_key']) : ''; ?></textarea>
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											提示内容
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" placeholder="屏蔽提示内容" class="layui-input"
												name="shield_tips" value="<?php echo isset($data['shield_tips']) ? htmlentities($data['shield_tips']) : ''; ?>" type="text" />
										</div>
									</div>
									<hr />
									<div class="layui-form-item">
										<label class="layui-form-label">支付配置</label>
										<div class="layui-input-block">
											<input type="radio" name="paytype" lay-filter="paytype" value="0"
												title="前台充值" checked>
											<input type="radio" name="paytype" lay-filter="paytype" value="1"
												title="支付测试">
										</div>
									</div>
									<div id="front_pay">
									    <!--充值金额限制-->
									    <div class="layui-form-item" >
										<label class="layui-form-label">
											充值金额限制
										</label>
										<div class="layui-input-block">
											<div class="layui-input-inline">
												<input type="text" name="min_recharge" required lay-verify="required"
													value="<?php echo isset($data['min_recharge']) ? htmlentities($data['min_recharge']) : ''; ?>" placeholder="最小充值金额"
													autocomplete="off" class="layui-input">
											</div>

											<div class="layui-input-inline">
												<input type="text" name="max_recharge" required lay-verify="required"
													value="<?php echo isset($data['max_recharge']) ? htmlentities($data['max_recharge']) : ''; ?>" placeholder="最大充值金额"
													autocomplete="off" class="layui-input">
											</div>
										</div>
									</div>
									<hr/>
										<!--微信前台充值通道设置-->
										<div class="layui-form-item">
											<label class="layui-form-label">微信</label>
											<div class="layui-input-block">
												<select lay-filter="front_wechat_pay" name="front_wechat_pay"
													id="front_wechat_pay" lay-verType="front_wechat_pay"
													lay-verify="required" required>
													<option value="close" <?php if($data['front_wechat_pay'] == 'close'): ?> selected <?php endif; ?>>关闭</option>
													<option value="epay" <?php if($data['front_wechat_pay'] == 'epay'): ?> selected <?php endif; ?>>易支付</option>
												</select>
											</div>
										</div>
										<!--易支付微信-->
										<div id='epay_wechat' <?php if($data['front_wechat_pay'] != 'epay'): ?> style="display: none;" <?php endif; ?>>
											<div class="layui-form-item">
												<label class="layui-form-label">易支付API</label>
												<div class="layui-input-block">
													<input autocomplete="off" placeholder="易支付API" class="layui-input"
														name="wechat_epay_url" value="<?php echo isset($data['wechat_epay_url']) ? htmlentities($data['wechat_epay_url']) : ''; ?>"
														type="text" />
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">
													易支付ID
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" placeholder="易支付ID" class="layui-input"
														name="wechat_epay_id" value="<?php echo isset($data['wechat_epay_id']) ? htmlentities($data['wechat_epay_id']) : ''; ?>" type="text" />
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">
													易支付KEY
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" placeholder="易支付KEY" class="layui-input"
														name="wechat_epay_key" value="<?php echo isset($data['wechat_epay_key']) ? htmlentities($data['wechat_epay_key']) : ''; ?>"
														type="password" />
												</div>
											</div>
										</div>
										<hr />
										<!--支付宝前台充值通道设置-->
										<div class="layui-form-item">
											<label class="layui-form-label">支付宝</label>
											<div class="layui-input-block">
												<select lay-filter="front_ali_pay" name="front_ali_pay"
													id="front_ali_pay" lay-verType="front_ali_pay" lay-verify="required"
													required>
													<option value="close" <?php if($data['front_ali_pay'] == 'close'): ?> selected <?php endif; ?>>关闭</option>
													<option value="epay" <?php if($data['front_ali_pay'] == 'epay'): ?> selected <?php endif; ?>>易支付</option>
												</select>
											</div>
										</div>
                                        <!--易支付支付宝-->
										<div id='epay_ali' <?php if($data['front_ali_pay'] != 'epay'): ?> style="display: none;" <?php endif; ?>>
											<div class="layui-form-item">
												<label class="layui-form-label">
													易支付API
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" placeholder="易支付API" class="layui-input"
														name="ali_epay_url" value="<?php echo isset($data['ali_epay_url']) ? htmlentities($data['ali_epay_url']) : ''; ?>"
														type="text" />
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">
													易支付ID
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" placeholder="易支付ID" class="layui-input"
														name="ali_epay_id" value="<?php echo isset($data['ali_epay_id']) ? htmlentities($data['ali_epay_id']) : ''; ?>"
														type="text" />
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">
													易支付KEY
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" placeholder="易支付KEY" class="layui-input"
														name="ali_epay_key" value="<?php echo isset($data['ali_epay_key']) ? htmlentities($data['ali_epay_key']) : ''; ?>"
														type="password" />
												</div>
											</div>
										</div>

									</div>
									<div id="demo_pay" style="display: none;">
										<div class="layui-form-item">
											<label class="layui-form-label">
												测试金额
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" placeholder="请输入最低测试金额" class="layui-input"
													name="demopay_money" value="<?php echo isset($data['demopay_money']) ? htmlentities($data['demopay_money']) : ''; ?>"
													type="text" />
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">
												测试商品名称
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" placeholder="请输入测试商品名称" class="layui-input"
													name="demopay_name" value="<?php echo isset($data['demopay_name']) ? htmlentities($data['demopay_name']) : ''; ?>"
													type="text" />
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">
												易支付API
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" placeholder="易支付API" class="layui-input"
													name="epayurl_demo" value="<?php echo isset($data['epayurl_demo']) ? htmlentities($data['epayurl_demo']) : ''; ?>"
													type="text" />
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">
												易支付ID
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" placeholder="易支付ID" class="layui-input"
													name="epayid_demo" value="<?php echo isset($data['epayid_demo']) ? htmlentities($data['epayid_demo']) : ''; ?>" type="text" />
											</div>
										</div>
										<div class="layui-form-item">
											<label class="layui-form-label">
												易支付KEY
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" placeholder="易支付KEY" class="layui-input"
													name="epaykey_demo" value="<?php echo isset($data['epaykey_demo']) ? htmlentities($data['epaykey_demo']) : ''; ?>"
													type="password" />
											</div>
										</div>
									</div>
								</div>
								<!--公告/弹窗-->
								<div class="layui-tab-item">
								    <div class="layui-form-item">
										<label class="layui-form-label">
											首页弹窗
										</label>
										<div class="layui-input-block">
											<textarea class="textarea" id="index_popup"
												name="index_popup"><?php echo isset($data['index_popup']) ? htmlentities($data['index_popup']) : ''; ?></textarea>
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											注册弹窗
										</label>
										<div class="layui-input-block">
											<textarea class="textarea" id="reg_popup"
												name="reg_popup"><?php echo isset($data['reg_popup']) ? htmlentities($data['reg_popup']) : ''; ?></textarea>
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											商户中心
										</label>
										<div class="layui-input-block">
											<textarea class="textarea" id="sh_notice"
												name="sh_notice"><?php echo isset($data['sh_notice']) ? htmlentities($data['sh_notice']) : ''; ?></textarea>
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											通道列表
										</label>
										<div class="layui-input-block">
											<textarea class="textarea" id="td_notice"
												name="td_notice"><?php echo isset($data['td_notice']) ? htmlentities($data['td_notice']) : ''; ?></textarea>
										</div>
									</div>
								</div>

								<!--密钥/云端-->
								<div class="layui-tab-item">

									<div class="layui-form-item">
										<label class="layui-form-label">
											云端密钥
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" placeholder="请输入云端授权密钥" class="layui-input"
												name="cloudkey" value="<?php echo isset($data['cloudkey']) ? htmlentities($data['cloudkey']) : ''; ?>" type="password" />
										</div>
									</div>
									<hr/>
									<div class="layui-form-item">
											<label class="layui-form-label">地域类型</label>
											<div class="layui-input-block">
												<input type="radio" name="region_type" lay-filter="region_type" value="0"
													title="关闭" <?php if($data['region_type'] == 0): ?> checked <?php endif; ?>>
												<input type="radio" name="region_type" lay-filter="region_type" value="1"
													title="地域代理" <?php if($data['region_type'] == 1): ?> checked <?php endif; ?>>
												<input type="radio" name="region_type" lay-filter="region_type" value="2"
													title="云端地域" <?php if($data['region_type'] == 2): ?> checked <?php endif; ?>>
											</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											默认云端名称
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" class="layui-input" name="vcloudname" value="<?php echo isset($data['vcloudname']) ? htmlentities($data['vcloudname']) : ''; ?>"
												type="text" />
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											默认云端
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" placeholder="微信云端地址需带http://尾部不带/"
												class="layui-input" name="vcloudurl" value="<?php echo isset($data['vcloudurl']) ? htmlentities($data['vcloudurl']) : ''; ?>"
												type="text" />
										</div>
									</div>
									<hr/>
									<div class="layui-form-item">
										<label class="layui-form-label">
											Q云端地址
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" placeholder="请输入插件中的外网地址" class="layui-input"
												name="myqqurl" value="<?php echo isset($data['myqqurl']) ? htmlentities($data['myqqurl']) : ''; ?>" type="text" />
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											Q云端Token
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" placeholder="请输入插件中的Token" class="layui-input"
												name="myqqtoken" value="<?php echo isset($data['myqqtoken']) ? htmlentities($data['myqqtoken']) : ''; ?>" type="text" />
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											店员密钥
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" placeholder="店员免挂的通讯密钥" class="layui-input"
												name="clerk_key" value="<?php echo isset($data['clerk_key']) ? htmlentities($data['clerk_key']) : ''; ?>" type="text" />
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											店员通道图片
										</label>
										<div class="layui-input-block">
											<?php echo opt_photo('diy_clerkqr'); ?>
											<button class="pear-btn pear-btn-primary pear-btn-sm  upload-image"
												type="button">
												<i class="fa fa-image">
												</i>
												上传图片
											</button>
											<input lay-verify="uploaddy_bindqr" name="diy_clerkqr" type="hidden"
												value="<?php echo isset($data['diy_clerkqr']) ? htmlentities($data['diy_clerkqr']) : ''; ?>" />
											<div class="upload-image">
												<span>
												</span>
												<img class="upload-image" src="<?php echo isset($data['diy_clerkqr']) ? htmlentities($data['diy_clerkqr']) : ''; ?>" />
											</div>
										</div>
									</div>
									<div class="layui-form-item">
										<label class="layui-form-label">
											计划任务密钥
										</label>
										<div class="layui-input-block">
											<input autocomplete="off" placeholder="自定义计划任务密钥" class="layui-input"
												name="diy_task_key" value="<?php echo isset($data['diy_task_key']) ? htmlentities($data['diy_task_key']) : ''; ?>" type="text" />
										</div>
									</div>
								</div>
								<!--登录/注册-->
								<div class="layui-tab-item">
									<!--登录/注册/找回背景设置-->
									<div>
										<div class="layui-form-item">
											<label class="layui-form-label">背景配置</label>
											<div class="layui-input-block">
												<input type="radio" name="bgtype" lay-filter="bgtype" value="0"
													title="本地" <?php if($data['bgtype'] == 0): ?> checked <?php endif; ?>>
												<input type="radio" name="bgtype" lay-filter="bgtype" value="1"
													title="自定义API" <?php if($data['bgtype'] == 1): ?> checked <?php endif; ?>>
											</div>
										</div>
										<div class="layui-form-item" id='local_bg' <?php if($data['bgtype'] != 0): ?> style="display: none;" <?php endif; ?>>
											<label class="layui-form-label">
												本地上传
											</label>
											<div class="layui-input-block">
												<?php echo opt_photo('bg'); ?>
												<button class="pear-btn pear-btn-primary pear-btn-sm upload-image"
													type="button">
													<i class="fa fa-image">
													</i>
													上传图片
												</button>
												<input lay-verify="uploadbg" name="bg" type="hidden"
													value="<?php echo isset($data['bg']) ? htmlentities($data['bg']) : ''; ?>" />
												<div class="upload-image">
													<span>
													</span>
													<img class="upload-image" src="<?php echo isset($data['bg']) ? htmlentities($data['bg']) : ''; ?>" />
												</div>
											</div>
										</div>
										<div class="layui-form-item" id='api_bg' <?php if($data['bgtype'] != 1): ?>
											style="display: none;" <?php endif; ?>>
											<label class="layui-form-label">
												API地址
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" placeholder="请输入API地址,尾部需带/"
													class="layui-input" name="api_bg" value="<?php echo isset($data['api_bg']) ? htmlentities($data['api_bg']) : ''; ?>"
													type="text" />
											</div>
										</div>
									</div>
									<hr />
									<div class="layui-form-item">
										<label class="layui-form-label">
											注册开关
										</label>
										<div class="layui-input-block">
											<?php if($data['is_reg'] == 0): ?>
											<input type="radio" name="is_reg" value="0" title="关闭" checked>
											<input type="radio" name="is_reg" value="1" title="开启">
											<?php else: ?>
											<input type="radio" name="is_reg" value="0" title="关闭">
											<input type="radio" name="is_reg" value="1" title="开启" checked>
											<?php endif; ?>
										</div>
									</div>
									<!--登录/注册/找回行为验证方式-->
									<hr />
									<!--登录/注册方式-->
									<div id="LoginOrReg">
									    <!--找回-->
										<div class="layui-form-item">
											<label class="layui-form-label">找回方式</label>
											<div class="layui-input-block">
												<input type="radio" name="retrieve-type" value="0" title="关闭" <?php if($data['retrieve-type'] == 0): ?> checked <?php endif; ?>>
												<input type="radio" name="retrieve-type" value="1" title="短信验证" <?php if($data['retrieve-type'] == 1): ?> checked <?php endif; if($data['code_switch'] != 1): ?> disabled <?php endif; ?>>
												<input type="radio" name="retrieve-type" value="2" title="邮箱验证" <?php if($data['retrieve-type'] == 2): ?> checked <?php endif; if($data['email_switch'] != 1): ?> disabled <?php endif; ?>>
											</div>
										</div>
										
										<!--注册-->
										<div class="layui-form-item">
											<label class="layui-form-label">注册方式</label>
											<div class="layui-input-block">
												<input type="radio" name="regcode-type" value="0" title="账号密码" <?php if($data['regcode-type'] == 0): ?> checked <?php endif; ?>>
												<input type="radio" name="regcode-type" value="1" title="短信验证" <?php if($data['regcode-type'] == 1): ?> checked <?php endif; if($data['code_switch'] != 1): ?> disabled <?php endif; ?>>
												<input type="radio" name="regcode-type" value="2" title="邮箱验证" <?php if($data['regcode-type'] == 2): ?> checked <?php endif; if($data['email_switch'] != 1): ?> disabled <?php endif; ?>>
											</div>
										</div>
										
									    <!--登录-->
										<div class="layui-form-item">
											<label class="layui-form-label">登录方式</label>
											<div class="layui-input-block">
												<input type="radio" name="logincode-type" value="0" title="账号密码" <?php if($data['logincode-type'] == 0): ?> checked <?php endif; ?>>
												<input type="radio" name="logincode-type" value="1" title="短信验证" <?php if($data['logincode-type'] == 1): ?> checked <?php endif; if($data['code_switch'] != 1): ?> disabled <?php endif; ?>>
												<input type="radio" name="logincode-type" value="2" title="邮箱验证" <?php if($data['logincode-type'] == 2): ?> checked <?php endif; if($data['email_switch'] != 1): ?> disabled <?php endif; ?>>
												<input type="radio" name="logincode-type" value="3" title="社交登录" <?php if($data['logincode-type'] == 3): ?> checked <?php endif; if($data['openlogin_type'] == 0): ?> disabled <?php endif; ?>>
											</div>
										</div>
									</div>
									<div id="Captcha">
										<div class="layui-form-item">
											<label class="layui-form-label">验证码</label>
											<div class="layui-input-block">
												<input type="radio" name="captcha-type" value="0"
													lay-filter="captcha-type" title="关闭" <?php if($data['captcha-type'] == 0): ?> checked <?php endif; ?>>
												<input type="radio" name="captcha-type" value="1"
													lay-filter="captcha-type" title="普通验证码" <?php if($data['captcha-type'] == 1): ?> checked <?php endif; ?>>
												<input type="radio" name="captcha-type" value="2"
													lay-filter="captcha-type" title="腾讯防水墙" <?php if($data['captcha-type'] == 2): ?> checked <?php endif; ?>>
												<input type="radio" name="captcha-type" value="3"
													lay-filter="captcha-type" title="极验行为验(第4代)" <?php if($data['captcha-type'] == 3): ?> checked <?php endif; ?>>
											</div>
										</div>
										<div id="tencent_Captcha" <?php if($data['captcha-type'] !=2): ?>
											style="display: none;" <?php endif; ?>>
											<div class="layui-form-item">
												<label class="layui-form-label">
													APPID
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" id="tencent_CaptchaAppId"
														class="layui-input" name="tencent_CaptchaAppId"
														value="<?php echo isset($data['tencent_CaptchaAppId']) ? htmlentities($data['tencent_CaptchaAppId']) : ''; ?>" type="text" />
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">
													SecretKey
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" id="tencent_CaptchaKey"
														class="layui-input" name="tencent_CaptchaKey"
														value="<?php echo isset($data['tencent_CaptchaKey']) ? htmlentities($data['tencent_CaptchaKey']) : ''; ?>" type="password" />
												</div>
											</div>
										</div>
										<div id="geetest_Captcha" <?php if($data['captcha-type'] !=3): ?>
											style="display: none;" <?php endif; ?>>
											<div class="layui-form-item">
												<label class="layui-form-label">
													APPID
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" id="geetest_CaptchaAppId"
														class="layui-input" name="geetest_CaptchaAppId"
														value="<?php echo isset($data['geetest_CaptchaAppId']) ? htmlentities($data['geetest_CaptchaAppId']) : ''; ?>" type="text" />
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">
													SecretKey
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" id="geetest_CaptchaKey"
														class="layui-input" name="geetest_CaptchaKey"
														value="<?php echo isset($data['geetest_CaptchaKey']) ? htmlentities($data['geetest_CaptchaKey']) : ''; ?>" type="password" />
												</div>
											</div>
										</div>
									</div>
									<hr />
									<!--注册协议-->
									<div id="Reg_agreement">
										<div class="layui-form-item" id='user_agreement'>
											<label class="layui-form-label">
												用户协议地址
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" id="user_agreement" class="layui-input"
													name="user_agreement" value="<?php echo isset($data['user_agreement']) ? htmlentities($data['user_agreement']) : ''; ?>"
													type="text" />
											</div>
										</div>
										<div class="layui-form-item" id='privacy'>
											<label class="layui-form-label">
												隐私政策地址
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" id="privacy" class="layui-input"
													name="privacy" value="<?php echo isset($data['privacy']) ? htmlentities($data['privacy']) : ''; ?>" type="text" />
											</div>
										</div>
									</div>
									<hr />
									<!--快捷登录-->
									<div id="Quick_login">
										<div class="layui-form-item">
											<label class="layui-form-label">快捷登录方式</label>
											<div class="layui-input-block">
												<input type="radio" name="openlogin_type" lay-filter="openlogin_type"
													value="0" title="关闭" <?php if($data['openlogin_type'] == 0): ?>
													checked <?php endif; ?>>
												<input type="radio" name="openlogin_type" lay-filter="openlogin_type"
													value="1" title="聚合登录" <?php if($data['openlogin_type'] == 1): ?> checked <?php endif; ?>>
												<input type="radio" name="openlogin_type" lay-filter="openlogin_type"
													value="2" title="QQ互联" <?php if($data['openlogin_type'] == 2): ?> checked <?php endif; ?>>
											</div>
										</div>
										<!--聚合登录-->
										<div id="polymerization" <?php if($data['openlogin_type'] == 0 || $data['openlogin_type'] == 2): ?>
											style="display: none;" <?php endif; ?>>
											<div class="layui-form-item" id='recommend'>
												<label class="layui-form-label">推荐平台</label>
												<div class="layui-input-block">
													<select name="recommend" lay-filter="recommend" lay-verify=""
														lay-search>
														<option value="">请选择要对接的聚合平台,自定义无需选择此项</option>
														<option value="http://login.9ym.net/">无岸聚合登录</option>
														<option value="http://juhe.k0sc.com/">爱Q聚合登录</option>
														<option value="https://www.1234id.com/">1234id聚合登录</option>
														<option value="https://hlqq.chunzewl.cn/">纯泽聚合登陆</option>
														<option value="https://juhe.zhanzhangniu.com/">智讯云聚合登陆</option>
													</select>
												</div>
											</div>
											<div class="layui-form-item" id='juhe_url'>
												<label class="layui-form-label">
													聚合地址
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" id="jurl" placeholder="请输入聚合登录地址,尾部需带/"
														class="layui-input" name="juhe_url"
														value="<?php echo isset($data['juhe_url']) ? htmlentities($data['juhe_url']) : ''; ?>" type="text" />
												</div>
											</div>
											<div class="layui-form-item" id="juhe_id">
												<label class="layui-form-label">
													APPID
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" class="layui-input" name="juhe_id"
														value="<?php echo isset($data['juhe_id']) ? htmlentities($data['juhe_id']) : ''; ?>" type="text" />
												</div>
											</div>
											<div class="layui-form-item" id="juhe_key">
												<label class="layui-form-label">
													APPKey
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" class="layui-input" name="juhe_key"
														value="<?php echo isset($data['juhe_key']) ? htmlentities($data['juhe_key']) : ''; ?>" type="password" />
												</div>
											</div>
										</div>
										<!--QQ互联-->
										<div id="QQ_Internet" <?php if($data['openlogin_type'] == 0 || $data['openlogin_type'] == 1): ?>
											style="display: none;" <?php endif; ?>>
											<div class="layui-form-item" id="qq_appid">
												<label class="layui-form-label">
													APPID
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" class="layui-input" name="qq_appid"
														value="<?php echo isset($data['qq_appid']) ? htmlentities($data['qq_appid']) : ''; ?>" type="text" />
												</div>
											</div>
											<div class="layui-form-item" id="qq_appkey">
												<label class="layui-form-label">
													APPKey
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" class="layui-input" name="qq_appkey"
														value="<?php echo isset($data['qq_appkey']) ? htmlentities($data['qq_appkey']) : ''; ?>" type="password" />
												</div>
											</div>
											<div class="layui-form-item" id="qq_callback">
												<label class="layui-form-label">
													回调地址:
												</label>
												<div class="layui-form-label">
													<?php echo $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
													$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))?'https://' :
													'http://';echo $_SERVER['HTTP_HOST'].'/Notify/qqcallback'; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--功能增强-->
								<div class="layui-tab-item">
								    <!--付费注册功能-->
									<div>
										<div class="layui-form-item">
											<label class="layui-form-label">
												付费注册
											</label>
											<div class="layui-input-block">
												<?php if($data['paid_reg'] == 0): ?>
												<input type="radio" name="paid_reg" value="0"
													lay-filter="paid_reg" title="关闭" checked>
												<input type="radio" name="paid_reg" value="1"
													lay-filter="paid_reg" title="开启">
												<?php else: ?>
												<input type="radio" name="paid_reg" value="0"
													lay-filter="paid_reg" title="关闭">
												<input type="radio" name="paid_reg" value="1"
													lay-filter="paid_reg" title="开启" checked>
												<?php endif; ?>
											</div>
										</div>
										<div class="layui-form-item" id="paid_reg" <?php if($data['paid_reg'] == 0): ?> style="display: none;" <?php endif; ?>>
											<label class="layui-form-label">
												收费金额
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" class="layui-input" name="paid_reg_price"
													value="<?php echo isset($data['paid_reg_price']) ? htmlentities($data['paid_reg_price']) : ''; ?>" type="text" />
											</div>
										</div>
									</div>
									<hr/>
									<!--注册赠送套餐-->
									<div>
										<div class="layui-form-item">
											<label class="layui-form-label">
												注册赠送套餐
											</label>
											<div class="layui-input-block">
												<?php if($data['is_reg_give_vip'] == 0): ?>
												<input type="radio" name="is_reg_give_vip" value="0"
													lay-filter="rvip" title="关闭" checked>
												<input type="radio" name="is_reg_give_vip" value="1"
													lay-filter="rvip" title="开启">
												<?php else: ?>
												<input type="radio" name="is_reg_give_vip" value="0"
													lay-filter="rvip" title="关闭">
												<input type="radio" name="is_reg_give_vip" value="1"
													lay-filter="rvip" title="开启" checked>
												<?php endif; ?>
											</div>
										</div>
										<div class="layui-form-item" id="reg_give_vip" <?php if($data['is_reg_give_vip'] == 0): ?> style="display: none;" <?php endif; ?>>
											<label class="layui-form-label">
												赠送套餐
											</label>
											<div class="layui-input-block">
												<select name="reg_give_vip">
												    <?php foreach ($vip as $value): ?>
                                                        <option value="<?php echo htmlentities($value['id']); ?>" <?php if($data['reg_give_vip'] == $value['id']): ?> selected <?php endif; ?>><?php echo htmlentities($value['name']); ?></option> 
                                                    <?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<hr />
									<!--注册赠送金额-->
									<div>
										<div class="layui-form-item">
											<label class="layui-form-label">
												注册赠送金额
											</label>
											<div class="layui-input-block">
												<?php if($data['is_reg_give_price'] == 0): ?>
												<input type="radio" name="is_reg_give_price" value="0"
													lay-filter="rtype" title="关闭" checked>
												<input type="radio" name="is_reg_give_price" value="1"
													lay-filter="rtype" title="开启">
												<?php else: ?>
												<input type="radio" name="is_reg_give_price" value="0"
													lay-filter="rtype" title="关闭">
												<input type="radio" name="is_reg_give_price" value="1"
													lay-filter="rtype" title="开启" checked>
												<?php endif; ?>
											</div>
										</div>
										<div class="layui-form-item" id="reg_give" <?php if($data['is_reg_give_price'] == 0): ?> style="display: none;" <?php endif; ?>>
											<label class="layui-form-label">
												赠送金额
											</label>
											<div class="layui-input-block">
												<input autocomplete="off" class="layui-input" name="reg_give_price"
													value="<?php echo isset($data['reg_give_price']) ? htmlentities($data['reg_give_price']) : ''; ?>" type="text" />
											</div>
										</div>
									</div>
									<hr />
									<!--邀请返利-->
									<div>
										<div class="layui-form-item">
											<label class="layui-form-label">
												邀请返利
											</label>
											<div class="layui-input-block">
												<?php if($data['is_aff'] == 0): ?>
												<input type="radio" name="is_aff" value="0" lay-filter="is_aff"
													title="关闭" checked>
												<input type="radio" name="is_aff" value="1" lay-filter="is_aff"
													title="开启">
												<?php else: ?>
												<input type="radio" name="is_aff" value="0" lay-filter="is_aff"
													title="关闭">
												<input type="radio" name="is_aff" value="1" lay-filter="is_aff"
													title="开启" checked>
												<?php endif; ?>
											</div>
										</div>
										<div id="aff_type" <?php if($data['is_aff'] == 0): ?> style="display: none;"
											<?php endif; ?>>
											<div class="layui-form-item">
												<label class="layui-form-label">
													返利类型
												</label>
												<div class="layui-input-block">
													<?php if($data['aff_type'] == 0): ?>
													<input type="radio" name="aff_type" value="0" lay-filter="aff_type"
														title="充值返利" checked>
													<input type="radio" name="aff_type" value="1" lay-filter="aff_type"
														title="套餐返利">
													<?php else: ?>
													<input type="radio" name="aff_type" value="0" lay-filter="aff_type"
														title="充值返利">
													<input type="radio" name="aff_type" value="1" lay-filter="aff_type"
														title="套餐返利" checked>
													<?php endif; ?>
												</div>
											</div>
											<div class="layui-form-item">
												<label class="layui-form-label">
													返利比例
												</label>
												<div class="layui-input-block">
													<input autocomplete="off" class="layui-input" name="aff_percentage"
														value="<?php echo isset($data['aff_percentage']) ? htmlentities($data['aff_percentage']) : ''; ?>" type="text"
														placeholder="请输入0-1之间" />
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="layui-input-block" style="min-height: 80px;">
							<button type="submit" lay-submit lay-filter="submit"
								class="pear-btn pear-btn-primary">保存</button>
							<button type="reset" class="pear-btn">重置</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script>
		layui.use(['form', 'jquery', 'uploads','element','tinymce'], function() {
				let form = layui.form;
				let $ = layui.jquery;
				var element = layui.element;
				var tinymce = layui.tinymce;
				
				// 根据菜单栏刷新数据
				var layid = location.hash.replace(/^#menu=/, '');
                element.tabChange('menu', layid);
                element.on('tab(menu)', function(){
                    location.hash = 'menu='+ this.getAttribute('lay-id');
                });
                
                // 加载编辑器
                tinymce.render({
                    elem: "#index_popup", 
                    width: "80%",
                    height: 250,
                    automatic_uploads: false,
                    menubar: 'edit insert tools',
                    images_upload_handler: function (blobInfo, succFun, failFun) {
                            var xhr, formData;
                            var file = blobInfo.blob();//转化为易于理解的file对象
                            xhr = new XMLHttpRequest();
                            xhr.withCredentials = false;
                            xhr.open('POST', '<?php echo htmlentities(app('request')->root()); ?>/index/upload');
                            formData = new FormData();
                            formData.append('file', file, file.name );
                            xhr.send(formData);
                    }
                },(opt, edit)=>{
                    // 加载完成后回调 opt 是传入的所有参数
                    // edit是当前编辑器实例，等同于t.get返回值
                });
                
                tinymce.render({
                    elem: "#reg_popup", 
                    width: "80%",
                    height: 250,
                    automatic_uploads: false,
                    menubar: 'edit insert tools',
                    images_upload_handler: function (blobInfo, succFun, failFun) {
                            var xhr, formData;
                            var file = blobInfo.blob();//转化为易于理解的file对象
                            xhr = new XMLHttpRequest();
                            xhr.withCredentials = false;
                            xhr.open('POST', '<?php echo htmlentities(app('request')->root()); ?>/index/upload');
                            formData = new FormData();
                            formData.append('file', file, file.name );
                            xhr.send(formData);
                    }
                },(opt, edit)=>{
                    // 加载完成后回调 opt 是传入的所有参数
                    // edit是当前编辑器实例，等同于t.get返回值
                });
                
                tinymce.render({
                    elem: "#sh_notice", 
                    width: "80%",
                    height: 250,
                    automatic_uploads: false,
                    menubar: 'edit insert tools',
                    images_upload_handler: function (blobInfo, succFun, failFun) {
                            var xhr, formData;
                            var file = blobInfo.blob();//转化为易于理解的file对象
                            xhr = new XMLHttpRequest();
                            xhr.withCredentials = false;
                            xhr.open('POST', '<?php echo htmlentities(app('request')->root()); ?>/index/upload');
                            formData = new FormData();
                            formData.append('file', file, file.name );
                            xhr.send(formData);
                    }
                },(opt, edit)=>{
                    // 加载完成后回调 opt 是传入的所有参数
                    // edit是当前编辑器实例，等同于t.get返回值
                });
                
                tinymce.render({
                    elem: "#td_notice", 
                    width: "80%",
                    height: 250,
                    automatic_uploads: false,
                    menubar: 'edit insert tools',
                    images_upload_handler: function (blobInfo, succFun, failFun) {
                            var xhr, formData;
                            var file = blobInfo.blob();//转化为易于理解的file对象
                            xhr = new XMLHttpRequest();
                            xhr.withCredentials = false;
                            xhr.open('POST', '<?php echo htmlentities(app('request')->root()); ?>/index/upload');
                            formData = new FormData();
                            formData.append('file', file, file.name );
                            xhr.send(formData);
                    }
                },(opt, edit)=>{
                    // 加载完成后回调 opt 是传入的所有参数
                    // edit是当前编辑器实例，等同于t.get返回值
                });
                
                
				//提交数据
				form.on('submit(submit)', function(data) {
				    data.field['index_popup'] = tinymce.get('#index_popup').getContent();
				    data.field['reg_popup'] = tinymce.get('#reg_popup').getContent();
				    data.field['sh_notice'] = tinymce.get('#sh_notice').getContent();
				    data.field['td_notice'] = tinymce.get('#td_notice').getContent();
					//获取发信配置邮箱开关参数
					var email_switch = $('#email_switch').val();
					//获取发信配置短信开关参数
					var code_switch = $('#code_switch').val();
					
					//判断处理和默认设置登录注册方式开关
					if (email_switch == 0 && code_switch == 0) {
						data.field['logincode-type'] = 0;
						data.field['regcode-type'] = 0;
						data.field['retrieve-type'] = 0;
					} else if (email_switch == 0 && data.field['logincode-type'] == 2) {
						data.field['logincode-type'] = 0;
					} else if (code_switch == 0 && data.field['logincode-type'] == 1) {
						data.field['logincode-type'] = 0;
					} else if (email_switch == 0 && data.field['regcode-type'] == 2) {
						data.field['regcode-type'] = 0;
					} else if (code_switch == 0 && data.field['regcode-type'] == 1) {
						data.field['regcode-type'] = 0;
					} else if (data.field['openlogin_type'] == 0 && data.field['logincode-type'] == 3) {
						data.field['logincode-type'] = 0;
					}else if (email_switch == 0 && data.field['retrieve-type'] == 2) {
						data.field['retrieve-type'] = 0;
					} else if (code_switch == 0 && data.field['retrieve-type'] == 1) {
						data.field['retrieve-type'] = 0;
					} 
					//把参数传入
					data.field.email_switch = email_switch;
					data.field.code_switch = code_switch;
					$.ajax({
						data: JSON.stringify(data.field),
						dataType: 'json',
						contentType: 'application/json',
						type: 'post',
						success: function(res) {
							if (res.code == 1) {
								layer.msg(res.msg, {
									icon: 1,
									time: 1000,
								},function(){
								    $(window.parent.document).find("iframe")[0].contentWindow.location.reload(true);

								})
								
								return false;
							} else {
								layer.msg(res.msg, {
									icon: 5,
									time: 1000
								});
							}
						}
					})
					return false;
				});

				//上传存储
				form.on('radio(type)', function(data) {
					if (data.value == 1) {
						$("#oss").hide();
						$("#qiniu").hide();
					}
					if (data.value == 2) {
						$("#oss").show();
						$("#qiniu").hide();
					}
					if (data.value == 3) {
						$("#qiniu").show();
						$("#oss").hide();
					}
				});

				//邮箱发信
				form.on('switch(email_switch)', function(data) {
					var id = this.checked ? 1 : 0;
					if (this.checked) {
						$('#email').show();
					} else {
						$('#email').hide();
					}
					$('#email_switch').val(id);

				});

				//短信发信
				form.on('switch(code_switch)', function(data) {
					var id = this.checked ? 1 : 0;
					if (this.checked) {
						$('#code').show();
					} else {
						$('#code').hide();
					}
					$('#code_switch').val(id);

				});

				//短信类型
				form.on('radio(stype)', function(data) {
					if (data.value == 1) {
						$("#tencentsms").hide();
						$("#smsbao").hide();
						$("#alisms").show();
					}
					if (data.value == 2) {
						$("#alisms").hide();
						$("#smsbao").hide();
						$("#tencentsms").show();
					}
					if (data.value == 3) {
						$("#alisms").hide();
						$("#tencentsms").hide();
						$("#smsbao").show();
					}
				});


				form.on('select(smsbao_xuanze)', function(data) {
					$('#smsbao-api').val(data.value);

				});
				
				// 支付类型切换
				form.on('radio(paytype)', function(data) {
					if (data.value == 0) {
						$("#front_pay").show();
						$("#demo_pay").hide();
					}
					if (data.value == 1) {
						$("#front_pay").hide();
						$("#demo_pay").show();
					}
				});

                // 前台微信充值方式切换
                form.on('select(front_wechat_pay)',function(data){
                    if(data.value == 'close'){
                        $('#epay_wechat').hide();
                    }else{
                        $('#epay_wechat').show();
                    }
                });
                
                // 前台支付宝充值方式切换
                form.on('select(front_ali_pay)',function(data){
                    if(data.value == 'close'){
                        $('#epay_ali').hide();
                    }else{
                        $('#epay_ali').show();
                    }
                });
                
				// 登录/注册/找回背景
				form.on('radio(bgtype)', function(data) {
					if (data.value == 0) {
						$("#local_bg").show();
						$("#api_bg").hide();
					}
					if (data.value == 1) {
						$("#local_bg").hide();
						$("#api_bg").show();
					}
				});
                
                // 付费注册
				form.on('radio(paid_reg)', function(data) {
					if (data.value == 1) {
						$("#paid_reg").show();
					} else {
						$("#paid_reg").hide();
					}
				});
                
                // 注册赠送套餐
				form.on('radio(rvip)', function(data) {
					if (data.value == 1) {
						$("#reg_give_vip").show();
					} else {
						$("#reg_give_vip").hide();
					}
				});
                
				// 注册赠送金额
				form.on('radio(rtype)', function(data) {
					if (data.value == 1) {
						$("#reg_give").show();
					} else {
						$("#reg_give").hide();
					}
				});

				//邀请返利
				form.on('radio(is_aff)', function(data) {
					if (data.value == 1) {
						$("#aff_type").show();
					} else {
						$("#aff_type").hide();
					}
				});

				//下拉获取参数
				form.on('select(recommend)', function(data) {
					$('#jurl').val(data.value);

				});

				// 行为验证
				form.on('radio(captcha-type)', function(data) {
					if (data.value == 2) {
						$("#tencent_Captcha").show();
						$("#geetest_Captcha").hide();
					} else if (data.value == 3) {
						$("#tencent_Captcha").hide();
						$("#geetest_Captcha").show();
					} else {
						$("#tencent_Captcha").hide();
						$("#geetest_Captcha").hide();
					}
				});

				// 快捷登录
				form.on('radio(openlogin_type)', function(data) {
					if (data.value == 1) {
						$("#polymerization").show();
						$("#QQ_Internet").hide();
					} else if (data.value == 2) {
						$("#polymerization").hide();
						$("#QQ_Internet").show();
					} else {
						$("#polymerization").hide();
						$("#QQ_Internet").hide();
					}
				});

			});
            
		</script>
	</body>
</html>
