<?php
echo '
<div class="path ">
    <a href="/" target="_blank">首页</a>
    <span>></span>
    <a target="_blank" href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['sortid']).'">'.$this->_tpl_vars['sort'].'</a>
    <span>></span>
    <span>
      <a href="'.$this->_tpl_vars['url_articleinfo'].'" >'.$this->_tpl_vars['articlename'].'</a>
    </span>
</div>
<div class="work_brief clearfixer">
    <div class="pic fl">
        <span><img src="'.$this->_tpl_vars['url_image'].'" alt=""></span>
    </div>
    <div class="brief fl">
        <div class="title clearfixer">
            <span class="name fl">'.$this->_tpl_vars['articlename'].'</span>
            <a href="javascript:;" class="author fl" target="_blank">'.$this->_tpl_vars['author'].'</a>
            <span class="write fl">著</span>
        </div>
        <div class="tags clearfixer">

            <a href="javascript:;"><span class="fl isfinish">'.$this->_tpl_vars['fullflag'].'</span></a><a href="javascript:;"><span class="fl isfinish">'.$this->_tpl_vars['issign'].'</span></a><a href="javascript:;"><span class="fl isfinish">'.$this->_tpl_vars['isvip'].'</span></a>
            ';
if (empty($this->_tpl_vars['tagrows'])) $this->_tpl_vars['tagrows'] = array();
elseif (!is_array($this->_tpl_vars['tagrows'])) $this->_tpl_vars['tagrows'] = (array)$this->_tpl_vars['tagrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['tagrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['tagrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['tagrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['tagrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['tagrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articlefilter.php?keywords='.$this->_tpl_vars['tagrows'][$this->_tpl_vars['i']['key']]['tagencode'].'"><span class="fl ">'.$this->_tpl_vars['tagrows'][$this->_tpl_vars['i']['key']]['tagname'].'</span></a>
            ';
}
echo '
        </div>
        <div class="hits">
            <i></i>
            <span>'.$this->_tpl_vars['size_c'].'字</span>
            <i></i>
            <span>总点击 '.$this->_tpl_vars['allvisit'].'</span>
            <i></i>
            <span>推荐票 '.$this->_tpl_vars['allvote'].'</span>
        </div>
        <p class="brief_text">'.strip_tags($this->_tpl_vars['intro']).'</p>
        <div class="btns">
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articleread.php?id='.$this->_tpl_vars['articleid'].'" class="free on ui_bg_bdcolor" target="_blank">免费试读</a>
            ';
if($this->_tpl_vars['saleprice'] > 0){
echo '
            <a href="javascript:;" onclick="wholebuy()" class="wholebuy">全本购买</a>
            ';
}
echo '
            ';
if($this->_tpl_vars['is_bookcase'] == true){
echo '
            <span class="addshelf onshelf">已在书架</span>
            ';
}else{
echo '
            <a href="javascript:;" class="addshelf">加入书架</a>
            ';
}
echo '
            <a href="javascript:;" class="interaction">粉丝互动</a>
        </div>
    </div>
    <div class="popular fr">
        <div class="action">
            <a href="javascript:;" class="phoneread">手机阅读</a>
            <div class="erweima_app">
                <img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/wap.png" alt="">
            </div>
        </div>
    </div>
</div>
<div class="work_content clearfixer" id="content-tab">
    <div class="header">
        <div class="tab fl j-content-tab">
            <a href="#brief"><span class="on">作品简介</span></a>
            <a href="#catalog"><span >目录('.$this->_tpl_vars['chapters'].'章)</span></a>
        </div>
        <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'" class="fl comment" target="_blank">书友评论</a>
    </div>
    <div class="tabcontent j-content-main">
        <div class="tabcontent-1 clearfixer"  >
            <div class="column_left fl">
                <div class="summary">

                    <p id="xxxxxx" style="margin-top:-5px;" class="summary1"></p>
                    
                    
                    
                                        <script>
                    	
                    //	document.getElementById("xxxxxx").innerHTML="";
                    	//执行替换操作
                    	
                    		//var str=\''.strip_tags($this->_tpl_vars['intro']).'\';
						//	var str1=str.replace("&emsp;&emsp;","<br>");
						//	console.log(str1);
							
							
var str = \''.strip_tags($this->_tpl_vars['intro']).'\';
var reg = new RegExp( \'&emsp;&emsp;\' , "g" )
var newstr = str.replace(reg,\'<br>\' );
	console.log(newstr);
document.getElementById("xxxxxx").innerHTML=newstr;							
							
                    </script>

                    
                    
                    
                </div>
                <div class="newchapter">
                    <div class="title clearfixer">
                        ';
if($this->_tpl_vars['isvip_n'] > 0 && $this->_tpl_vars['vipchapterid'] > 0){
echo '
                        <span class="chaptername fl">最新章节&nbsp;:&nbsp;&nbsp;<a target="_blank" href="'.$this->_tpl_vars['url_vipchapter'].'" rel="nofollow" ><img alt="vip" src="'.$this->_tpl_vars['jieqi_url'].'/style/images/vip.gif">'.$this->_tpl_vars['vipchapter'].'</a> </span>
                        ';
}else{
echo '
                        <span class="chaptername fl">最新章节&nbsp;:&nbsp;&nbsp;<a target="_blank" href="'.$this->_tpl_vars['url_lastchapter'].'" rel="nofollow" >'.$this->_tpl_vars['lastchapter'].'</a> </span>
                        ';
}
echo '
                        <span class="updatetime fr">更新时间&nbsp;:&nbsp;'.date('Y-m-d H:i:s',$this->_tpl_vars['lastupdate']).'</span>
                    </div>
                    <p>';
if($this->_tpl_vars['isvip_n'] > 0 && $this->_tpl_vars['vipchapterid'] > 0){
echo '<a target="_blank" href="'.$this->_tpl_vars['url_vipchapter'].'">'.strip_tags($this->_tpl_vars['vipsummary']).'...</a>';
}else{
echo '<a target="_blank" href="'.$this->_tpl_vars['url_lastchapter'].'">'.strip_tags($this->_tpl_vars['lastsummary']).'...</a>';
}
echo '</p>
                </div>
                <div class="fans">
                    <div class="title">粉丝打赏</div>
                    <div class="fans-con clearfixer">
                        <div class="hongbao fl">
                            <span class="pic"></span>
                            <span class="num">'.$this->_tpl_vars['tipnums'].'人次</span>
                            <span class="btn">打赏作者</span>
                            <!--<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articleactlog.php?id='.$this->_tpl_vars['articleid'].'" class="allbonus" target="_blank">全部打赏记录>></a>-->
                        </div>
                        <div class="rank fl">
                            <span class="rank-title">粉丝贡献榜</span>
                            <div class="bonusitems">
                                <div class="fans_scrolling_wrapper">
                                    <div class="inner" id="fans_scrolling">
                                        '.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'
                                    </div>
                                </div>
                            </div>
                            <div class="fansitems clearfixer">
                                '.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'
                            </div>
                        </div>
                    </div>
                </div>
                <div class="reader_comments" id="comment-tab">
                    <div class="comment_tit clearfixer">
                        <span class="text fl">书友评论('.$this->_tpl_vars['reviewsnum'].')</span>
                        <div class="comment-tab fl j-comment-tab">
                            <span class="on">最新</span>
                            <span>精华</span>
                        </div>
                        <span class="sendcomment">发表评论</span>
                    </div>
                    <div class="comment_con j-comment-main">
                        <div class="comment_con_1"></div>
                        <div class="comment_con_2"></div>
                        <div class="loading-comment">
                            <img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/loading.gif" alt="">
                        </div>
                    </div>
                    <div class="morecomment">
                        <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'" target="_blank">
                            更多评论>>
                        </a>
                    </div>
                </div>
            </div>
            <div class="column_right fr">
                <div class="author ">
                    <div class="medalwrapper">
                        <div class="medalbox">
                            '.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'
                            <!--<div class="medal clearfixer">-->
                                <!--<div class="medal-pic">-->
                                    <!--<span class="angle"></span>-->
                                    <!--<div class="img-big">-->
                                        <!--<img class="" src="'.$this->_tpl_vars['jieqi_url'].'/style/images/gold_crown.png" alt=""-->
                                             <!--data-imgbig="#"-->
                                             <!--data-imgtitle="#" data-desc="">-->
                                    <!--</div>-->
                                    <!--<img src="" class="img-title" alt="">-->
                                    <!--<div class="desc"></div>-->
                                <!--</div>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <!--<div class="line1"></div>-->
                    <!--<div class="data clearfixer">-->
                        <!--<div class="allwork fl">-->
                            <!--<p>作品总数</p>-->
                            <!--<span class="ui_color">-->
                                <!--1</span>-->
                        <!--</div>-->
                        <!--<div class="allchar fl">-->
                            <!--<p>累计字数</p>-->
                            <!--<span class="ui_color">260946</span>-->
                        <!--</div>-->
                        <!--<div class="allday fl">-->
                            <!--<p>驻站天数</p>-->
                            <!--<span class="ui_color">60</span>-->
                        <!--</div>-->
                    <!--</div>-->
                    <div class="line1"></div>
                    <div class="allbook">
                        <div class="title clearfixer">
                            <div class="text fl">全部作品</div>
                            <div class="tab fr">
                                <span class="j_all_work_prev fl"></span>
                                <span class="j_all_work_next fl"></span>
                            </div>
                        </div>
                        <div class="all_work_content">
                            <div class="all_work_contentbox">
                                '.$this->_tpl_vars['jieqi_pageblocks']['4']['content'].'
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fansrank">
                    <div class="title">粉丝排行榜</div>
                    <ul class="content">
                        '.$this->_tpl_vars['jieqi_pageblocks']['5']['content'].'
                    </ul>
                    <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/creditlist.php?id='.$this->_tpl_vars['articleid'].'" target="_blank" style="display: inline-block;font-size: 14px; margin-bottom:10px; color: #ccc;" class="see_more">查看更多>></a>
                </div>
                <div class="same-recomend">
                    <div class="rec-title">'.$this->_tpl_vars['jieqi_pageblocks']['6']['title'].'</div>
                    <ul class="rec-content ">
                        '.$this->_tpl_vars['jieqi_pageblocks']['6']['content'].'
                    </ul>
                </div>
            </div>
        </div>
        <div class="wrap1200 catebg" >
            <div class="cate-tit">
                <h2>作品正文</h2>
            </div>
            <div class="cate-list">
                <ul>
                    '.$this->_tpl_vars['jieqi_pageblocks']['7']['content'].'
                </ul>
                <div class="cl"></div>
            </div>
        </div>
    </div>
</div>
<div class="block20"></div>
<div id="floatbox">
    <div id="windowbg"></div>
    <div class="bonus_pop" id="wholebuy" style="display: none; height: 400px;">
        <div class="header">
            <span class="vote on">全本购买</span><span class="close" onclick="closebuy()"></span>
        </div>
        <div class="content">
            <div class="applause-content" style="display: block;height: 200px;">
                <p class="balance" style="margin-left: 50px;"> 需支付：<b class="user_remain" style="font-size: 18px;">'.$this->_tpl_vars['saleprice'].'</b>'.$this->_tpl_vars['egoldname'].'</p>
                <p class="balance" style="margin-left: 50px;"> 账户余额：<b class="user_remain" style="font-size: 18px;">'.$this->_tpl_vars['jieqi_egold'].'</b>'.$this->_tpl_vars['egoldname'].'</p>
                <div class="confirmapplause" onclick="buyobook()">
                    确认购买
                </div>
            </div>
        </div>
    </div>
</div>





<script>
    var page_config = {
        voteNumber:\''.$this->_tpl_vars['jieqi_votes'].'\',
        uservipvote:"'.$this->_tpl_vars['jieqi_setting']['gift']['vipvote'].'",
        userMoneyBalance:\''.$this->_tpl_vars['jieqi_egold'].'\',
        bookId:\''.$this->_tpl_vars['articleid'].'\',
        isInShelf:\''.$this->_tpl_vars['is_bookcase'].'\',  // true  表示已在书架
        username: "'.$this->_tpl_vars['jieqi_username'].'",
        authorName: "'.$this->_tpl_vars['jieqi_username'].'",
        userLevel:"'.$this->_tpl_vars['jieqi_group'].'",
        userIcon:"'.jieqi_geturl('system','avatar',$this->_tpl_vars['jieqi_userid'],'l',$this->_tpl_vars['jieqi_avatar']).'",
        votes:"'.$this->_tpl_vars['jieqi_votes'].'",
        vipvote:"'.$this->_tpl_vars['allvipvote'].'",
        postcheckcode: "'.$this->_tpl_vars['postcheckcode'].'",
        callbackPageStr:\'\'
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

    function closebuy() {
        $("#wholebuy").hide();
        $("#windowbg").hide();
    }
    function wholebuy() {
        $("#wholebuy").show();
        $("#windowbg").show();
    }
    function buyobook() {
        $.ajax({
            type: "POST",
            url: "'.$this->_tpl_vars['jieqi_modules']['obook']['url'].'/buywhole.php",
            data: {\'act\' : \'buy\', \'oid\' : \''.$this->_tpl_vars['vipid'].'\', \'jieqi_token\' : \''.$this->_tpl_vars['jieqi_token'].'\', \'ajax_gets\' : 1},
            global: false,
            dataType: "json",
            success: function (data) {
                if (data[\'success\'] == false) {
                    layer.msg(data["message"], {icon: 2,shade: .3});
                    return false
                }
                layer.msg(data["message"], {icon: 1,shade: .3});
                closebuy()
            }
        })
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
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/common_chapter.js"></script>
<script src="'.$this->_tpl_vars['jieqi_url'].'/style/js/work_detail.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/js/data.js"></script>
';
?>