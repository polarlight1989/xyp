<?
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/peizhi.php';
session_start();

if (isset($_GET['id'])){
	$li = $_GET['id'];
} else {
	$li= is_numeric($_SESSION['cpopen']) ? intval($_SESSION['cpopen']) : 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome</title>
<style>
@CHARSET "UTF-8";
body {
	color: #511E02;
	font-family: Verdana, "宋体", Arial, Sans;
	font-size: 13px;
	  background-color: #ffffff;
}
h2 {
	font-size: 15px;
}

li {
	list-style: none;
	width: 700px;
  margin-top: 8px;
  line-height: 20px;
}

p {
	margin: 0;
}

a {
	color: #2836F4;
	text-decoration: none;
}

a:hover {
	text-decoration: none;
}

.stress {
	  margin-left: 2em; 
}

.title{
	font-weight: bold;
}

.label {
	font-size: 13px;
  color: red;
}

ul{
	margin-top: 25px;
}
</style>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript">function selects($this){
		location.href = "?id="+$this.value;
	}</script>
</head>
<body>
<select id="lt" onChange="selects(this)" style="margin-top:11px;margin-left:14px;">
       <?php if ($peizhigdklsf == "1") {
    if ($li == 1) {
        $lie1 = 'selected="selected"';
    }
    echo " <option  " . $lie1 . " value=\"1\">廣東快樂十分</option>";
} ?>
	<?php
if ($peizhicqssc == "1") {
    if ($li == 2) {
        $lie2 = 'selected="selected"';
    }
    echo "<option " . $lie2 . "  value=\"2\">重慶時時彩</option>";
} ?>
	  <?php
if ($peizhijxssc == "1") {
    if ($li == 3) {
        $lie3 = 'selected="selected"';
    }
    echo "<option " . $lie3 . "  value=\"3\">极速时时彩</option>";
} ?>
	   <?php
if ($peizhixjssc == "1") {
    if ($li == 10) {
        $lie10 = 'selected="selected"';
    }
    echo "<option " . $lie10 . "  value=\"10\">新疆时时彩</option>";
} ?>
	   <?php
if ($peizhitjssc == "1") {
    if ($li == 11) {
        $lie11 = 'selected="selected"';
    }
    echo "  <option " . $lie11 . "  value=\"11\">天津时时彩</option>";
} ?>
		<?php
if ($peizhixyft == "1") {
    if ($li == 4) {
        $lie4 = 'selected="selected"';
    }
    echo " <option " . $lie4 . "  value=\"4\">极速赛车</option>";
} ?>
		<?php
if ($peizhipk10 == "1") {
    if ($li == 6) {
        $lie6 = 'selected="selected"';
    }
    echo " <option " . $lie6 . " value=\"6\">北京赛车PK10</option>";
} ?>
 <?php
if ($peizhinc == "1") {
    if ($li == 9) {
        $lie9 = 'selected="selected"';
    }
    echo "  <option " . $lie9 . "  value=\"9\">幸运农场</option>";
} ?>  
		 <?php
if ($peizhijssz == "1") {
    if ($li == 7) {
        $lie7 = 'selected="selected"';
    }
    echo " <option " . $lie7 . "  value=\"7\">吉林快3</option>";
} ?>
		 <?php
if ($peizhikl8 == "1") {
    if ($li == 8) {
        $lie8 = 'selected="selected"';
    }
    echo "  <option " . $lie8 . "  value=\"8\">快樂8</option>";
} ?>
		      
	</select>
	<h2>重要聲明</h2>
	<ol>
		<li>1.如果客戶懷疑自己的資料被盜用，應立即通知本公司，並更改詳細數據，以前的使用者名稱及密碼將全部無效。</li>
		<li>2.客戶有責任確保自己的賬戶及登入資料的保密性。以使用者名稱及密碼進行的任何網上投註將被視為有效。 </li>
		<li>3.公布賠率時出現的任何打字錯誤或非故意人為失誤，本公司保留改正錯誤和按正確賠率結算投註的權力。您居住所在地的法律有可能規定網絡博弈不合法；若此情況屬實，本公司將不會批準您使用付賬卡進行交易。 </li>
		<li>4.每次登入時客戶都應該核對自己的賬戶結余額。如對余額有任何疑問，請在第壹時間內通知本公司。</li>
		<li>5.壹旦投註被接受，則不得取消或修改。</li>
		<li>6.所有號碼賠率將不時浮動，派彩時的賠率將以確認投註時之賠率為準。</li>
		<li>7.每註最高投註金額按不同[場次]及[投註項目]及[會員賬號]設定浮動。如投註金額超過上述設定，本公司有權取消超過之投註金額。</li>
		<li>8.所有投註都必須在開獎前時間內進行否則投註無效。</li>
		<li>9.所有投註派彩彩金皆含本金。</li>
	</ol>
<? include 'rule'.$li.'.php';?>
</body>
</html>