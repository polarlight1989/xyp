
var _url = "../AjaxAll/cqoddsJson.php";
var _endtime, _opentime, _refreshtime, _openNumber, _lock=false;
var setResultcq = new Array();
$(function (){
	$("#dp").attr("action","./inc/DataProcessingcqsm.php?t="+encodeURI($("#tys").html()));
	loadInfo(false);
	loadTime();
	setOpnumberTirem();
if(getCookie("soundbut")=="on" || getCookie("soundbut")==null || getCookie("soundbut")==""){
		SetCookie("soundbut","on");
		$("#soundbut").attr("value","on");
		$("#soundbut").attr("src","images/soundon.png");
		}else{
			$("#soundbut").attr("value","off");
		$("#soundbut").attr("src","images/soundoff.png");
			}
});

/**
 * 開出號碼須加載
 */
function loadInfo(bool){
	var win = $("#sy");
	var number = $("#number"); //開獎期數
	$.post(_url, {tid : 1}, function(data){
		_Number (data.number, data.ballArr); //開獎號碼
		openNumberCount(data, bool);//雙面長龍
		win.html((data.winMoney).toFixed(1)); //今天輸贏
	}, "json");
	if (bool == true) {
		//if($("#soundbut").attr("value")=="on"){
		$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/c1.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");
		//}
	}
}
function _Number (number, ballArr) {
	var Clss = null;
	var idArr = ["#a","#b","#c","#d","#e","#f","#g","#h"];
	$("#number").html(number);
	for (var i = 0; i<ballArr.length; i++) {
		Clss = "No_cq"+ballArr[i];
		$(idArr[i]).removeClass().addClass(Clss);
	}
}
function openNumberCount(row, bool){
		var rowHtml1 = new Array();
		var rowHtml2 = new Array();
		var rowHtml3 = new Array();
		for (var i in row.row1){
			rowHtml1.push("<td>"+row.row1[i]+"</td>");
		}
		$("#su").html(rowHtml1.join(''));
		for (var k in row.row7){
			rowHtml2.push(row.row7[k]);
		}
		$("#z_cl").html(rowHtml2.join(''));
		$(".z_cl:even").addClass("hhg");
		if (row.row8 != ""){
			for (var key in row.row8){
				
				rowHtml3.push("<tr bgcolor=\"#fff\" height=\"20\"><td style=\"padding-left:5px; background:#fff4eb; color:#511e02\">"+key+"</td><td style=\"background:#ffffff; width:35px; color:red; text-align:center\">"+row.row8[key]+" 期</td></tr>");
			}
			var cHtml = '<tr class="t_list_caption"><th colspan="2"><font color="#4A1A04">兩面長龍排行</font></th></tr>';
			$("#cl").html(cHtml+rowHtml3.join(""));
		}
		setResultcq[0] = row.row2;
		setResultcq[1] = row.row3;
		setResultcq[2] = row.row4;
		setResultcq[3] = row.row5;
		setResultcq[4] = row.row6;
		setResultcq[5] = row.row7;
	}


function loadTime(){
	 _openNumber = $("#o");
	$.post(_url, {tid : 2}, function(data){
		_openNumber.html(data.Phases);
		endtimes(data.endTime);
		opentimes(data.openTime);
		refreshTimes(data.refreshTime);
		loadodds(data.oddsList, data.endTime, data.Phases);
		loadinput(data.endTime);
	}, "json");
}

/**
 * 封盤時間
 */
function endtimes(endtime){
	var endTime = $("#endTime"); //封盤時間
	_endtime = endtime;
	if (_endtime >1)
		endTime.html(settime(_endtime));
	var interval = setInterval(function(){
									
	if (_endtime<10&&_endtime>0){
		if($("#soundbut").attr("value")=="on"){
		$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/d.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");		
		}
	}	
				
		if (_endtime <= 1) { //封盤時間結束
			clearInterval(interval);
			endTime.html("00:00");
			loadodds(null, endtime, null);		//關閉賠率
			loadinput(-1); 				//關閉輸入框
			return false;
		}
		_endtime--;
		endTime.html(settime(_endtime));
	}, 1000);
}

/**
 * 開獎時間
 */
function opentimes(opentime){
	var openTime = $("#endTimes"); //開獎時間
	_opentime = opentime;
	if (_opentime >1)
		openTime.html(settime(_opentime));
	var interval = setInterval(function(){
		if (_opentime <= 1) { //開獎時間結束
			clearInterval(interval);
			_lock = true;
			_refreshtime = 3;
			openTime.html("00:00");
			return false;
		}
		_opentime--;
		openTime.html(settime(_opentime));
	}, 1000);
}

/**
 * 90秒刷新
 */
function refreshTimes(refreshtime){
	_refreshtime = refreshtime;
	var refreshTime = $("#endTimea"); //刷新時間
	refreshTime.html(_refreshtime);
	var interval = setInterval(function(){
		if (_refreshtime <= 1) { //刷新時間結束
			clearInterval(interval);
			$.post(_url, {tid : 2}, function(data){
				if (_lock == true){
					endtimes(data.endTime);
					opentimes(data.openTime);
					loadinput(data.endTime);
					 _openNumber.html(data.Phases);
					 setOpnumberTirem();//加載開獎號碼
					_lock = false;
				}
				 _endtime =data.endTime;
				 _opentime =data.openTime;
				 _refreshtime =data.refreshTime;
				 loadodds(data.oddsList, _endtime, data.Phases);
				 refreshTimes(_refreshtime);
			}, "json");
			return false;
		}
		_refreshtime--;
		refreshTime.html(_refreshtime);
	}, 1000);
}

/**
 * 加載賠率
 */
function loadodds(oddslist, endtime, number){
	var a = ["a","b","c","d","e","f","g","h","i"];
		var odds, link, urls;
		if (oddslist == null || oddslist == "" || endtime <1) {
		$(".o").html("-");
			return false;
		}
		for (var n=0; n<oddslist.length; n++){
			for (var i in oddslist[n]){
				odds = oddslist[n][i];
				urls = "fn3.php?tid="+bc(a[n])+"&numberid="+number+"&hid="+a[n]+i;
				link = "<a href=\""+urls+"\"  target=\"leftFrame\" class=\"bgh\">"+odds+"</a>";
				
				/* urls = "fnszcq.php?tid="+bc(a[n])+"&numberid="+number+"&hid="+a[n]+i;
				link = "<a href=\""+urls+"\"  target=\"leftFrame\" class=\"bgh\">"+odds+"</a>"; */
				
				//alert("#"+a[n]+i+"---"+odds);
				//$("#"+a[n]+i).html(link);
				$("#"+a[n]+i).html(link);
				$("#"+i).html(link);
			}
		}
}
function bc(str){
		switch (str){
			case "a" : return "Ball_1";
			case "b" : return "Ball_2";
			case "c" : return "Ball_3";
			case "d" : return "Ball_4";
			case "e" : return "Ball_5";
			case "f" : return "Ball_6";
			case "g" : return "Ball_7";
			case "h" : return "Ball_8";
			case "i" : return "Ball_9";
		}
	}
/**
 * 加載輸入框
 */
function loadinput(endtime){
	
	
	var loads = $(".loads");
	var count=0, lock1=lock2=lock3=1,lock4=1, lock5=1, s, n="封盤";
	loads.each(function(){
	
		if (endtime < 1){
				$(this).html(n);
			} else {	
	if (count == 0 ) {
					n = "<input name=\"Ball_1mh11\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
	for(var $i=1;$i<92;$i++){
		var $ss=parseInt($i/5)+1;
		var $u=$i%5+1;
		
		if($i<=19){
				
				if (count ==$i) {
					n = "<input name=\'Ball_"+$u+"mh1"+$ss+"\' class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
			
		}else if($i<=69){
			$ss=$ss-4;
			if ($u==1){	
				if (count ==$i) {
					n = "<input name=\'Ball_"+$u+"mah"+$ss+"\' class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
			} else if($u==2){
				if (count ==$i) {
					n = "<input name=\'Ball_"+$u+"mbh"+$ss+"\' class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
			}else if($u==3){
				if (count ==$i) {
					n = "<input name=\'Ball_"+$u+"mch"+$ss+"\' class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
			}else if($u==4){
				if (count ==$i) {
					
					n = "<input name=\'Ball_"+$u+"mdh"+$ss+"\' class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
			}else if($u==5){
				if (count ==$i) {
					n = "<input name=\'Ball_"+$u+"meh"+$ss+"\' class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
			}else{}
		}else if($i>69 && $i<=91){
			
			if($i>69 && $i<=74){
				$ss=$i-69;
				if (count ==$i) {
					n = "<input name=\'Ball_7mgh"+$ss+"\' class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
			}else if($i>74 && $i<=79){
				$ss=$i-74;
				if (count ==$i) {
					n = "<input name=\'Ball_8mhh"+$ss+"\' class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
			}else if($i>79 && $i<=84){
				$ss=$i-79;
				if (count ==$i) {
					n = "<input name=\'Ball_9mih"+$ss+"\' class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
			}else if($i>84 && $i<=91){
				$ss=$i-84;
				if (count ==$i) {
					n = "<input name=\'Ball_6mfh"+$ss+"\' class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\" style='width: 80px;'/>"
					$(this).html(n);
				}
			}
		}else{
			//alert($i);
		}
	} 
				/* 
				if (count == 0 ) {
					n = "<input name=\"Ball_1mh11\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 1) {
					n = "<input name=\"Ball_1mh12\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				 if (count == 2) {
					n = "<input name=\"Ball_1mh13\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 3) {
					n = "<input name=\"Ball_1mh14\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				
				if (count == 4 ) {
					n = "<input name=\"Ball_2mh11\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 5) {
					n = "<input name=\"Ball_2mh12\" class=\"inp1\"  onclick=\"Shortcut_ImportM(this)\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 6) {
					n = "<input name=\"Ball_2mh13\" class=\"inp1\"  onclick=\"Shortcut_ImportM(this)\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 7) {
					n = "<input name=\"Ball_2mh14\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				
				if (count == 8 ) {
					n = "<input name=\"Ball_3mh11\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 9) {
					n = "<input name=\"Ball_3mh12\" class=\"inp1\"  onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 10) {
					n = "<input name=\"Ball_3mh13\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 11) {
					n = "<input name=\"Ball_3mh14\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				
				if (count == 12 ) {
					n = "<input name=\"Ball_4mh11\" class=\"inp1\"  onclick=\"Shortcut_ImportM(this)\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 13) {
					n = "<input name=\"Ball_4mh12\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 14) {
					n = "<input name=\"Ball_4mh13\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 15) {
					n = "<input name=\"Ball_4mh14\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				
				
				if (count == 16 ) {
					n = "<input name=\"Ball_5mh11\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 17) {
					n = "<input name=\"Ball_5mh12\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 18) {
					n = "<input name=\"Ball_5mh13\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 19) {
					n = "<input name=\"Ball_5mh14\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				
				if (count == 20 ) {
					n = "<input name=\"Ball_6mfh1\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 21) {
					n = "<input name=\"Ball_6mfh5\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 22) {
					n = "<input name=\"Ball_6mfh2\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 23) {
					n = "<input name=\"Ball_6mfh6\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				
				if (count == 24 ) {
					n = "<input name=\"Ball_6mfh3\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 25) {
					n = "<input name=\"Ball_6mfh4\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 26) {
					n = "<input name=\"Ball_6mfh7\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}  */

			count++;
			}
	});
}

function settime(time){
	var MinutesRound = Math.floor(time / 60);
	var SecondsRound = Math.round(time - (60 * MinutesRound));
	var Minutes = MinutesRound.toString().length <= 1 ? "0"+MinutesRound : MinutesRound;
	var Seconds = SecondsRound.toString().length <= 1 ? "0"+SecondsRound : SecondsRound;
	var strtime = Minutes + ":" + Seconds;
	return strtime;
}

function digitOnly ($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
	}
}

function setOpnumberTirem(){
	var opnumber = $("#number").html();
	var nownumer = $("#o").html();
	if (opnumber != ""){
		var _nownumber = parseInt(nownumer);
		var sum = _nownumber -  parseInt(opnumber);
		if (sum == 2) {
			var interval = setInterval(function(){
				$.post(_url, {tid : 3}, function(data){
					if (_nownumber - parseInt(data) == 1){
						clearInterval(interval);
						loadInfo(true);
						return false;
					}
				}, "text");
			}, 3000);
		}
	} else {
		setTimeout(setOpnumberTirem, 1000);
	}
}


function submitforms(){
	$.post("../AjaxAll/Default.ajax.php", { typeid : "sessionId"}, function(){});
	var mixmoney = parseInt($("#mix").val()); //最低下注金額
	var input = $("input.inp1");
	var c = true, s, ss,n;
	var count = 0;
	var countmoney = 0;
	var upmoney = 0;
	var names = new Array();
	var sArray = "";
	input.each(function(){
		var value = $(this).val();
		if (value != ""){
			
			value = parseInt(value);
			if (value < mixmoney) c=false;
			count++;
			
			countmoney += value;
			ss=$(this).attr("name").split("m");
			
			ss2 = nameformat2(ss);
			sArray += ss2+","+value+"|";
			s = nameformat(ss);
/* alert(s[0]+"--00");
alert(s[1]+"--11");
alert(s[2]+"#"+s[2]+" a"+"--22"); */

			s[2] = $("#"+s[2]+" a").html();
// alert(s[2]+"--33");
			if (s[0] == "总和、龙虎")
				n = s[1]+" @ "+s[2]+" x ￥"+value;
			else 
				n = s[0]+"["+s[1]+"] @ "+s[2]+" x ￥"+value;
			names.push(n+"\n");

/* alert(ss+"--ss");	
alert(ss2+"--ss2");
alert(sArray);	 */	
		}
	});
	if (count == 0){alert("请填写下注金额!!!");return false;}
	if (c == false){ alert("最低下注金额："+mixmoney+"￥");return false;}
	var confrims = "共 ￥"+countmoney+" / "+count+"笔，确定下注吗？\n\n下注明细如下：\n\n";
	confrims +=names.join('');
	if (confirm(confrims)){
		input.val("");
		var number = $("#o").html();
		var s_type = '<input type="hidden" name="s_cq" value="'+sArray+'"><input type="hidden" name="s_number" value="'+number+'">';
		$(".actiionn").html(s_type);
		/* alert(s_type); */
		return setTimeout(function(){return true}, 3000);
	}
	return false;
}

function nameformat(array){
	var arr = new Array(), h;
	switch (array[0]){
		case "Ball_1" : h="a"; arr[0] = "第一球"; break;
		case "Ball_2" : h="b"; arr[0] = "第二球"; break;
		case "Ball_3" : h="c"; arr[0] = "第三球"; break;
		case "Ball_4" : h="d"; arr[0] = "第四球"; break;
		case "Ball_5" : h="e"; arr[0] = "第五球"; break;
		case "Ball_6" : arr[0] = "总和、龙虎"; break;
		case "Ball_7" : h="g"; arr[0] = "前三"; break;
		case "Ball_8" : h="h"; arr[0] = "中三"; break;
		case "Ball_9" : h="i"; arr[0] = "后三"; break;
		case "Ball_10" :h="f"; arr[0] = "总和、龙虎"; break;
	}
	switch (array[1]) {
		case "ah1": arr[1] = '0'; arr[2]="ah1"; break;
		case "ah2": arr[1] = '1'; arr[2]="ah2"; break;
		case "ah3": arr[1] = '2'; arr[2]="ah3"; break;
		case "ah4": arr[1] = '3'; arr[2]="ah4"; break;
		case "ah5": arr[1] = '4'; arr[2]="ah5"; break;
		case "ah6": arr[1] = '5'; arr[2]="ah6"; break;
		case "ah7": arr[1] = '6'; arr[2]="ah7"; break;
		case "ah8": arr[1] = '7'; arr[2]="ah8"; break;
		case "ah9": arr[1] = '8'; arr[2]="ah9"; break;
		case "ah10": arr[1] = '9'; arr[2]="ah10"; break;
		
		case "bh1": arr[1] = '0'; arr[2]="bh1"; break;
		case "bh2": arr[1] = '1'; arr[2]="bh2"; break;
		case "bh3": arr[1] = '2'; arr[2]="bh3"; break;
		case "bh4": arr[1] = '3'; arr[2]="bh4"; break;
		case "bh5": arr[1] = '4'; arr[2]="bh5"; break;
		case "bh6": arr[1] = '5'; arr[2]="bh6"; break;
		case "bh7": arr[1] = '6'; arr[2]="bh7"; break;
		case "bh8": arr[1] = '7'; arr[2]="bh8"; break;
		case "bh9": arr[1] = '8'; arr[2]="bh9"; break;
		case "bh10": arr[1] = '9'; arr[2]="bh10"; break;
		
		case "ch1": arr[1] = '0'; arr[2]="ch1"; break;
		case "ch2": arr[1] = '1'; arr[2]="ch2"; break;
		case "ch3": arr[1] = '2'; arr[2]="ch3"; break;
		case "ch4": arr[1] = '3'; arr[2]="ch4"; break;
		case "ch5": arr[1] = '4'; arr[2]="ch5"; break;
		case "ch6": arr[1] = '5'; arr[2]="ch6"; break;
		case "ch7": arr[1] = '6'; arr[2]="ch7"; break;
		case "ch8": arr[1] = '7'; arr[2]="ch8"; break;
		case "ch9": arr[1] = '8'; arr[2]="ch9"; break;
		case "ch10": arr[1] = '9'; arr[2]="ch10"; break;
		
		case "dh1": arr[1] = '0'; arr[2]="dh1"; break;
		case "dh2": arr[1] = '1'; arr[2]="dh2"; break;
		case "dh3": arr[1] = '2'; arr[2]="dh3"; break;
		case "dh4": arr[1] = '3'; arr[2]="dh4"; break;
		case "dh5": arr[1] = '4'; arr[2]="dh5"; break;
		case "dh6": arr[1] = '5'; arr[2]="dh6"; break;
		case "dh7": arr[1] = '6'; arr[2]="dh7"; break;
		case "dh8": arr[1] = '7'; arr[2]="dh8"; break;
		case "dh9": arr[1] = '8'; arr[2]="dh9"; break;
		case "dh10": arr[1] = '9'; arr[2]="dh10"; break;
		
		case "eh1": arr[1] = '0'; arr[2]="eh1"; break;
		case "eh2": arr[1] = '1'; arr[2]="eh2"; break;
		case "eh3": arr[1] = '2'; arr[2]="eh3"; break;
		case "eh4": arr[1] = '3'; arr[2]="eh4"; break;
		case "eh5": arr[1] = '4'; arr[2]="eh5"; break;
		case "eh6": arr[1] = '5'; arr[2]="eh6"; break;
		case "eh7": arr[1] = '6'; arr[2]="eh7"; break;
		case "eh8": arr[1] = '7'; arr[2]="eh8"; break;
		case "eh9": arr[1] = '8'; arr[2]="eh9"; break;
		case "eh10": arr[1] = '9'; arr[2]="eh10"; break;
		
		case "gh1": arr[1] = '豹子'; arr[2]="gh1"; break;
		case "gh2": arr[1] = '顺子'; arr[2]="gh2"; break;
		case "gh3": arr[1] = '对子'; arr[2]="gh3"; break;
		case "gh4": arr[1] = '半顺'; arr[2]="gh4"; break;
		case "gh5": arr[1] = '杂六'; arr[2]="gh5"; break;
		
		case "hh1": arr[1] = '豹子'; arr[2]="hh1"; break;
		case "hh2": arr[1] = '顺子'; arr[2]="hh2"; break;
		case "hh3": arr[1] = '对子'; arr[2]="hh3"; break;
		case "hh4": arr[1] = '半顺'; arr[2]="hh4"; break;
		case "hh5": arr[1] = '杂六'; arr[2]="hh5"; break;
		
		case "ih1": arr[1] = '豹子'; arr[2]="ih1"; break;
		case "ih2": arr[1] = '顺子'; arr[2]="ih2"; break;
		case "ih3": arr[1] = '对子'; arr[2]="ih3"; break;
		case "ih4": arr[1] = '半顺'; arr[2]="ih4"; break;
		case "ih5": arr[1] = '杂六'; arr[2]="ih5"; break;
		
		
		case "fh1": arr[1] = '总和大'; arr[2]="fh1"; break;
		case "fh2": arr[1] = '总和小'; arr[2]="fh3"; break;
		case "fh3": arr[1] = '总和单'; arr[2]="fh5"; break;
		case "fh4": arr[1] = '总和双'; arr[2]="fh6"; break;
		case "fh5": arr[1] = '龙'; arr[2]="fh2"; break;
		case "fh6": arr[1] = '虎'; arr[2]="fh4"; break;
		case "fh7": arr[1] = '和'; arr[2]="fh7"; break;
		case "fh8": arr[1] = '虎'; arr[2]="fh8"; break;
		case "h11": arr[1] = '大'; arr[2]=h+array[1]; break;
		case "h12": arr[1] = '小'; arr[2]=h+array[1]; break;
		case "h13": arr[1] = '单'; arr[2]=h+array[1]; break;
		case "h14": arr[1] = '双'; arr[2]=h+array[1]; break;
		case "h15": arr[1] = '尾大'; arr[2]=h+array[1]; break;
		case "h16": arr[1] = '尾小'; arr[2]=h+array[1]; break;
		case "h17": arr[1] = '合数单'; arr[2]=h+array[1]; break;
		case "h18": arr[1] = '合数双'; arr[2]=h+array[1]; break;
	}
	return arr;
}


function nameformat2(array){
	var arr = new Array(), h;
	/* alert(array); */
	switch (array[0]){
		case "Ball_1" : h="a"; arr[0] = "Ball_1"; break;
		case "Ball_2" : h="b"; arr[0] = "Ball_2"; break;
		case "Ball_3" : h="c"; arr[0] = "Ball_3"; break;
		case "Ball_4" : h="d"; arr[0] = "Ball_4"; break;
		case "Ball_5" : h="e"; arr[0] = "Ball_5"; break;
		case "Ball_6" : h="f"; arr[0] = "Ball_6"; break;
		case "Ball_7" : h="g"; arr[0] = "Ball_7"; break;
		case "Ball_8" : h="h"; arr[0] = "Ball_8"; break;
		case "Ball_9" : h="i"; arr[0] = "Ball_9"; break;
		//case "Ball_10" : h="f"; arr[0] = "Ball_10"; break;
	
	}
	switch (array[1]) {
		case "fh1":  arr[1]="fh1"; break;
		case "fh2":  arr[1]="fh2"; break;
		case "fh3":  arr[1]="fh3"; break;
		case "fh4":  arr[1]="fh4"; break;
		case "fh5":  arr[1]="fh5"; break;
		case "fh6":  arr[1]="fh6"; break;
		case "fh7":  arr[1]="fh7"; break;
		case "fh8":  arr[1]="fh8"; break;
		case "h11":  arr[1]=h+array[1]; break;
		case "h12":  arr[1]=h+array[1]; break;
		case "h13": arr[1]=h+array[1]; break;
		case "h14": arr[1]=h+array[1]; break;
		case "h15": arr[1]=h+array[1]; break;
		case "h16":  arr[1]=h+array[1]; break;
		case "h17":  arr[1]=h+array[1]; break;
		case "h18":  arr[1]=h+array[1]; break;
		
		

		case "ah1":  arr[1]="ah1"; break;
		case "ah2":  arr[1]="ah2"; break;
		case "ah3": arr[1]="ah3"; break;
		case "ah4": arr[1]="ah4"; break;
		case "ah5": arr[1]="ah5"; break;
		case "ah6":  arr[1]="ah6"; break;
		case "ah7":  arr[1]="ah7"; break;
		case "ah8":  arr[1]="ah8"; break;
		case "ah9":  arr[1]="ah9"; break;
		case "ah10":  arr[1]="ah10"; break;
		
		case "bh1":  arr[1]="bh1"; break;
		case "bh2":  arr[1]="bh2"; break;
		case "bh3": arr[1]="bh3"; break;
		case "bh4": arr[1]="bh4"; break;
		case "bh5": arr[1]="bh5"; break;
		case "bh6":  arr[1]="bh6"; break;
		case "bh7":  arr[1]="bh7"; break;
		case "bh8":  arr[1]="bh8"; break;
		case "bh9":  arr[1]="bh9"; break;
		case "bh10":  arr[1]="bh10"; break;
		
		case "ch1":  arr[1]="ch1"; break;
		case "ch2":  arr[1]="ch2"; break;
		case "ch3": arr[1]="ch3"; break;
		case "ch4": arr[1]="ch4"; break;
		case "ch5": arr[1]="ch5"; break;
		case "ch6":  arr[1]="ch6"; break;
		case "ch7":  arr[1]="ch7"; break;
		case "ch8":  arr[1]="ch8"; break;
		case "ch9":  arr[1]="ch9"; break;
		case "ch10":  arr[1]="ch10"; break;
		
		case "dh1":  arr[1]="dh1"; break;
		case "dh2":  arr[1]="dh2"; break;
		case "dh3": arr[1]="dh3"; break;
		case "dh4": arr[1]="dh4"; break;
		case "dh5": arr[1]="dh5"; break;
		case "dh6":  arr[1]="dh6"; break;
		case "dh7":  arr[1]="dh7"; break;
		case "dh8":  arr[1]="dh8"; break;
		case "dh9":  arr[1]="dh9"; break;
		case "dh10":  arr[1]="dh10"; break;
		
		case "eh1":  arr[1]="eh1"; break;
		case "eh2":  arr[1]="eh2"; break;
		case "eh3": arr[1]="eh3"; break;
		case "eh4": arr[1]="eh4"; break;
		case "eh5": arr[1]="eh5"; break;
		case "eh6":  arr[1]="eh6"; break;
		case "eh7":  arr[1]="eh7"; break;
		case "eh8":  arr[1]="eh8"; break;
		case "eh9":  arr[1]="eh9"; break;
		case "eh10":  arr[1]="eh10"; break;
/* 		
		case "fh1":  arr[1]="fh1"; break;
		case "fh2":  arr[1]="fh2"; break;
		case "fh3": arr[1]="fh3"; break;
		case "fh4": arr[1]="fh4"; break;
		case "fh5": arr[1]="fh5"; break;
		case "fh6":  arr[1]="fh6"; break;
		case "fh7":  arr[1]="fh7"; break;
		 */
		case "gh1":  arr[1]="gh1"; break;
		case "gh2":  arr[1]="gh2"; break;
		case "gh3": arr[1]="gh3"; break;
		case "gh4": arr[1]="gh4"; break;
		case "gh5": arr[1]="gh5"; break;
		
		case "hh1":  arr[1]="hh1"; break;
		case "hh2":  arr[1]="hh2"; break;
		case "hh3": arr[1]="hh3"; break;
		case "hh4": arr[1]="hh4"; break;
		case "hh5": arr[1]="hh5"; break;
		
		case "ih1":  arr[1]="ih1"; break;
		case "ih2":  arr[1]="ih2"; break;
		case "ih3": arr[1]="ih3"; break;
		case "ih4": arr[1]="ih4"; break;
		case "ih5": arr[1]="ih5"; break;
		
		
		
	}
	return arr;
}



function getResult ($this){
	$(".nv_a").addClass("nv").removeClass("nv_a");
	$($this).removeClass("nv").addClass("nv_a");
	$(".nv_ab").removeClass("nv_ab");
	$($this).parent().addClass("nv_ab");
	var rowHtml = new Array();
	var data = stringByInt ($($this).html());
	for (var k in data){
		rowHtml.push(data[k]);
	}
	$("#z_cl").html(rowHtml.join(''));
	$(".z_cl:even").addClass("hhg");
}

function stringByInt (str){
	switch (str){
		case "总和大小" : return setResultcq[3];
		case "总和单双" : return setResultcq[4];
		case "总和尾数大小" : return setResultcq[3];
		case "龙虎" : return setResultcq[5];
	}
}






