<?php /*a:2:{s:54:"/www/wwwroot/hm.otbax.cn/view/admin/ypay/vip/edit.html";i:1669981358;s:54:"/www/wwwroot/hm.otbax.cn/view/admin/common/common.html";i:1670898482;}*/ ?>
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
                        套餐名称
                    </label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input layui-form-danger" name="name" type="text" value="<?php echo isset($model['name']) ? htmlentities($model['name']) : ""; ?>"/>
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">
                        套餐费率
                    </label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input layui-form-danger" name="feilv" type="text" value="<?php echo isset($model['feilv']) ? htmlentities($model['feilv']) : ""; ?>"/>
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">
                        套餐金额
                    </label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input layui-form-danger" name="money" type="text" value="<?php echo isset($model['money']) ? htmlentities($model['money']) : ""; ?>"/>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">
                        套餐时间
                    </label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input layui-form-danger" name="viptime" type="text" value="<?php echo isset($model['viptime']) ? htmlentities($model['viptime']) : ""; ?>"/>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">
                        当前排序
                    </label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input layui-form-danger" name="sort" type="text" placeholder="数值越大排序越靠前" value="<?php echo isset($model['sort']) ? htmlentities($model['sort']) : ""; ?>"/>
                    </div>
                </div>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>额外功能</legend>
                </fieldset>
            <!--    <div class="layui-form-item">-->
            <!--<label class="layui-form-label">补价升级</label>-->
            <!--<div class="layui-input-block">-->
            <!--  <input type="checkbox" name="is_premium" lay-skin="switch" lay-text="开|关" <?php if($model['is_premium'] == 1): ?> checked="" <?php endif; ?> lay-filter="premium">-->
            <!--</div>-->
            <!--  </div>-->
            <!--  <div id="premium" <?php if($model['is_premium'] != 1): ?> style="display:none;" <?php endif; ?>> -->
            <!--        <div class="layui-form-item">-->
            <!--        <label class="layui-form-label">-->
            <!--            升级优惠-->
            <!--        </label>-->
            <!--        <div class="layui-input-block">-->
            <!--            <input type="text" class="layui-input layui-form-danger" placeholder="范围设置项:0-100,为百分比" value="<?php echo isset($model['premium_discount']) ? htmlentities($model['premium_discount']) : ""; ?>" name="premium_discount" type="text" />-->
            <!--        </div>-->
            <!--    </div>-->
            <!--  </div>-->
              <div class="layui-form-item">
            <label class="layui-form-label">收款限额</label>
            <div class="layui-input-block">
              <input type="checkbox" name="is_quota" lay-skin="switch" lay-text="开|关" <?php if($model['is_quota'] == 1): ?> checked <?php endif; ?> lay-filter="quota">
            </div>
              </div>
              <div id="quota" <?php if($model['is_quota'] != 1): ?> style="display:none;"<?php endif; ?> > 
                    <div class="layui-form-item">
                    <label class="layui-form-label">
                        日收款限额
                    </label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input layui-form-danger" placeholder="" name="today_quota" type="text" value="<?php echo isset($model['today_quota']) ? htmlentities($model['today_quota']) : ""; ?>"/>
                    </div>
                </div>
              </div>
              <div class="layui-form-item">
            <label class="layui-form-label">通道绑定</label>
            <div class="layui-input-block">
              <input type="checkbox" name="is_passage" lay-skin="switch" lay-text="开|关" <?php if($model['is_passage'] == 1): ?> checked <?php endif; ?> lay-filter="passage">
            </div>
              </div>
              <div id="passage" <?php if($model['is_passage'] != 1): ?> style="display:none;"<?php endif; ?> > 
                    <div class="layui-form-item">
                    <label class="layui-form-label">
                        选择绑定通道
                    </label>
                    
                    <div class="layui-input-block">
                        <div id="channel"></div>
                    </div>
                </div>
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
    layui.use(['form', 'jquery', 'layedit', 'uploads','xmSelect'], function () {
        let form = layui.form;
        let $ = layui.jquery;
        let layedit = layui.layedit;
        let xmSelect = layui.xmSelect;
        layedit.set({
            uploadImage: {
                url: "<?php echo htmlentities(app('request')->root()); ?>/index/upload"
            }
        });
        
        var channel = xmSelect.render({
	        el: '#channel', 
	        autoRow: true,
	        filterable: true,
	        tree: {
		show: true,
		showFolderIcon: true,
		showLine: true,
		indent: 20,
	},
	        toolbar: {
		show: true,
		list: ['ALL', 'REVERSE', 'CLEAR']
	},
	        filterable: true,
	        height: 'auto',
	        data: function(){
		return [
		    {name: 'QQ', value: 'qqpay', children: [
				{name: 'QQ免挂-本地版', value: 'qqpay_mg'},
				{name: 'QQ免挂-软件版', value: 'qqpay_cloud'},
			]},
			{name: '微信', value: 'wechat', children: [
				{name: 'IMac免输入', value: 'wxpay_cloud'},
				{name: '微信赞赏码', value: 'wxpay_cloudzs'},
				{name: '微信店员版', value: 'wxpay_dy'},
				{name: '微信收款单', value: 'wxpay_skd'},
				{name: '微信APP挂机', value: 'wxpay_app'},
				{name: '微信个人自挂', value: 'wxpay_zg'},
			]},
			{name: '支付宝', value: 'alipay', children: [
				{name: '支付宝个人版', value: 'alipay_grmg'},
				{name: '支付宝商家版', value: 'alipay_mg'},
				{name: '支付宝软件版', value: 'alipay_pc'},
				{name: '支付宝通用版', value: 'alipay_allmg'},
				{name: '支付宝当面付', value: 'alipay_dmf'},
				{name: '支付宝APP挂机', value: 'alipay_app'},
			]},
		]
	}
        })
        
        channel.setValue([<?php echo htmlentities($model['passages']); ?>]);
        
        form.on("switch(premium)", function(data) {
                var premium = data.elem.checked?1:0;
                if(premium == 1){
                    $('#premium').show();
                }else{
                     $('#premium').hide();
                }
               });
        
        
        form.on("switch(quota)", function(data) {
                var quota = data.elem.checked?1:0;
                if(quota == 1){
                    $('#quota').show();
                }else{
                     $('#quota').hide();
                }
               });
         form.on("switch(passage)", function(data) {
                var quota = data.elem.checked?1:0;
                if(quota == 1){
                    $('#passage').show();
                }else{
                     $('#passage').hide();
                }
               });
        
        //建立编辑器
        
        form.on('submit(save)', function (data) {
            // data.field.is_premium = data.field.is_premium.checked?0:1;
            if(data.field.is_passage == null || data.field.is_passage == ''){
                data.field.is_passage = 0;
            }else{
                data.field.is_passage = 1;
            }
            if(data.field.is_quota == null || data.field.is_quota == ''){
                data.field.is_quota = 0;
            }else{
                data.field.is_quota = 1;
            }
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