<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
global $ConfigModel,$Users;
	$db = new DB();

markPos("后台-日志查询");
if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_1'])){
	if ($Users[0]['g_lock_1_1'] !=1) 
		exit(back('您的權限不足！'));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Admin/temp/js/search.js"></script>
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<title></title>
<script type="text/javascript">
<!--
	function isForm(){
		if (confirm("確認更變嗎？"))
				return true;
		return false;
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
                                    <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="99%"><font style="font-weight:bold" color="#344B50">&nbsp;日誌管理</font></td>
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
                                	<td width="4%" align="center">ID</td>
                                  <td width="8%" align="center">操作帳號</td>
                                  <td  width="18%"align="center">變更時間</td>
                                  <td align="center">變更內容</td>
                                  <td width="12%" align="center">IP</td>
                                  <td width="15%" align="center">ip歸屬</td>
                                   <td width="4%" align="center">狀態</td>
                        </tr>
                              <?php
							  $now2=date("Y-m-d",strtotime("-7 day"));
							  $now3=$now2.' 00:00';
	 $result = mysql_query("select g_nid,g_date,g_type,g_qishu,g_jiner,g_odds,g_mingxi_1,g_mingxi_2,mxmd,mxsha1 from g_zhudan1 where g_date>'{$now3}' order by g_id desc");   
while($rs = mysql_fetch_array($result)){

$checkout=md5($rs['g_type']."@".$rs['g_mingxi_1']."@".$rs['g_mingxi_2']."$".$rs['g_jiner']);

if ($checkout!=$rs['mxsha1']){							  

					  
?>
                                       <tr style="height:28px">
                                	<td   align="center" ><?php echo $rs['g_id1'];?></td>
                                  <td  align="center" ><?php echo $rs['g_name1'];?></td>
                                  <td align="center" ><?php echo $rs['g_date1'];?></td>
                                  <td  align="left" ><?php echo $rs['g_qishu1'];?></td>
                                  <td align="center" ><?php echo $rs['g_jiner1'];?></td>
                                  <td align="center" ><?php echo $rs['g_odds1'];?></td>
                                  <td align="center" ><?php echo $rs['g_mingxi_11'];?></td>
                       </tr>
                          <?php }}?> 
                          </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="right">
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