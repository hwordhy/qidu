<?php
echo '<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'"/>
    <meta content="zh-cn" http-equiv="Content-Language">
    <meta name="keywords"  content="'.$this->_tpl_vars['meta_keywords'].'">
    <meta name="description"  content="'.$this->_tpl_vars['meta_description'].'">
    <title>'.$this->_tpl_vars['jieqi_pagetitle'].'</title>
    <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/i.css" type="text/css" />
    <!--<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/iyy.css" type="text/css" />-->
    <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/layer.css" />
    <script>
        function _addConfig(json) {
            if(window.page_config){
                for(var i in json){
                    if(page_config[i] === undefined){
                        window.page_config[i] = json[i];
                    }
                }
            }else{
                window.page_config = json;
            }
        }
        _addConfig({
            username: "'.$this->_tpl_vars['jieqi_username'].'",
            sitestate:"7",
            userId:"'.$this->_tpl_vars['jieqi_userid'].'",
            coinName:"'.$this->_tpl_vars['egoldname'].'",
            siteValue:"yy",
            toTop_page:true
        });
        var isPeople = location.href.indexOf(\'/people\')>-1;
        if(isPeople){
            page_config.toTop_page=false;
        }

    </script>
    <script type="text/javascript">
    var _loginUser = \'basic\';
    var _config = \'\';
    </script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/handlebars-v4.0.5.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/handlebars.helper.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/vendor.js"></script>
    <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/ui_common.css">
    <script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/index_header.js"></script>
    <script type="text/javascript">var uid = "'.$this->_tpl_vars['jieqi_userid'].'"; var checkcodelogin = "'.$this->_tpl_vars['jieqi_checkcodelogin'].'"; var jieqi_token = \''.$this->_tpl_vars['jieqi_token'].'\'</script>

</head>
<body class="ibody">
<!--start mod -->
<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/header.css" type="text/css" />
<div class="mod-header" id="topback">
    <!--????????? start-->
    <div   class="topnav">
        <div class="navbar" style="background:#f2f2f2;">
            <div class="wrap1200 h40">
                <div class="left navbox">
                    <a href="javascript:;" onclick="AddFavorite(\''.$this->_tpl_vars['jieqi_url'].'\', \''.$this->_tpl_vars['jieqi_sitename'].'\');">????????????</a>
                </div>
                <!-- nologin start-->
                <div class="index-login h40 fr">
                    <a href="javascript:;"  class="indexmobile">
                        ?????????
                        <div class="pho-tabs" style="display: none">
                            <em class="dot-top"></em>
                            <ul>
                                <li>
                                    <span class="scode fl"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/wap.png" /></span>
                                    <p class="fr">
                                        <span class="f14">'.$this->_tpl_vars['jieqi_sitename'].'</span>
                                        <span>??????????????????</span>
                                    </p>
                                </li>
                                <li>
                                    <span class="scode fl"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/weixin.jpg" /></span>
                                    <p class="fr" style="margin-top: 17px;">
                                        <span class="f14">????????????</span>
                                        <span>?????????????????????</span>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </a>
                </div>
                <!-- nologin end-->
                <!-- login start-->
                <div class="index-login fr">
                    ';
if($this->_tpl_vars['jieqi_userid'] == 0){
echo '
                    <a href="javascript:void(0)" class="login-user" onclick="doMyLogin()">??????</a>
                    <a href="'.$this->_tpl_vars['jieqi_url'].'/register.php" class="register">??????</a>
                    ';
}else{
echo '
                    <a href="'.$this->_tpl_vars['jieqi_url'].'/userdetail.php" target="_blank" class="motie-login">'.$this->_tpl_vars['jieqi_username'].'</a>
                    <a href="'.$this->_tpl_vars['jieqi_user_url'].'/logout.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'">??????</a>
                    <a href="'.$this->_tpl_vars['jieqi_url'].'/message.php?box=inbox">??????(<span class="red bubbleNum">'.$this->_tpl_vars['jieqi_newmessage'].'</span>)</a>
                    ';
}
echo '
                </div>
                <!-- login end-->
            </div>
        </div>
    </div>
    <!--????????? end-->
    <div class="headerbg ibody" style="margin-bottom:10px;">
        <!--???????????? start-->
        <div class="wrap1200 logo iMod">
            <a href="'.$this->_tpl_vars['jieqi_url'].'/userdetail.php" class="fl imotie">????????????</a>
            <ul class="iUl">
                <li><a href="'.$this->_tpl_vars['jieqi_url'].'/">??????</a></li>
                <li class="accounts">
                    <a href="javaScript:;">????????????</a>
                    <p>
                        <a href="'.$this->_tpl_vars['jieqi_url'].'/useredit.php">????????????</a>
                        <a href="'.$this->_tpl_vars['jieqi_url'].'/passedit.php">????????????</a>
                    </p>
                </li>
                <!--<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/authorpage.php?id='.$this->_tpl_vars['jieqi_userid'].'">????????????</a></li>-->
                <li><a href="'.$this->_tpl_vars['jieqi_url'].'/message.php?box=inbox">??????</a><cite  id="bubble" class="bubbleNum">'.$this->_tpl_vars['jieqi_newmessage'].'</cite></li>
                <li><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php" target="_blank">??????</a></li>
            </ul>
            <div id="mod-search1">
                <div class="searchbox">
                    <div class="searchbox-inner">
                        <input type="text" autocomplete="off" placeholder="???????????????" class="searchinput" value="">
                        <i class="search-icon"></i>
                        <input type="button" value="" class="searchbtn" style="background-color:#333333"/>
                        <span class="loadIcon"></span>
                    </div>
                    <ul class="search-list">
                    </ul>
                </div>
            </div>
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php" class="mybookshelf fr"><i  style="background-color:#333333"></i>????????????</a>
        </div>
        <!--???????????? end-->
        <!--?????? start-->
    </div>
    <!--?????? end-->
</div>
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/icommon.js"></script>
<script>
    accountsMod = (function(){
        var accounts = $(\'li.accounts \'), accountsDialog = $(\'li.accounts p\');
        dialogMod(accounts,accountsDialog);
    })();
</script>

<!--container mod -->
<div class="container wrap1200">
    <!--left mod -->
    <div class="i-left">
        <!--?????? mod -->
        <p class="title"><span class="setting"></span>??????</p>
        <ul>
            <li><a href="'.$this->_tpl_vars['jieqi_url'].'/useredit.php"><span class="basicInfo"></span>????????????</a></li>
            <li><a href="'.$this->_tpl_vars['jieqi_url'].'/setavatar.php"><span class="pictureInfo"></span>????????????</a></li>
            <li><a href="'.$this->_tpl_vars['jieqi_url'].'/userbind.php"><span class="basicInfo"></span>????????????</a></li>
            <li><a href="'.$this->_tpl_vars['jieqi_url'].'/passedit.php"><span class="pictureInfo"></span>????????????</a></li>
            <li><a href="'.$this->_tpl_vars['jieqi_url'].'/persondetail.php"><span class="basicInfo"></span>????????????</a></li>
        </ul>
        <!--???????????? mod -->
        <p class="title"><span></span>????????????</p>
        <ul>
            <li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php"><span></span>????????????</a></li>
            <li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookshelf.php"><span class="readed"></span>????????????</a></li>
            <li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/myreviews.php"><span class="bookreview"></span>????????????</a></li>
        </ul>
        <!--???????????? mod -->
        <p class="title"><span class="zc"></span>????????????</p>
        <ul>
            <li><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/paylog.php" data-namecard="false"><span class="money"></span>????????????</a></li>
            <li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/myactlog.php" data-namecard="false"><span class="package"></span>????????????</a></li>
            <li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/myactlog.php?act=poll" data-namecard="false"><span class="ticket"></span>???????????????</a></li>
        </ul>
        <p class="title"><span class="msg"></span>??????</p>
        <ul class="msgTab">
            <li><a href="'.$this->_tpl_vars['jieqi_url'].'/message.php?box=inbox"><span class="system"></span>?????????</a></li>
            <li><a href="'.$this->_tpl_vars['jieqi_url'].'/message.php?box=outbox"><span class="remind"></span>?????????</a></li>
            <li><a href="'.$this->_tpl_vars['jieqi_url'].'/newmessage.php"><span class="reply"></span>????????????</a></li>
        </ul>
        <!--&lt;!&ndash;?????? mod &ndash;&gt;-->
        <!--<p class="title"><span class="authorManage"></span>??????</p>-->
        <!--<ul>-->
            <!--<li><a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/mytopics.php"><span class="my_forum"></span>????????????</a></li>-->
        <!--</ul>-->
    </div>

    <script>
        $(\'.i-left ul a\').each(function(){
            var self = $(this),link = self.attr(\'href\');
            if(location.href == link){
                self.parent().addClass(\'on\');
            }
        })
    </script>
';
?>