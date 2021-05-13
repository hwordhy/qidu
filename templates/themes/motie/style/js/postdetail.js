$(function() {
    var t = page_config.topicId,
        e = function(t) {
            t && ($(".reply-box .replyer").text("回复@" + t + " : "), $(".reply-box textarea").val(""))
        },
        i = function(t) {
            $(".reply-box").attr("data-fid", t)
        },
        o = 1;
    ({
        reply: page_config.reply,
        toTop: page_config.toTop,
        essence: page_config.essence,
        like: !1,
        $postInfoOperator: $(".post-info .j-operator"),
        init: function() {
            this.addEVent()
        },
        addEVent: function() {
            var o = this;
            this.$postInfoOperator.find(".essence").on("click", function() {
                if (!page_config.username) return pop_login(), !1;
                o.essence ? $.ajax({
                    url: "/ajax/bbs/topics/" + t + "/best",
                    data: {},
                    type: "DELETE",
                    success: function(t) {
                        t.success ? (o.essence = !1, o.$postInfoOperator.find(".essence").text("精华")) : layerPop.openEmptyTips(t.msg)
                    },
                    error: function(t) {}
                }) : $.ajax({
                    url: "/ajax/bbs/topics/" + t + "/best",
                    data: {},
                    type: "PUT",
                    success: function(t) {
                        t.success ? (o.$postInfoOperator.find(".essence").text("取消精华"), o.essence = !0) : layerPop.openEmptyTips(t.msg)
                    },
                    error: function(t) {}
                })
            }), this.$postInfoOperator.find(".to-top").on("click", function() {
                if (!page_config.username) return pop_login(), !1;
                o.toTop ? $.ajax({
                    url: "/ajax/bbs/topics/" + t + "/top",
                    data: {},
                    type: "DELETE",
                    success: function(t) {
                        t.success ? (o.toTop = !1, o.$postInfoOperator.find(".to-top").text("置顶")) : layerPop.openEmptyTips(t.msg)
                    },
                    error: function(t) {}
                }) : $.ajax({
                    url: "/ajax/bbs/topics/" + t + "/top",
                    data: {},
                    type: "PUT",
                    success: function(t) {
                        t.success ? (o.$postInfoOperator.find(".to-top").text("取消置顶"), o.toTop = !0) : layerPop.openEmptyTips(t.msg)
                    },
                    error: function(t) {}
                })
            }), this.$postInfoOperator.find(".forbid").on("click", function() {
                if (!page_config.username) return pop_login(), !1;
                o.reply ? $.ajax({
                    url: "/ajax/bbs/topics/" + t + "/allowreply",
                    data: {},
                    type: "DELETE",
                    success: function(t) {
                        location.reload()
                    },
                    error: function(t) {}
                }) : $.ajax({
                    url: "/ajax/bbs/topics/" + t + "/allowreply ",
                    data: {},
                    type: "PUT",
                    success: function(t) {
                        t.success && location.reload()
                    },
                    error: function(t) {}
                })
            }), this.$postInfoOperator.find(".del ").on("click", function() {
                function e(e) {
                    var p = $("#pid").val();
                    e = e || "", $.ajax({
                        url: "/modules/forum/delpost.php",
                        data: {fid:page_config.fid,tid:page_config.topicId,pid:p,ajax_gets:1},
                        type: "POST",
                        success: function(t) {
                            t = eval(t);
                            if (true === t.success) {
                                $(".del_Layer_div").hide(), layerPop.openTips(t.message), setTimeout(function() {
                                    location.href = "/modules/forum/topiclist.php?fid=" + page_config.fid
                                }, 2e3)
                            }
                            else{
                                $(".del_Layer_div").hide();
                                layer.msg(t.message, {icon: 2,shade: .3});
                            }
                        },
                        error: function(t) {}
                    })
                }
                if (!page_config.username) return pop_login(), !1;
                var i = null;
                1 == page_config.admin && 0 == page_config.me ? ($(".poupout").show(), $(".delreason>span").removeClass("delreasonOn"), $(".delreason  .delarea").val(""), $(".dcancelbtn,.popclose").off().on("click", function() {
                    $(".poupout").hide()
                }), $(".delreason>span").off().on("click", function() {
                    $(this).addClass("delreasonOn").siblings().removeClass("delreasonOn").parents(".delreason").siblings(".delarea").children().removeClass("delreasonOn").val(""), i = $(this).text(), $(".poupout .warning").removeClass("showOn")
                }), $(".deltext").off().on("click", function() {
                    $(this).addClass("delreasonOn").parents(".delarea").siblings(".delreason").children().removeClass("delreasonOn")
                }), $(".deltext").blur(function() {
                    i = $(this).val()
                }), $(".dconfirmbtn").off().on("click", function() {
                    return "" == i || null == i ? ($(".poupout .warning").addClass("showOn").text("请选择或填写删除理由"), !1) : i.length < 5 || i.length > 20 ? ($(".poupout .warning").addClass("showOn").text("请填写5-20个字"), !1) : ($(".poupout").hide(), void e("?reason=" + i))
                })) : (1 == page_config.me && page_config.admin, $("body,.del_Layer_div").fadeIn(300).height($(window).height()).addClass("addOn"), $(".del_Layer_close,.del_Layer_no").off().on("click", function() {
                    $(".del_Layer_div").fadeOut(300), $("body").removeClass("addOn")
                }), $(".del_Layer_yes").off().on("click", function() {
                    e()
                }))
            }), $(".post-bottom .j-like").on("click", function() {
                if (!page_config.username) return pop_login(), !1;
                var e = this;
                $.ajax({
                    url: "/ajax/favorite/" + t + "/19/set",
                    data: {},
                    type: "POST",
                    success: function(t) {
                        $(e).find(".heart-number").text("(" + t.favor + ")")
                    },
                    error: function(t) {}
                })
            }), $(".post-bottom .j-reply").on("click", function() {
                if (!page_config.username) return pop_login(), !1;
                var t = $(".post-info .creator .name").text();
                e(t), i()
            })
        }
    }).init();
    var s = {
        hasAddEvent: !1,
        $reply: $(".reply-content"),
        init: function() {
            this.getReply(1, t)
        },
        createReply: function(t, e) {
            var i = this;
            $.extend(t, {
                reply: page_config.reply,
                isAdmin: page_config.admin
            });
            var s = Handlebars.compile($("#reply-template").html());
            $(".reply-content").html(s(t)), this.addEvent(), t.pageCount > 1 && $(".page-box .pages").pagination({
                hoverCls: "ui_hoverbgbd",
                activeCls: "ui_bg_bdcolor",
                pageAll: t.pageCount,
                current: t.currentPage,
                callback: function(t) {
                    var s = t.getCurrent();
                    i.getReply(s, e), o = s
                }
            }, function(t) {})
        },
        getReply: function(t, e) {
            var i = this;
            $.ajax({
                url: "/modules/forum/showtopic.php",
                data: {
                    tid: e,
                    page: t,
                    ajax_gets: 1
                },
                type: "GET",
                success: function(t) {
                    t.items.length > 0 ? i.$reply.show() : i.$reply.hide(), i.createReply(t, e), i.updatePageReply(i.getAllReply())
                },
                error: function(t) {}
            })
        },
        addEvent: function() {
            if (this.hasAddEvent) return !1;
            this.hasAddEvent = !0, this.$reply.on("click", ".del", function() {
                var p = $(this).parents(".item").data("pid"),
                    f = page_config.fid;
                function e(e) {
                    e = e || "", $.ajax({
                        url: "/modules/forum/delpost.php",
                        data: {
                            fid: f,
                            tid: t,
                            pid: p,
                            ajax_gets: 1

                        },
                        type: "get",
                        success: function(e) {
                            e = eval(e);
                            if (e.success === true) {
                                layer.msg(e.message, {icon: 1,shade: .3}), page_config.allReplyNum = page_config.allReplyNum - n, s.getReply(o, t), $(".del_Layer_div").hide()
                            }
                            else{
                                layer.msg(e.message, {icon: 2,shade: .3});
                            }
                        },
                        error: function(t) {}
                    })
                }
                if (!page_config.username) return pop_login(), !1;
                if ($(this).parents(".item-reply-next").length > 0) var i = $(this).parents(".item-reply-next").data("replyreply"),
                    n = 1,
                    a = "true" == $(this).parents(".item-reply-next").attr("data-isme");
                else var i = $(this).parents(".item").data("pid"),
                    n = $(this).parents(".item").find(".item-reply-next").length + 1,
                    a = "true" == $(this).parents(".item").attr("data-isme");
                if (a) $("body,.del_Layer_div").fadeIn(300), $(".del_Layer_close,.del_Layer_no").off().on("click", function() {
                    $(".del_Layer_div").fadeOut(300), $("body").removeClass("addOn")
                }), $(".del_Layer_yes").off().on("click", function() {
                    e()
                });
                else {
                    $(".poupout").show(), $(".delreason>span").removeClass("delreasonOn"), $(".delreason  .delarea").val(""), $(".dcancelbtn,.popclose").off().on("click", function() {
                        $(".poupout").hide()
                    });
                    var l = null;
                    $(".delreason>span").off().on("click", function() {
                        $(this).addClass("delreasonOn").siblings().removeClass("delreasonOn").parents(".delreason").siblings(".delarea").children().removeClass("delreasonOn").val(""), l = $(this).text(), $(".poupout .warning").removeClass("showOn")
                    }), $(".deltext").off().on("click", function() {
                        $(this).addClass("delreasonOn").parents(".delarea").siblings(".delreason").children().removeClass("delreasonOn")
                    }), $(".deltext").blur(function() {
                        l = $(this).val()
                    }), $(".dconfirmbtn").off().click(function() {
                        return l ? l.length < 5 || l.length > 20 ? ($(".poupout .warning").addClass("showOn").text("请填写5-20个字"), !1) : ($(".poupout").hide(), void e("?reason=" + l)) : ($(".poupout .warning").addClass("showOn").text("请选择或填写删除理由"), !1)
                    })
                }
            }), this.$reply.on("click", ".j-checkmore", function() {
                var t = $(this).parent().siblings(".reply-next");
                if ("no" == $(this).data("open")) {
                    t.find(".item-reply-next-hidden").show(), $(this).text("点击收起");
                    var e = t.find(".item-reply-next").length;
                    $(this).siblings(".checkmore-number").text("共" + e + "条回复"), $(this).data("open", "yes")
                } else {
                    t.find(".item-reply-next-hidden").hide(), $(this).text("点击查看");
                    var e = t.find(".item-reply-next-hidden").length;
                    $(this).siblings(".checkmore-number").text("剩余" + e + "条回复"), $(this).data("open", "no")
                }
            }), this.$reply.on("click", ".j-reply", function() {
                if (!page_config.username) return pop_login(), !1;
                var t = "",
                    o = "";
                t = $(this).parents(".item-main").length > 0 ? $(this).parents(".item-main").find(".j-authorname").text() : $(this).parents(".item-reply-next").attr("data-replyname"), o = $(this).parents(".item").data("pid"), e(t), i(o)
            })
        },
        updatePageReply: function(t) {
            $(".post-info .reply-number").text("回复数：" + t), $(".page-box .page-box-reply").text("共" + t + "条回复")
        },
        getAllReply: function(t) {
            return page_config.allReplyNum
        }
    };
    s.init(), $(".reply-box").replyMod({
        replyCb: function() {
            page_config.allReplyNum++, s.getReply(o, t), s.updatePageReply(page_config.allReplyNum)
        }
    });
    var n = {
            show: function() {
                $("#floatbox .mask").fadeIn(200)
            },
            hide: function() {
                $("#floatbox .mask").fadeOut(1)
            }
        },
        a = {
            isAddEvent: !1,
            currentPage: 1,
            pageCount: null,
            init: function(t) {
                this.getBookShelf(t), this.currentPage = t, this.addEvent(), this.windowResize()
            },
            addEvent: function() {
                if (!this.isAddEvent) {
                    this.isAddEvent = !0;
                    var e = this,
                        i = this,
                        o = $("#floatbox .bookshelfbox"),
                        s = function(t) {
                            t.addClass("checked")
                        },
                        n = function(t) {
                            t.removeClass("checked")
                        },
                        r = function(t) {
                            t.addClass("disabled")
                        },
                        c = function() {
                            var t = !0;
                            return o.find(".popbox .select").each(function() {
                                $(this).hasClass("checked") || (t = !1)
                            }), t
                        };
                    o.on("click", ".popbox .select", function() {
                        $(this).hasClass("disabled") || ($(this).hasClass("checked") ? n($(this)) : s($(this)), c() ? s(o.find(".pbotw .select")) : n(o.find(".pbotw .select")))
                    }), o.on("click", ".pbotw .select", function() {
                        $(this).hasClass("disabled") || ($(this).hasClass("checked") ? (n(o.find(".popbox .select")), n($(this))) : (o.find(".popbox .select").each(function() {
                            $(this).hasClass("disabled") || s($(this))
                        }), s($(this))))
                    });
                    var m = function(e, i) {
                        $.ajax({
                            url: "/ajax/bbs/topics/" + t + "/books",
                            data: {
                                bookIds: e
                            },
                            type: "POST",
                            success: function(t) {
                                i && i(t)
                            },
                            error: function(t) {}
                        })
                    };
                    o.on("click", ".j-single-add", function() {
                        if ($(this).hasClass("disabled")) return !1;
                        var t = this,
                            e = $(this).parents(".popbooklist").attr("data-bookid");
                        $(t).text();
                        "true" != $(this).attr("data-inreading") && m(e, function(e) {
                            $(t).css("cursor", "text"), layerPop.openTips("已加入书单"), $(t).text("已在书单"), $(t).attr("data-inreading", "true"), n($(t).parents(".popbooklist").find(".select")), r($(t).parents(".popbooklist").find(".select")), n(o.find(".popbot .select")), i.setSelectAllDisable()
                        })
                    });
                    var f = !1;
                    o.on("click", ".j-batch-add", function() {
                        if (!f) {
                            f = !0;
                            var t = [],
                                i = [];
                            if (o.find(".popbooklist").each(function(e, o) {
                                    $(this).find(".checked").length > 0 && (t.push($(this).data("bookid")), i.push($(this)))
                                }), t.length <= 0) return o.find(".pop_tips").addClass("show"), void(f = !1);
                            o.find(".pop_tips").removeClass("show");
                            var s = t.toString();
                            m(s, function(t) {
                                layerPop.openTips("已加入书单"), n(o.find(".popbox .select")), n(o.find(".popbot .select")), setTimeout(function() {
                                    f = !1
                                }, 3e3), $.each(i, function(t, e) {
                                    $(e).find(".j-single-add").text("已在书单"), r($(e).find(".select"))
                                }), e.setSelectAllDisable()
                            })
                        }
                    }), o.on("click", ".page_next", function() {
                        e.currentPage < e.pageCount && a.init(e.currentPage + 1)
                    }), o.on("click", ".page_prev", function() {
                        e.currentPage > 1 && a.init(e.currentPage - 1)
                    }), o.on("click", ".popclose", function() {
                        l.init()
                    })
                }
            },
            getBookShelf: function(e) {
                var i = this;
                $.ajax({
                    url: "/ajax/bbs/topics/" + t + "/bookshelf",
                    type: "GET",
                    data: {
                        pageNo: e
                    },
                    success: function(t) {
                        i.createBookShelf(t), i.pageCount = t.pageCount, i.currentPage = t.currentPage, i.setSelectAllDisable()
                    },
                    error: function(t) {}
                })
            },
            createBookShelf: function(t) {
                var e = Handlebars.compile($("#bookshelflist-template").html());
                $("#floatbox .bookshelfbox").html(e(t)), this.adjustPos(), $("#floatbox .bookshelfbox").fadeIn(200), n.show()
            },
            adjustPos: function() {
                $(".popbox").height($(window).height() / 2);
                var t = $("#floatbox .bookshelfbox").height();
                $("#floatbox .bookshelfbox").css({
                    marginTop: -t / 2,
                    top: "50%"
                })
            },
            setSelectAllDisable: function() {
                var t = $("#floatbox .bookshelfbox"),
                    e = !0;
                t.find(".popbox .select").each(function() {
                    $(this).hasClass("disabled") || (e = !1)
                }), e ? t.find(".pbotw .select").addClass("disabled") : t.find(".pbotw .select").removeClass("disabled")
            },
            windowResize: function() {
                var t = this;
                $(window).on("resize", function() {
                    t.adjustPos()
                })
            }
        };
    ({
        init: function() {
            this.addEvent()
        },
        addEvent: function() {
            $("#floatbox").on("click", ".popclose", function() {
                $(this).parents(".popup").hide(), n.hide()
            })
        }
    }).init();
    var l = {
        isAddEvent: !1,
        bookListData: {},
        init: function() {
            this.getBookList(t), this.addBookEvent()
        },
        getBookList: function(t) {
            var e = this;
            $.ajax({
                url: "/ajax/bbs/topics/" + t + "/books",
                data: {
                    topicid: t
                },
                type: "GET",
                success: function(t) {
                    e.createBookList(t), e.bookListData = t
                }
            })
        },
        createBookList: function(t) {
            t = $.extend({}, t, {
                me: page_config.me
            });
            var e = Handlebars.compile($("#booklist-template").html());
            $(".post-booklist").html(e(t))
        },
        addBookEvent: function() {
            if (!this.isAddEvent) {
                this.isAddEvent = !0;
                var e = this;
                $(".post-booklist").on("click", ".j-addbook-btn", function() {
                    a.init(1)
                }), $(".post-booklist").on("click", ".addshelf", function() {
                    if (!page_config.username) return pop_login(), !1;
                    var t = $(this).parents(".item").data("bookid"),
                        e = this;
                    if ("已在书架" == $(this).text()) return !1;
                    $.ajax({
                        url: "/ajax/book/" + t + "/bookshelf/add",
                        data: {},
                        type: "GET",
                        success: function(t) {
                            t.success ? (layerPop.openTips("已加入书架"), $(e).text("已在书架"), $(e).removeClass("ui_hoverbgbgwhite"), $(e).css("cursor", "text")) : ($(e).removeClass("ui_hoverbgbgwhite"), $(e).css("cursor", "text"), layerPop.openTips("已在书架"), $(e).text("已在书架"))
                        },
                        error: function(t) {}
                    })
                }), $(".post-booklist").on("click", ".edit", function() {
                    var t = $(this).parents(".item").index(".item"),
                        i = e.bookListData.items[t],
                        o = Handlebars.compile($("#editbook-template").html());
                    $(".j_pop_comment").html(o(i)), $("#floatbox .j_pop_comment").fadeIn(200), n.show()
                }), $(".post-booklist").on("click", ".del", function() {
                    var e = $(this).parents(".item").attr("data-bookid");
                    $(".del_Layer_div").fadeIn(300), layerPop.close(), $(".del_Layer_close,.del_Layer_no").click(function() {
                        $(".del_Layer_div").fadeOut(300), $("body").removeClass("addOn")
                    }), $(".del_Layer_yes").off().on("click", function() {
                        $.ajax({
                            url: "/ajax/bbs/topics/" + t + "/books/" + e,
                            data: {},
                            type: "DELETE",
                            success: function(t) {
                                l.init(), $(".del_Layer_div").hide(), layerPop.openTips("删除成功")
                            },
                            error: function(t) {}
                        })
                    })
                }), $("#floatbox .j_pop_comment").on("click", ".dconfirmbtn", function() {
                    var e = $(this).parents(".popbox").attr("data-bookid"),
                        i = $(this).parents(".popbox").find("textarea").val();
                    $.ajax({
                        url: "/ajax/bbs/topics/" + t + "/books/" + e,
                        type: "PUT",
                        data: JSON.stringify({
                            remark: i
                        }),
                        contentType: "application/json",
                        success: function(t) {
                            $(".j_pop_comment").hide(), n.hide(), l.init()
                        },
                        error: function(t) {}
                    })
                }), $("#floatbox .j_pop_comment").on("click", ".dcancelbtn", function() {
                    $(".j_pop_comment").hide(), n.hide()
                }), $("#floatbox .j_pop_comment").on("input propertychange", ".commont_txt", function() {
                    var t = $(this).val(),
                        e = t.length;
                    e > 50 && ($(this).val(t.substr(0, 50)), e = 50), $(this).siblings(".num").text(e + "/50字")
                })
            }
        }
    };
    3 == page_config.type && l.init()
}), function(t, e, i, o) {
    var s = (t(e), null);
    t.fn.replyMod = function(i) {
        var o = this,
            n = (page_config.topciId, this.find("textarea")),
            a = i.replyCb,
            l = {
                phizTemplate: "<div class='phiz_layerN'>                         <div class='layerBoxTop'>                             <div style='left:6px;' class='layerArrow'></div>                             <div class='topCon'>                                 <a class='close' title='关闭' id='closeEmotion' onclick='return false;' href='#'></a>                                 <div class='clearit'></div>                             </div>                         </div>                         <div class='faceItemPicbg'>                             <ul id='emotionList'>                                 <li title='呵呵'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/smile.gif'></a></li>                                 <li title='嘻嘻'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/tooth.gif'></a></li>                                 <li title='哈哈'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/laugh.gif'></a></li>                                 <li title='爱你'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/love.gif'></a></li>                                 <li title='晕'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/dizzy.gif'></a></li>                                 <li title='泪'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/sad.gif'></a></li>                                 <li title='馋嘴'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/cz_thumb.gif'></a></li>                                 <li title='抓狂'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/crazy.gif'></a></li>                                 <li title='哼'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/hate.gif'></a></li>                                 <li title='可爱'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/tz_thumb.gif'></a></li>                                 <li title='怒'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/angry.gif'></a></li>                                 <li title='汗'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/sweat.gif'></a></li>                                 <li title='困'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/sleepy.gif'></a></li>                                 <li title='害羞'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/shame_thumb.gif'></a></li>                                 <li title='睡觉'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/sleep_thumb.gif'></a></li>                                 <li title='钱'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/money_thumb.gif'></a></li>                                 <li title='偷笑'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/hei_thumb.gif'></a></li>                                 <li title='酷'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/cool_thumb.gif'></a></li>                                 <li title='衰'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/cry.gif'></a></li>                                 <li title='吃惊'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/cj_thumb.gif'></a></li>                                 <li title='闭嘴'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/bz_thumb.gif'></a></li>                                 <li title='鄙视'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/bs2_thumb.gif'></a></li>                                 <li title='挖鼻屎'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/kbs_thumb.gif'></a></li>                                 <li title='花心'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/hs_thumb.gif'></a></li>                                 <li title='鼓掌'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/gz_thumb.gif'></a></li>                                 <li title='失望'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/sw_thumb.gif'></a></li>                                 <li title='思考'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/sk_thumb.gif'></a></li>                                 <li title='生病'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/sb_thumb.gif'></a></li>                                 <li title='亲亲'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/qq_thumb.gif'></a></li>                                 <li title='怒骂'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/nm_thumb.gif'></a></li>                                 <li title='太开心'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/mb_thumb.gif'></a></li>                                 <li title='懒得理你'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/ldln_thumb.gif'></a></li>                                 <li title='右哼哼'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/yhh_thumb.gif'></a></li>                                 <li title='左哼哼'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/zhh_thumb.gif'></a></li>                                 <li title='嘘'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/x_thumb.gif'></a></li>                                 <li title='委屈'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/wq_thumb.gif'></a></li>                                 <li title='吐'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/t_thumb.gif'></a></li>                                 <li title='可怜'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/kl_thumb.gif'></a></li>                                 <li title='打哈气'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/k_thumb.gif'></a></li>                                 <li title='顶'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/d_thumb.gif'></a></li>                                 <li title='疑问'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/yw_thumb.gif'></a></li>                                 <li title='做鬼脸'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/zgl_thumb.gif'></a></li>                                 <li title='握手'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/ws_thumb.gif'></a></li>                                 <li title='耶'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/ye_thumb.gif'></a></li>                                 <li title='good'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/good_thumb.gif'></a></li>                                 <li title='弱'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/sad_thumb.gif'></a></li>                                 <li title='不要'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/no_thumb.gif'></a></li>                                 <li title='ok'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/ok_thumb.gif'></a></li>                                 <li title='赞'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/z2_thumb.gif'></a></li>                                 <li title='来'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/come_thumb.gif'></a></li>                                 <li title='蛋糕'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/cake.gif'></a></li>                                 <li title='心'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/heart.gif'></a></li>                                 <li title='伤心'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/unheart.gif'></a></li>                                 <li title='钟'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/clock_thumb.gif'></a></li>                                 <li title='猪头'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/pig.gif'></a></li>                                 <li title='咖啡'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/cafe_thumb.gif'></a></li>                                 <li title='话筒'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/m_thumb.gif'></a></li>                                 <li title='月亮'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/moon.gif'></a></li>                                 <li title='太阳'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/sun.gif'></a></li>                                 <li title='干杯'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/cheer.gif'></a></li>                                 <li title='礼物'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/gift.gif'></a></li>                                 <li title='心跳'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/Heartbeat.gif'></a></li>                                 <li title='吻'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/kiss.gif'></a></li>                                 <li title='拥抱'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/p2p.gif'></a></li>                                 <li title='玫瑰'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/rose.gif'></a></li>                                 <li title='献花'><a href='#' onclick='return false;'><img                                         src='/style/images/smiles/tinysmile.gif'></a></li>                             </ul>                             <div class='clearit'></div>                         </div>                     </div>",
                initphiz: function(e) {
                    var i = this;
                    null == s ? (s = t(this.phizTemplate), t("body").append(s), s.show(), s.find("li").on("click", function() {
                        var i = e.val(),
                            o = "[" + t(this).attr("title") + "]";
                        e.val(i + o)
                    }), s.find(".close").on("click", function() {
                        i.hideFaceBox()
                    })) : i.showFaceBox()
                },
                hideFaceBox: function() {
                    s && s.hide(), this.unRegisterWindowEvent()
                },
                showFaceBox: function() {
                    s && s.show()
                },
                setFaceBoxPos: function(t) {
                    var e = t.offset().left,
                        i = t.offset().top;
                    s.css({
                        left: e - 2,
                        top: i + 28
                    })
                },
                registerWindowEvent: function() {
                    var i = this;
                    t(e).on("resize scroll", function() {
                        i.setFaceBoxPos(o.find(".face"))
                    }).on("click", function(e) {
                        0 != t(e.target).parents(".phiz_layerN").length || t(e.target).hasClass("face") || i.hideFaceBox()
                    })
                },
                unRegisterWindowEvent: function() {
                    t(e).off("resize scroll click")
                }
            };
        return this.find(".face").on("click", function() {
            l.initphiz(n), l.setFaceBoxPos(t(this)), l.registerWindowEvent()
        }), this.find(".replying").on("click", function() {
            if (!page_config.username) return pop_login(), !1;
            var e = n.val();
            if (e.replace(/\s/g, "").length < 5) return o.find(".err-tips").addClass("show"), !1;
            o.find(".err-tips").removeClass("show");
            var i = o.attr("data-tid"),
                c = o.find("#checkcode").val(),
                s = o.attr("data-fid");
            if ("" == s) t.ajax({
                url: "/modules/forum/newpost.php",
                data: {
                    do: "submit",
                    posttext: e,
                    fid: s,
                    tid: i,
                    act: "newpost",
                    checkcode: c,
                    jieqi_token: jieqi_token,
                    ajax_gets: 1
                },
                type: "POST",
                success: function(t) {
                    t = eval(t);
                    o.find("#p_imgccode").click(),o.find("#checkcode").val("");
                    false === t.success ? o.find(".err-tips").text(t.message).addClass("show") : layerPop.openTips(t.message), n.val(""), "function" == typeof a && a();
                },
                error: function(t) {}
            });
            else {
                var l = o.find(".replyer").text() + e;
                t.ajax({
                    url: "/modules/forum/newpost.php",
                    data: {
                        do: "submit",
                        posttext: e,
                        fid: s,
                        tid: i,
                        act: "newpost",
                        checkcode: c,
                        jieqi_token: jieqi_token,
                        ajax_gets: 1
                    },
                    type: "POST",
                    success: function(t) {
                        t = eval(t);
                        o.find("#p_imgccode").click(),o.find("#checkcode").val("");
                        false === t.success ? o.find(".err-tips").text(t.message).addClass("show") : layerPop.openTips(t.message), n.val(""), "function" == typeof a && a();
                    },
                    error: function(t) {}
                })
            }
        }), this.find("textarea").on("focus", function() {
            var e = o.find(".replyer").width() + 10;
            t(this).css("textIndent", e)
        }).on("blur", function() {
            n.val().replace(/\s/g, "").length < 5 ? o.find(".err-tips").addClass("show") : o.find(".err-tips").removeClass("show")
        }), this
    }
}(jQuery, window, document);
