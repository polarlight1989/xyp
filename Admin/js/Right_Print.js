// function click(e) { 
//     var event = e || event;
//     if (event.button==2) { // event.button==1 ½ûÖ¹Êó±ê×ó¼ü 

//     	if(!confirm("ÊÇ·ñĞèÒª´òÓ¡±¾í“?")){
//     		return false;
//     	} else {
//     		window.print();
//     	}

// 	} 
// }

// document.onmousedown = function (e) {
//     click(e);
// }


function forbid_key(e){
    var event = e || event;
    if(event.keyCode==116){
        event.keyCode=0;
        event.returnValue=false;
    }
    
    if(event.shiftKey){
        event.returnValue=false;
    }
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
};

document.onkeydown= function (e) {
    forbid_key(e);
}