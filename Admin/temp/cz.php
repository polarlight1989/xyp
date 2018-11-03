<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/config.php';
global $ConfigModel,$Users;
$db=new DB();

 
if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_1'])){
	if ($Users[0]['g_lock_1_1'] !=1) 
		exit(back('您的權限不足！'));
}

if ($_SERVER["REQUEST_METHOD"] == "POST")

{	
//判断是会员还是代理冲值

if($_POST['id']==1)
{

if($_POST['g_b_limit']!="0"&&$_POST['g_a_limit']!="0")
{
$total1 = $db->query("SELECT g_money_yes FROM g_user where g_name='".$_POST['g_b_limit']."'", 1);
$jia=$total1[0]['g_money_yes']+$_POST['g_a_limit'];

$sql="update g_user Set g_money_yes='".$jia."' where g_name='".$_POST['g_b_limit']."' ";
$exe=mysql_query($sql) or  die("修改出错,或者用户名不正确！");
/*
$sql22="INSERT INTO g_payrecord SET PayWay=1,g_name='".$_POST['g_b_limit']."',Money='".$_POST['g_a_limit']."',BankName='管理员后台冲值',status=1,optdt='".date('Y-m-d H:i:s',time())."',ordernum='".date("YmdHis")."'	";
		$db->query($sql22,0);*/
echo "<script>alert('为用户:".$_POST['g_b_limit']."修改成功,原金额:".$total1[0]['g_money_yes']."修改后:".$jia."!');window.location.href='cz.php';</script>"; 
exit;
}else
{
echo "<script>alert('用户名或金额不能为空!');window.location.href='cz.php';</script>"; 
exit;
}
}else if($_POST['id']==2)
{

if($_POST['g_b_limit']!="0"&&$_POST['g_a_limit']!="0")
{
$total1 = $db->query("SELECT g_money FROM g_rank where g_name='".$_POST['g_b_limit']."'", 1);
$jia=$total1[0]['g_money']+$_POST['g_a_limit'];

$sql="update g_rank Set g_money='".$jia."' where g_name='".$_POST['g_b_limit']."' ";
$exe=mysql_query($sql) or  die("修改出错,或者用户名不正确！");
/*
$sql22="INSERT INTO g_payrecord SET PayWay=1,g_name='".$_POST['g_b_limit']."',Money='".$_POST['g_a_limit']."',BankName='管理员后台冲值',status=1,optdt='".date('Y-m-d H:i:s',time())."',ordernum='".date("YmdHis")."'	";
		$db->query($sql22,0);*/
echo "<script>alert('为代理:".$_POST['g_b_limit']."修改成功,原金额:".$total1[0]['g_money']."修改后:".$jia."!');window.location.href='cz.php';</script>"; 
exit;
}else
{
echo "<script>alert('用户名或金额不能为空!');window.location.href='cz.php';</script>"; 
exit;
}

}else
{
echo "<script>alert('错误提交!');window.location.href='cz.php';</script>"; 
exit;
}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<title></title>
<script type="text/javascript">
<!--
	function isForm(){
		if (confirm("確認更變嗎？"))
				return true;
		return false;
	}
-->
</script>

</head>
<body>


	<table width="100%" height="100%" border="0" cellspacing="0" class="a" >
    	<tr>
        	<td width="6" height="99%" bgcolor="#333333"></td>
            <td class="c">
			
            	<table border="0" cellspacing="0" class="main" >
             
              <tr>
                    	<td class="t"></td>
                        <td width="600" class="c">
                        <!-- strat -->
						<form action="" method="post" onsubmit="return isForm()">
                      <table border="0" cellspacing="0" class="conter" style="width: 468px;">
                            	 
                                <tr style="height:28px">
                                	<td colspan="3" class="bj"><div align="center"><span style="color:#F00000"><h2>会员余额冲值</h2></span></div></td>
                              </tr>
							  <center>
                                        <tr style="height:28px">
                                	 
                                  <td width="70" class="left_p61">增加金额</td>
                                  <td width="70" class="left_p61">用户名</td>
                                   
                        </tr>
                             
                                       <tr style="height:28px">
                                	 
                                  <td width="70" class="left_p61"><input name="g_a_limit" class="input1" id="g_a_limit" value='0' size="15" /></td>
								  <td width="70" class="left_p61"> 
								  
								  <select name="g_b_limit" id="g_a_limit">
                                    
								  <?php  
								  $user1 = $db->query("SELECT g_name FROM g_user", 1);
								  for ($i=0; $i<count($user1); $i++){
								
								 echo "<option value=\"".$user1[$i]['g_name']."\" >".$user1[$i]['g_name']."</option>";
								  
								  }
								  ?> </select>
                                 </td>
                                   </tr>
                            </center>
						<tr> <td></td> 
						<input type="hidden" name="id" value="1" />
						<td><input type="submit" class="inputs" value="確認更變" /></td></tr>
						
                          </table>
						  </form>
						  
						  <form action="" method="post" onsubmit="return isForm()">
                      <table border="0" cellspacing="0" class="conter" style="width: 468px;">
                            	 
                                <tr style="height:28px">
                                	<td colspan="3" class="bj"><div align="center"><span style="color:#F00000"><h2>股东代理信用额冲值</h2></span></div></td>
                              </tr>
							  <center>
                                        <tr style="height:28px">
                                	 
                                  <td width="70" class="left_p61">增加金额</td>
                                  <td width="70" class="left_p61">用户名</td>
                                   
                        </tr>
                             
                                       <tr style="height:28px">
                                	 
                                  <td width="70" class="left_p61"><input name="g_a_limit" class="input1" id="g_a_limit" value='0' size="15" /></td>
								  <td width="70" class="left_p61"> 
								  
								  <select name="g_b_limit" id="g_a_limit">
                                    
								  <?php  
								  $user1 = $db->query("SELECT g_name FROM g_rank", 1);
								  for ($i=0; $i<count($user1); $i++){
								
								 echo "<option value=\"".$user1[$i]['g_name']."\" >".$user1[$i]['g_name']."</option>";
								  
								  }
								  ?> </select>
                                 </td>
                                   </tr>
                            </center>
						<tr> <td></td> 
						<input type="hidden" name="id" value="2" />
						<td><input type="submit" class="inputs" value="確認更變" /></td></tr>
						
                          </table>
						  </form>
						  
                        <!-- end -->
                        </td>
                <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="32">&nbsp;</td>
                      <td class="f" align="center" ></td>
                        <td width="222">&nbsp;</td>
                  </tr>
				  
				  
				  <tr> <td></td> </tr>
                </table>
                
				
				
		
				
				
            </td>
            <td width="6" bgcolor="#333333"></td>
        </tr>
        <tr>
        	<td height="6" bgcolor="#333333"><img src="/Admin/images/main_59.gif" alt="" /></td>
            <td bgcolor="#333333"></td>
            <td height="6" bgcolor="#333333"><img src="/Admin/images/main_62.gif" alt="" /></td>
        </tr>
    </table>

</body>
</html>