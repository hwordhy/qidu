<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["adminconfig"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("top", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "top", "jieqiTop");
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
	if (isset($jieqiTop["article"][$_POST["tid"]]) || !preg_match("/^[a-zA-Z\s]+$/", $_POST["tid"])) {
		$errtext .= $jieqiLang["article"]["need_top_tid"] . "<br />";
	}

	if (empty($_POST["caption"])) {
		$errtext .= $jieqiLang["article"]["need_top_caption"] . "<br />";
	}

	if (empty($_POST["sort"])  || !preg_match("/^[a-zA-Z\s]+$/", $_POST["sort"])) {
		$errtext .= $jieqiLang["article"]["need_top_sort"] . "<br />";
	}

	if (empty($errtext)) {
        $jieqiTop["article"][$_POST["tid"]] = array('caption'=>$_POST["caption"], 'description'=>$_POST["description"], 'where'=>$_POST["where"], 'sort'=>$_POST["sort"], 'order'=>$_POST["order"], 'isvip'=>$_POST["isvip"], 'default'=>$_POST["default"], 'publish' => $_POST["publish"]);

		$jieqiCredit["article"] = array_sort($jieqiTop["article"], $_POST["tid"]);
		jieqi_setconfigs("top", "jieqiTop", $jieqiTop, "article");
		jieqi_jumppage($article_dynamic_url . "/admin/top.php", LANG_DO_SUCCESS, $jieqiLang["article"]["top_new_success"]);
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case "delete":
	jieqi_checkpost();

	if (empty($_REQUEST["tid"])) {
		jieqi_printfail($jieqiLang["article"]["need_not_tid"]);
	}

	unset($jieqiTop["article"][$_POST["tid"]]);
	jieqi_setconfigs("top", "jieqiTop", $jieqiTop, "article");
	jieqi_jumppage($article_dynamic_url . "/admin/top.php", "", "", true);
	break;

case "update":
	jieqi_checkpost();

	if (!empty($_REQUEST["tid"])) {
		if (isset($jieqiTop["article"][$_REQUEST["tid"]])) {
			$errtext = "";

			if (empty($_POST["caption"])) {
				$errtext .= $jieqiLang["article"]["need_top_caption"] . "<br />";
			}

            if (empty($_POST["sort"])  || !preg_match("/^[a-zA-Z\s]+$/", $_POST["sort"])) {
                $errtext .= $jieqiLang["article"]["need_top_sort"] . "<br />";
            }

			if (empty($errtext)) {

                $jieqiTop["article"][$_POST["tid"]] = array('caption'=>$_POST["caption"], 'description'=>$_POST["description"], 'where'=>$_POST["where"], 'sort'=>$_POST["sort"], 'order'=>$_POST["order"], 'isvip'=>$_POST["isvip"], 'default'=>$_POST["default"], 'publish' => $_POST["publish"]);

				jieqi_setconfigs("top", "jieqiTop", $jieqiTop, "article");
				jieqi_jumppage($article_dynamic_url . "/admin/top.php", LANG_DO_SUCCESS, $jieqiLang["article"]["top_update_success"]);
			}
			else {
				jieqi_printfail($errtext);
			}
		}
	}

	break;

case "edit":
	if (!empty($_REQUEST["tid"])) {
		if (isset($jieqiTop["article"][$_REQUEST["tid"]])) {
			include_once jieqi_path_common("admin/header.php");
			$top_form = new JieqiThemeForm($jieqiLang["article"]["edit_top"], "topedit", $article_dynamic_url . "/admin/top.php");
			$top_form->addElement(new JieqiFormText($jieqiLang["article"]["table_top_caption"], "caption", 30, 250, $jieqiTop["article"][$_REQUEST["tid"]]["caption"]), true);
            $top_form->addElement(new JieqiFormTextArea($jieqiLang["article"]["table_top_description"], "description", $jieqiTop["article"][$_REQUEST["tid"]]["description"], 5, 50));
            $top_form->addElement(new JieqiFormTextArea($jieqiLang["article"]["table_top_where"], "where", $jieqiTop["article"][$_REQUEST["tid"]]["where"], 5, 50));
            $top_form->addElement(new JieqiFormText($jieqiLang["article"]["table_top_sort"], "sort", 30, 50, $jieqiTop["article"][$_REQUEST["tid"]]["sort"]), true);
            $display4 = new JieqiFormRadio($jieqiLang["article"]["table_top_isvip"], "isvip", htmlspecialchars($jieqiTop["article"][$_REQUEST["tid"]]["isvip"], ENT_QUOTES));
            $display4->addOption(0, $jieqiLang["article"]["table_top_free"]);
            $display4->addOption(1, $jieqiLang["article"]["table_top_vip"]);
            $top_form->addElement($display4);
            $display = new JieqiFormRadio($jieqiLang["article"]["table_top_order"], "order", htmlspecialchars($jieqiTop["article"][$_REQUEST["tid"]]["order"], ENT_QUOTES));
            $display->addOption("DESC", $jieqiLang["article"]["table_top_desc"]);
            $display->addOption("ASC", $jieqiLang["article"]["table_top_asc"]);
            $top_form->addElement($display);
            $display2 = new JieqiFormRadio($jieqiLang["article"]["table_top_default"], "default", htmlspecialchars($jieqiTop["article"][$_REQUEST["tid"]]["default"], ENT_QUOTES));
            $display2->addOption(0, $jieqiLang["article"]["table_top_no"]);
            $display2->addOption(1, $jieqiLang["article"]["table_top_yes"]);
            $top_form->addElement($display2);
            $display3 = new JieqiFormRadio($jieqiLang["article"]["table_top_publish"], "publish", htmlspecialchars($jieqiTop["article"][$_REQUEST["tid"]]["publish"], ENT_QUOTES));
            $display3->addOption(0, $jieqiLang["article"]["table_top_no"]);
            $display3->addOption(1, $jieqiLang["article"]["table_top_yes"]);
            $top_form->addElement($display3);
			$top_form->addElement(new JieqiFormHidden("act", "update"));
			$top_form->addElement(new JieqiFormHidden(JIEQI_TOKEN_NAME, $_SESSION["jieqiUserToken"]));
			$top_form->addElement(new JieqiFormHidden("tid", $_REQUEST["tid"]));
			$top_form->addElement(new JieqiFormButton("&nbsp;", "submit", LANG_SAVE, "submit"));
			$jieqiTpl->assign("jieqi_contents", "<br />" . $top_form->render(JIEQI_FORM_MAX) . "<br />");
			include_once jieqi_path_common("admin/footer.php");
			exit();
		}
		else {
			jieqi_printfail($jieqiLang["article"]["need_not_tid"]);
		}
	}

	break;
}

include_once jieqi_path_common("admin/header.php");
$top_form = new JieqiThemeForm($jieqiLang["article"]["add_top"], "topnew", $article_dynamic_url . "/admin/top.php");
$top_form->addElement(new JieqiFormText($jieqiLang["article"]["table_top_tid"], "tid", 30, 250, ""), true);
$top_form->addElement(new JieqiFormText($jieqiLang["article"]["table_top_caption"], "caption", 30, 250, ""), true);
$top_form->addElement(new JieqiFormTextArea($jieqiLang["article"]["table_top_description"], "description", "", 5, 50));
$top_form->addElement(new JieqiFormTextArea($jieqiLang["article"]["table_top_where"], "where", "", 5, 50));
$top_form->addElement(new JieqiFormText($jieqiLang["article"]["table_top_sort"], "sort", 30, 50, ""), true);
$display4 = new JieqiFormRadio($jieqiLang["article"]["table_top_isvip"], "isvip", true);
$display4->addOption(0, $jieqiLang["article"]["table_top_free"]);
$display4->addOption(1, $jieqiLang["article"]["table_top_vip"]);
$top_form->addElement($display4);
$display = new JieqiFormRadio($jieqiLang["article"]["table_top_order"], "order", true);
$display->addOption("DESC", $jieqiLang["article"]["table_top_desc"]);
$display->addOption("ASC", $jieqiLang["article"]["table_top_asc"]);
$top_form->addElement($display);
$display2 = new JieqiFormRadio($jieqiLang["article"]["table_top_default"], "default", true);
$display2->addOption(0, $jieqiLang["article"]["table_top_no"]);
$display2->addOption(1, $jieqiLang["article"]["table_top_yes"]);
$top_form->addElement($display2);
$display3 = new JieqiFormRadio($jieqiLang["article"]["table_top_publish"], "publish", true);
$display3->addOption(0, $jieqiLang["article"]["table_top_no"]);
$display3->addOption(1, $jieqiLang["article"]["table_top_yes"]);
$top_form->addElement($display3);
$top_form->addElement(new JieqiFormHidden("act", "new"));
$top_form->addElement(new JieqiFormHidden(JIEQI_TOKEN_NAME, $_SESSION["jieqiUserToken"]));
$top_form->addElement(new JieqiFormButton("&nbsp;", "submit", $jieqiLang["article"]["add_top"], "submit"));
$jieqiTpl->assign("form_addtop", "<br />" . $top_form->render(JIEQI_FORM_MAX) . "<br />");
$jieqiTpl->assign_by_ref("top", jieqi_funtoarray("jieqi_htmlstr", $jieqiTop["article"]));
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/top.html", "article");
include_once jieqi_path_common("admin/footer.php");

?>
