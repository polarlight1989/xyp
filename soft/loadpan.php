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
`g_up_odds_mix`,
`g_odds_execution_lock`,
`g_odds_num`,
`g_odds_str`,
`g_automatic_money_lock`,
`g_insert_number_day`,
`g_close_time`");

if ($_SERVER["SERVER_NAME"] != '127.0.0.1') exit;

$aHour = intval(date("H"));
if ($aHour<22 ){ //有时最后一期没开奖，拖到第二天才开奖，期数就加载隔天的期数就出问题了，所以拖到第二天最后一期才开奖应该加载当天期数
  InsertNumber(0);
  echo 0;
  } else { 
    InsertNumber(1); 
	echo 1;
	}

?>