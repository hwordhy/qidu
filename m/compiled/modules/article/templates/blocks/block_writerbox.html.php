<?php
echo '<div class="ulnav_au col2 fl">
<ul class="ulnav">
  <li><a href="'.$this->_tpl_vars['article_dynamic_url'].'/myarticle.php">������ҳ</a></li>
  <li><a href="'.$this->_tpl_vars['article_static_url'].'/newarticle.php">����С˵</a></li>
  <li><a href="'.$this->_tpl_vars['article_dynamic_url'].'/masterpage.php">����С˵</a></li>
  <li><a href="'.$this->_tpl_vars['article_dynamic_url'].'/monthlybuy.php?id=1">�����ϼ�</a></li>
  ';
if($this->_tpl_vars['jieqi_modules']['obook']['publish'] > 0){
echo '
  <li><a href="'.$this->_tpl_vars['jieqi_modules']['obook']['url'].'/masterpage.php">�������</a></li>
  ';
}
echo '
  <li><a href="'.$this->_tpl_vars['article_dynamic_url'].'/newdraft.php">�½��ݸ�</a></li>
  <li><a href="'.$this->_tpl_vars['article_dynamic_url'].'/draft.php">�����ݸ�</a></li>
  <li><a href="'.$this->_tpl_vars['jieqi_url'].'/persondetail.php">����ʵ����Ϣ</a></li>
</ul>
</div>';
?>