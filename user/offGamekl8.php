<?php
define('Copyright', 'Author QQ: 1234567');
if(!defined("ROOT_PATH"))
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
$dateTime = date('Y-m-d H:i:s');
$a = date('Y-m-d ').'00:00:00';
$b = date('Y-m-d ').'00:05:00';
$c = date('Y-m-d ').'23:59:59';
global $stratGamekl8, $endGamekl8;
$_SESSION['cpopen'] = 8;
if ( !(($dateTime>=$a && $dateTime<=$b) || ($dateTime>=$stratGamekl8&& $dateTime<=$c)))
{
	
	markPos("前台-快樂8封盘页");
	header("Location: ./right.php"); exit;
}
?>