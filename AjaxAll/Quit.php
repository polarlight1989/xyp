
<script language="javascript">

top.location='/'
</script>

<?php



define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/config/globalge.php';
$name = base64_decode($_COOKIE['manage_user']);
$db = new DB();
		$sql = "UPDATE `j_manage` SET `g_out` =0 WHERE `g_name` = '{$name}'";
		$result = $db->query($sql, 2);
		
		$sql = "UPDATE `g_rank` SET `g_out` =0 WHERE `g_name` = '{$name}'";
		$result = $db->query($sql, 2);

		
		$sql = "UPDATE `g_relation_user` SET `g_out` =0 WHERE `g_s_name` = '{$name}'";
		$result = $db->query($sql, 2);
		
setcookie("manage_user", "", 0, "/");
setcookie("manage_uid", "", 0, "/");
 unset($_SESSION['loginId']);
 unset($_SESSION['sName']);
  unset($_SESSION['manege_ch']);
   unset($_SESSION['manege_ch']);
include_once '/functioned/script.php';
href("/");
?>