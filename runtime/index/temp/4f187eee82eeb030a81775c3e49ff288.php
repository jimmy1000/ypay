<?php /*a:1:{s:54:"/www/wwwroot/hm.otbax.cn/view/index/deal/orderlog.html";i:1658229124;}*/ ?>
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
    <style>
        /** 数据表格中的select尺寸调整 */
        .layui-table-view .layui-table-cell .layui-select-title .layui-input {
            height: 28px;
            line-height: 28px;
        }

        .layui-table-view [lay-size="lg"] .layui-table-cell .layui-select-title .layui-input {
            height: 40px;
            line-height: 40px;
        }

        .layui-table-view [lay-size="lg"] .layui-table-cell .layui-select-title .layui-input {
            height: 40px;
            line-height: 40px;
        }

        .layui-table-view [lay-size="sm"] .layui-table-cell .layui-select-title .layui-input {
            height: 20px;
            line-height: 20px;
        }

        .layui-table-view [lay-size="sm"] .layui-table-cell .layui-btn-xs {
            height: 18px;
            line-height: 18px;
        }
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
                font-size: 40px;
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
    </style>
</head>

<body onscroll="layui.admin.hideFixedEl();">
    <!-- 正文开始 -->
    <div class="layui-fluid">

        <div class="layui-card zjmx-body">
            <div class="layui-card-body layui-card-je">
                <div class="text-normal" style="padding-left: 20px">总订单数：<?php echo htmlentities($tj['allordercount']); ?> 笔，今日订单数：<?php echo htmlentities($tj['dayordercount']); ?> 笔  ，总流水金额：<?php echo htmlentities($tj['allmoney']); ?> 元  ， 今日流水金额：<?php echo htmlentities($tj['daymoney']); ?> 元</div>
            </div>
        </div>

        <div class="layui-card">
            <div class="layui-card-body">
                <!-- 表格工具栏 -->
                <form class="layui-form toolbar table-tool-mini">
                    <div class="layui-form-item">

                        <div class="layui-inline">
                            <label class="layui-form-label w-auto">通道ID:</label>
                            <div class="layui-input-inline">
                                <input name="account_id" class="layui-input" type="text" placeholder="请输入查询的通道ID" />
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label w-auto">订单号:</label>
                            <div class="layui-input-inline">
                                <input name="out_trade_no" class="layui-input" type="text" placeholder="查询的订单号" />
                            </div>
                        </div>

                        <div class="layui-inline">
                            <label class="layui-form-label w-auto">创建时间:</label>
                            <div class="layui-input-inline">
                                <input name="order_time" class="layui-input icon-date" placeholder="选择日期范围"
                                       autocomplete="off" />
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label w-auto">状态:</label>
                            <div class="layui-input-inline">
                                <select name="state">
                                    <option value="k">选择状态</option>
                                    <option value="0">未支付</option>
                                    <option value="1">已支付</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline" style="padding-right: 110px;">
                            <button class="layui-btn icon-btn" lay-filter="tbBasicTbSearch" lay-submit>
                                <i class="layui-icon">&#xe615;</i>查询
                            </button>
                            
                        </div>
                    </div>
                </form>
                <hr>
                <!-- 数据表格 -->
                <table id="tbBasicTable" lay-filter="tbBasicTable"></table>
            </div>
        </div>
    </div>

    <script type="text/html" id="eDialogTbState">
        {{# if(d.state==2){ }}
        {{# if(d.api_state==2){ }}
        <span class="layui-badge layui-badge-green">已回调</span>
        {{# }else if(d.api_state==1){ }}
        <span class="layui-badge layui-badge-blue">未请求</span>
        {{# }else if(d.api_state==3){ }}
        <span class="layui-badge layui-badge-grat" lay-event="checkList">回调失败</span>
        {{# } }}
        {{# }else if(d.state==1){ }}
        ---
        {{# }else if(d.state==3){ }}
        ---
        {{# } }}
    </script>
    <!-- 操作列 -->
    <script type="text/html" id="reback_set">

        {{# if(d.status==2){ }}
        ---
        {{# }else if(d.status==0){ }}
        <a class="deep-blue " lay-event="add_reback">手动补单</a>
        {{# }else if(d.status==1){ }}
        <a class="deep-blue " lay-event="add_reback">重新补单</a>
        {{# } }}

    </script>

    <script type="text/javascript" src="/wwwroot/layui/assets/libs/layui/layui.js"></script>
    <script type="text/javascript" src="/wwwroot/layui/assets/js/common.js?v=318"></script>
    <script>
        layui.use(['layer', 'form', 'laytpl', 'admin', 'table', 'util', 'dropdown', 'laydate', 'notice'], function () {
            var $ = layui.jquery;
            var layer = layui.layer;
            var form = layui.form;
            var table = layui.table;
            var util = layui.util;
            var dropdown = layui.dropdown;
            var laytpl = layui.laytpl;
            var admin = layui.admin;
            var laydate = layui.laydate;
            var notice = layui.notice;
            /* 渲染表格 */
            var insTb = table.render({
                elem: '#tbBasicTable',
                url: "/Deal/OrderLog",
                page: true,
                limit: 10,
                cellMinWidth: 100,
                escape: true,
                cols: [[
                    {
                        field: 'pla_type', title: '订单类型', minWidth: 100, align: 'center', templet: function (d) {
                            var strs = {
                                1: '<span class="layui-badge layui-badge-green">本地订单</span>',
                                2: '<span class="layui-badge layui-badge-red">转接订单</span>'
                                
                            };
                            return strs[d.pla_type];
                        }
                    },
                    { field: 'account_id', title: '通道', minWidth: 80, align: 'center' },
                    { field: 'user_id', title: 'UID', minWidth: 80, align: 'center' },
                    { field: 'out_trade_no', title: '订单号', minWidth: 180, align: 'center' },
                    //{ field: 'trade_no', title: '通道订单号', minWidth: 180, align: 'center' },
                    { field: 'name', title: '商品名称', minWidth: 180, align: 'center' },
                    
                    {
                        field: 'type', title: '支付方式', minWidth: 100, align: 'center', templet: function (d) {
                            var strs = {
                                alipay: '<span style="color:blue">支付宝</span>',
                                wxpay: '<span style="color:blue">微信</span>',
                                qqpay: '<span style="color:blue">Q Q</span>'
                            };
                            return strs[d.type];
                        }
                    },
 
                    { field: 'money', title: '金额', minWidth: 100, sort: true, align: 'center' },
                    { field: 'truemoney', title: '实付金额', minWidth: 100, sort: true, align: 'center' },
                    { field: 'feilvmoney', title: '费率金额', minWidth: 100, align: 'center' },
                    {
                        field: 'create_time', title: '创建时间|支付时间', minWidth: 155, align: 'center', templet: function (d) {
                            if (d.createtime != "") {
                                if(d.end_time==null)
                                {
                                    return d.create_time + '/' + "未支付";
                                }
                                else
                                {
                                    return d.create_time + '/' + d.end_time;
                                }
                                
                            } else {
                                return '---'
                            }
                        }
                    },
                    {
                        field: 'status', title: '状态', minWidth: 100, align: 'center', templet: function (d) {
                            var strs = {
                                1: '<span class="layui-badge layui-badge-green">已支付</span>',
                                0: '<span class="layui-badge layui-badge-gray">未支付</span>'
                                
                            };
                            return strs[d.status];
                        }
                    },
                    { field: 'api_memo', title: '回调信息', minWidth: 80, align: 'center' },
                    { toolbar: '#reback_set', title: '操作', minWidth: 110, align: 'center' },
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

            /* 表格工具条点击事件 */
            table.on('tool(tbBasicTable)', function (obj) {
                var data = obj.data; // 获得当前行数据
                var layEvent = obj.event;
                if (obj.event === 'add_reback') { // 补单回调
                    add_reback(data);
                } else if (layEvent == 'checkList') {
                    openCheckList(data);
                }
                dropdown.hideAll();
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

            function add_reback(obj) {
                layer.confirm('确定要处理此订单吗？<br><span style="color:red">确认处理后将进行补单，届时该订单将变更为已支付和进行回调处理,该通道相应的金额也会计入</span>,已知晓请确认!', {
                    shade: .1,
                    skin: 'layui-layer-admin'
                }, function (i) {
                    layer.close(i);
                    layer.load(2);
                    $.get("/Deal/Reback", {
                        id: obj.id
                    }, function (res) {
                        layer.closeAll('loading');
                        if (res.code == 1) {
                            notice.msg(res.msg, { icon: 1 });
                            insTb.reload({ page: { curr: 1 } });

                        } else {
                            notice.msg(res.msg, { icon: 2 });
                            insTb.reload({ page: { curr: 1 } });
                        }
                    }, 'json');

                });
            }

            // 回调内容弹窗
            function openCheckList(d) {
                laytpl(eDialogCheckDialog.innerHTML).render(d, function (html) {
                    admin.open({
                        type: 1,
                        title: '回调结果',
                        content: html
                    });
                });
            }

        });

    </script>
</body>
</html>
