<!-- 側邊欄 begin--> 
    
<div data-role="panel" id="defaultpanel" data-theme="b">
<script type="text/javascript" language="javascript">
    function exitSystem() {
        if (confirm("確定要退出嗎？")) {
            //是
            window.top.location = "Quit.php";
            return true;
        }
        else {
            //否 
            return false;
        }
    }
</script>
    <div class="panel-content"> 
        <h3>個人中心</h3> 
        <a href="CreditInfo.php?r=07200413193683" data-transition="slide"><p>信用資料</p></a> 
        <a href="Report_JeuWJS.php?r=07200413193683" data-transition="slide" data-ajax="false"><p>下注明細</p></a>
        <a href="Report_JeuWeek.php?r=07200413193683" data-transition="slide" data-ajax="false"><p>結算報表</p></a>
        <a href="KaiJiang.php?r=07200413193683" data-transition="slide"><p>歷史開獎</p></a>
        <a href="rule.php" data-transition="slide"><p>玩法規則</p></a>
        <a href="AmendPwd.php?r=07200413193683" data-transition="slide"><p>修改密碼</p></a>
        <a href="LoginLog.php?r=07200413193683" data-transition="slide"><p>登陸日誌</p></a>
        <a href="Statement.php?r=07200413193683" data-transition="slide"><p>用戶協議</p></a>
        <a href="#" onClick="javascript:exitSystem();" data-transition="slide"><p>安全退出</p></a>
    </div> 
</div>
<!-- 側邊欄 end--> 