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
class UserReportInfosz 
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
		$sql = "SELECT  `g_qishu`, `g_feng_date`, `g_open_date` FROM `g_kaipan7` WHERE g_lock = 2 ORDER BY g_qishu ASC LIMIT 1";
		$result = $this->db->query($sql, 1);
		$a = array(
			'endTime'=>strtotime($result[0]['g_feng_date']) - time(),
			'openTime'=>strtotime($result[0]['g_open_date']) - time(),
			'Phases'=>$result[0]['g_qishu']);
		return $a;
	}
	
	public function GetInfosz()
	{
		$sql = "SELECT g_qishu FROM g_kaipan7 WHERE g_lock = 2 ORDER BY g_qishu DESC LIMIT 1";
		$number = $this->db->query($sql, 0);
//		dump($number);
		if ($number && Copyright)
		{
			if ($this->User['g_login_id'] !=48 && Copyright){
				$sql = "SELECT * FROM g_zhudan WHERE g_s_nid LIKE '{$this->User['g_nid']}%' 
				AND g_s_nid <> '{$this->User['g_nid']}' 
				AND g_qishu = '{$number[0][0]}' 
				AND g_type = '吉林快3' 
				AND g_win is null ";
			} else {
				$sql = "SELECT * FROM g_zhudan WHERE g_s_nid LIKE '{$this->User['g_nid']}%' 
				AND g_mumber_type<>5 
				AND g_qishu = '{$number[0][0]}' 
				AND g_type = '吉林快3' 
				AND g_win is null ";
			}
//			dump($sql);
			$result = $this->db->query($sql, 1);
			$sql = "SELECT * FROM g_zhudan WHERE g_qishu='{$number[0][0]}' 
			AND g_s_nid = '{$this->User['g_nid']}' 
			AND g_mumber_type=5 
			AND g_type = '吉林快3' 
			AND g_win is null ";
			$this->UserList = $this->db->query($sql, 1);
//			dump($result);
			if ($this->UserList)
				$cc = $this->Results($this->UserList);
			
			if ($result)
				$c = $this->Results($result);
//			dump($c);
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
//		dump($result);
		if(!!$a = $this->IsDetailed($result, '三军')){
			$c['a'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '大小')){
			$c['b'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '圍骰')){
			$c['c'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '點數')){
			$c['d'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '長牌')){
			$c['e'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '短牌')){
			$c['f'] = $a;
		}
		if(!!$a = $this->IsDetailed($result, '全骰')){
			$c['g'] = $a;
		}
		return $c;
	}
	private function IsDetailed($result,$typeKey){
		$counts=array();
		$flag=false;
		$old_typeKey=$typeKey;
		switch ($typeKey){
			case "三军":$h="a";break;
			case "大小":$h="b";$typeKey='三军';break;
			case "圍骰":$h="c";break;
			case "點數":$h="d";break;
			case "長牌":$h="e";break;
			case "短牌":$h="f";break;
			case "全骰":$h="g";$typeKey='圍骰';break;
		}
		$allMoney=0;
		for ($i=0; $i<count($result); $i++){
			if ($result[$i]['g_mingxi_1'] == $typeKey){
				$flag=true;
				$list = $this->SumReport($result[$i], $this->User['g_login_id']);
//				dump($this->User['g_login_id']);
				$money = $list['g_jiner'];
				$smoney = $list['g_jiner'] - ($list['g_jiner'] * $result[$i]['g_odds']+$list['g_tueishui']);
				$allMoney+=$money;
				$type2=$result[$i]["g_mingxi_2"];
				if($old_typeKey=='點數') $type2=$type2-3;
				switch ($type2){
					case "1":
						$counts['a'][$h.'h1'] += $money;
						$counts['b'][$h.'h1'] += $smoney;
						break;
					case "2":
						$counts['a'][$h.'h2'] += $money;
						$counts['b'][$h.'h2'] += $smoney;
						break;
					case "3":
						$counts['a'][$h.'h3'] += $money;
						$counts['b'][$h.'h3'] += $smoney;
						break;
					case "4":
						$counts['a'][$h.'h4'] += $money;
						$counts['b'][$h.'h4'] += $smoney;
						break;
					case "5":
						$counts['a'][$h.'h5'] += $money;
						$counts['b'][$h.'h5'] += $smoney;
						break;
					case "6":
						$counts['a'][$h.'h6'] += $money;
						$counts['b'][$h.'h6'] += $smoney;
						break;
					case "7":
						$counts['a'][$h.'h7'] += $money;
						$counts['b'][$h.'h7'] += $smoney;
						break;
					case "8":
						$counts['a'][$h.'h8'] += $money;
						$counts['b'][$h.'h8'] += $smoney;
						break;
					case "9":
						$counts['a'][$h.'h9'] += $money;
						$counts['b'][$h.'h9'] += $smoney;
						break;
					case "10":
						$counts['a'][$h.'h10'] += $money;
						$counts['b'][$h.'h10'] += $smoney;
						break;
					case "11":
						$counts['a'][$h.'h11'] += $money;
						$counts['b'][$h.'h11'] += $smoney;
						break;
					case "12":
						$counts['a'][$h.'h12'] += $money;
						$counts['b'][$h.'h12'] += $smoney;
						break;
					case "13":
						$counts['a'][$h.'h13'] += $money;
						$counts['b'][$h.'h13'] += $smoney;
						break;
					case "14":
						$counts['a'][$h.'h14'] += $money;
						$counts['b'][$h.'h14'] += $smoney;
						break;
					case "15":
						$counts['a'][$h.'h15'] += $money;
						$counts['b'][$h.'h15'] += $smoney;
						break;
					case "16":
						$counts['a'][$h.'h16'] += $money;
						$counts['b'][$h.'h16'] += $smoney;
						break;
					case "17":
						$counts['a'][$h.'h17'] += $money;
						$counts['b'][$h.'h17'] += $smoney;
						break;
					case "大":
						if($old_typeKey=="大小")
						{
							$counts['a'][$h.'h1'] += $money;
							$counts['b'][$h.'h1'] += $smoney;
						}
						break;
					case "小":
						if($old_typeKey=="大小")
						{
							$counts['a'][$h.'h2'] += $money;
							$counts['b'][$h.'h2'] += $smoney;
						}
						break;
					case "全骰":
						if($old_typeKey=="全骰")
						{
							$counts['a'][$h.'h1'] += $money;
							$counts['b'][$h.'h1'] += $smoney;
						}
						break;
					case "1,2":
						$counts['a'][$h.'h1'] += $money;
						$counts['b'][$h.'h1'] += $smoney;
						break;
					case "1,3":
						$counts['a'][$h.'h2'] += $money;
						$counts['b'][$h.'h2'] += $smoney;
						break;
					case "1,4":
						$counts['a'][$h.'h3'] += $money;
						$counts['b'][$h.'h3'] += $smoney;
						break;
					case "1,5":
						$counts['a'][$h.'h4'] += $money;
						$counts['b'][$h.'h4'] += $smoney;
						break;
					case "1,6":
						$counts['a'][$h.'h5'] += $money;
						$counts['b'][$h.'h5'] += $smoney;
						break;
					case "2,3":
						$counts['a'][$h.'h6'] += $money;
						$counts['b'][$h.'h6'] += $smoney;
						break;
					case "2,4":
						$counts['a'][$h.'h7'] += $money;
						$counts['b'][$h.'h7'] += $smoney;
						break;
					case "2,5":
						$counts['a'][$h.'h8'] += $money;
						$counts['b'][$h.'h8'] += $smoney;
						break;
					case "2,6":
						$counts['a'][$h.'h9'] += $money;
						$counts['b'][$h.'h9'] += $smoney;
						break;
					case "3,4":
						$counts['a'][$h.'h10'] += $money;
						$counts['b'][$h.'h10'] += $smoney;
						break;
					case "3,5":
						$counts['a'][$h.'h11'] += $money;
						$counts['b'][$h.'h11'] += $smoney;
						break;
					case "3,6":
						$counts['a'][$h.'h12'] += $money;
						$counts['b'][$h.'h12'] += $smoney;
						break;
					case "4,6":
						$counts['a'][$h.'h13'] += $money;
						$counts['b'][$h.'h13'] += $smoney;
						break;
					case "4,6":
						$counts['a'][$h.'h14'] += $money;
						$counts['b'][$h.'h14'] += $smoney;
						break;
					case "5,6":
						$counts['a'][$h.'h15'] += $money;
						$counts['b'][$h.'h15'] += $smoney;
						break;
					case "1,2":
						$counts['a'][$h.'h7'] += $money;
						$counts['b'][$h.'h7'] += $smoney;
						break;
				}
//				dump($counts);
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
		$count = array(0=>0, 1=>0, 2=>0, 3=>0, 4=>0, 5=>0);
		for ($i=0; $i<count($result); $i++)
		{
			if ($result[$i]['g_mingxi_1'] == $type)
			{
				$list = $this->SumReport($result[$i], $this->User['g_login_id']);
				$money = $list['g_jiner'];
				if ($result[$i]['g_mingxi_2'] == '一点' || $result[$i]['g_mingxi_2'] == '二点'|| $result[$i]['g_mingxi_2'] == '三点'|| $result[$i]['g_mingxi_2'] == '四点'|| $result[$i]['g_mingxi_2'] == '五点'|| $result[$i]['g_mingxi_2'] == '六点')
				{
					$count[0] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '大' || $result[$i]['g_mingxi_2'] == '小')
				{
					$count[1] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '單' || $result[$i]['g_mingxi_2'] == '雙')
				{
					$count[2] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '總和大' || $result[$i]['g_mingxi_2'] == '總和小')
				{
					$count[3] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '總和單' || $result[$i]['g_mingxi_2'] == '總和雙')
				{
					$count[4] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '龍' || $result[$i]['g_mingxi_2'] == '虎' || $result[$i]['g_mingxi_2'] == '和')
				{
					$count[5] += $money;
				}
				else if ($result[$i]['g_mingxi_2'] == '豹子' || $result[$i]['g_mingxi_2'] == '順子' || $result[$i]['g_mingxi_2'] == '對子' || $result[$i]['g_mingxi_2'] == '半順' || $result[$i]['g_mingxi_2'] == '雜六')
				{
					$count[6] += $money;
				}
			}
		}
		return $count;
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
		foreach ($vCount as $i=>$v)
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
		}
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