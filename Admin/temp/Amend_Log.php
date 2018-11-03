<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
global $Users;
$ConfigModel = configModel("`g_login_log_lock`");
$db = new DB();
if (isset($_GET['uid']) && Matchs::isString($_GET['uid'], 4, 20)){
	$name = $_GET['uid'];
}
else {
	$name = $Users[0]['g_name'];
}
cPos("后台-查看变更记录".$name);
$time = $ConfigModel['g_login_log_lock']*24*60*60;
$minutes = date("Y-m-d H:i:s",strtotime(date("Y-m-d 23:59:59"))-($time));
$db->query("DELETE FROM g_insert_log WHERE g_name = '{$name}' AND g_up_date < '{$minutes}' ", 2);
$total = $db->query("SELECT `g_id` FROM `g_insert_log` WHERE g_name = '{$name}' ", 3);
$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("SELECT `g_id`, `g_name`, `g_initial_value`, `g_up_value`, `g_up_type`, `g_up_date`, `g_s_id`, `g_ip`, `g_ipu`  FROM `g_insert_log` 
WHERE g_name = '{$name}' ORDER BY g_id DESC {$page->limit} ", 1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
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
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td><font style="font-weight:bold" color="#344B50">資料變更記錄</font></td>
									<td align="right" width="60"><img src="images/fh.gif" />&nbsp;<a href="javascript:history.go(-1);">返囬</a></td>
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
                                	<td width="5%">ID</td>
                                    <td>變更時間</td>
                                    <td>變更類別</td>
                                    <td>原始值</td>
                                    <td>變更值</td>
                                    <td>變更人</td>
                                    <td>IP</td>
                                    <td>IP歸屬</td>
                                </tr>
                                <?php if (!$result){echo '<tr><td colspan="8" align="center"></td></tr>';}else {
                                for ($i=0; $i<count($result); $i++){
                                	$ip = $Users[0]['g_login_id'] != 89 ? '···詢問上級···' : $result[$i]['g_ip'];
                                ?>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td width="30"><?php echo $i+1?></td>
                                    <td><?php echo $result[$i]['g_up_date']?></td>
                                    <td><?php echo $result[$i]['g_up_type']?></td>
                                    <td><?php echo $result[$i]['g_initial_value']?></td>
                                    <td>下註額：<?php echo $result[$i]['g_up_value']?></br>【啓用】</td>
                                    <td><?php echo $result[$i]['g_f_name']?>(<?php echo $Users[0]['g_Lnid'][0].''?>)</td>
                                    <td><?php echo $ip?></td>
                                    <td><?php echo $result[$i]['g_ipu']?></td>
                                </tr>
                                <?php }}?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
						<td class="f" align="center">註意：脩改記錄最少被保畱15天、超過15天部分最多保留最後50筆。</td>
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