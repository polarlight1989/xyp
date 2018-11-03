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

$db = new DB();

$total = $db->query("SELECT `g_id` FROM `g_qdetail` WHERE g_name = '{$userid}' ", 3);
$pageNum = 15;
$page = new Page($total, $pageNum);
$sql = "SELECT * FROM g_qdetail WHERE g_name = '{$userid}' ORDER BY g_id DESC {$page->limit}";
$result = $db->query($sql, 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<title>充提记录</title>

</head>
<body onload="isReady=true;window.focus()">
<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#5a5a5a"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Admin/temp/images/tab_05.gif">
                        	
                        </td>
                        <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
	
                        <!-- end -->
						
						  <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<td colspan="6">充提记录</td>
									
                                </tr>
								<tr class="tr_top">
								    <td >ID</td>
									<td >操作时间</td>
                                	<td >会员账号</td>
									<td >操作状态</td>
									<td >操作金额</td>
									<td >账号余额</td>
                                </tr>
							 <?php if (!$result){echo '<td align="center" colspan="6">暫無記錄</td>';}else {
                                	for ($i=0; $i<count($result); $i++){
                                ?> 
								<tr>
								 <td class="left_p6" align="center"><?php echo $i+1?></td>
								<td class="left_p6" align="center"><?php echo $result[$i]['g_date']?></td>
								<td class="left_p6" align="center"><?php echo $result[$i]['g_name']?></td>
								<td class="left_p6" align="center"><?php echo $result[$i]['g_state']?></td>
								<td class="left_p6" align="center"><?php echo $result[$i]['g_money']?></td>
								<td class="left_p6" align="center"><?php echo $result[$i]['g_autoc']?></td>
								</tr>
								<?php }}?>
						</table>
						
                        </td>
                        <td class="r"></td>
                    </tr>
					<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="right"><?php echo $page->fpage(array(0,1, 3,4,5,6,7))?></td>
                        <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
            </td>
            <td width="6" bgcolor="#5a5a5a"></td>
        </tr>
        <tr>
        	<td height="6" bgcolor="#5a5a5a"></td>
            <td bgcolor="#5a5a5a"></td>
            <td height="6" bgcolor="#5a5a5a"></td>
        </tr>
    </table>
</body>
</html>