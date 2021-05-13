<?php

define("JIEQI_MODULE_NAME", "pay");
require_once ("../../global.php");
jieqi_checklogin();
include_once jieqi_path_common("header.php");
$jieqiTpl->assign("egoldname", JIEQI_EGOLD_NAME);
if (!empty($_REQUEST["t"]) && preg_match("/^\w+$/", $_REQUEST["t"]) && (strlen($_REQUEST["t"]) < 64)) {
	$paytpl = $_REQUEST["t"];
}
else {
	$paytpl = "buyegold";
	$_REQUEST["t"] = "buyegold";
}

$jieqiTpl->setCaching(0);
$tmpfile = jieqi_path_template($paytpl . ".html", "pay");

if (is_file($tmpfile)) {
	$jieqiTset["jieqi_contents_template"] = $tmpfile;
}
else if (is_file(jieqi_path_template("alipay.html", "pay"))) {
	$jieqiTset["jieqi_contents_template"] = jieqi_path_template("alipaypay.html", "pay");
	$_REQUEST["t"] = "alipaypay";
	$paytpl = "alipaypay";
}
else {
	$jieqiTset["jieqi_contents_template"] = "";
}

$jieqiTpl->assign("_request", jieqi_funtoarray("jieqi_htmlstr", $_REQUEST));
if (!empty($_REQUEST["p"]) && preg_match("/^\w+$/", $_REQUEST["p"]) && (strlen($_REQUEST["p"]) < 64)) {
	$paytype = $_REQUEST["p"];
}
else if (substr($paytpl, -3) == "pay") {
	$paytype = substr($paytpl, 0, -3);
}
else {
	$paytype = "";
}

if (!empty($paytype)) {
	jieqi_getconfigs("pay", $paytype, "jieqiPayset");
}

if (!empty($_REQUEST["a"]) && preg_match("/^\w+$/", $_REQUEST["a"]) && (strlen($_REQUEST["a"]) < 64)) {
	$payaction = $_REQUEST["a"];
}
else {
	$payaction = "payaction";
}

if (!empty($payaction)) {
	jieqi_getconfigs("pay", $payaction, "jieqiPayaction");
}

if (!empty($jieqiPayset[$paytype])) {
	if (empty($jieqiPayset[$paytype]["paydefault"]) && is_array($jieqiPayset[$paytype]["paylimit"])) {
		reset($jieqiPayset[$paytype]["paylimit"]);
		$jieqiPayset[$paytype]["paydefault"] = key($jieqiPayset[$paytype]["paylimit"]);
	}

	$jieqiTpl->assign("paytype", $paytype);
	$jieqiTpl->assign("payset", jieqi_funtoarray("jieqi_htmlstr", $jieqiPayset[$paytype]));
}
else {
	$jieqiTpl->assign("paytype", "");
	$jieqiTpl->assign("payset", "");
}

if (!empty($jieqiPayAction)) {
	foreach ($jieqiPayAction as $k => $v ) {
		if (!empty($v["expiretime"]) && (strtotime($v["expiretime"]) < JIEQI_NOW_TIME)) {
			$jieqiPayAction[$k]["isexpire"] = 1;
		}
		else {
			$jieqiPayAction[$k]["isexpire"] = 0;
		}

		if (empty($v["expiretime"])) {
			$v["expiretime"] = "";
		}
	}

	$jieqiTpl->assign("payaction", jieqi_funtoarray("jieqi_htmlstr", $jieqiPayAction));
}
else {
	$jieqiTpl->assign("payaction", array());
}

if (!empty($_REQUEST["jumpurl"]) && preg_match("/^(\/\w+|" . preg_quote(JIEQI_LOCAL_URL, "/") . ")/i", $_REQUEST["jumpurl"])) {
	$jumpurl = $_REQUEST["jumpurl"];
}
else {
	if (!empty($_SERVER["HTTP_REFERER"]) && preg_match("/^(\/\w+|" . preg_quote(JIEQI_LOCAL_URL, "/") . ")/i", $_SERVER["HTTP_REFERER"]) && !preg_match("/(\/pay\/\w+\.php)/i", $_SERVER["HTTP_REFERER"])) {
		$jumpurl = $_SERVER["HTTP_REFERER"];
	}
	else {
		$jumpurl = JIEQI_USER_URL . "/userdetail.php";
	}
}

$jieqiTpl->assign("jumpurl", jieqi_htmlstr($jumpurl));
$jieqiTpl->assign("jumpurl_n", $jumpurl);
include_once jieqi_path_common("footer.php");

?>
