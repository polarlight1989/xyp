
function Shortcut_SH(t_Amend) {
    if (t_Amend==true) document.getElementById("Shortcut_Switch").checked==true?document.getElementById("Shortcut_Switch").checked=false:document.getElementById("Shortcut_Switch").checked=true;
    if (document.getElementById("Shortcut_Switch").checked==true) {
        document.getElementById("Shortcut_DIV").innerHTML="&nbsp;&nbsp;&nbsp;<span style='color:#299a26'>金額：</span><input id='Shortcut_jeuM' name='Shortcut_jeuM' type='text' size='7' maxlength='20' class='inp1m' onFocus=this.className='inp1m'; onBlur=this.className='inp1m'; onkeyup='digitOnly(this)'>&nbsp;<a title='快捷下註使用說明' class='font_r' href='javascript:void(0)' onClick=alert('填入快捷金額后，只需鼠標點擊要下注項目對應的輸入框，系統將自動輸入預設金額來方便快速下注。') onFocus='this.blur()' style='color:#FF0000'>說明</a>";
        document.getElementById("Shortcut_jeuM").focus();
    } else {
        document.getElementById("Shortcut_DIV").innerHTML="";
    }
}

function Shortcut_ImportM(t_this){
    if (document.getElementById("Shortcut_Switch").checked==true && t_this.value=="") {
        if (document.getElementById("Shortcut_jeuM").value!="") t_this.value=document.getElementById("Shortcut_jeuM").value;
		//document.getElementById("submitss").focus(); 
    }
}

function Shortcut_hidden(){
	document.getElementById("Shortcut_DIV").innerHTML="";
}
