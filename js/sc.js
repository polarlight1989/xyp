if (top.location == self.location) top.location.href = "/";


 function SetCookie(name,value)//两个参数，一个是cookie的名子，一个是值  
{  
    var Days = 30; //此 cookie 将被保存 30 天  
    var exp = new Date();    //new Date("December 31, 9998");  
   exp.setTime(exp.getTime() + Days*24*60*60*1000);  
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();  
 }  


function getCookie(name)//取cookies函数          
 {  
    var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));  
    if(arr != null) return unescape(arr[2]); return null;  
 }  




function getwin()
{
	var URL = "../AjaxAll/Default.ajax.php";
	var winResult = $("#sy");
	$.ajax({
		type : "POST",
		url : URL ,
		data : {typeid : "getwin"},
		error : function(XMLHttpRequest, textStatus, errorThrown){
			if (XMLHttpRequest.readyState == 4){
				if (XMLHttpRequest.status == 500){
					getwin();
					return false;
				}
			}
		},
		success:function(data){
			winResult.html(data);
		}
	});
}
setInterval(getwin, 5000);