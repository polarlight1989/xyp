<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
global $ConfigModel,$Users;

$db=new DB();
if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_1'])){
	if ($Users[0]['g_lock_1_1'] !=1) 
		exit(back('您的權限不足！'));
}
markPos("后台-系统设置-彩种管理");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	
	$List = array();
	for ($i=1; $i<=10; $i++){
		$List['g_game_'.$i.''] = empty($_POST['game_'.$i.'']) ? 0 : $_POST['game_'.$i.''];
		if ($i<=7)
			$List['g_game_cq_'.$i.''] = empty($_POST['game_cq_'.$i.'']) ? 0 : $_POST['game_cq_'.$i.''];
		if ($i<=5||$i>=9){
			$List['g_game_gx_'.$i.''] = empty($_POST['game_gx_'.$i.'']) ? 0 : $_POST['game_gx_'.$i.''];
			}
		if ($i<=3)
			$List['g_game_pk_'.$i.''] = empty($_POST['game_pk_'.$i.'']) ? 0 : $_POST['game_pk_'.$i.''];
		if ($i<=8)
			$List['g_game_kl8_'.$i.''] = empty($_POST['game_kl8_'.$i.'']) ? 0 : $_POST['game_kl8_'.$i.''];
	}

	$sql = "UPDATE g_config SET 
	g_game_cq_1='{$List['g_game_cq_1']}',
	g_game_cq_2='{$List['g_game_cq_2']}',
	g_game_cq_3='{$List['g_game_cq_3']}',
	g_game_cq_4='{$List['g_game_cq_4']}',
	g_game_cq_5='{$List['g_game_cq_5']}',
	g_game_cq_6='{$List['g_game_cq_6']}',
	g_game_cq_7='{$List['g_game_cq_7']}',
	g_game_kl8_1='{$List['g_game_kl8_1']}',
	g_game_kl8_2='{$List['g_game_kl8_2']}',
	g_game_kl8_3='{$List['g_game_kl8_3']}',
	g_game_kl8_4='{$List['g_game_kl8_4']}',
	g_game_kl8_5='{$List['g_game_kl8_5']}',
	g_game_kl8_6='{$List['g_game_kl8_6']}',
	g_game_kl8_7='{$List['g_game_kl8_7']}',
	g_game_kl8_8='{$List['g_game_kl8_8']}',
	g_game_1='{$List['g_game_1']}',
	g_game_2='{$List['g_game_2']}',
	g_game_3='{$List['g_game_3']}',
	g_game_4='{$List['g_game_4']}',
	g_game_5='{$List['g_game_5']}',
	g_game_6='{$List['g_game_6']}',
	g_game_7='{$List['g_game_7']}',
	g_game_8='{$List['g_game_8']}',
	g_game_9='{$List['g_game_9']}',
	g_game_10='{$List['g_game_10']}',
	g_game_pk_1='{$List['g_game_pk_1']}',
	g_game_pk_2='{$List['g_game_pk_2']}',
	g_game_pk_3='{$List['g_game_pk_3']}'
	WHERE g_id = '{$ConfigModel['g_id']}' LIMIT 1";
	$db->query($sql, 2);
	exit(alert_href('更變成功', 'managescz.php'));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<title></title>
<script type="text/javascript">
<!--
	function isForm(){
		if (confirm("確認更變嗎？"))
				return true;
		return false;
	}
	
-->
</script>
</head>
<body onselectstart="return false">
<form action="" method="post" onsubmit="return isForm()">
	<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="5" height="100%" bgcolor="#4F4F4F"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Admin/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="99%"><font style="font-weight:bold" color="#344B50">&nbsp;彩種管理</font></td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="2">廣東快樂十分/幸运农场</th>
                                </tr>
                                <tr style="height:38px">
								<td class="bj">快捷盤口</td>
								<td class="left_p6">
								    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_1" value="1" />&nbsp;兩面盤&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_20']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_20" value="1" />&nbsp;數字盤								
								</td>
								</tr>
								<tr style="height:38px">
                                	<td class="bj">類型開啟</td>
                                    <td class="left_p6">
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_1" value="1" />&nbsp;第一球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_2" value="1" />&nbsp;第二球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_3" value="1" />&nbsp;第三球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_4']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_4" value="1" />&nbsp;第四球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_5']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_5" value="1" />&nbsp;第五球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_6']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_6" value="1" />&nbsp;第六球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_7" value="1" />&nbsp;第七球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_8']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_8" value="1" />&nbsp;第八球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_9']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_9" value="1" />&nbsp;總和、龍虎&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_10']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_10" value="1" />&nbsp;連碼&nbsp;
                                    </td>
                                </tr>
                                <tr style="height:38px; display:none">
                                	<td class="bj">B盤:</td>
                                	<td class="left_p6">
                                		1-8號碼:&nbsp;<input type="text" class="textc" name="odds_ratio_b1" value="<?php echo $ConfigModel['g_odds_ratio_b1']?>" />&nbsp;
                                		1-8方位:&nbsp;<input type="text" class="textc" name="odds_ratio_b2" value="<?php echo $ConfigModel['g_odds_ratio_b2']?>" />&nbsp;
                                		1-8中發白:&nbsp;<input type="text" class="textc" name="odds_ratio_b3" value="<?php echo $ConfigModel['g_odds_ratio_b3']?>" />&nbsp;&nbsp;
                                		兩面:&nbsp;<input type="text" class="textc" name="odds_ratio_b4" value="<?php echo $ConfigModel['g_odds_ratio_b4']?>" />&nbsp;&nbsp;
                                		連碼:&nbsp;<input type="text" class="textc" name="odds_ratio_b5" value="<?php echo $ConfigModel['g_odds_ratio_b5']?>" />
                                	</td>
                                </tr>
                                <tr style="height:38px; display:none">
                                	<td class="bj">C盤:</td>
                                	<td class="left_p6">
                                		1-8號碼:&nbsp;<input type="text" class="textc" name="odds_ratio_c1" value="<?php echo $ConfigModel['g_odds_ratio_c1']?>" />&nbsp;
                                		1-8方位:&nbsp;<input type="text" class="textc" name="odds_ratio_c2" value="<?php echo $ConfigModel['g_odds_ratio_c2']?>" />&nbsp;
                                		1-8中發白:&nbsp;<input type="text" class="textc" name="odds_ratio_c3" value="<?php echo $ConfigModel['g_odds_ratio_c3']?>" />&nbsp;&nbsp;
                                		兩面:&nbsp;<input type="text" class="textc" name="odds_ratio_c4" value="<?php echo $ConfigModel['g_odds_ratio_c4']?>" />&nbsp;&nbsp;
                                		連碼:&nbsp;<input type="text" class="textc" name="odds_ratio_c5" value="<?php echo $ConfigModel['g_odds_ratio_c5']?>" />
                                	</td>
                                </tr>
							</table>	
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="2">所有時時彩</th>
                                </tr>								
								                                <tr style="height:38px">
								<td class="bj">快捷盤口
								</td>
								<td class="left_p6">
								    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_1" value="1" />&nbsp;兩面盤&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_20']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_20" value="1" />&nbsp;數字盤								
								</td>
								</tr>
                                <tr style="height:38px">
                                	<td class="bj">類型開啟</td>
                                    <td class="left_p6">
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_1" value="1" />&nbsp;第一球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_2" value="1" />&nbsp;第二球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_3" value="1" />&nbsp;第三球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_4']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_4" value="1" />&nbsp;第四球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_5']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_5" value="1" />&nbsp;第五球&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_6']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_6" value="1" />&nbsp;總和、龍虎&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_7" value="1" />&nbsp;前三&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_7" value="1" />&nbsp;中三&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_7" value="1" />&nbsp;后三&nbsp;									
                                    </td>
                                </tr>
                                <tr style="height:38px; display:none">
                                	<td class="bj">B盤:</td>
                                	<td class="left_p6">
                                		1-5號碼:&nbsp;<input type="text" class="textc" name="odds_ratio_cq_b1" value="<?php echo $ConfigModel['g_odds_ratio_cq_b1']?>" />&nbsp;
                                		兩面:&nbsp;<input type="text" class="textc" name="odds_ratio_cq_b2" value="<?php echo $ConfigModel['g_odds_ratio_cq_b2']?>" />&nbsp;&nbsp;
                                		前三、中三、后三:&nbsp;<input type="text" class="textc" name="odds_ratio_cq_b3" value="<?php echo $ConfigModel['g_odds_ratio_cq_b3']?>" />
                                	</td>
                                </tr>
                                <tr style="height:38px; display:none">
                                	<td class="bj">C盤:</td>
                                	<td class="left_p6">
                                		1-5號碼:&nbsp;<input type="text" class="textc" name="odds_ratio_cq_c1" value="<?php echo $ConfigModel['g_odds_ratio_cq_c1']?>" />&nbsp;
                                		兩面:&nbsp;<input type="text" class="textc" name="odds_ratio_cq_c2" value="<?php echo $ConfigModel['g_odds_ratio_cq_c2']?>" />&nbsp;&nbsp;
                                		前三、中三、后三:&nbsp;<input type="text" class="textc" name="odds_ratio_cq_c3" value="<?php echo $ConfigModel['g_odds_ratio_cq_c3']?>" />
                                	</td>
                                </tr>
								</table>
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="2">北京赛车PK10/极速赛车</th>
                                </tr>								
								 <tr style="height:38px">
								<td class="bj">快捷盤口
								</td>
								<td class="left_p6">
								    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_1" value="1" />&nbsp;兩面盤&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_20']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_20" value="1" />&nbsp;數字盤								
								</td>
								</tr>
								<tr style="height:38px">
                                	<td class="bj">類型開啟</td>
                                    <td class="left_p6">
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_pk_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_1" value="1" />&nbsp;冠、亞軍 組合&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_pk_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_1" value="1" />&nbsp;冠軍&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_pk_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_1" value="1" />&nbsp;亞軍&nbsp;									
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_pk_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_2" value="1" />&nbsp;第三名&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_pk_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_2" value="1" />&nbsp;第四名&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_pk_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_2" value="1" />&nbsp;第伍名&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_pk_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_2" value="1" />&nbsp;第六名&nbsp;									
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_pk_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_3" value="1" />&nbsp;第七名&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_pk_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_3" value="1" />&nbsp;第八名&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_pk_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_3" value="1" />&nbsp;第九名&nbsp;									
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_pk_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_3" value="1" />&nbsp;第十名&nbsp;									
									
                                    </td>
                                </tr>
							</table>	
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="2">吉林快3</th>
                                </tr>								
								                                <tr style="height:38px">
								<td class="bj">類型開啟
								</td>
                                    <td class="left_p6">
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_1" value="1" />&nbsp;大小&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_2" value="1" />&nbsp;三軍&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_3" value="1" />&nbsp;圍骰&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_4']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_4" value="1" />&nbsp;全骰&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_5']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_5" value="1" />&nbsp;點數&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_6']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_6" value="1" />&nbsp;長牌&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_cq_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_7" value="1" />&nbsp;短牌&nbsp;
                                    </td>
								</tr>								
                            </table>
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="2">快樂8</th>
                                </tr>								
								                                <tr style="height:38px">
								<td class="bj">類型開啟
								</td>
                                    <td class="left_p6">
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_kl8_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_kl8_1" value="1" />&nbsp;正碼&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_kl8_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_kl8_2" value="1" />&nbsp;總和大小&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_kl8_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_kl8_3" value="1" />&nbsp;總和單雙&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_kl8_4']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_kl8_4" value="1" />&nbsp;總和和局&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_kl8_5']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_kl8_5" value="1" />&nbsp;總和過關&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_kl8_6']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_kl8_6" value="1" />&nbsp;前後和&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_kl8_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_kl8_7" value="1" />&nbsp;單雙和&nbsp;
                                    &nbsp;&nbsp;<input <?php if($ConfigModel['g_game_kl8_8']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_kl8_8" value="1" />&nbsp;五行&nbsp;
                                    </td>
								</tr>								
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><input type="submit" class="inputs" value="確&nbsp;&nbsp;定" /></td>
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
</form>
</body>
</html>