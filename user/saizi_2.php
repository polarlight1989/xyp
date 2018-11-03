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
$_SESSION['gx'] = false;
$_SESSION['gd'] = false;
$_SESSION['sz'] = true;
$_SESSION['cq'] = false;
$_SESSION['pk'] = false;
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
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<LINK rel=stylesheet type=text/css href="css/main_n1.css">
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
      <TD colspan="2" class="bolds" style="color:red"><SPAN style="position: relative;  FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">今天輸贏：</SPAN> <SPAN
				id="UserResult" class="shuyingjieguo2">0.0</SPAN></td>
      <TD width="50%" align=right><TABLE border=0 cellSpacing=0 cellPadding=0>
          <TBODY>
            <TR>
              <TD height=30 width=140><span id="o" style=" color:#000000; font-weight:bold; font-size:12px;position:relative; top:0px">20</span><B id=UP_LID class=Font_Y>-</B><B>期开奖</B></TD>
              <TD id=BaLL_No1 class=No_2 width=30>&nbsp;</TD>
              <TD id=BaLL_No2 class=No_2 width=30>&nbsp;</TD>
              <TD id=BaLL_No3 class=No_4 width=30>&nbsp;</TD>
            </TR>
          </TBODY>
        </TABLE></TD>
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
<table border="0" cellpadding="0" cellspacing="0" width="700">
    <tr>
        <td colspan="4">
            <table border="0" cellpadding="0" cellspacing="0" class="Man_Conter">
                <tr class="Conter_top" height="26">
                    <th>魚蝦蟹</th>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><span onMouseOver="this.className='img_1_1'" onMouseOut="this.className='img_1'" onMouseDown="this.className='img_1_2'" onClick="Details(1)" class="img_1" id="H_0_2" title="按此下註"></span></td>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><span onMouseOver="this.className='img_2_1'" onMouseOut="this.className='img_2'" onMouseDown="this.className='img_2_2'" onClick="Details(2)" class="img_2" id="H_0_3" title="按此下註"></span></td>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><span onMouseOver="this.className='img_3_1'" onMouseOut="this.className='img_3'" onMouseDown="this.className='img_3_2'" onClick="Details(3)" class="img_3" id="H_0_4" title="按此下註"></span></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><span onMouseOver="this.className='img_4_1'" onMouseOut="this.className='img_4'" onMouseDown="this.className='img_4_2'" onClick="Details(4)" class="img_4" id="H_0_5" title="按此下註"></span></td>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><span onMouseOver="this.className='img_5_1'" onMouseOut="this.className='img_5'" onMouseDown="this.className='img_5_2'" onClick="Details(5)" class="img_5" id="H_0_6" title="按此下註"></span></td>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><span onMouseOver="this.className='img_6_1'" onMouseOut="this.className='img_6'" onMouseDown="this.className='img_6_2'" onClick="Details(6)" class="img_6" id="H_0_7" title="按此下註"></span></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<div style="display:none">
<SPAN class=multiple_Red id="ah1">-</SPAN>
<SPAN class=multiple_Red id="ah2">-</SPAN>
<SPAN class=multiple_Red id="ah3">-</SPAN>
<SPAN class=multiple_Red id="ah4">-</SPAN>
<SPAN class=multiple_Red id="ah5">-</SPAN>
<SPAN class=multiple_Red id="ah6">-</SPAN>
</div>
<BR>
<DIV id=LSL_Http></DIV>
<DIV style="POSITION: absolute; DISPLAY: block; TOP: 11px; LEFT: 713px;"
	id=RR_DIV>
  <TABLE class=t_list border=0 cellSpacing=0 cellPadding=0 width=140 style="margin-left: 15px;">
    <tBODY>
      <TR>
        <TD class="t_list_caption F_bold" colSpan=6>近期開獎結果</TD>
      </TR>
      <?php foreach ($jqhj as $v){?>
      <TR class=Ball_tr_H style="height:40px">
        <TD width=40><?php $qinumber=$v["g_qishu"];  echo mb_substr($qinumber,-2)?>
          期</TD>
        <TD class=No_<?php echo $v["g_ball_1"]?> width=25></TD>
        <TD class=No_<?php echo $v["g_ball_2"]?> width=25></TD>
        <TD class=No_<?php echo $v["g_ball_3"]?> width=25></TD>
      </TR>
      <?php }?>
      
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
function Details(id)
{
	if($("#ah"+id).text()!="-")
	{
		parent.frames["leftFrame"].location.href=$("#ah"+id).find("a").get(0);	
	}
}
</SCRIPT>
</BODY>
</HTML>