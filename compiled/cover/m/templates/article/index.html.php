<?php
echo '
<?xml version="1.0" encoding="'.$this->_tpl_vars['jieqi_charset'].'"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>'.$this->_tpl_vars['jieqi_pagetitle'].'</title>
	<!--[if IE]>
	<link href="" rel="stylesheet" type="text/css" />
	<![endif]-->
</head><style type="text/css">
	body{position:relative}.sort_new{border-bottom:0;padding:0 15px;height:40px;line-height:40px;position:relative}.sort_new .update_alert{background:url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapterlist_warn_ico.png) no-repeat;background-position:0 13px;position:absolute;right:15px;top:0;padding-left:20px}.sort_new .s_current{background-position:0 -28px}.update_alert a{color:#999}.sort_new .sort_on{color:#999}.sort_new .sort_mg{padding-right:15px}.chapterlist_mod{background:#fff;padding:0 15px;position:relative;overflow:hidden}.chapterlist_mod ul{overflow:hidden}.chapterlist_mod h2{font-size:14px;margin:15px 0 0}.chapterlist_mod li{line-height:40px;border-bottom:solid 1px #eee;font-size:14px}.chapterlist_mod li.on{font-weight:bold}.chapterlist_mod li span{display:inline-block;width:2px;height:12px;margin-right:5px;background:#ccc}.chapterlist_mod li.on span{background:#419bf5}.chapterlist_mod li a{display:block;}.chapterlist_mod .chapterlist_ico{position:fixed;top:50%;right:0;margin-top:0px}.chapterlist_ico img{width:30px}.chapterlist_down{position:fixed;width:100%;bottom:0;left:0;background:#fff;font-size:16px;height:40px;line-height:40px;border-top:solid 1px #ccc;text-align:center}.chapterlist_down a{display:block;color:#419bf5}#search_more{text-align:center;padding:15px 0}
	.wx_nav_box{background:#505050;position:relative;height:44px}.wx_nav_box a.logo{text-align:center;display:block;font-size:18px;line-height:44px;}.wx_nav_box .wx_home{position:absolute;left:10px;top:0;width:80px;height:44px}.wx_nav_box .wx_home a{width:20px;height:42px;display:inline-block}.wx_home img{width:12px;padding-top:12px}.wx_nav_box a{color:#fff}.wx_nav_box .wx_list{position:absolute;right:0;top:0;width:40px;}.wx_list img{width:30px;display:block;margin-top:7px;border-radius:50%;}#ad_banner{position:relative;overflow:hidden}#ad_banner .change_ico{position:absolute;right:10px;top:10px;z-index:9}.wx_header{overflow:hidden}
	input[type=radio],input[type=checkbox],input[type=submit],input[type=button]{-webkit-appearance: none;-moz-appearance: none;-webkit-user-select: none;-moz-appearance: none;-webkit-tap-highlight-color: rgba(0,0,0,0);-moz-tap-highlight-color: rgba(0,0,0,0);-webkit-tap-highlight-color: transparent;-moz-touch-callout: none;-webkit-touch-callout: none}
	input::-webkit-input-placeholder{color:#999;outline:none;font-size:14px;}
	input::-moz-input-placeholder{color:#999;font-size:14px;outline:none}
	textarea::-webkit-input-placeholder{color:#999;font-size:14px;outline:none}

</style>
<meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'" />
<meta name="keywords" content="'.$this->_tpl_vars['meta_keywords'].'">
<meta name="description" content="'.$this->_tpl_vars['meta_description'].'">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="MobileOptimized" content="320">
<meta http-equiv="cleartype" content="on">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="white">
<link  rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/core.css" media="all" />
<link  rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/css20170419.css" media="all" />
<link rel="shortcut icon" href="'.$this->_tpl_vars['jieqi_url'].'/favicon.ico" type="image/x-icon" />
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery-1.7.2.min.js"></script>
<script>
    (function (doc, win) {
        var docEl = doc.documentElement,
            resizeEvt = \'orientationchange\' in window ? \'orientationchange\' : \'resize\',
            // ??????????????????
            ddesignWidth = 750,
            recalc = function () {
                var clientWidth = docEl.clientWidth;
                if (!clientWidth) return;
                docEl.style.fontSize = 20 * (clientWidth / ddesignWidth) + \'px\';
            };
        if (!doc.addEventListener) return;
        win.addEventListener(resizeEvt, recalc, false);
        doc.addEventListener(\'DOMContentLoaded\', recalc, false);

    })(document, window);
</script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/mobilescript.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery.cookie.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery.lazyload.js"></script>
<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/stylecolor.css" id="css" type="text/css">
</head>
<body style="padding-bottom:42px;">
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
		.commontitle{
			position: relative;
		}
		.commontitle1{
			position: fixed;
			z-index:111;
		}
	</style>
	<!-- header start -->
	<div id="hd" class="wx_header commontitle">
		<div class="wx_nav_box1">
			<div class="wx_home1">
				<a href="javascript:void(0);" onclick="javascript:history.back(-1);">
					<img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/14882778674532908_18_33.png" /><em>??????</em>
				</a>
			</div>
			<a href="javascript:void(0);" class="logo text"></a>
			<div class="wx_list" id="wx_list"></div>
		</div>
	</div>
	<!--end header-->
	<script>
        //????????????
        $(window).on(\'scroll\', function () {
            var offsetTo = $(document).scrollTop();
            if (offsetTo > 0) {
                $(\'.wx_header\').addClass(\'commontitle1\');
                //$(\'.sgoback\').css({\'top\':\'0\'});
            } else {
                $(\'.wx_header\').removeClass(\'commontitle1\');
                // $(\'.sgoback\').css({\'top\':\'44px\'});
            }
        });
	</script><div id="bd">
	<div class="sort sort_new">
		';
if($this->_tpl_vars['index_order'] == 'desc'){
echo '<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reader.php?aid='.$this->_tpl_vars['articleid'].'&order=asc" class="sort_on sort_mg">?????????</a>';
}else{
echo '<span class="sort_mg">?????????</span>';
}
echo '
		';
if($this->_tpl_vars['index_order'] == 'asc'){
echo '<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reader.php?aid='.$this->_tpl_vars['articleid'].'&order=desc" class="sort_on">?????????</a>';
}else{
echo '<span>?????????</span>';
}
echo '
		<!-- <p class="update_alert update" id="update_alert"><a href="javascript:;">????????????</a></p> -->
	</div>
	<!-- ???????????? -->
	<div class="chapterlist_mod">
		<div class="chapterlist_ico" onclick="javascript:history.back(-1);"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapterlist_back_ico.png" /></div>
		<div id="search_more"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/loading.gif"></div>
	</div>
</div>
</div>
<script type="text/javascript">
    $(\'.wx_header .logo\').text(\'??????\');
    var bookId = \''.$this->_tpl_vars['articleid'].'\';
    var isAsc = \''.$this->_tpl_vars['index_order'].'\';
    var flag = false;
    var currentPage = 1;
    var totalPage = \''.$this->_tpl_vars['totalpage'].'\';
    function ajaxList(){
        var pageUrl = "'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reader.php?ajax_gets=1&aid="+bookId+"&order="+isAsc+"&page="+currentPage;
        $.ajax({
            type: "get",
            url: pageUrl,
            dataType: \'json\',
            success: function (result) {
                flag = false;
                var chaptersList = [];
                chaptersList.push(\'<div>\');
                chaptersList.push(\'<ul>\');
                for (var j = 0; j < result.length; j++) {
                    chaptersList.push(\'<li>\');
                    chaptersList.push(\'<a href="\');
                    chaptersList.push(result[j].url_chapter);
                    chaptersList.push(\'"><span></span>\');
                    chaptersList.push(result[j].chaptername);
                    if (result[j].isvip > 0) {
                        chaptersList.push(\'<img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/vip.gif" alt="V">\');
					}
                    chaptersList.push(\'</a></li>\');
                }
                chaptersList.push(\'</ul>\');
                chaptersList.push(\'</div>\');
                chapterList = chaptersList.join(\'\');

                var _chapterList = $(chapterList);
                _chapterList.insertBefore("#search_more");
                $(\'#search_more\').hide();
                $(\' li\').each(function(){

                })
            }
        });
    }

    $(function(){
        ajaxList();
        currentPage ++ ;
        $(window).scroll(function () {
            if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
                $(\'#search_more\').show();
                if (currentPage > totalPage) {
                    $(\'#search_more\').hide();
                } else if (!flag) {
                    flag = true;
                    ajaxList();
                    currentPage++;
                }
            }
        });
//         $(\'.update_alert\').click(function(){
//             var _update=$(\'.update_alert\');
//             _update.toggleClass(\'update\');
//             if(_update.hasClass(\'update\')){
//                 _update.removeClass(\'s_current\');
//             }else{
//                 _update.addClass(\'s_current\');
//             }
//             var alertUlr = "/m" + sitePath + "/ajax/book/updateAlerts?bookId=" + bookId;
//             $.ajax({
//                 type: "get",
//                 url: alertUlr,
//                 dataType: \'json\',
//                 success: function (result) {
//                     if(result.status== 1){
//                         alert("????????????????????????");
//                     }else{
//                         if(result.uni.status == 0){
//                             _update.addClass(\'s_current\');
//                         }
//                         else if(result.uni.status == -1){
//                             _update.removeClass(\'s_current\');
//                         }
//                         if(result.subscribe === 0){
//                             location.href =sitePath+\'/to/weixin/spread\';
// //                                                    alert(\'?????????????????? ??????????????????????????????????????????,??????????????? ->\'+ result.WeixinPublicType);
//                         }
//                     }
//
//                 }
//             });
//         });

        /* $(\'.chapterlist_ico\').click(function(){
            window.location.href = "/m" + sitePath + "/book/" + bookId;
        }); */
        //getUpdate();
    });

    // function getUpdate(){
    //     var url = "/m"+sitePath+"/get/user/alertStatus"
    //     $.ajax({
    //         type : \'get\',
    //         url : url,
    //         data :  {"bookId" : bookId},
    //         dataType : \'json\',
    //         success:function(result){
    //             if(result.uni == null || result.uni.status==-1){
    //                 $(\'#update_alert\').removeClass(\'s_current\');
    //             }else{
    //                 $(\'#update_alert\').addClass(\'s_current\');
    //             }
    //         }
    //     });
    // }
</script>
</body>
</html>




';
?>