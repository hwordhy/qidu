<?php
echo '
<div class="textbox">
网站导航：
';
if (empty($this->_tpl_vars['jieqishares'])) $this->_tpl_vars['jieqishares'] = array();
elseif (!is_array($this->_tpl_vars['jieqishares'])) $this->_tpl_vars['jieqishares'] = (array)$this->_tpl_vars['jieqishares'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqishares']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqishares']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqishares']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqishares']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqishares']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  ';
if($this->_tpl_vars['i']['order'] > 1){
echo ' | ';
}
echo '
  ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['_request']['ssid']){
echo '
  <span class="hot">'.$this->_tpl_vars['jieqishares'][$this->_tpl_vars['i']['key']]['caption'].'</span>
  ';
}else{
echo '
  <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/sharelist.php?ssid='.$this->_tpl_vars['i']['key'].'">'.$this->_tpl_vars['jieqishares'][$this->_tpl_vars['i']['key']]['caption'].'</a>
  ';
}
echo '
  ';
}
echo '
</div>
<form name="frmadd" method="post" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/sharelist.php">
<table class="grid" width="100%" align="center">
  <caption>把小说共享给“'.$this->_tpl_vars['sharesite']['caption'].'”</caption>
  <tr>
    <td>
	<span class="hottext">请在下面输入小说名，多个小说名用英文空格分隔</span>&nbsp;&nbsp;&nbsp;&nbsp;[<a href="?action=clean">清理已删除的共享小说</a>]';
if($this->_tpl_vars['_request']['action'] == 'clean'){
echo '&nbsp;&nbsp;&nbsp;&nbsp;<span class="hottext">成功清理 '.$this->_tpl_vars['cleannum'].' 本小说！</span>';
}
echo '<br />
	<textarea class="textarea" name="anames" style="width:100%;height:50px;"></textarea><br />
	<input type="hidden" name="ssid" value="'.$this->_tpl_vars['_request']['ssid'].'" />
	<input type="hidden" name="act" value="add" />'.$this->_tpl_vars['jieqi_token_input'].'
	<input type="submit" name="btnsearch" class="button" value="以上小说设为共享"> ';
if($this->_tpl_vars['addnum'] > 0){
echo '<span class="hottext">成功共享'.$this->_tpl_vars['addnum'].'本小说</span>';
}
echo '
	</td>
  </tr>
</table>
</form>

<table class="grid" width="100%" align="center">
  <caption>“'.$this->_tpl_vars['sharesite']['caption'].'”的已共享小说</caption>
  <tr>
    <td>
	<ul class="ulrow">
';
if (empty($this->_tpl_vars['sharerows'])) $this->_tpl_vars['sharerows'] = array();
elseif (!is_array($this->_tpl_vars['sharerows'])) $this->_tpl_vars['sharerows'] = (array)$this->_tpl_vars['sharerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sharerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sharerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sharerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sharerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sharerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
	<li style="float:left;width:24%;"><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['sharerows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['sharerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a>[<a class="hottext" href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/sharelist.php?shareid='.$this->_tpl_vars['sharerows'][$this->_tpl_vars['i']['key']]['shareid'].'&ssid='.$this->_tpl_vars['_request']['ssid'].'&page='.$this->_tpl_vars['_request']['page'].'&act=delete'.$this->_tpl_vars['jieqi_token_url'].'" title="取消本书共享，不会删除小说内容">删</a>]</li>
';
}
echo '
    </ul>
	</td>
  </tr>
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>