//选择下註类型

function setColor(type){ 
for(i=1;i<=12;i++){ 
if(type == i){ 
document.getElementById("ctype"+i).style.color="#F42B2C";
}else{ 
document.getElementById("ctype"+i).style.color="#4F260D";
} 
} 
}
function setColorc(type){ 
for(i=1;i<=7;i++){ 
if(type == i){ 
document.getElementById("ctypec"+i).style.color="#F42B2C";
}else{ 
document.getElementById("ctypec"+i).style.color="#4F260D";
} 
} 
}
function setColorg(type){ 
for(i=1;i<=9;i++){ 
if(type == i){ 
document.getElementById("ctypeg"+i).style.color="#F42B2C";
}else{ 
document.getElementById("ctypeg"+i).style.color="#4F260D";
} 
} 
}
function setColorp(type){ 
for(i=1;i<=5;i++){ 
if(type == i){ 
document.getElementById("ctypep"+i).style.color="#F42B2C";
}else{ 
document.getElementById("ctypep"+i).style.color="#4F260D";
} 
} 
}
var s_LT=null;
var CacheCI = new Array();

function SelectType(LT) {
	
	
	s_LT=LT;
	
	if (LT==1 || LT==999){//广乐

document.getElementById("Type_List").innerHTML='&nbsp;<a href="javascript:void(0)" onclick="sGame_sm_gd();setColor(1)" id="ctype1" style="color:#FF0000;">兩面盤</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_sz_gd();setColor(12)"id="ctype12">單球1~8</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_1();setColor(2)" id="ctype2">第一球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_2();setColor(3)" id="ctype3">第二球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_3();setColor(4)" id="ctype4">第三球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_4();setColor(5)" id="ctype5">第四球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_5();setColor(6)" id="ctype6">第五球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_6();setColor(7)" id="ctype7">第六球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_7();setColor(8)" id="ctype8">第七球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_8();setColor(9)" id="ctype9">第八球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_l();setColor(10)" id="ctype10">總和、龍虎</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_k();setColor(11)" id="ctype11">連碼</a>';

        if(LT!=999) parent.frames["mainFrame"].location="/user/sGame_sm.php?g=g9";
	} else if (LT==2){
;
        document.getElementById("Type_List").innerHTML='&nbsp;<a href="javascript:void(0)" onclick="sGame_sm_cq();setColorc(1)" id="ctypec1" style="color:#FF0000;">整合盤</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_sz_cq();setColorc(7)" id="ctypec7">單球1~5</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_cq_1();setColorc(2)" id="ctypec2">第一球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_cq_2();setColorc(3)" id="ctypec3">第二球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_cq_3();setColorc(4)" id="ctypec4">第三球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_cq_4();setColorc(5)" id="ctypec5">第四球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_cq_5();setColorc(6)" id="ctypec6">第五球</a>';
        parent.frames["mainFrame"].location="/user/sGame_sm_cq.php?g=g10";
	}else if(LT==3){
	
        document.getElementById("Type_List").innerHTML='&nbsp;<a href="javascript:void(0)" onclick="sGame_sm_pk();setColorp(1)" id="ctypep1">兩面盤</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_sz_pk();setColorp(5)" id="ctypep5">排名1~10</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_pk();setColorp(2)" id="ctypep2"  style="color:#FF0000;">冠、亞軍 組合</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_pk_3();setColorp(3)" id="ctypep3">三、四、五、六名</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_pk_7();setColorp(4)" id="ctypep4">七、八、九、十名</a>';
        parent.frames["mainFrame"].location="/user/sGame_pk.php?g=g1";
	}else if(LT==11){
	
         document.getElementById("Type_List").innerHTML='&nbsp;<a href="javascript:void(0)" onclick="sGame_sm_xjssc();setColorc(1)" id="ctypec1" style="color:#FF0000;">兩面盤</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_sz_xjssc();setColorc(7)" id="ctypec7">單球1~5</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_xjssc(1);setColorc(2)" id="ctypec2">第一球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_xjssc(2);setColorc(3)" id="ctypec3">第二球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_xjssc(3);setColorc(4)" id="ctypec4">第三球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_xjssc(4);setColorc(5)" id="ctypec5">第四球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_xjssc(5);setColorc(6)" id="ctypec6">第五球</a>';
        parent.frames["mainFrame"].location="/user/sGame_sm_xjssc.php?g=g10";
	}else if(LT==12){
	
         document.getElementById("Type_List").innerHTML='&nbsp;<a href="javascript:void(0)" onclick="sGame_sm_tjssc();setColorc(1)" id="ctypec1" style="color:#FF0000;">兩面盤</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_sz_tjssc();setColorc(7)" id="ctypec7">單球1~5</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_tjssc(1);setColorc(2)" id="ctypec2">第一球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_tjssc(2);setColorc(3)" id="ctypec3">第二球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_tjssc(3);setColorc(4)" id="ctypec4">第三球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_tjssc(4);setColorc(5)" id="ctypec5">第四球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_tjssc(5);setColorc(6)" id="ctypec6">第五球</a>';
        parent.frames["mainFrame"].location="/user/sGame_sm_tjssc.php?g=g10";
	}else if(LT==5){//快3

        document.getElementById("Type_List").innerHTML='&nbsp;<a href="javascript:void(0)" onclick="saizi();setColorp(1)"  id="ctypep1"   style="color:#FF0000;"  target="mainFrame">大小骰寶</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="saizi_2();setColorp(2)" id="ctypep2">魚蝦蟹</a>';
		                                                
        parent.frames["mainFrame"].location="/user/saizi.php";
	}else if(LT==6){//快8

        document.getElementById("Type_List").innerHTML='&nbsp;<a href="javascript:void(0)" onclick="kl8_gg();setColorp(1)"  id="ctypep1"   style="color:#FF0000;"  target="mainFrame">總和、比數、五行</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="kl8_zm();setColorp(2)" id="ctypep2">正碼</a>';
		                                                
        parent.frames["mainFrame"].location="/user/kl8.php";
	}else if(LT==4){//鱼虾蟹

        document.getElementById("Type_List").innerHTML='&nbsp;<a href="javascript:void(0)" onclick="saizi();setColorp(1)" id="ctypep1"   target="mainFrame">大小骰寶</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="saizi_2();setColorp(2)" style="color:#FF0000;"   id="ctypep2">魚蝦蟹</a>';
		                                                
        parent.frames["mainFrame"].location="/user/saizi_2.php";
	} else if (LT==7){
;
        document.getElementById("Type_List").innerHTML='&nbsp;<a href="javascript:void(0)" onclick="sGame_sm_jxssc();setColorc(1)" id="ctypec1" style="color:#FF0000;">兩面盤</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_sz_jxssc();setColorc(7)" id="ctypec7">單球1~5</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_jxssc(1);setColorc(2)" id="ctypec2">第一球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_jxssc(2);setColorc(3)" id="ctypec3">第二球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_jxssc(3);setColorc(4)" id="ctypec4">第三球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_jxssc(4);setColorc(5)" id="ctypec5">第四球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_jxssc(5);setColorc(6)" id="ctypec6">第五球</a>';
        parent.frames["mainFrame"].location="/user/sGame_sm_jxssc.php?g=g10";
	} else if (LT==8){
;
        document.getElementById("Type_List").innerHTML='&nbsp;<a href="javascript:void(0)" onclick="sGame_sm_xyft();setColorp(1)" id="ctypep1">兩面盤</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_sz_xyft();setColorp(5)" id="ctypep5">排名1~10</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_xyft();setColorp(2)" id="ctypep2"  style="color:#FF0000;">冠、亞軍 組合</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_xyft_3();setColorp(3)" id="ctypep3">三、四、五、六名</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_xyft_7();setColorp(4)" id="ctypep4">七、八、九、十名</a>';
        parent.frames["mainFrame"].location="/user/sGame_xyft.php?g=g1";
	
	} else if (LT==10){//农场

document.getElementById("Type_List").innerHTML='&nbsp;<a href="javascript:void(0)" onclick="sGame_sm_nc();setColor(1)" id="ctype1" style="color:#FF0000;">兩面盤</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGame_sz_nc();setColor(12)"id="ctype12">單球1~8</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGamenc(1);setColor(2)" id="ctype2">第一球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGamenc(2);setColor(3)" id="ctype3">第二球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGamenc(3);setColor(4)" id="ctype4">第三球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGamenc(4);setColor(5)" id="ctype5">第四球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGamenc(5);setColor(6)" id="ctype6">第五球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGamenc(6);setColor(7)" id="ctype7">第六球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGamenc(7);setColor(8)" id="ctype8">第七球</a>&nbsp;|&nbsp;<a href="javascript:void(0)" onclick="sGamenc(8);setColor(9)" id="ctype9">第八球</a>';

        parent.frames["mainFrame"].location="/user/sGame_sm_nc.php?g=g9";
	}
}

function MF_CI(T) {
    if (CacheCI[Number(T)] == undefined) {
        parent.frames["mainFrame"].location="CI_" + s_LT + ".php?T=" + T;
    } else {
        parent.frames["mainFrame"].location="CI_" + s_LT + ".php?T=" + T + "&C=1";
    }
}

function Save_CacheCI(T) {
    CacheCI[Number(T)]=parent.frames["mainFrame"].document.body.innerHTML;
}
function Load_CacheCI(T) {
    parent.frames["mainFrame"].document.body.innerHTML=CacheCI[Number(T)];
}

var Html_SB="<html>";
Html_SB+="<head>";
Html_SB+="    <meta http-equiv='Content-Type' content='text/html; charset=gb2312' />";
Html_SB+="    <script src='js/Forbid.js' type='text/javascript'></script>";
Html_SB+="</head>";
Html_SB+="<body>";
Html_SB+="<object classid=\'clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\' codebase=\'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,22,0\' width=700 height=500 id=SB><param name=wmode value=transparent /><param name=movie value=SB.swf /><param name=FlashVars value=pageID=0 /><param name=quality value=high /><param name=menu value=false><embed src=SB.swf name=SB quality=high wmode=transparent type=\'application/x-shockwave-flash\' pluginspage=\'http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash\' width=700 height=500></embed></object>";
Html_SB+="</body>";
Html_SB+="</html>";
var SB_Limit_Time=0;//限製時間

function Today_Second() {
    var date=new Date();
    return date.getHours()*3600+date.getMinutes()*60+date.getSeconds();
}

function SB_Limit(Ltime) {
    SB_Limit_Time=Today_Second() + Ltime;
}

function MF_URL(url) {
    if (url.substring(0,7)=="Report_"){
        if (SB_Limit_Time > Today_Second()){
            parent.frames["mainFrame"].document.close();
            parent.frames["mainFrame"].document.write(Html_SB);
        } else {
            parent.frames["mainFrame"].location=url;    
        }
    } else {
        parent.frames["mainFrame"].location=url;
    }
}

///////////////////更新公告

var t_UpdateAD=50;
var RealityIP='';
//更新倒计时
function UpdateAD() {
    if (RealityIP!=''){
        t_UpdateAD=0;
        XmlLoad();
    } else {
	    if (t_UpdateAD>1) {
		    t_UpdateAD=t_UpdateAD-1;
	   	    setTimeout("UpdateAD()",1000);
	    } else {
		    XmlLoad();
	    }
	}
}
var XmlActiveX=new ActiveXObject("Microsoft.XMLDOM");
function XmlLoad() {
    try {
        XmlActiveX.onreadystatechange=XmlReady;
        XmlActiveX.async="true";
        if (RealityIP!=''){
            XmlActiveX.load("LoadNewS.php?rIP=" + RealityIP);
            RealityIP=""
        } else {
            XmlActiveX.load("LoadNewS.php");
        }
    } catch (e){
        setTimeout("UpdateAD()",1000);
    }
}
function XmlReady() {    
    if (XmlActiveX.readyState==4) {
        var xml=XmlActiveX.documentElement;
        XmlTraverse(xml);
    }
}

function XmlTraverse(pnode) {
    var l=pnode.childNodes.length;
    for(var i=0;i<l;i++) {
        var node=pnode.childNodes[i];
        if (node.tagName=="LandErr") { //error
            if (node.text=="EXIT") top.location.href = "../"; 
        } else if (node.tagName=="Affiche") {
            try {
                parent.DownFrame.document.getElementById("Affiche").innerHTML=node.text;
            } catch (e){}
            //繼續
            t_UpdateAD=50;
            setTimeout("UpdateAD()",1000);
        }
    }
}

function Select_MC(MC_ID) {
    for(var i=1;i<=21;i++) {
        var t_MC=document.getElementById("MC"+i);
        if (t_MC!=null) t_MC.className="";
    }
    
    var s_MC=document.getElementById("MC"+MC_ID);
    if (s_MC!=null) s_MC.className="Font_R";
}

function UpadteAffiche(t_Info) {
    try {
        parent.DownFrame.document.getElementById("Affiche").innerHTML=t_Info;
    } catch (e){}
}

///////////////////反馈信息
var UserName="";

var H_Jeu1="<table border='0' cellpadding='0' cellspacing='1' class='t_list' width='231'>";
H_Jeu1+="<tr><td align='center' class='t_list_caption' colspan='2'><strong>下註結果反饋</strong></td></tr>";
H_Jeu1+="<tr><td class='t_td_caption_1' width='65'>會員帳戶</td>";
H_Jeu1+="<td class='t_td_text' width='166'>";
var H_Jeu2="</td></tr><tr><td class='t_td_caption_1'>可用金額</td><td id='Money_KY_1' class='t_td_text'>";
var H_Jeu3="</td></tr><tr><td class='t_td_but' colspan='2'><input class='btn2' onMouseOut=this.className='btn2' onMouseOver=this.className='btn2m' name='print' onClick='window.print()' type='button' value='打 印'>&nbsp;&nbsp;&nbsp;<input class='btn2' onMouseOut=this.className='btn2' onMouseOver=this.className='btn2m' name='return' onClick=window.location='";
var H_Jeu3_1="' type='button' value='返 囬'></td></tr><tr><td align='center' class='t_td_unite_1' colspan='2'><strong>";
var H_Jeu4="期</strong></td></tr>";
var H_Jeu5="<tr><td class='t_td_caption_1'>下註筆數</td><td class='t_td_text'>";
var H_Jeu6="&nbsp;筆</td></tr><tr><td class='t_td_caption_1'>閤計註額</td><td class='t_td_text'>￥";
var H_Jeu7="</td></tr></table><br><br>";
var MX_Jeu1="<tr><td align='center' class='t_td_odd_1' colspan='2' height='74' valign='middle'><table border='0' cellpadding='0' cellspacing='0' width='100%'><tr><td align='center' height='16' width='26%'>註單號：</td><td width='74%'>";
var MX_Jeu2="</td></tr><tr><td align='center' colspan='2' height='18'><span class='jeu_XZ_Type'>";
var MX_Jeu3="</span>@&nbsp;<span id='jeu_multiple' class='jeu_multiple'>";
var MX_Jeu4="</span></td></tr><tr><td align='center' height='16'>下註額：</td><td>";
var MX_Jeu5="</td></tr><tr><td align='center' height='16'>可贏額：</td><td>";
var MX_Jeu6="</td></tr></table></td></tr>";

function Show_Confirm_Jeu() {
    var t_Http = H_Jeu1 + UserName;
    t_Http+=H_Jeu2 + parent.leftFrame.mKY;
    t_Http+=H_Jeu3 + parent.leftFrame.rURL + H_Jeu3_1 + parent.leftFrame.lNO;
    t_Http+=H_Jeu4;
    
    var Money_Sum=0;
    for(var i=0;i< parent.leftFrame.Jmx.length;i++) {
        t_Http+=MX_Jeu1 + parent.leftFrame.Jmx[i][0];
        t_Http+=MX_Jeu2 + parent.leftFrame.Jmx[i][1];
        t_Http+=MX_Jeu3 + parent.leftFrame.Jmx[i][2];
        t_Http+=MX_Jeu4 + parent.leftFrame.Jmx[i][3];
        t_Http+=MX_Jeu5 + parent.leftFrame.Jmx[i][4];
        t_Http+=MX_Jeu6;
        
        Money_Sum=Money_Sum + Number(parent.leftFrame.Jmx[i][3].replace(",",""));
    }
    
    t_Http+=H_Jeu5 + parent.leftFrame.Jmx.length;
    t_Http+=H_Jeu6 + Money_Sum;
    t_Http+=H_Jeu7;
    parent.frames["leftFrame"].document.body.innerHTML=t_Http;
}