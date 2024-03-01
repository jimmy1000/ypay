<?php /*a:1:{s:52:"/www/wwwroot/hm.otbax.cn/view/index/my/loginlog.html";i:1660790122;}*/ ?>

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
</head>

<body onscroll="layui.admin.hideFixedEl();">
    <!-- 正文开始 -->
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-header">登录日志</div>
            <div class="layui-card-body">
                <!-- 数据表格 -->
                <table id="MoneyTable" lay-filter="MoneyTable"></table>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="/wwwroot/layui/assets/libs/layui/layui.js"></script>
    <script type="text/javascript" src="/wwwroot/layui/assets/js/common.js?v=318"></script>
    <script>
        layui.use(['layer', 'form', 'laytpl', 'admin', 'table', 'laydate', 'util'], function () {
            var $ = layui.jquery;
            var layer = layui.layer;
            var form = layui.form;
            var table = layui.table;
            var laydate = layui.laydate;
            var util = layui.util;
            /* 渲染表格 */
            var insTb = table.render({
                elem: '#MoneyTable',
                url: "/My/LoginLog",
                page: true,
                limit: 10,
                cellMinWidth: 100,
                escape: true,
                cols: [[
                    { field: 'id', title: 'ID', minWidth: 120, align: 'center' },
                    { field: 'uid', title: '商户ID', minWidth: 120, align: 'center' },
                    { field: 'url', title: '操作页面', minWidth: 120, sort: true, align: 'center' },
                    { field: 'desc', title: '登录详情', minWidth: 120, sort: true, align: 'center' },
                    { field: 'ip', title: '登录IP', minWidth: 120, sort: true, align: 'center' },
                   
                    { field: 'create_time', title: '变更时间', minWidth: 120, align: 'center' }
                ]]
            });

            /* 表格搜索 */
            form.on('submit(tbBasicTbSearch)', function (data) {
                if (data.field.order_time) {
                    var searchDate = data.field.order_time.split(' - ');
                    data.field.startDate = searchDate[0];
                    data.field.endDate = searchDate[1];
                } else {
                    data.field.startDate = null;
                    data.field.endDate = null;
                }
                data.field.order_time = undefined;
                insTb.reload({ where: data.field, page: { curr: 1 } });
                return false;
            });
            /* 渲染创建时间选择 */
            laydate.render({
                elem: 'input[name="order_time"]',
                type: 'date',
                range: true,
                trigger: 'click'
            });

            /* 渲染支付时间选择 */
            laydate.render({
                elem: 'input[name="pay_time"]',
                type: 'date',
                range: true,
                trigger: 'click'
            });
        });

    </script>
</body>
</html>
