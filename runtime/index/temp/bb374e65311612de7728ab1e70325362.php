<?php /*a:3:{s:69:"/www/wwwroot/pay.xn--tnq769am5klza737gu1l.cn/view/index/user/reg.html";i:1669958104;s:77:"/www/wwwroot/pay.xn--tnq769am5klza737gu1l.cn/view/index/core/user_header.html";i:1669957192;s:76:"/www/wwwroot/pay.xn--tnq769am5klza737gu1l.cn/view/index/core/reg_bottom.html";i:1669967482;}*/ ?>
<!doctype html>
<html lang="zh-CN">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<title>注册 - <?php echo $config['sitename']; ?></title>
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
<div class="mb-4 login-page-title">
	<p>注册新账户</p>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="form-group position-relative">
			<label class="text-muted">账户 *</label>
			<div class="input-group mb-3">
				<input type="text" class="form-control pl-3" placeholder="请输入您的账户(英文|数字)" name="username" required="">
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group position-relative">
			<label class="text-muted">密码 *</label>
			<input type="password" class="form-control pl-3" placeholder="请输入密码" name="password" required="">
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group position-relative">
			<label class="text-muted">确认密码 *</label>
			<input type="password" class="form-control pl-3" placeholder="再次输入密码" name="password2" lay-verify="equalTo"
				lay-equalTo="[name=password]" required="">
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group position-relative">
			<label class="text-muted">邮箱 *</label>
			<div class="input-group mb-3">
				<input type="text" class="form-control pl-3" placeholder="请输入邮箱" name="email" id="email" required="">
			</div>
		</div>
	</div>


	<?php if($config['regcode-type']== '1'): ?>
	<div class="col-lg-12">
		<div class="form-group position-relative">
			<label class="text-muted">手机号 *</label>
			<div class="input-group mb-3">
				<input type="text" class="form-control pl-3" placeholder="请输入手机号" name="mobile" id="mobile" required="">
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group position-relative">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="短信验证码 *" name="captcha" aria-label="请输入短信验证码"
					aria-describedby="send-email-code">
				<div class="input-group-append">
					<button class="btn btn-outline-secondary go-send-email-code" type="button"
						id="send-code">发送验证码</button>
				</div>
			</div>
		</div>
	</div>
	<?php endif; if($config['regcode-type'] == '2'): ?>
	<div class="col-lg-12">
		<div class="form-group position-relative">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="邮箱验证码 *" name="captcha" aria-label="请输入邮箱验证码"
					aria-describedby="send-email-code">
				<div class="input-group-append">
					<button class="btn btn-outline-secondary go-send-email-code" type="button"
						id="send-code">发送验证码</button>
				</div>
			</div>
		</div>
	</div>
	<?php endif; if($config['captcha-type'] == '1'): ?>
	<div class="col-lg-12">
		<div class="form-group position-relative">
			<label class="text-muted">验证码</label>
			<div class="captcha_div">
				<input class="form-control" name="ordinary_captcha" placeholder="请输入验证码" autocomplete="off"
					lay-verType="tips" lay-verify="required" required />
				<img id="codeimg" class="login-captcha" alt="" />
			</div>
		</div>
	</div>
	<?php elseif($config['captcha-type'] == '2'): ?>
	<!-- 动态引入验证码JS示例 -->
	<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
	<div class="col-12" id='tencentCaptcha'><button type="button" class="TencentCaptcha btn btn-light w-100 mb-3"
			id="TencentCaptcha" data-appid="<?php echo $config['tencent_CaptchaAppId']; ?>" data-cbfn="qq_captcha_callback"
			lay-filter="qq_captcha_callback" lay-submit><span class="spinner-grow spinner-grow-sm text-primary mr-2"
				role="status" aria-hidden="true"></span>点击按钮进行验证</button></div>
	<?php elseif($config['captcha-type'] == '3'): ?>
	<script src="https://static.geetest.com/v4/gt4.js"></script>
	<div class="col-12" id='geetest_captcha'></div>
	<?php endif; ?>
	<div class="col-12 mb-2">

		<small class="text-muted">
			<input type="checkbox" name="igree" id="igree" style="display:inline;" checked>
			注册登录即表示同意 <a class="btn-link" href="<?php echo $config['user_agreement']; ?>">用户协议</a>、<a class="btn-link"
				href="<?php echo $config['privacy']; ?>">隐私政策</a>
		</small>
	</div>
	<div class="col-lg-12 mb-0">
		<button class="btn btn-primary w-100 go-register" lay-filter="loginSubmit" lay-submit>立即注册</button>
	</div>

	<div class="col-12 text-center">
		<p class="mb-0 mt-3"><small class="mr-2">已有账号 ?</small> <a href="/User/Login" class="btn-link">立即登录</a></p>
	</div>
</div>
</form>
</div>
<div class="position-abs d-lg-block d-none">
	<div class="footer-copyright text-center">
		<p class="m-0 small">Copyright © 2022 <a href="/"><?php echo $config['sitename']; ?></a> - All
			rights reserved<span class="sep"> | </span><a href="https://beian.miit.gov.cn" target="_blank"
				rel="noreferrer nofollow"><?php echo $config['icp']; ?></a></p>
	</div>
</div>

</div>
</div>

</main>

</div>
		<input id='functions' value="Reg" type="text" hidden>
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
				    // 获取对应方法名称
                    var functions = $("#functions").val();
                    // 获取用户名判断是否违规
				    var username = obj.form.username.value;
				    var check = check_user_name(username);
				    if(check){
				        return false;
				    }
				    var igree = obj.form.igree.checked;
                    if(!igree){
                        layer.msg("你未同意用户注册协议不允许注册", {
							icon: 2,
							anim: 6
						});
						f5Captcha();
                        return false;
                    }
                    
					var loadIndex = layer.load(2);
					$.post('/User/' + functions, obj.field, function(res) {
						layer.close(loadIndex);
						if (res.code === 200) {
							layer.msg('注册成功', {
								icon: 1,
								time: 1500
							}, function() {
								location.href = '/User/Login';
							});
						}else if(res.code === 888){
						    var paymsg = '';
					        $.each(res.paytype, function(key, value) {
					        	paymsg+='<button class="btn btn-default btn-block" onclick="window.location.href=\'../Pay/Reg?typeid='+value.name+'&trade_no='+res.trade_no+'\'" style="margin-top:10px;"><img width="20" src="/static/index/images/icon/'+value.name+'.ico" class="logo">'+value.showname+'</button>';
				    	    });
					        layer.alert('<center><h2>￥ '+res.need+'</h2><hr>'+paymsg+'<hr>提示：支付完成后即可直接登录</center>',{
						        btn:[],
						        title:'支付确认页面',
						        closeBtn: false
					        });
						}else {
							layer.msg(res.msg, {
								icon: 2,
								anim: 6
							});
							f5Captcha();
						}
					}, 'json');
					return false;
				});
				
				// 检查用户名是否合法        合法就返回"该用户名合法"
                function check_user_name(str)
                {
                    var info = 0;
                    var spec =["admin","root"];		
	                for (var i=0;i<spec.length;i++ )
	                {
	                	if (str.match(spec[i]) )
	                	{
						    info = "账户不能含有" + spec[i];
	                	}
	                	
	                }
                    if ("" == str)
                    {
                        info = "账户不能为空";
                    }
                    else if (check_other_char(str))
                    {
                        info = "账户不能含有特殊字符";
                    }
                    else if ((str.length < 5) || (str.length > 12))
                    {
                        info = "账户必须为5 ~ 12位";
                    }
	                if(info != 0){
	                    layer.msg(info, {
							icon: 2,
							anim: 6
					    }  );
					    return true;
	                }
                }
                // 验证用户名是否含有特殊字符
                function check_other_char(str)
                {
                    var arr = ["&", "\\", "/", "*", ">", "<", "@", "!"];
                    for (var i = 0; i < arr.length; i++)
                    {
                        for (var j = 0; j < str.length; j++)
                        {
                            if (arr[i] == str.charAt(j))
                            {
                                return true;
                            }
                        }
                    }   
                    return false;
                }
                
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
				$('#send-code').click(function(data) {
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
					$.post('/User/getRegCode', {
						email: email,
						mobile: mobile
					}, function(res) {
						if (res.code === 200) {
							setTimeout(function() {
								formX.startTimer('#send-code', 60, function(t) {
									return '已发送(' + t + 's)';
								});
							}, 600);
							return false;
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
<?php if($config['reg_popup'] != null || $config['reg_popup'] != ''): ?>
<div class="web_notice" style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0,0,0,0.3);z-index: 99999;">
<div style="position: fixed;top: 50%;left: 50%;width: 350px;background: #FFF;transform: translate(-50%, -50%);border-radius: 40px;padding: 50px 40px;">
<h3 style="font-weight: bold;text-align: center;font-size: 30px;">注册须知</h3>
<div style="font-size: 16px;margin-top: 26px;line-height: 30px;color: #999;"><br/>
<font color="purple"><?php echo $config['reg_popup']; ?>
</div>
<a style="display: block;background: #98a3ff;color: #FFF;text-align: center;font-weight: bold;font-size: 19px;line-height: 60px;margin: 0 auto;margin-top: 45px;border-radius: 32px;width: 80%;" onclick="javascript:document.querySelector('.web_notice').remove()">好的</a>
</div>
</div>
<?php endif; ?>
	</body>
</html>