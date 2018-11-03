<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-18
*/
if (!defined("Copyright"))
define('Copyright', 'Author QQ: 1234567');
if (!defined("ROOT_PATH"))
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
$dateTime = date('Y-m-d H:i:s');
global $stratGamenc, $endGamenc;
$a = date('Y-m-d ').'02:03:00';
$_SESSION['cpopen'] = 9;
if ( ($dateTime < $stratGamenc && $dateTime > $a) || $dateTime > $endGamenc){

markPos("前台-极速时时彩封盘页");
	header("Location: ./right.php"); exit;
}
?>