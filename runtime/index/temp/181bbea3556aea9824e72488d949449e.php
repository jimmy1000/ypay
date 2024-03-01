<?php /*a:1:{s:50:"/www/wwwroot/hm.otbax.cn/view/index/my/anquan.html";i:1660840194;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>layuiAdmin 控制台主页一</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport"
			content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<link rel="stylesheet" href="/wwwroot/layui/assets/libs/layui/css/layui.css" />
		<link rel="stylesheet" href="/wwwroot/layui/assets/module/admin.css" />
		<link href="/wwwroot/css/site.css" rel="stylesheet" />

		<style>
			.rice_tag {
				width: 100%;
				padding: 12px;
				background: #e8eeff;
				border: 1px solid #7696ff;
				font-size: 12px;
				font-weight: 400;
				color: #FA6C00;
				line-height: 20px;
				-webkit-border-radius: 4px;
				-moz-border-radius: 4px;
				border-radius: 4px;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
			}
		</style>
	</head>

	<body>
		<div class="layui-fluid">
			<div class="layui-card">
				<div class="layui-card-header">安全保护</div>
				<div class="layui-card-body">
					<div class="rice_tag">
						请注意,点击绑定后会强制绑定谷歌验证，切勿随意点击，下载从应用商店搜索谷歌身份验证即可

					</div>
					<form class="layui-form" id="formBasForm" lay-filter="formBasForm">
						<div class="layui-col-lg12">
							<div class="layadmin-user-login-box layadmin-user-login-body layui-form vip">
								<div class="layui-form-item">
                                    <label style="font-size:13px;" class="layui-form-label">绑定状态：</label>
                                    <div class="layui-input-block gjhy">
                                        <?php if($bd_status == '1'): ?>
                                        <span>
                                            <strong style="color:green;font-size:10px;margin-top:3px;">已绑定</strong>
                                        </span>
                                        <?php endif; if($bd_status == '0'): ?>
                                        <span>
                                            <strong style="color:red;font-size:10px;margin-top:3px;">未绑定</strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                   </div>
                                  <div class="layui-form-item">
                                    <label style="font-size:13px;" class="layui-form-label">账号状态：</label>
                                    <div class="layui-input-block gjhy">
                                        <?php if($front_auth == '1'): ?>
                                        <span>
                                            <strong style="color:red;font-size:10px;margin-top:3px;">未保护</strong>
                                        </span>
                                        <?php endif; if($front_auth == '0'): ?>
                                        <span>
                                            <strong style="color:green;font-size:10px;margin-top:3px;">保护中</strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                   </div>
                          
								<div class="" style="margin-top: 30px;">
									<button type="button" class="layui-btn" id="saveImg">绑定</button>
									<button type="button" class="layui-btn" id="UnbindImg">解除绑定</button>
									<button type="button" class="layui-btn" id="UnbindInput">解除验证</button>
								</div>
							</div>
						</div>
					</form>
				</div>

			</div>


		</div>

		<script type="text/javascript" src="/wwwroot/layui/assets/libs/layui/layui.js"></script>
		<script type="text/javascript" src="/wwwroot/layui/assets/js/common.js?v=318"></script>
		<script>
			layui.use(['layer', 'form', 'laydate', 'notice'], function() {
				var $ = layui.jquery;
				var layer = layui.layer;
				var form = layui.form;
				var notice = layui.notice;



				$("#saveImg").click(function() {
				    $.get('/My/bind_googleauth', function (result) {
                            //layer.close(loadIndex);
                            if (result.code == '1') {
                                
            					
            					
            					
            					layer.open({            //打开layer弹出框
                                    type: 1,                     //类型
                                    //skin: "layui-layer-rim",     //皮肤类型，在skin文件夹中
                                    area: ["400px", "330px"],    //范围大小
                                    title: "谷歌验证绑定_扫码绑定后进行绑定验证",               //定义标题
                                    content: '<br><img src="'+result.msg+'" style="width:150px;height:150px;margin:0 auto;display:block;" /><hr>'+"<div style='display:flex;justify-content:center;'><input id='id_name' name='console_notity' value='' placeholder='请输入谷歌验证码进行绑定' class='layui-input' style='width:300px'></div>",
                                    btn: ['确定', '取消'],　　　　//按钮
                                    yes: function (index, layero) { //确定按钮的处理函数
                                        id_name = $("#id_name").val(); //根据id取数据
                                         $.ajax({
                                            url: '/My/ebind_googleauth',      //指向URL名称
                                            type: 'POST',                    //页面传值类型
                                            data: {"code": id_name},           //提交数据，以字典的形式
                                            success: function (e) {          //提交数据成功后的处理函数，e是返回的值
                                                if (e.code == 1) {
                                                    //parent.location.reload(); //刷新父页面
                                                    layer.msg("绑定成功");
                                                    layer.close(index);
                                                } else {
                                                    layer.alert(e.msg)
                                                    //layer.close(index);
                                                }
                                            },
                                        });
                                    },
                                    btn2: function (index, layero) { //取消按钮后的处理函数
                                        layer.close(index);
                                    },
                                });
            					
            					
            					
            					
            					
            					
            					
            					
            					
            					
            					
                            }
                            else
                            {
                                layer.msg(result.msg, { icon: 2 });
                            }
                    });

					
				});
			
				
				$("#UnbindImg").click(function() {
			
					layer.prompt({
                      formType: 0,
                      value: '',
                      title: '请输入谷歌验证码',
                      area: ['200px', '200px'] //自定义文本域宽高
                    }, function(value, index, elem){
                       $.get('/My/jiebang_googleauth?code='+value, function (result) {
                            if (result.code == 1) {
                                layer.msg(result.msg, { icon: 1 });
                                setTimeout(function () {
                                    layer.close();
                                }, 1000);
                            } else {
                                layer.msg(result.msg, { icon: 2 });
                            }
                        });
                      
                      
                      layer.close(index);
                    });
					
				});
				
				
				$("#UnbindInput").click(function() {
			
					layer.prompt({
                      formType: 0,
                      value: '',
                      title: '请输入谷歌验证码',
                      area: ['200px', '200px'] //自定义文本域宽高
                    }, function(value, index, elem){
                      //alert(value); //得到value
                      
                      
                       $.get('/My/very_googleauth?code='+value, function (result) {
                            //layer.close(loadIndex);
                            if (result.code == '1') {
                                layer.msg(result.msg, { icon: 1 });
                                setTimeout(function () {
                                    layer.close();
                                }, 1000);
                            } else {
                                layer.msg(result.msg, { icon: 2 });
                            }
                        });
                      
                      
                      layer.close(index);
                    });
					
				});




			});
		</script>
	</body>
</html>
