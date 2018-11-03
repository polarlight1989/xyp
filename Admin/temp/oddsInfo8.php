<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
markPos("后台-吉林賠率設置");
//echo "22";
$lm='kl8';
$db=new DB();
$sql = "SELECT `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`,`h15` FROM g_odds8_default  ORDER BY g_id";
$result = $db->query($sql, 0);

//echo $result[5][1];
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
			$tmp=array();
			for($k=1;$k<=80;$k++)
				$tmp[]="h".$k."=".$pl;
			$sql="update g_odds8_default set ".join(",",$tmp)."  where g_type='Ball_1'";
			$db->query($sql, 2);
			$sql="update g_odds8_default set h1=$pl,h2=$pl  where g_type='Ball_2'";
			$db->query($sql, 2);
			$sql="update g_odds8_default set h1=$pl,h2=$pl  where g_type='Ball_3'";
			$db->query($sql, 2);
			$sql="update g_odds8_default set h1=$pl,h2=$pl,h3=$pl,h4=$pl where g_type='Ball_5'";
			$db->query($sql, 2);
			break;	
		case 1:
			$tmp=array();
			for($k=1;$k<=80;$k++)
				$tmp[]="h".$k."=".$pl;
			$sql="update g_odds8_default set ".join(",",$tmp)."  where g_type='Ball_1'";
			$db->query($sql, 2);
			break;	
		case 2:
			$sql="update g_odds8_default set h1=$pl,h2=$pl  where g_type='Ball_2'";
			$db->query($sql, 2);
			$sql="update g_odds8_default set h1=$pl,h2=$pl  where g_type='Ball_3'";
			$db->query($sql, 2);
			$sql="update g_odds8_default set h1=$pl,h2=$pl,h3=$pl,h4=$pl where g_type='Ball_5'";
			$db->query($sql, 2);
			break;
	}
	header("location:oddsInfo8.php");
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
<script type="text/javascript" src="js/oddsInfokl8.js"></script>
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
                <td><font style="font-weight:bold" color="#344B50">&nbsp;賠率設置 - 快樂8賠率設置</font></td>
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
                <th colspan="9">正碼賠率</th>
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
              </tr>
              <?php 
              for ($i=1; $i<=20; $i++){
                if(mb_strlen($i) == 1){$n = '0'.$i;} else {$n = $i;}
              ?>
              <tr>
                <td class="<?php echo $ball?>"><?php echo $n?></td>
                <td><input id="a_<?php echo $i?>" class="oddsval" /></td>
                <td><?php echo ($i+20)?></td>
                <td><input id="a_<?php echo $i+20?>" class="oddsval" /></td>
				<td><?php echo ($i+40)?></td>
                <td><input id="a_<?php echo $i+40?>" class="oddsval" /></td>
                <td><?php echo ($i+60)?></td>
                <td><input id="a_<?php echo $i+60?>" class="oddsval" /></td>
              </tr>
              <?php }?>
            </table>
            <table border="0" cellspacing="0" class="conter oddsbox">
              <tr>
                <th colspan="14">總和大</th>
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
              </tr>
              <tr>
                <td class="ball">總和大</td>
                <td><input id="b_1" class="oddsval" /></td>
                <td class="ball">總和小</td>
                <td><input id="b_2" class="oddsval" /></td>
                <td class="ball">總和單</td>
                <td><input id="c_1" class="oddsval" /></td>
                <td class="ball">總和雙</td>
                <td><input id="c_2" class="oddsval" /></td>
                <td class="ball">總和810</td>
                <td><input id="d_1" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td class="ball">總和大單</td>
                <td><input id="e_1" class="oddsval" /></td>
                <td class="ball">總和大雙</td>
                <td><input id="e_2" class="oddsval" /></td>
                <td class="ball">總和小單</td>
                <td><input id="e_3" class="oddsval" /></td>
                <td class="ball">總和小雙</td>
                <td><input id="e_4" class="oddsval" /></td>
                <td class="ball"></td>
                <td></td>
              </tr>
            </table>
            <form name="changeForm" method="post">
            <table border="0" cellspacing="0" style="width:600px" class="conter oddsbox">
              <tr>
                <td class="ball">賠率修改為：</td>
                <td><input type="text" name="pl" id="pl" value="0" style="width:80px"/></td>
                <td nowrap="nowrap">&nbsp;<input  checked="checked" style="width:auto" type="radio" name="pltype"  id="pltype" value="0"/>全部&nbsp;
                <input style="width:auto"type="radio" name="pltype" id="pltype" value="1"/>1~80號碼&nbsp;
                <input style="width:auto" type="radio" name="pltype" id="pltype" value="2"/>雙面&nbsp;</td>
                <td><input type="submit" name="changepl" id="changepl" value="確認"/></td>
              </tr>
            </table>
            </form>
            <table border="0" style="float:left;width:260px" cellspacing="0" class="conter oddsbox">
              <tr>
                <th colspan="2">比數賠率</th>
              </tr>
              <tr class="tr_top">
                <td>號</td>
                <td>賠率</td>
              </tr>
              <tr>
                <td class="ball">前(多)</td>
                <td><input id="f_1" class="oddsval" /></td>
              </tr>
              <tr>
                <td class="ball">後(多)</td>
                <td><input id="f_2" class="oddsval" /></td>
              </tr>
              <tr>
                <td class="ball">前後(和)</td>
                <td><input id="f_3" class="oddsval" /></td>
              </tr>
              <tr align="center" >
                <td class="ball">單(多)</td>
                <td><input id="g_1" class="oddsval" /></td>
              </tr>
              <tr>
                <td class="ball">雙(多)</td>
                <td><input id="g_2" class="oddsval" /></td>
              </tr>
              <tr>
                <td class="ball">單雙(和)</td>
                <td><input id="g_3" class="oddsval" /></td>
              </tr>
            </table>
            <table border="0" style="float:left;width:260px;margin-left:5px" cellspacing="0" class="conter oddsbox">
              <tr>
                <th colspan="2">五行賠率</th>
              </tr>
              <tr class="tr_top">
                <td>號</td>
                <td>賠率</td>
              </tr>
              <tr>
                <td class="ball">金</td>
                <td><input id="h_1" class="oddsval" /></td>
              </tr>
              <tr>
                <td class="ball">木</td>
                <td><input id="h_2" class="oddsval" /></td>
              </tr>
              <tr>  
                <td class="ball">水</td>
                <td><input id="h_3" class="oddsval" /></td>
             </tr>
              <tr>   
                <td class="ball">火</td>
                <td><input id="h_4" class="oddsval" /></td>
             </tr>
              <tr>   
                <td class="ball">土</td>
                <td><input id="h_5" class="oddsval" /></td>
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