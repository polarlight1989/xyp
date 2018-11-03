<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'functioned/peizhi.php';
global $Users, $LoginId;
markPos("后台-会员退水设置");
if ($Users[0]['g_login_id'] != 89) if ($Users[0]['g_lock'] == 2)
exit(back($UserOut)); //帳號已被凍結

//子帳號
if (isset($Users[0]['g_lock_2'])){
	if ( $Users[0]['g_s_lock'] == 2 || $Users[0]['g_lock_2'] != 1)
		exit(back($UserOut)); //帳號已被凍結
}
if (!Matchs::isString($_GET['uid'], 3, 15)) exit(alert_href('用戶名不合法', 'Actfor.php?cid='.$_GET['cid']));
$cid = $_GET['cid'];
$uid = $_GET['uid'];
$userModel = new UserModel();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST['name'];
	$typeida = $_POST['typeida'];
	$typeidb = $_POST['typeidb'];
	$typeidc = $_POST['typeidc'];
	$typeid="";
	
	$memberModel = $userModel->GetMemberModel($name);
	if ($memberModel)
	{
		if ($memberModel[0]['g_mumber_type'] == 2){
			$nid = mb_substr($memberModel[0]['g_nid'], 0, mb_strlen($memberModel[0]['g_nid'])-32);
		}else {
			$nid = $memberModel[0]['g_nid'];
		}
		$Lname = $userModel->GetUserName_Like($nid);
		if ($Lname[0]['g_lock'] != 1) {
			exit(back('更變權限不足！'));
		}
		$Lname = $Lname[0]['g_name'];
		if(isset($typeida)&&$typeida!=""){
		$typeidtemp = strtolower($typeida);
		$typeid = $typeid."g_{$typeidtemp}_limit";
		}
		if(isset($typeidb)&&$typeidb!=""){
		$typeidtemp = strtolower($typeidb);
		if($typeid=="") $typeid =  $typeid."g_{$typeidtemp}_limit";
		else $typeid =  $typeid.",g_{$typeidtemp}_limit";
		}
		if(isset($typeidc)&&$typeidc!=""){
		$typeidtemp = strtolower($typeidc);
		if($typeid=="") $typeid =  $typeid."g_{$typeidtemp}_limit";
		else $typeid =  $typeid.",g_{$typeidtemp}_limit";
		}
		$db = new DB();
		//讀取上級退水盤
		$detModel = new Detailed();
		$dets = $detModel->GetDetailedsAll($uid);

		$LdetList = $db->query("SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`,g_a_limit,g_b_limit,g_c_limit FROM `g_send_back` WHERE g_name = '{$Lname}' and g_game_id = '1'  ORDER BY g_id DESC", 0);
		for ($i=0; $i<count($LdetList); $i++) {
			if($dets==0)
			{
				$aList = $_POST['RebateAG'.($i+1)];
				$gbList = $_POST['RebateBG'.($i+1)];
				$gcList = $_POST['RebateCG'.($i+1)];
			}
			else
			{
				$aList=$gbList=$gcList="";		
			}
			$bList = $_POST['RebateEG'.($i+1)];
			$cList = $_POST['RebateFG'.($i+1)];
			if($aList!=""){
			if ($aList > 100) exit(back(' 退水最高不超过：100'));}
			if($gbList!=""){
			if ($gbList > 100) exit(back(' 退水最高不超过：100'));}
			if($gcList!=""){
			if ($gcList > 100) exit(back(' 退水最高不超过：100'));}
	
			
			//修改退水
			$sql = "UPDATE `g_panbiao` SET g_id=g_id , ";
			if($aList!=""){$sql.="`g_panlu_a` = '{$aList}',";}
			if($gbList!=""){$sql.="`g_panlu_b` = '{$gbList}',";}
			if($gcList!=""){$sql.="`g_panlu_c` = '{$gcList}',";}
			$sql.="`g_danzhu` = '{$bList}', `g_danxiang` = '{$cList}' WHERE `g_nid` = '{$memberModel[0]['g_name']}' AND g_type = '{$LdetList[$i][0]}' AND g_game_id = '{$LdetList[$i][3]}' LIMIT 1";
			$db->query($sql, 2);
		}
		//农场
		$LdetList = $db->query("SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`,g_a_limit,g_b_limit,g_c_limit FROM `g_send_back` WHERE g_name = '{$Lname}' and g_game_id = '9'  ORDER BY g_id DESC", 0);
		for ($i=0; $i<count($LdetList); $i++) {
			if($dets==0)
			{
				$aList = $_POST['RebateANC'.($i+1)];
				$gbList = $_POST['RebateBNC'.($i+1)];
				$gcList = $_POST['RebateCNC'.($i+1)];
			}
			else
			{
				$aList=$gbList=$gcList="";		
			}
			$bList = $_POST['RebateENC'.($i+1)];
			$cList = $_POST['RebateFNC'.($i+1)];
			if($aList!=""){
			if ($aList > 100) exit(back(' 退水最高不超过：100'));}
			if($gbList!=""){
			if ($gbList > 100) exit(back(' 退水最高不超过：100'));}
			if($gcList!=""){
			if ($gcList > 100) exit(back(' 退水最高不超过：100'));}
	
			
			//修改退水
			$sql = "UPDATE `g_panbiao` SET g_id=g_id , ";
			if($aList!=""){$sql.="`g_panlu_a` = '{$aList}',";}
			if($gbList!=""){$sql.="`g_panlu_b` = '{$gbList}',";}
			if($gcList!=""){$sql.="`g_panlu_c` = '{$gcList}',";}
			$sql.="`g_danzhu` = '{$bList}', `g_danxiang` = '{$cList}' WHERE `g_nid` = '{$memberModel[0]['g_name']}' AND g_type = '{$LdetList[$i][0]}' AND g_game_id = '{$LdetList[$i][3]}' LIMIT 1";
			$db->query($sql, 2);
		}
		//重庆
		$LdetListc = $db->query("SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`,g_a_limit,g_b_limit,g_c_limit FROM `g_send_back` WHERE g_name = '{$Lname}' and g_game_id = '2'  ORDER BY g_id DESC", 0);
		for ($i=0; $i<count($LdetListc); $i++) {
			if($dets==0)
			{
				$aList = $_POST['RebateAC'.($i+1)];
				$gbList = $_POST['RebateBC'.($i+1)];
				$gcList = $_POST['RebateCC'.($i+1)];
			}
			else
			{
				$aList=$gbList=$gcList="";		
			}
			$bList = $_POST['RebateEC'.($i+1)];
			$cList = $_POST['RebateFC'.($i+1)];
			if($aList!=""){
			if ($aList > 100) exit(back(' 退水最高不超过：100'));}
			if($gbList!=""){
			if ($gbList > 100) exit(back(' 退水最高不超过：100'));}
			if($gcList!=""){
			if ($gcList > 100) exit(back(' 退水最高不超过：100'));}
	
			
			//修改退水
			$sql = "UPDATE `g_panbiao` SET g_id=g_id , ";
			if($aList!=""){$sql.="`g_panlu_a` = '{$aList}',";}
			if($gbList!=""){$sql.="`g_panlu_b` = '{$gbList}',";}
			if($gcList!=""){$sql.="`g_panlu_c` = '{$gcList}',";}
			$sql.="`g_danzhu` = '{$bList}', `g_danxiang` = '{$cList}' WHERE `g_nid` = '{$memberModel[0]['g_name']}' AND g_type = '{$LdetListc[$i][0]}' AND g_game_id = '{$LdetListc[$i][3]}' LIMIT 1";
			$db->query($sql, 2);
		}
		//江西
		$LdetListc = $db->query("SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`,g_a_limit,g_b_limit,g_c_limit FROM `g_send_back` WHERE g_name = '{$Lname}' and g_game_id = '3'  ORDER BY g_id DESC", 0);
		for ($i=0; $i<count($LdetListc); $i++) {
			if($dets==0)
			{
				$aList = $_POST['RebateAJX'.($i+1)];
				$gbList = $_POST['RebateBJX'.($i+1)];
				$gcList = $_POST['RebateCJX'.($i+1)];
			}
			else
			{
				$aList=$gbList=$gcList="";		
			}
			$bList = $_POST['RebateEJX'.($i+1)];
			$cList = $_POST['RebateFJX'.($i+1)];
			if($aList!=""){
			if ($aList > 100) exit(back(' 退水最高不超过：100'));}
			if($gbList!=""){
			if ($gbList > 100) exit(back(' 退水最高不超过：100'));}
			if($gcList!=""){
			if ($gcList > 100) exit(back(' 退水最高不超过：100'));}
	
			
			//修改退水
			$sql = "UPDATE `g_panbiao` SET g_id=g_id , ";
			if($aList!=""){$sql.="`g_panlu_a` = '{$aList}',";}
			if($gbList!=""){$sql.="`g_panlu_b` = '{$gbList}',";}
			if($gcList!=""){$sql.="`g_panlu_c` = '{$gcList}',";}
			$sql.="`g_danzhu` = '{$bList}', `g_danxiang` = '{$cList}' WHERE `g_nid` = '{$memberModel[0]['g_name']}' AND g_type = '{$LdetListc[$i][0]}' AND g_game_id = '{$LdetListc[$i][3]}' LIMIT 1";
			$db->query($sql, 2);
		}
		//新疆
		$LdetListc = $db->query("SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`,g_a_limit,g_b_limit,g_c_limit FROM `g_send_back` WHERE g_name = '{$Lname}' and g_game_id = '10'  ORDER BY g_id DESC", 0);
		for ($i=0; $i<count($LdetListc); $i++) {
			if($dets==0)
			{
				$aList = $_POST['RebateAXJ'.($i+1)];
				$gbList = $_POST['RebateBXJ'.($i+1)];
				$gcList = $_POST['RebateCXJ'.($i+1)];
			}
			else
			{
				$aList=$gbList=$gcList="";		
			}
			$bList = $_POST['RebateEXJ'.($i+1)];
			$cList = $_POST['RebateFXJ'.($i+1)];
			if($aList!=""){
			if ($aList > 100) exit(back(' 退水最高不超过：100'));}
			if($gbList!=""){
			if ($gbList > 100) exit(back(' 退水最高不超过：100'));}
			if($gcList!=""){
			if ($gcList > 100) exit(back(' 退水最高不超过：100'));}
	
			
			//修改退水
			$sql = "UPDATE `g_panbiao` SET g_id=g_id , ";
			if($aList!=""){$sql.="`g_panlu_a` = '{$aList}',";}
			if($gbList!=""){$sql.="`g_panlu_b` = '{$gbList}',";}
			if($gcList!=""){$sql.="`g_panlu_c` = '{$gcList}',";}
			$sql.="`g_danzhu` = '{$bList}', `g_danxiang` = '{$cList}' WHERE `g_nid` = '{$memberModel[0]['g_name']}' AND g_type = '{$LdetListc[$i][0]}' AND g_game_id = '{$LdetListc[$i][3]}' LIMIT 1";
			$db->query($sql, 2);
		}
		//天津
		$LdetListc = $db->query("SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`,g_a_limit,g_b_limit,g_c_limit FROM `g_send_back` WHERE g_name = '{$Lname}' and g_game_id = '11'  ORDER BY g_id DESC", 0);
		for ($i=0; $i<count($LdetListc); $i++) {
			if($dets==0)
			{
				$aList = $_POST['RebateATJ'.($i+1)];
				$gbList = $_POST['RebateBTJ'.($i+1)];
				$gcList = $_POST['RebateCTJ'.($i+1)];
			}
			else
			{
				$aList=$gbList=$gcList="";		
			}
			$bList = $_POST['RebateETJ'.($i+1)];
			$cList = $_POST['RebateFTJ'.($i+1)];
			if($aList!=""){
			if ($aList > 100) exit(back(' 退水最高不超过：100'));}
			if($gbList!=""){
			if ($gbList > 100) exit(back(' 退水最高不超过：100'));}
			if($gcList!=""){
			if ($gcList > 100) exit(back(' 退水最高不超过：100'));}
	
			
			//修改退水
			$sql = "UPDATE `g_panbiao` SET g_id=g_id , ";
			if($aList!=""){$sql.="`g_panlu_a` = '{$aList}',";}
			if($gbList!=""){$sql.="`g_panlu_b` = '{$gbList}',";}
			if($gcList!=""){$sql.="`g_panlu_c` = '{$gcList}',";}
			$sql.="`g_danzhu` = '{$bList}', `g_danxiang` = '{$cList}' WHERE `g_nid` = '{$memberModel[0]['g_name']}' AND g_type = '{$LdetListc[$i][0]}' AND g_game_id = '{$LdetListc[$i][3]}' LIMIT 1";
			$db->query($sql, 2);
		}
		
		//PK
		$LdetListb = $db->query("SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`,g_a_limit,g_b_limit,g_c_limit FROM `g_send_back` WHERE g_name = '{$Lname}' and g_game_id = '6'  ORDER BY g_id DESC", 0);
		for ($i=0; $i<count($LdetList); $i++) {
			if($dets==0)
			{
				$aList = $_POST['RebateAB'.($i+1)];
				$gbList = $_POST['RebateBB'.($i+1)];
				$gcList = $_POST['RebateCB'.($i+1)];
			}
			else
			{
				$aList=$gbList=$gcList="";		
			}
			$bList = $_POST['RebateEB'.($i+1)];
			$cList = $_POST['RebateFB'.($i+1)];
			if($aList!=""){
			if ($aList > 100) exit(back(' 退水最高不超过：100'));}
			if($gbList!=""){
			if ($gbList > 100) exit(back(' 退水最高不超过：100'));}
			if($gcList!=""){
			if ($gcList > 100) exit(back(' 退水最高不超过：100'));}
	
			
			//修改退水
			$sql = "UPDATE `g_panbiao` SET g_id=g_id , ";
			if($aList!=""){$sql.="`g_panlu_a` = '{$aList}',";}
			if($gbList!=""){$sql.="`g_panlu_b` = '{$gbList}',";}
			if($gcList!=""){$sql.="`g_panlu_c` = '{$gcList}',";}
			$sql.="`g_danzhu` = '{$bList}', `g_danxiang` = '{$cList}' WHERE `g_nid` = '{$memberModel[0]['g_name']}' AND g_type = '{$LdetListb[$i][0]}' AND g_game_id = '{$LdetListb[$i][3]}' LIMIT 1";
			$db->query($sql, 2);
		}
		//飞艇
		$LdetListb = $db->query("SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`,g_a_limit,g_b_limit,g_c_limit FROM `g_send_back` WHERE g_name = '{$Lname}' and g_game_id = '4'  ORDER BY g_id DESC", 0);
		for ($i=0; $i<count($LdetList); $i++) {
			if($dets==0)
			{
				$aList = $_POST['RebateAFT'.($i+1)];
				$gbList = $_POST['RebateBFT'.($i+1)];
				$gcList = $_POST['RebateCFT'.($i+1)];
			}
			else
			{
				$aList=$gbList=$gcList="";		
			}
			$bList = $_POST['RebateEFT'.($i+1)];
			$cList = $_POST['RebateFFT'.($i+1)];
			if($aList!=""){
			if ($aList > 100) exit(back(' 退水最高不超过：100'));}
			if($gbList!=""){
			if ($gbList > 100) exit(back(' 退水最高不超过：100'));}
			if($gcList!=""){
			if ($gcList > 100) exit(back(' 退水最高不超过：100'));}
	
			
			//修改退水
			$sql = "UPDATE `g_panbiao` SET g_id=g_id , ";
			if($aList!=""){$sql.="`g_panlu_a` = '{$aList}',";}
			if($gbList!=""){$sql.="`g_panlu_b` = '{$gbList}',";}
			if($gcList!=""){$sql.="`g_panlu_c` = '{$gcList}',";}
			$sql.="`g_danzhu` = '{$bList}', `g_danxiang` = '{$cList}' WHERE `g_nid` = '{$memberModel[0]['g_name']}' AND g_type = '{$LdetListb[$i][0]}' AND g_game_id = '{$LdetListb[$i][3]}' LIMIT 1";
			$db->query($sql, 2);
		}
		//吉林
		$LdetListj = $db->query("SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`,g_a_limit,g_b_limit,g_c_limit FROM `g_send_back` WHERE g_name = '{$Lname}' and g_game_id = '7'  ORDER BY g_id DESC", 0);
		for ($i=0; $i<count($LdetList); $i++) {
			if($dets==0)
			{
				$aList = $_POST['RebateAJ'.($i+1)];
				$gbList = $_POST['RebateBJ'.($i+1)];
				$gcList = $_POST['RebateCJ'.($i+1)];
			}
			else
			{
				$aList=$gbList=$gcList="";		
			}
			$bList = $_POST['RebateEJ'.($i+1)];
			$cList = $_POST['RebateFJ'.($i+1)];
			if($aList!=""){
			if ($aList > 100) exit(back(' 退水最高不超过：100'));}
			if($gbList!=""){
			if ($gbList > 100) exit(back(' 退水最高不超过：100'));}
			if($gcList!=""){
			if ($gcList > 100) exit(back(' 退水最高不超过：100'));}
	
			
			//修改退水
			$sql = "UPDATE `g_panbiao` SET g_id=g_id , ";
			if($aList!=""){$sql.="`g_panlu_a` = '{$aList}',";}
			if($gbList!=""){$sql.="`g_panlu_b` = '{$gbList}',";}
			if($gcList!=""){$sql.="`g_panlu_c` = '{$gcList}',";}
			$sql.="`g_danzhu` = '{$bList}', `g_danxiang` = '{$cList}' WHERE `g_nid` = '{$memberModel[0]['g_name']}' AND g_type = '{$LdetListj[$i][0]}' AND g_game_id = '{$LdetListj[$i][3]}' LIMIT 1";
			$db->query($sql, 2);
		}
		//快樂8(雙盤)
		$LdetListj = $db->query("SELECT `g_type`, `g_d_limit`, `g_e_limit`, `g_game_id`,g_a_limit,g_b_limit,g_c_limit FROM `g_send_back` WHERE g_name = '{$Lname}' and g_game_id = '8'  ORDER BY g_id DESC", 0);
		for ($i=0; $i<count($LdetList); $i++) {
			if($dets==0)
			{
				$aList = $_POST['RebateAK'.($i+1)];
				$gbList = $_POST['RebateBK'.($i+1)];
				$gcList = $_POST['RebateCK'.($i+1)];
			}
			else
			{
				$aList=$gbList=$gcList="";		
			}
			$bList = $_POST['RebateEK'.($i+1)];
			$cList = $_POST['RebateFK'.($i+1)];
			if($aList!=""){
			if ($aList > 100) exit(back(' 退水最高不超过：100'));}
			if($gbList!=""){
			if ($gbList > 100) exit(back(' 退水最高不超过：100'));}
			if($gcList!=""){
			if ($gcList > 100) exit(back(' 退水最高不超过：100'));}
	
			
			//修改退水
			$sql = "UPDATE `g_panbiao` SET g_id=g_id , ";
			if($aList!=""){$sql.="`g_panlu_a` = '{$aList}',";}
			if($gbList!=""){$sql.="`g_panlu_b` = '{$gbList}',";}
			if($gcList!=""){$sql.="`g_panlu_c` = '{$gcList}',";}
			$sql.="`g_danzhu` = '{$bList}', `g_danxiang` = '{$cList}' WHERE `g_nid` = '{$memberModel[0]['g_name']}' AND g_type = '{$LdetListj[$i][0]}' AND g_game_id = '{$LdetListj[$i][3]}' LIMIT 1";
			$db->query($sql, 2);
		}
		exit(alert_href('更變成功', 'Actfor.php?cid='.$_GET['cid']));
	}
	else 
	{
		exit(alert_href('用戶不存在', 'Actfor.php?cid='.$_GET['cid']));
	}
}
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['uid']) && isset($_GET['cid']))
{
	
	

	//判斷當前用戶是否存在、檢查當前用戶是否已有未結算注單。
	$memberModel = $userModel->GetMemberModel($uid);
	if ($memberModel)
	{
	    if ($memberModel[0]['g_mumber_type'] == 2){
			$nid = mb_substr($memberModel[0]['g_nid'], 0, mb_strlen($memberModel[0]['g_nid'])-32);
		}else {
			$nid = $memberModel[0]['g_nid'];
		}
		$Lname = $userModel->GetUserName_Like($nid);
		$sjuid=$Lname[0]['g_name'];
		//dump($sjuid);
		$detModel = new Detailed();
		$dets = $detModel->GetDetailedsAll($uid);
		
		$memberDetList = $userModel->GetUserMR($uid, true);
		$memberDetListC = $userModel->GetUserMRC($uid, true);
		$memberDetListB = $userModel->GetUserMRP($uid, true);
		$memberDetListJ = $userModel->GetUserMRJ($uid, true);
		$memberDetListK = $userModel->GetUserMRK($uid, true);
		$memberDetList_jx = $userModel->GetUserMRid2($uid,3);
		$memberDetList_xj = $userModel->GetUserMRid2($uid,10);
		$memberDetList_tj = $userModel->GetUserMRid2($uid,11);
		$memberDetList_ft = $userModel->GetUserMRid2($uid,4);
		$memberDetList_nc = $userModel->GetUserMRid2($uid,9);
		
		$memberDetLists = $userModel->GetUserMR($sjuid);
	    $memberDetListCs = $userModel->GetUserMRC($sjuid);
	    $memberDetListBs = $userModel->GetUserMRP($sjuid);
	    $memberDetListJs = $userModel->GetUserMRJ($sjuid);
		$memberDetListKs = $userModel->GetUserMRK($sjuid);
		$memberDetList_jxs = $userModel->GetUserMRid($sjuid,3);
		$memberDetList_xjs = $userModel->GetUserMRid($sjuid,10);
		$memberDetList_tjs = $userModel->GetUserMRid($sjuid,11);
		$memberDetList_fts = $userModel->GetUserMRid($sjuid,4);
		$memberDetList_ncs = $userModel->GetUserMRid($sjuid,9);
		//dump($memberDetLists);
	}
}

?>

<html>
<head><title>

</title><link href="/Css/Common.css" rel="stylesheet" type="text/css" /><link href="/Css/Style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Scripts/Jquery.js"></script>
<script type="text/javascript" src="/Scripts/Common.js"></script>
<script type="text/javascript" src="/Scripts/PublicData.js"></script>
<script type="text/javascript" src="/Scripts/Forbid.js"></script>
<script type="text/javascript">
<!--
    $(function () {
        <?php $P = $memberModel[0]['g_panlus'];?>
         <?php if(strstr($P,'A')!=''){?>
        $("#TS1_A1").val($("#RebateAG1").val());
         <?php }else if(strstr($P,'B')!=''){?>
		 $("#TS1_A2").val($("#RebateBG1").val());
		  <?php }else if(strstr($P,'C')!=''){?>
		  $("#TS1_A3").val($("#RebateCG1").val());
		 <?php }?>
        $("#TS1_A4").val($("#RebateEG1").val());
        $("#TS1_A5").val($("#RebateFG1").val());

          <?php  if(strstr($P,'A')!=''){?>
        $("#TS2_A1").val($("#RebateAG9").val());
          <?php }else if(strstr($P,'B')!=''){?>
		      $("#TS2_A2").val($("#RebateBG9").val());
		    <?php }else if(strstr($P,'C')!=''){?>
			
			    $("#TS2_A3").val($("#RebateCG9").val());
		 <?php }?>	
        $("#TS2_A4").val($("#RebateEG9").val());
        $("#TS2_A5").val($("#RebateFG9").val());
  <?php  if(strstr($P,'A')!=''){?>
       
        $("#TS3_A1").val($("#RebateAG19").val());
          <?php } else if(strstr($P,'B')!=''){?>
		  $("#TS3_A2").val($("#RebateBG19").val());
		    <?php  }else if(strstr($P,'C')!=''){?>
		$("#TS3_A3").val($("#RebateCG19").val());
		 <?php }?>
        $("#TS3_A4").val($("#RebateEG19").val());
        $("#TS3_A5").val($("#RebateFG19").val());

    });
    function isCompare(obj, s, v, sint, className) {
        var sR = document.getElementById("s" + obj.id).value;
        if (!Base.patrn.Decimal.exec(obj.value) || parseFloat(obj.value) < parseFloat(sR)) {
            $(".input2").attr("disabled", "disabled");
            alert(s + " " + v + " 限制退水設置：" + sR);
            obj.focus();
            return false;
        } else if (parseFloat(obj.value) > 100) {
            $(".input2").attr("disabled", "disabled");
            alert(s + " " + v + " 退水設置已超出限定：100%");
            obj.focus();
            return false;
        } else {
            $(".input2").attr("disabled", "");
        }
        if (sint != undefined && className != undefined) {
            if (sint == 1) {
                $("." + className).val(obj.value);
            } 
        }
    }

    function isCompares(obj, s, v, sint, className) {
        var sR = document.getElementById("s" + obj.id).value;
        if (!Base.patrn.Decimal.exec(obj.value) || parseFloat(obj.value) > parseFloat(sR)) {
            $(".input2").attr("disabled", "disabled");
            alert(s + " " + v + " 設置最大值：" + sR);
            obj.focus();
            return false;
        } else {
            $(".input2").attr("disabled", "");
        }
        if (sint == 1) {
            $("." + className).val(obj.value);
        }
    }

    function showTD(strID, classID) {
        $("."+classID).css("display", "none");
        $("#"+strID).css("display", "");
    }

    function isMethod() {
        if (confirm("確定更改退水設置嗎？")) {
            $("#submit").attr("disabled","disabled");
            return true;
        }
        return false;
    }
    function Comparec() {
         <?php  if(strstr($P,'A')!=''){?>
        var A = parseFloat($("#TS3_A1").val());
         <?php  }else if(strstr($P,'B')!=''){?>
		  var B = parseFloat($("#TS3_A2").val());
		  <?php  }else if(strstr($P,'C')!=''){?>
		   var C = parseFloat($("#TS3_A3").val());
		  <?php }?>
        var E = parseInt($("#TS3_A4").val());
        var F = parseInt($("#TS3_A5").val());
        for (var i = 1; i <= 26; i++) {
		if (i == 3 || i == 5|| i==6 || i==7 ) {
		 <?php  if(strstr($P,'A')!=''){?>
                $("#RebateAJ"+i).val(A > parseFloat($("#sRebateAJ"+i).val()) ? A : $("#sRebateAJ"+i).val()).addClass("inp1m");
				  <?php  } else if(strstr($P,'B')!=''){?>
                $("#RebateBJ"+i).val(B > parseFloat($("#sRebateBJ"+i).val()) ? B : $("#sRebateBJ"+i).val()).addClass("inp1m");
				  <?php  }else if(strstr($P,'C')!=''){?>
                $("#RebateCJ"+i).val(C > parseFloat($("#sRebateCJ"+i).val()) ? C : $("#sRebateCJ"+i).val()).addClass("inp1m");
				  <?php }?>
                $("#RebateEJ"+i).val(E < parseFloat($("#sRebateEJ"+i).val()) ? E : $("#sRebateEJ"+i).val()).addClass("inp1m");
                $("#RebateFJ"+i).val(F < parseFloat($("#sRebateFJ"+i).val()) ? F : $("#sRebateFJ"+i).val()).addClass("inp1m");
            } else if (i >= 19) {
			 	<?php  if(strstr($P,'A')!=''){?>
                $("#RebateAG"+i).val(A > parseFloat($("#sRebateAG"+i).val()) ? A : $("#sRebateAG"+i).val()).addClass("inp1m");
                  <?php  } else if(strstr($P,'B')!=''){?>
				$("#RebateBG"+i).val(B > parseFloat($("#sRebateBG"+i).val()) ? B : $("#sRebateBG"+i).val()).addClass("inp1m");
                <?php  }else if(strstr($P,'C')!=''){?>
			    $("#RebateCG"+i).val(C > parseFloat($("#sRebateCG"+i).val()) ? C : $("#sRebateCG"+i).val()).addClass("inp1m");
                <?php }?>
			    $("#RebateEG"+i).val(E < parseFloat($("#sRebateEG"+i).val()) ? E : $("#sRebateEG"+i).val()).addClass("inp1m");
                $("#RebateFG"+i).val(F < parseFloat($("#sRebateFG"+i).val()) ? F : $("#sRebateFG"+i).val()).addClass("inp1m");
                
                <?php  if(strstr($P,'A')!=''){?>
                $("#RebateANC"+i).val(A > parseFloat($("#sRebateANC"+i).val()) ? A : $("#sRebateANC"+i).val()).addClass("inp1m");
                  <?php  } else if(strstr($P,'B')!=''){?>
				$("#RebateBNC"+i).val(B > parseFloat($("#sRebateBNC"+i).val()) ? B : $("#sRebateBNC"+i).val()).addClass("inp1m");
                <?php  }else if(strstr($P,'C')!=''){?>
			    $("#RebateCNC"+i).val(C > parseFloat($("#sRebateCNC"+i).val()) ? C : $("#sRebateCNC"+i).val()).addClass("inp1m");
                <?php }?>
			    $("#RebateENC"+i).val(E < parseFloat($("#sRebateENC"+i).val()) ? E : $("#sRebateENC"+i).val()).addClass("inp1m");
                $("#RebateFNC"+i).val(F < parseFloat($("#sRebateFNC"+i).val()) ? F : $("#sRebateFNC"+i).val()).addClass("inp1m");
            }
            
        }
    }
    function Compareb() {
	<?php  if(strstr($P,'A')!=''){?>
        var A = parseFloat($("#TS2_A1").val());
		 <?php  }else if(strstr($P,'B')!=''){?>
        var B = parseFloat($("#TS2_A2").val());
		  <?php  }else if(strstr($P,'C')!=''){?>
        var C = parseFloat($("#TS2_A3").val());

          <?php }?>
        var E = parseInt($("#TS2_A4").val());
        var F = parseInt($("#TS2_A5").val());
        for (var i = 1; i <= 18; i++) {
             if (i == 1 || i == 2) {
			 <?php  if(strstr($P,'A')!=''){?>
                $("#RebateAJ"+i).val(A > parseFloat($("#sRebateAJ"+i).val()) ? A : $("#sRebateAJ"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'B')!=''){?>
                $("#RebateBJ"+i).val(B > parseFloat($("#sRebateBJ"+i).val()) ? B : $("#sRebateBJ"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'C')!=''){?>
                $("#RebateCJ"+i).val(C > parseFloat($("#sRebateCJ"+i).val()) ? C : $("#sRebateCJ"+i).val()).addClass("inp1m");
				 <?php }?>
                $("#RebateEJ"+i).val(E < parseFloat($("#sRebateEJ"+i).val()) ? E : $("#sRebateEJ"+i).val()).addClass("inp1m");
                $("#RebateFJ"+i).val(F < parseFloat($("#sRebateFJ"+i).val()) ? F : $("#sRebateFJ"+i).val()).addClass("inp1m");
            }
            if (i == 11 || i == 12 || i == 13 || i == 14 || i == 15) {
				<?php  if(strstr($P,'A')!=''){?>
                $("#RebateAB"+i).val(A > parseFloat($("#sRebateAB"+i).val()) ? A : $("#sRebateAB"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'B')!=''){?>
                $("#RebateBB"+i).val(B > parseFloat($("#sRebateBB"+i).val()) ? B : $("#sRebateBB"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'C')!=''){?>
                $("#RebateCB"+i).val(C > parseFloat($("#sRebateCB"+i).val()) ? C : $("#sRebateCB"+i).val()).addClass("inp1m");
				 <?php }?>
                $("#RebateEB"+i).val(E < parseFloat($("#sRebateEB"+i).val()) ? E : $("#sRebateEB"+i).val()).addClass("inp1m");
                $("#RebateFB"+i).val(F < parseFloat($("#sRebateFB"+i).val()) ? F : $("#sRebateFB"+i).val()).addClass("inp1m");
                
                <?php  if(strstr($P,'A')!=''){?>
                $("#RebateAFT"+i).val(A > parseFloat($("#sRebateAFT"+i).val()) ? A : $("#sRebateAFT"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'B')!=''){?>
                $("#RebateBFT"+i).val(B > parseFloat($("#sRebateBFT"+i).val()) ? B : $("#sRebateBFT"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'C')!=''){?>
                $("#RebateCFT"+i).val(C > parseFloat($("#sRebateCFT"+i).val()) ? C : $("#sRebateCFT"+i).val()).addClass("inp1m");
				 <?php }?>
                $("#RebateEFT"+i).val(E < parseFloat($("#sRebateEFT"+i).val()) ? E : $("#sRebateEFT"+i).val()).addClass("inp1m");
                $("#RebateFFT"+i).val(F < parseFloat($("#sRebateFFT"+i).val()) ? F : $("#sRebateFFT"+i).val()).addClass("inp1m");
            }
            if (i >= 6 && i <= 8) {
                 <?php  if(strstr($P,'A')!=''){?>
                $("#RebateAC"+i).val(A > parseFloat($("#sRebateAC"+i).val()) ? A : $("#sRebateAC"+i).val()).addClass("inp1m");
					 <?php  }else if(strstr($P,'B')!=''){?>
                $("#RebateBC"+i).val(B > parseFloat($("#sRebateBC"+i).val()) ? B : $("#sRebateBC"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'C')!=''){?>
                $("#RebateCC"+i).val(C > parseFloat($("#sRebateCC"+i).val()) ? C : $("#sRebateCC"+i).val()).addClass("inp1m");
				 <?php }?>
                $("#RebateEC"+i).val(E < parseFloat($("#sRebateEC"+i).val()) ? E : $("#sRebateEC"+i).val()).addClass("inp1m");
                $("#RebateFC"+i).val(F < parseFloat($("#sRebateFC"+i).val()) ? F : $("#sRebateFC"+i).val()).addClass("inp1m");
                
                <?php  if(strstr($P,'A')!=''){?>
                $("#RebateAJX"+i).val(A > parseFloat($("#sRebateAJX"+i).val()) ? A : $("#sRebateAJX"+i).val()).addClass("inp1m");
					 <?php  }else if(strstr($P,'B')!=''){?>
                $("#RebateBJX"+i).val(B > parseFloat($("#sRebateBJX"+i).val()) ? B : $("#sRebateBJX"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'C')!=''){?>
                $("#RebateCJX"+i).val(C > parseFloat($("#sRebateCJX"+i).val()) ? C : $("#sRebateCJX"+i).val()).addClass("inp1m");
				 <?php }?>
                $("#RebateEJX"+i).val(E < parseFloat($("#sRebateEJX"+i).val()) ? E : $("#sRebateEJX"+i).val()).addClass("inp1m");
                $("#RebateFJX"+i).val(F < parseFloat($("#sRebateFJX"+i).val()) ? F : $("#sRebateFJX"+i).val()).addClass("inp1m");
                
                <?php  if(strstr($P,'A')!=''){?>
                $("#RebateAXJ"+i).val(A > parseFloat($("#sRebateAXJ"+i).val()) ? A : $("#sRebateAXJ"+i).val()).addClass("inp1m");
					 <?php  }else if(strstr($P,'B')!=''){?>
                $("#RebateBXJ"+i).val(B > parseFloat($("#sRebateBXJ"+i).val()) ? B : $("#sRebateBXJ"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'C')!=''){?>
                $("#RebateCXJ"+i).val(C > parseFloat($("#sRebateCXJ"+i).val()) ? C : $("#sRebateCXJ"+i).val()).addClass("inp1m");
				 <?php }?>
                $("#RebateEXJ"+i).val(E < parseFloat($("#sRebateEXJ"+i).val()) ? E : $("#sRebateEXJ"+i).val()).addClass("inp1m");
                $("#RebateFXJ"+i).val(F < parseFloat($("#sRebateFXJ"+i).val()) ? F : $("#sRebateFXJ"+i).val()).addClass("inp1m");
                
                <?php  if(strstr($P,'A')!=''){?>
                $("#RebateATJ"+i).val(A > parseFloat($("#sRebateATJ"+i).val()) ? A : $("#sRebateATJ"+i).val()).addClass("inp1m");
					 <?php  }else if(strstr($P,'B')!=''){?>
                $("#RebateBTJ"+i).val(B > parseFloat($("#sRebateBTJ"+i).val()) ? B : $("#sRebateBTJ"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'C')!=''){?>
                $("#RebateCTJ"+i).val(C > parseFloat($("#sRebateCTJ"+i).val()) ? C : $("#sRebateCTJ"+i).val()).addClass("inp1m");
				 <?php }?>
                $("#RebateETJ"+i).val(E < parseFloat($("#sRebateETJ"+i).val()) ? E : $("#sRebateETJ"+i).val()).addClass("inp1m");
                $("#RebateFTJ"+i).val(F < parseFloat($("#sRebateFTJ"+i).val()) ? F : $("#sRebateFTJ"+i).val()).addClass("inp1m");
				
            } else if (i >= 9 && i <= 12 || i >= 15 && i <= 18) {
			 	<?php  if(strstr($P,'A')!=''){?>
                  $("#RebateAG"+i).val(A > parseFloat($("#sRebateAG"+i).val()) ? A : $("#sRebateAG"+i).val()).addClass("inp1m");
				  	 <?php  }else if(strstr($P,'B')!=''){?>
                $("#RebateBG"+i).val(B > parseFloat($("#sRebateBG"+i).val()) ? B : $("#sRebateBG"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'C')!=''){?>
                $("#RebateCG"+i).val(C > parseFloat($("#sRebateCG"+i).val()) ? C : $("#sRebateCG"+i).val()).addClass("inp1m");
				 <?php }?>
                $("#RebateEG"+i).val(E < parseFloat($("#sRebateEG"+i).val()) ? E : $("#sRebateEG"+i).val()).addClass("inp1m");
                $("#RebateFG"+i).val(F < parseFloat($("#sRebateFG"+i).val()) ? F : $("#sRebateFG"+i).val()).addClass("inp1m");
                
                <?php  if(strstr($P,'A')!=''){?>
                  $("#RebateANC"+i).val(A > parseFloat($("#sRebateANC"+i).val()) ? A : $("#sRebateANC"+i).val()).addClass("inp1m");
				  	 <?php  }else if(strstr($P,'B')!=''){?>
                $("#RebateBNC"+i).val(B > parseFloat($("#sRebateBNC"+i).val()) ? B : $("#sRebateBNC"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'C')!=''){?>
                $("#RebateCNC"+i).val(C > parseFloat($("#sRebateCNC"+i).val()) ? C : $("#sRebateCNC"+i).val()).addClass("inp1m");
				 <?php }?>
                $("#RebateENC"+i).val(E < parseFloat($("#sRebateENC"+i).val()) ? E : $("#sRebateENC"+i).val()).addClass("inp1m");
                $("#RebateFNC"+i).val(F < parseFloat($("#sRebateFNC"+i).val()) ? F : $("#sRebateFNC"+i).val()).addClass("inp1m");
                if ( i== 9 || i == 10) {
				 	<?php  if(strstr($P,'A')!=''){?>
                    $("#RebateAC"+i).val(A > parseFloat($("#sRebateAC"+i).val()) ? A : $("#sRebateAC"+i).val()).addClass("inp1m");
						 <?php  }else if(strstr($P,'B')!=''){?>
                    $("#RebateBC"+i).val(B > parseFloat($("#sRebateBC"+i).val()) ? B : $("#sRebateBC"+i).val()).addClass("inp1m");
					 <?php  }else if(strstr($P,'C')!=''){?>
                    $("#RebateCC"+i).val(C > parseFloat($("#sRebateCC"+i).val()) ? C : $("#sRebateCC"+i).val()).addClass("inp1m");
					 <?php }?>
                    $("#RebateEC"+i).val(E < parseFloat($("#sRebateEC"+i).val()) ? E : $("#sRebateEC"+i).val()).addClass("inp1m");
                    $("#RebateFC"+i).val(F < parseFloat($("#sRebateFC"+i).val()) ? F : $("#sRebateFC"+i).val()).addClass("inp1m");
                    
                    <?php  if(strstr($P,'A')!=''){?>
                    $("#RebateAJX"+i).val(A > parseFloat($("#sRebateAJX"+i).val()) ? A : $("#sRebateAJX"+i).val()).addClass("inp1m");
						 <?php  }else if(strstr($P,'B')!=''){?>
                    $("#RebateBJX"+i).val(B > parseFloat($("#sRebateBJX"+i).val()) ? B : $("#sRebateBJX"+i).val()).addClass("inp1m");
					 <?php  }else if(strstr($P,'C')!=''){?>
                    $("#RebateCJX"+i).val(C > parseFloat($("#sRebateCJX"+i).val()) ? C : $("#sRebateCJX"+i).val()).addClass("inp1m");
					 <?php }?>
                    $("#RebateEJX"+i).val(E < parseFloat($("#sRebateEJX"+i).val()) ? E : $("#sRebateEJX"+i).val()).addClass("inp1m");
                    $("#RebateFJX"+i).val(F < parseFloat($("#sRebateFJX"+i).val()) ? F : $("#sRebateFJX"+i).val()).addClass("inp1m");
                    
                    <?php  if(strstr($P,'A')!=''){?>
                    $("#RebateAXJ"+i).val(A > parseFloat($("#sRebateAXJ"+i).val()) ? A : $("#sRebateAXJ"+i).val()).addClass("inp1m");
						 <?php  }else if(strstr($P,'B')!=''){?>
                    $("#RebateBXJ"+i).val(B > parseFloat($("#sRebateBXJ"+i).val()) ? B : $("#sRebateBXJ"+i).val()).addClass("inp1m");
					 <?php  }else if(strstr($P,'C')!=''){?>
                    $("#RebateCXJ"+i).val(C > parseFloat($("#sRebateCXJ"+i).val()) ? C : $("#sRebateCXJ"+i).val()).addClass("inp1m");
					 <?php }?>
                    $("#RebateEXJ"+i).val(E < parseFloat($("#sRebateEXJ"+i).val()) ? E : $("#sRebateEXJ"+i).val()).addClass("inp1m");
                    $("#RebateFXJ"+i).val(F < parseFloat($("#sRebateFXJ"+i).val()) ? F : $("#sRebateFXJ"+i).val()).addClass("inp1m");
                    
                    <?php  if(strstr($P,'A')!=''){?>
                    $("#RebateATJ"+i).val(A > parseFloat($("#sRebateATJ"+i).val()) ? A : $("#sRebateATJ"+i).val()).addClass("inp1m");
						 <?php  }else if(strstr($P,'B')!=''){?>
                    $("#RebateBTJ"+i).val(B > parseFloat($("#sRebateBTJ"+i).val()) ? B : $("#sRebateBTJ"+i).val()).addClass("inp1m");
					 <?php  }else if(strstr($P,'C')!=''){?>
                    $("#RebateCTJ"+i).val(C > parseFloat($("#sRebateCTJ"+i).val()) ? C : $("#sRebateCTJ"+i).val()).addClass("inp1m");
					 <?php }?>
                    $("#RebateETJ"+i).val(E < parseFloat($("#sRebateETJ"+i).val()) ? E : $("#sRebateETJ"+i).val()).addClass("inp1m");
                    $("#RebateFTJ"+i).val(F < parseFloat($("#sRebateFTJ"+i).val()) ? F : $("#sRebateFTJ"+i).val()).addClass("inp1m");
                }
            }
        }
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateAK2").val(A > parseFloat($("#sRebateAK2").val()) ? A : $("#sRebateAK2").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBK2").val(B > parseFloat($("#sRebateBK2").val()) ? B : $("#sRebateBK2").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCK2").val(C > parseFloat($("#sRebateCK2").val()) ? C : $("#sRebateCK2").val()).addClass("inp1m");
        <?php }?>
		$("#RebateEK2").val(E < parseFloat($("#sRebateEK2").val()) ? E : $("#sRebateEK2").val()).addClass("inp1m");
		$("#RebateFK2").val(F < parseFloat($("#sRebateFK2").val()) ? F : $("#sRebateFK2").val()).addClass("inp1m");
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateAK3").val(A > parseFloat($("#sRebateAK3").val()) ? A : $("#sRebateAK3").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBK3").val(B > parseFloat($("#sRebateBK3").val()) ? B : $("#sRebateBK3").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCK3").val(C > parseFloat($("#sRebateCK3").val()) ? C : $("#sRebateCK3").val()).addClass("inp1m");
        <?php }?>
		$("#RebateEK3").val(E < parseFloat($("#sRebateEK3").val()) ? E : $("#sRebateEK3").val()).addClass("inp1m");
		$("#RebateFK3").val(F < parseFloat($("#sRebateFK3").val()) ? F : $("#sRebateFK3").val()).addClass("inp1m");
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateAK6").val(A > parseFloat($("#sRebateAK6").val()) ? A : $("#sRebateAK6").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBK6").val(B > parseFloat($("#sRebateBK6").val()) ? B : $("#sRebateBK6").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCK6").val(C > parseFloat($("#sRebateCK6").val()) ? C : $("#sRebateCK6").val()).addClass("inp1m");
        <?php }?>
		$("#RebateEK6").val(E < parseFloat($("#sRebateEK6").val()) ? E : $("#sRebateEK6").val()).addClass("inp1m");
		$("#RebateFK6").val(F < parseFloat($("#sRebateFK6").val()) ? F : $("#sRebateFK6").val()).addClass("inp1m");
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateAK7").val(A > parseFloat($("#sRebateAK7").val()) ? A : $("#sRebateAK7").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBK7").val(B > parseFloat($("#sRebateBK7").val()) ? B : $("#sRebateBK7").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCK7").val(C > parseFloat($("#sRebateCK7").val()) ? C : $("#sRebateCK7").val()).addClass("inp1m");
        <?php }?>
		$("#RebateEK7").val(E < parseFloat($("#sRebateEK7").val()) ? E : $("#sRebateEK7").val()).addClass("inp1m");
		$("#RebateFK7").val(F < parseFloat($("#sRebateFK7").val()) ? F : $("#sRebateFK7").val()).addClass("inp1m");
    }

    function Comparer() {
	    <?php  if(strstr($P,'A')!=''){?>
        var A = parseFloat($("#TS1_A1").val());
		 <?php  }else if(strstr($P,'B')!=''){?>
        var B = parseFloat($("#TS1_A2").val());
		 <?php  }else if(strstr($P,'C')!=''){?>
        var C = parseFloat($("#TS1_A3").val());
        <?php }?>
        var E = parseInt($("#TS1_A4").val());
        var F = parseInt($("#TS1_A5").val());
        for (var i = 1; i <= 10; i++) {
            if (i <= 8) {
                if (i <= 5) {
					<?php  if(strstr($P,'A')!=''){?>
                    $("#RebateAC"+i).val(A > parseFloat($("#sRebateAC"+i).val()) ? A : $("#sRebateAC"+i).val()).addClass("inp1m");
					 <?php  }else if(strstr($P,'B')!=''){?>
                    $("#RebateBC"+i).val(B > parseFloat($("#sRebateBC"+i).val()) ? B : $("#sRebateBC"+i).val()).addClass("inp1m");
					<?php  }else if(strstr($P,'C')!=''){?>
                    $("#RebateCC"+i).val(C > parseFloat($("#sRebateCC"+i).val()) ? C : $("#sRebateCC"+i).val()).addClass("inp1m");
					   <?php }?>
                    $("#RebateEC"+i).val(E < parseFloat($("#sRebateEC"+i).val()) ? E : $("#sRebateEC"+i).val()).addClass("inp1m");
                    $("#RebateFC"+i).val(F < parseFloat($("#sRebateFC"+i).val()) ? F : $("#sRebateFC"+i).val()).addClass("inp1m");
                    
                    <?php  if(strstr($P,'A')!=''){?>
                    $("#RebateAJX"+i).val(A > parseFloat($("#sRebateAJX"+i).val()) ? A : $("#sRebateAJX"+i).val()).addClass("inp1m");
					 <?php  }else if(strstr($P,'B')!=''){?>
                    $("#RebateBJX"+i).val(B > parseFloat($("#sRebateBJX"+i).val()) ? B : $("#sRebateBJX"+i).val()).addClass("inp1m");
					<?php  }else if(strstr($P,'C')!=''){?>
                    $("#RebateCJX"+i).val(C > parseFloat($("#sRebateCJX"+i).val()) ? C : $("#sRebateCJX"+i).val()).addClass("inp1m");
					   <?php }?>
                    $("#RebateEJX"+i).val(E < parseFloat($("#sRebateEJX"+i).val()) ? E : $("#sRebateEJX"+i).val()).addClass("inp1m");
                    $("#RebateFJX"+i).val(F < parseFloat($("#sRebateFJX"+i).val()) ? F : $("#sRebateFJX"+i).val()).addClass("inp1m");
                    
                    <?php  if(strstr($P,'A')!=''){?>
                    $("#RebateAXJ"+i).val(A > parseFloat($("#sRebateAXJ"+i).val()) ? A : $("#sRebateAXJ"+i).val()).addClass("inp1m");
					 <?php  }else if(strstr($P,'B')!=''){?>
                    $("#RebateBXJ"+i).val(B > parseFloat($("#sRebateBXJ"+i).val()) ? B : $("#sRebateBXJ"+i).val()).addClass("inp1m");
					<?php  }else if(strstr($P,'C')!=''){?>
                    $("#RebateCXJ"+i).val(C > parseFloat($("#sRebateCXJ"+i).val()) ? C : $("#sRebateCXJ"+i).val()).addClass("inp1m");
					   <?php }?>
                    $("#RebateEXJ"+i).val(E < parseFloat($("#sRebateEXJ"+i).val()) ? E : $("#sRebateEXJ"+i).val()).addClass("inp1m");
                    $("#RebateFXJ"+i).val(F < parseFloat($("#sRebateFXJ"+i).val()) ? F : $("#sRebateFXJ"+i).val()).addClass("inp1m");
                    
                    <?php  if(strstr($P,'A')!=''){?>
                    $("#RebateATJ"+i).val(A > parseFloat($("#sRebateATJ"+i).val()) ? A : $("#sRebateATJ"+i).val()).addClass("inp1m");
					 <?php  }else if(strstr($P,'B')!=''){?>
                    $("#RebateBTJ"+i).val(B > parseFloat($("#sRebateBTJ"+i).val()) ? B : $("#sRebateBTJ"+i).val()).addClass("inp1m");
					<?php  }else if(strstr($P,'C')!=''){?>
                    $("#RebateCTJ"+i).val(C > parseFloat($("#sRebateCTJ"+i).val()) ? C : $("#sRebateCTJ"+i).val()).addClass("inp1m");
					   <?php }?>
                    $("#RebateETJ"+i).val(E < parseFloat($("#sRebateETJ"+i).val()) ? E : $("#sRebateETJ"+i).val()).addClass("inp1m");
                    $("#RebateFTJ"+i).val(F < parseFloat($("#sRebateFTJ"+i).val()) ? F : $("#sRebateFTJ"+i).val()).addClass("inp1m");
                }
				<?php  if(strstr($P,'A')!=''){?>
                $("#RebateAG"+i).val(A > parseFloat($("#sRebateAG"+i).val()) ? A : $("#sRebateAG"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'B')!=''){?>
                $("#RebateBG"+i).val(B > parseFloat($("#sRebateBG"+i).val()) ? B : $("#sRebateBG"+i).val()).addClass("inp1m");
				<?php  }else if(strstr($P,'C')!=''){?>
                $("#RebateCG"+i).val(C > parseFloat($("#sRebateCG"+i).val()) ? C : $("#sRebateCG"+i).val()).addClass("inp1m");
				   <?php }?>
                $("#RebateEG"+i).val(E < parseFloat($("#sRebateEG"+i).val()) ? E : $("#sRebateEG"+i).val()).addClass("inp1m");
                $("#RebateFG"+i).val(F < parseFloat($("#sRebateFG"+i).val()) ? F : $("#sRebateFG"+i).val()).addClass("inp1m");
                
                <?php  if(strstr($P,'A')!=''){?>
                $("#RebateANC"+i).val(A > parseFloat($("#sRebateANC"+i).val()) ? A : $("#sRebateANC"+i).val()).addClass("inp1m");
				 <?php  }else if(strstr($P,'B')!=''){?>
                $("#RebateBNC"+i).val(B > parseFloat($("#sRebateBNC"+i).val()) ? B : $("#sRebateBNC"+i).val()).addClass("inp1m");
				<?php  }else if(strstr($P,'C')!=''){?>
                $("#RebateCNC"+i).val(C > parseFloat($("#sRebateCNC"+i).val()) ? C : $("#sRebateCNC"+i).val()).addClass("inp1m");
				   <?php }?>
                $("#RebateENC"+i).val(E < parseFloat($("#sRebateENC"+i).val()) ? E : $("#sRebateENC"+i).val()).addClass("inp1m");
                $("#RebateFNC"+i).val(F < parseFloat($("#sRebateFNC"+i).val()) ? F : $("#sRebateFNC"+i).val()).addClass("inp1m");
                
            }
            <?php  if(strstr($P,'A')!=''){?>
            $("#RebateAB"+i).val(A > parseFloat($("#sRebateAB"+i).val()) ? A : $("#sRebateAB"+i).val()).addClass("inp1m");
			 <?php  }else if(strstr($P,'B')!=''){?>
            $("#RebateBB"+i).val(B > parseFloat($("#sRebateBB"+i).val()) ? B : $("#sRebateBB"+i).val()).addClass("inp1m");
			<?php  }else if(strstr($P,'C')!=''){?>
            $("#RebateCB"+i).val(C > parseFloat($("#sRebateCB"+i).val()) ? C : $("#sRebateCB"+i).val()).addClass("inp1m");
			   <?php }?>
            $("#RebateEB"+i).val(E < parseFloat($("#sRebateEB"+i).val()) ? E : $("#sRebateEB"+i).val()).addClass("inp1m");
            $("#RebateFB"+i).val(F < parseFloat($("#sRebateFB"+i).val()) ? F : $("#sRebateFB"+i).val()).addClass("inp1m");
            
            <?php  if(strstr($P,'A')!=''){?>
            $("#RebateAFT"+i).val(A > parseFloat($("#sRebateAFT"+i).val()) ? A : $("#sRebateAFT"+i).val()).addClass("inp1m");
			 <?php  }else if(strstr($P,'B')!=''){?>
            $("#RebateBFT"+i).val(B > parseFloat($("#sRebateBFT"+i).val()) ? B : $("#sRebateBFT"+i).val()).addClass("inp1m");
			<?php  }else if(strstr($P,'C')!=''){?>
            $("#RebateCFT"+i).val(C > parseFloat($("#sRebateCFT"+i).val()) ? C : $("#sRebateCFT"+i).val()).addClass("inp1m");
			   <?php }?>
            $("#RebateEFT"+i).val(E < parseFloat($("#sRebateEFT"+i).val()) ? E : $("#sRebateEFT"+i).val()).addClass("inp1m");
            $("#RebateFFT"+i).val(F < parseFloat($("#sRebateFFT"+i).val()) ? F : $("#sRebateFFT"+i).val()).addClass("inp1m");
        }
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateAG13").val(A > parseFloat($("#sRebateAG13").val()) ? A : $("#sRebateAG13").val()).addClass("inp1m");
		<?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBG13").val(B > parseFloat($("#sRebateBG13").val()) ? B : $("#sRebateBG13").val()).addClass("inp1m");
		<?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCG13").val(C > parseFloat($("#sRebateCG13").val()) ? C : $("#sRebateCG13").val()).addClass("inp1m");
		<?php }?>
		$("#RebateEG13").val(E < parseFloat($("#sRebateEG13").val()) ? E : $("#sRebateEG13").val()).addClass("inp1m");
		$("#RebateFG13").val(F < parseFloat($("#sRebateFG13").val()) ? F : $("#sRebateFG13").val()).addClass("inp1m");
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateAG14").val(A > parseFloat($("#sRebateAG14").val()) ? A : $("#sRebateAG14").val()).addClass("inp1m");
		<?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBG14").val(B > parseFloat($("#sRebateBG14").val()) ? B : $("#sRebateBG14").val()).addClass("inp1m");
		<?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCG14").val(C > parseFloat($("#sRebateCG14").val()) ? C : $("#sRebateCG14").val()).addClass("inp1m");
		<?php }?>
		$("#RebateEG14").val(E < parseFloat($("#sRebateEG14").val()) ? E : $("#sRebateEG14").val()).addClass("inp1m");
		$("#RebateFG14").val(F < parseFloat($("#sRebateFG14").val()) ? F : $("#sRebateFG14").val()).addClass("inp1m");
		
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateANC13").val(A > parseFloat($("#sRebateANC13").val()) ? A : $("#sRebateANC13").val()).addClass("inp1m");
		<?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBNC13").val(B > parseFloat($("#sRebateBNC13").val()) ? B : $("#sRebateBNC13").val()).addClass("inp1m");
		<?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCNC13").val(C > parseFloat($("#sRebateCNC13").val()) ? C : $("#sRebateCNC13").val()).addClass("inp1m");
		<?php }?>
		$("#RebateENC13").val(E < parseFloat($("#sRebateENC13").val()) ? E : $("#sRebateENC13").val()).addClass("inp1m");
		$("#RebateFNC13").val(F < parseFloat($("#sRebateFNC13").val()) ? F : $("#sRebateFNC13").val()).addClass("inp1m");
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateANC14").val(A > parseFloat($("#sRebateANC14").val()) ? A : $("#sRebateANC14").val()).addClass("inp1m");
		<?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBNC14").val(B > parseFloat($("#sRebateBNC14").val()) ? B : $("#sRebateBNC14").val()).addClass("inp1m");
		<?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCNC14").val(C > parseFloat($("#sRebateCNC14").val()) ? C : $("#sRebateCNC14").val()).addClass("inp1m");
		<?php }?>
		$("#RebateENC14").val(E < parseFloat($("#sRebateENC14").val()) ? E : $("#sRebateENC14").val()).addClass("inp1m");
		$("#RebateFNC14").val(F < parseFloat($("#sRebateFNC14").val()) ? F : $("#sRebateFNC14").val()).addClass("inp1m");
		for(i=11;i<=13;i++)
		{
			<?php  if(strstr($P,'A')!=''){?>
			$("#RebateAC"+i).val(A > parseFloat($("#sRebateAC"+i).val()) ? A : $("#sRebateAC"+i).val()).addClass("inp1m");
			<?php  }elseif(strstr($P,'B')!=''){?>
			$("#RebateBC"+i).val(B > parseFloat($("#sRebateBC"+i).val()) ? B : $("#sRebateBC"+i).val()).addClass("inp1m");
			<?php  }elseif(strstr($P,'C')!=''){?>
			$("#RebateCC"+i).val(C > parseFloat($("#sRebateCC"+i).val()) ? C : $("#sRebateCC"+i).val()).addClass("inp1m");
			<?php }?>
			$("#RebateEC"+i).val(E < parseFloat($("#sRebateEC"+i).val()) ? E : $("#sRebateEC"+i).val()).addClass("inp1m");
			$("#RebateFC"+i).val(F < parseFloat($("#sRebateFC"+i).val()) ? F : $("#sRebateFC"+i).val()).addClass("inp1m");	
			
				<?php  if(strstr($P,'A')!=''){?>
			$("#RebateAJX"+i).val(A > parseFloat($("#sRebateAJX"+i).val()) ? A : $("#sRebateAJX"+i).val()).addClass("inp1m");
			<?php  }elseif(strstr($P,'B')!=''){?>
			$("#RebateBJX"+i).val(B > parseFloat($("#sRebateBJX"+i).val()) ? B : $("#sRebateBJX"+i).val()).addClass("inp1m");
			<?php  }elseif(strstr($P,'C')!=''){?>
			$("#RebateCJX"+i).val(C > parseFloat($("#sRebateCJX"+i).val()) ? C : $("#sRebateCJX"+i).val()).addClass("inp1m");
			<?php }?>
			$("#RebateEJX"+i).val(E < parseFloat($("#sRebateEJX"+i).val()) ? E : $("#sRebateEJX"+i).val()).addClass("inp1m");
			$("#RebateFJX"+i).val(F < parseFloat($("#sRebateFJX"+i).val()) ? F : $("#sRebateFJX"+i).val()).addClass("inp1m");	
			
				<?php  if(strstr($P,'A')!=''){?>
			$("#RebateAXJ"+i).val(A > parseFloat($("#sRebateAXJ"+i).val()) ? A : $("#sRebateAXJ"+i).val()).addClass("inp1m");
			<?php  }elseif(strstr($P,'B')!=''){?>
			$("#RebateBXJ"+i).val(B > parseFloat($("#sRebateBXJ"+i).val()) ? B : $("#sRebateBXJ"+i).val()).addClass("inp1m");
			<?php  }elseif(strstr($P,'C')!=''){?>
			$("#RebateCXJ"+i).val(C > parseFloat($("#sRebateCXJ"+i).val()) ? C : $("#sRebateCXJ"+i).val()).addClass("inp1m");
			<?php }?>
			$("#RebateEXJ"+i).val(E < parseFloat($("#sRebateEXJ"+i).val()) ? E : $("#sRebateEXJ"+i).val()).addClass("inp1m");
			$("#RebateFXJ"+i).val(F < parseFloat($("#sRebateFXJ"+i).val()) ? F : $("#sRebateFXJ"+i).val()).addClass("inp1m");	
			
				<?php  if(strstr($P,'A')!=''){?>
			$("#RebateATJ"+i).val(A > parseFloat($("#sRebateATJ"+i).val()) ? A : $("#sRebateATJ"+i).val()).addClass("inp1m");
			<?php  }elseif(strstr($P,'B')!=''){?>
			$("#RebateBTJ"+i).val(B > parseFloat($("#sRebateBTJ"+i).val()) ? B : $("#sRebateBTJ"+i).val()).addClass("inp1m");
			<?php  }elseif(strstr($P,'C')!=''){?>
			$("#RebateCTJ"+i).val(C > parseFloat($("#sRebateCTJ"+i).val()) ? C : $("#sRebateCTJ"+i).val()).addClass("inp1m");
			<?php }?>
			$("#RebateETJ"+i).val(E < parseFloat($("#sRebateETJ"+i).val()) ? E : $("#sRebateETJ"+i).val()).addClass("inp1m");
			$("#RebateFTJ"+i).val(F < parseFloat($("#sRebateFTJ"+i).val()) ? F : $("#sRebateFTJ"+i).val()).addClass("inp1m");	
		}
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateAB16").val(A > parseFloat($("#sRebateAB16").val()) ? A : $("#sRebateAB16").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBB16").val(B > parseFloat($("#sRebateBB16").val()) ? B : $("#sRebateBB16").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCB16").val(C > parseFloat($("#sRebateCB16").val()) ? C : $("#sRebateCB16").val()).addClass("inp1m");
        <?php }?>
		$("#RebateEB16").val(E < parseFloat($("#sRebateEB16").val()) ? E : $("#sRebateEB16").val()).addClass("inp1m");
		$("#RebateFB16").val(F < parseFloat($("#sRebateFB16").val()) ? F : $("#sRebateFB16").val()).addClass("inp1m");
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateAJ4").val(A > parseFloat($("#sRebateAJ4").val()) ? A : $("#sRebateAJ4").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBJ4").val(B > parseFloat($("#sRebateBJ4").val()) ? B : $("#sRebateBJ4").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCJ4").val(C > parseFloat($("#sRebateCJ4").val()) ? C : $("#sRebateCJ4").val()).addClass("inp1m");
        <?php }?>
		$("#RebateEJ4").val(E < parseFloat($("#sRebateEJ4").val()) ? E : $("#sRebateEJ4").val()).addClass("inp1m");
		$("#RebateFJ4").val(F < parseFloat($("#sRebateFJ4").val()) ? F : $("#sRebateFJ4").val()).addClass("inp1m");
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateAK4").val(A > parseFloat($("#sRebateAK4").val()) ? A : $("#sRebateAK4").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBK4").val(B > parseFloat($("#sRebateBK4").val()) ? B : $("#sRebateBK4").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCK4").val(C > parseFloat($("#sRebateCK4").val()) ? C : $("#sRebateCK4").val()).addClass("inp1m");
        <?php }?>
		$("#RebateEK4").val(E < parseFloat($("#sRebateEK4").val()) ? E : $("#sRebateEK4").val()).addClass("inp1m");
		$("#RebateFK4").val(F < parseFloat($("#sRebateFK4").val()) ? F : $("#sRebateFK4").val()).addClass("inp1m");
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateAK5").val(A > parseFloat($("#sRebateAK5").val()) ? A : $("#sRebateAK5").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBK5").val(B > parseFloat($("#sRebateBK5").val()) ? B : $("#sRebateBK5").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCK5").val(C > parseFloat($("#sRebateCK5").val()) ? C : $("#sRebateCK5").val()).addClass("inp1m");
        <?php }?>
		$("#RebateEK5").val(E < parseFloat($("#sRebateEK5").val()) ? E : $("#sRebateEK5").val()).addClass("inp1m");
		$("#RebateFK5").val(F < parseFloat($("#sRebateFK5").val()) ? F : $("#sRebateFK5").val()).addClass("inp1m");
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateAK8").val(A > parseFloat($("#sRebateAK8").val()) ? A : $("#sRebateAK8").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBK8").val(B > parseFloat($("#sRebateBK8").val()) ? B : $("#sRebateBK8").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCK8").val(C > parseFloat($("#sRebateCK8").val()) ? C : $("#sRebateCK8").val()).addClass("inp1m");
        <?php }?>
		$("#RebateEK8").val(E < parseFloat($("#sRebateEK8").val()) ? E : $("#sRebateEK8").val()).addClass("inp1m");
		$("#RebateFK8").val(F < parseFloat($("#sRebateFK8").val()) ? F : $("#sRebateFK8").val()).addClass("inp1m");
		<?php  if(strstr($P,'A')!=''){?>
		$("#RebateAK1").val(A > parseFloat($("#sRebateAK1").val()) ? A : $("#sRebateAK1").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'B')!=''){?>
		$("#RebateBK1").val(B > parseFloat($("#sRebateBK1").val()) ? B : $("#sRebateBK1").val()).addClass("inp1m");
        <?php  }elseif(strstr($P,'C')!=''){?>
		$("#RebateCK1").val(C > parseFloat($("#sRebateCK1").val()) ? C : $("#sRebateCK1").val()).addClass("inp1m");
        <?php }?>
		$("#RebateEK1").val(E < parseFloat($("#sRebateEK1").val()) ? E : $("#sRebateEK1").val()).addClass("inp1m");
		$("#RebateFK1").val(F < parseFloat($("#sRebateFK1").val()) ? F : $("#sRebateFK1").val()).addClass("inp1m");
    }
    function historys() {
        location.href = "Menber.php";
    }
//-->
</script>
</head>
<body onselectstart="return false">
<form action="" method="post" onSubmit="return isMethod()">
<input type="hidden" name="name" value="<?php echo $memberModel[0]['g_name']?>" />
<?php $P = $memberModel[0]['g_panlus'];?>
<?php if(strstr($P,'A')!=''){echo "<input type='hidden' name='typeida' value='A' />";}?>
<?php if(strstr($P,'B')!=''){echo "<input type='hidden' name='typeidb' value='B' />";}?>
<?php if(strstr($P,'C')!=''){echo "<input type='hidden' name='typeidc' value='C' />";}?>
<table border="0" cellspacing="0" cellpadding="0" class="Main">
    <tr>
        <td class="Main_top_left"></td>
        <td background="/Css/tab_05.gif">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="20" align="right"><img style="margin-right:5px" src="/Css/tb.gif" width="16" height="16" alt="" /></td>
                    <td id="titleName" class="Main_Title">退水設定 -> 會員（ &nbsp;&nbsp;&nbsp;<span style="font-weight:normal"><?php echo $memberModel[0]['g_name']?></span> &nbsp;&nbsp;&nbsp;）</td>

                    <td id="F_Name" width="150" align="right">會員名稱：<?php echo $memberModel[0]['g_f_name']?></td>

                </tr>
            </table>
        </td>
        <td class="Main_top_right"></td>
    </tr>
    <tr>
        <td class="Main_left"></td>
        <td class="Main_conter">
        <!-- strat -->
            <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter2 az">
                <tr class="Conter_top_2">
                    <th colspan="7" background="/Css/bg_g.jpg"  style="border:none">大項快速設置【注意：設置高於上級最高限制時按最高可調】</th>
                </tr>
                <tr class="Conter_top_2 Ct">
                    <td background="/Css/bg_g.jpg" >調整項目</td>
                    
                    <td background="/Css/bg_g.jpg" width="10%"> <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "A盤";}?>
												<?php if(strstr($P,'B')!=''){echo "B盤";}?>
												<?php if(strstr($P,'C')!=''){echo "C盤";}?></td>
                    
                    <td background="/Css/bg_g.jpg" width="17%">單註限額</td>
                    <td background="/Css/bg_g.jpg" width="17%">單期限額</td>
                    <td background="/Css/bg_g.jpg" width="80">…</td>
                </tr>
                <tr class="Ct" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                    <td class="t_list_tr_1_g">特碼類(第一球、第二球、冠軍 …)</td><?php $P = $memberModel[0]['g_panlus'];?>
                    <?php  if(strstr($P,'A')!=''){?>
                      <td class="TD_TS1"><input style="width:60px;" id="TS1_A1" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                       <?php  }else if(strstr($P,'B')!=''){?>
                    <td class="TD_TS1"><input style="width:60px;" id="TS1_A2" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    	<?php  }else if(strstr($P,'C')!=''){?>
                    <td class="TD_TS1"><input style="width:60px;" id="TS1_A3" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    
 <?php }?>
                    
                    <td><input style="width:90px;" id="TS1_A4" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:90px;" id="TS1_A5" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td class="TD_TS1"><input type="button" onMouseOver="this.className='input2_2'" onMouseOut="this.className='input2'" class="input2" onClick="Comparer()" value="修改" /></td>
                </tr>
                <tr class="Ct" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                    <td class="t_list_tr_1_g">兩面類(單雙、大小、龍虎 …)</td><?php $P = $memberModel[0]['g_panlus'];?>
                        <?php  if(strstr($P,'A')!=''){?>
                    <td class="TD_TS2"><input style="width:60px;" id="TS2_A1" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                      <?php  }else if(strstr($P,'B')!=''){?>
                    <td  class="TD_TS2"><input style="width:60px;" id="TS2_A2" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <?php  }else if(strstr($P,'C')!=''){?>
                    <td  class="TD_TS2"><input style="width:60px;" id="TS2_A3" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                     <?php }?>
                    <td><input style="width:90px;" id="TS2_A4" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:90px;" id="TS2_A5" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td class="TD_TS2"><input type="button" name="submit" onMouseOver="this.className='input2_2'" onMouseOut="this.className='input2'" class="input2" onClick="Compareb()" value="修改" /></td>
                </tr>
                <tr class="Ct" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                    <td class="t_list_tr_1_g">連碼類(任選二、任選三 …)</td><?php $P = $memberModel[0]['g_panlus'];?>
                     <?php  if(strstr($P,'A')!=''){?>
                     <td class="TD_TS3"><input style="width:60px;" id="TS3_A1" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>    <?php  }else if(strstr($P,'B')!=''){?>
                    <td class="TD_TS3"><input style="width:60px;" id="TS3_A2" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <?php  }else if(strstr($P,'C')!=''){?>
                    <td class="TD_TS3"><input style="width:60px;" id="TS3_A3" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                      <?php }?>
                    <td><input style="width:90px;" id="TS3_A4" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td><input style="width:90px;" id="TS3_A5" onFocus="this.className='inp1m'" onBlur="this.className='inp1'" class='inp1' /></td>
                    <td class="TD_TS3"><input type="button" name="submit" onMouseOver="this.className='input2_2'" onMouseOut="this.className='input2'" class="input2" onClick="Comparec()" value="修改" /></td>
                </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
		 
                <tr style="<?php  if($peizhigdklsf!="1"){ echo "display:none;";}?>">
                    <td colspan="2">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">廣東快樂十分</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="<?php  if($peizhigdklsf!="1"){ echo "display:none;";}?>">
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <td>交易類型</td>
                                
                                <td> <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "A盤";}?>
												<?php if(strstr($P,'B')!=''){echo "B盤";}?>
												<?php if(strstr($P,'C')!=''){echo "C盤";}?></td>
                                
                                <td>單註限額</td>
                                <td>單期限額</td>
                            </tr>
                            <?php for ($i=0;$i<1;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $memberDetList[$i]['g_type']?><input type="hidden" name="G<?php echo $i+1;?>" id="G<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAG<?php echo $i+1;?>" id="RebateAG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $memberDetList[$i]['g_type']?>', 'A盤', '1', 'ga')" 
                                    value='<?php echo $memberDetList[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAG<?php echo $i+1;?>" id="sRebateAG<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetLists[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBG<?php echo $i+1;?>" id="RebateBG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList[$i]['g_type']?>', 'B盤', '1', 'gb')" 
                                    value='<?php echo $memberDetList[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBG<?php echo $i+1;?>" id="sRebateBG<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetLists[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCG<?php echo $i+1;?>" id="RebateCG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList[$i]['g_type']?>', 'C盤', '1', 'gc')" 
                                    value='<?php echo $memberDetList[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCG<?php echo $i+1;?>" id="sRebateCG<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetLists[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEG<?php echo $i+1;?>" id="RebateEG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $memberDetList[$i]['g_type']?>', '單註限額', '1', 'ge')"
                                    value='<?php echo $memberDetList[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateEG<?php echo $i+1;?>" value="<?php echo $memberDetLists[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFG<?php echo $i+1;?>" id="RebateFG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList[$i]['g_type']?>', '單期限額', '1', 'gf')"
                                    value='<?php echo $memberDetList[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateFG<?php echo $i+1;?>" value="<?php echo $memberDetLists[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                          <?php for ($i=1;$i<13;$i++){?> 
                                                    <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<8){echo "1";}else if($i==12 or $i==13){echo "3";}else{echo "2";}?>"><?php echo $memberDetList[$i]['g_type']?><input type="hidden" name="G<?php echo $i+1;?>" id="G<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAG<?php echo $i+1;?>" id="RebateAG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $memberDetList[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $memberDetList[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAG<?php echo $i+1;?>" id="sRebateAG<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetLists[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBG<?php echo $i+1;?>" id="RebateBG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $memberDetList[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBG<?php echo $i+1;?>" id="sRebateBG<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetLists[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCG<?php echo $i+1;?>" id="RebateCG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $memberDetList[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCG<?php echo $i+1;?>" id="sRebateCG<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetLists[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEG<?php echo $i+1;?>" id="RebateEG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $memberDetList[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $memberDetList[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateEG<?php echo $i+1;?>" value="<?php echo $memberDetLists[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFG<?php echo $i+1;?>" id="RebateFG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $memberDetList[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateFG<?php echo $i+1;?>" value="<?php echo $memberDetLists[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
           
                      
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <td>交易類型</td>
                                
                                <td> <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "A盤";}?>
												<?php if(strstr($P,'B')!=''){echo "B盤";}?>
												<?php if(strstr($P,'C')!=''){echo "C盤";}?></td>
                                
                                <td>單註限額</td>
                                <td>單期限額</td>
                            </tr>
                         <?php for ($i=13;$i<26;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<18){echo "2";}else{echo "3";}?>"><?php echo $memberDetList[$i]['g_type']?><input type="hidden" name="G<?php echo $i+1;?>" id="G<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAG<?php echo $i+1;?>" id="RebateAG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $memberDetList[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $memberDetList[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAG<?php echo $i+1;?>" id="sRebateAG<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetLists[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBG<?php echo $i+1;?>" id="RebateBG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $memberDetList[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBG<?php echo $i+1;?>" id="sRebateBG<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetLists[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCG<?php echo $i+1;?>" id="RebateCG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $memberDetList[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCG<?php echo $i+1;?>" id="sRebateCG<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetLists[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEG<?php echo $i+1;?>" id="RebateEG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $memberDetList[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $memberDetList[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEG<?php echo $i+1;?>" id="sRebateEG<?php echo $i+1;?>" value="<?php echo $memberDetLists[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFG<?php echo $i+1;?>" id="RebateFG<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $memberDetList[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFG<?php echo $i+1;?>" id="sRebateFG<?php echo $i+1;?>" value="<?php echo $memberDetLists[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
           
                        </table>
                    </td>
                </tr>
				
				 
                <tr style="<?php  if($peizhicqssc!="1"){ echo "display:none;";}?>" >
                    <td colspan="2">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">重慶時時彩</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="<?php  if($peizhicqssc!="1"){ echo "display:none;";}?>" >
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                       <?php for ($i=0;$i<1;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $memberDetListC[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListC[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAC<?php echo $i+1;?>" id="RebateAC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ca'" 
                                    onblur="this.className='inp1 ca'" 
                                    class='inp1 ca' 
                                    onchange="isCompare(this, '<?php echo $memberDetListC[$i]['g_type']?>', 'A盤', '1', 'ca')" 
                                    value='<?php echo $memberDetListC[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAC<?php echo $i+1;?>" id="sRebateAC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListCs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListC[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBC<?php echo $i+1;?>" id="RebateBC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cb'" 
                                    onblur="this.className='inp1 cb'" 
                                    class='inp1 cb' 
                                    onchange="isCompare(this, '<?php echo $memberDetListC[$i]['g_type']?>', 'B盤', '1', 'cb')" 
                                    value='<?php echo $memberDetListC[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBC<?php echo $i+1;?>" id="sRebateBC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListCs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListC[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCC<?php echo $i+1;?>" id="RebateCC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cc'" 
                                    onblur="this.className='inp1 cc'" 
                                    class='inp1 cc' 
                                    onchange="isCompare(this, '<?php echo $memberDetListC[$i]['g_type']?>', 'C盤', '1', 'cc')" 
                                    value='<?php echo $memberDetListC[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCC<?php echo $i+1;?>" id="sRebateCC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListCs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEC<?php echo $i+1;?>" id="RebateEC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ce'" 
                                    onblur="this.className='inp1 ce'" class='inp1 ce' 
                                    onchange="isCompares(this, '<?php echo $memberDetListC[$i]['g_type']?>', '單註限額', '1', 'ce')"
                                    value='<?php echo $memberDetListC[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateEC<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFC<?php echo $i+1;?>" id="RebateFC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cf'" 
                                    onblur="this.className='inp1 cf'" class='inp1 cf' 
                                    onchange="isCompares(this, '<?php echo $memberDetListC[$i]['g_type']?>', '單期限額', '1', 'cf')"
                                    value='<?php echo $memberDetListC[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFC<?php echo $i+1;?>" id="sRebateFC<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                          <?php for ($i=1;$i<7;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<5){echo "1";}else{echo "2";}?>"><?php echo $memberDetListC[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListC[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAC<?php echo $i+1;?>" id="RebateAC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ca'" 
                                    onblur="this.className='inp1 ca'" 
                                    class='inp1 ca' 
                                    onchange="isCompare(this, '<?php echo $memberDetListC[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $memberDetListC[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAC<?php echo $i+1;?>" id="sRebateAC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListCs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListC[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBC<?php echo $i+1;?>" id="RebateBC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cb'" 
                                    onblur="this.className='inp1 cb'" 
                                    class='inp1 cb' 
                                    onchange="isCompare(this, '<?php echo $memberDetListC[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $memberDetListC[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBC<?php echo $i+1;?>" id="sRebateBC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListCs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListC[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCC<?php echo $i+1;?>" id="RebateCC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cc'" 
                                    onblur="this.className='inp1 cc'" 
                                    class='inp1 cc' 
                                    onchange="isCompare(this, '<?php echo $memberDetListC[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $memberDetListC[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCC<?php echo $i+1;?>" id="sRebateCC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListCs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEC<?php echo $i+1;?>" id="RebateEC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ce'" 
                                    onblur="this.className='inp1 ce'" class='inp1 ce' 
                                    onchange="isCompares(this, '<?php echo $memberDetListC[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $memberDetListC[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateEC<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFC<?php echo $i+1;?>" id="RebateFC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cf'" 
                                    onblur="this.className='inp1 cf'" class='inp1 cf' 
                                    onchange="isCompares(this, '<?php echo $memberDetListC[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $memberDetListC[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFC<?php echo $i+1;?>" id="sRebateFC<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                        
                      
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                          <?php for ($i=7;$i<13;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<10){echo "2";}else{echo "4";}?>"><?php echo $memberDetListC[$i]['g_type']?><input type="hidden" name="C<?php echo $i+1;?>" id="C<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListC[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAC<?php echo $i+1;?>" id="RebateAC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ca'" 
                                    onblur="this.className='inp1 ca'" 
                                    class='inp1 ca' 
                                    onchange="isCompare(this, '<?php echo $memberDetListC[$i]['g_type']?>', 'A盤', '0', 'ca')" 
                                    value='<?php echo $memberDetListC[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAC<?php echo $i+1;?>" id="sRebateAC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListCs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListC[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBC<?php echo $i+1;?>" id="RebateBC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cb'" 
                                    onblur="this.className='inp1 cb'" 
                                    class='inp1 cb' 
                                    onchange="isCompare(this, '<?php echo $memberDetListC[$i]['g_type']?>', 'B盤', '0', 'cb')" 
                                    value='<?php echo $memberDetListC[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBC<?php echo $i+1;?>" id="sRebateBC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListCs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListC[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCC<?php echo $i+1;?>" id="RebateCC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cc'" 
                                    onblur="this.className='inp1 cc'" 
                                    class='inp1 cc' 
                                    onchange="isCompare(this, '<?php echo $memberDetListC[$i]['g_type']?>', 'C盤', '0', 'cc')" 
                                    value='<?php echo $memberDetListC[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCC<?php echo $i+1;?>" id="sRebateCC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListCs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEC<?php echo $i+1;?>" id="RebateEC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ce'" 
                                    onblur="this.className='inp1 ce'" class='inp1 ce' 
                                    onchange="isCompares(this, '<?php echo $memberDetListC[$i]['g_type']?>', '單註限額', '0', 'ce')"
                                    value='<?php echo $memberDetListC[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEC<?php echo $i+1;?>" id="sRebateEC<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFC<?php echo $i+1;?>" id="RebateFC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cf'" 
                                    onblur="this.className='inp1 cf'" class='inp1 cf' 
                                    onchange="isCompares(this, '<?php echo $memberDetListC[$i]['g_type']?>', '單期限額', '0', 'cf')"
                                    value='<?php echo $memberDetListC[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFC<?php echo $i+1;?>" id="sRebateFC<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                </tr>
                
			    <tr style="<?php  if($peizhijxssc!="1"){ echo "display:none;";}?>">
                    <td colspan="2">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">极速时时彩</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="<?php  if($peizhijxssc!="1"){ echo "display:none;";}?>">
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                       <?php for ($i=0;$i<1;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $memberDetList_jx[$i]['g_type']?><input type="hidden" name="JX<?php echo $i+1;?>" id="JX<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_jx[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAJX<?php echo $i+1;?>" id="RebateAJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ca'" 
                                    onblur="this.className='inp1 ca'" 
                                    class='inp1 ca' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', 'A盤', '1', 'jxa')" 
                                    value='<?php echo $memberDetList_jx[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJX<?php echo $i+1;?>" id="sRebateAJX<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_jxs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_jx[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBJX<?php echo $i+1;?>" id="RebateBJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cb'" 
                                    onblur="this.className='inp1 cb'" 
                                    class='inp1 cb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', 'B盤', '1', 'jxb')" 
                                    value='<?php echo $memberDetList_jx[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJX<?php echo $i+1;?>" id="sRebateBJX<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_jxs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_jx[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCJX<?php echo $i+1;?>" id="RebateCJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cc'" 
                                    onblur="this.className='inp1 cc'" 
                                    class='inp1 cc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', 'C盤', '1', 'jxc')" 
                                    value='<?php echo $memberDetList_jx[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJX<?php echo $i+1;?>" id="sRebateCJX<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_jxs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJX<?php echo $i+1;?>" id="RebateEJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ce'" 
                                    onblur="this.className='inp1 ce'" class='inp1 ce' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', '單註限額', '1', 'jxe')"
                                    value='<?php echo $memberDetList_jx[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateEJX<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJX<?php echo $i+1;?>" id="RebateFJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cf'" 
                                    onblur="this.className='inp1 cf'" class='inp1 cf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', '單期限額', '1', 'jxf')"
                                    value='<?php echo $memberDetList_jx[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFJX<?php echo $i+1;?>" id="sRebateFJX<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                          <?php for ($i=1;$i<7;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<5){echo "1";}else{echo "2";}?>"><?php echo $memberDetList_jx[$i]['g_type']?><input type="hidden" name="JX<?php echo $i+1;?>" id="JX<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_jx[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAJX<?php echo $i+1;?>" id="RebateAJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ca'" 
                                    onblur="this.className='inp1 ca'" 
                                    class='inp1 ca' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', 'A盤', '0', 'jxa')" 
                                    value='<?php echo $memberDetList_jx[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJX<?php echo $i+1;?>" id="sRebateAJX<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_jxs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_jx[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBJX<?php echo $i+1;?>" id="RebateBJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cb'" 
                                    onblur="this.className='inp1 cb'" 
                                    class='inp1 cb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', 'B盤', '0', 'jxb')" 
                                    value='<?php echo $memberDetList_jx[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJX<?php echo $i+1;?>" id="sRebateBJX<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_jxs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_jx[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCJX<?php echo $i+1;?>" id="RebateCJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cc'" 
                                    onblur="this.className='inp1 cc'" 
                                    class='inp1 cc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', 'C盤', '0', 'jxc')" 
                                    value='<?php echo $memberDetList_jx[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJX<?php echo $i+1;?>" id="sRebateCJX<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_jxs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJX<?php echo $i+1;?>" id="RebateEJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ce'" 
                                    onblur="this.className='inp1 ce'" class='inp1 ce' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', '單註限額', '0', 'jxe')"
                                    value='<?php echo $memberDetList_jx[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateEJX<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJX<?php echo $i+1;?>" id="RebateFJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cf'" 
                                    onblur="this.className='inp1 cf'" class='inp1 cf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', '單期限額', '0', 'jxf')"
                                    value='<?php echo $memberDetList_jx[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFJX<?php echo $i+1;?>" id="sRebateFJX<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                        
                      
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                          <?php for ($i=7;$i<13;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<10){echo "2";}else{echo "4";}?>"><?php echo $memberDetList_jx[$i]['g_type']?><input type="hidden" name="JX<?php echo $i+1;?>" id="JX<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_jx[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAJX<?php echo $i+1;?>" id="RebateAJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ca'" 
                                    onblur="this.className='inp1 ca'" 
                                    class='inp1 ca' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', 'A盤', '0', 'jxa')" 
                                    value='<?php echo $memberDetList_jx[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJX<?php echo $i+1;?>" id="sRebateAJX<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_jxs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_jx[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBJX<?php echo $i+1;?>" id="RebateBJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cb'" 
                                    onblur="this.className='inp1 cb'" 
                                    class='inp1 cb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', 'B盤', '0', 'jxb')" 
                                    value='<?php echo $memberDetList_jx[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJX<?php echo $i+1;?>" id="sRebateBJX<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_jxs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_jx[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCJX<?php echo $i+1;?>" id="RebateCJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cc'" 
                                    onblur="this.className='inp1 cc'" 
                                    class='inp1 cc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', 'C盤', '0', 'jxc')" 
                                    value='<?php echo $memberDetList_jx[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJX<?php echo $i+1;?>" id="sRebateCJX<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_jxs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJX<?php echo $i+1;?>" id="RebateEJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ce'" 
                                    onblur="this.className='inp1 ce'" class='inp1 ce' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', '單註限額', '0', 'jxe')"
                                    value='<?php echo $memberDetList_jx[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJX<?php echo $i+1;?>" id="sRebateEJX<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJX<?php echo $i+1;?>" id="RebateFJX<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cf'" 
                                    onblur="this.className='inp1 cf'" class='inp1 cf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_jx[$i]['g_type']?>', '單期限額', '0', 'jxf')"
                                    value='<?php echo $memberDetList_jx[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFJX<?php echo $i+1;?>" id="sRebateFJX<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                </tr>
				  
			   <tr style="<?php  if($peizhixjssc!="1"){ echo "display:none;";}?>">
                    <td colspan="2">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">新疆時時彩</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="<?php  if($peizhixjssc!="1"){ echo "display:none;";}?>">
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                       <?php for ($i=0;$i<1;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $memberDetList_xj[$i]['g_type']?><input type="hidden" name="XJ<?php echo $i+1;?>" id="XJ<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_xj[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAXJ<?php echo $i+1;?>" id="RebateAXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ca'" 
                                    onblur="this.className='inp1 ca'" 
                                    class='inp1 ca' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', 'A盤', '1', 'xja')" 
                                    value='<?php echo $memberDetList_xj[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAXJ<?php echo $i+1;?>" id="sRebateAXJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_xjs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_xj[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBXJ<?php echo $i+1;?>" id="RebateBXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cb'" 
                                    onblur="this.className='inp1 cb'" 
                                    class='inp1 cb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', 'B盤', '1', 'xjb')" 
                                    value='<?php echo $memberDetList_xj[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBXJ<?php echo $i+1;?>" id="sRebateBXJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_xjs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_xj[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCXJ<?php echo $i+1;?>" id="RebateCXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cc'" 
                                    onblur="this.className='inp1 cc'" 
                                    class='inp1 cc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', 'C盤', '1', 'xjc')" 
                                    value='<?php echo $memberDetList_xj[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCXJ<?php echo $i+1;?>" id="sRebateCXJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_xjs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEXJ<?php echo $i+1;?>" id="RebateEXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ce'" 
                                    onblur="this.className='inp1 ce'" class='inp1 ce' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', '單註限額', '1', 'xje')"
                                    value='<?php echo $memberDetList_xj[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateEXJ<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFXJ<?php echo $i+1;?>" id="RebateFXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cf'" 
                                    onblur="this.className='inp1 cf'" class='inp1 cf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', '單期限額', '1', 'xjf')"
                                    value='<?php echo $memberDetList_xj[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFXJ<?php echo $i+1;?>" id="sRebateFXJ<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                          <?php for ($i=1;$i<7;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<5){echo "1";}else{echo "2";}?>"><?php echo $memberDetList_xj[$i]['g_type']?><input type="hidden" name="XJ<?php echo $i+1;?>" id="XJ<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_xj[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAXJ<?php echo $i+1;?>" id="RebateAXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ca'" 
                                    onblur="this.className='inp1 ca'" 
                                    class='inp1 ca' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', 'A盤', '0', 'xja')" 
                                    value='<?php echo $memberDetList_xj[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAXJ<?php echo $i+1;?>" id="sRebateAXJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_xjs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_xj[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBXJ<?php echo $i+1;?>" id="RebateBXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cb'" 
                                    onblur="this.className='inp1 cb'" 
                                    class='inp1 cb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', 'B盤', '0', 'xjb')" 
                                    value='<?php echo $memberDetList_xj[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBXJ<?php echo $i+1;?>" id="sRebateBXJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_xjs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_xj[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCXJ<?php echo $i+1;?>" id="RebateCXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cc'" 
                                    onblur="this.className='inp1 cc'" 
                                    class='inp1 cc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', 'C盤', '0', 'xjc')" 
                                    value='<?php echo $memberDetList_xj[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCXJ<?php echo $i+1;?>" id="sRebateCXJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_xjs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEXJ<?php echo $i+1;?>" id="RebateEXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ce'" 
                                    onblur="this.className='inp1 ce'" class='inp1 ce' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', '單註限額', '0', 'xje')"
                                    value='<?php echo $memberDetList_xj[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateEXJ<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFXJ<?php echo $i+1;?>" id="RebateFXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cf'" 
                                    onblur="this.className='inp1 cf'" class='inp1 cf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', '單期限額', '0', 'xjf')"
                                    value='<?php echo $memberDetList_xj[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFXJ<?php echo $i+1;?>" id="sRebateFXJ<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                        
                      
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                          <?php for ($i=7;$i<13;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<10){echo "2";}else{echo "4";}?>"><?php echo $memberDetList_xj[$i]['g_type']?><input type="hidden" name="XJ<?php echo $i+1;?>" id="XJ<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_xj[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAXJ<?php echo $i+1;?>" id="RebateAXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ca'" 
                                    onblur="this.className='inp1 ca'" 
                                    class='inp1 ca' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', 'A盤', '0', 'xja')" 
                                    value='<?php echo $memberDetList_xj[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAXJ<?php echo $i+1;?>" id="sRebateAXJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_xjs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_xj[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBXJ<?php echo $i+1;?>" id="RebateBXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cb'" 
                                    onblur="this.className='inp1 cb'" 
                                    class='inp1 cb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', 'B盤', '0', 'xjb')" 
                                    value='<?php echo $memberDetList_xj[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBXJ<?php echo $i+1;?>" id="sRebateBXJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_xjs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_xj[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCXJ<?php echo $i+1;?>" id="RebateCXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cc'" 
                                    onblur="this.className='inp1 cc'" 
                                    class='inp1 cc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', 'C盤', '0', 'xjc')" 
                                    value='<?php echo $memberDetList_xj[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCXJ<?php echo $i+1;?>" id="sRebateCXJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_xjs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEXJ<?php echo $i+1;?>" id="RebateEXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ce'" 
                                    onblur="this.className='inp1 ce'" class='inp1 ce' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', '單註限額', '0', 'xje')"
                                    value='<?php echo $memberDetList_xj[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEXJ<?php echo $i+1;?>" id="sRebateEXJ<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFXJ<?php echo $i+1;?>" id="RebateFXJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cf'" 
                                    onblur="this.className='inp1 cf'" class='inp1 cf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_xj[$i]['g_type']?>', '單期限額', '0', 'xjf')"
                                    value='<?php echo $memberDetList_xj[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFXJ<?php echo $i+1;?>" id="sRebateFXJ<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                </tr>
			     
			    <tr style="<?php  if($peizhitjssc!="1"){ echo "display:none;";}?>">
                    <td colspan="2">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">天津時時彩</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="<?php  if($peizhitjssc!="1"){ echo "display:none;";}?>">
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                       <?php for ($i=0;$i<1;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $memberDetList_tj[$i]['g_type']?><input type="hidden" name="TJ<?php echo $i+1;?>" id="TJ<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_tj[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateATJ<?php echo $i+1;?>" id="RebateATJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ca'" 
                                    onblur="this.className='inp1 ca'" 
                                    class='inp1 ca' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', 'A盤', '1', 'tja')" 
                                    value='<?php echo $memberDetList_tj[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateATJ<?php echo $i+1;?>" id="sRebateATJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_tjs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_tj[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBTJ<?php echo $i+1;?>" id="RebateBTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cb'" 
                                    onblur="this.className='inp1 cb'" 
                                    class='inp1 cb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', 'B盤', '1', 'tjb')" 
                                    value='<?php echo $memberDetList_tj[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBTJ<?php echo $i+1;?>" id="sRebateBTJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_tjs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_tj[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCTJ<?php echo $i+1;?>" id="RebateCTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cc'" 
                                    onblur="this.className='inp1 cc'" 
                                    class='inp1 cc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', 'C盤', '1', 'tjc')" 
                                    value='<?php echo $memberDetList_tj[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCTJ<?php echo $i+1;?>" id="sRebateCTJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_tjs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateETJ<?php echo $i+1;?>" id="RebateETJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ce'" 
                                    onblur="this.className='inp1 ce'" class='inp1 ce' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', '單註限額', '1', 'tje')"
                                    value='<?php echo $memberDetList_tj[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateETJ<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFTJ<?php echo $i+1;?>" id="RebateFTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cf'" 
                                    onblur="this.className='inp1 cf'" class='inp1 cf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', '單期限額', '1', 'tjf')"
                                    value='<?php echo $memberDetList_tj[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFTJ<?php echo $i+1;?>" id="sRebateFTJ<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                          <?php for ($i=1;$i<7;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<5){echo "1";}else{echo "2";}?>"><?php echo $memberDetList_tj[$i]['g_type']?><input type="hidden" name="TJ<?php echo $i+1;?>" id="TJ<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_tj[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateATJ<?php echo $i+1;?>" id="RebateATJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ca'" 
                                    onblur="this.className='inp1 ca'" 
                                    class='inp1 ca' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', 'A盤', '0', 'tja')" 
                                    value='<?php echo $memberDetList_tj[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateATJ<?php echo $i+1;?>" id="sRebateATJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_tjs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_tj[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBTJ<?php echo $i+1;?>" id="RebateBTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cb'" 
                                    onblur="this.className='inp1 cb'" 
                                    class='inp1 cb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', 'B盤', '0', 'tjb')" 
                                    value='<?php echo $memberDetList_tj[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBTJ<?php echo $i+1;?>" id="sRebateBTJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_tjs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_tj[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCTJ<?php echo $i+1;?>" id="RebateCTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cc'" 
                                    onblur="this.className='inp1 cc'" 
                                    class='inp1 cc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', 'C盤', '0', 'tjc')" 
                                    value='<?php echo $memberDetList_tj[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCTJ<?php echo $i+1;?>" id="sRebateCTJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_tjs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateETJ<?php echo $i+1;?>" id="RebateETJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ce'" 
                                    onblur="this.className='inp1 ce'" class='inp1 ce' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', '單註限額', '0', 'tje')"
                                    value='<?php echo $memberDetList_tj[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateETJ<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFTJ<?php echo $i+1;?>" id="RebateFTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cf'" 
                                    onblur="this.className='inp1 cf'" class='inp1 cf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', '單期限額', '0', 'tjf')"
                                    value='<?php echo $memberDetList_tj[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFTJ<?php echo $i+1;?>" id="sRebateFTJ<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                        
                      
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                          <?php for ($i=7;$i<13;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<10){echo "2";}else{echo "4";}?>"><?php echo $memberDetList_tj[$i]['g_type']?><input type="hidden" name="TJ<?php echo $i+1;?>" id="TJ<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_tj[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateATJ<?php echo $i+1;?>" id="RebateATJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ca'" 
                                    onblur="this.className='inp1 ca'" 
                                    class='inp1 ca' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', 'A盤', '0', 'tja')" 
                                    value='<?php echo $memberDetList_tj[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateATJ<?php echo $i+1;?>" id="sRebateATJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_tjs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_tj[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBTJ<?php echo $i+1;?>" id="RebateBTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cb'" 
                                    onblur="this.className='inp1 cb'" 
                                    class='inp1 cb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', 'B盤', '0', 'tjb')" 
                                    value='<?php echo $memberDetList_tj[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBTJ<?php echo $i+1;?>" id="sRebateBTJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_tjs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_tj[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCTJ<?php echo $i+1;?>" id="RebateCTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cc'" 
                                    onblur="this.className='inp1 cc'" 
                                    class='inp1 cc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', 'C盤', '0', 'tjc')" 
                                    value='<?php echo $memberDetList_tj[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCTJ<?php echo $i+1;?>" id="sRebateCTJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_tjs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateETJ<?php echo $i+1;?>" id="RebateETJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ce'" 
                                    onblur="this.className='inp1 ce'" class='inp1 ce' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', '單註限額', '0', 'tje')"
                                    value='<?php echo $memberDetList_tj[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateETJ<?php echo $i+1;?>" id="sRebateETJ<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFTJ<?php echo $i+1;?>" id="RebateFTJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m cf'" 
                                    onblur="this.className='inp1 cf'" class='inp1 cf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_tj[$i]['g_type']?>', '單期限額', '0', 'tjf')"
                                    value='<?php echo $memberDetList_tj[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFTJ<?php echo $i+1;?>" id="sRebateFTJ<?php echo $i+1;?>" value="<?php echo $memberDetListCs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                </tr>
			    
                <tr style="<?php  if($peizhipk10!="1"){ echo "display:none;";}?>">
                    <td colspan="2">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">北京賽車(PK10)</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="<?php  if($peizhipk10!="1"){ echo "display:none;";}?>">
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                              <?php for ($i=0;$i<8;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $memberDetListB[$i]['g_type']?><input type="hidden" name="B<?php echo $i+1;?>" id="B<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListB[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAB<?php echo $i+1;?>" id="RebateAB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ba'" 
                                    onblur="this.className='inp1 ba'" 
                                    class='inp1 ba' 
                                    onchange="isCompare(this, '<?php echo $memberDetListB[$i]['g_type']?>', 'A盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'ba')" 
                                    value='<?php echo $memberDetListB[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAB<?php echo $i+1;?>" id="sRebateAB<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListBs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListB[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBB<?php echo $i+1;?>" id="RebateBB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m bb'" 
                                    onblur="this.className='inp1 bb'" 
                                    class='inp1 bb' 
                                    onchange="isCompare(this, '<?php echo $memberDetListB[$i]['g_type']?>', 'B盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bb')" 
                                    value='<?php echo $memberDetListB[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBB<?php echo $i+1;?>" id="sRebateBB<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListBs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListB[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCB<?php echo $i+1;?>" id="RebateCB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m bc'" 
                                    onblur="this.className='inp1 bc'" 
                                    class='inp1 bc' 
                                    onchange="isCompare(this, '<?php echo $memberDetListB[$i]['g_type']?>', 'C盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'cc')" 
                                    value='<?php echo $memberDetListB[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCB<?php echo $i+1;?>" id="sRebateCB<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListBs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEB<?php echo $i+1;?>" id="RebateEB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m be'" 
                                    onblur="this.className='inp1 be'" class='inp1 be' 
                                    onchange="isCompares(this, '<?php echo $memberDetListB[$i]['g_type']?>', '單註限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'be')"
                                    value='<?php echo $memberDetListB[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEB<?php echo $i+1;?>" id="sRebateEB<?php echo $i+1;?>" value="<?php echo $memberDetListBs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFB<?php echo $i+1;?>" id="RebateFB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m bf'" 
                                    onblur="this.className='inp1 bf'" class='inp1 bf' 
                                    onchange="isCompares(this, '<?php echo $memberDetListB[$i]['g_type']?>', '單期限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bf')"
                                    value='<?php echo $memberDetListB[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFB<?php echo $i+1;?>" id="sRebateFB<?php echo $i+1;?>" value="<?php echo $memberDetListBs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                            
                                                     
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <?php for ($i=8;$i<16;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<10){echo "1";}else if($i==15){echo "4";}else{echo "2";}?>"><?php echo $memberDetListB[$i]['g_type']?><input type="hidden" name="B<?php echo $i+1;?>" id="B<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListB[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAB<?php echo $i+1;?>" id="RebateAB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ba'" 
                                    onblur="this.className='inp1 ba'" 
                                    class='inp1 ba' 
                                    onchange="isCompare(this, '<?php echo $memberDetListB[$i]['g_type']?>', 'A盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'ba')" 
                                    value='<?php echo $memberDetListB[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAB<?php echo $i+1;?>" id="sRebateAB<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListBs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListB[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBB<?php echo $i+1;?>" id="RebateBB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m bb'" 
                                    onblur="this.className='inp1 bb'" 
                                    class='inp1 bb' 
                                    onchange="isCompare(this, '<?php echo $memberDetListB[$i]['g_type']?>', 'B盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bb')" 
                                    value='<?php echo $memberDetListB[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBB<?php echo $i+1;?>" id="sRebateBB<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListBs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListB[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCB<?php echo $i+1;?>" id="RebateCB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m bc'" 
                                    onblur="this.className='inp1 bc'" 
                                    class='inp1 bc' 
                                    onchange="isCompare(this, '<?php echo $memberDetListB[$i]['g_type']?>', 'C盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'cc')" 
                                    value='<?php echo $memberDetListB[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCB<?php echo $i+1;?>" id="sRebateCB<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListBs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEB<?php echo $i+1;?>" id="RebateEB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m be'" 
                                    onblur="this.className='inp1 be'" class='inp1 be' 
                                    onchange="isCompares(this, '<?php echo $memberDetListB[$i]['g_type']?>', '單註限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'be')"
                                    value='<?php echo $memberDetListB[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEB<?php echo $i+1;?>" id="sRebateEB<?php echo $i+1;?>" value="<?php echo $memberDetListBs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFB<?php echo $i+1;?>" id="RebateFB<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m bf'" 
                                    onblur="this.className='inp1 bf'" class='inp1 bf' 
                                    onchange="isCompares(this, '<?php echo $memberDetListB[$i]['g_type']?>', '單期限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bf')"
                                    value='<?php echo $memberDetListB[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFB<?php echo $i+1;?>" id="sRebateFB<?php echo $i+1;?>" value="<?php echo $memberDetListBs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                            
                        </table>
                    </td>
                </tr>
				    
                 <tr style="<?php  if($peizhixyft!="1"){ echo "display:none;";}?>">
                    <td colspan="2">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">极速赛车</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="<?php  if($peizhixyft!="1"){ echo "display:none;";}?>">
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                              <?php for ($i=0;$i<8;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $memberDetList_ft[$i]['g_type']?><input type="hidden" name="B<?php echo $i+1;?>" id="B<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_ft[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAFT<?php echo $i+1;?>" id="RebateAFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ba'" 
                                    onblur="this.className='inp1 ba'" 
                                    class='inp1 ba' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_ft[$i]['g_type']?>', 'A盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'ba')" 
                                    value='<?php echo $memberDetList_ft[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAFT<?php echo $i+1;?>" id="sRebateAFT<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_fts[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_ft[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBFT<?php echo $i+1;?>" id="RebateBFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m bb'" 
                                    onblur="this.className='inp1 bb'" 
                                    class='inp1 bb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_ft[$i]['g_type']?>', 'B盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bb')" 
                                    value='<?php echo $memberDetList_ft[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBFT<?php echo $i+1;?>" id="sRebateBFT<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_fts[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_ft[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCFT<?php echo $i+1;?>" id="RebateCFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m bc'" 
                                    onblur="this.className='inp1 bc'" 
                                    class='inp1 bc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_ft[$i]['g_type']?>', 'C盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'cc')" 
                                    value='<?php echo $memberDetList_ft[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCFT<?php echo $i+1;?>" id="sRebateCFT<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_fts[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEFT<?php echo $i+1;?>" id="RebateEFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m be'" 
                                    onblur="this.className='inp1 be'" class='inp1 be' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_ft[$i]['g_type']?>', '單註限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'be')"
                                    value='<?php echo $memberDetList_ft[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEFT<?php echo $i+1;?>" id="sRebateEFT<?php echo $i+1;?>" value="<?php echo $memberDetList_fts[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFFT<?php echo $i+1;?>" id="RebateFFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m bf'" 
                                    onblur="this.className='inp1 bf'" class='inp1 bf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_ft[$i]['g_type']?>', '單期限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bf')"
                                    value='<?php echo $memberDetList_ft[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFFT<?php echo $i+1;?>" id="sRebateFFT<?php echo $i+1;?>" value="<?php echo $memberDetList_fts[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                            
                                                     
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <?php for ($i=8;$i<16;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<10){echo "1";}else if($i==15){echo "4";}else{echo "2";}?>"><?php echo $memberDetList_ft[$i]['g_type']?><input type="hidden" name="FT<?php echo $i+1;?>" id="FT<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_ft[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAFT<?php echo $i+1;?>" id="RebateAFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ba'" 
                                    onblur="this.className='inp1 ba'" 
                                    class='inp1 ba' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_ft[$i]['g_type']?>', 'A盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'ba')" 
                                    value='<?php echo $memberDetList_ft[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAFT<?php echo $i+1;?>" id="sRebateAFT<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_fts[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_ft[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBFT<?php echo $i+1;?>" id="RebateBFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m bb'" 
                                    onblur="this.className='inp1 bb'" 
                                    class='inp1 bb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_ft[$i]['g_type']?>', 'B盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bb')" 
                                    value='<?php echo $memberDetList_ft[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBFT<?php echo $i+1;?>" id="sRebateBFT<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_fts[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_ft[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCFT<?php echo $i+1;?>" id="RebateCFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m bc'" 
                                    onblur="this.className='inp1 bc'" 
                                    class='inp1 bc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_ft[$i]['g_type']?>', 'C盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'cc')" 
                                    value='<?php echo $memberDetList_ft[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCFT<?php echo $i+1;?>" id="sRebateCFT<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_fts[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEFT<?php echo $i+1;?>" id="RebateEFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m be'" 
                                    onblur="this.className='inp1 be'" class='inp1 be' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_ft[$i]['g_type']?>', '單註限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'be')"
                                    value='<?php echo $memberDetList_ft[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEFT<?php echo $i+1;?>" id="sRebateEFT<?php echo $i+1;?>" value="<?php echo $memberDetList_fts[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFFT<?php echo $i+1;?>" id="RebateFFT<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m bf'" 
                                    onblur="this.className='inp1 bf'" class='inp1 bf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_ft[$i]['g_type']?>', '單期限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bf')"
                                    value='<?php echo $memberDetList_ft[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFFT<?php echo $i+1;?>" id="sRebateFFT<?php echo $i+1;?>" value="<?php echo $memberDetList_fts[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                            
                        </table>
                    </td>
                </tr>
				 
                <tr style="<?php  if($peizhijssz!="1"){ echo "display:none;";}?>">
                    <td colspan="2">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">吉林快3</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="<?php  if($peizhijssz!="1"){ echo "display:none;";}?>">
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                            <?php for ($i=0;$i<2;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $memberDetListJ[$i]['g_type']?><input type="hidden" name="J<?php echo $i+1;?>" id="J<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListJ[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAJ<?php echo $i+1;?>" id="RebateAJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ja'" 
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja' 
                                    onchange="isCompare(this, '<?php echo $memberDetListJ[$i]['g_type']?>', 'A盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'ba')" 
                                    value='<?php echo $memberDetListJ[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJ<?php echo $i+1;?>" id="sRebateAJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListJs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListJ[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBJ<?php echo $i+1;?>" id="RebateBJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jb'" 
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb' 
                                    onchange="isCompare(this, '<?php echo $memberDetListJ[$i]['g_type']?>', 'B盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bb')" 
                                    value='<?php echo $memberDetListJ[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJ<?php echo $i+1;?>" id="sRebateBJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListJs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListJ[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCJ<?php echo $i+1;?>" id="RebateCJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jc'" 
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc' 
                                    onchange="isCompare(this, '<?php echo $memberDetListJ[$i]['g_type']?>', 'C盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'cc')" 
                                    value='<?php echo $memberDetListJ[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJ<?php echo $i+1;?>" id="sRebateCJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListJs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJ<?php echo $i+1;?>" id="RebateEJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'" class='inp1 je' 
                                    onchange="isCompares(this, '<?php echo $memberDetListJ[$i]['g_type']?>', '單註限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'be')"
                                    value='<?php echo $memberDetListJ[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJ<?php echo $i+1;?>" id="sRebateEJ<?php echo $i+1;?>" value="<?php echo $memberDetListJs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJ<?php echo $i+1;?>" id="RebateFJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" class='inp1 jf' 
                                    onchange="isCompares(this, '<?php echo $memberDetListJ[$i]['g_type']?>', '單期限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bf')"
                                    value='<?php echo $memberDetListJ[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFJ<?php echo $i+1;?>" id="sRebateFJ<?php echo $i+1;?>" value="<?php echo $memberDetListJs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                             <?php for ($i=2;$i<3;$i++){?> 
                             <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS3">圍骰<input type="hidden" name="J<?php echo $i+1;?>" id="J<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListJ[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAJ<?php echo $i+1;?>" id="RebateAJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ja'" 
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja' 
                                    onchange="isCompare(this, '圍骰', 'A盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'ba')" 
                                    value='<?php echo $memberDetListJ[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJ<?php echo $i+1;?>" id="sRebateAJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListJs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListJ[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBJ<?php echo $i+1;?>" id="RebateBJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jb'" 
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb' 
                                    onchange="isCompare(this, '圍骰', 'B盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bb')" 
                                    value='<?php echo $memberDetListJ[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJ<?php echo $i+1;?>" id="sRebateBJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListJs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListJ[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCJ<?php echo $i+1;?>" id="RebateCJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jc'" 
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc' 
                                    onchange="isCompare(this, '圍骰', 'C盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'cc')" 
                                    value='<?php echo $memberDetListJ[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJ<?php echo $i+1;?>" id="sRebateCJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListJs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJ<?php echo $i+1;?>" id="RebateEJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'" class='inp1 je' 
                                    onchange="isCompares(this, '圍骰', '單註限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'be')"
                                    value='<?php echo $memberDetListJ[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJ<?php echo $i+1;?>" id="sRebateEJ<?php echo $i+1;?>" value="<?php echo $memberDetListJs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJ<?php echo $i+1;?>" id="RebateFJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" class='inp1 jf' 
                                    onchange="isCompares(this, '圍骰', '單期限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bf')"
                                    value='<?php echo $memberDetListJ[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFJ<?php echo $i+1;?>" id="sRebateFJ<?php echo $i+1;?>" value="<?php echo $memberDetListJs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                            
                              <?php for ($i=6;$i<7;$i++){?> 
                             <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS3">全骰<input type="hidden" name="J<?php echo $i+1;?>" id="J<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListJ[2]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAJ<?php echo $i+1;?>" id="RebateAJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ja'" 
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja' 
                                    onchange="isCompare(this, '全骰', 'A盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'ba')" 
                                    value='<?php echo $memberDetListJ[2]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJ<?php echo $i+1;?>" id="sRebateAJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListJs[2]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListJ[2]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBJ<?php echo $i+1;?>" id="RebateBJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jb'" 
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb' 
                                    onchange="isCompare(this, '全骰', 'B盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bb')" 
                                    value='<?php echo $memberDetListJ[2]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJ<?php echo $i+1;?>" id="sRebateBJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListJs[2]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListJ[2]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCJ<?php echo $i+1;?>" id="RebateCJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jc'" 
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc' 
                                    onchange="isCompare(this, '全骰', 'C盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'cc')" 
                                    value='<?php echo $memberDetListJ[2]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJ<?php echo $i+1;?>" id="sRebateCJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListJs[2]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJ<?php echo $i+1;?>" id="RebateEJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'" class='inp1 je' 
                                    onchange="isCompares(this, '全骰', '單註限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'be')"
                                    value='<?php echo $memberDetListJ[2]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJ<?php echo $i+1;?>" id="sRebateEJ<?php echo $i+1;?>" value="<?php echo $memberDetListJs[2]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJ<?php echo $i+1;?>" id="RebateFJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" class='inp1 jf' 
                                    onchange="isCompares(this, '全骰', '單期限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bf')"
                                    value='<?php echo $memberDetListJ[2]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFJ<?php echo $i+1;?>" id="sRebateFJ<?php echo $i+1;?>" value="<?php echo $memberDetListJs[2]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                          <?php for ($i=3;$i<6;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<4){echo "4";}else{echo "3";}?>"><?php echo $memberDetListJ[$i]['g_type']?><input type="hidden" name="J<?php echo $i+1;?>" id="J<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListJ[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAJ<?php echo $i+1;?>" id="RebateAJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ja'" 
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja' 
                                    onchange="isCompare(this, '<?php echo $memberDetListJ[$i]['g_type']?>', 'A盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'ba')" 
                                    value='<?php echo $memberDetListJ[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAJ<?php echo $i+1;?>" id="sRebateAJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListJs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListJ[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBJ<?php echo $i+1;?>" id="RebateBJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jb'" 
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb' 
                                    onchange="isCompare(this, '<?php echo $memberDetListJ[$i]['g_type']?>', 'B盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bb')" 
                                    value='<?php echo $memberDetListJ[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBJ<?php echo $i+1;?>" id="sRebateBJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListJs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListJ[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCJ<?php echo $i+1;?>" id="RebateCJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jc'" 
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc' 
                                    onchange="isCompare(this, '<?php echo $memberDetListJ[$i]['g_type']?>', 'C盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'cc')" 
                                    value='<?php echo $memberDetListJ[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCJ<?php echo $i+1;?>" id="sRebateCJ<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListJs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEJ<?php echo $i+1;?>" id="RebateEJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'" class='inp1 je' 
                                    onchange="isCompares(this, '<?php echo $memberDetListJ[$i]['g_type']?>', '單註限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'be')"
                                    value='<?php echo $memberDetListJ[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEJ<?php echo $i+1;?>" id="sRebateEJ<?php echo $i+1;?>" value="<?php echo $memberDetListJs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFJ<?php echo $i+1;?>" id="RebateFJ<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" class='inp1 jf' 
                                    onchange="isCompares(this, '<?php echo $memberDetListJ[$i]['g_type']?>', '單期限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bf')"
                                    value='<?php echo $memberDetListJ[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFJ<?php echo $i+1;?>" id="sRebateFJ<?php echo $i+1;?>" value="<?php echo $memberDetListJs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                </tr>
				 
                <tr style="<?php  if($peizhikl8!="1"){ echo "display:none;";}?>">
                    <td colspan="2">
                        <table border="0" cellspacing="0" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                               <th style="border:none">快樂8(雙盤)</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="<?php  if($peizhikl8!="1"){ echo "display:none;";}?>">
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                            <?php for ($i=0;$i<4;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS2"><?php echo $memberDetListK[$i]['g_type']?><input type="hidden" name="K<?php echo $i+1;?>" id="K<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListK[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAK<?php echo $i+1;?>" id="RebateAK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ja'" 
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja' 
                                    onchange="isCompare(this, '<?php echo $memberDetListK[$i]['g_type']?>', 'A盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'ba')" 
                                    value='<?php echo $memberDetListK[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAK<?php echo $i+1;?>" id="sRebateAK<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListKs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListK[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBK<?php echo $i+1;?>" id="RebateBK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jb'" 
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb' 
                                    onchange="isCompare(this, '<?php echo $memberDetListK[$i]['g_type']?>', 'B盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bb')" 
                                    value='<?php echo $memberDetListK[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBK<?php echo $i+1;?>" id="sRebateBK<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListKs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListK[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCK<?php echo $i+1;?>" id="RebateCK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jc'" 
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc' 
                                    onchange="isCompare(this, '<?php echo $memberDetListK[$i]['g_type']?>', 'C盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'cc')" 
                                    value='<?php echo $memberDetListK[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCK<?php echo $i+1;?>" id="sRebateCK<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListKs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEK<?php echo $i+1;?>" id="RebateEK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'" class='inp1 je' 
                                    onchange="isCompares(this, '<?php echo $memberDetListK[$i]['g_type']?>', '單註限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'be')"
                                    value='<?php echo $memberDetListK[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEK<?php echo $i+1;?>" id="sRebateEK<?php echo $i+1;?>" value="<?php echo $memberDetListKs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFK<?php echo $i+1;?>" id="RebateFK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" class='inp1 jf' 
                                    onchange="isCompares(this, '<?php echo $memberDetListK[$i]['g_type']?>', '單期限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bf')"
                                    value='<?php echo $memberDetListK[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFK<?php echo $i+1;?>" id="sRebateFK<?php echo $i+1;?>" value="<?php echo $memberDetListKs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                            
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            
                          <?php for ($i=4;$i<8;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<4){echo "4";}else{echo "3";}?>"><?php echo $memberDetListK[$i]['g_type']?><input type="hidden" name="K<?php echo $i+1;?>" id="K<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListK[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateAK<?php echo $i+1;?>" id="RebateAK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ja'" 
                                    onblur="this.className='inp1 ja'" 
                                    class='inp1 ja' 
                                    onchange="isCompare(this, '<?php echo $memberDetListK[$i]['g_type']?>', 'A盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'ba')" 
                                    value='<?php echo $memberDetListK[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateAK<?php echo $i+1;?>" id="sRebateAK<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListKs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListK[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBK<?php echo $i+1;?>" id="RebateBK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jb'" 
                                    onblur="this.className='inp1 jb'" 
                                    class='inp1 jb' 
                                    onchange="isCompare(this, '<?php echo $memberDetListK[$i]['g_type']?>', 'B盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bb')" 
                                    value='<?php echo $memberDetListK[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBK<?php echo $i+1;?>" id="sRebateBK<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListKs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetListK[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCK<?php echo $i+1;?>" id="RebateCK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jc'" 
                                    onblur="this.className='inp1 jc'" 
                                    class='inp1 jc' 
                                    onchange="isCompare(this, '<?php echo $memberDetListK[$i]['g_type']?>', 'C盤', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'cc')" 
                                    value='<?php echo $memberDetListK[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCK<?php echo $i+1;?>" id="sRebateCK<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetListKs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateEK<?php echo $i+1;?>" id="RebateEK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m je'" 
                                    onblur="this.className='inp1 je'" class='inp1 je' 
                                    onchange="isCompares(this, '<?php echo $memberDetListK[$i]['g_type']?>', '單註限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'be')"
                                    value='<?php echo $memberDetListK[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateEK<?php echo $i+1;?>" id="sRebateEK<?php echo $i+1;?>" value="<?php echo $memberDetListKs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFK<?php echo $i+1;?>" id="RebateFK<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m jf'" 
                                    onblur="this.className='inp1 jf'" class='inp1 jf' 
                                    onchange="isCompares(this, '<?php echo $memberDetListK[$i]['g_type']?>', '單期限額', '<?php if($i==0){echo "1";}else{echo "0";}?>', 'bf')"
                                    value='<?php echo $memberDetListK[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFK<?php echo $i+1;?>" id="sRebateFK<?php echo $i+1;?>" value="<?php echo $memberDetListKs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                </tr>
				 
                <tr style="<?php  if($peizhinc!="1"){ echo "display:none;";}?>">
                    <td colspan="2">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <th style="border:none">重慶幸運農場</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="<?php  if($peizhinc!="1"){ echo "display:none;";}?>">
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <td>交易類型</td>
                                
                                <td> <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "A盤";}?>
												<?php if(strstr($P,'B')!=''){echo "B盤";}?>
												<?php if(strstr($P,'C')!=''){echo "C盤";}?></td>
                                
                                <td>單註限額</td>
                                <td>單期限額</td>
                            </tr>
                            <?php for ($i=0;$i<1;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS1"><?php echo $memberDetList_nc[$i]['g_type']?><input type="hidden" name="G<?php echo $i+1;?>" id="G<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_nc[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateANC<?php echo $i+1;?>" id="RebateANC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', 'A盤', '1', 'ga')" 
                                    value='<?php echo $memberDetList_nc[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateANC<?php echo $i+1;?>" id="sRebateANC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_ncs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_nc[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBNC<?php echo $i+1;?>" id="RebateBNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', 'B盤', '1', 'gb')" 
                                    value='<?php echo $memberDetList_nc[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBNC<?php echo $i+1;?>" id="sRebateBNC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_ncs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_nc[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCNC<?php echo $i+1;?>" id="RebateCNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', 'C盤', '1', 'gc')" 
                                    value='<?php echo $memberDetList_nc[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCNC<?php echo $i+1;?>" id="sRebateCNC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_ncs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateENC<?php echo $i+1;?>" id="RebateENC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', '單註限額', '1', 'ge')"
                                    value='<?php echo $memberDetList_nc[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateENC<?php echo $i+1;?>" value="<?php echo $memberDetList_ncs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFNC<?php echo $i+1;?>" id="RebateFNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', '單期限額', '1', 'gf')"
                                    value='<?php echo $memberDetList_nc[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateFNC<?php echo $i+1;?>" value="<?php echo $memberDetList_ncs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
                          <?php for ($i=1;$i<13;$i++){?> 
                                                    <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<8){echo "1";}else if($i==12 or $i==13){echo "3";}else{echo "2";}?>"><?php echo $memberDetList_nc[$i]['g_type']?><input type="hidden" name="NC<?php echo $i+1;?>" id="NC<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_nc[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateANC<?php echo $i+1;?>" id="RebateANC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $memberDetList_nc[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateANC<?php echo $i+1;?>" id="sRebateANC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_ncs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_nc[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBNC<?php echo $i+1;?>" id="RebateBNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $memberDetList_nc[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBNC<?php echo $i+1;?>" id="sRebateBNC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_ncs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_nc[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCNC<?php echo $i+1;?>" id="RebateCNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $memberDetList_nc[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCNC<?php echo $i+1;?>" id="sRebateCNC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_ncs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateENC<?php echo $i+1;?>" id="RebateENC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $memberDetList_nc[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateENC<?php echo $i+1;?>" value="<?php echo $memberDetList_ncs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFNC<?php echo $i+1;?>" id="RebateFNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $memberDetList_nc[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateFNC<?php echo $i+1;?>" value="<?php echo $memberDetList_ncs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
           
                      
                        </table>
                    </td>
                    <td valign="top">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az auto">
                            <tr class="Conter_top">
                                <td>交易類型</td>
                                
                                <td> <?php $P = $memberModel[0]['g_panlus'];?>
                                                <?php if(strstr($P,'A')!=''){echo "A盤";}?>
												<?php if(strstr($P,'B')!=''){echo "B盤";}?>
												<?php if(strstr($P,'C')!=''){echo "C盤";}?></td>
                                
                                <td>單註限額</td>
                                <td>單期限額</td>
                            </tr>
                         <?php for ($i=13;$i<26;$i++){?> 
                            <tr class="Conter_Report_List" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                                <td class="t_Edit_caption ed TD_TS<?php if ($i<18){echo "2";}else{echo "3";}?>"><?php echo $memberDetList_nc[$i]['g_type']?><input type="hidden" name="NC<?php echo $i+1;?>" id="NC<?php echo $i+1;?>" value="248015" /></td>
                                
                                <td><?php $P = $memberModel[0]['g_panlus'];?>
                                <?php if(strstr($P,'A')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_nc[$i]['g_panlu_a'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateANC<?php echo $i+1;?>" id="RebateANC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ga'" 
                                    onblur="this.className='inp1 ga'" 
                                    class='inp1 ga' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', 'A盤', '0', 'ga')" 
                                    value='<?php echo $memberDetList_nc[$i]['g_panlu_a'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateANC<?php echo $i+1;?>" id="sRebateANC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_ncs[$i]['g_a_limit'];?>" />
                                     <?php }else if(strstr($P,'B')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_nc[$i]['g_panlu_b'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateBNC<?php echo $i+1;?>" id="RebateBNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gb'" 
                                    onblur="this.className='inp1 gb'" 
                                    class='inp1 gb' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', 'B盤', '0', 'gb')" 
                                    value='<?php echo $memberDetList_nc[$i]['g_panlu_b'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateBNC<?php echo $i+1;?>" id="sRebateBNC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_ncs[$i]['g_b_limit'];?>" />
                                    
                                       <?php }else if(strstr($P,'C')!=''){?>
                                    <span style="width:60px;display:<?php if ($dets == 0){echo "none";}?>"><?php echo $memberDetList_nc[$i]['g_panlu_c'];?></span>
                                    <input style="width:60px;display:<?php if ($dets != 0){echo "none";}?>" name="RebateCNC<?php echo $i+1;?>" id="RebateCNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gc'" 
                                    onblur="this.className='inp1 gc'" 
                                    class='inp1 gc' 
                                    onchange="isCompare(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', 'C盤', '0', 'gc')" 
                                    value='<?php echo $memberDetList_nc[$i]['g_panlu_c'];?>' maxlength="6" />
                                    <input type="hidden" name="sRebateCNC<?php echo $i+1;?>" id="sRebateCNC<?php echo $i+1;?>" 
                                    value="<?php echo $memberDetList_ncs[$i]['g_c_limit'];?>" /> 
                                    <?php }?> 
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateENC<?php echo $i+1;?>" id="RebateENC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m ge'" 
                                    onblur="this.className='inp1 ge'" class='inp1 ge' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', '單註限額', '0', 'ge')"
                                    value='<?php echo $memberDetList_nc[$i]['g_danzhu']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateENC<?php echo $i+1;?>" id="sRebateENC<?php echo $i+1;?>" value="<?php echo $memberDetList_ncs[$i]['g_d_limit']?>" />
                                </td>
                                <td>
                                    <input style="width:90px;" name="RebateFNC<?php echo $i+1;?>" id="RebateFNC<?php echo $i+1;?>"
                                    onfocus="this.className='inp1m gf'" 
                                    onblur="this.className='inp1 gf'" class='inp1 gf' 
                                    onchange="isCompares(this, '<?php echo $memberDetList_nc[$i]['g_type']?>', '單期限額', '0', 'gf')"
                                    value='<?php echo $memberDetList_nc[$i]['g_danxiang']?>' maxlength="9" />
                                    <input type="hidden" name="sRebateFNC<?php echo $i+1;?>" id="sRebateFNC<?php echo $i+1;?>" value="<?php echo $memberDetList_ncs[$i]['g_e_limit']?>" />
                                </td>
                            </tr>
                            <?php }?>
           
                        </table>
                    </td>
                </tr>
				<?php  if($peizhinc!="1"){
	echo "-->";} ?>
            </table>
        <!-- end -->
        </td>
        <td class="Main_right" width="5"></td>
    </tr>
    <tr>
        <td class="Main_bottom_left"></td>
        <td background="/Css/tab_19.gif" align="center">
            <input type="submit" name="submit" id="submit" onMouseOver="this.className='input2_2'" onMouseOut="this.className='input2'" class="input2" value="保存" />&nbsp;&nbsp;
            <input type="button" onMouseOver="this.className='input2_2'" onMouseOut="this.className='input2'" class="input2" onClick="historys()" value="取消" />
        </td>
        <td class="Main_bottom_right"></td>
    </tr>
</table>
</form>
</body>
</html>
