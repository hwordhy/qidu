<?php
echo '<!doctype html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'"/>
	<meta content="zh-cn" http-equiv="Content-Language">
	<meta name="keywords"  content="'.$this->_tpl_vars['meta_keywords'].'">
	<meta name="description"  content="'.$this->_tpl_vars['meta_description'].'">
	<title>'.$this->_tpl_vars['jieqi_pagetitle'].'</title>
	';
if($this->_tpl_vars['jieqi_thisurl'] == '/'){
echo '
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/index.css" type="text/css" />
<body style="background:#fafafa !important;">
	';
}elseif(basename($this->_tpl_vars['jieqi_thisfile']) == 'articlefilter.php'){
echo '
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/core.packed.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/jquery-ui-1.8.16.custom.min.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/model.packed.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/book.css" type="text/css" />
	<style type="text/css">.pages_bottom{margin-top:-20px;}</style>
<body class="yy_site_body">
	';
}elseif(basename($this->_tpl_vars['jieqi_thisfile']) == 'toplist.php' || basename($this->_tpl_vars['jieqi_thisfile']) == 'articlelist.php'){
echo '
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/core.packed.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/jquery-ui-1.8.16.custom.min.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/model.packed.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/rank.css" type="text/css" />
	<body>
	';
}elseif(basename($this->_tpl_vars['jieqi_thisfile']) == 'search.php'){
echo '
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/core.packed.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/jquery-ui-1.8.16.custom.min.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/model.packed.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/layer.css" />
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/search.css" type="text/css" />
	<body id="searchbox">
	';
}elseif(basename($this->_tpl_vars['jieqi_thisfile']) == 'articleinfo.php'){
echo '
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/work_detail.css" type="text/css"/>
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/common_chapter.css" type="text/css"/>

	<body class="yy_site_body">
	';
}elseif(basename($this->_tpl_vars['jieqi_thisfile']) == 'reviews.php'){
echo '
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/core.packed.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/jquery-ui-1.8.16.custom.min.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/model.packed.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/comment_list.css"
		  type="text/css"/>
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/common_chapter.css" type="text/css"/>
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/yy.css" type="text/css"/>

	<body class="yy_site_body">
	';
}elseif(basename($this->_tpl_vars['jieqi_thisfile']) == 'reviewshow.php'){
echo '
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/core.packed.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/jquery-ui-1.8.16.custom.min.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/model.packed.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/comment_detail.css"
		  type="text/css"/>
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/common_chapter.css"
		  type="text/css"/>
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/yy.css" type="text/css"/>

	<body class="yy_site_body">
	';
}elseif($this->_tpl_vars['jieqi_thisurl'] == '/modules/forum/' || basename($this->_tpl_vars['jieqi_thisfile']) == 'topiclist.php'){
echo '
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/page.css" type="text/css">
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/forum.css" type="text/css"/>
	<body class="yy_site_body">
	';
}elseif(basename($this->_tpl_vars['jieqi_thisfile']) == 'showtopic.php'){
echo '
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/i.css" type="text/css" />
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/iyy.css" type="text/css" />
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/postdetail.css" type="text/css"/>
	<body class="yy_site_body">
	';
}elseif(basename($this->_tpl_vars['jieqi_thisfile']) == 'creditlist.php'){
echo '
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/core.packed.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/jquery-ui-1.8.16.custom.min.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/model.packed.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/comment_list.css"
		  type="text/css"/>
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/common_chapter.css"
		  type="text/css"/>
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/yy.css" type="text/css"/>

	<body class="yy_site_body">
	';
}elseif(basename($this->_tpl_vars['jieqi_thisfile']) == 'newpost.php' || basename($this->_tpl_vars['jieqi_thisfile']) == 'postedit.php'){
echo '
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/postadd.css" type="text/css" />
	<body>
	';
}elseif(basename($this->_tpl_vars['jieqi_thisfile']) == 'buyegold.php'){
echo '
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/pay.css" type="text/css" />
	<style>.popup .pay-btn a.otherbtn:hover{color:#666 !important;}</style>
	<body>
	';
}elseif(basename($this->_tpl_vars['jieqi_thisfile']) == 'page.php'){
echo '
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/core.packed.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/jquery-ui-1.8.16.custom.min.css" rel="stylesheet" type="text/css" />
	<link href="'.$this->_tpl_vars['jieqi_url'].'/style/css/model.packed.css" rel="stylesheet" type="text/css" />
	<body>
	';
}
echo '
<!--start header -->
<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/index_header.css" type="text/css" class="mmyqwhref"/>
<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/motie.css" type="text/css"/>
<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/page.css" type="text/css">

<script type="text/javascript">var uid = "'.$this->_tpl_vars['jieqi_userid'].'"; var checkcodelogin = "'.$this->_tpl_vars['jieqi_checkcodelogin'].'"; var jieqi_token = \''.$this->_tpl_vars['jieqi_token'].'\';var jumpurl = window.location.href;</script>
<div class="index-header" id="topback">
	<!--零导航 start-->
	<div class="subnav">
		<div class="subnavbar" style="background:#f2f2f2;">
			<div class="subnavbar-content" style="background:transparent;">
				<div class="con_left  fl">
					<a href="javascript:;" onclick="AddFavorite(\''.$this->_tpl_vars['jieqi_url'].'\', \''.$this->_tpl_vars['jieqi_sitename'].'\');">收藏本站</a>
				</div>
				<!-- nologin start-->
				<div class="right-login fr">
					';
if($this->_tpl_vars['jieqi_userid'] == 0){
echo '
					<a href="javascript:void(0)" class="login-user" onclick="doMyLogin()">登录</a>
					<a href="'.$this->_tpl_vars['jieqi_url'].'/register.php" class="register">注册</a>
					';
}else{
echo '
					<a href="'.$this->_tpl_vars['jieqi_url'].'/userdetail.php" target="_blank" class="motie-login">'.$this->_tpl_vars['jieqi_username'].'</a>
					<a href="'.$this->_tpl_vars['jieqi_user_url'].'/logout.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'">退出</a>
					<a href="'.$this->_tpl_vars['jieqi_url'].'/message.php?box=inbox">消息(<span class="red bubbleNum">'.$this->_tpl_vars['jieqi_newmessage'].'</span>)</a>
					';
}
echo '
					<span class="indexmobile">
                                手机版
						<div class="pho-tabs" style="display: none">
							<em class="dot-top"></em>
							<ul>
								<li>
									<span class="scode fl"><a href="'.$this->_tpl_vars['jieqi_wap_url'].'" target="_blank"><img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/wap.png"/></a></span>
									<p class="fr" style="margin-top: 10px;">
										<span class="f14">'.$this->_tpl_vars['jieqi_sitename'].'</span>
										<span>让阅读更精彩</span>
									</p>
								</li>
								<li>
									<span class="scode fl"><img
											src="'.$this->_tpl_vars['jieqi_url'].'/style/images/weixin.jpg"/></span>
									<p class="fr" style="margin-top: 17px;">
										<span class="f14">关注'.$this->_tpl_vars['jieqi_sitename'].'</span>
										<span>微信扫一扫关注</span>
									</p>
								</li>
							</ul>
						</div>
					</span>
				</div>
			</div>
		</div>
	</div>
	<!--零导航 end-->
	<div class="header-bg">
		<div class="logozone" style="background:#fff ;">

			<!--搜索部分 start-->
			<div class="wrap1200 logo">
				<a href="/" class="fl">
					<img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/logo.png" class="logoImage"/>
				</a>
				<div id="mod-search1">
					<div class="searchbox">
						<div class="searchbox-inner">
							<input type="text" autocomplete="off" placeholder="找书、找人" class="searchinput" value="">
							<i class="search-icon"></i>
							<input type="button" value="" class="searchbtn" style="background-color:#333333"/>
							<span class="loadIcon"></span>
						</div>
						<ul class="search-list">
						</ul>
					</div>
				</div>
				<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php" class="mybookshelf fr"><i style="background-color:#333333"
																	  id="icon-zuitang"></i>我的书架</a>
			</div>
			<!--搜索部分 end-->
			<!--导航 start-->
		</div>
	</div>
	<div class="firstnav" style="background-color:#333333">
		<ul  >
			<li class="nav_index" ><a  target="_blank"  href="/" >首页</a></li>
			<li class="nav_book" ><a  target="_blank"  href="'.jieqi_geturl('article','articlefilter','1','').'" >书库</a></li>
			<li class="nav_rank" ><a  target="_blank"  href="'.jieqi_geturl('article','toplist','1','toplist').'" >排行</a></li>
			<li class="nav_list" ><a  target="_blank"  href="'.jieqi_geturl('article','articlelist','1','','1').'">全本</a></li>
			<!--<li class="nav_bbs" ><a  target="_blank"  href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/" target="_blank">论坛</a></li>-->
			<li  ><a  target="_blank"  href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/applywriter.php" >作家专区</a></li>
			<li class="nav_reward" ><a  target="_blank"  href="/fuli" >福利</a></li>
			<li class="nav_pay" ><a  target="_blank"  href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php" >充值</a></li>
		</ul>
	</div>
	<!--导航 end-->
</div>
<script type="application/javascript">
    function  doMyLogin() {
        if(typeof(pop_login)==\'undefined\'){
            window.location.href="'.$this->_tpl_vars['jieqi_url'].'/login.php"
        }else{
            pop_login();
        }

    }




</script>
<!-- end header -->

	';
if(empty($this->_tpl_vars['jieqi_sideblocks']) == false){
}
echo '
		';
if($this->_tpl_vars['jieqi_top_bar'] != ""){
echo $this->_tpl_vars['jieqi_top_bar'];
}
echo '

		';
if(empty($this->_tpl_vars['jieqi_sideblocks']) == false){
echo '
		';
if(empty($this->_tpl_vars['jieqi_sideblocks']['7']) == false){
echo '
				';
if (empty($this->_tpl_vars['jieqi_sideblocks']['7'])) $this->_tpl_vars['jieqi_sideblocks']['7'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['7'])) $this->_tpl_vars['jieqi_sideblocks']['7'] = (array)$this->_tpl_vars['jieqi_sideblocks']['7'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['7']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['7']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['7']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['7']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['7']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
				';
if($this->_tpl_vars['jieqi_sideblocks']['7'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo '

	'.$this->_tpl_vars['jieqi_sideblocks']['7'][$this->_tpl_vars['i']['key']]['title'].'
				'.$this->_tpl_vars['jieqi_sideblocks']['7'][$this->_tpl_vars['i']['key']]['content'].'

				';
}else{
echo '
				'.$this->_tpl_vars['jieqi_sideblocks']['7'][$this->_tpl_vars['i']['key']]['content'].'
				';
}
echo '
				';
}
echo '

		';
}
echo '

		';
if(empty($this->_tpl_vars['jieqi_sideblocks']['2']) == false || empty($this->_tpl_vars['jieqi_sideblocks']['3']) == false){
echo '

				';
if (empty($this->_tpl_vars['jieqi_sideblocks']['2'])) $this->_tpl_vars['jieqi_sideblocks']['2'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['2'])) $this->_tpl_vars['jieqi_sideblocks']['2'] = (array)$this->_tpl_vars['jieqi_sideblocks']['2'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['2']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['2']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['2']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['2']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['2']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
				';
if($this->_tpl_vars['jieqi_sideblocks']['2'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo '
				'.$this->_tpl_vars['jieqi_sideblocks']['2'][$this->_tpl_vars['i']['key']]['title'].'
	'.$this->_tpl_vars['jieqi_sideblocks']['2'][$this->_tpl_vars['i']['key']]['content'].'
				';
}else{
echo '
				'.$this->_tpl_vars['jieqi_sideblocks']['2'][$this->_tpl_vars['i']['key']]['content'].'
				';
}
echo '
				';
}
echo '

				';
if (empty($this->_tpl_vars['jieqi_sideblocks']['3'])) $this->_tpl_vars['jieqi_sideblocks']['3'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['3'])) $this->_tpl_vars['jieqi_sideblocks']['3'] = (array)$this->_tpl_vars['jieqi_sideblocks']['3'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['3']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['3']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['3']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['3']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['3']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
				';
if($this->_tpl_vars['jieqi_sideblocks']['3'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo '
				'.$this->_tpl_vars['jieqi_sideblocks']['3'][$this->_tpl_vars['i']['key']]['title'].'
					'.$this->_tpl_vars['jieqi_sideblocks']['3'][$this->_tpl_vars['i']['key']]['content'].'
				';
}else{
echo '
				'.$this->_tpl_vars['jieqi_sideblocks']['3'][$this->_tpl_vars['i']['key']]['content'].'
				';
}
echo '
				';
}
echo '
		';
}
echo '

			';
if(empty($this->_tpl_vars['jieqi_sideblocks']['9']) == false){
echo '
				';
if (empty($this->_tpl_vars['jieqi_sideblocks']['9'])) $this->_tpl_vars['jieqi_sideblocks']['9'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['9'])) $this->_tpl_vars['jieqi_sideblocks']['9'] = (array)$this->_tpl_vars['jieqi_sideblocks']['9'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['9']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['9']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['9']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['9']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['9']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
				';
if($this->_tpl_vars['jieqi_sideblocks']['9'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo '
				'.$this->_tpl_vars['jieqi_sideblocks']['9'][$this->_tpl_vars['i']['key']]['title'].'
					'.$this->_tpl_vars['jieqi_sideblocks']['9'][$this->_tpl_vars['i']['key']]['content'].'
				';
}else{
echo '
				'.$this->_tpl_vars['jieqi_sideblocks']['9'][$this->_tpl_vars['i']['key']]['content'].'
				';
}
echo '
				';
}
echo '
			';
if(empty($this->_tpl_vars['jieqi_sideblocks']['1']) == false){
}else{
}
echo '
			';
}elseif(empty($this->_tpl_vars['jieqi_sideblocks']['0']) == false){
echo '
				';
if (empty($this->_tpl_vars['jieqi_sideblocks']['0'])) $this->_tpl_vars['jieqi_sideblocks']['0'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['0'])) $this->_tpl_vars['jieqi_sideblocks']['0'] = (array)$this->_tpl_vars['jieqi_sideblocks']['0'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['0']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['0']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['0']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['0']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['0']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
				';
if($this->_tpl_vars['jieqi_sideblocks']['0'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo '
				'.$this->_tpl_vars['jieqi_sideblocks']['0'][$this->_tpl_vars['i']['key']]['title'].'
					'.$this->_tpl_vars['jieqi_sideblocks']['0'][$this->_tpl_vars['i']['key']]['content'].'
				';
}else{
echo '
				'.$this->_tpl_vars['jieqi_sideblocks']['0'][$this->_tpl_vars['i']['key']]['content'].'
				';
}
echo '
				';
}
echo '

			';
if(empty($this->_tpl_vars['jieqi_sideblocks']['1']) == false){
}
echo '
				';
}else{
echo '
				';
if(empty($this->_tpl_vars['jieqi_sideblocks']['1']) == false){
}
echo '
					';
}
echo '
					';
if(empty($this->_tpl_vars['jieqi_sideblocks']['4']) == false){
echo '
					';
if (empty($this->_tpl_vars['jieqi_sideblocks']['4'])) $this->_tpl_vars['jieqi_sideblocks']['4'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['4'])) $this->_tpl_vars['jieqi_sideblocks']['4'] = (array)$this->_tpl_vars['jieqi_sideblocks']['4'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['4']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['4']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['4']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['4']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['4']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
					';
if($this->_tpl_vars['jieqi_sideblocks']['4'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo '
					'.$this->_tpl_vars['jieqi_sideblocks']['4'][$this->_tpl_vars['i']['key']]['title'].'
						'.$this->_tpl_vars['jieqi_sideblocks']['4'][$this->_tpl_vars['i']['key']]['content'].'

					';
}else{
echo '
					'.$this->_tpl_vars['jieqi_sideblocks']['4'][$this->_tpl_vars['i']['key']]['content'].'
					';
}
echo '
					';
}
echo '
					';
}
echo '
					';
if(empty($this->_tpl_vars['jieqi_sideblocks']['5']) == false){
echo '
					';
if (empty($this->_tpl_vars['jieqi_sideblocks']['5'])) $this->_tpl_vars['jieqi_sideblocks']['5'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['5'])) $this->_tpl_vars['jieqi_sideblocks']['5'] = (array)$this->_tpl_vars['jieqi_sideblocks']['5'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['5']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['5']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['5']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['5']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['5']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
					';
if($this->_tpl_vars['jieqi_sideblocks']['5'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo '
					'.$this->_tpl_vars['jieqi_sideblocks']['5'][$this->_tpl_vars['i']['key']]['title'].'
						'.$this->_tpl_vars['jieqi_sideblocks']['5'][$this->_tpl_vars['i']['key']]['content'].'
					';
}else{
echo '
					'.$this->_tpl_vars['jieqi_sideblocks']['5'][$this->_tpl_vars['i']['key']]['content'].'
					';
}
echo '
					';
}
echo '
					';
}
echo '

					';
if($this->_tpl_vars['jieqi_contents'] != ""){
echo $this->_tpl_vars['jieqi_contents'];
}
echo '

					';
if(empty($this->_tpl_vars['jieqi_sideblocks']['6']) == false){
echo '
					';
if (empty($this->_tpl_vars['jieqi_sideblocks']['6'])) $this->_tpl_vars['jieqi_sideblocks']['6'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['6'])) $this->_tpl_vars['jieqi_sideblocks']['6'] = (array)$this->_tpl_vars['jieqi_sideblocks']['6'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['6']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['6']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['6']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['6']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['6']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
					';
if($this->_tpl_vars['jieqi_sideblocks']['6'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo '
					'.$this->_tpl_vars['jieqi_sideblocks']['6'][$this->_tpl_vars['i']['key']]['title'].'
						'.$this->_tpl_vars['jieqi_sideblocks']['6'][$this->_tpl_vars['i']['key']]['content'].'
					';
}else{
echo '
					'.$this->_tpl_vars['jieqi_sideblocks']['6'][$this->_tpl_vars['i']['key']]['content'].'
					';
}
echo '
					';
}
echo '
					';
}
echo '


					';
if(empty($this->_tpl_vars['jieqi_sideblocks']['1']) == false){
echo '

						';
if (empty($this->_tpl_vars['jieqi_sideblocks']['1'])) $this->_tpl_vars['jieqi_sideblocks']['1'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['1'])) $this->_tpl_vars['jieqi_sideblocks']['1'] = (array)$this->_tpl_vars['jieqi_sideblocks']['1'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['1']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['1']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['1']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['1']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['1']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
						';
if($this->_tpl_vars['jieqi_sideblocks']['1'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo '
						'.$this->_tpl_vars['jieqi_sideblocks']['1'][$this->_tpl_vars['i']['key']]['title'].'
							'.$this->_tpl_vars['jieqi_sideblocks']['1'][$this->_tpl_vars['i']['key']]['content'].'
						';
}else{
echo '
						'.$this->_tpl_vars['jieqi_sideblocks']['1'][$this->_tpl_vars['i']['key']]['content'].'
						';
}
echo '
						';
}
echo '
					';
}
echo '

				';
if(empty($this->_tpl_vars['jieqi_sideblocks']['8']) == false){
echo '

						';
if (empty($this->_tpl_vars['jieqi_sideblocks']['8'])) $this->_tpl_vars['jieqi_sideblocks']['8'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['8'])) $this->_tpl_vars['jieqi_sideblocks']['8'] = (array)$this->_tpl_vars['jieqi_sideblocks']['8'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['8']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['8']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['8']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['8']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['8']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
						';
if($this->_tpl_vars['jieqi_sideblocks']['8'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo '
						'.$this->_tpl_vars['jieqi_sideblocks']['8'][$this->_tpl_vars['i']['key']]['title'].'
							'.$this->_tpl_vars['jieqi_sideblocks']['8'][$this->_tpl_vars['i']['key']]['content'].'
						';
}else{
echo '
						'.$this->_tpl_vars['jieqi_sideblocks']['8'][$this->_tpl_vars['i']['key']]['content'].'
						';
}
echo '
						';
}
echo '
				';
}
echo '

				';
}else{
echo '
				'.$this->_tpl_vars['jieqi_contents'].'
				';
}
echo '

				';
if($this->_tpl_vars['jieqi_bottom_bar'] != ""){
echo $this->_tpl_vars['jieqi_bottom_bar'];
}
echo '
				';
if(empty($this->_tpl_vars['jieqi_sideblocks']) == false){
}
echo '
	';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/footer.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
</body>
</html>
';
?>