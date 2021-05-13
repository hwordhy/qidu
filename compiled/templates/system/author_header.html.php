<?php
echo '<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"  content="'.$this->_tpl_vars['meta_keywords'].'">
    <meta name="description"  content="'.$this->_tpl_vars['meta_description'].'">
    <title>'.$this->_tpl_vars['jieqi_pagetitle'].'</title>
    <meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'">
    <!-- [if lte IE 8]>
    <meta http-equiv="X-UA-Compatible" content="IE=7,chrome=1" />
    <![endif]-->
    <link href="'.$this->_tpl_vars['jieqi_url'].'/style/author/css/core.packed.css" rel="stylesheet" type="text/css" />
    <link href="'.$this->_tpl_vars['jieqi_url'].'/style/author/css/jquery-ui-1.8.16.custom.min.css" rel="stylesheet" type="text/css" />
    <link href="'.$this->_tpl_vars['jieqi_url'].'/style/author/css/model.packed.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/author/css/page.css" type="text/css">
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/jquery.min.js"></script>

    <!--[if IE 6]>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/dd_belatedpng.js"></script>
    <script type="text/javascript"> document.execCommand("BackgroundImageCache", false, true); </script>
    <![endif]-->
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/plugin.js"></script>

    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/motie.core.packed.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/male_index.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/jquery.infieldlabel.min.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/motie.editor.js"></script>
    <link href="'.$this->_tpl_vars['jieqi_url'].'/style/author/css/bootstrap.min.css" rel="stylesheet">
    <link href="'.$this->_tpl_vars['jieqi_url'].'/style/author/css/dashboard.css" rel="stylesheet">
    <script src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/layer.js"></script>
    <script src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/common.js"></script>
    <script type="text/javascript">
        $(function(){
            Mo.init.InitAll();
            Mo.core.collect();
        })
    </script>
    <style>
        .cmxform .code-item{
            margin-top:5px;
        }
        .message-item .label.error{
            margin-top:7px;
        }
    </style>
</head>

<body';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'newarticle.php' || basename($this->_tpl_vars['jieqi_thisfile']) == 'newebook.php' || basename($this->_tpl_vars['jieqi_thisfile']) == 'articleedit.php'){
echo ' class="page-type-2 book_edit"';
}
echo '>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid containerw commonheader">
        <div class="logobox">
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/myarticle.php" ><img src="'.$this->_tpl_vars['jieqi_url'].'/style/author/images/logo-mt.png"></a>
        </div>
        <div class="loginbox">
            <a href="/" class="index-gift" target="_blank">首页</a>
            <a href="/fuli/" class="index-gift" target="_blank">
                <img src="'.$this->_tpl_vars['jieqi_url'].'/style/author/images/gifticn.png">作家福利
            </a>
            <div href="/author_area/author/detail" class="indexauthorhead">
                <img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['jieqi_userid'],'l',$this->_tpl_vars['jieqi_avatar']).'"/>
                <span>'.$this->_tpl_vars['jieqi_username'].'</span>
                <div class="indexauthorhead_in">
                    <span class="triangleIcon"></span>
                    <div class="indexauthorhead_con">
                        <a href="'.$this->_tpl_vars['jieqi_url'].'/persondetail.php" class="authorData"><p>基本信息</p></a>
                        <a href="'.$this->_tpl_vars['jieqi_user_url'].'/logout.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'" class="exit"><p>退出</p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="relation">
        <span class="ralamenu">联系客服</span>
        <p class="ralatxt">
                <span>
                        Q Q：2213788946<br>
                        电话：029-82285623<br>
                        邮箱：2213788946@qq.com
                </span>
        </p>

    </div>
    <script>
        $(\'.relation\').mouseenter(function(){
            $(\'.ralatxt\').stop(true).animate({ width : 180},500)
        }).mouseleave (function(){
            $(\'.ralatxt\').stop(true).animate({ width : 0},500)
        });
    </script>
</nav>
';
?>