$(document).ready(function() {
    var t = function(t) {
            var e = $("#topicType").val(),
                o = $(".index_tab_cont .top"),
                n = "/modules/forum/topiclist.php",
                f = $("#fid").val();
            $.ajax({
                type: "get",
                url: n,
                data: {
                    fid: f,
                    isgood: 1,
                    ajax_gets: 1
                },
                dataType: "json",
                success: function(t) {
                    $.extend(t, {
                        top: !0
                    }), a("#topic-template", o, t), t.items.length > 0 ? ($(".index_tab_cont .top-list").show(), $(".common-list .j-title").addClass("show"), $(".common-list .j-title-num").removeClass("show")) : ($(".index_tab_cont .top-list").hide(), $(".common-list .j-title").removeClass("show"), $(".common-list .j-title-num").addClass("show")), page_footer()
                }
            })
        },
        p = function(t) {
            t || (t = 1);
            var e = $("#topicType").val(),
                f = $("#fid").val(),
                n = $(".index_tab_cont .common"),
                i = "/modules/forum/topiclist.php";
            $.ajax({
                type: "get",
                url: i,
                data: {
                    fid: f,
                    isgood: 0,
                    ajax_gets: 1,
                    page: t
                },
                dataType: "json",
                success: function(o) {
                    $.extend(o, {
                        top: !1
                    }), a("#topic-template", n, o), page_footer(), o.items && o.items.length > 0 ? (o.pageCount > 0 ? $(".page-box .pages").pagination({
                        hoverCls: "ui_hoverbgbd",
                        activeCls: "ui_bg_bdcolor",
                        pageAll: o.pageCount,
                        current: t,
                        callback: function(t) {
                            var o = t.getCurrent();
                            p(o)
                        }
                    }, function(t) {}) : $(".page-box .pages").empty(), $(".index_tab_cont .common-list").show()) : ($(".page-box .pages").empty(), $(".index_tab_cont .common-list").hide())
                }
            })
        },
        o = function(t) {
            var e = $("#topicType").val(),
                o = $("#isBest").val(),
                f = $("#fid").val(),
                a = "/modules/forum/topiclist.php";
            $.ajax({
                type: "get",
                url: a,
                data: {
                    fid: f,
                    ajax_gets: 1
                },
                dataType: "json",
                success: function(t) {
                    $(".topic_count").html(t.totalCount), 0 == t.totalCount ? ($(".errortips").show(), $(".errortips").html("还没有相关的帖子")) : ($(".errortips").hide(), $(".errortips").html(""))
                }
            })
        };
    $("#tabsmenu li").click(function() {
        var a = $(this),
            s = a.data("type"),
            n = (a.data("bind"), a.data("best"));
        n ? $("#isBest").val(n) : $("#isBest").val(""), a.addClass("on ui_").siblings().removeClass("on"), $("#topicType").val(s), t(), p(), o()
    }), $("#tabsmenu li").eq(0).click();
    var a = function(t, e, o) {
        var a = Handlebars.compile($(t).html());
        e.html(""), e.html(a(o))
    }
});
