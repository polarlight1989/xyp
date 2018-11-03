<?php    
session_start();   
//header("Content-type: image/png");
$dir = dirname(__FILE__)."/vcode";
$arr = scandir($dir);
$file = $arr[array_rand($arr)];
//echo $file;
$code = explode(".",$file);
$code = $code[0];

$path = $dir."/".$file;

$_SESSION['VCODE']=$code;

header('content-type:image/jpg;');
$content=file_get_contents($path);
echo $content;
?>