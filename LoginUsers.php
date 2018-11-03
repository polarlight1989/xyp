<?php 
if (!defined('ROOT_PATH'))
exit('invalid request');
if (!defined('Copyright') || Copyright != 'Author QQ: 1234567')
exit('Sorry, the page wrong path');
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
	//驗證碼匹配
	if ($_POST['ValidateCode'] == $_SESSION['VCODE'])
	{
		if ($ConfigModel['g_web_lock'] != 1) exit(back($ConfigModel['g_web_text']));
		//瀏覽器檢測、只支持IE核心
		if (!GetMsie()) exit(back($UserError));
		//驗證用戶和密碼是否存在
//		alert(checkStr($_POST['loginName']));
//		$loginName = $_POST['loginName'];
		$loginName = checkStr($_POST['loginName'])?checkStr($_POST['loginName']):alert1("账号错误1！");
		$loginPwd = sha1($_POST['loginPwd']);
		$db = new DB();
		$sql = "SELECT * FROM `g_user` WHERE `g_name` = '{$loginName}' AND `g_password` = '{$loginPwd}' LIMIT 1 ";
		$result = $db->query($sql, 1);
		if ($result)
		{
			//判斷帳號是否已被停用
			if ($result[0]['g_look'] == 3) exit(back($UserLook));
			$uniqid = md5(uniqid());
			$loginIp = GetIP();
			$loginDate = date("Y-m-d H:i:s");
			$sql = "UPDATE `g_user` SET `g_uid` = '{$uniqid}', `g_ip` = '{$loginIp}', `g_date` = '{$loginDate}', `g_out` =1, `g_count_time`=now(),`g_state` =1 WHERE `g_name` = '{$loginName}' AND `g_password` = '{$loginPwd}' ";
			$db->query($sql, 2);
			$qqWryInfo = ROOT_PATH.'tools/IpApi/QQWry.Dat';
			$ip_s = ipLocation($loginIp, $qqWryInfo);
			$sql = "INSERT INTO g_login_log (g_name, g_ip, g_ip_location, g_date) VALUES ('{$loginName}','{$loginIp}','{$ip_s}',now())";
			$db->query($sql, 2);
			$_SESSION['g_S_name'] = $result[0]['g_name'];
			setcookie("g_user", base64_encode($loginName), 0, "/");
			setcookie("g_uid", base64_encode($uniqid), 0, "/");
			include_once ROOT_PATH.'ValiDa.php';
			exit;
		}
		else 
		{
			back($UserError);
			exit;
		}
	} 
	else 
	{
		back($CodeError);
		exit;
	}
} 
else
{
	$num = array();
	for ($i=0; $i<4; $i++) 
	{
		$num[$i] = rand(0,9);
	}
	$num = join('', $num);
	$_SESSION['code'] = $num;
}


 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户登录</title>
<link href="css/login1.css" rel="stylesheet" type="text/css" />
<SCRIPT type="text/javascript" src="js/Forbid.js"></SCRIPT>
<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.artDialog.js?skin=aero"></script>
<script type="text/javascript" src="js/iframeTools.js"></script>
<script Language="JavaScript">
<!--
    function finalcheck() {
        if ($.trim($("#loginName").val()) == "") {
            art.dialog.alert('請填寫“帳號”！', function () { $("#loginName").focus(); });
            return false;
        }
        if ($.trim($("#loginPwd").val()) == "") {
            art.dialog.alert('請填寫“密碼”！', function () { $("#loginPwd").focus(); });
            return false;
        }
        if ($.trim($("#ValidateCode").val()) == "") {
            art.dialog.alert('請填寫“安全碼”！', function () { $("#ValidateCode").focus(); });
            return false;
        }
        //$("#Submit").attr("disabled", true); //启用不可用
        $("#form_login").submit();
        return false;
}
function digitOnly(evt) {
    var code = (evt.keyCode ? evt.keyCode : evt.which);  //兼容火狐 IE  

    if (!(code >= 48 && code <= 57 || code == 45)) {
        evt.keyCode = "";
    }
}
$(document).ready(function () {
    $("#form_login input").keydown(function (e) {
        var curKey = e.which;
        if (curKey == 13) {
            $("#Submit").click();
            return false;
        }
    });

    $("#ValidateCode").keyup(function () {
        $(this).val($(this).val().replace(/[^0-9.]/g, ''))
    }).bind("paste",
function () {
    $(this).val($(this).val().replace(/[^0-9.]/g, ''))
}).css("ime-mode", "disabled");

    $("#ValidateImage").click(function () {
        $("#ValidateImage").attr("src", "yzm.php?time=" + Math.random());
        $("#ValidateImage").show();
    });
    $("#ValidateCode").focus(function () {
        $("#ValidateCode").val('');
        $("#ValidateImage").trigger("click");
    });
   
    $("#loginName").focus(function () {
          $("#ValidateImage").hide();
        $("#ValidateImage").attr("src", "images/loaddata2.gif");

    });
	$("#loginPwd").focus(function () {
          $("#ValidateImage").hide();
        $("#ValidateImage").attr("src", "images/loaddata2.gif");

    });
}); 
//-->
</script>

<style type="text/css">
	.code {TEXT-ALIGN: center; LINE-HEIGHT: 27px; WIDTH: 90px; FONT-FAMILY: Verdana, 宋体, fantasy; LETTER-SPACING: 8px; HEIGHT: 29px; COLOR: #d7da89; FONT-SIZE: 22px; cursor:default;
	background:url(images/333.php) repeat;}


</style>

</head>
<body>
<form id="form_login" action="" method="post" name="form_login" >
<div class="line"><div class="clear"></div></div>
<div class="box">
	<div class="top"></div>
	<div class="boxBg"  id="Top_all">
		<ul>
		<li><input type="text" value="" id="loginName" name="loginName" tabindex="1" class="text" /></li>
		<li><input type="password" value="" tabindex="2" id="loginPwd"  name="loginPwd"  class="text" /></li>
		<li><input type="text" id="ValidateCode" name="ValidateCode"  tabindex="3" maxlength="5" class="w100 text" />
       &nbsp;<span id="code" class="code">
       
       <img  id="ValidateImage"  src="yzm.php" align="bottom">
       </span>
       </li>
		</ul>
	<div class="clear"></div>
	</div>
	<div class="bottom"><input id="Submit" name="Submit" type="button" class="btn" onMouseOut="this.className='btn'" onMouseOver="this.className='btn_m'" onclick="this.className='btn_o';finalcheck();" /></div>
<div class="clear"></div>
</div>
</form>
</body>
</html>