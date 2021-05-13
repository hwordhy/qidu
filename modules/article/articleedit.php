<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
if (empty($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

$_REQUEST["id"] = intval($_REQUEST["id"]);
jieqi_loadlang("article", JIEQI_MODULE_NAME);
include_once jieqi_path_inc("class/article.php", "article");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
$article = $article_handler->get($_REQUEST["id"]);

if (!$article) {
	jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
$ismanager = jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
$allowtrans = jieqi_checkpower($jieqiPower["article"]["transarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
$canedit = $ismanager;
if (!$canedit && !empty($_SESSION["jieqiUserId"])) {
	if ((0 < $_SESSION["jieqiUserId"]) && (($article->getVar("authorid") == $_SESSION["jieqiUserId"]) || ($article->getVar("posterid") == $_SESSION["jieqiUserId"]) || ($article->getVar("agentid") == $_SESSION["jieqiUserId"]))) {
		$canedit = true;
	}
}

if (!$canedit) {
	jieqi_printfail($jieqiLang["article"]["noper_edit_article"]);
}

jieqi_getconfigs("article", "rule");
$actrule = true;

if (function_exists("jieqi_rule_article_articleedit")) {
	$actrule = jieqi_rule_article_articleedit($article);

	if ($actrule === false) {
		jieqi_printfail($jieqiLang["article"]["deny_edit_article"]);
	}
}

$denyfields = (is_array($actrule) ? $actrule : array());
$allowmodify = jieqi_checkpower($jieqiPower["article"]["articlemodify"], $jieqiUsersStatus, $jieqiUsersGroup, true);

if (!isset($_POST["act"])) {
	$_POST["act"] = "edit";
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "configs", "jieqiConfigs");
jieqi_getconfigs(JIEQI_MODULE_NAME, "option", "jieqiOption");
jieqi_getconfigs(JIEQI_MODULE_NAME, "sort", "jieqiSort");
jieqi_getconfigs("system", "sites", "jieqiSites");

if (!is_numeric($jieqiConfigs["article"]["eachlinknum"])) {
	$jieqiConfigs["article"]["eachlinknum"] = 0;
}
else {
	$jieqiConfigs["article"]["eachlinknum"] = intval($jieqiConfigs["article"]["eachlinknum"]);
}

$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);

switch ($_POST["act"]) {
case "update":
	jieqi_checkpost();

	if (!empty($denyfields)) {
		foreach ($denyfields as $k => $v ) {
			if (isset($_POST[$k])) {
				$_POST[$k] = $article->getVar($k, "n");
			}
		}
	}

	include_once jieqi_path_inc("include/actarticle.php", "article");
	$options = array("action" => "edit", "ismanager" => $ismanager, "allowtrans" => $allowtrans, "allowmodify" => $allowmodify);
	$errors = jieqi_article_articlepcheck($_POST, $options, $article);

	if (empty($errors)) {
		$article = jieqi_article_articleadd($_POST, $options, $article);

		if (is_object($article)) {
			$id = intval($article->getVar("articleid", "n"));

			if (JIEQI_USE_CACHE) {
				if (!is_a($jieqiTpl, "JieqiTpl")) {
					include_once jieqi_path_lib("template/template.php");
					$jieqiTpl = &JieqiTpl::getInstance();
				}

				$jieqiTpl->clear_cache($jieqiModules["article"]["path"] . "/templates/articleinfo.html", $id);
			}

			if (0 < $jieqiConfigs["article"]["fakestatic"]) {
				include_once jieqi_path_inc("include/funstatic.php", "article");
				article_update_static("articleedit", $id, $article->getVar("sortid", "n"));
			}

			jieqi_jumppage($article_static_url . "/articlemanage.php?id=" . $id, LANG_DO_SUCCESS, $jieqiLang["article"]["article_edit_success"]);
		}
		else {
			jieqi_printfail($article);
		}
	}
	else {
		jieqi_printfail(implode("<br />", $errors));
	}

	break;

case "edit":
default:
	include_once jieqi_path_common("header.php");
	include_once jieqi_path_inc("include/funarticle.php", "article");
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	$jieqiTpl->assign("url_articleedit", $article_static_url . "/articleedit.php?do=submit");
	jieqi_getconfigs(JIEQI_MODULE_NAME, "sort", "jieqiSort");
	$jieqiTpl->assign("sortrows", jieqi_funtoarray("jieqi_htmlstr", $jieqiSort["article"]));

	foreach ($jieqiOption["article"] as $k => $v ) {
		$jieqiTpl->assign($k, $jieqiOption["article"][$k]);
	}

	$articlevals = jieqi_article_vars($article, true, "e");

	if (0 < $article->getVar("authorid")) {
		$articlevals["authorflag"] = 1;
	}
	else {
		$articlevals["authorflag"] = 0;
	}

	$jieqiTpl->assign("eachlinknum", $jieqiConfigs["article"]["eachlinknum"]);

	if (0 < $jieqiConfigs["article"]["eachlinknum"]) {
		$setting = jieqi_unserialize($article->getVar("setting", "n"));

		if (!empty($setting["eachlink"]["ids"])) {
			$articlevals["eachlinkids"] = implode(" ", $setting["eachlink"]["ids"]);
		}
		else {
			$articlevals["eachlinkids"] = "";
		}
	}

	$jieqiTpl->assign_by_ref("articlevals", $articlevals);

	if (2 <= floatval(JIEQI_VERSION)) {
		include_once jieqi_path_inc("include/funtag.php", "system");
		$oldtags = jieqi_tag_clean($article->getVar("keywords", "n"));
		$jieqiTpl->assign("taglimit", intval($jieqiConfigs["article"]["taglimit"]));
		$tagwords = array();
		$tmpary = preg_split("/\s+/s", $jieqiConfigs["article"]["tagwords"]);
		$k = 0;

		foreach ($tmpary as $v ) {
			if (0 < strlen($v)) {
				$tagwords[$k]["name"] = jieqi_htmlstr($v);
				$tagwords[$k]["use"] = (in_array($v, $oldtags) ? 1 : 0);
				$k++;
			}
		}

		$jieqiTpl->assign_by_ref("tagwords", $tagwords);
		$jieqiTpl->assign_by_ref("tagnum", jieqi_count($tagwords));
	}

	$jieqiTpl->assign("imagetype", $jieqiConfigs["article"]["imagetype"]);
    $jieqiTpl->assign("wholebuy", $jieqiConfigs["article"]["wholebuy"]);
	$jieqiTpl->assign("allowtrans", intval($allowtrans));
	$jieqiTpl->assign("allowmodify", intval($allowmodify));
	$jieqiTpl->assign("ismanager", intval($ismanager));
	$ismatch = (empty($jieqiConfigs["article"]["ismatch"]) ? 0 : 1);
	$jieqiTpl->assign("ismatch", $ismatch);
	$wholebuy = (empty($jieqiConfigs["article"]["wholebuy"]) ? 0 : intval($jieqiConfigs["article"]["wholebuy"]));
	$jieqiTpl->assign("wholebuy", $wholebuy);

	if (2 <= floatval(JIEQI_VERSION)) {
		$customsites = array();

		foreach ($jieqiSites as $k => $v ) {
			if (!empty($v["custom"])) {
				$customsites[$k] = $v;
			}
		}

		$jieqiTpl->assign("customsites", jieqi_funtoarray("jieqi_htmlstr", $customsites));
		$jieqiTpl->assign("customsitenum", jieqi_count($customsites));
		$jieqiTpl->assign("jieqisites", jieqi_funtoarray("jieqi_htmlstr", $jieqiSites));
	}

	$jieqiTpl->assign("authorarea", 1);
	$jieqiTpl->assign("denyfields", $denyfields);
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("articleedit.html", "article");
	include_once jieqi_path_common("footer.php");
	break;
}

?>
