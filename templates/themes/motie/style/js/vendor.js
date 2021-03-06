!
function(t) {
	var e = {},
		n = {
			mode: "horizontal",
			slideSelector: "",
			infiniteLoop: !0,
			hideControlOnEnd: !1,
			speed: 500,
			easing: null,
			slideMargin: 0,
			startSlide: 0,
			randomStart: !1,
			captions: !1,
			ticker: !1,
			tickerHover: !1,
			adaptiveHeight: !1,
			adaptiveHeightSpeed: 500,
			video: !1,
			useCSS: !0,
			preloadImages: "visible",
			responsive: !0,
			slideZIndex: 50,
			wrapperClass: "bx-wrapper",
			touchEnabled: !0,
			swipeThreshold: 50,
			oneToOneTouch: !0,
			preventDefaultSwipeX: !0,
			preventDefaultSwipeY: !1,
			pager: !0,
			pagerType: "full",
			pagerShortSeparator: " / ",
			pagerSelector: null,
			buildPager: null,
			pagerCustom: null,
			controls: !0,
			nextText: "Next",
			prevText: "Prev",
			nextSelector: null,
			prevSelector: null,
			autoControls: !1,
			startText: "Start",
			stopText: "Stop",
			autoControlsCombine: !1,
			autoControlsSelector: null,
			auto: !1,
			pause: 4e3,
			autoStart: !0,
			autoDirection: "next",
			autoHover: !1,
			autoDelay: 0,
			autoSlideForOnePage: !1,
			minSlides: 1,
			maxSlides: 1,
			moveSlides: 0,
			slideWidth: 0,
			onSliderLoad: function() {},
			onSlideBefore: function() {},
			onSlideAfter: function() {},
			onSlideNext: function() {},
			onSlidePrev: function() {},
			onSliderResize: function() {}
		};
	t.fn.bxSlider = function(a) {
		if (0 == this.length) return this;
		if (this.length > 1) return this.each(function() {
			t(this).bxSlider(a)
		}), this;
		var s = {},
			o = this;
		e.el = this;
		var r = t(window).width(),
			l = t(window).height(),
			d = function() {
				s.settings = t.extend({}, n, a), s.settings.slideWidth = parseInt(s.settings.slideWidth), s.children = o.children(s.settings.slideSelector), s.children.length < s.settings.minSlides && (s.settings.minSlides = s.children.length), s.children.length < s.settings.maxSlides && (s.settings.maxSlides = s.children.length), s.settings.randomStart && (s.settings.startSlide = Math.floor(Math.random() * s.children.length)), s.active = {
					index: s.settings.startSlide
				}, s.carousel = s.settings.minSlides > 1 || s.settings.maxSlides > 1, s.carousel && (s.settings.preloadImages = "all"), s.minThreshold = s.settings.minSlides * s.settings.slideWidth + (s.settings.minSlides - 1) * s.settings.slideMargin, s.maxThreshold = s.settings.maxSlides * s.settings.slideWidth + (s.settings.maxSlides - 1) * s.settings.slideMargin, s.working = !1, s.controls = {}, s.interval = null, s.animProp = "vertical" == s.settings.mode ? "top" : "left", s.usingCSS = s.settings.useCSS && "fade" != s.settings.mode &&
				function() {
					var t = document.createElement("div"),
						e = ["WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"];
					for (var i in e) if (void 0 !== t.style[e[i]]) return s.cssPrefix = e[i].replace("Perspective", "").toLowerCase(), s.animProp = "-" + s.cssPrefix + "-transform", !0;
					return !1
				}(), "vertical" == s.settings.mode && (s.settings.maxSlides = s.settings.minSlides), o.data("origStyle", o.attr("style")), o.children(s.settings.slideSelector).each(function() {
					t(this).data("origStyle", t(this).attr("style"))
				}), c()
			},
			c = function() {
				o.wrap('<div class="' + s.settings.wrapperClass + '"><div class="bx-viewport"></div></div>'), s.viewport = o.parent(), s.loader = t('<div class="bx-loading" />'), s.viewport.prepend(s.loader), o.css({
					width: "horizontal" == s.settings.mode ? 100 * s.children.length + 215 + "%" : "auto",
					position: "relative"
				}), s.usingCSS && s.settings.easing ? o.css("-" + s.cssPrefix + "-transition-timing-function", s.settings.easing) : s.settings.easing || (s.settings.easing = "swing");
				v();
				s.viewport.css({
					width: "100%",
					overflow: "hidden",
					position: "relative"
				}), s.viewport.parent().css({
					maxWidth: f()
				}), s.settings.pager || s.viewport.parent().css({
					margin: "0 auto 0px"
				}), s.children.css({
					float: "horizontal" == s.settings.mode ? "left" : "none",
					listStyle: "none",
					position: "relative"
				}), s.children.css("width", g()), "horizontal" == s.settings.mode && s.settings.slideMargin > 0 && s.children.css("marginRight", s.settings.slideMargin), "vertical" == s.settings.mode && s.settings.slideMargin > 0 && s.children.css("marginBottom", s.settings.slideMargin), "fade" == s.settings.mode && (s.children.css({
					position: "absolute",
					zIndex: 0,
					display: "none"
				}), s.children.eq(s.settings.startSlide).css({
					zIndex: s.settings.slideZIndex,
					display: "block"
				})), s.controls.el = t('<div class="bx-controls" />'), s.settings.captions && A(), s.active.last = s.settings.startSlide == m() - 1, s.settings.video && o.fitVids();
				var e = s.children.eq(s.settings.startSlide);
				"all" == s.settings.preloadImages && (e = s.children), s.settings.ticker ? s.settings.pager = !1 : (s.settings.pager && S(), s.settings.controls && C(), s.settings.auto && s.settings.autoControls && T(), (s.settings.controls || s.settings.autoControls || s.settings.pager) && s.viewport.after(s.controls.el)), u(e, h)
			},
			u = function(e, i) {
				var n = e.find("img, iframe").length;
				if (0 == n) return void i();
				var a = 0;
				e.find("img, iframe").each(function() {
					t(this).one("load", function() {
						++a == n && i()
					}).each(function() {
						this.complete && t(this).load()
					})
				})
			},
			h = function() {
				if (s.settings.infiniteLoop && "fade" != s.settings.mode && !s.settings.ticker) {
					var e = "vertical" == s.settings.mode ? s.settings.minSlides : s.settings.maxSlides,
						i = s.children.slice(0, e).clone().addClass("bx-clone"),
						n = s.children.slice(-e).clone().addClass("bx-clone");
					o.append(i).prepend(n)
				}
				s.loader.remove(), b(), "vertical" == s.settings.mode && (s.settings.adaptiveHeight = !0), s.viewport.height(p()), o.redrawSlider(), s.settings.onSliderLoad(s.active.index), s.initialized = !0, s.settings.responsive && t(window).bind("resize", R), s.settings.auto && s.settings.autoStart && (m() > 1 || s.settings.autoSlideForOnePage) && q(), s.settings.ticker && j(), s.settings.pager && L(s.settings.startSlide), s.settings.controls && N(), s.settings.touchEnabled && !s.settings.ticker && D()
			},
			p = function() {
				var e = 0,
					n = t();
				if ("vertical" == s.settings.mode || s.settings.adaptiveHeight) if (s.carousel) {
					var a = 1 == s.settings.moveSlides ? s.active.index : s.active.index * y();
					for (n = s.children.eq(a), i = 1; i <= s.settings.maxSlides - 1; i++) n = a + i >= s.children.length ? n.add(s.children.eq(i - 1)) : n.add(s.children.eq(a + i))
				} else n = s.children.eq(s.active.index);
				else n = s.children;
				return "vertical" == s.settings.mode ? (n.each(function(i) {
					e += t(this).outerHeight()
				}), s.settings.slideMargin > 0 && (e += s.settings.slideMargin * (s.settings.minSlides - 1))) : e = Math.max.apply(Math, n.map(function() {
					return t(this).outerHeight(!1)
				}).get()), "border-box" == s.viewport.css("box-sizing") ? e += parseFloat(s.viewport.css("padding-top")) + parseFloat(s.viewport.css("padding-bottom")) + parseFloat(s.viewport.css("border-top-width")) + parseFloat(s.viewport.css("border-bottom-width")) : "padding-box" == s.viewport.css("box-sizing") && (e += parseFloat(s.viewport.css("padding-top")) + parseFloat(s.viewport.css("padding-bottom"))), e
			},
			f = function() {
				var t = "100%";
				return s.settings.slideWidth > 0 && (t = "horizontal" == s.settings.mode ? s.settings.maxSlides * s.settings.slideWidth + (s.settings.maxSlides - 1) * s.settings.slideMargin : s.settings.slideWidth), t
			},
			g = function() {
				var t = s.settings.slideWidth,
					e = s.viewport.width();
				return 0 == s.settings.slideWidth || s.settings.slideWidth > e && !s.carousel || "vertical" == s.settings.mode ? t = e : s.settings.maxSlides > 1 && "horizontal" == s.settings.mode && (e > s.maxThreshold || e < s.minThreshold && (t = (e - s.settings.slideMargin * (s.settings.minSlides - 1)) / s.settings.minSlides)), t
			},
			v = function() {
				var t = 1;
				if ("horizontal" == s.settings.mode && s.settings.slideWidth > 0) if (s.viewport.width() < s.minThreshold) t = s.settings.minSlides;
				else if (s.viewport.width() > s.maxThreshold) t = s.settings.maxSlides;
				else {
					var e = s.children.first().width() + s.settings.slideMargin;
					t = Math.floor((s.viewport.width() + s.settings.slideMargin) / e)
				} else "vertical" == s.settings.mode && (t = s.settings.minSlides);
				return t
			},
			m = function() {
				var t = 0;
				if (s.settings.moveSlides > 0) if (s.settings.infiniteLoop) t = Math.ceil(s.children.length / y());
				else for (var e = 0, i = 0; e < s.children.length;)++t, e = i + v(), i += s.settings.moveSlides <= v() ? s.settings.moveSlides : v();
				else t = Math.ceil(s.children.length / v());
				return t
			},
			y = function() {
				return s.settings.moveSlides > 0 && s.settings.moveSlides <= v() ? s.settings.moveSlides : v()
			},
			b = function() {
				if (s.children.length > s.settings.maxSlides && s.active.last && !s.settings.infiniteLoop) {
					if ("horizontal" == s.settings.mode) {
						var t = s.children.last(),
							e = t.position();
						x(-(e.left - (s.viewport.width() - t.outerWidth())), "reset", 0)
					} else if ("vertical" == s.settings.mode) {
						var i = s.children.length - s.settings.minSlides,
							e = s.children.eq(i).position();
						x(-e.top, "reset", 0)
					}
				} else {
					var e = s.children.eq(s.active.index * y()).position();
					s.active.index == m() - 1 && (s.active.last = !0), void 0 != e && ("horizontal" == s.settings.mode ? x(-e.left, "reset", 0) : "vertical" == s.settings.mode && x(-e.top, "reset", 0))
				}
			},
			x = function(t, e, i, n) {
				if (s.usingCSS) {
					var a = "vertical" == s.settings.mode ? "translate3d(0, " + t + "px, 0)" : "translate3d(" + t + "px, 0, 0)";
					o.css("-" + s.cssPrefix + "-transition-duration", i / 1e3 + "s"), "slide" == e ? (o.css(s.animProp, a), o.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
						o.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"), F()
					})) : "reset" == e ? o.css(s.animProp, a) : "ticker" == e && (o.css("-" + s.cssPrefix + "-transition-timing-function", "linear"), o.css(s.animProp, a), o.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
						o.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"), x(n.resetValue, "reset", 0), O()
					}))
				} else {
					var r = {};
					r[s.animProp] = t, "slide" == e ? o.animate(r, i, s.settings.easing, function() {
						F()
					}) : "reset" == e ? o.css(s.animProp, t) : "ticker" == e && o.animate(r, speed, "linear", function() {
						x(n.resetValue, "reset", 0), O()
					})
				}
			},
			w = function() {
				for (var e = "", i = m(), n = 0; n < i; n++) {
					var a = "";
					s.settings.buildPager && t.isFunction(s.settings.buildPager) ? (a = s.settings.buildPager(n), s.pagerEl.addClass("bx-custom-pager")) : (a = n + 1, s.pagerEl.addClass("bx-default-pager")), e += '<div class="bx-pager-item"><a href="" data-slide-index="' + n + '" class="bx-pager-link">' + a + "</a></div>"
				}
				s.pagerEl.html(e)
			},
			S = function() {
				s.settings.pagerCustom ? s.pagerEl = t(s.settings.pagerCustom) : (s.pagerEl = t('<div class="bx-pager" />'), s.settings.pagerSelector ? t(s.settings.pagerSelector).html(s.pagerEl) : s.controls.el.addClass("bx-has-pager").append(s.pagerEl), w()), s.pagerEl.on("click", "a", E)
			},
			C = function() {
				s.controls.next = t('<a class="bx-next" href="javascript:;">' + s.settings.nextText + "</a>"), s.controls.prev = t('<a class="bx-prev" href="javascript:;">' + s.settings.prevText + "</a>"), s.controls.next.bind("click", k), s.controls.prev.bind("click", I), s.settings.nextSelector && t(s.settings.nextSelector).append(s.controls.next), s.settings.prevSelector && t(s.settings.prevSelector).append(s.controls.prev), s.settings.nextSelector || s.settings.prevSelector || (s.controls.directionEl = t('<div class="bx-controls-direction" />'), s.controls.directionEl.append(s.controls.prev).append(s.controls.next), s.controls.el.addClass("bx-has-controls-direction").append(s.controls.directionEl))
			},
			T = function() {
				s.controls.start = t('<div class="bx-controls-auto-item"><a class="bx-start" href="">' + s.settings.startText + "</a></div>"), s.controls.stop = t('<div class="bx-controls-auto-item"><a class="bx-stop" href="">' + s.settings.stopText + "</a></div>"), s.controls.autoEl = t('<div class="bx-controls-auto" />'), s.controls.autoEl.on("click", ".bx-start", P), s.controls.autoEl.on("click", ".bx-stop", M), s.settings.autoControlsCombine ? s.controls.autoEl.append(s.controls.start) : s.controls.autoEl.append(s.controls.start).append(s.controls.stop), s.settings.autoControlsSelector ? t(s.settings.autoControlsSelector).html(s.controls.autoEl) : s.controls.el.addClass("bx-has-controls-auto").append(s.controls.autoEl), z(s.settings.autoStart ? "stop" : "start")
			},
			A = function() {
				s.children.each(function(e) {
					var i = t(this).find("img:first").attr("title");
					void 0 != i && ("" + i).length && t(this).append('<div class="bx-caption"><span>' + i + "</span></div>")
				})
			},
			k = function(t) {
				s.settings.auto && o.stopAuto(), o.goToNextSlide(), t.preventDefault()
			},
			I = function(t) {
				s.settings.auto && o.stopAuto(), o.goToPrevSlide(), t.preventDefault()
			},
			P = function(t) {
				o.startAuto(), t.preventDefault()
			},
			M = function(t) {
				o.stopAuto(), t.preventDefault()
			},
			E = function(e) {
				s.settings.auto && o.stopAuto();
				var i = t(e.currentTarget);
				if (void 0 !== i.attr("data-slide-index")) {
					var n = parseInt(i.attr("data-slide-index"));
					n != s.active.index && o.goToSlide(n), e.preventDefault()
				}
			},
			L = function(e) {
				var i = s.children.length;
				if ("short" == s.settings.pagerType) return s.settings.maxSlides > 1 && (i = Math.ceil(s.children.length / s.settings.maxSlides)), void s.pagerEl.html(e + 1 + s.settings.pagerShortSeparator + i);
				s.pagerEl.find("a").removeClass("active"), s.pagerEl.each(function(i, n) {
					t(n).find("a").eq(e).addClass("active")
				})
			},
			F = function() {
				if (s.settings.infiniteLoop) {
					var t = "";
					0 == s.active.index ? t = s.children.eq(0).position() : s.active.index == m() - 1 && s.carousel ? t = s.children.eq((m() - 1) * y()).position() : s.active.index == s.children.length - 1 && (t = s.children.eq(s.children.length - 1).position()), t && ("horizontal" == s.settings.mode ? x(-t.left, "reset", 0) : "vertical" == s.settings.mode && x(-t.top, "reset", 0))
				}
				s.working = !1, s.settings.onSlideAfter(s.children.eq(s.active.index), s.oldIndex, s.active.index)
			},
			z = function(t) {
				s.settings.autoControlsCombine ? s.controls.autoEl.html(s.controls[t]) : (s.controls.autoEl.find("a").removeClass("active"), s.controls.autoEl.find("a:not(.bx-" + t + ")").addClass("active"))
			},
			N = function() {
				1 == m() ? (s.controls.prev.addClass("disabled"), s.controls.next.addClass("disabled")) : !s.settings.infiniteLoop && s.settings.hideControlOnEnd && (0 == s.active.index ? (s.controls.prev.addClass("disabled"), s.controls.next.removeClass("disabled")) : s.active.index == m() - 1 ? (s.controls.next.addClass("disabled"), s.controls.prev.removeClass("disabled")) : (s.controls.prev.removeClass("disabled"), s.controls.next.removeClass("disabled")))
			},
			q = function() {
				if (s.settings.autoDelay > 0) {
					setTimeout(o.startAuto, s.settings.autoDelay)
				} else o.startAuto();
				s.settings.autoHover && o.hover(function() {
					s.interval && (o.stopAuto(!0), s.autoPaused = !0)
				}, function() {
					s.autoPaused && (o.startAuto(!0), s.autoPaused = null)
				})
			},
			j = function() {
				var e = 0;
				if ("next" == s.settings.autoDirection) o.append(s.children.clone().addClass("bx-clone"));
				else {
					o.prepend(s.children.clone().addClass("bx-clone"));
					var i = s.children.first().position();
					e = "horizontal" == s.settings.mode ? -i.left : -i.top
				}
				x(e, "reset", 0), s.settings.pager = !1, s.settings.controls = !1, s.settings.autoControls = !1, s.settings.tickerHover && !s.usingCSS && s.viewport.hover(function() {
					o.stop()
				}, function() {
					var e = 0;
					s.children.each(function(i) {
						e += "horizontal" == s.settings.mode ? t(this).outerWidth(!0) : t(this).outerHeight(!0)
					});
					var i = s.settings.speed / e,
						n = "horizontal" == s.settings.mode ? "left" : "top",
						a = i * (e - Math.abs(parseInt(o.css(n))));
					O(a)
				}), O()
			},
			O = function(t) {
				speed = t || s.settings.speed;
				var e = {
					left: 0,
					top: 0
				},
					i = {
						left: 0,
						top: 0
					};
				"next" == s.settings.autoDirection ? e = o.find(".bx-clone").first().position() : i = s.children.first().position();
				var n = "horizontal" == s.settings.mode ? -e.left : -e.top,
					a = "horizontal" == s.settings.mode ? -i.left : -i.top,
					r = {
						resetValue: a
					};
				x(n, "ticker", speed, r)
			},
			D = function() {
				s.touch = {
					start: {
						x: 0,
						y: 0
					},
					end: {
						x: 0,
						y: 0
					}
				}, s.viewport.bind("touchstart", B)
			},
			B = function(t) {
				if (s.working) t.preventDefault();
				else {
					s.touch.originalPos = o.position();
					var e = t.originalEvent;
					s.touch.start.x = e.changedTouches[0].pageX, s.touch.start.y = e.changedTouches[0].pageY, s.viewport.bind("touchmove", W), s.viewport.bind("touchend", H)
				}
			},
			W = function(t) {
				var e = t.originalEvent,
					i = Math.abs(e.changedTouches[0].pageX - s.touch.start.x),
					n = Math.abs(e.changedTouches[0].pageY - s.touch.start.y);
				if (3 * i > n && s.settings.preventDefaultSwipeX ? t.preventDefault() : 3 * n > i && s.settings.preventDefaultSwipeY && t.preventDefault(), "fade" != s.settings.mode && s.settings.oneToOneTouch) {
					var a = 0;
					if ("horizontal" == s.settings.mode) {
						var o = e.changedTouches[0].pageX - s.touch.start.x;
						a = s.touch.originalPos.left + o
					} else {
						var o = e.changedTouches[0].pageY - s.touch.start.y;
						a = s.touch.originalPos.top + o
					}
					x(a, "reset", 0)
				}
			},
			H = function(t) {
				s.viewport.unbind("touchmove", W);
				var e = t.originalEvent,
					i = 0;
				if (s.touch.end.x = e.changedTouches[0].pageX, s.touch.end.y = e.changedTouches[0].pageY, "fade" == s.settings.mode) {
					var n = Math.abs(s.touch.start.x - s.touch.end.x);
					n >= s.settings.swipeThreshold && (s.touch.start.x > s.touch.end.x ? o.goToNextSlide() : o.goToPrevSlide(), o.stopAuto())
				} else {
					var n = 0;
					"horizontal" == s.settings.mode ? (n = s.touch.end.x - s.touch.start.x, i = s.touch.originalPos.left) : (n = s.touch.end.y - s.touch.start.y, i = s.touch.originalPos.top), !s.settings.infiniteLoop && (0 == s.active.index && n > 0 || s.active.last && n < 0) ? x(i, "reset", 200) : Math.abs(n) >= s.settings.swipeThreshold ? (n < 0 ? o.goToNextSlide() : o.goToPrevSlide(), o.stopAuto()) : x(i, "reset", 200)
				}
				s.viewport.unbind("touchend", H)
			},
			R = function(e) {
				if (s.initialized) {
					var i = t(window).width(),
						n = t(window).height();
					r == i && l == n || (r = i, l = n, o.redrawSlider(), s.settings.onSliderResize.call(o, s.active.index))
				}
			};
		return o.goToSlide = function(e, i) {
			if (!s.working && s.active.index != e) if (s.working = !0, s.oldIndex = s.active.index, e < 0 ? s.active.index = m() - 1 : e >= m() ? s.active.index = 0 : s.active.index = e, s.settings.onSlideBefore(s.children.eq(s.active.index), s.oldIndex, s.active.index), "next" == i ? s.settings.onSlideNext(s.children.eq(s.active.index), s.oldIndex, s.active.index) : "prev" == i && s.settings.onSlidePrev(s.children.eq(s.active.index), s.oldIndex, s.active.index), s.active.last = s.active.index >= m() - 1, s.settings.pager && L(s.active.index), s.settings.controls && N(), "fade" == s.settings.mode) s.settings.adaptiveHeight && s.viewport.height() != p() && s.viewport.animate({
				height: p()
			}, s.settings.adaptiveHeightSpeed), s.children.filter(":visible").fadeOut(s.settings.speed).css({
				zIndex: 0
			}), s.children.eq(s.active.index).css("zIndex", s.settings.slideZIndex + 1).fadeIn(s.settings.speed, function() {
				t(this).css("zIndex", s.settings.slideZIndex), F()
			});
			else {
				s.settings.adaptiveHeight && s.viewport.height() != p() && s.viewport.animate({
					height: p()
				}, s.settings.adaptiveHeightSpeed);
				var n = 0,
					a = {
						left: 0,
						top: 0
					};
				if (!s.settings.infiniteLoop && s.carousel && s.active.last) if ("horizontal" == s.settings.mode) {
					var r = s.children.eq(s.children.length - 1);
					a = r.position(), n = s.viewport.width() - r.outerWidth()
				} else {
					var l = s.children.length - s.settings.minSlides;
					a = s.children.eq(l).position()
				} else if (s.carousel && s.active.last && "prev" == i) {
					var d = 1 == s.settings.moveSlides ? s.settings.maxSlides - y() : (m() - 1) * y() - (s.children.length - s.settings.maxSlides),
						r = o.children(".bx-clone").eq(d);
					a = r.position()
				} else if ("next" == i && 0 == s.active.index) a = o.find("> .bx-clone").eq(s.settings.maxSlides).position(), s.active.last = !1;
				else if (e >= 0) {
					var c = e * y();
					a = s.children.eq(c).position()
				}
				if (void 0 !== a) {
					var u = "horizontal" == s.settings.mode ? -(a.left - n) : -a.top;
					x(u, "slide", s.settings.speed)
				}
			}
		}, o.goToNextSlide = function() {
			if (s.settings.infiniteLoop || !s.active.last) {
				var t = parseInt(s.active.index) + 1;
				o.goToSlide(t, "next")
			}
		}, o.goToPrevSlide = function() {
			if (s.settings.infiniteLoop || 0 != s.active.index) {
				var t = parseInt(s.active.index) - 1;
				o.goToSlide(t, "prev")
			}
		}, o.startAuto = function(t) {
			s.interval || (s.interval = setInterval(function() {
				"next" == s.settings.autoDirection ? o.goToNextSlide() : o.goToPrevSlide()
			}, s.settings.pause), s.settings.autoControls && 1 != t && z("stop"))
		}, o.stopAuto = function(t) {
			s.interval && (clearInterval(s.interval), s.interval = null, s.settings.autoControls && 1 != t && z("start"))
		}, o.getCurrentSlide = function() {
			return s.active.index
		}, o.getCurrentSlideElement = function() {
			return s.children.eq(s.active.index)
		}, o.getSlideCount = function() {
			return s.children.length
		}, o.redrawSlider = function() {
			s.children.add(o.find(".bx-clone")).width(g()), s.viewport.css("height", p()), s.settings.ticker || b(), s.active.last && (s.active.index = m() - 1), s.active.index >= m() && (s.active.last = !0), s.settings.pager && !s.settings.pagerCustom && (w(), L(s.active.index))
		}, o.destroySlider = function() {
			s.initialized && (s.initialized = !1, t(".bx-clone", this).remove(), s.children.each(function() {
				void 0 != t(this).data("origStyle") ? t(this).attr("style", t(this).data("origStyle")) : t(this).removeAttr("style")
			}), void 0 != t(this).data("origStyle") ? this.attr("style", t(this).data("origStyle")) : t(this).removeAttr("style"), t(this).unwrap().unwrap(), s.controls.el && s.controls.el.remove(), s.controls.next && s.controls.next.remove(), s.controls.prev && s.controls.prev.remove(), s.pagerEl && s.settings.controls && s.pagerEl.remove(), t(".bx-caption", this).remove(), s.controls.autoEl && s.controls.autoEl.remove(), clearInterval(s.interval), s.settings.responsive && t(window).unbind("resize", R))
		}, o.reloadSlider = function(t) {
			void 0 != t && (a = t), o.destroySlider(), d()
		}, d(), this
	}
}(jQuery), function(t) {
	"function" != typeof define || !define.amd && !define.cmd || jQuery ? "object" == typeof module && module.exports ? module.exports = function(e, i) {
		return void 0 === i && (i = "undefined" != typeof window ? require("jquery") : require("jquery")(e)), t(i), i
	} : t(jQuery) : define(["jquery"], t)
}(function(t) {
	var e = {},
		i = function(e, i) {
			var n = i,
				a = 0,
				s = t(document),
				o = t(e);
			this.setPageCount = function(t) {}, this.getPageCount = function() {
				return n.pageAll
			}, this.getCurrent = function() {
				return a
			}, this.filling = function(t) {
				var e = "",
					i = this.getPageCount();
				if (!((a = t) < 1 || a > i)) {
					if (e += '<div class="ui-pagination">', 1 == a ? (e += '<span  class="first" >????????? </span>', e += '<span class="active ' + n.activeCls + '">1</span>') : (e += '<a href="javascript:void(0)"  class="prev">????????? </a>', e += '<a href="javascript:void(0)"  data-page="1">1</a>'), i < 9) for (var s = 2; s <= i; s++) e += s == a ? '<span class="active ' + n.activeCls + '">' + s + "</span>" : '<a href="javascript:void(0);" data-page="' + s + '">' + s + "</a>";
					if (i >= 9) if (a < 5) {
						for (var s = 2; s <= 5; s++) e += s == a ? '<span class="active ' + n.activeCls + '">' + s + "</span>" : '<a href="javascript:void(0);" data-page="' + s + '">' + s + "</a>";
						e += "<span>...</span>", e += '<a href="javascript:void(0);" data-page="' + i + '">' + i + "</a>"
					} else if (a >= 5 && a < i - 3) {
						e += "<span>...</span>";
						for (var s = a - 2; s <= a + 2; s++) e += s == a ? '<span class="active ' + n.activeCls + '">' + s + "</span>" : '<a href="javascript:void(0);" data-page="' + s + '">' + s + "</a>";
						e += "<span>...</span>", e += '<a href="javascript:void(0);" data-page="' + i + '">' + i + "</a>"
					} else {
						e += "<span>...</span>";
						for (var s = i - 4; s <= i; s++) e += s == a ? '<span class="active ' + n.activeCls + '">' + s + "</span>" : '<a href="javascript:void(0);" data-page="' + s + '">' + s + "</a>"
					}
					e += a == i ? '<span  class="last">?????????</span>' : '<a href="javascript:void(0);"   class="next">?????????</a>', e += '<div class="jump">', e += '    <i class="jump-text">?????????</i>', e += '    <input type="text" value="' + a + '" class="jump-input">', e += '    <a href="javascript:void(0);" class="jump-btn">GO</a>', e += "</div>", e += "</div>", o.empty().html(e), o.find("a").addClass(n.hoverCls)
				}
			}, this.eventBind = function() {
				var e = this,
					i = e.getPageCount(),
					r = 1;
				o.off().on("click", "a", function() {
					if (t(this).hasClass("next")) {
						if (o.find(".active").text() >= i) return !1;
						r = parseInt(o.find(".active").text()) + 1
					} else if (t(this).hasClass("prev")) {
						if (o.find(".active").text() <= 1) return !1;
						r = parseInt(o.find(".active").text()) - 1
					} else if (t(this).hasClass("jump-btn")) {
						if ("" === o.find(".jump-input").val()) return;
						if (o.find(".jump-input").val() == a) return;
						r = parseInt(o.find(".jump-input").val())
					} else {
						if (t(this).hasClass("first") || t(this).hasClass("last")) return !1;
						r = parseInt(t(this).data("page"))
					}
					e.filling(r), "function" == typeof n.callback && n.callback(e)
				}), o.on("input propertychange", ".jump-input", function() {
					var e = t(this),
						n = e.val(),
						a = /[^\d]/g;
					a.test(n) && e.val(n.replace(a, "")), parseInt(n) > i && e.val(""), 0 === parseInt(n) && e.val("")
				}), s.keydown(function(t) {
					if (13 == t.keyCode && o.find(".jump-input").val()) {
						var i = parseInt(o.find(".jump-input").val());
						e.filling(i), "function" == typeof n.callback && n.callback(e)
					}
				})
			}, this.init = function() {
				this.filling(n.current), this.eventBind()
			}, this.init()
		};
	t.fn.pagination = function(n, a) {
		"function" == typeof n ? (a = n, n = {}) : (n = n || {}, a = a ||
		function() {});
		var s = t.extend({}, e, n);
		return this.each(function() {
			var t = new i(this, s);
			a(t)
		})
	}
}), function(t) {
	t.flexslider = function(e, i) {
		var n = t(e);
		n.vars = t.extend({}, t.flexslider.defaults, i);
		var a, s = n.vars.namespace,
			o = window.navigator && window.navigator.msPointerEnabled && window.MSGesture,
			r = ("ontouchstart" in window || o || window.DocumentTouch && document instanceof DocumentTouch) && n.vars.touch,
			l = "click touchend MSPointerUp",
			d = "",
			c = "vertical" === n.vars.direction,
			u = n.vars.reverse,
			h = n.vars.itemWidth > 0,
			p = "fade" === n.vars.animation,
			f = "" !== n.vars.asNavFor,
			g = {};
		t.data(e, "flexslider", n), g = {
			init: function() {
				n.animating = !1, n.currentSlide = parseInt(n.vars.startAt ? n.vars.startAt : 0), isNaN(n.currentSlide) && (n.currentSlide = 0), n.animatingTo = n.currentSlide, n.atEnd = 0 === n.currentSlide || n.currentSlide === n.last, n.containerSelector = n.vars.selector.substr(0, n.vars.selector.search(" ")), n.slides = t(n.vars.selector, n), n.container = t(n.containerSelector, n), n.count = n.slides.length, n.syncExists = t(n.vars.sync).length > 0, "slide" === n.vars.animation && (n.vars.animation = "swing"), n.prop = c ? "top" : "marginLeft", n.args = {}, n.manualPause = !1, n.stopped = !1, n.started = !1, n.startTimeout = null, n.transitions = !n.vars.video && !p && n.vars.useCSS &&
				function() {
					var t = document.createElement("div"),
						e = ["perspectiveProperty", "WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"];
					for (var i in e) if (void 0 !== t.style[e[i]]) return n.pfx = e[i].replace("Perspective", "").toLowerCase(), n.prop = "-" + n.pfx + "-transform", !0;
					return !1
				}(), "" !== n.vars.controlsContainer && (n.controlsContainer = t(n.vars.controlsContainer).length > 0 && t(n.vars.controlsContainer)), "" !== n.vars.manualControls && (n.manualControls = t(n.vars.manualControls).length > 0 && t(n.vars.manualControls)), n.vars.randomize && (n.slides.sort(function() {
					return Math.round(Math.random()) - .5
				}), n.container.empty().append(n.slides)), n.doMath(), n.setup("init"), n.vars.controlNav && g.controlNav.setup(), n.vars.directionNav && g.directionNav.setup(), n.vars.keyboard && (1 === t(n.containerSelector).length || n.vars.multipleKeyboard) && t(document).bind("keyup", function(t) {
					var e = t.keyCode;
					if (!n.animating && (39 === e || 37 === e)) {
						var i = 39 === e ? n.getTarget("next") : 37 === e && n.getTarget("prev");
						n.flexAnimate(i, n.vars.pauseOnAction)
					}
				}), n.vars.mousewheel && n.bind("mousewheel", function(t, e, i, a) {
					t.preventDefault();
					var s = e < 0 ? n.getTarget("next") : n.getTarget("prev");
					n.flexAnimate(s, n.vars.pauseOnAction)
				}), n.vars.pausePlay && g.pausePlay.setup(), n.vars.slideshow && n.vars.pauseInvisible && g.pauseInvisible.init(), n.vars.slideshow && (n.vars.pauseOnHover && n.hover(function() {
					!n.manualPlay && !n.manualPause && n.pause()
				}, function() {
					!n.manualPause && !n.manualPlay && !n.stopped && n.play()
				}), n.vars.pauseInvisible && g.pauseInvisible.isHidden() || (n.vars.initDelay > 0 ? n.startTimeout = setTimeout(n.play, n.vars.initDelay) : n.play())), f && g.asNav.setup(), r && n.vars.touch && g.touch(), (!p || p && n.vars.smoothHeight) && t(window).bind("resize orientationchange focus", g.resize), n.find("img").attr("draggable", "false"), setTimeout(function() {
					n.vars.start(n)
				}, 200)
			},
			asNav: {
				setup: function() {
					n.asNav = !0, n.animatingTo = Math.floor(n.currentSlide / n.move), n.currentItem = n.currentSlide, n.slides.removeClass(s + "active-slide").eq(n.currentItem).addClass(s + "active-slide"), o ? (e._slider = n, n.slides.each(function() {
						var e = this;
						e._gesture = new MSGesture, e._gesture.target = e, e.addEventListener("MSPointerDown", function(t) {
							t.preventDefault(), t.currentTarget._gesture && t.currentTarget._gesture.addPointer(t.pointerId)
						}, !1), e.addEventListener("MSGestureTap", function(e) {
							e.preventDefault();
							var i = t(this),
								a = i.index();
							t(n.vars.asNavFor).data("flexslider").animating || i.hasClass("active") || (n.direction = n.currentItem < a ? "next" : "prev", n.flexAnimate(a, n.vars.pauseOnAction, !1, !0, !0))
						})
					})) : n.slides.click(function(e) {
						e.preventDefault();
						var i = t(this),
							a = i.index();
						i.offset().left - t(n).scrollLeft() <= 0 && i.hasClass(s + "active-slide") ? n.flexAnimate(n.getTarget("prev"), !0) : t(n.vars.asNavFor).data("flexslider").animating || i.hasClass(s + "active-slide") || (n.direction = n.currentItem < a ? "next" : "prev", n.flexAnimate(a, n.vars.pauseOnAction, !1, !0, !0))
					})
				}
			},
			controlNav: {
				setup: function() {
					n.manualControls ? g.controlNav.setupManual() : g.controlNav.setupPaging()
				},
				setupPaging: function() {
					var e, i, a = "thumbnails" === n.vars.controlNav ? "control-thumbs" : "control-paging",
						o = 1;
					if (n.controlNavScaffold = t('<ol class="' + s + "control-nav " + s + a + '"></ol>'), n.pagingCount > 1) for (var r = 0; r < n.pagingCount; r++) {
						if (i = n.slides.eq(r), e = "thumbnails" === n.vars.controlNav ? '<img src="' + i.attr("data-thumb") + '"/>' : "<a>" + o + "</a>", "thumbnails" === n.vars.controlNav && !0 === n.vars.thumbCaptions) {
							var c = i.attr("data-thumbcaption");
							"" != c && void 0 != c && (e += '<span class="' + s + 'caption">' + c + "</span>")
						}
						n.controlNavScaffold.append("<li>" + e + "</li>"), o++
					}
					n.controlsContainer ? t(n.controlsContainer).append(n.controlNavScaffold) : n.append(n.controlNavScaffold), g.controlNav.set(), g.controlNav.active(), n.controlNavScaffold.delegate("a, img", l, function(e) {
						if (e.preventDefault(), "" === d || d === e.type) {
							var i = t(this),
								a = n.controlNav.index(i);
							i.hasClass(s + "active") || (n.direction = a > n.currentSlide ? "next" : "prev", n.flexAnimate(a, n.vars.pauseOnAction))
						}
						"" === d && (d = e.type), g.setToClearWatchedEvent()
					})
				},
				setupManual: function() {
					n.controlNav = n.manualControls, g.controlNav.active(), n.controlNav.bind(l, function(e) {
						if (e.preventDefault(), "" === d || d === e.type) {
							var i = t(this),
								a = n.controlNav.index(i);
							i.hasClass(s + "active") || (a > n.currentSlide ? n.direction = "next" : n.direction = "prev", n.flexAnimate(a, n.vars.pauseOnAction))
						}
						"" === d && (d = e.type), g.setToClearWatchedEvent()
					})
				},
				set: function() {
					var e = "thumbnails" === n.vars.controlNav ? "img" : "a";
					n.controlNav = t("." + s + "control-nav li " + e, n.controlsContainer ? n.controlsContainer : n)
				},
				active: function() {
					n.controlNav.removeClass(s + "active").eq(n.animatingTo).addClass(s + "active")
				},
				update: function(e, i) {
					n.pagingCount > 1 && "add" === e ? n.controlNavScaffold.append(t("<li><a>" + n.count + "</a></li>")) : 1 === n.pagingCount ? n.controlNavScaffold.find("li").remove() : n.controlNav.eq(i).closest("li").remove(), g.controlNav.set(), n.pagingCount > 1 && n.pagingCount !== n.controlNav.length ? n.update(i, e) : g.controlNav.active()
				}
			},
			directionNav: {
				setup: function() {
					var e = t('<ul class="' + s + 'direction-nav"><li><a class="' + s + 'prev" href="#">' + n.vars.prevText + '</a></li><li><a class="' + s + 'next" href="#">' + n.vars.nextText + "</a></li></ul>");
					n.controlsContainer ? (t(n.controlsContainer).append(e), n.directionNav = t("." + s + "direction-nav li a", n.controlsContainer)) : (n.append(e), n.directionNav = t("." + s + "direction-nav li a", n)), g.directionNav.update(), n.directionNav.bind(l, function(e) {
						e.preventDefault();
						var i;
						"" !== d && d !== e.type || (i = t(this).hasClass(s + "next") ? n.getTarget("next") : n.getTarget("prev"), n.flexAnimate(i, n.vars.pauseOnAction)), "" === d && (d = e.type), g.setToClearWatchedEvent()
					})
				},
				update: function() {
					var t = s + "disabled";
					1 === n.pagingCount ? n.directionNav.addClass(t).attr("tabindex", "-1") : n.vars.animationLoop ? n.directionNav.removeClass(t).removeAttr("tabindex") : 0 === n.animatingTo ? n.directionNav.removeClass(t).filter("." + s + "prev").addClass(t).attr("tabindex", "-1") : n.animatingTo === n.last ? n.directionNav.removeClass(t).filter("." + s + "next").addClass(t).attr("tabindex", "-1") : n.directionNav.removeClass(t).removeAttr("tabindex")
				}
			},
			pausePlay: {
				setup: function() {
					var e = t('<div class="' + s + 'pauseplay"><a></a></div>');
					n.controlsContainer ? (n.controlsContainer.append(e), n.pausePlay = t("." + s + "pauseplay a", n.controlsContainer)) : (n.append(e), n.pausePlay = t("." + s + "pauseplay a", n)), g.pausePlay.update(n.vars.slideshow ? s + "pause" : s + "play"), n.pausePlay.bind(l, function(e) {
						e.preventDefault(), "" !== d && d !== e.type || (t(this).hasClass(s + "pause") ? (n.manualPause = !0, n.manualPlay = !1, n.pause()) : (n.manualPause = !1, n.manualPlay = !0, n.play())), "" === d && (d = e.type), g.setToClearWatchedEvent()
					})
				},
				update: function(t) {
					"play" === t ? n.pausePlay.removeClass(s + "pause").addClass(s + "play").html(n.vars.playText) : n.pausePlay.removeClass(s + "play").addClass(s + "pause").html(n.vars.pauseText)
				}
			},
			touch: function() {
				function t(t) {
					n.animating ? t.preventDefault() : (window.navigator.msPointerEnabled || 1 === t.touches.length) && (n.pause(), v = c ? n.h : n.w, y = Number(new Date), x = t.touches[0].pageX, w = t.touches[0].pageY, g = h && u && n.animatingTo === n.last ? 0 : h && u ? n.limit - (n.itemW + n.vars.itemMargin) * n.move * n.animatingTo : h && n.currentSlide === n.last ? n.limit : h ? (n.itemW + n.vars.itemMargin) * n.move * n.currentSlide : u ? (n.last - n.currentSlide + n.cloneOffset) * v : (n.currentSlide + n.cloneOffset) * v, d = c ? w : x, f = c ? x : w, e.addEventListener("touchmove", i, !1), e.addEventListener("touchend", a, !1))
				}
				function i(t) {
					x = t.touches[0].pageX, w = t.touches[0].pageY, m = c ? d - w : d - x, b = c ? Math.abs(m) < Math.abs(x - f) : Math.abs(m) < Math.abs(w - f), (!b || Number(new Date) - y > 500) && (t.preventDefault(), !p && n.transitions && (n.vars.animationLoop || (m /= 0 === n.currentSlide && m < 0 || n.currentSlide === n.last && m > 0 ? Math.abs(m) / v + 2 : 1), n.setProps(g + m, "setTouch")))
				}
				function a(t) {
					if (e.removeEventListener("touchmove", i, !1), n.animatingTo === n.currentSlide && !b && null !== m) {
						var s = u ? -m : m,
							o = s > 0 ? n.getTarget("next") : n.getTarget("prev");
						n.canAdvance(o) && (Number(new Date) - y < 550 && Math.abs(s) > 50 || Math.abs(s) > v / 2) ? n.flexAnimate(o, n.vars.pauseOnAction) : p || n.flexAnimate(n.currentSlide, n.vars.pauseOnAction, !0)
					}
					e.removeEventListener("touchend", a, !1), d = null, f = null, m = null, g = null
				}
				function s(t) {
					t.stopPropagation(), n.animating ? t.preventDefault() : (n.pause(), e._gesture.addPointer(t.pointerId), S = 0, v = c ? n.h : n.w, y = Number(new Date), g = h && u && n.animatingTo === n.last ? 0 : h && u ? n.limit - (n.itemW + n.vars.itemMargin) * n.move * n.animatingTo : h && n.currentSlide === n.last ? n.limit : h ? (n.itemW + n.vars.itemMargin) * n.move * n.currentSlide : u ? (n.last - n.currentSlide + n.cloneOffset) * v : (n.currentSlide + n.cloneOffset) * v)
				}
				function r(t) {
					t.stopPropagation();
					var i = t.target._slider;
					if (i) {
						var n = -t.translationX,
							a = -t.translationY;
						if (S += c ? a : n, m = S, b = c ? Math.abs(S) < Math.abs(-n) : Math.abs(S) < Math.abs(-a), t.detail === t.MSGESTURE_FLAG_INERTIA) return void setImmediate(function() {
							e._gesture.stop()
						});
						(!b || Number(new Date) - y > 500) && (t.preventDefault(), !p && i.transitions && (i.vars.animationLoop || (m = S / (0 === i.currentSlide && S < 0 || i.currentSlide === i.last && S > 0 ? Math.abs(S) / v + 2 : 1)), i.setProps(g + m, "setTouch")))
					}
				}
				function l(t) {
					t.stopPropagation();
					var e = t.target._slider;
					if (e) {
						if (e.animatingTo === e.currentSlide && !b && null !== m) {
							var i = u ? -m : m,
								n = i > 0 ? e.getTarget("next") : e.getTarget("prev");
							e.canAdvance(n) && (Number(new Date) - y < 550 && Math.abs(i) > 50 || Math.abs(i) > v / 2) ? e.flexAnimate(n, e.vars.pauseOnAction) : p || e.flexAnimate(e.currentSlide, e.vars.pauseOnAction, !0)
						}
						d = null, f = null, m = null, g = null, S = 0
					}
				}
				var d, f, g, v, m, y, b = !1,
					x = 0,
					w = 0,
					S = 0;
				o ? (e.style.msTouchAction = "none", e._gesture = new MSGesture, e._gesture.target = e, e.addEventListener("MSPointerDown", s, !1), e._slider = n, e.addEventListener("MSGestureChange", r, !1), e.addEventListener("MSGestureEnd", l, !1)) : e.addEventListener("touchstart", t, !1)
			},
			resize: function() {
				!n.animating && n.is(":visible") && (h || n.doMath(), p ? g.smoothHeight() : h ? (n.slides.width(n.computedW), n.update(n.pagingCount), n.setProps()) : c ? (n.viewport.height(n.h), n.setProps(n.h, "setTotal")) : (n.vars.smoothHeight && g.smoothHeight(), n.newSlides.width(n.computedW), n.setProps(n.computedW, "setTotal")))
			},
			smoothHeight: function(t) {
				if (!c || p) {
					var e = p ? n : n.viewport;
					t ? e.animate({
						height: n.slides.eq(n.animatingTo).height()
					}, t) : e.height(n.slides.eq(n.animatingTo).height())
				}
			},
			sync: function(e) {
				var i = t(n.vars.sync).data("flexslider"),
					a = n.animatingTo;
				switch (e) {
				case "animate":
					i.flexAnimate(a, n.vars.pauseOnAction, !1, !0);
					break;
				case "play":
					!i.playing && !i.asNav && i.play();
					break;
				case "pause":
					i.pause()
				}
			},
			pauseInvisible: {
				visProp: null,
				init: function() {
					var t = ["webkit", "moz", "ms", "o"];
					if ("hidden" in document) return "hidden";
					for (var e = 0; e < t.length; e++) t[e] + "Hidden" in document && (g.pauseInvisible.visProp = t[e] + "Hidden");
					if (g.pauseInvisible.visProp) {
						var i = g.pauseInvisible.visProp.replace(/[H|h]idden/, "") + "visibilitychange";
						document.addEventListener(i, function() {
							g.pauseInvisible.isHidden() ? n.startTimeout ? clearTimeout(n.startTimeout) : n.pause() : n.started ? n.play() : n.vars.initDelay > 0 ? setTimeout(n.play, n.vars.initDelay) : n.play()
						})
					}
				},
				isHidden: function() {
					return document[g.pauseInvisible.visProp] || !1
				}
			},
			setToClearWatchedEvent: function() {
				clearTimeout(a), a = setTimeout(function() {
					d = ""
				}, 3e3)
			}
		}, n.flexAnimate = function(e, i, a, o, l) {
			if (!n.vars.animationLoop && e !== n.currentSlide && (n.direction = e > n.currentSlide ? "next" : "prev"), f && 1 === n.pagingCount && (n.direction = n.currentItem < e ? "next" : "prev"), !n.animating && (n.canAdvance(e, l) || a) && n.is(":visible")) {
				if (f && o) {
					var d = t(n.vars.asNavFor).data("flexslider");
					if (n.atEnd = 0 === e || e === n.count - 1, d.flexAnimate(e, !0, !1, !0, l), n.direction = n.currentItem < e ? "next" : "prev", d.direction = n.direction, Math.ceil((e + 1) / n.visible) - 1 === n.currentSlide || 0 === e) return n.currentItem = e, n.slides.removeClass(s + "active-slide").eq(e).addClass(s + "active-slide"), !1;
					n.currentItem = e, n.slides.removeClass(s + "active-slide").eq(e).addClass(s + "active-slide"), e = Math.floor(e / n.visible)
				}
				if (n.animating = !0, n.animatingTo = e, i && n.pause(), n.vars.before(n), n.syncExists && !l && g.sync("animate"), n.vars.controlNav && g.controlNav.active(), h || n.slides.removeClass(s + "active-slide").eq(e).addClass(s + "active-slide"), n.atEnd = 0 === e || e === n.last, n.vars.directionNav && g.directionNav.update(), e === n.last && (n.vars.end(n), n.vars.animationLoop || n.pause()), p) r ? (n.slides.eq(n.currentSlide).css({
					opacity: 0,
					zIndex: 1
				}), n.slides.eq(e).css({
					opacity: 1,
					zIndex: 2
				}), n.wrapup(b)) : (n.slides.eq(n.currentSlide).css({
					zIndex: 1
				}).animate({
					opacity: 0
				}, n.vars.animationSpeed, n.vars.easing), n.slides.eq(e).css({
					zIndex: 2
				}).animate({
					opacity: 1
				}, n.vars.animationSpeed, n.vars.easing, n.wrapup));
				else {
					var v, m, y, b = c ? n.slides.filter(":first").height() : n.computedW;
					h ? (v = n.vars.itemMargin, y = (n.itemW + v) * n.move * n.animatingTo, m = y > n.limit && 1 !== n.visible ? n.limit : y) : m = 0 === n.currentSlide && e === n.count - 1 && n.vars.animationLoop && "next" !== n.direction ? u ? (n.count + n.cloneOffset) * b : 0 : n.currentSlide === n.last && 0 === e && n.vars.animationLoop && "prev" !== n.direction ? u ? 0 : (n.count + 1) * b : u ? (n.count - 1 - e + n.cloneOffset) * b : (e + n.cloneOffset) * b, n.setProps(m, "", n.vars.animationSpeed), n.transitions ? (n.vars.animationLoop && n.atEnd || (n.animating = !1, n.currentSlide = n.animatingTo), n.container.unbind("webkitTransitionEnd transitionend"), n.container.bind("webkitTransitionEnd transitionend", function() {
						n.wrapup(b)
					})) : n.container.animate(n.args, n.vars.animationSpeed, n.vars.easing, function() {
						n.wrapup(b)
					})
				}
				n.vars.smoothHeight && g.smoothHeight(n.vars.animationSpeed)
			}
		}, n.wrapup = function(t) {
			!p && !h && (0 === n.currentSlide && n.animatingTo === n.last && n.vars.animationLoop ? n.setProps(t, "jumpEnd") : n.currentSlide === n.last && 0 === n.animatingTo && n.vars.animationLoop && n.setProps(t, "jumpStart")), n.animating = !1, n.currentSlide = n.animatingTo, n.vars.after(n)
		}, n.animateSlides = function() {
			!n.animating && !0 && n.flexAnimate(n.getTarget("next"))
		}, n.pause = function() {
			clearInterval(n.animatedSlides), n.animatedSlides = null, n.playing = !1, n.vars.pausePlay && g.pausePlay.update("play"), n.syncExists && g.sync("pause")
		}, n.play = function() {
			n.playing && clearInterval(n.animatedSlides), n.animatedSlides = n.animatedSlides || setInterval(n.animateSlides, n.vars.slideshowSpeed), n.started = n.playing = !0, n.vars.pausePlay && g.pausePlay.update("pause"), n.syncExists && g.sync("play")
		}, n.stop = function() {
			n.pause(), n.stopped = !0
		}, n.canAdvance = function(t, e) {
			var i = f ? n.pagingCount - 1 : n.last;
			return !(!e && (!f || n.currentItem !== n.count - 1 || 0 !== t || "prev" !== n.direction) && (f && 0 === n.currentItem && t === n.pagingCount - 1 && "next" !== n.direction || t === n.currentSlide && !f || !n.vars.animationLoop && (n.atEnd && 0 === n.currentSlide && t === i && "next" !== n.direction || n.atEnd && n.currentSlide === i && 0 === t && "next" === n.direction)))
		}, n.getTarget = function(t) {
			return n.direction = t, "next" === t ? n.currentSlide === n.last ? 0 : n.currentSlide + 1 : 0 === n.currentSlide ? n.last : n.currentSlide - 1
		}, n.setProps = function(t, e, i) {
			var a = function() {
					var i = t || (n.itemW + n.vars.itemMargin) * n.move * n.animatingTo;
					return -1 *
					function() {
						if (h) return "setTouch" === e ? t : u && n.animatingTo === n.last ? 0 : u ? n.limit - (n.itemW + n.vars.itemMargin) * n.move * n.animatingTo : n.animatingTo === n.last ? n.limit : i;
						switch (e) {
						case "setTotal":
							return u ? (n.count - 1 - n.currentSlide + n.cloneOffset) * t : (n.currentSlide + n.cloneOffset) * t;
						case "setTouch":
							return t;
						case "jumpEnd":
							return u ? t : n.count * t;
						case "jumpStart":
							return u ? n.count * t : t;
						default:
							return t
						}
					}() + "px"
				}();
			n.transitions && (a = c ? "translate3d(0," + a + ",0)" : "translate3d(" + a + ",0,0)", i = void 0 !== i ? i / 1e3 + "s" : "0s", n.container.css("-" + n.pfx + "-transition-duration", i)), n.args[n.prop] = a, (n.transitions || void 0 === i) && n.container.css(n.args)
		}, n.setup = function(e) {
			if (p) n.slides.css({
				width: "100%",
				float: "left",
				marginRight: "-100%",
				position: "relative"
			}), "init" === e && (r ? n.slides.css({
				opacity: 0,
				display: "block",
				webkitTransition: "opacity " + n.vars.animationSpeed / 1e3 + "s ease",
				zIndex: 1
			}).eq(n.currentSlide).css({
				opacity: 1,
				zIndex: 2
			}) : n.slides.css({
				opacity: 0,
				display: "block",
				zIndex: 1
			}).eq(n.currentSlide).css({
				zIndex: 2
			}).animate({
				opacity: 1
			}, n.vars.animationSpeed, n.vars.easing)), n.vars.smoothHeight && g.smoothHeight();
			else {
				var i, a;
				"init" === e && (n.viewport = t('<div class="' + s + 'viewport"></div>').css({
					overflow: "hidden",
					position: "relative"
				}).appendTo(n).append(n.container), n.cloneCount = 0, n.cloneOffset = 0, u && (a = t.makeArray(n.slides).reverse(), n.slides = t(a), n.container.empty().append(n.slides))), n.vars.animationLoop && !h && (n.cloneCount = 2, n.cloneOffset = 1, "init" !== e && n.container.find(".clone").remove(), n.container.append(n.slides.first().clone().addClass("clone").attr("aria-hidden", "true")).prepend(n.slides.last().clone().addClass("clone").attr("aria-hidden", "true"))), n.newSlides = t(n.vars.selector, n), i = u ? n.count - 1 - n.currentSlide + n.cloneOffset : n.currentSlide + n.cloneOffset, c && !h ? (n.container.height(200 * (n.count + n.cloneCount) + "%").css("position", "absolute").width("100%"), setTimeout(function() {
					n.newSlides.css({
						display: "block"
					}), n.doMath(), n.viewport.height(n.h), n.setProps(i * n.h, "init")
				}, "init" === e ? 100 : 0)) : (n.container.width(200 * (n.count + n.cloneCount) + "%"), n.setProps(i * n.computedW, "init"), setTimeout(function() {
					n.doMath(), n.newSlides.css({
						width: n.computedW,
						float: "left",
						display: "block"
					}), n.vars.smoothHeight && g.smoothHeight()
				}, "init" === e ? 100 : 0))
			}
			h || n.slides.removeClass(s + "active-slide").eq(n.currentSlide).addClass(s + "active-slide")
		}, n.doMath = function() {
			var t = n.slides.first(),
				e = n.vars.itemMargin,
				i = n.vars.minItems,
				a = n.vars.maxItems;
			n.w = void 0 === n.viewport ? n.width() : n.viewport.width(), n.h = t.height(), n.boxPadding = t.outerWidth() - t.width(), h ? (n.itemT = n.vars.itemWidth + e, n.minW = i ? i * n.itemT : n.w, n.maxW = a ? a * n.itemT - e : n.w, n.itemW = n.minW > n.w ? (n.w - e * (i - 1)) / i : n.maxW < n.w ? (n.w - e * (a - 1)) / a : n.vars.itemWidth > n.w ? n.w : n.vars.itemWidth, n.visible = Math.floor(n.w / n.itemW), n.move = n.vars.move > 0 && n.vars.move < n.visible ? n.vars.move : n.visible, n.pagingCount = Math.ceil((n.count - n.visible) / n.move + 1), n.last = n.pagingCount - 1, n.limit = 1 === n.pagingCount ? 0 : n.vars.itemWidth > n.w ? n.itemW * (n.count - 1) + e * (n.count - 1) : (n.itemW + e) * n.count - n.w - e) : (n.itemW = n.w, n.pagingCount = n.count, n.last = n.count - 1), n.computedW = n.itemW - n.boxPadding
		}, n.update = function(t, e) {
			n.doMath(), h || (t < n.currentSlide ? n.currentSlide += 1 : t <= n.currentSlide && 0 !== t && (n.currentSlide -= 1), n.animatingTo = n.currentSlide), n.vars.controlNav && !n.manualControls && ("add" === e && !h || n.pagingCount > n.controlNav.length ? g.controlNav.update("add") : ("remove" === e && !h || n.pagingCount < n.controlNav.length) && (h && n.currentSlide > n.last && (n.currentSlide -= 1, n.animatingTo -= 1), g.controlNav.update("remove", n.last))), n.vars.directionNav && g.directionNav.update()
		}, n.addSlide = function(e, i) {
			var a = t(e);
			n.count += 1, n.last = n.count - 1, c && u ? void 0 !== i ? n.slides.eq(n.count - i).after(a) : n.container.prepend(a) : void 0 !== i ? n.slides.eq(i).before(a) : n.container.append(a), n.update(i, "add"), n.slides = t(n.vars.selector + ":not(.clone)", n), n.setup(), n.vars.added(n)
		}, n.removeSlide = function(e) {
			var i = isNaN(e) ? n.slides.index(t(e)) : e;
			n.count -= 1, n.last = n.count - 1, isNaN(e) ? t(e, n.slides).remove() : c && u ? n.slides.eq(n.last).remove() : n.slides.eq(e).remove(), n.doMath(), n.update(i, "remove"), n.slides = t(n.vars.selector + ":not(.clone)", n), n.setup(), n.vars.removed(n)
		}, g.init()
	}, t(window).blur(function(t) {
		focused = !1
	}).focus(function(t) {
		focused = !0
	}), t.flexslider.defaults = {
		namespace: "flex-",
		selector: ".slides > li",
		animation: "fade",
		easing: "swing",
		direction: "horizontal",
		reverse: !1,
		animationLoop: !0,
		smoothHeight: !1,
		startAt: 0,
		slideshow: !0,
		slideshowSpeed: 7e3,
		animationSpeed: 600,
		initDelay: 0,
		randomize: !1,
		thumbCaptions: !1,
		pauseOnAction: !0,
		pauseOnHover: !1,
		pauseInvisible: !0,
		useCSS: !0,
		touch: !0,
		video: !1,
		controlNav: !0,
		directionNav: !0,
		prevText: "",
		nextText: "",
		keyboard: !0,
		multipleKeyboard: !1,
		mousewheel: !1,
		pausePlay: !1,
		pauseText: "Pause",
		playText: "Play",
		controlsContainer: "",
		manualControls: "",
		sync: "",
		asNavFor: "",
		itemWidth: 0,
		itemMargin: 0,
		minItems: 1,
		maxItems: 0,
		move: 0,
		allowOneSlide: !0,
		start: function() {},
		before: function() {},
		after: function() {},
		end: function() {},
		added: function() {},
		removed: function() {}
	}, t.fn.flexslider = function(e) {
		if (void 0 === e && (e = {}), "object" == typeof e) return this.each(function() {
			var i = t(this),
				n = e.selector ? e.selector : ".slides > li",
				a = i.find(n);
			1 === a.length && !0 === e.allowOneSlide || 0 === a.length ? (a.fadeIn(400), e.start && e.start(i)) : void 0 === i.data("flexslider") && new t.flexslider(this, e)
		});
		var i = t(this).data("flexslider");
		switch (e) {
		case "play":
			i.play();
			break;
		case "pause":
			i.pause();
			break;
		case "stop":
			i.stop();
			break;
		case "next":
			i.flexAnimate(i.getTarget("next"), !0);
			break;
		case "prev":
		case "previous":
			i.flexAnimate(i.getTarget("prev"), !0);
			break;
		default:
			"number" == typeof e && i.flexAnimate(e, !0)
		}
	}
}(jQuery), function(t, e, i, n) {
	var a = t(e);
	t.fn.lazyload = function(n) {
		function s() {
			var e = 0;
			r.each(function() {
				var i = t(this);
				if (!l.skip_invisible || i.is(":visible")) if (t.abovethetop(this, l) || t.leftofbegin(this, l));
				else if (t.belowthefold(this, l) || t.rightoffold(this, l)) {
					if (++e > l.failure_limit) return !1
				} else i.trigger("appear"), e = 0
			})
		}
		var o, r = this,
			l = {
				threshold: 0,
				failure_limit: 0,
				event: "scroll",
				effect: "show",
				container: e,
				data_attribute: "original",
				skip_invisible: !0,
				appear: null,
				load: null,
				placeholder: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
			};
		return n && (void 0 !== n.failurelimit && (n.failure_limit = n.failurelimit, delete n.failurelimit), void 0 !== n.effectspeed && (n.effect_speed = n.effectspeed, delete n.effectspeed), t.extend(l, n)), o = void 0 === l.container || l.container === e ? a : t(l.container), 0 === l.event.indexOf("scroll") && o.bind(l.event, function() {
			return s()
		}), this.each(function() {
			var e = this,
				i = t(e);
			e.loaded = !1, void 0 !== i.attr("src") && !1 !== i.attr("src") || i.is("img") && i.attr("src", l.placeholder), i.one("appear", function() {
				if (!this.loaded) {
					if (l.appear) {
						var n = r.length;
						l.appear.call(e, n, l)
					}
					t("<img />").bind("load", function() {
						var n = i.attr("data-" + l.data_attribute);
						i.is("img") ? i.attr("src", n) : i.css("background-image", "url('" + n + "')"), i[l.effect](l.effect_speed), e.loaded = !0;
						var a = t.grep(r, function(t) {
							return !t.loaded
						});
						if (r = t(a), l.load) {
							var s = r.length;
							l.load.call(e, s, l)
						}
					}).attr("src", i.attr("data-" + l.data_attribute))
				}
			}), 0 !== l.event.indexOf("scroll") && i.bind(l.event, function() {
				e.loaded || i.trigger("appear")
			})
		}), a.bind("resize", function() {
			s()
		}), /(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion) && a.bind("pageshow", function(e) {
			e.originalEvent && e.originalEvent.persisted && r.each(function() {
				t(this).trigger("appear")
			})
		}), t(i).ready(function() {
			s()
		}), this
	}, t.belowthefold = function(i, n) {
		return (void 0 === n.container || n.container === e ? (e.innerHeight ? e.innerHeight : a.height()) + a.scrollTop() : t(n.container).offset().top + t(n.container).height()) <= t(i).offset().top - n.threshold
	}, t.rightoffold = function(i, n) {
		return (void 0 === n.container || n.container === e ? a.width() + a.scrollLeft() : t(n.container).offset().left + t(n.container).width()) <= t(i).offset().left - n.threshold
	}, t.abovethetop = function(i, n) {
		return (void 0 === n.container || n.container === e ? a.scrollTop() : t(n.container).offset().top) >= t(i).offset().top + n.threshold + t(i).height()
	}, t.leftofbegin = function(i, n) {
		return (void 0 === n.container || n.container === e ? a.scrollLeft() : t(n.container).offset().left) >= t(i).offset().left + n.threshold + t(i).width()
	}, t.inviewport = function(e, i) {
		return !(t.rightoffold(e, i) || t.leftofbegin(e, i) || t.belowthefold(e, i) || t.abovethetop(e, i))
	}, t.extend(t.expr[":"], {
		"below-the-fold": function(e) {
			return t.belowthefold(e, {
				threshold: 0
			})
		},
		"above-the-top": function(e) {
			return !t.belowthefold(e, {
				threshold: 0
			})
		},
		"right-of-screen": function(e) {
			return t.rightoffold(e, {
				threshold: 0
			})
		},
		"left-of-screen": function(e) {
			return !t.rightoffold(e, {
				threshold: 0
			})
		},
		"in-viewport": function(e) {
			return t.inviewport(e, {
				threshold: 0
			})
		},
		"above-the-fold": function(e) {
			return !t.belowthefold(e, {
				threshold: 0
			})
		},
		"right-of-fold": function(e) {
			return t.rightoffold(e, {
				threshold: 0
			})
		},
		"left-of-fold": function(e) {
			return !t.rightoffold(e, {
				threshold: 0
			})
		}
	})
}(jQuery, window, document), function(t) {
	"use strict";
	var e, i, n;
	t.extend({
		roundaboutShapes: {
			def: "lazySusan",
			lazySusan: function(t, e, i) {
				return {
					x: Math.sin(t + e),
					y: Math.sin(t + 3 * Math.PI / 2 + e) / 8 * i,
					z: (Math.cos(t + e) + 1) / 2,
					scale: Math.sin(t + Math.PI / 2 + e) / 2 + .5
				}
			}
		}
	}), e = {
		bearing: 0,
		tilt: 0,
		minZ: 100,
		maxZ: 280,
		minOpacity: .4,
		maxOpacity: 1,
		minScale: .4,
		maxScale: 1,
		duration: 600,
		btnNext: null,
		btnNextCallback: function() {},
		btnPrev: null,
		btnPrevCallback: function() {},
		btnToggleAutoplay: null,
		btnStartAutoplay: null,
		btnStopAutoplay: null,
		easing: "swing",
		clickToFocus: !0,
		clickToFocusCallback: function() {},
		focusBearing: 0,
		shape: "lazySusan",
		debug: !1,
		childSelector: "li",
		startingChild: null,
		reflect: !1,
		floatComparisonThreshold: .001,
		autoplay: !1,
		autoplayDuration: 1e3,
		autoplayPauseOnHover: !1,
		autoplayCallback: function() {},
		enableDrag: !1,
		dropDuration: 600,
		dropEasing: "swing",
		dropAnimateTo: "nearest",
		dropCallback: function() {},
		dragAxis: "x",
		dragFactor: 4,
		triggerFocusEvents: !0,
		triggerBlurEvents: !0,
		responsive: !1
	}, i = {
		autoplayInterval: null,
		autoplayIsRunning: !1,
		animating: !1,
		childInFocus: -1,
		touchMoveStartPosition: null,
		stopAnimation: !1,
		lastAnimationStep: !1
	}, n = {
		init: function(a, s, o) {
			var r;
			return (new Date).getTime(), a = "object" == typeof a ? a : {}, s = t.isFunction(s) ? s : function() {}, s = t.isFunction(a) ? a : s, r = t.extend({}, e, a, i), this.each(function() {
				var e = t(this),
					i = e.children(r.childSelector).length,
					a = 360 / i,
					l = r.startingChild && r.startingChild > i - 1 ? i - 1 : r.startingChild,
					d = null === r.startingChild ? r.bearing : 360 - l * a,
					c = "static" !== e.css("position") ? e.css("position") : "relative";
				e.css({
					padding: 0,
					position: c
				}).addClass("roundabout-holder").data("roundabout", t.extend({}, r, {
					startingChild: l,
					bearing: d,
					oppositeOfFocusBearing: n.normalize.apply(null, [r.focusBearing - 180]),
					dragBearing: d,
					period: a
				})), o || (r.clickToFocus && e.children(r.childSelector).each(function(i) {
					t(this).bind("click.roundabout", function() {
						var a = n.getPlacement.apply(e, [i]);
						if (!n.isInFocus.apply(e, [a])) return n.stopAnimation.apply(t(this)), e.data("roundabout").animating || n.animateBearingToFocus.apply(e, [a, e.data("roundabout").clickToFocusCallback]), !1
					})
				}), r.btnNext && t(r.btnNext).bind("click.roundabout", function() {
					return e.data("roundabout").animating || n.animateToNextChild.apply(e, [e.data("roundabout").btnNextCallback]), !1
				}), r.btnPrev && t(r.btnPrev).bind("click.roundabout", function() {
					return n.animateToPreviousChild.apply(e, [e.data("roundabout").btnPrevCallback]), !1
				}), r.btnToggleAutoplay && t(r.btnToggleAutoplay).bind("click.roundabout", function() {
					return n.toggleAutoplay.apply(e), !1
				}), r.btnStartAutoplay && t(r.btnStartAutoplay).bind("click.roundabout", function() {
					return n.startAutoplay.apply(e), !1
				}), r.btnStopAutoplay && t(r.btnStopAutoplay).bind("click.roundabout", function() {
					return n.stopAutoplay.apply(e), !1
				}), r.autoplayPauseOnHover && e.bind("mouseenter.roundabout.autoplay", function() {
					n.stopAutoplay.apply(e, [!0])
				}).bind("mouseleave.roundabout.autoplay", function() {
					n.startAutoplay.apply(e)
				}), r.enableDrag && (t.isFunction(e.drag) ? t.isFunction(e.drop) ? e.drag(function(t, i) {
					var a = e.data("roundabout"),
						s = "x" === a.dragAxis.toLowerCase() ? "deltaX" : "deltaY";
					n.stopAnimation.apply(e), n.setBearing.apply(e, [a.dragBearing + i[s] / a.dragFactor])
				}).drop(function(t) {
					var i = e.data("roundabout"),
						a = n.getAnimateToMethod(i.dropAnimateTo);
					n.allowAnimation.apply(e), n[a].apply(e, [i.dropDuration, i.dropEasing, i.dropCallback]), i.dragBearing = i.period * n.getNearestChild.apply(e)
				}) : r.debug && alert("You do not have the drop plugin loaded.") : r.debug && alert("You do not have the drag plugin loaded."), e.each(function() {
					var e = t(this).get(0),
						i = t(this).data("roundabout"),
						a = "x" === i.dragAxis.toLowerCase() ? "pageX" : "pageY",
						s = n.getAnimateToMethod(i.dropAnimateTo);
					e.addEventListener && (e.addEventListener("touchstart", function(t) {
						i.touchMoveStartPosition = t.touches[0][a]
					}, !1), e.addEventListener("touchmove", function(e) {
						var s = (e.touches[0][a] - i.touchMoveStartPosition) / i.dragFactor;
						e.preventDefault(), n.stopAnimation.apply(t(this)), n.setBearing.apply(t(this), [i.dragBearing + s])
					}, !1), e.addEventListener("touchend", function(e) {
						e.preventDefault(), n.allowAnimation.apply(t(this)), s = n.getAnimateToMethod(i.dropAnimateTo), n[s].apply(t(this), [i.dropDuration, i.dropEasing, i.dropCallback]), i.dragBearing = i.period * n.getNearestChild.apply(t(this))
					}, !1))
				})), r.responsive && t(window).resize(function() {
					n.relayoutChildren.apply(e)
				})), n.initChildren.apply(e, [s, o])
			})
		},
		initChildren: function(e, i) {
			var a = t(this),
				s = a.data("roundabout");
			return e = e ||
			function() {}, a.children(s.childSelector).each(function(e) {
				var s, o, r, l = n.getPlacement.apply(a, [e]);
				i && (s = t(this).data("roundabout").startWidth, o = t(this).data("roundabout").startHeight, r = t(this).data("roundabout").startFontSize), t(this).addClass("roundabout-moveable-item").css("position", "absolute"), t(this).data("roundabout", {
					startWidth: s || t(this).width(),
					startHeight: o || t(this).height(),
					startFontSize: r || parseInt(t(this).css("font-size"), 10),
					degrees: l,
					backDegrees: n.normalize.apply(null, [l - 180]),
					childNumber: e,
					currentScale: 1,
					parent: a
				})
			}), n.updateChildren.apply(a), s.autoplay && n.startAutoplay.apply(a), a.trigger("ready"), e.apply(a), a
		},
		updateChildren: function() {
			return this.each(function() {
				var e = t(this),
					i = e.data("roundabout"),
					a = -1,
					s = {
						bearing: i.bearing,
						tilt: i.tilt,
						stage: {
							width: Math.floor(.9 * t(this).width()),
							height: Math.floor(.9 * t(this).height())
						},
						animating: i.animating,
						inFocus: i.childInFocus,
						focusBearingRadian: n.degToRad.apply(null, [i.focusBearing]),
						shape: t.roundaboutShapes[i.shape] || t.roundaboutShapes[t.roundaboutShapes.def]
					};
				s.midStage = {
					width: s.stage.width / 2,
					height: s.stage.height / 2
				}, s.nudge = {
					width: s.midStage.width + .05 * s.stage.width,
					height: s.midStage.height + .05 * s.stage.height
				}, s.zValues = {
					min: i.minZ,
					max: i.maxZ,
					diff: i.maxZ - i.minZ
				}, s.opacity = {
					min: i.minOpacity,
					max: i.maxOpacity,
					diff: i.maxOpacity - i.minOpacity
				}, s.scale = {
					min: i.minScale,
					max: i.maxScale,
					diff: i.maxScale - i.minScale
				}, e.children(i.childSelector).each(function(o) {
					!n.updateChild.apply(e, [t(this), s, o, function() {
						t(this).trigger("ready")
					}]) || s.animating && !i.lastAnimationStep ? t(this).removeClass("roundabout-in-focus") : (a = o, t(this).addClass("roundabout-in-focus"))
				}), a !== s.inFocus && (i.triggerBlurEvents && e.children(i.childSelector).eq(s.inFocus).trigger("blur"), i.childInFocus = a, i.triggerFocusEvents && -1 !== a && e.children(i.childSelector).eq(a).trigger("focus")), e.trigger("childrenUpdated")
			})
		},
		updateChild: function(e, i, a, s) {
			var o, r = this,
				l = t(e),
				d = l.data("roundabout"),
				c = [],
				u = n.degToRad.apply(null, [360 - d.degrees + i.bearing]);
			return s = s ||
			function() {}, u = n.normalizeRad.apply(null, [u]), o = i.shape(u, i.focusBearingRadian, i.tilt), o.scale = o.scale > 1 ? 1 : o.scale, o.adjustedScale = (i.scale.min + i.scale.diff * o.scale).toFixed(4), o.width = (o.adjustedScale * d.startWidth).toFixed(4), o.height = (o.adjustedScale * d.startHeight).toFixed(4), l.css({
				left: (o.x * i.midStage.width + i.nudge.width - o.width / 2).toFixed(0) + "px",
				top: (o.y * i.midStage.height + i.nudge.height - o.height / 2).toFixed(0) + "px",
				width: o.width + "px",
				height: o.height + "px",
				opacity: (i.opacity.min + i.opacity.diff * o.scale).toFixed(2),
				zIndex: Math.round(i.zValues.min + i.zValues.diff * o.z),
				fontSize: (o.adjustedScale * d.startFontSize).toFixed(1) + "px"
			}), d.currentScale = o.adjustedScale, r.data("roundabout").debug && (c.push('<div style="font-weight: normal; font-size: 10px; padding: 2px; width: ' + l.css("width") + '; background-color: #ffc;">'), c.push('<strong style="font-size: 12px; white-space: nowrap;">Child ' + a + "</strong><br />"), c.push("<strong>left:</strong> " + l.css("left") + "<br />"), c.push("<strong>top:</strong> " + l.css("top") + "<br />"), c.push("<strong>width:</strong> " + l.css("width") + "<br />"), c.push("<strong>opacity:</strong> " + l.css("opacity") + "<br />"), c.push("<strong>height:</strong> " + l.css("height") + "<br />"), c.push("<strong>z-index:</strong> " + l.css("z-index") + "<br />"), c.push("<strong>font-size:</strong> " + l.css("font-size") + "<br />"), c.push("<strong>scale:</strong> " + l.data("roundabout").currentScale), c.push("</div>"), l.html(c.join(""))), l.trigger("reposition"), s.apply(r), n.isInFocus.apply(r, [d.degrees])
		},
		setBearing: function(e, i) {
			return i = i ||
			function() {}, e = n.normalize.apply(null, [e]), this.each(function() {
				var i, a = t(this),
					s = a.data("roundabout"),
					o = s.bearing;
				s.bearing = e, a.trigger("bearingSet"), n.updateChildren.apply(a), i = Math.abs(o - e), !s.animating || i > 180 || (i = Math.abs(o - e), a.children(s.childSelector).each(function(i) {
					var a;
					n.isChildBackDegreesBetween.apply(t(this), [e, o]) && (a = o > e ? "Clockwise" : "Counterclockwise", t(this).trigger("move" + a + "ThroughBack"))
				}))
			}), i.apply(this), this
		},
		adjustBearing: function(e, i) {
			return i = i ||
			function() {}, 0 === e ? this : (this.each(function() {
				n.setBearing.apply(t(this), [t(this).data("roundabout").bearing + e])
			}), i.apply(this), this)
		},
		setTilt: function(e, i) {
			return i = i ||
			function() {}, this.each(function() {
				t(this).data("roundabout").tilt = e, n.updateChildren.apply(t(this))
			}), i.apply(this), this
		},
		adjustTilt: function(e, i) {
			return i = i ||
			function() {}, this.each(function() {
				n.setTilt.apply(t(this), [t(this).data("roundabout").tilt + e])
			}), i.apply(this), this
		},
		animateToBearing: function(e, i, a, s, o) {
			var r = (new Date).getTime();
			return o = o ||
			function() {}, t.isFunction(s) ? (o = s, s = null) : t.isFunction(a) ? (o = a, a = null) : t.isFunction(i) && (o = i, i = null), this.each(function() {
				var l, d, c, u = t(this),
					h = u.data("roundabout"),
					p = i || h.duration,
					f = a || h.easing || "swing";
				if (s || (s = {
					timerStart: r,
					start: h.bearing,
					totalTime: p
				}), l = r - s.timerStart, h.stopAnimation) return n.allowAnimation.apply(u), void(h.animating = !1);
				l < p ? (h.animating || u.trigger("animationStart"), h.animating = !0, "string" == typeof t.easing.def ? (d = t.easing[f] || t.easing[t.easing.def], c = d(null, l, s.start, e - s.start, s.totalTime)) : c = t.easing[f](l / s.totalTime, l, s.start, e - s.start, s.totalTime), c = n.normalize.apply(null, [c]), h.dragBearing = c, n.setBearing.apply(u, [c, function() {
					setTimeout(function() {
						n.animateToBearing.apply(u, [e, p, f, s, o])
					}, 0)
				}])) : (h.animating && u.trigger("animationEnd"), h.lastAnimationStep = !0, e = n.normalize.apply(null, [e]), n.setBearing.apply(u, [e]), h.animating = !1, h.lastAnimationStep = !1, h.dragBearing = e, o.apply(u))
			}), this
		},
		animateToNearbyChild: function(e, i) {
			var a = e[0],
				s = e[1],
				o = e[2] ||
			function() {};
			return t.isFunction(s) ? (o = s, s = null) : t.isFunction(a) && (o = a, a = null), this.each(function() {
				var e, r, l = t(this),
					d = l.data("roundabout"),
					c = d.reflect ? d.bearing : d.bearing % 360,
					u = l.children(d.childSelector).length;
				if (!d.animating) if (d.reflect && "previous" === i || !d.reflect && "next" === i) {
					for (c = Math.abs(c) < d.floatComparisonThreshold ? 360 : c, e = 0; e < u; e += 1) if (r = {
						lower: d.period * e,
						upper: d.period * (e + 1)
					}, r.upper = e === u - 1 ? 360 : r.upper, c <= Math.ceil(r.upper) && c >= Math.floor(r.lower)) {
						2 === u && 360 === c ? n.animateToDelta.apply(l, [-180, a, s, o]) : n.animateBearingToFocus.apply(l, [r.lower, a, s, o]);
						break
					}
				} else for (c = Math.abs(c) < d.floatComparisonThreshold || 360 - Math.abs(c) < d.floatComparisonThreshold ? 0 : c, e = u - 1; e >= 0; e -= 1) if (r = {
					lower: d.period * e,
					upper: d.period * (e + 1)
				}, r.upper = e === u - 1 ? 360 : r.upper, c >= Math.floor(r.lower) && c < Math.ceil(r.upper)) {
					2 === u && 360 === c ? n.animateToDelta.apply(l, [180, a, s, o]) : n.animateBearingToFocus.apply(l, [r.upper, a, s, o]);
					break
				}
			})
		},
		animateToNearestChild: function(e, i, a) {
			return a = a ||
			function() {}, t.isFunction(i) ? (a = i, i = null) : t.isFunction(e) && (a = e, e = null), this.each(function() {
				var s = n.getNearestChild.apply(t(this));
				n.animateToChild.apply(t(this), [s, e, i, a])
			})
		},
		animateToChild: function(e, i, a, s) {
			return s = s ||
			function() {}, t.isFunction(a) ? (s = a, a = null) : t.isFunction(i) && (s = i, i = null), this.each(function() {
				var o, r = t(this),
					l = r.data("roundabout");
				l.childInFocus === e || l.animating || (o = r.children(l.childSelector).eq(e), n.animateBearingToFocus.apply(r, [o.data("roundabout").degrees, i, a, s]))
			})
		},
		animateToNextChild: function(t, e, i) {
			return n.animateToNearbyChild.apply(this, [arguments, "next"])
		},
		animateToPreviousChild: function(t, e, i) {
			return n.animateToNearbyChild.apply(this, [arguments, "previous"])
		},
		animateToDelta: function(e, i, a, s) {
			return s = s ||
			function() {}, t.isFunction(a) ? (s = a, a = null) : t.isFunction(i) && (s = i, i = null), this.each(function() {
				var o = t(this).data("roundabout").bearing + e;
				n.animateToBearing.apply(t(this), [o, i, a, s])
			})
		},
		animateBearingToFocus: function(e, i, a, s) {
			return s = s ||
			function() {}, t.isFunction(a) ? (s = a, a = null) : t.isFunction(i) && (s = i, i = null), this.each(function() {
				var o = t(this).data("roundabout").bearing - e;
				o = Math.abs(360 - o) < Math.abs(o) ? 360 - o : -o, 0 !== (o = o > 180 ? -(360 - o) : o) && n.animateToDelta.apply(t(this), [o, i, a, s])
			})
		},
		stopAnimation: function() {
			return this.each(function() {
				t(this).data("roundabout").stopAnimation = !0
			})
		},
		allowAnimation: function() {
			return this.each(function() {
				t(this).data("roundabout").stopAnimation = !1
			})
		},
		startAutoplay: function(e) {
			return this.each(function() {
				var i = t(this),
					a = i.data("roundabout");
				e = e || a.autoplayCallback ||
				function() {}, clearInterval(a.autoplayInterval), a.autoplayInterval = setInterval(function() {
					n.animateToNextChild.apply(i, [e])
				}, a.autoplayDuration), a.autoplayIsRunning = !0, i.trigger("autoplayStart")
			})
		},
		stopAutoplay: function(e) {
			return this.each(function() {
				clearInterval(t(this).data("roundabout").autoplayInterval), t(this).data("roundabout").autoplayInterval = null, t(this).data("roundabout").autoplayIsRunning = !1, e || t(this).unbind(".autoplay"), t(this).trigger("autoplayStop")
			})
		},
		toggleAutoplay: function(e) {
			return this.each(function() {
				var i = t(this),
					a = i.data("roundabout");
				e = e || a.autoplayCallback ||
				function() {}, n.isAutoplaying.apply(t(this)) ? n.stopAutoplay.apply(t(this), [e]) : n.startAutoplay.apply(t(this), [e])
			})
		},
		isAutoplaying: function() {
			return this.data("roundabout").autoplayIsRunning
		},
		changeAutoplayDuration: function(e) {
			return this.each(function() {
				var i = t(this);
				i.data("roundabout").autoplayDuration = e, n.isAutoplaying.apply(i) && (n.stopAutoplay.apply(i), setTimeout(function() {
					n.startAutoplay.apply(i)
				}, 10))
			})
		},
		normalize: function(t) {
			var e = t % 360;
			return e < 0 ? 360 + e : e
		},
		normalizeRad: function(t) {
			for (; t < 0;) t += 2 * Math.PI;
			for (; t > 2 * Math.PI;) t -= 2 * Math.PI;
			return t
		},
		isChildBackDegreesBetween: function(e, i) {
			var n = t(this).data("roundabout").backDegrees;
			return e > i ? n >= i && n < e : n < i && n >= e
		},
		getAnimateToMethod: function(t) {
			return t = t.toLowerCase(), "next" === t ? "animateToNextChild" : "previous" === t ? "animateToPreviousChild" : "animateToNearestChild"
		},
		relayoutChildren: function() {
			return this.each(function() {
				var e = t(this),
					i = t.extend({}, e.data("roundabout"));
				i.startingChild = e.data("roundabout").childInFocus, n.init.apply(e, [i, null, !0])
			})
		},
		getNearestChild: function() {
			var e = t(this),
				i = e.data("roundabout"),
				n = e.children(i.childSelector).length;
			return i.reflect ? Math.round(i.bearing / i.period) % n : (n - Math.round(i.bearing / i.period) % n) % n
		},
		degToRad: function(t) {
			return n.normalize.apply(null, [t]) * Math.PI / 180
		},
		getPlacement: function(t) {
			var e = this.data("roundabout");
			return e.reflect ? e.period * t : 360 - e.period * t
		},
		isInFocus: function(t) {
			var e, i = this,
				a = i.data("roundabout"),
				s = n.normalize.apply(null, [a.bearing]);
			return t = n.normalize.apply(null, [t]), (e = Math.abs(s - t)) <= a.floatComparisonThreshold || e >= 360 - a.floatComparisonThreshold
		}
	}, t.fn.roundabout = function(e) {
		return n[e] ? n[e].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" == typeof e || t.isFunction(e) || !e ? n.init.apply(this, arguments) : void t.error("Method " + e + " does not exist for jQuery.roundabout.")
	}
}(jQuery), function(t) {
	"function" == typeof define && define.amd ? define(["jquery"], t) : t(jQuery)
}(function(t) {
	t.extend(t.fn, {
		validate: function(e) {
			if (!this.length) return void(e && e.debug && window.console);
			var i = t.data(this[0], "validator");
			return i || (this.attr("novalidate", "novalidate"), i = new t.validator(e, this[0]), t.data(this[0], "validator", i), i.settings.onsubmit && (this.on("click.validate", ":submit", function(e) {
				i.settings.submitHandler && (i.submitButton = e.target), t(this).hasClass("cancel") && (i.cancelSubmit = !0), void 0 !== t(this).attr("formnovalidate") && (i.cancelSubmit = !0)
			}), this.on("submit.validate", function(e) {
				function n() {
					var n, a;
					return !i.settings.submitHandler || (i.submitButton && (n = t("<input type='hidden'/>").attr("name", i.submitButton.name).val(t(i.submitButton).val()).appendTo(i.currentForm)), a = i.settings.submitHandler.call(i, i.currentForm, e), i.submitButton && n.remove(), void 0 !== a && a)
				}
				return i.settings.debug && e.preventDefault(), i.cancelSubmit ? (i.cancelSubmit = !1, n()) : i.form() ? i.pendingRequest ? (i.formSubmitted = !0, !1) : n() : (i.focusInvalid(), !1)
			})), i)
		},
		valid: function() {
			var e, i, n;
			return t(this[0]).is("form") ? e = this.validate().form() : (n = [], e = !0, i = t(this[0].form).validate(), this.each(function() {
				e = i.element(this) && e, n = n.concat(i.errorList)
			}), i.errorList = n), e
		},
		rules: function(e, i) {
			var n, a, s, o, r, l, d = this[0];
			if (e) switch (n = t.data(d.form, "validator").settings, a = n.rules, s = t.validator.staticRules(d), e) {
			case "add":
				t.extend(s, t.validator.normalizeRule(i)), delete s.messages, a[d.name] = s, i.messages && (n.messages[d.name] = t.extend(n.messages[d.name], i.messages));
				break;
			case "remove":
				return i ? (l = {}, t.each(i.split(/\s/), function(e, i) {
					l[i] = s[i], delete s[i], "required" === i && t(d).removeAttr("aria-required")
				}), l) : (delete a[d.name], s)
			}
			return o = t.validator.normalizeRules(t.extend({}, t.validator.classRules(d), t.validator.attributeRules(d), t.validator.dataRules(d), t.validator.staticRules(d)), d), o.required && (r = o.required, delete o.required, o = t.extend({
				required: r
			}, o), t(d).attr("aria-required", "true")), o.remote && (r = o.remote, delete o.remote, o = t.extend(o, {
				remote: r
			})), o
		}
	}), t.extend(t.expr[":"], {
		blank: function(e) {
			return !t.trim("" + t(e).val())
		},
		filled: function(e) {
			return !!t.trim("" + t(e).val())
		},
		unchecked: function(e) {
			return !t(e).prop("checked")
		}
	}), t.validator = function(e, i) {
		this.settings = t.extend(!0, {}, t.validator.defaults, e), this.currentForm = i, this.init()
	}, t.validator.format = function(e, i) {
		return 1 === arguments.length ?
		function() {
			var i = t.makeArray(arguments);
			return i.unshift(e), t.validator.format.apply(this, i)
		} : (arguments.length > 2 && i.constructor !== Array && (i = t.makeArray(arguments).slice(1)), i.constructor !== Array && (i = [i]), t.each(i, function(t, i) {
			e = e.replace(new RegExp("\\{" + t + "\\}", "g"), function() {
				return i
			})
		}), e)
	}, t.extend(t.validator, {
		defaults: {
			messages: {},
			groups: {},
			rules: {},
			errorClass: "error",
			validClass: "valid",
			errorElement: "label",
			focusCleanup: !1,
			focusInvalid: !0,
			errorContainer: t([]),
			errorLabelContainer: t([]),
			onsubmit: !0,
			ignore: ":hidden",
			ignoreTitle: !1,
			onfocusin: function(t) {
				this.lastActive = t, this.settings.focusCleanup && (this.settings.unhighlight && this.settings.unhighlight.call(this, t, this.settings.errorClass, this.settings.validClass), this.hideThese(this.errorsFor(t)))
			},
			onfocusout: function(t) {
				this.checkable(t) || !(t.name in this.submitted) && this.optional(t) || this.element(t)
			},
			onkeyup: function(e, i) {
				var n = [16, 17, 18, 20, 35, 36, 37, 38, 39, 40, 45, 144, 225];
				9 === i.which && "" === this.elementValue(e) || -1 !== t.inArray(i.keyCode, n) || (e.name in this.submitted || e === this.lastElement) && this.element(e)
			},
			onclick: function(t) {
				t.name in this.submitted ? this.element(t) : t.parentNode.name in this.submitted && this.element(t.parentNode)
			},
			highlight: function(e, i, n) {
				"radio" === e.type ? this.findByName(e.name).addClass(i).removeClass(n) : t(e).addClass(i).removeClass(n)
			},
			unhighlight: function(e, i, n) {
				"radio" === e.type ? this.findByName(e.name).removeClass(i).addClass(n) : t(e).removeClass(i).addClass(n)
			}
		},
		setDefaults: function(e) {
			t.extend(t.validator.defaults, e)
		},
		messages: {
			required: "This field is required.",
			remote: "Please fix this field.",
			email: "Please enter a valid email address.",
			url: "Please enter a valid URL.",
			date: "Please enter a valid date.",
			dateISO: "Please enter a valid date ( ISO ).",
			number: "Please enter a valid number.",
			digits: "Please enter only digits.",
			creditcard: "Please enter a valid credit card number.",
			equalTo: "Please enter the same value again.",
			maxlength: t.validator.format("Please enter no more than {0} characters."),
			minlength: t.validator.format("Please enter at least {0} characters."),
			rangelength: t.validator.format("Please enter a value between {0} and {1} characters long."),
			range: t.validator.format("Please enter a value between {0} and {1}."),
			max: t.validator.format("Please enter a value less than or equal to {0}."),
			min: t.validator.format("Please enter a value greater than or equal to {0}.")
		},
		autoCreateRanges: !1,
		prototype: {
			init: function() {
				function e(e) {
					var i = t.data(this.form, "validator"),
						n = "on" + e.type.replace(/^validate/, ""),
						a = i.settings;
					a[n] && !t(this).is(a.ignore) && a[n].call(i, this, e)
				}
				this.labelContainer = t(this.settings.errorLabelContainer), this.errorContext = this.labelContainer.length && this.labelContainer || t(this.currentForm), this.containers = t(this.settings.errorContainer).add(this.settings.errorLabelContainer), this.submitted = {}, this.valueCache = {}, this.pendingRequest = 0, this.pending = {}, this.invalid = {}, this.reset();
				var i, n = this.groups = {};
				t.each(this.settings.groups, function(e, i) {
					"string" == typeof i && (i = i.split(/\s/)), t.each(i, function(t, i) {
						n[i] = e
					})
				}), i = this.settings.rules, t.each(i, function(e, n) {
					i[e] = t.validator.normalizeRule(n)
				}), t(this.currentForm).on("focusin.validate focusout.validate keyup.validate", ":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'], [type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'], [type='radio'], [type='checkbox']", e).on("click.validate", "select, option, [type='radio'], [type='checkbox']", e), this.settings.invalidHandler && t(this.currentForm).on("invalid-form.validate", this.settings.invalidHandler), t(this.currentForm).find("[required], [data-rule-required], .required").attr("aria-required", "true")
			},
			form: function() {
				return this.checkForm(), t.extend(this.submitted, this.errorMap), this.invalid = t.extend({}, this.errorMap), this.valid() || t(this.currentForm).triggerHandler("invalid-form", [this]), this.showErrors(), this.valid()
			},
			checkForm: function() {
				this.prepareForm();
				for (var t = 0, e = this.currentElements = this.elements(); e[t]; t++) this.check(e[t]);
				return this.valid()
			},
			element: function(e) {
				var i = this.clean(e),
					n = this.validationTargetFor(i),
					a = !0;
				return this.lastElement = n, void 0 === n ? delete this.invalid[i.name] : (this.prepareElement(n), this.currentElements = t(n), a = !1 !== this.check(n), a ? delete this.invalid[n.name] : this.invalid[n.name] = !0), t(e).attr("aria-invalid", !a), this.numberOfInvalids() || (this.toHide = this.toHide.add(this.containers)), this.showErrors(), a
			},
			showErrors: function(e) {
				if (e) {
					t.extend(this.errorMap, e), this.errorList = [];
					for (var i in e) this.errorList.push({
						message: e[i],
						element: this.findByName(i)[0]
					});
					this.successList = t.grep(this.successList, function(t) {
						return !(t.name in e)
					})
				}
				this.settings.showErrors ? this.settings.showErrors.call(this, this.errorMap, this.errorList) : this.defaultShowErrors()
			},
			resetForm: function() {
				t.fn.resetForm && t(this.currentForm).resetForm(), this.submitted = {}, this.lastElement = null, this.prepareForm(), this.hideErrors();
				var e, i = this.elements().removeData("previousValue").removeAttr("aria-invalid");
				if (this.settings.unhighlight) for (e = 0; i[e]; e++) this.settings.unhighlight.call(this, i[e], this.settings.errorClass, "");
				else i.removeClass(this.settings.errorClass)
			},
			numberOfInvalids: function() {
				return this.objectLength(this.invalid)
			},
			objectLength: function(t) {
				var e, i = 0;
				for (e in t) i++;
				return i
			},
			hideErrors: function() {
				this.hideThese(this.toHide)
			},
			hideThese: function(t) {
				t.not(this.containers).text(""), this.addWrapper(t).hide()
			},
			valid: function() {
				return 0 === this.size()
			},
			size: function() {
				return this.errorList.length
			},
			focusInvalid: function() {
				if (this.settings.focusInvalid) try {
					t(this.findLastActive() || this.errorList.length && this.errorList[0].element || []).filter(":visible").focus().trigger("focusin")
				} catch (t) {}
			},
			findLastActive: function() {
				var e = this.lastActive;
				return e && 1 === t.grep(this.errorList, function(t) {
					return t.element.name === e.name
				}).length && e
			},
			elements: function() {
				var e = this,
					i = {};
				return t(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, :disabled").not(this.settings.ignore).filter(function() {
					return !this.name && e.settings.debug && window.console, !(this.name in i || !e.objectLength(t(this).rules()) || (i[this.name] = !0, 0))
				})
			},
			clean: function(e) {
				return t(e)[0]
			},
			errors: function() {
				var e = this.settings.errorClass.split(" ").join(".");
				return t(this.settings.errorElement + "." + e, this.errorContext)
			},
			reset: function() {
				this.successList = [], this.errorList = [], this.errorMap = {}, this.toShow = t([]), this.toHide = t([]), this.currentElements = t([])
			},
			prepareForm: function() {
				this.reset(), this.toHide = this.errors().add(this.containers)
			},
			prepareElement: function(t) {
				this.reset(), this.toHide = this.errorsFor(t)
			},
			elementValue: function(e) {
				var i, n = t(e),
					a = e.type;
				return "radio" === a || "checkbox" === a ? this.findByName(e.name).filter(":checked").val() : "number" === a && void 0 !== e.validity ? !e.validity.badInput && n.val() : (i = n.val(), "string" == typeof i ? i.replace(/\r/g, "") : i)
			},
			check: function(e) {
				e = this.validationTargetFor(this.clean(e));
				var i, n, a, s = t(e).rules(),
					o = t.map(s, function(t, e) {
						return e
					}).length,
					r = !1,
					l = this.elementValue(e);
				for (n in s) {
					a = {
						method: n,
						parameters: s[n]
					};
					try {
						if ("dependency-mismatch" === (i = t.validator.methods[n].call(this, l, e, a.parameters)) && 1 === o) {
							r = !0;
							continue
						}
						if (r = !1, "pending" === i) return void(this.toHide = this.toHide.not(this.errorsFor(e)));
						if (!i) return this.formatAndAdd(e, a), !1
					} catch (t) {
						throw this.settings.debug && window.console, t instanceof TypeError && (t.message += ".  Exception occurred when checking element " + e.id + ", check the '" + a.method + "' method."), t
					}
				}
				if (!r) return this.objectLength(s) && this.successList.push(e), !0
			},
			customDataMessage: function(e, i) {
				return t(e).data("msg" + i.charAt(0).toUpperCase() + i.substring(1).toLowerCase()) || t(e).data("msg")
			},
			customMessage: function(t, e) {
				var i = this.settings.messages[t];
				return i && (i.constructor === String ? i : i[e])
			},
			findDefined: function() {
				for (var t = 0; t < arguments.length; t++) if (void 0 !== arguments[t]) return arguments[t]
			},
			defaultMessage: function(e, i) {
				return this.findDefined(this.customMessage(e.name, i), this.customDataMessage(e, i), !this.settings.ignoreTitle && e.title || void 0, t.validator.messages[i], "<strong>Warning: No message defined for " + e.name + "</strong>")
			},
			formatAndAdd: function(e, i) {
				var n = this.defaultMessage(e, i.method),
					a = /\$?\{(\d+)\}/g;
				"function" == typeof n ? n = n.call(this, i.parameters, e) : a.test(n) && (n = t.validator.format(n.replace(a, "{$1}"), i.parameters)), this.errorList.push({
					message: n,
					element: e,
					method: i.method
				}), this.errorMap[e.name] = n, this.submitted[e.name] = n
			},
			addWrapper: function(t) {
				return this.settings.wrapper && (t = t.add(t.parent(this.settings.wrapper))), t
			},
			defaultShowErrors: function() {
				var t, e, i;
				for (t = 0; this.errorList[t]; t++) i = this.errorList[t], this.settings.highlight && this.settings.highlight.call(this, i.element, this.settings.errorClass, this.settings.validClass), this.showLabel(i.element, i.message);
				if (this.errorList.length && (this.toShow = this.toShow.add(this.containers)), this.settings.success) for (t = 0; this.successList[t]; t++) this.showLabel(this.successList[t]);
				if (this.settings.unhighlight) for (t = 0, e = this.validElements(); e[t]; t++) this.settings.unhighlight.call(this, e[t], this.settings.errorClass, this.settings.validClass);
				this.toHide = this.toHide.not(this.toShow), this.hideErrors(), this.addWrapper(this.toShow).show()
			},
			validElements: function() {
				return this.currentElements.not(this.invalidElements())
			},
			invalidElements: function() {
				return t(this.errorList).map(function() {
					return this.element
				})
			},
			showLabel: function(e, i) {
				var n, a, s, o = this.errorsFor(e),
					r = this.idOrName(e),
					l = t(e).attr("aria-describedby");
				o.length ? (o.removeClass(this.settings.validClass).addClass(this.settings.errorClass), o.html(i)) : (o = t("<" + this.settings.errorElement + ">").attr("id", r + "-error").addClass(this.settings.errorClass).html(i || ""), n = o, this.settings.wrapper && (n = o.hide().show().wrap("<" + this.settings.wrapper + "/>").parent()), this.labelContainer.length ? this.labelContainer.append(n) : this.settings.errorPlacement ? this.settings.errorPlacement(n, t(e)) : n.insertAfter(e), o.is("label") ? o.attr("for", r) : 0 === o.parents("label[for='" + r + "']").length && (s = o.attr("id").replace(/(:|\.|\[|\]|\$)/g, "\\$1"), l ? l.match(new RegExp("\\b" + s + "\\b")) || (l += " " + s) : l = s, t(e).attr("aria-describedby", l), (a = this.groups[e.name]) && t.each(this.groups, function(e, i) {
					i === a && t("[name='" + e + "']", this.currentForm).attr("aria-describedby", o.attr("id"))
				}))), !i && this.settings.success && (o.text(""), "string" == typeof this.settings.success ? o.addClass(this.settings.success) : this.settings.success(o, e)), this.toShow = this.toShow.add(o)
			},
			errorsFor: function(e) {
				var i = this.idOrName(e),
					n = t(e).attr("aria-describedby"),
					a = "label[for='" + i + "'], label[for='" + i + "'] *";
				return n && (a = a + ", #" + n.replace(/\s+/g, ", #")), this.errors().filter(a)
			},
			idOrName: function(t) {
				return this.groups[t.name] || (this.checkable(t) ? t.name : t.id || t.name)
			},
			validationTargetFor: function(e) {
				return this.checkable(e) && (e = this.findByName(e.name)), t(e).not(this.settings.ignore)[0]
			},
			checkable: function(t) {
				return /radio|checkbox/i.test(t.type)
			},
			findByName: function(e) {
				return t(this.currentForm).find("[name='" + e + "']")
			},
			getLength: function(e, i) {
				switch (i.nodeName.toLowerCase()) {
				case "select":
					return t("option:selected", i).length;
				case "input":
					if (this.checkable(i)) return this.findByName(i.name).filter(":checked").length
				}
				return e.length
			},
			depend: function(t, e) {
				return !this.dependTypes[typeof t] || this.dependTypes[typeof t](t, e)
			},
			dependTypes: {
				boolean: function(t) {
					return t
				},
				string: function(e, i) {
					return !!t(e, i.form).length
				},


				function :function(t, e) {
					return t(e)
				}
			},
			optional: function(e) {
				var i = this.elementValue(e);
				return !t.validator.methods.required.call(this, i, e) && "dependency-mismatch"
			},
			startRequest: function(t) {
				this.pending[t.name] || (this.pendingRequest++, this.pending[t.name] = !0)
			},
			stopRequest: function(e, i) {
				this.pendingRequest--, this.pendingRequest < 0 && (this.pendingRequest = 0), delete this.pending[e.name], i && 0 === this.pendingRequest && this.formSubmitted && this.form() ? (t(this.currentForm).submit(), this.formSubmitted = !1) : !i && 0 === this.pendingRequest && this.formSubmitted && (t(this.currentForm).triggerHandler("invalid-form", [this]), this.formSubmitted = !1)
			},
			previousValue: function(e) {
				return t.data(e, "previousValue") || t.data(e, "previousValue", {
					old: null,
					valid: !0,
					message: this.defaultMessage(e, "remote")
				})
			},
			destroy: function() {
				this.resetForm(), t(this.currentForm).off(".validate").removeData("validator")
			}
		},
		classRuleSettings: {
			required: {
				required: !0
			},
			email: {
				email: !0
			},
			url: {
				url: !0
			},
			date: {
				date: !0
			},
			dateISO: {
				dateISO: !0
			},
			number: {
				number: !0
			},
			digits: {
				digits: !0
			},
			creditcard: {
				creditcard: !0
			}
		},
		addClassRules: function(e, i) {
			e.constructor === String ? this.classRuleSettings[e] = i : t.extend(this.classRuleSettings, e)
		},
		classRules: function(e) {
			var i = {},
				n = t(e).attr("class");
			return n && t.each(n.split(" "), function() {
				this in t.validator.classRuleSettings && t.extend(i, t.validator.classRuleSettings[this])
			}), i
		},
		normalizeAttributeRule: function(t, e, i, n) {
			/min|max/.test(i) && (null === e || /number|range|text/.test(e)) && (n = Number(n), isNaN(n) && (n = void 0)), n || 0 === n ? t[i] = n : e === i && "range" !== e && (t[i] = !0)
		},
		attributeRules: function(e) {
			var i, n, a = {},
				s = t(e),
				o = e.getAttribute("type");
			for (i in t.validator.methods)"required" === i ? (n = e.getAttribute(i), "" === n && (n = !0), n = !! n) : n = s.attr(i), this.normalizeAttributeRule(a, o, i, n);
			return a.maxlength && /-1|2147483647|524288/.test(a.maxlength) && delete a.maxlength, a
		},
		dataRules: function(e) {
			var i, n, a = {},
				s = t(e),
				o = e.getAttribute("type");
			for (i in t.validator.methods) n = s.data("rule" + i.charAt(0).toUpperCase() + i.substring(1).toLowerCase()), this.normalizeAttributeRule(a, o, i, n);
			return a
		},
		staticRules: function(e) {
			var i = {},
				n = t.data(e.form, "validator");
			return n.settings.rules && (i = t.validator.normalizeRule(n.settings.rules[e.name]) || {}), i
		},
		normalizeRules: function(e, i) {
			return t.each(e, function(n, a) {
				if (!1 === a) return void delete e[n];
				if (a.param || a.depends) {
					var s = !0;
					switch (typeof a.depends) {
					case "string":
						s = !! t(a.depends, i.form).length;
						break;
					case "function":
						s = a.depends.call(i, i)
					}
					s ? e[n] = void 0 === a.param || a.param : delete e[n]
				}
			}), t.each(e, function(n, a) {
				e[n] = t.isFunction(a) ? a(i) : a
			}), t.each(["minlength", "maxlength"], function() {
				e[this] && (e[this] = Number(e[this]))
			}), t.each(["rangelength", "range"], function() {
				var i;
				e[this] && (t.isArray(e[this]) ? e[this] = [Number(e[this][0]), Number(e[this][1])] : "string" == typeof e[this] && (i = e[this].replace(/[\[\]]/g, "").split(/[\s,]+/), e[this] = [Number(i[0]), Number(i[1])]))
			}), t.validator.autoCreateRanges && (null != e.min && null != e.max && (e.range = [e.min, e.max], delete e.min, delete e.max), null != e.minlength && null != e.maxlength && (e.rangelength = [e.minlength, e.maxlength], delete e.minlength, delete e.maxlength)), e
		},
		normalizeRule: function(e) {
			if ("string" == typeof e) {
				var i = {};
				t.each(e.split(/\s/), function() {
					i[this] = !0
				}), e = i
			}
			return e
		},
		addMethod: function(e, i, n) {
			t.validator.methods[e] = i, t.validator.messages[e] = void 0 !== n ? n : t.validator.messages[e], i.length < 3 && t.validator.addClassRules(e, t.validator.normalizeRule(e))
		},
		methods: {
			required: function(e, i, n) {
				if (!this.depend(n, i)) return "dependency-mismatch";
				if ("select" === i.nodeName.toLowerCase()) {
					var a = t(i).val();
					return a && a.length > 0
				}
				return this.checkable(i) ? this.getLength(e, i) > 0 : e.length > 0
			},
			email: function(t, e) {
				return this.optional(e) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(t)
			},
			url: function(t, e) {
				return this.optional(e) || /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[\/?#]\S*)?$/i.test(t)
			},
			date: function(t, e) {
				return this.optional(e) || !/Invalid|NaN/.test(new Date(t).toString())
			},
			dateISO: function(t, e) {
				return this.optional(e) || /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(t)
			},
			number: function(t, e) {
				return this.optional(e) || /^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(t)
			},
			digits: function(t, e) {
				return this.optional(e) || /^\d+$/.test(t)
			},
			creditcard: function(t, e) {
				if (this.optional(e)) return "dependency-mismatch";
				if (/[^0-9 \-]+/.test(t)) return !1;
				var i, n, a = 0,
					s = 0,
					o = !1;
				if (t = t.replace(/\D/g, ""), t.length < 13 || t.length > 19) return !1;
				for (i = t.length - 1; i >= 0; i--) n = t.charAt(i), s = parseInt(n, 10), o && (s *= 2) > 9 && (s -= 9), a += s, o = !o;
				return a % 10 == 0
			},
			minlength: function(e, i, n) {
				var a = t.isArray(e) ? e.length : this.getLength(e, i);
				return this.optional(i) || a >= n
			},
			maxlength: function(e, i, n) {
				var a = t.isArray(e) ? e.length : this.getLength(e, i);
				return this.optional(i) || n >= a
			},
			rangelength: function(e, i, n) {
				var a = t.isArray(e) ? e.length : this.getLength(e, i);
				return this.optional(i) || a >= n[0] && a <= n[1]
			},
			min: function(t, e, i) {
				return this.optional(e) || t >= i
			},
			max: function(t, e, i) {
				return this.optional(e) || i >= t
			},
			range: function(t, e, i) {
				return this.optional(e) || t >= i[0] && t <= i[1]
			},
			equalTo: function(e, i, n) {
				var a = t(n);
				return this.settings.onfocusout && a.off(".validate-equalTo").on("blur.validate-equalTo", function() {
					t(i).valid()
				}), e === a.val()
			},
			remote: function(e, i, n) {
				if (this.optional(i)) return "dependency-mismatch";
				var a, s, o = this.previousValue(i);
				return this.settings.messages[i.name] || (this.settings.messages[i.name] = {}), o.originalMessage = this.settings.messages[i.name].remote, this.settings.messages[i.name].remote = o.message, n = "string" == typeof n && {
					url: n
				} || n, o.old === e ? o.valid : (o.old = e, a = this, this.startRequest(i), s = {}, s[i.name] = e, t.ajax(t.extend(!0, {
					mode: "abort",
					port: "validate" + i.name,
					dataType: "json",
					data: s,
					context: a.currentForm,
					success: function(n) {
						var s, r, l, d = !0 === n || "true" === n;
						a.settings.messages[i.name].remote = o.originalMessage, d ? (l = a.formSubmitted, a.prepareElement(i), a.formSubmitted = l, a.successList.push(i), delete a.invalid[i.name], a.showErrors()) : (s = {}, r = n || a.defaultMessage(i, "remote"), s[i.name] = o.message = t.isFunction(r) ? r(e) : r, a.invalid[i.name] = !0, a.showErrors(s)), o.valid = d, a.stopRequest(i, d)
					}
				}, n)), "pending")
			}
		}
	});
	var e, i = {};
	t.ajaxPrefilter ? t.ajaxPrefilter(function(t, e, n) {
		var a = t.port;
		"abort" === t.mode && (i[a] && i[a].abort(), i[a] = n)
	}) : (e = t.ajax, t.ajax = function(n) {
		var a = ("mode" in n ? n : t.ajaxSettings).mode,
			s = ("port" in n ? n : t.ajaxSettings).port;
		return "abort" === a ? (i[s] && i[s].abort(), i[s] = e.apply(this, arguments), i[s]) : e.apply(this, arguments)
	})
}), function(t, e) {
	"use strict";
	var i, n, a = t.layui && layui.define,
		s = {
			getPath: function() {
				var t = document.scripts,
					e = t[t.length - 1],
					i = e.src;
				if (!e.getAttribute("merge")) return i.substring(0, i.lastIndexOf("/") + 1)
			}(),
			config: {},
			end: {},
			minIndex: 0,
			minLeft: [],
			btn: ["&#x786E;&#x5B9A;", "&#x53D6;&#x6D88;"],
			type: ["dialog", "page", "iframe", "loading", "tips"]
		},
		o = {
			v: "3.0.3",
			ie: function() {
				var e = navigator.userAgent.toLowerCase();
				return !!(t.ActiveXObject || "ActiveXObject" in t) && ((e.match(/msie\s(\d+)/) || [])[1] || "11")
			}(),
			index: t.layer && t.layer.v ? 1e5 : 0,
			path: s.getPath,
			config: function(t, e) {
				return t = t || {}, o.cache = s.config = i.extend({}, s.config, t), o.path = s.config.path || o.path, "string" == typeof t.extend && (t.extend = [t.extend]), s.config.path && o.ready(), t.extend ? (a ? layui.addcss("modules/layer/" + t.extend) : o.link("skin/" + t.extend), this) : this
			},
			link: function(e, n, a) {
				if (o.path) {
					i("head")[0], document.createElement("link"), "string" == typeof n && (a = n);
					var s = ((a || e).replace(/\.|\//g, ""), 0);
					"function" == typeof n &&
					function e() {
						return ++s > 80 ? t.console && void 0 : void(1989 === parseInt(i("#" + d).css("width")) ? n() : setTimeout(e, 100))
					}()
				}
			},
			ready: function(t) {
				return a ? layui.addcss(" ") : o.link(" "), this
			},
			alert: function(t, e, n) {
				var a = "function" == typeof e;
				return a && (n = e), o.open(i.extend({
					content: t,
					yes: n
				}, a ? {} : e))
			},
			confirm: function(t, e, n, a) {
				var r = "function" == typeof e;
				return r && (a = n, n = e), o.open(i.extend({
					content: t,
					btn: s.btn,
					yes: n,
					btn2: a
				}, r ? {} : e))
			},
			msg: function(t, e, n) {
				var a = "function" == typeof e,
					r = s.config.skin,
					d = (r ? r + " " + r + "-msg" : "") || "layui-layer-msg",
					c = l.anim.length - 1;
				return a && (n = e), o.open(i.extend({
					content: t,
					time: 3e3,
					shade: !1,
					skin: d,
					title: !1,
					closeBtn: !1,
					btn: !1,
					resize: !1,
					end: n
				}, a && !s.config.skin ? {
					skin: d + " layui-layer-hui",
					anim: c
				} : function() {
					return e = e || {}, (-1 === e.icon || void 0 === e.icon && !s.config.skin) && (e.skin = d + " " + (e.skin || "layui-layer-hui")), e
				}()))
			},
			load: function(t, e) {
				return o.open(i.extend({
					type: 3,
					icon: t || 0,
					resize: !1,
					shade: .01
				}, e))
			},
			tips: function(t, e, n) {
				return o.open(i.extend({
					type: 4,
					content: [t, e],
					closeBtn: !1,
					time: 3e3,
					shade: !1,
					resize: !1,
					fixed: !1,
					maxWidth: 210
				}, n))
			}
		},
		r = function(t) {
			var e = this;
			e.index = ++o.index, e.config = i.extend({}, e.config, s.config, t), document.body ? e.creat() : setTimeout(function() {
				e.creat()
			}, 30)
		};
	r.pt = r.prototype;
	var l = ["layui-layer", ".layui-layer-title", ".layui-layer-main", ".layui-layer-dialog", "layui-layer-iframe", "layui-layer-content", "layui-layer-btn", "layui-layer-close"];
	l.anim = ["layer-anim", "layer-anim-01", "layer-anim-02", "layer-anim-03", "layer-anim-04", "layer-anim-05", "layer-anim-06"], r.pt.config = {
		type: 0,
		shade: .3,
		fixed: !0,
		move: l[1],
		title: "&#x4FE1;&#x606F;",
		offset: "auto",
		area: "auto",
		closeBtn: 1,
		time: 0,
		zIndex: 19891014,
		maxWidth: 360,
		anim: 0,
		isOutAnim: !0,
		icon: -1,
		moveType: 1,
		resize: !0,
		scrollbar: !0,
		tips: 2
	}, r.pt.vessel = function(t, e) {
		var n = this,
			a = n.index,
			o = n.config,
			r = o.zIndex + a,
			d = "object" == typeof o.title,
			c = o.maxmin && (1 === o.type || 2 === o.type),
			u = o.title ? '<div class="layui-layer-title" style="' + (d ? o.title[1] : "") + '">' + (d ? o.title[0] : o.title) + "</div>" : "";
		return o.zIndex = r, e([o.shade ? '<div class="layui-layer-shade" id="layui-layer-shade' + a + '" times="' + a + '" style="z-index:' + (r - 1) + "; background-color:" + (o.shade[1] || "#000") + "; opacity:" + (o.shade[0] || o.shade) + "; filter:alpha(opacity=" + (100 * o.shade[0] || 100 * o.shade) + ');"></div>' : "", '<div class="' + l[0] + " layui-layer-" + s.type[o.type] + (0 != o.type && 2 != o.type || o.shade ? "" : " layui-layer-border") + " " + (o.skin || "") + '" id="' + l[0] + a + '" type="' + s.type[o.type] + '" times="' + a + '" showtime="' + o.time + '" conType="' + (t ? "object" : "string") + '" style="z-index: ' + r + "; width:" + o.area[0] + ";height:" + o.area[1] + (o.fixed ? "" : ";position:absolute;") + '">' + (t && 2 != o.type ? "" : u) + '<div id="' + (o.id || "") + '" class="layui-layer-content' + (0 == o.type && -1 !== o.icon ? " layui-layer-padding" : "") + (3 == o.type ? " layui-layer-loading" + o.icon : "") + '">' + (0 == o.type && -1 !== o.icon ? '<i class="layui-layer-ico layui-layer-ico' + o.icon + '"></i>' : "") + (1 == o.type && t ? "" : o.content || "") + '</div><span class="layui-layer-setwin">' +
		function() {
			var t = c ? '<a class="layui-layer-min" href="javascript:;"><cite></cite></a><a class="layui-layer-ico layui-layer-max" href="javascript:;"></a>' : "";
			return o.closeBtn && (t += '<a class="layui-layer-ico ' + l[7] + " " + l[7] + (o.title ? o.closeBtn : 4 == o.type ? "1" : "2") + '" href="javascript:;"></a>'), t
		}() + "</span>" + (o.btn ?
		function() {
			var t = "";
			"string" == typeof o.btn && (o.btn = [o.btn]);
			for (var e = 0, i = o.btn.length; e < i; e++) t += '<a class="' + l[6] + e + '">' + o.btn[e] + "</a>";
			return '<div class="' + l[6] + " layui-layer-btn-" + (o.btnAlign || "") + '">' + t + "</div>"
		}() : "") + (o.resize ? '<span class="layui-layer-resize"></span>' : "") + "</div>"], u, i('<div class="layui-layer-move"></div>')), n
	}, r.pt.creat = function() {
		var t = this,
			e = t.config,
			a = t.index,
			r = e.content,
			d = "object" == typeof r,
			c = i("body");
		if (!e.id || !i("#" + e.id)[0]) {
			switch ("string" == typeof e.area && (e.area = "auto" === e.area ? ["", ""] : [e.area, ""]), e.shift && (e.anim = e.shift), 6 == o.ie && (e.fixed = !1), e.type) {
			case 0:
				e.btn = "btn" in e ? e.btn : s.btn[0], o.closeAll("dialog");
				break;
			case 2:
				var r = e.content = d ? e.content : [e.content, "auto"];
				e.content = '<iframe scrolling="' + (e.content[1] || "auto") + '" allowtransparency="true" id="' + l[4] + a + '" name="' + l[4] + a + '" onload="this.className=\'\';" class="layui-layer-load" frameborder="0" src="' + e.content[0] + '"></iframe>';
				break;
			case 3:
				delete e.title, delete e.closeBtn, -1 === e.icon && e.icon, o.closeAll("loading");
				break;
			case 4:
				d || (e.content = [e.content, "body"]), e.follow = e.content[1], e.content = e.content[0] + '<i class="layui-layer-TipsG"></i>', delete e.title, e.tips = "object" == typeof e.tips ? e.tips : [e.tips, !0], e.tipsMore || o.closeAll("tips")
			}
			t.vessel(d, function(n, o, u) {
				c.append(n[0]), d ?
				function() {
					2 == e.type || 4 == e.type ?
					function() {
						i("body").append(n[1])
					}() : function() {
						r.parents("." + l[0])[0] || (r.data("display", r.css("display")).show().addClass("layui-layer-wrap").wrap(n[1]), i("#" + l[0] + a).find("." + l[5]).before(o))
					}()
				}() : c.append(n[1]), i(".layui-layer-move")[0] || c.append(s.moveElem = u), t.layero = i("#" + l[0] + a), e.scrollbar || l.html.css("overflow", "hidden").attr("layer-full", a)
			}).auto(a), 2 == e.type && 6 == o.ie && t.layero.find("iframe").attr("src", r[0]), 4 == e.type ? t.tips() : t.offset(), e.fixed && n.on("resize", function() {
				t.offset(), (/^\d+%$/.test(e.area[0]) || /^\d+%$/.test(e.area[1])) && t.auto(a), 4 == e.type && t.tips()
			}), e.time <= 0 || setTimeout(function() {
				o.close(t.index)
			}, e.time), t.move().callback(), l.anim[e.anim] && t.layero.addClass(l.anim[e.anim]), e.isOutAnim && t.layero.data("isOutAnim", !0)
		}
	}, r.pt.auto = function(t) {
		function e(t) {
			t = r.find(t), t.height(d[1] - c - u - 2 * (0 | parseFloat(t.css("padding-top"))))
		}
		var a = this,
			s = a.config,
			r = i("#" + l[0] + t);
		"" === s.area[0] && s.maxWidth > 0 && (o.ie && o.ie < 8 && s.btn && r.width(r.innerWidth()), r.outerWidth() > s.maxWidth && r.width(s.maxWidth));
		var d = [r.innerWidth(), r.innerHeight()],
			c = r.find(l[1]).outerHeight() || 0,
			u = r.find("." + l[6]).outerHeight() || 0;
		switch (s.type) {
		case 2:
			e("iframe");
			break;
		default:
			"" === s.area[1] ? s.fixed && d[1] >= n.height() && (d[1] = n.height(), e("." + l[5])) : e("." + l[5])
		}
		return a
	}, r.pt.offset = function() {
		var t = this,
			e = t.config,
			i = t.layero,
			a = [i.outerWidth(), i.outerHeight()],
			s = "object" == typeof e.offset;
		t.offsetTop = (n.height() - a[1]) / 2, t.offsetLeft = (n.width() - a[0]) / 2, s ? (t.offsetTop = e.offset[0], t.offsetLeft = e.offset[1] || t.offsetLeft) : "auto" !== e.offset && ("t" === e.offset ? t.offsetTop = 0 : "r" === e.offset ? t.offsetLeft = n.width() - a[0] : "b" === e.offset ? t.offsetTop = n.height() - a[1] : "l" === e.offset ? t.offsetLeft = 0 : "lt" === e.offset ? (t.offsetTop = 0, t.offsetLeft = 0) : "lb" === e.offset ? (t.offsetTop = n.height() - a[1], t.offsetLeft = 0) : "rt" === e.offset ? (t.offsetTop = 0, t.offsetLeft = n.width() - a[0]) : "rb" === e.offset ? (t.offsetTop = n.height() - a[1], t.offsetLeft = n.width() - a[0]) : t.offsetTop = e.offset), e.fixed || (t.offsetTop = /%$/.test(t.offsetTop) ? n.height() * parseFloat(t.offsetTop) / 100 : parseFloat(t.offsetTop), t.offsetLeft = /%$/.test(t.offsetLeft) ? n.width() * parseFloat(t.offsetLeft) / 100 : parseFloat(t.offsetLeft), t.offsetTop += n.scrollTop(), t.offsetLeft += n.scrollLeft()), i.attr("minLeft") && (t.offsetTop = n.height() - (i.find(l[1]).outerHeight() || 0), t.offsetLeft = i.css("left")), i.css({
			top: t.offsetTop,
			left: t.offsetLeft
		})
	}, r.pt.tips = function() {
		var t = this,
			e = t.config,
			a = t.layero,
			s = [a.outerWidth(), a.outerHeight()],
			o = i(e.follow);
		o[0] || (o = i("body"));
		var r = {
			width: o.outerWidth(),
			height: o.outerHeight(),
			top: o.offset().top,
			left: o.offset().left
		},
			d = a.find(".layui-layer-TipsG"),
			c = e.tips[0];
		e.tips[1] || d.remove(), r.autoLeft = function() {
			r.left + s[0] - n.width() > 0 ? (r.tipLeft = r.left + r.width - s[0], d.css({
				right: 12,
				left: "auto"
			})) : r.tipLeft = r.left
		}, r.where = [function() {
			r.autoLeft(), r.tipTop = r.top - s[1] - 10, d.removeClass("layui-layer-TipsB").addClass("layui-layer-TipsT").css("border-right-color", e.tips[1])
		}, function() {
			r.tipLeft = r.left + r.width + 10, r.tipTop = r.top, d.removeClass("layui-layer-TipsL").addClass("layui-layer-TipsR").css("border-bottom-color", e.tips[1])
		}, function() {
			r.autoLeft(), r.tipTop = r.top + r.height + 10, d.removeClass("layui-layer-TipsT").addClass("layui-layer-TipsB").css("border-right-color", e.tips[1])
		}, function() {
			r.tipLeft = r.left - s[0] - 10, r.tipTop = r.top, d.removeClass("layui-layer-TipsR").addClass("layui-layer-TipsL").css("border-bottom-color", e.tips[1])
		}], r.where[c - 1](), 1 === c ? r.top - (n.scrollTop() + s[1] + 16) < 0 && r.where[2]() : 2 === c ? n.width() - (r.left + r.width + s[0] + 16) > 0 || r.where[3]() : 3 === c ? r.top - n.scrollTop() + r.height + s[1] + 16 - n.height() > 0 && r.where[0]() : 4 === c && s[0] + 16 - r.left > 0 && r.where[1](), a.find("." + l[5]).css({
			"background-color": e.tips[1],
			"padding-right": e.closeBtn ? "30px" : ""
		}), a.css({
			left: r.tipLeft - (e.fixed ? n.scrollLeft() : 0),
			top: r.tipTop - (e.fixed ? n.scrollTop() : 0)
		})
	}, r.pt.move = function() {
		var t = this,
			e = t.config,
			a = i(document),
			r = t.layero,
			l = r.find(e.move),
			d = r.find(".layui-layer-resize"),
			c = {};
		return e.move && l.css("cursor", "move"), l.on("mousedown", function(t) {
			t.preventDefault(), e.move && (c.moveStart = !0, c.offset = [t.clientX - parseFloat(r.css("left")), t.clientY - parseFloat(r.css("top"))], s.moveElem.css("cursor", "move").show())
		}), d.on("mousedown", function(t) {
			t.preventDefault(), c.resizeStart = !0, c.offset = [t.clientX, t.clientY], c.area = [r.outerWidth(), r.outerHeight()], s.moveElem.css("cursor", "se-resize").show()
		}), a.on("mousemove", function(i) {
			if (c.moveStart) {
				var a = i.clientX - c.offset[0],
					s = i.clientY - c.offset[1],
					l = "fixed" === r.css("position");
				if (i.preventDefault(), c.stX = l ? 0 : n.scrollLeft(), c.stY = l ? 0 : n.scrollTop(), !e.moveOut) {
					var d = n.width() - r.outerWidth() + c.stX,
						u = n.height() - r.outerHeight() + c.stY;
					a < c.stX && (a = c.stX), a > d && (a = d), s < c.stY && (s = c.stY), s > u && (s = u)
				}
				r.css({
					left: a,
					top: s
				})
			}
			if (e.resize && c.resizeStart) {
				var a = i.clientX - c.offset[0],
					s = i.clientY - c.offset[1];
				i.preventDefault(), o.style(t.index, {
					width: c.area[0] + a,
					height: c.area[1] + s
				}), c.isResize = !0, e.resizing && e.resizing(r)
			}
		}).on("mouseup", function(t) {
			c.moveStart && (delete c.moveStart, s.moveElem.hide(), e.moveEnd && e.moveEnd(r)), c.resizeStart && (delete c.resizeStart, s.moveElem.hide())
		}), t
	}, r.pt.callback = function() {
		function t() {
			!1 === (a.cancel && a.cancel(e.index, n)) || o.close(e.index)
		}
		var e = this,
			n = e.layero,
			a = e.config;
		e.openLayer(), a.success && (2 == a.type ? n.find("iframe").on("load", function() {
			a.success(n, e.index)
		}) : a.success(n, e.index)), 6 == o.ie && e.IE6(n), n.find("." + l[6]).children("a").on("click", function() {
			var t = i(this).index();
			0 === t ? a.yes ? a.yes(e.index, n) : a.btn1 ? a.btn1(e.index, n) : o.close(e.index) : !1 === (a["btn" + (t + 1)] && a["btn" + (t + 1)](e.index, n)) || o.close(e.index)
		}), n.find("." + l[7]).on("click", t), a.shadeClose && i("#layui-layer-shade" + e.index).on("click", function() {
			o.close(e.index)
		}), n.find(".layui-layer-min").on("click", function() {
			!1 === (a.min && a.min(n)) || o.min(e.index, a)
		}), n.find(".layui-layer-max").on("click", function() {
			i(this).hasClass("layui-layer-maxmin") ? (o.restore(e.index), a.restore && a.restore(n)) : (o.full(e.index, a), setTimeout(function() {
				a.full && a.full(n)
			}, 100))
		}), a.end && (s.end[e.index] = a.end)
	}, s.reselect = function() {
		i.each(i("select"), function(t, e) {
			var n = i(this);
			n.parents("." + l[0])[0] || 1 == n.attr("layer") && i("." + l[0]).length < 1 && n.removeAttr("layer").show(), n = null
		})
	}, r.pt.IE6 = function(t) {
		i("select").each(function(t, e) {
			var n = i(this);
			n.parents("." + l[0])[0] || "none" === n.css("display") || n.attr({
				layer: "1"
			}).hide(), n = null
		})
	}, r.pt.openLayer = function() {
		var t = this;
		o.zIndex = t.config.zIndex, o.setTop = function(t) {
			var e = function() {
					o.zIndex++, t.css("z-index", o.zIndex + 1)
				};
			return o.zIndex = parseInt(t[0].style.zIndex), t.on("mousedown", e), o.zIndex
		}
	}, s.record = function(t) {
		var e = [t.width(), t.height(), t.position().top, t.position().left + parseFloat(t.css("margin-left"))];
		t.find(".layui-layer-max").addClass("layui-layer-maxmin"), t.attr({
			area: e
		})
	}, s.rescollbar = function(t) {
		l.html.attr("layer-full") == t && (l.html[0].style.removeProperty ? l.html[0].style.removeProperty("overflow") : l.html[0].style.removeAttribute("overflow"), l.html.removeAttr("layer-full"))
	}, t.layer = o, o.getChildFrame = function(t, e) {
		return e = e || i("." + l[4]).attr("times"), i("#" + l[0] + e).find("iframe").contents().find(t)
	}, o.getFrameIndex = function(t) {
		return i("#" + t).parents("." + l[4]).attr("times")
	}, o.iframeAuto = function(t) {
		if (t) {
			var e = o.getChildFrame("html", t).outerHeight(),
				n = i("#" + l[0] + t),
				a = n.find(l[1]).outerHeight() || 0,
				s = n.find("." + l[6]).outerHeight() || 0;
			n.css({
				height: e + a + s
			}), n.find("iframe").css({
				height: e
			})
		}
	}, o.iframeSrc = function(t, e) {
		i("#" + l[0] + t).find("iframe").attr("src", e)
	}, o.style = function(t, e, n) {
		var a = i("#" + l[0] + t),
			o = a.find(".layui-layer-content"),
			r = a.attr("type"),
			d = a.find(l[1]).outerHeight() || 0,
			c = a.find("." + l[6]).outerHeight() || 0;
		a.attr("minLeft"), r !== s.type[3] && r !== s.type[4] && (n || (parseFloat(e.width) <= 260 && (e.width = 260), parseFloat(e.height) - d - c <= 64 && (e.height = 64 + d + c)), a.css(e), c = a.find("." + l[6]).outerHeight(), r === s.type[2] ? a.find("iframe").css({
			height: parseFloat(e.height) - d - c
		}) : o.css({
			height: parseFloat(e.height) - d - c - parseFloat(o.css("padding-top")) - parseFloat(o.css("padding-bottom"))
		}))
	}, o.min = function(t, e) {
		var a = i("#" + l[0] + t),
			r = a.find(l[1]).outerHeight() || 0,
			d = a.attr("minLeft") || 181 * s.minIndex + "px",
			c = a.css("position");
		s.record(a), s.minLeft[0] && (d = s.minLeft[0], s.minLeft.shift()), a.attr("position", c), o.style(t, {
			width: 180,
			height: r,
			left: d,
			top: n.height() - r,
			position: "fixed",
			overflow: "hidden"
		}, !0), a.find(".layui-layer-min").hide(), "page" === a.attr("type") && a.find(l[4]).hide(), s.rescollbar(t), a.attr("minLeft") || s.minIndex++, a.attr("minLeft", d)
	}, o.restore = function(t) {
		var e = i("#" + l[0] + t),
			n = e.attr("area").split(",");
		e.attr("type"), o.style(t, {
			width: parseFloat(n[0]),
			height: parseFloat(n[1]),
			top: parseFloat(n[2]),
			left: parseFloat(n[3]),
			position: e.attr("position"),
			overflow: "visible"
		}, !0), e.find(".layui-layer-max").removeClass("layui-layer-maxmin"), e.find(".layui-layer-min").show(), "page" === e.attr("type") && e.find(l[4]).show(), s.rescollbar(t)
	}, o.full = function(t) {
		var e, a = i("#" + l[0] + t);
		s.record(a), l.html.attr("layer-full") || l.html.css("overflow", "hidden").attr("layer-full", t), clearTimeout(e), e = setTimeout(function() {
			var e = "fixed" === a.css("position");
			o.style(t, {
				top: e ? 0 : n.scrollTop(),
				left: e ? 0 : n.scrollLeft(),
				width: n.width(),
				height: n.height()
			}, !0), a.find(".layui-layer-min").hide()
		}, 100)
	}, o.title = function(t, e) {
		i("#" + l[0] + (e || o.index)).find(l[1]).html(t)
	}, o.close = function(t) {
		var e = i("#" + l[0] + t),
			n = e.attr("type");
		if (e[0]) {
			var a = "layui-layer-wrap",
				r = function() {
					if (n === s.type[1] && "object" === e.attr("conType")) {
						e.children(":not(." + l[5] + ")").remove();
						for (var o = e.find("." + a), r = 0; r < 2; r++) o.unwrap();
						o.css("display", o.data("display")).removeClass(a)
					} else {
						if (n === s.type[2]) try {
							var d = i("#" + l[4] + t)[0];
							d.contentWindow.document.write(""), d.contentWindow.close(), e.find("." + l[5])[0].removeChild(d)
						} catch (t) {}
						e[0].innerHTML = "", e.remove()
					}
					"function" == typeof s.end[t] && s.end[t](), delete s.end[t]
				};
			e.data("isOutAnim") && e.addClass("layer-anim-close"), i("#layui-layer-moves, #layui-layer-shade" + t).remove(), 6 == o.ie && s.reselect(), s.rescollbar(t), e.attr("minLeft") && (s.minIndex--, s.minLeft.push(e.attr("minLeft"))), o.ie && o.ie < 10 || !e.data("isOutAnim") ? r() : setTimeout(function() {
				r()
			}, 200)
		}
	}, o.closeAll = function(t) {
		i.each(i("." + l[0]), function() {
			var e = i(this),
				n = t ? e.attr("type") === t : 1;
			n && o.close(e.attr("times")), n = null
		})
	};
	var d = o.cache || {},
		c = function(t) {
			return d.skin ? " " + d.skin + " " + d.skin + "-" + t : ""
		};
	o.prompt = function(t, e) {
		var a = "";
		if (t = t || {}, "function" == typeof t && (e = t), t.area) {
			var s = t.area;
			a = 'style="width: ' + s[0] + "; height: " + s[1] + ';"', delete t.area
		}
		var r, l = 2 == t.formType ? '<textarea class="layui-layer-input"' + a + ">" + (t.value || "") + "</textarea>" : function() {
				return '<input type="' + (1 == t.formType ? "password" : "text") + '" class="layui-layer-input" value="' + (t.value || "") + '">'
			}(),
			d = t.success;
		return delete t.success, o.open(i.extend({
			type: 1,
			btn: ["&#x786E;&#x5B9A;", "&#x53D6;&#x6D88;"],
			content: l,
			skin: "layui-layer-prompt" + c("prompt"),
			maxWidth: n.width(),
			success: function(t) {
				r = t.find(".layui-layer-input"), r.focus(), "function" == typeof d && d(t)
			},
			resize: !1,
			yes: function(i) {
				var n = r.val();
				"" === n ? r.focus() : n.length > (t.maxlength || 500) ? o.tips("&#x6700;&#x591A;&#x8F93;&#x5165;" + (t.maxlength || 500) + "&#x4E2A;&#x5B57;&#x6570;", r, {
					tips: 1
				}) : e && e(n, i, r)
			}
		}, t))
	}, o.tab = function(t) {
		t = t || {};
		var e = t.tab || {},
			n = t.success;
		return delete t.success, o.open(i.extend({
			type: 1,
			skin: "layui-layer-tab" + c("tab"),
			resize: !1,
			title: function() {
				var t = e.length,
					i = 1,
					n = "";
				if (t > 0) for (n = '<span class="layui-layer-tabnow">' + e[0].title + "</span>"; i < t; i++) n += "<span>" + e[i].title + "</span>";
				return n
			}(),
			content: '<ul class="layui-layer-tabmain">' +
			function() {
				var t = e.length,
					i = 1,
					n = "";
				if (t > 0) for (n = '<li class="layui-layer-tabli xubox_tab_layer">' + (e[0].content || "no content") + "</li>"; i < t; i++) n += '<li class="layui-layer-tabli">' + (e[i].content || "no  content") + "</li>";
				return n
			}() + "</ul>",
			success: function(e) {
				var a = e.find(".layui-layer-title").children(),
					s = e.find(".layui-layer-tabmain").children();
				a.on("mousedown", function(e) {
					e.stopPropagation ? e.stopPropagation() : e.cancelBubble = !0;
					var n = i(this),
						a = n.index();
					n.addClass("layui-layer-tabnow").siblings().removeClass("layui-layer-tabnow"), s.eq(a).show().siblings().hide(), "function" == typeof t.change && t.change(a)
				}), "function" == typeof n && n(e)
			}
		}, t))
	}, o.photos = function(e, n, a) {
		var s = {};
		if (e = e || {}, e.photos) {
			var r = e.photos.constructor === Object,
				l = r ? e.photos : {},
				d = l.data || [],
				u = l.start || 0;
			s.imgIndex = 1 + (0 | u), e.img = e.img || "img";
			var h = e.success;
			if (delete e.success, r) {
				if (0 === d.length) return o.msg("&#x6CA1;&#x6709;&#x56FE;&#x7247;")
			} else {
				var p = i(e.photos),
					f = function() {
						d = [], p.find(e.img).each(function(t) {
							var e = i(this);
							e.attr("layer-index", t), d.push({
								alt: e.attr("alt"),
								pid: e.attr("layer-pid"),
								src: e.attr("layer-src") || e.attr("src"),
								thumb: e.attr("src")
							})
						})
					};
				if (f(), 0 === d.length) return;
				if (n || p.on("click", e.img, function() {
					var t = i(this),
						n = t.attr("layer-index");
					o.photos(i.extend(e, {
						photos: {
							start: n,
							data: d,
							tab: e.tab
						},
						full: e.full
					}), !0), f()
				}), !n) return
			}
			s.imgprev = function(t) {
				s.imgIndex--, s.imgIndex < 1 && (s.imgIndex = d.length), s.tabimg(t)
			}, s.imgnext = function(t, e) {
				++s.imgIndex > d.length && (s.imgIndex = 1, e) || s.tabimg(t)
			}, s.keyup = function(t) {
				if (!s.end) {
					var e = t.keyCode;
					t.preventDefault(), 37 === e ? s.imgprev(!0) : 39 === e ? s.imgnext(!0) : 27 === e && o.close(s.index)
				}
			}, s.tabimg = function(t) {
				if (!(d.length <= 1)) return l.start = s.imgIndex - 1, o.close(s.index), o.photos(e, !0, t)
			}, s.event = function() {
				s.bigimg.hover(function() {
					s.imgsee.show()
				}, function() {
					s.imgsee.hide()
				}), s.bigimg.find(".layui-layer-imgprev").on("click", function(t) {
					t.preventDefault(), s.imgprev()
				}), s.bigimg.find(".layui-layer-imgnext").on("click", function(t) {
					t.preventDefault(), s.imgnext()
				}), i(document).on("keyup", s.keyup)
			}, s.loadi = o.load(1, {
				shade: !("shade" in e) && .9,
				scrollbar: !1
			}), function(t, e, i) {
				var n = new Image;
				n.src = t, n.complete ? e(n) : (n.onload = function() {
					n.onload = null, e(n)
				}, n.onerror = function(t) {
					n.onerror = null, i()
				})
			}(d[u].src, function(n) {
				o.close(s.loadi), s.index = o.open(i.extend({
					type: 1,
					id: "layui-layer-photos",
					area: function() {
						var a = [n.width, n.height],
							s = [i(t).width() - 100, i(t).height() - 100];
						if (!e.full && (a[0] > s[0] || a[1] > s[1])) {
							var o = [a[0] / s[0], a[1] / s[1]];
							o[0] > o[1] ? (a[0] = a[0] / o[0], a[1] = a[1] / o[0]) : o[0] < o[1] && (a[0] = a[0] / o[1], a[1] = a[1] / o[1])
						}
						return [a[0] + "px", a[1] + "px"]
					}(),
					title: !1,
					shade: .9,
					shadeClose: !0,
					closeBtn: !1,
					move: ".layui-layer-phimg img",
					moveType: 1,
					scrollbar: !1,
					moveOut: !0,
					isOutAnim: !1,
					skin: "layui-layer-photos" + c("photos"),
					content: '<div class="layui-layer-phimg"><img src="' + d[u].src + '" alt="' + (d[u].alt || "") + '" layer-pid="' + d[u].pid + '"><div class="layui-layer-imgsee">' + (d.length > 1 ? '<span class="layui-layer-imguide"><a href="javascript:;" class="layui-layer-iconext layui-layer-imgprev"></a><a href="javascript:;" class="layui-layer-iconext layui-layer-imgnext"></a></span>' : "") + '<div class="layui-layer-imgbar" style="display:' + (a ? "block" : "") + '"><span class="layui-layer-imgtit"><a href="javascript:;">' + (d[u].alt || "") + "</a><em>" + s.imgIndex + "/" + d.length + "</em></span></div></div></div>",
					success: function(t, i) {
						s.bigimg = t.find(".layui-layer-phimg"), s.imgsee = t.find(".layui-layer-imguide,.layui-layer-imgbar"), s.event(t), e.tab && e.tab(d[u], t), "function" == typeof h && h(t)
					},
					end: function() {
						s.end = !0, i(document).off("keyup", s.keyup)
					}
				}, e))
			}, function() {
				o.close(s.loadi), o.msg("&#x5F53;&#x524D;&#x56FE;&#x7247;&#x5730;&#x5740;&#x5F02;&#x5E38;<br>&#x662F;&#x5426;&#x7EE7;&#x7EED;&#x67E5;&#x770B;&#x4E0B;&#x4E00;&#x5F20;&#xFF1F;", {
					time: 3e4,
					btn: ["&#x4E0B;&#x4E00;&#x5F20;", "&#x4E0D;&#x770B;&#x4E86;"],
					yes: function() {
						d.length > 1 && s.imgnext(!0, !0)
					}
				})
			})
		}
	}, s.run = function(e) {
		i = e, n = i(t), l.html = i("html"), o.open = function(t) {
			return new r(t).index
		}
	}, t.layui && layui.define ? (o.ready(), layui.define("jquery", function(e) {
		o.path = layui.cache.dir, s.run(layui.jquery), t.layer = o, e("layer", o)
	})) : "function" == typeof define && define.amd ? define(["jquery"], function() {
		return s.run(t.jQuery), o
	}) : function() {
		s.run(t.jQuery), o.ready()
	}()
}(window);
var layerPop = function() {
		var t = {};
		return t.openLoading = function(t) {
			layer.open({
				type: 3,
				content: '<div class="layer_loading"><span class="gif"></span><span class="text">' + t + "</span></div>",
				shade: 0
			})
		}, t.openTips = function(t, e) {
			e = e || 3e3, t = t || "??????", layer.open({
				type: 3,
				content: '<div id="tips"><span class="ok"></span><span class="text">' + t + "</span></div>",
				shade: 0,
				time: e
			})
		}, t.openEmptyTips = t.openTextTips = function(t, e) {
			e = e || 3e3, t = t || "??????", layer.open({
				type: 3,
				content: '<div id="emptytips">' + t + "</div>",
				shade: 0,
				time: e
			})
		}, t.openDoubleTips = function(t, e, i) {
			i = i || 3e3, t = t || "??????", e = e || "??????", layer.open({
				type: 3,
				content: '<div id="DoubleTips"><span class="ok"></span><div class="text"><p class="text1">' + t + '</p><p class="text2">' + e + "</p></div></div>",
				shade: 0,
				time: i
			})
		}, t.openErrTips = function(t, e) {
			e = e || 1e6, t = t || "????????????????????????", layer.open({
				type: 3,
				content: '<div id="errtips"><p>??????????????????????????????</p><p>??????????????????????????????010-9999999</p><div class="close"></div></div>',
				shade: 0,
				time: e
			})
		}, t.close = function() {
			layer.closeAll()
		}, t
	}();
(function(t) {
	t.fn.slide = function(e) {
		return t.fn.slide.defaults = {
			effect: "fade",
			autoPlay: !1,
			delayTime: 500,
			interTime: 2500,
			triggerTime: 150,
			defaultIndex: 0,
			titCell: ".hd li",
			mainCell: ".bd",
			targetCell: null,
			trigger: "mouseover",
			scroll: 1,
			vis: 1,
			titOnClassName: "on",
			autoPage: !1,
			prevCell: ".prev",
			nextCell: ".next",
			pageStateCell: ".pageState",
			opp: !1,
			pnLoop: !0,
			easing: "linear",
			startFun: null,
			endFun: null,
			switchLoad: null
		}, this.each(function() {
			var i = t.extend({}, t.fn.slide.defaults, e),
				n = i.effect,
				a = t(i.prevCell, t(this)),
				s = t(i.nextCell, t(this)),
				o = t(i.pageStateCell, t(this)),
				r = t(i.titCell, t(this)),
				l = r.size(),
				d = t(i.mainCell, t(this)),
				c = d.children().size(),
				u = i.switchLoad;
			if (null != i.targetCell) var h = t(i.targetCell, t(this));
			var p = parseInt(i.defaultIndex),
				f = parseInt(i.delayTime),
				g = parseInt(i.interTime);
			parseInt(i.triggerTime);
			var v = parseInt(i.scroll),
				m = parseInt(i.vis),
				y = "false" != i.autoPlay && 0 != i.autoPlay,
				b = "false" != i.opp && 0 != i.opp,
				x = "false" != i.autoPage && 0 != i.autoPage,
				w = "false" != i.pnLoop && 0 != i.pnLoop,
				S = 0,
				C = 0,
				T = 0,
				A = 0,
				k = i.easing,
				I = null,
				P = p;
			if (0 == l && (l = c), x) {
				var M = c - m;
				l = 1 + parseInt(0 != M % v ? M / v + 1 : M / v), 0 >= l && (l = 1), r.html("");
				for (var E = 0; l > E; E++) r.append("<li>" + (E + 1) + "</li>");
				var r = t("li", r)
			}
			if (d.children().each(function() {
				t(this).width() > T && (T = t(this).width(), C = t(this).outerWidth(!0)), t(this).height() > A && (A = t(this).height(), S = t(this).outerHeight(!0))
			}), c >= m) switch (n) {
			case "fold":
				d.css({
					position: "relative",
					width: C,
					height: S
				}).children().css({
					position: "absolute",
					width: T,
					left: 0,
					top: 0,
					display: "none"
				});
				break;
			case "top":
				d.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; height:' + m * S + 'px"></div>').css({
					position: "relative",
					padding: "0",
					margin: "0"
				}).children().css({
					height: A
				});
				break;
			case "left":
				d.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; width:' + m * C + 'px"></div>').css({
					width: c * C,
					position: "relative",
					overflow: "hidden",
					padding: "0",
					margin: "0"
				}).children().css({
					float: "left",
					width: T
				});
				break;
			case "leftLoop":
			case "leftMarquee":
				d.children().clone().appendTo(d).clone().prependTo(d), d.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; width:' + m * C + 'px"></div>').css({
					width: 3 * c * C,
					position: "relative",
					overflow: "hidden",
					padding: "0",
					margin: "0",
					left: -c * C
				}).children().css({
					float: "left",
					width: T
				});
				break;
			case "topLoop":
			case "topMarquee":
				d.children().clone().appendTo(d).clone().prependTo(d), d.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; height:' + m * S + 'px"></div>').css({
					height: 3 * c * S,
					position: "relative",
					padding: "0",
					margin: "0",
					top: -c * S
				}).children().css({
					height: A
				})
			}
			var L = function() {
					t.isFunction(i.startFun) && i.startFun(p, l)
				},
				F = function() {
					t.isFunction(i.endFun) && i.endFun(p, l)
				},
				z = function(e) {
					e.eq(p).find("img").each(function() {
						void 0 !== t(this).attr(u) && t(this).attr("src", t(this).attr(u)).removeAttr(u)
					})
				},
				N = function(t) {
					if (P != p || t || "leftMarquee" == n || "topMarquee" == n) {
						switch (n) {
						case "fade":
						case "fold":
						case "top":
						case "left":
							p >= l ? p = 0 : 0 > p && (p = l - 1);
							break;
						case "leftMarquee":
						case "topMarquee":
							p >= 1 ? p = 1 : 0 >= p && (p = 0);
							break;
						case "leftLoop":
						case "topLoop":
							var e = p - P;
							l > 2 && e == -(l - 1) && (e = 1), l > 2 && e == l - 1 && (e = -1);
							var g = Math.abs(e * v);
							p >= l ? p = 0 : 0 > p && (p = l - 1)
						}
						if (L(), null != u && z(d.children()), h && (null != u && z(h), h.hide().eq(p).animate({
							opacity: "show"
						}, f, function() {
							d[0] || F()
						})), c >= m) switch (n) {
						case "fade":
							d.children().stop(!0, !0).eq(p).animate({
								opacity: "show"
							}, f, k, function() {
								F()
							}).siblings().hide();
							break;
						case "fold":
							d.children().stop(!0, !0).eq(p).animate({
								opacity: "show"
							}, f, k, function() {
								F()
							}).siblings().animate({
								opacity: "hide"
							}, f, k);
							break;
						case "top":
							d.stop(!0, !1).animate({
								top: -p * v * S
							}, f, k, function() {
								F()
							});
							break;
						case "left":
							d.stop(!0, !1).animate({
								left: -p * v * C
							}, f, k, function() {
								F()
							});
							break;
						case "leftLoop":
							0 > e ? d.stop(!0, !0).animate({
								left: -(c - g) * C
							}, f, k, function() {
								for (var t = 0; g > t; t++) d.children().last().prependTo(d);
								d.css("left", -c * C), F()
							}) : d.stop(!0, !0).animate({
								left: -(c + g) * C
							}, f, k, function() {
								for (var t = 0; g > t; t++) d.children().first().appendTo(d);
								d.css("left", -c * C), F()
							});
							break;
						case "topLoop":
							0 > e ? d.stop(!0, !0).animate({
								top: -(c - g) * S
							}, f, k, function() {
								for (var t = 0; g > t; t++) d.children().last().prependTo(d);
								d.css("top", -c * S), F()
							}) : d.stop(!0, !0).animate({
								top: -(c + g) * S
							}, f, k, function() {
								for (var t = 0; g > t; t++) d.children().first().appendTo(d);
								d.css("top", -c * S), F()
							});
							break;
						case "leftMarquee":
							var y = d.css("left").replace("px", "");
							0 == p ? d.animate({
								left: ++y
							}, 0, function() {
								if (d.css("left").replace("px", "") >= 0) {
									for (var t = 0; c > t; t++) d.children().last().prependTo(d);
									d.css("left", -c * C)
								}
							}) : d.animate({
								left: --y
							}, 0, function() {
								if (2 * -c * C >= d.css("left").replace("px", "")) {
									for (var t = 0; c > t; t++) d.children().first().appendTo(d);
									d.css("left", -c * C)
								}
							});
							break;
						case "topMarquee":
							var b = d.css("top").replace("px", "");
							0 == p ? d.animate({
								top: ++b
							}, 0, function() {
								if (d.css("top").replace("px", "") >= 0) {
									for (var t = 0; c > t; t++) d.children().last().prependTo(d);
									d.css("top", -c * S)
								}
							}) : d.animate({
								top: --b
							}, 0, function() {
								if (2 * -c * S >= d.css("top").replace("px", "")) {
									for (var t = 0; c > t; t++) d.children().first().appendTo(d);
									d.css("top", -c * S)
								}
							})
						}
						r.removeClass(i.titOnClassName).eq(p).addClass(i.titOnClassName), P = p, 0 == w && (s.removeClass("nextStop"), a.removeClass("prevStop"), 0 == p ? a.addClass("prevStop") : p == l - 1 && s.addClass("nextStop")), o.html("<span>" + (p + 1) + "</span>/" + l)
					}
				};
			N(!0), y && ("leftMarquee" == n || "topMarquee" == n ? (b ? p-- : p++, I = setInterval(N, g), d.hover(function() {
				y && clearInterval(I)
			}, function() {
				y && (clearInterval(I), I = setInterval(N, g))
			})) : (I = setInterval(function() {
				b ? p-- : p++, N()
			}, g), t(this).hover(function() {
				y && clearInterval(I)
			}, function() {
				y && (clearInterval(I), I = setInterval(function() {
					b ? p-- : p++, N()
				}, g))
			})));
			var q;
			"mouseover" == i.trigger ? r.hover(function() {
				p = r.index(this), q = window.setTimeout(N, i.triggerTime)
			}, function() {
				clearTimeout(q)
			}) : r.click(function() {
				p = r.index(this), N()
			}), s.click(function() {
				(1 == w || p != l - 1) && (p++, N())
			}), a.click(function() {
				(1 == w || 0 != p) && (p--, N())
			})
		})
	}
})(jQuery), jQuery.easing.jswing = jQuery.easing.swing, jQuery.extend(jQuery.easing, {
	def: "easeOutQuad",
	swing: function(t, e, i, n, a) {
		return jQuery.easing[jQuery.easing.def](t, e, i, n, a)
	},
	easeInQuad: function(t, e, i, n, a) {
		return n * (e /= a) * e + i
	},
	easeOutQuad: function(t, e, i, n, a) {
		return -n * (e /= a) * (e - 2) + i
	},
	easeInOutQuad: function(t, e, i, n, a) {
		return 1 > (e /= a / 2) ? n / 2 * e * e + i : -n / 2 * (--e * (e - 2) - 1) + i
	},
	easeInCubic: function(t, e, i, n, a) {
		return n * (e /= a) * e * e + i
	},
	easeOutCubic: function(t, e, i, n, a) {
		return n * ((e = e / a - 1) * e * e + 1) + i
	},
	easeInOutCubic: function(t, e, i, n, a) {
		return 1 > (e /= a / 2) ? n / 2 * e * e * e + i : n / 2 * ((e -= 2) * e * e + 2) + i
	},
	easeInQuart: function(t, e, i, n, a) {
		return n * (e /= a) * e * e * e + i
	},
	easeOutQuart: function(t, e, i, n, a) {
		return -n * ((e = e / a - 1) * e * e * e - 1) + i
	},
	easeInOutQuart: function(t, e, i, n, a) {
		return 1 > (e /= a / 2) ? n / 2 * e * e * e * e + i : -n / 2 * ((e -= 2) * e * e * e - 2) + i
	},
	easeInQuint: function(t, e, i, n, a) {
		return n * (e /= a) * e * e * e * e + i
	},
	easeOutQuint: function(t, e, i, n, a) {
		return n * ((e = e / a - 1) * e * e * e * e + 1) + i
	},
	easeInOutQuint: function(t, e, i, n, a) {
		return 1 > (e /= a / 2) ? n / 2 * e * e * e * e * e + i : n / 2 * ((e -= 2) * e * e * e * e + 2) + i
	},
	easeInSine: function(t, e, i, n, a) {
		return -n * Math.cos(e / a * (Math.PI / 2)) + n + i
	},
	easeOutSine: function(t, e, i, n, a) {
		return n * Math.sin(e / a * (Math.PI / 2)) + i
	},
	easeInOutSine: function(t, e, i, n, a) {
		return -n / 2 * (Math.cos(Math.PI * e / a) - 1) + i
	},
	easeInExpo: function(t, e, i, n, a) {
		return 0 == e ? i : n * Math.pow(2, 10 * (e / a - 1)) + i
	},
	easeOutExpo: function(t, e, i, n, a) {
		return e == a ? i + n : n * (1 - Math.pow(2, -10 * e / a)) + i
	},
	easeInOutExpo: function(t, e, i, n, a) {
		return 0 == e ? i : e == a ? i + n : 1 > (e /= a / 2) ? n / 2 * Math.pow(2, 10 * (e - 1)) + i : n / 2 * (2 - Math.pow(2, -10 * --e)) + i
	},
	easeInCirc: function(t, e, i, n, a) {
		return -n * (Math.sqrt(1 - (e /= a) * e) - 1) + i
	},
	easeOutCirc: function(t, e, i, n, a) {
		return n * Math.sqrt(1 - (e = e / a - 1) * e) + i
	},
	easeInOutCirc: function(t, e, i, n, a) {
		return 1 > (e /= a / 2) ? -n / 2 * (Math.sqrt(1 - e * e) - 1) + i : n / 2 * (Math.sqrt(1 - (e -= 2) * e) + 1) + i
	},
	easeInElastic: function(t, e, i, n, a) {
		var s = 1.70158,
			o = 0,
			r = n;
		if (0 == e) return i;
		if (1 == (e /= a)) return i + n;
		if (o || (o = .3 * a), Math.abs(n) > r) {
			r = n;
			var s = o / 4
		} else var s = o / (2 * Math.PI) * Math.asin(n / r);
		return -r * Math.pow(2, 10 * (e -= 1)) * Math.sin(2 * (e * a - s) * Math.PI / o) + i
	},
	easeOutElastic: function(t, e, i, n, a) {
		var s = 1.70158,
			o = 0,
			r = n;
		if (0 == e) return i;
		if (1 == (e /= a)) return i + n;
		if (o || (o = .3 * a), Math.abs(n) > r) {
			r = n;
			var s = o / 4
		} else var s = o / (2 * Math.PI) * Math.asin(n / r);
		return r * Math.pow(2, -10 * e) * Math.sin(2 * (e * a - s) * Math.PI / o) + n + i
	},
	easeInOutElastic: function(t, e, i, n, a) {
		var s = 1.70158,
			o = 0,
			r = n;
		if (0 == e) return i;
		if (2 == (e /= a / 2)) return i + n;
		if (o || (o = .3 * a * 1.5), Math.abs(n) > r) {
			r = n;
			var s = o / 4
		} else var s = o / (2 * Math.PI) * Math.asin(n / r);
		return 1 > e ? -.5 * r * Math.pow(2, 10 * (e -= 1)) * Math.sin(2 * (e * a - s) * Math.PI / o) + i : .5 * r * Math.pow(2, -10 * (e -= 1)) * Math.sin(2 * (e * a - s) * Math.PI / o) + n + i
	},
	easeInBack: function(t, e, i, n, a, s) {
		return void 0 == s && (s = 1.70158), n * (e /= a) * e * ((s + 1) * e - s) + i
	},
	easeOutBack: function(t, e, i, n, a, s) {
		return void 0 == s && (s = 1.70158), n * ((e = e / a - 1) * e * ((s + 1) * e + s) + 1) + i
	},
	easeInOutBack: function(t, e, i, n, a, s) {
		return void 0 == s && (s = 1.70158), 1 > (e /= a / 2) ? n / 2 * e * e * ((1 + (s *= 1.525)) * e - s) + i : n / 2 * ((e -= 2) * e * ((1 + (s *= 1.525)) * e + s) + 2) + i
	},
	easeInBounce: function(t, e, i, n, a) {
		return n - jQuery.easing.easeOutBounce(t, a - e, 0, n, a) + i
	},
	easeOutBounce: function(t, e, i, n, a) {
		return 1 / 2.75 > (e /= a) ? 7.5625 * n * e * e + i : 2 / 2.75 > e ? n * (7.5625 * (e -= 1.5 / 2.75) * e + .75) + i : 2.5 / 2.75 > e ? n * (7.5625 * (e -= 2.25 / 2.75) * e + .9375) + i : n * (7.5625 * (e -= 2.625 / 2.75) * e + .984375) + i
	},
	easeInOutBounce: function(t, e, i, n, a) {
		return a / 2 > e ? .5 * jQuery.easing.easeInBounce(t, 2 * e, 0, n, a) + i : .5 * jQuery.easing.easeOutBounce(t, 2 * e - a, 0, n, a) + .5 * n + i
	}
}), function() {
	var t, e, i = page_config.sitestate,
		n = "<div class='login-box-pop'>            <span class='closeb'></span>            <form id='loginForm' name='loginForm' method='post' action=''>                <div class='login-box-n'>                    <div class='checkText' id='errInfo'></div>                    <div class='login-box'>                        <div class='field username-field'>                            <input type='text' name='username' id='username' class='login-text login-username' value='' maxlength='32' tabindex='1' placeholder='?????????'>                        </div>                        <div class='field pwd-field'>                            <input type='password' name='password' id='password' autocomplete='off' class='login-text login-password' maxlength='40' tabindex='2' placeholder='??????'>                        </div>                        <div id='ecodebox' class='ecodebox' >                            <div class='input-b fl'>                                <input type='text' maxlength='4' class='codetext' name='checkcode' value='' id='checkcode' placeholder='?????????'>                                <input type='hidden' id='codeHidden' checked name='t' value=''>                            </div>                            <a href='javascript:void(0);' class='change-code fl' style='color:#999'>                                <img id='validateImg' src='/checkcode.php' alt=''>                            </a>                        </div>                        <div class='login-submit'><input type='hidden' name='act' value='login'>                            <input type='button' value='??? ???' class='btn-submit ui_bgcolor' id='btn_submit'>                        </div>                        <div class='login-links'>                            <label class='rememberecod fl'><input type='checkbox' value='on' checked='checked' style='display: none' name='remember'/></label>                            <span class='fr'>                                    <a href='/register.php' class='register-1'>????????????</a>                                    <a href='/getpass.php' class='forget-pwd'>???????????? </a>                                </span>                        </div>                    </div>                    <div class='other-login'>                        <div class='entries'>                            <div class='c-box'>                                <a href='/api/qq/login.php'><span class='icon-login-qq loginicon'></span></a>                                <a href='/api/weixin/login.php'><span class='icon-login-weixin loginicon'></span></a>                                <a href='/api/weibo/login.php'><span class='icon-login-sina loginicon'></span></a>                                <a href='/api/baidu/login.php'><span class='icon-login-baidu loginicon'></span></a>                                <a href='javascript:;'><span class='icon-login-zfb loginicon'></span></a>                            </div>                        </div>                    </div>                </div>            </form>        </div>",
		a = null,
		s = null,
		o = null,
		r = !0,
		l = {
			isShow: !1,
			init: function() {
				this.render(), this.bind()
			},
			render: function() {
				$("body").append(n), 0 == $("#windowbg").length ? $("body").append('<div id="windowbg" style="width: 100%; position: fixed; height: 100%; background: rgb(51, 51, 51);opacity:0.2; left: 0; top: 0; z-index: 100;"></div>') : $("#windowbg").show()
			},
			bind: function() {
				if (checkcodelogin == 1) {
                    $(".ecodebox").addClass("show");
				}
				var t = this;
				a = $(".login-box-pop"), a.find(".closeb").on("click", function() {
					t.hide()
				}), $(".login-box-pop #btn_submit").on("click", function() {
					var e = a.find(".login-username").val(),
						i = /^\s*$/;
					if (i.test(e)) return void a.find(".checkText").html("?????????????????????");
					var n = a.find(".login-password").val();
					if (i.test(n)) return void a.find(".checkText").html("??????????????????");
					t.getAjaxPara(), $(this).val("???????????????"), t.submit()
				}), $(".login-box-pop .change-code").on("click", function() {
					o = Math.random(), $(".change-code img").attr("src", "/checkcode.php?" + o)
				}), $(".login-box-pop .login-text").on("keydown", function(t) {
					13 === t.keyCode && $(".login-box-pop #btn_submit").trigger("click")
				}), $(".login-box-pop .codetext").on("keydown", function(t) {
					13 === t.keyCode && $(".login-box-pop #btn_submit").trigger("click")
				})
			},
			hide: function() {
				this.isShow = !1, $(".login-box-pop").hide(), $("#windowbg").hide(), t.closeFn && t.closeFn()
			},
			show: function() {
				this.isShow = !0, $(".login-box-pop").show(), $("#windowbg").show()
			},
			getAjaxPara: function() {
				s = {
					username: a.find(".login-username").val(),
					password: a.find(".login-password").val(),
                    checkcode : a.find(".codetext").val(),
					act : 'login',
					ajax_gets : 1
				}
			},
			submit: function() {
				$.ajax({
					url: "/login.php",
					data: s,
					type: "POST",
					success: function(e) {
						e = eval(e);
						if (e.success == true) {
                            a.find(".checkText").html(e.message)
                            window.location.href = e.backUrl;
						}
						else{
                            a.find(".checkText").html(e.message);
                            a.find(".ecodebox").addClass("show");
                            $(".login-box-pop .change-code").click();
                            $(".login-box-pop #btn_submit").val("??????");
						}
					}
				})
			}
		};
	window.pop_login = function(i) {
		return e ? (t = i || {}, e.show(), e) : (e = l, t = i || {}, e.init(), e)
	}
}();
var indexSlide = function() {
		this.eleBox, this.eleList, this.elePoints, this.playLock = !1, this.playDuration = 500, this.index = 0, this.eleLength, this.playDwell = 5e3
	};
indexSlide.prototype.play = function() {
	var t = this;
	this.autoPlayInterval = setInterval(function() {
		t.next()
	}, t.playDwell)
}, indexSlide.prototype.go = function(t) {
	var e = this,
		i = e.eleList.children().eq(t);
	e.updateBanner(i), i.fadeIn(e.playDuration), e.eleList.children().not(i).fadeOut(e.playDuration, function() {
		e.playLock = !1
	}), e.updatePoint(t)
}, indexSlide.prototype.next = function() {
	this.playLock || (this.playLock = !0, this.index = (this.index + 1) % this.eleLength, this.go(this.index))
}, indexSlide.prototype.prev = function() {
	this.playLock || (this.playLock = !0, this.index = (this.index - 1 + this.eleLength) % this.eleLength, this.go(this.index))
}, indexSlide.prototype.showBtnAndbind = function() {
	var t = this;
	t.eleBox.find(".slide-next").show().click(function() {
		t.next()
	}), t.eleBox.find(".slide-prev").show().click(function() {
		t.prev()
	}), t.eleBox.mouseenter(function() {
		clearInterval(t.autoPlayInterval)
	}).mouseleave(function() {
		t.play()
	}), t.elePoints.on("click", "a", function(e) {
		t.go($(this).index())
	})
}, indexSlide.prototype.showPoint = function(t) {
	for (var e = [], i = 0; i < this.eleLength; i++) e[i] = '<a href="javascript:;" onclick="return false;"></a>';
	this.elePoints.html(e.join("")).show(), "absolute" == this.elePoints.css("position") && (t |= 0, this.elePoints.css("marginLeft", (t - this.elePoints.outerWidth()) / 2)), this.updatePoint(0)
}, indexSlide.prototype.updatePoint = function(t) {
	this.elePoints.find("a").removeClass("curr-point").eq(t).addClass("curr-point")
}, indexSlide.prototype.updateBanner = function(t) {
	function e(t) {
		return t = t.replace("qhimg", "qhmsg"), -1 == t.indexOf("qhmsg") ? t : window.isSupportWebp ? t.replace(".jpg", ".webp") : t
	}
	t = t ? $(t) : this.eleList.find(".slider-film").eq(0);
	try {
		t.filter(".js-lazyload").trigger("porty"), t.find(".js-lazyload").trigger("porty")
	} catch (n) {
		if (t && t.find("img")) {
			var i = t.find("img");
			i.each(function() {
				var t = $(this);
				t.data("original") && t.attr("src", e(t.data("original"))).removeAttr("data-original")
			})
		}
		t && t.filter(".js-lazyload").length > 0 && t.data("original") && t.css({
			backgroundImage: "url(" + e(t.data("original")) + ")"
		}).removeAttr("data-original")
	}
}, indexSlide.prototype.init = function(t, e, i) {
	this.eleBox = $(t), this.playDwell = e || this.playDwell, this.eleList = this.eleBox.find(".slideBox"), this.eleLength = this.eleList.find(".slider-film").length, this.elePoints = this.eleBox.find(".slide-point"), this.updateBanner(), this.eleList.children().first().show(), this.eleLength > 1 ? (this.showPoint(i), this.showBtnAndbind(), this.play()) : this.eleBox.find(".slide-next,.slide-prev").hide(), this.eleList.find(".js-lazyload").lazyload({
		event: "porty"
	})
}, function(t) {
	if ("object" == typeof exports && "undefined" != typeof module) module.exports = t();
	else if ("function" == typeof define && define.amd) define([], t);
	else {
		var e;
		e = "undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this, e.store = t()
	}
}(function() {
	function t(t) {
		return "object" == typeof t && "[object object]" === Object.prototype.toString.call(t).toLowerCase() && !t.length
	}
	function e(t) {
		return void 0 === t || "function" == typeof t ? t + "" : JSON.stringify(t)
	}
	function i(t) {
		if ("string" == typeof t) try {
			return JSON.parse(t)
		} catch (e) {
			return t || void 0
		}
	}
	function n(t) {
		return "[object Function]" === {}.toString.call(t)
	}
	function a(t) {
		return t instanceof Array
	}
	function s() {
		if (!(this instanceof s)) return new s
	}
	if (window.localStorage) {
		var o, r = window.localStorage,
			l = function() {};
		r = function(t) {
			var e = "_Is_Incognit";
			try {
				t.setItem(e, "yes")
			} catch (e) {
				if ("QuotaExceededError" === e.name) {
					var i = function() {};
					t.__proto__ = {
						setItem: i,
						getItem: i,
						removeItem: i,
						clear: i
					}
				}
			} finally {
				"yes" === t.getItem(e) && t.removeItem(e)
			}
			return t
		}(r), s.prototype = {
			set: function(i, n) {
				if (l("set", i, n), i && !t(i)) r.setItem(i, e(n));
				else if (i && t(i) && !n) for (var a in i) this.set(a, i[a]);
				return this
			},
			get: function(t) {
				if (!t) {
					var e = {};
					return this.forEach(function(t, i) {
						e[t] = i
					}), e
				}
				return "?" === t.charAt(0) ? this.has(t.substr(1)) : i(r.getItem(t))
			},
			clear: function() {
				return this.forEach(function(t, e) {
					l("clear", t, e)
				}), r.clear(), this
			},
			remove: function(t) {
				var e = this.get(t);
				return r.removeItem(t), l("remove", t, e), e
			},
			has: function(t) {
				return {}.hasOwnProperty.call(this.get(), t)
			},
			keys: function() {
				var t = [];
				return this.forEach(function(e, i) {
					t.push(e)
				}), t
			},
			size: function() {
				return this.keys().length
			},
			forEach: function(t) {
				for (var e = 0; e < r.length; e++) {
					var i = r.key(e);
					if (!1 === t(i, this.get(i))) break
				}
				return this
			},
			search: function(t) {
				for (var e = this.keys(), i = {}, n = 0; n < e.length; n++) e[n].indexOf(t) > -1 && (i[e[n]] = this.get(e[n]));
				return i
			},
			onStorage: function(t) {
				return t && n(t) && (l = t), this
			}
		}, o = function(e, i) {
			var r = arguments,
				l = s(),
				d = null;
			if (0 === r.length) return l.get();
			if (1 === r.length) {
				if ("string" == typeof e) return l.get(e);
				if (t(e)) return l.set(e)
			}
			if (2 === r.length && "string" == typeof e) {
				if (!i) return l.remove(e);
				if (i && "string" == typeof i) return l.set(e, i);
				if (i && n(i)) return d = null, d = i(e, l.get(e)), d ? o.set(e, d) : o
			}
			if (2 === r.length && a(e) && n(i)) {
				for (var c = 0; c < e.length; c++) d = i(e[c], l.get(e[c])), o.set(e[c], d);
				return o
			}
		};
		for (var d in s.prototype) o[d] = s.prototype[d];
		return o
	}
});
var topReturn = function(t) {
		1 == t ? ($("body").append('<div class="to_top"></div>'), $("body").find(".to_top").addClass("ui-toTop"), $(window).scroll(function() {
			(document.documentElement.scrollTop || document.body.scrollTop) > 500 ? $(".to_top").fadeIn(300) : $(".to_top").fadeOut(300)
		}), $(".to_top").hover(function() {
			var t = $(".firstnav").css("background-color");
			$(this).addClass("to_top_on").css("background-color", t)
		}, function() {
			$(this).removeClass("to_top_on").css("background-color", "#fff")
		}), $(".to_top").on("click", function() {
			$(document).scrollTop(0)
		})) : $(".to_top").hide()
	};
