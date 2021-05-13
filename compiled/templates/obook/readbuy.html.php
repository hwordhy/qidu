<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="'.$this->_tpl_vars['jieqi_charset'].'">
	<meta name="description" content="'.$this->_tpl_vars['meta_description'].'">
	<meta name="keywords" content=" '.$this->_tpl_vars['meta_keywords'].'">
	<meta content="zh-cn" http-equiv="Content-Language">
	<title>章节购买 - '.$this->_tpl_vars['chaptername'].' - '.$this->_tpl_vars['jieqi_pagetitle'].'</title>
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/reader.css" type="text/css">
	<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/common_chapter.css" type="text/css"/>
	<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript">var uid = "'.$this->_tpl_vars['jieqi_userid'].'"; var checkcodelogin = "'.$this->_tpl_vars['jieqi_checkcodelogin'].'"; var jieqi_token = \''.$this->_tpl_vars['jieqi_token'].'\';var jumpurl = window.location.href;</script>
</head>
<body ondragstart="return false;" oncopy="return false;" oncut="return false;" oncontextmenu="return false;" class="whitetheme">

<div class="reader_header">
</div>
<div class="path">
	<!--<a href="/" target="_blank">首页</a>-->
	<!--<span>></span>-->
	<!--<a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info',$this->_tpl_vars['articlecode']).'" target="_blank">'.$this->_tpl_vars['obookname'].'</a>-->
</div>
<div id="windowthemebg"></div>
<div class="read">
	<div class="read-box">
		<div class="chapter-page notread"
			 data-chapterid="'.$this->_tpl_vars['chapterid'].'"
			 data-nextisvip="'.$this->_tpl_vars['next_isvip'].'"
			 data-isvip="'.$this->_tpl_vars['chapterisvip'].'"
			 data-nextchapter="'.$this->_tpl_vars['next_chapterid'].'"
			 data-prechapterid="'.$this->_tpl_vars['previous_chapterid'].'">
			<h3 class="bookname">'.$this->_tpl_vars['article_title'].'</h3>
			<h4 class="chaptername">'.$this->_tpl_vars['chaptername'].'</h4>

			<p class="author">
				<span>作者：<a href="javascript:;">'.$this->_tpl_vars['author'].'</a></span>
				<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;字数：'.$this->_tpl_vars['chaptersize_c'].'</span>
			</p>
			<p class="publishtime">发布时间： '.date('Y-m-d H:i',$this->_tpl_vars['lastupdate']).'</p>

			<div class="page-content AihLvCAb">
			<pre ondragstart="return false" oncopy="return false;" oncut="return false;" oncontextmenu="return false"
				 class="note gKCvvNCavZl">'.truncate($this->_tpl_vars['summary'],'250','......').'</pre>

			</div>
			<i class="line"></i>
			<div class="subscribe-box">
				<h4 class="box-title">这是VIP章节 &nbsp;需要订阅后才能阅读</h4>
				<div class="subscribe-con clearfixer">
					<div class="con-item j-single active fl">
						<div class="subscribe-text active fl">
							订阅本章
						</div>
						<div class="subscribe-info fl">
							<p class="info-chaptername">章节：'.$this->_tpl_vars['chaptername'].'</p>
							<p class="info-chapternum">字数：'.$this->_tpl_vars['chaptersize_c'].'字 · 1章</p>
							<p class="info-paynum">需支付 ：
								';
if($this->_tpl_vars['jieqi_vipid'] > 0){
echo '您是<span class="red">'.$this->_tpl_vars['jieqi_vipname'].'</span>用户，原价 <del class="red">'.$this->_tpl_vars['saleprice'].$this->_tpl_vars['egoldname'].'</del>,现价<span class="red">'.$this->_tpl_vars['disprice'].'</span>';
}else{
echo '<span class="red">'.$this->_tpl_vars['saleprice'].'</span>';
}
echo $this->_tpl_vars['egoldname'].'</p>
							<p class="info-balance">账户余额：<span>'.$this->_tpl_vars['jieqi_egold'].'</span> '.$this->_tpl_vars['egoldname'].'</p>
							<p class="info-btn j-single-charge';
if($this->_tpl_vars['jieqi_egold'] < $this->_tpl_vars['saleprice']){
echo ' show';
}
echo '"><a target="_blank" href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php">马上充值</a></p>
							<p class="info-btn j-single-buy';
if($this->_tpl_vars['jieqi_egold'] >= $this->_tpl_vars['saleprice']){
echo ' show';
}
echo '" onclick="buy()">确认订阅</p>
							<div class="paybox_auto subscribe_auto"><label><input type="checkbox" id="autobuy"> &nbsp;不再显示订阅提醒，自动订阅下一章</label>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
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
					<li><a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/" target="_blank" class="site-tag">论坛</a></li>
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
</div>
</body>
<script>
    var page_config = {
        bookId: "'.$this->_tpl_vars['articleid'].'", // false
        username: "'.$this->_tpl_vars['jieqi_username'].'",
        voteNumber: "'.$this->_tpl_vars['allvote'].'",
        isInShelf:false,  // true  表示已在书架
        isvip: "'.$this->_tpl_vars['isvip_n'].'",
        authorName: "'.$this->_tpl_vars['author'].'",
        userId: "'.$this->_tpl_vars['jieqi_userid'].'",
        userMoneyBalance: "'.$this->_tpl_vars['jieqi_egold'].'",
        votes: "'.$this->_tpl_vars['jieqi_votes'].'",
        toTop_page:false

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
<script type="application/javascript">
    function buy() {
        if (0 == '.$this->_tpl_vars['jieqi_userid'].') {
            pop_login();
		}
        var autobuy = $("#autobuy").attr("checked");
        if (autobuy === \'checked\')
            autobuy = 1;
        else
            autobuy = 0;
        $.ajax({
            url: "/modules/obook/buychapter.php",
            data: {
                "cid" : "'.$this->_tpl_vars['chapterid'].'",
                "act" : "buy",
                "jieqi_token" : "'.$this->_tpl_vars['jieqi_token'].'",
                "ajax_gets" : 1,
                "buytype" : autobuy
            },
            type: "POST",
			dataType: "json",
            success: function(t) {
                if (t.success === true) {
                    layer.msg(t.message, {icon: 1,shade: .3});
                    // location.href = t.setting.curl;
                    setTimeout(function(){
                    	window.location.reload();
                    }, 600)
                }
                else{
                    layer.msg(t.message, {icon: 2,shade: .3});
                }
            },
            error: function(e) {}
        });
    }

</script>
</html>';
?>