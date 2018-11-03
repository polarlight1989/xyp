<?php
include_once ROOT_PATH.'functioned/peizhi.php';
?>
<!--彩種選擇-->
		<div class="TZtitle">
		<div data-role="fieldcontain">
			
	<fieldset data-role="controlgroup" data-type="horizontal">
    	<select id="lottery_type" name="lottery_type">
   
   <?php
   
   if ($peizhigdklsf == "1") {
    if ($_SESSION['cpopen'] == 1) {
        $gdklsf = ' selected=selected';
    }
    echo "  <option value=\"0\"  url=\"KL10_lm.php\" " . $gdklsf . ">廣東快樂十分</option>";
}
if ($peizhicqssc == "1") {
    if ($_SESSION['cpopen'] == 2) {
        $cqssc = ' selected=selected';
    }
    echo " <option value=\"2\"  url=\"CQSC_lm.php\" " . $cqssc . ">重慶時時彩</option>";
}
if ($peizhijxssc == "1") {
    if ($_SESSION['cpopen'] == 3) {
        $jxssc = ' selected=selected';
    }
    echo " <option value=\"3\"  url=\"qtwfc_lm.php\" " . $jxssc . ">极速时时彩</option>";
}
if ($peizhixjssc == "1") {
    if ($_SESSION['cpopen'] == 10) {
        $xjssc = ' selected=selected';
    }
    echo " <option value=\"10\"  url=\"qtwfc_lm.php\" " . $xjssc . ">新疆时时彩</option>";
}
if ($peizhitjssc == "1") {
    if ($_SESSION['cpopen'] == 11) {
        $tjssc = ' selected=selected';
    }
    echo "<option value=\"11\"  url=\"qtwfc_lm.php\" " . $tjssc . ">天津时时彩</option>";
}
if ($peizhipk10 == "1") {
    if ($_SESSION['cpopen'] == 6) {
        $pk10 = ' selected=selected';
    }
    echo "<option value=\"6\" url=\"PK10_lm.php\" " . $pk10 . ">北京赛车PK10</option>";
}
if ($peizhinc == "1") {
    if ($_SESSION['cpopen'] == 9) {
        $xync = ' selected=selected';
    }
    echo "<option value=\"9\"  url=\"XYNC_lm.php\" " . $xync . ">幸运农场</option>";
}
if ($peizhijssz == "1") {
    if ($_SESSION['cpopen'] == 7) {
        $jstb = ' selected=selected';
    }
    echo "<option value=\"7\"  url=\"jsk3_lm.php\" " . $jstb . ">吉林快3</option>";
}
if ($peizhikl8 == "1") {
    if ($_SESSION['cpopen'] == 8) {
        $kl8 = ' selected=selected';
    }
    echo " <option value=\"8\"  url=\"KL8_zh.php\" " . $kl8 . ">北京快樂8</option>";
}
if ($peizhixyft == "1") {
    if ($_SESSION['cpopen'] == 4) {
        $xyft = ' selected=selected';
    }
    echo "<option value=\"4\"  url=\"XYFT_lm.php\" " . $xyft . ">极速赛车</option>";
}

?>            
   
   
</select>
<?
if($_SESSION['cpopen']==0 || $_SESSION['cpopen']==9){
?>
                
				<select id="player_type" name="player_type">
				  <option value="lm" <?=$_SESSION['lm']=='lm' ? 'selected=selected' : ''?>>兩面</option>
				  <option value="d1" <?=$_SESSION['lm']=='d1' ? 'selected=selected' : ''?>>第一球</option>
				  <option value="d2" <?=$_SESSION['lm']=='d2' ? 'selected=selected' : ''?>>第二球</option>
				  <option value="d3" <?=$_SESSION['lm']=='d3' ? 'selected=selected' : ''?>>第三球</option>
				  <option value="d4" <?=$_SESSION['lm']=='d4' ? 'selected=selected' : ''?>>第四球</option>
				  <option value="d5" <?=$_SESSION['lm']=='d5' ? 'selected=selected' : ''?>>第五球</option>
                  <option value="d6" <?=$_SESSION['lm']=='d6' ? 'selected=selected' : ''?>>第六球</option>
				  <option value="d7" <?=$_SESSION['lm']=='d7' ? 'selected=selected' : ''?>>第七球</option>
				  <option value="d8" <?=$_SESSION['lm']=='d8' ? 'selected=selected' : ''?>>第八球</option>
                  <option value="zh" <?=$_SESSION['lm']=='zh' ? 'selected=selected' : ''?>>總和、龍虎</option>
				</select>
<?
}elseif($_SESSION['cpopen']==2 || $_SESSION['cpopen']==3 || $_SESSION['cpopen']==10 || $_SESSION['cpopen']==11){
?>
                
				<select id="player_type" name="player_type">
				  <option value="lm" <?=$_SESSION['lm']=='lm' ? 'selected=selected' : ''?>>兩面</option>
                  <option value="dq"  <?=$_SESSION['lm']=='dq' ? 'selected=selected' : ''?>>單球1-5</option>
				  <option value="d1" <?=$_SESSION['lm']=='d1' ? 'selected=selected' : ''?>>第一球</option>
				  <option value="d2" <?=$_SESSION['lm']=='d2' ? 'selected=selected' : ''?>>第二球</option>
				  <option value="d3" <?=$_SESSION['lm']=='d3' ? 'selected=selected' : ''?>>第三球</option>
				  <option value="d4" <?=$_SESSION['lm']=='d4' ? 'selected=selected' : ''?>>第四球</option>
				  <option value="d5" <?=$_SESSION['lm']=='d5' ? 'selected=selected' : ''?>>第五球</option>
				</select>
<?
}elseif($_SESSION['cpopen']==4 || $_SESSION['cpopen']==6){
?>
                
				<select id="player_type" name="player_type">
				  <option value="lm"  <?=$_SESSION['lm']=='lm' ? 'selected=selected' : ''?>>兩面盤</option>
				  <option value="dq"  <?=$_SESSION['lm']=='dq' ? 'selected=selected' : ''?>>單球1-10</option>
				  <option value="zh" <?=$_SESSION['lm']=='zh' ? 'selected=selected' : ''?>>冠、亞軍 組合</option>
				  <option value="3456" <?=$_SESSION['lm']=='3456' ? 'selected=selected' : ''?>>三、四、五、六名</option>
				  <option value="78910" <?=$_SESSION['lm']=='78910' ? 'selected=selected' : ''?>>七、八、九、十名</option>
				</select>
<?
}elseif($_SESSION['cpopen']==7){
?>          
				<select id="player_type" name="player_type">
				  <option value="lm"  <?=$_SESSION['lm']=='lm' ? 'selected=selected' : ''?>>大小骰寶</option>
				</select> 
<? }elseif($_SESSION['cpopen']==8){
?>          
				<select id="player_type" name="player_type">
				  <option value="zh"  <?=$_SESSION['lm']=='zh' ? 'selected=selected' : ''?>>總和比數五行</option>
				  <option value="zm"  <?=$_SESSION['lm']=='zm' ? 'selected=selected' : ''?>>正碼</option>
				</select> 
<? }?>           
			</fieldset>
		</div>
		</div>