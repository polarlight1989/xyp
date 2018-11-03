<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
global $Users, $ConfigModel;
if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_6'])){
	if ($Users[0]['g_lock_1_6'] !=1) 
		exit(back('您的權限不足！'));
}

$db=new DB();
$lm='pk10';
markPos("后台-北京盘口设置");

if (isset($_GET['delid']) && Matchs::isNumber($_GET['delid']))
{
	$delid = $_GET['delid'];
	$id = $db->query("SELECT g_lock FROM g_kaipan6 WHERE g_id = '{$delid}' LIMIT 1 ", 0);
	if ($id)
	{
		$db->query("DELETE FROM g_kaipan6 WHERE g_id = '{$delid}' LIMIT 1", 2);
		exit(alert_href('刪除成功', 'openNumbers_pk.php'));
	}
	else 
	{
		exit(back($delid.' ID 不存在！'));
	}
}
if (isset($_GET['openid']) && Matchs::isNumber($_GET['openid']))
{
	$openid = $_GET['openid'];
	$openids = $db->query("SELECT g_lock FROM g_kaipan6 WHERE g_qishu = '{$openid}' LIMIT 1 ", 0);
	if ($openids)
	{
		$db->query("DELETE FROM g_kaipan6 WHERE g_qishu < '{$openid}' ", 2);
		$db->query("UPDATE g_kaipan6 SET g_lock = 2 WHERE g_qishu = '{$openid}' LIMIT 1 ", 2);
		exit(alert_href('操作成功', 'NumberInclude.php'));
	}
} 
if (isset($_GET['inserid']) && Matchs::isNumber($_GET['inserid']))
{
	$inserid = $_GET['inserid'];
	InsertNumber_pk10($inserid, $ConfigModel['g_close_time']);
	exit(alert_href('操作成功', 'NumberInclude.php'));
}
$result=mysql_query("select * from g_kaipan6  order by g_qishu desc LIMIT 1");
$row=mysql_fetch_array($result);  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style2 {
	color: #ffffff
}
.STYLE3 {
	color: #FF3300
}
-->
</style>
<script type="text/javascript">
<!--
	function delNumber(id, sInt){
		var href, lock=false;
		if (sInt == 1){
			if (confirm("警告：沒必要情況下建議不要操作。\n你確定刪除嗎？")){
				href = "?delid=";
				lock =true;
			}
		} else if (sInt == 2) {
			if (confirm("警告：系統將會自動刪除 "+id+" 之前的期數。\n你確定開盤嗎？")){
				href = "?openid=";
				lock =true;
			}
		} else {
			if (confirm("警告：系統將會自動重新加載179期，開獎、封盤時間。\n你確定嗎？")){
				href = "?inserid=";
				id = document.getElementById("day").value;
				lock =true;
			}
		}
		if (lock==true)
			location.href = location.href + href +id;
	}
-->
</script>
</head>
<body>
<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
  <tr>
    <td width="5" height="100%" bgcolor="#4F4F4F"></td>
    <td class="c"><table border="0" cellspacing="0" class="main">
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
          <td background="/Admin/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                <td><font style="font-weight:bold" color="#344B50">&nbsp;開盤設置--北京赛车PK10</font></td>
                <td align="right" width="100"><? include "openNumbers_select.php";?></td>
              </tr>
            </table></td>
          <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
        </tr>
        <tr>
          <td class="t"></td>
          <td class="c"><table border="0" cellspacing="0" class="conter">
              <tr class="tr_top">
                <th colspan="2">北京赛车PK10</th>
              </tr>
              <tr>
                <td height="36" class="bj">設置說明</td>
                <td id="showTxt" class="left_p6"  style="color:#0000FF;">開盤時間與封盤時間為第一期開始計算、179期封盤后系統默認自動加載明天開盤列表。</td>
              </tr>
              <tr>
                <td height="36" class="bj">總期數</td>
                <td class="left_p6"><input name="number" type="text" id="number" style="width:50px;" onfocus="this.className='inp1m'" onblur="this.className='inp1'" class="inp1" value="179" /></td>
              </tr>
              <tr>
                <td height="36" class="bj">封盤時間</td>
                <td class="left_p6"><input name="stratTime" type="text" id="stratTime" style="width:110px;" onfocus="this.className='inp1m'" onblur="this.className='inp1'" class="inp1" value="09-29 09:06:30" /></td>
              </tr>
              <tr>
                <td height="36" class="bj">開獎時間</td>
                <td class="left_p6"><input name="endTime" type="text" id="endTime" style="width:110px;" onfocus="this.className='inp1m'" onblur="this.className='inp1'" class="inp1" value="09-29 09:08:00" /></td>
              </tr>
              <tr align="center" style="background:#F6FAFF; height:28px;">
                <td colspan="2"><input type="submit" class="inputs" onclick="delNumber(1, 3)" value="加載盤口" /></td>
              </tr>
            </table>
            <table border="0" cellspacing="0" class="conter">
              <tr class="tr_top">
                <td width="4%">ID</td>
                <td>开盤期數</td>
                <td>开盤時間</td>
                <td>封盤時間</td>
                <td>开奖時間</td>
                <td width="150">狀態</td>
                <td width="120">基本操作</td>
              </tr>
              <?php	
		 $result = mysql_query("SELECT `g_id`, `g_qishu`, `g_feng_date`, `g_open_date`, `g_kai_date`, `g_lock` FROM `g_kaipan6` ORDER BY g_qishu ASC "); 
		 
									if (!$result){echo '<tr><td align="center" colspan="7">暫無記錄</td></tr>';}
                                	else {		 
		   
									$ii=0;
									while($rs = mysql_fetch_array($result)){

									$ii++;

									if ($rs['g_lock'] == 2){
                                		$lock =  '<span class="odds">正在開盤...</span>';
                                		$open = '<span class="red">已開</span>';
                                	} else {
                                		$lock =  '<span class="green">等待狀態</span>';
                                		$open ="<a href=\"javascript:void(0)\" onclick=\"delNumber('{$rs['g_qishu']}','2')\">開盤</a>";
                                	}



?>
              <tr align="center" style="height:28px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                <td><?php echo $ii?></td>
                <td><?php echo $rs['g_qishu']?></td>
                <td><?php echo $rs['g_kai_date']?></td>
                <td><?php echo $rs['g_feng_date']?></td>
                <td style="color:red"><?php echo $rs['g_open_date']?></td>
                <td><?php echo $lock?></td>
                <td><table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="nones" width="15"><img src="/Admin/temp/images/edit.gif"/></td>
                      <td class="nones" width="30"><?php echo $open?></td>
                      <td class="nones" width="16"><img src="/Admin/temp/images/55.gif" /></td>
                      <td class="nones" width="30"><a href="javascript:void(0)" onclick="delNumber('<?php echo $rs['g_id']?>','1')">刪除</a></td>
                    </tr>
                  </table>
              </tr>
              <?php 
	  }
	  }
	  ?>
            </table></td>
          <td class="r"></td>
        </tr>
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
          <td class="f" align="center"><span class="odds">（注意：系統會自動加載1-84期號碼）</span> 天:
            <input type="text" value="0" id="day" class="texta" />
            <input type="submit" class="inputs" onclick="delNumber(1, 3)" value="加載盤口" /></td>
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
<br />
</body>
</html>
