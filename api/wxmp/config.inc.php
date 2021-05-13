<?php

$apiOrder = 12;
$apiName = "wxmp";
$apiTitle = "微信公众号";
$apiConfigs[$apiName] = array();
$apiConfigs[$apiName]["appid"] = "wxf638bb5f80215d50";
$apiConfigs[$apiName]["appkey"] = "c0c1e35d949eb489eaade9317401a06f";
$apiConfigs[$apiName]["callback"] = JIEQI_LOCAL_URL . "/api/" . $apiName . "/loginback.php";
$apiConfigs[$apiName]["scope"] = "snsapi_base,snsapi_userinfo";
$apiConfigs[$apiName]["binduser"] = 0;
$apiConfigs[$apiName]["useunionid"] = 1;

?>
