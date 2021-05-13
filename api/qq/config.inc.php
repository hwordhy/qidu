<?php

$apiOrder = 1;
$apiName = "qq";
$apiTitle = "QQ";
$apiConfigs[$apiName] = array();
$apiConfigs[$apiName]["appid"] = "101674709";
$apiConfigs[$apiName]["appkey"] = "d4f53b1b3c4e7d52fb1b82d82568a880";


$from = $_SERVER['HTTP_HOST'] === 'm.novelrd.cn' ? 1 : 2;
  
$apiConfigs[$apiName]["callback"] = "http://www.novelrd.cn/api/qq/loginback.php?from=" . $from;
$apiConfigs[$apiName]["ismobile"] = 0;
$apiConfigs[$apiName]["scope"] = "get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo";
$apiConfigs[$apiName]["binduser"] = 1;

?>
