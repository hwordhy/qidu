<?php
$appid          = "wxf638bb5f80215d50";
$redirect_uri   = urlencode("http://m.novelrd.cn/weixin/wxlogin/callback.php");
$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
header('location:'.$url);