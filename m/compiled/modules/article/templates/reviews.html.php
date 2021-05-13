<?php
echo '
<link rel="stylesheet" href="/themes/jieqi220/css/comment.css">
<script src="/themes/jieqi220/js/wapnew.js" type="text/javascript"></script>
<script type="text/javascript">
//置顶置后
function act_top(url){
	var o = getTarget();
	var param = {
		method: \'POST\', 
		onFinish: \'\'
	}
	if(o.getAttribute(\'switch\') == \'0\'){
		url = url.replace(\'act=untop\', \'act=top\');
		param.onFinish = function(res){
			if(res.match(\'成功\')){
				o.setAttribute(\'switch\', \'1\');
				o.innerHTML = \'置后\';
			}
		}
	}else{
		url = url.replace(\'act=top\', \'act=untop\');
		param.onFinish = function(res){
			if(res.match(\'成功\')){
				o.setAttribute(\'switch\', \'0\');
				o.innerHTML = \'置顶\';
			}
		}
	}
	Ajax.Tip(url, param);
	return false;
}
//加精去精
function act_good(url){
	var o = getTarget();
	var param = {
		method: \'POST\', 
		onReturn: \'\'
	}
	if(o.getAttribute(\'switch\') == \'0\'){
		url = url.replace(\'act=normal\', \'act=good\');
		param.onFinish = function(res){
			if(res.match(\'成功\')){
			o.setAttribute(\'switch\', \'1\');
			o.innerHTML = \'去精\';
			}
		}
	}else{
		url = url.replace(\'act=good\', \'act=normal\');
		param.onFinish = function(res){
			if(res.match(\'成功\')){
			o.setAttribute(\'switch\', \'0\');
			o.innerHTML = \'加精\';
			}
		}
	}
	Ajax.Tip(url, param);
	return false;
}
//删除
function act_delete(url){
	var o = getTarget();
	var param = {
		method: \'POST\', 
		onReturn: function(){
			$_(o.parentNode.parentNode).remove();
		}
	}
	if(confirm(\'确实要删除该书评么？\')) Ajax.Tip(url, param);
	return false;
}
</script>




		 <section class="wapcomment">
		  <div class="container">
		   <p class="here"><a href="'.$this->_tpl_vars['url_articleinfo'].'" title="">'.$this->_tpl_vars['articlename'].'</a><b> &gt; 全部评论 </b></p>
		   <h2><b class="bclickurl active">全部评论</b>
			<a href="javascript:;" class="publish fr">发表评论</a></h2>
		   <ul>
				';
if (empty($this->_tpl_vars['reviewrows'])) $this->_tpl_vars['reviewrows'] = array();
elseif (!is_array($this->_tpl_vars['reviewrows'])) $this->_tpl_vars['reviewrows'] = (array)$this->_tpl_vars['reviewrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['reviewrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['reviewrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['reviewrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['reviewrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['reviewrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
			<li><h3 class="clearfix"><span class="com_left fl"><a title="">
				<img class="bd50" src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['userid'],'l',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['avatar']).'" alt="" /></a></span>
				<span class="com_right fl"><a title="">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['poster'].'</a><b>'.date('m-d H:i',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['replytime']).'</b><a class="fr "></a>
			   <!--点评--></span></h3><a href="http://m.cmqxwx.com/BookComment/commentResponse/book_id/37892/pid/98292">
			  <div class="con_content clearfix">
					'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['title'].'
			  </div></a><h4 class="clearfix">
					<td width="80%">□ ';
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topflag'] == 1){
echo '<span class="hot">[顶]</span>';
}
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['goodflag'] == 1){
echo '<span class="hot">[精]</span>';
}
echo $this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['content'].'</td>
					<td width="20%" align="center">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['username'].'<br />
						'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['postdate'];
if($this->_tpl_vars['ismaster'] == 1){
echo '<br />
						';
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topflag'] == 0){
echo '[<a href="'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['url_top'].'">置顶</a>]
						';
}else{
echo '[<a href="'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['url_untop'].'">置后</a>]';
}
echo ' 
						';
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['goodflag'] == 0){
echo '[<a href="'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['url_good'].'">加精</a>]
						';
}else{
echo '[<a href="'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['url_normal'].'">去精</a>]';
}
echo '
						 [<a href="javascript:if(confirm(\'确实要删除该书评么？\')) document.location=\''.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['url_delete'].'\';">删除</a>]
						 ';
}
echo '</td>

					';
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['istop'] == 1){
echo '
					<a  class="report">[置顶]</a>';
}
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['isgood'] == 1){
echo '
					<a class="fav" >[精华]';
}
echo '</a>
					<a  href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviewshow.php?rid='.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topicid'].'" class="comto">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['replies'].'</a>
			</h4></li>
			  ';
}
echo '
			</ul>
		   <div class="com_total page">
				<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div> 
		   </div>
		  </div>
		 </section>


<!--评论弹框--><section class="com_alert ">
        <section class="container">
                <div class="downs">
                        <form class="form-base" name="frmreview" id="frmreview" method="post" action="'.$this->_tpl_vars['article_dynamic_url'].'/reviewshow.php?tid='.$this->_tpl_vars['topicid'].'&aid='.$this->_tpl_vars['articleid'].'" onsubmit="return frmpost_validate();" enctype="multipart/form-data" target="_blank"> 
                        ';
if($this->_tpl_vars['jieqi_userid'] > 0){
echo '
                        <div class="contxt bd3 ">
                                <a href="javascript:" class="close"></a>
                        <div class="puss">
                            <h3>标题(选填)</h3>
                            <input type="text" class="bd2"  name="ptitle" placeholder="标题" maxlength="100"> 
                            <h3>内容</h3>
                            <textarea name="pcontent" class="bd3" placeholder="内容" style="overflow: hidden;"></textarea> 
                            <input type="hidden" name="act" id="act" value="newpost" />'.$this->_tpl_vars['jieqi_token_input'].'
                            <input type="button" value="提交" class="com_push bd3 style="cursor:pointer;" onclick="Ajax.Request(\'frmreview\',{onComplete:function(){alert(this.response.replace(/<br[^<>]*>/g,\'\\n\'));Form.reset(\'frmreview\');}});">
                            </div><!--评论成功-->
                            </div>
                        </div>
                               ';
}else{
echo '
                               <div class="contxt bd3 ">
                                    <a href="javascript:" class="close"></a>
                               <div class="puss" style="color:#000;font-size:15px;">
                                    您只有<a href="'.$this->_tpl_vars['jieqi_user_url'].'/login.php?jumpurl='.urlencode($this->_tpl_vars['jieqi_thisurl']).'" target="_blank" style="color:#09c">登陆</a>后才可以发表书评
                                </div>
                            </div>
                               ';
}
echo '
                            </form> 
                </section>
            </section><!--评论弹框 end-->

<script type="text/javascript">
function setTab(name,cursel,n){
for(i=1;i<=n;i++){
var menu=document.getElementById(name+i);
var con=document.getElementById("con_"+name+"_"+i);
menu.className=i==cursel?"item active":"item";
con.style.display=i==cursel?"block":"none";
}
}
	function showReply(id, obj) {
        var comment = $("#__comment_" + id);
        var _html = comment.html();
        //alert(comment.is(":hidden"));
        if (comment.is(":hidden")) {
            if (_html == "") {
                $.ajax({
                    url: \'/ajax/chapter/SubReply/\',
                    type: \'post\',
                    data: { replyId: id, page: 1, size: 50 },
                    async: false, //默认为true 异步     
                    error: function () {
                        alert(\'error\');
                    },
                    success: function (data) {
                        comment.html(data);
                    }
                });
            }
            comment.show();
        } else {
            comment.hide();
            $(obj).removeClass("comment-status-open");
        }
    }

</script>';
?>