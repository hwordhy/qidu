<?php
echo '

	
    <ul class="column">
     <li><a href="'.$this->_tpl_vars['jieqi_url'].'/user/"><em class="def b">首页</em></a></li>
     <li id="row"><a href="javascript:void(0)"><em class="account">帐号管理</em></a>
	 <dl class="list_menu" style="display:none">
       <dd id="userhub_usereditView"><a href="'.jieqi_geturl('users','users','useredit','0').'"><i>·</i>修改资料</a></dd>
       <dd id="userhub_upaView"><a href="'.jieqi_geturl('users','users','setavatar','0').'"><i>·</i>修改头像</a></dd>
       <dd id="userhub_pwdview"><a href="'.jieqi_geturl('users','users','passedit','0').'"><i>·</i>密码及安全</a></dd>
      </dl>
     </li>
     <li id="row"><a href="'.jieqi_geturl('article','bookcase','bookcase','0').'"><em class="trend">我的书架</em></a></li>
     <li id="row"><a href="javascript:void(0)"><em class="fiscal">账务中心</em></a>
      <dl class="list_menu" style="display:none">
       <dd id="home_main"><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php"><i>·</i>充值</a></dd>
       <dd id="userhub_czView"><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/paylog.php"><i>·</i>我的充值记录</a></dd>
       <dd id="userhub_dyView"><a href="'.$this->_tpl_vars['jieqi_modules']['obook']['url'].'/buylist.php"><i>·</i>订阅记录</a></dd>
      </dl>
     </li>
     <li id="row"><a href="javascript:;"><em class="task">消息中心</em></a>
      <dl class="list_menu" style="display:none">
       <dd id="task_main"><a href="'.$this->_tpl_vars['jieqi_url'].'/message.php?box=inbox"><i>·</i>收件箱</a></dd>
       <dd id="task_czView"><a href="'.$this->_tpl_vars['jieqi_url'].'/message.php?box=outbox"><i>·</i>发件箱</a></dd>
	   <dd id="userhub_newmessage"><a href="'.$this->_tpl_vars['jieqi_url'].'/newmessage.php"><i>&middot;</i>写新消息</a></dd>
       <dd id="userhub_usermember"><a href="'.$this->_tpl_vars['jieqi_url'].'/newmessage.php?tosys=1"><i>&middot;</i>写给管理员</a></dd>

      </dl>
     </li>     
	 ';
if($this->_tpl_vars['jieqi_groupid'] >= 6 ||$this->_tpl_vars['jieqi_groupid'] ==2){
echo '
	 	     <li id="row"><a href="javascript:void(0)"><em class="works">作品管理</em></a>
	      <dl class="list_menu" style="display:none">
	       <dd id="article_step1View"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/newarticle.php"><i>&middot;</i>创建新书</a></dd>
	       		<!-- 如果当前作者没有创建的新书，此功能点不予显示 -->
	       		<dd id="article_masterPage"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/masterpage.php"><i>&middot;</i>我的作品库</a></dd>
	       		<!--<dd id="chapter_newChapterView"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/monthlybuy.php?id=1"><i>&middot;</i>申请上架</a></dd> -->
	       		<!--<dd id="userhub_review_view"><a href="'.$this->_tpl_vars['jieqi_url'].'/ptopics.php?oid=self"><i>&middot;</i>我的留言</a></dd> -->
				<dd><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/newdraft.php"><i>&middot;</i>新建草稿</a></dd>
				<dd><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/draft.php"><i>&middot;</i>管理草稿</a></dd>
				<dd><a href="'.$this->_tpl_vars['jieqi_url'].'/persondetail.php"><i>&middot;</i>我的资料</a></dd>
	      </dl>
	     </li>
		 <li id="row"><a href="'.$this->_tpl_vars['jieqi_modules']['obook']['url'].'/masterpage.php"><em class="income">收入管理</em></a>
	     </li>
	 ';
}else{
echo ' 
     	<li id="row"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/applywriter.php"><em class="apply">申请作者</em></a></li>
	  ';
}
echo '
  </ul>
';
?>