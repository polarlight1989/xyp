<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-18
*/
//define('Copyright', 'Author QQ: 1234567');
//define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
//include_once ROOT_PATH.'functioned/globalge.php';
include_once ROOT_PATH.'Admin/ExistUser.php';
$dateTime = date('Y-m-d H:i:s');
$a = date('Y-m-d ').'23:00:00';
global $stratGame, $endGame;
$_SESSION['cpopen'] = 1;
if ( ($dateTime < $stratGame || $dateTime > $a) || $dateTime > $endGame)
{
	markPos("后台-封盘页");
	href('right.php'); exit;
}
?>