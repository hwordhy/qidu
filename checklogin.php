<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("global.php");
if (!jieqi_checklogin(true)) {
    echo json_encode(array("flag" =>false, "content"=>"", "msg"=>'获取失败'));
}
else{
    echo json_encode(array("flag" =>true, "content"=>array("image"=>jieqi_geturl("system", "avatar", $_SESSION['jieqiUserId'], "l")), "msg"=>'获取成功'));
}

?>
