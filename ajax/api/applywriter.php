<?php

session_start();
$uid = $_SESSION["jieqiUserId"];
include ("../class/json.php");
include ("../../configs/define.php");
$con = mysqli_connect(JIEQI_DB_HOST, JIEQI_DB_USER, JIEQI_DB_PASS);
mysqli_query($con, "set names ".JIEQI_DB_CHARSET);

if (!$con) {
	exit("Could not connect: " . mysqli_error($con));
}

mysqli_select_db($con, JIEQI_DB_NAME);
$result = mysqli_query($con, "SELECT * FROM jieqi_system_persons where uid = " . $uid);
$row = mysqli_fetch_assoc($result);
if ((strlen($row["realname"]) < 1) || (strlen($row["gender"]) < 1) || (strlen($row["mobilephone"]) < 1) || (strlen($row["idcardtype"]) < 1) || (strlen($row["idcard"]) < 1)) {
	api_json("", "false");
}
else {
	api_json("", "true");
}

mysqli_close($con);

?>
