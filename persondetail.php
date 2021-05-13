<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("global.php");
jieqi_checklogin();
jieqi_loadlang("users", "system");
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$sql = "SELECT * FROM " . jieqi_dbprefix("system_persons") . " WHERE uid = " . intval($_SESSION["jieqiUserId"]) . " LIMIT 0, 1";
$res = $query->execute($sql);
$persons = $query->getRow($res);

if (!$persons) {
	jieqi_jumppage(JIEQI_LOCAL_URL . "/personedit.php", LANG_DO_FAILURE, $jieqiLang["system"]["persons_not_set"], true);
}
else {
	include_once jieqi_path_common("header.php");
	include_once jieqi_path_inc("include/funpersons.php", JIEQI_MODULE_NAME);
	$personsvars = jieqi_system_personsvars($persons, "s");
	$jieqiTpl->assign_by_ref("personsvars", $personsvars);
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("persondetail.html", JIEQI_MODULE_NAME);
	include_once jieqi_path_common("footer.php");
}

?>
