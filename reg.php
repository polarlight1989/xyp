<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
//include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'admin/config/config.php';
include_once ROOT_PATH.'admin/config/global.php';
global $Users, $LoginId, $ConfigModel;
$s = ""; //請選擇上級！
	if (isset($_GET['did']))
   {
	$s = $_GET['did'];
	}else {
	$s = "aa44";//默认上級！
	}
	/*$sql2211="SELECT * FROM `g_rank` WHERE `g_name` = '{$s}' LIMIT 1";
	//echo $sql22;
	$ok1 = $db->query($sql2211, 0);
	//echo $ok1[0][0];
	if($ok1[0][0]!="")
	{*/
if (isset($_GET['actions']))
{
   if ($_POST['s_Name']==null)
	{
	alert_href($_POST['s_Name'].'用户名不能为空，请重新注册！', 'reg.php');
	exit;
	}
	if ($_POST['s_pwd']!=$_POST['s_pwd2'])
	{
	alert_href('两次输入的密码不一致，请重新填写！', 'reg.php');
	exit;
	}
	if ($_POST['qq']==null)
	{
	alert_href('请填写联系方式！', 'reg.php');
	exit;
	}
   $sql11="SELECT `g_name` FROM `g_user` WHERE g_name = '{$_POST['s_Name']}' LIMIT 1 ";
   $rr1_name= $db->query($sql11, 0);
  // echo $rr1_name[0][0];
    if ($_POST['s_Name']==$rr1_name[0][0]) 
	{
	//echo 222222222;
	alert_href($_POST['s_Name'].'用户已经存在，请重新注册！', 'reg.php');
	exit;
	}
	
	if (!isset($_POST['s_Name']) || !Matchs::isString($_POST['s_Name'], 4,10)) exit(back('您輸入的帳號錯誤！'));
	if (!isset($_POST['s_F_Name']) || !Matchs::isStringChi($_POST['s_F_Name'])) exit(back('您輸入的名稱錯誤！'));
	if (!isset($_POST['s_Pwd']) || !Matchs::isString($_POST['s_Pwd'], 8, 20)) exit(back('請輸入密碼！'));
	//if (!isset($_POST['s_money']) || !Matchs::isNumber($_POST['s_money'])) exit(back('信用額錯誤！'));
	//if (!isset($_POST['Size_KY']) || !Matchs::isNumber($_POST['Size_KY'])) exit(back('占成錯誤！'));
	//if (!isset($_POST['user_lock']) || !Matchs::isNumber($_POST['user_lock'])) exit(back('限額錯誤！'));
	//zerc20120805
	//if (!isset($_POST['s']) || !Matchs::isString($_POST['s'])) exit(back('請選擇上級！'));
	$sid = 0;
	
	$s_Name = $_POST['s_Name'];
	$s_F_Name = $_POST['s_F_Name'];
	$s_Pwd = $_POST['s_Pwd'];
	$s_money = 0;//注册默认信用額
	$s_Size_KY = 0;//daili占成
	$s_pan = "A";
	$s_select = "add";
	
	$sql22="SELECT * FROM `g_rank` WHERE `g_name` = '{$s}' LIMIT 1";
	//echo $sql22;
	$p_result = $db->query($sql22, 0);
	//$p_result = $userModel->GetUserModel(null, $s);
	if ($sid == 2) 
	{
		if ($ConfigModel['g_son_member_lock'] != 1) 
			exit(back('權限不足，無法新增直屬會員！'));
		$s_Nid = $p_result[0]['g_nid'].md5(uniqid(time(),true));
		$Lid = $userModel->GetLoginIdByString($p_result[0]['g_login_id']);
		if ($p_result[0]['g_login_id'] == 22) {
			$loid = 78;
		} else if ($p_result[0]['g_login_id'] == 78) {
			$loid = 48;
		} else if ($p_result[0]['g_login_id'] == 56) {
			$loid = 22;
		} else {
			$loid = 9;
		}
		
	}
	else 
	{
		$loid = 9;
		$s_Nid = $p_result[0][0];
		//echo $s_Nid;
	}
	if ($p_result[0]['g_login_id'] != 56 && ($sid == 2 || $sid == 1))
	{
		//得到當前用戶可用額
		if ($p_result[0]['g_login_id'] == 48)
		{
			$nid = $p_result[0]['g_nid'].'%';
			$validMoney = $p_result[0]['g_money'] - $userModel->SumMoney($nid, true);
		}
		else 
		{
			$nid = $p_result[0]['g_nid'].UserModel::Like();
			$validMoney = $p_result[0]['g_money'] - $userModel->SumMoney($nid);
		}
		if ($s_money > $validMoney)exit(back('上級可用餘額：'.$validMoney));
		if ($s_Size_KY > $p_result[0]['g_distribution'])exit(back('最高占成率：'.$p_result[0]['g_distribution']));
	}
	$userList = array();
	$userList['s_L_Name'] = $s;
	 
	$userList['g_nid'] = $s_Nid;
	$userList['g_login_id'] = $loid;
	$userList['g_name'] = $s_Name;
	$userList['g_f_name'] = $s_F_Name;
	$userList['g_mumber_type'] = 1;
	$userList['g_password'] = sha1($s_Pwd);
	$userList['g_money'] = $s_money;
	$userList['g_money_yes'] = $s_money;
	$userList['g_distribution'] = $s_Size_KY;
	$userList['g_tuishui'] = $s_select;
	//为会员分配盘口
	for($i=0;$i<count($s_pan);$i++){
	$s_panlus=$s_panlus.strtoupper($s_pan[$i]).',';
	}
	$s_panl=strtoupper($s_pan[0]);
	$userList['g_panlus'] = strtoupper($s_panlus);
	$userList['g_panlu'] = strtoupper($s_panl);
	
	
	$userList['g_xianer'] = 1000000;
	$userList['g_out'] = 1;
	$userList['g_look'] = 1;
	$userList['g_ip'] = UserModel::GetIP();
	$userList['g_date'] = date("Y-m-d H:i:s");
	$userList['g_uid'] = md5(uniqid(time(),true));
	 
	
	/**
	 * 新增會員
	 * Enter description here ...
	 * @param unknown_type $userList
	 */
	
		$sql = "INSERT INTO g_user (g_nid, g_login_id, g_name, g_f_name, g_mumber_type, g_password, g_money, g_money_yes, g_distribution, g_panlus,g_panlu, g_xianer, g_out, g_look, g_ip, g_pwd, g_date, g_uid) VALUES (
		'{$userList['g_nid']}',
		'{$userList['g_login_id']}',
		'{$userList['g_name']}',
		'{$userList['g_f_name']}',
		'{$userList['g_mumber_type']}',
		'{$userList['g_password']}',
		'{$userList['g_money']}',
		'{$userList['g_money_yes']}',
		'{$userList['g_distribution']}',
		'{$userList['g_panlus']}',
		'{$userList['g_panlu']}',
		'{$userList['g_xianer']}',
		'{$userList['g_out']}',
		'{$userList['g_look']}',
		'{$userList['g_ip']}',
		'0',
		'{$userList['g_date']}',
		'{$userList['g_uid']}') ";
		$db->query($sql, 2);
		//取出退水盤
		$lenght=0;
		$sql = "SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`";
		$P=$userList['g_panlus'];
		if(strstr($P,'A')!=''){$sql.=',g_a_limit ';$lenght++;}
		if(strstr($P,'B')!=''){$sql.=',g_b_limit ';$lenght++;}
		if(strstr($P,'C')!=''){$sql.=',g_c_limit ';$lenght++;}
		$sql = $sql."FROM `g_send_back` WHERE `g_name` = '{$userList['s_L_Name']}' ORDER BY g_id ASC ";
		
		$result = $db->query($sql, 0);
		//寫入退水盤
		$sql = " INSERT INTO `g_panbiao` (`g_nid`, `g_type`,`g_danzhu`, `g_danxiang`, `g_game_id`";
		if(strstr($P,'A')!=''){$sql.=',g_panlu_a ';}
		if(strstr($P,'B')!=''){$sql.=',g_panlu_b ';}
		if(strstr($P,'C')!=''){$sql.=',g_panlu_c ';}
		$sql = $sql.") VALUES ";
		for ($i=0; $i<count($result); $i++)
		{
			$sql.= "('{$userList['g_name']}', '{$result[$i][0]}', '{$result[$i][1]}', '{$result[$i][2]}', '{$result[$i][3]}'"; 			         for($m=1;$m<=$lenght;$m++){
			$flag=3+$m;
		//	$sql.=",'{$result[$i][$flag]}'";
		
		if($userList['g_tuishui']+$result[$i][$flag] > 100 ) {
		$sql.=",'100'";
		}
		if($userList['g_tuishui']+$result[$i][$flag] <= 100 ) {
			$temp=$result[$i][$flag]+$userList['g_tuishui'];
			$sql.=",'{$temp}'";
		}
			}
			
			$sql.=" ),";
						
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$db->query($sql, 2);
	
	alert_href($userList['g_name'].'用户注册成功！', 'index.php');
	exit;
	 
	
	
}



?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>用户注册</title>
    <script src="js/jquery.js"></script>
    <script src="admin/temp/js/Pwd_Safety.js"></script>
</head>

<style type="text/css">
    body{
        margin:0;
        padding:0;
        background:#100503;
    }
    .divFrame{
        width:980px;
        height:795px;
        margin:0 auto;
    }
    .divTop{
        height:634px;
        background:url("images/login/signup_top.jpg") no-repeat;
        position:relative;
    }
    .divBottom{
        height:161px;
        background:url("images/login/signup_bottom.jpg") no-repeat;
    }
    .regform1{
		position:absolute;
		left:393px;
		top:308px;
    }
    .regform1 table{
    	width:540px;
    }
    .left{
    	width:100px;
    	color:#FFD700;
    }
    .middle{
    	width:200px;
    	color:#ffd700;
    }
    .middle input{
	width:200px;
	font-size: 18px;
	color: #2B1005;
	border-top-color: #8F5530;
	border-right-color: #8F5530;
	border-bottom-color: #8F5530;
	border-left-color: #8F5530;
	background-color: #CCA061;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
    }
    td{
        height:40px;
        vertical-align : middle;

    }
    .impt{
	float:left;
	color:#FFCE85;
	height:40px;
	line-height:40px;
	font-size: 20px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: normal;
    }
    #msg1,#msg2,#msg3,#msg4{
    	color:#FFFFFF;
        font-size:12px;
        height:40px;
        line-height:40px;
    }
    label{
    	cursor:pointer;
    	color:#FFFF00;
    	font-size:14px;
    }
    #validate{
    	width:550px;
    	height:530px;
    	position:absolute;
    	color:#FFD700;
    }
    ul{
    	margin:0;
    	padding:0;
    }
    #back{
    	font-size:24px;
    	width:110px;
    	height:37px;
    	line-height:37px;
    	position:absolute;
    	margin-top:20px;
    	margin-left:440px;
    	color:#000;
    	text-decoration:none;
    	text-align:center;
    	background:url("images/login/btn.jpg");
    }
    .sub{
		width:300px;
        height:37px;
		margin:0 auto;
    }
    .sub input{
	width:110px;
	height:37px;
	line-height:normal;
	text-align:center;
	background:url("images/login/btn.jpg");
	border:none;
	font-size:20px;
	cursor:pointer;
	float:left;
	font-weight: normal;
	color: #36180D;
	font-style: normal;
	font-variant: normal;
	font-family: "黑体";
    }
.STYLE8 {color: #FFFFFF}
</style>

<body>
    <div class="divFrame">
    	<form action="?actions=add" method="post" onSubmit="return checkValues()">
    	<div class="divTop">
    		<div class="regform1" id="regform1">
				<table cellspacing="0">
					<tr>
						<td class="middle"><input type="text" Maxlength="20" name='s_F_Name' id='s_F_Name' /></td>
						<td><div class="impt">*</div></td>
					</tr>
					<tr>
						<td class="middle"><input type="text" Maxlength="20" name='s_Name' id='s_Name' onBlur="checkID(this.value)" /></td>
						<td><div class="impt">*[所属代理（<?php echo $s;?>）]</div><div id='msg1'>
						  <div align="left"></div>
						</div></td>
					</tr>
					<tr>
						<td class="middle"><input type="password" Maxlength="20" name="s_Pwd" id="s_Pwd" onBlur="checkPwd(this.value)" /></td>
						<td><div class="impt">*</div><div id='msg2'></div></td>
					</tr>
					<tr>
						<td class="middle"><input type="password" Maxlength="20" name="s_Pwd2" id="s_Pwd2" onBlur="checkCPwd(this.value)" /></td>
						<td><div class="impt">*</div><div id='msg3'></div></td>
					</tr>
					<tr>
						<td class="middle"><input type="text" Maxlength="20" name="qq" id="qq" onBlur="checkID(this.value)" /></td>
						<td><div class="impt">*</div><div id='msg1'>
						  <div align="left"></div>
						</div></td>
					</tr>
					</tr>					
			  </table>
		  </div>
    	</div>

    	<div class="divBottom">
            <div class="sub">
                <input type="reset" value="重置" />
                <input type="submit" name="submit" id="submit" style="float:right" value="注册" />
            </div>
        </div>
        </form>
    </div>
</body>
</html>
