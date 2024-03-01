<?php /*a:1:{s:52:"/www/wwwroot/hm.otbax.cn/view/index/index/index.html";i:1668347760;}*/ ?>

  <!DOCTYPE html>
  <html lang="zh-CN">
  <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title><?php echo getConfig()['sitename']; ?> - <?php echo getConfig()['title']; ?></title>
    <meta name="keywords" content="<?php echo getConfig()['key']; ?>">
    <meta name="description" content="<?php echo getConfig()['desc']; ?>">
    <link rel="stylesheet" type="text/css" href="/static/index/css/index/style.css" id="theme-opt"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/index/index.css" id="theme-opt"/>
    <style>
    #topnav .navigation-menu{
        float: left;
    }
    #topnav .login-menu {
    float: right;
    list-style: none;
    margin: 0;
    padding: 0;
}
#topnav .login-menu>li {
    float: left;
    display: block;
    position: relative;
    margin: 0 10px;
}

@media (min-width: 992px){
#topnav .login-menu>li>a {
    padding-top: 25px;
    padding-bottom: 25px;
    min-height: 62px;
    
}
}
    #topnav .login-menu>li>a {
    display: block;
    color: #3c4858;
    font-size: 13px;
    background-color: transparent!important;
    font-weight: 700;
    letter-spacing: 1px;
    line-height: 24px;
    text-transform: uppercase;
    transition: all .5s;
    font-family: Nunito,sans-serif;
    padding-left: 15px;
    padding-right: 15px;
}
@media (max-width: 991px){
#topnav .navigation-menu {
    margin-bottom: 40px;
}
#topnav .login-menu {
    position: absolute;
    bottom: 0;
}
#topnav .login-menu>li>a{
    padding: 10px 20px;
}
}
    </style>
  </head>

  <body>

<header id="topnav" class="defaultscroll sticky">
    <div class="container">
        <div>
            <a class="logo" href="/">
                <img src="<?php echo getConfig()['logo']; ?>" height="24" alt="<?php echo getConfig()['sitename']; ?>">
            </a>
        </div>
        <div class="menu-extras">
            <div class="menu-item">
                <a class="navbar-toggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </div>
        </div>
        <div id="navigation">
            <ul class="navigation-menu">
                <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li><a <?php if($vo['is_target'] == 1): ?> target="_bank" <?php endif; ?>   href="<?php echo htmlentities($vo['url']); ?>"><?php echo htmlentities($vo['name']); ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul class="login-menu">
                <?php if($is_login == 1): ?>
                <li><a href="/User/Index" class="user-btn a-head-btn bdr-5 bg-color-white">用户中心</a></li>
                <?php else: ?>
                <li><a href="/User/Login" class="login-btn a-head-btn bdr-5 bg-color-white">登录</a></li>
                <li><a href="/User/Reg" class="registered-btn a-head-btn bdr-5 bg-color-0055ff">注册</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>

<section class="bg-half bg-light d-table w-100" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="title-heading mt-4">
                    <h1 class="heading mb-3"><?php echo getConfig()['sitename']; ?><small class="text-success" style="font-size: 50%"> [ˈheɪloʊ]</small></h1>
                    <p class="para-desc text-muted"><?php echo getConfig()['title']; ?>。</p>
                    <div class="mt-4 pt-2">
                        <a href="/User/Login" class="btn btn-primary mr-2"><i class="iconify w-5 h-5 mr-2" data-icon="ri:flashlight-line"></i>快速开始</a>
                        <a href="/doc" class="btn btn-outline-primary" target="_blank"><i class="iconify w-5 h-5 mr-2" data-icon="ri:book-read-line"></i>官方文档</a>
                        <p class="text-muted mb-0 mt-3">当前版本: <?php echo htmlentities($ver); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <img src="/static/index/images/index/support-team.svg" class="img-fluid" alt="hero image">
            </div>
        </div>
    </div>
</section>
    <section class="section">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <div class="section-title mb-4 pb-2">
                <h4 class="title mb-4">特性</h4>
                <p class="para-desc mx-auto text-muted mb-0">我们会一直探索，追求更好的使用体验。</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-6 mt-5">
            <div class="features">
                <div class="image position-relative d-inline-block">
                  <i class="iconify h1 text-primary" data-icon="wpf:security-checked"></i>
                </div>
                <div class="content mt-4">
                    <h5>接口安全</h5>
                    <p class="text-muted mb-0">采用国内服务器，接口稳定传输，给顾客快速流畅的体验，安全可靠的服务您的每一笔订单</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-6 mt-5">
            <div class="features">
                <div class="image position-relative d-inline-block">
                  <i class="iconify h1 text-primary" data-icon="fa-solid:money-check-alt"></i>
                </div>

                <div class="content mt-4">
                    <h5>资金保障</h5>
                    <p class="text-muted mb-0">商户订单信息，全部加密处理，专业技术24小时实时运维，您的帐户安全将得到充分的保障。</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-6 mt-5">
            <div class="features">
                <div class="image position-relative d-inline-block">
                  <i class="iconify h1 text-primary" data-icon="ri:code-box-line"></i>
                </div>

                <div class="content mt-4">
                    <h5>REST API</h5>
                    <p class="text-muted mb-0">提供了完善的API接口，你可以用于平台应用通道接入，开发各种系统的对接通道插件等。</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-6 mt-5">
            <div class="features">
                <div class="image position-relative d-inline-block">
                  <i class="iconify h1 text-primary" data-icon="uil:heart-rate"></i>
                </div>

                <div class="content mt-4">
                    <h5>费率超低</h5>
                    <p class="text-muted mb-0">接口渠道直接到自己账户，省去中间商赚差价，因此我们可以给商户提供更低廉的费率。</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-6 mt-5">
            <div class="features">
                <div class="image position-relative d-inline-block">
                  <i class="iconify h1 text-primary" data-icon="ic:baseline-no-adult-content"></i>
                </div>

                <div class="content mt-4">
                    <h5>拒资金流</h5>
                    <p class="text-muted mb-0">只负责交易处理不参与资金清算，资金全都实时到您的个人账户上，以此来保障您的资金安全。</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-6 mt-5">
            <div class="features">
                <div class="image position-relative d-inline-block">
                  <i class="iconify h1 text-primary" data-icon="ep:service"></i>
                </div>

                <div class="content mt-4">
                    <h5>专属客服</h5>
                    <p class="text-muted mb-0">专业客服团队，专属客服一对一贴心服务，7*24小时全天候在线为你解答。</p>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>
    <?php if(getConfig()['is_notice'] == 1): ?>
<section class="section" style="padding-top: 10px;background-image: url(/static/index/images/index/notice-bg.png);">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <div class="section-title mb-4 pb-2">
                <h4 class="title mb-4">官方最新动态</h4>
                <p class="para-desc mx-auto text-muted mb-0">时刻掌握官方最新动态，全面了解平台讯息</p>
            </div>
        </div>
    </div>
    <!--PC端三栏模块-->
    <div class="van-home-file">
        <div class="van-home-file-box">
            <div class="van-grid-vansmls van-grid">
                <ul class="van-width-1-1 van-width-1-3@s">
            	    <div class="van-home-file-boxmk van-background-default">
                	    <div class="van-home-file-boxtop van-background-cover van-panel van-flex van-flex-center van-flex-middle" style="background-image: url('/static/index/images/index/notice.jpg')">
                        	<a href="/News/Index" target="_blank">平台公告</a>
                        </div>
                        <?php if(is_array($news1) || $news1 instanceof \think\Collection || $news1 instanceof \think\Paginator): $i = 0; $__LIST__ = $news1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <div class="van-flex">
                            	<a href="/News/Detail?id=<?php echo htmlentities($vo['id']); ?>" title="<?php echo htmlentities($vo['title']); ?>" target="_blank" class="van-flex-1 van-text-truncate"><?php echo htmlentities($vo['title']); ?></a>
                                <span><?php echo htmlentities(date('Y-m-d',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></span>
                            </div>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <div class="van-home-file-boxbottom">
                            <a href="/News/Index" target="_blank">更多</a>
                        </div>
                    </div>
                </ul>
                <ul class="van-width-1-1 van-width-1-3@s">
            	    <div class="van-home-file-boxmk van-background-default">
                	    <div class="van-home-file-boxtop van-background-cover van-panel van-flex van-flex-center van-flex-middle" style="background-image: url('/static/index/images/index/dynamic.jpg')">
                        	<a href="/News/Index?type=2" target="_blank">行业动态</a>
                        </div>
                        <?php if(is_array($news2) || $news2 instanceof \think\Collection || $news2 instanceof \think\Paginator): $i = 0; $__LIST__ = $news2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <div class="van-flex">
                            	<a href="/News/Detail?id=<?php echo htmlentities($vo['id']); ?>" title="<?php echo htmlentities($vo['title']); ?>" target="_blank" class="van-flex-1 van-text-truncate"><?php echo htmlentities($vo['title']); ?></a>
                                <span><?php echo htmlentities(date('Y-m-d',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></span>
                            </div>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                                <div class="van-home-file-boxbottom">
                            <a href="/News/Index?type=2" target="_blank">更多</a>
                        </div>
                    </div>
                </ul>
                            	<ul class="van-width-1-1 van-width-1-3@s">
            	    <div class="van-home-file-boxmk van-background-default">
                	    <div class="van-home-file-boxtop van-background-cover van-panel van-flex van-flex-center van-flex-middle" style="background-image: url('/static/index/images/index/problem.jpg')">
                        	<a href="/News/Index?type=3" target="_blank">常见问题</a>
                        </div>
                           <?php if(is_array($news3) || $news3 instanceof \think\Collection || $news3 instanceof \think\Paginator): $i = 0; $__LIST__ = $news3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <div class="van-flex">
                            	<a href="/News/Detail?id=<?php echo htmlentities($vo['id']); ?>" title="<?php echo htmlentities($vo['title']); ?>" target="_blank" class="van-flex-1 van-text-truncate"><?php echo htmlentities($vo['title']); ?></a>
                                <span><?php echo htmlentities(date('Y-m-d',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></span>
                            </div>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                                <div class="van-home-file-boxbottom">
                            <a href="/News/Index?type=3" target="_blank">更多</a>
                        </div>
                    </div>
                </ul>
                            </div>
        </div>
</div>
</div>
</section>
    <?php endif; ?>
<footer class="footer footer-bar">
    <div class="container text-center">
        <div class="row align-items-center">
            <div>
                <div class="text-sm-left">
                  <p class="mb-0">Copyright © 2022 <a href="/"><?php echo getConfig()['sitename']; ?></a> - All
									rights reserved<span class="sep"> | </span><a href="https://beian.miit.gov.cn"
										target="_blank" rel="noreferrer nofollow"><?php echo getConfig()['icp']; ?></a></p>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Back to top -->
<a href="#" class="btn btn-icon btn-primary back-to-top"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up icons"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg></a>
<!-- Back to top -->
  <script type="text/javascript" src="/static/index/js/index/jquery.min.js"></script>
  <script type="text/javascript" src="/static/index/js/index/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="/static/index/js/index/jquery.easing.min.js"></script>
  <script type="text/javascript" src="/static/index/js/index/main.umd.js"></script>
  <?php echo getConfig()['diy_js']; ?>
  </body>
  </html>
