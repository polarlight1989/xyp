<?
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
include_once ROOT_PATH.'functioned/peizhi.php';
global $user;
?><!DOCTYPE html>  
<html>  
<head>  
<title>遊戲大廳</title>
<link rel="stylesheet" href="css/jquery.mobile-1.4.3.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.mobile-1.4.3.js"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

</head>  
<body>
<div data-role="page"> 
<script>
    $(document).ready(function () {
        // 此处是 jQuery 事件...
        // changeType('0', '廣東快樂十分');
        changeType('0');
    });
function changeType(v) {
    for (var i = 0; i < 60; i++) {
        if (("type_" + i) == ("type_" + v)) {
            $("#type_" + i).css('display', 'block');
        }
        else {
            $("#type_" + i).css('display', 'none');
        }
    }
    var txt = $("#sltType").find("option:selected").text();
    $("#headerTitle").html(txt);
    //$("#ddlregtype").find("option:selected").text();

}
</script>
	<div data-role="header" data-position="fixed">
		<a href="#defaultpanel" data-role="botton" data-icon="bars" data-iconpos="notext"></a>
		<h1><span id="headerTitle"></span>&nbsp;玩法規則</h1>
		<a href="main.php" data-role="botton" data-icon="home" data-iconpos="notext" data-transition="slide"  data-direction="reverse"></a>
		<!--彩種選擇-->
		<div class="TZtitle">
		<div data-role="fieldcontain">
			<fieldset data-role="controlgroup" data-type="horizontal">
				<select id="sltType" onChange="changeType(this.value)">
				<?php
				 if($peizhigdklsf=="1"){
				 echo " <option value=\"0\" selected=selected>廣東快樂十分</option>";
				 }
				  if($peizhicqssc=="1"){
				 echo " <option value=\"2\" >重慶時時彩</option>";
				 }
				 if($peizhijxssc=="1"){
				  echo " <option value=\"3\" > 极速时时彩</option>";
				  }
				   if($peizhixjssc=="1"){
				   echo " <option value=\"10\" >新疆時時彩</option>";
				   }
				    if($peizhitjssc=="1"){
					echo " <option value=\"11\" >天津时时彩</option>";
					}
					 if($peizhipk10=="1"){
				 echo " <option value=\"6\" >北京赛车PK10</option>";
				 }
				  if($peizhinc=="1"){
				 echo " <option value=\"9\" >幸运农场</option>";
				 }
				  if($peizhixyft=="1"){
				 echo " <option value=\"4\" >极速赛车</option>";
				 }
				  if($peizhijssz=="1"){
				  echo " <option value=\"7\" >吉林快3</option>";
				  }
				   if($peizhikl8=="1"){
				 echo " <option value=\"8\" >快樂8(雙盤)</option>";
				 }
				 ?>
				</select>
			</fieldset>
		</div>
		</div>
	</div> 
	<div data-role="content" class="pm">		
		<!--玩法規則-->
			<!--广东快乐十分 begin-->
			<div class="contentNode" id="type_0">
				<div class="box">
					<h1>重要聲明:</h1>
					<ul>
						<li><label>1.</label><span>如果客護懷疑自己的資料被盜用，應立即通知本公司，並更改詳細資料，以前的使用者名稱及密碼將全部無效。</span></li>
						<li><label>2.</label><span>客護有責任確保自己的帳護及登入資料的保密性。以使用者名稱及密碼進行的任何網上投註將被視為有效。</span></li>
						<li><label>3.</label><span>公佈賠率時出現的任何打字錯誤或非故意人為失誤，本公司保留改正錯誤和按正確賠率結算投註的權力。您居住所在地的法律有可能規定網路博奕不合法；若此情況屬實，本公司將不會批準您使用付帳卡進行交易。</span></li>
						<li><label>4.</label><span>每次登入時客護都應該核對自己的帳護結餘額。如對餘額有任何疑問，請在第一時間內通知本公司。</span></li>
						<li><label>5.</label><span>一旦投註被接受，則不得取消或修改。</span></li>
						<li><label>6.</label><span>所有號碼賠率將不時浮動，派彩時的賠率將以確認投註時之賠率為準。</span></li>
						<li><label>7.</label><span>每註最高投註金額按不同[場次]及[投註項目]及[會員帳號]設定浮動。如投註金額超過上述設定，本公司有權取消超過之投註金額。</span></li>
						<li><label>8.</label><span>所有投註都必須在開獎前時間內進行否則投註無效。</span></li>
						<li class="line"><label>9.</label><span>所有投註派彩彩金皆含本金。</span></li>
					</ul>
					
					<h1>广东快乐十分規則說明:</h1>
					<ul>
						<li class="line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;每期广东快乐十分开奖球数共八粒。每粒球除了总和玩法，其它都有单独的投注页面。广东快乐十分每天开84期，每期间隔10分钟。投注时间为8分钟，等待开奖时间为2分钟，北京时间（GMT+8）每天白天从上午09：00开到晚上23：00。</li>
					</ul>
					<p>※ 两面：<b>指单、双；大、小；尾大、尾小。</b></p>
					<ul>
						<li><label>●</label><span><strong>单、双：</strong>号码为双数叫双，如8、16；号码为单数叫单，如19、5。</span></li>
						<li><label>●</label><span><strong>大、小：</strong>开出之号码大于或等于11为大，小于或等于10为小。</span></li>
						<li><label>●</label><span><strong>尾大、尾小：</strong>开出之尾数大于或等于5为尾大，小于或等于4为尾小。</span></li>
						<li class="line"><label>&nbsp;</label><span>每一个号码为一投注组合，假如投注号码为开奖号码并在所投的球位置，视为中奖，其余情形视为不中奖。</span></li>
					</ul>
					<p>※ 中发白</p>
					<ul>
						<li><label>●</label><span><strong>中：</strong>开出之号码为01、02、03、04、05、06、07 </span></li>
						<li><label>●</label><span><strong>发：</strong>开出之号码为08、09、10、11、12、13、14</span></li>
						<li class="line"><label>●</label><span><strong>白：</strong>开出之号码为15、16、17、18、19、20 </span></li>
					</ul>
					<p>※ 方位</p>
					<ul>
						<li><label>●</label><span><strong>东：</strong>开出之号码为01、05、09、13、17 </span></li>
						<li><label>●</label><span><strong>南：</strong>开出之号码为02、06、10、14、18 </span></li>
						<li><label>●</label><span><strong>西：</strong>开出之号码为03、07、11、15、19 </span></li>
						<li class="line"><label>●</label><span><strong>北：</strong>开出之号码为04、08、12、16、20</span></li>
					</ul>
					<p>※ 总和单双</p>
					<ul>
						<li class="line"><label>●</label><span>所有8个开奖号码的数字总和值是单数为总和单，如数字总和值是31、51；所有8个开奖号码的数字总和值是双数为总和双，如数字总和是42、80；假如投注组合符合中奖结果，视为中奖，其余情形视为不中奖。</span></li>
					</ul>
					<p>※ 总和大小</p>
					<ul>
						<li class="line"><label>●</label><span>所有8个开奖号码的数字总和值85到132为总大；所有8个开奖号码的数字总和值36到83为总分小；所有8个开奖号码的数字总和值为84打和；如开奖号码为01、20、02、08、17、09、11，数字总和是68，则总分小。假如投注组合符合中奖结果，视为中奖，其余情形视为不中奖，打和不计算结果。 </span></li>
					</ul>
					<p>※ 总尾大小</p>
					<ul>
						<li class="line"><label>●</label><span>所有8个开奖号码的数字总和数值的个位数大于或等于5为总尾大，小于或等于4为总尾小；假如投注组合符合中奖结果，视为中奖，其余情形视为不中奖。</span></li>
					</ul>
					<p>※ 选二任选</p>
					<ul>
						<li class="line"><label>●</label><span>指从01至20中任意选择2个号码对开奖号码中任意2个位置的投注。 投注号码与开奖号码中任意2个位置的号码相符，即中奖。</span></li>
					</ul>
					<p>※ 选二连组</p>
					<ul>
						<li class="line"><label>●</label><span>指从01至20中任意选择2个号码对开奖号码中按开奖顺序出现的2个连续位置的投注。 投注号码与开奖号码中按开奖顺序出现的2个连续位置的号码相符（顺序不限），即中奖。</span></li>
					</ul>
					<p>※ 选二连直</p>
					<ul>
						<li class="line"><label>●</label><span>指从01至20中任意选择2个号码对开奖号码中按开奖顺序出现的2个连续位置按位相符的投注。 投注号码与开奖号码中按开奖顺序出现的2个连续位置的号码按位相符，即中奖。 </span></li>
					</ul>
					<p>※ 选三任选</p>
					<ul>
						<li class="line"><label>●</label><span>指从01至20中任意选择3个号码对开奖号码中任意3个位置的投注。 投注号码与开奖号码中任意3个位置的号码相符，即中奖。</span></li>
					</ul>
					<p>※ 选三前组</p>
					<ul>
						<li class="line"><label>●</label><span>指从01至20中任意选择3个号码对开奖号码中按开奖顺序出现的前3个连续位置的投注。 投注号码与开奖号码中按开奖顺序出现的前3个位置的号码相符（顺序不限），即中奖。 </span></li>
					</ul>
					<p>※ 选三前直</p>
					<ul>
						<li class="line"><label>●</label><span>指从01至20中任意选择3个号码对开奖号码中按开奖顺序出现的前3个连续位置按位相符的投注。 投注号码与开奖号码中按开奖顺序出现的前3个位置的号码按位相符，即中奖。</span></li>
					</ul>
					<p>※ 选四任选</p>
					<ul>
						<li class="line"><label>●</label><span>指从01至20中任意选择4个号码，对开奖号码中任意4个位置的投注。 投注号码与开奖号码中任意4个位置的号码相符，即中奖。</span></li>
					</ul>
					<p>※ 选五任选</p>
					<ul>
						<li class="line"><label>●</label><span>指从01至20中任意选择5个号码，对开奖号码中任意5个位置的投注。 投注号码与开奖号码中任意5个位置的号码相符，即中奖。</span></li>
					</ul>
					<p>※ 龙虎：<b>以第一球的中奖号码和第八球的中奖号码做为对奖号码。</b></p>
					<ul>
						<li><label>●</label><span><strong>龙：</strong>开出之号码第一球的中奖号码大于第八球的中奖号码。如 第一球开出14 第八球开出09；第一球开出17 第八球开出08；第一球开出05 第八球开出01...中奖为龙。</span></li>
						<li><label>●</label><span><strong>虎：</strong>开出之号码第一球的中奖号码小于第八球的中奖号码。如 第一球开出14 第八球开出16；第一球开出13 第八球开出18；第一球开出05 第八球开出08...中奖为虎。</span></li>
					</ul>
				<div class="clear"></div>
				</div>
			<div class="clear"></div>
			</div>
			<!--end-->
			
			<!--重慶時時彩 begin-->
			<div class="contentNode" id="type_2">
				<div class="box">
					<h1>重要聲明:</h1>
					<ul>
						<li><label>1.</label><span>如果客護懷疑自己的資料被盜用，應立即通知本公司，並更改詳細資料，以前的使用者名稱及密碼將全部無效。</span></li>
						<li><label>2.</label><span>客護有責任確保自己的帳護及登入資料的保密性。以使用者名稱及密碼進行的任何網上投註將被視為有效。</span></li>
						<li><label>3.</label><span>公佈賠率時出現的任何打字錯誤或非故意人為失誤，本公司保留改正錯誤和按正確賠率結算投註的權力。您居住所在地的法律有可能規定網路博奕不合法；若此情況屬實，本公司將不會批準您使用付帳卡進行交易。</span></li>
						<li><label>4.</label><span>每次登入時客護都應該核對自己的帳護結餘額。如對餘額有任何疑問，請在第一時間內通知本公司。</span></li>
						<li><label>5.</label><span>一旦投註被接受，則不得取消或修改。</span></li>
						<li><label>6.</label><span>所有號碼賠率將不時浮動，派彩時的賠率將以確認投註時之賠率為準。</span></li>
						<li><label>7.</label><span>每註最高投註金額按不同[場次]及[投註項目]及[會員帳號]設定浮動。如投註金額超過上述設定，本公司有權取消超過之投註金額。</span></li>
						<li><label>8.</label><span>所有投註都必須在開獎前時間內進行否則投註無效。</span></li>
						<li class="line"><label>9.</label><span>所有投註派彩彩金皆含本金。</span></li>
					</ul>	
					<h1>重慶時時彩規則說明:</h1>
					<ul>
						<li class="line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;该游戏的投注时间、开奖时间和开奖号码与重庆时时彩完全同步，北京时间（GMT+8）每天白天从上午10：00开到晚上22：00，夜场从22:00至凌晨2点,每10分钟开一次奖，夜场每5分鐘开一次奖,每天开奖120期(白天72期,夜间48期)。 </li>
					</ul>
					<p>※ 第一球~第五球</p>
					<ul>
						<li><label>●</label><span><strong>第一球特~第五球特：</strong>第一球特、第二球特、第三球特、第四球特、第五球特：指下注的每一球特与开出之号码其开奖顺序及开奖号码相同，视為中奖，如第一球开出号码8，下注第一球為8者视為中奖，其餘情形视為不中奖。</span></li>
						<li><label>●</label><span><strong>单双大小：</strong><b>根据相应单项投注第一球特 ~ 第五球特开出的球号，判断胜负。</b></span></li>			
						<li><label>&nbsp;</label><span><strong>单双：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号為双数叫特双，如2、6；特码為单数叫特单，如1、3。</span></li>
						<li><label>&nbsp;</label><span><strong>大小：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号大於或等於5為特码大，小於或等於4為特码小。</span></li>
						<li><label>●</label><span><strong>总和单双大小：</strong></span></li>
						<li><label>&nbsp;</label><span><strong>单双：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号数字总和值是双数为总和双，数字总和值是单数为总和单。</span></li>
						<li class="line"><label>&nbsp;</label><span><strong>大小：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号大於或等於23為特码大，小於或等於22為特码小。</span></li>
					</ul>
					<p>※ 前三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六 </p>
					<ul>
						<li><label>●</label><span><strong>豹子：</strong>中奖号码的个位十位百位数字都相同。----如中奖号码为000、111、999等，中奖号码的个位十位百位数字相同，则投注豹子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>顺子：</strong>中奖号码的个位十位百位数字都相连，不分顺序。（数字9、0、1相连）----如中奖号码为123、901、321、546等，中奖号码个位十位百位数字相连，则投注顺子者视为中奖，其它视为不中奖。 </span></li>			
						<li><label>●</label><span><strong>对子：</strong>中奖号码的个位十位百位任意两位数字相同。（不包括豹子）----如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。如果开奖号码为豹子,则对子视为不中奖。<br>如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>半顺：</strong>中奖号码的个位十位百位任意两位数字相连，不分顺序。（不包括顺子、对子。）----如中奖号码为125、540、390、706，中奖号码有两位数字相连，则投注半顺者视为中奖，其它视为不中奖。如果开奖号码为顺子、对子,则半顺视为不中奖。--如中奖号码为123、901、556、233，视为不中奖。 </span></li>
						<li class="line"><label>●</label><span><strong>杂六：</strong>不包括豹子、对子、顺子、半顺的所有中奖号码。----如中奖号码为157，中奖号码位数之间无关联性，则投注杂六者视为中奖，其它视为不中奖。 </span></li>
					</ul>
					<p>※ 中三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六</p>
					<ul>
						<li><label>●</label><span><strong>豹子：</strong>中奖号码的十位百位千位数字都相同。----如中奖号码为000、111、999等，中奖号码的十位百位千位数字相同，则投注豹子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>顺子：</strong>中奖号码的十位百位千位数字都相连，不分顺序。（数字9、0、1相连）----如中奖号码为123、901、321、546等，中奖号码十位百位千位数字相连，则投注顺子者视为中奖，其它视为不中奖。 </span></li>			
						<li><label>●</label><span><strong>对子：</strong>中奖号码的十位百位千位任意两位数字相同。（不包括豹子）----如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖如果开奖号码为豹子,则对子视为不中奖。<br>
			如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>半顺：</strong>中奖号码的十位百位千位任意两位数字相连，不分顺序。（不包括顺子、对子，数字9、0、1相连）----如中奖号码为125、540、390、706，中奖号码有两位数字相连，则投注半顺者视为中奖，其它视为不中奖。如果开奖号码为顺子、对子,则半顺视为不中奖。--如中奖号码为123、901、556、233，视为不中奖。</span></li>
						<li class="line"><label>●</label><span><strong>杂六：</strong>不包括豹子、对子、顺子、半顺的所有中奖号码。----如中奖十位百位千位号码为157，中奖号码位数之间无关联性，则投注杂六者视为中奖，其它视为不中奖。</span></li>
					</ul>
					<p>※ 后三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六</p>
					<ul>
						<li><label>●</label><span><strong>豹子：</strong>中奖号码的百位千位万位数字都相同。----如中奖号码为000、111、999等，中奖号码的百位千位万位数字相同，则投注豹子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>顺子：</strong>中奖号码的百位千位万位数字都相连，不分顺序。（数字9、0、1相连）----如中奖号码为123、901、321、546等，中奖号码百位千位万位数字相连，则投注顺子者视为中奖，其它视为不中奖。</span></li>			
						<li><label>●</label><span><strong>对子：</strong>中奖号码的百位千位万位任意两位数字相同。（不包括豹子）----如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。如果开奖号码为豹子,则对子视为不中奖。<br>如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>半顺：</strong>中奖号码的百位千位万位任意两位数字相连，不分顺序。（不包括顺子、对子，数字9、0、1相连）----如中奖号码为125、540、390、706，中奖号码有两位数字相连，则投注半顺者视为中奖，其它视为不中奖。如果开奖号码为顺子、对子,则半顺视为不中奖。--如中奖号码为123、901、556、233，视为不中奖。</span></li>
						<li class="line"><label>●</label><span><strong>杂六：</strong>不包括豹子、对子、顺子、半顺的所有中奖号码。----如中奖百位千位万位号码为157，中奖号码位数之间无关联性，则投注杂六者视为中奖，其它视为不中奖。</span></li>
					</ul>
					<p>※ 龙虎和特殊玩法： 龙 > 虎 > 和 （0为最小，9为最大）</p>
					<ul>
						<li><label>●</label><span><strong>龙：</strong>开出之号码第一球（万位）的中奖号码大于第五球（个位）的中奖号码，如出和局为打和。如 第一球开出4 第五球开出2；第一球开出9 第五球开出8；第一球开出5 第五球开出1...中奖为龙。</span></li>
						<li><label>●</label><span><strong>虎：</strong>开出之号码第一球（万位）的中奖号码小于第五球（个位）的中奖号码，如出和局为打和。如 第一球开出7 第五球开出9；第一球开出3 第五球开出5；第一球开出5 第五球开出8...中奖为虎。</span></li>			
						<li><label>●</label><span><strong>和：</strong>开出之号码第一球（万位）的中奖号码等于第五球（个位）的中奖号码，例如开出结果：2***2则投注和局者视为中奖，其它视为不中奖。</span></li>
					</ul>
			
				<div class="clear"></div>
				</div>
			<div class="clear"></div>
			</div>
			<!--end-->
			
			
			
			<!--极速时时彩 begin-->
			<div class="contentNode" id="type_3">
				<div class="box">
					<h1>重要聲明:</h1>
					<ul>
						<li><label>1.</label><span>如果客護懷疑自己的資料被盜用，應立即通知本公司，並更改詳細資料，以前的使用者名稱及密碼將全部無效。</span></li>
						<li><label>2.</label><span>客護有責任確保自己的帳護及登入資料的保密性。以使用者名稱及密碼進行的任何網上投註將被視為有效。</span></li>
						<li><label>3.</label><span>公佈賠率時出現的任何打字錯誤或非故意人為失誤，本公司保留改正錯誤和按正確賠率結算投註的權力。您居住所在地的法律有可能規定網路博奕不合法；若此情況屬實，本公司將不會批準您使用付帳卡進行交易。</span></li>
						<li><label>4.</label><span>每次登入時客護都應該核對自己的帳護結餘額。如對餘額有任何疑問，請在第一時間內通知本公司。</span></li>
						<li><label>5.</label><span>一旦投註被接受，則不得取消或修改。</span></li>
						<li><label>6.</label><span>所有號碼賠率將不時浮動，派彩時的賠率將以確認投註時之賠率為準。</span></li>
						<li><label>7.</label><span>每註最高投註金額按不同[場次]及[投註項目]及[會員帳號]設定浮動。如投註金額超過上述設定，本公司有權取消超過之投註金額。</span></li>
						<li><label>8.</label><span>所有投註都必須在開獎前時間內進行否則投註無效。</span></li>
						<li class="line"><label>9.</label><span>所有投註派彩彩金皆含本金。</span></li>
					</ul>	
					<h1>极速时时彩規則說明:</h1>
					<ul>
						<li class="line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;该游戏的投注时间、开奖时间和开奖号码与重庆时时彩完全同步，北京时间（GMT+8）每天白天从上午00：00开到晚上24：00，每5分鐘开一次奖,每天开奖288期。 </li>
					</ul>
					<p>※ 第一球~第五球</p>
					<ul>
						<li><label>●</label><span><strong>第一球特~第五球特：</strong>第一球特、第二球特、第三球特、第四球特、第五球特：指下注的每一球特与开出之号码其开奖顺序及开奖号码相同，视為中奖，如第一球开出号码8，下注第一球為8者视為中奖，其餘情形视為不中奖。</span></li>
						<li><label>●</label><span><strong>单双大小：</strong><b>根据相应单项投注第一球特 ~ 第五球特开出的球号，判断胜负。</b></span></li>			
						<li><label>&nbsp;</label><span><strong>单双：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号為双数叫特双，如2、6；特码為单数叫特单，如1、3。</span></li>
						<li><label>&nbsp;</label><span><strong>大小：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号大於或等於5為特码大，小於或等於4為特码小。</span></li>
						<li><label>●</label><span><strong>总和单双大小：</strong></span></li>
						<li><label>&nbsp;</label><span><strong>单双：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号数字总和值是双数为总和双，数字总和值是单数为总和单。</span></li>
						<li class="line"><label>&nbsp;</label><span><strong>大小：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号大於或等於23為特码大，小於或等於22為特码小。</span></li>
					</ul>
					<p>※ 前三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六 </p>
					<ul>
						<li><label>●</label><span><strong>豹子：</strong>中奖号码的个位十位百位数字都相同。----如中奖号码为000、111、999等，中奖号码的个位十位百位数字相同，则投注豹子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>顺子：</strong>中奖号码的个位十位百位数字都相连，不分顺序。（数字9、0、1相连）----如中奖号码为123、901、321、546等，中奖号码个位十位百位数字相连，则投注顺子者视为中奖，其它视为不中奖。 </span></li>			
						<li><label>●</label><span><strong>对子：</strong>中奖号码的个位十位百位任意两位数字相同。（不包括豹子）----如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。如果开奖号码为豹子,则对子视为不中奖。<br>如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>半顺：</strong>中奖号码的个位十位百位任意两位数字相连，不分顺序。（不包括顺子、对子。）----如中奖号码为125、540、390、706，中奖号码有两位数字相连，则投注半顺者视为中奖，其它视为不中奖。如果开奖号码为顺子、对子,则半顺视为不中奖。--如中奖号码为123、901、556、233，视为不中奖。 </span></li>
						<li class="line"><label>●</label><span><strong>杂六：</strong>不包括豹子、对子、顺子、半顺的所有中奖号码。----如中奖号码为157，中奖号码位数之间无关联性，则投注杂六者视为中奖，其它视为不中奖。 </span></li>
					</ul>
					<p>※ 中三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六</p>
					<ul>
						<li><label>●</label><span><strong>豹子：</strong>中奖号码的十位百位千位数字都相同。----如中奖号码为000、111、999等，中奖号码的十位百位千位数字相同，则投注豹子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>顺子：</strong>中奖号码的十位百位千位数字都相连，不分顺序。（数字9、0、1相连）----如中奖号码为123、901、321、546等，中奖号码十位百位千位数字相连，则投注顺子者视为中奖，其它视为不中奖。 </span></li>			
						<li><label>●</label><span><strong>对子：</strong>中奖号码的十位百位千位任意两位数字相同。（不包括豹子）----如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖如果开奖号码为豹子,则对子视为不中奖。<br>
			如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>半顺：</strong>中奖号码的十位百位千位任意两位数字相连，不分顺序。（不包括顺子、对子，数字9、0、1相连）----如中奖号码为125、540、390、706，中奖号码有两位数字相连，则投注半顺者视为中奖，其它视为不中奖。如果开奖号码为顺子、对子,则半顺视为不中奖。--如中奖号码为123、901、556、233，视为不中奖。</span></li>
						<li class="line"><label>●</label><span><strong>杂六：</strong>不包括豹子、对子、顺子、半顺的所有中奖号码。----如中奖十位百位千位号码为157，中奖号码位数之间无关联性，则投注杂六者视为中奖，其它视为不中奖。</span></li>
					</ul>
					<p>※ 后三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六</p>
					<ul>
						<li><label>●</label><span><strong>豹子：</strong>中奖号码的百位千位万位数字都相同。----如中奖号码为000、111、999等，中奖号码的百位千位万位数字相同，则投注豹子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>顺子：</strong>中奖号码的百位千位万位数字都相连，不分顺序。（数字9、0、1相连）----如中奖号码为123、901、321、546等，中奖号码百位千位万位数字相连，则投注顺子者视为中奖，其它视为不中奖。</span></li>			
						<li><label>●</label><span><strong>对子：</strong>中奖号码的百位千位万位任意两位数字相同。（不包括豹子）----如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。如果开奖号码为豹子,则对子视为不中奖。<br>如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>半顺：</strong>中奖号码的百位千位万位任意两位数字相连，不分顺序。（不包括顺子、对子，数字9、0、1相连）----如中奖号码为125、540、390、706，中奖号码有两位数字相连，则投注半顺者视为中奖，其它视为不中奖。如果开奖号码为顺子、对子,则半顺视为不中奖。--如中奖号码为123、901、556、233，视为不中奖。</span></li>
						<li class="line"><label>●</label><span><strong>杂六：</strong>不包括豹子、对子、顺子、半顺的所有中奖号码。----如中奖百位千位万位号码为157，中奖号码位数之间无关联性，则投注杂六者视为中奖，其它视为不中奖。</span></li>
					</ul>
					<p>※ 龙虎和特殊玩法： 龙 > 虎 > 和 （0为最小，9为最大）</p>
					<ul>
						<li><label>●</label><span><strong>龙：</strong>开出之号码第一球（万位）的中奖号码大于第五球（个位）的中奖号码，如出和局为打和。如 第一球开出4 第五球开出2；第一球开出9 第五球开出8；第一球开出5 第五球开出1...中奖为龙。</span></li>
						<li><label>●</label><span><strong>虎：</strong>开出之号码第一球（万位）的中奖号码小于第五球（个位）的中奖号码，如出和局为打和。如 第一球开出7 第五球开出9；第一球开出3 第五球开出5；第一球开出5 第五球开出8...中奖为虎。</span></li>			
						<li><label>●</label><span><strong>和：</strong>开出之号码第一球（万位）的中奖号码等于第五球（个位）的中奖号码，例如开出结果：2***2则投注和局者视为中奖，其它视为不中奖。</span></li>
					</ul>
			
				<div class="clear"></div>
				</div>
			<div class="clear"></div>
			</div>
			<!--end-->
			
			
				<!--新疆時時彩 begin-->
			<div class="contentNode" id="type_10">
				<div class="box">
					<h1>重要聲明:</h1>
					<ul>
						<li><label>1.</label><span>如果客護懷疑自己的資料被盜用，應立即通知本公司，並更改詳細資料，以前的使用者名稱及密碼將全部無效。</span></li>
						<li><label>2.</label><span>客護有責任確保自己的帳護及登入資料的保密性。以使用者名稱及密碼進行的任何網上投註將被視為有效。</span></li>
						<li><label>3.</label><span>公佈賠率時出現的任何打字錯誤或非故意人為失誤，本公司保留改正錯誤和按正確賠率結算投註的權力。您居住所在地的法律有可能規定網路博奕不合法；若此情況屬實，本公司將不會批準您使用付帳卡進行交易。</span></li>
						<li><label>4.</label><span>每次登入時客護都應該核對自己的帳護結餘額。如對餘額有任何疑問，請在第一時間內通知本公司。</span></li>
						<li><label>5.</label><span>一旦投註被接受，則不得取消或修改。</span></li>
						<li><label>6.</label><span>所有號碼賠率將不時浮動，派彩時的賠率將以確認投註時之賠率為準。</span></li>
						<li><label>7.</label><span>每註最高投註金額按不同[場次]及[投註項目]及[會員帳號]設定浮動。如投註金額超過上述設定，本公司有權取消超過之投註金額。</span></li>
						<li><label>8.</label><span>所有投註都必須在開獎前時間內進行否則投註無效。</span></li>
						<li class="line"><label>9.</label><span>所有投註派彩彩金皆含本金。</span></li>
					</ul>	
					<h1>新疆時時彩規則說明:</h1>
					<ul>
						<li class="line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;该游戏的投注时间、开奖时间和开奖号码与重庆时时彩完全同步，北京时间（GMT+8）每天白天从上午10：10开到晚上02：00，每10分鐘开一次奖,每天开奖96期。 </li>
					</ul>
					<p>※ 第一球~第五球</p>
					<ul>
						<li><label>●</label><span><strong>第一球特~第五球特：</strong>第一球特、第二球特、第三球特、第四球特、第五球特：指下注的每一球特与开出之号码其开奖顺序及开奖号码相同，视為中奖，如第一球开出号码8，下注第一球為8者视為中奖，其餘情形视為不中奖。</span></li>
						<li><label>●</label><span><strong>单双大小：</strong><b>根据相应单项投注第一球特 ~ 第五球特开出的球号，判断胜负。</b></span></li>			
						<li><label>&nbsp;</label><span><strong>单双：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号為双数叫特双，如2、6；特码為单数叫特单，如1、3。</span></li>
						<li><label>&nbsp;</label><span><strong>大小：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号大於或等於5為特码大，小於或等於4為特码小。</span></li>
						<li><label>●</label><span><strong>总和单双大小：</strong></span></li>
						<li><label>&nbsp;</label><span><strong>单双：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号数字总和值是双数为总和双，数字总和值是单数为总和单。</span></li>
						<li class="line"><label>&nbsp;</label><span><strong>大小：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号大於或等於23為特码大，小於或等於22為特码小。</span></li>
					</ul>
					<p>※ 前三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六 </p>
					<ul>
						<li><label>●</label><span><strong>豹子：</strong>中奖号码的个位十位百位数字都相同。----如中奖号码为000、111、999等，中奖号码的个位十位百位数字相同，则投注豹子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>顺子：</strong>中奖号码的个位十位百位数字都相连，不分顺序。（数字9、0、1相连）----如中奖号码为123、901、321、546等，中奖号码个位十位百位数字相连，则投注顺子者视为中奖，其它视为不中奖。 </span></li>			
						<li><label>●</label><span><strong>对子：</strong>中奖号码的个位十位百位任意两位数字相同。（不包括豹子）----如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。如果开奖号码为豹子,则对子视为不中奖。<br>如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>半顺：</strong>中奖号码的个位十位百位任意两位数字相连，不分顺序。（不包括顺子、对子。）----如中奖号码为125、540、390、706，中奖号码有两位数字相连，则投注半顺者视为中奖，其它视为不中奖。如果开奖号码为顺子、对子,则半顺视为不中奖。--如中奖号码为123、901、556、233，视为不中奖。 </span></li>
						<li class="line"><label>●</label><span><strong>杂六：</strong>不包括豹子、对子、顺子、半顺的所有中奖号码。----如中奖号码为157，中奖号码位数之间无关联性，则投注杂六者视为中奖，其它视为不中奖。 </span></li>
					</ul>
					<p>※ 中三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六</p>
					<ul>
						<li><label>●</label><span><strong>豹子：</strong>中奖号码的十位百位千位数字都相同。----如中奖号码为000、111、999等，中奖号码的十位百位千位数字相同，则投注豹子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>顺子：</strong>中奖号码的十位百位千位数字都相连，不分顺序。（数字9、0、1相连）----如中奖号码为123、901、321、546等，中奖号码十位百位千位数字相连，则投注顺子者视为中奖，其它视为不中奖。 </span></li>			
						<li><label>●</label><span><strong>对子：</strong>中奖号码的十位百位千位任意两位数字相同。（不包括豹子）----如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖如果开奖号码为豹子,则对子视为不中奖。<br>
			如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>半顺：</strong>中奖号码的十位百位千位任意两位数字相连，不分顺序。（不包括顺子、对子，数字9、0、1相连）----如中奖号码为125、540、390、706，中奖号码有两位数字相连，则投注半顺者视为中奖，其它视为不中奖。如果开奖号码为顺子、对子,则半顺视为不中奖。--如中奖号码为123、901、556、233，视为不中奖。</span></li>
						<li class="line"><label>●</label><span><strong>杂六：</strong>不包括豹子、对子、顺子、半顺的所有中奖号码。----如中奖十位百位千位号码为157，中奖号码位数之间无关联性，则投注杂六者视为中奖，其它视为不中奖。</span></li>
					</ul>
					<p>※ 后三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六</p>
					<ul>
						<li><label>●</label><span><strong>豹子：</strong>中奖号码的百位千位万位数字都相同。----如中奖号码为000、111、999等，中奖号码的百位千位万位数字相同，则投注豹子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>顺子：</strong>中奖号码的百位千位万位数字都相连，不分顺序。（数字9、0、1相连）----如中奖号码为123、901、321、546等，中奖号码百位千位万位数字相连，则投注顺子者视为中奖，其它视为不中奖。</span></li>			
						<li><label>●</label><span><strong>对子：</strong>中奖号码的百位千位万位任意两位数字相同。（不包括豹子）----如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。如果开奖号码为豹子,则对子视为不中奖。<br>如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>半顺：</strong>中奖号码的百位千位万位任意两位数字相连，不分顺序。（不包括顺子、对子，数字9、0、1相连）----如中奖号码为125、540、390、706，中奖号码有两位数字相连，则投注半顺者视为中奖，其它视为不中奖。如果开奖号码为顺子、对子,则半顺视为不中奖。--如中奖号码为123、901、556、233，视为不中奖。</span></li>
						<li class="line"><label>●</label><span><strong>杂六：</strong>不包括豹子、对子、顺子、半顺的所有中奖号码。----如中奖百位千位万位号码为157，中奖号码位数之间无关联性，则投注杂六者视为中奖，其它视为不中奖。</span></li>
					</ul>
					<p>※ 龙虎和特殊玩法： 龙 > 虎 > 和 （0为最小，9为最大）</p>
					<ul>
						<li><label>●</label><span><strong>龙：</strong>开出之号码第一球（万位）的中奖号码大于第五球（个位）的中奖号码，如出和局为打和。如 第一球开出4 第五球开出2；第一球开出9 第五球开出8；第一球开出5 第五球开出1...中奖为龙。</span></li>
						<li><label>●</label><span><strong>虎：</strong>开出之号码第一球（万位）的中奖号码小于第五球（个位）的中奖号码，如出和局为打和。如 第一球开出7 第五球开出9；第一球开出3 第五球开出5；第一球开出5 第五球开出8...中奖为虎。</span></li>			
						<li><label>●</label><span><strong>和：</strong>开出之号码第一球（万位）的中奖号码等于第五球（个位）的中奖号码，例如开出结果：2***2则投注和局者视为中奖，其它视为不中奖。</span></li>
					</ul>
			
				<div class="clear"></div>
				</div>
			<div class="clear"></div>
			</div>
			<!--end-->
			
				<!--天津时时彩 begin-->
			<div class="contentNode" id="type_11">
				<div class="box">
					<h1>重要聲明:</h1>
					<ul>
						<li><label>1.</label><span>如果客護懷疑自己的資料被盜用，應立即通知本公司，並更改詳細資料，以前的使用者名稱及密碼將全部無效。</span></li>
						<li><label>2.</label><span>客護有責任確保自己的帳護及登入資料的保密性。以使用者名稱及密碼進行的任何網上投註將被視為有效。</span></li>
						<li><label>3.</label><span>公佈賠率時出現的任何打字錯誤或非故意人為失誤，本公司保留改正錯誤和按正確賠率結算投註的權力。您居住所在地的法律有可能規定網路博奕不合法；若此情況屬實，本公司將不會批準您使用付帳卡進行交易。</span></li>
						<li><label>4.</label><span>每次登入時客護都應該核對自己的帳護結餘額。如對餘額有任何疑問，請在第一時間內通知本公司。</span></li>
						<li><label>5.</label><span>一旦投註被接受，則不得取消或修改。</span></li>
						<li><label>6.</label><span>所有號碼賠率將不時浮動，派彩時的賠率將以確認投註時之賠率為準。</span></li>
						<li><label>7.</label><span>每註最高投註金額按不同[場次]及[投註項目]及[會員帳號]設定浮動。如投註金額超過上述設定，本公司有權取消超過之投註金額。</span></li>
						<li><label>8.</label><span>所有投註都必須在開獎前時間內進行否則投註無效。</span></li>
						<li class="line"><label>9.</label><span>所有投註派彩彩金皆含本金。</span></li>
					</ul>	
					<h1>天津时时彩規則說明:</h1>
					<ul>
						<li class="line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;该游戏的投注时间、开奖时间和开奖号码与重庆时时彩完全同步，北京时间（GMT+8）每天白天从上午09：10开到晚上23：00，每10分鐘开一次奖,每天开奖84期。 </li>
					</ul>
					<p>※ 第一球~第五球</p>
					<ul>
						<li><label>●</label><span><strong>第一球特~第五球特：</strong>第一球特、第二球特、第三球特、第四球特、第五球特：指下注的每一球特与开出之号码其开奖顺序及开奖号码相同，视為中奖，如第一球开出号码8，下注第一球為8者视為中奖，其餘情形视為不中奖。</span></li>
						<li><label>●</label><span><strong>单双大小：</strong><b>根据相应单项投注第一球特 ~ 第五球特开出的球号，判断胜负。</b></span></li>			
						<li><label>&nbsp;</label><span><strong>单双：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号為双数叫特双，如2、6；特码為单数叫特单，如1、3。</span></li>
						<li><label>&nbsp;</label><span><strong>大小：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号大於或等於5為特码大，小於或等於4為特码小。</span></li>
						<li><label>●</label><span><strong>总和单双大小：</strong></span></li>
						<li><label>&nbsp;</label><span><strong>单双：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号数字总和值是双数为总和双，数字总和值是单数为总和单。</span></li>
						<li class="line"><label>&nbsp;</label><span><strong>大小：</strong>根据相应单项投注的第一球特 ~ 第五球特开出的球号大於或等於23為特码大，小於或等於22為特码小。</span></li>
					</ul>
					<p>※ 前三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六 </p>
					<ul>
						<li><label>●</label><span><strong>豹子：</strong>中奖号码的个位十位百位数字都相同。----如中奖号码为000、111、999等，中奖号码的个位十位百位数字相同，则投注豹子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>顺子：</strong>中奖号码的个位十位百位数字都相连，不分顺序。（数字9、0、1相连）----如中奖号码为123、901、321、546等，中奖号码个位十位百位数字相连，则投注顺子者视为中奖，其它视为不中奖。 </span></li>			
						<li><label>●</label><span><strong>对子：</strong>中奖号码的个位十位百位任意两位数字相同。（不包括豹子）----如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。如果开奖号码为豹子,则对子视为不中奖。<br>如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>半顺：</strong>中奖号码的个位十位百位任意两位数字相连，不分顺序。（不包括顺子、对子。）----如中奖号码为125、540、390、706，中奖号码有两位数字相连，则投注半顺者视为中奖，其它视为不中奖。如果开奖号码为顺子、对子,则半顺视为不中奖。--如中奖号码为123、901、556、233，视为不中奖。 </span></li>
						<li class="line"><label>●</label><span><strong>杂六：</strong>不包括豹子、对子、顺子、半顺的所有中奖号码。----如中奖号码为157，中奖号码位数之间无关联性，则投注杂六者视为中奖，其它视为不中奖。 </span></li>
					</ul>
					<p>※ 中三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六</p>
					<ul>
						<li><label>●</label><span><strong>豹子：</strong>中奖号码的十位百位千位数字都相同。----如中奖号码为000、111、999等，中奖号码的十位百位千位数字相同，则投注豹子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>顺子：</strong>中奖号码的十位百位千位数字都相连，不分顺序。（数字9、0、1相连）----如中奖号码为123、901、321、546等，中奖号码十位百位千位数字相连，则投注顺子者视为中奖，其它视为不中奖。 </span></li>			
						<li><label>●</label><span><strong>对子：</strong>中奖号码的十位百位千位任意两位数字相同。（不包括豹子）----如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖如果开奖号码为豹子,则对子视为不中奖。<br>
			如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>半顺：</strong>中奖号码的十位百位千位任意两位数字相连，不分顺序。（不包括顺子、对子，数字9、0、1相连）----如中奖号码为125、540、390、706，中奖号码有两位数字相连，则投注半顺者视为中奖，其它视为不中奖。如果开奖号码为顺子、对子,则半顺视为不中奖。--如中奖号码为123、901、556、233，视为不中奖。</span></li>
						<li class="line"><label>●</label><span><strong>杂六：</strong>不包括豹子、对子、顺子、半顺的所有中奖号码。----如中奖十位百位千位号码为157，中奖号码位数之间无关联性，则投注杂六者视为中奖，其它视为不中奖。</span></li>
					</ul>
					<p>※ 后三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六</p>
					<ul>
						<li><label>●</label><span><strong>豹子：</strong>中奖号码的百位千位万位数字都相同。----如中奖号码为000、111、999等，中奖号码的百位千位万位数字相同，则投注豹子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>顺子：</strong>中奖号码的百位千位万位数字都相连，不分顺序。（数字9、0、1相连）----如中奖号码为123、901、321、546等，中奖号码百位千位万位数字相连，则投注顺子者视为中奖，其它视为不中奖。</span></li>			
						<li><label>●</label><span><strong>对子：</strong>中奖号码的百位千位万位任意两位数字相同。（不包括豹子）----如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。如果开奖号码为豹子,则对子视为不中奖。<br>如中奖号码为001，112、696，中奖号码有两位数字相同，则投注对子者视为中奖，其它视为不中奖。</span></li>
						<li><label>●</label><span><strong>半顺：</strong>中奖号码的百位千位万位任意两位数字相连，不分顺序。（不包括顺子、对子，数字9、0、1相连）----如中奖号码为125、540、390、706，中奖号码有两位数字相连，则投注半顺者视为中奖，其它视为不中奖。如果开奖号码为顺子、对子,则半顺视为不中奖。--如中奖号码为123、901、556、233，视为不中奖。</span></li>
						<li class="line"><label>●</label><span><strong>杂六：</strong>不包括豹子、对子、顺子、半顺的所有中奖号码。----如中奖百位千位万位号码为157，中奖号码位数之间无关联性，则投注杂六者视为中奖，其它视为不中奖。</span></li>
					</ul>
					<p>※ 龙虎和特殊玩法： 龙 > 虎 > 和 （0为最小，9为最大）</p>
					<ul>
						<li><label>●</label><span><strong>龙：</strong>开出之号码第一球（万位）的中奖号码大于第五球（个位）的中奖号码，如出和局为打和。如 第一球开出4 第五球开出2；第一球开出9 第五球开出8；第一球开出5 第五球开出1...中奖为龙。</span></li>
						<li><label>●</label><span><strong>虎：</strong>开出之号码第一球（万位）的中奖号码小于第五球（个位）的中奖号码，如出和局为打和。如 第一球开出7 第五球开出9；第一球开出3 第五球开出5；第一球开出5 第五球开出8...中奖为虎。</span></li>			
						<li><label>●</label><span><strong>和：</strong>开出之号码第一球（万位）的中奖号码等于第五球（个位）的中奖号码，例如开出结果：2***2则投注和局者视为中奖，其它视为不中奖。</span></li>
					</ul>
			
				<div class="clear"></div>
				</div>
			<div class="clear"></div>
			</div>
			<!--end-->
			
			<!--北京赛车PK10 begin-->
			<div class="contentNode" id="type_6">
				<div class="box">
					<h1>重要聲明:</h1>
					<ul>
						<li><label>1.</label><span>如果客護懷疑自己的資料被盜用，應立即通知本公司，並更改詳細資料，以前的使用者名稱及密碼將全部無效。</span></li>
						<li><label>2.</label><span>客護有責任確保自己的帳護及登入資料的保密性。以使用者名稱及密碼進行的任何網上投註將被視為有效。</span></li>
						<li><label>3.</label><span>公佈賠率時出現的任何打字錯誤或非故意人為失誤，本公司保留改正錯誤和按正確賠率結算投註的權力。您居住所在地的法律有可能規定網路博奕不合法；若此情況屬實，本公司將不會批準您使用付帳卡進行交易。</span></li>
						<li><label>4.</label><span>每次登入時客護都應該核對自己的帳護結餘額。如對餘額有任何疑問，請在第一時間內通知本公司。</span></li>
						<li><label>5.</label><span>一旦投註被接受，則不得取消或修改。</span></li>
						<li><label>6.</label><span>所有號碼賠率將不時浮動，派彩時的賠率將以確認投註時之賠率為準。</span></li>
						<li><label>7.</label><span>每註最高投註金額按不同[場次]及[投註項目]及[會員帳號]設定浮動。如投註金額超過上述設定，本公司有權取消超過之投註金額。</span></li>
						<li><label>8.</label><span>所有投註都必須在開獎前時間內進行否則投註無效。</span></li>
						<li class="line"><label>9.</label><span>所有投註派彩彩金皆含本金。</span></li>
					</ul>
					<h1>北京赛车(原名：北京福彩“PK拾”)規則說明:</h1>
					<ul>
						<li class="line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;该游戏的投注时间、开奖时间和开奖号码与“北京PK拾”完全同步，北京时间（GMT+8）每天白天从上午09:02开到晚上23:57，每5分鐘开一次奖,每天开奖179期。</li>
					</ul>
					<p>※ 1～10 两面：<b>指 单、双；大、小。</b></p>
					<ul>
						<li><label>●</label><span><strong>单、双：</strong>号码为双数叫双，如4、8；号码为单数叫单，如5、9。</span></li>
						<li class="line"><label>●</label><span><strong>大、小：</strong>开出之号码大于或等于6为大，小于或等于5为小。</span></li>
					</ul>
					<p>※ 第一名～第十名 车号指定</p>
					<ul>
						<li class="line"><label>●</label><span>每一个车号为一投注组合，开奖结果“投注车号”对应所投名次视为中奖，其余情形视为不中奖。 </span></li>
					</ul>
					<p>※ 1～5龙虎</p>
					<ul>
						<li><label>●</label><span><strong>冠　军 龙/虎：</strong>“第一名”车号大于“第十名”车号视为【龙】中奖、反之小于视为【虎】中奖，其余情形视为不中奖。</span></li>
						<li><label>●</label><span><strong>亚　军 龙/虎：</strong>“第二名”车号大于“第九名”车号视为【龙】中奖、反之小于视为【虎】中奖，其余情形视为不中奖。</span></li>
						<li><label>●</label><span><strong>第三名 龙/虎：</strong>“第三名”车号大于“第八名”车号视为【龙】中奖、反之小于视为【虎】中奖，其余情形视为不中奖。</span></li>
						<li><label>●</label><span><strong>第四名 龙/虎：</strong>“第四名”车号大于“第七名”车号视为【龙】中奖、反之小于视为【虎】中奖，其余情形视为不中奖。</span></li>
						<li class="line"><label>●</label><span><strong>第五名 龙/虎：</strong>“第五名”车号大于“第六名”车号视为【龙】中奖、反之小于视为【虎】中奖，其余情形视为不中奖。</span></li>
					</ul>
					<p>※ 冠军车号＋亚军车号＝冠亚和值</p>
					<ul>
						<li><label>●</label><span><strong>冠亚和单双：</strong>“冠亚和值”为单视为投注“单”的注单视为中奖，为双视为投注“双”的注单视为中奖，其余视为不中奖。</span></li>
						<li><label>●</label><span><strong>冠亚和大小：</strong>“冠亚和值”大于11时投注“大”的注单视为中奖，小于或等于11时投注“小”的注单视为中奖，其余视为不中奖。</span></li>
						<li><label>●</label><span><strong>冠亚和指定：</strong>“冠亚和值”可能出现的结果为3～19，  投中对应“冠亚和值”数字的视为中奖，其余视为不中奖。</span></li>
					</ul>
				<div class="clear"></div>
				</div>
			<div class="clear"></div>
			</div>
			<!--end-->
			
			<!--幸运农场 begin-->
			<div class="contentNode"  id="type_9">
				<div class="box">
					<h1>重要聲明:</h1>
					<ul>
						<li><label>1.</label><span>如果客護懷疑自己的資料被盜用，應立即通知本公司，並更改詳細資料，以前的使用者名稱及密碼將全部無效。</span></li>
						<li><label>2.</label><span>客護有責任確保自己的帳護及登入資料的保密性。以使用者名稱及密碼進行的任何網上投註將被視為有效。</span></li>
						<li><label>3.</label><span>公佈賠率時出現的任何打字錯誤或非故意人為失誤，本公司保留改正錯誤和按正確賠率結算投註的權力。您居住所在地的法律有可能規定網路博奕不合法；若此情況屬實，本公司將不會批準您使用付帳卡進行交易。</span></li>
						<li><label>4.</label><span>每次登入時客護都應該核對自己的帳護結餘額。如對餘額有任何疑問，請在第一時間內通知本公司。</span></li>
						<li><label>5.</label><span>一旦投註被接受，則不得取消或修改。</span></li>
						<li><label>6.</label><span>所有號碼賠率將不時浮動，派彩時的賠率將以確認投註時之賠率為準。</span></li>
						<li><label>7.</label><span>每註最高投註金額按不同[場次]及[投註項目]及[會員帳號]設定浮動。如投註金額超過上述設定，本公司有權取消超過之投註金額。</span></li>
						<li><label>8.</label><span>所有投註都必須在開獎前時間內進行否則投註無效。</span></li>
						<li class="line"><label>9.</label><span>所有投註派彩彩金皆含本金。</span></li>
					</ul>
					<h1>幸运农场規則說明:</h1>
					<ul>
						<li class="line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;每期幸运农场开奖球数共八粒。每粒球除了总和玩法，其它都有单独的投注页面。幸运农场每天开97期，每期间隔10分钟。投注时间为8分钟，等待开奖时间为2分钟，北京时间（GMT+8）每天白天从上午10：00开到次日淩晨02：00。 </li>
					</ul>
					<p>※ 两面：<b>指单、双；大、小；尾大、尾小。</b></p>
					<ul>
						<li><label>●</label><span><strong>单、双：</strong>号码为双数叫双，如8、16；号码为单数叫单，如19、5。</span></li>
						<li><label>●</label><span><strong>大、小：</strong>开出之号码大于或等于11为大，小于或等于10为小。 </span></li>
						<li><label>●</label><span><strong>尾大、尾小：</strong>开出之尾数大于或等于5为尾大，小于或等于4为尾小。</span></li>
						<li class="line"><label>&nbsp;</label><span>每一个号码为一投注组合，假如投注号码为开奖号码并在所投的球位置，视为中奖，其余情形视为不中奖。</span></li>
					</ul>
					<p>※ 中发白</p>
					<ul>
						<li><label>●</label><span><strong>中：</strong>开出之号码为01、02、03、04、05、06、07 </span></li>
						<li><label>●</label><span><strong>发：</strong>开出之号码为08、09、10、11、12、13、14</span></li>
						<li class="line"><label>●</label><span><strong>白：</strong>开出之号码为15、16、17、18、19、20 </span></li>
					</ul>
					<p>※ 梅蘭竹菊</p>
					<ul>
						<li><label>●</label><span><strong>梅：</strong>开出之号码为01、05、09、13、17</span></li>
						<li><label>●</label><span><strong>蘭：</strong>开出之号码为02、06、10、14、18</span></li>
						<li><label>●</label><span><strong>竹：</strong>开出之号码为03、07、11、15、19</span></li>
						<li class="line"><label>●</label><span><strong>菊：</strong>开出之号码为04、08、12、16、20</span></li>
					</ul>
					<p>※ 总和单双</p>
					<ul>
						<li class="line"><label>●</label><span>所有8个开奖号码的数字总和值是单数为总和单，如数字总和值是31、51；所有8个开奖号码的数字总和值是双数为总和双，如数字总和是42、80；假如投注组合符合中奖结果，视为中奖，其余情形视为不中奖。 </span></li>
					</ul>
					<p>※ 总和大小</p>
					<ul>
						<li class="line"><label>●</label><span>所有8个开奖号码的数字总和值85到132为总大；所有8个开奖号码的数字总和值36到83为总分小；所有8个开奖号码的数字总和值为84打和；如开奖号码为01、20、02、08、17、09、11，数字总和是68，则总分小。假如投注组合符合中奖结果，视为中奖，其余情形视为不中奖，打和不计算结果。</span></li>
					</ul>
					<p>※ 总尾大小</p>
					<ul>
						<li class="line"><label>●</label><span>所有8个开奖号码的数字总和数值的个位数大于或等于5为总尾大，小于或等于4为总尾小；假如投注组合符合中奖结果，视为中奖，其余情形视为不中奖。</span></li>
					</ul>
					<p>※ 背靠背</p>
					<ul>
						<li class="line"><label>●</label><span>指從01至20中任意選擇2個號碼對開獎號碼中按開獎順序出現的2個連續位置的投注。 投注號碼與開獎號碼中按開獎順序出現的2個連續位置的號碼相符（順序不限），即中獎。</span></li>
					</ul>
					<p>※ 連連中</p>
					<ul>
						<li class="line"><label>●</label><span>指從01至20中任意選擇2個號碼對開獎號碼中按開獎順序出現的2個連續位置按位相符的投注。 投注號碼與開獎號碼中按開獎順序出現的2個連續位置的號碼按位相符，即中獎。</span></li>
					</ul>
					<p>※ 幸運二</p>
					<ul>
						<li class="line"><label>●</label><span>指從01至20中任意選擇2個號碼對開獎號碼中任意2個位置的投注。 投注號碼與開獎號碼中任意2個位置的號碼相符，即中獎。</span></li>
					</ul>
					<p>※ 幸運三</p>
					<ul>
						<li class="line"><label>●</label><span>指從01至20中任意選擇3個號碼對開獎號碼中任意3個位置的投注。 投注號碼與開獎號碼中任意3個位置的號碼相符，即中獎。</span></li>
					</ul>
					<p>※ 幸運四</p>
					<ul>
						<li class="line"><label>●</label><span>指從01至20中任意選擇4個號碼對開獎號碼中任意4個位置的投注。 投注號碼與開獎號碼中任意4個位置的號碼相符，即中獎。</span></li>
					</ul>
					<p>※ 幸運五</p>
					<ul>
						<li class="line"><label>●</label><span>指從01至20中任意選擇5個號碼對開獎號碼中任意5個位置的投注。 投注號碼與開獎號碼中任意5個位置的號碼相符，即中獎。</span></li>
					</ul>
					<p>※ 家禽野獸：<b>以第一球的中奖号码和第八球的中奖号码做为对奖号码。 </b></p>
					<ul>
						<li><label>●</label><span><strong>家禽：</strong>开出之号码第一球的中奖号码大于第八球的中奖号码。如 第一球开出14 第八球开出09；第一球开出17 第八球开出08；第一球开出05 第八球开出01...中奖为家禽。 </span></li>
						<li><label>●</label><span><strong>野獸：</strong>开出之号码第一球的中奖号码小于第八球的中奖号码。如 第一球开出14 第八球开出16；第一球开出13 第八球开出18；第一球开出05 第八球开出08...中奖为野獸。 </span></li>
					</ul>
				<div class="clear"></div>
				</div>
			<div class="clear"></div>
			</div>
			<!--end-->
			
			<!--吉林快3 begin-->
			<div class="contentNode"  id="type_7">
				<div class="box">
				
					<h1>重要聲明:</h1>
					<ul>
						<li><label>1.</label><span>如果客護懷疑自己的資料被盜用，應立即通知本公司，並更改詳細資料，以前的使用者名稱及密碼將全部無效。</span></li>
						<li><label>2.</label><span>客護有責任確保自己的帳護及登入資料的保密性。以使用者名稱及密碼進行的任何網上投註將被視為有效。</span></li>
						<li><label>3.</label><span>公佈賠率時出現的任何打字錯誤或非故意人為失誤，本公司保留改正錯誤和按正確賠率結算投註的權力。您居住所在地的法律有可能規定網路博奕不合法；若此情況屬實，本公司將不會批準您使用付帳卡進行交易。</span></li>
						<li><label>4.</label><span>每次登入時客護都應該核對自己的帳護結餘額。如對餘額有任何疑問，請在第一時間內通知本公司。</span></li>
						<li><label>5.</label><span>一旦投註被接受，則不得取消或修改。</span></li>
						<li><label>6.</label><span>所有號碼賠率將不時浮動，派彩時的賠率將以確認投註時之賠率為準。</span></li>
						<li><label>7.</label><span>每註最高投註金額按不同[場次]及[投註項目]及[會員帳號]設定浮動。如投註金額超過上述設定，本公司有權取消超過之投註金額。</span></li>
						<li><label>8.</label><span>所有投註都必須在開獎前時間內進行否則投註無效。</span></li>
						<li class="line"><label>9.</label><span>所有投註派彩彩金皆含本金。</span></li>
					</ul>
					<h1>吉林快3規則說明</h1>
	<ul>
		<li><span>該遊戲的投註時間、開獎時間和開獎號碼與“廣西快3”完全同步，北京時間（GMT+8）每天白天從上午09:30開到晚上22:30，每10分鐘開壹次獎,每天開獎78期。</span></li>
		<li><span>具體遊戲規則如下:</span></li>
	</ul>
	<ul>
		<li><span>股寶</span></p>
		<li><span>壹、博彩者可在下列各瓣下註：</span></li>
			<li><label>1.</label><span>小：三粒股子之點數總和由4點至10點；</span></li>
			<li><label>2.</label><span>大：三粒股子之點數總和由11點至17點；註：若三粒股子平面點數相同，通吃「大」、「小」各註。</span></li>
			<li><label>3.</label><span>三軍/魚蝦蟹：任何壹粒股子出現選定之平面點數；</span></li>
			<li><label>4.</label><span>圍股：三粒股子平面與選定點數相同；</span></li>
			<li><label>5.</label><span>全股：在壹點至六點內，三粒股子平面點數相同；</span></li>
			<li><label>6.</label><span>點數：由4點至17點，三粒股子平面點數之總和；</span></li>
			<li><label>7.</label><span>長牌：任兩粒股子之平面點數；</span></li>
			<li><label>8.</label><span>短牌：選定兩粒股子之平面點數；</span></li>
	</ul>
				<div class="clear"></div>
				</div>
			<div class="clear"></div>
			</div>
			<!--end-->
<!--北京快樂8 begin-->
<div class="contentNode"  id="type_8">
	<div class="box">
		<h1>重要聲明:</h1>
		<ul>
			<li><label>1.</label><span>如果客護懷疑自己的資料被盜用，應立即通知本公司，並更改詳細資料，以前的使用者名稱及密碼將全部無效。</span></li>
			<li><label>2.</label><span>客護有責任確保自己的帳護及登入資料的保密性。以使用者名稱及密碼進行的任何網上投註將被視為有效。</span></li>
			<li><label>3.</label><span>公佈賠率時出現的任何打字錯誤或非故意人為失誤，本公司保留改正錯誤和按正確賠率結算投註的權力。您居住所在地的法律有可能規定網路博奕不合法；若此情況屬實，本公司將不會批準您使用付帳卡進行交易。</span></li>
			<li><label>4.</label><span>每次登入時客護都應該核對自己的帳護結餘額。如對餘額有任何疑問，請在第壹時間內通知本公司。</span></li>
			<li><label>5.</label><span>壹旦投註被接受，則不得取消或修改。</span></li>
			<li><label>6.</label><span>所有號碼賠率將不時浮動，派彩時的賠率將以確認投註時之賠率為準。</span></li>
			<li><label>7.</label><span>每註最高投註金額按不同[場次]及[投註項目]及[會員帳號]設定浮動。如投註金額超過上述設定，本公司有權取消超過之投註金額。</span></li>
			<li><label>8.</label><span>所有投註都必須在開獎前時間內進行否則投註無效。</span></li>
			<li class="line"><label>9.</label><span>所有投註派彩彩金皆含本金。</span></li>
		</ul>
		<h1>快樂8(雙盤)規則說明:</h1>
		<ul>
			<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;該遊戲分為“正常盤”和“午夜盤”，兩盤合計投註時間是早上09:00到次日早上06:00。 </li>
			<li><b>正常盤（09:00~23:55）</b>：投註時間、開獎時間和開獎號碼與“北京快樂8”完全同步，北京時間（GMT+8）每天白天從上午09:00開到晚上23:55，每5分鐘開壹次獎、每天開獎179期。</li>
			<li class="line"><b>午夜盤（23:56~06:00次日）</b>：投註時間、開獎時間和開獎號碼與“加拿大卑斯”完全同步（官方網（需過代理）），官方開獎時間為每4分鐘開獎壹次，每周二～周日從4：50 am到次日4:00 am（太平洋時間），周壹從6：05 am到隔天4:00 am（太平洋時間）；本系統只取太平洋時間07:56~14:00作為午夜場的開盤時間和期數，即是對應北京時間（GMT+8）23:56~次日的06:00，壹共是開獎91期。</li>
		</ul>
		<p>一、正碼</p>
		<ul>
			<li class="line"><label>●</label><span>從01至80中任意選擇壹個號碼進行投註，投註號碼與20個開獎號碼任意1個號碼相同，即中獎；</span></li>
		</ul>
		<p>二、總和</p>
		<ul>
			<li><label>●</label><span>以所有20個開獎號碼的數字相加的和值來判定，分為“總和大”、“總和小”、“總和大”、“總和雙”、“總和810”；</span></li>
			<li><label>●</label><span><b>1、總和大/小</b>：20個號碼相加的總和值大於810，為總和大；20個號碼相加的總和值小於810，則為總和小。</span></li>
			<li><label>●</label><span><b>2、總和單/雙</b>：20個號碼相加的總和值為單數，叫做“總和單”；20個號碼相加的總和值為雙數，叫做“總和雙”。</span></li>
			<li class="line"><label>●</label><span><b>3、總和810</b>：20個號碼相加的總和值等於810，叫“總和810”。（當總和值等於810，則總和大、總和小，總和單、總和雙退回本金，打和不計算輸贏）。<br/><b>舉例</b><br />開獎號碼為1，2，3，4，5，6，7，8，9，10，11，12，13，14，15，16，17，18，19，20；那麼此20個開獎號碼的和值總和為210，則為小，為雙。則投註總和小、總和雙者中獎。投註總和大、總和單、總和810都不中獎。</span></li>
		</ul>
		<p>三、總和過關</p>
		<ul>
			<li><label>●</label><span>以所有20個開獎號碼的數字相加的和值來判定，通過大小和單雙組合產生“總大單”、“總大雙”、“總小單”和“總小雙”。</span></li>
			<li><label>●</label><span><b>1、總大單/雙：</b>：20個號碼相加的總和值大於810的單數為“總大單”，20個號碼相加的總和值大於810的雙數為“總大雙”。</span></li>
			<li class="line"><label>●</label><span><b>2、總小單/雙</b>：20個號碼相加的總和值小於810的單數為“總小單”，20個號碼相加的總和值小於810的雙數為“總小雙”；<br />總和值等於810，則視為和局，總大單/雙、總小單/雙不計算輸贏<br /><b>舉例</b>開獎號碼為 01、04、05、10、11、13、20、27、30、32、33、36、40、47、54、59、61、64、67、79，總和是693，總和小於810，並且是單數，則為“總小單”。投註“總小單”中獎。</span></li>
		</ul>
		<p>四、前後和</p>
		<ul>
			<li><label>●</label><span>前後盤說明：開獎號碼01至40為前盤號碼，41至80為後盤號碼。</span></li>
			<li><label>●</label><span><b>1、前（多）</b>：開出的20個號碼中，前盤號碼（01-40）比後盤號碼是（41~80）個數多時，則為前（多）。</span></li>
			<li><label>●</label><span><b>2、後（多）</b>：開出的20個號碼中，後盤號碼（41-80）比前盤號碼是（01~40）個數多時，則為後（多）。</span></li>
			<li class="line"><label>●</label><span><b>3、前後（和）</b>：若果開出的20個號碼中，前盤號碼（01－40）和後盤號碼（41-80）個數相同時（各10個數字），即為前後（和）。<br/><b>舉例</b><br />開獎號碼為1、2、3、4、5、6、7、8、9、10、11、12、13、14、15、16、17、18、19、20，投註“前（多）”中獎。<br/><b>舉例</b><br />開獎號碼為41、42、43、44、45、46、47、48、49、50、51、52、53、54、55、56、57、58、59、60，投註“後（多）”中獎。<br/><b>舉例</b><br />開獎號碼為1、2、3、4、5、6、7、8、9、10、41、42、43、44、45、46、47、48、49、50， 投註“前後（和）”中獎。</span></li>
		</ul>
		<p>五、單雙和</p>
		<ul>
			<li><label>●</label><span>開獎號碼中1、3、5、7、……、75、77、，79為單數號碼，2、4、6、8、……、76，78，80為雙數號碼。</span></li>
			<li><label>●</label><span><b>1、單（多）</b>：開出的20個號碼中，單數號碼比雙數號碼個數多時，則為單（多）。</span></li>
			<li><label>●</label><span><b>2、雙（多）</b>：開出的20個號碼中，雙數號碼比單數號碼個數多時，則為雙（多）。</span></li>
			<li class="line"><label>●</label><span><b>3、單雙（和）</b>：開出的20個號碼中，單數號碼和雙數號碼個數相同時，則為單雙（和）。<br/><b>舉例</b><br />開獎號碼為1，3，5，7，9，11，13，15，17，19，21，22，24，26，28，30，32，34，46，68， 其中單數11個比雙數9個多，投註“單（多）”中獎。<br/><b>舉例</b><br />開獎號碼為2，4，6，8，10，12，14，16，44，48，66，68，25，27，31，35，37，39，41，55， 其中雙數12個比單數8個多，投註“雙（多）”中獎。<br/><b>舉例</b><br />開獎號碼為2，4，6，8，10，12，14，16，18，20，41，43，45，47，49，51，53，55，57，59， 其中單數10個和雙數10個，投註“單雙（和）”中獎。</span></li>
		</ul>
		<p>六、五行</p>
		<ul>
			<li><label>●</label><span>開出的20個號碼相加的總和值分在5個段，以金、木、水、火、土命名：金（210～695）、木（696～763）、水（764～855）、火（856～923）和土（924～1410）。</span></li>
			<li><label>●</label><span><b>舉例</b><br />開 獎 號 碼 為 01、04、05、10、11、13、20、27、30、32、33、36、40、47、54、59、61、64、67、79，總和值是693，在210-695階段內，即是開出的是“金”，投註“金”中獎。</span></li>
		</ul>
	<div class="clear"></div>
	</div>
<div class="clear"></div>
</div>
<!--end-->

	</div> 
<? include 'left.php';?>
</div> 
</body> 
</html>  