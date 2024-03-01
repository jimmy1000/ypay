<?php /*a:2:{s:55:"/www/wwwroot/testpay.lao6sp.com/view/index/doc/api.html";i:1656857268;s:58:"/www/wwwroot/testpay.lao6sp.com/view/index/doc/header.html";i:1656962190;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<title>开发文档-<?php echo getConfig()['sitename']; ?></title>
		<meta charset="utf-8">
		<meta name="keywords" content="<?php echo getConfig()['key']; ?>">
		<meta name="description" content="<?php echo getConfig()['desc']; ?>">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
		<script defer="" src="https://res.easydoc.net/preview/static/main.22a17828.js"></script>
		<link rel="stylesheet" type="text/css" href="/static/index/css/doc.css" id="theme-opt"/>
	</head>
	<body>
		<div id="app" class=" middle" style="">
			<header id="header" style="">
				<div class="header-wrapper container desk">
					<div class="header-content">
						<div class="header-left">
							<div class="project-title text-hidden" title="<?php echo getConfig()['sitename']; ?>"><?php echo getConfig()['sitename']; ?></div>
						</div>
						<div class="header-mid">
							<nav class="nav-list-wrapper">
								<ul class="nav-list">
								    <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
									<li class="nav-list-item text-hidden" title="首页" data-children="0">
										<div class="nav-title-wrapper text-hidden">
											<a <?php if($vo['is_target'] == 1): ?> target="_bank" <?php endif; ?>   href="<?php echo htmlentities($vo['url']); ?>" class="nav-item-link text-hidden" title="<?php echo htmlentities($vo['name']); ?>"><?php echo htmlentities($vo['name']); ?></a>
										</div>
									</li>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
							</nav>
						</div>
					</div>
				</div>

				<div class="header-wrapper container mobile">
					<div class="menus-wrapper">
						<span class="menus-text">目录</span>
					</div>
					<h2 class="doc-title text-hidden">💵 页面跳转支付</h2>
				</div>
			</header>
			<div class="content-wrapper">
				<div class="container">
					<!-- 左右半部分白色背景 -->
					<div class="left-half-bg"></div>
					<div class="right-half-bg"></div>

					<div class="content" data-type="http">
						<aside class="content-left">
							<div class="content-left-main">
								<div class="project-title-wrapper">
									<h2 class="project-title">
										YPay
									</h2>

								</div>

								<div class="article-list-wrapper left-nav">
									<ul class="article-list">
										<li class="article-list-item" data-type="doc" data-id="AQiS0nrG"
											data-pid="" data-level="0" data-children="0" data-collection="">

											<!-- 文档 -->
											<a href="/doc" class="article-title text-hidden"
												title="💵 页面跳转支付" style="padding-left: 24px; padding-right: 10px;">
												<span class="article-icon"></span>
												💵 页面跳转支付
											</a>
											<!-- 集合 -->

										</li>
										<li class="article-list-item" data-type="doc" data-id="69txTliB" data-pid=""
											data-level="0" data-children="0" data-collection="">

											<!-- 文档 -->
											<a href="/doc/api" class="article-title text-hidden"
												title="💴 API接口支付" style="padding-left: 24px; padding-right: 10px;">
												<span class="article-icon"></span>
												💴 API接口支付
											</a>
											<!-- 集合 -->

										</li>
										<li class="article-list-item" data-type="doc" data-id="STMLK1Wg" data-pid=""
											data-level="0" data-children="0" data-collection="">

											<!-- 文档 -->
											<a href="/doc/result" class="article-title text-hidden"
												title="💶 支付结果通知" style="padding-left: 24px; padding-right: 10px;">
												<span class="article-icon"></span>
												💶 支付结果通知
											</a>
											<!-- 集合 -->

										</li>
									</ul>
								</div>
								<div class="bottom-wrapper">
									<div class="bottom-content">
										<a href="/console" target="_blank" class="bottom-link">本文档由<span
												style="font-weight: 700;margin: 0 5px;"><?php echo getConfig()['sitename']; ?></span>进行构建</a>
									</div>
								</div>
							</div>
							<!-- 抽屉弹窗部分 -->
							<div class="drawer-wrapper">
								<div class="drawer-content" style="transform: translateX(0)">
									<div class="drawer-header">
										<div class="header-left">更新日志</div>
									</div>

									<div class="drawer-slot">
										<!-- 更新日志 -->
										<div class="project-log-wrapper">
											<div class="project-log-content">
												<ul class="project-log-list"></ul>
											</div>
										</div>

										<!-- 其他 -->
									</div>
								</div>
							</div>
</aside>
                    <main class="content-mid">
                        <div class="doc-wrapper"><div class="doc-content http">

<div class="http-wrapper" data-active="0">
    <div class="http-nav-tab-wrapper">
        <div class="http-nav-tab-item active" data-tab="0">
            <div class="tab-item-text">文档</div>
        </div>
    </div>

    <article class="http-preview-container">
        <section class="section-wrapper">
            <div class="base-info">
                <div class="doc-title-wrapper">
                    <div class="doc-title-row">
                        <h1 class="section-title" style="margin-bottom: 0px;">
                            <span style="font-weight: normal!important;">💴</span> API接口支付
                        </h1>
                        <div class="last-change">
                            <a href="https://tools.fun/websocket.html" target="_blank" class="websocket-link">websocket测试</a>
                        </div>
                    </div>
                    <div class="api-row">
                        <div class="label-wrapper el-tag method-post method" style="margin-right: 5px; flex-wrap: unset;">
                            POST
                        </div>
                        <div class="label-wrapper api-path text-hidden" onclick="copyCode(this, true)" data-tips="http://登录后接口配置里的域名/pay/apisubmit">
                            <div class="text-hidden">http://登录后接口配置里的域名/pay/apisubmit</div>
                        </div>
    
    
                    </div>
                </div>
                <div class="doc-desc-wrapper">
                    <h3 class="section-title">
                        接口描述
                    </h3>
                    <p class="desc-text">
                        POST数据：pid={商户ID}&amp;type={支付方式}&amp;out_trade_no={商户订单号}&amp;notify_url={服务器异步通知地址}&amp;return_url={页面跳转通知地址}&amp;name={商品名称}&amp;money={金额}&amp;sitename={网站名称}&amp;sign={签名字符串}&amp;sign_type=MD5
                    </p>
                </div>
            </div>
        </section>

            <section class="section-wrapper params">
                <div style="display: flex; align-items: center; flex-wrap: wrap; color: #909399;margin-bottom: 18px;">
                    <h3 class="section-title" style="margin-bottom: 0; margin-right: 8px;;">请求参数</h3>
                    <span style="color: #bbb;"></span>
                </div>
                <div class="param-list-container">
                    <div class="param-list-head">
                            <h5 class="head-item text-hidden l4z7s1sr" title="字段名">字段名</h5>
                            <h5 class="head-item text-hidden name" title="参数名">参数名</h5>
                            <h5 class="head-item text-hidden required" title="必填">必填</h5>
                            <h5 class="head-item text-hidden type" title="类型">类型</h5>
                            <h5 class="head-item text-hidden l4z7sh7h" title="示例值">示例值</h5>
                            <h5 class="head-item text-hidden desc" title="描述">描述</h5>
                    </div>
                    <div class="param-list-wrapper">
<div class="param-list">
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z7s1sr">
                    <span class="td-span" onclick="copyCode(this, true)">商户ID</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper required-param" onclick="copyCode(this, true)">pid</span>
                </div>
                <div class="param-list-row-item required">
                        <span class="td-span">必填</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">Int</span>
                </div>
                <div class="param-list-row-item l4z7sh7h">
                    <span class="td-span" onclick="copyCode(this, true)">1000</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">商户ID</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z7s1sr">
                    <span class="td-span" onclick="copyCode(this, true)">支付方式</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper required-param" onclick="copyCode(this, true)">type</span>
                </div>
                <div class="param-list-row-item required">
                        <span class="td-span">必填</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z7sh7h">
                    <span class="td-span" onclick="copyCode(this, true)">alipay</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)"> 支付方式：alipay:支付宝,qqpay:QQ钱包,wxpay:微信支付</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z7s1sr">
                    <span class="td-span" onclick="copyCode(this, true)">商户订单号</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper required-param" onclick="copyCode(this, true)">out_trade_no</span>
                </div>
                <div class="param-list-row-item required">
                        <span class="td-span">必填</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z7sh7h">
                    <span class="td-span" onclick="copyCode(this, true)">20160806151343349</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">商户订单号</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z7s1sr">
                    <span class="td-span" onclick="copyCode(this, true)">异步通知地址</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper required-param" onclick="copyCode(this, true)">notify_url</span>
                </div>
                <div class="param-list-row-item required">
                        <span class="td-span">必填</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z7sh7h">
                    <span class="td-span" onclick="copyCode(this, true)">http://站点域名/notify_url.php</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">服务器异步通知地址</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z7s1sr">
                    <span class="td-span" onclick="copyCode(this, true)">跳转通知地址</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper required-param" onclick="copyCode(this, true)">return_url</span>
                </div>
                <div class="param-list-row-item required">
                        <span class="td-span">必填</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z7sh7h">
                    <span class="td-span" onclick="copyCode(this, true)">http://站点域名/return_url.php</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">页面跳转通知地址</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z7s1sr">
                    <span class="td-span" onclick="copyCode(this, true)">商品名称</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper required-param" onclick="copyCode(this, true)">name</span>
                </div>
                <div class="param-list-row-item required">
                        <span class="td-span">必填</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z7sh7h">
                    <span class="td-span" onclick="copyCode(this, true)">一个奥利奥</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">商品名称</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z7s1sr">
                    <span class="td-span" onclick="copyCode(this, true)">商品金额</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper required-param" onclick="copyCode(this, true)">money</span>
                </div>
                <div class="param-list-row-item required">
                        <span class="td-span">必填</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z7sh7h">
                    <span class="td-span" onclick="copyCode(this, true)">1.00</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">商品金额</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z7s1sr">
                    <span class="td-span" onclick="copyCode(this, true)">签名字符串</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper required-param" onclick="copyCode(this, true)">sign</span>
                </div>
                <div class="param-list-row-item required">
                        <span class="td-span">必填</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z7sh7h">
                    <span class="td-span" onclick="copyCode(this, true)">202cb962ac59075b964b07152d234b70</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)"> 签名字符串，签名算法与支付宝签名算法相同</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z7s1sr">
                    <span class="td-span" onclick="copyCode(this, true)">签名类型</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper required-param" onclick="copyCode(this, true)">sign_type</span>
                </div>
                <div class="param-list-row-item required">
                        <span class="td-span">必填</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z7sh7h">
                    <span class="td-span" onclick="copyCode(this, true)">MD5</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">默认为MD5</span>
                </div>
            </div>

        </div>
</div>                    </div>
                </div>
            </section>

            <section class="section-wrapper params">
                <div style="display: flex; align-items: center; flex-wrap: wrap; color: #909399;margin-bottom: 18px;">
                    <h3 class="section-title" style="margin-bottom: 0; margin-right: 8px;;">响应参数</h3>
                    <span style="color: #bbb;"></span>
                </div>
                <div class="param-list-container">
                    <div class="param-list-head">
                            <h5 class="head-item text-hidden l4z8z2nr" title="字段名">字段名</h5>
                            <h5 class="head-item text-hidden name" title="参数名">参数名</h5>
                            <h5 class="head-item text-hidden type" title="类型">类型</h5>
                            <h5 class="head-item text-hidden l4z8zifw" title="示例值">示例值</h5>
                            <h5 class="head-item text-hidden desc" title="描述">描述</h5>
                    </div>
                    <div class="param-list-wrapper">
<div class="param-list">
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z8z2nr">
                    <span class="td-span" onclick="copyCode(this, true)">返回状态码</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper" onclick="copyCode(this, true)">code</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">Int</span>
                </div>
                <div class="param-list-row-item l4z8zifw">
                    <span class="td-span" onclick="copyCode(this, true)">1</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">1为成功，其它值为失败</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z8z2nr">
                    <span class="td-span" onclick="copyCode(this, true)">返回信息</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper" onclick="copyCode(this, true)">msg</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z8zifw">
                    <span class="td-span" onclick="copyCode(this, true)">获取成功!</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">成功/失败时返回对应信息</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z8z2nr">
                    <span class="td-span" onclick="copyCode(this, true)">金额</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper" onclick="copyCode(this, true)">money</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z8zifw">
                    <span class="td-span" onclick="copyCode(this, true)">1.00</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">支付金额</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z8z2nr">
                    <span class="td-span" onclick="copyCode(this, true)">类型</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper" onclick="copyCode(this, true)">type</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z8zifw">
                    <span class="td-span" onclick="copyCode(this, true)">alipay</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)"> 支付方式：alipay:支付宝,qqpay:QQ钱包,wxpay:微信支付</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z8z2nr">
                    <span class="td-span" onclick="copyCode(this, true)">二维码链接</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper" onclick="copyCode(this, true)">qrcode</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z8zifw">
                    <span class="td-span" onclick="copyCode(this, true)">wxp://f2f15IaTGck0xvm7vug4lqx-sMpJ0xiUB8fWTDwCQk-jYBxS6Yl1A_fOdPGNNGKwPnOt</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">如果返回该字段，则根据该url生成二维码</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z8z2nr">
                    <span class="td-span" onclick="copyCode(this, true)">订单号</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper" onclick="copyCode(this, true)">trade_no</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z8zifw">
                    <span class="td-span" onclick="copyCode(this, true)">20160806151343349</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">支付订单号</span>
                </div>
            </div>

        </div>
        <div class="param-list-item" data-children="0" data-level="0">
            <div class="param-list-row">
                <div class="param-list-row-item l4z8z2nr">
                    <span class="td-span" onclick="copyCode(this, true)">商户订单号</span>
                </div>
                <div class="param-list-row-item name">
                        <span class="label-wrapper" onclick="copyCode(this, true)">out_trade_no</span>
                </div>
                <div class="param-list-row-item type">
                    <span class="td-span" onclick="copyCode(this, true)">String</span>
                </div>
                <div class="param-list-row-item l4z8zifw">
                    <span class="td-span" onclick="copyCode(this, true)">20160806151343349</span>
                </div>
                <div class="param-list-row-item desc">
                    <span class="td-span" onclick="copyCode(this, true)">商户订单号</span>
                </div>
            </div>

        </div>
</div>                    </div>
                </div>
            </section>
            <section class="section-wrapper markdown ">
                <h3 class="section-title">说明 / 示例</h3>
                <article class="markdown-body"><p>发起支付请求网站名称参数可以为空,其他为必填项<br>
签名算法与支付宝签名算法相同</p>
</article>
            </section>
    </article>
    
    <div class="http-test-container">
        <!-- insert vm -->
    </div>
</div>


</div>


</div>
                        <div class="back-top-wrapper" style="display: none;">
                            <div class="back-top-content">
                                <i class="fa fa-angle-double-up" aria-hidden="true"></i> 
                            </div>
                        </div>

                        <div class="bottom-nav-wrapper">
                            <div class="bottom-nav-row" style="display: flex;">
                                <div class="bottom-nav text-hidden">
                                    <a href="/doc" class="bottom-nav-link" data-id="AQiS0nrG">上一篇 💵 页面跳转支付</a>
                                </div>
                                <div class="bottom-nav text-hidden">
                                    <a href="/doc/result" class="bottom-nav-link" data-id="STMLK1Wg">下一篇 💶 支付结果通知</a>
                                </div>
                            </div>

                        </div>
                    </main>
                    <aside class="content-right" style="">
                        <div class="content-right-main">
                            <div class="content-right-nav">
                                <div class="right-nav-header">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    文章导航
                                </div>
                                <div class="right-nav-list-wrapper">
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>

        <!-- <div class="full-search-wrapper">
            <div class="full-search-content">
                <div class="full-search-input-wrapper">
                    <input type="text" class="full-search-input" placeholder="全文搜索">
                    <i class="fa fa-search" style="padding: 10px;" aria-hidden="true"></i>
                </div>

                <div class="search-result-list-wrapper"></div>
            </div>
        </div> -->

        <div class="full-search-wrapper" style="display: none;">
            <div class="full-search-input-wrapper">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input class="full-search-input" type="text" placeholder="全文搜索">
            </div>
            <div class="search-result-list-wrapper">
                <div class="no-search-result" style="display:flex; align-items:center; justify-content:center; color:#999; font-size:16px; height:100%">
                    请输入关键字进行搜索
                </div>
            </div>
        </div>
    </div>

    <script async="" src="https://www.googletagmanager.com/gtag/js?id=G-P12TJKHQ1S"></script>
    <script src="https://lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/axios/0.21.1/axios.min.js"></script>



    <script>
        var appVersion = window.navigator.appVersion;
        var isValid = 0;
        var msg = ''
        if (appVersion.indexOf("Trident") !== -1) {
            isValid = 1;
            console.log('this is IE')
            msg = '<h3>易文档不支持当前浏览器，建议您使用 谷歌/Edge 浏览器，如果您使用的是兼容模式，请切换到非兼容模式</h3>';
        }
        else if (appVersion.indexOf("MSIE") !== -1 || !!window.ActiveXObject || "ActiveXObject" in window) {
            console.log('this is ie')
            isValid = 1;
            msg = '<h3>易文档不支持当前浏览器，建议您使用 谷歌/Edge 浏览器，如果您使用的是兼容模式，请切换到非兼容模式</h3>';
        }
        else if (appVersion.indexOf("Chrome") !== -1) {
            const regex = /Chrome\/(\d+)/i;
            const found = appVersion.match(regex);
            if (found && found.length === 2 && parseInt(found[1]) < 60) {
                isValid = 2;
                msg = '<h1>您的浏览器版本有点低，为更好的体验，建议升级到最新版本</h1>';
            }
        }
        if (isValid > 0) {
            document.body.innerHTML = msg;
        }
    </script>

</body>
</html>