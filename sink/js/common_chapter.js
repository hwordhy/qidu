var bouns_pop = function() {
    var t, i = page_config.coinName,
    e = (page_config.voteNumber, "<div class='bonus_pop'>            <div class='header'>                <span class='vote on'>投票</span>                <span class='applause'>打赏</span>                <span class='close'></span>            </div>            <div class='content'>                <div class='vote-content'>                        <span class='novote-pic'></span>                        <div class='novote-text'>                            <p class='notice'>您今天的推荐票已使用完</p>                            <p class='more'><a href='/about/faq#faq7' target='_blank'>获得更多的推荐票>></a></p>                        </div>                        <span  class='vote-pic'></span>                        <div class='votenumber'>                            <p class='text'>总票数</p>                            <p class='number'></p>                        </div>                        <div class='votebtn'>                                <span class='first'>投推</span>                                <span>荐票</span>                        </div>                </div>                <div class='applause-content'>                    <div class='motiecoin clearfixer'>                        <span data-type='9' class='item on' data-sum='100'>100" + i + "</span>                        <span data-type='10' class='item' data-sum='500'>500" + i + "</span>                        <span data-type='11' class='item' data-sum='1000'>1000" + i + "</span>                        <span data-type='12' class='item' data-sum='3000'>3000" + i + "</span>                        <span data-type='13' class='item' data-sum='10000'>1万" + i + "</span>                        <span data-type='14' class='item' data-sum='50000'>5万" + i + "</span>                        <span data-type='15' class='item' data-sum='100000'>10万" + i + "</span>                        <span data-type='16' class='item' data-sum='1000000'>100万" + i + "</span>                        <span data-type='17' class='item' data-sum='10000000'>1000万" + i + "</span>                    </div>                    <p class='balance'>账户余额<span class='user_remain'></span>                        " + i + " · 本次打赏 <span class='choosecoin'> </span>" + i + "                    </p>                    <textarea class='inputzone' placeholder=''>千金难买相如赋，小小红包犒劳一下！</textarea>                    <div class='confirmapplause'>确认打赏</div>                </div>            </div>        </div>"),
    s = $(e),
    o = s.find(".close"),
    a = s.find(".vote"),
    n = s.find(".applause"),
    l = s.find(".votebtn"),
    c = s.find(".motiecoin .item"),
    m = null,
    r = s.find(".confirmapplause"),
    f = 0,
    g = 9,
    h = null,
    p = {
        init: function() {
            m = page_config.userMoneyBalance,
            $("#floatbox").append(s);
            var t = this;
            o.on("click",
            function() {
                t.close()
            }),
            a.on("click",
            function() {
                t.switchToVote()
            }),
            l.on("click",
            function() {
                $.ajax({
                    url: "/book/vote",
                    type: "POST",
                    data: {
                        bookId: page_config.bookId
                    },
                    success: function(i) {
                        "error" === i.code ? layerPop.openTips("您今天的推荐票已使用完！", 2e3) : layerPop.openTips("投票成功，支持" + page_config.authorName + "！", 2e3),
                        t.close()
                    },
                    error: function(t) {
                        layerPop.openTips("投票失败")
                    }
                })
            }),
            n.on("click",
            function() {
                t.switchToApplause()
            }),
            c.on("click",
            function() {
                t.chooseSum($(this)),
                g = $(this).data("type")
            }),
            this.chooseSum(c.eq(0)),
            r.on("click",
            function() {
                f <= m && g ? ($.ajax({
                    url: "/book/" + page_config.bookId + "/donate",
                    data: {
                        bid: page_config.bookId,
                        type: g,
                        content: t.getComment()
                    },
                    type: "POST",
                    success: function(t) {
                        try {
                            "ok" === JSON.parse(t).code && (m = page_config.userMoneyBalance = page_config.userMoneyBalance - f)
                        } catch(t) {}
                    }
                }), t.close(), layerPop.openTips("感谢您的打赏，支持" + page_config.authorName, 2e3), h.successApplause && h.successApplause()) : location.href = "/payment/choose"
            })
        },
        close: function() {
            s.hide(),
            $("#windowbg").hide()
        },
        show: function() {
            s.find(".number").text(page_config.voteNumber),
            s.find(".user_remain").text(m),
            s.show(),
            $("#windowbg").show(),
            this.switchToVote()
        },
        switchToVote: function() {
            s.find(".vote").addClass("on"),
            s.find(".applause").removeClass("on"),
            s.find(".vote-content").show(),
            s.find(".applause-content").hide(),
            this.getUserVoteTicket()
        },
        switchToApplause: function() {
            s.find(".applause").addClass("on"),
            s.find(".vote").removeClass("on"),
            s.find(".vote-content").hide(),
            s.find(".applause-content").show()
        },
        chooseSum: function(t) {
            t.siblings().removeClass("on"),
            t.addClass("on"),
            f = t.data("sum"),
            m < f ? r.text("余额不足，马上充值") : r.text("确认打赏"),
            s.find(".balance .choosecoin").text(f)
        },
        getComment: function() {
            var t = $(s).find("textarea").val();
            return "" == t ? "千金难买相如赋，小小红包犒劳一下！": t
        },
        getUserVoteTicket: function() {
            $.ajax({
                url: "/ajax/persion/votes",
                data: {
                    bookId: page_config.bookId
                },
                type: "GET",
                success: function(t) {
                    t.votoCount > 0 ? (s.find(".votebtn").show(), s.find(".novote-text").hide()) : (s.find(".votebtn").hide(), s.find(".novote-text").show()),
                    s.find(".votenumber .number").text(t.SUPPORT_VOTE_COUNT)
                }
            })
        }
    };
    return function(i) {
        return t ? (h = i || {},
        t) : (t = p, h = i || {},
        t.init(), t)
    }
} (),
comment_pop = function() {
    var t, i = $("<div class='commentBox'>            <div class='header'>                <span class='text'>发表评论</span>                <span class='err-tips'></span>                <a href='javascript:;' class='close'></a>            </div>            <div class='comment_tit'>                <span class='text fl'>标题:</span>                <input type='text' value='' class='input_tit fl'>            </div>            <div class='comment_con'>                <div class='text fl'>内容:</div>                <textarea name='' class='fl' cols='30' rows='10'></textarea>            </div>            <p>                <span class='limit'>已输入<i>0</i>个字(不计空格)</span>            </p>            <div class='submit'>提交</div>        </div>"),
    e = i.find(".close"),
    s = i.find("textarea"),
    o = i.find(".comment_tit input"),
    a = i.find(".submit"),
    n = -1,
    l = null,
    c = {
        init: function() {
            $("#floatbox").append(i),
            this.show();
            var t = this;
            e.on("click",
            function() {
                t.close()
            }),
            o.on("input",
            function() {
                var t = $(this).val();
                t.replace(/^\s+/g, "").replace(/\s+$/g, "").length < 5 ? i.find(".err-tips").text("标题不能少于5个字").addClass("show") : i.find(".err-tips").removeClass("show"),
                t.length > 50 && $(this).val(t.substr(0, 50))
            }),
            s.on("input propertychange",
            function() {
                var t = $(this).val(),
                e = t.replace(/\s/g, "").length;
                i.find(".limit i").text(e),
                e < 10 ? i.find(".err-tips").text("内容不能少于10个字").addClass("show") : i.find(".err-tips").removeClass("show"),
                t.length >= 1e4 && $(this).val(t.substr(0, 1e4))
            }),
            a.on("click",
            function() {
                var e = o.val(),
                a = s.val();
                return e.replace(/^\s+/g, "").replace(/\s+$/g, "").length < 5 ? void i.find(".err-tips").text("标题不能少于5个字").addClass("show") : (i.find(".err-tips").removeClass("show"), a.replace(/^\s+/g, "").replace(/\s+$/g, "").length < 10 ? void i.find(".err-tips").text("内容不能少于10个字").addClass("show") : (i.find(".err-tips").removeClass("show"), void $.ajax({
                    url: "/review/ajax/add/" + page_config.bookId,
                    data: {
                        name: e,
                        content: a
                    },
                    type: "POST",
                    success: function(i) {
                        i.success ? (t.createComment(e, a), o.val(""), s.val("")) : layerPop.openEmptyTips(i.msg, 2e3)
                    },
                    error: function() {}
                })))
            })
        },
        close: function() {
            i.hide(),
            $("#windowbg").hide()
        },
        show: function() {
            $("#windowbg").show(),
            i.show()
        },
        createComment: function(t, i) {
            var e = this.getCurTime(),
            s = page_config.userLevel < 0 ? "": "level v" + page_config.userLevel,
            o = "<div class='comment_item clearfixer'>                            <div class='left fl'>                                <a  href='' class='avatar'>                                    <img src='" + page_config.userIcon + "' alt=''>                                </a>                                <div class='nickname'>                                    <span class='" + s + "'></span>                                    <a>" + page_config.username + "</a>                                </div>                            </div>                            <div class='right fl'>                                <p class='item_title'>                                    <span>" + t + "</span>                                </p>                                <p class='comment-text'>" + i + "</p>                                <p class='clearfixer behavior'>                                    <span class='fl time'>" + e + "</span>                                </p>                                <div class='replybox'>                                    <span class='replyer'>回复@zhuhong:</span>                                    <textarea name='' id='' cols='30' rows='10'></textarea>                                    <div class='btns clearfixer'>                                        <span class='face fl'></span>                                        <span class='replying fl'>回复</span>                                    </div>                                </div>                            </div>                        </div>";
            this.isCommentDetail() ? (this.close(), layerPop.openTips("评论发表成功", "2000")) : (this.isBlankComment() ? this.insertComment(o) : this.insertComment_blank(o), l.success && l.success())
        },
        getCurTime: function() {
            var t = new Date,
            i = t.getFullYear(),
            e = t.getMonth() + 1,
            s = t.getDate(),
            o = t.getHours(),
            a = t.getMinutes(),
            n = function(t) {
                return t < 10 ? "0" + t: "" + t
            };
            return i + "-" + n(e) + "-" + n(s) + " " + n(o) + ":" + n(a)
        },
        insertComment: function(t) { - 1 === n && ($(".comment_con_newes .comment_item").each(function(t, i) {
                return $(this).find(".totop").length > 0 || $(this).find(".essence").length > 0 || (n = t, !1)
            }), -1 === n && (n = 0)),
            $(".comment_con_newes .comment_item").eq(n).before(t),
            s.val(""),
            o.val(""),
            this.close(),
            layerPop.openTips("评论发表成功", "2000")
        },
        insertComment_blank: function(t) {
            $(".comment_con_newes").html(t),
            this.close(),
            layerPop.openTips("评论发表成功", "2000")
        },
        isBlankComment: function() {
            return $(".comment_con_newes .comment_item").length > 0
        },
        isCommentDetail: function() {
            return $(".comment_con  .detail_list").length > 0
        }
    };
    return function(i) {
        return t ? (l = i || {},
        t) : (t = c, l = i || {},
        t.init(), t)
    }
} (),
reply_pop = function() {
    var t, i, e = null,
    s = null,
    o = {
        init: function() {
            var i = this;
            $(".comment_con").on("click", ".replybox .replying",
            function() {
                "1" == $(this).data("ajax_reply") ? i.ajaxReply_reply() : i.ajaxReply()
            }),
            $(".comment_con").on("click", ".replybox .face",
            function(t) {
                i.initphiz(),
                i.setFaceBoxPos($(this)),
                i.registerWindowEvent(),
                t.stopPropagation()
            }),
            $(".comment_con").on("input", "textarea",
            function() {
                var i = $(".comment_con .j_comment_item").eq(t),
                e = i.find("textarea").val().replace(/\s/g, "");
                e.length < 5 ? (i.find(".err-tips").addClass("show"), s = !1) : (i.find(".err-tips").removeClass("show"), s = !0),
                e.length > 200 && (e = e.substr(0, 200), i.find("textarea").val(e))
            })
        },
        initphiz: function() {
            var i = this;
            if (null == e) {
                e = $("<div class='phiz_layerN'>                         <div class='layerBoxTop'>                             <div style='left:6px;' class='layerArrow'></div>                             <div class='topCon'>                                 <a class='close' title='关闭' id='closeEmotion' onclick='return false;' href='#'></a>                                 <div class='clearit'></div>                             </div>                         </div>                         <div class='faceItemPicbg'>                             <ul id='emotionList'>                                 <li title='呵呵'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/smile.gif'></a></li>                                 <li title='嘻嘻'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/tooth.gif'></a></li>                                 <li title='哈哈'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/laugh.gif'></a></li>                                 <li title='爱你'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/love.gif'></a></li>                                 <li title='晕'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/dizzy.gif'></a></li>                                 <li title='泪'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/sad.gif'></a></li>                                 <li title='馋嘴'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/cz_thumb.gif'></a></li>                                 <li title='抓狂'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/crazy.gif'></a></li>                                 <li title='哼'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/hate.gif'></a></li>                                 <li title='可爱'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/tz_thumb.gif'></a></li>                                 <li title='怒'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/angry.gif'></a></li>                                 <li title='汗'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/sweat.gif'></a></li>                                 <li title='困'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/sleepy.gif'></a></li>                                 <li title='害羞'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/shame_thumb.gif'></a></li>                                 <li title='睡觉'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/sleep_thumb.gif'></a></li>                                 <li title='钱'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/money_thumb.gif'></a></li>                                 <li title='偷笑'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/hei_thumb.gif'></a></li>                                 <li title='酷'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/cool_thumb.gif'></a></li>                                 <li title='衰'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/cry.gif'></a></li>                                 <li title='吃惊'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/cj_thumb.gif'></a></li>                                 <li title='闭嘴'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/bz_thumb.gif'></a></li>                                 <li title='鄙视'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/bs2_thumb.gif'></a></li>                                 <li title='挖鼻屎'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/kbs_thumb.gif'></a></li>                                 <li title='花心'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/hs_thumb.gif'></a></li>                                 <li title='鼓掌'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/gz_thumb.gif'></a></li>                                 <li title='失望'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/sw_thumb.gif'></a></li>                                 <li title='思考'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/sk_thumb.gif'></a></li>                                 <li title='生病'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/sb_thumb.gif'></a></li>                                 <li title='亲亲'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/qq_thumb.gif'></a></li>                                 <li title='怒骂'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/nm_thumb.gif'></a></li>                                 <li title='太开心'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/mb_thumb.gif'></a></li>                                 <li title='懒得理你'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/ldln_thumb.gif'></a></li>                                 <li title='右哼哼'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/yhh_thumb.gif'></a></li>                                 <li title='左哼哼'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/zhh_thumb.gif'></a></li>                                 <li title='嘘'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/x_thumb.gif'></a></li>                                 <li title='委屈'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/wq_thumb.gif'></a></li>                                 <li title='吐'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/t_thumb.gif'></a></li>                                 <li title='可怜'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/kl_thumb.gif'></a></li>                                 <li title='打哈气'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/k_thumb.gif'></a></li>                                 <li title='顶'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/d_thumb.gif'></a></li>                                 <li title='疑问'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/yw_thumb.gif'></a></li>                                 <li title='做鬼脸'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/zgl_thumb.gif'></a></li>                                 <li title='握手'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/ws_thumb.gif'></a></li>                                 <li title='耶'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/ye_thumb.gif'></a></li>                                 <li title='good'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/good_thumb.gif'></a></li>                                 <li title='弱'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/sad_thumb.gif'></a></li>                                 <li title='不要'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/no_thumb.gif'></a></li>                                 <li title='ok'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/ok_thumb.gif'></a></li>                                 <li title='赞'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/z2_thumb.gif'></a></li>                                 <li title='来'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/come_thumb.gif'></a></li>                                 <li title='蛋糕'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/cake.gif'></a></li>                                 <li title='心'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/heart.gif'></a></li>                                 <li title='伤心'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/unheart.gif'></a></li>                                 <li title='钟'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/clock_thumb.gif'></a></li>                                 <li title='猪头'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/pig.gif'></a></li>                                 <li title='咖啡'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/cafe_thumb.gif'></a></li>                                 <li title='话筒'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/m_thumb.gif'></a></li>                                 <li title='月亮'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/moon.gif'></a></li>                                 <li title='太阳'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/sun.gif'></a></li>                                 <li title='干杯'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/cheer.gif'></a></li>                                 <li title='礼物'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/gift.gif'></a></li>                                 <li title='心跳'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/Heartbeat.gif'></a></li>                                 <li title='吻'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/kiss.gif'></a></li>                                 <li title='拥抱'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/p2p.gif'></a></li>                                 <li title='玫瑰'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/rose.gif'></a></li>                                 <li title='献花'><a href='#' onclick='return false;'><img                                         src='http://img.motieimg.com/_assets/emotion/tinysmile.gif'></a></li>                             </ul>                             <div class='clearit'></div>                         </div>                     </div>"),
                $("body").append(e),
                e.show(),
                e.find("li").on("click",
                function() {
                    var i = $(".comment_con textarea").eq(t),
                    e = i.val(),
                    s = "[" + $(this).attr("title") + "]";
                    i.val(e + s)
                }),
                e.find(".close").on("click",
                function() {
                    i.hideFaceBox()
                })
            } else i.showFaceBox()
        },
        hideFaceBox: function() {
            e && e.hide(),
            this.unRegisterWindowEvent()
        },
        showFaceBox: function() {
            e && e.show()
        },
        setFaceBoxPos: function(t) {
            var i = t.offset().left,
            s = t.offset().top;
            e.css({
                left: i - 2,
                top: s + 28
            })
        },
        ajaxReply: function() {
            var i = this,
            e = $(".comment_con .comment_item").eq(t);
            if (!0 !== s) return e.find(".err-tips").addClass("show"),
            !0;
            var o = e.data("commentid"),
            a = e.find("textarea").val();
            $.ajax({
                url: "/ajax/reply/add/" + o + "_6",
                type: "POST",
                data: {
                    replyid: 0,
                    content: a
                },
                success: function(e) {
                    if ("error" == e.code) return void layerPop.openEmptyTips(e.msg);
                    var s = $(".comment_con .comment_item").eq(t),
                    o = s.find(".reply .reply_num").text();
                    s.find(".reply .reply_num").text( + o + 1),
                    s.find(".replybox").hide(),
                    s.find("textarea").val(""),
                    i.hideFaceBox(),
                    i.isCommentDetail() && i.createReply(a)
                },
                error: function(t) {}
            })
        },
        ajaxReply_reply: function() {
            var i = this,
            e = $(".comment_con .j_comment_item");
            if (!s) return e.find(".err-tips").addClass("show"),
            !0;
            var o = e.eq(0).data("commentid"),
            a = e.eq(t).data("replyid"),
            n = e.eq(t).find("textarea").val(),
            l = e.eq(t).find(".replyer").text();
            $.ajax({
                url: "/ajax/reply/add/" + o + "_6",
                type: "POST",
                data: {
                    replyId: a,
                    content: l + n
                },
                success: function(s) {
                    if ("error" == s.code) return void layerPop.openEmptyTips(s.message);
                    if ($(".comment_con .j_comment_item").eq(t).find(".replybox").hide(), i.isCommentDetail()) {
                        var o = e.eq(t).find(".detail_item_reply").text();
                        i.createReply(n, o)
                    }
                },
                error: function(t) {}
            })
        },
        registerWindowEvent: function() {
            var i = this;
            $(window).on("resize scroll",
            function() {
                var e = $(".comment_con .face").eq(t);
                i.setFaceBoxPos(e)
            }).on("click",
            function() {
                i.hideFaceBox()
            })
        },
        unRegisterWindowEvent: function() {
            $(window).off("resize scroll click")
        },
        createReply: function(t, i) {
            layerPop.openTips("回复成功"),
            location.reload()
        },
        isCommentDetail: function() {
            return $(".comment_con  .detail_list").length > 0
        },
        getCurTime: function() {
            var t = new Date,
            i = t.getFullYear(),
            e = t.getMonth() + 1,
            s = t.getDate(),
            o = t.getHours(),
            a = t.getMinutes(),
            n = function(t) {
                return t < 10 ? "0" + t: "" + t
            };
            return i + "-" + n(e) + "-" + n(s) + " " + n(o) + ":" + n(a)
        }
    };
    return function(e) {
        return i ? (t = e, s = !1, i) : (t = e, i = o, i.init(), i)
    }
} (),
likeComment = {
    target: null,
    getLikeNum: function() {
        return this.target.find(".like_num").text()
    },
    likeEv: function(t) {
        this.target = t;
        var i = this,
        e = this.target.parents(".comment_item").data("commentid");
        $.ajax({
            url: "/ajax/favorite/" + e + "/6/set",
            type: "POST",
            data: "",
            success: function(t) {
                void 0 !== t.favor && i.target.find(".like_num").text(t.favor)
            },
            error: function() {}
        })
    }
},
likeDonate = {
    target: null,
    getLikeNum: function() {
        return this.target.find(".like_num").text()
    },
    likeEv: function(t) {
        this.target = t;
        var i = this,
        e = this.target.parents(".comment_item").data("commentid");
        $.ajax({
            url: "/ajax/favorite/" + e + "/41/set",
            type: "POST",
            data: "",
            success: function(t) {
                void 0 !== t.favor && i.target.find(".like_num").text(t.favor)
            },
            error: function() {}
        })
    }
},
addShelf_zsy = {
    isInShelf: null,
    target: null,
    addShelfClick: function() {
        var t = this;
        this.target.on("click",
        function() {
            if (!t.isInShelf) return page_config.username ? ($.ajax({
                url: "/ajax/contact/follow/add/" + page_config.bookId + "/2",
                type: "POST",
                data: "",
                success: function(i) {
                    "NORMAL" === i && t.callbackFn.bind(t)(i)
                }
            }), !1) : (pop_login(), !1)
        }),
        this.target.on("mouseover",
        function() {
            t.isInShelf || $(this).addClass("hover")
        }).on("mouseout",
        function() {
            t.isInShelf || $(this).removeClass("hover")
        })
    },
    initShelf: function(t, i) {
        this.isInShelf = page_config.isInShelf,
        this.target = t,
        this.callbackFn = i ||
        function(t) {
            this.isInShelf = page_config.isInShelf = !0,
            layerPop.openTips("已加入书架", 1e3),
            this.target.text("已在书架").addClass("onshelf")
        },
        this.isInShelf || this.addShelfClick()
    },
    initReaderShelf: function(t) {
        this.isInShelf = page_config.isInShelf;
        this.target = t,
        this.callbackFn = function(t) {
            this.isInShelf = page_config.isInShelf = !0,
            layerPop.openTips("已加入书架", 1e3),
            this.target.addClass("onshelf").removeClass("hover")
        },
        this.isInShelf ? this.target.addClass("onshelf") : this.addShelfClick()
    }
};