﻿function To_RMB(id)
{
//var whole = document.all.Money_XY_1.value;
var whole = document.getElementById(id).value;

//����������С��
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

//ת����������
var i=1;
var len = num.length;

var dw2 = new Array("","萬","億");//��λ
var dw1 = new Array("十","百","千");//С��λ
var dw = new Array("","一","二","三","四","五","六","七","八","九");//����������
var k1=0;//��С��λ
var k2=0;//�ƴ�λ
var str="";

for(i=1;i<=len;i++)
{
var n = num.charAt(len-i);
if(n=="0")
{
if(k1!=0)
str = str.substr( 1, str.length-1);
}

str = dw[Number(n)].concat(str);//������

if(len-i-1>=0)//�����ַ�Χ��
{
if(k1!=3)//��С��λ
{
str = dw1[k1].concat(str);
k1++;
}
else//����С��λ���Ӵ�λ
{
k1=0;
var temp = str.charAt(0);
if(temp=="萬" || temp=="億")//����λǰû����������ȥ��λ
str = str.substr( 1, str.length-1);
str = dw2[k2].concat(str);
}
}


if(k1==3)//С��λ��ǧ���λ��һ
{
k2++;
}

}
if (str.length>=2){
    if (str.substr(0,2)=="一十") str=str.substr(1, str.length-1);
}
document.getElementById("rmb").innerHTML = str;
}
