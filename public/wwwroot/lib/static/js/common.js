// 工具 组件函数库

window.ZK = window.ZK || {};

/* 表单验证正则表达式 begin*/
ZK.regEx = (function() {
  //密码验证
  return {
    mobileRegEx: /^1[3456789]\d{9}$/,
    passwordRegEx: /^(?=.*[0-9])(?=.*[a-zA-Z])^[\w\(\)\~\!\@\#\$\%\^\&\*\-\+\=\|\{\}\[\]\:\;\<\>\,\.\?\/]{8,30}$/,
    eMailRegEx: /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/,
  };
})();

// 表单验证
ZK.validater = (function() {
  var defaultCb = function(msg, dom) {
    dom.focus();
    ZK.message.warn(msg, 1.5);
    return false;
  };
  var strategies = {
    isNonEmpty: function(dom, errorMsg, errorFunc) {
      return dom.value === '' ? errorFunc(errorMsg, dom) : true;
    },
    isMobile: function(dom, errorMsg, errorFunc) {
      return ZK.regEx.mobileRegEx.test(dom.value)
        ? true
        : errorFunc(errorMsg, dom);
    },
    isPassword: function(dom, errorMsg, errorFunc) {
      return ZK.regEx.passwordRegEx.test(dom.value)
        ? true
        : errorFunc(errorMsg, dom);
    },
    isEMail: function(dom, errorMsg, errorFunc) {
      return ZK.regEx.eMailRegEx.test(dom.value)
        ? true
        : errorFunc(errorMsg, dom);
    },
    isCustomize: function(dom, errorMsg, errorFunc) {
      return errorFunc(dom.value, errorMsg);
    },
  };
  var Validator = function() {
    this.cache = [];
    this.add = function(dom, rules) {
      var that = this;
      $.each(rules, function(i, rule) {
        var rule = rules[i];
        that.cache.push(function() {
          var strategy = rule.strategy; // 验证规则
          var errorMsg = rule.errorMsg; // 错误信息提示
          var callback = rule.callback || defaultCb; // 自定义错误回调
          return strategies[strategy](dom, errorMsg, callback);
        });
      });
    };
    this.start = function() {
      for (var i = 0; i < this.cache.length; i++) {
        var flag = this.cache[i]();
        if (!flag) {
          return false;
        }
      }
      return true;
    };
  };
  return Validator;
})();

// 提示框
(function(ZK) {
  ZK.message = {
    remove: function(el) {
      if (el) {
        $(el).animate({ opacity: 0 }, 500, 'swing', function() {
          this.remove();
        });
      } else {
        $('.message-container').animate(
          { opacity: 0 },
          500,
          'swing',
          function() {
            this.remove();
          }
        );
      }
    },
    str: null,
  };
  var methodList = ['success', 'wait', 'error', 'warn'];
  var defaultText = {
    success: '操作成功',
    wait: '请稍等...',
    error: '操作失败',
  };

  $.each(methodList, function(i, methodType) {
    ZK.message[methodType] = function(text, duration, closedCallback) {
      text = text || defaultText[methodType];
      duration = duration === undefined ? 2 : duration;
      var that = this;

      clearTimeout(that.str);
      that.remove();

      var html = '';

      if (duration >= 10 || duration === 0) {
        html =
          '<div class="message-container has-close-btn message-' +
          methodType +
          '"><i class="message-close"></i><div class="message-content">' +
          text +
          '</div></div>';
      } else {
        html =
          '<div class="message-container message-' +
          methodType +
          '"><div class="message-content">' +
          text +
          '</div></div>';
      }

      $('body').append(html);

      $('.message-close').on('click', function() {
        that.remove();
        clearTimeout(that.str);
        !!closedCallback && closedCallback();
      });
      if (duration !== 0) {
        that.str = setTimeout(function() {
          that.remove();
          clearTimeout(that.str);
          !!closedCallback && closedCallback();
        }, duration * 1000);
      }
    };
  });
})(ZK);

ZK.mMessage={
  toast:function (text,duration,callback) {
    text=text;
    duration = duration === undefined ? 2 : duration;
    var timer=null;
    clearTimeout(timer);

    var html='<div class="toast-wrap">'+text+'</div>';
    $('body').append(html);
    var w = $(".toast-wrap").width(),ww = $(window).width();
    var h = $(".toast-wrap").height(),hh = $(window).height();
    $(".toast-wrap").css("top",(hh-h)/2-20);
    $(".toast-wrap").css("left",(ww-w)/2-20);

    timer=setTimeout(function() {
      $('.toast-wrap').fadeOut().remove();
      !!callback && callback();
    }, duration * 1000);
  }
}


ZK.ajax = function(url, options) {
  // 照搬jquery的ajax方法的参数判断
  if (typeof url === 'object') {
    options = url;
    url = undefined;
  }

  // 缓存 计算后的设置
  var isShowWaitTip = options.isShowWaitTip !== false;
  var notLoading = options.notLoading || false;

  // 默认ajax配置
  var settings = $.extend(
    {
      url: url,
      type: 'post',
      dataType: 'json',
      error: function(data) {
        if (data) {
          ZK.message.error(data.Message || '系统错误', 5);
        }
      },
      beforeSend: function() {
        if (!notLoading) {
          ZK.message.wait('加载中，请稍后...', 10000);
        }
      },
      complete: function() {
        if (isShowWaitTip) {
          ZK.message.remove('.message-wait');
        }
      },
    },
    options
  );
  // console.log(settings);
  // 删除扩展的参数
  delete settings.isCoverSuccess;
  delete settings.successResultFalse;
  delete settings.isSuccessShowTip;
  delete settings.isSuccessJump;
  delete settings.isResultFalseWarn;
  delete settings.waitText;
  delete settings.isShowWaitTip;
  delete settings.isShowWaitMask;
  delete settings.waitMaskStyle;

  // isCoverSuccess表示 是否覆盖增强的success方法。若值为true，则不使用增强的success方法。若值不为true，则使用增强的success方法。
  if (options.isCoverSuccess !== true) {
    // 增强的success方法：对响应数据的status做判断，并在错误时显示后端提示信息，正确时才调用原来的options.success
    settings.success = function(responseData, textStatus, jqXHR) {
      var context = this;
      // 缓存响应数据
      responseData.result = false;
      if (responseData.Code === 'Success') {
        responseData.result = true;
      }
      var responseDataText = responseData.Message || '操作成功！';
      var responseDataTime = responseData.time || 1.5;

      // status 标识不成功时的处理
      if (!responseData.result) {
        // 对successResultFalse的 容错调用封装
        var resultFalseHandler = function() {
          var successResultFalse = options.successResultFalse;

          if ($.isFunction(successResultFalse)) {
            successResultFalse.call(context, responseData, textStatus, jqXHR);
          }
        };
        // 弹窗提示警告信息（当 options.isResultFalseWarn 配置不为 false 时执行）
        if (options.isResultFalseWarn !== false) {
          ZK.message.warn(responseDataText, responseDataTime, function() {
            resultFalseHandler();
          });
        } else {
          resultFalseHandler();
        }

        return;
      }

      /*
       * status标识成功时的处理（默认处理方式：先弹窗提示成功信息，再根据responseData的url或reload值 进行页面跳转或刷新）
       */
      var successHandler = function() {
        var optionSuccess = options.success;
        var isJumpAfterCall = true;
        // 如果有传入options.success回调，则调用该方法
        if ($.isFunction(optionSuccess)) {
          isJumpAfterCall = optionSuccess.call(
            context,
            responseData,
            textStatus,
            jqXHR
          );
        }

        // 自动跳转（当 isSuccessJump 配置不为 false 且optionSuccess没有返回false 时执行）
        if (options.isSuccessJump !== false && isJumpAfterCall !== false) {
          // 若后端有返回url时，则跳转
          if (responseData.url) {
            setTimeout(function() {
              //解决IE高版本浏览器弹出白框问题
              window.location.href = responseData.url;
            }, 200);
          }
          // 若后端有返回reload时，则刷新
          else if (responseData.reload) {
            setTimeout(function() {
              //解决IE高版本浏览器弹出白框问题
              window.location.reload();
            }, 200);
          }
          // 若后端有返回goback时，则返回上一页
          else if (responseData.goback) {
            history.back(-1);
            location.reload();
          }
        }
      };

      // 弹窗提示成功信息（当 isSuccessShowTip 配置不为 false 时执行）
      if (options.isSuccessShowTip !== false && responseDataText) {
        // 使用成功提示框显示信息，并在指定时间后自动关闭
        ZK.message.success(responseDataText, responseDataTime, function() {
          successHandler();
        });
      } else {
        successHandler();
      }
    };
  }

  // 发送ajax之前，根据配置 展示 waitTip
  if (isShowWaitTip) {
    ZK.message.wait(options.waitText || '加载中...');
  }
  // 发送ajax
  return $.ajax(settings);
};
// 封装业务型的快捷 ZK.get 和 ZK.post 方法
$.each(['get', 'post'], function(i, method) {
  ZK[method] = function(url, options) {
    options = options || {};
    options.type = method;

    if (method == 'get') {
      options.cache = false;
    }

    return ZK.ajax(url, options);
  };
});

// 工具函数
ZK.util = (function() {
  // 将 arguments 对象 转换成 标准数组
  var argumentsToArray = function(args) {
    return Array.prototype.slice.call(args);
  };
  // 判断元素是否可见
  var isHidden = function(elem) {
    return !!(
      elem.offsetWidth ||
      elem.offsetHeight ||
      elem.getClientRects().length
    );
  };
  var setTimeout = (function() {
    var timeoutSymbol = {};
    return function(key, timeoutDo, millisecond) {
      var argArray = argumentsToArray(arguments);
      var timeoutKey = argArray.shift();
      clearTimeout(timeoutSymbol[timeoutKey]);
      return (timeoutSymbol[timeoutKey] = window.setTimeout.apply(
        null,
        argArray
      ));
    };
  })();
  return {
    argumentsToArray: argumentsToArray,
    setTimeout: setTimeout,
    isHidden: isHidden,
  };
})();

// 获取url参数
ZK.getQueryVariable=function (variable) {
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  // 如果是获取来源地址直接把后面参数返回 去掉，有bug
  if(variable==='redirect'){
    // var redirect = vars[0].slice(9)
    // return redirect
  }
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    if(pair[0] == variable){return pair[1];}
  }
  return '';
}

// tab切换
ZK.tabChange = function(container, event, defaultIndex) {

  var $container = $(container),
    $menu = $container.find('.tab-menu'),
    $menuList = $container.find('.tab-menu > li'),
    $contentList = $container.find('.tab-content > div');

  defaultIndex = defaultIndex || 0;
  event = event || 'mouseover';

  $menuList.eq(defaultIndex).addClass('active');
  $contentList.eq(defaultIndex).show();

  $menu.on(event, 'li', function() {
    if ($(this).hasClass("disabled")) {
      return false;
    }
    var index = $(this).index();
    $(this)
      .addClass('active')
      .siblings()
      .removeClass('active');
    $contentList
      .stop()
      .hide()
      .eq(index)
      .fadeIn('slow');
  });
};

ZK.pageNav=function(showingBtn,navContainer){
  var $_showingBtn = $(showingBtn);
  var $_navContainer = $(navContainer);
  ZK.pageNavShow();
  $(window).resize(ZK.pageNavShow);
  $_showingBtn.mouseover(function() {
    $_navContainer.removeClass("hiding-animate1");
    $(this).removeClass("hiding-animate2");
  });
  $("body").on("mouseleave", ".link-menu-wrap.w1400", function() {
    $_showingBtn.addClass("hiding-animate2");
    $(this).addClass("hiding-animate1");
  });
}

ZK.pageNavShow=function(){
  var $_showingBtn = $(".showing-link-box");
  var $_navContainer = $(".link-menu-wrap");
  var width = $("body").width();
    if (width < 1630) {
      $_navContainer.addClass("hiding-animate1 w1400");
        if($_navContainer.hasClass('fixed')){
          $_showingBtn.addClass("hiding-animate2");
        }
    } else {
      $_navContainer.removeClass("hiding-animate1 w1400");
      $_showingBtn.removeClass("hiding-animate2");
      $_showingBtn.removeClass("hiding-animate-normal");
    }
}

//吸顶
ZK.Mounting=function(container,showingBtn){
var $_showingBtn = $(showingBtn);
  if ($(container).length) {
    var offsetTop=$(container).offset().top;
    $(document).scroll(function(){
      if($(document).scrollTop()>offsetTop){
        $(container).addClass('fixed');
        ZK.pageNavShow();
      }else{
        $(container).removeClass('fixed');
        $_showingBtn.removeClass("hiding-animate2");
      }
  });
  }
}
// 内页菜单点击切换
ZK.menuScroll = function(container) {
  if ($(container).length) {
    var $container = $(container).not(".disabled"),
      $wrap = $container.children('.link-menu-wrap'),
      $link = $wrap.find('a'),
      height = $container.offset().top-150,
      prevent = false,
      arrTop = [];

    //固定菜单
    $(document).scroll(function() {
      if ($(document).scrollTop() > height) {
        $wrap.addClass('fixed');
      } else if ($(document).scrollTop() <= height) {
        $link.eq(0).addClass('active');
        $wrap.removeClass('fixed');
      }
    }).trigger('scroll')

    // 滚动到点击位置
    $container.on('click', 'a', function() {
      var $targetEle = $('#' + $(this).attr('data-hash'));
      prevent = true;
      $(this)
        .addClass('active')
        .siblings()
        .removeClass('active');
      $('html,body').animate(
        {
          scrollTop: $targetEle.offset().top - 50,
        },
        200,
        function() {
          prevent = false;
        }
      );
      window.location.hash = $(this).attr('data-hash');
      return false;
    });

    $link.each(function(n, item) {
      var $item = $(item),
        $targetEle = $('#' + $item.attr('data-hash'));
      $item.data('top', $targetEle.offset().top);
      arrTop.push($targetEle.offset().top);
    });
    arrTop.push($(document).height());

    $(window).on('scroll', function() {
      var top = $(window).scrollTop() - 50;
      if (!prevent) {
        for (var i = 0; i < arrTop.length - 1; i++) {
          if (top >= arrTop[i] - 200 && top < arrTop[i + 1] - 200) {
            $link.removeClass('active');
            $link.eq(i).addClass('active');
            break;
          }
        }
      }
    });
  }
};

/**
 * 点击菜单展示收缩
 * @param container 外层包裹元素
 *
 * 大体结构（根据类名，标签随意）：
 * <div class='container'>
 *  <div class="side-nav-inner-box">
 *    <div class="side-nav-title"></div>
 *    <div class="side-nav-inner-list"></div>
 *  </div>
 * </div>
 */

ZK.sideNavShow = function(container) {
  var $container = $(container).not(".disabled"),
    $innerBox = $container.children('.side-nav-inner-box');
    var defaultLevel=$(container).attr('data-level');
    var level=defaultLevel?defaultLevel.split('-'):[];
    var level1=level[0];
    if(level1){
      $(container).find('.side-nav-inner-box').eq(level1).find('.side-nav-title').addClass('active');
      $(container).find('.side-nav-inner-box').eq(level1).find('.side-nav-inner-list').show();
      $(container).find('.side-nav-inner-box').eq(level1).find('.side-nav-inner-list').find('ul').eq(level[1]).find('.m-sub-title').addClass('active');
      $(container).find('.side-nav-inner-box').eq(level1).find('.side-nav-inner-list').find('ul').eq(level[1]).find('.m-sub-menu').show();
    }
  $innerBox.off('click').on('click', '.side-nav-title', function() {
    var $list = $(this).next('.side-nav-inner-list');
    var $otherList=$(this).parent('.side-nav-inner-box').siblings('.side-nav-inner-box').find('.side-nav-inner-list');
    var $otherTitle=$(this).parent('.side-nav-inner-box').siblings('.side-nav-inner-box').find('.side-nav-title');
    if ($list) {
      var isShow = $(this).hasClass('active');
      if (isShow) {
        $list.hide('fast');
        $(this).removeClass('active');
      } else {
        $list.show();
        $otherList.hide('fast');
        $otherTitle.removeClass('active');
        $(this).addClass('active');
      }
    }
  });
};

$('.m-menu-content').on('click','.m-sub-title',function(){
  var $this = $(this)
  var isActive = $this.hasClass('active')
  if(isActive){
    $this.removeClass('active').parent().find('.m-sub-menu').hide('fast');
  }else{
    $this.addClass('active').parent().find('.m-sub-menu').show()
  }
})

// 单选下拉框
ZK.dropdown=function(container){
  var $container = $(container).not(".disabled");
  return $container.each(function(){
    var $ele = $(this),
      $value = $ele.find(".value"),
      $list = $ele.find(".drop-panel"),
      $hidden = $ele.find("input[type='hidden']");

    $ele.on("click",function(e){

      if($list.hasClass('active')){
        $list.hide()
        $list.removeClass('active')

      }else {
        $list.addClass('active')
        $list.show()
      }

    })
    $ele.on("blur",function(){
      $list.hide();
      $list.removeClass('active')
    })
    $ele.on("click","li",function(){
      $value[0].innerHTML = this.innerHTML;
      $list.hide();
      var val = $(this).attr("value"),
        offer_value=$(this).attr("data-offervalue"),
        offer_type=$(this).attr("data-offertype");

      $hidden.val(val);
      $hidden.attr({'data-offervalue':offer_value,'data-offertype':offer_type})
    })
  })

}
ZK.dropdown('.dropdown');


// 下拉菜单导航
topMenuHover();
function topMenuHover() {
  var $menu = $('#topMenu'),
    $menuLi = $menu.find('.menu-item');

  $menuLi.hover(
    function() {
      var $this = $(this),
        $menuDetail = $this.find('.menu-detail');
      if ($menuDetail.length) {
        $menuDetail.stop().slideDown('fast');
        $(".menu-box").css({
          "overflow":'initial'
        })
        $("body").css({
          "overflow-x":'hidden'
        })
      }
    },
    function() {
      var $this = $(this),
        $menuDetail = $this.find('.menu-detail');
      if ($menuDetail.length) {
        $menuDetail.stop().slideUp('fast');
        $(".menu-box").css({
          "overflow":''
        })
        $("body").css({
          "overflow-x":''
        })
      }
    }
  );
}

var $loginUserWrap = $("#login-user-wrap")
$('#login-user-wrap .user-head-name').hover(
  function() {
    $loginUserWrap
      .find('.item-detail')
      .stop()
      .slideDown('fast');
  },
  function() {
    $loginUserWrap
      .find('.item-detail')
      .stop()
      .slideUp('fast');
  }
);

// 获取用户登录状态
(function() {
 
})();

//获取购物车数量
// getCartNumber();
// function getCartNumber() {
//   var CART_KEY = 'mycart';
//   // 获取cookies 中本地存储的购物车商品
//   var carts = Cookies.get(CART_KEY);
//   // 初始化购物车商品数量
//   if (carts) {
//     carts = JSON.parse(carts);
//   } else {
//     carts = [];
//   }
//   var cartNumber = carts.length;
//   $('.zk_cart_number').text(' (' + cartNumber + ')');
//   $('.tb-num').text(cartNumber);
// }


// 监听退出
$('.logOut').on('click', function(e) {
  var redirect =window.location.href;
  ZK.get('/api/user/logout', {
    isCoverSuccess: true,
    notLoading: false,
    data: {
      redirect:redirect
    },
    success: function(res) {
      if (res.Code === 'Success') {
        ZK.message.success('退出成功', 1, function() {
          window.localStorage.removeItem('loginState');
          window.location.href = '/';
        });
      } else {
      }
    },
  });
});

// 点击登录带上来源地址
$('.login-btn').on('click',function () {
  var redirect =window.location.href;
  window.location.href='/login/?redirect='+redirect;
})

// 屏幕数据
$(function () {
  var userWidth = window.screen.width,
    userHeight = window.screen.height;
  var img=document.createElement('img');

})



// 小屏-菜单展示
$('.m-menu-icon,.more-view-btn').on('click',function () {
  var level=$(this).data('level');
  if(level){
    $('html , body').animate({scrollTop: 0},'slow');
    $('.m-menu-icon').addClass('toggle-animate');
  }
  var status=$(this).hasClass('toggle-animate');
  if(status){
    // 展开状态-需关闭
    $(this).removeClass('toggle-animate');
    $('.m-top-content').removeAttr('data-level').fadeOut();
    $('.m-mask').hide();
    // $('.m-header-btn').fadeIn();
    // $('.cart-wrap').fadeIn();
  }else {
    $(this).addClass('toggle-animate')
    $('.m-menu-content').attr('data-level',level).fadeIn();
    $('.m-mask').show();
    // $('.m-header-btn').fadeOut();
    // $('.cart-wrap').fadeOut();
  }
  ZK.sideNavShow('.m-menu-content');
})

// 小屏-
$('.m-user-click').on('click',function(){
  var status=$('.m-menu-icon').hasClass('toggle-animate');
  if(!status){
    // $('.m-menu-icon').addClass('toggle-animate');
    // $('.m-user-content').fadeIn();
    $('.m-mask').show();
    // $('.m-header-btn').fadeOut();
    $('.cart-wrap').fadeOut();
    $(this).find('.item-detail').fadeIn();
  }
})

// 小屏-底部菜单展示
ZK.sideNavShow('.m-footer-top');

// 判断是移动端还是pc端  返回true为移动端，false为pc端
ZK.isPcOrMobile =function() {
  var sUserAgent = navigator.userAgent.toLowerCase();
  var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
  var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
  var bIsMidp = sUserAgent.match(/midp/i) == "midp";
  var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
  var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
  var bIsAndroid = sUserAgent.match(/android/i) == "android";
  var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
  var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
  var bIsWx = sUserAgent.match(/MicroMessenger/i) == "micromessenger";
  if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM || bIsWx) {
    return true
  } else {
    return false
  }
}


window.ZK_Utils = {
  isUndefined:function(data) {
    return typeof data ==='undefined'
  },
  isNumber:function(data) {
    return typeof data ==='number'
  },
  isString:function(data) {
    return typeof data ==='string'
  },
  isArray:function(data) {
    return Array.isArray(data)
  },
  isObject:function(data) {
     return Object.prototype.toString.call(data) =='[object Object]'
  },
  isVaildArray:function(data) {
    return this.isArray(data) && data.length
  },
  filterData:function(data, filterVal, onlyKey) {
    onlyKey = onlyKey || 'id'
    if(!this.isVaildArray(data)) return []
    var flag = this.isObject(data[0])
    return data.filter(function(v) {
      return (flag ? v[onlyKey] : v) !== filterVal
    })
  },
  findItem:function(data,findVal,onlyKey) {
    onlyKey = onlyKey || 'id'
    if(!this.isVaildArray(data)) return {}
    var flag = this.isObject(data[0])
    return data.find(function(v) {
      return (flag ? v[onlyKey] : v) === findVal
    })
  },
  findIndex:function(data,findVal,onlyKey) {
    onlyKey = onlyKey || 'id'
    if(!this.isVaildArray(data)) return -1
    var flag = this.isObject(data[0])
    return data.findIndex(function(v) {
      return (flag ? v[onlyKey] : v) === findVal
    })
  },
  limitDecimals: function(value,isReturnEmpty) {
    var reg = /^(([1-9]\d*)|^\d*)(\.{0, 1}\d*)$/
    if (reg.test(value.toString())) return ''
    if (isNaN(value) || !value) return ''
    var result = parseInt(Math.round(Number(value)),10) || ''
    return result < 0 ? '' : result
    var res = (value || '').replace(/^(0+)|[^\d]+/g,'')
    if(isReturnEmpty){
      return +res || ''
    }
    return res
  },
  request:function(option) {
    option = Object.assign({},{
      isHijack:true
    },option)
    var success = option.success
    var isHijack = option.isHijack

    option.data = option.data || {}
    var isPagination= option.data.isPagination

    if(isPagination){
      // option.data.list_rows = 2 || 5
      option.data.list_rows = 5
      option.data.isPagination = void 0
    }
    var opt = Object.assign({},option,{
      success: function(res){
          if (res.Code == QS.noLoginCode) {
              QS.redirectLogin();
              return false;
          }
          if(!isHijack){
            return success && success(res)
          }
          if (res.Code == "Success") {
            success && success(res)
          } else {
            ZK.message.error(res.Message);
          }
      }
    })
    $.ajax(opt)
  },
  isNoLogin:function(){
    return !this.isLogin()
  },
  isLogin:function(){
    return window.localStorage.getItem('loginState')
  },
  isSmallScreen:function() {
    var WINDOW_WIDTH = 1000
    return $(window).width() < WINDOW_WIDTH
  },
  deepCopy:function(obj){
    return JSON.parse(JSON.stringify(obj))
  },
  goBack:function(){
    window.history.back()
  },
  noLoginJump:function(){
    ZK.message.warn('请先登录', 2, function () {
      var redirect =window.location.href;
      window.location.href='/login/?redirect='+redirect;
    })
  },
  generateNumList:function(num,isShift) {
    num = + num
    if(isNaN(num)){
      return []
    }
    if(isShift){
      num +=1
    }
    var result = Object.keys(Array.apply(null, {length: num})).map(function(item){
      return +item;
    })
    return isShift ? result.slice(1) : result
  },
  renewAssignPagination:function(options) {
    return Object.assign({},options,{
      current_page:+options.current_page
    })
  },
  debounce:function(fn, delay) {
    var timer; // 维护一个 timer
    return function () {
        var _this = this; // 取debounce执行作用域的this
        var args = arguments;
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(function () {
            fn.apply(_this, args); // 用apply指向调用debounce的对象，相当于_this.fn(args);
        }, delay);
    };
  },
  openWinJump:function(url) {
    url && window.open(url)
  }
}
//添加不同主题
diffThemeShowContent()
function diffThemeShowContent() {
  if(false && window.location.pathname == '/'){
    $(".theme-white-show").hide()
    $(".no-theme-white-show").show()
    $(".m-head-logout").show()
    $(".m-head-console").hide()
    $(".m-header-btn.login-btn").css({
      border:''
    })
  }else{
    $("#headMenuBox,.header-container").addClass('menu-theme-white')
    $(".theme-white-show").show()
    $(".no-theme-white-show").hide()
    $(".m-head-logout").hide()
    $(".m-head-console").show()
    $(".m-header-btn.login-btn").css({
      border:'1px solid #fff'
    })
  }
}
//菜单选中
menuSelect()
function menuSelect(){
  var pathname=window.location.pathname;
  var menuLists=$('#topMenu').find("a");
  for (var index = 0; index < menuLists.length; index++) {
    var item = menuLists[index];
    var name=$(item).data('name');
    if(!name || pathname.indexOf('appeal')!=-1){
      continue;
    }
    if(pathname=='/product/gift'){
      $('a[data-name="/product/gift"]').addClass('active');
    }else{
      if(pathname.indexOf(name)!=-1){
        $(item).addClass('active');
      }else if(pathname.indexOf('template')!=-1 || pathname.indexOf('plugin')!=-1){
        // $('a[data-name="/plugin"]').addClass('active');
        $('a[data-name="/app"]').addClass('active');
      }
    }
  }
  // $.each(menuLists,function(i,item){
  //   var name=$(item).data('name');
  //   if(name){

  //   }
  // })
}

//手机端隐藏下拉
$(document).click(function(e) {
  var el = $(".m-user-box")
  if (!el.is(e.target) && el.has(e.target).length === 0) {
    el.find('.drop-menu-wrap').hide();
  }

  var el1 = $('.head-search-container')
  if (!el1.is(e.target) && el1.has(e.target).length === 0) {
    el1.find('.drop-head-search').hide();
  }
})


$(function() {
  function commonSearchFun(params) {
    var searchWrap = $('.head-search-container')
    var searchPageWrap = $('.search-page-wrap')
    searchWrap.click(
      function() {
        $(this)
          .find('.drop-head-search').css({
            display:"flex"
          })
      }
    );
    $(".drop-head-close").click(
      function(e) {
        e.stopPropagation()
        $(this)
          .parents('.drop-head-search').css({
            display:"none"
          })
      }
    );
    function goJump(el) {
      var val = el.val()
      var type = ZK.getQueryVariable('type')
      window.location.href = '/search?keyword=' + (val || '')+'&type='+(type || 'doc')
    }
    searchWrap.find('.a-zk-btn').click(function() {
      goJump(searchWrap.find('input'))
    })
    searchPageWrap.find('.search-btn').click(function() {
      goJump(searchPageWrap.find('.search-input'))
    })

    searchWrap.find('.drop-head-search input').keyup('input', function (event) {
      if (event.keyCode == 13) {
        searchWrap.find('.a-zk-btn').trigger("click");
      }
    });

    searchPageWrap.find('form').keyup('input', function (event) {
      if (event.keyCode == 13) {
        searchPageWrap.find('.search-btn').trigger("click");
      }
    });
  }

  commonSearchFun()
})