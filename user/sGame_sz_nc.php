﻿<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'user/offGamenc.php';
include_once ROOT_PATH.'functioned/cheCookie.php';
$ConfigModel = configModel("`g_nc_game_lock`, `g_mix_money`");
if ($ConfigModel['g_nc_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';


//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 
$_SESSION['gx'] = false;
$_SESSION['pk'] = false;
$_SESSION['nc'] = true;
$_SESSION['cq'] = false;
$_SESSION['sz'] = false;
$_SESSION['kl8'] = false;
$g = $_GET['g'];
$abc = $_GET['abc'];
if($abc==null) {$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}

markPos("前台-农场下注");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/odds_sz_nc.js"></script>
<script type="text/javascript" src="./js/plxz.js"></script>
<title></title>
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
<style type="text/css">
div#row1 { float: left;  }
div#row2 { }
</style>
</head>
<body onselectstart="return false">
<table class="thsz" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<tr>
    	<td width="110" height="20" class="bolds">幸运农场</td>
        <td width="157" colspan="2" class="bolds" style="color:red">
        	 <div  id="row1" style="position: relative;  FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">
<span>今天輸贏：</span>&nbsp;</div><div><span id="sy"  class="shuyingjieguo2"  top:"-2px">0.0</span></div></td>
        <td class="bolds" style="color:red" align="right">&nbsp;</td>
  <td class="bolds" width="132">
        	<span id="number" style="position:relative;"></span>期開獎   </td>
        <td width="27" class="l" id="a"></td>
        <td width="27" class="l" id="b"></td>
        <td width="27" class="l" id="c"></td>
        <td width="27" class="l" id="d"></td>
        <td width="27" class="l" id="e"></td>
        <td width="27" class="l" id="f"></td>
        <td width="27" class="l" id="g"></td>
        <td width="27" class="l" id="h"></td>
    </tr>
</table>
<table class="thsz" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px;">
    <tr>
    	<td height="30" width="122px"><span id="o" style=" color:#009900; font-weight:bold; position:relative; "></span>期</td>
        <td><span style="color:#0033FF; font-weight:bold" id="tys">單球1~8</span></td>
        <td><form id="form1" name="form1" method="post" action="">
            <label><span style="color:#0033FF; font-weight:bold" id="tys">
			<script>
			function changepan(sel){
			window.parent.frames.mainFrame.location.href = "sGame_sz_nc.php?g=<?php echo $g?>&abc="+sel.value;
			}
			
			</script></span>
           </label>
      </form></td>
       <td width="85"></td>
        <td>距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="6">距離開獎：<span style="color:red;font-size:104%" id="endTimes">加載中...</span></td>
        <td colspan="2" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<form id="dp" action="" method="post" target="leftFrame" onsubmit = "return submitforms()">
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="9" />
<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money']?>" />
<table class="wqsz" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="3">第一球</td>
    	<td colspan="2">第二球</td>
    	<td colspan="2">第三球</td>
    	<td colspan="2">第四球</td>
		<td colspan="2">第五球</td>
    	<td colspan="2">第六球</td>
    	<td colspan="2">第七球</td>
    	<td colspan="2">第八球</td>
    </tr>
	
<tr class="t_list_caption" style="color:#000">
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>賠率</td>
    	<td>金額</td>		
</tr>
	
    <tr class="t_td_text">
    	<td  class="No_gd1"></td>
    	<td class="o" width="45" id="ah1"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh1"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch1"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh1"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh1"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh1"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh1"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh1"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td  class="No_gd2"></td>
    	<td class="o" width="45" id="ah2"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh2"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch2"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh2"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh2"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh2"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh2"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh2"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd3"></td>
    	<td class="o" width="45" id="ah3"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh3"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch3"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh3"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh3"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh3"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh3"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh3"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd4"></td>
    	<td class="o" width="45" id="ah4"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh4"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch4"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh4"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh4"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh4"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh4"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh4"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td  class="No_gd5"></td>
    	<td class="o" width="45" id="ah5"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh5"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch5"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh5"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh5"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh5"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh5"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh5"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd6"></td>
    	<td class="o" width="45" id="ah6"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh6"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch6"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh6"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh6"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh6"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh6"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh6"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd7"></td>
    	<td class="o" width="45" id="ah7"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh7"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch7"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh7"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh7"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh7"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh7"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh7"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td  class="No_gd8"></td>
    	<td class="o" width="45" id="ah8"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh8"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch8"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh8"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh8"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh8"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh8"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh8"></td>
    	<td class="loads"></td>
    </tr>
	 <tr class="t_td_text">
    	<td  class="No_gd9"></td>
    	<td class="o" width="45" id="ah9"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh9"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch9"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh9"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh9"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh9"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh9"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh9"></td>
    	<td class="loads"></td>
    </tr>
	 <tr class="t_td_text">
    	<td  class="No_gd10"></td>
    	<td class="o" width="45" id="ah10"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh10"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch10"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh10"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh10"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh10"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh10"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh10"></td>
    	<td class="loads"></td>
    </tr>
	 <tr class="t_td_text">
    	<td  class="No_gd11"></td>
    	<td class="o" width="45" id="ah11"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh11"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch11"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh11"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh11"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh11"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh11"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh11"></td>
    	<td class="loads"></td>
    </tr>
	 <tr class="t_td_text">
    	<td  class="No_gd12"></td>
    	<td class="o" width="45" id="ah12"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh12"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch12"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh12"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh12"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh12"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh12"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh12"></td>
    	<td class="loads"></td>
    </tr>
	 <tr class="t_td_text">
    	<td  class="No_gd13"></td>
    	<td class="o" width="45" id="ah13"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh13"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch13"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh13"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh13"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh13"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh13"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh13"></td>
    	<td class="loads"></td>
    </tr>
	 <tr class="t_td_text">
    	<td  class="No_gd14"></td>
    	<td class="o" width="45" id="ah14"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh14"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch14"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh14"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh14"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh14"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh14"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh14"></td>
    	<td class="loads"></td>
    </tr>
	 <tr class="t_td_text">
    	<td  class="No_gd15"></td>
    	<td class="o" width="45" id="ah15"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh15"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch15"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh15"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh15"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh15"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh15"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh15"></td>
    	<td class="loads"></td>
    </tr>
	 <tr class="t_td_text">
    	<td  class="No_gd16"></td>
    	<td class="o" width="45" id="ah16"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh16"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch16"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh16"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh16"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh16"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh16"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh16"></td>
    	<td class="loads"></td>
    </tr>
	 <tr class="t_td_text">
    	<td  class="No_gd17"></td>
    	<td class="o" width="45" id="ah17"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh17"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch17"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh17"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh17"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh17"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh17"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh17"></td>
    	<td class="loads"></td>
    </tr>
	 <tr class="t_td_text">
    	<td  class="No_gd18"></td>
    	<td class="o" width="45" id="ah18"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh18"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch18"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh18"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh18"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh18"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh18"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh18"></td>
    	<td class="loads"></td>
    </tr> 
	<tr class="t_td_text">
    	<td  class="No_gd19"></td>
    	<td class="o" width="45" id="ah19"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh19"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch19"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh19"></td>
    	<td class="loads"></td>
		<td class="o" width="45" id="eh19"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh19"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh19"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh19"></td>
    	<td class="loads"></td>
    </tr> 
	<tr class="t_td_text">
    	<td  class="No_gd20"></td>
    	<td class="o" width="45" id="ah20"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="bh20"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="ch20"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="dh20"></td>
    	<td class="loads"></td>
   		<td class="o" width="45" id="eh20"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="fh20"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="gh20"></td>
    	<td class="loads"></td>
    	<td class="o" width="45" id="hh20"></td>
    	<td class="loads"></td>
	</tr>
</table>
<table border="0" width="800">
	<tr height="30">
	    	<td align="center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    	<input onclick="Shortcut_SH(false);" id="Shortcut_Switch" name="Shortcut_Switch" value="" type="checkbox"/>
	    	<a class="font_g F_bold" onfocus="this.blur()" title="快捷下註" onclick="Shortcut_SH(true);" href="javascript:void(0)" style="color:#299a26;text-decoration:none; font-weight:bold;">快捷下注</a>
	    	<span id="Shortcut_DIV" class="font_g"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="Shortcut_hidden();reset();" class="inputs ti" value="重&nbsp;填" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="submits" class="inputs ti" style="font-weight: bold;" value="下&nbsp;註" /><input type="text" id="submitss"  value="" style="width:0px;height:0px;border:0px;"/></td>
	        <td width="0" class="actiionn"></td>
    </tr>
</table>
</form>
<br />
<div id="look" ></div>
<?php include_once 'inc/cl_filesz.php';?>
<?php 
$db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$user[0]['g_name']}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>