<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
global $user, $UserOut, $stratGamesz, $endGamesz;
if ($user[0]['g_look'] == 2 || $user[0]['g_out'] != 1) 
	exit(back($UserOut));
	
if ($_SERVER["REQUEST_METHOD"] != "GET") 
	exit("GetError");
	
$dateTime = date('Y-m-d H:i:s');
if ( $dateTime < $stratGamesz || $dateTime > $endGamesz){
	back('開盤時間為：'.$stratGamesz.'--'.$endGamesz);exit;
}
 

if (!Matchs::isNumber($_GET['numberid'],1,9)||!Matchs::isString($_GET['hid'], 3, 4)||!isset($_GET['tid'])) 
	exit(back('Error'));
 $_SESSION['guid_code'] = sha1(uniqid(time(),true));
$number = $_GET['numberid'];
$s_cq[0][0] = $_GET['tid'];
$s_cq[0][1] = $_GET['hid'];
$a = mb_substr($s_cq[0][1], 1, mb_strlen($s_cq[0][1]));
$ac = mb_substr($s_cq[0][1], 0, mb_strlen($s_cq[0][1]));
$odds = getOddsSz($s_cq[0][0], $a);

$ConfigModel =configModel("`g_max_money`,`g_mix_money`");

$odds = setoddssz($a, $odds,  $user, 0, $s_cq[0][0]);
$pan = strtolower($user[0]['g_panlu']);
$g_a_limit = 'g_panlu_'.$pan;


$result = GetUserXianErjsk3($s_cq[0][0], $a,$user[0]['g_name'],$g_a_limit);



$s = isSzType($s_cq[0][0],$ac,true);
 //dump($s);
$max = GetUser_s_js($result, $user, $s[0],$s[1] ,true);

$max1 = $max['DanZhu_XianEr'];
$max2 = $max['DanHao_XianE'];
$max3 = $max['DanHao_YiXia'];
$max4 = $max['DanQi_XianEr'];
$max5 = $max['DanQi_YiXia'];
$gMoney = $max['KeYongEr'];
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/sGetjs.js"></script>
<style type="text/css">
body {background-color:#FFEFE2}
</style>
</head>
<body>
<form id="dp" action="inc/DataProcessingszjs.php" method="post" onsubmit = "return submitformscq()">
	<input type="hidden" name="gtypes" value="2" />
	<input type="hidden" name="s_number" value="<?php echo $number?>" />
	                <table border="0" cellpadding="0" cellspacing="1" class="t_list" width="230">
                    <tr>
                        <td class="t_list_caption" colspan="2"><span id="tys"><?php echo $s[0]?></span> - 下註</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">會員帳戶</td>
                        <td class="t_td_text" width="137">&nbsp;<?php echo $user[0]['g_name']?>（<?php echo $user[0]['g_panlu']?>盤）</td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1">可用金額</td>
                        <td class="t_td_text">&nbsp;<?php echo is_Number($gMoney)?></td>
                    </tr>
                    <tr>
                    	<td class="t_td_text" colspan="2" align="center">
                        	<span style="color:#009933; font-weight:bold"><?php echo $number?>期</span><br />
                        	<?php
							if($s[0]!='三军')
							{
                        	if($s[0] == '總和、龍虎和') {
                        		echo $nn = '<span style="color:#0000FF"><span>'.$s[1].'</span></span> @'; 
							} else {
                        		echo $nn = '<span style="color:#0000FF">'.$s[0].'『 <span>'.$s[1].'</span> 』</span>@<span style="color:red; font-weight:bold" id="odds">'.$odds.'</span>';
                        	}
                        	?>
                            
                            <?php
							}else
							{
								echo '<span style="color:#0000FF">'.$s[0].'『 <span>'.$s[1].'</span> 』</span>@'.'<span style="color:red; font-weight:bold" id="odds">'.$odds.'</span><br>';	
								echo '<span style="color:#0000FF">開2骰</span>@'.'<span style="color:red; font-weight:bold">'.((($odds-1)*2)+1).'</span><br>';
								echo '<span style="color:#0000FF">開3骰</span>@'.'<span style="color:red; font-weight:bold">'.((($odds-1)*3)+1).'</span>';	
							}
							?>
                        </td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">下註金額</td>
                        <td class="t_td_text" width="137">&nbsp;<input type="text" class="inp1" name="money" id="money" onkeyup="only(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" maxlength="9" /></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">可贏金額</td>
                        <td class="t_td_text" width="137" id="countOdds">&nbsp;0</td>
                    </tr>
                   <tr>
                        <td class="t_td_caption_1" width="64">最高派彩</td>
                        <td class="t_td_text" width="137" id="pc"><?php echo $ConfigModel['g_max_money']?></td>
                    </tr>
                    <tr>
					  <td class="t_td_caption_1" width="64">最低下注</td>
                        <td class="t_td_text" width="137" id="mix"><?php echo $ConfigModel['g_mix_money']?></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">单注限额</td>
                        <td class="t_td_text" width="137" id="max1"><?php echo $max1?></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">当天限额</td>
                        <td class="t_td_text" width="137" id="max2"><?php echo $max2?></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">当天已下</td>
                        <td class="t_td_text" width="137" id="max3"><?php echo $max3?></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">单号限额</td>
                        <td class="t_td_text" width="137" id="max4"><?php echo $max4?></td>
                    </tr>
                    <tr>
                        <td class="t_td_caption_1" width="64">单号已下</td>
                        <td class="t_td_text" width="137" id="max5"><?php echo $max5?></td>
						</tr>
                    <tr>
                    	<td class="t_td_but" colspan="2" align="center">
                        	<input type="button" value="取消" onclick="location.href='left.php'" class="inputq" />&nbsp;&nbsp;
                            <input type="submit" value="下注" id="submitv" class="inputq" />
                            <input type="hidden" name="s_cq" class="actiionn" value="<?php echo $s_cq[0][0].','.$s_cq[0][1]?>" />
                        </td>
                    </tr>
                </table>
                </form>
</body>
</html>