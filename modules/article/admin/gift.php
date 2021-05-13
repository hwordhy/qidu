<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["adminconfig"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("gift", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "gift", "jieqiGift");
jieqi_getconfigs(JIEQI_MODULE_NAME, "action", "jieqiAction");
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
	if (isset($jieqiGift["article"][$_POST["gid"]]) || !preg_match("/^[a-zA-Z\s]+$/", $_POST["gid"])) {
		$errtext .= $jieqiLang["article"]["need_gift_gid"] . "<br />";
	}

	if (empty($_POST["caption"])) {
		$errtext .= $jieqiLang["article"]["need_gift_caption"] . "<br />";
	}

	if (!is_numeric($_POST["price"])) {
		$errtext .= $jieqiLang["article"]["need_gift_price"] . "<br />";
	}

	$_POST["price"] = intval($_POST["price"]);
	$lasttime = "last" . $_POST["gid"];
	$daygift = "day" . $_POST["gid"];
	$weekgift = "week" . $_POST["gid"];
	$monthgift = "month" . $_POST["gid"];
	$allgift = "all" . $_POST["gid"];
	jieqi_includedb();
	$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
	$sql = "ALTER TABLE " . jieqi_dbprefix("article_article") . " ADD (`" . $lasttime . "` int(11) unsigned NOT NULL DEFAULT '0', `" . $daygift . "` int(11) unsigned NOT NULL DEFAULT '0', `" . $weekgift . "` int(11) unsigned NOT NULL DEFAULT '0', `" . $monthgift . "` int(11) unsigned NOT NULL DEFAULT '0', `" . $allgift . "` int(11) unsigned NOT NULL DEFAULT '0')";

	if (!$query->execute($sql)) {
		$errtext .= $jieqiLang["article"]["add_gift_error"] . "<br />";
	}

	if (empty($errtext)) {
		$jieqiGift["article"][$_POST["gid"]] = array("caption" => $_POST["caption"], "price" => $_POST["price"], "display" => $_POST["display"], "describe" => $_POST["describe"]);

		foreach ($jieqiGift["article"] as $v => $k ) {
			$price[$v] = $k["price"];
		}

		array_multisort($price, SORT_ASC, $jieqiGift["article"]);
		$jieqiCredit["article"] = array_sort($jieqiGift["article"], "price");
		jieqi_setconfigs("gift", "jieqiGift", $jieqiGift, "article");
		$jieqiAction["article"][$_POST["gid"]] = array("acttitle" => $_POST["caption"], "minscore" => 0, "islog" => 1, "isreview" => 1, "isvip" => 1, "ispay" => 1, "paytitle" => $_POST["caption"], "paybase" => 1, "paymin" => 0, "paymax" => 0, "earnscore" => 1, "earncredit" => 0, "lenmin" => "", "lenmax" => "");
		jieqi_setconfigs("action", "jieqiAction", $jieqiAction, "article");
		jieqi_jumppage($article_dynamic_url . "/admin/gift.php", LANG_DO_SUCCESS, $jieqiLang["article"]["gift_new_success"]);
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case "delete":
	jieqi_checkpost();

	if (empty($_REQUEST["gid"])) {
		jieqi_printfail($jieqiLang["article"]["need_not_gid"]);
	}

	$lasttime = "last" . $_POST["gid"];
	$daygift = "day" . $_POST["gid"];
	$weekgift = "week" . $_POST["gid"];
	$monthgift = "month" . $_POST["gid"];
	$allgift = "all" . $_POST["gid"];
	jieqi_includedb();
	$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
	$sql = "DELETE FROM " . jieqi_dbprefix("article_actlog") . " WHERE actname = '" . $_POST["gid"] . "'";

	if (!$query->execute($sql)) {
		jieqi_printfail($jieqiLang["article"]["delete_actlog_error"]);
	}

	$sql2 = "ALTER TABLE " . jieqi_dbprefix("article_article") . " DROP COLUMN " . $lasttime . ", DROP COLUMN " . $daygift . ", DROP COLUMN " . $weekgift . ", DROP COLUMN " . $monthgift . ", DROP COLUMN " . $allgift;

	if (!$query->execute($sql2)) {
		jieqi_printfail($jieqiLang["article"]["delete_gift_error"]);
	}

	unset($jieqiGift["article"][$_POST["gid"]]);
	jieqi_setconfigs("gift", "jieqiGift", $jieqiGift, "article");
	unset($jieqiAction["article"][$_POST["gid"]]);
	jieqi_setconfigs("action", "jieqiAction", $jieqiAction, "article");
	jieqi_jumppage($article_dynamic_url . "/admin/gift.php", "", "", true);
	break;

case "update":
	jieqi_checkpost();

	if (!empty($_REQUEST["gid"])) {
		if (isset($jieqiGift["article"][$_REQUEST["gid"]])) {
			$errtext = "";

			if (empty($_POST["caption"])) {
				$errtext .= $jieqiLang["article"]["need_gift_caption"] . "<br />";
			}

			if (!is_numeric($_POST["price"])) {
				$errtext .= $jieqiLang["article"]["need_gift_price"] . "<br />";
			}

			$_POST["price"] = intval($_POST["price"]);

			if (empty($errtext)) {
				$jieqiGift["article"][$_POST["gid"]] = array("caption" => $_POST["caption"], "price" => $_POST["price"], "display" => $_POST["display"], "describe" => $_POST["describe"]);

				foreach ($jieqiGift["article"] as $v => $k ) {
					$price[$v] = $k["price"];
				}

				array_multisort($price, SORT_ASC, $jieqiGift["article"]);
				jieqi_setconfigs("gift", "jieqiGift", $jieqiGift, "article");
				jieqi_jumppage($article_dynamic_url . "/admin/gift.php", LANG_DO_SUCCESS, $jieqiLang["article"]["gift_update_success"]);
			}
			else {
				jieqi_printfail($errtext);
			}
		}
	}

	break;

case "edit":
	if (!empty($_REQUEST["gid"])) {
		if (isset($jieqiGift["article"][$_REQUEST["gid"]])) {
			include_once jieqi_path_common("admin/header.php");
			$gift_form = new JieqiThemeForm($jieqiLang["article"]["edit_gift"], "giftedit", $article_dynamic_url . "/admin/gift.php");
			$gift_form->addElement(new JieqiFormText($jieqiLang["article"]["table_gift_caption"], "caption", 30, 250, $jieqiGift["article"][$_REQUEST["gid"]]["caption"]), true);
			$gift_form->addElement(new JieqiFormText($jieqiLang["article"]["table_gift_price"], "price", 30, 250, $jieqiGift["article"][$_REQUEST["gid"]]["price"]), true);
			$gift_form->addElement(new JieqiFormTextArea($jieqiLang["article"]["table_gift_describe"], "describe", $jieqiGift["article"][$_REQUEST["gid"]]["describe"], 5, 50));
			$display = new JieqiFormRadio($jieqiLang["article"]["table_gift_display"], "display", htmlspecialchars($jieqiGift["article"][$_REQUEST["gid"]]["display"], ENT_QUOTES));
			$display->addOption(0, $jieqiLang["article"]["table_gift_off"]);
			$display->addOption(1, $jieqiLang["article"]["table_gift_on"]);
			$gift_form->addElement($display);
			$gift_form->addElement(new JieqiFormHidden("act", "update"));
			$gift_form->addElement(new JieqiFormHidden(JIEQI_TOKEN_NAME, $_SESSION["jieqiUserToken"]));
			$gift_form->addElement(new JieqiFormHidden("gid", $_REQUEST["gid"]));
			$gift_form->addElement(new JieqiFormButton("&nbsp;", "submit", LANG_SAVE, "submit"));
			$jieqiTpl->assign("jieqi_contents", "<br />" . $gift_form->render(JIEQI_FORM_MAX) . "<br />");
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
$gift_form = new JieqiThemeForm($jieqiLang["article"]["add_gift"], "giftnew", $article_dynamic_url . "/admin/gift.php");
$gift_form->addElement(new JieqiFormText($jieqiLang["article"]["table_gift_gid"], "gid", 30, 250, ""), true);
$gift_form->addElement(new JieqiFormText($jieqiLang["article"]["table_gift_caption"], "caption", 30, 250, ""), true);
$gift_form->addElement(new JieqiFormText($jieqiLang["article"]["table_gift_price"], "price", 30, 50, ""), true);
$gift_form->addElement(new JieqiFormTextArea($jieqiLang["article"]["table_gift_describe"], "describe", "", 5, 50));
$display = new JieqiFormRadio($jieqiLang["article"]["table_gift_display"], "display", true);
$display->addOption(0, $jieqiLang["article"]["table_gift_off"]);
$display->addOption(1, $jieqiLang["article"]["table_gift_on"]);
$gift_form->addElement($display);
$gift_form->addElement(new JieqiFormHidden("act", "new"));
$gift_form->addElement(new JieqiFormHidden(JIEQI_TOKEN_NAME, $_SESSION["jieqiUserToken"]));
$gift_form->addElement(new JieqiFormButton("&nbsp;", "submit", $jieqiLang["article"]["add_gift"], "submit"));
$jieqiTpl->assign("form_addgift", "<br />" . $gift_form->render(JIEQI_FORM_MAX) . "<br />");
$jieqiTpl->assign_by_ref("gift", jieqi_funtoarray("jieqi_htmlstr", $jieqiGift["article"]));
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/gift.html", "article");
include_once jieqi_path_common("admin/footer.php");

?>
