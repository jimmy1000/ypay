<?php /*a:1:{s:55:"/www/wwwroot/1pay.q520.tk/view/index/channel/basic.html";i:1669695346;}*/ ?>

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
            <div class="layui-card-header">通道配置</div>
            <div class="layui-card-body">
                <div class="rice_tag">
                    请注意：
                    <p>1、温馨提示：如在使用中遇到错误，请更换（IE）浏览器再试一遍！</p>
                    <p>2、如邮件提醒未通知到，请先检查是否存在于垃圾箱中，如不存在可向站长反应</p>
                    <p>3、通讯密钥用于APP通道，PC自挂通道</p>
                </div>
                <form class="layui-form" id="formBasForm" lay-filter="formBasForm">
                    <div class="layui-col-lg12">
                        <div class="layadmin-user-login-box layadmin-user-login-body layui-form vip">
                            <div class="layui-form-item">
                                <label class="layui-form-label">语音提醒</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="yuyin_tips" value="0" title="禁用" <?php if($user['yuyin_tips'] == 0): ?> checked <?php endif; ?> >
                                    <input type="radio" name="yuyin_tips" value="1" title="启用" <?php if($user['yuyin_tips'] == 1): ?> checked <?php endif; ?> >
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">收银提示</label>
                                <div class="layui-input-block email">
                                    <input name="console_notity" value="<?php echo htmlentities($user['console_notity']); ?>" placeholder="请输入收银台的提示信息" class="layui-input" style="width:300px">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">收银模板</label>
                                <div class="layui-input-block">
                                    <?php if($user['console_temp'] == 'console'): ?>
                                        <input type="radio" name="console_temp" value="console" title="经典" checked >
                                        <input type="radio" name="console_temp" value="newpay" title="新版"   >
                                    <?php else: ?>
                                        <input type="radio" name="console_temp" value="console" title="经典"  >
                                        <input type="radio" name="console_temp" value="newpay" title="新版" checked  >
                                    <?php endif; ?>

                                    

                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">掉线提醒</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="lose_tips" value="0" title="禁用" <?php if($user['lose_tips'] == 0): ?> checked <?php endif; ?> >
                                    <input type="radio" name="lose_tips" value="1" title="邮箱" <?php if($user['lose_tips'] == 1): ?> checked <?php endif; ?> >
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">付款弹窗提示</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="is_payPopUp" value="0" title="禁用" <?php if($user['is_payPopUp'] == 0): ?> checked <?php endif; ?> >
                                    <input type="radio" name="is_payPopUp" value="1" title="启用" <?php if($user['is_payPopUp'] == 1): ?> checked <?php endif; ?>>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">邮件登录提醒</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="login_email_tips" value="0" title="禁用" <?php if($user['login_email_tips'] == 0): ?> checked <?php endif; ?> >
                                    <input type="radio" name="login_email_tips" value="1" title="启用" <?php if($user['login_email_tips'] == 1): ?> checked <?php endif; ?>>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">邮件订单消息通知</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="order_tips" value="0" title="禁用" <?php if($user['order_tips'] == 0): ?> checked <?php endif; ?> >
                                    <input type="radio" name="order_tips" value="1" title="启用" <?php if($user['order_tips'] == 1): ?> checked <?php endif; ?>>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">余额提示</label>
                                <div class="layui-input-block email">
                                    <input name="money_tips" value="<?php echo htmlentities($user['money_tips']); ?>" placeholder="余额不足时进行邮件提醒,0为不提醒" class="layui-input" style="width:300px" lay-verify="required|numberX" required="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">订单超时时间</label>
                                <div class="layui-input-block email">
                                    <input name="timeout_time" value="<?php echo htmlentities($user['timeout_time']); ?>" placeholder="订单超时时间,如不设置默认为180秒" class="layui-input" style="width:300px" lay-verify="required|numberX" required="">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">超时跳转地址</label>
                                <div class="layui-input-block email">
                                    <input name="timeout_url" value="<?php echo htmlentities($user['timeout_url']); ?>" placeholder="请输入订单超时跳转地址" class="layui-input" style="width:300px">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">通讯密钥</label>
                                <div class="layui-input-block email">
                                    <input name="appkey" value="<?php echo htmlentities($user['appkey']); ?>" placeholder="请输入通讯密钥" class="layui-input" style="width:300px">
                                </div>
                            </div>
                       
                        </div>
                    </div>
                    <div class="layadmin-user-login-box layadmin-user-login-body layui-form vip vipx">
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn btn-xufei" lay-filter="formBasSubmit" lay-submit>立即修改</button>
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
        layui.use(['layer', 'form', 'laydate', 'notice'], function () {
            var $ = layui.jquery;
            var layer = layui.layer;
            var form = layui.form;
            var notice = layui.notice;

            /* 监听表单提交 */
            form.on('submit(formBasSubmit)', function (obj) {
                $.post('/Channel/Basic', obj.field, function (res) {
                    //layer.close(loadIndex);
                    if (res.code === 200) {
                        notice.msg(res.msg, { icon: 1 });
                    } else {
                        notice.msg(res.msg, { icon: 2 });
                    }
                }, 'json');
                return false;
            });

        });
    </script>
</body>
</html>
