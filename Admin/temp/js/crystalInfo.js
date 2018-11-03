var _id = null;
$(function(){
	$.post("/Admin/temp/ajaxad/numjson.php", {mid : 1}, function(data){
		if (data != null){
			var a=new Array();
			for (var i in data.rows){
				a.push('<option value="'+data.rows[i]+'">'+data.rows[i]+'</option>');
			}
			$("#numbers").html('<option value="0" selected="selected">-----請選擇-----</option>'+a.join(''));
			$("#startNumber").html('<option value="0" selected="selected">----開始期數----</option>'+a.join(''));
			$("#endNumber").html('<option value="0" selected="selected">----結束期數----</option>'+a.join(''));
		}
	}, "json");
});

function FromSubmit(){
	    var href;
		var r = $("#det4");
		var Find = $("#lt");
		var searchne = $("#member");
        var s = $("#startDate");
		var e = $("#endDate");
		var sername = $("#searchName");
		if (sername.val() == ""){
		href = "CrystagInfo.php?Type="+Find.val()+"&searchName="+searchne.val()+"&rid="+r.val()+"&start="+s.val()+"&end="+e.val()+"&gname=";
		}else{
		href = "CrystagInfo.php?Type="+Find.val()+"&searchName=&rid="+r.val()+"&start="+s.val()+"&end="+e.val()+"&gname="+sername.val();
		}
	location.href = href;
}

function delCrystal($this, id){
	_id = id;
	var _this = $($this);
	var oddsPop = $("#oddsPops");
	var offsetTop = "20%";
	var offsetLeft = "40%";
	$("#typeids").html("單號&nbsp;"+id+"#");
	$("#oddsPops").fadeIn(100).css({top : offsetTop, left : offsetLeft, "display" : ""});
}

function GoDel(){
	if (confirm("單號 "+_id+"# 確定刪除嗎？")){
		var ros = $("#ros").attr("checked");
		var sid = 0;
		if (ros == true){
			sid =1;
		} 
		location.href = "/functioned/DelCry.php?delid="+_id+"&sid="+sid;
	}
}

	function closesPop(){
		$("#oddsPops").fadeOut(100);
		$("#ros").attr("checked","");
	}

	function delAll(){
		if (confirm("確定刪除嗎？")){
			var startNumber = $("#startNumber").val();
			var endNumber = $("#endNumber").val();
			location.href = "/functioned/DelCry.php?startNumber="+startNumber+"&endNumber="+endNumber;
		}
	}
	
	function locationFile(e){
	var event = window.event || e;
	var oddsPop = $("#oddsPops2");
	var offsetTop = event.y; 
	var offsetLeft = event.x-135; 
	$("#oddsPops2").slideDown(200).css({top : offsetTop, left : offsetLeft, "display" : ""});
}
function closesPop(){
	$("#oddsPops2").slideToggle(200);
	$("#isSubmit").attr("disabled","");
	$("#showPas").html('&nbsp;請輸入安全碼：<input class="textc" id="pscode"  name="pscode" type="password" />').css("color","");
}
