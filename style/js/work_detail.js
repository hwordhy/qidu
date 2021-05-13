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
    $(window).on("scroll resize load", function() {
        !1 === n.already && a()
    })
};
$(function() {
    function e() {
        $(".fans_scrolling_wrapper").scrollTop() == o ? $(".fans_scrolling_wrapper").scrollTop(0) : $(".fans_scrolling_wrapper").scrollTop($(".fans_scrolling_wrapper").scrollTop() + 1)
    }
    function n() {
        var e = {
            method: "GET",
            url: "/modules/article/reviews.php",
            async: !0,
            data: {
                aid: page_config.bookId,
                ajax_gets: 1
            },
            success: function(e) {
                $(".j-comment-main .comment_con_1").html(e), $(".morecomment").addClass("visiable"), $(".loading-comment").removeClass("visiable"), d()
            },
            error: function() {}
        };
        $.ajax(e)
    }
    var o, t = (document.getElementById("fans_scrolling"), $("#fans_scrolling")),
        i = (t.height(), $(".bonusitems").height(), $(".fans_scrolling_wrapper p").height()),
        a = $(".fans_scrolling_wrapper p").length - 3,
        l = null;
    o = i * a, l = setInterval(e, 25), $(".bonusitems").hover(function() {
        clearInterval(l)
    }, function() {
        l = setInterval(e, 25)
    });
    var s = $(".all_work_contentbox").bxSlider({
            slideWidth: 84,
            minSlides: 1,
            maxSlides: 2,
            startSlides: 0,
            slideMargin: 35,
            pager: !1,
            nextSelector: ".j_all_work_next",
            nextText: "",
            prevSelector: ".j_all_work_prev",
            prevText: "",
            moveSlides: 1,
            infiniteLoop: !1,
            onSlideAfter: function(e, n, o) {
                s.getSlideCount() - 2 == o && ($(".j_all_work_next").removeClass("on").addClass("stop"), $(".j_all_work_prev").removeClass("stop").addClass("on")), 0 == o && ($(".j_all_work_prev").removeClass("on").addClass("stop"), $(".j_all_work_next").removeClass("stop").addClass("on"))
            },
            onSliderLoad: function() {
                $(".all_work_contentboxitem").addClass("visiable"), $(".all_work_contentboxitem").length > 2 && ($(".j_all_work_next").addClass("on show"), $(".j_all_work_prev").addClass("show"))
            }
        }),
        c = 0,
        r = location.href.indexOf("#catalog") > -1;
    location.href.indexOf("#brief") > -1 ? c = 0 : ("readPage" === page_config.callbackPageStr || r) && (c = 1), jQuery("#content-tab").slide({
        mainCell: ".j-content-main",
        titCell: ".j-content-tab span",
        autoPlay: !1,
        trigger: "click",
        defaultIndex: c,
        startFun: function(e, n) {
            1 == e ? $("#content-tab .header").css("width", "1200px") : $("#content-tab .header").css("width", "950px")
        }
    }), $(".btns .interaction").on("click", function() {
        if (!page_config.username) return pop_login(), !1;
        bouns_pop({
            successApplause: function() {
                $(".j-comment-main .comment_con_1 .comment_con_newes").length > 0 && setTimeout(function() {
                    n()
                }, 2e3)
            }
        }).show()
    }), addShelf_zsy.initShelf($(".btns .addshelf")), $(".hongbao .btn").on("click", function() {
        if (!page_config.username) return pop_login(), !1;
        var e = bouns_pop({
            successApplause: function() {
                $(".j-comment-main .comment_con_1 .comment_con_newes").length > 0 && setTimeout(function() {
                    n()
                }, 2e3)
            }
        });
        e.show(), e.switchToApplause()
    }), $(".action .subscribe").on("click", function() {
        layerPop.openTips("订阅成功，请在交易记录中查询", 1e3)
    }), new(function() {
        function e(e) {
            this.$jq = $(e), this.isShow = !1, this.$ewJq = $(".erweima_app"), this.timer = null, this.init()
        }
        return e.prototype.init = function() {
            var e = this;
            this.$jq.on("mouseenter", function() {
                e.isShow = !0, clearTimeout(e.timer), e.show()
            }), this.$jq.on("mouseleave", function() {
                e.isShow = !1, e.hide()
            }), this.$ewJq.on("mouseenter", function() {
                e.isShow = !0, clearTimeout(e.timer)
            }), this.$ewJq.on("mouseleave", function() {
                e.isShow = !1, e.hide()
            })
        }, e.prototype.show = function() {
            this.$ewJq.show()
        }, e.prototype.hide = function() {
            var e = this;
            this.timer = setTimeout(function() {
                e.$ewJq.hide()
            }, 1e3)
        }, e
    }())(".phoneread"), $(".comment_tit .sendcomment").on("click", function() {
        if (!page_config.username) return pop_login(), !1;
        comment_pop({
            success: function() {
                jQuery("#comment-tab").slide({
                    mainCell: ".j-comment-main",
                    titCell: ".j-comment-tab span",
                    autoPlay: !1,
                    trigger: "click"
                })
            }
        }).show()
    }), $(".j-comment-main ").on("click", ".comment-null .needreview", function() {
        if (!page_config.username) return pop_login(), !1;
        comment_pop().show()
    }), $(".comment_con").on("click", ".comment_item .behavior .like", function() {
        if (!page_config.username) return pop_login(), !1;
        likeComment.likeEv($(this))
    }), $(".comment_con").on("click", ".comment_item .behavior .reply", function() {
        if (!page_config.username) return pop_login(), !1;
        var e = $(".comment_con .comment_item .behavior .reply").index($(this));
        reply_pop(e).hideFaceBox();
        var n = $(this).parents(".comment_item"),
            o = n.find(".replybox").is(":hidden");
        $(".comment_con .replybox").hide(), o && n.find(".replybox").show();
        var t = n.find(".replyer").width() + 10;
        n.find("textarea").css("textIndent", t)
    }), $("body").on("click", "#errtips .close", function() {
        $("#errtips").hide()
    });
    var m = null;
    $(".medal .j-medal-icon").on("mouseenter", function() {
        var e = $(this).position().left,
            n = $(this).position().top,
            o = $(".medal .medal-pic");
        clearTimeout(m), o.find(".img-big img").attr("src", $(this).data("imgbig")), o.find(".img-title").attr("src", $(this).data("imgtitle")), o.find(".desc").text($(this).data("desc")), o.show().css({
            left: e - 195,
            top: n + 32
        })
    }), $(".medal .j-medal-icon").on("mouseleave", function() {
        m = setTimeout(function() {
            $(".medal .medal-pic").hide()
        }, 1e3)
    }), $(".medal .medal-pic").on("mouseenter", function() {
        clearTimeout(m)
    }), $(".medal .medal-pic").on("mouseleave", function() {
        clearTimeout(m), m = setTimeout(function() {
            $(".medal .medal-pic").hide()
        }, 1e3)
    });
    var d = function() {
        jQuery("#comment-tab").slide({
            mainCell: ".j-comment-main",
            titCell: ".j-comment-tab span",
            autoPlay: !1,
            trigger: "click",
            startFun: function(e, n) {
                if (1 === e && 0 === $(".j-comment-main .comment_con_essense").length) {
                    var o = {
                        method: "GET",
                        url: "/modules/article/reviews.php",
                        async: !0,
                        data: {
                            aid: page_config.bookId,
                            type: 'good',
                            ajax_gets: 1
                        },
                        success: function(e) {
                            $(".j-comment-main .comment_con_2").html(e)
                        },
                        error: function() {}
                    };
                    $.ajax(o)
                }
            }
        })
    };
    scrollWin({
        mainJq: $("#comment-tab"),
        callback: function(e) {
            $(".loading-comment").addClass("visiable"), n(), e.setAlready()
        }
    }), $(".work_brief .brief p").text($(".work_brief .brief p").text().substring(0, 120) + "..."), $(".lazyimg").lazyload({
        threshold: 100,
        effect: "fadeIn",
        skip_invisible: !1
    }), $(".cate-list li a").each(function() {
        var e = (new Date).getTime(),
            n = new Date($(this).attr("data-time")).getTime(),
            o = e - n;
        Math.floor(o / 864e5) <= 6 && $('<span  class="newChapter"></span>').appendTo($(this))
    }), $(".see_more").hover(function() {
        $(this).addClass("ui_color")
    }, function() {
        $(this).removeClass("ui_color")
    })
});
