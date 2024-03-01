<?php /*a:1:{s:50:"/mnt/projects/payyz/view/index/jialan/console.html";i:1667991674;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 控制台主页一</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/wwwroot/layui/assets/libs/layui/css/layui.css" />
    <link rel="stylesheet" href="/wwwroot/layui/assets/module/admin.css?v=318" />
    
    <style>
        /** 应用快捷块样式 */
        .console-app-group {
            padding: 16px;
            border-radius: 4px;
            text-align: center;
            background-color: #fff;
            cursor: pointer;
            display: block;
        }

            .console-app-group .console-app-icon {
                width: 32px;
                height: 32px;
                line-height: 32px;
                margin-bottom: 6px;
                display: inline-block;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                font-size: 32px;
                color: #69c0ff;
            }

            .console-app-group:hover {
                box-shadow: 0 0 15px rgba(0, 0, 0, .08);
            }

        /** //应用快捷块样式 */

        /** 小组成员 */
        .console-user-group {
            position: relative;
            padding: 10px 0 10px 60px;
        }

            .console-user-group .console-user-group-head {
                width: 32px;
                height: 32px;
                position: absolute;
                top: 50%;
                left: 12px;
                margin-top: -16px;
                border-radius: 50%;
            }

            .console-user-group .layui-badge {
                position: absolute;
                top: 50%;
                right: 8px;
                margin-top: -10px;
            }

            .console-user-group .console-user-group-name {
                line-height: 1.2;
            }

            .console-user-group .console-user-group-desc {
                color: #8c8c8c;
                line-height: 1;
                font-size: 12px;
                margin-top: 5px;
            }

        /** 卡片轮播图样式 */
        .admin-carousel .layui-carousel-ind {
            position: absolute;
            top: -41px;
            text-align: right;
        }

            .admin-carousel .layui-carousel-ind ul {
                background: 0 0;
            }

            .admin-carousel .layui-carousel-ind li {
                background-color: #e2e2e2;
            }

                .admin-carousel .layui-carousel-ind li.layui-this {
                    background-color: #999;
                }

        /** 广告位轮播图 */
        .admin-news .layui-carousel-ind {
            height: 45px;
        }

        .admin-news a {
            display: block;
            line-height: 70px;
            text-align: center;
        }

        /** 最新动态时间线 */
        .layui-timeline-dynamic .layui-timeline-item {
            padding-bottom: 0;
        }

            .layui-timeline-dynamic .layui-timeline-item:before {
                top: 16px;
            }

        .layui-timeline-dynamic .layui-timeline-axis {
            width: 9px;
            height: 9px;
            left: 1px;
            top: 7px;
            background-color: #cbd0db;
        }

            .layui-timeline-dynamic .layui-timeline-axis.active {
                background-color: #0c64eb;
                box-shadow: 0 0 0 2px rgba(12, 100, 235, .3);
            }

        .dynamic-card-body {
            box-sizing: border-box;
            overflow: hidden;
        }

            .dynamic-card-body:hover {
                overflow-y: auto;
                padding-right: 9px;
            }

        /** 优先级徽章 */
        .layui-badge-priority {
            border-radius: 50%;
            width: 20px;
            height: 20px;
            padding: 0;
            line-height: 18px;
            border-width: 2px;
            font-weight: 600;
        }
    </style>
    <style>
        /** 统计快捷方式样式 */
        .console-link-block {
            font-size: 16px;
            padding: 20px 20px;
            border-radius: 4px;
            background-color: #40D4B0;
            color: #FFFFFF !important;
            box-shadow: 0 2px 3px rgba(0, 0, 0, .05);
            position: relative;
            overflow: hidden;
            display: block;
        }

            .console-link-block .console-link-block-num {
                font-size: 20px;
                margin-bottom: 5px;
                opacity: .9;
            }

            .console-link-block .console-link-block-text {
                opacity: .8;
            }

            .console-link-block .console-link-block-icon {
                position: absolute;
                top: 50%;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 50px;
                line-height: 50px;
                margin-top: -25px;
                color: #FFFFFF;
                opacity: .8;
            }

            .console-link-block .console-link-block-band {
                color: #fff;
                width: 100px;
                font-size: 12px;
                padding: 2px 0 3px 0;
                background-color: #E32A16;
                line-height: inherit;
                text-align: center;
                position: absolute;
                top: 8px;
                right: -30px;
                transform-origin: center;
                transform: rotate(45deg) scale(.8);
                opacity: .95;
                z-index: 2;
            }

        /** //统计快捷方式样式 */

        /** 设置每个快捷块的颜色 */
        .layui-row > div:nth-child(2) .console-link-block {
            background-color: #55A5EA;
        }

        .layui-row > div:nth-child(3) .console-link-block {
            background-color: #9DAFFF;
        }

        .layui-row > div:nth-child(4) .console-link-block {
            background-color: #F591A2;
        }

        .layui-row > div:nth-child(5) .console-link-block {
            background-color: #FEAA4F;
        }

        .layui-row > div:last-child .console-link-block {
            background-color: #9BC539;
        }
        .qiang_tips {
            margin-top: 10px;
            padding: 14px 12px;
            font-size: 12px;
            font-weight: 400;
            color: #666;
            line-height: 24px;
            background: #F3F7FD;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
    </style>

</head>

<body>
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-header">商户公告</div>
            <div class="layui-card-body">
                <?php echo getConfig()['sh_notice']; ?>
            </div>
        </div>
        <div class="layui-card">
            <div class="layui-card-header">插件下载</div>
            <div class="layui-card-body">
                <div class="qiang_tips">
                    <div class="href">
                        <?php if(is_array($plug) || $plug instanceof \think\Collection || $plug instanceof \think\Paginator): $i = 0; $__LIST__ = $plug;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                           <a href="<?php echo htmlentities($vo['downurl']); ?>" target="_blank"><?php echo htmlentities($vo['name']); ?></a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </div>
        </div>
      
        <div class="layui-row layui-col-space15">
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-header">
                        平台流水<span class="layui-badge layui-badge-green pull-right">日</span>
                    </div>
                    <div class="layui-card-body">
                        <p class="lay-big-font"><span style="font-size: 26px;line-height: 1;">¥</span><?php echo htmlentities($tj['daymoney']); ?></p>
                        <p>今日流水金额<span class="pull-right"></span></p>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-header">
                        平台流水<span class="layui-badge layui-badge-red pull-right">昨</span>
                    </div>
                    <div class="layui-card-body">
                        <p class="lay-big-font"><span style="font-size: 26px;line-height: 1;">¥</span><?php echo htmlentities($tj['yearmoney']); ?></p>
                        <p>昨日流水额<span class="pull-right"></span></p>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-header">
                        平台流水<span class="layui-badge layui-badge-blue pull-right">月</span>
                    </div>
                    <div class="layui-card-body">
                        <p class="lay-big-font"><span style="font-size: 26px;line-height: 1;">¥</span><?php echo htmlentities($tj['yuemoney']); ?></p>
                        <p>月流水额<span class="pull-right"></span></p>
                    </div>
                </div>
            </div>

            <div class="layui-col-xs12 layui-col-sm6 layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-header">
                        平台流水<span class="layui-badge layui-badge-blue pull-right">总</span>
                    </div>
                    <div class="layui-card-body">
                        <p class="lay-big-font"><span style="font-size: 26px;line-height: 1;">¥</span><?php echo htmlentities($tj['allmoney']); ?></p>
                        <p>总流水额<span class="pull-right"></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-row layui-col-space15">

            <div class="layui-col-xs12 layui-col-md8">
                <div class="layui-card" style="">
                    <div class="layui-card-header">商户数据统计</div>
                    <div class="layui-card-body">

                        <div class="layui-row layui-col-space15">
                            <div class="layui-col-md3 layui-col-sm4 layui-col-xs6 layui-col-lg3">
                                <div class="console-link-block">
                                    <div class="console-link-block-num"><?php echo htmlentities($tj['allordercount']); ?></div>
                                    <div class="console-link-block-text">平台总订单</div>
                                    <i class="console-link-block-icon layui-icon layui-icon-survey"></i>

                                </div>
                            </div>
                            <div class="layui-col-md3 layui-col-sm4 layui-col-xs6 layui-col-lg3">
                                <div class="console-link-block">
                                    <div class="console-link-block-num"><?php echo htmlentities($tj['dayordercount']); ?></div>
                                    <div class="console-link-block-text">今日订单</div>
                                    <i class="console-link-block-icon layui-icon layui-icon-print"></i>

                                </div>
                            </div>
                            <div class="layui-col-md3 layui-col-sm4 layui-col-xs6 layui-col-lg3">
                                <div class="console-link-block">
                                    <div class="console-link-block-num"><?php echo htmlentities($tj['yearcount']); ?></div>
                                    <div class="console-link-block-text">昨日订单</div>
                                    <i class="console-link-block-icon layui-icon layui-icon-list" style="font-size: 62px;padding-right: 5px;"></i>

                                </div>
                            </div>
                            <div class="layui-col-md3 layui-col-sm4 layui-col-xs6 layui-col-lg3">
                                <div class="console-link-block">
                                    <div class="console-link-block-num"><?php echo htmlentities($tj['allcount']); ?></div>
                                    <div class="console-link-block-text">通道数量</div>
                                    <i class="console-link-block-icon layui-icon layui-icon-date"></i>

                                </div>
                            </div>
                            <div class="layui-col-md3 layui-col-sm4 layui-col-xs6 layui-col-lg3">
                                <div class="console-link-block">
                                    <div class="console-link-block-num"><?php echo htmlentities($tj['wxcount']); ?></div>
                                    <div class="console-link-block-text">微信通道</div>
                                    <i class="console-link-block-icon layui-icon layui-icon-login-wechat"></i>

                                </div>
                            </div>
                            <div class="layui-col-md3 layui-col-sm4 layui-col-xs6 layui-col-lg3">
                                <div class="console-link-block">
                                    <div class="console-link-block-num"><?php echo htmlentities($tj['alicount']); ?></div>
                                    <div class="console-link-block-text">支付宝通道</div>
                                    <i class="console-link-block-icon layui-icon layui-icon-cellphone"></i>

                                </div>
                            </div>
                            <div class="layui-col-md3 layui-col-sm4 layui-col-xs6 layui-col-lg3">
                                <div class="console-link-block">
                                    <div class="console-link-block-num"><?php echo htmlentities($tj['qqcount']); ?></div>
                                    <div class="console-link-block-text">QQ通道</div>
                                    <i class="console-link-block-icon layui-icon layui-icon-login-qq"></i>

                                </div>
                            </div>
                            <div class="layui-col-md3 layui-col-sm4 layui-col-xs6 layui-col-lg3">
                                <div class="console-link-block">
                                    <div class="console-link-block-num"><?php echo htmlentities($tj['lixiancount']); ?></div>
                                    <div class="console-link-block-text">离线通道</div>
                                    <i class="console-link-block-icon layui-icon layui-icon-component"></i>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="layui-col-xs12 layui-col-md4">
                <div class="layui-card">
                    <div class="layui-card-header">商户信息</div>
                    <div class="layui-card-body">
                        <table class="layui-table layui-text">
                            <colgroup>
                                <col width="90">
                                <col>
                            </colgroup>
                            <tbody>

                                <tr>
                                    <td>接口地址</td>
                                    <td>
                                        <?php echo htmlentities($url); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>商户ID</td>
                                    <td> <?php echo htmlentities($user['id']); ?> </td>
                                </tr>
                                <tr ew-tpl-rs="">
                                    <td>商户密钥</td>
                                    <td>
                                       <?php echo htmlentities($user['user_key']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>商户余额</td>
                                    <td><?php echo htmlentities($user['money']); ?> </td>
                                </tr>
                                <tr>
                                    <td>商户费率</td>
                                    <td><?php echo htmlentities($user['feilv']); ?> %</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>

    </div>
    <script type="text/javascript" src="/wwwroot/layui/assets/libs/layui/layui.js"></script>
    <script type="text/javascript" src="/wwwroot/layui/assets/js/common.js?v=318"></script>
    <script src="/wwwroot/lib/static/js/jquery-1.12.2.min.js"></script>
    <script src="/wwwroot/js/js.cookie.js"></script>
    <script src="/wwwroot/layer/layer.js"></script>

</body>
</html>

