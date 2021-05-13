<?php
echo '<ul class="goodbook-b">
';
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
	if($this->_tpl_vars['i']['order'] % 4 == 0){
echo '
</ul>
<ul class="goodbook-b">
';
}
echo '
<dl class="book-block">
  <dt><a data-msg=\'{bookid:"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'"}\' data-control-type="shelf"
         href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank"><img class="lazyimg" data-original="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_image'].'"/></a></dt>
  <dd>
    <a data-msg=\'{bookid:"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'"}\' data-control-type="shelf"
       href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" class="book-name" target="_blank">
      '.truncate($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'],'20').'</a>
    <span data-msg=\'{bookid:"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'"}\' data-control-type="shelf"
          class="book-info">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['intro'].'</span>
    <span class="book-author">作者：<a
            data-msg=\'{bookid:"'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'"}\' data-control-type="shelf"
            href="javascript:;" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</a></span>
  </dd>
</dl>
';
}
echo '
</ul>

';
?>