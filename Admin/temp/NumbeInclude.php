<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 3196998
  Author: Version:1.0
  Date:2012-02-18
*/
session_start();
if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 2){
	header('Location:/Admin/temp/openNumber_cq.php');
} else  if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 3){
	header('Location:/Admin/temp/openNumber_gx.php');
} else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 6){
	header('Location:/Admin/temp/openNumber_pk.php');
}else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 7){
	header('Location:/Admin/temp/openNumber_js.php');
}else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 8){
	header('Location:/Admin/temp/openNumber_kl8.php');
}else{
	 header('Location:/Admin/temp/openNumber.php');
}
?>
<div >

</div>