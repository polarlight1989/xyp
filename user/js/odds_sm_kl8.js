var _url = "../AjaxAll/kl8oddsJson.php";
var _endtime, _opentime, _refreshtime, _openNumber, _lock,_loadLT=false;
var setResultcq = new Array();
$(function (){
	$("#dp").attr("action","./inc/DataProcessingkl8add.php?t="+encodeURI($("#tys").html()));
	loadInfo(false);
	loadTime();
	setOpnumberTirem();
	if(getCookie("soundbut")=="on" || getCookie("soundbut")==null || getCookie("soundbut")==""){
//		alert(1);
//		document.
		SetCookie("soundbut","on");
		$("#soundbut").attr("value","on");
		$("#soundbut").attr("src","images/soundon.png");
	}else{
		SetCookie("soundbut","off");
		$("#soundbut").attr("value","off");
		$("#soundbut").attr("src","images/soundoff.png");
	}
});

/**
 * 開出號碼須加載
 */
function loadInfo(bool){
	var win = $("#UserResult");
//	var number = $("#t_LID"); //開獎期數
	$.post(_url, {tid : 1}, function(data){
		_Number (data.number, data.ballArr); //開獎號碼
		openNumberCount(data, bool);//雙面長龍
		win.html((data.winMoney).toFixed(1)); //今天輸贏
	}, "json");
	if (bool == true) {
//		alert(1);
		//if(getCookie("soundbut")=="on"){
			$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/c.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");
		//}
	}
}
function _Number (number, ballArr) {
	var Clss = null;
	$("#UP_LID").html(number);
	for (var i = 0; i<ballArr.length; i++) {
		Clss = "b"+(ballArr[i]<=9?"0":"")+ballArr[i];
		$("#BaLL_No"+(i+1)).removeClass().addClass("ballskl8").addClass(Clss);
	}
}
function openNumberCount(row, bool){
		var rowHtml3=new Array();
		for (var key in row.sm){
			rowHtml3.push("<tr bgcolor=\"#fff\" height=\"20\"><td style=\"padding-left:5px; background:#fff4eb; color:#511e02\">"+row.sm[key][0]+"</td><td style=\"background:#ffffff; width:35px; color:red; text-align:center\">"+row.sm[key][1]+" 期</td></tr>");
		}
		var cHtml = '<tr class="t_list_caption"><th colspan="2"><font color="#4A1A04">兩面長龍排行</font></th></tr>';
		$("#cl").html(cHtml+rowHtml3.join(""));
		//
		setResultcq[0]=row.row1;
		setResultcq[1]=row.row2;
		setResultcq[2]=row.row3;
		setResultcq[3]=row.row4;
		setResultcq[4]=row.row5;
		setResultcq[5]=row.row6;
		if(_loadLT==false)
		{
			_loadLT=true;
			$("#defLT").trigger("click");	
		}
	}


function loadTime(){
	 _openNumber = $("#t_LID");
	$.post(_url, {tid : 2}, function(data){
		_openNumber.html(data.Phases);
		$("#pk").html(data.Phases.toString().substring(0,1)=='1'?"加拿大":"北京");
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
	var endTime = $("#hClockTime_C"); //封盤時間
	_endtime = endtime;
	if (_endtime >1)
		endTime.html(settime(_endtime));
	var interval = setInterval(function(){
									
		if (_endtime<10&&_endtime>0){
			if(getCookie("soundbut")=="on"){
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
	var openTime = $("#hClockTime_O"); //開獎時間
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
	var refreshTime = $("#Update_Time"); //刷新時間
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
//	alert(oddslist);
	var odds, link, urls;
	
	if (oddslist == null || oddslist == "" || endtime <1) {
		$(".multiple_Red").html("-");
		return false;
	}
	if(gametype=="zm")
	{
		for (var i in oddslist[0]){
			odds = oddslist[0][i];
			urls = "fnjskl8.php?tid=Ball_1&numberid="+number+"&hid="+i;
			link = "<a href=\""+urls+"\"  target=\"leftFrame\" class=\"bgh\">"+odds+"</a>";
			$("#"+i).html(link);
		}	
	}
	else
	{
		var a=["","zhdx","zhds","zhhj","gg","zhh","dsh","wx"];
		for (var n=1; n<oddslist.length; n++){
			for (var i in oddslist[n]){
				odds = oddslist[n][i];
				urls = "fnjskl8.php?tid="+bc(a[n])+"&numberid="+number+"&hid="+a[n]+i.replace("h","");
				link = "<a href=\""+urls+"\"  target=\"leftFrame\" class=\"bgh\">"+odds+"</a>";
				$("#"+a[n]+i.replace("h","")).html(link);
			}
		}
	}
}
function bc(str){
		switch (str){
			case "zhdx" : return "Ball_2";
			case "zhds" : return "Ball_3";
			case "zhhj" : return "Ball_4";
			case "gg" : return "Ball_5";
			case "zhh" : return "Ball_6";
			case "dsh" : return "Ball_7";
			case "wx" : return "Ball_8";
		}
	}
/**
 * 加載輸入框
 */
function loadinput(endtime){

	var loads = $(".load");
	var count=0, lock1=lock2=lock3=1,lock4=1, lock5=1, s, n="停押";
	var k=0;
	loads.each(function(){

		if (endtime < 1){
			$(this).html(n);
		} else {
			if(gametype=="zm")
			{
				if(count%4==0) 
				{
					k++;
				}
				n = "<input name=\"Ball_1mh"+(k+((count%4)*20))+"\" class=\"inp1\"  onclick=\"Shortcut_ImportM(this)\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
				$(this).html(n);
			}
			else
			{
				if (count == 0 ) {
					n = "<input name=\"Ball_2mzhdx1\" class=\"inp1\"  onclick=\"Shortcut_ImportM(this)\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 1) {
					n = "<input name=\"Ball_2mzhdx2\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 2) {
					n = "<input name=\"Ball_3mzhds1\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 3) {
					n = "<input name=\"Ball_3mzhds2\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				
				if (count == 4 ) {
					n = "<input name=\"Ball_4mzhhj1\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 5) {
					n = "<input name=\"Ball_5mgg1\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 6) {
					n = "<input name=\"Ball_5mgg2\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 7) {
					n = "<input name=\"Ball_5mgg3\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				
				if (count == 8 ) {
					n = "<input name=\"Ball_5mgg4\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 9) {
					n = "<input name=\"Ball_6mzhh1\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 10) {
					n = "<input name=\"Ball_6mzhh2\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 11) {
					n = "<input name=\"Ball_6mzhh3\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 12) {
					n = "<input name=\"Ball_7mdsh1\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				
				if (count == 13 ) {
					n = "<input name=\"Ball_7mdsh2\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 14 ) {
					n = "<input name=\"Ball_7mdsh3\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 15) {
					n = "<input name=\"Ball_8mwx1\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 16) {
					n = "<input name=\"Ball_8mwx2\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 17) {
					n = "<input name=\"Ball_8mwx3\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 18) {
					n = "<input name=\"Ball_8mwx4\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
				if (count == 19 ) {
					n = "<input name=\"Ball_8mwx5\" class=\"inp1\" onclick=\"Shortcut_ImportM(this)\"  onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"9\"/>"
					$(this).html(n);
				}
			}
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
	var opnumber = $("#UP_LID").html();
	var nownumer = $("#t_LID").html();
	if (opnumber != "-"&&opnumber != ""){
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
//		alert(1);
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
			s[2] = $("#"+s[2]+" a").html();

			n = s[0]+"["+s[1]+"] @ "+s[2]+" x ￥"+value;
			names.push(n+"\n");
			
		}
	});
	if (count == 0){alert("請填寫下註金額!!!");return false;}
	if (c == false){ alert("最低下註金額："+mixmoney+"￥");return false;}
	var confrims = "共 ￥"+countmoney+" / "+count+"筆，確定下註嗎？\n\n下註明細如下：\n\n";
	confrims +=names.join('');
	if (confirm(confrims)){
		input.val("");
		var number = $("#t_LID").html();
		var s_type = '<input type="hidden" name="s_cq" value="'+sArray+'"><input type="hidden" name="s_number" value="'+number+'">';
		$("#actiionn").html(s_type);
		return setTimeout(function(){return true}, 3000);
	}
	return false;
}

function nameformat(array){
	var arr = new Array(), h;
	switch (array[0]){
		case "Ball_1" :
			h="h";
			arr[0] = "正碼";
			for(var i=1;i<=80;i++)
			{
				if(array[1]=="h"+i)
				{
					arr[1]=(i<=9?"0":"")+i;break;	
				}		
			}
			break;
		case "Ball_2" :
			h="zhdx"; 
			arr[0] = "總和大小"; 
			switch(array[1]){
				case "zhdx1":arr[1]="總和大";break;
				case "zhdx2":arr[1]="總和小";break;
			}
			break;
		case "Ball_3" : 
			h="zhds"; 
			arr[0] = "總和單雙";
			switch(array[1]){
				case "zhds1":arr[1]="總和單";break;
				case "zhds2":arr[1]="總和雙";break;
			} 
			break;
		case "Ball_4" : 
			h="zhhj"; 
			arr[0] = "總和和局";
			arr[1]="總和810";
			break;
		case "Ball_5" : 
			h="gg"; 
			arr[0] = "總和過關";
			switch(array[1]){
				case "gg1":arr[1]="總大單";break;
				case "gg2":arr[1]="總大雙";break;
				case "gg3":arr[1]="總小單";break;
				case "gg4":arr[1]="總小雙";break;
			}
			break;
		case "Ball_6" : 
			h="zhh"; 
			arr[0] = "前後和"; 
			switch(array[1]){
				case "zhh1":arr[1]="前(多)";break;
				case "zhh2":arr[1]="後(多)";break;
				case "zhh3":arr[1]="前後(和)";break;
			} 
			break;
		case "Ball_7" : 
			h="dsh"; 
			arr[0] = "單雙和"; 
			switch(array[1]){
				case "dsh1":arr[1]="單(多)";break;
				case "dsh2":arr[1]="雙(多)";break;
				case "dsh3":arr[1]="單雙(和)";break;
			} 
			break;
		case "Ball_8" : 
			h="wx"; 
			arr[0] = "五行"; 
			switch(array[1]){
				case "wx1":arr[1]="金";break;
				case "wx2":arr[1]="木";break;
				case "wx3":arr[1]="水";break;
				case "wx4":arr[1]="火";break;
				case "wx5":arr[1]="土";break;
			} 
			break;
	}
	arr[2]=array[1]; //h+
	return arr;
}


function nameformat2(array){
	var arr = new Array(), h;
	switch (array[0]){
		case "Ball_1" : h="h"; arr[0] = "Ball_1"; break;
		case "Ball_2" : h="zhdx"; arr[0] = "Ball_2"; break;
		case "Ball_3" : h="zhds"; arr[0] = "Ball_3"; break;
		case "Ball_4" : h="zhhj"; arr[0] = "Ball_4"; break;
		case "Ball_5" : h="gg"; arr[0] = "Ball_5"; break;
		case "Ball_6" : h="zhh"; arr[0] = "Ball_6"; break;
		case "Ball_7" : h="dsh"; arr[0] = "Ball_7"; break;
		case "Ball_8" : h="wx"; arr[0] = "Ball_8"; break;
	}
	arr[1]=array[1]; //h+
	return arr;
}



function getResult ($this){
	$(".nv_a").addClass("nv").removeClass("nv_a");
	$($this).removeClass("nv").addClass("nv_a");
	$(".nv_ab").removeClass("nv_ab");
	$($this).parent().addClass("nv_ab");
	var rowHtml = new Array();
	var data = stringByInt ($($this).html());
	/*for (var k in data){
		rowHtml.push(data[k]);
	}*/
	$("#z_cl").html(data); //rowHtml.join('')
	$(".z_cl:even").addClass("hhg");
}

function stringByInt (str){
	switch (str){
		case "總和數" : return setResultcq[0];
		case "總和大小" : return setResultcq[1];
		case "總和單雙" : return setResultcq[2];
		case "五行" : return setResultcq[3];
		case "前後和" : return setResultcq[4];
		case "單雙和" : return setResultcq[5];
	}
}






