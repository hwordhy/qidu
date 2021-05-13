<?php
echo '<style>
    .btns .checkcode {
        width: 80px;
        height: 25px;
        margin-top: 3px;
        margin-right: 10px;
        cursor: pointer;
    }
</style>
<div class="path ">
    <a href="/" target="_blank">首页</a>
    <span>></span>
    <a target="_blank" href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['sortid']).'">'.$this->_tpl_vars['sort'].'</a>
    <span>></span>
    <span>
            <a href="'.$this->_tpl_vars['url_articleinfo'].'" target="_blank">'.$this->_tpl_vars['articlename'].'</a>
        </span>
    <span>></span>
    <span>     <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'" target="_blank">书友评论 </a>   </span>
    <span>></span>
    <span><a href="javascript:;" target="_blank">评论详情</a></span>
</div>
<div class="comment-box clearfixer">
    <div class="fl authorbox">
        <a href="'.$this->_tpl_vars['url_articleinfo'].'" class="authorimg" target="_blank"><img src="'.$this->_tpl_vars['url_image'].'"/></a>
        <a href="'.$this->_tpl_vars['url_articleinfo'].'" class="a-book-tit" target="_blank">'.$this->_tpl_vars['articlename'].'</a>
        <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/authorpage.php?id='.$this->_tpl_vars['authorid'].'" class="a-name" target="_blank" >'.$this->_tpl_vars['author'].'</a>
        <p class="a-btn">
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articleread.php?id='.$this->_tpl_vars['articleid'].'" class="a-free-btn btn ui_bgcolor ui_bg_bdcolor" target="_blank">免费试读</a>
            ';
if($this->_tpl_vars['is_bookcase'] > 0){
echo '
            <span class="a-bookshelf-btn onshelf btn">已在书架</span>
            ';
}else{
echo '
            <a href="javascript:;" class="addshelf a-bookshelf-btn btn">加入书架</a>
            ';
}
echo '
        </p>
    </div>
    <div class="reader_comments fr" id="comment-tab">
        <div class="comment_tit clearfixer">
            <span class="text fl">书友评论</span>
            <div class="comment-tab fl j-comment-tab">
            </div>
            <span class="sendcomment">发表评论</span>
        </div>
        ';
if($this->_tpl_vars['ismaster'] == 1){
echo '
        <p class="review-config">
            <span class="review-config-top ui_color">';
if($this->_tpl_vars['istop'] == 0){
echo '置顶';
}else{
echo '取消置顶';
}
echo '</span>
            <span class="review-config-essence ui_color">';
if($this->_tpl_vars['isgood'] == 0){
echo '精华';
}else{
echo '取消精华';
}
echo '</span>
        </p>
        ';
}
echo '
        <div class="comment_con j-comment-main">
            <div class="comment_con_newes">
                ';
if (empty($this->_tpl_vars['replyrows'])) $this->_tpl_vars['replyrows'] = array();
elseif (!is_array($this->_tpl_vars['replyrows'])) $this->_tpl_vars['replyrows'] = (array)$this->_tpl_vars['replyrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['replyrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['replyrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['replyrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['replyrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['replyrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                ';
if($this->_tpl_vars['i']['order'] == 1){
echo '
                <div class="comment_item clearfixer j_comment_item" data-commentid="'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['postid'].'">
                    <div class="left fl">

                        <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/authorpage.php?id='.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posterid'].'" class="avatar" target="_blank">
                            <img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posterid'],'l',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['avatar']).'">

                        </a>
                        <div class="nickname">
                            <!--<span class="level v1"></span>-->
                            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/authorpage.php?id='.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posterid'].'" class="nickname_text" target="_blank">'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['username'].'</a>
                        </div>
                    </div>
                    <div class="right fl">
                        <p class="item_title">

                            ';
if($this->_tpl_vars['istop'] == 1){
echo '<span class="totop">[置顶]</span>';
}
if($this->_tpl_vars['isgood'] == 1){
echo '<span class="essence">[精华]</span>';
}
echo '<span class="">'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['subject'].'</span>

                        </p>
                        <p class="comment-text">'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posttext'].'</p>
                        <p class="clearfixer behavior">
                            <span class="fl time">'.date('Y-m-d H:i:s',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posttime']).'</span>
                            ';
if($this->_tpl_vars['ismaster'] == 1){
echo '
                            <span class="fr like  recommend favorited" onclick="dels(\''.$this->_tpl_vars['topicid'].'\', \''.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['postid'].'\')">删除</span>
                            ';
}
echo '
                            <span class="fr reply">回复</span>


                        </p>
                        <div class="replybox">
                            <span class="replyer">回复@'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['username'].':</span>
                            <textarea name="" cols="30" rows="10"></textarea>
                            <div class="btns clearfixer">
                                ';
if($this->_tpl_vars['postcheckcode'] > 0){
echo '
                                <span class="code fl">验证码：<input type="text" class="checkcode" size="8" maxlength="8" id="checkcode" name="checkcode" value=""><img src="'.$this->_tpl_vars['jieqi_url'].'/checkcode.php" style="margin-right: 10px;" onclick="this.src=\''.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\' + Math.random();"></span>
                                ';
}
echo '
                                <span class="face fl"></span>
                                <span class="replying fl">回复</span>
                            </div>
                            <span class="err-tips">不能少于5个字</span>
                        </div>
                    </div>
                </div>
                ';
}
echo '
                ';
}
echo '
                <div class="detail_list">
                    <!-- 回复循环开始-->
                    ';
if (empty($this->_tpl_vars['replyrows'])) $this->_tpl_vars['replyrows'] = array();
elseif (!is_array($this->_tpl_vars['replyrows'])) $this->_tpl_vars['replyrows'] = (array)$this->_tpl_vars['replyrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['replyrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['replyrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['replyrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['replyrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['replyrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    ';
if($this->_tpl_vars['i']['order'] > 1){
echo '
                    <div class="detail_item j_comment_item" data-replyid="'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['postid'].'">

                        <p class="comment-text">
                            ';
if($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posterid'] == $this->_tpl_vars['authorid']){
echo '<span class="detail_item_author">作者</span>';
}
echo '
                            <span class="detail_item_reply ui_color">'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['username'].'：</span>
                            '.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posttext'].'</p>
                        <p class="clearfixer behavior">
                            <span class="fl time">'.date('Y-m-d H:i:s',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posttime']).'</span>
                            ';
if($this->_tpl_vars['ismaster'] == 1){
echo '
                            <span class="fr like  recommend favorited" onclick="del(\''.$this->_tpl_vars['topicid'].'\', \''.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['postid'].'\')">删除</span>
                            ';
}
echo '
                            <span class="fr reply">回复</span>
                            <span class="fr report">举报</span>
                        </p>
                        <div class="replybox">
                            <span class="replyer">回复@'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['username'].':</span>
                            <textarea name="" id="" cols="30" rows="10"></textarea>
                            <div class="btns clearfixer">
                                ';
if($this->_tpl_vars['postcheckcode'] > 0){
echo '
                                <span class="code fl">验证码：<input type="text" class="checkcode" size="8" maxlength="8" id="checkcode" name="checkcode" value=""><img src="'.$this->_tpl_vars['jieqi_url'].'/checkcode.php" style="margin-right: 10px;" onclick="this.src=\''.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\' + Math.random();"></span>
                                ';
}
echo '
                                <span class="face fl"></span>
                                <span class="replying fl " data-ajax_reply="1">回复</span>
                            </div>
                            <span class="err-tips">不能少于5个字</span>
                        </div>
                    </div>
                    ';
}
echo '
                    ';
}
echo '
                    <!-- 回复循环结束-->

                </div>
            </div>
        </div>

        <form action="" method="post" id="myForm" onkeydown="if(event.keyCode==13)return false;">
            <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/page.css" type="text/css">
            <div class="pages_bottom">
                <ul>
                </ul>
                <div class="pageform" id="pageForm">
                    <span>飞到</span>
                    <input type="text" name="page" id="pageNum" class="pageNum" value="1">
                    <span>页</span>
                    <span class="gobtn" id="gobtn">go</span>
                </div>
            </div></form>

    </div>
</div>
<div class="block20"></div>
<div id="floatbox">
    <div id="windowbg"></div>
</div>
<script>
    var page_config = {
        voteNumber:\''.$this->_tpl_vars['allvote'].'\',
        userMoneyBalance:\''.$this->_tpl_vars['jieqi_egold'].'\',
        bookId:\''.$this->_tpl_vars['articleid'].'\',
        isInShelf:\''.$this->_tpl_vars['is_bookcase'].'\',  // true  表示已在书架
        username: "'.$this->_tpl_vars['jieqi_username'].'",
        authorName: "'.$this->_tpl_vars['jieqi_username'].'",
        userLevel:"'.$this->_tpl_vars['jieqi_group'].'",
        userIcon:"'.jieqi_geturl('system','avatar',$this->_tpl_vars['jieqi_userid'],'l',$this->_tpl_vars['jieqi_avatar']).'",
        votes:"'.$this->_tpl_vars['jieqi_votes'].'",
        postcheckcode: "'.$this->_tpl_vars['postcheckcode'].'",
        callbackPageStr:\'\',
        comment_top:"'.$this->_tpl_vars['istop'].'",
        comment_best:"'.$this->_tpl_vars['isgood'].'",
        reviewId:\''.$this->_tpl_vars['topicid'].'\'
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
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/handlebars-v4.0.5.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/handlebars.helper.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/vendor.js"></script>
<link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_url'].'/style/css/ui_common.css">
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/index_header.js"></script>
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/common_chapter.js"></script>
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/comment_detail.js"></script>
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/page.js"></script>

<script type="text/javascript">

    doCreatePageNav(".pages_bottom >ul", '.$this->_tpl_vars['current'].', '.$this->_tpl_vars['totalpages'].');
    var doPage = function (pageNum) {
        $("#pageNum").val(pageNum);
        $("#myForm").attr(\'action\', "'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviewshow.php?tid='.$this->_tpl_vars['topicid'].'");
        $("#myForm").submit();

    };

    function del(rid, did) {
        if(confirm(\'确实要删除该条回复么？\'))
            $.ajax({
                url: "/modules/article/reviewshow.php",
                data: {
                    aid: page_config.bookId,
                    rid: rid,
                    did: did,
                    act: \'del\',
                    jieqi_token: jieqi_token,
                    ajax_gets: 1
                },
                type: "POST",
                dataType: "json",
                success: function(t) {
                    if (t.success === true) {
                        layer.msg(\'该回复删除成功！\', {icon: 1,shade: .3});
                        location.reload();
                    }
                    else{
                        layer.msg(t.message, {icon: 2,shade: .3});
                    }
                },
                error: function(e) {}
            });
    }

    function dels(rid, did) {
        if(confirm(\'确实要删除该书评及回复么？？\'))
            $.ajax({
                url: "/modules/article/reviewshow.php",
                data: {
                    aid: page_config.bookId,
                    rid: rid,
                    did: did,
                    act: \'del\',
                    jieqi_token: jieqi_token,
                    ajax_gets: 1
                },
                type: "POST",
                dataType: "json",
                success: function(t) {
                    if (t.success === true) {
                        layer.msg(\'该书评及回复删除成功！\', {icon: 1,shade: .3});
                        window.location.href = \''.$this->_tpl_vars['article_dynamic_url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'&type=all\';
                    }
                    else{
                        layer.msg(t.message, {icon: 2,shade: .3});
                    }
                },
                error: function(e) {}
            });
    }
</script>
';
?>