<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php  

define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');

include_once ROOT_PATH.'functioned/globalge.php';
$sHome = include_once ROOT_PATH.'functioned/JumpPort.php';

function is_mobile(){

    // returns true if one of the specified mobile browsers is detected
    // 如果监测到是指定的浏览器之一则返回true
    
    $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
    
   $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
    
    $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
    
    $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";   
    
    $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
    
    $regex_match.=")/i";
    
    // preg_match()方法功能为匹配字符，既第二个参数所含字符是否包含第一个参数所含字符，包含则返回1既true
    return preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && @$_POST['sid'] != null)
{
//	echo $_POST["sid"];exit;
	include_once ROOT_PATH.'mainframe.php';
}
else if($sHome == 1)
{
 if ( is_mobile() ) {
	include_once ROOT_PATH.'m/login.php';
	}else{
	include_once ROOT_PATH.'LoginUsers.php';
	
	}
}
else if ($sHome == 3)
{
	include_once ROOT_PATH.'Admin/LoginAdmin.php';
}
else if ($sHome == 4)
{
include_once ROOT_PATH.'m/login.php';
}else if ($sHome == 5)
{
	include_once ROOT_PATH.'m/login.php';
}

  ?>
 