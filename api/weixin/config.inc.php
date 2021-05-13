<?php

$apiOrder = 2;
$apiName = "weixin";
$apiTitle = "微信";
$apiConfigs[$apiName] = array();
$apiConfigs[$apiName]["appid"] = "wxce81fc6c51e8fa08";
$apiConfigs[$apiName]["appkey"] = "6d9bf402063040f43495ccfd087d4569";
$apiConfigs[$apiName]["callback"] = JIEQI_LOCAL_URL.'/api/'.$apiName.'/loginback.php';
$apiConfigs[$apiName]["scope"] = "snsapi_login,snsapi_base,snsapi_userinfo";
$apiConfigs[$apiName]["binduser"] = 0;
$apiConfigs[$apiName]["useunionid"] = 1;

?>
