<?php
echo ' 
<script type="text/javascript">
<!--
function frmarticleedit_validate(){
  if(document.frmarticleedit.sortid.value == ""){
    alert("���������");
    document.frmarticleedit.sortid.focus();
    return false;
  }
  if(document.frmarticleedit.articlename.value == ""){
    alert("������С˵����");
    document.frmarticleedit.articlename.focus();
    return false;
  }
}
//-->
</script>
<div class="container">
	<div class="mod block form">
		<div class="hd">
			<h4>�༭С˵</h4>
</div>
<form name="frmarticleedit" id="frmarticleedit" action="'.$this->_tpl_vars['url_articleedit'].'" method="post" onsubmit="return frmarticleedit_validate();" enctype="multipart/form-data">
<div class="mail-zc">
      <div class="phone-name"> 
          <h3>��Ʒ���</h3>
          
';
if($this->_tpl_vars['allowmodify'] > 0){
echo '
  <select class="select" size="1" onchange="showtypes(this)" name="sortid" id="sortid">
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
  <span id="typeselect" name="typeselect" style="display: none;"></span>
  <script language="javascript">
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
  </script>
  
';
}else{
echo '
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
	if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['sortid']){
echo $this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['caption'];
}
echo '
  ';
}
echo '

';
}
echo '
</div>
<div class="phone-name"> 
          <h3>��Ʒ������</h3>
		  ';
if($this->_tpl_vars['allowmodify'] > 0){
echo '

		           <input name="articlename" id="articlename" type="text" class="text" value="'.$this->_tpl_vars['articlevals']['articlename'].'" maxlength="20" />
		          
';
}else{
echo '

		  
		           <span>'.$this->_tpl_vars['articlevals']['articlename'].'</span>(30���ڽ��������Ա�����޸���������1��) 
		          
		
		';
}
echo '
         </div>
<div class="phone-name"> 
          <h3>��Ʒ��ǩ��</h3>
          
		  ';
if($this->_tpl_vars['allowmodify'] > 0){
echo '
		<input type="text" class="text" name="keywords" id="keywords" size="30" maxlength="50" value="'.$this->_tpl_vars['articlevals']['keywords'].'" /><span>��������,�ض����ʵ�,�Կո�ָ�</span>
		  ';
}else{
echo '
		 '.$this->_tpl_vars['articlevals']['keywords'].'<span>��������,�ض����ʵ�,�Կո�ָ�</span>
		   ';
}
echo '
		  
         </div>

<div class="phone-name"> 
          <h3>�༭��</h3>
          <input type="text" class="text" name="agent" id="agent" size="30" maxlength="30" value="'.$this->_tpl_vars['articlevals']['agent'].'" /><span>����ָ��һ����վ�����û���Ϊ����Ա</span>
         </div>

        <div class="phone-name"> 
          <h3>��Ʒ״̬��</h3>
          
  ';
if (empty($this->_tpl_vars['fullflag']['items'])) $this->_tpl_vars['fullflag']['items'] = array();
elseif (!is_array($this->_tpl_vars['fullflag']['items'])) $this->_tpl_vars['fullflag']['items'] = (array)$this->_tpl_vars['fullflag']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['fullflag']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['fullflag']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['fullflag']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['fullflag']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['fullflag']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="radio" class="radio" name="fullflag" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['fullflag']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['fullflag']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '

         </div>
        <div class="phone-name"> 
          <h3>���ݼ�飺</h3>
          
          <textarea class="inp31" name="intro" id="intro" maxlength="140">'.$this->_tpl_vars['articlevals']['intro'].'</textarea>
         </div>
        <div class="phone-name"> 
          <h3>���߹��棺</h3>
          
		  <span>�˴���д������Ʒ�Ĺ������ݣ�֮�����ʾ������Ʒ��ҳ����Ʒ�������С��벻Ҫ����140�֡�</span>
		  <textarea  name="notice" id="notice" class="inp31" maxlength="140">'.$this->_tpl_vars['articlevals']['notice'].'</textarea>         
         </div>
        <div class="phone-name"> 
	          <h3>�ϴ�����棺</h3>
	          
	           <input type="file" class="text" size="60" name="articlelpic" id="articlelpic"/>
	           <span>���������PC�ˣ����ڷ�������޸ġ� </span>
	          
	         </div>
	        <div class="phone-name"> 
	          <h3>�ϴ�С���棺</h3>
	          
	           <input type="file" class="text" size="60" name="articlespic" id="articlespic"/>
	           <span>С���������ƶ��ˣ�Ĭ��ʹ�ô������Сͼ�� </span>
	          
	         </div>


';
if($this->_tpl_vars['allowmodify'] > 0){
echo '
</dl>



		<div class="hd">
			<h4>����Ա�޸�</h4>
</div>

   <div class="phone-name"> 
      <h3>�����ߣ�</h3>
      <input type="text" class="text" name="poster" id="poster" size="30" maxlength="30" value="'.$this->_tpl_vars['articlevals']['poster'].'" />
        <span>�����Ǳ�վ��Ա����</span>  
	         </div>
			 
<div class="phone-name"> 
          <h3>���ߣ�</h3>
          <input type="text" class="text" name="author" id="author" size="30" maxlength="30" value="'.$this->_tpl_vars['articlevals']['author'].'" />
         </div>
<div class="phone-name"> 
          <h3>������Ȩ��</h3>
          
  ';
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
echo '/>'.$this->_tpl_vars['authorflag']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '

         </div>
       <div class="phone-name"> 
          <h3>��Ȩ����</h3>
          
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
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['permission']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['permission']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '

         </div>
        <div class="phone-name"> 
          <h3>�׷�״̬��</h3>
          
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
  <input type="radio" class="radio" name="firstflag" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['firstflag']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['firstflag']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '

         </div>			 
			 
   <div class="phone-name"> 
      <h3>�Ƿ�ǩԼ��</h3>
     ';
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
	         </div>
 
<div class="phone-name"> 
  <h3>�Ƿ���£�</h3>
  
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
   <span>�����Ѿ�ǩԼС˵��Ч</span>
  
  
	         </div>

   <div class="phone-name"> 
      <h3>�Ƿ���ϣ�</h3>
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
echo '/>
        '.$this->_tpl_vars['buyout']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo '   
		<span>�����Ѿ�ǩԼС˵��Ч</span>
		
	         </div>
			 
   <div class="phone-name"> 
      <h3>�Ƿ���ۣ�</h3>
     ';
if (empty($this->_tpl_vars['discount']['items'])) $this->_tpl_vars['discount']['items'] = array();
elseif (!is_array($this->_tpl_vars['discount']['items'])) $this->_tpl_vars['discount']['items'] = (array)$this->_tpl_vars['discount']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['discount']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['discount']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['discount']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['discount']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['discount']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <input type="radio" class="radio" name="discount" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['discount_n']){
echo 'checked="checked" ';
}
echo '/>
        '.$this->_tpl_vars['discount']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo '   
		<span>�����Ѿ�ǩԼС˵��Ч</span>
		
	         </div>

   <div class="phone-name"> 
      <h3>�Ƿ�Ʒ��</h3>
     ';
if (empty($this->_tpl_vars['quality']['items'])) $this->_tpl_vars['quality']['items'] = array();
elseif (!is_array($this->_tpl_vars['quality']['items'])) $this->_tpl_vars['quality']['items'] = (array)$this->_tpl_vars['quality']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['quality']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['quality']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['quality']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['quality']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['quality']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <input type="radio" class="radio" name="quality" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['quality_n']){
echo 'checked="checked" ';
}
echo '/>
        '.$this->_tpl_vars['quality']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo '   
		<span>�����Ѿ�ǩԼС˵��Ч</span>
		
	         </div>

   <div class="phone-name"> 
      <h3>ƪ�����ͣ�</h3>
     ';
if (empty($this->_tpl_vars['isshort']['items'])) $this->_tpl_vars['isshort']['items'] = array();
elseif (!is_array($this->_tpl_vars['isshort']['items'])) $this->_tpl_vars['isshort']['items'] = (array)$this->_tpl_vars['isshort']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['isshort']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['isshort']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['isshort']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['isshort']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['isshort']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <input type="radio" class="radio" name="isshort" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['isshort_n']){
echo 'checked="checked" ';
}
echo '/>
        '.$this->_tpl_vars['isshort']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo '   
		
	         </div>

   <div class="phone-name"> 
      <h3>�Ƿ������</h3>
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
echo '/>
        '.$this->_tpl_vars['inmatch']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo '   
		
	         </div>	

   <div class="phone-name"> 
      <h3>�Ƿ���棺</h3>
     ';
if (empty($this->_tpl_vars['ispub']['items'])) $this->_tpl_vars['ispub']['items'] = array();
elseif (!is_array($this->_tpl_vars['ispub']['items'])) $this->_tpl_vars['ispub']['items'] = (array)$this->_tpl_vars['ispub']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['ispub']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['ispub']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['ispub']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['ispub']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['ispub']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <input type="radio" class="radio" name="ispub" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['ispub_n']){
echo 'checked="checked" ';
}
echo '/>
        '.$this->_tpl_vars['ispub']['items'][$this->_tpl_vars['i']['key']].' 
        ';
}
echo '   
		<span>�����Ѿ�ǩԼС˵��Ч</span>
		
	         </div>	
			 
			 
   <div class="phone-name"> 
      <h3>�������</h3>
     �գ�
        <input type="text" class="text" name="dayvisit" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['dayvisit'].'" /> </br>
        �ܣ�
        <input type="text" class="text" name="weekvisit" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['weekvisit'].'" /></br>
        �£�
        <input type="text" class="text" name="monthvisit" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['monthvisit'].'" /></br>
        �ܣ�
        <input type="text" class="text" name="allvisit" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['allvisit'].'" />  
	         </div>
   <div class="phone-name"> 
      <h3>�Ƽ�����</h3>
     �գ�
        <input type="text" class="text" name="dayvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['dayvote'].'" /></br>
        �ܣ�
        <input type="text" class="text" name="weekvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['weekvote'].'" /></br>
        �£�
        <input type="text" class="text" name="monthvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['monthvote'].'" /></br>
        �ܣ�
        <input type="text" class="text" name="allvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['allvote'].'" />  
	         </div>
   <div class="phone-name"> 
      <h3>�ʻ�����</h3>
     �գ�
        <input type="text" class="text" name="dayflower" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['dayflower'].'" /></br>
        �ܣ�
        <input type="text" class="text" name="weekflower" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['weekflower'].'" /></br>
        �£�
        <input type="text" class="text" name="monthflower" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['monthflower'].'" /></br>
        �ܣ�
        <input type="text" class="text" name="allflower" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['allflower'].'" />  
	         </div>
   <div class="phone-name"> 
      <h3>��������</h3>
     �գ�
        <input type="text" class="text" name="dayegg" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['dayegg'].'" /></br>
        �ܣ�
        <input type="text" class="text" name="weekegg" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['weekegg'].'" /></br>
        �£�
        <input type="text" class="text" name="monthegg" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['monthegg'].'" /></br>
        �ܣ�
        <input type="text" class="text" name="allegg" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['allegg'].'" />  
		
	         </div>
   <div class="phone-name"> 
      <h3>��Ʊ����</h3>
     �գ�
        <input type="text" class="text" name="dayvipvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['dayvipvote'].'" /></br>
        �ܣ�
        <input type="text" class="text" name="weekvipvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['weekvipvote'].'" /></br>
        �£�
        <input type="text" class="text" name="monthvipvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['monthvipvote'].'" /></br>
        �ܣ�
        <input type="text" class="text" name="allvipvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['allvipvote'].'" />  
	         </div>
    ';
}
echo '
    <div class="ft">
        <input type="hidden" name="act" value="update" />'.$this->_tpl_vars['jieqi_token_input'].'
        <input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['articlevals']['articleid'].'" />
		<input type="submit" class="btn btn-auto btn-blue" name="submit"  id="submit" value="�� ��" />
  </div>
  </div>
</form>
</div>
</div>';
?>