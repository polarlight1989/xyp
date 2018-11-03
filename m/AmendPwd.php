<?
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	global $user;
	$aPwd = sha1($_POST['VIP_PWD_old']);
	$bPwd = sha1($_POST['VIP_PWD']);
	$cPwd = $_POST['VIP_PWD1'];
	$db = new DB();
	$sql = "SELECT `g_name` FROM `g_user` WHERE `g_password` = '{$aPwd}' and `g_name` = '{$user[0]['g_name']}' LIMIT 1 ";
	if (!$db->query($sql, 0))  exit('原密碼輸入錯誤，請重新輸入！');
	$sql = "UPDATE `g_user` SET `g_password` = '{$bPwd}' , g_pwd=0  WHERE `g_name` = '{$user[0]['g_name']}' ";
	if ($db->query($sql, 2))
	{
		echo 'true';
		exit;
	}
}
markPos("前台-修改密码");
?><!DOCTYPE html>  
<html>  
<head>  
<title>修改密碼</title>  
<link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
<link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="js/jquery.mobile-1.4.3.js" type="text/javascript"></script>
    <script src="js/jquery.showLoading.min.js" type="text/javascript"></script>
    <script src="js/Pwd_Safety.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>  
<body>  	
<div data-role="page" id="Top_allPwd"> 
<script language="javascript" type="text/javascript">
    function SubChk() {
        if ($("#VIP_PWD_old").val().length == "") {
            alert('請輸入舊密碼！', function () { $("#VIP_PWD_old").focus(); });
            return false;
        }
        if ($("#VIP_PWD").val().length < 8 || $("#VIP_PWD").val().length > 20) {
            alert('新密碼 請填寫 8 位或以上（最長20位）！', function () { $("#VIP_PWD").focus(); });
            return false;
        }
        if ($("#VIP_PWD").val() != $("#VIP_PWD1").val()) {
            alert('新密碼 和 新密碼確認 不一樣！(確認大小寫是否相同)！', function () { $("#VIP_PWD").focus(); });
            return false;
        }
        if ($("#VIP_PWD").val() == $("#VIP_PWD_old").val()) {
            alert('新密碼 不能使用 原密碼 請脩改！', function () { $("#VIP_PWD").focus(); });
            return false;
        }
        if (Pwd_Safety($("#VIP_PWD").val()) != true) return false;
        if (!confirm("是否確定要修改密碼？")) { return false; }
        Get_Ps();
    }

    function Get_Ps() {
        $('#Top_allPwd').showLoading();
        $.ajax({
            type: 'POST',
            url: "?",
            data: $('#profileForm').serialize(), // 你的formid 
            error: function () { alert('处理程序出错,请通知管理员检查！'); },
            success: function (msg) {
                if (msg == "true") {
                    alert("已經成功修改密碼！！請重新登入！！！");
                    //$.mobile.changePage("Default.php", "slideup");
                    window.location = "Login.php";
                }
                else {
                    alert(msg);
                }
            }
        })
    }
</script>
	<div data-role="header">
		<a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext"></a>
		<h1>修改密碼</h1>
		<a href="Main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse" ></a>
	</div> 
	<div data-role="content" class="pm">	
		<!--修改密码-->
        <form action="?" method="post" name="profileForm" id="profileForm">
		<div class="passBox">
			<div class="box">
				<ul>
					<li><span>輸入舊密碼:&nbsp;</span><label><input name="VIP_PWD_old" id="VIP_PWD_old" type="password" /></label></li>
					<li><span>輸入新密碼:&nbsp;</span><label><input name="VIP_PWD" id="VIP_PWD" type="password" /></label></li>
					<li class="none"><span>確認新密碼:&nbsp;</span><label><input name="VIP_PWD1" id="VIP_PWD1" type="password" /></label></li>
				</ul>
			</div>
			
		<div class="clear"></div>
		</div>
		<div style="margin:5% auto; width:90%;" ><input type="button" value="確認修改" onClick="javascript:SubChk()" /></div>
        </form>
	</div> 
<? include 'footer.php';?>
<? include 'left.php';?>
</div> 
<script language="javascript" type="text/javascript">
    $("#VIP_PWD_old").val("");
    $("#VIP_PWD").val("");
    $("#VIP_PWD1").val("");
    document.forms[0].autocomplete = "off";
</script>
</body> 
</html>  