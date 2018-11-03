<?
//ini_set('display_errors','yes');
//back(' 11111111111111111！');exit;

$gameid2=$gameid=$caizhong=$_REQUEST['caizhong'];
if($gameid==0) $gameid2=1;
$wanfa=$_REQUEST['wanfa'];
$jiangqi=$_REQUEST['jiangqi'];
$shortcut=$_REQUEST['shortcut'];
if(!is_numeric($gameid)){back('非法提交');exit;}
if(!is_numeric($jiangqi)){back('非法提交2');exit;}
$caizhong=$caizhong==0 ? '' : $caizhong;

include_once 'offGame.php';
global $user, $UserOut;
$gtypes = get_gameName($gameid);

if ($user[0]['g_look'] == 2 || $user[0]['g_out'] != 1)  exit(back($UserOut));

$db = new DB();
$result = $db->query("SELECT `g_id`,`g_qishu`, `g_feng_date`, `g_open_date` FROM g_kaipan$caizhong WHERE `g_lock` = 2 and g_id=$jiangqi LIMIT 1 ", 1);
$qishu=	$result[0]['g_qishu'];
$g_id=	$result[0]['g_id'];
if($g_id!=$jiangqi || strtotime($result[0]['g_feng_date'])-time()<=0){
	//exit("$g_id!=$jiangqi");
	back($qishu.' 已经封盘！');exit;
}

$ball_list=$_POST['uPI_ID'];
$isc_list=$_POST['is_c'];
$money_list=$_POST['uPI_M'];
$h_list=$_POST['uPI_h'];
$pl_list=$_POST['uPI_P'];
$index_list=$_POST['i_index'];

$all_money=array_sum($money_list);
if($all_money>$user[0]['g_money_yes']){alert('很抱歉，您的可用额度不足以本次下注');exit;}
if($gameid==0 || $gameid==1 || $gameid==9){
	if($gtypesid==9){$setodds_fun='setoddsnc';$ConfigModel= configModel("`g_mix_money`, `g_web_lock`,`g_nc_game_lock`, `g_odds_ratio_b1`,`g_odds_ratio_b2`,`g_odds_ratio_b3`,`g_odds_ratio_b4`,`g_odds_ratio_b5`,`g_odds_ratio_c1`,`g_odds_ratio_c2`,`g_odds_ratio_c3`,`g_odds_ratio_c4`,`g_odds_ratio_c5`");}
	else{$setodds_fun='setodds';$ConfigModel= configModel("`g_mix_money`, `g_web_lock`,`g_kg_game_lock`, `g_odds_ratio_b1`,`g_odds_ratio_b2`,`g_odds_ratio_b3`,`g_odds_ratio_b4`,`g_odds_ratio_b5`,`g_odds_ratio_c1`,`g_odds_ratio_c2`,`g_odds_ratio_c3`,`g_odds_ratio_c4`,`g_odds_ratio_c5`");}
	foreach($ball_list as $key=>$ball_num){
		//if(!$isc_list[$key]) continue;
		if(!is_numeric($ball_num)){back('非法提交,玩法错误：'.$ball_num);exit;}
		if(!is_numeric($money_list[$key])){back('非法提交,金额错误：'.$money_list[$key]);exit;}
		$ball_name=get_ballname($gameid,'Ball_'.$ball_num,$h_list[$key]);
		$wf_name=get_wfname($gameid,'Ball_'.$ball_num,$h_list[$key]);
		$money=$money_list[$key];
		if($ball_name==='' || $wf_name===''){back('非法提交,提交的玩法或投注号码错误');exit;}
		
		$is_true=$gameid==9 ? true : false;;
		$result = GetUserXianEr ($ball_name, $wf_name, $user[0]['g_name'],$gameid2); 	//當前用戶退水列表
		$max = GetUser_s_ot ($result, $user,$ball_name, $wf_name,$gameid1);
		isUserMoney_wap ($money, $max,$all_money);
		
		$odds = getodds_ftype ('Ball_'.$ball_num,$h_list[$key],$gameid2);//賠率
		$hv = sresult ($wf_name);
		if ($sm_arr[$i][0]=='總和、龍虎'){
			$odds = $setodds_fun($hv, $odds, $ConfigModel, $user, 1);
		} else {
			$odds = $setodds_fun($hv, $odds, $ConfigModel, $user, 0);
		}
		$i=0;
		$ListArr[$i]['g_s_nid'] = $user[0]['g_nid'];											//外鍵
		$ListArr[$i]['g_mumber_type'] = $user[0]['g_mumber_type'];				//會員類型
		$ListArr[$i]['g_nid'] = $user[0]['g_name'];											//帳號
		$ListArr[$i]['g_date'] = date('Y-m-d H:i:s');											//下注時間
		$ListArr[$i]['g_type'] = $gtypes;															//彩票類型
		$ListArr[$i]['g_qishu'] = $qishu;													//下注期數
		$ListArr[$i]['g_mingxi_1'] = $ball_name;  													//明細1 例如：		第一球
		$ListArr[$i]['g_mingxi_1_str'] = null;													//字符串明細_1 	標明連碼用的
		$ListArr[$i]['g_mingxi_2'] = $wf_name;												//明細2 				下注號碼
		$ListArr[$i]['g_mingxi_2_str'] = null;													//字符串明細_2 	標明連碼用的		
		$ListArr[$i]['g_odds'] = $odds;															//賠率
		$ListArr[$i]['g_jiner'] = $money;
		
		$DtnArray = SumRankDistribution ($user, $money, $wf_name, $ball_name,$gameid1);
		$g_pan=$user[0]['g_panlu'];
		if($g_pan=="A"){
		$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_a']; 
		}
		if($g_pan=="B"){
		$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_b']; 		//會員退水
		}
		if($g_pan=="C"){
		$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_c']; 		//會員退水
		}
		$ListArr[$i]['g_tueishui_1'] = $DtnArray['tueishui_1']; 		//代理退水
		$ListArr[$i]['g_tueishui_2'] = $DtnArray['tueishui_2']; 	//總代理退水
		$ListArr[$i]['g_tueishui_3'] = $DtnArray['tueishui_3']; 	//股東退水
		$ListArr[$i]['g_tueishui_4'] = $DtnArray['tueishui_4']; 	//公司退水
		$ListArr[$i]['g_distribution'] = $DtnArray['distribution_1']; 			//代理占成
		$ListArr[$i]['g_distribution_1'] = $DtnArray['distribution_2'];	 	//總代理占成
		$ListArr[$i]['g_distribution_2'] = $DtnArray['distribution_3']; 		//股東占成
		$ListArr[$i]['g_distribution_3'] = $DtnArray['distribution_4']; 		//公司占成
		$ListArr[$i]['g_distribution_4'] =100- ($DtnArray['distribution_4']+$DtnArray['distribution_3']+$DtnArray['distribution_2']+$DtnArray['distribution_1']); 		//公司占成
		$gMoney = $max['KeYongEr'] - $money;
		$ListArr[$i]['KeYongEr'] = $gMoney;
		$tuiShui = sumTuiSui ($ListArr[$i]);
		$_tuiShui = $ListArr[$i]['g_jiner'] * $tuiShui;
		$ListArr[$i]['KeYing'] = $ListArr[$i]['g_jiner'] * $ListArr[$i]['g_odds'] - $ListArr[$i]['g_jiner'] + $_tuiShui;
		$ListArr[$i]['id'] = postForms ($ListArr[$i]);
		if ($ListArr[$i]['id'] == null) exit(back("抱歉！{$ListArr[0]['g_mingxi_1']}『{$ListArr[0]['g_mingxi_2']}』下註失敗"));
		
		upUserKyYongEr ($gMoney, $ListArr[0]['g_nid']);
		$user[0]['g_money_yes']=$gMoney;
	}
	}
//===========================================重庆时时彩===========================================================================
else if($gameid==2 || $gameid==3 ||$gameid==10 ||$gameid==11){
	if($gtypesid==2){$ConfigModel =configModel("`g_web_lock`, `g_cq_game_lock`,`g_odds_ratio_cq_b1`,`g_odds_ratio_cq_b2`,`g_odds_ratio_cq_b3`,`g_odds_ratio_cq_c1`,`g_odds_ratio_cq_c2`,`g_odds_ratio_cq_c3`");}
	else{$ConfigModel =configModel("`g_web_lock`, `g_cq_game_lock`,`g_odds_ratio_cq_b1`,`g_odds_ratio_cq_b2`,`g_odds_ratio_cq_b3`,`g_odds_ratio_cq_c1`,`g_odds_ratio_cq_c2`,`g_odds_ratio_cq_c3`");}
	foreach($ball_list as $key=>$ball_num){
		//if(!$isc_list[$key]) continue;
		if(!is_numeric($ball_num)){back('非法提交,玩法错误：'.$ball_num);exit;}
		if(!is_numeric($money_list[$key])){back('非法提交,金额错误：'.$money_list[$key]);exit;}
		$ball_name=get_ballname($gameid,'Ball_'.$ball_num,$h_list[$key]);
		$wf_name=get_wfname($gameid,'Ball_'.$ball_num,$h_list[$key]);
		$money=$money_list[$key];
		if($ball_name==='' || $wf_name===''){back('非法提交,提交的玩法或投注号码错误');exit;}
		//back($ball_num.'非法提交,提交的玩法或投注号码错误'.$h_list[$key]);exit;
		$c=$wf_name;
		if ('Ball_'.$ball_num == 'Ball_61'  ){
			
			if($h_list[$key]=='h1'||$h_list[$key]=='h2')
			{
			$c = '總和大小';
			}else if($h_list[$key]=='h3'||$h_list[$key]=='h4')
			{
			$c = '總和單雙';
			}else if($h_list[$key]=='h5'||$h_list[$key]=='h6'||$h_list[$key]=='h7')
			{
			$c='龍虎和';
			}
		}else{
			$c_arr = isBallType('Ball_'.$ball_num, $h_list[$key], true);
			//$c_arr=isBallTypecqsm('Ball_'.$ball_num, $h_list[$key], true);
			$c=$c_arr[0];
		}
		$result = GetUserXianErcq($c, $user[0]['g_name']);
		//echo $c;
		//print_r($result);exit;
		$max = GetUser_s_ot ($result, $user,$ball_name, $wf_name,$gameid);
		isUserMoney_wap ($money, $max,$all_money);
		
		$odds = GetOddscq('Ball_'.$ball_num, $h_list[$key], $gameid);
		if ('Ball_'.$ball_num == 'Ball_1' || 'Ball_'.$ball_num == 'Ball_2' || 'Ball_'.$ball_num == 'Ball_3' || 'Ball_'.$ball_num == 'Ball_4' || 'Ball_'.$ball_num == 'Ball_5')
		{
			if ($h_list[$key] != 'h11' &&$h_list[$key] != 'h12' &&$h_list[$key] != 'h13' &&$h_list[$key] != 'h14')
				$odds = setoddscq($h_list[$key], $odds, $ConfigModel, $user, 0,'Ball_'.$ball_num);
			else 
				$odds = setoddscq($h_list[$key], $odds, $ConfigModel, $user, 1);
		}
		else if ('Ball_'.$ball_num == 'Ball_6')
		{
			$odds = setoddscq($h_list[$key], $odds, $ConfigModel, $user, 1,'Ball_'.$ball_num);
		}
		else if ('Ball_'.$ball_num == 'Ball_7' || 'Ball_'.$ball_num == 'Ball_8' || 'Ball_'.$ball_num == 'Ball_9')
		{
			$odds = setoddscq($h_list[$key], $odds, $ConfigModel, $user, 2,'Ball_'.$ball_num);
		}
		$i=0;
		$ListArr[$i]['g_s_nid'] = $user[0]['g_nid'];
		$ListArr[$i]['g_mumber_type'] = $user[0]['g_mumber_type'];
		$ListArr[$i]['g_nid'] = $user[0]['g_name'];
		$ListArr[$i]['g_date'] = date('Y-m-d H:i:s');
		$ListArr[$i]['g_type'] = $gtypes;
		$ListArr[$i]['g_qishu'] = $qishu;
	
		$ListArr[$i]['g_mingxi_1'] = $ball_name;
		$ListArr[$i]['g_mingxi_1_str'] = null;
		$ListArr[$i]['g_mingxi_2'] = $wf_name;
		$ListArr[$i]['g_mingxi_2_str'] = null;
		$ListArr[$i]['g_odds'] = $odds;
		$ListArr[$i]['g_jiner'] = $money;

		$g_pan=$user[0]['g_panlu'];
			if($g_pan=="A"){
			$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_a']; 		//會員退水
			}
			if($g_pan=="B"){
			$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_b']; 		//會員退水
			}
			if($g_pan=="C"){
			$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_c']; 		//會員退水
			}
		//$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu'];
		$DtnArray = SumRankDistribution ($user, $money, null, $c, true);
		$ListArr[$i]['g_tueishui_1'] = $DtnArray['tueishui_1'];
		$ListArr[$i]['g_tueishui_2'] = $DtnArray['tueishui_2'];
		$ListArr[$i]['g_tueishui_3'] = $DtnArray['tueishui_3'];
		$ListArr[$i]['g_tueishui_4'] = $DtnArray['tueishui_4'];
		$ListArr[$i]['g_distribution'] = $DtnArray['distribution_1'];
		$ListArr[$i]['g_distribution_1'] = $DtnArray['distribution_2'];
		$ListArr[$i]['g_distribution_2'] = $DtnArray['distribution_3'];
		$ListArr[$i]['g_distribution_3'] = $DtnArray['distribution_4'];
		$ListArr[$i]['g_distribution_4'] =100- ($DtnArray['distribution_4']+$DtnArray['distribution_3']+$DtnArray['distribution_2']+$DtnArray['distribution_1']); 		//公司占成
		$gMoney = $max['KeYongEr'] - $money;
		$ListArr[$i]['KeYongEr'] = $gMoney;
		$tuiShui = sumTuiSui ($ListArr[$i]);
		$_tuiShui = $ListArr[$i]['g_jiner'] * $tuiShui;
		$ListArr[$i]['KeYing'] = $ListArr[$i]['g_jiner'] * $ListArr[$i]['g_odds'] - $ListArr[$i]['g_jiner'] + $_tuiShui;
		$ListArr[$i]['id'] = postForms ($ListArr[$i]);
		if ($ListArr[$i]['id'] == null) exit(back("抱歉！{$ListArr[$i]['g_mingxi_1']}『{$ListArr[$i]['g_mingxi_2']}』下註失敗"));
		upUserKyYongEr ($gMoney, $ListArr[0]['g_nid']);
		$user[0]['g_money_yes']=$gMoney;
	}
}
//===========================================吉林快三===========================================================================
else if($gameid==7){
	if($gtypesid==7){$ConfigModel =configModel("`g_web_lock`, `g_cq_game_lock`,`g_odds_ratio_cq_b1`,`g_odds_ratio_cq_b2`,`g_odds_ratio_cq_b3`,`g_odds_ratio_cq_c1`,`g_odds_ratio_cq_c2`,`g_odds_ratio_cq_c3`");}
	else{$ConfigModel =configModel("`g_web_lock`, `g_cq_game_lock`,`g_odds_ratio_cq_b1`,`g_odds_ratio_cq_b2`,`g_odds_ratio_cq_b3`,`g_odds_ratio_cq_c1`,`g_odds_ratio_cq_c2`,`g_odds_ratio_cq_c3`");}
	foreach($ball_list as $key=>$ball_num){
		//if(!$isc_list[$key]) continue;
		if(!is_numeric($ball_num)){back('非法提交,玩法错误：'.$ball_num);exit;}
		if(!is_numeric($money_list[$key])){back('非法提交,金额错误：'.$money_list[$key]);exit;}
		$ball_name=get_ballname($gameid,'Ball_'.$ball_num,$h_list[$key]);
		$wf_name=get_wfname($gameid,'Ball_'.$ball_num,$h_list[$key]);
		$money=$money_list[$key];
		if($ball_name==='' || $wf_name===''){back('非法提交,提交的玩法或投注号码错误');exit;}
		//back($ball_num.'非法提交,提交的玩法或投注号码错误'.$h_list[$key]);exit;
		$c=$wf_name;
		
		if ('Ball_'.$ball_num == 'Ball_3'){
		if($h_list[$key]!='h7')
		   {
			$c = '圍骰全骰';
			}else
			{
			$c = '圍骰全骰';
			}
		}else{
			$c_arr = isBallType('Ball_'.$ball_num, $h_list[$key], true);
			//$c_arr=isBallTypecqsm('Ball_'.$ball_num, $h_list[$key], true);
			$c=$c_arr[0];
		}
		$result = GetUserXianErcq($c, $user[0]['g_name']);
		//echo $c;
		//print_r($result);exit;
		$max = GetUser_s_ot ($result, $user,$ball_name, $wf_name,$gameid);
		isUserMoney_wap ($money, $max,$all_money);
		
		$odds = GetOddssz('Ball_'.$ball_num, $h_list[$key], $gameid);
		if ('Ball_'.$ball_num == 'Ball_1' || 'Ball_'.$ball_num == 'Ball_2' || 'Ball_'.$ball_num == 'Ball_3' || 'Ball_'.$ball_num == 'Ball_4' || 'Ball_'.$ball_num == 'Ball_5')
		{
			if ($h_list[$key] != 'h11' &&$h_list[$key] != 'h12' &&$h_list[$key] != 'h13' &&$h_list[$key] != 'h14')
				$odds = setoddssz($h_list[$key], $odds, $ConfigModel, $user, 0,'Ball_'.$ball_num);
			else 
				$odds = setoddssz($h_list[$key], $odds, $ConfigModel, $user, 1);
		}
		else if ('Ball_'.$ball_num == 'Ball_6')
		{
			$odds = setoddssz($h_list[$key], $odds, $ConfigModel, $user, 1,'Ball_'.$ball_num);
		}
		else if ('Ball_'.$ball_num == 'Ball_7' || 'Ball_'.$ball_num == 'Ball_8' || 'Ball_'.$ball_num == 'Ball_9')
		{
			$odds = setoddssz($h_list[$key], $odds, $ConfigModel, $user, 2,'Ball_'.$ball_num);
		}
		$i=0;
		$ListArr[$i]['g_s_nid'] = $user[0]['g_nid'];
		$ListArr[$i]['g_mumber_type'] = $user[0]['g_mumber_type'];
		$ListArr[$i]['g_nid'] = $user[0]['g_name'];
		$ListArr[$i]['g_date'] = date('Y-m-d H:i:s');
		$ListArr[$i]['g_type'] = $gtypes;
		$ListArr[$i]['g_qishu'] = $qishu;
	
		$ListArr[$i]['g_mingxi_1'] = $ball_name;
		$ListArr[$i]['g_mingxi_1_str'] = null;
		$ListArr[$i]['g_mingxi_2'] = $wf_name;
		$ListArr[$i]['g_mingxi_2_str'] = null;
		$ListArr[$i]['g_odds'] = $odds;
		$ListArr[$i]['g_jiner'] = $money;

		$g_pan=$user[0]['g_panlu'];
			if($g_pan=="A"){
			$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_a']; 		//會員退水
			}
			if($g_pan=="B"){
			$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_b']; 		//會員退水
			}
			if($g_pan=="C"){
			$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_c']; 		//會員退水
			}
		//$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu'];
		$DtnArray = SumRankDistribution ($user, $money, null, $c, true);
		$ListArr[$i]['g_tueishui_1'] = $DtnArray['tueishui_1'];
		$ListArr[$i]['g_tueishui_2'] = $DtnArray['tueishui_2'];
		$ListArr[$i]['g_tueishui_3'] = $DtnArray['tueishui_3'];
		$ListArr[$i]['g_tueishui_4'] = $DtnArray['tueishui_4'];
		$ListArr[$i]['g_distribution'] = $DtnArray['distribution_1'];
		$ListArr[$i]['g_distribution_1'] = $DtnArray['distribution_2'];
		$ListArr[$i]['g_distribution_2'] = $DtnArray['distribution_3'];
		$ListArr[$i]['g_distribution_3'] = $DtnArray['distribution_4'];
		$ListArr[$i]['g_distribution_4'] =100- ($DtnArray['distribution_4']+$DtnArray['distribution_3']+$DtnArray['distribution_2']+$DtnArray['distribution_1']); 		//公司占成
		$gMoney = $max['KeYongEr'] - $money;
		$ListArr[$i]['KeYongEr'] = $gMoney;
		$tuiShui = sumTuiSui ($ListArr[$i]);
		$_tuiShui = $ListArr[$i]['g_jiner'] * $tuiShui;
		$ListArr[$i]['KeYing'] = $ListArr[$i]['g_jiner'] * $ListArr[$i]['g_odds'] - $ListArr[$i]['g_jiner'] + $_tuiShui;
		$ListArr[$i]['id'] = postForms ($ListArr[$i]);
		if ($ListArr[$i]['id'] == null) exit(back("抱歉！{$ListArr[$i]['g_mingxi_1']}『{$ListArr[$i]['g_mingxi_2']}』下註失敗"));
		upUserKyYongEr ($gMoney, $ListArr[0]['g_nid']);
		$user[0]['g_money_yes']=$gMoney;
	}
}
//--------------------------------------------------------------------北京赛车-----------------------------------------
else if($gameid==4|| $gameid==6){
	foreach($ball_list as $key=>$ball_num){
		//echo $key.'<br>';
		if(!$isc_list[$key]){continue;}
		
		if(!is_numeric($ball_num)){back('非法提交,玩法错误：'.$ball_num);exit;}
		if(!is_numeric($money_list[$key])){back('非法提交,金额错误：'.$money_list[$key]);exit;}
		$ball_name=get_ballname($gameid,'Ball_'.$ball_num,$h_list[$key]);
		$wf_name=get_wfname($gameid,'Ball_'.$ball_num,$h_list[$key]);
		$money=$money_list[$key];
		if($ball_name==='' || $wf_name===''){back('非法提交,提交的玩法或投注号码错误');exit;}
		
		$is_true=$gameid==4 ? true : false;;
		$result = GetUserXianErpk ($ball_name, $wf_name, $user[0]['g_name'],$gameid); 	//當前用戶退水列表
		//echo " GetUserXianErpk($ball_name, $wf_name, ".$user[0]['g_name'].",$gameid)";
		//print_r($result);
		$max = GetUser_s_pk ($result, $user,$ball_name, $wf_name,$is_true);
		//print_r($max);exit("isUserMoney_wap ($money, $max,$all_money);");
		isUserMoney_wap ($money, $max,$money);
		
		$odds = getodds_ftype ('Ball_'.$ball_num,$h_list[$key],$gameid); 														//賠率
		$hv = sresultpk ($wf_name);
		
		if ($ball_name=='冠亞和' || $ball_name == "冠、亞軍和"){
			$odds = setoddspk($hv, $odds, $user, 1,'Ball_'.$ball_num,$gameid);
		} else {
			$odds = setoddspk($hv, $odds, $user, 0,'Ball_'.$ball_num,$gameid);
		}
		$i=0;
		$ListArr[$i]['g_s_nid'] = $user[0]['g_nid'];															//外鍵
		$ListArr[$i]['g_mumber_type'] = $user[0]['g_mumber_type'];					//會員類型
		$ListArr[$i]['g_nid'] = $user[0]['g_name'];															//帳號
		$ListArr[$i]['g_date'] = date('Y-m-d H:i:s');															//下注時間
		$ListArr[$i]['g_type'] = $gtypes;																				//彩票類型
		$ListArr[$i]['g_qishu'] = $qishu;																		//下注期數
		$ListArr[$i]['g_mingxi_1'] = $ball_name;  																		//明細1 例如：		第一球
		$ListArr[$i]['g_mingxi_1_str'] = null;																	//字符串明細_1 	標明連碼用的
		$ListArr[$i]['g_mingxi_2'] = $wf_name;														//明細2 				下注號碼
		$ListArr[$i]['g_mingxi_2_str'] = null;																	//字符串明細_2 	標明連碼用的		
		$ListArr[$i]['g_odds'] = $odds;																			//賠率
		$ListArr[$i]['g_jiner'] = $money;															//下注金額
		$DtnArray = SumRankDistributionpk ($user, $money, $wf_name, $ball_name,$is_true);
		//退水修正
		$result = GetUserXianErpk ($ball_name, $wf_name, $user[0]['g_name'],$gameid);
		$g_pan=$user[0]['g_panlu'];
		if($g_pan=="A"){
		$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_a']; 		//會員退水
		}
		if($g_pan=="B"){
		$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_b']; 		//會員退水
		}
		if($g_pan=="C"){
		$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_c']; 		//會員退水
		}
		//$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu']; 		//會員退水
		$ListArr[$i]['g_tueishui_1'] = $DtnArray['tueishui_1']; 		//代理退水
		$ListArr[$i]['g_tueishui_2'] = $DtnArray['tueishui_2']; 	//總代理退水
		$ListArr[$i]['g_tueishui_3'] = $DtnArray['tueishui_3']; 	//股東退水
		$ListArr[$i]['g_tueishui_4'] = $DtnArray['tueishui_4']; 	//公司退水
		$ListArr[$i]['g_distribution'] = $DtnArray['distribution_1']; 			//代理占成
		$ListArr[$i]['g_distribution_1'] = $DtnArray['distribution_2'];	 	//總代理占成
		$ListArr[$i]['g_distribution_2'] = $DtnArray['distribution_3']; 		//股東占成
		$ListArr[$i]['g_distribution_3'] = $DtnArray['distribution_4']; 		//公司占成
		$ListArr[$i]['g_distribution_4'] =100- ($DtnArray['distribution_4']+$DtnArray['distribution_3']+$DtnArray['distribution_2']+$DtnArray['distribution_1']); 		//公司占成
		$gMoney = $max['KeYongEr'] - $money; 												//可用金額
		$ListArr[$i]['KeYongEr'] = $gMoney;
		$tuiShui = sumTuiSui ($ListArr[$i]);
		$_tuiShui = $ListArr[$i]['g_jiner'] * $tuiShui;
		$ListArr[$i]['KeYing'] = $ListArr[$i]['g_jiner'] * $ListArr[$i]['g_odds'] - $ListArr[$i]['g_jiner'] + $_tuiShui; //可贏額
		$ListArr[$i]['id'] = postForms ($ListArr[$i]);
		if ($ListArr[$i]['id'] == null) exit(back("抱歉！{$ListArr[$i]['g_mingxi_1']}『{$ListArr[$i]['g_mingxi_2']}』下註失敗"));
		//echo $max['KeYongEr']." - $money = ".$gMoney.'<br>';
		//print_r($ListArr[0]);
		//echo "<br>==================<br>";
		upUserKyYongEr ($gMoney, $ListArr[0]['g_nid']);
		$user[0]['g_money_yes']=$gMoney;
		
	}
	
//==========================================快乐8===========================================================================
}elseif($gameid==8){
	foreach($ball_list as $key=>$ball_num){
	//back('11111');exit;
		//if(!$isc_list[$key]) continue;
		if(!is_numeric($ball_num)){back('非法提交,玩法错误：'.$ball_num);exit;}
		if(!is_numeric($money_list[$key])){back('非法提交,金额错误：'.$money_list[$key]);exit;}
		$ball_name=get_ballname($gameid,'Ball_'.$ball_num,$h_list[$key]);
		$wf_name=get_wfname($gameid,'Ball_'.$ball_num,$h_list[$key]);
		$money=$money_list[$key];
		if($ball_name==='' || $wf_name===''){back('非法提交,提交的玩法或投注号码错误');exit;}
		
		$c =tkl8sm(array('Ball_'.$ball_num,0));
		$result = GetUserXianErkl8($c, $user[0]['g_name']);
		$max = GetUser_s_kl8($result, $user,$ball_name, $wf_name, true);
		isUserMoney_wap ($money, $max,$all_money);
		$odds = GetOddsKl8('Ball_'.$ball_num,$h_list[$key]);
		$odds=setoddskl8($h_list[$key],$odds,$user,1,'Ball_'.$ball_num);
		
		$ListArr[$i]['g_s_nid'] = $user[0]['g_nid'];
		$ListArr[$i]['g_mumber_type'] = $user[0]['g_mumber_type'];
		$ListArr[$i]['g_nid'] = $user[0]['g_name'];
		$ListArr[$i]['g_date'] = date('Y-m-d H:i:s');
		$ListArr[$i]['g_type'] = $gtypes;
		$ListArr[$i]['g_qishu'] = $qishu;
	
		$ListArr[$i]['g_mingxi_1'] = $ball_name;
		$ListArr[$i]['g_mingxi_1_str'] = null;
		$ListArr[$i]['g_mingxi_2'] = $wf_name;
		$ListArr[$i]['g_mingxi_2_str'] = null;
		$ListArr[$i]['g_odds'] = $odds;
		$ListArr[$i]['g_jiner'] = $money;

		$g_pan=$user[0]['g_panlu'];
			if($g_pan=="A"){
			$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_a']; 		//會員退水
			}
			if($g_pan=="B"){
			$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_b']; 		//會員退水
			}
			if($g_pan=="C"){
			$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu_c']; 		//會員退水
			}
		//$ListArr[$i]['g_tueishui'] = $result[0]['g_panlu'];
		$DtnArray = SumRankDistribution ($user, $money, null, $c, true,true,true);
		//dump($DtnArray);
		$ListArr[$i]['g_tueishui_1'] = $DtnArray['tueishui_1'];
		$ListArr[$i]['g_tueishui_2'] = $DtnArray['tueishui_2'];
		$ListArr[$i]['g_tueishui_3'] = $DtnArray['tueishui_3'];
		$ListArr[$i]['g_tueishui_4'] = $DtnArray['tueishui_4'];
		$ListArr[$i]['g_distribution'] = $DtnArray['distribution_1'];
		$ListArr[$i]['g_distribution_1'] = $DtnArray['distribution_2'];
		$ListArr[$i]['g_distribution_2'] = $DtnArray['distribution_3'];
		$ListArr[$i]['g_distribution_3'] = $DtnArray['distribution_4'];
		$ListArr[$i]['g_distribution_4'] =100- ($DtnArray['distribution_4']+$DtnArray['distribution_3']+$DtnArray['distribution_2']+$DtnArray['distribution_1']); 		//公司占成
		$gMoney = $max['KeYongEr'] - $money;
		$ListArr[$i]['KeYongEr'] = $gMoney;
		$tuiShui = sumTuiSui ($ListArr[$i]);
		$_tuiShui = $ListArr[$i]['g_jiner'] * $tuiShui;
		$ListArr[$i]['KeYing'] = $ListArr[$i]['g_jiner'] * $ListArr[$i]['g_odds'] - $ListArr[$i]['g_jiner'] + $_tuiShui;
		$ListArr[$i]['id'] = postForms ($ListArr[$i]);
		if ($ListArr[$i]['id'] == null) exit(back("抱歉！{$ListArr[$i]['g_mingxi_1']}『{$ListArr[$i]['g_mingxi_2']}』下註失敗"));
		upUserKyYongEr ($gMoney, $ListArr[0]['g_nid']);
		$user[0]['g_money_yes']=$gMoney;
	}
}
echo "<script>location.href='tj_ok.php';</script>";
?>