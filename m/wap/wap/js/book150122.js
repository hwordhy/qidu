﻿function initMid()
function Open(i)
{
    //if(i==-1){byId("box").hide();return;}
    //if(i>0 && $$.IsLogin()==false){Open(0);return;}
    
    var _url;
    if(i==0)//登录
    {
        _url = "/fhome/login/";
        byId("boxtxt").load(_url);
        byId("boxtxt").html(byId("boxtxt").html().replace("{backurl}","http://"+document.domain+"/fhome/m_login_bak.htm?result="));
    }
    else if(i==1) //月票
        _url = "/fhome/m_yuepiao.htm";
    else if(i==2) //红包
        _url = "/fhome/m_redpack.htm";
    else if (i==3) //赞
    {
        if(byId("jszan").html().indexOf("点赞")<0)
            return;
        byId("jszan").html("操作中..").attr("style","opacity:0.3");
	    _url = "http://"+document.domain+"/fhome/m_support.htm?";
	    _url = "http://apiin.timeread.com/gift_novel/api_sendsupport.ashx?novelid="+bookinfo.novelid+"&url="+escape(_url);
    }
    else if(i==4) //收藏
    {
        if(byId("jsFav").html()!="加入收藏")
            return;
        byId("jsFav").html("操作中..").attr("style","opacity:0.3");
	    _url = "http://"+document.domain+"/login.php?";
	    _url = "/modules/article/addbookcase.php?bid="+bookinfo.novelid+"&cid=0&url="+escape(_url);
    }else if(i==5) //投票
    else
        return;
        
    if(i==1 || i==2)
    {
        $$.ajax(_url,function(x){
            byId("boxtxt").html(x.replace("{novelid}",bookinfo.novelid).replace("{bookname}",bookinfo.bookname).replace("{authorid}",bookinfo.authorid).replace("{authorname}",bookinfo.authorname));
    }
    else if(i==3||i==4)
    {
        $$.hideLoad(_url);
        return;
    }
    
    //需要浮框的
    byId("box").attr("style","opacity:1;bottom:40%").show();
    byId("boxmask").height("180px");
    
}
function getReadHistory()
{
	var _history = $$.getCookie("ReadHistory","");
	if(_history=="")
		return;
	 var _json = eval(unescape(_history));
	 if(_json==null)
	    return;
    for(j=0;j<_json.length;j++)
	{
	    if(_json[j].novelid==bookinfo.novelid)
		{
		    if(_json[j].chapterid=="")
		        return;
		    jsSqChapterID = _json[j].chapterid;    
		    byId("htmldianjiyuedu").html("继续阅读").href("/book/"+bookinfo.novelid+"/"+jsSqChapterID);
		    byId("jshisLink").html("<a href='/book/"+bookinfo.novelid+"/"+jsSqChapterID+"'>"+_json[j].title + "</a>")
		    byId("jshisDiv").show();
			return;
        }//if
	}//for	    
}//getReadHistory


function setShuqianLight()
{
    if(jsSqChapterID=="")return;
    var _obj=G("ch"+jsSqChapterID);
    _obj.parentNode.style.display="block";
    _obj.innerHTML+="<em></em>";
    _obj.className="act";
}

function plsubmit()