<?php
echo '<form action="'.$this->_tpl_vars['jieqi_modules']['news']['url'].'/admin/sortlist.php" method="post" name="sortform" id="sortform">
<table class="grid" width="100%" align="center">
<caption>������� | <a href="javascript:;" onclick="openDialog(\'sortadd.php?ajax_gets=jieqi_contents\', false);">���ӷ���</a></caption>
  <tr align="center">
    <th width="6%">����</th>
    <th width="6%">ID</th>
    <th width="62%">�������</th>
    <th width="26%">�������</th>
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
    <td>'.str_repeat('&nbsp;&nbsp;',$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['layer']).'��'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortname'].'</td>
    <td align="center"><a href="javascript:;" onclick="openDialog(\'sortadd.php?parentid='.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortid'].'&ajax_gets=jieqi_contents\', false);">�������Ŀ</a> | <a href="javascript:;" onclick="openDialog(\'sortedit.php?sortid='.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortid'].'&ajax_gets=jieqi_contents\', false);">�޸�</a> | <a id="act_del_'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪɾ�������༰���ж�Ӧ�ӷ���ô��\')) Ajax.Tip(\''.$this->_tpl_vars['jieqi_modules']['news']['url'].'/admin/sortlist.php?id='.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortid'].'&act=del'.$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});">ɾ��</a></td>
  </tr>
  ';
}
echo '
  <tr>
    <td colspan="4" align="left">
	<input type="submit" name="btnsort" value="��������" class="button"> &nbsp; 
	<input type="button" name="btnadd" value="���ӷ���" class="button" onclick="openDialog(\''.$this->_tpl_vars['jieqi_modules']['news']['url'].'/admin/sortadd.php?ajax_gets=jieqi_contents\', false);">
	<input name="act" type="hidden" value="order">'.$this->_tpl_vars['jieqi_token_input'].'
	</td>
  </tr>
</table>
</form>';
?>