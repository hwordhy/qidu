<?php
header('Content-type: text/html; charset=utf-8');
include 'configs/define.php';
$keyword = $_GET['name'];
$con = mysql_connect(JIEQI_DB_HOST,JIEQI_DB_USER,JIEQI_DB_PASS) or die ("数据库连接失败");
mysql_select_db(JIEQI_DB_NAME, $con);
$sql="SELECT * FROM jieqi_article_article WHERE articlename like '%{$keyword}%'";
$rs=mysql_query($sql);
if(mysql_num_rows($rs) > 0){
    while ($row=mysql_fetch_assoc($rs)){
     		echo "<?xml version='1.0' encoding='UTF-8' standalone='yes' ?>";
     		echo '<msg serviceID="33" templateID="1" action="plugin" brief="系统信息" sourceMsgId="0" url="" flag="0" sType="0" adverSign="0" multiMsgFlag="0">';
     		echo '<item layout="5"><picture cover="http://t.cn/RV0lc64 " w="0" h="0" /></item>';
     		echo '<item layout="0"><hr hidden="false" style="0" />';
     		echo '<title size="22" color="#A23400">友情提示：未成年请在父母陪同下观看</title>';
     		echo '</item><item layout="0"><hr hidden="false" style="0" /></item>';



        if($row['articleid'] < 1000){
            $img = 0;
        }else{
            $rest = substr($row['articleid'],1);
            $img = rest;
            
        }
    }
}else{
    echo "抱歉您要找的小说暂时没有哟";
}


?>