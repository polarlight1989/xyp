<?php
define('Copyright', 'Author QQ: 1234567');
if(!defined("ROOT_PATH"))
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
$dateTime = date('Y-m-d H:i:s');
$a = date('Y-m-d ').'01:55:00';
global $stratGamesz, $endGamesz;
$_SESSION['cpopen'] = 7;
if ( ($dateTime < $stratGamesz) || $dateTime > $endGamesz)
{
	header("Location: ./right.php"); exit;
}
?>