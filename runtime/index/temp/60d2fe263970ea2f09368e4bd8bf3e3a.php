<?php /*a:1:{s:55:"/www/wwwroot/1pay.q520.tk/view/index/deal/recharge.html";i:1669616908;}*/ ?>

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
        .gjhy {
            text-align: left !important;
            line-height: 38px;
            color: #000;
        }
    </style>
</head>

<body>

    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-body">
                <div class="rice_tag">
                    请注意：
                    <p>1、温馨提示：如在充值中遇到错误，请更换（IE）浏览器再试一遍！</p>
                    <p>2、本站账户禁止虚假交易、信用卡套现或洗钱等交易行为，若有发现将封停账户。</p>
                    <p>3、若此页面显示空白请刷新此页面。</p>
                </div>
            </div>
        </div>
        <div class="layui-card">
            <div class="layui-card-body">

                <form class="layui-form" id="formBasForm" lay-filter="formBasForm" target="_blank" method="post" action="/Deal/DoPay" >
                    <div class="layui-col-lg12">
                        <div class="layadmin-user-login-box layadmin-user-login-body layui-form vip">
                            <div class="layui-form-item">
                                <label class="layui-form-label">账户余额</label>
                                <div class="layui-input-block gjhy"> <span><?php echo htmlentities($user['money']); ?></span></div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">充值金额</label>
                                <div class="layui-input-block email">
                                    <input name="money" value="100" placeholder="请输入充值金额" class="layui-input" style="width:30%" lay-verify="required|numberX" required="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">充值方式</label>
                                <div class="layui-input-block">
                      
                                    <?php if(getConfig()['front_ali_pay'] != 'close'): ?>
                                    <input type="radio" name="type" value="alipay" title="支付宝" checked>
                                    <?php endif; if(getConfig()['front_wechat_pay'] != 'close'): ?>
                                    <input type="radio" name="type" value="wxpay" title="微信支付">
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="layadmin-user-login-box layadmin-user-login-body layui-form vip vipx">
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn layui-btn-normal btn-xufei" type="submit">立即充值</button>
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
        layui.use(['layer', 'form'], function () {
            var $ = layui.jquery;
            var form = layui.form;
        });
    </script>
</body>
</html>
