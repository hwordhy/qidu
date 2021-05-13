$(function() {
    $(".comment_tit .sendcomment").on("click", function() {
        if (!page_config.username) return pop_login(), !1;
        comment_pop().show()
    }), $(".comment_con").on("click", ".comment_item .behavior .like", function() {
        if (!page_config.username) return pop_login(), !1;
        likeComment.likeEv($(this))
    }), reply_pop(0), $(".comment_con").on("click", ".comment_item .behavior .reply", function() {
        if (!page_config.username) return pop_login(), !1;
        var e = $(".comment_con .comment_item .behavior .reply").index($(this));
        reply_pop(e).hideFaceBox();
        var n = $(this).parents(".comment_item"),
            o = n.find(".replybox").is(":hidden");
        $(".comment_con .replybox").hide(), o && n.find(".replybox").show();
        var i = n.find(".replyer").width() + 10;
        n.find("textarea").css("textIndent", i)
    }), addShelf_zsy.initShelf($(".a-btn .a-bookshelf-btn")), $(".lazyimg").lazyload({
        threshold: 100,
        effect: "fadeIn",
        skip_invisible: !1
    })
});
