<?php
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/author_header.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
<div class="container-fluid container-box msg_system newsdetail">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1 class="page-header">新闻公告<a class="backlist" href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/myarticle.php"> 返回列表 </a></h1>
      <div class="container-wrap">
        <div class="sys-inform">'.$this->_tpl_vars['news']['title'].'<span class="sys-date">  '.date('Y-m-d H:i:s',$this->_tpl_vars['news']['addtime']).'</span></div>
        <pre class="sys-cont">'.$this->_tpl_vars['news']['contents'].'</pre>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".n01 a").addClass(\'active\');
    });
</script>
';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/author_footer.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);

?>