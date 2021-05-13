function $(id) {
  if(document.getElementById) { return document.getElementById(id); }
  else if(document.all) { return document.all[id]; }
  else if(document.layers) { return document.layers[id]; }
  else { return false; }
}
function $$(id)
{
	return $(id).style;
}

//判断是否登陆，并决定显示
function checklogin(){
    if (IsLoginIn())
    {  
		$$("login").display = "none";
        $$("logined").display = "block";
        var _jsusername = unescape(getCookiesWithKey("21rednet","JSUserName")); //获取并显示用户名。兼容中文。
		_jsusername = _jsusername.match(/^[\u4e00-\u9fa5,0-9,a-z,A-Z,_,\,,\.,\!,@,#,$,%,^,&, ,\*]*$/g);
		if (_jsusername==null)
			_jsusername="";
		if (_jsusername == "") //没有这个值，可能是从还没有同步的登录页面过来的
        {
            try{
				$("jsuname").innerHTML = "红袖用户&nbsp;&nbsp;";
            }catch(e) { }
        }
        else
		{
			$("jsuname").innerHTML = _jsusername + "&nbsp;&nbsp;";
		}
    }
    else    
    {
        try{
	        $("logined").style.display= "none";
		    $("login").style.display= "";
        }catch(e){}
    }//if
}//checklogin

//登陆
function loginin()
{
    var _url = top.location.href;
    _url = escape(_url);
    _url = "http://login.sns.hongxiu.com/comlogin.aspx?url=" + _url;
    setTimeout("window.location='"+_url+"'", 0); 
}

//退出
function loginout()
{
    var _url = top.location.href;
    _url = escape(_url);
    _url = "http://login.sns.hongxiu.com/comloginout.aspx?url=" + _url;
    setTimeout("window.location='"+_url+"'", 0); 
}


//判断是否登陆
function IsLoginIn(){
    var uname = getCookiesWithKey("21rednet","UserName");
    if (uname)  //已登陆
        return true;
    else
        return false;
}//IsLoginIn

//读取带键值的cookie
function getCookiesWithKey(key,c_name){
	if (document.cookie.length>0){
        var k_start = document.cookie.indexOf(key + "=");
        if(k_start == -1)
            return "";
        k_start = k_start + key.length+1 
        var k_end = document.cookie.indexOf(";",k_start);
        if(k_end == -1) k_end = document.cookie.length;
        var cookiesWithKey = unescape(document.cookie.substring(k_start,k_end));
        var cookies = cookiesWithKey.split("&");
        for(var i=0;i<cookies.length;i++){
            if(cookies[i].split("=")[0] == c_name)
            {
                return cookies[i].split("=")[1];
            }//if
        }//for
    }//if
return ""
}

function startmarquee(lh,speed,delay){
var t;
var p=false;
var o=$("marqueebox");
o.innerHTML+=o.innerHTML;
o.onmouseover=function(){p=true}
o.onmouseout=function(){p=false}
o.scrollTop = 0;
function start(){
t=setInterval(scrolling,speed);
if(!p) o.scrollTop += 2;
}
function scrolling(){
if(o.scrollTop%lh!=0){
o.scrollTop += 2;
if(o.scrollTop>=o.scrollHeight/2) o.scrollTop = 0;
}else{
clearInterval(t);
setTimeout(start,delay);
}
}
setTimeout(start,delay);
}

function BottomHtml()
{
document.write("<div class='policeimg'><a href='http://bj.cyberpolice.cn/' target='_blank' rel='nofollow' class='police_bj'></a><a href='http://sh.cyberpolice.cn/' target='_blank' rel='nofollow' class='police_sh'></a></div>")
}


var myid=2;
function G(value)
{
    return document.getElementById(value);
}
function onchageid(pram){
	if(pram!=null&&pram!=0){
		myid=pram;
		doClick_jy();
		}
	}
function doClick_jy(){
G("jy"+myid).className="on";
var j;
var id;
var e;
for(var i=1;i<=4;i++){
id ="jy"+i;
j = G(id);
e = G("pic"+i);
ll=G("pic"+i+"l");
if(id != "jy"+myid){
j.className="";
e.style.display = "none";
ll.style.display = "none";
}else{	
e.style.display = "";
ll.style.display = "";
}

}
myid++;
if(myid>4){
	myid=1;	
}
}

function TabList(){
  setInterval(doClick_jy,12000)//时间//;
}

function yedianchange(curnum,totalnum,idname)
{
    for(var i=1;i<=totalnum;i++)
    {
        G(idname+"head"+i).className="";
       G(idname+"info"+i).style.display="none";
    }

    G(idname+"head"+curnum).className="now";
    G(idname+"info"+curnum).style.display="block";
}

function showSubSearch()
	{
		$("sel_sub_div").onmouseover=function(){
			$("sel_sub_div2").style.display="";
			$("sel_sub_div").className="sel_stypec sel_sthover"
		};
		$("sel_sub_div").onmouseout=function(){$("sel_sub_div2").style.display="none";$("sel_sub_div").className="sel_stypec"};
		$("sel_sub_2").onclick=function(){selSubSearch(0);$("query").focus()};
		$("sel_sub_3").onclick=function(){selSubSearch(1);$("query").focus()};
		//$("sel_sub_4").onclick=function(){selSubSearch(2);$("query").focus()};
	};
function selSubSearch(iType){
	if(iType==0){
		$("sel_sub_1").innerHTML="标题&nbsp;";
		$("sel_sub_div2").style.display="none";
		$("iftitle").value="1"}
	else if(iType==1){
		$("sel_sub_1").innerHTML="作者&nbsp;";
		$("sel_sub_div2").style.display="none";
		$("iftitle").value="2"}
	else if(iType==2){
		$("sel_sub_1").innerHTML="全文&nbsp;";
		$("sel_sub_div2").style.display="none";
		$("iftitle").value=""}
		};

function close0629(){morenameIntervalOrder = 500;morenameIntervalOrder = 0;setTimeout("closediv0629()",10);}
function hiddenDiv0629()
{var _h = $$("div0629").height.replace("px","");try{if(_h>0){$$("div0629").height =(_h-25)+"px";setTimeout("hiddenDiv0629()",50);}else{$$("div0629").display="none";}
}catch (e){$$("div0629").display="none";}}
var morenameIntervalOrder = 0;
function closediv0629()
{
    morenameIntervalOrder = morenameIntervalOrder + 5;
    try{
        if(navigator.userAgent.indexOf("Firefox")>0) 
            $("div0629").style.opacity= 1- (morenameIntervalOrder/255);
		else
		    $("div0629").filters.alpha.opacity= (255- morenameIntervalOrder);
        if (morenameIntervalOrder<250)
			setTimeout("closediv0629()",15);
		else
		setTimeout("hiddenDiv0629()",75);
    }catch(e){}
}

function shangzhouzuishouhuanying(curnum,totalnum,idname)
{
    for(var i=1;i<=totalnum;i++)
    {
        G(idname+"head"+i).className="";
       G(idname+"info"+i).style.display="none";
    }

    G(idname+"head"+curnum).className="on";
    G(idname+"info"+curnum).style.display="block";
}

function tabchange(curnum,totalnum,idname, classname)
{
    for(var i=1;i<=totalnum;i++)
    {
        G(idname+"head"+i).className="";
       G(idname+"info"+i).style.display="none";
    }

    G(idname+"head"+curnum).className=classname;
    G(idname+"info"+curnum).style.display="block";
}

function tabchange2(curnum,totalnum,idname, classname)
{
    for(var i=1;i<=totalnum;i++)
    {
        G(idname+"head2"+i).className="";
       G(idname+"info2"+i).style.display="none";
    }

    G(idname+"head2"+curnum).className=classname;
    G(idname+"info2"+curnum).style.display="block";
}

function QQLogin()
{
window.open('https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=100266825&state=hxdomain&scope=get_user_info,add_idol&redirect_uri=login.sns.hongxiu.com/QQLogin/QQLoginPage.aspx','QQ登录','height=600,width=500,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
}

function fromlinksite()
{var _ref=document.referrer;
var _siteurls=["http://topic.hongxiu.com/fuli/js/book.hao123.com","http://topic.hongxiu.com/fuli/js/.hao123.com","http://topic.hongxiu.com/fuli/js/.duba.com","http://topic.hongxiu.com/fuli/js/hao.360.cn","http://topic.hongxiu.com/fuli/js/xiaoshuo.360.cn","http://topic.hongxiu.com/fuli/js/book.2345.com","http://topic.hongxiu.com/fuli/js/.2345.com","http://topic.hongxiu.com/fuli/js/114la.com","http://topic.hongxiu.com/fuli/js/www.baidu.com","http://topic.hongxiu.com/fuli/js/123.sogou.com"];
for(i=0;i<_siteurls.length;i++)
{if(_ref.indexOf(_siteurls[i])>0)
{document.cookie="fromdomain="+_siteurls[i]+";domain=hongxiu.com;path=/";break;}}}

//其他的操作
function otherop()
{
var curdate=new Date();if(curdate>=new Date("2013/07/02")&&curdate<new Date("2013/07/05")){$$("div2g").display="block";}
}

//选择器
function $a(id,tag){var re=(id&&typeof id!="string")?id:document.getElementById(id);if(!tag){return re;}else{return re.getElementsByTagName(tag);}}

//焦点滚动图 点击移动
function movec()
{
	var o=$a("bd1lfimg","");
	var oli=$a("bd1lfimg","dl");
    var oliw=oli[0].offsetWidth; //每次移动的宽度	 
	var ow=o.offsetWidth-2;
	var dnow=0; //当前位置	
	var olf=oliw-(ow-oliw+10)/2;
		o["scrollLeft"]=olf+(dnow*oliw);
	var rqbd=$a("bd1lfsj","ul")[0];
	var extime;

	<!--for(var i=1;i<oli.length;i++){rqbd.innerHTML+="<li>"+i+"</li>";}-->
	var rq=$a("bd1lfsj","li");
	for(var i=0;i<rq.length;i++){reg(i);};
	oli[dnow].className=rq[dnow].className="show";
	var wwww=setInterval(uu,2000);

	function reg(i){rq[i].onclick=function(){oli[dnow].className=rq[dnow].className="";dnow=i;oli[dnow].className=rq[dnow].className="show";mv();}}
	function mv(){clearInterval(extime);clearInterval(wwww);extime=setInterval(bc,15);wwww=setInterval(uu,8000);}
	function bc()
	{
		var ns=((dnow*oliw+olf)-o["scrollLeft"]);
		var v=ns>0?Math.ceil(ns/10):Math.floor(ns/10);
		o["scrollLeft"]+=v;if(v==0){clearInterval(extime);oli[dnow].className=rq[dnow].className="show";v=null;}
	}
	function uu()
	{
		if(dnow<oli.length-2)
		{
			oli[dnow].className=rq[dnow].className="";
			dnow++;
			oli[dnow].className=rq[dnow].className="show";
		}
		else{oli[dnow].className=rq[dnow].className="";dnow=0;oli[dnow].className=rq[dnow].className="show";}
		mv();
	}
	o.onmouseover=function(){clearInterval(extime);clearInterval(wwww);}
	o.onmouseout=function(){extime=setInterval(bc,15);wwww=setInterval(uu,8000);}
}


function getLastRead(CookiesName)
{var cookieString=new String(document.cookie);var cookieHeader=CookiesName+"=";var beginPosition=cookieString.indexOf(cookieHeader);var myvalue="";if(beginPosition!=-1)
{myvalue=cookieString.substring(beginPosition+cookieHeader.length);var SemiPos=myvalue.indexOf('\;');if(SemiPos>0)
myvalue=myvalue.substring(0,SemiPos);}
return myvalue;}

function tipinfo()
{
if($("tiptool").innerHTML=="全部展开")
{
$$("taplist").display="block";$("tiptool").innerHTML="全部收起";$("tiptool").className="show";

}
else
{
$$("taplist").display="none";$("tiptool").innerHTML="全部展开";$("tiptool").className="";
}
}

function GetJson()
{
var str=getLastRead("ReadHistory");
if(str==""){$$("aboutmyselfdiv").display='none';return;}
var jsonList=eval("("+str+")");
if(jsonList==null){$$("aboutmyselfdiv").display='none';return;}
var outstring="";
var jsonlength=jsonList.length;
if(jsonlength==0){$$("aboutmyselfdiv").display='none';$$("divLastHas").display='none';$$("divLastNone").display='block';return;}
else{
$$("aboutmyselfdiv").display='block';$$("divLastHas").display='block';$$("divLastNone").display='none';
var ss=jsonList[jsonlength-1];
var LastAid=ss.aid;
var LastName=unescape(ss.name);
var Lastbid=ss.bid;
var lasttitle=LastName;
if (lasttitle.length>14){lasttitle=lasttitle.substr(0,14);}
var tt=unescape(ss.title);var stt=tt.length>14?tt.substring(0,14):tt;

$("divLastHas").innerHTML="您最近正在阅读：<a title='"+LastName+"' href='http://novel.hongxiu.com/a/"+LastAid+"/' target='_blank'>《"+lasttitle+"》</a>";}
if(Lastbid!=0)
$("divLastHas").innerHTML=$("divLastHas").innerHTML+"已看到：<span><a title='"+tt+"' target='_blank' href=\"http://novel.hongxiu.com/a/"+LastAid+"/"+Lastbid+".shtml\">"+stt+"</a></span>";

if(jsonlength>1)    
{
$$("tipddl").display="block";
for(var i=jsonlength-2;i>=0;i--){ 
outstring+="";
var aid=jsonList[i].aid;
var bid=jsonList[i].bid;
var bookname=unescape(jsonList[i].name);
var sbookname=bookname.length>12?bookname.substring(0,10):bookname;
var title=unescape(jsonList[i].title);　　
var stitle=title.length>12?title.substring(0,12):title;
　  outstring+="<li>《<a title='"+bookname+"' href=\"http://novel.hongxiu.com/a/"+aid+"/\" target=\"_blank\">"+sbookname+"</a>》";
　  if(bid!=0){outstring+="<span><a title='"+title+"' target=\"_blank\" href=\"http://novel.hongxiu.com/a/"+aid+"/"+bid+".shtml\">"+stitle+"</a></span>"};
　  outstring+="</li>";
　}
　outstring+="<li class=\"enter_sc\"><a href=\"http://sns.hongxiu.com/PersonManager/Read/Store/storenovelv2.aspx\" target=\"_blank\">点击进入藏书架>></a></li>";

$("taplist").innerHTML=outstring;
}
}

function NewGotoURL(){checklogin();}

function CheckCookie(){
    var str=getLastRead("beginrootpage");
    var ua = navigator.userAgent.toLowerCase();
    if(str==""){
        if(ua.indexOf("ipad") > 0 && window.screen.width >= 768)  
            window.location.href="http://pad.hongxiu.com/";
        else if(window.screen.width<600)
        {
            if(ua.indexOf("android")>0 || ua.indexOf("iphone")>0)
                window.location.href="http://hongxiu.cn/";
            else
                window.location="http://topic.hongxiu.com/fuli/js/redir.html";  
        }
        
    }
}

function show2ggame(){$('2ggame').className='icon_2g_tit show';$$('2ggameinfo').display='';}
function hidden2ggame(){$('2ggame').className='icon_2g_tit';$$('2ggameinfo').display='none';}

function otheropad20130422()
{
var curdate=new Date();if(curdate>=new Date("2013/04/22")&&curdate<new Date("2013/04/27")){$$("ad20130422").display="block";}
}
function showlist(k,h){for(var i=0;i<3;i++){$$("box_"+k+i).display="none";}
for(var i=0;i<3;i++){$("tab_"+k+i).className="";}
$("tab_"+k+h).className="now";$$("box_"+k+h).display="block";}

function addCookie(objName, objValue, objHours) {
    var str = objName + "=" + escape(objValue);
    if (objHours > 0) {
        var date = new Date();
        var ms = objHours * 3600 * 1000;
        date.setTime(date.getTime() + ms);
        str += "; expires=" + date.toGMTString();
    }
    document.cookie = str + ";domain=hongxiu.com;path=/";
    $$("buttomAppBox").display="none";
}
function getCookie(objName) {
    var arrStr = document.cookie.split("; ");
    for (var i = 0; i < arrStr.length; i++) {
        var temp = arrStr[i].split("=");
        if (temp[0] == objName) return unescape(temp[1]);
    }
}
function CheckDivClientCookie(name) {
    if(navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion .split(";")[1].replace(/[ ]/g,"")=="MSIE6.0")
        $$("buttomAppBox").display="none";
    var str = getCookie(name);
    if(str == "1")
        $$("buttomAppBox").display="none";
    else{
        addCookie('divclient', '1', '24')
        $$("buttomAppBox").display="block";
    }
}