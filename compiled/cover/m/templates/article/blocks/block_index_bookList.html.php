<?php
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '{"id":'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].',"iconUrlDefault":"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_image'].'","intrduce":"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['intro'].'","words":'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['size_c'].',"name":"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'","authorName":"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'","tagName":[';
if (empty($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['tagname'])) $this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['tagname'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['tagname'])) $this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['tagname'] = (array)$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['tagname'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = jieqi_count($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['tagname']);
$this->_tpl_vars['j']['addrows'] = jieqi_count($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['tagname']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - jieqi_count($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['tagname']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['tagname']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = func_new_each($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['tagname']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['tagname'][$this->_tpl_vars['j']['key']].'"';
if($this->_tpl_vars['j']['order'] != $this->_tpl_vars['j']['count']){
echo ',';
}
}
echo '],"isFinished":false,"url":"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'","url_index":"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_read'].'","isFinished":'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['fullflag_n'].',"readPv":'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['allvisit'].'}';
if($this->_tpl_vars['i']['order'] != $this->_tpl_vars['i']['count']){
echo ',';
}
}
echo '


';
?>