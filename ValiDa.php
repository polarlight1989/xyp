<?php 
if (!defined('ROOT_PATH'))
exit('invalid request');
if (!defined('Copyright') || Copyright != 'Author QQ: 1234567')
exit('Sorry, the page wrong path');
include_once ROOT_PATH.'functioned/globalge.php';


$sql = "SELECT * FROM `g_user` WHERE `g_name` = '{$loginName}' AND `g_pwd` = 1 LIMIT 1 ";
		$result = $db->query($sql, 1);
		if ($result)
		{
			//判斷帳號是否需要重新设置密码
			alert_href('抱歉！您的帳戶為初次登陸 或 密碼由后台重新設定，為安全起見請設定‘新密碼’。','user/UpPwd_first.php');		
		}else{

$db=new DB();
$text = $db->query("SELECT g_text FROM g_news WHERE g_number_alert_show = 1 ORDER BY g_id DESC LIMIT 1 ", 0);
if ($text){
	$n = strip_tags($text[0][0]);
	alert(trim($n));
}
$sql = "SELECT * FROM `g_user` WHERE `g_name` = '{$loginName}' AND `g_look` = 2 LIMIT 1 ";
		$result = $db->query($sql, 1);
		if ($result)
		{
			//判斷帳號是否需要重新设置密码
			alert($UserOut);		
		}

}

$u=$loginName;
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用戶協議</title>
<link href="css/login1.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="js/Forbid.js" type="text/javascript"></script>

    <script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script src="js/Forbid.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function () {
            $('#Submit').bind("click", function () {
                if ($("#cbxRead").is(':checked')){
                    //window.self.location = 'main.htm'
					document.form1.submit();
                }
                else {
                    alert("請仔細閱讀并選擇協定和規則。");
                }
            });
        });
    </script>
</head>


<body>
<form action="" method="post" name="form1">
 <input type="hidden" name="sid" value="yes" />

<div class="xyBox">
  <div class="top"></div>
  
  <div class="box1">
    <ul>
      <li><span>1、</span>
        <label>使用本公司網站的客戶，請留意閣下所在的國家或居住地的相關法律規定，如有疑問應就相關問題，尋求當地法律意見。</label>
      </li>
      <li><span>2、</span>
        <label>若發生遭駭客入侵破壞行為或不可抗拒之災害導致網站故障或資料損壞、資料丟失等情況，我們將以本公司之後備資料為最後處理依據；為確保各方利益，請各會員投注後列印資料。本公司不會接受沒有列印資料的投訴。</label>
      </li>
      <li><span>3、</span>
        <label>為避免糾紛，各會員在投注之後，務必進入下注狀況檢查及列印資料。若發現任何異常，請立即與代理商聯繫查證，一切投注將以本公司資料庫的資料為准，不得異議。如出现特殊网络情况或线路不稳定导致不能下注或下注失败。本公司概不负责。</label>
      </li>
      <li><span>4、</span>
        <label>單一注單最高派彩上限為一百萬。</label>
      </li>
      <li><span>5、</span>
        <label>開獎結果以官方公佈的結果為准。</label>
      </li>
      <li><span>6、</span>
        <label>我們將竭力提供準確而可靠的開獎統計等資料，但並不保證資料絕對無誤，統計資料只供參考，並非是對客戶行為的指引，本公司也不接受關於統計數據產生錯誤而引起的相關投訴。</label>
      </li>
      <li><span>7、</span>
        <label>本公司擁有一切判決及註消任何涉嫌以非正常方式下註之權利，在進行更深入調查期間將停止發放與其有關之任何彩金。客戶有責任確保自己的帳戶及密碼保密，如果客戶懷疑自己的資料被盜用，應立即通知本公司，並須更改其個人詳細資料。所有被盜用帳號之損失將由客戶自行負責。在某種特殊情況下，客人之信用額可能會出現透支。</label>
      </li>
      <li>&nbsp;</li>
      <li style="text-align:right;">管理層 敬啟　</li>
      <li style="text-align:center;">
        <div style="width:250px;padding:0 125px;">
          <div style="float:left;width:10px;">
            <input id="cbxRead" name="cbxRead" type="checkbox" value="" checked="checked" />
          </div>
          我瞭解以及同意下註列明的協定和規則。</div>
      </li>
    </ul>
    <div class="clear"></div>
  </div>
  <div class="bottom">
    <input id="btnExit" name="btnExit" type="button" class="btn" onMouseOut="this.className='btn'" onMouseOver="this.className='btn_m'" onclick="top.location='/'" />
    <input id="Submit" name="Submit" type="button" class="btn1" onMouseOut="this.className='btn1'" onMouseOver="this.className='btn_m1'" />
  </div>
  <div class="clear"></div>
</div>

</form>
<?

$dbhost                                = "localhost";                 
$dbuser                                = "root";                 
$dbpass                                = "root";                         
$dbname                                = "1188aa";           
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
mysql_query("SET NAMES utf8"); 
mysql_query("SET CHARACTER_SET_CLIENT=utf8"); 
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

$sql = "select * from message where uid='$u' order by id desc";
$result = mysql_db_query($dbname, $sql);
$row=mysql_fetch_array($result);
$m=$row['msg'];
if (strlen($m)>2)
{
echo "<script>alert(\"$m\");</script>";
}
?>
</body>
</html>
