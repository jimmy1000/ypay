<?php /*a:1:{s:48:"/mnt/projects/payyz/view/index/my/updatepwd.html";i:1655355362;}*/ ?>
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
        .layui-form-label {
            width: 100px;
            color: #000;
            line-height: 16px;
            padding: 9px 15px;
        }

        .layui-input-block {
            margin-left: 130px;
            min-height: 28px;
            line-height: 34px;
        }
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
            <div class="layui-card-header">修改密码</div>
            <div class="layui-card-body">
                <div class="rice_tag">
                    温馨提醒：
                    <p>为了更好的保障您的帐户，请将密码设置复杂一点！</p>
                </div>
                <br />
                <div class="vipx"></div>
                <!-- 表单开始 -->
                <form class="layui-form" id="formBasForm" lay-filter="formBasForm">

                    <div class="layui-form-item" style="position: relative">
                        <label class="layui-form-label">商户UID：</label>
                        <div class="layui-input-block"><?php echo htmlentities($user); ?></div>
                    </div>

                    
                    <div class="layui-form-item">
                        <label class="layui-form-label layui-form-required">新密码:</label>
                        <div class="layui-input-block">
                            <input name="newpwd" placeholder="请输入新密码" class="layui-input"
                                   lay-verType="tips" lay-verify="required" style="" required />
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label layui-form-required">确认新密码:</label>
                        <div class="layui-input-block">
                            <input name="renewpwd" placeholder="请确认输入新密码" class="layui-input"
                                   lay-verType="tips" lay-verify="required" style="" required />
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-filter="formBasSubmit" lay-submit>&emsp;立即修改&emsp;</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/wwwroot/layui/assets/libs/layui/layui.js"></script>
    <script type="text/javascript" src="/wwwroot/layui/assets/js/common.js"></script>
    <script>
        layui.use(['layer', 'form', 'laydate', 'notice'], function () {
            var $ = layui.jquery;
            var layer = layui.layer;
            var form = layui.form;
            var laydate = layui.laydate;
            var notice = layui.notice;

            /* 渲染laydate */
            laydate.render({
                elem: '#formBasDateSel',
                trigger: 'click',
                range: true
            });
            form.on('submit(formBasSubmit)', function (obj) {
                $.post('/My/UpdatePwd', obj.field, function (res) {
                    //layer.close(loadIndex);
                    if (res.code === 200) {
                        notice.msg(res.msg, { icon: 1 });
                        location.replace('/User/Login');
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
