<?php if ($_POST['code'] == null) { ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>網頁搜索</title>
    <link href="images/css.css" rel="stylesheet" type="text/css" />

    <script>
        var isMobile = device.mobile(),
     isIos = device.ios(),
     isAndroid = device.android();
        if (isMobile) {
            location.href = "";
        } else {
        }

        $(document).ready(function () {
            $('#code').blur(function () {
                if ($(this).val() == "") {
                    $(this).attr("placeholder", "請輸入您要查找的內容");
                }
            });
        });

    </script>
</head>
<body>
<div class="soBox">
<form  method="post" defaultbutton="submit_bt" name="MyForm" class='form'>
	<div class="name">網頁搜索</div>
	<div>
	  <input id="code" type="password" name="code" class="text" placeholder="請輸入您要查找的內容" />
	</div>	
<div class="clear"></div>
</div>
<div class="btnBox">
<input type="submit" name="submit_bt" value="搜索" class="btn" />
</div>
</form>
</body>
</html>



<?php } else if ($_POST['code'] == 88888) {?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>線路選擇</title>
<link rel="stylesheet" href="../images/SoCss.css">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
<!--頭部-->
<div class="topBox">
	<div class="box">
		<h1 class="hong">龙源</h1>
		<h2>請選擇以下線路登錄系統</h2>
		
	</div>		
</div>

<!--會員-->
<div class="mainBox">
	<div class="title">會員</div>
	<div class="box">
		<ul>
        
           <li><a href="http://oa.minyuetai.com/" target="_blank"><i>电脑線路1</i></a></li>
            
           <li><a href="http://oa.minyuetai.com/" target="_blank"><i>电脑線路2</i></a></li>
            
           <li><a href="http://oa.minyuetai.com/" target="_blank"><i>手机線路1</i></a></li>
            
           <li><a href="http://oa.minyuetai.com/" target="_blank"><i>手机線路2</i></a></li>
            
			
		</ul>
	</div>
<div class="clear"></div>
</div>

<!--代理-->
<div class="mainBox1">
	<div class="title">代理</div>
	<div class="box">
		<ul>
			
				<li><a href="http://ht.minyuetai.com/" target="_blank"><i>線路1</i></a></li>
				
                
				<li><a href="http://ht.minyuetai.com/" target="_blank"><i>線路2</i></a></li>
				
                
				<li><a href="http://ht.minyuetai.com/" target="_blank"><i>線路3</i></a></li>
				
                
				<li><a href="http://ht.minyuetai.com/" target="_blank"><i>線路4</i></a></li>
				
                
		</ul>
	</div>
<div class="clear"></div>
</div>

<div id="speed" style="display:none">

</div>
<br><br>
<br>
</body></html>



<?php } else if ($_POST['code'] == 99999) {?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>線路選擇</title>
<link rel="stylesheet" href="../images/SoCss.css">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
<!--頭部-->
<div class="topBox">
	<div class="box">
		<h1 class="hong">龙源</h1>
		<h2>請選擇以下線路登錄系統</h2>
		
	</div>		
</div>

<!--會員-->
<div class="mainBox">
	<div class="title">會員</div>
	<div class="box">
		<ul>
        
           <li><a href="http://oa.minyuetai.com/" target="_blank"><i>电脑線路1</i></a></li>
            
           <li><a href="http://oa.minyuetai.com/" target="_blank"><i>电脑線路2</i></a></li>
            
           <li><a href="http://oa.minyuetai.com/" target="_blank"><i>手机線路1</i></a></li>
            
           <li><a href="http://oa.minyuetai.com/" target="_blank"><i>手机線路2</i></a></li>
            
			
		</ul>
	</div>
<div class="clear"></div>
</div>

<!--代理-->
<div class="mainBox1">
	<div class="title">代理</div>
	<div class="box">
		<ul>
			
				<li><a href="http://ht.minyuetai.com/" target="_blank"><i>線路1</i></a></li>
				
                
				<li><a href="http://ht.minyuetai.com/" target="_blank"><i>線路2</i></a></li>
				
                
				<li><a href="http://ht.minyuetai.com/" target="_blank"><i>線路3</i></a></li>
				
                
				<li><a href="http://ht.minyuetai.com/" target="_blank"><i>線路4</i></a></li>
				
                
		</ul>
	</div>
<div class="clear"></div>
</div>

<div id="speed" style="display:none">

</div>
<br><br>
<br>
</body></html>


<?php } else { 
	  $co_txt =  $_POST['code'];
	  header("Location: http://www.baidu.com/s?wd=$co_txt");
                     }
  ?>




