<?php
echo '<link type="text/css" rel="stylesheet" href="/themes/jieqi220/css/home.css" />
<!--��Ա����-->
  <section class="home">
   <section class="container" style="width: 96%;">
    <div class="my_info">
     <div class="clearfix">
      <span class="left fl"><a href="###" class="allways"><img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['uid'],'l',$this->_tpl_vars['avatar']).'" class="bd50" /></a></span>
      <span class="right fl"><h2>'.$this->_tpl_vars['name'].'</h2><p></p><a href="javascript:;" onclick="GPage.addbook(\'/user/signin.php\');" id="addbook" class="checkins">ǩ�������</a></span>
     </div>
     <p class="my_all_num clearfix"><a href="#"><b class="my_icon"></b>����:<em>&nbsp'.$this->_tpl_vars['score'].'</em></a><a href="#"><b class="my_age"></b>'.$this->_tpl_vars['egoldname'].':<em>&nbsp'.$this->_tpl_vars['egold'].'</em></a><a href="#"><b class="my_push"></b><em>  ';
if($this->_tpl_vars['overtime'] == 0){
echo '��δ����';
}else{
echo date('Y-m-d',$this->_tpl_vars['overtime']).' ����';
}
echo '</em></a></p>
    </div>
   </section>
  </section>
  <!--�ҵĵ���-->
  <section class="my_cats">
   <section class="container" style="width: 96%;">
   <!-- <a href="http://m.9kus.com/User/mylive">�ҵĳɳ� <b class="fr my_live"><img alt="'.$this->_tpl_vars['vip'].'" src="/sink/image/vip/lv'.$this->_tpl_vars['vipid'].'.gif"></b></a> -->
      <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/monthlybuy.php?id='.$this->_tpl_vars['uid'].'" >ȫվ���� <b class="fr">ֻ��3Ԫ���������⿴</b></a> 
    <a href="/modules/pay/paylog.php">��ֵ���Ѽ�¼ </a>
	<a href="/modules/obook/buylist.php">���ļ�¼ </a>
    <!--  -->
    <!--  -->
   </section>
  </section>
  <section class="my_cats">
   <section class="container" style="width: 96%;">
    <!--<a href="http://m.9kus.com/Notice/help">�������� <b class="fr">��ֵû���ʣ�</b></a>-->
    <a href="/useredit.php">�˻����� </a>
	<a href="/setavatar.php">ͷ������ </a>
    <!--  -->
    <a href="/modules/obook/buylist.php">���ļ�¼<b class="fr quxiao">ȡ��֮��,�շ��½ڻ�����</b></a>
    <a href="/newmessage.php?tosys=1">������� </a>
    <a href="/logout.php" onclick="return confirm(\'��ȷ��Ҫ�˳��\')" class="loginouts bd3">�˳���¼ </a>
   </section>
  </section>
  <!--�ҵĵ��� end-->
  <!--��Ա���� end-->';
?>