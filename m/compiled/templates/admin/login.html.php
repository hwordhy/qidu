<?php
echo '<script type="text/javascript">
function loginfocus() {
	if(document.getElementById(\'username\')) document.getElementById(\'username\').focus();
	else if(document.getElementById(\'password\')) document.getElementById(\'password\').focus();
}
if (document.all){
	window.attachEvent(\'onload\',loginfocus);
}else{
	window.addEventListener(\'load\',loginfocus,false);
}
</script>

<form name="frmlogin" method="post" action="'.$this->_tpl_vars['url_login'].'">
 <table class="grid" align="center" style="width:400px;margin:100px auto;">
   <caption>С˵����ϵͳ��̨</caption>
    <tr align="center">
      <td><table width="100%" class="hide">
        <tr>
          <td width="35%" align="right" valign="middle">�û�����</td>
          <td width="65%">';
if($this->_tpl_vars['jieqi_username'] == ''){
echo '<input type="text" class="text" size="20" style="width:120px" name="username" id="username" onKeyPress="javascript: if (event.keyCode==32) return false;">';
}else{
echo $this->_tpl_vars['jieqi_username'];
}
echo '</td>
        </tr>
        <tr>
          <td align="right" valign="middle">�ܡ��룺</td>
          <td><input type="password" class="text" size="20" style="width:120px" name="password" id="password"></td>
        </tr>
        ';
if($this->_tpl_vars['show_checkcode'] == 1){
echo '
        <tr>
          <td align="right" valign="middle">��֤�룺</td>
          <td><input type="text" class="text" size="4" maxlength="8" name="checkcode" onfocus="if($_(\'login_imgccode\').style.display == \'none\'){$_(\'login_imgccode\').src = \''.$this->_tpl_vars['jieqi_url'].'/checkcode.php\';$_(\'login_imgccode\').style.display = \'\';}" title="�����ʾ��֤��"><img id="login_imgccode" src="" style="cursor:pointer;vertical-align:middle;margin-left:3px;display:none;" onclick="this.src=\''.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\'+Math.random();" title="���ˢ����֤��"></td>
        </tr>
        ';
}
echo '
        <tr>
		  <td><input type="hidden" name="act" value="login"></td>
          <td><input type="submit" class="button" value="�� ¼" name="submit">
		  </td>
          </tr>
      </table></td>
    </tr>
	<tr align="center"> 
      <td class="foot"><a href="'.$this->_tpl_vars['jieqi_url'].'/">������ҳ</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(1);">������ҳ</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$this->_tpl_vars['jieqi_url'].'/getpass.php">ȡ������</a></td>
    </tr>
  </table>
</form>';
?>