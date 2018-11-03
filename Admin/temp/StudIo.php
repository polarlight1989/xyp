<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $Users;
markPos("后台-后台帐号管理");
$lock_6 =false;
if (isset($Users[0]['g_lock_6'])){
	$lock_6 = true;
	if ($Users[0]['g_lock_6'] != 1)
		exit(back('您的權限不足！'));
}
if ($LoginId!= 89){
	exit(back('您的權限不足！'));
}
$db=new DB();
if (isset($_GET['del']))
{
	if ($db->query("SELECT g_id FROM j_manage LIMIT 1", 0))
	{
		$db->query("DELETE FROM j_manage WHERE g_id = {$_GET['del']} LIMIT 1", 2);
		exit(alert_href('刪除成功', 'StudIo.php'));
	} 
	else 
	{
		exit(alert_href('用戶不存在！', 'StudIo.php'));
	}
} 

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	
    if ($_GET['gm']=="add")
	{
	$nameadd=$_POST['addname'];
	$sql = "INSERT INTO `j_manage` ( `g_login_id` , `g_nid` , `g_name` )VALUES ('89','67552ea64c6dce1646a263bae714e788','{$nameadd}'
)";
	$db->query($sql, 2);
	exit(alert_href('添加成功', 'StudIo.php'));
	
	}else{	
	$gid=$_POST['guid'];
	$gmauto=$_POST['gauto'] ? $_POST['gauto'] : 0 ;
	$gmgd=$_POST['ggd'] ? $_POST['ggd'] : 0;
	$gname=$_POST['gname'];
	$gfname=$_POST['gfname'];
	$gzhud=$_POST['gzhud'] ? $_POST['gzhud'] : 0;
    if ($_POST['gmpass']!=""){
	$gmpass=sha1($_POST['gmpass']);
	$sql = "UPDATE `j_manage` SET `g_password`='{$gmpass}' WHERE g_id='{$gid}' ";
	$db->query($sql, 2);
	}
	if ($_POST['passcode']!=""){
	$sql = "UPDATE `j_manage` SET `g_code`='{$_POST['passcode']}' WHERE g_id='{$gid}' ";
	$db->query($sql, 2);
	}
	
	
	$gg_gg=$_POST['ggg'] ? $_POST['ggg'] : 0 ;
	$gcj=$_POST['gcj'] ? $_POST['gcj'] : 0 ;
	$sql = "UPDATE `j_manage` SET `g_name`='{$gname}',`g_f_name`='{$gfname}',`g_auto`='{$gmauto}',`g_gg`='{$gg_gg}',`g_gd`='{$gmgd}',`g_zhud`='{$gzhud}',`g_cj`='{$gcj}' WHERE g_id='{$gid}' ";
//dump($sql);
	$db->query($sql, 2);

	exit(alert_href('更變成功', 'StudIo.php'));
	}
	
} 
if ($LoginId== 89){
$resulth = $db->query("SELECT g_cj FROM j_manage where g_name='{$name}'  ORDER BY g_id DESC LIMIT 1 ", 0);
} 
if ($resulth[0][0]!=1){
$chaoji="and g_cj!=1";
}


	$result = $db->query("SELECT g_id, g_name, g_f_name,g_count_time,g_gg,g_auto, g_gd,g_zhud,g_code,g_cj FROM 
	j_manage where g_name<>'bigsky' {$chaoji} ORDER BY g_id DESC", 1);
	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Admin/temp/js/search.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function deluser(id){
		if (confirm("確定刪除嗎？")){
			location.href = location.href+"?del="+id;
		}
	}
	
	

function locationFile(strInt){
	_sType = strInt;
	var oddsPop = $("#oddsPops"+_sType);
	var offsetTop = event.y; 
	var offsetLeft = event.x-135; 
	oddsPop.slideDown(200).css({top : offsetTop, left : offsetLeft, "display" : ""});
}

function diplaydiv(strInt){
	_sType = strInt;
	var oddsPop = $("#oddsPops"+_sType);
	oddsPop.slideDown(200).css({"display" : "none"});
}



function changeAjax(type,uid,utype,utNum){
	$.ajax({
			type : "POST",
			data : {type : type,uid:uid,utype:utype},
			url : "setZT.php",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						changeAjax(type,uid,utype);
						return false;
					}
				}
			},
			success:function(data){
			//	if(data==1){
			//	alert("金额还原成功!");
			//	}else{
			//	alert("金额还原失败!");
				//}
				var utb = $("#ut"+utNum);
				utb.val(data);
				_sType = utNum;
				var oddsPop = $("#oddsPops"+_sType);
				oddsPop.slideDown(200).css({"display" : "none"});
			}
		});
}
-->
</script>
</head>
<body onselectstart="return false">
	<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="5" height="100%" bgcolor="#4F4F4F"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Admin/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="16"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td>&nbsp;后台帳號管理</td>
                                   
                                    <td><font color="#FF0000">注意：安全码及密码,如不修改密码请保持为空!!!</font></td>
                                      <form action="StudIo.php?gm=add" method="post" ><td align="right">添加管理：&nbsp;<input type="text" name="addname" value="" size="8" />&nbsp;<input type="submit" class="inputs" value="添加" /></td></form>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<td width="30">在綫</td>
                                    <td>帳號</td>
                                    <td>名稱</td>
                                    <td>密码</td>
                                     <td>安全码</td>
                                    <td>活动时间</td>
                                     <td>功能狀態</td>

            						<td width="150">操作</td>
            					
                                </tr>
                               
                                <?php if (!$result){echo '<tr><td colspan="6" align="center">暫無記錄</td></tr>';} else {
                                for ($i=0; $i<count($result); $i++){?>
                                 <form action="" method="post" >
                                <tr onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td width="30">
                                	<?php 
                                		if ($result[$i]['g_out'] == 1){
                                			echo "<img  class=\"closepo\" src=\"/Admin/temp/images/USER_1.gif\" />";
                                		} else {
                                			echo '<img src="/Admin/temp/images/USER_0.gif" />';
                                		}
                                	?>
                                	</td>
                                    <td><input type="text" name="gname" value="<?php echo $result[$i]['g_name']?>" size="8" /><?php if ($result[$i]['g_cj']==1){echo "<font color=red><b>★</b></font>";}?></td>
                                    <td><input type="text" name="gfname" value="<?php echo $result[$i]['g_f_name']?>" size="4" /></td>
                                      <td><input type="password" name="gmpass" value="" size="8"  /></td>
                                       <td><input type="password" name="passcode" value="" size="4"  /></td>
                                    <td><?php echo $result[$i]['g_count_time']?></td>
                                        <td>公告:<input <?php if($result[$i]['g_gg']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="ggg" value="1" />&nbsp; &nbsp;必中/不中:<input <?php if($result[$i]['g_auto']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="gauto" value="1" />&nbsp; &nbsp;修改注单/删除：<input <?php if($result[$i]['g_gd']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="ggd" value="1" />&nbsp;&nbsp;注单校验/被删：<input <?php if($result[$i]['g_zhud']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="gzhud" value="1" /><?php if($resulth[0][0]==1){ ?>&nbsp;&nbsp;超级用户：<input <?php if($result[$i]['g_cj']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="gcj" value="1" /> <?php }?> </td>
                                         <input type="hidden" name="guid" value="<?php echo $result[$i]['g_id']?>" />            						<td>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                    <td class="nones" width="15"><img src='/Admin/temp/images/edit.gif'/></td>
                                                    <td class="nones" width="30"><input type="submit" value="修改" /></td>
                                                    <td class="nones" width="16"><img src='/Admin/temp/images/55.gif'/></td>
                                                    <td class="nones" width="30"><a href="LoginLog.php?uid=<?php echo $result[$i]['g_name']?>">日誌</a></td>
                                                    <td class="nones" width="16"><img src='/Admin/temp/images/44.gif'/></td>
                                                    <td class="nones" width="26"><a href="javascript:void(0)" onclick="deluser('<?php echo $result[$i]['g_id']?>')">刪除</a></td>
                                               
                                                 
                                              </tr>
                                        </table>
                                    </td>
            						
                                </tr>
                                </form>
                                <?php }}?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="right"></td>
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