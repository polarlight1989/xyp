<?php 
include_once 'offGame.php';
global $user, $UserOut;

if ($user[0]['g_look'] == 2 || $user[0]['g_out'] != 1)  exit(back($UserOut));

$txtMomey=$_POST['txtMomey'];
$jiangqi=$_POST['jiangqi'];
$wanfa=$_POST['wanfa'];
$caizhong=$_POST['caizhong'];
if(!is_numeric($caizhong)){back('非法提交');exit;}
$gameid=$caizhong;
$caizhong=$caizhong==0 ? '' : $caizhong;
$game_name=get_gameName($gameid);
$game_type=get_gamesmName($gameid);
if(!is_numeric($txtMomey) || $txtMomey<=0){back('金额错误');exit;}

$db = new DB();
$result = $db->query("SELECT `g_id`,`g_qishu`, `g_feng_date`, `g_open_date` FROM g_kaipan$caizhong WHERE `g_lock` = 2 and g_id=$jiangqi LIMIT 1 ", 1);
$qishu=	$result[0]['g_qishu'];
$g_id=	$result[0]['g_id'];
if($g_id!=$jiangqi || strtotime($result[0]['g_feng_date'])-time()<=0){
	//exit("$g_id!=$jiangqi");
	back($qishu.' 已经封盘！');exit;
}


$data_arr=explode('|',$_POST['data']);
//print_r($data_arr);exit;
if(!$_POST['data'] || strpos($data_arr[0],'jeu_p_')===false){
	back('非法提交');exit;
}
$list=array();
foreach($data_arr as $key=>$data){
	$val_arr=explode(',',$data);
	$ball_arr=explode('_',$val_arr[0]);
	$list[$key]=array('ball'=>$ball_arr[2],'h'=>$ball_arr[3],'pl'=>$val_arr[1]);
}

?><!DOCTYPE html>  
<html>
<head>  
<title>遊戲大廳</title>  
<link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.mobile-1.4.3.js"></script>
<script src="js/mobi_common.js" type="text/javascript"></script>
<link href="css/showLoading.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.showLoading.min.js"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content="telephone=no" name="format-detection" />
<script type="text/javascript">

    $(document).ready(function () {
        jQuery.mobile.ajaxEnabled = false;
        $('.operate').touchend(function (e) {
            Del_Dom($(this).attr("ajxa_l"));
        });
        $('#submit').touchend(function (e) {
            Get_Ps();
        });
        $('.m_sum').change(function (e) {
            Sum_Dom();
        });
    });
    function Del_Dom(id) {
        if ($("#l_" + id).hasClass("liBg")) {
            $("#l_" + id).removeClass("liBg");
            $("#l_" + id).find("p:eq(0)").addClass("lv").removeClass("deleLing");
            $("#l_" + id).find("p:eq(1)").removeClass("deleLing").find("span:eq(1)").addClass("hong");
            $("#l_" + id).find("a:eq(0)").removeClass("lh").children("p").text('刪除');
            $("#m_" + id).attr("disabled", false);
            $("#r_" + id).attr("disabled", false);
			$("#h_" + id).attr("disabled", false);
            $("#p_" + id).attr("disabled", false);
            $("#i_" + id).attr("disabled", false);
            $("#is_" + id).attr("disabled", false);
        }
        else {
            $("#l_" + id).addClass("liBg");
            $("#l_" + id).find("p:lt(2)").removeClass("lv").addClass("deleLing").find("span:eq(1)").removeClass("hong");
            $("#l_" + id).find("a:eq(0)").addClass("lh").children("p").text('恢復');
            $("#m_" + id).attr("disabled", true);
            $("#r_" + id).attr("disabled", true);
			$("#h_" + id).attr("disabled", true);
            $("#p_" + id).attr("disabled", true);
            $("#i_" + id).attr("disabled", true);
            $("#is_" + id).attr("disabled", true);
        }
        Sum_Dom();
    }
    function Sum_Dom() {
        var m_money = 0;
        var m_count = 0;
        $(".m_sum").each(function () {
            if ($("#is_" + $(this).attr("ajxa_l")).val() == "1") {
                m_money += parseInt($(this).val());
                m_count++;
            }
        });
        $("#tz_sum").text(m_money);
        $("#tz_count").text(m_count);
        // if(parseInt($("#tz_sum").text())==0)
    }
    function Get_Ps() {
        if ($("#tz_count").text() == "0") {
            alert('至少選擇1注以上注單！');
            return false;
        }
        $('#Top_all').showLoading();
        $.ajax({
            type: 'POST',
            url: "L_Confirm_Jeu.php",
            data: $('#form1').serialize(), // 你的formid 
            error: function () { $('#Top_all').hideLoading(); alert('处理程序出错,请通知管理员检查！'); },
            success: function (msg) {
                $("#alert_show").html(msg);
                $('#Top_all').hideLoading();
            }
        })
    }
    var G = { kc_type: "<?=$gameid?>", page_type: "<?=$wanfa?>", open_url: "get_ajax_<?=$game_type?>/GetDrawInfo.php", long_url: "", odds_url: "get_ajax_<?=$game_type?>/GetOdds.php", ball_ids: "GT=<?=$wanfa?>" };
    //page_type:排行數據用,t:冷熱遺漏用,GT:odds用
    //$(document).on("pageinit", "#pageone", function () {
    $(document).ready(function () {

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
</head>  
<body>  	
<div data-role="page" id="Top_all"> 

	<div data-role="header" data-position="fixed">
		<a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext"></a>
		<h1><?=$game_name?></h1>
		<a href="Main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse"></a>		
	</div> 
	<div data-role="content" class="pm">		
        <!--開獎號碼 -開獎提醒 begin-->
        <?php if($caizhong=="8"){ 
echo "<div class=\"JQBoxkl8\" id=\"draw_result\"></div><div class=\"JQBox\"><b class=\"lv\" id=\"t_qs\"></b>期&nbsp;&nbsp;&nbsp;開獎時間1:<b class=\"lan\" id=\"o_time\"></b>&nbsp;&nbsp;&nbsp;<b class=\"hong\" id=\"c_time\">距封盤:</b><b class=\"lan\" style=\"float:right; margin-right:5px;\" id=\"up_countdown\"></b></div>";  
 }else{
echo "<div class=\"JQBox\" id=\"draw_result\"></div><div class=\"JQBox\"><b class=\"lv\" id=\"t_qs\"></b>期&nbsp;&nbsp;&nbsp;開獎時間:<b class=\"lan\" id=\"o_time\"></b>&nbsp;&nbsp;&nbsp;<b class=\"hong\" id=\"c_time\">距封盤:</b><b class=\"lan\" style=\"float:right; margin-right:5px;\" id=\"up_countdown\"></b></div>";  

}?>
        <!--開獎號碼 -開獎提醒 end-->

		<!--玩法-->
		<div class="DDbox"><? //print_r($list);echo $key;?>
        <form id="form1" >
			<div class="DDtitle">
				合計:<b class="hong" id="tz_sum"><?=$txtMomey*($key+1)?></b> <b class="f10" >[共<b id="tz_count" class='hong'><?=$key+1?></b>注]</b>
				<a href="javascript:void(0);" data-transition="slide" id="submit"><div class="QDbtn">確定</div></a>
				<a href="<?=$game_type?>_<?=$gameid==8 ? 'zh' : 'lm'?>.php?lottery_type=<?=$_REQUEST['lottery_type']?>&player_type=<?=$_REQUEST['player_type']?>" data-transition="slide" data-direction="reverse"><div class="QXbtn">取消</div></a>
			</div>
			<div class="box">
				<b class="w1">期數</b><b class="w1">玩法</b><b class="w2">金額</b><b class="w2">操作</b>
				<ul>
                <?
                foreach($list as $li=>$bet_list){
					$ballname=get_ballname($gameid,'Ball_'.$bet_list['ball'],$bet_list['h']);
					$wfname=get_wfname($gameid,'Ball_'.$bet_list['ball'],$bet_list['h']);
					//echo $gameid.",'Ball_".$bet_list['ball'].",".$bet_list['h'];
				?>
					<li id="l_<?=$li+1?>">
						<p class="lv w1"><?=$qishu?></p>
						<p class="w1"><span id="v_<?=$li+1?>"><?=$ballname?> [<?=$wfname?>]</span><br><span class="hong"><?=$bet_list['pl']?></span></p>
						<p class="w2"><input type="tel" id="m_<?=$li+1?>" name="uPI_M[]" class="m_sum" value="<?=$txtMomey?>" ajxa_l="<?=$li+1?>"></p>
						<a href="javascript:void(0);"  class="operate"  ajxa_l="<?=$li+1?>"><p class="w2">刪除</p></a>
                        <input type="hidden"  id="is_<?=$li+1?>"  name="is_c[]" value="1" />
                        <input type="hidden"  id="r_<?=$li+1?>" name="uPI_ID[]" value="<?=$bet_list['ball']?>" />
                        <input type="hidden"  id="h_<?=$li+1?>" name="uPI_h[]" value="<?=$bet_list['h']?>" />
                        <input type="hidden"  id="p_<?=$li+1?>" name="uPI_P[]" value="<?=$bet_list['pl']?>" />
                        <input type="hidden"  id="i_<?=$li+1?>"  name="i_index[]" value="<?=$li+1?>" />
					</li>
                  <? }?>  
				</ul>
			<div class="clear"></div>
		  </div>			
		<div class="clear"></div>
        <div>
        <input name="JeuValidate"  id="JeuValidate" type="hidden" value="07211034143918">
                        <input type="hidden"  name="caizhong" value="<?=$gameid?>" />
                        <input type="hidden"  name="wanfa" value="<?=$wanfa?>" />
                        <input type="hidden"  name="jiangqi" value="<?=$jiangqi?>" />
                        <input type="hidden" name="shortcut" value="<?=$caizhong?>" />
        </div>
        <div id="alert_show" style="display:none;"></div>
        </form>	
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
<form method="post" action="touzhu_.php" id="myform" onsubmit = "return checkUser();" >
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