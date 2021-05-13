<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
include_once jieqi_path_common("header.php");
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("topselect.html", "article");
include_once jieqi_path_common("footer.php");

?>
