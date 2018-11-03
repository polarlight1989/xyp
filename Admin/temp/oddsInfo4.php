<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $ConfigModel,$Users;
$lm='xyft';
markPos("后台-极速赛车賠率設置");
if ($Users[0]['g_login_id'] != 89) 
	exit;

if (isset($Users[0]['g_lock_1_2'])){
	if ($Users[0]['g_lock_1_2'] !=1) 
		exit(back('您的權限不足！'));
}
if(!empty($_POST['pl']))
{
	$t=intval($_POST['pltype']);
	$pl=floatval($_POST['pl']);
	switch($t)
	{
		case 0:
			for($i=1;$i<=10;$i++)
			{
				$tmp=array();
				for($k=1;$k<=16;$k++)
					$tmp[]="h".$k."=".$pl;
				$sql="update g_odds4_default set ".join(",",$tmp)."  where g_type='Ball_{$i}'";
				$db->query($sql, 2);
			}
			break;	
		case 1:
			for($i=1;$i<=10;$i++)
			{
				$tmp=array();
				for($k=1;$k<=10;$k++)
					$tmp[]="h".$k."=".$pl;
				$sql="update g_odds4_default set ".join(",",$tmp)."  where g_type='Ball_{$i}'";
				$db->query($sql, 2);
			}
			break;	
		case 2:
			for($i=1;$i<=10;$i++)
			{
				$tmp=array();
				for($k=11;$k<=16;$k++)
					$tmp[]="h".$k."=".$pl;
				$sql="update g_odds4_default set ".join(",",$tmp)."  where g_type='Ball_{$i}'";
				$db->query($sql, 2);
			}
			break;
	}
	header("location:oddsInfo6.php");
}
function sSwitch($n){
	switch ($n){
		case 11: $n = '大';break;
		case 12: $n = '小';break;
		case 13: $n = '單';break;
		case 14: $n = '雙';break;
		case 15: $n = '龍';break;
		case 16: $n = '虎';break;
	}
	return $n;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/oddsInfo_xyft.js"></script>
</head>
<body>
<input type="hidden" id="s_odds" value="1" />
<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
  <tr>
    <td width="5" height="100%" bgcolor="#4F4F4F"></td>
    <td class="c"><table border="0" cellspacing="0" class="main">
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
          <td background="/Admin/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                <td width="185"><font style="font-weight:bold" color="#344B50">&nbsp;賠率設置 - 极速赛车賠率設置</font></td>
                <td align="right"><? include "oddsinfo_select.php";?></td>
              </tr>
            </table></td>
          <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
        </tr>
        <tr>
          <td class="t"></td>
          <td class="c"><!-- strat -->
            
            <table border="0" cellspacing="0" class="conter oddsbox">
              <tr>
                <th colspan="11">冠、亞軍 3-10名賠率</th>
              </tr>
              <tr class="tr_top">
                <td>號</td>
                <td>冠軍</td>
                <td>亞軍</td>
                <td>第三名</td>
                <td>第四名</td>
                <td>第五名</td>
                <td>第六名</td>
                <td>第七名</td>
                <td>第八名</td>
                <td>第九名</td>
                <td>第十名</td>
              </tr>
              <?php 
              for ($s=0; $s<16; $s++){
              	$css = array('color:#959612','color:#0188fe','color:#111111','color:#ff7300','color:#2dc3c2','color:#3500a8','color:#666666','color:#fe0000','color:#770101','color:#167301');
               $ball='ball';
               $i = $s+1;
               $m = sSwitch($i);
              ?>
              <tr align="center" >
                <td class="<?php echo $ball?>" style="<?php echo $css[$s]?>"><?php echo $m?></td>
                <td><input id="a_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="b_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="c_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="d_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="e_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="f_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="g_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="h_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="i_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="j_<?php echo $i?>" class="oddsval" /></td>
              </tr>
              <?php }?>
            </table>
            <form name="changeForm" method="post">
            <table border="0" cellspacing="0" style="width:600px" class="conter oddsbox">
              <tr>
                <td class="ball">賠率修改為：</td>
                <td><input type="text" name="pl" id="pl" value="0" style="width:80px"/></td>
                <td nowrap="nowrap">&nbsp;<input  checked="checked" style="width:auto" type="radio" name="pltype"  id="pltype" value="0"/>全部&nbsp;
                <input style="width:auto"type="radio" name="pltype" id="pltype" value="1"/>1~10號碼&nbsp;
                <input style="width:auto" type="radio" name="pltype" id="pltype" value="2"/>雙面&nbsp;</td>
                <td><input type="submit" name="changepl" id="changepl" value="確認"/></td>
              </tr>
            </table>
            </form>
            <table border="0" cellspacing="0" class="conter oddsbox" style="width:50%">
              <tr>
                <th colspan="7">組合賠率</th>
              </tr>
              <tr class="tr_top">
                <td width="70">號</td>
                <td>冠、亞軍和 指定</td>
                <td width="70">號</td>
                <td>冠、亞軍和 兩面</td>
              </tr>
              <tr align="center">
                <td>3</td>
                <td><input id="k_1" class="oddsval" /></td>
                <td>大</td>
                <td><input id="l_1" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>4</td>
                <td><input id="k_2" class="oddsval" /></td>
                <td>小</td>
                <td><input id="l_2" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>5</td>
                <td><input id="k_3" class="oddsval" /></td>
                <td>單</td>
                <td><input id="l_3" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>6</td>
                <td><input id="k_4" class="oddsval" /></td>
                <td>雙</td>
                <td><input id="l_4" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>7</td>
                <td><input id="k_5" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>8</td>
                <td><input id="k_6" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>9</td>
                <td><input id="k_7" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>10</td>
                <td><input id="k_8" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>11</td>
                <td><input id="k_9" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>12</td>
                <td><input id="k_10" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>13</td>
                <td><input id="k_11" class="oddsval" /></td>
              <tr align="center" >
                <td>14</td>
                <td><input id="k_12" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>15</td>
                <td><input id="k_13" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>16</td>
                <td><input id="k_14" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>17</td>
                <td><input id="k_15" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>18</td>
                <td><input id="k_16" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td>19</td>
                <td><input id="k_17" class="oddsval" /></td>
              </tr>
            </table>
            
            <!-- end --></td>
          <td class="r"></td>
        </tr>
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
          <td class="f" align="center">默認賠率表更變不會即時影響正在開盤中的賠率。</td>
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