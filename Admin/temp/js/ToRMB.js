function To_RMB(id)
{
//var whole = document.all.Money_XY_1.value;
var whole = document.getElementById(id).value;

//·ÖÀëÕûÊıÓëĞ¡Êı
var num;
var dig;
if(whole.indexOf(".") == -1)
{
num = whole;
dig = "";
}
else
{
num = whole.substr(0,whole.indexOf("."));
dig = whole.substr( whole.indexOf(".")+1, whole.length);
}

//×ª»»ÕûÊı²¿·Ö
var i=1;
var len = num.length;

var dw2 = new Array("","è¬","å„„");//´óµ¥Î»
var dw1 = new Array("å","ç™¾","åƒ");//Ğ¡µ¥Î»
var dw = new Array("","ä¸€","äºŒ","ä¸‰","å››","äº”","å…­","ä¸ƒ","å…«","ä¹");//ÕûÊı²¿·ÖÓÃ
var k1=0;//¼ÆĞ¡µ¥Î»
var k2=0;//¼Æ´óµ¥Î»
var str="";

for(i=1;i<=len;i++)
{
var n = num.charAt(len-i);
if(n=="0")
{
if(k1!=0)
str = str.substr( 1, str.length-1);
}

str = dw[Number(n)].concat(str);//¼ÓÊı×Ö

if(len-i-1>=0)//ÔÚÊı×Ö·¶Î§ÄÚ
{
if(k1!=3)//¼ÓĞ¡µ¥Î»
{
str = dw1[k1].concat(str);
k1++;
}
else//²»¼ÓĞ¡µ¥Î»£¬¼Ó´óµ¥Î»
{
k1=0;
var temp = str.charAt(0);
if(temp=="è¬" || temp=="å„„")//Èô´óµ¥Î»Ç°Ã»ÓĞÊı×ÖÔòÉáÈ¥´óµ¥Î»
str = str.substr( 1, str.length-1);
str = dw2[k2].concat(str);
}
}


if(k1==3)//Ğ¡µ¥Î»µ½Ç§Ôò´óµ¥Î»½øÒ»
{
k2++;
}

}
if (str.length>=2){
    if (str.substr(0,2)=="ä¸€å") str=str.substr(1, str.length-1);
}
document.getElementById("rmb").innerHTML = str;
}
