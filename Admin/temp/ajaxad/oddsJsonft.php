<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
	include_once ROOT_PATH.'Admin/ExistUser.php';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
	include_once ROOT_PATH.'Admin/ExistUser.php';
	global $Users;
	$db=new DB();
	$mid = $_POST['mid'];
	
	if ($mid == 1)
	{
		//加載1-10名所有賠率
		$h=null;
		for ($i=1; $i<=17; $i++){$h .="h{$i},";}
		$h = mb_substr($h, 0, mb_strlen($h)-1);
		$sql = "SELECT  {$h} FROM g_odds4_default WHERE g_type <> 'Ball_11' AND g_type <> 'Ball_12' AND g_type <> 'Ball_13' AND g_type <> 'Ball_14' ORDER BY g_id ASC  ";
		$result = $db->query($sql, 1);
		$arr = showList($db, $result);
		$arr = json_encode($arr);
		echo <<<JSON
					{
						"oddsList" : $arr
					}
JSON;
	}
	else if ($mid == 2)
	{
		$h=null;
		for ($i=1; $i<=17; $i++){$h .="h{$i},";}
		$h = mb_substr($h, 0, mb_strlen($h)-1);
		$sql = "SELECT  {$h} FROM g_odds4_default WHERE g_type = 'Ball_11'  or g_type = 'Ball_12' ORDER BY g_id ASC  ";
		$result = $db->query($sql, 1);
		$arr = json_encode($result);
		echo <<<JSON
					{
						"oddsList" : $arr
					}
JSON;
	}
	else if ($mid == 3)
	{
		
	}
	else if ($mid == 4)
	{
		$tid = $_POST['tid'];
    $arr = chkOdds($tid);
		$Ball = $arr[0];
		$H = "h".$arr[1];
		$odds = $_POST['oval'];
		$sql = "UPDATE g_odds4_default SET `{$H}` = '{$odds}' WHERE g_type = '{$Ball}' ";
		$db->query($sql, 2);
    echo "ok";
	}
	else if ($mid == 5)
	{
		$Ball = $_POST['oddsType'];
		$H = $_POST['h'];
		$s_num = $_POST['s_num']; //上調或下調
		$sHo = $_POST['sHo']; //幅度
		if ($s_num ==1){
			$Hvalue = $H.'+'.$sHo;
		} else {
			$Hvalue = $H.'-'.$sHo;
		}
		$where = $Ball ? " WHERE g_type = '{$Ball}' " : "WHERE g_type <> 'Ball_1' AND g_type <> 'Ball_2' AND g_type <> 'Ball_11' AND g_type <> 'Ball_12' AND g_type <> 'Ball_13' AND g_type <> 'Ball_14'  ";
		$sql = "UPDATE g_odds4_default SET `{$H}` = {$Hvalue} {$where} ";
		$db->query($sql, 2);
	}
}

function chkOdds($obj){
	$type = array("a"=>'Ball_1','b'=>'Ball_2','c'=>'Ball_3','d'=>'Ball_4','e'=>'Ball_5','f'=>'Ball_6','g'=>'Ball_7','h'=>'Ball_8','i'=>'Ball_9','j'=>'Ball_10','k'=>'Ball_11','l'=>'Ball_12');
	$arr = explode('_',$obj);
  $result = array();
  $result[0] = $type[$arr[0]];
  $result[1] = $arr[1];
	return $result;
}

function showList($db, $result)
{
	$a = array(0=>'a',1=>'b',2=>'c',3=>'d',4=>'e',5=>'f',6=>'g',7=>'h',8=>'i',9=>'j');
  //$a = array(0=>'c',1=>'d',2=>'e',3=>'f',4=>'g',5=>'h',6=>'i',7=>'j');
	$arr = array();
	for ($s=0; $s<17; $s++){
		for ($i=0; $i<count($result); $i++){
			$n=$s+1;
			$arr[$s][$a[$i].'_'.$n] = $result[$i]['h'.($s+1)];
		}
	}
	return $arr;
}
?>

