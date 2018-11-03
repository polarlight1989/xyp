<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-18
*/
include_once ROOT_PATH.'Admin/ExistUser.php';
$dateTime = date('Y-m-d H:i:s');
global $stratGamenc, $endGamenc;
$a = date('Y-m-d ').'02:04:00';
$_SESSION['cpopen'] = 9;
if (( strtotime($dateTime) < strtotime($stratGamenc) &&  strtotime($dateTime) > strtotime($a)) || strtotime($dateTime) > strtotime($endGamenc)){
	href('right.php'); exit;
}
?>
