<?php

define("JIEQI_MODULE_NAME", "system");

require_once ("global.php");

include_once jieqi_path_common("header.php");

$jieqiTpl->assign("jieqi_indexpage", 1);

jieqi_getconfigs("article", "sort", "jieqiSort");

foreach ($jieqiSort["article"] as $k => $v ) {
	$sortidrows[$i]["name"] = $v["caption"];
	$varary["sortid"] = $k;
	$sortidrows[$i]["url"] = jieqi_geturl("article", "articlefilter", 1, $varary);
	$sortidrows[$i]["selected"] = (isset($filterary["sortid"]) && ($filterary["sortid"] == $k) ? 1 : 0);
	$i++;
}
//edesd sd sd ed sd sds
$jieqiTpl->assign("sortidrows", $sortidrows);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("index.html", "system");
$jieqiTpl->setCaching(0);

include_once jieqi_path_common("footer.php");

?>
