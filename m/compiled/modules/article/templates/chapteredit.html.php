<?php
echo '
<script type="text/javascript">
function frmchapteredit_validate(){
  if(document.frmchapteredit.chaptername.value == ""){
    alert("请输入章节章节标题");
    document.frmchapteredit.chaptername.focus();
    return false;
  }
}
//统计输入字数
function show_inputsize(txt){
	txt = $_(txt);
	var size = (arguments.length > 1) ? $_(arguments[1]) : $_(txt.id + \'_size\');
	size.innerHTML = txt.value.replace(/\\s/g, \'\').length;
}
//显示默认字数
addEvent(window, \'load\', function(){show_inputsize(\'chaptercontent\');});
</script>
<div class="container">
	<div class="mod block form">
		<div class="hd">
			<h4>编辑章节</h4>
</div>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/attaches.js"></script>
<form name="frmchapteredit" id="frmchapteredit" action="'.$this->_tpl_vars['url_chapteredit'].'" method="post" onsubmit="return frmchapteredit_validate();" enctype="multipart/form-data">
<div class="mail-zc">
<div class="phone-name"> 
  <h3>小说名称：</h3>
  <a href="'.$this->_tpl_vars['article_static_url'].'/articlemanage.php?id='.$this->_tpl_vars['articleid'].'">'.$this->_tpl_vars['articlename'].'</a>
</div>
<div class="phone-name"> 
  <h3>';
if($this->_tpl_vars['chaptertype'] == 1){
echo '分卷标题：';
}else{
echo '章节标题：';
}
echo '</h3>
  <input type="text" class="text" name="chaptername" id="chaptername" size="50" maxlength="50" value="'.$this->_tpl_vars['chaptername'].'" />';
if($this->_tpl_vars['isvip_n'] > 0 && $this->_tpl_vars['chaptertype'] == 0){
echo '<span>vip</span>';
}
echo '
</div>
';
if($this->_tpl_vars['chaptertype'] != 1){
echo '
<div class="phone-name"> 
  <h3>章节内容：<br />已输入 <span id="chaptercontent_size">0</span> 字</h3>
  <textarea class="textarea" name="chaptercontent" id="chaptercontent" rows="25" cols="80" onkeyup="show_inputsize(this);" oninput="show_inputsize(this);" onpropertychange="show_inputsize(this);">'.$this->_tpl_vars['chaptercontent'].'</textarea>
</div>
';
if($this->_tpl_vars['isvip_n'] > 0 && $this->_tpl_vars['customprice'] > 0){
echo '

<!--<div class="phone-name"> 
  <h3>销售价格：</h3>
  <input type="text" class="text" name="saleprice" id="saleprice" size="4" maxlength="10" value="';
if($this->_tpl_vars['autoprice'] == 0){
echo $this->_tpl_vars['saleprice'];
}
echo '" />'.$this->_tpl_vars['egoldname'].' <span>(留空则自动按字数计价)</span>
</div>-->

';
}
if($this->_tpl_vars['authtypeset'] == 1){
echo '
<div class="phone-name"> 
  <h3>小说排版：</h3>
  <input type="radio" class="radio" name="typeset" value="1" checked="checked" />自动排版
<input type="radio" class="radio" name="typeset" value="0" />无需排版
</div>
';
}
if($this->_tpl_vars['attachnum'] > 0){
echo '
<div class="phone-name"> 
  <h3>现有附件： <br /><span>（取消打勾表示删除该附件）</span></h3>

  ';
if (empty($this->_tpl_vars['attachrows'])) $this->_tpl_vars['attachrows'] = array();
elseif (!is_array($this->_tpl_vars['attachrows'])) $this->_tpl_vars['attachrows'] = (array)$this->_tpl_vars['attachrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['attachrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['attachrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['attachrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['attachrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['attachrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="checkbox" class="checkbox" name="oldattach[]" value="'.$this->_tpl_vars['attachrows'][$this->_tpl_vars['i']['key']]['attachid'].'" checked="checked" />'.$this->_tpl_vars['attachrows'][$this->_tpl_vars['i']['key']]['name'].' 
  ';
}
echo '
</div>
';
}
if($this->_tpl_vars['canupload'] == true && $this->_tpl_vars['maxattachnum'] > 0){
echo '
<div class="phone-name"> 
  <h3>附件限制：</h3>
  文件类型：'.$this->_tpl_vars['attachtype'].', 图片最大：'.$this->_tpl_vars['maximagesize'].'K, 文件最大：'.$this->_tpl_vars['maxfilesize'].'K
</div>
<div class="phone-name"> 
  <h3>附件上传：</h3>
  <input type="file" class="file" name="attachfile[]" id="attachfile" onchange="Attaches.addFile(\'attachfile\', \'attachdiv\', true);" /><input type="button" class="filebutton" onclick="if(document.all){document.getElementById(\'attachfile\').outerHTML += \'\';}else{document.getElementById(\'attachfile\').value = \'\';}" value="清空" />
  <div id="attachdiv"></div>
</div>
';
}
}
if($this->_tpl_vars['chapternew'] == 0){
echo '
<div class="ft">
  <a class="btn btn-auto btn-blue" href="'.$this->_tpl_vars['jieqi_url'].'/newmessage.php?tosys=1&title=申请修改章节-书号'.$this->_tpl_vars['articleid'].'-'.$this->_tpl_vars['chaptername'].'">申请修改章节</a><span>本章已被锁定，禁止修改！如果确实需要修改，请联系管理员处理。</span>
  </div>
  ';
}else{
echo '
<div class="ft">
  <input type="hidden" name="act" value="update" />'.$this->_tpl_vars['jieqi_token_input'].'
  <input type="hidden" name="id" value="'.$this->_tpl_vars['chapterid'].'" />
  <input type="hidden" name="chaptertype" value="'.$this->_tpl_vars['chaptertype'].'" />
  <input type="submit" class="btn btn-auto btn-blue" name="submit" value="提 交" />
</div>
';
}
echo '
</div>
</form>
</div>
</div>
<script type="text/javascript">
$(function(){
		$(\'#frmchapteredit\').on(\'submit\', function(e){
		e.preventDefault();
		 var tips = layer.open({type: 2,content: \'加载中\'});
				GPage.postForm(\'frmchapteredit\', $("#frmchapteredit").attr("action"),
			   function(data){
					if(data.status==\'OK\'){
                        $.ajaxSetup ({ cache: false });
					    layer.close(tips);
                        jumpurl(data.jumpurl);
					}else{
					    layer.close(tips);
		                openMsgs(data.msg);
					}
			   });
//			}
		});
});
</script> ';
?>