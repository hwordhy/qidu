var fireAjax = !1;
$(document).ready(function() {
    var t = $("#sortId").val(),
        s = $("#Size").val(),
        i = $("#Isvip").val(),
        f = $("#Isfull").val(),
        u = $("#Update").val(),
        o = $("#Order").val(),
        k = $("#Keywords").val();
    if (t || s || i || f || u) {
        if (t) {
            $(".selstyle ul li a[data-type=" + t + "]").click(),$(".all").hide(),$(".seled1").show();
        }
        if (s) {
            $(".selnum ul li a[data-type=" + s + "]").click(),$(".all").hide(),$(".seled2").show();
        }
        if (i) {
            $(".selattribute ul li a[data-type=" + i + "]").click(),$(".all").hide(),$(".seled3").show();
        }
        if (f) {
            $(".selstatus ul li a[data-type=" + f + "]").click(),$(".all").hide(),$(".seled4").show();
        }
        if (u) {
            $(".updatetime ul li a[data-type=" + u + "]").click(),$(".all").hide(),$(".seled5").show();
        }
        if (o) {
            $(".tipshover a[data-type=" + o + "]").click()
        }
        fireAjax = !0, dataListpic(getDelbox())
    } else if (k){
        $("#bookgototag").val(k),$(".btn-submit").click(),$(".all").hide();
        fireAjax = !0, dataListpic({keywords:k})
    } else{
        fireAjax = !0, dataListpic();
    }

    $(".lazyimg").lazyload({
        threshold: 100,
        effect: "fadeIn",
        skip_invisible: !1
    })
});
var page = 1,
    getDelbox = function() {
        var t = $(".comment-status li").attr("data-ordetype"),
            e = $(".selected").find("a.add"),
            s = "",
            a = "",
            l = "",
            i = "",
            d = "",
            o = "",
            r = "";
        return $.each(e, function() {
            "selchannel" == $(this).attr("data-class") && (s = $(this).attr("data-size")), "selstyle" == $(this).attr("data-class") && (l = $(this).attr("data-size")), "subcatestyle" == $(this).attr("data-class") && (l = $(this).attr("data-size"), a = $(this).attr("data-type")), "selnum" == $(this).attr("data-class") && (i = $(this).attr("data-size")), "selattribute" == $(this).attr("data-class") && (d = $(this).attr("data-size")), "selstatus" == $(this).attr("data-class") && (o = $(this).attr("data-size")), "seltime" == $(this).attr("data-class") && (r = $(this).attr("data-size"))
        }), {
            sortid: l,
            size: i,
            isvip: d,
            isfull: o,
            update: r,
            order: t,
            page: page
        }
    },
    cur = "big",
    searchResultData, createBig = function(t) {
        if (t) {
            var e = "";
            $(".secd-rank-list .listboxw").html(""), $.each(t.data, function(t, s) {
                e += "<dl>\t\t                                <dt><a href='" + s.url_articleinfo + "' target='_blank'><img src='" + s.url_image + "'></a></dt>\t\t                                <dd>\t\t                                    <a href='" + s.url_articleinfo + "' class='bigpic-book-name' target='_blank'>" + s.articlename + "</a>\t\t                                    <p>\t\t                                    \t<a href='" + s.url_author + "' target='_blank'>" + s.author + "</a> | \t\t                                    \t<a href='" + s.url_sort + "' target='_blank'>" + s.sort + "</a> | " + s.fullflag + " </p>\t\t                                    <p class='big-book-info'>" + s.intro + "</p>\t\t                                    <p><span href='javascript:;' target='_blank'>" + s.size_c + "字 | </span><span class='red'>" + s.lastupdate + "更新</span></p>\t\t                                </dd>\t\t                            </dl>", t % 2 == 1 && (e += "<div class='line'></div>")
            }), t.data && t.data.length > 0 ? $(".secd-rank-list .listboxw").append(e) : ($(".secd-rank-list .listboxw").html(""), $(".secd-rank-list .listboxw").append('<p class="errorshow"></p>'))
        }
    },
    createSmall = function(t) {
        if (t) {
            var e = "";
            $(".tablist .listboxw").html(""), $.each(t.data, function(t, s) {
                e += "<li>                                    <a href='" + s.url_sort + "' target='_blank' class='tr1'>" + s.sort + "</a>                                    <a href='" + s.url_articleinfo + "' target='_blank' class='tr2'>" + s.articlename + "</a>                                    <a href='" + s.url_lastchapter + "' target='_blank' class='tr3'>" + s.lastchapter + "</a>                                    <a href='" + s.url_author + "' target='_blank' class='tr4'>" + s.author + "</a>                                    <a href='javascript:;' class='tr5'>" + s.lastupdate + "</a>                            </li>"
            }), t.data && t.data.length > 0 ? $(".tablist .listboxw").append(e) : ($(".tablist .listboxw").html(""), $(".tablist .listboxw").append('<p class="errorshow"></p>'))
        }
    },
    createView = function() {
        "big" == cur ? createBig(searchResultData) : createSmall(searchResultData)
    },
    dataListpic = function(t) {
        fireAjax && $.ajax({
            type: "get",
            url: "/modules/article/articlefilter.php?ajax_gets=1",
            dataType: "json",
            data: t,
            beforeSend: function() {
                $(".secd-rank-list .listboxw").html(""), $(".tablist .listboxw").html(""), $(".pages_bottom").hide(), $(".loading").show()
            },
            success: function(t) {
                t = eval(t);
                searchResultData = t;
                var e = t.totalCount;
                $(".totalcount").html(e), $(".pages_bottom").show(), 1 == t.pageCount && $(".pages_bottom").hide(), doCreatePageNav(".pages_bottom ul", t.currentPage, t.pageCount), createView()
            },
            complete: function() {
                $(".loading").hide()
            },
            error: function() {}
        })
    };
$("body").on("click", ".clrbtna .clrbtn1", function() {
    $(this).addClass("on"), $(this).siblings().removeClass("on"), tabtxt.hide(), tabpic.show(), cur = "big", createView(searchResultData)
}), $("body").on("click", ".clrbtna .clrbtn2", function() {
    $(this).addClass("on"), $(this).siblings().removeClass("on"), tabtxt.show(), tabpic.hide(), cur = "small", createView(searchResultData)
});
var tabsMenu = $(".clrbtna li"),
    ctrlbtn = $(".clrbtna li.clrbtn1").find("on"),
    tabpic = $(".secd-rank-list"),
    tabtxt = $(".tablist"),
    selStyle = $(".selstyle ul li"),
    secondTyle = $(".second-type"),
    secondTyleArrow = $(".arrow");
$("body").on("click", ".selchannel ul li a", function() {
    var t = $(this).data("type");
    $(this).parent("li").addClass("on"), $(this).parent("li").siblings("li").removeClass("on"), $(".selected .textlist .seled0").addClass("add"), $(".all").hide(), $(".seled0").show();
    var e = $(this).text();
    $(".selected .textlist .seled0 em").html(e), $(".selected .textlist .seled0").attr("data-class", "selchannel"), $(".selected .textlist .seled0").attr("data-size", t), dataListpic(getDelbox())
}), $("body").on("click", ".selstyle ul li a", function(t) {
    var e = $(this).parent("li");
    $(".selected a b").html(""), $(this).parent("li").addClass("on"), $(this).parent("li").siblings().removeClass("on");
    var s = $(e).position().left + $(e).innerWidth() / 2 - 5,
        a = $(this).position(),
        l = a.top;
    $(".comment-status li").removeClass("cur"), $(".comment-status li.orderOther:first").addClass("cur"), $(".selected .textlist b").text().length > 0 ? $(".selected .textlist b").show() : $(".selected .textlist b").hide(), $(document).one("click", function() {
        secondTyle.hide()
    }), t.stopPropagation(), secondTyle.css({
        left: 0,
        top: l
    }), secondTyleArrow.css({
        left: s
    });
    var i = $(this).data("type");
    e.hasClass("togle") ? (secondTyle.hide(), $(".all").show(), $(".seled1").hide()) : ($(".all").hide(), $(".seled1").show()), $(".selected .textlist .seled1").addClass("add");
    var d = $(this).text();
    $(".selected .textlist .seled1 em").html(d), $(".selected .textlist .seled1").attr("data-class", "selstyle"), $(".selected .textlist .seled1").attr("data-size", i), $("#bookgototag").val(""),dataListpic(getDelbox())
}), $("body").on("click", ".second-type .taglist a", function(t) {
    var e = $(this).text();
    $(this).data("type");
    $(".selected .textlist b").show(), $(this).addClass("on"), $(this).siblings().removeClass("on"), t.stopPropagation(), $(".comment-status li").removeClass("cur"), $(".comment-status li.orderOther:first").addClass("cur"), $(".selected .textlist .seled1").addClass("add"), $(".all").hide(), $(".seled11").show(), $(".selected .textlist .seled1 b").html(e), $(".selected .textlist .seled1").attr("data-class", "subcatestyle"), $(".selected .textlist .seled1").attr("data-type", e), $("#bookgototag").val(""), dataListpic(getDelbox())
}), $("body").on("click", ".selnum a", function(t) {
    var e = $(this).data("type"),
        s = $(this).text(),
        a = $(this).parent("li");
    $(this).parent("li").addClass("on"), $(this).parent("li").siblings().removeClass("on"), $(".comment-status li").removeClass("cur"), $(".comment-status li.orderOther:first").addClass("cur"), a.hasClass("togle") ? ($(".all").show(), $(".seled2").hide()) : ($(".all").hide(), $(".seled2").show()), $(".selected .textlist .seled2").addClass("add"), $(".selected .textlist .seled2 em").html(s), $(".selected .textlist .seled2").attr("data-class", "selnum"), $(".selected .textlist .seled2").attr("data-size", e), $("#bookgototag").val(""), dataListpic(getDelbox())
}), $("body").on("click", ".selattribute a", function(t) {
    var e = $(this).data("type"),
        s = $(this).text(),
        a = $(this).parent("li");
    $(this).parent("li").addClass("on"), $(this).parent("li").siblings().removeClass("on"), $(".comment-status li").removeClass("cur"), $(".comment-status li.orderOther:first").addClass("cur"), a.hasClass("togle") ? ($(".all").show(), $(".seled3").hide()) : ($(".all").hide(), $(".seled3").show()), $(".selected .textlist .seled3").addClass("add"), $(".selected .textlist .seled3 em").html(s), $(".selected .textlist .seled3").attr("data-class", "selattribute"), $(".selected .textlist .seled3").attr("data-size", e), $("#bookgototag").val(""), dataListpic(getDelbox())
}), $("body").on("click", ".selstatus a", function(t) {
    var e = $(this).data("type"),
        s = $(this).text(),
        a = $(this).parent("li");
    $(this).parent("li").addClass("on"), $(this).parent("li").siblings().removeClass("on"), $(".comment-status li").removeClass("cur"), $(".comment-status li.orderOther:first").addClass("cur"), a.hasClass("togle") ? ($(".all").show(), $(".seled4").hide()) : ($(".all").hide(), $(".seled4").show()), $(".selected .textlist .seled4").addClass("add"), $(".selected .textlist .seled4 em").html(s), $(".selected .textlist .seled4").attr("data-class", "selstatus"), $(".selected .textlist .seled4").attr("data-size", e), $("#bookgototag").val(""), dataListpic(getDelbox())
}), $("body").on("click", ".seltime a", function(t) {
    var e = $(this).data("type"),
        s = $(this).text(),
        a = $(this).parent("li");
    $(this).parent("li").addClass("on"), $(this).parent("li").siblings().removeClass("on"), $(".comment-status li").removeClass("cur"), $(".comment-status li.orderOther:first").addClass("cur"), a.hasClass("togle") ? ($(".all").show(), $(".seled5").hide()) : ($(".all").hide(), $(".seled5").show()), $(".selected .textlist .seled5").addClass("add"), $(".selected .textlist .seled5 em").html(s), $(".selected .textlist .seled5").attr("data-class", "seltime"), $(".selected .textlist .seled5").attr("data-size", e), $("#bookgototag").val(""), dataListpic(getDelbox())
}), $("body").on("click", ".comment-status li:not(.human)", function() {
    $(this).addClass("cur"), $(this).siblings().removeClass("cur"), dataListpic(getDelbox())
}), $("body").on("click", ".human .tipshover a", function() {
    var t = $(this),
        e = t.data("type"),
        s = getDelbox();
    $(this).addClass("cur"), $(this).siblings().removeClass("cur"), $(".comment-status li").attr("data-ordetype", e), s.order = e, dataListpic(s)
}), $("body").on("click", ".human .firstname", function(t) {
    $(document).one("click", function() {
        $(".tipshover").hide()
    }), t.stopPropagation(), $(".tipshover").show()
}), $("body").on("click", ".tipshover a", function() {
    var t = $(this).text();
    $(this).closest("li").addClass("cur"), $(this).closest("li").siblings().removeClass("cur"), $(".tipshover").hide(), $(".human .firstname").html(t)
}), $("body").on("click", ".selected .textlist a", function(t) {
    var e = $(this).attr("data-class"),
        s = $(this).attr("data-size");
    if ($(this).removeClass("add"), $(this).hasClass("seled0")) $(this).show();
    else {
        $(this).hide(), $(this).attr("data-size") == $(".selstyle ul li.on a").attr("data-type") && ($(".selstyle ul li").removeClass("on"), $(".selstyle ul li:first-child").addClass("on"));
        $("." + e).find("a[data-type=" + s + "]").parent("li").removeClass("on"), $("." + e).find(".textlist li:first-child").addClass("on")
    }
    $(".add").length < 1 && $(".all").show(), $(".comment-status li").removeClass("cur"), $(".comment-status li.orderOther:first").addClass("cur"), $("#bookgototag").val(""), dataListpic(getDelbox())
});
var searchMethod = function() {
    $(".textlist li").removeClass("on"), $(".textlist li:first-child").addClass("on"), $(".second-type a").removeClass("on");
    var t = $("#bookgototag").val(),
        e = {
            keywords: t
        };
    $(".all").hide(), $(".seled1").show(), $(".seled1 em").html(""), $(".seled2").hide(), $(".seled3").hide(), $(".seled4").hide(), $(".seled5").hide(), $(".seled1 b").show(), $(".comment-status li").removeClass("cur"), $(".comment-status li.orderOther:first").addClass("cur"), $(".selected .textlist a").removeClass("add"), $(".selected .textlist .seled1").addClass("add"), $(".seled1 b").css({
        "border-left": "none",
        margin: "0"
    }), $(".selected .textlist .seled1 b").html(t), $(".selected .textlist .seled1").attr("data-class", "subcatestyle"), $(".selected .textlist .seled1").attr("data-size", ""), $(".selected .textlist .seled1").attr("data-type", t), dataListpic(e)
};
$("body").on("click", ".btn-search", function() {
    searchMethod()
}), $("body").on("keydown", "#bookgototag", function(t) {
    13 == t.keyCode && searchMethod()
});
