var hiscookiename = 'jieqiHistoryBooks'; //cookie名字
var hisbookmax = 100;  //最多保留几条阅读记录
var hiscookievalue = Storage.get(hiscookiename); //取cookie


//把cookie解析成阅读记录数组，需要加载 /scripts/json2.js
var bookary = [];
try{
	bookary = JSON.parse(hiscookievalue);
	if(!bookary) bookary = [];
}catch(e){
}

//显示最近阅读
if(bookary.length > 0){
	for(var i = bookary.length - 1; i >= 0; i--){
		document.write('<a class="db" href="/modules/article/reader.php?aid='+bookary[i].articleid+'&cid='+bookary[i].chapterid+'"><p style="overflow:hidden;white-space:nowrap;line-height:2;border-top:1px solid #ddd;><span class="gray">最近阅读 | </span><span class="pop">'+bookary[i].articlename+'</span>');
		if(bookary[i].chapterid > 0) document.write('&nbsp;<span class="gray">'+bookary[i].chaptername.substr(0, 20)+'</span>');
		document.write('</p></a>');
		break;
	}
}

//删除一本书
function delhisbook(aid, obj){
	for(var i = 0; i < bookary.length; i++){
		if(bookary[i].articleid == aid){
			bookary.splice(i, 1);
			hiscookievalue = JSON.stringify(bookary);
			Storage.set(hiscookiename, hiscookievalue);
			obj.parentNode.parentNode.parentNode.removeChild(obj.parentNode.parentNode);
			break;
		}
	}
}