<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $Users;
$db=new DB();
if ($Users[0]['g_login_id'] != 89) exit;
$gmname=$_SESSION['sName'];
$resulth = $db->query("SELECT g_auto FROM  j_manage where g_name='{$gmname}'  ORDER BY g_id DESC", 1);  
    if($resulth[0]['g_auto']==1){
	
	$id=$_POST['zid'];
	$type=$_POST['type'];
	$db=new DB();
	//zerc20120802
	$gwin=$type=='yes'? 1:0;
	$gfail=$type=='yes'? 0:1;
	if($gwin==1){
		$sql = "update g_user set g_autowin=$gwin, g_autofail=$gfail where g_id='$id'";
	}else{
		$sql = "update g_user set g_autowin=$gwin where g_id='$id'";
	}
	$db->query($sql, 2);
	}
	echo $gwin+"";
?>