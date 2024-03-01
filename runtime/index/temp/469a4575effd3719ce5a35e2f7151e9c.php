<?php /*a:1:{s:54:"/www/wwwroot/hm.otbax.cn/view/index/jialan/apikey.html";i:1668670200;}*/ ?>
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

        .qiang_tips {
            margin-top: 12px;
            padding: 14px 16px;
            font-size: 12px;
            font-weight: 400;
            color: #666;
            line-height: 24px;
            background: #F3F7FD;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

            .qiang_tips .href a {
                margin-right: 14px;
                display: inline-block;
                font-size: 12px;
                font-weight: 400;
                color: #006FF6;
                line-height: 17px;
            }
    </style>
</head>

<body>
    <div class="layui-fluid">

        <div class="layui-card">
            <div class="layui-card-header">接口配置</div>
            <div class="layui-card-body">
                <div class="rice_tag">
                    您好，欢迎使用本系统，平台每日会对交易流水大的商户进行抽查,请不要用于违规站点!严禁一切淫秽、涉赌、钓鱼、理财、借贷、侵权、封建迷信等非法网站的接入！私自接入将冻结账户，有疑问请咨询客服
                </div>
                <div class="qiang_tips">
                    插件下载：
                    <div class="href">
                        <?php if(is_array($plug) || $plug instanceof \think\Collection || $plug instanceof \think\Paginator): $i = 0; $__LIST__ = $plug;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                           <a href="<?php echo htmlentities($vo['downurl']); ?>" target="_blank"><?php echo htmlentities($vo['name']); ?></a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>

                <div class="layui-col-lg12">
                    <div class="layadmin-user-login-box layadmin-user-login-body layui-form vip">
                        <div class="vipx"></div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">网关地址：</label>
                            <div class="layui-input-block gjhy">
                                <span>
                                    <strong><?php echo htmlentities($url); ?></strong><a class="js-clipboard" data-clipboard-text="<?php echo htmlentities($url); ?>" id="fuzhiurl" href="javascript:void(0)">复制</a>
                                </span>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">商户PID：</label>
                            <div class="layui-input-block gjhy">
                                <span>
                                    <strong><?php echo htmlentities($user['id']); ?></strong><a class="js-id" data-clipboard-text="<?php echo htmlentities($user['id']); ?>" id="fuzhiid" href="javascript:void(0)">复制</a>
                                </span>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">商户密钥：</label>
                            <div class="layui-input-block gjhy">
                                <span>
                                    <strong id="userkey"><?php echo htmlentities($user['user_key']); ?></strong><a class="js-key" data-clipboard-text="<?php echo htmlentities($user['user_key']); ?>" id="fuzhikey" href="javascript:void(0)">复制</a><a id="GeneratingKey" href="javascript:void(0)">重置密钥</a>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="vipx"></div>


            </div>



        </div>
    </div>

    <script type="text/javascript" src="/wwwroot/layui/assets/libs/layui/layui.js"></script>
    <script type="text/javascript" src="/wwwroot/layui/assets/js/common.js?v=318"></script>
    <script type="text/javascript" src="/static/index/js/index/clipboard.min.js"></script>
    <script>
        layui.use(['layer', 'form', 'laydate'], function () {
            var $ = layui.jquery;
            var layer = layui.layer;
            var form = layui.form;

            $('#GeneratingKey').click(function () {
                layer.confirm('你真的要重新生成KEY吗？', {
                    btn: ['确认', '取消'] //按钮
                }, function () {
                    var loadIndex = layer.msg('加载中', { icon: 16, shade: 0.01 });
                    $.get('/Jialan/GeneratingKey', function (result) {
                        layer.close(loadIndex);
                        if (result.code == '1') {
                            layer.alert("生成成功,新密钥：" + result.key, { icon: 1 });
                            $('#userkey').html(result.key);
                        } else {
                            layer.msg(result.msg, { icon: 2 });
                        }
                    });
                });
            });
            
            $('#fuzhiurl').click(function () {
                clipboard = new ClipboardJS('.js-clipboard');
                clipboard.on('success', function(e) {
                    
                    layer.msg('复制成功');
                });
                
                clipboard.on('error', function(e) {
                    layer.msg('复制失败,请手动复制');
                });
            });
            
            $('#fuzhiid').click(function () {
                clipboard = new ClipboardJS('.js-id');
                clipboard.on('success', function(e) {
                    
                    layer.msg('复制成功');
                });
                clipboard.on('error', function(e) {
                    layer.msg('复制失败,请手动复制');
                });
            });
            
            $('#fuzhikey').click(function () {
                clipboard = new ClipboardJS('.js-key');
                clipboard.on('success', function(e) {
                    
                    layer.msg('复制成功');
                });
                clipboard.on('error', function(e) {
                    layer.msg('复制失败,请手动复制');
                });
            });

        });
    </script>
</body>
</html>
