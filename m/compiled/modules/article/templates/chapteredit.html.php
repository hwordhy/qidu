<?php
echo '
<script type="text/javascript">
function frmchapteredit_validate(){
  if(document.frmchapteredit.chaptername.value == ""){
    alert("�������½��½ڱ���");
    document.frmchapteredit.chaptername.focus();
    return false;
  }
}
//ͳ����������
function show_inputsize(txt){
	txt = $_(txt);
	var size = (arguments.length > 1) ? $_(arguments[1]) : $_(txt.id + \'_size\');
	size.innerHTML = txt.value.replace(/\\s/g, \'\').length;
}
//��ʾĬ������
addEvent(window, \'load\', function(){show_inputsize(\'chaptercontent\');});
</script>
<div class="container">
	<div class="mod block form">
		<div class="hd">
			<h4>�༭�½�</h4>
</div>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/attaches.js"></script>
<form name="frmchapteredit" id="frmchapteredit" action="'.$this->_tpl_vars['url_chapteredit'].'" method="post" onsubmit="return frmchapteredit_validate();" enctype="multipart/form-data">
<div class="mail-zc">
<div class="phone-name"> 
  <h3>С˵���ƣ�</h3>
  <a href="'.$this->_tpl_vars['article_static_url'].'/articlemanage.php?id='.$this->_tpl_vars['articleid'].'">'.$this->_tpl_vars['articlename'].'</a>
</div>
<div class="phone-name"> 
  <h3>';
if($this->_tpl_vars['chaptertype'] == 1){
echo '�־���⣺';
}else{
echo '�½ڱ��⣺';
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
  <h3>�½����ݣ�<br />������ <span id="chaptercontent_size">0</span> ��</h3>
  <textarea class="textarea" name="chaptercontent" id="chaptercontent" rows="25" cols="80" onkeyup="show_inputsize(this);" oninput="show_inputsize(this);" onpropertychange="show_inputsize(this);">'.$this->_tpl_vars['chaptercontent'].'</textarea>
</div>
';
if($this->_tpl_vars['isvip_n'] > 0 && $this->_tpl_vars['customprice'] > 0){
echo '

<!--<div class="phone-name"> 
  <h3>���ۼ۸�</h3>
  <input type="text" class="text" name="saleprice" id="saleprice" size="4" maxlength="10" value="';
if($this->_tpl_vars['autoprice'] == 0){
echo $this->_tpl_vars['saleprice'];
}
echo '" />'.$this->_tpl_vars['egoldname'].' <span>(�������Զ��������Ƽ�)</span>
</div>-->

';
}
if($this->_tpl_vars['authtypeset'] == 1){
echo '
<div class="phone-name"> 
  <h3>С˵�Ű棺</h3>
  <input type="radio" class="radio" name="typeset" value="1" checked="checked" />�Զ��Ű�
<input type="radio" class="radio" name="typeset" value="0" />�����Ű�
</div>
';
}
if($this->_tpl_vars['attachnum'] > 0){
echo '
<div class="phone-name"> 
  <h3>���и����� <br /><span>��ȡ���򹴱�ʾɾ���ø�����</span></h3>

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
  <h3>�������ƣ�</h3>
  �ļ����ͣ�'.$this->_tpl_vars['attachtype'].', ͼƬ���'.$this->_tpl_vars['maximagesize'].'K, �ļ����'.$this->_tpl_vars['maxfilesize'].'K
</div>
<div class="phone-name"> 
  <h3>�����ϴ���</h3>
  <input type="file" class="file" name="attachfile[]" id="attachfile" onchange="Attaches.addFile(\'attachfile\', \'attachdiv\', true);" /><input type="button" class="filebutton" onclick="if(document.all){document.getElementById(\'attachfile\').outerHTML += \'\';}else{document.getElementById(\'attachfile\').value = \'\';}" value="���" />
  <div id="attachdiv"></div>
</div>
';
}
}
if($this->_tpl_vars['chapternew'] == 0){
echo '
<div class="ft">
  <a class="btn btn-auto btn-blue" href="'.$this->_tpl_vars['jieqi_url'].'/newmessage.php?tosys=1&title=�����޸��½�-���'.$this->_tpl_vars['articleid'].'-'.$this->_tpl_vars['chaptername'].'">�����޸��½�</a><span>�����ѱ���������ֹ�޸ģ����ȷʵ��Ҫ�޸ģ�����ϵ����Ա����</span>
  </div>
  ';
}else{
echo '
<div class="ft">
  <input type="hidden" name="act" value="update" />'.$this->_tpl_vars['jieqi_token_input'].'
  <input type="hidden" name="id" value="'.$this->_tpl_vars['chapterid'].'" />
  <input type="hidden" name="chaptertype" value="'.$this->_tpl_vars['chaptertype'].'" />
  <input type="submit" class="btn btn-auto btn-blue" name="submit" value="�� ��" />
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
		 var tips = layer.open({type: 2,content: \'������\'});
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