<?php /*a:2:{s:55:"/www/wwwroot/1pay.q520.tk/view/admin/ypay/user/add.html";i:1669981346;s:55:"/www/wwwroot/1pay.q520.tk/view/admin/common/common.html";i:1670898482;}*/ ?>
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
<body>
<form class="layui-form" action="">
    <div class="mainBox">
        <div class="main-container">
            <div class="layui-form-item">
                    <label class="layui-form-label">
                        会员账号
                    </label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input layui-form-danger" name="username" type="text" placeholder="必须填写" value="<?php echo isset($model['username']) ? htmlentities($model['username']) : ""; ?>"/>
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">
                        会员密码
                    </label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input layui-form-danger" name="password" type="text" placeholder="必须填写" value="<?php echo isset($model['password']) ? htmlentities($model['password']) : ""; ?>"/>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">
                        套餐类型
                    </label>
                    <div class="layui-input-block">
                         <select name="vip_id">
                             <option value="0">关闭</option> 
                        <?php foreach ($vip as $value): ?>
                               <option value="<?php echo htmlentities($value['id']); ?>">
                                   <?php echo htmlentities($value['name']); ?>
                               </option> 
                            
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">
                        邮箱
                    </label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input layui-form-danger" name="email" type="text" placeholder="可不填写" value="<?php echo isset($model['email']) ? htmlentities($model['email']) : ""; ?>"/>
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">
                        手机号
                    </label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input layui-form-danger" name="mobile" type="text" placeholder="可不填写" value="<?php echo isset($model['mobile']) ? htmlentities($model['mobile']) : ""; ?>"/>
                    </div>
                </div>
        </div>
    </div>
    <div class="bottom">
        <div class="button-container">
            <button type="submit" class="layui-btn layui-btn-normal layui-btn-sm" lay-submit="" lay-filter="save">
               
                提交
            </button>
            <button type="reset" class="layui-btn layui-btn-primary layui-btn-sm">
               
                重置
            </button>
        </div>
    </div>
</form>
<script>
    layui.use(['form', 'jquery', 'layedit', 'uploads','laydate'], function () {
        let form = layui.form;
        let $ = layui.jquery;
        let laydate = layui.laydate;
        let layedit = layui.layedit
        layedit.set({
            uploadImage: {
                url: "<?php echo htmlentities(app('request')->root()); ?>/index/upload"
            }
        });
        laydate.render({elem: "#vip_time", type:'datetime'});
        //建立编辑器
        
        form.on('submit(save)', function (data) {
            
            $.ajax({
                data: JSON.stringify(data.field),
                dataType: 'json',
                contentType: 'application/json',
                type: 'post',
                success: function (res) {
                    //判断有没有权限
                    if (res && res.code == 999) {
                        layer.msg(res.msg, {
                            icon: 5,
                            time: 2000,
                        })
                        return false;
                    } else if (res.code == 200) {
                        layer.msg(res.msg,{icon:1,time:1000}, function () {
                            parent.layer.close(parent.layer.getFrameIndex(window.name));//关闭当前页
                            parent.layui.table.reload("dataTable");
                        });
                    } else {
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