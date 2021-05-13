<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("global.php");
include_once jieqi_path_common("header.php");
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = "";
if (empty($_GET["module"]) || !preg_match("/^\w+$/", $_GET["module"]) || !isset($jieqiModules[$_GET["module"]])) {
	$_GET["module"] = "system";
}

if (isset($_GET["template"]) && preg_match("/^\w+$/", $_GET["template"]) && is_file(jieqi_path_template($_GET["template"] . ".html", $_GET["module"]))) {
    $jieqiTset["jieqi_contents_template"] = jieqi_path_template($_GET["template"] . ".html", $_GET["module"]);
}

$jieqiTpl->assign("_request", jieqi_funtoarray("jieqi_htmlstr", $_REQUEST));
include_once jieqi_path_common("footer.php");

?>
