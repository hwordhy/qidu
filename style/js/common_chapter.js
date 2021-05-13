var bouns_pop = function() {
        var t, i = page_config.coinName,
            e = (page_config.voteNumber, "<div class='bonus_pop'>            <div class='header'>                <span class='vote on'>投推荐票</span>  <span class='vipvote'>投月票</span>               <span class='applause'>打赏</span>                <span class='close'></span>            </div>            <div class='content'>                <div class='vote-content'>                        <span class='novote-pic'></span>                        <div class='novote-text'>                            <p class='notice'>您今天的推荐票已使用完</p>                          </div>                        <span  class='vote-pic'></span>                        <div class='votenumber'>                            <p class='text'>总票数</p>                            <p class='number'></p>                        </div>                        <div class='votebtn'>                                <span class='first'>投推</span>                                <span>荐票</span>                        </div>                </div>                <div class='vipvote-content'>                        <span class='novote-pic'></span>                        <div class='vipnovote-text'>                            <p class='notice'>您的月票已使用完</p>                          </div>                        <span  class='vote-pic'></span>                        <div class='votenumber'>                            <p class='text'>总票数</p>                            <p class='vipvotenumber'></p>                        </div>                        <div class='vipvotebtn'>                                <span class='first'>投</span>                                <span>月票</span>                        </div>                </div>                <div class='applause-content'>                    <div class='motiecoin clearfixer'>                        <span class='item on' data-sum='100'>100" + i + "</span>                        <span class='item' data-sum='500'>500" + i + "</span>                        <span class='item' data-sum='1000'>1000" + i + "</span>                        <span class='item' data-sum='3000'>3000" + i + "</span>                        <span class='item' data-sum='10000'>1万" + i + "</span>                        <span class='item' data-sum='50000'>5万" + i + "</span>                        <span class='item' data-sum='100000'>10万" + i + "</span>                        <span class='item' data-sum='1000000'>100万" + i + "</span>                        <span class='item' data-sum='10000000'>1000万" + i + "</span>                    </div>                    <p class='balance'>账户余额<span class='user_remain'></span>                        " + i + " · 本次打赏 <span class='choosecoin'> </span>" + i + "                    </p>                    <textarea class='inputzone' placeholder=''>千金难买相如赋，小小红包犒劳一下！</textarea>                    <div class='confirmapplause'>确认打赏</div>                </div>            </div>        </div>"),
            s = $(e),
            o = s.find(".close"),
            a = s.find(".vote"),
            v = s.find(".vipvote"),
            n = s.find(".applause"),
            l = s.find(".votebtn"),
            z = s.find(".vipvotebtn"),
            c = s.find(".motiecoin .item"),
            m = null,
            r = s.find(".confirmapplause"),
            f = 0,
            g = 100,
            h = null,
            p = {
                init: function() {
                    m = page_config.userMoneyBalance, $("#floatbox").append(s);
                    var t = this;
                    o.on("click", function() {
                        t.close()
                    }), a.on("click", function() {
                        t.switchToVote()
                    }),v.on("click", function() {
                        t.switchToVipvote()
                    }), l.on("click", function() {
                        $.ajax({
                            url: "/modules/article/uservote.php",
                            type: "POST",
                            dataType: "json",
                            data: {
                                id: page_config.bookId,
                                ajax_gets: 1
                            },
                            success: function(i) {
                                if (i.success === true) {
                                    page_config.voteNumber = Number(page_config.voteNumber) - Number(1);
                                    page_config.votes = Number(page_config.votes) - Number(1);
                                    layer.msg(i.message, {icon: 1,shade: .3});
                                    t.close()
                                }
                                else{
                                    layer.msg(i.message, {icon: 1,shade: .3});
                                }
                            },
                            error: function(t) {
                                layerPop.openTips("投票失败")
                            }
                        })
                    }),z.on("click", function() {
                        $.ajax({
                            url: "/modules/article/vipvote.php",
                            type: "POST",
                            dataType: "json",
                            data: {
                                id: page_config.bookId,
                                act: "post",
                                num:1,
                                ajax_gets: 1
                            },
                            success: function(i) {
                                if (i.success === true) {
                                    page_config.vipvote = Number(page_config.vipvote) + Number(1);
                                    page_config.uservipvote = Number(page_config.uservipvote) - Number(1);
                                    layer.msg(i.message, {icon: 1,shade: .3});
                                    t.close()
                                }
                                else{
                                    layer.msg(i.message, {icon: 1,shade: .3});
                                }
                            },
                            error: function(t) {
                                layerPop.openTips("投票失败")
                            }
                        })
                    }), n.on("click", function() {
                        t.switchToApplause()
                    }), c.on("click", function() {
                        t.chooseSum($(this))
                    }), this.chooseSum(c.eq(0)), r.on("click", function() {
                        f <= m ? $.ajax({
                            url: "/modules/article/tip.php",
                            data: {
                                id: page_config.bookId,
                                payegold: f,
                                ajax_gets: 1,
                                act: "post",
                                jieqi_token:jieqi_token,
                                content: t.getComment()
                            },
                            type: "POST",
                            dataType: "json",
                            success: function(i) {
                                if (i.success === true) {
                                    m = page_config.userMoneyBalance = page_config.userMoneyBalance - f;
                                    layer.msg(i.message, {icon: 1,shade: .3});t.close()
                                }
                                else{
                                    layer.msg(i.message, {icon: 1,shade: .3});
                                }
                            }
                        }) : location.href = "/modules/pay/buyegold.php"
                    })
                },
                close: function() {
                    s.hide(), $("#windowbg").hide()
                },
                show: function() {
                    s.find(".number").text(page_config.voteNumber), s.find(".user_remain").text(m), s.show(), $("#windowbg").show(), this.switchToVote()
                },
                switchToVote: function() {
                    s.find(".vote").addClass("on"), s.find(".applause").removeClass("on"), s.find(".vipvote").removeClass("on"), s.find(".vote-content").show(), s.find(".applause-content").hide(),s.find(".vipvote-content").hide(), this.getUserVoteTicket()
                },
                switchToApplause: function() {
                    s.find(".applause").addClass("on"), s.find(".vote").removeClass("on"),s.find(".vipvote").removeClass("on"), s.find(".vote-content").hide(),s.find(".vipvote-content").hide(), s.find(".applause-content").show()
                },
                switchToVipvote: function() {
                    s.find(".vipvote").addClass("on"), s.find(".vote").removeClass("on"),s.find(".applause").removeClass("on"), s.find(".vote-content").hide(), s.find(".applause-content").hide(), s.find(".vipvote-content").show(), this.getUserVipvoteTicket()
                },
                chooseSum: function(t) {
                    t.siblings().removeClass("on"), t.addClass("on"), f = t.data("sum"), m < f ? r.text("余额不足，马上充值") : r.text("确认打赏"), s.find(".balance .choosecoin").text(f)
                },
                getComment: function() {
                    var t = $(s).find("textarea").val();
                    return "" == t ? "千金难买相如赋，小小红包犒劳一下！" : t
                },
                getUserVoteTicket: function() {
                    page_config.votes > 0 ? (s.find(".votebtn").show(), s.find(".novote-text").hide()) : (s.find(".votebtn").hide(), s.find(".novote-text").show()), s.find(".votenumber .number").text(t.SUPPORT_VOTE_COUNT)
                },
                getUserVipvoteTicket: function() {
                    page_config.uservipvote > 0 ? (s.find(".vipvotebtn").show(), s.find(".novote-text").hide()) : (s.find(".votebtn").hide()), s.find(".votenumber .vipvotenumber").text(page_config.vipvote)
                }
            };
        return function(i) {
            return t ? (h = i || {}, t) : (t = p, h = i || {}, t.init(), t)
        }
    }(),
    comment_pop = function() {
            var x = page_config.postcheckcode > 0 ? "<span class='text fl'>验证码:</span>                <input type='text' class='input_tit' style='width: 100px;' size='8' maxlength='8' id='yanzhengma' name='checkcode' value=''><img id='yanzhengmaimg' src='/checkcode.php' onclick='$(\"#yanzhengmaimg\").attr(\"src\", \"/checkcode.php?rand=\" + Math.random())' style='height: 36px;margin-left: 10px;'>" : '';
        var t, i = $("<div class='commentBox'>            <div class='header'>                <span class='text'>发表评论</span>                <span class='err-tips'></span>                <a href='javascript:;' class='close'></a>            </div>            <div class='comment_tit'>                <span class='text fl'>标题:</span>                <input type='text' value='' class='input_tit fl'>            </div>            <div class='comment_con'>                <div class='text fl'>内容:</div>                <textarea name='' class='fl' cols='30' rows='10'></textarea>            </div>       <div class='comment_tit'>    "+x+"     <span class='limit fr' style='margin-right: 30px;'>已输入<i>0</i>个字(不计空格)</span>      </div>       <span class=\"face fl\"></span><div class='submit'>提交</div>        </div>"),
            e = i.find(".close"),
            s = i.find("textarea"),
            o = i.find(".comment_tit input"),
            a = i.find(".submit"),
            n = -1,
            l = null,
            c = {
                init: function() {
                    $("#floatbox").append(i), this.show();
                    var t = this;
                    e.on("click", function() {
                        t.close()
                    }), o.on("input", function() {
                        var t = $(this).val();
                        t.replace(/^\s+/g, "").replace(/\s+$/g, "").length < 5 ? i.find(".err-tips").text("标题不能少于5个字").addClass("show") : i.find(".err-tips").removeClass("show"), t.length > 50 && $(this).val(t.substr(0, 50))
                    }), s.on("input propertychange", function() {
                        var t = $(this).val(),
                            e = t.replace(/\s/g, "").length;
                        i.find(".limit i").text(e), e < 10 ? i.find(".err-tips").text("内容不能少于10个字").addClass("show") : i.find(".err-tips").removeClass("show"), t.length >= 1e4 && $(this).val(t.substr(0, 1e4))
                    }), a.on("click", function() {
                        var e = o.val(),
                            a = s.val(),
                            k = $("#yanzhengma").val();
                        return e.replace(/^\s+/g, "").replace(/\s+$/g, "").length < 5 ? void i.find(".err-tips").text("标题不能少于5个字").addClass("show") : (i.find(".err-tips").removeClass("show"), a.replace(/^\s+/g, "").replace(/\s+$/g, "").length < 10 ? void i.find(".err-tips").text("内容不能少于10个字").addClass("show") : (i.find(".err-tips").removeClass("show"), void $.ajax({
                            url: "/modules/article/reviews.php",
                            data: {
                                aid: page_config.bookId,
                                ptitle: e,
                                pcontent: a,
                                checkcode: k,
                                ajax_gets: 1,
                                act: 'newpost',
                                jieqi_token: jieqi_token

                            },
                            type: "POST",
                            dataType: "json",
                            success: function(i) {
                                if (i.success === true) {
                                    layer.msg(i.message, {icon: 1,shade: .3});
                                    t.createComment(e, a), o.val(""), s.val("")
                                }
                                else{
                                    layer.msg(i.message, {icon: 2,shade: .3});
                                }
                            },
                            error: function() {}
                        })))
                    })
                },
                close: function() {
                    i.hide(), $("#windowbg").hide()
                },
                show: function() {
                    $("#windowbg").show(), i.show()
                },
                createComment: function(t, i) {
                    var e = this.getCurTime(),
                        s = page_config.userLevel < 0 ? "" : "level v" + page_config.userLevel,
                        o = "<div class='comment_item clearfixer'>                            <div class='left fl'>                                <a  href='' class='avatar'>                                    <img src='" + page_config.userIcon + "' alt=''>                                </a>                                <div class='nickname'>                                    <span class='" + s + "'></span>                                    <a>" + page_config.username + "</a>                                </div>                            </div>                            <div class='right fl'>                                <p class='item_title'>                                    <span>" + t + "</span>                                </p>                                <p class='comment-text'>" + i + "</p>                                <p class='clearfixer behavior'>                                    <span class='fl time'>" + e + "</span>                                </p>                                <div class='replybox'>                                    <span class='replyer'>回复@zhuhong:</span>                                    <textarea name='' id='' cols='30' rows='10'></textarea>                                    <div class='btns clearfixer'>                                        <span class='face fl'></span>                                        <span class='replying fl'>回复</span>                                    </div>                                </div>                            </div>                        </div>";
                    this.isCommentDetail() ? this.close() : (this.isBlankComment() ? this.insertComment(o) : this.insertComment_blank(o), l.success && l.success())
                },
                getCurTime: function() {
                    var t = new Date,
                        i = t.getFullYear(),
                        e = t.getMonth() + 1,
                        s = t.getDate(),
                        o = t.getHours(),
                        a = t.getMinutes(),
                        n = function(t) {
                            return t < 10 ? "0" + t : "" + t
                        };
                    return i + "-" + n(e) + "-" + n(s) + " " + n(o) + ":" + n(a)
                },
                insertComment: function(t) {
                    -1 === n && ($(".comment_con_newes .comment_item").each(function(t, i) {
                        return $(this).find(".totop").length > 0 || $(this).find(".essence").length > 0 || (n = t, !1)
                    }), -1 === n && (n = 0)), $(".comment_con_newes .comment_item").eq(n).before(t), s.val(""), o.val(""), this.close()
                },
                insertComment_blank: function(t) {
                    $(".comment_con_newes").html(t), this.close()
                },
                isBlankComment: function() {
                    return $(".comment_con_newes .comment_item").length > 0
                },
                isCommentDetail: function() {
                    return $(".comment_con  .detail_list").length > 0
                }
            };
        return function(i) {
            return t ? (l = i || {}, t) : (t = c, l = i || {}, t.init(), t)
        }
    }(),
    reply_pop = function() {
        var t, i, e = null,
            s = null,
            o = {
                init: function() {
                    var i = this;
                    $(".comment_con").on("click", ".replybox .replying", function() {
                         $(this).data("ajax_reply") === 1 ? i.ajaxReply_reply() : i.ajaxReply()
                    }), $(".comment_con").on("click", ".replybox .face", function(t) {
                        i.initphiz(), i.setFaceBoxPos($(this)), i.registerWindowEvent(), t.stopPropagation()
                    }), $(".comment_con").on("input", "textarea", function() {
                        var i = $(".comment_con .j_comment_item").eq(t),
                            e = i.find("textarea").val().replace(/\s/g, "");
                        e.length < 5 ? (i.find(".err-tips").addClass("show"), s = !1) : (i.find(".err-tips").removeClass("show"), s = !0), e.length > 200 && (e = e.substr(0, 200), i.find("textarea").val(e))
                    })
                },
                initphiz: function() {
                    var i = this;
                    if (null == e) {
                        e = $("<div class='phiz_layerN'>                         <div class='layerBoxTop'>                             <div style='left:6px;' class='layerArrow'></div>                             <div class='topCon'>                                 <a class='close' title='关闭' id='closeEmotion' onclick='return false;' href='#'></a>                                 <div class='clearit'></div>                             </div>                         </div>                         <div class='faceItemPicbg'>                             <ul id='emotionList'>                                 <li title=\"DD猫:亲亲\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/亲亲.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:偷笑\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/偷笑.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:傻笑\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/傻笑.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:吐舌头\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/吐舌头.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:吓\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/吓.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:哭\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/哭.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:啊呀呀\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/啊呀呀.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:喊\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/喊.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:嗨\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/嗨.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:大哭\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/大哭.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:委屈\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/委屈.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:害羞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/害羞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:尴尬\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/尴尬.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:快哭了\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/快哭了.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:怒\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/怒.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:惊恐\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/惊恐.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:想哭\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/想哭.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:打你\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/打你.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:拥抱\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/拥抱.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:撇嘴\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/撇嘴.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:敲门\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/敲门.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:无聊\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/无聊.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:流口水\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/流口水.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:流泪\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/流泪.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:色\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/色.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:花痴\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/花痴.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:跳舞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/跳舞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"DD猫:鄙视\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/DD猫/鄙视.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:你呀\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/你呀.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:倒霉\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/倒霉.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:共舞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/共舞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:冒个泡\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/冒个泡.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:刷屏\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/刷屏.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:叨米\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/叨米.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:吃饭啦\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/吃饭啦.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:呀呀呀\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/呀呀呀.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:喷嚏\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/喷嚏.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:嘲笑\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/嘲笑.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:噢哦喔\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/噢哦喔.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:四筒\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/四筒.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:囧\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/囧.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:好害怕\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/好害怕.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:好日子\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/好日子.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:委屈\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/委屈.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:孤芳自赏\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/孤芳自赏.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:宅男\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/宅男.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:害怕\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/害怕.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:就是你了\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/就是你了.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:幺鸡哭\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/幺鸡哭.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:开心\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/开心.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:开笼\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/开笼.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:往这打\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/往这打.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:打我呀\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/打我呀.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:抓抓铜\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/抓抓铜.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:抓狂\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/抓狂.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:捂脸\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/捂脸.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:接吻\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/接吻.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:搓洗\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/搓洗.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:撒娇\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/撒娇.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:撒花\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/撒花.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:救命\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/救命.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:教训\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/教训.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:晒钱\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/晒钱.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:晕\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/晕.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:枣上好\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/枣上好.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:求饶\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/求饶.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:沐猴\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/沐猴.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:泪奔\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/泪奔.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:流鼻血\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/流鼻血.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:游泳\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/游泳.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:激动\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/激动.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:炫舞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/炫舞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:炸弹\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/炸弹.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:牛牛舞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/牛牛舞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:狂踩\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/狂踩.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:狠开心\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/狠开心.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:玉足\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/玉足.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:玩摇滚\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/玩摇滚.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:电锯\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/电锯.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:疯了\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/疯了.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:皮鞭\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/皮鞭.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:盛装扭\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/盛装扭.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:示爱\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/示爱.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:肚皮舞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/肚皮舞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:背出血\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/背出血.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:舞闪亮\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/舞闪亮.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:花痴\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/花痴.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:诱惑\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/诱惑.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:跳舞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/跳舞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:郁闷\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/郁闷.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:钢管舞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/钢管舞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:铁头功\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/铁头功.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:静静哭\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/静静哭.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:魔怔\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/魔怔.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:鸭子舞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/鸭子舞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"小幺鸡:麦霸\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/小幺鸡/麦霸.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:上吊\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/上吊.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:下去\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/下去.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:不开森\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/不开森.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:乖\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/乖.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:发呆\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/发呆.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:吹口哨\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/吹口哨.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:哭\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/哭.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:哼\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/哼.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:大哭\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/大哭.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:奔跑\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/奔跑.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:害羞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/害羞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:心烦\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/心烦.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:恐怖\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/恐怖.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:惊讶\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/惊讶.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:打这里\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/打这里.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:抓狂\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/抓狂.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:拍\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/拍.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:挡嘴巴\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/挡嘴巴.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:无聊\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/无聊.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:期待\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/期待.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:欢迎\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/欢迎.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:汗\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/汗.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:没呀\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/没呀.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:热\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/热.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:爬\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/爬.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:生气\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/生气.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:疑问\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/疑问.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:看啥看\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/看啥看.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:累死了\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/累死了.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:翻墙\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/翻墙.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:脸操\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/脸操.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:色眯眯\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/色眯眯.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:警告\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/警告.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:走开\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/走开.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:路过\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/路过.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:跳绳\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/跳绳.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:跳舞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/跳舞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:郁闷\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/郁闷.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:陶醉\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/陶醉.gif\" height=\"20\" width=\"20\"></a></li><li title=\"潘斯特:震了\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/潘斯特/震了.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:下雨天\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/下雨天.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:不懂爱\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/不懂爱.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:受死吧\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/受死吧.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:哎呀哎\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/哎呀哎.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:好可怕\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/好可怕.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:害羞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/害羞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:我的泪\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/我的泪.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:插花\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/插花.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:收了你\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/收了你.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:日\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/日.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:淹了你\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/淹了你.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:看妖怪\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/看妖怪.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:碧莲\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/碧莲.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:老中医\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/老中医.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:老秃驴\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/老秃驴.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:耳边说\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/耳边说.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:药不停\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/药不停.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:蛇精病\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/蛇精病.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:诅咒你\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/诅咒你.gif\" height=\"20\" width=\"20\"></a></li><li title=\"白娘子:赏点吧\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/白娘子/赏点吧.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:NO\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/NO.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:OK\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/OK.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:亲亲\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/亲亲.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:便便\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/便便.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:偷笑\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/偷笑.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:傲慢\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/傲慢.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:再见\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/再见.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:冷汗\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/冷汗.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:凋谢\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/凋谢.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:刀\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/刀.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:勾引\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/勾引.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:发怒\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/发怒.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:可怜\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/可怜.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:可爱\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/可爱.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:右哼哼\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/右哼哼.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:吐\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/吐.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:吓\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/吓.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:呲牙\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/呲牙.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:咖啡\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/咖啡.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:哈欠\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/哈欠.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:嘘\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/嘘.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:困\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/困.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:坏笑\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/坏笑.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:大兵\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/大兵.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:大哭\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/大哭.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:太阳\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/太阳.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:奋斗\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/奋斗.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:委屈\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/委屈.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:害羞\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/害羞.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:尴尬\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/尴尬.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:左哼哼\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/左哼哼.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:差劲\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/差劲.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:弱\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/弱.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:强\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/强.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:得意\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/得意.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:微笑\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/微笑.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:心碎\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/心碎.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:快哭了\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/快哭了.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:惊呆\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/惊呆.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:惊恐\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/惊恐.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:憨笑\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/憨笑.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:抓狂\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/抓狂.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:抠鼻\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/抠鼻.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:抱抱\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/抱抱.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:抱拳\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/抱拳.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:拳头\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/拳头.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:握手\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/握手.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:撇嘴\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/撇嘴.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:敲打\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/敲打.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:晕\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/晕.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:月亮\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/月亮.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:汗\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/汗.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:炸弹\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/炸弹.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:爱你\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/爱你.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:爱心\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/爱心.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:猪头\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/猪头.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:玫瑰\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/玫瑰.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:瓢虫\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/瓢虫.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:疑问\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/疑问.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:白眼\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/白眼.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:睡觉\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/睡觉.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:示爱\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/示爱.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:礼物\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/礼物.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:糗大了\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/糗大了.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:色\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/色.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:菜刀\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/菜刀.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:蛋糕\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/蛋糕.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:衰\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/衰.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:调皮\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/调皮.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:鄙视\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/鄙视.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:酷\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/酷.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:闪电\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/闪电.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:闭嘴\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/闭嘴.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:阴险\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/阴险.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:难过\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/难过.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:饥饿\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/饥饿.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:饭\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/饭.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:骷髅\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/骷髅.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:鼓掌\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/鼓掌.gif\" height=\"20\" width=\"20\"></a></li><li title=\"经典:鼻涕\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/经典/鼻涕.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:亲亲\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/亲亲.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:偷笑\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/偷笑.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:冷汗\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/冷汗.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:压力\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/压力.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:可爱\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/可爱.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:咬我呀\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/咬我呀.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:哪里走\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/哪里走.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:哭\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/哭.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:哭泣\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/哭泣.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:喷水\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/喷水.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:囧\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/囧.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:奋进\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/奋进.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:害怕\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/害怕.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:尴尬\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/尴尬.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:开窍\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/开窍.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:怒\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/怒.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:思考\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/思考.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:惊吓\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/惊吓.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:想想\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/想想.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:感冒\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/感冒.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:打鼓\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/打鼓.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:掐一掐\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/掐一掐.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:撒娇\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/撒娇.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:擦汗\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/擦汗.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:敲打\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/敲打.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:无聊\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/无聊.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:有了\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/有了.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:杯具\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/杯具.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:汗\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/汗.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:玫瑰\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/玫瑰.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:疼\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/疼.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:看看\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/看看.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:舔\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/舔.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:调皮\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/调皮.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:路过\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/路过.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:转\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/转.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:闪\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/闪.gif\" height=\"20\" width=\"20\"></a></li><li title=\"非常龟:骷髅\"><a href=\"#\" onclick=\"return!1\"><img src=\"/images/emot/非常龟/骷髅.gif\" height=\"20\" width=\"20\"></a></li>                            </ul>                             <div class='clearit'></div>                         </div>                     </div>"), $("body").append(e), e.show(), e.find("li").on("click", function() {
                            var i = $(".comment_con textarea").eq(t),
                                e = i.val(),
                                s = "[" + $(this).attr("title") + "]";
                            i.val(e + s)
                        }), e.find(".close").on("click", function() {
                            i.hideFaceBox()
                        })
                    } else i.showFaceBox()
                },
                hideFaceBox: function() {
                    e && e.hide(), this.unRegisterWindowEvent()
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
                    if (!0 !== s) return e.find(".err-tips").addClass("show"), !0;
                    var o = e.data("commentid"),
                        k = $(".comment_con .comment_item #checkcode").val(),
                        a = e.find("textarea").val();
                    $.ajax({
                        url: "/modules/article/reviewshow.php",
                        type: "POST",
                        dataType: "json",
                        data: {
                            tid: o,
                            aid: page_config.bookId,
                            pcontent: a,
                            checkcode: k,
                            act: 'newpost',
                            ajax_gets: 1,
                            jieqi_token: jieqi_token
                        },
                        success: function(e) {
                            if (e.success === true) {
                                layer.msg(e.message, {icon: 1,shade: .3});
                                var s = $(".comment_con .comment_item").eq(t),
                                    o = s.find(".reply .reply_num").text();
                                s.find(".reply .reply_num").text(+o + 1), s.find(".replybox").hide(), s.find("textarea").val(""), i.hideFaceBox(), i.isCommentDetail()
                            }
                            else{
                                layer.msg(e.message, {icon: 2,shade: .3});
                            }
                        },
                        error: function(t) {}
                    })
                },
                ajaxReply_reply: function() {
                    var i = this,
                        e = $(".comment_con .j_comment_item");
                    if (!s) return e.find(".err-tips").addClass("show"), !0;
                    var a = e.eq(0).data("commentid"),
                        n = e.eq(t).find("textarea").val(),
                        l = e.eq(t).find(".replyer").text(),
                        k = $(".comment_con .detail_item #checkcode").val();
                    $.ajax({
                        url: "/modules/article/reviewshow.php",
                        type: "POST",
                        dataType: "json",
                        data: {
                            tid: a,
                            aid: page_config.bookId,
                            pcontent: l + n,
                            checkcode: k,
                            act: 'newpost',
                            ajax_gets: 1,
                            jieqi_token: jieqi_token
                        },
                        success: function(s) {
                            if (s.success === true) {
                                layer.msg(s.message, {icon: 1,shade: .3});
                                if ($(".comment_con .j_comment_item").eq(t).find(".replybox").hide(), i.isCommentDetail()) {
                                    var o = e.eq(t).find(".detail_item_reply").text();
                                }
                            }
                            else{
                                layer.msg(s.message, {icon: 2,shade: .3});
                            }
                        },
                        error: function(t) {}
                    })
                },
                registerWindowEvent: function() {
                    var i = this;
                    $(window).on("resize scroll", function() {
                        var e = $(".comment_con .face").eq(t);
                        i.setFaceBoxPos(e)
                    }).on("click", function() {
                        i.hideFaceBox()
                    })
                },
                unRegisterWindowEvent: function() {
                    $(window).off("resize scroll click")
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
                            return t < 10 ? "0" + t : "" + t
                        };
                    return i + "-" + n(e) + "-" + n(s) + " " + n(o) + ":" + n(a)
                }
            };
        return function(e) {
            return i ? (t = e, s = !1, i) : (t = e, i = o, i.init(), i)
        }
    }(),
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
                dataType: "json",
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
                dataType: "json",
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
            this.target.on("click", function() {
                if (!t.isInShelf) return page_config.username ? ($.ajax({
                    url: "/modules/article/addbookcase.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        bid:page_config.bookId,
                        ajax_gets:1
                    },
                    success: function(i) {
                        if (i.success === true) {
                            t.isInShelf = true;
                            layer.msg(i.message, {icon: 1,shade: .3});
                            $(".addshelf").text("已在书架").addClass("onshelf");
                        }
                        else{
                            layer.msg(i.message, {icon: 2,shade: .3});
                        }
                    }
                }), !1) : (pop_login(), !1)
            }), this.target.on("mouseover", function() {
                t.isInShelf || $(this).addClass("hover")
            }).on("mouseout", function() {
                t.isInShelf || $(this).removeClass("hover")
            })
        },
        initShelf: function(t, i) {
            this.isInShelf = page_config.isInShelf, this.target = t, this.callbackFn = i ||
                function(t) {
                    this.isInShelf = page_config.isInShelf = !0, layerPop.openTips("已加入书架", 1e3), this.target.text("已在书架").addClass("onshelf")
                }, this.isInShelf || this.addShelfClick()
        },
        initReaderShelf: function(t) {
            this.isInShelf = page_config.isInShelf;
            this.target = t, this.callbackFn = function(t) {
                this.isInShelf = page_config.isInShelf = !0, layerPop.openTips("已加入书架", 1e3), this.target.addClass("onshelf").removeClass("hover")
            }, this.isInShelf ? this.target.addClass("onshelf") : this.addShelfClick()
        }
    };
