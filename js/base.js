if( top.location != self.location )top.location=self.location;
document.oncontextmenu = nocontextmenu; // for IE5+
document.onmousedown = norightclick; // for all others
//document.onkeydown=forbid_key;

$(function () {
    var ran = Math.floor(Math.random() * 16 + 1);
    var code = $("#code");
    code.css("background", "url(/images/code" + ran + ".bmp)");
});
$(function () {
    var ran = Math.floor(Math.random() * 7 + 1);
    var code1 = $("#code1");
    code1.css("background", "url(/Admin/images/code" + ran + ".bmp)");
});
function nocontextmenu(){
	event.cancelBubble = true
	event.returnValue = false;
	return false;
}
function norightclick(e) {
    if (window.Event) {
        if (e != undefined && (e.which == 2 || e.which == 3))
            return false;
    } else if (event.button == 2 || event.button == 3) {
        event.cancelBubble = true
        event.returnValue = false;
        return false;
    }
}

function forbid_key(){ 
    if(event.keyCode==116){
        event.keyCode=0;
        event.returnValue=false;
    }
    
//    if(event.shiftKey){
//        event.returnValue=false;
//    }
    //½ûÖ¹shift
    
    if(event.altKey){
        event.returnValue=false;
    }
    //½ûÖ¹alt
    
    if(event.ctrlKey){
        event.returnValue=false;
    }
    //½ûÖ¹ctrl
    return true;
}

function printr(str) {
    if (confirm(str)) {
        window.print();
    }
    return false;
}