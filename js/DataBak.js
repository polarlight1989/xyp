function BakDowload(id) {
    var html = $.ajax({
        url: "/Xml/Bak.ashx",
        data: { id: id, v: +new Date() },
        async: false
    }).responseText;

    if (html == "2") { //封盘
        window.open("/Close.aspx", "FrameCenter");
    } else if (html == "1") {
        window.open("/Close.aspx?bakID=1", "FrameCenter");
    }
    else {
        window.open(html, "FrameCenter");
    }
}

function AccountBak(obj) {
    var c1 = $("#GD").val();
    var c2 = $("#CQ").val();
    var c3 = $("#BJ").val();
    var c4 = $("#JS").val();
    var showr = $("#showr");
    var upFormat = $("#upFormat").val();
    var member = $("#member").val();
    var upExcel = $("#upExcel");
    var input = document.getElementsByTagName("input");
    var a = [], ret = 6;

    if (member == "0") {
        alert("抱歉！請選擇帳號。");
        return false;
    }

    if (c1 == "0" && c2 == "0" && c3 == "0" && c4 == "0") {
        alert("下載備份至少選擇一個彩種賬單！！！");
        return false;
    }

    for (var i = 0; i < input.length; i++) {
        if (input[i].type == "radio" && input[i].checked == true) {
            ret = input[i].value;
        }
    }

    form.submit();
    return true;
}