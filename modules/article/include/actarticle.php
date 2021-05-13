<?php

if (!defined("JIEQI_ROOT_PATH")) {
    exit();
}

include_once jieqi_path_inc("class/article.php", "article");

if (!isset($article_handler)) {
    $article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
}

include_once jieqi_path_inc("class/chapter.php", "article");

if (!isset($chapter_handler)) {
    $chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
}

include_once jieqi_path_inc("class/package.php", "article");

if (!isset($jieqiConfigs["article"])) {
    jieqi_getconfigs("article", "configs");
}

$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);

function jieqi_article_articlepcheck(&$postvars, $options = array(), $article = "")
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiOption;
	global $jieqiSort;
	global $jieqiLang;
	global $jieqiSites;
	global $jieqiAction;
	global $jieqiDeny;
	global $jieqiPower;
	global $jieqiUsersStatus;
	global $jieqiUsersGroup;
	global $article_handler;

	if (!isset($jieqiConfigs["system"])) {
		jieqi_getconfigs("system", "configs", "jieqiConfigs");
	}

	if (!isset($jieqiConfigs["article"])) {
		jieqi_getconfigs("article", "configs", "jieqiConfigs");
	}

	if (empty($jieqiSort["article"])) {
		jieqi_getconfigs("article", "sort", "jieqiSort");
	}

	if (empty($jieqiOption["article"])) {
		jieqi_getconfigs("article", "option", "jieqiOption");
	}

	if (empty($jieqiSort["article"])) {
		jieqi_getconfigs("article", "sort", "jieqiSort");
	}

	if (empty($jieqiLang["article"]["article"])) {
		jieqi_loadlang("article", "article");
	}

	if (empty($jieqiSites)) {
		jieqi_getconfigs("system", "sites", "jieqiSites");
	}

	if (empty($jieqiAction["article"])) {
		jieqi_getconfigs("article", "action", "jieqiAction");
	}

	if (empty($jieqiDeny["article"])) {
		jieqi_getconfigs("article", "deny", "jieqiDeny");
	}

	if (empty($jieqiPower["article"])) {
		jieqi_getconfigs("article", "power", "jieqiPower");
	}

	if (!isset($options["action"])) {
		$options["action"] = "add";
	}

	if (!isset($options["ismanager"])) {
		$options["ismanager"] = jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
	}

	if (!isset($options["allowtrans"])) {
		$options["allowtrans"] = jieqi_checkpower($jieqiPower["article"]["transarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
	}

	$errors = array();
	include_once jieqi_path_lib("text/textfunction.php");
	$postvars["articlename"] = trim($postvars["articlename"]);

	if (isset($postvars["backupname"])) {
		$postvars["backupname"] = trim($postvars["backupname"]);
	}

	if (isset($postvars["author"])) {
		$postvars["author"] = trim($postvars["author"]);
	}

	if (isset($postvars["agent"])) {
		$postvars["agent"] = trim($postvars["agent"]);
	}

	$postvars["sortid"] = (isset($postvars["sortid"]) ? intval($postvars["sortid"]) : 0);
	$postvars["typeid"] = (isset($postvars["typeid"]) ? intval($postvars["typeid"]) : 0);

	if (!isset($jieqiSort["article"][$postvars["sortid"]]["types"][$postvars["typeid"]])) {
		$postvars["typeid"] = 0;
	}

	if (!isset($jieqiSort["article"][$postvars["sortid"]])) {
		$postvars["sortid"] = 0;
	}

	if (strlen($postvars["articlename"]) == 0) {
		$errors[] = $jieqiLang["article"]["need_article_title"];
	}
	else if (!jieqi_safestring($postvars["articlename"])) {
		$errors[] = $jieqiLang["article"]["limit_article_title"];
	}

	if (!isset($jieqiDeny["article"])) {
		$jieqiDeny["article"] = $jieqiConfigs["system"]["postdenywords"];
	}

	include_once jieqi_path_inc("include/checker.php", "system");
	$checker = new JieqiChecker();
	if (!empty($jieqiDeny["article"]) || !empty($jieqiConfigs["system"]["postdenywords"])) {
		if (!empty($jieqiDeny["article"])) {
			$matchwords = $checker->deny_words($postvars["articlename"], $jieqiDeny["article"], true, true);

			if (is_array($matchwords)) {
				$errors[] = sprintf($jieqiLang["article"]["article_deny_articlename"], implode(" ", jieqi_funtoarray("jieqi_htmlchars", $matchwords)));
			}
		}

		if (!empty($jieqiConfigs["system"]["postdenywords"])) {
			if (!empty($postvars["intro"])) {
				$matchwords = $checker->deny_words($postvars["intro"], $jieqiConfigs["system"]["postdenywords"], true);

				if (is_array($matchwords)) {
					$errors[] = sprintf($jieqiLang["article"]["article_deny_intro"], implode(" ", jieqi_funtoarray("jieqi_htmlchars", $matchwords)));
				}
			}

			if (!empty($postvars["notice"])) {
				$matchwords = $checker->deny_words($postvars["notice"], $jieqiConfigs["system"]["postdenywords"], true);

				if (is_array($matchwords)) {
					$errors[] = sprintf($jieqiLang["article"]["article_deny_notice"], implode(" ", jieqi_funtoarray("jieqi_htmlchars", $matchwords)));
				}
			}

			if (!empty($postvars["keywords"])) {
				$matchwords = $checker->deny_words($postvars["keywords"], $jieqiConfigs["system"]["postdenywords"], true);

				if (is_array($matchwords)) {
					$errors[] = sprintf($jieqiLang["article"]["article_deny_keywords"], implode(" ", jieqi_funtoarray("jieqi_htmlchars", $matchwords)));
				}
			}
		}
	}

	$typeary = explode(" ", trim($jieqiConfigs["article"]["imagetype"]));

	foreach ($typeary as $k => $v ) {
		if (substr($v, 0, 1) != ".") {
			$typeary[$k] = "." . $typeary[$k];
		}
	}

	if (!empty($_FILES["articlespic"]["name"])) {
		$simage_postfix = strrchr(trim(strtolower($_FILES["articlespic"]["name"])), ".");

		if (preg_match("/\.(gif|jpg|jpeg|png|bmp)$/i", $_FILES["articlespic"]["name"])) {
			if (!in_array($simage_postfix, $typeary)) {
				$errors[] = sprintf($jieqiLang["article"]["simage_type_error"], $jieqiConfigs["article"]["imagetype"]);
			}
		}
		else {
			$errors[] = sprintf($jieqiLang["article"]["simage_not_image"], $_FILES["articlespic"]["name"]);
		}

		if (!empty($errtext)) {
			jieqi_delfile($_FILES["articlespic"]["tmp_name"]);
		}
	}

	if (!empty($_FILES["articlelpic"]["name"])) {
		$limage_postfix = strrchr(trim(strtolower($_FILES["articlelpic"]["name"])), ".");

		if (preg_match("/\.(gif|jpg|jpeg|png|bmp)$/i", $_FILES["articlelpic"]["name"])) {
			if (!in_array($limage_postfix, $typeary)) {
				$errors[] = sprintf($jieqiLang["article"]["limage_type_error"], $jieqiConfigs["article"]["imagetype"]);
			}
		}
		else {
			$errors[] = sprintf($jieqiLang["article"]["limage_not_image"], $_FILES["articlelpic"]["name"]);
		}

		if (!empty($errtext)) {
			jieqi_delfile($_FILES["articlelpic"]["tmp_name"]);
		}
	}

	if (!empty($postvars["articleid"]) && $options["allowtrans"]) {
		$article_handler->execute("SELECT MAX(articleid) AS mid FROM " . jieqi_dbprefix("article_article"));
		$tmprow = $article_handler->getRow();

		if (isset($tmprow["mid"])) {
			$max_articleid = intval($tmprow["mid"]);
		}
		else {
			$max_articleid = 0;
		}

		$postvars["articleid"] = intval($postvars["articleid"]);
		if (($postvars["articleid"] <= 0) || ($max_articleid < $postvars["articleid"])) {
			$errors[] = sprintf($jieqiLang["article"]["customid_number_limit"], $max_articleid);
		}
		else {
			$tmparticle = $article_handler->get($postvars["articleid"]);

			if (is_object($tmparticle)) {
				$errors[] = sprintf($jieqiLang["article"]["customid_is_exists"], $postvars["articleid"]);
			}
		}
	}
	else {
		$postvars["articleid"] = 0;
	}

	if (($jieqiConfigs["article"]["samearticlename"] != 1) && (empty($article) || ($article->getVar("articlename", "n") != $postvars["articlename"]))) {
		if (0 < $article_handler->getCount(new Criteria("articlename", $postvars["articlename"], "="))) {
			$errors[] = sprintf($jieqiLang["article"]["articletitle_has_exists"], jieqi_htmlstr($postvars["articlename"]));
		}
	}

	$customacode = false;
	$postvars["updateacode"] = false;
	if ($options["ismanager"] && !empty($postvars["articlecode"])) {
		$customacode = true;
	}
	else {
		$postvars["articlecode"] = jieqi_getpinyin($postvars["articlename"]);
	}

	$postvars["articlecode"] = strtolower($postvars["articlecode"]);

	if (180 < strlen($postvars["articlecode"])) {
		$postvars["articlecode"] = substr($postvars["articlecode"], 0, 180);
	}

	if (!preg_match("/^[a-z]/i", $postvars["articlecode"])) {
		$postvars["articlecode"] = "i" . str_replace("_", "", $postvars["articlecode"]);
	}

	if (empty($article) || ($article->getVar("articlecode", "n") != $postvars["articlecode"])) {
		if (0 < $article_handler->getCount(new Criteria("articlecode", $postvars["articlecode"], "="))) {
			if ($customacode) {
				$errors[] = sprintf($jieqiLang["article"]["articlecode_has_exists"], jieqi_htmlstr($postvars["articlecode"]));
			}
			else if (is_object($article)) {
				$postvars["articlecode"] .= "_" . $article->getVar("articleid", "n");
			}
			else {
				$postvars["updateacode"] = true;
			}
		}
	}

	if (!empty($jieqiConfigs["system"]["postreplacewords"])) {
		if (!empty($postvars["intro"])) {
			$checker->replace_words($postvars["intro"], $jieqiConfigs["system"]["postreplacewords"]);
		}

		if (!empty($postvars["notice"])) {
			$checker->replace_words($postvars["notice"], $jieqiConfigs["system"]["postreplacewords"]);
		}

		if (!empty($postvars["keywords"])) {
			$checker->replace_words($postvars["keywords"], $jieqiConfigs["system"]["postreplacewords"]);
		}
	}

	return $errors;
}

function jieqi_article_articleadd(&$postvars, $options = array(), $article = "")
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiOption;
	global $jieqiSort;
	global $jieqiLang;
	global $jieqiSites;
	global $jieqiAction;
	global $jieqiDeny;
	global $jieqiPower;
	global $jieqiUsersStatus;
	global $jieqiUsersGroup;
	global $article_handler;
	global $users_handler;
	global $query;

	if (!isset($jieqiConfigs["system"])) {
		jieqi_getconfigs("system", "configs", "jieqiConfigs");
	}

	if (!isset($jieqiConfigs["article"])) {
		jieqi_getconfigs("article", "configs", "jieqiConfigs");
	}

	if (empty($jieqiSort["article"])) {
		jieqi_getconfigs("article", "sort", "jieqiSort");
	}

	if (empty($jieqiOption["article"])) {
		jieqi_getconfigs("article", "option", "jieqiOption");
	}

	if (empty($jieqiSort["article"])) {
		jieqi_getconfigs("article", "sort", "jieqiSort");
	}

	if (empty($jieqiLang["article"]["article"])) {
		jieqi_loadlang("article", "article");
	}

	if (empty($jieqiSites)) {
		jieqi_getconfigs("system", "sites", "jieqiSites");
	}

	if (empty($jieqiAction["article"])) {
		jieqi_getconfigs("article", "action", "jieqiAction");
	}

	if (empty($jieqiDeny["article"])) {
		jieqi_getconfigs("article", "deny", "jieqiDeny");
	}

	if (empty($jieqiPower["article"])) {
		jieqi_getconfigs("article", "power", "jieqiPower");
	}

	if (!isset($options["action"])) {
		$options["action"] = "add";
	}

	if (!isset($options["ismanager"])) {
		$options["ismanager"] = jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
	}

	if (!isset($options["allowtrans"])) {
		$options["allowtrans"] = jieqi_checkpower($jieqiPower["article"]["transarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
	}

	include_once jieqi_path_lib("text/textfunction.php");

	if (!is_a($users_handler, "JieqiUsersHandler")) {
		include_once jieqi_path_inc("class/users.php", "system");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
	}

	if (!is_a($query, "JieqiQueryHandler")) {
		$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
	}

	if ($options["action"] == "add") {
		$article = $article_handler->create();
		if ($options["allowtrans"] && !empty($postvars["articleid"])) {
			$article->setVar("articleid", $postvars["articleid"]);
		}

		$siteid = (empty($postvars["siteid"]) ? 0 : intval($postvars["siteid"]));
		$article->setVar("siteid", $siteid);
		$sourceid = (empty($postvars["sourceid"]) ? 0 : intval($postvars["sourceid"]));
		$article->setVar("sourceid", $sourceid);
		$postdate = (empty($postvars["postdate"]) ? JIEQI_NOW_TIME : intval($postvars["postdate"]));
		$article->setVar("postdate", $postdate);
		$lastupdate = (empty($postvars["lastupdate"]) ? 0 : intval($postvars["lastupdate"]));
		$article->setVar("lastupdate", $lastupdate);
	}

	if ($article->getVar("infoupdate", "n") !== false) {
		$infoupdate = (empty($postvars["infoupdate"]) ? JIEQI_NOW_TIME : intval($postvars["infoupdate"]));
		$article->setVar("infoupdate", $infoupdate);
	}

	$article->setVar("articlename", $postvars["articlename"]);

	if (!$postvars["updateacode"]) {
		$article->setVar("articlecode", $postvars["articlecode"]);
	}

	if (isset($postvars["backupname"])) {
		$article->setVar("backupname", $postvars["backupname"]);
	}

	if (2 <= floatval(JIEQI_VERSION)) {
		include_once jieqi_path_inc("include/funtag.php", "system");

		if ($options["action"] == "edit") {
			$oldtags = jieqi_tag_clean($article->getVar("keywords", "n"));
		}

		$tagary = jieqi_tag_clean($postvars["keywords"]);
		$postvars["keywords"] = implode(" ", $tagary);
	}

	$article->setVar("keywords", trim($postvars["keywords"]));
	$article->setVar("initial", jieqi_getinitial($postvars["articlename"]));

	if ($options["allowtrans"]) {
		if (empty($postvars["author"]) || (!empty($_SESSION["jieqiUserId"]) && ($postvars["author"] == $_SESSION["jieqiUserName"]))) {
			if (!empty($_SESSION["jieqiUserId"])) {
				$article->setVar("authorid", $_SESSION["jieqiUserId"]);
				$article->setVar("author", $_SESSION["jieqiUserName"]);
			}
			else {
				$article->setVar("authorid", 0);
				$article->setVar("author", "");
			}
		}
		else {
			$article->setVar("author", $postvars["author"]);

			if ($postvars["authorflag"]) {
				$authorobj = $users_handler->getByname($postvars["author"], 3);

				if (is_object($authorobj)) {
					$article->setVar("authorid", $authorobj->getVar("uid"));
				}
				else {
					$article->setVar("authorid", 0);
				}
			}
			else {
				$article->setVar("authorid", 0);
			}
		}
	}
	else if ($options["action"] == "add") {
		if (!empty($_SESSION["jieqiUserId"])) {
			$article->setVar("authorid", $_SESSION["jieqiUserId"]);
			$article->setVar("author", $_SESSION["jieqiUserName"]);
		}
		else {
			$article->setVar("authorid", 0);
			$article->setVar("author", "");
		}
	}

	if (isset($jieqiOption["article"]["firstflag"]["items"][$postvars["firstflag"]])) {
		$article->setVar("firstflag", $postvars["firstflag"]);
	}

	if (isset($jieqiOption["article"]["permission"]["items"][$postvars["permission"]])) {
		$article->setVar("permission", $postvars["permission"]);
	}

	if (isset($jieqiOption["article"]["isshort"]["items"][$postvars["isshort"]])) {
		$article->setVar("isshort", $postvars["isshort"]);
	}

	if (isset($jieqiOption["article"]["inmatch"]["items"][$postvars["inmatch"]])) {
		$article->setVar("inmatch", $postvars["inmatch"]);
	}

	$rgroup = 0;
	if (isset($jieqiSort["article"][$postvars["sortid"]]["group"]) && (0 <= $jieqiSort["article"][$postvars["sortid"]]["group"])) {
		$rgroup = intval($jieqiSort["article"][$postvars["sortid"]]["group"]);
	}
	else if (isset($postvars["rgroup"])) {
		$rgroup = intval($postvars["rgroup"]);
	}

	if (isset($jieqiOption["article"]["rgroup"]["items"][$rgroup])) {
		$article->setVar("rgroup", $rgroup);
	}

	$postvars["progress"] = intval($postvars["progress"]);

	if (isset($jieqiOption["article"]["progress"]["items"][$postvars["progress"]])) {
		$article->setVar("progress", $postvars["progress"]);
		$tmpvar = -1;

		foreach ($jieqiOption["article"]["progress"]["items"] as $k => $v ) {
			if ($tmpvar < $k) {
				$tmpvar = $k;
			}
		}

		if (!isset($postvars["fullflag"])) {
			$postvars["fullflag"] = ($postvars["progress"] == $tmpvar ? 1 : 0);
		}
	}

	$article->setVar("fullflag", intval($postvars["fullflag"]));
	$article->setVar("sortid", $postvars["sortid"]);
	$article->setVar("typeid", $postvars["typeid"]);
	$article->setVar("intro", $postvars["intro"]);
	$article->setVar("notice", $postvars["notice"]);

	if ($options["action"] == "add") {
		if (!empty($_SESSION["jieqiUserId"])) {
			$article->setVar("posterid", $_SESSION["jieqiUserId"]);
			$article->setVar("poster", $_SESSION["jieqiUserName"]);
		}
		else {
			$article->setVar("posterid", 0);
			$article->setVar("poster", "");
		}

		$article->setVar("lastchapterid", 0);
		$article->setVar("lastchapter", "");
		$article->setVar("lastvolumeid", 0);
		$article->setVar("lastvolume", "");
		$article->setVar("chapters", 0);
		$article->setVar("size", 0);
		$article->setVar("setting", "");
		$article->setVar("articletype", 0);

		if (jieqi_checkpower($jieqiPower["article"]["needcheck"], $jieqiUsersStatus, $jieqiUsersGroup, true)) {
			if (empty($postvars["display"]) || !is_numeric($postvars["display"])) {
				$article->setVar("display", 0);
			}
			else {
				$article->setVar("display", intval($postvars["display"]));
			}
		}
		else {
			$article->setVar("display", 1);
		}

		$imgflag = 0;
	}
	else {
		$old_imgflag = $article->getVar("imgflag");
		$old_simg = $old_imgflag & 1;
		$imgflag = $old_imgflag;
	}

	$imgtary = array(1 => ".gif", 2 => ".jpg", 3 => ".jpeg", 4 => ".png", 5 => ".bmp");

	if (!empty($_FILES["articlelpic"]["name"])) {
		$limage_postfix = strrchr(trim(strtolower($_FILES["articlelpic"]["name"])), ".");
		$imgflag = $imgflag | 2;
		$tmpvar = intval(array_search($limage_postfix, $imgtary));

		if (0 < $tmpvar) {
			$imgflag = $imgflag | ($tmpvar * 32);
		}
	}
	else {
		if (isset($postvars["urllpic"]) && preg_match("/^https?:\/\/[^\s\\r\\n\\t\\f<>]+(\.gif|\.jpg|\.jpeg|\.png|\.bmp)/i", $postvars["urllpic"], $matches)) {
			$limage_postfix = $matches[1];
			$imgflag = $imgflag | 2;
			$tmpvar = intval(array_search($limage_postfix, $imgtary));

			if (0 < $tmpvar) {
				$imgflag = $imgflag | ($tmpvar * 32);
			}
		}
	}

	if (!empty($_FILES["articlespic"]["name"]) || !empty($_FILES["articlelpic"]["name"])) {
		if (empty($_FILES["articlespic"]["name"])) {
			$simage_postfix = $limage_postfix;
		}
		else {
			$simage_postfix = strrchr(trim(strtolower($_FILES["articlespic"]["name"])), ".");
		}

		$imgflag = $imgflag | 1;
		$tmpvar = intval(array_search($simage_postfix, $imgtary));

		if (0 < $tmpvar) {
			$imgflag = $imgflag | ($tmpvar * 4);
		}
	}
	else {
		if (isset($postvars["urlspic"]) && preg_match("/^https?:\/\/[^\s\\r\\n\\t\\f<>]+(\.gif|\.jpg|\.jpeg|\.png|\.bmp)/i", $postvars["urlspic"], $matches)) {
			$simage_postfix = $matches[1];
			$imgflag = $imgflag | 1;
			$tmpvar = intval(array_search($simage_postfix, $imgtary));

			if (0 < $tmpvar) {
				$imgflag = $imgflag | ($tmpvar * 4);
			}
		}
	}

	$article->setVar("imgflag", $imgflag);
	if ((0 < $jieqiConfigs["article"]["eachlinknum"]) && isset($postvars["eachlinkids"])) {
		$postvars["eachlinkids"] = trim($postvars["eachlinkids"]);
		$setting = @jieqi_unserialize($article->getVar("setting", "n"));

		if (!empty($setting["eachlink"]["ids"])) {
			$linkvalue = implode(" ", $setting["eachlink"]["ids"]);
		}
		else {
			$linkvalue = "";
		}

		if ($linkvalue != $postvars["eachlinkids"]) {
			$tmpary = array_unique(explode(" ", $postvars["eachlinkids"]));

			foreach ($tmpary as $k => $v ) {
				if (!is_numeric($v)) {
					unset($tmpary[$k]);
				}
				else {
					$tmpary[$k] = intval($tmpary[$k]);
				}
			}

			$linkids = array();
			$linknames = array();
			$linkcodes = array();

			if (@jieqi_count(0 < $tmpary)) {
				$sql = "SELECT articleid, articlename, articlecode FROM " . jieqi_dbprefix("article_article") . " WHERE articleid IN (" . implode(",", $tmpary) . ")";
				$query->execute($sql);
				$linknum = 0;
				while (($arow = $query->getRow()) && ($linknum < $jieqiConfigs["article"]["eachlinknum"])) {
					if (($options["action"] == "add") || ($arow["articleid"] != $article->getVar("articleid", "n"))) {
						$linkids[$linknum] = $arow["articleid"];
						$linknames[$linknum] = $arow["articlename"];
						$linkcodes[$linknum] = $arow["articlecode"];
						$linknum++;
					}
				}
			}

			$setting["eachlink"]["ids"] = $linkids;
			$setting["eachlink"]["names"] = $linknames;
			$setting["eachlink"]["codes"] = $linkcodes;
			$article->setVar("setting", serialize($setting));
		}
	}

	if ($options["ismanager"]) {
		$agentobj = false;

		if (!empty($postvars["agent"])) {
			$agentobj = $users_handler->getByname($postvars["agent"], 3);
		}

		if (is_object($agentobj)) {
			$article->setVar("agentid", $agentobj->getVar("uid"));
			$article->setVar("agent", $agentobj->getVar("uname", "n"));
		}
		else {
			$article->setVar("agentid", 0);
			$article->setVar("agent", "");
		}

		if (isset($postvars["poster"]) && (0 < strlen($postvars["poster"]))) {
			$posterobj = $users_handler->getByname($postvars["poster"], 3);

			if (is_object($posterobj)) {
				$article->setVar("poster", $posterobj->getVar("name", "n"));
				$article->setVar("posterid", $posterobj->getVar("uid", "n"));
			}
		}

		if (isset($postvars["master"]) && (0 < strlen($postvars["master"]))) {
			$masterobj = $users_handler->getByname($postvars["master"], 3);

			if (is_object($masterobj)) {
				$article->setVar("master", $masterobj->getVar("name", "n"));
				$article->setVar("masterid", $masterobj->getVar("uid", "n"));
			}
		}

		if (isset($postvars["siteid"]) && is_numeric($postvars["siteid"]) && !empty($jieqiSites[$postvars["siteid"]]["custom"])) {
			$article->setVar("siteid", intval($postvars["siteid"]));
		}

		if (isset($postvars["foreword"])) {
			$article->setVar("foreword", $postvars["foreword"]);
		}

		if (isset($postvars["saleprice"]) && is_numeric($postvars["saleprice"]) && (0 < intval($postvars["saleprice"]))) {
			$article->setVar("saleprice", intval($postvars["saleprice"]));
		}

		if (isset($postvars["monthly"]) && is_numeric($postvars["monthly"]) && isset($jieqiOption["article"]["monthly"]["items"][$postvars["monthly"]])) {
			$article->setVar("monthly", intval($postvars["monthly"]));
		}

		if (isset($jieqiOption["article"]["buyout"]["items"][$postvars["buyout"]])) {
			$article->setVar("buyout", $postvars["buyout"]);
		}

		if (isset($jieqiOption["article"]["discount"]["items"][$postvars["discount"]])) {
			$article->setVar("discount", $postvars["discount"]);
		}

		if (isset($jieqiOption["article"]["quality"]["items"][$postvars["quality"]])) {
			$article->setVar("quality", $postvars["quality"]);
		}

		if (isset($jieqiOption["article"]["isshare"]["items"][$postvars["isshare"]])) {
			$article->setVar("isshare", $postvars["isshare"]);
		}

		if (empty($rgroup) && isset($jieqiOption["article"]["rgroup"]["items"][$postvars["rgroup"]])) {
			$article->setVar("rgroup", $postvars["rgroup"]);
		}

		if (isset($postvars["issign"])) {
			if ($options["action"] == "add") {
				$article->setVar("signtime", 0);
				$article->setVar("isvip", 0);
				$article->setVar("vipid", 0);
			}

			$postvars["issign"] = intval($postvars["issign"]);
			$article->setVar("issign", $postvars["issign"]);

			if (10 <= $postvars["issign"]) {
				if (intval($article->getVar("signtime", "n")) == 0) {
					$article->setVar("signtime", JIEQI_NOW_TIME);
				}

				if (intval($article->getVar("isvip", "n")) == 0) {
					$article->setVar("isvip", 1);
				}

				if (intval($article->getVar("vipid", "n")) == 0) {
					$sql = "SELECT * FROM " . jieqi_dbprefix("obook_obook") . " WHERE obookname = '" . jieqi_dbslashes($article->getVar("articlename", "n")) . "' LIMIT 0,1";
					$query->execute($sql);
					$obookrow = $query->getRow();
					if (is_array($obookrow) && !empty($obookrow["articleid"])) {
						$sql = "SELECT * FROM " . jieqi_dbprefix("article_article") . " WHERE articleid = " . intval($obookrow["articleid"]) . " LIMIT 0,1";
						$query->execute($sql);
						$articlerow = $query->getRow();
						if (!$articlerow || ($articlerow["articleid"] == $article->getVar("articleid", "n"))) {
							$article->setVar("viptime", $obookrow["lastupdate"]);
							$article->setVar("vipid", $obookrow["obookid"]);
							$article->setVar("vipchapters", $obookrow["chapters"]);
							$article->setVar("vipsize", $obookrow["size"]);
							$article->setVar("vipvolumeid", $obookrow["lastvolumeid"]);
							$article->setVar("vipvolume", $obookrow["lastvolume"]);
							$article->setVar("vipchapterid", $obookrow["lastchapterid"]);
							$article->setVar("vipchapter", $obookrow["lastchapter"]);
							$article->setVar("vipsummary", $obookrow["lastsummary"]);

							if (!$articlerow) {
								$sql = "UPDATE " . jieqi_dbprefix("obook_obook") . " SET articleid = " . intval($article->getVar("articleid", "n")) . " WHERE obookid = " . intval($obookrow["obookid"]);
								$query->execute($sql);
								$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET articleid = " . intval($article->getVar("articleid", "n")) . " WHERE obookid = " . intval($obookrow["obookid"]);
								$query->execute($sql);
								$sql = "UPDATE " . jieqi_dbprefix("obook_paidlog") . " SET articleid = " . intval($article->getVar("articleid", "n")) . " WHERE obookid = " . intval($obookrow["obookid"]);
								$query->execute($sql);
							}
						}
					}
				}
			}
			else if (0 < $postvars["issign"]) {
				if (intval($article->getVar("signtime", "n")) == 0) {
					$article->setVar("signtime", JIEQI_NOW_TIME);
				}

				if ((0 < intval($article->getVar("isvip", "n"))) && (intval($article->getVar("vipchapters", "n")) == 0)) {
					$article->setVar("isvip", 0);
				}
			}
			else if ($postvars["issign"] == 0) {
				if (0 < intval($article->getVar("signtime", "n"))) {
					$article->setVar("signtime", 0);
				}

				if ((0 < intval($article->getVar("isvip", "n"))) && (intval($article->getVar("vipchapters", "n")) == 0)) {
					$article->setVar("isvip", 0);
				}
			}
		}
		else if (0 < $postvars["isvip"]) {
			$article->setVar("issign", 0);
			$article->setVar("isvip", 1);
		}

		if (isset($postvars["ispub"]) && isset($jieqiOption["article"]["ispub"]["items"][$postvars["ispub"]])) {
			$article->setVar("ispub", $postvars["ispub"]);
		}

		if (isset($postvars["pubtime"])) {
			$article->setVar("pubtime", strtotime($postvars["pubtime"]));
		}

		if (isset($postvars["pubid"])) {
			$article->setVar("pubid", intval($postvars["pubid"]));
		}

		if (isset($postvars["pubhouse"])) {
			$article->setVar("pubhouse", $postvars["pubhouse"]);
		}

		if (isset($postvars["pubprice"])) {
			$article->setVar("pubprice", round(floatval($postvars["pubprice"]) * 100));
		}

		if (isset($postvars["pubpages"])) {
			$article->setVar("pubpages", intval($postvars["pubpages"]));
		}

		if (isset($postvars["pubisbn"])) {
			$article->setVar("pubisbn", $postvars["pubisbn"]);
		}

		if (isset($postvars["pubinfo"])) {
			$article->setVar("pubinfo", $postvars["pubinfo"]);
		}

		if (isset($postvars["buysid"])) {
			$article->setVar("buysid", intval($postvars["buysid"]));
		}

		if (isset($postvars["buysite"])) {
			$article->setVar("buysite", $postvars["buysite"]);
		}

		if (isset($postvars["buyurl"])) {
			$article->setVar("buyurl", $postvars["buyurl"]);
		}

		if (isset($postvars["buyprice"])) {
			$article->setVar("buyprice", round(floatval($postvars["buyprice"]) * 100));
		}

		if (isset($postvars["buyinfo"])) {
			$article->setVar("buyinfo", $postvars["buyinfo"]);
		}
	}

	if (!empty($options["allowmodify"])) {
		if (2 <= floatval(JIEQI_VERSION)) {
			$statary = array("dayvisit", "weekvisit", "monthvisit", "allvisit", "dayvote", "weekvote", "monthvote", "allvote", "dayflower", "weekflower", "monthflower", "allflower", "dayegg", "weekegg", "monthegg", "allegg", "dayvipvote", "weekvipvote", "monthvipvote", "allvipvote");
		}
		else {
			$statary = array("dayvisit", "weekvisit", "monthvisit", "allvisit", "dayvote", "weekvote", "monthvote", "allvote");
		}

		foreach ($statary as $v ) {
			if (isset($postvars[$v]) && is_numeric($postvars[$v]) && ($postvars[$v] != $article->getVar($v, "n"))) {
				$article->setVar($v, intval($postvars[$v]));
				$tmpv = str_replace(array("day", "week", "month", "all"), "last", $v);
				$article->setVar($tmpv, JIEQI_NOW_TIME);
			}
		}
	}

	if (!$article_handler->insert($article)) {
		if ($options["action"] == "add") {
			return $jieqiLang["article"]["article_add_failure"];
		}
		else {
			return $jieqiLang["article"]["article_edit_failure"];
		}
	}
	else {
		$id = intval($article->getVar("articleid", "n"));

		if ($options["action"] == "add") {
			if ($postvars["updateacode"]) {
				$postvars["articlecode"] .= "_" . $id;
				$article_handler->updatefields(array("articlecode" => $postvars["articlecode"]), new Criteria("articleid", $id, "="));
			}

			if (2 <= floatval(JIEQI_VERSION)) {
				jieqi_tag_save($tagary, $id, array("tag" => jieqi_dbprefix("article_tag"), "taglink" => jieqi_dbprefix("article_taglink")));
			}

			include_once jieqi_path_inc("class/package.php", "article");
			$package = new JieqiPackage($id);
			$package->initPackage($article->getVars("n"), true);
			include_once jieqi_path_inc("include/funarticle.php", "article");
			if (!empty($_FILES["articlelpic"]["name"]) && !empty($_FILES["articlespic"]["name"])) {
				$imagefile = $package->getDir("imagedir") . "/" . $id . "l" . $limage_postfix;
				jieqi_copyfile($_FILES["articlelpic"]["tmp_name"], $imagefile, 511, true);
				jieqi_article_coverdo($imagefile, "l");
				$imagefile = $package->getDir("imagedir") . "/" . $id . "s" . $simage_postfix;
				jieqi_copyfile($_FILES["articlespic"]["tmp_name"], $imagefile, 511, true);
				jieqi_article_coverdo($imagefile, "s");
			}
			else if (!empty($_FILES["articlelpic"]["name"])) {
				$imagefile = $package->getDir("imagedir") . "/" . $id . "l" . $limage_postfix;
				jieqi_copyfile($_FILES["articlelpic"]["tmp_name"], $imagefile, 511, false);
				jieqi_article_coverdo($imagefile, "l");
				$imagefile = $package->getDir("imagedir") . "/" . $id . "s" . $limage_postfix;
				jieqi_copyfile($_FILES["articlelpic"]["tmp_name"], $imagefile, 511, true);
				jieqi_article_coverdo($imagefile, "s");
			}
			else if (!empty($_FILES["articlespic"]["name"])) {
				$imagefile = $package->getDir("imagedir") . "/" . $id . "s" . $simage_postfix;
				jieqi_copyfile($_FILES["articlespic"]["tmp_name"], $imagefile, 511, true);
				jieqi_article_coverdo($imagefile, "s");
			}
			else {
				if (!empty($postvars["urllpic"]) && empty($postvars["urlspic"])) {
					$postvars["urlspic"] = $postvars["urllpic"];
				}

				if (!empty($postvars["urllpic"]) && preg_match("/^https?:\/\/[^\s\\r\\n\\t\\f<>]+(\.gif|\.jpg|\.jpeg|\.png|\.bmp)/i", $postvars["urllpic"], $matches)) {
					$imgfile = $package->getDir("imagedir") . "/" . $id . "l" . $matches[1];
					jieqi_checkdir(dirname($imgfile), true);
					jieqi_writefile($imgfile, jieqi_urlcontents($postvars["urllpic"]));
					jieqi_article_coverdo($imgfile, "l");
				}

				if (!empty($postvars["urlspic"]) && preg_match("/^https?:\/\/[^\s\\r\\n\\t\\f<>]+(\.gif|\.jpg|\.jpeg|\.png|\.bmp)/i", $postvars["urlspic"], $matches)) {
					$imgfile = $package->getDir("imagedir") . "/" . $id . "s" . $matches[1];
					jieqi_checkdir(dirname($imgfile), true);
					jieqi_writefile($imgfile, jieqi_urlcontents($postvars["urlspic"]));
					jieqi_article_coverdo($imgfile, "s");
				}
			}
		}
		else {
			$vipid = intval($article->getVar("vipid", "n"));

			if (0 < $vipid) {
				$sql = "UPDATE " . jieqi_dbprefix("obook_obook") . " SET siteid = " . intval($article->getVar("siteid", "n")) . ", obookname = '" . jieqi_dbslashes($article->getVar("articlename", "n")) . "', keywords = '" . jieqi_dbslashes($article->getVar("keywords", "n")) . "', initial = '" . jieqi_dbslashes($article->getVar("initial", "n")) . "', sortid = " . intval($article->getVar("sortid", "n")) . ", intro = '" . jieqi_dbslashes($article->getVar("intro", "n")) . "', notice = '" . jieqi_dbslashes($article->getVar("notice", "n")) . "', authorid = " . intval($article->getVar("authorid", "n")) . ", author = '" . jieqi_dbslashes($article->getVar("author", "n")) . "', agentid = " . intval($article->getVar("agentid", "n")) . ", agent = '" . jieqi_dbslashes($article->getVar("agent", "n")) . "', masterid = " . intval($article->getVar("masterid", "n")) . ", master = '" . jieqi_dbslashes($article->getVar("master", "n")) . "', posterid = " . intval($article->getVar("posterid", "n")) . ", poster = '" . jieqi_dbslashes($article->getVar("poster", "n")) . "', saleprice = " . intval($article->getVar("saleprice", "n")) . ", publishid = " . intval($article->getVar("vippubid", "n")) . ", imgflag = " . intval($article->getVar("imgflag", "n")) . ", canbesp = " . intval($article->getVar("monthly", "n")) . ", display = " . intval($article->getVar("display", "n")) . " WHERE obookid = " . $vipid;
				$query->execute($sql);
				$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET obookname = '" . jieqi_dbslashes($article->getVar("articlename", "n")) . "' WHERE obookid = " . $vipid;
				$query->execute($sql);
			}

			if (2 <= floatval(JIEQI_VERSION)) {
				jieqi_tag_update($oldtags, $tagary, $id, array("tag" => jieqi_dbprefix("article_tag"), "taglink" => jieqi_dbprefix("article_taglink")));
			}

			include_once jieqi_path_inc("class/package.php", "article");
			$package = new JieqiPackage($id);
			$package->editPackage($article->getVars("n"), true);
			include_once jieqi_path_inc("include/funarticle.php", "article");

			if ($old_imgflag != $imgflag) {
				$tmpvar = ($old_imgflag >> 2) & 7;

				if (isset($imgtary[$tmpvar])) {
					if (is_file($package->getDir("imagedir") . "/" . $id . "s" . $imgtary[$tmpvar])) {
						jieqi_delfile($package->getDir("imagedir") . "/" . $id . "s" . $imgtary[$tmpvar]);
					}
				}

				$tmpvar = $old_imgflag >> 5;

				if (isset($imgtary[$tmpvar])) {
					if (is_file($package->getDir("imagedir") . "/" . $id . "l" . $imgtary[$tmpvar])) {
						jieqi_delfile($package->getDir("imagedir") . "/" . $id . "l" . $imgtary[$tmpvar]);
					}
				}
			}

			if (!empty($_FILES["articlelpic"]["name"]) && !empty($_FILES["articlespic"]["name"])) {
				$imagefile = $package->getDir("imagedir") . "/" . $id . "l" . $limage_postfix;
				jieqi_copyfile($_FILES["articlelpic"]["tmp_name"], $imagefile, 511, true);
				jieqi_article_coverdo($imagefile, "l");
				$imagefile = $package->getDir("imagedir") . "/" . $id . "s" . $simage_postfix;
				jieqi_copyfile($_FILES["articlespic"]["tmp_name"], $imagefile, 511, true);
				jieqi_article_coverdo($imagefile, "s");
			}
			else if (!empty($_FILES["articlelpic"]["name"])) {
				if (!empty($postvars["sameslpic"]) || empty($old_simg)) {
					$imagefile = $package->getDir("imagedir") . "/" . $id . "l" . $limage_postfix;
					jieqi_copyfile($_FILES["articlelpic"]["tmp_name"], $imagefile, 511, false);
					jieqi_article_coverdo($imagefile, "l");
					$imagefile = $package->getDir("imagedir") . "/" . $id . "s" . $limage_postfix;
					jieqi_copyfile($_FILES["articlelpic"]["tmp_name"], $imagefile, 511, true);
					jieqi_article_coverdo($imagefile, "s");
				}
				else {
					$imagefile = $package->getDir("imagedir") . "/" . $id . "l" . $limage_postfix;
					jieqi_copyfile($_FILES["articlelpic"]["tmp_name"], $imagefile, 511, true);
					jieqi_article_coverdo($imagefile, "l");
				}
			}
			else if (!empty($_FILES["articlespic"]["name"])) {
				$imagefile = $package->getDir("imagedir") . "/" . $id . "s" . $simage_postfix;
				jieqi_copyfile($_FILES["articlespic"]["tmp_name"], $imagefile, 511, true);
				jieqi_article_coverdo($imagefile, "s");
			}
			else {
				if (!empty($postvars["urllpic"]) && empty($postvars["urlspic"])) {
					$postvars["urlspic"] = $postvars["urllpic"];
				}

				if (!empty($postvars["urllpic"]) && preg_match("/^https?:\/\/[^\s\\r\\n\\t\\f<>]+(\.gif|\.jpg|\.jpeg|\.png|\.bmp)/i", $postvars["urllpic"], $matches)) {
					$imgfile = $package->getDir("imagedir") . "/" . $id . "l" . $matches[1];
					jieqi_checkdir(dirname($imgfile), true);
					jieqi_writefile($imgfile, jieqi_urlcontents($postvars["urllpic"]));
					jieqi_article_coverdo($imgfile, "l");
				}

				if (!empty($postvars["urlspic"]) && preg_match("/^https?:\/\/[^\s\\r\\n\\t\\f<>]+(\.gif|\.jpg|\.jpeg|\.png|\.bmp)/i", $postvars["urlspic"], $matches)) {
					$imgfile = $package->getDir("imagedir") . "/" . $id . "s" . $matches[1];
					jieqi_checkdir(dirname($imgfile), true);
					jieqi_writefile($imgfile, jieqi_urlcontents($postvars["urlspic"]));
					jieqi_article_coverdo($imgfile, "s");
				}
			}
		}

		return $article;
	}
}

function jieqi_article_delete($aid, $batch = false)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqi_file_postfix;
	global $jieqiAction;
	global $article_handler;
	global $chapter_handler;
	global $query;

	if (!isset($jieqiAction["article"])) {
		jieqi_getconfigs("article", "action", "jieqiAction");
	}

	$article = $article_handler->get($aid);

	if (!is_object($article)) {
		return false;
	}

	$article_handler->delete($aid);
	$package = new JieqiPackage($aid);
	$package->delete();

	if (!$batch) {
		$posterary = array();

		if (!empty($jieqiAction["article"]["chapteradd"]["earnscore"])) {
			$criteria0 = new CriteriaCompo(new Criteria("articleid", $aid, "="));
			$chapter_handler->queryObjects($criteria0);

			while ($chapterobj = $chapter_handler->getObject()) {
				$posterid = intval($chapterobj->getVar("posterid"));

				if (isset($posterary[$posterid])) {
					$posterary[$posterid] += $jieqiAction["article"]["chapteradd"]["earnscore"];
				}
				else {
					$posterary[$posterid] = $jieqiAction["article"]["chapteradd"]["earnscore"];
				}
			}

			unset($criteria0);
		}
	}

	$criteria = new CriteriaCompo(new Criteria("articleid", $aid, "="));
	$chapter_handler->delete($criteria);
	include_once jieqi_path_inc("class/articleattachs.php", "article");
	$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
	$attachs_handler->delete($criteria);
	$criteria1 = new CriteriaCompo(new Criteria("ownerid", $aid, "="));
	include_once jieqi_path_inc("class/reviews.php", "article");
	$reviews_handler = &JieqiReviewsHandler::getInstance("JieqiReviewsHandler");
	$reviews_handler->delete($criteria1);
	include_once jieqi_path_inc("class/replies.php", "article");
	$replies_handler = &JieqiRepliesHandler::getInstance("JieqiRepliesHandler");
	$replies_handler->delete($criteria1);
	include_once jieqi_path_inc("class/bookcase.php", "article");
	$bookcase_handler = &JieqiBookcaseHandler::getInstance("JieqiBookcaseHandler");
	$bookcase_handler->delete($criteria);
	$imagedir = jieqi_uploadpath($jieqiConfigs["article"]["imagedir"], "article") . jieqi_getsubdir($aid) . "/" . $aid;

	if (is_dir($imagedir)) {
		jieqi_delfolder($imagedir, true);
	}

	if ((0 < $article->getVar("isvip", "n")) && (0 < $article->getVar("vipid", "n"))) {
		$obookid = intval($article->getVar("vipid", "n"));
		global $obook_handler;

		if (!is_a($obook_handler, "JieqiObookHandler")) {
			include_once jieqi_path_inc("class/obook.php", "obook");
			$obook_handler = &JieqiObookHandler::getInstance("JieqiObookHandler");
		}

		$obook = $obook_handler->get($obookid);

		if (is_object($obook)) {
			if (!is_a($query, "JieqiQueryHandler")) {
				jieqi_includedb();
				$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
			}

			if ($obook->getVar("sumemoney", "n") == 0) {
				$obook_handler->delete($obookid);
			}

			if ($obook->getVar("sumegold", "n") == 0) {
				$sql = "DELETE FROM " . jieqi_dbprefix("obook_ocontent") . " WHERE ochapterid IN (SELECT ochapterid FROM " . jieqi_dbprefix("obook_ochapter") . " WHERE obookid = $obookid)";
				$query->execute($sql);
				$sql = "DELETE FROM " . jieqi_dbprefix("obook_ochapter") . " WHERE obookid = $obookid";
				$query->execute($sql);
			}
			else {
				$sql = "DELETE FROM " . jieqi_dbprefix("obook_ocontent") . " WHERE ochapterid IN (SELECT ochapterid FROM " . jieqi_dbprefix("obook_ochapter") . " WHERE obookid = $obookid AND sumegold = 0)";
				$query->execute($sql);
				$sql = "DELETE FROM " . jieqi_dbprefix("obook_ochapter") . " WHERE obookid = $obookid AND sumegold = 0";
				$query->execute($sql);
				$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET display = 2 WHERE obookid = $obookid";
				$query->execute($sql);
			}
		}
	}

	if (!$batch) {
		include_once jieqi_path_inc("class/articlelog.php", "article");
		$articlelog_handler = &JieqiArticlelogHandler::getInstance("JieqiArticlelogHandler");
		$newlog = $articlelog_handler->create();
		$newlog->setVar("siteid", $article->getVar("siteid", "n"));
		$newlog->setVar("logtime", JIEQI_NOW_TIME);
		$newlog->setVar("userid", $_SESSION["jieqiUserId"]);
		$newlog->setVar("username", $_SESSION["jieqiUserName"]);
		$newlog->setVar("articleid", $article->getVar("articleid", "n"));
		$newlog->setVar("articlename", $article->getVar("articlename", "n"));
		$newlog->setVar("chapterid", 0);
		$newlog->setVar("chaptername", "");
		$newlog->setVar("reason", "");
		$newlog->setVar("chginfo", $jieqiLang["article"]["delete_article"]);
		$newlog->setVar("chglog", "");
		$newlog->setVar("ischapter", "0");
		$newlog->setVar("isdel", "1");
		$newlog->setVar("databak", serialize($article->getVars()));
		$articlelog_handler->insert($newlog);
	}

	if (!$batch) {
		include_once jieqi_path_inc("class/users.php", "system");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");

		if (!empty($jieqiAction["article"]["articleadd"]["earnscore"])) {
			$posterid = intval($article->getVar("posterid"));

			if (isset($posterary[$posterid])) {
				$posterary[$posterid] += $jieqiAction["article"]["articleadd"]["earnscore"];
			}
			else {
				$posterary[$posterid] = $jieqiAction["article"]["articleadd"]["earnscore"];
			}
		}

		foreach ($posterary as $pid => $pscore ) {
			$users_handler->changeScore($pid, $pscore, false);
		}
	}

	if (2 <= floatval(JIEQI_VERSION)) {
		include_once jieqi_path_inc("include/funtag.php", "system");
		$tags = jieqi_tag_clean($article->getVar("keywords", "n"));
		jieqi_tag_delete($tags, $article->getVar("articleid", "n"), array("tag" => jieqi_dbprefix("article_tag"), "taglink" => jieqi_dbprefix("article_taglink")));
	}

	if (!$batch) {
		jieqi_article_updateinfo($article, "articledel");
	}

	return $article;
}

function jieqi_article_clean($aid, $batch = false)
{
	global $jieqiModules;
	global $article_handler;
	global $chapter_handler;
	global $jieqiConfigs;
	global $jieqiAction;
	global $query;

	if (!isset($jieqiAction["article"])) {
		jieqi_getconfigs("article", "action", "jieqiAction");
	}

	$article = $article_handler->get($aid);

	if (!is_object($article)) {
		return false;
	}

	$criteria = new CriteriaCompo(new Criteria("articleid", $aid));
	$fields = array("lastchapter" => "", "lastchapterid" => 0, "lastvolume" => "", "lastvolumeid" => 0, "chapters" => 0, "size" => 0, "freesize" => 0);
	$article_handler->updatefields($fields, $criteria);
	$package = new JieqiPackage($aid);
	$package->delete();
	$package->initPackage($article->getVars("n"), true);

	if (!$batch) {
		$posterary = array();

		if (!empty($jieqiAction["article"]["chapteradd"]["earnscore"])) {
			$criteria0 = new CriteriaCompo(new Criteria("articleid", $aid, "="));
			$chapter_handler->queryObjects($criteria0);

			while ($chapterobj = $chapter_handler->getObject()) {
				$posterid = intval($chapterobj->getVar("posterid"));

				if (isset($posterary[$posterid])) {
					$posterary[$posterid] += $jieqiAction["article"]["chapteradd"]["earnscore"];
				}
				else {
					$posterary[$posterid] = $jieqiAction["article"]["chapteradd"]["earnscore"];
				}
			}

			unset($criteria0);
		}
	}

	$criteria = new CriteriaCompo(new Criteria("articleid", $aid, "="));
	$chapter_handler->delete($criteria);
	include_once jieqi_path_inc("class/articleattachs.php", "article");
	$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
	$attachs_handler->delete($criteria);
	if ((0 < $article->getVar("isvip", "n")) && (0 < $article->getVar("vipid", "n"))) {
		$obookid = intval($article->getVar("vipid", "n"));
		global $obook_handler;

		if (!is_a($obook_handler, "JieqiObookHandler")) {
			include_once jieqi_path_inc("class/obook.php", "obook");
			$obook_handler = &JieqiObookHandler::getInstance("JieqiObookHandler");
		}

		$obook = $obook_handler->get($obookid);

		if (is_object($obook)) {
			if (!is_a($query, "JieqiQueryHandler")) {
				jieqi_includedb();
				$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
			}

			if ($obook->getVar("sumemoney", "n") == 0) {
				$obook_handler->delete($obookid);
			}

			if ($obook->getVar("sumegold", "n") == 0) {
				$sql = "DELETE FROM " . jieqi_dbprefix("obook_ocontent") . " WHERE ochapterid IN (SELECT ochapterid FROM " . jieqi_dbprefix("obook_ochapter") . " WHERE obookid = $obookid)";
				$query->execute($sql);
				$sql = "DELETE FROM " . jieqi_dbprefix("obook_ochapter") . " WHERE obookid = $obookid";
				$query->execute($sql);
			}
			else {
				$sql = "DELETE FROM " . jieqi_dbprefix("obook_ocontent") . " WHERE ochapterid IN (SELECT ochapterid FROM " . jieqi_dbprefix("obook_ochapter") . " WHERE obookid = $obookid AND sumegold = 0)";
				$query->execute($sql);
				$sql = "DELETE FROM " . jieqi_dbprefix("obook_ochapter") . " WHERE obookid = $obookid AND sumegold = 0";
				$query->execute($sql);
				$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET display = 2 WHERE obookid = $obookid";
				$query->execute($sql);
			}
		}
	}

	if (!$batch) {
		include_once jieqi_path_inc("class/users.php", "system");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");

		if (!empty($jieqiAction["article"]["articleadd"]["earnscore"])) {
			$posterid = intval($article->getVar("posterid"));

			if (isset($posterary[$posterid])) {
				$posterary[$posterid] += $jieqiAction["article"]["articleadd"]["earnscore"];
			}
			else {
				$posterary[$posterid] = $jieqiAction["article"]["articleadd"]["earnscore"];
			}
		}

		foreach ($posterary as $pid => $pscore ) {
			$users_handler->changeScore($pid, $pscore, false);
		}
	}

	if (!$batch) {
		jieqi_article_updateinfo(0);
	}

	return $article;
}

function jieqi_article_delchapter($aid, $criteria, $batch = false)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiAction;
	global $article_handler;
	global $chapter_handler;
	global $jieqi_file_postfix;

	if (!isset($jieqiAction["article"])) {
		jieqi_getconfigs("article", "action", "jieqiAction");
	}

	if (!is_object($criteria)) {
		return false;
	}

	$criteria->add(new Criteria("articleid", intval($aid)));
	$article = $article_handler->get($aid);

	if (!is_object($article)) {
		return false;
	}

	$posterary = array();
	$chapter_handler->queryObjects($criteria);
	$chapterary = array();
	$k = 0;
	$cids = "";
	$lastchapterid = intval($article->getVar("lastchapterid"));
	$lastvolumeid = intval($article->getVar("lastvolumeid"));
	$vipchapterid = intval($article->getVar("vipchapterid"));
	$vipvolumeid = intval($article->getVar("vipvolumeid"));
	$uplastchapter = false;
	$uplastvolume = false;
	$upvipchapter = false;
	$upvipvolume = false;
	$subdaysize = 0;
	$subweeksize = 0;
	$submonthsize = 0;
	$subsize = 0;
	$subfreesize = 0;
	$subvipsize = 0;
	$tmpvar = explode("-", date("Y-m-d", JIEQI_NOW_TIME));
	$daystart = mktime(0, 0, 0, (int) $tmpvar[1], (int) $tmpvar[2], (int) $tmpvar[0]);
	$monthstart = mktime(0, 0, 0, (int) $tmpvar[1], 1, (int) $tmpvar[0]);
	$tmpvar = date("w", JIEQI_NOW_TIME);

	if ($tmpvar == 0) {
		$tmpvar = 7;
	}

	$weekstart = $daystart;

	if (1 < $tmpvar) {
		$weekstart -= ($tmpvar - 1) * 86400;
	}

	while ($chapterobj = $chapter_handler->getObject()) {
		$chapterary[$k]["id"] = intval($chapterobj->getVar("chapterid"));

		if ($chapterary[$k]["id"] == $lastchapterid) {
			$uplastchapter = true;
		}

		if ($chapterary[$k]["id"] == $lastvolumeid) {
			$uplastvolume = true;
		}

		if ($chapterary[$k]["id"] == $vipchapterid) {
			$upvipchapter = true;
		}

		if ($chapterary[$k]["id"] == $vipvolumeid) {
			$upvipvolume = true;
		}

		if ($cids != "") {
			$cids .= ",";
		}

		$cids .= $chapterary[$k]["id"];
		$chapterary[$k]["size"] = intval($chapterobj->getVar("size", "n"));
		$clastupdate = intval($chapterobj->getVar("lastupdate", "n"));

		if ($daystart <= $clastupdate) {
			$subdaysize += $chapterary[$k]["size"];
		}

		if ($weekstart <= $clastupdate) {
			$subweeksize += $chapterary[$k]["size"];
		}

		if ($monthstart <= $clastupdate) {
			$submonthsize += $chapterary[$k]["size"];
		}

		$subsize += $chapterary[$k]["size"];

		if (0 < intval($chapterobj->getVar("isvip", "n"))) {
			$subvipsize += $chapterary[$k]["size"];
		}
		else {
			$subfreesize += $chapterary[$k]["size"];
		}

		$chapterary[$k]["attach"] = ($chapterobj->getVar("attachment", "n") == "" ? 0 : 1);
		$chapterary[$k]["chapterorder"] = intval($chapterobj->getVar("chapterorder"));
		$chapterary[$k]["saleprice"] = intval($chapterobj->getVar("saleprice"));
		$chapterary[$k]["isimage"] = intval($chapterobj->getVar("isimage"));
		$chapterary[$k]["isvip"] = intval($chapterobj->getVar("isvip"));
		$chapterary[$k]["chaptertype"] = intval($chapterobj->getVar("chaptertype"));
		$chapterary[$k]["power"] = intval($chapterobj->getVar("power"));
		$k++;

		if (!empty($jieqiAction["article"]["chapteradd"]["earnscore"])) {
			$posterid = intval($chapterobj->getVar("posterid"));

			if (isset($posterary[$posterid])) {
				$posterary[$posterid] += $jieqiAction["article"]["chapteradd"]["earnscore"];
			}
			else {
				$posterary[$posterid] = $jieqiAction["article"]["chapteradd"]["earnscore"];
			}
		}
	}

	$chapter_handler->delete($criteria);

	if ($cids != "") {
		$criteria1 = new CriteriaCompo();
		$criteria1->add(new Criteria("chapterid", "(" . $cids . ")", "IN"));
		include_once jieqi_path_inc("class/articleattachs.php", "article");
		$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
		$attachs_handler->delete($criteria1);
	}

	$htmldir = jieqi_uploadpath($jieqiConfigs["article"]["htmldir"], "article") . jieqi_getsubdir($aid) . "/" . $aid;
	$txtjsdir = jieqi_uploadpath($jieqiConfigs["article"]["txtjsdir"], "article") . jieqi_getsubdir($aid) . "/" . $aid;
	$attachdir = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article") . jieqi_getsubdir($aid) . "/" . $aid;

	foreach ($chapterary as $c ) {
		jieqi_delete_achapterc($aid, $c["id"], intval($c["isvip"]), intval($c["chaptertype"]));

		if (is_file($htmldir . "/" . $c["id"] . $jieqiConfigs["article"]["htmlfile"])) {
			jieqi_delfile($htmldir . "/" . $c["id"] . $jieqiConfigs["article"]["htmlfile"]);
		}

		if (is_file($txtjsdir . "/" . $c["id"] . $jieqi_file_postfix["js"])) {
			jieqi_delfile($txtjsdir . "/" . $c["id"] . $jieqi_file_postfix["js"]);
		}

		if (is_dir($attachdir . "/" . $c["id"])) {
			jieqi_delfolder($attachdir . "/" . $c["id"]);
		}
	}

	include_once jieqi_path_inc("include/repack.php", "article");
	$ptypes = array("makeopf" => 1, "makehtml" => $jieqiConfigs["article"]["makehtml"], "maketxtjs" => $jieqiConfigs["article"]["maketxtjs"], "makezip" => $jieqiConfigs["article"]["makezip"], "makefull" => $jieqiConfigs["article"]["makefull"], "maketxtfull" => $jieqiConfigs["article"]["maketxtfull"], "makeumd" => $jieqiConfigs["article"]["makeumd"], "makejar" => $jieqiConfigs["article"]["makejar"]);
	article_repack($aid, $ptypes, 0);

	if (!$batch) {
		include_once jieqi_path_inc("class/users.php", "system");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");

		if (!empty($jieqiAction["article"]["articleadd"]["earnscore"])) {
			$posterid = intval($article->getVar("posterid"));

			if (isset($posterary[$posterid])) {
				$posterary[$posterid] += $jieqiAction["article"]["articleadd"]["earnscore"];
			}
			else {
				$posterary[$posterid] = $jieqiAction["article"]["articleadd"]["earnscore"];
			}
		}

		foreach ($posterary as $pid => $pscore ) {
			$users_handler->changeScore($pid, $pscore, false);
		}
	}

	$newdaysize = ($subdaysize < intval($article->getVar("daysize", "n")) ? intval($article->getVar("daysize", "n")) - $subdaysize : 0);
	$newweeksize = ($subweeksize < intval($article->getVar("weeksize", "n")) ? intval($article->getVar("weeksize", "n")) - $subweeksize : 0);
	$newmonthsize = ($submonthsize < intval($article->getVar("monthsize", "n")) ? intval($article->getVar("monthsize", "n")) - $submonthsize : 0);
	$newsize = ($subsize < intval($article->getVar("size", "n")) ? intval($article->getVar("size", "n")) - $subsize : 0);
	$freesize = ($subfreesize < intval($article->getVar("freesize", "n")) ? intval($article->getVar("freesize", "n")) - $subfreesize : 0);
	$vipsize = ($subvipsize < intval($article->getVar("vipsize", "n")) ? intval($article->getVar("vipsize", "n")) - $subvipsize : 0);
	$article->setVar("daysize", $newdaysize);
	$article->setVar("weeksize", $newweeksize);
	$article->setVar("monthsize", $newmonthsize);
	$article->setVar("size", $newsize);
	$article->setVar("freesize", $freesize);
	$article->setVar("vipsize", $vipsize);
	if ($uplastchapter || $uplastvolume) {
		if ($uplastchapter) {
			$lastinfo = jieqi_article_searchlast($article, "lastchapter");
			$article->setVar("lastchapter", $lastinfo["name"]);
			$article->setVar("lastchapterid", $lastinfo["id"]);
			$article->setVar("lastsummary", $lastinfo["summary"]);
		}

		$lastinfo = jieqi_article_searchlast($article, "lastvolume");
		$article->setVar("lastvolume", $lastinfo["name"]);
		$article->setVar("lastvolumeid", $lastinfo["id"]);
	}

	if ($upvipchapter || $upvipvolume) {
		if ($upvipchapter) {
			$lastinfo = jieqi_article_searchlast($article, "vipchapter");
			$article->setVar("vipchapter", $lastinfo["name"]);
			$article->setVar("vipchapterid", $lastinfo["id"]);
			$article->setVar("vipsummary", $lastinfo["summary"]);
		}

		$lastinfo = jieqi_article_searchlast($article, "vipvolume");
		$article->setVar("vipvolume", $lastinfo["name"]);
		$article->setVar("vipvolumeid", $lastinfo["id"]);
	}

	$article_handler->insert($article);

	if (!$batch) {
		jieqi_article_updateinfo(0);
	}

	return $article;
}

function jieqi_article_delonechapter($chapter, $article = NULL, $batch = false)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiAction;
	global $article_handler;
	global $chapter_handler;
	global $jieqi_file_postfix;

	if (!isset($jieqiAction["article"])) {
		jieqi_getconfigs("article", "action", "jieqiAction");
	}

	if (!is_object($chapter)) {
		$chapter = $chapter_handler->get(intval($chapter));

		if (!$chapter) {
			return false;
		}

		$article = $article_handler->get($chapter->getVar("articleid"));

		if (!$article) {
			return false;
		}
	}

	$chapterid = intval($chapter->getVar("chapterid", "n"));
	$isvip = intval($chapter->getVar("isvip", "n"));
	$chapter_handler->delete($chapterid);

	if ($chapter->getVar("chapterorder") < $article->getVar("chapters")) {
		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->add(new Criteria("chapterorder", $chapter->getVar("chapterorder"), ">"));
		$chapter_handler->updatefields("chapterorder = chapterorder - 1", $criteria);
	}

	unset($criteria);
	$updateblock = false;
	if (($chapterid == $article->getVar("lastchapterid")) || ($chapterid == $article->getVar("lastvolumeid"))) {
		if ($chapterid == $article->getVar("lastchapterid")) {
			$lastinfo = jieqi_article_searchlast($article, "lastchapter");
			$article->setVar("lastchapter", $lastinfo["name"]);
			$article->setVar("lastchapterid", $lastinfo["id"]);
			$article->setVar("lastsummary", $lastinfo["summary"]);
		}

		$lastinfo = jieqi_article_searchlast($article, "lastvolume");
		$article->setVar("lastvolume", $lastinfo["name"]);
		$article->setVar("lastvolumeid", $lastinfo["id"]);
		$updateblock = true;
	}
	else {
		if (($chapterid == $article->getVar("vipchapterid")) || ($chapterid == $article->getVar("vipvolumeid"))) {
			if ($chapterid == $article->getVar("vipchapterid")) {
				$lastinfo = jieqi_article_searchlast($article, "vipchapter");
				$article->setVar("vipchapter", $lastinfo["name"]);
				$article->setVar("vipchapterid", $lastinfo["id"]);
				$article->setVar("vipsummary", $lastinfo["summary"]);
			}

			$lastinfo = jieqi_article_searchlast($article, "vipvolume");
			$article->setVar("vipvolume", $lastinfo["name"]);
			$article->setVar("vipvolumeid", $lastinfo["id"]);
			$updateblock = true;
		}
	}

	$article->setVar("chapters", $article->getVar("chapters") - 1);

	if (0 < $isvip) {
		$article->setVar("vipchapters", $article->getVar("vipchapters") - 1);
	}

	$subdaysize = 0;
	$subweeksize = 0;
	$submonthsize = 0;
	$subsize = 0;
	$tmpvar = explode("-", date("Y-m-d", JIEQI_NOW_TIME));
	$daystart = mktime(0, 0, 0, (int) $tmpvar[1], (int) $tmpvar[2], (int) $tmpvar[0]);
	$monthstart = mktime(0, 0, 0, (int) $tmpvar[1], 1, (int) $tmpvar[0]);
	$tmpvar = date("w", JIEQI_NOW_TIME);

	if ($tmpvar == 0) {
		$tmpvar = 7;
	}

	$weekstart = $daystart;

	if (1 < $tmpvar) {
		$weekstart -= ($tmpvar - 1) * 86400;
	}

	$clastupdate = intval($chapter->getVar("lastupdate", "n"));

	if ($daystart <= $clastupdate) {
		$subdaysize += intval($chapter->getVar("size", "n"));
	}

	if ($weekstart <= $clastupdate) {
		$subweeksize += intval($chapter->getVar("size", "n"));
	}

	if ($monthstart <= $clastupdate) {
		$submonthsize += intval($chapter->getVar("size", "n"));
	}

	$subsize += intval($chapter->getVar("size", "n"));
	$newdaysize = ($subdaysize < intval($article->getVar("daysize", "n")) ? intval($article->getVar("daysize", "n")) - $subdaysize : 0);
	$newweeksize = ($subweeksize < intval($article->getVar("weeksize", "n")) ? intval($article->getVar("weeksize", "n")) - $subweeksize : 0);
	$newmonthsize = ($submonthsize < intval($article->getVar("monthsize", "n")) ? intval($article->getVar("monthsize", "n")) - $submonthsize : 0);
	$newsize = ($subsize < intval($article->getVar("size", "n")) ? intval($article->getVar("size", "n")) - $subsize : 0);
	$article->setVar("daysize", $newdaysize);
	$article->setVar("weeksize", $newweeksize);
	$article->setVar("monthsize", $newmonthsize);
	$article->setVar("size", $newsize);

	if (0 < $isvip) {
		$vipsize = ($subsize < intval($article->getVar("vipsize", "n")) ? intval($article->getVar("vipsize", "n")) - $subsize : 0);
		$article->setVar("vipsize", $vipsize);
	}
	else {
		$freesize = ($subsize < intval($article->getVar("freesize", "n")) ? intval($article->getVar("freesize", "n")) - $subsize : 0);
		$article->setVar("freesize", $freesize);
	}

	$article_handler->insert($article);
	include_once jieqi_path_inc("class/articleattachs.php", "article");
	$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
	$criteria = new CriteriaCompo(new Criteria("chapterid", $chapterid));
	$attachs_handler->delete($criteria);

	if (!$batch) {
		include_once jieqi_path_inc("class/users.php", "system");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
		jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
		$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
		$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);

		if (!empty($jieqiAction["article"]["chapteradd"]["earnscore"])) {
			$users_handler->changeScore($chapter->getVar("posterid"), $jieqiAction["article"]["chapteradd"]["earnscore"], false);
		}
	}

	include_once jieqi_path_inc("class/package.php", "article");
	$package = new JieqiPackage($article->getVar("articleid"));
	$package->delChapter($chapter);
	return $updateblock;
}

function jieqi_article_chapterset($chapter, $article = NULL, $action = "free")
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiAction;
	global $article_handler;
	global $chapter_handler;
	global $obook_handler;
	global $ochapter_handler;
	global $ocontent_handler;
	global $jieqi_file_postfix;
	global $query;

	if (!in_array($action, array("vip", "free", "show", "hide"))) {
		return false;
	}

	if (!is_object($chapter)) {
		$chapter = $chapter_handler->get(intval($chapter));

		if (!$chapter) {
			return false;
		}

		$article = $article_handler->get($chapter->getVar("articleid"));

		if (!$article) {
			return false;
		}
	}

	$articleid = intval($chapter->getVar("articleid", "n"));
	$chapterid = intval($chapter->getVar("chapterid", "n"));
	$isvip = intval($chapter->getVar("isvip", "n"));
	$display = intval($chapter->getVar("display", "n"));

	switch ($action) {
	case "show":
		if ($display == 0) {
			return false;
		}

		$chapter->setVar("display", 0);
		$chapter_handler->insert($chapter);

		if (0 < $isvip) {
			if (!is_a($ochapter_handler, "JieqiOchapterHandler")) {
				include_once jieqi_path_inc("class/ochapter.php", "obook");
				$ochapter_handler = &JieqiOchapterHandler::getInstance("JieqiOchapterHandler");
			}

			$ochapter = $ochapter_handler->get($chapterid, "chapterid");

			if (is_object($ochapter)) {
				$ochapter->setVar("display", 0);
				$ochapter_handler->insert($ochapter);
			}
		}

		break;

	case "hide":
		if ($display == 1) {
			return false;
		}

		$chapter->setVar("display", 1);
		$chapter_handler->insert($chapter);

		if (0 < $isvip) {
			if (!is_a($ochapter_handler, "JieqiOchapterHandler")) {
				include_once jieqi_path_inc("class/ochapter.php", "obook");
				$ochapter_handler = &JieqiOchapterHandler::getInstance("JieqiOchapterHandler");
			}

			$ochapter = $ochapter_handler->get($chapterid, "chapterid");

			if (is_object($ochapter)) {
				$ochapter->setVar("display", 1);
				$ochapter_handler->insert($ochapter);
			}
		}

		break;

	case "free":
		if ($isvip == 0) {
			return false;
		}

		$chapter->setVar("isvip", 0);
		$chapter_handler->insert($chapter);
		include_once jieqi_path_inc("class/package.php", "article");
		jieqi_convert_achapterc($articleid, $chapterid, "free");

		if (!is_a($ochapter_handler, "JieqiOchapterHandler")) {
			include_once jieqi_path_inc("class/ochapter.php", "obook");
			$ochapter_handler = &JieqiOchapterHandler::getInstance("JieqiOchapterHandler");
		}

		if (!is_a($ocontent_handler, "JieqiOcontentHandler")) {
			include_once jieqi_path_inc("class/ocontent.php", "obook");
			$ocontent_handler = &JieqiOcontentHandler::getInstance("JieqiOcontentHandler");
		}

		$ochapter = $ochapter_handler->get($chapterid, "chapterid");

		if (is_object($ochapter)) {
			if (intval($ochapter->getVar("sumegold", "n")) == 0) {
				$ochapter_handler->delete($chapterid, "chapterid");
				$ocontent_handler->delete($chapterid, "ochapterid");

				if (!is_a($query, "JieqiQueryHandler")) {
					jieqi_includedb();
					$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
				}

				$sql = "UPDATE  " . jieqi_dbprefix("obook_obook") . " SET chapters = chapters - 1 WHERE articleid = " . intval($articleid) . " AND chapters > 0";
				$query->execute($sql);
			}
			else {
				$ochapter->setVar("display", 2);
				$ochapter_handler->insert($ochapter);
			}
		}

		break;

	case "vip":
		if (0 < $isvip) {
			return false;
		}

		if (!isset($jieqiConfigs["article"])) {
			jieqi_getconfigs("article", "configs");
		}

		if (!isset($jieqiConfigs["obook"])) {
			jieqi_getconfigs("obook", "configs");
		}

		$saleprice = intval($chapter->getVar("saleprice", "n"));
		$chaptersize = intval($chapter->getVar("size", "n"));
		$chapterwords = jieqi_sizeformat($chaptersize, "c");
		$wordspricing = (isset($jieqiConfigs["obook"]["wordspricing"]) && is_numeric($jieqiConfigs["obook"]["wordspricing"]) && (0 < $jieqiConfigs["obook"]["wordspricing"]) ? intval($jieqiConfigs["obook"]["wordspricing"]) : 1);
		if (($wordspricing <= $chapterwords) && is_numeric($jieqiConfigs["obook"]["wordsperegold"]) && (0 < $jieqiConfigs["obook"]["wordsperegold"])) {
			$wordsperegold = floatval($jieqiConfigs["obook"]["wordsperegold"]);
			if (isset($jieqiConfigs["obook"]["wordsstep"]) && is_numeric($jieqiConfigs["obook"]["wordsstep"]) && (1 < $jieqiConfigs["obook"]["wordsstep"])) {
				$wordsstep = intval($jieqiConfigs["obook"]["wordsstep"]);

				if ($jieqiConfigs["obook"]["priceround"] == 1) {
					$saleprice = floor($chapterwords / $wordsstep) * round($wordsstep / $wordsperegold);
				}
				else if ($jieqiConfigs["obook"]["priceround"] == 2) {
					$saleprice = ceil($chapterwords / $wordsstep) * round($wordsstep / $wordsperegold);
				}
				else {
					$saleprice = round($chapterwords / $wordsstep) * round($wordsstep / $wordsperegold);
				}
			}
			else if ($jieqiConfigs["obook"]["priceround"] == 1) {
				$saleprice = floor($chapterwords / $wordsperegold);
			}
			else if ($jieqiConfigs["obook"]["priceround"] == 2) {
				$saleprice = ceil($chapterwords / $wordsperegold);
			}
			else {
				$saleprice = round($chapterwords / $wordsperegold);
			}

			$chapter->setVar("saleprice", $saleprice);
		}

		$chapter->setVar("isvip", 1);
		$chapter_handler->insert($chapter);
		include_once jieqi_path_inc("class/package.php", "article");
		jieqi_convert_achapterc($articleid, $chapterid, "vip");

		if (!is_a($obook_handler, "JieqiObookHandler")) {
			include_once jieqi_path_inc("class/obook.php", "obook");
			$obook_handler = &JieqiObookHandler::getInstance("JieqiObookHandler");
		}

		if (!is_a($ochapter_handler, "JieqiOchapterHandler")) {
			include_once jieqi_path_inc("class/ochapter.php", "obook");
			$ochapter_handler = &JieqiOchapterHandler::getInstance("JieqiOchapterHandler");
		}

		$ochapter = $ochapter_handler->get($chapterid, "chapterid");

		if (is_object($ochapter)) {
			if (!is_a($query, "JieqiQueryHandler")) {
				jieqi_includedb();
				$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
			}

			$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET lastupdate = '" . intval($chapter->getVar("lastupdate", "n")) . "', chaptername = '" . jieqi_dbslashes($chapter->getVar("chaptername", "n")) . "', summary = '" . jieqi_dbslashes($chapter->getVar("summary", "n")) . "', size = '" . intval($chapter->getVar("size", "n")) . "', saleprice = '" . intval($chapter->getVar("saleprice", "n")) . "', display = 0 WHERE chapterid = " . intval($chapter->getVar("chapterid", "n"));
			$query->execute($sql);
		}
		else {
			$obookid = intval($chapter->getVar("vipid", "n"));

			if ($obookid == 0) {
				include_once jieqi_path_inc("include/actobook.php", "obook");
				$obook = jieqi_obook_autocreate($article, 1);

				if (!is_object($obook)) {
					jieqi_printfail($obook);
				}

				$obookid = intval($obook->getVar("obookid", "n"));
			}

			$ochapter = $ochapter_handler->create();
			$ochapter->setVar("ochapterid", $chapter->getVar("chapterid", "n"));
			$ochapter->setVar("siteid", $chapter->getVar("siteid", "n"));
			$ochapter->setVar("sourceid", $chapter->getVar("sourceid", "n"));
			$ochapter->setVar("sourcecid", $chapter->getVar("sourcecid", "n"));
			$ochapter->setVar("obookid", $obookid);
			$ochapter->setVar("articleid", $chapter->getVar("articleid", "n"));
			$ochapter->setVar("chapterid", $chapter->getVar("chapterid", "n"));
			$ochapter->setVar("postdate", $chapter->getVar("postdate", "n"));
			$ochapter->setVar("lastupdate", $chapter->getVar("lastupdate", "n"));
			$ochapter->setVar("buytime", 0);
			$ochapter->setVar("obookname", $chapter->getVar("articlename", "n"));
			$ochapter->setVar("chaptername", $chapter->getVar("chaptername", "n"));
			$ochapter->setVar("chapterorder", $chapter->getVar("chapterorder", "n"));
			$ochapter->setVar("summary", $chapter->getVar("summary", "n"));
			$ochapter->setVar("size", $chapter->getVar("size", "n"));
			$ochapter->setVar("posterid", $chapter->getVar("posterid", "n"));
			$ochapter->setVar("poster", $chapter->getVar("poster", "n"));
			$ochapter->setVar("toptime", 0);
			$ochapter->setVar("picflag", $chapter->getVar("isimage", "n"));
			$ochapter->setVar("chaptertype", $chapter->getVar("chaptertype", "n"));
			$ochapter->setVar("saleprice", $chapter->getVar("saleprice", "n"));
			$ochapter->setVar("vipprice", $chapter->getVar("saleprice", "n"));
			$ochapter->setVar("sumegold", 0);
			$ochapter->setVar("sumesilver", 0);
			$ochapter->setVar("normalsale", 0);
			$ochapter->setVar("vipsale", 0);
			$ochapter->setVar("freesale", 0);
			$ochapter->setVar("bespsale", 0);
			$ochapter->setVar("totalsale", 0);
			$ochapter->setVar("daysale", 0);
			$ochapter->setVar("weeksale", 0);
			$ochapter->setVar("monthsale", 0);
			$ochapter->setVar("allsale", 0);
			$ochapter->setVar("lastsale", 0);
			$ochapter->setVar("state", 0);
			$ochapter->setVar("flag", 0);
			$ochapter->setVar("display", 0);
			$ochapter_handler->insert($ochapter);

			if (!is_a($query, "JieqiQueryHandler")) {
				jieqi_includedb();
				$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
			}

			$sql = "UPDATE  " . jieqi_dbprefix("obook_obook") . " SET chapters = chapters + 1 WHERE articleid = " . intval($articleid);
			$query->execute($sql);
		}

		break;

	default:
		return false;
		break;
	}

	$updateblock = false;
	if (($chapterid == $article->getVar("lastchapterid")) || ($chapterid == $article->getVar("lastvolumeid")) || ($chapterid == $article->getVar("vipchapterid")) || ($chapterid == $article->getVar("vipvolumeid"))) {
		$lastinfo = jieqi_article_searchlast($article, "all");
		$article->setVar("lastchapter", $lastinfo["lastchapter"]);
		$article->setVar("lastchapterid", $lastinfo["lastchapterid"]);
		$article->setVar("lastsummary", $lastinfo["lastsummary"]);
		$article->setVar("lastvolume", $lastinfo["lastvolume"]);
		$article->setVar("lastvolumeid", $lastinfo["lastvolumeid"]);
		$article->setVar("vipchapter", $lastinfo["vipchapter"]);
		$article->setVar("vipchapterid", $lastinfo["vipchapterid"]);
		$article->setVar("vipsummary", $lastinfo["vipsummary"]);
		$article->setVar("vipvolume", $lastinfo["vipvolume"]);
		$article->setVar("vipvolumeid", $lastinfo["vipvolumeid"]);
		$updateblock = true;
	}

	$subsize = intval($chapter->getVar("size", "n"));

	if ($action == "vip") {
		$article->setVar("vipchapters", $article->getVar("vipchapters") + 1);
		$article->setVar("vipsize", $article->getVar("vipsize") + $subsize);
		$article->setVar("freesize", $article->getVar("freesize") - $subsize);
	}
	else if ($action == "free") {
		$article->setVar("vipchapters", $article->getVar("vipchapters") - 1);
		$article->setVar("vipsize", $article->getVar("vipsize") - $subsize);
		$article->setVar("freesize", $article->getVar("freesize") + $subsize);
	}

	$article_handler->insert($article);
	include_once jieqi_path_inc("class/package.php", "article");
	$package = new JieqiPackage($article->getVar("articleid"));
	$package->setChapter($chapter);
	return $updateblock;
}

function jieqi_article_searchlast($article, $lasttype)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $article_handler;
	global $chapter_handler;
	$ret = array("id" => 0, "name" => "", "summary" => "");

	switch ($lasttype) {
	case "lastchapter":
		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid", "n")));
		$criteria->add(new Criteria("chaptertype", 0, "="));
		$criteria->add(new Criteria("isvip", 0, "="));
		$criteria->setSort("chapterorder");
		$criteria->setOrder("DESC");
		$criteria->setStart(0);
		$criteria->setLimit(1);
		$chapter_handler->queryObjects($criteria);
		$tmpchapter = $chapter_handler->getObject();

		if ($tmpchapter) {
			$ret = array("id" => $tmpchapter->getVar("chapterid", "n"), "name" => $tmpchapter->getVar("chaptername", "n"), "summary" => $tmpchapter->getVar("summary", "n"));
		}

		break;

	case "lastvolume":
		$lastchapterorder = 0;
		$lastchapterid = intval($article->getVar("lastchapterid", "n"));

		if (0 < $lastchapterid) {
			$tmpchapter = $chapter_handler->get($lastchapterid);

			if (is_object($tmpchapter)) {
				$lastchapterorder = intval($tmpchapter->getVar("chapterorder", "n"));
			}
		}

		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->add(new Criteria("chaptertype", 1, "="));

		if (0 < $lastchapterorder) {
			$criteria->add(new Criteria("chapterorder", $lastchapterorder, "<"));
		}

		$criteria->setSort("chapterorder");
		$criteria->setOrder("DESC");
		$criteria->setStart(0);
		$criteria->setLimit(1);
		$chapter_handler->queryObjects($criteria);
		$tmpchapter = $chapter_handler->getObject();

		if ($tmpchapter) {
			$ret = array("id" => $tmpchapter->getVar("chapterid", "n"), "name" => $tmpchapter->getVar("chaptername", "n"), "summary" => $tmpchapter->getVar("summary", "n"));
		}

		break;

	case "vipchapter":
		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->add(new Criteria("chaptertype", 0, "="));
		$criteria->add(new Criteria("isvip", 0, ">"));
		$criteria->setSort("chapterorder");
		$criteria->setOrder("DESC");
		$criteria->setStart(0);
		$criteria->setLimit(1);
		$chapter_handler->queryObjects($criteria);
		$tmpchapter = $chapter_handler->getObject();

		if ($tmpchapter) {
			$ret = array("id" => $tmpchapter->getVar("chapterid", "n"), "name" => $tmpchapter->getVar("chaptername", "n"), "summary" => $tmpchapter->getVar("summary", "n"));
		}

		break;

	case "vipvolume":
		$vipchapterorder = 0;
		$vipchapterid = intval($article->getVar("vipchapterid", "n"));

		if (0 < $vipchapterid) {
			$tmpchapter = $chapter_handler->get($vipchapterid);

			if (is_object($tmpchapter)) {
				$vipchapterorder = intval($tmpchapter->getVar("chapterorder", "n"));
			}
		}

		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->add(new Criteria("chaptertype", 1, "="));

		if (0 < $vipchapterorder) {
			$criteria->add(new Criteria("chapterorder", $vipchapterorder, "<"));
		}

		$criteria->setSort("chapterorder");
		$criteria->setOrder("DESC");
		$criteria->setStart(0);
		$criteria->setLimit(1);
		$chapter_handler->queryObjects($criteria);
		$tmpchapter = $chapter_handler->getObject();

		if ($tmpchapter) {
			$ret = array("id" => $tmpchapter->getVar("chapterid", "n"), "name" => $tmpchapter->getVar("chaptername", "n"), "summary" => $tmpchapter->getVar("summary", "n"));
		}

		break;

	case "all":
		$ret = array("lastchapterid" => 0, "lastchapter" => "", "lastsummary" => "", "lastvolumeid" => 0, "lastvolume" => "", "vipchapterid" => 0, "vipchapter" => "", "vipsummary" => "", "vipvolumeid" => 0, "vipvolume" => "");
		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->setSort("chapterorder");
		$criteria->setOrder("DESC");
		$chapter_handler->queryObjects($criteria);

		while ($tmpchapter = $chapter_handler->getObject()) {
			if ($tmpchapter->getVar("chaptertype", "n") == 0) {
				if ($tmpchapter->getVar("isvip", "n") == 0) {
					if ($ret["lastchapterid"] == 0) {
						$ret["lastchapterid"] = $tmpchapter->getVar("chapterid", "n");
						$ret["lastchapter"] = $tmpchapter->getVar("chaptername", "n");
						$ret["lastsummary"] = $tmpchapter->getVar("summary", "n");
					}
				}
				else if ($ret["vipchapterid"] == 0) {
					$ret["vipchapterid"] = $tmpchapter->getVar("chapterid", "n");
					$ret["vipchapter"] = $tmpchapter->getVar("chaptername", "n");
					$ret["vipsummary"] = $tmpchapter->getVar("summary", "n");
				}
			}
			else {
				if (($ret["lastvolumeid"] == 0) && (0 < $ret["lastchapterid"])) {
					$ret["lastvolumeid"] = $tmpchapter->getVar("chapterid", "n");
					$ret["lastvolume"] = $tmpchapter->getVar("chaptername", "n");
				}

				if (($ret["vipvolumeid"] == 0) && (0 < $ret["vipchapterid"])) {
					$ret["vipvolumeid"] = $tmpchapter->getVar("chapterid", "n");
					$ret["vipvolume"] = $tmpchapter->getVar("chaptername", "n");
				}
			}

			if ((0 < $ret["lastchapterid"]) && $ret["lastvolumeid"] && (($article->getVar("vipid", "n") == 0) || ((0 < $ret["vipchapterid"]) && (0 < $ret["vipvolumeid"])))) {
				break;
			}
		}

		break;

	case "full":
		$ret = array("lastchapterid" => 0, "lastchapter" => "", "lastsummary" => "", "lastvolumeid" => 0, "lastvolume" => "", "size" => 0, "chapters" => 0, "freetime" => 0, "freesize" => 0, "isvip" => $article->getVar("isvip", "n"), "vipchapterid" => 0, "vipchapter" => "", "vipsummary" => "", "vipvolumeid" => 0, "vipvolume" => "", "vipchapters" => 0, "vipsize" => 0, "viptime" => 0);
		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->setSort("chapterorder");
		$criteria->setOrder("DESC");
		$chapter_handler->queryObjects($criteria);

		while ($tmpchapter = $chapter_handler->getObject()) {
			$ret["chapters"] += 1;

			if ($tmpchapter->getVar("chaptertype", "n") == 0) {
				$ret["size"] += $tmpchapter->getVar("size", "n");

				if ($tmpchapter->getVar("isvip", "n") == 0) {
					if ($ret["lastchapterid"] == 0) {
						$ret["lastchapterid"] = $tmpchapter->getVar("chapterid", "n");
						$ret["lastchapter"] = $tmpchapter->getVar("chaptername", "n");
						$ret["lastsummary"] = $tmpchapter->getVar("summary", "n");
					}

					if ($ret["freetime"] < $tmpchapter->getVar("postdate", "n")) {
						$ret["freetime"] = $tmpchapter->getVar("postdate", "n");
					}

					$ret["freesize"] += $tmpchapter->getVar("size", "n");
				}
				else {
					if ($ret["vipchapterid"] == 0) {
						$ret["vipchapterid"] = $tmpchapter->getVar("chapterid", "n");
						$ret["vipchapter"] = $tmpchapter->getVar("chaptername", "n");
						$ret["vipsummary"] = $tmpchapter->getVar("summary", "n");
					}

					if ($ret["isvip"] == 0) {
						$ret["isvip"] = 1;
					}

					if ($ret["viptime"] < $tmpchapter->getVar("postdate", "n")) {
						$ret["viptime"] = $tmpchapter->getVar("postdate", "n");
					}

					$ret["vipsize"] += $tmpchapter->getVar("size", "n");
					$ret["vipchapters"] += 1;
				}
			}
			else {
				if (($ret["lastvolumeid"] == 0) && (0 < $ret["lastchapterid"])) {
					$ret["lastvolumeid"] = $tmpchapter->getVar("chapterid", "n");
					$ret["lastvolume"] = $tmpchapter->getVar("chaptername", "n");
				}

				if (($ret["vipvolumeid"] == 0) && (0 < $ret["vipchapterid"])) {
					$ret["vipvolumeid"] = $tmpchapter->getVar("chapterid", "n");
					$ret["vipvolume"] = $tmpchapter->getVar("chaptername", "n");
				}
			}
		}

		if (($ret["vipchapters"] == 0) && (0 < $ret["isvip"])) {
			$ret["isvip"] = 0;
		}

		break;
	}

	return $ret;
}

function jieqi_article_chapterpcheck(&$postvars, &$attachvars)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiLang;
	global $article_handler;
	global $chapter_handler;
	$errors = array();

	if (empty($jieqiLang["article"]["article"])) {
		jieqi_loadlang("article", "article");
	}

	if (empty($jieqiLang["article"]["draft"])) {
		jieqi_loadlang("draft", "article");
	}

	$postvars["chaptertype"] = intval($postvars["chaptertype"]);

	if (strlen($postvars["chaptername"]) == 0) {
		$errors[] = $jieqiLang["article"]["need_chapter_title"];
	}

	if (!isset($jieqiConfigs["system"])) {
		jieqi_getconfigs("system", "configs");
	}

	include_once jieqi_path_inc("include/checker.php", "system");
	$checker = new JieqiChecker();

	if (!empty($jieqiConfigs["system"]["postdenywords"])) {
		$matchwords1 = $checker->deny_words($postvars["chaptername"], $jieqiConfigs["system"]["postdenywords"], true);
		$matchwords2 = $checker->deny_words($postvars["chaptercontent"], $jieqiConfigs["system"]["postdenywords"], true);
		if (is_array($matchwords1) || is_array($matchwords2)) {
			if (!isset($jieqiLang["system"]["post"])) {
				jieqi_loadlang("post", "system");
			}

			$matchwords = array();

			if (is_array($matchwords1)) {
				$matchwords = array_merge($matchwords, $matchwords1);
			}

			if (is_array($matchwords2)) {
				$matchwords = array_merge($matchwords, $matchwords2);
			}

			$errors[] = sprintf($jieqiLang["system"]["post_words_deny"], implode(" ", jieqi_funtoarray("jieqi_htmlchars", $matchwords)));
		}
	}

	if ($postvars["uptiming"] == 1) {
//		$postvars["pubyear"] = intval(trim($postvars["pubyear"]));
//		$postvars["pubmonth"] = intval(trim($postvars["pubmonth"]));
//		$postvars["pubday"] = intval(trim($postvars["pubday"]));
//		$postvars["pubhour"] = intval(trim($postvars["pubhour"]));
//		$postvars["pubminute"] = intval(trim($postvars["pubminute"]));
//		$postvars["pubsecond"] = intval(trim($postvars["pubsecond"]));
//		$postvars["pubtime"] = @mktime($postvars["pubhour"], $postvars["pubminute"], $postvars["pubsecond"], $postvars["pubmonth"], $postvars["pubday"], $postvars["pubyear"]);
        $postvars["pubtime"] = strtotime($postvars["pubtime"]);

		if ($postvars["pubtime"] <= JIEQI_NOW_TIME) {
			$errors[] = $jieqiLang["article"]["uptiming_time_low"];
		}
	}

	$attachvars = array(
		"id"   => array(),
		"info" => array()
		);
	$attachnum = 0;
	if ($postvars["canupload"] && is_numeric($jieqiConfigs["article"]["maxattachnum"]) && (0 < $jieqiConfigs["article"]["maxattachnum"]) && isset($_FILES["attachfile"])) {
		$maxfilenum = intval($jieqiConfigs["article"]["maxattachnum"]);
		$typeary = explode(" ", trim($jieqiConfigs["article"]["attachtype"]));

		foreach ($typeary as $k => $v ) {
			if (substr($v, 0, 1) == ".") {
				$typeary[$k] = substr($typeary[$k], 1);
			}
		}

		foreach ($_FILES["attachfile"]["name"] as $k => $v ) {
			if (!empty($v)) {
				$tmpary = explode(".", $v);
				$tmpint = @jieqi_count($tmpary) - 1;
				$tmpary[$tmpint] = strtolower(trim($tmpary[$tmpint]));
				$denyary = array("htm", "html", "shtml", "php", "asp", "aspx", "jsp", "pl", "cgi");
				if (empty($tmpary[$tmpint]) || !in_array($tmpary[$tmpint], $typeary)) {
					$errors[] = sprintf($jieqiLang["article"]["upload_filetype_error"], $v);
				}
				else if (in_array($tmpary[$tmpint], $denyary)) {
					$errors[] = sprintf($jieqiLang["article"]["upload_filetype_limit"], $tmpary[$tmpint]);
				}

				if (preg_match("/\.(gif|jpg|jpeg|png|bmp)$/i", $v)) {
					$fclass = "image";

					if ((intval($jieqiConfigs["article"]["maximagesize"]) * 1024) < $_FILES["attachfile"]["size"][$k]) {
						$errors[] = sprintf($jieqiLang["article"]["upload_filesize_toolarge"], $v, intval($jieqiConfigs["article"]["maximagesize"]));
					}
				}
				else {
					$fclass = "file";

					if ((intval($jieqiConfigs["article"]["maxfilesize"]) * 1024) < $_FILES["attachfile"]["size"][$k]) {
						$errors[] = sprintf($jieqiLang["article"]["upload_filesize_toolarge"], $v, intval($jieqiConfigs["article"]["maxfilesize"]));
					}
				}

				if (!empty($errtext)) {
					jieqi_delfile($_FILES["attachfile"]["tmp_name"][$k]);
				}
				else {
					$attachvars["id"][$attachnum] = $k;
					$attachvars["info"][$attachnum] = array("name" => $v, "class" => $fclass, "postfix" => $tmpary[$tmpint], "size" => $_FILES["attachfile"]["size"][$k]);
					$attachnum++;
				}
			}
		}
	}

	if ((@jieqi_count($postvars["oldattach"]) == 0) && ($attachnum == 0) && ($postvars["chaptertype"] == 0) && (strlen($postvars["chaptercontent"]) == 0)) {
		$errors[] = $jieqiLang["article"]["need_chapter_content"];
	}

	if (empty($errors) && ($postvars["chaptertype"] == 0)) {
		if (isset($jieqiConfigs["system"]["postreplacewords"]) && !empty($jieqiConfigs["system"]["postreplacewords"])) {
			$checker->replace_words($postvars["chaptername"], $jieqiConfigs["system"]["postreplacewords"]);
			$checker->replace_words($postvars["chaptercontent"], $jieqiConfigs["system"]["postreplacewords"]);
		}

		if (($jieqiConfigs["article"]["authtypeset"] == 2) || (($jieqiConfigs["article"]["authtypeset"] == 1) && ($postvars["typeset"] == 1))) {
			include_once jieqi_path_lib("text/texttypeset.php");
			$texttypeset = new TextTypeset();
			$postvars["chaptercontent"] = $texttypeset->doTypeset($postvars["chaptercontent"]);
		}
	}

	return $errors;
}

function jieqi_article_addchapter(&$postvars, &$attachvars, &$article, $batch = false)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiOption;
	global $jieqiLang;
	global $jieqiAction;
	global $article_handler;
	global $chapter_handler;
	global $attachs_handler;
	global $draft_handler;

	if (!isset($jieqiConfigs["article"])) {
		jieqi_getconfigs("article", "configs");
	}

	if (!isset($jieqiConfigs["obook"])) {
		jieqi_getconfigs("obook", "configs");
	}

	if (!isset($jieqiOption["article"])) {
		jieqi_getconfigs("article", "option", "jieqiOption");
	}

	$postvars["chaptertype"] = intval($postvars["chaptertype"]);
	$postvars["articleid"] = (!empty($postvars["articleid"]) ? intval($postvars["articleid"]) : intval($article->getVar("articleid", "n")));
	$oldattachary = array();

	if (!empty($postvars["draftid"])) {
		$postvars["draftid"] = intval($postvars["draftid"]);

		if (!is_a($draft_handler, "JieqiDraftHandler")) {
			include_once jieqi_path_inc("class/draft.php", "article");
			$draft_handler = &JieqiDraftHandler::getInstance("JieqiDraftHandler");
		}

		$draft = $draft_handler->get($postvars["draftid"]);

		if (!is_object($draft)) {
			$postvars["draftid"] = 0;
		}

		$tmpattachary = @jieqi_unserialize($draft->getVar("attachment", "n"));
		if (is_array($tmpattachary) && (0 < @jieqi_count($tmpattachary))) {
			if (!is_a($attachs_handler, "JieqiArticleattachsHandler")) {
				include_once jieqi_path_inc("class/articleattachs.php", "article");
				$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
			}

			if (!is_array($postvars["oldattach"])) {
				if (is_string($postvars["oldattach"]) && (0 < strlen($postvars["oldattach"]))) {
					$postvars["oldattach"] = array($postvars["oldattach"]);
				}
				else {
					$postvars["oldattach"] = array();
				}
			}

			if (empty($postvars["oldattach"]) && !empty($postvars["attachment"])) {
				$tmpoldary = jieqi_unserialize($postvars["attachment"]);
				if (is_array($tmpoldary) && (0 < @jieqi_count($tmpoldary))) {
					foreach ($tmpoldary as $ot ) {
						$postvars["oldattach"][] = $ot["attachid"];
					}
				}
			}

			$oldattachary = array();

			foreach ($tmpattachary as $val ) {
				if (in_array($val["attachid"], $postvars["oldattach"])) {
					$oldattachary[] = $val;
				}
				else {
					$attachs_handler->delete($val["attachid"]);
					$afname = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article") . jieqi_getsubdir($postvars["articleid"]) . "/" . $postvars["articleid"] . "/0" . $postvars["draftid"] . "/" . $val["attachid"] . "." . $val["postfix"];
					jieqi_delfile($afname);
				}
			}
		}
	}

	$oldattachnum = @jieqi_count($oldattachary);

	if (!is_array($attachvars["info"])) {
		$attachvars = array(
			"id"   => array(),
			"info" => array()
			);
	}

	$attachnum = @jieqi_count($attachvars["info"]);
	$allattachnum = $attachnum + $oldattachnum;

	if (0 < $attachnum) {
		if (!is_a($attachs_handler, "JieqiArticleattachsHandler")) {
			include_once jieqi_path_inc("class/articleattachs.php", "article");
			$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
		}

		foreach ($attachvars["info"] as $k => $v ) {
			if (empty($attachvars["info"][$k]["attachid"])) {
				$newAttach = $attachs_handler->create();
				$newAttach->setVar("articleid", $article->getVar("articleid", "n"));
				$newAttach->setVar("chapterid", 0);
				$newAttach->setVar("name", $v["name"]);
				$newAttach->setVar("class", $v["class"]);
				$newAttach->setVar("postfix", $v["postfix"]);
				$newAttach->setVar("size", $v["size"]);
				$newAttach->setVar("hits", 0);
				$newAttach->setVar("needexp", 0);
				$newAttach->setVar("uptime", JIEQI_NOW_TIME);

				if ($attachs_handler->insert($newAttach)) {
					$attachid = $newAttach->getVar("attachid");
					$attachvars["info"][$k]["attachid"] = $attachid;
				}
				else {
					$attachvars["info"][$k]["attachid"] = 0;
				}
			}
		}
	}

	$chaptercount = $article->getVar("chapters");
	$postvars["chapterorder"] = intval($postvars["chapterorder"]);

	if (empty($postvars["chapterorder"])) {
		$postvars["chapterorder"] = $chaptercount + 1;
	}

	if ($postvars["chapterorder"] <= $chaptercount) {
		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->add(new Criteria("chapterorder", $postvars["chapterorder"], ">="));
		$chapter_handler->updatefields("chapterorder = chapterorder + 1", $criteria);
		unset($criteria);
	}

	$newChapter = $chapter_handler->create();
	$newChapter->setVar("siteid", $article->getVar("siteid", "n"));
	$newChapter->setVar("sourceid", $article->getVar("sourceid", "n"));
	$newChapter->setVar("articleid", $article->getVar("articleid", "n"));
	$newChapter->setVar("articlename", $article->getVar("articlename", "n"));
	$newChapter->setVar("volumeid", 0);

	if (!empty($postvars["sourcecid"])) {
		$newChapter->setVar("sourcecid", $postvars["sourcecid"]);
	}

	if (!empty($postvars["posterid"])) {
		$newChapter->setVar("posterid", $postvars["posterid"]);
		$newChapter->setVar("poster", $postvars["poster"]);
	}
	else if (!empty($_SESSION["jieqiUserId"])) {
		$newChapter->setVar("posterid", $_SESSION["jieqiUserId"]);
		$newChapter->setVar("poster", $_SESSION["jieqiUserName"]);
	}
	else {
		$newChapter->setVar("posterid", 0);
		$newChapter->setVar("poster", "");
	}

	$postdate = (empty($postvars["postdate"]) ? JIEQI_NOW_TIME : intval($postvars["postdate"]));
	$newChapter->setVar("postdate", $postdate);
	$lastupdate = (empty($postvars["lastupdate"]) ? JIEQI_NOW_TIME : intval($postvars["lastupdate"]));
	$newChapter->setVar("lastupdate", $lastupdate);
	$newChapter->setVar("chaptername", $postvars["chaptername"]);
	$newChapter->setVar("chapterorder", $postvars["chapterorder"]);
	$chaptersize = jieqi_strsize($postvars["chaptercontent"]);
	$chapterwords = jieqi_sizeformat($chaptersize, "c");
	$wordspricing = (isset($jieqiConfigs["obook"]["wordspricing"]) && is_numeric($jieqiConfigs["obook"]["wordspricing"]) && (0 < $jieqiConfigs["obook"]["wordspricing"]) ? intval($jieqiConfigs["obook"]["wordspricing"]) : 1);
	if ((0 < $chapterwords) && (!isset($postvars["saleprice"]) || !is_numeric($postvars["saleprice"]) || (intval($postvars["saleprice"]) < 0))) {
		$postvars["saleprice"] = 0;
		if (($wordspricing <= $chapterwords) && is_numeric($jieqiConfigs["obook"]["wordsperegold"]) && (0 < $jieqiConfigs["obook"]["wordsperegold"])) {
			$wordsperegold = floatval($jieqiConfigs["obook"]["wordsperegold"]);
			if (isset($jieqiConfigs["obook"]["wordsstep"]) && is_numeric($jieqiConfigs["obook"]["wordsstep"]) && (1 < $jieqiConfigs["obook"]["wordsstep"])) {
				$wordsstep = intval($jieqiConfigs["obook"]["wordsstep"]);

				if ($jieqiConfigs["obook"]["priceround"] == 1) {
					$postvars["saleprice"] = floor($chapterwords / $wordsstep) * round($wordsstep / $wordsperegold);
				}
				else if ($jieqiConfigs["obook"]["priceround"] == 2) {
					$postvars["saleprice"] = ceil($chapterwords / $wordsstep) * round($wordsstep / $wordsperegold);
				}
				else {
					$postvars["saleprice"] = round($chapterwords / $wordsstep) * round($wordsstep / $wordsperegold);
				}
			}
			else if ($jieqiConfigs["obook"]["priceround"] == 1) {
				$postvars["saleprice"] = floor($chapterwords / $wordsperegold);
			}
			else if ($jieqiConfigs["obook"]["priceround"] == 2) {
				$postvars["saleprice"] = ceil($chapterwords / $wordsperegold);
			}
			else {
				$postvars["saleprice"] = round($chapterwords / $wordsperegold);
			}
		}
	}
	else {
		$postvars["saleprice"] = ($chapterwords == 0 ? 0 : intval($postvars["saleprice"]));
	}

	$newChapter->setVar("isimage", 0);

	if (0 < $allattachnum) {
		if (($chaptersize == 0) && ($postvars["chaptertype"] == 0)) {
			$newChapter->setVar("isimage", 1);
		}

		$wordlen = (defined("JIEQI_SYSTEM_SBYTE") && (0 < JIEQI_SYSTEM_SBYTE) ? 1 : (JIEQI_SYSTEM_CHARSET == "utf-8" ? 3 : 2));
		$chaptersize += $allattachnum * $wordlen;
	}

	$newChapter->setVar("size", $chaptersize);
	$newChapter->setVar("saleprice", $postvars["saleprice"]);
	$newChapter->setVar("salenum", 0);
	$newChapter->setVar("totalcost", 0);

	if (empty($oldattachary)) {
		$newChapter->setVar("attachment", serialize($attachvars["info"]));
	}
	else {
		$newattachary = $oldattachary;

		foreach ($attachvars["info"] as $val ) {
			$newattachary[] = $val;
		}

		$newChapter->setVar("attachment", serialize($newattachary));
	}

	if (0 < $chaptersize) {
		$newChapter->setVar("summary", jieqi_substr($postvars["chaptercontent"], 0, 500, ".."));
	}
	else {
		$newChapter->setVar("summary", "");
	}

	if (isset($postvars["preface"])) {
		$newChapter->setVar("preface", $postvars["preface"]);
	}

	if (isset($postvars["notice"])) {
		$newChapter->setVar("notice", $postvars["notice"]);
	}

	if (isset($postvars["isbody"])) {
		$newChapter->setVar("isbody", intval($postvars["isbody"]));
	}

	$newChapter->setVar("isvip", intval($postvars["isvip"]));

	if (0 < $postvars["chaptertype"]) {
		$newChapter->setVar("chaptertype", 1);
	}
	else {
		$newChapter->setVar("chaptertype", 0);
	}

	$newChapter->setVar("power", 0);
	$newChapter->setVar("display", 0);

	if (!$chapter_handler->insert($newChapter)) {
		if (0 < $attachnum) {
			foreach ($attachvars["info"] as $k => $v ) {
				if (0 < $v["attachid"]) {
					$attachs_handler->delete($v["attachid"]);
				}
			}
		}

		return $jieqiLang["article"]["add_chapter_failure"];
	}
	else {
		$chapterid = intval($newChapter->getVar("chapterid"));
		$make_image_water = false;
		if (function_exists("gd_info") && (0 < $jieqiConfigs["article"]["attachwater"]) && (JIEQI_MODULE_VTYPE != "") && (JIEQI_MODULE_VTYPE != "Free")) {
			if ((strpos($jieqiConfigs["article"]["attachwimage"], "/") === false) && (strpos($jieqiConfigs["article"]["attachwimage"], "\\") === false)) {
				$water_image_file = $jieqiModules["article"]["path"] . "/images/" . $jieqiConfigs["article"]["attachwimage"];
			}
			else {
				$water_image_file = $jieqiConfigs["article"]["attachwimage"];
			}

			if (is_file($water_image_file)) {
				$make_image_water = true;
				include_once jieqi_path_lib("image/imagewater.php");
			}
		}

		if (!empty($oldattachary)) {
			$attachs_handler->execute("UPDATE " . jieqi_dbprefix("article_attachs") . " SET chapterid=" . $chapterid . " WHERE articleid=" . $article->getVar("articleid", "n") . " AND chapterid = -" . $postvars["draftid"]);
			$chapter_attach_dir = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article");
			$chapter_attach_dir .= jieqi_getsubdir($newChapter->getVar("articleid"));
			$chapter_attach_dir .= "/" . $newChapter->getVar("articleid");
			$draft_attach_dir = $chapter_attach_dir . "/0" . $postvars["draftid"];
			$chapter_attach_dir .= "/" . $newChapter->getVar("chapterid");
			jieqi_checkdir($chapter_attach_dir, true);

			foreach ($oldattachary as $k => $v ) {
				jieqi_copyfile($draft_attach_dir . "/" . $v["attachid"] . "." . $v["postfix"], $chapter_attach_dir . "/" . $v["attachid"] . "." . $v["postfix"], 511, true);
			}

			jieqi_delfolder($draft_attach_dir, true);
		}

		if (0 < $attachnum) {
			$attachs_handler->execute("UPDATE " . jieqi_dbprefix("article_attachs") . " SET chapterid=" . $chapterid . " WHERE articleid=" . $article->getVar("articleid", "n") . " AND chapterid = 0");
			$attachdir = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article");
			$attachdir .= jieqi_getsubdir($newChapter->getVar("articleid"));
			$attachdir .= "/" . $newChapter->getVar("articleid");
			$attachdir .= "/" . $newChapter->getVar("chapterid");
			jieqi_checkdir($attachdir, true);

			foreach ($attachvars["info"] as $k => $v ) {
				$fileid = $attachvars["id"][$k];
				$attach_save_path = $attachdir . "/" . $v["attachid"] . "." . $v["postfix"];
				$tmp_attachfile = $attachdir . "/" . basename($_FILES["attachfile"]["tmp_name"][$fileid]) . "." . $v["postfix"];
				@move_uploaded_file($_FILES["attachfile"]["tmp_name"][$fileid], $tmp_attachfile);
				if ($make_image_water && preg_match("/\.(gif|jpg|jpeg|png)$/i", $tmp_attachfile)) {
					$img = new ImageWater();
					$img->save_image_file = $tmp_attachfile;
					$img->codepage = JIEQI_SYSTEM_CHARSET;
					$img->wm_image_pos = $jieqiConfigs["article"]["attachwater"];
					$img->wm_image_name = $water_image_file;
					$img->wm_image_transition = $jieqiConfigs["article"]["attachwtrans"];
					$img->jpeg_quality = $jieqiConfigs["article"]["attachwquality"];
					$img->create($tmp_attachfile);
					unset($img);
				}

				jieqi_copyfile($tmp_attachfile, $attach_save_path, 511, true);
			}
		}

		if (!empty($postvars["isvip"]) && ($postvars["chaptertype"] == 0)) {
			global $obook_handler;
			global $ochapter_handler;

			if (!is_a($obook_handler, "JieqiObookHandler")) {
				include_once jieqi_path_inc("class/obook.php", "obook");
				$obook_handler = &JieqiObookHandler::getInstance("JieqiObookHandler");
			}

			if (!is_a($ochapter_handler, "JieqiOchapterHandler")) {
				include_once jieqi_path_inc("class/ochapter.php", "obook");
				$ochapter_handler = &JieqiOchapterHandler::getInstance("JieqiOchapterHandler");
			}

			include_once jieqi_path_inc("include/actobook.php", "obook");
			$obook = jieqi_obook_autocreate($article, 1);

			if (!is_object($obook)) {
				return $obook;
			}

			$article->setVar("isvip", 1);
			$article->setVar("vipid", $obook->getVar("obookid", "n"));
			$ochapter = $ochapter_handler->create();
			$ochapter->setVar("ochapterid", $newChapter->getVar("chapterid", "n"));
			$ochapter->setVar("siteid", $newChapter->getVar("siteid", "n"));
			$ochapter->setVar("sourceid", $newChapter->getVar("sourceid", "n"));
			$ochapter->setVar("sourcecid", $newChapter->getVar("sourcecid", "n"));
			$ochapter->setVar("obookid", $obook->getVar("obookid", "n"));
			$ochapter->setVar("articleid", $newChapter->getVar("articleid", "n"));
			$ochapter->setVar("chapterid", $newChapter->getVar("chapterid", "n"));
			$ochapter->setVar("postdate", $newChapter->getVar("postdate", "n"));
			$ochapter->setVar("lastupdate", $newChapter->getVar("lastupdate", "n"));
			$ochapter->setVar("buytime", 0);
			$ochapter->setVar("obookname", $newChapter->getVar("articlename", "n"));
			$ochapter->setVar("chaptername", $newChapter->getVar("chaptername", "n"));
			$ochapter->setVar("chapterorder", $newChapter->getVar("chapterorder", "n"));
			$ochapter->setVar("summary", $newChapter->getVar("summary", "n"));
			$ochapter->setVar("preface", $newChapter->getVar("preface", "n"));
			$ochapter->setVar("notice", $newChapter->getVar("notice", "n"));
			$ochapter->setVar("foreword", $newChapter->getVar("foreword", "n"));
			$ochapter->setVar("isbody", $newChapter->getVar("isbody", "n"));
			$ochapter->setVar("size", $newChapter->getVar("size", "n"));
			$ochapter->setVar("posterid", $newChapter->getVar("posterid", "n"));
			$ochapter->setVar("poster", $newChapter->getVar("poster", "n"));
			$ochapter->setVar("toptime", 0);
			$ochapter->setVar("picflag", $newChapter->getVar("isimage", "n"));
			$ochapter->setVar("chaptertype", $newChapter->getVar("chaptertype", "n"));
			$ochapter->setVar("saleprice", $newChapter->getVar("saleprice", "n"));
			$ochapter->setVar("vipprice", $newChapter->getVar("saleprice", "n"));
			$ochapter->setVar("sumegold", 0);
			$ochapter->setVar("sumesilver", 0);
			$ochapter->setVar("normalsale", 0);
			$ochapter->setVar("vipsale", 0);
			$ochapter->setVar("freesale", 0);
			$ochapter->setVar("bespsale", 0);
			$ochapter->setVar("totalsale", 0);
			$ochapter->setVar("daysale", 0);
			$ochapter->setVar("weeksale", 0);
			$ochapter->setVar("monthsale", 0);
			$ochapter->setVar("allsale", 0);
			$ochapter->setVar("lastsale", 0);
			$ochapter->setVar("state", 0);
			$ochapter->setVar("flag", 0);
			$ochapter->setVar("display", 0);
			$ochapter_handler->insert($ochapter);
			$obook->setVar("chapters", intval($obook->getVars("chapters", "n")) + 1);
			$obook_handler->insert($obook);
		}

		if (!empty($postvars["draftid"])) {
			global $draft_handler;

			if (!is_a($draft_handler, "JieqiDraftHandler")) {
				include_once jieqi_path_inc("class/draft.php", "article");
				$draft_handler = &JieqiDraftHandler::getInstance("JieqiDraftHandler");
			}

			$draft_handler->delete($postvars["draftid"]);
		}

		if (!empty($batch)) {
			include_once jieqi_path_inc("class/package.php", "article");
			jieqi_save_achapterc(intval($article->getVar("articleid", "n")), intval($newChapter->getVar("chapterid", "n")), $postvars["chaptercontent"], intval($newChapter->getVar("isvip", "n")), intval($newChapter->getVar("chaptertype", "n")));
		}
		else {
			if ($postvars["chaptertype"] == 0) {
				$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
				$criteria->add(new Criteria("chapterorder", $postvars["chapterorder"], "<"));
				$criteria->add(new Criteria("chaptertype", 1, "="));
				$criteria->setSort("chapterorder");
				$criteria->setOrder("DESC");
				$criteria->setLimit(1);
				$chapter_handler->queryObjects($criteria);
				$tmpchapter = $chapter_handler->getObject();

				if (is_object($tmpchapter)) {
					$lastvolume = $tmpchapter->getVar("chaptername", "n");
					$lastvolumeid = $tmpchapter->getVar("chapterid", "n");
				}
				else {
					$lastvolume = "";
					$lastvolumeid = 0;
				}

				unset($tmpchapter);
				unset($criteria);

				if (!empty($postvars["isvip"])) {
					$article->setVar("vipchapter", $postvars["chaptername"]);
					$article->setVar("vipchapterid", $newChapter->getVar("chapterid", "n"));
					$article->setVar("vipsummary", $newChapter->getVar("summary", "n"));

					if ($article->getVar("vipvolumeid") != $lastvolumeid) {
						$article->setVar("vipvolume", $lastvolume);
						$article->setVar("vipvolumeid", $lastvolumeid);
					}
				}
				else {
					$article->setVar("lastchapter", $postvars["chaptername"]);
					$article->setVar("lastchapterid", $newChapter->getVar("chapterid", "n"));
					$article->setVar("lastsummary", $newChapter->getVar("summary", "n"));

					if ($article->getVar("lastvolumeid") != $lastvolumeid) {
						$article->setVar("lastvolume", $lastvolume);
						$article->setVar("lastvolumeid", $lastvolumeid);
					}
				}
			}
			else {
				$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
				$criteria->add(new Criteria("chapterorder", $postvars["chapterorder"], ">"));
				$criteria->add(new Criteria("chaptertype", 0, "="));
				$criteria->setSort("chapterorder");
				$criteria->setOrder("DESC");
				$chapter_handler->queryObjects($criteria);
				$tmpchapter = $chapter_handler->getObject();

				if (is_object($tmpchapter)) {
					if (!empty($postvars["isvip"])) {
						if ($tmpchapter->getVar("chapterid", "n") == $article->getVar("vipchapterid", "n")) {
							$article->setVar("vipvolume", $postvars["chaptername"]);
							$article->setVar("vipvolumeid", $newChapter->getVar("chapterid", "n"));
						}
					}
					else if ($tmpchapter->getVar("chapterid", "n") == $article->getVar("lastchapterid", "n")) {
						$article->setVar("lastvolume", $postvars["chaptername"]);
						$article->setVar("lastvolumeid", $newChapter->getVar("chapterid", "n"));
					}
				}

				unset($tmpchapter);
				unset($criteria);
			}

			include_once jieqi_path_inc("include/funstat.php", "system");
			$lasttime = $article->getVar("lastupdate", "n");
			$addorup = jieqi_visit_addorup($lasttime);
			$daysize = ($addorup["day"] ? $chaptersize : $article->getVar("daysize", "n") + $chaptersize);
			$weeksize = ($addorup["week"] ? $chaptersize : $article->getVar("weeksize", "n") + $chaptersize);
			$monthsize = ($addorup["month"] ? $chaptersize : $article->getVar("monthsize", "n") + $chaptersize);
			$allsize = $article->getVar("size", "n") + $chaptersize;

			if (2.2 <= floatval(JIEQI_VERSION)) {
				if (1 < $addorup["month"]) {
					$article->setVar("presize", 0);
					$article->setVar("preupds", 0);
					$article->setVar("preupdt", 0);
					$article->setVar("monthupds", 0);
					$article->setVar("monthupdt", 0);
				}
				else if ($addorup["month"] == 1) {
					$article->setVar("presize", $article->getVar("monthsize", "n"));
					$article->setVar("preupds", $article->getVar("monthupds", "n"));
					$article->setVar("preupdt", $article->getVar("monthupdt", "n"));
					$article->setVar("monthupds", 0);
					$article->setVar("monthupdt", 0);
				}

				if ($addorup["day"]) {
					$article->setVar("monthupds", $article->getVar("monthupds", "n") + 1);
					$tmpvar = intval($article->getVar("monthupdt", "n")) | pow(2, intval(date("d", JIEQI_NOW_TIME)) - 1);
					$article->setVar("monthupdt", $tmpvar);
				}
			}

			$article->setVar("daysize", $daysize);
			$article->setVar("weeksize", $weeksize);
			$article->setVar("monthsize", $monthsize);
			$article->setVar("size", $allsize);

			if (!empty($postvars["isvip"])) {
				$vipsize = $article->getVar("vipsize", "n") + $chaptersize;
				$article->setVar("vipsize", $vipsize);
			}
			else {
				$freesize = $article->getVar("freesize", "n") + $chaptersize;
				$article->setVar("freesize", $freesize);
			}

			if ($postvars["fullflag"] == 1) {
				$article->setVar("fullflag", 1);

				if (!empty($jieqiOption["article"]["progress"]["items"])) {
					end($jieqiOption["article"]["progress"]["items"]);
					$article->setVar("progress", key($jieqiOption["article"]["progress"]["items"]));
					reset($jieqiOption["article"]["progress"]["items"]);
				}
			}

			$article->setVar("lastupdate", JIEQI_NOW_TIME);
			$article->setVar("chapters", $article->getVar("chapters") + 1);

			if (!empty($postvars["isvip"])) {
				$article->setVar("vipchapters", $article->getVar("vipchapters") + 1);
				$article->setVar("viptime", JIEQI_NOW_TIME);
			}
			else {
				$article->setVar("freetime", JIEQI_NOW_TIME);
			}

			$article_handler->insert($article);
			include_once jieqi_path_inc("class/package.php", "article");
			$package = new JieqiPackage($article->getVar("articleid", "n"));
			$package->addChapter($newChapter, $postvars["chaptercontent"], $article);

			if ($postvars["chaptertype"] == 0) {
				include_once jieqi_path_inc("include/funaction.php", "article");
				$actions = array("actname" => "chapteradd", "actnum" => 1, "uid" => intval($newChapter->getVar("posterid", "n")), "uname" => $newChapter->getVar("poster", "n"));
				jieqi_article_actiondo($actions, $article);
			}

			if ($postvars["chaptertype"] == 0) {
				jieqi_article_updateinfo($article, "chapternew");
			}
		}
	}

	return $chapterid;
}

function jieqi_article_adddraft(&$postvars, &$attachvars)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiOption;
	global $jieqiLang;
	global $jieqiAction;
	global $article_handler;
	global $chapter_handler;
	global $attachs_handler;
	global $draft_handler;

	if (!isset($jieqiConfigs["article"])) {
		jieqi_getconfigs("article", "configs");
	}

	if (!isset($jieqiConfigs["obook"])) {
		jieqi_getconfigs("obook", "configs");
	}

	if (!isset($jieqiOption["article"])) {
		jieqi_getconfigs("article", "option", "jieqiOption");
	}

	$postvars["chaptertype"] = intval($postvars["chaptertype"]);

	if (!is_a($draft_handler, "JieqiDraftHandler")) {
		include_once jieqi_path_inc("class/draft.php", "article");
		$draft_handler = &JieqiDraftHandler::getInstance("JieqiDraftHandler");
	}

	if (!is_array($attachvars["info"])) {
		$attachvars = array(
			"id"   => array(),
			"info" => array()
			);
	}

	$attachnum = @jieqi_count($attachvars["info"]);

	if (0 < $attachnum) {
		if (!is_a($attachs_handler, "JieqiArticleattachsHandler")) {
			include_once jieqi_path_inc("class/articleattachs.php", "article");
			$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
		}

		foreach ($attachvars["info"] as $k => $v ) {
			if (empty($attachvars["info"][$k]["attachid"])) {
				$newAttach = $attachs_handler->create();
				$newAttach->setVar("articleid", $postvars["articleid"]);
				$newAttach->setVar("chapterid", 0);
				$newAttach->setVar("name", $v["name"]);
				$newAttach->setVar("class", $v["class"]);
				$newAttach->setVar("postfix", $v["postfix"]);
				$newAttach->setVar("size", $v["size"]);
				$newAttach->setVar("hits", 0);
				$newAttach->setVar("needexp", 0);
				$newAttach->setVar("uptime", JIEQI_NOW_TIME);

				if ($attachs_handler->insert($newAttach)) {
					$attachid = $newAttach->getVar("attachid");
					$attachvars["info"][$k]["attachid"] = $attachid;
				}
				else {
					$attachvars["info"][$k]["attachid"] = 0;
				}
			}
		}
	}

	$newDraft = $draft_handler->create();
	$newDraft->setVar("articleid", $postvars["articleid"]);
	$newDraft->setVar("articlename", $postvars["articlename"]);
	$newDraft->setVar("volumeid", intval($postvars["volumeid"]));
	$newDraft->setVar("volumename", $postvars["volumename"]);
	$newDraft->setVar("chapterid", 0);
	$newDraft->setVar("chapterorder", 0);
	$newDraft->setVar("chaptertype", 0);
	$newDraft->setVar("isvip", intval($postvars["isvip"]));
	$newDraft->setVar("obookid", $postvars["obookid"]);

	if (!empty($_SESSION["jieqiUserId"])) {
		$newDraft->setVar("posterid", $_SESSION["jieqiUserId"]);
		$newDraft->setVar("poster", $_SESSION["jieqiUserName"]);
	}
	else {
		$newDraft->setVar("posterid", 0);
		$newDraft->setVar("poster", "");
	}

	$newDraft->setVar("postdate", JIEQI_NOW_TIME);
	$newDraft->setVar("lastupdate", JIEQI_NOW_TIME);

	if ($postvars["uptiming"] == 1) {
		$newDraft->setVar("ispub", 1);
		$newDraft->setVar("pubdate", $postvars["pubtime"]);
	}
	else {
		$newDraft->setVar("ispub", 0);
		$newDraft->setVar("pubdate", 0);
	}

	$newDraft->setVar("chaptername", $postvars["chaptername"]);
	$newDraft->setVar("chaptercontent", $postvars["chaptercontent"]);
	$draftsize = jieqi_strsize($postvars["chaptercontent"]);

	if (0 < $draftsize) {
		$newDraft->setVar("summary", jieqi_substr($postvars["chaptercontent"], 0, 500, ".."));
	}
	else {
		$newDraft->setVar("summary", "");
	}

	if (isset($postvars["preface"])) {
		$newDraft->setVar("preface", $postvars["preface"]);
	}

	if (isset($postvars["notice"])) {
		$newDraft->setVar("notice", $postvars["notice"]);
	}

	if (isset($postvars["isbody"])) {
		$newDraft->setVar("isbody", intval($postvars["isbody"]));
	}

	$newDraft->setVar("isimage", 0);

	if (0 < $attachnum) {
		if ($draftsize == 0) {
			$newDraft->setVar("isimage", 1);
		}

		$wordlen = (defined("JIEQI_SYSTEM_SBYTE") && (0 < JIEQI_SYSTEM_SBYTE) ? 1 : (JIEQI_SYSTEM_CHARSET == "utf-8" ? 3 : 2));
		$draftsize += $attachnum * $wordlen;
	}
	else {
		$newDraft->setVar("size", $draftsize);
	}

	if (!isset($customprice)) {
		$customprice = false;
	}

	if (!isset($postvars["saleprice"]) || !is_numeric($postvars["saleprice"])) {
		$postvars["saleprice"] = -1;
	}
	else {
		$postvars["saleprice"] = intval($postvars["saleprice"]);
		if (($postvars["saleprice"] < 0) || ((0 < $postvars["saleprice"]) && !$customprice)) {
			$postvars["saleprice"] = -1;
		}
	}

	if ($postvars["isvip"] <= 0) {
		$postvars["saleprice"] = -1;
	}

	$newDraft->setVar("saleprice", $postvars["saleprice"]);
	$newDraft->setVar("note", "");
	$newDraft->setVar("attachment", serialize($attachvars["info"]));
	$newDraft->setVar("power", 0);

	if ($postvars["needupaudit"]) {
		$newDraft->setVar("display", 1);
	}
	else {
		$newDraft->setVar("display", 0);
	}

	$newDraft->setVar("draftflag", 0);

	if (!$draft_handler->insert($newDraft)) {
		if (0 < $attachnum) {
			foreach ($attachvars["info"] as $k => $v ) {
				if (0 < $v["attachid"]) {
					$attachs_handler->delete($v["attachid"]);
				}
			}
		}

		return $jieqiLang["article"]["draft_add_failure"];
	}
	else {
		$draftid = intval($newDraft->getVar("draftid"));
		$make_image_water = false;
		if (function_exists("gd_info") && (0 < $jieqiConfigs["article"]["attachwater"]) && (JIEQI_MODULE_VTYPE != "") && (JIEQI_MODULE_VTYPE != "Free")) {
			if ((strpos($jieqiConfigs["article"]["attachwimage"], "/") === false) && (strpos($jieqiConfigs["article"]["attachwimage"], "\\") === false)) {
				$water_image_file = $jieqiModules["article"]["path"] . "/images/" . $jieqiConfigs["article"]["attachwimage"];
			}
			else {
				$water_image_file = $jieqiConfigs["article"]["attachwimage"];
			}

			if (is_file($water_image_file)) {
				$make_image_water = true;
				include_once jieqi_path_lib("image/imagewater.php");
			}
		}

		if (0 < $attachnum) {
			$attachs_handler->execute("UPDATE " . jieqi_dbprefix("article_attachs") . " SET chapterid = -" . $draftid . " WHERE articleid=" . $postvars["articleid"] . " AND chapterid = 0");
			$attachdir = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article");
			$attachdir .= jieqi_getsubdir($postvars["articleid"]);
			$attachdir .= "/" . $postvars["articleid"];
			$attachdir .= "/0" . $draftid;
			jieqi_checkdir($attachdir, true);

			foreach ($attachvars["info"] as $k => $v ) {
				$fileid = $attachvars["id"][$k];
				$attach_save_path = $attachdir . "/" . $v["attachid"] . "." . $v["postfix"];
				$tmp_attachfile = $attachdir . "/" . basename($_FILES["attachfile"]["tmp_name"][$fileid]) . "." . $v["postfix"];
				@move_uploaded_file($_FILES["attachfile"]["tmp_name"][$fileid], $tmp_attachfile);
				if ($make_image_water && preg_match("/\.(gif|jpg|jpeg|png)$/i", $tmp_attachfile)) {
					$img = new ImageWater();
					$img->save_image_file = $tmp_attachfile;
					$img->codepage = JIEQI_SYSTEM_CHARSET;
					$img->wm_image_pos = $jieqiConfigs["article"]["attachwater"];
					$img->wm_image_name = $water_image_file;
					$img->wm_image_transition = $jieqiConfigs["article"]["attachwtrans"];
					$img->jpeg_quality = $jieqiConfigs["article"]["attachwquality"];
					$img->create($tmp_attachfile);
					unset($img);
				}

				jieqi_copyfile($tmp_attachfile, $attach_save_path, 511, true);
			}
		}
	}

	return $draftid;
}

function jieqi_article_updateinfo($article = 0, $act = "chapternew")
{
	global $jieqiTpl;
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiArticleuplog;
	global $article_handler;
	global $chapter_handler;
	if (is_numeric($article) && ($article <= 0)) {
		jieqi_getcachevars("article", "articleuplog");

		if (!is_array($jieqiArticleuplog)) {
			$jieqiArticleuplog = array("articleuptime" => 0, "vipuptime" => 0, "chapteruptime" => 0);
		}

		$jieqiArticleuplog["articleuptime"] = JIEQI_NOW_TIME;
		if (($article == 0) || ($article == -1)) {
			$jieqiArticleuplog["chapteruptime"] = JIEQI_NOW_TIME;
		}

		if (($article == 0) || ($article == -2)) {
			$jieqiArticleuplog["vipuptime"] = JIEQI_NOW_TIME;
		}

		jieqi_setcachevars("articleuplog", "jieqiArticleuplog", $jieqiArticleuplog, "article");
		return true;
	}

	if (!is_object($article)) {
		$article = $article_handler->get(intval($article));

		if (!$article) {
			return false;
		}
	}

	$aid = intval($article->getVar("articleid"));

	if ($act == "articlehide") {
		if (JIEQI_USE_CACHE) {
			if (!is_a($jieqiTpl, "JieqiTpl")) {
				include_once jieqi_path_lib("template/template.php");
				$jieqiTpl = &JieqiTpl::getInstance();
			}

			$jieqiTpl->clear_cache(jieqi_path_template("articleinfo.html", "article"), intval($article->getVar("articleid")));
		}

		if (0 < $jieqiConfigs["article"]["fakestatic"]) {
			include_once jieqi_path_inc("include/funstatic.php", "article");
			article_delete_sinfo($aid, false);
		}

		if (0 < $jieqiConfigs["article"]["makehtml"]) {
			$htmldir = jieqi_uploadpath($jieqiConfigs["article"]["htmldir"], "article") . jieqi_getsubdir($aid) . "/" . $aid;
			jieqi_article_filehide($htmldir, true);
		}

		if (0 < $jieqiConfigs["article"]["makefull"]) {
			$htmlfile = jieqi_uploadpath($jieqiConfigs["article"]["fulldir"], "article") . jieqi_getsubdir($aid) . "/" . $aid . $jieqiConfigs["article"]["htmlfile"];
			jieqi_article_filehide($htmlfile, true);
		}
	}

	if (in_array($act, array("articlehide", "articleshow"))) {
		include_once jieqi_path_inc("include/repack.php", "article");
		article_repack($aid, array("makeopf" => 1), 0);
	}

	if ($article->getVar("display") != "0") {
		return true;
	}

	$uparticle = false;
	$upchapter = false;
	$upstatic = "";

	switch ($act) {
	case "articlenew":
		$uparticle = true;
		$upchapter = false;
		$upstatic = "articlenew";
		break;

	case "articleedit":
		$uparticle = true;
		$upchapter = false;
		$upstatic = "articleedit";
		break;

	case "articlehide":
		$uparticle = true;
		$upchapter = false;
		$upstatic = "";
		break;

	case "articleshow":
		$uparticle = true;
		$upchapter = false;
		$upstatic = "articleedit";
		break;

	case "articledel":
		$uparticle = true;
		$upchapter = true;
		$upstatic = "articledel";
		break;

	case "chapternew":
		$uparticle = false;
		$upchapter = true;
		$upstatic = "chapternew";
		break;

	case "chapteredit":
		$uparticle = false;
		$upchapter = true;
		$upstatic = "chapteredit";
		break;

	case "chapterdel":
		$uparticle = false;
		$upchapter = true;
		$upstatic = "chapterdel";
		break;

	case "reviewnew":
		$uparticle = false;
		$upchapter = false;
		$upstatic = "reviewnew";
		break;
	}

	if (($uparticle == true) || ($upchapter == true)) {
		jieqi_getcachevars("article", "articleuplog");

		if (!is_array($jieqiArticleuplog)) {
			$jieqiArticleuplog = array("articleuptime" => 0, "chapteruptime" => 0);
		}

		if ($uparticle) {
			$jieqiArticleuplog["articleuptime"] = JIEQI_NOW_TIME;
		}

		if ($upchapter) {
			$jieqiArticleuplog["chapteruptime"] = JIEQI_NOW_TIME;
		}

		jieqi_setcachevars("articleuplog", "jieqiArticleuplog", $jieqiArticleuplog, "article");
	}

	if (JIEQI_USE_CACHE) {
		if (!is_a($jieqiTpl, "JieqiTpl")) {
			include_once jieqi_path_lib("template/template.php");
			$jieqiTpl = &JieqiTpl::getInstance();
		}

		$jieqiTpl->clear_cache(jieqi_path_template("articleinfo.html", "article"), intval($article->getVar("articleid")));
	}

	if (($upstatic != "") && (0 < $jieqiConfigs["article"]["fakestatic"])) {
		include_once jieqi_path_inc("include/funstatic.php", "article");
		article_update_static($upstatic, intval($article->getVar("articleid")), intval($article->getVar("sortid")));
	}

	if ($act == "articleshow") {
		if (0 < $jieqiConfigs["article"]["makehtml"]) {
			$htmldir = jieqi_uploadpath($jieqiConfigs["article"]["htmldir"], "article") . jieqi_getsubdir($aid) . "/" . $aid;

			if (!jieqi_article_filehide($htmldir, false)) {
				include_once jieqi_path_inc("include/repack.php", "article");
				article_repack($aid, array("makehtml" => 1), 0);
			}
		}

		if (0 < $jieqiConfigs["article"]["makefull"]) {
			$htmlfile = jieqi_uploadpath($jieqiConfigs["article"]["fulldir"], "article") . jieqi_getsubdir($aid) . "/" . $aid . $jieqiConfigs["article"]["htmlfile"];

			if (!jieqi_article_filehide($htmlfile, false)) {
				include_once jieqi_path_inc("include/repack.php", "article");
				article_repack($aid, array("makefull" => 1), 0);
			}
		}
	}
}

function jieqi_article_filehide($file, $hide = true)
{
	$hidechar = ".";
	$dirname = dirname($file);
	$basename = basename($file);
	$hidefile = $dirname . "/" . $hidechar . $basename;

	if ($hide) {
		if (!file_exists($file)) {
			return false;
		}

		$ret = true;

		if (is_file($hidefile)) {
			$ret = jieqi_delfile($hidefile);
		}
		else if (is_dir($hidefile)) {
			$ret = jieqi_delfolder($hidefile, true);
		}

		if ($ret) {
			return rename($file, $hidefile);
		}
		else {
			if (is_file($file)) {
				jieqi_delfile($file);
			}
			else if (is_dir($file)) {
				jieqi_delfolder($file, true);
			}

			return true;
		}
	}
	else {
		if (!file_exists($hidefile)) {
			if (file_exists($file)) {
				return true;
			}
			else {
				return false;
			}
		}

		$ret = true;

		if (is_file($file)) {
			$ret = jieqi_delfile($file);
		}
		else if (is_dir($file)) {
			$ret = jieqi_delfolder($file, true);
		}

		if ($ret) {
			return rename($hidefile, $file);
		}
		else {
			if (is_file($hidefile)) {
				jieqi_delfile($hidefile);
			}
			else if (is_dir($hidefile)) {
				jieqi_delfolder($hidefile, true);
			}

			return true;
		}
	}
}

?>
