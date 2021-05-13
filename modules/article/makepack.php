<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");

if (empty($_REQUEST["key"])) {
	exit("no key");
}
else {
	if (defined("JIEQI_SITE_KEY") && ($_REQUEST["key"] != JIEQI_SITE_KEY)) {
		exit("error key");
	}
	else if ($_REQUEST["key"] != md5(JIEQI_DB_USER . JIEQI_DB_PASS . JIEQI_DB_NAME)) {
		exit();
	}
}

if (!is_numeric($_REQUEST["id"])) {
	exit();
}

if (!is_array($_REQUEST["packflag"]) || (jieqi_count($_REQUEST["packflag"]) < 1)) {
	exit();
}

$_REQUEST["id"] = intval($_REQUEST["id"]);
@ignore_user_abort(true);
@set_time_limit(3600);
@session_write_close();
@ini_set("memory_limit", "64M");
echo str_repeat(" ", 4096);
ob_flush();
flush();
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
include_once jieqi_path_inc("class/article.php", "article");
include_once jieqi_path_inc("class/chapter.php", "article");
include_once jieqi_path_inc("class/package.php", "article");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
$article = $article_handler->get($_REQUEST["id"]);

if (!is_object($article)) {
	exit();
}
else {
	$package = new JieqiPackage($_REQUEST["id"]);
	$package->initPackage($article->getVars("n"), false);
	$chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
	$criteria = new CriteriaCompo(new Criteria("articleid", $_REQUEST["id"], "="));
	$criteria->setSort("chapterorder ASC, chapterid");
	$criteria->setOrder("ASC");
	$res = $chapter_handler->queryObjects($criteria);
	$i = 0;
	$articlesize = 0;

	while ($chapter = $chapter_handler->getObject($res)) {
		$package->chapters[$i] = $chapter->getVars("n");
		$i++;

		if ($chapter->getVar("chaptertype", "n") == 0) {
			$articlesize = $articlesize + intval($chapter->getVar("size", "n"));
		}

		if ($chapter->getVar("chapterorder", "n") != $i) {
			$chapter->setVar("chapterorder", $i);
			$chapter_handler->insert($chapter);
		}
	}

	$changeflag = false;

	if ($article->getVar("chapters", "n") != $i) {
		$article->setVar("chapters", $i);
		$changeflag = true;
	}

	if (intval($article->getVar("size", "n")) < $articlesize) {
		$article->setVar("size", $articlesize);
		$changeflag = true;
	}

	if ($articlesize != intval($article->getVar("freesize", "n"))) {
		$article->setVar("freesize", $articlesize);
		$changeflag = true;
	}

	if ($changeflag) {
		$article_handler->insert($article);
	}

	$package->isload = true;

	if (in_array("makeopf", $_REQUEST["packflag"])) {
		$package->createOPF();
	}

	if (in_array("makehtml", $_REQUEST["packflag"])) {
		$chaptercount = jieqi_count($package->chapters);

		for ($i = 1; $i <= $chaptercount; $i++) {
			if ($package->chapters[$i - 1]["chaptertype"] == 0) {
				$package->makeHtml($i, false, false, true);
			}
		}

		$package->makeIndex();
	}
	else {
		if (in_array("makeindex", $_REQUEST["packflag"])) {
			$package->makeIndex();
		}

		if (in_array("makechapter", $_REQUEST["packflag"])) {
			$chaptercount = jieqi_count($package->chapters);

			for ($i = 1; $i <= $chaptercount; $i++) {
				if ($package->chapters[$i - 1]["chaptertype"] == 0) {
					$package->makeHtml($i, false, false, true);
				}
			}
		}
	}

	if (in_array("maketxtjs", $_REQUEST["packflag"])) {
		$chaptercount = jieqi_count($package->chapters);

		for ($i = 1; $i <= $chaptercount; $i++) {
			if ($package->chapters[$i - 1]["chaptertype"] == 0) {
				$package->makeTxtjs($i, true);
			}
		}
	}

	if (in_array("maketxtfull", $_REQUEST["packflag"])) {
		$package->maketxtfull();
	}

	if (in_array("makefull", $_REQUEST["packflag"])) {
		$package->makefulltext();
	}

	if (in_array("makezip", $_REQUEST["packflag"])) {
		$package->makezip();
	}

	if (in_array("makeumd", $_REQUEST["packflag"])) {
		$package->makeumd();
	}

	if (in_array("makejar", $_REQUEST["packflag"])) {
		$package->makejar();
	}

	return true;
}

?>
