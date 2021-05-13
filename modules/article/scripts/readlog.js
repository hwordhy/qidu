//章节页面保存阅读记录，需要先加载 /scripts/json2.js

var hisStorageName = 'jieqiHistoryBooks'; //变量名
var hisStorageValue = Storage.get(hisStorageName); //读取记录
var hisBookAry = []; //记录数组
var hisBookMax = 20; //最多保留几条阅读记录
var hisBookIndex = -1; //当前作品的数组下标

try{
	hisBookAry = JSON.parse(hisStorageValue);
	if(!hisBookAry) hisBookAry = [];
}catch(e){
}

//查找本书是否已在历史记录
for(var i = 0; i < hisBookAry.length; i++){
	if(hisBookAry[i].articleid == ReadParams.articleid){
		hisBookIndex = i;
		break;
	}
}

if(hisBookIndex >= 0){
	//书已经存在，先删除再添加到最后
	hisBookAry.splice(hisBookIndex, 1);
}else if(hisBookAry.length >= hisBookMax){
	//记录新书，如果记录已达到最大值，先删除一条
	hisBookAry.shift();
}

//加入书的信息并保存
var hisBookInfo = {
  articleid: ReadParams.articleid,
  articlename: ReadParams.articlename,
  chapterid: ReadParams.chapterid,
  chaptername: ReadParams.chaptername,
  chapterisvip: ReadParams.chapterisvip,
  authorid: ReadParams.authorid,
  author: ReadParams.author,
  userid: ReadParams.userid,
  readtime: ReadParams.readtime ? ReadParams.readtime : Date.parse(new Date()) / 1000
};
hisBookAry.push(hisBookInfo);
hisStorageValue = JSON.stringify(hisBookAry);
Storage.set(hisStorageName, hisStorageValue);

//最近阅读保存到cookie
var jieqiRecentRead = '';
for(var i = 0; i < hisBookAry.length; i++){
	if(hisBookAry[i].articleid) {
    if (jieqiRecentRead != '') jieqiRecentRead += '-';
    jieqiRecentRead += hisBookAry[i].articleid + '.' + hisBookAry[i].chapterid + '.' + hisBookAry[i].chapterisvip;
    jieqiRecentRead += hisBookAry[i].readtime ? '.' + hisBookAry[i].readtime : '.0';
    jieqiRecentRead += hisBookAry[i].userid ? '.' + hisBookAry[i].userid : '.0';
  }
}
Cookie.set('jieqiRecentRead', jieqiRecentRead);

if(ReadParams.userid > 0){
	Ajax.Request('/modules/article/readlog.php?lastread=' + hisBookInfo.articleid + '.' + hisBookInfo.chapterid + '.' + hisBookInfo.chapterisvip + '.' + hisBookInfo.readtime + '.' + hisBookInfo.userid);
}
