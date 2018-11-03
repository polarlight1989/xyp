<?php   
/*session_start();   
header("Content-type: image/png");
$dir = "vcode";
$arr = scandir($dir);
$file = $arr[array_rand($arr)];
$code = explode(".",$file);
echo $code[0];
$code = $code[0];
//$_SESSION['code']=$code;
//$_SESSION['Mcode']=$code;

$path = $dir."/".$file;
$im=imagecreatefrompng($path); 
imagepng($im);
imagedestroy($im);*/

session_start();   
header("Content-type: image/png");
$dir = "vcode";
$arr = scandir($dir);
$file = $arr[array_rand($arr)];

$code = explode(".",$file);
$code = $code[0];

$path = $dir."/".$file;

$im=imagecreatefrompng($path); 
$_SESSION['code']=$code;
$_SESSION['Mcode']=$code;
imagepng($im);
imagedestroy($im);

?>