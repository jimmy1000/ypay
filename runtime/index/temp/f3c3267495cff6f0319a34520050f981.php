<?php /*a:2:{s:48:"/www/wwwroot/fttqq.cn/view/index/user/login.html";i:1669967512;s:54:"/www/wwwroot/fttqq.cn/view/index/core/user_header.html";i:1669957192;}*/ ?>
 <!doctype html>
<html lang="zh-CN">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<title>登录 - <?php echo $config['sitename']; ?></title>
		<meta name="keywords" content="<?php echo $config['key']; ?>">
        <meta name="description" content="<?php echo $config['desc']; ?>">
		<link rel='stylesheet' id='bootstrap-css' href='/static/index/css/bootstrap.min.css' media='all' />
		<link rel='stylesheet' id='app-css' href='/static/index/css/app.css' media='all' />
		 <link rel="stylesheet" href="/wwwroot/layui/assets/libs/layui/css/layui.css" />
		<style>
		    .captcha_div{
		       position: relative; 
		    }
		    #geetest_captcha{
		        margin-bottom: 15px;
		    }
		    .geetest_holder{
		        width:100%  !important;
		    }
		    .geetest_btn_svg{
		        display: none;
		    }
			.login-captcha {
				height: 39px;
				width: 106px;
				cursor: pointer;
				box-sizing: border-box;
				border: 1px solid #e6e6e6;
				border-radius: 2px !important;
				position: absolute;
				right: 0;
				top: 0;
			}
			.layui-form-checkbox{
			    display: none;
			}
		</style>
	</head>
	<body
		class="page-template page-template-pages page-template-page-login page-template-pagespage-login-php page page-id-1209 navbar-sticky pagination-infinite_button no-off-canvas sidebar-right">
		<div id="app" class="site">

			<div lass="header-gap"></div>

			<main id="main" role="main" class="site-content">
			     <?php if($config['bgtype'] == '0'): ?>
				<div class="bg-img-cover" style="background-image: url('<?php echo $config['bg']; ?>')"></div>
				<?php else: ?>
				<div class="bg-img-cover" style="background-image: url('<?php echo $config['api_bg']; ?>')"></div>
                <?php endif; ?>
				<div class="container">
					<div class="row justify-content-center align-items-center login-warp">
						<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">

							<!-- Form -->
							<form class="layui-form js-validate card p-lg-5 p-4">
								<div class="d-flex flex-center mb-4">
									<div class="logo-wrapper">
										<a href="/">
											<img class="logo regular" src="<?php echo $config['logo']; ?>" alt="<?php echo $config['sitename']; ?>" style="width:162px;">
										</a>

									</div>
								</div>
								<!-- Title -->
								<div class="mb-4 login-page-title" <?php if($config['logincode-type'] ==3): ?> style="display: none;" <?php endif; ?>>
									<p>登录您的账户</p>
								</div>
								<!-- End Title -->
								<div class="row" <?php if($config['logincode-type'] ==3): ?> style="display: none;" <?php endif; ?>>
								    <?php if($config['logincode-type'] == '0'): ?>
										<div class="col-lg-12">
										<div class="form-group position-relative">
											<label class="text-muted">账号 *</label>
											<input type="input" class="form-control pl-3" placeholder="请输入用户名"
												name="username" required="">
										</div>
									</div>
    									<div class="col-lg-12">
    										<div class="form-group position-relative">
    											<label class="text-muted">密码 *
    											<?php if($config['retrieve-type'] != 0): ?>
    											<a class="ml-2 btn-link" href="/User/lostpwd">忘记密码？</a>
    											<?php endif; ?>
    											</label>
    											<input type="password" class="form-control pl-3" placeholder="请输入密码"
    												name="password" required="">
    										</div>
									</div>
									<?php endif; ?>
    									
									<!--{/if}-->
									<?php if($config['logincode-type'] == '2'): ?>
    									<div class="col-lg-12">
    									  <div class="form-group position-relative">
    											<label class="text-muted">邮箱 *</label>
    											<input type="email" class="form-control pl-3" placeholder="请输入邮箱"
    												name="email" id="email" required="">
    										</div>
    									</div>
    									<div class="col-lg-12">
    										<div class="form-group position-relative">
    											<div class="input-group mb-3">
    												<input type="text" class="form-control" placeholder="邮箱验证码 *"
    													name="captcha" aria-label="请输入邮箱验证码"
    													aria-describedby="send-email-code" >
    												<div class="input-group-append">
    													<button class="btn btn-outline-secondary go-send-email-code"
    														type="button" id="send-code">发送验证码</button>
    												</div>
    											</div>
    										</div>
    									</div>
									<?php endif; if($config['logincode-type'] == '1'): ?>
    									 <div class="col-lg-12">
    										<div class="form-group position-relative">
    											<label class="text-muted">手机号 *</label>
    											<input type="text" class="form-control pl-3" id="mobile" placeholder="请输入手机号"
    												name="mobile"  required="">
    										</div>
    									</div>
    									<div class="col-lg-12">
    										<div class="form-group position-relative">
    											<div class="input-group mb-3">
    												<input type="text" class="form-control" placeholder="短信验证码 *"
    													name="captcha" aria-label="请输入短信验证码"
    													aria-describedby="send-code" >
    												<div class="input-group-append">
    													<button class="btn btn-outline-secondary go-send-email-code"
    														type="button" id="send-code">发送验证码</button>
    												</div>
    											</div>
    										</div>
    									</div>
									<?php endif; if($config['captcha-type'] == '1'): ?>
									<div class="col-lg-12">
    										<div class="form-group position-relative">
    											<label class="text-muted">验证码</label>
    											<div class="captcha_div">
    												<input class="form-control" name="ordinary_captcha" placeholder="请输入验证码"
    													autocomplete="off" lay-verType="tips" lay-verify="required"
    													required />
    												<img id="codeimg" class="login-captcha" alt="" />
    											</div>
    										</div>
    									</div>
									<?php elseif($config['captcha-type'] == '2'): ?>
									    <!-- 动态引入验证码JS示例 -->
                                        <script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
										<div class="col-12" id='tencentCaptcha'><button type="button" class="TencentCaptcha btn btn-light w-100 mb-3" id="TencentCaptcha" data-appid="<?php echo $config['tencent_CaptchaAppId']; ?>" data-cbfn="qq_captcha_callback" lay-filter="qq_captcha_callback" lay-submit><span class="spinner-grow spinner-grow-sm text-primary mr-2" role="status" aria-hidden="true"></span>点击按钮进行验证</button></div>
									<?php elseif($config['captcha-type'] == '3'): ?>
									    <script src="https://static.geetest.com/v4/gt4.js"></script>
										<div class="col-12" id='geetest_captcha'></div>
									<?php endif; ?>
									<div class="col-lg-12 mb-0">
										<button class="btn btn-primary w-100 go-login " lay-filter="loginSubmit"
											lay-submit>立即登录</button>
									</div>
									<div class="col-12 text-center">
										<p class="mb-0 mt-3"><small class="text-dark mr-2">还没有账号，现在注册?</small> <a
												href="/User/Reg" class="btn-link">注册新用户</a></p>
									</div>
								</div>

								<!-- //第三方登录 -->
								<?php if($config['openlogin_type'] != '0' && $config['openlogin_type'] != '2'): ?>
								<div class="d-block mt-1 mb-0 text-center">
								    <div class="social-text">
								        <hr class="text-300">
								          <div class="absolute-centered px-3">社交登录</div>
								    </div>
								    <ul class="oauth list-unstyled social-icon mb-0 mt-3">
								        <li class="list-inline-item">
								            <a href="/User/OAuthAccountLogin?type=qq" class="btn btn-sm btn-outline-primary oauth-btn qq">QQ</a>
								        </li>
								        <li class="list-inline-item">
								            <a href="/User/OAuthAccountLogin?type=wx" class="btn btn-sm btn-outline-success oauth-btn weixin mpweixin">微信</a>
								        </li>
								    </ul>
								</div>
							   <?php elseif($config['openlogin_type'] != '0' && $config['openlogin_type'] != '1'): ?>
							    <div class="d-block mt-1 mb-0 text-center">
								    <div class="social-text">
								        <hr class="text-300">
								          <div class="absolute-centered px-3">社交登录</div>
								    </div>
								    <ul class="oauth list-unstyled social-icon mb-0 mt-3">
								        <li class="list-inline-item">
								            <a href="/User/qqlogin" class="btn btn-sm btn-outline-primary oauth-btn qq">QQ</a>
								        </li>
								    </ul>
								</div>
							   <?php endif; ?>
							</form>
							<!-- End Form -->
						</div>
						<div class="position-abs d-lg-block d-none">
							<div class="footer-copyright text-center">
								<p class="m-0 small">Copyright © 2022 <a href="/"><?php echo $config['sitename']; ?></a> - All
									rights reserved<span class="sep"> | </span><a href="https://beian.miit.gov.cn"
										target="_blank" rel="noreferrer nofollow"><?php echo $config['icp']; ?></a></p>
							</div>
						</div>

					</div>
				</div>

			</main>

		</div>


		<!-- js部分 -->
		<script type="text/javascript" src="/wwwroot/layui/assets/libs/layui/layui.js"></script>
		<script src="/wwwroot/layui/assets/js/common.js"></script>
		<script>
			layui.use(['layer', 'form', 'formX'], function() {
				var $ = layui.jquery;
				var layer = layui.layer;
				var form = layui.form;
				var formX = layui.formX;
				/* 表单提交 */
				form.on('submit(loginSubmit)', function(obj) {
					var loadIndex = layer.load(2);
					$.post('/User/Login', obj.field, function(res) {
						layer.close(loadIndex);
						if (res.code === 200) {
							layer.msg('登录成功', {
								icon: 1,
								time: 1500
							}, function() {
								location.replace('/User/Index');
							});
						} else {
							layer.msg(res.msg, {
								icon: 2,
								anim: 6
							});
							f5Captcha();
						}
					}, 'json');
					return false;
				});
				
				//腾讯防水墙
				form.on('submit(qq_captcha_callback)', function() {

					// 定义回调函数
                 function callback(res) {
                    // 第一个参数传入回调结果，结果如下：
                    // ret         Int       验证结果，0：验证成功。2：用户主动关闭验证码。
                    // ticket      String    验证成功的票据，当且仅当 ret = 0 时 ticket 有值。
                    // CaptchaAppId       String    验证码应用ID。
                    // bizState    Any       自定义透传参数。
                    // randstr     String    本次验证的随机串，后续票据校验时需传递该参数。
                    // res（用户主动关闭验证码）= {ret: 2, ticket: null}
                    // res（验证成功） = {ret: 0, ticket: "String", randstr: "String"}
                    // res（请求验证码发生错误，验证码自动返回terror_前缀的容灾票据） = {ret: 0, ticket: "String", randstr: "String",  errorCode: Number, errorMessage: "String"}
                    // 此处代码仅为验证结果的展示示例，真实业务接入，建议基于ticket和errorCode情况做不同的业务处理
                    if (res.ret === 0) {
                        var loadIndex = layer.load(2);
                        $.post('/User/Captcha',res, function(res) {
                            layer.close(loadIndex);
						if (res.code == 200) {
	                       $('#tencentCaptcha').html('<button type="button" class="TencentCaptcha btn btn-light w-100 mb-3" id="TencentCaptcha" data-appid="<?php echo $config['tencent_CaptchaAppId']; ?>" data-cbfn="qq_aptcha_callback" disabled="disabled" style="background-color: rgb(139, 195, 74); color: rgb(255, 255, 255);"><i class="layui-icon layui-icon-ok"></i> &nbsp;验证通过</button>');
						}
					}, 'json');
					return false;
                        // // 复制结果至剪切板
                        // var str = '【randstr】->【' + res.randstr + '】      【ticket】->【' + res.ticket + '】';
                        // var ipt = document.createElement('input');
                        // ipt.value = str;
                        // document.body.appendChild(ipt);
                        // ipt.select();
                        // document.execCommand("Copy");
                        // document.body.removeChild(ipt);
                    }
            }

                // 定义验证码js加载错误处理函数
                function loadErrorCallback() {
                  var appid = ''
                   // 生成容灾票据或自行做其它处理
                  var ticket = 'terror_1001_' + appid + Math.floor(new Date().getTime() / 1000);
                  callback({
                    ret: 0,
                    randstr: '@'+ Math.random().toString(36).substr(2),
                    ticket,
                    errorCode: 1001,
                    errorMessage: 'jsload_error',
                  });
                }
                
                			 try {
                           // 生成一个验证码对象
                           // CaptchaAppId：登录验证码控制台，从【验证管理】页面进行查看。如果未创建过验证，请先新建验证。注意：不可使用客户端类型为小程序的CaptchaAppId，会导致数据统计错误。
                           //callback：定义的回调函数
                           var captcha = new TencentCaptcha('<?php echo $config['tencent_CaptchaAppId']; ?>', callback, {});
                           // 调用方法，显示验证码
                           captcha.show(); 
                     } catch (error) {
                     // 加载异常，调用验证码js加载错误处理函数
                           loadErrorCallback();
                    }  
				});
				
				<?php if($config['captcha-type'] == '3'): ?>
				//极验行为验证
				initGeetest4({
                    captchaId: '<?php echo $config['geetest_CaptchaAppId']; ?>',
                },function (captcha) {
                    // captcha为验证码实例
                    captcha.appendTo("#geetest_captcha");// 调用appendTo将验证码插入到页的某一个元素中，这个元素用户可以自定义
                    captcha.onSuccess(function () {
                        var result = captcha.getValidate();
					   $.post('/User/Captcha', result , function(res) {
					           	console.log(res);
                         }).onError(function(){
                             //your code
                            });
                        });
                });
				<?php endif; ?>
				// 获取验证码
            $('#send-code').click(function (data) {
                var email = $("#email").val();
                var mobile = $("#mobile").val();
                var type = "<?php echo $config['logincode-type']; ?>";
                if(type==1){
                    if (mobile == null || mobile == "") {
                    layer.msg("请输入您的手机号", { icon: 2, anim: 6 });
                    f5Captcha();
                    return false;
                }
                }else{
                    if (email == null || email == "") {
                    layer.msg("请输入您的邮箱", { icon: 2, anim: 6 });
                    f5Captcha();
                    return false;
                }
                }
                //点击一次之后禁止继续点击
                $('#send-code').attr('disabled',"true");
                $.post('/User/getLoginCode', {
                    email: email,
                    mobile: mobile
                }, function (res) {
                    if (res.code ===200)
                    {
                        
                        setTimeout(function () {
                            formX.startTimer('#send-code', 60, function (t) {
                                return '已发送(' + t + 's)';
                            });
                        }, 600);
                        return false;
                    } else
                    {
                        layer.msg(res.msg, { icon: 2, anim: 6 });
                        f5Captcha();
                    }
                }, 'json');
                return false;
            });

				/* 图形验证码 */
				var captchaUrl = '/User/Verify';
				$('img.login-captcha').click(function() {
				    f5Captcha();
				}).trigger('click');
                
                function f5Captcha(){
                    var img = captchaUrl + '?t=' + (new Date).getTime();
                    $('img.login-captcha').attr('src',img);
                }

			});
		</script>
       
	</body>
</html>
