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
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
include_once jieqi_path_inc("class/draft.php", "article");
$draft_handler = &JieqiDraftHandler::getInstance("JieqiDraftHandler");
$draft = $draft_handler->get($_REQUEST["id"]);

if (!$draft) {
	jieqi_printfail($jieqiLang["article"]["draft_not_exists"]);
}

$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/draftshow.html", "article");
include_once jieqi_path_common("admin/header.php");
$draftvals = jieqi_query_rowvars($draft);
$attachary = @jieqi_unserialize($draft->getVar("attachment", "n"));

if (!empty($attachary)) {
	$attachurl = jieqi_geturl("article", "attach", $draft->getVar("articleid", "n"), "0" . $draft->getVar("draftid", "n"));
	$image_code = $jieqiConfigs["article"]["pageimagecode"];
	if (empty($image_code) || !preg_match("/\<img/is", $image_code)) {
		$image_code = "<div class=\"divimage\"><img src=\"<{\$imageurl}>\" border=\"0\" class=\"imagecontent\"></div>";
	}

	$attachimage = "";
	$attachfile = "";

	foreach ($attachary as $attachvar ) {
		$url = $attachurl . "/" . $attachvar["attachid"] . "." . $attachvar["postfix"];

		if ($attachvar["class"] == "image") {
			$attachimage .= str_replace("<{\$imageurl}>", $url, $image_code);
		}
		else {
			$attachfile .= "<strong>file:</strong><a href=\"" . $url . "\">" . $url . "</a>(" . ceil($attachvar["size"] / 1024) . "K)<br /><br />";
		}
	}

	if (!empty($attachimage) || !empty($attachfile)) {
		if (!empty($draftvals["chaptercontent"])) {
			$draftvals["chaptercontent"] .= "<br /><br />";
		}

		$draftvals["chaptercontent"] .= $attachimage . $attachfile;
	}
}

$jieqiTpl->assign_by_ref("draftvals", $draftvals);
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("admin/footer.php");

?>
