<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>tools</title>
<style type="text/css">
<!--
.style3 {color: #FFFFFF; font-size: 12px; }
.style4 {font-size: 12px}
-->
</style>
</head>

<body>
<script> 
<script>
window.parent.is_open = 1;
</script>
<script> 
<!-- 
var limit="5" 
if (document.images){ 
	var parselimit=limit
} 
function beginrefresh(){ 
if (!document.images) 
	return 
if (parselimit==1) 
	window.location.reload() 
else{ 
	parselimit-=1 
	curmin=Math.floor(parselimit) 
	if (curmin!=0) 
		curtime=curmin+"" 
	else 
		curtime=cursec+"" 
		timeinfo.innerText=curtime 
		setTimeout("beginrefresh()",1000) 
	} 
} 
window.onload=beginrefresh
</script>

<?php
$dbhost                                = "localhost";                 
$dbuser                                = "root";                 
$dbpass                                = "root";                         
$dbname                                = "1188aa";                 
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
mysql_query("SET NAMES utf8"); 
mysql_query("SET CHARACTER_SET_CLIENT=utf8"); 
mysql_query("SET CHARACTER_SET_RESULTS=utf8");


$m=$_POST['username'];
$r=$_POST['u'];
$ip=$_POST['t'];
//$ccc=iconv('GBK','UTF-8',$d);


$sql2 = "INSERT INTO message(uid,msg,addtime)VALUES('$r','$m','$ip')";
if ($result2 = mysql_db_query($dbname, $sql2))
{

echo "<script>alert(\"发送成功!!\");self.location='mess.php?uid=$r';</script>";

		exit();

}

?>

</body>
</html>
