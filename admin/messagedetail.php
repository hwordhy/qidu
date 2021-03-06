<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("../global.php");
include_once jieqi_path_inc("class/power.php", "system");
$power_handler = &JieqiPowerHandler::getInstance("JieqiPowerHandler");
$power_handler->getSavedVars("system");
jieqi_checkpower($jieqiPower["system"]["adminmessage"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("message", JIEQI_MODULE_NAME);
if (empty($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) {
	jieqi_printfail($jieqiLang["system"]["message_no_exists"]);
}

$_REQUEST["id"] = intval($_REQUEST["id"]);
include_once jieqi_path_inc("class/message.php", "system");
$message_handler = JieqiMessageHandler::getInstance("JieqiMessageHandler");
$message = $message_handler->get($_REQUEST["id"]);

if (!$message) {
	jieqi_printfail($jieqiLang["system"]["message_no_exists"]);
}

if (($message->getVar("fromid") != 0) && ($message->getVar("toid") != 0)) {
	jieqi_printfail($jieqiLang["system"]["message_no_exists"]);
}

include_once jieqi_path_common("admin/header.php");
$jieqiTpl->assign("id", $_REQUEST["id"]);
$messagevals = jieqi_query_rowvars($message);
$messagevals["content"] = jieqi_htmlclickable($messagevals["content"]);
$jieqiTpl->assign_by_ref("messagevals", $messagevals);
if (($message->getVar("toid") == 0) || ($message->getVar("toid") == $_SESSION["jieqiUserId"])) {
	$jieqiTpl->assign("box", "inbox");
}
else {
	$jieqiTpl->assign("box", "outbox");
}

$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/messagedetail.html", "system");
if (($message->getVar("isread") != 1) && (($message->getVar("toid") == 0) || ($message->getVar("toid") == $_SESSION["jieqiUserId"]))) {
	$message->setVar("isread", "1");
	$message_handler->insert($message);
}

include_once jieqi_path_common("admin/footer.php");

?>
