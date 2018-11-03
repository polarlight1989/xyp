<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
global $Users,$ConfigModel;

if (isset($_GET['uid'])){
	$userid = $_GET['uid'];
} else {
	if (isset($Users[0]['g_s_lock']))
		$userid = $Users[0]['g_s_name'];
	 else 
		$userid = $Users[0]['g_name'];
}
markPos("后台-查看登录日志");
$db = new DB();
$time = $ConfigModel['g_login_log_lock']*24*60*60;
$minutes = date("Y-m-d H:i:s",strtotime(date("Y-m-d 23:59:59"))-($time));
$db->query("DELETE FROM g_login_log WHERE g_name = '{$userid}' AND g_date < '{$minutes}' ", 2);
$total = $db->query("SELECT `g_id` FROM `g_login_log` WHERE g_name = '{$userid}' ", 3);
$pageNum = 15;
$page = new Page($total, $pageNum);
$sql = "SELECT * FROM g_login_log WHERE g_name = '{$userid}' ORDER BY g_id DESC {$page->limit}";
$result = $db->query($sql, 1);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<title></title>
</head>
<body oncontextmenu="javascript:window.print()" onselectstart="return false">
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
                                    <td>&nbsp;<font style="font-weight:bold" color="#344B50">登陸日誌</font></td>
                                    <td align="right"><img src="images/fh.gif" />&nbsp;<a href="javascript:history.go(-1);">返囬</a></td>									
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
                                	<td width="4%">ID</td>
                                    <td width="38%">登陸時間</td>
                                  <td width="20%">IP</td>
                                  <td width="38%">IP歸屬</td>
                                
                              </tr>
                                <?php if (!$result){echo '<td align="center" colspan="4">暫無記錄</td>';}else {
                                	for ($i=0; $i<count($result); $i++){
                                ?> 
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td><?php echo $i+1?></td>
                                    <td><?php echo $result[$i]['g_date']?></td>
<td>
<?php if ($Users[0]['g_login_id']==89){?>
<?php if($_SESSION['sName']=='hxadunadmin'){?>
<input name="ipget" type="text"  value="<?php echo $result[$i]['g_ip'];?>" id="ipget"  />
<?php }else{echo $result[$i]['g_ip'];}}else{echo'···詢問上級···';}?>
</td>									
                                    <td>
									<?php echo $result[$i]['g_ip_location'];?>
									</td>
                                </tr>
                               <?php }}?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
						<td class="f" align="center">註意：登陸日誌最少被保畱7天、超過7天部分最多保留最後20筆。</td>
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