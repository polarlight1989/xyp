<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
include_once ROOT_PATH.'functioned/peizhi.php';
global $ConfigModel,$Users;
$db=new DB();
markPos("后台-默认退水设置");
if ($Users[0]['g_login_id'] != 89) exit;
if (isset($Users[0]['g_lock_1_1'])){
	if ($Users[0]['g_lock_1_1'] !=1) 
		exit(back('您的權限不足！'));
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$sql="update g_send_back_default Set g_a_limit='".$_POST['g_a_limit']."',g_b_limit='".$_POST['g_b_limit']."',g_c_limit='".$_POST['g_c_limit']."',g_d_limit='".$_POST['g_d_limit']."',g_e_limit='".$_POST['g_e_limit']."'  where g_game_id=1 or g_game_id=9 ";
	$exe=mysql_query($sql) or  die("数据库修改出错");
	
	$sql="update g_send_back_default Set g_a_limit='".$_POST['g_a_limitl']."',g_b_limit='".$_POST['g_b_limitl']."',g_c_limit='".$_POST['g_c_limitl']."',g_d_limit='".$_POST['g_d_limitl']."',g_e_limit='".$_POST['g_e_limitl']."'  where (g_game_id='1' and g_id>='19' and g_id<='26') or (g_game_id=9 and g_id>='110' and g_id<='117') ";
	$exe=mysql_query($sql) or  die("数据库修改出错");
	
	
	$sql="update g_send_back_default Set g_a_limit='".$_POST['g_a_limitc']."',g_b_limit='".$_POST['g_b_limitc']."',g_c_limit='".$_POST['g_c_limitc']."',g_d_limit='".$_POST['g_d_limitc']."',g_e_limit='".$_POST['g_e_limitc']."'  where g_game_id=2 or g_game_id=3 or g_game_id=10 or g_game_id=11 ";
	$exe=mysql_query($sql) or  die("数据库修改出错");
	 if($ConfigModel['g_gx_game_lock']==1){
	$sql="update g_send_back_default Set g_a_limit='".$_POST['g_a_limitg']."',g_b_limit='".$_POST['g_b_limitg']."',g_c_limit='".$_POST['g_c_limitg']."',g_d_limit='".$_POST['g_d_limitg']."',g_e_limit='".$_POST['g_e_limitg']."'  where g_game_id=3 ";
	$exe=mysql_query($sql) or  die("数据库修改出错");
	}
	$sql="update g_send_back_default Set g_a_limit='".$_POST['g_a_limitb']."',g_b_limit='".$_POST['g_b_limitb']."',g_c_limit='".$_POST['g_c_limitb']."',g_d_limit='".$_POST['g_d_limitb']."',g_e_limit='".$_POST['g_e_limitb']."'  where g_game_id=6 or g_game_id=4 ";
	$exe=mysql_query($sql) or  die("数据库修改出错");
	
	$sql="update g_send_back_default Set g_a_limit='".$_POST['g_a_limitj']."',g_b_limit='".$_POST['g_b_limitj']."',g_c_limit='".$_POST['g_c_limitj']."',g_d_limit='".$_POST['g_d_limitj']."',g_e_limit='".$_POST['g_e_limitj']."'  where g_game_id=7 ";
	$exe=mysql_query($sql) or  die("数据库修改出错");
	$sql="update g_send_back_default Set g_a_limit='".$_POST['g_a_limitk']."',g_b_limit='".$_POST['g_b_limitk']."',g_c_limit='".$_POST['g_c_limitk']."',g_d_limit='".$_POST['g_d_limitk']."',g_e_limit='".$_POST['g_e_limitk']."'  where g_game_id=8 ";
	$exe=mysql_query($sql) or  die("数据库修改出错");
	echo "<script>alert('修改成功!');window.location.href='mrp.php';</script>"; 
	exit;
}
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
	function isForm(){
		if (confirm("確認更變嗎？"))
				return true;
		return false;
	}
-->
</script>
</head>

<body onselectstart="return false">
<form action="" method="post" onsubmit="return isForm()">
  <table border="0" cellspacing="0" class="a" width="100%" height="99.3%">
    <tr>
      <td width="5" height="100%" bgcolor="#4F4F4F"></td>
      <td class="c"><table border="0" cellspacing="0" class="main">
          <tr>
            <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt=""></td>
            <td background="/Admin/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16"></td>
                  <td width="100%"><font style="font-weight:bold" color="#344B50">&nbsp;管理員默认退水设置</font></td>
                </tr>
              </table></td>
            <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt=""></td>
          </tr>
          <!--/head-->
          <tr >
            <td class="t"></td>
            <td class="c"><!-- strat -->
              
              <table border="0" cellspacing="0" class="conter">
                <tr class="tr_top" >
                  <th><?php  if($peizhigdklsf=="1"){ echo "廣東快樂十分";}  if($peizhinc=="1"){ echo "幸运农场";}?></th>
                  <th><?php if($peizhicqssc=="1"){echo "重慶時時彩 ";}  if($peizhijxssc=="1"){ echo "极速时时彩 ";}  if($peizhixjssc=="1"){ echo "新疆時時彩 ";}  if($peizhitjssc=="1"){ echo "天津时时彩 ";}?></th>
                </tr>
                <tr>
                  <td><table border="0" cellspacing="0" width="100%" class="conter">
                      <tr class="tr_top">
                        <td width="110">交易類型</td>
                        <td>A盤</td>
                        <td>B盤</td>
                        <td>C盤</td>
                        <td>單註限額</td>
                        <td>單期限額</td>
                      </tr>
                      <?php $result = mysql_query("select * from  g_send_back_default where g_game_id=1 and g_id=1 ");   
										$row=mysql_fetch_array($result); ?>
                      <tr align="center" style="height: 25px;" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                        <td class="caption_11">所有</td>
                        <td><input name="g_a_limit" class="texta" value='<?php echo $row['g_a_limit']?>' /></td>
                        <td><input name="g_b_limit" class="texta" value='<?php echo $row['g_b_limit']?>' /></td>
                        <td><input name="g_c_limit" class="texta" value='<?php echo $row['g_c_limit']?>' /></td>
                        <td><input name="g_d_limit" class="textb" value='<?php echo $row['g_d_limit']?>' /></td>
                        <td><input name="g_e_limit" class="textb" value='<?php echo $row['g_e_limit']?>' /></td>
                      </tr>
                      <?php $result = mysql_query("select * from  g_send_back_default where g_game_id=1 and g_id=19 ");   
										$row=mysql_fetch_array($result); ?>
                      <tr align="center" style="height: 25px;" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                        <td class="caption_11">连码类</td>
                        <td><input name="g_a_limitl" class="texta" value='<?php echo $row['g_a_limit']?>' /></td>
                        <td><input name="g_b_limitl" class="texta" value='<?php echo $row['g_b_limit']?>' /></td>
                        <td><input name="g_c_limitl" class="texta" value='<?php echo $row['g_c_limit']?>' /></td>
                        <td><input name="g_d_limitl" class="textb" value='<?php echo $row['g_d_limit']?>' /></td>
                        <td><input name="g_e_limitl" class="textb" value='<?php echo $row['g_e_limit']?>' /></td>
                      </tr>
                    </table></td>
                  <td><table border="0" cellspacing="0" width="100%" class="conter">
                      <tr class="tr_top">
                        <td width="110">交易類型</td>
                        <td>A盤</td>
                        <td>B盤</td>
                        <td>C盤</td>
                        <td>單註限額</td>
                        <td>單期限額</td>
                      </tr>
                      <?php $result = mysql_query("select * from  g_send_back_default where g_game_id=2 and g_id=27 ");   
										$row=mysql_fetch_array($result); ?>
                      <tr align="center" style="height: 25px;" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                        <td class="caption_11"></td>
                        <td><input name="g_a_limitc" class="texta" value='<?php echo $row['g_a_limit']?>' /></td>
                        <td><input name="g_b_limitc" class="texta" value='<?php echo $row['g_b_limit']?>' /></td>
                        <td><input name="g_c_limitc" class="texta" value='<?php echo $row['g_c_limit']?>' /></td>
                        <td><input name="g_d_limitc" class="textb" value='<?php echo $row['g_d_limit']?>' /></td>
                        <td><input name="g_e_limitc" class="textb" value='<?php echo $row['g_e_limit']?>' /></td>
                      </tr>
                      
                        <td class="caption_11"></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
                <tr class="tr_top">
                  <th><?php if($peizhipk10=="1"){ echo "北京赛车PK10 ";}  if($peizhixyft=="1"){ echo "极速赛车 ";}?></th>
                  <th><?php  if($peizhijssz=="1"){ echo "吉林快3 ";}  if($peizhijsyxx=="1"){ echo "吉林鱼虾蟹 ";}?></th>
                </tr>
                <tr>
                  <td><table border="0" cellspacing="0" width="100%" class="conter">
                      <tr class="tr_top">
                        <td width="110">交易類型</td>
                        <td>A盤</td>
                        <td>B盤</td>
                        <td>C盤</td>
                        <td>單註限額</td>
                        <td>單期限額</td>
                      </tr>
                      <?php $result = mysql_query("select * from  g_send_back_default where g_game_id=6 and g_id=61 ");   
										$row=mysql_fetch_array($result); ?>
                      <tr align="center" style="height: 25px;" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                        <td class="caption_11">所有</td>
                        <td><input name="g_a_limitb" class="texta" value='<?php echo $row['g_a_limit']?>' /></td>
                        <td><input name="g_b_limitb" class="texta" value='<?php echo $row['g_b_limit']?>' /></td>
                        <td><input name="g_c_limitb" class="texta" value='<?php echo $row['g_c_limit']?>' /></td>
                        <td><input name="g_d_limitb" class="textb" value='<?php echo $row['g_d_limit']?>' /></td>
                        <td><input name="g_e_limitb" class="textb" value='<?php echo $row['g_e_limit']?>' /></td>
                      </tr>
                    </table></td>
                  <td><table border="0" cellspacing="0" width="100%" class="conter">
                      <tr class="tr_top">
                        <td width="110">交易類型</td>
                        <td>A盤</td>
                        <td>B盤</td>
                        <td>C盤</td>
                        <td>單註限額</td>
                        <td>單期限額</td>
                      </tr>
                      <?php $result = mysql_query("select * from  g_send_back_default where g_game_id=7 and g_id=77 ");   
										$row=mysql_fetch_array($result); ?>
                      <tr align="center" style="height: 25px;" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                        <td class="caption_11"></td>
                        <td><input name="g_a_limitj" class="texta" value='<?php echo $row['g_a_limit']?>' /></td>
                        <td><input name="g_b_limitj" class="texta" value='<?php echo $row['g_b_limit']?>' /></td>
                        <td><input name="g_c_limitj" class="texta" value='<?php echo $row['g_c_limit']?>' /></td>
                        <td><input name="g_d_limitj" class="textb" value='<?php echo $row['g_d_limit']?>' /></td>
                        <td><input name="g_e_limitj" class="textb" value='<?php echo $row['g_e_limit']?>' /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr class="tr_top">
                  <th><?php  if($peizhikl8=="1"){ echo "快樂8";}?></th>
                  <th></th>
                </tr>
                <tr>
                  <td><table border="0" cellspacing="0" width="100%" class="conter">
                      <tr class="tr_top">
                        <td width="110">交易類型</td>
                        <td>A盤</td>
                        <td>B盤</td>
                        <td>C盤</td>
                        <td>單註限額</td>
                        <td>單期限額</td>
                      </tr>
                      <?php $result = mysql_query("select * from  g_send_back_default where g_game_id=8 order by g_id limit 1");   
										$row=mysql_fetch_array($result); ?>
                      <tr align="center" style="height: 25px;" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                        <td class="caption_11">所有</td>
                        <td><input name="g_a_limitk" class="texta" value='<?php echo $row['g_a_limit']?>' /></td>
                        <td><input name="g_b_limitk" class="texta" value='<?php echo $row['g_b_limit']?>' /></td>
                        <td><input name="g_c_limitk" class="texta" value='<?php echo $row['g_c_limit']?>' /></td>
                        <td><input name="g_d_limitk" class="textb" value='<?php echo $row['g_d_limit']?>' /></td>
                        <td><input name="g_e_limitk" class="textb" value='<?php echo $row['g_e_limit']?>' /></td>
                      </tr>
                    </table></td>
                  <td></td>
                </tr>
              </table>
              
              <!-- end --></td>
            <td class="r"></td>
          </tr>
          <!--/list-->
          <tr>
            <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt=""></td>
            <td class="f" align="center">&nbsp;
              <input type="submit" class="inputs" value="保存更變"></td>
            <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt=""></td>
          </tr>
          <!--/submit-->
        </table>
        <table class="main" border="0" cellpadding="0" cellspacing="1" style="margin-top:15px;">
          <tr>
            <td align="center">註：默認退水設置僅供快速設置退水限額；設置前已開的帳戶按原退水不變。</td>
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
  <!--/main-->
</form>
</body>
</html>
<div style="display:none">

</div>
