<?php /*a:1:{s:51:"/www/wwwroot/fttqq.cn/view/index/channel/index.html";i:1669384286;}*/ ?>


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

        .gjhy {
            text-align: left !important;
            line-height: 30px;
        }

        .yda1 {
            width: 50px;
            height: 24px;
            background: #fff;
            color: #ff5722;
            border: 1px solid #ff5722;
            text-indent: 0;
            line-height: 24px;
            text-align: center;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-variant: tabular-nums;
            list-style: none;
            -webkit-font-feature-settings: 'tnum';
            font-feature-settings: 'tnum';
            display: inline-block;
            border-radius: 3px;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
            padding: 0 10px;
            vertical-align: middle;
        }

            .yda1:hover {
                color: #fff;
                background: #ff5722;
                text-decoration: none;
            }
                #kaleurl{
                    position: relative;
                }
                #file-btn-upload{
                        position: absolute;
                        right: 0;
                        top: 0;
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

        .alert {
            -webkit-border-radius: 2px;
            border-radius: 2px;
        }

        .alert-info {
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
        }

        .alert-dismissable, .alert-dismissible {
            padding-right: 35px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-header">通道列表</div>
            <div class="layui-card-body">
                <div class="rice_tag">
                    <?php echo getConfig()['td_notice']; ?>
                </div>
                <br /><div class="vipx"></div>
                <form class="layui-form toolbar table-tool-mini">
                    <div class="layui-form-item">
                      
                        <div class="layui-inline">
                            <label class="layui-form-label w-auto">类型:</label>
                            <div class="layui-input-inline">
                                <select name="type">
                                    <option value="">全部类型</option>
                                    <option value="alipay">支付宝</option>
                                    <option value="wxpay">微信</option>
                                    <option value="qqpay">QQ钱包</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label w-auto">状态:</label>
                            <div class="layui-input-inline">
                                <select name="status">
                                    <option value="2">请选择状态</option>
                                    <option value="1">在线</option>
                                    <option value="0">离线</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">

                            <button class="layui-btn icon-btn" lay-filter="tbBasicTbSearch" lay-submit>
                                <i class="layui-icon">&#xe615;</i>搜索
                            </button>
                            <button class="layui-btn icon-btn" id="shanghtianj" type="button">
                                <i class="layui-icon">&#xe624;</i>新增
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
    <script type="text/html" id="shangh">
        <form id="dialogEditForm1" lay-filter="dialogEditForm1" class="layui-form model-form" style="padding-right: 20px;">
            <div class="">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-form-required">通道类型:</label>
                    <div class="layui-input-block">
                        <select lay-filter="types" name="type" id="type" lay-verType="tips" lay-verify="required" required>
                                <option value="wxpay">微信</option>
                                <option value="alipay">支付宝</option>
                                <option value="qqpay">QQ</option>
                        </select>
                    </div>
          
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-form-required">通道名称:</label>
                    <div class="layui-input-block">
                        <select lay-filter="code" name="code" id="che" lay-verType="tips" lay-verify="required" required>
                            <?php if(is_array($channel) || $channel instanceof \think\Collection || $channel instanceof \think\Paginator): $i = 0; $__LIST__ = $channel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo htmlentities($vo['code']); ?>"><?php echo htmlentities($vo['name']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item" id="kaleurl">
                    <label class="layui-form-label layui-form-required">二维码URL:</label>
                    <div class="layui-input-block">
                        <input name="qr_url" id="qr_url" placeholder="如无法识别请修剪收款码多余边边" class="layui-input" />
                    </div>
                    <button type="button" class="layui-btn" id="file-btn-upload">上传图片</button>
                </div>

                <div class="layui-form-item" id="kalenick">
                    <label class="layui-form-label layui-form-required">昵称/店铺名:</label>
                    <div class="layui-input-block">
                        <input name="wxname" placeholder="昵称/店铺名" class="layui-input" />
                    </div>
                </div>
                <div class="layui-form-item" id="qq">
                    <label class="layui-form-label layui-form-required">QQ号码:</label>
                    <div class="layui-input-block">
                        <input name="qq" placeholder="您的QQ号" class="layui-input" />
                    </div>
                </div>
                <div id='zfbpid' class="layui-form-item">
                    <label class="layui-form-label layui-form-required" id="pid_title">支付宝PID:</label>
                    <div class="layui-input-block">
                        <input name="zfb_pid" id="zfb_pid" placeholder="必须输入支付宝PID" class="layui-input" />
                    </div>
                </div>
                <div class="layui-form-item" id="pkey"  >
                    <label class="layui-form-label layui-form-required">支付宝公钥:</label>
                    <div class="layui-input-block">
                        <input name="cookie" placeholder="请输入支付宝公钥" class="layui-input" />
                    </div>
                </div>
                <div class="layui-form-item" id="akey"  >
                    <label class="layui-form-label layui-form-required">应用私钥:</label>
                    <div class="layui-input-block">
                        <input name="aliappkey" placeholder="请输入应用私钥" class="layui-input" />
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label layui-form-required">备注信息:</label>
                    <div class="layui-input-block">
                        <input name="memo" placeholder="备注信息" class="layui-input" />
                    </div>
                </div>
                
                
                <div class="layui-form-item" id="diyu">
                    <label class="layui-form-label layui-form-required">地域选择:</label>
                    <div class="layui-input-block">
                        <select lay-filter="diyu" name="diyu" lay-verType="tips" lay-verify="required" required>
                            <?php if(is_array($xy) || $xy instanceof \think\Collection || $xy instanceof \think\Paginator): $i = 0; $__LIST__ = $xy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['name']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                


            </div>
            <div class="layui-form-item text-right model-form-footer">
                <button class="layui-btn layui-btn-danger" type="button" ew-event="closeDialog">取消</button>
                <button class="layui-btn" lay-filter="dialogEditSubmit1" lay-submit>新增</button>
            </div>
        </form>
    </script>

    <script type="text/html" id="gengxin">
        <form id="dialogEditForm2" lay-filter="dialogEditForm2" class="layui-form model-form" style="padding-right: 20px;">
            <div class="">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-form-required">当前状态:</label>
                    <div class="layui-input-block gjhy">
                        <span style="color:red" name="status" id="status">等待操作中</span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-form-required">二维码信息:</label>
                    <div class="layui-input-block">
                        <img style="display: block;" id='src' src="" width="150" height="150" alt="请重新获取" /><div id="wenben"></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-form-required">账号信息:</label>
                    <div class="layui-input-block gjhy">
                        <span style="color:red" name="account" id="account"></span>
                    </div>
                </div>


            </div>
            <div class="layui-form-item text-right model-form-footer">
                <button class="layui-btn layui-btn-danger" type="button" ew-event="closeDialog">取消</button>
                <button class="layui-btn" lay-filter="dialogEditSubmit2" lay-submit>更新</button>
            </div>
        </form>
    </script>

    <script type="text/html" id="qqcloud">
        <form id="dialogEditForm3" lay-filter="dialogEditForm3" class="layui-form model-form" style="padding-right: 20px;">
            <div class="">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-form-required">账号信息:</label>
                    <div class="layui-input-block gjhy">
                        <span style="color:red" name="cloudq" id="cloudq"></span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-form-required">当前状态:</label>
                    <div class="layui-input-block gjhy">
                        <span style="color:red" name="status" id="status">等待操作中</span>
                    </div>
                </div>
                <div class="layui-form-item" id="yunyz">
                    <label class="layui-form-label layui-form-required">登录方式:</label>
                    <div class="layui-input-block">
                        <input type="radio" name="login_type" lay-filter="login_type" value="1" checked title="扫码登录">
                        <input type="radio" name="login_type" lay-filter="login_type" value="2" title="密码登录">
                    </div>
                </div>
                <div class="layui-form-item" id="pwd">
                    <label class="layui-form-label layui-form-required">账号密码:</label>
                    <div class="layui-input-block gjhy">
                        <input name="pass" id="pass" placeholder="请输入您的密码" class="layui-input" />
                    </div>
                </div>
                <div class="layui-form-item" id="gn">
                    <label class="layui-form-label layui-form-required">功能操作:</label>
                    <div class="layui-input-block">
                        <a class="layui-btn layui-btn-sm" id="pwdlogin">提交登录</a>
                        <a class="layui-btn layui-btn-sm" id="qlogin">登录账号</a>
                    </div>
                </div>
                <div class="layui-form-item" id="cqr">
                    <label class="layui-form-label layui-form-required">二维码信息:</label>
                    <div class="layui-input-block">

                        <a class="layui-btn layui-btn-sm" id="getqrlogin">获取登录二维码</a>
                        <img style="display: ;" id='src' src="" width="150" height="150" alt="请重新获取" />
                    </div>
                </div>

            </div>
            <div class="layui-form-item text-right model-form-footer">
                <button class="layui-btn layui-btn-danger" type="button" ew-event="closeDialog">取消</button>
                <button class="layui-btn" lay-filter="dialogEditSubmit3" lay-submit>更新</button>
            </div>
        </form>
    </script>
    
    


    <!-- 表格操作列 -->
    <script type="text/html" id="tbBasicTbBar">
        <a class="yda1 ydz" lay-event="edit">更新</a>
        <a class="yda1 ydz" lay-event="del">删除</a>
    </script>

    <!-- 表格轮询列 -->
    <script type="text/html" id="userTblx">
        <input type="checkbox" lay-filter="userTblxCk" value="{{d.id}}" lay-skin="switch" lay-text="顺序|随机" {{d.land_lx==1?'checked':''}} style="display: none;" />
        <p style="display: none;">{{d.land_lx==1?'顺序':'随机'}}</p>
    </script>
    <script type="text/html" id="cstatus">
        <input type="checkbox" lay-filter="userStatusCk" value="{{d.id}}" lay-skin="switch" lay-text="启用|禁用" {{d.is_status==1?'checked':''}} style="display: none;" />
        <p style="display: none;">{{d.is_status==1?'启用':'禁用'}}</p>
    </script>

<script src="/wwwroot/js/yuancloud.js"></script>
    <script type="text/javascript" src="/wwwroot/layui/assets/libs/layui/layui.js"></script>
    <script type="text/javascript" src="/wwwroot/layui/assets/js/common.js"></script>
    <script>
        layui.use(['layer', 'form', 'admin', 'table', 'util', 'dropdown', 'notice','upload', 'element'], function () {
            var $ = layui.jquery;
            var layer = layui.layer;
            var form = layui.form;
            var table = layui.table;
            var util = layui.util;
            var dropdown = layui.dropdown;
            var admin = layui.admin;
            var notice = layui.notice;
            var t1;//定时器
            var upload = layui.upload;
            var element = layui.element;

            /* 渲染表格 */
            var insTb = table.render({
                elem: '#tbBasicTable',
                url: "/Channel/Index",
                page: true,
                limit: 10,
                cellMinWidth: 100,
                escape: true,
                cols: [[
                    //{ type: 'radio' },
                    { field: 'id', title: '通道ID', align: 'left', width: 80, align: 'center' },
                    {
                        field: 'type', title: '支付模式', align: 'center', width: 100, templet: function (d) {
                            if (d.type == 'alipay') {
                                return '<span style="color:blue">支付宝</span>';
                            } else if (d.type == 'wxpay') {
                                return '<span style="color:blue">微信</span>';
                            } else if (d.type == 'qqpay') {
                                return '<span style="color:blue">Q Q</span>';
                            }
                        }
                    },
                    {
                        field: 'code', title: '通道模式', align: 'center', width: 100, templet: function (d) {
                            if (d.code == 'alipay_mg') {
                                return '<span style="color:blue">商家版</span>';
                            } else if (d.code == 'alipay_grmg') {
                                return '<span style="color:blue">个人版</span>';
                            } else if (d.code == 'wxpay_dy') {
                                return '<span style="color:blue">店员免挂</span>';
                            } else if (d.code == 'wxpay_cloud') {
                                return '<span style="color:blue">V1免输入</span>';
                            }  else if (d.code == 'wxpay_ipad') {
                                return '<span style="color:blue">V2免输入</span>';
                            }else if (d.code == 'wxpay_cloudzs') {
                                return '<span style="color:blue">赞赏码</span>';
                            } else if (d.code == 'wxpay_skd') {
                                return '<span style="color:blue">收款单</span>';
                            } else if (d.code == 'qqpay_mg') {
                                return '<span style="color:blue">本地免挂</span>';
                            } else if (d.code == 'qqpay_cloud') {
                                return '<span style="color:blue">云端免挂</span>';
                            } else if (d.code == 'alipay_allmg') {
                                return '<span style="color:blue">通用版</span>';
                            } else if (d.code == 'alipay_app') {
                                return '<span style="color:blue">支付宝APP</span>';
                            }else if (d.code == 'wxpay_app') {
                                return '<span style="color:blue">微信APP</span>';
                            }else if (d.code == 'wxpay_zg') {
                                return '<span style="color:blue">微信自挂</span>';
                            }else if (d.code == 'alipay_pc') {
                                return '<span style="color:blue">商家软件版</span>';
                            }else if (d.code == 'alipay_dmf') {
                                return '<span style="color:blue">当面付</span>';
                            }
                        }
                    },

                    {
                        field: 'zfb_pid', title: 'PID/GUID/QQ/NICK', width: 200, align: 'center', templet: function (d) {
                            if (d.code == 'alipay_mg') {
                                return d.zfb_pid;
                            } else if (d.code == 'alipay_grmg') {
                                return d.zfb_pid;
                            }else if (d.code == 'alipay_allmg') {
                                return d.zfb_pid;
                            }
                            else if (d.code == 'alipay_dmf') {
                                return d.zfb_pid;
                            }
                            else if (d.code == 'alipay_pc') {
                                return d.zfb_pid;
                            }
                            else if (d.code == 'alipay_app') {
                                return d.zfb_pid;
                            }
                            else if (d.code == 'wxpay_cloud') {
                                return d.wx_guid;
                            }
                            else if (d.code == 'wxpay_ipad') {
                                return d.wx_guid;
                            }
                            else if (d.code == 'wxpay_cloudzs') {
                                return d.wx_guid;
                            }
                            else if (d.code == 'wxpay_skd') {
                                return d.wx_guid;
                            }
                            else if (d.code == 'qqpay_mg') {
                                return d.qq;
                            } else if (d.code == 'qqpay_cloud') {
                                return d.qq;
                            }else if (d.code == 'wxpay_dy') {
                                return d.wxname;
                            }
                            else {
                                return '<span style="color:red">----</span>';
                            }
                        }
                    },
                    { field: 'succcount', title: '收款笔数', align: 'left', width: 80, align: 'center' },
                    { field: 'succprice', title: '收款金额', align: 'left', width: 100, align: 'center' },

                    {
                        field: 'status', title: '在线状态', width: 120, align: 'center', templet: function (d) {
                            if (d.status == 1) {
                                return '<span style="color:green">在线</span>';
                            } else {
                                return '<span style="color:red">离线</span>';
                            }
                        }
                    },
                    { field: 'is_status', title: '收款状态', templet: '#cstatus', width: 100, align: 'center' },
                    //{ field: 'land_lx', title: '轮询方式', templet: '#userTblx', width: 100, align: 'center' },

                    { field: 'create_time', title: '创建时间', align: 'left', width: 150, align: 'center' },
                    { field: 'update_time', title: '监控时间', align: 'left', width: 150, align: 'center' },
                    { field: 'memo', title: '账号备注', align: 'left', width: 120, align: 'center' },
                    { title: '操作', toolbar: '#tbBasicTbBar', align: 'center', minWidth: 160 }
                ]]
            });

            /* 表格搜索 */
            form.on('submit(tbBasicTbSearch)', function (data) {
                insTb.reload({ where: data.field, page: { curr: 1 } });
                return false;
            });

            /* 表格工具条点击事件 */
            table.on('tool(tbBasicTable)', function (obj) {
                if (obj.event === 'edit') { // 修改
                    edit_land(obj)
                } else if (obj.event === 'del') { // 删除
                    del_land(obj)
                } else if (obj.event === 'pay') { // 发起测试
                    pay_demo(obj)
                }
            });
            
            /* 筛选通道 */
            form.on('select(types)', function (obj) {
                var postdata ={
                    id: obj.elem.value,
                }
                $.getJSON("/Channel/type",postdata,function(data){
                    if (data.code) {
                            var list= data.channel;
                            var nr= '';
                            if(list){
                                for(var i = 0; i < list.length; i++) {
                                        nr += "<option value='" + list[i].code + "'>" + list[i].name + "</option>"
                                };
                            }
                            $("#che").html(nr);
                            form.render('select');
                             //获取当前第一个通道
                        var s =  $('#che').val();
                        
                        if (s == 'wxpay_dy') {
                            $("#kaleurl").show();
                            $("#kalenick").show();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'wxpay_app') {
                            $("#kaleurl").show();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'wxpay_zg') {
                            $("#kaleurl").show();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'alipay_allmg') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").show();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'alipay_dmf') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").show();
                                $("#pid_title").html("APPID:");
                                $("#zfb_pid").attr("placeholder", "必须输入APPID");
                                $("#akey").show();
                                $("#pkey").show();
                            } else if (s == 'alipay_app') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").show();
                            $("#zfbpid").show();
                            $("#akey").hide();
                            $("#pkey").hide();
                        }  else if (s == 'alipay_mg') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").show();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'alipay_pc') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").show();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'alipay_grmg') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").show();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'wxpay_cloud') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").show();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#pkey").hide();
                            $("#akey").hide();
                        }else if (s == 'wxpay_ipad') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").show();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#pkey").hide();
                            $("#akey").hide();
                        } else if (s == 'wxpay_cloudzs') {
                            $("#kaleurl").show();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").show();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#pkey").hide();
                            $("#akey").hide();
                        } else if (s== 'wxpay_skd') {
                            $("#kaleurl").show();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").show();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else {
                            $("#kaleurl").hide();
                            $("#qq").show();
                            $("#kalenick").hide();
                            $("#diyu").hide();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        }


                        form.on('select(code)', function (data) {
                            if (data.value == 'wxpay_dy') {
                                $("#kaleurl").show();
                                $("#kalenick").show();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            }  else if(data.value == 'wxpay_app') {
                                $("#kaleurl").show();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            } else if(data.value == 'wxpay_zg') {
                                $("#kaleurl").show();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            }else if(data.value == 'alipay_mg') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            }else if(data.value == 'alipay_pc') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            }else if(data.value == 'alipay_app') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").show();
                                $("#pkey").hide();
                                $("#pid_title").html("支付宝PID:");
                                $("#zfb_pid").attr("placeholder", "必须输入支付宝PID");
                                $("#akey").hide();
                            }else if (data.value == 'alipay_allmg') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            } else if (data.value == 'alipay_grmg') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").hide();
                                $("#pkey").hide();
                                $("#akey").hide();
                            } else if (data.value == 'alipay_dmf') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").show();
                                $("#pid_title").html("APPID:");
                                $("#zfb_pid").attr("placeholder", "必须输入APPID");
                                $("#akey").show();
                                $("#pkey").show();
                            } 
                            else if (data.value == 'wxpay_cloud') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").show();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            }else if (data.value == 'wxpay_ipad') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").show();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            } else if (data.value == 'wxpay_cloudzs') {
                                $("#kaleurl").show();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").show();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            } else if (data.value == 'wxpay_skd') {
                                $("#kaleurl").show();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").show();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            }else {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").show();
                                $("#diyu").hide();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            }
                        });
                        }else{
                            console.log(obj);
                        }
                    },true);
            });
            

            /* 通道添加 */
            $('#shanghtianj').click(function () {

                admin.open({
                    type: 1,
                    title: "添加通道",
                    area: ['520px','450px'],
                    content: $('#shangh').html(),
                    success: function (layero, dIndex) {
                        $(layero).children('.layui-layer-content').css('overflow', 'visible');
                        //加载
                        form.render();
                        
                        //获取当前第一个通道
                        var s =  $('#che').val();
                        if (s == 'wxpay_dy') {
                            $("#kaleurl").show();
                            $("#kalenick").show();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'wxpay_app') {
                            $("#kaleurl").show();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'wxpay_zg') {
                            $("#kaleurl").show();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'alipay_allmg') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").show();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'alipay_app') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").show();
                            $("#zfbpid").show();
                            $("#akey").hide();
                            $("#pkey").hide();
                        }  else if (s == 'alipay_mg') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").show();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'alipay_pc') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").show();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'alipay_grmg') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").show();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        }  else if (s == 'alipay_dmf') {
                            $("#kaleurl").show();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").hide();
                            $("#yunyz").show();
                            $("#zfbpid").show();
                            $("#akey").show();
                            $("#pkey").show();
                        } else if (s == 'wxpay_cloud') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").show();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        }else if (s == 'wxpay_ipad') {
                            $("#kaleurl").hide();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").show();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s == 'wxpay_cloudzs') {
                            $("#kaleurl").show();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").show();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else if (s== 'wxpay_skd') {
                            $("#kaleurl").show();
                            $("#kalenick").hide();
                            $("#qq").hide();
                            $("#diyu").show();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        } else {
                            $("#kaleurl").show();
                            $("#qq").show();
                            $("#kalenick").hide();
                            $("#diyu").hide();
                            $("#yunyz").hide();
                            $("#zfbpid").hide();
                            $("#akey").hide();
                            $("#pkey").hide();
                        }


                        form.on('select(code)', function (data) {
                            
                            
                            if (data.value == 'wxpay_dy') {
                                $("#kaleurl").show();
                                $("#kalenick").show();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            }  else if(data.value == 'wxpay_app') {
                                $("#kaleurl").show();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            } else if(data.value == 'wxpay_zg') {
                                $("#kaleurl").show();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            }else if(data.value == 'alipay_mg') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").hide();
                                $("#pkey").hide();
                                $("#akey").hide();
                            }else if(data.value == 'alipay_dmf')//当面付
                            {
                                $("#kaleurl").show();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").show();
                                $("#akey").show();
                                $("#pkey").show();
                            }else if(data.value == 'alipay_pc') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            }else if(data.value == 'alipay_app') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").show();
                                $("#akey").hide();
                                $("#pkey").hide();
                            }else if (data.value == 'alipay_allmg') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            } else if (data.value == 'alipay_grmg') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").hide();
                                $("#yunyz").show();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                                $("#pkey").hide();
                            } else if (data.value == 'wxpay_cloud') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").show();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#pkey").hide();
                                $("#akey").hide();
                            } else if (data.value == 'wxpay_ipad') {
                                $("#kaleurl").hide();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").show();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#pkey").hide();
                                $("#akey").hide();
                            } else if (data.value == 'wxpay_cloudzs') {
                                $("#kaleurl").show();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").show();
                                $("#yunyz").hide();
                                $("#zfbpid").hide();
                                $("#pkey").hide();
                                $("#akey").hide();
                            } else if (data.value == 'wxpay_skd') {
                                $("#kaleurl").show();
                                $("#kalenick").hide();
                                $("#qq").hide();
                                $("#diyu").show();
                                $("#yunyz").hide();
                                $("#pkey").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                            } else {
                                $("#kaleurl").show();
                                $("#kalenick").hide();
                                $("#qq").show();
                                $("#diyu").hide();
                                $("#yunyz").hide();
                                $("#pkey").hide();
                                $("#zfbpid").hide();
                                $("#akey").hide();
                            }
                        });
                        
                        var uploadInst = upload.render({
                            elem: '#file-btn-upload'
                            ,url: '/channel/upload'
                            //,size: 2000 //限制文件大小，单位 KB
                            //,accept: 'file'
                            ,method: 'get'
                            ,fileAccept: 'image/*'
                            ,exts: "jpg|png|gif|bmp|jpeg|pdf"
                            ,data: { //额外参数
                              a: 1
                              ,b: function(){
                                return 2
                              }
                            }
                            ,done: function(res, index){
                            
                              //如果上传失败
                              if(res.code > 0){
                                return layer.msg('上传失败');
                              }
                              $('#qr_url').val(res.data.src);
                              
                              //上传成功
                              console.log(res, index);
                            }
                            ,error: function(index, upload){
                              this.item.html('重选上传');
                              
                              //演示失败状态，并实现重传
                              var demoText = $('#demoText');
                              demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                              demoText.find('.demo-reload').on('click', function(){
                                uploadInst.upload();
                              });
                              
                              element.progress('demo', '0%');
                            }
                            ,progress: function(n, elem, res, index){
                              console.log(n + '%', elem, res, index); //获取进度百分比
                              element.progress('demo', n + '%'); //可配合 layui 进度条元素使用
                            }
                          });
                        
                        form.on('submit(dialogEditSubmit1)', function (data) {
                            var loadIndex = layer.load(2);
                            $.post('/Channel/addchannel', data.field, function (res) {
                                layer.close(loadIndex);
                                if (200 == res.code) {
                                    notice.msg(res.msg, {
                                        icon: 1, onOpened: function () {
                                            layer.closeAll('page');
                                            insTb.reload({ page: { curr: 1 } });
                                        }
                                    });
                                } else {
                                    notice.msg(res.msg, { icon: 2 });
                                }
                            }, 'json');
                            return false;
                        });
                    }
                });
            });

            /* 修改状态 */
            form.on('switch(userStatusCk)', function (obj) {
                var loadIndex = layer.load();
                admin.req('/Channel/SaveStatus', {
                    id: obj.elem.value,
                    status: obj.elem.checked ? 1 : 0
                }, function (res) {
                    layer.close(loadIndex);
                    console.log(res);
                    if (res.code == 1) {
                        notice.msg(res.msg, { icon: 1 });
                    } else {
                        notice.msg(res.msg, { icon: 2 });
                    }
                }, 'post');
            });

            /* 修改轮询状态 */
            form.on('switch(userTblxCk)', function (obj) {
                var loadIndex = layer.load();
                admin.req('/Channel/SaveLandStatus', {
                    id: obj.elem.value,
                    land_lx: obj.elem.checked ? 1 : 0
                }, function (res) {
                    layer.close(loadIndex);
                    console.log(res);
                    if (res.code == 1) {
                        notice.msg(res.msg, { icon: 1 });
                    } else {
                        notice.msg(res.msg, { icon: 2 });
                    }
                }, 'post');
            });

            function edit_land(obj) {
                if(obj.data.code == "alipay_app" || obj.data.code == "wxpay_app" || obj.data.code == "alipay_dmf" || obj.data.code == "wxpay_zg" || obj.data.code == "alipay_pc")
                {
                    layer.alert('此通道无需此操作');
                    return false;
                }
                
                if (obj.data.code == "qqpay_cloud") {
                    admin.open({
                    type: 1,
                    title: "QQ云端更新通道ID：" + obj.data.id,
                    area: ['520px'],
                    content: $('#qqcloud').html(),
                    success: function (layero, dIndex) {
                        $(layero).children('.layui-layer-content').css('overflow', 'visible');
                        clearInterval(t1);
                        form.render();
                        $("#pwd").hide();
                        $("#src").hide();
                        $("#gn").hide();
                        $("#cloudq").html(obj.data.qq);
                        form.on('radio(login_type)', function (data) {
                            if (data.value == 1) {
                                //查询此QQ状态
                                admin.req('/Channel/VeryQQStatus', {
                                    qq: obj.data.qq,
                                    id: obj.data.id
                                }, function (res) {
                                    if (res.code == 1) {
                                        notice.msg("初始化成功,提交后若登录失败请联系站长!", { icon: 1 });
                                        $("#status").html("此QQ已登录,无需进行操作！");
                                        $("#pwd").hide();
                                        $("#cqr").show();
                                        $("#src").hide();
                                        $("#gn").hide();
                                        $("#getqrlogin").show();
                                    } else if (res.code == 0) {
                                        notice.msg(res.msg, { icon: 2 });
                                        $("#status").html("此QQ已登录,无需进行操作！");
                                        $("#pwd").hide();
                                        $("#cqr").show();
                                        $("#src").hide();
                                        $("#gn").hide();
                                        $("#getqrlogin").hide();
                                    } else {
                                        notice.msg("账号存在于列表中,请删除该通道新增！", { icon: 2 });
                                        $("#status").html("账号存在于列表中,请删除该通道新增！");
                                        $("#pwd").hide();
                                        $("#cqr").show();
                                        $("#src").hide();
                                        $("#gn").hide();
                                        $("#getqrlogin").hide();
                                    }
                                }, 'post');
                                return false;
                                
                            }
                            else
                            {
                                //查询此QQ状态
                                admin.req('/Channel/VeryQQStatus', {
                                    qq: obj.data.qq,
                                    id:obj.data.id
                                }, function (res) {
                                    if (res.code == 1) {
                                        notice.msg("初始化成功,提交后若登录失败请联系站长!", { icon: 1 });
                                        $("#pwd").show();
                                        $("#cqr").hide();
                                        $("#src").hide();
                                        $("#gn").show();
                                        $("#qlogin").hide();
                                        $("#pwdlogin").show();
                                    } else if(res.code==0) {
                                        notice.msg(res.msg, { icon: 2 });
                                        $("#status").html("此QQ已登录,无需进行操作！");
                                        $("#pwd").hide();
                                        $("#cqr").hide();
                                        $("#src").hide();
                                        $("#gn").hide();
                                    } else {
                                        notice.msg("账号存在于列表中,可进行登录操作！", { icon: 2 });

                                        $("#pwd").show();
                                        $("#cqr").hide();
                                        $("#src").hide();
                                        $("#gn").show();
                                        $("#pwdlogin").hide();
                                        $("#qlogin").show();
                                    }
                                }, 'post');
                                return false;
                            }
                        });
                        //获取登录二维码
                        $("#getqrlogin").click(function () {
                            $("#getqrlogin").hide();
                            clearInterval(t1);
                            admin.req('/Channel/CreatQrCodeInfo', {
                                id: obj.data.id
                            }, function (res) {
                                if (res.code == 1) {
                                    var qrid = res.qrid;
                                    function QLoginStatus() {
                                        admin.req('/Channel/GetQrCodeStatus', {
                                            QrId: qrid,
                                            id:obj.data.id
                                        }, function (res) {
                                            if (res.code == 1) {
                                                clearInterval(t1);
                                                $("#status").html(res.msg);
                                                
                                            }
                                            else {
                                                $("#status").html(res.msg);
                                            }
                                        }, 'post');
                                    }
                                    $("#src").show();
                                    $("#src").attr("src", res.qrfile);
                                    $("#status").html("请进行扫码登录操作！");
                                    t1 = setInterval(function () { QLoginStatus() }, 3000);
                                    return;
                                } else {
                                    notice.msg(res.msg, { icon: 2 });
                                    $("#status").html(res.msg);
                                }
                            }, 'post');
                            return false;
                            $("#src").show();
                            layer.msg("点击事件");
                        });
                        //已存在但未在线，尝试登录
                        $("#qlogin").click(function () {
                            admin.req('/Channel/QQLogin', {
                                qq: obj.data.qq,
                                id:obj.data.id
                            }, function (res) {
                                if (res.code == 1) {
                                    notice.msg(res.msg, { icon: 1 });
                                    $("#status").html(res.msg);
                                    
                                } else {
                                    notice.msg(res.msg, { icon: 2 });
                                    $("#status").html(res.msg);
                                }
                            }, 'post');
                            return false;
                        });

                        //密码登录账号
                        $("#pwdlogin").click(function () {
                            var pass = $("#pass").val();
                            clearInterval(t1);
                            if (pass == null || pass == "")
                            {
                                notice.msg("请输入密码进行验证", { icon: 2 });
                                return false;
                            }
                            //提交到云端验证登录
                            admin.req('/Channel/VeryQQPwd', {
                                id: obj.data.id,
                                qq: obj.data.qq,
                                pass: pass
                            }, function (res) {
                                if (res.code == 1) {
                                    notice.msg(res.msg, { icon: 1 });
                                    $("#status").html("已登录成功,请点击更新按钮！");
                                } else {
                                    notice.msg(res.msg, { icon: 2 });
                                    $("#status").html(res.msg);
                                }
                            }, 'post');
                            return false;

                        });
                    }
                });
                }
                else
                {
                    admin.open({
                    type: 1,
                    title: "更新通道ID：" + obj.data.id,
                    area: ['520px'],
                    content: $('#gengxin').html(),
                    success: function (layero, dIndex) {
                        $(layero).children('.layui-layer-content').css('overflow', 'visible');
                        clearInterval(t1);
                        form.render();
                        if (obj.data.code == "wxpay_dy")
                        {
                            var url = "<?php echo getConfig()['diy_clerkqr']; ?>";
                            if (url == null || url == "")
                            {
                                url = "/wwwroot/img/loading.gif";
                            }
                            $("#status").html("店员绑定中...");
                            $("#src").attr("src",url);
                            $("#account").html("店员监控请联系站长添加好友以及店员");
                            return;
                        }
                        
                        
                        $.post('/Channel/GetQrlistQrcode', { id: obj.data.id }, function (updata) {
                            if (updata.code === 1) {
                                function LoginStatus(wxsb) {
                                    admin.req('/Channel/GetChannelLoginStatus', {
                                        id: wxsb
                                    }, function (res) {
                                        if (res.code == 1)
                                        {
                                            clearInterval(t1);
                                            $("#status").html(res.msg);
                                            $("#account").html(res.nick);
                                            $("#src").attr("src", "/wwwroot/img/pay_ok.png");
                                        }
                                        else
                                        {
                                            $("#status").html(res.msg);
                                        }
                                    }, 'post');
                                }
                                //获取成功

                                if (obj.data.type == "wxpay")
                                {

                                    var url = "data:image/png;base64," + updata.qr_url;
                                    $("#src").attr("src", url);
                                    $("#account").html('请使用手机对着手机扫或电脑配合手机扫码，不可使用截图扫码');
                                    //获取后启动定时器
                                    t1 = setInterval(function () { LoginStatus(obj.data.id) }, 3000);
                                    return;
                                }
                                if (obj.data.type == "alipay") {
                                    var url =updata.qr;
                                    $("#src").attr("src", url);
                                    $("#account").html('请使用手机对着手机扫或电脑配合手机扫码，不可使用截图扫码');
                                    //获取后启动定时器
                                    t1 = setInterval(function () { LoginStatus(obj.data.id) }, 3000);
                                    return;
                                }
                                if (obj.data.type == "qqpay") {
                                    var url = "data:image/png;base64," + updata.qr;
                                    $("#src").attr("src", url);
                                    $("#account").html('请使用手机对着手机扫或电脑配合手机扫码，不可使用截图扫码');
                                    //获取后启动定时器
                                    t1 = setInterval(function () { LoginStatus(obj.data.id) }, 3000);
                                    return;
                                }


                            } else {
                                $("#src").attr("src", "/wwwroot/img/loading.gif");
                                $("#account").html(updata.msg);
                                notice.msg(updata.msg, { icon: 2 });
                            }
                        }, 'json');
                        //获取当前通道类型请求获取二维码
                        form.on('submit(dialogEditSubmit2)', function (data) {
                            layer.close(loadIndex);
                            notice.msg("更新成功", {
                                icon: 1, onOpened: function () {
                                    layer.closeAll('page');
                                    insTb.reload({ page: { curr: 1 } });
                                }
                            });
                            notice.msg("更新成功", { icon: 1 });
                            return false;
                        });
                    }
                });
                }




            }

            function del_land(obj) {
                layer.confirm('确定要删除吗？<span style="color:red">删除账号,账号相关的订单也会删除,可能造成您无法核对订单的情况</span>,已知晓请确认删除!', {
                    shade: .1,
                    skin: ''
                }, function (i) {
                    layer.close(i);
                    var loadIndex = layer.load();
                    admin.req('/Channel/DelChannel', {
                        id: obj.data.id
                    }, function (res) {
                        layer.close(loadIndex);
                        if (res.code == 1) {
                            notice.msg(res.msg, {
                                icon: 1, onOpened: function () {
                                    obj.del(); //删除
                                    layer.close(res);
                                }
                            });
                        } else {
                            notice.msg(res.msg, { icon: 2 });
                        }
                    }, 'post');

                });
            }

        });
    </script>
    
</body>
</html>
