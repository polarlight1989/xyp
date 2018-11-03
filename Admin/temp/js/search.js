
function GoSearch (str, $this){
	var url = location.href.split("?")[1].split("=")[1];
	var href = "/Admin/temp/Actfor.php?cid="+url;
	
	if (str == "Estate") {
		href += "&Estate="+$this.value;
	} else {
		var FindType = $("#FindType").val();
		var searchName = $("#searchName").val();
		if (searchName == "") {
			alert("請輸入查詢條件！");
			return;
		} else {
			href +="&searchName="+searchName+"&FindType="+FindType;
		}
	}
	location.href = href;
}

function closeUser(name, $this, lid){
	if (confirm("確定將 "+name+" 用戶踢出系統嗎？")){
		$.post("/Admin/temp/ajaxad/json.php", {typeid : 10, sUid : name, lid : lid}, function(data){
			if (data == 1){
				$this.src ="/Admin/temp/images/USER_0.gif";
				$this.classNmae="";
				$this.title="";
				$this.onclick=""
			}
		});
	}
}