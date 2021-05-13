<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="'.$this->_tpl_vars['jieqi_charset'].'">
	<meta name="description" content="'.$this->_tpl_vars['meta_description'].'">
	<meta name="keywords" content=" '.$this->_tpl_vars['meta_keywords'].'">
	<meta content="zh-cn" http-equiv="Content-Language">
	<title>'.$this->_tpl_vars['article_title'].'-'.$this->_tpl_vars['jieqi_title'].'-'.$this->_tpl_vars['sortname'].'-'.$this->_tpl_vars['jieqi_sitename'].'</title>
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/reader.css" type="text/css">
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/common_chapter.css" type="text/css"/>
	<script type="text/javascript">var uid = "'.$this->_tpl_vars['jieqi_userid'].'"; var checkcodelogin = "'.$this->_tpl_vars['jieqi_checkcodelogin'].'"; var jieqi_token = \''.$this->_tpl_vars['jieqi_token'].'\';var jumpurl = window.location.href;</script>
</head>
<body ondragstart="return false;" oncopy="return false;" oncut="return false;" oncontextmenu="return false;" class="whitetheme">

<div class="reader_header">
</div>
<div class="path">
	<a href="/" target="_blank">首页</a>
	<span>></span>
	<a target="_blank" href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['sortid']).'">'.$this->_tpl_vars['sort'].'</a>
	<span>></span>
	<a href="'.$this->_tpl_vars['url_articleinfo'].'" target="_blank">'.$this->_tpl_vars['articlename'].'</a>
</div>
<div id="windowthemebg"></div>
<div class="read">
	<div class="read-box">
		<div class="blank-div"></div>
	</div>

</div>
<div class="addscorllbar"></div>
<div id="floatbox">
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/index_header.css" type="text/css"
		  class="mmyqwhref"/>
	<div class="secondnav" id="back-to-top" style="display: none;">
		<div class="wrap1200">
			<div class="secondnav-l fl">
				<ul>
					<li><a href="/" class="sitename">'.$this->_tpl_vars['jieqi_sitename'].'</a></li>
					<li><a href="'.jieqi_geturl('article','articlefilter','1','').'" target="_blank" class="site-tag">书库</a></li>
					<li><a href="'.jieqi_geturl('article','toplist','1','toplist').'" target="_blank" class="site-tag">排行</a></li>
					<li><a href="'.jieqi_geturl('article','articlelist','1','','1').'" target="_blank" class="site-tag">全本</a></li>
					<!--<li><a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/" target="_blank" class="site-tag">论坛</a></li>-->
					<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/applywriter.php" target="_blank" class="site-tag">作家专区</a></li>
					<li class="morefl "><a href="#" target="_blank" class="moreh ">更多</a>
						<div class="morestyle">
							';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
							<a href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['i']['key']).'" target="_blank">'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['caption'].'</a>
							';
}
echo '
						</div>
					</li>
				</ul>
			</div>
			<div class="secondnav-r fr">
				';
if($this->_tpl_vars['jieqi_userid'] == 0){
echo '
				<div class="nav-login">
					<a href="javascript:void(0)" class="login-user" onclick="doMyLogin()">登录</a>
					<a href="'.$this->_tpl_vars['jieqi_url'].'/register.php" class="register">注册</a>
				</div>
				';
}else{
echo '
				<div class="secondnav-user fl">
					<a href="'.$this->_tpl_vars['jieqi_url'].'/userdetail.php" target="_blank" class="firstname"><span>'.$this->_tpl_vars['jieqi_username'].'</span><i></i></a>
					<ul>
						<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php" target="_blank">我的书架</a></li>
						<li><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php" target="_blank">充值</a></li>
						<li><a href="'.$this->_tpl_vars['jieqi_url'].'/userdetail.php" target="_blank">个人中心</a></li>
						<li><a href="'.$this->_tpl_vars['jieqi_url'].'/message.php?box=inbox" target="_blank">消息(<em class="red bubbleNum">'.$this->_tpl_vars['jieqi_newmessage'].'</em>)</a></li>
						<li><a href="'.$this->_tpl_vars['jieqi_user_url'].'/logout.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'" target="_blank">退出</a></li>
					</ul>
				</div>
				';
}
echo '
				<div class="fr lateread">
					<a href="javascript:void(0);"  class="lateread_text">最近阅读</a>
					<div class="lastread_box">
						<span class="icon-read"></span>
						<div class="lastread_con">
							<p class="unlogin"><a href="javascript:void(0)" class="login" onclick="pop_login()">登录</a></p>
							<p class="loading">loading...</p>
						</div>
					</div>
				</div>
				<div id="mod-search2">
					<div class="searchbox">
						<div class="searchbox-inner">
							<input type="text" autocomplete="off" placeholder="找书、找人" class="searchinput" value="">
							<i class="search-icon"></i>
							<input type="button" value="" class="searchbtn" style="background-color:#f5546f"/>
							<span class="loadIcon"></span>
						</div>
						<ul class="search-list">
						</ul>
					</div></div>
			</div>
		</div>
	</div>
	<ul class="leftbar">
		<li class="catalog">目录</li>
		<li class="settings"><i></i></li>
		<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php" target="_blank"><li class="addshelf"><i></i></li></a>
		<li class="cellphone"><i></i></li>
		<li class="guide">指南</li>
	</ul>
	<ul class="rightbar">
		<li class="donate"> 打赏</li>
		<li class="vote">投票</li>
		<li class="prevpage"><i></i></li>
		<li class="nextpage"><i></i></li>
	</ul>
	<ul class="guide_tips_left">
		<li>查看目录</li>
		<li class="setting">修改设置</li>
		<li>加入书架</li>
		<li>手机阅读</li>
	</ul>
	<ul class="guide_tips_right">
		<li>打赏</li>
		<li>投票</li>
		<li class="prev">查看上一页</li>
		<li class="next">查看下一页</li>
	</ul>
	<div class="guide-pop">
		<div class="guide-title">指南</div>
		<a href="javascript:;" class="close"></a>
		<div class="content clearfixer">
			<div class="con-right">
				<div class="clearfixer">
					<span class="t"></span>
					<span class="b"></span>
				</div>
				<p>上下翻页</p>
			</div>
		</div>
		<p class="guide-btn">我知道了</p>

	</div>
	<div class="settings_con">
		<span class="set_title">设置</span>
		<span class="close"><i></i></span>
		<ul class="set_bg clearfixer">
			<li class="set_bg_text">主题模式</li>
			<li class="set_bg_white set_bg_com on" data-bodytheme="whitetheme"></li>
			<li class="set_bg_black set_bg_com" data-bodytheme="blacktheme"></li>
			<li class="set_bg_qing set_bg_com" data-bodytheme="qingsetheme"></li>
			<li class="set_bg_dirt set_bg_com" data-bodytheme="tuhuangtheme"></li>
			<li class="set_bg_pink set_bg_com" data-bodytheme="pinktheme"></li>
			<li class="set_bg_green set_bg_com" data-bodytheme="zuitangtheme"></li>
		</ul>
		<ul class="set_font clearfixer">
			<li class="set_font_text">字体大小</li>
			<li class="set_font_small">
				<span></span>
			</li>
			<li class="set_font_cur">18</li>
			<li class="set_font_big">
				<span></span>
			</li>
		</ul>
		<ul class="set_style clearfixer">
			<li class="set_style_text">字体样式</li>
			<li class="set_style_yh set_style_com on" data-family="familymicro">
				<span></span>雅黑
			</li>
			<li class="set_style_st set_style_com" data-family="familysimsun">
				<span></span>宋体
			</li>
			<li class="set_font_ks set_style_com" data-family="familykaiti">
				<span></span>楷书
			</li>
		</ul>
		<span class="set_default">恢复默认</span>
	</div>
	<div id="windowbg"></div>
	<div class="erweima_app">
		<span class="erweima_app_close"><i></i></span>
		<img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/wap.png" data-src="" alt="">
	</div>
	<div class="loading">
		<img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/loading_style.gif" alt="">
	</div>
</div>
</body>
<script>
    var page_config = {
        bookId: "'.$this->_tpl_vars['articleid'].'", // false
        chapterId: "'.$this->_tpl_vars['chapterid'].'",
        username: "'.$this->_tpl_vars['jieqi_username'].'",
        voteNumber: "'.$this->_tpl_vars['allvote'].'",
        isInShelf:false,  // true  表示已在书架
        nextisvip: "'.$this->_tpl_vars['next_isvip'].'",  // 下一章节是否收费
        isvip: "'.$this->_tpl_vars['chapterisvip'].'",
        authorName: "'.$this->_tpl_vars['author'].'",
        userId: "'.$this->_tpl_vars['jieqi_userid'].'",
        userMoneyBalance: "'.$this->_tpl_vars['jieqi_egold'].'",
        nextChapterId: "'.$this->_tpl_vars['next_chapterid'].'",
        votes: "'.$this->_tpl_vars['jieqi_votes'].'",
        toTop_page:false,
        curChapterId:"'.$this->_tpl_vars['chapterid'].'"

    }
</script>


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

</script><script type="text/javascript">
    var _loginUser = \'basic\';
    var _config = \'\';
</script>
<script type="application/javascript">
    function  doMyLogin() {
        if(typeof(pop_login)==\'undefined\'){
            window.location.href="'.$this->_tpl_vars['jieqi_url'].'/login.php"
        }else{
            pop_login();
        }

    }

</script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/handlebars-v4.0.5.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/handlebars.helper.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/vendor.js"></script>
<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/ui_common.css">
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/index_header.js"></script>

<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/common_chapter.js"></script>
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/reader.js"></script>
</html>
';
?>