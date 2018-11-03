<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-13
*/
if (!defined('Copyright') && Copyright != 'Sorry, the page wrong path')
exit('Sorry, the page wrong path');
if (!defined('ROOT_PATH'))
exit('invalid request');
include_once ROOT_PATH.'functioned/globalge.php';
global $Home,$Port;

$ConfigModel = configModel("`g_web_lock`");
if ($ConfigModel['g_web_lock'] != 1) 
{
	href("/");
	exit;
}
$home = $_SERVER["SERVER_NAME"];
$port = $_SERVER["SERVER_PORT"];
$lock = false;
for ($i=0; $i<count($Home); $i++)
{
	if ($home == $Home[$i] && $port == $Port[$i]|| ($home == $mHome[$i] && $port == $mPort[$i]))
	{
		$lock = true;
		break;
	}
}
if ($lock == false)
{
	href("/");
	exit;
}
//dump($_COOKIE);
if (!isset($_COOKIE['g_user']) || !isset($_COOKIE['g_uid'])) 
{
	href("/");
	exit;
} 
else 
{
//	dump("aaa");
//	$name = base64_decode($_COOKIE['g_user']);
//	$uid = base64_decode($_COOKIE['g_uid']);
	$name = checkStr(base64_decode($_COOKIE['g_user']))?checkStr(base64_decode($_COOKIE['g_user'])):alert1("非法操作！");
	$uid = checkStr(base64_decode($_COOKIE['g_uid']))?checkStr(base64_decode($_COOKIE['g_uid'])):alert1("非法操作！");
	$db = new DB();
	$sql = "SELECT `g_nid`, `g_login_id`, `g_name`, `g_f_name`, `g_mumber_type`, `g_password`, `g_money`, `g_money_yes`, `g_distribution`, `g_panlu`,`g_panlus`, `g_xianer`, `g_out`, `g_count_time`, `g_look`, `g_ip`, `g_date`, `g_uid`,`xtfm`,`g_win_d`,`g_win_k`  FROM `g_user` WHERE `g_name` = '{$name}' AND `g_uid` = '{$uid}' LIMIT 1 ";
	$user = $db->query($sql, 1);
	if (!$user){
		exit(href("/"));
	}
	if ($user[0]['g_look'] == 3){
		exit(alert_href($UserLook,'/'));
	}
	if ($user[0]['g_out'] == 0)
	{
		href("/");
		exit;
	}
	else 
	{
		$sql = "UPDATE `g_user` SET `g_count_time`=now() WHERE `g_name`='{$name}' LIMIT 1";
		$db->query($sql, 2);
	}
}




?>