<?php /*a:1:{s:49:"/www/wwwroot/fttqq.cn/view/admin/index/index.html";i:1670819232;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title> YPAY Admin - 专业的平台开发商! </title>
		<!-- 依 赖 样 式 -->
		<link rel="stylesheet" href="/static/component/pear/css/pear.css" />
		<!-- 加 载 样 式-->
		<link rel="stylesheet" href="/static/admin/css/loader.css" />
		<!-- 布 局 样 式 -->
		<link rel="stylesheet" href="/static/admin/css/admin.css" />
        <script>
            if(window!=top){ top.location.href = location.href; }
        </script>
                                
	</head>
	<!-- 结 构 代 码 -->
	<body class="layui-layout-body pear-admin">
		<!-- 布 局 框 架 -->
		<div class="layui-layout layui-layout-admin">
			<div class="layui-header">
				<!-- 顶 部 左 侧 功 能 -->
				<ul class="layui-nav layui-layout-left">
					<li class="collaspe layui-nav-item"><a href="#" class="layui-icon layui-icon-shrink-right"></a></li>
					<li class="refresh layui-nav-item"><a href="#" class="layui-icon layui-icon-refresh-1" loading=600></a></li>
				</ul>
				<!-- 顶 部 右 侧 菜 单 -->
				<div id="control" class="layui-layout-control"></div>
				<ul class="layui-nav layui-layout-right" lay-filter="layui_nav_right">
					<li class="layui-nav-item layui-hide-xs"><a href="#" class="fullScreen layui-icon layui-icon-screen-full"></a></li>
					<li class="layui-nav-item layui-hide-xs"><a href="/" target="_blank">网站前台</a></li>
					<li class="layui-nav-item layui-hide-xs"><a href="javascript:void(0);" class="update" >检查更新</a></li>
                    <li class="layui-nav-item user">
						<!-- 头 像 -->
						<a href="javascript:;">
							<img src="/static/admin/images/avatar.jpg" class="layui-nav-img">
							<?php echo htmlentities($nickname); ?>
						</a>
						<!-- 功 能 菜 单 -->
                        <dl class="layui-nav-child">
                            <dd>
                                <a href="javascript:void(0);" class="password">
                                    修改密码
                                </a>
                            </dd>
                            <dd>
                                <a href="javascript:void(0);" class="cache">
                                    清理缓存
                                </a>
                            </dd>
                            <dd>
                                <a href="javascript:void(0);" class="logout">
                                    退出登录
                                </a>
                            </dd>
                        </dl>
					</li>
					<!-- 主 题 配 置 -->
					<li class="layui-nav-item setting"><a href="#" class="layui-icon layui-icon-more-vertical"></a></li>
				</ul>
			</div>
			<!-- 侧 边 区 域 -->
			<div class="layui-side layui-bg-black">
				<!-- 顶 部 图 标 -->
				<div class="layui-logo">
					<!-- 图 表 -->
					<!--<img class="logo"></img>-->
					<!-- 标 题 -->
					<span class="title"></span>
				</div>
				<!-- 侧 边 菜 单 -->
				<div class="layui-side-scroll">
					<div id="sideMenu"></div>
				</div>
			</div>
			<!-- 视 图 页 面 -->
			<div class="layui-body">
				<!-- 内 容 页 面 -->
				<div id="content"></div>
			</div>
		</div>
		<!-- 遮 盖 层 -->
		<div class="pear-cover"></div>
		<!-- 移 动 端 便 捷 操 作 -->
		<div class="pear-collasped-pe collaspe"><a href="#" class="layui-icon layui-icon-shrink-right"></a></div>
		<!-- 加 载 动 画-->
		<div class="loader-main">
			<div class="loader"></div>
		</div>
		<!-- 依 赖 脚 本 -->
		<script src="/static/component/layui/layui.js"></script>
		<script src="/static/component/pear/pear.js"></script>
		<!-- 框 架 初 始 化 -->
		<script>
        layui.use(['admin', 'jquery', 'layer','element','form'], function() {
            var $ = layui.jquery;
            var layer = layui.layer;
            var layelem = layui.element;
            var admin = layui.admin;
            let form = layui.form;
            
   
            // 框 架 初 始 化
            admin.render({
                "logo": {
                    "title": "YPAY Admin",
                   
                },
                "menu": {
                    "data": "<?php echo htmlentities(app('request')->root()); ?>/index/menu",
                    "accordion": true,
                    "control": false,
                    "select": "0"
                },
                "tab": {
                    "muiltTab": true,
                    "keepState": true,
                    "session": true,
                    "tabMax": 30,
                    "index": {
                        "id": "0",
                        "href": "<?php echo htmlentities(app('request')->root()); ?>/index/home",
                        "title": "首页"
                    }
                },
                "theme": {
                    "defaultColor": "2",
                    "defaultMenu": "dark-theme",
                    "defaultHeader": "light-theme",
                    "allowCustom": true,
                    "banner":false
                },
                "colors": [{
                        "id": "1",
                        "color": "#2d8cf0",
                        "second":"#ecf5ff"
                    },
                    {
                        "id": "2",
                        "color": "#36b368",
                        "second":"#f0f9eb"
                    },
                    {
                        "id": "3",
                        "color": "#f6ad55",
                        "second":"#fdf6ec"
                    }, {
                        "id": "4",
                        "color": "#f56c6c",
                        "second":"#fef0f0"
                    }, {
                        "id": "5",
                        "color": "#3963bc",
                        "second":"#ecf5ff"
                    }
                ],
                "other": {
                    "keepLoad": 100
                },
                "header":{
                    message: false
                }
            });
            
   
            layelem.on('nav(layui_nav_right)', function(elem) {
                if ($(elem).hasClass('logout')) {
                    layer.confirm('确定退出登录吗?', function(index) {
                        layer.close(index);
                        $.ajax({
                            url: '<?php echo htmlentities(app('request')->root()); ?>/login/logout',
                            type:"POST",
                            dataType:"json",
                            success: function(res) {
                                if (res.code==200) {
                                    layer.msg(res.msg, {
                                        icon: 1
                                    });
                                    setTimeout(function() {
                                        location.href = '<?php echo htmlentities(app('request')->root()); ?>/login/index';
                                    }, 333)
                                }
                            }
                        });
                    });
                }else if ($(elem).hasClass('password')) {
                    layer.open({
                        type: 2,
                        maxmin: true,
                        title: '修改密码',
                        shade: 0.1,
                        area: ['300px', '300px'],
                        content:'<?php echo htmlentities(app('request')->root()); ?>/index/pass'
                    });
                }else if ($(elem).hasClass('cache')) {
                    $.post('<?php echo htmlentities(app('request')->root()); ?>/index/cache',
                    function(data){
                        layer.msg(data.msg, {time: 1500});
                        location.reload()
                    });

                }else if ($(elem).hasClass('update')) 
                {
                    $.post('<?php echo htmlentities(app('request')->root()); ?>/Update/checkver',
                    function(data){
                        
                        if(data.code==0)
                        {
                            layer.alert(data.msg);
                            return false;
                        }
                        
                        if(data.code==100)
                        {
                            layer.open({
                              type: 1,
                              title: 'YPAY系统在线更新',
                            //   area: '560px',
                              shadeClose: true,
                              skin: 'layui-col-md4',
                              closeBtn: 1,
                              content: '<div class="setchmod bt-form">\
                                    <div class="update_title"><i class="layui-layer-ico layui-layer-ico1" style="position: absolute;top: 16px;left: 15px;_left: -40px;width: 30px;height: 30px;"></i><span>恭喜您，当前已经是最新版本</span></div>\
                                    <div class="update_version">当前版本：<a href="javascript:void(0);" target="_blank" class="btlink" title="查看当前版本日志">'+data.vername + '</div>\
                                    <div class="update_conter">\
                                        <div class="update_tips">'+ '最新版本&nbsp;：'+ data.vername + '&nbsp;&nbsp;&nbsp;更新时间&nbsp;&nbsp;：' +data.vertime + '&nbsp;&nbsp;&nbsp;\
                                        '+  '\
                                        '+ '\
                                        </div>\
                                    </div>\
                                    </div>\
                                <style>\
                                    .setchmod{padding-bottom:50px;}\
                                    .update_title{overflow: hidden;position: relative;vertical-align: middle;margin-top: 10px;}\
                                    .update_title .layui-layer-ico{display: block;left: 60px !important;top: 1px !important;}\
                                    .update_title span{display: inline-block;color: #333;height: 30px;margin-left: 105px;margin-top: 3px;font-size: 20px;}\
                                    .update_conter{background: #f9f9f9;border-radius: 4px;padding: 20px;margin: 15px 37px;margin-top: 15px;}\
                                    .update_version{font-size: 12px;margin:15px 0 10px 100px}\
                                    .update_logs{margin-bottom:10px;border-bottom:1px solid #ececec;padding-bottom:10px;}\
                                    .update_tips{font-size: 13px;color: #666;font-weight: 600;}\
                                    .update_tips span{padding-top: 5px;display: block;font-weight: 500;}\
                                </style>'
                            });
                            return;
                        }
                        else{
                            
                            var time = data.vertime;
                            var version = data.version;
                            var updateMsg= data.updateMsg;
                             layer.open({
                              type: 1,
                              title: 'YPAY系统在线更新',
                            //   area: '560px',
                              shadeClose: true,
                              skin: 'layui-col-md4',
                              closeBtn: 1,
                              content: '<div class="setchmod bt-form" style="padding-bottom:50px;">\
                                        <div class="update_title"><i class="layui-layer-ico layui-layer-ico0" style="position: absolute;top: 16px;left: 15px;_left: -40px;width: 30px;height: 30px;"></i><span>有新的系统版本更新，是否更新？</span></div>\
                                        <div class="update_conter" style="max-height: 400px;overflow: auto;">\
                                            <div class="update_version">最新版本：<a href="/" target="_blank" class="btlink" title="查看版本更新日志">YPAY '+ version + '</a>&nbsp;&nbsp;更新日期：' + time + '</div>\
                                            <div class="update_logs">'+ updateMsg + '</div>\
                                        </div>\
                                         <div class="bottom">\
                                            <div class="button-container">\
                                            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="layer.closeAll()">'+ "取消更新" + '</button>\
                                            <button type="button" class="layui-btn layui-btn-normal layui-btn-sm" lay-submit="" lay-filter="to_update" >'+ "立即更新"+ '</button>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <style>\
                                        .update_title{overflow: hidden;position: relative;vertical-align: middle;margin-top: 10px;}.update_title .layui-layer-ico{display: block;left: 60px !important;top: 1px !important;}.update_title span{display: inline-block;color: #333;height: 30px;margin-left: 105px;margin-top: 3px;font-size: 20px;}.update_conter{background: #f9f9f9;border-radius: 4px;padding: 20px;margin: 15px 37px;margin-top: 15px;}.update_version{font-size: 13.5px; margin-bottom: 10px;font-weight: 600;}.update_logs{margin-bottom:10px;}.update_tips{font-size: 13px;color:#666;}.update_conter span{display: block;font-size:13px;color:#666}\
                                    </style>'
                            });
                        return;
                        }
                        
                        
                    });
                    
                }

            });
            
            form.on('submit(to_update)', function(){
                layer.closeAll();
                //layer.alert('cs');
                $.post('<?php echo htmlentities(app('request')->root()); ?>/update/update_ver',
                function(data)
                {
                    layer.alert(data.msg);
                    return false;
                });
                    
            });
            
        })
		</script>
	</body>
</html>
