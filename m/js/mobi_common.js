
//page load finished
window.addEventListener('pageshow', onPageShow, false);
window.addEventListener('pagehide', onPageHide, false);
/*
window.onload = function () {
    //document.addEventListener("visibilitychange", onVisibilityChanged, false); //註冊前後臺切換事件
}
*/
//unload event
//window.onunload = function () {}
var F = {
    cntdown:'',
    open_phase: 0, //开奖奖期
    put_phase: 0,//下注奖期
    is_open :'n', //是否开盘
    k_id:"", //下注奖期id
    arr_id:[], //ball id
    ph_id:0//排行被選index
}
function onPageShow() {
    var now = $('#up_countdown').text();
    if (F.cntdown !="" && now == F.cntdown) {
        t_Update_Time = 3;
    }
}
function onPageHide() {
    F.cntdown = $('#up_countdown').text();
}
//处理后退事件
window.onpopstate = function (event) {
    //alert("location: " + document.location + ", state: " + JSON.stringify(event.state));
    var state = JSON.stringify(event.state);
    if (state != 'null') {
        //$.getScript(location.href);
        window.location = location.href;
        //$('#lottery_type').valueOf();
        //var url = $('#lottery_type option:selected').attr('url');
        //alert(location.href);

        //调用分析获取url地址参数
        var lottery_type = getQueryStringV(location.href, "lottery_type");
        var player_type = getQueryStringV(location.href, "player_type");
        $("#lottery_type option[value=" + lottery_type + "]").attr("selected", "selected");
        $("#player_type option[value=" + player_type + "]").attr("selected", "selected");
    }
};

//--修改下注数
F.updateBallsNum = function () {
    var n = $('div.on').length;
    if (n == 0) {
        $('b.f10').text('');
    }
    if (n > 0) {
        var txt = "[共<b class='hong'>" + n + "</b>注]";
        $('b.f10').html(txt);
    }
}

//<-- 选球事件处理
var P = {};
P.betPageEvent = function () {
    var atime, btime, ctime, startX, startY;
    $("div.liBox").touchstart(function (e) {
        atime = e.timeStamp
        var touch = e.originalEvent.touches[0];
        startX = touch.screenX;
        startY = touch.screenY;
        //this.name = '';
    });

    $("div.liBox").on("touchmove", function (e) {
        ctime = e.timeStamp
        var touch = e.originalEvent.touches[0];
        var x = touch.screenX - startX;
        var y = touch.screenY - startY;
        //if (x > 10 || y > 10) {
        //this.name = 'moving';
        //}
    });

    $("div.liBox").on("touchend", function (e) {
        if (F.is_open == 'n') {
            return;
        }
        var obj = $(this).children("label")[0];
        if ($(obj).text() == '-') {
            return;
        }
        btime = e.timeStamp;
        if ((ctime - atime) > 0) return; //判斷滑動中的誤選
        else {
            if ($(this).hasClass('on'))
                $(this).removeClass('on');
            else $(this).addClass('on');
            F.updateBallsNum();

        }
    });

};
//--end

function addEventAct(evt) {
    if (evt == 'showBetPage') {//显示下注页面
        $('.rightBtn').click(function (e) {
            if (F.is_open == 'n') {
                alert('已封盤!');
                return;
            }
            
            if ($("div.on").length == 0) {
                alert('請選擇球號後再下注!');
                return;
            }
            //$('[data-role="footer"][data-position="fixed"]').hide();
            showBetPage();

        });
      }
    if (evt == 'showOrHide') {//显示隐藏ball
          $("div.leftBtn").on("touchend", function () {
              showOrHideNode(this);
          });
      }
      if (evt == 'touched') {//选中ball
          P.betPageEvent();
      }
      if (evt == 'changeLotteryType') {//选择彩种
          $("#lottery_type").change(function () {
              gotoLotteryPage();
          }
          );
      }
      if (evt == 'changePlayerType') { //选择玩法
          $("#player_type").change(function () {
              gotoPlayerPage();
          }
          );
      }
      if (evt == 'changePaiHangTab') { //選擇排行的tab卡片
          $("#ballNav b").on("touchend", function (e) {
              changePaiHangTab(e);
          });
      }
  }
 
  function changePaiHangTab(e) {
    var dom = e.target;
    var index = $(dom).attr('index');
    F.ph_id = index;
    $("#ballNav b").removeClass('on');
    $(dom).addClass('on');
    //
    $("#ballNav").siblings(".paihang").hide();
    $("#ballNav").siblings(".paihang").eq(index).show();
}

function gotoLotteryPage() {//change彩种
    var lottery = $('#lottery_type').val();
    var url = $('#lottery_type option:selected').attr('url');
    window.location = url + "?lottery_type=" + lottery;
}

function isGetOpenLotteryRequest() {//是否需要请求开奖结果
    var n = F.put_phase - F.open_phase;
    if (n >= 2 && n < 10) {
        return true;
    }
    else
        return false;
 }
//更新倒計時
var ud_Timer = null;
var t_Update_Time = 51;
function UpdateTime() {
    if (t_Update_Time > 1) {
        t_Update_Time = t_Update_Time - 1;
        $("#up_countdown").text(t_Update_Time + "秒");
        
    } else {
        //$("#up_countdown").text ( "Loading...");
        t_Update_Time = 51;
        LoadOddsData();//请求赔率信息
    }

    ud_Timer = setTimeout("UpdateTime()", 1000);
}

function LoadLongData() { //ajax 读取长龙数据和冷热遗漏数据
    try {
        $.ajax({
            async: true,
            url:G.long_url,
            type: 'GET',
            dataType: 'json',
            cache: false,
            timeout: 5000,
            error: function (XMLHttpRequest, textStatus, errorThrown) { },
            success: function (jsonTxt) {
                try {
                    ParseJsonTxt(jsonTxt);
                } catch (e) { }
            }
        })
    } catch (e) { }

}
var open_timer = null;
function LoadOpenLotteryData() {//ajax 读取开奖和其他数据
    try {
        $.ajax({
            async: true,
            url: G.open_url,
            type: 'GET',
            dataType: 'json',
            cache: false,
            timeout: 5000,
            error: function (XMLHttpRequest, textStatus, errorThrown) { },
            success: function (jsonTxt) {
                try {
                    //发送长龙排行请求
                    LoadLongData();
                    ParseJsonTxt(jsonTxt);
                } catch (e) { }
                if (isGetOpenLotteryRequest()) {
                    if (open_timer) {
                        clearTimeout(open_timer)
                        open_timer = null;
                    }
                    open_timer = setTimeout("LoadOpenLotteryData()", 3000);
                }
            }
        })
    } catch (e) { }

}

function LoadOddsData() {//ajax 读取赔率数据
    try {
        $.ajax({
            async: true,
            url: G.odds_url + "?" + G.ball_ids,
            type: 'GET',
            dataType: 'json',
            cache: false,
            timeout: 5000,
            error: function (XMLHttpRequest, textStatus, errorThrown) { },
            success: function (jsonTxt) {
                try {
                    ParseJsonTxt(jsonTxt);
                } catch (e) { }
                if (isGetOpenLotteryRequest()) {
                    LoadOpenLotteryData(); //下注期数>开奖期数+1,请求开奖结果
                }
            }
        })
    } catch (e) { }

   
}

//parse json data
/*
{"status":"1","error":"","qishu":"06","kaijiang":["05",3,13,18,11,8,15,20,12],"pl":{"11-245":1.983,"11-246":1.984,"12-247":1.983,"12-248":1.983,"13-249":1.983,"13-250":1.983,"80-137":1.983,"80-138":1.984}}
*/

function ParseJsonTxt(data) {
    var status = data.status;
    if (status == "2") { //login超时
        window.location.href = "/";
    }
    if (status == "3") { //未开盘
        var lottery = $('#lottery_type').val();
        var player = $('#player_type').val();
        window.location.href = "ClosedLottery.php?lottery_type=" + lottery +"&player_type=" + player;
    }
    if (status == "1") {
        if (data.open) {//开封盘flag
            F.is_open = data.open;
        }
        if (data.qishu) {//当前下注期数
            var qs = data.qishu;
            try {
                F.put_phase = parseInt(qs, 10);
            }
            catch (e) { }
            SetDataCurrentPhase(qs);
        }
        if (data.kaijiang) {//开奖结果和期数
            var arr_kj = data.kaijiang;
            var kjqs = arr_kj[0];
            try {
                F.open_phase = parseInt(kjqs, 10);
            }
            catch (e) { }
            var arr_rs = arr_kj.slice(1);
            SetDataDraw(kjqs, arr_rs);
        }
        if(data.credit)
        {
            SetDataCredit(data.credit); //可用额度
        }
        if (data.amount) {
            SetDataAmt(data.amount); //今日输赢
        }
        if (data.long) {//长龙排行
            SetDataLong(data.long);
        }
        if (data.k_id) { //當前獎期id
            F.k_id = data.k_id;
        }
        if (data.k_open_time) {//开奖时间
            SetDataOpenLotteryTime(data.k_open_time);
        }
        if (data.k_stop_time) { //封单时间 & 開獎時間
            SetDataCountDown(data.k_stop_time);
        }
        if (data.play_odds) {//每个玩法的赔率,格式84_27,1.987|84_28,1.988
            SetDataOdds(data.play_odds);           
        }
        if (data.ball_amount) { //玩法的下注额度大小,格式:113,10,5000|82,10,5000 玩法id,最小值,最大值
            SetDataBallAmt(data.ball_amount);
        }
        if(data.lryl)//冷热遗漏数据
        {
            var str_lryl = data.lryl;
            SetDataLRYL(str_lryl);
        }
        if (data.ph_title && data.ph_content)//出球排行
        {
            SetDataPaiHang(data.ph_title, data.ph_content);
        }

        if (data.k3Long)//k3近期結果排行
        {
            SetDataK3Long(data.k3Long);
        }

    }

}
function SetDataK3Long(arrData) {
    
    var htm = '	<article class="oh tc">';
    var len = arrData.length;
    for (var i = 0; i < len; i++) { 
        var arrItem = arrData[i].split(',');
        var qs = arrItem[0];
        var v1 = arrItem[1];
        var v2 = arrItem[2];
        var v3= arrItem[3];
        var vh = arrItem[4];
        var dx = arrItem[5];
        if(dx == '大') tmp = ' class = "hong" ';
        else tmp='';
        var msg = '<dd><span class="dib">' + qs + '期' + '</span><span><img src="images/k' + v1 + '.png" width="23" height="23"><img src="images/k' + v2 + '.png" width="23" height="23"><img src="images/k' + v3 + '.png" width="23" height="23"></span><span>' + vh + '</span><span ' + tmp + '>' + dx + '</span></dd>';
        htm += msg;
    }
    htm += '</article><div class="clear"></div>';
    if (len > 0)
        $("#k3long").html(htm);
    else
        $("#k3long").html();
}
function SetDataPaiHang(title, content) {
    var arrTitle = title.split('|'); //<b class="on">第一球</b>
    var hh = "";
    var _html = ""
    for (var k = 0; k < arrTitle.length; k++) {
        if (F.ph_id == k)
            hh = "<b class='on' index=" + k + ">" + arrTitle[k] + "</b>";
        else
            hh = "<b index=" + k + ">" + arrTitle[k] + "</b>";
        _html += hh;
    }
    _html += '<div class="clear"></div>';
    $("#ballNav").html(_html);

    var len = content.length; //[(16,1|03,1|04,2),(16,1|03,1|04,2)]
    var msg = "";
    for (var i = 0; i < len; i++) {//<div class="paihang" ><dd><p>北</p></dd></div>
        var t1 = '';
        if (i == F.ph_id)
            t1 = '<div class="paihang" >';
        else
            t1 = '<div class="paihang" style="display:none" >';
        var s = content[i]; //"16,16|03,1|04,2|02,1|04,1...3,1|08,1|06,1|05,1|03,1"
        var column = s.split("|");
        for (var j = 0; j < column.length; j++) {
            t1 += "<dd>"
            var c = column[j].split(',');
            var name = c[0];
            var cnt = c.length;
			//alert(name);
            for (var kk = 0; kk < cnt; kk++) {
                t1 += "<p>" + name + "</p>";
            }
            t1 += "</dd>";
        }
        t1 += "</div>";
        msg += t1;
    }
    $(".paihang").remove();//刪除node
    $("#ballNav").after(msg); //重新插入
    addEventAct('changePaiHangTab');//註冊tab事件
}
function SetDataLRYL(str_lryl) {
    try {
        var arr = str_lryl.split('|');
        if (arr.length != 2 ) {
            for (var i = 0; i < F.arr_id.length; i++) { //<p id="jeu_r_81_1">熱:10 漏:5</p>
                tmp = "热:" +"-" + " 漏:" + "-";
                $("#jeu_r_" + F.arr_id[i]).text(tmp);
            }
            return;
        }
        var arr_lr = arr[0].split(',');
        var arr_yl = arr[1].split(',');
        if (arr_lr.length != arr_yl.length)
            return;
        //if (arr_lr.length != F.arr_id.length)
        //return;
        if (F.arr_id.length == 0)
            setTimeout(function () { SetDataLRYL(str_lryl); }, 1000);
        for (var i = 0; i < F.arr_id.length; i++) { //<p id="jeu_r_81_1">熱:10 漏:5</p>
            tmp = "热:" + arr_lr[i] + " 漏:" + arr_yl[i];
            $("#jeu_r_" + F.arr_id[i]).text(tmp);
        }
    }
    catch (e) {
        console.log(e.toString());
    }
}


function SetDataOpenLotteryTime(t) {
    $("#o_time").text(t);
}
function SetDataBallAmt(data) { 

}
function SetDataCurrentPhase(qs) {
    if (G.kc_type == '0' || G.kc_type == '1' || G.kc_type == '9') {
        if (qs.length > 2)
            qs = qs.slice(-2);
    }
    else {
        if (qs.length > 3)
            qs = qs.slice(-3);
    }
    $("#t_qs").text(qs);
}
function SetDataLong(data) {
    //	<li>第5球-尾小:<b class="lan">6期</b></li>
    var arrLong = data.split('|');
    var html = "<ul>";
    for(var i=0;i<arrLong.length;i++) {
        var val = arrLong[i];
        var arrVal = val.split(',');
        var ball = arrVal[0];
        var n = arrVal[1];
        html += "<li>" + ball + ":<b class='lan'>" + n + "期</b></li>";
    }
    $("#t_long").html(html);

}
function SetDataAmt(amt) {
   
    if (amt) {
        $("#t_amt").html("今日输赢:" + amt);
    }
}
function SetDataCredit(credit) { //可用额度

    if (credit) {
        $("#t_credit").html("可用額度:" + credit);
    }
}

function SetDataOdds(obj) {//设置赔率 格式84_27,1.987|84_28,1.988
    //<label id="jeu_p_11_245">-</label>
    var arrList = obj;
    F.arr_id = [];
    for (var i = 0; i < arrList.length;i++ ) {
		var g_type_arr = arrList[i]['g_type'].split('_');
		var g_type=g_type_arr[1];
		for (var key in arrList[i]){
			if(key!='g_type'){
				odds = arrList[i][key];
				var PL = arrList[i][key];
				var id = "jeu_p_"+ g_type +'_'+ key;
				//console.log("#" + id+"text("+PL+")");
				$("#" + id).text(PL);
				if(i < 20) F.arr_id.push(key);
			}
		}
        
    }
}

//开奖,封盘倒计时
var t1 = 0;
var kj_timer = null;
function SetDataCountDown(t) {
    t1 = get_time_seconds(t);
    if (t1 < 0 || isNaN(t1))
        return;
    if (kj_timer) {
        clearTimeout(kj_timer);
        kj_timer = null;
    }
    //if (t1 > 0) return;
    if ( F.is_open == 'y') {
        //下注倒计时
        //t1 = get_time_seconds(t);
        $("#c_time").text("距封盤:"+t);
        update_countdown(t1, "c_time", "fp");
    }
    if( F.is_open == 'n'){
        //开奖倒计时
       // t1 = get_time_seconds(t);
        $("#c_time").text("距开奖:" + t);
        update_countdown(t1, "c_time", "kj");
        $("div.liBox").each(function () {
            if ($(this).hasClass("on")) {
                $(this).removeClass("on");
            }
        }
        );
        F.updateBallsNum();
    }

}
function get_time_seconds(t) {
    var hms = new String(t).split(":");
    var s = new Number(hms[2]);
    var m = new Number(hms[1]);
    var h = new Number(hms[0]);
    return h * 3600 + m * 60 + s;
}

function update_countdown(t,dom,type) {
    if (t > 0) {
        t = t - 1;
        ss = format_time(t);
        if(type=='fp')
            $("#" + dom).text("距封盤:" + ss);
        else
            $("#" + dom).text("距開獎:" + ss);
        kj_timer = setTimeout(function () { update_countdown(t, dom, type); }, 1000);
    }
    else {
        t1 = 0;
        LoadOddsData();//请求赔率信息
        if(type == 'fp')
            $("#" + dom).text("停押");
        else
            $("#" + dom).text("開獎中");
    }
    
}
function format_time(cc) {
    var hours = parseInt((cc / 3600), 10),
            minute = parseInt(((cc % 3600) / 60), 10),
            second = parseInt((cc % 60), 10);
    hours = hours < 10 ? '0' + hours : hours;
    minute = minute < 10 ? '0' + minute : minute;
    second = second < 10 ? '0' + second : second;
    return (minute + ':' + second).toString()
}

//----页面内调用js func
function showOrHideNode(obj) {
    if (obj) {
        var p = $(obj).parent();
        var s = $(p).siblings(".box");
        if (s) {
            if ($(s).css("display") == "none") {
                $(obj).text('隱藏');
                $(s).show();
            }
            else {
                $(obj).text('顯示');
                $(s).hide();
            }

        }

    }
}
//点击下注page
function showBetPage() {
    //$("#BetPage").show();
    $("<div id='mask' class='mask'></div>").addClass("mask")
                                          .width("100%")
                                          .height("100%")
                                          .appendTo($("#dataPage"))
                                          .fadeIn(0);

    $("#BetPage").show();
    //$("#set_input").empty().append($('<input type="tel" id="txtMomey" name="txtMomey" placeholder="請輸入下注金額" />'));
    $("#txtMomey").focus();
}
function hideBetPage() {
    $("#mask").remove();
    //$("#BetPage").animate({ left: "100%", right: "0%" }, 1);
    $("#BetPage").hide();
}

//提交下单处理
function checkUser() {
    if (F.is_open == 'n') {
        alert('已封盤!');
        return false;
    }
    var je = $('#txtMomey').val();
    if (je.match(/^0|\D/) == null && parseInt(je, 10) > 0) {
    } else {
        alert('請輸入正確金額!');
        $('#txtMomey').focus();
        return false;
    }
    var cz_obj = $('#caizhong');
    var jq_obj = $('#jiangqi');
    var wf_obj = $('#wanfa');
    var data_obj = $('#ball_data');
    $(jq_obj).val(F.k_id);
    cz_val = $("#lottery_type").val();
    player_val = $("#player_type").val();
    $(cz_obj).val(cz_val);
    $(wf_obj).val(player_val);
    //
    var selected_node = $("div.on");
    var arrList = new Array();
    var len = $(selected_node).length;
    $("div.on").each(function (i, domEle) {
        var selected_ball = $(domEle).children("label");
        var node_id = $(selected_ball).attr("id");
        var node_text = $(selected_ball).text();
        tmp = node_id + "," + node_text;
        arrList.push(tmp);

    });

    var text = arrList.join('|');
    //console.log(text);
    $(data_obj).val(text);
    return true;
}

//调用分析获取url地址参数
function getQueryStringV(vhref, name) {
    // 如果链接没有参数，或者链接中不存在我们要获取的参数，直接返回空 
    if (vhref.indexOf("?") == -1 || vhref.indexOf(name + '=') == -1) {
        return '';
    }
    // 获取链接中参数部分 
    var queryString = vhref.substring(vhref.indexOf("?") + 1);
    // 分离参数对 ?key=value&key2=value2 
    var parameters = queryString.split("&");
    var pos, paraName, paraValue;
    for (var i = 0; i < parameters.length; i++) {
        // 获取等号位置 
        pos = parameters[i].indexOf('=');
        if (pos == -1) {
            continue;
        }
        // 获取name 和 value 
        paraName = parameters[i].substring(0, pos);
        paraValue = parameters[i].substring(pos + 1);

        if (paraName == name) {
            return unescape(paraValue.replace(/\+/g, " "));
        }
    }
    return '';
}


function SetDataDraw(qs,arr_rs) { //设置开奖结果
/*
<b style="float:left;" >期</b>
        <b class="num_01">04</b><b class="num_02">19</b><b class="num_02">20</b><b class="num_01">10</b>
        <b class="num_01">04</b><b class="num_02">19</b><b class="num_02">20</b><b class="num_01">10</b>
        */

    $("#draw_result").html("");
    if (G.kc_type == '0' || G.kc_type == '9' ) {
        if (qs.length > 2)
            qs = qs.slice(-2);
    }
    else {
        if (qs.length > 3)
            qs = qs.slice(-3);
    }
    
    var txt = "<b style='float:left;' >" + qs + "期</b>";
    if (G.kc_type == "0" || G.kc_type=="1" || G.kc_type=="2" || G.kc_type=="3" || G.kc_type=="10" || G.kc_type=="11") {
        for (var i = 0; i < arr_rs.length; i++) {
            
            var e = arr_rs[i];
            var tmp = " <b class='num_" + e + "'>" + e + "</b>";
            if (G.kc_type == "1")
                tmp = " <b class='num_0" + e + "'>" + e + "</b>";
            txt += tmp;
        }
    }
    if (G.kc_type == "4" || G.kc_type == "6") {
        for (var i = 0; i < arr_rs.length; i++) {
            var e = arr_rs[i];
            var tmp = " <b class='pk_" + e + "'>" + e + "</b>";
            txt += tmp;
        }
    }
    if (G.kc_type == "9") {
        for (var i = 0; i < arr_rs.length; i++) {
            var e = arr_rs[i];
            var tmp = "<img src='images/" + parseInt(e) + ".png' width='26' height='26'>";
            txt += tmp;
        }
    }
    if (G.kc_type == "7") {
        for (var i = 0; i < arr_rs.length; i++) {
            var e = arr_rs[i];
            var tmp = "<img src='images/k" + parseInt(e) + ".png' width='23' height='23'>";
            txt += tmp;
        }
    }

    if (G.kc_type == "8") {
        for (var i = 0; i < arr_rs.length; i++) {
            var e = arr_rs[i];
            var tmp = " <b class='kl8" + "" + "'>" + e + "</b>";
            txt += tmp;
        }
        txt += '<div class="clear"></div>';
    }

    $("#draw_result").html(txt);
}

function gotoPlayerPage() { //change玩法
    var lottery = $('#lottery_type').val();
    var player = $('#player_type').val();
    var name = '';
    if (lottery == '0')
        name = 'KL10';
    else if (lottery == '2')
        name = 'CQSC';
	else if (lottery == '3')
    name = 'qtwfc';
	else if (lottery == '10')
    name = 'xjssc';
	else if (lottery == '11')
    name = 'tjssc';
    else if (lottery == '6')
        name='PK10';
	 else if (lottery == '7')
        name='jsk3';	
    else if (lottery == '9')
        name='XYNC';
    else if (lottery == '4')
        name = 'XYFT';
    else if (lottery == '8')
        name = 'KL8';
	if(player=='d2' || player=='d3' || player=='d4' || player=='d5' || player=='d6' || player=='d7' || player=='d8')
    	var url = name + '_d1.php' + '?lottery_type=' + lottery + '&player_type=' + player;
	else
		var url = name + '_' + player + '.php' + '?lottery_type=' + lottery + '&player_type=' + player;
    //console.log(url);
    window.location = url;
}