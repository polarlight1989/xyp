<?
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';?><!DOCTYPE html>  
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

        addEventAct('changeLotteryType');
        addEventAct('changePlayerType');
    });
</script>
	<div data-role="header" data-position="fixed">
		<a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext"></a>
		<h1><?=get_gameName($_SESSION['cpopen'])?></h1>
		<a href="Main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse"></a>
		<? include 'select.php';?>
		</div> 
	<div data-role="content" class="pm">		
		<div class="DDbox">
			<div class="box">
				<!--<div class="success">恭喜您！投注成功！</div>-->
				<div class="warning juzhong" style="margin:40% auto">對不起！未开盘！</div>
				<!--<div class="warning">對不起！你的投注的誤！</div>-->
			<div class="clear"></div>
			</div>			
		<div class="clear"></div>
		</div>		
	</div> 
<? include 'left.php';?>
</div> 
</body> 
</html> 