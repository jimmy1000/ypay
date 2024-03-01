<?php /*a:1:{s:49:"/www/wwwroot/hm.otbax.cn/view/index/deal/vip.html";i:1669432142;}*/ ?>
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
        .orange-tip {
            background-color: #fff3e2;
            border: 1px solid #ffb748;
            color: #ff9600 !important;
            font-size: 12px;
        }
        .rice_tag {
            width: 100%;
            padding: 12px;
            background: rgba(255, 244, 227, 0.45);
            border: 1px solid #FFD18B;
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
            <div class="layui-card-header">套餐购买</div>
            <div class="layui-card-body">

                <div class="rice_tag">
                    <p>1、会员套餐一旦开通成功将无法退还，请谨慎操作！</p>
                    <p>2、本站所有用户不得使用本系统进行违规业务，否则本站有权封锁您的帐户。</p>
                    <p>3、已购买套餐时购买其他套餐后时间不会叠加，费率以及时间会更变更为新套餐。</p>
                    <p>4、若购买的套餐费率与当前相同，套餐时间会叠加</p>
                </div>
                <div class="layui-col-lg12">
                    <div class="layadmin-user-login-box layadmin-user-login-body layui-form vip">
                        <div class="layui-form-item">
                            <label class="layui-form-label">当前套餐</label>
                            <div class="layui-input-block gjhy"> <span><?php echo htmlentities($user['vip_name']); ?></span> </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">到期时间</label>
                            <div class="layui-input-block gjhy"> <span><?php echo htmlentities($user['vip_time']); ?></span> </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">账户余额</label>
                            <div class="layui-input-block email">
                                <span>
                                    <strong><?php echo htmlentities($user['money']); ?> 元</strong><a href="/Deal/Recharge">点击充值</a>
                                </span>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">套餐选择</label>
                            <div class="layui-input-block email">
                                <ul class="vip-list">
                                    <?php if(is_array($viplist) || $viplist instanceof \think\Collection || $viplist instanceof \think\Paginator): $i = 0; $__LIST__ = $viplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <li data-val="<?php echo htmlentities($vo['id']); ?>">
                                            <p class="vip-time"><?php echo htmlentities($vo['viptime']); ?> 天</p>
                                            <p class="vip-day"><span>¥</span><?php echo htmlentities($vo['money']); ?></p>
                                            <p class="vip-tq">费率：<?php echo htmlentities($vo['feilv']); ?> %</p>
                                            <?php if($vo['is_quota'] == 1): ?>
                                            <p class="vip-tq">日限额：¥<?php echo htmlentities($vo['today_quota']); ?></p>
                                            <?php endif; ?>
                                            <p class="vip-sm"></p><i><?php echo htmlentities($vo['name']); ?></i>
                                        </li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layadmin-user-login-box layadmin-user-login-body layui-form vip vipx">
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn btn-xufei" id="xufei">立即购买</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="/wwwroot/layui/assets/libs/layui/layui.js"></script>
    <script type="text/javascript" src="/wwwroot/layui/assets/js/common.js?v=318"></script>
    <script>
        layui.use(['layer', 'jquery', 'form', 'notice'], function () {
            var $ = layui.jquery, form = layui.form;
            var layer = layui.layer;
            var notice = layui.notice;
            $('body').on('click', '.vip-list li', function () {
                $(".vip-list li").removeClass("on");
                $(this).addClass("on")
            });
            

            $("#xufei").click(function () {
                layer.confirm('您是否确定要开通吗?', { icon: 3, area: '400px', shadeClose: 1 }, function (index) {

                    $.post('/Deal/Vip', { tcid: $(".vip-list li.on").attr('data-val') }, function (res) {
                        //layer.close(loadIndex);
                        if (res.code === 200) {
                            notice.msg(res.msg, { icon: 1 });
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            notice.msg(res.msg, { icon: 2 });
                        }
                    }, 'json');
                    layer.close(index);


                });
                return false;
            });




        })
    </script>
</body>
</html>
