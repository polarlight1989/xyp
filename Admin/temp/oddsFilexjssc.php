<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/temp/offGamexjssc.php';
include_once ROOT_PATH.'Admin/ExistUser.php';
markPos("后台-新疆即时注单");
$oddsLock = false;
if ($Users[0]['g_login_id']==48){
	if ($Users[0]['g_Immediate2_lock'] != 1) exit(back('抱歉！您無權限訪問即時注單。'));
}
if ($Users[0]['g_login_id']==89){
	$oddsLock=true;
} 
else if (isset($Users[0]['g_odds_lock']) && $Users[0]['g_odds_lock']==1){
	$oddsLock=true;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/commoncq.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Admin/temp/js/oddsFilexjssc.js"></script>
<title></title>
</head>
<body oncopy="return false" oncut="return false" onResize="try {Move_BR()} catch (e){}" onload="try {Move_BR()} catch (e){}">
<input name="G" type="hidden" id="G" value="3" />
<input name="N" type="hidden" id="N" value="6F376A3FEE66F28E9E564EEF50C6BBAB" />
<input name="TID" type="hidden" id="TID" value="1" />
<input name="mixMoney" type="hidden" id="mixMoney" value="2" />
<input name="Comt" type="hidden" id="Comt" value="0" />
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
                <td width="130" class="ls">&nbsp;<span id="number"></span>期</td>
                <td width="75" class="balls" id="s_type" style="position:relative;top:1px">總項盤口</td>
                <td width="120" style="font-weight:bold">
                <span id="offTime">距封盤：</span>
                <span id="EndTime" style="position:relative;color:red;letter-spacing:1px;">加載中...</span>
                </td>
                <td width="380" style="color:red;font-weight:bold"><div  id="row1" style="position: relative; ; FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">今天輸贏：<span id="win">0</span></div></td>
                <td width="150" height="26" align="right"  bgcolor="#FFFFFF">
                <b><span id="q_number" style="color:#FF6633"></span>期開獎</b>
                </td>
                <td width="140" height="26"  bgcolor="#FFFFFF">
                <span id="q_a" class="qiuqiu" style="float:left"></span>
                <span id="q_b" class="qiuqiu" style="float:left"></span>
                <span id="q_c" class="qiuqiu" style="float:left"></span>
                <span id="q_d" class="qiuqiu" style="float:left"></span>
                <span id="q_e" class="qiuqiu" style="float:left"></span>
                </td>				
				<td align="right">
                <select name="money_XZ" style="position: relative; height: 22px; top: 1px; cursor: hand;" onchange="LoadXml();">
                <option value="1">實占</option>
                <option value="0">虚註</option>
                </select>
                </td>
				<td align="right" width="150">更新：<span id="RefreshTime">加載中...</span>&nbsp;&nbsp;
                <select id="EstateTime">
                <option value="0">-NO-</option>
				<option value="20">20秒</option>
				<option value="25">25秒</option>
				<option value="30"selected="selected">30秒</option>
				<option value="40">40秒</option>
				<option value="50">50秒</option>
	            <option value="60">60秒</option>
	             <option value="99">99秒</option>
                </select>
                </td>
              </tr>
						</table>
					</td>
          <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
				</tr>
        <tr>
          <td class="t"></td>
          <td class="c">
            <!-- strat -->
            <table border="0" cellspacing="0" class="t_odds" width="16%" style="margin-left:-3px;margin-top:5px;top:1px;">
              <tr class="tr_top">
                <td width="15%">號</td>
                <td width="30%">賠率</td>
                <?php if ($oddsLock){?><td width="10%" colspan="2">設置</td><?php }?>
                <td>注額</td>
                <td>虧盈</td>
              </tr>			  
              <tr style="background-color:azure;height:25px">
              	<th class="tr_top" colspan="6">第一球</th>
              </tr>				  
              <tr align="center" class="odds11">
                <td class="ball_12">大</td>
                  <td class="odds" id="ah11" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah11',1)" class="aase aase_a" />
					</td>
					<td>
					<input title="下調賠率" type="button" onclick="setOdds('ah11',0)" class="aase aase_b" />
                  </td><?php }?>
                  <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah11" target="_blank">-</a></td>
                  <td class="odds a"><a class="psp bah11" >-</a></td>
              </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">小</td>
                    <td class="odds" id="ah12" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah12',1)" class="aase aase_a" />
					</td>
					<td><input title="下調賠率" type="button" onclick="setOdds('ah12',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah12" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah12" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">單</td>
                    <td class="odds" id="ah13" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah13',1)" class="aase aase_a" />
					</td>
					<td>
					<input title="下調賠率" type="button" onclick="setOdds('ah13',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah13" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah13" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">雙</td>
                    <td class="odds" id="ah14" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah14',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ah14',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah14" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah14" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball">0</td>
                    <td class="odds" id="ah1" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah1',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ah1',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('0')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah1" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah1" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball">1</td>
                    <td class="odds" id="ah2" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah2',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ah2',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah2" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah2" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">2</td>
                    <td class="odds" id="ah3" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah3',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ah3',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah3" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah3" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">3</td>
                    <td class="odds" id="ah4" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah4',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ah4',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah4" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah4" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">4</td>
                    <td class="odds" id="ah5" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah5',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ah5',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah5" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah5" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">5</td>
                    <td class="odds" id="ah6" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah6',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ah6',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah6" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah6" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">6</td>
                    <td class="odds" id="ah7" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah7',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ah7',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah7" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah7" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">7</td>
                    <td class="odds" id="ah8" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah8',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ah8',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah8" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah8" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">8</td>
                    <td class="odds" id="ah9" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah9',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ah9',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah9" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah9" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">9</td>
                    <td class="odds" id="ah10" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ah10',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ah10',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds a"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode('第一球')?>&cid=1" class="aah10" target="_blank">-</a></td>
                    <td class="odds a"><a class="psp bah10" >-</a></td>
                </tr>					
                <tr style="background-color:azure;height:25px">
                  <th class="tr_top" colspan="6">第四球</th>
                </tr>						
                <tr align="center" class="odds11">
                  <td class="ball_12">大</td>
                    <td class="odds" id="dh11" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh11',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh11',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah11" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah11" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">小</td>
                    <td class="odds" id="dh12" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh12',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh12',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah12" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah12" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">單</td>
                    <td class="odds" id="dh13" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh13',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh13',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah13" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah13" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">雙</td>
                    <td class="odds" id="dh14" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh14',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh14',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah14" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah14" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball">0</td>
                    <td class="odds" id="dh1" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh1',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh1',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('0')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah1" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah1" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball">1</td>
                    <td class="odds" id="dh2" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh2',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh2',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah2" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah2" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">2</td>
                    <td class="odds" id="dh3" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh3',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh3',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah3" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah3" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">3</td>
                    <td class="odds" id="dh4" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh4',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh4',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah4" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah4" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">4</td>
                    <td class="odds" id="dh5" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh5',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh5',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah5" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah5" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">5</td>
                    <td class="odds" id="dh6" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh6',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh6',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah6" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah6" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">6</td>
                    <td class="odds" id="dh7" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh7',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh7',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah7" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah7" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">7</td>
                    <td class="odds" id="dh8" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh8',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh8',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah8" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah8" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">8</td>
                    <td class="odds" id="dh9" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh9',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh9',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah9" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah9" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">9</td>
                    <td class="odds" id="dh10" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('dh10',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('dh10',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds d"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode('第四球')?>&cid=1" class="aah10" target="_blank">-</a></td>
                    <td class="odds d"><a class="psp bah10" >-</a></td>
                </tr>					
            </table><!--/第一、四球-->
            <table border="0" cellspacing="0" class="t_odds" width="23%" style="margin-left:3px;">
              <tr class="tr_top">
                  <td width="15%">號</td>
                    <td width="30%">賠率</td>
                <?php if ($oddsLock){?><td width="10%" colspan="2">設置</td><?php }?>
                    <td>注額</td>
                    <td>虧盈</td>
                </tr>
              <tr style="background-color:azure;height:25px">
                  <th class="tr_top" colspan="6">第二球</th>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">大</td>
                    <td class="odds" id="bh11" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh11',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh11',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah11" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah11" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">小</td>
                    <td class="odds" id="bh12" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh12',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh12',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah12" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah12" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">單</td>
                    <td class="odds" id="bh13" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh13',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh13',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah13" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah13" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">雙</td>
                    <td class="odds" id="bh14" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh14',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh14',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah14" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah14" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball">0</td>
                    <td class="odds" id="bh1" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh1',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh1',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('0')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah1" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah1" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball">1</td>
                    <td class="odds" id="bh2" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh2',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh2',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah2" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah2" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">2</td>
                    <td class="odds" id="bh3" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh3',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh3',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah3" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah3" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">3</td>
                    <td class="odds" id="bh4" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh4',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh4',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah4" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah4" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">4</td>
                    <td class="odds" id="bh5" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh5',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh5',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah5" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah5" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">5</td>
                    <td class="odds" id="bh6" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh6',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh6',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah6" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah6" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">6</td>
                    <td class="odds" id="bh7" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh7',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh7',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah7" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah7" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">7</td>
                    <td class="odds" id="bh8" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh8',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh8',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah8" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah8" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">8</td>
                    <td class="odds" id="bh9" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh9',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh9',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah9" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah9" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">9</td>
                    <td class="odds" id="bh10" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('bh10',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('bh10',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds b"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode('第二球')?>&cid=1" class="aah10" target="_blank">-</a></td>
                    <td class="odds b"><a class="psp bah10" >-</a></td>
                </tr>
                <tr style="background-color:azure;height:25px">
                  <th class="tr_top" colspan="6">第五球</th>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">大</td>
                    <td class="odds" id="eh11" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh11',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh11',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah11" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah11" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">小</td>
                    <td class="odds" id="eh12" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh12',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh12',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah12" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah12" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">單</td>
                    <td class="odds" id="eh13" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh13',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh13',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah13" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah13" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">雙</td>
                    <td class="odds" id="eh14" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh14',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh14',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah14" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah14" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball">0</td>
                    <td class="odds" id="eh1" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh1',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh1',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('0')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah1" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah1" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball">1</td>
                    <td class="odds" id="eh2" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh2',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh2',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah2" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah2" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">2</td>
                    <td class="odds" id="eh3" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh3',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh3',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah3" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah3" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">3</td>
                    <td class="odds" id="eh4" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh4',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh4',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah4" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah4" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">4</td>
                    <td class="odds" id="eh5" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh5',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh5',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah5" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah5" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">5</td>
                    <td class="odds" id="eh6" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh6',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh6',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah6" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah6" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">6</td>
                    <td class="odds" id="eh7" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh7',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh7',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah7" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah7" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">7</td>
                    <td class="odds" id="eh8" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh8',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh8',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah8" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah8" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">8</td>
                    <td class="odds" id="eh9" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh9',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh9',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah9" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah9" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">9</td>
                    <td class="odds" id="eh10" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('eh10',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('eh10',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds e"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode('第五球')?>&cid=1" class="aah10" target="_blank">-</a></td>
                    <td class="odds e"><a class="psp bah10" >-</a></td>
                </tr>
            </table><!--/第二、五球-->
            <table border="0" cellspacing="0" class="t_odds" width="23%" style="margin-left:3px;">
              <tr class="tr_top">
                  <td width="15%">號</td>
                    <td width="30%">賠率</td>
                <?php if ($oddsLock){?><td width="10%" colspan="2">設置</td><?php }?>
                    <td>注額</td>
                    <td>虧盈</td>
                </tr>
              <tr style="background-color:azure;height:25px">
                  <th class="tr_top" colspan="6">第三球</th>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">大</td>
                    <td class="odds" id="ch11" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch11',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch11',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah11" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah11" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">小</td>
                    <td class="odds" id="ch12" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch12',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch12',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah12" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah12" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">單</td>
                    <td class="odds" id="ch13" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch13',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch13',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah13" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah13" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">雙</td>
                    <td class="odds" id="ch14" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch14',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch14',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah14" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah14" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball">0</td>
                    <td class="odds" id="ch1" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch1',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch1',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('0')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah1" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah1" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball">1</td>
                    <td class="odds" id="ch2" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch2',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch2',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('1')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah2" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah2" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">2</td>
                    <td class="odds" id="ch3" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch3',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch3',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('2')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah3" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah3" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">3</td>
                    <td class="odds" id="ch4" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch4',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch4',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('3')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah4" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah4" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">4</td>
                    <td class="odds" id="ch5" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch5',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch5',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('4')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah5" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah5" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">5</td>
                    <td class="odds" id="ch6" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch6',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch6',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('5')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah6" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah6" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">6</td>
                    <td class="odds" id="ch7" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch7',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch7',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('6')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah7" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah7" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">7</td>
                    <td class="odds" id="ch8" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch8',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch8',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('7')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah8" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah8" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">8</td>
                    <td class="odds" id="ch9" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch9',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch9',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('8')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah9" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah9" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball">9</td>
                    <td class="odds" id="ch10" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ch10',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ch10',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds c"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('9')?>&tid=<?php echo base64_encode('第三球')?>&cid=1" class="aah10" target="_blank">-</a></td>
                    <td class="odds c"><a class="psp bah10" >-</a></td>
                </tr>
            </table><!--/第三球-->
            <table border="0" cellspacing="0" class="t_odds" width="23%" style="margin-left:3px;">
              <tr class="tr_top">
                <td width="15%">項</td>
                <td width="30%">賠率</td>
                <?php if ($oddsLock){?><td width="10%" colspan="2">設置</td><?php }?>
                <td>注額</td>
                <td>虧盈</td>
              </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">總和大</td>
                    <td class="odds" id="gh1" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('gh1',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('gh1',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds w"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('總和大')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh1" target="_blank">-</a></td>
                    <td class="odds w"><a class="psp bbh1" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">總和小</td>
                    <td class="odds" id="gh2"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('gh2',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('gh2',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds w"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('總和小')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh2" target="_blank">-</a></td>
                    <td class="odds w"><a class="psp bbh2" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">總和單</td>
                    <td class="odds" id="gh3"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('gh3',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('gh3',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds w"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('總和單')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh3" target="_blank">-</a></td>
                    <td class="odds w"><a class="psp bbh3" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">總和雙</td>
                    <td class="odds" id="gh4"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('gh4',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('gh4',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds w"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('總和雙')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh4" target="_blank">-</a></td>
                    <td class="odds w"><a class="psp bbh4" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">龍</td>
                    <td class="odds" id="gh5"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('gh5',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('gh5',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds w"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('龍')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh5" target="_blank">-</a></td>
                    <td class="odds w"><a class="psp bbh5" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">虎</td>
                    <td class="odds" id="gh6"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('gh6',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('gh6',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds w"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('虎')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh6" target="_blank">-</a></td>
                    <td class="odds w"><a class="psp bbh6" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">和</td>
                    <td class="odds" id="gh7"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('gh7',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('gh7',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds w"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('和')?>&tid=<?php echo base64_encode('總和、龍虎和')?>&cid=1" class="abh7" target="_blank">-</a></td>
                    <td class="odds w"><a class="psp bbh7" >-</a></td>
                </tr>
                <tr style="background-color:azure;height:25px">
                  <th class="tr_top" colspan="6">前三</th>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">豹子</td>
                    <td class="odds" id="ih1" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ih1',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ih1',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds i"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('豹子')?>&tid=<?php echo base64_encode('前三')?>&cid=1" class="ach1" target="_blank">-</a></td>
                    <td class="odds i"><a class="psp bch1" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">順子</td>
                    <td class="odds" id="ih2"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ih2',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ih2',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds i"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('順子')?>&tid=<?php echo base64_encode('前三')?>&cid=1" class="ach2" target="_blank">-</a></td>
                    <td class="odds i"><a class="psp bch2" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">對子</td>
                    <td class="odds" id="ih3"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ih3',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ih3',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds i"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('對子')?>&tid=<?php echo base64_encode('前三')?>&cid=1" class="ach3" target="_blank">-</a></td>
                    <td class="odds i"><a class="psp bch3" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">半順</td>
                    <td class="odds" id="ih4"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ih4',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ih4',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds i"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('半順')?>&tid=<?php echo base64_encode('前三')?>&cid=1" class="ach4" target="_blank">-</a></td>
                    <td class="odds i"><a class="psp bch4" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">雜六</td>
                    <td class="odds" id="ih5"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('ih5',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('ih5',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds i"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雜六')?>&tid=<?php echo base64_encode('前三')?>&cid=1" class="ach5" target="_blank">-</a></td>
                    <td class="odds i"><a class="psp bch5" >-</a></td>
                </tr>
                 <tr style="background-color:azure;height:25px">
                  <th class="tr_top" colspan="6">中三</th>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">豹子</td>
                    <td class="odds" id="sh1" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('sh1',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('sh1',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds s"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('豹子')?>&tid=<?php echo base64_encode('中三')?>&cid=1" class="ach1" target="_blank">-</a></td>
                    <td class="odds s"><a class="psp bch1" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">順子</td>
                    <td class="odds" id="sh2"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('sh2',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('sh2',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds s"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('順子')?>&tid=<?php echo base64_encode('中三')?>&cid=1" class="ach2" target="_blank">-</a></td>
                    <td class="odds s"><a class="psp bch2" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">對子</td>
                    <td class="odds" id="sh3"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('sh3',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('sh3',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds s"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('對子')?>&tid=<?php echo base64_encode('中三')?>&cid=1" class="ach3" target="_blank">-</a></td>
                    <td class="odds s"><a class="psp bch3" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">半順</td>
                    <td class="odds" id="sh4"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('sh4',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('sh4',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds s"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('半順')?>&tid=<?php echo base64_encode('中三')?>&cid=1" class="ach4" target="_blank">-</a></td>
                    <td class="odds s"><a class="psp bch4" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">雜六</td>
                    <td class="odds" id="sh5"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('sh5',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('sh5',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds s"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雜六')?>&tid=<?php echo base64_encode('中三')?>&cid=1" class="ach5" target="_blank">-</a></td>
                    <td class="odds s"><a class="psp bch5" >-</a></td>
                </tr>
                 <tr style="background-color:azure;height:25px">
                  <th class="tr_top" colspan="6">后三</th>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">豹子</td>
                    <td class="odds" id="xh1" width="76"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('xh1',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('xh1',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds x"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('豹子')?>&tid=<?php echo base64_encode('后三')?>&cid=1" class="ach1" target="_blank">-</a></td>
                    <td class="odds x"><a class="psp bch1" >-</a></td>
                </tr>
                <tr align="center" class="odds11">
                  <td class="ball_12">順子</td>
                    <td class="odds" id="xh2"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('xh2',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('xh2',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds x"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('順子')?>&tid=<?php echo base64_encode('后三')?>&cid=1" class="ach2" target="_blank">-</a></td>
                    <td class="odds x"><a class="psp bch2" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">對子</td>
                    <td class="odds" id="xh3"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('xh3',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('xh3',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds x"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('對子')?>&tid=<?php echo base64_encode('后三')?>&cid=1" class="ach3" target="_blank">-</a></td>
                    <td class="odds x"><a class="psp bch3" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">半順</td>
                    <td class="odds" id="xh4"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('xh4',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('xh4',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds x"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('半順')?>&tid=<?php echo base64_encode('后三')?>&cid=1" class="ach4" target="_blank">-</a></td>
                    <td class="odds x"><a class="psp bch4" >-</a></td>
                </tr>
                <tr align="center" class="odds11" >
                  <td class="ball_12">雜六</td>
                    <td class="odds" id="xh5"  width="66"></td>
									<?php if ($oddsLock){?><td>
                  	<input title="上調賠率" type="button" onclick="setOdds('xh5',1)" class="aase aase_a" />
					</td>
					<td>					
					<input title="下調賠率" type="button" onclick="setOdds('xh5',0)" class="aase aase_b" />
                  </td><?php }?>
                    <td class="odds x"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雜六')?>&tid=<?php echo base64_encode('后三')?>&cid=1" class="ach5" target="_blank">-</a></td>
                    <td class="odds x"><a class="psp bch5" >-</a></td>
                </tr>
            </table>
			<!--/总和、龙虎和-->
            <table border="0" cellspacing="0" class="t_odds" width="100" id="cl"  style="margin-left:3px;">
			              <!--  <tr class="tr_top">
              <th colspan="2">兩面長龍</th>
              </tr>
              <tr align="center">
              <td class="uo">第一球-單</td>
              <td class="fe">5期</td>
              </tr> -->
            </table>
            <!-- end -->
            </td>
            <td class="r"></td>
        </tr><!--/list-->
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
          <td class="f" align="center">評均虧損：
          <input type="text" class="textb" id="Param" value="-10000000" />&nbsp;&nbsp;
          <input type="button" class="inputs" value="計算補貨" />&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="button" class="inputs" value="補貨說明" />
          </td>
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
<div id="oddsPop">
<table border="0" cellspacing="0" class="t_odds" width="100%">
	<tr class="tr_top">
    <th colspan="2">補貨單</th>
  </tr>
  <tr class="text" align="center">
    <td width="50" >類型</td>
    <td class="balls" id="type_s"></td>
  </tr>
  <tr class="text" align="center">
    <td width="50">賠率</td>
    <td class="odds" id="odds_s"></td>
  </tr>
  <tr class="text" align="center">
    <td width="50">金額</td>
    <td><input type="text" id="s_money" class="textc" /></td>
  </tr>
  <tr class="text" align="center">
    <td width="50">限額</td>
    <td id="money_s">0</td>
  </tr>
  <tr class="texts">
    <td align="center" height="60" colspan="2">
      <input type="button" class="inputa" onclick="GoPost()" value="補出" />&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="button" class="inputa" onclick="closePop(2)" value="關閉" />
      <input type="hidden" id="typeid" />
    </td>
  </tr>
</table>
</div>
<div id="kOddsPop">
<table border="0" cellspacing="0" class="t_odds" width="100%">
  <tr class="tr_top" align="center">
    <td colspan="5">補貨結果明細</td>
  </tr>
  <tr class="texts" align="center">
    <td><b>單碼</b></td>
    <td><b>明細</b></td>
    <td><b>金額</b></td>
    <td><b>可贏</b></td>
    <td><b>結果</b></td>
  </tr>
	<tfoot id="vList"></tfoot>
</table>
</div>
</body>
</html>