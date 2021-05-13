<?php

function jieqi_sendmessage($uid, $uname, $title, $msg)
{
	include_once jieqi_path_inc("class/message.php", "system");
	$message_handler = &JieqiMessageHandler::getInstance("JieqiMessageHandler");
	$newMessage = $message_handler->create();
	$newMessage->setVar("siteid", JIEQI_SITE_ID);
	$newMessage->setVar("postdate", JIEQI_NOW_TIME);
	$newMessage->setVar("fromid", 0);
	$newMessage->setVar("fromname", $_SESSION["jieqiUserName"]);
	$newMessage->setVar("toid", $uid);
	$newMessage->setVar("toname", $uname);
	$newMessage->setVar("title", $title);
	$newMessage->setVar("content", $msg);
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
		return true;
	}
	else {
		return false;
	}
}


?>
