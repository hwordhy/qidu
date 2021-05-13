<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_getconfigs("article", "option", "jieqiOption");
include_once jieqi_path_common("header.php");
if (empty($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

$id = $_GET["id"];
$groupname = $jieqiOption["article"]["rgroup"]["items"][$id];
$jieqiTpl->assign("groupname", $groupname);
$jieqiTpl->assign("groupid", $id);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("group.html", "article");
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>



