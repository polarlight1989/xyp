<?php 
session_start();
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
$gameid=$_SESSION['cpopen'] = 8;
$gamelm=$_SESSION['lm']='zm';
include_once 'offGame.php';

$game_name=get_gameName($gameid);
$game_type=get_gamesmName($gameid);

if ($user[0]['g_look'] == 2) exit(href('repore.php'));
$ConfigModel = configModel("`g_kl8_game_lock`, `g_mix_money`");
if ($ConfigModel['g_kl8_game_lock'] !=1)exit(href('ClosedLottery.php'));
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

markPos("前台-快樂8");
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
    var G = { kc_type: "<?=$gameid?>", page_type: "<?=$gamelm?>", open_url: "get_ajax_<?=$game_type?>/GetDrawInfo.php", long_url: "get_ajax_<?=$game_type?>/m_cl_10.php?page_type=21", odds_url: "get_ajax_<?=$game_type?>/GetOdds.php", ball_ids: "GT=<?=$gamelm?>" };

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
		<h1>快樂8- 正碼</h1>
		<a href="main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse"></a>
        <? include 'select.php';?>
		</div> 
	<div data-role="content" class="pm" id="dataPage">		
		
	<!--開獎號碼 -開獎提醒 begin-->
        
<div class="JQBox1" id="draw_result"></div><div class="JQBox"><b class="lv" id="t_qs"></b>期&nbsp;&nbsp;&nbsp;開獎時間:<b class="lan" id="o_time"></b>&nbsp;&nbsp;&nbsp;<b class="hong" id="c_time">距封盤:</b><b class="lan" style="float:right; margin-right:5px;" id="up_countdown"></b></div>

        <!--開獎號碼 -開獎提醒 end-->
		<!--玩法-->
		<!--玩法-->
		<div class="WFbox">
			<div class="WFtitle">
               <div class="leftBtn" >隱藏</div>
				正碼 &nbsp;<b class="f10"></b>
				<div class="rightBtn">下注</div>
			</div>
			<div class="box1">
				<ul>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">1</span>
						<label id="jeu_p_1_h1"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">2</span>
						<label id="jeu_p_1_h2"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">3</span>
						<label id="jeu_p_1_h3"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">4</span>
						<label id="jeu_p_1_h4"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">5</span>
						<label id="jeu_p_1_h5"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">6</span>
						<label id="jeu_p_1_h6"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">7</span>
						<label id="jeu_p_1_h7"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">8</span>
						<label id="jeu_p_1_h8"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">9</span>
						<label id="jeu_p_1_h9"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">10</span>
						<label id="jeu_p_1_h10"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">11</span>
						<label id="jeu_p_1_h11"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">12</span>
						<label id="jeu_p_1_h12"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">13</span>
						<label id="jeu_p_1_h13"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">14</span>
						<label id="jeu_p_1_h14"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">15</span>
						<label id="jeu_p_1_h15"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">16</span>
						<label id="jeu_p_1_h16"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">17</span>
						<label id="jeu_p_1_h17"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">18</span>
						<label id="jeu_p_1_h18"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">19</span>
						<label id="jeu_p_1_h19"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">20</span>
						<label id="jeu_p_1_h20"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">21</span>
						<label id="jeu_p_1_h21"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">22</span>
						<label id="jeu_p_1_h22"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">23</span>
						<label id="jeu_p_1_h23"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">24</span>
						<label id="jeu_p_1_h24"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">25</span>
						<label id="jeu_p_1_h25"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">26</span>
						<label id="jeu_p_1_h26"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">27</span>
						<label id="jeu_p_1_h27"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">28</span>
						<label id="jeu_p_1_h28"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">29</span>
						<label id="jeu_p_1_h29"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">30</span>
						<label id="jeu_p_1_h30"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">31</span>
						<label id="jeu_p_1_h31"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">32</span>
						<label id="jeu_p_1_h32"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">33</span>
						<label id="jeu_p_1_h33"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">34</span>
						<label id="jeu_p_1_h34"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">35</span>
						<label id="jeu_p_1_h35"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">36</span>
						<label id="jeu_p_1_h36"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">37</span>
						<label id="jeu_p_1_h37"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">38</span>
						<label id="jeu_p_1_h38"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">39</span>
						<label id="jeu_p_1_h39"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">40</span>
						<label id="jeu_p_1_h40"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">41</span>
						<label id="jeu_p_1_h41"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">42</span>
						<label id="jeu_p_1_h42"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">43</span>
						<label id="jeu_p_1_h43"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">44</span>
						<label id="jeu_p_1_h44"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">45</span>
						<label id="jeu_p_1_h45"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">46</span>
						<label id="jeu_p_1_h46"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">47</span>
						<label id="jeu_p_1_h47"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">48</span>
						<label id="jeu_p_1_h48"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">49</span>
						<label id="jeu_p_1_h49"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">50</span>
						<label id="jeu_p_1_h50"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">51</span>
						<label id="jeu_p_1_h51"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">52</span>
						<label id="jeu_p_1_h52"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">53</span>
						<label id="jeu_p_1_h53"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">54</span>
						<label id="jeu_p_1_h54"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">55</span>
						<label id="jeu_p_1_h55"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">56</span>
						<label id="jeu_p_1_h56"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">57</span>
						<label id="jeu_p_1_h57"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">58</span>
						<label id="jeu_p_1_h58"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">59</span>
						<label id="jeu_p_1_h59"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">60</span>
						<label id="jeu_p_1_h60"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">61</span>
						<label id="jeu_p_1_h61"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">62</span>
						<label id="jeu_p_1_h62"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">63</span>
						<label id="jeu_p_1_h63"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">64</span>
						<label id="jeu_p_1_h64"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">65</span>
						<label id="jeu_p_1_h65"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">66</span>
						<label id="jeu_p_1_h66"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">67</span>
						<label id="jeu_p_1_h67"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">68</span>
						<label id="jeu_p_1_h68"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">69</span>
						<label id="jeu_p_1_h69"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">

						<span class="kl8">70</span>
						<label id="jeu_p_1_h70"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">71</span>
						<label id="jeu_p_1_h71"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">72</span>
						<label id="jeu_p_1_h72"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">73</span>
						<label id="jeu_p_1_h73"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">74</span>
						<label id="jeu_p_1_h74"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">75</span>
						<label id="jeu_p_1_h75"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">76</span>
						<label id="jeu_p_1_h76"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">77</span>
						<label id="jeu_p_1_h77"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">78</span>
						<label id="jeu_p_1_h78"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">79</span>
						<label id="jeu_p_1_h79"></label>
					</div>
				</li>
                                <li>
					<div class="liBox mb6 ">
						<span class="kl8">80</span>
						<label id="jeu_p_1_h80"></label>
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
      <td class="boxbg" align="center" width="10%"><a href="javascript:void(0);" onclick="javascript:hideBetPage();"><img src="images/quit1.png" /></a></td>
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