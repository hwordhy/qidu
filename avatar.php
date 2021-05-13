<?php

define("JIEQI_MODULE_NAME", "system");
define("JIEQI_NOCONVERT_CHAR", "1");
require_once ("global.php");

if (empty($_REQUEST["uid"])) {
	exit(LANG_ERROR_PARAMETER);
}
else {
	$_REQUEST["uid"] = intval($_REQUEST["uid"]);
}

if (empty($_REQUEST["size"]) || !in_array($_REQUEST["size"], array("l", "s", "i"))) {
	$_REQUEST["size"] = "l";
}

jieqi_getconfigs("system", "configs");
if (function_exists("gd_info") && $jieqiConfigs["system"]["avatarcut"]) {
	$avatar_cut = true;
}
else {
	$avatar_cut = false;
}

if (empty($_REQUEST["type"]) || !isset($jieqi_image_type[$_REQUEST["type"]])) {
	include_once jieqi_path_inc("class/users.php", "system");
	$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
	$userobj = $users_handler->get($_REQUEST["uid"]);

	if (!is_object($userobj)) {
		exit(LANG_NO_USER);
	}
	else {
		$_REQUEST["type"] = $userobj->getVar("avatar");
	}
}

$base_avatar = "";
if ($_REQUEST["type"] == 0) {
	$_REQUEST["uid"] = "noavatar";
	$base_avatar = JIEQI_ROOT_PATH . "/images";
	$prefix = ".jpg";
}
else if (!isset($jieqi_image_type[$_REQUEST["type"]])) {
	exit("wrong image file type!");
}
else {
	$prefix = $jieqi_image_type[$_REQUEST["type"]];
}

if (empty($base_avatar)) {
	$base_avatar = jieqi_uploadpath($jieqiConfigs["system"]["avatardir"], "system") . jieqi_getsubdir($_REQUEST["uid"]);
}

switch ($_REQUEST["size"]) {
case "s":
	$imgfile = $avatar_cut ? $base_avatar . "/" . $_REQUEST["uid"] . "s" . $prefix : $base_avatar . "/" . $_REQUEST["uid"] . $prefix;
	break;

case "i":
	$imgfile = $avatar_cut ? $base_avatar . "/" . $_REQUEST["uid"] . "i" . $prefix : $base_avatar . "/" . $_REQUEST["uid"] . $prefix;
	break;

case "l":
default:
	$imgfile = $base_avatar . "/" . $_REQUEST["uid"] . $prefix;
	break;
}

if (!empty($jieqiConfigs["system"]["oss"]) && !strstr($imgfile, "noavatar.jpg") && !file_exists($imgfile)) {
    $file = str_replace($_SERVER['DOCUMENT_ROOT'].'/', '', str_replace("\\", "/", $imgfile));
    require_once jieqi_path_lib("Oss/Alioss/alioss.php");
    $Oss = new AliUpload();

    if (!file_exists($file) && empty($jieqiConfigs["system"]["downloadpic"]) && $Oss->IsExist($file)) {
        $Oss->download($file, $imgfile);
	}
}

if (is_file($imgfile)) {
	switch ($prefix) {
	case ".jpg":
	case ".jpeg":
		header("Content-type: image/jpeg");
		break;

	case ".gif":
		header("Content-type: image/gif");
		break;

	case ".bmp":
		header("Content-type: image/bmp");
		break;

	case ".png":
	default:
		header("Content-type: image/png");
		break;
	}
    $imgfile = str_replace($_SERVER['DOCUMENT_ROOT'], JIEQI_URL, str_replace("\\", "/", $imgfile));
	echo jieqi_getimg($imgfile, ".jpg");
}
else {
	exit("image file is not exists!");
}

?>
