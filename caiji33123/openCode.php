<?php
function pullCode($game){
	global $db,$ConfigModel; 
	#drawTime 开奖时间
	#Num 开奖号码
	#periodsNumber 剩余期数
	#periodsTime 期号
	$drawTime = date("Y-m-dTH:i:s");; 
	$periodsNumber = 10;
	$periodsTime = date("ymdHi",time());
	$result = [];  
	if($game['id'] == 24){#急速时时彩
		$sql = "select * from ".$game['history']." where  1=1 AND g_game_id = 3 AND g_date <= '".date("Y-m-d H:i:s",time())."' AND g_date >= '".date("Y-m-d H:i:s",time()-450)."' AND g_ball_1 is null order by g_date limit 5";
		#echo $sql."\n";
		$waitOpenData = $db->query($sql,1);
		if($waitOpenData) foreach($waitOpenData as $waitOpen){
			$periodsNumber = $waitOpen['g_qishu'];
			$trueNum = [];
			$methCount = 10;
			$nowMoney = 0;
			for($i=0;$i<$methCount;$i++){
				$num = [];
				for($ii=0;$ii<5;$ii++){
					$num[] = rand(0,9);
				}  
				$Amount = new SumAmountjxssc($waitOpen['g_qishu']);
				$money = $Amount->winTest($periodsNumber,$num); 
				if($money < $nowMoney || $nowMoney == 0){
					$nowMoney = $money;
					$trueNum = $num;
				}
			} 

			$num = implode(",",$num);
			$result[] = ['drawTime'=>$drawTime,'Num'=>implode(",",$trueNum),'periodsNumber'=>$periodsNumber,'periodsTime'=>$periodsTime];
			
		} 
		$result = json_encode($result);
		#print_r($result);
		#$periodsNumber = '10791824';
		
		//计算次数  
	}else{
		$gameUrl = [];
		$gameUrl[3] = "http://c.apiplus.net/newly.do?token=t220606d21383787ek&code=cqssc&format=json";//重庆时时彩
		$gameUrl[7] = "http://c.apiplus.net/newly.do?token=t220606d21383787ek&code=jlk3&format=json"; //吉林快3
 		$gameUrl[8] = "http://c.apiplus.net/newly.do?token=t220606d21383787ek&code=bjkl8&format=json"; //北京快乐8
 		$gameUrl[6] = "http://c.apiplus.net/newly.do?token=t220606d21383787ek&code=bjpk10&format=json"; //北京赛车(PK10)
 		$gameUrl[9] = "http://c.apiplus.net/newly.do?token=t220606d21383787ek&code=cqklsf&format=json"; //重庆快乐十分(幸运农场)
 		$gameUrl[1] = "http://c.apiplus.net/newly.do?token=t220606d21383787ek&code=gdklsf&format=json"; //广东快乐十分 
		$url = $gameUrl[$game['id']];
		$result = [];
		$data = file_get_contents($url);
		if($data) $data = @json_decode($data,true);
		if($data['data']){ 
			foreach($data['data'] as $v){
				$drawTime = $v['opentime'];
				$num = $v['opencode'];
				$periodsNumber = $v['expect'];
				$periodsTime = "";
				$result[] = ['drawTime'=>$drawTime,'Num'=>$num,'periodsNumber'=>$periodsNumber,'periodsTime'=>$periodsTime];
			}
		}
		$result = json_encode($result);
	} 
	return json_decode($result);
}