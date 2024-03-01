layui.define(['table'], function (exports) {
	var table = layui.table
		, layer = layui.layer
		, options = {
			parseData: function (res) {

				var code = 404, data = [], total = 0, message = "<span style='font-size:16px;'><i class=\"layui-icon layui-icon-face-smile-fine\" style=\"font-size:16px;\"></i>暂无相关数据</span>";
				if (res != undefined && res.result != undefined && res.result.data != undefined) {
					if (res.result.data.length > 0) {
						code = res.code;
						total = res.result.total;
						data = res.result.data;
					}
				}
				return {
					"code": code,
					"msg": message,
					"count": total,
					"data": data
				};

			}
			, done: function (r) {

			}
			, loading: true
			, text: {
				none: '暂无相关数据'
			}
		}
	table.set(options); //设定全局默认参数。options即各项基础参数
	//baseTable模块名
	exports('baseTable', {});
});