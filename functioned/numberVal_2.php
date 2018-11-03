<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Sorry, the page wrong path
  Author: QQ:6328320
  Date:2011-12-21
*/


/**
 * 提交注單
 * 成功返回注單號
 * Enter description here ...
 */
function postForms ($list)
{
	$db = new DB();
	$sql = "INSERT INTO `g_zhudan` ( `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`,`g_distribution_4`,`mxsha1`,`mxmd`) "; 
	$mxsha1=md5($list['g_type']."@".$list['g_mingxi_1']."@".$list['g_mingxi_2']."$".$list['g_jiner'].$list['g_distribution_4']);
   $mxmd=$list['g_type']."@".$list['g_mingxi_1']."@".$list['g_mingxi_2']."$".$list['g_jiner']."$".$list['g_odds'];
   
	$sql .= "VALUES (
					'{$list['g_s_nid']}', 
					'{$list['g_mumber_type']}', 
					'{$list['g_nid']}', 
					'{$list['g_date']}', 
					'{$list['g_type']}', 
					'{$list['g_qishu']}', 
					'{$list['g_mingxi_1']}', 
					'{$list['g_mingxi_1_str']}', 
					'{$list['g_mingxi_2']}', 
					'{$list['g_mingxi_2_str']}', 
					'{$list['g_odds']}', 
					'{$list['g_jiner']}', 
					'{$list['g_tueishui']}',
					'{$list['g_tueishui_1']}',
					'{$list['g_tueishui_2']}',
					'{$list['g_tueishui_3']}',
					'{$list['g_tueishui_4']}',
					'{$list['g_distribution']}',
					'{$list['g_distribution_1']}',
					'{$list['g_distribution_2']}',
					'{$list['g_distribution_3']}',
					'{$list['g_distribution_4']}',
					 '{$mxsha1}',
					 '{$mxmd}')";
	$insertId = $db->query($sql, 4);
	return $insertId;
}
/**
 * 修改用戶可用額
 * Enter description here ...
 * @param unknown_type $kMoney 修改額度
 * @param unknown_type $userName 用戶名
 */
function upUserKyYongEr ($kMoney, $userName)
{
	$db = new DB();
	$db->query("UPDATE `g_user` SET `g_money_yes` = '{$kMoney}' WHERE `g_name` = '{$userName}' LIMIT 1 ", 2);
}

/**
 * 驗證下注金額是否大於範圍餘額
 * Enter description here ...
 * @param int $money //下注金額
 * @param array $max //用戶限額數組
 */
function isUserMoney ($money, $max,$totalmoney)
{
	if (!is_numeric($money))
		exit("MoneyrError");
	if (!is_numeric($totalmoney))
		exit("MoneyrError");
	if ($totalmoney > $max['KeYongEr'])
		exit(alert_href('抱歉！您的可用餘額不足。', '../left.php'));
	if ($money > $max['DanZhu_XianEr'])
		exit(alert_href('抱歉！您的單注限額為 '.$max['DanZhu_XianEr'], '../left.php'));
	if (($money+$max['DanQi_YiXia']) > $max['DanQi_XianEr'])
		exit(alert_href('抱歉！您的單期限額為 '.$max['DanQi_XianEr'], '../left.php'));
}

/**
 * 判斷號碼是否出現在範圍內、當前期數是否已經封盤
 * Enter description here ...
 * @param String $type 遊戲類型
 * @param String $ball 號碼
 * @param String $number 期數
 * @return Bool、返回值如果是 2，表示傳入的期數已經封盤
 */
function isNumber ($type=null, $ball=null, $number=null)
{
	$bool = false;
	if ($number != null)
	{
		$db = new DB();
		$bool = _isNumberIsNotNull ($db, $ball, $number);
	}
	else if ($type != null)
	{
		if ($type == "第一球" || $type == "第二球" || $type == "第三球" || $type == "第四球" || $type == "第五球" || $type == "第六球" || $type == "第七球" || $type == "第八球" || $type == "總和、龍虎" || $type == "連碼")
			$bool = true;
	}
	return $bool;
}

function _isNumberIsNotNull ($db, $ball, $number)
{
	$bool = false;
	$result = $db->query("SELECT `g_qishu`, `g_feng_date` FROM `g_kaipan` WHERE `g_lock` = 2 ORDER BY g_qishu DESC LIMIT 1 ", 1);
	$endTimes = strtotime($result[0]['g_feng_date']);
	$thisTime =  strtotime(date('Y-m-d H:i:s'));
	if ($result[0]['g_qishu'] != $number || $thisTime > $endTimes)
	{
		return 2;
	}
	if (Matchs::isNumber($ball)) //正整數
	{
		if ($ball <=20 && $ball >=1)
			$bool = true;
	}
	else 
	{
		switch ($ball)
		{
			case '大' : $bool = true; break;
			case '小' : $bool = true; break;
			case '單' : $bool = true; break;
			case '雙' : $bool = true; break;
			case '尾大' : $bool = true; break;
			case '尾小' : $bool = true; break;
			case '合數單' : $bool = true; break;
			case '合數雙' : $bool = true; break;
			case '東' : $bool = true; break;
			case '南' : $bool = true; break;
			case '西' : $bool = true; break;
			case '北' : $bool = true; break;
			case '中' : $bool = true; break;
			case '發' : $bool = true; break;
			case '白' : $bool = true; break;
			case '總和大' : $bool = true; break;
			case '總和小' : $bool = true; break;
			case '總和單' : $bool = true; break;
			case '總和雙' : $bool = true; break;
			case '總和尾大' : $bool = true; break;
			case '總和尾小' : $bool = true; break;
			case '龍' : $bool = true; break;
			case '虎' : $bool = true; break;
			case '任選二' : $bool = true; break;
			case '選二連直' : $bool = true; break;
			case '選二連組' : $bool = true; break;
			case '任選三' : $bool = true; break;
			case '選三前直' : $bool = true; break;
			case '選三前組' : $bool = true; break;
			case '任選四' : $bool = true; break;
			case '任選五' : $bool = true; break;
		}
	}
	return $bool;
}

function isNumbercq($type, $number)
{
	if ($type == 'Ball_1' || $type == 'Ball_2' || $type == 'Ball_3' || $type == 'Ball_4' || $type == 'Ball_5' || $type == 'Ball_6' || $type == 'Ball_7' || $type == 'Ball_8' || $type == 'Ball_9')
	{
		$db = new DB();
		$result = $db->query("SELECT `g_qishu`, `g_feng_date` FROM `g_kaipan2` WHERE `g_lock` = 2 AND g_qishu = '{$number}' LIMIT 1 ", 1);
		if (!$result || strtotime(date('Y-m-d H:i:s')) > strtotime($result[0]['g_feng_date']))
		{
			exit(alert_href('抱歉！第 '.$number.' 期已經封盤', '../left.php'));
		}
	}
}
function isNumbersz($type, $number)
{
	if ($type == 'Ball_1' || $type == 'Ball_2' || $type == 'Ball_3' || $type == 'Ball_4' || $type == 'Ball_5' || $type == 'Ball_6')
	{
		$db = new DB();
		$result = $db->query("SELECT `g_qishu`, `g_feng_date` FROM `g_kaipan7` WHERE `g_lock` = 2 AND g_qishu = '{$number}' LIMIT 1 ", 1);
		if (!$result || strtotime(date('Y-m-d H:i:s')) > strtotime($result[0]['g_feng_date']))
		{
			exit(alert_href('抱歉！第 '.$number.' 期已經封盤', '../left.php'));
		}
	}
}
function isNumberkl8($type, $number)
{
	if ($type == 'Ball_1' || $type == 'Ball_2' || $type == 'Ball_3' || $type == 'Ball_4' || $type == 'Ball_5' || $type == 'Ball_6' || $type == 'Ball_7' || $type == 'Ball_8')
	{
		$db = new DB();
		$result = $db->query("SELECT `g_qishu`, `g_feng_date` FROM `g_kaipan8` WHERE `g_lock` = 2 AND g_qishu = '{$number}' LIMIT 1 ", 1);
		if (!$result || strtotime(date('Y-m-d H:i:s')) > strtotime($result[0]['g_feng_date']))
		{
			exit(alert_href('抱歉！第 '.$number.' 期已經封盤', '../left.php'));
		}
	}
}

function isBallType($type, $ball, $p=false)
{
	$arr = array();
	
	switch ($type)
	{
		case 'Ball_1': $arr[0] ='第一球';break;
		case 'Ball_2': $arr[0] ='第二球';break;
		case 'Ball_3': $arr[0] ='第三球';break;
		case 'Ball_4': $arr[0] ='第四球';break;
		case 'Ball_5': $arr[0] ='第五球';break;
		case 'Ball_6': $arr[0] ='總和、龍虎和';break;
		case 'Ball_7': $arr[0] ='前三';break;
		case 'Ball_8': $arr[0] ='中三';break;
		case 'Ball_9': $arr[0] ='后三';break;
		default:exit(back('Type is Error'));
	}
	
	if ($type == 'Ball_6')
	{
		switch ($ball)
		{
			case 'bh1' : $p==true ? $arr[0] = '總和大小' : $arr[1] = '總和大';break;
			case 'bh2' : $p==true ? $arr[0] = '總和大小' : $arr[1] = '總和小';break;
			case 'bh3' : $p==true ? $arr[0] = '總和單雙' : $arr[1] = '總和單';break;
			case 'bh4' : $p==true ? $arr[0] = '總和單雙' : $arr[1] = '總和雙';break;
			case 'bh5' : $p==true ? $arr[0] = '龍虎和' : $arr[1] = '龍';break;
			case 'bh6' : $p==true ? $arr[0] = '龍虎和' : $arr[1] = '虎';break;
			case 'bh7' : $p==true ? $arr[0] = '龍虎和' : $arr[1] = '和';break;
			
			case 'fh1' : $p==true ? $arr[0] = '總和大小' : $arr[1] = '總和大';break;
			case 'fh2' : $p==true ? $arr[0] = '總和大小' : $arr[1] = '總和小';break;
			case 'fh3' : $p==true ? $arr[0] = '總和單雙' : $arr[1] = '總和單';break;
			case 'fh4' : $p==true ? $arr[0] = '總和單雙' : $arr[1] = '總和雙';break;
			case 'fh5' : $p==true ? $arr[0] = '龍虎和' : $arr[1] = '龍';break;
			case 'fh6' : $p==true ? $arr[0] = '龍虎和' : $arr[1] = '虎';break;
			case 'fh7' : $p==true ? $arr[0] = '龍虎和' : $arr[1] = '和';break;
			
			default:exit(back('BallType is Error'.$ball));
		}
	}
	else if ($type == 'Ball_7'|| $type == 'Ball_8' || $type == 'Ball_9')
	{
		if ($ball == 'ch1'||$ball == 'dh1'||$ball == 'eh1' ||$ball == 'gh1'||$ball == 'hh1' ||$ball == 'ih1' )
			$arr[1] = '豹子';
		else if ($ball == 'ch2'||$ball == 'dh2'||$ball == 'eh2' ||$ball == 'gh2'||$ball == 'hh2' ||$ball == 'ih2')
			$arr[1] = '順子';
		else if ($ball == 'ch3'||$ball == 'dh3'||$ball == 'eh3' ||$ball == 'gh3'||$ball == 'hh3' ||$ball == 'ih3')
			$arr[1] = '對子';
		else if ($ball == 'ch4'||$ball == 'dh4'||$ball == 'eh4' ||$ball == 'gh4'||$ball == 'hh4' ||$ball == 'ih4')
			$arr[1] = '半順';
		else if ($ball == 'ch5'||$ball == 'dh5'||$ball == 'eh5' ||$ball == 'gh5'||$ball == 'hh5' ||$ball == 'ih5')
			$arr[1] = '雜六';
		else 
			exit(back('BallType is Error'.$ball));
	}
	else 
	{
		switch ($ball)
		{
			case 'ah1' : $arr[1] = 0; break;
			case 'ah2' : $arr[1] = 1; break;
			case 'ah3' : $arr[1] = 2; break;
			case 'ah4' : $arr[1] = 3; break;
			case 'ah5' : $arr[1] = 4; break;
			case 'ah6' : $arr[1] = 5; break;
			case 'ah7' : $arr[1] = 6; break;
			case 'ah8' : $arr[1] = 7; break;
			case 'ah9' : $arr[1] = 8; break;
			case 'ah10' : $arr[1] = 9; break;
			case 'ah11' : $arr[1] = '大'; break;
			case 'ah12' : $arr[1] = '小'; break;
			case 'ah13' : $arr[1] = '單'; break;
			case 'ah14' : $arr[1] = '雙'; break;
			
			
			case 'bh1' : $arr[1] = 0; break;
			case 'bh2' : $arr[1] = 1; break;
			case 'bh3' : $arr[1] = 2; break;
			case 'bh4' : $arr[1] = 3; break;
			case 'bh5' : $arr[1] = 4; break;
			case 'bh6' : $arr[1] = 5; break;
			case 'bh7' : $arr[1] = 6; break;
			case 'bh8' : $arr[1] = 7; break;
			case 'bh9' : $arr[1] = 8; break;
			case 'bh10' : $arr[1] = 9; break;
			case 'bh11' : $arr[1] = '大'; break;
			case 'bh12' : $arr[1] = '小'; break;
			case 'bh13' : $arr[1] = '單'; break;
			case 'bh14' : $arr[1] = '雙'; break;
			
			case 'ch1' : $arr[1] = '0'; break;
			case 'ch2' : $arr[1] = '1'; break;
			case 'ch3' : $arr[1] = '2'; break;
			case 'ch4' : $arr[1] = '3'; break;
			case 'ch5' : $arr[1] = '4'; break;
			case 'ch6' : $arr[1] = '5'; break;
			case 'ch7' : $arr[1] = '6'; break;
			case 'ch8' : $arr[1] = '7'; break;
			case 'ch9' : $arr[1] = '8'; break;
			case 'ch10' : $arr[1] = '9'; break;
			case 'ch11' : $arr[1] = '大'; break;
			case 'ch12' : $arr[1] = '小'; break;
			case 'ch13' : $arr[1] = '單'; break;
			case 'ch14' : $arr[1] = '雙'; break;
			
			case 'dh1' : $arr[1] = '0'; break;
			case 'dh2' : $arr[1] = '1'; break;
			case 'dh3' : $arr[1] = '2'; break;
			case 'dh4' : $arr[1] = '3'; break;
			case 'dh5' : $arr[1] = '4'; break;
			case 'dh6' : $arr[1] = '5'; break;
			case 'dh7' : $arr[1] = '6'; break;
			case 'dh8' : $arr[1] = '7'; break;
			case 'dh9' : $arr[1] = '8'; break;
			case 'dh10' : $arr[1] = '9'; break;
			case 'dh11' : $arr[1] = '大'; break;
			case 'dh12' : $arr[1] = '小'; break;
			case 'dh13' : $arr[1] = '單'; break;
			case 'dh14' : $arr[1] = '雙'; break;
			
			case 'eh1' : $arr[1] = '0'; break;
			case 'eh2' : $arr[1] = '1'; break;
			case 'eh3' : $arr[1] = '2'; break;
			case 'eh4' : $arr[1] = '3'; break;
			case 'eh5' : $arr[1] = '4'; break;
			case 'eh6' : $arr[1] = '5'; break;
			case 'eh7' : $arr[1] = '6'; break;
			case 'eh8' : $arr[1] = '7'; break;
			case 'eh9' : $arr[1] = '8'; break;
			case 'eh10' : $arr[1] = '9'; break;
			case 'eh11' : $arr[1] = '大'; break;
			case 'eh12' : $arr[1] = '小'; break;
			case 'eh13' : $arr[1] = '單'; break;
			case 'eh14' : $arr[1] = '雙'; break;
			default:exit(back('BallType is Error'.$ball));
		}
	}
	return $arr;
}
function SzTypeName()
{
	return array("","魚","蝦","葫蘆","金錢","螃蟹","雞");	
}
function isYxxType($type1,$number){
	$arr=array("","<font color=#ff0000>魚</font>","<font color=#1a843c>蝦</font>","<font color=#0000ff>葫蘆</font>","<font color=#0000ff>金錢</font>","<font color=#1a843c>螃蟹</font>","<font color=#ff0000>雞</font>");
	if($type1=='三军')
		return $number.'/'.$arr[intval($number)];
	else
		return $number;
}
function isSzType($ball, $type,$yxx=false){
	switch ($ball){
		case 'Ball_1': $arr[0] ='三军';break;
		case 'Ball_2': $arr[0] ='三军';break;
		case 'Ball_3': $arr[0] ='圍骰';break;
		case 'Ball_4': $arr[0] ='點數';break;
		case 'Ball_5': $arr[0] ='長牌';break;
		case 'Ball_6': $arr[0] ='短牌';break;
	}
	switch ($type){
		case "ah1":$arr[1]="1".($yxx?"/<font color=#ff0000>魚</font>":"");break;
		case "ah2":$arr[1]="2".($yxx?"/<font color=#1a843c>蝦</font>":"");break;
		case "ah3":$arr[1]="3".($yxx?"/<font color=#0000ff>葫蘆</font>":"");break;
		case "ah4":$arr[1]="4".($yxx?"/<font color=#0000ff>金錢</font>":"");break;
		case "ah5":$arr[1]="5".($yxx?"/<font color=#1a843c>螃蟹</font>":"");break;
		case "ah6":$arr[1]="6".($yxx?"/<font color=#ff0000>雞</font>":"");break;
		
		case "bh1":$arr[1]="大";break;
		case "bh2":$arr[1]="小";break;
		
		case "ch1":$arr[1]="1";break;
		case "ch2":$arr[1]="2";break;
		case "ch3":$arr[1]="3";break;
		case "ch4":$arr[1]="4";break;
		case "ch5":$arr[1]="5";break;
		case "ch6":$arr[1]="6";break;
		case "ch7":$arr[1]="全骰";break;
		
		case "dh1":$arr[1]="4";break;
		case "dh2":$arr[1]="5";break;
		case "dh3":$arr[1]="6";break;
		case "dh4":$arr[1]="7";break;
		case "dh5":$arr[1]="8";break;
		case "dh6":$arr[1]="9";break;
		case "dh7":$arr[1]="10";break;
		case "dh8":$arr[1]="11";break;
		case "dh9":$arr[1]="12";break;
		case "dh10":$arr[1]="13";break;
		case "dh11":$arr[1]="14";break;
		case "dh12":$arr[1]="15";break;
		case "dh13":$arr[1]="16";break;
		case "dh14":$arr[1]="17";break;
		
		case "eh1":$arr[1]="1,2";break;
		case "eh2":$arr[1]="1,3";break;
		case "eh3":$arr[1]="1,4";break;
		case "eh4":$arr[1]="1,5";break;
		case "eh5":$arr[1]="1,6";break;
		case "eh6":$arr[1]="2,3";break;
		case "eh7":$arr[1]="2,4";break;
		case "eh8":$arr[1]="2,5";break;
		case "eh9":$arr[1]="2,6";break;
		case "eh10":$arr[1]="3,4";break;
		case "eh11":$arr[1]="3,5";break;
		case "eh12":$arr[1]="3,6";break;
		case "eh13":$arr[1]="4,5";break;
		case "eh14":$arr[1]="4,6";break;
		case "eh15":$arr[1]="5,6";break;
		
		case "fh1":$arr[1]="1";break;
		case "fh2":$arr[1]="2";break;
		case "fh3":$arr[1]="3";break;
		case "fh4":$arr[1]="4";break;
		case "fh5":$arr[1]="5";break;
		case "fh6":$arr[1]="6";break;		

	}
	return $arr;
//	return $arr;
}
function isKl8Type($ball, $type){
	switch ($ball){
		case 'Ball_1': $arr[0] ='正碼';break;
		case 'Ball_2': $arr[0] ='總和大小';break;
		case 'Ball_3': $arr[0] ='總和單雙';break;
		case 'Ball_4': $arr[0] ='總和和局';break;
		case 'Ball_5': $arr[0] ='總和過關';break;
		case 'Ball_6': $arr[0] ='前後和';break;
		case 'Ball_7': $arr[0] ='單雙和';break;
		case 'Ball_8': $arr[0] ='五行';break;
	}
	switch ($type){
		case "zhdx1":$arr[1]="總和大";break;
		case "zhdx2":$arr[1]="總和小";break;
		case "zhds1":$arr[1]="總和單";break;
		case "zhds2":$arr[1]="總和雙";break;
		case "zhhj1":$arr[1]="總和810";break;
		case "gg1":$arr[1]="總大單";break;
		case "gg2":$arr[1]="總大雙";break;
		case "gg3":$arr[1]="總小單";break;
		case "gg4":$arr[1]="總小雙";break;
		case "zhh1":$arr[1]="前(多)";break;
		case "zhh2":$arr[1]="後(多)";break;
		case "zhh3":$arr[1]="前後(和)";break;
		case "dsh1":$arr[1]="單(多)";break;
		case "dsh2":$arr[1]="雙(多)";break;
		case "dsh3":$arr[1]="單雙(和)";break;
		case "wx1":$arr[1]="金";break;
		case "wx2":$arr[1]="木";break;
		case "wx3":$arr[1]="水";break;
		case "wx4":$arr[1]="火";break;
		case "wx5":$arr[1]="土";break;
		default:$arr[1]=sprintf("%02d",str_replace("h","",$type));break;
	}
	return $arr;
}



function isBallTypecqsm($type, $ball, $p=false)
{

	$arr = array();
	switch ($type)
	{
		case 'Ball_1': $arr[0] ='第一球';break;
		case 'Ball_2': $arr[0] ='第二球';break;
		case 'Ball_3': $arr[0] ='第三球';break;
		case 'Ball_4': $arr[0] ='第四球';break;
		case 'Ball_5': $arr[0] ='第五球';break;
		case 'Ball_6': $arr[0] ='總和、龍虎和';break;
		case 'Ball_7': $arr[0] ='前三';break;
		case 'Ball_8': $arr[0] ='中三';break;
		case 'Ball_9': $arr[0] ='后三';break;
		default:exit(back('Type is Error'));
	}
	
	if ($type == 'Ball_6')
	{
		switch ($ball)
		{
			case 'fh1' : $p==true ? $arr[0] = '總和大小' : $arr[1] = '總和大';break;
			case 'fh2' : $p==true ? $arr[0] = '總和大小' : $arr[1] = '總和小';break;
			case 'fh3' : $p==true ? $arr[0] = '總和單雙' : $arr[1] = '總和單';break;
			case 'fh4' : $p==true ? $arr[0] = '總和單雙' : $arr[1] = '總和雙';break;
			case 'fh5' : $p==true ? $arr[0] = '龍虎和' : $arr[1] = '龍';break;
			case 'fh6' : $p==true ? $arr[0] = '龍虎和' : $arr[1] = '虎';break;
			case 'fh7' : $p==true ? $arr[0] = '龍虎和' : $arr[1] = '和';break;
			default:exit(back('BallType is Error'.$ball));
		}
		}
else if ($type == 'Ball_7')
	{
		switch ($ball)
		{
			case 'gh1' : $p==true ? $arr[0] = '前三' : $arr[1] = '豹子';break;
			case 'gh2' : $p==true ? $arr[0] = '前三' : $arr[1] = '順子';break;
			case 'gh3' : $p==true ? $arr[0] = '前三' : $arr[1] = '對子';break;
			case 'gh4' : $p==true ? $arr[0] = '前三' : $arr[1] = '半順';break;
			case 'gh5' : $p==true ? $arr[0] = '前三' : $arr[1] = '雜六';break;

			default:exit(back('BallType is Error'.$ball));
		}
	}


	 else if ($type == 'Ball_8')
	{
		switch ($ball)
		{
			case 'hh1' : $p==true ? $arr[0] = '中三' : $arr[1] = '豹子';break;
			case 'hh2' : $p==true ? $arr[0] = '中三' : $arr[1] = '順子';break;
			case 'hh3' : $p==true ? $arr[0] = '中三' : $arr[1] = '對子';break;
			case 'hh4' : $p==true ? $arr[0] = '中三' : $arr[1] = '半順';break;
			case 'hh5' : $p==true ? $arr[0] = '中三' : $arr[1] = '雜六';break;

			default:exit(back('BallType is Error'.$ball));
		}
	}

		else if ($type == 'Ball_9')
	{
		switch ($ball)
		{
			case 'ih1' : $p==true ? $arr[0] = '后三' : $arr[1] = '豹子';break;
			case 'ih2' : $p==true ? $arr[0] = '后三' : $arr[1] = '順子';break;
			case 'ih3' : $p==true ? $arr[0] = '后三' : $arr[1] = '對子';break;
			case 'ih4' : $p==true ? $arr[0] = '后三' : $arr[1] = '半順';break;
			case 'ih5' : $p==true ? $arr[0] = '后三' : $arr[1] = '雜六';break;

			//default:exit(back('BallType is Error'.$ball));
			exit(back('BallType is Error'.$ball));
			}
	}
	else 
	{
		switch ($ball)
		{
			case 'ah1' : $arr[1] = '0'; break;
			case 'ah2' : $arr[1] = '1'; break;
			case 'ah3' : $arr[1] = '2'; break;
			case 'ah4' : $arr[1] = '3'; break;
			case 'ah5' : $arr[1] = '4'; break;
			case 'ah6' : $arr[1] = '5'; break;
			case 'ah7' : $arr[1] = '6'; break;
			case 'ah8' : $arr[1] = '7'; break;
			case 'ah9' : $arr[1] = '8'; break;
			case 'ah10' : $arr[1] = '9'; break;
			case 'ah11' : $arr[1] = '大'; break;
			case 'ah12' : $arr[1] = '小'; break;
			case 'ah13' : $arr[1] = '單'; break;
			case 'ah14' : $arr[1] = '雙'; break;
			
			case 'bh1' : $arr[1] = 0; break;
			case 'bh2' : $arr[1] = 1; break;
			case 'bh3' : $arr[1] = 2; break;
			case 'bh4' : $arr[1] = 3; break;
			case 'bh5' : $arr[1] = 4; break;
			case 'bh6' : $arr[1] = 5; break;
			case 'bh7' : $arr[1] = 6; break;
			case 'bh8' : $arr[1] = 7; break;
			case 'bh9' : $arr[1] = 8; break;
			case 'bh10' : $arr[1] = 9; break;
			case 'bh11' : $arr[1] = '大'; break;
			case 'bh12' : $arr[1] = '小'; break;
			case 'bh13' : $arr[1] = '單'; break;
			case 'bh14' : $arr[1] = '雙'; break;

			case 'ch1' : $arr[1] = '0'; break;
			case 'ch2' : $arr[1] = '1'; break;
			case 'ch3' : $arr[1] = '2'; break;
			case 'ch4' : $arr[1] = '3'; break;
			case 'ch5' : $arr[1] = '4'; break;
			case 'ch6' : $arr[1] = '5'; break;
			case 'ch7' : $arr[1] = '6'; break;
			case 'ch8' : $arr[1] = '7'; break;
			case 'ch9' : $arr[1] = '8'; break;
			case 'ch10' : $arr[1] = '9'; break;
			case 'ch11' : $arr[1] = '大'; break;
			case 'ch12' : $arr[1] = '小'; break;
			case 'ch13' : $arr[1] = '單'; break;
			case 'ch14' : $arr[1] = '雙'; break;
			
			case 'dh1' : $arr[1] = '0'; break;
			case 'dh2' : $arr[1] = '1'; break;
			case 'dh3' : $arr[1] = '2'; break;
			case 'dh4' : $arr[1] = '3'; break;
			case 'dh5' : $arr[1] = '4'; break;
			case 'dh6' : $arr[1] = '5'; break;
			case 'dh7' : $arr[1] = '6'; break;
			case 'dh8' : $arr[1] = '7'; break;
			case 'dh9' : $arr[1] = '8'; break;
			case 'dh10' : $arr[1] = '9'; break;
			case 'dh11' : $arr[1] = '大'; break;
			case 'dh12' : $arr[1] = '小'; break;
			case 'dh13' : $arr[1] = '單'; break;
			case 'dh14' : $arr[1] = '雙'; break;
			
			case 'eh1' : $arr[1] = '0'; break;
			case 'eh2' : $arr[1] = '1'; break;
			case 'eh3' : $arr[1] = '2'; break;
			case 'eh4' : $arr[1] = '3'; break;
			case 'eh5' : $arr[1] = '4'; break;
			case 'eh6' : $arr[1] = '5'; break;
			case 'eh7' : $arr[1] = '6'; break;
			case 'eh8' : $arr[1] = '7'; break;
			case 'eh9' : $arr[1] = '8'; break;
			case 'eh10' : $arr[1] = '9'; break;
			case 'eh11' : $arr[1] = '大'; break;
			case 'eh12' : $arr[1] = '小'; break;
			case 'eh13' : $arr[1] = '單'; break;
			case 'eh14' : $arr[1] = '雙'; break;
			
			
			
			
			
			
			default:exit(back('BallType is Error'.$ball));
		}
	}
	return $arr;
}


function isBallTypecqsz($type, $ball, $p=false)
{
	$arr = array();
	switch ($type)
	{
		case 'Ball_1': $arr[0] ='第一球';break;
		case 'Ball_2': $arr[0] ='第二球';break;
		case 'Ball_3': $arr[0] ='第三球';break;
		case 'Ball_4': $arr[0] ='第四球';break;
		case 'Ball_5': $arr[0] ='第五球';break;
		case 'Ball_6': $arr[0] ='總和、龍虎和';break;
		default:exit(back('Type is Error'));
	}
	
	if ($type == 'Ball_6')
	{
		switch ($ball)
		{
			case 'fh1' : $p==true ? $arr[0] = '總和大小' : $arr[1] = '總和大';break;
			case 'fh2' : $p==true ? $arr[0] = '總和大小' : $arr[1] = '總和小';break;
			case 'fh3' : $p==true ? $arr[0] = '總和單雙' : $arr[1] = '總和單';break;
			case 'fh4' : $p==true ? $arr[0] = '總和單雙' : $arr[1] = '總和雙';break;
			case 'fh5' : $p==true ? $arr[0] = '龍虎和' : $arr[1] = '龍';break;
			case 'fh6' : $p==true ? $arr[0] = '龍虎和' : $arr[1] = '虎';break;
			case 'fh7' : $p==true ? $arr[0] = '龍虎和' : $arr[1] = '和';break;
			default:exit(back('BallType is Error'.$ball));
		}
	}
	else 
	{
		switch ($ball)
		{
			case 'ah1' : $arr[1] = 0; break;
			case 'ah2' : $arr[1] = 1; break;
			case 'ah3' : $arr[1] = 2; break;
			case 'ah4' : $arr[1] = 3; break;
			case 'ah5' : $arr[1] = 4; break;
			case 'ah6' : $arr[1] = 5; break;
			case 'ah7' : $arr[1] = 6; break;
			case 'ah8' : $arr[1] = 7; break;
			case 'ah9' : $arr[1] = 8; break;
			case 'ah10' : $arr[1] = 9; break;
			
			case 'bh1' : $arr[1] = 0; break;
			case 'bh2' : $arr[1] = 1; break;
			case 'bh3' : $arr[1] = 2; break;
			case 'bh4' : $arr[1] = 3; break;
			case 'bh5' : $arr[1] = 4; break;
			case 'bh6' : $arr[1] = 5; break;
			case 'bh7' : $arr[1] = 6; break;
			case 'bh8' : $arr[1] = 7; break;
			case 'bh9' : $arr[1] = 8; break;
			case 'bh10' : $arr[1] = 9; break;
		
			case 'ch1' : $arr[1] = 0; break;
			case 'ch2' : $arr[1] = 1; break;
			case 'ch3' : $arr[1] = 2; break;
			case 'ch4' : $arr[1] = 3; break;
			case 'ch5' : $arr[1] = 4; break;
			case 'ch6' : $arr[1] = 5; break;
			case 'ch7' : $arr[1] = 6; break;
			case 'ch8' : $arr[1] = 7; break;
			case 'ch9' : $arr[1] = 8; break;
			case 'ch10' : $arr[1] = 9; break;
		
			case 'dh1' : $arr[1] = 0; break;
			case 'dh2' : $arr[1] = 1; break;
			case 'dh3' : $arr[1] = 2; break;
			case 'dh4' : $arr[1] = 3; break;
			case 'dh5' : $arr[1] = 4; break;
			case 'dh6' : $arr[1] = 5; break;
			case 'dh7' : $arr[1] = 6; break;
			case 'dh8' : $arr[1] = 7; break;
			case 'dh9' : $arr[1] = 8; break;
			case 'dh10' : $arr[1] = 9; break;
			
			case 'eh1' : $arr[1] = 0; break;
			case 'eh2' : $arr[1] = 1; break;
			case 'eh3' : $arr[1] = 2; break;
			case 'eh4' : $arr[1] = 3; break;
			case 'eh5' : $arr[1] = 4; break;
			case 'eh6' : $arr[1] = 5; break;
			case 'eh7' : $arr[1] = 6; break;
			case 'eh8' : $arr[1] = 7; break;
			case 'eh9' : $arr[1] = 8; break;
			case 'eh10' : $arr[1] = 9; break;
			default:exit(back('BallType is Error'.$ball));
		}
	}
	return $arr;
}
function isNumberpk ($type=null, $ball=null, $number=null)
{
	$bool = false;
	if ($number != null)
	{
		$db = new DB();
		$bool = _isNumberIsNotNullpk ($db, $ball, $number);
	}
	else if ($type != null)
	{
		if ($type == "冠军" || $type == "亚军" || $type == "第三名" || $type == "第四名" || $type == "第五名" || $type == "第六名" || $type == "第七名" || $type == "第八名"|| $type == "第九名"|| $type == "第十名" || $type == "總和、龍虎" || $type == "連碼"||$type == "總和、家禽野兽" )
			$bool = true;
	}
	return $bool;
}
function _isNumberIsNotNullpk ($db, $ball, $number)
{
	$bool = false;
	$result = $db->query("SELECT `g_qishu`, `g_feng_date` FROM `g_kaipan6` WHERE `g_lock` = 2 ORDER BY g_qishu DESC LIMIT 1 ", 1);
	$endTimes = strtotime($result[0]['g_feng_date']);
	$thisTime =  strtotime(date('Y-m-d H:i:s'));
	if ($result[0]['g_qishu'] != $number || $thisTime > $endTimes)
	{
		return 2;
	}
	if (Matchs::isNumber($ball)) //正整數
	{
		if ($ball <=20 && $ball >=1)
			$bool = true;
	}
	else 
	{
		switch ($ball)
		{
			case '大' : $bool = true; break;
			case '小' : $bool = true; break;
			case '單' : $bool = true; break;
			case '雙' : $bool = true; break;
			case '冠亞和大' : $bool = true; break;
			case '冠亞和小' : $bool = true; break;
			case '冠亞和單' : $bool = true; break;
			case '冠亞和雙' : $bool = true; break;
			case '冠亞和龍' : $bool = true; break;
			case '冠亞和虎' : $bool = true; break;
			case '龍' : $bool = true; break;
			case '虎' : $bool = true; break;		
		}
	}
	return $bool;
}

?>