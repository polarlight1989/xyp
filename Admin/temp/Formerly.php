<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $ConfigModel,$Users;
markPos("后台-实時滚球");
if ($Users[0]['g_login_id'] != 89) 
	exit;



?>

<html>
<head><title>

</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Css/Common.css" rel="stylesheet" type="text/css" /><link href="/Css/Style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/Common.js"></script>
<script type="text/javascript" src="/js/PublicData.js"></script>
<script type="text/javascript" src="/js/Forbid.js"></script>
<script type="text/javascript" src="/Admin/temp/js/Formerly.js"></script>

</head>
<body>
<table border="0" cellspacing="0" cellpadding="0" class="Main m_1">
    <tr>
        <td class="Main_top_left"></td>
        <td background="/Css/tab_05.gif">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="20" align="right"><img style="margin-right:5px" src="/Css/tb.gif" width="16" height="16" alt="" /></td>
                    <td class="Main_Title">即時滾單</td>
                    <td width="250" align="right">
                    
                    會員帳號：<input type="text" id="member" style="position:relative;top:1px;width:120px" />
                    </td>
                    <td width="150" align="right">
                        <span id="refreshTime" class="blue">加载中...</span>
                        <select style="position:relative;top:1px" id="_refreshTime" onChange="LoadRefreshTime()">
                            <option selected="selected" value="10">10秒</option>
                            <option value="20">20秒</option>
                            <option value="25">30秒</option>
                            <option value="40">30秒</option>
                            <option value="50">40秒</option>
                            <option value="60">50秒</option>
                            <option value="99">60秒</option>
                        </select>
                    </td>
                </tr>
            </table>
        </td>
        <td class="Main_top_right"></td>
    </tr>
    <tr>
        <td class="Main_left"></td>
        <td class="Main_conter">
        <!-- strat -->
            <table id="showGD" border="0" cellpadding="0" cellspacing="0" width="98%">
	<tr>
		<td valign="top" width="60%">
                        <table border="0" cellspacing="" cellpadding="0" class="Man_Conter az">
                            <tr class="Conter_top">
                                <td width="18%">註單號/時間</td>
                                <td width="15%">類型</td>
                                <td width="5%">帳號</td>
                                <td>明細</td>
                                <td>會員下註</td>
                                <td>代理</td>
                                <td>總代理</td>
                                <td>股東</td>
                                <td>分公司</td>
                                <td>總監</td>
                            </tr>
                            <tbody id="ct1"></tbody>
                        </table>
                    </td>
		<td id="memberID" valign="top" width="40%" style="display:none">
                        <!--<table border="0" cellspacing="" cellpadding="0" class="Man_Conter az">
                            <tr class="Conter_top">
                                <td>註單號/時間</td>
                                <td>類型</td>
                                <td>帳號</td>
                                <td>明細</td>
                                <td>註額</td>
                            </tr>
                            <tbody id="ct2"></tbody>
                        </table>-->
                    </td>
	</tr>
</table>

        <!-- end -->
        </td>
        <td class="Main_right" width="5"></td>
    </tr>
    <tr>
        <td class="Main_bottom_left"></td>
        <td background="/Css/tab_19.gif" align="center"></td>
        <td class="Main_bottom_right"></td>
    </tr>
</table>
</body>
</html>
