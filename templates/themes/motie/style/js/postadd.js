$(function() {
    // function t(t, e) {
    //     v++, $.ajax({
    //         url: "/ajax/crab/validate",
    //         data: {
    //             content: t
    //         },
    //         type: "POST",
    //         success: function(t) {
    //             "function" == typeof e && e(t), 0 === --v && 1 === y && $(".j-post .submita").click()
    //         },
    //         error: function(t) {
    //             v--
    //         }
    //     })
    // }
    function e(t) {
        g = !0, t.length > 30 ? $(this).val(t.substr(0, 30)) : 0 == t.length ? (f.find(".warning").text("标题不能为空").addClass("show"), g = !1) : f.find(".warning").removeClass("show")
    }
    function a(t) {
        b = !0;
        var e = t.replace(/[\s\u3000\r\n]/g, "").length;
        0 == e ? (j.find(".warning").text("内容不能为空").addClass("show"), b = !1) : e < 10 && e > 0 ? (j.find(".warning").text("内容不少于10个字").addClass("show"), b = !1) : j.find(".warning").removeClass("show")
    }
    function i(t) {
        if (0 == t.length) return "";
        for (var e = t.split("(\n\r)|(\n)"), a = null, i = 0, n = [], s = e.length; i < s; i++) a = e[i], "" == a ? n.push("\n\r") : n.push(function(t) {
            var e = t.match(/(<a\b[^>]+>(.*?)<\/a>)/gi),
                a = [];
            if (t = "　　" + t.replace(/^([\n]+)|[ \u3000\t\r]/g, "").replace(/[\n]+/g, "\r\n\r\n　　"), e && e.length) {
                a = t.match(/(<a[^>]+>(.*?)<\/a>)/gi);
                for (var i = 0, n = a.length; i < n; i++) t = t.replace(a[i], e[i])
            }
            return t
        }(a));
        return n.join("")
    }
    function n(t) {
        var e = {},
            a = window.navigator.userAgent;
        a.indexOf("MSIE") >= 1 ? e.ie = !0 : a.indexOf("Firefox") >= 1 ? e.firefox = !0 : a.indexOf("Chrome") >= 1 && (e.chrome = !0);
        try {
            var i = document.getElementById(t);
            if ("" == i.value) return;
            var n = 0;
            if (e.firefox || e.chrome) n = i.files[0].size;
            else {
                if (!e.ie) return 0;
                var s = document.getElementById("tempimg");
                s.dynsrc = i.value, n = s.fileSize
            }
            return n
        } catch (t) {}
    }
    function s(t) {
        $(".j-upload .warning").text(t).addClass("show")
    }
    function o() {
        $(".j-upload .warning").removeClass("show")
    }
    function r() {
        $(".j-upload .picaddshow .areabox").length >= 5 ? (C.disable(), $(".j-upload  .picadd").removeClass("ui_hoverbgbgwhite")) : ($(".j-upload  .picadd").addClass("ui_hoverbgbgwhite"), C.enable())
    }
    function c(t) {
        var e = Handlebars.compile($("#new_img_template").html());
        $(".j-upload .picaddshow .warning").before(e(t)), r()
    }
    function d() {
        y = 0;
        var t = $(".j-title-input input").val(),
            e = $(".j-textarea-content textarea").val(),
            c = $("#checkcode").val(),
            a = $(".j-classis .checked").data("type"),
            f = $("#fid").val()
        var n = "1" == $(".j-setting .tagscur").data("type"),
            s = [];
        $(".j-upload .picaddshow .areabox").each(function(t, e) {
            var a = $(this).find("dt img").eq(0).attr("src"),
                i = $(this).find("dd .picdesc").val();
            s.push({
                objectUrl: a,
                description: i
            })
        });
        var o = {
                do: "submit",
                topictitle: t,
                posttext: e,
                fid: f,
                act: "newpost",
                jieqi_token: jieqi_token,
                checkcode: c,
                ajax_gets: 1
            },
            p = {
                topictitle: t,
                posttext: e,
                pid: page_config.pid,
                act: "update",
                jieqi_token: jieqi_token,
                checkcode: c,
                ajax_gets: 1
            }
        page_config.topicId ? u(p) : l(o)
    }
    function l(d) {
        T || (T = !0, $.ajax({
            url: "/modules/forum/newpost.php",
            type: "POST",
            data: d,
            enctype: "multipart/form-data",
            success: function(t) {
                t = eval(t);
                $("#checkcode").val(), $("#p_imgccode").click();
                false === t.success ? ($(".sendpost .postmsg").text(t.message).addClass("show"), $(".j-post .submita").text("重新发布"), T = !1) : ($(".sendpost .postmsg").removeClass("show"), layerPop.openTips(t.message, 3e3), setTimeout(function() {
                    window.location.href = t.setting.blackUrl;
                    }, 2e3))
            },
            error: function(t) {
                T = !1
            }
        }))
    }
    function u(t) {
        T || (T = !0, $.ajax({
            url: "/modules/forum/postedit.php",
            type: "POST",
            data: t,
            enctype: "multipart/form-data",
            success: function(t) {
                t = eval(t);
                $("#checkcode").val(), $("#p_imgccode").click();
                if (false === t.success) return $(".sendpost .postmsg").text(t.message).addClass("show"), $(".j-post .submita").text("重新发布"), void(T = !1);
                layerPop.openTips(t.message), setTimeout(function() {
                    location.href = t.backUrl, T = !1
                }, 2e3)
            },
            error: function(t) {
                T = !1
            }
        }))
    }
    // var p = {
    //     modifyId: page_config.topicId,
    //     init: function() {
    //         this.getTopicData()
    //     },
    //     getTopicData: function() {
    //         var t = this;
    //         $.ajax({
    //             url: "/ajax/bbs/topics/" + this.modifyId,
    //             data: {},
    //             type: "GET",
    //             success: function(e) {
    //                 t.renderTopic(e)
    //             },
    //             error: function(t) {}
    //         })
    //     },
    //     renderTopic: function(t) {
    //         var e = t.name,
    //             a = t.content,
    //             i = t.reply,
    //             n = t.tagId,
    //             s = t.type;
    //         $(".j-title-input").find("input").val(e), $(".j-textarea-content").find("textarea").val(a), $(".j-classis").find(".radiobox").eq(0).removeClass("checked").find(".radio-l").removeClass("ui_bgcolor"), $(".j-classis").find(".radiobox").each(function(t, e) {
    //             $(this).data("type") == s && $(this).addClass("checked").find(".radio-l").addClass("ui_bgcolor")
    //         }), 4 == s ? $(".j-tags").hide() : n > 0 && $(".j-tags .p_tags").each(function(t, e) {
    //             $(this).data("type") == n && $(this).addClass("tagscur ui_bg_bdcolor")
    //         }), !0 !== i && ($(".j-setting .p_tags").eq(0).removeClass("tagscur ui_bg_bdcolor"), $(".j-setting .p_tags").eq(1).addClass("tagscur ui_bg_bdcolor")), $.each(t.imgList, function(t, e) {
    //             c({
    //                 url: e.imageUrlSmall,
    //                 content: e.description
    //             })
    //         })
    //     }
    // };
    //page_config.topicId && p.init();
    var g, f = $(".j-title-input"),
        h = !0,
        v = 0;
    f.find("input").on("input propertychange", function() {
        h = !1, e($(this).val())
    }).on("blur", function() {
        var a = $(this).val();
        if (e(a), !g) return !1;
        // t(a, function(t) {
        //     if (t.success) f.find(".warning").removeClass("show"), h = !0;
        //     else {
        //         var e = t.attributes.crabs.join(" ");
        //         f.find(".warning").text("敏感词:" + e).addClass("show"), h = !1
        //     }
        // })
    }), $(".j-classis").find(".radiobox").on("click", function() {
        $(this).siblings().removeClass("checked").find(".radio-l").removeClass("ui_bgcolor"), $(this).addClass("checked").find(".radio-l").addClass("ui_bgcolor"), 4 == $(this).data("type") ? $(".j-tags").hide() : $(".j-tags").show()
    }), $(".j-tags .p_tags").on("click", function() {
        $(this).hasClass("tagscur") ? $(this).removeClass("tagscur ui_bg_bdcolor") : $(this).siblings().removeClass("tagscur ui_bg_bdcolor").end().addClass("tagscur ui_bg_bdcolor")
    }), $(".j-setting .p_tags").on("click", function() {
        $(this).siblings().removeClass("tagscur ui_bg_bdcolor").end().addClass("tagscur ui_bg_bdcolor")
    });
    var b, m = "",
        j = $(".j-textarea-content"),
        x = !0;
    $(".j-textarea-content textarea").on("input propertychange", function() {
        var t = $(this).val();
        x = !1;
        var e = t.length;
        e > 1e4 && (j.find("textarea").val(t.substr(0, 1e4)), e = 1e4), $(".j-textarea-content .num").text(e + "/10000"), e >= 10 ? j.find(".warning").removeClass("show") : e > 0 && e < 10 && j.find(".warning").removeClass("show")
    }), $(".j-textarea-content textarea").on("blur", function() {
        var e = $(this).val();
        if (a(e), 1 == b) {
            // t(e, function(t) {
            //     if (t.success) j.find(".warning").removeClass("show"), x = !0;
            //     else {
            //         var e = t.attributes.crabs.join(" ");
            //         j.find(".warning").text("敏感词:" + e).addClass("show"), x = !1
            //     }
            // });
            var n = i(e);
            m = n, $(this).val(n), n = n.replace(/[ \u3000\t\r\n]/g, "");
            var s = n.length;
            $(".j-textarea-content .num").text(s + "/10000")
        }
    });
    var w = !0
    // C = new AjaxUpload($(".picadd"), {
    //     action: "/ajax/image/temp",
    //     name: "uploadfile",
    //     hoverClass: "",
    //     focusClass: "",
    //     responseType: "json",
    //     appendTo: ".picaddbox .picadd",
    //     onChange: function(t) {
    //         var e = n("fileuploade-input");
    //         if (e >= 5242880) return s("仅支持JPEGJPGGIFPNG文件，且图片尺寸不超过5M。"), !1
    //     },
    //     onSubmit: function(t, e) {
    //         if ($(".picadd").removeClass("show"), $(".picloading").addClass("show"), !e || !/^(jpg|jpeg|gif|png)$/i.test(e)) return s("仅支持JPEGJPGGIFPNG文件，且图片尺寸不超过5M。"), $(".picadd").addClass("show"), $(".picloading").removeClass("show"), !1;
    //         o()
    //     },
    //     onComplete: function(t, e) {
    //         if ($(".picadd").addClass("show"), $(".picloading").removeClass("show"), e.success && e.attributes) {
    //             c({
    //                 url: e.attributes.fileUrl
    //             })
    //         }
    //     }
    // });
    $(".j-upload .picaddshow").on("input propertychange", "textarea", function() {
        "" == t && (o(), r()), w = !1;
        var t = $(this).val(),
            e = t.length;
        e > 30 && ($(this).val(t.substr(0, 30)), e = 30), $(this).siblings("span").find(".num").text(e + "/30")
    }).on("blur", "textarea", function() {
        var e = $(this).val();
        if ("" == e) return o(), w = !0, r(), !1;
        $(this).val(e.replace(/^\s+/g, "")), t(e, function(t) {
            if (t.success) o(), w = !0, r();
            else {
                s("敏感词:" + t.attributes.crabs.join(" ")), w = !1, C.disable()
            }
        })
    }), $(".j-upload .picaddshow").on("click", ".delbtn", function() {
        $(this).parents(".areabox").remove(), $(".j-upload .picaddshow .areabox").length < 5 && r()
    });
    var _ = !1;
    // $.ajax({
    //     url: "/ajax/bbs/topics/fastCheckPic",
    //     type: "get",
    //     dataType: "json",
    //     success: function(t) {
    //         initGeetest({
    //             gt: t.gt,
    //             challenge: t.challenge,
    //             product: "float",
    //             offline: !t.success
    //         }, function(t) {
    //             t.appendTo("#j-verifycode"), t.onSuccess(function() {
    //                 _ = !0, $("#j-verifycode .codemsg").hide()
    //             })
    //         })
    //     }
    // });
    var y = 0,
        T = !1;
    $(".j-post .submita").on("click", function() {
        var t = !0;
        // _ || ($("#j-verifycode .codemsg").text("请拖动滑块进行验证").show(), t = !1);
        var i = $(".j-title-input input").val(),
            n = $(".j-textarea-content textarea").val();
        if (h && e(i), x && a(n), g && b || (t = !1), t) {
            //if (!(h && x && w)) return void(v > 0 && ($(".j-post .submita").text("正在校验···"), y = 1));
            $(".j-post .submita").text("正在提交···"), d()
        }
    })
});
