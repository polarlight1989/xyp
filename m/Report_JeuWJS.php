<?php 
define('Copyright', '作者QQ:860336530');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
global $user;
if ($user[0]['xtfm']==1){
 exit;
}
$db = new DB();
if(!isset($_GET['type']) || $_GET['type']==0)
	$g_type=" ";
	if($_GET['type']==1)
	$g_type=" and g_type='廣東快樂十分' ";
	if($_GET['type']==2)
	$g_type=" and g_type='重慶時時彩' ";
	if($_GET['type']==3) $g_type=" and g_type='江西时时彩' ";
	if($_GET['type']==4) $g_type=" and g_type='极速赛车' ";
	if($_GET['type']==5) $g_type=" and g_type='广东十一选五' ";
	if($_GET['type']==6) $g_type=" and g_type='北京赛车PK10' ";
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
?><!DOCTYPE html>
<html>
<head>
    <title>結算報表</title>
    <link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/jquery.mobile-1.4.3.js"></script>
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0, user-scalable=yes" />
	<meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   
</head>
<body>
    <div data-role="page" id="dataPageJeuWJS">
     <script language="javascript" type="text/javascript">
         var generatedCount = 1;
         function pullUpAction() {
             getData();
         }
         function getData() {
             $("#pullUpIcon").html("<img src='images/loading.gif' />");
             generatedCount++;
             try {
                 $.ajax({
                     async: true,
                     url: "Report_JeuWJSAjax.php?page=" + generatedCount + "&r=07180357405102",
                     type: 'GET',
                     dataType: 'text',
                     cache: false,
                     timeout: 5000,
                     error: function (XMLHttpRequest, textStatus, errorThrown) { },
                     success: function (str) {
                         try {
                             if (str == "" || str==null) {
                                 $("#nodataTitle").css("display", "block");
                                 $("#linkTitle").css("display", "none");
                             }
                             else {
                                 $("#tableWJS").append(str);
                             }
                         } catch (e) { }
                         $("#pullUpIcon").html("");
                     }
                 })
             } catch (e) { }
         }
    </script>
        <div data-role="header" data-position="fixed">
            <a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext">
            </a>
            <h1>下注明細</h1>
            <a href="Main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide" data-direction="reverse"></a>
        </div>
        <div data-role="content" class="pm">
            <table class="tableBox" id="tableWJS">
                <tr>
                    <th width="24%">註單號/時間</th>
                    <th>類型</th>
                    <th>明細</th>
                    <th width="12%">金額</th>
                    <th width="12%">可贏</th>
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
        <?php }}if (count($result) <1) {?>
                <tr>
                    <td colspan="17">
                        <span>無記錄!!!</span>
                    </td>
                </tr>
                <? }?>
            </table>
            <div class="tdBg" style="font-size:13px; margin:0px 0 0 3px; line-height:22px;">合計:<b class="hong"><?php echo $countBNum?> </b>筆&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;總額:<b class="hong"><?php echo number_format($countTNum, 0,".","")?></b></div>
            <div id="pullUp" style="text-align: center; position: relative; width: 110px; margin:10px auto; font-size:14px; border: none;">
                <span id="pullUpIcon" style="position: absolute; top:0px; left:-12px;"></span><span id="linkTitle" <? if (count($result) <=$pageNum) echo 'style="display:none;"';?>><a href="javascript:void(0);" onclick="javascript:pullUpAction();">點擊獲取更多...</a></span><span id="nodataTitle" style="display: none;">無數據加載！</span>
            </div>
        </div>
<? include 'footer.php';?>
<? include 'left.php';?>
    </div>
</body>
</html>
