<?php
define('Copyright', '作者QQ：506694599');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$db = new DB();
include_once (dirname(__FILE__)."/config.php");
?>
<? header("content-Type: text/html; charset=gb2312");?>
<?php
  // 公共函数定义
  function HexToStr($hex)
  {
     $string="";
     for ($i=0;$i<strlen($hex)-1;$i+=2)
         $string.=chr(hexdec($hex[$i].$hex[$i+1]));
     return $string;
  }

//=========================== 把商家的相关信息返回去 =======================

	$m_id		= 	'';			 //商家号
	$m_orderid	= 	'';			//商家订单号
	$m_oamount	= 	'';			//支付金额
	$m_ocurrency= 	'';			//币种
	$m_language	= 	'';			//语言选择
	$s_name		= 	'';			//消费者姓名
	$s_addr		= 	'';			//消费者住址
	$s_postcode	= 	''; 		//邮政编码
	$s_tel		= 	'';			//消费者联系电话
	$s_eml		= 	'';			//消费者邮件地址
	$r_name		= 	'';			//消费者姓名
	$r_addr		= 	'';			//收货人住址
	$r_postcode	= 	''; 		//收货人邮政编码
	$r_tel		= 	'';			//收货人联系电话
	$r_eml		= 	'';			//收货人电子地址
	$m_ocomment	= 	''; 		//备注
	$modate		=	'';			//返回日期
	$State		=	'';			//支付状态2成功,3失败

	//接收组件的加密
	$OrderInfo	=	$_POST['OrderMessage'];			//订单加密信息

	$signMsg 	=	$_POST['Digest'];				//密匙
	//接收新的md5加密认证


	//$digest = $MD5Digest->encrypt($OrderInfo.$key);
	$digest = strtoupper(md5($OrderInfo.$key));

?>
<?php
	if ($digest == $signMsg)
	{
		//解密
		//$decode = $DES->Descrypt($OrderInfo, $key);
		$OrderInfo = HexToStr($OrderInfo);
		//=========================== 分解字符串 ====================================
		$parm=explode("|", $OrderInfo);

		$m_id		= 	$parm[0];
		$m_orderid	= 	$parm[1];
		$m_oamount	= 	$parm[2];
		$m_ocurrency= 	$parm[3];
		$m_language	= 	$parm[4];
		$s_name		= 	$parm[5];
		$s_addr		= 	$parm[6];
		$s_postcode	= 	$parm[7];
		$s_tel		= 	$parm[8];
		$s_eml		= 	$parm[9];
		$r_name		= 	$parm[10];
		$r_addr		= 	$parm[11];
		$r_postcode	= 	$parm[12];
		$r_tel		= 	$parm[13];
		$r_eml		= 	$parm[14];
		$m_ocomment	= 	$parm[15];
		$modate		=	$parm[16];
		$State		=	$parm[17];

		if ($State == 2)
		{ 
		echo "ok";
		$res=$db->query("select p.g_state,p.g_name,u.g_money_yes from g_qdetail p left join g_user u on p.g_name=u.g_name where p.ordernum='{$m_orderid}'",1);
		 
		if($res[0]['status']=="3"){
			
			$db->query("UPDATE g_qdetail set g_state='自动充值完成', g_type='0' where ordernum='{$m_orderid}'",0);
			$db->query("UPDATE g_user SET g_money_yes=g_money_yes+$m_oamount where g_name='".$res[0]['g_name']."'",0);
		 
		
			$valueList = array();
			$valueList['g_name'] = $res[0]['g_name'];
			$valueList['g_f_name'] = $_SESSION['sName'];
			$valueList['g_initial_value'] = $res[0]['g_money_yes'];
			$valueList['g_up_value'] = $res[0]['g_money_yes']+$m_oamount;
			$valueList['g_up_type'] = '充值';
			$valueList['g_s_id'] = 1;
			insertLogValue($valueList);
		}
				echo "支付成功".'<br>';
				echo "商家号=".$m_id.'<br>';
				echo "订单号=".$m_orderid.'<br>';
				echo "金额=".$m_oamount.'<br>';
				echo ".................";
			}
		else
			{
				echo "支付失败";
			}
?>
<?php
	}else{
?>
	失败，信息可能被篡改
<?php
	}
?>
<!--
对于使用dinpay实时反馈接口的商户请注意：
    为了从根本上解决订单支付成功而商户收不到反馈信息的问题(简称掉单).
我公司决定在信息反馈方面实行服务器端对服务器端的反馈方式.即客户支付过后.
我们系统会对商户的网站进行两次支付信息的反馈(即对同一笔订单信息进行两次反馈).
第一次是服务器端对服务器端的反馈.第二次是以页面的形式反馈.两次反馈的时延差在10秒之内.
    请商户那边做好对我们反馈信息的处理. 对我们系统反馈相同的订单信息您那边只
    做一次处理就可以了.以确保消费者的每一笔订单信息在您那边只得到一次相应的服务!!
-->
