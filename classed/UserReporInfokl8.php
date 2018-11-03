<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-07 09:28:32
*/
if (!defined('Copyright') && Copyright != 'Sorry, the page wrong path')
exit('Sorry, the page wrong path');
if (!defined('ROOT_PATH'))
exit('invalid request');
class UserReportInfokl8 
{
	private $db;
	private $User;
	private $UserList;
	
	public function __construct($User=null)
	{
		$this->db = new DB();
		if ($User)
			$this->User = $User;
	}
	
	public function GetNumberAll()
	{
		$sql = "SELECT  `g_qishu`, `g_feng_date`, `g_open_date` FROM `g_kaipan8` WHERE g_lock = 2 ORDER BY g_qishu ASC LIMIT 1";
		$result = $this->db->query($sql, 1);
		$a = array(
			'endTime'=>strtotime($result[0]['g_feng_date']) - time(),
			'openTime'=>strtotime($result[0]['g_open_date']) - time(),
			'Phases'=>$result[0]['g_qishu']);
		return $a;
	}
	
	public function GetInfokl8()
	{
		$sql = "SELECT g_qishu FROM g_kaipan8 WHERE g_lock = 2 ORDER BY g_qishu DESC LIMIT 1";
		$number = $this->db->query($sql, 0);
//		dump($number);
		if ($number && Copyright)
		{
			if ($this->User['g_login_id'] !=48 && Copyright){
				$sql = "SELECT * FROM g_zhudan WHERE g_s_nid LIKE '{$this->User['g_nid']}%' 
				AND g_s_nid <> '{$this->User['g_nid']}' 
				AND g_qishu = '{$number[0][0]}' 
				AND g_type = '快樂8' 
				AND g_win is null ";
			} else {
				$sql = "SELECT * FROM g_zhudan WHERE g_s_nid LIKE '{$this->User['g_nid']}%' 
				AND g_mumber_type<>5 
				AND g_qishu = '{$number[0][0]}' 
				AND g_type = '快樂8' 
				AND g_win is null ";
			}
//			dump($sql);
			$result = $this->db->query($sql, 1);
			$sql = "SELECT * FROM g_zhudan WHERE g_qishu='{$number[0][0]}' 
			AND g_s_nid = '{$this->User['g_nid']}' 
			AND g_mumber_type=5 
			AND g_type = '快樂8' 
			AND g_win is null ";
			$this->UserList = $this->db->query($sql, 1);
			//dump($result);
			if ($this->UserList)
				$cc = $this->Results($this->UserList);
			if ($result)
				$c = $this->Results($result);
			if ($c)
			{
				foreach ($c as $a=>$_a)
				{
					foreach ($_a as $aa=>$_aa)
					{
						foreach ($_aa as $aaa=>$_aaa)
						{
							if ($cc)
							{
								foreach ($cc as $b=>$_b)
								{
									if ($b == $a)
									{
										foreach ($_b as $bb=>$_bb)
										{
											foreach ($_bb as $bbb=>$_bbb)
											{
												if ($bb == $aa && $bbb == $aaa)
												{
													$c[$a][$aa][$aaa] = $_aaa-$_bbb;
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			//print_r($cc);exit;
			return $c;
		}
	}
	
	private function Results($result)
	{
		$count = array();
		$c = array();
		$a="";
		
		if(!!$a = $this->IsDetailed($result, '正碼')){
			$c['zm'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '總和大小')){
			$c['zhdx'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '總和單雙')){
			$c['zhds'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '總和和局')){
			$c['zhhj'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '總和過關')){
			$c['gg'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '前後和')){
			$c['zhh'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '單雙和')){
			$c['dsh'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '五行')){
			$c['wx'] = $a;
		}
		return $c;
	}
	private function IsDetailed($result,$typeKey){
		$counts=array();
		$flag=false;
		$allMoney=0;
		for ($i=0; $i<count($result); $i++){
			if ($result[$i]['g_mingxi_1'] == $typeKey){
				$flag=true;
				$list = $this->SumReport($result[$i], $this->User['g_login_id']);
				$money = $list['g_jiner'];
				$smoney = $list['g_jiner'] - ($list['g_jiner'] * $result[$i]['g_odds']+$list['g_tueishui']);
				$allMoney+=$money;
				switch ($result[$i]["g_mingxi_2"]){
					case "總和大":
						$counts['a']['zhdx1'] += $money;
						$counts['b']['zhdx1'] += $smoney;
						break;
					case "總和小":
						$counts['a']['zhdx2'] += $money;
						$counts['b']['zhdx2'] += $smoney;
						break;
					case "總和單":
						$counts['a']['zhds1'] += $money;
						$counts['b']['zhds1'] += $smoney;
						break;
					case "總和雙":
						$counts['a']['zhds2'] += $money;
						$counts['b']['zhds2'] += $smoney;
						break;
					case "總和810":
						$counts['a']['zhhj'] += $money;
						$counts['b']['zhhj'] += $smoney;
						break;
					case "總大單":
						$counts['a']['gg1'] += $money;
						$counts['b']['gg1'] += $smoney;
						break;
					case "總大雙":
						$counts['a']['gg2'] += $money;
						$counts['b']['gg2'] += $smoney;
						break;
					case "總小單":
						$counts['a']['gg3'] += $money;
						$counts['b']['gg3'] += $smoney;
						break;
					case "總小雙":
						$counts['a']['gg4'] += $money;
						$counts['b']['gg4'] += $smoney;
						break;
					case "前(多)":
						$counts['a']['zhh1'] += $money;
						$counts['b']['zhh1'] += $smoney;
						break;
					case "後(多)":
						$counts['a']['zhh2'] += $money;
						$counts['b']['zhh2'] += $smoney;
						break;
					case "前後(和)":
						$counts['a']['zhh3'] += $money;
						$counts['b']['zhh3'] += $smoney;
						break;
					case "單(多)":
						$counts['a']['dsh1'] += $money;
						$counts['b']['dsh1'] += $smoney;
						break;
					case "雙(多)":
						$counts['a']['dsh2'] += $money;
						$counts['b']['dsh2'] += $smoney;
						break;
					case "單雙(和)":
						$counts['a']['dsh3'] += $money;
						$counts['b']['dsh3'] += $smoney;
						break;
					case "金":
						$counts['a']['wx1'] += $money;
						$counts['b']['wx1'] += $smoney;
						break;
					case "木":
						$counts['a']['wx2'] += $money;
						$counts['b']['wx2'] += $smoney;
						break;
					case "水":
						$counts['a']['wx3'] += $money;
						$counts['b']['wx3'] += $smoney;
						break;
					case "火":
						$counts['a']['wx4'] += $money;
						$counts['b']['wx4'] += $smoney;
						break;
					case "土":
						$counts['a']['wx5'] += $money;
						$counts['b']['wx5'] += $smoney;
						break;
					default:
						$counts['a']['zm'.intval($result[$i]["g_mingxi_2"])] += $money;
						$counts['b']['zm'.intval($result[$i]["g_mingxi_2"])] += $smoney;
						break;
				}
			}
		}
		
		if($flag==false){
			return false;
		}else{
			$counts["c"][]=$allMoney;
			return $counts;
		}
	}
	
	
	private function SubCount($result, $type)
	{
		
		return 0;
	}
	
	private function SumPoshMoney($result, $results, $money)
	{
		$a = $money;
		if ($results)
		{
			for ($n=0; $n<count($results); $n++)
			{
				if ($result['g_mingxi_1'] == $results[$n]['g_mingxi_1'] && $result['g_mingxi_2'] == $results[$n]['g_mingxi_2'])
				{
					$c = ((1 - ($results[$n]['g_tueishui']/100))*$results[$n]['g_jiner']);
					$a = $a - $results[$n]['g_jiner'];
				}
			}
		}
		return $a;
	}
	
	private function Sumwin($kCount, $vCount, $p=0)
	{
		$count =$vCount;
		/*foreach ($vCount as $i=>$v)
		{
			if ($p == 0)
			{
				if (($i == 'ah1'||$i == 'ah2'||$i == 'ah3'||$i == 'ah4'||$i == 'ah5'||$i == 'ah6'||$i == 'ah7'||$i == 'ah8'||$i == 'ah9'||$i == 'ah10')&&$v>0)
					$count[$i] = $kCount[0] - $v;
				else if (($i=='ah11'||$i=='ah12')&&$v>0)
					$count[$i] = $kCount[1] - $v;
				else if (($i=='ah13'||$i=='ah14')&&$v>0)
					$count[$i] = $kCount[2] - $v;
			}
			else if ($p == 1)
			{
				if (($i=='bh1'||$i=='bh2')&&$v>0){
					$count[$i] = $kCount[3] - $v;
				}
				else if (($i=='bh3'||$i=='bh4')&&$v>0)
					$count[$i] = $kCount[4] - $v;
				else if (($i=='bh5'||$i=='bh6' || $i=='bh7')&&$v>0)
					$count[$i] = $kCount[5] - $v;
			}
			else 
			{
				if (($i == 'ch1'||$i == 'ch2'||$i == 'ch3'||$i == 'ch4'||$i == 'ch5')&&$v>0)
					$count[$i] = $kCount[6] - $v;
			}
		}*/
		return $count;
	}
	
	private function SumReport($result, $logId)
	{
		$List = array();
		if ($logId == 89 )
		{
			$List['g_tueishui'] = (((100-$result['g_tueishui_4'])/100) * $result['g_jiner']) * ($result['g_distribution_4']/100);
			$List['g_jiner'] = $result['g_jiner'] * ($result['g_distribution_4']/100);
		}
		else if ($logId == 56)
		{
			$a = $result['g_distribution_3'];
			if ($a == 0){
				$List['g_jiner'] =$result['g_jiner'];
				if ($result['g_tueishui_3'] >0 && Copyright)
					$List['g_tueishui'] = (((100-$result['g_tueishui_3'])/100) * $result['g_jiner']);
				else
					$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']);
			}else {
				$List['g_jiner'] =$result['g_jiner'] * ($a/100);
				if ($result['g_tueishui_3'] >0 && Copyright)
					$List['g_tueishui'] = (((100-$result['g_tueishui_3'])/100) * $result['g_jiner']) * ($a/100);
				else
					$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($a/100);
			}
		}
		else if ($logId == 22)
		{
			$a = $result['g_distribution_2'];
			if ($a == 0){
				$List['g_jiner'] =$result['g_jiner'];
				if ($result['g_tueishui_2'] >0 && Copyright)
					$List['g_tueishui'] = (((100-$result['g_tueishui_2'])/100) * $result['g_jiner']);
				else
					$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']);
			}else {
				$List['g_jiner'] =$result['g_jiner'] * ($a/100);
				if ($result['g_tueishui_2'] >0 && Copyright)
					$List['g_tueishui'] = (((100-$result['g_tueishui_2'])/100) * $result['g_jiner']) * ($a/100);
				else
					$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($a/100);
			}
		}
		else if ($logId == 78)
		{
			$a = $result['g_distribution_1'];
			if ($a == 0){
				$List['g_jiner'] =$result['g_jiner'];
				if ($result['g_tueishui_1'] >0 && Copyright)
					$List['g_tueishui'] = (((100-$result['g_tueishui_1'])/100) * $result['g_jiner']);
				else
					$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']);
			}else {
				$List['g_jiner'] =$result['g_jiner'] * ($a/100);
				if ($result['g_tueishui_1'] >0 && Copyright)
					$List['g_tueishui'] = (((100-$result['g_tueishui_1'])/100) * $result['g_jiner']) * ($a/100);
				else
					$List['g_tueishui'] = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($a/100);
			}
		}
		else if ($logId == 48)
		{
			$a = $result['g_distribution'];
			if($a == 0){
				$p = ((100-$result['g_tueishui'])/100) * $result['g_jiner'];
				$c = $result['g_jiner'];
			}else {
				$p = (((100-$result['g_tueishui'])/100) * $result['g_jiner']) * ($a/100);
				$c = $result['g_jiner'] * ($a/100);
			}
			$List['g_tueishui'] = $p;
			$List['g_jiner'] = $c;
		}
		return $List;
	}
}
?>