<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
include_once ROOT_PATH.'functioned/peizhi.php';
global $ConfigModel,$Users;
$db=new DB();
if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_1'])){
	if ($Users[0]['g_lock_1_1'] !=1) 
		exit(back('您的權限不足！'));
}
$typeid=is_numeric($_REQUEST['type']) ? $_REQUEST['type'] : 1;
$arr_slt = array();
if ($typeid == 2){

	//加載重慶
	$type = "重慶时时彩";
	$sql="select * from g_odds2_b";
	$result=$db->query($sql, 1);
	$sql1="select * from g_odds2_c";
	$result1=$db->query($sql1, 1);
  	$arr_slt[2] = " selected";
} else if($typeid == 3){
	$type = "极速时时彩";
	$sql="select * from g_odds{$typeid}_b";
	$result=$db->query($sql, 1);
	$sql1="select * from g_odds{$typeid}_c";
	$result1=$db->query($sql1, 1);
  	$arr_slt[3] = " selected";
} else if($typeid == 10){
	$type = "新疆时时彩";
	$sql="select * from g_odds{$typeid}_b";
	$result=$db->query($sql, 1);
	$sql1="select * from g_odds{$typeid}_c";
	$result1=$db->query($sql1, 1);
  	$arr_slt[10] = " selected";
} else if($typeid == 11){
	$type = "天津时时彩";
	$sql="select * from g_odds{$typeid}_b";
	$result=$db->query($sql, 1);
	$sql1="select * from g_odds{$typeid}_c";
	$result1=$db->query($sql1, 1);
  	$arr_slt[11] = " selected";
} else if($typeid == 6){
	//加載北京赛车
	$type = "北京赛车PK10";
	$sql="select * from g_odds6_b";
	$result=$db->query($sql, 1);
	$sql1="select * from g_odds6_c";
	$result1=$db->query($sql1, 1);
  $arr_slt[6] = " selected";
} else if($typeid == 4){
	$type = "极速赛车";
	$sql="select * from g_odds{$typeid}_b";
	$result=$db->query($sql, 1);
	$sql1="select * from g_odds{$typeid}_c";
	$result1=$db->query($sql1, 1);
  	$arr_slt[4] = " selected";
}else if($typeid == 7){
	//加載北京赛车
	$type = "吉林快3";
	$sql="select * from g_odds7_b";
	$result=$db->query($sql, 1);
	$sql1="select * from g_odds7_c";
	$result1=$db->query($sql1, 1);
  $arr_slt[7] = " selected";
}else if($typeid == 8){
	//快樂8
	$type = "快樂8";
	$sql="select * from g_odds8_b";
	$result=$db->query($sql, 1);
	$sql1="select * from g_odds8_c";
	$result1=$db->query($sql1, 1);
  	$arr_slt[8] = " selected";
} else if($typeid == 9){
	$type = "幸运农场";
	$sql="select * from g_odds{$typeid}_b";
	$result=$db->query($sql, 1);
	$sql1="select * from g_odds{$typeid}_c";
	$result1=$db->query($sql1, 1);
  	$arr_slt[9] = " selected";
}else{
	$type="廣東快樂十分";
	$sql="select * from g_odds_b";
	$result=$db->query($sql, 1);
	$sql1="select * from g_odds_c";
	$result1=$db->query($sql1, 1);
  $arr_slt[1] = " selected";
}
markPos("后台-盘差-{$type}");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
if ($typeid == 2 || $typeid == 3 || $typeid == 10 || $typeid == 11){

$panB=$_POST['cqygb'];
for($i=0;$i<count($panB);$i++){
if($panB[$i]=="")
exit(back($panB[$i].'赔率不能为空！'));
if (!Matchs::isFloating($panB[$i], 1, 8)) exit(back($panB[$i].'赔率应为数字！'));
}
$sql="update g_odds{$typeid}_b set h1=$panB[0],h2=$panB[1],h3=$panB[2],h4=$panB[3],h5=$panB[4],h6=$panB[5],h7=$panB[6],h8=$panB[7],h9=$panB[8],h10=$panB[9],h11=$panB[10],h12=$panB[11],h13=$panB[12]";
$db->query($sql, 2);

$panC=$_POST['cqygc'];
for($i=0;$i<count($panC);$i++){
if($panC[$i]=="")
exit(back($panC[$i].'赔率不能为空！'));
if (!Matchs::isFloating($panC[$i], 1, 8)) exit(back($panC[$i].'赔率应为数字！'));
}
$sql="update g_odds{$typeid}_c set h1=$panC[0],h2=$panC[1],h3=$panC[2],h4=$panC[3],h5=$panC[4],h6=$panC[5],h7=$panC[6],h8=$panC[7],h9=$panC[8],h10=$panC[9],h11=$panC[10],h12=$panC[11],h13=$panC[12]";
$db->query($sql, 2);
exit(alert_href('更變成功', 'OddsBC.php'));
}else if($typeid == 7){
	$panB=$_POST['jsb'];
	for($i=0;$i<count($panB);$i++){
		if($panB[$i]=="")
			exit(back($panB[$i].'赔率不能为空！'));
		if (!Matchs::isFloating($panB[$i], 1, 8)) exit(back($panB[$i].'赔率应为数字！'));
	}
	$sql="update g_odds7_b set h1=$panB[0],h2=$panB[1],h3=$panB[2],h4=$panB[3],h5=$panB[4],h6=$panB[5]";
	$db->query($sql, 2);

	$panC=$_POST['jsc'];
	for($i=0;$i<count($panC);$i++){
		if($panC[$i]=="")
			exit(back($panC[$i].'赔率不能为空！'));
		if (!Matchs::isFloating($panC[$i], 1, 8)) exit(back($panC[$i].'赔率应为数字！'));
	}
	$sql="update g_odds7_c set h1=$panC[0],h2=$panC[1],h3=$panC[2],h4=$panC[3],h5=$panC[4],h6=$panC[5]";
	$db->query($sql, 2);
	exit(alert_href('更變成功', 'OddsBC.php'));
}else if($typeid == 6 || $typeid == 4){
	$panB=$_POST['pkygb'];
	for($i=0;$i<count($panB);$i++){
		if($panB[$i]=="")
		exit(back($panB[$i].'赔率不能为空！'));
		if (!Matchs::isFloating($panB[$i], 1, 8)) exit(back($panB[$i].'赔率应为数字！'));
	}
	$sql="update g_odds{$typeid}_b set h1=$panB[0],h2=$panB[1],h3=$panB[2],h4=$panB[3],h5=$panB[4],h6=$panB[5],h7=$panB[6],h8=$panB[7],h9=$panB[8],h10=$panB[9],h11=$panB[10],h12=$panB[11],h13=$panB[12],h14=$panB[13],h15=$panB[14],h16=$panB[15]";
	$db->query($sql, 2);

	$panC=$_POST['pkygc'];
	for($i=0;$i<count($panC);$i++){
		if($panC[$i]=="")
			exit(back($panC[$i].'赔率不能为空！'));
		if (!Matchs::isFloating($panC[$i], 1, 8)) exit(back($panC[$i].'赔率应为数字！'));
	}
	$sql="update g_odds{$typeid}_c set h1=$panC[0],h2=$panC[1],h3=$panC[2],h4=$panC[3],h5=$panC[4],h6=$panC[5],h7=$panC[6],h8=$panC[7],h9=$panC[8],h10=$panC[9],h11=$panC[10],h12=$panC[11],h13=$panC[12],h14=$panC[13],h15=$panC[14],h16=$panC[15]";
	$db->query($sql, 2);
	exit(alert_href('更變成功', 'OddsBC.php'));
}else if($typeid == 8){
	$panB=$_POST['kl8b'];
	for($i=0;$i<count($panB);$i++){
		if($panB[$i]=="")
		exit(back($panB[$i].'赔率不能为空！'));
		if (!Matchs::isFloating($panB[$i], 1, 8)) exit(back($panB[$i].'赔率应为数字！'));
	}
	$sql="update g_odds8_b set h1=$panB[0],h2=$panB[1],h3=$panB[2],h4=$panB[3],h5=$panB[4],h6=$panB[5],h7=$panB[6],h8=$panB[7]";
	$db->query($sql, 2);

	$panC=$_POST['kl8c'];
	for($i=0;$i<count($panC);$i++){
		if($panC[$i]=="")
			exit(back($panC[$i].'赔率不能为空！'));
		if (!Matchs::isFloating($panC[$i], 1, 8)) exit(back($panC[$i].'赔率应为数字！'));
	}
	$sql="update g_odds8_c set h1=$panC[0],h2=$panC[1],h3=$panC[2],h4=$panC[3],h5=$panC[4],h6=$panC[5],h7=$panC[6],h8=$panC[7]";
	$db->query($sql, 2);
	exit(alert_href('更變成功', 'OddsBC.php'));
}else if($typeid == 9){
	$panB=$_POST['ygb'];
	for($i=0;$i<count($panB);$i++){
		if($panB[$i]=="")
			exit(back($panB[$i].'赔率不能为空！'));
			if (!Matchs::isFloating($panB[$i], 1, 8)) exit(back($panB[$i].'赔率应为数字！'));
		}
		$sql="update g_odds{$typeid}_b set h1=$panB[0],h2=$panB[1],h3=$panB[2],h4=$panB[3],h5=$panB[4],h6=$panB[5],h7=$panB[6],h8=$panB[7],h21=$panB[8],h23=$panB[9],h25=$panB[10],h27=$panB[11],h29=$panB[12],h33=$panB[13],h34=$panB[14],h35=$panB[15],h36=$panB[16],h37=$panB[17],h38=$panB[18],h39=$panB[19],h40=$panB[20],h41=$panB[21],h42=$panB[22],h43=$panB[23],h44=$panB[24],h45=$panB[25]";
		$db->query($sql, 2);
		
		$panC=$_POST['ygc'];
		for($i=0;$i<count($panC);$i++){
			if($panC[$i]=="")
			exit(back($panC[$i].'赔率不能为空！'));
			if (!Matchs::isFloating($panC[$i], 1, 8)) exit(back($panC[$i].'赔率应为数字！'));
		}
		$sql="update g_odds{$typeid}_c set h1=$panC[0],h2=$panC[1],h3=$panC[2],h4=$panC[3],h5=$panC[4],h6=$panC[5],h7=$panC[6],h8=$panC[7],h21=$panC[8],h23=$panC[9],h25=$panC[10],h27=$panC[11],h29=$panC[12],h33=$panC[13],h34=$panC[14],h35=$panC[15],h36=$panC[16],h37=$panC[17],h38=$panC[18],h39=$panC[19],h40=$panC[20],h41=$panC[21],h42=$panC[22],h43=$panC[23],h44=$panC[24],h45=$panC[25]";
		$db->query($sql, 2);
		exit(alert_href('更變成功', 'OddsBC.php'));	
}else{
	$panB=$_POST['ygb'];
	for($i=0;$i<count($panB);$i++){
		if($panB[$i]=="")
			exit(back($panB[$i].'赔率不能为空！'));
			if (!Matchs::isFloating($panB[$i], 1, 8)) exit(back($panB[$i].'赔率应为数字！'));
		}
		$sql="update g_odds_b set h1=$panB[0],h2=$panB[1],h3=$panB[2],h4=$panB[3],h5=$panB[4],h6=$panB[5],h7=$panB[6],h8=$panB[7],h21=$panB[8],h23=$panB[9],h25=$panB[10],h27=$panB[11],h29=$panB[12],h33=$panB[13],h34=$panB[14],h35=$panB[15],h36=$panB[16],h37=$panB[17],h38=$panB[18],h39=$panB[19],h40=$panB[20],h41=$panB[21],h42=$panB[22],h43=$panB[23],h44=$panB[24],h45=$panB[25]";
		$db->query($sql, 2);
		
		$panC=$_POST['ygc'];
		for($i=0;$i<count($panC);$i++){
			if($panC[$i]=="")
			exit(back($panC[$i].'赔率不能为空！'));
			if (!Matchs::isFloating($panC[$i], 1, 8)) exit(back($panC[$i].'赔率应为数字！'));
		}
		$sql="update g_odds_c set h1=$panC[0],h2=$panC[1],h3=$panC[2],h4=$panC[3],h5=$panC[4],h6=$panC[5],h7=$panC[6],h8=$panC[7],h21=$panC[8],h23=$panC[9],h25=$panC[10],h27=$panC[11],h29=$panC[12],h33=$panC[13],h34=$panC[14],h35=$panC[15],h36=$panC[16],h37=$panC[17],h38=$panC[18],h39=$panC[19],h40=$panC[20],h41=$panC[21],h42=$panC[22],h43=$panC[23],h44=$panC[24],h45=$panC[25]";
		$db->query($sql, 2);
		exit(alert_href('更變成功', 'OddsBC.php'));
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<title></title>
</head>
<body>
<form action="" method="post" onsubmit="">
	<input type="hidden" name="type" value="<?=$typeid?>">
  <table width="100%" height="99.3%" border="0" cellspacing="0" class="a oddsbox">
    <tr>
      <td width="5" height="100%" bgcolor="#4F4F4F"></td>
      <td class="c"><table border="0" cellspacing="0" class="main">
          <tr>
            <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
            <td background="/Admin/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                  <td width="99%"><font style="font-weight:bold" color="#344B50">&nbsp;B C盘赔率差設置</font></td>
                  <td align="right"><select class="font_B" onchange="SetOddsBC(this);">
				  <?php
				   if($peizhigdklsf=="1"){
                  echo "<option style=\"color:Blue\" value=\"1\" ".$arr_slt[1].">廣東快樂十分</option>";
				  }
				   if($peizhicqssc=="1"){
                    echo "<option style=\"color:Blue\" value=\"2\" ".$arr_slt[2].">重慶時時彩</option>";
					}
					 if($peizhijxssc=="1"){
                    echo "<option style=\"color:Blue\" value=\"3\" ".$arr_slt[3].">极速时时彩</option>";
					}
					 if($peizhixjssc=="1"){
	                echo "<option style=\"color:Blue\" value=\"10\" ".$arr_slt[10].">新疆时时彩</option>";
					}
					 if($peizhitjssc=="1"){
	                echo "<option style=\"color:Blue\" value=\"11\" ".$arr_slt[11].">天津时时彩</option>";
					}
					 if($peizhipk10=="1"){
                    echo "<option style=\"color:Blue\" value=\"6\" ".$arr_slt[6].">北京赛车PK10</option>";
					}
					 if($peizhixyft=="1"){
                     echo "<option style=\"color:Blue\" value=\"4\" ".$arr_slt[4].">极速赛车</option>";
					 }
					  if($peizhijssz=="1"){
                      echo "<option style=\"color:Blue\" value=\"7\" ".$arr_slt[7].">吉林快3</option>";
					  }
					   if($peizhikl8=="1"){
                      echo "<option style=\"color:Blue\" value=\"8\" ".$arr_slt[8].">快樂8</option>";
					  }
					   if($peizhinc=="1"){
                      echo "<option style=\"color:Blue\" value=\"9\" ".$arr_slt[9].">幸运农场</option>";
					  }
					  ?>
                    </select></td>
                </tr>
              </table></td>
            <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
          </tr>
          <tr>
            <td class="t"></td>
            <td class="c"><!-- strat -->
              
              <table border="0" cellspacing="0" class="conter">
                <tr class="tr_top">
                  <td><?php echo $type;?></td>
                  <td>B盘</td>
                  <td>C盘</td>
                </tr>
                <?php if ($typeid == 2 || $typeid == 3 || $typeid == 10 || $typeid == 11){?>
                <tr style="height:28px">
                  <td class="bj2">第一球</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h1']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h1']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第二球</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h2']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h2']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第三球</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h3']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h3']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第四球</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h4']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h4']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第五球</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h5']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h5']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-5球大小</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h6']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h6']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-5球單雙</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h7']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h7']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-5球總和大小</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h8']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h8']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-5球總和單雙</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h9']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h9']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-5球龍虎和</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h10']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h10']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">前三</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h11']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h11']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">中三</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h12']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h12']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">後三</td>
                  <td align="center"><input name="cqygb[]" class="textc" id="cqygb[]" size="10" value="<?php echo $result[0]['h13']?>"/></td>
                  <td align="center"><input name="cqygc[]" class="textc" id="cqygc[]" size="10" value="<?php echo $result1[0]['h13']?>"/></td>
                </tr>
                <?php }else  if ($typeid == 7){
      ?>
                <tr style="height:28px">
                  <td class="bj2" >三军</td>
                  <td align="center"><input name="jsb[]" class="textc" id="jsb[]" size="10" value="<?php echo $result[0]['h1']?>"/></td>
                  <td align="center"><input name="jsc[]" class="textc" id="jsc[]" size="10" value="<?php echo $result1[0]['h1']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">三军-大小</td>
                  <td align="center"><input name="jsb[]" class="textc" id="jsb[]" size="10" value="<?php echo $result[0]['h2']?>"/></td>
                  <td align="center"><input name="jsc[]" class="textc" id="jsc[]" size="10" value="<?php echo $result1[0]['h2']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">圍骰,全骰</td>
                  <td align="center"><input name="jsb[]" class="textc" id="jsb[]" size="10" value="<?php echo $result[0]['h3']?>"/></td>
                  <td align="center"><input name="jsc[]" class="textc" id="jsc[]" size="10" value="<?php echo $result1[0]['h3']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">點數</td>
                  <td align="center"><input name="jsb[]" class="textc" id="jsb[]" size="10" value="<?php echo $result[0]['h4']?>"/></td>
                  <td align="center"><input name="jsc[]" class="textc" id="jsc[]" size="10" value="<?php echo $result1[0]['h4']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">長牌</td>
                  <td align="center"><input name="jsb[]" class="textc" id="jsb[]" size="10" value="<?php echo $result[0]['h5']?>"/></td>
                  <td align="center"><input name="jsc[]" class="textc" id="jsc[]" size="10" value="<?php echo $result1[0]['h5']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">短牌</td>
                  <td align="center"><input name="jsb[]" class="textc" id="jsb[]" size="10" value="<?php echo $result[0]['h6']?>"/></td>
                  <td align="center"><input name="jsc[]" class="textc" id="jsc[]" size="10" value="<?php echo $result1[0]['h6']?>"/></td>
                </tr>
                <?php
      }else  if ($typeid == 6 || $typeid == 4){
      ?>
                <tr style="height:28px">
                  <td class="bj2" >冠军</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h1']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h1']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">亚军</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h2']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h2']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第三名</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h3']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h3']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第四名</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h4']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h4']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第五名</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h5']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h5']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第六名</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h6']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h6']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第七名</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h7']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h7']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第八名</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h8']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h8']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第九名</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h9']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h9']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第十名</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h10']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h10']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-10名大小</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h11']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h11']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-10名單雙</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h12']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h12']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-5名龍虎</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h13']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h13']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">冠、亞軍和指定</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h14']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h14']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">冠、亞軍和大小</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h15']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h15']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">冠、亞軍和雙單</td>
                  <td align="center"><input name="pkygb[]" class="textc" id="pkygb[]" size="10" value="<?php echo $result[0]['h16']?>"/></td>
                  <td align="center"><input name="pkygc[]" class="textc" id="pkygc[]" size="10" value="<?php echo $result1[0]['h16']?>"/></td>
                </tr>
                 <?php }else  if ($typeid == 8){
      			?>
                <tr style="height:28px">
                  <td class="bj2" >正碼</td>
                  <td align="center"><input name="kl8b[]" class="textc" id="kl8b[]" size="10" value="<?php echo $result[0]['h1']?>"/></td>
                  <td align="center"><input name="kl8c[]" class="textc" id="kl8c[]" size="10" value="<?php echo $result1[0]['h1']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">總和大小</td>
                  <td align="center"><input name="kl8b[]" class="textc" id="kl8b[]" size="10" value="<?php echo $result[0]['h2']?>"/></td>
                  <td align="center"><input name="kl8c[]" class="textc" id="kl8c[]" size="10" value="<?php echo $result1[0]['h2']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">總和單雙</td>
                  <td align="center"><input name="kl8b[]" class="textc" id="kl8b[]" size="10" value="<?php echo $result[0]['h3']?>"/></td>
                  <td align="center"><input name="kl8c[]" class="textc" id="kl8c[]" size="10" value="<?php echo $result1[0]['h3']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">總和和局</td>
                  <td align="center"><input name="kl8b[]" class="textc" id="kl8b[]" size="10" value="<?php echo $result[0]['h4']?>"/></td>
                  <td align="center"><input name="kl8c[]" class="textc" id="kl8c[]" size="10" value="<?php echo $result1[0]['h4']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">總和過關</td>
                  <td align="center"><input name="kl8b[]" class="textc" id="kl8b[]" size="10" value="<?php echo $result[0]['h5']?>"/></td>
                  <td align="center"><input name="kl8c[]" class="textc" id="kl8c[]" size="10" value="<?php echo $result1[0]['h5']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">前後和</td>
                  <td align="center"><input name="kl8b[]" class="textc" id="kl8b[]" size="10" value="<?php echo $result[0]['h6']?>"/></td>
                  <td align="center"><input name="kl8c[]" class="textc" id="kl8c[]" size="10" value="<?php echo $result1[0]['h6']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">單雙和</td>
                  <td align="center"><input name="kl8b[]" class="textc" id="kl8b[]" size="10" value="<?php echo $result[0]['h7']?>"/></td>
                  <td align="center"><input name="kl8c[]" class="textc" id="kl8c[]" size="10" value="<?php echo $result1[0]['h7']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">五行</td>
                  <td align="center"><input name="kl8b[]" class="textc" id="kl8b[]" size="10" value="<?php echo $result[0]['h8']?>"/></td>
                  <td align="center"><input name="kl8c[]" class="textc" id="kl8c[]" size="10" value="<?php echo $result1[0]['h8']?>"/></td>
                </tr>
                <?php
      }else {?>
                <tr style="height:28px">
                  <td class="bj2" >第一球</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h1']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h1']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第二球</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h2']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h2']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第三球</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h3']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h3']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第四球</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h4']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h4']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第五球</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h5']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h5']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第六球</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h6']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h6']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第七球</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h7']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h7']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">第八球</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h8']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h8']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-8球大小</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h21']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h21']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-8球單雙</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h23']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h23']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-8球尾數大小</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h25']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h25']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-8球尾數雙單</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h27']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h27']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-8球方位</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h29']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h29']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-8球中發白</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h33']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h33']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-8球總和大小</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h34']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h34']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-8球總和雙單</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h35']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h35']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-8球總和尾數大小</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h36']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h36']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">1-8球龍虎</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h37']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h37']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">任選二</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h38']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h38']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">選二連直</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h39']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h39']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">選二連組</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h40']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h40']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">任選三</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h41']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h41']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">選三前直</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h42']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h42']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">選三前組</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h43']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h43']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">任選四</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h44']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h44']?>"/></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj2">任選五</td>
                  <td align="center"><input name="ygb[]" class="textc" id="ygb[]" size="10" value="<?php echo $result[0]['h45']?>"/></td>
                  <td align="center"><input name="ygc[]" class="textc" id="ygc[]" size="10" value="<?php echo $result1[0]['h45']?>"/></td>
                </tr>
                <?php }?>
              </table>
              
              <!-- end --></td>
            <td class="r"></td>
          </tr>
          <tr>
            <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
            <td class="f" align="center"><input type="submit" class="button_a" value="確認更變" /></td>
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
