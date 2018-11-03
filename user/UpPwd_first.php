<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['VIP_PWD_old']))
{
	$aPwd = sha1($_POST['VIP_PWD_old']);
	$bPwd = sha1($_POST['VIP_PWD']);
	$cPwd = $_POST['VIP_PWD1'];
	$db = new DB();
	$sql = "SELECT `g_name` FROM `g_user` WHERE `g_password` = '{$aPwd}' LIMIT 1 ";
	if (!$db->query($sql, 0)) exit(alert_href("原密碼輸入錯誤，請重新輸入！", "uppwd_first.php"));
	$sql = "UPDATE `g_user` SET `g_password` = '{$bPwd}' , g_pwd=0  WHERE `g_name` = '{$user[0]['g_name']}' ";
	if ($db->query($sql, 2))
	{
		alert_href("密碼已脩改，請從新登陸!!!", "Quit.php");
		exit;
	}
}
markPos("前台-修改密码");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./js/Pwd_Safety.js"></script>
<title>Welcome !!</title>
<SCRIPT type="text/javascript">
//if (top.location == self.location) top.location.href = "../"; 
</script>
<script type="text/javascript">
function SubChk(){
    if(document.all.VIP_PWD_old.value.length == ""){
	    alert("請輸入原密碼！");
	    document.all.VIP_PWD_old.focus();
	    return false;
    }
    if(document.all.VIP_PWD.value.length < 8 || document.all.VIP_PWD.value.length > 20){
	    alert("新密碼 請填寫 8 位或以上（最長20位）！");
	    document.all.VIP_PWD.focus();
	    return false;
    }
    if(document.all.VIP_PWD.value != document.all.VIP_PWD1.value){
	    alert("新密碼 和 新密碼確認 不一樣！(確認大小寫是否相同)");
	    document.all.VIP_PWD.focus();
	    return false;
    }
    if(document.all.VIP_PWD.value == document.all.VIP_PWD_old.value){
	    alert("新密碼 不能使用 原密碼 請脩改");
	    document.all.VIP_PWD.focus();
	    return false;
    }
    if(Pwd_Safety(document.all.VIP_PWD.value)!=true) return false;
}
</script>
</head>
<div style="display:none">
</div>
<body onselectstart="return false">
<center>
<form action="" method="post" onsubmit="return SubChk()">
<input type="hidden" name="sid" value="yes" />
<table border="0" cellpadding="0" cellspacing="0" width="700" align="center">
    <tr>
        <td>
<table border="0" cellpadding="0" cellspacing="1" class="t_list" width="700">
        <tr class="t_list_caption_1" height="26">
            <td colspan="2"><b>變更密碼</b></td>
        </tr>
        <tr style="height:28px">
            <td style="text-align:right" class="t_td_caption_1" width="245">原密碼：</td>
            <td class="t_Edit_td" align="left"><input style="width:132px;" onfocus="this.className='inp1m'" onblur="this.className='inp1'" class='inp1' type="password" name="VIP_PWD_old" /></td>
        </tr>
        <tr style="height:28px">
            <td style="text-align:right" class="t_td_caption_1" width="245">新密碼：</td>
            <td class="t_Edit_td" align="left"><input type="password" style="width:132px;" onfocus="this.className='inp1m'" onblur="this.className='inp1'" class='inp1' name="VIP_PWD" /></td>
        </tr>
        <tr style="height:28px">
            <td  style="text-align:right" class="t_td_caption_1" width="245">確認密碼：</td>
            <td class="t_Edit_td" align="left"><input type="password" style="width:132px;" onfocus="this.className='inp1m'" onblur="this.className='inp1'" class='inp1' name="VIP_PWD1" /></td>
        </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="700">	
        <tr>
        	<td align="center" height="65">
			<input type="submit" class="inputa_2" value="確定脩改" />			
			</td>
			                               
        </tr>
</table>
        </td>
    </tr>
</table>
</form>
</center>
</body>
</html>