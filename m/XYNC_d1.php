<?php 
session_start();
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
$gameid=$_SESSION['cpopen'] = 9;
$gamelm=$_SESSION['lm']=$_REQUEST['player_type'] ? $_REQUEST['player_type'] : 'd1';
include_once 'offGame.php';

$game_name=get_gameName($gameid);
$game_type=get_gamesmName($gameid);
$d_name=get_dName($gamelm);
$ball=substr($gamelm,-1);

if ($user[0]['g_look'] == 2) exit(href('repore.php'));
$ConfigModel = configModel("`g_nc_game_lock`, `g_mix_money`");
if ($ConfigModel['g_nc_game_lock'] !=1)exit(href('ClosedLottery.php'));
//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

$pan = explode(',', $result[0]['g_panlus']); 
$g = $_GET['g'];
$abc = $_GET['abc'];
if($abc==null) {$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}

markPos("前台-".$game_name."下注");
?><!DOCTYPE html>  
<html>  
<head>  
<title>遊戲大廳</title>  
<link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.mobile-1.4.3.js"></script>
<script src="js/mobi_common.js"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>  
<body >  	
<div data-role="page" > 
<script type="text/javascript">
    var G = { kc_type: "<?=$gameid?>", page_type: "<?=$gamelm?>", open_url: "get_ajax_<?=$game_type?>/GetDrawInfo.php", long_url: "get_ajax_<?=$game_type?>/m_cl_10.php?page_type=<?=$gamelm?>", odds_url: "get_ajax_<?=$game_type?>/GetOdds.php", ball_ids: "GT=<?=$gamelm?>" };

    //$(document).on("pageinit", "#pageone", function () {
    $(document).ready(function () {
        jQuery.mobile.ajaxEnabled = false; 
        LoadOpenLotteryData();
        LoadOddsData();
        UpdateTime(); //启动更新倒计时
        addEventAct('touched');
        addEventAct('showOrHide');
        addEventAct('showBetPage');
        addEventAct('changeLotteryType');
        addEventAct('changePlayerType');
        
    });
</script>
	<div data-role="header" data-position="fixed" data-tap-toggle="false">
		<a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext"></a>
		<h1><?=$game_name?>- <?=$d_name?></h1>
		<a href="main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse"></a>
        <? include 'select.php';?>
		</div> 
	<div data-role="content" class="pm"  id="dataPage" >		
		<!--開獎號碼 -開獎提醒 begin-->
        
<div class="JQBox" id="draw_result"></div><div class="JQBox"><b class="lv" id="t_qs"></b>期&nbsp;&nbsp;&nbsp;開獎時間:<b class="lan" id="o_time"></b>&nbsp;&nbsp;&nbsp;<b class="hong" id="c_time">距封盤:</b><b class="lan" style="float:right; margin-right:5px;" id="up_countdown"></b></div>

        <!--開獎號碼 -開獎提醒 end-->
		<!--玩法-->
		<div class="WFbox">
			<div class="WFtitle">
                <div class="leftBtn">隱藏</div>
				<?=$d_name?> &nbsp;<b class="f10" ></b>
				<div class="rightBtn">下注</div>
			</div>
			<div class="box">
				<ul>
                <li>
					<div class="liBox ">
						<span class="num_01">1</span>
						<label id="jeu_p_<?=$ball?>_h1">-</label>						
					</div>
					<p id="jeu_r_<?=$ball?>_h1">熱:- 漏:-</p>
				</li>
                <li>
					<div class="liBox ">
						<span class="num_02">2</span>
						<label id="jeu_p_<?=$ball?>_h2">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h2">熱:- 漏:-</p>
				</li>
                <li>
					<div class="liBox ">
						<span class="num_03">3</span>
						<label id="jeu_p_<?=$ball?>_h3">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h3">熱:- 漏:-</p>
				</li>
                <li>
					<div class="liBox ">
						<span class="num_04">4</span>
						<label id="jeu_p_<?=$ball?>_h4">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h4">熱:- 漏:-</p>
				</li>
                <li>
					<div class="liBox ">
						<span class="num_05">5</span>
						<label id="jeu_p_<?=$ball?>_h5">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h5">熱:- 漏:-</p>
				</li>
                <li>
					<div class="liBox ">
						<span class="num_06">6</span>
						<label id="jeu_p_<?=$ball?>_h6">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h6">熱:- 漏:-</p>
				</li>
                <li>
					<div class="liBox ">
						<span class="num_07">7</span>
						<label id="jeu_p_<?=$ball?>_h7">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h7">熱:- 漏:-</p>
				</li>
                <li>
					<div class="liBox ">
						<span class="num_08">8</span>
						<label id="jeu_p_<?=$ball?>_h8">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h8">熱:- 漏:-</p>
				</li>
				<li>
					<div class="liBox ">
						<span class="num_09">9</span>
						<label id="jeu_p_<?=$ball?>_h9">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h9">熱:- 漏:-</p>
				</li>
				<li>
					<div class="liBox ">
						<span class="num_10">10</span>
						<label id="jeu_p_<?=$ball?>_h10">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h10">熱:- 漏:-</p>
				</li>
				<li>
					<div class="liBox ">
						<span class="num_11">11</span>
						<label id="jeu_p_<?=$ball?>_h11">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h11">熱:- 漏:-</p>
				</li>
				<li>
					<div class="liBox ">
						<span class="num_12">12</span>
						<label id="jeu_p_<?=$ball?>_h12">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h12">熱:- 漏:-</p>
				</li>
				<li>
					<div class="liBox ">
						<span class="num_13">13</span>
						<label id="jeu_p_<?=$ball?>_h13">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h13">熱:- 漏:-</p>
				</li>
				<li>
					<div class="liBox ">
						<span class="num_14">14</span>
						<label id="jeu_p_<?=$ball?>_h14">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h14">熱:- 漏:-</p>
				</li>
				<li>
					<div class="liBox ">
						<span class="num_15">15</span>
						<label id="jeu_p_<?=$ball?>_h15">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h15">熱:- 漏:-</p>
				</li>
				<li>
					<div class="liBox ">
						<span class="num_16">16</span>
						<label id="jeu_p_<?=$ball?>_h16">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h16">熱:- 漏:-</p>
				</li>
				<li>
					<div class="liBox ">
						<span class="num_17">17</span>
						<label id="jeu_p_<?=$ball?>_h17">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h17">熱:- 漏:-</p>
				</li>
				<li>
					<div class="liBox ">
						<span class="num_17">18</span>
						<label id="jeu_p_<?=$ball?>_h18">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h18">熱:- 漏:-</p>
				</li>
				<li>
					<div class="liBox ">
						<span class="num_19">19</span>
						<label id="jeu_p_<?=$ball?>_h19">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h19">熱:- 漏:-</p>
				</li>
				<li>
					<div class="liBox ">
						<span class="num_20">20</span>
						<label id="jeu_p_<?=$ball?>_h20">-</label>
					</div>
					<p id="jeu_r_<?=$ball?>_h20">熱:- 漏:-</p>
				</li>
				</ul>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>
		
		<div class="WFbox">
			<div class="WFtitle">
                <div class="leftBtn">隱藏</div>
				兩面 &nbsp;<b class="f10" ></b>
				<div class="rightBtn">下注</div>
			</div>
			<div class="box">
				<ul>
                <li>
					<div class="liBox mb6 ">
						<span>大</span>
						<label id="jeu_p_<?=$ball?>_h21">-</label>
					</div>
				</li>
                <li>
					<div class="liBox mb6 ">
						<span>小</span>
						<label id="jeu_p_<?=$ball?>_h22">-</label>
					</div>
				</li>
                <li>
					<div class="liBox mb6 ">
						<span>單</span>
						<label id="jeu_p_<?=$ball?>_h23">-</label>
					</div>
				</li>
                <li>
					<div class="liBox mb6 ">
						<span>雙</span>
						<label id="jeu_p_<?=$ball?>_h24">-</label>
					</div>
				</li>
                <li>
					<div class="liBox mb6 ">
						<span>尾大</span>
						<label id="jeu_p_<?=$ball?>_h25">-</label>
					</div>
				</li>
                <li>
					<div class="liBox mb6 ">
						<span>尾小</span>

						<label id="jeu_p_<?=$ball?>_h26">-</label>
					</div>
				</li>
				<li>
					<div class="liBox mb6 ">
						<span>合單</span>
						<label id="jeu_p_<?=$ball?>_h27">-</label>
					</div>
				</li>
				<li>
					<div class="liBox mb6 ">
						<span>合雙</span>
						<label id="jeu_p_<?=$ball?>_h28">-</label>
					</div>
				</li>

				<li>
					<div class="liBox mb6 ">
						<span>東</span>
						<label id="jeu_p_<?=$ball?>_h29">-</label>
					</div>
				</li>

                

                  <li>
					<div class="liBox mb6 ">
						<span>南</span>
						<label id="jeu_p_<?=$ball?>_h30">-</label>
					</div>
				</li>
                <li>
					<div class="liBox mb6 ">
						<span>西</span>
						<label id="jeu_p_<?=$ball?>_h31">-</label>
					</div>
				</li>
                 <li>
					<div class="liBox mb6 ">
						<span>北</span>
						<label id="jeu_p_<?=$ball?>_h32">-</label>
					</div>
				</li>
                <li>
					<div class="liBox mb6 ">
						<span>中</span>
						<label id="jeu_p_<?=$ball?>_h33">-</label>
					</div>
				</li>
                 <li>
					<div class="liBox mb6 ">
						<span>發</span>
						<label id="jeu_p_<?=$ball?>_h34">-</label>
					</div>
				</li>

                  <li>
					<div class="liBox mb6 ">
						<span>白</span>
						<label id="jeu_p_<?=$ball?>_h35">-</label>
					</div>
				</li>

				</ul>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>		
        <!--兩面長龍-->
<div class="Clbox">		
			<div class="CLtitle">
				<div class="leftBtn">隱藏</div>兩面長龍排行
			</div>
			<div class="box" id="t_long">
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
	  </div>
      <!-- 排行-->
		<div class="Clbox">		
			<div class="CLtitle">
				<div class="leftBtn">隱藏</div>球號排行
			</div>
			<div class="box">
				<div class="ballNav" id="ballNav">
				</div>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>
	</div> 
<? include 'footer.php';?>
<? include 'left.php';?>
    <!-- 投注对话框 begin--> 
    
<div id="BetPage" width="100%" class="BetPage" style="display:none;">
<style type="text/css">
.BetPage
{
  z-index: 9999;
  width:100%;
  height:100px;
  position:fixed;
  right:100%;
  top:0px;
  left:0px;
}
.mask {   
    color:#C7EDCC;
    background-color:Black;
    position:absolute;
    top:0px;
    left:0px;
    filter: Alpha(Opacity=.3);
   -moz-opacity: 0.7; opacity:.70; filter: alpha(opacity=70);} 
.boxbg{background: -moz-linear-gradient(top,#e18847,#9a4d28);background: linear-gradient(top,#e18847,#9a4d28);background: -webkit-linear-gradient(top,#e18847,#9a4d28); color:#fff; border-bottom:1px solid #531c00;white-space:nowrap}


</style>
<form method="post" action="touzhu_4.php" id="myform" onsubmit = "return checkUser();" >
  <table width="100%" height="110" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="10%" align="right" class="boxbg">金額:&nbsp;</td>
      <td width="45%" id="set_input" class="boxbg"><input type="tel" id="txtMomey" name="txtMomey" placeholder="請輸入下注金額" /></td>
      <td class="boxbg" width="25%"><input type="submit" id="btnSubmitBet" value="下單" /></td>
      <td class="boxbg" align="center" width="10%"><a href="javascript:void(0);" onClick="javascript:hideBetPage();"><img src="images/quit1.png" /></a></td>
    </tr>
    <tr>
    <td><input type='hidden' name='data' id='ball_data' /></td>
    <td><input type='hidden' name='caizhong' id='caizhong' /></td>
    <td><input type='hidden' name='wanfa' id='wanfa' /></td>
    <td><input type='hidden' name='jiangqi' id='jiangqi' /></td>
    </tr>
  </table>
  </form>
</div>
    <!-- 投注对话框 end--> 
</div> 
</body> 
</html>  