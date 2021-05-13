<?php

define('JIEQI_MODULE_NAME', 'system');
define('JIEQI_NEED_SESSION', 1);
require_once '../../global.php';
include_once './config.inc.php';
include_once './lang_api.php';


$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$apiConfigs[$apiName]['appid']."&redirect_uri=".$apiConfigs[$apiName]['callback']."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
echo "<script>window.location.href='".$url."';</script>";
exit;

?>
