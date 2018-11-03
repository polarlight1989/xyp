<?
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
$gameid=$_SESSION['cpopen'];
$game_name=get_gameName($gameid);
$game_type=get_gamesmName($gameid);
?>
<!DOCTYPE html>  
<html>  
<head>  
<title>遊戲大廳</title>  
<link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.mobile-1.4.3.js"></script>
<script src="js/mobi_common.js"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>  
<body>  	
<div data-role="page"  data-dom-cache="true"> 
<script type="text/javascript">
    //$(document).on("pageinit", "#pageone", function () {
    $(document).ready(function () {
        jQuery.mobile.ajaxEnabled = false;
        addEventAct('changeLotteryType');
        addEventAct('changePlayerType');
    });
    function wjsGo() {
        window.location = "Report_JeuWJS.php?r=07220913170021";
    }
</script>
	<div data-role="header" data-position="fixed">
		<a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext"></a>
		<h1><?=$game_name?></h1>
		<a href="Main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse"></a>
		<? include 'select.php';?>
		</div> 
	<div data-role="content" class="pm">		
		<div class="DDbox">
        <div class="DDtitle" style=" text-align:center;">
			系統提示!
			<?php
			if($_SESSION['lm']=="d1"||$_SESSION['lm']=="d2"||$_SESSION['lm']=="d3"||$_SESSION['lm']=="d4"||$_SESSION['lm']=="d5"||$_SESSION['lm']=="d6"||$_SESSION['lm']=="d7"||$_SESSION['lm']=="d8")
			{
			$game_type2=$_SESSION['lm'];
			$SESSIONlm="d1";
		   
			}else
			{
			$SESSIONlm=$_SESSION['lm'];
			$game_type2=$game_type;
			}
			
			if($game_type=="JSK3")
			{
			$game_type2=$game_type;
			$SESSIONlm="lm";
			
			}
			?>
			 <a href="<?=$game_type?>_<?=$SESSIONlm?>.php?lottery_type=<?=$gameid?>&player_type=<?=$game_type2?>" data-transition="slide" data-direction="reverse"><div class="QDbtn">返回</div></a>
			</div>
			<div class="box">
				<div class="success juzhong">恭喜您！投注成功！</div>	
				<a href="javascript:void(0);" onClick="javascript:wjsGo();"  style="float:right;" class="chakanxiazhumingxi">查看下注明細</a>
			<div class="clear"></div>
			</div>			
		<div class="clear"></div>
		</div>		
	</div> 
<? include 'left.php';?>
<?php 
$db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$user[0]['g_name']}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</div> 
</body> 
</html> 