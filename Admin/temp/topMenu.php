<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'functioned/peizhi.php';
global $Users, $LoginId;

$news = null;
$db=new DB();
$text = $db->query("SELECT g_text FROM g_news WHERE g_rank_show = 1 ORDER BY g_id DESC LIMIT 1 ", 0);
if ($text){
	$news = strip_tags($text[0][0]);
}
$name = isset($Users[0]['g_lock_1']) ? $Users[0]['g_s_name'] : $Users[0]['g_name'];

if ($LoginId== 89){
$resulth = $db->query("SELECT g_zhud,g_cj,g_gg FROM j_manage where g_name='{$name}'  ORDER BY g_id DESC LIMIT 1 ", 0);
} 
$countuser=$db->query("SELECT g_name,g_count_time,g_out,g_ip,g_mumber_type FROM g_user  where g_out=1  ",3);
$countAll = $db->query("SELECT g_nid FROM g_user",3);



//$name=$_COOKIE['dlName'];
//$g_mg=$db->query("select g_login_id from g_rank where g_name='$name'",0);
//echo $g_mg[0]['g_login_id'];

//if($g_mg[0][0])


//$g_mg=$db->query("select g_id from j_manage where g_name='$name'",0);
//$g_rn=$db->query("select g_nid,g_f_name from g_rank where g_name='$name'",0);
//$g_us=$db->query("select g_f_name from g_user where g_name='$name'",0);


//$usif=$db->query("select g_id,g_f_name from g_rank where g_name='$name'",0); 
//$qx=strlen(strip_tags($usif[0][0]));//权限长度
//$nm=strip_tags($usif[0][1]);//管理员名


echo "<script>var LoginId=".$LoginId."</script>";


if ($LoginId== 89){$us_tp="总监";};
if ($LoginId== 56){$us_tp="分公司";};
if ($LoginId== 22){$us_tp="股东";};
if ($LoginId== 78){$us_tp="总代理";};
if ($LoginId== 48){$us_tp="代理";};





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>头部</title>
    <link href="Styles/css.css" rel="stylesheet" type="text/css" />
    <link href="Styles/header.css" rel="stylesheet" type="text/css" />
    <link href="Styles/m.old.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
html, body {
	margin: 0px;
}
</style>
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script src="js/Forbid.js" type="text/javascript"></script>
    <script src="js/TopMenu_2.js" type="text/javascript"></script>
    <script language="javascript" src="js/m.old-header.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../js/Topjavascript.js"></script>
    <script language="javascript" type="text/javascript">
	


//navListBox
var g_index=1; //当前选择的项目
var Link=new Array(10)
var Link2=Array();
//广东快乐十分
Link[1]="<a onclick='oddsFile_1()' href='javascript:void(0)'>第一球</a>|<a onclick='oddsFile_2()' href='javascript:void(0)'>第二球</a>&nbsp;|<a onclick='oddsFile_3()' href='javascript:void(0)'>第三球</a>&nbsp;|<a onclick='oddsFile_4()' href='javascript:void(0)'>第四球</a>&nbsp;|<a onclick='oddsFile_5()' href='javascript:void(0)'>第五球</a>&nbsp;|<a onclick='oddsFile_6()' href='javascript:void(0)'>第六球</a>&nbsp;|<a onclick='oddsFile_7()' href='javascript:void(0)'>第七球</a>&nbsp;|<a onclick='oddsFile_8()' href='javascript:void(0)'>第八球</a>&nbsp;|<a onclick='oddsFile_LH()' href='javascript:void(0)'>總和、龍虎</a>&nbsp;|<a onclick='oddsFile_LM()' href='javascript:void(0)'>連碼</a>";


//重庆时时彩
Link[2]="<a onclick='oddsFilecq()' href='javascript:void(0)'>總項盤口</a>";

//北京赛车 

Link[6]="<a onclick='oddsFilepk_1()' href='javascript:void(0)'>冠、亞軍 組合</a>&nbsp;|<a onclick='oddsFilepk_2()' href='javascript:void(0)'>三、四、伍、六名</a>&nbsp;|<a onclick='oddsFilepk_3()' href='javascript:void(0)'>七、八、九、十名</a>";

//鱼虾蟹 4

//快3
Link[7]="<a onclick='saizi()' href='javascript:void(0)'>總項盤口</a>"


// 快乐8
Link[8]="<a onclick='kl8_gg()' href='javascript:void(0)'>總項盤口</a>&nbsp;|<a onclick='kl8_zm()' href='javascript:void(0)'>正碼</a>"

//极速时时彩
Link[3]="<a onclick=\"oddsFiles('oddsFilejxssc')\" href='javascript:void(0)'>總項盤口</a>";

//极速赛车
Link[4]="<a onclick='oddsFilexyft(1)' href='javascript:void(0)'>冠、亞軍 組合</a>&nbsp;|<a onclick='oddsFilexyft(2)' href='javascript:void(0)'>三、四、伍、六名</a>&nbsp;|<a onclick='oddsFilexyft(3)' href='javascript:void(0)'>七、八、九、十名</a>";
//幸运农场
Link[9]="<a onclick='oddsFilenc(1)' href='javascript:void(0)'>第一球</a>|<a onclick='oddsFilenc(2)' href='javascript:void(0)'>第二球</a>&nbsp;|<a onclick='oddsFilenc(3)' href='javascript:void(0)'>第三球</a>&nbsp;|<a onclick='oddsFilenc(4)' href='javascript:void(0)'>第四球</a>&nbsp;|<a onclick='oddsFilenc(5)' href='javascript:void(0)'>第五球</a>&nbsp;|<a onclick='oddsFilenc(6)' href='javascript:void(0)'>第六球</a>&nbsp;|<a onclick='oddsFilenc(7)' href='javascript:void(0)'>第七球</a>&nbsp;|<a onclick='oddsFilenc(8)' href='javascript:void(0)'>第八球</a>&nbsp;|<a onclick='oddsFile_LH_nc(9)' href='javascript:void(0)'>總和、龍虎</a>&nbsp;|<a onclick='oddsFile_LM_nc(10)' href='javascript:void(0)'>連碼</a>";
//新疆时时彩
Link[10]="<a onclick=\"oddsFiles('oddsFilexjssc')\" href='javascript:void(0)'>總項盤口</a>";
//天津时时彩
Link[11]="<a onclick=\"oddsFiles('oddsFiletjssc')\" href='javascript:void(0)'>總項盤口</a>";

//用户管理
Link2[7]=
	<?php if ($LoginId==89){?>'<a href="javascript:void(0)" onclick="Actfor_1()">分公司</a>|'+<?php }?>
    <?php if ($LoginId==89||$LoginId==56){?>'<a href="javascript:void(0)" onclick="Actfor_2()">股東</a>|'+<?php }?>
    <?php if ($LoginId==89||$LoginId==56||$LoginId==22){?>'<a href="javascript:void(0)" onclick="Actfor_3()">總代理</a>|'+<?php }?>
    <?php if ($LoginId==89||$LoginId==56||$LoginId==22||$LoginId==78){?>'<a href="javascript:void(0)" onclick="Actfor_4()">代理</a>|'+<?php }?>
	
'<a href="javascript:void(0)" onclick="Actfor_5()">會員</a>|'+
<?php if (!isset($Users[0]['g_lock_6'])){?>'<a href="javascript:void(0)" onclick="AccountSon_List()">子帳號</a>|'+
<?php }else if (isset($Users[0]['g_lock_6']) && $Users[0]['g_lock_6'] ==1){?>
'<a href="javascript:void(0)" onclick="AccountSon_List()">子帳號</a>|'+
<?php }?> <?php    if($resulth[0][1]==1){?> '<a href="javascript:void(0)" onclick="StudIo()">管理员</a>'+<?php }?>'';



//个人管理
Link2[8] = 
    <?php if (($LoginId==22||$LoginId==78||$LoginId==48) && !isset($Users[0]['g_lock_2'])) {?>
    '<a href="javascript:void(0)" onclick="CreditInfo()">信用資料</a>|'+
    <?php }?>
    '<a href="javascript:void(0)" onclick="LoginLog()">登陸日誌</a>|'+
'<a href="javascript:void(0)" onclick="UpdatePassword()">變更密碼</a>'
<?php  if ($LoginId!=89 && $LoginId!=56 && $Users[0]['g_Immediate_lock'] == 1 && !isset($Users[0]['g_lock_3'])){?>
+
'<a href="javascript:void(0)" onclick="AutoLet()">自動補貨設定</a>|'+
'<a href="javascript:void(0)" onclick="Amend_Log()">自動補貨變更記錄</a>';
    <?php } else if ($LoginId!=89 && $LoginId!=56 && isset($Users[0]['g_lock_3']) && $Users[0]['g_lock_3'] == 1) {?>
    +
'<a href="javascript:void(0)" onclick="AutoLet()">自動補貨設定</a>|'+
'<a href="javascript:void(0)" onclick="Amend_Log()">自動補貨變更記錄</a>';
    <?php echo ';';}?>

<?php if ($LoginId==89){?>
var target = "mainFrame";
Link2[9] =
   
 '<a href="javascript:void(0)" onclick="Manages()">系統設置</a>|'+

 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
 '<a href="javascript:void(0)" onclick="oddsInfo()">賠率設置</a>|'+
 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_2'] == 1){?>
 '<a hhref="javascript:void(0)" onclick="oddsInfo()">賠率設置</a>|'+
 <?php }?> 
 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
 '<a href="javascript:void(0)" onclick="OddsBC()">賠率差</a>|'+
 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_2'] == 1){?>
 '<a href="javascript:void(0)" onclick="OddsBC()">賠率差</a>|'+
 <?php }?>
 
 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
 '<a href="javascript:void(0)" onclick="NumbeInclude()">開獎設置</a>|'+
 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_5'] == 1){?>
 '<a href="javascript:void(0)" onclick="NumbeInclude()">開獎設置</a>|'+
 <?php }?>
	
	
  <?php    if($resulth[0][1]==1){?> 
 '<a href="javascript:void(0)" onclick="NumberInclude()">開盤設置</a>|'+
 <?php }?>
     '<a href="javascript:void(0)" onclick="mrp()">退水設置</a>|'+
                         <?php    if($resulth[0][2]==1){?>
 '<a href="javascript:void(0)" onclick="newsInfo()">公告管理</a>|'+
 <?php }?>
 <?php    if($resulth[0][1]==1){?>
 '<a href="DelC.php" target="'+target+'">清理數據</a><span style="float:left;">&#160;|</span>'+ 
 <?php }?>
 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
 '<a href="javascript:void(0)" onclick="CrystagInfo()">注單管理</a>|'+
 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_4'] == 1){?>
 '<a href="javascript:void(0)" onclick="CrystagInfo()">注單管理</a>|'+
 <?php }?>
  <?php if (!isset($Users[0]['g_lock_1_1'])){?>
 '<a href="javascript:void(0)" onclick="Formerly()">即時滾單</a>|'+
 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_5'] == 1){?>
 '<a href="javascript:void(0)" onclick="Formerly()">即時滾單</a>|'+
 <?php }?>
                     <?php    if($resulth[0][0]==1){?>  
 '<a href="javascript:void(0)" onclick="ReportInfoAll()">删改管理</a>|'+ 
 <?php }?>
  <?php if (!isset($Users[0]['g_lock_1_1'])&& $cz=="1"){?>
	 '<a href="chongti.php" target="'+target+'">充提管理</a>'+
	 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_4'] == 1 &&$cz=="1"){?>
	'<a href="chongti.php" target="'+target+'">充提管理</a>'+
	 <?php }?> '';
<?php }?>

//默认选择第一个
$("#currentType").html("廣東快樂十分");

function SubonCK(v){
	g_index=v;	
	if(v==1){
	$("#currentType").html("廣東快樂十分");
	}else if(v==2){
	$("#currentType").html("重慶時時彩");
	}else if(v==6){
	$("#currentType").html("北京赛车PK10");
	}else if(v==72){
	$("#currentType").html("吉林鱼虾蟹");
	}else if(v==7){
	$("#currentType").html("吉林快3");
	}else if(v==8){
	$("#currentType").html("快樂8");
	}else if(v==3){$("#currentType").html("极速时时彩");}
	else if(v==4){$("#currentType").html("极速赛车");}
	else if(v==9){$("#currentType").html("幸运农场");}
	else if(v==10){$("#currentType").html("新疆时时彩");}
	else if(v==11){$("#currentType").html("天津时时彩");}
	if(v==7 || v==72){
		$("#navListBox").html(Link[7]);//鱼虾蟹与快3
		return true;
	}
	$("#navListBox").html(Link[v]);
}
function SubonCK2(v){
	if(v<10){
		$("#navListBox").html(Link2[v]);
	};
		
		if(v==10){parent.frames.mainFrame.location.href="Report_Center.php";$("#navListBox").html("");};
		if(v==11){
			if($("#currentType").text()=='请选择')
			{parent.frames.mainFrame.location.href="Lottery_Result.php";$("#navListBox").html("");}
			if($("#currentType").text()=='廣東快樂十分')
			{parent.frames.mainFrame.location.href="Lottery_Result.php";$("#navListBox").html("");}
			if($("#currentType").text()=='重慶時時彩')
			{parent.frames.mainFrame.location.href="Lottery_Result.php?id=2";$("#navListBox").html("");}
			if($("#currentType").text()=='北京赛车PK10')
			{parent.frames.mainFrame.location.href="Lottery_Result.php?id=6";$("#navListBox").html("");}
			if($("#currentType").text()=='吉林鱼虾蟹')
			{parent.frames.mainFrame.location.href="Lottery_Result.php?id=72";$("#navListBox").html("");}
			if($("#currentType").text()=='吉林快3')
			{parent.frames.mainFrame.location.href="Lottery_Result.php?id=7";$("#navListBox").html("");}
			if($("#currentType").text()=='快樂8')
			{parent.frames.mainFrame.location.href="Lottery_Result.php?id=8";$("#navListBox").html("");}
			if($("#currentType").text()=='极速时时彩')
			{parent.frames.mainFrame.location.href="Lottery_Result.php?id=3";$("#navListBox").html("");}
			if($("#currentType").text()=='广东十一选五')
			{parent.frames.mainFrame.location.href="Lottery_Result.php?id=5";$("#navListBox").html("");}
			if($("#currentType").text()=='极速赛车')
			{parent.frames.mainFrame.location.href="Lottery_Result.php?id=4";$("#navListBox").html("");}
			if($("#currentType").text()=='幸运农场')
			{parent.frames.mainFrame.location.href="Lottery_Result.php?id=9";$("#navListBox").html("");}
			if($("#currentType").text()=='新疆时时彩')
			{parent.frames.mainFrame.location.href="Lottery_Result.php?id=10";$("#navListBox").html("");}
			if($("#currentType").text()=='天津时时彩')
			{parent.frames.mainFrame.location.href="Lottery_Result.php?id=11";$("#navListBox").html("");}
			}
			
		if(v==12){parent.frames.mainFrame.location.href="NewFile.php";$("#navListBox").html("");};
		if(v==13){parent.frames.mainFrame.location.href="OnLine.php";$("#navListBox").html("");};
		
		
		};
    </script>
    </head>

    <body onload="document.body.scrollTop=600;">
<div class="topBox">
      <table class="gridtable">
    <tr>
          <td rowspan="2" width="195" height="63" background="images/logo.jpg"><div class="logoBox"><?php echo $logo;?></div></td>
          <td height="22" valign="top"><div class="Righttop">
              <marquee onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 2, 0);" direction="left" scrolldelay="4" scrollamount="2" behavior="scroll">
            <a href="News.htm" target="content"><span id="Affiche"><?php echo $news?></span></a>
            </marquee>
            </div></td>
        </tr>
    <tr>
          <td height="41" valign="top"><div class="Rightbottom">
              <div class="left">
              <ul class="navOne-new">
                  <li id="bankLi" name="bankLi" class="czBtn"><span id="currentType">请选择</span></li>
                </ul>
              <div class="clear"></div>
            </div>
              <div class="right">
              <ul id="navBtnMenu">
                  <li id="li1" class="navBtn1" onclick="SubonCK(g_index);">即时注单</li>
                  <li id="li2" class="navBtn2" onclick="SubonCK2(7);">用戶管理</li>
                  <li id="li3" class="navBtn2" onclick="SubonCK2(8);">个人管理</li>
                  <?php if($LoginId==89){?>
                  <li id="li3" class="navBtn2" onclick="SubonCK2(9);">总监设置</li>
                  <li id="li3" class="navBtn2" onclick="SubonCK2(13);">在线统计</li>
                  <?php }?>
                  <li id="li5" class="navBtn2" onclick="SubonCK2(10);">报表查询</li>
                  <li id="li6" class="navBtn2" onclick="SubonCK2(11);">历史开奖</li>
                  <li id="li7" class="navBtn2" onclick="SubonCK2(12);">站内公告</li>
                  <li id="li8" class="navBtn3" onclick="top.location.href='Quit.php';">安全退出</li>
                </ul>
              <div class="clear"></div>
            </div>
              <div class="clear"></div>
            </div></td>
        </tr>
  </table>
      <div class="userBox"><?php echo $Users[0]['g_Lnid'][0].'：'.$name?></div><!--显示当前用户-->
      <div id="navListBox" class="navListBox">&nbsp;</div>
      <div class="clear"></div>
    </div>
<script>SubonCK(1);//默认打开第一个</script>
</body>
</html>
