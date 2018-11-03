<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 860336530
  Author: Version:1.0
  Date:2011-12-15
*/
define('Copyright', 'Author QQ: 860336530');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $Users, $LoginId;
if ($Users[0]['g_login_id'] == 89 &&  isset($_GET['uid']) && isset($_GET['sid']) && isset($_GET['code']))
{
	$name = $_GET['uid'];
	$sid = $_GET['sid'];
	$code = $_GET['code'];
	$psType = intval($_GET['psType']);
	$psMoney = $_GET['psMoney'];
	if(!is_numeric($psMoney )) exit(back('金额错误！'));
	
	$db = new DB();
	
	$sql = "SELECT g_code FROM `j_manage` WHERE g_name = '{$Users[0]['g_name']}' ";
	$result = $db->query($sql, 1);
	
	if($result[0]['g_code']==$code){
		
		$form = "g_user";
		$sql = "SELECT g_nid, g_name, g_f_name,iscash FROM `{$form}` WHERE g_name = '{$name}' LIMIT 1";
		$username = $db->query($sql, 1);
		if($username[0]['iscash']!=0) exit(back($username[0]['g_name'].'不是现金会员！'));
		if ($username)
		{
			$ordernum= $name.'_'.time();
			if($psType==1){
				$sql = "INSERT INTO g_payrecord SET PayWay=0, g_name='" . $name . "',Money='" . $psMoney . "',v_Name='',BankName='',ordernum='" . $ordernum . "',optdt='" . date("Y-m-d H:i:s") . "',status='1',IsBank='1',BankNumber='',cardpass='',InType='1',bz='管理员加款' ";
        		$db->query($sql, 0);
				$sql = "UPDATE `g_user` SET `g_money_yes` = g_money_yes+".$psMoney." WHERE `g_name` = '".$name."' LIMIT 1 ";
				$db->query($sql, 2);
			}else{
				$sql = "INSERT INTO g_payrecord SET PayWay=0, g_name='" . $name . "',Money='" . $psMoney . "',v_Name='',BankName='',ordernum='" . $ordernum . "',optdt='" . date("Y-m-d H:i:s") . "',status='1',IsBank='0',BankNumber='',cardpass='',InType='2',bz='管理员扣款' ";
				$db->query($sql, 0);
				$sql = "UPDATE `g_user` SET `g_money_yes` = g_money_yes-".$psMoney." WHERE `g_name` = '".$name."' LIMIT 1 ";
				$db->query($sql, 2);
			}
			exit(back('操作成功'));
		}else{exit(back('会员不存在!'));}

	}else{
		exit(back('安全码错误！'));
	}
}
?>