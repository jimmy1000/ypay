<?php /*a:2:{s:51:"/mnt/projects/payyz/view/admin/money/log/index.html";i:1670039960;s:49:"/mnt/projects/payyz/view/admin/common/common.html";i:1670898484;}*/ ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> YPAY Admin - 专业的平台开发商! </title>
    <link rel="stylesheet" href="/static/component/pear/css/pear.css" />
    <link rel="stylesheet" href="/static/admin/css/soulTable.css" />
    <script src="/static/component/layui/layui.js"></script>
    <script src="/static/component/pear/pear.js"></script>
</head>
	<body class="pear-container">
		<div class="layui-card">
			<div class="layui-card-body">
				<form class="layui-form" action="">
					<div class="layui-form-item">
                           
               <div class="layui-form-item layui-inline">
                   <label class="layui-form-label">会员ID</label>
                   <div class="layui-input-inline">
                       <input type="text" name="user_id" placeholder="" class="layui-input">
                   </div>
               </div>
               <div class="layui-form-item layui-inline">
                   <label class="layui-form-label">变更类型</label>
                   <div class="layui-input-inline">
                       <select name="memo">
                           <option value="">请选择一个变更类型</option>
                           <option value="下级充值返利">充值返利</option>
                           <option value="商户费率扣除">商户费率扣除</option>
                           <option value="商户在线充值">商户在线充值</option>
                           <option value="购买套餐扣款">购买套餐扣款</option>
                           <option value="下级购买会员套餐返利">购买会员返利</option>
                       </select>
                   </div>
               </div>
               <div class="layui-form-item layui-inline">
                   <label class="layui-form-label">创建时间</label>
                   <div class="layui-input-inline">
                       <input type="text" class="layui-input" id="create_time-start" name="create_time-start" placeholder="开始时间" autocomplete="off">
                   </div>
                   <div class="layui-input-inline">
                        <input type="text" class="layui-input" id="create_time-end" name="create_time-end" placeholder="结束时间" autocomplete="off">
                    </div>
               </div>
                        <div class="layui-form-item layui-inline">
                       <button class="pear-btn pear-btn-md pear-btn-primary" lay-submit lay-filter="query">
                           <i class="layui-icon layui-icon-search"></i>
                           查询
                       </button>
                       <button type="reset" class="pear-btn pear-btn-md">
                           <i class="layui-icon layui-icon-refresh"></i>
                           重置
                       </button>
                       </div>
                    </div>
				</form>
			</div>
		</div>
		<div class="layui-card">
			<div class="layui-card-body">
				<table id="dataTable" lay-filter="dataTable"></table>
			</div>
		</div>

		<script type="text/html" id="toolbar">

			<button class="pear-btn pear-btn-primary pear-btn-md" lay-event="batchRemove">
		        <i class="layui-icon layui-icon-delete"></i>
		        批量删除
		    </button>
            <button class="pear-btn pear-btn-danger pear-btn-md" lay-event="allRemove">
		        <i class="layui-icon layui-icon-delete"></i>
		        一键清理余额日志
		    </button>
		</script>

        

		<script type="text/html" id="options">
			
		    <button class="pear-btn pear-btn-danger pear-btn-sm" lay-event="remove"><i class="layui-icon layui-icon-delete"></i></button>
		</script>
        <script>
        layui.use(['table', 'form', 'jquery','common','laydate'], function() {
            let table = layui.table;
            let form = layui.form;
            let $ = layui.jquery;
            let common = layui.common;
            let laydate = layui.laydate;
            let MODULE_PATH = "<?php echo htmlentities(app('request')->root()); ?>/money.log/";
            laydate.render({elem: "#create_time-start"});laydate.render({elem: "#create_time-end"});
            let cols = [
                [{
                        type: 'checkbox'
                    },{
                       field: "id",
                       title: "ID",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "user_id",
                       title: "会员ID",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "money",
                       title: "变更金额",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "beforemoney",
                       title: "变更前金额",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "after",
                       title: "变更后金额",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "create_time",
                       title: "创建时间",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "memo",
                       title: "变更类型",
                       unresize: "true",
                       align: "center"
                   },{
                        title: '操作',
                        toolbar: '#options',
                        unresize: true,
                        align: 'center',
                        width:180,
                    }
                ]
            ]

            table.render({
                elem: '#dataTable',
                url: MODULE_PATH + 'index',
                page: true,
                cols: cols,
                cellMinWidth: 100,
                skin: 'line',
                toolbar: '#toolbar',
                defaultToolbar: [{
                    title: '刷新',
                    layEvent: 'refresh',
                    icon: 'layui-icon-refresh',
                }, 'filter', 'print', 'exports']
            });

            table.on('tool(dataTable)', function(obj) {
                if (obj.event === 'remove') {
                    window.remove(obj);
                } else if (obj.event === 'edit') {
                    window.edit(obj);
                }
            });

            table.on('toolbar(dataTable)', function(obj) {
                if (obj.event === 'add') {
                    window.add();
                } else if (obj.event === 'refresh') {
                    window.refresh();
                } else if (obj.event === 'batchRemove') {
                    window.batchRemove(obj);
                }else if (obj.event === 'allRemove') {
                    window.allRemove(obj); 
                }
            });

            form.on('submit(query)', function(data) {
                table.reload('dataTable', {
                    where: data.field,
                    page:{curr: 1}
                })
                laydate.render({elem: "#create_time-start"});laydate.render({elem: "#create_time-end"});
                return false;
            });
            
            //弹出窗设置 自己设置弹出百分比
            function screen() {
                if (typeof width !== 'number' || width === 0) {
                width = $(window).width() * 0.8;
                }
                if (typeof height !== 'number' || height === 0) {
                height = $(window).height() * 0.5;
                }
                return [width + 'px', height + 'px'];
            }

            window.remove = function(obj) {
                layer.confirm('确定要删除该余额日志', {
                    icon: 3,
                    title: '提示'
                }, function(index) {
                    layer.close(index);
                    let loading = layer.load();
                    $.ajax({
                        url:MODULE_PATH + 'remove',
                        data:{id:obj.data['id']},
                        dataType: 'json',
                        type: 'POST',
                        success: function(res) {
                            layer.close(loading);
                            //判断有没有权限
                            if(res && res.code==999){
                                layer.msg(res.msg, {
                                    icon: 5,
                                    time: 2000, 
                                })
                                return false;
                            }else if (res.code==200) {
                                layer.msg(res.msg, {
                                    icon: 1,
                                    time: 1000
                                }, function() {
                                    obj.del();
                                });
                            } else {
                                layer.msg(res.msg, {
                                    icon: 2,
                                    time: 1000
                                });
                            }
                        }
                    })
                });
            }

            window.batchRemove = function(obj) {
                let data = table.checkStatus(obj.config.id).data;
                if (data.length === 0) {
                    layer.msg("未选中数据", {
                        icon: 3,
                        time: 1000
                    });
                    return false;
                }
                var ids = []
                var hasCheck = table.checkStatus('dataTable')
                var hasCheckData = hasCheck.data
                if (hasCheckData.length > 0) {
                    $.each(hasCheckData, function (index, element) {
                        ids.push(element.id)
                    })
                }
                layer.confirm('确定要删除这些余额日志', {
                    icon: 3,
                    title: '提示'
                }, function(index) {
                    layer.close(index);
                    let loading = layer.load();
                    $.ajax({
                        url:MODULE_PATH + 'batchRemove',
                        data:{ids:ids},
                        dataType: 'json',
                        type: 'POST',
                        success: function(res) {
                            layer.close(loading);
                            //判断有没有权限
                            if(res && res.code==999){
                                layer.msg(res.msg, {
                                    icon: 5,
                                    time: 2000, 
                                })
                                return false;
                            }else if (res.code==200) {
                                layer.msg(res.msg, {
                                    icon: 1,
                                    time: 1000
                                }, function() {
                                    table.reload('dataTable');
                                });
                            } else {
                                layer.msg(res.msg, {
                                    icon: 2,
                                    time: 1000
                                });
                            }
                        }
                    })
                });
            }
            window.allRemove = function(obj) {
                layer.confirm('确定要清除所有余额日志嘛', {
                    icon: 3,
                    title: '提示'
                }, function(index) {
                    layer.close(index);
                    let loading = layer.load();
                    $.ajax({
                        url:MODULE_PATH + 'allRemove',
                        type: 'POST',
                        success: function(res) {
                            layer.close(loading);
                            //判断有没有权限
                            if(res && res.code==999){
                                layer.msg(res.msg, {
                                    icon: 5,
                                    time: 2000, 
                                })
                                return false;
                            }else if (res.code==200) {
                                layer.msg(res.msg, {
                                    icon: 1,
                                    time: 1000
                                }, function() {
                                    table.reload('dataTable');
                                });
                            } else {
                                layer.msg(res.msg, {
                                    icon: 2,
                                    time: 1000
                                });
                            }
                        }
                    })
                });
            }
            window.refresh = function(param) {
                table.reload('dataTable');
            }
        })
    </script>
	</body>
</html>
