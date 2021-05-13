$(document).ready(function() {
    inputVal = $("#gosearchbtn").val().replace(/\s+$/, "").replace(/^\s+/, "");
    var a = $("#objectType").val();
    if (inputVal)  getdataList()
});

var inputVal, pageIndex = 1,
    bookListcont = $(".s-b-list"),
    authorListcont = $(".searchauthor"),
    bookList = function(a) {
        if (a) {
            var t = "";
            $(".s-b-list").html(""), $.each(a.book, function(a, e) {
                var s = "";
                e.lastChapter && (s = "<p><a href='" + e.url_lastchapter + "' target='_blank' class='red'>最近更新 " + e.lastChapter + "</a><span>| " + e.lastupdate + "更新</span></p>"), t += "<div class='secd-rank-list'>                            <dl>                                <dt><a href='" + e.url_articleinfo + "' target='_blank'><img src='" + e.url_image + "'></a></dt>                                <dd>                                    <a href='" + e.url_articleinfo + "' class='bigpic-book-name' target='_blank'>" + searchKeyword(e.articlename, inputVal) + "</a>                                    <p>                                        <a href='javascript:;' target='_blank'>" + searchKeyword(e.author, inputVal) + "</a> | <a href='" + e.url_sort + "' target='_blank'>" + e.sort + "</a> | " + e.fullflag + "<span class='clicknum'><em>" + e.size_c + " 总字数</em>|<em>" + e.allvote + "推荐</em>|<em>" + e.allvisit + "点击</em></span></p>                                    <p class='big-book-info'>" + searchKeyword(e.intro, inputVal) + "</p>" + s + "                                </dd>                            </dl>                            <div class='bigbtn'>                                <a href='" + e.url_articleinfo + "' class='detailbtn' target='_blank'>书籍详情</a>                            </div>                        </div>"
            }), $(".s-b-list").append(t)
        }
    },
    getdataList = function(a) {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/modules/article/search.php",
            data: {
                searchkey: inputVal,
                searchtype: 'all',
                ajax_gets: 1,
                pageIndex: a
            },
            beforeSend: function() {
                $(".s-b-list").html(""), $(".searchauthor").html(""), $(".loading").show()
            },
            success: function(a) {
                var e = a.totalCount;
                $(".totalcount").html(e), a.book && a.book.length > 0 ? (1 == a.pageCount ? $(".pages_bottom").hide() : $(".pages_bottom").show(), doCreatePageNav(".pages_bottom ul", a.currentPage, a.pageCount), bookList(a)) : ($(".pages_bottom").hide(), $(".s-b-list").html(""), $(".s-b-list").append('<p class="errortips">很抱歉，没有找到相关的书<br>您可以去<a href="/modules/article/articlefilter.php" target="_blank" class="red">书库</a>找书</p>'))
            },
            complete: function() {
                $(".loading").hide()
            }
        })
    };
$("body").on("click", ".clrbtna .clrbtn1", function() {
    $(this).addClass("on"), $(this).siblings("li").removeClass("on"), bookListcont.show(), authorListcont.hide(), getdataList()
}), $("body").on("click", ".btn-search", function() {
    inputVal = $("#gosearchbtn").val().replace(/\s+$/, "").replace(/^\s+/, ""), $(".clrbtna .clrbtn1").addClass("on"), $(".clrbtna .clrbtn2").removeClass("on"), bookListcont.show(), authorListcont.hide(), getdataList()
}), $("body").on("keydown", "#gosearchbtn", function(a) {
    inputVal = $("#gosearchbtn").val().replace(/\s+$/, "").replace(/^\s+/, ""), 13 == a.keyCode && (bookListcont.show(), authorListcont.hide(), getdataList())
});
var bookid, trMod;
$("body").on("click", ".addshelf", function() {
    if (!page_config.username) return pop_login(), !1;
    bookid = $(this).data("id"), trMod = $(this), addShelf()
});
var addShelf = function() {
        $.ajax({
            type: "get",
            url: "/modules/article/addbookcase.php?ajax_gets=1&bid=" + bookid,
            success: function(t) {
                t = eval(t);
                if (t.success == true) {
                    layer.msg(t.message, {icon: 1,shade: .3});
                    a.fadeIn(400, function() {
                        $(this).html("<em>已在书架</em>");
                        $(this).attr("data-control", "remove");
                    })
                }
                else{
                    layer.msg(t.message, {icon: 2,shade: .3});
                }
            }
        })
    },
    searchKeyword = function(a, t) {
        return a && t ? a.split(t).join('<span class="keyred">' + t + "</span>") : ""
    };
