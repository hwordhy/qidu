var scrollWin = function(e) {
    var n = {
        already: !1,
        setAlready: function() {
            this.already = !0
        }
    },
    o = e.mainJq,
    t = o.offset().top,
    i = $(window).height(),
    a = function() {
        var o = $(document).scrollTop();
        t < o + i && e.callback(n)
    };
    $(window).on("scroll resize load",
    function() { ! 1 === n.already && a()
    })
};
$(function() {
    function e() {
        $(".fans_scrolling_wrapper").scrollTop() == o ? $(".fans_scrolling_wrapper").scrollTop(0) : $(".fans_scrolling_wrapper").scrollTop($(".fans_scrolling_wrapper").scrollTop() + 1)
    }
    function n() {
        var e = {
            method: "GET",
            url: "/ajax/review/book",
            async: !0,
            data: {
                bookId: page_config.bookId,
                type: 0
            },
            success: function(e) {
                $(".j-comment-main .comment_con_1").html(e),
                $(".morecomment").addClass("visiable"),
                $(".loading-comment").removeClass("visiable"),
                d()
            },
            error: function() {}
        };
        $.ajax(e)
    }
    var o, t = (document.getElementById("fans_scrolling"), $("#fans_scrolling")),
    i = (t.height(), $(".bonusitems").height(), $(".fans_scrolling_wrapper p").height()),
    a = $(".fans_scrolling_wrapper p").length - 3,
    l = null;
    o = i * a,
    l = setInterval(e, 25),
    $(".bonusitems").hover(function() {
        clearInterval(l)
    },
    function() {
        l = setInterval(e, 25)
    });
   
});