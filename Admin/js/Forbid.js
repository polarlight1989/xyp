var _My = {
    $: function (sArg, context) {
        switch (sArg.charAt(0)) {
            case "#":
                return document.getElementById(sArg.substring(1));
                break;
            case ".":
                var reg = new RegExp("(^|\\s)" + sArg.substring(1) + "(\\s|$)"),
					arr = [],
					aEl = _My.$("*", context),
					i;
                for (i = 0; i < aEl.length; i++) reg.test(aEl[i].className) && arr.push(aEl[i]);
                return arr;
                break;
            default:
                return (context || document).getElementsByTagName(sArg);
                break;
        }
    }
};

function aInputOnblur(objName) {
    var aInput = _My.$(objName);
    if (aInput.length > 0) {
        for (var i = 0; i < aInput.length; i++) {
            aInput[i].onblur = function () {
                var that = this,
					v = that.value;
                that.value = returnNum(v);
                //alert(that.value);
                that.className = 'inp1'
            }
        };
    };

    function returnNum(str) {
        //return str.replace(/[^\d+\.]/g, '').replace(/[\u4e00-\u9fa5]+[\u00b7\.]?[\u4e00-\u9fa5]/g, '');
        return str.replace(/[^\d+\.+\-]/g, '');
    };
};

function digitfOnly(evt) 
{
    evt = evt || window.event;
    var code = parseInt(evt.keyCode);
    if (code >= 96 && code <= 105 || code >= 48 && code <= 57 || code == 8 || code == 46 || code == 190 || code == 9 || code == 110) {
        return true;
    }
    else {
        if (evt && evt.preventDefault)
            evt.preventDefault(); 
        else
            window.event.returnValue = false; 
        return false;
    }
};

function digitfOnly2(evt)
{
    evt = evt || window.event;
    var code = parseInt(evt.keyCode);
    if (code >= 96 && code <= 105 || code >= 48 && code <= 57 || code == 8 || code == 46 || code == 190 || code == 189 || code == 9 || code == 110) {
        return true;
    }
    else {
        if (evt && evt.preventDefault)
            evt.preventDefault();
        else
            window.event.returnValue = false; 
        return false;
    }
};

function digitfOnly3(evt)// 只允许输入数字
{
    evt = evt || window.event;
    var code = parseInt(evt.keyCode);
    if (code >= 96 && code <= 105 || code >= 48 && code <= 57 || code == 8 || code == 46 || code == 9) {
        return true;
    }
    else {
        if (evt && evt.preventDefault)
            evt.preventDefault(); //阻止默认浏览器动作(W3C)
        else
            window.event.returnValue = false; //IE中阻止函数器默认动作的方式 
        return false;
    }
}

function clickIE4(){
        if (event.button==2){
                return false;
        }
}
 
function clickNS4(e){
        if (document.layers||document.getElementById&&!document.all){
                if (e.which==2||e.which==3){
                        return false;
                }
        }
}
 
function OnDeny(){
        if(event.ctrlKey || event.keyCode==78 && event.ctrlKey || event.altKey || event.altKey && event.keyCode==115){
                return false;
        }
}
 
if (document.layers){
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown=clickNS4;
        document.onkeydown=OnDeny();
}else if (document.all&&!document.getElementById){
        document.onmousedown=clickIE4;
        document.onkeydown=OnDeny();
}
 
document.oncontextmenu = new Function("return false");

// cookie
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        factory(require('jquery'));
    } else {
        // console.log(typeof jQuery == 'undefined');
        if(typeof jQuery != 'undefined'){
            factory(jQuery);
        }
    }
}(function ($) {

    var pluses = /\+/g;

    function encode(s) {
        return config.raw ? s : encodeURIComponent(s);
    }

    function decode(s) {
        return config.raw ? s : decodeURIComponent(s);
    }

    function stringifyCookieValue(value) {
        return encode(config.json ? JSON.stringify(value) : String(value));
    }

    function parseCookieValue(s) {
        if (s.indexOf('"') === 0) {
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }

        try {
            s = decodeURIComponent(s.replace(pluses, ' '));
            return config.json ? JSON.parse(s) : s;
        } catch(e) {}
    }

    function read(s, converter) {
        var value = config.raw ? s : parseCookieValue(s);
        return $.isFunction(converter) ? converter(value) : value;
    }

    var config = $.cookie = function (key, value, options) {

        if (value !== undefined && !$.isFunction(value)) {
            options = $.extend({}, config.defaults, options);

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setTime(+t + days * 864e+5);
            }
            return (document.cookie = [
                encode(key), '=', stringifyCookieValue(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '',
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }

        var result = key ? undefined : {};

        var cookies = document.cookie ? document.cookie.split('; ') : [];

        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            var name = decode(parts.shift());
            var cookie = parts.join('=');

            if (key && key === name) {
                result = read(cookie, value);
                break;
            }

            if (!key && (cookie = read(cookie)) !== undefined) {
                result[name] = cookie;
            }
        }

        return result;
    };

    config.defaults = {};

    $.removeCookie = function (key, options) {
        if ($.cookie(key) === undefined) {
            return false;
        }

        $.cookie(key, '', $.extend({}, options, { expires: -1 }));
        return !$.cookie(key);
    };
}));


function setSelectCookie() {
    $.cookie("setSelectCookie", null);
    var m = [];
    m.push($("#money_XZ").val());
    m.push($("#OpenCheck").val());
    m.push($("#AutoUpdate").val());
    var a = m.join('@');
    $.cookie("setSelectCookie", null);
    $.cookie("setSelectCookie", a, {expires: 30});
}

if(typeof jQuery != 'undefined'){
    $(function () {
        (function () {
            var m = $("#money_XZ");
            var o = $("#OpenCheck");
            var a = $("#AutoUpdate");

            if(a.length == 0 && o.length == 0 && m.length == 0){
                return;
            }

            if($.cookie("setSelectCookie")){
                var mc = $.cookie("setSelectCookie").split("@")[0];
                var oc = $.cookie("setSelectCookie").split("@")[1];
                var ac = $.cookie("setSelectCookie").split("@")[2];
            }

            if(mc){
                // m.find("option").prop("selected",false);
                m.find("option[value=" + mc + "]").prop("selected","selected");
            }
            if(oc){
                // o.find("option").prop("selected",false);
                o.find("option[value=" + oc + "]").attr("selected","selected");
            }
            if(ac){
                // a.find("option").prop("selected",false);
                a.find("option[value=" + ac + "]").attr("selected","selected");
            }

        })();
    });
};
