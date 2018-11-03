<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $Users, $LoginId;
if ($Users[0]['g_login_id'] != 89) if ($Users[0]['g_lock'] == 2)
	exit(back($UserOut)); //帳號已被凍結
	
//子帳號
if (isset($Users[0]['g_lock_2'])){
	if ( $Users[0]['g_s_lock'] == 2 || $Users[0]['g_lock_2'] != 1)
		exit(back($UserOut)); //帳號已被凍結
}


$userModel = new UserModel();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST['name'];
	//dump($name);
	$usersModel = $userModel->GetUserModel(null, $name);
	if ($usersModel)
	{
	$Lname = mb_substr($usersModel[0]['g_nid'], 0, mb_strlen($usersModel[0]['g_nid'])-32);
		$Lname = $userModel->GetUserName_Like($Lname);
		$db = new DB();
		if ($usersModel[0]['g_login_id'] == 56){
			$Lname=$usersModel;
		} else {
			if ($Lname[0]['g_lock'] != 1) {
				exit(back('更變權限不足！'));
			}
		}
		$sList = array(0=>0, 1=>0, 2=>0);
		
		//农场
		$LdetList_nc = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id` 
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' and g_game_id = '9'  ORDER BY g_id DESC", 0);
		
	//	dump($LdetList);
		
	     for ($i=0; $i<count($LdetList_nc); $i++) {
			$aList = $_POST['RebateANC'.($i+1)];
			$bList = $_POST['RebateBNC'.($i+1)];
			$cList = $_POST['RebateCNC'.($i+1)];
			$dList = $_POST['RebateENC'.($i+1)];
			$eList = $_POST['RebateFNC'.($i+1)];
			if ($aList > 100) exit(back(' 退水最高不超过：100'));
			if ($bList > 100) exit(back(' 退水最高不超过：100'));
			if ($cList > 100) exit(back(' 退水最高不超过：100'));

        	if ($aList > $LdetList_nc[$i][3])
			{
				//取A盘
				$LdetList_nc[$i][3] = $aList;
				updateTuiShui ($db, $LdetList_nc[$i], $usersModel, 'a', $aList);
			} 
			if ($bList > $LdetList_nc[$i][4])
			{
				//取B盘
				$LdetList_nc[$i][4] = $bList;
				updateTuiShui ($db, $LdetList_nc[$i], $usersModel, 'b', $bList);
			} 
			if ($cList > $LdetList_nc[$i][5])
			{
				//取C盘
				$LdetList_nc[$i][5] = $cList;
				updateTuiShui ($db, $LdetList_nc[$i], $usersModel, 'c', $cList);
			}
			
			//修改退水
			$sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetList_nc[$i][2]}' AND g_game_id = '{$LdetList_nc[$i][8]}' LIMIT 1";
			$db->query($sql, 2);
			
		}
		//广东
		$LdetList = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id` 
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' and g_game_id = '1'  ORDER BY g_id DESC", 0);
		
	//	dump($LdetList);
		
	     for ($i=0; $i<count($LdetList); $i++) {
			$aList = $_POST['RebateAG'.($i+1)];
			$bList = $_POST['RebateBG'.($i+1)];
			$cList = $_POST['RebateCG'.($i+1)];
			$dList = $_POST['RebateEG'.($i+1)];
			$eList = $_POST['RebateFG'.($i+1)];
			if ($aList > 100) exit(back(' 退水最高不超过：100'));
			if ($bList > 100) exit(back(' 退水最高不超过：100'));
			if ($cList > 100) exit(back(' 退水最高不超过：100'));

        	if ($aList > $LdetList[$i][3])
			{
				//取A盘
				$LdetList[$i][3] = $aList;
				updateTuiShui ($db, $LdetList[$i], $usersModel, 'a', $aList);
			} 
			if ($bList > $LdetList[$i][4])
			{
				//取B盘
				$LdetList[$i][4] = $bList;
				updateTuiShui ($db, $LdetList[$i], $usersModel, 'b', $bList);
			} 
			if ($cList > $LdetList[$i][5])
			{
				//取C盘
				$LdetList[$i][5] = $cList;
				updateTuiShui ($db, $LdetList[$i], $usersModel, 'c', $cList);
			}
			
			//修改退水
			$sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetList[$i][2]}' AND g_game_id = '{$LdetList[$i][8]}' LIMIT 1";
			$db->query($sql, 2);
			
		}
		
		
		
		//重庆
			$LdetListc = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id` 
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' and g_game_id = '2'  ORDER BY g_id DESC", 0);
		
		//dump($LdetListc);
		
	     for ($i=0; $i<count($LdetListc); $i++) {
			$aList = $_POST['RebateAC'.($i+1)];
			$bList = $_POST['RebateBC'.($i+1)];
			$cList = $_POST['RebateCC'.($i+1)];
			$dList = $_POST['RebateEC'.($i+1)];
			$eList = $_POST['RebateFC'.($i+1)];
			if ($aList > 100) exit(back(' 退水最高不超过：100'));
			if ($bList > 100) exit(back(' 退水最高不超过：100'));
			if ($cList > 100) exit(back(' 退水最高不超过：100'));

        	if ($aList > $LdetListc[$i][3])
			{
				//取A盘
				$LdetListc[$i][3] = $aList;
				updateTuiShui ($db, $LdetListc[$i], $usersModel, 'a', $aList);
			} 
			if ($bList > $LdetListc[$i][4])
			{
				//取B盘
				$LdetListc[$i][4] = $bList;
				updateTuiShui ($db, $LdetListc[$i], $usersModel, 'b', $bList);
			} 
			if ($cList > $LdetListc[$i][5])
			{
				//取C盘
				$LdetListc[$i][5] = $cList;
				updateTuiShui ($db, $LdetListc[$i], $usersModel, 'c', $cList);
			}
			
			//修改退水
			$sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetListc[$i][2]}' AND g_game_id = '{$LdetListc[$i][8]}' LIMIT 1";
			$db->query($sql, 2);
			
		}
		//江西
			$LdetList_jx = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id` 
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' and g_game_id = '10'  ORDER BY g_id DESC", 0);
		
		//dump($LdetListc);
		
	     for ($i=0; $i<count($LdetList_jx); $i++) {
			$aList = $_POST['RebateAJX'.($i+1)];
			$bList = $_POST['RebateBJX'.($i+1)];
			$cList = $_POST['RebateCJX'.($i+1)];
			$dList = $_POST['RebateEJX'.($i+1)];
			$eList = $_POST['RebateFJX'.($i+1)];
			if ($aList > 100) exit(back(' 退水最高不超过：100'));
			if ($bList > 100) exit(back(' 退水最高不超过：100'));
			if ($cList > 100) exit(back(' 退水最高不超过：100'));

        	if ($aList > $LdetList_jx[$i][3])
			{
				//取A盘
				$LdetList_jx[$i][3] = $aList;
				updateTuiShui ($db, $LdetList_jx[$i], $usersModel, 'a', $aList);
			} 
			if ($bList > $LdetList_jx[$i][4])
			{
				//取B盘
				$LdetList_jx[$i][4] = $bList;
				updateTuiShui ($db, $LdetList_jx[$i], $usersModel, 'b', $bList);
			} 
			if ($cList > $LdetList_jx[$i][5])
			{
				//取C盘
				$LdetList_jx[$i][5] = $cList;
				updateTuiShui ($db, $LdetList_jx[$i], $usersModel, 'c', $cList);
			}
			
			//修改退水
			$sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetList_jx[$i][2]}' AND g_game_id = '{$LdetList_jx[$i][8]}' LIMIT 1";
			$db->query($sql, 2);
			
		}
		//新疆
			$LdetList_xj = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id` 
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' and g_game_id = '3'  ORDER BY g_id DESC", 0);
		
		//dump($LdetListc);
		
	     for ($i=0; $i<count($LdetList_xj); $i++) {
			$aList = $_POST['RebateAXJ'.($i+1)];
			$bList = $_POST['RebateBXJ'.($i+1)];
			$cList = $_POST['RebateCXJ'.($i+1)];
			$dList = $_POST['RebateEXJ'.($i+1)];
			$eList = $_POST['RebateFXJ'.($i+1)];
			if ($aList > 100) exit(back(' 退水最高不超过：100'));
			if ($bList > 100) exit(back(' 退水最高不超过：100'));
			if ($cList > 100) exit(back(' 退水最高不超过：100'));

        	if ($aList > $LdetList_xj[$i][3])
			{
				//取A盘
				$LdetList_xj[$i][3] = $aList;
				updateTuiShui ($db, $LdetList_xj[$i], $usersModel, 'a', $aList);
			} 
			if ($bList > $LdetList_xj[$i][4])
			{
				//取B盘
				$LdetList_xj[$i][4] = $bList;
				updateTuiShui ($db, $LdetList_xj[$i], $usersModel, 'b', $bList);
			} 
			if ($cList > $LdetList_xj[$i][5])
			{
				//取C盘
				$LdetList_xj[$i][5] = $cList;
				updateTuiShui ($db, $LdetList_xj[$i], $usersModel, 'c', $cList);
			}
			
			//修改退水
			$sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetList_xj[$i][2]}' AND g_game_id = '{$LdetList_xj[$i][8]}' LIMIT 1";
			$db->query($sql, 2);
			
		}
		
		//天津
			$LdetList_tj = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id` 
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' and g_game_id = '11'  ORDER BY g_id DESC", 0);
		
		//dump($LdetListc);
		
	     for ($i=0; $i<count($LdetList_tj); $i++) {
			$aList = $_POST['RebateATJ'.($i+1)];
			$bList = $_POST['RebateBTJ'.($i+1)];
			$cList = $_POST['RebateCTJ'.($i+1)];
			$dList = $_POST['RebateETJ'.($i+1)];
			$eList = $_POST['RebateFTJ'.($i+1)];
			if ($aList > 100) exit(back(' 退水最高不超过：100'));
			if ($bList > 100) exit(back(' 退水最高不超过：100'));
			if ($cList > 100) exit(back(' 退水最高不超过：100'));

        	if ($aList > $LdetList_tj[$i][3])
			{
				//取A盘
				$LdetList_tj[$i][3] = $aList;
				updateTuiShui ($db, $LdetList_tj[$i], $usersModel, 'a', $aList);
			} 
			if ($bList > $LdetList_tj[$i][4])
			{
				//取B盘
				$LdetList_tj[$i][4] = $bList;
				updateTuiShui ($db, $LdetList_tj[$i], $usersModel, 'b', $bList);
			} 
			if ($cList > $LdetList_tj[$i][5])
			{
				//取C盘
				$LdetList_tj[$i][5] = $cList;
				updateTuiShui ($db, $LdetList_tj[$i], $usersModel, 'c', $cList);
			}
			
			//修改退水
			$sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetList_tj[$i][2]}' AND g_game_id = '{$LdetList_tj[$i][8]}' LIMIT 1";
			$db->query($sql, 2);
			
		}
		
		//北京
			$LdetListb = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id` 
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' and g_game_id = '6'  ORDER BY g_id DESC", 0);
		
	//	dump($LdetList);
		
	     for ($i=0; $i<count($LdetListb); $i++) {
			$aList = $_POST['RebateAB'.($i+1)];
			$bList = $_POST['RebateBB'.($i+1)];
			$cList = $_POST['RebateCB'.($i+1)];
			$dList = $_POST['RebateEB'.($i+1)];
			$eList = $_POST['RebateFB'.($i+1)];
			if ($aList > 100) exit(back(' 退水最高不超过：100'));
			if ($bList > 100) exit(back(' 退水最高不超过：100'));
			if ($cList > 100) exit(back(' 退水最高不超过：100'));

        	if ($aList > $LdetListb[$i][3])
			{
				//取A盘
				$LdetListb[$i][3] = $aList;
				updateTuiShui ($db, $LdetListb[$i], $usersModel, 'a', $aList);
			} 
			if ($bList > $LdetListb[$i][4])
			{
				//取B盘
				$LdetListb[$i][4] = $bList;
				updateTuiShui ($db, $LdetListb[$i], $usersModel, 'b', $bList);
			} 
			if ($cList > $LdetListb[$i][5])
			{
				//取C盘
				$LdetListb[$i][5] = $cList;
				updateTuiShui ($db, $LdetListb[$i], $usersModel, 'c', $cList);
			}
			
			//修改退水
			$sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetListb[$i][2]}' AND g_game_id = '{$LdetListb[$i][8]}' LIMIT 1";
			$db->query($sql, 2);
			
		}
		//极速赛车
			$LdetList_ft = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id` 
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' and g_game_id = '4'  ORDER BY g_id DESC", 0);
		
	//	dump($LdetList);
		
	     for ($i=0; $i<count($LdetList_ft); $i++) {
			$aList = $_POST['RebateAFT'.($i+1)];
			$bList = $_POST['RebateBFT'.($i+1)];
			$cList = $_POST['RebateCFT'.($i+1)];
			$dList = $_POST['RebateEFT'.($i+1)];
			$eList = $_POST['RebateFFT'.($i+1)];
			if ($aList > 100) exit(back(' 退水最高不超过：100'));
			if ($bList > 100) exit(back(' 退水最高不超过：100'));
			if ($cList > 100) exit(back(' 退水最高不超过：100'));

        	if ($aList > $LdetList_ft[$i][3])
			{
				//取A盘
				$LdetList_ft[$i][3] = $aList;
				updateTuiShui ($db, $LdetList_ft[$i], $usersModel, 'a', $aList);
			} 
			if ($bList > $LdetList_ft[$i][4])
			{
				//取B盘
				$LdetList_ft[$i][4] = $bList;
				updateTuiShui ($db, $LdetList_ft[$i], $usersModel, 'b', $bList);
			} 
			if ($cList > $LdetList_ft[$i][5])
			{
				//取C盘
				$LdetList_ft[$i][5] = $cList;
				updateTuiShui ($db, $LdetList_ft[$i], $usersModel, 'c', $cList);
			}
			
			//修改退水
			$sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetList_ft[$i][2]}' AND g_game_id = '{$LdetList_ft[$i][8]}' LIMIT 1";
			$db->query($sql, 2);
			
		}
		
		//吉林	
		$LdetListj = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id` 
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' and g_game_id = '7'  ORDER BY g_id DESC", 0);

	     for ($i=0; $i<count($LdetListj); $i++) {
			$aList = $_POST['RebateAJ'.($i+1)];
			$bList = $_POST['RebateBJ'.($i+1)];
			$cList = $_POST['RebateCJ'.($i+1)];
			$dList = $_POST['RebateEJ'.($i+1)];
			$eList = $_POST['RebateFJ'.($i+1)];
			if ($aList > 100) exit(back(' 退水最高不超过：100'));
			if ($bList > 100) exit(back(' 退水最高不超过：100'));
			if ($cList > 100) exit(back(' 退水最高不超过：100'));

        	if ($aList > $LdetListj[$i][3])
			{
				//取A盘
				$LdetListj[$i][3] = $aList;
				updateTuiShui ($db, $LdetListj[$i], $usersModel, 'a', $aList);
			} 
			if ($bList > $LdetListj[$i][4])
			{
				//取B盘
				$LdetListj[$i][4] = $bList;
				updateTuiShui ($db, $LdetListj[$i], $usersModel, 'b', $bList);
			} 
			if ($cList > $LdetListj[$i][5])
			{
				//取C盘
				$LdetListj[$i][5] = $cList;
				updateTuiShui ($db, $LdetListj[$i], $usersModel, 'c', $cList);
			}
			
			//修改退水
			$sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetListj[$i][2]}' AND g_game_id = '{$LdetListj[$i][8]}' LIMIT 1";
			$db->query($sql, 2);
			
		}
		//快樂8
		//吉林	
		$LdetListj = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id` 
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' and g_game_id = '8'  ORDER BY g_id DESC", 0);

	     for ($i=0; $i<count($LdetListj); $i++) {
			$aList = $_POST['RebateAK'.($i+1)];
			$bList = $_POST['RebateBK'.($i+1)];
			$cList = $_POST['RebateCK'.($i+1)];
			$dList = $_POST['RebateEK'.($i+1)];
			$eList = $_POST['RebateFK'.($i+1)];
			if ($aList > 100) exit(back(' 退水最高不超过：100'));
			if ($bList > 100) exit(back(' 退水最高不超过：100'));
			if ($cList > 100) exit(back(' 退水最高不超过：100'));

        	if ($aList > $LdetListj[$i][3])
			{
				//取A盘
				$LdetListj[$i][3] = $aList;
				updateTuiShui ($db, $LdetListj[$i], $usersModel, 'a', $aList);
			} 
			if ($bList > $LdetListj[$i][4])
			{
				//取B盘
				$LdetListj[$i][4] = $bList;
				updateTuiShui ($db, $LdetListj[$i], $usersModel, 'b', $bList);
			} 
			if ($cList > $LdetListj[$i][5])
			{
				//取C盘
				$LdetListj[$i][5] = $cList;
				updateTuiShui ($db, $LdetListj[$i], $usersModel, 'c', $cList);
			}
			
			//修改退水
			$sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetListj[$i][2]}' AND g_game_id = '{$LdetListj[$i][8]}' LIMIT 1";
			$db->query($sql, 2);
			
		}
		exit(alert_href('更變成功', 'Actfor.php?cid='.$_GET['cid']));
	}
	else 
	{
		exit(alert_href('用戶不存在', 'Actfor.php?cid='.$_GET['cid']));
	}
}
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['uid']) && isset($_GET['cid']))
{
	if (!Matchs::isString($_GET['uid'], 3, 15)) exit(alert_href('用戶名不合法', 'Actfor.php?cid='.$_GET['cid']));
	$cid = $_GET['cid'];
	$uid = $_GET['uid'];
	
	$user = $userModel->GetUserModel(null, $uid);
	//$count = $userModel->SumCount($user[0]['g_nid'].UserModel::Like());
	$dateTime = date('Y-m-d H:i:s');
	$a = day();
	$stratGame = $a[0];
	$endGame = $a[1];
	$date = " `g_date` > '{$stratGame}' AND `g_date` < '{$endGame}' ";
	$db = new DB();
	if (!$db->query("SELECT g_id FROM g_zhudan WHERE {$date} AND g_s_nid LIKE '{$user[0]['g_nid']}%' LIMIT 1", 0)){
		$count = 0;
	} else {
		$count = 1;
	}
    $Lname = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-32);
	$Lname = $userModel->GetUserName_Like($Lname);
	//dump($Lname[0]['g_name']);
	//讀取退水
	
	
	$result = $userModel->GetUserMR($uid);
	$resultC = $userModel->GetUserMRC($uid);
	$resultP = $userModel->GetUserMRP($uid);
	$resultJ = $userModel->GetUserMRJ($uid);
	$resultK = $userModel->GetUserMRK($uid);
	$result_jx = $userModel->GetUserMRid($uid,3);
	$result_xj = $userModel->GetUserMRid($uid,10);
	$result_tj = $userModel->GetUserMRid($uid,11);
	$result_ft = $userModel->GetUserMRid($uid,4);
	$result_nc = $userModel->GetUserMRid($uid,9);

	if ($user[0]['g_login_id']==56){
	$resultsj=$userModel->GetUserMRSJAll(1);
	$resultsjC=$userModel->GetUserMRSJ(2);
	$resultsjP=$userModel->GetUserMRSJ(6);
	$resultsjJ=$userModel->GetUserMRSJ(7);
	$resultsjK=$userModel->GetUserMRSJ(8);
	$resultsj_jx = $userModel->GetUserMRSJ(3);
	$resultsj_xj = $userModel->GetUserMRSJ(10);
	$resultsj_tj = $userModel->GetUserMRSJ(11);
	$resultsj_ft = $userModel->GetUserMRSJ(4);
	$resultsj_nc = $userModel->GetUserMRSJ(9);
	}else{
	
	$Lname = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-32);
	$Lname = $userModel->GetUserName_Like($Lname);
	$sjuid=$Lname[0]['g_name'];
	
	$resultsj = $userModel->GetUserMR($sjuid);
	$resultsjC = $userModel->GetUserMRC($sjuid);
	$resultsjP = $userModel->GetUserMRP($sjuid);
	$resultsjJ = $userModel->GetUserMRJ($sjuid);
	$resultsjK = $userModel->GetUserMRK($sjuid);
	$resultsj_jx = $userModel->GetUserMRid($uid,3);
	$resultsj_xj = $userModel->GetUserMRid($uid,10);
	$resultsj_tj = $userModel->GetUserMRid($uid,11);
	$resultsj_ft = $userModel->GetUserMRid($uid,4);
	$resultsj_nc = $userModel->GetUserMRid($uid,9);
	}
	//dump($resultsjJ);
	if (!$result)exit(alert_href('無法讀取退水設置！請于上級聯繫', "Actfor.php?cid={$cid}"));
}

function updateTuiShui ($db, $LdetList, $usersModel, $p, $param){
	if ($usersModel[0]['g_login_id'] != 48) {
		$sql = "SELECT `g_name` FROM g_rank WHERE g_nid LIKE '{$usersModel[0]['g_nid']}%'";
		$result = $db->query($sql, 1);
		if ($result) {
			for ($i=0; $i<count($result); $i++){
				$sql = "UPDATE `g_send_back` SET g_a_limit='{$LdetList[3]}', g_b_limit='{$LdetList[4]}', g_c_limit='{$LdetList[5]}'
				WHERE g_name = '{$result[$i]['g_name']}' 
				AND  g_type='{$LdetList[2]}'
				AND g_game_id = '{$LdetList[8]}' 
				AND (g_a_limit < '{$LdetList[3]}' OR g_b_limit <'{$LdetList[4]}' OR g_c_limit <'{$LdetList[5]}') LIMIT 1 ";
				$db->query($sql, 2);
			}
		}
	}
	
	$sql = "SELECT u.g_name, p.* FROM `g_user` AS u 
				INNER JOIN g_panbiao as p ON u.g_name = p.g_nid
				WHERE u.g_nid LIKE '{$usersModel[0]['g_nid']}%'
				AND p.g_game_id = '{$LdetList[8]}' 
				AND p.g_type = '{$LdetList[2]}' AND u.g_panlu = '{$p}'";
	$result = $db->query($sql, 1);
	
	if ($result) {
		for ($i=0; $i<count($result); $i++){
		if($p=="a"){
		$parm="g_panlu_a";
		}
		if($p=="b"){
		$parm="g_panlu_b";
		}
		if($p=="c"){
		$parm="g_panlu_c";
		}
			$sql = "UPDATE `g_panbiao` SET {$parm}='{$param}' WHERE g_nid = '{$result[$i]['g_name']}' 
			AND  g_type='{$LdetList[2]}'
			AND g_game_id = '{$LdetList[8]}' LIMIT 1 ";
			$db->query($sql, 2);
		}
	}
}

cPos("后台-代理退水设置".$uid);
//print_r($result);
?><!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/Css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
-->

<html>
<head><title>

</title><link href="/Css/Common.css" rel="stylesheet" type="text/css" /><link href="/Css/Style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Scripts/Jquery.js"></script>
<script type="text/javascript" src="/Scripts/Common.js"></script>

<script type="text/javascript" src="/Scripts/PublicData.js"></script>
<script type="text/javascript" src="/Scripts/Forbid.js"></script>
<script type="text/javascript">
<!--
    $(function(){
        $("#TS1_A1").val($("#RebateAG1").val());
        $("#TS1_A2").val($("#RebateBG1").val());
        $("#TS1_A3").val($("#RebateCG1").val());
        $("#TS1_A4").val($("#RebateEG1").val());
        $("#TS1_A5").val($("#RebateFG1").val());

        $("#TS2_A1").val($("#RebateAG9").val());
        $("#TS2_A2").val($("#RebateBG9").val());
        $("#TS2_A3").val($("#RebateCG9").val());
        $("#TS2_A4").val($("#RebateEG9").val());
        $("#TS2_A5").val($("#RebateFG9").val());

        $("#TS3_A1").val($("#RebateAG19").val());
        $("#TS3_A2").val($("#RebateBG19").val());
        $("#TS3_A3").val($("#RebateCG19").val());
        $("#TS3_A4").val($("#RebateEG19").val());
        $("#TS3_A5").val($("#RebateFG19").val());
        
    });
    function isCompare(obj, s, v, sint, className) {
        var sR = document.getElementById("s" + obj.id).value;
        if (!Base.patrn.Decimal.exec(obj.value) || parseFloat(obj.value) < parseFloat(sR)) {
            $(".input2").attr("disabled", "disabled");
            alert(s + " " + v + " 限制退水設置：" + sR);
            obj.focus();
            return false;
        } else if (parseFloat(obj.value) > 100) {
            $(".input2").attr("disabled", "disabled");
            alert(s + " " + v + " 退水設置已超出限定：100%");
            obj.focus();
            return false;
        } else {
            $(".input2").attr("disabled", "");
        }
        if (sint != undefined && className != undefined) {
            if (sint == 1) {
                $("." + className).val(obj.value);
            } 
        }
    }

    function isCompares(obj, s, v, sint, className) {
        var sR = document.getElementById("s" + obj.id).value;
        if (!Base.patrn.Decimal.exec(obj.value) || parseFloat(obj.value) > parseFloat(sR)) {
            $(".input2").attr("disabled", "disabled");
            alert(s + " " + v + " 設置最大值：" + sR);
            obj.focus();
            return false;
        } else {
            $(".input2").attr("disabled", "");
        }
        if (sint == 1) {
            $("." + className).val(obj.value);
        }
    }

    function showTD(strID, classID) {
        $("."+classID).css("display", "none");
        $("#"+strID).css("display", "");
    }

    function isMethod() {
        if (confirm("確定更改退水設置嗎？")) {
            $("#submit").attr("disabled","disabled");
            return true;
        }
        return false;
    }
    function Comparec() {
        var A = parseFloat($("#TS3_A1").val());
        var B = parseFloat($("#TS3_A2").val());
        var C = parseFloat($("#TS3_A3").val());
        var E = parseInt($("#TS3_A4").val());
        var F = parseInt($("#TS3_A5").val());
        for (var i = 1; i <= 26; i++) {
            if (i == 3 || i == 5|| i==6 || i==7 ) {
                $("#RebateAJ"+i).val(A > parseFloat($("#sRebateAJ"+i).val()) ? A : $("#sRebateAJ"+i).val()).addClass("inp1m");
                $("#RebateBJ"+i).val(B > parseFloat($("#sRebateBJ"+i).val()) ? B : $("#sRebateBJ"+i).val()).addClass("inp1m");
                $("#RebateCJ"+i).val(C > parseFloat($("#sRebateCJ"+i).val()) ? C : $("#sRebateCJ"+i).val()).addClass("inp1m");
                $("#RebateEJ"+i).val(E < parseFloat($("#sRebateEJ"+i).val()) ? E : $("#sRebateEJ"+i).val()).addClass("inp1m");
                $("#RebateFJ"+i).val(F < parseFloat($("#sRebateFJ"+i).val()) ? F : $("#sRebateFJ"+i).val()).addClass("inp1m");
            } else if (i >= 19) {
                $("#RebateAG"+i).val(A > parseFloat($("#sRebateAG"+i).val()) ? A : $("#sRebateAG"+i).val()).addClass("inp1m");
                $("#RebateBG"+i).val(B > parseFloat($("#sRebateBG"+i).val()) ? B : $("#sRebateBG"+i).val()).addClass("inp1m");
                $("#RebateCG"+i).val(C > parseFloat($("#sRebateCG"+i).val()) ? C : $("#sRebateCG"+i).val()).addClass("inp1m");
                $("#RebateEG"+i).val(E < parseFloat($("#sRebateEG"+i).val()) ? E : $("#sRebateEG"+i).val()).addClass("inp1m");
                $("#RebateFG"+i).val(F < parseFloat($("#sRebateFG"+i).val()) ? F : $("#sRebateFG"+i).val()).addClass("inp1m");
				
				$("#RebateANC"+i).val(A > parseFloat($("#sRebateANC"+i).val()) ? A : $("#sRebateANC"+i).val()).addClass("inp1m");
                $("#RebateBNC"+i).val(B > parseFloat($("#sRebateBNC"+i).val()) ? B : $("#sRebateBNC"+i).val()).addClass("inp1m");
                $("#RebateCNC"+i).val(C > parseFloat($("#sRebateCNC"+i).val()) ? C : $("#sRebateCNC"+i).val()).addClass("inp1m");
                $("#RebateENC"+i).val(E < parseFloat($("#sRebateENC"+i).val()) ? E : $("#sRebateENC"+i).val()).addClass("inp1m");
                $("#RebateFNC"+i).val(F < parseFloat($("#sRebateFNC"+i).val()) ? F : $("#sRebateFNC"+i).val()).addClass("inp1m");
            }
        }
    }
    function Compareb() {
        var A = parseFloat($("#TS2_A1").val());
        var B = parseFloat($("#TS2_A2").val());
        var C = parseFloat($("#TS2_A3").val());
        var E = parseInt($("#TS2_A4").val());
        var F = parseInt($("#TS2_A5").val());
        for (var i = 1; i <= 18; i++) {
            if (i == 1 || i == 2) {
                $("#RebateAJ"+i).val(A > parseFloat($("#sRebateAJ"+i).val()) ? A : $("#sRebateAJ"+i).val()).addClass("inp1m");
                $("#RebateBJ"+i).val(B > parseFloat($("#sRebateBJ"+i).val()) ? B : $("#sRebateBJ"+i).val()).addClass("inp1m");
                $("#RebateCJ"+i).val(C > parseFloat($("#sRebateCJ"+i).val()) ? C : $("#sRebateCJ"+i).val()).addClass("inp1m");
                $("#RebateEJ"+i).val(E < parseFloat($("#sRebateEJ"+i).val()) ? E : $("#sRebateEJ"+i).val()).addClass("inp1m");
                $("#RebateFJ"+i).val(F < parseFloat($("#sRebateFJ"+i).val()) ? F : $("#sRebateFJ"+i).val()).addClass("inp1m");
            }
            if (i == 11 || i == 12 || i == 13 || i == 14 || i == 15) {
                $("#RebateAB"+i).val(A > parseFloat($("#sRebateAB"+i).val()) ? A : $("#sRebateAB"+i).val()).addClass("inp1m");
                $("#RebateBB"+i).val(B > parseFloat($("#sRebateBB"+i).val()) ? B : $("#sRebateBB"+i).val()).addClass("inp1m");
                $("#RebateCB"+i).val(C > parseFloat($("#sRebateCB"+i).val()) ? C : $("#sRebateCB"+i).val()).addClass("inp1m");
                $("#RebateEB"+i).val(E < parseFloat($("#sRebateEB"+i).val()) ? E : $("#sRebateEB"+i).val()).addClass("inp1m");
                $("#RebateFB"+i).val(F < parseFloat($("#sRebateFB"+i).val()) ? F : $("#sRebateFB"+i).val()).addClass("inp1m");
            }
            if (i >= 6 && i <= 8) {
                $("#RebateAC"+i).val(A > parseFloat($("#sRebateAC"+i).val()) ? A : $("#sRebateAC"+i).val()).addClass("inp1m");
                $("#RebateBC"+i).val(B > parseFloat($("#sRebateBC"+i).val()) ? B : $("#sRebateBC"+i).val()).addClass("inp1m");
                $("#RebateCC"+i).val(C > parseFloat($("#sRebateCC"+i).val()) ? C : $("#sRebateCC"+i).val()).addClass("inp1m");
                $("#RebateEC"+i).val(E < parseFloat($("#sRebateEC"+i).val()) ? E : $("#sRebateEC"+i).val()).addClass("inp1m");
                $("#RebateFC"+i).val(F < parseFloat($("#sRebateFC"+i).val()) ? F : $("#sRebateFC"+i).val()).addClass("inp1m");
				
				$("#RebateAJX"+i).val(A > parseFloat($("#sRebateAJX"+i).val()) ? A : $("#sRebateAJX"+i).val()).addClass("inp1m");
                $("#RebateBJX"+i).val(B > parseFloat($("#sRebateBJX"+i).val()) ? B : $("#sRebateBJX"+i).val()).addClass("inp1m");
                $("#RebateCJX"+i).val(C > parseFloat($("#sRebateCJX"+i).val()) ? C : $("#sRebateCJX"+i).val()).addClass("inp1m");
                $("#RebateEJX"+i).val(E < parseFloat($("#sRebateEJX"+i).val()) ? E : $("#sRebateEJX"+i).val()).addClass("inp1m");
                $("#RebateFJX"+i).val(F < parseFloat($("#sRebateFJX"+i).val()) ? F : $("#sRebateFJX"+i).val()).addClass("inp1m");
				
				$("#RebateAXJ"+i).val(A > parseFloat($("#sRebateAXJ"+i).val()) ? A : $("#sRebateAXJ"+i).val()).addClass("inp1m");
                $("#RebateBXJ"+i).val(B > parseFloat($("#sRebateBXJ"+i).val()) ? B : $("#sRebateBXJ"+i).val()).addClass("inp1m");
                $("#RebateCXJ"+i).val(C > parseFloat($("#sRebateCXJ"+i).val()) ? C : $("#sRebateCXJ"+i).val()).addClass("inp1m");
                $("#RebateEXJ"+i).val(E < parseFloat($("#sRebateEXJ"+i).val()) ? E : $("#sRebateEXJ"+i).val()).addClass("inp1m");
                $("#RebateFXJ"+i).val(F < parseFloat($("#sRebateFXJ"+i).val()) ? F : $("#sRebateFXJ"+i).val()).addClass("inp1m");
				
				$("#RebateATJ"+i).val(A > parseFloat($("#sRebateATJ"+i).val()) ? A : $("#sRebateATJ"+i).val()).addClass("inp1m");
                $("#RebateBTJ"+i).val(B > parseFloat($("#sRebateBTJ"+i).val()) ? B : $("#sRebateBTJ"+i).val()).addClass("inp1m");
                $("#RebateCTJ"+i).val(C > parseFloat($("#sRebateCTJ"+i).val()) ? C : $("#sRebateCTJ"+i).val()).addClass("inp1m");
                $("#RebateETJ"+i).val(E < parseFloat($("#sRebateETJ"+i).val()) ? E : $("#sRebateETJ"+i).val()).addClass("inp1m");
                $("#RebateFTJ"+i).val(F < parseFloat($("#sRebateFTJ"+i).val()) ? F : $("#sRebateFTJ"+i).val()).addClass("inp1m");
            }else if (i >= 9 && i <= 12 || i >= 15 && i <= 18) {
                $("#RebateAG"+i).val(A > parseFloat($("#sRebateAG"+i).val()) ? A : $("#sRebateAG"+i).val()).addClass("inp1m");
                $("#RebateBG"+i).val(B > parseFloat($("#sRebateBG"+i).val()) ? B : $("#sRebateBG"+i).val()).addClass("inp1m");
                $("#RebateCG"+i).val(C > parseFloat($("#sRebateCG"+i).val()) ? C : $("#sRebateCG"+i).val()).addClass("inp1m");
                $("#RebateEG"+i).val(E < parseFloat($("#sRebateEG"+i).val()) ? E : $("#sRebateEG"+i).val()).addClass("inp1m");
                $("#RebateFG"+i).val(F < parseFloat($("#sRebateFG"+i).val()) ? F : $("#sRebateFG"+i).val()).addClass("inp1m");
				
				$("#RebateANC"+i).val(A > parseFloat($("#sRebateANC"+i).val()) ? A : $("#sRebateANC"+i).val()).addClass("inp1m");
                $("#RebateBNC"+i).val(B > parseFloat($("#sRebateBNC"+i).val()) ? B : $("#sRebateBNC"+i).val()).addClass("inp1m");
                $("#RebateCNC"+i).val(C > parseFloat($("#sRebateCNC"+i).val()) ? C : $("#sRebateCNC"+i).val()).addClass("inp1m");
                $("#RebateENC"+i).val(E < parseFloat($("#sRebateENC"+i).val()) ? E : $("#sRebateENC"+i).val()).addClass("inp1m");
                $("#RebateFNC"+i).val(F < parseFloat($("#sRebateFNC"+i).val()) ? F : $("#sRebateFNC"+i).val()).addClass("inp1m");
                if ( i== 9 || i == 10) {
                    $("#RebateAC"+i).val(A > parseFloat($("#sRebateAC"+i).val()) ? A : $("#sRebateAC"+i).val()).addClass("inp1m");
                    $("#RebateBC"+i).val(B > parseFloat($("#sRebateBC"+i).val()) ? B : $("#sRebateBC"+i).val()).addClass("inp1m");
                    $("#RebateCC"+i).val(C > parseFloat($("#sRebateCC"+i).val()) ? C : $("#sRebateCC"+i).val()).addClass("inp1m");
                    $("#RebateEC"+i).val(E < parseFloat($("#sRebateEC"+i).val()) ? E : $("#sRebateEC"+i).val()).addClass("inp1m");
                    $("#RebateFC"+i).val(F < parseFloat($("#sRebateFC"+i).val()) ? F : $("#sRebateFC"+i).val()).addClass("inp1m");
					
					$("#RebateAJX"+i).val(A > parseFloat($("#sRebateAJX"+i).val()) ? A : $("#sRebateAJX"+i).val()).addClass("inp1m");
                    $("#RebateBJX"+i).val(B > parseFloat($("#sRebateBJX"+i).val()) ? B : $("#sRebateBJX"+i).val()).addClass("inp1m");
                    $("#RebateCJX"+i).val(C > parseFloat($("#sRebateCJX"+i).val()) ? C : $("#sRebateCJX"+i).val()).addClass("inp1m");
                    $("#RebateEJX"+i).val(E < parseFloat($("#sRebateEJX"+i).val()) ? E : $("#sRebateEJX"+i).val()).addClass("inp1m");
                    $("#RebateFJX"+i).val(F < parseFloat($("#sRebateFJX"+i).val()) ? F : $("#sRebateFJX"+i).val()).addClass("inp1m");
					
					$("#RebateAXJ"+i).val(A > parseFloat($("#sRebateAXJ"+i).val()) ? A : $("#sRebateAXJ"+i).val()).addClass("inp1m");
                    $("#RebateBXJ"+i).val(B > parseFloat($("#sRebateBXJ"+i).val()) ? B : $("#sRebateBXJ"+i).val()).addClass("inp1m");
                    $("#RebateCXJ"+i).val(C > parseFloat($("#sRebateCXJ"+i).val()) ? C : $("#sRebateCXJ"+i).val()).addClass("inp1m");
                    $("#RebateEXJ"+i).val(E < parseFloat($("#sRebateEXJ"+i).val()) ? E : $("#sRebateEXJ"+i).val()).addClass("inp1m");
                    $("#RebateFXJ"+i).val(F < parseFloat($("#sRebateFXJ"+i).val()) ? F : $("#sRebateFXJ"+i).val()).addClass("inp1m");
					
					$("#RebateATJ"+i).val(A > parseFloat($("#sRebateATJ"+i).val()) ? A : $("#sRebateATJ"+i).val()).addClass("inp1m");
                    $("#RebateBTJ"+i).val(B > parseFloat($("#sRebateBTJ"+i).val()) ? B : $("#sRebateBTJ"+i).val()).addClass("inp1m");
                    $("#RebateCTJ"+i).val(C > parseFloat($("#sRebateCTJ"+i).val()) ? C : $("#sRebateCTJ"+i).val()).addClass("inp1m");
                    $("#RebateETJ"+i).val(E < parseFloat($("#sRebateETJ"+i).val()) ? E : $("#sRebateETJ"+i).val()).addClass("inp1m");
                    $("#RebateFTJ"+i).val(F < parseFloat($("#sRebateFTJ"+i).val()) ? F : $("#sRebateFTJ"+i).val()).addClass("inp1m");
                }
            }
        }
		$("#RebateAK2").val(A > parseFloat($("#sRebateAK2").val()) ? A : $("#sRebateAK2").val()).addClass("inp1m");
        $("#RebateBK2").val(B > parseFloat($("#sRebateBK2").val()) ? B : $("#sRebateBK2").val()).addClass("inp1m");
        $("#RebateCK2").val(C > parseFloat($("#sRebateCK2").val()) ? C : $("#sRebateCK2").val()).addClass("inp1m");
        $("#RebateEK2").val(E < parseFloat($("#sRebateEK2").val()) ? E : $("#sRebateEK2").val()).addClass("inp1m");
		$("#RebateFK2").val(F < parseFloat($("#sRebateFK2").val()) ? F : $("#sRebateFK2").val()).addClass("inp1m");
		$("#RebateAK3").val(A > parseFloat($("#sRebateAK3").val()) ? A : $("#sRebateAK3").val()).addClass("inp1m");
        $("#RebateBK3").val(B > parseFloat($("#sRebateBK3").val()) ? B : $("#sRebateBK3").val()).addClass("inp1m");
        $("#RebateCK3").val(C > parseFloat($("#sRebateCK3").val()) ? C : $("#sRebateCK3").val()).addClass("inp1m");
        $("#RebateEK3").val(E < parseFloat($("#sRebateEK3").val()) ? E : $("#sRebateEK3").val()).addClass("inp1m");
		$("#RebateFK3").val(F < parseFloat($("#sRebateFK3").val()) ? F : $("#sRebateFK3").val()).addClass("inp1m");
		$("#RebateAK6").val(A > parseFloat($("#sRebateAK6").val()) ? A : $("#sRebateAK6").val()).addClass("inp1m");
        $("#RebateBK6").val(B > parseFloat($("#sRebateBK6").val()) ? B : $("#sRebateBK6").val()).addClass("inp1m");
        $("#RebateCK6").val(C > parseFloat($("#sRebateCK6").val()) ? C : $("#sRebateCK6").val()).addClass("inp1m");
        $("#RebateEK6").val(E < parseFloat($("#sRebateEK6").val()) ? E : $("#sRebateEK6").val()).addClass("inp1m");
		$("#RebateFK6").val(F < parseFloat($("#sRebateFK6").val()) ? F : $("#sRebateFK6").val()).addClass("inp1m");
		$("#RebateAK7").val(A > parseFloat($("#sRebateAK7").val()) ? A : $("#sRebateAK7").val()).addClass("inp1m");
        $("#RebateBK7").val(B > parseFloat($("#sRebateBK7").val()) ? B : $("#sRebateBK7").val()).addClass("inp1m");
        $("#RebateCK7").val(C > parseFloat($("#sRebateCK7").val()) ? C : $("#sRebateCK7").val()).addClass("inp1m");
        $("#RebateEK7").val(E < parseFloat($("#sRebateEK7").val()) ? E : $("#sRebateEK7").val()).addClass("inp1m");
		$("#RebateFK7").val(F < parseFloat($("#sRebateFK7").val()) ? F : $("#sRebateFK7").val()).addClass("inp1m");
    }

    function Comparer() {
        var A = parseFloat($("#TS1_A1").val());
        var B = parseFloat($("#TS1_A2").val());
        var C = parseFloat($("#TS1_A3").val());
        var E = parseInt($("#TS1_A4").val());
        var F = parseInt($("#TS1_A5").val());
        for (var i = 1; i <= 10; i++) {
                if (i <= 8) {
                    if (i <= 5) {
                    $("#RebateAC"+i).val(A > parseFloat($("#sRebateAC"+i).val()) ? A : $("#sRebateAC"+i).val()).addClass("inp1m");
                    $("#RebateBC"+i).val(B > parseFloat($("#sRebateBC"+i).val()) ? B : $("#sRebateBC"+i).val()).addClass("inp1m");
                    $("#RebateCC"+i).val(C > parseFloat($("#sRebateCC"+i).val()) ? C : $("#sRebateCC"+i).val()).addClass("inp1m");
                    $("#RebateEC"+i).val(E < parseFloat($("#sRebateEC"+i).val()) ? E : $("#sRebateEC"+i).val()).addClass("inp1m");
                    $("#RebateFC"+i).val(F < parseFloat($("#sRebateFC"+i).val()) ? F : $("#sRebateFC"+i).val()).addClass("inp1m");
					
					$("#RebateAJX"+i).val(A > parseFloat($("#sRebateAJX"+i).val()) ? A : $("#sRebateAJX"+i).val()).addClass("inp1m");
                    $("#RebateBJX"+i).val(B > parseFloat($("#sRebateBJX"+i).val()) ? B : $("#sRebateBJX"+i).val()).addClass("inp1m");
                    $("#RebateCJX"+i).val(C > parseFloat($("#sRebateCJX"+i).val()) ? C : $("#sRebateCJX"+i).val()).addClass("inp1m");
                    $("#RebateEJX"+i).val(E < parseFloat($("#sRebateEJX"+i).val()) ? E : $("#sRebateEJX"+i).val()).addClass("inp1m");
                    $("#RebateFJX"+i).val(F < parseFloat($("#sRebateFJX"+i).val()) ? F : $("#sRebateFJX"+i).val()).addClass("inp1m");
					
					$("#RebateAXJ"+i).val(A > parseFloat($("#sRebateAXJ"+i).val()) ? A : $("#sRebateAXJ"+i).val()).addClass("inp1m");
                    $("#RebateBXJ"+i).val(B > parseFloat($("#sRebateBXJ"+i).val()) ? B : $("#sRebateBXJ"+i).val()).addClass("inp1m");
                    $("#RebateCXJ"+i).val(C > parseFloat($("#sRebateCXJ"+i).val()) ? C : $("#sRebateCXJ"+i).val()).addClass("inp1m");
                    $("#RebateEXJ"+i).val(E < parseFloat($("#sRebateEXJ"+i).val()) ? E : $("#sRebateEXJ"+i).val()).addClass("inp1m");
                    $("#RebateFXJ"+i).val(F < parseFloat($("#sRebateFXJ"+i).val()) ? F : $("#sRebateFXJ"+i).val()).addClass("inp1m");
					
					$("#RebateATJ"+i).val(A > parseFloat($("#sRebateATJ"+i).val()) ? A : $("#sRebateATJ"+i).val()).addClass("inp1m");
                    $("#RebateBTJ"+i).val(B > parseFloat($("#sRebateBTJ"+i).val()) ? B : $("#sRebateBTJ"+i).val()).addClass("inp1m");
                    $("#RebateCTJ"+i).val(C > parseFloat($("#sRebateCTJ"+i).val()) ? C : $("#sRebateCTJ"+i).val()).addClass("inp1m");
                    $("#RebateETJ"+i).val(E < parseFloat($("#sRebateETJ"+i).val()) ? E : $("#sRebateETJ"+i).val()).addClass("inp1m");
                    $("#RebateFTJ"+i).val(F < parseFloat($("#sRebateFTJ"+i).val()) ? F : $("#sRebateFTJ"+i).val()).addClass("inp1m");
                }
                $("#RebateAG"+i).val(A > parseFloat($("#sRebateAG"+i).val()) ? A : $("#sRebateAG"+i).val()).addClass("inp1m");
                $("#RebateBG"+i).val(B > parseFloat($("#sRebateBG"+i).val()) ? B : $("#sRebateBG"+i).val()).addClass("inp1m");
                $("#RebateCG"+i).val(C > parseFloat($("#sRebateCG"+i).val()) ? C : $("#sRebateCG"+i).val()).addClass("inp1m");
                $("#RebateEG"+i).val(E < parseFloat($("#sRebateEG"+i).val()) ? E : $("#sRebateEG"+i).val()).addClass("inp1m");
                $("#RebateFG"+i).val(F < parseFloat($("#sRebateFG"+i).val()) ? F : $("#sRebateFG"+i).val()).addClass("inp1m");
				
				$("#RebateANC"+i).val(A > parseFloat($("#sRebateANC"+i).val()) ? A : $("#sRebateANC"+i).val()).addClass("inp1m");
                $("#RebateBNC"+i).val(B > parseFloat($("#sRebateBNC"+i).val()) ? B : $("#sRebateBNC"+i).val()).addClass("inp1m");
                $("#RebateCNC"+i).val(C > parseFloat($("#sRebateCNC"+i).val()) ? C : $("#sRebateCNC"+i).val()).addClass("inp1m");
                $("#RebateENC"+i).val(E < parseFloat($("#sRebateENC"+i).val()) ? E : $("#sRebateENC"+i).val()).addClass("inp1m");
                $("#RebateFNC"+i).val(F < parseFloat($("#sRebateFNC"+i).val()) ? F : $("#sRebateFNC"+i).val()).addClass("inp1m");
            }
			
            $("#RebateAB"+i).val(A > parseFloat($("#sRebateAB"+i).val()) ? A : $("#sRebateAB"+i).val()).addClass("inp1m");
            $("#RebateBB"+i).val(B > parseFloat($("#sRebateBB"+i).val()) ? B : $("#sRebateBB"+i).val()).addClass("inp1m");
            $("#RebateCB"+i).val(C > parseFloat($("#sRebateCB"+i).val()) ? C : $("#sRebateCB"+i).val()).addClass("inp1m");
            $("#RebateEB"+i).val(E < parseFloat($("#sRebateEB"+i).val()) ? E : $("#sRebateEB"+i).val()).addClass("inp1m");
            $("#RebateFB"+i).val(F < parseFloat($("#sRebateFB"+i).val()) ? F : $("#sRebateFB"+i).val()).addClass("inp1m");
        }
		$("#RebateAG13").val(A > parseFloat($("#sRebateAG13").val()) ? A : $("#sRebateAG13").val()).addClass("inp1m");
		$("#RebateBG13").val(B > parseFloat($("#sRebateBG13").val()) ? B : $("#sRebateBG13").val()).addClass("inp1m");
		$("#RebateCG13").val(C > parseFloat($("#sRebateCG13").val()) ? C : $("#sRebateCG13").val()).addClass("inp1m");
		$("#RebateEG13").val(E < parseFloat($("#sRebateEG13").val()) ? E : $("#sRebateEG13").val()).addClass("inp1m");
		$("#RebateFG13").val(F < parseFloat($("#sRebateFG13").val()) ? F : $("#sRebateFG13").val()).addClass("inp1m");
		
		$("#RebateAG14").val(A > parseFloat($("#sRebateAG14").val()) ? A : $("#sRebateAG14").val()).addClass("inp1m");
		$("#RebateBG14").val(B > parseFloat($("#sRebateBG14").val()) ? B : $("#sRebateBG14").val()).addClass("inp1m");
		$("#RebateCG14").val(C > parseFloat($("#sRebateCG14").val()) ? C : $("#sRebateCG14").val()).addClass("inp1m");
		$("#RebateEG14").val(E < parseFloat($("#sRebateEG14").val()) ? E : $("#sRebateEG14").val()).addClass("inp1m");
		$("#RebateFG14").val(F < parseFloat($("#sRebateFG14").val()) ? F : $("#sRebateFG14").val()).addClass("inp1m");
		for(i=11;i<=13;i++)
		{
			$("#RebateAC"+i).val(A > parseFloat($("#sRebateAC"+i).val()) ? A : $("#sRebateAC"+i).val()).addClass("inp1m");
			$("#RebateBC"+i).val(B > parseFloat($("#sRebateBC"+i).val()) ? B : $("#sRebateBC"+i).val()).addClass("inp1m");
			$("#RebateCC"+i).val(C > parseFloat($("#sRebateCC"+i).val()) ? C : $("#sRebateCC"+i).val()).addClass("inp1m");
			$("#RebateEC"+i).val(E < parseFloat($("#sRebateEC"+i).val()) ? E : $("#sRebateEC"+i).val()).addClass("inp1m");
			$("#RebateFC"+i).val(F < parseFloat($("#sRebateFC"+i).val()) ? F : $("#sRebateFC"+i).val()).addClass("inp1m");
			
			$("#RebateAJX"+i).val(A > parseFloat($("#sRebateAJX"+i).val()) ? A : $("#sRebateAJX"+i).val()).addClass("inp1m");
			$("#RebateBJX"+i).val(B > parseFloat($("#sRebateBJX"+i).val()) ? B : $("#sRebateBJX"+i).val()).addClass("inp1m");
			$("#RebateCJX"+i).val(C > parseFloat($("#sRebateCJX"+i).val()) ? C : $("#sRebateCJX"+i).val()).addClass("inp1m");
			$("#RebateEJX"+i).val(E < parseFloat($("#sRebateEJX"+i).val()) ? E : $("#sRebateEJX"+i).val()).addClass("inp1m");
			$("#RebateFJX"+i).val(F < parseFloat($("#sRebateFJX"+i).val()) ? F : $("#sRebateFJX"+i).val()).addClass("inp1m");
			
			$("#RebateAXJ"+i).val(A > parseFloat($("#sRebateAXJ"+i).val()) ? A : $("#sRebateAXJ"+i).val()).addClass("inp1m");
			$("#RebateBXJ"+i).val(B > parseFloat($("#sRebateBXJ"+i).val()) ? B : $("#sRebateBXJ"+i).val()).addClass("inp1m");
			$("#RebateCXJ"+i).val(C > parseFloat($("#sRebateCXJ"+i).val()) ? C : $("#sRebateCXJ"+i).val()).addClass("inp1m");
			$("#RebateEXJ"+i).val(E < parseFloat($("#sRebateEXJ"+i).val()) ? E : $("#sRebateEXJ"+i).val()).addClass("inp1m");
			$("#RebateFXJ"+i).val(F < parseFloat($("#sRebateFXJ"+i).val()) ? F : $("#sRebateFXJ"+i).val()).addClass("inp1m");
			
			$("#RebateATJ"+i).val(A > parseFloat($("#sRebateATJ"+i).val()) ? A : $("#sRebateATJ"+i).val()).addClass("inp1m");
			$("#RebateBTJ"+i).val(B > parseFloat($("#sRebateBTJ"+i).val()) ? B : $("#sRebateBTJ"+i).val()).addClass("inp1m");
			$("#RebateCTJ"+i).val(C > parseFloat($("#sRebateCTJ"+i).val()) ? C : $("#sRebateCTJ"+i).val()).addClass("inp1m");
			$("#RebateETJ"+i).val(E < parseFloat($("#sRebateETJ"+i).val()) ? E : $("#sRebateETJ"+i).val()).addClass("inp1m");
			$("#RebateFTJ"+i).val(F < parseFloat($("#sRebateFTJ"+i).val()) ? F : $("#sRebateFTJ"+i).val()).addClass("inp1m");	
		}
		$("#RebateAB16").val(A > parseFloat($("#sRebateAB16").val()) ? A : $("#sRebateAB16").val()).addClass("inp1m");
        $("#RebateBB16").val(B > parseFloat($("#sRebateBB16").val()) ? B : $("#sRebateBB16").val()).addClass("inp1m");
        $("#RebateCB16").val(C > parseFloat($("#sRebateCB16").val()) ? C : $("#sRebateCB16").val()).addClass("inp1m");
        $("#RebateEB16").val(E < parseFloat($("#sRebateEB16").val()) ? E : $("#sRebateEB16").val()).addClass("inp1m");
		$("#RebateFB16").val(F < parseFloat($("#sRebateFB16").val()) ? F : $("#sRebateFB16").val()).addClass("inp1m");
		$("#RebateAJ4").val(A > parseFloat($("#sRebateAJ4").val()) ? A : $("#sRebateAJ4").val()).addClass("inp1m");
        $("#RebateBJ4").val(B > parseFloat($("#sRebateBJ4").val()) ? B : $("#sRebateBJ4").val()).addClass("inp1m");
        $("#RebateCJ4").val(C > parseFloat($("#sRebateCJ4").val()) ? C : $("#sRebateCJ4").val()).addClass("inp1m");
        $("#RebateEJ4").val(E < parseFloat($("#sRebateEJ4").val()) ? E : $("#sRebateEJ4").val()).addClass("inp1m");
		$("#RebateFJ4").val(F < parseFloat($("#sRebateFJ4").val()) ? F : $("#sRebateFJ4").val()).addClass("inp1m");
		$("#RebateAK4").val(A > parseFloat($("#sRebateAK4").val()) ? A : $("#sRebateAK4").val()).addClass("inp1m");
        $("#RebateBK4").val(B > parseFloat($("#sRebateBK4").val()) ? B : $("#sRebateBK4").val()).addClass("inp1m");
        $("#RebateCK4").val(C > parseFloat($("#sRebateCK4").val()) ? C : $("#sRebateCK4").val()).addClass("inp1m");
        $("#RebateEK4").val(E < parseFloat($("#sRebateEK4").val()) ? E : $("#sRebateEK4").val()).addClass("inp1m");
		$("#RebateFK4").val(F < parseFloat($("#sRebateFK4").val()) ? F : $("#sRebateFK4").val()).addClass("inp1m");
		$("#RebateAK5").val(A > parseFloat($("#sRebateAK5").val()) ? A : $("#sRebateAK5").val()).addClass("inp1m");
        $("#RebateBK5").val(B > parseFloat($("#sRebateBK5").val()) ? B : $("#sRebateBK5").val()).addClass("inp1m");
        $("#RebateCK5").val(C > parseFloat($("#sRebateCK5").val()) ? C : $("#sRebateCK5").val()).addClass("inp1m");
        $("#RebateEK5").val(E < parseFloat($("#sRebateEK5").val()) ? E : $("#sRebateEK5").val()).addClass("inp1m");
		$("#RebateFK5").val(F < parseFloat($("#sRebateFK5").val()) ? F : $("#sRebateFK5").val()).addClass("inp1m");
		$("#RebateAK8").val(A > parseFloat($("#sRebateAK8").val()) ? A : $("#sRebateAK8").val()).addClass("inp1m");
        $("#RebateBK8").val(B > parseFloat($("#sRebateBK8").val()) ? B : $("#sRebateBK8").val()).addClass("inp1m");
        $("#RebateCK8").val(C > parseFloat($("#sRebateCK8").val()) ? C : $("#sRebateCK8").val()).addClass("inp1m");
        $("#RebateEK8").val(E < parseFloat($("#sRebateEK8").val()) ? E : $("#sRebateEK8").val()).addClass("inp1m");
		$("#RebateFK8").val(F < parseFloat($("#sRebateFK8").val()) ? F : $("#sRebateFK8").val()).addClass("inp1m");
		$("#RebateAK1").val(A > parseFloat($("#sRebateAK1").val()) ? A : $("#sRebateAK1").val()).addClass("inp1m");
        $("#RebateBK1").val(B > parseFloat($("#sRebateBK1").val()) ? B : $("#sRebateBK1").val()).addClass("inp1m");
        $("#RebateCK1").val(C > parseFloat($("#sRebateCK1").val()) ? C : $("#sRebateCK1").val()).addClass("inp1m");
        $("#RebateEK1").val(E < parseFloat($("#sRebateEK1").val()) ? E : $("#sRebateEK1").val()).addClass("inp1m");
		$("#RebateFK1").val(F < parseFloat($("#sRebateFK1").val()) ? F : $("#sRebateFK1").val()).addClass("inp1m");
		
    }
    function historys() {
        location.href = "Users.php?NT=2";
    }
//-->
</script>
</head>
<body onselectstart="return false">
<form action="" method="post" onSubmit="return isMethod()">
<input type="hidden" name="name" value="<?php echo $uid?>" />
<table border="0" cellspacing="0" cellpadding="0" class="Main m_1">
    <tr>
        <td class="Main_top_left"></td>
        <td background="/Css/tab_05.gif">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="20" align="right"><img style="margin-right:5px" src="/Css/tb.gif" width="16" height="16" alt="" /></td>
                    <td id="titleName" class="Main_Title">退水設定 -><?php if ($cid==1){echo "分公司";}else  if ($cid==2){echo "股东";}else  if ($cid==3){echo "總代理";}else {echo "代理";}?>（ &nbsp;&nbsp;&nbsp;<span style="font-weight:normal"><?php echo $uid?></span>&nbsp;&nbsp;&nbsp; ）</td>

                    <td id="F_Name" width="150" align="right"><?php if ($cid==1){echo "分公司";}else  if ($cid==2){echo "股东";}else  if ($cid==3){echo "總代理";}else {echo "代理";}?>名稱：<?php echo $uid?></td>

                </tr>
            </table>
        </td>
        <td class="Main_top_right"></td>
    </tr>
    <tr>
        <td class="Main_left"></td>
        <td class="Main_conter">
        <!-- strat -->
            <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter2 az">
                <tr class="Conter_top_2">
                    <th colspan="7" background="/Css/bg_g.jpg" style="border:none">大項快速設置【注意：設置高於上級最高限制時按最高可調】</th>
                </tr>
                <tr class="Conter_top_2 Ct">
                    <td width="34%"  background="/Css/bg_g.jpg" >調整項目</td>
                    <td width="10%"  background="/Css/bg_g.jpg" >A盤</td>
                    <td width="10%"  background="/Css/bg_g.jpg" >B盤</td>
                    <td width="10%"  background="/Css/bg_g.jpg" >C盤</td>
                    <td  background="/Css/bg_g.jpg" >單註限額</td>
                    <td  background="/Css/bg_g.jpg" >單期限額</td>
                    <td width="80"  background="/Css/bg_g.jpg" >…</td>
                </tr>
                <tr class="Ct" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                    <td class="t_list_tr_1_g">特碼類(第一球、第二球、冠軍 …)</td>
                    <td class="TD_TS1"><input style="width:60px;" id="TS1_A1" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:60px;" id="TS1_A2" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:60px;" id="TS1_A3" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:90px;" id="TS1_A4" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:90px;" id="TS1_A5" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td class="TD_TS1"><input type="button" onMouseOver="this.className='input2_2'" onMouseOut="this.className='input2'" class="input2" onClick="Comparer()" value="修改" /></td>
                </tr>
                <tr class="Ct" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                    <td class="t_list_tr_1_g">兩面類(單雙、大小、龍虎 …)</td>
                    <td class="TD_TS2"><input style="width:60px;" id="TS2_A1" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:60px;" id="TS2_A2" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:60px;" id="TS2_A3" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:90px;" id="TS2_A4" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:90px;" id="TS2_A5" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td class="TD_TS2"><input type="button" name="submit" onMouseOver="this.className='input2_2'" onMouseOut="this.className='input2'" class="input2" onClick="Compareb()" value="修改" /></td>
                </tr>
                <tr class="Ct" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                    <td class="t_list_tr_1_g">連碼類(任選二、任選三 …)</td>
                    <td class="TD_TS3"><input style="width:60px;" id="TS3_A1" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:60px;" id="TS3_A2" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:60px;" id="TS3_A3" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:90px;" id="TS3_A4" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:90px;" id="TS3_A5" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td class="TD_TS3"><input type="button" name="submit" onMouseOver="this.className='input2_2'" onMouseOut="this.className='input2'" class="input2" onClick="Comparec()" value="修改" /></td>
                </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td colspan="2">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">廣東快樂十分</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <td>交易類型</td>
                                <td>A盤</td>
                                <td>B盤</td>
                                <td>C盤</td>
                                <td>單註限額</td>
                                <td>單期限額</td>
                            </tr>
                   <?php for ($i=0;$i<1;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result[$i]['g_type']?><input type="hidden" name="G<?php echo $i+1;?>" id="G<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAG<?php echo $i+1;?>" id="RebateAG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'A盤', '1', 'ga')" 
                                    value='<?php echo $result[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAG<?php echo $i+1;?>" id="sRebateAG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBG<?php echo $i+1;?>" id="RebateBG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'B盤', '1', 'gb')" 
                                    value='<?php echo $result[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBG<?php echo $i+1;?>" id="sRebateBG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCG1" id="RebateCG1"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'C盤', '1', 'gc')" 
                                    value='<?php echo $result[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCG<?php echo $i+1;?>" id="sRebateCG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEG<?php echo $i+1;?>" id="RebateEG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result[$i]['g_type']?>', '單註限額', '1', 'ge')"
                                    value='<?php echo $result[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG1" id="sRebateEG1" value="<?php echo $resultsj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFG1" id="RebateFG1"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result[$i]['g_type']?>', '單期限額', '1', 'gf')"
                                    value='<?php echo $result[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG1" id="sRebateFG1" value="<?php echo $resultsj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php }   ?>   
                            <?php for ($i=1;$i<8;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result[$i]['g_type']?><input type="hidden" name="G<?php echo $i+1;?>" id="G<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAG<?php echo $i+1;?>" id="RebateAG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $result[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAG<?php echo $i+1;?>" id="sRebateAG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBG<?php echo $i+1;?>" id="RebateBG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $result[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBG<?php echo $i+1;?>" id="sRebateBG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCG<?php echo $i+1;?>" id="RebateCG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $result[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCG<?php echo $i+1;?>" id="sRebateCG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEG<?php echo $i+1;?>" id="RebateEG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateEG<?php echo $i+1;?>" value="<?php echo $resultsj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFG<?php echo $i+1;?>" id="RebateFG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $result[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateFG<?php echo $i+1;?>" value="<?php echo $resultsj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                        <?php for ($i=8;$i<12;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $result[$i]['g_type']?><input type="hidden" name="G<?php echo $i+1;?>" id="G<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAG<?php echo $i+1;?>" id="RebateAG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $result[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAG<?php echo $i+1;?>" id="sRebateAG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBG<?php echo $i+1;?>" id="RebateBG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $result[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBG<?php echo $i+1;?>" id="sRebateBG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCG<?php echo $i+1;?>" id="RebateCG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $result[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCG<?php echo $i+1;?>" id="sRebateCG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEG<?php echo $i+1;?>" id="RebateEG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateEG<?php echo $i+1;?>" value="<?php echo $resultsj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFG<?php echo $i+1;?>" id="RebateFG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $result[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateFG<?php echo $i+1;?>" value="<?php echo $resultsj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                      
                        <?php for ($i=12;$i<14;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS4"><?php echo $result[$i]['g_type']?><input type="hidden" name="G<?php echo $i+1;?>" id="G<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAG<?php echo $i+1;?>" id="RebateAG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $result[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAG<?php echo $i+1;?>" id="sRebateAG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBG<?php echo $i+1;?>" id="RebateBG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $result[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBG<?php echo $i+1;?>" id="sRebateBG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCG<?php echo $i+1;?>" id="RebateCG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $result[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCG<?php echo $i+1;?>" id="sRebateCG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEG<?php echo $i+1;?>" id="RebateEG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateEG<?php echo $i+1;?>" value="<?php echo $resultsj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFG<?php echo $i+1;?>" id="RebateFG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $result[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateFG<?php echo $i+1;?>" value="<?php echo $resultsj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <td>交易類型</td>
                                <td>A盤</td>
                                <td>B盤</td>
                                <td>C盤</td>
                                <td>單註限額</td>
                                <td>單期限額</td>
                            </tr>
                            
                          <?php for ($i=14;$i<18;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $result[$i]['g_type']?><input type="hidden" name="G<?php echo $i+1;?>" id="G<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAG<?php echo $i+1;?>" id="RebateAG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $result[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAG<?php echo $i+1;?>" id="sRebateAG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBG<?php echo $i+1;?>" id="RebateBG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $result[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBG<?php echo $i+1;?>" id="sRebateBG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCG<?php echo $i+1;?>" id="RebateCG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $result[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCG<?php echo $i+1;?>" id="sRebateCG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEG<?php echo $i+1;?>" id="RebateEG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateEG<?php echo $i+1;?>" value="<?php echo $resultsj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFG<?php echo $i+1;?>" id="RebateFG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $result[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateFG<?php echo $i+1;?>" value="<?php echo $resultsj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            <?php for ($i=18;$i<26;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS3"><?php echo $result[$i]['g_type']?><input type="hidden" name="G<?php echo $i+1;?>" id="G<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAG<?php echo $i+1;?>" id="RebateAG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $result[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAG<?php echo $i+1;?>" id="sRebateAG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBG<?php echo $i+1;?>" id="RebateBG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $result[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBG<?php echo $i+1;?>" id="sRebateBG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCG<?php echo $i+1;?>" id="RebateCG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $result[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCG<?php echo $i+1;?>" id="sRebateCG<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEG<?php echo $i+1;?>" id="RebateEG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateEG<?php echo $i+1;?>" value="<?php echo $resultsj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFG<?php echo $i+1;?>" id="RebateFG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $result[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateFG<?php echo $i+1;?>" value="<?php echo $resultsj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">重慶時時彩</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                                 <?php for ($i=0;$i<1;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $resultC[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAC<?php echo $i+1;?>" id="RebateAC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'A盤', '1', 'ca')" 
                                    value='<?php echo $resultC[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAC<?php echo $i+1;?>" id="sRebateAC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBC<?php echo $i+1;?>" id="RebateBC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'B盤', '1', 'cb')" 
                                    value='<?php echo $resultC[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBC<?php echo $i+1;?>" id="sRebateBC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCC<?php echo $i+1;?>" id="RebateCC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'C盤', '1', 'cc')" 
                                    value='<?php echo $resultC[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCC<?php echo $i+1;?>" id="sRebateCC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEC<?php echo $i+1;?>" id="RebateEC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $resultC[$i]['g_type']?>', '單註限額', '1', 'ce')"
                                    value='<?php echo $resultC[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateEC<?php echo $i+1;?>" value="<?php echo $resultsjC[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFC<?php echo $i+1;?>" id="RebateFC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $resultC[$i]['g_type']?>', '單期限額', '1', 'cf')"
                                    value='<?php echo $resultC[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateFC<?php echo $i+1;?>" value="<?php echo $resultsjC[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                         <?php for ($i=1;$i<5;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $resultC[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAC<?php echo $i+1;?>" id="RebateAC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $resultC[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAC<?php echo $i+1;?>" id="sRebateAC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBC<?php echo $i+1;?>" id="RebateBC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $resultC[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBC<?php echo $i+1;?>" id="sRebateBC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCC<?php echo $i+1;?>" id="RebateCC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $resultC[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCC<?php echo $i+1;?>" id="sRebateCC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEC<?php echo $i+1;?>" id="RebateEC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $resultC[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $resultC[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateEC<?php echo $i+1;?>" value="<?php echo $resultsjC[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFC<?php echo $i+1;?>" id="RebateFC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $resultC[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $resultC[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateFC<?php echo $i+1;?>" value="<?php echo $resultsjC[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                               <?php for ($i=5;$i<7;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $resultC[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAC<?php echo $i+1;?>" id="RebateAC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $resultC[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAC<?php echo $i+1;?>" id="sRebateAC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBC<?php echo $i+1;?>" id="RebateBC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $resultC[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBC<?php echo $i+1;?>" id="sRebateBC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCC<?php echo $i+1;?>" id="RebateCC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $resultC[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCC<?php echo $i+1;?>" id="sRebateCC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEC<?php echo $i+1;?>" id="RebateEC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $resultC[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $resultC[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateEC<?php echo $i+1;?>" value="<?php echo $resultsjC[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFC<?php echo $i+1;?>" id="RebateFC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $resultC[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $resultC[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateFC<?php echo $i+1;?>" value="<?php echo $resultsjC[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                            <?php for ($i=7;$i<10;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $resultC[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAC<?php echo $i+1;?>" id="RebateAC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $resultC[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAC<?php echo $i+1;?>" id="sRebateAC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBC<?php echo $i+1;?>" id="RebateBC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $resultC[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBC<?php echo $i+1;?>" id="sRebateBC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCC<?php echo $i+1;?>" id="RebateCC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $resultC[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCC<?php echo $i+1;?>" id="sRebateCC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEC<?php echo $i+1;?>" id="RebateEC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $resultC[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $resultC[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateEC<?php echo $i+1;?>" value="<?php echo $resultsjC[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFC<?php echo $i+1;?>" id="RebateFC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $resultC[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $resultC[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateFC<?php echo $i+1;?>" value="<?php echo $resultsjC[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                                <?php for ($i=10;$i<13;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS4"><?php echo $resultC[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAC<?php echo $i+1;?>" id="RebateAC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $resultC[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAC<?php echo $i+1;?>" id="sRebateAC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBC<?php echo $i+1;?>" id="RebateBC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $resultC[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBC<?php echo $i+1;?>" id="sRebateBC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultC[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCC<?php echo $i+1;?>" id="RebateCC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $resultC[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $resultC[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCC<?php echo $i+1;?>" id="sRebateCC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjC[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEC<?php echo $i+1;?>" id="RebateEC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $resultC[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $resultC[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateEC<?php echo $i+1;?>" value="<?php echo $resultsjC[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFC<?php echo $i+1;?>" id="RebateFC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $resultC[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $resultC[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateFC<?php echo $i+1;?>" value="<?php echo $resultsjC[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">极速时时彩</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                                 <?php for ($i=0;$i<1;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result_jx[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAJX<?php echo $i+1;?>" id="RebateAJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'A盤', '1', 'ca')" 
                                    value='<?php echo $result_jx[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJX<?php echo $i+1;?>" id="sRebateAJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBJX<?php echo $i+1;?>" id="RebateBJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'B盤', '1', 'cb')" 
                                    value='<?php echo $result_jx[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJX<?php echo $i+1;?>" id="sRebateBJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCJX<?php echo $i+1;?>" id="RebateCJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'C盤', '1', 'cc')" 
                                    value='<?php echo $result_jx[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJX<?php echo $i+1;?>" id="sRebateCJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJX<?php echo $i+1;?>" id="RebateEJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_jx[$i]['g_type']?>', '單註限額', '1', 'ce')"
                                    value='<?php echo $result_jx[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateEJX<?php echo $i+1;?>" value="<?php echo $resultsj_jx[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJX<?php echo $i+1;?>" id="RebateFJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_jx[$i]['g_type']?>', '單期限額', '1', 'cf')"
                                    value='<?php echo $result_jx[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateFJX<?php echo $i+1;?>" value="<?php echo $resultsj_jx[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                         <?php for ($i=1;$i<5;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result_jx[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAJX<?php echo $i+1;?>" id="RebateAJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $result_jx[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJX<?php echo $i+1;?>" id="sRebateAJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBJX<?php echo $i+1;?>" id="RebateBJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $result_jx[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJX<?php echo $i+1;?>" id="sRebateBJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCJX<?php echo $i+1;?>" id="RebateCJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $result_jx[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJX<?php echo $i+1;?>" id="sRebateCJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJX<?php echo $i+1;?>" id="RebateEJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_jx[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $result_jx[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateEJX<?php echo $i+1;?>" value="<?php echo $resultsj_jx[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJX<?php echo $i+1;?>" id="RebateFJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_jx[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $result_jx[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateFJX<?php echo $i+1;?>" value="<?php echo $resultsj_jx[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                               <?php for ($i=5;$i<7;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $result_jx[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAJX<?php echo $i+1;?>" id="RebateAJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $result_jx[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJX<?php echo $i+1;?>" id="sRebateAJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBJX<?php echo $i+1;?>" id="RebateBJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $result_jx[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJX<?php echo $i+1;?>" id="sRebateBJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCJX<?php echo $i+1;?>" id="RebateCJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $result_jx[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJX<?php echo $i+1;?>" id="sRebateCJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJX<?php echo $i+1;?>" id="RebateEJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_jx[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $result_jx[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateEJX<?php echo $i+1;?>" value="<?php echo $resultsj_jx[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJX<?php echo $i+1;?>" id="RebateFJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_jx[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $result_jx[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateFJX<?php echo $i+1;?>" value="<?php echo $resultsj_jx[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                            <?php for ($i=7;$i<10;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $result_jx[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAJX<?php echo $i+1;?>" id="RebateAJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $result_jx[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJX<?php echo $i+1;?>" id="sRebateAJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBJX<?php echo $i+1;?>" id="RebateBJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $result_jx[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJX<?php echo $i+1;?>" id="sRebateBJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCJX<?php echo $i+1;?>" id="RebateCJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $result_jx[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJX<?php echo $i+1;?>" id="sRebateCJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJX<?php echo $i+1;?>" id="RebateEJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_jx[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result_jx[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateEJX<?php echo $i+1;?>" value="<?php echo $resultsj_jx[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJX<?php echo $i+1;?>" id="RebateFJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_jx[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $result_jx[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateFJX<?php echo $i+1;?>" value="<?php echo $resultsj_jx[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                                <?php for ($i=10;$i<13;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS4"><?php echo $result_jx[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAJX<?php echo $i+1;?>" id="RebateAJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $result_jx[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJX<?php echo $i+1;?>" id="sRebateAJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBJX<?php echo $i+1;?>" id="RebateBJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $result_jx[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJX<?php echo $i+1;?>" id="sRebateBJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_jx[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCJX<?php echo $i+1;?>" id="RebateCJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_jx[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $result_jx[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJX<?php echo $i+1;?>" id="sRebateCJX<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_jx[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJX<?php echo $i+1;?>" id="RebateEJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_jx[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $result_jx[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateEJX<?php echo $i+1;?>" value="<?php echo $resultsj_jx[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJX<?php echo $i+1;?>" id="RebateFJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_jx[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $result_jx[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateFJX<?php echo $i+1;?>" value="<?php echo $resultsj_jx[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">新疆时时彩</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                                 <?php for ($i=0;$i<1;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result_xj[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAXJ<?php echo $i+1;?>" id="RebateAXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'A盤', '1', 'ca')" 
                                    value='<?php echo $result_xj[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAXJ<?php echo $i+1;?>" id="sRebateAXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBXJ<?php echo $i+1;?>" id="RebateBXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'B盤', '1', 'cb')" 
                                    value='<?php echo $result_xj[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBXJ<?php echo $i+1;?>" id="sRebateBXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCXJ<?php echo $i+1;?>" id="RebateCXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'C盤', '1', 'cc')" 
                                    value='<?php echo $result_xj[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCXJ<?php echo $i+1;?>" id="sRebateCXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEXJ<?php echo $i+1;?>" id="RebateEXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_xj[$i]['g_type']?>', '單註限額', '1', 'ce')"
                                    value='<?php echo $result_xj[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateEXJ<?php echo $i+1;?>" value="<?php echo $resultsj_xj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFXJ<?php echo $i+1;?>" id="RebateFXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_xj[$i]['g_type']?>', '單期限額', '1', 'cf')"
                                    value='<?php echo $result_xj[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateFXJ<?php echo $i+1;?>" value="<?php echo $resultsj_xj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                         <?php for ($i=1;$i<5;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result_xj[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAXJ<?php echo $i+1;?>" id="RebateAXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $result_xj[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAXJ<?php echo $i+1;?>" id="sRebateAXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBXJ<?php echo $i+1;?>" id="RebateBXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $result_xj[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBXJ<?php echo $i+1;?>" id="sRebateBXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCXJ<?php echo $i+1;?>" id="RebateCXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $result_xj[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCXJ<?php echo $i+1;?>" id="sRebateCXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEXJ<?php echo $i+1;?>" id="RebateEXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_xj[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $result_xj[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateEXJ<?php echo $i+1;?>" value="<?php echo $resultsj_xj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFXJ<?php echo $i+1;?>" id="RebateFXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_xj[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $result_xj[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateFXJ<?php echo $i+1;?>" value="<?php echo $resultsj_xj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                               <?php for ($i=5;$i<7;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $result_xj[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAXJ<?php echo $i+1;?>" id="RebateAXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $result_xj[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAXJ<?php echo $i+1;?>" id="sRebateAXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBXJ<?php echo $i+1;?>" id="RebateBXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $result_xj[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBXJ<?php echo $i+1;?>" id="sRebateBXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCXJ<?php echo $i+1;?>" id="RebateCXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $result_xj[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCXJ<?php echo $i+1;?>" id="sRebateCXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEXJ<?php echo $i+1;?>" id="RebateEXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_xj[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $result_xj[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateEXJ<?php echo $i+1;?>" value="<?php echo $resultsj_xj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFXJ<?php echo $i+1;?>" id="RebateFXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_xj[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $result_xj[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateFXJ<?php echo $i+1;?>" value="<?php echo $resultsj_xj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                            <?php for ($i=7;$i<10;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $result_xj[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAXJ<?php echo $i+1;?>" id="RebateAXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $result_xj[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAXJ<?php echo $i+1;?>" id="sRebateAXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBXJ<?php echo $i+1;?>" id="RebateBXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $result_xj[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBXJ<?php echo $i+1;?>" id="sRebateBXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCXJ<?php echo $i+1;?>" id="RebateCXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $result_xj[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCXJ<?php echo $i+1;?>" id="sRebateCXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEXJ<?php echo $i+1;?>" id="RebateEXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_xj[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result_xj[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateEXJ<?php echo $i+1;?>" value="<?php echo $resultsj_xj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFXJ<?php echo $i+1;?>" id="RebateFXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_xj[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $result_xj[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateFXJ<?php echo $i+1;?>" value="<?php echo $resultsj_xj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                                <?php for ($i=10;$i<13;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS4"><?php echo $result_xj[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAXJ<?php echo $i+1;?>" id="RebateAXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $result_xj[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAXJ<?php echo $i+1;?>" id="sRebateAXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBXJ<?php echo $i+1;?>" id="RebateBXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $result_xj[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBXJ<?php echo $i+1;?>" id="sRebateBXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_xj[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCXJ<?php echo $i+1;?>" id="RebateCXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_xj[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $result_xj[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCXJ<?php echo $i+1;?>" id="sRebateCXJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_xj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEXJ<?php echo $i+1;?>" id="RebateEXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_xj[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $result_xj[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateEXJ<?php echo $i+1;?>" value="<?php echo $resultsj_xj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFXJ<?php echo $i+1;?>" id="RebateFXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_xj[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $result_xj[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateFXJ<?php echo $i+1;?>" value="<?php echo $resultsj_xj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">天津时时彩</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                                 <?php for ($i=0;$i<1;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result_tj[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateATJ<?php echo $i+1;?>" id="RebateATJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'A盤', '1', 'ca')" 
                                    value='<?php echo $result_tj[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateATJ<?php echo $i+1;?>" id="sRebateATJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBTJ<?php echo $i+1;?>" id="RebateBTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'B盤', '1', 'cb')" 
                                    value='<?php echo $result_tj[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBTJ<?php echo $i+1;?>" id="sRebateBTJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCTJ<?php echo $i+1;?>" id="RebateCTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'C盤', '1', 'cc')" 
                                    value='<?php echo $result_tj[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCTJ<?php echo $i+1;?>" id="sRebateCTJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateETJ<?php echo $i+1;?>" id="RebateETJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_tj[$i]['g_type']?>', '單註限額', '1', 'ce')"
                                    value='<?php echo $result_tj[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateETJ<?php echo $i+1;?>" value="<?php echo $resultsj_tj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFTJ<?php echo $i+1;?>" id="RebateFTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_tj[$i]['g_type']?>', '單期限額', '1', 'cf')"
                                    value='<?php echo $result_tj[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateFTJ<?php echo $i+1;?>" value="<?php echo $resultsj_tj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                         <?php for ($i=1;$i<5;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result_tj[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateATJ<?php echo $i+1;?>" id="RebateATJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $result_tj[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateATJ<?php echo $i+1;?>" id="sRebateATJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBTJ<?php echo $i+1;?>" id="RebateBTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $result_tj[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBTJ<?php echo $i+1;?>" id="sRebateBTJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCTJ<?php echo $i+1;?>" id="RebateCTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $result_tj[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCTJ<?php echo $i+1;?>" id="sRebateCTJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateETJ<?php echo $i+1;?>" id="RebateETJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_tj[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $result_tj[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateETJ<?php echo $i+1;?>" value="<?php echo $resultsj_tj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFTJ<?php echo $i+1;?>" id="RebateFTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_tj[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $result_tj[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateFTJ<?php echo $i+1;?>" value="<?php echo $resultsj_tj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                               <?php for ($i=5;$i<7;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $result_tj[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateATJ<?php echo $i+1;?>" id="RebateATJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $result_tj[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateATJ<?php echo $i+1;?>" id="sRebateATJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBTJ<?php echo $i+1;?>" id="RebateBTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $result_tj[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBTJ<?php echo $i+1;?>" id="sRebateBTJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCTJ<?php echo $i+1;?>" id="RebateCTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $result_tj[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCTJ<?php echo $i+1;?>" id="sRebateCTJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateETJ<?php echo $i+1;?>" id="RebateETJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_tj[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $result_tj[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateETJ<?php echo $i+1;?>" value="<?php echo $resultsj_tj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFTJ<?php echo $i+1;?>" id="RebateFTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_tj[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $result_tj[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateFTJ<?php echo $i+1;?>" value="<?php echo $resultsj_tj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                            <?php for ($i=7;$i<10;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $result_tj[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateATJ<?php echo $i+1;?>" id="RebateATJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $result_tj[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateATJ<?php echo $i+1;?>" id="sRebateATJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBTJ<?php echo $i+1;?>" id="RebateBTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $result_tj[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBTJ<?php echo $i+1;?>" id="sRebateBTJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCTJ<?php echo $i+1;?>" id="RebateCTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $result_tj[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCTJ<?php echo $i+1;?>" id="sRebateCTJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateETJ<?php echo $i+1;?>" id="RebateETJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_tj[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result_tj[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateETJ<?php echo $i+1;?>" value="<?php echo $resultsj_tj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFTJ<?php echo $i+1;?>" id="RebateFTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_tj[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $result_tj[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateFTJ<?php echo $i+1;?>" value="<?php echo $resultsj_tj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                                <?php for ($i=10;$i<13;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS4"><?php echo $result_tj[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateATJ<?php echo $i+1;?>" id="RebateATJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $result_tj[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateATJ<?php echo $i+1;?>" id="sRebateATJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBTJ<?php echo $i+1;?>" id="RebateBTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $result_tj[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBTJ<?php echo $i+1;?>" id="sRebateBTJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_tj[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCTJ<?php echo $i+1;?>" id="RebateCTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_tj[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $result_tj[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCTJ<?php echo $i+1;?>" id="sRebateCTJ<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_tj[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateETJ<?php echo $i+1;?>" id="RebateETJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_tj[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $result_tj[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateETJ<?php echo $i+1;?>" value="<?php echo $resultsj_tj[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFTJ<?php echo $i+1;?>" id="RebateFTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_tj[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $result_tj[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateFTJ<?php echo $i+1;?>" value="<?php echo $resultsj_tj[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">北京赛车PK10</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                           <?php for ($i=0;$i<1;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $resultP[$i]['g_type']?><input type="hidden" name="B<?php echo $i+1;?>" id="B<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAB<?php echo $i+1;?>" id="RebateAB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'A盤', '1', 'ba')" 
                                    value='<?php echo $resultP[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAB<?php echo $i+1;?>" id="sRebateAB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBB<?php echo $i+1;?>" id="RebateBB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'B盤', '1', 'bb')" 
                                    value='<?php echo $resultP[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBB<?php echo $i+1;?>" id="sRebateBB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCB<?php echo $i+1;?>" id="RebateCB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'C盤', '1', 'bc')" 
                                    value='<?php echo $resultP[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCB<?php echo $i+1;?>" id="sRebateCB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEB<?php echo $i+1;?>" id="RebateEB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $resultP[$i]['g_type']?>', '單註限額', '1', 'be')"
                                    value='<?php echo $resultP[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEB<?php echo $i+1;?>" id="sRebateEB<?php echo $i+1;?>" value="<?php echo $resultsjP[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFB<?php echo $i+1;?>" id="RebateFB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $resultP[$i]['g_type']?>', '單期限額', '1', 'bf')"
                                    value='<?php echo $resultP[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEB<?php echo $i+1;?>" id="sRebateFB<?php echo $i+1;?>" value="<?php echo $resultsjP[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>    
                      
                       <?php for ($i=1;$i<8;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $resultP[$i]['g_type']?><input type="hidden" name="B<?php echo $i+1;?>" id="B<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAB<?php echo $i+1;?>" id="RebateAB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'A盤', '0', 'ba')" 
                                    value='<?php echo $resultP[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAB<?php echo $i+1;?>" id="sRebateAB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBB<?php echo $i+1;?>" id="RebateBB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'B盤', '0', 'bb')" 
                                    value='<?php echo $resultP[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBB<?php echo $i+1;?>" id="sRebateBB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCB<?php echo $i+1;?>" id="RebateCB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'C盤', '0', 'bc')" 
                                    value='<?php echo $resultP[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCB<?php echo $i+1;?>" id="sRebateCB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEB<?php echo $i+1;?>" id="RebateEB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $resultP[$i]['g_type']?>', '單註限額', '0', 'be')"
                                    value='<?php echo $resultP[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEB<?php echo $i+1;?>" id="sRebateEB<?php echo $i+1;?>" value="<?php echo $resultsjP[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFB<?php echo $i+1;?>" id="RebateFB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $resultP[$i]['g_type']?>', '單期限額', '0', 'bf')"
                                    value='<?php echo $resultP[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEB<?php echo $i+1;?>" id="sRebateFB<?php echo $i+1;?>" value="<?php echo $resultsjP[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>    
                      
                        
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                          <?php for ($i=8;$i<10;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $resultP[$i]['g_type']?><input type="hidden" name="B<?php echo $i+1;?>" id="B<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAB<?php echo $i+1;?>" id="RebateAB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'A盤', '0', 'ba')" 
                                    value='<?php echo $resultP[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAB<?php echo $i+1;?>" id="sRebateAB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBB<?php echo $i+1;?>" id="RebateBB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'B盤', '0', 'bb')" 
                                    value='<?php echo $resultP[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBB<?php echo $i+1;?>" id="sRebateBB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCB<?php echo $i+1;?>" id="RebateCB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'C盤', '0', 'bc')" 
                                    value='<?php echo $resultP[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCB<?php echo $i+1;?>" id="sRebateCB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEB<?php echo $i+1;?>" id="RebateEB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $resultP[$i]['g_type']?>', '單註限額', '0', 'be')"
                                    value='<?php echo $resultP[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEB<?php echo $i+1;?>" id="sRebateEB<?php echo $i+1;?>" value="<?php echo $resultsjP[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFB<?php echo $i+1;?>" id="RebateFB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $resultP[$i]['g_type']?>', '單期限額', '0', 'bf')"
                                    value='<?php echo $resultP[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEB<?php echo $i+1;?>" id="sRebateFB<?php echo $i+1;?>" value="<?php echo $resultsjP[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>    
                      
                                 
                          <?php for ($i=10;$i<15;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $resultP[$i]['g_type']?><input type="hidden" name="B<?php echo $i+1;?>" id="B<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAB<?php echo $i+1;?>" id="RebateAB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'A盤', '0', 'ba')" 
                                    value='<?php echo $resultP[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAB<?php echo $i+1;?>" id="sRebateAB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBB<?php echo $i+1;?>" id="RebateBB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'B盤', '0', 'bb')" 
                                    value='<?php echo $resultP[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBB<?php echo $i+1;?>" id="sRebateBB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCB<?php echo $i+1;?>" id="RebateCB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'C盤', '0', 'bc')" 
                                    value='<?php echo $resultP[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCB<?php echo $i+1;?>" id="sRebateCB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEB<?php echo $i+1;?>" id="RebateEB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $resultP[$i]['g_type']?>', '單註限額', '0', 'be')"
                                    value='<?php echo $resultP[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEB<?php echo $i+1;?>" id="sRebateEB<?php echo $i+1;?>" value="<?php echo $resultsjP[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFB<?php echo $i+1;?>" id="RebateFB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $resultP[$i]['g_type']?>', '單期限額', '0', 'bf')"
                                    value='<?php echo $resultP[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEB<?php echo $i+1;?>" id="sRebateFB<?php echo $i+1;?>" value="<?php echo $resultsjP[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>    
                           <?php for ($i=15;$i<16;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS4"><?php echo $resultP[$i]['g_type']?><input type="hidden" name="B<?php echo $i+1;?>" id="B<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAB<?php echo $i+1;?>" id="RebateAB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'A盤', '0', 'ba')" 
                                    value='<?php echo $resultP[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAB<?php echo $i+1;?>" id="sRebateAB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBB<?php echo $i+1;?>" id="RebateBB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'B盤', '0', 'bb')" 
                                    value='<?php echo $resultP[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBB<?php echo $i+1;?>" id="sRebateBB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultP[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCB<?php echo $i+1;?>" id="RebateCB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $resultP[$i]['g_type']?>', 'C盤', '0', 'bc')" 
                                    value='<?php echo $resultP[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCB<?php echo $i+1;?>" id="sRebateCB<?php echo $i+1;?>" 
                                    value="<?php echo $resultsjP[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEB<?php echo $i+1;?>" id="RebateEB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $resultP[$i]['g_type']?>', '單註限額', '0', 'be')"
                                    value='<?php echo $resultP[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEB<?php echo $i+1;?>" id="sRebateEB<?php echo $i+1;?>" value="<?php echo $resultsjP[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFB<?php echo $i+1;?>" id="RebateFB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $resultP[$i]['g_type']?>', '單期限額', '0', 'bf')"
                                    value='<?php echo $resultP[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEB<?php echo $i+1;?>" id="sRebateFB<?php echo $i+1;?>" value="<?php echo $resultsjP[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>    
                         
                      
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">极速赛车</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                           <?php for ($i=0;$i<1;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result_ft[$i]['g_type']?><input type="hidden" name="B<?php echo $i+1;?>" id="B<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAFT<?php echo $i+1;?>" id="RebateAFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'A盤', '1', 'ba')" 
                                    value='<?php echo $result_ft[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAFT<?php echo $i+1;?>" id="sRebateAFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBFT<?php echo $i+1;?>" id="RebateBFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'B盤', '1', 'bb')" 
                                    value='<?php echo $result_ft[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBFT<?php echo $i+1;?>" id="sRebateBFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCFT<?php echo $i+1;?>" id="RebateCFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'C盤', '1', 'bc')" 
                                    value='<?php echo $result_ft[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCFT<?php echo $i+1;?>" id="sRebateCFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEFT<?php echo $i+1;?>" id="RebateEFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_ft[$i]['g_type']?>', '單註限額', '1', 'be')"
                                    value='<?php echo $result_ft[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEFT<?php echo $i+1;?>" id="sRebateEFT<?php echo $i+1;?>" value="<?php echo $resultsj_ft[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFFT<?php echo $i+1;?>" id="RebateFFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_ft[$i]['g_type']?>', '單期限額', '1', 'bf')"
                                    value='<?php echo $result_ft[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEFT<?php echo $i+1;?>" id="sRebateFFT<?php echo $i+1;?>" value="<?php echo $resultsj_ft[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>    
                      
                       <?php for ($i=1;$i<8;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result_ft[$i]['g_type']?><input type="hidden" name="FT<?php echo $i+1;?>" id="FT<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAFT<?php echo $i+1;?>" id="RebateAFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'A盤', '0', 'ba')" 
                                    value='<?php echo $result_ft[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAFT<?php echo $i+1;?>" id="sRebateAFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBFT<?php echo $i+1;?>" id="RebateBFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'B盤', '0', 'bb')" 
                                    value='<?php echo $result_ft[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBFT<?php echo $i+1;?>" id="sRebateBFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCFT<?php echo $i+1;?>" id="RebateCFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'C盤', '0', 'bc')" 
                                    value='<?php echo $result_ft[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCFT<?php echo $i+1;?>" id="sRebateCFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEFT<?php echo $i+1;?>" id="RebateEFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_ft[$i]['g_type']?>', '單註限額', '0', 'be')"
                                    value='<?php echo $result_ft[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEFT<?php echo $i+1;?>" id="sRebateEFT<?php echo $i+1;?>" value="<?php echo $resultsj_ft[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFFT<?php echo $i+1;?>" id="RebateFFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_ft[$i]['g_type']?>', '單期限額', '0', 'bf')"
                                    value='<?php echo $result_ft[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEFT<?php echo $i+1;?>" id="sRebateFFT<?php echo $i+1;?>" value="<?php echo $resultsj_ft[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>    
                      
                        
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                          <?php for ($i=8;$i<10;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result_ft[$i]['g_type']?><input type="hidden" name="FT<?php echo $i+1;?>" id="FT<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAFT<?php echo $i+1;?>" id="RebateAFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'A盤', '0', 'ba')" 
                                    value='<?php echo $result_ft[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAFT<?php echo $i+1;?>" id="sRebateAFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBFT<?php echo $i+1;?>" id="RebateBFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'B盤', '0', 'bb')" 
                                    value='<?php echo $result_ft[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBFT<?php echo $i+1;?>" id="sRebateBFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCFT<?php echo $i+1;?>" id="RebateCFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'C盤', '0', 'bc')" 
                                    value='<?php echo $result_ft[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCFT<?php echo $i+1;?>" id="sRebateCFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEFT<?php echo $i+1;?>" id="RebateEFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_ft[$i]['g_type']?>', '單註限額', '0', 'be')"
                                    value='<?php echo $result_ft[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEFT<?php echo $i+1;?>" id="sRebateEFT<?php echo $i+1;?>" value="<?php echo $resultsj_ft[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFFT<?php echo $i+1;?>" id="RebateFFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_ft[$i]['g_type']?>', '單期限額', '0', 'bf')"
                                    value='<?php echo $result_ft[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEFT<?php echo $i+1;?>" id="sRebateFFT<?php echo $i+1;?>" value="<?php echo $resultsj_ft[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>    
                      
                                 
                          <?php for ($i=10;$i<15;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $result_ft[$i]['g_type']?><input type="hidden" name="FT<?php echo $i+1;?>" id="FT<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAFT<?php echo $i+1;?>" id="RebateAFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'A盤', '0', 'ba')" 
                                    value='<?php echo $result_ft[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAFT<?php echo $i+1;?>" id="sRebateAFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBFT<?php echo $i+1;?>" id="RebateBFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'B盤', '0', 'bb')" 
                                    value='<?php echo $result_ft[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBFT<?php echo $i+1;?>" id="sRebateBFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCFT<?php echo $i+1;?>" id="RebateCFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'C盤', '0', 'bc')" 
                                    value='<?php echo $result_ft[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCFT<?php echo $i+1;?>" id="sRebateCFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEFT<?php echo $i+1;?>" id="RebateEFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_ft[$i]['g_type']?>', '單註限額', '0', 'be')"
                                    value='<?php echo $result_ft[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEFT<?php echo $i+1;?>" id="sRebateEFT<?php echo $i+1;?>" value="<?php echo $resultsj_ft[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFFT<?php echo $i+1;?>" id="RebateFFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_ft[$i]['g_type']?>', '單期限額', '0', 'bf')"
                                    value='<?php echo $result_ft[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEFT<?php echo $i+1;?>" id="sRebateFFT<?php echo $i+1;?>" value="<?php echo $resultsj_ft[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>    
                           <?php for ($i=15;$i<16;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS4"><?php echo $result_ft[$i]['g_type']?><input type="hidden" name="FT<?php echo $i+1;?>" id="FT<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAFT<?php echo $i+1;?>" id="RebateAFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'A盤', '0', 'ba')" 
                                    value='<?php echo $result_ft[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAFT<?php echo $i+1;?>" id="sRebateAFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBFT<?php echo $i+1;?>" id="RebateBFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'B盤', '0', 'bb')" 
                                    value='<?php echo $result_ft[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBFT<?php echo $i+1;?>" id="sRebateBFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_ft[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCFT<?php echo $i+1;?>" id="RebateCFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_ft[$i]['g_type']?>', 'C盤', '0', 'bc')" 
                                    value='<?php echo $result_ft[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCFT<?php echo $i+1;?>" id="sRebateCFT<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_ft[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEFT<?php echo $i+1;?>" id="RebateEFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_ft[$i]['g_type']?>', '單註限額', '0', 'be')"
                                    value='<?php echo $result_ft[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEFT<?php echo $i+1;?>" id="sRebateEFT<?php echo $i+1;?>" value="<?php echo $resultsj_ft[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFFT<?php echo $i+1;?>" id="RebateFFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_ft[$i]['g_type']?>', '單期限額', '0', 'bf')"
                                    value='<?php echo $result_ft[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEFT<?php echo $i+1;?>" id="sRebateFFT<?php echo $i+1;?>" value="<?php echo $resultsj_ft[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>    
                         
                      
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                               <th style="border:none">吉林快3</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                         <?php for ($i=0;$i<2;$i++){?>   
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $resultJ[$i]['g_type']?><input type="hidden" name="J<?php echo $i+1;?>" id="J<?php echo $i+1;?>" value="58514" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAJ<?php echo $i+1;?>" id="RebateAJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ja'"
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja'
                                    onchange="isCompare(this, '<?php echo $resultJ[$i]['g_type']?>', 'A盤', '0', 'ja')"
                                    value='<?php echo $resultJ[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJ<?php echo $i+1;?>" id="sRebateAJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBJ<?php echo $i+1;?>" id="RebateBJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jb'"
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb'
                                    onchange="isCompare(this, '<?php echo $resultJ[$i]['g_type']?>', 'B盤', '0', 'jb')"
                                    value='<?php echo $resultJ[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJ<?php echo $i+1;?>" id="sRebateBJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCJ<?php echo $i+1;?>" id="RebateCJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jc'"
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc'
                                    onchange="isCompare(this, '<?php echo $resultJ[$i]['g_type']?>', 'C盤', '0', 'jc')"
                                    value='<?php echo $resultJ[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJ<?php echo $i+1;?>" id="sRebateCJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJ<?php echo $i+1;?>" id="RebateEJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'"
                                    class='inp1 je'
                                    onchange="isCompares(this, '<?php echo $resultJ[$i]['g_type']?>', '單註限額', '1', 'je')"
                                    value='<?php echo $resultJ[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJ<?php echo $i+1;?>" id="sRebateEJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJ<?php echo $i+1;?>" id="RebateFJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" 
                                    class='inp1 jf'
                                    onchange="isCompares(this, '<?php echo $resultJ[$i]['g_type']?>', '單期限額', '1', 'jf')"
                                    value='<?php echo $resultJ[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFJ<?php echo $i+1;?>" id="sRebateFJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                            <?php }?>
                        
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS3">圍骰<input type="hidden" name="J3" id="J3" value="58516" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[2]['g_a_limit']?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAJ3" id="RebateAJ3"
                                    onfocus="this.className='inp1m ja'"
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja'
                                    onchange="isCompare(this, '圍骰', 'A盤', '0', 'ja')"
                                    value='<?php echo $resultJ[2]['g_a_limit']?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJ3" id="sRebateAJ3" value="<?php echo $resultsjJ[2]['g_a_limit']?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[2]['g_b_limit']?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBJ3" id="RebateBJ3"
                                    onfocus="this.className='inp1m jb'"
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb'
                                    onchange="isCompare(this, '圍骰', 'B盤', '0', 'jb')"
                                    value='<?php echo $resultJ[2]['g_b_limit']?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJ3" id="sRebateBJ3" value="<?php echo $resultsjJ[2]['g_b_limit']?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>">97.2</span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCJ3" id="RebateCJ3"
                                    onfocus="this.className='inp1m jc'"
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc'
                                    onchange="isCompare(this, '圍骰', 'C盤', '0', 'jc')"
                                    value='<?php echo $resultJ[2]['g_c_limit']?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJ3" id="sRebateCJ3" value="<?php echo $resultsjJ[2]['g_c_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJ3" id="RebateEJ3"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'"
                                    class='inp1 je'
                                    onchange="isCompares(this, '圍骰', '單註限額', '0', 'je')"
                                    value='<?php echo $resultJ[2]['g_d_limit']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJ3" id="sRebateEJ3" value="<?php echo $resultsjJ[2]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJ3" id="RebateFJ3"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" 
                                    class='inp1 jf'
                                    onchange="isCompares(this, '圍骰', '單期限額', '0', 'jf')"
                                    value='<?php echo $resultJ[2]['g_d_limit']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFJ3" id="sRebateFJ3" value="<?php echo $resultsjJ[2]['g_e_limit'];?>" />
                                </td>
                            </tr>
                            
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS3">全骰<input type="hidden" name="J7" id="J7" value="58517" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[2]['g_a_limit']?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAJ7" id="RebateAJ7"
                                    onfocus="this.className='inp1m ja'"
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja'
                                    onchange="isCompare(this, '全骰', 'A盤', '0', 'ja')"
                                    value='<?php echo $resultJ[2]['g_a_limit']?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJ7" id="sRebateAJ7" value="<?php echo $resultsjJ[2]['g_a_limit']?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[2]['g_b_limit']?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBJ7" id="RebateBJ7"
                                    onfocus="this.className='inp1m jb'"
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb'
                                    onchange="isCompare(this, '全骰', 'B盤', '0', 'jb')"
                                    value='<?php echo $resultJ[2]['g_b_limit']?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJ7" id="sRebateBJ7" value="<?php echo $resultsjJ[2]['g_b_limit']?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[2]['g_c_limit']?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCJ7" id="RebateCJ7"
                                    onfocus="this.className='inp1m jc'"
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc'
                                    onchange="isCompare(this, '全骰', 'C盤', '0', 'jc')"
                                    value='<?php echo $resultJ[2]['g_c_limit']?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJ7" id="sRebateCJ7" value="<?php echo $resultsjJ[2]['g_c_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJ7" id="RebateEJ7"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'"
                                    class='inp1 je'
                                    onchange="isCompares(this, '全骰', '單註限額', '0', 'je')"
                                    value='<?php echo $resultJ[2]['g_d_limit']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJ7" id="sRebateEJ7" value="<?php echo $resultsjJ[2]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJ7" id="RebateFJ7"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" 
                                    class='inp1 jf'
                                    onchange="isCompares(this, '全骰', '單期限額', '0', 'jf')"
                                    value='<?php echo $resultJ[2]['g_e_limit']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFJ7" id="sRebateFJ7" value="<?php echo $resultsjJ[2]['g_e_limit'];?>" />
                                </td>
                            </tr>
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                         <?php for ($i=3;$i<4;$i++){?>   
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS4"><?php echo $resultJ[$i]['g_type']?><input type="hidden" name="J<?php echo $i+1;?>" id="J<?php echo $i+1;?>" value="58514" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAJ<?php echo $i+1;?>" id="RebateAJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ja'"
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja'
                                    onchange="isCompare(this, '<?php echo $resultJ[$i]['g_type']?>', 'A盤', '0', 'ja')"
                                    value='<?php echo $resultJ[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJ<?php echo $i+1;?>" id="sRebateAJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBJ<?php echo $i+1;?>" id="RebateBJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jb'"
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb'
                                    onchange="isCompare(this, '<?php echo $resultJ[$i]['g_type']?>', 'B盤', '0', 'jb')"
                                    value='<?php echo $resultJ[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJ<?php echo $i+1;?>" id="sRebateBJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCJ<?php echo $i+1;?>" id="RebateCJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jc'"
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc'
                                    onchange="isCompare(this, '<?php echo $resultJ[$i]['g_type']?>', 'C盤', '0', 'jc')"
                                    value='<?php echo $resultJ[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJ<?php echo $i+1;?>" id="sRebateCJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJ<?php echo $i+1;?>" id="RebateEJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'"
                                    class='inp1 je'
                                    onchange="isCompares(this, '<?php echo $resultJ[$i]['g_type']?>', '單註限額', '1', 'je')"
                                    value='<?php echo $resultJ[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJ<?php echo $i+1;?>" id="sRebateEJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJ<?php echo $i+1;?>" id="RebateFJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" 
                                    class='inp1 jf'
                                    onchange="isCompares(this, '<?php echo $resultJ[$i]['g_type']?>', '單期限額', '1', 'jf')"
                                    value='<?php echo $resultJ[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFJ<?php echo $i+1;?>" id="sRebateFJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                            <?php }?>
                              <?php for ($i=4;$i<6;$i++){?>   
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS3"><?php echo $resultJ[$i]['g_type']?><input type="hidden" name="J<?php echo $i+1;?>" id="J<?php echo $i+1;?>" value="58514" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAJ<?php echo $i+1;?>" id="RebateAJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ja'"
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja'
                                    onchange="isCompare(this, '<?php echo $resultJ[$i]['g_type']?>', 'A盤', '0', 'ja')"
                                    value='<?php echo $resultJ[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJ<?php echo $i+1;?>" id="sRebateAJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBJ<?php echo $i+1;?>" id="RebateBJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jb'"
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb'
                                    onchange="isCompare(this, '<?php echo $resultJ[$i]['g_type']?>', 'B盤', '0', 'jb')"
                                    value='<?php echo $resultJ[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJ<?php echo $i+1;?>" id="sRebateBJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultJ[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCJ<?php echo $i+1;?>" id="RebateCJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jc'"
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc'
                                    onchange="isCompare(this, '<?php echo $resultJ[$i]['g_type']?>', 'C盤', '0', 'jc')"
                                    value='<?php echo $resultJ[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJ<?php echo $i+1;?>" id="sRebateCJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJ<?php echo $i+1;?>" id="RebateEJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'"
                                    class='inp1 je'
                                    onchange="isCompares(this, '<?php echo $resultJ[$i]['g_type']?>', '單註限額', '0', 'je')"
                                    value='<?php echo $resultJ[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJ<?php echo $i+1;?>" id="sRebateEJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJ<?php echo $i+1;?>" id="RebateFJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" 
                                    class='inp1 jf'
                                    onchange="isCompares(this, '<?php echo $resultJ[$i]['g_type']?>', '單期限額', '0', 'jf')"
                                    value='<?php echo $resultJ[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFJ<?php echo $i+1;?>" id="sRebateFJ<?php echo $i+1;?>" value="<?php echo $resultsjJ[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                               <th style="border:none">快樂8</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                         <?php for ($i=0;$i<4;$i++){?>   
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $resultK[$i]['g_type']?><input type="hidden" name="K<?php echo $i+1;?>" id="K<?php echo $i+1;?>" value="58514" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultK[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAK<?php echo $i+1;?>" id="RebateAK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ja'"
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja'
                                    onchange="isCompare(this, '<?php echo $resultK[$i]['g_type']?>', 'A盤', '0', 'ja')"
                                    value='<?php echo $resultK[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAK<?php echo $i+1;?>" id="sRebateAK<?php echo $i+1;?>" value="<?php echo $resultsjK[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultK[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBK<?php echo $i+1;?>" id="RebateBK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jb'"
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb'
                                    onchange="isCompare(this, '<?php echo $resultK[$i]['g_type']?>', 'B盤', '0', 'jb')"
                                    value='<?php echo $resultK[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBK<?php echo $i+1;?>" id="sRebateBK<?php echo $i+1;?>" value="<?php echo $resultsjK[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultK[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCK<?php echo $i+1;?>" id="RebateCK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jc'"
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc'
                                    onchange="isCompare(this, '<?php echo $resultK[$i]['g_type']?>', 'C盤', '0', 'jc')"
                                    value='<?php echo $resultK[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCK<?php echo $i+1;?>" id="sRebateCK<?php echo $i+1;?>" value="<?php echo $resultsjK[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEK<?php echo $i+1;?>" id="RebateEK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'"
                                    class='inp1 je'
                                    onchange="isCompares(this, '<?php echo $resultK[$i]['g_type']?>', '單註限額', '1', 'je')"
                                    value='<?php echo $resultK[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEK<?php echo $i+1;?>" id="sRebateEK<?php echo $i+1;?>" value="<?php echo $resultsjK[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFK<?php echo $i+1;?>" id="RebateFK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" 
                                    class='inp1 jf'
                                    onchange="isCompares(this, '<?php echo $resultK[$i]['g_type']?>', '單期限額', '1', 'jf')"
                                    value='<?php echo $resultK[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFK<?php echo $i+1;?>" id="sRebateFK<?php echo $i+1;?>" value="<?php echo $resultsjK[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                            <?php }?>
                        
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                         <?php for ($i=4;$i<8;$i++){?>   
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS4"><?php echo $resultK[$i]['g_type']?><input type="hidden" name="K<?php echo $i+1;?>" id="K<?php echo $i+1;?>" value="58514" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultK[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateAK<?php echo $i+1;?>" id="RebateAK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ja'"
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja'
                                    onchange="isCompare(this, '<?php echo $resultK[$i]['g_type']?>', 'A盤', '0', 'ja')"
                                    value='<?php echo $resultK[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAK<?php echo $i+1;?>" id="sRebateAK<?php echo $i+1;?>" value="<?php echo $resultsjK[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultK[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBK<?php echo $i+1;?>" id="RebateBK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jb'"
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb'
                                    onchange="isCompare(this, '<?php echo $resultK[$i]['g_type']?>', 'B盤', '0', 'jb')"
                                    value='<?php echo $resultK[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBK<?php echo $i+1;?>" id="sRebateBK<?php echo $i+1;?>" value="<?php echo $resultsjK[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $resultK[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCK<?php echo $i+1;?>" id="RebateCK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jc'"
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc'
                                    onchange="isCompare(this, '<?php echo $resultK[$i]['g_type']?>', 'C盤', '0', 'jc')"
                                    value='<?php echo $resultK[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCK<?php echo $i+1;?>" id="sRebateCK<?php echo $i+1;?>" value="<?php echo $resultsjK[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEK<?php echo $i+1;?>" id="RebateEK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'"
                                    class='inp1 je'
                                    onchange="isCompares(this, '<?php echo $resultK[$i]['g_type']?>', '單註限額', '1', 'je')"
                                    value='<?php echo $resultK[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEK<?php echo $i+1;?>" id="sRebateEK<?php echo $i+1;?>" value="<?php echo $resultsjK[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFK<?php echo $i+1;?>" id="RebateFK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" 
                                    class='inp1 jf'
                                    onchange="isCompares(this, '<?php echo $resultK[$i]['g_type']?>', '單期限額', '1', 'jf')"
                                    value='<?php echo $resultK[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFK<?php echo $i+1;?>" id="sRebateFK<?php echo $i+1;?>" value="<?php echo $resultsjK[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">幸运农场</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <td>交易類型</td>
                                <td>A盤</td>
                                <td>B盤</td>
                                <td>C盤</td>
                                <td>單註限額</td>
                                <td>單期限額</td>
                            </tr>
                   <?php for ($i=0;$i<1;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result_nc[$i]['g_type']?><input type="hidden" name="G<?php echo $i+1;?>" id="G<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateANC<?php echo $i+1;?>" id="RebateANC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'A盤', '1', 'ga')" 
                                    value='<?php echo $result_nc[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateANC<?php echo $i+1;?>" id="sRebateANC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBNC<?php echo $i+1;?>" id="RebateBNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'B盤', '1', 'gb')" 
                                    value='<?php echo $result_nc[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBNC<?php echo $i+1;?>" id="sRebateBNC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCG1" id="RebateCG1"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'C盤', '1', 'gc')" 
                                    value='<?php echo $result_nc[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCNC<?php echo $i+1;?>" id="sRebateCNC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateENC<?php echo $i+1;?>" id="RebateENC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_nc[$i]['g_type']?>', '單註限額', '1', 'ge')"
                                    value='<?php echo $result_nc[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG1" id="sRebateEG1" value="<?php echo $resultsj_nc[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFG1" id="RebateFG1"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_nc[$i]['g_type']?>', '單期限額', '1', 'gf')"
                                    value='<?php echo $result_nc[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG1" id="sRebateFG1" value="<?php echo $resultsj_nc[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php }   ?>   
                            <?php for ($i=1;$i<8;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $result_nc[$i]['g_type']?><input type="hidden" name="NC<?php echo $i+1;?>" id="NC<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateANC<?php echo $i+1;?>" id="RebateANC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $result_nc[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateANC<?php echo $i+1;?>" id="sRebateANC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBNC<?php echo $i+1;?>" id="RebateBNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $result_nc[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBNC<?php echo $i+1;?>" id="sRebateBNC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCNC<?php echo $i+1;?>" id="RebateCNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $result_nc[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCNC<?php echo $i+1;?>" id="sRebateCNC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateENC<?php echo $i+1;?>" id="RebateENC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_nc[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result_nc[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateENC<?php echo $i+1;?>" value="<?php echo $resultsj_nc[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFNC<?php echo $i+1;?>" id="RebateFNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_nc[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $result_nc[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateFNC<?php echo $i+1;?>" value="<?php echo $resultsj_nc[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                        <?php for ($i=8;$i<12;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $result_nc[$i]['g_type']?><input type="hidden" name="NC<?php echo $i+1;?>" id="NC<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateANC<?php echo $i+1;?>" id="RebateANC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $result_nc[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateANC<?php echo $i+1;?>" id="sRebateANC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBNC<?php echo $i+1;?>" id="RebateBNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $result_nc[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBNC<?php echo $i+1;?>" id="sRebateBNC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCNC<?php echo $i+1;?>" id="RebateCNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $result_nc[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCNC<?php echo $i+1;?>" id="sRebateCNC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateENC<?php echo $i+1;?>" id="RebateENC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_nc[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result_nc[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateENC<?php echo $i+1;?>" value="<?php echo $resultsj_nc[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFNC<?php echo $i+1;?>" id="RebateFNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_nc[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $result_nc[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateFNC<?php echo $i+1;?>" value="<?php echo $resultsj_nc[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                      
                        <?php for ($i=12;$i<14;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS4"><?php echo $result_nc[$i]['g_type']?><input type="hidden" name="NC<?php echo $i+1;?>" id="NC<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateANC<?php echo $i+1;?>" id="RebateANC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $result_nc[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateANC<?php echo $i+1;?>" id="sRebateANC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBNC<?php echo $i+1;?>" id="RebateBNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $result_nc[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBNC<?php echo $i+1;?>" id="sRebateBNC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCNC<?php echo $i+1;?>" id="RebateCNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $result_nc[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCNC<?php echo $i+1;?>" id="sRebateCNC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateENC<?php echo $i+1;?>" id="RebateENC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_nc[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result_nc[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateENC<?php echo $i+1;?>" value="<?php echo $resultsj_nc[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFNC<?php echo $i+1;?>" id="RebateFNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_nc[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $result_nc[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateFNC<?php echo $i+1;?>" value="<?php echo $resultsj_nc[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <td>交易類型</td>
                                <td>A盤</td>
                                <td>B盤</td>
                                <td>C盤</td>
                                <td>單註限額</td>
                                <td>單期限額</td>
                            </tr>
                            
                          <?php for ($i=14;$i<18;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $result_nc[$i]['g_type']?><input type="hidden" name="NC<?php echo $i+1;?>" id="NC<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateANC<?php echo $i+1;?>" id="RebateANC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $result_nc[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateANC<?php echo $i+1;?>" id="sRebateANC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBNC<?php echo $i+1;?>" id="RebateBNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $result_nc[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBNC<?php echo $i+1;?>" id="sRebateBNC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCNC<?php echo $i+1;?>" id="RebateCNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $result_nc[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCNC<?php echo $i+1;?>" id="sRebateCNC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateENC<?php echo $i+1;?>" id="RebateENC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_nc[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result_nc[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateENC<?php echo $i+1;?>" value="<?php echo $resultsj_nc[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFNC<?php echo $i+1;?>" id="RebateFNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_nc[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $result_nc[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateFNC<?php echo $i+1;?>" value="<?php echo $resultsj_nc[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            <?php for ($i=18;$i<26;$i++){?>
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS3"><?php echo $result_nc[$i]['g_type']?><input type="hidden" name="NC<?php echo $i+1;?>" id="NC<?php echo $i+1;?>" value="232025" /></td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_a_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateANC<?php echo $i+1;?>" id="RebateANC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $result_nc[$i]['g_a_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateANC<?php echo $i+1;?>" id="sRebateANC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_a_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_b_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateBNC<?php echo $i+1;?>" id="RebateBNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $result_nc[$i]['g_b_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBNC<?php echo $i+1;?>" id="sRebateBNC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_b_limit'];?>" />
                                </td>
                                <td>
                                    <span style="width:60px;display:<?php if ($count == 0){echo "none";}?>"><?php echo $result_nc[$i]['g_c_limit'];?></span>
                                    <input style="width:60px;display:<?php if ($count > 0){echo "none";}?>" name="RebateCNC<?php echo $i+1;?>" id="RebateCNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $result_nc[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $result_nc[$i]['g_c_limit'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCNC<?php echo $i+1;?>" id="sRebateCNC<?php echo $i+1;?>" 
                                    value="<?php echo $resultsj_nc[$i]['g_c_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateENC<?php echo $i+1;?>" id="RebateENC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $result_nc[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $result_nc[$i]['g_d_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateENC<?php echo $i+1;?>" value="<?php echo $resultsj_nc[$i]['g_d_limit'];?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFNC<?php echo $i+1;?>" id="RebateFNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $result_nc[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $result_nc[$i]['g_e_limit'];?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateFNC<?php echo $i+1;?>" value="<?php echo $resultsj_nc[$i]['g_e_limit'];?>" />
                                </td>
                            </tr>
                      <?php  } ?>   
                            
                        </table>
                    </td>
                </tr>
            </table>
        <!-- end -->
        </td>
        <td class="Main_right" width="5"></td>
    </tr>
    <tr>
        <td class="Main_bottom_left"></td>
      <td background="/Css/tab_19.gif" align="center">
          <input type="submit" id="submit" name="submit" onMouseOver="this.className='input2_2'" onMouseOut="this.className='input2'" class="input2" value="保存" />
            &nbsp;&nbsp;
        <input type="button" onMouseOver="this.className='input2_2'" onMouseOut="this.className='input2'" class="input2" onClick="historys()" value="取消" />
      </td>
        <td class="Main_bottom_right"></td>
    </tr>
</table>
</form>
</body>
</html>
