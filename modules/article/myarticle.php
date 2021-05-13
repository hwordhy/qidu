<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_getconfigs("article", "power");
jieqi_checkpower($jieqiPower["article"]["authorpanel"], $jieqiUsersStatus, $jieqiUsersGroup, false);
include_once jieqi_path_common("header.php");
$jieqiTpl->assign("authorarea", 1);
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = jieqi_path_template("myarticle.html", "article");
include_once jieqi_path_common("footer.php");

?>
