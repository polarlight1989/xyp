﻿/* m.old-index.js
 * @build 2013-11-12
 * @autohr xuyujun
 */
//判断ie
var isLowIE = false;
var ua = navigator.userAgent.toLowerCase();
var s = ua.match(/msie ([\d.]+)/);

if(s){
//	if(parseInt(s[1]) <= 8){
//		isLowIE = true;
//	}
	isLowIE = true;
}
//alert(parseInt(s[1]));
//判断safari
var isSafari = false;
if(ua.indexOf('safari')!=-1){
	isSafari = true;
}

var framesetReady = false;
var rows="";
$(function(){
	framesetReady = true;
	rows = top.logOutForms.rows;
});

function iEVersion() {
	var ie=!-[1,], ie6=ie&&!window.XMLHttpRequest, ie8=ie&&!!document.documentMode, ie7=ie&&!ie6&&!ie8, n = 1;
	if (ie){
	    if (ie6){
	        n = 6
	    }else if (ie8){
	        n = 8
	    }else if (ie7){
	        n = 7
	    }
	};
	return n;
};

window.popMenuNew = {
	element : {
		$menu : null,
		currentHover: null,
        timeout : null,
        interval : null
	},
	init : function(downNav){
		var self = this;
		//体验新版
		window.setTimeout(function(){
			//window.tiyan.init();
		},0);
		//针对低版本ie做处理，当内部frame加载完成时，父窗口frameset未必加载完成，通过定时器来给父窗口添加事件
		if(isLowIE){
			if(!framesetReady)
            {
				self.element.interval = window.setInterval(function(){
					if(framesetReady)
                    {
						self.element.$menu = $("<div class='navOne-newDown'></div>").appendTo($("frameset"));
						window.clearInterval(self.element.interval);
						self.elementInit(downNav);
					}
				},100);
			}
			else{
				if(iEVersion() == 6 || iEVersion() == 7 || iEVersion() == 8){
					self.element.$menu = $("<div class='navOne-newDown'></div>").appendTo($("frameset"));
				}else{
					self.element.$menu = $("<div class='navOne-newDown'></div>").appendTo("html");
				}
				self.elementInit(downNav);
			}
		}
		else{
			self.element.$menu = $("<div class='navOne-newDown'></div>").appendTo("html");
			self.elementInit(downNav);
		}
	},
	elementInit : function(downNav){

		var self = this;

		//alert(downNav.attr("class"))
//		var _tem = ["<div class=\"clearfix\" id=\"bankLi-down\" style=\"display: none;\">",
//						"<ul>",		 
//						"<li><a id=\"a0\" onclick=\"enterSysIndex(this,uri);\" uri=\"Content1.html\" target=\"body\" entersysindex=\"个人网银\">个人网银</a></li>",
//						"<li><a id=\"a1\" onclick=\"enterSysIndex(this,uri);\" uri=\"Content2.html\" target=\"body\" entersysindex=\"信用卡\">信用卡</a></li>",
//			            "<li><a id=\"a2\" onclick=\"enterSysIndex(this,uri);\" uri=\"Content3.html\" target=\"body\" entersysindex=\"财富E\">财富E</a></li>",
//			            "<li><a id=\"a3\" onclick=\"enterSysIndex(this,uri);\" uri=\"Content4.html\" target=\"body\" entersysindex=\"健康保险\">健康保险</a></li>",
//						"</ul>",
//					"</div>"];
		var _obj =$(_tem.join(""));


		self.element.$menu.html(_obj);

		var html = self.element.$menu.html().replace('/onclick/',"frameHeaderOnClick");

		self.element.$menu.html("").html(html);

        self.eventInit();
	},
	eventInit: function () {
	    var self = this;

	    self.element.$menu.find("> div").hover(function () {
	        if (self.element.currentHover == $(this).attr("id")) {
	            window.clearTimeout(self.element.timeout);
	        }
	    }, function () {
	        self.close($(this).attr("id"));
           
	    });

	    self.element.$menu.find("a").click(function () {
	    	//调用header的跳转方法
	        var headerWin = top.frames['header'];     

	        //top.frames["header"].enterSysIndex($(this).attr("enterSysIndex"));
        	if(isSafari){
        		headerWin.contentWindow ? (headerWin.contentWindow.enterSysIndex($(this).attr("enterSysIndex"),$(this).attr("uri"))) : (headerWin.enterSysIndex($(this).attr("enterSysIndex"),$(this).attr("uri")));
                
        	}else{
                //headerWin.enterSysIndex($(this).attr("enterSysIndex"));
                headerWin.enterSysIndex($(this).attr("enterSysIndex"),$(this).attr("uri")); 

        	} 
	        //点击下拉菜单后隐藏下拉菜单
	        var id = $(this).parents("div").attr("id");
	        self.element.$menu.find("#" + id).hide();

        	if(isSafari){
        		headerWin.contentWindow ? (headerWin.contentWindow.hideNav(id)) : (headerWin.hideNav(id));
        	}else{
        		headerWin.hideNav(id);
        	} 
	        //top.frames["header"].hideNav(id);
	        //点击下拉菜单后重设header下拉头样式
	        var ids = id.replace("Li-down","");

	        if(isSafari){
        		//headerWin.contentWindow ? (headerWin.contentWindow.navlinkClick(ids)) : (headerWin.navlinkClick(ids));
        	}else{
        		//headerWin.navlinkClick(ids);
        	} 
	        //top.frames["header"].navlinkClick(ids);

            top.frames["header"].$("#bankLi").removeClass("czBtnOn");
            top.frames["header"].$("#bankLi").addClass("czBtn");

            return false;
	    });
	},
	open: function (options) {
	    var self = this;

	    if (self.element.currentHover == options.id + "-down") {
	        window.clearTimeout(self.element.timeout);
            
	    }

	    self.element.currentHover = options.id + "-down";
	    self.element.$menu.find("> div").hide();
	    self.element.$menu.find("#" + options.id + "-down").css(options.css);
	    self.element.$menu.css("filter","");
	},
	close: function (id) {
	    var self = this;
	    self.element.timeout = window.setTimeout(function () {
	        self.element.$menu.find("#" + id).hide();

	        var headerWin = top.frames['header'];               
        	if(isSafari){
        		headerWin.contentWindow ? (headerWin.contentWindow.hideNav(id)) : (headerWin.hideNav(id));
        	}else{
        		headerWin.hideNav(id);
        	}

            top.frames["header"].$("#bankLi").removeClass("czBtnOn");
            top.frames["header"].$("#bankLi").addClass("czBtn");

	    }, 100);
	}
};

window.tiyan = {
	element: {
        timeout: null,
        interval : null,
        maskdiv : null,
        parentdiv : null
    },

    init: function (downTopUser) {
    	//if(location.host.indexOf("stg4") < 0){return;}
    	var self = this;
    	var showtiyan = oneGetCookie("showtiyan");
    	if(showtiyan){
    		return;
    	}

    	if(isLowIE){
			if(!framesetReady){
				self.element.interval = window.setInterval(function(){
					if(framesetReady){
						window.clearInterval(self.element.interval);
						self.element.$tiyan = $(self.element.$html).appendTo($("frameset"));
						self.element.$tiyan.wrap('<div></div>');
						self.element.parentdiv = self.element.$tiyan.parent();
						self.element.maskdiv = $('<div class="bg_c_999"></div>').appendTo(self.element.parentdiv);
						self.eventInit();
					}
				},100);
			}
			else{
				self.element.$tiyan = $(self.element.$html).appendTo($("frameset"));
				self.element.$tiyan.wrap('<div></div>');
				self.element.parentdiv = self.element.$tiyan.parent();
				self.element.maskdiv = $('<div class="bg_c_999"></div>').appendTo(self.element.parentdiv);
				self.eventInit();
			}
		}
		else{
			self.element.$tiyan = $(self.element.$html).appendTo($("html"));
			self.element.$tiyan.wrap('<div></div>');
			self.element.parentdiv = self.element.$tiyan.parent();
			self.element.maskdiv = $('<div class="bg_c_999"></div>').appendTo(self.element.parentdiv);
			self.eventInit();
		}        
    },
    eventInit: function () {
        var self = this;

        self.element.$tiyan.css({
        	"display" : "block",
        	"z-index" : "101",
        	"filter" : ""
        });
        self.element.maskdiv.css("height",$(document).height());

        //close
        self.element.$tiyan.find(".old-lead-close").click(function(){
        	self.element.parentdiv.remove();
        });

        //体验新版
        self.element.$tiyan.find(".btntiyan").click(function(){
        	var headerWin = top.frames['header']; 
        	oneSetCookie("showtiyan","false");

        	if(isSafari){
        		headerWin.contentWindow ? (headerWin.contentWindow.switchAB_TEST('B')) : (headerWin.switchAB_TEST('B'));
        	}else{
        		headerWin.switchAB_TEST('B');
        	} 
        });

        //不再提示
        self.element.$tiyan.find(".nots").click(function(){
        	oneSetCookie("showtiyan","false");
        	self.element.parentdiv.remove();
        });
    }
};

window.popTopUser = {
    element: {
        $topuser: null,
        timeout: null,
        interval : null
    },
    init: function (downTopUser) {
    	var self = this;

    	if(isLowIE){
			if(!framesetReady){
				self.element.interval = window.setInterval(function(){
					if(framesetReady){
						self.element.$topuser = $("<div class='topuser-newDown'></div>").appendTo($("frameset"));
						window.clearInterval(self.element.interval);
						self.elementInit(downTopUser);
					}
				},100);
			}
			else{
				self.element.$topuser = $("<div class='topuser-newDown'></div>").appendTo($("frameset"));
				self.elementInit(downTopUser);
			}
		}
		else{
			self.element.$topuser = $("<div class='topuser-newDown'></div>").appendTo($("html"));
			self.elementInit(downTopUser);
		}        
    },
    elementInit : function(downTopUser){
    	var self = this;

    	self.element.$topuser.append(downTopUser.find(".topuser-down"));

        self.eventInit();
    },
    eventInit: function () {
        var self = this;

        self.element.$topuser.find(".topuser-down").hover(function () {
            window.clearTimeout(self.element.timeout);
        }, function () {
            self.close();
        });

        self.element.$topuser.find("a").click(function () {
            //top.frames["header"].enterSysIndex($(this).attr("enterSysIndex"));
            var menuId = $(this).attr("menuId");
            var	menuSubId = $(this).attr("menuSubId");

            try {
            	var headerWin = top.frames['header'];               
            	if(isSafari){
            		headerWin.contentWindow ? (headerWin.contentWindow.setTargetMenuFlag(menuId,menuSubId)) : (headerWin.setTargetMenuFlag(menuId,menuSubId));
            	}else{
            		headerWin.setTargetMenuFlag(menuId,menuSubId);
            	}                    
            }catch(e){}

	        self.element.$topuser.find(".topuser-down").hide();

            return false;
        });
    },
    open: function (options) {
        var self = this;

        window.clearTimeout(self.element.timeout);
        self.element.$topuser.find(".topuser-down").css(options.css);
        self.element.$topuser.css("filter","");
    },
    close: function () {
        var self = this;

        self.element.timeout = window.setTimeout(function () {
            self.element.$topuser.find(".topuser-down").hide();
        }, 100);
    }
};

//新版首页下拉
window.popMenuNewV2 = {
	element : {
		$menu : null,
		currentHover: null,
        timeout : {},
        interval : null
	},
	init : function(downNav){
		var self = this;
    	
		if(isLowIE){
			if(!framesetReady){
				self.element.interval = window.setInterval(function(){
					if(framesetReady){
						self.element.$menu = $("<div class='navOne-newDown-v2'></div>").appendTo($("frameset"));
						window.clearInterval(self.element.interval);
						self.elementInit(downNav);
					}
				},100);
			}
			else{
				self.element.$menu = $("<div class='navOne-newDown-v2'></div>").appendTo($("frameset"));
				self.elementInit(downNav);
			}
		}
		else{
			self.element.$menu = $("<div class='navOne-newDown-v2'></div>").appendTo("html");
			self.elementInit(downNav);
		}
	},
	elementInit : function(downNav){
		var self = this;

		self.element.$menu.append(downNav.find("#bankLi-down"));
		self.element.$menu.append(downNav.find("#insuranceLi-down"));
		self.element.$menu.append(downNav.find("#investmentLi-down"));

        self.eventInit();
	},
	eventInit: function () {
	    var self = this;

	    self.element.$menu.find("> div").hover(function () {
	        if (self.element.currentHover == $(this).attr("id")) {
	            window.clearTimeout(self.element.timeout[self.element.currentHover]);
	        }
	    }, function () {
	        self.close($(this).attr("id"));
	    });

	    self.element.$menu.find("a").click(function () {

	        //top.frames["header"].enterSysIndex($(this).attr("enterSysIndex"));
	        var method = $(this).attr("method");
            var param = $(this).attr("param").split(",");

            try {
            	var headerWin = top.frames['header'];               
            	if(isSafari){
            		headerWin.contentWindow ? (headerWin.contentWindow[method](param[0],param[1])) : (headerWin[method](param[0],param[1]));
            	}else{
            		headerWin[method](param[0],param[1]);
            	}                       
            }catch(e){}

            var id = $(this).parents("div").attr("id");
	        self.element.$menu.find("#" + id).hide();
	        //top.frames["header"].hideNav(id);

	        //点击下拉菜单后重设header下拉头样式
	        var ids = id.replace("Li-down","");
	        //top.frames["header"].navlinkClick(ids);

	        var headerWin = top.frames['header'];               
        	if(isSafari){
        		//headerWin.contentWindow ? (headerWin.contentWindow.navlinkClick(ids)) : (headerWin.navlinkClick(ids));
        		headerWin.contentWindow ? (headerWin.contentWindow.hideNav(id)) : (headerWin.hideNav(id));
        	}else{
        		//headerWin.navlinkClick(ids);
        		headerWin.hideNav(id);
        	}

            return false;
	    });
	},
	open: function (options) {
	    var self = this;

	    if (self.element.currentHover == options.id + "-down") {
	        window.clearTimeout(self.element.timeout[self.element.currentHover]);
	    }

	    self.element.currentHover = options.id + "-down";
	    self.element.$menu.find("> div").hide();
	    self.element.$menu.find("#" + options.id + "-down").css(options.css);
	    self.element.$menu.css("filter","");
	},
	close: function (id) {
	    var self = this;

	    self.element.timeout[id] = window.setTimeout(function () {
	        self.element.$menu.find("#" + id).hide();

	        var headerWin = top.frames['header'];               
        	if(isSafari){
        		headerWin.contentWindow ? (headerWin.contentWindow.hideNav(id)) : (headerWin.hideNav(id));
        	}else{
        		headerWin.hideNav(id);
        	}
	    }, 100);
	}
};

//重设frame head的高度
var ffhh = null;
window.fixFrameHeaderHeight = function(){
	if(!framesetReady){
		ffhh = window.setInterval(function(){
			if(framesetReady){
				window.clearInterval(ffhh);
				//top.logOutForms.rows=rows;
				document.getElementsByTagName("frameset")[0].setAttribute("rows",rows);
			}
		},100);
	}
	else{
		//top.logOutForms.rows=rows;
		document.getElementsByTagName("frameset")[0].setAttribute("rows",rows);
	}
}

window.dealCreditCard = function(action){
	$(".topuser-downlist a[menusubid=assetsDetailLink]").click();
	try{
		var interval = null;

		interval = window.setInterval(function(){
			var frameLeft = top.frames['content'].frames['left'];
			var frameRight = top.frames['content'].frames['main'];

			if(frameLeft && frameRight){
				window.clearInterval(interval);
				
				var interval2 = null;
				interval2 = window.setInterval(function(){
					try{
	        	        eval("var mainWin = top.frames['content'].frames['main']; if(navigator.userAgent.toLowerCase().indexOf('safari')!=-1){ mainWin.contentWindow ? (mainWin.contentWindow." + action + ") : mainWin." + action + " ;} else { mainWin." + action + " }");
						//eval("top.frames['body'].frames['main']." + action);
						window.clearInterval(interval2);
					}
					catch(e){}
				},50);
				
			}
		},50);
	}
	catch(e){}
}

function oneSetCookie(name,value){
    var Days = 1000;
    var exp  = new Date();
    exp.setTime(exp.getTime() + Days*24*60*60*1000);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
function oneGetCookie(name){
    var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
     if(arr != null) return unescape(arr[2]); return null;

}
function oneDelCookie(name){
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval=oneGetCookie(name);
    if(cval!=null) document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}