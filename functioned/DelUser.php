<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-15
*/
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $Users, $LoginId;
if ($Users[0]['g_login_id'] == 89 &&  isset($_GET['uid']) && isset($_GET['sid']) && isset($_GET['code']))
{
	$name = $_GET['uid'];
	$sid = $_GET['sid'];
	$code = $_GET['code'];
	
	
	
	$db = new DB();
	
	$sql = "SELECT * FROM `j_manage` WHERE g_name = '{$Users[0]['g_name']}' ";
	$result = $db->query($sql, 1);
	
	if($result[0]['g_code']==$code){
	
	$form = $sid == 2 ? "g_rank" : "g_user";
	$sql = "SELECT g_nid, g_name FROM `{$form}` WHERE g_name = '{$name}' LIMIT 1";
	$username = $db->query($sql, 0);
	if ($username)
	{
		if ($sid == 2)
		{
			$p = " g_user.g_nid LIKE '{$username[0][0]}%' ";
			$w = "g_s_nid LIKE '{$username[0][0]}%'";
			
			
			$result = $db->query("SELECT * FROM `g_rank` WHERE g_nid LIKE '{$username[0][0]}%'", 1);
			$pp = "";
			$pp1 = "";
		
			foreach ($result as $row)
			{
					$pp .= ",'{$row['g_name']}'";
					$pp1 .= ",'{$row['g_nid']}'";
			}
			$pp = substr($pp, 1);
			$pp1 = substr($pp1, 1);
			
			if (count($result) > 0)
			{
				$sql = "DELETE FROM `g_relation_user` WHERE g_s_nid IN ({$pp1})";
				$db->query($sql, 2);
				$sql = "DELETE FROM `g_send_back` WHERE g_name IN ({$pp})";
				$db->query($sql, 2);
				$sql = "DELETE FROM `g_autolet` WHERE g_name IN ({$pp})";
				$db->query($sql, 2);
				$sql = "DELETE FROM `g_insert_log` WHERE g_name IN ({$pp})";
				$db->query($sql, 2);
				$sql = "DELETE FROM `g_login_log` WHERE g_name IN ({$pp})";
				$db->query($sql, 2);
			}
			$sql = "DELETE FROM `g_rank` WHERE g_nid LIKE '{$username[0][0]}%'";
			$db->query($sql, 2);
			
		}
		else 
		{
			$p = " g_user.g_name = '{$username[0][1]}' ";
			$w = "g_nid = '{$username[0][1]}'";
		}

		$result = $db->query("SELECT `g_name` FROM `g_user` WHERE {$p}", 0);
		$pp = "";
			foreach ($result as $row)
			{
					$pp .= ",'{$row[0]}'";
			}
			if (count($result) > 0)
			{
			$pp = substr($pp, 1);
				$sql = "DELETE FROM `g_panbiao` WHERE g_nid IN ({$pp})";
				$db->query($sql, 2);
				$sql = "DELETE FROM `g_insert_log` WHERE g_name IN ({$pp})";
				$db->query($sql, 2);
				$sql = "DELETE FROM `g_login_log` WHERE g_name IN ({$pp})";
				$db->query($sql, 2);
			}
			$sql = "DELETE FROM `g_user` WHERE {$p}";
			$db->query($sql, 2);
			
		$sql = "DELETE FROM g_zhudan WHERE {$w}";
		$db->query($sql, 2);
		exit(back('刪除成功'));
	}

	}else{
		exit(back('安全码错误！'));
	}
}
?>