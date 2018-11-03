<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'user/offGamepk.php';
include_once ROOT_PATH.'functioned/cheCookie.php';
if ($user[0]['g_look'] == 2) exit(href('repore.php'));
$ConfigModel = configModel("`g_pk_game_lock`, `g_mix_money`");
if ($ConfigModel['g_pk_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';

//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode(',', $result[0]['g_panlus']); 
$_SESSION['gx'] = false;
$_SESSION['gd'] = false;
$_SESSION['pk'] = true;
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

markPos("前台-PK下注");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/odds_sz_pk.js"></script>
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
<div style="display:none">
</div>
<body style="margin-left:3px;" onselectstart="return false">
<table class="th" border="0" cellpadding="0" cellspacing="0" style="margin-top:8px;top:10px;">
	<tr>
    	<td width="142" height="28" class="bolds">北京赛车PK10　</td>
        <td colspan="2" class="bolds" style="color:red">
                     <td colspan="2" class="bolds" style="color:red"> <div  id="row1" style="position: relative;  FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">
<span>今天輸贏：</span>&nbsp;</div><div><span id="sy"  class="shuyingjieguo2">0.0</span></div></td>
        <td align="right">&nbsp;</td>
  <td class="bolds" width="102">
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
        <td width="160"><span style="color:#0033FF; font-weight:bold" id="tys">排名1~10</span></td>
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
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money']?>" />
<table class="wq saiche" border="0" cellpadding="0" cellspacing="1" style="margin-top:-5px;">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="3">冠軍</td>
    	<td colspan="3">亞軍</td>
    	<td colspan="3">第三名</td>
    	<td colspan="3">第四名</td>
		<td colspan="3">第五名</td>
   	</tr>
	<tr class="t_list_caption" style="color:#000">
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>		
   	</tr>
    <tr class="t_td_text">	
	    <td width="4%"  class="No_1"></td>
    	<td class="o" width="7%" id="ah1"></td>
    	<td class="tt" id="t1_h1"></td>
    	<td width="4%"  class="No_1"></td>
    	<td class="o" width="7%" id="bh1"></td>
    	<td class="tt" id="t2_h1"></td>		
		<td width="4%"  class="No_1"></td>
    	<td class="o" width="7%" id="ch1"></td>
    	<td class="tt" id="t3_h1"></td>
		<td width="4%"  class="No_1"></td>
    	<td class="o" width="7%" id="dh1"></td>
    	<td class="tt" id="t4_h1"></td>
		<td width="4%"  class="No_1"></td>
    	<td class="o" width="7%" id="eh1"></td>
    	<td class="tt" id="t5_h1"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_2"></td>
    	<td class="o" width="7%" id="ah2"></td>
    	<td class="tt" id="t1_h2"></td>
    	<td width="4%"  class="No_2"></td>
    	<td class="o" width="7%" id="bh2"></td>
    	<td class="tt" id="t2_h2"></td>		
		<td width="4%"  class="No_2"></td>
    	<td class="o" width="7%" id="ch2"></td>
    	<td class="tt" id="t3_h2"></td>
		<td width="4%"  class="No_2"></td>
    	<td class="o" width="7%" id="dh2"></td>
    	<td class="tt" id="t4_h2"></td>
		<td width="4%"  class="No_2"></td>
    	<td class="o" width="7%" id="eh2"></td>
    	<td class="tt" id="t5_h2"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_3"></td>
    	<td class="o" width="7%" id="ah3"></td>
    	<td class="tt" id="t1_h3"></td>
    	<td width="4%"  class="No_3"></td>
    	<td class="o" width="7%" id="bh3"></td>
    	<td class="tt" id="t2_h3"></td>		
		<td width="4%"  class="No_3"></td>
    	<td class="o" width="7%" id="ch3"></td>
    	<td class="tt" id="t3_h3"></td>
		<td width="4%"  class="No_3"></td>
    	<td class="o" width="7%" id="dh3"></td>
    	<td class="tt" id="t4_h3"></td>
		<td width="4%"  class="No_3"></td>
    	<td class="o" width="7%" id="eh3"></td>
    	<td class="tt" id="t5_h3"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_4"></td>
    	<td class="o" width="7%" id="ah4"></td>
    	<td class="tt" id="t1_h4"></td>
    	<td width="4%"  class="No_4"></td>
    	<td class="o" width="7%" id="bh4"></td>
    	<td class="tt" id="t2_h4"></td>		
		<td width="4%"  class="No_4"></td>
    	<td class="o" width="7%" id="ch4"></td>
    	<td class="tt" id="t3_h4"></td>
		<td width="4%"  class="No_4"></td>
    	<td class="o" width="7%" id="dh4"></td>
    	<td class="tt" id="t4_h4"></td>
		<td width="4%"  class="No_4"></td>
    	<td class="o" width="7%" id="eh4"></td>
    	<td class="tt" id="t5_h4"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_5"></td>
    	<td class="o" width="7%" id="ah5"></td>
    	<td class="tt" id="t1_h5"></td>
    	<td width="4%"  class="No_5"></td>
    	<td class="o" width="7%" id="bh5"></td>
    	<td class="tt" id="t2_h5"></td>		
		<td width="4%"  class="No_5"></td>
    	<td class="o" width="7%" id="ch5"></td>
    	<td class="tt" id="t3_h5"></td>
		<td width="4%"  class="No_5"></td>
    	<td class="o" width="7%" id="dh5"></td>
    	<td class="tt" id="t4_h5"></td>
		<td width="4%"  class="No_5"></td>
    	<td class="o" width="7%" id="eh5"></td>
    	<td class="tt" id="t5_h5"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_6"></td>
    	<td class="o" width="7%" id="ah6"></td>
    	<td class="tt" id="t1_h6"></td>
    	<td width="4%"  class="No_6"></td>
    	<td class="o" width="7%" id="bh6"></td>
    	<td class="tt" id="t2_h6"></td>		
		<td width="4%"  class="No_6"></td>
    	<td class="o" width="7%" id="ch6"></td>
    	<td class="tt" id="t3_h6"></td>
		<td width="4%"  class="No_6"></td>
    	<td class="o" width="7%" id="dh6"></td>
    	<td class="tt" id="t4_h6"></td>
		<td width="4%"  class="No_6"></td>
    	<td class="o" width="7%" id="eh6"></td>
    	<td class="tt" id="t5_h6"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_7"></td>
    	<td class="o" width="7%" id="ah7"></td>
    	<td class="tt" id="t1_h7"></td>
    	<td width="4%"  class="No_7"></td>
    	<td class="o" width="7%" id="bh7"></td>
    	<td class="tt" id="t2_h7"></td>		
		<td width="4%"  class="No_7"></td>
    	<td class="o" width="7%" id="ch7"></td>
    	<td class="tt" id="t3_h7"></td>
		<td width="4%"  class="No_7"></td>
    	<td class="o" width="7%" id="dh7"></td>
    	<td class="tt" id="t4_h7"></td>
		<td width="4%"  class="No_7"></td>
    	<td class="o" width="7%" id="eh7"></td>
    	<td class="tt" id="t5_h7"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_8"></td>
    	<td class="o" width="7%" id="ah8"></td>
    	<td class="tt" id="t1_h8"></td>
    	<td width="4%"  class="No_8"></td>
    	<td class="o" width="7%" id="bh8"></td>
    	<td class="tt" id="t2_h8"></td>		
		<td width="4%"  class="No_8"></td>
    	<td class="o" width="7%" id="ch8"></td>
    	<td class="tt" id="t3_h8"></td>
		<td width="4%"  class="No_8"></td>
    	<td class="o" width="7%" id="dh8"></td>
    	<td class="tt" id="t4_h8"></td>
		<td width="4%"  class="No_8"></td>
    	<td class="o" width="7%" id="eh8"></td>
    	<td class="tt" id="t5_h8"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_9"></td>
    	<td class="o" width="7%" id="ah9"></td>
    	<td class="tt" id="t1_h9"></td>
    	<td width="4%"  class="No_9"></td>
    	<td class="o" width="7%" id="bh9"></td>
    	<td class="tt" id="t2_h9"></td>		
		<td width="4%"  class="No_9"></td>
    	<td class="o" width="7%" id="ch9"></td>
    	<td class="tt" id="t3_h9"></td>
		<td width="4%"  class="No_9"></td>
    	<td class="o" width="7%" id="dh9"></td>
    	<td class="tt" id="t4_h9"></td>
		<td width="4%"  class="No_9"></td>
    	<td class="o" width="7%" id="eh9"></td>
    	<td class="tt" id="t5_h9"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_10"></td>
    	<td class="o" width="7%" id="ah10"></td>
    	<td class="tt" id="t1_h10"></td>
    	<td width="4%"  class="No_10"></td>
    	<td class="o" width="7%" id="bh10"></td>
    	<td class="tt" id="t2_h10"></td>		
		<td width="4%"  class="No_10"></td>
    	<td class="o" width="7%" id="ch10"></td>
    	<td class="tt" id="t3_h10"></td>
		<td width="4%"  class="No_10"></td>
    	<td class="o" width="7%" id="dh10"></td>
    	<td class="tt" id="t4_h10"></td>
		<td width="4%"  class="No_10"></td>
    	<td class="o" width="7%" id="eh10"></td>
    	<td class="tt" id="t5_h10"></td>	
	</tr>		
  </table>
<table class="wq saiche" border="0" cellpadding="0" cellspacing="1" style="margin-top:-5px;">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="3">第六名</td>
    	<td colspan="3">第七名</td>
    	<td colspan="3">第八名</td>
    	<td colspan="3">第九名</td>
		<td colspan="3">第十名</td>
   	</tr>
	<tr class="t_list_caption" style="color:#000">
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>		
   	</tr>
    <tr class="t_td_text">	
	    <td width="4%"  class="No_1"></td>
    	<td class="o" width="7%" id="fh1"></td>
    	<td class="tt" id="t6_h1"></td>
    	<td width="4%"  class="No_1"></td>
    	<td class="o" width="7%" id="gh1"></td>
    	<td class="tt" id="t7_h1"></td>		
		<td width="4%"  class="No_1"></td>
    	<td class="o" width="7%" id="hh1"></td>
    	<td class="tt" id="t8_h1"></td>
		<td width="4%"  class="No_1"></td>
    	<td class="o" width="7%" id="ih1"></td>
    	<td class="tt" id="t9_h1"></td>
		<td width="4%"  class="No_1"></td>
    	<td class="o" width="7%" id="jh1"></td>
    	<td class="tt" id="t10_h1"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_2"></td>
    	<td class="o" width="7%" id="fh2"></td>
    	<td class="tt" id="t6_h2"></td>
    	<td width="4%"  class="No_2"></td>
    	<td class="o" width="7%" id="gh2"></td>
    	<td class="tt" id="t7_h2"></td>		
		<td width="4%"  class="No_2"></td>
    	<td class="o" width="7%" id="hh2"></td>
    	<td class="tt" id="t8_h2"></td>
		<td width="4%"  class="No_2"></td>
    	<td class="o" width="7%" id="ih2"></td>
    	<td class="tt" id="t9_h2"></td>
		<td width="4%"  class="No_2"></td>
    	<td class="o" width="7%" id="jh2"></td>
    	<td class="tt" id="t10_h2"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_3"></td>
    	<td class="o" width="7%" id="fh3"></td>
    	<td class="tt" id="t6_h3"></td>
    	<td width="4%"  class="No_3"></td>
    	<td class="o" width="7%" id="gh3"></td>
    	<td class="tt" id="t7_h3"></td>		
		<td width="4%"  class="No_3"></td>
    	<td class="o" width="7%" id="hh3"></td>
    	<td class="tt" id="t8_h3"></td>
		<td width="4%"  class="No_3"></td>
    	<td class="o" width="7%" id="ih3"></td>
    	<td class="tt" id="t9_h3"></td>
		<td width="4%"  class="No_3"></td>
    	<td class="o" width="7%" id="jh3"></td>
    	<td class="tt" id="t10_h3"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_4"></td>
    	<td class="o" width="7%" id="fh4"></td>
    	<td class="tt" id="t6_h4"></td>
    	<td width="4%"  class="No_4"></td>
    	<td class="o" width="7%" id="gh4"></td>
    	<td class="tt" id="t7_h4"></td>		
		<td width="4%"  class="No_4"></td>
    	<td class="o" width="7%" id="hh4"></td>
    	<td class="tt" id="t8_h4"></td>
		<td width="4%"  class="No_4"></td>
    	<td class="o" width="7%" id="ih4"></td>
    	<td class="tt" id="t9_h4"></td>
		<td width="4%"  class="No_4"></td>
    	<td class="o" width="7%" id="jh4"></td>
    	<td class="tt" id="t10_h4"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_5"></td>
    	<td class="o" width="7%" id="fh5"></td>
    	<td class="tt" id="t6_h5"></td>
    	<td width="4%"  class="No_5"></td>
    	<td class="o" width="7%" id="gh5"></td>
    	<td class="tt" id="t7_h5"></td>		
		<td width="4%"  class="No_5"></td>
    	<td class="o" width="7%" id="hh5"></td>
    	<td class="tt" id="t8_h5"></td>
		<td width="4%"  class="No_5"></td>
    	<td class="o" width="7%" id="ih5"></td>
    	<td class="tt" id="t9_h5"></td>
		<td width="4%"  class="No_5"></td>
    	<td class="o" width="7%" id="jh5"></td>
    	<td class="tt" id="t10_h5"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_6"></td>
    	<td class="o" width="7%" id="fh6"></td>
    	<td class="tt" id="t6_h6"></td>
    	<td width="4%"  class="No_6"></td>
    	<td class="o" width="7%" id="gh6"></td>
    	<td class="tt" id="t7_h6"></td>		
		<td width="4%"  class="No_6"></td>
    	<td class="o" width="7%" id="hh6"></td>
    	<td class="tt" id="t8_h6"></td>
		<td width="4%"  class="No_6"></td>
    	<td class="o" width="7%" id="ih6"></td>
    	<td class="tt" id="t9_h6"></td>
		<td width="4%"  class="No_6"></td>
    	<td class="o" width="7%" id="jh6"></td>
    	<td class="tt" id="t10_h6"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_7"></td>
    	<td class="o" width="7%" id="fh7"></td>
    	<td class="tt" id="t6_h7"></td>
    	<td width="4%"  class="No_7"></td>
    	<td class="o" width="7%" id="gh7"></td>
    	<td class="tt" id="t7_h7"></td>		
		<td width="4%"  class="No_7"></td>
    	<td class="o" width="7%" id="hh7"></td>
    	<td class="tt" id="t8_h7"></td>
		<td width="4%"  class="No_7"></td>
    	<td class="o" width="7%" id="ih7"></td>
    	<td class="tt" id="t9_h7"></td>
		<td width="4%"  class="No_7"></td>
    	<td class="o" width="7%" id="jh7"></td>
    	<td class="tt" id="t10_h7"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_8"></td>
    	<td class="o" width="7%" id="fh8"></td>
    	<td class="tt" id="t6_h8"></td>
    	<td width="4%"  class="No_8"></td>
    	<td class="o" width="7%" id="gh8"></td>
    	<td class="tt" id="t7_h8"></td>		
		<td width="4%"  class="No_8"></td>
    	<td class="o" width="7%" id="hh8"></td>
    	<td class="tt" id="t8_h8"></td>
		<td width="4%"  class="No_8"></td>
    	<td class="o" width="7%" id="ih8"></td>
    	<td class="tt" id="t9_h8"></td>
		<td width="4%"  class="No_8"></td>
    	<td class="o" width="7%" id="jh8"></td>
    	<td class="tt" id="t10_h8"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_9"></td>
    	<td class="o" width="7%" id="fh9"></td>
    	<td class="tt" id="t6_h9"></td>
    	<td width="4%"  class="No_9"></td>
    	<td class="o" width="7%" id="gh9"></td>
    	<td class="tt" id="t7_h9"></td>		
		<td width="4%"  class="No_9"></td>
    	<td class="o" width="7%" id="hh9"></td>
    	<td class="tt" id="t8_h9"></td>
		<td width="4%"  class="No_9"></td>
    	<td class="o" width="7%" id="ih9"></td>
    	<td class="tt" id="t9_h9"></td>
		<td width="4%"  class="No_9"></td>
    	<td class="o" width="7%" id="jh9"></td>
    	<td class="tt" id="t10_h9"></td>	
	</tr>	
    <tr class="t_td_text">	
	    <td width="4%"  class="No_10"></td>
    	<td class="o" width="7%" id="fh10"></td>
    	<td class="tt" id="t6_h10"></td>
    	<td width="4%"  class="No_10"></td>
    	<td class="o" width="7%" id="gh10"></td>
    	<td class="tt" id="t7_h10"></td>		
		<td width="4%"  class="No_10"></td>
    	<td class="o" width="7%" id="hh10"></td>
    	<td class="tt" id="t8_h10"></td>
		<td width="4%"  class="No_10"></td>
    	<td class="o" width="7%" id="ih10"></td>
    	<td class="tt" id="t9_h10"></td>
		<td width="4%"  class="No_10"></td>
    	<td class="o" width="7%" id="jh10"></td>
    	<td class="tt" id="t10_h10"></td>	
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
<br />
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
<br />
</form>

<div id="look"></div>
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