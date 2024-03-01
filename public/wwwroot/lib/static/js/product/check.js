$(function () {
  var $_checkForm = $("#checkForm");
  var $checkBtn = $('#check-btn');
  var $_keyword = $_checkForm.find('input[name="keyword"]')
  function trimStr(str){
    return str.replace(/(^\s*)|(\s*$)/g, "");
  }
  $_keyword.on('change',function(e){
    $(this).val(trimStr(e.target.value))
  })

  $checkBtn.on("click", function () {
    var checkForm = document.getElementById("checkForm");
    var validater = new ZK.validater();
    if (checkForm.keyword) {
      validater.add(checkForm.keyword, [
        {
          strategy: "isNonEmpty",
          errorMsg: "请输入您查询的域名或IP！",
        },
      ]);
    }
    var pass = validater.start();
    if (pass) {
      var dataList = $_checkForm.serializeArray()
      var sendParams = {}
      dataList.forEach(function(item){
        sendParams[item.name] = item.name=="keyword" ? trimStr(item.value) :item.value
      });
      if(!sendParams.keyword){
        return ZK.message.warn('请输入您查询的域名或IP！', 2)
      }
      ZK.post({
        url: "/index/index/checkauth",
        isCoverSuccess: true,
        notLoading: true,
        data: $_checkForm.serialize(),
        success: function (res) {
          var grant = res.Data.grant;
          var type = res.Data.type;
          $(".tip").hide();
          $('.check-url').html(sendParams.keyword)
          if (grant === 1) {
            $(".check-correct").show();
            $(".check-error").hide();
            $(".check-expired").hide()
            var text = ''
            text = '正版'
            $(".check-correct").find('.genuine-img').show();
            $(".system-versoin").text(text)
          } else if(grant === 2){//已过期
            $(".check-error").hide()
            $(".check-correct").hide();
            $(".check-expired").show()
          }else {//未授权
            $(".check-error").show()
            $(".check-correct").hide();
            $(".check-expired").hide()
          }
        },

      });
    }
  })

  // 回车提交表单
  $('.check-input').keydown(function (event) {
    if (event.keyCode == 13) {
      $checkBtn.trigger("click");
      return false;
    }
  });

});