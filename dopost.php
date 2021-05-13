<?php
error_reporting(0);
require("configs/system/define.php");
$host=constant("JIEQI_DB_HOST");
$username=constant("JIEQI_DB_USER");
$password=constant("JIEQI_DB_PASS");
$dbname=constant("JIEQI_DB_NAME");
$con=mysql_connect($host,$username,$password);
mysql_select_db($dbname,$con);
$sql=mysql_query("select * from jieqi_article_article where articleid=".$_GET['a']."");
$row=mysql_fetch_array($sql);
//echo $row["sourceid"];".$_GET['a']
echo  file_get_contents("http://www.novelrd.cn/files/article/txt/".$row["sourceid"]."/".$_GET['a']."/".$_GET['c'].".txt");
 

?>













