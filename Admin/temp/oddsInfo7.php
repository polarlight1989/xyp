<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
$lm='jstb';
markPos("后台-吉林賠率設置");
//echo "22";
$db=new DB();
$sql = "SELECT `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`,`h15` FROM g_odds7_default  ORDER BY g_id";
$result = $db->query($sql, 0);

//echo $result[5][1];
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	   	$sql = "UPDATE g_odds7_default SET `h1`='{$_POST['Num_1']}',`h2`='{$_POST['Num_2']}', `h3`='{$_POST['Num_3']}', `h4`='{$_POST['Num_4']}', `h5`='{$_POST['Num_5']}', `h6` ='{$_POST['Num_6']}' WHERE g_type ='Ball_1' ";
		$db->query($sql, 2);
		$sql = "UPDATE g_odds7_default SET `h1`='{$_POST['Num_7']}',`h2`='{$_POST['Num_8']}' WHERE g_type ='Ball_2' ";
		$db->query($sql, 2);
		$sql = "UPDATE g_odds7_default SET `h1`='{$_POST['Qum_2']}',`h2`='{$_POST['Qum_3']}', `h3`='{$_POST['Qum_4']}', `h4`='{$_POST['Qum_5']}', `h5`='{$_POST['Qum_6']}', `h6` ='{$_POST['Qum_7']}', `h7` ='{$_POST['Qum_1']}' WHERE g_type ='Ball_3' ";
		$db->query($sql, 2);
		$sql = "UPDATE g_odds7_default SET `h1`='{$_POST['Dum_1']}',`h2`='{$_POST['Dum_2']}', `h3`='{$_POST['Dum_3']}', `h4`='{$_POST['Dum_4']}', `h5`='{$_POST['Dum_5']}', `h6` ='{$_POST['Dum_6']}', `h7` ='{$_POST['Dum_7']}', `h8` ='{$_POST['Dum_8']}', `h9` ='{$_POST['Dum_9']}', `h10` ='{$_POST['Dum_10']}', `h11` ='{$_POST['Dum_11']}', `h12` ='{$_POST['Dum_12']}', `h13` ='{$_POST['Dum_13']}', `h14` ='{$_POST['Dum_14']}' WHERE g_type ='Ball_4' ";
		$db->query($sql, 2);
		$sql = "UPDATE g_odds7_default SET `h1`='{$_POST['Cum_1']}',`h2`='{$_POST['Cum_2']}', `h3`='{$_POST['Cum_3']}', `h4`='{$_POST['Cum_4']}', `h5`='{$_POST['Cum_5']}', `h6` ='{$_POST['Cum_6']}', `h7` ='{$_POST['Cum_7']}', `h8` ='{$_POST['Cum_8']}', `h9` ='{$_POST['Cum_9']}', `h10` ='{$_POST['Cum_10']}', `h11` ='{$_POST['Cum_11']}', `h12` ='{$_POST['Cum_12']}', `h13` ='{$_POST['Cum_13']}', `h14` ='{$_POST['Cum_14']}', `h15` ='{$_POST['Cum_15']}' WHERE g_type ='Ball_5' ";
		$db->query($sql, 2);
		$sql = "UPDATE g_odds7_default SET `h1`='{$_POST['Pum_1']}',`h2`='{$_POST['Pum_2']}', `h3`='{$_POST['Pum_3']}', `h4`='{$_POST['Pum_4']}', `h5`='{$_POST['Pum_5']}', `h6` ='{$_POST['Pum_6']}'  WHERE g_type ='Ball_6' ";
		$db->query($sql, 2);
		
		$db = new DB();
	$db->query("DELETE FROM g_odds7 WHERE g_id >0", 2);
	$result = $db->query("SELECT  `g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15` FROM g_odds7_default", 1);
	$sql = "INSERT INTO `g_odds7`(`g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`) VALUES ";
	for ($i=0; $i<count($result); $i++){
		$sql .="(";
		foreach ($result[$i] as $value){
			if ($value == null)
				$sql .= "null,";
			else 
				$sql .= "'{$value}',";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$sql .="),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
	$db->query($sql, 2);
		exit(alert_href('保存成功。', 'oddsInfo7.php'));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="js/common.js"></script>
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
                <td width="165"><font style="font-weight:bold" color="#344B50">&nbsp;賠率設置 - 吉林賠率設置</font></td>
                <td align="right"><? include "oddsinfo_select.php";?></td>
              </tr>
            </table></td>
          <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
        </tr>
        <tr>
          <td class="t"></td>
          <td class="c"><!-- strat -->
            <form action="" method="post">
              <table border="0" cellspacing="0" class="conter oddsbox">
                <tr class="tr_top">
                  <td width="100" colspan="2">项目</td>
                  <td width="95">赔率設置</td>
                  <td width="100"  colspan="2">项目</td>
                  <td width="95">赔率設置</td>
                  <td width="100"  colspan="2">项目</td>
                  <td width="95">赔率設置</td>
                  <td width="100"  colspan="2">项目</td>
                  <td width="95">赔率設置</td>
                </tr>
                <tr align="center" >
                  <td  width="100" rowspan="8" class="ball">三軍</td>
                  <td width="65" >1/<font color=#ff0000>魚</font></td>
                  <td ><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[0][0];?>" name="Num_1" /></td>
                  <td width="100" rowspan="14" class="ball">點數</td>
                  <td  width="65" >4點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][0];?>" name="Dum_1" /></td>
                  <td  width="100" rowspan="15" class="ball" >長牌</td>
                  <td width="65"  >12</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][0];?>" name="Cum_1" /></td>
                  <td width="100" rowspan="6" class="ball"  >短牌</td>
                  <td  width="65" >11</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[5][0];?>" name="Pum_1" /></td>
                </tr>
                <tr align="center" >
                  <td width="65" >2/<font color=#1a843c>蝦</font></td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[0][1];?>" name="Num_2" /></td>
                  <td  width="65" >5點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][1];?>" name="Dum_2" /></td>
                  <td width="65"  >13</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][1];?>" name="Cum_2" /></td>
                  <td  width="65" >22</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[5][1];?>" name="Pum_2" /></td>
                </tr>
                <tr align="center" >
                  <td width="65" >3/<font color=#0000ff>葫蘆</font></td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[0][2];?>" name="Num_3" /></td>
                  <td  width="65" >6點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][2];?>" name="Dum_3" /></td>
                  <td width="65"  >14</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][2];?>" name="Cum_3" /></td>
                  <td  width="65" >33</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[5][2];?>" name="Pum_3" /></td>
                </tr>
                <tr align="center" >
                  <td width="65" >4/<font color=#0000ff>金錢</font></td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[0][3];?>" name="Num_4" /></td>
                  <td  width="65" >7點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][3];?>" name="Dum_4" /></td>
                  <td width="65"  >15</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][3];?>" name="Cum_4" /></td>
                  <td  width="65" >44</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[5][3];?>" name="Pum_4" /></td>
                </tr>
                <tr align="center" >
                  <td width="65" >5/<font color=#1a843c>螃蟹</font></td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[0][4];?>" name="Num_5" /></td>
                  <td  width="65" >8點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][4];?>" name="Dum_5" /></td>
                  <td width="65"  >16</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][4];?>" name="Cum_5" /></td>
                  <td  width="65" >55</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[5][4];?>" name="Pum_5" /></td>
                </tr>
                <tr align="center" >
                  <td width="65" >6/<font color=#ff0000>雞</font></td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[0][5];?>" name="Num_6" /></td>
                  <td  width="65" >9點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][5];?>" name="Dum_6" /></td>
                  <td width="65"  >23</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][5];?>" name="Cum_6" /></td>
                  <td  width="65" >66</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[5][5];?>" name="Pum_6" /></td>
                </tr>
                <tr align="center" >
                  <td width="65" >大</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[1][0];?>" name="Num_7" /></td>
                  <td  width="65" >10點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][6];?>" name="Dum_7" /></td>
                  <td width="65"  >24</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][6];?>" name="Cum_7" /></td>
                  <td colspan="3" rowspan="9" class="ball"  ><table align="center">
                      <tr align="center">
                        <td width="12" align="center"><input type="submit"  class="button_a" name="Submit2" value="提交" /></td>
                        <td width="12" align="center"><input type="reset"   class="button_a" name="Submit3" value="重置" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr align="center" >
                  <td width="65" >小</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[1][1];?>" name="Num_8" /></td>
                  <td  width="65" >11點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][7];?>" name="Dum_8" /></td>
                  <td width="65"  >25</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][7];?>" name="Cum_8" /></td>
                </tr>
                <tr align="center" >
                  <td  width="100" class="ball">全骰</td>
                  <td width="65" >全骰</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[2][6];?>" name="Qum_1" /></td>
                  <td  width="65" >12點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][8];?>" name="Dum_9" /></td>
                  <td width="65"  >26</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][8];?>" name="Cum_9" /></td>
                </tr>
                <tr align="center" >
                  <td  width="100" rowspan="6" class="ball">圍骰</td>
                  <td width="65" >111</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[2][0];?>" name="Qum_2" /></td>
                  <td  width="65" >13點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][9];?>" name="Dum_10" /></td>
                  <td width="65"  >34</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][9];?>" name="Cum_10" /></td>
                </tr>
                <tr align="center" >
                  <td width="65" >222</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[2][1];?>" name="Qum_3" /></td>
                  <td  width="65" >14點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][10];?>" name="Dum_11" /></td>
                  <td width="65"  >35</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][10];?>" name="Cum_11" /></td>
                </tr>
                <tr align="center" >
                  <td width="65" >333</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[2][2];?>" name="Qum_4" /></td>
                  <td  width="65" >15點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][11];?>" name="Dum_12" /></td>
                  <td width="65"  >36</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][11];?>" name="Cum_12" /></td>
                </tr>
                <tr align="center" >
                  <td width="65" >444</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[2][3];?>" name="Qum_5" /></td>
                  <td  width="65" >16點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][12];?>" name="Dum_13" /></td>
                  <td width="65"  >45</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][12];?>" name="Cum_13" /></td>
                </tr>
                <tr align="center" >
                  <td width="65" >555</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[2][4];?>" name="Qum_6" /></td>
                  <td  width="65" >17點</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[3][13];?>" name="Dum_14" /></td>
                  <td width="65"  >46</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][13];?>" name="Cum_14" /></td>
                </tr>
                <tr align="center" >
                  <td width="65" >666</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[2][5];?>" name="Qum_7" /></td>
                  <td colspan="3" class="ball">&nbsp;</td>
                  <td width="65"  >56</td>
                  <td><input 
style="HEIGHT: 18px"  class="input1" maxlength="8" size="4" value="<?php echo $result[4][14];?>" name="Cum_15" /></td>
                </tr>
              </table>
            </form>
            
            <!-- end --></td>
          <td class="r"></td>
        </tr>
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
          <td class="f" align="center">默認賠率表更變不會即時影響正在開盤中的賠率。</td>
          <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
        </tr>
      </table></td>
    <td width="5" bgcolor="#4F4F4F"></td>
  </tr>
  <tr>
    <td height="5" bgcolor="#4F4F4F"></td>
    <td bgcolor="#4F4F4F"></td>
    <td height="5" bgcolor="#4F4F4F"></td>
  </tr>
</table>
</body>
</html>
