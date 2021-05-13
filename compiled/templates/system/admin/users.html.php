<?php
echo '
<form name="frmquery" method="get" action="'.$this->_tpl_vars['jieqi_url'].'/admin/users.php">
<table class="grid" width="100%" align="center">
  <tr>
  <td>
    状态：
    <select class="select" size="1" name="display">
      <option value="">不限</option>
      <option value="vip"';
if($this->_tpl_vars['_request']['display'] == 'vip'){
echo ' selected="selected"';
}
echo '>VIP会员</option>
      <option value="free"';
if($this->_tpl_vars['_request']['display'] == 'free'){
echo ' selected="selected"';
}
echo '>免费会员</option>
      <!-- <option value="monthly"';
if($this->_tpl_vars['_request']['display'] == 'monthly'){
echo ' selected="selected"';
}
echo '>包月会员</option> -->
    </select>
    用户组：
    <select class="select" size="1" name="groupid">
    <option value="0">不限</option>
    ';
if (empty($this->_tpl_vars['grouprows'])) $this->_tpl_vars['grouprows'] = array();
elseif (!is_array($this->_tpl_vars['grouprows'])) $this->_tpl_vars['grouprows'] = (array)$this->_tpl_vars['grouprows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['grouprows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['grouprows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['grouprows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['grouprows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['grouprows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
    <option value="'.$this->_tpl_vars['grouprows'][$this->_tpl_vars['i']['key']]['groupid'].'"';
if($this->_tpl_vars['_request']['groupid'] == $this->_tpl_vars['grouprows'][$this->_tpl_vars['i']['key']]['groupid']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['grouprows'][$this->_tpl_vars['i']['key']]['groupname'].'</option>
    ';
}
echo '
    </select>
    排序：
    <select class="select" size="1" name="order">
      <option value="uid"';
if($this->_tpl_vars['_request']['order'] == 'uid'){
echo ' selected="selected"';
}
echo '>注册时间</option>
      <option value="lastlogin"';
if($this->_tpl_vars['_request']['order'] == 'lastlogin'){
echo ' selected="selected"';
}
echo '>最后登录</option>
      <option value="score"';
if($this->_tpl_vars['_request']['order'] == 'score'){
echo ' selected="selected"';
}
echo '>积分</option>
      <option value="egold"';
if($this->_tpl_vars['_request']['order'] == 'egold'){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['egoldname'].'</option>
      <option value="esilver"';
if($this->_tpl_vars['_request']['order'] == 'esilver'){
echo ' selected="selected"';
}
echo '>分成收入</option>
    </select>
    <select class="select" size="1" name="asc">
      <option value="0"';
if($this->_tpl_vars['_request']['asc'] == 0){
echo ' selected="selected"';
}
echo '>倒序</option>
      <option value="1"';
if($this->_tpl_vars['_request']['asc'] == 1){
echo ' selected="selected"';
}
echo '>顺序</option>
    </select>
    <div style="margin-top:0.5em;">
    搜索条件：
    <input name="keyword" type="text" class="text" id="keyword" size="20" maxlength="50" value="'.$this->_tpl_vars['_request']['keyword'].'">
    <label class="radio"><input type="radio" name="keytype" value="name"';
if($this->_tpl_vars['_request']['keytype'] == 'name' || $this->_tpl_vars['_request']['keytype'] == ''){
echo ' checked="checked"';
}
echo ' />昵称</label> 
    <label class="radio"><input type="radio" name="keytype" value="uname"';
if($this->_tpl_vars['_request']['keytype'] == 'uname'){
echo ' checked="checked"';
}
echo ' />用户名</label> 
    <label class="radio"><input type="radio" name="keytype" value="uid"';
if($this->_tpl_vars['_request']['keytype'] == 'uid'){
echo ' checked="checked"';
}
echo ' />用户ID</label> 
    <label class="radio"><input type="radio" name="keytype" value="email"';
if($this->_tpl_vars['_request']['keytype'] == 'email'){
echo ' checked="checked"';
}
echo ' />邮箱</label>
    <label class="radio"><input type="radio" name="keytype" value="channel"';
if($this->_tpl_vars['_request']['keytype'] == 'channel'){
echo ' checked="checked"';
}
echo ' />来源渠道</label> 
    &nbsp;&nbsp;
        <button type="submit" name="Submit" class="button">搜 索</button>&nbsp;&nbsp;
        </div>
  </td>
</table>
</form>

<form action="" method="post" name="checkform" id="checkform">
<table class="grid" width="100%" align="center">
<caption>用户列表<span class="fss">（用户数：'.$this->_tpl_vars['userstat']['cot'].'，总'.$this->_tpl_vars['egoldname'].'：'.$this->_tpl_vars['userstat']['sumegold'].'，总分成：'.fen2yuan($this->_tpl_vars['userstat']['sumesilver']).'）</span></caption>
  <tr align="center" class="head">
    <td width="6%">ID</td>
    <td width="9%">昵称(用户名)</td>
  <td width="12%">邮箱</td>
  <td width="11%">最后登录</td>
    <td width="8%">等级</td>
    <td width="7%">来源</td>
    <td width="7%">积分</td>
    <td width="7%">'.$this->_tpl_vars['egoldname'].'</td>
    <td width="7%">分成(元)</td>
  <td width="10%">VIP状态</td>
    <td width="16%">操作</td>
  </tr>
  <tbody id="jieqi_page_contents">
  ';
if (empty($this->_tpl_vars['userrows'])) $this->_tpl_vars['userrows'] = array();
elseif (!is_array($this->_tpl_vars['userrows'])) $this->_tpl_vars['userrows'] = (array)$this->_tpl_vars['userrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = jieqi_count($this->_tpl_vars['userrows']);
$this->_tpl_vars['i']['addrows'] = jieqi_count($this->_tpl_vars['userrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - jieqi_count($this->_tpl_vars['userrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['userrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = func_new_each($this->_tpl_vars['userrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td align="center">'.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['uid'].'</td>
    <td><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['uid'],'info').'" target="_blank">'.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['name'].'</a>';
if($this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['name'] != $this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['uname']){
echo '<br /><span class="gray fss">('.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['uname'].')</span>';
}
echo '</td>
  <td><a href="mailto:'.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['email'].'">'.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['email'].'</a></td>
  <td align="center"><span title="';
if(isset($this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['setting']['lastip']) == true){
echo $this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['setting']['lastip'];
}elseif(isset($this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['setting']['regip']) == true){
echo $this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['setting']['regip'];
}
echo '">'.date('y-m-d H:i',$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['lastlogin']).'</span></td>
    <td align="center">'.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['group'].'</td>
    <td align="center">';
if($this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['channel'] == true){
echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['channel'],'info').'" target="_blank">'.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['channel'].'</a>';
}else{
echo $this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['channel'];
}
echo '</td>
    <td align="center">'.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['score'].'</td>
    <td align="center">'.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['egold'].'</td>
    <td align="center">'.fen2yuan($this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['esilver']).'</td>
  <td align="center">';
if($this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['monthly'] > 0){
echo '包月:'.date('Y-m-d',$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['overtime']);
}elseif($this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['isvip'] > 0){
echo 'VIP会员';
}else{
echo '免费会员';
}
echo '</td>
    <td align="center"><a href="'.$this->_tpl_vars['jieqi_url'].'/admin/usermanage.php?id='.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['uid'].'">管理</a> | <a href="'.$this->_tpl_vars['jieqi_url'].'/admin/personmanage.php?id='.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['uid'].'">资料</a>';
if($this->_tpl_vars['jieqi_modules']['pay']['publish'] > 0){
echo ' | <a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/admin/changeegold.php?uid='.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['uid'].'">充值</a>';
}
echo ' | <a href="'.$this->_tpl_vars['jieqi_url'].'/admin/settlenew.php?uid='.$this->_tpl_vars['userrows'][$this->_tpl_vars['i']['key']]['uid'].'">提现</a></td>
  </tr>
  ';
}
echo '
  </tbody>
</table>
</form>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>
';
?>