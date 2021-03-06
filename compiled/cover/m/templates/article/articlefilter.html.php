<?php
echo '
<?xml version="1.0" encoding="'.$this->_tpl_vars['jieqi_charset'].'"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>'.$this->_tpl_vars['jieqi_pagetitle'].'</title>
    <link rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/common_new.css" media="all" />
    <link rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/category.css" media="all" />
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
    <!--[if IE]>
    <link href="" rel="stylesheet" type="text/css" />
    <![endif]-->
</head>
<body>
<div class="wrapper">
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
                <a href="'.$this->_tpl_vars['jieqi_url'].'/" class="menu_item1 menu_item">??????</a>
                <a href="'.jieqi_geturl('article','articlefilter','1','').'" class="menu_item2 menu_item">??????</a>
                <a href="'.jieqi_geturl('article','articlelist','1','','1').'" class="menu_item3 menu_item">??????</a>
                <a href="'.jieqi_geturl('article','toplist','1','toplist').'" class="menu_item4 menu_item">??????</a>
                <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php" class="menu_item6 menu_item">??????</a>
                <a href="'.$this->_tpl_vars['jieqi_url'].'/userdetail.php" class="menu_item7 menu_item">??????</a>
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
    </script><!--category start-->
    <div class="catewrap">
        <div class="catetop">
            <div class="catedown">
                <div class="catebox">
                    <div class="catemenu"><span>??????</span></div>
                    <div class="catelist catelist1" id="slidectrl">
                        <div class="nbox">
                            ';
if (empty($this->_tpl_vars['sortidrows'])) $this->_tpl_vars['sortidrows'] = array();
elseif (!is_array($this->_tpl_vars['sortidrows'])) $this->_tpl_vars['sortidrows'] = (array)$this->_tpl_vars['sortidrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['sortidrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['sortidrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['sortidrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortidrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['sortidrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                            <a href="#"';
if($this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo ' class="togle"';
}
echo ' data-type="'.$this->_tpl_vars['i']['key'].'"><span>'.$this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['name'].'</span></a>
                            ';
}
echo '
                            <span class="slidecontrol"></span>
                        </div>
                    </div>
                </div>
                <div class="catebox">
                    <div class="catemenu"><span>??????</span></div>
                    <div class="catelist" id="cateStatus">
                        <div class="nbox">
                            ';
if (empty($this->_tpl_vars['isfullrows'])) $this->_tpl_vars['isfullrows'] = array();
elseif (!is_array($this->_tpl_vars['isfullrows'])) $this->_tpl_vars['isfullrows'] = (array)$this->_tpl_vars['isfullrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['isfullrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['isfullrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['isfullrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['isfullrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['isfullrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                            <a href="#"';
if($this->_tpl_vars['isfullrows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo ' class="togle"';
}
echo ' data-type="'.$this->_tpl_vars['i']['key'].'"><span>'.$this->_tpl_vars['isfullrows'][$this->_tpl_vars['i']['key']]['name'].'</span></a>
                            ';
}
echo '
                        </div>
                    </div>
                </div>
                <div class="catebox">
                    <div class="catemenu"><span>??????</span></div>
                    <div class="catelist" id="catePrice">
                        <div class="nbox">
                            ';
if (empty($this->_tpl_vars['isviprows'])) $this->_tpl_vars['isviprows'] = array();
elseif (!is_array($this->_tpl_vars['isviprows'])) $this->_tpl_vars['isviprows'] = (array)$this->_tpl_vars['isviprows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['isviprows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['isviprows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['isviprows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['isviprows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['isviprows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                            <a href="#"';
if($this->_tpl_vars['isviprows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo ' class="togle"';
}
echo ' data-type="'.$this->_tpl_vars['i']['key'].'"><span>'.$this->_tpl_vars['isviprows'][$this->_tpl_vars['i']['key']]['name'].'</span></a>
                            ';
}
echo '
                        </div>
                    </div>
                </div>
                <a href="#" class="confirm">??????</a>
            </div>
        </div>



    </div>
    <div class="wrapcontent"  data-page="0" data-pageNo="pageNo" data-totalPage="totalPage">
        <div class="banklist">

        </div>
        <div class="noupdate">??????????????????????????????!</div>
        <div class="uploadmore"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/loading.gif" alt=""></div>
        <div class="nocate">????????????????????????????????????</div>
    </div>
</div>
<input type="hidden" class="sort" value=""/>
<input type="hidden" class="isfull" value=""/>
<input type="hidden" class="isvip" value=""/>
<!--    <input type="text"  id="totalPage" class="totalPage" value=""/>
    <input type="hidden" id="pageNo"  class="pageNo" value=""/> -->
<input type="hidden" class="categorys" value="[Lcom.motie.wings.utils.EnumBookSortType;@4408bdac"/>

<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/category.js"></script>
</body>
<script>
    $(function () {
        common_header.init();
        page_category.init();
    })
</script>
</html>







';
?>