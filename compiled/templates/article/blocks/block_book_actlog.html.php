<?php
if (empty($this->_tpl_vars['actlogrows'])) $this->_tpl_vars['actlogrows'] = array();
elseif (!is_array($this->_tpl_vars['actlogrows'])) $this->_tpl_vars['actlogrows'] = (array)$this->_tpl_vars['actlogrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['actlogrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['actlogrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['actlogrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['actlogrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['actlogrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <p>
    <span class="reader ui_color">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uname'].'</span>
    ';
if($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname_n'] == "tip"){
echo '
    <span class="desc">打赏了</span>
    <span class="motiecoin ui_color">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].$this->_tpl_vars['egoldname'].'</span>
    ';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname_n'] == "buychapter"){
echo '
    <span class="desc">订阅了价值</span>
    <span class="motiecoin ui_color">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['egold'].'</span>
    '.$this->_tpl_vars['egoldname'].'的
    <span class="motiecoin ui_color">章节</span>
    ';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname_n'] == "vipvote"){
echo '
    <span class="desc">打赏了</span>
    <span class="motiecoin ui_color">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'张'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'].'</span>
    ';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname_n'] == "poll"){
echo '
    <span class="desc">打赏了</span>
    <span class="motiecoin ui_color">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'张'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'].'</span>
    ';
}else{
echo '
    <span class="desc">打赏了价值</span>
    <span class="motiecoin ui_color">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['egold'].'</span>
    '.$this->_tpl_vars['egoldname'].'的
    <span class="motiecoin ui_color">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'].'</span>
    ';
}
echo '
    <span class="time">'.date('Y-m-d H:i:s',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['addtime']).'</span>
  </p>
';
}

?>