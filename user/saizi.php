<?php
header("content-type:text/html;charset=utf-8");
if(!defined("ROOT_PATH"))
	define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');

include_once ROOT_PATH.'user/offGamesz.php';
include_once ROOT_PATH.'functioned/cheCookie.php';
if ($user[0]['g_look'] == 2) exit(href('repore.php'));
$ConfigModel = configModel("`g_sz_game_lock`, `g_mix_money`");
if ($ConfigModel['g_sz_game_lock'] !=1)exit(href('right.php'));

$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$db=new DB();
$sql="select * from g_history7 order by g_qishu desc limit 19";
$jqhj=$db->query($sql,1);


//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	//echo $sql;
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 
 //echo $result[0]['g_panlus'] ;
$_SESSION['gx'] = false;
$_SESSION['pk'] = false;
$_SESSION['gd'] = false;
$_SESSION['cq'] = false;
$_SESSION['xj'] = false;
$_SESSION['jx'] = false;
$_SESSION['tj'] = false;
$_SESSION['sz'] = true;
$_SESSION['kl8'] = false;

$g = $_GET['g'];
$abc = $_GET['abc'];
//echo $abc;
//$abc = 'C';
if($abc==null) {$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}

markPos("前台-吉林快3(PK10)");
?>
<HTML>
<HEAD>
<SCRIPT type=text/javascript>
//if (top.location == self.location) top.location.href = "../"; 
//var s = window.parent.frames.leftFrame.location.href.split('/');
////s = s[s.length-1];
////if (s !== "left.php")
//	window.parent.frames.leftFrame.location.href = "/user/left.php";
</SCRIPT>

<link href="css/sGame.css" rel="stylesheet" type="text/css"/>
<LINK rel=stylesheet type=text/css href="css/main_n1.css">
<LINK rel=stylesheet type=text/css href="css/ball_4.css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<SCRIPT type=text/javascript src="js/Forbid.js"></SCRIPT>
<script type="text/javascript" src="./js/odds_sm_sz.js"></script>
<script type="text/javascript" src="./js/plxz.js"></script>
<script type="text/javascript">
var s = window.parent.frames.leftFrame.location.href.split('/');
		s = s[s.length-1];
		if (s !== "left.php")
			window.parent.frames.leftFrame.location.href = "/user/left.php";
			
				function soundset(sod){
if(sod.value=="on"){
sod.src="images/soundoff.png";
sod.value="off";
}
else{
sod.src="images/soundon.png";
sod.value="on";
}
SetCookie("soundbut",sod.value);
}
</script>
</HEAD>
<BODY style="margin-left: 15px;" onselectstart="return false">
<TABLE border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
			<TD class=F_bold height=24 width="20%">吉林快3　　　</TD>
			<TD colspan="2" class="bolds" style="color:red">
			<SPAN style="position: relative;  FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">今天輸贏：</SPAN>
				<SPAN id="UserResult" class="shuyingjieguo2">0.0</SPAN></td>
			<TD width="50%" align=right>
			<TABLE border=0 cellSpacing=0 cellPadding=0>
				<TBODY>
					<TR>
						<TD height=27 width=140><span id="o" style=" color:#000000; font-weight:bold; font-size:12px;position:relative; top:0px">20</span><B id=UP_LID class=Font_Y>-</B><B>期开奖</B></TD>
						<TD id=BaLL_No1 class=No_2 width=27>&nbsp;</TD>
						<TD id=BaLL_No2 class=No_2 width=27>&nbsp;</TD>
						<TD id=BaLL_No3 class=No_4 width=27>&nbsp;</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
		</TR>
	</TBODY>
</TABLE>
<TABLE border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
			<TD height=24 width="28%"><span id="o" style=" color:#009900; font-weight:bold; font-size:12px;position:relative; top:0px"></span><B id=t_LID class=Font_G></B>期&nbsp;&nbsp;&nbsp;<B
				class=font_b style="font-size:12px;">大小骰寶</B></TD>
			<TD width="25%" align=right>距離封盤：<SPAN id=hClockTime_C>加载中...</SPAN></TD>
			<TD width="25%" align=right>距離開獎：<SPAN id=hClockTime_O class=Font_R>加载中...</SPAN></TD>
			<TD width="23%" align=right><SPAN id=Update_Time>66</SPAN>&nbsp;秒</TD>
		</TR>
	</TBODY>
</TABLE>
<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
			<TD class="td_caption_1 F_bold">三军【賠率說明：一同骰＝(賠率-1)×1、二同骰＝(賠率-1)×2、三同骰＝(賠率-1)×3】、大小</TD>
		</TR>
	</TBODY>
</TABLE>
<TABLE border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
			<TD>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=175>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD class=No_1 width=29></TD>
						<TD id=jeu_p_59_391 width=87 jName="三軍(1)"><SPAN
							class=multiple_Red id="ah1">-</SPAN></TD>
						<TD id=jeu_m_59_391 width=62 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD class=No_4></TD>
						<TD id=jeu_p_59_394 jName="三軍(4)"><SPAN class=multiple_Red id="ah4">-</SPAN></TD>
						<TD id=jeu_m_59_394 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
			<TD>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=175>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD class=No_2 width=29></TD>
						<TD id=jeu_p_59_392 width=87 jName="三軍(2)"><SPAN
							class=multiple_Red id="ah2">-</SPAN></TD>
						<TD id=jeu_m_59_392 width=62 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD class=No_5></TD>
						<TD id=jeu_p_59_395 jName="三軍(5)"><SPAN class=multiple_Red id="ah5">-</SPAN></TD>
						<TD id=jeu_m_59_395 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
			<TD>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=175>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD class=No_3 width=29></TD>
						<TD id=jeu_p_59_393 width=87 jName="三軍(3)"><SPAN
							class=multiple_Red id="ah3">-</SPAN></TD>
						<TD id=jeu_m_59_393 width=62 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD class=No_6></TD>
						<TD id=jeu_p_59_396 jName="三軍(6)"><SPAN class=multiple_Red id="ah6">-</SPAN></TD>
						<TD id=jeu_m_59_396 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
			<TD vAlign=top>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=175>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_58_389 class=Jut_caption_1 width=54>大</TD>
						<TD id=jeu_p_58_389 width=59><SPAN class=multiple_Red id="bh1">-</SPAN></TD>
						<TD id=jeu_m_58_389 width=62 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_58_390 class=Jut_caption_1>小</TD>
						<TD id=jeu_p_58_390><SPAN class=multiple_Red id="bh2">-</SPAN></TD>
						<TD id=jeu_m_58_390 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
		</TR>
	</TBODY>
</TABLE>
<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
			<TD class="td_caption_1 F_bold">圍骰、全骰</TD>
		</TR>
	</TBODY>
</TABLE>
<TABLE border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
			<TD>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=233>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD width=83><IMG src="images/4_1.gif" width=27><IMG
							src="images/4_1.gif" width=27><IMG
							src="images/4_1.gif" width=27></TD>
						<TD id=jeu_p_60_397 width=87 jName="圍骰(111)"><SPAN
							class=multiple_Red id="ch1">-</SPAN></TD>
						<TD id=jeu_m_60_397 width=63 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_4.gif" width=27><IMG
							src="images/4_4.gif" width=27><IMG
							src="images/4_4.gif" width=27></TD>
						<TD id=jeu_p_60_400 jName="圍骰(444)"><SPAN class=multiple_Red id="ch4">-</SPAN></TD>
						<TD id=jeu_m_60_400 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_61_403>全骰</TD>
						<TD id=jeu_p_61_403><SPAN class=multiple_Red id="ch7">-</SPAN></TD>
						<TD id=jeu_m_61_403 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
			<TD vAlign=top>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=233>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD width=83><IMG src="images/4_2.gif" width=27><IMG
							src="images/4_2.gif" width=27><IMG
							src="images/4_2.gif" width=27></TD>
						<TD id=jeu_p_60_398 width=87 jName="圍骰(222)"><SPAN
							class=multiple_Red id="ch2">-</SPAN></TD>
						<TD id=jeu_m_60_398 width=63 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_5.gif" width=27><IMG
							src="images/4_5.gif" width=27><IMG
							src="images/4_5.gif" width=27></TD>
						<TD id=jeu_p_60_401 jName="圍骰(555)"><SPAN class=multiple_Red id="ch5">-</SPAN></TD>
						<TD id=jeu_m_60_401 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
			<TD vAlign=top>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=234>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD width=83><IMG src="images/4_3.gif" width=27><IMG
							src="images/4_3.gif" width=27><IMG
							src="images/4_3.gif" width=27></TD>
						<TD id=jeu_p_60_399 width=88 jName="圍骰(333)"><SPAN
							class=multiple_Red id="ch3">-</SPAN></TD>
						<TD id=jeu_m_60_399 width=63 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_6.gif" width=27><IMG
							src="images/4_6.gif" width=27><IMG
							src="images/4_6.gif" width=27></TD>
						<TD id=jeu_p_60_402 jName="圍骰(666)"><SPAN class=multiple_Red id="ch6">-</SPAN></TD>
						<TD id=jeu_m_60_402 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
		</TR>
	</TBODY>
</TABLE>
<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
			<TD class="td_caption_1 F_bold">點數</TD>
		</TR>
	</TBODY>
</TABLE>
<TABLE border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
			<TD>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=175>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_404 class=Jut_caption_1 width=54>4點</TD>
						<TD id=jeu_p_62_404 width=59><SPAN class=multiple_Red  id="dh1">-</SPAN></TD>
						<TD id=jeu_m_62_404 width=62 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_408 class=Jut_caption_1>8點</TD>
						<TD id=jeu_p_62_408><SPAN class=multiple_Red id="dh5">-</SPAN></TD>
						<TD id=jeu_m_62_408 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_412 class=Jut_caption_1>12點</TD>
						<TD id=jeu_p_62_412><SPAN class=multiple_Red id="dh9">-</SPAN></TD>
						<TD id=jeu_m_62_412 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_416 class=Jut_caption_1>16點</TD>
						<TD id=jeu_p_62_416><SPAN class=multiple_Red id="dh13">-</SPAN></TD>
						<TD id=jeu_m_62_416 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
			<TD>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=175>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_405 class=Jut_caption_1 width=54>5點</TD>
						<TD id=jeu_p_62_405 width=59><SPAN class=multiple_Red id="dh2">-</SPAN></TD>
						<TD id=jeu_m_62_405 width=62 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_409 class=Jut_caption_1>9點</TD>
						<TD id=jeu_p_62_409><SPAN class=multiple_Red id="dh6">-</SPAN></TD>
						<TD id=jeu_m_62_409 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_413 class=Jut_caption_1>13點</TD>
						<TD id=jeu_p_62_413><SPAN class=multiple_Red id="dh10">-</SPAN></TD>
						<TD id=jeu_m_62_413 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_417 class=Jut_caption_1>17點</TD>
						<TD id=jeu_p_62_417><SPAN class=multiple_Red id="dh14">-</SPAN></TD>
						<TD id=jeu_m_62_417 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
			<TD vAlign=top>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=175>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_406 class=Jut_caption_1 width=54>6點</TD>
						<TD id=jeu_p_62_406 width=59><SPAN class=multiple_Red id="dh3">-</SPAN></TD>
						<TD id=jeu_m_62_406 width=62 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_410 class=Jut_caption_1>10點</TD>
						<TD id=jeu_p_62_410><SPAN class=multiple_Red id="dh7">-</SPAN></TD>
						<TD id=jeu_m_62_410 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_414 class=Jut_caption_1>14點</TD>
						<TD id=jeu_p_62_414><SPAN class=multiple_Red id="dh11">-</SPAN></TD>
						<TD id=jeu_m_62_414 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
			<TD vAlign=top>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=175>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_407 class=Jut_caption_1 width=54>7點</TD>
						<TD id=jeu_p_62_407 width=59><SPAN class=multiple_Red id="dh4">-</SPAN></TD>
						<TD id=jeu_m_62_407 width=62 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_411 class=Jut_caption_1>11點</TD>
						<TD id=jeu_p_62_411><SPAN class=multiple_Red id="dh8">-</SPAN></TD>
						<TD id=jeu_m_62_411 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD id=jeu_n_62_415 class=Jut_caption_1>15點</TD>
						<TD id=jeu_p_62_415><SPAN class=multiple_Red id="dh12">-</SPAN></TD>
						<TD id=jeu_m_62_415 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
		</TR>
	</TBODY>
</TABLE>
<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
			<TD class="td_caption_1 F_bold">長牌</TD>
		</TR>
	</TBODY>
</TABLE>
<TABLE border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
			<TD>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=233>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD width=83><IMG src="images/4_1.gif" width=27><IMG
							src="images/4_2.gif" width=27></TD>
						<TD id=jeu_p_63_418 width=87 jName="長牌(12)"><SPAN
							class=multiple_Red id="eh1">-</SPAN></TD>
						<TD id=jeu_m_63_418 width=63 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_1.gif" width=27><IMG
							src="images/4_5.gif" width=27></TD>
						<TD id=jeu_p_63_421 jName="長牌(15)"><SPAN class=multiple_Red id="eh4">-</SPAN></TD>
						<TD id=jeu_m_63_421 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_2.gif" width=27><IMG
							src="images/4_4.gif" width=27></TD>
						<TD id=jeu_p_63_424 jName="長牌(24)"><SPAN class=multiple_Red id="eh7">-</SPAN></TD>
						<TD id=jeu_m_63_424 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_3.gif" width=27><IMG
							src="images/4_4.gif" width=27></TD>
						<TD id=jeu_p_63_427 jName="長牌(34)"><SPAN class=multiple_Red id="eh10">-</SPAN></TD>
						<TD id=jeu_m_63_427 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_4.gif" width=27><IMG
							src="images/4_5.gif" width=27></TD>
						<TD id=jeu_p_63_430 jName="長牌(45)"><SPAN class=multiple_Red id="eh13">-</SPAN></TD>
						<TD id=jeu_m_63_430 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
			<TD>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=233>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD width=83><IMG src="images/4_1.gif" width=27><IMG
							src="images/4_3.gif" width=27></TD>
						<TD id=jeu_p_63_419 width=87 jName="長牌(13)"><SPAN
							class=multiple_Red id="eh2">-</SPAN></TD>
						<TD id=jeu_m_63_419 width=63 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_1.gif" width=27><IMG
							src="images/4_6.gif" width=27></TD>
						<TD id=jeu_p_63_422 jName="長牌(16)"><SPAN class=multiple_Red id="eh5">-</SPAN></TD>
						<TD id=jeu_m_63_422 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_2.gif" width=27><IMG
							src="images/4_5.gif" width=27></TD>
						<TD id=jeu_p_63_425 jName="長牌(25)"><SPAN class=multiple_Red id="eh8">-</SPAN></TD>
						<TD id=jeu_m_63_425 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_3.gif" width=27><IMG
							src="images/4_5.gif" width=27></TD>
						<TD id=jeu_p_63_428 jName="長牌(35)"><SPAN class=multiple_Red id="eh11">-</SPAN></TD>
						<TD id=jeu_m_63_428 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_4.gif" width=27><IMG
							src="images/4_6.gif" width=27></TD>
						<TD id=jeu_p_63_431 jName="長牌(46)"><SPAN class=multiple_Red id="eh14">-</SPAN></TD>
						<TD id=jeu_m_63_431 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
			<TD>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=234>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD width=83><IMG src="images/4_1.gif" width=27><IMG
							src="images/4_4.gif" width=27></TD>
						<TD id=jeu_p_63_420 width=88 jName="長牌(14)"><SPAN
							class=multiple_Red id="eh3">-</SPAN></TD>
						<TD id=jeu_m_63_420 width=63 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_2.gif" width=27><IMG
							src="images/4_3.gif" width=27></TD>
						<TD id=jeu_p_63_423 jName="長牌(23)"><SPAN class=multiple_Red id="eh6">-</SPAN></TD>
						<TD id=jeu_m_63_423 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_2.gif" width=27><IMG
							src="images/4_6.gif" width=27></TD>
						<TD id=jeu_p_63_426 jName="長牌(26)"><SPAN class=multiple_Red id="eh9">-</SPAN></TD>
						<TD id=jeu_m_63_426 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_3.gif" width=27><IMG
							src="images/4_6.gif" width=27></TD>
						<TD id=jeu_p_63_429 jName="長牌(36)"><SPAN class=multiple_Red id="eh12">-</SPAN></TD>
						<TD id=jeu_m_63_429 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_5.gif" width=27><IMG
							src="images/4_6.gif" width=27></TD>
						<TD id=jeu_p_63_432 jName="長牌(56)"><SPAN class=multiple_Red id="eh15">-</SPAN></TD>
						<TD id=jeu_m_63_432 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
		</TR>
	</TBODY>
</TABLE>
<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
			<TD class="td_caption_1 F_bold">短牌</TD>
		</TR>
	</TBODY>
</TABLE>
<TABLE border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
			<TD>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=233>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD width=83><IMG src="images/4_1.gif" width=27><IMG
							src="images/4_1.gif" width=27></TD>
						<TD id=jeu_p_64_433 width=87 jName="短牌(11)"><SPAN
							class=multiple_Red id="fh1">-</SPAN></TD>
						<TD id=jeu_m_64_433 width=63 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_4.gif" width=27><IMG
							src="images/4_4.gif" width=27></TD>
						<TD id=jeu_p_64_436 jName="短牌(44)"><SPAN class=multiple_Red id="fh4">-</SPAN></TD>
						<TD id=jeu_m_64_436 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
			<TD>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=233>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD width=83><IMG src="images/4_2.gif" width=27><IMG
							src="images/4_2.gif" width=27></TD>
						<TD id=jeu_p_64_434 width=87 jName="短牌(22)"><SPAN
							class=multiple_Red id="fh2">-</SPAN></TD>
						<TD id=jeu_m_64_434 width=63 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_5.gif" width=27><IMG
							src="images/4_5.gif" width=27></TD>
						<TD id=jeu_p_64_437 jName="短牌(55)"><SPAN class=multiple_Red id="fh5">-</SPAN></TD>
						<TD id=jeu_m_64_437 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
			<TD>
			<TABLE class=Ball_List border=0 cellSpacing=0 cellPadding=0 width=234>
				<TBODY>
					<TR class=Ball_tr_H>
						<TD width=83><IMG src="images/4_3.gif" width=27><IMG
							src="images/4_3.gif" width=27></TD>
						<TD id=jeu_p_64_435 width=88 jName="短牌(33)"><SPAN
							class=multiple_Red id="fh3">-</SPAN></TD>
						<TD id=jeu_m_64_435 width=63 class="load">封盤</TD>
					</TR>
					<TR class=Ball_tr_H>
						<TD><IMG src="images/4_6.gif" width=27><IMG
							src="images/4_6.gif" width=27></TD>
						<TD id=jeu_p_64_438 jName="短牌(66)"><SPAN class=multiple_Red id="fh6">-</SPAN></TD>
						<TD id=jeu_m_64_438 class="load">封盤</TD>
					</TR>
				</TBODY>
			</TABLE>
			</TD>
		</TR>
	</TBODY>
</TABLE>
<FORM onSubmit="return submitforms()" method=post name=M_JeuForm
	action=L_Confirm_Jeu.php target=leftFrame autocomplete="off" id="dp">
	<input type="hidden" name="actions" value="fnpk3" />
	<input type="hidden" name="gtypes" value="1" />
	<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money']?>" /> <BR>
<TABLE border=0 cellSpacing=0 cellPadding=0 width=700>
	<TBODY>
		<TR>
        <td align="center" >
	    	<input onClick="Shortcut_SH(false);" id="Shortcut_Switch" name="Shortcut_Switch" value="" type="checkbox"/>
	    	<a class="font_g F_bold" onFocus="this.blur()" title="快捷下註" onClick="Shortcut_SH(true);" href="javascript:void(0)" style="color:#299a26">快捷下注</a>
	    	<span id="Shortcut_DIV" class="font_g"></span>&nbsp;&nbsp;&nbsp;<input type="button" onClick="Shortcut_hidden();reset();eliminate_jeu();" class="inputs ti" value="重填" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="submits" class="inputs ti" name=confirm  value="下註" /><input type="text" id="submitss"  value="" style="width:0px;height:0px;border:0px;"/></td>
       			<td id="actiionn"></td>
		</TR>
	</TBODY>
</TABLE>
</FORM>
<BR>
<DIV id=LSL_Http></DIV>
<DIV style="POSITION: absolute; DISPLAY: block; TOP: 11px; LEFT: 713px;"
	id=RR_DIV>
<TABLE class=t_list border=0 cellSpacing=0 cellPadding=0 width=175 style="margin-left: 15px;">
	<tBODY>
		<TR>
			<TD class="t_list_caption F_bold" colSpan=6>近期開獎結果</TD>
		</TR>
		<?php foreach ($jqhj as $v){?>
			<TR class=Ball_tr_H>
			<TD width=30><?php $qinumber=$v["g_qishu"];  echo mb_substr($qinumber,-2)?>期</TD>
				<TD class=No_<?php echo $v["g_ball_1"]?> width=25></TD>
				<TD class=No_<?php echo $v["g_ball_2"]?> width=25></TD>
				<TD class=No_<?php echo $v["g_ball_3"]?> width=25></TD>
				<TD width=25><?php echo $v["g_ball_1"]+$v["g_ball_2"]+$v["g_ball_3"];?></TD>
				<TD width=25><?php 
				if ($v["g_ball_1"]==$v["g_ball_2"] && $v["g_ball_1"]==$v["g_ball_3"]){echo "<font color='green'>通吃</font>";}else{$a=$v["g_ball_1"]+$v["g_ball_2"]+$v["g_ball_3"]; echo $a<11?"小":"<font color='red'>大</font>";}?>
				</TD>
			</TR>
		<?php }?>
<!--		<TR class=Ball_tr_H>-->
<!--			<TD width=35>27期</TD>-->
<!--			<TD class=No_2 width=27></TD>-->
<!--			<TD class=No_2 width=27></TD>-->
<!--			<TD class=No_4 width=27></TD>-->
<!--			<TD width=24>8</TD>-->
<!--			<TD width=30>小</TD>-->
<!--		</TR>-->
		
	</TBODY>
</TABLE>
</DIV>
<div id="look" ></div>
<DIV id=PLAY_Sound1></DIV>
<BR>
<SCRIPT language=JAVASCRIPT>
//parent.topFrame.Save_CacheCI(22);
//ClockTime_C="00:01:23";
//ClockTime_O="00:03:53";
//Run_onTimer();
//document.getElementById("JeuValidate").value="066026754";
//document.M_JeuForm.autocomplete="off";
if (parent.frames["leftFrame"].location.toString().indexOf("left")==-1) 
//alert(1);
	parent.frames["leftFrame"].location='left.php';
//t_LT="4";
//t_GT="58,59,60,61,62,63,64";
//T=22;
//UVID=11691;
//parent.topFrame.Select_MC(22);
//LoadXml();
</SCRIPT>
</BODY>
</HTML>