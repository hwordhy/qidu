<?php
echo '<form action="'.$this->_tpl_vars['jieqi_modules']['news']['url'].'/admin/sortlist.php" method="post" name="sortform" id="sortform">
<table class="grid" width="100%" align="center">
<caption>分类管理 | <a href="javascript:;" onclick="openDialog(\'sortadd.php?ajax_gets=jieqi_contents\', false);">增加分类</a></caption>
  <tr align="center">
    <th width="6%">排序</th>
    <th width="6%">ID</th>
    <th width="62%">类别名称</th>
    <th width="26%">管理操作</th>
  </tr>
  ';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td align="center"><input name="sortorder['.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortid'].']" type="text" class="text" size="3" value="'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortorder'].'"></td>
    <td align="center">'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortid'].'</td>
    <td>'.str_repeat('&nbsp;&nbsp;',$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['layer']).'├'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortname'].'</td>
    <td align="center"><a href="javascript:;" onclick="openDialog(\'sortadd.php?parentid='.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortid'].'&ajax_gets=jieqi_contents\', false);">添加子栏目</a> | <a href="javascript:;" onclick="openDialog(\'sortedit.php?sortid='.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortid'].'&ajax_gets=jieqi_contents\', false);">修改</a> | <a id="act_del_'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortid'].'" href="javascript:;" onclick="if(confirm(\'确实要删除本分类及所有对应子分类么？\')) Ajax.Tip(\''.$this->_tpl_vars['jieqi_modules']['news']['url'].'/admin/sortlist.php?id='.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortid'].'&act=del'.$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});">删除</a></td>
  </tr>
  ';
}
echo '
  <tr>
    <td colspan="4" align="left">
	<input type="submit" name="btnsort" value="分类排序" class="button"> &nbsp; 
	<input type="button" name="btnadd" value="增加分类" class="button" onclick="openDialog(\''.$this->_tpl_vars['jieqi_modules']['news']['url'].'/admin/sortadd.php?ajax_gets=jieqi_contents\', false);">
	<input name="act" type="hidden" value="order">'.$this->_tpl_vars['jieqi_token_input'].'
	</td>
  </tr>
</table>
</form>';
?>