<?php
echo '<script type="text/javascript">
function frmtip_validate(){
  if(document.frmtip.payegold.value == ""){
    alert("请输入打赏'.$this->_tpl_vars['egoldname'].'");
    document.frmtip.payegold.focus();
    return false;
  }

  if(parseInt(document.frmtip.payegold.value) < 20){
    alert("至少打赏'.$this->_tpl_vars['egoldname'].'20以上");
    document.frmtip.payegold.focus();
    return false;
  }
}
</script>
<style>
  .tdr{
    display: block;
    margin-top: 8px;
  }
  .button{
    width: 100px;
  }
</style>
<form name="frmtip" id="frmtip" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/tip.php?do=submit" method="post" onsubmit="return frmtip_validate();" enctype="multipart/form-data">
<table  class="grid" align="center">
<caption>打赏作品</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="30%">小说名</td>
  <td class="tdr"><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info',$this->_tpl_vars['articlecode']).'">'.$this->_tpl_vars['articlename'].'</a></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">我的'.$this->_tpl_vars['egoldname'].'</td>
  <td class="tdr">'.$this->_tpl_vars['useremoney'].' '.$this->_tpl_vars['egoldname'].'  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">打赏'.$this->_tpl_vars['egoldname'].'</td>
  <td class="tdr">
  <input type="text" class="text" name="payegold" id="payegold" size="10" maxlength="10" value="" /> <span class="hot">至少 20 以上</span>  
  </td>
</tr>

<tr valign="middle" align="left">
  <td class="tdl">
  &nbsp;
  <input type="hidden" name="act" value="post" />'.$this->_tpl_vars['jieqi_token_input'].'
  <input type="hidden" name="id" value="'.$this->_tpl_vars['articleid'].'" />  </td>
  <td class="tdr">
  ';
if($this->_tpl_vars['ajax_request'] > 0){
echo '
  <input type="button" name="Submit" class="button" value="提 交" style="cursor:pointer;" onclick="Ajax.Request(\'frmtip\',{onLoading:function(){Form.disable(\'frmtip\');},onComplete:function(){alert(this.response.replace(/<br[^<>]*>/g,\'\\n\'));Form.enable(\'frmtip\');closeDialog();
}});">
  ';
}else{
echo '
  <input type="submit" class="button" name="submit" value="提 交" />
  ';
}
echo '
  </td>
</tr>

</table>
</form>';
?>