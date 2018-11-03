<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
$news = null;
$db=new DB();
$text = $db->query("SELECT `g_text` FROM `g_news` WHERE `g_number_show` = 1 ORDER BY g_id DESC LIMIT 1 ", 0);
if ($text){
	$news = strip_tags($text[0][0]);
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<SCRIPT type="text/javascript">
    if (top.location == self.location) top.location.href = "../"; 
</script>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>会员</title>
<link href="css/_css.css" rel="stylesheet" type="text/css" />
<link href="css/_header.css" rel="stylesheet" type="text/css" /> 
<link href="css/m.old.css" rel="stylesheet" type="text/css" /> 

<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="js/jquery-ui.min.js" type="text/javascript"></script>

<script src="js/Forbid.js" type="text/javascript"></script>


<script type="text/javascript" src="../js/Topjavascript.js"></script>
<script type="text/javascript" src="js/TopMenu.js"></script>
<script language="javascript" src="js/m.old-header.js" type="text/javascript"></script>
</head>
<body>
<input type="hidden" id="FotteryFlag" name="FotteryFlag" />
<div class="topBox">
	<table class="gridtable">
	  <tr> 
		<td rowspan="2" width="231" height="59" background="images/logo.gif"><div class="logoBox"><?php echo $logo;?></div></td>
		<td><div class="Righttop"><marquee onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 2, 0);" direction="left" scrolldelay="4" scrollamount="2" behavior="scroll"><span id="Affiche"><?php echo trim($news); ?></span></marquee></div></td>
	  </tr>
	  <tr>
		<td>
		<div class="Rightbottom">
			<div class="left">
				<ul class="navOne-new">
					<li id="bankLi" name="bankLi" class="czBtn"><span id="currentType" onmouseover="onMenu();" onmouseout="onMenuOut()">重慶時時彩</span>
					</li>
				</ul>

<!--下拉菜单-->
<!--<div class="navOne-newDown" id="tMenu" style="position:absolute; z-index:100;">
  <div class="clearfix" id="bankLi-down" style="top:30px;;display:none;">
    <ul>
      <li><a id="a1" target="mainFrame" onclick="onCK(1)">广东快乐十分</a></li>
      <li><a id="a2" target="mainFrame" onclick="onCK(2)">重庆时时彩</a></li>
      <li><a id="a3" target="mainFrame" onclick="onCK(6)">北京赛车PK10</a></li>
      <li><a id="a4" target="mainFrame" onclick="onCK(7)">吉林鱼虾蟹</a></li>
      <li><a id="a5" target="mainFrame" onclick="onCK(8)">吉林快3（快3）</a></li>
      <li><a id="a6" target="mainFrame" onclick="onCK(72)">快乐8（双盘s）</a></li>
      
    </ul>
  </div>
</div>-->

<script type="text/javascript">


/*function onMenu(){
$("#bankLi-down").show();
};

function onMenuOut(){
//
};
*/


function SubonCK(v){


//$("#bankLi-down").hide();

SelectType(v);

if(v==1){
$("#bankLi").html("廣東快樂十分");
}else if(v==2){
$("#bankLi").html("重慶時時彩");
}else if(v==3){
$("#bankLi").html("北京赛车PK10");
}else if(v==4){
$("#bankLi").html("吉林鱼虾蟹");
}else if(v==5){
$("#bankLi").html("吉林快3");
}else if(v==6){
$("#bankLi").html("快樂8");
}else if(v==7){
$("#bankLi").html("极速时时彩");
}else if(v==11){
$("#bankLi").html("新疆时时彩");
}else if(v==12){
$("#bankLi").html("天津时时彩");
}else if(v==8){
$("#bankLi").html("极速赛车");
}else if(v==9){
$("#bankLi").html("广东十一选五");
}else if(v==10){
$("#bankLi").html("幸运农场");
};


return false;

};
$(function(){SubonCK(999);});

</script>
                
                
                
			<div class="clear"></div>
			</div>
			
			<div class="right">
				<ul id="navBtnMenu">

<li id="liBtn0" class="navBtn" onclick="topMenu()">信用資料</li>
<li id="liBtn1" class="navBtn" onclick="upPwd()">修改密碼</li>
<li id="liBtn2" class="navBtn" onclick="report()">未結明細</li> 
<li id="liBtn3" class="navBtn" onclick="resut()">今天已結</li> 
<!--<li id="liBtn4" class="navBtn" onclick="report()">下注明細</li>-->
<li id="liBtn5" class="navBtn" onclick="repore()">結算報表</li>
<li id="liBtn6" class="navBtn" onclick="result()">歷史開獎</li>
<li id="liBtn7" class="navBtn" onclick="rule()">玩法規則</li>
<li id="liBtn8" class="navBtn" onclick="quit()">安全退出</li>

				</ul>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>
		</td>
	  </tr>
	</table>
	<div style="width:1010px; float:left">
	<div class="userBox">請檢視您以下的賬戶信息</div>
    
    <!--这里插入连接-->
	<div class="navListBox" id="Type_List">

    
    </div>
	</div>
<div class="clear"></div>
</div>





</body>
</html>
