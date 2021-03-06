<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
@set_time_limit(0);
@session_write_close();
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$maxtime = JIEQI_NOW_TIME + 7200;
$sql = "SELECT * FROM " . jieqi_dbprefix("article_hurry") . " WHERE payflag = 0 AND overtime < $maxtime ORDER BY articleid ASC, hurryid ASC";
$res = $query->execute($sql);
$sary = array();
$fary = array();
$oary = array();
$aary = array();
$uary = array();
$cary = array();
$actary = array();
$articleid = 0;

while ($row = $query->getRow($res)) {
	if ($articleid != $row["articleid"]) {
		$articleid = intval($row["articleid"]);
		$obookid = intval($row["vipid"]);
		$aary[$articleid] = intval($row["authorid"]);

		if (0 < $obookid) {
			$sql1 = "SELECT postdate,size FROM " . jieqi_dbprefix("obook_ochapter") . " WHERE obookid = " . $obookid . " AND display = 0 AND postdate >= " . intval($row["addtime"]);
		}
		else {
			$sql1 = "SELECT postdate,size FROM " . jieqi_dbprefix("article_chapter") . " WHERE articleid = " . $articleid . " AND display = 0 AND postdate >= " . intval($row["addtime"]);
		}

		$res1 = $query->execute($sql1);
		$cary = array();

		while ($row1 = $query->getRow($res1)) {
			$cary[] = $row1;
		}
	}

	if ($row["minsize"] <= 0) {
		$sflag = true;
	}
	else {
		$sflag = false;
	}

	if (!$sflag) {
		$size = 0;

		foreach ($cary as $c ) {
			if (($row["addtime"] <= $c["postdate"]) && ($c["postdate"] <= $row["overtime"])) {
				$size += intval($c["size"]);

				if (($row["minsize"] * 2) <= $size) {
					$sflag = true;
					break;
				}
			}
			else if ($row["overtime"] < $c["postdate"]) {
				break;
			}
		}
	}

	if ($sflag) {
		$sary[] = intval($row["hurryid"]);
		$actary[] = $row;

		if (isset($oary[$articleid])) {
			$oary[$articleid] += intval($row["payegold"]);
		}
		else {
			$oary[$articleid] = intval($row["payegold"]);
		}
	}
	else if ($row["overtime"] < JIEQI_NOW_TIME) {
		$fary[] = intval($row["hurryid"]);
		$userid = intval($row["uid"]);

		if (isset($uary[$userid])) {
			$uary[$userid] += intval($row["payegold"]);
		}
		else {
			$uary[$userid] = intval($row["payegold"]);
		}
	}
}

if (!empty($sary)) {
	$sql = "UPDATE " . jieqi_dbprefix("article_hurry") . " SET winegold = payegold, payflag = 1  WHERE hurryid IN (" . implode(",", $sary) . ")";
	$query->execute($sql);
}

if (!empty($fary)) {
	$sql = "UPDATE " . jieqi_dbprefix("article_hurry") . " SET payflag = 2 WHERE hurryid IN (" . implode(",", $fary) . ")";
	$query->execute($sql);
}

if (!empty($oary)) {
	if ($jieqiModules["obook"]["publish"]) {
		include_once jieqi_path_inc("include/funbuy.php", "obook");
	}
	else {
		include_once jieqi_path_inc("class/users.php", "system");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
	}

	foreach ($oary as $k => $v ) {
		jieqi_obook_upincome(array("articleid" => $k, "egold" => $v, "etype" => 0, "intype" => "hurry", "salenum" => 0));
	}
}

if (!empty($uary)) {
	foreach ($uary as $k => $v ) {
		$users_handler->payback($k, $v);
	}
}

if (!empty($actary)) {
	jieqi_loadlang("action", "article");
	include_once jieqi_path_inc("include/funaction.php", "article");

	foreach ($actary as $act ) {
		$actions = array("actname" => "hurry", "actnum" => $act["payegold"], "actegold" => $act["payegold"], "actbuy" => 0, "uid" => $act["uid"]);
		$actions["no_record"] = true;
		$actions["message_title"] = sprintf($jieqiLang["article"]["hurry_success_title"], $act["uname"], $_REQUEST["payegold"] . JIEQI_EGOLD_NAME, $act["articlename"]);
		$actions["message_content"] = sprintf($jieqiLang["article"]["hurry_success_content"], $act["uname"], $_REQUEST["payegold"] . JIEQI_EGOLD_NAME, $act["articlename"], date("Y-m-d H:i", $act["overtime"]), $act["minsize"]);
		jieqi_article_actiondo($actions, $act["articleid"]);
	}
}

jieqi_msgwin(LANG_DO_SUCCESS, LANG_DO_SUCCESS);

?>
