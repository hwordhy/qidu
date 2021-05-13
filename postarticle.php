<?php
require("configs/system/define.php");

$ips=constant("JIEQI_DB_HOST");
$username=constant("JIEQI_DB_USER");
$password=constant("JIEQI_DB_PASS");
$db=constant("JIEQI_DB_NAME");
//链接数据库


//error_reporting(0);
/*
 $server="150.109.180.178";
$username="taiguowaimai";
$password="1qaz2wsx";
$db=mysql_connect($server,$username,$password);
$con=mysql_select_db("msg",$db);
 
mysql_query("set character set 'utf8'");//读库
if(!$con){echo "连接失败";}else{echo "";}
*/
 
$con=mysql_connect($ips,$username,$password);
$cnn=mysql_select_db($db,$con);
if(!$cnn){echo "连接失败";}else{echo "OK";}

//获取订单发布的数据
$sql=mysql_query("select * from jieqi_article_draft");
while($row=mysql_fetch_array($sql)){
//1 判断里面的文章数据

//2 判断是不是发布时间在现在？


//3 进行发布，其实就是将信息写进文章chapter数据库

//4 删除当前数据库的文章
mysql_query("insert into jieqi_article_chapter(chapterid,articlename,articleid,posterid,poster,postdate,lastupdate,chaptername,chapterorder,size,summary)values(".$row["chapterid"].",".$row["articlename"].",".$row["articleid"].",".$row["posterid"].",".$row["poster"].",".$row["postdate"].",".$row["lastupdate"].",".$row["chaptername"].",".$row["chapterorder"].",".$row["size"].",".$row["summary"].")");

echo $row["articlename"];
	
	
	
}

 


 
?>