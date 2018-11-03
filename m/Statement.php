<?
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
?><!DOCTYPE html>  
<html>  
<head>  
<title>用戶協議</title>  
<link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.showLoading.min.js" type="text/javascript"></script>
<script src="js/jquery.mobile-1.4.3.js"></script>
<script src="js/Pwd_Safety.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

</head>  
<body>  	
<div data-role="page"> 

	<div data-role="header" data-position="fixed">
		<a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext"></a>
		<h1>用戶協議</h1>
		<a href="Main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse"></a>
	</div> 
	<div data-role="content" class="pm"> 
		<div class="contentNode">
		<div class="box">
			<ul>
				<li><label>1、</label><span>使用本公司網站的客戶，請留意閣下所在的國家或居住地的相關法律規定，如有疑問應就相關問題，尋求當地法律意見。</span></li>
				<li><label>2、</label><span>若發生遭駭客入侵破壞行為或不可抗拒之災害導致網站故障或資料損壞、資料丟失等情況，我們將以本公司之後備資料為最後處理依據；為確保各方利益，請各會員投注後列印資料。本公司不會接受沒有列印資料的投訴。</span></li>
				<li><label>3、</label><span>為避免糾紛，各會員在投注之後，務必進入下注狀況檢查及列印資料。若發現任何異常，請立即與代理商聯繫查證，一切投注將以本公司資料庫的資料為准，不得異議。如出现特殊网络情况或线路不稳定导致不能下注或下注失败。本公司概不负责。</span></li>
				<li><label>4、</label><span>單一注單最高派彩上限為一百萬。</span></li>
				<li><label>5、</label><span>開獎結果以官方公佈的結果為准。</span></li>
				<li><label>6、</label><span>我們將竭力提供準確而可靠的開獎統計等資料，但並不保證資料絕對無誤，統計資料只供參考，並非是對客戶行為的指引，本公司也不接受關於統計數據產生錯誤而引起的相關投訴。</span></li>
				<li><label>7、</label><span>本公司擁有一切判決及註消任何涉嫌以非正常方式下註之權利，在進行更深入調查期間將停止發放與其有關之任何彩金。客戶有責任確保自己的帳戶及密碼保密，如果客戶懷疑自己的資料被盜用，應立即通知本公司，並須更改其個人詳細資料。所有被盜用帳號之損失將由客戶自行負責。在某種特殊情況下，客人之信用額可能會出現透支。</span></li>
				<li style="text-align:right;">"<b class="hong"><?php echo $logo;?></b>"管理層 敬啟　</li>
				<li><label></label><div style="float:left;width:33px;" >
                <input type="checkbox" name="cbxRead" id="cbxRead" value="" checked=checked />
                </div><b class="lan">我瞭解以並同意以上列明的協定和規則。</b></li>
			</ul>
		</div>
		</div> 
	</div>
<? include 'left.php';?>
</div> 
</body> 
</html>  