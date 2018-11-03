<?php
	error_reporting(E_ALL^E_WARNING^E_NOTICE);
	include("config.php");
	
         // 订单信息加密函数
        function strToHex($string)
        {
             $hex="";
             for ($i=0;$i<strlen($string);$i++)
                 $hex.=dechex(ord($string[$i]));
             $hex=strtoupper($hex);
             return $hex;
        }

	$m_id		=	$MerId;
	$m_orderid	=	$_REQUEST["orderNumber"];
	$m_oamount	=	$_REQUEST["ordermoney"];
	$m_ocurrency   =     1;
	$m_url		=	$M_URL;
	$m_language	=	1;
	$s_name		=	SSSS;
	$s_addr		=	CN;
	$s_postcode	=	518000;
	$s_tel		=	0755-82384511;
	$s_eml		=	$s_eml;
	$r_name		=	张三;
	$r_addr		=	CN;
	$r_postcode	=	100000;
	$r_tel		=	010-7777777;
	$r_eml		=	$r_eml;
	$m_ocomment	=	1;
	$modate		=	$MODate;
	$m_status	        = 	0;
	$pBank             =     $_REQUEST["cardNo"];
	$g_name          =      $_POST['G_Name'];
	$g_number       =      $_POST['G_Number'];
	$g_count          =      $_POST['G_Count'];
	$g_info             =      $_POST['G_Info'];
	$g_url               =      $_POST['G_Url'];

	//组织订单信息
	$m_info = $m_id."|".$m_orderid."|".$m_oamount."|".$m_ocurrency."|".$m_url."|".$m_language;
	$s_info = $s_name."|".$s_addr."|".$s_postcode."|".$s_tel."|".$s_eml;
	$r_info = $r_name."|".$r_addr."|".$r_postcode."|".$r_tel."|".$r_eml."|".$m_ocomment."|".$m_status."|".$modate;
	$g_message = $g_name."|".$g_number."|".$g_count."|".$g_info."|".$g_url;

	$orderInfo = $m_info."|".$s_info."|".$r_info."|".$g_message;

	//打印组成的信息
	//echo $orderInfo;

	//订单信息加密
	$orderInfo = strToHex($orderInfo);
	//生成签名
	$digest = strtoupper(md5($orderInfo.$key));
?>

<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=gb2312'>
</head>
<body onload='document.dinpayForm.submit();'>
<form name='dinpayForm' method='post' action='https://pay.dinpay.com/PHPReceiveMerchantAction.do'>
	<input type='hidden' name='OrderMessage' value='<?echo $orderInfo?>'>
	<input type='hidden' name='digest' value='<?echo $digest?>'>
	<input type='hidden' name='M_ID' value='<?echo $m_id?>'>
	<input type='hidden' name='P_Bank' value='<?echo $pBank?>' />
</form>
</body>
</html>
