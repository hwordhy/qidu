$(function() {
    $().ready(function() {
        $.validator.addMethod("passwordRule", function(s, o, r) {
            return /^.{6,18}$/.test(s)
        }), $.validator.addMethod("notEqualTo", function(s, o, r) {
            return s != $("#modifypassword").find(".curpassword input").val()
        }), $("#modifypassword").validate({
            submitHandler: function(s) {
                var o = $(s).find(".curpassword input").val(),
                    r = $(s).find(".newpassword input").val(),
                    e = $(s).find(".passwordConfirm input").val();
                $.ajax({
                    url: "/passedit.php?do=submit",
                    data: {
                        oldpass: o,
                        newpass: r,
                        repass: e,
                        act: "update",
                        ajax_gets: 1,
                        jieqi_token: jieqi_token
                    },
                    type: "POST",
                    success: function(s) {
                        s = eval(s);
                        if (s.success === true) {
                            layer.msg(s.message, {icon: 1,shade: .3});
                            setTimeout(function() {
                                location.href = s.backUrl
                            }, 1e3)
                        }
                        else{
                            layer.msg(s.message, {icon: 2,shade: .3});
                        }
                    },
                    error: function(s) {}
                })
            },
            onkeyup: !1,
            debug: !0,
            rules: {
                curpassword: {
                    required: !0
                },
                newpassword: {
                    required: !0,
                    passwordRule: !0,
                    notEqualTo: !0
                },
                confirmpassword: {
                    required: !0,
                    equalTo: "#newpassword",
                    passwordRule: !0
                }
            },
            messages: {
                curpassword: {
                    required: "请填写当前密码"
                },
                newpassword: {
                    required: "请填写新密码",
                    passwordRule: "6-18位大小写字母、符号或数字",
                    notEqualTo: "新密码与原密码相同"
                },
                confirmpassword: {
                    required: "请再次输入新密码",
                    equalTo: "确认新密码与新密码不一致",
                    passwordRule: "6-18位大小写字母、符号或数字"
                }
            }
        })
    })
});
