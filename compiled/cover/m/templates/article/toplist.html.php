<?php
if($this->_tpl_vars['order'] == "toplist"){
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
    <link rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/common_new.css" media="all" />
    <link rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/rank.css" media="all" />

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
                //alert(\'1111\');
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
    </script><!--ranklist start-->
    <div class="rankwrap">
        <div class="rankindex">
            <a href="'.jieqi_geturl('article','toplist','1','allvisit').'">
                <div class="rankpic">
                    <img alt="点击榜" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/14879080339575685_240_172.jpg" />
                </div>
                <div class="rankinfo">
                    '.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'
                </div>
                <span class="rankmore"><img atl="更多" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/arrow-left-ico.png" /></span>
            </a>
        </div>
        <div class="rankindex">
            <a href="'.jieqi_geturl('article','toplist','1','allsale').'">
                <div class="rankpic">
                    <img alt="畅销榜" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/148790801556396270_240_172.jpg" />
                </div>
                <div class="rankinfo">
                    '.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'
                </div>
                <span class="rankmore"><img atl="更多" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/arrow-left-ico.png" /></span>
            </a>
        </div>
        <div class="rankindex">
            <a href="'.jieqi_geturl('article','toplist','1','sumgift').'">
                <div class="rankpic">
                    <img alt="捧场榜" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/148790801407980036_240_172.jpg" />
                </div>
                <div class="rankinfo">
                    '.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'
                </div>
                <span class="rankmore"><img atl="更多" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/arrow-left-ico.png" /></span>
            </a>
        </div>
        <div class="rankindex">
            <a href="'.jieqi_geturl('article','toplist','1','allvote').'">
                <div class="rankpic">
                    <img alt="推荐榜" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/14879080623058209_240_172.jpg" />
                </div>
                <div class="rankinfo">
                    '.$this->_tpl_vars['jieqi_pageblocks']['4']['content'].'
                </div>
                <span class="rankmore"><img atl="更多" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/arrow-left-ico.png" /></span>
            </a>
        </div>
        <div class="rankindex">
            <a href="'.jieqi_geturl('article','toplist','1','postdate').'">
                <div class="rankpic">
                    <img alt="新书榜" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/148790801629578428_240_172.jpg" />
                </div>
                <div class="rankinfo">
                    '.$this->_tpl_vars['jieqi_pageblocks']['5']['content'].'
                </div>
                <span class="rankmore"><img atl="更多" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/arrow-left-ico.png" /></span>
            </a>
        </div>
        <div class="rankindex">
            <a href="'.jieqi_geturl('article','toplist','1','lastupdate').'">
                <div class="rankpic">
                    <img alt="更新榜" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/14879080947334904_240_172.jpg" />
                </div>
                <div class="rankinfo">
                    '.$this->_tpl_vars['jieqi_pageblocks']['6']['content'].'
                </div>
                <span class="rankmore"><img atl="更多" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/arrow-left-ico.png" /></span>
            </a>
        </div>
    </div>

</div>

<script>
    $(function () {
        common_header.init();
        page_rank.init();
    })
</script>
</body>
</html>

';
}else{
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
    <link  rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/css20170419.css" media="all" />
    <link rel="shortcut icon" href="'.$this->_tpl_vars['jieqi_url'].'/favicon.ico" type="image/x-icon" />
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/mobilescript.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/m/js/jquery.lazyload.js"></script>
    <link rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/common_new.css" media="all" />
    <link rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/style/m/css/rank.css" media="all" />
    <!--[if IE]>
    <link href="" rel="stylesheet" type="text/css" />
    <![endif]-->
</head>
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
                    <img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/14882778674532908_18_33.png" /><em>排行榜</em>
                </a>
            </div>
            <a href="javascript:void(0);" class="logo text"></a>
            <div class="wx_list" id="wx_list"></div>
        </div>
    </div>
    <!--end header-->
    <script>

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
    </script><!--ranklist start-->
    <div class="banklist">
        ';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'">
            <div class="listpic">
                <img alt="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'" data-original="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_image'].'" class="lazy" />
                <em class="number">'.$this->_tpl_vars['i']['order'].'</em>
            </div>
            <div class="listinfo">
	        			<span class="title">
	        				'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</span>
                <span class="name">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</span>
                <p class="digest">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['intro'].'</p>
            </div>
        </a>
        ';
}
echo '
    </div>

</div>
<script>
    var title = \''.$this->_tpl_vars['ordername'].'\';
    $(\'.commontitle .text\').html(title);
    function lazy(clssName){
        $(clssName).lazyload({
            threshold	   : 0,
            failure_limit   : 0,
            container	   : window,
            data_attribute  : "original",
            skip_invisible  : true,
            load			: null,
            effect: "fadeIn",
            placeholder : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAADgCAIAAAAL9foWAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjZEQzJDNEM5MzUxQzExRTY4NzIwQjlEQkIwRTgwNTUzIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjZEQzJDNENBMzUxQzExRTY4NzIwQjlEQkIwRTgwNTUzIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NkRDMkM0QzczNTFDMTFFNjg3MjBCOURCQjBFODA1NTMiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NkRDMkM0QzgzNTFDMTFFNjg3MjBCOURCQjBFODA1NTMiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7uPm98AABxCElEQVR42ry9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"
        });
        $(window).bind("load", function() {
            var timeout = setTimeout(function() {$(clssName).trigger("appear")}, 500);
        });
    }
    lazy(\'img.lazy\');
</script>
</body>
</html>

';
}
echo '


';
?>