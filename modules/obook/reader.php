<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");//内容过期时间 强制浏览器去服务器去获取数据 而不是从缓存中读取数据
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");//标记内容最后修改时间
header("Cache-Control: no-store, no-cache, must-revalidate");//强制不缓存
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");//禁止本页被缓存
header("Access-Control-Allow-Origin: *"); // Support CORS
$logstart = explode(" ", microtime());
define("JIEQI_MODULE_NAME", "obook");
require_once ("../../global.php");
$islogin = jieqi_checklogin(true);

if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '' && $islogin == false) {
    echo json_encode(array("success" => 201, "data" => array(), "message" => '获取成功'));
    return false;
}
if (empty($_REQUEST["cid"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

$_REQUEST["cid"] = intval($_REQUEST["cid"]);
jieqi_loadlang("obook", "obook");
jieqi_getconfigs("obook", "configs");

$obook_static_url = (empty($jieqiConfigs["obook"]["staticurl"]) ? $jieqiModules["obook"]["url"] : $jieqiConfigs["obook"]["staticurl"]);
$obook_dynamic_url = (empty($jieqiConfigs["obook"]["dynamicurl"]) ? $jieqiModules["obook"]["url"] : $jieqiConfigs["obook"]["dynamicurl"]);
include_once jieqi_path_inc("include/funbuy.php", "obook");
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$criteria = new CriteriaCompo(new Criteria("c.ochapterid", $_REQUEST["cid"]));
$criteria->setTables(jieqi_dbprefix("obook_obook") . " a RIGHT JOIN " . jieqi_dbprefix("obook_ochapter") . " c ON a.obookid=c.obookid");
$query->queryObjects($criteria);
$ochapter = $query->getObject();
if (!is_object($ochapter) || ($ochapter->getVar("display", "n") != 0)) {
	if (is_object($ochapter) && ($ochapter->getVar("display", "n") == 1)) {
		include_once jieqi_path_common("header.php");
		include_once jieqi_path_inc("class/package.php", "article");
		$_REQUEST["aid"] = intval($ochapter->getVar("articleid", "n"));
		$package = new JieqiPackage($_REQUEST["aid"]);

		if ($package->loadOPF()) {
			if (!$package->showChapter($_REQUEST["cid"], 1)) {
				jieqi_loadlang("article", "article");
				jieqi_printfail($jieqiLang["article"]["chapter_not_exists"]);
			}
		}
		else {
			jieqi_loadlang("article", "article");
			jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
		}

		exit();
	}
	else {
		jieqi_printfail($jieqiLang["obook"]["chapter_not_insale"]);
	}
}
else {
	$freeread = false;

	if ($islogin) {
		jieqi_getconfigs("system", "sites", "jieqiSites");
		$siteid = intval($ochapter->getVar("siteid", "n"));
		//if (($siteid == 0) || ((0 < $siteid) && isset($jieqiSites[$siteid]) && empty($jieqiSites[$siteid]["vipremote"]))) {
			if (!empty($_SESSION["jieqiUserId"]) && (($_SESSION["jieqiUserId"] == $ochapter->getVar("authorid")) || ($_SESSION["jieqiUserId"] == $ochapter->getVar("agentid")) || ($_SESSION["jieqiUserId"] == $ochapter->getVar("posterid")))) {
				$freeread = true;
			}
			else {
				jieqi_getconfigs(JIEQI_MODULE_NAME, "power");

				if (isset($jieqiPower["obook"]["freeread"])) {
					$freeread = jieqi_checkpower($jieqiPower["obook"]["freeread"], $jieqiUsersStatus, $jieqiUsersGroup, true);
				}

				if (!$freeread && (0 < intval($ochapter->getVar("canbesp", "n"))) && !empty($_SESSION["jieqiUserOvertime"]) && (JIEQI_NOW_TIME < $_SESSION["jieqiUserOvertime"])) {
					$freeread = true;
				}
			}
		}
	//}
}
$_SESSION["freeread"] = $freeread;
if (!$freeread) {
	$canread = false;
	$obuyinfo = jieqi_obook_getobuyinfo($_REQUEST["cid"], $ochapter->getVar("obookid"));

	if (!is_object($obuyinfo)) {
		$autobuyed = jieqi_obook_isautobuy($ochapter->getVar("obookid"), $_SESSION["jieqiUserId"]);

		if ($autobuyed) {
			$autobuyed = jieqi_obook_autobuy($ochapter, $_SESSION["jieqiUserId"]);
		}

		if ($autobuyed) {
			$canread = true;
		}
	}
	else {
		$canread = true;
	}

	if (!$canread) {
		$readbuy_template = jieqi_path_template("readbuy.html", "obook");
		if (defined("JIEQI_THEME_ROOTNEW") && is_file(str_replace(JIEQI_ROOT_PATH, JIEQI_THEME_ROOTPATH, $readbuy_template))) {
			$readbuy_template = str_replace(JIEQI_ROOT_PATH, JIEQI_THEME_ROOTPATH, $readbuy_template);
		}

		if (!file_exists($readbuy_template)) {
			header("Location: " . jieqi_headstr($obook_static_url . "/buychapter.php?cid=" . $_REQUEST["cid"]));
		}
		else {
			include_once jieqi_path_common("header.php");
			include_once jieqi_path_inc("class/package.php", "article");
			$_REQUEST["aid"] = intval($ochapter->getVar("articleid", "n"));
			$package = new JieqiPackage($_REQUEST["aid"]);

			if ($package->loadOPF()) {
				if (!$package->showChapter($_REQUEST["cid"], 2)) {
					jieqi_loadlang("article", "article");
					jieqi_printfail($jieqiLang["article"]["chapter_not_exists"]);
				}
			}
			else {
				jieqi_loadlang("article", "article");
				jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
			}
		}

		exit();
	}
}

if (isset($_SESSION["jieqiVisitedObooks"])) {
	$arysession = jieqi_unserialize($_SESSION["jieqiVisitedObooks"]);
}
else {
	$arysession = array();
}

if (!is_array($arysession)) {
	$arysession = array();
}

$arysession[$_REQUEST["cid"]] = 1;
$_SESSION["jieqiVisitedObooks"] = serialize($arysession);
@session_write_close();
include_once jieqi_path_common("header.php");
include_once jieqi_path_inc("class/package.php", "article");
$_REQUEST["aid"] = intval($ochapter->getVar("articleid", "n"));
$package = new JieqiPackage($_REQUEST["aid"]);

if ($package->loadOPF()) {
	if (!$package->showChapter($_REQUEST["cid"], 1)) {
		jieqi_loadlang("article", "article");
		jieqi_printfail($jieqiLang["article"]["chapter_not_exists"]);
	}
}
else {
	jieqi_loadlang("article", "article");
	jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
}

?>
