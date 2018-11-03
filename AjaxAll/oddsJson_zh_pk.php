<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-12
*/

define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
if ($_SERVER["REQUEST_METHOD"] != "POST") {exit;}
include_once ROOT_PATH.'functioned/cheCookie.php';
include_once ROOT_PATH.'config/Oddes.php';
//include_once ROOT_PATH.'Admin/config/AdminConfig.php';
global $user;
$tid = $_POST['tid'];

if ($tid == 1)
{
	//最新开奖记录
	$db = new DB();
	$result = $db->query("SELECT `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8`, `g_ball_9`, `g_ball_10` FROM `g_history6` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 0);
	$number = $result[0][0];
	$ballArr = array();
	for ($i=0; $i<count($result[0]); $i++)
	{
		if ($i != 0)
			$ballArr[] = $result[0][$i];
	}
	$ballArr = json_encode($ballArr);
	
	//当前用户今天输赢
	$winMoney = json_encode(getWin ($user));
	
	//雙面長龍
	global $BallStringpk,$BallString_apk;
	$results = history_resultpk(0);
	$num_arr = sum_ball_count_1_pk ($BallStringpk, $BallString_apk, $results, 2);
	arsort($num_arr);
	$num_arr = json_encode($num_arr);
	$row_1 = sum_str_s_pk ($results, 8, 25, FALSE, FALSE, 6, 0); 	//冠亚和
	$row_2 = sum_str_s_pk ($results, 8, 25, FALSE, FALSE, 2, 0);	//冠亚和大小
	$row_3 = sum_str_s_pk ($results, 8, 25, FALSE, FALSE, 4, 0);	//冠亚和单双

	
	$row_1 = json_encode($row_1);
	$row_2 = json_encode($row_2);
	$row_3 = json_encode($row_3);
	
	echo <<<JSON
			{
				"winMoney" : $winMoney,
				"number" : $number,
				"ballArr" : $ballArr,
				"num_arr" : $num_arr,
				"row_1" : $row_1,
				"row_2" : $row_2,
				"row_3" : $row_3
			}
JSON;
exit;
}
else if ($tid == 2)
{
	//獲取封盤時間、開獎時間、刷新時間
	$db = new DB();
	$result = $db->query("SELECT `g_qishu`, `g_feng_date`, `g_open_date` FROM g_kaipan6 WHERE `g_lock` = 2 LIMIT 1 ", 1);
	if ($result && Copyright)
	{
		$endTime = strtotime($result[0]['g_feng_date']) - time();
		$openTime =  strtotime($result[0]['g_open_date']) - time();
		$Phases = $result[0]['g_qishu'];
		$RefreshTime = 90; //刷新時間
		
		//取出1-8球和總和龍虎雙面賠率
		$db=new DB();
		$sql = "SELECT  h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,h11,h12,h13,h14,h15,h16,`g_type`  FROM `g_odds6` WHERE `g_type` = 'Ball_1' OR `g_type` = 'Ball_2'  ORDER BY g_id ASC ";
		$sresult = $db->query($sql, 1);
		$sql = "SELECT  h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,h11,h12,h13,h14,h15,h16,h17,`g_type`   FROM `g_odds6` WHERE g_type = 'Ball_11' or g_type = 'Ball_12' ORDER BY g_id ASC ";
		$eresult = $db->query($sql, 1);
		$list = array_merge($sresult,$eresult);
		$oddsMax = 0;
		
		$arrList = array();
		for ($i=0; $i<count($list); $i++){
			$str=$list[$i]['g_type'];
			foreach ($list[$i] as $key=>$value){
				$arrList[$i][$key] = setoddspk($key, $value,  $user, 3,$str);
			}
		}
		$arrList = json_encode($arrList);
		echo <<<JSON
			{
			"Phases" : $Phases,
			"endTime" : "$endTime",
			"openTime" : "$openTime",
			"refreshTime" : "$RefreshTime",
			"oddsList" : $arrList
			}
JSON;
	}
}
else if ($tid == 3)
{
	$db = new DB();
	$result = $db->query("SELECT `g_qishu` FROM `g_history6` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 0);
	$number = $result[0][0];
	echo $number;
}











?>