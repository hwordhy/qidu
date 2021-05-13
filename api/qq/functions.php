<?php

function jieqi_api_userinfo($key = "")
{
	$uinfo = OpenSDK_Tencent_SNS2::call("user/get_user_info", array());
	$uinfo = jieqi_api_charsetconvert($uinfo);
	$ret = array();
	$ret["uname"] = $uinfo["nickname"];
	$ret["sex"] = ($uinfo["gender"] == "男" ? 1 : ($uinfo["gender"] == "女" ? 2 : 0));
	$ret["url_avatar"] = (!empty($uinfo["figureurl_2"]) ? $uinfo["figureurl_2"] : (!empty($uinfo["figureurl_qq_2"]) ? $uinfo["figureurl_qq_2"] : $uinfo["figureurl_qq_1"]));
	$ret["uname"] = jieqi_api_unamefilter($ret["uname"]);

	if (strlen($key) == 0) {
		return $ret;
	}
	else {
		return $ret[$key];
	}
}


?>
