<?
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
global $user;
?><!DOCTYPE html>  
<html>  
<head>  
<title>登陸日誌</title>  
<link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.mobile-1.4.3.js"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
<meta content="telephone=no" name="format-detection" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>  
<body>  	
<div data-role="page" id="dataPageLoginLog">
	<div data-role="header" data-position="fixed">
		<a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext"></a>
		<h1>登陸日誌</h1>
        <a href="Main.aspx" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse"></a>
		</div> 
    <div data-role="content" class="pm">
    
       <table class="tableBox">
        <tr>
          	<th>ID</td>
			<th>登陸時間</td>
            <th>IP</td>
            <th>IP歸屬</td>
		</tr>
    <?
    $sql = "SELECT * FROM g_login_log WHERE g_name = '".$user[0]['g_name']."' ORDER BY g_id DESC limit 50";
$result = $db->query($sql, 1);
 if (!$result){echo '<tr><td align="center" colspan="4">暫無記錄</td></tr>';}else {
	 for ($i=0; $i<count($result); $i++){
		 $ip_arr= explode('.',$result[$i]['g_ip']);
		 $ip=$ip_arr[0].'.'.$ip_arr[1].".*.*";
	?>           
  <tr>
    <td><?=$i+1?></td>
    <td><?php echo $result[$i]['g_date']?></td>
	<td><?=$ip?></td>
    <td><?php echo $result[$i]['g_ip_location'];?></td>
  </tr>
<?
 }}
?>
        <tr class="tdBg">
            <td colspan="4">註意：登陸日誌最多保留最後50筆。 </td>
        </tr>
    </table>
    </div>
<? include 'footer.php';?>
<? include 'left.php';?>
</div> 
</body> 
</html>  