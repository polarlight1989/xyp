<?php
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';

$filename=$_POST['GD'].".xls";//先定义一个excel文件
dump($filename);
$jibie="總公司";
$db=new DB();

header("Content-Type: application/vnd.ms-execl"); 
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=$filename"); 
header("Pragma: no-cache"); 
header("Expires: 0");

//我们先在excel输出表头，当然这不是必须的
echo iconv("utf-8", "gb2312", "級別")."\t";
echo iconv("utf-8", "gb2312", "下註單號")."\t";
echo iconv("utf-8", "gb2312", "時間")."\t";
echo iconv("utf-8", "gb2312", "期數")."\t";
echo iconv("utf-8", "gb2312", "彩種")."\t";
echo iconv("utf-8", "gb2312", "帳號")."\t";
echo iconv("utf-8", "gb2312", "類型")."\t";
echo iconv("utf-8", "gb2312", "內容")."\t";
echo iconv("utf-8", "gb2312", "賠率")."\t";
echo iconv("utf-8", "gb2312", "金額")."\t";
echo iconv("utf-8", "gb2312", "代理")."\t";
echo iconv("utf-8", "gb2312", "總代理")."\t";
echo iconv("utf-8", "gb2312", "股東")."\t";
echo iconv("utf-8", "gb2312", "分公司")."\t";
echo iconv("utf-8", "gb2312", "總公司")."\n";

$result = $db->query("SELECT `g_id`,`g_date`,`g_qishu`,`g_type`,`g_nid`,`g_mingxi_1`,`g_mingxi_2`,`g_odds`,`g_jiner`,`g_distribution`,`g_distribution_1`,`g_distribution_2`,`g_distribution_3`,`g_distribution_4` FROM `g_zhudan` ORDER BY g_id DESC  ", 1);
for ($i=0; $i<count($result); $i++){

echo iconv("GBK", "gb2312", $jibie)."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_id'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_date'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_qishu'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_type'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_nid'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_mingxi_1'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_mingxi_2'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_odds'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_jiner'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_distribution'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_distribution_1'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_distribution_2'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_distribution_3'])."\t";
echo iconv("GBK", "gb2312", $result[$i]['g_distribution_4'])."\n";

           }

?>