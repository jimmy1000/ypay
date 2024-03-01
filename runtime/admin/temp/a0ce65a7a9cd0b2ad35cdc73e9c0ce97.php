<?php /*a:2:{s:75:"/www/wwwroot/pay.xn--tnq769am5klza737gu1l.cn/view/admin/ypay/user/edit.html";i:1669981348;s:74:"/www/wwwroot/pay.xn--tnq769am5klza737gu1l.cn/view/admin/common/common.html";i:1670898482;}*/ ?>
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
							<input type="text" class="layui-input layui-form-danger" disabled=""  type="text"
								value="<?php echo isset($model['username']) ? htmlentities($model['username']) : ""; ?>" />
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">
							余额
						</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input layui-form-danger" name="money" type="text"
								value="<?php echo isset($model['money']) ? htmlentities($model['money']) : ""; ?>" />
						</div>
					</div>
					<div class="layui-form-item">
                    <label class="layui-form-label">
                        套餐类型
                    </label>
                    <div class="layui-input-block">
                         <select name="vip_id" id="vip_id" lay-filter="vip_id" lay-verType="vip_id">
                             <option value="0" <?php if($model['vip_id'] == 0): ?> selected <?php endif; ?>>关闭</option> 
                        <?php foreach ($vip as $value): ?>
                               <option value="<?php echo htmlentities($value['id']); ?>" <?php if($model['vip_id'] == $value['id']): ?> selected <?php endif; ?>>
                                   <?php echo htmlentities($value['name']); ?>
                               </option> 
                            
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
				<div id="vip" <?php if($model['vip_id'] == 0): ?> style="display:none;" <?php endif; ?>>
				    <div class="layui-form-item">
						<label class="layui-form-label">
							套餐时间
						</label>
						<div class="layui-input-block">
							<input type="text" id="vip_time" class="layui-input layui-form-danger" name="vip_time" type="text"
								value="<?php echo isset($model['vip_time']) ? htmlentities($model['vip_time']) : ""; ?>" />
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">
							费率
						</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input layui-form-danger" name="feilv" type="text"
								value="<?php echo isset($model['feilv']) ? htmlentities($model['feilv']) : ""; ?>" />
						</div>
					</div>
				</div>
					<div class="layui-form-item">
						<label class="layui-form-label">
							会员密码
						</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input layui-form-danger" name="password" type="text"
								value="" />
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">
							邮箱
						</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input layui-form-danger" name="email" type="text"
								value="<?php echo isset($model['email']) ? htmlentities($model['email']) : ""; ?>" />
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">
							手机号
						</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input layui-form-danger" name="mobile" type="text"
								value="<?php echo isset($model['mobile']) ? htmlentities($model['mobile']) : ""; ?>" />
						</div>
					</div>
					
					<div class="layui-form-item">
						<label class="layui-form-label">
							备注
						</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input layui-form-danger" name="remarks" type="text"
								value="<?php echo isset($model['remarks']) ? htmlentities($model['remarks']) : ""; ?>" />
						</div>
					</div>
				</div>
			</div>
			<div class="bottom">
				<div class="button-container">
					<button type="submit" class="layui-btn layui-btn-normal layui-btn-sm" lay-submit=""
						lay-filter="save">
						提交
					</button>
					<button type="reset" class="layui-btn layui-btn-primary layui-btn-sm">
						重置
					</button>
				</div>
			</div>
		</form>
		<script>
			layui.use(['form', 'jquery', 'layedit', 'uploads','laydate'], function() {
				let form = layui.form;
				let $ = layui.jquery;
				let laydate = layui.laydate;
				let layedit = layui.layedit
				layedit.set({
					uploadImage: {
						url: "<?php echo htmlentities(app('request')->root()); ?>/index/upload"
					}
				});
				//建立编辑器
				laydate.render({elem: "#vip_time", type:'datetime'});
                
                
                
				form.on('submit(save)', function(data) {

					$.ajax({
						data: JSON.stringify(data.field),
						dataType: 'json',
						contentType: 'application/json',
						type: 'post',
						success: function(res) {
							//判断有没有权限
							if (res && res.code == 999) {
								layer.msg(res.msg, {
									icon: 5,
									time: 2000,
								})
								return false;
							} else if (res.code == 200) {
								layer.msg(res.msg, {
									icon: 1,
									time: 1000
								}, function() {
									parent.layer.close(parent.layer.getFrameIndex(window
										.name)); //关闭当前页
									parent.layui.table.reload("dataTable");
								});
							} else {
								layer.msg(res.msg, {
									icon: 2,
									time: 1000
								});
							}
						}
					})
					return false;
				});
				
				 form.on('select(vip_id)',function(data){
                    if(data.value != 0){
                        $('#vip').show();
                    }else{
                        $('#vip').hide();
                    }
                });
			})
		</script>
	</body>
</html>
