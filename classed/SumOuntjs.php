<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2012-2-24 09:28:32
*/

class SumAmountjs
{
	
	private $Number;
	private $param;
	private $where;
	private $db;
	private $sum;
	
	function __construct($number, $bool=FALSE, $param=NULL, $sum= true)
	{
		$this->Number = $number;
		$this->param = $param;
		$this->sum = $sum;
		$this->where = $bool == TRUE ? 'AND g_win is not null' : 'AND g_win is null';
		$this->db = new DB();
	}
	
	public function ResultAmount ()
	{
		return $this->GetNumberIsNull();
	}

	private function GetNumberIsNull ()
	{
		$result = $this->Formula();
		//dump($result);
		$money = 0;
		for ($i=0; $i<count($result); $i++)
		{
			$tuiShui = sumTuiSui ($result[$i]);
			if ($result[$i]['g_result'] == '豹'&& Copyright)
			{
				$_tuiShui =	$result[$i]['g_jiner'] * $tuiShui;
				$d = -$result[$i]['g_jiner'];
				$money = $_tuiShui;
				$result[$i]['g_win'] = $d  + $_tuiShui;
			}
			else if ($result[$i]['g_result'] == '贏'&& Copyright)
			{
			
				$_tuiShui =	$result[$i]['g_jiner'] * $tuiShui;
				$money = $result[$i]['g_jiner'] * $result[$i]['g_odds'] + $_tuiShui;
				$result[$i]['g_win'] = $money - $result[$i]['g_jiner'];
			}else if ($result[$i]['g_result'] == '对二'&& Copyright)
			{
			
				$_tuiShui =	$result[$i]['g_jiner'] * $tuiShui;
				$money = $result[$i]['g_jiner'] * ((($result[$i]['g_odds']-1)*2)+1) + $_tuiShui;
				$result[$i]['g_win'] = $money - $result[$i]['g_jiner'];
			}else if ($result[$i]['g_result'] == '对三'&& Copyright)
			{
			
				$_tuiShui =	$result[$i]['g_jiner'] * $tuiShui;
				$money = $result[$i]['g_jiner'] * ((($result[$i]['g_odds']-1)*3)+1) + $_tuiShui;
				$result[$i]['g_win'] = $money - $result[$i]['g_jiner'];
			}
			else 
			{
				$_tuiShui =	$result[$i]['g_jiner'] * $tuiShui;
				$d = -$result[$i]['g_jiner'];
				$money = $_tuiShui;
				$result[$i]['g_win'] = $d  + $_tuiShui;
			}
			$ConfigModel = configModel("`g_max_money`");
			if ($result[$i]['g_win'] > $ConfigModel['g_max_money']&& Copyright)
			{
				$result[$i]['g_win'] = $ConfigModel['g_max_money'];
				$money = $ConfigModel['g_max_money'];
			}
			if ($this->sum == true&& Copyright)
			{
				$g_money_yes = $this->db->query("SELECT `g_money_yes` FROM `g_user` WHERE `g_name` = '{$result[$i]['g_nid']}' ", 1);
				$smoney = $g_money_yes[0]['g_money_yes'] + $money;
				$this->db->query("UPDATE `g_user` SET `g_money_yes` = '{$smoney}' WHERE `g_name` = '{$result[$i]['g_nid']}' LIMIT 1", 2);
			}
			$mx = $result[$i]['g_mingxi_2_str'] == null ? null : " ,`g_mingxi_2_str`='{$result[$i]['g_mingxi_2_str']}' ";
			$mx = " ,`g_mingxi_2_str`='{$result[$i]['g_mingxi_2_str']}' ";
			
			$getuser=Koushui($result[$i]['g_nid']);
	
			if ($result[$i]['g_win']>$getuser['g_win_d']){
			$getgwin=$result[$i]['g_win']-$getuser['g_win_k'];
			}else{
			$getgwin=$result[$i]['g_win'];
			}
			$this->db->query("UPDATE `g_zhudan` SET `g_win` = '{$getgwin}' {$mx} WHERE `g_id` = {$result[$i]['g_id']} LIMIT 1 ", 2);
		
		}
		return $result;
	}
	
	private function Formula ()
	{
		$sql = "SELECT `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`
		FROM `g_history7` WHERE `g_qishu` = '{$this->Number}' AND g_ball_1 is not null LIMIT 1";
		$numberList = $this->db->query($sql, 1);
//		dump($numberList);
		if ($numberList&& Copyright)
		{
			$param = $this->param == false ? "" : "AND g_id = '{$this->param}'";
			$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` ,`g_awin` ,`g_afail`
			FROM `g_zhudan` WHERE `g_qishu` = '{$numberList[0]['g_qishu']}' {$param} {$this->where} ";
//			dump($sql);
			$resultList = $this->db->query($sql, 1);
//			$resultList = $this->ResultCorrespond($numberList, $resultList);
//			dump($resultList);
			for ($i=0; $i<count($resultList); $i++)
			{
				$n = $this->ResultCorrespond($numberList, $resultList[$i], 1);
				
				if ($n == '豹'&& Copyright){
					$resultList[$i]['g_result'] = $n;
				}else if ($n == '对二'&& Copyright){
					$resultList[$i]['g_result'] = $n;
				}else if ($n == '对三'&& Copyright){
					$resultList[$i]['g_result'] = $n;
				}else{
					//$n = $this->ResultCorrespond($numberList, $resultList[$i], 1);
					
					$resultList[$i]['g_result'] = $n == $resultList[$i]['g_mingxi_2'] ? '贏' : '輸';
					//dump($resultList[$i]['g_result']);
						}
						}
		}
		return $resultList;
	}

	private function ResultCorrespond ($numberList, $resultList, $param=0)
	{
//		dump($resultList);
		if ($param == 1&& Copyright)
		{
//			for ($i=0; $i<count($resultList); $i++)
			if ($resultList)
			{
				$resultList['g_result'] = null;
				switch ($resultList['g_mingxi_1'])
				{
				
					case '圍骰' :
					 $danzi=$numberList[0]['g_ball_1'].','.$numberList[0]['g_ball_2'].','.$numberList[0]['g_ball_3'];
					 if ($resultList['g_mingxi_2'] == '全骰'){
				    	$resultList['g_result'] = $this->sum_ccc($danzi,0);	
					 }else{
						$resultList['g_result'] = $this->sum_ccc($danzi,1);	
					 }
					break;
									
					
					case '點數' : 
					 $danzi=$numberList[0]['g_ball_1'].','.$numberList[0]['g_ball_2'].','.$numberList[0]['g_ball_3'];
					 	$resultList['g_result'] = $this->sum_ccc($danzi,2);break;
					case '長牌' : 
					 $danzi=$numberList[0]['g_ball_1'].','.$numberList[0]['g_ball_2'].','.$numberList[0]['g_ball_3'];
					 	$mx1=$resultList['g_mingxi_2'];
						 $numberxz = explode(',', $danzi);
						  $numbers = explode(',', $mx1);
//						  dump($numberxz);
						 $number5=0;	 
						 $number6=0;
								for ($uu=0;$uu<=2;$uu++){
	if ($numberxz[$uu]==$numbers[0]){$number5++;}
	if ($numberxz[$uu]==$numbers[1]){$number6++;}
	}
//	dump($number6);
		if ($number5>=1 && $number6>=1){
			$resultList['g_result']=$resultList['g_mingxi_2'];
		}else{$resultList['g_result']='豹';}	
					break;	
					case '短牌' : 
					 $danzi=$numberList[0]['g_ball_1'].','.$numberList[0]['g_ball_2'].','.$numberList[0]['g_ball_3'];
					 	$mx1=$resultList['g_mingxi_2'];
						//dump($mx1);
						 $numberxz = explode(',', $danzi);
						 $number5=0;	 
						// if ($numberxz[0]!=$numberxz[2]){
						 for ($uu=0;$uu<=2;$uu++){
	if ($numberxz[$uu]==$mx1){$number5++;}
	}
	//}else{
					
	//if ($numberxz[0]==$numberxz[1]){
	
	// for ($uu=0;$uu<=2;$uu++){
	//if ($numberxz[$uu]==$mx1){$number5++;}
	//}
	
	//$number5=2;
	
	//}
//	}
		if ($number5>=2){
			$resultList['g_result']=$resultList['g_mingxi_2'];
		}else{$resultList['g_result']='豹';}
			//dump($resultList['g_result']);
					break;
					case '三军' :
						if ($resultList['g_mingxi_2'] == '大' || $resultList['g_mingxi_2'] == '小'){
						  $zonghe=$numberList[0]['g_ball_1']+$numberList[0]['g_ball_2']+$numberList[0]['g_ball_3'];
						  $danzi=$numberList[0]['g_ball_1'].','.$numberList[0]['g_ball_2'].','.$numberList[0]['g_ball_3'];
							$resultList['g_result'] = $this->sum_nnn($zonghe,$danzi);
						}
						else {
						    $danzi=$numberList[0]['g_ball_1'].','.$numberList[0]['g_ball_2'].','.$numberList[0]['g_ball_3'];
							
							$mx1=$resultList['g_mingxi_2'];
							 $numberxz = explode(',', $danzi);
							 $number5=0;
								for ($uu=0;$uu<=2;$uu++){
	if ($numberxz[$uu]==$mx1){$number5++;}
	}
	if ($number5==1){$resultList['g_result']=$resultList['g_mingxi_2'];}else if ($number5==2){$resultList['g_result']='对二';}else if ($number5==3){$resultList['g_result']='对三';}else{$resultList['g_result']='豹';}
							
						}
					//dump($resultList['g_result']);
						break;
				}
			}
		}
		
		else 
		{
			exit('Error');
		}
		return $resultList["g_result"];
	}
	
	function sum_nnn ($index,$iidd)
{
    $ccc = explode(',', $iidd);
	if ($ccc['0']==$ccc['1']&& $ccc[0] == $ccc[2]){
		$num='豹';
	}else{
	
		if ($index>=11)
		{
			$num = '大';
		}else{
			$num = '小';
		}
	}
	return $num;
}
	function sum_ccc ($indes,$iids)
{
    $ccc = explode(',', $indes);
	switch ($iids)
	{
		case 0 :
			if ($ccc['0']==$ccc['1']&& $ccc[0] == $ccc[2]){
				$num='全骰';
			}
			break;
		case 1 :
			if ($ccc['0']==$ccc['1']&& $ccc[0] == $ccc[2]){
				$num=$ccc['0'];
			}
			break;
		case 2 :
			$num=$ccc['0']+$ccc['1']+$ccc['2'];
			break;
	}
	return $num;
}
	
	
}

?>