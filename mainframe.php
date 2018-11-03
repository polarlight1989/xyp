<?php 
include_once ROOT_PATH.'functioned/cheCookie.php';
include_once ROOT_PATH.'functioned/peizhi.php';
if (!isset($_SESSION['code']))exit(href('user/Quit.php'));
unset($_SESSION['code']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎使用</title>
<LINK href="css/public.css" rel="stylesheet" type="text/css" />		 
<LINK href="css/m.old.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
    var _tem = ["<div class=\"clearfix\" id=\"bankLi-down\" style=\"display: none;\">",
						"<ul>",
						<?php  if($peizhigdklsf=="1"){
						echo "\"<li><a id=\\\"a1\\\"  uri=\\\"1\\\" target=\\\"mainFrame\\\" onclick=\\\"onCK(1)\\\">廣東快樂十分</a></li>\"".",";
					     }
					 if($peizhicqssc=="1"){
			            echo "\"<li><a id=\\\"a2\\\"  uri=\\\"2\\\" target=\\\"mainFrame\\\" onclick=\\\"onCK(2)\\\">重慶時時彩</a></li>\"".",";
						}
						 if($peizhijxssc=="1"){
						echo "\"<li><a id=\\\"a8\\\"  uri=\\\"7\\\" target=\\\"mainFrame\\\" onclick=\\\"onCK(7)\\\">极速时时彩</a></li>\"".",";
						}
						 if($peizhixjssc=="1"){
						echo "\"<li><a id=\\\"a11\\\"  uri=\\\"11\\\" target=\\\"mainFrame\\\" onclick=\\\"onCK(11)\\\">新疆時時彩</a></li>\"".",";
						}
						 if($peizhitjssc=="1"){
						echo "\"<li><a id=\\\"a12\\\"  uri=\\\"12\\\" target=\\\"mainFrame\\\" onclick=\\\"onCK(12)\\\">天津時時彩</a></li>\"".",";
						}
						 if($peizhipk10=="1"){
			           echo "\"<li><a id=\\\"a3\\\"  uri=\\\"3\\\" target=\\\"mainFrame\\\" onclick=\\\"onCK(3)\\\">北京赛车PK10</a></li>\"".",";
					   }
					    if($peizhinc=="1"){
						echo "\"<li style=\\\"border-bottom:none;\\\"><a id=\\\"a10\\\"  uri=\\\"10\\\" target=\\\"mainFrame\\\" onclick=\\\"onCK(10)\\\">幸运农场</a></li>\"".",";
						}
					    if($peizhijsyxx=="1"){
                       echo "\"<li><a id=\\\"a4\\\"  uri=\\\"4\\\" target=\\\"mainFrame\\\" onclick=\\\"onCK(4)\\\">吉林鱼虾蟹</a></li>\"".",";
					   }
					    if($peizhijssz=="1"){
                       echo "\"<li><a id=\\\"a5\\\"  uri=\\\"5\\\" target=\\\"mainFrame\\\" onclick=\\\"onCK(5)\\\">吉林快3</a></li>\"".",";
					   }
					    if($peizhikl8=="1"){
                       echo "\"<li><a id=\\\"a6\\\"  uri=\\\"6\\\" target=\\\"mainFrame\\\" onclick=\\\"onCK(6)\\\">快樂8</a></li>\"".",";
					   }
					      if($peizhixyft=="1"){
						
						echo "\"<li><a id=\\\"a8\\\"  uri=\\\"8\\\" target=\\\"mainFrame\\\" onclick=\\\"onCK(8)\\\">极速赛车</a></li>\"".",";
						}
						?>
						
						"</ul>",
						
					"</div>"];
					
					

/*function onMenu(){
$("#bankLi-down").show();
};

function onMenuOut(){
//
};
*/

function onCK(v){
//alert(v);
$("#bankLi-down").hide();
window.frames['topFrame'].SubonCK(v)

return false;

};



             
</script>

<script src="js/Forbid.js" type="text/javascript"></script>
<script language="javascript" src="js/m.old-index.js" type="text/javascript"></script>
</HEAD>	
<frameset id="logOutForms" border="0" cols="*" frameborder="NO" framespacing="0" rows="89,*,0">
    <frame  id="topFrame" name="topFrame" noresize="noresize" scrolling="NO" src="user/Top.php" title="topFrame">
    <frameset border="0" cols="241,*" frameborder="NO" framespacing="0">
        <frame name="leftFrame" id="leftFrame" noresize="noresize" src="user/left.php?LT=1" title="leftFrame">
        <frame name="mainFrame" id="mainFrame" src="user/sGame_sm_cq.php?g=g10" title="mainFrame" scrolling="auto">
    </frameset>
<frame src="UntitledFrame-1"></frameset>
<noframes>
</noframes>
</HTML>