$(document).ready(function() {
    reviewAjax(1)
}), jQuery(".myReview").slide({
    titCell: ".ulHd li",
    mainCell: ".divBd",
    trigger: "click"
}), $(".ulHd li").click(function() {
    var e = $(this),
        t = e.data("type");
    $("#reviewType").val(t), $(".pageNum").val("1"), reviewAjax(1, t)
}), $(".pages_bottom").hide();
var goTotalCount, goCurCount, htmlCont = function(e, t, o, a, i, l, n) {
        var r = (i.pageCount, Handlebars.compile($(e).html()));
        i.items.length > 0 ? ($(t).html(""), $(t).html(r(i)), $(o).find(".pages_bottom").show(), $(o).find(".loading").hide(), $(o).find(".bookNone").hide()) : ($(o).find(".loading").hide(), $(o).find(".pages_bottom").hide(), $(o).find(".bookNone").show()), 1 == goTotalCount && $(o).find(".gobtn").addClass("ungobtn").off("click"), doCreatePageNav(a, l, n)
    },
    reviewAjax = function(e) {
        var t = $("#reviewType").val(),
            o = "";
        o = 2 == t ? "/modules/article/myreplies.php" : "/modules/article/myreviews.php", $.ajax({
            type: "get",
            url: o,
            data: {
                ajax_gets: 1,
                page: e
            },
            dataType: "json",
            success: function(o) {
                if (o.error) alert(o.error.common);
                else {
                    var a = o.pageCount;
                    goTotalCount = o.pageCount, goCurCount = o.currentPage, 2 == t ? htmlCont("#reply-template", ".replyList", "#replyList", "#replyList .pages_bottom >ul", o, e, a) : htmlCont("#review-template", ".reviewList", "#reviewList", "#reviewList .pages_bottom >ul", o, e, a)
                }
            }
        })
    },
    doPage = function(e) {
        reviewAjax(e)
    };
