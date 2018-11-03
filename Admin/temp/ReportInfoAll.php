<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';

global $ConfigModel,$Users;
	$db = new DB();
$total = $db->query("SELECT * FROM g_zhudand", 3);
$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("SELECT * FROM g_zhudand ORDER BY g_id DESC {$page->limit} ", 1);
markPos("后台-删改管理");	
	
if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_1'])){
	if ($Users[0]['g_lock_1_1'] !=1) 
		exit(back('您的權限不足！'));
}
if ($_SERVER["REQUEST_METHOD"] == "POST")

{	
	$db = new DB();
	$delid=$_POST['delid'];
	$old=$_POST['oldzd'];
	$qishu=$_POST['qishu'];
	$oldx=explode("@",$old);
   // $g_type=$oldx[0];
    //$mx1=$oldx[1];
	$mxxx=$oldx[2];	
	$oldxx=explode("$",$mxxx);
    //$mx2=$oldxx[0];
	//$rmb=$oldxx[1];
    $sql = " UPDATE `g_zhudan` SET `g_type` = '{$oldx[0]}', g_mingxi_1 = '{$oldx[1]}',`g_mingxi_2`='{$oldxx[0]}', `g_jiner` = '{$oldxx[1]}',`g_odds` = '{$oldxx[2]}',g_win = null  WHERE `g_id` = '{$delid}' LIMIT 1";
     $db->query($sql, 2);

	if ($oldx[0]=="廣東快樂十分"){
	include_once ROOT_PATH.'classed/SumOunt.php';
	$SumAmount = new SumAmount($qishu, false, $delid, true);
	$SumAmount->ResultAmount();
	}elseif ($oldx[0]=="重慶時時彩"){
    include_once ROOT_PATH.'functioned/opNumberList.php';
    include_once ROOT_PATH.'classed/SumOuntcq.php';
	$SumAmount = new SumAmountcq($qishu, false, $delid, true);
	$SumAmount->ResultAmount();
	}elseif ($oldx[0]=="北京赛车PK10"){
	include_once ROOT_PATH.'classed/SumOuntpk.php';
	$SumAmount = new SumAmountpk($qishu, false, $delid, true);
	$SumAmount->ResultAmount();
	}elseif ($oldx[0]=="吉林快3"){
	include_once ROOT_PATH.'classed/SumOuntjs.php';
	$SumAmount = new SumAmountjs($qishu, false, $delid, true);
	$SumAmount->ResultAmount();
	}

echo "<script>alert('注單還原成功!!');window.location.href='ReportInfoAll.php';</script>"; 
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Admin/temp/js/search.js"></script>
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function isForm(){
		if (confirm("確認更變嗎？"))
				return true;
		return false;
	}
-->
</script>
<script type="text/javascript">
<!--
	function selects($this){
		location.href = "delzhudan.php?id="+$this.value;
	}
//-->
</script>

</head>
<body onselectstart="return false">
	<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="5" height="100%" bgcolor="#4F4F4F"></td>
    <td class="c"><table border="0" cellspacing="0" class="main">
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
          <td background="/Admin/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                <td><font style="font-weight:bold" color="#344B50">&nbsp;脩改註單管理</font></td>	
									<td align="right" width="60">
									<select onchange = "window.location.href=this.options[selectedIndex].value">	
        <option value = "ReportInfoAll.php" style="color:Blue" selected>已改註單</option>
        <option value = "DelInfoAll.php" style="color:Blue">已刪註單</option>		
                                   </select> 
		  </td>									
              </tr>
          </table></td>
          <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
        </tr>
        <tr>
          <td class="t"></td>
          <td class="c"><!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<td width="12%" align="center">注單號/时间</td>
                                  <td align="center">下注類型</td>
                                  <td align="center">帳號</td>
                                  <td width="16%" align="center">下注明細</td>
                                  <td align="center">會員下注</td>
                                  <td align="center">會員輸贏</td>
                                  <td align="center">修改後結果</td>		
<td width="5%" align="center">代理</td> 
<td width="5%" align="center">總代理</td> 
<td width="5%" align="center">股東</td> 
<td width="5%" align="center">分公司</td> 
<td width="5%" align="center">總監</td> 								  
									 <td width="3%" align="center">功能</td> 
                                </tr>								
                              <?php
							  $now2=date("Y-m-d",strtotime("-1 day"));
							  $now3=$now2.' 00:00';
							  

               //// $total = $db->query("SELECT g_id FROM g_zhudan where g_date>'{$now3}'", 3);
              //  $pageNum = 20;
              //  $page = new Page($total, $pageNum);
                $result = $db->query("SELECT g_nid,g_date,g_type,g_qishu,g_jiner,g_odds,g_mingxi_1,g_mingxi_2,mxmd,g_id,g_win,mxsha1,g_tueishui,g_tueishui_1,g_tueishui_2,g_tueishui_3,g_tueishui_4,g_distribution,g_distribution_1,g_distribution_2,g_distribution_3,g_distribution_4 FROM g_zhudan  where g_date>'{$now3}'  ORDER BY g_id DESC  ", 1);

//dump($result);
for ($i=0;$i<count($result);$i++){

$checkout=md5($result[$i]['g_type']."@".$result[$i]['g_mingxi_1']."@".$result[$i]['g_mingxi_2']."$".$result[$i]['g_jiner'].$result[$i]['g_distribution_4']);

if ($checkout!=$result[$i]['mxsha1']){		
$mmxx1=explode("@",$result[$i]['mxmd']);					  
$mmxx2=explode("$",$mmxx1[2]);
$win = $result[$i]['g_win'] != null ? $result[$i]['g_win'] : '<span style="color:#0000FF">『 未結算 』</span>';
					  
?>
                           <tr style="height:38px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
							<form action="" method="post" onsubmit="return isForm()" >
							  <input type="hidden" name="delid" id="delid" value="<?php echo $result[$i]['g_id'];?>" />
                               <input type="hidden" name="qishu" id="qishu" value="<?php echo $result[$i]['g_qishu'];?>" />
                              <td width="12%" align="center" ><?php echo $result[$i]['g_id'];?>#<br><?php echo $result[$i]['g_date'];?></td>	
                              <td align="center" ><?php echo $result[$i]['g_type'];?><br><font color="#009900"><?php echo $result[$i]['g_qishu'];?>期</font></td>						   
                              <td align="center" ><?php echo $result[$i]['g_nid'];?></td>
                              <td width="16%" align="center" >&nbsp;<font color="blue"><?php echo $mmxx1[1];?>『<?php echo $mmxx2[0];?>』</font>@&nbsp;<font color="red"><B><?php echo $mmxx2[2];?></B><input type="hidden" name="oldzd" id="oldzd" value="<?php echo $result[$i]['mxmd'];?>" /></td>
                              <td align="right" ><?php echo $result[$i]['g_jiner'];?>&nbsp;</td>
                              <td align="right" ><?php echo $win?>&nbsp;</td>
                              <td align="center" ><font color="blue"><?php echo $result[$i]['g_mingxi_1'];?>『<?php echo $result[$i]['g_mingxi_2'];?>』</font>@&nbsp;<font color="red"><B><?php echo $result[$i]['g_odds'];?></B></font></td>
                              <td width="5%" align="center" ><b><?php echo $result[$i]['g_distribution'];?>%</b><br><?php echo $result[$i]['g_tueishui'];?></td>
                              <td width="5%" align="center" ><b><?php echo $result[$i]['g_distribution_1'];?>%</b><br><?php echo $result[$i]['g_tueishui_1'];?></td>
                              <td width="5%" align="center" ><b><?php echo $result[$i]['g_distribution_2'];?>%</b><br><?php echo $result[$i]['g_tueishui_2'];?></td>
                              <td width="5%" align="center" ><b><?php echo $result[$i]['g_distribution_3'];?>%</b><br><?php echo $result[$i]['g_tueishui_3'];?></td>
                              <td width="5%" align="center" ><b><?php echo $result[$i]['g_distribution_4'];?>%</b><br><?php echo $result[$i]['g_tueishui_4'];?></td>
                              <td width="3%" align="center" ><input style="color:red" type="submit"  value="还原" /></td>
							</form>	  
                          </tr>
                          <?php }}?>  
            </table>
            <!-- end -->
          </td>
          <td class="r"></td>
        </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="right"></td>
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