<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $ConfigModel,$Users;
$lm='gdklsf';
if ($Users[0]['g_login_id'] != 89) 
	exit;
markPos("后台-广东賠率設置");
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
			for($i=1;$i<=8;$i++)
			{
				$tmp=array();
				for($k=1;$k<=35;$k++)
					$tmp[]="h".$k."=".$pl;
				$sql="update g_odds_default set ".join(",",$tmp)."  where g_type='Ball_{$i}'";
				$db->query($sql, 2);
			}
			break;	
		case 1:
			for($i=1;$i<=8;$i++)
			{
				$tmp=array();
				for($k=1;$k<=20;$k++)
					$tmp[]="h".$k."=".$pl;
				$sql="update g_odds_default set ".join(",",$tmp)."  where g_type='Ball_{$i}'";
				$db->query($sql, 2);
			}
			break;	
		case 2:
			for($i=1;$i<=8;$i++)
			{
				$tmp=array();
				for($k=21;$k<=28;$k++)
					$tmp[]="h".$k."=".$pl;
				$sql="update g_odds_default set ".join(",",$tmp)."  where g_type='Ball_{$i}'";
				$db->query($sql, 2);
			}
			break;
		case 3:
			for($i=1;$i<=8;$i++)
			{
				$tmp=array();
				for($k=29;$k<=35;$k++)
					$tmp[]="h".$k."=".$pl;
				$sql="update g_odds_default set ".join(",",$tmp)."  where g_type='Ball_{$i}'";
				$db->query($sql, 2);
			}
			break;
	}
	header("location:oddsInfo.php");
}
function sSwitch($n){
	switch ($n){
		case 21: $n = '大';break;
		case 22: $n = '小';break;
		case 23: $n = '單';break;
		case 24: $n = '雙';break;
		case 25: $n = '尾大';break;
		case 26: $n = '尾小';break;
		case 27: $n = '合數單';break;
		case 28: $n = '合數雙';break;
		case 29: $n = '東';break;
		case 30: $n = '南';break;
		case 31: $n = '西';break;
		case 32: $n = '北';break;
		case 33: $n = '中';break;
		case 34: $n = '發';break;
		case 35: $n = '白';break;
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
<script type="text/javascript" src="js/oddsInfo.js"></script>
<title></title>
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
                <td><font style="font-weight:bold" color="#344B50">&nbsp;賠率設置 - 广东賠率設置</font></td>
                <td align="right">
                <? include "oddsinfo_select.php";?>
</td>
              </tr>
            </table></td>
          <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
        </tr>
        <tr>
          <td class="t"></td>
          <td class="c"><!-- strat -->
            
            <table border="0" cellspacing="0" class="conter oddsbox">
              <tr>
                <th colspan="9">1-8球賠率</th>
              </tr>
              <tr class="tr_top">
                <td>號</td>
                <td>第一球</td>
                <td>第二球</td>
                <td>第三球</td>
                <td>第四球</td>
                <td>第五球</td>
                <td>第六球</td>
                <td>第七球</td>
                <td>第八球</td>
              </tr>
              <?php 
              for ($i=1; $i<=35; $i++){
                if ($i == 19 || $i == 20){$ball = 'red'; }else {$ball='ball';}
                if(mb_strlen($i) == 1){$n = '0'.$i;} else {$n = $i;}
                $m = sSwitch($n);
              ?>
              <tr>
                <td class="<?php echo $ball?>"><?php echo $m?></td>
                <td><input id="a_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="b_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="c_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="d_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="e_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="f_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="g_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="h_<?php echo $i?>" class="oddsval" /></td>
              </tr>
              <?php }?>
            </table>
            <form name="changeForm" method="post">
            <table border="0" cellspacing="0" style="width:600px" class="conter oddsbox">
              <tr>
                <td class="ball">賠率修改為：</td>
                <td><input type="text" name="pl" id="pl" value="0" style="width:80px"/></td>
                <td nowrap="nowrap">&nbsp;<input  checked="checked" style="width:auto" type="radio" name="pltype"  id="pltype" value="0"/>全部&nbsp;
                <input style="width:auto"type="radio" name="pltype" id="pltype" value="1"/>1~20號碼&nbsp;
                <input style="width:auto" type="radio" name="pltype" id="pltype" value="2"/>雙面&nbsp;
                <input style="width:auto" type="radio" name="pltype" id="pltype" value="3"/>其他(東~白)&nbsp;</td>
                <td><input type="submit" name="changepl" id="changepl" value="確認"/></td>
              </tr>
            </table>
            </form>
            <table border="0" cellspacing="0" class="conter oddsbox">
              <tr>
                <th colspan="14">總分龍虎連碼賠率</th>
              </tr>
              <tr class="tr_top">
                <td>號</td>
                <td>賠率</td>
                <td>號</td>
                <td>賠率</td>
                <td>號</td>
                <td>賠率</td>
                <td>號</td>
                <td>賠率</td>
                <td>號</td>
                <td>賠率</td>
                <td>號</td>
                <td>賠率</td>
                <td>號</td>
                <td>賠率</td>
              </tr>
              <tr>
                <td class="ball">總和大</td>
                <td><input id="i_1" class="oddsval" /></td>
                <td class="ball">總和小</td>
                <td><input id="i_3" class="oddsval" /></td>
                <td class="ball">總和單</td>
                <td><input id="i_2" class="oddsval" /></td>
                <td class="ball">總和雙</td>
                <td><input id="i_4" class="oddsval" /></td>
                <td class="ball">總和尾大</td>
                <td><input id="i_5" class="oddsval" /></td>
                <td class="ball">總和尾小</td>
                <td><input id="i_7" class="oddsval" /></td>
                <td class="ball">龍</td>
                <td><input id="i_6" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td class="ball">虎</td>
                <td><input id="i_8" class="oddsval" /></td>
                <td class="ball">任選二</td>
                <td><input id="j_1" class="oddsval" /></td>
                <td class="ball">選二連組</td>
                <td><input id="j_3" class="oddsval" /></td>
                <td class="ball">任選三</td>
                <td><input id="j_4" class="oddsval" /></td>
                <td class="ball">選三前組</td>
                <td><input id="j_6" class="oddsval" /></td>
                <td class="ball">任選四</td>
                <td><input id="j_7" class="oddsval" /></td>
                <td class="ball">任選五</td>
                <td><input id="j_8" class="oddsval" /></td>
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