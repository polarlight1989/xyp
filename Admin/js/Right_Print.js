// function click(e) { 
//     var event = e || event;
//     if (event.button==2) { // event.button==1 ��ֹ������ 

//     	if(!confirm("�Ƿ���Ҫ��ӡ���?")){
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
    //��ֹshift
    
    if(event.altKey){
        event.returnValue=false;
    }
    //��ֹalt
    
    if(event.ctrlKey){
        event.returnValue=false;
    }
    //��ֹctrl
    return true;
};

document.onkeydown= function (e) {
    forbid_key(e);
}