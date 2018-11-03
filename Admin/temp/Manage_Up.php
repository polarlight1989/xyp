<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $Users, $LoginId;
if ($Users[0]['g_login_id'] != 89) if ($Users[0]['g_lock'] == 2)
exit(back($UserOut)); //帳號已被凍結

//子帳號
if (isset($Users[0]['g_lock_2'])){
	if ( $Users[0]['g_s_lock'] == 2 || $Users[0]['g_lock_2'] != 1)
		exit(back($UserOut)); //帳號已被凍結
}
markPos("后台-会员修改");
$userModel = new UserModel();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['cid']))
{
	$cid = $_GET['cid'];
	$name = $_POST['name'];
	$s_F_Name = $_POST['s_F_Name'];
	$s_Pwd = $_POST['s_Pwd'];
	$s_money = $_POST['s_money'];
	$money_dx = $_POST['money_dx'];
	$Size_ky = isset($_POST['Size_KY']) ? $_POST['Size_KY'] : null;
	$user_lock = $_POST['user_lock'];
	$lock = $_POST['lock'];
	$s_pan = isset($_POST['s_pan']) ? $_POST['s_pan'] : null;
	
	
	//为会员分配盘口
	for($i=0;$i<count($s_pan);$i++){
	$s_panlus=$s_panlus.strtoupper($s_pan[$i]).',';
	}
	$s_panl=strtoupper($s_pan[0]);



	if (!Matchs::isString($name, 3, 10)) exit(back('帳號錯誤！'));
	$memberModel = $userModel->GetMemberModel($name);
	//查詢當前會員注單。如果有則關閉盤口更變
	$detModel = new Detailed();
	$detList = $detModel->GetDetailedsAll($memberModel[0]['g_name']);
	if ($memberModel)
	{
		//if (!Matchs::isStringChi($s_F_Name, 2, 8)) exit(back('名稱輸入錯誤！'));
		if ($s_Pwd != null){
			if (!Matchs::isString($s_Pwd, 8, 20)) exit(back('密碼輸入錯誤！'));
			$s_Pwd = sha1($s_Pwd);
			$g_pwd=' ,g_pwd=1 ';
		}else {
			$s_Pwd = $memberModel[0]['g_password'];
			$g_pwd=' ,g_pwd=g_pwd ';
		}
		if (!Matchs::isNumber($s_money)) exit(back('信用額輸入錯誤！'));
		if ($Size_ky != null)
			if (!Matchs::isNumber($Size_ky)) exit(back('占成輸入錯誤！'));
	//	if (!Matchs::isNumber($user_lock)) exit(back('帳號限額輸入錯誤！'));
		
		//信用額計算
		$_s_money = $memberModel[0]['g_money'];
		$g_money_yes = $memberModel[0]['g_money_yes'];
		if ($memberModel[0]['g_mumber_type'] == 2){
			$nid = mb_substr($memberModel[0]['g_nid'], 0, mb_strlen($memberModel[0]['g_nid'])-32);
		}else {
			$nid = $memberModel[0]['g_nid'];
		}
		$Luser = $userModel->GetUserName_Like($nid);
		$Lnid = $userModel->GetLoginIdByString($Luser[0]['g_login_id']);
		if ($s_money != $_s_money){
			if ($s_money > $_s_money){
				//輸入的金額大於原來的、應當判斷上級的可用額是否充足、
				if ($Luser[0]['g_login_id']==48){
					$validMoney = validMoney ($userModel, $Luser[0]['g_money'], $Luser[0]['g_nid'], true);
				} else {
					$validMoney = validMoney ($userModel, $Luser[0]['g_money'], $Luser[0]['g_nid'].UserModel::Like(), false);
				}
				//判斷
				$n = $s_money - $_s_money;
				if ($n > $validMoney){
					exit(back($Lnid[0].' 剩餘可用餘額：'.$validMoney));
				} else {
					$g_money_yes += $n;
				}
			} else {
				$homey = $_s_money - $s_money;
					if ($homey > $g_money_yes){
				exit(back(' 不可大于剩餘可回收餘額：'.$g_money_yes));
				}
				$g_money_yes = $g_money_yes-$homey;
			}
		}
				//非空，上級占成計算
		if ($Size_ky == null){
			$Size_ky = $memberModel[0]['g_distribution'];
		} else {
			if ($Size_ky != $memberModel[0]['g_distribution']){
				if ($Size_ky > $Luser[0]['g_distribution']){
					exit(back($Lnid[0].' 最高占成：'.$Luser[0]['g_distribution'].'%'));
				}
			}
		}
		if (!$s_pan){
			$s_pan = strtoupper($memberModel[0]['g_panlu']);
		}
		if ($Luser[0]['g_lock'] != 1) {
				exit(back('更變權限不足！'));
		}
		$db =new DB();
		$sql = "UPDATE `g_user` SET 
		`g_f_name`='{$s_F_Name}',
		`g_password`='{$s_Pwd}',
		`g_money`='{$s_money}',
		`money_dx`='{$money_dx}',
		`g_money_yes`='{$g_money_yes}',
		`g_distribution`='{$Size_ky}',
		`g_panlus`='{$s_panlus}',
		`g_panlu`='{$s_panl}',
		`g_look`='{$lock}' ".$g_pwd." 
		WHERE g_name = '{$name}' LIMIT 1";
		$db->query($sql, 2);
		
		/*if ($memberModel[0]['g_xianer'] != $user_lock){
			$valueList = array();
			$valueList['g_name'] = $memberModel[0]['g_name'];
			$valueList['g_f_name'] = $_SESSION['sName'];
			$valueList['g_initial_value'] = $memberModel[0]['g_xianer'];
			$valueList['g_up_value'] = $user_lock;
			$valueList['g_up_type'] = '帳號限額';
			$valueList['g_s_id'] = 1;
			insertLogValue($valueList);
		}*/
		
		if ($memberModel[0]['g_panlus'] != $s_panlus){
			$valueList = array();
			//$a = strtolower($s_panl);	
			$sql = "SELECT `g_type`";
			$P=$s_panlus;
			if(strstr($P,'A')!=''){$sql.=',g_a_limit ';}
			if(strstr($P,'B')!=''){$sql.=',g_b_limit ';}
			if(strstr($P,'C')!=''){$sql.=',g_c_limit ';}
			//$p = "g_{$a}_limit";
			$sql.=", `g_game_id` FROM g_send_back WHERE g_name = '{$Luser[0]['g_name']}' ";

			$sresult = $db->query($sql, 1);
			for ($i=0; $i<count($sresult); $i++){
			$sql = "UPDATE `g_panbiao` SET g_id=g_id ";
			if(strstr($P,'A')!=''){$sql.=",g_panlu_a='{$sresult[$i]['g_a_limit']}' ";}
			if(strstr($P,'B')!=''){$sql.=",g_panlu_b='{$sresult[$i]['g_b_limit']}' ";}
			if(strstr($P,'C')!=''){$sql.=",g_panlu_c='{$sresult[$i]['g_c_limit']}' ";}
				$sql.= " WHERE g_nid = '{$memberModel[0]['g_name']}' 
				AND g_type = '{$sresult[$i]['g_type']}' AND g_game_id = '{$sresult[$i]['g_game_id']}'";
				$db->query($sql, 2);
			}
			$valueList['g_name'] = $memberModel[0]['g_name'];
			$valueList['g_f_name'] = $_SESSION['sName'];
			$valueList['g_initial_value'] = $memberModel[0]['g_panlu'].'盤';
			$valueList['g_up_value'] = $s_pan.'盤';
			$valueList['g_up_type'] = '開放盤口';
			$valueList['g_s_id'] = 1;
			insertLogValue($valueList);
		}
		
		if ($memberModel[0]['g_f_name'] != $s_F_Name){
			$valueList = array();
			$valueList['g_name'] = $memberModel[0]['g_name'];
			$valueList['g_f_name'] = $_SESSION['sName'];
			$valueList['g_initial_value'] = $memberModel[0]['g_f_name'];
			$valueList['g_up_value'] = $s_F_Name;
			$valueList['g_up_type'] = '名稱';
			$valueList['g_s_id'] = 1;
			insertLogValue($valueList);
		}
		
		if ($s_money != $memberModel[0]['g_money']){
			$valueList = array();
			$valueList['g_name'] = $memberModel[0]['g_name'];
			$valueList['g_f_name'] = $_SESSION['sName'];
			$valueList['g_initial_value'] = $memberModel[0]['g_money'];
			$valueList['g_up_value'] = $s_money;
			$valueList['g_up_type'] = '信用額';
			$valueList['g_s_id'] = 1;
			insertLogValue($valueList);
		}
		
		if ($Size_ky != $memberModel[0]['g_distribution']){
			$valueList = array();
			$valueList['g_name'] = $memberModel[0]['g_name'];
			$valueList['g_f_name'] = $_SESSION['sName'];
			$valueList['g_initial_value'] = $memberModel[0]['g_distribution'].'%';
			$valueList['g_up_value'] = $Size_ky.'%';
			$valueList['g_up_type'] = '上級占成';
			$valueList['g_s_id'] = 1;
			insertLogValue($valueList);
		}
		
		
		exit(alert_href('更改成功', 'Actfor.php?cid='.$cid));
	}
	exit;
}
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cid']) && isset($_GET['uid']))
{
	$uid = $_GET['uid'];
	$cid = $_GET['cid'];
	$memberModel = $userModel->GetMemberModel($uid);
	//查詢當前會員注單。如果有則關閉盤口更變
	$detModel = new Detailed();
	$detList = $detModel->GetDetailedsAll($memberModel[0]['g_name']);

	//查詢當前會員上級
	if ($memberModel[0]['g_mumber_type'] == 2){
		$nid = mb_substr($memberModel[0]['g_nid'], 0, mb_strlen($memberModel[0]['g_nid'])-32);
	}else {
		$nid = $memberModel[0]['g_nid'];
	}
	$Luser = $userModel->GetUserName_Like($nid);
	$Lnid = $userModel->GetLoginIdByString($Luser[0]['g_login_id']);
	
	//當可用額大於信用額時，顯示信用額。
	//小於信用額時，顯示可用額
	$validMoneys = $memberModel[0]['g_money_yes'];
	//計算上級代理可用金額
	if ($Luser[0]['g_login_id']==48){
		$validMoney = validMoney ($userModel, $Luser[0]['g_money'], $Luser[0]['g_nid'], true);
	} else {
		$validMoney = validMoney ($userModel, $Luser[0]['g_money'], $Luser[0]['g_nid'].UserModel::Like(), false);
	}
}
function validMoney ($userModel, $countMoney, $nid, $param) {
	$validMoney = $countMoney - $userModel->SumMoney($nid,$param);
	return $validMoney;
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
<script>
function DX(n) {  //金额大写转换函数
 if (!/^(0|[1-9]\d*)(\.\d+)?$/.test(n))
 document.getElementById("rmb").innerHTML ="数据非法";
 var unit = "千百拾亿千百拾万千百拾元角分", str = "";
 n += "00";
 var p = n.indexOf('.');
 if (p >= 0)
  n = n.substring(0, p) + n.substr(p+1, 2);
 unit = unit.substr(unit.length - n.length);
 for (var i=0; i < n.length; i++)
  str += '零壹贰叁肆伍陆柒捌玖'.charAt(n.charAt(i)) + unit.charAt(i);
  document.getElementById("rmb").innerHTML =str.replace(/零(千|百|拾|角)/g, "零").replace(/(零)+/g, "零").replace(/零(万|亿|元)/g, "$1").replace(/(亿)万|壹(拾)/g, "$1$2").replace(/^元零?|零分/g, "").replace(/元$/g, "元整");
   document.all.money_dx.value=str.replace(/零(千|百|拾|角)/g, "零").replace(/(零)+/g, "零").replace(/零(万|亿|元)/g, "$1").replace(/(亿)万|壹(拾)/g, "$1$2").replace(/^元零?|零分/g, "").replace(/元$/g, "元整");
}
</script>
<title></title>
</head>
<body onselectstart="return false">
<form method="post" action="?cid=<?php echo $cid?>" onsubmit="return isPostcid()" >
  <input type="hidden" name="name" value="<?php echo $memberModel[0]['g_name']?>" />
  <table width="99%" height="100%" border="0" cellspacing="0" class="a">
    <tr>
      <td width="6" height="99%" bgcolor="#4F4F4F"></td>
      <td class="c"><table border="0" cellspacing="0" class="main">
          <tr>
            <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
            <td background="/Admin/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                  <td width="99%">&nbsp;更改會員</td>
                </tr>
              </table></td>
            <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
          </tr>
          <tr>
            <td class="t"></td>
            <td class="c"><!-- strat -->
              <table border="0" cellspacing="0" class="conter">
                <tr class="tr_top">
                  <th colspan="2">會員信息</th>
                </tr>
                <tr style="height:28px">
                  <td class="bj">上級<?php echo $Lnid[0]?></td>
                  <td class="left_p5"><?php echo $Luser[0]['g_name']?><font color="#0033FF">&nbsp;&nbsp;&nbsp;上級餘額&nbsp;<?php echo $validMoney?></font></td>
                </tr>
                <tr>
                  <td class="bj">會員帳號</td>
                  <td class="left_p5"><?php echo $memberModel[0]['g_name']?> 【
                    <input name="lock" type="radio" value="1" <?php if($memberModel[0]['g_look']==1){echo 'checked="checked"';}?> />
                    啟用&nbsp;
                    <input name="lock" type="radio" value="2" <?php if($memberModel[0]['g_look']==2){echo 'checked="checked"';}?> />
                    凍結&nbsp;
                    <input name="lock" type="radio" value="3" <?php if($memberModel[0]['g_look']==3){echo 'checked="checked"';}?> />
                    停用&nbsp;】 </td>
                </tr>
                <tr style="height:28px">
                  <td class="bj">登陸密碼</td>
                  <td class="left_p5"><input style="width:139px;" class='inp1MM' name="s_Pwd" id="s_Pwd"  maxlength="20" /></td>
                </tr>
                <tr>
                  <td class="bj">會員名稱</td>
                  <td class="left_p5"><input style="width:139px;" class='inp1MM' id="s_F_Name" name="s_F_Name" value="<?php echo $memberModel[0]['g_f_name']?>"  maxlength="20" /></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj">信用額度</td>
                  <td nowrap="nowrap" class="left_p5" ><input style="width:85px;" class='inp1MM' name="s_money" id="s_money"  onkeyup="DX(this.value);"  value="<?php echo $memberModel[0]['g_money']?>"  />
                  &nbsp;
                                  
  <span class="red" style="font-weight:bold" name="rmb" id="rmb"><?php echo $memberModel[0]['money_dx']?></span><font color="344b50"> 『&nbsp;可‘回收’餘額&nbsp;<span id='money_ky' ><?php echo $validMoneys?></span>&nbsp;』</font></td><input  type="hidden"  id='money_dx' name='money_dx' value="" />
                </tr>
                <tr style="height:28px">
                  <td class="bj"><?php echo $Lnid[0]?>占成</td>
                  <td class="left_p5"><?php if (!$detList){?>
                    <input style="width:35px;" class='inp1MM' name="Size_KY"  maxlength="3" value="<?php echo $memberModel[0]['g_distribution']?>" />
                    %
                    <?php }else {?>
                    <span><?php echo $memberModel[0]['g_distribution']?> %</span>
                    <?php }?>  最高可設占成 &nbsp;<?php echo $Luser[0]['g_distribution']?>%                </td>
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
                  <td class="left_p5"><?php if (!$detList){?>
                    <?php $P = $memberModel[0]['g_panlus'];?>
                    <input type="radio" value="a" name="s_pan[]"  <?php if(strstr($P,'A')!=''){echo 'checked="checked"';}?> onclick="check(this)" />
                    A盤&nbsp;
                    <input type="radio" value="b" name="s_pan[]" <?php if(strstr($P,'B')!=''){echo 'checked="checked"';}?> onclick="check(this)" />
                    B盤&nbsp;
                    <input type="radio" value="c" name="s_pan[]" <?php if(strstr($P,'C')!=''){echo 'checked="checked"';}?> onclick="check(this)" />
                    C盤&nbsp;
                    <?php }else {?>
                    <?php $P = $memberModel[0]['g_panlus'];?>
                    <?php if(strstr($P,'A')!=''){echo '<input type="hidden" value="a" name="s_pan[]" checked="checked"  />A盤&nbsp;';}?>
                    <?php if(strstr($P,'B')!=''){echo '<input type="hidden" value="b" name="s_pan[]" checked="checked"  />B盤&nbsp;';}?>
                    <?php if(strstr($P,'C')!=''){echo '<input type="hidden" value="c" name="s_pan[]" checked="checked" />C盤&nbsp;';}?>
                    <?php }?>                  </td>
                </tr>
              </table>
              <!-- end -->
            </td>
            <td class="r"></td>
          </tr>
          <tr>
            <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
            <td class="f" align="center"><input type="submit" class="inputs" value="確定更變" /></td>
            <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
          </tr>
        </table></td>
      <td width="3"></td>
    </tr>
    <tr>
      <td height="6" bgcolor="#4F4F4F"><img src="/Admin/images/main_59.gif" alt="" /></td>
      <td bgcolor="#4F4F4F"></td>
      <td height="6" bgcolor="#4F4F4F"><img src="/Admin/images/main_62.gif" alt="" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<script>
	$('#s_F_Name').focus(function(){
		if($(this).val()=='<?php echo $memberModel[0]['g_f_name']?>') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}else if($(this).val()!='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}
	}).blur(function(){
		if($(this).val()!='') {
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
		if($(this).val()=='<?php echo $memberModel[0]['g_money']?>') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}else if($(this).val()!='') {
			$(this).css({'background':'#fcfdcf','border-color':'#ff8800','color':'#000'})
		}
	}).blur(function(){
		if($(this).val()!='') {
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
