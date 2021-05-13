<?php
echo '
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'"/>
    <<meta name="keywords" content="'.$this->_tpl_vars['meta_keywords'].'">
    <meta name="description" content="'.$this->_tpl_vars['meta_description'].'">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="MobileOptimized" content="320">
    <meta http-equiv="cleartype" content="on">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <link rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/core.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/css20170419.css" media="all"/>
    <link rel="shortcut icon" href="'.$this->_tpl_vars['jieqi_url'].'/favicon.ico" type="image/x-icon"/>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery-1.7.2.min.js"></script>
    <script>
        (function (doc, win) {
            var docEl = doc.documentElement,
                resizeEvt = \'orientationchange\' in window ? \'orientationchange\' : \'resize\',

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
    <title>完本专区</title>
    <style>
        .m_search{border:solid 1px #eee;overflow:hidden}.m_search .s_box{overflow:hidden;width:100%}.s_box .input_t{background:#fff;border:solid 1px #ccc;color:#ccc;height:28px;width:75%;float:left;font-size:12px;-webkit-appearance:none;-moz-appearance:none;-webkit-appearance:button;-moz-appearance:button;border-radius:0;border-right:0}.m_search input[type="submit"]{width:25%;background:#ff8d5c;-webkit-appearance:none;border-radius:0;height:30px;color:#fff;border-style:none;text-align:center;float:left;font-size:14px;font-weight:bold}.m-n-channel{display:-moz-box;display:-webkit-box;display:box;width:100%;padding:10px 0;background:#fff;border:solid 1px #eee;font-size:16px;overflow:hidden}.m-n-channel li{-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;text-align:center}.m-n-channel li span{display:block;padding-top:6px}.m-n-channel li a{color:#000;display:block}.m-n-channel li img{width:40px;height:40px}.zui_cont{margin:10px 0 0;background:#fff;border:solid 1px #eee;overflow:hidden}.today-b-title{display:-moz-box;display:-webkit-box;display:box;width:100%;border-bottom:solid 1px #eee;font-size:18px;height:37px;line-height:37px;color:#333;position:relative;overflow:hidden}.today-b-title h2{-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;color:#333;width:100%;font-size:16px;margin:0;padding-right:50px;line-height:37px;font-weight:normal}.today-b-title span{background:#419bf5;margin:11px 6px 0 14px;display:block;width:3px;height:16px}.today-b-title .gettime{position:absolute;right:14px;top:0;font-size:14px}.today-b-title .gettime a{color:#ee5047}.seciton-bd{position:relative;font-size:14px;overflow:hidden}.seciton-bd .change_ico{position:absolute;right:10px;top:10px;z-index:9}.seciton-bd .ul-mod{text-align:center;position:relative;padding:10px 0;overflow:hidden}.ul-mod li{width:33.33333333333%;float:left}.ul-mod li span.name{line-height:20px;display:block;padding-top:6px}.ul-mod li .pic{position:relative;width:80px;margin:0 auto;overflow:hidden}.ul-mod li .pic img{width:80px;height:112px;box-shadow:0 0 3px 0 #ccc}.ul-mod li a,.ul-mod-list li a{color:#333;display:block}.seciton-bd .dashed-line{height:10px;margin:0 14px;border-top:dashed 1px #eee}.seciton-bd .ul-mod-list{padding:0 14px 10px;overflow:hidden}.seciton-bd .ul-mod-list li{line-height:30px}.seciton-bd .ul-mod-list span{color:#999}#editor-b-dl{padding:15px 15px 0;display:block}.seciton-bd .editor-b-dl{width:100%;display:-moz-box;display:-webkit-box;display:box}.seciton-bd a{color:#999}.editor-b-dl dt{padding-right:10px;width:70px;position:relative}.editor-b-dl dt span{display:block;position:absolute;right:10px;top:0}.editor-b-dl img{width:70px}.editor-b-dl dd{-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;position:relative;overflow:hidden}.editor-b-dl dd span{display:block}.editor-b-dl dd span.book-name{font-size:16px;color:#333;padding-top:5px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.editor-b-dl dd span.author-name{font-size:12px;padding:5px 0;position:relative}.editor-b-dl dd span.book-brief{color:#666;line-height:20px;font-size:12px;max-height:40px;overflow:hidden;word-break:break-all!important;word-wrap:break-word!important}#editor-b-dl:last-child{padding-bottom:15px}.ul-mod li .pic .limited-ico{position:absolute;top:0;right:0;display:block}.ul-mod li .pic .limited-ico img,.editor-b-dl dt .limited-ico img{width:40px!important;height:40px!important;box-shadow:none}
    </style>
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
    <div class="andriod-download-tips" style="display: none;">
        <span></span>
    </div>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jwsjs-2.0.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jws-3.3.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jsrsasign-latest-all-min.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/wap-octopus.js"></script>
    <script>
        $(function() {
            var u = navigator.userAgent;
            var isAndroid = u.indexOf(\'Android\') > -1 || u.indexOf(\'Linux\') > -1 || u.indexOf(\'Adr\') > -1;
            var isIOS = !!u.match(/\\(i[^;]+;( U;)? CPU.+Mac OS X/);
            var ua = navigator.userAgent.toLowerCase();
            var isWeixin = ua.indexOf(\'micromessenger\') != -1;

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
    </script>
    <style>
        .commontitle{
            position: relative;
            z-index:111;
        }
        .commontitle2{
            position: fixed;
            z-index:111;
        }
    </style>
    <div class="greybg p_absolute" id="J_greybg">
    </div>
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
                <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php" class="menu_item6 menu_item">书架</a>
                <a href="'.$this->_tpl_vars['jieqi_url'].'/userdetail.php" class="menu_item7 menu_item">账户</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {

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
    </script>

</head>
<body>
<div id="wrapper">
    <!-- nav start -->
    <div class="zui_cont">
        <div class="today-b-title">
            <span></span>
            <h2>'.$this->_tpl_vars['jieqi_pageblocks']['1']['title'].'</h2>
        </div>
        <div class="seciton-bd">
            <ul class="ul-mod">
                '.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'
            </ul>
        </div>
    </div>
    <div class="zui_cont">
        <div class="today-b-title">
            <span></span>
            <h2>'.$this->_tpl_vars['jieqi_pageblocks']['2']['title'].'</h2>
        </div>
        <div class="seciton-bd">
            '.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'
        </div>
    </div>
    <div class="zui_cont">
        <div class="today-b-title">
            <span></span>
            <h2>'.$this->_tpl_vars['jieqi_pageblocks']['3']['title'].'</h2>
        </div>
        <div class="seciton-bd">
            '.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'
        </div>
    </div>
</div>
</body>
<script>
    $(function () {
        common_header.init();
        page_finish_book.init();
    })
</script>
</html>


';
?>