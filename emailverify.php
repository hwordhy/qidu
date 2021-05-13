<?php

define('JIEQI_MODULE_NAME', 'system');
require_once 'global.php';
jieqi_loadlang('users', JIEQI_MODULE_NAME);
include_once jieqi_path_inc("class/users.php", "system");
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
//2018.04.10 注册时发送Email验证码
if (!empty($_REQUEST['sendemail']) && $_REQUEST['type'] == "randcode" && !empty($_REQUEST["email"])) {

    $isvalidfied = $users_handler->validField("email", $_REQUEST["email"]);

    if (!empty($isvalidfied)) {
        jieqi_printfail(implode("<br />", $isvalidfied) . "<br />");
    }

    jieqi_loadlang('users', 'system');
    jieqi_getconfigs('system', 'configs');
    include_once jieqi_path_lib("mail/mail.php");
    $title = sprintf($jieqiLang['system']['emailverify_email_title'], JIEQI_SITE_NAME);
    $htmlformat = false;
    $c_template = jieqi_path_template("emailrandcode.html", "system");
    $randcode = rand(10000, 9999);
    if (is_file($c_template)) {
        include_once jieqi_path_common("header.php");
        $jieqiTpl->assign('title', jieqi_htmlstr($title));
        $jieqiTpl->assign('randcode', $randcode);
        $jieqiTpl->setCaching(0);
        $content = $jieqiTpl->fetch($c_template);
        $htmlformat = true;
    }
    else {
        $content = sprintf($jieqiLang['system']['emailrandcode_email_content'], JIEQI_SITE_NAME, JIEQI_LOCAL_URL, $randcode);
    }

    $params = array();

    if (isset($jieqiConfigs['system']['mailtype'])) {
        $params['mailtype'] = $jieqiConfigs['system']['mailtype'];
    }

    if (isset($jieqiConfigs['system']['maildelimiter'])) {
        $params['maildelimiter'] = $jieqiConfigs['system']['maildelimiter'];
    }

    if (isset($jieqiConfigs['system']['mailfrom'])) {
        $params['mailfrom'] = $jieqiConfigs['system']['mailfrom'];
    }

    if (isset($jieqiConfigs['system']['mailserver'])) {
        $params['mailserver'] = $jieqiConfigs['system']['mailserver'];
    }

    if (isset($jieqiConfigs['system']['mailport'])) {
        $params['mailport'] = $jieqiConfigs['system']['mailport'];
    }

    if (isset($jieqiConfigs['system']['mailauth'])) {
        $params['mailauth'] = $jieqiConfigs['system']['mailauth'];
    }

    if (isset($jieqiConfigs['system']['mailuser'])) {
        $params['mailuser'] = $jieqiConfigs['system']['mailuser'];
    }

    if (isset($jieqiConfigs['system']['mailpassword'])) {
        $params['mailpassword'] = $jieqiConfigs['system']['mailpassword'];
    }

    $params['contenttype'] = ($htmlformat == true ? 'text/html' : 'text/plain');
    $jieqimail = new JieqiMail($_REQUEST["email"], $title, $content, $params);
    $jieqimail->sendmail();

    if ($jieqimail->isError(JIEQI_ERROR_RETURN)) {
        jieqi_printfail(sprintf($jieqiLang['system']['email_send_failure'], implode('<br />', $jieqimail->getErrors(JIEQI_ERROR_RETURN))));
    }
    else {
        session_start();
        $_SESSION["jieqiEmailCode"] = $randcode;
        jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang['system']['emailrandcode_success_title']);
    }
}
else if (!empty($_REQUEST['sendemail'])) {
	jieqi_checklogin();
	$user = $users_handler->get($_SESSION['jieqiUserId']);

	if (!is_object($user)) {
		jieqi_printfail(LANG_NO_USER);
	}

	$email = $user->getVar('email', 'n');

	if (empty($email)) {
		jieqi_printfail($jieqiLang['system']['email_not_set']);
	}

	$isverified = $user->getUserset('verify', 'email');

	if ($isverified) {
		jieqi_printfail($jieqiLang['system']['emailverify_is_finished']);
	}

	jieqi_loadlang('users', 'system');
	jieqi_getconfigs('system', 'configs');
	include_once jieqi_path_lib("mail/mail.php");
	if (!empty($_REQUEST["cancel"])){
        $url_emailverify = JIEQI_USER_URL . '/emailverify.php?id=' . $user->getVar('uid', 'n') . 'cancel=1&checkcode=' . md5($user->getVar('email', 'n') . $user->getVar('uid', 'n') . $user->getVar('regdate', 'n') . $user->getVar('salt', 'n'));
        $title = sprintf($jieqiLang['system']['emaicancel_email_title'], JIEQI_SITE_NAME);
        $c_template = jieqi_path_template("emailcancel.html", "system");
    }
    else{
        $url_emailverify = JIEQI_USER_URL . '/emailverify.php?id=' . $user->getVar('uid', 'n') . '&checkcode=' . md5($user->getVar('email', 'n') . $user->getVar('uid', 'n') . $user->getVar('regdate', 'n') . $user->getVar('salt', 'n'));
        $title = sprintf($jieqiLang['system']['emailverify_email_title'], JIEQI_SITE_NAME);
        $c_template = jieqi_path_template("emailverify.html", "system");
    }

	$htmlformat = false;

	if (is_file($c_template)) {
		include_once jieqi_path_common("header.php");
		$jieqiTpl->assign('uid', $user->getVar('uid'));
		$jieqiTpl->assign('email', $user->getVar('email'));
		$jieqiTpl->assign('uname', $user->getVar('uname'));
		$jieqiTpl->assign('name', $user->getVar('name'));
		$jieqiTpl->assign('title', jieqi_htmlstr($title));
		$jieqiTpl->assign('url_emailverify', $url_emailverify);
		$jieqiTpl->setCaching(0);
		$content = $jieqiTpl->fetch($c_template);
		$htmlformat = true;
	}
	else {
		$content = sprintf($jieqiLang['system']['emailverify_email_content'], JIEQI_SITE_NAME, JIEQI_LOCAL_URL, $url_emailverify);
	}

	$params = array();

	if (isset($jieqiConfigs['system']['mailtype'])) {
		$params['mailtype'] = $jieqiConfigs['system']['mailtype'];
	}

	if (isset($jieqiConfigs['system']['maildelimiter'])) {
		$params['maildelimiter'] = $jieqiConfigs['system']['maildelimiter'];
	}

	if (isset($jieqiConfigs['system']['mailfrom'])) {
		$params['mailfrom'] = $jieqiConfigs['system']['mailfrom'];
	}

	if (isset($jieqiConfigs['system']['mailserver'])) {
		$params['mailserver'] = $jieqiConfigs['system']['mailserver'];
	}

	if (isset($jieqiConfigs['system']['mailport'])) {
		$params['mailport'] = $jieqiConfigs['system']['mailport'];
	}

	if (isset($jieqiConfigs['system']['mailauth'])) {
		$params['mailauth'] = $jieqiConfigs['system']['mailauth'];
	}

	if (isset($jieqiConfigs['system']['mailuser'])) {
		$params['mailuser'] = $jieqiConfigs['system']['mailuser'];
	}

	if (isset($jieqiConfigs['system']['mailpassword'])) {
		$params['mailpassword'] = $jieqiConfigs['system']['mailpassword'];
	}

	$params['contenttype'] = ($htmlformat == true ? 'text/html' : 'text/plain');
	$jieqimail = new JieqiMail($email, $title, $content, $params);
	$jieqimail->sendmail();

	if ($jieqimail->isError(JIEQI_ERROR_RETURN)) {
		jieqi_printfail(sprintf($jieqiLang['system']['email_send_failure'], implode('<br />', $jieqimail->getErrors(JIEQI_ERROR_RETURN))));
	}
	else {
		jieqi_jumppage(JIEQI_URL . '/userdetail.php?sendemail=1', $jieqiLang['system']['emailverify_success_title'], $jieqiLang['system']['emailverify_success_content']);
	}
}
else if (!empty($_REQUEST['id']) && !empty($_REQUEST['checkcode'])) {
	$_REQUEST['id'] = intval($_REQUEST['id']);
	$user = $users_handler->get($_REQUEST['id']);

	if (!is_object($user)) {
		jieqi_printfail(LANG_NO_USER);
	}

	if (md5($user->getVar('email', 'n') . $user->getVar('uid', 'n') . $user->getVar('regdate', 'n') . $user->getVar('salt', 'n')) != $_REQUEST['checkcode']) {
		jieqi_printfail($jieqiLang['system']['emailverify_error_checkcode']);
	}
	else {
        $isverified = $user->getUserset('verify', 'email');

        if (!empty($_REQUEST["cancel"])){

            if ($isverified) {
                $user->setVar('verify', $user->upUserset('verify', 'email', 0));
                $users_handler->insert($user);
            }

            jieqi_jumppage(JIEQI_URL . '/userdetail.php', $jieqiLang['system']['emailcancel_success_title'], $jieqiLang['system']['emailcancel_success_content']);
        }
        else{
            if (!$isverified) {
                $user->setVar('verify', $user->upUserset('verify', 'email', 1));
                $users_handler->insert($user);
            }

            jieqi_jumppage(JIEQI_URL . '/userdetail.php', $jieqiLang['system']['emailverify_success_title'], $jieqiLang['system']['emailverify_success_content']);
        }
	}
}
else {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

?>
