<?php
echo '<style>
    .btns .checkcode {
        width: 80px;
        height: 25px;
        margin-top: 3px;
        margin-right: 10px;
        cursor: pointer;
    }
    .review-config{width:100%;height:10px;position:relative;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:end;-ms-flex-pack:end;justify-content:flex-end}.reader_comments .review-config .review-config-block,.reader_comments .review-config .review-config-essence,.reader_comments .review-config .review-config-top{margin-top:10px;cursor:pointer;display:block;float:right;margin-right:30px}.reader_comments .review-config .review-config-essence{right:90px}.reader_comments .review-config .review-config-block{right:30px}
</style>
<div class="comment-box clearfixer">
    <div class="path ">
        <a href="/" target="_blank">首页</a>
        <span>></span>

        <a target="_blank" href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['sortid']).'">'.$this->_tpl_vars['sort'].'</a>
        <span>></span>
        <span>
            <a href="'.$this->_tpl_vars['url_articleinfo'].'" target="_blank">'.$this->_tpl_vars['articlename'].'</a>
        </span>
        <span>></span>
        <span>书友评论</span>
    </div>
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

                <span class="';
if($this->_tpl_vars['type'] != "good"){
echo 'on';
}
echo '" id="lastest" data-bookid="'.$this->_tpl_vars['articleid'].'"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'">最新</a></span>
                <span class="';
if($this->_tpl_vars['type'] == "good"){
echo 'on';
}
echo '" id="best" data-bookid="'.$this->_tpl_vars['articleid'].'"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'&type=good">精华</a></span>
            </div>
            <span class="sendcomment">发表评论</span>
        </div>

        <div class="comment_con j-comment-main">
            <div class="comment_con_newes">
                ';
if (empty($this->_tpl_vars['reviewrows'])) $this->_tpl_vars['reviewrows'] = array();
elseif (!is_array($this->_tpl_vars['reviewrows'])) $this->_tpl_vars['reviewrows'] = (array)$this->_tpl_vars['reviewrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['reviewrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['reviewrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['reviewrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['reviewrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['reviewrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '

                <div class="comment_item clearfixer j_comment_item" data-commentid="'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topicid'].'">
                    ';
if($this->_tpl_vars['ismaster'] == 1){
echo '
                    <p class="review-config fr">
                        <span class="review-config-top ui_color" data-topicid="'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topicid'].'" data-istop="'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['istop'].'">';
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['istop'] == 0){
echo '置顶';
}else{
echo '取消置顶';
}
echo '</span>
                        <span class="review-config-essence ui_color" data-topicid="'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topicid'].'" data-isgood="'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['isgood'].'">';
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['isgood'] == 0){
echo '精华';
}else{
echo '取消精华';
}
echo '</span>
                        <span class="review-config-block ui_color" data-topicid="'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topicid'].'">删除</span>
                    </p>
                    ';
}
echo '
                    <div class="left fl">
                        <a href="javascript:;" class="avatar">
                            <img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posterid'],'l',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['avatar']).'">
                        </a>
                        <div class="nickname">
                            <!--<span class="level v1"></span>-->
                            <a href="javascript:;" class="" target="_blank">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['poster'].'</a>
                        </div>
                    </div>
                    <div class="right fl">
                        <p class="item_title">
                            ';
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['istop'] == 1){
echo '<span class="totop">[置顶]</span>';
}
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['isgood'] == 1){
echo '<span class="essence">[精华]</span>';
}
echo '<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviewshow.php?tid='.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topicid'].'" target="_blank"> <span
                                class="">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['title'].'</span></a>
                        </p>
                        <p class="comment-text">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posttext'].'</p>
                        <p class="clearfixer behavior">
                            <span class="fl time">'.date('Y-m-d H:i:s',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['replytime']).'</span>
                            <span class="fr reply">回复(<em class="reply_num">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['replies'].'</em>)</span>
                            <span class="fr like  recommend favorited " action-type="favorite">查看(<em
                                    class="like_num">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['views'].'</em>)</span>
                            <span class="fr report">举报</span>
                        </p>
                        <div class="replybox">
                            <span class="replyer">回复@'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['poster'].':</span>
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
                                <span class="replying fl">回复</span>
                            </div>
                            <span class="err-tips">不能少于5个字</span>
                        </div>
                    </div>
                </div>
                ';
}
echo '
            </div>
        </div>
        <form method="post"  id="myForm" onkeydown="if(event.keyCode==13)return false;">
            <input type="hidden" id="showType" name="showType" value="time">
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
        callbackPageStr:\'\'
    }
</script>


<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/common_chapter.js"></script>
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/comment_list.js"></script>
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/page.js"></script>

<script type="text/javascript">


    doCreatePageNav(".pages_bottom >ul", '.$this->_tpl_vars['current'].', '.$this->_tpl_vars['totalpages'].');

    var doPage = function (pageNum) {
        $("#pageNum").val(pageNum);
        $("#myForm").attr("action" , "'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'");
        $("#myForm").submit();
    }

    $(function () {
        $("#lastest").on("click", function () {
            var bookId = $(this).data("bookid");
            window.location.href = "'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid=" + bookId;
        })
        $("#best").on("click", function () {
            var bookId = $(this).data("bookid");
            window.location.href = "'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid=" + bookId + "&type=good";
        })


    });


    $(".review-config .review-config-top").on("click", function() {
        var t = $(this).data("topicid"),
            c = $(this).data("istop"),
            t_act = c > 0 ? \'untop\' : \'top\';
        if (t > 0) {
            $.ajax({
                url: "/modules/article/reviews.php",
                data: {
                    aid: page_config.bookId,
                    rid: t,
                    act: t_act,
                    jieqi_token: jieqi_token,
                    ajax_gets: 1
                },
                type: "POST",
                success: function(o) {
                    o = eval(o);
                    if (o.success === true) {
                        layer.msg(o.message, {icon: 1,shade: .3});
                        location.reload();
                    }
                    else{
                        layer.msg(o.message, {icon: 2,shade: .3});
                    }
                },
                error: function(e) {}
            })
        }
    });

    $(".review-config .review-config-essence").on("click", function() {
        var t = $(this).data("topicid"),
            c = $(this).data("isgood"),
            t_act = c > 0 ? \'normal\' : \'good\';
        if (t > 0) {
            $.ajax({
                url: "/modules/article/reviews.php",
                data: {
                    aid: page_config.bookId,
                    rid: t,
                    act: t_act,
                    jieqi_token: jieqi_token,
                    ajax_gets: 1
                },
                type: "POST",
                success: function(o) {
                    o = eval(o);
                    if (o.success === true) {
                        layer.msg(o.message, {icon: 1,shade: .3});
                        location.reload();
                    }
                    else{
                        layer.msg(o.message, {icon: 2,shade: .3});
                    }
                },
                error: function(e) {}
            })
        }
    });

    $(".review-config .review-config-block").on("click", function() {
        if(confirm(\'确实要删除该书评及回复么？？\'))
        var t = $(this).data("topicid");
            $.ajax({
            url: "/modules/article/reviews.php",
            data: {
                aid: page_config.bookId,
                rid: t,
                act: \'del\',
                jieqi_token: jieqi_token,
                ajax_gets: 1
            },
            type: "POST",
            success: function(t) {
                t = eval(t);
                if (t.success === true) {
                    layer.msg(\'该书评及回复删除成功！\', {icon: 1,shade: .3});
                    location.reload();
                }
                else{
                    layer.msg(t.message, {icon: 2,shade: .3});
                }
            },
            error: function(e) {}
        });
    });

</script>
';
?>