<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
global $user;
if ($user[0]['xtfm']==1){
 exit;
}
if ($_GET['gid'] == "") {
$date=date("Y-m-d");
}else{
$date = base64_decode($_GET['gid']);
}
$date_title=$date;
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
?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
<link rel="stylesheet" href="css/style.css">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
<meta content="telephone=no" name="format-detection" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta name="apple-mobile-web-app-capable" content="no">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<script  type="application/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="application/javascript" src="js/jquery.mobile-1.4.3.js"></script>
    
</head>
<body>
<div data-role="page">
<script language="javascript" type="text/javascript">
    var generatedCount = 0;
    function pullUpAction() {
        getData(BeginDate);
    }
    function getData(FindDate) {
        $("#pullUpIcon").html("<img src='images/loading.gif' />");
        generatedCount++;
        try {
            $.ajax({
                async: true,
                url: "Report_JeuWeekListAjax.php?FindDate=" + FindDate + "&page=" + generatedCount + "&r=07180402424171",
                type: 'GET',
                dataType: 'text',
                cache: false,
                timeout: 5000,
                error: function (XMLHttpRequest, textStatus, errorThrown) { },
                success: function (str) {
                    try {
                        if (str == "") {
                            $("#pullUpLabel").html("無數據加載！");
                        }
                        else {
                            $("#table1").append(str);
                        }
                    } catch (e) { }
                    $("#pullUpIcon").html("");
                }
            })
        } catch (e) { }
    }
    </script>
	<div data-role="header" data-position="fixed">
		<a href="Report_JeuWeek.php?r=07180402424171" data-role="botton" data-transition="slide"  data-direction="reverse" data-icon="back" data-iconpos="notext"></a>
		<h1 id="dataTile">分類明細 - 日期:<?=$date_title?></h1>
        <a href="Main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse"></a>
	</div> 
    <div data-role="content" class="pm">

       <table class="tableBox">
        <tr>
             <th>類型</td>
            <th>筆數</td>
            <th>下註總額</td>
           
            <th>實際結果</td>
        </tr>
         <?php 
        if (count($result) <1) {echo '<tr class="t_list_bottom"><td colspan="17" class="style1"><span class="Font_R">無記錄!!!</span></td></tr>';} 
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
        <tr>
        	<td>
        	<span><?php echo $result[$i]['g_id']?>#</span>
        	<br />
        	<span>
        	<?php 
        	$a = explode('-', $result[$i]['g_date']);
        	echo $a[1].'-'.$a[2].' '.$a[3].' '.GetWeekDay($result[$i]['g_date'], 0)
        	?></span>
        	</td>
        	<td><?php echo $result[$i]['g_type']?><br /><font color="#009933"><?php echo $result[$i]['g_qishu']?>期</font></td>
        	<td><?php echo $html?></td>
        	<td><?php echo is_Number($SumNum['Win'], 1)?></td>
        </tr>
        <?php }}?>
            
         <tr class="tdBg">
            <td>合計</td>
            <td><?php echo $countBNum?>&nbsp;筆</td>
            <td><?php echo number_format($countTNum)?></td>

            <td><?php echo is_Number($countSNum,1)?></td>
        </tr>
    </table>
		
</div>
<? include 'footer.php';?>
<script language="javascript" type="text/javascript">
    var BeginDate = '<?=$date_title?>'
</script>
</div>
</body>
</html>