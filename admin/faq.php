<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("../global.php");
include_once jieqi_path_common("admin/header.php");
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("admin/faq.html", "system");
include_once jieqi_path_common("admin/footer.php");

?>
