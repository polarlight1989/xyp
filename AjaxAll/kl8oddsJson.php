<?php
//echo "222";
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
if ($_SERVER["REQUEST_METHOD"] != "POST") {exit;}
include_once ROOT_PATH.'functioned/cheCookie.php';

global $user;
$tid = $_POST['tid'];

if ($tid == 1)
{
	$db = new DB();
	//最新開獎記錄
	$sql = "SELECT  g_qishu,g_ball_1,g_ball_2,g_ball_3,g_ball_4,g_ball_5,g_ball_6,g_ball_7,g_ball_8,g_ball_9,g_ball_10,g_ball_11,g_ball_12,g_ball_13,g_ball_14,g_ball_15,g_ball_16,g_ball_17,g_ball_18,g_ball_19,g_ball_20 FROM g_history8 WHERE g_ball_1 is not null ORDER BY g_date DESC LIMIT 1";
	$result = $db->query($sql, 0);
	$number = $result[0][0];
	$ballArr = array();
	for ($i=0; $i<count($result[0]); $i++)
	{
		if ($i != 0)
			$ballArr[] = $result[0][$i];
	}
	$ballArr = json_encode($ballArr);
	$winMoney = json_encode(getWin ($user));
	//雙面
	$startDate = date('Y-m-d').' 00:00';
	$endDate = date('Y-m-d').' 24:00';
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$sql = "SELECT g_qishu,g_ball_1, g_ball_2, g_ball_3, g_ball_4, g_ball_5, g_ball_6, g_ball_7, g_ball_8, g_ball_9, g_ball_10,g_ball_11, g_ball_12, g_ball_13, g_ball_14, g_ball_15, g_ball_16, g_ball_17, g_ball_18, g_ball_19, g_ball_20 FROM `g_history8` WHERE {$date} and g_ball_1 is not null ORDER BY g_date desc limit 45 ";
	$result=$db->query($sql, 1);
	$sm=sum_ball_count_kl8($result);
	$sm = json_encode($sm);
	//路途
	$numArray1=array();
	$len=count($result);
	$result=array_reverse($result);
	if($len>=1)
	{
		for($i=0;$i<$len;$i++)
		{
			$rs=$result[$i];
			
			$zh=$rs['g_ball_1']+$rs['g_ball_2']+$rs['g_ball_3']+$rs['g_ball_4']+$rs['g_ball_5']+$rs['g_ball_6']+$rs['g_ball_7']+$rs['g_ball_8']+$rs['g_ball_9']+$rs['g_ball_10']+$rs['g_ball_11']+$rs['g_ball_12']+$rs['g_ball_13']+$rs['g_ball_14']+$rs['g_ball_15']+$rs['g_ball_16']+$rs['g_ball_17']+$rs['g_ball_18']+$rs['g_ball_19']+$rs['g_ball_20'];
			$arr=array($rs['g_ball_1'],$rs['g_ball_2'],$rs['g_ball_3'],$rs['g_ball_4'],$rs['g_ball_5'],$rs['g_ball_6'],$rs['g_ball_7'],$rs['g_ball_8'],$rs['g_ball_9'],$rs['g_ball_10'],$rs['g_ball_11'],$rs['g_ball_12'],$rs['g_ball_13'],$rs['g_ball_14'],$rs['g_ball_15'],$rs['g_ball_16'],$rs['g_ball_17'],$rs['g_ball_18'],$rs['g_ball_19'],$rs['g_ball_20']);
			$zhdx=($zh==810?'和':($zh>810?'大':'小'));
			$zhds=($zh==810?'和':($zh%2==0?'雙':'單'));
			$r=GetKl8ZhDs($arr);
			if($r[0]>$r[1])
				$dsh='單';
			elseif($r[0]<$r[1])
				$dsh='雙';	
			else
				$dsh='和';
			$r=GetKl8Qs($arr);
			if($r[0]>$r[1])
				$qhh='前';
			elseif($r[0]<$r[1])
				$qhh='後';	
			else
				$qhh='和';	
			if($zh>=210 &&  $zh<=695)
				$wx="金";
			elseif($zh>=696 &&  $zh<=763)
				$wx="木";
			elseif($zh>=764 &&  $zh<=855)
				$wx="水";
			elseif($zh>=856 &&  $zh<=923)
				$wx="火";
			elseif($zh>=924 &&  $zh<=1410)
				$wx="土";
			$numArray1[]=array($zh,$zhdx,$zhds,$wx,$qhh,$dsh);	
		}
		$row1="<td valign=top class='z_cl'>".$numArray1[0][0];
		$row2="<td valign=top class='z_cl'>".$numArray1[0][1];
		$row3="<td valign=top class='z_cl'>".$numArray1[0][2];
		$row4="<td valign=top class='z_cl'>".$numArray1[0][3];
		$row5="<td valign=top class='z_cl'>".$numArray1[0][4];
		$row6="<td valign=top class='z_cl'>".$numArray1[0][5];
		for($k=1;$k<$len;$k++)
		{
			if($numArray1[$k][0]==$numArray1[$k-1][0])
				$row1.='<br>'.$numArray1[$k][0];
			else
				$row1.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][0];		
			if($numArray1[$k][1]==$numArray1[$k-1][1])
				$row2.='<br>'.$numArray1[$k][1];
			else
				$row2.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][1];	
			if($numArray1[$k][2]==$numArray1[$k-1][2])
				$row3.='<br>'.$numArray1[$k][2];
			else
				$row3.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][2];	
			if($numArray1[$k][3]==$numArray1[$k-1][3])
				$row4.='<br>'.$numArray1[$k][3];
			else
				$row4.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][3];	
			if($numArray1[$k][4]==$numArray1[$k-1][4])
				$row5.='<br>'.$numArray1[$k][4];
			else
				$row5.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][4]; //hhg
			if($numArray1[$k][5]==$numArray1[$k-1][5])
				$row6.='<br>'.$numArray1[$k][5];
			else
				$row6.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][5];
		}
	}
	
	$row1.="</td>";
	$row2.="</td>";
	$row3.="</td>";
	$row4.="</td>";
	$row5.="</td>";
	$row6.="</td>";
	$row1Arr=explode(',',$row1);
	$row2Arr=explode(',',$row2);
	$row3Arr=explode(',',$row3);
	$row4Arr=explode(',',$row4);
	$row5Arr=explode(',',$row5);
	$row6Arr=explode(',',$row6);
	$td = array();
	for ($i=0; $i<25; $i++)
	{
		$td[] ='<td class="z_cl"></td>';
	}
	$row1Arr = array_merge($td,$row1Arr);
	$row1Arr = array_slice($row1Arr, -25);
	$row2Arr = array_merge($td,$row2Arr);
	$row2Arr = array_slice($row2Arr, -25);
	$row3Arr = array_merge($td,$row3Arr);
	$row3Arr = array_slice($row3Arr, -25);
	$row4Arr = array_merge($td,$row4Arr);
	$row4Arr = array_slice($row4Arr, -25);
	$row5Arr = array_merge($td,$row5Arr);
	$row5Arr = array_slice($row5Arr, -25);
	$row6Arr = array_merge($td,$row6Arr);
	$row6Arr = array_slice($row6Arr, -25);
	$row1=json_encode(join("",$row1Arr));
	$row2=json_encode(join("",$row2Arr));
	$row3=json_encode(join("",$row3Arr));
	$row4=json_encode(join("",$row4Arr));
	$row5=json_encode(join("",$row5Arr));
	$row6=json_encode(join("",$row6Arr));
	echo <<<JSON
			{
				"winMoney" : $winMoney,
				"number" : $number,
				"ballArr" : $ballArr,
				"sm" : $sm,
				"row1": $row1,
				"row2": $row2,
				"row3": $row3,
				"row4": $row4,
				"row5": $row5,
				"row6": $row6
			}
JSON;
exit;
}
else if ($tid == 2)
{
	//獲取封盤時間、開獎時間、刷新時間
	$db = new DB();
	$result = $db->query("SELECT `g_qishu`, `g_feng_date`, `g_open_date` FROM g_kaipan8 WHERE `g_lock` = 2 LIMIT 1 ", 1);
	if ($result && Copyright)
	{
		$endTime = strtotime($result[0]['g_feng_date']) - time();
		$openTime =  strtotime($result[0]['g_open_date']) - time();
		$Phases = $result[0]['g_qishu'];
		$RefreshTime = 90; //刷新時間
		$db=new DB();
		
		$sql = "SELECT *  FROM `g_odds8` ORDER BY g_id ASC ";
		$eresult = $db->query($sql, 1);
		$list = $eresult;
		$oddsMax = 0;
		$arrList = array();
		$len=array(80,2,2,1,4,3,3,5);
		for ($i=0; $i<count($list); $i++){
			$k=0;
			foreach ($list[$i] as $key=>$value){
				if($key!="g_type" && $key!="g_id")
				{
					$arrList[$i][$key] = setoddskl8($key, $value, $user, 1,$list[$i]["g_type"]);
					if($k>=$len[$i]) break;
					$k++;
				}
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
	$result = $db->query("SELECT `g_qishu` FROM `g_history8` WHERE g_ball_1 is not null ORDER BY g_date DESC LIMIT 1 ", 0);
	$number = $result[0][0];
	echo $number;
}

?>