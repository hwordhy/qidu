<?php
echo '<script type="text/javascript">
function frmpaidnew_validate(){
  if(document.frmpaidnew.payemoney.value == ""){
    alert("����������'.$this->_tpl_vars['egoldname'].'");
    document.frmpaidnew.payemoney.focus();
    return false;
  }
}
</script>
<br />
<form name="frmpaidnew" id="frmpaidnew" action="paidnew.php?do=submit" method="post" onsubmit="return frmpaidnew_validate();" enctype="multipart/form-data">
<table width="80%" class="grid" cellspacing="1" align="center">
<caption>
�������
</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">����������</td>
  <td class="tdr"><a href="'.$this->_tpl_vars['obook_dynamic_url'].'/obookinfo.php?id='.$this->_tpl_vars['obookid'].'" target="_blank">'.$this->_tpl_vars['obookname'].'</a> (���ߣ�<a href="'.$this->_tpl_vars['jieqi_url'].'/userinfo.php?id='.$this->_tpl_vars['authorid'].'" target="_blank">'.$this->_tpl_vars['author'].'</a>)</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">������ʵ��Ϣ��</td>
  <td class="tdr">
  ��ʵ������'.$this->_tpl_vars['personsvars']['realname'].' <br />
  �Ա�'.$this->_tpl_vars['personsvars']['gender'].' <br />
  �绰��'.$this->_tpl_vars['personsvars']['telephone'].' <br />
  �ֻ���'.$this->_tpl_vars['personsvars']['mobilephone'].' <br />
  �տ����У�'.$this->_tpl_vars['personsvars']['banktype'].'<br />
  ���е�����'.$this->_tpl_vars['personsvars']['bankname'].'<br />
  �տ��˺ţ�'.$this->_tpl_vars['personsvars']['bankcard'].'<br />
  �տ��ˣ�'.$this->_tpl_vars['personsvars']['bankuser'].'<br />
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�����룺</td>
  <td class="tdr">'.$this->_tpl_vars['sumemoney'].$this->_tpl_vars['egoldname'].'
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�����ѽ��㣺</td>
  <td class="tdr">'.$this->_tpl_vars['paidemoney'].' '.$this->_tpl_vars['egoldname'].'
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">��������㣺</td>
  <td class="tdr">'.$this->_tpl_vars['remainemoney'].' '.$this->_tpl_vars['egoldname'].'
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">���ν��㣺</td>
  <td class="tdr">
  <input type="text" class="text" name="payemoney" id="payemoney" size="10" maxlength="10" value="" /> '.$this->_tpl_vars['egoldname'].' <span class="hot">��������������</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">֧������ң�</td>
  <td class="tdr">
  <input type="text" class="text" name="paymoney" id="paymoney" size="10" maxlength="10" value="" /> Ԫ <span class="hot">���� 123.45��</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�������ͣ�</td>
  <td class="tdr">
  ';
if (empty($this->_tpl_vars['paidtype']['items'])) $this->_tpl_vars['paidtype']['items'] = array();
elseif (!is_array($this->_tpl_vars['paidtype']['items'])) $this->_tpl_vars['paidtype']['items'] = (array)$this->_tpl_vars['paidtype']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['paidtype']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['paidtype']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['paidtype']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['paidtype']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['paidtype']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="radio" class="radio" name="paidtype" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['paidtype']['default']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['paidtype']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">
  &nbsp;
  <input type="hidden" name="act" value="post" />'.$this->_tpl_vars['jieqi_token_input'].'
  <input type="hidden" name="oid" value="'.$this->_tpl_vars['obookid'].'" />
  </td>
  <td class="tdr"><input type="submit" class="button" name="submit" value="�� ��" /></td>
</tr>
</table>
</form>';
?>