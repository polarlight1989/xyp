<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-12
*/
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
if ($_SERVER["REQUEST_METHOD"] != "POST") {exit;}
include_once ROOT_PATH.'functioned/cheCookie.php';
include_once ROOT_PATH.'config/Oddes.php';

$typeId = $_POST['typeid'];

if ($typeId == "sessionId" && Copyright)
{
	$_SESSION['guid_code'] = uniqid(time(),true);
	echo 1;
}


?>