/*首页banner动画*/
$(function () {
  /*banner carousel*/
  var btn = $("#slider-btn li");
  var sliderImg = $("#slider-back li");
  var $bannerTxt = $(".banner-text");

  var iNow = 0;
  btn.each(function (index) {
    $(this).mouseover(function () {
      slide(index);
    });
    $(this).data("index");
  });

  function slide(index) {
    iNow = index;
    btn.eq(index).addClass("active").siblings().removeClass();

    var bannerTxtActive = $bannerTxt.eq(index);
    var slideElements = bannerTxtActive.children();
    bannerTxtActive.siblings(".banner-text").stop(true).fadeOut(100);
    //初始化
    bannerTxtActive.show();
    slideElements.each(function () {
      var $_self = $(this);
      $_self.css({
        display: "block",
        // opacity: 0,
        top: $_self.data("start_top") || 0,
        left: $_self.data("start_left") || 0
      });
      $_self.stop(true).delay(400).animate({
        display: "none",
        // opacity: 1,
        top: $_self.data("to_top"),
        left: $_self.data("to_left")
      }, 1200);
      if ($_self.data("class") !== undefined) {
        $_self.removeClass($_self.data("class"));
        setTimeout(function () {
          $_self.addClass($_self.data("class"));
        }, 0);
      }
    });

    sliderImg.eq(index).siblings().stop().animate({ opacity: 0 }, 600);
    sliderImg.eq(index).stop().animate({ opacity: 1 }, 600);
  }

  function autoRun() {
    iNow++;
    if (iNow == btn.length) {
      iNow = 0;
    }
    slide(iNow);
  }

  var timer = null;
  var $_pointsContainer = $("#slider-btn");
  var setBannerInterval = function () {
    var $_activePoint = $_pointsContainer.find(".active");
    timer = setTimeout(function () {
      autoRun();
      setBannerInterval();
    }, $_activePoint.data("delay") || 8000);
  };
  setBannerInterval();
  btn.hover(function () {
    clearInterval(timer);
  }, function () {
    setBannerInterval();
  }
  );
  //banner初始化
  slide(0);
});


$(function () {
  ZK.tabChange('.product-tab', 'click');
  ZK.tabChange('.solution-tab');
  ZK.tabChange('.partner-tab', 'click');
  ZK.tabChange('.provide-tab', 'click');

  // 小屏-产品 展示
  ZK.sideNavShow('.m-product-wrap');

  jQuery(".provide-content-item").slide({
    mainCell: ".bd ul",
    autoPlay: true,
    effect: "leftMarquee",
    vis: 4,
    interTime: 50,
    trigger: "click"
  });

  // 提交需求
  $('#demand-btn').on('click', function () {
    var $_this = $(this);
    if ($_this.hasClass('disabled')) {
      return false;
    }
    var demandForm = document.getElementById('demandForm');
    var $_demandForm = $('#demandForm');
    var validater = new ZK.validater();
    if (demandForm.name) {
      validater.add(demandForm.name, [
        {
          strategy: 'isNonEmpty',
          errorMsg: '请填写您的称呼！',
        },
      ]);
    }
    if (demandForm.tel) {
      validater.add(demandForm.tel, [
        {
          strategy: 'isNonEmpty',
          errorMsg: '请填写您的联系电话！',
        },
      ]);
    }
    if (demandForm.content) {
      validater.add(demandForm.content, [
        {
          strategy: 'isNonEmpty',
          errorMsg: '请填写描述您的需求！',
        },
      ]);
    }
    var pass = validater.start();
    if (pass) {
      ZK.post({
        url: "/api/home/submit_requirement",
        isCoverSuccess: true,
        notLoading: false,
        data: $_demandForm.serialize(),
        beforeSend: function () {
          $_this.addClass('disabled');
        },
        success: function (res) {
          $_this.removeClass('disabled');
          if (res.Code === 'Success') {
            ZK.message.success('需求提交成功！', 1);
          } else {
            ZK.message.warn(res.Message || '操作失败', 1.5);
          }
        },
        error: function () {
          $_this.removeClass('disabled');
        },
      });
    }
  })
  // 移动端-提交需求
  $('#m-demand-btn').on('click', function () {
    var $_this = $(this);
    if ($_this.hasClass('disabled')) {
      return false;
    }
    var demandForm = document.getElementById('m-demandForm');
    var $_demandForm = $('#m-demandForm');
    var validater = new ZK.validater();
    if (demandForm.mname) {
      validater.add(demandForm.mname, [
        {
          strategy: 'isNonEmpty',
          errorMsg: '请填写您的称呼！',
        },
      ]);
    }
    if (demandForm.mtel) {
      validater.add(demandForm.mtel, [
        {
          strategy: 'isNonEmpty',
          errorMsg: '请填写您的联系电话！',
        },
      ]);
    }
    if (demandForm.mcontent) {
      validater.add(demandForm.mcontent, [
        {
          strategy: 'isNonEmpty',
          errorMsg: '请填写描述您的需求！',
        },
      ]);
    }
    var pass = validater.start();
    if (pass) {
      ZK.post({
        url: "/api/home/submit_requirement",
        isCoverSuccess: true,
        notLoading: false,
        data: $_demandForm.serialize(),
        beforeSend: function () {
          $_this.addClass('disabled');
        },
        success: function (res) {
          $_this.removeClass('disabled');
          if (res.Code === 'Success') {
            ZK.message.success('需求提交成功！', 1);
          } else {
            ZK.message.warn(res.Message || '操作失败', 1.5);
          }
        },
        error: function () {
          $_this.removeClass('disabled');
        },
      });
    }
  })

  //下载系统
  $('#downloadBtn').on('click', function () {
    if(!window.localStorage.getItem('loginState')){
      ZK.message.warn('请先登录', 2, function () {
        var redirect =window.location.href;
        window.location.href='/login/?redirect='+redirect;
      })
      return false
    }else{
      var url=$('#userSiteUrl').data('url');
      window.open(url,'_blank');
    }

  })

  //
  $("#product-module-pagination li").click(function () {
    var index = $(this).index()
    $(this).addClass('active').siblings().removeClass('active')
    $(".module-product-engine").eq(index).css({
      display:'flex'
    }).siblings('.module-product-engine').hide()
  })

  $('.home-buy-btn').on('click', function () {
    var $_self=$(this);
    if(!window.localStorage.getItem('loginState')){
      ZK.message.warn('请先登录', 2, function () {
        var redirect =window.location.href;
        window.location.href='/login/?redirect='+redirect;
      })
      return false
    }
    var productId=$_self.data('id');
    var obj = [
      {
        product_id: productId,
        year: 1,
        count: 1,
        order_type: 'buy',
        coupon_id: 0,
        type:"user_soft"
      },
    ];
    ZK.post({
      url: '/api/user/soft_buy',
      isCoverSuccess: true,
      notLoading: true,
      isShowWaitTip: false,
      data: {
        product: JSON.stringify(obj),
      },
      success: function (res) {
        if (res.Code === 'Success') {
          window.location.href = '/confirm_list/?is_buy_now=1&zkeys=' + res.Data[0];
        } else if(res.Code=="HasOrderNotPay"){
          ZK.message.warn(res.Message, 1.5,function() {
            window.location.href = $("#appUserSiteUrl").val() + '/finance/order/' +res.Data.number;
          });
        }else {
          ZK.message.warn(res.Message, 2)
        }
      },
    });

  });

  $(window).on('resize',function() {
    var $this = $(this)
    var w = $this.width()
    var $bannerApyPhoto = $(".main-product-photo")//$(".banner-apy-photo")
    var left = 0
    if(w > 1500){
      // var right = $bannerApyPhoto.css('right')
      left = 0
    }else if(w > 1200){
      left = -150
    }else if(w > 1100){
      left = -300
    }else{
      left = -400
    }
    var beforeLeft = $bannerApyPhoto.css('left');
    (parseInt(beforeLeft)!=left) && $bannerApyPhoto.css({
      left:left
    })
  }).trigger('resize')
});