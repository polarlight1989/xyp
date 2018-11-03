<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'user/offGame.php';
include_once ROOT_PATH.'functioned/cheCookie.php';
$ConfigModel = configModel("`g_kg_game_lock`, `g_mix_money`");
if ($user[0]['g_look'] == 2) exit(href('repore.php'));
if ($ConfigModel['g_kg_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';


//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 
$_SESSION['gx'] = false;
$_SESSION['pk'] = false;
$_SESSION['gd'] = true;
$_SESSION['cq'] = false;
$_SESSION['xj'] = false;
$_SESSION['jx'] = false;
$_SESSION['tj'] = false;
$_SESSION['sz'] = false;
$_SESSION['kl8'] = false;
$g = $_GET['g'];
$abc = $_GET['abc'];
if($abc==null) {$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}
markPos("前台-广东下注-双面");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="./js/odds_sm.js"></script>
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
<body style="margin-left: 3px;margin-top:-3px;" onselectstart="return false">
<table class="th" border="0" cellpadding="0" cellspacing="0">
	<tr>    	<td width="130" height="20" class="bolds">廣東快樂十分</td>
                     <td colspan="2" class="bolds" style="color:red"><div  id="row1" style="position: relative;  FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">
<span>今天輸贏：</span>&nbsp;</div><div><span id="sy"  class="shuyingjieguo2" top:-2px">0.0</span></div></td>
        <td align="right">&nbsp;</td>
      <td class="bolds" width="140" align="right">
        <span id="number" style="font-size:12px;position:relative; top:-1px; height: 25px;"></span>期開獎</td>
        <td width="23" class="l" id="a"></td>
        <td width="23" class="l" id="b"></td>
        <td width="23" class="l" id="c"></td>
        <td width="23" class="l" id="d"></td>
        <td width="23" class="l" id="e"></td>
        <td width="23" class="l" id="f"></td>
        <td width="8" class="l" id="g"></td>
        <td width="8" class="l" id="h"></td>
    </tr>
</table>
<table class="th" border="0" cellpadding="0" cellspacing="0" style="margin-top:-3px;">
    <tr>
    	<td height="30" width="115px"><span id="o" style=" color:#009900; font-weight:bold; position:relative;"></span>期</td>
        <td><span style="color:#0033FF; font-weight:bold" id="tys">兩面盤</span></td>
        <td ><form id="form1" name="form1" method="post" action="">
            <label><span style="color:#0033FF; font-weight:bold" id="tys">
			<script>
			function changepan(sel){
			document.form1.submit();
			}
			
			</script>
           </label>
		   <input type="hidden" value="<?php echo $g?>" name="gp"/>
		   <input type="hidden" value="sGame" name="gsrc"/>
      </form></td>
        <td width="85">&nbsp;</td>
        <td>距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="6">距離開獎：<span style="color:red; font-size:104%" id="endTimes">加載中...</span></td>
        <td colspan="2" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<form id="dp" action="" method="post" target="leftFrame" onsubmit = "return submitforms()">
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money']?>" />
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">總和、龍虎</td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="1">	
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">總和大</td>
    	<td class="o" width="8%" id="h1"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">總和單</td>
    	<td class="o" width="8%" id="h2"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">總和尾大</td>
    	<td class="o" width="8%" id="h5"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">龍</td>
    	<td class="o" width="8%" id="h6"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">總和小</td>
    	<td class="o" width="8%" id="h3"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">總和雙</td>
    	<td class="o" width="8%" id="h4"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">總和尾小</td>
    	<td class="o" width="8%" id="h7"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">虎</td>
    	<td class="o" width="8%" id="h8"></td>
    	<td class="loads"></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="3">第一球</td>
    	<td colspan="3">第二球</td>
    	<td colspan="3">第三球</td>
    	<td colspan="3">第四球</td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="ah21"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="bh21"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="ch21"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="dh21"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="ah22"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="bh22"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="ch22"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="dh22"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">單</td>
    	<td class="o" width="8%" id="ah23"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">單</td>
    	<td class="o" width="8%" id="bh23"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">單</td>
    	<td class="o" width="8%" id="ch23"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">單</td>
    	<td class="o" width="8%" id="dh23"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">雙</td>
    	<td class="o" width="8%" id="ah24"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">雙</td>
    	<td class="o" width="8%" id="bh24"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">雙</td>
    	<td class="o" width="8%" id="ch24"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">雙</td>
    	<td class="o" width="8%" id="dh24"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">尾大</td>
    	<td class="o" width="8%" id="ah25"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">尾大</td>
    	<td class="o" width="8%" id="bh25"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">尾大</td>
    	<td class="o" width="8%" id="ch25"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">尾大</td>
    	<td class="o" width="8%" id="dh25"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">尾小</td>
    	<td class="o" width="8%" id="ah26"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">尾小</td>
    	<td class="o" width="8%" id="bh26"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">尾小</td>
    	<td class="o" width="8%" id="ch26"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">尾小</td>
    	<td class="o" width="8%" id="dh26"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">合數單</td>
    	<td class="o" width="8%" id="ah27"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">合數單</td>
    	<td class="o" width="8%" id="bh27"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">合數單</td>
    	<td class="o" width="8%" id="ch27"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">合數單</td>
    	<td class="o" width="8%" id="dh27"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">合數雙</td>
    	<td class="o" width="8%" id="ah28"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">合數雙</td>
    	<td class="o" width="8%" id="bh28"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">合數雙</td>
    	<td class="o" width="8%" id="ch28"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">合數雙</td>
    	<td class="o" width="8%" id="dh28"></td>
    	<td class="loads"></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="1">	
    <tr class="t_list_caption" style="color:#000">
    	<td colspan="3">第五球</td>
    	<td colspan="3">第六球</td>
    	<td colspan="3">第七球</td>
    	<td colspan="3">第八球</td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="eh21"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="fh21"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="gh21"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">大</td>
    	<td class="o" width="8%" id="hh21"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="eh22"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="fh22"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="gh22"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">小</td>
    	<td class="o" width="8%" id="hh22"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">單</td>
    	<td class="o" width="8%" id="eh23"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">單</td>
    	<td class="o" width="8%" id="fh23"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">單</td>
    	<td class="o" width="8%" id="gh23"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">單</td>
    	<td class="o" width="8%" id="hh23"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">雙</td>
    	<td class="o" width="8%" id="eh24"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">雙</td>
    	<td class="o" width="8%" id="fh24"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">雙</td>
    	<td class="o" width="8%" id="gh24"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">雙</td>
    	<td class="o" width="8%" id="hh24"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">尾大</td>
    	<td class="o" width="8%" id="eh25"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">尾大</td>
    	<td class="o" width="8%" id="fh25"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">尾大</td>
    	<td class="o" width="8%" id="gh25"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">尾大</td>
    	<td class="o" width="8%" id="hh25"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">尾小</td>
    	<td class="o" width="8%" id="eh26"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">尾小</td>
    	<td class="o" width="8%" id="fh26"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">尾小</td>
    	<td class="o" width="8%" id="gh26"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">尾小</td>
    	<td class="o" width="8%" id="hh26"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">合數單</td>
    	<td class="o" width="8%" id="eh27"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">合數單</td>
    	<td class="o" width="8%" id="fh27"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">合數單</td>
    	<td class="o" width="8%" id="gh27"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">合數單</td>
    	<td class="o" width="8%" id="hh27"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="8%" class="caption_1">合數雙</td>
    	<td class="o" width="8%" id="eh28"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">合數雙</td>
    	<td class="o" width="8%" id="fh28"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">合數雙</td>
    	<td class="o" width="8%" id="gh28"></td>
    	<td class="loads"></td>
    	<td width="8%" class="caption_1">合數雙</td>
    	<td class="o" width="8%" id="hh28"></td>
    	<td class="loads"></td>
    </tr>
</table>
<table border="0" width="700" style="margin-top:10px;">
	<tr height="30">
	    	<td align="center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    	<input onclick="Shortcut_SH(false);" id="Shortcut_Switch" name="Shortcut_Switch" value="" type="checkbox"/>
	    	<a class="font_g F_bold" onfocus="this.blur()" title="快捷下註" onclick="Shortcut_SH(true);" href="javascript:void(0)" style="color:#299a26;text-decoration:none; font-weight:bold;">快捷下注</a>
	    	<span id="Shortcut_DIV" class="font_g"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="Shortcut_hidden();reset();" class="inputs ti" value="重&nbsp;填" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="submits" class="inputs ti" style="font-weight: bold;" value="下&nbsp;註" /><input type="text" id="submitss"  value="" style="width:0px;height:0px;border:0px;"/></td>
	        <td width="0" class="actiionn"></td>
    </tr>
</table>
</form>
<table class="wq" border="0" cellpadding="0" cellspacing="1" style="margin-top:5px;">
	<tr class="t_list_caption">
        <td><a class="nv" <?php echo $onclick?>>總和大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>總和單雙</a></td>
        <td><a class="nv" <?php echo $onclick?>>總和尾數大小</a></td>
        <td class="nv_a"><a class="nv_a" <?php echo $onclick?>>龍虎</a></td>
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