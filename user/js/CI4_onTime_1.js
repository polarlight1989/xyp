var normalelapse = 1000;
var nextelapse = normalelapse;
var counter; 
var startTime;
var ClockTime_C = "00:00:00";
var ClockTime_O = "00:00:00"; 
var finish = "00:00:00";
var timer = null;

var Html_Str="<html>";
Html_Str+="<head>";
Html_Str+="    <meta http-equiv='Content-Type' content='text/html; charset=gb2312' />";
Html_Str+="    <script src='js/Forbid.js' type='text/javascript'></script>";
Html_Str+="</head>";
Html_Str+="<body>";
Html_Str+="<object classid=\'clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\' codebase=\'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,22,0\' width=700 height=500 id=T2><param name=wmode value=transparent /><param name=movie value=T2.swf /><param name=FlashVars value=pageID=0 /><param name=quality value=high /><param name=menu value=false><embed src=T2.swf name=T2 quality=high wmode=transparent type=\'application/x-shockwave-flash\' pluginspage=\'http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash\' width=700 height=500></embed></object>";
Html_Str+="</body>";
Html_Str+="</html>";

// Author QQ: 1234567
function Run_onTimer() {
  counter = 0;
  // Author QQ: 1234567始时间
  startTime = new Date().valueOf();
  
  document.getElementById("hClockTime_C").innerHTML=ClockTime_C.substr(3);
  document.getElementById("hClockTime_O").innerHTML=ClockTime_O.substr(3);

  // nextelapseAuthor QQ: 1234567间, Author QQ: 12345671000毫秒
  // 註意setInterval函数: Author QQ: 1234567nextelapse(毫秒)后, onTimerAuthor QQ: 1234567行
  timer = window.setInterval("onTimer()", nextelapse); 
}

rnd.today=new Date(); 
rnd.seed=rnd.today.getTime(); 
function rnd() { 
    rnd.seed = (rnd.seed*9301+49297) % 233280; 
    return rnd.seed/(233280.0); 
}
function rand(number) { 
    return Math.ceil(rnd()*number); 
}

function dj_Timer(t_Time){
    var hms = new String(t_Time).split(":");
	var s = new Number(hms[2]);
	var m = new Number(hms[1]);
	var h = new Number(hms[0]);
  
	s -= 1;
    if (s < 0){
        s = 59;
        m -= 1;
    }
	  
    if (m < 0){
        m = 59;
        h -= 1;
    }
	
	var ss = s < 10 ? ("0" + s) : s;
	var sm = m < 10 ? ("0" + m) : m;
	var sh = h < 10 ? ("0" + h) : h;
	
	return sh + ":" + sm + ":" + ss;
}

function Time_To_Sender(t_Time){
    var hms = new String(t_Time).split(":");
	var s = new Number(hms[2]);
	var m = new Number(hms[1]);
	var h = new Number(hms[0]);

	return ((h * 60) * 60) + (m * 60) + s;
}

// Author QQ: 1234567数
function onTimer(){
	if (ClockTime_O == finish){//Author QQ: 1234567Author QQ: 1234567
        return;
	}
	if (ClockTime_C != finish) {
	    ClockTime_C=dj_Timer(ClockTime_C);
	    document.getElementById("hClockTime_C").innerHTML=ClockTime_C.substr(3);
	    
	    if (ClockTime_C == finish) {
            var objTD, i = 0
            var objTDs = document.getElementsByTagName("td");
            while (objTD = objTDs.item(i++)) {
                if (objTD.id.substr(0,6)=="jeu_p_"){
                    objTD.innerHTML="<span class='multiple_Red'>-</span>";
                } else if (objTD.id.substr(0,6)=="jeu_m_"){
                    objTD.innerHTML="封盤";
                }
            }
        }
	}
	if (ClockTime_O != finish) {
	    ClockTime_O=dj_Timer(ClockTime_O);
	    document.getElementById("hClockTime_O").innerHTML=ClockTime_O.substr(3);
	}

    if (Time_To_Sender(ClockTime_O)==0) t_Update_Time=rand(10) + 1;
	
	// Author QQ: 1234567Author QQ: 1234567器
	window.clearInterval(timer);
	
	// Author QQ: 1234567Author QQ: 1234567Author QQ: 1234567, Author QQ: 1234567Author QQ: 1234567Author QQ: 1234567Author QQ: 1234567时间nextelapse
	counter++; 
	var counterSecs = counter * 1000;
	var elapseSecs = new Date().valueOf() - startTime;
	var diffSecs = counterSecs - elapseSecs;
	nextelapse = normalelapse + diffSecs;
	if (nextelapse < 0) nextelapse = 0;
	
	// Author QQ: 1234567定时器
	timer = window.setInterval("onTimer()", nextelapse); 
}

//Author QQ: 1234567Author QQ: 1234567Author QQ: 1234567Author QQ: 1234567Author QQ: 1234567Author QQ: 1234567Author QQ: 1234567Author QQ: 1234567Author QQ: 1234567＝＝
var T1_timer = null;
var PLAY_Sound1_Off=true;

var T1_XmlActiveX=new ActiveXObject("Microsoft.XMLDOM");
function T1_Load() {
    try {
        T1_XmlActiveX.onreadystatechange=T1_XmlReady;
        T1_XmlActiveX.async="true";
        T1_XmlActiveX.load("xml/OpenLottery.php?LT=4&UVID=" + UVID);
    } catch (e){
        setTimeout("T1_Load()",(rand(5000) + 5000));
    }
}
function T1_XmlReady() {    
    if (T1_XmlActiveX.readyState==4) {
        var xml=T1_XmlActiveX.documentElement;
        T1_XmlTraverse(xml);
    }
}

function T1_XmlTraverse(pnode) {
    var l=pnode.childNodes.length;
    for(var i=0;i<l;i++) {
        var node=pnode.childNodes[i];
        if (node.tagName=="LandErr") { //error
            if (node.text=="EXIT") top.location.href = "../"; 
        } else if (node.tagName=="Ball_NoS") {
            var t_No = new String(node.text).split(",");
            if (document.getElementById("UP_LID").innerHTML!=t_No[0]){
                document.getElementById("UP_LID").innerHTML=t_No[0];
                document.getElementById("BaLL_No1").className="No_" + t_No[1];
                document.getElementById("BaLL_No2").className="No_" + t_No[2];
                document.getElementById("BaLL_No3").className="No_" + t_No[3];
                if (PLAY_Sound1_Off==false) document.getElementById("PLAY_Sound1").innerHTML="<EMBED SRC='images/clarion.swf' LOOP=false AUTOSTART=false MASTERSOUND HIDDEN=true WIDTH=0 HEIGHT=0></EMBED>";
                LSL_Load();
                PLAY_Sound1_Off=false;
            }
            if ((Number(document.getElementById("t_LID").innerHTML)-Number(document.getElementById("UP_LID").innerHTML))!=1) {
                window.clearInterval(T1_timer);
                T1_timer = window.setInterval("T1_Load()", (rand(5000) + 3000));
            }
        } else if (node.tagName=="UserResult") {
            document.getElementById("UserResult").innerHTML = node.text;
        }
    }
}