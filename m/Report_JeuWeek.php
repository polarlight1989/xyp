<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
global $user;
if ($user[0]['xtfm']==1){
 exit;
}
markPos("前台-结算报表");

if (date('H:i:s')<='06:45:00') { if (date('H:i:s')>='06:10:00') exit(alert('非常抱歉，每日淩晨‘06:10:00~06:45:00’为‘數據庫報表’維護時間暫時停止查帳！').href('Report_JeuWJS.php'));}
$week = week ();
function setHtml ($week, $str, $user,$type=0)
{
	$date1 = GetWeekDay(date("Y-m-d"), 1);
	$a = 0; $b = 0; $ac = 0; $e = 0; $g = 0;
	foreach ($week as $value) 
	{
		$date2 = GetWeekDay($value, 1);
		$c = explode('-', $value);
		$f = date('H:i:s')<='06:10' ? dayMorning(date("Y-m-d"), (60*60*24), true) : date("Y-m-d");
		if ($f == $value){
			$html = '<td><span>'.$c[1].'-'.$c[2].'</span>&nbsp;&nbsp;'.$date2.'</td>';
		}
		else {
			$html ='<td><span>'.$c[1].'-'.$c[2].'</span>&nbsp;&nbsp;'.$date2.'</td>';
		}
        $date = GetWeekDay($value, 1);
        $result = GetForms($value.' 06:10', dayMorning($value, (60*60*24)).' 06:10', $user[0]['g_name'],$type);
		//alert(count($result));
        $count_bishu = 0; //筆數
        $count_jiner = 0; //下注金額
        $count_win = 0; //輸贏結果
        $count_tueishui = 0; //退水
        $count_win_n = 0; //退水后結果
        for ($i=0; $i<count($result); $i++)
        {
        	$countMoney = sumCountMoney ($user, $result[$i]);
        	$count_bishu += $countMoney['Num'];
        	$count_jiner += $countMoney['Money'];
        	$count_tueishui += $countMoney['TuiShui'];
        	$count_win_n += $countMoney['Win'];
        	$count_win += $result[$i]['g_win'] - $countMoney['TuiShui'];
        }
        if ($count_win_n == 0 && $count_jiner ==0){
        	$count_win_n = '0.0';
        } else {
        	$count_win_n = '<a href="Report_JeuWeekAllList.php?gid='.base64_encode($value).'&dateId='.base64_encode($value).'&type='.$type.'" data-transition="slide">'.is_Number($count_win_n,1).'</a>';
        }
        $a += $count_bishu; 
        $b += $count_jiner; 
        $ac += $count_win; 
        $e += $count_tueishui; 
        $g += ($count_win + $count_tueishui);
        echo '<tr>
			            '.$html.'
			            <td>'.$count_bishu.'</td>
			            <td>'.is_Number($count_jiner).'</td>
			            <td>'.$count_win_n.'</td>
        			  </tr>';
	}
	echo '<tr class="tdBg">
        	<td>'.$str.'</td>
            <td>'.$a.'</td>
            <td>'.number_format($b).'</td>
            <td><span>'.number_format($g,1).'</span></td>
        </tr>';
}
?><!DOCTYPE html>  
<html>  
<head>  
<title>結算報表</title>  
<link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.mobile-1.4.3.js"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
<meta content="telephone=no" name="format-detection" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>  
<body>  	
<div data-role="page" id="dataPageJeuWeek">
<script type="text/javascript" language="javascript">
    function getDataList(FindDate) //快开的明細
    {
        window.location.href = "Report_JeuWeekList.php?FindDate=" + FindDate + "&page=0&r=07180358274202";
    }
    function Zd_Show_All(FindDate) {
        window.location.href = "Report_JeuWeekAllList.php?FindDate=" + FindDate + "&page=0&r=07180358274202";
    }
</script>
	<div data-role="header" data-position="fixed">
		<a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext"></a>
		<h1>結算報表</h1>
        <a href="Main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse"></a>
		</div> 
    <div data-role="content" class="pm">
    
       <table class="tableBox">
        <tr>
          	<th>交易日期</td>
			<th>註單數</td>
            <th>下註金額</td>
           
            <th>實際結果</td>
		</tr>
        <?php
		if(!isset($_GET['type']))
		 echo setHtml($week['weekstart'], '上周', $user);
		 else
		 echo setHtml($week['weekstart'], '上周', $user,$_GET['type']);
		 ?>
    </table>
    <table class="tableBox" style="margin:10px 0 0 0;">

        <tr>
			 <th>交易日期</td>
             <th>註單數</td>
             <th>下註金額</td>
            
             <th>實際結果</td>
		</tr>
      <?php
		if(!isset($_GET['type']))
		 echo setHtml($week['weekend'], '本周', $user);
		 else
		 echo setHtml($week['weekend'], '本周', $user,$_GET['type']);
		 ?>	
    </table>
    </div>
<? include 'footer.php';?>
<? include 'left.php';?>
</div> 
</body> 
</html> 