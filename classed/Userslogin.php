<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-07 09:28:32
*/
if (!defined('Copyright') && Copyright != 'Sorry, the page wrong path')
exit('Sorry, the page wrong path');
if (!defined('ROOT_PATH'))
exit('invalid request');

class UserModel 
{
	private $db;
	function __construct()
	{
		$this->db = new DB();
	}
	
	/**
	 * UNION 查詢
	 * 判斷帳號用戶是否存在
	 */
	public function ExistUnion ($userName, $passWord)
	{
		$pwd = " AND g_password = '{$passWord}' ";
		$sql = " (SELECT `g_login_id` FROM `j_manage` WHERE g_name = '{$userName}' {$pwd}) UNION ".
				     " (SELECT `g_login_id` FROM `g_user` WHERE g_name = '{$userName}' {$pwd}) UNION ".
					 " (SELECT `g_s_name` FROM `g_relation_user` WHERE g_s_name = '{$userName}' {$pwd}) UNION ".
				     " (SELECT `g_login_id` FROM `g_rank` WHERE g_name = '{$userName}' {$pwd}) ";
		return $this->db->query($sql, 0);
	}
	

	public function GetUserModel ($loginId=null, $userName, $passWord=null, $son=false)
	{
		$pwd = "AND `g_password` = '{$passWord}' ";
		if ($son == false && Copyright)
		{
			$from = $loginId == null ? "`g_rank`" : $this->GetLoginId($loginId);
			$sql = "SELECT * FROM {$from} WHERE `g_name` = '{$userName}' {$pwd} LIMIT 1 ";
		} 
		else //查詢子帳號，首選查詢管理員子帳號
		{
			$sonUser = $this->db->query("SELECT g_s_login_id FROM g_relation_user WHERE g_s_name = '{$userName}' {$pwd} LIMIT 1 ", 0);
			if ($sonUser[0][0] == 89 && Copyright){
				//管理員子帳號
				$rFrom = "j_manage";
			} else {
				$rFrom = "g_rank";
			}
			$sql ="SELECT r. * , 
						u.`g_s_name`, 
						u.`g_lock` AS g_s_lock, 
						u.`g_lock_1` , 
						u.`g_lock_2` , 
						u.`g_lock_3` , 
						u.`g_lock_4` , 
						u.`g_lock_5` , 
						u.`g_lock_6` , 
						u.`g_lock_1_1` , 
						u.`g_lock_1_2` , 
						u.`g_lock_1_3` , 
						u.`g_lock_1_4` , 
						u.`g_lock_1_5` , 
						u.`g_lock_1_6` , 
						u.`g_lock_1_7` , 
						u.`g_out` AS g_s_out, 
						u.`g_s_uid` , 
						u.`g_s_login_id`,
						u.`g_sh_id` 
						FROM `g_relation_user` AS u
						INNER JOIN {$rFrom} AS r ON u.g_s_nid = r.g_nid
						WHERE u.g_s_name = '{$userName}' ";
		}
		return $this->db->query($sql, 1);
	}
	private function GetLoginId ($loginId)
	{
		if ($loginId == 89 && Copyright){
			return "`j_manage`";
		}else {
			return "`g_rank`";
		}
	}
	
		public function UpdateGuid ($loginId, $userName, $uniqid, $son=false)
	{
		$gip=GetIP();
		if ($son == false && Copyright){
			$from = $this->GetLoginId($loginId);
			$uid = "`g_uid`";
			$where = " `g_name` = '{$userName}' ";
		} else {
			$from = "`g_relation_user`";
			$uid = "`g_s_uid`";
			$where = " `g_s_name` = '{$userName}' ";
		}
		$this->db->Update(" {$uid} = '{$uniqid}', `g_out` =1, `g_count_time`=now(), g_ip='{$gip}' ", $from, $where, 1);
	}
	
	}
function GetMsie ()
{
	$browser = FALSE;
	if(strpos($_SERVER[HTTP_USER_AGENT], 'MSIE 8.0')) 
		$browser = TRUE;
	else if (strpos($_SERVER[HTTP_USER_AGENT], 'MSIE 7.0'))
		$browser = TRUE;
	else if (strpos($_SERVER[HTTP_USER_AGENT], 'MSIE 6.0'))
		$browser = TRUE;
	return true;
}


?>