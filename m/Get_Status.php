<?
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
global $user;
echo '{"islogin":"1"},"t_credit":"'.number_format(is_Number($user[0]['g_money_yes'])).'","t_amt":"'.is_Number(getWin($user)).'"}';
?>