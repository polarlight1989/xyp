//var data = { "liBtn0": "哈哈", "liBtn1": "test" };
//菜单选择
//ids：菜单的id，url:菜单链接，flag:是否带参数
function selectMenu(ids, url,flag) {
    var liList = $("#navBtnMenu li");
    if(ids == '6'){
        if(!confirm("您確定退出嗎？")){
            return;
        }
    }
    for (var i = 0; i < liList.length; i++) {
        if (liList[i].id == ("liBtn" + ids)) {
            liList[i].className = "onBtn";
        }
        else {
            liList[i].className = "navBtn";
        }
    };
    var fotteryFlag = $("#FotteryFlag").val();
    var uri = url + "?LLT=" + fotteryFlag;
    if (uri.indexOf("Report_JeuWJS.aspx") > -1 && fotteryFlag != "0") {
        uri = "Report_JeuWJS_kc.aspx?LLT=" + fotteryFlag;
        goto_URL(uri);
    }
    else {
        goto_URL(uri);
    }

//    if (flag == "1") {
//        //彩种类型
//        var fotteryFlag = $("#FotteryFlag").val();
//        //goto_URL(url + "?LLT=" + fotteryFlag);
//    }
//    else {
//        //goto_URL(url);
//    }
};
function goto_URL(url) {
    if (url.substring(0, 7) == "Report_") {
        if (SB_Limit_Time > Today_Second()) {
            parent.frames["mainFrame"].document.close();
            parent.frames["mainFrame"].document.write(Html_SB);
        } else {
            parent.frames["mainFrame"].location = url;
        }
    } else {
        parent.frames["mainFrame"].location = url;
    }

    var liList = $("#navListBox a");
    for (var i = 0; i < liList.length; i++) {
        liList[i].className = "";
    };
}

//彩种分类0：六合彩，1：廣東快樂十分，2：重慶時時彩，3：北京赛车PK10，4：幸运农场，5:吉林快3(吉林快3)
var Lottery = new Array();
Lottery[0] = "<a href='javascript:void(0)' onclick='goto_CI(1,0,this.id)' id='MC0'>特碼</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(3,0,this.id)' id='MC1'>正碼</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(4,0,this.id)' id='MC2'>正碼特</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(10,0,this.id)' id='MC3'>連碼</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(18,0,this.id)' id='MC4'>不中</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(11,0,this.id)' id='MC5'>正碼1-6</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(12,0,this.id)' id='MC6'>特碼生肖</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(13,0,this.id)' id='MC7'>生肖尾數</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(15,0,this.id)' id='MC8'>半波</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(16,0,this.id)' id='MC9'>六肖/生肖連/尾數連</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(17,0,this.id)' id='MC10'>龍虎/特碼攤子</a>";

Lottery[1] = "<a href='javascript:void(0)' onclick='goto_CI(16,1,this.id)' id='MC16'>兩面盤</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(23,1,this.id)' id='MC23'>單球1-8</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(1,1,this.id)' id='MC1'>第一球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(2,1,this.id)' id='MC2'>第二球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(3,1,this.id)' id='MC3'>第三球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(4,1,this.id)' id='MC4'>第四球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(5,1,this.id)' id='MC5'>第五球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(6,1,this.id)' id='MC6'>第六球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(7,1,this.id)' id='MC7'>第七球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(8,1,this.id)' id='MC8'>第八球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(9,1,this.id)' id='MC9'>總和、龍虎</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(10,1,this.id)' id='MC10'>連碼</a>";

Lottery[2] = "<a href='javascript:void(0)' onclick='goto_CI(17,2,this.id)' id='MC17'>兩面盤</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(24,2,this.id)' id='MC24'>單球1-5</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(11,2,this.id)' id='MC11'>第一球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(12,2,this.id)' id='MC12'>第二球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(13,2,this.id)' id='MC13'>第三球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(14,2,this.id)' id='MC14'>第四球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(15,2,this.id)' id='MC15'>第五球</a>";

Lottery[3] = "<a href='javascript:void(0)' onclick='goto_CI(21,3,this.id)' id='MC21'>兩面盤</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(22,3,this.id)' id='MC22'>單球1-10</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(18,3,this.id)' id='MC18'>冠、亞軍 組合</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(19,3,this.id)' id='MC19'>三、四、五、六名</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(20,3,this.id)' id='MC20'>七、八、九、十名</a>";

Lottery[4] = "<a href='javascript:void(0)' onclick='goto_CI(26,4,this.id)' id='MC26'>兩面盤</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(27,4,this.id)' id='MC27'>單球1-8</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(28,4,this.id)' id='MC28'>第一球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(29,4,this.id)' id='MC29'>第二球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(30,4,this.id)' id='MC30'>第三球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(31,4,this.id)' id='MC31'>第四球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(32,4,this.id)' id='MC32'>第五球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(33,4,this.id)' id='MC33'>第六球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(34,4,this.id)' id='MC34'>第七球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(35,4,this.id)' id='MC35'>第八球</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(36,4,this.id)' id='MC36'>總和、家禽野獸</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(37,4,this.id)' id='MC37'>連碼</a>";

Lottery[5] = "<a href='javascript:void(0)' onclick='goto_CI(37,5,this.id)' id='MC38'>大小骰寶</a>";

Lottery[6] = "<a href='javascript:void(0)' onclick='goto_CI(39,6,this.id)' id='MC39'>總和、比數、五行</a><b>|</b><a href='javascript:void(0)' onclick='goto_CI(40,6,this.id)' id='MC40'>正碼</a>";

//下拉菜单
function enterSysIndex(text, uri) {
    $("#currentType").html(text);
    var hrefText = Lottery[uri].toString();
    $("#navListBox").html("");
    $("#navListBox").html(hrefText);
    switch (uri) {
        case "0":
            goto_CI('1', uri, 'MC0');
            break;
        case "1":
            goto_CI('16', uri, 'MC16');
            break;
        case "2":
            goto_CI('17', uri, 'MC17');
            break;
        case "3":
            goto_CI('21', uri, 'MC21');
            break;
        case "4":
            goto_CI('26', uri, 'MC26');
            break;
        case "5":
            goto_CI('37', uri, 'MC38');
            break;
        case "6":
            goto_CI('39', uri, 'MC39');
            break;
        default: break;
    }
    $("#FotteryFlag").val(uri);
}

//T:获取数据的传递参数
//fid:类别（0：六合彩，1：廣東快樂十分，2：重慶時時彩，3：北京赛车PK10，4：幸运农场，5:吉林快3/吉林快3）
function goto_CI(T, fid, objID) {
    var flag = fid.toString();
    if (flag == "0") {
        if (T == '' || T == null) {
            window.parent.frames["mainFrame"].location = "CI1.aspx?T=" + T;
        } else {
            window.parent.frames["mainFrame"].location = "CI1.aspx?T=" + T;
        }
    }
    else {
        var s_LT = flag;
        if (T == '' || T == null) {
            window.parent.frames["mainFrame"].location = "CI_" + s_LT + ".aspx?T=" + T + "&UVID=0";
        } else {
            window.parent.frames["mainFrame"].location = "CI_" + s_LT + ".aspx?T=" + T + "&C=1" + "&UVID=0";
        }
    }

    var liList = $("#navListBox a");
    for (var i = 0; i < liList.length; i++) {
        if (liList[i].id == objID) {
            liList[i].className = "onBtn1";
        }
        else {
            liList[i].className = "";
        }
    };

    var liList = $("#navBtnMenu li");
    for (var i = 0; i < liList.length; i++) {
        liList[i].className = "navBtn";
    };

}
function Select_MC(MC_ID) {

}

var SB_Limit_Time = 0; //限製時間

function Today_Second() {
    var date = new Date();
    return date.getHours() * 3600 + date.getMinutes() * 60 + date.getSeconds();
}

function SB_Limit(Ltime) {
    SB_Limit_Time = Today_Second() + Ltime;
}



function xmlLoadNews() {
    try {
        $.ajax({
            async: true,
            url: 'Ad_Xml.aspx',
            type: 'GET',
            dataType: 'xml',
            cache: false,
            timeout: 5000,
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                document.getElementById("Affiche").innerHTML = "獲取更新信息失敗,正在重新連線...";
                setTimeout("UpdateAD()", 2000);
             },
            success: function (xml) {
                try {
                    XmlTraverse(xml.documentElement);
                } catch (e) {
                    setTimeout("UpdateAD()", 1000); 
                }
            }
        })
    } catch (e) {
        setTimeout("UpdateAD()", 2000); 
    }
}

function XmlTraverse(pnode) {
    var l = pnode.childNodes.length;
    for (var i = 0; i < l; i++) {
        var node = pnode.childNodes[i];
        if (node.tagName == "ReadErr") { //error
            if (get_xml_text(node) == "EXIT") top.location.href = "../";
        } else if (node.tagName == "Affiche") {
            try {
                document.getElementById("Affiche").innerHTML = get_xml_text(node);
            } catch (e) { }
            //繼續
            t_UpdateAD = 8;
            setTimeout("UpdateAD()", 1000);
        }
    }
}

var t_UpdateAD = 8;
var RealityIP = '';
//更新倒计时
function UpdateAD() {
    if (t_UpdateAD > 1) {
        t_UpdateAD = t_UpdateAD - 1;
        setTimeout("UpdateAD()", 1000);
    } else {
        xmlLoadNews();
    }
}

function get_xml_text(node) {
    if (-[1, ]) {
        return $.trim(node.textContent);
    } else {
        return $.trim(node.text);
    }
}

