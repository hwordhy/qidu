<?php
echo '

'.jieqi_get_block(array('bid'=>'0', 'blockname'=>'会员工具', 'module'=>'system', 'filename'=>'block_userbox_tab', 'classname'=>'BlockSystemCustom', 'side'=>'-1', 'title'=>'', 'vars'=>'', 'template'=>'', 'contenttype'=>'4', 'custom'=>'1', 'publish'=>'3', 'hasvars'=>'0'), 1).'
<table class="grid" width="100%">
  <caption>我的书评主题 | <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/myreplies.php">查看书评帖子</a></caption>
  <tr class="head">
    <th width="54%">主题</th>
	<th width="13%">书名</th>
    <th width="13%">回复/查看</th>
    <th width="20%">发表时间</th>
  </tr>
  ';
if (empty($this->_tpl_vars['ptopicrows'])) $this->_tpl_vars['ptopicrows'] = array();
elseif (!is_array($this->_tpl_vars['ptopicrows'])) $this->_tpl_vars['ptopicrows'] = (array)$this->_tpl_vars['ptopicrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['ptopicrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['ptopicrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['ptopicrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['ptopicrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['ptopicrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td>';
if($this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['display_n'] == 1){
echo '<span class="hot">[待审]</span>';
}
if($this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['istop'] == 1){
echo '<span class="hot">[顶]</span>';
}
if($this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['isgood'] == 1){
echo '<span class="hot">[精]</span>';
}
echo '<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviewshow.php?tid='.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['topicid'].'" target="_blank"';
if($this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['display_n'] == 1){
echo ' class="note"';
}
echo '>'.truncate($this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['title'],'54','..').'</a></td>
    <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['ownerid'],'info').'" target="_blank">'.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></td>
    <td align="center">'.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['replies'].'/'.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['views'].'</td>
    <td align="center">'.date('Y-m-d H:i:s',$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['posttime']).'
	</td>
  </tr>
  ';
}
echo '
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>