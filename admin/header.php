<?php

define("JIEQI_ADMIN_PAGE", 1);
include_once jieqi_path_common("header.php");

if (!defined("JIEQI_ADMIN_FRAME")) {
	$_SESSION["adminurl"] = jieqi_addurlvars(array());
}

?>
