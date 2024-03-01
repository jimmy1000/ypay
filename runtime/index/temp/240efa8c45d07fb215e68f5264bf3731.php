<?php /*a:1:{s:71:"/www/wwwroot/pay.xn--tnq769am5klza737gu1l.cn/view/index/user/index.html";i:1668671138;}*/ ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>用户管理中心 - <?php echo getConfig()['sitename']; ?></title>
    <link rel="stylesheet" href="/wwwroot/layui/assets/libs/layui/css/layui.css" />
    <link rel="stylesheet" href="/wwwroot/layui/assets/module/admin.css" />
</head>
<body class="layui-layout-body theme-white">
    <div class="layui-layout layui-layout-admin">
        <!-- 头部 -->
        <div class="layui-header">
            <div class="layui-logo">
                <img src="/wwwroot/layui/assets/images/logo.png" />
                <cite>&nbsp;<?php echo getConfig()['sitename']; ?></cite>
            </div>
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item" lay-unselect>
                    <a ew-event="flexible" title="侧边伸缩"><i class="layui-icon layui-icon-shrink-right"></i></a>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a ew-event="refresh" title="刷新"><i class="layui-icon layui-icon-refresh-3"></i></a>
                </li>
            </ul>
            <ul class="layui-nav layui-layout-right">
                
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a ew-event="fullScreen" title="全屏"><i class="layui-icon layui-icon-screen-full"></i></a>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a>
                        <img src="/wwwroot/layui/assets/images/head.jpg" class="layui-nav-img">
                        <cite>管理员</cite>
                    </a>
                    <dl class="layui-nav-child">
                        
                        <dd lay-unselect><a ew-href="/My/UpdatePwd">修改密码</a></dd>
                        <hr>
                        <dd lay-unselect><a ew-event="logout" data-url="/User/Logout">退出</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a title="设置"><i class="layui-icon layui-icon-more-vertical"></i></a>
                </li>
            </ul>
        </div>

        <!-- 侧边栏 -->
        <div class="layui-side">
            <div class="layui-side-scroll">
                <ul class="layui-nav layui-nav-tree arrow2" lay-filter="admin-side-nav" lay-shrink="_all">
                    <li class="layui-nav-item">
                        <a lay-href="/Jialan/Console"><i class="layui-icon layui-icon-home"></i>&emsp;<cite>商户中心</cite></a>
                    </li>
                    <li class="layui-nav-item">
                        <a><i class="layui-icon layui-icon-set"></i>&emsp;<cite>账号管理</cite></a>
                        <dl class="layui-nav-child">
                            <dd><a lay-href="/My/UserPro">个人中心</a></dd>
                            <dd><a lay-href="/My/UpdatePwd">修改密码</a></dd>
                            <dd><a lay-href="/My/loginLog">登录日志</a></dd>
                            <dd><a lay-href="/My/anquan">安全设置</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a><i class="layui-icon layui-icon-template"></i>&emsp;<cite>财务管理</cite></a>
                        <dl class="layui-nav-child">
                            <dd><a lay-href="/Deal/Recharge">在线充值</a></dd>
                            <dd><a lay-href="/Deal/MoneyLog">资金明细</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a><i class="layui-icon layui-icon-component"></i>&emsp;<cite>套餐管理</cite></a>
                        <dl class="layui-nav-child">
                            <dd><a lay-href="/Deal/Vip">套餐购买</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a><i class="layui-icon layui-icon-app"></i>&emsp;<cite>通道管理</cite></a>
                        <dl class="layui-nav-child">
                            <dd><a lay-href="/Channel/Index">通道列表</a></dd>
                            <dd><a lay-href="/Channel/Basic">通道配置</a></dd>
                            <dd><a lay-href="/Channel/zhuanjie">转接配置</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a><i class="layui-icon layui-icon-app"></i>&emsp;<cite>订单管理</cite></a>
                        <dl class="layui-nav-child">
                            <dd><a lay-href="/Deal/OrderLog">订单记录</a></dd>
                        </dl>
                    </li>


                    <li class="layui-nav-item">
                        <a lay-href="/Jialan/ApiKey"><i class="layui-icon layui-icon-unlink"></i>&emsp;<cite>支付配置</cite></a>
                    </li>
                    <?php if(getConfig()['is_aff'] == '1'): ?>
                    <li class="layui-nav-item">
                        <a lay-href="/My/aff"><i class="layui-icon layui-icon-share"></i>&emsp;<cite>邀请返利</cite></a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- 主体部分 -->
        <div class="layui-body"></div>
        <!-- 底部 -->
        <div class="layui-footer layui-text">
            
            <span class="pull-right">Version <?php echo htmlentities($ver); ?></span>
        </div>
    </div>

    <!-- 加载动画 -->
    <div class="page-loading">
        <div class="ball-loader">
            <span></span><span></span><span></span><span></span>
        </div>
    </div>

    <!-- js部分 -->
    <script type="text/javascript" src="/wwwroot/layui/assets/libs/layui/layui.js"></script>
    <script type="text/javascript" src="/wwwroot/layui/assets/js/common.js"></script>
    <script>
    layui.use(['index'], function () {
        var $ = layui.jquery;
        var index = layui.index;
        // 默认加载主页
        index.loadHome({
            menuPath: '/Jialan/Console',
            menuName: '<i class="layui-icon layui-icon-home"></i>'
        });
        //theme-white
    });
    </script>
</body>
</html>