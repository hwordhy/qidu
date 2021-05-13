<?php
echo '

<link rel="stylesheet" href="/themes/jieqi220/css/comment.css">
<script src="/themes/jieqi220/js/wapnew.js" type="text/javascript"></script>
<section class="wapcomment">
        <div class="container">
         <p class="here"><a href="'.$this->_tpl_vars['url_articleinfo'].'" title="">'.$this->_tpl_vars['articlename'].'</a><b> &gt; 评论回复 </b></p>
         <h2><b class="bclickurl active">回复评论</b>
          <a href="javascript:;" class="publish fr">发表评论</a></h2>
         <ul>
                ';
if (empty($this->_tpl_vars['replyrows'])) $this->_tpl_vars['replyrows'] = array();
elseif (!is_array($this->_tpl_vars['replyrows'])) $this->_tpl_vars['replyrows'] = (array)$this->_tpl_vars['replyrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['replyrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['replyrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['replyrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['replyrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['replyrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
          <li><h3 class="clearfix"><span class="com_left fl"><a title="">
              <img class="bd50" src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['userid'],'l',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['avatar']).'" alt="'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['username'].'" /></a></span>
              <span class="com_right fl">
                  <a title="">'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['username'].'</a><b>'.date('Y-m-d H:i:s',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posttime']).'</b><a class="fr "></a>
             <!--点评--></span></h3><a >
            <div class="con_content clearfix">
                    '.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posttext'].'
            </div></a><h4 class="clearfix">
            <!-- <a href="javascript:;" class="report" onclick="$.report(this)">举报</a><a href="javascript:;" class="fav" onclick="$.favs(this)" onclick="$.favs(this)">0</a><a href="javascript:;" class="comto">0</a> -->
            <a  class="comto">'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['order'].'楼</a>
        </h4></li>
            ';
}
echo '
          </ul>
         <div class="com_total page">
                '.$this->_tpl_vars['url_jumppage'].'
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
';
?>