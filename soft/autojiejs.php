<?php
/*
  Copyright (c) 2010-02 Game
  Game All Rights Reserved.
  QQ:2635384999
  Author: Version:1.0
  Date:2011-12-18
*/
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/global.php';
$ConfigModel = configModel("
`g_out_time`,
`g_automatic_open_number_lock`,
`g_automatic_money_lock`,
`g_insert_number_day`,
`g_close_time`,
`g_odds_execution_lock`,
`g_insert_number_day`,
`g_restore_money_lock`");

$number=$_GET['number'];

if (isset($number)){
getNumberByBall_js($number);
}


function getNumberByBall_js ($number)
{
	global $List,$db;
	$_number = $number;   
	$date = date('Y-m-d H:i');
	$list = $List['openResult'];
	 
	//還原賠率
	initializeOddsjs();

	//降賠率
	global $ConfigModel;
	if ($ConfigModel['g_odds_execution_lock'] == 1 && mb_substr($_number, -2) < 50)
	{
		$AutomaticOdds = new AutomaticOddsjs($ConfigModel['g_up_odds_mix_gx'], $ConfigModel['g_odds_num_js'], $ConfigModel['g_odds_str_js']);
		$AutomaticOdds->UpExecution();
	}
	if ($ConfigModel['g_automatic_money_lock'] == 1)
	{
		//結算
		$SumOuntjs = new SumAmountjs($number);
		$SumOuntjs->ResultAmount();
		echo "结算";
	}
	 
}
 


?>
