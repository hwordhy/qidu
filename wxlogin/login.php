<?php
$redirect_uri = urlencode('http://www.novelrd.cn/wxlogin/callback.php');
$url="https://open.weixin.qq.com/connect/qrconnect?appid=wxce81fc6c51e8fa08&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_login&state=".time()."#wechat_redirect";
header("Location:$url");