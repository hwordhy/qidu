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

jieqi_getconfigs(JIEQI_MODULE_NAME, "option", "jieqiOption");

if (!isset($_POST["act"])) {
	$_POST["act"] = "edit";
}

switch ($_POST["act"]) {
case "name":
	jieqi_checkpost();
    $jieqiUsers->setVar("name", $_POST["data"]);

	if (!$users_handler->insert($jieqiUsers)) {
        if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
            echo json_encode(array("success" => false, "data" => '数据修改失败，请与管理员', "message" => '获取成功'));
            return false;

        }
	}

    if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
        echo json_encode(array("success" => true, "data" => $jieqiUsers, "message" => '获取成功'));
        return false;

    }
	break;

case "sex":
	jieqi_checkpost();
	$jieqiUsers->setVar("sex", $_POST["data"]);

	if (!$users_handler->insert($jieqiUsers)) {
		if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
			echo json_encode(array("success" => false, "data" => '数据修改失败，请与管理员', "message" => '获取成功'));
			return false;

		}
	}

    if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
        echo json_encode(array("success" => true, "data" => $jieqiUsers, "message" => '获取成功'));
        return false;

    }
	break;

case "qq":
	jieqi_checkpost();
	$jieqiUsers->setVar("qq", $_POST["data"]);

	if (!$users_handler->insert($jieqiUsers)) {
		if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
			echo json_encode(array("success" => false, "data" => '数据修改失败，请与管理员', "message" => '获取成功'));
			return false;

		}
	}

    if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
        echo json_encode(array("success" => true, "data" => $jieqiUsers, "message" => '获取成功'));
        return false;

    }
	break;

case "mobile":
	jieqi_checkpost();
	$jieqiUsers->setVar("mobile", $_POST["data"]);

	if (!$users_handler->insert($jieqiUsers)) {
		if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
			echo json_encode(array("success" => false, "data" => '数据修改失败，请与管理员', "message" => '获取成功'));
			return false;

		}
	}

    if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
        echo json_encode(array("success" => true, "data" => $jieqiUsers, "message" => '获取成功'));
        return false;

    }
	break;

case "edit":
default:
	include_once jieqi_path_common("header.php");
    if (isset($_REQUEST["ajax_gets"]) && JIEQI_COVER_DIR == '') {
        echo json_encode(array("success" => false, "data" => $jieqiUsers, "message" => '对不起，参数错误！'));
        return false;

    }
	include_once jieqi_path_common("footer.php");
	break;
}

?>
