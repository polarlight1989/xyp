var url = "/Admin/temp/ajaxad/oddsJsonsz.php";
var interval, Phases, _endtime, p=0, z=true;
$(function(){
//	$.post(url, {mid : 1}, function(data){});
	actions();
	_loadInfo();
});

function initializes(){
	if (confirm("您確認還原所有賠率初始值碼？")){
		$.post(Urls, {typeid : 9}, function(data){
			alert("賠率還原完成！");
			location.href = location.href;
		},"text");
	}
}

function actions(){
	$.post(url, {mid : 3}, function(data){
		p=parseInt(data);
		loadInfos();
		loadInfo();
		loadOdds();
	}, "text");
}

/**
 * 開出號碼須加載
 */
function _loadInfo(){
	$.post(url, {mid : "kaijiang"}, function(data){
		_Number (data.number, data.ballArr); //開獎號碼
	}, "json");
}
function _Number (number, ballArr) {
	var Clss = null;
	var idArr = ["#q_a","#q_b","#q_c","#q_d","#q_e","#q_f","#q_g","#q_h"];
	$("#q_number").html(number);
	for (var i = 0; i<ballArr.length; i++) {
		Clss = "No_cq"+ballArr[i];
		$(idArr[i]).removeClass().addClass(Clss);
	}
}

function loadInfo(){
	$.post(url, {mid : 1}, function(data){
		Phases = parseInt(data.timeList.Phases);
		$("#number").html(Phases);
		endTimes(data.timeList);
		isNumber(Phases);
		showResult(data.infocq);
	}, "json");
}

function loadInfos(){
	$.post(url, {mid : 4}, function(data){
		$("#win").html(data.dayWin);
		if (data.result != ""){
			var rowHtml = new Array();
			for (var key in data.result){
				rowHtml.push("<tr bgcolor=\"#fff\" height=\"18\"><td  class=\"uo\">"+key+"</td><td class=\"fe\">"+data.result[key]+" 期</td></tr>");
			}
			var cHtml = '<tr class="tr_top"><th colspan="2">兩面長龍排行</th></tr>';
			$("#cl").html(cHtml+rowHtml.join(""));
		}
	}, "json");
}

function loadOdds(){
	$.post(url, {mid : 2}, function(data){
		var a = ["a","b","c","d","e", "f"];
		for (var i=0; i<data.oddsList.length; i++){
			for (var n in data.oddsList[i]){
				$("#"+a[i]+n).html(data.oddsList[i][n]);
			}
		}
	}, "json");
};
function setOdds(othe,ty){
	$.post(url,{mid:6},function(data){
		if(data!=true){
			return;
		}
		var a=othe;
		$.post(url,{mid:7,odds:othe,ty:ty},function(date){
//			alert(date);
			if(date=="true")
				if(ty==1)
					document.getElementById(a).innerHTML=Math.round((parseFloat(document.getElementById(a).innerHTML)+0.01)*100)/100;
				else
					document.getElementById(a).innerHTML=Math.round((parseFloat(document.getElementById(a).innerHTML)-0.01)*100)/100;
				}
		);
	},"json");
};
function showResult(rows)
{
	if (rows != null){
		for (var i in rows){
			for (var n in rows[i]){
				for (var m in rows[i][n]){
					var classId = n+m;
//					var a =$(".odds."+i+". a."+classId);
					var a=$("#"+classId);
					if (n == "b"){
						if(i=="a"){
							$("#"+classId+"2").html(Math.round(rows[i][n][m])*2);
							$("#"+classId+"3").html(Math.round(rows[i][n][m])*3);
						}
						a.attr("href", "javascript:GoPos(this, '"+i+"', '"+m+"')");
					}else if (n == "a"){
						a.attr("id", i+"_"+classId);
					}else if(n=="c"){
//						alert(i+n);
						a=$("#_"+i+n);
					}
					
					a.html(Math.round(rows[i][n][m]));
				}
			}
		}
	} else {
		$("table .t_odds td a").html("-");
	}
}

function isNumber(phases){
	var a = phases - p;
	if (a == 2 || a == 882){
		var intervals = setInterval(function(){
			$.post(url, {mid : 3}, function(data){
				a = phases - parseInt(data);
				if (a == 1 || a == 881){
					clearInterval(intervals);
					actions();
				}
			}, "text");
		}, 2000);
	}
}

function endTimes(timeList){
	_endtime = timeList.endTime;
	var _starttime = timeList.openTime, a;
	var endtime = $("#EndTime");
	var estateTime = $("#EstateTime");
	var RefreshTime = $("#RefreshTime");
	var p = parseInt(estateTime.val());
	a = setTime (ac(_starttime, _endtime));
	endtime.html(a[0] + ":" + a[1]);
	RefreshTime.html(p);
	if (interval != undefined)
		clearInterval(interval);
	interval = setInterval(function(){
		_endtime--;  _starttime--; p--;
		if (p <= 0){
			RefreshTime.html("加載中...");
			clearInterval(interval);
			loadInfo();
			loadOdds();
		}
		a = setTime (ac(_starttime, _endtime));
		endtime.html(a[0] + ":" + a[1]);
		RefreshTime.html(p);
	}, 1000);
}

function ac(starttime, endtime){
	var s =0, offTime = $("#offTime");
	var n = Phases.toString().substring(9,11);
	if (starttime <= 0 && parseInt(n) == 23){
		location.href = "offGame.php";
		return false;
	}
	if (starttime <= 0){
		cHtml (1);
		loadInfo();
		loadOdds();
	}else if (endtime <= 0){
		cHtml (2);
		s = starttime;
	} else{
		s = endtime;
	}
	return s;
}

function cHtml (sint){
	var offTime = $("#offTime");
	if (sint == 1){
		z = true;
		$("td.odds").css("background", "#fff");
		offTime.html("距封盤").css("color","#333");
	} else if (sint == 2 && z == true) {
		z = false;
		$("td.odds").css("background", "#eee");
		offTime.html("距開獎").css("color","red");
	}
}

function setTime (times){
	var MinutesRound = Math.floor(times / 60);
	var SecondsRound = Math.round(times - (60 * MinutesRound));
	var TimeArr = new Array();
	var Minutes = MinutesRound.toString().length <= 1 ? "0"+MinutesRound : MinutesRound;
	var Seconds = SecondsRound.toString().length <= 1 ? "0"+SecondsRound : SecondsRound;
	TimeArr[0] = Minutes;
	TimeArr[1] = Seconds;
	return TimeArr;
}

var n;
function GoPos($this, s, sint){
	var sid = $("#b"+sint);
	n = Math.abs(parseInt(sid.html()));
	if (_endtime < 1 || n < 10) return;
	var odds = $("#"+sint).html();
	var ball = sid.parent().parent().find(".t_Edit_caption_1").html();
	var typeid = s;
	var offsetTop = sid.offset().top;
	var offsetLeft = sid.offset().left;
	switch(s)
	{
		case "a":
			typeid="三军";
			switch(sint)
			{
				case 'ah1':
					ball=1;
					break;	
				case 'ah2':
					ball=2;
					break;	
				case 'ah3':
					ball=3;
					break;	
				case 'ah4':
					ball=4;
					break;	
				case 'ah5':
					ball=5;
					break;	
				case 'ah6':
					ball=6;
					break;		
			}
			break;	
		case "b":
			typeid="三军";
			break;	
		case "c":
			typeid="圍骰";
			break;	
		case "d":
			typeid="點數";
			break;	
		case "e":
			typeid="長牌";
			break;	
		case "f":
			typeid="短牌";
			break;	
		case "g":
			typeid="圍骰";
			odds = $("#ch7").html();
			break;	
	}
	$("#typeid").val(typeid);
	$("#type_s").html(ball.replace("點",""));
	$("#odds_s").html(odds);
	$("#money_s").html(n);
	$("#oddsPop").fadeIn(100).css({top : offsetTop + 10, left : offsetLeft -70});
}

function GoPost(){
	var s_money = $("#s_money").val();
	if (s_money == "" || !/^[0-9]*$/.test(s_money)){
		alert("輸入補倉金額錯誤！");
		return;
	}
	if (parseInt(s_money) < 10){
		alert("補倉金額最小為："+10);
		return;
	}
	if (parseInt(s_money) > n){
		alert("補倉金額最大為："+n);
		return;
	}
	if (confirm("確定碼？")){
		var s_type = $("#typeid").val();
		var s_ball = $("#type_s").html();
		var s_money = $("#s_money").html();
		PostForm({
			s_number : $("#number").html(),
			s_type : $("#typeid").val(),
			s_ball : $("#type_s").html(),
			s_odds : $("#odds_s").html(),
			s_money : $("#s_money").val()
		});
	}
}

function PostForm(args){
	$.post("/Admin/temp/ajaxad/json.php", {
			typeid : 6, 
			s_number : args.s_number,
			s_type : args.s_type,
			s_num : args.s_ball,
			s_odds : args.s_odds,
			s_money : args.s_money,
			cid : 7,
			nid : 7
		 }, function(data){
		 	if (data.error == ""){
		 		closePop(2);
		 		loadInfo();
		 		var list = new Array();
		 		var dataList = data.ResultList;
				for (var i=0; i<dataList.length; i++){
					list.push('<tr class="text" align="right">');
					list.push('<td align="center">'+dataList[i].g_id+'#</td>');
					list.push('<td align="center">'+dataList[i].g_mingxi_1+' @ '+dataList[i].g_odds+'</td>');
					list.push('<td class="rights">'+dataList[i].g_jiner+'</td>');
					var ts = ((100-dataList[i].g_tueishui)/100) * dataList[i].g_jiner;
					var win = (dataList[i].g_jiner*dataList[i].g_odds - dataList[i].g_jiner)+ts;
					list.push('<td class="rights">'+win.toFixed(1)+'</td>');
					list.push('<td align="center">成功補出</td>');
					list.push('</tr>');
				}
				list.push('<tr class="texts" align="center">');
				list.push('<td colspan="5"><input type="button" class="inputa" onclick="closePop(1)" value="關閉" /></td>');
				list.push('</tr>');
				$("#vList").html(list.join(''));
				$("#kOddsPop").fadeIn(100).css("display" , "block");
		 	} else {
		 		alert(data.error);
		 		return false;
		 	}
	}, "json");
}

function closePop(s){
	if (s == 2){
		$("#oddsPop").fadeOut(100);
		$("#s_money").val("");
	} else {
		$("#kOddsPop").fadeOut(100);
	}
}

function isString(value){
	switch(value){
		case "ah1" : return "0";
		case "ah2" : return "1";
		case "ah3" : return "2";
		case "ah4" : return "3";
		case "ah5" : return "4";
		case "ah6" : return "5";
		case "ah7" : return "6";
		case "ah8" : return "7";
		case "ah9" : return "8";
		case "ah10" : return "9";
		case "ah11" : return "大";
		case "ah12" : return "小";
		case "ah13" : return "單";
		case "ah14" : return "雙";
		case "bh1" : return "總和大";
		case "bh2" : return "總和小";
		case "bh3" : return "總和單";
		case "bh4" : return "總和雙";
		case "bh5" : return "龍";
		case "bh6" : return "虎";
		case "bh7" : return "和";
		case "ch1" : return "豹子";
		case "ch2" : return "順子";
		case "ch3" : return "對子";
		case "ch4" : return "半順";
		case "ch5" : return "雜六";
		case "a" : return "第一球";
		case "b" : return "第二球";
		case "c" : return "第三球";
		case "d" : return "第四球";
		case "e" : return "第五球";
		case "w" : return "總和、龍虎和";
		case "i" : return "前三";
		case "s" : return "中三";
		case "x" : return "后三";
	}
}





















