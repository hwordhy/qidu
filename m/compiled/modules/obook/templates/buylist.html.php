<?php
echo '
<link rel="stylesheet" href="/sink/css/paylist.css" type="text/css"/>
<link type="text/css" rel="stylesheet" href="/sink/css/base.css" />
<section class="paylist clearfix">
<div class="container">
<p class="here"><a href="/userdetail.php" title="">�û����� </a><b>&gt;</b><a href="##" title="">���ļ�¼   </a></p>
<h2><a href="/modules/obook/buylist.php" class="active">���ļ�¼</a><a href="/modules/pay/paylog.php" >��ֵ��¼</a></h2>

	<ul><!--������ѭ��-->
		<li class="upnextss">
		<em style="width:25%">ʱ��</em><em style="width:20%">����</em><em style="width:30%">�Ѷ���/���½�</em><em style="width:20%">����</em>
		</li>
		<!--������ѭ�� end-->
  ';
if (empty($this->_tpl_vars['obuyrows'])) $this->_tpl_vars['obuyrows'] = array();
elseif (!is_array($this->_tpl_vars['obuyrows'])) $this->_tpl_vars['obuyrows'] = (array)$this->_tpl_vars['obuyrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['obuyrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['obuyrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['obuyrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['obuyrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['obuyrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
		<li class="upnextss">
		<em style="width:25%">'.date('Y-m-d H:i',$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['buytime']).'</em>
		<em style="width:20%"><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['articleid'],'index').'" >'.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['obookname'].'</a></em>
		<em style="width:30%">'.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['chapternum'].'/'.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['chapters'].'</em>
		<em style="width:20%">	';
if($this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['autobuy'] > 0){
echo '
	<a id="act_unsetautobuy_'.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['obuyid'].'" href="javascript:;" onclick="Ajax.Tip(\''.$this->_tpl_vars['obook_dynamic_url'].'/buylist.php?obuyid='.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['obuyid'].'&page='.$this->_tpl_vars['jieqi_page_nowpage'].'&act=unsetautobuy'.$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" title="�Զ����ı�ʾ���һ��δ����VIP�½��Ķ�ʱ��ϵͳ����ʾ�����Զ����Ĳ���ʾ�Ķ�ҳ��">ȡ���Զ�����</a>
	';
}else{
echo '
	<a id="act_setautobuy_'.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['obuyid'].'" href="javascript:;" onclick="Ajax.Tip(\''.$this->_tpl_vars['obook_dynamic_url'].'/buylist.php?obuyid='.$this->_tpl_vars['obuyrows'][$this->_tpl_vars['i']['key']]['obuyid'].'&page='.$this->_tpl_vars['jieqi_page_nowpage'].'&act=setautobuy'.$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" title="�Զ����ı�ʾ���һ��δ����VIP�½��Ķ�ʱ��ϵͳ����ʾ�����Զ����Ĳ���ʾ�Ķ�ҳ��">��Ϊ�Զ�����</a>
	';
}
echo '</em>
		</li>
  ';
}
echo '
	</ul>

</div>
<hr>
<div class="mod page pages">'.$this->_tpl_vars['url_jumppage'].'</div>
</section>




';
?>