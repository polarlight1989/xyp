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
`g_up_odds_mix_nc`,
`g_odds_execution_lock`,
`g_odds_num_nc`,
`g_odds_str_nc`,
`g_automatic_money_lock`,
`g_insert_number_day`,
`g_close_time`");



//if ($_SERVER["SERVER_NAME"] != '127.0.0.1') exit;

$number=$_GET['number'];

if (isset($number)){
jiesuan($number);
}


function jiesuan($_number)
{
	
	
	//還原賠率
	initializeOddsnc();

	//降賠率
	global $ConfigModel;
	
	if ($ConfigModel['g_odds_execution_lock'] == 1 && mb_substr($_number, -2) !=13 )
	{
		$AutomaticOddsnc = new AutomaticOddsnc($ConfigModel['g_up_odds_mix_nc'], $ConfigModel['g_odds_num_nc'], $ConfigModel['g_odds_str_nc']);
		$AutomaticOddsnc->UpExecution();
	}
	
	//結算
	inventory ($_number, $ConfigModel);
}

/**
 * 結算報表
 * @param int 已經開獎的期數
 * Enter description here ...
 */
function inventory ($number, $ConfigModel)
{

	if ($ConfigModel['g_automatic_money_lock'] == 1)
	{
		//結算
		$Amount = new SumAmountnc($number);
		$Amount->ResultAmount();
	}
	echo 1;
	if (mb_substr($number, -2) == 13)
	{
		//金額還原
		//$Amount->RestoreMoney($ConfigModel['g_restore_money_lock']);
		
		//加載期數
		InsertNumber_nc('09:52:30', $ConfigModel['g_insert_number_day'], 10, 14, 110, $ConfigModel['g_close_time']);
		
		//數據庫備份
		/*$dateTime = date('YmdHis');
		$mysqlDataBak = new MysqlDataBak($BakPassWord, $dateTime);
		$mysqlDataBak->FormatTables();*/
	}
}



?>