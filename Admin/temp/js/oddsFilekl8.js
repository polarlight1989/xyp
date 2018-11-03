var url = "/Admin/temp/ajaxad/jsonkl8.php";
var interval, Phases, _endtime, p=0, z=true;
$(function(){
	actions();
	_loadInfo();
});

function initializes(){
	if (confirm("您確認還原所有賠率初始值碼？")){
		$.post(url, {mid : 9}, function(data){
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
		$("#win").html(data.winMoney)
	}, "json");
}
function _Number (number, ballArr) {
	var Clss = null;
	$("#q_number").html(number);
	for(var i=0;i<20;i++)
	{
		var k=parseInt(ballArr[i]);
		$("#b"+(i+1)).removeClass().addClass("ballskl8").addClass("b"+(k<=9?"0":"")+k);
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
		if (data.result != ""){
			var rowHtml3=new Array();
			for (var key in data.result){
				rowHtml3.push("<tr bgcolor=\"#fff\" height=\"20\"><td style=\"padding-left:5px; background:#fff4eb; color:#511e02\">"+data.result[key][0]+"</td><td style=\"background:#ffffff; width:35px; color:red; text-align:center\">"+data.result[key][1]+" 期</td></tr>");
			}
			var cHtml = '<tr class="t_list_caption"><th colspan="2"><font color="#4A1A04">兩面長龍排行</font></th></tr>';
			$("#cl").html(cHtml+rowHtml3.join(""));
		}
	}, "json");	
}

function loadOdds(){
	$.post(url, {mid : 2}, function(data){
		if(gametype=="zm")
		{
			for(var i=1;i<=80;i++)
			{
				$("#h"+i).text(data.oddsList[0]['h'+i]);		
			}		
		}
		else
		{
			$("#zhdx1").text(data.oddsList[1].h1);
			$("#zhdx2").text(data.oddsList[1].h2);
			$("#zhds1").text(data.oddsList[2].h1);
			$("#zhds2").text(data.oddsList[2].h2);
			$("#zhhj").text(data.oddsList[3].h1);
			$("#gg1").text(data.oddsList[4].h1);
			$("#gg2").text(data.oddsList[4].h2);
			$("#gg3").text(data.oddsList[4].h3);
			$("#gg4").text(data.oddsList[4].h4);
			$("#zhh1").text(data.oddsList[5].h1);
			$("#zhh2").text(data.oddsList[5].h2);
			$("#zhh3").text(data.oddsList[5].h3);
			$("#dsh1").text(data.oddsList[6].h1);
			$("#dsh2").text(data.oddsList[6].h2);
			$("#dsh3").text(data.oddsList[6].h3);
			$("#wx1").text(data.oddsList[7].h1);
			$("#wx2").text(data.oddsList[7].h2);
			$("#wx3").text(data.oddsList[7].h3);
			$("#wx4").text(data.oddsList[7].h4);
			$("#wx5").text(data.oddsList[7].h5);
		}
	}, "json");
};
function setOdds(othe,ty){
	$.post(url,{mid:6},function(data){
		if(data!=true){
			return;
		}
		var a=othe;
		$.post(url,{mid:7,odds:othe,ty:ty,gametype:gametype},function(date){
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
		case "zm":
			typeid="正碼";
			break;	
		case "zhdx":
			typeid="總和大小";
			break;	
		case "zhds":
			typeid="總和單雙";
			break;	
		case "zhhj":
			typeid="總和和局";
			break;	
		case "gg":
			typeid="總和過關";
			break;	
		case "zhh":
			typeid="前後和";
			break;	
		case "前後和":
			typeid="單雙和";
			break;	
		case "wx":
			typeid="五行";
			break;	
	}
	$("#typeid").val(typeid);
	$("#type_s").html(ball);
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
			cid : 8,
			nid : 8
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





















