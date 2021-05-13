<?php
echo '

<link rel="stylesheet" href="/sink/css/settings.css" type="text/css"/>
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
<style>
.fix{
	height:60px;
	font-size:16px;
	font-weight: normal;
	width:100%;
	border-bottom:1px solid #eee;
}
.btn{
	width:120px;
	height:30px;
	background-color: #ff7043;
  color:#fff;
  border: 1px solid #ff7043;
}
.file1{
 
        overflow: hidden;
        font-size: 15px;


}
</style>
<!--sidebar2 begin-->

<section class="settings">
		<section class="container">
					<p class="here"><a href="/userdetail.php" title="会员中心">用户中心 </a>
			<b>&gt;</b><a href="###" title="">头像设置 </a></p>
      <ul id="tab_conbox" class="my_set">
			<li><b>用户名</b><b class="center" style="padding-left:5px;">'.$this->_tpl_vars['jieqi_username'].'</b></li>

	<form name="setavatar" id="setavatar" action="'.$this->_tpl_vars['jieqi_url'].'/setavatar.php?do=submit" method="post" enctype="multipart/form-data">

          <h2> 当前头像：</h2>
';
if($this->_tpl_vars['avatartype'] > 0){
echo '
<img id="cut_img" src="'.$this->_tpl_vars['url_avatar'].'?'.$this->_tpl_vars['jieqi_time'].'" style="margin:0;padding:0;border:1px solid #000000;" />
';
if($this->_tpl_vars['avatarcut'] == 1){
echo '
<img id="cut_img" src="'.$this->_tpl_vars['url_avatars'].'?'.$this->_tpl_vars['jieqi_time'].'" style="margin:0;padding:0;border:1px solid #000000;" />
<img id="cut_img" src="'.$this->_tpl_vars['url_avatari'].'?'.$this->_tpl_vars['jieqi_time'].'" style="margin:0;padding:0;border:1px solid #000000;" />
';
}
}
echo '

<div class="fix">
         <h3>上传头像：</h3>
		    <div class="userdefined-file"><input type="file"  class="file1"  style="margin-bottom: 10px;    border: 1px solid #eee;" size="30" name="avatarimage" id="avatarimage" /><br />

</div>
		   </div>

<div class="fix">
           &nbsp;
  <input type="hidden" name="act" value="upload" />'.$this->_tpl_vars['jieqi_token_input'].'
<div class="int"><input type="submit" class="btn" name="submit" value="上传头像" /></div>
		   </div>
<div class="fix">
          注:
<div class="int"><span class="hot">如果发现个人资料里面个人头像未更新，请重新登陆。</div>
		   </div>
</form>
	</ul>
		</section>
</section>



';
?>