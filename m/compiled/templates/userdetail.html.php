<?php
echo '<link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/home.css" />
<!--会员中心-->
  <section class="home">
   <section class="container" style="width: 96%;">
    <div class="my_info">
     <div class="clearfix">
      <span class="left fl"><a href="###" class="allways"><img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['uid'],'l',$this->_tpl_vars['avatar']).'" class="bd50" /></a></span>
      <span class="right fl"><h2>'.$this->_tpl_vars['name'].'</h2><p></p><a href="javascript:;" onclick="GPage.addbook(\'/user/signin.php\');" id="addbook" class="checkins">签到领积分</a></span>
     </div>
     <p class="my_all_num clearfix"><a href="#"><b class="my_icon"></b>积分:<em>&nbsp'.$this->_tpl_vars['score'].'</em></a><a href="#"><b class="my_age"></b>'.$this->_tpl_vars['egoldname'].':<em>&nbsp'.$this->_tpl_vars['egold'].'</em></a><a href="#"><b class="my_push"></b><em>  ';
if($this->_tpl_vars['overtime'] == 0){
echo '尚未包月';
}else{
echo date('Y-m-d',$this->_tpl_vars['overtime']).' 到期';
}
echo '</em></a></p>
    </div>
   </section>
  </section>
  <!--我的导航-->
  <section class="my_cats">
   <section class="container" style="width: 96%;">
   <!-- <a href="http://m.9kus.com/User/mylive">我的成长 <b class="fr my_live"><img alt="'.$this->_tpl_vars['vip'].'" src="/sink/image/vip/lv'.$this->_tpl_vars['vipid'].'.gif"></b></a> -->
      <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/monthlybuy.php?id='.$this->_tpl_vars['uid'].'" >全站包月 <b class="fr">只需3元，包月任意看</b></a> 
    <a href="/modules/pay/paylog.php">充值消费记录 </a>
	<a href="/modules/obook/buylist.php">订阅记录 </a>
    <!--  -->
    <!--  -->
   </section>
  </section>
  <section class="my_cats">
   <section class="container" style="width: 96%;">
    <!--<a href="http://m.9kus.com/Notice/help">常见问题 <b class="fr">充值没到帐？</b></a>-->
    <a href="/useredit.php">账户设置 </a>
	<a href="/setavatar.php">头像设置 </a>
    <!--  -->
    <a href="/modules/obook/buylist.php">订阅记录<b class="fr quxiao">取消之后,收费章节会提醒</b></a>
    <a href="/newmessage.php?tosys=1">意见反馈 </a>
    <a href="/logout.php" onclick="return confirm(\'您确定要退出嘛？\')" class="loginouts bd3">退出登录 </a>
   </section>
  </section>
  <!--我的导航 end-->
  <!--会员中心 end-->';
?>