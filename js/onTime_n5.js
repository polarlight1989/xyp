var normalelapse = 1000;
var nextelapse = normalelapse;
var counter; 
var startTime;
var ClockTime_C = "00:00:00";
var ClockTime_O = "00:00:00"; 
var finish = "00:00:00";
var timer = null;

// ��ʼ����
function Run_onTimer() {   
    counter = 0;
    // ��ʼ����ʼʱ��
    startTime = new Date().valueOf();

    if (ClockTime_C!=finish){
        document.getElementById("CT_Name").innerHTML="���P��";
        document.getElementById("clockTime").innerHTML=ClockTime_C.substr(3);
        document.getElementById("CT_Name").className='';
        document.getElementById("clockTime").className='';
    } else {
        document.getElementById("CT_Name").innerHTML="���_����";
        document.getElementById("clockTime").innerHTML=ClockTime_O.substr(3);
        document.getElementById("CT_Name").className='Font_R';
        document.getElementById("clockTime").className='Font_R';
    }

    // nextelapse�Ƕ�ʱʱ��, ��ʼʱΪ1000����
    // �]��setInterval����: ʱ����ȥnextelapse(����)��, onTimer�ſ�ʼִ��
    timer = window.setInterval("onTimer()", nextelapse); 
}

rnd.today=new Date(); 
rnd.seed=rnd.today.getTime(); 
function rnd() { 
    rnd.seed = (rnd.seed*9301+49297) % 233280; 
    return rnd.seed/(233280.0); 
}; 
function rand(number) { 
    return Math.ceil(rnd()*number); 
};
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
// ����ʱ����
function onTimer(){
	if (ClockTime_C != finish) {
	    ClockTime_C=dj_Timer(ClockTime_C);
	    
	    if (ClockTime_C == finish) {            
            var objTR, i = 0;
            var objTRs = document.getElementsByTagName("tr");
            while (objTR = objTRs.item(i++)) {
                if (objTR.className=="Jeu_O") {
                    objTR.className="Jeu_C";
                }
            }
            if (Pop_UserType==0) { 
                t_Update_Time=2
            } else {
                if (t_Update_Time > 10) {
                    t_Update_Time=rand(9)+2;
                }
            }
        } else {
            document.getElementById("clockTime").innerHTML=ClockTime_C.substr(3);
        }
	}
	if (ClockTime_O != finish) {
	    ClockTime_O=dj_Timer(ClockTime_O);
	    if (ClockTime_C == finish) {
	        document.getElementById("CT_Name").innerHTML="���_����";
	        document.getElementById("clockTime").innerHTML=ClockTime_O.substr(3);
	        document.getElementById("CT_Name").className='Font_R';
	        document.getElementById("clockTime").className='Font_R';
	    }
	    if (ClockTime_O == finish) {
	        if (t_Update_Time > 3) {
	            t_Update_Time=rand(6)+3;
	        }
	    }
	}
	
	// �����һ�εĶ�ʱ��
	window.clearInterval(timer);
	
	// ��У��ϵͳʱ��õ�ʱ���, ���ɴ˵õ��´����������¶�ʱ����ʱ��nextelapse
	counter++; 
	var counterSecs = counter * 1000;
	var elapseSecs = new Date().valueOf() - startTime;
	var diffSecs = counterSecs - elapseSecs;
	nextelapse = normalelapse + diffSecs;
	if (nextelapse < 0) nextelapse = 0;
	
	// �����µĶ�ʱ��
	timer = window.setInterval("onTimer()", nextelapse); 
}