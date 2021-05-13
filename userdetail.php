<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("global.php");
jieqi_checklogin();
include_once jieqi_path_inc("class/users.php", "system");
$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
$jieqiUsers = $users_handler->get($_SESSION["jieqiUserId"]);

if (!$jieqiUsers) {
	jieqi_printfail(LANG_NO_USER);
}

jieqi_getconfigs("system", "honors");
include_once jieqi_path_common("header.php");
include_once jieqi_path_inc("include/funusers.php", JIEQI_MODULE_NAME);
$uservals = jieqi_system_usersvars($jieqiUsers);
$usermoney = $jieqiUsers->getEmoney();
$uservals["egold"] = $usermoney["egold"];
$uservals["esilver"] = $usermoney["esilver"];
$jieqiTpl->assign_by_ref("uservals", $uservals);

foreach ($uservals as $k => $v ) {
	$jieqiTpl->assign_by_ref($k, $uservals[$k]);
}

$jieqiTpl->assign_by_ref("gift", $uservals["setting"]["gift"]);

if (!empty($_REQUEST["sendemail"])) {
	$jieqiTpl->assign("sendemail", 1);
}
else {
	$jieqiTpl->assign("sendemail", 0);
}

if (!empty($_REQUEST["refresh"])) {
	$jieqiTpl->assign("refresh", 1);
}
else {
	$jieqiTpl->assign("refresh", 0);
}

$email_link = "";
$tmpvar = explode("@", $jieqiUsers->getVar("email", "n"));

if (isset($tmpvar[1])) {
	$email_link = "http://mail." . $tmpvar[1];
}

$jieqiTpl->assign("email_link", $email_link);
include_once jieqi_path_inc("class/message.php", JIEQI_MODULE_NAME);
$message_handler = JieqiMessageHandler::getInstance("JieqiMessageHandler");
$criteria = new CriteriaCompo(new Criteria("toid", $jieqiUsers->getVar("uid"), "="));
$criteria->add(new Criteria("isread", 0, "="));
$criteria->add(new Criteria("todel", 0, "="));
$newmsgnum = $message_handler->getCount($criteria);
unset($criteria);
$jieqiTpl->assign("newmessage", $newmsgnum);
$_SESSION["jieqiNewMessage"] = $newmsgnum;
include_once jieqi_path_inc("class/bookcase.php", "article");
$bookcase_handler = &JieqiBookcaseHandler::getInstance("JieqiBookcaseHandler");
$criteria = new CriteriaCompo(new Criteria("userid", $jieqiUsers->getVar("uid"), "="));
$nowbookcase = $bookcase_handler->getCount($criteria);
unset($criteria);
$jieqiTpl->assign("nowbookcase", $nowbookcase);
$historynums = isset($_COOKIE["jieqiHistoryBooks"]) ? count(object_array(json_decode(stripslashes($_COOKIE["jieqiHistoryBooks"])))) : 0;
$jieqiTpl->assign("historynums", $historynums);
$right = array();
jieqi_getconfigs("system", "configs");
jieqi_getconfigs("system", "right");

foreach ($jieqiModules as $k => $v ) {
	if ($v["publish"] && is_dir(JIEQI_ROOT_PATH . "/modules/" . $k)) {
		@jieqi_getconfigs($k, "configs");
		@jieqi_getconfigs($k, "right");
	}
}

$honorid = jieqi_gethonorid($jieqiUsers->getVar("score"), $jieqiHonors);

foreach ($jieqiRight as $mod => $t ) {
	foreach ($t as $r => $v ) {
		$tmpvar = 0;

		if (isset($jieqiConfigs[$mod][$r])) {
			$tmpvar = $jieqiConfigs[$mod][$r];
		}

		if ($honorid && isset($jieqiRight[$mod][$r]["honors"][$honorid]) && is_numeric($jieqiRight[$mod][$r]["honors"][$honorid])) {
			$tmpvar = intval($jieqiRight[$mod][$r]["honors"][$honorid]);
		}

		$right[$mod][$r] = $tmpvar;
		$jieqiTpl->assign($mod . "_" . $r, $tmpvar);
	}
}

$jieqiTpl->assign_by_ref("right", $right);
if (!empty($_SESSION["jieqiUserId"]) && ($jieqiUsers->getVar("uid", "n") == $_SESSION["jieqiUserId"])) {
	$jieqiUsers->saveToSession();
}

if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
	unset($uservals["pass"]);
    $uservals["lastlogin"] = date('Y-m-d H:i:s', $uservals["lastlogin"]);
    $uservals["regdate"] = date('Y-m-d H:i:s', $uservals["regdate"]);
    echo json_encode(array("success" => true, "data" => $uservals, "message" => '获取成功'));
    return false;

}

$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("userdetail.html", JIEQI_MODULE_NAME);
include_once jieqi_path_common("footer.php");

?>
