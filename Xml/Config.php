<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';

$countuser=$db->query("SELECT g_name,g_count_time,g_out,g_ip,g_mumber_type FROM g_user  where g_out=1  ",3);
$countAll = $db->query("SELECT g_nid FROM g_user",3);

echo $countuser."/".$countAll;

?>