<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'functioned/peizhi.php';
global $Users, $LoginId,$userModel;
if ($LoginId ==56 || $LoginId ==89) exit;
$db=new DB();
$sql = "SELECT `g_type`, `g_a_limit`, `g_b_limit`, `g_c_limit`, `g_d_limit`, `g_e_limit`  
FROM g_send_back WHERE g_name = '{$Users[0]['g_name']}' ORDER BY g_id DESC";
$result = $db->query($sql, 1);
if (!$result) exit(back('帳號信息錯誤！'));
if ($LoginId ==48)
	$yes_money = $Users[0]['g_money'] - $userModel->SumMoney($Users[0]['g_nid'], true);
else 
	$yes_money = $Users[0]['g_money'] - $userModel->SumMoney($Users[0]['g_nid'].UserModel::Like());
cPos("后台-信用资料");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<title></title>
</head>
<body onselectstart="return false">
<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
  <tr>
    <td width="5" height="100%" bgcolor="#4F4F4F"></td>
    <td class="c"><table border="0" cellspacing="0" class="main">
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
          <td background="/Admin/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                <td width="99%"><font style="font-weight:bold" color="#344B50">&nbsp;信用資料</font></td>
              </tr>
            </table></td>
          <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
        </tr>
        <tr>
          <td class="t"></td>
          <td class="c"><!-- strat -->
            
            <table border="0" cellspacing="0" class="conter">
              <tr class="tr_top" style="height:25px">
                <th colspan="2">基础信息</th>
              </tr>
              <tr onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                <td class="ball_3" style="height:28px;text-align:right">帳&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;號&nbsp;</td>
                <td class="left_p5" width="82%"><?php echo $Users[0]['g_name']?>&nbsp;&nbsp;【級別：<?php echo $Users[0]['g_Lnid'][0]?>】</td>
              </tr>
              <tr onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                <td class="ball_3" style="height:28px;text-align:right">信用額度&nbsp;</td>
                <td class="left_p5"><?php echo $Users[0]['g_money']?></td>
              </tr>
              <tr onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                <td class="ball_3" style="height:28px;text-align:right">可用額度&nbsp;</td>
                <td class="left_p5"><?php echo $yes_money?></td>
              </tr>
              <tr class="tr_top" style="<?php  if($peizhigdklsf!="1"){ echo "display:none;";}?>">
                <th colspan="2">廣東快樂十分鐘</th>
              </tr>
              <tr style="<?php  if($peizhigdklsf!="1"){ echo "display:none;";}?>">
                <td colspan="2"><table border="0" cellspacing="0" class="t_odds" width="50%">
                    <tr class="tr_top">
                      <td width="120">交易類型</td>
                      <td>A盤</td>
                      <td>B盤</td>
                      <td>C盤</td>
                      <td>單注限額</td>
                      <td>單期限額</td>
                    </tr>
                    <?php for ($i=0; $i<14; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table>
                  <table border="0" cellspacing="0" class="t_odds" width="50%">
                    <tr class="tr_top">
                      <td width="120">交易類型</td>
                      <td>A盤</td>
                      <td>B盤</td>
                      <td>C盤</td>
                      <td>單注限額</td>
                      <td>單期限額</td>
                    </tr>
                    <?php for ($i=14; $i<26; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table></td>
              </tr>
              <tr class="tr_top" style="<?php  if($peizhicqssc!="1"){ echo "display:none;";}?>">
                <th colspan="2">重慶時時彩</th>
              </tr>
              <tr style="<?php  if($peizhicqssc!="1"){ echo "display:none;";}?>">
                <td colspan="2"><table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=26; $i<33; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table>
                  <table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=33; $i<39; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table></td>
              </tr>
			  
			  
            </table>
            <table border="0" cellspacing="0" class="conter" style="<?php  if($peizhipk10!="1"){ echo "display:none;";}?>">
              <tr class="tr_top">
                <th colspan="2">北京赛车PK10</th>
              </tr>
              <tr>
                <td colspan="2"><table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=39; $i<47; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table>
                  <table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=47; $i<55; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table></td>
              </tr>
			  
            </table>
			
			   <table border="0" cellspacing="0" class="conter" style="<?php  if($peizhijssz!="1"){ echo "display:none;";}?>">
              <tr class="tr_top">
                <th colspan="2">吉林快3 </th>
              </tr>
              <tr>
                <td colspan="2"><table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=55; $i<58; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3" width="120"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table>
                  <table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=58; $i<61; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table></td>
              </tr>
            </table>
			
			 <table border="0" cellspacing="0" class="conter" style="<?php  if($peizhikl8!="1"){ echo "display:none;";}?>">
              <tr class="tr_top">
                <th colspan="2">快樂8 </th>
              </tr>
              <tr>
                <td colspan="2"><table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=61; $i<65; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3" width="120"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table>
                  <table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=65; $i<69; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table></td>
              </tr>
            </table>
			
			  <table border="0" cellspacing="0" class="conter" style="<?php  if($peizhinc!="1"){ echo "display:none;";}?>">
			  <tr class="tr_top" >
                <th colspan="2">幸运农场</th>
              </tr>
              <tr>
                <td colspan="2"><table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=69; $i<82; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table>
                  <table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=82; $i<95; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table></td>
              </tr>
			    </table>
				
				 <table border="0" cellspacing="0" class="conter" style="<?php  if($peizhixyft!="1"){ echo "display:none;";}?>">
			  <tr class="tr_top" >
                <th colspan="2">极速赛车</th>
              </tr>
              <tr>
                <td colspan="2"><table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=95; $i<103; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table>
                  <table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=103; $i<111; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table></td>
              </tr>
			    </table>
				
				 <table border="0" cellspacing="0" class="conter" style="<?php  if($peizhixjssc!="1"){ echo "display:none;";}?>">
			  <tr class="tr_top" >
                <th colspan="2">新疆時時彩</th>
              </tr>
              <tr>
                <td colspan="2"><table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=111; $i<118; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table>
                  <table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=118; $i<124; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table></td>
              </tr>
			    </table>
				
          <table border="0" cellspacing="0" class="conter" style="<?php  if($peizhitjssc!="1"){ echo "display:none;";}?>">
			  <tr class="tr_top" >
                <th colspan="2">天津时时彩</th>
              </tr>
              <tr>
                <td colspan="2"><table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=124; $i<131; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table>
                  <table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=131; $i<137; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table></td>
              </tr>
			    </table>
           
		     <table border="0" cellspacing="0" class="conter" style="<?php  if($peizhijxssc!="1"){ echo "display:none;";}?>">
			  <tr class="tr_top" >
                <th colspan="2">极速时时彩</th>
              </tr>
              <tr>
                <td colspan="2"><table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=137; $i<144; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table>
                  <table border="0" cellspacing="0" class="t_odds" width="50%">
                    <?php for ($i=144; $i<150; $i++){?>
                    <tr align="center" style="height:18px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                      <td class="ball_3"><?php echo $result[$i]['g_type']?></td>
                      <td><?php echo $result[$i]['g_a_limit']?></td>
                      <td><?php echo $result[$i]['g_b_limit']?></td>
                      <td><?php echo $result[$i]['g_c_limit']?></td>
                      <td align="right"><?php echo number_format($result[$i]['g_d_limit'])?>&nbsp;</td>
                      <td align="right"><?php echo number_format($result[$i]['g_e_limit'])?>&nbsp;</td>
                    </tr>
                    <?php }?>
                  </table></td>
              </tr>
			    </table>
            <!-- end --></td>
          <td class="r"></td>
        </tr>
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
          <td class="f" align="center"></td>
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