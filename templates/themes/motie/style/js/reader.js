var module_common = {
        modules: [],
        add: function(t) {
            for (var e = !1, o = 0; o < this.modules.length; o++) t === this.modules[o] && (e = !0);
            e || this.modules.push(t)
        },
        remove: function(t) {
            for (var e = 0; e < this.modules.length; e++) this.modules[e] && this.modules.splice(e, 1)
        },
        removeAll: function() {
            this.modules = []
        },
        hide: function() {
            for (var t = 0; t < this.modules.length; t++) this.modules[t].isShow && this.modules[t] != module_buyBox && this.modules[t].hide()
        }
    },
    module_bg = {
        target: null,
        isShow: !1,
        init: function(t) {
            this.target = t, t.on("click", function() {
                module_common.hide()
            })
        },
        show: function() {
            this.target.show()
        },
        hide: function() {
            this.target.hide()
        }
    },
    module_catalog = {
        target: null,
        isShow: !1,
        isHaveCatalog: !1,
        init: function(t) {
            this.target = t, module_common.add(this);
            var e = this;
            t.on("click", function() {
                $(this).addClass("on"), module_common.hide(), module_bg.show(), e.isShow ? e.hide() : e.show()
            }), $("#floatbox").on("click", ".catalog_con .volume_title", function() {
                if ($(".catalog_con .volume_title").length < 2);
                else {
                    var t = $(this).parent(".volume");
                    "collapse" == t.data("collapse") ? (t.find(".volume_con").show(), t.data("collapse", ""), t.find(".arrow_icon").addClass("collapse")) : (t.find(".volume_con").hide(), t.data("collapse", "collapse"), t.find(".arrow_icon").removeClass("collapse"))
                }
            }), $("#floatbox").on("click", ".catalog_con .catalog-close", function() {
                e.hide()
            })
        },
        getCatalog: function() {
            var t = this;
            $.ajax({
                url: "/modules/article/reader.php",
                type: "GET",
                data: {
                    aid: page_config.bookId,
                    currcid: page_config.chapterId,
                    ajax_gets: 1
                },
                success: function(e) {
                    $("#floatbox").append(e), $("#floatbox .catalog_con").show(), module_win.catalogHeight(), t.isShow = !0, t.isHaveCatalog = !0, $(".catalog_con .volume_title").length < 2 && $(".catalog_con .volume_title .arrow_icon").hide(), $(".catalog_con .cur_volume .arrow_icon").addClass("collapse")
                },
                error: function(t) {}
            })
        },
        show: function() {
            this.isHaveCatalog ? ($("#floatbox .catalog_con").show(), this.isShow = !0, module_win.catalogHeight()) : this.getCatalog(), this.target.addClass("on")
        },
        hide: function() {
            $("#floatbox .catalog_con").hide(), this.target.removeClass("on"), module_bg.hide(), this.isShow = !1
        },
        collapse: function() {}
    },
    module_setting = {
        target: null,
        isShow: !1,
        defaultSize: 18,
        defaultFamily: "微软雅黑",
        deafaultTheme: "whitetheme",
        userSelectSize: null,
        userSelectFamily: null,
        isMac: /macintosh|mac os x/i.test(navigator.userAgent),
        init: function(t) {
            module_common.add(this);
            var e = this;
            this.target = t, t.on("click", function() {
                module_common.hide(), e.isShow ? e.hide() : e.show()
            });
            var o = $("#floatbox .settings_con");
            o.find(".close").on("click", function() {
                e.hide(), module_bg.hide()
            }), o.find(".set_bg_com").on("click", function() {
                var t = $(this).data("bodytheme");
                e.setBodyTheme(t, $(this))
            }), o.find(".set_font_small").on("click", function() {
                null === e.userSelectSize && (e.userSelectSize = e.defaultSize), e.userSelectSize -= 2, e.userSelectSize < 12 && (e.userSelectSize = 12), $(".chapter-page pre").css("fontSize", e.userSelectSize), o.find(".set_font_cur").text(e.userSelectSize), module_store.set("userSelectSize", e.userSelectSize)
            }), o.find(".set_font_big").on("click", function() {
                null === e.userSelectSize && (e.userSelectSize = e.defaultSize), e.userSelectSize += 2, e.userSelectSize > 48 && (e.userSelectSize = 48), $(".chapter-page pre").css("fontSize", e.userSelectSize), o.find(".set_font_cur").text(e.userSelectSize), module_store.set("userSelectSize", e.userSelectSize)
            }), o.find(".set_style_com").on("click", function() {
                var t = $(this).data("family");
                e.isMac && (t += "-macos"), e.setBodyFamily(t, $(this))
            }), o.find(".set_default").on("click", function() {
                "zt" == page_config.siteValue ? o.find(".set_bg_green").trigger("click") : o.find(".set_bg_white").trigger("click"), e.userSelectSize = e.defaultSize, $(".chapter-page pre").css("fontSize", e.userSelectSize), o.find(".set_font_cur").text(e.userSelectSize), o.find(".set_style_yh").trigger("click"), module_store.remove("userSelectFamily"), module_store.remove("userSelectSize"), module_store.remove("bodytheme")
            }), this.renderUserSelect()
        },
        hide: function() {
            $("#floatbox .settings_con").hide(), this.isShow = !1, module_bg.hide(), this.target.removeClass("on")
        },
        show: function() {
            $("#floatbox .settings_con").show(), this.isShow = !0, this.target.addClass("on"), module_bg.show()
        },
        renderUserSelect: function() {
            var t = this,
                e = module_store.get("userSelectFamily"),
                o = module_store.get("userSelectSize"),
                i = module_store.get("bodytheme");
            i ? $("#floatbox .settings_con .set_bg_com").each(function() {
                $(this).data("bodytheme") == i && t.setBodyTheme(i, $(this))
            }) : "zt" == page_config.siteValue && $("#floatbox .settings_con").find(".set_bg_green").trigger("click"), e && $("#floatbox .settings_con .set_style_com").each(function() {
                $(this).data("family") != e && $(this).data("family") + "-macos" != e || t.setBodyFamily(e, $(this))
            }), o && (t.userSelectSize = o, $("#floatbox .settings_con .set_font_cur").text(t.userSelectSize), $(".chapter-page pre").css("fontSize", t.userSelectSize))
        },
        setBodyTheme: function(t, e) {
            $("body").removeClass().addClass(t), e.siblings().removeClass("on").end().addClass("on"), module_store.set("bodytheme", t)
        },
        setBodyFamily: function(t, e) {
            $(".chapter-page pre").removeClass("familymicro familymicro-macos familysimsun familysimsun-macos familykaiti familykaiti-macos").addClass(t), e.siblings().removeClass("on").end().addClass("on"), module_store.set("userSelectFamily", t)
        }
    },
    module_phone = {
        target: null,
        isShow: !1,
        init: function(t) {
            module_common.add(this);
            var e = this;
            this.target = t, t.on("click", function() {
                module_common.hide(), module_bg.show(), e.isShow ? ($("#floatbox .erweima_app").hide(), e.hide()) : e.show()
            }), $("#floatbox .erweima_app_close").on("click", function() {
                e.hide()
            })
        },
        hide: function() {
            $("#floatbox .erweima_app").hide(), this.target.removeClass("on"), this.isShow = !1, module_bg.hide()
        },
        show: function() {
            $("#floatbox .erweima_app").show(), this.target.addClass("on"), module_bg.show(), this.isShow = !0
        }
    },
    module_guide = {
        target: null,
        isShow: !1,
        init: function(t) {
            module_common.add(this), this.target = t;
            var e = this;
            t.on("click", function() {
                module_common.hide(), module_bg.show(), e.isShow ? e.hide() : e.show()
            }), $("#floatbox .guide-pop .guide-btn").on("click", function() {
                e.hide()
            }), $("#floatbox .guide-pop .close").on("click", function() {
                e.hide()
            })
        },
        show: function() {
            $("#floatbox .guide_tips_left").show(), $("#floatbox .guide-pop").show(), $("#floatbox .guide_tips_right").show(), this.target.addClass("on"), this.isShow = !0
        },
        hide: function() {
            this.target.removeClass("on"), $("#floatbox .guide_tips_left").hide(), $("#floatbox .guide-pop").hide(), $("#floatbox .guide_tips_right").hide(), module_bg.hide(), this.isShow = !1
        }
    },
    module_win = {
        init: function() {
            var t = this;
            $(window).on("resize load", function(e) {
                $(window).width() <= 1200 ? ($("#floatbox").addClass("fix_to_left"), $("#floatbox .guide").addClass("fix_to_left"), $("#floatbox .rightbar").addClass("fix_to_left")) : ($("#floatbox .guide").removeClass("fix_to_left"), $("#floatbox .rightbar").removeClass("fix_to_left"), $("#floatbox").removeClass("fix_to_left")), t.catalogHeight()
            }), t.preventCopy()
        },
        catalogHeight: function() {
            var t = $(window).height();
            $(".catalog-inner").css("maxHeight", t - 360)
        },
        preventCopy: function() {
            $("body").on("contextmenu", function() {
                return !1
            }), $(document).on("contextmenu", "pre div p", function() {
                return !1
            }).on("cut", "pre div p", function() {
                return !1
            }).on("dragstart", "pre div p", function() {
                return !1
            }).on("copy", "pre div p", function() {
                return !1
            })
        }
    },
    module_donate = {
        target: null,
        donateObj: null,
        isShow: !1,
        initDonate: function(t) {
            var e = this;
            e.target = t;
            var o = function() {
                module_common.hide(), e.donateObj || (e.donateObj = bouns_pop(), module_common.add(e)), e.show(), e.donateObj.switchToApplause()
            };
            t.off().on("click", function() {
                if (!page_config.username) return pop_login(), !1;
                o()
            })
        },
        initVote: function(t) {
            var e = this,
                o = function() {
                    module_common.hide(), e.donateObj || (e.donateObj = bouns_pop(), module_common.add(e)), e.show()
                };
            t.on("click", function() {
                if (!page_config.username) return pop_login(), !1;
                o()
            })
        },
        show: function() {
            this.donateObj.show(), this.target.addClass("on"), this.isShow = !0
        },
        hide: function() {
            this.target.removeClass("on"), this.donateObj.close(), this.isShow = !1
        }
    },
    module_comment = {
        target: null,
        commentObj: null,
        isShow: !1,
        init: function(t) {
            var e = this;
            e.target = t;
            var o = function() {
                module_common.hide(), e.commentObj || (e.commentObj = comment_pop(), module_common.add(e)), e.commentObj.show()
            };
            t.off().on("click", function() {
                if (!page_config.username) return pop_login(), !1;
                o()
            })
        },
        show: function() {
            this.commentObj.show(), this.target.addClass("on"), this.isShow = !0
        },
        hide: function() {
            this.target.removeClass("on"), this.commentObj.close(), this.isShow = !0
        }
    },
    module_content = {
        params: {},
        isFirst: !0,
        chapterId: null,
        isToBottom: !1,
        ajaxStatus: !1,
        nextChapterId: page_config.nextChapterId,
        nextisvip: page_config.nextisvip,
        isvip: page_config.isvip,
        init: function() {
            this.controller(), this.scrollChapter()
        },
        controller: function() {
            var t = this;
            this.ajaxContent(t.getParams())
        },
        getParams: function() {
            return this.isFirst ? (this.chapterId = parseInt(page_config.chapterId), {
                cid: this.chapterId,
                aid: page_config.bookId,
                ajax_gets: 1
            }) : {
                cid: this.nextChapterId,
                aid: page_config.bookId,
                ajax_gets: 1
            }
        },
        ajaxContent: function(t) {
            if (!this.nextChapterId) return layerPop.openEmptyTips("已经是最后一章啦！"), this.isToBottom = !1, !1;
            if (!t.cid) return layerPop.openEmptyTips("下章出问题了，请刷新再试"), this.isToBottom = !1, !1;
            if (!0 === this.ajaxStatus) return void(this.isToBottom = !1);
            this.ajaxStatus = !0;
            var e = this;
            $(".loading").show();
            var o = (new Date).getTime(),
                url = 0 < this.nextisvip && e.isFirst === false ? "/modules/obook/reader.php" : "/modules/article/reader.php";
            if (0 < this.isvip)  url = "/modules/obook/reader.php";
            $.ajax({
                url: url,
                type: "get",
                data: t,
                success: function(t) {
                    (new Date).getTime() - o < 1e3 ? setTimeout(function() {
                        e.chapter(t), e.isFirst = !1, $(".loading").hide(), e.isToBottom = !1
                    }, 1e3) : ($(".loading").hide(), e.chapter(t), e.isFirst = !1, e.isToBottom = !1)
                },
                error: function(t) {},
                complete: function() {
                    e.ajaxStatus = !1
                }
            })
        },
        chapter: function(t) {
            $(".blank-div").remove(), $(".notread").remove(), $(".read-box").append(t);
            var e = $(t);
            this.renderAuthorSay(), this.chapterId = e.data("chapterid"), page_config.curChapterId = this.chapterId, this.nextChapterId = e.data("nextchapter"), this.isvip = e.data("isvip"), this.nextisvip = e.data("nextisvip"), e = null, module_donate.initDonate($(".chapter-behavior .behavior-donate")), module_comment.init($(".chapter-behavior .behavior-comment")), module_setting.renderUserSelect(), $(".notread").length > 0 ? (module_buyBox.isShow = !0, module_buyBox.init()) : module_buyBox.isShow = !1
        },
        scrollChapter: function() {
            var t = this;
            t.addScrollBar(), $(window).on("scroll", function(e) {
                var o = $(document).scrollTop();
                if (!t.isFirst && !0 !== t.isToBottom && !0 !== module_buyBox.isShow) {
                    var i = $(window).height();
                    $(document).height() <= o + i + 3 && (t.isToBottom = !0, t.ajaxContent(t.getParams()))
                }
            })
        },
        addScrollBar: function() {},
        renderAuthorSay: function() {
            var t = $(".chapter-page").last();
            if (!(t.find(".chapter-author-say").length = 0)) {
                var e = t.find(".chapter-author-say").attr("data-say");
                if (e) {
                    for (var o = e.split("\n"), i = "", n = 0; n < o.length; n++) i += '<p class="text">' + o[n].replace(/^\s+|\s+$/g, "") + "</p>";
                    t.find(".author-text").html(i)
                }
            }
        }
    },
    module_pageScroll = {
        currentWinHeight: null,
        $prevBtn: null,
        $nextBtn: null,
        initPrev: function(t) {
            var e = this;
            e._initWinResize(), e._initWinKeyboard(), e.$prevBtn = t, t.on("click", function() {
                var t = $(document).scrollTop();
                e.currentWinHeight || (e.currentWinHeight = $(window).height()), $("body,html").animate({
                    scrollTop: t - e.currentWinHeight + 80
                }, 200)
            })
        },
        initNext: function(t) {
            var e = this;
            e.$nextBtn = t, t.on("click", function() {
                var t = $(document).scrollTop();
                e.currentWinHeight || (e.currentWinHeight = $(window).height()), $("body,html").animate({
                    scrollTop: t + e.currentWinHeight - 120
                }, 200)
            })
        },
        _initWinResize: function() {
            var t = this;
            $(window).on("resize", function() {
                t.currentWinHeight = $(window).height()
            })
        },
        _initWinKeyboard: function() {
            var t = this;
            $(window).on("keydown", function(e) {
                38 == e.keyCode && t.$prevBtn.click(), 40 == e.keyCode && t.$nextBtn.click()
            })
        }
    },
    module_buyBox = {
        target: null,
        status: "curChapter",
        chapterData: null,
        singleAuto: !0,
        batchAuto: !0,
        singleCoupon: !1,
        batchCoupon: !1,
        isInit: !1,
        isShow: !1,
        unloginAuto: !1,
        init: function() {
            this.singleCoupon = !1, this.batchCoupon = !1, this.singleAuto = !0, this.batchAuto = !0, this.target || (this.target = $(".read-box")), this.getChapterData(), this.isInit || (this.isInit = !0, this.addEvent()), module_common.hide(), this.target.find(".notread-last").length > 0 && this.getCommentAndBook()
        },
        addEvent: function() {
            function t(t, e) {
                t ? e.find("i").addClass("show") : e.find("i").removeClass("show")
            }
            var e = this;
            this.target.on("click", ".notread .unLogin-btn .item", function() {
                pop_login({
                    completeFn: function() {
                        var t = location.href,
                            e = t.split("/book")[0] + "/book/" + page_config.bookId + "_" + page_config.curChapterId;
                        location.href = e
                    }
                })
            }), this.target.on("click", ".notread .subscribe-con .con-item", function() {
                $(this).siblings().removeClass("active"), $(this).addClass("active")
            }), this.target.on("click", ".notread .subscribe-con .j-single-auto", function() {
                $(this).hasClass("unclick") || (e.singleAuto = !e.singleAuto, t(e.singleAuto, $(this)))
            }), this.target.on("click", ".notread .subscribe-con .j-single-coupon", function() {
                $(this).hasClass("unclick") || (e.singleCoupon = !e.singleCoupon, t(e.singleCoupon, $(this)), e.setSingleStatus())
            }), this.target.on("click", ".notread .subscribe-con .j-batch-auto", function() {
                $(this).hasClass("unclick") || (e.batchAuto = !e.batchAuto, t(e.batchAuto, $(this)))
            }), this.target.on("click", ".notread .subscribe-con .j-batch-coupon", function() {
                $(this).hasClass("unclick") || (e.batchCoupon = !e.batchCoupon, t(e.batchCoupon, $(this)), e.setBatchStatus())
            }), this.target.on("click", ".notread .subscribe-con .j-single-buy", function() {
                var t = e.getBuyParams("single");
                module_content.ajaxContent(t)
            }), this.target.on("click", ".notread .subscribe-con .j-batch-buy", function() {
                var t = e.getBuyParams("batch");
                module_content.ajaxContent(t)
            }), this.target.on("click", ".notread .j-unlogin_auto", function() {
                e.unloginAuto = !e.unloginAuto, t(e.unloginAuto, $(this))
            })
        },
        getChapterData: function() {
            var t = this.target.find(".notread");
            this.chapterData = {
                chapterId: t.attr("data-chapterid"),
                balance: t.attr("data-balance"),
                singlePrice: t.attr("data-singleprice"),
                batchPrice: t.attr("data-batchprice"),
                ticket: t.attr("data-ticket"),
                disBatchPrice: t.attr("data-disbatchprice")
            }
        },
        setSingleStatus: function() {
            this.singleCoupon ? (this.target.find(".j-single-buy").addClass("show"), this.target.find(".j-single-charge").removeClass("show")) : +this.chapterData.balance < +this.chapterData.singlePrice ? (this.target.find(".j-single-charge").addClass("show"), this.target.find(".j-single-buy").removeClass("show")) : (this.target.find(".j-single-charge").removeClass("show"), this.target.find(".j-single-buy").addClass("show"))
        },
        setBatchStatus: function() {
            this.batchCoupon ? (this.target.find(".j-batch-buy").addClass("show"), this.target.find(".j-batch-charge").removeClass("show")) : +this.chapterData.balance < +this.chapterData.disBatchPrice ? (this.target.find(".j-batch-charge").addClass("show"), this.target.find(".j-batch-buy").removeClass("show")) : (this.target.find(".j-batch-charge").removeClass("show"), this.target.find(".j-batch-buy").addClass("show"))
        },
        getBuyParams: function(t) {
            var e, o, i;
            return "single" == t && (e = this.singleCoupon ? 1 : 0, i = +this.chapterData.singlePrice, o = this.singleAuto), "batch" == t && (e = this.batchCoupon ? 1 : 0, i = +this.chapterData.disBatchPrice, o = this.batchAuto), {
                type: e,
                buy: t,
                auto: o,
                money: i,
                chapterId: +this.chapterData.chapterId
            }
        },
        toCharge: function() {
            if (this.buyStatus) return !0;
            location.href = "/payment/choose"
        },
        renderComment: function(t) {
            var e = Handlebars.compile($("#comment-box-template").html());
            this.target.find(".comment-box").html(e(t))
        },
        renderBookList: function(t) {
            var e = Handlebars.compile($("#book-list1-template").html());
            this.target.find(".book-list1").html(e(t))
        },
        getCommentAndBook: function() {
            var t = this;
            $.ajax({
                url: "/ajax/book/resurces?bookId=" + page_config.bookId,
                type: "GET",
                data: {}
            }).done(function(e) {
                200 == e.code && (t.renderComment(e), t.renderBookList(e))
            })
        }
    },
    module_store = function() {
        return store
    }();
$(function() {
    module_catalog.init($("#floatbox .leftbar .catalog")), module_setting.init($("#floatbox .leftbar .settings")), module_phone.init($("#floatbox .leftbar .cellphone")), addShelf_zsy.initReaderShelf($("#floatbox .leftbar .addshelf")), module_guide.init($("#floatbox .leftbar .guide")), module_win.init(), module_bg.init($("#windowbg")), module_content.init(), module_donate.initDonate($(".rightbar .donate")), module_donate.initVote($(".rightbar .vote")), module_pageScroll.initPrev($(".rightbar .prevpage")), module_pageScroll.initNext($(".rightbar .nextpage"))
});
