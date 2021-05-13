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
	echo '
  <div class="';
if($this->_tpl_vars['i']['order'] == 1){
echo 'gold';
}elseif($this->_tpl_vars['i']['order'] == 2){
echo 'silver';
}else{
echo 'copper';
}
echo ' card">
    <span class="crown"></span>  <img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['uid'],'l',$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['avatar']).'"
                                      alt="" class="fans_pic">
    <p class="fans-name">'.$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['uname'].'</p>
    <p class="motiecoin">打赏<span class="ui_color">'.$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['egold'].$this->_tpl_vars['egoldname'].'</span></p>
  </div>
';
}

?>