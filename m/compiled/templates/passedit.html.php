<?php
echo '
<link href="/sink/css/user.css" type="text/css" rel="stylesheet">

<!--wrap begin-->
<div class="wrap2">
  <script type="text/javascript">
$(function(){
	
  var ss = \'userhub\'+\'_\'+\'\';
  if(ss == \'userhub_inbox\' || ss == \'userhub_outbox\' || ss == \'userhub_draft\' || ss == \'userhub_toSysView\' || ss == \'userhub_messagedetail\'){
      $(\'#userhub_newmessage\').parent("dl.list_menu").show();
	  $(\'#userhub_newmessage\').children("a").addClass("focus");
  }
  if(ss == \'chapter_cmView\'){
      $(\'#article_masterPage\').parent("dl.list_menu").show();
	  $(\'#article_masterPage\').children("a").addClass("focus");
  }
//  if(\'\' == \'upaView\'){
//      $(\'#userhub_usereditView\').parent("dl.list_menu").show();
//	  $(\'#userhub_usereditView\').children("a").addClass("focus");
//  }
  if(\'\' == \'hotcomment\'){
      $(\'#userhub_comment\').parent("dl.list_menu").show();
	  $(\'#userhub_comment\').children("a").addClass("focus");
  }
  if(\'\' == \'uservip\'){
      $(\'#userhub_usermember\').parent("dl.list_menu").show();
	  $(\'#userhub_usermember\').children("a").addClass("focus");
  }
  if(\'\' == \'moderatorView\'){
      $(\'#userhub_review_view\').parent("dl.list_menu").show();
	  $(\'#userhub_review_view\').children("a").addClass("focus");
  }
  $(\'#\'+ss).parent("dl.list_menu").show();
  $(\'#\'+ss).children("a").addClass("focus");
  $("li#row em").click(function(){
  $(this).parent().parent().children("dl.list_menu").toggle(300);
  });
});

</script>
<!--sidebar2 begin-->
  <div class="sidebar2 fl bg4 fix">
	
		    <div class="user2 f_blue fix">
'.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'

	'.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'
  <div class="kf"></div>
  </div>
<script type="text/javascript">
function frmpassedit_validate(){
  if (document.frmpassedit.oldpass.value == ""){
    alert( "请输入原密码！" );
	document.frmpassedit.oldpass.focus();
	return false;
  }
  if(document.frmpassedit.newpass.value == ""){
    alert( "请输入新密码！" );
	document.frmpassedit.newpass.focus();
	return false;
  }
  if (document.frmpassedit.repass.value != document.frmpassedit.newpass.value){
    alert( "两次新密码输入不同，请重新输入！" );
	document.frmpassedit.repass.focus();
	return false;
  }
}
</script>
 <div class="article3 fr bg5">
    <div class="tabox">
	    <div class="t2">
   <h2>个人资料</h2>
   <ul class="tabs62">
	<li><a href="'.jieqi_geturl('users','users','useredit','0').'">基本资料</a></li>
	<li><a href="'.jieqi_geturl('users','users','setavatar','0').'">修改头像</a></li>
	<li class="thistab"><a href="'.jieqi_geturl('users','users','passedit','0').'">修改密码</a></li>
   </ul>       
  </div>
      <ul id="tab_conbox" class="f0 bg5">
        <li class="fix">
         <dl class="box_form pt20">
<form name="frmpassedit" id="frmpassedit" action="'.$this->_tpl_vars['url_passedit'].'" method="post" onsubmit="return frmpassedit_validate();">
<dd class="fix">
           <em class="tt2">用户名：</em>
		   <div class="int">'.$this->_tpl_vars['jieqi_username'].'</div>
		   </dd>
<dd class="fix">
           <em class="tt2">原密码：</em>
		   <div class="int"><input type="password" class="text" name="oldpass" size="25" value="" /></div>
		   </dd>
<dd class="fix">
           <em class="tt2">新密码：</em>
		   <div class="int"><input type="password" class="text" name="newpass" size="25" value="" /></div>
		   </dd>
<dd class="fix">
           <em class="tt2">重复新密码：</em>
		   <div class="int"><input type="password" class="text" name="repass" size="25" value="" /></div>
		   </dd>
<dd class="fix">
           <em class="tt2">&nbsp;<input type="hidden" name="act" value="update" />'.$this->_tpl_vars['jieqi_token_input'].'</em>
		   <div class="int"><input type="submit" class="btn" name="submit" value="保 存" /></div>
		   </dd>

</form>
</dl>
</li>
</ul>
</div>
</div>';
?>