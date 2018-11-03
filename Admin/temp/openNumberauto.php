<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'classed/SumOunt.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
include_once ROOT_PATH.'functioned/opNumberList.php';

	$numberId = $_GET['numId'];
	$sql ="SELECT g_id FROM g_history WHERE g_qishu = '{$numberId}' AND g_game_id =1 AND g_ball_1 is not null LIMIT 1";
	if ($db->query($sql, 0)){
		$SumAmount = new SumAmount($numberId);
		$Result = $SumAmount->ResultAmount();
		if (is_array($Result)){
			echo '第 '.$numberId.' 結算完成，請查詢報表。';
		} else {
			echo '第 '.$numberId.' 結算失敗！';
		}
	} else {
		echo '第 '.$numberId.' 不存在列表中，請聯繫上級處理！';
	}
?>