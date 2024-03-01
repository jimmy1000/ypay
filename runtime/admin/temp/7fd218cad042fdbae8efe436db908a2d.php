<?php /*a:2:{s:45:"/mnt/projects/payyz/view/admin/crud/crud.html";i:1669980856;s:49:"/mnt/projects/payyz/view/admin/common/common.html";i:1670898484;}*/ ?>
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
    <style>
        td,.layui-table th{
           text-align: center;
        }
        td{
           min-width: 80px;
           max-width: 150px;
        }
    </style>
<body>
    <form class="layui-form" action="">
        <div class="mainBox">
            <div class="main-container">
                <div class="layui-form-item">
                    <div class="layui-form-item layui-inline">
                        <label class="layui-form-label">中文名称</label>
                        <div class="layui-input-inline">
                            <input autocomplete="off" class="layui-input" name="ename" lay-verify="required" value="<?php echo isset($desc) ? htmlentities($desc) : ''; ?>" type="text"/>
                        </div>
                    </div>
                    <div class="layui-form-item layui-inline">
                        <label class="layui-form-label">生成菜单</label>
                        <div class="layui-input-inline">
                            <select name="menu" lay-verify="requried">
                                <option value="">不生成</option>
                                <option value="0">顶级菜单</option>
                                <?php foreach($permissions as $k1=>$p1): ?>
                                    <option value="<?php echo htmlentities($p1['id']); ?>"><?php echo htmlentities($p1['title']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-form">
                <table cellspacing="0" cellpadding="0" border="0" class="layui-table">
                    <thead>
                        <tr>
                            <th>
                                <span>字段</span>
                            </th>
                            <th>
                                <span>类型</span>
                            </th>
                            <th>
                                <span>注释</span>
                            </th>
                            <th>
                                <span>可空</span>
                            </th>
                            <th>
                                <span>列表</span>
                            </th>
                            <th>
                                <span>搜索</span>
                            </th>
                            <th>
                                <span>表单</span>
                            </th>
                            <th>
                                <span>表单类型</span>
                            </th>
                        </tr>
                        </thead>
                    <tbody>
                    <?php foreach($data as $k=>$v): ?>
                    <tr>
                        <input type="hidden" name="name[]" value="<?php echo htmlentities($v['name']); ?>">
                        <input type="hidden" name="type[]" value="<?php echo htmlentities($v['type']); ?>">
                        <input type="hidden" name="desc[]" value="<?php echo htmlentities($v['comment']); ?>">
                        <input type="hidden" name="null[]" value="<?php echo htmlentities($v['notnull']); ?>">
                        <td>
                            <?php echo htmlentities($v['name']); ?>
                        </td>
                        <td>
                            <?php echo htmlentities($v['type']); ?>
                        </td>
                        <td>
                            <?php echo htmlentities($v['comment']); ?>
                        </td>
                        <td>
                            <?php if($v['notnull']=="1"): ?>是<?php else: ?>否<?php endif; ?>
                        </td>
                        <td>
                            <input type="checkbox" name="list[]" title="列表" lay-skin="primary" <?php if($v['notnull']=="true"): ?>checked<?php endif; ?>>
                        </td>
                        <td>
                            <input type="checkbox" name="search[]" title="搜索" lay-skin="primary">
                        </td>
                        <td>
                            <input type="checkbox" name="form[]" title="表单" lay-skin="primary" <?php if($v['notnull']=="true" && $v['name']!="id"): ?>checked<?php endif; ?>>
                        </td>
                        <td>
                            <select name="formType[]">
                                <option value="1">文本</option>
                                <option value="2">编辑器</option>
                                <option value="3">图片</option>
                                <option value="4">开关(选列表展示)</option>
                                <option value="5">文本域</option>
                            </select>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div> 
        </div>
        <div class="bottom">
        <div class="button-container">
            <button type="submit" class="layui-btn layui-btn-normal layui-btn-sm" lay-submit="" lay-filter="save">
                <i class="layui-icon layui-icon-ok"></i>
                提交
            </button>
            <button type="reset" class="layui-btn layui-btn-primary layui-btn-sm">
                <i class="layui-icon layui-icon-refresh"></i>
                重置
            </button>
        </div>
    </div>
    </form>
<script>
layui.use(['form','jquery'],function(){
    let form = layui.form;
    let $ = layui.jquery;
    form.on('submit(save)', function(data){
        $.ajax({
            data:data.field,
            type:'post',
            success:function(res){
               //判断有没有权限
                if(res && res.code==999){
                    layer.msg(res.msg, {
                        icon: 5,
                        time: 2000, 
                    })
                    return false;
                }else if(res.code==200){
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        if(res.data) window.top.document.location.reload();
                        parent.layer.close(parent.layer.getFrameIndex(window.name));//关闭当前页
                    });
                }else{
                    layer.msg(res.msg,{icon:2,time:1000});
                }
            }
        })
        return false;
    });
})
</script>
</body>
</html>