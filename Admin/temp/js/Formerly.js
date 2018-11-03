var interval3;

$(function () {
    AddFormerly();
});

function LoadRefreshTime() {
    var RefreshTime = parseInt($("#_refreshTime").val());
    var $RefreshTime = $("#refreshTime");
    $RefreshTime.html(RefreshTime + "秒").addClass("black");

    if (interval3 != undefined)
        clearInterval(interval3);

    interval3 = setInterval(function () {
        if (RefreshTime <= 1) {
			//alert(1);
            $RefreshTime.html("加载中...").toggleClass("black");
            clearInterval(interval3);
			
            AddFormerly();
        } else {
            RefreshTime--;
            $RefreshTime.html(RefreshTime + "秒")
        }
    }, 1000);

    
}

function AddFormerly() {
	
    var member = $("#member").val();
    $.get("/Xml/Center/FormerlyData.php", { memberid: member, v: +new Date() }, function (data) {
        if (data != null && data != "") {
            var ary = data.split("|");
            $("#ct1").html(ary[0]);
            if (member != "") {
                $("#memberID").show();
                $("#ct2").html(ary[1]);
            } else {
                $("#memberID").hide();
            }
            LoadRefreshTime();
        }
    });
}