<?
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
include_once ROOT_PATH.'functioned/peizhi.php';
global $user;
markPos("前台-遊戲大廳");
?>
<!DOCTYPE html>  
<html>  
<head>  
<title>遊戲大廳</title>  
<link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.showLoading.min.js" type="text/javascript"></script>
<script src="js/jquery.mobile-1.4.3.js"></script>
<script src="js/mobi_common.js"></script>
<script src="js/Pwd_Safety.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>  
<body>  	
<div data-role="page" > 
<script type="text/javascript" language="javascript">
    function exitConfirm() {
        if (confirm("確定要退出嗎？")) {
            //是
            window.top.location="Quit.php";
            return true;
        }
        else {
            //否 
            return false;
        }
    }
</script>
	<div data-role="header" data-position="fixed">
		<a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext"></a>
		<h1>遊戲大廳</h1>
		<a href="#" onClick="javascript:exitConfirm();" data-role="botton" data-icon="delete" data-iconpos="notext"></a>
		</div> 
	<div data-role="content" class="pm">  
		<div class="mainBox">
			<ul>
			<?php  if($peizhigdklsf=="1"){
			echo "<li><span><a  href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='KL10_lm.php?lottery_type=0&player_type=lm'\" data-transition=\"slide\"><img src=\"images/icon1.png\"></a></span><span><a href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='KL10_lm.php?lottery_type=0&player_type=lm'\" data-transition=\"slide\">廣東快樂十分</a></span></li>";
			}
			if($peizhicqssc=="1"){
			echo "<li><span><a   href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='CQSC_lm.php?lottery_type=1&player_type=lm'\" data-transition=\"slide\"><img src=\"images/icon2.png\"></a></span><span><a  href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='CQSC_lm.php?lottery_type=1&player_type=lm'\" data-transition=\"slide\">重慶時時彩</a></span></li>";
			}
			if($peizhipk10=="1"){
			echo "<li><span><a   href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='PK10_lm.php?lottery_type=6&player_type=lm'\" data-transition=\"slide\"><img src=\"images/icon3.png\"></a></span><span><a   href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='PK10_lm.php?lottery_type=2&player_type=lm'\" data-transition=\"slide\">北京赛车PK10</a></span></li>";
			}
			if($peizhinc=="1"){
			echo "<li><span><a href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='XYNC_lm.php?lottery_type=3&player_type=lm'\" data-transition=\"slide\"><img src=\"images/icon4.png\"></a></span><span><a  href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='XYNC_lm.php?lottery_type=3&player_type=lm'\" data-transition=\"slide\">幸运农场</a></span></li>";
			}
			if($peizhixyft=="1"){
			echo "<li><span><a  href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='XYFT_lm.php?lottery_type=4&player_type='\" data-transition=\"slide\"><img src=\"images/icon7.png\"></a></span><span><a  href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='XYFT_lm.php?lottery_type=1&player_type='\" data-transition=\"slide\">极速赛车</a></span></li>";
			}
			if($peizhikl8=="1"){
			echo "<li><span><a  href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='KL8_zh.php?lottery_type=5&player_type=zh'\" data-transition=\"slide\"><img src=\"images/icon6.png\"></a></span><span><a  href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='KL8_zh.php?lottery_type=5&player_type=zh'\" data-transition=\"slide\">北京快樂8</a></span></li>";
			}
			if($peizhijxssc=="1"){
			echo "<li><span><a   href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='qtwfc_lm.php?lottery_type=1&player_type=lm'\" data-transition=\"slide\"><img src=\"images/icon2.png\"></a></span><span><a  href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='qtwfc_lm.php?lottery_type=1&player_type=lm'\" data-transition=\"slide\">极速时时彩</a></span></li>";
			}
			if($peizhitjssc=="1"){
			echo "<li><span><a   href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='tjssc_lm.php?lottery_type=1&player_type=lm'\" data-transition=\"slide\"><img src=\"images/icon2.png\"></a></span><span><a  href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='tjssc_lm.php?lottery_type=1&player_type=lm'\" data-transition=\"slide\">天津时时彩</a></span></li>";
			}
			if($peizhixjssc=="1"){
			echo "<li><span><a   href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='xjssc_lm.php?lottery_type=1&player_type=lm'\" data-transition=\"slide\"><img src=\"images/icon2.png\"></a></span><span><a  href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='xjssc_lm.php?lottery_type=1&player_type=lm'\" data-transition=\"slide\">新疆时时彩</a></span></li>";			
			}
			if($peizhijssz=="1"){
			echo "<li><span><a   href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='jsk3_lm.php?lottery_type=1&player_type=lm'\" data-transition=\"slide\"><img src=\"images/icon5.png\"></a></span><span><a  href=\"javascript:void(0)\" onClick=\"javascript:window.location.href='jsk3_lm.php?lottery_type=1&player_type=lm'\" data-transition=\"slide\">吉林快3</a></span></li>";			
			}
			?></ul>
		</div>
	</div> 
<? include 'footer.php';?>
<? include 'left.php';?>
</div>
</body> 
</html>  