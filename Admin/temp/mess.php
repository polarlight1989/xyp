<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
$u = $_REQUEST['uid'];
$d=date("Y-m-d H:i:s");
$db=new DB();
$total = $db->query("SELECT * FROM g_news", 3);
$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("SELECT * FROM g_news ORDER BY g_id DESC {$page->limit} ", 1);
markPos("后台-公告页");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<title></title>
<SCRIPT language="JavaScript">
<!--
 function checkreg()
  {
            if (document.form1.User.value=="")
   {
    alert("请输入信息!");
    form1.User.focus();
    return false;
   }
            if (document.form1.User.value.length<2 || document.form1.User.value.length>300)
   {
    alert("信息长度限制在2-300位!");
    form1.User.focus();
    return false;
   }
            if (document.form1.Pwd.value=="")
   {
    alert("请输入密码!");
    form1.Pwd.focus();
    return false;
   }
                        if (document.form1.Pwd.value.length<6 || document.form1.Pwd.value.length>15)
   {
    alert("密码长度限制在6-15位!");
    form1.Pwd.focus();
    return false;
   }
            if(document.form1.Pwd.value!=document.form1.Pwdagain.value)
   {
    alert("两次输入的密码不同!")
    form1.Pwd.focus();
    return false;
   }
                        if (document.form1.Qq.value=="")
   {
    alert("请输入您的QQ号码!");
    form1.Qq.focus();
    return false;
   }
   if (document.form1.Qq.value.length>10 || document.form1.Qq.value.length<4)
   {
    alert("QQ长度应该在4-10位之间!");
    form1.Qq.focus();
    return false;
   }
                        if (document.form1.Email.value=="")
   {
    alert("请输入您的Email地址!");
    form1.Email.focus();
    return false;
   }
      var myRegex = /@.*\.[a-z]{2,6}/;
      var email = form1.Email.value;
      email = email.replace(/^ | $/g,"");
      email = email.replace(/^\.*|\.*$/g,"");
      email = email.toLowerCase();
       
                        //验证电子邮件的有效性
                        if (email == "" || !myRegex.test(email))
      {
        alert ("请输入有效的E-MAIL!");
        form1.Email.focus();
        return false;
      }
                       return true;
  }
    function Isval(val,name)
    {
                     if (val.value!='' && (isNaN(val.value) || val.value==0))
     {
      alert(name+"应填数字！");
       val.value="";
       val.focus();
     }
     }
//-->
   </SCRIPT>
 <style type="text/css">
          <!--
.conter tr td {
	border:1px  solid;
	border-color:#b0c47a;
}
.style3 {font-size: 12px}
.style5 {font-size: 12px; color: #FFFFFF; }
.style6 {color: #FFFFFF}
            -->
 </style>
</head>
<body onselectstart="return false">
	   <form name="form1"  onsubmit="return checkreg()" method="post" action="save.php"  >
    <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#009A31" bgcolor="#009933" style="border-collapse: collapse; color: #225d9c;" >
  <tr>
     <td><span class="style5">消息类型：</span></td>
     <td align="left"><span class="style5">会员登录弹窗</span></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="center" height=35><span class="style3">消息内容：</span></td>
    <td  align="left"><span style="font-size: 12px">
      &nbsp;
      <input type="text" name="username" class="style3" id="User" style="width:900px;">
    </span></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="35" align="center"><span class="style3">会员名：</span></td>
    <td height="35" align="left">&nbsp;<?=$u?> 
	 <input type="hidden" name="u" class="style3" value="<?=$u?>" id="u">

	</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="12%" height="35" align="center"><span class="style3">发送时间：</span></td>
    <td width="88%" height="35" align="left">&nbsp;      <input name="t" type="text"  value="<?=$d?>" /></td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td height="35" align="center">&nbsp;</td>
    <td height="35" align="left"><span class="style3">
      &nbsp;
      <input name="submit" type="submit" value="发送"/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
  </tr>
</table> 
历史信息>> 
<table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#009A31" bgcolor="#009A31" style="border-collapse: collapse; color: #225d9c;" >
  <tr>
     <td width="12%"><span class="style5">会员名</span></td>
     <td width="44%" align="left"><span class="style5">会员信息弹窗</span></td>
  <td width="22%" align="left"><span class="style5">发送时间</span></td>
  <td width="22%" align="left" class="style3 style6">操作</td>
  </tr>
<?php
$dbhost                                = "localhost";                 
$dbuser                                = "root";                 
$dbpass                                = "Hjc19860104";                         
$dbname                                = "1188aa";                     
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
mysql_query("SET NAMES utf8"); 
mysql_query("SET CHARACTER_SET_CLIENT=utf8"); 
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

$sql = "select * from message where uid='$u' order by id desc";
$result = mysql_db_query($dbname, $sql);
$cou=mysql_num_rows($result);

while ($row=mysql_fetch_array($result))
{
$i=$row['id'];
$m=$row['msg'];
$t=$row['addtime'];
//$ccc=iconv('GBK','UTF-8',$d);
 ?>
 
  <tr bgcolor="#FFFFFF">
    <td align="center" height=21><span class="style3">&nbsp;<?=$u?></span></td>
    <td  align="left"><span style="font-size: 12px">&nbsp;<?=$m?>
            
    </span></td>
  <td  align="left"><span class="style3">&nbsp;<?=$t?></span></td>
  <td  align="left"><a href="del.php?id=<?=$i?>&uid=<?=$u?>"><u><font color=red>删除</font><u></a></td>
  </tr>
<?
}
?>
</table>  

    </form>
	
</body>
</html>