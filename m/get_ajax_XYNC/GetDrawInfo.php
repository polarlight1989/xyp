<?
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
global $user;
$status=1;
$gametype=9;
$ball_num=8;


$dateTime = date('Y-m-d H:i:s');
$a = date('Y-m-d ').'02:40:00';
global $stratGame, $endGame;
if (( strtotime($dateTime) < strtotime($stratGamenc) &&  strtotime($dateTime) > strtotime($a)) || strtotime($dateTime) > strtotime($endGamenc))
{
 	
	$status=3;
}
$db = new DB();
//echo "SELECT * FROM `g_history$gametype` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ";
$result = $db->query("SELECT * FROM `g_history$gametype` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 1);
//print_r($result);
$kaijiang=array($result[0]['g_qishu']);
for($i=1;$i<=$ball_num;$i++){
	$kaijiang[]=BuLing($result[0]['g_ball_'.$i]);
}
$arr = array(   
    'status' => $status, 
	'kaijiang' => $kaijiang 
);  
$json_string = json_encode($arr);   
echo $json_string; 
$pp='{"status":"1","kaijiang":["565354","06","05","10","01","08","03","04","09","02","07"]}';
?>
