<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
if(!isset($_GET['tid'])) exit;
$tid = $_GET['tid'];
header("Content-Type: text/html; charset=utf-8");
markPos("后台-帳單列表");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<title></title>
</head>
<body onselectstart="return false">
	<table width="99%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="10"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
                        <td width="100%" background="/Admin/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="99%">&nbsp;帳單列表</td>
                                  </tr>
                            </table>
                        </td>
                        <td width="38"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table width="100%" border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<td width="44">編號</td>
                                    <td width="444">項目</td>
                                    <td width="306">操作說明</td>
                                    <td width="188">...</td>
                                </tr>
                                <?php if ($tid == 1){?>
                                <tr align="center">
                                	<td>1</td>
                                    <td>第1~8球、總和、龍虎投注匯總表</td>
                                    <td>封盤后（搖獎前）備份</td>
                                    <td><a href="Reckoning_l.php?tid=1&cid=1"  target="_blank">打開</a></td>
                                </tr>
                                <tr align="center">
                                	<td>2</td>
                                    <td>連碼（注單明細）</td>
                                    <td>封盤后（搖獎前）備份</td>
                                    <td><a href="Reckoning_l.php?tid=1&cid=2"  target="_blank">打開</a></td>
                                </tr>
                                <?php } else  if($tid == 3){
								?>
								<tr align="center">
                                	<td>1</td>
                                    <td>第1~5球、總和、龍虎投注匯總表</td>
                                    <td>封盤后（搖獎前）備份</td>
                                    <td><a href="Reckoning_l.php?tid=3&cid=1"  target="_blank">打開</a></td>
                                </tr>
                                <tr align="center">
                                	<td>2</td>
                                    <td>連碼（注單明細）</td>
                                    <td>封盤后（搖獎前）備份</td>
                                    <td><a href="Reckoning_l.php?tid=3&cid=2"  target="_blank">打開</a></td>
                                </tr>
								<?php
								}else if ($tid == 2){?>
                                <tr align="center">
                                	<td>1</td>
                                    <td>所有投注匯總表</td>
                                    <td>封盤后（搖獎前）備份</td>
                                    <td><a href="Reckoning_l.php?tid=2&cid=1"  target="_blank">打開</a></td>
                                </tr>
                                <?php }else if($tid==7){?>
                                 <tr align="center">
                                	<td>1</td>
                                    <td>所有投注匯總表</td>
                                    <td>封盤后（搖獎前）備份</td>
                                    <td><a href="Reckoning_l.php?tid=7&cid=1"  target="_blank">打開</a></td>
                                </tr>
                                <?php }?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="10"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f odds" align="center">賬單校對公式：（總投註額 - 會員贏項目總投註額） - 總退水 - 和侷無交收水錢 - 輸贏金額 = 實際輸贏結果</td>
                        <td width="38"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>