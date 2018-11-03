<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
include_once ROOT_PATH.'functioned/peizhi.php';
global $user;
$db = new DB();
$list=array();
$sql = "SELECT `g_type`, `g_panlu_a`,`g_panlu_b`,`g_panlu_c`, `g_danzhu`, `g_danxiang`,g_game_id FROM `g_panbiao` WHERE `g_nid` = '{$user[0]['g_name']}' ORDER BY g_game_id asc, g_id DESC ";
$result = $db->query($sql, 1);
$m=0;
$g_game_id=0;
foreach($result as $arr){
	if($g_game_id!=$arr['g_game_id']){$m=0;$g_game_id=$arr['g_game_id'];}
	$list[$arr['g_game_id']][$m]['g_type']=$arr['g_type'];
	$list[$arr['g_game_id']][$m]['g_panlu_a']=$arr['g_panlu_a'];
	$list[$arr['g_game_id']][$m]['g_panlu_b']=$arr['g_panlu_b'];
	$list[$arr['g_game_id']][$m]['g_panlu_c']=$arr['g_panlu_c'];
	$list[$arr['g_game_id']][$m]['g_danzhu']=$arr['g_danzhu'];
	$list[$arr['g_game_id']][$m]['g_danxiang']=$arr['g_danxiang'];
	$m++;
}
//print_r($list);
markPos("前台-信用资料");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/static/css/baset.css" rel="stylesheet" type="text/css">
<link href="css/left.css" rel="stylesheet" type="text/css">
<style type="text/css">
.t_list {
	margin: 0px 14px;
}
</style>
<title>aspx</title>
</head>
<body onselectstart="return false">
<table width="700" class="t_list t_result conter" border="0" cellSpacing="1" cellPadding="0" style="margin-top:9px;top:1px;">
<tr height="24">
  <td class="t_list_caption" colspan="2">信用資料</td>
</tr>
<tr height="28">
  <td class="t_td_caption_1" style="text-align:right" width="22%">會員帳號&nbsp;</td>
  <td class="t_td_text">&nbsp;&nbsp;<?php echo $user[0]['g_name']?>（
    <label id="pls" ><?php echo strtoupper($user[0]['g_panlu'])?></label>
    盤）</td>
</tr>
<tr height="28">
  <td class="t_td_caption_1" style="text-align:right">信用額度&nbsp;</td>
  <td align="left" class="t_td_text">&nbsp;&nbsp;<?php echo number_format($user[0]['g_money'])?></td>
</tr>
<tr height="28">
  <td class="t_td_caption_1" style="text-align:right">可用金額&nbsp;</td>
  <td class="t_td_text">&nbsp;&nbsp;<?php echo number_format(round($user[0]['g_money_yes'],1))?></td>
</tr>
</table>


<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result conter" width="700" style="<?php  if($peizhigdklsf!="1"){ echo "display:none;";}?>" >
<tr>
  <td class="t_list_caption" colspan="8">廣東快樂十分</td>
</tr>
<tr class="t_td_text">
  <td><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
      <tr class="t_list_caption">
        <td width="29%"><b>交易類型</b></td>
        <b width="14%">
        <?php $P = $user[0]['g_panlus'];?>
        <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
        <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
        <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        </b>
        <td width="28%"><b>單註限額</b></td>
        <td width="29%"><b>單期限額</b></td>
      </tr>
      <?php 
	  //print_r($list[1]);
	        			for ($i=0; $i<13; $i++) {
						$str='<tr class="t1_textalai" align="center"><td width="80" class="t_td_caption_1" >'.$list[1][$i]['g_type'].'</td>';
						$P = $user[0]['g_panlus'];
                        if(strstr($P,'A')!=''){$str.="<td>".$list[1][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[1][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[1][$i]['g_panlu_c']."</td>";}
						$str.='<td width="80" align="right">'.number_format($list[1][$i]['g_danzhu']).'&nbsp;</td><td width="80" align="right">'.number_format($list[1][$i]['g_danxiang']).'&nbsp;</td></tr>';
						echo $str;
	        			}
        			?>
    </table></td>
  <td valign="top"><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
      <tr class="t_list_caption">
        <td width="29%"><b>交易類型</b></td>
        <b width="14%">
        <?php $P = $user[0]['g_panlus'];?>
        <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
        <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
        <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        </b>
        <td width="28%"><b>單註限額</b></td>
        <td width="29%"><b>單期限額</b></td>
      </tr>
      <?php 
	        			for ($i=13; $i<26; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="80" class="t_td_caption_1">'.$list[1][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[1][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[1][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[1][$i]['g_panlu_c']."</td>";}
							$str.='<td width="80" align="right">'.number_format($list[1][$i]['g_danzhu']).'&nbsp;</td><td width="80" align="right">'.number_format($list[1][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
    </table></td>
</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="700" style="margin-top:0px;top:1px;<?php  if($peizhicqssc!="1"){ echo "display:none;";}?>">
  <tr>
    <td class="t_list_caption" colspan="8">重慶時時彩</td>
  </tr>
  <tr class="t_td_text">
    <td><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        <?php 
	        			for ($i=0; $i<7; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[2][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[2][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[2][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[2][$i]['g_panlu_c']."</td>";}
							$str.='<td width="96" align="right">'.number_format($list[2][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[2][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
      </table></td>
    <td valign="top"><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        <?php 
	        			for ($i=7; $i<13; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[2][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[2][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[2][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[2][$i]['g_panlu_c']."</td>";}
							$str.='<td width="96" align="right">'.number_format($list[2][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[2][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
      </table></td>
  </tr>
</table>


<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="700" style="margin-top:0px;top:1px;<?php  if($peizhijxssc!="1"){ echo "display:none;";}?>">
  <tr>
    <td class="t_list_caption" colspan="8">极速时时彩</td>
  </tr>
  <tr class="t_td_text">
    <td><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        <?php 
	        			for ($i=0; $i<7; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[3][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[3][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[3][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[3][$i]['g_panlu_c']."</td>";}
							$str.='<td width="96" align="right">'.number_format($list[3][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[3][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
      </table></td>
    <td valign="top"><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        <?php 
	        			for ($i=7; $i<13; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[3][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[3][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[3][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[3][$i]['g_panlu_c']."</td>";}
							$str.='<td width="96" align="right">'.number_format($list[3][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[3][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
      </table></td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="700" style="margin-top:0px;top:1px;<?php  if($peizhixjssc!="1"){ echo "display:none;";}?>">
  <tr>
    <td class="t_list_caption" colspan="8">新疆时时彩</td>
  </tr>
  <tr class="t_td_text">
    <td><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        <?php 
	        			for ($i=0; $i<7; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[10][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[10][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[10][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[10][$i]['g_panlu_c']."</td>";}
							$str.='<td width="96" align="right">'.number_format($list[10][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[10][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
      </table></td>
    <td valign="top"><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        <?php 
	        			for ($i=7; $i<13; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[10][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[10][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[10][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[10][$i]['g_panlu_c']."</td>";}
							$str.='<td width="96" align="right">'.number_format($list[10][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[10][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
      </table></td>
  </tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="700" style="margin-top:0px;top:1px;<?php  if($peizhitjssc!="1"){ echo "display:none;";}?>">
  <tr>
    <td class="t_list_caption" colspan="8">天津时时彩</td>
  </tr>
  <tr class="t_td_text">
    <td><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        <?php 
	        			for ($i=0; $i<7; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[11][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[11][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[11][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[11][$i]['g_panlu_c']."</td>";}
							$str.='<td width="96" align="right">'.number_format($list[11][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[11][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
      </table></td>
    <td valign="top"><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        <?php 
	        			for ($i=7; $i<13; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[11][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[11][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[11][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[11][$i]['g_panlu_c']."</td>";}
							$str.='<td width="96" align="right">'.number_format($list[11][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[11][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
      </table></td>
  </tr>
</table>



<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="700" style="margin-top:0px;top:1px;<?php  if($peizhipk10!="1"){ echo "display:none;";}?>">
  <tr>
    <td class="t_list_caption" colspan="8">北京赛车PK10</td>
  </tr>
  <tr class="t_td_text">
    <td><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        <?php 
	        			for ($i=0; $i<8; $i++) {
						$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[6][$i]['g_type'].'</td>';
						$P = $user[0]['g_panlus'];
                        if(strstr($P,'A')!=''){$str.="<td>".$list[6][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[6][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[6][$i]['g_panlu_c']."</td>";}
	        			
						$str.='<td width="96" align="right">'.number_format($list[6][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[6][$i]['g_danxiang']).'&nbsp;</td></tr>';
						echo $str;
	        			}
        			?>
      </table></td>
    <td><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        <?php 
	        			for ($i=8; $i<16; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[6][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[6][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[6][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[6][$i]['g_panlu_c']."</td>";}
							$str.='<td width="96" align="right">'.number_format($list[6][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[6][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
      </table></td>
  </tr>
  <table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="700" style="margin-top:0px;top:1px;<?php  if($peizhijssz!="1"){ echo "display:none;";}?>">
    <tr>
      <td class="t_list_caption" colspan="8">吉林快3</td>
    </tr>
    <tr class="t_td_text">
      <td><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
          <?php 
	        			for ($i=0; $i<3; $i++) {
						$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[7][$i]['g_type'].'</td>';
						$P = $user[0]['g_panlus'];
                        if(strstr($P,'A')!=''){$str.="<td>".$list[7][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[7][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[7][$i]['g_panlu_c']."</td>";}
	        			
						$str.='<td width="96" align="right">'.number_format($list[7][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[7][$i]['g_danxiang']).'&nbsp;</td></tr>';
						echo $str;
	        			}
        			?>
        </table></td>
      <td valign="top"><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
          <tr class="t_list_caption_1">
            <?php 
	        			for ($i=3; $i<=5; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[7][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[7][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[7][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[7][$i]['g_panlu_c']."</td>";}
							$str.='<td width="96" align="right">'.number_format($list[7][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[7][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
        </table></td>
    </tr>
  </table>
</table>
 <table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="700" style="margin-top:0px;top:1px;<?php  if($peizhikl8!="1"){ echo "display:none;";}?>">
    <tr>
      <td class="t_list_caption" colspan="8">快樂8</td>
    </tr>
    <tr class="t_td_text">
      <td><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
          <?php 
	        			for ($i=0; $i<4; $i++) {
						$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[8][$i]['g_type'].'</td>';
						$P = $user[0]['g_panlus'];
                        if(strstr($P,'A')!=''){$str.="<td>".$list[8][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[8][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[8][$i]['g_panlu_c']."</td>";}
	        			
						$str.='<td width="96" align="right">'.number_format($list[8][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[8][$i]['g_danxiang']).'&nbsp;</td></tr>';
						echo $str;
	        			}
        			?>
        </table></td>
      <td valign="top"><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
          <tr class="t_list_caption_1">
            <?php 
	        			for ($i=4; $i<8; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[8][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[8][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[8][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[8][$i]['g_panlu_c']."</td>";}
							$str.='<td width="96" align="right">'.number_format($list[8][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[8][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
        </table></td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="700" style="margin-top:0px;top:1px;<?php  if($peizhixyft!="1"){ echo "display:none;";}?>">
  <tr>
    <td class="t_list_caption" colspan="8">极速赛车</td>
  </tr>
  <tr class="t_td_text">
    <td><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        <?php 
	        			for ($i=0; $i<8; $i++) {
						$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[4][$i]['g_type'].'</td>';
						$P = $user[0]['g_panlus'];
                        if(strstr($P,'A')!=''){$str.="<td>".$list[4][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[4][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[4][$i]['g_panlu_c']."</td>";}
	        			
						$str.='<td width="96" align="right">'.number_format($list[4][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[4][$i]['g_danxiang']).'&nbsp;</td></tr>';
						echo $str;
	        			}
        			?>
      </table></td>
    <td><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        <?php 
	        			for ($i=8; $i<16; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="100" class="t_td_caption_1">'.$list[4][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[4][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[4][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[4][$i]['g_panlu_c']."</td>";}
							$str.='<td width="96" align="right">'.number_format($list[4][$i]['g_danzhu']).'&nbsp;</td><td width="103" align="right">'.number_format($list[4][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
      </table></td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result conter" width="700" style="margin-top:0px;top:1px;<?php  if($peizhinc!="1"){ echo "display:none;";}?>">
<tr>
  <td class="t_list_caption" colspan="8">幸运农场</td>
</tr>
<tr class="t_td_text">
  <td><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
      <tr class="t_list_caption">
        <td width="29%"><b>交易類型</b></td>
        <b width="14%">
        <?php $P = $user[0]['g_panlus'];?>
        <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
        <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
        <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        </b>
        <td width="28%"><b>單註限額</b></td>
        <td width="29%"><b>單期限額</b></td>
      </tr>
      <?php 
	        			for ($i=0; $i<13; $i++) {
						$str='<tr class="t1_textalai" align="center"><td width="80" class="t_td_caption_1" >'.$list[9][$i]['g_type'].'</td>';
						$P = $user[0]['g_panlus'];
                        if(strstr($P,'A')!=''){$str.="<td>".$list[9][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[9][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[9][$i]['g_panlu_c']."</td>";}
						$str.='<td width="80" align="right">'.number_format($list[9][$i]['g_danzhu']).'&nbsp;</td><td width="80" align="right">'.number_format($list[9][$i]['g_danxiang']).'&nbsp;</td></tr>';
						echo $str;
	        			}
        			?>
    </table></td>
  <td valign="top"><table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
      <tr class="t_list_caption">
        <td width="29%"><b>交易類型</b></td>
        <b width="14%">
        <?php $P = $user[0]['g_panlus'];?>
        <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
        <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
        <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        </b>
        <td width="28%"><b>單註限額</b></td>
        <td width="29%"><b>單期限額</b></td>
      </tr>
      <?php 
	        			for ($i=13; $i<26; $i++) {
	        				$str='<tr class="t1_textalai" align="center"><td width="80" class="t_td_caption_1">'.$list[9][$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$list[9][$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$list[9][$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$list[9][$i]['g_panlu_c']."</td>";}
							$str.='<td width="80" align="right">'.number_format($list[9][$i]['g_danzhu']).'&nbsp;</td><td width="80" align="right">'.number_format($list[9][$i]['g_danxiang']).'&nbsp;</td></tr>';
							echo $str;
	        			}
        			?>
    </table></td>
</tr>
</table>
</body>
</html>