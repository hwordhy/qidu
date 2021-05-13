$(function(){
			
	/* $('.flexslider').flexslider({
		directionNav: true,
		pauseOnAction: false
	}); */
	
	var sf = window._STAFF_FUNCTION || false, sf_c = sf && sf.tools.collect;
	(function(){
		var allTips = {}, tabs = $('#Billboard .a3 .tabs'), list = $('#Billboard .a3 .list');
		new Motie.Tab({
			handle: tabs.find('li'),
			handleClass: "",
			handleCurrentClass: "current",
			toggleItem: list,
			callback: function(index, handle, item){
				var cid = handle.data('cid');
				if(sf && sf_c.createOver){
					if(!allTips[cid]){
						allTips[cid] = $('body .mo-ui-collect-tips[collect-id='+cid+']').each(function(){
							sf_c.position( $(this).data('element'),$(this))
						});
					}
					for(var i in allTips){
						allTips[i].hide();
					}
					allTips[cid].show()
				}
			}
		});
	})()
	
	$('.newbook-rank,.goldbook-rank,.richbook-rank').each(function(){
		var tabs = $(this).find('.tabs2');
		if(tabs.length){
			var allTips = {};
			var list = $(this).find('.list');
			new Motie.Tab({
				handle: tabs.find('li'),
				toggleItem: list,
				handleClass: "",
				handleCurrentClass: "current",
				callback: function(index, handle, item){
					var cid = handle.data('cid');
					if(sf && sf_c.createOver ){
						if(!allTips[cid]){
							allTips[cid] = $('body .mo-ui-collect-tips[collect-id='+cid+']').each(function(){
								sf_c.position( $(this).data('element'),$(this))
							});
						}
						for(var i in allTips){
							allTips[i].hide();
						}
						allTips[cid].show()
					}
				}
			})
		}
	});
	
	
	var tb2 = $(".tabs-content-2");
	new Motie.Tab({
		handle: "#Billboard .a1 .list li",
		handleClass: "",
		handleCurrentClass: "current",
		toggleItem: "#Billboard .a1 .tabs-content",
		auto: !0,
		callback: function(a) {
			tb2.hide().eq(a).show()
		},
		duration: 4e3
	});
	
	new Mo.Tab({
		handle: $('.mod-chapter-update .tabs2 li'),
		handleClass : '',
		handleCurrentClass : 'current',
		toggleItem : $('.mod-chapter-update .list')
	})
})

$(function(){
	$("#a3c .list li").mouseover(function(){
		$(this).addClass("topc").find("#xianshi").css("display","block").next().css("display","none");
		$(this).siblings("li").removeClass("topc").find("#xianshi").css("display","none").next().css("display","block");
		});
	$(".goldbook-rank .list li").mouseover(function(){
		$(this).addClass("topc").find("#xianshic").css("display","block").next().css("display","none");
		$(this).siblings("li").removeClass("topc").find("#xianshic").css("display","none").next().css("display","block");
		});
		
	$("#faq-pc").hover(function(){
		$(".mod-faq").show(100);
	},function(){
		$(".mod-faq").hide();
	});
	
	//cookie
	$('#pop-r').show();	
	var popYue=$.cookie("popYue");
	if(popYue!=null){
		$("#pop-r").hide();
	}
	else{
		$("#pop-r").show();
	}
	$('.closer').click(function(){
		$("#pop-r").hide();		
		$.cookie("popYue", 1, {
			path: "/", expires: 1
		});
	});
	
	/*导航栏*/
	$(".more_nav").hover(function(){
		$(this).addClass("hover_nav");
		$(".more_box").show();
	},function(){
		$(this).removeClass("hover_nav");
		$(".more_box").hide();
	})
	
	$(".more_box").hover(function(){
		$(this).prev(".more_nav").addClass("hover_nav")
		$(this).show();
	},function(){
		$(this).prev(".more_nav").removeClass("hover_nav")
		$(this).hide();
	})
	
	/*登录弹出框*/
	var mLogin = $('.motie-login'), loginDialog = $('.login-dialog');
	var timer = null;
	var clearTimer = function(){
		if(timer){
			clearTimeout(timer);
			timer = null;
		}
	}
	mLogin.hover(function(){
		clearTimer();
		mLogin.addClass("motie-login-w");
		loginDialog.show()
	},function(){
		clearTimer();
		mLogin.removeClass("motie-login-w");
		timer = setTimeout(function(){
			loginDialog.hide();
		},100)
	});
	loginDialog.hover(function(){
		clearTimer();
		mLogin.addClass("motie-login-w");
		loginDialog.show()
	},function(){
		clearTimer();
		mLogin.removeClass("motie-login-w");
		timer = setTimeout(function(){
			loginDialog.hide();
		},50)
	});
	
	$('.motie-login,.pop-login').click(function(){
		if(!Motie.CheckLogin(true)){
			return false
		}
	})
	
	/*微博*/
	var weibo = $('.show-weibo'), weiboDialog = $('.channel-change .weibo');
	var timer = null;
	var clearTimer = function(){
		if(timer){
			clearTimeout(timer);
			timer = null;
		}
	}
	weibo.hover(function(){
		clearTimer();
		weiboDialog.show()
	},function(){
		clearTimer();
		timer = setTimeout(function(){
			weiboDialog.hide();
		},50)
	});
	weiboDialog.hover(function(){
		clearTimer();
		weiboDialog.show()
	},function(){
		clearTimer();
		timer = setTimeout(function(){
			weiboDialog.hide();
		},50)
	});
	
	/*微信*/
	$("#weixin-fixed").hover(function(){
		$(".weixin-pc").show();
	},function(){
		$(".weixin-pc").hide();
	})
	
	$("#weixin").hover(function(){
		$(".w-pop").show();
	},function(){
		$(".w-pop").hide();
	})
	
})
	
