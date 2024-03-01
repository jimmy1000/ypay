<?php /*a:1:{s:71:"/www/wwwroot/pay.xn--tnq769am5klza737gu1l.cn/view/index/news/index.html";i:1670816166;}*/ ?>

<!DOCTYPE html>
<html lang="zh-cmn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
  <meta name="renderer" content="webkit" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
  <title><?php echo getConfig()['sitename']; ?></title>
  <meta name="keywords" content=""/>
  <meta name="description" content="" />
  <link rel="stylesheet" type="text/css" href="/wwwroot/lib/static/style/css/main.css" />
  <link rel="stylesheet" type="text/css" href="/wwwroot/lib/static/style/css/common.css" />
  <link rel="stylesheet" type="text/css" href="/wwwroot/lib/static/style/css/flexboxgrid.min.css" />
  <script src="/wwwroot/lib/static/lib/font/font_2416523_7f24rt7bdt4.js"></script>
  <script src="/wwwroot/lib/static/js/jquery-1.12.2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/wwwroot/lib/static/style/css/news/index.css?v=2.2.1"/>
</head>
<body>
<!--logo条topBar start-->
<!-- <div class="m-mask"></div> -->
<div class="header-container sm-nohidden">
  <div class="header auto-width">
            <a href="/" class="logo inlie-block" title="Logo">
                <span class="no-theme-white-show">
                     <img class="logo regular" style="height:40px;" src="<?php echo getConfig()['logo']; ?>" alt="<?php echo getConfig()['sitename']; ?>">
                </span>
            </a>
            <!-- 小屏-导航 -->
            <div class="m-topbar-right">
                <a href="/User/Login" class="m-header-btn m-user-icon login-btn">
                    登录
                </a>
            </div>
        </div>
</div>

<!--logo条topBar end-->

<!--banner菜单 start-->
<div class="doc-banner-container">
  <div class="news-banner-box menu-box" >
    <!-- topMenu菜单 start-->
    <div class="box-sizing-border">
  <div id="headMenuBox" class="menu-wrap">
    <div class="auto-width clearfix pos-rel">
        <a class="inline-block fl apy-logo" href="/">
                            <span class="no-theme-white-show">
                                 <img class="logo regular" style="height:40px;" src="<?php echo getConfig()['logo']; ?>" alt="<?php echo getConfig()['sitename']; ?>">
                            </span>
                        </a>
        <ul class="menu-ul fl clearfix" id="topMenu">
                            <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                               <li class="menu-item"><a <?php if($vo['is_target'] == 1): ?> target="_bank" <?php endif; ?> href="<?php echo htmlentities($vo['url']); ?>"><?php echo htmlentities($vo['name']); ?></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                <div class="menu-right m-t-30 pos-rel">

            <a href="/User/Login" class="login-btn a-head-btn bdr-5 bg-color-white">登录账号</a>
            <a href="/User/Reg" class="registered-btn a-head-btn bdr-5 bg-color-0055ff">立即注册</a>
        </div>
            </div>
</div>
</div>

    <!-- topMenu菜单 end-->

    <!-- banner内容 -->
    <div class="news-banner-content auto-width">
      <div class="content">
        <p>及时掌握行业一手讯息</p>
      </div>
    </div>
  </div>
</div>
<!--banner菜单 end-->

<div class="auto-width news-wrap clear">
  <div class="left-nav">
    <h2>新闻资讯</h2>
    <ul class="news-list">
        <li class=""  >
            <span class="zk-icon-news icon-news-title-1"></span>
            <span><a href="/News/Index">平台公告</a></span>
         </li>
         <li class="" >
            <span class="zk-icon-news icon-news-title-1"></span>
            <span><a href="/News/Index?type=2">行业动态</a></span>
          </li>
          <li class="" >
            <span class="zk-icon-news icon-news-title-1"></span>
            <span><a href="/News/Index?type=3">常见问题</a></span>
          </li>
                  </ul>
  </div>
  <div class="right-content">
          <?php if(is_array($news) || $news instanceof \think\Collection || $news instanceof \think\Paginator): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
           <div class="news-list-wrap">
              <div class="date">
                <p><?php echo htmlentities($vo['month']); ?></p>
                <p><?php echo htmlentities($vo['day']); ?></p>
              </div>
              <div class="text-wrap">
                <p class="text-one-row"><a href="/News/Detail?id=<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['title']); ?></a></p>
                <p><a href="/News/Detail?id=<?php echo htmlentities($vo['id']); ?>" class="more fr">查看详情&gt;</a></p>
              </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
   
           <?php echo htmlentities($news->render()); ?>  
        </div>
              
    

</div>

<div class="m-news-wrap">
  <div class="m-news-header">
    <div class="nav">
        <a href="/News/Index" class="">平台公告</a>
        <a href="/News/Index?type=2" class="">行业动态</a>
        <a href="/News/Index?type=3" class="">常见问题</a>
     </div>
  </div>

  <!--公司公告-->
  <div class="m-scroll">
    <ul class="data-list">
        <?php if(is_array($news) || $news instanceof \think\Collection || $news instanceof \think\Paginator): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li>
            <div class="date-wrap">
              <p><?php echo htmlentities($vo['month']); ?></p>
                <p><?php echo htmlentities($vo['day']); ?></p>
            </div>
            <a href="/News/Detail?id=<?php echo htmlentities($vo['id']); ?>">
              <p class="title"><?php echo htmlentities($vo['title']); ?></p>
              <p class="des keep-two-lines"></p>
            </a>
          </li>
         <?php endforeach; endif; else: echo "" ;endif; ?>
                  </ul>
          <div class="m-more-wrap">
        <a href="javascript:;" class="loading-more">点击加载更多</a>
      </div>
      </div>

</div>

  <div class="start-box">
                <div class="auto-width join-apy-wrap sm-p-lr-15">
                    <ul layout-align="space-between start">
                        <li layout-align="start start">
                            <svg class="icon-svg icon-hook sm-hidden" aria-hidden="true">
                                <use xlink:href="#iconapayun_dibuicon_youshi"></use>
                            </svg>

                            <svg class="icon-svg icon-hook sm-nohidden" aria-hidden="true">
                                <use xlink:href="#iconapayun_dibuicon_youshi"></use>
                            </svg>

                            <div>
                                <h3 class="font-weight-bold font-size-24">兼容优化好</h3>
                                <p class="color-main-596680">接入方便，易支付流程接入.</p>
                            </div>
                        </li>
                        <li layout-align="start start">
                            <svg class="icon-svg icon-hook sm-hidden" aria-hidden="true">
                                <use xlink:href="#iconapayun_dibuicon_youshi"></use>
                            </svg>

                            <svg class="icon-svg icon-hook sm-nohidden" aria-hidden="true">
                                <use xlink:href="#iconapayun_dibuicon_youshi"></use>
                            </svg>

                            <div>
                                <h3 class="font-weight-bold font-size-24">稳定不漏单</h3>
                                <p class="color-main-596680">使用方便，配有流程说明</p>
                            </div>
                        </li>
                        <li layout-align="start start">
                            <svg class="icon-svg icon-hook sm-hidden" aria-hidden="true">
                                <use xlink:href="#iconapayun_dibuicon_youshi"></use>
                            </svg>

                            <svg class="icon-svg icon-hook sm-nohidden" aria-hidden="true">
                                <use xlink:href="#iconapayun_dibuicon_youshi"></use>
                            </svg>

                            <div>
                                <h3 class="font-weight-bold font-size-24">免挂机服务</h3>
                                <p class="color-main-596680">真正的免挂机服务</p>
                            </div>
                        </li>
                        <li layout-align="start start">
                            <svg class="icon-svg icon-hook sm-hidden" aria-hidden="true">
                                <use xlink:href="#iconapayun_dibuicon_youshi"></use>
                            </svg>

                            <svg class="icon-svg icon-hook sm-nohidden" aria-hidden="true">
                                <use xlink:href="#iconapayun_dibuicon_youshi"></use>
                            </svg>

                            <div>
                                <h3 class="font-weight-bold font-size-24">丰富的经验</h3>
                                <p class="color-main-596680">核心开发人员5年以上行业经验</p>
                            </div>
                        </li>
                    </ul>
                    <div class="text-content" layout-align="space-between center">
                        <div class="bdr-5 font-size-18 font-weight-bold">
                            <span class="sm-hidden">
                                一个SDK，无需寻找想要的支付通道、无需重复对接集成繁琐的支付接口
                            </span>
                            <span class="sm-nohidden">
                                一个SDK，无需寻找想要的支付通道、无需重复对接集成繁琐的支付接口
                            </span>
                        </div>
                        <a href="/" class="start-btn">
                            立即使用
                            <svg class="icon-svg color-white m-l-20" aria-hidden="true">
                                <use xlink:href="#iconapayun_tongyongicon_jiantou"></use>
                            </svg>

                        </a>
                    </div>
                </div>
            </div>


  <div class="footer">
        <div class="top">
            <div class="auto-width">
                <div class="web-link">
                    <ul>
                        <li>
                            <svg class="icon-svg footer-icon-hot vam" aria-hidden="true">
                                <use xlink:href="#iconapayun_dibuicon_remenchanpin"></use>
                            </svg>
                            热门通道
                        </li>
                        <li><a href="javascript:;">微信支付</a></li>
                        <li><a href="javascript:;">支付宝支付</a></li>
                        <li><a href="javascript:;">QQ钱包支付</a></li>
                        <li><a href="javascript:;">银联支付</a></li>
                        <li><a href="javascript:;">更多产品></a></li>
                    </ul>
                    <ul>
                        <li>
                            <svg class="icon-svg footer-icon-hot vam" aria-hidden="true">
                                <use xlink:href="#iconapayun_dibuicon_zhichiyufuwu"></use>
                            </svg>
                            支持服务
                        </li>
                        <li><a href="javascript:;">文档中心</a></li>
                        <li><a href="javascript:;">在线更新</a></li>
                        <li><a href="javascript:;" target="_blank">售后服务</a></li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="m-footer-top sm-hidden">
            <div class="m-footer-item side-nav-inner-box">
                <div class="m-footer-title side-nav-title">热门通道</div>
                <div class="m-footer-content side-nav-inner-list">
                    <a href="javascript:;">微信支付</a>
                    <a href="javascript:;">支付宝支付</a>
                    <a href="javascript:;">QQ钱包支付</a>
                    <a href="javascript:;">银联支付</a>
                    <a href="javascript:;">更多产品></a>
                </div>
            </div>
            <div class="m-footer-item side-nav-inner-box">
                <div class="m-footer-title side-nav-title">支持服务</div>
                <div class="m-footer-content side-nav-inner-list">
                    <a href="javascript:;">在线更新</a>
                    <a href="javascript:;">售后服务</a>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="auto-width">

                   <span>Copyright &copy; 2020-2022 <?php echo getConfig()['sitename']; ?> All Rights Reserved. <?php echo getConfig()['sitename']; ?> 版权所有</span>
                <span class="fr"><a href="https://beian.miit.gov.cn/" target="_blank"><?php echo getConfig()['icp']; ?></a></span>
            </div>
        </div>
    </div>
</body>
</html>

