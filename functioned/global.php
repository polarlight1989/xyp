<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-7
*/
error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);
if (!defined('Copyright') && Copyright != 'Sorry, the page wrong path')
exit('Sorry, the page wrong path');
if (!defined('ROOT_PATH'))
exit('invalid request');
if (!isset($_SESSION)) session_start();
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('PRC');
//dump("aa");
include_once ROOT_PATH.'config/ConFinig.php';
include_once ROOT_PATH.'config/XHTML.php';
include_once ROOT_PATH.'classed/DeBe.php';
include_once ROOT_PATH.'classed/Pages.php';
include_once ROOT_PATH.'classed/Matches.php';
include_once ROOT_PATH.'classed/SumOunt.php';
include_once ROOT_PATH.'classed/SumOuntnc.php';
include_once ROOT_PATH.'classed/SumOuntcq.php';
include_once ROOT_PATH.'classed/SumOuntjxssc.php';
include_once ROOT_PATH.'classed/SumOuntxjssc.php';
include_once ROOT_PATH.'classed/SumOunttjssc.php';
include_once ROOT_PATH.'classed/SumOuntpk.php';
include_once ROOT_PATH.'classed/SumOuntxyft.php';
include_once ROOT_PATH.'classed/SumOuntjs.php';
include_once ROOT_PATH.'classed/SumOuntkl8.php';
include_once ROOT_PATH.'classed/AutoOdds.php';
include_once ROOT_PATH.'classed/AutoOddsnc.php';
include_once ROOT_PATH.'classed/AutoOddscq.php';
include_once ROOT_PATH.'classed/AutoOddsjxssc.php';
include_once ROOT_PATH.'classed/AutoOddsxjssc.php';
include_once ROOT_PATH.'classed/AutoOddstjssc.php';
include_once ROOT_PATH.'classed/AutoOddspk.php';
include_once ROOT_PATH.'classed/AutoOddsxyft.php';
include_once ROOT_PATH.'classed/GamInfo.php';
include_once ROOT_PATH.'functioned/script.php';
include_once ROOT_PATH.'functioned/numberVal.php';
include_once ROOT_PATH.'functioned/parameter.php';
include_once ROOT_PATH.'functioned/pregMatch.php';
include_once ROOT_PATH.'functioned/opNumberList.php';
include_once ROOT_PATH.'tools/IpApi/libs/Iplocation_Class.php';
include_once ROOT_PATH.'classed/check.classed.php';
//echo "bb";














?>