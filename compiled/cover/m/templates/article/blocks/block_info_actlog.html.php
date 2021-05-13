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
  <div class="txtbox-item">
    <div class="donate-d-list">
      <dl>
        <dt><a href="javascript:;"><img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uid'],'s',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['avatar']).'" width="30" height="30"></a></dt>
        <dd>&nbsp;为
          <a class="blue" target="_blank"  href="'.jieqi_geturl('article','article',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['articleid'],'info',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['articlecode']).'">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['articlename'].'</a>
          捧场了';
if($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['icourl'] == ''){
echo $this->_tpl_vars['egoldname'];
}else{
echo '<img src="'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['icourl'].'" title="'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'].'">';
}
echo '<span class="org"> x '.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'</span></dd>
      </dl>
    </div>
  </div>
';
}

?>