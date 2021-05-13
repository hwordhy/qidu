<?php

if (!defined("JIEQI_GLOBAL_INCLUDE") || !defined("JIEQI_PAY_TYPE")) {
	exit();
}

if (!isset($jieqiLang["pay"]["pay"])) {
	jieqi_loadlang("pay", "pay");
}

if (!isset($jieqiPayset)) {
	jieqi_getconfigs("pay", JIEQI_PAY_TYPE, "jieqiPayset");
}

if (empty($jieqiPayset[JIEQI_PAY_TYPE]["payrate"]) || !is_numeric($jieqiPayset[JIEQI_PAY_TYPE]["payrate"])) {
	$jieqiPayset[JIEQI_PAY_TYPE]["payrate"] = 100;
}

if (isset($_REQUEST["egold"]) && is_numeric($_REQUEST["egold"]) && (0 < $_REQUEST["egold"])) {
	$_REQUEST["egold"] = intval($_REQUEST["egold"]);
	$_REQUEST["money"] = 0;

	if (isset($jieqiPayset[JIEQI_PAY_TYPE]["paylimit"][$_REQUEST["egold"]])) {
		$_REQUEST["money"] = intval($jieqiPayset[JIEQI_PAY_TYPE]["paylimit"][$_REQUEST["egold"]] * 100);
	}
	else if (!empty($jieqiPayset[JIEQI_PAY_TYPE]["paycustom"])) {
		$_REQUEST["money"] = ceil(($_REQUEST["egold"] * 100) / $jieqiPayset[JIEQI_PAY_TYPE]["payrate"]);
	}
	else {
		jieqi_printfail($jieqiLang["pay"]["buy_type_error"]);
	}
}
else {
	if (isset($_REQUEST["money"]) && is_numeric($_REQUEST["money"]) && (0 < $_REQUEST["money"])) {
		$_REQUEST["egold"] = 0;
		$paylimit = (isset($jieqiPayset[JIEQI_PAY_TYPE]["paylimit"]) ? array_flip($jieqiPayset[JIEQI_PAY_TYPE]["paylimit"]) : array());

		if (isset($paylimit[$_REQUEST["money"]])) {
			$_REQUEST["egold"] = intval($paylimit[$_REQUEST["money"]]);
		}
		else if (!empty($jieqiPayset[JIEQI_PAY_TYPE]["paycustom"])) {
			$_REQUEST["egold"] = floor($_REQUEST["money"] * $jieqiPayset[JIEQI_PAY_TYPE]["payrate"]);
		}
		else {
			jieqi_printfail($jieqiLang["pay"]["buy_type_error"]);
		}

		$_REQUEST["money"] = ceil($_REQUEST["money"] * 100);
	}
	else {
		include_once jieqi_path_common("header.php");
		if (!empty($_REQUEST["type"]) && preg_match("/^\w+$/", $_REQUEST["type"]) && (strlen($_REQUEST["type"]) < 64)) {
			$typefile = $_REQUEST["type"];
		}
		else {
			$typefile = JIEQI_PAY_TYPE;
		}

		$jieqiTset["jieqi_contents_template"] = jieqi_path_template($typefile . "pay.html", "pay");
		$jieqiTpl->setCaching(0);
		include_once jieqi_path_common("footer.php");
		exit();
	}
}

include_once jieqi_path_inc("class/users.php", "system");
$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
$jieqiUsers = $users_handler->get($_SESSION["jieqiUserId"]);

$_REQUEST["amount"] = $_REQUEST["money"] / 100;
include_once jieqi_path_inc("class/paylog.php", "pay");
$paylog_handler = JieqiPaylogHandler::getInstance("JieqiPaylogHandler");
$paylog = $paylog_handler->create();
$paylog->setVar("siteid", JIEQI_SITE_ID);
$paylog->setVar("buytime", JIEQI_NOW_TIME);
$paylog->setVar("rettime", 0);
$paylog->setVar("buyid", $_SESSION["jieqiUserId"]);
$paylog->setVar("buyname", $_SESSION["jieqiUserName"]);

if (!isset($buyinfo)) {
	$buyinfo = "";
}

$paylog->setVar("buyinfo", $buyinfo);
$moneytype = (empty($jieqiPayset[JIEQI_PAY_TYPE]["moneytype"]) ? 0 : intval($jieqiPayset[JIEQI_PAY_TYPE]["moneytype"]));
$paylog->setVar("moneytype", $moneytype);
$paylog->setVar("money", $_REQUEST["money"]);
$paylog->setVar("egoldtype", intval($jieqiPayset[JIEQI_PAY_TYPE]["paysilver"]));
$paylog->setVar("egold", $_REQUEST["egold"]);
if (defined("JIEQI_PAY_SUBTYPE") && (0 < strlen(JIEQI_PAY_SUBTYPE))) {
	$paylog->setVar("paytype", JIEQI_PAY_TYPE . "_" . JIEQI_PAY_SUBTYPE);
}
else {
	$paylog->setVar("paytype", JIEQI_PAY_TYPE);
}

$paylog->setVar("retserialno", "");
$paylog->setVar("retaccount", "");
$paylog->setVar("retinfo", "");
$paylog->setVar("masterid", 0);
$paylog->setVar("mastername", "");
$paylog->setVar("masterinfo", "");
$paylog->setVar("note", "");
$paylog->setVar("payflag", 0);
$paylog->setVar("channel", $jieqiUsers->getVar("channel"));
$paylog->setVar("device", "PC");

if (!$paylog_handler->insert($paylog)) {
	jieqi_printfail($jieqiLang["pay"]["add_paylog_error"]);
}

?>
