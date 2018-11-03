<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'classed/SumOunt.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
include_once ROOT_PATH.'functioned/opNumberList.php';
global $Users, $ConfigModel;
if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_5'])){
	if ($Users[0]['g_lock_1_5'] !=1) 
		exit(back('您的權限不足！'));
}
markPos("后台-删除历史");
$numberList = numberList(1, true);
$page = $numberList['page'];

function isNumbers($arr){
	foreach ($arr as $value) {
		if ($value >20) return false;
	}
	return true;
}
$db = new DB();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (!empty($_POST['s_num1'])&&!empty($_POST['s_num2'])&&!empty($_POST['s_num3'])&&
		  !empty($_POST['s_num4'])&&!empty($_POST['s_num5'])&&!empty($_POST['s_num6'])&&
		  !empty($_POST['s_num7'])&&!empty($_POST['s_num8'])){
		  	if (!Matchs::isNumber($_POST['s_num1'])||!Matchs::isNumber($_POST['s_num2'])||
		  		  !Matchs::isNumber($_POST['s_num3'])||!Matchs::isNumber($_POST['s_num4'])||
		  		  !Matchs::isNumber($_POST['s_num5'])||!Matchs::isNumber($_POST['s_num6'])||
		  		  !Matchs::isNumber($_POST['s_num7'])||!Matchs::isNumber($_POST['s_num8'])){
		  		  	exit(back('開獎期數格式錯誤！'));
		  	}
			$carr['g_ball_1'] = $_POST['s_num1'];
			$carr['g_ball_2'] = $_POST['s_num2'];
			$carr['g_ball_3'] = $_POST['s_num3'];
			$carr['g_ball_4'] = $_POST['s_num4'];
			$carr['g_ball_5'] = $_POST['s_num5'];
			$carr['g_ball_6'] = $_POST['s_num6'];
			$carr['g_ball_7'] = $_POST['s_num7'];
			$carr['g_ball_8'] = $_POST['s_num8'];
			$carr = array_unique($carr);
			//if (count($carr) != 8) exit(back('開獎號碼選擇錯誤！'));
			if (!isNumbers($carr)){
				exit(back('開獎期數格式錯誤！'));
			}
			$carr['g_date'] = $_POST['openDate'];
			if ($db->query("SELECT g_id FROM g_history WHERE g_id = '{$_GET['UpNumcid']}' AND g_game_id =1 LIMIT 1", 0)){
				$sql = "UPDATE g_zhudan SET 
				g_date = '{$_POST['openDate']}',
				g_ball_1='{$_POST['s_num1']}',
				g_ball_2='{$_POST['s_num2']}',
				g_ball_3='{$_POST['s_num3']}',
				g_ball_4='{$_POST['s_num4']}',
				g_ball_5='{$_POST['s_num5']}',
				g_ball_6='{$_POST['s_num6']}',
				g_ball_7='{$_POST['s_num7']}',
				g_ball_8='{$_POST['s_num8']}'
				WHERE g_id = '{$_GET['UpNumcid']}' LIMIT 1";
				$db->query($sql, 2);
				exit(alert_href('更變成功。', 'DelC.php'));
			}
	} else {
		if (!Matchs::isNumber($_POST['number'],10,10)) exit(back('開獎期數格式錯誤！'));
		//if (mb_substr($_POST['number'], 0, mb_strlen($_POST['number'])-2) >84) exit(back('開獎期數格式錯誤！'));
		for ($i=1; $i<=8; $i++) {
			if ($_POST['num'.$i]== null) exit(back('開獎號碼選擇錯誤！'));
		}
		$arr['g_qishu'] = $_POST['number'];
		$arr['cry'] = $_POST['cry'];
		$arr['g_date'] = $_POST['openDate'];
		$arr['g_ball_1'] = $_POST['num1'];
		$arr['g_ball_2'] = $_POST['num2'];
		$arr['g_ball_3'] = $_POST['num3'];
		$arr['g_ball_4'] = $_POST['num4'];
		$arr['g_ball_5'] = $_POST['num5'];
		$arr['g_ball_6'] = $_POST['num6'];
		$arr['g_ball_7'] = $_POST['num7'];
		$arr['g_ball_8'] = $_POST['num8'];
		$arr = array_unique($arr);
		//echo count($arr['cry']);
		
		
		//if (count($arr) != 11) exit(back('開獎號碼選擇錯誤！'));
		$sql ="SELECT g_id FROM g_history WHERE g_qishu = '{$arr['g_qishu']}' AND g_game_id = 1 AND g_ball_1 is not null LIMIT 1";
		if ($db->query($sql, 0)){
			exit(back('第 '.$arr['g_qishu'].' 已經存在！'));
		} else {
			$sql = "INSERT INTO g_history (g_qishu, g_date, g_game_id, g_ball_1,g_ball_2,g_ball_3,g_ball_4,g_ball_5,g_ball_6,g_ball_7,g_ball_8) VALUES 
			(
				'{$arr['g_qishu']}',
				'{$arr['g_date']}',
				'1',
				'{$_POST['num1']}',
				'{$_POST['num2']}',
				'{$_POST['num3']}',
				'{$_POST['num4']}',
				'{$_POST['num5']}',
				'{$_POST['num6']}',
				'{$_POST['num7']}',
				'{$_POST['num8']}')";
			if ($db->query($sql, 2)){
				if ($_POST['cry'] == 1||$_POST['cry'] == 'on'){
					$SumAmount = new SumAmount($arr['g_qishu']);
					$SumAmount->ResultAmount();
				}
				exit(back('第 '.$arr['g_qishu'].' 寫入成功。'));
			}
		}
	}
}
else if (isset($_GET['startId']) && $_GET['startId'] == 1)
{
	//執行結算
	$numberId = $_GET['numId'];
	$sql ="SELECT g_id FROM g_history WHERE g_qishu = '{$numberId}' AND g_game_id =1 AND g_ball_1 is not null LIMIT 1";
	if ($db->query($sql, 0)){
		$SumAmount = new SumAmount($numberId);
		$Result = $SumAmount->ResultAmount();
		if (is_array($Result)){
			exit(back('第 '.$numberId.' 結算完成，請查詢報表。'));
		} else {
			exit(back('第 '.$numberId.' 結算失敗！'));
		}
	} else {
		exit(back('第 '.$numberId.' 不存在列表中，請聯繫上級處理！'));
	}
}
else if (isset($_GET['numDelid']) || isset($_GET['Numdelid']))
{
	if (isset($_GET['numDelid'])){
		$numDelid = $_GET['numDelid'].' 24:00:00';
		$sql = "DELETE FROM g_zhudan WHERE g_date < '{$numDelid}' ";
	} else {
		$numDelid = $_GET['Numdelid'];
		$sql = "DELETE FROM g_zhudan WHERE g_id = '{$numDelid}' ";
	}
	$db->query($sql, 2);
	exit(back('刪除成功。'));
}
else if (isset($_GET['UpNumcid']))
{
	$UpNumcid = $_GET['UpNumcid'];
	$sql = "SELECT * FROM g_history WHERE g_id = '{$UpNumcid}' AND g_game_id = 1 LIMIT 1";
	$UpNums = $db->query($sql, 1);
}
else 
{
	for ($i=0; $i<84; $i++){$arr[$i] = $i+1;}
	//取出最近84期未結算注單
	$sql = "SELECT g_qishu FROM g_history WHERE g_game_id = 1 ORDER BY g_qishu DESC LIMIT 84";
	$Number = $db->query($sql, 1);
	$NumberArr = array();
	if ($Number){
		for ($i=0; $i<count($Number); $i++){
			$sql = "SELECT g_jiner, g_mingxi_1_str FROM g_zhudan WHERE g_qishu ='{$Number[$i]['g_qishu']}' AND g_win is null ";
			$result = $db->query($sql, 1);
			if ($result){
				$m = array('g_id'=>0, 'g_jiner'=>0);
				for ($n=0; $n<count($result); $n++){
					$m['g_qishu'] = $Number[$i]['g_qishu'];
					if ($result[$n]['g_mingxi_1_str'] == null){
						$m['g_jiner'] += $result[$n]['g_jiner'];
					}else {
						$m['g_jiner'] += $result[$n]['g_jiner'] * $result[$n]['g_mingxi_1_str'];
					}
				}
				$m['g_id'] += count($result);
				$NumberArr[] = $m;
			}
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script  type="text/javascript" src="/js/jquery.js"></script>
<script  type="text/javascript" src="/Admin/temp/js/My97DatePicker/WdatePicker.js"></script>
<title></title>
<script>
<!--
	function delNums(){
		var NumList = $("#NumList").val();
		if (confirm(NumList+"之前的注單將被刪除（包括當日），確定嗎？")){
			var href;
			if (location.href.indexOf("?")>0){
				href = location.href + "&numDelid="+NumList;
			} else {
				href = location.href + "?numDelid="+NumList;
			}
			location.href = href;
		}
	}
-->
</script>
</head>
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
                                    <td>&nbsp;注單清理</td>
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
                           		  <td>
                            		&nbsp;&nbsp;&nbsp;批量操作：<input class='textb' style="width:90px;text-align:center" id="NumList" name="NumList" value='<?php echo date("Y-m-d", mktime(0,0,0,date('m'),date('d')-7,date('Y')))?>' onfocus="WdatePicker({el:'NumList'})" />&nbsp;&nbsp;
                            		<input type="button" class="inputs" onclick="delNums()" value="確認刪除" />
                            		&nbsp;&nbsp;<span class="odds">注：系統將保留選定日期后的注單記錄。 (此操作不可逆,使用前請先注意備份)</span></td>
</tr>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="right">
</td><td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
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
</div>
</body>
</html>