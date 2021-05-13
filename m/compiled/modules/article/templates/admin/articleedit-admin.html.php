<?php
echo '
<script type="text/javascript">
<!--
function frmarticleedit_validate(){
  if(document.frmarticleedit.sortid.value == ""){
    alert("请输入类别");
    document.frmarticleedit.sortid.focus();
    return false;
  }
  if(document.frmarticleedit.articlename.value == ""){
    alert("请输入小说名称");
    document.frmarticleedit.articlename.focus();
    return false;
  }
}
//-->
</script>
<form name="frmarticleedit" id="frmarticleedit" action="'.$this->_tpl_vars['url_articleedit'].'" method="post" onsubmit="return frmarticleedit_validate();" enctype="multipart/form-data">
  <table width="100%" class="grid" cellspacing="1" align="center">
    <caption>
    编辑小说
    </caption>
    <tr valign="middle" align="left">
      <td class="tdl" width="25%">类别：</td>
      <td class="tdr"><select class="select" size="1" onchange="showtypes(this)" name="sortid" id="sortid">
          
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
  
          <option value="'.$this->_tpl_vars['i']['key'].'"';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['sortid']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['caption'].'</option>
          
  ';
}
echo '
  
        </select>
        <span id="typeselect" name="typeselect"></span> 
        <script type="text/javascript">
  function showtypes(obj){
    var typeselect=document.getElementById(\'typeselect\');
    typeselect.innerHTML=\'\';
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
	  ';
if($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] != ''){
echo '
	  if(obj.options[obj.selectedIndex].value == '.$this->_tpl_vars['i']['key'].') typeselect.innerHTML=\'<select class="select" size="1" name="typeid" id="typeid">';
if (empty($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'])) $this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'])) $this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] = (array)$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '<option value="'.$this->_tpl_vars['j']['key'].'"';
if($this->_tpl_vars['j']['key'] == $this->_tpl_vars['articlevals']['typeid']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'][$this->_tpl_vars['j']['key']].'</option>';
}
echo '</select>\';
	  ';
}
echo '
    ';
}
echo '
  }
  showtypes(document.getElementById(\'sortid\'));
  </script></td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">小说名称：</td>
      <td class="tdr">
        <input type="text" class="text" name="articlename" id="articlename" size="30" maxlength="50" value="'.$this->_tpl_vars['articlevals']['articlename'].'" />
        <span class="hottext">如需修改书名，请联系编辑！</span>
        </td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">标签：</td>
      <td class="tdr"><input type="text" class="text" name="keywords" id="keywords" size="30" maxlength="50" value="'.$this->_tpl_vars['articlevals']['keywords'].'" />
        <span class="hottext">多个标签以英文空格分隔</span></td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">管理员：</td>
      <td class="tdr"><input type="text" class="text" name="agent" id="agent" size="30" maxlength="30" value="'.$this->_tpl_vars['articlevals']['agent'].'" />
        <span class="hottext">可以指定一个本站现有用户作为管理员</span></td>
    </tr>
    ';
if($this->_tpl_vars['allowtrans'] > 0){
echo '
    <tr valign="middle" align="left">
      <td class="tdl">作者：</td>
      <td class="tdr"><input type="text" class="text" name="author" id="author" size="30" maxlength="30" value="'.$this->_tpl_vars['articlevals']['author'].'" /></td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">作者绑定：</td>
      <td class="tdr"> ';
if (empty($this->_tpl_vars['authorflag']['items'])) $this->_tpl_vars['authorflag']['items'] = array();
elseif (!is_array($this->_tpl_vars['authorflag']['items'])) $this->_tpl_vars['authorflag']['items'] = (array)$this->_tpl_vars['authorflag']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['authorflag']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['authorflag']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['authorflag']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['authorflag']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['authorflag']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <input type="radio" class="radio" name="authorflag" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['authorflag']){
echo 'checked="checked" ';
}
echo '/>
        '.$this->_tpl_vars['authorflag']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo ' </td>
    </tr>
    ';
}
echo '
    <tr valign="middle" align="left">
      <td class="tdl">授权级别：</td>
      <td class="tdr">
	 ';
if (empty($this->_tpl_vars['permission']['items'])) $this->_tpl_vars['permission']['items'] = array();
elseif (!is_array($this->_tpl_vars['permission']['items'])) $this->_tpl_vars['permission']['items'] = (array)$this->_tpl_vars['permission']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['permission']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['permission']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['permission']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['permission']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['permission']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <input type="radio" class="radio" name="permission" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['permission_n']){
echo 'checked="checked" ';
}
echo '/>
        '.$this->_tpl_vars['permission']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo ' </td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">首发状态：</td>
      <td class="tdr"> 

	 ';
if (empty($this->_tpl_vars['firstflag']['items'])) $this->_tpl_vars['firstflag']['items'] = array();
elseif (!is_array($this->_tpl_vars['firstflag']['items'])) $this->_tpl_vars['firstflag']['items'] = (array)$this->_tpl_vars['firstflag']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['firstflag']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['firstflag']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['firstflag']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['firstflag']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['firstflag']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <input type="radio" class="radio" name="firstflag" value="'.$this->_tpl_vars['i']['key'].'"';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['firstflag_n']){
echo 'checked="checked" ';
}
echo '/>
        '.$this->_tpl_vars['firstflag']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo '
</td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">写作进度：</td>
      <td class="tdr"> ';
if (empty($this->_tpl_vars['progress']['items'])) $this->_tpl_vars['progress']['items'] = array();
elseif (!is_array($this->_tpl_vars['progress']['items'])) $this->_tpl_vars['progress']['items'] = (array)$this->_tpl_vars['progress']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['progress']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['progress']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['progress']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['progress']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['progress']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <input type="radio" class="radio" name="progress" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['progress_n']){
echo 'checked="checked" ';
}
echo '/>
        '.$this->_tpl_vars['progress']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo ' </td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">内容简介：</td>
      <td class="tdr"><textarea class="textarea" name="intro" id="intro" rows="8" cols="70">'.$this->_tpl_vars['articlevals']['intro'].'</textarea></td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">本书公告：</td>
      <td class="tdr"><textarea class="textarea" name="notice" id="notice" rows="8" cols="70">'.$this->_tpl_vars['articlevals']['notice'].'</textarea></td>
    </tr>
    ';
if($this->_tpl_vars['eachlinknum'] > 0){
echo '
    <tr valign="middle" align="left">
      <td class="tdl">推荐小说ID（互换链接）：</td>
      <td class="tdr"><input type="text" class="text" name="eachlinkids" id="eachlinkids" size="30" maxlength="500" value="'.$this->_tpl_vars['articlevals']['eachlinkids'].'" />
        <span class="hottext">必须是本站小说ID，最多'.$this->_tpl_vars['eachlinknum'].'个，用空格分开</span></td>
    </tr>
    ';
}
echo '
    <tr valign="middle" align="left">
      <td class="tdl">封面小图：</td>
      <td class="tdr"><input type="file" class="text" size="30" name="articlespic" id="articlespic" />
        <span class="hottext">图片格式：'.$this->_tpl_vars['imagetype'].'</span></td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">封面大图：</td>
      <td class="tdr"><input type="file" class="text" size="30" name="articlelpic" id="articlelpic" />
        <span class="hottext">图片格式：'.$this->_tpl_vars['imagetype'].'</span></td>
    </tr>
    ';
if($this->_tpl_vars['allowmodify'] > 0){
echo '
    <tr valign="middle" align="left">
      <td class="tdl">发表者：</td>
      <td class="tdr"><input type="text" class="text" name="poster" id="poster" size="30" maxlength="30" value="'.$this->_tpl_vars['articlevals']['poster'].'" />
        <span class="hottext">必须是本站会员名称</span></td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">是否签约：</td>
      <td class="tdr"> ';
if (empty($this->_tpl_vars['issign']['items'])) $this->_tpl_vars['issign']['items'] = array();
elseif (!is_array($this->_tpl_vars['issign']['items'])) $this->_tpl_vars['issign']['items'] = (array)$this->_tpl_vars['issign']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['issign']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['issign']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['issign']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['issign']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['issign']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <input type="radio" class="radio" name="issign" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['issign_n']){
echo 'checked="checked" ';
}
echo '/>
        '.$this->_tpl_vars['issign']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo ' 
		<span class="hottext">VIP签约以及上架后才能发布VIP章节，普通签约上架后不能发布VIP章节</span>
		</td>
    </tr>

	 <tr valign="middle" align="left">
      <td class="tdl">是否上架：</td>
      <td class="tdr"> ';
if (empty($this->_tpl_vars['isvip']['items'])) $this->_tpl_vars['isvip']['items'] = array();
elseif (!is_array($this->_tpl_vars['isvip']['items'])) $this->_tpl_vars['isvip']['items'] = (array)$this->_tpl_vars['isvip']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['isvip']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['isvip']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['isvip']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['isvip']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['isvip']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <input type="radio" class="radio" name="isvip" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['isvip_n']){
echo 'checked="checked" ';
}
echo '/>
        '.$this->_tpl_vars['isvip']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo ' 
		<span class="hottext">VIP代表上架</span>
		</td>
    </tr>
	
<tr valign="middle" align="left">
  <td class="tdl">是否包月：</td>
  <td class="tdr">
  ';
if (empty($this->_tpl_vars['monthly']['items'])) $this->_tpl_vars['monthly']['items'] = array();
elseif (!is_array($this->_tpl_vars['monthly']['items'])) $this->_tpl_vars['monthly']['items'] = (array)$this->_tpl_vars['monthly']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['monthly']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['monthly']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['monthly']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['monthly']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['monthly']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="radio" class="radio" name="monthly" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['monthly_n']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['monthly']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '
  <span class="hottext">对于已经签约小说有效</span>
</td>
</tr>

    <tr valign="middle" align="left">
      <td class="tdl">所属频道：</td>
      <td class="tdr"> ';
if (empty($this->_tpl_vars['rgroup']['items'])) $this->_tpl_vars['rgroup']['items'] = array();
elseif (!is_array($this->_tpl_vars['rgroup']['items'])) $this->_tpl_vars['rgroup']['items'] = (array)$this->_tpl_vars['rgroup']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['rgroup']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['rgroup']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['rgroup']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['rgroup']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['rgroup']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <input type="radio" class="radio" name="rgroup" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['rgroup_n']){
echo 'checked="checked" ';
}
echo '/>
        '.$this->_tpl_vars['rgroup']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo ' </td>
    </tr>
	
<tr valign="middle" align="left">
  <td class="tdl">是否买断：</td>
  <td class="tdr">
  ';
if (empty($this->_tpl_vars['buyout']['items'])) $this->_tpl_vars['buyout']['items'] = array();
elseif (!is_array($this->_tpl_vars['buyout']['items'])) $this->_tpl_vars['buyout']['items'] = (array)$this->_tpl_vars['buyout']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['buyout']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['buyout']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['buyout']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['buyout']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['buyout']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="radio" class="radio" name="buyout" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['buyout_n']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['buyout']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '
</td>
</tr>

<tr valign="middle" align="left">
  <td class="tdl">是否参赛：</td>
  <td class="tdr">
  ';
if (empty($this->_tpl_vars['inmatch']['items'])) $this->_tpl_vars['inmatch']['items'] = array();
elseif (!is_array($this->_tpl_vars['inmatch']['items'])) $this->_tpl_vars['inmatch']['items'] = (array)$this->_tpl_vars['inmatch']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['inmatch']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['inmatch']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['inmatch']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['inmatch']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['inmatch']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="radio" class="radio" name="inmatch" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['inmatch_n']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['inmatch']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '
</td>
</tr>

	
	
	
    <tr valign="middle" align="left">
      <td class="tdl">点击数：</td>
      <td class="tdr"> 日：
        <input type="text" class="text" name="dayvisit" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['dayvisit'].'" />
        周：
        <input type="text" class="text" name="weekvisit" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['weekvisit'].'" />
        月：
        <input type="text" class="text" name="monthvisit" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['monthvisit'].'" />
        总：
        <input type="text" class="text" name="allvisit" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['allvisit'].'" /></td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">推荐数：</td>
      <td class="tdr"> 日：
        <input type="text" class="text" name="dayvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['dayvote'].'" />
        周：
        <input type="text" class="text" name="weekvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['weekvote'].'" />
        月：
        <input type="text" class="text" name="monthvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['monthvote'].'" />
        总：
        <input type="text" class="text" name="allvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['allvote'].'" /></td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">鲜花数：</td>
      <td class="tdr"> 日：
        <input type="text" class="text" name="dayflower" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['dayflower'].'" />
        周：
        <input type="text" class="text" name="weekflower" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['weekflower'].'" />
        月：
        <input type="text" class="text" name="monthflower" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['monthflower'].'" />
        总：
        <input type="text" class="text" name="allflower" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['allflower'].'" /></td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">鸡蛋数：</td>
      <td class="tdr"> 日：
        <input type="text" class="text" name="dayegg" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['dayegg'].'" />
        周：
        <input type="text" class="text" name="weekegg" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['weekegg'].'" />
        月：
        <input type="text" class="text" name="monthegg" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['monthegg'].'" />
        总：
        <input type="text" class="text" name="allegg" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['allegg'].'" /></td>
    </tr>
    <tr valign="middle" align="left">
      <td class="tdl">月票数：</td>
      <td class="tdr"> 日：
        <input type="text" class="text" name="dayvipvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['dayvipvote'].'" />
        周：
        <input type="text" class="text" name="weekvipvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['weekvipvote'].'" />
        月：
        <input type="text" class="text" name="monthvipvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['monthvipvote'].'" />
        总：
        <input type="text" class="text" name="allvipvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['allvipvote'].'" /></td>
    </tr>
    ';
}
echo '
    <tr valign="middle" align="left">
      <td class="tdl">&nbsp;
        <input type="hidden" name="action" id="action" value="update" />
        <input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['articlevals']['articleid'].'" /></td>
      <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="提 交" /></td>
    </tr>
  </table>
</form>';
?>