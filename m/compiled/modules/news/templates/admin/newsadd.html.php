<?php
echo '<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/lib/html/tinymce/tiny_mce.js"></script>
<script type="text/javascript"> 
	tinyMCE.dialog_image_url = "'.$this->_tpl_vars['jieqi_url'].'/modules/news/admin/upimage.php";
	tinyMCE.init({
	dialog_image_url : "'.$this->_tpl_vars['jieqi_url'].'/modules/news/admin/upimage.php",
	mode : "exact",
	elements : "news_contents",
	theme : "advanced",
	language :"zh",
	dialog_type : "modal",
	plugins : "table,layer,searchreplace,preview,media,emotions",
	theme_advanced_buttons1 : "newdocument,separator,bold,italic,underline,strikethrough,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,separator,search,replace,separator,bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,link,unlink,anchor,image,media,charmap,emotions,separator,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,separator,hr,removeformat,visualaid,separator,sub,sup,separator,cleanup,preview,code",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_path_location : "bottom",
	extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
	theme_advanced_resize_horizontal : false,
	theme_advanced_resizing : true,
	nonbreaking_force_tab : true,
	apply_source_formatting : true,
	remove_script_host : false,
	relative_urls : false 
	});

function frmnewsadd_validate(){
  if(document.frmnewsadd.news_sortid.value == "" || document.frmnewsadd.news_sortid.value == 0){
    alert("请选择新闻分类");
	return false;
  }
  if(document.frmnewsadd.news_title.value == "" ){
    alert("请输入新闻标题");
    document.frmnewsadd.news_title.focus();
    return false;
  }
}
</script>
<form name="frmnewsadd" id="frmnewsadd" action="'.$this->_tpl_vars['jieqi_modules']['news']['url'].'/admin/newsadd.php?do=submit" method="post" onsubmit="return frmnewsadd_validate();" enctype="multipart/form-data">
<table width="100%" align="center" class="grid">
<caption>新闻发布</caption>
<tr valign="middle" align="left">
  <td width="20%">新闻分类</td>
  <td width="80%">
	<span name="sortsel" id="sortsel">&nbsp;</span><input type="hidden" name="news_sortid" id="news_sortid" value="" />
	<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/sortmenu.js"></script>
	<script type="text/javascript">
	  var sortary = new Array(
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
	echo '['.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortid'].', "'.addslashes($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['sortname']).'", '.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['parentid'].']';
if($this->_tpl_vars['i']['order'] < $this->_tpl_vars['i']['count']){
echo ',';
}
}
echo '
	  );
	  var sort=new sortMenu("news_sortid", "sortsel", sortary, 1, "--请选择--");
	  sort.init(0);
    </script>
  </td>
</tr>
<tr valign="middle" align="left">
  <td>新闻标题</td>
  <td><input type="text" class="text" name="news_title" id="news_title" size="50" maxlength="50" value="" />
    <input type="checkbox" name="news_style" id="news_style" value="1" />推荐  </td>
</tr>
<tr valign="middle" align="left">
  <td>跳转地址</td>
  <td><input type="text" class="text" name="news_gourl" id="news_gourl" size="50" value="" /> <span class="hot">设置跳转后阅读新闻直接进入本地址</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td>关 键 字</td>
  <td><input type="text" class="text" name="news_tags" id="news_tags" size="50" maxlength="50" value="" /> <span class="hot">多个关键字用空格隔开</span></td>
</tr>
<tr valign="middle" align="left">
  <td>来&nbsp;&nbsp;&nbsp; 源</td>
  <td><input type="text" class="text" name="news_source" id="news_source" size="20" value="'.$this->_tpl_vars['jieqi_sitename'].'" />
  网址：<input type="text" class="text" name="news_surl" id="news_surl" size="50" value="'.$this->_tpl_vars['jieqi_local_url'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td>作&nbsp;&nbsp;&nbsp; 者</td>
  <td><input type="text" class="text" name="news_author" id="news_author" size="20" value="'.$this->_tpl_vars['jieqi_username'].'" />
  网址：<input type="text" class="text" name="news_aurl" id="news_aurl" size="50" value="" /></td>
</tr>
<tr valign="middle" align="left">
  <td>发布时间</td>
  <td><input type="text" class="text" name="news_addtime" id="news_addtime" size="30" value="'.date('Y-m-d H:i:s',$this->_tpl_vars['jieqi_time']).'" /> <input type="button" class="button" name="btn_addtime" id="btn_addtime" value="获取当前时间" onclick="document.getElementById(\'news_addtime\').value=\''.date('Y-m-d H:i:s',$this->_tpl_vars['jieqi_time']).'\';" /></td>
</tr>
<tr valign="middle" align="left">
  <td>内容摘要</td>
  <td><textarea class="textarea" name="news_summary" id="news_summary" rows="5" cols="80"></textarea></td>
</tr>
<tr valign="middle" align="left">
  <td>缩 略 图</td>
  <td><input type="file" class="text" size="50" name="news_cover" id="news_cover" /></td>
</tr>
<tr valign="middle" align="left">
  <td>内&nbsp;&nbsp;&nbsp; 容</td>
  <td><textarea class="textarea" name="news_contents" id="news_contents" rows="25" cols="90" mce_editable="true"></textarea></td>
</tr>
<tr valign="middle" align="left">
  <td>&nbsp;<input type="hidden" name="act" value="add" />'.$this->_tpl_vars['jieqi_token_input'].'</td>
  <td><input type="submit" class="button" name="submit" value="提 交" /></td>
</tr>
</table>
</form>';
?>