<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $ConfigModel,$Users;
$lm='tjssc';
markPos("后台-天津賠率設置");
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
			for($i=1;$i<=5;$i++)
			{
				$tmp=array();
				for($k=1;$k<=14;$k++)
					$tmp[]="h".$k."=".$pl;
				$sql="update g_odds11_default set ".join(",",$tmp)."  where g_type='Ball_{$i}'";
				$db->query($sql, 2);
			}
			break;	
		case 1:
			for($i=1;$i<=5;$i++)
			{
				$tmp=array();
				for($k=1;$k<=10;$k++)
					$tmp[]="h".$k."=".$pl;
				$sql="update g_odds11_default set ".join(",",$tmp)."  where g_type='Ball_{$i}'";
				$db->query($sql, 2);
			}
			break;	
		case 2:
			for($i=1;$i<=5;$i++)
			{
				$tmp=array();
				for($k=11;$k<=14;$k++)
					$tmp[]="h".$k."=".$pl;
				$sql="update g_odds11_default set ".join(",",$tmp)."  where g_type='Ball_{$i}'";
				$db->query($sql, 2);
			}
			break;
	}
	header("location:oddsInfojx.php");
}
function sSwitch($n){
	switch ($n){
		case 10: $n = '大';break;
		case 11: $n = '小';break;
		case 12: $n = '單';break;
		case 13: $n = '雙';break;
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
<script type="text/javascript" src="js/oddsInfo_tj.js"></script>
<title></title>
</head>
<body>
<input type="hidden" id="s_odds" value="1" />
<table width="99%" height="100%" border="0" cellspacing="0" class="a">
  <tr>
    <td class="c"><table border="0" cellspacing="0" class="main">
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
          <td background="/Admin/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                <td width="155"><font style="font-weight:bold" color="#344B50">&nbsp;賠率設置 - 天津賠率設置</font></td>
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
                <th colspan="6">1-5球賠率</th>
              </tr>
              <tr class="tr_top">
                <td>號</td>
                <td>第一球</td>
                <td>第二球</td>
                <td>第三球</td>
                <td>第四球</td>
                <td>第五球</td>
              </tr>
              <?php 
              for ($s=0; $s<14; $s++){
               $ball='ball';
               if(mb_strlen($s) == 1){$n = '0'.$s;} else {$n = $s;}
               $m = sSwitch($n);
               $i = $s+1;
              ?>
              <tr align="center" >
                <td class="<?php echo $ball?>"><?php echo $m?></td>
                <td><input id="a_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="b_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="c_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="d_<?php echo $i?>" class="oddsval" /></td>
                <td><input id="e_<?php echo $i?>" class="oddsval" /></td>
              </tr>
              <?php }?>
            </table>
            <form name="changeForm" method="post">
            <table border="0" cellspacing="0" style="width:600px" class="conter oddsbox">
              <tr>
                <td class="ball">賠率修改為：</td>
                <td><input type="text" name="pl" id="pl" value="0" style="width:80px"/></td>
                <td nowrap="nowrap">&nbsp;<input  checked="checked" style="width:auto" type="radio" name="pltype"  id="pltype" value="0"/>全部&nbsp;
                <input style="width:auto"type="radio" name="pltype" id="pltype" value="1"/>0~9號碼&nbsp;
                <input style="width:auto" type="radio" name="pltype" id="pltype" value="2"/>雙面&nbsp;</td>
                <td><input type="submit" name="changepl" id="changepl" value="確認"/></td>
              </tr>
            </table>
            </form>
            <table border="0" cellspacing="0" class="conter oddsbox">
              <tr>
                <th colspan="14">總分龍虎和連碼賠率</th>
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
              <tr align="center" >
                <td class="ball">總和大</td>
                <td><input id="f_1" class="oddsval" /></td>
                <td class="ball">總和小</td>
                <td><input id="f_2" class="oddsval" /></td>
                <td class="ball">總和單</td>
                <td><input id="f_3" class="oddsval" /></td>
                <td class="ball">總和雙</td>
                <td><input id="f_4" class="oddsval" /></td>
                <td class="ball">龍</td>
                <td><input id="f_5" class="oddsval" /></td>
                <td class="ball">虎</td>
                <td><input id="f_6" class="oddsval" /></td>
                <td class="ball">和</td>
                <td><input id="f_7" class="oddsval" /></td>
              </tr>
            </table>
            <table border="0" cellspacing="0" class="conter oddsbox">
              <tr>
                <th colspan="10">前三</th>
              </tr>
              <tr align="center" >
                <td class="ball">豹子</td>
                <td><input id="g_1" class="oddsval" /></td>
                <td class="ball">順子</td>
                <td><input id="g_2" class="oddsval" /></td>
                <td class="ball">對子</td>
                <td><input id="g_3" class="oddsval" /></td>
                <td class="ball">半順</td>
                <td><input id="g_4" class="oddsval" /></td>
                <td class="ball">雜六</td>
                <td><input id="g_5" class="oddsval" /></td>
              </tr>
            </table>
            <table border="0" cellspacing="0" class="conter oddsbox">
              <tr>
                <th colspan="10">中三</th>
              </tr>
              <tr align="center" >
                <td class="ball">豹子</td>
                <td><input id="h_1" class="oddsval" /></td>
                <td class="ball">順子</td>
                <td><input id="h_2" class="oddsval" /></td>
                <td class="ball">對子</td>
                <td><input id="h_3" class="oddsval" /></td>
                <td class="ball">半順</td>
                <td><input id="h_4" class="oddsval" /></td>
                <td class="ball">雜六</td>
                <td><input id="h_5" class="oddsval" /></td>
              </tr>
            </table>
            <table border="0" cellspacing="0" class="conter oddsbox">
              <tr>
                <th colspan="10">后三</th>
              </tr>
              <tr align="center" >
                <td class="ball">豹子</td>
                <td><input id="i_1" class="oddsval" /></td>
                <td class="ball">順子</td>
                <td><input id="i_2" class="oddsval" /></td>
                <td class="ball">對子</td>
                <td><input id="i_3" class="oddsval" /></td>
                <td class="ball">半順</td>
                <td><input id="i_4" class="oddsval" /></td>
                <td class="ball">雜六</td>
                <td><input id="i_5" class="oddsval" /></td>
              </tr>
            </table></td>
          <td class="r"></td>
        </tr>
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
          <td class="f" align="center">默認賠率表更變不會即時影響正在開盤中的賠率。</td>
          <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>