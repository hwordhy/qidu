<?php
$appid          = "wxce81fc6c51e8fa08";
$redirect_uri   = urlencode("http://www.novelrd.cn/weixin/wxlogin/callback.php");

        //1、获取code
$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
header('location:'.$url);