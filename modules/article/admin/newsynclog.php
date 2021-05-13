<?php
require_once ("../../../global.php");
$syncsite = array();
if (file_exists(JIEQI_ROOT_PATH."/configs/article/syncsite.php")) {
   require( JIEQI_ROOT_PATH."/configs/article/syncsite.php"); 
}

/************按时间顺序输出文件夹中的文件******************/
function dir_size($dir, $url) {
	$dh = @opendir ( $dir ); // 打开目录，返回一个目录流
	$return = array ();
	$i = 0;
	while ( $file = @readdir ( $dh ) ) { // 循环读取目录下的文件
		if ($file != '.' and $file != '..') {
			$path = $dir . '/' . $file; // 设置目录，用于含有子目录的情况
			if (is_dir ( $path )) {
			} elseif (is_file ( $path )) { 
				$filetime [] = date ( "Y-m-d H:i:s", filemtime ( $path ) ); // 获取文件最近修改日期 
				$return [] = $url . '/' . $file;
			}
		}
	}
	@closedir ( $dh ); // 关闭目录流 
	@array_multisort($filetime,SORT_DESC,SORT_STRING, $return);//按时间排序
	return $return; // 返回文件
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
<div class="gridtop">同步小说<<?php echo $syncsite[$_GET['id']]['sitename']?>>日志</div>
<table class="grid" width="100%" align="center">
<?php
  $log_path = JIEQI_ROOT_PATH."/files/sync/json".$_GET['id'];
 // $logfile = my_scandir($log_path);
  $logfile = dir_size($log_path,$log_path);
 
  if($logfile){
		foreach ($logfile as $k=>$v){
			$log .="<a href='/modules/article/admin/logdetail.php?id=".$_GET['id']."&file=".urlencode($v)."'>".basename($v)."</a><br/>";
		}
  }
  
  /*
  $log = file_get_contents($logfile);
  $log = str_replace(PHP_EOL, '</br>', $log);
  */
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