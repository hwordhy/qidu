<?php
if(empty($this->_tpl_vars['jieqi_sideblocks']) == false){
}
if($this->_tpl_vars['jieqi_top_bar'] != ""){
echo $this->_tpl_vars['jieqi_top_bar'];
}
echo '

';
if(empty($this->_tpl_vars['jieqi_sideblocks']) == false){
if(empty($this->_tpl_vars['jieqi_sideblocks']['7']) == false){
if (empty($this->_tpl_vars['jieqi_sideblocks']['7'])) $this->_tpl_vars['jieqi_sideblocks']['7'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['7'])) $this->_tpl_vars['jieqi_sideblocks']['7'] = (array)$this->_tpl_vars['jieqi_sideblocks']['7'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['7']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['7']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['7']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['7']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['7']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['jieqi_sideblocks']['7'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo '

'.$this->_tpl_vars['jieqi_sideblocks']['7'][$this->_tpl_vars['i']['key']]['title'].$this->_tpl_vars['jieqi_sideblocks']['7'][$this->_tpl_vars['i']['key']]['content'].'

';
}else{
echo $this->_tpl_vars['jieqi_sideblocks']['7'][$this->_tpl_vars['i']['key']]['content'];
}
}
echo '

';
}
echo '

';
if(empty($this->_tpl_vars['jieqi_sideblocks']['2']) == false || empty($this->_tpl_vars['jieqi_sideblocks']['3']) == false){
echo '

';
if (empty($this->_tpl_vars['jieqi_sideblocks']['2'])) $this->_tpl_vars['jieqi_sideblocks']['2'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['2'])) $this->_tpl_vars['jieqi_sideblocks']['2'] = (array)$this->_tpl_vars['jieqi_sideblocks']['2'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['2']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['2']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['2']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['2']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['2']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['jieqi_sideblocks']['2'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_sideblocks']['2'][$this->_tpl_vars['i']['key']]['title'].$this->_tpl_vars['jieqi_sideblocks']['2'][$this->_tpl_vars['i']['key']]['content'];
}else{
echo $this->_tpl_vars['jieqi_sideblocks']['2'][$this->_tpl_vars['i']['key']]['content'];
}
}
echo '

';
if (empty($this->_tpl_vars['jieqi_sideblocks']['3'])) $this->_tpl_vars['jieqi_sideblocks']['3'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['3'])) $this->_tpl_vars['jieqi_sideblocks']['3'] = (array)$this->_tpl_vars['jieqi_sideblocks']['3'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['3']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['3']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['3']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['3']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['3']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['jieqi_sideblocks']['3'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_sideblocks']['3'][$this->_tpl_vars['i']['key']]['title'].$this->_tpl_vars['jieqi_sideblocks']['3'][$this->_tpl_vars['i']['key']]['content'];
}else{
echo $this->_tpl_vars['jieqi_sideblocks']['3'][$this->_tpl_vars['i']['key']]['content'];
}
}
}
echo '

';
if(empty($this->_tpl_vars['jieqi_sideblocks']['9']) == false){
if (empty($this->_tpl_vars['jieqi_sideblocks']['9'])) $this->_tpl_vars['jieqi_sideblocks']['9'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['9'])) $this->_tpl_vars['jieqi_sideblocks']['9'] = (array)$this->_tpl_vars['jieqi_sideblocks']['9'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['9']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['9']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['9']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['9']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['9']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['jieqi_sideblocks']['9'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_sideblocks']['9'][$this->_tpl_vars['i']['key']]['title'].$this->_tpl_vars['jieqi_sideblocks']['9'][$this->_tpl_vars['i']['key']]['content'];
}else{
echo $this->_tpl_vars['jieqi_sideblocks']['9'][$this->_tpl_vars['i']['key']]['content'];
}
}
if(empty($this->_tpl_vars['jieqi_sideblocks']['1']) == false){
}else{
}
}elseif(empty($this->_tpl_vars['jieqi_sideblocks']['0']) == false){
if (empty($this->_tpl_vars['jieqi_sideblocks']['0'])) $this->_tpl_vars['jieqi_sideblocks']['0'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['0'])) $this->_tpl_vars['jieqi_sideblocks']['0'] = (array)$this->_tpl_vars['jieqi_sideblocks']['0'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['0']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['0']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['0']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['0']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['0']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['jieqi_sideblocks']['0'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_sideblocks']['0'][$this->_tpl_vars['i']['key']]['title'].$this->_tpl_vars['jieqi_sideblocks']['0'][$this->_tpl_vars['i']['key']]['content'];
}else{
echo $this->_tpl_vars['jieqi_sideblocks']['0'][$this->_tpl_vars['i']['key']]['content'];
}
}
echo '

';
if(empty($this->_tpl_vars['jieqi_sideblocks']['1']) == false){
}
}else{
if(empty($this->_tpl_vars['jieqi_sideblocks']['1']) == false){
}
}
if(empty($this->_tpl_vars['jieqi_sideblocks']['4']) == false){
if (empty($this->_tpl_vars['jieqi_sideblocks']['4'])) $this->_tpl_vars['jieqi_sideblocks']['4'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['4'])) $this->_tpl_vars['jieqi_sideblocks']['4'] = (array)$this->_tpl_vars['jieqi_sideblocks']['4'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['4']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['4']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['4']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['4']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['4']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['jieqi_sideblocks']['4'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_sideblocks']['4'][$this->_tpl_vars['i']['key']]['title'].$this->_tpl_vars['jieqi_sideblocks']['4'][$this->_tpl_vars['i']['key']]['content'].'

';
}else{
echo $this->_tpl_vars['jieqi_sideblocks']['4'][$this->_tpl_vars['i']['key']]['content'];
}
}
}
if(empty($this->_tpl_vars['jieqi_sideblocks']['5']) == false){
if (empty($this->_tpl_vars['jieqi_sideblocks']['5'])) $this->_tpl_vars['jieqi_sideblocks']['5'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['5'])) $this->_tpl_vars['jieqi_sideblocks']['5'] = (array)$this->_tpl_vars['jieqi_sideblocks']['5'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['5']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['5']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['5']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['5']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['5']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['jieqi_sideblocks']['5'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_sideblocks']['5'][$this->_tpl_vars['i']['key']]['title'].$this->_tpl_vars['jieqi_sideblocks']['5'][$this->_tpl_vars['i']['key']]['content'];
}else{
echo $this->_tpl_vars['jieqi_sideblocks']['5'][$this->_tpl_vars['i']['key']]['content'];
}
}
}
echo '

';
if($this->_tpl_vars['jieqi_contents'] != ""){
echo $this->_tpl_vars['jieqi_contents'];
}
echo '

';
if(empty($this->_tpl_vars['jieqi_sideblocks']['6']) == false){
if (empty($this->_tpl_vars['jieqi_sideblocks']['6'])) $this->_tpl_vars['jieqi_sideblocks']['6'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['6'])) $this->_tpl_vars['jieqi_sideblocks']['6'] = (array)$this->_tpl_vars['jieqi_sideblocks']['6'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['6']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['6']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['6']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['6']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['6']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['jieqi_sideblocks']['6'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_sideblocks']['6'][$this->_tpl_vars['i']['key']]['title'].$this->_tpl_vars['jieqi_sideblocks']['6'][$this->_tpl_vars['i']['key']]['content'];
}else{
echo $this->_tpl_vars['jieqi_sideblocks']['6'][$this->_tpl_vars['i']['key']]['content'];
}
}
}
echo '


';
if(empty($this->_tpl_vars['jieqi_sideblocks']['1']) == false){
echo '

';
if (empty($this->_tpl_vars['jieqi_sideblocks']['1'])) $this->_tpl_vars['jieqi_sideblocks']['1'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['1'])) $this->_tpl_vars['jieqi_sideblocks']['1'] = (array)$this->_tpl_vars['jieqi_sideblocks']['1'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['1']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['1']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['1']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['1']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['1']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['jieqi_sideblocks']['1'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_sideblocks']['1'][$this->_tpl_vars['i']['key']]['title'].$this->_tpl_vars['jieqi_sideblocks']['1'][$this->_tpl_vars['i']['key']]['content'];
}else{
echo $this->_tpl_vars['jieqi_sideblocks']['1'][$this->_tpl_vars['i']['key']]['content'];
}
}
}
echo '

';
if(empty($this->_tpl_vars['jieqi_sideblocks']['8']) == false){
echo '

';
if (empty($this->_tpl_vars['jieqi_sideblocks']['8'])) $this->_tpl_vars['jieqi_sideblocks']['8'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_sideblocks']['8'])) $this->_tpl_vars['jieqi_sideblocks']['8'] = (array)$this->_tpl_vars['jieqi_sideblocks']['8'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['8']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['jieqi_sideblocks']['8']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['jieqi_sideblocks']['8']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_sideblocks']['8']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['jieqi_sideblocks']['8']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['jieqi_sideblocks']['8'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_sideblocks']['8'][$this->_tpl_vars['i']['key']]['title'].$this->_tpl_vars['jieqi_sideblocks']['8'][$this->_tpl_vars['i']['key']]['content'];
}else{
echo $this->_tpl_vars['jieqi_sideblocks']['8'][$this->_tpl_vars['i']['key']]['content'];
}
}
}
echo '

';
}else{
echo $this->_tpl_vars['jieqi_contents'];
}
echo '

';
if($this->_tpl_vars['jieqi_bottom_bar'] != ""){
echo $this->_tpl_vars['jieqi_bottom_bar'];
}
if(empty($this->_tpl_vars['jieqi_sideblocks']) == false){
}

?>