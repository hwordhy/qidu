<?php
if(count($this->_tpl_vars['reviewrows']) > 0){
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
<li style="width:100%;">
	<p class="rew-li-l"><img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posterid'],'s',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['avatar']).'"/></p>
	<p class="rew-li-r">
		<a id="red_url"
		   href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviewshow.php?tid='.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topicid'].'">
										<span class="tit">
											'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['poster'].'<br/>
											<span class="rew-time">'.date('Y-m-d',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['replytime']).'</span>
											<span class="jinghua-ico answer">
												<img src="'.$this->_tpl_vars['jieqi_url'].'/style/m/images/book_detail_review_ico.png"/>('.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['replies'].')
											</span>
										</span>
			<span class="r_title">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['title'].'</span>
			<span class="text">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posttext'].'</span>
		</a>
	</p>
</li>
';
}
}
echo '


';
?>