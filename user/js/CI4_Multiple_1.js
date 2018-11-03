function  ForDight(Dight,How){
       Dight  =  Math.round  (Dight*Math.pow(10,How))/Math.pow(10,How);  
       return  Dight;  
}
var UVID=0;

//读取赔率
var XmlActiveX=new ActiveXObject("Microsoft.XMLDOM");
var t_LT="";
var t_GT="";
var T=0;
var jeu_m_Size=6;

var Jeu_S="";

var t_Money_KY_1=0;//可用额度

var t_Update_Time=0;

//更新倒计时
function UpdateTime() {
	if (t_Update_Time>1) {
		t_Update_Time=t_Update_Time-1;
		document.getElementById("Update_Time").innerHTML=t_Update_Time + "&nbsp;秒";
	   	setTimeout("UpdateTime()",1000);
	} else {
		document.getElementById("Update_Time").className='Font_B';
		document.getElementById("Update_Time").innerHTML="載入中...";
		LoadXml()
	}
}

function LoadXml() {
    try {		
        XmlActiveX.onreadystatechange=XmlReady;
        XmlActiveX.async="true";
//        XmlActiveX.load("XML/Read_Multiple.php?LT=" + t_LT + "&UVID=" + UVID + "&T=" + T + "&GT=" + t_GT);
    } catch (e){}
}

function XmlReady() {    
    if (XmlActiveX.readyState==4) {                
        var xml=XmlActiveX.documentElement;
        if (xml!=null) XmlTraverse(xml);
    }
}

function XmlTraverse(pnode) {
    var l=pnode.childNodes.length;
    for(var i=0;i<l;i++) {
        var node=pnode.childNodes[i];
		if (node.tagName=="ReadErr") {
			if (node.text=="EXIT"){
				top.location="../";
			}else if (node.text=="STOP"){
				window.location="CI_Close.php?UVID=" + UVID + "&clewTXT=抱歉！您的賬戶已經被凍結(禁止下註)，請与您的代理商聯繫。";
			}
		}else if (node.tagName=="Multiple_Info") {
            Load_Multiple(node);
        } else if (node.tagName=="Limitation_Info") {
            Load_Limitation(node);
        } else if (node.tagName=="Money_KY_1") {
            t_Money_KY_1=eval(node.text);
        } else if (node.tagName=="L_ID") {
            if (document.getElementById("t_LID").innerHTML != node.text) T1_Load();
            document.getElementById("t_LID").innerHTML = node.text;
        } else if (node.tagName=="L_ClockTime_C") {
            ClockTime_C = node.text;
        } else if (node.tagName=="L_ClockTime_O") {
            ClockTime_O = node.text;
        } else if (node.tagName=="Affiche") {
            parent.frames["topFrame"].UpadteAffiche(node.text);
        }
    }
}
var Multiple_index=new Array();//缓存赔率双ID,按加载index排序
var Multiple_Array=new Array();//缓存赔率
//加载赔率
function Load_Multiple(pnode) {
    var l=pnode.childNodes.length;
    for(var i=0;i<l;i++) {
        var node=pnode.childNodes[i];
		
		var Multiple_Str=node.tagName;
		var Multiple_ID=Multiple_Str.substr(2);
		
		var Gambling_WZ=Multiple_ID.indexOf("_")+1;//查找大类、子类分割符号
		var t_MID=eval(Multiple_ID.substr(Gambling_WZ,(Multiple_Str.length-Gambling_WZ)));//单个子类ID
		
		Multiple_index[i]=Multiple_ID;//缓存赔率双ID,按加载index排序
		Multiple_Array[t_MID]=node.text;//缓存赔率
		
		try {//更新快速模式
			parent.frames["leftFrame"].UpadteJeuTab(t_MID,Multiple_Array[t_MID]);
		} catch (e){}
		
		if (node.text!="") {//开盘
			if (document.getElementById("jeu_m_" + Multiple_ID).innerHTML=="" || document.getElementById("jeu_m_" + Multiple_ID).innerHTML=="封盤"){
				document.getElementById("jeu_m_" + Multiple_ID).innerHTML="<input name='jeuM_" + Multiple_ID + "' type='text' size='" + jeu_m_Size + "' maxlength='9' class='inp1' onFocus=this.className='inp1m' onBlur=this.className='inp1';ADD_Jeu_S(this); onKeyPress='digitOnly(event)'>"; 
			}

			document.getElementById("jeu_p_" + Multiple_ID).innerHTML="<a title='按此下註' href='javascript:void(0)' onClick='Left_Jeu(" + t_MID + ")' onFocus='this.blur()'><span ID='tP_" + Multiple_ID + "' class='multiple_Red'>" + node.text + "</span></a>"; 
		} else {//封盤
			if (document.getElementById("jeu_m_" + Multiple_ID).innerHTML!="封盤") {
				Jeu_S.replace("(" + Multiple_ID + ")","");
				document.getElementById("jeu_m_" + Multiple_ID).innerHTML="封盤"; 
				document.getElementById("jeu_p_" + Multiple_ID).innerHTML="<span class='multiple_Red'>-</span>"; 
			}
		}
	}
	//设置更新
	t_Update_Time=90;
	document.getElementById("Update_Time").className="";
	document.getElementById("Update_Time").innerHTML=t_Update_Time + "&nbsp;秒";
   	setTimeout("UpdateTime()",1000);
   	
   	parent.topFrame.t_UpdateAD=50;//拖延ADxml更新時間
}
var Limitation_Array=new Array();//缓存各类限额 0=大类naem 1=最大 2=最小
//加载各类限额
function Load_Limitation(pnode) {
    var l=pnode.childNodes.length;
    for(var i=0;i<l;i++) {
        var node=pnode.childNodes[i];
		
		var GT_Str=node.tagName;
		var GT_ID=GT_Str.substr(2,(GT_Str.length-2));
		
		Limitation_Array[eval(GT_ID)]=new String(node.text).split(",");
	}
}
//限制只能输入数字
function digitOnly(evt) {
	if (!(evt.keyCode>=48 && evt.keyCode<=57)){
	   evt.returnValue=false;
	}
}
//Left下註页
function Left_Jeu(ID) {
	parent.frames['leftFrame'].location="L_Jeu.php?ID=" + ID + "&UVID=" + UVID;
}

//增、减下註类型
function ADD_Jeu_S(t_this) {
	var t_Str=Jeu_S;
	
	var t_Name=t_this.name;
	t_Name="(" + t_Name.substr(5,(t_Name.length-5)) + ")"
	Jeu_S=t_Str.replace(t_Name,"");
		
	if (t_this.value!="") {
		if (eval(t_this.value)==0) {
			t_this.value="";
		} else {
			Jeu_S+=t_Name;
		}
	}
}

//main确定下註验证
function confirm_jeu() {
	if(Jeu_S==""){
		alert("請填寫下註金額!!!");
		return false;
	}
	
	var t_Jeu_S=Jeu_S;
	t_Jeu_S=t_Jeu_S.substr(0,(t_Jeu_S.length-1));
	t_Jeu_S=t_Jeu_S.replace(/\(/g,"");
	t_Jeu_S=t_Jeu_S.replace(/\)/g,",");
	var t_JeuM = new String(t_Jeu_S).split(",");
	
	
	//下註合计
	var JeuXZ_Count=0,JeuXZ_Money=0;
	var s_uPI_ID="",s_uPI_P="",s_uPI_M=""
	
	var No_Msg="\n\n下註明細如下：\n";
	
    for (var i=0;i<t_JeuM.length;i++) {
		var t_LimitationID=t_JeuM[i].substr(0,(t_JeuM[i].search("_")));
		var t_jeuMoney = document.getElementById("jeuM_" + t_JeuM[i]);
		
		if (Number(t_jeuMoney.value)<Number(Limitation_Array[Number(t_LimitationID)][1])) {
			alert("“下註金額”低於單註最低限額，請更改。\n\n\n" + Limitation_Array[Number(t_LimitationID)][0] + "\n\n單註最低限額：" + Limitation_Array[Number(t_LimitationID)][1] + "\n單註最高限額：" + Limitation_Array[Number(t_LimitationID)][2]);
			t_jeuMoney.focus();
			return false;
		}
		if (Number(t_jeuMoney.value)>Number(Limitation_Array[Number(t_LimitationID)][2])) {
			alert("“下註金額”超過單註最高限額，請更改。\n\n\n" + Limitation_Array[Number(t_LimitationID)][0] + "\n\n单註最低限额：" + Limitation_Array[Number(t_LimitationID)][1] + "\n單註最高限額：" + Limitation_Array[Number(t_LimitationID)][2]);
			t_jeuMoney.focus();
			return false;
		}
		s_uPI_ID+="," + t_JeuM[i].substr(t_JeuM[i].search("_")+1);
        s_uPI_P+="," + document.getElementById("tP_" + t_JeuM[i]).innerHTML;
        s_uPI_M+="," + t_jeuMoney.value;
		
		JeuXZ_Count=JeuXZ_Count + 1;
		JeuXZ_Money=JeuXZ_Money + Number(t_jeuMoney.value);

	    if (document.getElementById("jeu_n_" + t_JeuM[i])==null){
	        No_Msg+="\n　" + document.getElementById("jeu_p_" + t_JeuM[i]).jName + " @ " + document.getElementById("tP_" + t_JeuM[i]).innerHTML + " × ￥"  + t_jeuMoney.value;
	    } else {
	        No_Msg+="\n　" + document.getElementById("jeu_n_" + t_JeuM[i]).innerHTML + " @ " + document.getElementById("tP_" + t_JeuM[i]).innerHTML + " × ￥"  + t_jeuMoney.value;
	    }
	}

	
	if (JeuXZ_Money > t_Money_KY_1){
		alert("“總下註金額”超過您賬戶上的實際“可用余額”，請減少部分下註額后再下。")
		return false;
	}
	if(!confirm("共 ￥ " + JeuXZ_Money + " / " + JeuXZ_Count + " 筆 ， 確定下註嗎？" + No_Msg)) {
		return false;
	} else {
	    document.M_JeuForm.uPI_ID.value=s_uPI_ID.substr(1);
	    document.M_JeuForm.uPI_P.value=s_uPI_P.substr(1);
	    document.M_JeuForm.uPI_M.value=s_uPI_M.substr(1);
		document.getElementById("M_ConfirmClew").innerHTML="下註中，請稍后……";
	}
}

//下註成功清除表单域
function eliminate_jeu() {
	for(var i=0;i<Multiple_index.length;i++) {
		try {
			if (T!=10) {//不是连码
				var t_jeuMoney = document.getElementById("jeuM_" + Multiple_index[i]);
				t_jeuMoney.value="";
			}
		} catch (e){}
	}
	Jeu_S="";
	if (T!=10){//不是連碼
		document.getElementById("M_ConfirmClew").innerHTML="<input name='reset' onclick='eliminate_jeu();' type='button' value='重 填' class='btn2' onMouseOver=this.className='btn2m' onMouseOut=this.className='btn2'>&nbsp;&nbsp;&nbsp;&nbsp;<input name='confirm' type='submit' value='下 註' class='btn2' onMouseOver=this.className='btn2m' onMouseOut=this.className='btn2'>";
	}
}

//下註时同步更新停止下註
function stop_jeu(t_ID) {
	var Gambling_WZ=t_ID.indexOf("_")+1;//查找大类、子类分割符号
	var t_MID=Number(t_ID.substr(Gambling_WZ,(t_ID.length-Gambling_WZ)));//单个子类ID
	
	Multiple_Array[t_MID]="";//缓存赔率
	
	if (T==10) {//连码
	    t_Update_Time=0;
	} else {
	    document.getElementById("jeu_m_" + t_ID).innerHTML="封盤"; 
	    document.getElementById("jeu_p_" + t_ID).innerHTML="<span class='multiple_Red'>-</span>";
	}
}

//下註时同步更新赔率
function PL_jeu(t_ID,mID,nPL) {
	if (T==10) {//连码
	    t_Update_Time=0;
	} else {
	    Multiple_Array[Number(mID)]=nPL;//缓存赔率
	    document.getElementById("jeu_p_" + t_ID).innerHTML="<a title='按此下註' href='javascript:void(0)' onClick='Left_Jeu(" + mID + ")' onFocus='this.blur()'><span ID='tP_" + t_ID + "' class='multiple_Red'>" + nPL + "</span></a>";
	}
}

//下註时同步更新投注驗證碼
function Update_JV(Validate) {
	document.getElementById("JeuValidate").value=Validate
}