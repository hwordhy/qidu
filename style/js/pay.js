$(function() {
    var t = function(t, i) {
            if ($(i).html(" "), t) return /^[1-9]\d*$/.test(t) ? t < 10 ? ($(i).html("最少充值10块钱"), !1) : !(t > 1e5) || (i.html("单笔最多10万元"), !1) : ($(i).html("输入金额错误"), !1);
            $(i).html("")
        },
        i = function(i) {
            var n = $(i),
                s = n.val(),
                o = $(i).next().html("");
            $(this).siblings(".checknum").html("");
            var e = 0;
            s < 30 ? $(".activitytips").hide() : s >= 30 && s < 50 ? (e = 500, $(".activitytips").show()) : s >= 50 && s < 100 ? (e = 1500, $(".activitytips").show()) : s >= 100 && s < 200 ? (e = 2500, $(".activitytips").show()) : s >= 200 && s < 250 ? (e = 5e3, $(".activitytips").show()) : (e = s / 250 * 1e4, $(".activitytips").show()), $("#inputAmount").val(0), $("#payAllmoney").html(""), $("#payMoneyUnit").html(""), $(".activitytips span").html("");
            var l = (t(s, $(i).siblings(".checknum")), $(i).data("rate")),
                c = $(i).data("coinunit"),
                h = $(i).data("feeUnit"),
                d = s * l,
                o = $(i).next();
            $(o).html("(" + d + c + ")"), $("#payAllmoney").html(s), $(".activitytips span").html(e), a(s), $("#payMoneyUnit").html("元"), "USD" == h && $("#payMoneyUnit").html("美元"), $("#inputAmount").val(s*100)
        },
        a = function(t) {
            if (!t || t < 10 || t > 1e5 || !/^[1-9]\d*$/.test(t)) return $("#inputAmount").val(""), $("#payAllmoney").html(""), $("#paysubmit").addClass("disbtn"), void $(".activitytips").html("");
            $("#paysubmit").removeClass("disbtn")
        };
    $("#bank-menu li").click(function() {
        $(this).addClass("on"), $(this).siblings("li").removeClass("on"), $(".bank-wrap").hide();
        var t = $(this).data("id");
        $("#onlinebank-cont-" + t).show()
    }), $(".tabs1 #third-tabs-menu li").click(function() {
        $(this).addClass("on"), $(this).siblings("li").removeClass("on"), $(".third-wrap").hide();
        var t = $(this).data("id");
        $("#thirdparty-cont-" + t).show()
    });
    var n = function() {
            $("body").on("click", ".tabs1 .money-box", function() {
                $(this).addClass("cur"), $(this).siblings("span").removeClass("cur")
            }), $(".tabs1 .insertnum").on("input", function() {
                i($(this))
            })
        },
        s = function() {
            $("body").on("click", ".tabs2 .money-box", function() {
                $(this).addClass("cur"), $(this).siblings("span").removeClass("cur")
            }), $(".tabs2 .insertnum").bind("input", function() {
                i($(this))
            })
        },
        o = function() {
            $("body").on("click", ".tabs3 .money-box", function() {
                $(this).addClass("cur"), $(this).siblings("span").removeClass("cur")
            }), $(".tabs3 .insertnum").bind("input", function() {
                i($(this))
            })
        },
        e = function() {
            $("body").on("click", ".tabs4 .money-box", function() {
                $(this).addClass("cur"), $(this).siblings("span").removeClass("cur")
            }), $(".tabs4 .insertnum").bind("input", function() {})
        };
    $("#paytabs").slide({
        titCell: "#paytabs-bd li",
        mainCell: "#paytabs-hd",
        trigger: "click",
        startFun: function(t, i) {
            0 == t && n(), 1 == t && s(), 2 == t && (o(), $(".tabs3 .third-wrap").show()), 3 == t && (e(), $(".tabs4").find("div .third-wrap").show())
        }
    });
    var l = function() {
            $(".paysubmit").show();
            var t = $("#paytabs-bd").find("li.on"),
                i = $(t).data("type"),
                a = $("." + i + ".on"),
                n = $(a).data("id");
            c(i + "-cont-" + n, n)
        },
        c = function(t, i, u) {
            var n = $("#" + t).find(".money-box.cur"),
                s = $(n).data("money");
            s || (n = $("#" + t).find(".insertnum"), s = $(n).val()), $("#feeTypeId").val(" ");
            var o = $(n).data("fee-type-id");
            o && $("#feeTypeId").val(o);
            $("#form").attr("action",u);
            var e = 0;
            s < 30 ? $(".activitytips").hide() : s >= 30 && s < 50 ? (e = 500, $(".activitytips").show()) : s >= 50 && s < 100 ? (e = 1500, $(".activitytips").show()) : s >= 100 && s < 200 ? (e = 2500, $(".activitytips").show()) : s >= 200 && s < 250 ? (e = 5e3, $(".activitytips").show()) : (e = s / 250 * 1e4, $(".activitytips").show()), $("#bank_id").val(i), $("#inputAmount").val(s * 100), $("#payAllmoney").html(s), $(".activitytips span").html(e), $("#payMoneyUnit").html("元"), "USD" == $(n).data("feeunit") && $("#payMoneyUnit").html("美元"), a(s), "90" == i && h(i)
        },
        h = function(t) {
            if ("90" == t) {
                var i = $("#inputAmount").val(),
                    n = {
                        egold: i,
                        jieqi_token: jieqi_token,
                        ajax_gets: 1
                    };
                $("#barcode").html(""), $.post("/modules/pay/wxnative.php", n, function(t) {
                    if (t && 1 == t.success) {
                        var i = t.obj;
                        $("#barcode").qrcode({
                            render: "canvas",
                            width: 100,
                            height: 100,
                            text: i
                        })
                    }
                    else{
                        layer.msg(t.msg);
                    }
                },'json'), $(".paysubmit").hide()
            }
        };
    l(), $("#paytabs-bd li").on("click", function() {
        if ($(".paysubmit").show(), "sms" == $(this).data("type")) {
            var t = $("#sms-cont").data("id");
            return void c("sms-cont", t)
        }
        l()
    }), $(".thirdparty,.onlinebank,.sms, .overseas").on("click", function() {
        $(".paysubmit").show();
        var t = $(this).data("id"),
            i = $(this).data("type"),
            u = $(this).data("url");
        c(i + "-cont-" + t, t, u)
    }), $(".money-box").on("click", function() {
        $(".paysubmit").show();
        var t = $(this).data("money");
        if (!t) {
            t = $(this).find(".insertnum").val()
        }
        t || (t = "");
        var i = 0;
        t < 30 ? $(".activitytips").hide() : t >= 30 && t < 50 ? (i = 500, $(".activitytips").show()) : t >= 50 && t < 100 ? (i = 1500, $(".activitytips").show()) : t >= 100 && t < 200 ? (i = 2500, $(".activitytips").show()) : t >= 200 && t < 250 ? (i = 5e3, $(".activitytips").show()) : (i = t / 250 * 1e4, $(".activitytips").show()), $("#inputAmount").val(t * 100), $("#payAllmoney").html(t), $(".activitytips").html("*活动期间: 充值本额度可获得首充奖励<span>" + i + "</span>阅读券"), $("#payMoneyUnit").html("元");
        var n = $(this).data("feeunit");
        a(t), "USD" == n && $("#payMoneyUnit").html("美元");
        var s = $(this).data("fee-type-id"),
            o = $("#bank_id").val();
        s && o && ($("#feeTypeId").val(s), h(o))
    });
    var d = function(t) {
        if (!t || t < 10 || t > 1e5 || !/^[1-9]\d*$/.test(t)) return $("#inputAmount").val(""), $("#payAllmoney").html(""), $("#paysubmit").addClass("disbtn"), void $(".activitytips").html("");
        $("#paysubmit").removeClass("disbtn"), popshow(), $("#form").submit()
    };
    $(".paysubmit").on("click", function() {
        if ($("#bank_id").val()) {
            var t = $("#payAllmoney").text();
            d(t)
        }
    })
});
