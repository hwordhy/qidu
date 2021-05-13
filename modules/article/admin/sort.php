<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("sort", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "sort", "jieqiSort");
jieqi_getconfigs(JIEQI_MODULE_NAME, "option", "jieqiOption");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
include_once jieqi_path_lib("html/formloader.php");
if (!isset($_POST["act"]) && isset($_GET["act"]) && in_array($_GET["act"], array("show", "edit"))) {
	$_REQUEST["act"] = $_GET["act"];
}

if (empty($_REQUEST["act"])) {
	$_POST["act"] = "show";
}

switch ($_REQUEST["act"]) {
case "new":
	jieqi_checkpost();
	$errtext = "";

	if (empty($_POST["caption"])) {
		$errtext .= $jieqiLang["article"]["need_sort_caption"] . "<br />";
	}

	if (empty($_POST["shortname"])) {
		$errtext .= $jieqiLang["article"]["need_sort_shortname"] . "<br />";
	}

	if (!isset($_POST["rgroup"])) {
		$errtext .= $jieqiLang["article"]["need_sort_rgroup"] . "<br />";
	}

	if (!preg_match("/^[a-zA-Z\s]+$/", $_POST["code"])) {
		$errtext .= $jieqiLang["article"]["need_sort_code"] . "<br />";
	}

	if (empty($errtext)) {
		$jieqiSort["article"][$_POST["sid"]] = array(
			"layer"       => "0",
			"code"        => $_POST["code"],
			"caption"     => $_POST["caption"],
			"shortname"   => $_POST["shortname"],
			"description" => $_POST["description"],
			"imgurl"      => "",
			"publish"     => "1",
			"types"       => array(),
			"rgroup"      => $_POST["rgroup"]
			);
		jieqi_setconfigs("sort", "jieqiSort", $jieqiSort, "article");
		jieqi_jumppage($article_dynamic_url . "/admin/sort.php", LANG_DO_SUCCESS, $jieqiLang["article"]["sort_new_success"]);
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case "newtypes":
	if (!empty($_REQUEST["sid"]) && !empty($_REQUEST["tid"])) {
		jieqi_checkpost();
		$errtext = "";

		if (empty($_POST["caption"])) {
			$errtext .= $jieqiLang["article"]["need_types_caption"] . "<br />";
		}

		if (empty($errtext)) {
			array_push($jieqiSort["article"][$_POST["sid"]]["types"], $_POST["caption"]);
			jieqi_setconfigs("sort", "jieqiSort", $jieqiSort, "article");
			jieqi_jumppage($article_dynamic_url . "/admin/sort.php", LANG_DO_SUCCESS, $jieqiLang["article"]["types_new_success"]);
		}
		else {
			jieqi_printfail($errtext);
		}
	}
	else if (!empty($_REQUEST["sid"])) {
		if (isset($jieqiSort["article"][$_REQUEST["sid"]])) {
			include_once jieqi_path_common("admin/header.php");

			foreach ($jieqiSort["article"][$_REQUEST["sid"]]["types"] as $k => $v ) {
				$tid = $k;
			}

			$sort_form = new JieqiThemeForm($jieqiLang["article"]["table_sort_newtypes"], "newtypes", $article_dynamic_url . "/admin/sort.php");
			$sort_form->addElement(new JieqiFormText($jieqiLang["article"]["table_types_caption"], "caption", 30, 250, ""), true);
			$sort_form->addElement(new JieqiFormHidden("act", "newtypes"));
			$sort_form->addElement(new JieqiFormHidden(JIEQI_TOKEN_NAME, $_SESSION["jieqiUserToken"]));
			$sort_form->addElement(new JieqiFormHidden("sid", $_REQUEST["sid"]));
			$sort_form->addElement(new JieqiFormHidden("tid", $tid + 1));
			$sort_form->addElement(new JieqiFormButton("&nbsp;", "submit", $jieqiLang["article"]["add_types"], "submit"));
			$jieqiTpl->assign("jieqi_contents", "<br />" . $sort_form->render(JIEQI_FORM_MAX) . "<br />");
			include_once jieqi_path_common("admin/footer.php");
			exit();
		}
		else {
			jieqi_printfail($jieqiLang["article"]["no_parent_sort"]);
		}
	}
	else {
		jieqi_printfail($jieqiLang["article"]["no_parent_sort"]);
	}

	break;

case "deletetypes":
	jieqi_checkpost();
	if (empty($_REQUEST["sid"]) && empty($_REQUEST["tid"])) {
		jieqi_printfail($jieqiLang["article"]["types_not_exit"]);
	}

	unset($jieqiSort["article"][$_POST["sid"]]["types"][$_REQUEST["tid"]]);
	jieqi_setconfigs("sort", "jieqiSort", $jieqiSort, "article");
	jieqi_jumppage($article_dynamic_url . "/admin/sort.php", "", "", true);
	break;

case "delete":
	jieqi_checkpost();

	if (empty($_REQUEST["sid"])) {
		jieqi_printfail($jieqiLang["article"]["sort_not_exit"]);
	}

	unset($jieqiSort["article"][$_POST["sid"]]);
	jieqi_setconfigs("sort", "jieqiSort", $jieqiSort, "article");
	jieqi_jumppage($article_dynamic_url . "/admin/sort.php", "", "", true);
	break;

case "update":
	jieqi_checkpost();

	if (!empty($_REQUEST["sid"])) {
		if (isset($jieqiSort["article"][$_REQUEST["sid"]])) {
			$errtext = "";

			if (empty($_POST["caption"])) {
				$errtext .= $jieqiLang["article"]["need_sort_caption"] . "<br />";
			}

			if (empty($_POST["shortname"])) {
				$errtext .= $jieqiLang["article"]["need_sort_shortname"] . "<br />";
			}

			if (!isset($_POST["rgroup"])) {
				$errtext .= $jieqiLang["article"]["need_sort_rgroup"] . "<br />";
			}

			if (!preg_match("/^[a-zA-Z\s]+$/", $_POST["code"])) {
				$errtext .= $jieqiLang["article"]["need_sort_code"] . "<br />";
			}

			if (empty($errtext)) {
				$jieqiSort["article"][$_POST["sid"]]["caption"] = $_POST["caption"];
				$jieqiSort["article"][$_POST["sid"]]["shortname"] = $_POST["shortname"];
				$jieqiSort["article"][$_POST["sid"]]["code"] = $_POST["code"];
				$jieqiSort["article"][$_POST["sid"]]["description"] = $_POST["description"];
				$jieqiSort["article"][$_POST["sid"]]["rgroup"] = $_POST["rgroup"];
				jieqi_setconfigs("sort", "jieqiSort", $jieqiSort, "article");
				jieqi_jumppage($article_dynamic_url . "/admin/sort.php", LANG_DO_SUCCESS, $jieqiLang["article"]["sort_update_success"]);
			}
			else {
				jieqi_printfail($errtext);
			}
		}
		else {
			jieqi_printfail($jieqiLang["article"]["sort_not_exit"]);
		}
	}
	else {
		jieqi_printfail($jieqiLang["article"]["sort_not_exit"]);
	}

	break;

case "updatetypes":
	jieqi_checkpost();
	if (!empty($_REQUEST["sid"]) && !empty($_REQUEST["tid"])) {
		if (isset($jieqiSort["article"][$_REQUEST["sid"]]["types"][$_REQUEST["tid"]])) {
			$errtext = "";

			if (empty($_POST["caption"])) {
				$errtext .= $jieqiLang["article"]["need_types_caption"] . "<br />";
			}

			if (empty($errtext)) {
				$jieqiSort["article"][$_POST["sid"]]["types"][$_REQUEST["tid"]] = $_POST["caption"];
				jieqi_setconfigs("sort", "jieqiSort", $jieqiSort, "article");
				jieqi_jumppage($article_dynamic_url . "/admin/sort.php", LANG_DO_SUCCESS, $jieqiLang["article"]["types_update_success"]);
			}
			else {
				jieqi_printfail($errtext);
			}
		}
		else {
			jieqi_printfail($jieqiLang["article"]["types_not_exit"]);
		}
	}
	else {
		jieqi_printfail($jieqiLang["article"]["types_not_exit"]);
	}

	break;

case "edit":
	if (!empty($_REQUEST["sid"])) {
		if (isset($jieqiSort["article"][$_REQUEST["sid"]])) {
			include_once jieqi_path_common("admin/header.php");
			$sort_form = new JieqiThemeForm($jieqiLang["article"]["table_sort_edit"], "sortedit", $article_dynamic_url . "/admin/sort.php");
			$sort_form->addElement(new JieqiFormText($jieqiLang["article"]["table_sort_caption"], "caption", 30, 250, $jieqiSort["article"][$_REQUEST["sid"]]["caption"]), true);
			$sort_form->addElement(new JieqiFormText($jieqiLang["article"]["table_sort_shortname"], "shortname", 30, 250, $jieqiSort["article"][$_REQUEST["sid"]]["shortname"]), true);
			$sort_form->addElement(new JieqiFormText($jieqiLang["article"]["table_sort_code"], "code", 30, 250, $jieqiSort["article"][$_REQUEST["sid"]]["code"]), true);
			$sort_form->addElement(new JieqiFormTextArea($jieqiLang["article"]["table_sort_description"], "description", $jieqiSort["article"][$_REQUEST["sid"]]["description"], 5, 50));
			$display = new JieqiFormRadio($jieqiLang["article"]["table_sort_rgroup"], "rgroup", htmlspecialchars($jieqiSort["article"][$_REQUEST["sid"]]["rgroup"], ENT_QUOTES), true);

			foreach ($jieqiOption["article"]["rgroup"]["items"] as $k => $v ) {
				$display->addOption($k, $v);
			}

			$sort_form->addElement($display);
			$sort_form->addElement(new JieqiFormHidden("act", "update"));
			$sort_form->addElement(new JieqiFormHidden(JIEQI_TOKEN_NAME, $_SESSION["jieqiUserToken"]));
			$sort_form->addElement(new JieqiFormHidden("sid", $_REQUEST["sid"]));
			$sort_form->addElement(new JieqiFormButton("&nbsp;", "submit", LANG_SAVE, "submit"));
			$jieqiTpl->assign("jieqi_contents", "<br />" . $sort_form->render(JIEQI_FORM_MAX) . "<br />");
			include_once jieqi_path_common("admin/footer.php");
			exit();
		}
		else {
			jieqi_printfail($jieqiLang["article"]["sort_not_exit"]);
		}
	}
	else {
		jieqi_printfail($jieqiLang["article"]["sort_not_exit"]);
	}

	break;

case "edittypes":
	if (!empty($_REQUEST["sid"]) && !empty($_REQUEST["tid"])) {
		if (isset($jieqiSort["article"][$_REQUEST["sid"]]["types"][$_REQUEST["tid"]])) {
			include_once jieqi_path_common("admin/header.php");
			$sort_form = new JieqiThemeForm($jieqiLang["article"]["table_types_edit"], "typesedit", $article_dynamic_url . "/admin/sort.php");
			$sort_form->addElement(new JieqiFormText($jieqiLang["article"]["table_types_caption"], "caption", 30, 250, $jieqiSort["article"][$_REQUEST["sid"]]["types"][$_REQUEST["tid"]]), true);
			$sort_form->addElement(new JieqiFormHidden("act", "updatetypes"));
			$sort_form->addElement(new JieqiFormHidden(JIEQI_TOKEN_NAME, $_SESSION["jieqiUserToken"]));
			$sort_form->addElement(new JieqiFormHidden("sid", $_REQUEST["sid"]));
			$sort_form->addElement(new JieqiFormHidden("tid", $_REQUEST["tid"]));
			$sort_form->addElement(new JieqiFormButton("&nbsp;", "submit", LANG_SAVE, "submit"));
			$jieqiTpl->assign("jieqi_contents", "<br />" . $sort_form->render(JIEQI_FORM_MAX) . "<br />");
			include_once jieqi_path_common("admin/footer.php");
			exit();
		}
		else {
			jieqi_printfail($jieqiLang["article"]["types_not_exit"]);
		}
	}
	else {
		jieqi_printfail($jieqiLang["article"]["types_not_exit"]);
	}

	break;
}

include_once jieqi_path_common("admin/header.php");
$sortrows = array();
$k = 0;
if (!empty($jieqiSort)) {
	foreach ($jieqiSort["article"] as $v => $s) {
		$sortrows[$k] = jieqi_funtoarray("jieqi_htmlstr", $s);
		$sortrows[$k]["rgroup_n"] = $sortrows[$k]["rgroup"];
		$sortrows[$k]["rgroup"] = $jieqiOption["article"]["rgroup"]["items"][$sortrows[$k]["rgroup"]];
		$sid = $v;
		$sortrows[$k]["sid"] = $v;
		$k++;
	}
}

$sort_form = new JieqiThemeForm($jieqiLang["article"]["add_sort"], "sortnew", $article_dynamic_url . "/admin/sort.php");
$sort_form->addElement(new JieqiFormText($jieqiLang["article"]["table_sort_caption"], "caption", 30, 250, ""), true);
$sort_form->addElement(new JieqiFormText($jieqiLang["article"]["table_sort_shortname"], "shortname", 30, 50, ""), true);
$sort_form->addElement(new JieqiFormText($jieqiLang["article"]["table_sort_code"], "code", 30, 50, ""), true);
$sort_form->addElement(new JieqiFormTextArea($jieqiLang["article"]["table_sort_description"], "description", "", 5, 50));
$display = new JieqiFormRadio($jieqiLang["article"]["table_sort_rgroup"], "rgroup", htmlspecialchars("1", ENT_QUOTES));

foreach ($jieqiOption["article"]["rgroup"]["items"] as $k => $v ) {
	$display->addOption($k, $v);
}

$sort_form->addElement($display);
$sort_form->addElement(new JieqiFormHidden("act", "new"));
$sort_form->addElement(new JieqiFormHidden("sid", $sid + 1));
$sort_form->addElement(new JieqiFormHidden(JIEQI_TOKEN_NAME, $_SESSION["jieqiUserToken"]));
$sort_form->addElement(new JieqiFormButton("&nbsp;", "submit", $jieqiLang["article"]["add_sort"], "submit"));
$jieqiTpl->assign("form_addsort", "<br />" . $sort_form->render(JIEQI_FORM_MAX) . "<br />");
$jieqiTpl->assign_by_ref("sortrows", $sortrows);
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/sort.html", "article");
include_once jieqi_path_common("admin/footer.php");

?>
