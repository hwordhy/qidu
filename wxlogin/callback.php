<?php
require 'config.php';
require dirname(dirname(__FILE__)).'/global.php';
$code   = isset($_GET['code'])?$_GET['code']:'';
if(empty($code))header('Location:/');
//获取用户openid，unionid
$url    ="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxce81fc6c51e8fa08&secret=bdc608e38e68e34217cc7126892ccb4b&code=".$code."&grant_type=authorization_code";
$datastr=  file_get_contents($url);
$dataArr =json_decode($datastr,true);
//获取用户详细信息
if (!empty($dataArr)) {
	$access_token = $dataArr['access_token'];
	$openid       = $dataArr['openid']; 
	$url          = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid";
	$datastr      =  file_get_contents($url);
	$userinfo     =json_decode($datastr,true);
	if (!empty($userinfo)) {
		//入库
		update_users($userinfo,$dataArr);
	}else{
		header('Location:/');
	}
	
}else{
	header('Location:/');
}


function update_users($userinfo,$dataArr)
{
	//没有就库
	$find_sql  = "select * from jieqi_system_users where unionid = '".$dataArr['unionid']."' limit 1 ";
	$res       = mysql_query($find_sql);
	$user      = mysql_fetch_assoc($res);
	if(!empty($user)){
		//已存在 TODO
		header('Location:/');
	}else{
		$email = time()."@qq.com";
		//插入一条信息
		$insert_sql = " insert into jieqi_system_users (`uname`,`name`,`email`,`openid`,`unionid`)values('{$userinfo['nickname']}','{$userinfo['nickname']}','$email','{$dataArr['openid']}','{$dataArr['unionid']}')";
		$res = mysql_query($insert_sql);
		header('Location:/');
	}
}




