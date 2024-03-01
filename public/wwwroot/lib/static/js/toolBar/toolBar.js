//工具栏组件
$(function () {
    //p标签输出购物车数量在common.js里的getCartNumber()生成
    $('.tool-bar-warp .tool-bar-common').each(function () {
        var type = $(this).attr('data-type');
        $(this).hover(
            function () {
                if(type!='zk_icon_tb-service'){
                    $('#serviceBtn').find('span').removeClass('zk_icon_tb-service-hover').addClass('zk_icon_tb-service-before')
                }else {
                    $(this).find('span').addClass('zk_icon_tb-service-hover').removeClass('zk_icon_tb-service-before')
                }
                $(this).siblings().removeClass('active');
                $(this).find("span").removeClass(type + "-before");
                $(this).find("span").addClass(type + "-hover");
                $(this).find('.common-dialog-wrap').show();
            }, function () {
                $(this).removeClass('active');
                $(this).find("span").addClass(type + "-before");
                $(this).find("span").removeClass(type + "-hover");
                $(this).find('.common-dialog-wrap').hide();
                Cookies.set('isShowSer',true, {
                    expires: 365,
                    // domain: '.apayun.com',
                });
            }
        );
    });
    //手动去除hover后，下次进入不在显示高l级j提示
    if(Cookies.get('isShowSer')){
        $('#serviceBtnWrap').removeClass('active').find("#serviceBtn span").removeClass('zk_icon_tb-service-hover').addClass('zk_icon_tb-service-before')
    }
    $(document).scroll(function () {
        //由于每个页面的banner高度可能不一致，故暂定650为滚动临界
        if ($(document).scrollTop() > 650) {
            $('#toTopBtn').show().fadeIn();
        } else {
            $('#toTopBtn').hide().fadeOut();
        }
    });
    $('#toTopBtn').click(function () {
        $('html,body').animate({ scrollTop: 0 }, 300);
    });
    // $('#serviceBtn').attr('href',$('#hideUrl').val()+'/service/workorder/create');

    // $('.tool-bar-common').hover(function () {
    //     $(this).find('.common-dialog-wrap').fadeIn()
    // },function () {
    //     $(this).find('.common-dialog-wrap').fadeOut()
    // })


    $('.m-tool-bar').on('click',function () {
        $('.m-content-wrap').toggle()
    })
});