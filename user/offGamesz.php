<?php
define('Copyright', 'Author QQ: 1234567');
if(!defined("ROOT_PATH"))
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
$dateTime = date('Y-m-d H:i:s');

global $stratGamesz, $endGamesz;
$_SESSION['cpopen'] = 7;
if ( $dateTime < $stratGamesz || $dateTime > $endGamesz)
{
 
markPos("前台-吉林封盘页");
	header("Location: ./right.php"); exit;
}
?>