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

function cqNumber($num, $ball, $p=0)
{
	switch ($num)
	{
		case 0 :
			if ($ball >= 23)
				return $p==0 ? '<font color="red">大</font>' : '總和大';
			else
				return $p==0 ? '<font color="black">小</font>' : '總和小';
		case 1 :
		
			if ($ball % 2 == 0)
				return $p==0 ? '<font color="red">雙</font>' : '總和雙';
			else 
				return $p==0 ? '<font color="black">單</font>' : '總和單';
		case 2 :
	
			if ($ball[0] == $ball[1])
				return $p==0 ? '<font color="seagreen">和</font>' : '和';
			else if ($ball[0] > $ball[1])
				return $p==0 ? '<font color="red">龍</font>' : '龍';
			else 
				return $p==0 ? '<font color="black">虎</font>' : '虎';
		case 3 :
			if ($ball >= 5)
				return $p==0 ? '<font color="red">大</font>' : '大';
			else
				return $p==0 ? '<font color="black">小</font>' : '小';
		case 4 :
			if ($ball % 2 == 0)
				return $p==0 ? '<font color="red">雙</font>' : '雙';
			else 
				return $p==0 ? '<font color="black">單</font>' : '單';
		case 5 :
			if ($ball >= 23)
				return $p==0 ? '<font color="red">大</font>' : '大';
			else
				return $p==0 ? '<font color="black">小</font>' : '小';
		case 6 :
			if ($ball % 2 == 0)
				return $p==0 ? '<font color="red">雙</font>' : '雙';
			else 
				return $p==0 ? '<font color="black">單</font>' : '單';
	}
}

function cqNumberString($arr)
{
	sort($arr);
	if ($arr[0] == $arr[1] && $arr[0] == $arr[2])
		return '豹子';
		
	if ($arr[0] == $arr[1] || $arr[0] == $arr[2] || $arr[1] == $arr[0] || $arr[1] == $arr[2])
		return '對子';
		
	$a = join('', $arr);
	if ($a == '019' || $a == '091'|| $a == '098'|| $a == '089'|| $a == '109' || $a == '190' || $a == '901'|| $a == '910'|| $a == '809' || $a == '890' || sorts($arr, 3))
		return '順子';
		
	$match = '/.09|0.9/';
	if (preg_match($match, $a) || sorts($arr, 2))
		return '半順';
	
	return '雜六';
		
}

function sorts($a, $p)
{
	$i = 0; $tmp=0; 
	foreach ($a as $k=>$v)
	{
	    if($v == $a[$k-1]+1 || $v == $a[$k+1]-1)
	    {
	        $tmp = $v;
	        if (isset($date[$i]) && end($date[$i])+1 == $tmp) 
	        {
	            $date[$i][] = $tmp;
	        } else {
	            $date[++$i][] = $tmp;
	        }
	    }
	}
	if (count($date[1]) == $p || count($date[2]) == $p)
		$a = true;
	else 
		$a = false;
	return $a;
}

function numberList($gameType, $id=false)
{
	$db = new DB();
	$pageNum = 15;
	$numberList = array();
	$from = $id == true ? "" : "WHERE g_ball_1 is not null";
	if ($gameType == 1)
	{
		$g_history='g_history';
		$total = $db->query("SELECT `g_id` FROM `$g_history` WHERE g_game_id = 1 ", 3);
		$page = new Page($total, $pageNum);
		$sqls="SELECT `g_id`, `g_qishu`, `g_date`, `g_game_id`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8` FROM `$g_history`  {$from} ORDER BY g_qishu DESC {$page->limit} ";
		$result = $db->query($sqls, 1);
		if ($result)
		{
		
			foreach ($result as $key=>$value) {
				$week = GetWeekDay($value['g_date'],0);
	           	$ball_1 ='<td width="26" class="No_gd'.$value['g_ball_1'].'"></td>' ;
				$ball_2 ='<td width="26" class="No_gd'.$value['g_ball_2'].'"></td>' ;
				$ball_3 ='<td width="26" class="No_gd'.$value['g_ball_3'].'"></td>' ;
				$ball_4 ='<td width="26" class="No_gd'.$value['g_ball_4'].'"></td>' ;
				$ball_5 ='<td width="26" class="No_gd'.$value['g_ball_5'].'"></td>' ;
				$ball_6 ='<td width="26" class="No_gd'.$value['g_ball_6'].'"></td>' ;
				$ball_7 ='<td width="26" class="No_gd'.$value['g_ball_7'].'"></td>' ;
				$ball_8 ='<td width="26" class="No_gd'.$value['g_ball_8'].'"></td>' ;
				$ball_count = $value['g_ball_1'] + $value['g_ball_2'] + $value['g_ball_3'] + $value['g_ball_4'] + $value['g_ball_5'] + 
				$value['g_ball_6'] + $value['g_ball_7'] + $value['g_ball_8'];
				$Ball = $ball_1.$ball_2.$ball_3.$ball_4.$ball_5.$ball_6.$ball_7.$ball_8;
				$numberList[$key][0] = $value['g_id'];
				$numberList[$key][1] = $value['g_qishu'];
				$a = explode('-', $value['g_date']);
				$b = explode(' ', $a[2]);
				$c = explode(':', $b[1]);
				$numberList[$key][2] = $a[1].'-'.$b[0].'&nbsp;&nbsp;'.$week.'&nbsp;&nbsp;'.$c[0].':'.$c[1].':'.$c[2];
				$numberList[$key][3] = $Ball;
				$numberList[$key][4] = $ball_count;
				$numberList[$key][5] = SubBall(0, $ball_count);
				$numberList[$key][6] = SubBall(1, $ball_count);
				$numberList[$key][7] = SubBall(2, mb_substr($ball_count, -1));
				$numberList[$key][8] = SubBall(3, array($value['g_ball_1'],$value['g_ball_8']));
			}
		}
	}
	else  if($gameType == 6 || $gameType == 4)
	{
		if($gameType==4) $g_history='g_history4';
		else $g_history='g_history6';
	
	$total = $db->query("SELECT `g_id` FROM `$g_history` WHERE g_game_id = 6 ", 3);
		$page = new Page($total, $pageNum);
		$sqls="SELECT `g_id`, `g_qishu`, `g_date`, `g_game_id`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8`, `g_ball_9`, `g_ball_10` FROM `$g_history`  {$from} ORDER BY g_qishu DESC {$page->limit} ";
		$result = $db->query($sqls, 1);
		if ($result)
		{
		
			foreach ($result as $key=>$value) {
				$week = GetWeekDay($value['g_date'],0);
	            $ball_1 ='<td width="26" class="No_'.$value['g_ball_1'].'"></td>' ;
				$ball_2 ='<td width="26" class="No_'.$value['g_ball_2'].'"></td>' ;
				$ball_3 ='<td width="26" class="No_'.$value['g_ball_3'].'"></td>' ;
				$ball_4 ='<td width="26" class="No_'.$value['g_ball_4'].'"></td>' ;
				$ball_5 ='<td width="26" class="No_'.$value['g_ball_5'].'"></td>' ;
				$ball_6 ='<td width="26" class="No_'.$value['g_ball_6'].'"></td>' ;
				$ball_7 ='<td width="26" class="No_'.$value['g_ball_7'].'"></td>' ;
				$ball_8 ='<td width="26" class="No_'.$value['g_ball_8'].'"></td>' ;
				$ball_9 ='<td width="26" class="No_'.$value['g_ball_9'].'"></td>' ;
				$ball_10 ='<td width="26" class="No_'.$value['g_ball_10'].'"></td>' ;
				$ball_count = $value['g_ball_1'] + $value['g_ball_2'] ;
				$Ball = $ball_1.$ball_2.$ball_3.$ball_4.$ball_5.$ball_6.$ball_7.$ball_8.$ball_9.$ball_10;
				$numberList[$key][0] = $value['g_id'];
				$numberList[$key][1] = $value['g_qishu'];
				$a = explode('-', $value['g_date']);
				$b = explode(' ', $a[2]);
				$c = explode(':', $b[1]);
				$numberList[$key][2] = $a[1].'-'.$b[0].'&nbsp;&nbsp;'.$week.'&nbsp;&nbsp;'.$c[0].':'.$c[1].':'.$c[2];
				$numberList[$key][3] = $Ball;
				$numberList[$key][4] = $ball_count;
				$numberList[$key][5] = SubBallpk(0, $ball_count);
				$numberList[$key][6] = SubBallpk(1, $ball_count);
				
				$numberList[$key][7] = SubBallpk(2, array($value['g_ball_1'],$value['g_ball_10']));
				$numberList[$key][8] = SubBallpk(2, array($value['g_ball_2'],$value['g_ball_9']));
				$numberList[$key][9] = SubBallpk(2, array($value['g_ball_3'],$value['g_ball_8']));
				$numberList[$key][10] = SubBallpk(2, array($value['g_ball_4'],$value['g_ball_7']));
				$numberList[$key][11] = SubBallpk(2, array($value['g_ball_5'],$value['g_ball_6']));
			}
		}
	
	}
	else  if($gameType == 7){
		$color=array(1=>'#ff0000',2=>'#1a843c',3=>'#0000ff',4=>'#0000ff',5=>'#1a843c',6=>'#ff0000');
		$t=SzTypeName();
		$total = $db->query("SELECT `g_id` FROM `g_history7` WHERE g_game_id = 7 ", 3);
		$page = new Page($total, $pageNum);
		$sqls="SELECT `g_id`, `g_qishu`, `g_date`, `g_game_id`, `g_ball_1`, `g_ball_2`, `g_ball_3` FROM `g_history7`  {$from} ORDER BY g_qishu DESC {$page->limit} ";
		$result = $db->query($sqls, 1);
		if ($result)
		{		
			foreach ($result as $key=>$value) {
				$week = GetWeekDay($value['g_date'],0);
	            $ball_1 ='<td width="26" class="No_sz'.$value['g_ball_1'].'"></td>' ;
				$ball_2 ='<td width="26" class="No_sz'.$value['g_ball_2'].'"></td>' ;
				$ball_3 ='<td width="26" class="No_sz'.$value['g_ball_3'].'"></td>' ;
				$ball_1_2 ='<td width="26" style="width:30px;color:'.$color[$value['g_ball_1']].'">'.$t[$value['g_ball_1']].'</td>' ;
				$ball_2_2 ='<td width="26" style="width:30px;color:'.$color[$value['g_ball_2']].'">'.$t[$value['g_ball_2']].'</td>' ;
				$ball_3_2 ='<td width="26" style="width:30px;color:'.$color[$value['g_ball_3']].'">'.$t[$value['g_ball_3']].'</td>' ;
				
				$ball_count = $value['g_ball_1'] + $value['g_ball_2']+ $value['g_ball_3'] ;
				$Ball = $ball_1.$ball_2.$ball_3.$ball_1_2.$ball_2_2.$ball_3_2;
//				dump($Ball);
				$numberList[$key][0] = $value['g_id'];
				$numberList[$key][1] = $value['g_qishu'];
				$a = explode('-', $value['g_date']);
				$b = explode(' ', $a[2]);
				$c = explode(':', $b[1]);
				$numberList[$key][2] = $a[1].'-'.$b[0].'&nbsp;&nbsp;'.$week.'&nbsp;&nbsp;'.$c[0].':'.$c[1].':'.$c[2];
				$numberList[$key][3] = $Ball;
				$numberList[$key][4] = $ball_count;
			
				if ($value['g_ball_1']==$value['g_ball_2']  && $value['g_ball_1']==$value['g_ball_3']){
				//$ball_zs="通吃";
				$numberList[$key][5]='<font color="seagreen">通吃</font>';
				}else{
				$numberList[$key][5] = $ball_count>10?'<font color="red">大</font>':'<font color="black">小</font>';
				}
//				$numberList[$key][6] = SubBallpk(1, $ball_count);
//				
//				$numberList[$key][7] = SubBallpk(2, array($value['g_ball_1'],$value['g_ball_10']));
//				$numberList[$key][8] = SubBallpk(2, array($value['g_ball_2'],$value['g_ball_9']));
//				$numberList[$key][9] = SubBallpk(2, array($value['g_ball_3'],$value['g_ball_8']));
//				$numberList[$key][10] = SubBallpk(2, array($value['g_ball_4'],$value['g_ball_7']));
//				$numberList[$key][11] = SubBallpk(2, array($value['g_ball_5'],$value['g_ball_6']));
			}
		}
	
	}
	else  if($gameType == 8){
		$total = $db->query("SELECT `g_id` FROM `g_history8` WHERE g_ball_1 is not null", 3);
		$page = new Page($total, $pageNum);
		$sqls="SELECT *  from g_history8 where g_ball_1 is not null ORDER BY g_date DESC {$page->limit} ";
		
		$result = $db->query($sqls, 1);
		if ($result)
		{		
			foreach ($result as $key=>$value) {
				$ball_count='';
				$total=0;
				$week = GetWeekDay($value['g_date'],0);
				for($i=1;$i<=20;$i++)
				{
					$total+=intval($value['g_ball_'.$i]);
	            	$ball_count.='<td width="30" class="ballskl8 b'.sprintf('%02d',$value['g_ball_'.$i]).'"></td>' ;
				}
				$Ball = $ball_count;
				$arr=array($value['g_ball_1'],$value['g_ball_2'],$value['g_ball_3'],$value['g_ball_4'],$value['g_ball_5'],$value['g_ball_6'],$value['g_ball_7'],$value['g_ball_8'],$value['g_ball_9'],$value['g_ball_10'],
						$value['g_ball_11'],$value['g_ball_12'],$value['g_ball_13'],$value['g_ball_14'],$value['g_ball_15'],$value['g_ball_16'],$value['g_ball_17'],$value['g_ball_18'],$value['g_ball_19'],$value['g_ball_20']);
				
				$numberList[$key][0] = $value['g_id'];
				$numberList[$key][1] = $value['g_qishu'];
				$a = explode('-', $value['g_date']);
				$b = explode(' ', $a[2]);
				$c = explode(':', $b[1]);
				$numberList[$key][2] = $a[1].'-'.$b[0].'&nbsp;'.$week.'&nbsp;'.$c[0].':'.$c[1].':'.$c[2];
				$numberList[$key][3] = $Ball;
				$numberList[$key][4] = $total;
				$numberList[$key][5] = $total>810?'<font color=red>大</font>':($total<810?'小':'和');
				$numberList[$key][6] = $total%2==0?'<font color=red>雙</font>':"單";
				if($total>=210 && $total<=695)
					$numberList[$key][7]='金';
				elseif($total>=696 &&  $total<=763)
					$numberList[$key][7]='木';
				elseif($total>=764 &&  $total<=855)
					$numberList[$key][7]='水';
				elseif($total>=856 &&  $total<=923)
					$numberList[$key][7]='火';
				elseif($total>=924 &&  $total<=1410)
					$numberList[$key][7]='土';
				$r=GetQs($arr);
				if($r[0]>$r[1])
					$numberList[$key][8]='<font color=red>前(多)</font>';
				elseif($r[0]<$r[1])
					$numberList[$key][8]='後(多)';
				else
					$numberList[$key][8]='<font color=#299A26>前後(和)</font>';	
				$r=GetZhDs($arr);
				if($r[0]>$r[1])
					$numberList[$key][9]='<font color=red>單(多)</font>';
				elseif($r[0]<$r[1])
					$numberList[$key][9]='雙(多)';
				else
					$numberList[$key][9]='<font color=#299A26>單雙(和)</font>';	
				
			}
		}
	
	}else if ($gameType == 9)
	{
		$g_history='g_history9';
		$total = $db->query("SELECT `g_id` FROM `$g_history` WHERE g_game_id = 1 ", 3);
		$page = new Page($total, $pageNum);
		$sqls="SELECT `g_id`, `g_qishu`, `g_date`, `g_game_id`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8` FROM `$g_history`  {$from} ORDER BY g_qishu DESC {$page->limit} ";
		$result = $db->query($sqls, 1);
		if ($result)
		{
		
			foreach ($result as $key=>$value) {
				$week = GetWeekDay($value['g_date'],0);
	           	$ball_1 ='<td width="26" class="No_nc'.$value['g_ball_1'].'"></td>' ;
				$ball_2 ='<td width="26" class="No_nc'.$value['g_ball_2'].'"></td>' ;
				$ball_3 ='<td width="26" class="No_nc'.$value['g_ball_3'].'"></td>' ;
				$ball_4 ='<td width="26" class="No_nc'.$value['g_ball_4'].'"></td>' ;
				$ball_5 ='<td width="26" class="No_nc'.$value['g_ball_5'].'"></td>' ;
				$ball_6 ='<td width="26" class="No_nc'.$value['g_ball_6'].'"></td>' ;
				$ball_7 ='<td width="26" class="No_nc'.$value['g_ball_7'].'"></td>' ;
				$ball_8 ='<td width="26" class="No_nc'.$value['g_ball_8'].'"></td>' ;
				$ball_count = $value['g_ball_1'] + $value['g_ball_2'] + $value['g_ball_3'] + $value['g_ball_4'] + $value['g_ball_5'] + 
				$value['g_ball_6'] + $value['g_ball_7'] + $value['g_ball_8'];
				$Ball = $ball_1.$ball_2.$ball_3.$ball_4.$ball_5.$ball_6.$ball_7.$ball_8;
				$numberList[$key][0] = $value['g_id'];
				$numberList[$key][1] = $value['g_qishu'];
				$a = explode('-', $value['g_date']);
				$b = explode(' ', $a[2]);
				$c = explode(':', $b[1]);
				$numberList[$key][2] = $a[1].'-'.$b[0].'&nbsp;&nbsp;'.$week.'&nbsp;&nbsp;'.$c[0].':'.$c[1].':'.$c[2];
				$numberList[$key][3] = $Ball;
				$numberList[$key][4] = $ball_count;
				$numberList[$key][5] = SubBall(0, $ball_count);
				$numberList[$key][6] = SubBall(1, $ball_count);
				$numberList[$key][7] = SubBall(2, mb_substr($ball_count, -1));
				$numberList[$key][8] = SubBall(3, array($value['g_ball_1'],$value['g_ball_8']));
			}
		}
	}else
	{

		if($gameType==3)
        {		
		$g_history='g_history3'; 
		$g_id1='3';
		}
		elseif($gameType==10) 
		{
		$g_history='g_history10'; 
		$g_id1='10';
		}
		elseif($gameType==11) {
		$g_history='g_history11'; 
		$g_id1='3';
		}else {
		$g_history='g_history2'; 
		$g_id1='2';}
		$total = $db->query("SELECT `g_id` FROM `$g_history` WHERE g_game_id =".$g_id1, 3);
		$page = new Page($total, $pageNum);
		$result = $db->query("SELECT `g_id`, `g_qishu`, `g_date`, `g_game_id`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5` FROM `$g_history` {$from}  ORDER BY g_qishu DESC {$page->limit} ", 1);
		if ($result)
		{
			foreach ($result as $key=>$value) {
				$week = GetWeekDay($value['g_date'],0);
	            $ball_1 ='<td width="26" class="No_cq'.$value['g_ball_1'].'"></td>' ;
				$ball_2 ='<td width="26" class="No_cq'.$value['g_ball_2'].'"></td>' ;
				$ball_3 ='<td width="26" class="No_cq'.$value['g_ball_3'].'"></td>' ;
				$ball_4 ='<td width="26" class="No_cq'.$value['g_ball_4'].'"></td>' ;
				$ball_5 ='<td width="26" class="No_cq'.$value['g_ball_5'].'"></td>' ;
				$Ball = $ball_1.$ball_2.$ball_3.$ball_4.$ball_5;
				$ball_count = $value['g_ball_1'] + $value['g_ball_2'] + $value['g_ball_3'] + $value['g_ball_4'] + $value['g_ball_5'];
				$numberList[$key][0] = $value['g_id'];
				$numberList[$key][1] = $value['g_qishu'];
				$a = explode('-', $value['g_date']);
				$b = explode(' ', $a[2]);
				$c = explode(':', $b[1]);
				$numberList[$key][2] = $a[1].'-'.$b[0].'&nbsp;&nbsp;'.$week.'&nbsp;&nbsp;'.$c[0].':'.$c[1].':'.$c[2];
				$numberList[$key][3] = $Ball;
				$numberList[$key][4] = $ball_count;
				$numberList[$key][5] = cqNumber(0, $ball_count);
				$numberList[$key][6] = cqNumber(1, $ball_count);
				$numberList[$key][7] = cqNumber(2, array($value['g_ball_1'],$value['g_ball_5']));
				$numberList[$key][8] = cqNumberString(array($value['g_ball_1'],$value['g_ball_2'],$value['g_ball_3']));
				$numberList[$key][9] = cqNumberString(array($value['g_ball_2'],$value['g_ball_3'],$value['g_ball_4']));
				$numberList[$key][10] = cqNumberString(array($value['g_ball_3'],$value['g_ball_4'],$value['g_ball_5']));
			}
		}
	}
	$numberList['page'] = $page;
	return $numberList;
}
function GetZhDs($list)
{
	$d=$s=0;
	foreach($list as $v)
	{
		if($v%2==0)
			$s++;
		else
			$d++;	
	}	
	return array($d,$s);
}
function GetQs($list)
{
	$d=$s=0;
	foreach($list as $v)
	{
		if($v<=40)
			$d++;
		else
			$s++;	
	}	
	return array($d,$s);
}
?>