﻿<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
if ($user[0]['g_look'] == 2) exit(href('repore.php'));
$ConfigModel = configModel("`g_kg_game_lock`, `g_game_1`, `g_game_2`, `g_game_3`, `g_game_4`, `g_game_5`, `g_game_6`, `g_game_7`, `g_game_8`");
if ($ConfigModel['g_kg_game_lock'] !=1)
exit(href('right.php'));
$g = $_GET['g'];
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" '.$onclick;
$_SESSION['gd'] = true;
$_SESSION['gx'] = false;
$_SESSION['pk'] = false;
$_SESSION['cq'] = false;
$_SESSION['xj'] = false;
$_SESSION['jx'] = false;
$_SESSION['tj'] = false;
$_SESSION['sz'] = false;
$_SESSION['kl8'] = false;
//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 
 
 
 //$abc = $_GET['abc'];
//if($abc==null) $abc=$pan[0];
//$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
//$result1 = $db->query($sql, 2);

switch ($g) {
	case 'g1':
		if ($ConfigModel['g_game_1'] !=1)exit(href('right.php'));
		$types = '第一球';
		$aHtml = '<a '.$getResult.'>第1球</a>';
		break;
	case 'g2':
		if ($ConfigModel['g_game_2'] !=1)exit(href('right.php'));
		$types = '第二球';
		$aHtml = '<a '.$getResult.'>第2球</a>';
		break;
	case 'g3':
		if ($ConfigModel['g_game_3'] !=1)exit(href('right.php'));
		$types = '第三球';
		$aHtml = '<a '.$getResult.'>第3球</a>';
		break;
	case 'g4':
		if ($ConfigModel['g_game_4'] !=1)exit(href('right.php'));
		$types = '第四球';
		$aHtml = '<a '.$getResult.'>第4球</a>';
		break;
	case 'g5':
		if ($ConfigModel['g_game_5'] !=1)exit(href('right.php'));
		$types = '第五球';
		$aHtml = '<a '.$getResult.'>第5球</a>';
		break;
	case 'g6':
		if ($ConfigModel['g_game_6'] !=1)exit(href('right.php'));
		$types = '第六球';
		$aHtml = '<a '.$getResult.'>第6球</a>';
		break;
	case 'g7':
		if ($ConfigModel['g_game_7'] !=1)exit(href('right.php'));
		$types = '第七球';
		$aHtml = '<a '.$getResult.'>第7球</a>';
		break;
	case 'g8':
		if ($ConfigModel['g_game_8'] !=1)exit(href('right.php'));
		$types = '第八球';
		$aHtml = '<a '.$getResult.'>第8球</a>';
		break;
	default:exit;
}

markPos("前台-广东下载-{$types}");
?>
<?php include_once 'inc/top.php';?>
<script type="text/javascript" src="./js/plxz.js"></script>
<body style="margin-left: 3px;margin-top:-3px;" onselectstart="return false">
<table class="th" border="0" cellpadding="0" cellspacing="0">
	<tr>    	<td width="130" height="20" class="bolds">廣東快樂十分</td>
        <td colspan="2" class="bolds" style="color:red">
                     <td colspan="2" class="bolds" style="color:red"><div  id="row1" style="position: relative;  FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">
<span>今天輸贏：</span>&nbsp;</div><div><span id="sy"  class="shuyingjieguo2" top:-2px">0.0</span></div></td>
        <td align="right">&nbsp;</td>
      <td class="bolds" width="140" align="right">
        <span id="n" style="font-size:12px;position:relative; top:1px"></span>期開獎</td>		
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
        <td><span style="color:#0033FF; font-weight:bold" id="tys"><?php echo $types?></span></td>
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
<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money']?>"><div id="look" ></div>
<form id="dp" action="" method="post" target="leftFrame">
<input type="hidden" name="actions" value="fn1" />
<input type="hidden" name="gtypes" value="1" />
<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption">
    	<td width="4%">號</td>
        <td width="12%">賠率</td>
        <td>金額</td>
        <td width="4%">號</td>
        <td width="12%">賠率</td>
        <td>金額</td>
        <td width="4%">號</td>
        <td width="12%">賠率</td>
        <td>金額</td>
        <td width="4%">號</td>
        <td width="12%">賠率</td>
        <td>金額</td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd1"></td>
        <td class="o" id="h1"></td>
        <td class="tt" id="t1"></td>
        <td class="No_gd6"></td>
        <td class="o" id="h6"></td>
        <td class="tt" id="t6"></td>
        <td class="No_gd11"></td>
        <td class="o" id="h11"></td>
        <td class="tt" id="t11"></td>
        <td class="No_gd16"></td>
        <td class="o" id="h16"></td>
        <td class="tt" id="t16"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd2"></td>
        <td class="o" id="h2"></td>
        <td class="tt" id="t2"></td>
        <td class="No_gd7"></td>
        <td class="o" id="h7"></td>
        <td class="tt" id="t7"></td>
        <td class="No_gd12"></td>
        <td class="o" id="h12"></td>
        <td class="tt" id="t12"></td>
        <td class="No_gd17"></td>
        <td class="o" id="h17"></td>
        <td class="tt" id="t17"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd3"></td>
        <td class="o" id="h3"></td>
        <td class="tt" id="t3"></td>
        <td class="No_gd8"></td>
        <td class="o" id="h8"></td>
        <td class="tt" id="t8"></td>
        <td class="No_gd13"></td>
        <td class="o" id="h13"></td>
        <td class="tt" id="t13"></td>
        <td class="No_gd18"></td>
        <td class="o" id="h18"></td>
        <td class="tt" id="t18"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd4"></td>
        <td class="o" id="h4"></td>
        <td class="tt" id="t4"></td>
        <td class="No_gd9"></td>
        <td class="o" id="h9"></td>
        <td class="tt" id="t9"></td>
        <td class="No_gd14"></td>
        <td class="o" id="h14"></td>
        <td class="tt" id="t14"></td>
        <td class="No_gd19"></td>
        <td class="o" id="h19"></td>
        <td class="tt" id="t19"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_gd5"></td>
        <td class="o" id="h5"></td>
        <td class="tt" id="t5"></td>
        <td class="No_gd10"></td>
        <td class="o" id="h10"></td>
        <td class="tt" id="t10"></td>
        <td class="No_gd15"></td>
        <td class="o" id="h15"></td>
        <td class="tt" id="t15"></td>
        <td class="No_gd20"></td>
        <td class="o" id="h20"></td>
        <td class="tt" id="t20"></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_td_text">
    	<td width="8%" class="caption_1">大</td>
        <td width="8%" class="o" id="h21"></td>
        <td class="tt" id="t21"></td>
        <td width="8%" class="caption_1">單</td>
        <td width="8%" class="o" id="h23"></td>
        <td class="tt" id="t23"></td>
        <td width="8%" class="caption_1">尾大</td>
        <td width="8%" class="o" id="h25"></td>
        <td class="tt" id="t25"></td>
        <td width="8%" class="caption_1">合數單</td>
        <td width="8%" class="o" id="h27"></td>
        <td class="tt" id="t27"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="50" class="caption_1">小</td>
        <td class="o" id="h22"></td>
        <td width="70" class="tt" id="t22"></td>
        <td width="50" class="caption_1">雙</td>
        <td class="o" id="h24"></td>
        <td width="70" class="tt" id="t24"></td>
        <td width="50" class="caption_1">尾小</td>
        <td class="o" id="h26"></td>
        <td width="70" class="tt" id="t26"></td>
        <td width="50" class="caption_1">合數雙</td>
        <td class="o" id="h28"></td>
        <td width="70" class="tt" id="t28"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="50" class="caption_1">東</td>
        <td class="o" id="h29"></td>
        <td width="70" class="tt" id="t29"></td>
        <td width="50" class="caption_1">南</td>
        <td class="o" id="h30"></td>
        <td width="70" class="tt" id="t30"></td>
        <td width="50" class="caption_1">西</td>
        <td class="o" id="h31"></td>
        <td width="70" class="tt" id="t31"></td>
        <td width="50" class="caption_1">北</td>
        <td class="o" id="h32"></td>
        <td width="70" class="tt" id="t32"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="50" class="caption_1">中</td>
        <td class="o" id="h33"></td>
        <td width="70" class="tt" id="t33"></td>
        <td width="50" class="caption_1">發</td>
        <td class="o" id="h34"></td>
        <td width="70" class="tt" id="t34"></td>
        <td width="50" class="caption_1">白</td>
        <td class="o" id="h35"></td>
        <td width="70" class="tt" id="t35"></td>
        <td colspan="3"></td>
    </tr>
</table>
<table border="0" width="700" style="margin-top:10px;">
	<tr height="30">
	    	<td align="center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    	<input onClick="Shortcut_SH(false);" id="Shortcut_Switch" name="Shortcut_Switch" value="" type="checkbox"/>
	    	<a class="font_g F_bold" onFocus="this.blur()" title="快捷下註" onClick="Shortcut_SH(true);" href="javascript:void(0)" style="color:#299a26;text-decoration:none; font-weight:bold;">快捷下注</a>
	    	<span id="Shortcut_DIV" class="font_g"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onClick="Shortcut_hidden();reset();" class="inputs ti" value="重&nbsp;&nbsp;填" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="submits" class="inputs ti" style="font-weight: bold;" value="下&nbsp;&nbsp;註" /><input type="text" id="submitss"  value="" style="width:0px;height:0px;border:0px;"/></td>
	        <td width="0" class="actiionn"></td>
    </tr>
</table>
</form>
<table class="wq" border="0" cellpadding="0" cellspacing="1" style="margin-top:5px;">
	<tr class="t_list_caption" style="color:#0066FF">
    	<th style="color:#4A1A04" width="75">今天</th>
    	<th>01</th>
        <th>02</th>
        <th>03</th>
        <th>04</th>
        <th>05</th>
        <th>06</th>
        <th>07</th>
        <th>08</th>
        <th>09</th>
        <th>10</th>
        <th>11</th>
        <th>12</th>
        <th>13</th>
        <th>14</th>
        <th>15</th>
        <th>16</th>
        <th>17</th>
        <th>18</th>
        <th style="color:red">19</th>
        <th style="color:red">20</th>
    </tr>
    <tr class="t_td_text" id="su">
    	<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr class="t_td_text" id="se">
    	<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="1">
	<tr class="t_list_caption">
    	<td class="nv_a"><?php echo $aHtml?></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv'><a class="nv" <?php echo $onclick?>>大小</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv'><a class="nv" <?php echo $onclick?>>單雙</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv'><a class="nv" <?php echo $onclick?>>尾數大小</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv'><a class="nv" <?php echo $onclick?>>合數單雙</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv'><a class="nv" <?php echo $onclick?>>方位</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv'><a class="nv" <?php echo $onclick?>>中發白</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv'><a class="nv" <?php echo $onclick?>>總和大小</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv'><a class="nv" <?php echo $onclick?>>總和單雙</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv'><a class="nv" <?php echo $onclick?>>總和尾數大小</a></td>
        <td onfocus="this.className='nv_a'" onblur="this.className='nv'" class='nv'><a class="nv" <?php echo $onclick?>>龍虎</a></td>
    </tr>
    <tr>
    	<td colspan="11" class="t_td_text" align="center">
        	<table class="hj" border="0" cellpadding="0" cellspacing="1">
            	<tr class="t_td_text" id="z_cl"><td></td></tr>
            </table>
        </td>
    </tr>
</table>
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