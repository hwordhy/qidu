<?php
echo '<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'" />
    <meta http-equiv="refresh" content=\'3; url='.$this->_tpl_vars['url'].'\'>
    <title>'.$this->_tpl_vars['pagetitle'].'</title>
    <link rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_themeurl'].'style.css" />
    <link rel="icon" href="'.$this->_tpl_vars['jieqi_url'].'/favicon.ico" />
    <!--[if lt IE 9]><script src="'.$this->_tpl_vars['jieqi_url'].'/scripts/html5.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="'.$this->_tpl_vars['jieqi_url'].'/scripts/css3-mediaqueries.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/common.js"></script>
    <script language="javascript" type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/theme.js"></script>
</head>
<body>
    <div class="msgbox">
        <div class="block">
            <div class="blocktitle">'.$this->_tpl_vars['title'].'</div>
            <div class="blockcontent">
                <div style="padding:10px; text-align:left;">'.$this->_tpl_vars['content'].'</div>
            </div>
        </div>
    </div>
</body>
</html>
';
?>