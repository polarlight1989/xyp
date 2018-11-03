<?php
define('Copyright', 'Sandry, the page wrong path');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
header("Content-type: text/html; charset=utf-8");
include_once ROOT_PATH.'Admin/ExistUser.php';

$date=date("His");

$filename=$date.".xls";//先定义一个excel文件
$GD=$_POST['GD'];//0=空，1=全天，其它另选，
$CQ=$_POST['CQ'];
$JXSSC=$_POST['JXSSC'];
$XJSSC=$_POST['XJSSC'];
$TJSSC=$_POST['TJSSC'];
$BJ=$_POST['BJ'];
$XYFT=$_POST['XYFT'];
$JS=$_POST['JS'];
$KL8=$_POST['KL8'];
$NC=$_POST['NC'];
$member=$_POST['member'];//会员，1=所以，其它另选.北京赛车PK10,重慶時時彩,吉林快3,廣東快樂十分
$vvv=" ";
$vvv1=" ";
$vvv2=" ";
$vvv3=" ";
$vvv5=" ";
if($GD=="0"){
$vvv.="and  g_type<>'廣東快樂十分'  ";
}elseif($GD=="1"){
$vvv.="and  g_type='廣東快樂十分'  ";
}else{
$vvv.="and  g_qishu='{$GD}'  ";
}
if($CQ=="0"){
	$vvv.="and   g_type<>'重慶時時彩'   ";
}elseif($CQ=="1"){
	$vvv.="and   g_type='重慶時時彩'   ";
}else{
	$vvv.="and  g_qishu='{$CQ}' ";
}
if($XJSSC=="0"){
	$vvv.="and   g_type<>'新疆时时彩'   ";
}elseif($XJSSC=="1"){
	$vvv.="and   g_type='新疆时时彩'   ";
}else{
	$vvv.="and  g_qishu='{$XJSSC}' ";
}
if($JXSSC=="0"){
	$vvv.="and   g_type<>'极速时时彩'   ";
}elseif($JXSSC=="1"){
	$vvv.="and   g_type='极速时时彩'   ";
}else{
	$vvv.="and  g_qishu='{$JXSSC}' ";
}
if($TJSSC=="0"){
	$vvv.="and   g_type<>'天津时时彩'   ";
}elseif($TJSSC=="1"){
	$vvv.="and   g_type='天津时时彩'   ";
}else{
	$vvv.="and  g_qishu='{$TJSSC}' ";
}
if($BJ=="0"){
$vvv.="and   g_type<>'北京赛车PK10' ";
}elseif($BJ=="1"){
$vvv.="and   g_type='北京赛车PK10' ";
}else{
$vvv.="and  g_qishu='{$BJ}' ";
}
if($XYFT=="0"){
	$vvv.="and   g_type<>'极速赛车' ";
}elseif($XYFT=="1"){
	$vvv.="and   g_type='极速赛车' ";
}else{
	$vvv.="and  g_qishu='{$XYFT}' ";
}
if($JS=="0"){
	$vvv.="and   g_type<>'吉林快3'   ";
}elseif($JS=="1"){
	$vvv.="and   g_type='吉林快3'   ";
}else{
	$vvv.="and  g_qishu='{$JS}'    ";
}
if($KL8=="0"){
	$vvv.="and   g_type<>'快樂8'   ";
}elseif($KL8=="1"){
	$vvv.="and   g_type='快樂8'   ";
}else{
	$vvv.="and  g_qishu='{$KL8}'    ";
}
if($member=="1"){
$vvv4="";
}else{
$vvv4="and g_nid='{$member}'";
}
if($NC=="0"){
	$vvv.="and   g_type<>'幸运农场' ";
}elseif($NC=="1"){
	$vvv.="and   g_type='幸运农场' ";
}else{
	$vvv.="and  g_qishu='{$NC}' ";
}
//$ss="SELECT * FROM `g_zhudan` WHERE 1=1 {$vvv} {$vvv1}  ORDER BY g_id DESC  ";
//dump($ss);
$db=new DB();

header("Content-Type: application/vnd.ms-execl"); 
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=$filename"); 
header("Pragma: no-cache"); 
header("Expires: 0");

//我们先在excel输出表头，当然这不是必须的
echo iconv("utf-8", "GBK", "下註單號")."\t";
echo iconv("utf-8", "GBK", "時間")."\t";
echo iconv("utf-8", "GBK", "期數")."\t";
echo iconv("utf-8", "GBK", "彩種")."\t";
echo iconv("utf-8", "GBK", "帳號")."\t";
echo iconv("utf-8", "GBK", "類型")."\t";
echo iconv("utf-8", "GBK", "內容")."\t";
echo iconv("utf-8", "GBK", "賠率")."\t";
echo iconv("utf-8", "GBK", "金額")."\t";
echo iconv("utf-8", "GBK", "代理")."\t";
echo iconv("utf-8", "GBK", "總代理")."\t";
echo iconv("utf-8", "GBK", "股東")."\t";
echo iconv("utf-8", "GBK", "分公司")."\t";
echo iconv("utf-8", "GBK", "總公司")."\n";

$result = $db->query("SELECT `g_id`,`g_date`,`g_qishu`,`g_type`,`g_nid`,`g_mingxi_1`,`g_mingxi_2`,`g_odds`,`g_jiner`,`g_distribution`,`g_distribution_1`,`g_distribution_2`,`g_distribution_3`,`g_distribution_4` FROM `g_zhudan` WHERE  1= 1 {$vvv} {$vvv4}  ORDER BY g_id DESC  ", 1);

for ($i=0; $i<count($result); $i++){

echo iconv("utf-8", "GBK", $result[$i]['g_id'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_date'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_qishu'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_type'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_nid'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_mingxi_1'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_mingxi_2'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_odds'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_jiner'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_distribution'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_distribution_1'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_distribution_2'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_distribution_3'])."\t";
echo iconv("utf-8", "GBK", $result[$i]['g_distribution_4'])."\n";

}

?>

