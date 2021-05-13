<?php
echo '<html>
<head>
<meta http-equiv="content-type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'" />
<title>出现错误！</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" media="all" href="'.$this->_tpl_vars['jieqi_url'].'/sink/css/common.css" />
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/common.js"></script>
<style media="screen">
	a{color: red}
</style>
</head>
<body>
<div style="width:100%; text-align:center; padding-top:150px;">
  <div style="margin:auto; width:350px;">
    <div class="block">
      <div class="blockcontent">
	    <div style="padding:10px">'.$this->_tpl_vars['errorinfo'].'<br />'.$this->_tpl_vars['debuginfo'].'<br /></div>
	    <div style="width:100%; text-align: right; line-height:200%; padding-right:10px;">[<a href="javascript:history.back(1)">返回上一页</a>]</div>
	  </div>
	  <div class="blocknote">版权所有&copy; '.$this->_tpl_vars['jieqi_sitename'].'</div>
	</div>
  </div>
</div>
</body>
</html>
';
?>