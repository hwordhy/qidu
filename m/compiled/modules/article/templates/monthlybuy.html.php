<?php
echo '<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<div class="container">
	<div class="mod block form col-xs-12">
		<div class="hd">
			<h3>购买包月会员</h3>
</div>
<form name="frmlogin" method="post" action="'.$this->_tpl_vars['url_login'].'">
<div  >
<div > 
    <h5>当前用户：'.$this->_tpl_vars['jieqi_username'].'</h5>
    
</div>
<div> 
    <h5>包月状态：  ';
if($this->_tpl_vars['overtime'] == 0){
echo '尚未包月';
}else{
echo date('Y-m-d',$this->_tpl_vars['overtime']).' 到期';
}
echo '</h5>

<div > 
    <h5>当前余额：'.$this->_tpl_vars['egold'].' '.$this->_tpl_vars['egoldname'].'</h5>

</div>
<div > 
    <h5>包月选项：</h5>
	';
if (empty($this->_tpl_vars['jieqimonthly']['article']['options'])) $this->_tpl_vars['jieqimonthly']['article']['options'] = array();
elseif (!is_array($this->_tpl_vars['jieqimonthly']['article']['options'])) $this->_tpl_vars['jieqimonthly']['article']['options'] = (array)$this->_tpl_vars['jieqimonthly']['article']['options'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqimonthly']['article']['options']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqimonthly']['article']['options']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqimonthly']['article']['options']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqimonthly']['article']['options']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqimonthly']['article']['options']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
	<input type="radio" class="radio" name="buytype" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['buytype'] == $this->_tpl_vars['i']['key']){
echo ' checked="checked"';
}
echo '/>'.$this->_tpl_vars['i']['key'].'个月 ('.$this->_tpl_vars['jieqimonthly']['article']['options'][$this->_tpl_vars['i']['key']].$this->_tpl_vars['egoldname'].')<br /><br />
	';
}
echo '
</div>
<div class="ft">
    <input type="hidden" name="act" value="buy">'.$this->_tpl_vars['jieqi_token_input'].'
    <input type="submit" class="btn btn-auto btn-blue" value="确认购买" name="submit">
  </div>

</form>
</div>
</div>';
?>