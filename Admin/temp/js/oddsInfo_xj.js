var _url = "/Admin/temp/ajaxad/oddsJson_xj.php";
var val = 1;
$(function(){
	loadOdds(1);loadOdds(2);
	$(".oddsval").change(function(){
		setoddsval($(this).attr("id"), $(this).val());
	});
});

/**
 * 加載賠率
 */
function loadOdds(iType){
	var a = new Array('f_', 'g_', 'h_', 'i_');
	$.post(_url, {mid : iType}, function(data){
		for (var i in data.oddsList){
			for (var h in data.oddsList[i]){
				var __odds = data.oddsList[i][h];
				if (iType == 1){
					$("#"+h).val(__odds);
				} else {
					h = h.replace("h","");
					$("#"+a[i]+h).val(__odds);
				}
			}
		}
	}, "json");
}

/**
 * 設置賠率，Add By Bluewing@2013.10.2
 */
function setoddsval(tid, value){
	$.post(_url, {mid : 4, tid : tid, oval : value}, function(data){
		//oddsHtml.html(isFloat(odds));
	},"text");
}

/**
 * 設置賠率
 */
function setodds(str, tid, $this){
	var oddsHtml = $("#"+str);
	var odds = parseFloat(oddsHtml.html());
	var Ho = $("#Ho").val();
	var h = str.substr(1);
	var value = $this.name;
	if (Ho == "" || !/^[0-9]+\.?[0-9]*$/.test(Ho)){$("#Ho").val("0.001");return}
	Ho = parseFloat(Ho);
	if (value == "1"){
		odds = (odds + Ho);
	} 
	else {
		if (odds < Ho){return}
		odds = (odds - Ho);
	}
	$.post(_url, {mid : 4, tid : tid, hid : h, oid : odds}, function(data){
		oddsHtml.html(isFloat(odds));
	},"text");
}

function isFloat(sInt){
	var p =  /(\.[0-9]+)/;
	if (p.test(sInt)){
		return parseFloat(sInt).toFixed(3);
	}
	return sInt;
}

function upOddaAll($this){
	if (confirm("確認更變賠率碼？")){
		var oddsType = $("#oddsType").val();
		var s_num = $("#s_num").val();
		var h = $("#h").val();
		var Ho = $("#Ho").val();
		if (Ho == "" || !/^[0-9]+\.?[0-9]*$/.test(Ho)){$("#Ho").val("0.001");return}
		$.post(_url, {mid : 5, oddsType : oddsType, h : h, s_num : s_num, sHo : Ho}, function(data){
			loadOdds();
		}, "text");
	}
}