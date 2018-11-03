<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'user/offGamexyft.php';
include_once ROOT_PATH.'functioned/cheCookie.php';
if ($user[0]['g_look'] == 2) exit(href('repore.php'));
$ConfigModel = configModel("`g_xyft_game_lock`, `g_mix_money`");
if ($ConfigModel['g_xyft_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';

//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode(',', $result[0]['g_panlus']); 
$_SESSION['gx'] = false;
$_SESSION['gd'] = false;
$_SESSION['xyft'] = true;
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

markPos("前台-极速赛车下注-双面");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/odds_sm_xyft.js"></script>
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
<body style="margin-left:3px;" onselectstart="return false">
<table class="th" border="0" cellpadding="0" cellspacing="0" style="margin-top:8px;top:10px;">
	<tr>
    	<td width="142" height="28" class="bolds">极速赛车　</td>
        <td colspan="2" class="bolds" style="color:red">
                     <td colspan="2" class="bolds" style="color:red"> <div  id="row1" style="position: relative;  FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">
<span>今天輸贏：</span>&nbsp;</div><div><span id="sy"  class="shuyingjieguo2">0.0</span></div></td>
        <td align="right">&nbsp;</td>
  <td class="bolds" width="138">
        	<span id="number" style="font-size:12px;position:relative; top:1px"></span>期賽果        </td>
        <td width="24" class="No_" id="a"></td>
        <td width="24" class="No_" id="b"></td>
        <td width="24" class="No_" id="c"></td>
        <td width="24" class="No_" id="d"></td>
        <td width="24" class="No_" id="e"></td>
        <td width="24" class="No_" id="f"></td>
        <td width="24" class="No_" id="g"></td>
        <td width="24" class="No_" id="h"></td>
		<td width="24" class="No_" id="j"></td>
        <td width="24" class="No_" id="k"></td>
    </tr>
</table>
<table class="th" border="0" cellpadding="0" cellspacing="0" style="margin-top:-5px;">
    <tr>
    	<td height="30" width="80px" ><span id="o" style=" color:#009900; font-weight:bold; font-size:12px;position:relative; top:1px"></span>期</td>
        <td width="160"><span style="color:#0033FF; font-weight:bold" id="tys">兩面盤</span></td>
        <td colspan="2"><form id="form1" name="form1" method="post" action="">
          <label><span style="color:#0033FF; font-weight:bold" id="tys">
			<script>
			function changepan(sel){
			window.parent.frames.mainFrame.location.href = "sGame_pk.php?g=<?php echo $g?>&abc="+sel.value;
			}
			
			</script>
           
           </label>
        </form></td>
       <td>&nbsp;&nbsp;&nbsp;&nbsp;距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="6">距離開獎：<span style="color:red;font-size:104%" id="endTimes">加載中...</span></td>
        <td colspan="2" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<form id="dp" action="" method="post" target="leftFrame" onsubmit = "return submitforms()">
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="4" />
<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money']?>" />
<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="3">冠軍</td>
		<td colspan="3">亞軍</td>
		<td colspan="3">第三名</td>
		<td colspan="3">第四名</td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="ah11"></td>
    	<td  class="tt" id="t1_h11"></td>
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="bh11"></td>
    	  <td class="tt" id="t2_h11"></td>
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="ch11"></td>
    	  <td  class="tt" id="t3_h11"></td>
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="dh11"></td>
    	  <td class="tt" id="t4_h11"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="ah12"></td>
    	  <td class="tt" id="t1_h12"></td>
    	<td width="58" class="caption_1">小</td>
    	<td class="o" width="57" id="bh12"></td>
    	  <td class="tt" id="t2_h12"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="ch12"></td>
    	  <td class="tt" id="t3_h12"></td>
    	<td width="60" class="caption_1">小</td>
    	<td class="o" width="57" id="dh12"></td>
    	  <td class="tt" id="t4_h12"></td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="ah13"></td>
    	  <td class="tt" id="t1_h13"></td>
    	<td width="58" class="caption_1">單</td>
    	<td class="o" width="57" id="bh13"></td>
    	  <td class="tt" id="t2_h13"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="ch13"></td>
    	  <td class="tt" id="t3_h13"></td>
    	<td width="60" class="caption_1">單</td>
    	<td class="o" width="57" id="dh13"></td>
    	  <td class="tt" id="t4_h13"></td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="ah14"></td>
    	  <td class="tt" id="t1_h14"></td>
    	<td width="58" class="caption_1">雙</td>
    	<td class="o" width="57" id="bh14"></td>
    	  <td class="tt" id="t2_h14"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="ch14"></td>
    	  <td class="tt" id="t3_h14"></td>
    	<td width="60" class="caption_1">雙</td>
    	<td class="o" width="57" id="dh14"></td>
    	  <td class="tt" id="t4_h14"></td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">龍</td>
    	<td class="o" width="57" id="ah15"></td>
    	  <td class="tt" id="t1_h15"></td>
		<td width="58" class="caption_1">龍</td>
    	<td class="o" width="57" id="bh15"></td>
    	  <td class="tt" id="t2_h15"></td>
		<td width="57" class="caption_1">龍</td>
    	<td class="o" width="57" id="ch15"></td>
    	  <td class="tt" id="t3_h15"></td>
		<td width="60" class="caption_1">龍</td>
    	<td class="o" width="57" id="dh15"></td>
    	  <td class="tt" id="t4_h15"></td>
   	</tr>
	<tr class="t_td_text">
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="57" id="ah16"></td>
    	  <td class="tt" id="t1_h16"></td>
    	<td width="58" class="caption_1">虎</td>
    	<td class="o" width="57" id="bh16"></td>
    	  <td class="tt" id="t2_h16"></td>
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="57" id="ch16"></td>
    	  <td class="tt" id="t3_h16"></td>
    	<td width="60" class="caption_1">虎</td>
    	<td class="o" width="57" id="dh16"></td>
    	  <td class="tt" id="t4_h16"></td>
    </tr>

	<tr class="t_list_caption" style="color:#000">
    	<td colspan="3">第五名</td>
		<td colspan="3">第六名</td>
		<td colspan="3">第七名</td>
		<td colspan="3">第八名</td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="57" id="eh11"></td>
    	  <td class="tt" id="t5_h11"></td>
    	<td width="58" class="caption_1">大</td>
    	<td class="o" width="57" id="fh11"></td>
    	<td class="tt" id="t6_h11"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="57" id="gh11"></td>
    	<td class="tt" id="t7_h11"></td>
    	<td width="60" class="caption_1">大</td>
    	<td class="o" width="57" id="hh11"></td>
    	<td class="tt" id="t8_h11"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="eh12"></td>
    	<td class="tt" id="t5_h12"></td>
    	<td width="58" class="caption_1">小</td>
    	<td class="o" width="57" id="fh12"></td>
    	<td class="tt" id="t6_h12"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="gh12"></td>
    	<td class="tt" id="t7_h12"></td>
    	<td width="60" class="caption_1">小</td>
    	<td class="o" width="57" id="hh12"></td>
    	<td class="tt" id="t8_h12"></td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="eh13"></td>
    	<td class="tt" id="t5_h13"></td>
    	<td width="58" class="caption_1">單</td>
    	<td class="o" width="57" id="fh13"></td>
    	<td class="tt" id="t6_h13"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="gh13"></td>
    	<td class="tt" id="t7_h13"></td>
    	<td width="60" class="caption_1">單</td>
    	<td class="o" width="57" id="hh13"></td>
    	<td class="tt" id="t8_h13"></td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="eh14"></td>
    	<td class="tt" id="t5_h14"></td>
    	<td width="58" class="caption_1">雙</td>
    	<td class="o" width="57" id="fh14"></td>
    	<td class="tt" id="t6_h14"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="gh14"></td>
    	<td class="tt" id="t7_h14"></td>
    	<td width="60" class="caption_1">雙</td>
    	<td class="o" width="57" id="hh14"></td>
    	<td class="tt" id="t8_h14"></td>
    </tr>
	<tr class="t_td_text">
    	<td width="57" class="caption_1">龍</td>
    	<td class="o" width="57" id="eh15"></td>
    	<td class="tt" id="t5_h15"></td>
    	<td colspan="3" class="t_list_caption" style="color:#000">第九名</td>
    	<td colspan="3" class="t_list_caption" style="color:#000">第十名</td>
    	<td colspan="3" class="t_list_caption" style="color:#000">冠、亞軍和</td>
	</tr>
	<tr class="t_td_text">
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="57" id="eh16"></td>
    	<td class="tt" id="t5_h16"></td>
    	<td width="58" class="caption_1">大</td>
    	<td class="o" width="57" id="ih11"></td>
    	<td class="tt" id="t9_h11"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="57" id="jh11"></td>
    	<td class="tt" id="t10_h11"></td>
    	<td width="60" class="caption_1">冠亞大</td>
    	<td class="o" width="57" id="kh1"></td>
    	<td class="tt" id="t12_h1"></td>
   	</tr>
	<tr class="t_td_text">    
    	<td colspan="3">&nbsp;</td>
    	<td width="58" class="caption_1">小</td>
    	<td class="o" id="ih12"></td>
    	<td class="tt" id="t9_h12"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="jh12"></td>
    	<td class="tt" id="t10_h12"></td>
    	<td width="60" class="caption_1">冠亞小</td>
    	<td class="o" width="57" id="kh2"></td>
    	<td class="tt" id="t12_h2"></td>
	</tr>
   <tr class="t_td_text">
    	<td colspan="3">&nbsp;</td>
    	<td width="58" class="caption_1">單</td>
    	<td class="o" width="57" id="ih13"></td>
    	<td class="tt" id="t9_h13"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="jh13"></td>
    	<td class="tt" id="t10_h13"></td>
    	<td width="60" class="caption_1">冠亞單</td>
    	<td class="o" width="57" id="kh3"></td>
    	<td class="tt" id="t12_h3"></td>
   	</tr>
    <tr class="t_td_text">
    	<td colspan="3">&nbsp;</td>
    	<td width="58" class="caption_1">雙</td>
    	<td class="o" width="57" id="ih14"></td>
    	<td class="tt" id="t9_h14"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="jh14"></td>
    	<td class="tt" id="t10_h14"></td>
    	<td width="60" class="caption_1">冠亞雙</td>
    	<td class="o" width="57" id="kh4"></td>
    	<td class="tt" id="t12_h4"></td>
   	</tr>
  </table>
<table border="0" width="700" style="margin-top:5px;top:10px;">
	<tr height="30">
    	<td align="center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    	<input onclick="Shortcut_SH(false);" id="Shortcut_Switch" name="Shortcut_Switch" value="" type="checkbox"/>
	    	<a class="font_g F_bold" onfocus="this.blur()" title="快捷下註" onclick="Shortcut_SH(true);" href="javascript:void(0)" style="color:#299a26;text-decoration:none; font-weight:bold;">快捷下注</a>
	    	<span id="Shortcut_DIV" class="font_g"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="Shortcut_hidden();reset();" class="inputs ti" value="重&nbsp;填" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="submits" class="inputs ti" value="下&nbsp;註" /><input type="text" id="submitss"  value="" style="width:0px;height:0px;border:0px;"/></td>
	        <td width="0" class="actiionn"></td>
    </tr>
</table>
</form>
  <table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption"><!-- <a class="nv_a" -->
     	<td class="td_caption_2"><a class="nv" <?php echo $onclick?>>冠、亞軍和</a></td>
        <td><a class="nv" <?php echo $onclick?>>冠、亞軍和 大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>冠、亞軍和 單雙</a></td>
    </tr>
    <tr>
    	<td colspan="4" class="t_td_text" align="center">
        	<table class="hj" border="0" cellpadding="0" cellspacing="1">
            	<tr class="t_td_text" id="z_cl"><td></td></tr>
            </table>
        </td>
    </tr>
</table>
<div id="look" ></div>
<?php include_once 'inc/cl_file.php';?>
<?php 
$db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$user[0]['g_name']}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>