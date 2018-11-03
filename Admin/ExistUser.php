<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-27
*/
if (!defined('Copyright') && Copyright != 'Sorry, the page wrong path')
exit('Sorry, the page wrong path');
if (!defined('ROOT_PATH'))
exit('invalid request');
include_once ROOT_PATH.'Admin/config/globalge.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
include_once ROOT_PATH.'classed/check.classed.php';
global $ConfigModel,$sHome,$sPort;

$UserModel = new UserModel();

$Userjs = $UserModel->ExistUnionjs($_SESSION['sName']);
if(is_numeric($Userjs[0][0])  && $Userjs[0][0]<90 ) {
$Userys = $UserModel->GetUserModel($_SESSION['loginId'], $_SESSION['sName']);
$g_unid=md5($Userys[0]['g_unid']);
if ($_SESSION['manege_ch']!=$g_unid){
	href("Quit.php");
	exit;
}
if ($_SESSION['manege_ch']!=$Userys[0]['g_uid']){
	href("Quit.php");
	exit;
}
}
$Usertj = $UserModel->Getmanegetj($_SESSION['sName']);
$g_untjid=sha1($Usertj[0]['s_date']);
if ($_SESSION['manege_sh']!=$g_untjid){
href("Quit.php");
	exit;
}
if ($_SESSION['manege_sh']!=$Usertj[0]['s_sha']){
href("Quit.php");
	exit;
}
$home = $_SERVER["SERVER_NAME"];
$port = $_SERVER["SERVER_PORT"];
$lock = false;
for ($i=0; $i<count($sHome); $i++)
{
	if ($home == $sHome[$i] && $port == $sPort[$i])
	{
		$lock = true;
		break;
	}
}

for ($i=0; $i<count($dHome); $i++)
{
	if ($home == $dHome[$i] && $port == $dPort[$i])
	{
	
		$lock = true;
		break;
	}
}

if ($lock == false){
	href("/");
	exit;
}

if ($_COOKIE['manage_user'] == null || $_COOKIE['manage_uid'] == null ||  !isset($_SESSION['loginId']) || !isset($_SESSION['sName'])) 
{
	href("Quit.php");
	exit;
}

$name = checkStr(base64_decode($_COOKIE['manage_user']))?checkStr(base64_decode($_COOKIE['manage_user'])):alert("非法操作！");
$uid = checkStr(base64_decode($_COOKIE['manage_uid']))?checkStr(base64_decode($_COOKIE['manage_uid'])):alert("非法操作！");
$_SESSION['loginId'] = $_SESSION['loginId'];
$_SESSION['sName'] = $_SESSION['sName'];

$userModel = new UserModel();
$db=new DB();
if (isset($_SESSION['son'])) 
{ //子帳�?
	$Users = $userModel->GetUserModel(null, $_SESSION['sName'], null, true);
	if (!$Users) href("Quit.php");
	if ($ConfigModel['g_web_lock'] != 1) 
		exit(back($ConfigModel['g_web_text']));
	if (!$db->query("SELECT g_s_name FROM g_relation_user WHERE g_s_uid = '{$uid}' LIMIT 1 ", 0)) 
		exit(href('Quit.php'));
	if ($Users[0]['g_s_lock'] == 3 || $Users[0]['g_lock'] == 3)
		exit(alert_href($UserLook, 'Quit.php')); //帳號已被停用
	if ($Users[0]['g_s_out'] == 0) {
			href("Quit.php");
			exit;
		} else {
			$sql = "UPDATE `g_relation_user` SET `g_out` =1, `g_count_time`=now() WHERE `g_s_name`='{$_SESSION['sName']}' LIMIT 1 ";
			$db->query($sql, 2);
		}
} 
else 
{
	$Users = $userModel->GetUserModel($_SESSION['loginId'], $_SESSION['sName']);
	if (!$Users) 
	href("Quit.php");
	if ($Users[0]['g_login_id'] != 89) {
		if ($ConfigModel['g_web_lock'] != 1) 
			exit(back($ConfigModel['g_web_text']));
		if (!$db->query("SELECT `g_name` FROM `g_rank` WHERE g_uid = '{$uid}' LIMIT 1 ", 0)) 
			exit(href('Quit.php'));
		if ($Users[0]['g_lock'] == 3)
			exit(alert_href($UserLook, 'Quit.php')); //帳號已被停用
		if ($Users[0]['g_out'] == 0) {
			href("Quit.php");
			exit;
		} else {
			$sql = "UPDATE `g_rank` SET `g_out` =1, `g_count_time`=now() WHERE `g_name`='{$_SESSION['sName']}' LIMIT 1 ";
			$db->query($sql, 2);
		}
	} else {
		if (!$db->query("SELECT g_name FROM j_manage WHERE g_uid = '{$uid}' LIMIT 1 ", 0)){
			exit(href('Quit.php'));
		}else{
			$sql = "UPDATE `j_manage` SET `g_out` =1, `g_count_time`=now() WHERE `g_name`='{$_SESSION['sName']}' LIMIT 1 ";
			$db->query($sql, 2);
		}
	}
}
	
$Users[0]['g_Lnid'] = $userModel->GetLoginIdByString ($_SESSION['loginId']);
$LoginId =$Users[0]['g_login_id'];

?>