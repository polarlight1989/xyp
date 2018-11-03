<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
header("Content-type: text/html; charset=utf-8");
include_once ROOT_PATH.'Admin/ExistUser.php';

$db = new DB();
global $Users;
$glid=$Users[0]['g_login_id'];//取级别
$g_nid=$Users[0]['g_nid'];
//dump($glid);

function datetime($time)
{
	$week = GetWeekDay($time,0);
	
	$a = explode('-', $time);
	$b = explode(' ', $a[2]);
	$c = explode(':', $b[1]);
	$newtime= $a[1].'-'.$b[0].'&nbsp;&nbsp;'.$c[0].':'.$c[1].'&nbsp;&nbsp;'.$week;
	//dump($newtime);
	return $newtime;

}

$getuser=$_GET['memberid'];//单取用户名
$v=$_GET['v'];//时间,还没想到要干嘛用,

	$win = " AND g_win is null ";	//結算狀態
	
	if ($glid=="89"){
	$nid=" 1=1 ";
	}else{
	$nid = " g_s_nid LIKE '{$g_nid}%' ";
	}
	$us="";
    if($getuser){
	$us.= " and g_nid = '{$getuser}' ";
	}
	
	$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_distribution_4`, `g_win`, `g_t_id` 
	FROM `g_zhudan` WHERE {$nid} {$us} {$win} order by g_id desc ";
	$result= $db->query($sql, 1);	


if($result){
//dump(count($result));
for($i=0;$i<count($result);$i++){


$panlu = $db->query("SELECT  `g_panlu` FROM `g_user` WHERE g_name = '{$result[$i]['g_nid']}' LIMIT 1", 1);

if ($result[$i]['g_mingxi_1_str'] == null) {
       		if ($result[$i]['g_mingxi_1'] == '總和、龍虎' || $result[$i]['g_mingxi_1'] == '總和、龍虎和' || $result[$i]['g_mingxi_1'] == '三军' &&  $result[$i]['g_mingxi_2'] == '大' || $result[$i]['g_mingxi_1'] == '三军' &&  $result[$i]['g_mingxi_2'] == '小' ){
        		$n = $result[$i]['g_mingxi_2'];
        	}else {
        		$n = $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
        	}
			
        	$html = '<span class="blue">'.$n.'</span>@ <b class="red">'.$result[$i]['g_odds'].'</b>';
			$SumNum['Money']=$result[$i]['g_jiner'];
        }else {
		
        	$_xMoney = $result[$i]['g_mingxi_1_str'] * $result[$i]['g_jiner'];
        	$SumNum['Money'] = '<font color="#009933">'.$result[$i]['g_mingxi_1_str'].'</font> x <font color="#0066FF">'.$result[$i]['g_jiner'].'</font><br />'.$_xMoney;
        	$html = '<span class="blue">'.$result[$i]['g_mingxi_1'].'</span>@ <b class="red">'.$result[$i]['g_odds'].'</b><br />'.
        				'<span style="line-height:23px">復式  『 '.$result[$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$result[$i]['g_mingxi_2'].'</span>';
        }
		
?>


<tr class="Conter_Report_List" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
<td class="r_ad"><span class="p_k"><?php echo $result[$i]['g_id'];?># <b></b><span class="p_k"><?php echo datetime($result[$i]['g_date']);?></span></span>
<td class="r_ad"><span class="p_k"><?php echo $result[$i]['g_type'];?></span><span class="p_k green2"><?php echo $result[$i]['g_qishu'];?>期</span></td>
<td class="r_ad"><span class="p_k"><?php echo $result[$i]['g_nid'];?></span><span class="p_k"><?php echo $panlu[0]['g_panlu'];?>盤</span></td>
<td class="r_ad"><?php echo $html;?></b></td>
<td class="r_ad" align="right"><?php echo $SumNum['Money'];?></td>
<td class="r_ad"><span class="p_k"><b><?php echo $result[$i]['g_distribution'];?>%</b></span><span class="p_k"><?php echo $result[$i]['g_tueishui'];?></span></td>
<td class="r_ad"><span class="p_k"><b><?php echo $result[$i]['g_distribution_1'];?>%</b></span><span class="p_k"><?php echo $result[$i]['g_tueishui_1'];?></span></td>
<td class="r_ad"><span class="p_k"><b><?php echo $result[$i]['g_distribution_2'];?>%</b></span><span class="p_k"><?php echo $result[$i]['g_tueishui_2'];?></span></td>
<td class="r_ad"><span class="p_k"><b><?php echo $result[$i]['g_distribution_3'];?>%</b></span><span class="p_k"><?php echo $result[$i]['g_tueishui_3'];?></span></td>
<td class="r_ad"><span class="p_k"><b><?php echo $result[$i]['g_distribution_4'];?>%</b></span><span class="p_k"><?php echo $result[$i]['g_tueishui_4'];?></span></td>
</tr>




<?php }
?>
|
<?php
}else{?>

<tr class="Conter_Report_List">
<td colspan="11" class="red">暫無數據</td>
</tr>
<?php }?>