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
include_once ROOT_PATH.'Admin/ExistUser.php';
$dateTime = date('Y-m-d H:i:s');
$a = date('Y-m-d ').'04:04:00';
global $stratGamexyft, $endGamexyft;
$_SESSION['cpopen'] = 4;
if (( strtotime($dateTime) < strtotime($stratGamexyft) &&  strtotime($dateTime) > strtotime($a)) || strtotime($dateTime) > strtotime($endGamexyft)){
	
	href('right.php'); exit;
}
?>