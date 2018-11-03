//计算补货用
var t_BalanceValue = -100000000;
var t_Account_PL = 1;
var t_Account_TS = 0;
var Pop_UserType = 4;
var Pop_AM = 0;
var Pop_F = 0;
var AVID = 0;
function ForDight(Dight, How) {
    Dight = Math.round(Dight * Math.pow(10, How)) / Math.pow(10, How);
    return Dight;
}

var up_mXZ = "0"; //实、虚
var up_uniteB = "";

//读取赔率、註单
//var XmlActiveX=new ActiveXObject("Microsoft.XMLDOM"); 
var t_LT;
var t_LID;
var t_GT = "";
var t_AO = ""; //附加统计 用于特码A盘+B盘
var inceptMID = 0; //號碼ID起始位置

var t_LB = ""; //基本资料是否已加载
var Mouse_Affair = false; //鼠标事件是否已设定

var Always_Fill = false; //始终fill

var Base_Array = new Array();

var G_Sum_Array = new Array(new Array(), new Array(), new Array(), new Array(), new Array(), new Array(), new Array(), new Array());
var M_Sum_Array = new Array();

var Work_Array = new Array();

var AF_Array = new Array(); //緩存自動補貨設置 退水信息

var LX_Result_Array = new Array();

//特碼總項專用，緩衝其它項目負值
var Else_jBWr_Array = new Array();
var Else_LX_Array = new Array(); //六肖

var ThisYear_Animal_ID = 0; //今年生肖ID

//波色
var No_Color = new Array("", "B", "B", "B", "B", "B", "B", "B", "B", "B", "B", "B", "B", "B", "B", "B", "B", "B", "B", "R", "R");

//号码对应ID
var NoID_Array = new Array();
//排序数组
var Taxis_Array = new Array();
var Taxis_Load = 0;
var Taxis_Desc = 1; //0=升序 1=降序

var t_Update_Time = 0;
var Taxis_ID_Array = new Array(); //排序位置对应ID

var Group_MX_selID = 0; //选择按组明細ID

//賠率微調使用
var wnP_Array = new Array();

// 设置下拉cookie计数
var setSelectCookieNum = 0;

//更新倒计时
var ud_Timer = null;
function UpdateTime() {
    if (t_Update_Time > 1) {
        t_Update_Time = t_Update_Time - 1;
        document.getElementById("Update_Show").innerHTML = "更新：" + t_Update_Time + "&nbsp;秒";
        ud_Timer = setTimeout("UpdateTime()", 1000);
    } else {
        LoadXml()
    }
}
//切換號碼類類別排序糢式
function Switch_NoType(TypeID) {
    parent.topframe.Clase_CacheBet();
    window.location = window.location.toString().replace("&C=1&", "&").replace("&NoTable=1", "").replace("&NoTable=2", "").replace("&NoTable=3", "") + "&NoTable=" + TypeID;
}
function LoadXml() {
    // 首次加载不执行写入select cookie
    if(setSelectCookieNum>0){
        setSelectCookie();
    }
    setSelectCookieNum++;

    try {
        document.getElementById("Update_Show").className = "Font_B";
        document.getElementById("Update_Show").innerHTML = "載入中...";
        clearInterval(ud_Timer);
        if (document.getElementById('money_XZ').value == "1") {
            $("#uniteB").attr("disabled", false);
        } else {
            $("#uniteB").attr("disabled", true);
        }
        if (document.getElementById('money_XZ').value == "1" && document.getElementById('OpenCheck').value == "A") {
            $("#BalanceValue").attr("disabled", false);
            $("#AccountFill").attr("disabled", false);
            $("#AccountOdd").attr("disabled", false);
            $("#Account_PL").attr("disabled", false);
            $("#Account_TS").attr("disabled", false);
        } else {
            $("#BalanceValue").attr("disabled", true);
            $("#AccountFill").attr("disabled", true);
            $("#AccountOdd").attr("disabled", true);
            $("#Account_PL").attr("disabled", true);
            $("#Account_TS").attr("disabled", true);
        }
    } catch (e) { }

    if (up_mXZ != document.getElementById('money_XZ').value) {
        if (up_mXZ == "2") window.location = window.location.toString().replace("&C=1&", "&").replace("mXZ=0", "mXZ=" + document.getElementById('money_XZ').value).replace("mXZ=1", "mXZ=" + document.getElementById('money_XZ').value).replace("mXZ=2", "mXZ=" + document.getElementById('money_XZ').value);
        up_mXZ = document.getElementById('money_XZ').value;
    }
    var t_uniteB = "";
    if (document.getElementById('uniteB').checked == true) {
        t_uniteB = "1";
        $("#money_XZ").attr("disabled", true);
    }
    if (up_uniteB != t_uniteB) {
        if (up_uniteB == "1") window.location = window.location.toString().replace("&C=1&", "&").replace("uniteB=1&", "uniteB=&");
        up_uniteB = t_uniteB;
    }

    //XmlActiveX.onreadystatechange=XmlReady;
    //XmlActiveX.async="true";
    if (document.getElementById("ShowTitle").innerHTML == "連碼") {
        var Gmx_Count = 8;
        var Add_Parameter = "";
        if (Gmx_Count == 1) {
            if (Group_MX.checked == true) {
                Group_MX_selID = Number(Group_MX.value);
                Add_Parameter = "&LMmx=" + Group_MX.value;
            }
        } else {
            //            for (i=0;i<Gmx_Count;i++){
            //                if (Group_MX[i].checked == true){
            //                    Group_MX_selID=Number(Group_MX[i].value);
            //                    Add_Parameter="&LMmx=" + Group_MX[i].value;
            //                    break;
            //                }
            //            }
            var radio = $('input[name="Group_MX"]').filter(':checked');
            if (radio.length) {
                Group_MX_selID = Number(radio.val());
                Add_Parameter = "&LMmx=" + radio.val();
            }
        }
        //document.write("XML_20/Read_AIsum.aspx?LT=" + t_LT + "&GT=" + t_GT + "&ST=" + t_ST + "&LID=" + t_LID + "&mXZ=" + document.getElementById('money_XZ').value + "&OC=" + document.getElementById('OpenCheck').value + "&uniteB=" + t_uniteB + "&LB=" + t_LB + "&AO=" + t_AO + Add_Parameter);
        //XmlActiveX.load("XML_20/Read_AIsum.aspx?LT=" + t_LT + "&GT=" + t_GT + "&ST=" + t_ST + "&LID=" + t_LID + "&mXZ=" + document.getElementById('money_XZ').value + "&OC=" + document.getElementById('OpenCheck').value + "&uniteB=" + t_uniteB + "&LB=" + t_LB + "&AO=" + t_AO + Add_Parameter);
        ajaxLoadXml("XML_20/Read_AIsum.aspx?LT=" + t_LT + "&GT=" + t_GT + "&ST=" + t_ST + "&LID=" + t_LID + "&mXZ=" + document.getElementById('money_XZ').value + "&OC=" + document.getElementById('OpenCheck').value + "&uniteB=" + t_uniteB + "&LB=" + t_LB + "&AO=" + t_AO + Add_Parameter);

    } else {
        if ((document.getElementById("ShowTitle").innerHTML.substr(0, 1) == "第" && document.getElementById("ShowTitle").innerHTML.substr(2, 1) == "球") || document.getElementById("ShowTitle").innerHTML == "總和、龍虎") {
            //document.write("XML_20/Read_AIsum.aspx?LT=" + t_LT + "&GT=" + t_GT + "&ST=" + t_ST + "&LID=" + t_LID + "&mXZ=" + document.getElementById('money_XZ').value + "&OC=" + document.getElementById('OpenCheck').value + "&uniteB=" + t_uniteB + "&LB=" + t_LB + "&AO=" + t_AO + "&AE=1");
            //XmlActiveX.load("XML_20/Read_AIsum.aspx?LT=" + t_LT + "&GT=" + t_GT + "&ST=" + t_ST + "&LID=" + t_LID + "&mXZ=" + document.getElementById('money_XZ').value + "&OC=" + document.getElementById('OpenCheck').value + "&uniteB=" + t_uniteB + "&LB=" + t_LB + "&AO=" + t_AO + "&AE=1");
            ajaxLoadXml("XML_20/Read_AIsum.aspx?LT=" + t_LT + "&GT=" + t_GT + "&ST=" + t_ST + "&LID=" + t_LID + "&mXZ=" + document.getElementById('money_XZ').value + "&OC=" + document.getElementById('OpenCheck').value + "&uniteB=" + t_uniteB + "&LB=" + t_LB + "&AO=" + t_AO + "&AE=1");
        } else {
            //XmlActiveX.load("XML_20/Read_AIsum.aspx?LT=" + t_LT + "&GT=" + t_GT + "&ST=" + t_ST + "&LID=" + t_LID + "&mXZ=" + document.getElementById('money_XZ').value + "&OC=" + document.getElementById('OpenCheck').value + "&uniteB=" + t_uniteB + "&LB=" + t_LB + "&AO=" + t_AO);
            ajaxLoadXml("XML_20/Read_AIsum.aspx?LT=" + t_LT + "&GT=" + t_GT + "&ST=" + t_ST + "&LID=" + t_LID + "&mXZ=" + document.getElementById('money_XZ').value + "&OC=" + document.getElementById('OpenCheck').value + "&uniteB=" + t_uniteB + "&LB=" + t_LB + "&AO=" + t_AO);
        }
    }
}

//function XmlReady() {    
//    if (XmlActiveX.readyState==4) {                
//        var xml=XmlActiveX.documentElement;
//        XmlTraverse(xml);
//    }
//}

function ajaxLoadXml(uri) {
    try {
        $.ajax({
            async: true,
            url: uri,
            type: 'GET',
            dataType: 'xml',
            cache: false,
            timeout: 5000,
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                t_Update_Time=Number(document.getElementById('AutoUpdate').value);
                document.getElementById("Update_Show").className='';
                document.getElementById("Update_Show").innerHTML="更新：" + t_Update_Time + "&nbsp;秒";
                ud_Timer=setTimeout("UpdateTime()",1000);
            },
            success: function (xml) {
                try {
                    XmlTraverse(xml.documentElement)
                } catch (e) { }
            }
        })
    } catch (e) { }
}

var PLAY_Sound1_Off = true;

function XmlTraverse(pnode) {
    var l = pnode.childNodes.length;
    for (var i = 0; i < l; i++) {
        if (pnode.childNodes[i].nodeType == 3) {
            continue;
        }
        var node = pnode.childNodes[i];
        if (node.tagName == "ReadErr") {
            if (get_xml_text(node) == "EXIT") {
                top.location = "../";
            }
        } else if (node.tagName == "Refurbish_Page") {
            window.location = window.location.toString();
        } else if (node.tagName == "L_ClockTime_C") {
            ClockTime_C = get_xml_text(node);
        } else if (node.tagName == "L_ClockTime_O") {
            ClockTime_O = get_xml_text(node);
        } else if (node.tagName == "UserResult") {
            document.getElementById("UserResult").innerHTML = get_xml_text(node);
        } else if (node.tagName == "Base") {
            t_LB = "1";
            Load_Base(node);
        } else if (node.tagName == "M_Sum") {
            Clear_G_Sum();
            Load_M_Sum(node);
        } else if (node.tagName == "M_Jeu") {
            Load_M_Jeu(node);
            Mouse_Affair = true;
        } else if (node.tagName == "AE_M") {
            Load_AE_M(node);
        } else if (node.tagName == "RunResult") {
            Load_RunResult(get_xml_text(node));
        } else if (node.tagName == "DropBall") {
            if (get_xml_text(node).length > 0) {
                a_DropBall = new String(get_xml_text(node)).split(",");
                var Max_Count = 0;
                for (var j = 0; j < a_DropBall.length; j++) {
                    document.getElementById("dbNO_" + (j + 1)).innerHTML = a_DropBall[j];
                    if (Number(a_DropBall[j]) >= Max_Count) Max_Count = Number(a_DropBall[j]);
                }
                if (Max_Count >= 3) {
                    for (var j = 0; j < a_DropBall.length; j++) {
                        if (Number(a_DropBall[j]) == Max_Count) {
                            document.getElementById("dbNO_" + (j + 1)).className = "t_list_tr_0 font_r F_bold";
                        } else {
                            document.getElementById("dbNO_" + (j + 1)).className = "t_list_tr_0";
                        }
                    }
                }
            }
        } else if (node.tagName == "Group_MX") {
            Load_Group_MX(node);
        } else if (node.tagName == "Work") {
            Load_Work(node);
        } else if (node.tagName == "AutoFill") {
            Load_AutoFill(node);
        } else if (node.tagName == "Ball_NoS") {
            var t_No = new String(get_xml_text(node)).split(",");
            if (document.getElementById("UP_LID").innerHTML != t_No[0]) {
                document.getElementById("UP_LID").innerHTML = t_No[0];
                if (t_No[1] == "-1" || t_No[1] == "-01") {
                    document.getElementById("BaLL_No1").innerHTML = " ";
                    document.getElementById("BaLL_No2").innerHTML = "官";
                    document.getElementById("BaLL_No3").innerHTML = "方";
                    document.getElementById("BaLL_No4").innerHTML = "未";
                    document.getElementById("BaLL_No5").innerHTML = "开";
                    document.getElementById("BaLL_No6").innerHTML = "奖";
                }
                else {
                    document.getElementById("BaLL_No1").className = "No_" + t_No[1];
                    document.getElementById("BaLL_No2").className = "No_" + t_No[2];
                    document.getElementById("BaLL_No3").className = "No_" + t_No[3];
                    document.getElementById("BaLL_No4").className = "No_" + t_No[4];
                    document.getElementById("BaLL_No5").className = "No_" + t_No[5];
                    document.getElementById("BaLL_No6").className = "No_" + t_No[6];
                    document.getElementById("BaLL_No7").className = "No_" + t_No[7];
                    document.getElementById("BaLL_No8").className = "No_" + t_No[8];
                    if (PLAY_Sound1_Off == false) document.getElementById("PLAY_Sound1").innerHTML = "<EMBED SRC='../User/images/clarion.swf' LOOP=false AUTOSTART=false MASTERSOUND HIDDEN=true WIDTH=0 HEIGHT=0></EMBED>";
                    PLAY_Sound1_Off = false;
                    Move_BR();
                }
                document.getElementById("BeginResult").style.display = "block";
            }
        }
    }
}

function Move_BR() {
    if (Number($(window).width()) > 1200) {
        $("#BeginResult").css({ 'top': 5, 'left': (((document.body.clientWidth - 319) / 2) + 50) });
    } else {
        $("#BeginResult").css({ 'top': 27, 'left': ((document.body.clientWidth - 319) / 2) });
    }
}

//加载RunResult
function Load_RunResult(t_Text) {
    if (t_Text.length >= 3) {
        var RR_Array = new String(t_Text).split(",");
        var RR_Html = "<table width='120' border='0' cellpadding='0' cellspacing='0' class='t_list'><tr><td colspan='2' class='t_list_caption F_bold'>兩面長龍</td></tr>";
        for (var RR_I = 0; RR_I < RR_Array.length; RR_I++) {
            RR_Html += "<tr class='t_list_tr_0'><td class='f_left TDb_B'>";
            switch (Number(RR_Array[RR_I].substr(0, 1))) {
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                    RR_Html += "第" + Number(RR_Array[RR_I].substr(0, 1)) + "球";
                    switch (Number(RR_Array[RR_I].substr(1, 1))) {
                        case 1:
                            RR_Html += " - 大";
                            break;
                        case 2:
                            RR_Html += " - 小";
                            break;
                        case 3:
                            RR_Html += " - 單";
                            break;
                        case 4:
                            RR_Html += " - 雙";
                            break;
                        case 5:
                            RR_Html += " - 尾大";
                            break;
                        case 6:
                            RR_Html += " - 尾小";
                            break;
                        case 7:
                            RR_Html += " - 合單";
                            break;
                        case 8:
                            RR_Html += " - 合雙";
                            break;
                    }
                    break;
                case 9:
                    switch (Number(RR_Array[RR_I].substr(1, 1))) {
                        case 1:
                            RR_Html += "總和大";
                            break;
                        case 2:
                            RR_Html += "總和小";
                            break;
                        case 3:
                            RR_Html += "總和單";
                            break;
                        case 4:
                            RR_Html += "總和雙";
                            break;
                        case 5:
                            RR_Html += "總和尾大";
                            break;
                        case 6:
                            RR_Html += "總和尾小";
                            break;
                        case 7:
                            RR_Html += "龍";
                            break;
                        case 8:
                            RR_Html += "虎";
                            break;
                    }
                    break;
            }
            RR_Html += "</td><td class='TDb_R'>" + RR_Array[RR_I].substr(2) + " 期</td></tr>";
        }
        RR_Html += "</table>";
        document.getElementById("RR_DIV").innerHTML = RR_Html;
        RR_Html = "";
    }
}

//加载AutoFill
function Load_AutoFill(pnode) {
    var l = pnode.childNodes.length;

    for (var i = 0; i < l; i++) {
        if (pnode.childNodes[i].nodeType == 3) {
            continue;
        }
        var node = pnode.childNodes[i];

        var t_Str = node.tagName;
        var gID = Number(t_Str.substr(2));
        AF_Array[gID] = new String(get_xml_text(node)).split(",");
    }
}

//加载Work_Info 操盘用信息
function Load_Work(pnode) {
    var l = pnode.childNodes.length;

    for (var i = 0; i < l; i++) {
        if (pnode.childNodes[i].nodeType == 3) {
            continue;
        }
        var node = pnode.childNodes[i];

        var t_Str = node.tagName;
        var gID = Number(t_Str.substr(2));
        Work_Array[gID] = new String(get_xml_text(node)).split(",");
    }
}

var HF_Group_Count = 0;
function Load_Group_MX(pnode) {
    var l = pnode.childNodes.length;
    var t_ShowTitle = document.getElementById("ShowTitle").innerHTML;
    var MX_Table = "";
    var MX_gID = Number(Base_Array[Group_MX_selID][1])

    MX_Table = "<table width='750' border='0' cellpadding='0' cellspacing='0' class='t_list'>";
    MX_Table += "<tr>";
    MX_Table += "<td colspan='8' class='t_list_caption'>『 <span class='F_bold Font_R'>" + Base_Array[Group_MX_selID][0] + "</span> 』按單組统计排行</td";
    MX_Table += "</tr>";
    MX_Table += "<tr class='t_list_tr_1'>";
    MX_Table += "<td>排名</td>";
    MX_Table += "<td>組閤</td>";
    MX_Table += "<td>下註額</td>";
    if (document.getElementById('money_XZ').value == "1" && document.getElementById('OpenCheck').value == "A" && Pop_F != 0) {
        MX_Table += "<td width='80'>快補金額</td>";
        MX_Table += "<td width='9%'>快補結果</td>";
    }
    MX_Table += "<td>退水</td>";
    MX_Table += "<td>派彩额</td>";
    if (document.getElementById('money_XZ').value == "1" && document.getElementById('OpenCheck').value == "A" && Pop_F != 0) MX_Table += "<td width='40'>單補</td>";
    MX_Table += "</tr>";

    HF_Group_Count = 0;
    var HF_Txt = -1;
    if (document.getElementById("HF_Txt").value != "") HF_Txt = Number(document.getElementById("HF_Txt").value);
    for (var i = 0; i < l; i++) {
        if (pnode.childNodes[i].nodeType == 3) {
            continue;
        }
        var node = pnode.childNodes[i];

        var t_Str = node.tagName;
        var t_ID = Number(t_Str.substr(2)) + 1;
        var t_Array = new String(get_xml_text(node)).split(",");
        var time_Array_0 = t_Array[0];

        MX_Table += "<tr class='t_list_tr_0' onMouseOver=this.style.backgroundColor='#FFFFA2' onMouseOut=this.style.backgroundColor=''>";
        MX_Table += "<td height='24'>" + t_ID + "</td>";
        MX_Table += "<td>" + t_Array[0].replace(/[.]/g, "、") + "</td>";
        MX_Table += "<td class='font_g' ID='HF_" + i + "' NoS='" + time_Array_0.replace(/[.]/g, ",") + "'>" + t_Array[1] + "</td>";

        var HF_JYBH = 0;
        if (HF_Txt > -1) {//需要計算補貨
            if (Number(t_Array[1]) >= HF_Txt) HF_JYBH = Number(t_Array[1]) - HF_Txt;
        }
        if (HF_JYBH == 0 || HF_JYBH < 10) HF_JYBH = "";

        if (document.getElementById('money_XZ').value == "1" && document.getElementById('OpenCheck').value == "A" && Pop_F != 0) {
            MX_Table += "<td><input class='inp1' maxlength='10' name='HF_M" + i + "'  id='HF_M" + i + "' onblur=this.className='inp1' onfocus=this.className='inp1a' onkeydown='digitOnly_HF(event)' size='8' type='text' value='" + HF_JYBH + "'></td>";
            MX_Table += "<td id='HF_T" + i + "'></td>";
        }
        MX_Table += "<td>" + t_Array[2] + "</td>";

        MX_Table += "<td class='Font_R'>" + t_Array[3] + "</td>";
        if (document.getElementById('money_XZ').value == "1" && document.getElementById('OpenCheck').value == "A" && Pop_F != 0) MX_Table += "<td><a title='補單' href='javascript:void(0)' onclick=open_FILLjeu(" + Group_MX_selID + ",'" + t_Array[0] + "'," + t_Array[1] + ",event) onFocus='this.blur()' class='Font_g'><img src='images/bnt_Fill.gif'></a></td>";
        MX_Table += "</tr>";
        HF_Group_Count = i;
    }

    MX_Table += "</table>";
    t_ShowTitle = "";

    if (Pop_F != 2) $("#HF_BC").attr("disabled", true);
    if (document.getElementById('money_XZ').value == "1" && document.getElementById('OpenCheck').value == "A" && Pop_F != 0) document.getElementById("HF_table").style.display = "block";
    document.getElementById("MX_List").innerHTML = MX_Table;
}

function Load_Base(pnode) {
    var l = pnode.childNodes.length;

    for (var i = 0; i < l; i++) {
        if (pnode.childNodes[i].nodeType == 3) {
            continue;
        }
        var node = pnode.childNodes[i];

        var t_Str = node.tagName;
        var mID = Number(t_Str.substr(2));

        Base_Array[mID] = new String(get_xml_text(node)).split(",");

        var gID = Number(Base_Array[mID][1]);
        var gID_sID = Number(Base_Array[mID][2]);

        G_Sum_Array[gID_sID][gID] = new Array(0, 0, 0, 0);
        M_Sum_Array[mID] = new Array(0, 0, 0, 0);
    }
}

function Clear_G_Sum() {
    var t_Array = new String(t_GT).split(",");
    for (var i = 0; i < t_Array.length; i++) {
        var sID_length = 0;
        switch (parseInt(t_Array[i])) {
            case 9: //1-8
            case 10:
            case 11:
            case 12:
            case 13:
            case 14:
                sID_length = 7;
                break;
        }
        for (var sID = 0; sID <= sID_length; sID++) {
            G_Sum_Array[sID][parseInt(t_Array[i])] = new Array(0, 0, 0, 0);
            try {
                if (sID != 0) {//子类拆分统计
                    var max_Index = "_" + gID_sID;
                } else {
                    var max_Index = "";
                }
                document.getElementById("maxFZ_" + t_Array[i] + max_Index).innerHTML = 0;
                document.getElementById("maxZZ_" + t_Array[i] + max_Index).innerHTML = 0;
            } catch (e) { }
        }
    }
}

function Load_M_Sum(pnode) {
    var l = pnode.childNodes.length;

    for (var i = 0; i < l; i++) {
        if (pnode.childNodes[i].nodeType == 3) {
            continue;
        }
        var node = pnode.childNodes[i];

        var t_Str = node.tagName;
        var mID = Number(t_Str.substr(2));
        var gID = Number(Base_Array[mID][1]);
        var gID_sID = Number(Base_Array[mID][2]);

        var t_Array = new String(get_xml_text(node)).split(",");
        for (var Ai = 0; Ai < t_Array.length; Ai++) {
            M_Sum_Array[mID][Ai] = t_Array[Ai];
            G_Sum_Array[gID_sID][gID][Ai] = Number(G_Sum_Array[gID_sID][gID][Ai]) + Number(t_Array[Ai]);
        }

        //总註额
        try {
            //显示笔数
            if (gID_sID != 0) {//子类拆分统计
                var max_Index = "_" + gID_sID;
            } else {
                var max_Index = "";
            }
            if (document.getElementById("showCount").checked == true) {
                if (Read_G_Sum(gID_sID, gID, 0) > 0) {
                    document.getElementById("sumXZ_" + gID + max_Index).innerHTML = Read_G_Sum(gID_sID, gID, 0) + "/" + ForDight(Read_G_Sum(gID_sID, gID, 1), 0);
                } else {
                    document.getElementById("sumXZ_" + gID + max_Index).innerHTML = "0";
                }
            } else {
                document.getElementById("sumXZ_" + gID + max_Index).innerHTML = ForDight(Read_G_Sum(gID_sID, gID, 1), 0);
            }
        } catch (e) { }
    }
}

function Sel_mTR(mID) {
    switch (Number(Base_Array[mID][1])) {
        //        case 1 : 
        //        case 2 : 
        //        case 3 : 
        //        case 4 : 
        //        case 5 : 
        //        case 6 : 
        //        case 7 : 
        //        case 8 ://号码类 
        case 81:
        case 86:
        case 91:
        case 96:
        case 101:
        case 106:
        case 111:
        case 116:
            return "mnRT_" + (mID - (inceptMID - 1));
            break;
        case 82: //大小 case 9:
        case 87:
        case 92:
        case 97:
        case 102:
        case 107:
        case 112:
        case 117:
        case 83: //单双 case 10
        case 88:
        case 93:
        case 98:
        case 103:
        case 108:
        case 113:
        case 118:
        case 84: //尾数大小  case 11
        case 89:
        case 94:
        case 99:
        case 104:
        case 109:
        case 114:
        case 119:
        case 85: //合数单双  case 12
        case 90:
        case 95:
        case 100:
        case 105:
        case 110:
        case 115:
        case 120:
            return "mnRT_" + (mID - (t_ST * 28));
            break;
        case 121: //方位 case 13
        case 123:
        case 125:
        case 127:
        case 129:
        case 131:
        case 133:
        case 135:
            return "mnRT_" + (mID - (t_ST * 4));
            break;
        case 122: //中发白 case 14   1-8
        case 124:
        case 126:
        case 128:
        case 130:
        case 132:
        case 134:
        case 136:
            return "mnRT_" + (mID - (t_ST * 3));
            break;
        default: //其它类
            return "mRT_" + mID;
            break;
    }
}

//加载赔率
function Load_M_Jeu(pnode) {
    var l = pnode.childNodes.length;

    //清理排序数组
    Taxis_Array = new Array();
    Taxis_Load = 0;

    var MC_mXZ = document.getElementById("money_XZ").value;

    for (var i = 0; i < l; i++) {
        if (pnode.childNodes[i].nodeType == 3) {
            continue;
        }
        var node = pnode.childNodes[i];
        var t_Str = node.tagName;
        var mID = Number(t_Str.substr(2));

        var t_Str = new String(get_xml_text(node)).split(",");


        var gID = Number(Base_Array[mID][1]);
        var gID_sID = Number(Base_Array[mID][2]);

        if (Read_G_Sum(gID_sID, gID, 0) > 0) {
            var jBW_Result = Read_G_Sum(gID_sID, gID, 1) - Read_G_Sum(gID_sID, gID, 3) - Read_M_Sum(mID, 2) - Read_M_Sum(mID, 1);
        } else {
            var jBW_Result = 0;
        }

        if (jBW_Result < 0) {
            var jBW_Color = "Font_r";
        } else {
            var jBW_Color = "";
        }

        //显示笔数
        if (document.getElementById("showCount").checked == true) {
            if (Read_M_Sum(mID, 0) > 0) {
                var jXZcount_Result = Read_M_Sum(mID, 0) + "/" + ForDight(Read_M_Sum(mID, 1), 0);
            } else {
                var jXZcount_Result = "-";
            }
        } else {
            var jXZcount_Result = toCipher(ForDight(Read_M_Sum(mID, 1), 0));
        }

        var t_innerHTML = "";


        switch (gID) {
            //	      case 19 ://连码类  
            //	      case 20 :  
            //	      case 21 :  
            //	      case 22 :  
            //	      case 23 :  
            //	      case 24 :  
            //	      case 25 :  
            //	      case 26 :  
            case 70: //连码类
            case 71:
            case 72:
            case 73:
            case 74:
            case 75:
            case 76:
            case 77:
            case 78:
            case 79:
                if (Pop_AM != 0) {
                    t_innerHTML = "<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0'>";
                    t_innerHTML += "  <tr>";
                    t_innerHTML += "    <td width='3%'><a title='上調賠率' href='javascript:void(0)' onclick=Admin_Work('m','" + mID + "','aP','') onFocus='this.blur()'><img src='images/m_Add.gif'></a></td>";
                    t_innerHTML += "    <td width='94%' align='center'><a title='設定賠率' href='javascript:void(0)' onclick=open_M_Adjust('" + mID + "','') onFocus='this.blur()'><span ID='jP_" + mID + "' class='F_Multiple'>" + t_Str[1] + "</span></a></td>";
                    t_innerHTML += "    <td width='3%'><a title='下調賠率' href='javascript:void(0)' onclick=Admin_Work('m','" + mID + "','mP','') onFocus='this.blur()'><img src='images/m_Minus.gif'></a></td>";
                    t_innerHTML += "  </tr>";
                    t_innerHTML += "</table>";
                } else {
                    t_innerHTML = "<span ID='jP_" + mID + "' class='F_Multiple'>" + t_Str[1] + "</span>";
                }

                document.getElementById("jeu_n_" + mID).innerHTML = t_innerHTML;
                document.getElementById("jeu_m_" + mID).innerHTML = "<a title='查看註單明細' href='javascript:void(0)' onclick='Show_JeuMX(" + mID + ");' onFocus='this.blur()'><span ID='jM_" + mID + "' class='font_g'>" + jXZcount_Result + "</span></a>";
                document.getElementById("jeu_s_" + mID).innerHTML = "<a title='補單' href='javascript:void(0)' onclick=open_FILLjeu(" + mID + ",'','',event) onFocus='this.blur()'><span>" + toCipher(ForDight(Read_M_Sum(mID, 3), 0)) + "</span></a>";
                if (t_Str[0] == "1") {//开盘
                    document.getElementById("jeu_t_" + mID).className = "Jeu_Oname";
                    document.getElementById("jeu_n_" + mID).className = "Jeu_O";
                    document.getElementById("jeu_m_" + mID).className = "Jeu_O";
                    document.getElementById("jeu_s_" + mID).className = "Jeu_O";
                } else {//封盘
                    document.getElementById("jeu_t_" + mID).className = "Jeu_C";
                    document.getElementById("jeu_n_" + mID).className = "Jeu_C";
                    document.getElementById("jeu_m_" + mID).className = "Jeu_C";
                    document.getElementById("jeu_s_" + mID).className = "Jeu_C";
                }

                if (Pop_AM == 1) {
                    document.getElementById("jeu_t_" + mID).innerHTML = "<a title='開盤/封盤' href='javascript:void(0)' onclick=Admin_Work('m','" + mID + "','aO','') onFocus='this.blur()'><span class='F_bold" + jT_Color + "'>" + Base_Array[mID][0] + "</span></a>";
                } else {
                    document.getElementById("jeu_t_" + mID).innerHTML = "<span class='F_bold" + jT_Color + "'>" + Base_Array[mID][0] + "</span>";
                }
                break;
            default: //其它类型
                var mRT = document.getElementById(Sel_mTR(mID));
                if (Mouse_Affair == false) {
                    mRT.onmouseover = function () { this.style.backgroundColor = '#FFFFA2' }
                    mRT.onmouseout = function () { this.style.backgroundColor = '' }
                }

                var mRT_P = 1; //賠率
                var mRT_M = 2; //註額
                var mRT_W = 3; //亏赢
                if (Pop_AM != 0) {
                    t_innerHTML = "<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0'>";
                    t_innerHTML += "  <tr>";
                    t_innerHTML += "    <td height='30%' width='3%'><a title='上調賠率' href='javascript:void(0)' onclick=Admin_Work('m','" + mID + "','aP','') onFocus='this.blur()'><img src='images/m_Add.gif' width='19' height='20'></a></td>";
                    t_innerHTML += "    <td width='94%' align='center'><a title='設定賠率' href='javascript:void(0)' onclick=open_M_Adjust('" + mID + "','') onFocus='this.blur()'><span ID='jP_" + mID + "' class='F_Multiple'>" + t_Str[1] + "</span></a></td>";
                    t_innerHTML += "    <td width='3%'><a title='下調賠率' href='javascript:void(0)' onclick=Admin_Work('m','" + mID + "','mP','') onFocus='this.blur()'><img src='images/m_Minus.gif' width='19' height='20'></a></td>";
                    t_innerHTML += "  </tr>";
                    t_innerHTML += "</table>";
                } else {
                    //                      计算平均赔率 退水
                    //			            if (Number(Read_M_Sum(mID,1))==0){
                    //			                t_innerHTML= "";
                    //			            } else {
                    //			                t_innerHTML= "<span ID='jP_" + mID + "' class='F_Multiple'>" + ForDight((Number(Read_M_Sum(mID,2)) / Number(Read_M_Sum(mID,1))) + 1,4)  + "</span>　" + ForDight((Number(Read_M_Sum(mID,3)) / Number(Read_M_Sum(mID,1))* 100),4);
                    //			            }
                    t_innerHTML = "<span ID='jP_" + mID + "' class='F_Multiple'>" + t_Str[1] + "</span>";
                }
                mRT.cells[mRT_P].innerHTML = t_innerHTML;
                t_innerHTML = "";
                mRT.cells[mRT_M].innerHTML = "<a title='查看註單明細' href='javascript:void(0)' onclick='Show_JeuMX(" + mID + ");' onFocus='this.blur()'><span ID='jM_" + mID + "' class='font_g'>" + jXZcount_Result + "</span></a>";
                if (MC_mXZ == "1" && Pop_F != 0) {//占成
                    mRT.cells[mRT_W].innerHTML = "<a title='補單' href='javascript:void(0)' onclick=open_FILLjeu(" + mID + ",'','',event) onFocus='this.blur()'><span ID='jBW_" + mID + "' class='" + jBW_Color + "'>" + toCipher(ForDight(jBW_Result, 0)) + "</span></a>";
                    if (jBW_Result < 0) {
                        if (t_BalanceValue > jBW_Result) {//需补
                            if (Pop_F == 1) {
                                var Fill_M = ForDight((-(jBW_Result - t_BalanceValue)) / ((t_Account_PL - 1) + (1 - (t_Account_TS / 100))), 0);
                                if (Fill_M > 0) {
                                    mRT.cells[mRT_M].innerHTML += "&nbsp;<span id='fill_" + mID + "' class='Font_fill'>" + Fill_M + "</span>";
                                }
                            } else {
                                var Fill_M = ForDight((-(jBW_Result - t_BalanceValue)) / ((Number(t_Str[1]) - 1) + (1 - (Number(AF_Array[gID][2]) / 100))), 0);
                                if (Fill_M > 0) {
                                    mRT.cells[mRT_M].innerHTML += "&nbsp;<span id='fill_" + mID + "' class='Font_fill'>" + Fill_M + "</span>";
                                }
                            }
                        }
                    }
                } else {
                    mRT.cells[mRT_W].innerHTML = "<span ID='jBW_" + mID + "' class='" + jBW_Color + "'>" + toCipher(ForDight(jBW_Result, 0)) + "</span></a>";
                }

                if (t_Str[0] == "1") {//开盘
                    mRT.className = "Jeu_O";
                    mRT.cells[0].className = "Jeu_Oname";
                } else {//封盘
                    mRT.className = "Jeu_C";
                    mRT.cells[0].className = "Jeu_C";
                }
                var t_ShowTitle = document.getElementById("ShowTitle").innerHTML;
                if (t_ShowTitle != "連碼") {
                    if (MC_mXZ == "1") {//實貨需提示
                        if (Pop_F == 1) {
                            var t_MaxClew = Number("-" + Work_Array[gID][2]);
                            if (t_MaxClew < 0 && jBW_Result < 0) { //有設置最大負值提示
                                if (t_MaxClew > jBW_Result) {
                                    mRT.cells[mRT_W].className = "mMC";
                                } else {
                                    mRT.cells[mRT_W].className = "";
                                }
                            } else {
                                mRT.cells[mRT_W].className = "";
                            }
                        } else if (Pop_F == 2) {
                            if (Number(AF_Array[gID][1]) != -1 && gID != 19 && gID != 20 && gID != 21 && gID != 22 && gID != 23 && gID != 24 && gID != 25 && gID != 26) {//有設置補貨
                                if (Number(AF_Array[gID][0]) == 0) {
                                    var t_MaxClew = Number(AF_Array[gID][1]);
                                    if (Number(Read_M_Sum(mID, 1)) != 0) {
                                        if (t_MaxClew <= Number(Read_M_Sum(mID, 1))) {
                                            mRT.cells[mRT_W].className = "mMC";
                                        } else {
                                            mRT.cells[mRT_W].className = "";
                                        }
                                    } else {
                                        mRT.cells[mRT_W].className = "";
                                    }
                                } else {
                                    var t_MaxClew = Number("-" + AF_Array[gID][1]);
                                    if (t_MaxClew < 0 && jBW_Result < 0) { //有設置最大負值提示
                                        if (jBW_Result != 0) {
                                            if (t_MaxClew >= jBW_Result) {
                                                mRT.cells[mRT_W].className = "mMC";
                                            } else {
                                                mRT.cells[mRT_W].className = "";
                                            }
                                        } else {
                                            mRT.cells[mRT_W].className = "";
                                        }
                                    } else {
                                        mRT.cells[mRT_W].className = "";
                                    }
                                }
                            }
                        }
                    }
                }
                var jT_Color = "";
                switch (gID) {
                    //                    case 1: //号码类 有波色 
                    //                    case 2: 
                    //                    case 3: 
                    //                    case 4: 
                    //                    case 5: 
                    //                    case 6: 
                    //                    case 7: 
                    //                    case 8: 
                    case 81:
                    case 86:
                    case 91:
                    case 96:
                    case 101:
                    case 106:
                    case 111:
                    case 116:
                        jT_Color = " FS_ball Font_" + No_Color[Number(Base_Array[mID][0])];
                        break;
                }

                if (Pop_AM == 1) {
                    //开关盘
                    mRT.cells[0].innerHTML = "<a title='開盤/封盤' href='javascript:void(0)' onclick=Admin_Work('m','" + mID + "','aO','') onFocus='this.blur()'><span class='F_bold" + jT_Color + "'>" + Base_Array[mID][0] + "</span></a>";
                } else {
                    mRT.cells[0].innerHTML = "<span class='F_bold" + jT_Color + "'>" + Base_Array[mID][0] + "</span>";
                }

                //max负值
                try {
                    //单号中奖,不是正码
                    if (gID_sID != 0) {//子类拆分统计
                        var max_Index = "_" + gID_sID;
                    } else {
                        var max_Index = "";
                    }
                    if (jBW_Result < Number(document.getElementById("maxFZ_" + gID + max_Index).innerHTML)) {
                        document.getElementById("maxFZ_" + gID + max_Index).innerHTML = ForDight(jBW_Result, 0);
                    }
                    if (jBW_Result > Number(document.getElementById("maxZZ_" + gID + max_Index).innerHTML)) {
                        document.getElementById("maxZZ_" + gID + max_Index).innerHTML = ForDight(jBW_Result, 0);
                    }
                } catch (e) { }

                //加载排序数组
                switch (gID) {
                    //                    case 1:  
                    //                    case 2: 
                    //                    case 3: 
                    //                    case 4: 
                    //                    case 5: 
                    //                    case 6: 
                    //                    case 7: 
                    //                    case 8://號碼類 
                    case 81:
                    case 86:
                    case 91:
                    case 96:
                    case 101:
                    case 106:
                    case 111:
                    case 116:
                        Taxis_Load = 1;
                        var TA_index = (Number(Base_Array[mID][0]) - 1);
                        //加载no对应ID
                        NoID_Array[Number(Base_Array[mID][0])] = mID
                        Taxis_Array[TA_index] = new Array(mID, jBW_Result);
                        break;
                }
                mRT = null;
                break;
        }
    }
    //加载排序数组
    Load_Taxis_Array();

    if (document.getElementById('AutoUpdate').value != "") {//自动更新
        t_Update_Time = Number(document.getElementById('AutoUpdate').value);
        document.getElementById("Update_Show").className = '';
        document.getElementById("Update_Show").innerHTML = "更新：" + t_Update_Time + "&nbsp;秒";
        ud_Timer = setTimeout("UpdateTime()", 1000);
    } else {//手动更新
        document.getElementById("Update_Show").className = '';
        document.getElementById("Update_Show").innerHTML = "<button class='btn_1' name='LoadingXML' id='LoadingXML' type='button' value='更新' onClick='LoadXml();' onFocus='this.blur()'>更新</button>";
    }
}

//加載其它項目投註總額
function Load_AE_M(pnode) {
    var l = pnode.childNodes.length;
    document.getElementById("sumXZ_All").innerHTML = 0;
    for (var i = 0; i < l; i++) {
        if (pnode.childNodes[i].nodeType == 3) {
            continue;
        }
        var node = pnode.childNodes[i];
        document.getElementById("sumXZz_" + node.tagName.substr(2)).innerHTML = get_xml_text(node);
        document.getElementById("sumXZ_All").innerHTML = Number(document.getElementById("sumXZ_All").innerHTML) + Number(get_xml_text(node));
    }
}

//排序
function generateCompareTrs() {
    return function compareItem(arrTr_item1, arrTr_item2) {
        var value1 = Number(arrTr_item1.jBW_taxis);
        var value2 = Number(arrTr_item2.jBW_taxis);
        if (value1 < value2)
            return -1;
        else if (value1 > value2)
            return 1;
        else
            return 0;
    }
}

//0 转换为 -
function toCipher(t_Value) {
    if (Number(t_Value) != 0) {
        return t_Value;
    } else {
        return "-";
    }
}

function Read_G_Sum(gID_sID, gID, Index) {
    try {
        return Number(G_Sum_Array[gID_sID][gID][Index]);

    } catch (e) {
        return 0;
    }
}

function Read_M_Sum(mID, Index) {
    try {
        return Number(M_Sum_Array[mID][Index]);
    } catch (e) {
        return 0;
    }
}

//Read Work_Info
function Read_Work(t_ID, t_index) {
    try {
        return Number(Work_Array[Number(Base_Array[t_ID][1])][Number(t_index)]);
    } catch (e) {
        return 0;
    }
}

var indexCol = 1; //排序位置
//升序
function arrayCompareNumberRev(array1, array2) {
    if (parseInt(array1[indexCol]) < parseInt(array2[indexCol])) return 1;
    if (parseInt(array1[indexCol]) > parseInt(array2[indexCol])) return -1;

    return 0;
}
//降序
function arrayCompareNumber(array1, array2) {
    if (parseInt(array1[indexCol]) < parseInt(array2[indexCol])) return -1;
    if (parseInt(array1[indexCol]) > parseInt(array2[indexCol])) return 1;

    return 0;
}
//手工调整加载排序数组（更改Taxis_Desc）
function Amend_Taxis_Desc() {
    if (Taxis_Desc == 0) {
        Taxis_Desc = 1;
        document.getElementById("taxis_button").innerHTML = "按“虧損”額排列";
        document.getElementById("taxis_button").className = "Font_R F_bold";
    } else {
        Taxis_Desc = 0;
        document.getElementById("taxis_button").innerHTML = "按“盈利”額排列";
        document.getElementById("taxis_button").className = "F_bold";
    }
    Load_Taxis_Array();
}
//加载排序数组
function Load_Taxis_Array() {
    if (Taxis_Load == 1) {
        if (Taxis_Desc == 0) {
            Taxis_Array.sort(arrayCompareNumberRev);
        } else {
            Taxis_Array.sort(arrayCompareNumber);
        }
        Taxis_ID_Array = new Array(); //清除排序对应位置ID
        var Taxis_Count = 20;
        for (var i = 0; i < Taxis_Count; i++) {
            var mRT = document.getElementById(Sel_mTR(Taxis_Array[i][0]));
            var tRT = document.getElementById("taxis_" + (i + 1));
            if (Mouse_Affair == false) {
                if (document.getElementById("NoTable").value == "1") {
                    tRT.onmouseover = function () { this.style.backgroundColor = '#FFFFA2' }
                    tRT.onmouseout = function () { this.style.backgroundColor = '' }
                } else if (document.getElementById("NoTable").value == "2") {
                    tRT.style.backgroundColor = '#FFFFA2';
                    tRT.onmouseover = function () { this.style.backgroundColor = '' }
                    tRT.onmouseout = function () { this.style.backgroundColor = '#FFFFA2' }
                }
            }

            tRT.className = mRT.className;

            tRT.cells[0].className = mRT.cells[0].className;
            tRT.cells[0].innerHTML = mRT.cells[0].innerHTML;
            tRT.cells[1].innerHTML = mRT.cells[1].innerHTML;
            tRT.cells[2].innerHTML = mRT.cells[2].innerHTML;
            tRT.cells[3].innerHTML = mRT.cells[3].innerHTML;
            tRT.cells[3].className = mRT.cells[3].className;

            Taxis_ID_Array[Number(Taxis_Array[i][0])] = i + 1; //保存位置对应ID

            mRT = null;
            tRT = null;
        }
        return true;
    }
}

//显示註单明细
function Show_JeuMX(mID, mID2, mID3) {
    var t_FactSize = "";
    //t_FactSize="&FactSize=my"
    if (mID2 != null && mID2 != 0) {
        var winMX = window.open("RT_MX_c.aspx?t_LID=" + t_LID + "&mID=" + mID + "&AOmID=" + mID2 + "&AIc=1&UP_ID=my&AVID=0" + t_FactSize, "enquiry", 'width=' + screen.width + ',height=' + screen.height + ',top=0,left=0,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no')
    } else if (mID3 != null) {
        var winMX = window.open("RT_MX_c.aspx?t_LID=" + t_LID + "&lxID=" + mID3 + "&AOmID=" + mID2 + "&AIc=1&UP_ID=my&AVID=0" + t_FactSize, "enquiry", 'width=' + screen.width + ',height=' + screen.height + ',top=0,left=0,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no')
    } else {
        var winMX = window.open("RT_MX_c.aspx?t_LID=" + t_LID + "&mID=" + mID + "&AIc=1&UP_ID=my&AVID=0" + t_FactSize, "enquiry", 'width=' + screen.width + ',height=' + screen.height + ',top=0,left=0,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no,toolbar=no')
    }
}

//计算补货============================
function accountFILL() {
    if (document.getElementById("BalanceValue").value == "") {
        alert("請輸入“平衡负值”！");
        document.getElementById("BalanceValue").focus();
        return false;
    }

    t_BalanceValue = Number(document.getElementById("BalanceValue").value);

    SetCookie("BV_" + t_GT.replace(/\,/g, "_"), t_BalanceValue);

    LoadXml();
}

function digitOnly_HF(evt) {
    evt = evt || window.event;
    var code = parseInt(evt.keyCode);
    if (code >= 96 && code <= 105 || code >= 48 && code <= 57 || code == 8 || code == 110 || code == 190 || code == 46) {
        return true;
    }
    else {
        if (evt && evt.preventDefault)
            evt.preventDefault(); //阻止默认浏览器动作(W3C)
        else
            window.event.returnValue = false; //IE中阻止函数器默认动作的方式 
        return false;
    }
}

function digitfOnly(evt) {
    evt = evt || window.event;
    var code = parseInt(evt.keyCode);
    if (code == 13) { //確定修改
        if (FILLjeu_window.style.display == "block") {
            close_FILLjeu(1);
        } else if (ShortcutFILL.style.display == "block") {
            close_ShortcutFILL(1);
        }
        return false;
    }

    if (code >= 96 && code <= 105 || code >= 48 && code <= 57 || code == 8 || code == 110 || code == 190 || code == 46) {
        return true;
    }
    else {
        if (evt && evt.preventDefault)
            evt.preventDefault(); //阻止默认浏览器动作(W3C)
        else
            window.event.returnValue = false; //IE中阻止函数器默认动作的方式 
        return false;
    }
}

//補單窗口
function open_FILLjeu(m_ID, gMX, jeu_Max, e) {

    e = e || window.event;
    $("#FILLjeu_window").css({ 'top': (e.clientY + 10 + document.documentElement.scrollTop), 'left': (e.clientX - 65) });
    //FILLjeu_window.style.left = event.clientX - 80;
    document.getElementById("FILLjeu_mID").value = m_ID;
    var Jeu_Open = false;

    switch (Number(Base_Array[m_ID][1])) {
        case 70: //连码类
        case 71:
        case 72:
        case 73:
        case 74:
        case 75:
        case 76:
        case 77:
        case 78:
        case 79:
            document.getElementById("Jeu_MT").innerHTML = document.getElementById("jeu_t_" + m_ID).innerHTML;
            if (document.getElementById("jeu_m_" + m_ID).className == "Jeu_O") Jeu_Open = true;
            break;
        default: //新糢式
            document.getElementById("Jeu_MT").innerHTML = document.getElementById(Sel_mTR(m_ID)).cells[0].innerHTML;
            if (document.getElementById(Sel_mTR(m_ID)).className == "Jeu_O") Jeu_Open = true;
            break;
    }
    document.getElementById("FILLjeu_PL").innerHTML = document.getElementById("jP_" + m_ID).innerHTML;
    if (m_ID >= 329 && m_ID <= 1203) {//連碼 補貨
        document.getElementById("Jeu_Gno").innerHTML = "&nbsp;" + gMX.replace(/[.]/g, "、");
        document.getElementById("FILLJeu_Gno").value = gMX.replace(/[.]/g, ",");
        document.getElementById("FILLjeu_Max").innerHTML = ForDight(jeu_Max, 0);
    } else {
        document.getElementById("FILLjeu_Max").innerHTML = ForDight(Read_M_Sum(m_ID, 1), 0);
    }

    //FILLjeu_window.style.top = event.clientY + 12 + document.body.scrollTop;


    document.getElementById("FILLjeu_XZ").value = "";
    try { document.getElementById("FILLjeu_XZ").value = document.getElementById("fill_" + m_ID).innerHTML } catch (e) { }
    //FILLjeu_window.style.display="block";
    document.getElementById("FILLjeu_window").style.display = "block";
    if (Jeu_Open == true) {//開盤中
        $("#FILLjeu_XZ").attr("disabled", false)
        $("#FJ_confirm").attr("disabled", false)
        document.getElementById("FILLjeu_XZ").focus();
    } else {//封盤
        $("#FILLjeu_XZ").attr("disabled", true)
        $("#FJ_confirm").attr("disabled", true)
    }



}

function close_FILLjeu(t_confirm) {
    if (t_confirm == 1) {//确定
        var m_ID = document.getElementById("FILLjeu_mID").value, uPI_P = document.getElementById("FILLjeu_PL").innerHTML;

        if (document.getElementById("FILLjeu_XZ").value == "") {
            alert("請輸入“補貨金額”！");
            document.getElementById("FILLjeu_XZ").focus();
            return false;
        }
        if (Number(document.getElementById("FILLjeu_XZ").value) < 10) {
            alert("“補貨金額”最低不可少于10元，請脩改！");
            document.getElementById("FILLjeu_XZ").focus();
            return false;
        }
        if (Math.abs(Number(document.getElementById("FILLjeu_XZ").value)) > Number(document.getElementById("FILLjeu_Max").innerHTML)) {
            alert("“補貨金額”超過“最高可補金額”，請脩改！");
            document.getElementById("FILLjeu_XZ").focus();
            return false;
        }

        if (!confirm("是否確定補出?")) {
            return false;
        }

        Send_FillJeu(document.getElementById("FILLjeu_mID").value, uPI_P, Math.abs(document.getElementById("FILLjeu_XZ").value), document.getElementById("FILLJeu_Gno").value, 0);
        //LoadXml();
        //window.location.reload();
        //LoadXml();
        //document.all["FILLjeu_window"].style.display="none";
        document.getElementById("FILLjeu_window").style.display = "none";
    } else { //取消
        //document.all["FILLjeu_window"].style.display="none";
        document.getElementById("FILLjeu_window").style.display = "none";
    }
}

function open_ShortcutFILL() {
    for (nI = 1; nI <= 20; nI++) {
        var mID = (nI - 1) + inceptMID;
        var t_fill_M = "";
        document.getElementById("f_P" + nI).innerHTML = document.getElementById("jP_" + mID).innerHTML;
        document.getElementById("f_P" + nI).className = "t_Edit_td F_Multiple";

        if (document.getElementById(Sel_mTR(mID)).className == "Jeu_O") {//開盤中
            try { t_fill_M = document.getElementById("fill_" + mID).innerHTML } catch (e) { }
            document.getElementById("f_M" + nI).innerHTML = "<input name='fillJeu_M" + nI + "' value='" + t_fill_M + "' type='text' size='6' maxlength='9' class='inp1' onFocus=this.className='inp1a' onBlur=this.className='inp1' onkeydown='digitfOnly(event)'>";
        } else {
            document.getElementById("f_M" + nI).innerHTML = "<input name='fillJeu_M" + nI + "' value='' type='text' size='6' maxlength='9' class='inp1' onFocus=this.className='inp1a' onBlur=this.className='inp1' onkeydown='digitfOnly(event)' disabled>";
        }
    }

    //ShortcutFILL.style.left = document.body.scrollLeft + ((document.body.clientWidth-282) / 2);
    //ShortcutFILL.style.top = document.body.scrollTop + ((document.body.clientHeight-300) / 2);
    $("#ShortcutFILL").css({ 'top': document.documentElement.scrollTop + ((document.documentElement.scrollHeight - 300) / 2), 'left': document.documentElement.scrollLeft + ((document.documentElement.scrollWidth - 282) / 2) });

    ShortcutFILL.style.display = "block";
}

function close_ShortcutFILL(t_confirm) {
    if (t_confirm == 1) {//确定
        var uPI_ID = "", uPI_P = "", uPI_M = "";
        for (nI = 1; nI <= 20; nI++) {
            var mID = (nI - 1) + inceptMID;
            if (document.getElementById("fillJeu_M" + nI).value != "") {
                if (document.getElementById(Sel_mTR(mID)).className == "Jeu_O") {//開盤中
                    if (Number(document.getElementById("fillJeu_M" + nI).value) < 10) {
                        alert("號碼【" + nI + "】“補貨金額”最低不可少于10元，請脩改！");
                        document.getElementById("fillJeu_M" + nI).focus();
                        return false;
                    }
                    if (Math.abs(Number(document.getElementById("fillJeu_M" + nI).value)) > ForDight(Read_M_Sum(mID, 1), 0)) {
                        alert("號碼【" + nI + "】“補貨金額”超過“最高可補金額”，請脩改！");
                        document.getElementById("fillJeu_M" + nI).focus();
                        return false;
                    } else {
                        uPI_ID += "," + mID;
                        uPI_P += "," + document.getElementById("f_P" + nI).innerHTML;
                        uPI_M += "," + Math.abs(document.getElementById("fillJeu_M" + nI).value);
                    }
                }
            }
        }
        if (uPI_ID == "") {
            alert("請輸入“補貨金額”！");
            try { document.getElementById("fillJeu_M1").focus() } catch (e) { };
            return false;
        }
        if (!confirm("是否確定補出?")) {
            return false;
        }

        Send_FillJeu(uPI_ID.substr(1), uPI_P.substr(1), uPI_M.substr(1), "", 0);

        ShortcutFILL.style.display = "none";
    } else { //取消
        ShortcutFILL.style.display = "none";
    }
}


var HF_Array = new Array;
var HF_i = -1;
function Send_HF_FILL() {
    HF_i += 1;
    if (HF_i > (HF_Array.length - 1)) {
        alert("“快補完成”請詳細覈對補貨結果！【註：3秒后重新分組統計，補貨結果將消失】");
        t_Update_Time = 3;
    } else {
        var uPI_P = "", uPI_M = "", uPI_NoS = "";
        uPI_P = document.getElementById("jP_" + Group_MX_selID).innerHTML;
        uPI_M = Math.abs(document.getElementById("HF_M" + HF_Array[HF_i]).value);
        uPI_NoS = $("#HF_" + HF_Array[HF_i]).attr("NoS");

        document.getElementById("HF_T" + HF_Array[HF_i]).innerHTML = "快補中…";
        document.getElementById("HF_T" + HF_Array[HF_i]).className = "Font_B F_bold";
        Send_FillJeu(Group_MX_selID, uPI_P, uPI_M, uPI_NoS, 1);
    }
}
function close_HF_FILL() {
    var Jeu_Open = false;
    switch (Number(Base_Array[Group_MX_selID][1])) {
        case 70: //连码类
        case 71:
        case 72:
        case 73:
        case 74:
        case 75:
        case 76:
        case 77:
        case 78:
        case 79:
            if (document.getElementById("jeu_m_" + Group_MX_selID).className == "Jeu_O") Jeu_Open = true;
            break;
        default: //新糢式
            if (document.getElementById(Sel_mTR(Group_MX_selID)).className == "Jeu_O") Jeu_Open = true;
            break;
    }
    if (Jeu_Open || Always_Fill == true) {//開盤中
        var HF_i_Str = "";
        for (nI = 0; nI <= HF_Group_Count; nI++) {
            if (document.getElementById("HF_M" + nI).value != "") {
                if (isNaN(document.getElementById("HF_M" + nI).value) != true) {
                    if (Number(document.getElementById("HF_M" + nI).value) < 10) {
                        alert("“快補金額”最低不可少于10元，請脩改！");
                        document.getElementById("HF_M" + nI).select();
                        document.getElementById("HF_M" + nI).focus();
                        return false;
                    }

                    if (Math.abs(Number(document.getElementById("HF_M" + nI).value)) > ForDight(document.getElementById("HF_" + nI).innerHTML, 0)) {
                        alert("“快補金額”超過“最高可補金額”，請脩改！");
                        document.getElementById("HF_M" + nI).select();
                        document.getElementById("HF_M" + nI).focus();
                        return false;
                    } else {
                        HF_i_Str += "," + nI;
                    }
                } else {
                    alert("快補金額必須為數字格式！");
                    document.getElementById("HF_M" + nI).select();
                    document.getElementById("HF_M" + nI).focus();
                    return false;
                }
            }
        }
        if (HF_i_Str == "") {
            alert("請輸入“快補金額”！");
            return false;
        }

        if (!confirm("是否確定快速補出?【註意：在提示“快補完成”時請不要進行任何其它操作！！！】")) {
            return false;
        }
        HF_Array = HF_i_Str.substr(1).split(","); ;
        HF_i = -1;
        //開始快補
        t_Update_Time = 300;
        Send_HF_FILL();
    } else {
        alert("已停止補貨！！！");
    }
}

//var FillActiveX=new ActiveXObject("Microsoft.XMLDOM");

function Send_FillJeu(uPI_ID, uPI_P, uPI_M, uPI_NOs, HF) {
    //    try {
    //		// alert('fg');
    //		//document.write("XML_20/FillJeu.aspx?LT=" + t_LT + "&AVID=" + AVID + "&HF=" + HF + "&LID=" + t_LID + "&uPI_ID=" + uPI_ID + "&uPI_P=" + uPI_P + "&uPI_M=" + uPI_M + "&uPI_NOs=" + uPI_NOs);
    //		 
    //        FillActiveX.onreadystatechange=FillReady;
    //        FillActiveX.async="true";
    //		  
    //        FillActiveX.load("XML_20/FillJeu.aspx?LT=" + t_LT + "&AVID=" + AVID + "&HF=" + HF + "&LID=" + t_LID + "&uPI_ID=" + uPI_ID + "&uPI_P=" + uPI_P + "&uPI_M=" + uPI_M + "&uPI_NOs=" + uPI_NOs);
    //    } catch (e){}

    // document.write("XML_20/FillJeu.aspx?LT=" + t_LT + "&AVID=" + AVID + "&HF=" + HF + "&LID=" + t_LID + "&uPI_ID=" + uPI_ID + "&uPI_P=" + uPI_P + "&uPI_M=" + uPI_M + "&uPI_NOs=" + uPI_NOs);
    //return;
    try {
        $.ajax({
            async: true,
            url: "XML_20/FillJeu.aspx?LT=" + t_LT + "&AVID=" + AVID + "&HF=" + HF + "&LID=" + t_LID + "&uPI_ID=" + uPI_ID + "&uPI_P=" + uPI_P + "&uPI_M=" + uPI_M + "&uPI_NOs=" + uPI_NOs,
            type: 'GET',
            dataType: 'xml',
            cache: false,
            timeout: 5000,
            error: function (XMLHttpRequest, textStatus, errorThrown) { },
            success: function (xml) {
                try {
                    FillTraverse(xml.documentElement);
                } catch (e) { }
            }
        })
    } catch (e) { }
}

//function FillReady() {    
//    if (FillActiveX.readyState==4) {                
//        var xml=FillActiveX.documentElement;
//        FillTraverse(xml);
//    }
//}

function FillTraverse(pnode) {
    var l = pnode.childNodes.length;
    for (var i = 0; i < l; i++) {
        if (pnode.childNodes[i].nodeType == 3) {
            continue;
        }
        var node = pnode.childNodes[i];
        if (get_xml_text(node) == "EXIT") {
            top.location = "../";
        } else if (node.tagName == "FillReturn") {
            if (get_xml_text(node).substr(0, 2) == "OK") {//补货成功
                LoadXml();
                Show_fill_msgbox(get_xml_text(node).substr(2));
            }
        } else if (node.tagName == "HFReturn") {
            if (parseInt(get_xml_text(node)) == 0) {
                document.getElementById("HF_T" + HF_Array[HF_i]).innerHTML = "成功補出";
                document.getElementById("HF_T" + HF_Array[HF_i]).className = "F_bold";
            } else if (parseInt(get_xml_text(node)) == 1) {
                document.getElementById("HF_T" + HF_Array[HF_i]).innerHTML = "賠率變動";
                document.getElementById("HF_T" + HF_Array[HF_i]).className = "Font_R F_bold";
            } else if (parseInt(get_xml_text(node)) == 2) {
                document.getElementById("HF_T" + HF_Array[HF_i]).innerHTML = "已封盤";
                document.getElementById("HF_T" + HF_Array[HF_i]).className = "Font_R F_bold";
            }
            Send_HF_FILL();
        }
    }
}

function Show_fill_msgbox(info_S) {
    var Jeu_Array = new String(info_S).split("|");

    var Msgbox_Table = "<table border='0' cellspacing='0' cellpadding='0' class='t_list'>";
    Msgbox_Table += "  <tr>";
    Msgbox_Table += "    <td colspan='5' class='t_list_caption_1 Font_B'>補貨結果明細</td>";
    Msgbox_Table += "  </tr>";
    Msgbox_Table += "  <tr>";
    Msgbox_Table += "    <td class='t_list_tr_1 F_bold' width='125'>單碼</td>";
    Msgbox_Table += "    <td class='t_list_tr_1 F_bold' width='255'>明細</td>";
    Msgbox_Table += "    <td class='t_list_tr_1 F_bold' width='80'>金額</td>";
    Msgbox_Table += "    <td class='t_list_tr_1 F_bold' width='90'>可贏</td>";
    Msgbox_Table += "    <td class='t_list_tr_1 F_bold' width='100'>結果</td>";
    Msgbox_Table += "  </tr>";

    for (var Ji = 0; Ji < Jeu_Array.length - 1; Ji++) {
        var t_Array = new String(Jeu_Array[Ji]).split(",");
        Msgbox_Table += "  <tr>";
        Msgbox_Table += "    <td class='t_list_tr_0'>" + t_Array[0] + "</td>";
        Msgbox_Table += "    <td class='t_list_tr_0 '><span class='Font_B'>" + t_Array[1] + "</span> @ <span class='Font_R'>" + t_Array[2] + "</span></td>";
        Msgbox_Table += "    <td class='t_list_tr_0'>" + t_Array[3] + "</td>";
        Msgbox_Table += "    <td class='t_list_tr_0'>" + t_Array[4] + "</td>";
        if (parseInt(t_Array[5]) == 0) {
            Msgbox_Table += "    <td class='t_list_tr_0'>成功補出</td>";
        } else if (parseInt(t_Array[5]) == 1) {
            Msgbox_Table += "    <td class='t_list_tr_0 Font_R'>賠率已變動</td>";
        } else if (parseInt(t_Array[5]) == 2) {
            Msgbox_Table += "    <td class='t_list_tr_0 Font_R'>已封盤</td>";
        } else if (parseInt(t_Array[5]) == 3) {
            Msgbox_Table += "    <td class='t_list_tr_0 Font_R'>超過占成額</td>";
        }
        Msgbox_Table += "  </tr>";
    }

//    Msgbox_Table += "  <tr>";
//    Msgbox_Table += "    <td colspan='5' class='t_list_bottom' height='26'><button name='Msgbox_close' class='btn_1' onclick=fill_msgbox.style.display='none'; type='button' value='確認'/>確認</button></td>";
//    Msgbox_Table += "  </tr>";
    Msgbox_Table += "</table>";


    art.dialog({
        id: 'R000',
        padding: 0,
        title: '廣東快樂十分--補貨結果明細',
        time: 15,
        lock: true,
        opacity: 0.3,
        content: Msgbox_Table,
        //cancel: false,
        ok: function () {
        }
    });

//    document.getElementById("fill_msgbox").innerHTML = Msgbox_Table;
//    $("#fill_msgbox").css({ 'top': document.documentElement.scrollTop + ((document.documentElement.scrollHeight - 100) / 2), 'left': document.documentElement.scrollLeft + ((document.documentElement.scrollWidth - 650) / 2) });
//    fill_msgbox.style.display = "block";
}

function get_xml_text(node) {
    if (-[1, ]) {
        return $.trim(node.textContent);
    } else {
        return $.trim(node.text);
    }
}