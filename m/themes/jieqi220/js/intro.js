
$(function(){ 
                //     //简介投票+1动画  没票提示
                // var MYNum = parseInt($('.pusgtop .toupiao').attr('rel'));  
                // $(".toupiao").bind('click',function() {
                //     //2017-03-02
                //     $(this).addClass('toup')
                //     setTimeout(function(){
                //         $(".toupiao").removeClass('toup')
                //     },1000);
                //     var goodNum = $('.pusgtop .left h1').find('b');  
                //     var pushtips =$('.pusgtop .pushtips');
                //           goodNum.html(parseInt(goodNum.text())+1);
                //      if(MYNum-- == 1){
                //          pushtips.stop().show().html('卧槽，没票了').addClass('rubberBand');
                //          setTimeout(function(){
                //                 pushtips.stop().hide(); //2秒后关闭
                //                 //再点击提示
                //                $(".toupiao").attr('onclick','$.toupiaoend(this)');
                //                $.toupiaoend = function toupiaoend(obj) {   
                //                      pushtips.stop().show();  
                //                      setTimeout(function(){
                //                          pushtips.stop().hide();   //2秒后关闭
                //                      },2000)
                //             }  
                               
                //          },2000);
                //          $(this).unbind();
                //      }
                //     $.tipsBox({
                //         obj: $(this),
                //         str: "+1",
                //         callback: function() {
                //       /*回调*/
                //         }
                //     });
                // });
             
                //打赏按钮
                    $(".dashang").bind('click',function() {
                    $(this).css('background','#fe9d06');
                    setTimeout(function(){
                        $(".dashang").css('background','url(images/tjs.png) repeat-x center center');
                    },1000);  
                });
           //简介展开 2017-03-02
                $('.book_info .downshow').on('click',function(){
                    $(this).toggleClass('up');
                    $('.book_info .intro .con_con').toggleClass('show');
                }) 
                $('.book_info .con_con').on('click',function(){ 
                    $('.book_info .downshow').toggleClass('up');
                    $(this).toggleClass('show');
                }) 
      //简介页收藏
                // $('.book_info .intro .intro_fav').on('click',function(){
                //     $(this).addClass('intro_fav_ok').html('已收藏');  
                // });    
     // //评论区 点赞    
     //            $.favs = function favs(obj) {    
     //                        var favok = $(obj).attr('class');
     //                        if(favok == "fav favok"){
     //                             alert('您已经点过赞了!');   
     //                        }else{  
     //                            $(obj).addClass('favok');                            
     //                            $(obj).siblings('.report').css('color','#ccc').attr('rel','');
     //                            $(obj).css('color','#ababab');
     //                            $(obj).html(parseInt($(obj).text())+1);  //改变增加收藏数      
     //                        } 

     //              }  

           // //评论区 举报    
           //      $.report = function report(obj) {     
           //            var repots = $(obj).attr('rel');
           //             if(repots == 1){
           //             alert('你已经点过举报了!');    
           //             }else{ 
           //              $(obj).css('color','#46aef0').attr('rel','1');
           //              $('.favok').css('color','#ccc');
           //              $(obj).siblings('.fav').removeClass('favok'); 
           //              $(obj).siblings('.fav').html(parseInt($(obj).siblings('.fav').text())-1); //改变减少收藏数           
           //             }
   
           //   }  
                 function bodys(){
                     $('body,html').css({'overflow':'hidden'}); 
                 }
                 function bodysno(){
                     $('body,html').css({'overflow':'auto'});
                 }
                //2017-03-02
                $('.giftclose,.shareclose').on('click',function(){
                    $('.newgift,.newshare').hide();
                     bodysno();
                });
                 //打开分享
                $('.pusgtop .right').on('click',function(){
                    bodys()
                    // $('.newshare').show();
                    $('.sharebg').show();
                });
                // // //收藏
                // $('.fixedbot .center').on('click',function(){
                //     $(this).find('b').addClass('sok'); 
                //     $(this).find('em').html('已收藏'); 
                // });
                //打开评论
              $('.fixedbot .left').on('click',function(){
                  $('.fixedbot').stop().animate({
                      'bottom':'-5rem'
                  },300);
                  $('.newcomment').stop().animate({
                      'bottom':'0'
                  },300);
              })
                   var ua = navigator.userAgent.toLowerCase();	
                         if (/iphone|ipad|ipod/.test(ua)) { 
                             $('body,html').css({'cursor':'pointer','-webkit-tap-highlight-color':'transparent','tap-highlight-color':'transparent'})    //解决苹果不支持 e.target问题
                         }
                //关闭评论框
                $('body,html').on('click',function(e){
                      if($(e.target).eq(0).is($('.newcomment')) || $(e.target).eq(0).is($('.newcomment .newcom'))  || $(e.target).eq(0).is($('.newcomment .right b'))  || $(e.target).eq(0).is($('.fixedbot .left'))   || $(e.target).eq(0).is($('.fixedbot .left b')) ){
                          return;
                      }
                    $('.fixedbot').stop().animate({
                          'bottom':'0'
                      },300);
                  $('.newcomment').stop().animate({
                      'bottom':'-10rem'
                  },300);
                })
                $('.newcomment .newcom').focus(function(){ 
                     if (/iphone|ipad|ipod/.test(ua)) { 
                             $('.newcomment').css({'bottom':'0','height':'9rem'});  
                         }
                })
                $('.newcomment .newcom').blur(function(){ 
                     if (/iphone|ipad|ipod/.test(ua)) { 
                             $('.newcomment').css({'bottom':'0','height':'4rem'}); 
                         }
                })
                //发布评论
               //   var   com_alertH5 = $('.com_alert h5'); 
               //  $('.newcomment .right b').on('click',function(){ 
               //     var ComVal = $('.newcomment .newcom');
               //      if(ComVal.val().trim().length < 5){
               //          alert('请输入5个字以上的评论内容')
               //          ComVal.focus();
               //      }else{
               //          $('.com_alert').show();
               //          $('.com_alert .puss').hide();
               //          com_alertH5.show();
               //          com_alertH5.find('b').html('评论成功!');  /*如果不成功：评论失败!*/
               //          //2秒后关闭弹框
               //          setTimeout(function(){
               //              $('.com_alert').hide();
               //          },2000); 
               //           ComVal.val('')
               //           $('.fixedbot').stop().animate({
               //                'bottom':'0'
               //            },300);
               //            $('.newcomment').stop().animate({
               //                'bottom':'-10rem'
               //            },300);
                        
               //      }
                     
               // });

                 //打开打赏
                $('.pusgtop .center,.godbook .gright').on('click',function(){
                    bodys()
                    $('.newgift').show();
                });
               //  //选择ICON
               //  var Golds = $('.newgift .active').attr('rel'),Gnum = $('.newgift .numlist .active').attr('rel'),userGold,TotalNum;
               // $('.newgift li').on('click',function(){
               //     $(this).addClass('active').siblings().removeClass('active'); 
               //       Golds= $(this).attr('rel'); 
               // });
               //  //数量
               // $('.newgift .numlist b').on('click',function(){
               //     $(this).addClass('active').siblings().removeClass('active'); 
               //       Gnum= $(this).attr('rel'); 
               // });
               //  //打赏
               // $('.numlist .ndashang').on('click',function(){
               //      TotalNum = parseInt(Golds*Gnum);                 
               //       userGold = $('.newgift .infogift').attr('user-rel'); 
               //       if(TotalNum > userGold){
               //           $('.newgift .noicon b').show();
               //       }else{
               //           $('.newgift .noicon b').hide(); 
               //           $('.newgift').hide();
               //       }
               // });

})

 