<?php

function jieqi_pay_start()
{
	global $jieqiModules;
	global $jieqiLang;
	global $jieqiPayset;
	global $jieqiPayAction;
	global $jieqiUsersGroup;

	if (!isset($jieqiLang["pay"]["pay"])) {
		jieqi_loadlang("pay", "pay");
	}

	if (!isset($jieqiPayset)) {
		jieqi_getconfigs("pay", JIEQI_PAY_TYPE, "jieqiPayset");
	}

	$acttype = 0;
	$actid = 0;
	$actname = 0;
	$actlog = "";
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

		$actname = $_REQUEST["egold"] . JIEQI_EGOLD_NAME;
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
			$actname = $_REQUEST["egold"] . JIEQI_EGOLD_NAME;
		}
		else {
			if (isset($_REQUEST["payaction"]) && is_numeric($_REQUEST["payaction"])) {
				if (!isset($jieqiPayAction[$_REQUEST["payaction"]])) {
					jieqi_printfail($jieqiLang["pay"]["payaction_type_error"]);
				}

				if (!empty($jieqiPayAction[$_REQUEST["payaction"]]["denygroup"]) && in_array($jieqiUsersGroup, $jieqiPayAction[$_REQUEST["payaction"]]["denygroup"])) {
					jieqi_printfail($jieqiLang["pay"]["payaction_deny_group"]);
				}

				if (!empty($jieqiPayAction[$_REQUEST["payaction"]]["expiretime"]) && (strtotime($jieqiPayAction[$_REQUEST["payaction"]]["expiretime"]) < JIEQI_NOW_TIME)) {
					jieqi_printfail(sprintf($jieqiLang["pay"]["payaction_expire_time"], $jieqiPayAction[$_REQUEST["payaction"]]["expiretime"]));
				}

				$_REQUEST["egold"] = 0;
				$_REQUEST["money"] = ceil($jieqiPayAction[$_REQUEST["payaction"]]["amount"] * 100);
				$acttype = 1;
				$actid = $_REQUEST["payaction"];
				$actname = $jieqiPayAction[$_REQUEST["payaction"]]["caption"];
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
	$buyinfo = (isset($_REQUEST["buyinfo"]) ? $_REQUEST["buyinfo"] : "");
	$paylog->setVar("buyinfo", $buyinfo);
	$moneytype = (empty($jieqiPayset[JIEQI_PAY_TYPE]["moneytype"]) ? 0 : intval($jieqiPayset[JIEQI_PAY_TYPE]["moneytype"]));
	$paylog->setVar("moneytype", $moneytype);
	$paylog->setVar("money", $_REQUEST["money"]);
	$paylog->setVar("egoldtype", intval($jieqiPayset[JIEQI_PAY_TYPE]["paysilver"]));
	$paylog->setVar("egold", $_REQUEST["egold"]);
	$paylog->setVar("paytype", JIEQI_PAY_TYPE);
	$subtype = (defined("JIEQI_PAY_SUBTYPE") && (0 < strlen(JIEQI_PAY_SUBTYPE)) ? JIEQI_PAY_SUBTYPE : "");
	$paylog->setVar("subtype", $subtype);
	$fromtype = (empty($jieqiPayset[JIEQI_PAY_TYPE]["fromtype"]) ? "" : intval($jieqiPayset[JIEQI_PAY_TYPE]["fromtype"]));
	$paylog->setVar("fromtype", $fromtype);
	$typename = (empty($jieqiPayset[JIEQI_PAY_TYPE]["typename"]) ? "" : intval($jieqiPayset[JIEQI_PAY_TYPE]["typename"]));
	$paylog->setVar("typename", $typename);
	$paylog->setVar("acttype", $acttype);
	$paylog->setVar("actid", $actid);
	$paylog->setVar("actname", $actname);
	$paylog->setVar("actlog", $actlog);
    $paylog->setVar("channel", $jieqiUsers->getVar("channel"));
    $paylog->setVar("device", JIEQI_DEVICE_FOR);
	$paylog->setVar("retserialno", "");
	$paylog->setVar("retaccount", "");
	$paylog->setVar("retinfo", "");
	$paylog->setVar("masterid", 0);
	$paylog->setVar("mastername", "");
	$paylog->setVar("masterinfo", "");
	$paylog->setVar("note", "");
	$paylog->setVar("payflag", 0);

	if (!$paylog_handler->insert($paylog)) {
		jieqi_printfail($jieqiLang["pay"]["add_paylog_error"]);
	}

	$jieqiPayset[JIEQI_PAY_TYPE]["subject"] = $actname;
	if (!empty($_REQUEST["jumpurl"]) || !preg_match("/^(\/\w+|" . preg_quote(JIEQI_LOCAL_URL, "/") . ")/i", $_REQUEST["jumpurl"])) {
		$_REQUEST["jumpurl"] = JIEQI_USER_URL . "/userdetail.php";
	}

	$_SESSION["jieqiJumpUrl"]["pay"] = $_REQUEST["jumpurl"];
	return $paylog;
}

function jieqi_pay_return($params)
{
	global $jieqiModules;
	global $jieqiLang;
	global $jieqiPayset;
	global $jieqiPayAction;
	global $paylog_handler;
	global $users_handler;

	if (!isset($jieqiLang["pay"]["pay"])) {
		jieqi_loadlang("pay", "pay");
	}

	if (!isset($jieqiPayset)) {
		jieqi_getconfigs("pay", JIEQI_PAY_TYPE, "jieqiPayset");
	}

	if (!is_a($paylog_handler, "JieqiPaylogHandler")) {
		include_once jieqi_path_inc("class/paylog.php", "pay");
		$paylog_handler = JieqiPaylogHandler::getInstance("JieqiPaylogHandler");
	}

	$params["orderid"] = intval($params["orderid"]);
	$paylog = $paylog_handler->get($params["orderid"]);

	if (is_object($paylog)) {
		$orderinfo = array("orderid" => $params["orderid"], "buyid" => $paylog->getVar("buyid"), "buyname" => $paylog->getVar("buyname"), "egold" => $paylog->getVar("egold"), "money" => $paylog->getVar("money"), "payflag" => $paylog->getVar("payflag"));

		if ($orderinfo["payflag"] == 0) {
			if (!is_a($users_handler, "JieqiUsersHandler")) {
				include_once jieqi_path_inc("class/users.php", "system");
				$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
			}

			$extras = array();
			$extras["usesilver"] = (empty($jieqiPayset[JIEQI_PAY_TYPE]["paysilver"]) ? 0 : intval($jieqiPayset[JIEQI_PAY_TYPE]["paysilver"]));

			if (!isset($jieqiPayset[JIEQI_PAY_TYPE]["payscore"])) {
				$jieqiPayset[JIEQI_PAY_TYPE]["payscore"] = (empty($jieqiPayset[JIEQI_PAY_TYPE]["payrate"]) ? 0 : $jieqiPayset[JIEQI_PAY_TYPE]["payrate"]);
			}

			$extras["addscore"] = (empty($jieqiPayset[JIEQI_PAY_TYPE]["payscore"]) ? 0 : floor(($orderinfo["money"] * $jieqiPayset[JIEQI_PAY_TYPE]["payscore"]) / 100));
			$extras["updatevip"] = (isset($jieqiPayset[JIEQI_PAY_TYPE]["payupvip"]) ? intval($jieqiPayset[JIEQI_PAY_TYPE]["payupvip"]) : 1);
			$acttype = intval($paylog->getVar("acttype", "n"));
			$actid = intval($paylog->getVar("actid", "n"));
			if (($acttype == 1) && isset($jieqiPayAction[$actid])) {
				if (isset($jieqiPayAction[$actid]["updategroup"])) {
					$extras["updategroup"] = $jieqiPayAction[$actid]["updategroup"];
				}

				if (isset($jieqiPayAction[$actid]["addmonthly"]) && is_numeric($jieqiPayAction[$actid]["addmonthly"]) && (0 < $jieqiPayAction[$actid]["addmonthly"])) {
					$extras["addmonthly"] = intval($jieqiPayAction[$actid]["addmonthly"]);
				}
			}

			$ret = $users_handler->income($orderinfo["buyid"], $orderinfo["egold"], $extras);

			if ($ret) {
				$note = sprintf($jieqiLang["pay"]["add_egold_success"], $orderinfo["buyname"], $paylog->getVar("actname", "n"));
			}
			else {
				$note = sprintf($jieqiLang["pay"]["add_egold_failure"], $orderinfo["buyname"], $paylog->getVar("actname", "n"));
			}

			$paylog->setVar("rettime", JIEQI_NOW_TIME);
			$paylog->setVar("retserialno", $params["retserialno"]);
			$paylog->setVar("retaccount", $params["retaccount"]);
			$paylog->setVar("retinfo", $params["retinfo"]);
			$paylog->setVar("note", $note);

			if (empty($params["manual"])) {
				$paylog->setVar("payflag", 1);
			}
			else {
				if (!empty($_SESSION["jieqiUserId"])) {
					$paylog->setVar("masterid", $_SESSION["jieqiUserId"]);
					$paylog->setVar("mastername", $_SESSION["jieqiUserName"]);
				}

				$paylog->setVar("payflag", 2);
			}

			if (!$paylog_handler->insert($paylog)) {
				if ($params["return"]) {
					return -2;
				}
				else {
					$orderinfo["message"] = $jieqiLang["pay"]["save_paylog_failure"];
					jieqi_pay_failure($orderinfo);
				}
			}
			else if ($params["return"]) {
				return 1;
			}
			else {
				$orderinfo["message"] = sprintf($jieqiLang["pay"]["buy_egold_success"], $orderinfo["buyname"], JIEQI_EGOLD_NAME, $orderinfo["egold"]);
				jieqi_pay_success($orderinfo);
			}
		}
		else if ($params["return"]) {
			return 2;
		}
		else {
			$orderinfo["message"] = sprintf($jieqiLang["pay"]["buy_already_success"], $orderinfo["buyname"], JIEQI_EGOLD_NAME, $orderinfo["egold"]);
			jieqi_pay_success($orderinfo);
		}
	}
	else if ($params["return"]) {
		return -1;
	}
	else {
		$orderinfo["message"] = $jieqiLang["pay"]["no_buy_record"];
		jieqi_pay_failure($orderinfo);
	}
}

function jieqi_pay_success($params)
{
	if (!empty($_SESSION["jieqiJumpUrl"]["pay"]) && preg_match("/^(\/\w+|" . preg_quote(JIEQI_LOCAL_URL, "/") . ")/i", $_SESSION["jieqiJumpUrl"]["pay"])) {
		$jumpurl = $_SESSION["jieqiJumpUrl"]["pay"];
		unset($_SESSION["jieqiJumpUrl"]["pay"]);
	}
	else {
		$jumpurl = JIEQI_USER_URL . "/userdetail.php";
	}

	jieqi_jumppage($jumpurl, LANG_DO_SUCCESS, $params["message"], false);
}

function jieqi_pay_failure($params)
{
	jieqi_printfail($params["message"]);
}


?>
