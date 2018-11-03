<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
global $user;
if ($user[0]['xtfm']==1){
header("Location: ./fanm.php"); exit;
}
if ($_GET['gid'] == "") {
$date=date("Y-m-d");
}else{
$date = base64_decode($_GET['gid']);
}

$startDate = $date.' 06:10';
$endDate = dayMorning($date, (60*60*24)).' 06:10';
$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
$db = new DB();

	if(!isset($_GET['type']) || $_GET['type']==0)
	$g_type=" ";
	if($_GET['type']==1)
	$g_type=" and g_type='廣東快樂十分' ";
	if($_GET['type']==2)
	$g_type=" and g_type='重慶時時彩' ";
	if($_GET['type']==6)
	$g_type=" and g_type='北京赛车PK10' ";
	
$sql = "SELECT `g_id` FROM `g_zhudan` WHERE {$date} AND `g_nid` = '{$user[0]['g_name']}' AND `g_win` is not null {$g_type}";

$total = $db->query($sql, 3);
$pageNum = 15;
$page = new Page($total, $pageNum);
$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` 
WHERE {$date} AND `g_nid` = '{$user[0]['g_name']}' AND `g_win` is not null {$g_type} ORDER BY g_date DESC {$page->limit} ";
$result = $db->query($sql, 1);
$sql1 = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` 
WHERE {$date} AND `g_nid` = '{$user[0]['g_name']}' AND `g_win` is not null {$g_type}";
$results = $db->query($sql1, 1);
$countBNum = 0;
$countTNum = 0;
$countSNum = 0;
if ($results)
{
	for ($i=0; $i<count($results); $i++)
	{
		$countMoney = sumCountMoney ($user, $results[$i]);
		$countBNum += $countMoney['Num'];
		$countTNum += $countMoney['Money'];
		$countSNum += $countMoney['Win'];
	}
}
?>
<style type="text/css">
.t_list {margin:0px 14px;}
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/left.css" rel="stylesheet" type="text/css">
<div >
</div>
</head>
<body onselectstart="return false">
<table border="0" cellpadding="0" cellspacing="1" class="t_list t_result" width="700">
        <tr class="t_list_caption_1">
            <td width="130"><b>註單號/時間</b></td>
            <td width="120"><b>下註類型</b></td>
            <td><b>註單明細</b></td>
            <td width="100"><b>下註金額</b></td>
            <td width="120"><b>退水后結果</b></td>
        </tr>
        <?php 
        if (count($result) <1) {echo '<tr class="t_td_text" align="center"><td colspan="5">當前沒有任何記錄</td></tr>';} 
        else {for ($i=0; $i<count($result); $i++) {
        $SumNum = sumCountMoney ($user, $result[$i]);
        if ($result[$i]['g_mingxi_1_str'] == null) {
       		if ($result[$i]['g_mingxi_1'] == '總和、龍虎' || $result[$i]['g_mingxi_1'] == '總和、龍虎和' || $result[$i]['g_mingxi_1'] == '三军' &&  $result[$i]['g_mingxi_2'] == '大' || $result[$i]['g_mingxi_1'] == '三军' &&  $result[$i]['g_mingxi_2'] == '小' ){
        		$n = $result[$i]['g_mingxi_2'];
        	}else {
        		$n = $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
        	}
        	//$n = $result[$i]['g_mingxi_1'] == '總和、龍虎' ? $result[$i]['g_mingxi_2'] : $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
        	$html = '<font color="#2836F4">'.$n.'</font>@ <font color="red"><b>'.$result[$i]['g_odds'].'</b></font>';
        }
			else {
        	$_xMoney = $result[$i]['g_mingxi_1_str'] * $result[$i]['g_jiner'];
        	$SumNum['Money'] = '<font color="#009933">'.$result[$i]['g_mingxi_1_str'].'</font> x <font color="#0066FF">'.$result[$i]['g_jiner'].'</font><br />'.$_xMoney;
        	$html = '<font color="#2836F4">'.$result[$i]['g_mingxi_1'].'</font>@ <font color="red"><b>'.$result[$i]['g_odds'].'</b></font><br />'.
        				'<span style="line-height:23px">復式  『 '.$result[$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$result[$i]['g_mingxi_2'].'</span>';
        }
        ?>
        <tr class="t_td_text" align="center" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
        	<td>
        	<span style="letter-spacing:1px; font-size:104%;"><?php echo $result[$i]['g_id']?>#</span>
        	<br />
        	<span style="font-size:104%;">
        	<?php 
        	$a = explode('-', $result[$i]['g_date']);
        	echo $a[1].'-'.$a[2].' '.$a[3].' '.GetWeekDay($result[$i]['g_date'], 0)
        	?></span>
        	</td>
        	<td><?php echo $result[$i]['g_type']?><br /><font color="#009933"><?php echo $result[$i]['g_qishu']?>期</font></td>
        	<td><?php echo $html?></td>
        	<td align="right"><?php echo $SumNum['Money']?>&nbsp;</td>
        	<td align="right"><?php echo is_Number($SumNum['Win'], 1)?>&nbsp;</td>
        </tr>
        <?php }}?>
        <tr align="center" class="t_td_odd_2">
        	<td colspan="2"><b>閤計</b></td>
            <td><b><?php echo $countBNum?>&nbsp;筆</b></td>
            <td align="right"><b><?php echo number_format($countTNum)?></b></td>
            <td align="right"><b><?php echo number_format($countSNum,1)?></b></td>
        </tr>
        <tr class="Man_bottom">
            <td colspan="5" align="right"><?php $p = $page->diy_page()?><table width='100%' height='22' border='0' cellspacing='0' cellpadding='0' class="page_box"><tr><td align='left'>&nbsp;共&nbsp;<?php echo $p[0];?>&nbsp;筆註單</td><td align='center'>共&nbsp;<?php echo $p[2];?>&nbsp;頁</td><td align='right'>&nbsp;<?php echo $p[4];?>『<?php echo $p[5];?>』<?php echo $p[6];?>&nbsp;</td></tr></table></td>
             </tr>
</table>
</body>
</html>