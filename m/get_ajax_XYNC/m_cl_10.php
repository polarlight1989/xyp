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
 
include_once ROOT_PATH.'functioned/cheCookie.php';
include_once ROOT_PATH.'config/Oddes.php';
//include_once ROOT_PATH.'Admin/config/AdminConfig.php';
global $user;
$tid = $_POST['tid'];

 
	 
	//���¿�����¼
	$db = new DB();
	$result = $db->query("SELECT `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8` FROM `g_history9` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 0);
	$number = $result[0][0];
	$ballArr = array();
	for ($i=0; $i<count($result[0]); $i++)
	{
		if ($i != 0)
			$ballArr[] = $result[0][$i];
	}
	$ballArr = json_encode($ballArr);
	
	//��ǰ�û�������Ӯ
	$winMoney = json_encode(getWin ($user));
	
	//�p���L��
	global $BallString,$BallString_a;
	$results = history_resultnc(0);
	$num_arr = sum_ball_count_1 ($BallString, $BallString_a, $results, 2);
	arsort($num_arr);
	$num_arr = json_encode($num_arr);
	$row_1 = sum_str_s ($results, 8, 25, FALSE, FALSE, 2, 0); 	//���ʹ�С
	$row_2 = sum_str_s ($results, 8, 25, FALSE, FALSE, 4, 0);	//���͆��p
	$row_3 = sum_str_s ($results, 8, 25, FALSE, FALSE, 6, 0);	//����β����С
	$row_4 = sum_str_s ($results, 8, 25, TRUE);	//����
	
	$row_1 = json_encode($row_1);
	$row_2 = json_encode($row_2);
	$row_3 = json_encode($row_3);
	$row_4 = json_encode($row_4);
	
	
	//8
	$resulth2=str_replace("\"","",$num_arr);
	$resulth2=str_replace(",","|",$resulth2);
	$resulth2=str_replace(":",",",$resulth2);
	$resulth2=str_replace("{","",$resulth2);
	$resulth22=str_replace("}","",$resulth2);
	
	
	
	//3
	$resultb1=$row_1;
	$resultb1=str_replace(" ","",$resultb1);
	$resultb1=str_replace("<tdclass=\\\"z_cl\\\">","",$resultb1);
	 $resultb1=str_replace("<spanstyle=\\\"color:red;\\\">","",$resultb1);
	 $resultb1=str_replace("<\/span>","",$resultb1);
	 
	 $resultb1=str_replace("<spanstyle=\\\"color:#009100;\\\">","",$resultb1);
	 $resultb1=str_replace("<\/td>","",$resultb1);
	 $resultb1=str_replace(",","|",$resultb1);
	$resultb1=str_replace(",","|",$resultb1);
	$resultb1=str_replace("\"","",$resultb1);
	$resultb1=str_replace("[","",$resultb1);
	$resultb1=str_replace("]","",$resultb1);
	$resultb1=str_replace("<br\/>",",",$resultb1);
	
	/*
	��ʽ������
	5
	*/
	$resultd1=$row_2;
	$resultd1=str_replace(" ","",$resultd1);
	$resultd1=str_replace("<tdclass=\\\"z_cl\\\">","",$resultd1);
	 $resultd1=str_replace("<spanstyle=\\\"color:red;\\\">","",$resultd1);
	 $resultd1=str_replace("<\/span>","",$resultd1);
	 
	 $resultd1=str_replace("<spanstyle=\\\"color:#009100;\\\">","",$resultd1);
	 $resultd1=str_replace("<\/td>","",$resultd1);
	 $resultd1=str_replace(",","|",$resultd1);
	$resultd1=str_replace(",","|",$resultd1);
	$resultd1=str_replace("\"","",$resultd1);
	$resultd1=str_replace("[","",$resultd1);
	$resultd1=str_replace("]","",$resultd1);
	$resultd1=str_replace("<br\/>",",",$resultd1);
	//6
	$resulte1=$row_3;
	$resulte1=str_replace(" ","",$resulte1);
	$resulte1=str_replace("<tdclass=\\\"z_cl\\\">","",$resulte1);
	 $resulte1=str_replace("<spanstyle=\\\"color:red;\\\">","",$resulte1);
	 $resulte1=str_replace("<\/span>","",$resulte1);
	 
	 $resulte1=str_replace("<spanstyle=\\\"color:#009100;\\\">","",$resulte1);
	 $resulte1=str_replace("<\/td>","",$resulte1);
	 $resulte1=str_replace(",","|",$resulte1);
	$resulte1=str_replace(",","|",$resulte1);
	$resulte1=str_replace("\"","",$resulte1);
	$resulte1=str_replace("[","",$resulte1);
	$resulte1=str_replace("]","",$resulte1);
	$resulte1=str_replace("<br\/>",",",$resulte1);
	//7
	$resultf1=$row_4;
	$resultf1=str_replace(" ","",$resultf1);
	$resultf1=str_replace("<tdclass=\\\"z_cl\\\">","",$resultf1);
	 $resultf1=str_replace("<spanstyle=\\\"color:red;\\\">","",$resultf1);
	 $resultf1=str_replace("<\/span>","",$resultf1);
	 
	 $resultf1=str_replace("<spanstyle=\\\"color:#009100;\\\">","",$resultf1);
	 $resultf1=str_replace("<\/td>","",$resultf1);
	 $resultf1=str_replace(",","|",$resultf1);
	$resultf1=str_replace(",","|",$resultf1);
	$resultf1=str_replace("\"","",$resultf1);
	$resultf1=str_replace("[","",$resultf1);
	$resultf1=str_replace("]","",$resultf1);
	$resultf1=str_replace("<br\/>",",",$resultf1);
	//echo $resultd1;
	//echo '{"status":"1","long":"'.$resulth22 .'","ph_content":["10,1|15,1|12,1|11,1|12,1|11,1|19,1|13,3|9,1|11,2","��,4|С,1|��,1|С,2|��,2|С,1|��,1|С,1|��,4|С,3","�p,1|��,3|�p,2|��,4|�p,1|��,1|�p,1|��,1|�p,1|��,8"],"ph_title":"�ځ�܊��|�ځ�܊�ʹ�С|�ځ�܊�͆��p"}';
 echo '{"status":"1","long":"'.$resulth22.'","ph_content":["'.$resultb1.'","'.$resultd1.'","'.$resulte1.'","'.$resultf1.'"],"ph_title":"\u7e3d\u548c\u5927\u5c0f\u007c\u7e3d\u548c\u55ae\u96d9\u007c\u7e3d\u548c\u5c3e\u6578\u5927\u5c0f\u007c\u9f8d\u864e"}';

?>