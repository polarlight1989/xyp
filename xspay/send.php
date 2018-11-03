
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pay Page</title>
</head>
<body>

<?php
include "key.php";
	
$version="2.6";		
$serialID= $_GET["orderNumber"];
 
$submitTime=date('YmdHis');
$failureTime=date("YmdHis",strtotime("+1 year"));
$customerIP=$_SERVER["REMOTE_ADDR"];
$totalAmount=$_GET["ordermoney"]*100;
$orderDetails="".$serialID.",".$totalAmount.",商城,在线支付,1";
$types="1000";
$buyerMarked="34234234@qq.com";
$payType="BANK_B2C";
$orgCode=$_GET["cardNo"];
$currencyCode="1";
$directFlag="1";
$borrowingMarked="0";
$couponFlag="1";
$returnUrl="http://".$_SERVER["HTTP_HOST"]."/xspay/receive.php";
$noticeUrl="http://".$_SERVER["HTTP_HOST"]."/xspay/notice.php";
$platformID="";
$remark=  $_SESSION['sName'];
$signType="2";
$charset="1";

		
		$_Md5Signa="version=".$version."&serialID=".$serialID."&submitTime=".$submitTime."&failureTime=".$failureTime."&customerIP=".$customerIP."&orderDetails=".$orderDetails."&totalAmount=".$totalAmount."&type=".$types."&buyerMarked=".$buyerMarked."&payType=".$payType."&orgCode=".$orgCode."&currencyCode=1&directFlag=".$directFlag."&borrowingMarked=0&couponFlag=1&platformID=&returnUrl=".$returnUrl."&noticeUrl=".$noticeUrl."&partnerID=".$partnerID."&remark=".$remark."&charset=1&signType=2&pkey=".$pkey."";
	  // echo $_Md5Signa;
		$signMsg=md5($_Md5Signa);

 
        $def_url  = '<br /><form style="text-align:center;" name="orderForm" id="orderForm" method=post action="https://www.hnapay.com/website/pay.htm"  >';
		
        $def_url .= "<input type=HIDDEN name='version' value='".$version."'>";
        $def_url .= "<input type=HIDDEN name='serialID' value='".$serialID."'>";
        $def_url .= "<input type=HIDDEN name='submitTime' value='".$submitTime."'>";
        $def_url .= "<input type=HIDDEN name='failureTime'  value='".$failureTime."'>";
	    $def_url .= "<input type=HIDDEN name='customerIP'  value='".$customerIP."'>";
        $def_url .= "<input type=HIDDEN name='orderDetails' value='".$orderDetails."'>";
        $def_url .= "<input type=HIDDEN name='totalAmount' value='".$totalAmount."'>";
        $def_url .= "<input type=HIDDEN name='type' value='".$types."'>";
        $def_url .= "<input type=HIDDEN name='buyerMarked' value='".$buyerMarked."'>";
        $def_url .= "<input type=HIDDEN name='payType' value='".$payType."'>";
        $def_url .= "<input type=HIDDEN name='orgCode'  value='".$orgCode."'>";
        $def_url .= "<input type=HIDDEN name='currencyCode'  value='".$currencyCode."'>";
        $def_url .= "<input type=HIDDEN name='directFlag' value='".$directFlag."'>";
        $def_url .= "<input type=HIDDEN name='borrowingMarked' value='".$borrowingMarked."'>";	
        $def_url .= "<input type=HIDDEN name='couponFlag' value='".$couponFlag."'>";
        $def_url .= "<input type=HIDDEN name='platformID' value='".$platformID."'>";
        $def_url .= "<input type=HIDDEN name='returnUrl'  value='".$returnUrl."'>";
        $def_url .= "<input type=HIDDEN name='noticeUrl'  value='".$noticeUrl."'>";
        $def_url .= "<input type=HIDDEN name='partnerID' value='".$partnerID."'>";
        $def_url .= "<input type=HIDDEN name='remark' value='".$remark."'>";	
        $def_url .= "<input type=HIDDEN name='charset' value='".$charset."'>";	
        $def_url .= "<input type=HIDDEN name='signType' value='".$signType."'>";
        $def_url .= "<input type=HIDDEN name='signMsg' value='".$signMsg."'>";

       // $def_url .= "<input type=submit value='" .$GLOBALS['_LANG']['pay_button']. "'>";
        $def_url .= "</form>";

        echo $def_url;
?>
 
 
<script type="text/javascript">

  document.orderForm.submit();

</script>
</body>
</html>