<?php
header("content-type:text/html;charset=utf-8");
if(!defined("ROOT_PATH"))
	define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/temp/offGamesz.php';
include_once ROOT_PATH.'Admin/ExistUser.php';
//echo "22";
$db=new DB();
$sql="select * from g_history7 order by g_qishu desc limit 20";
$jqhj=$db->query($sql,1);
markPos("后台-快3即时注单");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE></TITLE>
<link href="/Admin/temp/css/commoncq.css" rel="stylesheet" type="text/css" />
<LINK rel=stylesheet type=text/css href="css/Common1.css" />
<LINK rel=stylesheet type=text/css href="css/Style.css" />
<LINK rel=stylesheet type=text/css href="css/Ballclass4.css" />

<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Admin/temp/js/oddsFilesz.js"></script>
<!--<SCRIPT type=text/javascript src="js/Jquery.js"></SCRIPT>-->
<!---->
<!--<SCRIPT type=text/javascript src="js/Common.js"></SCRIPT>-->
<!---->
<!--<SCRIPT type=text/javascript src="js/admin/ManualShipments4.js"></SCRIPT>-->
<!---->
<!--<SCRIPT type=text/javascript src="js/PublicData.js"></SCRIPT>-->
<!--
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
        <TD class=r_dq align=left><INPUT onblur="this.className='inp1 cvd'"
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
				onmouseout="this.className='input1'" onclick="open_close('rPop')"
				value=取消 type=button></TD>
      </TR>
    </TBODY>
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
    </TBODY>
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
        <TD width=20 align=right><IMG style="MARGIN-RIGHT: 5px" alt=""
							src="images/tb.gif" width=16 height=16></TD>
        <TD class=Main_Title><SPAN style="WIDTH: 125px" id=openNumberData
							class="mt green">20<span id="number"class="green"></span>期</SPAN><SPAN
							style="PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 13px; PADDING-TOP: 2px"
							id=typeTitle class="mt blue">總項盤口</SPAN> <span id="offTime">距封盤</span> <span id="EndTime" style="position:relative;color:red;letter-spacing:1px;">加載中...</span></td>
        <td style="color:red;font-weight:bold"><div  id="row1" style="position: relative; ; FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">今日輸贏：<span id="win">0</span></div></td>
      </td>
    
    
      <TD width="30%"><TABLE class=b_jk border=0 cellSpacing=0 cellPadding=0>
          <TBODY>
            <TR height=26>
              <TD><B id=numberData class=np><?php echo $jqhj[0]["g_qishu"]?>期</B></TD>
              <TD id=b1 class=No_<?php echo $jqhj[0]["g_ball_1"]?> width=27></TD>
              <TD id=b2 class=No_<?php echo $jqhj[0]["g_ball_2"]?> width=27></TD>
              <TD id=b3 class=No_<?php echo $jqhj[0]["g_ball_3"]?> width=27></TD>
            </TR>
          </TBODY>
        </TABLE></TD>
      <TD align=right><SELECT style="POSITION: relative; TOP: 1px"
							id=details_tn onchange=ShowDetails(this)>
          <OPTION selected value=0>實占</OPTION>
          <OPTION value=1>虛註</OPTION>
        </SELECT></TD>
      <TD width=150 align=right><SPAN id=refreshTime class="blue black">更新：<span id="RefreshTime">加載中...</span></SPAN>
        <SELECT style="POSITION: relative; TOP: 2px" id=EstateTime
							onchange=LoadRefreshTime()>
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
      </TBODY>
    
  </TABLE>
  </TD>
  <TD class=Main_top_right></TD>
</TR>
<TR sizcache="0" sizset="0">
  <TD class=Main_left></TD>
  <TD class=Main_conter sizcache="0" sizset="0">
  <!-- strat -->
  <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%" sizcache="0"
				sizset="0">
      <TBODY sizcache="0" sizset="0">
    
      <TR sizcache="0" sizset="0">
    
    <TD vAlign=top width="20%" sizcache="0" sizset="0"><TABLE class="Man_Conter az" border=0 cellSpacing=0 cellPadding=0 sizcache="0" sizset="0"  width="25%"  style="margin:0px 3px;margin-top:5px;top:1px;">
        <TBODY>
          <TR class=Conter_top>
            <TD width="15%">號</TD>
            <TD width="28%" colSpan="<?php echo $_SESSION["loginId"]==89?3:1;?>">賠率</TD>
            <TD>註額</TD>
            <TD>虧盈</TD>
          </TR>
          <TR class=Conter_top1>
            <TH width="100%" colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>三軍</TH>
          </TR>
        <TBODY id=ct1 sizcache="0" sizset="0">
          <TR class=Conter_Report_List sizcache="0" sizset="0">
            <TD class="t_Edit_caption_1 st">1/<span style="color:#ff0000">魚</span></TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center width="2%"><IMG style="CURSOR: pointer" onclick="setOdds('ah1',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ah1 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center width="2%"><IMG style="CURSOR: pointer" onclick="setOdds('ah1',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="0"><A id=aah1 class=green2 title=查看註單明細 onclick="popWin('三军','1');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_2"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="1"><TABLE class=rm border=0 cellSpacing=0 cellPadding=0 width="100%" sizcache="0" sizset="1">
                <TBODY sizcache="0" sizset="1">
                  <TR sizcache="0" sizset="1">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; WIDTH: 30px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>一骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="1"><A 		id=bah1 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                  <TR sizcache="0" sizset="2">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>两骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="2"><A 		id=bah12 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                  <TR sizcache="0" sizset="3">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>叁骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="3"><A 		id=bah13 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                </TBODY>
              </TABLE></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="4">
            <TD class="t_Edit_caption_1 st">2/<span style="color:#1a843c">蝦</span></TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ah2',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ah2 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ah2',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="4"><A id=aah2 class=green2 title=查看註單明細 onclick="popWin('三军','2');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_3"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="5"><TABLE class=rm border=0 cellSpacing=0 cellPadding=0 width="100%" sizcache="0" sizset="5">
                <TBODY sizcache="0" sizset="5">
                  <TR sizcache="0" sizset="5">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; WIDTH: 30px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>一骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="5"><A 		id=bah2 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                  <TR sizcache="0" sizset="6">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>两骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="6"><A 		id=bah22 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                  <TR sizcache="0" sizset="7">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>叁骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="7"><A 		id=bah23 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                </TBODY>
              </TABLE></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="8">
            <TD class="t_Edit_caption_1 st">3/<span style="color:#0000ff">葫蘆</span></TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ah3',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ah3 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ah3',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="8"><A id=aah3 class=green2 title=查看註單明細 onclick="popWin('三军','3');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_4"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="9"><TABLE class=rm border=0 cellSpacing=0 cellPadding=0 width="100%" sizcache="0" sizset="9">
                <TBODY sizcache="0" sizset="9">
                  <TR sizcache="0" sizset="9">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; WIDTH: 30px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>一骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="9"><A 		id=bah3 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                  <TR sizcache="0" sizset="10">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>两骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="10"><A 		id=bah32 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                  <TR sizcache="0" sizset="11">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>叁骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="11"><A 		id=bah33 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                </TBODY>
              </TABLE></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="12">
            <TD class="t_Edit_caption_1 st">4/<span style="color:#0000ff">金錢</span></TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ah4',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ah4 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ah4',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="12"><A id=aah4 class=green2 title=查看註單明細 onclick="popWin('三军','4');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_5"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="13"><TABLE class=rm border=0 cellSpacing=0 cellPadding=0 width="100%" sizcache="0" sizset="13">
                <TBODY sizcache="0" sizset="13">
                  <TR sizcache="0" sizset="13">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; WIDTH: 30px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>一骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="13"><A 		id=bah4 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                  <TR sizcache="0" sizset="14">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>两骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="14"><A 		id=bah42 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                  <TR sizcache="0" sizset="15">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>叁骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="15"><A 		id=bah43 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                </TBODY>
              </TABLE></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="16">
            <TD class="t_Edit_caption_1 st">5/<span style="color:#1a843c">螃蟹</span></TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ah5',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ah5 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ah5',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="16"><A id=aah5 class=green2 title=查看註單明細 onclick="popWin('三军','5');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_6"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="17"><TABLE class=rm border=0 cellSpacing=0 cellPadding=0 width="100%" sizcache="0" sizset="17">
                <TBODY sizcache="0" sizset="17">
                  <TR sizcache="0" sizset="17">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; WIDTH: 30px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>一骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="17"><A 		id=bah5 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                  <TR sizcache="0" sizset="18">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>两骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="18"><A 		id=bah52 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                  <TR sizcache="0" sizset="19">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>叁骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="19"><A 		id=bah53 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                </TBODY>
              </TABLE></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="20">
            <TD class="t_Edit_caption_1 st">6/<font color=#ff0000>雞</font></TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ah6',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ah6 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ah6',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="20"><A id=aah6 class=green2 title=查看註單明細 onclick="popWin('三军','6');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_7"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="21"><TABLE class=rm border=0 cellSpacing=0 cellPadding=0 width="100%" sizcache="0" sizset="21">
                <TBODY sizcache="0" sizset="21">
                  <TR sizcache="0" sizset="21">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; WIDTH: 30px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>一骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="21"><A 		id=bah6 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                  <TR sizcache="0" sizset="22">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>两骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="22"><A 		id=bah62 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                  <TR sizcache="0" sizset="23">
                    <TD 		style="PADDING-BOTTOM: 1px; PADDING-LEFT: 3px; PADDING-RIGHT: 0px; PADDING-TOP: 1px" 		class=red2>叁骰</TD>
                    <TD style="TEXT-ALIGN: center" sizcache="0" sizset="23"><A 		id=bah63 class=red3 title=補貨 		 		href="javascript:void(0)">-</A></TD>
                  </TR>
                </TBODY>
              </TABLE></TD>
          </TR>
          <TR class=Conter_Report_List>
            <TD colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>退水后總注額:<B id=_ac class=st>0</B></TD>
          </TR>
        </TBODY>
        <TBODY>
          <TR class=Conter_top1>
            <TH width="100%" colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>大小</TH>
          </TR>
        <TBODY id=ct2 sizcache="0" sizset="24">
          <TR class=Conter_Report_List sizcache="0" sizset="24">
            <TD class="t_Edit_caption_1 st">大</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('bh1',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=bh1 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('bh1',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="24"><A id=abh1 class=green2 title=查看註單明細 onclick="popWin('三军','大');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_0"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="25"><A id=bbh1 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="26">
            <TD class="t_Edit_caption_1 st">小</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('bh2',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=bh2 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('bh2',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="26"><A id=abh2 class=green2 title=查看註單明細 onclick="popWin('三军','小');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_1"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="27"><A id=bbh2 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List>
            <TD colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>全骰盈利：<B id=_hgc class=st>0</B></TD>
          </TR>
        </TBODY>
        <TBODY>
          <TR class=Conter_top1>
            <TH width="100%" colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>全骰</TH>
          </TR>
        <TBODY id=ct3 sizcache="0" sizset="28">
          <TR class=Conter_Report_List sizcache="0" sizset="28">
            <TD class="t_Edit_caption_1 st">全骰</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onclick="setOdds('ch7',1)" 	alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ch7 class="t_Edit_caption_3 ct1" 	onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" align=center><IMG 	style="CURSOR: pointer" onclick="setOdds('ch7',0)" 	alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" 	sizset="28"><A id=agh1 class=green2 title=查看註單明細 	onclick="popWin('圍骰','全骰');return false" 	href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_14"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" 	onmouseout="closeMouse(this,'ct1')" sizcache="0" 	sizset="29"><A id=bgh1 class=red3 title=補貨 	 	href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List>
            <TD colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>混骰盈利：<B id=_c class=st>0</B></TD>
          </TR>
        </TBODY>
      </TABLE></TD>
    <TD vAlign=top width="25%" sizcache="0" sizset="30"><TABLE class="Man_Conter az" border=0 cellSpacing=0 cellPadding=0 sizcache="0" sizset="30" width="25%"  style="margin:0px 6px;margin-top:5px;top:1px;">
        <TBODY>
          <TR class=Conter_top>
            <TD width="16%">號</TD>
            <TD width="28%" colSpan=<?php echo $_SESSION["loginId"]==89?3:1;?>>賠率</TD>
            <TD>註額</TD>
            <TD>虧盈</TD>
          </TR>
          <TR class=Conter_top1>
            <TH width="100%" colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>圍骰</TH>
          </TR>
        <TBODY id=ct4 sizcache="0" sizset="30">
          <TR class=Conter_Report_List sizcache="0" sizset="30">
            <TD class="t_Edit_caption_1 st">111</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center width="2%"><IMG style="CURSOR: pointer" onclick="setOdds('ch1',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ch1 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center width="2%"><IMG style="CURSOR: pointer" onclick="setOdds('ch1',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="30"><A id=ach1 class=green2 title=查看註單明細 onclick="popWin('圍骰','1');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_8"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="31"><A id=bch1 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="32">
            <TD class="t_Edit_caption_1 st">222</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ch2',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ch2 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ch2',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="32"><A id=ach2 class=green2 title=查看註單明細 onclick="popWin('圍骰','2');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_9"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="33"><A id=bch2 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="34">
            <TD class="t_Edit_caption_1 st">333</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ch3',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ch3 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ch3',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="34"><A id=ach3 class=green2 title=查看註單明細 onclick="popWin('圍骰','3');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_10"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="35"><A id=bch3 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="36">
            <TD class="t_Edit_caption_1 st">444</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ch4',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ch4 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ch4',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="36"><A id=ach4 class=green2 title=查看註單明細 onclick="popWin('圍骰','4');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_11"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="37"><A id=bch4 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="38">
            <TD class="t_Edit_caption_1 st">555</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ch5',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ch5 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ch5',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="38"><A id=ach5 class=green2 title=查看註單明細 onclick="popWin('圍骰','5');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_12"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="39"><A id=bch5 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="40">
            <TD class="t_Edit_caption_1 st">666</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ch6',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=ch6 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('ch6',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="40"><A id=ach6 class=green2 title=查看註單明細 onclick="popWin('圍骰','6');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_13"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="41"><A id=bch6 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List>
            <TD colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>混骰盈利：<B id=_cc class=st>0</B></TD>
          </TR>
        </TBODY>
        <TBODY>
          <TR class=Conter_top1>
            <TH width="100%" colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>點數</TH>
          </TR>
        <TBODY id=ct5 sizcache="0" sizset="42">
          <TR class=Conter_Report_List sizcache="0" sizset="42">
            <TD class="t_Edit_caption_1 st">4點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh1',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh1 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh1',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="42"><A id=adh1 class=green2 title=查看註單明細 onclick="popWin('點數','4');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_15"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="43"><A id=adh1 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="44">
            <TD class="t_Edit_caption_1 st">5點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh2',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh2 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh2',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="44"><A id=adh2 class=green2 title=查看註單明細 onclick="popWin('點數','5');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_16"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="45"><A id=bdh2 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="46">
            <TD class="t_Edit_caption_1 st">6點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh3',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh3 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh3',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="46"><A id=adh3 class=green2 title=查看註單明細 onclick="popWin('點數','6');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_17"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="47"><A id=bdh3 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="48">
            <TD class="t_Edit_caption_1 st">7點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh4',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh4 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh4',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="48"><A id=adh4 class=green2 title=查看註單明細 onclick="popWin('點數','7');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_18"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="49"><A id=bdh4 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="50">
            <TD class="t_Edit_caption_1 st">8點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh5',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh5 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh5',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="50"><A id=adh5 class=green2 title=查看註單明細 onclick="popWin('點數','8');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_19"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="51"><A id=bdh5 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="52">
            <TD class="t_Edit_caption_1 st">9點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh6',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh6 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh6',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="52"><A id=adh6 class=green2 title=查看註單明細 onclick="popWin('點數','9');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_20"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="53"><A id=bdh6 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="54">
            <TD class="t_Edit_caption_1 st">10點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh7',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh7 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh7',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="54"><A id=adh7 class=green2 title=查看註單明細 onclick="popWin('點數','10');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_21"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="55"><A id=bdh7 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="56">
            <TD class="t_Edit_caption_1 st">11點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh8',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh8 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh8',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="56"><A id=adh8 class=green2 title=查看註單明細 onclick="popWin('點數','11');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_22"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="57"><A id=bdh8 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="58">
            <TD class="t_Edit_caption_1 st">12點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh9',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh9 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh9',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="58"><A id=adh9 class=green2 title=查看註單明細 onclick="popWin('點數','1点');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_23"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="59"><A id=bdh9 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="60">
            <TD class="t_Edit_caption_1 st">13點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh10',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh10 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh10',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="60"><A id=adh10 class=green2 title=查看註單明細 onclick="popWin('點數','13');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_24"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="61"><A id=bdh10 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="62">
            <TD class="t_Edit_caption_1 st">14點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh11',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh11 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh11',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="62"><A id=adh11 class=green2 title=查看註單明細 onclick="popWin('點數','14');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_25"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="63"><A id=bdh11 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="64">
            <TD class="t_Edit_caption_1 st">15點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh12',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh12 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh12',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="64"><A id=adh12 class=green2 title=查看註單明細 onclick="popWin('點數','15');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_26"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="65"><A id=bdh12 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="66">
            <TD class="t_Edit_caption_1 st">16點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh13',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh13 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh13',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="66"><A id=adh13 class=green2 title=查看註單明細 onclick="popWin('點數','16');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_27"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="67"><A id=bdh13 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="68">
            <TD class="t_Edit_caption_1 st">17點</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh14',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=dh14 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('dh14',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="68"><A id=adh14 class=green2 title=查看註單明細 onclick="popWin('點數','17');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_28"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="69"><A id=bdh14 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List>
            <TD colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>3點/18點盈利：<B id=_dc class=st>0</B></TD>
          </TR>
        </TBODY>
      </TABLE></TD>
    <TD vAlign=top width="25%" sizcache="0" sizset="70"><TABLE class="Man_Conter az" border=0 cellSpacing=0 cellPadding=0 sizcache="0" sizset="70"  width="25%" style="margin:0px 9px;margin-top:5px;top:1px;">
        <TBODY>
          <TR class=Conter_top>
            <TD width="16%">號</TD>
            <TD width="28%" colSpan=<?php echo $_SESSION["loginId"]==89?3:1;?>>賠率</TD>
            <TD>註額</TD>
            <TD>虧盈</TD>
          </TR>
          <TR class=Conter_top1>
            <TH width="100%" colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>長牌</TH>
          </TR>
        <TBODY id=ct6 sizcache="0" sizset="70">
          <TR class=Conter_Report_List sizcache="0" sizset="70">
            <TD class="t_Edit_caption_1 st">12</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center width="2%"><IMG style="CURSOR: pointer" onclick="setOdds('eh1',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh1 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center width="2%"><IMG style="CURSOR: pointer" onclick="setOdds('eh1',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="70"><A id=aeh1 class=green2 title=查看註單明細 onclick="popWin('長牌','1,2');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_29"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="71"><A id=beh1 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="72">
            <TD class="t_Edit_caption_1 st">13</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh2',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh2 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh2',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="72"><A id=aeh2 class=green2 title=查看註單明細 onclick="popWin('長牌','1,3');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_30"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="73"><A id=beh2 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="74">
            <TD class="t_Edit_caption_1 st">14</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh3',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh3 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh3',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="74"><A id=aeh3 class=green2 title=查看註單明細 onclick="popWin('長牌','1,4);return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_31"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="75"><A id=beh3 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="76">
            <TD class="t_Edit_caption_1 st">15</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh4',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh4 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh4',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="76"><A id=aeh4 class=green2 title=查看註單明細 onclick="popWin('長牌','1,5');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_32"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="77"><A id=beh4 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="78">
            <TD class="t_Edit_caption_1 st">16</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh5',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh5 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh5',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="78"><A id=aeh5 class=green2 title=查看註單明細 onclick="popWin('長牌','1,6');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_33"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="79"><A id=beh5 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="80">
            <TD class="t_Edit_caption_1 st">23</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh6',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh6 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh6',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="80"><A id=aeh6 class=green2 title=查看註單明細 onclick="popWin('長牌','2,3');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_34"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="81"><A id=beh6 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="82">
            <TD class="t_Edit_caption_1 st">24</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh7',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh7 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh7',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="82"><A id=aeh7 class=green2 title=查看註單明細 onclick="popWin('長牌','2,4');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_35"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="83"><A id=beh7 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="84">
            <TD class="t_Edit_caption_1 st">25</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh8',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh8 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh8',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="84"><A id=aeh8 class=green2 title=查看註單明細 onclick="popWin('長牌','2,5');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_36"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="85"><A id=beh8 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="86">
            <TD class="t_Edit_caption_1 st">26</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh9',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh9 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh9',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="86"><A id=aeh9 class=green2 title=查看註單明細 onclick="popWin('長牌','2,6');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_37"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="87"><A id=beh9 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="88">
            <TD class="t_Edit_caption_1 st">34</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh10',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh10 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh10',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="88"><A id=aeh10 class=green2 title=查看註單明細 onclick="popWin('長牌','3,4');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_38"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="89"><A id=beh10 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="90">
            <TD class="t_Edit_caption_1 st">35</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh11',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh11 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh11',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="90"><A id=aeh11 class=green2 title=查看註單明細 onclick="popWin('長牌','3,5');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_39"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="91"><A id=beh11 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="92">
            <TD class="t_Edit_caption_1 st">36</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh12',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh12 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh12',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="92"><A id=aeh12 class=green2 title=查看註單明細 onclick="popWin('長牌','3,6');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_40"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="93"><A id=beh12 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="94">
            <TD class="t_Edit_caption_1 st">45</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh13',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh13 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh13',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="94"><A id=aeh13 class=green2 title=查看註單明細 onclick="popWin('長牌','4,5');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_41"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="95"><A id=beh13 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="96">
            <TD class="t_Edit_caption_1 st">46</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh14',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh14 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh14',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="96"><A id=aeh14 class=green2 title=查看註單明細 onclick="popWin('長牌','4,6');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_42"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="97"><A id=beh14 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="98">
            <TD class="t_Edit_caption_1 st">56</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh15',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=eh15 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('eh15',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="98"><A id=aeh15 class=green2 title=查看註單明細 onclick="popWin('長牌','5,6');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_43"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="99"><A id=beh15 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List>
            <TD colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>退水后總注額：<B id=_ec class=st>0</B></TD>
          </TR>
        </TBODY>
        <TBODY>
          <TR class=Conter_top1>
            <TH width="100%" colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>短牌</TH>
          </TR>
        <TBODY id=ct7 sizcache="0" sizset="100">
          <TR class=Conter_Report_List sizcache="0" sizset="100">
            <TD class="t_Edit_caption_1 st">11</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('fh1',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=fh1 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('fh1',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="100"><A id=afh1 class=green2 title=查看註單明細 onclick="popWin('短牌','1');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_44"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="101"><A id=bfh1 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="102">
            <TD class="t_Edit_caption_1 st">22</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('fh2',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=fh2 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('fh2',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="102"><A id=afh2 class=green2 title=查看註單明細 onclick="popWin('短牌','2');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_45"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="103"><A id=bfh2 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="104">
            <TD class="t_Edit_caption_1 st">33</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('fh3',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=fh3 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('fh3',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="104"><A id=afh3 class=green2 title=查看註單明細 onclick="popWin('短牌','3');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_46"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="105"><A id=bfh3 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="106">
            <TD class="t_Edit_caption_1 st">44</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('fh4',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=fh4 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('fh4',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="106"><A id=afh4 class=green2 title=查看註單明細 onclick="popWin('短牌','4');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_47"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="107"><A id=bfh4 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="108">
            <TD class="t_Edit_caption_1 st">55</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('fh5',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=fh5 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('fh5',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="108"><A id=afh5 class=green2 title=查看註單明細 onclick="popWin('短牌','5');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_48"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="109"><A id=bfh5 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List sizcache="0" sizset="110">
            <TD class="t_Edit_caption_1 st">66</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('fh6',1)" alt=升賠 src="images/m_Add.gif" width=19 height=20></TD>
            <?php }?>
            <TD id=fh6 class="t_Edit_caption_3 ct1" onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')">-</TD>
            <?php if($_SESSION["loginId"]==89){?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" align=center><IMG style="CURSOR: pointer" onclick="setOdds('fh6',0)" alt=降賠 src="images/m_Minus.gif" width=19 height=20></TD>
            <?php }?>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="110"><A id=afh6 class=green2 title=查看註單明細 onclick="popWin('短牌','6');return false" href="javascript:void(0)">-</A>&nbsp;<B class="red2 S_0_49"></B></TD>
            <TD class=ct1 onmouseover="showMouse(this,'ct1')" onmouseout="closeMouse(this,'ct1')" sizcache="0" sizset="111"><A id=bfh6 class=red3 title=補貨  href="javascript:void(0)">-</A></TD>
          </TR>
          <TR class=Conter_Report_List>
            <TD colSpan=<?php echo $_SESSION["loginId"]==89?6:4;?>>混骰盈利：<B id=_fc class=st>0</B></TD>
          </TR>
        </TBODY>
      </table></td>
      <TD vAlign=top width="6%" sizcache="0" sizset="0">
    
    <TABLE class="Man_Conter az" border=0 cellSpacing=0 cellPadding=0 sizcache="0" sizset="0" style="margin:0px 6px;margin-top:5px;top:1px;">
      <DIV id=LSL_Http></DIV>
        <DIV style="POSITION: absolute; DISPLAY: block; TOP: 11px; LEFT: 713px;"
	id=RR_DIV>
      
      <TABLE class=t_list border=1 cellSpacing=0 cellPadding=0 width=175 style="margin-left: 12px;">
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
				if ($v["g_ball_1"]==$v["g_ball_2"] && $v["g_ball_1"]==$v["g_ball_3"]){echo "<font color='green'>通吃</font>";}else{$a=$v["g_ball_1"]+$v["g_ball_2"]+$v["g_ball_3"]; echo $a<11?"小":"<font color='red'>大</font>";}?></TD>
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
      </table>
        </td>
      
        </TR>
      
        </TBODY>
      
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
				id=_value class="inp2 bct" onfocus="this.className='inp2m bct'"
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
				onmouseout="this.className='input2 bct'" value="還原賠率" onclick="initializes()" /></TD>
      <TD class=Main_bottom_right></TD>
    </TR>
      </TBODY>
    
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
	window.open('/Admin/temp/CrystalIsNot.php?cid=7&ty=7&tid='+pid+'&pid='+cid,'newwindow');	
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