<?php
$GLOBALS['jieqiTset']['jieqi_blocks_module'] = 'article';
$GLOBALS['jieqiTset']['jieqi_blocks_config'] = 'infoblocks';
$this->_tpl_vars['jieqi_pagetitle'] = "{$this->_tpl_vars['articlename']}-{$this->_tpl_vars['author']}-{$this->_tpl_vars['jieqi_sitename']}";
$this->_tpl_vars['meta_keywords'] = "{$this->_tpl_vars['articlename']} {$this->_tpl_vars['author']} {$this->_tpl_vars['sort']}";
$GLOBALS['jieqiTset']['jieqi_page_template'] = 'cover/m/templates/article/articleinfo.html';

?>