$(function () {

  var userWidth = window.screen.width;
  var userHeight = window.screen.height;

  $('#userBrowerSize').val(userWidth + 'x' + userHeight);
  $('#m-userBrowerSize').val(userWidth + 'x' + userHeight);

  var redirect = ZK.getQueryVariable("redirect")
  $('#redirectInput').val(redirect);
  $('#m-redirectInput').val(redirect);


  $('#loginBtn').on('click', function () {
    var $_this = $(this);
    if ($_this.hasClass('disabled')) {
      return false;
    }
    var loginForm = document.getElementById('loginForm');
    var $_loginForm = $('#loginForm');
    validaterFn(loginForm, $_loginForm, $_this)

  });
  //移动端登录验证
  $('#m-loginBtn').on('click', function () {
    var $_this = $(this);
    if ($_this.hasClass('disabled')) {
      return false;
    }
    var loginForm = document.getElementById('m-loginForm');
    var $_loginForm = $('#m-loginForm');

    validaterFn(loginForm, $_loginForm, $_this)
  });

  // 提示密码输入框大写锁定开启功能
  var detectCapsLock = function (t) {
    var e = t.keyCode || t.which,
      i = t.shiftKey || 16 == e || !1;
    return (e >= 65 && 90 >= e && !i) || (e >= 97 && 122 >= e && i) ? !0 : !1;
  };
  var $_capsLockRemind = $('#capsLockRemind');
  $('#password')
    .keypress(function (e) {
      detectCapsLock(e) ? $_capsLockRemind.show() : $_capsLockRemind.hide();
    })
    .blur(function () {
      $_capsLockRemind.hide();
    });

  // 滑动验证

  function validaterFn(loginForm, $_loginForm, $_this) {
    var validater = new ZK.validater();
    if (loginForm.account) {
      validater.add(loginForm.account, [
        {
          strategy: 'isNonEmpty',
          errorMsg: '登录账户不能为空!',
        },
        {
          strategy: 'isCustomize',
          errorMsg: '',
          callback: function (value) {
            if (ZK.regEx.mobileRegEx.test(value)) {
              return true;
            } else if (ZK.regEx.eMailRegEx.test(value)) {
              return true;
            } else {
              //ZK.message.warn('账号格式错误!', 1.5);
              return true;
            }
          },
        },
      ]);
    }
    if (loginForm.password) {
      validater.add(loginForm.password, [
        {
          strategy: 'isNonEmpty',
          errorMsg: '密码不能为空！',
        },
      ]);
    }
    if (loginForm.mobile) {
      validater.add(loginForm.mobile, [
        {
          strategy: 'isNonEmpty',
          errorMsg: '手机号码不能为空！',
        },
        {
          strategy: 'isMobile',
          errorMsg: '手机号码格式不正确',
        },
      ]);
    }
    if (loginForm.vcode) {
      validater.add(loginForm.vcode, [
        {
          strategy: 'isNonEmpty',
          errorMsg: '验证码不能为空！',
        },
      ]);
    }
    var pass = validater.start();
    if (pass) {
      var url = '/User/Login';
      if (loginForm.vcode) {
        url = '/User/MobileLogin';
      }
      ZK.post({
        url: url,
        isCoverSuccess: true,
        notLoading: false,
        data: $_loginForm.serialize(),
        success: function (res) {
          if (res.code === 200) {
            ZK.message.success('登录成功', 1, function () {
              // 登陆后跳转回原来页面
              window.location.href = '/User/Index';
            });
          } else {
            ZK.message.warn(res.msg || '操作失败', 1.2);
            
          }
        },
        error: function () {
          $_this.removeClass('disabled');
        },
      });
    }
  }
  // 移动端无须验证码发送短信
  $("#m-loginGetSms").on("click", function () {
    var $_this = $(this);
    var $_loginForm = $("#m-loginForm");
    if ($(this).hasClass("disabled")) {
      return false;
    }
    var mobileDom = $("input[name='mobile']")[1];
    var validater = new ZK.validater();
    validater.add(mobileDom, [
      {
        strategy: "isNonEmpty",
        errorMsg: "手机号码不能为空！",
      },
      {
        strategy: "isMobile",
        errorMsg: "手机号码格式不正确",
      },
    ]);
    var pass = validater.start();
    if (pass) {
      var $_mobile = $("#mobile");
      ZK.post({
        url: $("#m-loginGetSms").data("url"),
        data: $_loginForm.serialize(),
        success: function (res) {
          if (res.code == 200)
          {
            ZK.message.success("验证码已发送，请注意查收", 1.2);
            countdown("#m-loginGetSms");
          }
          else
          {
            countdown("#m-loginGetSms",true);
            ZK.message.warn(res.msg || "操作失败", 1.2);
          }
        },
      });
    }
  });
  function countdown(el,isRemoveDisabled) {
    var $_this = $(el);
    var time = 60;
    if(isRemoveDisabled){
      return $_this.removeClass("disabled");
    }
    $_this.addClass("disabled");
    var st = setInterval(function () {
      $_this.html(time + "秒后重新获取");
      time--;
      if (time === 0) {
        clearInterval(st);
        $_this.html("重新获取验证码");
        $_this.removeClass("disabled");
      }
    }, 1000);
  }

});