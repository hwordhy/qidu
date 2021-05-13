<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("../global.php");
include_once jieqi_path_inc("class/power.php", "system");
$power_handler = &JieqiPowerHandler::getInstance("JieqiPowerHandler");
$power_handler->getSavedVars("system");
jieqi_checkpower($jieqiPower["system"]["adminmessage"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("message", JIEQI_MODULE_NAME);

if (!isset($_POST["act"])) {
	$_POST["act"] = "input";
}

switch ($_POST["act"]) {
case "add":
	jieqi_checkpost();
	$_REQUEST["receiver"] = trim($_REQUEST["receiver"]);
	$_REQUEST["title"] = trim($_REQUEST["title"]);
	$errtext = "";

	if (strlen($_REQUEST["receiver"]) == 0) {
		$errtext .= $jieqiLang["system"]["message_need_receiver"] . "<br />";
	}

	if (strlen($_REQUEST["title"]) == 0) {
		$errtext .= $jieqiLang["system"]["message_need_title"] . "<br />";
	}

	if (empty($errtext)) {
		include_once jieqi_path_inc("class/users.php", "system");
		$users_handler = JieqiUsersHandler::getInstance("JieqiUsersHandler");
		$touser = $users_handler->getByname($_REQUEST["receiver"], 3);

		if (!$touser) {
			jieqi_printfail($jieqiLang["system"]["message_no_receiver"]);
		}

		include_once jieqi_path_inc("class/message.php", "system");
		$message_handler = &JieqiMessageHandler::getInstance("JieqiMessageHandler");
		$newMessage = $message_handler->create();
		$newMessage->setVar("siteid", JIEQI_SITE_ID);
		$newMessage->setVar("postdate", JIEQI_NOW_TIME);
		$newMessage->setVar("fromid", 0);
		$newMessage->setVar("fromname", $_SESSION["jieqiUserName"]);
		$newMessage->setVar("toid", $touser->getVar("uid", "n"));

		if (0 < strlen($touser->getVar("name", "n"))) {
			$newMessage->setVar("toname", $touser->getVar("name", "n"));
		}
		else {
			$newMessage->setVar("toname", $touser->getVar("uname", "n"));
		}

		$newMessage->setVar("title", $_REQUEST["title"]);
		$newMessage->setVar("content", $_REQUEST["content"]);
		$newMessage->setVar("messagetype", 0);
		$newMessage->setVar("isread", 0);
		$newMessage->setVar("fromdel", 0);
		$newMessage->setVar("todel", 0);
		$newMessage->setVar("enablebbcode", 1);
		$newMessage->setVar("enablehtml", 0);
		$newMessage->setVar("enablesmilies", 1);
		$newMessage->setVar("attachsig", 0);
		$newMessage->setVar("attachment", 0);

		if (!$message_handler->insert($newMessage)) {
			jieqi_printfail($jieqiLang["system"]["message_send_failure"]);
		}
		else if (!empty($_REQUEST["ajax_request"])) {
			jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang["system"]["message_send_seccess"]);
		}
		else {
			jieqi_jumppage(JIEQI_URL . "/admin/message.php?box=inbox", LANG_DO_SUCCESS, $jieqiLang["system"]["message_send_seccess"]);
		}
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case "input":
default:
	include_once jieqi_path_common("admin/header.php");
	$message = false;
	if (!empty($_REQUEST["reid"]) || !empty($_REQUEST["fwid"])) {
		include_once jieqi_path_inc("class/message.php", "system");
		$message_handler = JieqiMessageHandler::getInstance("JieqiMessageHandler");

		if (!empty($_REQUEST["reid"])) {
			$message = $message_handler->get($_REQUEST["reid"]);
		}
		else if (!empty($_REQUEST["fwid"])) {
			$message = $message_handler->get($_REQUEST["fwid"]);
		}
	}

	if (is_object($message)) {
		$_REQUEST["receiver"] = $message->getVar("fromname", "e");
		$_REQUEST["title"] = $message->getVar("title", "e");

		if (!empty($_REQUEST["reid"])) {
			$_REQUEST["title"] = "Re:" . $_REQUEST["title"];
			$_REQUEST["content"] = "";
		}
		else if (!empty($_REQUEST["fwid"])) {
			$_REQUEST["title"] = "Fw:" . $_REQUEST["title"];
			$_REQUEST["content"] = $message->getVar("content", "e");
		}
	}

	if (!isset($_REQUEST["receiver"])) {
		$_REQUEST["receiver"] = "";
	}

	if (!isset($_REQUEST["title"])) {
		$_REQUEST["title"] = "";
	}

	if (!isset($_REQUEST["content"])) {
		$_REQUEST["content"] = "";
	}

	$jieqiTpl->assign("url_newmessage", JIEQI_URL . "/admin/newmessage.php");
	$jieqiTpl->assign("receiver", $_REQUEST["receiver"]);
	$jieqiTpl->assign("title", $_REQUEST["title"]);
	$jieqiTpl->assign("content", $_REQUEST["content"]);
	$jieqiTpl->assign("action", "newmessage");
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/newmessage.html", "system");
	include_once jieqi_path_common("admin/footer.php");
	break;
}

?>
