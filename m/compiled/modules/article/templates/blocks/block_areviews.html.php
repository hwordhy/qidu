<?php
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

<li>
		<h3 class="clearfix"><span class="com_left fl">
		<a>
			<img class="bd50" src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posterid'],'s').'" alt="头像" /></a></span>
			<span class="com_right fl"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posterid']).'" title="">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['poster'].'</a><b>'.date('m-d H:i',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['replytime']).'</b>
	   <!--点评--></span></h3>
	   <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviewshow.php?rid='.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topicid'].'">
		  <p class="con_content clearfix">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posttext'].'</p></a>
		  <h4 class="clearfix">
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
		  </h4>
	</li> 

';
}

?>