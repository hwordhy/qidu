<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("global.php");
jieqi_checklogin();
jieqi_loadlang("users", JIEQI_MODULE_NAME);
include_once jieqi_path_inc("class/users.php", "system");
$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
$jieqiUsers = $users_handler->get($_SESSION["jieqiUserId"]);

if (!$jieqiUsers) {
	jieqi_printfail(LANG_NO_USER);
}

jieqi_getconfigs("system", "configs");
$jieqiConfigs["system"]["avatardt"] = ".jpg";
$jieqiConfigs["system"]["avatardw"] = "180";
$jieqiConfigs["system"]["avatardh"] = "180";
$jieqiConfigs["system"]["avatarsw"] = "100";
$jieqiConfigs["system"]["avatarsh"] = "100";
$jieqiConfigs["system"]["avatariw"] = "50";
$jieqiConfigs["system"]["avatarih"] = "50";
if (!isset($_POST["act"]) && isset($_GET["act"]) && in_array($_GET["act"], array("cutavatar", "show"))) {
	$_POST["act"] = $_GET["act"];
}

if (!isset($_POST["act"])) {
	$_POST["act"] = "show";
}

switch ($_POST["act"]) {
case "cutsave":
	jieqi_checkpost();
	$old_avatar = $jieqiUsers->getVar("avatar", "n");
	$basedir = jieqi_uploadpath($jieqiConfigs["system"]["avatardir"], "system") . jieqi_getsubdir($jieqiUsers->getVar("uid", "n"));
	$newfile = $basedir . "/" . $jieqiUsers->getVar("uid", "n") . $jieqiConfigs["system"]["avatardt"];
	$smallfile = $basedir . "/" . $jieqiUsers->getVar("uid", "n") . "s" . $jieqiConfigs["system"]["avatardt"];
	$iconfile = $basedir . "/" . $jieqiUsers->getVar("uid", "n") . "i" . $jieqiConfigs["system"]["avatardt"];
    if (!empty($_REQUEST["ajax_gets"])) {
        $uptmp = strtolower(substr(PHP_OS, 0, 3)) == "win" ? dirname(__FILE__)."/files/tmp/" . $_SESSION["jieqiUserId"] : "files/tmp/" . $_SESSION["jieqiUserId"];
        $oldfile = $uptmp . "/" . $_SESSION["jieqiUserId"] . $jieqiConfigs["system"]["avatardt"];
    }
    else{
        $uptmp = (0 < strlen(ini_get("upload_tmp_dir")) ? ini_get("upload_tmp_dir") : (0 < strlen($_ENV["TEMP"]) ? $_ENV["TEMP"] : (0 < strlen($_ENV["TMP"]) ? $_ENV["TMP"] : (strtolower(substr(PHP_OS, 0, 3)) == "win" ? "C:/WINDOWS/TEMP" : "/tmp"))));
        $oldfile = $uptmp . "/" . $_SESSION["jieqiUserId"] . "_tmp" . $jieqiConfigs["system"]["avatardt"];
    }

	if (is_file($oldfile)) {
		if ((0 < $old_avatar) && isset($jieqi_image_type[$old_avatar])) {
			$old_imagefile = $basedir . "/" . $jieqiUsers->getVar("uid", "n") . $jieqi_image_type[$old_avatar];
			jieqi_delfile($old_imagefile);
		}

		$posary = explode(",", $_REQUEST["cut_pos"]);

		foreach ($posary as $k => $v ) {
			$posary[$k] = intval($v);
		}

		include_once jieqi_path_lib("image/imageresize.php");
		$imgresize = new ImageResize();
		$imgresize->load($oldfile);
//		if ((0 < $posary[2]) && (0 < $posary[3])) {
//			$imgresize->resize($posary[2], $posary[3]);
//		}

//		$imgresize->cut($jieqiConfigs["system"]["avatardw"], $jieqiConfigs["system"]["avatardh"], intval($posary[0]), intval($posary[1]));
		$tmp_save = $uptmp . "/" . $_SESSION["jieqiUserId"] . $jieqiConfigs["system"]["avatardt"];
		$imgresize->save($tmp_save);
		jieqi_copyfile($tmp_save, $newfile, 511, true);
		$imgresize->resize($jieqiConfigs["system"]["avatarsw"], $jieqiConfigs["system"]["avatarsh"]);
		$tmp_save = $uptmp . "/" . $_SESSION["jieqiUserId"] . "s" . $jieqiConfigs["system"]["avatardt"];
		$imgresize->save($tmp_save);
		jieqi_copyfile($tmp_save, $smallfile, 511, true);
		$imgresize->resize($jieqiConfigs["system"]["avatariw"], $jieqiConfigs["system"]["avatarih"]);
		$tmp_save = $uptmp . "/" . $_SESSION["jieqiUserId"] . "i" . $jieqiConfigs["system"]["avatardt"];
		$imgresize->save($tmp_save, true);
		jieqi_copyfile($tmp_save, $iconfile, 511, true);
		jieqi_delfile($oldfile);
		$image_type = 0;
		$image_postfix = $jieqiConfigs["system"]["avatardt"];

		foreach ($jieqi_image_type as $k => $v ) {
			if ($image_postfix == $v) {
				$image_type = $k;
				break;
			}
		}

		$old_avatar = $jieqiUsers->getVar("avatar", "n");
		$jieqiUsers->unsetNew();
		$jieqiUsers->setVar("avatar", $image_type);

		if (!$users_handler->insert($jieqiUsers)) {
			jieqi_printfail($jieqiLang["system"]["avatar_set_failure"]);
		}
		else {
			$_SESSION["jieqiUserAvatar"] = $image_type;
			jieqi_jumppage(JIEQI_URL . "/setavatar.php", LANG_DO_SUCCESS, $jieqiLang["system"]["avatar_set_success"]);
		}
	}
	else {
		jieqi_printfail($jieqiLang["system"]["avatar_set_failure"]);
	}

	break;

case "cutavatar":
    include_once jieqi_path_common("header.php");
	$jieqiTpl->assign("url_avatar", JIEQI_URL . "/tmpavatar.php?time=" . JIEQI_NOW_TIME);
	$jieqiTpl->setCaching(0);
    $jieqiTset["jieqi_contents_template"] = jieqi_path_template("cutavatar.html", JIEQI_MODULE_NAME);
    include_once jieqi_path_common("footer.php");
	break;

case "upload":
	jieqi_checkpost();
	$errtext = "";

	if (empty($_FILES["avatarimage"]["name"])) {
		$errtext .= $jieqiLang["system"]["need_avatar_image"] . "<br />";
	}

	$image_postfix = "";

	if (!empty($_FILES["avatarimage"]["name"])) {
		if (0 < $_FILES["avatarimage"]["error"]) {
			$errtext = $jieqiLang["system"]["avatar_upload_failure"];
		}
		else {
			$image_postfix = strrchr(trim(strtolower($_FILES["avatarimage"]["name"])), ".");

			if (preg_match("/\.(gif|jpg|jpeg|png|bmp)$/i", $_FILES["avatarimage"]["name"])) {
				$typeary = explode(" ", trim($jieqiConfigs["system"]["avatartype"]));

				foreach ($typeary as $k => $v ) {
					if (substr($v, 0, 1) != ".") {
						$typeary[$k] = "." . $typeary[$k];
					}
				}

				if (!in_array($image_postfix, $typeary)) {
					$errtext .= sprintf($jieqiLang["system"]["avatar_type_error"], $jieqiConfigs["system"]["avatartype"]) . "<br />";
				}

				if ((intval($jieqiConfigs["system"]["avatarsize"]) * 1024) < $_FILES["avatarimage"]["size"]) {
					$errtext .= sprintf($jieqiLang["system"]["avatar_filesize_toolarge"], intval($jieqiConfigs["system"]["avatarsize"])) . "<br />";
				}
			}
			else {
				$errtext .= sprintf($jieqiLang["system"]["avatar_not_image"], $_FILES["avatarimage"]["name"]) . "<br />";
			}

			if (!empty($errtext)) {
				jieqi_delfile($_FILES["avatarimage"]["tmp_name"]);
			}
		}
	}
	else {
		$errtext = $jieqiLang["system"]["avatar_need_upload"];
	}

	if (empty($errtext)) {
		if (function_exists("gd_info") && $jieqiConfigs["system"]["avatarcut"]) {
			if (!empty($_FILES["avatarimage"]["name"])) {

                if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
                    $tmpfile = "files/tmp/" . $jieqiUsers->getVar("uid", "n") . "/" . $_FILES["avatarimage"]["name"];
                    jieqi_checkdir("files/tmp/" . $jieqiUsers->getVar("uid", "n"), true);
                    @move_uploaded_file($_FILES["avatarimage"]["tmp_name"], $tmpfile);
                    $imagefile = "files/tmp/" . $jieqiUsers->getVar("uid", "n") . "/" . $jieqiUsers->getVar("uid", "n") . $jieqiConfigs["system"]["avatardt"];
                }
                else{
                    $tmpfile = dirname($_FILES["avatarimage"]["tmp_name"]) . "/tmp_" . $_FILES["avatarimage"]["name"];
                    @move_uploaded_file($_FILES["avatarimage"]["tmp_name"], $tmpfile);
                    $imagefile = dirname($_FILES["avatarimage"]["tmp_name"]) . "/" . $jieqiUsers->getVar("uid", "n") . "_tmp" . $jieqiConfigs["system"]["avatardt"];
				}

                include_once jieqi_path_lib("image/imageresize.php");
                $imgresize = new ImageResize();
                $imgresize->load($tmpfile);
                $imgresize->save($imagefile, true, substr(strrchr(trim(strtolower($imagefile)), "."), 1));
                @chmod($imagefile, 511);
                jieqi_delfile($tmpfile);
			}

			if (!empty($_REQUEST["ajax_gets"])) {
				echo JIEQI_URL."/".$imagefile;
			}
			else{
				header("Location: " . JIEQI_URL . "/setavatar.php?act=cutavatar");
			}
			exit();
		}
		else {
			$image_type = 0;

			foreach ($jieqi_image_type as $k => $v ) {
				if ($image_postfix == $v) {
					$image_type = $k;
					break;
				}
			}

			$old_avatar = $jieqiUsers->getVar("avatar", "n");
			$jieqiUsers->unsetNew();
			$jieqiUsers->setVar("avatar", $image_type);

			if (!$users_handler->insert($jieqiUsers)) {
				jieqi_printfail($jieqiLang["system"]["avatar_set_failure"]);
			}
			else {

				if (!empty($_FILES["avatarimage"]["name"])) {
					$imagefile = jieqi_uploadpath($jieqiConfigs["system"]["avatardir"], "system");
					$imagefile .= jieqi_getsubdir($jieqiUsers->getVar("uid", "n"));
					if ((0 < $old_avatar) && isset($jieqi_image_type[$old_avatar])) {
						$old_imagefile = $imagefile . "/" . $jieqiUsers->getVar("uid", "n") . $jieqi_image_type[$old_avatar];

						if (is_file($old_imagefile)) {
							jieqi_delfile($old_imagefile);
						}
					}

					$imagefile .= "/" . $jieqiUsers->getVar("uid", "n") . $image_postfix;
					jieqi_copyfile($_FILES["avatarimage"]["tmp_name"], $imagefile, 511, true);
				}

				$_SESSION["jieqiUserAvatar"] = $image_type;
				jieqi_jumppage(JIEQI_URL . "/setavatar.php", LANG_DO_SUCCESS, $jieqiLang["system"]["avatar_set_success"]);
			}
		}
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case "show":
default:
    include_once jieqi_path_common("header.php");
	$avatartype = intval($jieqiUsers->getVar("avatar", "n"));
	$avatarimg = "";

	if (isset($jieqi_image_type[$avatartype])) {
		$urls = jieqi_geturl("system", "avatar", $jieqiUsers->getVar("uid", "n"), "a", $avatartype);

		if (is_array($urls)) {
			$jieqiTpl->assign("base_avatar", $urls["d"]);
			$jieqiTpl->assign("url_avatar", $urls["l"]);
			$jieqiTpl->assign("url_avatars", $urls["s"]);
			$jieqiTpl->assign("url_avatari", $urls["i"]);
		}
	}

	$jieqiTpl->assign("avatartype", $avatartype);
	$jieqiTpl->assign("need_imagetype", $jieqiConfigs["system"]["avatartype"]);
	$jieqiTpl->assign("max_imagesize", $jieqiConfigs["system"]["avatarsize"]);
	$jieqiTpl->assign("avatartype", $avatartype);
	if (function_exists("gd_info") && $jieqiConfigs["system"]["avatarcut"]) {
		$jieqiTpl->assign("avatarcut", 1);
	}
	else {
		$jieqiTpl->assign("avatarcut", 0);
	}

	$jieqiTpl->setCaching(0);
    $jieqiTset["jieqi_contents_template"] = jieqi_path_template("setavatar.html", JIEQI_MODULE_NAME);
    include_once jieqi_path_common("footer.php");
	break;
}

?>

