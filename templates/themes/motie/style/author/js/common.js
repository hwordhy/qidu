/*
 $('.orthertext').click(function(){
 $(this).next('.entries').css('width','100%')
 $(this).hide();
 });

 $('.newslist ul li a').on('mouseover',function(){
 $(this).find('.dot').addClass('rdot');
 }).on('mouseleave',function(){
 $(this).find('.dot').removeClass('rdot');
 });
 $('body').on('click','.n-del,.p-confirm',function(){
 console.log('123');
 var halfWidth =-($('.popbox').outerWidth()/2);
 var halfheight = -($('.popbox').outerHeight()/2);
 console.log(halfheight);
 $('.discover').show();
 $('.popbox').show(function(){
 console.log('1223');
 $(this).css({'margin-left':halfWidth,'margin-top':halfheight});
 });
 });
 $('body').on('click','.p-del,.p-confirm',function(){
 $('.discover').hide();
 $('.popbox').hide();
 });*/
var popUp = (function () {
    var mod = {};
    mod.openLoading = function (text) {
        mod.close();
        layer.open({
            type: 3,
            content: '<div class="layer_loading"><span class="gif"></span><span class="text">' + text + '</span></div>',
            shade: 0,
            shift: -1
        });
    };
    mod.openTips = function (text, time) {
        time = time || 3000;
        mod.close();
        layer.open({
            type: 3,
            content: '<div class="layer_loading"><span class="text">' + text + '</span></div>',
            shade: 0,
            time: time,
            shift: -1
        });
    };
    mod.close = function () {
        layer.closeAll();
    };
    mod.openNotice_new = function (option) {
        var $notice = $('.notice-msg');
        $notice.show();
        $('.alert-bg').show();
        t1 = option.t1 || '';
        t2 = option.t2 || '';
        t3 = option.t3 || '';
        if (option.right == 'right') {
            $notice.find('.icon').removeClass('wrongicon').addClass('righticon');
        } else {
            $notice.find('.icon').removeClass('righticon').addClass('wrongicon');
        }
        $notice.find('.text1').text(t1);
        $notice.find('.text2').text(t2);
        $notice.find('.text3').text(t3);
        $notice.find('.closebtn').on('click', function () {
            $notice.hide();
            $('.alert-bg').hide();
            option.callback && option.callback();
        })
    };

    return mod;
})();


var common_service = {
    getPicCode: function (objImg, t) {
        // 获取验证码
        if (!t) {
            t = Math.ceil(Math.random() * 1000000000000);
        }
        $(objImg).attr("src", "/ajax/auth/code?t=" + t);
        $(objImg).attr("data-t", t);
    },
    sendCode: function (data) {
        return $.ajax({
            data: data,
            type: 'POST',
            url: '/author_area/ajax/auth/sendsms',
        })
    },
    changePhone: function (data) {
        return $.ajax({
            url: ' /author_area/author/mobile/edit',
            data: data,
            type: 'POST'
        })
    },
    modifyInfo: function (data) {
        return $.ajax({
            url: '/author_area/author/detail/edit',
            data: data,
            type: 'POST'
        })
    },
    updateContact: function (data) {
        return $.ajax({
            url: '/author_area/author/detail/contractUpd',
            data: data,
            type: "POST"
        });
    },
    confirmSlave: function (data) {
        return $.ajax({
            url: '/author_area/bind/confirmSlave',
            data: data,
            type: 'POST'
        })
    }

};
