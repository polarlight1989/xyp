<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
include_once ROOT_PATH.'functioned/peizhi.php';

$ConfigModel = configModel("*");

$name = base64_decode($_COOKIE['g_user']);

if($ConfigModel['g_restore_money_lock']==1){
ResuserMoney($name);
}

$db=new DB();
$sql = "SELECT * FROM g_zhudan where g_nid='$name' ORDER BY g_id DESC LIMIT 10";
$result1 = $db->query($sql, 1);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/js/jquery.js"></script>
<SCRIPT type="text/javascript">
    if (top.location == self.location) top.location.href = "../"; 
</script>
    <link href="css/left.css" rel="stylesheet" type="text/css">
    <script src="js/Forbid.js" type="text/javascript"></script><meta http-equiv="Refresh" content="100"> 
</head>
<body oncopy="return false" oncut="return false" onselectstart="return false">

<table border='0' cellpadding='0' cellspacing='1' class='t_list' width='231'>
<tr><td class='t_td_caption_1' width='66'>會員帳戶</td><td class='t_td_text' width='165'><?php echo $user[0]['g_name']?></td></tr>


<tr>
  <td class='t_td_caption_1'>盤　　口</td>
  <td class='t_td_text'><?php echo strtoupper($user[0]['g_panlu'])?>盤</td>
</tr>
<tr><td class='t_td_caption_1'>信用額度</td><td class='t_td_text'><?php echo number_format(is_Number($user[0]['g_money']))?></td></tr>
<tr><td class='t_td_caption_1'>可用金額</td><td id="currentCredits" class='t_td_text'><?php echo number_format(is_Number($user[0]['g_money_yes']))?></td></tr>
<?php if($cz=="1"){
echo "
<tr>
	<td colspan=\"5\" class=\"t_td_text\" >
	<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">
                    <tr>
                        <td class=\"JZRCB\"><a href=\"chongzhi.php\" target=\"mainFrame\" style=\"color:#FFFFFF;\">在线充值</a></td>
                   
                        <td class=\"JZRCB\"><a href=\"qukuan.php\" target=\"mainFrame\"  style=\"color:#FFFFFF;\">在线取款</a></td>
                    </tr>
	</table>
	</td>
	</tr>";
	}?>
	
	
	<!--投註成功-->
<?php if($zclm=="1"){
 if($peizhigdklsf=="1"){
#echo "<tr><td class='t_list_caption' colspan='2'><a href='javascript:void(0);' onclick=\"window.open('http://www.1680268.com/html/klsf/klsf_index.html','廣東快樂十分','width=488,height=183,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no');\">“廣東快樂十分”開獎网</a>&nbsp;</td></tr>";
}
 if($peizhicqssc=="1"){
#echo "<tr><td class='t_list_caption' colspan='2'><a href='javascript:void(0);' onClick=\"window.open('http://www.1680268.com/html/shishicai_cq/ssc_index.html','重慶時時彩','width=488,height=183,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no,location=no');\"> “重慶時時彩”開獎网</a>&nbsp;&nbsp;</td></tr>";
}
 if($peizhijxssc=="1"){
#echo "<tr><td class='t_list_caption' colspan='2'><a href='javascript:void(0);' onClick=\"window.open('http://www.1680268.com/html/shishicai_jisu/ssc_index.html','极速时时彩','width=488,height=183,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no,location=no');\"> “极速时时彩”開獎网</a>&nbsp;&nbsp;</td></tr>";
}
 if($peizhipk10=="1"){
#echo "<tr><td class='t_list_caption' colspan='2'><a href='javascript:void(0);' onClick=\"window.open('http://www.1680268.com/html/PK10/pk10kai.html','北京賽車','width=687,height=464,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no,location=no');\"> “北京赛车”開獎网</a>&nbsp;&nbsp;</td></tr>";
}
 if($peizhijssz=="1"){
#echo "<tr><td class='t_list_caption' colspan='2'><a href='javascript:void(0);' onClick=\"window.open('http://www.1680268.com/html/kuai3_jiling/kuai3_index.html','吉林快3','width=687,height=464,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no,location=no');\"> “吉林快3”開獎网</a>&nbsp;&nbsp;</td></tr>";
}
 if($peizhikl8=="1"){
#echo "<tr><td class='t_list_caption' colspan='2'><a href='javascript:void(0);' onClick=\"window.open('http://www.1680268.com/html/beijinkl8/bjkl8_index.html','北京快樂8)','width=687,height=464,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no,location=no');\"> “北京快樂8”開獎网</a>&nbsp;&nbsp;</td></tr>";
 }
  if($peizhixyft=="1"){
#echo "<tr><td class='t_list_caption' colspan='2'><a href='javascript:void(0);' onClick=\"window.open('http://www.1680268.com/html/jisusaiche/pk10kai.html','极速赛车)','width=687,height=464,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no,location=no');\"> “极速赛车”開獎网</a>&nbsp;&nbsp;</td></tr>";
}
 if($peizhinc=="1"){
#echo "<tr><td class='t_list_caption' colspan='2'><a href='javascript:void(0);' onClick=\"window.open('http://www.1680268.com/html/cqnc/index.html','幸运农场)','width=687,height=464,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no,location=no');\"> “幸运农场”開獎网</a>&nbsp;&nbsp;</td></tr>";
}
if($peizhixjssc=="1"){
#echo "<tr><td class='t_list_caption' colspan='2'><a href='javascript:void(0);' onClick=\"window.open('http://www.1680268.com/html/shishicai_xj/ssc_index.html','新疆时时彩','width=488,height=183,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no,location=no');\"> “新疆时时彩”開獎网</a>&nbsp;&nbsp;</td></tr>";
}
if($peizhitjssc=="1"){
#echo "<tr><td class='t_list_caption' colspan='2'><a href='javascript:void(0);' onClick=\"window.open('http://www.1680268.com/html/shishicai_tj/ssc_index.html','天津时时彩','width=488,height=183,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no,location=no');\"> “天津时时彩”開獎网</a>&nbsp;&nbsp;</td></tr>"; 
}
}?>
	
</table>
<!--投註成功-->
		
                    

</body>

</html>
