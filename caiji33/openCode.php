<?php
function pullCode($game){
	global $db,$ConfigModel; 
	#drawTime 开奖时间
	#Num 开奖号码
	#periodsNumber 剩余期数
	#periodsTime 期号
	$debug = false;  
	$drawTime = date("Y-m-dTH:i:s");; 
	$periodsNumber = 10;
	$periodsTime = date("ymdHi",time());
	$result = array(); 
	if($game['id'] == 24){#急速时时彩
		$sql = "select * from ".$game['history']." where  1=1 AND g_game_id = 3 AND g_date <= '".date("Y-m-d H:i:s",time())."' AND g_date >= '".date("Y-m-d H:i:s",time()-450)."' AND g_ball_1 is null order by g_date limit 5";
		//DEBUG
		if($debug){
			$sql = "select * from g_kaipan3 where  1=1   AND g_open_date <= '".date("Y-m-d H:i:s",time())."'  order by g_open_date limit 5"; 
		}
		
		$waitOpenData = $db->query($sql,1);  
		if($waitOpenData) foreach($waitOpenData as $waitOpen){
			$periodsNumber = $waitOpen['g_qishu'];
			$trueNum = array();  
			$methCount = 10;
			$nowMoney = 0;
			if($debug){ 
				$periodsNumber = 10799121;
			}
			for($i=0;$i<$methCount;$i++){
				$num = array();  
				for($ii=0;$ii<5;$ii++){
					$num[] = rand(0,9);
				}
				$Amount = new SumAmountjxssc($waitOpen['g_qishu']);
				$money = $Amount->winTest($periodsNumber,$num,$debug); 
				if($money < $nowMoney || $nowMoney == 0){
					$nowMoney = $money;
					$trueNum = $num;
				}
			}  
			$num = implode(",",$num); 
		}else{
			return false;
		}
		$result[] = array('drawTime'=>$drawTime,'Num'=>implode(",",$trueNum),'periodsNumber'=>$periodsNumber,'periodsTime'=>$periodsTime);

		$result = json_decode(json_encode($result)); 
		return $result;
		#print_r($result);
		#$periodsNumber = '10791824';
		
		//计算次数  
	} 
	return json_decode($result);
}