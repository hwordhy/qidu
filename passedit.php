<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("global.php");
jieqi_checklogin();
jieqi_loadlang("users", JIEQI_MODULE_NAME);
include_once jieqi_path_inc("class/users.php", "system");
$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
$jieqiUsers = $users_handler->get($_SESSION["jieqiUserId"]);

if (!$jieqiUsers) {
	jieqi_printfail(LANG_NO_USER);
}

if (!isset($_POST["act"])) {
	$_POST["act"] = "edit";
}

switch ($_POST["act"]) {
case "update":
	jieqi_checkpost();
	$_REQUEST["uid"] = $_SESSION["jieqiUserId"];
	$_REQUEST["jumpurl"] = JIEQI_URL . "/userdetail.php";
	$_REQUEST["lang_failure"] = $jieqiLang["system"]["pass_edit_failure"];
	$_REQUEST["lang_success"] = $jieqiLang["system"]["pass_edit_success"];
	jieqi_useraction("edit", $_REQUEST);
	break;

case "edit":
default:
	include_once jieqi_path_common("header.php");
	$jieqiTpl->assign("url_passedit", JIEQI_USER_URL . "/passedit.php?do=submit");
	$emptypass = (strlen($_SESSION["jieqiUserPass"]) == 0 ? 1 : 0);
	$jieqiTpl->assign("emptypass", $emptypass);
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("passedit.html", JIEQI_MODULE_NAME);
	include_once jieqi_path_common("footer.php");
	break;
}

?>
