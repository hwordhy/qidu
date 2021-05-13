<?php
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/author_header.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
<div class="container-fluid container-box">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            ';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/author_left.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main indexpage">
            <h1 class="page-header">新闻公告</h1>
            <div class="container-wrap">
                <div class="newslist">
                    <ul>
                        '.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/jquery.superslide.min.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/style/author/js/slider.js"></script>
<script type="text/javascript">
    $(\'.newslist ul li a\').on(\'mouseover\',function(){
        $(this).find(\'.dot\').addClass(\'rdot\');
    }).on(\'mouseleave\',function(){{
        $(this).find(\'.dot\').removeClass(\'rdot\');
    }})
    $(".n01 a").addClass(\'active\');
</script>

';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'templates/system/author_footer.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '

';
?>