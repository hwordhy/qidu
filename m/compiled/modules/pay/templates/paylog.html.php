<?php
echo '
<link rel="stylesheet" href="/sink/css/paylist.css" type="text/css"/>

<section class="paylist clearfix">
<div class="container">
<p class="here"><a href="/userdetail.php" title="">�û����� </a><b>&gt;</b><a href="##" title="">��ֵ����   </a></p>
<h2><a href="/modules/obook/buylist.php" >���ļ�¼</a><a href="/modules/pay/paylog.php" class="active">��ֵ��¼</a></h2>

	<ul><!--������ѭ��-->
		<li class="upnextss">
		<em>ʱ��</em><em>����</em><em>״̬</em>
		</li>
		<!--������ѭ�� end-->
	
  ';
if (empty($this->_tpl_vars['paylogrows'])) $this->_tpl_vars['paylogrows'] = array();
elseif (!is_array($this->_tpl_vars['paylogrows'])) $this->_tpl_vars['paylogrows'] = (array)$this->_tpl_vars['paylogrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['paylogrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['paylogrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['paylogrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['paylogrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['paylogrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '

		<li class="upnextss">
		<em>'.date('Y-m-d H:i:s',$this->_tpl_vars['paylogrows'][$this->_tpl_vars['i']['key']]['buytime']).'</em>
		<em>'.$this->_tpl_vars['paylogrows'][$this->_tpl_vars['i']['key']]['egold'].'</em>
		<em>'.$this->_tpl_vars['paylogrows'][$this->_tpl_vars['i']['key']]['payflag'].'</em>
		</li>
  ';
}
echo '
	</ul>

</div>
</section>
';
?>