<?php

define("JIEQI_MODULE_NAME", "article");

if (!defined("JIEQI_GLOBAL_INCLUDE")) {
	include_once ("../../global.php");
}

jieqi_loadlang("list", JIEQI_MODULE_NAME);
jieqi_getconfigs("article", "configs", "jieqiConfigs");
jieqi_getconfigs("article", "sort", "jieqiSort");
jieqi_getconfigs("article", "option", "jieqiOption");
jieqi_getconfigs("article", "filter", "jieqiFilter");
$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/1.html";
include_once (JIEQI_ROOT_PATH . "/header.php");


include_once (JIEQI_ROOT_PATH . "/footer.php");

?>
