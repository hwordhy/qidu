$("body").on("click", "#tab-menu .m1", function() {
    $(this).addClass("on"), $(this).siblings("li").removeClass("on"), $("#register").show(), $("#mailregister").hide()
}), $("body").on("click", "#tab-menu .m2", function() {
    $(this).addClass("on"), $(this).siblings("li").removeClass("on"), $("#mailregister").show(), $("#register").hide()
}), $("body").on("click", ".tab-menu .f1", function() {
    $(this).addClass("on"), $(this).siblings("li").removeClass("on"), $("#phoneforget").show(), $("#mailforget").hide()
}), $("body").on("click", ".tab-menu .f2", function() {
    $(this).addClass("on"), $(this).siblings("li").removeClass("on"), $("#mailforget").show(), $("#phoneforget").hide()
});
var msg = "",
    ecodeCheckNull = function(e, o) {
        var i = !1;
        return "" == e ? (msg = "请输入验证码", i = !1) : 4 != e.length ? msg = "验证码不正确" : i = !0, 0 == i ? ($(o).find(".u-vcode").addClass("has-error").removeClass("has-success"), $(o).find(".u-vcode .erromsg").html(msg), $(o).find(".u-vcode .successtips").hide()) : ($(o).find(".u-vcode").addClass("has-success").removeClass("has-error"), $(o).find(".u-vcode .erromsg").html("")), i
    },
    notecodeCheckNull = function(e, o) {
        var i = !1;
        return "" == e ? (msg = "请输入验证码", i = !1) : 4 != e.length ? msg = "验证码不正确" : i = !0, 0 == i ? ($(o).find(".notecode").addClass("has-error").removeClass("has-success"), $(o).find(".notecode .erromsg").html(msg), $(o).find(".notecode .successtips").hide()) : ($(o).find(".notecode").addClass("has-success").removeClass("has-error"), $(o).find(".notecode .erromsg").html("")), i
    },
    ecodeCheckNull = function(e, o) {
        var i = !1;
        return "" == e ? (msg = "请输入验证码", i = !1) : 4 != e.length ? msg = "验证码不正确" : i = !0, 0 == i ? ($(o).find(".u-vcode").addClass("has-error").removeClass("has-success"), $(o).find(".u-vcode .erromsg").html(msg), $(o).find(".u-vcode .successtips").hide()) : ($(o).find(".u-vcode").addClass("has-success").removeClass("has-error"), $(o).find(".u-vcode .erromsg").html("")), i
    },
    pwdCheckNull = function(e, o) {
        var i = !0;
        return "" == e ? (msg = "请输入密码", i = !1) : (e.length < 6 || e.length > 18) && (msg = "6-18位大小写字母、符号或数字", i = !1), 0 == i ? ($(o).find(".voidpwd").addClass("has-error").removeClass("has-success"), $(o).find(".voidpwd .erromsg").html(msg), $(o).find(".voidpwd .successtips").hide()) : ($(o).find(".voidpwd").addClass("has-success").removeClass("has-error"), $(o).find(".voidpwd .erromsg").html("")), i
    },
    affirmPwdCheckNull = function(e, o) {
        var i = !0;
        return e && "" != e ? (e.length < 6 || e.length > 18) && (msg = "6-18位大小写字母、符号或数字", i = !1) : (msg = "请再次输入密码", i = !1), 0 == i ? ($(o).find(".voidaffirmPwd").addClass("has-error").removeClass("has-success"), $(o).find(".voidaffirmPwd .erromsg").html(msg), $(o).find(".voidaffirmPwd .successtips").hide()) : ($(o).find(".voidaffirmPwd").addClass("has-success").removeClass("has-error"), $(o).find(".voidaffirmPwd .erromsg").html("")), !0
    },
    mailCheckNull = function(e, o) {
        return "" != e || (msg = "请填写邮箱", $(o).find(".voidmail").addClass("has-error").removeClass("has-success"), $(o).find(".voidmail .erromsg").html(""), $(o).find(".voidmail .erromsg").html(msg), !1)
    },
    unameCheckNull = function(e, o) {
        return "" != e ? ($(o).find(".voiduname .erromsg").html(""), $(o).find(".voiduname .successtips").show()) : (msg = "请填写用户名", $(o).find(".voiduname .successtips").hide(), $(o).find(".voiduname").addClass("has-error").removeClass("has-success"), $(o).find(".voiduname .erromsg").html(""), $(o).find(".voiduname .erromsg").html(msg), !1)
    },
    tipInfoForPhone = function(e, o, i) {
        o ? ($(e).find(".voidphone").removeClass("has-error"), $(e).find(".voidphone .erromsg").html("")) : ($(e).find(".voidphone").addClass("has-error").removeClass("has-success"), $(e).find(".voidphone .successtips").hide(), $(e).find(".voidphone .erromsg").html(i))
    },
    tipInfoForEmail = function(e, o, i) {
        o ? ($(e).find(".voidmail").removeClass("has-error"), $(e).find(".voidmail .erromsg").html("")) : ($(e).find(".voidmail").addClass("has-error").removeClass("has-success"), $(e).find(".voidmail .successtips").hide(), $(e).find(".voidmail .erromsg").html(i))
    },
    PhoneCheckNull = function(e, o) {
        return !(!e || "" == e) || (tipInfoForPhone(o, !1, "请输入用户名"), !1)
    },
    voidPhone = function(e, o) {
        var i = !1;
        return e ? (i = !0, tipInfoForPhone(o, i, "")) : tipInfoForPhone(o, i, "用户名格式不正确"), i
    },
    voidecode = function(e, o) {
        var i = !0;
        return e ? 4 != e.length && (msg = "验证码不正确", i = !1) : (msg = "请输入验证码", i = !1), i ? ($(o).find(".u-vcode").addClass("has-success").removeClass("has-error"), $(o).find(".u-vcode .successtips").show(), $(o).find(".u-vcode .erromsg").html("")) : ($(o).find(".u-vcode").addClass("has-error").removeClass("has-success"), $(o).find(".u-vcode .successtips").hide(), $(o).find(".u-vcode .erromsg").html(msg)), i
    },
    voidPwd = function(e, o) {
        var i = !0;
        return e ? (e.length < 6 || e.length > 18) && (msg = "6-18位大小写字母、符号或数字", i = !1) : (msg = "请输入密码", i = !1), i ? ($(o).find(".voidpwd").addClass("has-success").removeClass("has-error"), $(o).find(".voidpwd .successtips").show(), $(o).find(".voidpwd .erromsg").html("")) : ($(o).find(".voidpwd").addClass("has-error").removeClass("has-success"), $(o).find(".voidpwd .erromsg").html(""), $(o).find(".voidpwd .successtips").hide(), $(o).find(".voidpwd .erromsg").html(msg)), i
    },
    voidaffirmPwd = function(e, o) {
        var i = $(o).find(".pwdcheck").val(),
            s = !0;
        return e ? e.length < 6 || e.length > 18 ? (msg = "6-18位大小写字母、符号或数字", s = !1) : e != i && (msg = "两次输入的密码不一致", s = !1) : (msg = "请再次输入密码", s = !1), s ? ($(o).find(".voidaffirmPwd").addClass("has-success").removeClass("has-error"), $(o).find(".voidaffirmPwd .successtips").show(), $(o).find(".voidaffirmPwd .erromsg").html("")) : ($(o).find(".voidaffirmPwd").addClass("has-error").removeClass("has-success"), $(o).find(".voidaffirmPwd .erromsg").html(msg), $(o).find(".voidaffirmPwd .successtips").hide()), s
    },
    voidMail = function(e, o) {
        var i = /^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$/,
            s = !1;
        return i.test(e) ? s = !0 : msg = "邮箱格式不正确", s ? ($(o).find(".voidmail").addClass("has-success").removeClass("has-error"), $(o).find(".voidmail .successtips").show(), $(o).find(".voidmail .erromsg").html("")) : ($(o).find(".voidmail").addClass("has-error").removeClass("has-success"), $(o).find(".voidmail .erromsg").html(""), $(o).find(".voidmail .erromsg").html(msg), $(o).find(".voidmail .successtips").hide()), s
    };
$("body").on("blur", "#register ul li input.phonecheck", function() {
    var e = $(this).val();
    PhoneCheckNull(e, "#register") && voidPhone(e, "#register") && $.get("/regcheck.php", {
        item: "u",
        username: e,
        ajax_gets: 1
    }, function(e, o) {
        e = eval(e);
        true == e.success && (tipInfoForPhone("#register", !0, ""), $(".voidphone .successtips").show()), false == e.success && tipInfoForPhone("#register", !1, e.message)
    })
}), $("body").on("blur", "#register ul li input.pwdcheck", function() {
    pwdCheckVal = $(this).val(), pwdCheckNull(pwdCheckVal, "#register")
}), $("body").on("blur", "#register ul li input.affirmcheck", function() {
    pwdAffirmNull = $(this).val(), voidaffirmPwd(pwdAffirmNull, "#register")
}),  $("body").on("blur", "#register ul li input.mailcheck", function() {
    var e = $(this).val();
    mailCheckNull(e, "#register") && voidMail(e, "#register") && $.get("/regcheck.php", {
        item: "m",
        email: e,
        ajax_gets: 1
    }, function(e, o) {
        e = eval(e);
        true == e.success && (tipInfoForEmail("#register", !0, ""), $(".voidmail .successtips").show()), false == e.success && tipInfoForEmail("#register", !1, e.message)
    })
}), $("body").on("blur", "#phoneforget ul li input.phonecheck", function() {
    if (phoneNull = $(this).val(), PhoneCheckNull(phoneNull, "#phoneforget")) return voidPhone(phoneNull, "#phoneforget") ? void $("#phoneforget .voidphone .successtips").show() : void $("#phoneforget .voidphone .successtips").hide()
});
var timer = 60,
    isSend = !1,
    Countdown = function() {
        timer >= 1 ? (timer -= 1, $("#sendecode").text("重新发送(" + timer + ")"), setTimeout(function() {
            Countdown()
        }, 1e3)) : ($("#sendecode").text("重新发送"), timer = 60, $("#sendecode").removeClass("disabled"), $("#sendecode").attr("disabled", !1), isSend = !1)
    };
$("#sendecode").on("click", "", function() {
    if (!isSend) {
        if ("disabled" != $("#sendecode").attr("disabled")) {
            var e = $(".phonecheck").val();
            if (PhoneCheckNull(e, "#register") && voidPhone(e, "#register")) {
                var o = $("#mobilecode").val();
                if (!o) return $(".mobile-code").find(".erromsg").css("display", "inline-block"), void $(".mobile-code").find(".erromsg").html("请填写验证码");
                var i = $("#code_mobile").val();
                $("#sendecode").attr("disabled", !0), $("#sendecode").addClass("disabled");
                return $.ajax({
                    url: "/ajax/accounts/getCode",
                    type: "GET",
                    data: {
                        mobile: e,
                        code: o,
                        t: i
                    },
                    success: function(e) {
                        null != e && "error" == e.code && ($("#sendecode").removeClass("disabled"), $("#sendecode").attr("disabled", !1), createImg($("#mobileValidateImg"), $("#code_mobile", ""))), null != e && "error" == e.code && "mobile-code" == e.target ? ($(".mobile-code").find(".erromsg").css("display", "inline-block"), $(".mobile-code").find(".erromsg").html(e.message), $("#sendecode").removeClass("disabled"), $("#sendecode").attr("disabled", !1)) : null != e && "error" == e.code && "mobile" == e.target ? ($(".voidphone").find(".erromsg").css("display", "inline-block"), $(".voidphone .erromsg").html(""), $(".voidphone .erromsg").html(e.message), $("#sendecode").removeClass("disabled"), $("#sendecode").attr("disabled", !1)) : null != e && "error" == e.code ? ($(".notecode .erromsg").html(""), $(".notecode").find(".erromsg").css("display", "inline-block"), $(".notecode .erromsg").html(e.message), $("#sendecode").removeClass("disabled"), $("#sendecode").attr("disabled", !1)) : (isSend = !0, Countdown(), $(".voidphone .erromsg").html(""), $(".notecode .erromsg").html(""), $(".mobile-code").find(".erromsg").html(""))
                    }
                }), !1
            }
        }
    }
});
var createImg = function(e, o, i) {
    i || (i = Math.random()), $(e).attr("src", "/checkcode.php?" + i), $(o).val(i)
};
$("#mailValidateImg").click(function() {
    return createImg($("#mailValidateImg"), $("#code_mail", "")), !1
}), $("#pstep1").click(function() {
    var e = $("#mobile").val(),
        o = $("#mobile_code").val(),
        i = $("#code_mail").val();
    PhoneCheckNull(e, "#phoneforget") && ecodeCheckNull(o, "#phoneforget") && $.post("/mobile/step1/forget", {
        forgetType: "mobile",
        mobile: e,
        code: o,
        t: i
    }, function(e, o) {
        1 == e.success && ($("#u_name").html(e.obj.name), $("#mobileid").val(e.obj.id), $("#u_mobile").html(e.obj.account), $("#phoneforget .forget1").hide(), $("#phoneforget .forget2").show()), 0 == e.success && ($("#mobile_step1_error").html(e.msg), $("#mailValidateImg").click())
    })
}), $("#pstep2").click(function() {
    var e = ($("#mobileid").val(), $("#mobile").val()),
        o = $("#mobilcodeinput").val();
    o && $.post("/mobile/step2/forget", {
        forgetType: "mobile",
        mobile: e,
        code: o
    }, function(e, o) {
        1 == e.success && ($("#phoneforget .forget2").hide(), $("#phoneforget .forget3").show()), 0 == e.success && ($("#mobile_step2_error").html(e.msg), $("#mailValidateImg").click())
    })
}), $("#pstep3").click(function() {
    var e = $("#mobileid").val(),
        o = $("#mobile").val(),
        i = $("#mobilcode").val(),
        s = $("#mobile_password").val(),
        l = $("#mobile_password2").val(),
        r = !0;
    0 != (r = pwdCheckNull(s, "#phoneforget .forget3")) && 0 != (r = voidPwd(s, "#phoneforget .forget3")) && 0 != (r = affirmPwdCheckNull(l, "#phoneforget .forget3")) && $.post("/mobile/step3/forget", {
        forgetType: "mobile",
        mobile: o,
        id: e,
        password: s,
        password_repeat: l,
        code: i
    }, function(e, o) {
        1 == e.success && ($("#phoneforget .forget3").hide(), $("#phoneforget .forget4").show()), 0 == e.success && $("#mobile_step3_error").html(e.msg)
    })
}), $(function() {
    createImg($("#mail_validate_img"), $("#mail_t", "")), $("#mail_validate_img").click(function() {
        return createImg($("#mail_validate_img"), $("#mail_t", "")), !1
    }), $("#mstep1").click(function() {
        var m = $("#mail_txt").val(),
            u = $("#uname_txt").val();
        unameCheckNull(u, "#mailforget") && mailCheckNull(m, "#mailforget") && voidMail(m, "#mailforget") && $.post("/getpass.php?do=submit", {
            uname: u,
            email: m,
            act: "sendpass",
            ajax_gets: 1
        }, function(e, o) {
            var e = eval(e);
            true === e.success && ($("#mail_name").html(u), $("#mail_des").html(m + " 请登录邮箱完成新密码设置"), $("#mailforget .forget1").hide(), $("#mailforget .forget2").show()), false === e.success && ($("#mail_step1_error").html(e.message), $("#mail_validate_img").click())
        })
    }), $("#mstep2").click(function() {
        $(this).parent(".forget2").hide(), $("#mailforget .forget3").show()
    }), $("#mstep3").click(function() {
        var e = $("#id").val(),
            o = $("#checkcode").val(),
            i = $("#mail_pass1").val(),
            s = $("#mail_pass2").val(),
            l = !0;
        0 != (l = pwdCheckNull(i, "#mailforget .forget3")) && 0 != (l = voidPwd(i, "#mailforget .forget3")) && 0 != (l = affirmPwdCheckNull(s, "#mailforget .forget3")) && $.post("/setpass.php?do=submit", {
            newpass: i,
            repass: s,
            act: "newpass",
            id: e,
            checkcode: o,
            ajax_gets: 1
        }, function(e, o) {
            var e = eval(e);
            true === e.success && ($("#mail_name").html(e.message), $("#mailforget .forget3").hide(), $("#mailforget .forget4").show()), false === e.success && $("#mail_step3_error").html(e.message)
        })
    })
});
