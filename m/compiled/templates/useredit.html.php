<?php
echo '
<script type="text/javascript">
function jieqiFormValidate_useredit(){
  if(document.useredit.email.value == ""){
    alert("������Email");
    document.useredit.email.focus();
    return false;
  }
}
</script>
<style>
.bd3{
	width: 70%;
    height: 25px;
	padding-left:8px;
	}
.weui_btn {
	width:100%;
	height:42px;
    position: relative;
    display: block;
    margin-left: auto;
    margin-right: auto;
    padding-left: 14px;
    padding-right: 14px;
    box-sizing: border-box;
    font-size: 18px;
    text-align: center;
    text-decoration: none;
    color: #fff;
    line-height: 2.33333333;
    border-radius: 5px;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    overflow: hidden;
	background-color: #333333;
	border:1px solid #333333
}
</style>
<link rel="stylesheet" href="/sink/css/settings.css" type="text/css"/>
<section class="settings">
		<section class="container">
				<form name="useredit" id="useredit" action="'.$this->_tpl_vars['jieqi_url'].'/useredit.php?do=submit" method="post" onsubmit="return jieqiFormValidate_useredit();" class="form-horizontal">
			<p class="here"><a href="/userdetail.php" title="��Ա����">�û����� </a>
			<b>&gt;</b><a href="###" title="">�˻����� </a></p>
			<ul class="my_set">
			<li><b>�û���</b><b class="center" style="padding-left:5px;">'.$this->_tpl_vars['username'].'</b></li>
			<li><b>�ǳ�</b>
			<input type="text" maxlength="60" size="28"  name="nickname" id="nickname" value="'.$this->_tpl_vars['nickname'].'" class=" bd3"></b>
			</li>
			<li><b>��������</b>
			';
if($this->_tpl_vars['verify']['email'] > 0){
echo $this->_tpl_vars['email'];
}else{
echo '
			<input style="width: 55%;" maxlength="60" size="28"  name="email" id="email" value="'.$this->_tpl_vars['email'].'" type="email" class=" bd3">';
}
echo '&nbsp;<input type="checkbox" class="checkbox" name="showset_email" value="1"';
if($this->_tpl_vars['showset']['email'] > 0){
echo ' checked="checked"';
}
echo ' />��������</b>
			</li>
			<li><b>�Ա�</b>
									<input type="radio" name="sex" value="1"';
if($this->_tpl_vars['sex'] == 1){
echo ' checked';
}
echo '> ��
						<input type="radio" name="sex" value="2"';
if($this->_tpl_vars['sex'] == 2){
echo ' checked';
}
echo '> Ů
						<input type="radio" name="sex" value="0"';
if($this->_tpl_vars['sex'] == 0){
echo ' checked';
}
echo '> ����</b>
			</li>
			<li><b>QQ</b>
			<input type="text" maxlength="60" size="28"  name="qq" id="qq" value="'.$this->_tpl_vars['qq'].'" class=" bd3"></b>
			</li>
			<li><b>΢��/��վ</b>
			<input type="text" maxlength="60" size="28" name="url" id="url" value="'.$this->_tpl_vars['url'].'" class=" bd3"></b>
			</li>
			</ul>
			<input type="hidden" name="act" value="update" />'.$this->_tpl_vars['jieqi_token_input'].'<input type="submit" name="submit" value="��������" class="weui_btn">
					</form>
		</section>
</section>

<script type="text/javascript">
$(function(){
		$(\'#useredit\').on(\'submit\', function(e){
		e.preventDefault();
		 var tips = layer.open({type: 2,content: \'������\'});
				GPage.postForm(\'useredit\', $("#useredit").attr("action"),
			   function(data){
					if(data.status==\'OK\'){
                        $.ajaxSetup ({ cache: false });
					    layer.close(tips);
                        openMsg(data.msg);
					}else{
					    layer.close(tips);
		                openMsg(data.msg);
					}
			   });
//			}
		});
});
</script>';
?>