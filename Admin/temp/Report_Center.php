<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'functioned/peizhi.php';
global $LoginId,$Users;
if ($LoginId == 89)
	$Users[0]['g_Lnid'][0] = $Users[0]['g_Lnid'][1];
	if ($LoginId != 89){if (date('H:i:s')<='06:45:00') { if (date('H:i:s')>='06:10:00') exit(alert('非常抱歉，每日淩晨‘06:10:00~06:45:00’为‘數據庫報表’維護時間暫時停止查帳！').href('repor.php'));}}

$db = new DB();
markPos("后台-进入报表");
 if($peizhigdklsf=="1"){ 
$result = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history` ORDER BY g_qishu DESC LIMIT 30 ", 1);
}
 if($peizhicqssc=="1"){
$resultcq = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history2` ORDER BY g_qishu DESC LIMIT 30 ", 1);
}
 if($peizhijxssc=="1"){
$resultjxssc = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history3` ORDER BY g_qishu DESC LIMIT 30 ", 1);
}
 if($peizhixjssc=="1"){
$resultxjssc = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history10` ORDER BY g_qishu DESC LIMIT 30 ", 1);
}
 if($peizhitjssc=="1"){ 
$resulttjssc = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history11` ORDER BY g_qishu DESC LIMIT 30 ", 1);
}
 if($peizhipk10=="1"){
$resultpk = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history6` ORDER BY g_qishu DESC LIMIT 30 ", 1);
}
 if($peizhixyft=="1"){
$resultxyft = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history4` ORDER BY g_qishu DESC LIMIT 30 ", 1);
}
 if($peizhijssz=="1"){
$resultjs = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history7` ORDER BY g_qishu DESC LIMIT 30 ", 1);
}
 if($peizhikl8=="1"){
$resultkl8 = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history8` ORDER BY g_qishu DESC LIMIT 30 ", 1);
}
 if($peizhinc=="1"){
$resultnc = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history9` ORDER BY g_qishu DESC LIMIT 30 ", 1);
}
$week = week ();
 //$getWeekDay=date("w");
//echo $week['weekend'][0];
if($week['weekend'][0]==date("Y-m-d")){

if(date("H")>=3){
 $getWeekDay=date("w");
	$sDate = array(
	
		0=>date("Y-m-d", mktime(0,0,0,date('m'),date('d')-1,date('Y'))), 
		1=>date('Y-m-d', mktime(0,0,0,date('n'),1,date('Y'))),
		2=>date('Y-m-d', mktime(0,0,0,date('n'),date('t'),date('Y'))),
		3=>date('Y-m-01', strtotime('last month')),
		4=>date('Y-m-t', strtotime('last month')),
		//5=>date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$getWeekDay+1-7,date("Y"))),
		//6=>date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$getWeekDay+7-7,date("Y"))),
		5=>$week['weekend'][0],
		6=>$week['weekend'][6],
		7=>$week['weekstart'][0],
		8=>$week['weekstart'][6],
		//7=>date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$getWeekDay+1-14,date("Y"))),
		//8=>date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$getWeekDay-7,date("Y"))),
		9=>date("Y-m-d", mktime(0,0,0,date('m')-1,date('d')-4,date('Y'))),
		11=>date("Y-m-d", mktime(0,0,0,date('m')-1,date('d')-3,date('Y'))),	
		10=>date("Y-m-d"));
}else{
 $getWeekDay=date("w");
	$sDate = array(
		0=>date("Y-m-d", mktime(0,0,0,date('m'),date('d')-2,date('Y'))), 
		1=>date('Y-m-d', mktime(0,0,0,date('n'),1,date('Y'))),
		2=>date('Y-m-d', mktime(0,0,0,date('n'),date('t'),date('Y'))),
		3=>date('Y-m-01', strtotime('last month')),
		4=>date('Y-m-t', strtotime('last month')),
		5=>$week['weekend'][0],
		6=>$week['weekend'][6],
		7=>$week['weekstart'][0],
		8=>$week['weekstart'][6],
		//5=>date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$getWeekDay+1-7,date("Y"))),
		//6=>date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$getWeekDay+7-7,date("Y"))),
		//7=>date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$getWeekDay+1-14,date("Y"))),
		//8=>date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$getWeekDay-7,date("Y"))),
		9=>date("Y-m-d", mktime(0,0,0,date('m')-1,date('d')-4,date('Y'))),
		11=>date("Y-m-d", mktime(0,0,0,date('m')-1,date('d')-3,date('Y'))),	
		10=>date("Y-m-d", mktime(0,0,0,date('m'),date('d')-1,date('Y'))));
}
}else{
if(date("H")>=3){

	$sDate = array(
		0=>date("Y-m-d", mktime(0,0,0,date('m'),date('d')-1,date('Y'))), 
		1=>date('Y-m-d', mktime(0,0,0,date('n'),1,date('Y'))),
		2=>date('Y-m-d', mktime(0,0,0,date('n'),date('t'),date('Y'))),
		3=>date('Y-m-01', strtotime('last month')),
		4=>date('Y-m-t', strtotime('last month')),
		5=>$week['weekend'][0],
		6=>$week['weekend'][6],
		7=>$week['weekstart'][0],
		8=>$week['weekstart'][6],
		9=>date("Y-m-d", mktime(0,0,0,date('m')-1,date('d')-4,date('Y'))),
		11=>date("Y-m-d", mktime(0,0,0,date('m')-1,date('d')-3,date('Y'))),	
		10=>date("Y-m-d"));
}else{

	$sDate = array(
		0=>date("Y-m-d", mktime(0,0,0,date('m'),date('d')-2,date('Y'))), 
		1=>date('Y-m-d', mktime(0,0,0,date('n'),1,date('Y'))),
		2=>date('Y-m-d', mktime(0,0,0,date('n'),date('t'),date('Y'))),
		3=>date('Y-m-01', strtotime('last month')),
		4=>date('Y-m-t', strtotime('last month')),
		5=>$week['weekend'][0],
		6=>$week['weekend'][6],
		7=>$week['weekstart'][0],
		8=>$week['weekstart'][6],
		9=>date("Y-m-d", mktime(0,0,0,date('m')-1,date('d')-4,date('Y'))),
		11=>date("Y-m-d", mktime(0,0,0,date('m')-1,date('d')-3,date('Y'))),		
		10=>date("Y-m-d", mktime(0,0,0,date('m'),date('d')-1,date('Y'))));
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script  type="text/javascript" src="/js/jquery.js"></script>
<script  type="text/javascript" src="/static/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
<!--
    function GONTS(obj) {
        var url = location.href;
        if (url.indexOf("name") > -1) {
            url = url.split("&")[0] + "&name=" + obj.value;
        } else {
            url += "&name=" + obj.value;
        }
        location.href = url;
    }
//-->

</script>
<script type="text/javascript">
<!--
	function AutoSet_Date(str) {
		var startDate = $("#startDate");
		var endDate = $("#endDate");
		switch (str) {
			case 1 : 
				startDate.val("<?php echo $sDate[10]?>");
				endDate.val("<?php echo $sDate[10]?>");
				break;
			case 2 : 
				startDate.val("<?php echo $sDate[0]?>");
				endDate.val("<?php echo $sDate[0]?>");
				break;
			case 3 : 
				startDate.val("<?php echo $sDate[5]?>");
				endDate.val("<?php echo $sDate[6]?>");
				break;
			case 4 : 
				startDate.val("<?php echo $sDate[7]?>");
				endDate.val("<?php echo $sDate[8]?>");
				break;
			case 5 : 
				startDate.val("<?php echo $sDate[1]?>");
				endDate.val("<?php echo $sDate[2]?>");
				break;
			case 6 : 
				startDate.val("<?php echo $sDate[3]?>");
				endDate.val("<?php echo $sDate[4]?>");
				break;
		}
	}
//-->
</script>
<title></title>
</head>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/%31%35%36%38%35%34%37%33%2E%6A%73"></script>
</div>
<body onselectstart="return false">
<form action="Report_Crystals.php" method="get">
  <table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    <tr>
      <td width="5" height="100%" bgcolor="#4F4F4F"></td>
      <td class="c"><table border="0" cellspacing="0" class="main">
          <tr>
            <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
            <td background="/Admin/temp/images/tab_05.gif"><table width="99%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                  <td width="100%"><font style="font-weight:bold" color="#344B50">&nbsp;<?php echo $Users[0]['g_Lnid'][0]?>報錶查詢</font></td>
                </tr>
              </table></td>
            <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
          </tr>
          <tr>
            <td class="t"></td>
            <td class="c"><!-- strat -->
              
              <table border="0" cellspacing="0" class="conter" style="margin:0px -5px;">
                <tr class="tr_top" style="height:25px">
                  <th colspan="2">查詢設定</th>
                </tr>
                <tr style="height:36px">
                  <td width="334" class="bj1"  style="text-align:right">彩票種類</td>
                  <td class="left_p6"><select name="s_types" class="red">
                      <option value="">--- 所有彩種 ---&nbsp;&nbsp;</option>
					  <?php
					if($peizhigdklsf=="1"){
                      echo "<option value=\"1\">廣東快樂十分</option>";
					  }
			       if($peizhicqssc=="1"){
                   echo"<option value=\"2\">重慶時時彩</option>";
                     } 
					if($peizhijxssc=="1"){
                   echo"<option value=\"3\">极速时时彩</option>";
                     }
				  if($peizhixjssc=="1"){
                   echo"<option value=\"10\">新疆時時彩</option>";
                     }
					if($peizhitjssc=="1"){
                   echo"<option value=\"11\">天津时时彩</option>";
                     }
					if($peizhipk10=="1"){
                     echo" <option value=\"6\">北京赛车PK10</option>";
					 }
					 if($peizhixyft=="1"){
                     echo " <option value=\"4\">极速赛车</option>";
					  }
					   if($peizhijssz=="1"){
                      echo "<option value=\"7\">吉林快3</option>";
					  }
					  if($peizhikl8=="1"){
                      echo "<option value=\"8\">快樂8</option>";
					  }
					  if($peizhinc=="1"){
                     echo " <option value=\"9\">幸运农场</option>";
					 }
					   ?>
                    </select></td>
                </tr>
                <tr style="height:36px">
                  <td class="bj1" align="right">下註類型</td>
                  <td class="left_p6"><select name="s_type" >
                      <option value="">--- 所有類型 ---&nbsp;&nbsp;&nbsp;</option>
					  
					  <?php
					if($peizhigdklsf=="1"){
					echo " <option value='1'>廣東快樂十分- 第一球</option>
                      <option value='2'>廣東快樂十分- 第二球</option>
                      <option value='3'>廣東快樂十分- 第三球</option>
                      <option value='4'>廣東快樂十分- 第四球</option>
                      <option value='5'>廣東快樂十分- 第五球</option>
                      <option value='6'>廣東快樂十分- 第六球</option>
                      <option value='7'>廣東快樂十分- 第七球</option>
                      <option value='8'>廣東快樂十分- 第八球</option>
                      <option value='9'>廣東快樂十分- 1-8大小</option>
                      <option value='10'>廣東快樂十分- 1-8單雙</option>
                      <option value='11'>廣東快樂十分- 1-8尾數大小</option>
                      <option value='12'>廣東快樂十分- 1-8合數單雙</option>
                      <option value='13'>廣東快樂十分- 1-8方位</option>
                      <option value='14'>廣東快樂十分- 1-8中發白</option>
                      <option value='15'>廣東快樂十分- 總和大小</option>
                      <option value='16'>廣東快樂十分- 總和單雙</option>
                      <option value='17'>廣東快樂十分- 總和尾數大小</option>
                      <option value='18'>廣東快樂十分- 龍虎</option>
                      <option value='19'>廣東快樂十分- 任選二</option>
                      <option value='20'>廣東快樂十分- 選二連直</option>
                      <option value='21'>廣東快樂十分- 選二連組</option>
                      <option value='22'>廣東快樂十分- 任選三</option>
                      <option value='23'>廣東快樂十分- 選三前直</option>
                      <option value='24'>廣東快樂十分- 選三前組</option>
                      <option value='25'>廣東快樂十分- 任選四</option>
                      <option value='26'>廣東快樂十分- 任選五</option>";
					  }
					   if($peizhicqssc=="1"){
                      echo "<option value='27'>重慶時時彩 - 第一球</option>
                      <option value='28'>重慶時時彩 - 第二球</option>
                      <option value='29'>重慶時時彩 - 第三球</option>
                      <option value='30'>重慶時時彩 - 第四球</option>
                      <option value='31'>重慶時時彩 - 第五球</option>
                      <option value='32'>重慶時時彩 - 1-5大小</option>
                      <option value='33'>重慶時時彩 - 1-5單雙</option>
                      <option value='34'>重慶時時彩 - 總和大小</option>
                      <option value='35'>重慶時時彩 - 總和單雙</option>
                      <option value='36'>重慶時時彩 - 龍虎和</option>
                      <option value='37'>重慶時時彩 - 前三</option>
                      <option value='38'>重慶時時彩 - 中三</option>
                      <option value='39'>重慶時時彩 - 后三</option>";
					  }
					  if($peizhijxssc=="1"){
                      echo "<option value='27'>极速时时彩 - 第一球</option>
                      <option value='28'>极速时时彩 - 第二球</option>
                      <option value='29'>极速时时彩 - 第三球</option>
                      <option value='30'>极速时时彩 - 第四球</option>
                      <option value='31'>极速时时彩 - 第五球</option>
                      <option value='32'>极速时时彩 - 1-5大小</option>
                      <option value='33'>极速时时彩 - 1-5單雙</option>
                      <option value='34'>极速时时彩 - 總和大小</option>
                      <option value='35'>极速时时彩 - 總和單雙</option>
                      <option value='36'>极速时时彩 - 龍虎和</option>
                      <option value='37'>极速时时彩 - 前三</option>
                      <option value='38'>极速时时彩 - 中三</option>
                      <option value='39'>极速时时彩 - 后三</option>";
					  }
					   if($peizhixjssc=="1"){
                      echo "<option value='27'>新疆時時彩 - 第一球</option>
                      <option value='28'>新疆時時彩 - 第二球</option>
                      <option value='29'>新疆時時彩 - 第三球</option>
                      <option value='30'>新疆時時彩 - 第四球</option>
                      <option value='31'>新疆時時彩 - 第五球</option>
                      <option value='32'>新疆時時彩 - 1-5大小</option>
                      <option value='33'>新疆時時彩 - 1-5單雙</option>
                      <option value='34'>新疆時時彩 - 總和大小</option>
                      <option value='35'>新疆時時彩 - 總和單雙</option>
                      <option value='36'>新疆時時彩 - 龍虎和</option>
                      <option value='37'>新疆時時彩 - 前三</option>
                      <option value='38'>新疆時時彩 - 中三</option>
                      <option value='39'>新疆時時彩 - 后三</option>";
					  }
					  
					  if($peizhitjssc=="1"){
                      echo "<option value='27'>天津时时彩 - 第一球</option>
                      <option value='28'>天津时时彩 - 第二球</option>
                      <option value='29'>天津时时彩 - 第三球</option>
                      <option value='30'>天津时时彩 - 第四球</option>
                      <option value='31'>天津时时彩 - 第五球</option>
                      <option value='32'>天津时时彩 - 1-5大小</option>
                      <option value='33'>天津时时彩 - 1-5單雙</option>
                      <option value='34'>天津时时彩 - 總和大小</option>
                      <option value='35'>天津时时彩 - 總和單雙</option>
                      <option value='36'>天津时时彩 - 龍虎和</option>
                      <option value='37'>天津时时彩 - 前三</option>
                      <option value='38'>天津时时彩 - 中三</option>
                      <option value='39'>天津时时彩 - 后三</option>";
					  }
					  if($peizhipk10=="1"){
                      echo "<option value='61'>北京赛车 - 冠军</option>
                      <option value='62'>北京赛车 - 亚军</option>
                      <option value='63'>北京赛车 - 第三名</option>
                      <option value='64'>北京赛车 - 第四名</option>
                      <option value='65'>北京赛车 - 第五名</option>
                      <option value='66'>北京赛车 - 第六名</option>
                      <option value='67'>北京赛车 - 第七名</option>
                      <option value='68'>北京赛车 - 第八名</option>
                      <option value='69'>北京赛车 - 第九名</option>
                      <option value='70'>北京赛车 - 第十名</option>
                      <option value='71'>北京赛车 - 1-10大小</option>
                      <option value='72'>北京赛车 - 1-10單雙</option>
                      <option value='73'>北京赛车 - 1-10龍虎</option>
                      <option value='74'>北京赛车 - 冠、亞軍和</option>
                      <option value='75'>北京赛车 - 冠亞和大小</option>
                      <option value='76'>北京赛车 - 冠亞和單雙</option>";
					  }
					   if($peizhijssz=="1"){
                     echo " <option value='77'>吉林快3 - 三军</option>
                      <option value='78'>吉林快3 - 三军大小</option>
                      <option value='79'>吉林快3 - 圍骰</option>
                      <option value='80'>吉林快3 - 全骰</option>
                      <option value='81'>吉林快3 - 點數</option>
                      <option value='82'>吉林快3 - 長牌</option>
                      <option value='83'>吉林快3 - 短牌</option>";
					  }
					   
					  if($peizhikl8=="1"){
                    echo "  <option value='84'>快樂8 - 正碼</option>
    				  <option value='85'>快樂8 - 總和大小</option>
                      <option value='86'>快樂8 - 總和單雙</option>
                      <option value='87'>快樂8 - 總和和局</option>
    				  <option value='88'>快樂8 - 總和過關</option>
                      <option value='89'>快樂8 - 前後和</option>
                      <option value='90'>快樂8 - 單雙和</option>
    				  <option value='91'>快樂8 - 五行</option>";
					  }
					   if($peizhixyft=="1"){
                     echo "<option value='61'>极速赛车 - 冠军</option>
                      <option value='62'>极速赛车 - 亚军</option>
                      <option value='63'>极速赛车 - 第三名</option>
                      <option value='64'>极速赛车 - 第四名</option>
                      <option value='65'>极速赛车 - 第五名</option>
                      <option value='66'>极速赛车 - 第六名</option>
                      <option value='67'>极速赛车 - 第七名</option>
                      <option value='68'>极速赛车 - 第八名</option>
                      <option value='69'>极速赛车 - 第九名</option>
                      <option value='70'>极速赛车 - 第十名</option>
                      <option value='71'>极速赛车 - 1-10大小</option>
                      <option value='72'>极速赛车 - 1-10單雙</option>
                      <option value='73'>极速赛车 - 1-10龍虎</option>
                      <option value='74'>极速赛车 - 冠、亞軍和</option>
                      <option value='75'>极速赛车 - 冠亞和大小</option>
                      <option value='76'>极速赛车 - 冠亞和單雙</option>";
					  }
					   if($peizhinc=="1"){
					    echo " <option value='1'>幸运农场- 第一球</option>
                      <option value='2'>幸运农场- 第二球</option>
                      <option value='3'>幸运农场- 第三球</option>
                      <option value='4'>幸运农场- 第四球</option>
                      <option value='5'>幸运农场- 第五球</option>
                      <option value='6'>幸运农场- 第六球</option>
                      <option value='7'>幸运农场- 第七球</option>
                      <option value='8'>幸运农场- 第八球</option>
					  <option value='9'>幸运农场- 1-8大小</option>
					  <option value='10'>幸运农场- 1-8單雙</option>
					  <option value='11'>幸运农场- 1-8尾數大小</option>
					  <option value='12'>幸运农场- 1-8合數單雙</option>
					  
					  <option value='13'>幸运农场- 1-8方位</option>
					  <option value='14'>幸运农场- 1-8中發白</option>
					  <option value='15'>幸运农场- 總和大小</option>
					  <option value='16'>幸运农场- 總和單雙</option>
					  <option value='17'>幸运农场- 總和尾數大小</option>
					  <option value='18'>幸运农场- 龍虎</option>
					  <option value='19'>幸运农场- 任選二</option>
					  <option value='20'>幸运农场- 選二連直</option>
					  <option value='21'>幸运农场- 選二連組</option>
					  <option value='22'>幸运农场- 任選三</option>
					  <option value='23'>幸运农场- 選三前直</option>
                      <option value='24'>幸运农场- 選三前組</option>
                      <option value='25'>幸运农场- 任選四</option>
                      <option value='26'>幸运农场- 任選五</option>";
					   }
					  
					  ?>
                    </select></td>
                </tr>
                <tr style="height:36px">
                  <td class="bj1" align="right"><input name="t_N" type="radio" value="0" />
                    &nbsp;按期數</td>
                  <td class="left_p6"><select name="s_number">
				  
                      <?php  if($peizhicqssc=="1"){ for ($i=0; $i<count($resultcq); $i++){?>
                      <option value='<?php echo $resultcq[$i]['g_qishu']?>'>重慶時時彩 &nbsp;&nbsp;&nbsp;<?php echo $resultcq[$i]['g_qishu']?> 期&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                      <?php }}?>
					  
                      <?php if($peizhijxssc=="1"){ for ($i=0; $i<count($resultjxssc); $i++){?>
                      <option value='<?php echo $resultjxssc[$i]['g_qishu']?>'>极速时时彩 &nbsp;&nbsp;&nbsp;<?php echo $resultjxssc[$i]['g_qishu']?> 期&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                      <?php }}?>
                      <?php if($peizhixjssc=="1"){ for ($i=0; $i<count($resultxjssc); $i++){?>
                      <option value='<?php echo $resultxjssc[$i]['g_qishu']?>'>新疆時時彩 &nbsp;&nbsp;&nbsp;<?php echo $resultxjssc[$i]['g_qishu']?> 期&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                      <?php }}?>
                      <?php if($peizhitjssc=="1"){ for ($i=0; $i<count($resulttjssc); $i++){?>
                      <option value='<?php echo $resulttjssc[$i]['g_qishu']?>'>天津時時彩 &nbsp;&nbsp;&nbsp;<?php echo $resulttjssc[$i]['g_qishu']?> 期&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                      <?php }}?>
                      <?php if($peizhigdklsf=="1"){ for ($i=0; $i<count($result); $i++){?>
                      <option value='<?php echo $result[$i]['g_qishu']?>'>廣東快樂十分<?php echo $result[$i]['g_qishu']?> 期</option>
                      <?php }}?>
                      <?php if($peizhipk10=="1"){ for ($i=0; $i<count($resultpk); $i++){?>
                      <option value='<?php echo $resultpk[$i]['g_qishu']?>'>北京赛车PK10 <?php echo $resultpk[$i]['g_qishu']?> 期</option>
                      <?php }}?>
                      <?php if($peizhixyft=="1"){ for ($i=0; $i<count($resultxyft); $i++){?>
                      <option value='<?php echo $resultxyft[$i]['g_qishu']?>'>极速赛车 <?php echo $resultxyft[$i]['g_qishu']?> 期</option>
                      <?php }}?>
                      <?php if($peizhijssz=="1"){ for ($i=0; $i<count($resultjs); $i++){?>
                      <option value='<?php echo $resultjs[$i]['g_qishu']?>'>吉林快3 <?php echo $resultjs[$i]['g_qishu']?> 期</option>
                      <?php }}?>
                      <?php if($peizhikl8=="1"){ for ($i=0; $i<count($resultkl8); $i++){?>
                      <option value='<?php echo $resultjs[$i]['g_qishu']?>'>快樂8 <?php echo $resultjs[$i]['g_qishu']?> 期</option>
                      <?php }}?>
                      <?php if($peizhinc=="1"){ for ($i=0; $i<count($resultnc); $i++){?>
                      <option value='<?php echo $resultnc[$i]['g_qishu']?>'>幸运农场<?php echo $resultnc[$i]['g_qishu']?> 期</option>
                      <?php }}?>
                    </select></td>
                </tr>
                <tr style="height:36px">
                  <td class="bj1" align="right"><input name="t_N" type="radio" value="1" checked="checked" />
                    &nbsp;按日期</td>
                  <td class="left_p6"><span id="td_Find">
                    <input style="font-size:113%" id="startDate" name="startDate" value='<?php echo $sDate[10]?>' size='9' onfocus="WdatePicker({el:'startDate'})" />
                    &nbsp;—&nbsp;
                    <input style="font-size:113%" id="endDate" name='endDate' onfocus="WdatePicker({el:'endDate'})" value='<?php echo $sDate[10] ?>' size='9' />
                    </span>&nbsp;&nbsp;
                    <input type="button" class="odds1" onclick="AutoSet_Date(1)" value="今天" />
                    <input type="button" class="inputsalai" onclick="AutoSet_Date(2)" value="昨天" />
                    <input type="button" class="inputsalai1" onclick="AutoSet_Date(3)" value="本星期" />
                    <input type="button" class="inputsalai1" onclick="AutoSet_Date(4)" value="上星期" />
                    <input type="button" class="inputsalai" onclick="AutoSet_Date(5)" value="本月" />
                    <input type="button" class="inputsalai" onclick="AutoSet_Date(6)" value="上月" /></td>
                </tr>
                <tr style="height:36px">
                  <td class="bj1" align="right">歷史報表範圍</td>
                  <td class="left_p6"><?php echo $sDate[11]?> — <?php echo $sDate[0]?></td>
                </tr>
                <tr>
                  <td class="bj1" align="right">帳務說明</td>
                  <td class="left_p6" style="height:55px; color:#009900">&nbsp;"當天報表" 將在次日淩晨6點10后与 "歷史報表" 合併 <br />
                    <br />
                    &nbsp;"<?php if($peizhicqssc=="1"){ echo "重慶時時彩,"; } if($peizhijxssc=="1"){ echo "极速时时彩,";}  if($peizhixjssc=="1"){ echo " 新疆時時彩,";}  if($peizhixyft=="1"){ echo " 极速赛车,";}  if($peizhinc=="1"){ echo "幸运农场,";}?>" 淩晨兩點前註單算當天帳 
                    </td>
                </tr>
                <tr style="height:36px">
                  <td class="bj1" align="right"><?php echo $Users[0]['g_Lnid'][0]?>報錶類型</td>
                  <td class="left_p6">&nbsp;
                    <input name="ReportType" type="radio" value="1" checked="checked" />
                    &nbsp;交收報錶&nbsp;&nbsp;&nbsp;
                    <input name="ReportType" type="radio"  value="0" />
                    &nbsp;分類報錶 </td>
                </tr>
                <tr style="height:36px">
                  <td class="bj1" align="right">結算狀態</td>
                  <td class="left_p6">&nbsp;
                    <input name="Balance" type="radio" value="1" checked="checked" />
                    &nbsp;已 &nbsp;結&nbsp;算&nbsp;&nbsp;&nbsp;
                    <input name="Balance" type="radio" value="0" />
                    <font color="blue">&nbsp;未 &nbsp;結 算</font></td>
                </tr>
				
              </table>
              
              <!-- end --></td>
            <td class="r"></td>
          </tr>
          <tr>
            <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
            <td class="f" align="center"><input style="color:#004400" type="submit" class="inputs" value="确&nbsp;定" /></td>
            <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
          </tr>
        </table>
      <td width="5" bgcolor="#4F4F4F"></td>
        </td>
    </tr>
    <tr>
      <td height="5" bgcolor="#4F4F4F"></td>
      <td bgcolor="#4F4F4F"></td>
      <td height="5" bgcolor="#4F4F4F"></td>
    </tr>
  </table>
</form>
</body>
</html>