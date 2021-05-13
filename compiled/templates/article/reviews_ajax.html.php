<?php
if($this->_tpl_vars['reviewsnum'] > 0){
echo '
<style>
    .btns .checkcode {
        width: 80px;
        height: 25px;
        margin-top: 3px;
        margin-right: 10px;
        cursor: pointer;
    }
</style>
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
        <div class="left fl">
            <a href="javascript:;" class="avatar">
                <img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posterid'],'l',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['avatar']).'" alt="'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['poster'].'">
            </a>
            <div class="nickname">
                <!--<span class="level v1"></span>-->
                <a href="javascript:;" target="_blank" class="nickname_text">
                    '.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['poster'].'</a>
            </div>
        </div>
        <div class="right fl">
            <p class="item_title">
                ';
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['istop'] == 1){
echo '<span class="totop">[置顶]</span>';
}
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['isgood'] == 1){
echo '<span class="totop">[精华]</span>';
}
echo '<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviewshow.php?tid='.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topicid'].'" target="_blank">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['title'].'</a>
            </p>
            <p class="comment-text">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posttext'].'</p>
            <p class="clearfixer behavior">
                <span class="fl time">'.date('Y-m-d H:i:s',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['replytime']).'</span>
                <span class="fr reply">回复(<em class="reply_num">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['replies'].'</em>)</span>
                <span class="fr like">查看(<em class="like_num">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['views'].'</em>)</span>
            </p>
            <div class="replybox">
                <span class="replyer">回复@'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['poster'].':</span>
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
</div>
';
}else{
echo '
<div class="comment_con_newes">
    <div class="empty-comment-box">
        <div class="comment-r">
            <div class="comment-null">
                <span><img src="'.$this->_tpl_vars['jieqi_url'].'/style/images/null-icon.png"/></span>
                <p>暂时没有评价内容，<a href="javascript:;" class="needreview">我来评价</a></p>
            </div>
        </div>
    </div>
</div>
';
}

?>