<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");

if (empty($_REQUEST["id"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

$_REQUEST["id"] = intval($_REQUEST["id"]);
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("draft", JIEQI_MODULE_NAME);
include_once jieqi_path_inc("class/draft.php", "article");
$draft_handler = &JieqiDraftHandler::getInstance("JieqiDraftHandler");
$draft = $draft_handler->get($_REQUEST["id"]);

if (!$draft) {
	jieqi_printfail($jieqiLang["article"]["draft_not_exists"]);
}

$canupload = jieqi_checkpower($jieqiPower["article"]["articleupattach"], $jieqiUsersStatus, $jieqiUsersGroup, true);
$customprice = jieqi_checkpower($jieqiPower["obook"]["customprice"], $jieqiUsersStatus, $jieqiUsersGroup, true);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);

if (!isset($_POST["act"])) {
	$_POST["act"] = "edit";
}

$isvip = intval($draft->getVar("isvip", "n"));

switch ($_POST["act"]) {
case "update":
	jieqi_checkpost();
	$_POST = jieqi_funtoarray("trim", $_POST);

	if (!isset($_POST["isvip"])) {
		$_POST["isvip"] = $isvip;
	}

	if ($_POST["isvip"] != $isvip) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	$_REQUEST["isvip"] = $_POST["isvip"];
	$_POST["canupload"] = $canupload;
	include_once jieqi_path_inc("include/actarticle.php", "article");
	$attachvars = array();
	$errors = jieqi_article_chapterpcheck($_POST, $attachvars);

	if ($_REQUEST["isvip"] == 1) {
		$_POST["articleid"] = $_POST["obookid"];
	}

	$_POST["articleid"] = intval($_POST["articleid"]);

	if (empty($_POST["articleid"])) {
		$errors[] = $jieqiLang["article"]["draft_need_articleid"] . "<br />";
	}

	$articleid = 0;
	$articlename = "";
	$obookid = 0;

	if ($_REQUEST["isvip"] == 1) {
		include_once jieqi_path_inc("class/obook.php", "article");
		$obook_handler = &JieqiObookHandler::getInstance("JieqiObookHandler");
		$obook = $obook_handler->get($_POST["articleid"]);

		if (!is_object($obook)) {
			$errors[] = $jieqiLang["article"]["draft_noe_article"] . "<br />";
		}
		else {
			$articleid = $obook->getVar("articleid", "n");
			$articlename = $obook->getVar("obookname", "n");
			$obookid = $obook->getVar("obookid", "n");
		}
	}
	else {
		include_once jieqi_path_inc("class/article.php", "article");
		$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
		$article = $article_handler->get($_POST["articleid"]);

		if (!is_object($article)) {
			$errors[] = $jieqiLang["article"]["draft_noe_article"] . "<br />";
		}
		else {
			$articleid = $article->getVar("articleid", "n");
			$articlename = $article->getVar("articlename", "n");
			$obookid = 0;
		}
	}

	if (empty($errors)) {
		$draftsize = jieqi_strsize($_POST["chaptercontent"]);
		$tmpattachary = @jieqi_unserialize($draft->getVar("attachment", "n"));
		if (is_array($tmpattachary) && (0 < jieqi_count($tmpattachary))) {
			include_once jieqi_path_inc("class/articleattachs.php", "article");
			$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");

			if (!is_array($_POST["oldattach"])) {
				if (is_string($_POST["oldattach"]) && (0 < strlen($_POST["oldattach"]))) {
					$_POST["oldattach"] = array($_POST["oldattach"]);
				}
				else {
					$_POST["oldattach"] = array();
				}
			}

			$oldattachary = array();

			foreach ($tmpattachary as $val ) {
				if (in_array($val["attachid"], $_POST["oldattach"])) {
					$oldattachary[] = $val;
				}
				else {
					$attachs_handler->delete($val["attachid"]);
					$afname = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article") . jieqi_getsubdir($draft->getVar("articleid", "n")) . "/" . $draft->getVar("articleid", "n") . "/0" . $draft->getVar("draftid", "n") . "/" . $val["attachid"] . "." . $val["postfix"];
					jieqi_delfile($afname);
				}
			}
		}
		else {
			$oldattachary = array();
		}

		if (0 < jieqi_count($attachvars["info"])) {
			include_once jieqi_path_inc("class/articleattachs.php", "article");

			if (!is_object($attachs_handler)) {
				$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
			}

			$attachdir = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article");
			$attachdir .= jieqi_getsubdir($draft->getVar("articleid"));
			$attachdir .= "/" . $draft->getVar("articleid");
			$attachdir .= "/0" . $draft->getVar("draftid");
			jieqi_checkdir($attachdir, true);
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

			foreach ($attachvars["info"] as $k => $v ) {
				$fileid = $attachvars["id"][$k];
				$newAttach = $attachs_handler->create();
				$newAttach->setVar("articleid", $draft->getVar("articleid", "n"));
				$newAttach->setVar("chapterid", -$draft->getVar("draftid", "n"));
				$newAttach->setVar("name", $v["name"]);
				$newAttach->setVar("class", $v["class"]);
				$newAttach->setVar("postfix", $v["postfix"]);
				$newAttach->setVar("size", $v["size"]);
				$newAttach->setVar("hits", 0);
				$newAttach->setVar("needexp", 0);
				$newAttach->setVar("uptime", $draft->getVar("postdate", "n"));

				if ($attachs_handler->insert($newAttach)) {
					$attachid = $newAttach->getVar("attachid");
					$attachvars["info"][$k]["attachid"] = $attachid;
				}
				else {
					$attachvars["info"][$k]["attachid"] = 0;
				}

				$attach_save_path = $attachdir . "/" . $attachvars["info"][$k]["attachid"] . "." . $v["postfix"];
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

		foreach ($attachvars["info"] as $val ) {
			$oldattachary[] = $val;
		}

		if (0 < jieqi_count($oldattachary)) {
			$attachinfo = serialize($oldattachary);
			$wordlen = (defined("JIEQI_SYSTEM_SBYTE") && (0 < JIEQI_SYSTEM_SBYTE) ? 1 : (JIEQI_SYSTEM_CHARSET == "utf-8" ? 3 : 2));
			$draftsize += jieqi_count($oldattachary) * $wordlen;
		}
		else {
			$attachinfo = "";
		}

		$draft->setVar("attachment", $attachinfo);
		$draft->setVar("articleid", $articleid);
		$draft->setVar("articlename", $articlename);
		$draft->setVar("isvip", $_REQUEST["isvip"]);
		$draft->setVar("obookid", $obookid);
		$draft->setVar("lastupdate", JIEQI_NOW_TIME);
		$draft->setVar("chaptername", $_POST["chaptername"]);
		$draft->setVar("chaptercontent", $_POST["chaptercontent"]);
		$draft->setVar("size", $draftsize);
		$saleprice = -1;
		if (($_REQUEST["isvip"] == 1) && is_numeric($_POST["saleprice"])) {
			$saleprice = intval($_POST["saleprice"]);
			if (!$customprice && ($saleprice != 0)) {
				$saleprice = -1;
			}

			if ($saleprice < 0) {
				$saleprice = -1;
			}
		}

		$draft->setVar("saleprice", $saleprice);

		if ($_POST["uptiming"] == 1) {
			$draft->setVar("ispub", 1);
			$draft->setVar("pubdate", $_POST["pubtime"]);
		}
		else {
			$draft->setVar("ispub", 0);
			$draft->setVar("pubdate", 0);
		}

		if (!$draft_handler->insert($draft)) {
			jieqi_printfail($jieqiLang["article"]["draft_edit_failure"]);
		}
		else {
			jieqi_jumppage($jieqiModules["article"]["url"] . "/admin/draftshow.php?id=" . $_REQUEST["id"], LANG_DO_SUCCESS, $jieqiLang["article"]["draft_edit_success"], true);
		}
	}
	else {
		jieqi_printfail(implode("<br />", $errors));
	}

	break;

case "edit":
default:
	include_once jieqi_path_common("admin/header.php");
	$articleid = intval($draft->getVar("articleid"));
	$obookid = intval($draft->getVar("obookid"));
	if ((0 < $obookid) && ($articleid == 0)) {
		$articleid = $obookid;
	}

	if ((0 < $isvip) && ($obookid == 0)) {
		$obookid = $articleid;
	}

	$articlerows = array();
	include_once jieqi_path_inc("class/article.php", "article");
	$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
	$criteria = new CriteriaCompo(new Criteria("authorid", $_SESSION["jieqiUserId"]));
	$criteria->setLimit(100);
	$article_handler->queryObjects($criteria);
	$k = 0;

	while ($v = $article_handler->getObject()) {
		$articlerows[$k]["articleid"] = $v->getVar("articleid");
		$articlerows[$k]["articlename"] = $v->getVar("articlename");

		if ($articleid == $articlerows[$k]["articleid"]) {
			$articlerows[$k]["checked"] = 1;
		}
		else {
			$articlerows[$k]["checked"] = 0;
		}

		$k++;
	}

	$jieqiTpl->assign_by_ref("articlerows", $articlerows);
	include_once jieqi_path_inc("class/obook.php", "obook");
	$obook_handler = &JieqiObookHandler::getInstance("JieqiObookHandler");
	$obook_handler->queryObjects($criteria);
	$obookrows = array();
	$k = 0;

	while ($v = $obook_handler->getObject()) {
		$obookrows[$k]["obookid"] = $v->getVar("obookid");
		$obookrows[$k]["obookname"] = $v->getVar("obookname");

		if ($obookid == $obookrows[$k]["obookid"]) {
			$obookrows[$k]["checked"] = 1;
		}
		else {
			$obookrows[$k]["checked"] = 0;
		}

		$k++;
	}

	$jieqiTpl->assign_by_ref("obookrows", $obookrows);
	$jieqiTpl->assign("articleid", $articleid);
	$jieqiTpl->assign("articlename", $draft->getVar("articlename"));
	$jieqiTpl->assign("obookid", $obookid);
	$jieqiTpl->assign("draftid", $draft->getVar("draftid", "n"));
	$jieqiTpl->assign("isvip", $isvip);
	$jieqiTpl->assign("chaptername", $draft->getVar("chaptername", "e"));
	$jieqiTpl->assign("chaptercontent", $draft->getVar("chaptercontent", "e"));
	$jieqiTpl->assign("id", $_REQUEST["id"]);
	$pubdate = intval($draft->getVar("pubdate"));
	$jieqiTpl->assign("pubdate", $pubdate);

	if (0 < $pubdate) {
		$jieqiTpl->assign("pubyear", date("Y", $pubdate));
		$jieqiTpl->assign("pubmonth", date("m", $pubdate));
		$jieqiTpl->assign("pubday", date("d", $pubdate));
		$jieqiTpl->assign("pubhour", date("H", $pubdate));
		$jieqiTpl->assign("pubminute", date("i", $pubdate));
		$jieqiTpl->assign("pubsecond", date("s", $pubdate));
	}
	else {
		$jieqiTpl->assign("pubyear", date("Y", JIEQI_NOW_TIME));
		$jieqiTpl->assign("pubmonth", date("m", JIEQI_NOW_TIME));
		$jieqiTpl->assign("pubday", date("d", JIEQI_NOW_TIME));
	}

	if ($customprice) {
		$jieqiTpl->assign("customprice", 1);
	}
	else {
		$jieqiTpl->assign("customprice", 0);
	}

	$jieqiTpl->assign("egoldname", JIEQI_EGOLD_NAME);
	$saleprice = $draft->getVar("saleprice", "n");

	if ($saleprice < 0) {
		$saleprice = "";
	}

	$jieqiTpl->assign("saleprice", $saleprice);
	$jieqiTpl->assign("authtypeset", $jieqiConfigs["article"]["authtypeset"]);
	$jieqiTpl->assign("canupload", $canupload);
	if ($canupload && is_numeric($jieqiConfigs["article"]["maxattachnum"]) && (0 < $jieqiConfigs["article"]["maxattachnum"])) {
		$maxattachnum = intval($jieqiConfigs["article"]["maxattachnum"]);
	}
	else {
		$maxattachnum = 0;
	}

	$jieqiTpl->assign("maxattachnum", $maxattachnum);
	$jieqiTpl->assign("attachtype", $jieqiConfigs["article"]["attachtype"]);
	$jieqiTpl->assign("maximagesize", $jieqiConfigs["article"]["maximagesize"]);
	$jieqiTpl->assign("maxfilesize", $jieqiConfigs["article"]["maxfilesize"]);
	$tmpvar = $draft->getVar("attachment", "n");
	$attachnum = 0;
	$attachrows = array();

	if (!empty($tmpvar)) {
		$attachrows = jieqi_unserialize($tmpvar);

		if (!is_array($attachrows)) {
			$attachrows = array();
		}

		$attachurl = jieqi_geturl("article", "attach", $draft->getVar("articleid", "n"), "0" . $draft->getVar("draftid", "n"));

		foreach ($attachrows as $k => $v ) {
			$attachrows[$k]["url"] = $attachurl . "/" . $v["attachid"] . "." . $v["postfix"];
		}

		$attachnum = jieqi_count($attachrows);
		$attachrows = jieqi_funtoarray("jieqi_htmlstr", $attachrows);
	}

	$jieqiTpl->assign("attachnum", $attachnum);
	$jieqiTpl->assign_by_ref("attachrows", $attachrows);
	$jieqiTpl->assign("uptiming", intval($jieqiConfigs["article"]["uptiming"]));
	$jieqiTpl->assign("authorarea", 1);
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/draftedit.html", "article");
	include_once jieqi_path_common("admin/footer.php");
	break;
}

?>
