$(".rank-list-w").slide({
    titCell: ".tabs-menu-r li",
    mainCell: ".tabs-cont-r",
    autoPlay: !1
}), $(".rankday").slide({
    titCell: ".clrbtna li",
    mainCell: ".tabsday-cont",
    autoPlay: !1,
    trigger: "click"
}), $(".rankweek").slide({
    titCell: ".clrbtnb li",
    mainCell: ".tabsweek-cont",
    autoPlay: !1,
    trigger: "click"
}), $(".rankmonth").slide({
    titCell: ".clrbtnb li",
    mainCell: ".tabmonth-cont",
    autoPlay: !1,
    trigger: "click"
}), $(".ranktogle").slide({
    titCell: ".clrbtnc li",
    mainCell: ".tabstogle-cont",
    autoPlay: !1,
    trigger: "click"
}), $(".rankdata").slide({
    titCell: ".comment-status li",
    mainCell: ".rankdatacont",
    autoPlay: !1,
    trigger: "click"
}), $(".clrbtn").on("click", "li", function() {
    var t = $(this).index();
    $(".clrbtn li").removeClass("on"), $.each($(".clrbtn"), function(l) {
        $(this).find("li").eq(t).addClass("on")
    })
}), $(".comment-status").on("click", "li", function() {
    var t = $(this).index();
    $(".tabsbox1").eq(t).find(".clrbtn li").filter(".on").click()
}), $(function() {
    var t = $(".leftbar ul").data("type");
    t ? $(".leftbar ul li").each(function() {
        if ($(this).find("a").attr("href").indexOf(t) > -1) {
            $(this).addClass("on");
            var l = $(this).text();
            $(".comment-r-menu .r-c-t").html(l)
        }
    }) : $(".leftbar ul li").eq(0).addClass("on");
    var l, a, r;
    $("body").on("click", ".addshelf", function() {
        if (!page_config.username) return pop_login(), !1;
        l = $(this).data("id"), a = $(this), r = $(this).data("control");
            if (r === "remove") return false;

        i()
    });
    var i = function() {
        $.ajax({
            type: "POST",
            url: "/modules/article/addbookcase.php",
            data: {bid:l,ajax_gets:1},
            dataType: "json",
            success: function(t) {
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
    };
    $(".lazyimg").lazyload({
        threshold: 100
    })
});
