<?php

define("JIEQI_MODULE_NAME", "obook");
require_once ("../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "indexblocks", "jieqiBlocks");
include_once jieqi_path_common("header.php");
$jieqiTset["jieqi_contents_template"] = "";
include_once jieqi_path_common("footer.php");

?>
