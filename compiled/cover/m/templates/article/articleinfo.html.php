<?php
echo '
<!DOCTYPE html >
<html >
<head>
    <title>'.$this->_tpl_vars['jieqi_pagetitle'].'</title>


    <style rel="stylesheet" type="text/css">
        .slowdown {
            overflow: hidden;
        }

        .slowdown b {
            display: block;
            color: #999;
            font-size: 14px;
            font-weight: normal;
            padding-right: 10px;
            text-align: right;
        }

        .rew-li-r .text {
            color: #999
        }

        p.summary_mod {
            text-indent: 0;
            height: 54px;
        }

        .rew-li-r .tit .jinghua-ico {
            top: 13px
        }

        .book_detail_tit b, .book_detail_tit span {
            font-size: 12px
        }

        .detail_table dd a.continue {
            font-size: 16px;
            padding: 2px 10px;
            color: #fff;
            background: #419af4;
            border-radius: 3px;
            margin-top: 10px;
            display: inline-block;
            text-align: center
        }

        .r_tit span a {
            color: #ff620d
        }

        .r_tit span a.col_3 {
            color: #333
        }



        .r-ticket {
            overflow: hidden;
            padding: 0 10px;
            font-size: 12px
        }

        .w_count a.c_sblue, .w_count a.c_orange {
            color: #666 !important;
            border: none !important;
            padding: 0 !important
        }

        .r-ticket .pd-bottom {
            padding-bottom: 5px;
            overflow: hidden;
            font-size: 12px
        }

        a.r-ticket-but {
            background: #fe975c;
            display: inline-block;
            float: right;
            color: #fff;
            padding: 2px 5px;
            border-radius: 3px;
            display: inline-block
        }

        .d-time-over {
            background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/time-over-ico.png) no-repeat;
            margin-top: 3px;
            padding-left: 70px;
            height: 20px;
            line-height: 20px
        }

        #t_d, #t_h, #t_m, #t_s {
            color: #f00
        }

        .d-time-over img {
            vertical-align: middle
        }



        .detail_sum .tit h2 {
            border-left: solid 3px #fd6974
        }

        .update_alert {
            width: 40px;
            top: 14px;
            height: 16px;
            background: url('.$this->_tpl_vars['jieqi_url'].'/style/m/images/chapter_update_ico.png) no-repeat;
            background-position: 0 -30px
        }

        .s_current {
            background-position: 0 0
        }

        .wx_header.commontitle{
            overflow: inherit;
        }
        /*功能区按钮  立即阅读 投票 加入书架*/
        #work_detail .detail_ul {
            line-height: 3.2rem;
            background: #fff;
            padding:1.5rem 1.5rem 1rem;
            overflow: hidden;
        }
        #work_detail .detail_ul li a {
            display: block;
            color:#fff;
            text-decoration: none;
            text-align: center;
            font-size: 1.2rem;
        }
        #work_detail .detail_ul li {
            float:left;
            border-radius: 4px;
            height: 32px;
            line-height: 32px;

        }
        #work_detail .detail_ul li.readnow {
            width:8.1rem;
            background: #fd6974;
        }
        #work_detail .detail_ul li.vote {
            width:8rem;
            margin-left:.7rem;
            background: #fff;
            border: 1px solid #fd6974;
            box-sizing: border-box;
        }
        #work_detail .detail_ul li.vote a{
            color:#fd6974;
        }

        #work_detail .detail_ul li.addshelf {
            width:8rem;
            float:right;
            background: #fff;
            border: 1px solid #fd6974;
            box-sizing: border-box;

        }
        #work_detail .detail_ul li.addshelf a{
            color:#fd6974;
        }
        /*gold*/
        .votebanner{
            position: relative;
            padding: 15px 15px 0;
            background: #fff;
        }
        .votebanner img{
            width:100%;
            height: 60px;
            display: block;
        }
        .votebanner .vmumber{
            position: absolute;
            left: 30px;
            bottom: 9px;
            color: #fff;
            font-size: 14px;
        }
        .votebanner1 img{
            height: 50px;
        }

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
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/layer.js"></script>
    <script>
        (function (doc, win) {
            var docEl = doc.documentElement,
                resizeEvt = \'orientationchange\' in window ? \'orientationchange\' : \'resize\',
                // 设计稿的宽度
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
    <link rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/common_new.css" media="all"/>
    <!--[if IE]>
    <link href="" rel="stylesheet" type="text/css" />
    <![endif]-->
</head>
<body>
<div class="wrapper" id="work_detail">
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
        var jieqi_userid = "'.$this->_tpl_vars['jieqi_userid'].'";
        $(function() {
            var u = navigator.userAgent;
            var isAndroid = u.indexOf(\'Android\') > -1 || u.indexOf(\'Linux\') > -1 || u.indexOf(\'Adr\') > -1;
            var isIOS = !!u.match(/\\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
            var ua = navigator.userAgent.toLowerCase();
            var isWeixin = ua.indexOf(\'micromessenger\') != -1;

            //埋点
            /*$(\'body\').on(\'touchend\', \'.collect-data\', function () {
                var $this = $(this),
                    userId = $this.data(\'user-id\') || 0,
                    position = $this.data("position"),
                    collectData = $this.data(\'collect-data\');

                    console.log(userId,position,collectData);

                    if (collectData == undefined) {
                        collectData = [];
                    }

                    if(position){
                        sendMessage(userId,position,collectData);
                    }
            });*/

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
                $this.parent(\'.motie-app-download\').hide();
                //$(\'#j_commonHeader\').css(\'top\',\'0\');
            });
            $(\'body\').on(\'touchend\',\'#downLink\',function () {

                //alert(url);
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



    </script><style>
    .commontitle{
        position: relative;
        z-index:111;
    }
    .commontitle2{
        position: fixed;
        z-index:111;
    }
</style>
    <div class="greybg p_absolute" id="J_greybg"></div>
    <div class="commontitle wx_header p_relative " id="j_commonHeader">
        <span class="back p_absolute"></span>
        <span class="logo text text_mid fs30"></span>
        <span class="nav p_absolute"></span>
        <div class="menu p_absolute" id="J_menu">
            <div class="menu_in">
                <a href="'.$this->_tpl_vars['jieqi_url'].'/" class="menu_item1 menu_item">首页</a>
                <a href="'.jieqi_geturl('article','articlefilter','1','').'" class="menu_item2 menu_item">分类</a>
                <a href="'.jieqi_geturl('article','articlelist','1','','1').'" class="menu_item3 menu_item">完本</a>
                <a href="'.jieqi_geturl('article','toplist','1','toplist').'" class="menu_item4 menu_item">排行</a>
                <!--<a href="/m/wechat/free_book?group=1" class="menu_item5 menu_item">免费</a>-->
                <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php" class="menu_item6 menu_item">书架</a>
                <a href="'.$this->_tpl_vars['jieqi_url'].'/userdetail.php" class="menu_item7 menu_item">账户</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            //二级导航
            $(window).on(\'scroll\', function () {
                var offsetTo = $(document).scrollTop();
                if (offsetTo > 0) {
                    $(\'.wx_header\').addClass(\'commontitle2\');
                    //$(\'.sgoback\').css({\'top\':\'0\'});
                } else {
                    $(\'.wx_header\').removeClass(\'commontitle2\');
                    // $(\'.sgoback\').css({\'top\':\'44px\'});
                }
            });
        })
    </script><div id="bd">
    <style type="text/css">
        .alert{background:#fef7e3;padding:7px 10px;margin:0 !important;border:none;position:relative;}.alert img{vertical-align:middle}
        .alert a{display:block;position:absolute;right:6px;top:5px;width:70px;background:#419af4;color:#fff;text-align:center;border-radius:3px;padding:2px 0;}
    </style>
    <!-- 书的封面 start -->
    <div class="book_mod">
        <div class="cover"><img src="'.$this->_tpl_vars['url_image'].'"/>
        </div>
        <div class="shadow"></div>
        <a href="javascript:;" class="dl_a">
            <dl class="detail_table" style="border-bottom:1px solid transparent">
                <dt>
                    <img src="'.$this->_tpl_vars['url_image'].'" alt="" width="80" height="112"/>
                    <span class="other_o_col">'.$this->_tpl_vars['fullflag'].'</span>
                </dt>
                <dd>
                    <h1>'.$this->_tpl_vars['articlename'].'</h1>
                    <p>
                        <span>作者：'.$this->_tpl_vars['author'].'</span>
                        <span>字数：'.$this->_tpl_vars['size_c'].'</span>
                        <span class="cc">'.$this->_tpl_vars['allvisit'].'书友正在看</span>
                        <b class="tag">
                            <i class="xuanhuan">'.$this->_tpl_vars['sort'].'</i>
                        </b>
                    </p>
                </dd>
            </dl>
        </a>

    </div>
    <!-- end 书的封面 -->

    <ul class="detail_ul">
        <li class="readnow">
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articleread.php?id='.$this->_tpl_vars['articleid'].'">立即阅读</a>
        </li>
        ';
if($this->_tpl_vars['saleprice'] > 0){
echo '
        <li class="vote"><a href="javascript:wholebuy();" id="wholebuy">购买全本</a></li>
        ';
}
echo '
        <li class="vote"><a href="javascript:vote();" >投票</a></li>
        <li class="addshelf fr">
            <a href="javascript:addbookcase();" rel="nofollow">加入书架</a>

        </li>
    </ul>

    <!--编辑推荐20180621-->
    <!-- 简介 start -->
    <div class="detail_sum">
        <div class="slowdown">
            <p class="summary_mod">'.$this->_tpl_vars['intro'].'</p>
        </div>
        <!--end 简介-->
        <div class="book_detail_line"></div>
        <!-- 目录 start -->
        <a href="'.$this->_tpl_vars['url_read'].'" style="display:block;">
            <div class="book_detail_tit">
                <b style="display:inline-block;font-size:16px;color:#333;padding-left:0;float:left;">目录</b>&nbsp;
                <b style="display:inline-block;width:160px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">';
if($this->_tpl_vars['isvip_n'] > 0 && $this->_tpl_vars['vipchapterid'] > 0){
echo $this->_tpl_vars['vipchapter'];
}else{
echo $this->_tpl_vars['lastchapter'];
}
echo '</b>
                <span>
								'.date('Y-m-d',$this->_tpl_vars['lastupdate']).' &nbsp;
								<img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/book_detail_arrow_ico.png"/>
							</span>
            </div>
        </a>
    </div>

    <!-- 捧场 start -->
    <input type="hidden" value=""/>
    <!-- <div class="detail_sum">
        <div class="book_detail_tit book_detail_bl">
            捧场
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/gift.php?id='.$this->_tpl_vars['articleid'].'"><span>我要捧场</span></a>
        </div>
        <div class="join_box" style="padding-bottom:0;">
            <ul class="join_ul" style="border:none;">
                <li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/gift.php?id='.$this->_tpl_vars['articleid'].'"><img
                        src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/mb.gif"><span>'.$this->_tpl_vars['egoldname'].'</span></a></li>
                ';
if (empty($this->_tpl_vars['giftrows'])) $this->_tpl_vars['giftrows'] = array();
elseif (!is_array($this->_tpl_vars['giftrows'])) $this->_tpl_vars['giftrows'] = (array)$this->_tpl_vars['giftrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['giftrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['giftrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['giftrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['giftrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['giftrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                ';
if($this->_tpl_vars['giftrows'][$this->_tpl_vars['i']['key']]['display'] > 0){
echo '
                <li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/gift.php?id='.$this->_tpl_vars['articleid'].'&type='.$this->_tpl_vars['giftrows'][$this->_tpl_vars['i']['key']]['gid'].'"><img
                        src="'.$this->_tpl_vars['giftrows'][$this->_tpl_vars['i']['key']]['icourl'].'"><span>'.$this->_tpl_vars['giftrows'][$this->_tpl_vars['i']['key']]['caption'].'</span></a></li>
                ';
}
echo '
                ';
}
echo '
            </ul>
        </div>
    </div> -->
    <!--end 捧场-->

    <div class="detail_sum">
        <div class="book_detail_tit book_detail_bl">
            打赏
        </div>
        <div class="join_box" style="padding-bottom:0;">
            <div class="motiecoin clearfixer">
                <span class="item" data-sum="100">100小说币</span>
                <span class="item" data-sum="500">500小说币</span>
                <span class="item" data-sum="1000">1000小说币</span>
                <span class="item" data-sum="3000">3000小说币</span>
                <span class="item" data-sum="10000">1万小说币</span>
                <span class="item" data-sum="50000">5万小说币</span>
                <span class="item" data-sum="100000">10万小说币</span>
                <span class="item" data-sum="1000000">100万小说币</span>
                <span class="item" data-sum="10000000">1000万小说币</span>
            </div>
            <!-- <p class="balance">账户余额<span class="user_remain"></span>小说币 · 本次打赏 <span class="choosecoin"> </span>小说币</p>
            <textarea class="inputzone" placeholder="">千金难买相如赋，小小红包犒劳一下！</textarea> -->
            <div class="confirmapplause">确认打赏</div>
        </div>
    </div>
    <style>

        .motiecoin {
            font-size: 0;
        }
        
        .motiecoin .item {
            border: 1px solid #ccc;
            text-align: center;
            line-height: 24px;
            font-size: 12px;
            display: inline-block;
            margin: 0 10px 10px 0;
            cursor: pointer;
            border-color: #f5546f;
            width: 29%;
        }

        .motiecoin .item.on {
            background-color: #f5546f;
            color: #fff;
        }

        .confirmapplause {
            text-align: center;
            border: 1px solid #f5546f;
            line-height: 36px;
            font-size: 14px;
            background-color: #f5546f;
            color: #fff;
            margin-bottom: 10px;
        }

        .layui-m-layercont a {
            color: #fff;
        }
    </style>
    <script>
        var page_config = {
            voteNumber:\''.$this->_tpl_vars['jieqi_votes'].'\',
            uservipvote:"'.$this->_tpl_vars['jieqi_setting']['gift']['vipvote'].'",
            userMoneyBalance:\''.$this->_tpl_vars['jieqi_egold'].'\',
            bookId:\''.$this->_tpl_vars['articleid'].'\',
            isInShelf:\''.$this->_tpl_vars['is_bookcase'].'\',  // true  表示已在书架
            username: "'.$this->_tpl_vars['jieqi_username'].'",
            authorName: "'.$this->_tpl_vars['jieqi_username'].'",
            userLevel:"'.$this->_tpl_vars['jieqi_group'].'",
            userIcon:"'.jieqi_geturl('system','avatar',$this->_tpl_vars['jieqi_userid'],'l',$this->_tpl_vars['jieqi_avatar']).'",
            votes:"'.$this->_tpl_vars['jieqi_votes'].'",
            vipvote:"'.$this->_tpl_vars['allvipvote'].'",
            postcheckcode: "'.$this->_tpl_vars['postcheckcode'].'",
            callbackPageStr:\'\'
        }
    </script>
    <script>
        $(function(){
            var f = 0;
            var m = page_config.userMoneyBalance;

            $(\'.motiecoin .item\').on(\'click\', function(){
                $(this).addClass(\'on\').siblings().removeClass(\'on\');
                f = $(this).data(\'sum\');
                console.log(\'sum\', f, \'444\');
                return false;
            });

            $(\'.motiecoin .item\').eq(0).trigger(\'click\');

            $(\'.confirmapplause\').on(\'click\', function(){
                if (f > m) {
                    location.href = "/modules/pay/buyegold.php"
                    return;
                }

                $.ajax({
                    url: "/modules/article/tip.php",
                    data: {
                        id: page_config.bookId,
                        payegold: f,
                        ajax_gets: 1,
                        act: "post",
                        jieqi_token: \''.$this->_tpl_vars['jieqi_token'].'\',
                        content: \' \'
                    },
                    type: "POST",
                    dataType: "json",
                    success: function(i) {
                        if (i.success === true) {
                            m = page_config.userMoneyBalance = page_config.userMoneyBalance - f;
                            layer.open({
                                content: i.message, skin: \'msg\', time: 10
                            });
                        } else{
                            layer.open({
                                content: i.message.replace(\'/buyegold.php\', \'/modules/pay/buyegold.php\'), skin: \'msg\', time: 10
                            });
                        }
                    }
                });
            });
        });
    </script>

    <!-- 评论 start -->
    <div class="detail_sum">
        <div class="book_detail_tit book_detail_bl">
            评论&nbsp;<b>'.$this->_tpl_vars['reviewsnum'].'条评论 </b>
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'&add=newreviews"><span>+写评论</span></a>
        </div>
        <ul class="review-ul">
            '.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'
        </ul>
        <div style="text-align:center;border-top:solid 1px #ccc;height:32px;line-height:32px;"><a
                href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'">去书评区逛逛</a></div>
    </div>
    <!--end 评论-->

    <!-- 作者写过 start -->
    <div class="detail_sum">
        <div class="book_detail_tit book_detail_bl">
            '.$this->_tpl_vars['jieqi_pageblocks']['2']['title'].'
        </div>
        <ul class="review_list">
            '.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'
        </ul>
    </div>
    <!--end 作者写过-->

    <!-- 书友还看过  start -->
    <!--end 书友还看过-->
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
</div>
</div>
<div id="sharetitle" style="display: none">'.$this->_tpl_vars['articlename'].'</div>
<div id="sharecontent" style="display: none">'.$this->_tpl_vars['intro'].'</div>
<div style="display: none"><img id="shareImg" src="'.$this->_tpl_vars['url_image'].'" /></div>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/weixin_share_new.js"></script>
<script type="text/javascript">
    var bookId = 50480;
    var sitePath = \'/zyq\';
    $(function () {
        $(".slowup").click(function () {
            var t = $(this);
            t.toggleClass("toggle");
            if (t.hasClass("toggle")) {
                t.prev().css("height", "auto").end().text(\'收起 ∧\');
            } else {
                t.prev().css("height", "54px").end().text(\'展开 ∨\');
            }
            ;
        });
        $(".review-ul li:last").find(\'p\').css({\'border-bottom\': \'none\'});
    });

    function discoutBuyLocal(bookId) {
        var url = "/m/book/buy/discount/" + bookId;
        $.ajax({    
            url: url,
            type: "get",
            success: function (msg) {
                if (msg != null && msg.code == "success") {
                    if ($(".alert").html() != null) {
                        $(".alert").html(msg.message);
                    }
                    else {
                        $(".book_mod").first().before("<div class=\'alert\'>" + msg.message + "</div>");
                    }

                }
                else {
                    $(".book_mod").first().before("<div class=\'alert\'>" + msg.message + "</div>");
                }
            }
        })
    };

    function loginclick(){
        if (jieqi_userid == 0){
            window.location.href = \''.$this->_tpl_vars['jieqi_url'].'/login.php?jumpurl=\'+window.location.href;
            return false;
        }
    }
    function vote(){
        loginclick();
        $.ajax({
            type: \'post\',
            url: "'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/uservote.php",
            dataType: \'json\',
            data: {id:\''.$this->_tpl_vars['articleid'].'\',ajax_gets:1},
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

    function addbookcase(){
        loginclick();
        $.ajax({
            type: \'post\',
            url: "'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/addbookcase.php",
            dataType: \'json\',
            data: {bid:\''.$this->_tpl_vars['articleid'].'\',ajax_gets:1},
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
    function wholebuy(){
        loginclick();
        layer.open({
            content: \'你确定支付'.$this->_tpl_vars['saleprice'].$this->_tpl_vars['egoldname'].'购买本书吗？\'
                ,btn: [\'购买\', \'取消\']
            ,yes: function(index){
                $.ajax({
                    type: "POST",
                    url: "'.$this->_tpl_vars['jieqi_modules']['obook']['url'].'/buywhole.php",
                    data: {\'act\' : \'buy\', \'oid\' : \''.$this->_tpl_vars['vipid'].'\', \'jieqi_token\' : \''.$this->_tpl_vars['jieqi_token'].'\', \'ajax_gets\' : 1},
                    global: false,
                    dataType: "json",
                    success: function (data) {
                        if (data.success == false) {
                            layer.open({
                                content: data.message
                                ,skin: \'msg\'
                                ,time: 3 //2秒后自动关闭
                            });
                            return false
                        }
                        layer.open({
                            content: data.message
                            ,skin: \'msg\'
                            ,time: 3 //2秒后自动关闭
                        });
                    }
                })
                layer.close(index);
            }
        });
    }
    $(function () {
        //链接字符串
        // var $currentUrl = window.location.pathname;
        // var $sUrl = $currentUrl.substr(5, $currentUrl.length);
        // $(\'.rew-li-r a\').each(function () {
        //     var nowHref = $(this).attr(\'href\');
        //     nowHref += (\'?redUrl=\' + $sUrl);
        //     $(this).attr(\'href\', nowHref);
        // })

        $(\'.wx_header .logo\').text(\'作品详情\');
        common_header.init();
        // 该页面的点击返回按钮，返回至首页
        $(\'.commontitle .back\').off(\'click\').on(\'click\',function () {
            location.href="'.$this->_tpl_vars['jieqi_url'].'/";
        }) ;

    });


</script>


</body>
</html>






';
?>