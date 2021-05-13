<?php

define("JIEQI_MODULE_NAME", "pay");
require_once ("../../global.php");

if (!jieqi_checklogin(true)) {
	exit();
}

include_once jieqi_path_lib("phpqrcode/phpqrcode.php");
$url = urldecode($_GET["data"]);
QRcode::png($url);

?>
