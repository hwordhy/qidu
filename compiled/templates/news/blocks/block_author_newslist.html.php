<?php
if (empty($this->_tpl_vars['newsrows'])) $this->_tpl_vars['newsrows'] = array();
elseif (!is_array($this->_tpl_vars['newsrows'])) $this->_tpl_vars['newsrows'] = (array)$this->_tpl_vars['newsrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['newsrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['newsrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['newsrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['newsrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['newsrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
<li>
    <a   href="'.jieqi_geturl('news','info',$this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['topicid']).'" target="_blank">
        <em class="dot"></em>
        '.$this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['title'];
if($this->_tpl_vars['i']['order'] < 4){
echo '<em class="new">最新</em>';
}
echo '
        <span class="date">'.date('Y-m-d H:i:s',$this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['addtime']).'</span>
    </a>
</li>
';
}

?>