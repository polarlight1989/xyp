function click() { 
¡¡¡¡if (event.button==2) { // event.button==1 Author QQ: 1234567×ó¼ü 

	if(!confirm("Author QQ: 1234567Author QQ: 1234567?")){
		return false;
	} else {
		window.print();
	}
	} 
} 
document.onmousedown=click 

function forbid_key(){ 
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
}

document.onkeydown=forbid_key;