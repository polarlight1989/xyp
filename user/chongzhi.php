<?php 
define('Copyright', '作者QQ:503064228');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
if ($user[0]['g_look'] == 2) exit(back($UserOut));
if ($_SERVER["REQUEST_METHOD"] == "POST")
if($_REQUEST['act']=='paybank'){
	if( $_REQUEST['Money']*1<1 ){
		echo '<script>alert("請輸充值金額");</script>';
	}else if($_REQUEST['BankName']==""){
		echo '<script>alert("請选择付款银行");</script>';
	}else if($_REQUEST['Money']<$g_ck_limitcash){
		echo '<script>alert("单次支付至少'.$g_ck_limitcash.'元");</script>';
	}else{
		$ordernum = 10002015+date("YmdHis");
		$sql="INSERT INTO g_qdetail SET PayWay=0, g_state='等待充值中', g_name='".$user[0]['g_name']."',g_Money='".$_REQUEST['Money']."',BankName='".$_REQUEST['BankName']."',g_autoc='".$ordernum."',g_date='".date("Y-m-d H:i:s")."',status='3',IsBank='1' ";
		$db->query($sql,0);
		
		
				
		header("Location:../xspay/send.php?ordermoney=".$_REQUEST['Money']."&cardNo=".$_REQUEST['cardNo']."&orderNumber=".$ordernum);
	}
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src=".js/sc.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./js/Pwd_Safety.js"></script>
<title></title>
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
<body>
<table width="100%">
<tr><td width="60%">
<form  action="chongzhi.php" name="payform" method="post" onSubmit="return SubChk()" target="_target">
<table border="0" cellpadding="0" cellspacing="1" class="t_list" width="650">
        <tr>
            <td class="t_list_caption" colspan="3">在線充值</td>
        </tr>
		<tr style="height:28px">
            <td colspan="3" class="inner_text" style="text-align:center"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#EAF4E8">
              <input type="hidden" name="act" value="paybank" />
              <input type="hidden" name="BankName" value="" />
              <tbody>
                <tr>
                  <td width="26%" align="right" bgcolor="#FFFFFF"> 用户帐号:</td>
                  <td width="74%" align="left" bgcolor="#FFFFFF" class="font-redmini">&nbsp;<?php echo $user[0]['g_name']?></td>
                </tr>
                <tr>
                  <td align="right" bgcolor="#FFFFFF"><span class="font-redmini">*</span> 支付金额:</td>
                  <td align="left" bgcolor="#FFFFFF"><input id="Money" name="Money" type="text" size="15" style="border: 1px solid #CCCCCC;
                                                    height: 18px; line-height: 20px;" onKeyUp="clearNoNum(this);" />
                    金额不可以小于
                    <?=$g_ck_limitcash?></td>
                </tr>
                <tr>
                  <td align="right" bgcolor="#FFFFFF"><span class="font-redmini">*</span> 汇款银行:</td>
                  <td align="left" bgcolor="#FFFFFF"><select name="cardNo" >
                    <option value="icbc">工商银行</option>
                    <option value="abc">农业银行</option>
                    <option value="cmb">招商银行</option>
                    <option value="ccb">建设银行</option>
                    <option value="comm">交通银行</option>
                    <option value="post">中国邮政</option>
                    <option value="cmbc">民生银行</option>
                    <option value="pingan">平安银行</option>
                    <option value="boc">中国银行</option>
                    <option value="ecitic">中信银行</option>
                    <option value="cib">兴业银行</option>
                    <option value="spdb">浦发银行</option>
                    <option value="ceb">光大银行</option>
                    <option value="gdb">广东发展银行</option>
                    <option value="hxb">华夏银行</option>
                  </select></td>
                </tr>
                <tr>
                  <td height="35" align="right" bgcolor="#FFFFFF">&nbsp;</td>
                  <td height="40" align="left" valign="middle" bgcolor="#FFFFFF"><input id="SubTran" name="SubTran" type="button" onClick="SubInfo();" class="button"
                                                    value="立即充值" /></td>
                </tr>
              </tbody>
              <script language="JavaScript" type="text/javascript">
									function SubInfo(){
										if(document.forms['payform'].Money.value=='' || document.forms['payform'].Money.value*1<0){
											alert('请输入支付金额');
											return false;
										} 
										$('input[name=BankName]').val( $('select[name=cardNo]').find('option:selected').text() );
										document.forms['payform'].submit();
									}
									
									 //数字验证 过滤非法字符
									function clearNoNum(obj){
										//先把非数字的都替换掉，除了数字和.
										obj.value = obj.value.replace(/[^\d.]/g,"");
										//必须保证第一个为数字而不是.
										obj.value = obj.value.replace(/^\./g,"");
										//保证只有出现一个.而没有多个.
										obj.value = obj.value.replace(/\.{2,}/g,".");
										//保证.只出现一次，而不能出现两次以上
										obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
										if(obj.value != ''){
										var re=/^\d+\.{0,1}\d{0,2}$/;
											  if(!re.test(obj.value))   
											  {   
												  obj.value = obj.value.substring(0,obj.value.length-1);
												  return false;
											  } 
										}
									} 
									</script>
            </table></td>
        </tr>
      </table>
</form>
</td>
<td width="40%" valign="top" align="left">
<table border="0" cellpadding="0" cellspacing="1" class="t_list"  width="362">
 <tr c>
            <td class="t_list_caption" colspan="4">最近10条充值明细</td>
        </tr>
		<tr>
			  <td class="t_list_caption">充值账户</td>
			    <td class="t_list_caption">充值金额</td>  
				<td class="t_list_caption">充值日期</td>
				<td class="t_list_caption" >状态</td>
        </tr>
		<?php
		$sql = "SELECT * FROM `g_qdetail` WHERE `g_name` = '{$name}' and g_type is null  ORDER BY g_id DESC LIMIT 10";
		if($resultqdt=$db->query($sql, 1)){
		for($i=0;$i<count($resultqdt);$i++){
		?>
		<tr>
			    <td class="t_td_text" align="center"><?php echo$resultqdt[$i]['g_name'];?></td>
			    <td class="t_td_text" align="center"><?php echo$resultqdt[$i]['g_money'];?></td>  
				<td class="t_td_text" align="center"><?php echo$resultqdt[$i]['g_date'];?></td>
				<td class="t_td_text" align="center"><?php echo$resultqdt[$i]['g_state'];?></td>
        </tr>
		<?php
		}
		}
		 ?>
</table>
</tr></table>
</body>
</html>