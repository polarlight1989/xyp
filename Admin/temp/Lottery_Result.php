<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'functioned/opNumberList.php';
include_once ROOT_PATH.'functioned/numberVal.php';
include_once ROOT_PATH.'functioned/peizhi.php';
if (isset($_GET['id'])){
	$GameType = $_GET['id'];
} else {
	if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 2){//加載重慶
		$GameType = 2;
		markPos("后台-重庆历史开奖结果");
	}else if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 3){//加載广西
		$GameType = 3;
		markPos("后台-江西历史开奖结果");
	}else if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 10){//加載广西
		$GameType = 10;
		markPos("后台-新疆历史开奖结果");
	}else if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 11){//加載广西
		$GameType = 11;
		markPos("后台-天津历史开奖结果");
	} else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 6){//加載PK10
		$GameType = 6;
		markPos("后台-PK历史开奖结果");
	} else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 4){//加載PK10
		$GameType = 4;
		markPos("后台-飞艇历史开奖结果");
	} else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 7){//加載PK10
		$GameType = 7;
		markPos("后台-吉林历史开奖结果");
	} else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 8){//加載PK10
		$GameType = 8;
		markPos("后台-快樂8开奖结果");
	} else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 9){//加載PK10
		$GameType = 9;
		markPos("后台-农场开奖结果");
	}else{
		 $GameType = 1;
		markPos("后台-广东历史开奖结果");
	}
}

$numberList = numberList($GameType);
// print_r($numberList);
$page = $numberList['page'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK rel=stylesheet href="css/Ballclass4.css" type="text/css"  />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<link href="/static/css/base.css" rel="stylesheet" type="text/css" />
<link href="/Css/kl8.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript">
<!--
	function selects($this){
		location.href = "Lottery_Result.php?id="+$this.value;
	}
	
	function onSelect(v){
		//alert(v);
		var sel=document.getElementById("lt");
		
		if(v==1){sel.selectedIndex=0;location.href = "/admin/temp/Lottery_Result.php?id=1"};
		if(v==2){sel.selectedIndex=1;location.href = "/admin/temp/Lottery_Result.php?id=2"};
		if(v==3){sel.selectedIndex=2;location.href = "/admin/temp/Lottery_Result.php?id=3"};
		if(v==4){sel.selectedIndex=6;location.href = "/admin/temp/Lottery_Result.php?id=4"};
		if(v==6){sel.selectedIndex=3;location.href = "/admin/temp/Lottery_Result.php?id=6"};
		if(v==7){sel.selectedIndex=4;location.href = "/admin/temp/Lottery_Result.php?id=7"};
		if(v==8){sel.selectedIndex=5;location.href = "/admin/temp/Lottery_Result.php?id=8"};
		if(v==9){sel.selectedIndex=7;location.href = "/admin/temp/Lottery_Result.php?id=9"};

		
		//document.getElementById("lt").selectedIndex=v-1;
		//alert(document.getElementById("lt").selectedIndex);
		}
	
//-->
</script>
<title></title>
</head>
<body onselectstart="return false">
<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
  <tr>	
        	<td width="5" height="100%" bgcolor="#4F4F4F"></td>
    <td class="c">
      <table border="0" cellspacing="0" class="main">
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
          <td background="/Admin/temp/images/tab_05.gif" align="right">	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
          <td width="99%" align="left"><font style="font-weight:bold" color="#344B50">&nbsp;歷史開奬結果</font></td>
          </tr>
          </table></td>
          <td background="/Admin/temp/images/tab_05.gif" align="right">
		  <select name="lt" id="lt"  onchange="selects(this)">
		  <?php if ($peizhigdklsf == "1") {
    if ($GameType == 1) {
        $lie1 = 'selected="selected"';
    }
    echo " <option  " . $lie1 . " value=\"1\">廣東快樂十分</option>";
} ?>
	<?php
if ($peizhicqssc == "1") {
    if ($GameType == 2) {
        $lie2 = 'selected="selected"';
    }
    echo "<option " . $lie2 . "  value=\"2\">重慶時時彩</option>";
} ?>
	  <?php
if ($peizhijxssc == "1") {
    if ($GameType == 3) {
        $lie3 = 'selected="selected"';
    }
    echo "<option " . $lie3 . "  value=\"3\">极速时时彩</option>";
} ?>
	   <?php
if ($peizhixjssc == "1") {
    if ($GameType == 10) {
        $lie10 = 'selected="selected"';
    }
    echo "<option " . $lie10 . "  value=\"10\">新疆时时彩</option>";
} ?>
	   <?php
if ($peizhitjssc == "1") {
    if ($GameType == 11) {
        $lie11 = 'selected="selected"';
    }
    echo "  <option " . $lie11 . "  value=\"11\">天津时时彩</option>";
} ?>
		<?php
if ($peizhixyft == "1") {
    if ($GameType == 4) {
        $lie4 = 'selected="selected"';
    }
    echo " <option " . $lie4 . "  value=\"4\">极速赛车</option>";
} ?>
		<?php
if ($peizhipk10 == "1") {
    if ($GameType == 6) {
        $lie6 = 'selected="selected"';
    }
    echo " <option " . $lie6 . " value=\"6\">北京赛车PK10</option>";
} ?>
		 <?php
if ($peizhijssz == "1") {
    if ($GameType == 7) {
        $lie7 = 'selected="selected"';
    }
    echo " <option " . $lie7 . "  value=\"7\">吉林快3</option>";
} ?>
		 <?php
if ($peizhikl8 == "1") {
    if ($GameType == 8) {
        $lie8 = 'selected="selected"';
    }
    echo "  <option " . $lie8 . "  value=\"8\">快樂8</option>";
} ?>
		 <?php
if ($peizhinc == "1") {
    if ($GameType == 9) {
        $lie9 = 'selected="selected"';
    }
    echo "  <option " . $lie9 . "  value=\"9\">幸运农场</option>";
} ?>  	
         
          </select></td>
          <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
        </tr>
        <tr>
        <td class="t"></td>
        <td colspan="2" class="c">
        <!-- strat -->
        <table border="0" cellspacing="0" class="t_odds_1" style="margin-top:4px;">
        <?php if ($GameType == 1){?>
        <tr class="tr_top">
        <td width="100px">期數</td>
        <td width="124px">開獎時間</td>
        <td colspan="8">開出號碼</td>
        <td colspan="4"><strong>總和</strong></td>
        <td><strong>龍虎</strong></td>
        </tr>
        <?php if (!$numberList){?>
        <tr><td colspan="8" align="center">暫無記錄</td></tr>
        <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
        <tr class="td_text" onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#FFFFA2'">
        <td><?php echo $numberList[$i][1]?></td>
        <td><?php echo $numberList[$i][2]?></td>
        <?php echo $numberList[$i][3] ?>
        <td width="32px"><?php echo $numberList[$i][4]?></td>
        <td width="27px"><?php echo $numberList[$i][5]?></td>
        <td width="27px"><?php echo $numberList[$i][6]?></td>
        <td width="32px"><?php echo $numberList[$i][7]?></td>
        <td width="30px"><?php echo $numberList[$i][8]?></td>
        </tr>
        <?php }}} else if($GameType == 6 || $GameType == 4){?>
        <tr class="tr_top">
        <td width="55px">期數</td>
        <td width="124px">開獎時間</td>
        <td colspan="10">開出號碼</td>
        <td colspan="3"><strong>冠亞軍和</strong></td>
        <td colspan="5"><strong>1～5 龍虎</strong></td>
        </tr>
        <?php if (!$numberList){?>
        <tr><td colspan="8" align="center">暫無記錄</td></tr>
        <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
        <tr class="td_text" onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#FFFFA2'">
        <td><?php echo $numberList[$i][1]?></td>
        <td><?php echo $numberList[$i][2]?></td>
        <?php echo $numberList[$i][3] ?>
        <td width="31px"><?php echo $numberList[$i][4]?></td>
        <td width="28px"><?php echo $numberList[$i][5]?></td>
        <td width="28px"><?php echo $numberList[$i][6]?></td>
        <td width="28px"><?php echo $numberList[$i][7]?></td>
        <td width="28px"><?php echo $numberList[$i][8]?></td>
        <td width="28px"><?php echo $numberList[$i][9]?></td>
        <td width="28px"><?php echo $numberList[$i][10]?></td>
        <td width="28px"><?php echo $numberList[$i][11]?></td>
        </tr>
        <?php }}}else if($GameType == 7){?>
        <tr class="tr_top">
        <td width="55px">期數</td>
        <td width="124px">開獎時間</td>
        <td colspan="3">開出骰子</td>
        <td colspan="3">魚蝦蟹</td>
        <td colspan="2" width="55px"><strong>總和</strong></td>
        </tr>
        <?php if (!$numberList){?>
        <tr><td colspan="8" align="center">暫無記錄</td></tr>
        <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
        <tr class="td_text" onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#FFFFA2'">
        <td>20<?php echo $numberList[$i][1]?></td>
        <td><?php echo $numberList[$i][2]?></td>
        <?php echo $numberList[$i][3] ?>
        <td width="35px"><?php echo $numberList[$i][4]?></td>
        <td width="30px"><?php echo $numberList[$i][5]?></td>
        
        
        </tr>
		 <?php }}} else if($GameType == 9){?>
        <tr class="tr_top">
        <td width="100px">期數</td>
        <td width="124px">開獎時間</td>
        <td  colspan="8">開出號碼</td>
        <td colspan="4"><strong>總和</strong></td>
        <td><strong>龍虎</strong></td>
        </tr>
        <?php if (!$numberList){?>
        <tr><td colspan="8" align="center">暫無記錄</td></tr>
        <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
        <tr  class="td_text" onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#FFFFA2'">
        <td><?php echo $numberList[$i][1]?></td>
        <td><?php echo $numberList[$i][2]?></td>
        <?php echo $numberList[$i][3] ?>
        <td width="32px"><?php echo $numberList[$i][4]?></td>
        <td width="32px"><?php echo $numberList[$i][5]?></td>
        <td width="32px"><?php echo $numberList[$i][6]?></td>
        <td width="32px"><?php echo $numberList[$i][7]?></td>
       <td  width="32px"><?php echo $numberList[$i][8]?></td>
        </tr>
        <?php }}}else if($GameType == 8){?>
        <tr class="tr_top">
        <td width="55px">期數</td>
        <td width="124px">開獎時間</td>
        <td colspan="20">開獎號碼</td>
        <td colspan="4">總和</td>
        <td colspan="2">比數量</td>
        </tr>
        <?php if (!$numberList){?>
        <tr><td colspan="8" align="center">暫無記錄</td></tr>
        <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
        <tr class="td_text" onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#FFFFA2'">
        <td><?php echo $numberList[$i][1]?></td>
        <td><?php echo $numberList[$i][2]?></td>
        <?php echo $numberList[$i][3] ?>
        <td width="35px"><?php echo $numberList[$i][4]?></td>
        <td width="30px"><?php echo $numberList[$i][5]?></td>
        <td width="30px"><?php echo $numberList[$i][6]?></td>
        <td width="30px"><?php echo $numberList[$i][7]?></td>
        <td width="50px"><?php echo $numberList[$i][8]?></td>
        <td width="50px"><?php echo $numberList[$i][9]?></td>
        </tr>
        <?php }}}else {?>
        <tr class="tr_top">
        <td width="100px">期數</td>
        <td width="124px">開獎時間</td>
        <td width="135px" colspan="5">開出號碼</td>
        <td colspan="3"><strong>總和</strong></td>
        <td><strong>龍虎</strong></td>
        <td><strong>前三</strong></td>
        <td><strong>中三</strong></td>
        <td><strong>后三</strong></td>
        </tr>
        <?php if (!$numberList){?>
        <tr><td colspan="11" align="center">暫無記錄</td></tr>
        <?php  }else {for ($i=0; $i<count($numberList)-1; $i++){?>
        <tr class="td_text" onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#FFFFA2'">
        <td><?php echo $numberList[$i][1]?></td>
        <td><?php echo $numberList[$i][2]?></td>
        <?php echo $numberList[$i][3] ?>
        <td width="31px"><?php echo $numberList[$i][4]?></td>
        <td width="27px"><?php echo $numberList[$i][5]?></td>
        <td width="27px"><?php echo $numberList[$i][6]?></td>
        <td width="27px"><?php echo $numberList[$i][7]?></td>
        <td width="35px"><?php echo $numberList[$i][8]?></td>
        <td width="35px"><?php echo $numberList[$i][9]?></td>
        <td width="35px"><?php echo $numberList[$i][10]?></td>
        </tr>
        <?php }}}?>
        </table>
        <!-- end -->                        </td>
        <td class="r"></td>
        </tr>
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
          <td colspan="2" align="right" class="f">
						<?php $p = $page->diy_page();?>
						<table width='100%' height='22' border='0' cellspacing='0' cellpadding='0' class="page_box"><tr><td align='left'>&nbsp;共&nbsp;<?php echo $p[0];?>&nbsp;期記錄</td><td align='center'>共&nbsp;<?php echo $p[2];?>&nbsp;頁</td><td align='right'>&nbsp;<?php echo $p[4];?>『<?php echo $p[5];?>』<?php echo $p[6];?></td></tr></table></td>
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
</body>
</html>