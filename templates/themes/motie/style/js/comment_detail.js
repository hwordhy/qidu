$(function() {
    $(".comment_con").on("click", ".comment_item .behavior .like", function() {
        if (!page_config.username) return pop_login(), !1;
        likeComment.likeEv($(this))
    }), $(".comment_con").on("click", ".behavior .reply", function() {
        if (!page_config.username) return pop_login(), !1;
        var e = $(".comment_con .behavior .reply").index($(this));
        reply_pop(e).hideFaceBox();
        var n = $(this).parents(".j_comment_item").find(".replybox"),
            t = n.is(":hidden");
        $(".comment_con .replybox").hide(), t && n.show();
        var o = n.find(".replyer").width() + 10;
        n.find("textarea").css("textIndent", o)
    }), addShelf_zsy.initShelf($(".a-btn .a-bookshelf-btn")), $(".comment_tit .sendcomment").on("click", function() {
        if (!page_config.username) return pop_login(), !1;
        comment_pop().show()
    }), function() {
        var e, n = null,
            t = page_config.comment_top && "true" === page_config.comment_top,
            o = page_config.comment_best && "true" === page_config.comment_best,
            c = page_config.reviewId,
            t_act = page_config.comment_top === "true" ? 'untop' : 'top',
            o_act = page_config.comment_best === "true" ? 'normal' : 'good',
            r = {
                init: function() {
                    n.topBtn && n.topBtn.on("click", function() {
                        if (!1 === t || !0 === t) {
                            var e = !t;
                            $.ajax({
                                url: "/modules/article/reviews.php",
                                data: {
                                    aid: page_config.bookId,
                                    rid: c,
                                    act: t_act,
                                    jieqi_token: jieqi_token,
                                    ajax_gets: 1
                                },
                                type: "POST",
                                success: function(o) {
                                    o = eval(o);
                                    if (o.success === true) {
                                        !0 === e ? n.topBtn.text("????????????") : n.topBtn.text("??????"), t = !t, layer.msg(o.message, {icon: 1,shade: .3})
                                    }
                                    else{
                                        layer.msg(o.message, {icon: 2,shade: .3});
                                    }
                                },
                                error: function(e) {}
                            })
                        }
                    }), n.bestBtn && n.bestBtn.on("click", function() {
                        if (!1 === o || !0 === o) {
                            var e = !o;
                            $.ajax({
                                url: "/modules/article/reviews.php",
                                data: {
                                    aid: page_config.bookId,
                                    rid: c,
                                    act: o_act,
                                    jieqi_token: jieqi_token,
                                    ajax_gets: 1
                                },
                                type: "POST",
                                success: function(t) {
                                    t = eval(t);
                                    if (t.success === true) {
                                        !0 === e ? n.bestBtn.text("????????????") : n.bestBtn.text("??????"), o = !o, layer.msg(t.message, {icon: 1,shade: .3})
                                    }
                                    else{
                                        layer.msg(t.message, {icon: 2,shade: .3});
                                    }
                                },
                                error: function(e) {}
                            })
                        }
                    })
                }
            };
        window.author_config = function(t) {
            return e ? (e.show(), n = t || {}, e) : (e = r, n = t || {}, e.init(), e)
        }
    }(), author_config({
        topBtn: $(".review-config .review-config-top"),
        bestBtn: $(".review-config .review-config-essence")
    }), $(".lazyimg").lazyload({
        threshold: 100,
        effect: "fadeIn",
        skip_invisible: !1
    })
});
