<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");

if (empty($_REQUEST["id"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

jieqi_loadlang("applywriter", JIEQI_MODULE_NAME);
include_once jieqi_path_inc("class/applywriter.php", "article");
$apply_handler = &JieqiApplywriterHandler::getInstance("JieqiApplywriterHandler");
$applywriter = $apply_handler->get($_REQUEST["id"]);

if (!is_object($applywriter)) {
	jieqi_printfail($jieqiLang["article"]["applywriter_not_exists"]);
}

include_once jieqi_path_common("header.php");
$jieqiTpl->setCaching(0);
$jieqiTpl->assign("applyid", $applywriter->getVar("applyid"));
$jieqiTpl->assign("applytime", date(JIEQI_DATE_FORMAT . " " . JIEQI_TIME_FORMAT, $applywriter->getVar("applytime")));
$jieqiTpl->assign("applyuid", $applywriter->getVar("applyuid"));
$jieqiTpl->assign("applyname", $applywriter->getVar("applyname"));
$jieqiTpl->assign("applytitle", $applywriter->getVar("applytitle"));
$jieqiTpl->assign("applytext", $applywriter->getVar("applytext"));
$jieqiTpl->assign("applysize", $applywriter->getVar("applysize"));
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/applyinfo.html", "article");
include_once jieqi_path_common("footer.php");

?>
