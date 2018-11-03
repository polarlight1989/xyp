<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/globalge.php';
include_once ROOT_PATH.'functioned/opNumberList.php';
include_once ROOT_PATH.'functioned/cheCookie.php';
if (isset($_GET['id'])){
	$li = $_GET['id'];
} else {
	$li= is_numeric($_SESSION['cpopen']) ? intval($_SESSION['cpopen']) : 1;
}
$t = '';
switch ($li) {
	case 1:
		$t = '广东';
		$g_ball='`g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8` ';
		break;
	case 2:
		$t = '重庆';
		$g_ball='`g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5` ';
		break;
	case 3:
		$t = '五分彩';
		$g_ball='`g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5` ';
		break;
	case 10:
		$t = '新疆';
		$g_ball='`g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5` ';
		break;
	case 11:
		$t = '天津';
		$g_ball='`g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5` ';
		break;
	case 4:
		$t = '飞艇';
		$g_ball='`g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8`, `g_ball_9`, `g_ball_10` ';
		break;
		
	case 6:
		$t = 'PK';
		$g_ball='`g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8`, `g_ball_9`, `g_ball_10` ';
		break;
	case 7:
		$t = '吉林';
		$g_ball='`g_ball_1`, `g_ball_2`, `g_ball_3` ';
		break;
	case 8:
		$t = '快樂8';
		$g_ball='`g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8`, `g_ball_9`, `g_ball_10`,';
		$g_ball.='`g_ball_11`, `g_ball_12`, `g_ball_13`, `g_ball_14`, `g_ball_15`, `g_ball_16`, `g_ball_17`, `g_ball_18`, `g_ball_19`, `g_ball_20` ';
		break;
	case 9:
		$t = '农场';
		$g_ball='`g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8` ';
		break;
}
$g_history= $li==1 ? 'g_history' : 'g_history'.$li;
$arr=array();
$sqls="SELECT `g_id`, `g_qishu`, `g_date`, `g_game_id`,$g_ball  FROM `$g_history`  ORDER BY g_qishu DESC LIMIT 8";
$numberList = $db->query($sqls, 1);
$arr['list']=''; $arr['t']=$t;
if ($numberList){
	$arr['list'].='<table border="0" cellpadding="0" cellspacing="1" class="t_list" style="width:231px">';
	for ($i=0; $i<8; $i++){
		$ball=$numberList[$i]['g_ball_1'].','.$numberList[$i]['g_ball_2'].','.$numberList[$i]['g_ball_3'];
		for($j=4;$j<=20;$j++){
			if(isset($numberList[$i]['g_ball_'.$j])) {$ball.=','.$numberList[$i]['g_ball_'.$j];if($j==10){$ball.='<br>';}}
		}
		if($li==8)$arr['list'].='<tr><td class=\'t_td_caption_1\'>'.substr($numberList[$i]['g_qishu'],-3).'</td>';
		else $arr['list'].='<tr><td class=\'t_td_caption_1\'>'.$numberList[$i]['g_qishu'].'</td>';
		$arr['list'].='<td class=\'t_td_text\'>'.$ball.'</td>';
		$arr['list'].='</tr>';
 	}
	$arr['list'].='</table>';
}
echo json_encode($arr); exit();
?>