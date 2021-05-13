<?php

define("JIEQI_MODULE_NAME", "system");
if (!isset($_REQUEST["act"]) && isset($_REQUEST["action"])) {
	$_REQUEST["act"] = $_REQUEST["action"];
}

if (isset($_REQUEST["act"]) && ($_REQUEST["act"] == "login")) {
	define("JIEQI_NEED_SESSION", 1);
}

require_once ("global.php");
if (isset($_REQUEST["act"]) && ($_REQUEST["act"] == "login")) {
	@session_regenerate_id();
}

jieqi_loadlang("users", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
if (isset($_REQUEST["act"]) && ($_REQUEST["act"] == "login")) {
	if ((strlen($_REQUEST["username"]) == 0) || (strlen($_REQUEST["password"]) == 0)) {
		jieqi_printfail($jieqiLang["system"]["need_userpass"]);
	}
	else {
		jieqi_useraction("login", $_REQUEST);
	  	$wgUser=1;
	  	
	}
}
else {
	if (!empty($_REQUEST["jumpurl"]) && preg_match("/^(\/\w+|" . preg_quote(JIEQI_LOCAL_URL, "/") . ")/i", $_REQUEST["jumpurl"])) {
		$jieqiTpl->assign("url_login", JIEQI_USER_URL . "/login.php?do=submit&jumpurl=" . urlencode($_REQUEST["jumpurl"]));
	}
	else {
		if (!empty($_REQUEST["forward"]) && preg_match("/^(\/\w+|" . preg_quote(JIEQI_LOCAL_URL, "/") . ")/i", $_REQUEST["forward"])) {
			$jieqiTpl->assign("url_login", JIEQI_USER_URL . "/login.php?do=submit&jumpurl=" . urlencode($_REQUEST["forward"]));
		}
		else {
			if (!empty($_SERVER["HTTP_REFERER"]) && preg_match("/^(\/\w+|" . preg_quote(JIEQI_LOCAL_URL, "/") . ")/i", $_SERVER["HTTP_REFERER"]) && !preg_match("/(login\.php|register\.php)/i", $_SERVER["HTTP_REFERER"])) {
				$jieqiTpl->assign("url_login", JIEQI_USER_URL . "/login.php?do=submit&jumpurl=" . urlencode($_SERVER["HTTP_REFERER"]));
			}
			else {
				$jieqiTpl->assign("url_login", JIEQI_USER_URL . "/login.php?do=submit");
			}
		}
	}

}

changyan_sso::getuserinfo();
class changyan_sso {
    public static function getuserinfo(){
        global $wgUser; 
        if($wgUser->getId()!=0){
            $ret=array(  
            "is_login"=>1, //已登录，返回登录的用户信息
            "user"=>array(
            "user_id"=>$wgUser->getId(),
            "nickname"=>$wgUser->getName(),
            "img_url"=>"",
            "profile_url"=>"",
            "sign"=>"**" //注意这里的sign签名验证已弃用，任意赋值即可
            ));
        

        }else{
            $ret=array("is_login"=>0);//未登录
        }
        
        echo $_GET['callback'].'('.json_encode($ret).')';
        
    }
}
	

?>
