<?php

function jieqi_logincheck($username = "", $password = "", $checkcode = "", $usecookie = 0, $encode = 0, $uidtype = 0)
{
	global $users_handler;

	if ($uidtype == -1) {
		$uidtype = 0;

		if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+([\.][a-z0-9-]+)+$/i", $username)) {
			$uidtype = 2;
		}
		else if (2.3 <= floatval(JIEQI_VERSION)) {
			if (preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $username)) {
				$uidtype = 3;
			}
		}
		else if (is_numeric($username)) {
			$uidtype = 1;
		}
	}

	if (!in_array($uidtype, array(0, 1, 2, 3))) {
		$uidtype = 0;
	}

	$ret = jieqi_loginpass($username, $password, $checkcode, $usecookie, $encode, $uidtype);
	if (is_object($ret)) {
		return jieqi_loginprocess($ret, $usecookie);
	}
	else if ($ret == -10) {
		if (!in_array($uidtype, array(0, 1, 2))) {
			$uidtype = 0;
		}

		if (defined("JIEQI_USER_INTERFACE") && preg_match("/^\w+$/is", JIEQI_USER_INTERFACE)) {
			include_once jieqi_path_inc("include/funuser_" . JIEQI_USER_INTERFACE . ".php", "system");
		}
		else {
			include_once jieqi_path_inc("include/funuser.php", "system");
		}

		if (function_exists("uc_user_login")) {
			$isuid = ($uidtype == 1 ? 1 : 0);
			list($uid, $uname, $upass, $uemail) = uc_user_login($username, $password, $isuid);

			if (0 < $uid) {
				if (!is_a($users_handler, "JieqiUsersHandler")) {
					include_once jieqi_path_inc("class/users.php", "system");
					$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
				}

				switch ($uidtype) {
				case 1:
					$criteria = new CriteriaCompo(new Criteria("uid", intval($username)));
					break;

				case 2:
					$criteria = new CriteriaCompo(new Criteria("email", $username));
					break;

				case 3:
					$criteria = new CriteriaCompo(new Criteria("mobile", intval($username)));
					break;

				case 0:
				default:
					$criteria = new CriteriaCompo(new Criteria("uname", $username));
					break;
				}

				$criteria->setLimit(1);
				$users_handler->queryObjects($criteria);
				$userobj = $users_handler->getObject();

				if (is_object($userobj)) {
					$salt = $userobj->getVar("salt", "n");
					$userobj->setVar("pass", $users_handler->encryptPass($upass, $salt));
					$userobj->setVar("email", $uemail);
					$users_handler->insert($userobj);
					return jieqi_loginprocess($userobj, $usecookie);
				}
			}
		}

		return -5;
	}
	else {
		return $ret;
	}
}

function jieqi_loginpass($username = "", $password = "", $checkcode = "", $usecookie = 0, $encode = 0, $uidtype = 0)
{
	global $jieqiConfigs;
	global $jieqiHonors;
	global $jieqiGroups;
	global $users_handler;

	if (empty($username) || empty($password)) {
		return -3;
	}

	if (!isset($jieqiConfigs["system"])) {
		jieqi_getconfigs("system", "configs");
	}

	if (!defined("JIEQI_NO_CHECKCODE") && defined("JIEQI_LOGIN_CHECKCODE") && (0 < JIEQI_LOGIN_CHECKCODE) && ($checkcode !== false)) {
		if (empty($checkcode) || empty($_SESSION["jieqiCheckCode"]) || (strtolower($checkcode) != strtolower($_SESSION["jieqiCheckCode"]))) {
			return -7;
		}
	}

	if (!is_a($users_handler, "JieqiUsersHandler")) {
		include_once jieqi_path_inc("class/users.php", "system");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
	}

	switch ($uidtype) {
	case 1:
		$criteria = new CriteriaCompo(new Criteria("uid", intval($username)));
		break;

	case 2:
		$criteria = new CriteriaCompo(new Criteria("email", $username));
		break;

	case 3:
		$criteria = new CriteriaCompo(new Criteria("mobile", $username));
		break;

	case 0:
	default:
		$criteria = new CriteriaCompo(new Criteria("uname", $username));
		break;
	}
	// var_dump($criteria = new CriteriaCompo(new Criteria("mobile", $username)));die();
	$criteria->setLimit(1);
	$users_handler->queryObjects($criteria);
	// var_dump($users_handler->queryObjects($criteria)->fetch_all());die();
	$jieqiUsers = $users_handler->getObject();
	if (!$jieqiUsers) {
		return -4;
	}

	$truepass = $jieqiUsers->getVar("pass", "n");

	if ($truepass == "") {
		return -10;
	}

	$passcheck = false;
	$salt = $jieqiUsers->getVar("salt", "n");

	switch ($encode) {
	case 1:
		if ($truepass == $password) {
			$passcheck = true;
		}

		break;

	case 2:
		if ($users_handler->encryptPass($truepass, $salt) == $password) {
			$passcheck = true;
		}

		break;

	case 3:
		if (substr($truepass, 0, 16) == substr($password, 0, 16)) {
			$passcheck = true;
		}

		break;

	case 0:
	default:
		if ($truepass == $users_handler->encryptPass($password, $salt)) {
			$passcheck = true;
		}

		break;
	}

	if (!$passcheck) {
		return -5;
	}

	if ($jieqiUsers->getVar("groupid", "n") == JIEQI_GROUP_GUEST) {
		return -9;
	}

	return $jieqiUsers;
}

function jieqi_loginprocess($jieqiUsers, $usecookie = 0)
{
	global $jieqiConfigs;
	global $jieqiHonors;
	global $jieqiGroups;
	global $users_handler;
	global $jieqiAction;
	
	if (!isset($jieqiConfigs["system"])) {
		jieqi_getconfigs("system", "configs");
	}

	if (!is_a($users_handler, "JieqiUsersHandler")) {
		include_once jieqi_path_inc("class/users.php", "system");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
	}
	
	include_once jieqi_path_inc("class/online.php", "system");
	$online_handler = &JieqiOnlineHandler::getInstance("JieqiOnlineHandler");

	if (!$jieqiUsers->isNew()) {
		$criteria = new CriteriaCompo(new Criteria("uid", $jieqiUsers->getVar("uid", "n")));
		$criteria->setSort("updatetime");
		$criteria->setOrder("DESC");
		$online_handler->queryObjects($criteria);
		$online = $online_handler->getObject();
		// var_dump($online_handler->queryObjects($criteria));die();
	}
	else {
		$online = false;
	}

	$jieqi_user_info = array();

	if (!empty($_COOKIE["jieqiUserInfo"])) {
		$jieqi_user_info = jieqi_strtosary($_COOKIE["jieqiUserInfo"]);
	}
	else {
		$jieqi_user_info = array();
	}

	$jieqi_visit_info = array();

	if (!empty($_COOKIE["jieqiVisitInfo"])) {
		$jieqi_visit_info = jieqi_strtosary($_COOKIE["jieqiVisitInfo"]);
	}
	else {
		$jieqi_visit_info = array();
	}

	if (is_object($online)) {
		
		$ip = jieqi_userip();

		if (0 < JIEQI_SESSION_EXPRIE) {
			$exprie_time = JIEQI_SESSION_EXPRIE;
		}
		else {
			$exprie_time = @ini_get("session.gc_maxlifetime");
		}

		if (empty($exprie_time)) {
			$exprie_time = 1800;
		}

		if (defined("JIEQI_DENY_RELOGIN") && (JIEQI_DENY_RELOGIN == 1) && ((JIEQI_NOW_TIME - $online->getVar("updatetime")) < $exprie_time) && ($online->getVar("ip", "n") != $ip) && ($jieqi_visit_info["jieqiUserId"] != $jieqiUsers->getVar("uid"))) {
			return -8;
		}

		$tmpvar = (0 < strlen($jieqiUsers->getVar("name", "q")) ? $jieqiUsers->getVar("name", "q") : $jieqiUsers->getVar("uname", "q"));
		$sql = "UPDATE " . jieqi_dbprefix("system_online") . " SET uid=" . $jieqiUsers->getVar("uid", "q") . ", sid='" . jieqi_dbslashes(session_id()) . "', uname='" . $jieqiUsers->getVar("uname", "q") . "', name='" . $tmpvar . "', pass='" . $jieqiUsers->getVar("pass", "q") . "',email='" . $jieqiUsers->getVar("email", "q") . "', groupid=" . $jieqiUsers->getVar("groupid", "q") . ", updatetime=" . JIEQI_NOW_TIME . ", ip='" . jieqi_dbslashes($ip) . "' WHERE uid=" . $jieqiUsers->getVar("uid", "q") . " OR sid='" . jieqi_dbslashes(session_id()) . "'";
		
		var_dump($online_handler->execute($sql));die();
		$online_handler->execute($sql);
	
	}
	else {
		include_once jieqi_path_inc("include/visitorinfo.php", "system");
		$online = $online_handler->create();
		$online->setVar("uid", $jieqiUsers->getVar("uid", "n"));
		$online->setVar("siteid", JIEQI_SITE_ID);
		$online->setVar("sid", session_id());
		$online->setVar("uname", $jieqiUsers->getVar("uname", "n"));
		$tmpvar = (0 < strlen($jieqiUsers->getVar("name", "n")) ? $jieqiUsers->getVar("name", "n") : $jieqiUsers->getVar("uname", "n"));
		$online->setVar("name", $tmpvar);
		$online->setVar("pass", $jieqiUsers->getVar("pass", "n"));
		$online->setVar("email", $jieqiUsers->getVar("email", "n"));
		$online->setVar("groupid", $jieqiUsers->getVar("groupid", "n"));
		$tmpvar = JIEQI_NOW_TIME;
		$online->setVar("logintime", $tmpvar);
		$online->setVar("updatetime", $tmpvar);
		$online->setVar("operate", "");
		$tmpvar = VisitorInfo::getIp();
		$online->setVar("ip", $tmpvar);
		$online->setVar("browser", VisitorInfo::getBrowser());
		$online->setVar("os", VisitorInfo::getOS());
		$location = VisitorInfo::getIpLocation($tmpvar);

		if (JIEQI_SYSTEM_CHARSET == "big5") {
			include_once jieqi_path_inc("include/changecode.php", "system");
			$location = jieqi_gb2big5($location);
		}

		$online->setVar("location", $location);
		$online->setVar("state", "0");
		$online->setVar("flag", "0");
		$online_handler->insert($online);
	}

	unset($criteria);
	$criteria = new CriteriaCompo(new Criteria("updatetime", JIEQI_NOW_TIME - $jieqiConfigs["system"]["onlinetime"], "<"));
	$online_handler->delete($criteria);
	$newmsgnum = 0;

	if (!$jieqiUsers->isNew()) {
		
		include_once jieqi_path_inc("class/message.php", "system");
		$message_handler = JieqiMessageHandler::getInstance("JieqiMessageHandler");
		$criteria = new CriteriaCompo(new Criteria("toid", $jieqiUsers->getVar("uid"), "="));
		$criteria->add(new Criteria("isread", 0, "="));
		$criteria->add(new Criteria("todel", 0, "="));
		$newmsgnum = $message_handler->getCount($criteria);
		unset($criteria);
		$lastlogin = intval($jieqiUsers->getVar("lastlogin"));
		$jieqiUsers->setVar("lastlogin", JIEQI_NOW_TIME);
		$userset = jieqi_unserialize($jieqiUsers->getVar("setting", "n"));
		if (!isset($userset["lastip"]) || ($userset["lastip"] != jieqi_userip())) {
			$userset["lastip"] = jieqi_userip();
		}

		$userset["loginsid"] = session_id();
		if (!isset($userset["logindate"]) || ($userset["logindate"] != date("Y-m-d"))) {
			$userset["logindate"] = date("Y-m-d");
			jieqi_getconfigs("system", "action", "jieqiAction");
			$action_earnscore = intval($jieqiAction["system"]["login"]["earnscore"]);
			$jieqiUsers->setVar("experience", $jieqiUsers->getVar("experience") + $action_earnscore);
			$jieqiUsers->setVar("score", $jieqiUsers->getVar("score") + $action_earnscore);
		}

		$countpayout = (isset($userset["countpayout"]) ? intval($userset["countpayout"]) : 0);
		$expenses = intval($jieqiUsers->getVar("expenses"));
		if (($countpayout < $expenses) && !empty($jieqiConfigs["system"]["outaddvipvote"])) {
			$vipvoteadd = floor(($expenses - $countpayout) / intval($jieqiConfigs["system"]["outaddvipvote"]));
			$userset["gift"]["vipvote"] = (isset($userset["gift"]["vipvote"]) ? intval($userset["gift"]["vipvote"]) + $vipvoteadd : $vipvoteadd);
			$userset["countpayout"] = $countpayout + ($vipvoteadd * intval($jieqiConfigs["system"]["outaddvipvote"]));
		}

		if (intval(date("Ym", $lastlogin)) < intval(date("Ym", JIEQI_NOW_TIME))) {
			$jieqiUsers->setVar("monthscore", 0);

			if (isset($userset["gift"]["vipvote"])) {
				$userset["gift"]["vipvote"] = 0;
			}
		}

		if ((0 < $jieqiUsers->getVar("overtime", "n")) && (intval($jieqiUsers->getVar("overtime", "n")) < JIEQI_NOW_TIME) && !empty($userset["pregroupid"])) {
			$jieqiUsers->setVar("groupid", intval($userset["pregroupid"]));
			unset($userset["pregroupid"]);
		}

		$jieqiUsers->setVar("setting", serialize($userset));
		$jieqiUsers->unsetNew();
		$users_handler->insert($jieqiUsers);
	}

	header("P3P: CP=\"CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR\"");
	jieqi_setusersession($jieqiUsers);

	if (0 < $newmsgnum) {
		$_SESSION["jieqiNewMessage"] = $newmsgnum;
	}

	$jieqi_online_info = (empty($_COOKIE["jieqiOnlineInfo"]) ? array() : jieqi_strtosary($_COOKIE["jieqiOnlineInfo"]));
	if (isset($jieqi_online_info["jieqiAdminLogin"]) && ($jieqi_online_info["jieqiAdminLogin"] == 1)) {
		$_SESSION["jieqiAdminLogin"] = 1;
	}

	$jieqi_user_info["jieqiUserId"] = $_SESSION["jieqiUserId"];
	$jieqi_user_info["jieqiUserUname"] = $_SESSION["jieqiUserUname"];
	$jieqi_user_info["jieqiUserName"] = $_SESSION["jieqiUserName"];
	$jieqi_user_info["jieqiUserGroup"] = $_SESSION["jieqiUserGroup"];
	$jieqi_user_info["jieqiUserGroupName"] = $jieqiGroups[$_SESSION["jieqiUserGroup"]];
	$jieqi_user_info["jieqiUserVip"] = $_SESSION["jieqiUserVip"];
	$jieqi_user_info["jieqiUserHonorId"] = $_SESSION["jieqiUserHonorId"];
	$jieqi_user_info["jieqiUserHonor"] = $_SESSION["jieqiUserHonor"];
	$jieqi_user_info["jieqiUserToken"] = $_SESSION["jieqiUserToken"];
	$jieqi_user_info["jieqiCodeLogin"] = (defined("JIEQI_LOGIN_CHECKCODE") && !defined("JIEQI_NO_CHECKCODE") ? JIEQI_LOGIN_CHECKCODE : 0);
	$jieqi_user_info["jieqiCodePost"] = intval($jieqiConfigs["system"]["postcheckcode"]);

	if (0 < $newmsgnum) {
		$jieqi_user_info["jieqiNewMessage"] = $newmsgnum;
	}

	if ($usecookie) {
		$jieqi_user_info["jieqiUserPassword"] = $jieqiUsers->getVar("pass", "n");
	}

	include_once jieqi_path_inc("include/changecode.php", "system");

	if (JIEQI_SYSTEM_CHARSET == "gbk") {
		$jieqi_user_info["jieqiUserUname"] = jieqi_gb2unicode($_SESSION["jieqiUserUname"]);
		$jieqi_user_info["jieqiUserName"] = jieqi_gb2unicode($_SESSION["jieqiUserName"]);
		$jieqi_user_info["jieqiUserHonor"] = jieqi_gb2unicode($_SESSION["jieqiUserHonor"]);
		$jieqi_user_info["jieqiUserGroupName"] = jieqi_gb2unicode($jieqiGroups[$_SESSION["jieqiUserGroup"]]);
	}
	else if (JIEQI_SYSTEM_CHARSET == "big5") {
		$jieqi_user_info["jieqiUserUname"] = jieqi_big52unicode($_SESSION["jieqiUserUname"]);
		$jieqi_user_info["jieqiUserName"] = jieqi_big52unicode($_SESSION["jieqiUserName"]);
		$jieqi_user_info["jieqiUserHonor"] = jieqi_big52unicode($_SESSION["jieqiUserHonor"]);
		$jieqi_user_info["jieqiUserGroupName"] = jieqi_big52unicode($jieqiGroups[$_SESSION["jieqiUserGroup"]]);
	}

	$jieqi_user_info["jieqiUserLogin"] = JIEQI_NOW_TIME;

	if ($usecookie < 0) {
		$usecookie = 0;
	}
	else if ($usecookie == 1) {
		$usecookie = 315360000;
	}

	if ($usecookie) {
		$cookietime = JIEQI_NOW_TIME + $usecookie;
	}
	else {
		$cookietime = 0;
	}

	@setcookie("jieqiUserInfo", jieqi_sarytostr($jieqi_user_info), $cookietime, "/", JIEQI_COOKIE_DOMAIN, 0);
	$jieqi_visit_info["jieqiUserLogin"] = $jieqi_user_info["jieqiUserLogin"];
	$jieqi_visit_info["jieqiUserId"] = $jieqi_user_info["jieqiUserId"];
	@setcookie("jieqiVisitInfo", jieqi_sarytostr($jieqi_visit_info), JIEQI_NOW_TIME + 99999999, "/", JIEQI_COOKIE_DOMAIN, 0);
	return 0;
}


?>
