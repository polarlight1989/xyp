<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
global $Users, $ConfigModel;
markPos("后台-公告管理");
if ($Users[0]['g_login_id'] != 89) exit;
if ($LoginId== 89){
$resulth = $db->query("SELECT g_gg FROM j_manage where g_name='{$name}'  ORDER BY g_id DESC LIMIT 1 ", 0);
} 

if ($resulth[0][0] != 1) exit(back('您的權限不足！'));
if ($ConfigModel['g_news_lock'] != 1) exit(back('您的權限不足！'));
$db=new DB();
$cid=0; $Editors =null; $NumberShow=0; $g_number_alert_show=0; $RankShow=0;


$total = $db->query("SELECT * FROM g_news", 3);
$pageNum = 10;
$page = new Page($total, $pageNum);
$result = $db->query("SELECT * FROM g_news ORDER BY g_id DESC {$page->limit} ", 1);
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (empty($_POST['Editors'])) exit(back('請填寫公告內容！'));
	if (mb_strlen($_POST['Editors'], 'utf-8')>500) exit(back('內容最大字符200個。'));
	$news = array();
	$news['Editors'] = $_POST['Editors'];
	$news['NumberShow'] = empty($_POST['NumberShow']) ? 0 : 1;
	$news['NumberAlertShow'] = empty($_POST['NumberAlertShow']) ? 0 : 1;
	$news['RankShow'] = empty($_POST['RankShow']) ? 0 : 1;
	$cid = isset($_GET['cid']) ? $_GET['cid'] : 0;
	if ($ConfigModel['g_news_lock'] == 1 && $cid == 0){
		$sql = "INSERT INTO g_news (g_text,g_date,g_number_show,g_number_alert_show,g_rank_show) VALUES (
		'{$news['Editors']}',
		now(),
		'{$news['NumberShow']}',
		'{$news['NumberAlertShow']}',
		'{$news['RankShow']}')";
		$db->query($sql, 2);
		exit(back('寫入成功。'));
	} else {
		//print_r("UPDATE g_news SET g_text = '{$news['Editors']}', g_number_show = '{$news['NumberShow']}', g_number_alert_show = '{$news['NumberAlertShow']}', g_rank_show  = '{$news['RankShow']}' WHERE g_id = '{$cid}' LIMIT 1 ");exit;
		if ($db->query("SELECT g_text FROM g_news WHERE g_id = '{$cid}' LIMIT 1", 0)){
			$db->query("UPDATE g_news SET g_text = '{$news['Editors']}', g_number_show = '{$news['NumberShow']}', g_number_alert_show = '{$news['NumberAlertShow']}', g_rank_show  = '{$news['RankShow']}' WHERE g_id = '{$cid}' LIMIT 1 ", 2);
			exit(alert_href('更變成功。', 'newsInfo.php'));
		}
	}
}
else if (isset($_GET['cid']) && !isset($_GET['page']))
{
	if (Matchs::isNumber($_GET['cid'])){
		$cid=1;
		$text = $db->query("SELECT * FROM g_news WHERE g_id = '{$_GET['cid']}' LIMIT 1", 1);
		if($text){
			$Editors = $text[0]['g_text'];
			$NumberShow = $text[0]['g_number_show'];
			$NumberAlertShow  = $text[0]['g_number_alert_show'];
			$RankShow = $text[0]['g_rank_show'];
		}
	}
}
else if (isset($_GET['delid']))
{
	$delid = $_GET['delid'];
	if ($db->query("SELECT g_text FROM g_news WHERE g_id = '{$delid}' LIMIT 1", 0)){
		$db->query("DELETE FROM g_news WHERE g_id ='{$delid}' LIMIT 1", 2);
		exit(back('刪除成功。'));
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/static/css/base.css" rel="stylesheet" type="text/css">
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/Topjavascript.js"></script>
<title></title>
</head>
<body onselectstart="return false">
<form action="" method="post">
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
                                    <td width="16"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td><font style="font-weight:bold" color="#344B50">&nbsp;公告設置</font></td>
                                    <td align="right" width="18"><img src="images/22.gif" width="14" height="14" /></td>
                                    <td align="right" width="50"><a href="newsAdd.php">新增公告</a></td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                <table border="1" cellspacing="0" class="conter" style="width:100%;margin:2 auto">
                	<tr class="tr_top">
                		<td width="90">ID</td>
                		<td width="12%">貼出時間</td>
                		<td>消息詳情</td>
                		<td width="60">提示窗</td>
                		<td width="60">代理公告 </td>
                		<td width="60">會員公告</td>						
                		<td width="100">基本操作</td>
                	</tr>
                	<?php if(!$result){echo'<td align="center" colspan="7"><font color="red"><b>當前暫無公告······</b></font></td>';}else{
                	for ($i=0; $i<count($result); $i++){
                	?>
                	<tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                		<td><?php echo $i+1?></td>
                		<td><?php echo $result[$i]['g_date']?></td>
                		<td class="left_p6" align="center"><?php echo $result[$i]['g_text']?></td>
                		<td><?php echo $result[$i]['g_number_alert_show'] == 1 ? '<span class="oddsalai">啟用</span>' : '<span class="red">關閉</span>';?></td>
                		<td><?php echo $result[$i]['g_rank_show'] == 1 ? '<span class="oddsalai">啟用</span>' : '<span class="red">關閉</span>';?></td>
						<td><?php echo $result[$i]['g_number_show'] == 1 ? '<span class="oddsalai">啟用</span>' : '<span class="red">關閉</span>';?></td>
                		<td>
                		<table border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                 <td class="nones" width="14" height="18"><img src="/Admin/temp/images/edt.gif"/></td>
                                  <td class="nones" width="30"><a href="newsAdd.php?cid=<?php echo $result[$i]['g_id']?>">修改</a></td>
                                  <td class="nones" width="15"><img src="/Admin/temp/images/edit.gif"/></td>
                                  <td class="nones" width="30"><a href="javascript:if(confirm('確定刪除嗎？')){location.href= 'newsInfo.php?delid=<?php echo $result[$i]['g_id']?>'}">刪除</a></td>
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
                        <td class="f" align="right"><?php $p = $page->diy_page()?><table width='100%' height='22' border='0' cellspacing='0' cellpadding='0' class="page_box"><tr><td align='left'>&nbsp;共&nbsp;<?php echo $p[0];?>&nbsp;條公告</td><td align='center'>共&nbsp;<?php echo $p[2];?>&nbsp;頁</td><td align='right'>&nbsp;<?php echo $p[4];?>『<?php echo $p[5];?>』<?php echo $p[6];?></td></tr></table></td>
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
</form>
</body>
</html>