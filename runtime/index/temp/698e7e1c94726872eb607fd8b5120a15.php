<?php /*a:1:{s:58:"/www/wwwroot/testpay.lao6sp.com/view/index/demo/index.html";i:1658661672;}*/ ?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="applicable-device" content="pc,mobile">
<link href="/favicon.ico" rel="shortcut icon"/>
<title>支付体验中心-<?php echo getConfig()['sitename']; ?></title>
<script src="/static/index/js/index/jquery.min.js"></script>
<link rel="stylesheet" href="/static/index/css/bootstrap.min.css"/>
<link rel="stylesheet" href="/static/index/css/demo.css"/>
<link rel="stylesheet" href="/static/index/css/m_reset.css"/>
</head>
<body>

<div class="container">
   <div class="row">

    <div class="col-lg-12 col-sx-12">
        <div class="head">
   <a href="/"><img src="<?php echo getConfig()['logo']; ?>" width="150px" alt=""/></a><span class="head-title">体验Demo</span>
   <span style="float: right"><a target="_blank" href="/User/Reg" >商户申请</a> | <a target="_blank" href="/">返回首页</a></span>

</div>        <div class="content">
            <div class="content-head">
                <div class="order">

                <span class="sleft">订单编号:<?php echo "Y".date("YmdHis").mt_rand(100,999); ?></span>
                <span class="sright">收款商家: <?php echo getConfig()['sitename']; ?></span>
            </div>
            </div>

            <div class="step step2">
                <ul class="steps clearfix">
                    <li>选择商品</li>
                    <li class="active">确认付款</li>
                    <li>下单成功</li>

                </ul>
            </div>

            <div class="pay_amount">
                <span class="amount_text">支付金额:</span>
                <span class="amount font-red">￥<?php echo getConfig()['demopay_money']; ?></span>
            </div>



            <div class="order" style="margin-top: 20px;margin-bottom: 5px;">
                <span class="address-title">请选择付款方式</span>
            </div>

            <div class="ways">
                <div class="borders wechat_pay" style="text-align: center" checked>
                   <p>
                       <img src="/static/index/images/demo/wx_pay.svg" style="margin:0 auto;width:34px" alt=""/><span style="margin-left: 7px;font-size: 13px;color:#878787;">微信支付</span>
                   </p>
                </div>
                <div class="borders ali_pay">
                    <p><img src="/static/index/images/demo/alipay.svg" style="margin:0 auto;width:80px" alt=""/> </p>
                </div>
                
                <div class="borders qq_pay">
                    <p><img src="/static/index/images/demo/qqpay.png" style="margin:0 auto;width:110px" alt=""/> </p>
                </div>
            </div>

            <div class="go-pay">
                <span style="margin-right: 10px">测试体验商品不会发货</span>
                <button class="buy-button" style="width: 100px;">立即支付</button>
            </div>
        </div>

        <div class="foot">
    <p> <span > © Copyright 2022<a href="/"><?php echo getConfig()['sitename']; ?></a> | 工信部备案：<a target="_blank" href="http://www.beian.miit.gov.cn" class=""><?php echo getConfig()['icp']; ?></a></span></p>
</div>    </div>

</div>
</div>


<script src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript"></script>
<script>
    var flag = 0;
    var type = '';
    var out_trade_no='';
    out_trade_no = $('.sleft').text().substr($('.sleft').text().lastIndexOf(":") + 1);
    $(document).ready(function(){
	        $('.wechat_pay').addClass('click_active');
	        $('.ali_pay').removeClass('click_active');
	        $('.qq_pay').removeClass('click_active');
	        flag = 1;
	        type = 'wxpay';
	        out_trade_no=out_trade_no;
	});
    $('.wechat_pay').on('click',function () {
        $('.wechat_pay').addClass('click_active');
        $('.ali_pay').removeClass('click_active');
        $('.qq_pay').removeClass('click_active');
        flag = 1;
        type = 'wxpay';
        out_trade_no=out_trade_no;
    })

    $('.ali_pay').on('click',function () {
        $('.ali_pay').addClass('click_active');
        $('.wechat_pay').removeClass('click_active');
        $('.qq_pay').removeClass('click_active');
        flag = 1;
        type = 'alipay';
        out_trade_no=out_trade_no;
    });
    
    $('.qq_pay').on('click',function () {
        $('.qq_pay').addClass('click_active');
        $('.wechat_pay').removeClass('click_active');
        $('.ali_pay').removeClass('click_active');
        flag = 1;
        type = 'qqpay';
        out_trade_no=out_trade_no;
    });
    $('.go-pay').on('click',function () {
        if(flag == 0) {
            swal('请先选择支付方式');
        } else {
            window.location.href = '/demo/dopay?type='+ type+'&out_trade_no='+out_trade_no;
        }
    })

//  $(document).ready(function(){
// 	window.view={
// 		query:function () {
// 	        $.ajax({
// 	            type: "POST",
// 	            url: "/demo/query?out_trade_no="+out_trade_no,
// 	            timeout:6000,
// 	            cache:false,
// 	            dataType:'text',
// 	            success:function(e){
// 	            		if (e && e.indexOf('complete')!==-1) {
// 	                    window.location.href = "/demo/return";
// 	                    return;
// 	                }
// 	                setTimeout(function(){window.view.query();}, 2000);
// 	            },
// 	            error:function(){
// 	            	 setTimeout(function(){window.view.query();}, 2000);
// 	            }
// 	        });
// 	    }
// 	};
// 	window.view.query();
// });
</script>


</body>
</html>
