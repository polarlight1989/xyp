<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
	include_once ROOT_PATH.'Admin/config/globalge.php';
	//session_start();
	$mid = $_POST['mid'];
	$db = new DB();
	if ($mid == 1)
	{
		if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 2)
			$from = "g_history2";
		else 
			$from = "g_history";
		$sql = "SELECT g_qishu FROM `{$from}` ORDER BY g_qishu DESC LIMIT".($from == "g_history2" ? 120 * 3 : 84 * 3);
		$result = $db->query($sql, 0);
		$result = json_encode($result);
		echo <<<JSON
				{
					"rows" : $result
				}
JSON;
	}
else if ($mid == 2)
	{
		$db=new DB();
		$result = $db->query("SELECT `g_qishu`AS '廣東快樂十分' FROM `g_history` ORDER BY g_qishu DESC LIMIT 30 ", 1);
		$resultcq = $db->query("SELECT `g_qishu` AS '重慶時時彩' FROM `g_history2` ORDER BY g_qishu DESC LIMIT 30 ", 1);
		$a = array_merge($result, $resultcq);
		$result = json_encode($a);
		echo <<<JSON
				{
				"list" : $result
	}
JSON;
	}
}
?>