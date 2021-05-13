$(function() {
    (new indexSlide).init(".mod-banner .banner-slide", 2e3, 10), $("#tabs-yy-1").slide({
        titCell: "#tabs-yy-bd li",
        mainCell: "#tabs-yy-hd",
        autoPlay: !0
    }), $("#tabs-2").slide({
        titCell: "#tabs-2-bd li",
        mainCell: "#tabs-2-hd",
        autoPlay: !1
    }), $("#tabs-3").slide({
        titCell: "#tabs-3-bd li",
        mainCell: "#tabs-3-hd",
        autoPlay: !1
    }), $("#banner-1").slide({
        mainCell: "#slider-b-1",
        autoPlay: !0,
        easing: "linear",
        delayTime: 2e3
    }), $("#banner-2").slide({
        mainCell: "#slider-b-2",
        autoPlay: !0,
        easing: "linear",
        delayTime: 2e3
    }), $("#banner-3").slide({
        mainCell: "#slider-b-3",
        autoPlay: !0,
        easing: "linear",
        delayTime: 2e3
    }), $(".lazyimg").lazyload({
        threshold: 100,
        effect: "fadeIn",
        skip_invisible: !1
    }), topReturn(!0)
});
