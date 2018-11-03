<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/globalge.php';
include_once ROOT_PATH.'functioned/opNumberList.php';
include_once ROOT_PATH.'functioned/cheCookie.php';
include_once ROOT_PATH.'functioned/peizhi.php';
if (isset($_GET['id'])){
	$li = $_GET['id'];
} else {
	$li= is_numeric($_SESSION['cpopen']) ? intval($_SESSION['cpopen']) : 1;
}
$t = '';
switch ($li) {
	case 1:
		$t = '广东';
		break;
	case 2:
		$t = '重庆';
		break;
	case 3:
		$t = '五分彩';
		break;
	case 10:
		$t = '新疆';
		break;
	case 11:
		$t = '天津';
		break;
	case 4:
		$t = '飞艇';
		break;
		
	case 6:
		$t = 'PK';
		break;
	case 7:
		$t = '吉林';
		break;
	case 8:
		$t = '快樂8';
		break;
	case 9:
		$t = '农场';
		break;
}
markPos("前台-{$t}-历史开奖");

$numberList = numberList($li);
$page = $numberList['page'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/ball_4.css" rel="stylesheet" type="text/css">
<link href="css/left.css" rel="stylesheet" type="text/css">
<link href="/static/css/base.css" rel="stylesheet" type="text/css">
<link href="/Css/kl8.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.t_list {margin:0px 14px;}
</style>
<script type="text/javascript">
<!--
	function selects($this){
		location.href = "result.php?id="+$this.value;
	}
//-->
</script>
</head>
<BODY onselectstart="return false">
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
<table border="0" cellpadding="0" cellspacing="1" class="t_list t_result" style="margin-top:0px;top:1px;">
		<?php if ($li == 1){?>
<tr class="t_list_caption">
            <td width="100">期數</td>
            <td width="135">開獎時間</td>
            <td colspan="8">開出號碼</td>
            <td colspan="4">總和</td>
            <td>龍虎</td>
        </tr>
        <?php if (!$numberList){?><tr><td colspan="8" align="center">暫無記錄</td></tr><?php }else {
         for ($i=0; $i<count($numberList)-1; $i++){?>
         <tr align="center" class="t_td_text" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
             <td><?php echo $numberList[$i][1]?></td>
             <td><?php echo $numberList[$i][2]?></td>
             <?php echo $numberList[$i][3] ?>
             <td width="35"><?php echo $numberList[$i][4]?></td>
             <td width="30"><?php echo $numberList[$i][5]?></td>
             <td width="30"><?php echo $numberList[$i][6]?></td>
             <td width="35"><?php echo $numberList[$i][7]?></td>
             <td height="27" width="30"><?php echo $numberList[$i][8]?></td>
             </tr>		 
        <?php }}}else if($li==6 || $li == 4){
		?>
		  <tr class="t_list_caption">
            <td width="55">期數</td>
            <td width="135">開獎時間</td>
            <td colspan="10">開出號碼</td>
            <td colspan="3">冠亞軍和</td>
            <td colspan="5">1～5 龍虎</td>
        </tr>
        <?php if (!$numberList){?><tr><td colspan="8" align="center">暫無記錄</td></tr><?php }else {
         for ($i=0; $i<count($numberList)-1; $i++){?>
         <tr align="center" class="t_td_text" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
             <td><?php echo $numberList[$i][1]?></td>
             <td><?php echo $numberList[$i][2]?></td>
             <?php echo $numberList[$i][3] ?>
            <td width="35px"><?php echo $numberList[$i][4]?></td>
            <td width="30px"><?php echo $numberList[$i][5]?></td>
            <td width="30px"><?php echo $numberList[$i][6]?></td>
            <td width="30px" ><font><?=$numberList[$i][7]?></font></td>
            <td width="30px"><?php echo $numberList[$i][8]?></td>
			<td width="30px"><?php echo $numberList[$i][9]?></td>
            <td width="30px"><?php echo $numberList[$i][10]?></td>
			<td width="30px"><?php echo $numberList[$i][11]?></td>
             </tr>
        <?php }}}else if($li==7){
		?>
		  <tr class="t_list_caption">
            <td width="122">期數&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td width="135">開獎時間&nbsp;&nbsp;&nbsp;</td>
            <td colspan="3">開出骰子&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td colspan="3">魚蝦蟹&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td colspan="2">總和&nbsp;&nbsp;</td>
        </tr>
        <?php if (!$numberList){?><tr><td colspan="8" align="center">暫無記錄</td></tr><?php }else {
         for ($i=0; $i<count($numberList)-1; $i++){?>
         <tr align="center" class="t_td_text" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
             <td height="27">20<?php echo $numberList[$i][1]?></td>
             <td><?php echo $numberList[$i][2]?></td>
             <?php echo $numberList[$i][3] ?>
            <td width="32px"><?php echo $numberList[$i][4]?></td>
            <td height="27" width="31px"><?php echo $numberList[$i][5]?></td>
  		</tr>
  		<?php }}}else if($li==8){
		?>
		  <tr class="t_list_caption">
            <td width="80">期數</td>
            <td width="135">開獎時間</td>
            <td colspan="20">開出號碼</td>
            <td colspan="4">總和</td>
            <td colspan="2">比數量</td>
        </tr>
        <?php if (!$numberList){?><tr><td colspan="8" align="center">暫無記錄</td></tr><?php }else {
         for ($i=0; $i<count($numberList)-1; $i++){?>
         <tr align="center" class="t_td_text" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
             <td height="27"><?php echo $numberList[$i][1]?></td>
             <td><?php echo $numberList[$i][2]?></td>
             <?php echo $numberList[$i][3] ?>
            <td width="35px"><?php echo $numberList[$i][4]?></td>
            <td width="30px"><?php echo $numberList[$i][5]?></td>
            <td width="30px"><?php echo $numberList[$i][6]?></td>
            <td width="30px"><?php echo $numberList[$i][7]?></td>
            <td width="50px"><?php echo $numberList[$i][8]?></td>
            <td width="50px"><?php echo $numberList[$i][9]?></td>
 		 </tr>
         <?php }}}else if($li==9){
		?>
		  <tr class="t_list_caption">
            <td width="100">期數</td>
            <td width="135">開獎時間</td>
            <td colspan="8">開出號碼</td>
            <td colspan="4">總和</td>
            <td>龍虎</td>
        </tr>
        <?php if (!$numberList){?><tr><td colspan="8" align="center">暫無記錄</td></tr><?php }else {
         for ($i=0; $i<count($numberList)-1; $i++){?>
         <tr align="center" class="t_td_text" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
             <td><?php echo $numberList[$i][1]?></td>
             <td><?php echo $numberList[$i][2]?></td>
             <?php echo $numberList[$i][3] ?>
             <td width="35"><?php echo $numberList[$i][4]?></td>
             <td width="30"><?php echo $numberList[$i][5]?></td>
             <td width="30"><?php echo $numberList[$i][6]?></td>
             <td width="35"><?php echo $numberList[$i][7]?></td>
             <td height="27" width="30"><?php echo $numberList[$i][8]?></td>
             </tr>
		<?php }}}else{?>
			<tr align="center" class="t_list_caption" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
			     <td width="100">期數</td>
            	 <td width="135">開獎時間</td>
			     <td colspan="5">開出號碼</td>
			     <td colspan="3" width="95">總和</td>
			     <td>龍虎</td>
			     <td>前三</td>
			     <td>中三</td>
			     <td>后三</td>
			</tr>
       <?php if (!$numberList){?><tr><td colspan="10" align="center">暫無記錄</td></tr><?php }else {
       for ($i=0; $i<count($numberList)-1; $i++){?>
			<tr align="center" class="t_td_text" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
				<td>&nbsp;<?php echo $numberList[$i][1]?>&nbsp;</td>
				<td>&nbsp;<?php echo $numberList[$i][2]?>&nbsp;</td>
				<?php echo $numberList[$i][3] ?>
				<td width="35"><?php echo $numberList[$i][4]?></td>
				<td width="30"><?php echo $numberList[$i][5]?></td>
				<td width="30"><?php echo $numberList[$i][6]?></td>
				<td width="35"><?php echo $numberList[$i][7]?></td>
				<td width="35"><?php echo $numberList[$i][8]?></td>
				<td width="35"><?php echo $numberList[$i][9]?></td>
				<td width="35"><?php echo $numberList[$i][10]?></td>
			</tr>
        <?php }}}?>
        <tr class="Man_bottom">
        	<td <?php if($li==1 || $li==5) echo 'colspan="15"';else if($li==2) echo'colspan="14"'; else  if($li==6|$li==4) echo 'colspan="20"';else  if($li==7) echo 'colspan="10"'; else  if($li==8) echo 'colspan="28"'; else  echo 'colspan="18"'?> align="right"><?php $p = $page->diy_page()?><table width='100%' height='22' border='0' cellspacing='0' cellpadding='0' class="page_box"><tr><td align='left'>&nbsp;共&nbsp;<?php echo $p[0];?>&nbsp;期記錄</td><td align='center'>共&nbsp;<?php echo $p[2];?>&nbsp;頁</td><td align='right'>&nbsp;<?php echo $p[4];?>『<?php echo $p[5];?>』<?php echo $p[6];?></td></tr></table></td>
        </tr>
</table>
</tr>
</body>
</html>