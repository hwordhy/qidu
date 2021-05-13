//点击+1动画
(function($) {
            $.extend({
                tipsBox: function(options) {
                    options = $.extend({
                        obj: null,  //jq对象，要在那个html标签上显示
                        str: "+1",  //字符串，要显示的内容;也可以传一段html，如: "<b style='font-family:Microsoft YaHei;'>+1</b>"
                        startSize: "12px",  //动画开始的文字大小
                        endSize: "30px",    //动画结束的文字大小
                        interval: 600,  //动画时间间隔
                        color: "red",    //文字颜色
                        callback: function() {}    //回调函数
                    }, options);
                    $("body").append("<span class='num'>"+ options.str +"</span>");
                    var box = $(".num");
                    var left = options.obj.offset().left + options.obj.width() / 2;
                    var top = options.obj.offset().top - options.obj.height();
                    box.css({
                        "position": "absolute",
                        "left": left + "px",
                        "top": top + "px",
                        "z-index": 9999,
                        "font-size": options.startSize,
                        "line-height": options.endSize,
                        "color": options.color
                    });
                    box.animate({
                        "font-size": options.endSize,
                        "opacity": "0",
                        "top": top - parseInt(options.endSize) + "px"
                    }, options.interval , function() {
                        box.remove();
                        options.callback();
                    });
                }
            }); 
      
})(jQuery);
$(function(){ 

            //关闭公告、评论弹框
            $('.notice_down .close,.com_alert .contxt .close').on('click',function(){ 
                $('.notice_down,.com_alert').hide(); 
                $('.com_alert .contxt textarea').val(''); 
                $('.com_alert .contxt h6').html(''); 
            })
            //评论框
            var   com_alertH5 = $('.com_alert h5');
            var   contxtPuss = $('.com_alert .contxt .puss');

              //输入框 
            var winIH = window.innerWidth;
            $('.com_alert .puss  textarea').focus(function(){ 
                $('.com_alert .container').css({'bottom':'0','padding-bottom':winIH/10}); 
            }) 
            $('.com_alert .puss  textarea').keydown(function(){  
                $('.com_alert .container').css({'bottom':'0','padding-bottom':winIH/10}); 
            })

             //打开评论框
            function openAlert(){
                    $('.com_alert,.com_alert .contxt .puss').show();
                    com_alertH5.hide();
                    $('.com_alert .downs').addClass('bounceInDown');
                    $('.com_alert .contxt textarea').val(''); 
            }
            //简介页打开评论
            $('.wapcomment .publish').on('click',function(){
                    $('.com_alert,.com_alert .contxt .puss').show();
                    com_alertH5.hide();
                    $('.com_alert .downs').addClass('bounceInDown');
                  $('.com_alert .contxt textarea').val(''); 
            })
            //回复页打开评论
            $('.details .comto').on('click',function(){
                        var replyname =  $(this).parents('li').children('h3').children('span').children('.replyname').text(); 
                        //打开评论框
                        openAlert();
                        $('.com_alert .downs textarea').val('回复'+replyname+'  ');
            });
    //尾部满屏
            var winHeight = $(window).height();//是文档窗口高度
            var footerTop = $(".footer").offset().top//是标签距离顶部高度
            var footerHeight = $(".footer").height();//是标签高度
            $('.footer').css('padding-bottom',winHeight-footerTop-footerHeight); 
             /*密码查看*/
         $('.reg .eye').on('click',function(){
          $(this).toggleClass('eyeopen');
          var typeZhi =  $('.input_password').attr('type');
             if(typeZhi=='password'){
                 $('.input_password').attr('type','text');
             }else{
                 $('.input_password').attr('type','password');
             }
         });
})

 