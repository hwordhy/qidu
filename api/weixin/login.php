<?php

define("JIEQI_MODULE_NAME", "system");
define("JIEQI_NEED_SESSION", 1);
require_once ("../../global.php");
include_once jieqi_path_lib("OpenSDK/Tencent/Weixin.php");
include_once ("./config.inc.php");
include_once ("./functions.php");
include_once ("../include/lang_userapi.php");
include_once ("../include/funuserapi.php");


if (mb_substr($apiConfigs[$apiName]["callback"], 0, 2) == '//') {
	$apiConfigs[$apiName]["callback"] = 'http:' . $apiConfigs[$apiName]["callback"];
}

jieqi_api_logininit();
OpenSDK_Tencent_Weixin::init($apiConfigs[$apiName]["appid"], $apiConfigs[$apiName]["appkey"]);
$url = OpenSDK_Tencent_Weixin::getAuthorizeURL($apiConfigs[$apiName]["callback"], "code", $_SESSION["jieqiUserApi"][$apiName]["state"], $apiConfigs[$apiName]["scope"]);
header("Location: " . jieqi_headstr($url));

?>