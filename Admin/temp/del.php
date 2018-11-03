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
$dbpass                                = "Hjc19860104";                         
$dbname                                = "1188aa";                  
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
mysql_query("SET NAMES utf8"); 
mysql_query("SET CHARACTER_SET_CLIENT=utf8"); 
mysql_query("SET CHARACTER_SET_RESULTS=utf8");


$id=$_GET['id'];
$u=$_GET['uid'];



$sql2 = "delete from message where id='$id'";
if ($result2 = mysql_db_query($dbname, $sql2))
{

echo "<script>alert(\"删除成功!!!\");self.location='mess.php?uid=$u';</script>";
		exit();

}

?>

</body>
</html>
