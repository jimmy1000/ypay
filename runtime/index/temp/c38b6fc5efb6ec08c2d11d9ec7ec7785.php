<?php /*a:1:{s:72:"/www/wwwroot/pay.xn--tnq769am5klza737gu1l.cn/view/index/pay/console.html";i:1669695226;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="format-detection" content="telephone=no,email=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>在线支付 - 网上支付 安全快速！</title>
    <link href="/wwwroot/css/qrcode.css" rel="stylesheet" />
    <script src="/wwwroot/js/yuancloud.js"></script>

    <style>
        body {
            background: #f2f2f4;
        }

        body, html {
            width: 100%;
            height: 100%;
        }

        *, :after, :before {
            box-sizing: border-box;
        }

        * {
            margin: 0;
            padding: 0;
        }

        img {
            max-width: 100%;
        }

        #header {
            height: 60px;
            border-bottom: 2px solid #eee;
            background-color: #fff;
            text-align: center;
            line-height: 60px;
        }

            #header h1 {
                font-size: 20px;
            }

        #main {
            overflow: hidden;
            margin: 0 auto;
            padding: 20px;
            padding-top: 80px;
            width: 992px;
            max-width: 100%;
        }

            #main .left {
                float: left;
                width: 40%;
                box-shadow: 0 0 60px #b5f1ff;
            }

        .left p {
            margin: 10px auto;
        }

        .make {
            padding-top: 15px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 3px 3px 0 rgba(0,0,0,.05);
            color: #666;
            text-align: center;
            transition: all .2s linear;
        }

            .make .qrcode {
                margin: auto;
            }

            .make .money {
                margin-bottom: 0;
                color: #f44336;
                font-weight: 600;
                font-size: 18px;
            }

        .info {
            padding: 15px;
            width: 100%;
            border-radius: 0 0 10px 10px;
            background: #32343d;
            color: #f2f2f2;
            text-align: center;
            font-size: 14px;
        }

        #main .right {
            float: right;
            padding-top: 25px;
            width: 60%;
            color: #ccc;
            text-align: center;
        }

        @media (max-width:768px) {
            #main {
                padding-top: 30px;
            }

                #main .left {
                    width: 100%;
                }

                #main .right {
                    display: none;
                }
        }
    </style>
</head>
<body>
    <div id="main">
        <div class="left">
            <div class="make">
                <?php if($order['type'] == 'qqpay'): ?>
                    <p><img src="/wwwroot/css/img/qqpay.jpg" alt="" style="height:30px;"></p>
                <?php endif; if($order['type'] == 'alipay'): ?>
                    <p><img src="/wwwroot/css/img/alipay.jpg" alt="" style="height:30px;"></p>
                <?php endif; if($order['type'] == 'wxpay'): ?>
                    <p><img src="/wwwroot/css/img/weixin.jpg" alt="" style="height:30px;"></p>
                <?php endif; ?>
                <p>商品名称：<?php echo htmlentities($order['name']); ?></p>
                <p class="money" id="price" style="font-weight:bold; color:green"><?php echo htmlentities($order['truemoney']); ?></p>


                <center><p class="qrcode" id="qrcode"><img class="kalecloud" id="qrcode_load" src="/img/loading.gif" style="display: block;"></p></center>
                <p class="money" style="font-weight:bold; color:red;padding:10px">
                    请输入 <?php echo htmlentities($order['truemoney']); ?> 不要多付或少付<br>
                    <?php if($code == 'wxpay_cloudzs'): ?>
                      留言填写：<?php echo htmlentities($order['id']); ?><br>
                    <?php endif; if($code == 'wxpay_skd'): ?>
                      留言填写：<?php echo htmlentities($order['id']); ?><br>
                    <?php endif; ?>
                    <?php echo htmlentities($console_notity); ?>
                </p>
                <center>
                    <a id="startApp" type="button" class="btn btn-lg btn-block btn-danger" style="font-size:13px;width:250px;display:none">一键启动APP支付</a>

                    <p id="startApp_text" style="font-size:12px;color:red;display:none;font-weight:900">请先保存二维码</p>

                </center>

                <div class="info">

                    <p id="divTime">正在获取二维码,请稍等...</p>
                    <p>商户订单号：<?php echo htmlentities($order['trade_no']); ?></p>
                    <?php if($order['type'] == 'qqpay'): ?>
                        <p>请使用QQ扫一扫</p>
                    <?php endif; if($order['type'] == 'alipay'): ?>
                        <p>请使用支付宝扫一扫</p>
                    <?php endif; if($order['type'] == 'wxpay'): ?>
                        <p>请使用微信扫一扫</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="right">
            <?php if($order['type'] == 'qqpay'): ?>
                <img src="/wwwroot/css/img/qqpay-sys.png" alt="">
            <?php endif; if($order['type'] == 'alipay'): ?>
                <img src="/wwwroot/css/img/alipay-sys.png" />
            <?php endif; if($order['type'] == 'wxpay'): ?>
                <img src="/wwwroot/css/img/wxpay-sys.png" alt="">
            <?php endif; ?>

        </div>
    </div>
<!-- 弹窗开始 -->
<?php if($is_payPopUp == 1): ?>
<div class="web_notice" style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0,0,0,0.3);z-index: 99999;">
		<div style="position: fixed;top: 50%;left: 50%;width: 350px;background: #FFF;transform: translate(-50%, -50%);border-radius: 40px;padding: 50px 40px;">
		                 <?php if($order['type'] == 'qqpay'): ?>
                            <h3 style="font-weight: bold;text-align: center;font-size: 30px;">QQ支付注意</h3>
                            <?php endif; if($order['type'] == 'alipay'): ?>
                              <h3 style="font-weight: bold;text-align: center;font-size: 30px;">支付宝支付注意</h3>
                            <?php endif; if($order['type'] == 'wxpay'): ?>
                                <h3 style="font-weight: bold;text-align: center;font-size: 30px;">微信支付注意</h3>
                            <?php endif; ?>  
	
		<div style="font-size: 16px;margin-top: 26px;line-height: 30px;color: #999;">
		<br>
		<font color="purple"><b>请在支付时务必支付订单金额，多付或少付系统都无法识别，这将导致你的订单无法完成。
		<br>
		<br>
		<font color="red">订单金额：<?php echo htmlentities($order['truemoney']); ?>元【注意小数点】</font></b><font color="red">
		<br>
		</font>
		</font>
		</div>
		<font color="purple">
		<a style="display: block;background: #98a3ff;color: #FFF;text-align: center;font-weight: bold;font-size: 19px;line-height: 60px;margin: 0 auto;margin-top: 45px;border-radius: 32px;width: 80%;" onclick="javascript:document.querySelector('.web_notice').remove()">懂了</a>
		</font>
		</div>
		</div>
<?php endif; ?>
    <script src="/wwwroot/layer/layer.js"></script>
    <script type="text/javascript">
     var intDiff = parseInt('<?php echo htmlentities($ms); ?>');//倒计时总秒数量
     function timer(intDiff){
         window.setInterval(function(){
         var day=0,
             hour=0,
             minute=0,
             second=0;//时间默认值
         if(intDiff > 0){
         	day = Math.floor(intDiff / (60 * 60 * 24));
             hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
             minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
            second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
         }
		if (minute <= 9) minute = '0' + minute;
		if (second <= 9) second = '0' + second;
		if (hour <= 0 && minute <= 0 && second <= 0) {
			$("#divTime").html("<small style='color:red; font-size:26px'>订单二维码已过期</small>");
            $("#qrcode").html('<img id="qrcode_load" src="/wwwroot/img/qrcode_timeout.png">');//输出过期二维码提示图片
		}else{
			$("#divTime").html("二维码有效时间:<small style='color:red; font-size:26px'>" + minute + "</small>分<small style='color:red; font-size:26px'>" + second + "</small>秒,失效勿付");
		}
		intDiff--
		}, 1000);
     }

     $(function(){
         timer(intDiff);
     });
    /**
     * 检验是否手机版，手机版直接跳转到APP支付
     * @@returns
     */
	order();
	updateQrOk = 0;
	updateQrImg= 0;
	updateQrNo = 0;
     //订单监控  {订单监控}
	function order(){
        var _v = new Date().getTime();
        $.get("/Pay/ConSole", { TradeNo: "<?php echo htmlentities($order['trade_no']); ?>", v: _v }, function (result) {
			//成功
     		if(result.code == '200' && updateQrOk==0){
				updateQrOk==1;
				$("#divTime").html("<small style='color:red; font-size:22px'>"+ result.msg +"</small>");
                    $("#qrcode").html('<img id="qrcode_load" src="/wwwroot/img/pay_ok.png">');//支付成功
 				//回调页面
         		window.clearInterval(orderlst);
				layer.msg('支付成功，正在跳转中...');
				window.location.href=result.url;
     		}
     		//支付二维码
     		if(result.code == '100' && updateQrImg==0){
 				updateQrImg = 1;
                    $("#qrcode").html('<img id="qrcode_load" src="' + result.qr_url + '">');

                    //二维码获取成功
                    if ("<?php echo htmlentities($order['type']); ?>" == 'alipay')
				{
				    
				    if(isMobilCheck())
                    {
                        $("#startApp").attr("href", "<?php echo $order['h5_qrurl']; ?>");
    				    $("#startApp").show();
    				    $("#startApp_text").show();
    				}
                    }
                    if ("<?php echo htmlentities($order['type']); ?>"== 'wxpay')
				    {
				        if(isMobilCheck())
                        {
                          
    				        $("#startApp").attr("href", "<?php echo $order['h5_qrurl']; ?>");
		    			    $("#startApp").show();
                            $("#startApp_text").show();
                        }
                      
				    }

			}
         	//订单已经超时
     		if(result.code == '0' && updateQrNo==0){
				updateQrNo==1;
				$("#divTime").html("<small style='color:red; font-size:22px'>"+ result.msg +"</small>");
     			window.clearInterval(orderlst);
     			layer.confirm(result.msg, {
     			  icon: 2,
     			  title: '支付失败',
   				  btn: ['确认'] //按钮
   				}, function(){
					location.href="<?php echo htmlentities($timeout_url); ?>";
   				});
         	}

     	},"JSON");
	}

	/**
     * 检验是否手机版，手机版直接跳转到APP支付
     * @@returns
     */
    function isMobilCheck() {
    	var userAgentInfo = navigator.userAgent;

            var mobileAgents = ["Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
            
            var mobile_flag = false;
            
            	//根据userAgent判断是否是手机
             for (var v = 0; v < mobileAgents.length; v++) {
                if (userAgentInfo.indexOf(mobileAgents[v]) > 0) {
                      mobile_flag = true;
                      break;
                }
             }
             var screen_width = window.screen.width;
             var screen_height = window.screen.height;
            
            //根据屏幕分辨率判断是否是手机
            if (screen_width > 325 && screen_height < 750) {
                mobile_flag = true;
            }
            
            return mobile_flag;
    }


	//周期监听
	orderlst = window.setInterval(function () {
		order();
	}, 2000);

    </script>


    <?php if($yuyin_tips == '1'): ?>
        <script>
            speckText(0)
            function speckText(str) {
                var url = "/wwwroot/css/yuyin.mp3";
                var voiceContent = new Audio(url);
                voiceContent.src = url;
                voiceContent.play();
            }
        </script>
    <?php endif; ?>
</body>
</html>
