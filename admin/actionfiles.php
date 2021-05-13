<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("../global.php");
include_once jieqi_path_inc("class/power.php", "system");
$power_handler = &JieqiPowerHandler::getInstance("JieqiPowerHandler");
$power_handler->getSavedVars("system");
jieqi_checkpower($jieqiPower["system"]["adminblock"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("blocks", JIEQI_MODULE_NAME);
jieqi_loadlang("action", JIEQI_MODULE_NAME);
jieqi_getconfigs("system", "actionfiles", "jieqiActionfiles");
include_once jieqi_path_common("admin/header.php");
if (!isset($_POST["act"]) && isset($_GET["act"]) && in_array($_GET["act"], array("files", "blocks", "edit"))) {
	$_POST["act"] = $_GET["act"];
}

if (empty($_POST["act"])) {
	$_POST["act"] = "files";
}

switch ($_POST["act"]) {
case "blocks":
	if (empty($_REQUEST["module"]) || !preg_match("/^\w+$/", $_REQUEST["module"]) || empty($_REQUEST["filename"]) || !preg_match("/^\w+$/", $_REQUEST["filename"])) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	unset($jieqiAction);
	jieqi_getconfigs($_REQUEST["module"], $_REQUEST["filename"], "jieqiAction");

	if (!isset($jieqiAction)) {
		jieqi_printfail($jieqiLang["system"]["block_config_notexists"]);
	}

	$action = array();

	foreach ($jieqiAction[jieqi_htmlstr($_REQUEST["module"])] as $i => $value ) {
		$action[$i]["acttitle"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["acttitle"];
		$action[$i]["minscore"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["minscore"];
		$action[$i]["islog"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["islog"];
		$action[$i]["isreview"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["isreview"];
		$action[$i]["isvip"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["isvip"];
		$action[$i]["ispay"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["ispay"];
		$action[$i]["paytitle"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["paytitle"];
		$action[$i]["paybase"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["paybase"];
		$action[$i]["paymin"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["paymin"];
		$action[$i]["paymax"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["paymax"];
		$action[$i]["earnscore"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["earnscore"];
		$action[$i]["earncredit"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["earncredit"];
		$action[$i]["lenmin"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["lenmin"];
		$action[$i]["lenmax"] = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$i]["lenmax"];
	}

	$jieqiTpl->assign_by_ref("action", $action);
	$jieqiTpl->assign("module", jieqi_htmlstr($_REQUEST["module"]));
	$jieqiTpl->assign("filename", jieqi_htmlstr($_REQUEST["filename"]));
	$modname = (isset($jieqiModules[$_REQUEST["module"]]["caption"]) ? $jieqiModules[$_REQUEST["module"]]["caption"] : $_REQUEST["module"]);
	$jieqiTpl->assign("modname", jieqi_htmlstr($modname));
	$blockfile = array();

	foreach ($jieqiActionfiles as $k => $v ) {
		if (($v["module"] == $_REQUEST["module"]) && ($v["filename"] == $_REQUEST["filename"])) {
			$blockfile = $v;
			break;
		}
	}

	$blockfile = jieqi_funtoarray("jieqi_htmlstr", $blockfile);
	$jieqiTpl->assign_by_ref("blockfile", $blockfile);
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/actionblocks.html", "system");
	include_once jieqi_path_common("admin/footer.php");
	break;

case "edit":
	if (empty($_REQUEST["module"]) || !preg_match("/^\w+$/", $_REQUEST["module"]) || empty($_REQUEST["filename"]) || !preg_match("/^\w+$/", $_REQUEST["filename"]) || empty($_REQUEST["key"])) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	unset($jieqiAction);
	jieqi_getconfigs($_REQUEST["module"], $_REQUEST["filename"], "jieqiAction");

	if (!isset($jieqiAction)) {
		jieqi_printfail($jieqiLang["system"]["block_config_notexists"]);
	}

	if (!isset($jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$_REQUEST["key"]])) {
		jieqi_printfail($jieqiLang["system"]["block_not_exists"]);
	}

	$actionSet = $jieqiAction[jieqi_htmlstr($_REQUEST["module"])][$_REQUEST["key"]];
	include_once jieqi_path_lib("html/formloader.php");
	$action_form = new JieqiThemeForm($jieqiLang["system"]["edit_action"], "actionedit", JIEQI_URL . "/admin/actionfiles.php?module=" . urlencode($_REQUEST["module"]) . "&filename=" . urlencode($_REQUEST["filename"]) . "&key=" . urlencode($_REQUEST["key"]));
	$acttitle = $actionSet["acttitle"];
	$action_form->addElement(new JieqiFormLabel($jieqiLang["system"]["table_action_acttitle"], jieqi_htmlstr($acttitle)));

	if (isset($jieqiModules[$_REQUEST["module"]])) {
		$action_form->addElement(new JieqiFormLabel($jieqiLang["system"]["table_blocks_modname"], jieqi_htmlstr($jieqiModules[$_REQUEST["module"]]["caption"])));
	}
	else {
		$action_form->addElement(new JieqiFormLabel($jieqiLang["system"]["table_blocks_modname"], LANG_UNKNOWN));
	}

	if (isset($_REQUEST["key"])) {
		$action_form->addElement(new JieqiFormLabel($jieqiLang["system"]["table_action_key"], jieqi_htmlstr($_REQUEST["key"])));
	}

	$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_minscore"], "minscore", 30, 50, htmlspecialchars($actionSet["minscore"], ENT_QUOTES)), true);
	$islog = new JieqiFormRadio($jieqiLang["system"]["table_action_islog"], "islog", htmlspecialchars($actionSet["islog"], ENT_QUOTES));
	$islog->addOption(0, $jieqiLang["system"]["table_action_off"]);
	$islog->addOption(1, $jieqiLang["system"]["table_action_on"]);
	$action_form->addElement($islog);

	if ($_REQUEST["module"] != "system") {
		$isreview = new JieqiFormRadio($jieqiLang["system"]["table_action_isreview"], "isreview", htmlspecialchars($actionSet["islog"], ENT_QUOTES));
		$isreview->addOption(0, $jieqiLang["system"]["table_action_off"]);
		$isreview->addOption(1, $jieqiLang["system"]["table_action_on"]);
		$action_form->addElement($isreview);
	}

	$isvip = new JieqiFormRadio($jieqiLang["system"]["table_action_isvip"], "isvip", htmlspecialchars($actionSet["islog"], ENT_QUOTES));
	$isvip->addOption(0, $jieqiLang["system"]["table_action_off"]);
	$isvip->addOption(1, $jieqiLang["system"]["table_action_on"]);
	$action_form->addElement($isvip);
	$ispay = new JieqiFormRadio($jieqiLang["system"]["table_action_ispay"], "ispay", htmlspecialchars($actionSet["islog"], ENT_QUOTES));
	$ispay->addOption(0, $jieqiLang["system"]["table_action_off"]);
	$ispay->addOption(1, $jieqiLang["system"]["table_action_on"]);
	$action_form->addElement($ispay);
	$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_paytitle"], "paytitle", 30, 50, htmlspecialchars($actionSet["paytitle"], ENT_QUOTES)), true);
	$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_paybase"], "paybase", 30, 50, htmlspecialchars($actionSet["paybase"], ENT_QUOTES)), true);
	$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_paymin"], "paymin", 30, 50, htmlspecialchars($actionSet["paymin"], ENT_QUOTES)), true);
	$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_paymax"], "paymax", 30, 50, htmlspecialchars($actionSet["paymax"], ENT_QUOTES)), true);
	$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_earnscore"], "earnscore", 30, 50, htmlspecialchars($actionSet["earnscore"], ENT_QUOTES)), true);
	$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_earncredit"], "earncredit", 30, 50, htmlspecialchars($actionSet["earncredit"], ENT_QUOTES)), true);

	if ($_REQUEST["key"] == "register") {
		$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_lenmin"], "lenmin", 30, 50, htmlspecialchars($actionSet["lenmin"], ENT_QUOTES)), true);
		$action_form->addElement(new JieqiFormText($jieqiLang["system"]["table_action_lenmax"], "lenmax", 30, 50, htmlspecialchars($actionSet["lenmax"], ENT_QUOTES)), true);
	}

	$action_form->addElement(new JieqiFormHidden("act", "update"));
	$action_form->addElement(new JieqiFormHidden(JIEQI_TOKEN_NAME, $_SESSION["jieqiUserToken"]));
	$action_form->addElement(new JieqiFormButton("&nbsp;", "submit", $jieqiLang["system"]["save_block"], "submit"));
	$jieqiTpl->setCaching(0);
	$jieqiTpl->assign("jieqi_contents", "<br />" . $action_form->render(JIEQI_FORM_MAX) . "<br />");
	include_once jieqi_path_common("admin/footer.php");
	break;

case "update":
	jieqi_checkpost();
	if (empty($_REQUEST["module"]) || !preg_match("/^\w+$/", $_REQUEST["module"]) || empty($_REQUEST["filename"]) || !preg_match("/^\w+$/", $_REQUEST["filename"]) || empty($_REQUEST["key"])) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	unset($jieqiAction);
	jieqi_getconfigs($_REQUEST["module"], $_REQUEST["filename"], "jieqiAction");

	if (!isset($jieqiAction)) {
		jieqi_printfail($jieqiLang["system"]["block_config_notexists"]);
	}

	if (!isset($jieqiAction[$_REQUEST["module"]][$_REQUEST["key"]])) {
		jieqi_printfail($jieqiLang["system"]["block_not_exists"]);
	}

	$actionSet = $jieqiAction[$_REQUEST["module"]][$_REQUEST["key"]];
	$jieqiAction[$_REQUEST["module"]][$_REQUEST["key"]] = array("acttitle" => $actionSet["acttitle"], "minscore" => $_REQUEST["minscore"], "islog" => $_REQUEST["islog"], "isreview" => $_REQUEST["isreview"], "isvip" => $_REQUEST["isvip"], "ispay" => $_REQUEST["ispay"], "paytitle" => $_REQUEST["paytitle"], "paybase" => $_REQUEST["paybase"], "paymin" => $_REQUEST["paymin"], "paymax" => $_REQUEST["paymax"], "earnscore" => $_REQUEST["earnscore"], "earncredit" => $_REQUEST["earncredit"], "lenmin" => $_REQUEST["lenmin"], "lenmax" => $_REQUEST["lenmax"]);
	jieqi_setconfigs($_REQUEST["filename"], "jieqiAction", $jieqiAction, $_REQUEST["module"]);
	jieqi_jumppage(JIEQI_URL . "/admin/actionfiles.php?act=blocks&module=" . urlencode($_REQUEST["module"]) . "&filename=" . urlencode($_REQUEST["filename"]), LANG_DO_SUCCESS, $jieqiLang["system"]["action_update_success"]);
	break;

case "updatelist":
	jieqi_checkpost();
	if (empty($_REQUEST["module"]) || !preg_match("/^\w+$/", $_REQUEST["module"]) || empty($_REQUEST["filename"]) || !preg_match("/^\w+$/", $_REQUEST["filename"])) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	unset($jieqiAction);
	jieqi_getconfigs($_REQUEST["module"], $_REQUEST["filename"], "jieqiAction");

	if (!isset($jieqiAction)) {
		jieqi_printfail($jieqiLang["system"]["block_config_notexists"]);
	}

	$newBlocks = array();
	$kk = -1;

	foreach ($_REQUEST["key"] as $oldk => $newk ) {
		$kk = $newk;
		$newAction[$_REQUEST["module"]][$newk] = $jieqiAction[$_REQUEST["module"]][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["minscore"] = $_REQUEST["minscore"][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["islog"] = $_REQUEST["islog"][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["isreview"] = $_REQUEST["isreview"][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["isvip"] = $_REQUEST["isvip"][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["ispay"] = $_REQUEST["ispay"][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["paytitle"] = $_REQUEST["paytitle"][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["paybase"] = $_REQUEST["paybase"][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["paymin"] = $_REQUEST["paymin"][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["paymax"] = $_REQUEST["paymax"][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["earnscore"] = $_REQUEST["earnscore"][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["earncredit"] = $_REQUEST["earncredit"][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["lenmin"] = $_REQUEST["lenmin"][$oldk];
		$newAction[$_REQUEST["module"]][$newk]["lenmax"] = $_REQUEST["lenmax"][$oldk];
	}

	jieqi_setconfigs($_REQUEST["filename"], "jieqiAction", $newAction, $_REQUEST["module"]);
	jieqi_jumppage(JIEQI_URL . "/admin/actionfiles.php?act=blocks&module=" . urlencode($_REQUEST["module"]) . "&filename=" . urlencode($_REQUEST["filename"]), LANG_DO_SUCCESS, $jieqiLang["system"]["block_update_success"]);
	break;

case "files":
default:
	foreach ($jieqiActionfiles as $k => $v ) {
		$jieqiActionfiles[$k]["modname"] = $jieqiModules[$v["module"]]["caption"];
	}

	$blockfiles = jieqi_funtoarray("jieqi_htmlstr", $jieqiActionfiles);
	$jieqiTpl->assign_by_ref("actionfiles", $jieqiActionfiles);
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/actionfiles.html", "system");
	include_once jieqi_path_common("admin/footer.php");
	break;
}

?>
