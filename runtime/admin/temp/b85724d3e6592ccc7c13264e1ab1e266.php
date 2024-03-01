<?php /*a:2:{s:56:"/www/wwwroot/hm.otbax.cn/view/admin/ypay/user/index.html";i:1670040080;s:54:"/www/wwwroot/hm.otbax.cn/view/admin/common/common.html";i:1670898482;}*/ ?>
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
                   <label class="layui-form-label">用户ID</label>
                   <div class="layui-input-inline">
                       <input type="text" name="id" placeholder="" class="layui-input">
                   </div>
               </div>
               <div class="layui-form-item layui-inline">
                   <label class="layui-form-label">会员账户</label>
                   <div class="layui-input-inline">
                       <input type="text" name="username" placeholder="" class="layui-input">
                   </div>
               </div> 
               <div class="layui-form-item layui-inline">
                   <label class="layui-form-label">邮箱</label>
                   <div class="layui-input-inline">
                       <input type="text" name="email" placeholder="" class="layui-input">
                   </div>
               </div>   
               <div class="layui-form-item layui-inline">
                   <label class="layui-form-label">手机号</label>
                   <div class="layui-input-inline">
                       <input type="text" name="mobile" placeholder="" class="layui-input">
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
			<button class="pear-btn pear-btn-primary pear-btn-md" lay-event="add">
		        <i class="layui-icon layui-icon-add-1"></i>
		        新增
			</button>
			<button class="pear-btn pear-btn-danger pear-btn-md" lay-event="batchRemove">
		        <i class="layui-icon layui-icon-delete"></i>
		        删除
		    </button>
		</script>
               
               <script type="text/html" id="is_frozen">
                   <input type="checkbox" name="is_frozen" value="{{d.id}}" lay-skin="switch" lay-text="解冻|冻结" lay-filter="is_frozen" {{# if(d.is_frozen==1){ }} checked {{# } }}>
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
            let MODULE_PATH = "<?php echo htmlentities(app('request')->root()); ?>/ypay.user/";
            
            let cols = [
                [{
                        type: 'checkbox'
                    },{
                       field: "id",
                       title: "用户ID",
                       unresize: "true",
                       align: "center"
                   },  {
                       field: "username",
                       title: "会员账号",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "email",
                       title: "邮箱",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "mobile",
                       title: "手机号",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "money",
                       title: "余额",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "create_time",
                       title: "注册时间",
                       unresize: "true",
                       minWidth: 200,
                       align: "center"
                   }, {
                       field: "vip_time",
                       title: "套餐时间",
                       unresize: "true",
                       minWidth: 200,
                       align: "center"
                   }, {
                       field: "feilv",
                       title: "费率",
                       unresize: "true",
                       align: "center"
                   }, {
                       field: "total_money",
                       title: "总流水",
                       unresize: "true",
                       align: "center"
                   },
                   {
                       field: "yesterday_money",
                       title: "昨日总流水",
                       unresize: "true",
                       align: "center"
                   },
                   {
                       field: "today_money",
                       title: "今日总流水",
                       unresize: "true",
                       align: "center"
                   },{
                       field: "is_frozen",
                       title: "是否冻结",
                       unresize: "false",
                       align: "center",
                       templet:"#is_frozen"
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
                   var status = data.elem.checked?1:0;
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
               form.on("switch(is_bandqq)", function(data) {
                   var status = data.elem.checked?1:0;
                   var id = this.value;
                   var load = layer.load();
                   $.post(MODULE_PATH + "bindqqstatus",{is_bandqq:status,id:id},function (res) {
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
               form.on("switch(is_bandwx)", function(data) {
                   var status = data.elem.checked?1:0;
                   var id = this.value;
                   var load = layer.load();
                   $.post(MODULE_PATH + "bindwxstatus",{is_bandwx:status,id:id},function (res) {
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
               form.on("switch(is_frozen)", function(data) {
                   var status = data.elem.checked?1:0;
                   var id = this.value;
                   var load = layer.load();
                   $.post(MODULE_PATH + "frozenstatus",{is_frozen:status,id:id},function (res) {
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
                    title: '新增会员列表',
                    shade: 0.1,
                    area: screen(),
                    content: MODULE_PATH + 'add'
                });
            }

            window.edit = function(obj) {
                layer.open({
                    type: 2,
                    maxmin: true,
                    title: '修改会员列表',
                    shade: 0.1,
                    area: screen(),
                    content: MODULE_PATH + 'edit/id/'+obj.data['id']
                });
            }


            window.remove = function(obj) {
                layer.confirm('确定要删除该会员列表', {
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
                layer.confirm('确定要删除这些会员列表', {
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
