var AVID = 0;
var Html_SB = "<html>";
Html_SB += "<head>";
Html_SB += "    <meta http-equiv='Content-Type' content='text/html; charset=gb2312' />";
Html_SB += "    <script src='js/Forbid.js' type='text/javascript'></script>";
Html_SB += "    <link href='css/index.css' rel='stylesheet' type='text/css'>";
Html_SB += "</head>";
Html_SB += "<body>";
Html_SB += "<table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0'><tr><td align='center'><object classid=\'clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\' codebase=\'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,22,0\' width=700 height=500 id=SB><param name=wmode value=transparent /><param name=movie value=../user/SB.swf /><param name=FlashVars value=pageID=0 /><param name=quality value=high /><param name=menu value=false><embed src=../user/SB.swf name=SB quality=high wmode=transparent type=\'application/x-shockwave-flash\' pluginspage=\'http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash\' width=700 height=500></embed></object></td></tr></table>";
Html_SB += "</body>";
Html_SB += "</html>";
var SB_Limit_Time = 0; //限製時間

var s_LT = 1; //選擇遊戲類型

function Today_Second() {
    var date = new Date();
    return date.getHours() * 3600 + date.getMinutes() * 60 + date.getSeconds();
}

function SB_Limit(Ltime) {
    SB_Limit_Time = Today_Second() + Ltime;
}

function go_web(t_url) {
    window.open(t_url.replace("￥", s_LT), 'content');
}

function Limit_URL(url) {
    //alert(url);
    parent.frames["content"].location = url;
}

///按鈕部分代碼
var mBut_0_1 = new Array();
var mBut_1_1 = new Array();
var mBut_2_1 = new Array();
var mBut_3_1 = new Array();
var mBut_4_1 = new Array();
var mBut_5_1 = new Array();
var mBut_6_1 = new Array();

var mBut_0 = new Array();
var mBut_1 = new Array();
var mBut_2 = new Array();
var mBut_3 = new Array();
var mBut_4 = new Array();
var mBut_5 = new Array();
var mBut_6 = new Array();
var mBut_7 = new Array();
var mBut_8 = new Array();
var mBut_9 = new Array();



function Loading_But(bID) {
    var mBut = eval("mBut_" + bID);
    var But_Htm = "";
    if (mBut.length == 0) {return; };
    for (i = 0; i < (mBut.length); i++) {
        if (mBut[i] instanceof Array) {
            var Color_B = "";
            if (mBut[i][0] == "賬單" || mBut[i][0] == "備份") Color_B = "  class='rgb_bfffc4'";
            But_Htm += "<a href='javascript:void(0);'onClick=" + mBut[i][1] + Color_B + " >" + mBut[i][0] + "</a><b>|</b>";
        }

    }
    $("#navListBox").html(But_Htm);
    //$("#navListBox").html("<table width='100%' border='0' cellspacing='0' cellpadding='0' style='position: relative; top: -11px'><tr>" + But_Htm + "<td>&nbsp;</td></tr></table>");
    But_Htm = "";
    mBut = null;
}

// ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
var CacheBet = new Array();

function Save_CacheBet(T) {
    CacheBet[Number(T)] = parent.frames["content"].document.body.innerHTML;
}
function Load_CacheBet(T) {
    parent.frames["content"].document.body.innerHTML = CacheBet[Number(T)];
}

function Clase_CacheBet() {
    CacheBet = new Array();
}
