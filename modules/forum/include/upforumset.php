<?php

if (!defined("JIEQI_ROOT_PATH")) {
	exit();
}

if (!is_object($forums_handler)) {
	include_once jieqi_path_inc("class/forums.php", "forum");
	$forums_handler = JieqiForumsHandler::getInstance("JieqiForumsHandler");
}

$criteria = new CriteriaCompo();
$criteria->setSort("forumorder");
$criteria->setOrder("ASC");
$jieqiForumForums = array();
$forums_handler->queryObjects($criteria);

while ($v = $forums_handler->getObject()) {
	$jieqiForumForums[] = array("forumid" => $v->getVar("forumid"), "catid" => $v->getVar("catid"), "forumname" => $v->getVar("forumname"), "forumorder" => $v->getVar("forumorder"));
}

jieqi_setconfigs("forumsset", "jieqiForumForums", $jieqiForumForums, "forum");

?>
