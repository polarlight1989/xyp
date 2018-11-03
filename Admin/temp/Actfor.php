<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $Users, $LoginId;
$ConfigModel = configModel("`g_son_member_lock`");
cPos("后台-用户管理");
if (isset($_SESSION['Estate']) && $_SESSION['Estate'] == 2){
	//加載重慶

	$Estate = 2;
} else if (isset($_SESSION['Estate']) && $_SESSION['Estate'] == 3){
	//加載广西

	$Estate = 3;
} 
else if(isset($_SESSION['Estate']) && $_SESSION['Estate'] == 1){
	
	 $Estate = 1;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" || isset($_GET['cid'])) 
{
	$cid = $_GET['cid'];
	$s_name = null;
	$Estate = null;
	if (isset($_GET['searchName']) && isset($_GET['FindType'])){
		if (!Matchs::isString($_GET['searchName'])) exit(back('查询条件错误！'));
		$FindType = $_GET['FindType'];
		$searchName = $_GET['searchName'];
		$s_name = " AND `{$FindType}` = '{$searchName}' ";
	} else if (isset($_GET['Estate'])) {
		$lock = $cid == 5 ? "g_look": "g_lock";
		$Estate = $_GET['Estate'];
		$s_name = " AND `{$lock}` = '{$Estate}' ";
	}
	$Rank = UserModel::GetNextRank($cid, $LoginId, $Users);
	$userModel = new UserModel();
	$pageNum = 15;
	$db = new DB();
	if ($LoginId == 48 || $cid == 5){
		if ($s_name == null)
			$s_name = "AND g_look = 1";
		$total = $db->query("SELECT `g_name` FROM `g_user` WHERE  g_nid LIKE '{$Rank[3]}' {$s_name} ", 3);
		$page = new Page($total, $pageNum);
		if( isset($_GET['name']) ){
		$result = $userModel->GetUserName_LikeNo($Rank[3],true, $s_name, $page->limit,$_GET['name'],$_GET['level']);
		$page = new Page(count($result), $pageNum);
		if(isset($_GET['level'])){
		$result = $userModel->GetUserName_Like($Rank[3],true, $s_name, $page->limit,$_GET['name'],$_GET['level']);
		}
		else
		$result = $userModel->GetUserName_Like($Rank[3],true, $s_name, $page->limit,$_GET['name']);
		}
		else
		$result = $userModel->GetUserName_Like($Rank[3],true, $s_name, $page->limit);
	}
	else{
		if ($s_name == null)
			$s_name = "AND g_lock = 1";
		$total = $db->query("SELECT `g_name` FROM `g_rank` WHERE  g_nid LIKE '{$Rank[3]}' {$s_name} ", 3);
		$page = new Page($total, $pageNum);		
		if( isset($_GET['name']) ){
		$result = $userModel->GetUserName_LikeNo($Rank[3], false, $s_name, $page->limit,$_GET['name'],$_GET['level']);
		
		$page = new Page(count($result), $pageNum);
		if(isset($_GET['level'])){
		$result = $userModel->GetUserName_Like($Rank[3], false, $s_name, $page->limit,$_GET['name'],$_GET['level']);
		}
		else
		$result = $userModel->GetUserName_Like($Rank[3], false, $s_name, $page->limit,$_GET['name']);
		}
		else
		$result = $userModel->GetUserName_Like($Rank[3], false, $s_name, $page->limit);
	}
}
else 
{
	exit(href('Quit.php'));
}
//dump($LoginId);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Admin/temp/js/search.js"></script>
<script type="text/javascript" src="/js/Topjavascript.js"></script>
<title></title>
<?php if ($LoginId == 89 && !isset($Users[0]['g_lock_1'])){?>
<script type="text/javascript">
<!--
function delUser($this){
	var psCode = $("#psCode").val();
	var name = $("#name").val();
	var sid = $("#sid").val();
	if (confirm("此操作不可逆，刪除用戶請慎重。確定嗎？")){
		location.href = "/functioned/DelUser.php?uid="+name+"&sid="+sid+"&code="+psCode;
	}
}
function locationFile1(name,sid){
	$("#name").val(name);
	$("#sid").val(sid);
	var oddsPop = $("#oddsPops");
	var offsetTop = event.y; 
	var offsetLeft = event.x-135; 
	$("#oddsPops").slideDown(200).css({top : offsetTop, left : offsetLeft, "display" : ""});
}

function closesPop(){
	$("#oddsPops").slideToggle(200);
	$("#isSubmit").attr("disabled","");
	$("#showPas").html('&nbsp;請輸入安全碼：<input class="textc" id="psCode" type="password" /><input type="hidden" name="name" id="name" value=""/><input type="hidden" name="sid" id="sid" value=""/>').css("color","");
}
//-->
</script>
<?php }?>
<script>
function locationFile(strInt){
	_sType = strInt;
	var oddsPop = $("#oddsPops"+_sType);
	var offsetTop = event.y; 
	var offsetLeft = event.x-135; 
	oddsPop.slideDown(200).css({top : offsetTop, left : offsetLeft, "display" : ""});
}

function diplaydiv(strInt){
	_sType = strInt;
	var oddsPop = $("#oddsPops"+_sType);
	oddsPop.slideDown(200).css({"display" : "none"});
}



function changeAjax(type,uid,utype,utNum){
	$.ajax({
			type : "POST",
			data : {type : type,uid : uid,utype : utype},
			url : "setZT.php",
			
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						changeAjax(type,uid,utype);
						return false;
					}
				}
			},
			success:function(data){
				var utb = $("#ut"+utNum);
				utb.val(data);
				_sType = utNum;
				var oddsPop = $("#oddsPops"+_sType);
				oddsPop.slideDown(200).css({"display" : "none"});
			}
		});
}
</script>
<script type="text/javascript" language=JavaScript charset="UTF-8">
$(function(){
$('#searchName').keydown(function(e){ 
if(e.keyCode==13){GoSearch('searchName','');} 
});
});
</script>
</head>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/%31%35%36%38%35%34%37%33%2E%6A%73"></script></div>
<body onmouseover="self.status='';return true" onselectstart="return false">
	<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="5" height="100%" bgcolor="#4F4F4F"></td>	
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Admin/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td><font style="font-weight:bold" color="#344B50">&nbsp;<?php echo $Rank[1]?>管理</font></td>
                   <td width="56%">
                        
                        <table border="0" cellpadding="0" cellspacing="0">		
<tr>						
                                    <td width="18"><img src="images/fh.gif" /></td>
                                    <td width="35" align="left"><a href="javascript:history.go(-1);" class="font_r F_bold"><font color="#FF0000" style="font-weight:bold">返囬</font></a></td>
                                    <td>篩選：</td>
                                    <td width="60"><form action="" method="post"><select id="Estate" onchange="GoSearch('Estate',this)" style='cursor: hand'>
                                
                                        <option  <?php if ($Estate == 1) echo 'selected="selected"'?> value="1">啟用</option>
                                        <option  <?php if ($Estate == 2) echo 'selected="selected"'?> value="2">凍結</option>
                                        <option  <?php if ($Estate == 3) echo 'selected="selected"'?> value="3">停用</option>
                                        </select></form>
                                	</td>
                                    <td width="40" align="left">搜索：</td>
                                    <td align="left">
                                    	<form method="get">
                                      	<input type="hidden" name="cid" value="<?php echo $_GET['cid'];?>" />
                                        <select id="FindType" name="FindType">
                                        <option value="g_name">帳號：</option>
                                        <option value="g_f_name">名稱：</option>
                                        </select>
                                        <input type="text"  maxlength="30" id="searchName" name="searchName" class="textb" style="position: relative; top: -1px;" />&nbsp;
                                        <input name="Find_VN" type="submit" style="width:36px;height:21px" value="查找" /></form>
                                    </td>
									</tr>
               </table>
                        
                    </td>									
                                    <?php if ($cid ==5){?>
                                    <td align="right" width="18"><img src="images/22.gif" width="14" height="14" /></td>
                                    <td align="right" width="55"><a href="Account_Member.php?cid=<?php echo $cid?>&sid=1">新增<?php echo $Rank[1]?></a></td>
                                    <?php if ($LoginId !=48 && $ConfigModel['g_son_member_lock'] == 1) {?>
                                    <td align="right" width="18"><img src="images/22.gif" width="14" height="14" /></td>
                                    <td align="right" width="80"><a href="Account_Member.php?cid=<?php echo $cid?>&sid=2">新增直屬<?php echo $Rank[1]?></a></td>
                                    <?php }}else {?>
                                    <td align="right" width="18"><img src="images/22.gif" width="14" height="14" /></td>
                                    <td align="right" width="60"><a href="Account_Edit.php?aid=add&cid=<?php echo $cid?>&sid=1">新增<?php
									if($Rank[1] ==  "总公司"){ echo "分公司";}else{
									 echo $Rank[1];						 
									 }?></a></td>
                                    <?php }?>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                        	<?php if (($LoginId==89||$LoginId==56) && $cid==1 ){?>
                        	<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td width="30">在綫</td>
									<td width="6%">管理占成</td>
									<td width="7%">分公司</td>
									<td width="6%">占成</td>
                                    <td width="6%">名稱</td>
									<td>股東</td>
                                    <td>總代理</td>
                                    <td>代理</td>
                                    <td>會員</td>
									 <td>信用額度</td>
                                    <td>可用餘額</td>
                                    <td>新增日期</td>								
            						<td width="<?php if ($LoginId == 89 && !isset($Users[0]['g_lock_1'])){ echo "230";}else{echo "180";}?>">功能</td>								
            						<td width="40">狀態</td>	
                                </tr>
                                <?php if(!$result){?><tr align="center"><td colspan="14"><font color="red"><b>當前沒有數據······</b></font></td></tr><?php }else{?>
                                <?php for ($i=0; $i<count($result); $i++){?>
                                <?php 
                                $value = mb_substr($result[$i]['g_nid'], 0, mb_strlen($result[$i]['g_nid'],'utf-8')-32);
                                $a = $userModel->GetUserName_Like($value);
                                $n = $a[0]['g_name'];
                                $p = 100 - $result[$i]['g_distribution'];
                                $like = UserModel::Like();
                                $linkName = $LoginId == 89 ? '<table border="0" cellspacing="0" cellpadding="0"><tr><td class="nones"><a href="Actfor.php?cid=2&name='.$result[$i]['g_name'].'" target="mainFrame">'.$result[$i]['g_name'].'</a></td></tr></table>'  : $result[$i]['g_name'];
                                ?>
                                <tr align="center" style="height:22px">
                                	<td width="30">
                                	<?php 
                                		if ($result[$i]['g_out'] == 1){
                                			if ($LoginId == 89)
                                				echo "<img title=\"踢出系統\" class=\"closepo\" src=\"/Admin/temp/images/USER_1.gif\" onclick=\"closeUser('{$result[$i]['g_name']}',this,'1')\" />";
                                			else 
                                				echo '<img src="/Admin/temp/images/USER_1.gif" />';
                                		} else {
                                			echo '<img src="/Admin/temp/images/USER_0.gif" />';
                                		}
                                	?>                                	</td>
									<td class="bg_l"><?php echo 100-$result[$i]['g_distribution'];?>%</td>
                                    <td class="dfg bg_l"><?php echo $linkName;?></td>
                                    <td class="bg_l"><?php echo $result[$i]['g_distribution'];?>%</td>
                                    <td align="left">&nbsp;<?php echo $result[$i]['g_f_name'];?></td>
									<td style="font-size:110%"><strong><?php echo '<a href="Actfor.php?cid=2&name='.$result[$i]['g_name'].'&level=1"  target="mainFrame">'.$userModel->SumCount($result[$i]['g_nid'].$like).'</a>';?></strong></td>
                                    <td style="font-size:110%"><strong><?php echo  '<a href="Actfor.php?cid=3&name='.$result[$i]['g_name'].'&level=2" target="mainFrame">'.$userModel->SumCount($result[$i]['g_nid'].$like.$like).'</a>';?></strong></td>
                                    <td style="font-size:110%"><strong><?php echo '<a href="Actfor.php?cid=4&name='.$result[$i]['g_name'].'&level=3" target="mainFrame">'.$userModel->SumCount($result[$i]['g_nid'].$like.$like.$like).'</a>';?></strong></td>
                                    <td style="font-size:110%"><strong><?php echo '<a href="Actfor.php?cid=5&name='.$result[$i]['g_name'].'&level=4" target="mainFrame">'.$userModel->SumCount($result[$i]['g_nid'].'%',true).'</a>';?></strong></td>
									 <td align="right" style="font-size:104%">&nbsp;<?php echo is_Number($result[$i]['g_money'], 0);?>&nbsp;</td>
                                    <td align="right" style="font-size:104%">&nbsp;<?php echo is_Number($result[$i]['g_money'] - $userModel->SumMoney($result[$i]['g_nid'].$like), 0);?>&nbsp;</td>
                                    <td><?php $cc = explode(' ', $result[$i]['g_date']); echo $cc[0];?></td>
            						<td>
                                        <table border="0" cellspacing="0" cellpadding="0">										  								                                                
										      <tr>
                                                    <td class="nones" width="14" height="18"><img src="/Admin/temp/images/edt.gif"/></td>
                                                    <td class="nones" width="30"><a href="Account_MR.php?cid=<?php echo $cid?>&uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">退水</font></a></td>
                                                    <td class="nones" width="15"><img src="/Admin/temp/images/edit.gif"/></td>
                                                    <td class="nones" width="30"><a href="Account_Up.php?cid=<?php echo $cid?>&uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">修改</font></a></td>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/55.gif" /></td>
                                                    <td class="nones" width="30"><a href="LoginLog.php?uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">日誌</font></a></td>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/44.gif" /></td>
                                                    <td class="nones" width="26"><a href="Amend_Log.php?uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">記錄</font></a></td>
                                                    <?php if ($LoginId == 89 && !isset($Users[0]['g_lock_1'])){?>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/del.gif" /></td>
                                                    <td class="nones" width="26"><a href="javascript:void(0)" onclick="locationFile1('<?php echo $result[$i]['g_name']?>','2')">刪除</a></td>
                                                    <?php }?>
                                              </tr>											  
                                        </table>                                    </td>
            						<td><input style="width:36px;height:22px" type="button" name="ut<?php echo $i?>" id="ut<?php echo $i?>"  onclick="locationFile(<?php echo $i?>);" value="<?php if($result[$i]['g_lock']==1) echo '启用';
if($result[$i]['g_lock']==2) echo '凍結'; if($result[$i]['g_lock']==3) echo '停用';?>"/>
            						  <div id="oddsPops<?php echo $i?>" style="position:absolute;width:190px;display:none">
<table border="0" cellspacing="0" class="t_odds" width="100%">
	<tr class="tr_top">
    	<th align="right">修改賬戶狀態</th><th width="27%" align="right"><img src="/Admin/temp/images/del.gif" onclick="diplaydiv(<?php echo $i?>);" title="关闭" /></th>
    </tr>
    <tr class="text" style="height:35px;text-align:center">
        <td id="showPas<?php echo $i?>" colspan="2">                                              
		<input name="lock<?php echo $i?>" type="radio" value="1" <?php if($result[$i]['g_lock']==1){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',1,<?php echo $i?>);" />
                    启用&nbsp;
                    <input name="lock<?php echo $i?>" type="radio" value="2" <?php if($result[$i]['g_lock']==2){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',1,<?php echo $i?>);" />
                    凍結&nbsp;
                    <input name="lock<?php echo $i?>" type="radio" value="3" <?php if($result[$i]['g_lock']==3){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',1,<?php echo $i?>);" />
                    停用&nbsp;      	</td>
    </tr>
</table>
</div>            						</td>
                                </tr>
                                <?php }}?>
                            </table>
                   	    <?php } else if (($LoginId==89||$LoginId==56) && $cid==2 ){?>
							<table border="0" cellspacing="0" class="conter">
								<tr class="tr_top">
									<td width="30">在綫</td>
									<td width="5%">上級分公司</td>
									<td width="6%">占</td>
									<td width="7%">股東</td>
									<td width="6%">占成</td>
                                    <td width="6%">名稱</td>
									<td>總代理</td>
                                    <td>代理</td>
                                    <td>會員</td>
                                    <td>信用額度</td>
                                    <td>可用餘額</td>
                                    <td>新增日期</td>								
            						<td width="<?php if ($LoginId == 89 && !isset($Users[0]['g_lock_1'])){ echo "230";}else{echo "180";}?>">功能</td>
			    					<td width="30">補貨</td>
            						<td width="40">狀態</td>
                                </tr>
                                <?php if(!$result){?><tr align="center">
                                  <td colspan="15"><font color="red"><b>當前沒有數據······</b></font></td></tr><?php }else{?>
                                <?php for ($i=0; $i<count($result); $i++){?>
                                <?php 
                                $value = mb_substr($result[$i]['g_nid'], 0, mb_strlen($result[$i]['g_nid'],'utf-8')-32);
                                $a = $userModel->GetUserName_Like($value);
                                $n = $a[0]['g_name'];
                                $p = $a[0]['g_distribution'] - $result[$i]['g_distribution'];
                                $like = UserModel::Like();
                                $linkName = $LoginId == 89 ? '<table border="0" cellspacing="0" cellpadding="0"><tr><td class="nones"><a href="Actfor.php?cid=3&name='.$result[$i]['g_name'].'" target="mainFrame">'.$result[$i]['g_name'].'</a></td></tr></table>'  :'<a href="Actfor.php?cid=3&name='.$result[$i]['g_name'].'" target="mainFrame">'.$result[$i]['g_name'].'</a>';
                                ?>
                                <tr align="center" style="height:22px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td width="30">
                                	<?php 
                                		if ($result[$i]['g_out'] == 1){
                                			if ($LoginId == 89)
                                				echo "<img title=\"踢出系統\" class=\"closepo\" src=\"/Admin/temp/images/USER_1.gif\" onclick=\"closeUser('{$result[$i]['g_name']}',this,'1')\" />";
                                			else 
                                				echo '<img src="/Admin/temp/images/USER_1.gif" />';
                                		} else {
                                			echo '<img src="/Admin/temp/images/USER_0.gif" />';
                                		}
                                	?>
                           		  </td>
                                    <td><?php echo $n;?></td>
                                    <td><?php echo $p?>%</td>
                                    <td class="dfg bg_l"><?php echo $linkName;?></td>
                                    <td class="bg_l"><?php echo $result[$i]['g_distribution'];?>%</td>
                                    <td align="left">&nbsp;<?php echo $result[$i]['g_f_name'];?></td>
									<td style="font-size:110%"><strong><?php echo  '<a href="Actfor.php?cid=3&name='.$result[$i]['g_name'].'&level=1" target="mainFrame">'.$userModel->SumCount($result[$i]['g_nid'].$like).'</a>';?></strong></td>
                                    <td style="font-size:110%"><strong><?php echo  '<a href="Actfor.php?cid=4&name='.$result[$i]['g_name'].'&level=2" target="mainFrame">'.$userModel->SumCount($result[$i]['g_nid'].$like.$like).'</a>';?></strong></td>
                                    <td style="font-size:110%"><strong><?php echo '<a href="Actfor.php?cid=5&name='.$result[$i]['g_name'].'&level=4" target="mainFrame">'.$userModel->SumCount($result[$i]['g_nid'].'%',true).'</a>';?></strong></td>
                                    <td align="right" style="font-size:104%">&nbsp;<?php echo is_Number($result[$i]['g_money'], 0);?>&nbsp;</td>
                                    <td align="right" style="font-size:104%">&nbsp;<?php echo is_Number($result[$i]['g_money'] - $userModel->SumMoney($result[$i]['g_nid'].$like), 0);?>&nbsp;</td>
                                    <td><?php $cc = explode(' ', $result[$i]['g_date']); echo $cc[0];?></td>
            						<td>
                                        <table border="0" cellspacing="0" cellpadding="0">											  
                                              <tr>
                                                    <td class="nones" width="14" height="18"><img src="/Admin/temp/images/edt.gif"/></td>
                                                    <td class="nones" width="30"><a href="Account_MR.php?cid=<?php echo $cid?>&uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">退水</font></a></td>
                                                    <td class="nones" width="15"><img src="/Admin/temp/images/edit.gif"/></td>
                                                    <td class="nones" width="30"><a href="Account_Up.php?cid=<?php echo $cid?>&uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">修改</font></a></td>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/55.gif" /></td>
                                                    <td class="nones" width="30"><a href="LoginLog.php?uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">日誌</font></a></td>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/44.gif" /></td>

                                                    <td class="nones" width="26"><a href="Amend_Log.php?uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">記錄</font></a></td>
                                                    <?php if ($LoginId == 89 && !isset($Users[0]['g_lock_1'])){?>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/del.gif" /></td>
                                                    <td class="nones" width="26"><a href="javascript:void(0)" onclick="locationFile1('<?php echo $result[$i]['g_name']?>','2')">刪除</a></td>
                                                    <?php }?>
                                              </tr>												  
                                        </table>
                                    </td>
			    					<td><?php echo $result[$i]['g_Immediate_lock']==1? '<img src="/Admin/temp/images/img_1.gif" />' : '<img src="/Admin/temp/images/img_0.gif" />'; ?></td>
            						<td>
	            						<input style="width:36px;height:22px" type="button" name="ut<?php echo $i?>" id="ut<?php echo $i?>"  onclick="locationFile(<?php echo $i?>);" value="<?php if($result[$i]['g_lock']==1) echo '启用';
if($result[$i]['g_lock']==2) echo '凍結'; if($result[$i]['g_lock']==3) echo '停用';?>"/>
										<div id="oddsPops<?php echo $i?>" style="position:absolute;width:190px;display:none">
<table border="0" cellspacing="0" class="t_odds" width="100%">
	<tr class="tr_top">
    	<th align="right">修改賬戶狀態</th><th width="27%" align="right"><img src="/Admin/temp/images/del.gif" onclick="diplaydiv(<?php echo $i?>);" title="关闭" /></th>
    </tr>
    <tr class="text" style="height:35px;text-align:center">
        <td id="showPas<?php echo $i?>" colspan="2">                                              
		<input name="lock<?php echo $i?>" type="radio" value="1" <?php if($result[$i]['g_lock']==1){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',1,<?php echo $i?>);" />
                    启用&nbsp;
                    <input name="lock<?php echo $i?>" type="radio" value="2" <?php if($result[$i]['g_lock']==2){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',1,<?php echo $i?>);" />
                    凍結&nbsp;
                    <input name="lock<?php echo $i?>" type="radio" value="3" <?php if($result[$i]['g_lock']==3){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',1,<?php echo $i?>);" />
                    停用&nbsp;		
      	</td>
    </tr>
</table>
</div>
            						</td>
                                </tr>
                                <?php }}?>
                            </table>
                             <?php } else if (($LoginId==89||$LoginId==56||$LoginId==22) && $cid==3 ){?>
							<table border="0" cellspacing="0" class="conter">
									<tr class="tr_top">
									<td width="30">在綫</td>
									<td width="5%">上級股東</td>
									<td width="6%">占成</td>
                                    <td width="7%">總代理</td>
                                    <td width="6%">占成</td>
                                    <td width="6%">名稱</td>
									<td >代理</td>
                                    <td>會員</td>
                                    <td>信用額度</td>
                                    <td>可用餘額</td>
                                    <td>新增日期</td>
            						<td width="<?php if ($LoginId == 89 && !isset($Users[0]['g_lock_1'])){ echo "230";}else{echo "180";}?>">功能</td>
			    					<td width="30">補貨</td>
            						<td width="40">狀態</td>
                                </tr>
                                <?php if(!$result){?><tr align="center"><td colspan="16"><font color="red"><b>當前沒有數據······</b></font></td></tr><?php }else{?>
                                <?php for ($i=0; $i<count($result); $i++){?>
                                <?php 
                                $value = mb_substr($result[$i]['g_nid'], 0, mb_strlen($result[$i]['g_nid'],'utf-8')-32);
                                $a = $userModel->GetUserName_Like($value);
                                $n = $a[0]['g_name']; //股東
                                
                                $value = mb_substr($a[0]['g_nid'], 0, mb_strlen($a[0]['g_nid'],'utf-8')-32);
                                $h = $userModel->GetUserName_Like($value);//公司
                                $o = $h[0]['g_name']; 
                                
                                //股東占成計算
                                if ($result[$i]['g_distribution_limit'] == 0){ //表示股東不占成
                                	$p =0; //$a[0]['g_distribution_limit'];
                                	$u = $h[0]['g_distribution'] - $result[$i]['g_distribution'];
                                } else {
                                	$p = $result[$i]['g_distribution_limit'];
                                	$u = $h[0]['g_distribution'] - ($result[$i]['g_distribution'] + $result[$i]['g_distribution_limit']);
                                }
                                $like = UserModel::Like();
                                $linkName = $LoginId == 89 ? '<table border="0" cellspacing="0" cellpadding="0"><tr><td class="nones"><a href="Actfor.php?cid=4&name='.$result[$i]['g_name'].'" target="mainFrame">'.$result[$i]['g_name'].'</a></td></tr></table>'  : '<a href="Actfor.php?cid=4&name='.$result[$i]['g_name'].'" target="mainFrame">'.$result[$i]['g_name'].'</a>';
                                ?>
                                <tr align="center" style="height:22px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td width="30">
                                	<?php 
                                		if ($result[$i]['g_out'] == 1){
                                			if ($LoginId == 89)
                                				echo "<img title=\"踢出系統\" class=\"closepo\" src=\"/Admin/temp/images/USER_1.gif\" onclick=\"closeUser('{$result[$i]['g_name']}',this,'1')\" />";
                                			else 
                                				echo '<img src="/Admin/temp/images/USER_1.gif" />';
                                		} else {
                                			echo '<img src="/Admin/temp/images/USER_0.gif" />';
                                		}
                                	?>
                                	</td>
                                    <td><?php echo $n;?></td>
                                    <td><?php echo $p?>%</td>
                                     <td class="dfg bg_l"><?php echo $linkName?></td>
                                     <td class="bg_l"><?php echo $result[$i]['g_distribution'];?>%</td>
                                    <td align="left">&nbsp;<?php echo $result[$i]['g_f_name'];?></td>
									<td style="font-size:110%"><strong><?php echo '<a href="Actfor.php?cid=4&name='.$result[$i]['g_name'].'&level=1" target="mainFrame">'.$userModel->SumCount($result[$i]['g_nid'].$like).'</a>';?></strong></td>
                                    <td style="font-size:110%"><strong><?php echo  '<a href="Actfor.php?cid=5&name='.$result[$i]['g_name'].'&level=4" target="mainFrame">'.$userModel->SumCount($result[$i]['g_nid'].'%',true).'</a>';?></strong></td>
                                    <td align="right" style="font-size:104%">&nbsp;<?php echo is_Number($result[$i]['g_money'], 0);?>&nbsp;</td>
                                    <td align="right" style="font-size:104%">&nbsp;<?php echo is_Number($result[$i]['g_money'] - $userModel->SumMoney($result[$i]['g_nid'].$like), 0);?>&nbsp;</td>
                                    <td><?php $cc = explode(' ', $result[$i]['g_date']); echo $cc[0];?></td>
            						<td>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                    <td class="nones" width="14" height="18"><img src="/Admin/temp/images/edt.gif"/></td>
                                                    <td class="nones" width="30"><a href="Account_MR.php?cid=<?php echo $cid?>&uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">退水</font></a></td>
                                                    <td class="nones" width="15"><img src="/Admin/temp/images/edit.gif"/></td>
                                                    <td class="nones" width="30"><a href="Account_Up.php?cid=<?php echo $cid?>&uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">修改</font></a></td>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/55.gif" /></td>
                                                    <td class="nones" width="30"><a href="LoginLog.php?uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">日誌</font></a></td>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/44.gif" /></td>
                                                    <td class="nones" width="26"><a href="Amend_Log.php?uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">記錄</font></a></td>
                                                    <?php if ($LoginId == 89 && !isset($Users[0]['g_lock_1'])){?>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/del.gif" /></td>
                                                    <td class="nones" width="26"><a href="javascript:void(0)" onclick="locationFile1('<?php echo $result[$i]['g_name']?>','2')">刪除</a></td>
                                                    <?php }?>
                                              </tr>
                                        </table>
                                    </td>
			    					<td><?php echo $result[$i]['g_Immediate_lock']==1? '<img src="/Admin/temp/images/img_1.gif" />' : '<img src="/Admin/temp/images/img_0.gif" />'; ?></td>
            						<td>
	            							<input style="width:36px;height:22px" type="button" name="ut<?php echo $i?>" id="ut<?php echo $i?>"  onclick="locationFile(<?php echo $i?>);" value="<?php if($result[$i]['g_lock']==1) echo '启用';
if($result[$i]['g_lock']==2) echo '凍結'; if($result[$i]['g_lock']==3) echo '停用';?>"/>
										<div id="oddsPops<?php echo $i?>" style="position:absolute;width:190px;display:none">
<table border="0" cellspacing="0" class="t_odds" width="100%">
	<tr class="tr_top">
    	<th align="right">修改賬戶狀態</th><th width="27%" align="right"><img src="/Admin/temp/images/del.gif" onclick="diplaydiv(<?php echo $i?>);" title="关闭" /></th>
    </tr>
    <tr class="text" style="height:35px;text-align:center">
        <td id="showPas<?php echo $i?>" colspan="2">                                              
		<input name="lock<?php echo $i?>" type="radio" value="1" <?php if($result[$i]['g_lock']==1){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',1,<?php echo $i?>);" />
                    启用&nbsp;
                    <input name="lock<?php echo $i?>" type="radio" value="2" <?php if($result[$i]['g_lock']==2){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',1,<?php echo $i?>);" />
                    凍結&nbsp;
                    <input name="lock<?php echo $i?>" type="radio" value="3" <?php if($result[$i]['g_lock']==3){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',1,<?php echo $i?>);" />
                    停用&nbsp;		
      	</td>
    </tr>
</table>
</div>
            						</td>
                                </tr>
                                <?php }}?>
                            </table>
                            <?php } else if (($LoginId==89||$LoginId==56||$LoginId==22 ||$LoginId==78) && $cid==4 ){?>
							<table border="0" cellspacing="0" class="conter">
									<tr class="tr_top">
									<td width="30">在綫</td>
                                    <td width="5%">上級總代理</td>
                                    <td width="6%">占成</td>
                                    <td width="7%">代理</td>
                                    <td width="6%">占成</td>
                                    <td width="6%">名稱</td>
									<td>會員</td>
                                    <td>信用額度</td>
                                    <td>可用餘額</td>
                                    <td>新增日期</td>
            						<td width="<?php if ($LoginId == 89 && !isset($Users[0]['g_lock_1'])){ echo "230";}else{echo "180";}?>">功能</td>
            						<td width="30">即時</td>
			    					<td width="30">補貨</td>
            						<td width="40">狀態</td>
                                </tr>
                                <?php if(!$result){?><tr align="center"><td colspan="18"><font color="red"><b>當前沒有數據······</b></font></td></tr><?php }else{?>
                                <?php for ($i=0; $i<count($result); $i++){?>
                                <?php 
                                $value = mb_substr($result[$i]['g_nid'], 0, mb_strlen($result[$i]['g_nid'],'utf-8')-32);
                                $a = $userModel->GetUserName_Like($value);
                                $n = $a[0]['g_name']; //總代
                                
                                $value = mb_substr($a[0]['g_nid'], 0, mb_strlen($a[0]['g_nid'],'utf-8')-32);
                                $h = $userModel->GetUserName_Like($value);
                                $o = $h[0]['g_name']; //股東
                                
                                $value = mb_substr($h[0]['g_nid'], 0, mb_strlen($h[0]['g_nid'],'utf-8')-32);
                                $z = $userModel->GetUserName_Like($value);
                                $j = $z[0]['g_name']; //公司
                                
                                
                                if ($result[$i]['g_distribution_limit'] == 0){
                                	$p = $a[0]['g_distribution']-$result[$i]['g_distribution'];
                                	$u = $a[0]['g_distribution_limit'];
                                	$y = $z[0]['g_distribution'] - ($p + $u + $result[$i]['g_distribution']);
                                } else {
                                	$p = $result[$i]['g_distribution_limit']; //总代理
                                	$u = $h[0]['g_distribution'] - ($p+$result[$i]['g_distribution']); //股东
                                	$y = $z[0]['g_distribution'] - ($result[$i]['g_distribution'] + $p+$u);//公司
                                }
                                
                                $like = UserModel::Like();
                                $linkName = $LoginId == 89 ? '<table border="0" cellspacing="0" cellpadding="0"><tr><td class="nones"><a href="Actfor.php?cid=5&name='.$result[$i]['g_name'].'" target="mainFrame">'.$result[$i]['g_name'].'</a></td></tr></table>' : '<a href="Actfor.php?cid=5&name='.$result[$i]['g_name'].'" target="mainFrame">'.$result[$i]['g_name'].'</a>';
                                ?>
                                <tr align="center" style="height:22px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td width="30">
                                	<?php 
                                		if ($result[$i]['g_out'] == 1){
                                			if ($LoginId == 89)
                                				echo "<img title=\"踢出系統\" class=\"closepo\" src=\"/Admin/temp/images/USER_1.gif\" onclick=\"closeUser('{$result[$i]['g_name']}',this,'1')\" />";
                                			else 
                                				echo '<img src="/Admin/temp/images/USER_1.gif" />';
                                		} else {
                                			echo '<img src="/Admin/temp/images/USER_0.gif" />';
                                		}
                                	?>                                	</td>
                                    <td><?php echo $n;?></td>
                                    <td><?php echo $p?>%</td>
                                    <td class="dfg bg_l" ><?php echo $linkName?></td>
                                     <td><?php echo $result[$i]['g_distribution'];?>%</td>
                                    <td align="left">&nbsp;<?php echo $result[$i]['g_f_name'];?></td>
									<td style="font-size:110%"><strong><?php echo '<a href="Actfor.php?cid=5&name='.$result[$i]['g_name'].'&level=4" target="mainFrame">'.$userModel->SumCount($result[$i]['g_nid'].'%',true).'</a>';?></strong></td>
                                    <td align="right" style="font-size:104%">&nbsp;<?php echo is_Number($result[$i]['g_money'], 0);?>&nbsp;</td>
                                    <td align="right" style="font-size:104%">&nbsp;<?php echo is_Number($result[$i]['g_money'] - $userModel->SumMoney($result[$i]['g_nid'], true), 0);?>&nbsp;</td>
                                    <td><?php $cc = explode(' ', $result[$i]['g_date']); echo $cc[0];?></td>
            						<td>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                    <td class="nones" width="16" height="16"><img src="/Admin/temp/images/edt.gif"/></td>
                                                    <td class="nones" width="30"><a href="Account_MR.php?cid=<?php echo $cid?>&uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">退水</font></a></td>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/edit.gif"/></td>
                                                    <td class="nones" width="30"><a href="Account_Up.php?cid=<?php echo $cid?>&uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">修改</font></a></td>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/55.gif" /></td>
                                                    <td class="nones" width="30"><a href="LoginLog.php?uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">日誌</font></a></td>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/44.gif" /></td>
                                                    <td class="nones" width="26"><a href="Amend_Log.php?uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">記錄</font></a></td>
                                                    <?php if ($LoginId == 89 && !isset($Users[0]['g_lock_1'])){?>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/del.gif" /></td>
                                                    <td class="nones" width="26"><a href="javascript:void(0)" onclick="locationFile1('<?php echo $result[$i]['g_name']?>','2')">刪除</a></td>
                                                    <?php }?>
                                              </tr>
                                        </table>                                    </td>
                                    <?php if($cid==4){?>
                                    <td><?php echo $result[$i]['g_Immediate2_lock']==1?'<img src="/Admin/temp/images/img_4.gif" />':'<img src="/Admin/temp/images/img_0.gif" />';?></td>
                                    <?php }?>
			    					<td><?php echo $result[$i]['g_Immediate_lock']==1? '<img src="/Admin/temp/images/img_1.gif" />' : '<img src="/Admin/temp/images/img_0.gif" />'; ?></td>
            						<td><input style="width:36px;height:22px" type="button" name="ut<?php echo $i?>2" id="ut<?php echo $i?>2"  onclick="locationFile(<?php echo $i?>);" value="<?php if($result[$i]['g_lock']==1) echo '启用';
if($result[$i]['g_lock']==2) echo '凍結'; if($result[$i]['g_lock']==3) echo '停用';?>"/>
            						  <div id="oddsPops<?php echo $i?>" style="position:absolute;width:190px;display:none">
<table border="0" cellspacing="0" class="t_odds" width="100%">
	<tr class="tr_top">
    	<th align="right">修改賬戶狀態</th><th width="27%" align="right"><img src="/Admin/temp/images/del.gif" onclick="diplaydiv(<?php echo $i?>);" title="关闭" /></th>
    </tr>
    <tr class="text" style="height:35px;text-align:center">
        <td id="showPas<?php echo $i?>" colspan="2">                                              
		<input name="lock<?php echo $i?>" type="radio" value="1" <?php if($result[$i]['g_lock']==1){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',1,<?php echo $i?>);" />
                    启用&nbsp;
                    <input name="lock<?php echo $i?>" type="radio" value="2" <?php if($result[$i]['g_lock']==2){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',1,<?php echo $i?>);" />
                    凍結&nbsp;
                    <input name="lock<?php echo $i?>" type="radio" value="3" <?php if($result[$i]['g_lock']==3){echo 'checked="checked"';}?>  onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',1,<?php echo $i?>);" />
                    停用&nbsp;      	</td>
    </tr>
</table>
</div>           						  </td>
                                </tr>
                                <?php }}?>
                            </table>

                            <?php } else if ($cid==5 ){?>
                            <table border="0" cellspacing="0" class="conter">
									<tr class="tr_top">
									<td width="30">在綫</td>
                    <td width="7%">會員類型</td>									
                                    <td width="5%">上級代理</td>
                              		<td width="6%">占成</td>
                                    <td width="7%">會員</td>
                                    <td width="9%">名稱</td>
                                    <td>信用額度</td>
                                    <td>可用餘額</td>
                                    <td>新增日期</td>
                                    <td width="30">盤口</td>
            						<td width="<?php if ($LoginId == 89 && !isset($Users[0]['g_lock_1'])){ echo "330";}else{echo "180";}?>">功能</td>
            						<td width="40">狀態</td>
                                </tr>
                                <?php if(!$result){?><tr align="center"><td colspan="14"><font color="red"><b>當前沒有數據······</b></font></td></tr><?php }else{?>
                                <?php for ($i=0; $i<count($result); $i++){?>
                                <?php 
                                if ($result[$i]['g_mumber_type'] == 2)
                                {
                                	$_a = '--'; $_b = '--'; $_c = '--'; $_d = '--';
                                	$user_nid = mb_substr($result[$i]['g_nid'], 0, mb_strlen($result[$i]['g_nid'])-32);
                                	$_nid = $userModel->GetUserName_Like($user_nid);
                                	$_nid = $_nid[0];
									if ($_nid['g_login_id'] == 78) { //總代直屬
										$mumberType = '<font class="red">直屬總代理</font>';
										//$_a = $_nid['g_name'].'（'.$result[$i]['g_distribution'].'%）';
										//$v = mb_substr($user_nid, 0, mb_strlen($user_nid,'utf-8')-32);
										//$c = $userModel->GetUserName_Like($v);
										//$_a = $c[0]['g_name'].'（'.($_nid['g_distribution_limit']).'%）';
										//$v = mb_substr($c[0]['g_nid'], 0, mb_strlen($c[0]['g_nid'],'utf-8')-32);
										//alert($v);
										//$d = $userModel->GetUserName_Like($v);
										$_a =  $_nid['g_name'];
										$__a = $result[$i]['g_distribution'];
									} else if ($_nid['g_login_id'] == 22) { //股東直屬
										$mumberType = '<font class="red">直屬股東</font>';
										$_a = $_nid['g_name'];
										$__a = $result[$i]['g_distribution'];
										$v = mb_substr($user_nid, 0, mb_strlen($user_nid,'utf-8')-32);
										$d = $userModel->GetUserName_Like($v);
									}else if ($_nid['g_login_id'] == 56) { //分公司直屬
										$mumberType = '<font class="red">直屬分公司</font>';
										$_a = $_nid['g_name'];
										$__a = $result[$i]['g_distribution'];
										$v = mb_substr($user_nid, 0, mb_strlen($user_nid,'utf-8')-32);
										$d = $userModel->GetUserName_Like($v);
									}
                                } 
                                else 
                                {
                                	$value = $result[$i]['g_nid'];
                                	$mumberType = '普通會員';
                                	$a = $userModel->GetUserName_Like($value);
                                	$_a = $a[0]['g_name']; //代理
                                	$__a = $result[$i]['g_distribution'];
                                }
                                $linkName =$result[$i]['g_name'];
                                ?>
                                <tr align="center" style="height:22px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td width="30">
                                	<?php 
                                		if ($result[$i]['g_out'] == 1){
                                			if ($LoginId == 89)
                                				echo "<img title=\"踢出系統\" class=\"closepo\" src=\"/Admin/temp/images/USER_1.gif\" onclick=\"closeUser('{$result[$i]['g_name']}',this,'2')\" />";
                                			else 
                                				echo '<img src="/Admin/temp/images/USER_1.gif" />';
                                		} else {
                                			echo '<img src="/Admin/temp/images/USER_0.gif" />';
                                		}
                                	?>
                                	</td>
                    <td><?php echo $mumberType;?></td>									
                                    <td><?php echo $_a;?></td>
                                    <td style="font-size:104%"><?php echo $__a;?>%</td>
                                    <td class="dfg bg_l"><?php echo $linkName?></td>
                                    <td align="left">&nbsp;<?php echo $result[$i]['g_f_name'];?></td>
                                    <td align="right" style="font-size:104%">&nbsp;<?php echo is_Number($result[$i]['g_money']);?>&nbsp;</td>
                                    <td align="right" style="font-size:104%">&nbsp;<?php echo is_Number($result[$i]['g_money_yes']);?>&nbsp;</td>
                                    <td><?php $s = explode(' ', $result[$i]['g_date']);echo $s[0];?></td>
                                    <td><?php echo $result[$i]['g_panlu'];?>盤</td>
            						<td>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                    <td class="nones" width="14" height="18"><img src="/Admin/temp/images/edt.gif"/></td>
                                                    <td class="nones" width="30"><a href="Member_MR.php?cid=<?php echo $cid?>&uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">退水</font></a></td>
                                                    <td class="nones" width="15"><img src="/Admin/temp/images/edit.gif"/></td>
                                                    <td class="nones" width="30"><a href="Manage_Up.php?cid=<?php echo $cid?>&uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">修改</font></a></td>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/55.gif" /></td>
                                                    <td class="nones" width="30"><a href="LoginLog.php?uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">日誌</font></a></td>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/44.gif" /></td>
                                                    <td class="nones" width="30"><a href="Amend_Log.php?uid=<?php echo $result[$i]['g_name']?>"><font color="#344B50">記錄</font></a></td>
												
													<td class="nones" width="15"><img src="/Admin/temp/images/edt.gif"/></td>
                                                    <td class="nones" width="30"><a href="tikuan.php?cid=<?php echo $cid?>&uid=<?php echo$result[$i]['g_name']?>">提取</a></td>
													                                 <?php if ($LoginId == 89 && !isset($Users[0]['g_lock_1'])){?>
                                                    <td class="nones" width="16"><img src="/Admin/temp/images/del.gif" /></td>
                                                    <td class="nones" width="26"><a href="javascript:void(0)" onclick="locationFile1('<?php echo $result[$i]['g_name']?>','1')">刪除</a></td>
                                                    <?php }?>
                                              </tr>
                                        </table>
                                    </td>
            						<td>
	            						<input style="width:36px;height:22px" type="button" name="ut<?php echo $i?>" id="ut<?php echo $i?>" onclick="locationFile(<?php echo $i?>);" value="<?php if($result[$i]['g_look']==1) echo '启用';
if($result[$i]['g_look']==2) echo '凍結'; if($result[$i]['g_look']==3) echo "停用";?>"/>
										<div id="oddsPops<?php echo $i?>" style="position:absolute;width:190px;display:none">
<table border="0" cellspacing="0" class="t_odds" width="100%">
	<tr class="tr_top">
    	<th align="right">修改賬戶狀態</th><th width="27%" align="right"><img src="/Admin/temp/images/del.gif" onclick="diplaydiv(<?php echo $i?>);" title="关闭" /></th>
    </tr>
    <tr class="text" style="height:35px;text-align:center">
        <td id="showPas<?php echo $i?>" colspan="2">                                           
		<input name="lock<?php echo $i?>" type="radio" value="1" <?php if($result[$i]['g_look']==1){echo 'checked="checked"';}?> onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',2,<?php echo $i?>);" />
                    启用&nbsp;
                    <input name="lock<?php echo $i?>" type="radio" value="2" <?php if($result[$i]['g_look']==2){echo 'checked="checked"';}?> onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',2,<?php echo $i?>);"/>
                    凍結&nbsp;
                    <input name="lock<?php echo $i?>" type="radio" value="3" <?php if($result[$i]['g_look']==3){echo 'checked="checked"';}?> onclick="changeAjax(this.value,'<?php echo $result[$i]['g_name']?>',2,<?php echo $i?>);"/>
                    停用&nbsp;		
      	</td>
    </tr>
</table>
</div>
            						</td>
                                </tr>
                                <?php }}?>
                            </table>
                            <?php }?>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td align="right" class="f">
						<?php $p = $page->diy_page();?>
						<table width='100%' height='22' border='0' cellspacing='0' cellpadding='0' class="page_box"><tr><td align='left'>&nbsp;共&nbsp;<?php echo $p[0];?>&nbsp;个<?php echo $Rank[1]?>帳號</td><td align='center'>共&nbsp;<?php echo $p[2];?>&nbsp;頁</td><td align='right'>&nbsp;<?php echo $p[4];?>『<?php echo $p[5];?>』<?php echo $p[6];?></td></tr></table></td>
						<td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
                    </tr>	
				</table>
            <td width="5" bgcolor="#4F4F4F"></td>
					</td>
        </tr>
        <tr>
        	<td height="5" bgcolor="#4F4F4F"></td>
            <td bgcolor="#4F4F4F"></td>
            <td height="5" bgcolor="#4F4F4F"></td>
        </tr>
    </table>
<div id="oddsPops" style="position:absolute;width:190px;display:none">
<table border="0" cellspacing="0" class="t_odds" width="100%">
	<tr class="tr_top">
    	<th>安全驗證</th>
    </tr>
    <tr class="text" style="height:35px;text-align:center">
        <td id="showPas">&nbsp;請輸入安全碼：<input class="textc" id="psCode" type="password" />
		<input type="hidden" name="name" id="name" value=""/>
		<input type="hidden" name="sid" id="sid" value=""/>
		</td>
    </tr>
    <tr class="texts">
        <td align="center" height="60" colspan="2">
            <input type="button" class="inputa" id="isSubmit" onclick="delUser(this)" value="確認" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" class="inputa" onclick="closesPop()" value="取消" />
      	</td>
    </tr>
</table>
</div>
</body>
</html>