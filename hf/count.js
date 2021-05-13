document.write("<script src='http://w.cnzz.com/c.php?id=30021293&l=3' language='JavaScript' charset='gb2312'></script>");
function Hxzz()
{function GetCookie(key,c_name){if(document.cookie.length>0){var k_start=document.cookie.indexOf(key+"=");if(k_start==-1)
return"";k_start=k_start+key.length+1
var k_end=document.cookie.indexOf(";",k_start);if(k_end==-1)k_end=document.cookie.length;var cookiesWithKey=unescape(document.cookie.substring(k_start,k_end));if(c_name=="")return cookiesWithKey;var cookies=cookiesWithKey.split("&");for(var i=0;i<cookies.length;i++){if(cookies[i].split("=")[0]==c_name)
{return cookies[i].split("=")[1];}}}
return""}
var _hxid=GetCookie("21rednet","UserID");if(_hxid=="")
return;var u=document.location.href;u=u.replace("#","");var d=document.domain;function f()
{return(u.indexOf("?")>=0)?escape(u.substring((u.indexOf(d)+d.length),u.indexOf("?"))):escape(u.substring((u.indexOf(d)+d.length),u.length));}
function q()
{return(u.indexOf("?")>=0)?escape(u.substring(u.indexOf("?")+1)):"";}
function aid()
{if(u.indexOf("http://novel/")==0)
{var reg=new RegExp("http://([0-9a-za-z]*)novel([0-9]*).hongxiu.com/a/([0-9]+)/([0-9a-zA-Z.]*)","g");if(reg.test(u)==true)
{return u.replace(reg,"$3");}}
return 0;}
function bid()
{if(u.indexOf("http://novel/")==0)
{var reg=new RegExp("http://([0-9a-za-z]*)novel([0-9]*).hongxiu.com/a/([0-9]+)/([0-9]+).shtml","g");if(reg.test(u)==true)
{return u.replace(reg,"$4");}}
return 0;}
document.write("<sc"+"ript src='http://hxzz.hxcdn.net/?d="+d+"&hxid="+_hxid+"&f="+f()+"&q="+q()+"&aid="+aid()+"&bid="+bid()+"'></sc"+"ript>");}
Hxzz();
