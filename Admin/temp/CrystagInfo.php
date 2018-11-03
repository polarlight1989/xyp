<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'functioned/peizhi.php';
global $Users;
if ($Users[0]['g_login_id'] != 89) exit;

markPos("后台-柱单查询");

if (isset($Users[0]['g_lock_1_4'])){
	if ($Users[0]['g_lock_1_4'] !=1) 
		exit(back('您的權限不足！'));
}

$db=new DB();
$gmname=$_SESSION['sName'];
$resulth = $db->query("SELECT g_auto, g_gd FROM 
	j_manage where g_name='{$gmname}'  ORDER BY g_id DESC", 1);
	
$userModel = new UserModel();
$RankList = $userModel->GetRankAll();
$MemberList = $userModel->GetMemberAll();

$pageNum = 50;

if ($_GET['Type']!=""){
$GameType=$_GET['Type'];
}else{
$GameType=$_SESSION['Type'];
}

if ($GameType == 0){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '';
	$gp="";
	$link = '';
} elseif ($GameType == 2){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '重慶時時彩';
	$gp="AND g_type = '{$p}'";
	$link = 'UpCrystalcq.php';
	
} else if ($GameType== 3){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '极速时时彩';
	$gp="AND g_type = '{$p}'";
	$link = 'UpCrystaljxssc.php';
} else if ($GameType== 10){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '新疆时时彩';
	$gp="AND g_type = '{$p}'";
	$link = 'UpCrystalxjssc.php';
} else if ($GameType== 11){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '天津时时彩';
	$gp="AND g_type = '{$p}'";
	$link = 'UpCrystaltjssc.php';
}else if($GameType == 6){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '北京赛车PK10';
	$gp="AND g_type = '{$p}'";
	$link = 'UpCrystalpk.php';
}else if($GameType == 4){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '极速赛车';
	$gp="AND g_type = '{$p}'";
	$link = 'UpCrystalxyft.php';
}else if($GameType== 7){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '吉林快3';
	$gp="AND g_type = '{$p}'";
	$link = 'UpCrystaljs.php';
}else if($GameType== 8){
	$a = day();
	$startDate = $a[0];
	$endDate = $a[1];
	$p = '快樂8';
	$gp="AND g_type = '{$p}'";
	$link = 'UpCrystalkl8.php';
}else if($GameType== 9){
	$startDate = date('Y-m-d').' 00:00';
	$endDate = date('Y-m-d').' 24:00';
	$p = '幸运农场';
	$gp="AND g_type = '{$p}'";
	$link = 'UpCrystalxync.php';
}else{
	$startDate = date('Y-m-d').' 00:00';
	$endDate = date('Y-m-d').' 24:00';
	$p = '廣東快樂十分';
	$gp="AND g_type = '{$p}'";
	$link = 'UpCrystal.php';
}


if ($_GET['rid']!=""){
$rid=$_GET['rid'];
}else{
$rid=0;
}

if ($rid==1){
$r =  "and g_win is not null" ;
}elseif ($rid==2){
$r= "and g_win is null";
}else{
$r=" ";
}

if ($_GET['searchName']!=""){
$rname=$_GET['searchName'];
}else{
$rname="";
}


if ($rname!=""){
$rn =  "and g_nid='{$rname}' " ;
}else{
$rn=" ";
}

if ($_GET['gname']!=""){
$gname=$_GET['gname'];
}else{
$gname="";
}

if ($gname!=""){
$gn =  "and g_nid LIKE '%$gname%' " ;
}else{
$gn=" ";
}

if ($_GET['start']!="" and $_GET['end']!=""){

    $start=$_GET['start'];//起始
	$end=$_GET['end'];//终止
	$startD=$start." 00:00:00";
	$endD=$end." 23:59:00";
	 
	$date = " `g_date` > '{$startD}' AND `g_date` < '{$endD}' ";
}else{
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	}
	$total = $db->query("SELECT `g_id` FROM `g_zhudan` WHERE {$date}  {$gp}  {$r}  {$rn} {$gn} ", 3);
	
	$page = new Page($total, $pageNum);
	$sql = "SELECT * FROM g_zhudan WHERE {$date}  {$gp}  {$r}  {$rn} {$gn} ORDER BY g_id DESC {$page->limit} ";
	$result = $db->query($sql, 1);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.1.min.js"></script>
<script type="text/javascript" src="/Admin/temp/js/crystalInfo.js"></script>
<title></title>
<script>
function setauto(zdid,title)
	{
	
		$.ajax({
			type : "POST",
			data : {zid : zdid,type:title},
			url : "Wa1nAll.php",
			dataType : "json",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						setauto();
						return false;
					}
				}
			},
			success:function(data){
				
				if(data==1){
				$("#"+zdid).html("还原");
				$("#"+zdid).attr("title","no");
				 $("#fail"+zdid).html("不中");
				 $("#fail"+zdid).attr("title","yes");
				}else{
				 $("#"+zdid).html("必中");
				 $("#"+zdid).attr("title","yes");
				}
			}
		});
	}
function setautofail(zdid,title)
	{
	
		$.ajax({
			type : "POST",
			data : {zid : zdid,type:title},
			url : "Wa1nFail.php",
			dataType : "json",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						setautofail();
						return false;
					}
				}
			},
			success:function(data){
				
				if(data==1){
				$("#fail"+zdid).html("还原");
				$("#fail"+zdid).attr("title","no");
				 $("#"+zdid).html("必中");
				 $("#"+zdid).attr("title","yes");
				}else{
				 $("#fail"+zdid).html("不中");
				 $("#fail"+zdid).attr("title","yes");
				}
			}
		});
	}
</script>
<script type="text/javascript" language=JavaScript charset="UTF-8">
$(function(){
$('#FromSubmit').keydown(function(e){ 
if(e.keyCode==13){GoSearch('FromSubmit()','');} 
});
});
</script>
</head>
<div style="display:none">
</div>
<body onselectstart="return false">
<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
  <tr>
    <td width="5" height="100%" bgcolor="#4F4F4F"></td>
    <td class="c"><table border="0" cellspacing="0" class="main">
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
          <td background="/Admin/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="80"><select id="det4" name="det4" onchange="FromSubmit();">
                    <option value="0" <?php if ($rid==0){ ?>selected="selected"<?php }?>>--全选--</option>
                    <option value="1"  <?php if ($rid==1){ ?>selected="selected"<?php }?>>已結算</option>
                    <option value="2" <?php if ($rid==2){ ?>selected="selected"<?php }?>>未結算</option>
                  </select></td>
                <td width="100" align="right"><select name="lt" id="lt"   onchange="FromSubmit();">
                    <option style="color:Blue" <?php if ($GameType == 0) echo 'selected="selected"'?> value="0">全部</option>
                  
					
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
                <td width="45" align="right">帳號：</td>
                <td width="40"><select id="member" name="member" onchange="FromSubmit();">
                    <option value="" <?php if ($rname==""){echo 'selected="selected"';}?>>----請選擇----</option>
                    <?php if ($MemberList){ for ($i=0; $i<count($MemberList); $i++){
										   if ($rname==$MemberList[$i][0]){
										   echo '<option selected="selected" value="'.$MemberList[$i][0].'" >'.$MemberList[$i][0].'</option>';
										   }else{
	                                       		echo '<option  value="'.$MemberList[$i][0].'" >'.$MemberList[$i][0].'</option>';
												}
	                                       	}}?>
                  </select></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td width="95"><select id="startDate" name="startDate"  onchange="FromSubmit();">
                    <?php 
									
									for ($i=50;$i>=1;$i--){?>
                    <option <?php if ($_GET['start']==date("Y-m-d",strtotime('-'.$i.'days'))){echo 'selected="selected"';}?> value="<?php echo date("Y-m-d",strtotime('-'.$i.'days')); ?>"  ><?php echo date("Y-m-d",strtotime('-'.$i.'days')); ?></option>
                    <?php }?>
                    <option value="<?php echo date("Y-m-d"); ?>" <?php if ($_GET['start']==date("Y-m-d") || $_GET['start']==""  ){echo 'selected="selected"';}?> ><?php echo date("Y-m-d"); ?></option>
                  </select></td>
                <td>&mdash;</td>
                <td width="95"><select id="endDate" name="endDate"  onchange="FromSubmit();">
                    <?php 
									
									for ($i=50;$i>=1;$i--){?>
                    <option <?php if ($_GET['end']==date("Y-m-d",strtotime('-'.$i.'days'))){echo 'selected="selected"';}?>  value="<?php echo date("Y-m-d",strtotime('-'.$i.'days')); ?>"  ><?php echo date("Y-m-d",strtotime('-'.$i.'days')); ?></option>
                    <?php }?>
                    <option value="<?php echo date("Y-m-d"); ?>" <?php if ($_GET['end']==date("Y-m-d") || $_GET['end']==""  ){echo 'selected="selected"';}?>><?php echo date("Y-m-d"); ?></option>
                  </select></td>
                <td width="65" align="right">查詢：</td>
                <td><select id="FindType">
                    <option value="3">會員帳號：</option>
                  </select>
                  &nbsp;
                  <input type="text"  maxlength="30" id="searchName" style="width:100px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class="'inp1MM'" />
                  &nbsp;
                  <input name="Find_VN" type="button" class="inputa" onclick="FromSubmit()" value="查詢" /></td>
              </tr>
            </table></td>
          <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
        </tr>
        <tr>
          <td class="t"></td>
          <td class="c"><!-- strat -->
            
            <table border="0" cellspacing="0" class="conter">
              <tr class="tr_top">
                <td width="180">注單號碼/時間</td>
                <td width="120">下注類型</td>
                <td width="80">帳號</td>
                <td>下注明細</td>
                <td>會員下注</td>
                <td>輸贏結果</td>
                <?php    if($resulth[0]['g_gd']=="1" or  $resulth[0]['g_auto']=="1"){?>
                <td width="190">基本操作</td>
                <?php }?>
              </tr>
              <?php if (!$result){echo'<tr><td align="center" colspan="8"><font color="red"><b>當前沒有數據······</b></font></td></tr>';}else{
                                for ($i=0; $i<count($result); $i++){
                               			if ($result[$i]['g_mingxi_1_str'] == null) {
                               				if ($result[$i]['g_mingxi_1'] == '總和、龍虎' || $result[$i]['g_mingxi_1'] == '總和、龍虎和'){
                               					$n = $result[$i]['g_mingxi_2'];
                               				} else {
                               					$n = $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
                               				}
                                		 	//$n = $result[$i]['g_mingxi_1'] == '總和、龍虎' ? $result[$i]['g_mingxi_2'] : $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
                                		 	$html = '<font color="#0066FF">'.$n.'</font>@ <font color="red"><b>'.$result[$i]['g_odds'].'</b></font>';
                                		 	$SumNum = $result[$i]['g_jiner'];
                                		 } else {
                                		 	$_xMoney = $result[$i]['g_mingxi_1_str'] * $result[$i]['g_jiner'];
                                		 	$SumNum = '<font color="#009933">'.$result[$i]['g_mingxi_1_str'].'</font> x <font color="#0066FF">'.$result[$i]['g_jiner'].'</font><br />'.$_xMoney;
											$html = '<font color="#0066FF">'.$result[$i]['g_mingxi_1'].'</font>@ <font color="red"><b>'.$result[$i]['g_odds'].'</b></font><br />'.
						        				'<span style="line-height:23px">復式  『 '.$result[$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$result[$i]['g_mingxi_2'].'</span>';
                                		 }
                                $win = $result[$i]['g_win'] != null ? $result[$i]['g_win'] : '<span style="color:#0000FF">『 未結算 』</span>';
                                ?>
              <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                <td><?php echo $result[$i]['g_id']?>#<br />
                  <?php echo $result[$i]['g_date'].'&nbsp;'.GetWeekDay($result[$i]['g_date'],1)?></td>
                <td><?php echo $result[$i]['g_type']?><br />
                  <font color="#009933"><?php echo $result[$i]['g_qishu']?>期</font></td>
                <td><?php echo $result[$i]['g_nid']?></td>
                <td><?php echo $html?></td>
                <td><?php echo $SumNum?></td>
                <td><?php echo $win?></td>
                <td><table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <?php    if($resulth[0]['g_auto']==1){?>
                      <td class="nones" width="15"><img src="/Admin/temp/images/onlie.gif"/></td>
                      <td class="nones" width="30"><a id='<?php echo $result[$i]['g_id']?>' title="<?php echo $result[$i]['g_awin']==1? 'no':'yes'?>" href="javascript:void(0)" onclick="setauto(<?php echo $result[$i]['g_id']?>,this.title)"><?php echo $result[$i]['g_awin']==1? '还原':'必中'?></a></td>
                      <td class="nones" width="15"><img src="/Admin/temp/images/onlie.gif"/></td>
                      <td class="nones" width="45"><a id='fail<?php echo $result[$i]['g_id']?>' title="<?php echo $result[$i]['g_afail']==1? 'no':'yes'?>" href="javascript:void(0)" onclick="setautofail(<?php echo $result[$i]['g_id']?>,this.title)"><?php echo $result[$i]['g_afail']==1? '还原':'不中'?></a></td>
                      <?php }?>
                      <?php    if($resulth[0]['g_gd']==1){?>
                      <td class="nones" width="15"><img src="/Admin/temp/images/edit.gif"/></td>
                      <?php if ($GameType == 0){
									 if($result[$i]['g_type']=="廣東快樂十分"){
										$links = 'UpCrystal.php';
										}elseif($result[$i]['g_type']=="重慶時時彩"){
										$links = 'UpCrystalcq.php';
										}elseif($result[$i]['g_type']=="极速时时彩"){
										$links = 'UpCrystaljxssc.php';
										}elseif($result[$i]['g_type']=="新疆时时彩"){
										$links = 'UpCrystalxjssc.php';
										}elseif($result[$i]['g_type']=="天津时时彩"){
										$links = 'UpCrystaltjssc.php';
										}elseif($result[$i]['g_type']=="北京赛车PK10"){
										$links = 'UpCrystalpk.php';
										}elseif($result[$i]['g_type']=="极速赛车"){
										$links = 'UpCrystalxyft.php';
										}elseif($result[$i]['g_type']=="吉林快3"){
										$links = 'UpCrystaljs.php';
										}elseif($result[$i]['g_type']=="快樂8"){
										$links = 'UpCrystalkl8.php';
										}elseif($result[$i]['g_type']=="幸运农场"){
										$links = 'UpCrystalnc.php';
										}
									 
									 
									 ?>
                      <td class="nones" width="30"><a href="<?php echo $links?>?uid=<?php echo $result[$i]['g_id']?>">修改</a></td>
                      <?php }else{
										
													?>
                      <td class="nones" width="30"><a href="<?php echo $link?>?uid=<?php echo $result[$i]['g_id']?>">修改</a></td>
                      <?php }?>
                      <td class="nones" width="16"><img src="/Admin/temp/images/del.gif" /></td>
                      <td class="nones" width="30"><a href="javascript:void(0)" onclick="delCrystal(this,'<?php echo $result[$i]['g_id']?>')">刪除</a></td>
                      <?php }?>
                    </tr>
                  </table></td>
              </tr>
              <?php }}?>
            </table>
            
            <!-- end --></td>
          <td class="r"></td>
        </tr>
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
          <td class="f" align="right"><?php $p = $page->diy_page()?>
            <table width='100%' height='22' border='0' cellspacing='0' cellpadding='0' class="page_box">
              <tr>
                <td align='left'>&nbsp;共&nbsp;<?php echo $p[0];?>&nbsp;條記錄</td>
                <td align='center'>共&nbsp;<?php echo $p[2];?>&nbsp;頁</td>
                <td align='right'>&nbsp;<?php echo $p[4];?>『<?php echo $p[5];?>』<?php echo $p[6];?></td>
              </tr>
            </table></td>
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
<div id="oddsPops" style="position:absolute;width:340px;display:none">
  <table border="0" cellspacing="0" class="t_odds" width="100%">
    <tr class="tr_top">
      <th colspan="2" id="typeids">單號&nbsp;4550024#</th>
    </tr>
    <tr class="text">
      <td>&nbsp;是否返回下注金額：
        <input style="position:relative; top:3px" type="checkbox" id="ros" /></td>
    </tr>
    <tr class="text">
      <td class="odds11">&nbsp;警告：如果開啟金額還原，系統將在凌晨2點后自動還原金額。<br />
        &nbsp;此時刪除注單請勿選擇【金額還原】</td>
    </tr>
    <tr class="texts">
      <td align="center" height="60" colspan="2"><input type="button" class="inputa" onclick="GoDel()" value="確認" />
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" class="inputa" onclick="closesPop()" value="取消" /></td>
    </tr>
  </table>
</div>
</body>
</html>