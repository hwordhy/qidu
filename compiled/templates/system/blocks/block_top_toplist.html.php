<?php
if (empty($this->_tpl_vars['userrows'])) $this->_tpl_vars['userrows'] = array();
elseif (!is_array($this->_tpl_vars['userrows'])) $this->_tpl_vars['userrows'] = (array)$this->_tpl_vars['userrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['userrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['userrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['userrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['userrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['userrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['i']['order'] == 1){
echo '
<li class="top topred">
  <span class="num">'.$this->_tpl_vars['i']['order'].'</span>
  <dl class="book-block">
    <dt><a  data-msg=\'{uid:"'.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['uid'].'"}\' href="javascript:;"  target="_blank"><img class="lazyimg" data-original="'.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['url_avatar'].'"/></a></dt>
    <dd>
      <a  data-msg=\'{bookid:"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'"}\' href="javascript:;" target="_blank" class="book-name">'.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
    </dd>
  </dl>
</li>
';
}else{
echo '
<li';
if($this->_tpl_vars['i']['order'] < 4){
echo ' class="topred"';
}
echo '>
  <span class="num">'.$this->_tpl_vars['i']['order'].'</span>
  <a  data-msg=\'{uid:"'.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['uid'].'"}\' data-control-type="shelf"  class="book-list-f" href="javascript:;" target="_blank">
    '.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
</li>
';
}
}
echo '
<!--<a href="'.$this->_tpl_vars['jieqi_url'].'/topuser.php?sort='.$this->_tpl_vars['sort'].'" target="_blank" class="more">查看更多&gt;&gt;</a>-->
';
?>