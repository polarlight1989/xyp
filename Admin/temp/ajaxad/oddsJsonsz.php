<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
	include_once ROOT_PATH.'Admin/ExistUser.php';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
	include_once ROOT_PATH.'Admin/ExistUser.php';
	global $Users;
//	dump($Users);
	$db=new DB();
	$mid = $_POST['mid'];
	
	if ($mid == 1)
	{
//		dump("aa");
		include_once ROOT_PATH.'classed/UserReporInfosz.php';
		$userReportInfosz = new UserReportInfosz($Users[0]);
		$result = $userReportInfosz->GetNumberAll();
		$result = json_encode($result);
		$infocq = $userReportInfosz->GetInfosz();
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
		$sql = "SELECT `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`,h15 FROM `g_odds7`  ORDER BY g_id ASC";
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
		$sql = "SELECT g_qishu FROM g_history7 WHERE g_ball_1 is not null AND g_ball_2 is not null ORDER BY g_id DESC LIMIT 1";
		$result = $db->query($sql, 0);
		echo  $result[0][0];
	}
	if ($mid == 4)
	{
		include_once ROOT_PATH.'classed/GamInfo.php';
		$userReportInfo = new UserReportInfo($Users, 1);
		$winMoney = json_encode($userReportInfo->SumResult($Users));
		$gameInfo = new GameInfo();
		$result = $gameInfo->OpenNumberCountb();
		$result = json_encode($result);
		echo <<<JSON
				{
					"dayWin" : $winMoney,
					"result" : $result
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
		$sql = "SELECT  `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`  FROM g_history2 WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1";
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
//		echo "22222";
		echo $_SESSION["loginId"]==89?"true":"false";
	}
	if ($mid == 7){
		$p=explode("h",$_POST["odds"]);
		if(!in_array($p[0],array("a","b","c","d","e","f"))||!preg_match("/[0-9]{0,2}/",$p[1])){
			echo "false";
		}else{
			$ball=$p[0]=="a"?"Ball_1":($p[0]=="b"?"Ball_2":($p[0]=="c"?"Ball_3":($p[0]=="d"?"Ball_4":($p[0]=="e"?"Ball_5":"Ball_6"))));
			if($_SESSION["loginId"]==89){
				if($_POST["ty"]==1)
					$sql="update g_odds7 set h".$p[1]."=round(h".$p[1]."+0.01,2) where g_type='{$ball}'";
				else 
					$sql="update g_odds7 set h".$p[1]."=round(h".$p[1]."-0.01,2) where g_type='{$ball}'";
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
?>