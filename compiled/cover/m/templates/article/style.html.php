<?php
echo '
<?xml version="1.0" encoding="'.$this->_tpl_vars['jieqi_charset'].'"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>'.$this->_tpl_vars['jieqi_pagetitle'].'</title>

    <meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'" />
    <meta name="keywords" content="'.$this->_tpl_vars['meta_keywords'].'">
    <meta name="description" content="'.$this->_tpl_vars['meta_description'].'">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="MobileOptimized" content="320">
    <meta http-equiv="cleartype" content="on">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <link  rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/core.css" media="all" />
    <link rel="shortcut icon" href="'.$this->_tpl_vars['jieqi_url'].'/favicon.ico" type="image/x-icon" />
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/mobile_index.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery.lazyload.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/layer.js"></script>
    <script type="text/javascript">
        $(function() {
            //$(\'._ih\').remove();
            $(\'body > *:not(".wrapper") \').remove();
            //字体变化
            var min=9;
            var max=18;
            var reset = parseInt($(\'.intro\').css(\'fontSize\'));
            var _bg = $(\'body\').css(\'background\');
            var elm = $(\'.intro\');
            var fontSize=$.cookie("fontSize");
            var size = reset;
            $(\'.intro\').css("font-size",fontSize+"px");
            $(\'a.fontSizePlus\').click(function() {
                if (size<=max) {
                    size++;
                    $.cookie("fontSize",size, {
                        path: "/", expires: 7
                    });
                    elm.css({\'fontSize\' : size});
                }
                return false;
            });

            $(\'a.fontSizeMinus\').click(function() {
                if (size>=min) {
                    size--;
                    $.cookie("fontSize",size, {
                        path: "/", expires: 7
                    });
                    elm.css({\'fontSize\' : size});
                }
                return false;
            });

            $(\'a.fontBulb\').click(function () {
                var _changColor=$(\'a.fontBulb\');
                $(\'a.fontBulb\').toggleClass(\'changColor\');
                if(_changColor.hasClass(\'changColor\')){
                    $(\'#css_id\').attr(\'href\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/css/chapter_black.css\');
                    $(\'a.fontBulb\').find(\'img\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_bulb_black_ico.png\');
                    $(\'.font_list a.prev\').find(\'img\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_prev_black_ico.png\');
                    $(\'.font_list a.next\').find(\'img\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_next_black_ico.png\');
                    $(\'.font_list a.center\').find(\'img\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_book_black_ico.png\');
                    $(\'.app_down_mod a.l\').find(\'img\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_down_ios.png?v=2\');
                    $(\'.app_down_mod a.r\').find(\'img\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_down_android.png\');
                    $.cookie("fontBulb",\'changBg\', {path: "/", expires: 7 });

                }else{
                    $(\'#css_id\').attr(\'href\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/css/chapter_red_new.css\');
                    $(\'.font_list a.prev\').find(\'img\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_prev_ico.png\');
                    $(\'.font_list a.next\').find(\'img\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_next_ico.png\');
                    $(\'.font_list a.center\').find(\'img\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_book_ico.png\');
                    $(\'a.fontBulb\').find(\'img\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_bulb_ico.png?v=2\');
                    $(\'.app_down_mod a.l\').find(\'img\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_down_ios_new.png?v=1\');
                    $(\'.app_down_mod a.r\').find(\'img\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_down_android_new.png?v=2\');
                    $.cookie("fontBulb",\' \', {path: "/", expires: 7});
                }
                return false;
            });

        });
    </script>
    <style>
    body{
    	background:#fff;
     
    }
    
    
    
        .chapter_link{padding:0 15px 15px;font-size:14px;line-height:20px;overflow:hidden}.chapter_link a{color:#333;display:block}.chapter_link b{color:#000}.chapter_link span{color:#d93636}.txtbox-item h3 img{vertical-align:middle;padding-right:10px}.rew-li-r .rew-time .zan{display:block;position:absolute;top:5px;width:20px;right:10px}.intro .chapter{padding-bottom:10px;margin:0 15px;position:relative;padding-right:20px}.intro .chapter i{position:absolute;text-indent:0;font-style:normal;width:12px;height:12px;display:block;border-radius:50%;right:-8px;bottom:6px;text-align:center;cursor:pointer;font-size:12px;color:#fff;line-height:12px}.intro .chapter i.red{width:22px;height:22px;line-height:22px;right:-10px;color:#fff;font-size:12px;bottom:1px}.zan.gray{color:#666;padding-top:12px;background:url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/zan_ico.png) no-repeat top center}.zan.red{background:url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/zan_hover_yq_ico.png) no-repeat top center;color:#f7a4a4;padding-top:12px}.intro .chapter i.gray{width:12px;height:12px;line-height:22px;color:#d7d7d7;font-size:12px}.review li{border-bottom:dashed 1px #dfdfdf;line-height:25px;padding:5px 0}.review li:last-child{border-bottom:0}.txtbox-item{margin:0}.detail_zx{margin-top:0;border-top:solid 1px #ddd;border-bottom:solid 1px #ddd;border-left:none;padding:0;border-right:0;overflow:hidden}.review-h2{font-weight:bold;background:#fff;position:relative;border:solid 1px #eee;border-left:solid 3px #419bf5;border-bottom:0;padding-left:12px;line-height:38px}.review-h2 .write-rew{color:#ff7c1b;font-size:12px;position:absolute;top:0;right:10px}.review-ul{padding:0 10px;overflow:hidden}.review-ul li{display:-moz-box;display:-webkit-box;display:box;width:100%;border-bottom:dashed 1px #ccc;margin-bottom:5px;padding-bottom:10px}.review-mg{margin-top:12px;display:block}.rew-li-l{padding:2px 10px 0 0;overflow:hidden}.rew-li-l img{width:30px;height:30px;border:solid 1px #ddd;border-radius:50%}.rew-li-r{position:relative;-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;font-size:12px;color:#999;overflow:hidden}.rew-li-r .tit{display:block;font-size:14px;color:#333;line-height:22px;position:relative;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.rew-li-r .tit a{color:#333}.rew-li-r .tit .jinghua-ico{position:absolute;top:-2px;right:0}.jinghua-ico img{width:36px}.rew-li-r .text{display:block;line-height:18px;padding-right:30px;color:#999;overflow:hidden}.rew-li-r .rew-time{display:block;width:100%;height:30px;position:absolute;text-align:center;top:-2px;right:-10px;min-height:30px}.rew-time img{display:block}.rew-time b{font-weight:lighter}.reply-form{float:left;width:85%}.reply-form input{height:30px;width:98%;line-height:30px;border-radius:3px;border:solid 1px #ccc}input::-webkit-input-placeholder{color:#999;padding-left:5px;font-size:12px}input::-moz-input-placeholder{color:#999;padding-left:5px;font-size:12px}.reply-input{float:right;width:15%}.reply-input-r{-webkit-appearance:none;outline:0;background:0;color:#333;height:30px;line-height:32px;border:0;width:100%;font-weight:bold;text-align:center}#reply{margin-top:10px}#reply .page_box{width:100px;margin:0 auto;height:30px}#reply .prevPage,#reply .nowPage,#reply .nextPage{float:left}#reply .prevPage{width:21px;height:20px;background:url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/prev_page_ico.png) no-repeat top center}#reply .nextPage{width:21px;height:20px;background:url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/next_page_ico.png) no-repeat top center}#reply .nowPage{padding:0 10px;text-align:center;font-size:12px;color:#666;line-height:20px}#reply .prevOn{background:url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/prev_on_page_yq_ico.png) no-repeat top center}#reply .nextOn{background:url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/next_on_page_yq_ico.png) no-repeat top center}.C_item{padding:12px 0 0 0;margin:0 0 10px;position:relative;overflow:hidden}.C_item .top_ico{position:absolute;top:-6px;right:8px}#C_line{height:10px;border-top:solid 1px #ddd}#replySubmit{display:block;padding:0 10px 10px;overflow:hidden}.alert a{width:50px!important}a.alert-ok{right:65px!important}a.alert-d{top:15px!important}.wx_box{position:relative}#showLayer{background:rgba(0,0,0,.7);display:none;width:100%;height:100%;position:absolute;z-index:9;top:0;left:0}.chapter-layer{width:260px;position:absolute;bottom:220px;left:50%;margin-left:-130px;font-size:14px;background:#fff;color:#333;z-index:10;border-radius:10px;display:none}.link_reader a{width:116px;margin:0 auto 15px;text-align:center;background:#f7a4a4;color:#fff;display:block;border-radius:3px;height:30px;line-height:30px}.media-ul{padding:0!important}.media-ul li{border-top:solid 1px #eee;padding:10px;font-size:16px;line-height:32px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden}.media-ul li a{display:-moz-box;display:-webkit-box;display:box}.media-ul li p{-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;line-height:20px;font-size:14px;white-space:normal!important;padding-top:5px;word-break:break-all;word-wrap:break-word}.media-ul .media-pc{padding-left:20px;width:48px;height:48px}.media-ul li span{display:block}a.bc_gray{background:#dfdfdf;color:#666!important;padding:3px 8px;border-radius:3px}.mgb_r{margin-right:15px}.font_c{text-align:center}.font_g{color:#666}.demo{word-wrap:break-word}.demo .chapter-b{overflow:hidden;clear:both}.demo .font-nav{height:30px;float:right;font-size:14px;text-align:right;margin:5px 10px 10px}.demo .font-nav span{margin:0 15px}.demo .font-nav a{color:#999}.demo p{color:#5e5e5e;line-height:32px;margin:0}.media-box{position:relative;overflow:hidden}.media-box img{width:100%}.media-box p{position:absolute;width:100%;bottom:0;left:0;background:#000;opacity:.5;padding:5px;font-size:14px;line-height:20px;color:#fff}.alert-c{padding:7px 0 0;margin:0 15px!important;border:0;position:relative;font-size:16px;font-style:italic}.alert-c span{display:block;line-height:24px}.alert-b{background:#fef7e3;padding:7px 10px;border:0;position:relative;font-size:14px}.font_cc{margin-top:4px;float:left}.font_cc a.bc_gray{font-size:14px;color:#999!important}.font_cc .mgb_r{margin-right:4px}.chapter-layer .title{background:#eee;height:34px;line-height:34px;padding-left:10px;color:#333;border-radius:10px 10px 0 0}.chapter-layer .tit{padding:10px 0;text-align:center;font-weight:bold}.chapter-layer p{padding:0 10px}.chapter-layer .but{text-align:center;padding:10px 0 15px;overflow:hidden}.chapter-layer .but a{padding:0 14px;display:inline-block}.chapter-layer .but a.close{height:28px;line-height:28px;margin-right:15px;background:#dfdfdf;color:#aaa}.chapter-layer .but a.href{height:30px;line-height:30px;background:#39f;color:#fff}.font_c{position:relative;height:30px}.font_c a{display:block;position:absolute}.font_c a.prev{top:16px;left:30px}.font_c a.next{top:16px;right:30px}.font_c a.center{left:50%;right:0;width:36px;text-align:center;margin-left:-18px}#search_more{text-align:center;height:20px;padding:100px 0}.ui-popup,.ui-dialog-header{width:260px}.ui-dialog-title{padding-bottom:0}.demo .font-change a{width:32px;height:24px;display:inline-block;border-radius:3px;line-height:24px;text-align:center;color:#fff}.txtbox-item h3{text-align:left;margin:0 15px 10px;padding:15px 0;font-size:16px}.font_list{padding-top:15px;overflow:hidden}.font_list a{font-size:16px}.fontBulb img{width:8px;vertical-align:middle}.font_list .next img,.font_list .prev img{width:8px}.font_list .center img{width:20px}.chapter_spread{margin:10px 15px 20px;font-size:12px;border-radius:5px;overflow:hidden}.chapter_spread ul{padding:0 10px}.chapter_spread li{position:relative;line-height:40px;padding:15px 60px 15px 0;margin-bottom:10px;overflow:hidden}.chapter_spread li .li_a{padding-bottom:5px;display:block;display:-moz-box;display:-webkit-box;display:box;color:#333;overflow:hidden}.chapter_spread li a span{display:block}.chapter_spread li a span.l{padding:0 10px}.chapter_spread li a span.l img{width:50px;height:50px}.chapter_spread li a span.r{-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;font-size:12px;color:#999;height:50px;line-height:16px;overflow:hidden}.chapter_spread li a span.r b{display:block;font-size:14px;padding-bottom:3px;font-weight:normal}.chapter_spread li .attendBtn{position:absolute;top:30px;right:10px;display:block;width:40px;height:24px;line-height:24px;text-align:center;border-radius:3px;background:#d93636}.chapter_spread li .attendBtn a{color:#fff;font-style:normal}.first_div{border-bottom:solid 1px #ddd}.first_div a{margin:10px;display:block;position:relative}.first_div img{display:block;width:100%}.first_div a span{text-overflow:ellipsis;white-space:nowrap;overflow:hidden;background:#333;position:absolute;bottom:0;left:0;opacity:.7;width:100%;height:34px;line-height:34px;color:#fff;font-size:14px;font-weight:bold}.chapter_ma{margin:25px 15px 15px;padding:15px 0;border:solid 1px #d1c4c4;text-align:center;position:relative;font-size:14px}.chapter_ma img{width:90%;max-width:260px}.chapter_ma p{margin-top:5px}.chapter_ma span{display:block;position:absolute;width:220px;top:-13px;left:50%;margin-left:-110px}.intro div{padding:0 15px 10px}.app_down_mod{text-align:center;padding:10px 0 5px;height:36px;position:relative;overflow:hidden}.app_down_mod a{position:absolute;display:block;font-size:15px;line-height:32px;top:15px;width:35%;border-radius:4px}.app_down_mod img{vertical-align:middle;width:16px}.chapter-content{line-height:1.75em}.app_down_mod a.l{left:30px}.app_down_mod a.r{right:30px}
    </style>
    <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/chapter_red_new.css" id="css_id" type="text/css">
    <style>.chapter_ma{color:#333;}</style>
    <style>
    	.intro {
    		line-height: 2.4;
    	}
    </style>
    <!--[if IE]>
    <link href="" rel="stylesheet" type="text/css" />
    <![endif]-->
</head><!-- 有缓存的情况下 黑夜-->
<!-- 有缓存的情况下 白日-->
<body>
	
	

	
<div class="wrapper">
    <style>
        .wx_nav_box1{background:#fff!important;position:relative;height:44px}
        .wx_nav_box1 a.logo{text-align:center;display:block;font-size:18px;line-height:44px;}
        .wx_nav_box1 .wx_home1{position:absolute;left:10px;top:0;width:80px;height:44px;line-height:44px;}
        .wx_nav_box1 .wx_home1 a{height:42px;display:inline-block}
        .wx_home1 img{width:9px;margin-top:14px;float:left;}
        .wx_home1 em{
            float:left;
            margin-left:10px;
            color:#666;
            font-size:16px;
        }
        .wx_nav_box1 a{color:#010101}
        .wx_nav_box1 .wx_list{position:absolute;right:0;top:0;width:40px;}
        .wx_list1 img{width:30px;display:block;margin-top:7px;border-radius:50%;}
        .wx_header1{overflow:hidden}
    </style>
    <!-- header start -->
    <div id="hd" class="wx_header">
        <div class="wx_nav_box1">
            <div class="wx_home1">
                <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info',$this->_tpl_vars['articlecode']).'">
                    <img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/14882778674532908_18_33.png" />
                </a>
            </div>
            <a class="logo" href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info',$this->_tpl_vars['articlecode']).'">'.$this->_tpl_vars['chaptername'].'</a>
            <div class="wx_list" id="wx_list"></div>
        </div>
    </div>
    
    
    
    	         	<div id="peocessing3" style="width:100%; display:none; position:fixed; top:0px; text-align:center;height:100%; background:#fff; padding-top:20%;filter:alpha(opacity=80); -moz-opacity:0.8; z-index:99999999;  -khtml-opacity: 0.8;  opacity: 0.8;  ">
初始化中..稍等片刻
	</div>
    
    
    
    <!--end header--><div class="wx_box">
    <div id="bd" class="txtbox-item" style="border:none;">
        <style type="text/css">
            .alert{background:#fef7e3;padding:7px 10px;margin:0 !important;border:none;position:relative;}.alert img{vertical-align:middle}
            .alert a{display:block;position:absolute;right:6px;top:5px;width:70px;background:#419af4;color:#fff;text-align:center;border-radius:3px;padding:2px 0;}
        </style>
        <div class="chapter-content" onselectstart="return false"
             ondragstart="return false" oncopy="return false;"
             oncut="return false;">
            <div class="demo">
                <div class="chapter-b">
                    <div class="font-nav1">
                        <a href="/" title="">首页</a>
                        <span>|</span>
                        <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info',$this->_tpl_vars['articlecode']).'"" >书页</a>
                        <span>|</span>
                        <a href="'.$this->_tpl_vars['jieqi_url'].'/userdetail.php" >个人中心</a>
                        <span>|</span>
                        <a href="javascript:addbookcase();" rel="nofollow">加入书架</a>
                        <span>|</span>
                        <a href="javascript:setyy();" rel="nofollow">设置</a>
 
                    </div>
                
<div style="width:100%;">
 
<div id="xxxx"></div>
<script type="text/javascript">
	function getarticle(per){
		console.log(per);
		$.ajax({
        type: "GET",
        url : "http://www.novelrd.cn/r.php?a='.$this->_tpl_vars['articleid'].'&b='.$this->_tpl_vars['chapterid'].'",
		data: {
			per:per,
		},
		beforeSend:function () {
		document.getElementById("peocessing3").style.display="block";
		},
		success: function(ok){
		if(ok){
			console.log(ok);	
			document.getElementById("xxxx").innerHTML=ok;
		}
		},
		complete:function(){
		document.getElementById("peocessing3").style.display="none";
		}
		});
	}
//默认加载的时候，先读取系统的是不是有这个值，有的话就加载，没有的话就设定0
var sp=window.localStorage.getItem("per");
 if(sp){
 getarticle(sp);
//console.log(sp); 
 }else{
 getarticle(0);	 
 }
 
 
function re(per){
	//localstorage设定
	//alert(per);
	var music_btn = document.getElementById(\'music_btn01\');
	if(per==1){
		alert("设定男音成功，请点击播放聆听。");
	} 
	if(per==0){
		alert("设定女音成功，请点击播放聆听。");
	} 
	if(per==3){
		alert("设定逍遥音成功，请点击播放聆听。");
	} 
	if(per==4){
		alert("设定丫丫音成功，请点击播放聆听。");
	} 
	window.localStorage.setItem("per",per);
	music_btn.src = \'http://www.novelrd.cn/play.png\';
	getarticle(per);
	document.getElementById(\'setyy\').style.display="none";
}
function bf(i){
 var audio = document.getElementById(\'music\'+i); 
 var music_btn = document.getElementById(\'music_btn01\');
 if(audio!==null){             
    //检测播放是否已暂停.audio.paused 在播放器播放时返回false.
    // alert(audio.paused);
  if(audio.paused){                 
      audio.play();//audio.play();// 这个就是播放  
	  music_btn.src = \'http://www.novelrd.cn/pause.png\';
        audio.onended = function() {
		//alert("结束了");
		document.getElementById(\'xxxxx\').innerHTML=\'<span id="bf" onclick="bf(\'+i+\'+1);">播放/暂停</span>\';
		bf(i+1);
		}
  }else{
   audio.pause();// 这个就是暂停
   music_btn.src = \'http://www.novelrd.cn/play.png\';
  }
 } 
}


function setyy(){
document.getElementById(\'setyy\').style.display="block";
}

function gb(){
document.getElementById(\'setyy\').style.display="none";
}

function setback(type){
if(type=="white"){
document.body.style.backgroundColor="white";
}
if(type=="black"){
document.body.style.backgroundColor="black";
}
if(type=="qingse"){
document.body.style.backgroundColor="#c5d2cf";
}
if(type=="tuhuang"){
document.body.style.backgroundColor="#cfc8c0";
}
if(type=="fense"){
document.body.style.backgroundColor="#d6c7c0";
}
if(type=="zhangqing"){
document.body.style.backgroundColor="#afbcae";
}

//设置完毕后，写到localstorage，加载网站的时候就进行判断是不是有？

window.localStorage.setItem("bk",type);
//alert("背景设置成功，请关闭当前页面生效。");
}

//默认加载数据
function  getbk(){
var bk=window.localStorage.getItem("bk");
if(bk){
 setback(bk);
}
}
getbk();


</script>
</div>                   
                    
            
<div id="setyy" style="width:100%; display:none; position:fixed; top:0px; text-align:center;height:100%; background:#fff; padding-top:20%;filter:alpha(opacity=100); -moz-opacity:1; z-index:99999999;  -khtml-opacity: 1;  opacity: 1;  ">
<div style="width:100%;text-align:left;">语音设置：</div>
<div style="width:98%; margin-left:1%;border:1px solid green;z-index:9999; background:#f4f4f4;border-radius:10px;">
<div onclick="re(\'1\')" id="aa" style="width:21%;  cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left; border-right:1px solid green;">男声</div>
<div onclick="re(\'0\')"  id="bb"   style="   width:21%;cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left; border-right:1px solid green;">女声</div>
<div onclick="re(\'3\')"  id="cc"   style="width:21%;cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left;   border-right:1px solid green;">逍遥</div>
<div  onclick="re(\'4\')"  id="dd"   style="width:21%; cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left; ">丫丫</div>
<div style="clear:both;"></div>
</div>

<div style="width:100%;text-align:left;">阅读背景设置：</div> 
<div style="width:100%;color:red; font-size:13px;text-align:left;">点击需要设置的色彩，关闭当前页面生效。</div> 
<div style="width:98%; margin-left:1%;border:1px solid green;z-index:9999; background:#f4f4f4;border-radius:10px;">
<div onclick="setback(\'white\')" id="aa" style="width:13%;  cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left; border-right:1px solid green;">白色</div>
<div onclick="setback(\'black\')"  id="bb"   style="   width:13%;cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left; border-right:1px solid green;">黑色</div>
<div onclick="setback(\'qingse\')"  id="cc"   style="width:13%;cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left;   border-right:1px solid green;">青色</div>
<div  onclick="setback(\'tuhuang\')"  id="dd"   style="width:13%; cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left; border-right:1px solid green; ">土黄</div>
<div  onclick="setback(\'fense\')"  id="dd"   style="width:13%; cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left;  border-right:1px solid green;">粉色</div>
<div  onclick="setback(\'zhangqing\')"  id="dd"   style="width:13%; cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left; ">藏青</div>
 
<div style="clear:both;"></div>
</div>

<!--
<div style="width:100%;text-align:left;">字体设置：</div> 
<div style="width:100%;color:red; font-size:13px;text-align:left;">点击需要设置的字体，关闭当前页面生效。</div> 
<div style="width:98%; margin-left:1%;border:1px solid green;z-index:9999; background:#f4f4f4;border-radius:10px;">
<div onclick="setback(\'white\')" id="aa" style="width:30%;  cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left; border-right:1px solid green;">雅黑</div>
<div onclick="setback(\'black\')"  id="bb"   style="   width:30%;cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left; border-right:1px solid green;">宋体</div>
<div onclick="setback(\'qingse\')"  id="cc"   style="width:30%;cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left; ">楷体</div>

<div style="clear:both;"></div>
</div>
-->



<div onclick="gb()"  id="aa" style="width:100%;  cursor: pointer; height:30px; line-height:30px;  text-align:center; padding:5px;  float:left; border-right:1px solid green;">
<span style="padding:3px; border:1px solid #ccc; border-radius:10px;">
关闭窗口
</span>

</div>

					</div>         
            
            
            
                    
                    <div class="font-nav font-change">
                    
                    
                    
                        
                        
                        
                        <a href="javascript:void(0);" class="">
                        
                          <div   id="xxxxx">
 <img  src="http://www.novelrd.cn/play.png" style="width:18px; height:18px;"  id="music_btn01"   onclick="bf(1);" border="0">
  </div>
                        
                        </a>
                        <a href="javascript:void(0);" class="fontSizePlus">A+</a>
                        <a href="javascript:void(0);" class="fontSizeMinus">A-</a>
                        <a href="javascript:void(0);" class="fontBulb"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_bulb_ico.png" /></a>
                    </div>
                </div>
                <div class="intro">'.$this->_tpl_vars['jieqi_content'].'</div>
            </div>
        </div>
        <!-- 推广位 -->
        <div class="font_c font_list" style="margin-top:10px;">
            <a href="'.$this->_tpl_vars['url_previous'].'?per=0" class="prev">上一章</a>
            <a href="'.$this->_tpl_vars['url_index'].'" class="center">目录</a>
            <a href="'.$this->_tpl_vars['url_next'].'?per=0" class="next">下一章</a>
            <!-- 取消页面上的判断 显示出上一章-下一章 -->
        </div>
        
        

        
        <div class="chapter_spread" style="background:none">
            <ul>
            </ul>
        </div>
        <style>
            .bot_ecode{
                /*        background: #fff;*/
                padding: 30px 0;
                text-align: center;
                width: 100%;
            }
            .bot_ecode img{
                width: 110px;
                height: 110px;
                margin: 0 auto;
                text-align: center;
                clear: both;
                border: 1px solid #ddd;
                margin: 7px;
            }
            .bot_ecode span,
            .bot_ecode em{
                display: block;
            }
            .bot_ecode .ecot_t1{
                margin-bottom: 15px;
                font-size: 16px;
                color: #333;
            }
            .bot_ecode .ecot_t2{
                margin-top: 10px;
                font-size: 14px;
                color: #999;
            }
        </style>
        <div class="bot_ecode">
            <span class="ecot_t1">关注官方微信公众号【'.$this->_tpl_vars['jieqi_sitename'].'】，方便下次阅读</span>
            <img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/weixin.jpg" border="0">
            <em class="ecot_t2">— 微信内可长按识别 —</em>
        </div>
        <div style="height:15px;"></div>
    </div>
    <div class="clear"></div>
</div>
    <style>
        body{
            position:relative;
        }
        .gotop {
            width: 35px;
            height: 26px;
            display: inline-block;
            background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/icon-contact.png) no-repeat;
            background-size: 35px 26px;
            background-position: 0 0;
            position: fixed;
            right: 9px;
            bottom: 63px;
            z-index: 9999;
        }
    </style>
    
    
    
    <a id="back-to-top" class="gotop" href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'&add=newreviews"></a>
    
  <!--  <a  style="bottom:93px; background:none;" class="gotop" href="">123</a>-->
    
 
    <script>
        //////滚动
        /*$(window).scroll(function() {
            var clientHeight = $(window).height();
            var offsetTo = $(\'body\').scrollTop();
            if(offsetTo > clientHeight) {
                $(\'#back-to-top\').show();
            } else {
                $(\'#back-to-top\').hide();
            }
        });*/

    </script>


    <style>
        .motie-app-download,
        .motieread-app-download{
            width: 100%;
            background: rgba(0,0,0,0.74);
            z-index: 100;
        }
        .motie-app-download{
            position: relative;
            top:0;
        }
        .motieread-app-download{
            position: fixed;
            bottom: 0;
        }
        .motieread-app-download img,
        .motie-app-download img{
            display:block;
            width:100%;
            /*height:44px;*/
        }
        .motieread-app-download .link,
        .motie-app-download .link{
            position: absolute;
            top: 50%;
            margin-top: -4%;
            right: 4.8%;
            width: 22.666666666666666%;
            height: 58%;
            display: block;
        }
        .motie-app-download .link{
            right: 8%;

        }
        .motie-app-download b{
            position: absolute;
            top: 0;
            background: url(\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/icon-closed-app-download-index.png\') no-repeat;
            -webkit-background-size: 100%;
            background-size: 100%;
            display: block;
            width: 21px;
            height: 21px;
            right: 0;
        }
        .motieread-app-download b{
            position: absolute;
            background: url(\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/icon-closed-app-download.png\') no-repeat;
            background-size: 100%;
            top: 32.7%;
            display: block;
            width: 19px;
            height: 19px;
            left: 2.3%;
        }
        .andriod-download-tips {
            position: fixed;
            z-index: 1000000;
            background: rgba(0,0,0,.8);
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .andriod-download-tips span {
            position: absolute;
            right: -10%;
            top: 0;
            width: 327.5px;
            height: 233.5px;
            background: url(\''.$this->_tpl_vars['jieqi_url'].'/style/m/images/bg-download-tip.png\') left top no-repeat;
            -webkit-background-size: 100% auto;
            background-size: 100% auto;
        }
    </style>
    <div class="andriod-download-tips" style="display: none;"><span></span></div>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jwsjs-2.0.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jws-3.3.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jsrsasign-latest-all-min.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/wap-octopus.js"></script>
    <script>

        $(function() {
            addbookchapter();
            var u = navigator.userAgent;
            var isAndroid = u.indexOf(\'Android\') > -1 || u.indexOf(\'Linux\') > -1 || u.indexOf(\'Adr\') > -1;
            var isIOS = !!u.match(/\\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
            var ua = navigator.userAgent.toLowerCase();
            var isWeixin = ua.indexOf(\'micromessenger\') != -1;

            //埋点
            var countDown = function ($this) {
                var userId = $this.data(\'user-id\'),
                    position = $this.data("position"),
                    collectData = $this.data(\'collect-data\');

                console.log(userId,position,collectData);

                if (collectData == undefined) {
                    collectData = [];
                }

                if(position){
                    sendMessage(userId,position,collectData);
                }
            };
            $(\'body\').on(\'touchend\',\'#closed\',function () {
                var $this = $(this);
                countDown($this);
                $(this).parent(\'.motieread-app-download\').hide();
                //$(\'#j_commonHeader\').css(\'top\',\'0\');
            });
            $(\'body\').on(\'touchend\',\'#downLink\',function () {
                var href=$(this).data(\'href\');
                var $this = $(this);
                countDown($this);
                setTimeout(function(){
                    location.href = href;
                },1000);
            })
        });
        $(\'body\').on(\'touchend\',\'.andriod-download-tips\', function(event){
            window.history.go(-1);
            $(this).hide();
            event.stopPropagation();
        });

        function loginclick(){
            if (0 == '.$this->_tpl_vars['jieqi_userid'].'){
                window.location.href = \''.$this->_tpl_vars['jieqi_url'].'/login.php?jumpurl=\'+window.location.href;
                return false;
            }
        }

        function addbookcase(){
            loginclick();
            $.ajax({
                type: \'post\',
                url: "'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/addbookcase.php",
                dataType: \'json\',
                data: {bid:\''.$this->_tpl_vars['articleid'].'\',cid:\''.$this->_tpl_vars['chapterid'].'\',ajax_gets:1},
                success: function (data) {
                    if(data.success == true){
                        layer.open({
                            content: data.message
                            ,skin: \'msg\'
                            ,time: 3 //2秒后自动关闭
                        });
                    }
                    else{
                        layer.open({
                            content: data.message
                            ,skin: \'msg\'
                            ,time: 3 //2秒后自动关闭
                        });
                    }
                },
            });
        }
        function addbookchapter(){
            if (0 == '.$this->_tpl_vars['jieqi_userid'].'){
                return false;
            }
            $.ajax({
                type: \'post\',
                url: "'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/addbookcase.php",
                dataType: \'json\',
                data: {bid:\''.$this->_tpl_vars['articleid'].'\',cid:\''.$this->_tpl_vars['chapterid'].'\',ajax_gets:1},
                success: function (data) {
                    if(data.success == true){
                        return 1;
                    }
                    else{
                        layer.open({
                            content: data.message
                            ,skin: \'msg\'
                            ,time: 3 //2秒后自动关闭
                        });
                    }
                },
            });
        }
    </script>

    <div id="sharetitle" style="display: none">'.$this->_tpl_vars['articlename'].'</div>
    <div id="sharecontent" style="display: none">'.$this->_tpl_vars['intro'].'
    </div>
    <div style="display: none"><img id="shareImg" src="'.$this->_tpl_vars['url_image'].'" /></div>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/weixin_share_new.js"></script>
</div>
</body>
</html>










';
?>