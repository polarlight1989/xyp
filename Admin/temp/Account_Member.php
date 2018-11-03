<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
global $Users, $LoginId, $ConfigModel;
if ($Users[0]['g_login_id'] != 89) if ($Users[0]['g_lock'] == 2)
exit(back($UserOut)); //帳號已被凍結

//子帳號
if (isset($Users[0]['g_lock_2'])){
	if ( $Users[0]['g_s_lock'] == 2 || $Users[0]['g_lock_2'] != 1)
		exit(back($UserOut)); //帳號已被凍結
}

function UserUnion ($userName)
	{
        $db=new DB(); 	
	    $sql = "(SELECT g_id FROM `j_manage` WHERE `g_name` = '{$userName}' ) UNION ".
		"(SELECT g_nid FROM `g_rank` WHERE `g_name` = '{$userName}' ) UNION ".
		"(SELECT g_id FROM `g_user` WHERE `g_name` = '{$userName}' ) UNION ".
		"(SELECT g_id FROM `g_relation_user` WHERE `g_s_name` = '{$userName}' )  ";
		// alert1('{$eee}');
		return $db->query($sql, 0);
		
	}


cPos("后台-新增代理下属会员");
$userModel = new UserModel();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['sid']) && isset($_GET['cid']) && isset($_GET['actions']))
{
	if (!isset($_POST['s_Name']) || !Matchs::isString($_POST['s_Name'], 4,10)) exit(back('您輸入的帳號錯誤！'));
	if (!isset($_POST['s_F_Name']) || !Matchs::isStringChi($_POST['s_F_Name'])) exit(back('您輸入的名稱錯誤！'));
	if (!isset($_POST['s_Pwd']) || !Matchs::isString($_POST['s_Pwd'], 8, 20)) exit(back('請輸入密碼！'));
	if (!isset($_POST['s_money']) || !Matchs::isNumber($_POST['s_money'])) exit(back('信用額錯誤！'));
	if (!isset($_POST['Size_KY']) || !Matchs::isNumber($_POST['Size_KY'])) exit(back('占成錯誤！'));

	$sid = $_GET['sid'];
	$s = $_POST['s'];
	$s_Name = $_POST['s_Name'];
	$s_F_Name = $_POST['s_F_Name'];
	$s_Pwd = $_POST['s_Pwd'];
	$s_money = $_POST['s_money'];
	$money_dx = $_POST['money_dx'];
	$s_Size_KY = $_POST['Size_KY'];
	$s_pan = $_POST['s_pan'];
	$s_select = $_POST['select'];
	
	$p_result = $userModel->GetUserModel(null, $s);
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
		$s_Nid = $p_result[0]['g_nid'];
	}

	if ($LoginId != 0)//一切用户都不准 允许透支
	//if ($p_result[0]['g_login_id'] != 56 && ($sid == 2 || $sid == 1))//分公司
	{
		//得到當前用戶可用額
		if ($p_result[0]['g_login_id'] == 48)//代理
		{
			$nid = $p_result[0]['g_nid'].'%';
			$validMoney = $p_result[0]['g_money'] - $userModel->SumMoney($nid, true);
		}
		else 
		{
			$nid = $p_result[0]['g_nid'].UserModel::Like();
			$validMoney = $p_result[0]['g_money'] - $userModel->SumMoney($nid);
		}
		//if ($s_money > $validMoney)exit(back('上級可用餘額：'.$validMoney));
		if ($s_money > $validMoney)exit(back('上級可用餘額为：'.$validMoney.' 无法透支。'));
		if ($s_Size_KY > $p_result[0]['g_distribution'])exit(back('最高占成率：'.$p_result[0]['g_distribution']));
	}
	
	//$nid = $p_result[0]['g_nid'].UserModel::Like();
	//$validMoney = $p_result[0]['g_money'] - $userModel->SumMoney($nid);
	//if ($s_money > $validMoney)exit(back('上級可用餘額为：'.$validMoney.' 无法透支。'));
	
	$userList = array();
	$userList['s_L_Name'] = $s;
	$userList['g_nid'] = $s_Nid;
	$userList['g_login_id'] = $loid;
	$userList['g_name'] = $s_Name;
	$userList['g_f_name'] = $s_F_Name;
	$userList['g_mumber_type'] = $sid;
	$userList['g_password'] = sha1($s_Pwd);
	$userList['g_money'] = $s_money;
	$userList['money_dx'] = $money_dx;
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
	
	$userList['g_xianer'] = '5000000';
	$userList['g_out'] = 0;
	$userList['g_look'] = 1;
	$userList['g_ip'] = UserModel::GetIP();
	$userList['g_date'] = date("Y-m-d H:i:s");
	$userList['g_uid'] = md5(uniqid(time(),true));
	if ($userModel->ExistUnion($userList['g_name']))
	{
		alert_href('此用戶已存在', 'Actfor.php?cid='.$_GET['cid']);
		exit;
	}
	$userModel->AddMumberUser($userList);
	alert_href('新增成功，請設置退水項！', 'Member_MR.php?cid='.$_GET['cid'].'&uid='.$s_Name);
	exit;
}
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['sid']) && isset($_GET['cid']))
{
	$sid = $_GET['sid'];
	$cid = $_GET['cid'];
	if ($sid == 2){
		if ($ConfigModel['g_son_member_lock'] != 1) 
			exit(back('權限不足，無法新增直屬會員！'));
		$Munber = '直屬會員';
	} else {
		$Munber = '會員';
	}
	$Rank = UserModel::GetNextRank($cid, $LoginId, $Users);
	if ($sid == 1) //新增普通會員
	{
		//查詢當前用戶的代理
		$select = getSelect ($Rank, $userModel);
	}
	else 
	{
		//查詢直屬關係
		$o1 = '<tr><td class="bj" id="bj">上級直屬</td><td class="left_p5" id="pc">';
		$o2 = '&nbsp;&nbsp;<span id="FirstRankMoney"></span></td></tr>';
		$Rank[0] = '上級';
		if ($Users[0]['g_login_id'] == 89 || $Users[0]['g_login_id'] ==56)
		{
		$select =$o1.'<input type="radio" onclick="Gos(this);" name="tse" value="0">分公司&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="Gos(this);" name="tse" value="1">股東&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="Gos(this);" name="tse" value="2">總代理';
		}
		else if($Users[0]['g_login_id'] == 22) {
			$select =$o1.'<input type="radio" onclick="Gos(this);" name="tse" value="1">股東&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="Gos(this);" name="tse" value="2">總代理';
		} else if ($Users[0]['g_login_id'] == 78) {
			$select =$o1.'<input type="radio" onclick="Gos(this);" name="tse" value="2">總代理';
		}
	}
}elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['oopp']) && $_POST['oopp']=='chksname'){


if (UserUnion($_POST['pname']))
	{
		echo '1';
	}else{
		echo '0';
	}
	exit;
}

function getSelect ($Rank, $userModel, $p=FALSE)
{
	$select = null;
	$option1 = '<tr style="height:28px"><td class="bj" id="bj">上級'.$Rank[0].'</td><td class="left_p5" style="color:#0000FF"><select name="s" id="s" onchange="FirstRankMoney()">';
	$option2 = '</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="FirstRankMoney"></span></td></tr>';
	$result = $userModel->GetUserName_Like($Rank[2]);
	if ($result == null){
		$select = '<option value="0">暫無帳號</option>';
	}  else{
		for ($i=0; $i<count($result); $i++){$select .= '<option value="'.$result[$i]['g_name'].'">'.$result[$i]['g_name'].'</option>';}
	}
	return $option1.$select.$option2;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Admin/temp/js/common.js"></script>
<script type="text/javascript" src="/Admin/temp/js/Pwd_Safety.js"></script>
<script type="text/javascript" src="/Admin/temp/js/ToRMB.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function Gos ($this){
		$.post("/Admin/temp/ajaxad/json.php", {typeid : "2", id : $this.value}, function (data){
			//alert(data);
			var pc = $("#pc");
			var p1 = '<select name="s" id="s" onchange="FirstRankMoney()">';
			var p2 = '</select>&nbsp;&nbsp;<span id="FirstRankMoney"></span>';
			var user = new Array();
			for (var i=0; i<data.user.length; i++){
				user.push('<option value="'+data.user[i]+'">'+data.user[i] + '</option>');
			}
			pc.html(p1 + user.join('') + p2);
			$("#bj").html("上級"+data.name);
			$("#zj").html(data.name+"佔成");
			FirstRankMoney($("#s"));
		}, "json");
	}
	
		 function ChkSName(p_name){
	 if(p_name==''){$('#s_name1').html('<font style="color:red">  帳號不能為空！！！</font>');return;}
		var p = [];
		p.push({name:"oopp",value:"chksname"});
		p.push({name:"pname",value:p_name});
		$.post("/Admin/temp/Account_Member.php", p, function (data){
			data = $.trim(data);
			if(data=="1"){
				$("#s_name1").html("  選擇帳號已被佔用，不可用！！！");
				$("#s_name1").css("color","#FF0000");
			}else{
				$("#s_name1").html("  選擇帳號可用！！！");
				$("#s_name1").css("color","#444444");
			}
		});
	} 

-->
</script>
<script>
function DX(n) {  //金额大写转换函数
 if (!/^(0|[1-9]\d*)(\.\d+)?$/.test(n))
 document.getElementById("rmb").innerHTML ="数据非法";
 var unit = "千百十亿千百十万千百十元角分", str = "";
 n += "00";
 var p = n.indexOf('.');
 if (p >= 0)
  n = n.substring(0, p) + n.substr(p+1, 2);
 unit = unit.substr(unit.length - n.length);
 for (var i=0; i < n.length; i++)
  str += '零一二三四五六七八九十'.charAt(n.charAt(i)) + unit.charAt(i);
  document.getElementById("rmb").innerHTML =str.replace(/零(千|百|十|角)/g, "零").replace(/(零)+/g, "零").replace(/零(万|亿|元)/g, "$1").replace(/(亿)万|壹(十)/g, "$1$2").replace(/^元零?|零分/g, "").replace(/元$/g, "");
  document.all.money_dx.value=str.replace(/零(千|百|十|角)/g, "零").replace(/(零)+/g, "零").replace(/零(万|亿|元)/g, "$1").replace(/(亿)万|壹(十)/g, "$1$2").replace(/^元零?|零分/g, "").replace(/元$/g, "");
}
</script>
</head>
<body onselectstart="return false">
<form method="post" action="?actions=add&cid=<?php echo $cid?>&sid=<?php echo $sid?>" onsubmit="return isPost()" >
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
                                    <td width="99%"><font style="font-weight:bold" color="#344B50"><?php echo $Munber?>&nbsp;->新增</font></td>
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
                            		<th colspan="2"><b>帳戶資料</b></th>
                            	</tr>
                            	<?php echo $select?>
                                <tr style="height:28px">
                                	<td class="bj">會員帳號</td>
                                	<td class="left_p5"><input style="width:85px;" class='inp1MM' name="s_Name" id="s_Name" onBlur="ChkSName(this.value);" maxlength="10" type="text" /><span id="s_name1"></span></td>
                                </tr>
								<tr style="height:28px">
                                	<td class="bj">登陸密碼</td>
                                    <td class="left_p5"><input style="width:139px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' name="s_Pwd" id="s_Pwd"  maxlength="20" /></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">會員名稱</td>
                                    <td class="left_p5"><input style="width:139px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM'  name="s_F_Name" id="s_F_Name" maxlength="20" /></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">信用額度</td>
                                    <td class="left_p5"><input style="width:75px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' name="s_money" id="s_money" onkeyup="DX(this.value);"   maxlength="10" value="0"  />
                                   <span class="red" style="font-weight:bold" name="rmb" id="rmb"></span><input  type="hidden"  id='money_dx' name='money_dx' value="" />
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj" id="zj"><?php echo $Rank[0]?>占成</td>
                                    <td class="left_p5"><input style="width:35px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' name="Size_KY" maxlength="3" value="0" />&nbsp;%&nbsp; <font id="Size_KY"></font> </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">開放盤口</td>
									<script type="text/javascript"> 
										function check(spanl){
   											var flag=0;
   										for(var i=0;i<document.getElementsByName("s_pan[]").length;i++){
       										if(document.getElementsByName("s_pan[]")[i].checked==true){
       											flag++;
    										}
   										}
  											 if(flag==0){
   												alert("最少必须分配一个盘口");
   												spanl.checked='checked';
   													return false;
   											}
   												return true;
									}
									</script> 
                                    <td class="left_p5">
                                    <input type="radio" value="a" name="s_pan[]"  checked="checked" onclick="check(this)" />A盤&nbsp;
                                    <input type="radio" value="b" name="s_pan[]"  onclick="check(this)" />B盤&nbsp;
                                    <input type="radio" value="c" name="s_pan[]"  onclick="check(this)" />C盤&nbsp;
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">退水設定</td>
                                    <td class="left_p5">
                                    	<select name="select" id="s_TS">
											<option selected="selected" value="0" style="color:#0000FF">水全退到底</option>
											<option value="0.3" style="color:#0000FF">賺取0.3退水</option>
											<option value="0.5" style="color:#0000FF">賺取0.5退水</option>
											<option value="1" style="color:#0000FF">賺取1.0退水</option>
											<option value="2" style="color:#0000FF">賺取2.0退水</option>
                                            <option value="2.5" style="color:#0000FF">賺取2.5退水</option>
											<option value="100" style="color:#0000FF">賺取所有退水</option>
										</select>
                                    </td>
                                </tr>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center">
						<input type="submit" class="inputs" value="確 定" />&nbsp;&nbsp;
						<input type="button" class="inputs" onclick="closesPop()" value="取消" /></td>
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
 </form>
</body>
</html>
<script>

	$('#s_Name').focus(function(){
		if($(this).val()=='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}else if($(this).val()!='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}
	}).blur(function(){
		if($(this).val()!='') {
			$(this).css({'background':'#ffffff','border-color':'#dddddd','color':'#000'})
		}else if($(this).val()=='') {
			$(this).css({'background':'#ffffff','border-color':'#dddddd','color':'#000'})
		}
	});
		$('#s_F_Name').focus(function(){
		if($(this).val()=='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}else if($(this).val()!='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}
	}).blur(function(){
		if($(this).val()!='') {
			$(this).css({'background':'#ffffff','border-color':'#dddddd','color':'#000'})
		}else if($(this).val()=='') {
			$(this).css({'background':'#ffffff','border-color':'#dddddd','color':'#000'})
		}
	});
	
		$('#s_money').focus(function(){
		if($(this).val()=='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}else if($(this).val()!='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}
	}).blur(function(){
		if($(this).val()!='') {
			$(this).css({'background':'#ffffff','border-color':'#dddddd','color':'#000'})
		}else if($(this).val()=='') {
			$(this).css({'background':'#ffffff','border-color':'#dddddd','color':'#000'})
		}
	});
	
		$('#Size_KY').focus(function(){
		if($(this).val()=='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}else if($(this).val()!='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}
	}).blur(function(){
		if($(this).val()!='') {
			$(this).css({'background':'#ffffff','border-color':'#dddddd','color':'#000'})
		}else if($(this).val()=='') {
			$(this).css({'background':'#ffffff','border-color':'#dddddd','color':'#000'})
		}
	});
	
		$('#s_Pwd').focus(function(){
		if($(this).val()=='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}else if($(this).val()!='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}
	}).blur(function(){
		if($(this).val()!='') {
			$(this).css({'background':'#ffffff','border-color':'#dddddd','color':'#000'})
		}else if($(this).val()=='') {
			$(this).css({'background':'#ffffff','border-color':'#dddddd','color':'#000'})
		}
	});
			$('#s_money').focus(function(){
		if($(this).val()=='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}else if($(this).val()!='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}
	}).blur(function(){
		if($(this).val()!='') {
			$(this).css({'background':'#ffffff','border-color':'#dddddd','color':'#000'})
		}else if($(this).val()=='') {
			$(this).css({'background':'#ffffff','border-color':'#dddddd','color':'#000'})
		}
	});


function Arabia_to_Chinese(Num)
{

for(i=Num.length-1;i>=0;i--)
{
Num = Num.replace(",","")//替换tomoney()中的“,”
Num = Num.replace(" ","")//替换tomoney()中的空格
}
Num = Num.replace("￥","")//替换掉可能出现的￥字符
if(isNaN(Num)) 
{ //验证输入的字符是否为数字
alert("请检查小写金额是否正确");
return;
}
//---字符处理完毕，开始转换，转换采用前后两部分分别转换---//
part = String(Num).split(".");
newchar = ""; 
//小数点前进行转化
for(i=part[0].length-1;i>=0;i--)
{
if(part[0].length > 10)
{
   alert("位数过大，无法计算");
   return "";
}//若数量超过拾亿单位，提示
tmpnewchar = ""
perchar = part[0].charAt(i);
switch(perchar)
{
   case "0": tmpnewchar="" + tmpnewchar ;break;
   case "1": tmpnewchar="一" + tmpnewchar ;break;
   case "2": tmpnewchar="二" + tmpnewchar ;break;
   case "3": tmpnewchar="三" + tmpnewchar ;break;
   case "4": tmpnewchar="四" + tmpnewchar ;break;
   case "5": tmpnewchar="五" + tmpnewchar ;break;
   case "6": tmpnewchar="六" + tmpnewchar ;break;
   case "7": tmpnewchar="七" + tmpnewchar ;break;
   case "8": tmpnewchar="八" + tmpnewchar ;break;
   case "9": tmpnewchar="九" + tmpnewchar ;break;
}
switch(part[0].length-i-1)
{
   case 0: tmpnewchar = tmpnewchar +"" ;break;
   case 1: if(perchar!=0)tmpnewchar= tmpnewchar +"十" ;break;
   case 2: if(perchar!=0)tmpnewchar= tmpnewchar +"百" ;break;
   case 3: if(perchar!=0)tmpnewchar= tmpnewchar +"千" ;break;
   case 4: tmpnewchar= tmpnewchar +"万" ;break;
   case 5: if(perchar!=0)tmpnewchar= tmpnewchar +"十" ;break;
   case 6: if(perchar!=0)tmpnewchar= tmpnewchar +"百" ;break;
   case 7: if(perchar!=0)tmpnewchar= tmpnewchar +"千" ;break;
   case 8: tmpnewchar= tmpnewchar +"亿" ;break;
   case 9: tmpnewchar= tmpnewchar +"十" ;break;
}
newchar = tmpnewchar + newchar;
}//for
//小数点之后进行转化
if(Num.indexOf(".")!=-1)
{
if(part[1].length > 2) 
{
   alert("小数点之后只能保留两位,系统将自动截段");
   part[1] = part[1].substr(0,2)
}
for(i=0;i<part[1].length;i++)
{//for2
   tmpnewchar = ""
   perchar = part[1].charAt(i)
   switch(perchar)
   {
    case "0": tmpnewchar="零" + tmpnewchar ;break;
    case "1": tmpnewchar="壹" + tmpnewchar ;break;
    case "2": tmpnewchar="贰" + tmpnewchar ;break;
    case "3": tmpnewchar="叁" + tmpnewchar ;break;
    case "4": tmpnewchar="肆" + tmpnewchar ;break;
    case "5": tmpnewchar="伍" + tmpnewchar ;break;
    case "6": tmpnewchar="陆" + tmpnewchar ;break;
    case "7": tmpnewchar="柒" + tmpnewchar ;break;
    case "8": tmpnewchar="捌" + tmpnewchar ;break;
    case "9": tmpnewchar="玖" + tmpnewchar ;break;
   }
   if(i==0)tmpnewchar =tmpnewchar + "角";
   if(i==1)tmpnewchar = tmpnewchar + "分";
   newchar = newchar + tmpnewchar;
}//for2
}
//替换所有无用汉字
while(newchar.search("零零") != -1)
newchar = newchar.replace("零零", "零");
newchar = newchar.replace("亿零万", "亿");
newchar = newchar.replace("零亿", "亿");
newchar = newchar.replace("亿万", "亿");
newchar = newchar.replace("零万", "万");
newchar = newchar.replace("零元", "");
newchar = newchar.replace("零角", "");
newchar = newchar.replace("零分", "");

if (newchar.charAt(newchar.length-1) == "" || newchar.charAt(newchar.length-1) == "")
     newchar = newchar+""
return newchar;
}

//-->


</script>
