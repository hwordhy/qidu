$(function(){ 
        
       //阅读页收藏
                $('.reading .addfav').on('click',function(){
                    $(this).addClass('addfavok').html('已收藏');  
                })    
                
          //阅读页投票+1动画  没票提示
                var ReadMYNum = parseInt($('.free_book .tuijian').attr('rel'));  
                $(".free_book .tuijian").bind('click',function() {     
                     if(ReadMYNum-- == 0){
                         $(this).unbind();
                         alert('卧槽,票用光了!');
                     }else{
                        
                         $.tipsBox({
                        obj: $(this),
                        str: "+1" 
                    });
                     }
                    
                }); 
    
     
    // 字体大 
    $(".reading").delegate(".abig","click",function(){
            var activeFontSize= parseInt($(".reading .con_tent").css("font-size"))/12;
            var activeFH= parseInt($(".reading .con_tent").css("line-height"))/12;
                activeFontSize +=0.1;
                activeFH +=0.1; 
            if ((activeFontSize +=0.1) >2.5){
                activeFontSize = 2.5;
                activeFH = 3.4; 
            } 
		    $(".reading .con_tent").css({"font-size":activeFontSize+"rem",'line-height':activeFH+'rem'});  
	});
    //送花
    $('.shangni').on('click',function(){
        $('.sendflower').show();
        $('.sendflower .downs').addClass('bounceInDown');
    });
    //支付送花
        $('.sendflower .sendfok').on('click',function(){
            var payNum = $('.sendflower h2').find('b').attr('data-rel');
            alert(payNum)
        });
       //关闭支付送花
        $('.sendflower .close').on('click',function(){
            $('.sendflower ').hide();
        });

 
    // 字体 小
    $(".reading ").delegate(".asmall","click",function(){
		var activeFontSize= parseInt($(".reading .con_tent").css("font-size"))/12;
		var activeFH= parseInt($(".reading .con_tent").css("line-height"))/12;
		    activeFontSize -=0.1;
		    activeFH -=0.1; 
            if ((activeFontSize -=0.1) <1.42){
                activeFontSize = 1.42;
                activeFH = 2.8; 
        } 
		    $(".reading .con_tent").css({"font-size":activeFontSize+"rem",'line-height':activeFH+'rem'});  
	}); 
})

 