<?php

$apiOrder = 4;
$apiName = "weibo";
$apiTitle = "新浪微博";
$apiConfigs[$apiName] = array();
$apiConfigs[$apiName]["appid"] = "3338615305";
$apiConfigs[$apiName]["appkey"] = "69161ce0ebd0ea78f163f3193b2de077";
$apiConfigs[$apiName]["callback"] = JIEQI_LOCAL_URL . "/api/" . $apiName . "/loginback.php";
$apiConfigs[$apiName]["display"] = "default";
$apiConfigs[$apiName]["scope"] = "";
$apiConfigs[$apiName]["binduser"] = 0;

?>
