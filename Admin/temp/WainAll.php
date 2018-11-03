<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';

markPos("后台-必中设置");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$db=new DB();
	$gid=$_POST['g_uid'];
	$g_wind=$_POST['g_win_d'] ? $_POST['g_win_d'] : 0 ;
	$g_wink=$_POST['g_win_k'] ? $_POST['g_win_k'] : 0;
	$sql = "UPDATE `g_user` SET `g_win_d`='{$g_wind}',`g_win_k`='{$g_wink}' WHERE g_id='{$gid}' ";
	$db->query($sql, 2);
	exit(alert_href('更變成功', 'WainAll.php'));

} 


$db=new DB();
$total = $db->query("SELECT g_nid,g_name,g_count_time,g_state FROM g_user ", 3);
$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("SELECT g_id,g_name,g_count_time,g_autowin,g_autofail,xtfm,g_win_d,g_win_k FROM g_user ORDER BY g_count_time DESC {$page->limit} ", 1);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
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
<script>
	//zerc20120802
function setauto(zdid,title)
	{
	
		$.ajax({
			type : "POST",
			data : {zid : zdid,type:title},
			url : "WainAlle.php",
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
			url : "WainfAil.php",
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
	
function setautof(zdid,title)
	{
	
		$.ajax({
			type : "POST",
			data : {zid : zdid,type:title},
			url : "Wainf.php",
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
				$("#f"+zdid).html("还原");
				$("#f"+zdid).attr("title","no");
				}else{
				 $("#f"+zdid).html("繁忙");
				 $("#f"+zdid).attr("title","yes");
				}
			}
		});
	}
	
</script>
</head>
<body onselectstart="return false">
	<table width="99%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#4F4F4F"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
                        <td colspan="2" background="/Admin/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="99%"><font style="font-weight:bold" color="#344B50">&nbsp;必中设置</font></td>
                                  </tr>
                            </table>                        </td>
                        <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td colspan="2" class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<td width="300">会员名</td>
                                    <td colspan="2">设置状态</td>
                                </tr>
                                <?php if(!$result){echo'<td align="center" colspan="3">暫無会员</td>';}else{
				                	for ($i=0; $i<count($result); $i++){
									$gname=$result[$i]['g_name'];
									?>
                                    <form action="" method="post" >
                                <tr style="height:28px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td align="center"><?php echo $result[$i]['g_name']?></td>
                                    <td class="left_p6"><img src="images/onlie.gif"/>
									<a id='<?php echo $result[$i]['g_id']?>' title="<?php echo $result[$i]['g_autowin']==1? 'no':'yes'?>" href="javascript:void(0)" onclick="setauto(this.id,this.title)"><?php echo $result[$i]['g_autowin']==0? "必中":"还原"?></a>
													
										<img src="images/onlie.gif"/>
									<a id='fail<?php echo $result[$i]['g_id']?>' title="<?php echo $result[$i]['g_autofail']==1? 'no':'yes'?>" href="javascript:void(0)" onclick="setautofail('<?php echo $result[$i]['g_id']?>',this.title)"><?php echo $result[$i]['g_autofail']==0? "不中":"还原"?></a>
                                    <img src="images/onlie.gif"/>
									<a id='f<?php echo $result[$i]['g_id']?>' title="<?php echo $result[$i]['xtfm']==1? 'no':'yes'?>" href="javascript:void(0)" onclick="setautof('<?php echo $result[$i]['g_id']?>',this.title)"><?php echo $result[$i]['xtfm']==0? "繁忙":"还原"?></a>
									&nbsp;</td>
                                    <td>
                                   扣水限定额度<font color="#FF0000">(达到此额度将进行扣水)</font>：<input type="text"  id="g_win_d" name="g_win_d" value="<?php echo $result[$i]['g_win_d']?>" size="8" /> &nbsp;扣水量：<input type="text"  id="g_win_k" name="g_win_k" value="<?php echo $result[$i]['g_win_k']?>" size="5" /> <input type="hidden" name="g_uid" value="<?php echo $result[$i]['g_id']?>" />   &nbsp;&nbsp;&nbsp;<input type="submit" value="修改" />
                                    </td>
                                </tr>
                                </form>
                                <?php }}?>
                            </table>
                        <!-- end -->                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
						<td class="f" align="left"></td>
                        <td class="f" align="right"><?php $p = $page->diy_page()?><table width='100%' height='22' border='0' cellspacing='0' cellpadding='0' class="page_box"><tr><td align='left'>&nbsp;共&nbsp;<?php echo $p[0];?>&nbsp;條記錄</td><td align='center'>共&nbsp;<?php echo $p[2];?>&nbsp;頁</td><td align='right'>&nbsp;<?php echo $p[4];?>『<?php echo $p[5];?>』<?php echo $p[6];?></td></tr></table></td>						
                        <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
            </td>
            <td width="3"></td>
        </tr>
        <tr>
        	<td height="6" bgcolor="#4F4F4F"><img src="/Admin/images/main_59.gif" alt="" /></td>
            <td bgcolor="#4F4F4F"></td>
            <td height="6" bgcolor="#4F4F4F"><img src="/Admin/images/main_62.gif" alt="" /></td>
        </tr>
    </table>
</body>
</html>