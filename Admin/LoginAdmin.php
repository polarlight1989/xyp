<?php 
if (!defined('Copyright') && Copyright != 'Sorry, the page wrong path')
exit('Sorry, the page wrong path');
if (!defined('ROOT_PATH'))
exit('invalid request');
include_once ROOT_PATH.'Admin/config/globalge.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
global $ConfigModel;
if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
	//驗證碼匹配
	if (isset($_SESSION['Mcode']) && $_POST['ValidateCode'] == $_SESSION['VCODE'])
	{
		$loginName = $_POST['loginName'];
		$loginPwd = sha1($_POST['loginPwd']);
		setcookie('dlName',$loginName,time()+3600);
		
		//瀏覽器檢測、只支持IE核心
		if (!GetMsie()) exit(back($UserError));
		//if (!Matchs::isString($loginName, 4, 15)) 
			//exit(back($UserError));
		$UserModel = new UserModel();
		//$Userjs = $UserModel->ExistUnion($loginName,$loginPwd);
		$User = $UserModel->ExistUnion($loginName, $loginPwd);
 	    // dump($Userjs[0][0]);
		if (!$User) exit(back($UserError));
		if(is_numeric($User[0][0])  && $User[0][0]<90) {
		//if (!Matchs::isNumber($User[0][0]))
			if (isset($_SESSION['son']))  unset($_SESSION['son']);
			$User = $UserModel->GetUserModel($User[0][0], $loginName, $loginPwd);
			if (!$User) exit(back($UserError));
			if ($User[0]['g_login_id'] != 89){
				//setcookie('s_id',1,time()+3600);//管理员
				if ($ConfigModel['g_web_lock'] != 1)
					exit(back($ConfigModel['g_web_text']));
				if ($User[0]['g_lock'] == 3) 
					exit(back($UserLook));
			}
			$trxt=uniqid(time(),TRUE);
			$uniqid=md5($trxt);
			$UserModel->UpdateGuid ($User[0]['g_login_id'], $User[0]['g_name'], $uniqid);
			$mgename=$User[0]['g_name'];
			if ($User[0]['g_login_id']==89){
			$db->query("UPDATE `j_manage` SET `g_unid` = '{$trxt}' WHERE `g_name` = '{$mgename}' LIMIT 1 ", 2);
			}else{
			$db->query("UPDATE `g_rank` SET `g_unid` = '{$trxt}' WHERE `g_name` = '{$mgename}' LIMIT 1 ", 2);
			}
			$_SESSION['loginId'] = $User[0]['g_login_id'];
			$_SESSION['sName'] = $User[0]['g_name'];
			$_SESSION['manege_ch'] = $uniqid;
		}else 
		{ //子帳號
			if ($ConfigModel['g_web_lock'] != 1) 
				exit(back($ConfigModel['g_web_text']));
			$User = $UserModel->GetUserModel(null, $loginName, $loginPwd, true);
			if ($User[0]['g_s_lock'] == 3 || $User[0]['g_lock'] == 3) 
				exit(back($UserLook));
		    $trxt=uniqid(time(),TRUE);
			$uniqid=md5($trxt);
			$UserModel->UpdateGuid ($User[0]['g_login_id'], $User[0]['g_s_name'], $uniqid, true);
			$db->query("UPDATE `g_relation_user` SET `g_unid` = '{$trxt}' WHERE `g_s_name` = '{$loginName}' LIMIT 1 ", 2);
			$_SESSION['son'] = true;
			$_SESSION['loginId'] = $User[0]['g_login_id'];
			$_SESSION['sName'] = $User[0]['g_s_name'];
			$_SESSION['manege_ch'] = $uniqid;
			
		} 
		setcookie("manage_user", base64_encode($loginName), 0, "/");
		setcookie("manage_uid", base64_encode($uniqid), 0, "/");
		 unset($_SESSION['Mcode']);
		$text=date("Y-m-d H:i:s"); 
		$loginIp = GetIP();
		$qqWryInfo = ROOT_PATH.'tools/IpApi/QQWry.Dat';
		$ip_s = ipLocation($loginIp, $qqWryInfo);
		$sql = "INSERT INTO g_login_log (g_name, g_ip, g_ip_location, g_date) VALUES ('{$loginName}','{$loginIp}','{$ip_s}',now())";
		$db=new DB();
		$db->query($sql, 2);
		$s_sha=sha1($text);
		$_SESSION['manege_sh'] = $s_sha;
		$db->query("DELETE FROM `g_login_tj` WHERE s_name  = '{$loginName}' ", 2);
		$db->query("INSERT INTO `g_login_tj` (`s_name`, `s_ip`, `s_ip_location`, `s_date`,`s_sha`) VALUES ('{$loginName}', '{$loginIp}', '{$ip_s}', '{$text}', '{$s_sha}' ) ", 2);
		include_once ROOT_PATH.'Admin/mainframe.php';
		exit;
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
	$_SESSION['Mcode'] = $num;
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理登录</title>
<link href="Admin/css/login.css" rel="stylesheet" type="text/css" />
<link href="Admin/css/showLoading.css" rel="stylesheet" type="text/css" />
<SCRIPT type="text/javascript" src="Admin/js/Forbid.js"></SCRIPT>
<SCRIPT type="text/javascript" src="Admin/js/checkdata.js"></SCRIPT>
<script type="text/javascript" src="js/jquery-1.11.0.min.js" ></script>
<script type="text/javascript" src="js/jquery.showLoading.min.js"></script>
<script type="text/javascript" src="js/jquery.artDialog.js?skin=green"></script>
<script type="text/javascript" src="js/iframeTools.js"></script>
<script Language="JavaScript">
<!--
    function finalcheck() {
        if ($.trim($("#loginName").val())=="") {
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
         $('#Top_all').showLoading();
        // $("#Submit").attr("disabled", true);
         $("#form_login").submit();
		return false;
	}
	function digitOnly(evt) 
    {
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
.code {TEXT-ALIGN: center; LINE-HEIGHT: 27px; WIDTH: 102px; DISPLAY: block; FONT-FAMILY: Verdana, 宋体, fantasy; LETTER-SPACING: 8px; HEIGHT: 29px; COLOR: #d7da89; FONT-SIZE: 22px; cursor:default}
.code img{
winth:100px;
height:32px;
float:right;
}
</style>

</head>
<body id="Top_all" style="height:100%">
<form name="form_login" method="post" id="form_login" action="">
<div class="line"><div class="clear"></div></div>
<div class="box">
	<div class="top"></div>
	<div class="boxBg">
		<ul>
		<li><input type="text" value="" id="loginName" name="loginName" tabindex="1" class="btn" /></li>
		<li><input type="password" value="" tabindex="2" id="loginPwd" name="loginPwd" class="btn" /></li>
		<li><input  type="text" id="ValidateCode" name="ValidateCode"  tabindex="3" maxlength="4" class="w100 btn" />
        <span class="code" id="code"><img   id="ValidateImage"  align="bottom" src="yzm.php"></span>
        </li>
		</ul>
	<div class="clear"></div>
	</div>
	<div class="bottom"><input id="Submit" name="Submit" type="button" class="btn" onMouseOut="this.className='btn'" onMouseOver="this.className='btn_m'" onclick="this.className='btn_o';if (finalcheck()==true) document.form_login.submit();" /></div>
<div class="clear"></div>
</div>
</form>
</body>
</html>
