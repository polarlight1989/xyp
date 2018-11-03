<?php
if (!defined('Copyright') && Copyright != 'Sorry, the page wrong path')
exit('Sorry, the page wrong path');
if (!defined('ROOT_PATH'))
exit('invalid request');
$db=new DB();
$ConfigModel = $db->query("SELECT  * FROM `g_config` LIMIT 1", 1);
$ConfigModel = $ConfigModel[0];

?>