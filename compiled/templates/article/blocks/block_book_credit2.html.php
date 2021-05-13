<?php
if (empty($this->_tpl_vars['creditrows'])) $this->_tpl_vars['creditrows'] = array();
elseif (!is_array($this->_tpl_vars['creditrows'])) $this->_tpl_vars['creditrows'] = (array)$this->_tpl_vars['creditrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['creditrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['creditrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['creditrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['creditrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['creditrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['i']['order'] == 1){
echo '
<li class="clearfixer first">
  <span class="number fl ui_bgcolor">'.$this->_tpl_vars['i']['order'].'</span>
  <div class="fl">
    <a href="javascript:;" class="name"
       target="_blank">'.$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['uname'].'</a>
    <span class="level">粉丝级别:'.$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['rank'].'</span>
  </div>
  <a href="javascript:;" class="avatar fr" target="_blank">
    <img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['uid'],'l',$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['avatar']).'" alt="" >
  </a>
</li>
';
}else{
echo '
<li  class="clearfixer';
if($this->_tpl_vars['i']['order'] == 2){
echo ' second';
}else{
echo ' third';
}
echo '">
  <span class="number ui_bgcolor fl ">'.$this->_tpl_vars['i']['order'].'</span>
  <a href="javascript:;" class="name fl"
     target="_blank">'.$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['uname'].'</a>
  <span class="level fr">'.$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['rank'].'</span>
</li>
';
}
}

?>