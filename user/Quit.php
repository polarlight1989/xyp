<script language="javascript">
//top.location=self.location; 
top.location='/'
</script>

<?php

define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';

$name = base64_decode($_COOKIE['g_user']);
$db = new DB();
		$sql = "UPDATE `g_user` SET `g_state` =0,`g_out` =0 WHERE `g_name` = '{$name}'";
		$result = $db->query($sql, 2);

setcookie("g_user", "", 0, "/");
setcookie("g_uid", "", 0, "/");

include_once ROOT_PATH.'functioned/script.php';
//header("location:/user/index.php");


?>





