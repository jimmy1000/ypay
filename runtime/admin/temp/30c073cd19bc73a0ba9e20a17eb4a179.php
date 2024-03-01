<?php /*a:2:{s:57:"/www/wwwroot/1pay.q520.tk/view/admin/ypay/news/index.html";i:1670039988;s:55:"/www/wwwroot/1pay.q520.tk/view/admin/common/common.html";i:1670898482;}*/ ?>
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
				<table id="dataTable" lay-filter="dataTable"></table>
			</div>
		</div>

		<script type="text/html" id="toolbar">
			<button class="pear-btn pear-btn-primary pear-btn-md" lay-event="add">
		        <i class="layui-icon layui-icon-add-1"></i>
		        新增
			</button>
			<button class="pear-btn pear-btn-danger pear-btn-md" lay-event="batchRemove">
		        <i class="layui-icon layui-icon-delete"></i>
		        删除
		    </button>

		</script>

        
               <script type="text/html" id="status">
                   <input type="checkbox" name="status" value="{{d.id}}" lay-skin="switch" lay-text="启用|禁用" lay-filter="status" {{# if(d.status==1){ }} checked {{# } }}>
               </script>

		<script type="text/html" id="options">
			<button class="pear-btn pear-btn-primary pear-btn-sm" lay-event="edit"><i class="layui-icon layui-icon-edit"></i></button>
		    <button class="pear-btn pear-btn-danger pear-btn-sm" lay-event="remove"><i class="layui-icon layui-icon-delete"></i></button>
		</script>
        <script>
        layui.use(['table', 'form', 'jquery','common','laydate'], function() {
            let table = layui.table;
            let form = layui.form;
            let $ = layui.jquery;
            let common = layui.common;
            let laydate = layui.laydate;
            let MODULE_PATH = "<?php echo htmlentities(app('request')->root()); ?>/ypay.news/";
            
            let cols = [
                [{
                        type: 'checkbox'
                    },{
                       field: "id",
                       title: "ID",
                       unresize: "true",
                       align: "center"
                   }, {
                        field: 'type', title: '公告类型', width: 200, align: 'center', templet: function (d) {
                            if (d.type == 1) {
                                return "平台公告";
                            } 
                            else if (d.type == 2) 
                            {
                                return "行业动态";
                            }
                            else {
                               return "常见问题";
                            }
                        }
                    }, {
                       field: "title",
                       title: "公告标题",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "status",
                       title: "状态",
                       unresize: "true",
                       align: "center",
                       templet:"#status"
                   }, {
                       field: "create_time",
                       title: "创建时间",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "update_time",
                       title: "更新时间",
                       unresize: "true",
                       align: "center"
                   }, {
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
                }
            });

            form.on('submit(query)', function(data) {
                table.reload('dataTable', {
                    where: data.field,
                    page:{curr: 1}
                })
                
                return false;
            });
            
               form.on("switch(status)", function(data) {
                   var status = data.elem.checked?1:2;
                   var id = this.value;
                   var load = layer.load();
                   $.post(MODULE_PATH + "status",{status:status,id:id},function (res) {
                       layer.close(load);
                       //判断有没有权限
                       if(res && res.code==999){
                           layer.msg(res.msg, {
                               icon: 5,
                               time: 2000, 
                           })
                           return false;
                       }else if (res.code==200){
                           layer.msg(res.msg,{icon:1,time:1500})
                       } else {
                           layer.msg(res.msg,{icon:2,time:1500},function () {
                               $(data.elem).prop("checked",!$(data.elem).prop("checked"));
                               form.render()
                           })
                       }
                   })
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

            window.add = function() {
                layer.open({
                    type: 2,
                    maxmin: true,
                    title: '新增公告管理',
                    shade: 0.1,
                    area: screen(),
                    content: MODULE_PATH + 'add'
                });
            }

            window.edit = function(obj) {
                layer.open({
                    type: 2,
                    maxmin: true,
                    title: '修改公告管理',
                    shade: 0.1,
                    area: screen(),
                    content: MODULE_PATH + 'edit/id/'+obj.data['id']
                });
            }

            window.remove = function(obj) {
                layer.confirm('确定要删除该公告管理', {
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
                layer.confirm('确定要删除这些公告管理', {
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

            window.refresh = function(param) {
                table.reload('dataTable');
            }
        })
    </script>
	</body>
</html>
