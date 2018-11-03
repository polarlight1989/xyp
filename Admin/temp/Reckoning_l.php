<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $Users;
//dump($Users);
if(!isset($_GET['tid']) && !isset($_GET['cid'])) exit;
$tid = $_GET['tid'];
$cid = $_GET['cid'];
if ($tid == 1){
	$p = "g_kaipan";
	$type = "廣東快樂十分";
	if ($cid == 1){
		$title = "第1~8球、總和、龍虎投注匯總表";
		$mx = "AND g_mingxi_1 <> '任選二' AND g_mingxi_1 <> '選二連組' AND g_mingxi_1 <> '任選三' AND g_mingxi_1 <> '選三前組' AND g_mingxi_1 <> '任選四' AND g_mingxi_1 <> '任選五'";
	}else if ($cid == 2){
		$title = "連碼（注單明細）";
		$mx = "AND (g_mingxi_1 = '任選二' OR g_mingxi_1 = '選二連組' OR g_mingxi_1 = '任選三' OR g_mingxi_1 = '選三前組' OR g_mingxi_1 = '任選四' OR g_mingxi_1 = '任選五')";
	}
} else if ($tid == 2 && $cid == 1){
	$p = "g_kaipan2";
	$type = "重慶時時彩";
	$title = "所有投注匯總表";
}else if($tid==7){
	$type="吉林快3";
	$p="g_kaipan7";
	$title="所有投注匯總表";
}
markPos("后台-帳單明細-{$type}");
$db = new DB();
$sql = "SELECT g_qishu FROM `{$p}` WHERE g_lock = 2 ORDER BY g_qishu DESC  LIMIT 1";
$number = $db->query($sql, 0);
$sql = "SELECT `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win` FROM g_zhudan 
WHERE g_s_nid LIKE '{$Users[0]['g_nid']}%' {$mx} 
AND g_type = '{$type}' 
AND g_qishu = '{$number[0][0]}' 
AND g_win is null";
//dump($sql);
$result = $db->query($sql, 1);
if ($result&&$tid!=7)
{
	$a = array(0=>'第一球',1=>'第二球',2=>'第三球',3=>'第四球',4=>'第五球',5=>'第六球',6=>'第七球',7=>'第八球');
	$c = array();
	$c['第一球'] = sumcontlist($result, $Users[0]['g_login_id'], '第一球');
	$c['第二球'] = sumcontlist($result, $Users[0]['g_login_id'], '第二球');
	$c['第三球'] = sumcontlist($result, $Users[0]['g_login_id'], '第三球');
	$c['第四球'] = sumcontlist($result, $Users[0]['g_login_id'], '第四球');
	$c['第五球'] = sumcontlist($result, $Users[0]['g_login_id'], '第五球');
	if ($tid == 1)
	{
		$c['第六球'] = sumcontlist($result, $Users[0]['g_login_id'], '第六球');
		$c['第七球'] = sumcontlist($result, $Users[0]['g_login_id'], '第七球');
		$c['第八球'] = sumcontlist($result, $Users[0]['g_login_id'], '第八球');
		$c['1-8大小'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'大', 1=>'小'));
		if ($c['1-8大小'])
			sort($c['1-8大小']);
			
		$c['1-8單雙'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'單', 1=>'雙'));
		if ($c['1-8單雙'])
			sort($c['1-8單雙']);
		
		$c['1-8尾數大小'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'尾大', 1=>'尾小'));
		if ($c['1-8尾數大小'])
			sort($c['1-8尾數大小']);
		
		$c['1-8合數單雙'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'合數單', 1=>'合數雙'));
		if ($c['1-8合數單雙'])
			sort($c['1-8合數單雙']);
			
		$c['1-8方位'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'東', 1=>'南', 2=>'西', 3=>'北'));
		if ($c['1-8方位'])
			sort($c['1-8方位']);
			
		$c['1-8中發白'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'中', 1=>'發', 2=>'白'));
		if ($c['1-8中發白'])
			sort($c['1-8中發白']);
			
		$c['總和大小'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'總和、龍虎'), array(0=>'總和大', 1=>'總和小'));
		$c['總和單雙'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'總和、龍虎'), array(0=>'總和單', 1=>'總和雙'));
		$c['龍虎'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'總和、龍虎'), array(0=>'龍', 1=>'虎'));
		$c['任選二'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'任選二'), null);
		$c['選二連組'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'選二連組'), null);
		$c['任選三'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'任選三'), null);
		$c['選三前組'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'選三前組'), null);
		$c['任選四'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'任選四'), null);
		$c['任選五'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'任選五'), null);
	}
	else if($tid==3){
		$c['1-5大小'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'大', 1=>'小'));
		if ($c['1-5大小'])
			sort($c['1-5大小']);
			
		$c['1-5單雙'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'單', 1=>'雙'));
		if ($c['1-5單雙'])
			sort($c['1-5單雙']);
		
		$c['1-5尾數大小'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'尾大', 1=>'尾小'));
		if ($c['1-5尾數大小'])
			sort($c['1-5尾數大小']);
		
		$c['1-5合數單雙'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'合數單', 1=>'合數雙'));
		if ($c['1-5合數單雙'])
			sort($c['1-5合數單雙']);
			
		$c['1-5神奇快乐'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'神', 1=>'奇', 2=>'快', 3=>'乐'));
		if ($c['1-5神奇快乐'])
			sort($c['1-5神奇快乐']);
			
		$c['1-5红蓝绿'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'红', 1=>'蓝', 2=>'绿'));
		if ($c['1-5红蓝绿'])
			sort($c['1-5红蓝绿']);
			
		$c['總和大小'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'總和、龍虎'), array(0=>'總和大', 1=>'總和小'));
		$c['總和單雙'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'總和、龍虎'), array(0=>'總和單', 1=>'總和雙'));
		$c['龍虎'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'總和、龍虎'), array(0=>'龍', 1=>'虎'));
		$c['一中一'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'一中一'), null);
		$c['二中二'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'二中二'), null);
		$c['三中二'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'三中二'), null);
		$c['三中三'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'三中三'), null);
		$c['四中三'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'四中三'), null);
		$c['五中三'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'五中三'), null);
	
	}else if ($tid == 2)
	{
		$c['1-5大小'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'大', 1=>'小'));
		if ($c['1-5大小'])
			sort($c['1-5大小']);
			
		$c['1-5單雙'] = sumcontlists($result, $Users[0]['g_login_id'], $a, array(0=>'單', 1=>'雙'));
		if ($c['1-5單雙'])
			sort($c['1-5單雙']);
			
		$c['龍虎和'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'總和、龍虎和'), array(0=>'龍', 1=>'虎', 1=>'和'));
		$c['總和大小'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'總和、龍虎和'), array(0=>'總和大', 1=>'總和小'));
		$c['總和單雙'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'總和、龍虎和'), array(0=>'總和單', 1=>'總和雙'));
		$c['前三'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'前三'), array(0=>'豹子', 1=>'順子', 2=>'對子', 3=>'半順', 4=>'雜六'));
		$c['中三'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'中三'), array(0=>'豹子', 1=>'順子', 2=>'對子', 3=>'半順', 4=>'雜六'));
		$c['后三'] = sumcontlists($result, $Users[0]['g_login_id'], array(0=>'后三'), array(0=>'豹子', 1=>'順子', 2=>'對子', 3=>'半順', 4=>'雜六'));
	}
}else{
//	dump("aa");
	$c['三军'] = sumcontlistsz($result, $Users[0]['g_login_id'], '三军');
	$c['三军'] = sumcontlistsz($result, $Users[0]['g_login_id'], '大小');
	$c['圍骰'] = sumcontlistsz($result, $Users[0]['g_login_id'], '圍骰');
	$c['點數'] = sumcontlistsz($result, $Users[0]['g_login_id'], '點數');
	$c['長牌'] = sumcontlistsz($result, $Users[0]['g_login_id'], '長牌');
	$c['短牌'] = sumcontlistsz($result, $Users[0]['g_login_id'], '短牌');
}

function sumcontlists($result, $loginid, $type, $value)
{
	for ($i=0; $i<count($result); $i++)
	{
		$c = sumzc($result[$i], $loginid);
		for ($n=0; $n<count($type); $n++)
		{
			if ($type[0] == '總和、龍虎' || $type[0] == '總和、龍虎和')
				$s = $result[$i]['g_mingxi_2'];
			else 
				$s =$result[$i]['g_mingxi_1'].'【'.$result[$i]['g_mingxi_2'].'】';
			if ($value == null && $result[$i]['g_mingxi_1'] == $type[$n])
			{
				$count[$type[$n]][0] = $result[$i]['g_mingxi_1'];
				$count[$type[$n]][1] += 1;
				$count[$type[$n]][2] += $c[0];
				$count[$type[$n]][3] = '0';
				$count[$type[$n]][4] += $c[1];
				$count[$type[$n]][5] += $c[1];
			}
			else if ($result[$i]['g_mingxi_1'] == $type[$n] && $result[$i]['g_mingxi_2'] == $value[0])
			{
				$count[$type[$n].$value[0]][0] = $s;
				$count[$type[$n].$value[0]][1] += 1;
				$count[$type[$n].$value[0]][2] += $c[0];
				$count[$type[$n].$value[0]][3] = '0';
				$count[$type[$n].$value[0]][4] += $c[1];
				$count[$type[$n].$value[0]][5] += $c[1];
			}
			else if ($result[$i]['g_mingxi_1'] == $type[$n] && $result[$i]['g_mingxi_2'] == $value[1])
			{
				$count[$type[$n].$value[1]][0] = $s;
				$count[$type[$n].$value[1]][1] += 1;
				$count[$type[$n].$value[1]][2] += $c[0];
				$count[$type[$n].$value[1]][3] = '0';
				$count[$type[$n].$value[1]][4] += $c[1];
				$count[$type[$n].$value[1]][5] += $c[1];
			}
			else if ($result[$i]['g_mingxi_1'] == $type[$n] && $result[$i]['g_mingxi_2'] == $value[2])
			{
				$count[$type[$n].$value[2]][0] = $s;
				$count[$type[$n].$value[2]][1] += 1;
				$count[$type[$n].$value[2]][2] += $c[0];
				$count[$type[$n].$value[2]][3] = '0';
				$count[$type[$n].$value[2]][4] += $c[1];
				$count[$type[$n].$value[2]][5] += $c[1];
			}
			else if ($result[$i]['g_mingxi_1'] == $type[$n] && $result[$i]['g_mingxi_2'] == $value[3])
			{
				$count[$type[$n].$value[3]][0] = $s;
				$count[$type[$n].$value[3]][1] += 1;
				$count[$type[$n].$value[3]][2] += $c[0];
				$count[$type[$n].$value[3]][3] = '0';
				$count[$type[$n].$value[3]][4] += $c[1];
				$count[$type[$n].$value[3]][5] += $c[1];
			}
			else if ($result[$i]['g_mingxi_1'] == $type[$n] && $result[$i]['g_mingxi_2'] == $value[4])
			{
				$count[$type[$n].$value[4]][0] = $s;
				$count[$type[$n].$value[4]][1] += 1;
				$count[$type[$n].$value[4]][2] += $c[0];
				$count[$type[$n].$value[4]][3] = '0';
				$count[$type[$n].$value[4]][4] += $c[1];
				$count[$type[$n].$value[4]][5] += $c[1];
			}
		}
	}
	return $count;
}

function sumcontlist($result, $loginid, $type)
{
	$count = array();
	for ($i=0; $i<count($result); $i++)
	{
		$c = sumzc($result[$i], $loginid);
//		dump($c);
		if ($result[$i]['g_mingxi_1'] == $type)
		{
	
				for ($n=0; $n<20; $n++)
				{
					if ($result[$i]['g_mingxi_2'] == $n && Matchs::isNumber($result[$i]['g_mingxi_2']))
					{
						$count[$n][0] = $result[$i]['g_mingxi_2'];
						$count[$n][1] += 1;
						$count[$n][2] += $c[0];
						$count[$n][3] = '0';
						$count[$n][4] += $c[1];
						$count[$n][5] += $c[1];
					}
				}

		}
	}
	return $count;
}

function sumcontlistsz($result, $loginid, $type)
{
	$count = array();
	for ($i=0; $i<count($result); $i++)
	{
		$c = sumzc($result[$i], $loginid);
//		dump($c);
		if ($result[$i]['g_mingxi_1'] == $type)
		{
			
				$n=$result[$i]["g_mingxi_2"];
				switch ($result[$i]["g_mingxi_2"]){
						case "1":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "2":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "3":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "4":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "5":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "6":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "4":
						case "5":
						case "6":
						case "7":
						case "8":
						case "9":
						case "10":
						case "11":
						case "12":
						case "13":
						case "14":
						case "15":
						case "16":
						case "17":
							$j=intval(substr($result[$i]["g_mingxi_2"],0,1))-3;
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "全骰":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "1,2":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "1,3":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "1,4":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "1,5":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "1,6":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "2,3":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "2,4":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "2,5":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "2,6":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "3,4":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "3,5":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "3,6":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "4,5":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "4,6":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "5,6":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
						case "1,2":
							$count[$n][0] = $result[$i]['g_mingxi_2'];
							$count[$n][1] += 1;
							$count[$n][2] += $c[0];
							$count[$n][3] = '0';
							$count[$n][4] += $c[1];
							$count[$n][5] += $c[1];
							break;
				
			}
		}
	}
	return $count;
}

function sumzc($result, $loginid)
{
	$c = array();
	$j = $result['g_mingxi_1_str'] >0 ? $result['g_mingxi_1_str']*$result['g_jiner'] : $result['g_jiner'];
	if ($loginid == 89 || $loginid == 56){
		$c[0] = ($result['g_distribution_3']/100) * $j;
		$c[1] = ($result['g_distribution_3']/100) * ((1-($result['g_tueishui_3']/100))*$j);
	} else if ($loginid == 22){
		$s = $result['g_tueishui_2'] >0 ? 1-($result['g_tueishui_2']/100) : 1-($result['g_tueishui']/100);
		if ($result['g_distribution_2'] > 0){
			$c[0] = ($result['g_distribution_2']/100) * $j;
			$c[1] = ($result['g_distribution_2']/100) * ($s*$j);
		} else {
			$c[0] = $j;
			$c[1] = $s*$j;
		}
	} else if ($loginid == 78){
		$s = $result['g_tueishui_1'] >0 ? 1-($result['g_tueishui_1']/100) : 1-($result['g_tueishui']/100);
		if ($result['g_distribution_1'] > 0){
			$c[0] = ($result['g_distribution_1']/100) * $j;
			$c[1] = ($result['g_distribution_1']/100) * ($s*$j);
		} else {
			$c[0] = $j;
			$c[1] = $s*$j;
		}
	} else if ($loginid == 48){
		if ($result['g_distribution'] > 0){
			$c[0] = ($result['g_distribution']/100) * $j;
			$c[1] = ($result['g_distribution']/100) * ((1-($result['g_tueishui_3']/100))*$j);
		} else {
			$c[0] =$j;
			$c[1] =(1-($result['g_tueishui_3']/100))*$j;
		}
	}
	return $c;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<title><?php echo $number[0][0]?> - 帳單明細</title>
<script type="text/javascript">
<!--
    var isReady = false;
    function doSaveAs(){
        if (document.execCommand){
            if (isReady){
            	document.execCommand('Saveas',false, '<?php echo $number[0][0]?> - 帳單明細'); 
            }
        }else{
            alert('Feature available only in Internet Exlorer 4.0 and later.');
        }
    }
//-->
</script>
</head>
<body onload="isReady=true;window.focus()">
	<table width="99%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#4F4F4F"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Admin/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="90%">&nbsp;<?php echo $title?></td>
                                    <td width="100">&nbsp;</td>
                                    <td width="100">&nbsp;</td>
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
                            	<tr class="tr_top">
                                	<td>類型</td>
                                    <td>筆數</td>
                                    <td>實占金額</td>
                                    <td>實占輸贏</td>
                                    <td>退水</td>
                                    <td>退水后結果</td>
                                </tr>
                                <?php $cc = array(0=>0, 1=>0,2=>0,3=>0,4=>0,5=>0,); if ($result){foreach ($c as $key=>$value){if ($value){?>
                                <tr>
                                	<td colspan="6" style="text-align:center;background:#F9F9F9;font-weight:bold"><?php echo $key?></td>
                                </tr>
                                <?php foreach ($value as $k=>$v){
                                $cc[0] += $v[1];
                                $cc[1] += $v[2];
                                $cc[2] += $v[3];
                                $cc[3] += $v[4];
                                $cc[4] += $v[5];
                                ?>
                                <tr align="center">
                                	<td><?php echo $v[0]?></td>
                                    <td><?php echo is_Number($v[1])?></td>
                                    <td><?php echo is_Number($v[2])?></td>
                                    <td><?php echo is_Number($v[3])?></td>
                                    <td><?php echo is_Number($v[4])?></td>
                                    <td><?php echo is_Number($v[5])?></td>
                                </tr>
                                <?php }}}}?>
                                <tr align="center">
                                	<td align="right">總計：</td>
                                	<td><?php echo is_Number($cc[0])?></td>
                                	<td><?php echo is_Number($cc[1])?></td>
                                	<td><?php echo is_Number($cc[2])?></td>
                                	<td><?php echo is_Number($cc[3])?></td>
                                	<td><?php echo is_Number($cc[4])?></td>
                                </tr>
                            </table>    
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" style="color:red" align="center">報表生成時間：<?php echo date('Y-m-d H:i:s')?></td>
                        <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
                <object classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2" height="0" width="0" id=WebBrowser></object>
            </td>
        </tr>
    </table>
</body>
</html>