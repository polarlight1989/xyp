<?php
include_once ROOT_PATH.'functioned/peizhi.php';
?>

<select onchange = "window.location.href=this.options[selectedIndex].value">
    
<?php
	echo $lm;
if ($peizhigdklsf == "1") {
    if ($lm == 'gdklsf') {
        $gdklsf = ' selected';
    }
    echo " <option value = \"openNumbers.php\" style=\"color:Blue\"" . $gdklsf . ">廣東快樂十分</option>";
}
if ($peizhicqssc == "1") {
    if ($lm == 'cqssc') {
        $cqssc = ' selected';
    }
    echo "<option value = \"openNumbers_cq.php\" style=\"color:Blue\" " . $cqssc . ">重慶時時彩</option>";
}
if ($peizhijxssc == "1") {
    if ($lm == 'jxssc') {
        $jxssc = ' selected';
    }
    echo "<option value = \"openNumbers_jxssc.php\" style=\"color:Blue\" " . $jxssc . ">极速时时彩</option>";
}
if ($peizhixjssc == "1") {
    if ($lm == 'xjssc') {
        $xjssc = ' selected';
    }
    echo "<option value = \"openNumbers_xjssc.php\" style=\"color:Blue\" " . $xjssc . ">新疆时时彩</option>";
}
if ($peizhitjssc == "1") {
    if ($lm == 'tjssc') {
        $tjssc = ' selected';
    }
    echo "<option value = \"openNumbers_tjssc.php\" style=\"color:Blue\" " . $tjssc . ">天津时时彩</option>";
}
if ($peizhipk10 == "1") {
    if ($lm == 'pk10') {
        $pk10 = ' selected';
    }
    echo "<option value = \"openNumbers_pk.php\" style=\"color:Blue\"  " . $pk10 . ">北京赛车PK10</option>";
}
if ($peizhijssz == "1") {
    if ($lm == 'jstb') {
        $jstb = ' selected';
    }
    echo "<option value = \"openNumbers_js.php\" style=\"color:Blue\" " . $jstb . ">吉林快3</option>";
}
if ($peizhikl8 == "1") {
    if ($lm == 'kl8') {
        $kl8 = ' selected';
    }
    echo "<option value = \"openNumbers_kl8.php\" style=\"color:Blue\" " . $kl8 . ">北京快樂8</option>";
}
if ($peizhixyft == "1") {
    if ($lm == 'xyft') {
        $xyft = ' selected';
    }
    echo "<option value = \"openNumbers_xyft.php\" style=\"color:Blue\" " . $xyft . ">极速赛车</option>";
}
if ($peizhinc == "1") {
    if ($lm == 'xync') {
        $xync = ' selected';
    }
    echo "<option value = \"openNumbers_nc.php\" style=\"color:Blue\" " . $xync . ">幸运农场</option>";
}
?>  
				 </select>