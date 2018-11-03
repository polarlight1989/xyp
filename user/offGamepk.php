<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-18
*/
define('Copyright', 'Author QQ: 1234567');
if (!defined("ROOT_PATH"))
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');

include_once ROOT_PATH.'functioned/cheCookie.php';
$dateTime = date('Y-m-d H:i:s');
global $stratGamepk, $endGamepk;
$_SESSION['cpopen'] = 6;
if ( $dateTime < $stratGamepk || $dateTime > $endGamepk)
{
 
markPos("前台-PK封盘页");
	header("Location: ./right.php"); exit;
}
?>