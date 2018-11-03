<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $Users;
if ($Users[0]['g_login_id'] != 89) exit;
$db = new DB();
global $Users;
markPos("后台-浏览报表");

	$s_name = $_GET['name'];
	$det= $_GET['det']; //結算狀態  0未結，1結
	if ($det=="0"){
	$vvv="AND g_win is null ";
	}else{
	$vvv="AND g_win is not null ";
	}
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$total = $db->query("SELECT g_id FROM g_zhudan WHERE {$date} AND g_nid = '{$s_name}'  {$vvv}  ", 3);
    $pageNum = 100;
    $page = new Page($total, $pageNum);
    $zhudan = $db->query("SELECT * FROM `g_zhudan` WHERE  {$date} AND  g_nid = '{$s_name}'  {$vvv} ORDER BY g_id DESC {$page->limit} ", 1);	
    


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<title>下注明細</title>
</head>
<body oncontextmenu="javascript:window.print()">
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
                                    <td width="99%">&nbsp;下注明細</td>
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
                                	<td width="170">注單號碼/時間</td>
                                    <td width="130">下注類型</td>
                                    <td>帳號</td>
                                    <td>下注明細</td>
                                    <td>會員下注</td>
                                    <td>會員輸贏</td>
                                </tr>
                                <?php for ($i=0; $i<count($zhudan); $i++) {?>
                                <?php 
                                  $result = $db->query("SELECT `g_login_id`, `g_panlu` FROM `g_user` WHERE g_name = '{$s_name}' LIMIT 1", 1);
	
								if($result){
								$g_panlu= $result[0]['g_panlu'];
								$g_login_id=$result[0]['g_login_id'];
								}
					
								
                                if ($zhudan[$i]['g_mingxi_1_str'] == null) {
                                	if ($zhudan[$i]['g_mingxi_1'] == '總和、龍虎' || $zhudan[$i]['g_mingxi_1'] == '總和、龍虎和'){
                                		$n = $zhudan[$i]['g_mingxi_2'];
                                	}else {
                                		$n = $zhudan[$i]['g_mingxi_1'].'『'.$zhudan[$i]['g_mingxi_2'].'』';
                                	}

						        	$html = '<font color="#0066FF">'.$n.'</font>@ <font color="red"><b>'.$zhudan[$i]['g_odds'].'</b></font>';
						        	$SumNum = $zhudan[$i]['g_jiner'];
					        	}else {
						        	$_xMoney = $zhudan[$i]['g_mingxi_1_str'] * $zhudan[$i]['g_jiner'];
						        	$SumNum = '<font color="#009933">'.$zhudan[$i]['g_mingxi_1_str'].'</font> x <font color="#0066FF">'.$zhudan[$i]['g_jiner'].'</font><br />'.$_xMoney;
						        	$html = '<font color="#0066FF">'.$zhudan[$i]['g_mingxi_1'].'</font>@ <font color="red"><b>'.$zhudan[$i]['g_odds'].'</b></font><br />'.
						        				'<span style="line-height:23px">復式  『 '.$zhudan[$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$zhudan[$i]['g_mingxi_2'].'</span>';
						        }
						        
                                if ($zhudan[$i]['g_win']==NULL){
								$wins="未結算";
								}else{
								$wins=$zhudan[$i]['g_win'];
								}
                                ?>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td><?php echo $zhudan[$i]['g_id']?>#<br /><?php echo $zhudan[$i]['g_date'].' '.GetWeekDay($zhudan[$i]['g_date'], 0)?></td>
                                    <td><?php echo $zhudan[$i]['g_type']?><br /><font color="#009933"><?php echo $zhudan[$i]['g_qishu']?>期</font></td>
                                    <td>
                                   
                                    <?php echo $zhudan[$i]['g_nid']?><br />
                                    <?php echo $g_panlu?>盤
                                 
                                    </td>
                                    <td><?php echo $html?></td>
                                    <td><?php echo $SumNum?></td>
                                    <td><?php echo is_Number($wins)?></td>
                                </tr>
                                <?php }?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="right"><?php $p = $page->diy_page()?><table width='100%' height='22' border='0' cellspacing='0' cellpadding='0' class="page_box"><tr><td align='left'>&nbsp;共&nbsp;<?php echo $p[0];?>&nbsp;條記錄</td><td align='center'>共&nbsp;<?php echo $p[2];?>&nbsp;頁</td><td align='right'>&nbsp;<?php echo $p[4];?>『<?php echo $p[5];?>』<?php echo $p[6];?></td></tr></table></td>
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
</body>
</html>