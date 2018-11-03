<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/globalge.php';
include_once ROOT_PATH.'functioned/opNumberList.php';
include_once ROOT_PATH.'functioned/cheCookie.php';
include_once ROOT_PATH.'functioned/peizhi.php';
if (isset($_GET['sltType'])){
	$li = is_numeric($_GET['sltType']) ? intval($_GET['sltType']) : 1;
} else {
	$li= is_numeric($_SESSION['cpopen']) && $_SESSION['cpopen']>1  ? intval($_SESSION['cpopen']) : 1;
}
$t = '';
$sltDate= $_GET['sltDate'] ? $_GET['sltDate'] : date('Y-m-d');
switch ($li) {
	case 1:
		$t = '广东';
		break;
	case 2:
		$t = '重庆';
		break;
	case 3:
		$t = '江西';
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

?><!DOCTYPE html>  
<html>  
<head>  
<title>遊戲大廳</title>  
<link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.mobile-1.4.3.js"></script>
<script src="js/jquery.showLoading.min.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
<meta content="telephone=no" name="format-detection" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>  
<body>  	
<div data-role="page" > 
<script language="javascript" type="text/javascript">
    $(document).ready(function () {

  
    });

    function changeValue() {
        var sltType = $("#sltType").val();
        var sltDate = $("#sltDate").val();
        window.location.href = "KaiJiang.php?sltType=" + sltType + "&sltDate=" + sltDate + "&r=07180359027117";
    }

</script>


	<div data-role="header" data-position="fixed">
		<a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext"></a>
		<h1>歷史開獎</h1>
		<a href="Main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse"></a>
		<!--彩種選擇-->
		<div class="TZtitle">
		<div data-role="fieldcontain">
			<fieldset data-role="controlgroup" data-type="horizontal">
				<select id="sltType" name="sltType"  onchange="changeValue()">
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
		 <?php
if ($peizhinc == "1") {
    if ($li == 9) {
        $lie9 = 'selected="selected"';
    }
    echo "  <option " . $lie9 . "  value=\"9\">幸运农场</option>";
} ?>   
				</select>
				<select id="sltDate" name="sltDate"  onchange="changeValue()">
                <?
                for($i=0;$i<30;$i++){
					$t=date('Y-m-d',strtotime('-'.$i.' day'));
					if($sltDate==$t){echo ' <option value="'.$t.'" selected=selected>'.$t.'</option>';}
					else echo ' <option value="'.$t.'">'.$t.'</option>';
				}
				?>  
				</select>
			</fieldset>
		</div>
		</div>
	</div> 
	<div data-role="content" class="pm"  id="Top_allKaijiang">		
		<!--玩法規則-->
		<div class="KJbox">
			<div class="box">
				
				<ul>

                <b class="w30">期數</b><b class="w70">球號</b>
					  
                   <?
                   $db = new DB();
	$pageNum = 30;
	$numberList = array();
	$from = $id == true ? "" : "WHERE g_ball_1 is not null and g_date like '".$sltDate."%'";
	$g_history='g_history'.($li==1 ? '' : $li);
	$sqls="SELECT * FROM `$g_history`  {$from} ORDER BY g_qishu DESC limit $pageNum";
	$result = $db->query($sqls, 1);
	if ($result){
		if($li==1){
			foreach ($result as $key=>$value) {
				   ?>
					<li>
						<p class="w30"><?=$value['g_qishu']?></p>
						<p class="w70">
							<span class="num_<?=BuLing($value['g_ball_1'])?>"><?=BuLing($value['g_ball_1'])?></span>
							<span class="num_<?=BuLing($value['g_ball_2'])?>"><?=BuLing($value['g_ball_2'])?></span>
							<span class="num_<?=BuLing($value['g_ball_3'])?>"><?=BuLing($value['g_ball_3'])?></span>
							<span class="num_<?=BuLing($value['g_ball_4'])?>"><?=BuLing($value['g_ball_4'])?></span>
							<span class="num_<?=BuLing($value['g_ball_5'])?>"><?=BuLing($value['g_ball_5'])?></span>
							<span class="num_<?=BuLing($value['g_ball_6'])?>"><?=BuLing($value['g_ball_6'])?></span>
							<span class="num_<?=BuLing($value['g_ball_7'])?>"><?=BuLing($value['g_ball_7'])?></span>
							<span class="num_<?=BuLing($value['g_ball_8'])?>"><?=BuLing($value['g_ball_8'])?></span>
						</p>
					</li>
                    
          <?
			}
		}elseif($li==2 || $li==3 || $li==10  || $li==11){
			foreach ($result as $key=>$value) {
				   ?>
					<li>
						<p class="w30"><?=$value['g_qishu']?></p>
						<p class="w70">
							<span class="num_<?=BuLing($value['g_ball_1'])?>"><?=BuLing($value['g_ball_1'])?></span>
							<span class="num_<?=BuLing($value['g_ball_2'])?>"><?=BuLing($value['g_ball_2'])?></span>
							<span class="num_<?=BuLing($value['g_ball_3'])?>"><?=BuLing($value['g_ball_3'])?></span>
							<span class="num_<?=BuLing($value['g_ball_4'])?>"><?=BuLing($value['g_ball_4'])?></span>
							<span class="num_<?=BuLing($value['g_ball_5'])?>"><?=BuLing($value['g_ball_5'])?></span>
						</p>
					</li>
                    
          <?
			}
		}elseif($li==4 || $li==6   ){
			foreach ($result as $key=>$value) {
				   ?>
					<li>
						<p class="w30"><?=$value['g_qishu']?></p>
						<p class="w70">
							<span class="pk_<?=BuLing($value['g_ball_1'])?>"><?=BuLing($value['g_ball_1'])?></span>
							<span class="pk_<?=BuLing($value['g_ball_2'])?>"><?=BuLing($value['g_ball_2'])?></span>
							<span class="pk_<?=BuLing($value['g_ball_3'])?>"><?=BuLing($value['g_ball_3'])?></span>
							<span class="pk_<?=BuLing($value['g_ball_4'])?>"><?=BuLing($value['g_ball_4'])?></span>
							<span class="pk_<?=BuLing($value['g_ball_5'])?>"><?=BuLing($value['g_ball_5'])?></span>
                           
							<span class="pk_<?=BuLing($value['g_ball_6'])?>"><?=BuLing($value['g_ball_6'])?></span>
							<span class="pk_<?=BuLing($value['g_ball_7'])?>"><?=BuLing($value['g_ball_7'])?></span>
							<span class="pk_<?=BuLing($value['g_ball_8'])?>"><?=BuLing($value['g_ball_8'])?></span>
                            <span class="pk_<?=BuLing($value['g_ball_9'])?>"><?=BuLing($value['g_ball_9'])?></span>
                            <span class="pk_<?=BuLing($value['g_ball_10'])?>"><?=BuLing($value['g_ball_10'])?></span>
						</p>
					</li>
                    
          <?
			}
		}elseif($li==7){
			foreach ($result as $key=>$value) {
				   ?>
					<li>
						<p class="w30"><?=$value['g_qishu']?></p>
						<p class="w70">
							<span><img src="images/k<?=($value['g_ball_1'])?>.png" width="26" height="26"></span>
							<span><img src="images/k<?=($value['g_ball_2'])?>.png" width="26" height="26"></span>
							<span><img src="images/k<?=($value['g_ball_3'])?>.png" width="26" height="26"></span>
							
						</p>
					</li>
                    
          <?
			}
		}elseif($li==9){
			foreach ($result as $key=>$value) {
				   ?>
					<li>
						<p class="w30"><?=$value['g_qishu']?></p>
						<p class="w70">
							<span><img src="images/<?=($value['g_ball_1'])?>.png" width="26" height="26"></span>
							<span><img src="images/<?=($value['g_ball_2'])?>.png" width="26" height="26"></span>
							<span><img src="images/<?=($value['g_ball_3'])?>.png" width="26" height="26"></span>
							<span><img src="images/<?=($value['g_ball_4'])?>.png" width="26" height="26"></span>
							<span><img src="images/<?=($value['g_ball_5'])?>.png" width="26" height="26"></span>
							<span><img src="images/<?=($value['g_ball_6'])?>.png" width="26" height="26"></span>
							<span><img src="images/<?=($value['g_ball_7'])?>.png" width="26" height="26"></span>
							<span><img src="images/<?=($value['g_ball_8'])?>.png" width="26" height="26"></span>
						</p>
					</li>
                    
          <?
			}
		}elseif($li==8){
			foreach ($result as $key=>$value) {
				   ?>
					<li>
						<p class="w30">北京快8<br><?=$value['g_qishu']?></p>
						<p class="w70">
                        <?
                        for($ball=1;$ball<=20;$ball++){
						?>
							<span class="kl8"><?=BuLing($value['g_ball_'.$ball])?></span>
                           <? }?>
						</p>
					</li>
                    
          <?
			}
		}
	}else{echo '<li>暫無記錄</li>';}
		  ?>      							
				</ul>
			<div class="clear"></div>
			</div>		
            <div style="text-align:center; font-size:12px;">注：只取當前日最新30期開獎數據</div>
		<div class="clear"></div>
        
		</div>

	</div> 
<? include 'left.php';?>
</div> 
</body> 
</html>  