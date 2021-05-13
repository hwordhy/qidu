<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "customblocks", "jieqiBlocks");

if (is_array($jieqiBlocks)) {
	foreach ($jieqiBlocks as $k => $v ) {
		$jieqiBlocks[$k]["side"] = -1;
	}
}

include_once jieqi_path_common("header.php");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("custom.html", "system");
$jieqiTpl->setCaching(0);
include_once jieqi_path_common("footer.php");

?>
