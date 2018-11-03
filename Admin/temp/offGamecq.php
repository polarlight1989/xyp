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
$a = date('Y-m-d ').'01:55:00';
global $stratGamecq, $endGamecq;
$_SESSION['cpopen'] = 2;
if ( ($dateTime < $stratGamecq && $dateTime > $a) || $dateTime > $endGamecq)
{
	header("Location: ./right.php"); exit;
}
?>