<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
include_once ROOT_PATH.'Admin/temp/offGame.php';
if ($ConfigModel['g_nowrecord_lock'] !=1 || $ConfigModel['g_kg_game_lock'] !=1 ||$ConfigModel['g_game_10'] !=1)
	exit(href('right.php'));
$oddsLock = false;
if ($Users[0]['g_login_id']==48){
	if ($Users[0]['g_Immediate2_lock'] != 1) exit(back('抱歉！您無權限訪問即時注單。'));
}
if ($Users[0]['g_login_id']==89){
	$oddsLock=true;
} else if (isset($Users[0]['g_odds_lock']) && $Users[0]['g_odds_lock']==1){
	$oddsLock=true;
}

$g = $_GET['cid'];
$Mean = -1000000;
$types = '連碼';
if (isset($_SESSION['Mean10']))
	$Mean = $_SESSION['Mean10'];

markPos("后台-广东即时注单-{$types}");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Admin/temp/js/oddsFile.js"></script>
<script type="text/javascript" src="/Admin/temp/js/setOdds.js"></script>
<title></title>
</head>
<body onselectstart="return false">
	<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="5" height="100%" bgcolor="#4F4F4F"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Admin/temp/images/tab_05.gif">
                        <?php include_once ROOT_PATH.'Admin/temp/oddsTop.php';?>
                        </td>
                        <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="t_odds" width="100%">
                            	<tr class="tr_top">
                                	<th colspan="8">連碼</th>
                                </tr>
                                <tr align="center">
                                	<td class="ball_2">任選二</td>
                                    <td class="ball_2">選二連直</td>
                                    <td class="ball_2">選二連組</td>
                                    <td class="ball_2">任選三</td>
                                    <td class="ball_2">選三前直</td>
                                    <td class="ball_2">選三前組</td>
                                    <td class="ball_2">任選四</td>
                                    <td class="ball_2">任選五</td>
                                </tr>
                                <tr align="center">
                                	<td class="odds" id="h1"></td>
                                    <td class="odds" id="h2"></td>
                                    <td class="odds" id="h3"></td>
                                    <td class="odds" id="h4"></td>
                                    <td class="odds" id="h5"></td>
                                    <td class="odds" id="h6"></td>
                                    <td class="odds" id="h7"></td>
                                    <td class="odds" id="h8"></td>
                                </tr>
                                <?php if ($oddsLock){?>
                                <tr align="center">
                                    <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h1','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h1','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
	                                <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h2','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h2','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
	                                <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h3','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h3','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
	                                <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h4','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h4','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
	                                <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h5','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h5','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
	                                <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h6','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h6','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
	                                <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h7','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h7','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
	                                <td>
                                    	<input title="上調賠率" type="button" onclick="setodds('h8','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />&nbsp;
	                                    <input title="下調賠率" type="button" onclick="setodds('h8','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
	                                </td>
	                            </tr>
                                    <?php }?>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('任選二')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a101">-</a></td>
                                    <td class="odds">-</td>
                                    <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('選二連組')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a102">-</a></td>
                                    <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('任選三')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a103">-</a></td>
                                    <td class="odds">-</td>
                                    <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('選三前組')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a104">-</a></td>
                                    <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('任選四')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a105">-</a></td>
                                    <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('任選五')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a106">-</a></td>
                                </tr>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="odds"  id="d101">-</td>
                                    <td class="odds">-</td>
                                    <td class="odds"  id="d102">-</td>
                                    <td class="odds"  id="d103">-</td>
                                    <td class="odds" >-</td>
                                    <td class="odds"  id="d104">-</td>
                                    <td class="odds"  id="d105">-</td>
                                    <td class="odds"  id="d106">-</td>
                                </tr>
                                <tr align="center">
                                	<td class="ball_2"><input type="radio" name="ros" value="任選二" id="101" onclick="GoPinn(this)" /></td>
                                    <td class="ball_2"><input type="radio" name="ros" disabled="disabled" /></td>
                                    <td class="ball_2"><input type="radio" name="ros" value="選二連組" id="102" onclick="GoPinn(this)" /></td>
                                    <td class="ball_2"><input type="radio" name="ros" value="任選三" id="103" onclick="GoPinn(this)" /></td>
                                    <td class="ball_2"><input type="radio" name="ros" disabled="disabled" /></td>
                                    <td class="ball_2"><input type="radio" name="ros" value="選三前組" id="104" onclick="GoPinn(this)" /></td>
                                    <td class="ball_2"><input type="radio" name="ros" value="任選四" id="105" onclick="GoPinn(this)" /></td>
                                    <td class="ball_2"><input type="radio" name="ros" value="任選五" id="106" onclick="GoPinn(this)" /></td>
                                </tr>
                            </table>
                            <table style=" display:none;" id="s_table" border="0" cellspacing="0" class="t_odds">
	                            	<!--<tr align="center">
	                                	<td colspan="8">
	                                	每注保留額度（超過部份補出）：<input type="text" id="kb" class="textb" />&nbsp;&nbsp;
	                                	<input type="button" class="inputs" onclick="GoSum()" value="計算補貨" />&nbsp;&nbsp;
	                                	 <input type="button" class="inputs" onclick="Gost()" value="快速補出" /> </td>
	                                </tr>-->
	                                <tr class="tr_top">
	                                	<td colspan="8">『 <span class="ballr" id="a_s_type"></span> 』按總組統計排行</td>
	                                </tr>
                                <tr>
                                	<td class="ball_3">排名</td>
                                    <td class="ball_3">組合號碼</td>
                                    <td class="ball_3">總注額</td>
                                    <td class="ball_3">總組</td>
                                    <td class="ball_3">單組金額</td>
                                    <td class="ball_3">退水</td>
                                    <td class="ball_3">派彩額</td>
                                    <td class="ball_3">補貨</td>
                                </tr>
                                <tfoot id="sList">
                                	
                                </tfoot>
                               <!-- <tr align="center" id="sList">
                                	 <td>排名</td>
                                    <td>組合</td>
                                    <td>下注額</td>
                                    <td>快補金額</td>
                                    <td>退水</td>
                                    <td>派彩額</td>
                                    <td>單補</td>
                                </tr> -->
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><?php if ($oddsLock){?>
                        	<input type="button" class="inputs" value="還原賠率" onclick="initializes()" />&nbsp;&nbsp;&nbsp;&nbsp;
                        設置調動幅度：<input type="text" class="texta" id="Ho" value="0.001" />
                        	<?php }?></td>
                        <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
				</table>
            <td width="5" bgcolor="#4F4F4F"></td>
					</td>
        </tr>
        <tr>
        	<td height="5" bgcolor="#4F4F4F"></td>
            <td bgcolor="#4F4F4F"></td>
            <td height="5" bgcolor="#4F4F4F"></td>
        </tr>
    </table>
    <?php echo $HtmlPop?>
</body>
</html>