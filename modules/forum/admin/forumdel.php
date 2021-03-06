<?php

define("JIEQI_MODULE_NAME", "forum");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["forum"]["manageforum"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);

if (empty($_REQUEST["id"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

if (empty($_POST["act"]) || ($_POST["act"] != "delete")) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}
else {
	jieqi_checkpost();
}

jieqi_loadlang("manage", JIEQI_MODULE_NAME);

switch ($_REQUEST["type"]) {
case "forum":
	include_once jieqi_path_inc("class/forums.php", "forum");
	$forums_handler = JieqiForumsHandler::getInstance("JieqiForumsHandler");
	$forums_handler->delete($_REQUEST["id"]);
	include_once jieqi_path_inc("class/forumtopics.php", "forum");
	$topics_handler = JieqiForumtopicsHandler::getInstance("JieqiForumtopicsHandler");
	$criteria = new CriteriaCompo(new Criteria("ownerid", $_REQUEST["id"], "="));
	$topics_handler->delete($criteria);
	include_once jieqi_path_inc("class/forumposts.php", "forum");
	$posts_handler = JieqiForumpostsHandler::getInstance("JieqiForumpostsHandler");
	$posts_handler->delete($criteria);
	jieqi_jumppage($jieqiModules["forum"]["url"] . "/admin/forumlist.php", LANG_DO_SUCCESS, $jieqiLang["forum"]["delete_forum_success"]);
	break;

case "forumcat":
	include_once jieqi_path_inc("class/forumcat.php", "forum");
	$forumcat_handler = JieqiForumcatHandler::getInstance("JieqiForumcatHandler");
	$forumcat_handler->delete($_REQUEST["id"]);
	include_once jieqi_path_inc("class/forums.php", "forum");
	$forums_handler = JieqiForumsHandler::getInstance("JieqiForumsHandler");
	$criteria = new CriteriaCompo(new Criteria("catid", $_REQUEST["id"], "="));
	$forums_handler->queryObjects($criteria);
	$forums = array();
	$i = 0;

	while ($v = $forums_handler->getObject()) {
		$forums[$i]["forumid"] = $v->getVar("forumid");
		$i++;
	}

	$forums_handler->delete($criteria);
	if (is_array($forums) && (0 < jieqi_count($forums))) {
		$criteria = new CriteriaCompo();

		foreach ($forums as $forum ) {
			$criteria->add(new Criteria("ownerid", $forum["forumid"], "="), "OR");
		}

		include_once jieqi_path_inc("class/forumtopics.php", "forum");
		$topics_handler = JieqiForumtopicsHandler::getInstance("JieqiForumtopicsHandler");
		$topics_handler->delete($criteria);
		include_once jieqi_path_inc("class/forumposts.php", "forum");
		$posts_handler = JieqiForumpostsHandler::getInstance("JieqiForumpostsHandler");
		$posts_handler->delete($criteria);
	}

	include_once jieqi_path_inc("include/upforumset.php", "forum");
	jieqi_jumppage($jieqiModules["forum"]["url"] . "/admin/forumlist.php", LANG_DO_SUCCESS, $jieqiLang["forum"]["delete_forumcat_success"]);
	break;

default:
	jieqi_printfail(LANG_ERROR_PARAMETER);
	break;
}

?>
