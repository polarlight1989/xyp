<?
if (!defined("Copyright"))
define('Copyright', 'Author QQ: 1234567');
if (!defined("ROOT_PATH"))
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
$dateTime = date('Y-m-d H:i:s');

if($_SESSION['cpopen'] == 0 || $_SESSION['cpopen'] == 1){
	$dateTime = date('Y-m-d H:i:s');
	$a = date('Y-m-d ').'22:29:00';
	global $stratGame, $endGame;
	if ( ($dateTime < $stratGame || $dateTime > $a) || $dateTime > $endGame){	
		markPos("前台-广东封盘页");
		header("Location: ./ClosedLottery.php"); exit;
	}
}elseif($_SESSION['cpopen'] == 2){
	$dateTime = date('Y-m-d H:i:s');
	$a = date('Y-m-d ').'01:55:01';
	global $stratGamecq, $endGamecq;
	if ( ($dateTime < $stratGamecq && $dateTime > $a) || $dateTime > $endGamecq)
	{
		markPos("前台-重庆封盘页");
		header("Location: ./ClosedLottery.php"); exit;
	}
}elseif($_SESSION['cpopen'] == 7){
	$dateTime = date('Y-m-d H:i:s');
    $a = date('Y-m-d ').'08:30:01';
    $b = date('Y-m-d ').'22:10:01';
    global $stratGamesz, $endGamesz;
    $_SESSION['cpopen'] = 7;
    if ( $dateTime < $a || $dateTime > $b)
    {
		markPos("前台-重庆封盘页");
		header("Location: ./ClosedLottery.php"); exit;
	}
}elseif($_SESSION['cpopen'] == 8){
	$dateTime = date('Y-m-d H:i:s');
	$a = date('Y-m-d ').'00:00:00';
	$b = date('Y-m-d ').'05:59:00';
	$c = date('Y-m-d ').'23:59:59';
	global $stratGamekl8, $endGamekl8;
	if ( !(($dateTime>=$a && $dateTime<=$b) || ($dateTime>=$stratGamekl8&& $dateTime<=$c)))
	{
		markPos("前台-快乐8封盘页");
		header("Location: ./ClosedLottery.php"); exit;
	}
}elseif($_SESSION['cpopen'] == 9){
	$dateTime = date('Y-m-d H:i:s');
	$a = date('Y-m-d ').'02:04:00';
	global $stratGamenc, $endGamenc;
	if (( strtotime($dateTime) < strtotime($stratGamenc) &&  strtotime($dateTime) > strtotime($a)) || strtotime($dateTime) > strtotime($endGamenc)){
		markPos("前台-幸运农场封盘页");
		header("Location: ./ClosedLottery.php"); exit;
	}

}elseif($_SESSION['cpopen'] == 6){
	$dateTime = date('Y-m-d H:i:s');
	global $stratGamepk, $endGamepk;
	if ( $dateTime < $stratGamepk || $dateTime > $endGamepk){ 
		markPos("前台-PK封盘页");
		header("Location: ./ClosedLottery.php"); exit;
	}
}
?>