<?php
echo '<ul class="ultab">
';
if($this->_tpl_vars['jieqi_modules']['article']['publish'] > 0){
echo '<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/bookcase.php"';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'bookcase.php'){
echo ' class="selected"';
}
echo '>我的书架</a></li>';
}
if($this->_tpl_vars['jieqi_modules']['article']['publish'] > 0){
echo '<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/myreviews.php"';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'myreviews.php'){
echo ' class="selected"';
}
echo '>我的书评</a></li>';
}
if($this->_tpl_vars['jieqi_modules']['obook']['publish'] > 0){
echo '<li><a href="'.$this->_tpl_vars['jieqi_modules']['obook']['url'].'/buylist.php"';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'buylist.php'){
echo ' class="selected"';
}
echo '>我的订阅</a></li>';
}
if($this->_tpl_vars['jieqi_modules']['article']['publish'] > 0){
echo '<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/myactlog.php?act=tip"';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'myactlog.php' && $this->_tpl_vars['_request']['act'] == 'tip'){
echo ' class="selected"';
}
echo '>打赏记录</a></li>';
}
if($this->_tpl_vars['jieqi_modules']['pay']['publish'] > 0){
echo '<li><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/paylog.php"';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'paylog.php'){
echo ' class="selected"';
}
echo '>充值记录</a></li>';
}
echo '
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/myfriends.php"';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'myfriends.php'){
echo ' class="selected"';
}
echo '>我的好友</a></li>
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/myptopics.php"';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'myptopics.php'){
echo ' class="selected"';
}
echo '>我的留言</a></li>
</ul>';
?>