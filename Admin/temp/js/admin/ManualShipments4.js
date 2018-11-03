$(function () {
    AddGameInfo();
    Numbers();
    UpNumber();
});

var interval1, interval2, interval3, interval4, openNumber, closer;

//开盘期数、开盘时间、封盘时间
function AddGameInfo() {
    $.get("/Xml/Config.php", { id: 1, gid: 5, v: +new Date() }, function (xml) {
        $(xml).find("id").each(function (i) {
            openNumber = $(this).attr("openNumber");
            $("#openNumberData").html(openNumber + "期");
            $("#dayWin").html($(this).attr("dayWin"));
            setTime($(this).attr("openTime"), $(this).attr("endTime"));
            LoadInfo($(this).attr("openTime"));
            LoadRefreshTime();

        });
    }, "xml");
}

//最新开奖
function Numbers() {
    $.get("/Xml/Config.php", { id: 7, gid: 5, v: +new Date() }, function (data) {
        if (data != null && data != "") {
            var a = data.split(";");
            var s = a[1].split(",");
            $("#numberData").html(a[0] + "期");
            for (var i = 0; i < s.length; i++) {
                document.getElementById("b" + (i + 1)).className = s[i];
            }
            $(".b_jk").show();
            var r = a[2].split("|"), k = [], h, o;
            k.push("<tr class=\"Conter_top\"><th colspan=\"6\">近期開獎結果</th></tr>");
            for (var n = 0; n < r.length; n++) {
                h = r[n].split("@");
                o = h[1].split(",");
                k.push("<tr class=\"Conter_Report_List\">");
                k.push("<td width=\"35\">" + h[0] + "期</td>");
                k.push("<td width=\"27\" height=\"27\" class=\"No_" + o[0] + "\"></td>");
                k.push("<td width=\"27\" height=\"27\" class=\"No_" + o[1] + "\"></td>");
                k.push("<td width=\"27\" height=\"27\" class=\"No_" + o[2] + "\"></td>");
                k.push("<td width=\"30\">" + h[2] + "</td>");
                k.push("<td width=\"30\">" + h[3] + "</td>");
                k.push("</tr>");
            }
            $("#showNumber").html(k.join(''));
        }
    });
}

//赔率信息
function LoadInfo(openTime) {
    var kid = $("#details_tn").val();
    var tid = $("#TID").val();
    var n = $("#N").val();
    var nid = openNumber;
    var url = "Center/SetOdds8.php";
    $.get(url, { id: tid, n: n, gid: 5, nid: nid, kid: kid, v: +new Date() }, function (xml) {
        $(xml).find("row").each(function (i) {
            $("#" + $(this).attr("id")).html($(this).attr("odds"));
            var C = $(this).attr("id").replace("H", "C");
            $("#" + C).html($(this).attr("money"));
            var B = $(this).attr("id").replace("H", "B");
            if (parseInt($(this).attr("deficit")) > 0 && tid != 10) {
                if (i == 2 || i == 3 || i == 4 || i == 5 || i == 6 || i == 7) {
                    var _odds = (parseFloat($(this).attr("odds")) - 1) + (parseFloat($(this).attr("odds")) - 1);
                    var Bb = parseFloat($(this).attr("deficit")) * _odds;
                    _odds = (parseFloat($(this).attr("odds")) - 1) + (parseFloat($(this).attr("odds")) - 1) + (parseFloat($(this).attr("odds")) - 1);
                    var Bc = parseFloat($(this).attr("deficit")) * _odds;
                    $("#" + B + "_A").html(Base.ForDight(Bb, 0)).css("color", "red");
                    $("#" + B + "_B").html(Base.ForDight(Bc, 0)).css("color", "red");
                }
                $("#" + B).html($(this).attr("deficit")).css("color", "red");
            }
            else {
                if (i == 2 || i == 3 || i == 4 || i == 5 || i == 6 || i == 7) {
                    $("#" + B + "_A").html($(this).attr("deficit"));
                    $("#" + B + "_B").html($(this).attr("deficit"));
                }
                $("#" + B).html($(this).attr("deficit"));
            }
            if (i == 0)
                $("#_s1").html($(this).attr("count"));
            else if (i == 1)
                $("#_s2").html($(this).attr("count"));
            else if (i == 2)
                $("#_s3").html($(this).attr("count"));
            else if (i == 3)
                $("#_s4").html($(this).attr("count"));
            else if (i == 4)
                $("#_s5").html($(this).attr("count"));
            else if (i == 5)
                $("#_s6").html($(this).attr("count"));
            else if (i == 6)
                $("#_s7").html($(this).attr("count"));

        });

        if (openTime <= 0) {
            addClassName();
        }
        $("#ct1").show();
        $("#ct2").show();
        $("#ct3").show();
        $("#ct4").show();
        $("#ct5").show();
        $("#ct6").show();
        $("#ct7").show();
    }, "xml");
}

function LoadRefreshTime() {
    var RefreshTime = parseInt($("#_refreshTime").val());
    var $RefreshTime = $("#refreshTime");
    if (RefreshTime > 0) {
        if (interval3 != undefined)
            clearInterval(interval3);
        $RefreshTime.html("更新：" + RefreshTime + "秒").addClass("black");
        interval3 = setInterval(function () {
            if (RefreshTime <= 1) {
                $RefreshTime.html("加载中...").toggleClass("black");
                clearInterval(interval3);
                AddGameInfo();
            } else {
                RefreshTime--;
                $RefreshTime.html("更新：" + RefreshTime + "秒")
            }
        }, 1000);
    } else {
        clearInterval(interval3);
        $RefreshTime.html("<input type=\"button\" class=\"pushr\" value=\"刷新\" />");
    }
}

function setTime(openTime, endTime) {
    var $startTime = $("#startTime");
    var $endTime = $("#startTime");
    var _startTime = parseInt(openTime);
    var _endTime = parseInt(endTime);
    if (openTime >= 1) {
        $("#openDate").html("距封盘：").removeClass("red");
        $startTime.removeClass("red");
    } else {
        $("#openDate").html("距開獎：").addClass("red");
        $(".eccd").attr("disabled", "disabled");
        $endTime.addClass("red");
    }

    if (_startTime > 0) {
        closer = true;
        $startTime.html(Base.settime(_startTime));
    }

    if (interval1 != undefined) {
        clearInterval(interval1);
    }

    interval1 = setInterval(function () {
        _startTime--;
        _endTime--;
        if (_startTime < 0) { //封盘时间结束
            closer = false;
            addClassName();
            LoadEndTime(_endTime);
            $endTime.html(Base.settime(_endTime));
            clearInterval(interval1);
        } else {
            $startTime.html(Base.settime(_startTime));
        }
    }, 1000);

    function LoadEndTime(endTime) {
        var _endTime = endTime;
        $("#openDate").html("距開獎：").addClass("red");
        $(".eccd").attr("disabled", "disabled");
        $endTime.addClass("red");

        if (interval2 != undefined) {
            clearInterval(interval2);
        }
        interval2 = setInterval(function () {
            if (_endTime <= 1) { //开奖时间结束
                $endTime.html("00:00");
                setTimeout(function () { location.href = location.href; }, 1500);

            } else {
                _endTime--;
                $endTime.html(Base.settime(_endTime));
            }
        }, 1000);
    }
}

function Details() {
    var _value = parseInt($("#_value").val()), dn = $("#details_tn").val();
    var odds, B, C, S;
    for (var n = 0; n < 1; n++) {
        for (var i = 0; i < 50; i++) {
            odds = parseFloat($("#H_" + n + "_" + i).html());
            C = parseInt($("#C_" + n + "_" + i).html());
            B = parseFloat($("#B_" + n + "_" + i).html());
            if (Base.patrn.Decimal.exec(B) && Base.patrn.Number.exec(C) && _value.toString() != "NaN") {
                S = parseInt((B + C + _value) / odds);
                if (Base.patrn.Number.exec(S) && (_value + B) > 0 && dn == 0) {
                    $(".S_" + n + "_" + i).html(S);
                } else if ($(".S_" + n + "_" + i).html() != "") {
                    $(".S_" + n + "_" + i).html("");
                }
            }
        }
    }
}

function UpNumber() {
    if (interval4 != undefined)
        clearInterval(interval4);

    if (openNumber == undefined) {
        setTimeout(UpNumber, 5000);
    } else {
        var count = 0;
        if (openNumber.substr(8, 11) == "001")
            return false;
        var _number = parseInt(openNumber) - 1;
        interval4 = setInterval(function () {
            $.get("/Xml/Config.php", { id: 3, numID: _number, gameid: 5, v: +new Date() }, function (data) {
                if (data == "True") {
                    if (count > 0) {
                        AddGameInfo();
                        Numbers();
                    }
                    clearInterval(interval4);
                }
                count = 1;
            });
        }, 5000);
    }
}


function ShowDetails(obj) {
    AddGameInfo();
    if (obj.value == "1") {
        $(".bct").attr("disabled", "disabled");
        $(".eccd").attr("disabled", "disabled");
    } else {
        $(".bct").attr("disabled", "");
        $(".eccd").attr("disabled", "");
    }
}

function locations(url) {
    location.href = url;
}
function showMouse(obj, className) {
    $(obj).addClass("backgroundColor");
    $(obj).siblings("." + className).addClass("backgroundColor");
}
function closeMouse(obj, className) {
    $(obj).removeClass("backgroundColor");
    $(obj).siblings("." + className).removeClass("backgroundColor");
}
function addClassName() {
    $(".ct1").addClass("backgroundColord2");
    $(".ct2").addClass("backgroundColord2");
}
function removeClassName() {
    $(".ct1").removeClass("backgroundColord2");
    $(".ct2").removeClass("backgroundColord2");
}