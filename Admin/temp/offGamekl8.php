<?php
define('Copyright', 'Author QQ: 1234567');
if(!defined("ROOT_PATH"))
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
$dateTime = date('Y-m-d H:i:s');
$a = date('Y-m-d ').'09:00:00';
global $stratGamekl8, $endGamekl8;
$_SESSION['cpopen'] = 6;
if ( $dateTime < $stratGamekl8 || $dateTime > $endGamekl8)
{
	href('right.php'); exit;
}
?>