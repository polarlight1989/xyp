<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
markPos("后台-在线统计");
function get_page($name) {
	$db = new DB();
	
	if ($res = $db->query("SELECT g_page FROM g_login_log WHERE g_name='$name' ORDER BY `g_date` DESC LIMIT 1", 1)) {
		return $res[0]['g_page']; 
	}
	return "";
}

global $Users, $LoginId;
$gnidr=$Users[0]['g_nid'];
$gnid=$Users[0]['g_nid']."__";

$lid=5;
if(isset($_GET['lid'])){
$lid=$_GET['lid'];

}


$db=new DB();
if($lid==0){
$total1 = $db->query("SELECT g_name,g_f_name,g_count_time,g_out FROM g_user where g_out=1 and g_nid like '$gnidr%'", 3);
$total2 = $db->query("SELECT g_name,g_f_name,g_count_time,g_out FROM g_rank where g_out=1  and g_nid like '$gnidr%'", 3);
$total3 = $db->query("SELECT * FROM g_relation_user where g_out=1  and g_s_nid like '$gnidr%'", 3);
$total=$total1+$total2+$total3;

$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   (SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_mumber_type FROM g_user  where g_out=1 and g_nid like '$gnid%'  UNION  SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_login_id FROM g_rank where g_out=1 and g_nid like '$gnid%' UNION  SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_login_id FROM j_manage where g_out=1 and g_nid like '$gnid%'  UNION  SELECT g_s_name,g_s_f_name,g_count_time,g_out,g_ip,g_mumber_type FROM g_relation_user where g_out=1 and g_s_nid like '$gnidr%') as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else if($lid==1){
$total2 = $db->query("SELECT g_name,g_f_name,g_count_time,g_out FROM g_rank where g_out=1  and g_nid like '$gnidr%'", 3);
$total=$total2;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   ( SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_login_id as g_mumber_type  FROM g_rank where g_out=1 and g_nid like '$gnid%' and g_login_id=56 ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else if($lid==2){
$total2 = $db->query("SELECT g_name,g_f_name,g_count_time,g_out FROM g_rank where g_out=1  and g_nid like '$gnidr%'", 3);
$total=$total2;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   ( SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_login_id as g_mumber_type  FROM g_rank where g_out=1 and g_nid like '$gnid%' and g_login_id=22 ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else if($lid==3){
$total2 = $db->query("SELECT g_name,g_f_name,g_count_time,g_out FROM g_rank where g_out=1  and g_nid like '$gnidr%'", 3);
$total=$total2;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   ( SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_login_id  as g_mumber_type FROM g_rank where g_out=1 and g_nid like '$gnid%' and g_login_id=78 ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else if($lid==4){
$total2 = $db->query("SELECT g_name,g_f_name,g_count_time,g_out FROM g_rank where g_out=1  and g_nid like '$gnidr%'", 3);
$total=$total2;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   ( SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_login_id as g_mumber_type FROM g_rank where g_out=1 and g_nid like '$gnid%' and g_login_id=48 ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else if($lid==5){
$total1 = $db->query("SELECT g_name,g_f_name,g_count_time,g_out FROM g_user where g_out=1 and g_nid like '$gnidr%'", 3);
$total=$total1;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   ( SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_mumber_type FROM g_user  where g_out=1 and g_nid like '$gnid%'  ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);
}else if($lid==7){

$total1 = $db->query("SELECT g_name,g_f_name,g_count_time,g_out FROM j_manage where g_out=1 and g_name<>'bigsky' ", 3);
$total=$total1;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   ( SELECT g_name,g_f_name,g_count_time,g_out,g_ip FROM j_manage  where g_out=1  and g_name<>'bigsky'  ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);

}else{
$total3 = $db->query("SELECT * FROM g_relation_user where g_out=1  and g_s_nid like '$gnidr%'", 3);
$total=$total3;


$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("select   *   from   (  SELECT g_s_name,g_s_f_name,g_count_time,g_out,g_ip,g_mumber_type FROM g_relation_user where g_out=1 and g_s_nid like '$gnidr%' ) as a ORDER BY g_count_time DESC {$page->limit} ", 1);

}

$result123=$db->query("SELECT g_name,g_f_name,g_count_time,g_out FROM j_manage  where g_name<>'bigsky'  ",1);

$countuser=$db->query("SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_mumber_type FROM g_user  where g_out=1 and g_nid like '$gnid%'  ",1);

$countfen=$db->query("SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_login_id FROM g_rank where g_out=1 and g_nid like '$gnid%' and g_login_id=56 ",1);

$countgu=$db->query("SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_login_id FROM g_rank where g_out=1 and g_nid like '$gnid%' and g_login_id=22 ",1);

$countzd=$db->query("SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_login_id FROM g_rank where g_out=1 and g_nid like '$gnid%' and g_login_id=78 ",1);

$countdl=$db->query("SELECT g_name,g_f_name,g_count_time,g_out,g_ip,g_login_id FROM g_rank where g_out=1 and g_nid like '$gnid%' and g_login_id=48 ",1);


$countzzh=$db->query("SELECT g_s_name,g_s_f_name,g_count_time,g_out,g_ip,g_mumber_type FROM g_relation_user where g_out=1 and g_s_nid like '$gnidr%' ",1);

if ($LoginId== 89){
$resulth = $db->query("SELECT g_zhud,g_cj,g_gg FROM j_manage where g_name='{$name}'  ORDER BY g_id DESC LIMIT 1 ", 0);
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Admin/temp/js/search.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function showNews(){
		var show = document.getElementById("show");
		if (show.style.display == "none")
			show.style.display = "";
		else 
			show.style.display = "none";
	}
//-->
</script>
</head>
<body>
	<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="5" height="100%" bgcolor="#4F4F4F"></td>
    <td class="c"><table border="0" cellspacing="0" class="main">
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
          <td background="/Admin/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                <td width="99%"><font style="font-weight:bold" color="#344B50">&nbsp;在线統計</font></td>
              </tr>
          </table></td>
          <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
        </tr>
        <tr>
          <td class="t"></td>
          <td class="c"><!-- strat -->
            <table border="0" cellspacing="0" class="conter">
			    <tr class="tr_top">
                <?php    if($resulth[0][1]==1){?>	<td>管理</td>	<?php }?>				
                <td>分公司</td>
                <td>股東</td>
                <td>總代理</td>
                <td>代理</td>
                <td>会员</td>
                <td>子账号</td>
                </tr>
                <tr style="height:15px">	
			   <?php    if($resulth[0][1]==1){?>	
			    <td align="center">
				<a href="/Admin/temp/OnLine.php?lid=7" ><font color="#000000" style="font-size:114%"><strong><?php echo count($result123);?></strong></font></a>
                  </td>
				  <?php }?>				
			    <td align="center"><?php if ($LoginId==89){?>
				<a href="/Admin/temp/OnLine.php?lid=1" ><font color="#000000" style="font-size:114%"><strong><?php echo count($countfen);?></strong></font></a>
                  <?php }?></td>
                <td align="center"><?php if ($LoginId==89 || $LoginId==56){?>
                <a href="/Admin/temp/OnLine.php?lid=2" ><font color="#000000" style="font-size:114%"><strong><?php echo count($countgu);?></strong></font></a>
                  <?php }?></td>
                <td align="center"><?php if ($LoginId==89 || $LoginId==56 || $LoginId==22){?>
                <a href="/Admin/temp/OnLine.php?lid=3" ><font color="#000000" style="font-size:114%"><strong><?php echo count($countzd);?></strong></font></a>
                  <?php }?></td>
                <td align="center"><?php if ($LoginId==89 || $LoginId==56 || $LoginId==22 || $LoginId==78){?>
                <a href="/Admin/temp/OnLine.php?lid=4" ><font color="#000000" style="font-size:114%"><strong><?php echo count($countdl);?></strong></font></a>
                  <?php }?></td>
                <td align="center"><a href="/Admin/temp/OnLine.php?lid=5" ><font color="#000000" style="font-size:114%"><strong><?php echo count($countuser);?></strong></font></a></td>
                <td align="center"><a href="/Admin/temp/OnLine.php?lid=6" ><font color="#000000" style="font-size:114%"><strong><?php echo count($countzzh);?></strong></font></a></td>
                </tr>
			</table>
			</br>
            <?php if ($lid=="5"){?>
            
            <table border="0" cellspacing="0" class="conter">			
              <tr class="tr_top">
                  <td>帳號</td>
                    <td>名稱</td>
                    <td width="12%">可用金額</td>
                    <td width="12%">下註金额</td>
                    <td width="12%">今天输赢</td>
                    <td width="7%">刷新時間</td>
                    <td width="10%">IP</td>
                    <td width="10%">IP歸屬</td>
                    <td width="60">基本操作</td>                
              </tr>
              <?php if(!$result){echo'<td align="center" colspan="9"><font color="red"><center><b>當前沒有用戶在線······</b></center></font></td>';}else{
			  
				                	for ($i=0; $i<count($result); $i++){
									$gname=$result[$i]['g_name'];
									
									if(strtotime(date('Y-m-d H:i:s',time()))-strtotime($result[$i]['g_count_time'])>1800){
									//
									
									if($result[$i]['g_mumber_type']<10){
									$result1 = $db->query("update g_user  set g_out=0 where g_name='$gname'", 2);
									}
									if($result[$i]['g_mumber_type']>10&&$result[$i]['g_mumber_type']<89){
									$result1 = $db->query("update g_rank  set g_out=0 where g_name='$gname'", 2);
									}
									if($result[$i]['g_mumber_type']>=89)
									$result1 = $db->query("update j_manage  set g_out=0 where g_name='$gname'", 2);
									?>
              <tr style="height:28px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                
                <td align="left"><?php 
				                    echo $result[$i]['g_name'];
									if($lid!=6) $gname=$result[$i]['g_name'];
									else $gname=$result[$i]['g_s_name'];
									if($result[$i]['g_mumber_type']==89){
									echo '管理员';
									}else{
									if($result[$i]['g_mumber_type']==56){
									echo '分公司';
									}else{
									if($result[$i]['g_mumber_type']==22){
									echo '股東';
									}else{
									if($result[$i]['g_mumber_type']==78){	
									echo '總代理';
									}else{
									if($result[$i]['g_mumber_type']==48){
									echo '代理';
									}else{
									if($result[$i]['g_mumber_type']==1){
									echo '会员';
									}else{
									if($result[$i]['g_mumber_type']==0){
									$result2 = $db->query("select g_s_login_id from g_relation_user  where g_s_name='$gname'", 1);
								
									if($result2[0]['g_s_login_id']==89){
										echo 'admin管理员子账号';
									}else{
									$glid=$result2[0]['g_s_login_id'];
									$zizhanghao='子账号';
									switch($glid){
									case 56: $zizhanghao='分公司'.$zizhanghao;break;
									case 22: $zizhanghao='股東'.$zizhanghao;break;
									case 78: $zizhanghao='總代理'.$zizhanghao;break;
									case 48: $zizhanghao='代理'.$zizhanghao;break;
									}
									$result2 = $db->query("select g_name from g_rank  where g_login_id='{$glid}'", 1);
									
									echo $result2[0]['g_name'].$zizhanghao;
									}
									}else{
									$result2 = $db->query("select g_nid from g_user  where g_name='$gname'", 1);
									$value = mb_substr($result2[0]['g_nid'], 0, mb_strlen($result2[0]['g_nid'],'utf-8')-32);
									$result2 = $db->query("select g_name,g_f_name,g_login_id from g_rank  where g_nid='$value'", 1);
									$zhishu="直屬會員";
									$glid=$result2[0]['g_login_id'];
									switch($glid){
									case 56: $zhishu='分公司'.$zhishu;break;
									case 22: $zhishu='股東'.$zhishu;break;
									case 78: $zhishu='總代理'.$zhishu;break;
									case 48: $zhishu='代理'.$zhishu;break;
									}
									echo $result2[0]['g_name'].$zhishu;
									}
									}
									}
									}
									}
									}
									}
									?>
                </td>
                <td align="center"><?php echo $result[$i]['g_f_name']; ?></td>
                <td class="left_p6"  colspan="3"><img src="images/del.gif" />該會員30分鍾未有操作，系統定義不在線。</td>
                <td class="left_p6" align="center"><?php echo$result[$i]['g_count_time']?></td> 
                <td class="left_p6" align="center"><?php
									$qqWryInfo = ROOT_PATH.'tools/IpApi/QQWry.Dat';
									$ip_s = ipLocation($result[$i]['g_ip'], $qqWryInfo);
									 echo $result[$i]['g_ip'];?>
                &nbsp;</td>
                
              <td class="left_p6" align="center"><?php echo $ip_s;?></td>
               <td class="left_p6" align="left">自動踢出</td>
              </tr>
              <?php 
									}else{
				                	?>
              <tr style="height:15px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                <td align="left"><?php echo $lid!=6? $result[$i]['g_name']:$result[$i]['g_s_name'];?>(<?php 
									if($lid!=6) $gname=$result[$i]['g_name'];
									else $gname=$result[$i]['g_s_name'];
									if($result[$i]['g_mumber_type']==89){
									$lid=0;
									}else{
									if($result[$i]['g_mumber_type']<89&&$result[$i]['g_mumber_type']>9){
									$lid=1;
									}else{
									if($result[$i]['g_mumber_type']<9&&$result[$i]['g_mumber_type']>0)
									$lid=2;
									else
									$lid=3;
									}
									}
									if($result[$i]['g_mumber_type']==89){
									echo '管理员';
									}else{
									if($result[$i]['g_mumber_type']==56){
									echo '分公司';
									}else{
									if($result[$i]['g_mumber_type']==22){
									echo '股東';
									}else{
									if($result[$i]['g_mumber_type']==78){	
									echo '總代理';
									}else{
									if($result[$i]['g_mumber_type']==48){
									echo '代理';
									}else{
									if($result[$i]['g_mumber_type']==1){
									echo '会员';
									}else{
									if($result[$i]['g_mumber_type']==0){
									$result2 = $db->query("select g_s_login_id from g_relation_user  where g_s_name='$gname'", 1);
									if($result2[0]['g_s_login_id']==89){
										echo 'admin管理员子账号';
									}else{
									$glid=$result2[0]['g_s_login_id'];
									$zizhanghao='子账号';
									switch($glid){
									case 56: $zizhanghao='分公司'.$zizhanghao;break;
									case 22: $zizhanghao='股東'.$zizhanghao;break;
									case 78: $zizhanghao='總代理'.$zizhanghao;break;
									case 48: $zizhanghao='代理'.$zizhanghao;break;
									}
									$result2 = $db->query("select g_name from g_rank  where g_login_id='{$glid}'", 1);
									echo $result2[0]['g_name'].$zizhanghao;
									}
									}else{
									$result2 = $db->query("select g_nid from g_user  where g_name='$gname'", 1);
									$value = mb_substr($result2[0]['g_nid'], 0, mb_strlen($result2[0]['g_nid'],'utf-8')-32);
									$result2 = $db->query("select g_name,g_f_name,g_login_id from g_rank  where g_nid='$value'", 1);
									$zhishu="直屬會員";
									$glid=$result2[0]['g_login_id'];
									switch($glid){
									case 56: $zhishu='分公司'.$zhishu;break;
									case 22: $zhishu='股東'.$zhishu;break;
									case 78: $zhishu='總代理'.$zhishu;break;
									case 48: $zhishu='代理'.$zhishu;break;
									}
									echo $result2[0]['g_name'].$zhishu;
									}
									}
									}
									}
									}
									}
									}

								
									?>
                )</td>
                <td class="left_p6" align="center"><?php echo $result[$i]['g_f_name']; ?> (<?php echo get_page($result[$i]['g_name']);?>)</td>
                <td class="left_p6"  align="center"><?php echo number_format(GetUser_KY_Count ($result[$i]['g_name']),1);?>
                &nbsp;</td>
                <td class="left_p6" align="center"><a href="MemberAccounts.php?det=0&name=<?php echo $result[$i]['g_name'];?>" class="seet" target="_blank" title="查看未結算明細"><?php echo number_format(User_null($result[$i]['g_name']),1);?></a></td> 
                <td class="left_p6" align="center"><a href="MemberAccounts.php?det=1&name=<?php echo $result[$i]['g_name'];?>" class="seet" target="_blank" title="查看已結算明細"><span class="<?php if (gettdwin($result[$i]['g_name'])>0){echo "green";}else{echo "red";}?>"><?php echo number_format(gettdwin($result[$i]['g_name']),1);?></span></a></td>   
                <td class="left_p6" align="center"><?php echo$result[$i]['g_count_time']?></td>
                <td class="left_p6" align="center"><?php
									$qqWryInfo = ROOT_PATH.'tools/IpApi/QQWry.Dat';
									$ip_s = ipLocation($result[$i]['g_ip'], $qqWryInfo);
									 echo $result[$i]['g_ip']?>&nbsp;</td>
                <td class="left_p6" align="center"><?php echo $ip_s;?>&nbsp;</td>
				<td>
                <div><span class="left_p6" align="left"><img src="images/55.gif" width="14" height="14" /></span>&nbsp;<span><a  href="javascript:window.location.reload();" title="登出" class="closepo" onclick="closeUser('<?php echo$result[$i]['g_name'] ?>',this,'<?php echo$lid ?>')" >登出</a></span></div>
				</td>
              </tr>
              <?php }}}?>
            </table>
            <?php }else{?>
            
             <table border="0" cellspacing="0" class="conter">			
              <tr class="tr_top">
              <td width="3%">ID</td>
                    <td>帳號</td>
                    <td>名稱</td>
                    <td width="7%">刷新時間</td>
                    <td width="10%">IP</td>
                    <td width="10%">IP歸屬</td>
                    <td width="60">操作</td>
              </tr>
              <?php if(!$result){echo'<td align="center" colspan="7"><font color="red"><center><b>當前沒有用戶在線······</b></center></font></td>';}else{
			  
				                	for ($i=0; $i<count($result); $i++){
									if($lid!=6) $gname=$result[$i]['g_name'];
									else $gname=$result[$i]['g_s_name'];
									if(strtotime(date('Y-m-d H:i:s',time()))-strtotime($result[$i]['g_count_time'])>1800){
									if($result[$i]['g_mumber_type']<10){
									$result1 = $db->query("update g_user  set g_out=0 where g_name='$gname'", 2);
									}
									if($result[$i]['g_mumber_type']>10&&$result[$i]['g_mumber_type']<89){
									$result1 = $db->query("update g_rank  set g_out=0 where g_name='$gname'", 2);
									}
									if($result[$i]['g_mumber_type']>=89)
									$result1 = $db->query("update j_manage  set g_out=0 where g_name='$gname'", 2);
									if($result[$i]['g_mumber_type']==0)
									$result1 = $db->query("update g_relation_user  set g_out=0 where g_s_name='$gname'", 2);
									?>
              <tr style="height:28px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                <td align="center"><?php echo $i+1;?></td>
                <td align="center"><?php echo $lid!=6? $result[$i]['g_name']:$result[$i]['g_s_name'];?>(<?php 
									if($lid!=6) $gname=$result[$i]['g_name'];
									else $gname=$result[$i]['g_s_name'];
									if($result[$i]['g_mumber_type']==89){
									echo '管理员';
									}else{
									if($result[$i]['g_mumber_type']==56){
									echo '分公司';
									}else{
									if($result[$i]['g_mumber_type']==22){
									echo '股東';
									}else{
									if($result[$i]['g_mumber_type']==78){	
									echo '總代理';
									}else{
									if($result[$i]['g_mumber_type']==48){
									echo '代理';
									}else{
									if($result[$i]['g_mumber_type']==1){
									echo '会员';
									}else{
									if($result[$i]['g_mumber_type']==0){
									$result2 = $db->query("select g_s_login_id from g_relation_user  where g_s_name='$gname'", 1);
								
									if($result2[0]['g_s_login_id']==89){
										echo 'admin管理员子账号';
									}else{
									$glid=$result2[0]['g_s_login_id'];
									$zizhanghao='子账号';
									switch($glid){
									case 56: $zizhanghao='分公司'.$zizhanghao;break;
									case 22: $zizhanghao='股東'.$zizhanghao;break;
									case 78: $zizhanghao='總代理'.$zizhanghao;break;
									case 48: $zizhanghao='代理'.$zizhanghao;break;
									}
									$result2 = $db->query("select g_name from g_rank  where g_login_id='{$glid}'", 1);
									
									echo $result2[0]['g_name'].$zizhanghao;
									}
									}else{
									$result2 = $db->query("select g_nid from g_user  where g_name='$gname'", 1);
									$value = mb_substr($result2[0]['g_nid'], 0, mb_strlen($result2[0]['g_nid'],'utf-8')-32);
									$result2 = $db->query("select g_name,g_f_name,g_login_id from g_rank  where g_nid='$value'", 1);
									$zhishu="直屬會員";
									$glid=$result2[0]['g_login_id'];
									switch($glid){
									case 56: $zhishu='分公司'.$zhishu;break;
									case 22: $zhishu='股東'.$zhishu;break;
									case 78: $zhishu='總代理'.$zhishu;break;
									case 48: $zhishu='代理'.$zhishu;break;
									}
									echo $result2[0]['g_name'].$zhishu;
									}
									}
									}
									}
									}
									}
									}
									?>)</td>
                <td align="center"><?php echo $result[$i]['g_f_name']; ?>                </td>
                <td class="left_p6"><img src="images/del.gif" />該會員30分鍾未有操作，系統定義不在線。</td>
                  <td class="left_p6" align="center"><?php
									$qqWryInfo = ROOT_PATH.'tools/IpApi/QQWry.Dat';
									$ip_s = ipLocation($result[$i]['g_ip'], $qqWryInfo);
									 echo $result[$i]['g_ip'];?>
                  &nbsp;</td>
                <td class="left_p6" align="center"><?php echo $ip_s;?></td> 
               <td class="left_p6" align="left">自動踢出</td>
              </tr>
              <?php 
			 }else if($lid==6){
				                	?>
              <tr style="height:15px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
              <td align="center"><?php echo $i+1;?></td>
                <td align="left">&nbsp;<?php echo $result[$i]['g_s_name'];?>(<?php 
									
									$gname=$result[$i]['g_s_name'];
									
									
									if($result[$i]['g_mumber_type']==89){
									echo '管理员';
									}else{
									if($result[$i]['g_mumber_type']==56){
									echo '分公司';
									}else{
									if($result[$i]['g_mumber_type']==22){
									echo '股東';
									}else{
									if($result[$i]['g_mumber_type']==78){	
									echo '總代理';
									}else{
									if($result[$i]['g_mumber_type']==48){
									echo '代理';
									}else{
									if($result[$i]['g_mumber_type']==1){
									echo '会员';
									}else{
									if($result[$i]['g_mumber_type']==0){
									$result2 = $db->query("select g_s_login_id from g_relation_user  where g_s_name='$gname'", 1);
									if($result2[0]['g_s_login_id']==89){
										echo 'admin管理员子账号';
									}else{
									$glid=$result2[0]['g_s_login_id'];
									$zizhanghao='子账号';
									switch($glid){
									case 56: $zizhanghao='分公司'.$zizhanghao;break;
									case 22: $zizhanghao='股東'.$zizhanghao;break;
									case 78: $zizhanghao='總代理'.$zizhanghao;break;
									case 48: $zizhanghao='代理'.$zizhanghao;break;
									}
									$result2 = $db->query("select g_name from g_rank  where g_login_id='{$glid}'", 1);
									echo $result2[0]['g_name'].$zizhanghao;
									}
									}else{
									$result2 = $db->query("select g_nid from g_user  where g_name='$gname'", 1);
									$value = mb_substr($result2[0]['g_nid'], 0, mb_strlen($result2[0]['g_nid'],'utf-8')-32);
									$result2 = $db->query("select g_name,g_f_name,g_login_id from g_rank  where g_nid='$value'", 1);
									$zhishu="直屬會員";
									$glid=$result2[0]['g_login_id'];
									switch($glid){
									case 56: $zhishu='分公司'.$zhishu;break;
									case 22: $zhishu='股東'.$zhishu;break;
									case 78: $zhishu='總代理'.$zhishu;break;
									case 48: $zhishu='代理'.$zhishu;break;
									}
									echo $result2[0]['g_name'].$zhishu;
									}
									}
									}
									}
									}
									}
									}

								
									?>
                )</td>
                <td align="center"><?php echo $result[$i]['g_s_f_name']; ?> (<?php echo get_page($result[$i]['g_s_name']);?>)</td>
                <td class="left_p6"><?php echo$result[$i]['g_count_time']?></td>
                <td class="left_p6" align="center"><?php
									$qqWryInfo = ROOT_PATH.'tools/IpApi/QQWry.Dat';
									$ip_s = ipLocation($result[$i]['g_ip'], $qqWryInfo);
									 echo $result[$i]['g_ip'];?>                  &nbsp;</td>
                <td class="left_p6" align="center"><?php echo $ip_s;?></td>
				<td>
                <div><span class="left_p6" align="left"><img src="images/55.gif" width="14" height="14" /></span>&nbsp;<span><a  href="javascript:window.location.reload();" title="登出" class="closepo" onclick="closeUser('<?php echo$result[$i]['g_s_name'] ?>',this,'<?php echo$lid ?>')" >登出</a></span></div>				</td>
              </tr>
              <?php }else{ 	                	?>
              <tr style="height:15px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
              <td align="center"><?php echo $i+1;?></td>
                <td align="left">&nbsp;<?php echo $lid!=6? $result[$i]['g_name']:$result[$i]['g_s_name'];?>(<?php 
									if($lid!=6) $gname=$result[$i]['g_name'];
									else $gname=$result[$i]['g_s_name'];
									if($result[$i]['g_mumber_type']==89){
									$lid=0;
									}else{
									if($result[$i]['g_mumber_type']<89&&$result[$i]['g_mumber_type']>9){
									$lid=1;
									}else{
									if($result[$i]['g_mumber_type']<9&&$result[$i]['g_mumber_type']>0)
									$lid=2;
									else
									$lid=3;
									}
									}
									if($result[$i]['g_mumber_type']==89){
									echo '管理员';
									}else{
									if($result[$i]['g_mumber_type']==56){
									echo '分公司';
									}else{
									if($result[$i]['g_mumber_type']==22){
									echo '股東';
									}else{
									if($result[$i]['g_mumber_type']==78){	
									echo '總代理';
									}else{
									if($result[$i]['g_mumber_type']==48){
									echo '代理';
									}else{
									if($result[$i]['g_mumber_type']==1){
									echo '会员';
									}else{
									if($result[$i]['g_mumber_type']==0){
									$result2 = $db->query("select g_s_login_id from g_relation_user  where g_s_name='$gname'", 1);
									if($result2[0]['g_s_login_id']==89){
										echo 'admin管理员子账号';
									}else{
									$glid=$result2[0]['g_s_login_id'];
									$zizhanghao='子账号';
									switch($glid){
									case 56: $zizhanghao='分公司'.$zizhanghao;break;
									case 22: $zizhanghao='股東'.$zizhanghao;break;
									case 78: $zizhanghao='總代理'.$zizhanghao;break;
									case 48: $zizhanghao='代理'.$zizhanghao;break;
									}
									$result2 = $db->query("select g_name from g_rank  where g_login_id='{$glid}'", 1);
									echo $result2[0]['g_name'].$zizhanghao;
									}
									}else{
									$result2 = $db->query("select g_nid from g_user  where g_name='$gname'", 1);
									$value = mb_substr($result2[0]['g_nid'], 0, mb_strlen($result2[0]['g_nid'],'utf-8')-32);
									$result2 = $db->query("select g_name,g_f_name,g_login_id from g_rank  where g_nid='$value'", 1);
									$zhishu="直屬會員";
									$glid=$result2[0]['g_login_id'];
									switch($glid){
									case 56: $zhishu='分公司'.$zhishu;break;
									case 22: $zhishu='股東'.$zhishu;break;
									case 78: $zhishu='總代理'.$zhishu;break;
									case 48: $zhishu='代理'.$zhishu;break;
									}
									echo $result2[0]['g_name'].$zhishu;
									}
									}
									}
									}
									}
									}
									}

								
									?>
                )</td>
                <td align="center"><?php echo $result[$i]['g_f_name']; ?> (<?php echo get_page($result[$i]['g_name']);?>)</td>
                <td class="left_p6"><?php echo$result[$i]['g_count_time']?></td>
                <td class="left_p6" align="center"><?php
									$qqWryInfo = ROOT_PATH.'tools/IpApi/QQWry.Dat';
									$ip_s = ipLocation($result[$i]['g_ip'], $qqWryInfo);
									 echo $result[$i]['g_ip'];?>                  &nbsp;</td>
                <td class="left_p6" align="center"><?php echo $ip_s;?></td>
				<td>
                <div><span class="left_p6" align="left"><img src="images/55.gif" width="14" height="14" /></span>&nbsp;<span><a  href="javascript:window.location.reload();" title="登出" class="closepo" onclick="closeUser('<?php echo$result[$i]['g_name'] ?>',this,'<?php echo$lid ?>')" >登出</a></span></div>				</td>
              </tr>
              <?php }}}?>
            </table>
            
            <?php }?>
            
            
            <!-- end -->
          </td>
          <td class="r"></td>
        </tr>
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
          <td class="f" align="right"><?php $p = $page->diy_page()?><table width='100%' height='22' border='0' cellspacing='0' cellpadding='0' class="page_box"><tr><td align='left'>&nbsp;共&nbsp;<?php echo $p[0];?>&nbsp;個用戶</td><td align='center'>共&nbsp;<?php echo $p[2];?>&nbsp;頁</td><td align='right'>&nbsp;<?php echo $p[4];?>『<?php echo $p[5];?>』<?php echo $p[6];?></td></tr></table></td>					
		  
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
