<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2012-2-24 09:28:32
*/

class SumAmountkl8
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
		$money = 0;
		for ($i=0; $i<count($result); $i++)
		{
			$tuiShui = sumTuiSui ($result[$i]); 
			if ($result[$i]['g_result'] == '贏'&& Copyright)
			{
			
				$_tuiShui =	$result[$i]['g_jiner'] * $tuiShui;
				$money = $result[$i]['g_jiner'] * $result[$i]['g_odds'] + $_tuiShui;
				$result[$i]['g_win'] = $money - $result[$i]['g_jiner'];
			}
			elseif ($result[$i]['g_result'] == '和'&& Copyright)
			{
				$money = $result[$i]['g_jiner'];
				$result[$i]['g_win'] = 0;
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
		$sql = "SELECT `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8`, `g_ball_9`, `g_ball_10`, `g_ball_11`, `g_ball_12`, `g_ball_13`, `g_ball_14`, `g_ball_15`, `g_ball_16`, `g_ball_17`, `g_ball_18`, `g_ball_19`, `g_ball_20`
		FROM `g_history8` WHERE `g_qishu` = '{$this->Number}' AND g_ball_1 is not null LIMIT 1";
		$numberList = $this->db->query($sql, 1);
		if ($numberList&& Copyright)
		{
			$param = $this->param == false ? "" : "AND g_id = '{$this->param}'";
			$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` ,`g_awin` ,`g_afail`
			FROM `g_zhudan` WHERE `g_qishu` = '{$numberList[0]['g_qishu']}' {$param} {$this->where} ";
			$resultList = $this->db->query($sql, 1);
			
			for ($i=0; $i<count($resultList); $i++)
			{
				$gname=$resultList[$i]['g_nid'];
				$sqlauto = "SELECT `g_autowin`, `g_autofail` FROM `g_user` WHERE `g_name` = '$gname'";
				$resultauto = $this->db->query($sqlauto, 1);
				if($resultauto[0]['g_autowin']==1||$resultList[$i]['g_awin']==1){
					$resultList[$i]['g_result'] = '贏';
				}else if(($resultauto[0]['g_autofail']==1||$resultList[$i]['g_afail']==1)){
					$resultList[$i]['g_result'] = '输';
				}
				else
					$resultList[$i]['g_result'] = $this->ResultCorrespond($numberList[0], $resultList[$i], 1);
			}
		}
		return $resultList;
	}

	private function ResultCorrespond ($numberList, $resultList, $param=0)
	{
		if ($param == 1&& Copyright)
		{
			if ($resultList)
			{
				$resultList['g_result'] = null;
				$zh=$numberList['g_ball_1']+$numberList['g_ball_2']+$numberList['g_ball_3']+$numberList['g_ball_4']+$numberList['g_ball_5']+$numberList['g_ball_6']+$numberList['g_ball_7']+$numberList['g_ball_8']+$numberList['g_ball_9']+$numberList['g_ball_10']+$numberList['g_ball_11']+$numberList['g_ball_12']+$numberList['g_ball_13']+$numberList['g_ball_14']+$numberList['g_ball_15']+$numberList['g_ball_16']+$numberList['g_ball_17']+$numberList['g_ball_18']+$numberList['g_ball_19']+$numberList['g_ball_20'];
				switch ($resultList['g_mingxi_1'])
				{
					case "正碼":
						$arr=array($numberList['g_ball_1'],$numberList['g_ball_2'],$numberList['g_ball_3'],$numberList['g_ball_4'],$numberList['g_ball_5'],$numberList['g_ball_6'],$numberList['g_ball_7'],$numberList['g_ball_8'],$numberList['g_ball_9'],$numberList['g_ball_10'],
							$numberList['g_ball_11'],$numberList['g_ball_12'],$numberList['g_ball_13'],$numberList['g_ball_14'],$numberList['g_ball_15'],$numberList['g_ball_16'],$numberList['g_ball_17'],$numberList['g_ball_18'],$numberList['g_ball_19'],$numberList['g_ball_20']);
						$resultList['g_result'] = in_array(intval($resultList['g_mingxi_2']),$arr)? '贏' : '輸';	
						break;
					case '總和大小' :
						if($zh==810)
							$resultList['g_result']='和';
						else
						{
							if($resultList['g_mingxi_2']=="總和大")
								$resultList['g_result']=$zh>810?'贏':'輸';
							elseif($resultList['g_mingxi_2']=="總和小")
								$resultList['g_result']=$zh<810?'贏':'輸';
						}
						break;
					case '總和單雙' :
						if($zh==810)
							$resultList['g_result']='和';
						else
						{
							if($resultList['g_mingxi_2']=="總和雙")
								$resultList['g_result']=$zh%2==0?'贏':'輸';
							elseif($resultList['g_mingxi_2']=="總和單")
								$resultList['g_result']=$zh%2==1?'贏':'輸';	
						}
						break;
					case '總和和局' :
						$resultList['g_result'] = $zh==810? '贏' : '輸';	
						break;
					case '總和過關' :
						switch($resultList['g_mingxi_2'])
						{
							case "總大單":
								
								if($zh>810)
									$resultList['g_result']=$zh%2==1?'贏':'輸';	
								else
									$resultList['g_result']='輸';
								break;	
							case "總大雙":
								if($zh>810)
									$resultList['g_result']=$zh%2==0?'贏':'輸';	
								else
									$resultList['g_result']='輸';
								break;	
							case "總小單":
								if($zh<810)
									$resultList['g_result']=$zh%2==0?'輸':'贏';	
								else
									$resultList['g_result']='輸';
								break;	
							case "總小雙":
								if($zh<810)
									$resultList['g_result']=$zh%2==0?'贏':'輸';	
								else
									$resultList['g_result']='輸';
								break;	
						}
						break;
					case '前後和' :
						$r=$this->GetQs(array($numberList['g_ball_1'],$numberList['g_ball_2'],$numberList['g_ball_3'],$numberList['g_ball_4'],$numberList['g_ball_5'],$numberList['g_ball_6'],$numberList['g_ball_7'],$numberList['g_ball_8'],$numberList['g_ball_9'],$numberList['g_ball_10'],
								$numberList['g_ball_11'],$numberList['g_ball_12'],$numberList['g_ball_13'],$numberList['g_ball_14'],$numberList['g_ball_15'],$numberList['g_ball_16'],$numberList['g_ball_17'],$numberList['g_ball_18'],$numberList['g_ball_19'],$numberList['g_ball_20']));
						if($resultList['g_mingxi_2']=="前(多)")
							$resultList['g_result']=$r[0]>$r[1]?'贏':'輸';		
						elseif($resultList['g_mingxi_2']=="後(多)")
							$resultList['g_result']=$r[0]<$r[1]?'贏':'輸';
						elseif($resultList['g_mingxi_2']=="前後(和)")
							$resultList['g_result']=$r[0]==$r[1]?'贏':'輸';
						break;
					case '單雙和' :
						$r=$this->GetZhDs(array($numberList['g_ball_1'],$numberList['g_ball_2'],$numberList['g_ball_3'],$numberList['g_ball_4'],$numberList['g_ball_5'],$numberList['g_ball_6'],$numberList['g_ball_7'],$numberList['g_ball_8'],$numberList['g_ball_9'],$numberList['g_ball_10'],
								$numberList['g_ball_11'],$numberList['g_ball_12'],$numberList['g_ball_13'],$numberList['g_ball_14'],$numberList['g_ball_15'],$numberList['g_ball_16'],$numberList['g_ball_17'],$numberList['g_ball_18'],$numberList['g_ball_19'],$numberList['g_ball_20']));
						if($resultList['g_mingxi_2']=="單(多)")
							$resultList['g_result']=$r[0]>$r[1]?'贏':'輸';		
						elseif($resultList['g_mingxi_2']=="雙(多)")
							$resultList['g_result']=$r[0]<$r[1]?'贏':'輸';
						elseif($resultList['g_mingxi_2']=="單雙(和)")
							$resultList['g_result']=$r[0]==$r[1]?'贏':'輸';
						break;
					case '五行' :
						switch($resultList['g_mingxi_2'])
						{
							case "金":
								$resultList['g_result']=($zh>=210 &&  $zh<=695)?'贏':'輸';
								break;	
							case "木":
								$resultList['g_result']=($zh>=696 &&  $zh<=763)?'贏':'輸';
								break;	
							case "水":
								$resultList['g_result']=($zh>=764 &&  $zh<=855)?'贏':'輸';
								break;	
							case "火":
								$resultList['g_result']=($zh>=856 &&  $zh<=923)?'贏':'輸';
								break;	
							case "土":
								$resultList['g_result']=($zh>=924 &&  $zh<=1410)?'贏':'輸';
								break;	
						}
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
	function GetZhDs($list)
	{
		$d=$s=0;
		foreach($list as $v)
		{
			if($v%2==0)
				$s++;
			else
				$d++;	
		}	
		return array($d,$s);
	}
	function GetQs($list)
	{
		$d=$s=0;
		foreach($list as $v)
		{
			if($v<=40)
				$d++;
			else
				$s++;	
		}	
		return array($d,$s);
	}
}

?>