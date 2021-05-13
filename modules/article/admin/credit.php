<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("credit", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "credit", "jieqiCredit");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
include_once jieqi_path_lib("html/formloader.php");
if (!isset($_POST["act"]) && isset($_GET["act"]) && in_array($_GET["act"], array("show", "edit"))) {
	$_POST["act"] = $_GET["act"];
}

if (empty($_POST["act"])) {
	$_POST["act"] = "show";
}

switch ($_POST["act"]) {
case "new":
	jieqi_checkpost();
	$errtext = "";

	if (empty($_POST["caption"])) {
		$errtext .= $jieqiLang["article"]["need_credit_caption"] . "<br />";
	}

	if (!is_numeric($_POST["minnum"])) {
		$errtext .= $jieqiLang["article"]["need_credit_minnum"] . "<br />";
	}

	$_POST["minnum"] = intval($_POST["minnum"]);

	if (empty($errtext)) {
		$jieqiCredit["article"][$_POST["cid"]] = array("caption" => $_POST["caption"], "minnum" => $_POST["minnum"]);
		$jieqiCredit["article"] = array_sort($jieqiCredit["article"], "minnum");
		jieqi_setconfigs("credit", "jieqiCredit", $jieqiCredit, "article");
		jieqi_jumppage($article_dynamic_url . "/admin/credit.php", LANG_DO_SUCCESS, $jieqiLang["article"]["credit_new_success"]);
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case "delete":
	jieqi_checkpost();

	if (empty($_REQUEST["cid"])) {
		jieqi_printfail($jieqiLang["article"]["credit_not_exit"]);
	}

	unset($jieqiCredit["article"][$_POST["cid"]]);
	jieqi_setconfigs("credit", "jieqiCredit", $jieqiCredit, "article");
	jieqi_jumppage($article_dynamic_url . "/admin/credit.php", "", "", true);
	break;

case "update":
	jieqi_checkpost();

	if (!empty($_REQUEST["cid"])) {
		if (isset($jieqiCredit["article"][$_REQUEST["cid"]])) {
			$errtext = "";

			if (empty($_POST["caption"])) {
				$errtext .= $jieqiLang["article"]["need_credit_caption"] . "<br />";
			}

			if (!is_numeric($_POST["minnum"])) {
				$errtext .= $jieqiLang["article"]["need_credit_minnum"] . "<br />";
			}

			$_POST["minnum"] = intval($_POST["minnum"]);

			if (empty($errtext)) {
				$jieqiCredit["article"][$_POST["cid"]] = array("caption" => $_POST["caption"], "minnum" => $_POST["minnum"]);
				$jieqiCredit["article"] = array_sort($jieqiCredit["article"], "minnum");
				jieqi_setconfigs("credit", "jieqiCredit", $jieqiCredit, "article");
				jieqi_jumppage($article_dynamic_url . "/admin/credit.php", LANG_DO_SUCCESS, $jieqiLang["article"]["credit_update_success"]);
			}
			else {
				jieqi_printfail($errtext);
			}
		}
	}

	break;

case "edit":
	if (!empty($_REQUEST["cid"])) {
		if (isset($jieqiCredit["article"][$_REQUEST["cid"]])) {
			include_once jieqi_path_common("admin/header.php");
			$credit_form = new JieqiThemeForm($jieqiLang["article"]["edit_credit"], "creditedit", $article_dynamic_url . "/admin/credit.php");
			$credit_form->addElement(new JieqiFormText($jieqiLang["article"]["table_credit_caption"], "caption", 30, 250, $jieqiCredit["article"][$_REQUEST["cid"]]["caption"]), true);
			$credit_form->addElement(new JieqiFormText($jieqiLang["article"]["table_credit_minnum"], "minnum", 30, 250, $jieqiCredit["article"][$_REQUEST["cid"]]["minnum"]), true);
			$credit_form->addElement(new JieqiFormHidden("act", "update"));
			$credit_form->addElement(new JieqiFormHidden(JIEQI_TOKEN_NAME, $_SESSION["jieqiUserToken"]));
			$credit_form->addElement(new JieqiFormHidden("cid", $_REQUEST["cid"]));
			$credit_form->addElement(new JieqiFormButton("&nbsp;", "submit", LANG_SAVE, "submit"));
			$jieqiTpl->assign("jieqi_contents", "<br />" . $credit_form->render(JIEQI_FORM_MAX) . "<br />");
			include_once jieqi_path_common("admin/footer.php");
			exit();
		}
		else {
			jieqi_printfail($jieqiLang["article"]["need_not_gid"]);
		}
	}

	break;
}

include_once jieqi_path_common("admin/header.php");
$creditrows = array();
$k = 0;

foreach ($jieqiCredit["article"] as $v => $s ) {
	$creditrows[$k] = jieqi_funtoarray("jieqi_htmlstr", $s);
	include_once jieqi_path_inc("include/badgefunction.php", "badge");
	$creditrows[$k]["icourl"] = getbadgeurl(4, $v, 0, true);
	$cid = $v;
	$creditrows[$k]["cid"] = $v;
	$k++;
}

$credit_form = new JieqiThemeForm($jieqiLang["article"]["add_credit"], "creditnew", $article_dynamic_url . "/admin/credit.php");
$credit_form->addElement(new JieqiFormText($jieqiLang["article"]["table_credit_caption"], "caption", 30, 250, ""), true);
$credit_form->addElement(new JieqiFormText($jieqiLang["article"]["table_credit_minnum"], "minnum", 30, 50, ""), true);
$credit_form->addElement(new JieqiFormHidden("act", "new"));
$credit_form->addElement(new JieqiFormHidden("cid", $cid + 1));
$credit_form->addElement(new JieqiFormHidden(JIEQI_TOKEN_NAME, $_SESSION["jieqiUserToken"]));
$credit_form->addElement(new JieqiFormButton("&nbsp;", "submit", $jieqiLang["article"]["add_credit"], "submit"));
$jieqiTpl->assign("form_addCredit", "<br />" . $credit_form->render(JIEQI_FORM_MAX) . "<br />");
$jieqiTpl->assign_by_ref("creditrows", $creditrows);
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/credit.html", "article");
include_once jieqi_path_common("admin/footer.php");

?>
