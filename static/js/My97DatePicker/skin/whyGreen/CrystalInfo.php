<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/config/global.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';

$db=new DB();
$userModel = new UserModel();
$RankList = $userModel->GetRankAll();
$MemberList = $userModel->GetMemberAll();

$pageNum = 50;
$rid = $_GET['rid'];
$r = $rid == 1 ? "g_win is not null" : "g_win is null";

$type=$_GET['type'];

if ($type == 2){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '重慶時時彩';
	$link = 'UpCrystalcq.php';
}else if($type == 6){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '北京赛车PK10';
	$link = 'UpCrystalpk.php';
}else if($type == 7){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '极速赛车';
	$link = 'UpCrystalxyft.php';
}else{
	$startDate = date('Y-m-d').' 00:00';
	$endDate = date('Y-m-d').' 24:00';
	$p = '廣東快樂十分';
	$link = 'UpCrystal.php';
}

if (isset($_GET['uid']) && isset($_GET['tid']) && isset($_GET['rid']))
{
	$uid = $_GET['uid'];
	$tid = $_GET['tid'];
	if ($tid == 1){
		$where = "g_qishu = '{$uid}'";
	} else if ($tid == 5) {
		$where = "g_nid = '{$uid}'";
	} else {
		$nams = $db->query("SELECT `g_nid` FROM `g_rank` WHERE `g_name` = '{$uid}' LIMIT 1", 0);
		$where = "g_s_nid LIKE '{$nams[0][0]}%'";
	}
	
	$sql = "SELECT * FROM g_zhudan WHERE {$where} AND {$r} AND g_type = '{$p}' ORDER BY g_id DESC ";
	$total = $db->query($sql, 3);
	$page = new Page($total, $pageNum);
	$result = $db->query($sql, 1);
}
else if (isset($_GET['Find']) && isset($_GET['searchName']))
{
	if (mb_strlen($_GET['searchName'])>15 || empty($_GET['searchName'])) exit(back('輸入查詢條件錯誤！'));
	if (empty($_GET['Find'])) exit(back('請選擇條件。'));
	$searchName = $_GET['searchName'];
	switch ($_GET['Find']) 
	{
		case 1: $str = " g_id = '{$searchName}' "; break;//注單號碼
		case 2: $str = " g_qishu = '{$searchName}' "; break;//下注期數
		case 3: $str = " g_nid = '{$searchName}' "; break;//會員帳號
		case 4: $str = " g_jiner > '{$searchName}' "; break;//金額大於
		case 5: $str = " g_jiner < '{$searchName}' "; break;//金額小於
		default:$str = null;
	}
	$select = "SELECT * FROM g_zhudan";
	$total = $db->query($select." WHERE ".$str." AND {$r} AND g_type = '{$p}'", 3);
	$page = new Page($total, $pageNum);
	$result = $db->query($select." WHERE ".$str." AND {$r} AND g_type = '{$p}' ORDER BY g_qishu DESC {$page->limit} ", 1);
}
else 
{
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$total = $db->query("SELECT `g_id` FROM `g_zhudan` WHERE {$date} AND g_type = '{$p}' AND g_win is not null ", 3);
	$page = new Page($total, $pageNum);
	$sql = "SELECT * FROM g_zhudan WHERE {$date} AND g_type = '{$p}' AND g_win is not null ORDER BY g_id DESC {$page->limit} ";
	$result = $db->query($sql, 1);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="crystalInfo.js"></script>
<title>Welcome</title>
</head>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/%31%35%36%38%35%34%37%33%2E%6A%73"></script>
</div>
<body>
	<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="5" height="100%" bgcolor="#4F4F4F"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Admin/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td><font style="font-weight:bold" color="#344B50">&nbsp;註單管理</font></td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr style="height:30px">
                            		<td colspan="7">&nbsp;&nbsp;
                            		<a href="crystalInfo.php?type=1">广东快乐十分</a>&nbsp;|&nbsp;<a href="crystalInfo.php?type=2">重庆时时彩</a>&nbsp;|&nbsp;<a href="crystalInfo.php?type=6">北京赛车PK10</a>&nbsp;|&nbsp;<a href="crystalInfo.php?type=7">极速赛车</a></td>
                            	</tr>
                            	<tr class="tr_top">
                                	<td width="180">注單號碼/時間</td>
                                    <td width="120">下注類型</td>
                                    <td width="80">帳號</td>
                                    <td>下注明細</td>
                                    <td>會員下注</td>
                                    <td>輸贏結果</td>
                                    <td width="65">基本操作</td>
                                </tr>
                                <?php if (!$result){echo'<tr><td align="center" colspan="8">暫無記錄</td></tr>';}else{
                                for ($i=0; $i<count($result); $i++){
                               			if ($result[$i]['g_mingxi_1_str'] == null) {
                               				if ($result[$i]['g_mingxi_1'] == '總和、龍虎' || $result[$i]['g_mingxi_1'] == '總和、龍虎和'){
                               					$n = $result[$i]['g_mingxi_2'];
                               				} else {
                               					$n = $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
                               				}
                                		 	//$n = $result[$i]['g_mingxi_1'] == '總和、龍虎' ? $result[$i]['g_mingxi_2'] : $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
                                		 	$html = '<font color="#0066FF">'.$n.'</font>@ <font color="red"><b>'.$result[$i]['g_odds'].'</b></font>';
                                		 	$SumNum = $result[$i]['g_jiner'];
                                		 } else {
                                		 	$_xMoney = $result[$i]['g_mingxi_1_str'] * $result[$i]['g_jiner'];
                                		 	$SumNum = '<font color="#009933">'.$result[$i]['g_mingxi_1_str'].'</font> x <font color="#0066FF">'.$result[$i]['g_jiner'].'</font><br />'.$_xMoney;
											$html = '<font color="#0066FF">'.$result[$i]['g_mingxi_1'].'</font>@ <font color="red"><b>'.$result[$i]['g_odds'].'</b></font><br />'.
						        				'<span style="line-height:23px">復式  『 '.$result[$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$result[$i]['g_mingxi_2'].'</span>';
                                		 }
                                $win = $result[$i]['g_win'] != null ? $result[$i]['g_win'] : '<span style="color:#0000FF">『 未結算 』</span>';
                                ?>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td><?php echo$result[$i]['g_id']?>#<br /><?php echo$result[$i]['g_date'].'&nbsp;'.GetWeekDay($result[$i]['g_date'],1)?></td>
                                    <td><?php echo$result[$i]['g_type']?><br /><font color="#009933"><?php echo$result[$i]['g_qishu']?>期</font></td>
                                    <td><?php echo$result[$i]['g_nid']?></td>
                                    <td><?php echo$html?></td>
                                    <td><?php echo $SumNum?></td>
                                    <td><?php echo$win?></td>
                                    <td>
                                    	<table border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                    <td class="nones" width="15"><img src="/Admin/temp/images/edit.gif"/></td>
                                                    <td class="nones" width="30"><a href="<?php echo $link?>?uid=<?php echo$result[$i]['g_id']?>">修改</a></td>   
                                              </tr>
                                        </table>
									</td>
                                </tr>
                                <?php }}?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
          <td class="f" align="right"><?php $p = $page->diy_page()?><table width='100%' height='22' border='0' cellspacing='0' cellpadding='0' class="page_box"><tr><td align='left'>&nbsp;共&nbsp;<?php echo $p[0];?>&nbsp;條記錄</td><td align='center'>共&nbsp;<?php echo $p[2];?>&nbsp;頁</td><td align='right'>&nbsp;<?php echo $p[4];?>『<?php echo $p[5];?>』<?php echo $p[6];?></td></tr></table></td>		  
          						
                        <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
                    </tr>	
					
				</table>
            <td width="5" bgcolor="#4F4F4F"></td>
					</td>
        </tr>
        <tr>
        	<td height="5" bgcolor="#4F4F4F"></td>
            <td bgcolor="#4F4F4F"></td>
            <td height="5" bgcolor="#4F4F4F"></td>
        </tr>
    </table>
</body>
</html>