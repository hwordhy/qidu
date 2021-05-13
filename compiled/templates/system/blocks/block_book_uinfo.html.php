<?php
if($this->_tpl_vars['ownerid'] > 0){
echo '
<div class="clearfixer">
  <a href="javascript:;" class="avatar fl" target="_blank">
    <img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['uid'],'l',$this->_tpl_vars['avatar']).'" alt="">
  </a>
  <div class="name fl">
    <a href="javascript:;" class="text" target="_blank">'.$this->_tpl_vars['name'].'</a>
    <span href="javascript:;" class="sign ui_bgcolor">
                                            '.$this->_tpl_vars['group'].'
                                        </span>
  </div>
</div>
';
}

?>