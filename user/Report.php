<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
global $user;
if ($user[0]['xtfm']==1){
header("Location: ./fanm.php"); exit;
}
$db = new DB();
if(!isset($_GET['type']) || $_GET['type']==0)
	$g_type=" ";
	if($_GET['type']==1)
	$g_type=" and g_type='廣東快樂十分' ";
	if($_GET['type']==2)
	$g_type=" and g_type='重慶時時彩' ";
	if($_GET['type']==3) $g_type=" and g_type='极速时时彩' ";
	if($_GET['type']==4) $g_type=" and g_type='极速赛车' ";
	if($_GET['type']==5) $g_type=" and g_type='广东十一选五' ";
	if($_GET['type']==6)
	$g_type=" and g_type='北京赛车PK10' ";
	if($_GET['type']==9) $g_type=" and g_type='幸运农场' ";
$total = $db->query("SELECT `g_id` FROM `g_zhudan` WHERE `g_nid` = '{$user[0]['g_name']}' AND `g_win` is null  {$g_type}", 3);
$pageNum = 20;
$page = new Page($total, $pageNum);
$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` WHERE `g_nid` = '{$user[0]['g_name']}' AND `g_win` is null  {$g_type} ORDER BY g_date DESC {$page->limit} ";
$result = $db->query($sql, 1);
$sql1 = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` WHERE `g_nid` = '{$user[0]['g_name']}' AND `g_win` is null  {$g_type}";
$results = $db->query($sql1, 1);
$countBNum = 0;
$countTNum = 0;
$countSNum = 0;
if ($results)
{
	for ($i=0; $i<count($results); $i++)
	{
		$countMoney = sumCountMoney ($user, $results[$i], true);
			if ($countMoney['Win']>$user[0]['g_win_d']){
			$getgwin=$countMoney['Win']-$user[0]['g_win_k'];
			}else{
			$getgwin=$countMoney['Win'];
			}
		$countBNum += $countMoney['Num'];
		$countTNum += $countMoney['Money'];
		
		$countSNum += $getgwin;
	}
}
markPos("前台-下注明细");
?>

<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="/Css/user/common.css" rel="stylesheet" type="text/css" />
<link href="/Css/user/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/sc.js"></script>
<script>
function typechang($this){
	if ($this.value == 1){
		window.parent.frames.mainFrame.location.href = "/user/Report.php?type=1";
	} else if ($this.value == 3){
		window.parent.frames.mainFrame.location.href = "/user/Report.php?type=3";
	} else if($this.value == 4){
		window.parent.frames.mainFrame.location.href = "/user/Report.php?type=4";
	}else  if($this.value == 2){
		window.parent.frames.mainFrame.location.href = "/user/Report.php?type=2";
	}else if($this.value == 5){
		window.parent.frames.mainFrame.location.href = "/user/Report.php?type=5";
	}else  if($this.value == 6){
		window.parent.frames.mainFrame.location.href = "/user/Report.php?type=6";
	}else{
		window.parent.frames.mainFrame.location.href = "/user/Report.php?type=0";
	}
}
</script>
</head>
<body onselectstart="return false">
<table border="0" cellpadding="0" cellspacing="0" class="t_list"  width="706" style="margin:0px 14px;">
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" class="Man_Conter">
  <tr class="Conter_top" height="25">
                    <th width="125">註單號/時間</th>
                    <th width="125">下註類型</th>
                    <th width="240">註單明細</th>
                    <th width="90">下註金額</th>
                    <th>可贏金額</th>
                </tr>
                    <?php 
        if (count($result) >0) {
		for ($i=0; $i<count($result); $i++) {
        $SumNum = sumCountMoney ($user, $result[$i], true);
		
		if ($SumNum['Win']>$user[0]['g_win_d']){
			$getgwins=$SumNum['Win']-$user[0]['g_win_k'];
			}else{
			$getgwins=$SumNum['Win'];
			}
			
        if ($result[$i]['g_mingxi_1_str'] == null) {
        	if ($result[$i]['g_mingxi_1'] == '總和、龍虎' || $result[$i]['g_mingxi_1'] == '總和、龍虎和' || $result[$i]['g_mingxi_1'] == '三军' &&  $result[$i]['g_mingxi_2'] == '大' || $result[$i]['g_mingxi_1'] == '三军' &&  $result[$i]['g_mingxi_2'] == '小' ){
        		$n = $result[$i]['g_mingxi_2'];
        	}else {
			
        		$n = $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
        	}
        	//$n = $result[$i]['g_mingxi_1'] == '總和、龍虎' ? $result[$i]['g_mingxi_2'] : $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
        	$html = '<span class="fed">'.$n.'</span>@<b class="red">'.$result[$i]['g_odds'].'</b>';
        } else {
        	$_xMoney = $result[$i]['g_mingxi_1_str'] * $result[$i]['g_jiner'];
        	$SumNum['Money'] = $_xMoney.'<br /><span class="#0066FF">'.$result[$i]['g_mingxi_1_str'].' x '.$result[$i]['g_jiner'].'</span>';
        	$html = '<span class="fed">'.$result[$i]['g_mingxi_1'].'</span>@ <b class="red">'.$result[$i]['g_odds'].'</b><br />'.
        				'<span style="line-height:23px">復式  『 '.$result[$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$result[$i]['g_mingxi_2'].'</span>';
        }
        ?>
        
         <tr onMouseOver="onmouseovers(this);" onMouseOut="onmouseouts(this)">
                    <td class="ts">
                        <span class="dis"><?php echo $result[$i]['g_id']?>#</span>
                        <span class="dis"><?php 
        	$a = explode('-', $result[$i]['g_date']);
        	echo $a[1].'-'.$a[2].' '.$a[3].' '.GetWeekDay($result[$i]['g_date'], 0)
        	?></span>
                    </td>
                    <td>
                        <span class="dis"><?php echo $result[$i]['g_type']?></span>
                        <span class="dis green2"><?php echo $result[$i]['g_qishu']?>&nbsp;期</span>
                    </td>
                    <td><?php echo $html?></td>
                    <td align="right" class="mb_right"><?php echo $SumNum['Money']?></td>
           <td class="mb_right" align="right"><?php echo is_Number($getgwins, 1)?></td>
                </tr>
        <?php }}?>
                <tr class="Conter_Report_List cv">
                    <td colspan="2"><b>閤計</b></td>
                    <td><b><?php echo $countBNum?> 筆</b></td>
                    <td class="mb_right" align="right"><b><?php echo number_format($countTNum, 0,".","")?></b></td>
                    <td class="mb_right" align="right"><b><?php echo number_format($countSNum, 1,".","")?></b></td>
                </tr>
                <tr class="Man_bottom">
                    <td colspan="5" align="left" class="mb_left">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="rm">
                            <tr>
                            <?php 
        if (count($result) <1) {?>
                            <td align="center" class="red" height="22" style="padding-right:5px; padding-bottom:2px;">當前沒有數據…… </td>  <?php }else{
							
							$p = $page->diy_page();
							 ?>
                             <td id="reCount" class="mb_left" height="22">共 <?php echo $p[0];?> 筆記錄</td>

                                <td id="pageCount" class="mb_left">共 <?php echo $p[2];?> 頁</td>

                                <td align="right" class="mb_left">
                                    
<!-- AspNetPager 7.3.2  Copyright:2003-2010 Webdiyer (www.webdiyer.com) -->
<?php echo $p[4];?>『<?php echo $p[5];?>』<?php echo $p[6];?><!-- AspNetPager 7.3.2  Copyright:2003-2010 Webdiyer (www.webdiyer.com) -->


                                </td>

                            <?php }?>
                            </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>

