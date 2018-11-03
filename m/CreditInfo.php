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

$P = $user[0]['g_panlus'];

?>
<!DOCTYPE html>  
<html>  
<head>  
<title>信用資料</title>  
<link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.mobile-1.4.3.js"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
<meta content="telephone=no" name="format-detection" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>  
<body>  	
<div data-role="page"> 
	<div data-role="header" data-position="fixed">
		<a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext"></a>
		<h1>信用資料</h1>
        <a href="Main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse"></a>
		</div> 
    <div data-role="content" class="pm">
    <div>
      <table class="tableBox">
            <tr>
                <td align="right" width="30%" class="tdBg">會員帳戶&nbsp;</td>
                <td align="left">&nbsp;<?php echo $user[0]['g_name']?></td>
            </tr>
            <tr>
                <td align="right" class="tdBg" >盤　　口&nbsp;</td>
                <td align="left">&nbsp;<span ><?php echo strtoupper($user[0]['g_panlu'])?></span>&nbsp;盤</td>
            </tr>
            <tr>
                <td  align="right" class="tdBg">信用額度&nbsp;</td>
                <td align="left">&nbsp;<?php echo number_format($user[0]['g_money'])?></td>

            </tr>
            <tr>
                <td align="right" class="tdBg">可用金額&nbsp;</td>
                <td align="left">&nbsp;<?php echo number_format(round($user[0]['g_money_yes'],1))?></td>
            </tr>
        </table>
        </div>
        <script language="javascript" type="text/javascript">
            function dataShowHide(obj, tableid) {
                if ($("#" + tableid).css("display") == "none") {
                    $(obj).html("隱藏");
                    $("#" + tableid).show();
                }
                else {
                    $(obj).html("顯示");
                    $("#" + tableid).hide();
                }
            }
</script>
    <div class="WFbox" style="margin-top:0px;top:1px;<?php  if($peizhigdklsf!="1"){ echo "display:none;";}?>">
			<div class="WFtitle">
				<div class="leftBtn" onClick="dataShowHide(this,'content_20')">隱藏</div>
				<div class="centerBtn">廣東快樂十分</div>
			</div>
			<div>
				 <table class="tableBox" id="content_20">
                        <tr>
                            <th width="130">交易類型</td>
                            <th width="40"><?=$user[0]['g_panlu']?>盤</td>
                            <th> 單註限額</td>
                            <th>單期限額</td>
                        </tr>
             <?php 
	  //print_r($list[1]);
	        			for ($i=0; $i<26; $i++) {
						$str='<tr><td>'.$list[1][$i]['g_type'].'</td>';
                        if(strstr($P,'A')!=''){$str.="<td>".$list[1][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[1][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[1][$i]['g_panlu_c']."</td>";}
						$str.='<td>'.number_format($list[1][$i]['g_danzhu']).'</td><td>'.number_format($list[1][$i]['g_danxiang']).'</td></tr>';
						echo $str;
	        			}
        			?>
 
                </table>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>
    <div class="WFbox" style="<?php  if($peizhicqssc!="1"){ echo "display:none;";}?>">
			<div class="WFtitle">
				<div class="leftBtn" onClick="dataShowHide(this,'content_cqsc')">隱藏</div>
				<div class="centerBtn">重慶時時彩</div>
			</div>
			<div>
				 <table class="tableBox" id="content_cqsc">
                        <tr>
                            <th>交易類型</td>
                            <th><?=$user[0]['g_panlu']?>盤</td>
                            <th> 單註限額</td>
                            <th>單期限額</td>
                     <?php 
	  //print_r($list[1]);
	        			for ($i=0; $i<13; $i++) {
						$str='<tr><td>'.$list[2][$i]['g_type'].'</td>';
                        if(strstr($P,'A')!=''){$str.="<td>".$list[2][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[2][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[2][$i]['g_panlu_c']."</td>";}
						$str.='<td>'.number_format($list[2][$i]['g_danzhu']).'</td><td>'.number_format($list[2][$i]['g_danxiang']).'</td></tr>';
						echo $str;
	        			}
        			?>
                </table>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>
    <div class="WFbox" style="<?php  if($peizhipk10!="1"){ echo "display:none;";}?>">
			<div class="WFtitle">
				<div class="leftBtn" onClick="dataShowHide(this,'content_pk10')">隱藏</div>
				<div class="centerBtn">北京赛车PK10</div>
			</div>
			<div>
				 <table class="tableBox" id="content_pk10">
                        <tr>
                            <th>交易類型</td>
                            <th><?=$user[0]['g_panlu']?>盤</td>
                            <th> 單註限額</td>
                            <th>單期限額</td>
                        </tr>
                     <?php 
	  //print_r($list[1]);
	        			for ($i=0; $i<16; $i++) {
						$str='<tr><td>'.$list[6][$i]['g_type'].'</td>';
                        if(strstr($P,'A')!=''){$str.="<td>".$list[6][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[6][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[6][$i]['g_panlu_c']."</td>";}
						$str.='<td>'.number_format($list[6][$i]['g_danzhu']).'</td><td>'.number_format($list[6][$i]['g_danxiang']).'</td></tr>';
						echo $str;
	        			}
        			?>
                </table>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>
		
		
		  <div class="WFbox" style="<?php  if($peizhijxssc!="1"){ echo "display:none;";}?>">
			<div class="WFtitle">
				<div class="leftBtn" onClick="dataShowHide(this,'content_qtwfc')">隱藏</div>
				<div class="centerBtn">极速时时彩</div>
			</div>
			<div>
				 <table class="tableBox" id="content_qtwfc">
                        <tr>
                            <th>交易類型</td>
                            <th><?=$user[0]['g_panlu']?>盤</td>
                            <th> 單註限額</td>
                            <th>單期限額</td>
                     <?php 
	  //print_r($list[1]);
	        			for ($i=0; $i<13; $i++) {
						$str='<tr><td>'.$list[3][$i]['g_type'].'</td>';
                        if(strstr($P,'A')!=''){$str.="<td>".$list[3][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[3][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[3][$i]['g_panlu_c']."</td>";}
						$str.='<td>'.number_format($list[3][$i]['g_danzhu']).'</td><td>'.number_format($list[3][$i]['g_danxiang']).'</td></tr>';
						echo $str;
	        			}
        			?>
                </table>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>
		
		<div class="WFbox" style="<?php  if($peizhixjssc!="1"){ echo "display:none;";}?>">
			<div class="WFtitle">
				<div class="leftBtn" onClick="dataShowHide(this,'content_xjssc')">隱藏</div>
				<div class="centerBtn">新疆时时彩</div>
			</div>
			<div>
				 <table class="tableBox" id="content_xjssc">
                        <tr>
                            <th>交易類型</td>
                            <th><?=$user[0]['g_panlu']?>盤</td>
                            <th> 單註限額</td>
                            <th>單期限額</td>
                     <?php 
	  //print_r($list[1]);
	        			for ($i=0; $i<13; $i++) {
						$str='<tr><td>'.$list[10][$i]['g_type'].'</td>';
                        if(strstr($P,'A')!=''){$str.="<td>".$list[10][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[10][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[10][$i]['g_panlu_c']."</td>";}
						$str.='<td>'.number_format($list[10][$i]['g_danzhu']).'</td><td>'.number_format($list[10][$i]['g_danxiang']).'</td></tr>';
						echo $str;
	        			}
        			?>
                </table>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>
		
		<div class="WFbox" style="<?php  if($peizhitjssc!="1"){ echo "display:none;";}?>">
			<div class="WFtitle">
				<div class="leftBtn" onClick="dataShowHide(this,'content_tjssc')">隱藏</div>
				<div class="centerBtn">天津时时彩</div>
			</div>
			<div>
				 <table class="tableBox" id="content_tjssc">
                        <tr>
                            <th>交易類型</td>
                            <th><?=$user[0]['g_panlu']?>盤</td>
                            <th> 單註限額</td>
                            <th>單期限額</td>
                     <?php 
	  //print_r($list[1]);
	        			for ($i=0; $i<13; $i++) {
						$str='<tr><td>'.$list[11][$i]['g_type'].'</td>';
                        if(strstr($P,'A')!=''){$str.="<td>".$list[11][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[11][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[11][$i]['g_panlu_c']."</td>";}
						$str.='<td>'.number_format($list[11][$i]['g_danzhu']).'</td><td>'.number_format($list[11][$i]['g_danxiang']).'</td></tr>';
						echo $str;
	        			}
        			?>
                </table>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>	
		
	
	<div class="WFbox" style="<?php  if($peizhijssz!="1"){ echo "display:none;";}?>">
			<div class="WFtitle">
				<div class="leftBtn" onClick="dataShowHide(this,'content_jsk3')">隱藏</div>
				<div class="centerBtn">吉林快3</div>
			</div>
			<div>
				 <table class="tableBox" id="content_jsk3">
                        <tr>
                            <th>交易類型</td>
                            <th><?=$user[0]['g_panlu']?>盤</td>
                            <th> 單註限額</td>
                            <th>單期限額</td>
                     <?php 
	  //print_r($list[1]);
	        			for ($i=0; $i<5; $i++) {
						$str='<tr><td>'.$list[7][$i]['g_type'].'</td>';
                        if(strstr($P,'A')!=''){$str.="<td>".$list[7][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[7][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[7][$i]['g_panlu_c']."</td>";}
						$str.='<td>'.number_format($list[7][$i]['g_danzhu']).'</td><td>'.number_format($list[7][$i]['g_danxiang']).'</td></tr>';
						echo $str;
	        			}
        			?>
                </table>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>	
	
	
		
    <div class="WFbox" style="<?php  if($peizhinc!="1"){ echo "display:none;";}?>">
			<div class="WFtitle">
				<div class="leftBtn" onClick="dataShowHide(this,'content_cqnc')">隱藏</div>
				<div class="centerBtn">幸运农场</div>
			</div>
			<div>
				 <table class="tableBox" id="content_cqnc">
                        <tr>
                            <th>交易類型</td>
                            <th><?=$user[0]['g_panlu']?>盤</td>
                            <th> 單註限額</td>
                            <th>單期限額</td>
                        </tr>
                     <?php 
	  //print_r($list[1]);
	        			for ($i=0; $i<26; $i++) {
						$str='<tr><td>'.$list[9][$i]['g_type'].'</td>';
                        if(strstr($P,'A')!=''){$str.="<td>".$list[9][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[9][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[9][$i]['g_panlu_c']."</td>";}
						$str.='<td>'.number_format($list[9][$i]['g_danzhu']).'</td><td>'.number_format($list[9][$i]['g_danxiang']).'</td></tr>';
						echo $str;
	        			}
        			?>
                </table>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>
    <div class="WFbox" style="<?php  if($peizhixyft!="1"){ echo "display:none;";}?>">
			<div class="WFtitle">
				<div class="leftBtn" onClick="dataShowHide(this,'content_xy3')">隱藏</div>
				<div class="centerBtn">极速赛车</div>
			</div>
			<div>
				 <table class="tableBox" id="content_xy3">
                        <tr>
                            <th>交易類型</td>
                            <th><?=$user[0]['g_panlu']?>盤</td>
                            <th> 單註限額</td>
                            <th>單期限額</td>
                        </tr>
                     <?php 
	        			for ($i=0; $i<16; $i++) {
						$str='<tr><td>'.$list[4][$i]['g_type'].'</td>';
                        if(strstr($P,'A')!=''){$str.="<td>".$list[4][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[4][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[4][$i]['g_panlu_c']."</td>";}
						$str.='<td>'.number_format($list[4][$i]['g_danzhu']).'</td><td>'.number_format($list[4][$i]['g_danxiang']).'</td></tr>';
						echo $str;
	        			}
        			?>
                </table>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>

        <div class="WFbox" style="<?php  if($peizhikl8!="1"){ echo "display:none;";}?>">
			<div class="WFtitle">
				<div class="leftBtn" onClick="dataShowHide(this,'content_kl8')">隱藏</div>
				<div class="centerBtn">快樂8(雙盤)</div>
			</div>
			<div>
				 <table class="tableBox" id="content_kl8">
                        <tr>
                            <th>交易類型</td>
                            <th><?=$user[0]['g_panlu']?>盤</td>
                            <th> 單註限額</td>
                            <th>單期限額</td>
                    <?php 
	        			for ($i=0; $i<8; $i++) {
						$str='<tr><td>'.$list[8][$i]['g_type'].'</td>';
                        if(strstr($P,'A')!=''){$str.="<td>".$list[8][$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$list[8][$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$list[8][$i]['g_panlu_c']."</td>";}
						$str.='<td>'.number_format($list[8][$i]['g_danzhu']).'</td><td>'.number_format($list[8][$i]['g_danxiang']).'</td></tr>';
						echo $str;
	        			}
        			?>
                </table>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>

    </div>
    <!-- bottom begin -->
    <!--bottom end -->
<? include 'left.php';?>
</div> 
</body> 
</html> 