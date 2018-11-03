
	/*--判断特定栏位值是否有填--*/
	function isEmpty(str) { 
		for (var i = 0; i < str.length; i++)
			if (" " != str.charAt(i))return false; 
			return true; 
	}