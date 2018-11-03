<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $Users, $LoginId;
if ($LoginId != 89)
	if ($Users[0]['g_lock'] == 2)
		exit(back($UserOut)); //帳號已被凍結

//子帳號
if (isset($Users[0]['g_lock_2'])){
	if ( $Users[0]['g_s_lock'] == 2 || $Users[0]['g_lock_2'] != 1)
		exit(back($UserOut)); //帳號已被凍結
}


$p=false;
$dateTime = date('Y-m-d H:i:s');
$a = date('Y-m-d ').'06:00:00';
$b = date('Y-m-d ').'08:00:00';
global $stratGamecq, $endGamecq;
if ( $dateTime>=$a && $dateTime<=$b)
{
	$p = true;
}


$userModel = new UserModel();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['cid']))
{
	$name = $_POST['name'];
	$cid = $_GET['cid'];
	$s_Pwd = $_POST['s_Pwd'];
	$s_F_Name = $_POST['s_F_Name'];
	$lock = $_POST['lock'];
	$g_zy = $_POST['g_zy'];
	//if (!Matchs::isStringChi($s_F_Name, 2, 8)) exit(back('輸入名稱錯誤！'));
	$userList = $userModel->GetUserModel(null, $name);
	if ($userList) {
		if (!empty($s_Pwd)) {
			if (!Matchs::isString($s_Pwd, 8, 20)) exit(back('輸入密碼錯誤！'));
			$s_Pwd =sha1($s_Pwd);
			$g_pwd=' ,g_pwd=1 ';
		} else {
			$s_Pwd = $userList[0]['g_password'];
			$g_pwd=' ,g_pwd=g_pwd ';
		}
		$db = new DB();
		if ($cid == 1 && $LoginId == 89){
			$s_size_ky = $_POST['s_size_ky'];
			$s_next_ky = $_POST['s_next_KY'];
			$s_money = $_POST['s_money'];
			if (!Matchs::isNumber($s_size_ky) || !Matchs::isNumber($s_next_ky)) exit(back('輸入占成錯誤'));
			/**
			 * $s_size_ky = 上級占成 判斷上級總占成是否大於修改后的占成
			 *  $s_next_ky = 當前被修改帳號占成、必須進行判斷此帳號所分配的占成是否超出所修改的值，
			 *  如果超出將禁止修改。
			 */
			if (($s_size_ky+$s_next_ky) > 100) 
				exit(back('最高可設占成：100%'));
			if (($s_size_ky+$s_next_ky) != 100) 
				exit(back('总公司和分公司占成总和小于：100%'));
			if (!Matchs::isNumber($s_money)) exit(back('輸入信用額錯誤！'));
				
			$nid = $userList[0]['g_nid'].UserModel::Like();
				$res = $db->query("SELECT g_nid,g_name FROM g_rank WHERE g_nid like '{$nid}' ",1);
				$max=0;
				$maxd=0;
				$maxc=0;
				$sqlhh = "SELECT max(`g_distribution`) FROM `g_user` WHERE `g_nid` like '{$nid}' LIMIT 1";
				$maxhh = $db->query($sqlhh, 0);
				$maxhh = $maxhh[0][0] ? $maxhh[0][0] : 0;
				for($u=0;$u<count($res);$u++){
				$did=$res[$u]['g_nid'];
				$sqlx = "SELECT  g_distribution_limit FROM `g_rank` WHERE `g_nid`='{$did}'  and g_login_id=22 LIMIT 1";
				$maxx = $db->query($sqlx, 0);//股东占
				
				$max1x = $maxx[0][0] ? $maxx[0][0] : 0;
				
				$ress = $db->query("SELECT g_nid,g_name,g_distribution_limit FROM g_rank WHERE g_nid like '%$did%' and  g_login_id=78 ",1);//总代
				
				for($ui=0;$ui<count($ress);$ui++)
				{
                $udid=$ress[$ui]['g_nid'];
				$maxxx =$ress[$ui]['g_distribution_limit'];
				$sql = "SELECT  max(g_distribution+g_distribution_limit) FROM `g_rank` WHERE `g_nid` like '%$udid%'  and g_login_id=48 LIMIT 1";
				$maxy = $db->query($sql, 0);
				//$sqlh = "SELECT max(`g_distribution`) FROM `g_rank` WHERE `g_nid` like '%$nid%' and g_login_id=48 LIMIT 1";
				$sqlh = "SELECT max(`g_distribution`) FROM `g_user` WHERE `g_nid` like '{$udid}' LIMIT 1";
				$maxh = $db->query($sqlh, 0);
				//dump($max);
				$max1 = $maxy[0][0] ? $maxy[0][0] : 0;
				$max2 = $maxh[0][0] ? $maxh[0][0] : 0;
				
				if (($max1+$maxxx)<$max2){
				$maxa = $max2;	
				}else{
				$maxa = $max1+$maxxx;		
				}
				if($maxd<$maxa){
				$maxd=$maxa;
				}
				}
				if(($maxd+$max1x)<$maxhh){
				$maxc=$maxhh;
				}else{
				$maxc=$maxd+$max1x;
				}
				if($max<$maxc){
				$max=$maxc;
	            }
				}
			
				//dump($max);
				
			if ($s_next_ky < $max) {
				exit(back('回調占成率最小值：'.$max.'%'));
			}///此处错误，回调不但只会员
				
			if ($userList[0]['g_lock'] != $lock){
				$sql="SELECT g_name, g_lock FROM g_rank WHERE g_nid LIKE '{$userList[0]['g_nid']}%' AND g_name <> '{$userList[0]['g_name']}' ";
				$result = $db->query($sql, 1);
				upDateRankLock($db, $result,"g_lock", $lock);
				$sql="SELECT g_name, g_look FROM g_user WHERE g_nid LIKE '{$userList[0]['g_nid']}%' ";
				$results = $db->query($sql, 1);
				upDateRankLock($db, $results,"g_look", $lock, 1);
			}

			$sql = " UPDATE `g_rank` SET `g_f_name` = '{$s_F_Name}', g_password = '{$s_Pwd}',`g_zy`='{$g_zy}', `g_lock` = '{$lock}' ".$g_pwd.",g_money='{$s_money}',g_distribution='{$s_next_ky}',g_distribution_limit='{$s_next_ky}' WHERE `g_name` = '{$userList[0]['g_name']}' LIMIT 1";

			$db->query($sql, 2);
			
			//此处。处理占成
			
			
			
			
			if ($userList[0]['g_f_name'] != $s_F_Name){
				$valueList = array();
				$valueList['g_name'] = $userList[0]['g_name'];
				$valueList['g_f_name'] = $_SESSION['sName'];
				$valueList['g_initial_value'] = $userList[0]['g_f_name'];
				$valueList['g_up_value'] = $s_F_Name;
				$valueList['g_up_type'] = '名稱';
				$valueList['g_s_id'] = 1;
				insertLogValue($valueList);
			}
			exit(alert_href('更變成功', 'Actfor.php?cid='.$cid));
		} else {
			$Lnid = mb_substr($userList[0]['g_nid'], 0, mb_strlen($userList[0]['g_nid'])-32);
			$Luser = $userModel->GetUserName_Like($Lnid);
			$s_money = $_POST['s_money'];
			$s_a_lock = $_POST['s_a_lock'];
			$s_b_lock = isset($_POST['s_b_lock']) ? $_POST['s_b_lock'] : 1;	
			$s_size_ky = $_POST['s_size_ky'];
			$s_next_ky = $_POST['s_next_KY'];
		
			/*$s_size_ky = $_POST['s_size_ky']; //上級占成
			$s_next_ky = $_POST['s_next_KY'] ;*/ //當前被修改帳號占成
			if ($s_a_lock != $userList[0]['g_Immediate_lock']){
				if ($Luser[0]['g_Immediate_lock'] != 1){
					exit(back('更變權限不足！'));
				} else {
					$sql="SELECT g_name, g_Immediate_lock FROM g_rank WHERE g_nid LIKE '{$userList[0]['g_nid']}%' AND g_name <> '{$userList[0]['g_name']}' ";
					$Immediate = $db->query($sql, 1);
					upDateRankLock($db, $Immediate, 'g_Immediate_lock', $s_a_lock);
					//print_r($Immediate);exit;
				}
			}
			if ($Luser[0]['g_lock'] != 1) {
				exit(back('更變權限不足！'));
			}
			if (!Matchs::isNumber($s_money)) exit(back('輸入信用額錯誤！'));
			/**
			 * 判斷當前修改的信用額是否超出上級可用額
			 * 如果超出競爭修改
			 */
			 
			if ($userList[0]['g_login_id']==48){
				$validMoney = validMoney ($userModel, $userList[0]['g_money'], $userList[0]['g_nid'], true);
			} else {
				$validMoney = validMoney ($userModel, $userList[0]['g_money'], $userList[0]['g_nid'].UserModel::Like(), false);
			}
			
			if ($s_money != $userList[0]['g_money']) {
				/**
				 * 當信用額發生變化
				 */
				if ($s_money < $userList[0]['g_money']) {
					$s_moneys = $userList[0]['g_money'] - $s_money;
					if ($s_moneys > $validMoney) exit(back('可 “回收” 餘額：'.$validMoney));
				} else {
					/**
					 * 當前帳號級別不是股東的情況下
					 * 計算出上級的可用金額
					 */
					if ($userList[0]['g_login_id']!=56) {
						$LvalidMoney = validMoney ($userModel, $Luser[0]['g_money'], $Luser[0]['g_nid'].UserModel::Like(), false);
						$LRank = $userModel->GetLoginIdByString($Luser[0]['g_login_id']);
						$LvalidMoneys = $LvalidMoney + $userList[0]['g_money'];
						if ($s_money > $LvalidMoneys) exit(back($LRank[0].'可用餘額：'.$LvalidMoney));
					}
				}
			}
			
			if (!Matchs::isNumber($s_size_ky) || !Matchs::isNumber($s_next_ky)) exit(back('輸入占成錯誤'));
			/**
			 * $s_size_ky = 上級占成 判斷上級總占成是否大於修改后的占成
			 *  $s_next_ky = 當前被修改帳號占成、必須進行判斷此帳號所分配的占成是否超出所修改的值，
			 *  如果超出將禁止修改。
			 */
			if ($s_size_ky > $Luser[0]['g_distribution'] || $s_next_ky > $Luser[0]['g_distribution'] || ($s_size_ky+$s_next_ky) > $Luser[0]['g_distribution']) 
				exit(back('最高可設占成：'.$Luser[0]['g_distribution'].'%'));
          //  dump($userList[0]['g_login_id']);
			if ($userList[0]['g_login_id'] == 48) {
			//代理
				$nid = $userList[0]['g_nid'];
				$sql = "SELECT max(`g_distribution`) FROM `g_user` WHERE `g_nid` like '{$nid}' LIMIT 1";
				$max = $db->query($sql, 0);
				$max = $max[0][0] ? $max[0][0] : 0;
			} else if ($userList[0]['g_login_id'] == 78) {
			//总代理
				$nid = $userList[0]['g_nid'].UserModel::Like();
				$sql = "SELECT  max(g_distribution+g_distribution_limit) FROM `g_rank` WHERE `g_nid` like '%$nid%'  and g_login_id=48 LIMIT 1";
				$max = $db->query($sql, 0);
				//$sqlh = "SELECT max(`g_distribution`) FROM `g_rank` WHERE `g_nid` like '%$nid%' and g_login_id=48 LIMIT 1";
				$sqlh = "SELECT max(`g_distribution`) FROM `g_user` WHERE `g_nid` like '{$nid}' LIMIT 1";
				$maxh = $db->query($sqlh, 0);
				
				
				$max1 = $max[0][0] ? $max[0][0] : 0;
				$max2 = $maxh[0][0] ? $maxh[0][0] : 0;
				
				if ($max1<$max2){
				$max = $max2;	
				}else{
				$max = $max1;		
				}
			}else {
			//股东
				$nid = $userList[0]['g_nid'].UserModel::Like();
				$res = $db->query("SELECT g_nid,g_name FROM g_rank WHERE g_nid like '{$nid}' ",1);
				$max=0;
				for($u=0;$u<count($res);$u++){
				$did=$res[$u]['g_nid'];
				$sqlx = "SELECT  g_distribution_limit FROM `g_rank` WHERE `g_nid`='{$did}'  and g_login_id=78 LIMIT 1";
				$maxx = $db->query($sqlx, 0);
				$sql = "SELECT  max(g_distribution+g_distribution_limit) FROM `g_rank` WHERE `g_nid` like '%$did%'  and g_login_id=48 LIMIT 1";
				$maxy = $db->query($sql, 0);
				//$sqlh = "SELECT max(`g_distribution`) FROM `g_rank` WHERE `g_nid` like '%$nid%' and g_login_id=48 LIMIT 1";
				$sqlh = "SELECT max(`g_distribution`) FROM `g_user` WHERE `g_nid` like '{$nid}' LIMIT 1";
				$maxh = $db->query($sqlh, 0);
				//dump($max);
				$max1 = $maxy[0][0] ? $maxy[0][0] : 0;
				$max1x = $maxx[0][0] ? $maxx[0][0] : 0;
				$max2 = $maxh[0][0] ? $maxh[0][0] : 0;
				
				if (($max1+$max1x)<$max2){
				$maxa = $max2;	
				}else{
				$maxa = $max1+$max1x;		
				}
				if($max<$maxa){
				$max=$maxa;
				}
				}
			}
		
			
			
			if ($s_next_ky < $max) {
				exit(back('回調占成率最小值：'.$max.'%'));
			}///此处错误，回调不但只会员
			if ($userList[0]['g_lock'] != $lock){
				$sql="SELECT g_name, g_lock FROM g_rank WHERE g_nid LIKE '{$userList[0]['g_nid']}%' AND g_name <> '{$userList[0]['g_name']}' ";
				$result = $db->query($sql, 1);
				upDateRankLock($db, $result, 'g_lock', $lock);
				$sql="SELECT g_name, g_look FROM g_user WHERE g_nid LIKE '{$userList[0]['g_nid']}%' ";
				$results = $db->query($sql, 1);
				upDateRankLock($db, $results, 'g_look', $lock, 1);
			}

			$sql = "UPDATE g_rank SET 
			`g_password`='{$s_Pwd}',
			`g_f_name`='{$s_F_Name}',
			`g_money`='{$s_money}',
			`g_distribution`='{$s_next_ky}',
			`g_distribution_limit`='{$s_size_ky}',
			`g_Immediate_lock`='{$s_a_lock}',
			`g_Immediate2_lock`='{$s_b_lock}',
			`g_lock`='{$lock}' ".$g_pwd."
			WHERE g_name = '{$name}' LIMIT 1";
			$db->query($sql, 2);
			
			//此处处理占成
			
			if ($userList[0]['g_f_name'] != $s_F_Name){
				$valueList = array();
				$valueList['g_name'] = $userList[0]['g_name'];
				$valueList['g_f_name'] = $_SESSION['sName'];
				$valueList['g_initial_value'] = $userList[0]['g_f_name'];
				$valueList['g_up_value'] = $s_F_Name;
				$valueList['g_up_type'] = '名稱';
				$valueList['g_s_id'] = 1;
				insertLogValue($valueList);
			}
			
			if ($s_money != $userList[0]['g_money']){
				$valueList = array();
				$valueList['g_name'] = $userList[0]['g_name'];
				$valueList['g_f_name'] = $_SESSION['sName'];
				$valueList['g_initial_value'] = $userList[0]['g_money'];
				$valueList['g_up_value'] = $s_money;
				$valueList['g_up_type'] = '信用額';
				$valueList['g_s_id'] = 1;
				insertLogValue($valueList);
			}
			
			if ($s_next_ky != $userList[0]['g_distribution']){
				$valueList = array();
				$valueList['g_name'] = $userList[0]['g_name'];
				$valueList['g_f_name'] = $_SESSION['sName'];
				$valueList['g_initial_value'] = $userList[0]['g_distribution'].'%';
				$valueList['g_up_value'] = $s_next_ky.'%';
				$valueList['g_up_type'] = '下級占成';
				$valueList['g_s_id'] = 1;
				insertLogValue($valueList);
			}
			
			if ($s_size_ky != $userList[0]['g_distribution_limit']){
				$valueList = array();
				$valueList['g_name'] = $userList[0]['g_name'];
				$valueList['g_f_name'] = $_SESSION['sName'];
				$valueList['g_initial_value'] = $userList[0]['g_login_id']==22 ? (100 - $userList[0]['g_distribution_limit']).'%' : $userList[0]['g_distribution_limit'].'%';
				$valueList['g_up_value'] = $userList[0]['g_login_id']==22 ? (100- $s_size_ky).'%' : $s_size_ky.'%';
				$valueList['g_up_type'] = '上級占成';
				$valueList['g_s_id'] = 1;
				insertLogValue($valueList);
			}

			exit(alert_href('更變成功！', 'Actfor.php?cid='.$cid));
		}
		
	} else {
		exit(alert_href('無法讀取帳號信息！', 'Actfor.php?cid='.$cid));
	}
	exit('POST');
}
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cid']) && isset($_GET['uid']))
{
	
	$uid = $_GET['uid'];
	$cid = $_GET['cid'];
	$userList = $userModel->GetUserModel(null, $uid);
	if ($userList){
		$Rank = $userModel->GetLoginIdByString($userList[0]['g_login_id']);
		$Lnid = mb_substr($userList[0]['g_nid'], 0, mb_strlen($userList[0]['g_nid'])-32);
		$Luser = $userModel->GetUserName_Like($Lnid);
		$LRank = $userModel->GetLoginIdByString($Luser[0]['g_login_id']);
		//得到當前用戶可用額
		if ($userList[0]['g_login_id']==48){
			$validMoney = validMoney ($userModel, $userList[0]['g_money'], $userList[0]['g_nid'], true);
		} else {
			$validMoney = validMoney ($userModel, $userList[0]['g_money'], $userList[0]['g_nid'].UserModel::Like(), false);
		}
	} else {
		exit(alert_href('無法讀取用戶信息！', 'Actfor.php?cid='.$cid));
	}
}
else 
{
	exit(href('Quit.php'));
}

function validMoney ($userModel, $countMoney, $nid, $param) {
	$validMoney = $countMoney - $userModel->SumMoney($nid,$param);
	return $validMoney;
}
function upDateRankLock($db, $result, $l, $lock, $p=0){
	if ($p==1){
		$from = "g_user";
		//$l = "g_look";
	} else {
		$from = "g_rank";
		//$l = "g_lock";
	}
	for ($i=0; $i<count($result); $i++){
		$db->query("UPDATE `{$from}` SET `{$l}` = '{$lock}' WHERE g_name = '{$result[$i]['g_name']}' ",2);
	}
}
cPos("后台-修改代理".$userList[0]['g_name']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Admin/temp/js/common.js"></script>
<script type="text/javascript" src="/Admin/temp/js/Pwd_Safety.js"></script>
<title></title>
</head>
<body onselectstart="return false">
<form method="post" action="?cid=<?php echo $cid?>" onsubmit="return isPostcid()" >
<input type="hidden" name="name" value="<?php echo $userList[0]['g_name']?>" />
	<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="5" height="100%" bgcolor="#4F4F4F"></td>	
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Admin/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="99%">&nbsp;用戶信息</td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                            		<th colspan="6">帳戶資料</th>
                            	</tr>
                                <tr style="height:28px">
                                	<td class="bj"><?php echo $Rank[0]?>帳號</td>
                                    <td class="left_p5"><?php echo $userList[0]['g_name']?>  &nbsp;&nbsp; 
                                    	【<input name="lock" type="radio" value="1" <?php if($userList[0]['g_lock']==1){echo 'checked="checked"';}?> />啟用&nbsp;
	                                    	<input name="lock" type="radio" value="2" <?php if($userList[0]['g_lock']==2){echo 'checked="checked"';}?> />凍結&nbsp;
	                                        <input name="lock" type="radio" value="3" <?php if($userList[0]['g_lock']==3){echo 'checked="checked"';}?> />停用&nbsp;】
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj"><?php echo $Rank[0]?>名稱</td>
                                    <td class="left_p5"><input autocomplete="off" type="text" style="width:139px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' name="s_F_Name" value='<?php echo $userList[0]['g_f_name']?>'  maxlength="20" /></td>									
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">新密碼</td>
                                    <td class="left_p5"><input autocomplete="off" type="password" style="width:139px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' name="s_Pwd" id="s_Pwd" value=''  maxlength="20" /></td>																		
                                </tr>
                                <?php if ($LoginId != 89 || $cid !=1){?>
                                <tr style="height:28px">
                                	<td class="bj">信用額度</td>
                                    <td class="left_p5"><input autocomplete="off" type="text" style="width:139px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' name="s_money" value='<?php echo $userList[0]['g_money']?>'  maxlength="20" />
									 <font color="344b50">&nbsp;
                                   	『&nbsp;可‘回收’餘額&nbsp;<span id='money_ky' ><?php echo $validMoney?></span>&nbsp;』</font></td>																											
                                </tr>
                               
                                <tr style="height:28px">
                                	<td class="bj"><?php echo $LRank[0]?>占成</td>
                                	<?php 
                                	if ($userList[0]['g_login_id']==22){
                                		$limits = $userList[0]['g_distribution_limit'];
                                		$max = $Luser[0]['g_distribution'];
                                	} else {
                                		$limits = $userList[0]['g_distribution_limit'];
                                		$max = $Luser[0]['g_distribution'];
                                	}
                                	?>
                                    <td class="left_p5"><input autocomplete="off" type="text" <?php if($p==false){echo 'readonly style="background-color:#cccccc;" ';}?> style="width:35px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' name="s_size_ky" value='<?php echo $limits?>'  maxlength="3" />
									&nbsp;%
                                    	&nbsp;&nbsp;最高可設占成：<span class="odds"><?php echo $max?>%</span></td>																		
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj"><?php echo $Rank[0]?>占成</td>
                                    <td class="left_p5">
                                    <input autocomplete="off" type="text" <?php if($p==false){echo 'readonly style="background-color:#cccccc;" ';}?> style="width:35px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' name="s_next_KY" value='<?php echo $userList[0]['g_distribution']?>'  maxlength="3" />									
									&nbsp;%</td>
                                </tr>
                                <?php if($userList[0]['g_login_id']==48){?>
                                <tr style="height:28px">
                                	<td class="bj">即時註單</td>
                                    <td class="left_p5">
	                                    <input type="radio" value="1" name="s_b_lock"  <?php if($userList[0]['g_Immediate2_lock']==1){echo 'checked="checked"';}?> />啓用&nbsp;
	                                    <input type="radio" value="2" name="s_b_lock" <?php if($userList[0]['g_Immediate2_lock']!=1){echo 'checked="checked"';}?>  />禁用
	                               </td>
                                </tr>
                                <?php }?>
                                <tr style="height:28px">
                                	<td class="bj">補貨功能</td>
                                    <td class="left_p5">
	                                    <input type="radio" value="1" name="s_a_lock"  <?php if($userList[0]['g_Immediate_lock']==1){echo 'checked="checked"';}?> />啓用&nbsp;
	                                    <input type="radio" value="2" name="s_a_lock"  <?php if($userList[0]['g_Immediate_lock']!=1){echo 'checked="checked"';}?> />禁用
                                    </td>
                                </tr>
                                <?php }else{
								?>
								 <tr style="height:28px">
                                	<td class="bj">信用額度</td>
                                    <td class="left_p5"><input style="width:139px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' type="text" name="s_money" value="<?php echo $userList[0]['g_money']?>"  maxlength="20" />&nbsp;
                                   	『&nbsp;可‘回收’餘額&nbsp;<span id='money_ky' class="red"><?php echo $validMoney?></span>&nbsp;』</td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">总公司占成</td>
                                    <td class="left_p5">
                                    	<input  style="width:35px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' type="text" <?php if($p==false){echo 'readonly style="background-color:#cccccc;" ';}?> name="s_size_ky" value="<?php echo 100-$userList[0]['g_distribution'];?>"  maxlength="3" />&nbsp;%
                                    	&nbsp;&nbsp;最高可設占成：<span class="odds">100%</span>
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj"><?php echo $Rank[0]?>占成</td>
                                    <td class="left_p5"><input style="width:35px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM'  type="text" <?php if($p==false){echo 'readonly style="background-color:#cccccc;" ';}?> name="s_next_KY" value="<?php echo $userList[0]['g_distribution']?>"  maxlength="3" />&nbsp;%</td>
                                </tr>
								
								 <tr style="height:28px">
                                	<td class="bj">占余成数归</td>
                                    <td class="left_p5"><?php echo $userList[0]['g_zcgs']==1? "总公司":"分公司";?></td>
                                </tr>
                                  <tr style="height:28px">
                                	<td class="bj">赚佣</td>
                                    <td class="left_p5"><input style="width:35px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM'  type="text"  name="g_zy" value="<?php echo $userList[0]['g_zy']?>"  maxlength="3" />&nbsp;</td>
                                </tr>
                               
                                
								<?php
								}?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><input type="submit" class="inputs" value="確認更改" /></td>
                        <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
					
				</table>
            <td width="5" bgcolor="#4F4F4F"></td>
					</td>
        </tr>
        <tr>
        	<td height="5" bgcolor="#4F4F4F"></td>
            <td bgcolor="#4F4F4F"></td>
            <td height="5" bgcolor="#4F4F4F"></td>
        </tr>
    </table>
	</form>
</body>
</html>