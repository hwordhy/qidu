<?php
require_once ("../../../global.php");
$syncsite = array();
if (file_exists(JIEQI_ROOT_PATH."/configs/article/syncsite.php")) {
   require( JIEQI_ROOT_PATH."/configs/article/syncsite.php"); 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>同步规则设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" type="text/css" media="all" href="/css/admin_right.css" />
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="/scripts/admin.js"></script>
</head>
<body >
<div id="content">
<div class="gridtop">同步日志详情 <span class=""><a href="/modules/article/admin/newsynclog.php?id=<?php echo $_GET['id']?>">返回《<?php echo $syncsite[$_GET['id']]['sitename']?>》日志列表</a></span></div>
<table class="grid" width="100%" align="center">
<?php
  $logfile = urldecode($_GET['file']);  
  $log = file_get_contents($logfile);
  $log = str_replace(PHP_EOL, '</br>', $log);
?>
  <tr>
    <td><?php echo $log?></td>
  </tr>
  <tr>
    <td colspan="4" align="right"><a href="/modules/article/admin/newsyncset.php">返回列表</a>&nbsp;</td>
  </tr>
</table></div>

    
</body>
</html>