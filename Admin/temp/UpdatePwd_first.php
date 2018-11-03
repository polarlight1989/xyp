<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $Users, $LoginId;
markPos("后台-修改密码");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['s_pwd']))
{
	$s_pwd = sha1($_POST['s_pwd']);
	$new_pwd = $_POST['new_pwd'];
	if (!Matchs::isString($new_pwd, 8, 20)) exit(back('新密碼 請填寫 8 位或以上（最長20位）！'));
	$pwd = "`g_rank`";
	$new_pwd = sha1($new_pwd);
	$db=new DB();
	
	$g_name = "g_name";
	$sname = $Users[0]['g_name'];
	
	if ($db->query("SELECT {$g_name} FROM {$pwd} WHERE {$g_name} = '{$sname}' AND g_password = '{$s_pwd}' LIMIT 1", 0)){

		$sql = "UPDATE {$pwd} SET g_password = '{$new_pwd}' , g_pwd=0 WHERE {$g_name} = '{$sname}' LIMIT 1";
		
		if ($db->query($sql, 2)){
			exit(alert_href('密碼已修改，請重新登陸！', 'Quit.php'));
		} else {
			exit(back('更變失敗！'));
		}
	} else {
		exit(back('原始密碼錯誤！'));
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Admin/temp/js/Pwd_Safety.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function isPwd(){
		var s_pwd = $("#s_pwd").val();
		var new_pwd = $("#new_pwd").val();
		var f_pwd = $("#f_pwd").val();
		if (s_pwd == ""){
			alert("請輸入原始密碼！");
		    return false;
		}
		if (s_pwd.length <8 || s_pwd.length >20){
			alert("原密碼輸入錯誤，請重新輸入！");
		    return false;
		}
		if (new_pwd.length <8 || new_pwd.length >20){
			alert("新設密碼 請填寫 8 位以上（最長20位）！");
		    return false;
		}
		if (new_pwd != f_pwd){
			alert("新設密碼 和新設密碼確認 不一樣！（確認大小寫是否相同）");
		    return false;
		}
		if (new_pwd == s_pwd){
			alert("新設密碼 不能使用 原始密碼 請脩改");
		    return false;
		}
		if(Pwd_Safety(new_pwd)!=true) {
			return false;
		}
		return true;
	}
-->
</script>
</head>
<body onselectstart="return false">
<form method="post" action="" onsubmit="return isPwd()" >
<input type="hidden" name="sid" value="yes" />
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
            <td class="c">
            	<table border="0" cellspacing="0" class="main" width="100%" height="100%">
                	<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
						<td background="/Admin/temp/images/tab_05.gif">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
					    <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
						<td width="99%"><font style="font-weight:bold" color="#344B50">變更密碼</font></td>
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
                                <tr style="height:30px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="bj">原始密碼</td>
									<td class="left_p5"><input type="password" id="s_pwd" name="s_pwd" style="width:149px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' /></td>
                                </tr>
                                <tr style="height:30px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="bj">新設密碼</td>
                                    <td class="left_p5"><input type="password" id="new_pwd" name="new_pwd" style="width:149px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' /></td>
                                </tr>
                                <tr style="height:30px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="bj">確認密碼</td>
                                    <td class="left_p5"><input type="password" id="f_pwd" name="f_pwd" style="width:149px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' /></td>
                                </tr>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><font color="#344B50"><input type="submit" class="inputs" value="確定脩改" /></font></td>
                        <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
</body>
</html>