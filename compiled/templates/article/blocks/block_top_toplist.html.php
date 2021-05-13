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
	if($this->_tpl_vars['i']['order'] == 1){
echo '
<li class="top topred">
  <span class="num">'.$this->_tpl_vars['i']['order'].'</span>
  <dl class="book-block">
    <dt><a  data-msg=\'{bookid:"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'"}\' href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'"  target="_blank"><img class="lazyimg" src="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_image'].'" data-original="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_image'].'"/></a></dt>
    <dd>
      <a  data-msg=\'{bookid:"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'"}\' href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank" class="book-name">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a>
      <span class="book-author"><a data-msg=\'{bookid:"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'"}\' data-control-type="shelf"  href="javascript:;" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</a></span>
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
  <a  data-msg=\'{bookid:"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'"}\' data-control-type="shelf"  class="book-list-f" href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank">
    '.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a>
<span class="clicknum linum fr">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['visitnum'].'</span>
</li>
';
}
}
echo '
<a href="'.$this->_tpl_vars['url_more'].'" target="_blank" class="more">查看更多&gt;&gt;</a>

';
?>