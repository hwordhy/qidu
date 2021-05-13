<?php

$apiOrder = 5;
$apiName = "taobao";
$apiTitle = "淘宝";
$apiConfigs[$apiName] = array();
$apiConfigs[$apiName]["appid"] = "000";
$apiConfigs[$apiName]["appkey"] = "000000";
$apiConfigs[$apiName]["callback"] = JIEQI_LOCAL_URL . "/api/" . $apiName . "/loginback.php";
$apiConfigs[$apiName]["view"] = "web";
$apiConfigs[$apiName]["scope"] = "";
$apiConfigs[$apiName]["binduser"] = 0;

?>
