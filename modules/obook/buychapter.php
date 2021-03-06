<?php

define("JIEQI_MODULE_NAME", "obook");
require_once ("../../global.php");
jieqi_checklogin();
if (empty($_REQUEST["cid"]) || !is_numeric($_REQUEST["cid"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

jieqi_loadlang("buy", "obook");
include_once jieqi_path_inc("include/funbuy.php", "obook");
$ochapter = jieqi_obook_getochapter($_REQUEST["cid"]);
if (!is_object($ochapter) || ($ochapter->getVar("display") != 0)) {
	jieqi_printfail($jieqiLang["obook"]["not_in_sale"]);
}

jieqi_getconfigs("obook", "configs");
$obook_static_url = (empty($jieqiConfigs["obook"]["staticurl"]) ? $jieqiModules["obook"]["url"] : $jieqiConfigs["obook"]["staticurl"]);
$obook_dynamic_url = (empty($jieqiConfigs["obook"]["dynamicurl"]) ? $jieqiModules["obook"]["url"] : $jieqiConfigs["obook"]["dynamicurl"]);
include_once jieqi_path_inc("class/users.php", "system");
$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
$users = $users_handler->get($_SESSION["jieqiUserId"]);

if (!is_object($users)) {
	jieqi_printfail($jieqiLang["obook"]["need_user_login"]);
}

$articleid = intval($ochapter->getVar("articleid", "n"));
$obookid = intval($ochapter->getVar("obookid", "n"));
$obookname = $ochapter->getVar("obookname");
$chaptername = $ochapter->getVar("chaptername");
$saleprice = $ochapter->getVar("saleprice", "n");
$syncemoney = ($_POST["act"] == "buy" ? false : true);
$usermoney = $users->getEmoney($syncemoney);

if ($usermoney["emoney"] < $saleprice) {
	jieqi_printfail(sprintf($jieqiLang["obook"]["chapter_money_notenough"], $obookname, $chaptername, $saleprice . " " . JIEQI_EGOLD_NAME, $usermoney["emoney"] . " " . JIEQI_EGOLD_NAME, $jieqiModules["pay"]["url"] . "/buyegold.php?jumpurl=" . urlencode($obook_static_url . "/reader.php?cid=" . $_REQUEST["cid"])));
}

$obookprice = 0;
jieqi_getconfigs("article", "configs");

if (!empty($jieqiConfigs["article"]["wholebuy"])) {
	include_once jieqi_path_inc("class/obook.php", "obook");
	$obook_handler = &JieqiObookHandler::getInstance("JieqiObookHandler");
	$obook = $obook_handler->get($obookid);

	if (is_object($obook)) {
		$obookprice = intval($obook->getVar("saleprice", "n"));
	}

	if ($obookprice < 0) {
		$obookprice = 0;
	}
}

if (!isset($_POST["act"])) {
	$_POST["act"] = "show";
}

switch ($_POST["act"]) {
case "buy":
	jieqi_checkpost();
	if (!empty($_REQUEST["buytype"]) && ($_REQUEST["buytype"] == 2) && is_object($obook) && (0 < $obookprice)) {
		$obuyinfo = jieqi_obook_getobuyinfo(0, $obookid);

		if (is_object($obuyinfo)) {
			jieqi_printfail(sprintf($jieqiLang["obook"]["article_has_buyed"], $obookname, $obook_static_url . "/reader.php?cid=" . $_REQUEST["cid"]));
		}

		jieqi_obook_wholebuy($obook, $users);
	}
	else {
		$obuyinfo = jieqi_obook_getobuyinfo($_REQUEST["cid"], $obookid);

		if (is_object($obuyinfo)) {
			jieqi_printfail(sprintf($jieqiLang["obook"]["chapter_has_buyed"], $obookname, $chaptername, $obook_static_url . "/reader.php?cid=" . $_REQUEST["cid"]));
		}

		jieqi_obook_autobuy($ochapter, $users);
	}
    if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
        jieqi_msgwin($jieqiLang["obook"]["batch_buy_success"], $jieqiLang["obook"]["batch_buy_success"], array('location'=>jieqi_headstr($obook_static_url . "/reader.php?cid=" . $_REQUEST["cid"])));
        return false;
    }

	header("Location: " . jieqi_headstr($obook_static_url . "/reader.php?cid=" . $_REQUEST["cid"]));
	break;

case "show":
default:
	include_once jieqi_path_common("header.php");
	$jieqiTpl->assign("obook_static_url", $obook_static_url);
	$jieqiTpl->assign("obook_dynamic_url", $obook_dynamic_url);
	$jieqiTpl->assign("url_buychapter", $obook_dynamic_url . "/buychapter.php");
	$jieqiTpl->assign("url_obookinfo", $obook_dynamic_url . "/obookinfo.php?id=" . $ochapter->getVar("obookid", "n"));
	$jieqiTpl->assign("url_buyegold", $jieqiModules["pay"]["url"] . "/buyegold.php?jumpurl=" . urlencode($obook_static_url . "/reader.php?cid=" . $_REQUEST["cid"]));
	$jieqiTpl->assign("cid", $_REQUEST["cid"]);
	$ochaptervars = jieqi_query_rowvars($ochapter);
	$jieqiTpl->assign_by_ref("ochaptervars", $ochaptervars);

	foreach ($ochaptervars as $k => $v ) {
		$jieqiTpl->assign($k, $ochaptervars[$k]);
	}

	$jieqiTpl->assign("useregold", $usermoney["egold"]);
	$jieqiTpl->assign("useresilver", $usermoney["esilver"]);
	$jieqiTpl->assign("useremoney", $usermoney["emoney"]);
	$jieqiTpl->assign("username", $users->getVar("uname"));
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("buychapter.html", "obook");
	include_once jieqi_path_common("footer.php");
	break;
}

?>
