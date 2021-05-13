<?php
echo '


<div class="c_nav"><a href="'.$this->_tpl_vars['jieqi_modules']['news']['url'].'/">新闻中心</a>';
if (empty($this->_tpl_vars['sortroutes'])) $this->_tpl_vars['sortroutes'] = array();
elseif (!is_array($this->_tpl_vars['sortroutes'])) $this->_tpl_vars['sortroutes'] = (array)$this->_tpl_vars['sortroutes'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sortroutes']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sortroutes']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sortroutes']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortroutes']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sortroutes']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo ' &gt; <a href="'.jieqi_geturl('news','newslist','1',$this->_tpl_vars['sortroutes'][$this->_tpl_vars['i']['key']]['sortid']).'">'.$this->_tpl_vars['sortroutes'][$this->_tpl_vars['i']['key']]['sortname'].'</a>';
}
echo '</div>

<div class="c_main">
<div class="c_title">'.$this->_tpl_vars['news']['title'].'</div>

<div class="c_head">
  <span class="c_label">新闻来源：</span><span class="c_value">';
if($this->_tpl_vars['news']['surl'] == ''){
echo $this->_tpl_vars['news']['source'];
}else{
echo '<a href="'.$this->_tpl_vars['news']['surl'].'" target="_blank">'.$this->_tpl_vars['news']['source'].'</a>';
}
echo '</span>
  <span class="c_label">发表时间：</span><span class="c_value">'.date('Y-m-d H:i:s',$this->_tpl_vars['news']['addtime']).'</span>
  <span class="c_label">发表人：</span><span class="c_value"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['news']['posterid']).'" target="_blank">'.$this->_tpl_vars['news']['poster'].'</a></span>
</div>

<div class="c_content">
  '.$this->_tpl_vars['news']['contents'].'
</div>

<div class="c_foot">
  
</div>
</div>';
?>