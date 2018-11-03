<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Sorry, the page wrong path
  Author: Version:1.0
  Date:2011-12-18
*/
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
//include_once ROOT_PATH.'functioned/globalge.php';
include_once ROOT_PATH.'functioned/global.php';

if ($_SERVER["SERVER_NAME"] != '127.0.0.1') exit('err');

//金額還原
$ConfigModel = configModel("
`g_out_time`,
`g_automatic_open_number_lock`,
`g_up_odds_mix_cq`,
`g_odds_num_cq`,
`g_odds_str_cq`,
`g_automatic_money_lock`,
`g_insert_number_day`,
`g_close_time`,
`g_odds_execution_lock`,
`g_insert_number_day`,
`g_restore_money_lock`");


//金額還原
RestoreMoney($ConfigModel['g_restore_money_lock']);
echo 1;

?>