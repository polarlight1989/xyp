<?php
header("content-type:text/html;charset=utf-8");
if(!defined("ROOT_PATH"))
	define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/temp/offGamekl8.php';
include_once ROOT_PATH.'Admin/ExistUser.php';
$db=new DB();
$sql="select * from g_history8 where g_ball_1 is not null order by g_date desc limit 20";
$jqhj=$db->query($sql,1);
markPos("后台-快樂8即时注单");
?>
<script>
var	gametype="gg";
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE></TITLE>
<LINK rel=stylesheet type=text/css href="css/Common1.css" />
<link href="/Admin/temp/css/commoncq.css" rel="stylesheet" type="text/css" />
<LINK rel=stylesheet type=text/css href="css/Style.css" />
<LINK rel=stylesheet type=text/css href="/Css/kl8.css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Admin/temp/js/oddsFilekl8.js"></script>
<!--<SCRIPT type=text/javascript src="js/Jquery.js"></SCRIPT>-->
<!---->
<!--<SCRIPT type=text/javascript src="js/Common.js"></SCRIPT>-->
<!---->
<!--<SCRIPT type=text/javascript src="js/admin/ManualShipments4.js"></SCRIPT>-->
<!---->
<!--<SCRIPT type=text/javascript src="js/PublicData.js"></SCRIPT>

<SCRIPT type=text/javascript src="js/admin/Shipments.js"></SCRIPT>-->
<SCRIPT type=text/javascript src="js/Forbid.js"></SCRIPT>
</HEAD>
<BODY sizcache="0" sizset="0">
<INPUT id=G name=G value=5 type=hidden />
<INPUT id=N name=N value=24790C2271CFCDBB792F577798718F2A type=hidden />
<INPUT id=TID name=TID value=1 type=hidden />
<INPUT id=mixMoney name=mixMoney value=5 type=hidden>
<INPUT id=Comt name=Comt value=0 type=hidden>
<DIV id=rPop class="R_pop pcc">
  <TABLE class="Man_Conter az" border=0 cellSpacing=0 cellPadding=0>
    <TBODY>
      <TR class=Conter_top1>
        <TH class=black colSpan=2>補貨單</TH>
      </TR>
      <TR class=Conter_list>
        <TD width="30%">類型</TD>
        <TD id=t_type class=r_cc align=left></TD>
      </TR>
      <TR class=Conter_list>
        <TD width="30%">賠率</TD>
        <TD id=t_odds class=r_dq align=left></TD>
      </TR>
      <TR class=Conter_list>
        <TD width="30%">金額</TD>
        <TD class=r_dq align=left><INPUT onBlur="this.className='inp1 cvd'"
				style="WIDTH: 70px; HEIGHT: 18px" id=t_money class="inp1 cvd"
				onfocus="this.className='inp1m cvd'" onkeypress=digitOnly(event)
				autocomplete="off"></TD>
      </TR>
      <TR class=Conter_list>
        <TD width="30%">限額</TD>
        <TD id=t_n class=r_dc align=left>0</TD>
      </TR>
      <TR class=Conter_list>
        <TD class=cnz colSpan=2><INPUT class="input1 eccd"
				onmouseover="this.className='input1_1 eccd'"
				onmouseout="this.className='input1 eccd'" onclick=GoPost(this)
				value=補出 type=button>
          &nbsp;
          <INPUT class=input1
				onmouseover="this.className='input1_1'"
				onmouseout="this.className='input1'" onClick="open_close('rPop')"
				value=取消 type=button></TD>
      </TR>
    
  </TABLE>
</DIV>
<DIV id=kOddsPop>
  <TABLE class=Man_Conter border=0 cellSpacing=0>
    <TBODY>
      <TR class=Conter_top1 align=center>
        <TD colSpan=5>補貨結果明細</TD>
      </TR>
      <TR class=Conter_Report_List>
        <TH class=t_Edit_caption_4>單碼</TH>
        <TH class=t_Edit_caption_4>明細</TH>
        <TH class=t_Edit_caption_4>金額</TH>
        <TH class=t_Edit_caption_4>可贏</TH>
        <TH class=t_Edit_caption_4>結果</TH>
      </TR>
    <TBODY id=vList>
    
  </TABLE>
</DIV>
<TABLE class="Main m_1" border=0 cellSpacing=0 cellPadding=0 sizcache="0" sizset="0" width="99%">
<TBODY sizcache="0" sizset="0">
<TR>
  <TD class=Main_top_left></TD>
  <TD background=images/tab_05.gif>
  <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
    <TBODY>
      <TR>
        <TD width=20 align=right><IMG style="MARGIN-RIGHT: 5px" alt="" src="images/tb.gif" width=16 height=16></TD>
        <TD class=Main_Title>
        <SPAN style="WIDTH: 125px" id=openNumberData class="mt green">20<span id="number" class="green"></span>期</SPAN>
        <SPAN style="PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 13px; PADDING-TOP: 2px" id=typeTitle class="mt blue">總項盤口</SPAN> 
        <span id="offTime">距封盤</span> <span id="EndTime" style="position:relative;color:red;letter-spacing:1px;">加載中...</span></td>
        <td style="color:red;font-weight:bold"><div  id="row1" style="position: relative; ; FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">今日輸贏：<span id="win">0</span></div></td>
      </td>
    
    
      <TD width="650"><TABLE class=b_jk border=0 cellSpacing=0 cellPadding=0>
          <TBODY>
            <TR height=26>
              <TD><B id=numberData class=np><?php echo $jqhj[0]["g_qishu"]?>期</B></TD>
              <TD id=b1 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_1"])?>" width=27></TD>
              <TD id=b2 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_2"])?>" width=27></TD>
              <TD id=b3 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_3"])?>" width=27></TD>
              <TD id=b4 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_4"])?>" width=27></TD>
              <TD id=b5 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_5"])?>" width=27></TD>
              <TD id=b6 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_6"])?>" width=27></TD>
              <TD id=b7 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_7"])?>" width=27></TD>
              <TD id=b8 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_8"])?>" width=27></TD>
              <TD id=b9 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_9"])?>" width=27></TD>
              <TD id=b10 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_10"])?>" width=27></TD>
              <TD id=b11 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_11"])?>" width=27></TD>
              <TD id=b12 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_12"])?>" width=27></TD>
              <TD id=b13 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_13"])?>" width=27></TD>
              <TD id=b14 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_14"])?>" width=27></TD>
              <TD id=b15 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_15"])?>" width=27></TD>
              <TD id=b16 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_16"])?>" width=27></TD>
              <TD id=b17 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_17"])?>" width=27></TD>
              <TD id=b18 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_18"])?>" width=27></TD>
              <TD id=b19 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_19"])?>" width=27></TD>
              <TD id=b20 class="ballskl8 b<?php echo sprintf('%02d',$jqhj[0]["g_ball_20"])?>" width=27></TD>
            </TR>
          
        </TABLE></TD>
      <TD align=right><SELECT style="POSITION: relative; TOP: 1px"
							id=details_tn onchange=ShowDetails(this)>
          <OPTION selected value=0>實占</OPTION>
          <OPTION value=1>虛註</OPTION>
        </SELECT></TD>
      <TD width=150 align=right><SPAN id=refreshTime class="blue black">更新：<span id="RefreshTime">加載中...</span></SPAN>
        <SELECT style="POSITION: relative; TOP: 2px" id=EstateTime onchange=LoadRefreshTime()>
          <OPTION value=0>-NO-</OPTION>
          <OPTION value=20>20秒</OPTION>
          <OPTION value=25>25秒</OPTION>
          <OPTION selected value=30>30秒</OPTION>
          <OPTION value=40>40秒</OPTION>
          <OPTION value=50>50秒</OPTION>
          <OPTION value=60>60秒</OPTION>
          <OPTION value=99>99秒</OPTION>
        </SELECT></TD>
    </TR>
      
    
  </TABLE>
  </TD>
  <TD class=Main_top_right></TD>
</TR>
<TR sizcache="0" sizset="0">
  <TD class=Main_left></TD>
  <TD class=Main_conter sizcache="0" sizset="0">
  <!-- strat -->
  <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%" sizcache="0" sizset="0">
      <TBODY sizcache="0" sizset="0">
    
      <TR sizcache="0" sizset="0">
    
    <TD vAlign=top width="20%" sizcache="0" sizset="0"></TD>
    <TD vAlign=top width="25%" sizcache="0" sizset="30"><TABLE class="Man_Conter az" border=0 cellSpacing=0 cellPadding=0 sizcache="0" sizset="30" width="25%"  style="margin:0px 6px;margin-top:5px;top:1px;">
        <TBODY>
          <TR class=Conter_top>
            <TD width="16%">號</TD>
            <TD width="28%" colSpan=<?php echo $_SESSION["loginId"]==89?3:1;?>>賠率</TD>
            <TD>註額</TD>
            <TD>虧盈</TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="30">
            <TD class="t_Edit_caption_1 st">總和大</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" align=center width="2%"><IMG style="CURSOR: pointer" onClick="setOdds('zhdx1',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="zhdx1" class="t_Edit_caption_3 ct1" onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" align=center width="2%"><IMG style="CURSOR: pointer" onClick="setOdds('zhdx1',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" sizcache="0" sizset="30"><A id=azhdx1 class=green2 title=查看註單明細 onClick="popWin('總和大小','總和大');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_8"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" sizcache="0" sizset="31"><A id=bzhdx1 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="32">
            <TD class="t_Edit_caption_1 st">總和小</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onClick="setOdds('zhdx2',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="zhdx2" class="t_Edit_caption_3 ct1" onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onClick="setOdds('zhdx2',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" sizcache="0" sizset="32"><A id=azhdx2 class=green2 title=查看註單明細 onClick="popWin('總和大小','總和大小');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_9"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" sizcache="0" sizset="33"><A id=bzhdx2 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="34">
            <TD class="t_Edit_caption_1 st">總和單</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onClick="setOdds('zhds1',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="zhds1" class="t_Edit_caption_3 ct1" onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onClick="setOdds('zhds1',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" sizcache="0" sizset="34"><A id=azhds1 class=green2 title=查看註單明細 onClick="popWin('總和單雙','總和單');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_10"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" sizcache="0" sizset="35"><A id=bzhds1 class=red3 title=補貨 href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="36">
            <TD class="t_Edit_caption_1 st">總和雙</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onClick="setOdds('zhds2',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="zhds2" class="t_Edit_caption_3 ct1" onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onClick="setOdds('zhds2',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" sizcache="0" sizset="36"><A id=azhds2 class=green2 title=查看註單明細 onClick="popWin('總和單雙','總和雙');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_11"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" sizcache="0" sizset="37"><A id=bzhds2 class=red3 title=補貨 href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="38">
            <TD class="t_Edit_caption_1 st">總和810</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onClick="setOdds('zhhj',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="zhhj" class="t_Edit_caption_3 ct1" onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onClick="setOdds('zhhj',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" sizcache="0" sizset="38"><A id=azhhj class=green2 title=查看註單明細 onClick="popWin('總和和局','總和810');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_12"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" onMouseOut="closeMouse(this,'ct1')" sizcache="0" sizset="39"><A id=bzhhj class=red3 title=補貨 href="javascript:void(0)">-</A></TD>
          </TR>
        
          <TR class=Conter_top1>
            <TH width="100%" colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>總和過關</TH>
          </TR>
        
          <TR class=Conter_Report_List sizcache="0" sizset="42">
            <TD class="t_Edit_caption_1 st">總大單</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('gg1',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="gg1" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('gg1',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="42"><A 	id=agg1 class=green2 title=查看註單明細 	onclick="popWin('總和過關','總大單');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_15"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="43"><A 	id=bgg1 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="44">
            <TD class="t_Edit_caption_1 st">總大雙</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('gg2',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="gg2" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('gg2',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="44"><A 	id=agg2 class=green2 title=查看註單明細 	onclick="popWin('總和過關','總大雙');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_16"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="45"><A 	id=bgg2 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="46">
            <TD class="t_Edit_caption_1 st">總小單</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('gg3',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="gg3" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('gg3',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="46"><A 	id=agg3 class=green2 title=查看註單明細 	onclick="popWin('總和過關','總小單');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_17"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="47"><A 	id=bgg3 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="48">
            <TD class="t_Edit_caption_1 st">總小雙</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('gg4',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="gg4" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('gg4',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="48"><A 	id=agg4 class=green2 title=查看註單明細 	onclick="popWin('總和過關','總小雙');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_18"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="49"><A 	id=bgg4 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_top1>
            <TH width="100%" colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>前后和</TH>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="42">
            <TD class="t_Edit_caption_1 st">前(多)</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('zhh1',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="zhh1" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('zhh1',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="42"><A 	id=azhh1 class=green2 title=查看註單明細 	onclick="popWin('前後和','前(多)');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_15"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="43"><A 	id=azhh1 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="44">
            <TD class="t_Edit_caption_1 st">後(多)</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('zhh2',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="zhh2" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('zhh2',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="44"><A 	id=azhh2 class=green2 title=查看註單明細 	onclick="popWin('前後和','後(多)');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_16"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="45"><A 	id=bzhh2 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="46">
            <TD class="t_Edit_caption_1 st">前後(和)</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class="ct1" onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('zhh3',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="zhh3" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('zhh3',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="46"><A 	id=azhh3 class=green2 title=查看註單明細 	onclick="popWin('前後和','前後(和)');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_17"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="47"><A 	id=bzhh3 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_top1>
            <TH width="100%" colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>單雙和</TH>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="42">
            <TD class="t_Edit_caption_1 st">單(多)</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('dsh1',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="dsh1" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('dsh1',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="42"><A 	id=adsh1 class=green2 title=查看註單明細 	onclick="popWin('單雙和','單(多)');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_15"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="43"><A 	id=adsh1 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="44">
            <TD class="t_Edit_caption_1 st">雙(多)</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('dsh2',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="dsh2" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('dsh2',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="44"><A 	id=adsh2 class=green2 title=查看註單明細 	onclick="popWin('單雙和','雙(多)');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_16"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="45"><A 	id=bdsh2 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="46">
            <TD class="t_Edit_caption_1 st">單雙(和)</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('dsh3',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="dsh3" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('dsh3',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="46"><A 	id=adsh3 class=green2 title=查看註單明細 	onclick="popWin('單雙和','單雙(和)');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_17"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="47"><A 	id=bdsh3 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_top1>
            <TH width="100%" colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>五行</TH>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="42">
            <TD class="t_Edit_caption_1 st">金</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('wx1',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="wx1" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('wx1',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="42"><A 	id=awx1 class=green2 title=查看註單明細 	onclick="popWin('五行','金');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_15"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="43"><A 	id=awx1 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="44">
            <TD class="t_Edit_caption_1 st">木</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('wx2',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="wx2" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('wx2',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="44"><A 	id=awx2 class=green2 title=查看註單明細 	onclick="popWin('五行','木');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_16"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="45"><A 	id=bwx2 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="46">
            <TD class="t_Edit_caption_1 st">水</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('wx3',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="wx3" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('wx3',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="46"><A 	id=awx3 class=green2 title=查看註單明細 	onclick="popWin('五行','水');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_17"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="47"><A 	id=bwx3 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="46">
            <TD class="t_Edit_caption_1 st">火</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('wx4',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="wx4" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('wx4',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="46"><A 	id=awx4 class=green2 title=查看註單明細 	onclick="popWin('五行','火');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_17"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="47"><A 	id=bwx4 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="46">
            <TD class="t_Edit_caption_1 st">土</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('wx5',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id="wx5" class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onClick="setOdds('wx5',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="46"><A 	id=awx5 class=green2 title=查看註單明細 	onclick="popWin('五行','土');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_17"></B></TD>
            <TD class=ct1 onMouseOver="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="47"><A 	id=bwx5 class=red3 title=補貨 		href="javascript:void(0)">-</A></TD>
          </TR>
      </TABLE></TD>
    <TD vAlign=top width="25%" sizcache="0" sizset="70"></td>
      <TD vAlign=top width="6%" sizcache="0" sizset="0">
    
    <TABLE class="Man_Conter az" border=0 cellSpacing=0 cellPadding=0 sizcache="0" sizset="0" style="margin:0px 6px;margin-top:5px;top:1px;">
      <DIV id=LSL_Http></DIV>
        <DIV style="POSITION: absolute; DISPLAY: block; TOP: 11px; LEFT: 713px;"
	id=RR_DIV>
      
      <TABLE  border=0 cellSpacing=0 cellPadding=0 width=175 style="margin-left: 12px;">
        <tBODY>
          <TR>
            <TD colSpan=6></TD>
          </TR>
      </table>
        </td>
      
        </TR>
      
        
      
    </TABLE>
    <!-- end -->
    
      </TD>
    
    
      <TD class=Main_right width=5></TD>
    </TR>
    <TR>
      <TD class=Main_bottom_left></TD>
      <TD background=images/tab_19.gif align=center>平均虧損：
        <INPUT
				onblur="this.className='inp2 bct'"
				style="POSITION: relative; WIDTH: 100px; HEIGHT: 18px; TOP: 1px"
				id=_value class="inp2 bct" onFocus="this.className='inp2m bct'"
				value=-10000000 autocomplete="off">
        &nbsp;
        <INPUT
				style="COLOR: #7300aa" class="input2 bct"
				onmouseover="this.className='input2_2 bct'"
				onmouseout="this.className='input2 bct'" onclick=Details()
				value=計算補貨 type=button>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" style="COLOR: #7300aa" class="input2 bct"
				onmouseover="this.className='input2_2 bct'"
				onmouseout="this.className='input2 bct'" value="還原賠率" onClick="initializes()" /></TD>
      <TD class=Main_bottom_right></TD>
    </TR>
      
    
  </TABLE>
  <div id="oddsPop">
<table border="0" cellspacing="0" class="t_odds" width="100%">
	<tr class="tr_top">
    <th colspan="2">補貨單</th>
  </tr>
  <tr class="text" align="center">
    <td width="50" >類型</td>
    <td class="balls" id="type_s"></td>
  </tr>
  <tr class="text" align="center">
    <td width="50">賠率</td>
    <td class="odds" id="odds_s"></td>
  </tr>
  <tr class="text" align="center">
    <td width="50">金額</td>
    <td><input type="text" id="s_money" class="textc" /></td>
  </tr>
  <tr class="text" align="center">
    <td width="50">限額</td>
    <td id="money_s">0</td>
  </tr>
  <tr class="texts">
    <td align="center" height="60" colspan="2">
      <input type="button" class="inputa" onClick="GoPost()" value="補出" />&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="button" class="inputa" onClick="closePop(2)" value="關閉" />
      <input type="hidden" id="typeid" />
    </td>
  </tr>
</table>
</div>
<div id="kOddsPop">
<table border="0" cellspacing="0" class="t_odds" width="100%">
  <tr class="tr_top" align="center">
    <td colspan="5">補貨結果明細</td>
  </tr>
  <tr class="texts" align="center">
    <td><b>單碼</b></td>
    <td><b>明細</b></td>
    <td><b>金額</b></td>
    <td><b>可贏</b></td>
    <td><b>結果</b></td>
  </tr>
	<tfoot id="vList"></tfoot>
</table>
</div>
</BODY>
<script>
function popWin(pid,cid){
	var pid=encodeURI(pid);
	window.open('/Admin/temp/CrystalIsNot.php?cid=8&ty=8&tid='+pid+'&pid='+cid,'newwindow');	
}
function showMouse(obj, className) {
    $(obj).addClass("backgroundColor");
    $(obj).siblings("." + className).addClass("backgroundColor");
}
function closeMouse(obj, className) {
    $(obj).removeClass("backgroundColor");
    $(obj).siblings("." + className).removeClass("backgroundColor");
}
</script>
</HTML>