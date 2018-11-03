<?php
define('Copyright', '作者QQ：506694599');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/global.php';
$db = new DB();
include_once (dirname(__FILE__)."/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pay Page</title>
</head>
<body>

	<?php 
	
	include "key.php";
			$orderID = $_REQUEST["orderID"];
			$resultCode = $_REQUEST["resultCode"];
			$stateCode = $_REQUEST["stateCode"];
			$orderAmount = $_REQUEST["orderAmount"];
			$payAmount = $_REQUEST["payAmount"];
			$acquiringTime = $_REQUEST["acquiringTime"];
			$completeTime = $_REQUEST["completeTime"];
			$orderNo = $_REQUEST["orderNo"];
			$partnerID = $_REQUEST["partnerID"];
			$remark = $_REQUEST["remark"];
			$charset = $_REQUEST["charset"];
			$signType = $_REQUEST["signType"];
			$signMsg = $_REQUEST["signMsg"];
			
$src = "orderID=".$orderID
."&resultCode=".$resultCode
."&stateCode=".$stateCode
."&orderAmount=".$orderAmount
."&payAmount=".$payAmount
."&acquiringTime=".$acquiringTime
."&completeTime=".$completeTime
."&orderNo=".$orderNo
."&partnerID=".$partnerID
."&remark=".$remark
."&charset=".$charset
."&signType=".$signType;

			if($_REQUEST["charset"] == 1)
				$charset = "UTF8";


	$src = $src."&pkey=".$pkey;
    $signMsg2=md5($src);


$logName="2222.txt";

 $james=fopen($logName,"a+");
 
   fwrite($james,"\r\n".date("Y-m-d H:i:s")."|".$signMsg2."___".$signMsg."|[".$payAmount."]|[".$orderID."]|[".$remark."]|[".$stateCode."]");
 
 fwrite($james,"\r\n----------------------------------------------------------------------------------------");
fclose($james);



				if($signMsg == $signMsg2)
				
				{
				
				
			if ($stateCode==2)
				
				{	
				
		
	$m_orderid=$orderID;
		 
			$m_oamount=$payAmount;
			
 
  
		$res=$db->query("select p.status,p.g_name,u.g_money_yes,p.g_money from g_qdetail p left join g_user u on p.g_name=u.g_name where p.g_autoc='{$m_orderid}'",1);
		 
		if($res[0]['status']=="3"){
			//$jine = $res[0]['g_money_yes']+$m_oamount;
			$db->query("UPDATE g_user SET g_money_yes=g_money_yes+".$res[0]['g_money']." where g_name='".$res[0]['g_name']."'", 2);
			//echo "1-1";
			$db->query("UPDATE g_qdetail set g_state='自动充值完成', g_type='0',status='1' where g_autoc='".$m_orderid."'", 2);
			//echo "2-2";
		 
		//echo $jine;
			$valueList = array();
			$valueList['g_name'] = $res[0]['g_name'];
			$valueList['g_f_name'] = $remark;
			$valueList['g_initial_value'] = $res[0]['g_money_yes'];
			$valueList['g_up_value'] = $res[0]['g_money_yes']+$m_oamount;
			$valueList['g_up_type'] = '充值';
			$valueList['g_s_id'] = 1;
			insertLogValue($valueList);
		
				echo "支付成功".'<br>';
				echo "商家号=".$m_id.'<br>';
				echo "订单号=".$m_orderid.'<br>';
				echo "金额=".$res[0]['g_money'].'<br>';
				//echo ".................";
				echo "会员：".$res[0]['g_name'];
				/*echo "--";
				echo "hou-".$res[0]['g_money'];
				
 echo "UPDATE g_user SET g_money_yes=g_money_yes+".$res[0]['g_money']." where g_name='".$res[0]['g_name']."'";
  */
		      // echo "UPDATE g_user SET g_money_yes=g_money_yes+".$res[0]['g_money']." where g_name='".$res[0]['g_name']."'";
				}
				}
				else
				{
					
						echo "<Script language=javascript>alert('交易成功,请回首页重新登入');window.open('http://".$_SERVER["HTTP_HOST"]."/','_top')</script>";
				 
					exit;
				}
	 
				
				}
				
				
				else
				{
				echo "md5 pay";
				
				}
 
			
	?>
	
</form>

</body>
</html>
