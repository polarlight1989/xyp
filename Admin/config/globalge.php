<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
 Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-27
*/
//error_reporting(1);
if (!defined('Copyright') && Copyright != 'Sorry, the page wrong path')
exit('Sorry, the page wrong path');
if (!defined('ROOT_PATH'))
exit('invalid request');
if (!isset($_SESSION)) session_start();
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('PRC');
include_once ROOT_PATH.'classed/UsersModel.php';
include_once ROOT_PATH.'classed/DeBe.php';
include_once ROOT_PATH.'classed/Matches.php';
include_once ROOT_PATH.'classed/DetailEnd.php';
include_once ROOT_PATH.'classed/Pages.php';
include_once ROOT_PATH.'classed/UserReporInfo.php';
include_once ROOT_PATH.'classed/UserReporInfonc.php';
include_once ROOT_PATH.'classed/UserReporInfopk.php';
include_once ROOT_PATH.'classed/UserReporInfoxyft.php';
include_once ROOT_PATH.'config/XHTML.php';
include_once ROOT_PATH.'config/Oddes.php';
include_once ROOT_PATH.'config/ConFinig.php';
include_once ROOT_PATH.'functioned/script.php';
include_once ROOT_PATH.'functioned/parameter.php';
include_once ROOT_PATH.'functioned/pregMatch.php';
include_once ROOT_PATH.'tools/IpApi/libs/Iplocation_Class.php';
?>