var hiscookiename = 'jieqiHistoryBooks'; //cookie名字
var hiscookievalue = Cookie.get(hiscookiename); //取cookie


//把cookie解析成阅读记录数组，需要加载 /scripts/json2.js
var bookary = [];
try{
	bookary = JSON.parse(hiscookievalue);
	if(!bookary) bookary = [];
}catch(e){
}

//如果有记录最近阅读章节，显示书签标志
var cid = 0;
if(bookary.length > 0){
	for(var i = bookary.length - 1; i >= 0; i--){
		if(bookary[i].articleid == articleid){
			
			if(bookary[i].chapterid > 0){
				var chaps = $_("chapterindex").getElementsByTagName("dd");
				if(chaps.length > 0){
					for(var j = 0; j < chaps.length; j++){
						if(chaps[j].id == "cid_" + bookary[i].chapterid){
							chaps[j].className = "readmark";
							break;
						}
					}
				}
			}
			break;
		}
	}
}