<?
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
global $user;
$gt=$_REQUEST['GT'] ? $_REQUEST['GT'] : 'lm';
$setodds=2;
$status=1;
$gametype=6;
$ball_num=10;
$open='n';

$dateTime = date('Y-m-d H:i:s');
global $stratGamepk, $endGamepk;
if ( $dateTime < $stratGamepk || $dateTime > $endGamepk){ 
	$status=3;
}
$credit=is_Number($user[0]['g_money_yes']);
$amount=is_Number(getWin($user));
//獲取封盤時間、開獎時間、刷新時間
$db = new DB();
$result = $db->query("SELECT `g_id`,`g_qishu`, `g_feng_date`, `g_open_date` FROM g_kaipan$gametype WHERE `g_lock` = 2 LIMIT 1 ", 1);
$qishu=	$result[0]['g_qishu'];
$k_open_time=	date('H:i:s',strtotime($result[0]['g_open_date']));

$k_id=	$result[0]['g_id'];

if(strtotime($result[0]['g_feng_date'])-time()>0){
	$timediff= timediff(strtotime($result[0]['g_feng_date']),time());
	$k_stop_time=	"$timediff[hour]:$timediff[min]:$timediff[sec]";
	$open='y';
}else{
	$timediff= timediff(strtotime($result[0]['g_open_date']),time());
	$k_stop_time=	"$timediff[hour]:$timediff[min]:$timediff[sec]";
}

if($gt=='lm'){
	$setodds=2;
	$sql = "SELECT  h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,h11,h12,h13,h14,h15,h16,`g_type` FROM `g_odds$gametype` WHERE `g_type` = 'Ball_1' OR `g_type` = 'Ball_2' or `g_type` = 'Ball_3' OR `g_type` = 'Ball_4' or `g_type` = 'Ball_5' OR `g_type` = 'Ball_6' or `g_type` = 'Ball_7' OR `g_type` = 'Ball_8' or `g_type` = 'Ball_9' OR `g_type` = 'Ball_12' OR `g_type` = 'Ball_10'  ORDER BY g_id ASC ";
}elseif($gt=='dq'){
	$setodds=0;
	$sql = "SELECT  h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,`g_type` FROM `g_odds$gametype` WHERE `g_type` = 'Ball_1' OR `g_type` = 'Ball_2' or `g_type` = 'Ball_3' OR `g_type` = 'Ball_4' or `g_type` = 'Ball_5' OR `g_type` = 'Ball_6' or `g_type` = 'Ball_7' OR `g_type` = 'Ball_8' or `g_type` = 'Ball_9' OR `g_type` = 'Ball_10'  ORDER BY g_id ASC ";
}elseif($gt=='zh'){
	$setodds=3;
	$sql = "SELECT  h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,h11,h12,h13,h14,h15,h16,h17,`g_type` FROM `g_odds$gametype` WHERE `g_type` = 'Ball_1' OR `g_type` = 'Ball_2' OR `g_type` = 'Ball_11' or `g_type` = 'Ball_12' ORDER BY g_id ASC ";
}elseif($gt=='3456'){
	$setodds=0;
	$sql = "SELECT   h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,h11,h12,h13,h14,h15,h16,`g_type`  FROM `g_odds4` WHERE `g_type` = 'Ball_3' OR `g_type` = 'Ball_4'  OR `g_type` = 'Ball_5'  OR `g_type` = 'Ball_6'  ORDER BY g_id ASC ";
}elseif($gt=='78910'){
	$setodds=0;
	$sql = "SELECT   h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,h11,h12,h13,h14,h15,h16,`g_type`  FROM `g_odds4` WHERE `g_type` = 'Ball_7' OR `g_type` = 'Ball_8'  OR `g_type` = 'Ball_9'  OR `g_type` = 'Ball_10'  ORDER BY g_id ASC ";
}
$list = $db->query($sql, 1);
//print_r($list);
$oddsMax = 0;

$play_odds = array();
for ($i=0; $i<count($list); $i++){
	$str=$list[$i]['g_type'];
	foreach ($list[$i] as $key=>$value){
		//echo "setoddspk($key, $value,$user, $setodds,$str)<br>";
		if($key=='g_type'){
			$play_odds[$i][$key]=$str;
		}else{
			if($open=='y'){
				$play_odds[$i][$key] = setoddspk($key, $value,$user, $setodds,$str);
			}else
				$play_odds[$i][$key]='-';
		}
	}
}

$arr = array(   
    'status' => $status, 
	'open' => $open ,
	'k_open_time' => $k_open_time ,
	'k_stop_time' => $k_stop_time ,
	'qishu' => $qishu ,
	'credit' => $credit ,
	'amount' => $amount ,
	'k_id' => $k_id ,
	'play_odds' => $play_odds
);  
$json_string = json_encode($arr);   
echo $json_string; 
$pp='{"status":"1","open":"y","k_open_time":"16:17:30","k_stop_time":"00:01:50","qishu":"565355","credit":"500.0000","amount":"0.0","k_id":"246492","play_odds":"2_11,1.943|2_12,1.943|3_13,1.943|3_14,1.943|4_15,1.943|4_16,1.943|6_27,1.943|6_28,1.943|7_29,1.943|7_30,1.943|8_31,1.943|8_32,1.943|10_43,1.943|10_44,1.943|11_45,1.943|11_46,1.943|12_47,1.943|12_48,1.943|14_59,1.943|14_60,1.943|15_61,1.943|15_62,1.943|16_63,1.943|16_64,1.943|18_75,1.943|18_76,1.943|19_77,1.943|19_78,1.943|20_79,1.943|20_80,1.943|22_91,1.943|22_92,1.943|23_93,1.943|23_94,1.943|25_105,1.943|25_106,1.943|26_107,1.943|26_108,1.943|28_119,1.943|28_120,1.943|29_121,1.943|29_122,1.943|31_133,1.943|31_134,1.943|32_135,1.943|32_136,1.943|34_147,1.943|34_148,1.943|35_149,1.943|35_150,1.943|37_168,2.135|37_169,1.735|38_170,1.735|38_171,2.135"}';
?>

