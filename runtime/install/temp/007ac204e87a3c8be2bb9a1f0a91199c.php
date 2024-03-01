<?php /*a:2:{s:54:"/www/wwwroot/hm.otbax.cn/view/install/index/index.html";i:1669883116;s:64:"/www/wwwroot/hm.otbax.cn/view/install/common/install_header.html";i:1669972494;}*/ ?>
 <!DOCTYPE html>
<html>
<head>
<title>YPay安装向导</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-status-bar-style" content="black"> 
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="/static/component/layui/css/layui.css">
<link rel="stylesheet" href="/static/css/install.css">
<script src="/static/component/layui/layui.js"></script>
</head>
<body>

<div class="layui-header">
	<div class="layui-container">
		<div class="title">安装向导</div>
	</div>
</div>
<div class="layui-content">
	<div class="layui-container">
		<div class="layui-row">
			<div class="layui-col-md12">
				<div class="layui-card layui-fixed">
					<div class="layui-card-header">
						<span>用户协议</span>
						<span class="layui-card-version"><?php echo env('YuanVer'); ?></span>
					</div>
					<div class="layui-card-body">
						<div class="layui-textarea" style="height:500px; overflow: auto;">
							<div style="width: 96%;line-height: 30px;">
								YPay 即：聚合免签系统（以下简称YPay）由源分享独立开发。<br>源分享依法拥有YPay的所有版权和所有权益，您可以在遵守该协议的前提下使用YPay系统。
								自您安装使用YPay开始，您和YPay之间的合同关系自动成立，成为YPay用户（以下简称为用户）。除非您停止使用或与YPay有签署额外合同，您须认真遵循该用户协议约定的每一项条款。<br>
								官方地址：<a target="_blank" href="https://www.yfx.top/">www.yfx.top</a><br>
								官方社群：<a target="_blank" href="//jq.qq.com/?_wv=1027&k=qg7Eq2C3">Y交流1群（973811194)</a>
								<p>一、协议中提到的名词约定</p>
								1.1	下述条款中所指YPay的标志包括如下方面：<br>
								YPay源代码及文档中关于YPay的版权提示、文字、图片和链接。<br>
								YPay运行时界面上呈现出来的有关YPay的文字、图片和链接。<br>
								1.2	不包括如下方面：<br>
								YPay提供的演示数据中关于YPay的文字、图片和链接。<br>
								<p>二、用户需遵守的约定</p>
                                2.1 以自用为目的，作为学习参考项，且不受任何限制。<br>
                                2.2 以自用为目的，在保留版权标识的前提下可任意修改程序源码。<br>
                                2.3 禁止以任何方式破坏YPay的赞助授权机制（包括但不限于收集YPay源码后经营与YPay同类型、同性质服务等）。<br>
                                2.4 用户禁止利用YPay进行违反国家法律、危害国家安全、社会稳定、公序良俗的事情，或任何不当的、侮辱诽谤的、淫秽的、暴力的及任何违反国家法律法规政策的内容。<br>
                                2.5 用户禁止利用YPay窃取他人专属信息、财产。<br>
                                2.6 用户赞助授权之后禁止售卖/倒卖/共享赞助授权密钥,发现后我们有权随时终止赞助授权,停止售后服务。<br>
								<p>三、免责声明</p>
								3.1	用户出于自愿而使用YPay，您必须了解使用本软件的风险，YPay不作任何类型的担保，不论是明示的、默示的，包括但不限于用户在任何情况下因使用或不能使用YPay所产生的直接、间接、偶然、特殊及后续的损害及风险，源分享不承担任何责任。<br>
								3.2	用户清楚互联网软件的特殊性，YPay与大多数互联网软件一样，受包括但不限于用户原因、网络服务质量、社会环境等因素的影响，可能受到各种安全问题的侵扰，如用户下载安装的其他软件或访问的其他网站中含有“木马”等病毒，威胁到用户的计算机信息和数据的安全，继而影响YPay的正常使用等，用户应加强信息安全及使用资料的保护，以免遭受损失。<br>
								3.3	协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止赞助授权，责令停止损害，并保留追究相关责任的权利。<br>
								3.4	用户因使用YPay违反国家法律法规的，源分享不承担任何责任。<br>
								<p>四、协议规定的约束和限制</p>
								<font color="red">4.1 YPay您可以自由使用和学习，切记禁止用于任何违规/违法用途，否则我们有权收集相关信息并向当地公安举报！<br></font>
								4.2	未经官方许可，禁止在YPay的整体或任何部分基础上发展任何派生版本、修改版本或第三方版本用于重新分发,<br>包括但不限于基于源分享开发SAAS平台等相关服务。<br>
								4.3	如果您未能遵守本协议的条款，您的赞助授权将被终止，所被许可的权利将被收回，并承担相应法律责任。<br>
								<p>五、未尽事项</p>
								如果上述条款无法满足您使用YPay的要求，可联系源分享签署额外的合同以获得更灵活的授权许可。<br>
								<p>六、合同约束</p>
								如果您违反了该协议的任一条款，该用户协议将自动终止，您必须停止使用，源分享保留通过法律手段追究责任的权利。<br>
							</div>							
						</div> 
						   <div class="layui-center">
						   	<button type="button" onclick="window.location.href='/install.php/Index/step1'" class="layui-btn layui-btn-normal">同意协议</button>
						   </div>
		    		</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<style>.layui-footer{    
		position: revert;
        padding: 0px;
    }</style>
<div class="layui-footer">copyright © 2023 源分享 all rights reserved.</div>
</body>
</html>