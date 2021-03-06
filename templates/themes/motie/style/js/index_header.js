var page_index_header = {
	header: {
		init: function() {
			$(".indexmobile").on("mouseenter", function() {
				$(this).find(".pho-tabs").show()
			}), $(".indexmobile").on("mouseleave", function() {
				$(this).find(".pho-tabs").hide()
			})
		}
	},
	slideUpHd: {
		init: function() {
			var e = this;
			$(".close-btn").click(function() {
				return e.m_slideUp(), !1
			}), setTimeout(e.m_slideUp, 1e4)
		},
		m_slideUp: function() {
			$(".subnav-ad").slideUp(1e3)
		}
	},
	winEvent: {
		init: function() {
			$(window).on("scroll", function() {
				$(document).scrollTop() > 300 ? $("#back-to-top").show() : $("#back-to-top").hide()
			}), $(window).on("click", function() {
				$(".search-list").hide(), page_index_header.recentRead.hide()
			})
		}
	},
	recentRead: {
		showStatus: !1,
		recentDataStatus: !1,
		ajaxNow: !1,
		init: function() {
			var e = this;
			$(".lateread").on("click", function(t) {
				e.showStatus ? e.hide() : e.show(), t.stopPropagation()
			}), $(".lastread_con").on("mouseenter", ".item", function() {
				$(this).find(".continue").addClass("show")
			}).on("mouseleave", ".item", function() {
				$(this).find(".continue").removeClass("show")
			}).on("click", function(e) {
				e.stopPropagation()
			})
		},
		show: function() {
			$(".lastread_box").show(), page_config.userId ? this.getRecentData() : this.showUnlogin(), this.showStatus = !0
		},
		hide: function() {
			this.showStatus = !1, $(".lastread_box").hide()
		},
		getRecentData: function() {
			var e = this;
			e.recentDataStatus || e.ajaxNow || (e.showLoading(), $.ajax({
				url: "/modules/article/bookshelf.php",
				data: {
					ajax_gets: 1
				},
				type: "GET",
				success: function(t) {
					e.recentDataStatus = !0, e.ajaxNow = !1, e.hideLoading(), e.addContent(t)
				},
				error: function() {
					e.ajaxNow = !1
				}
			}))
		},
		showLoading: function() {
			$(".lastread_box .loading").show()
		},
		hideLoading: function() {
			$(".lastread_box .loading").hide()
		},
		showUnlogin: function() {
			$(".lastread_box .unlogin").show()
		},
		hideUnlogin: function() {
			$(".lastread_box .unlogin").hide()
		},
		addContent: function(e) {
			$(".lastread_con").append(e)
		}
	},
	toolBar: {
		init: function() {
			$(window).width() > 1500 ? ($(".rfloat span").addClass("rightSpan"), $(".rfloat, .backtop-box").css("left", "50%")) : ($(window).width() < 1340 && $(".rfloat, .backtop-box").css("left", "45%"), $(".rfloat span").removeClass("rightSpan"))
		}
	}
},
	search = function(e) {
		this.queryString = "", this.lastQueruString = "", this.$search = $(e), this.init()
	};
if (search.prototype = {
	init: function() {
		function e() {
			if (t.queryString = t.$search.find(".searchinput").val().replace(/\s+$/, "").replace(/^\s+/, ""), "" != t.queryString) {
				var e = "/modules/article/search.php?searchtype=all&searchkey=" + t.queryString;
				t.$search.find("form").attr("action", e), location.href = e
			}
		}
		var t = this;
		t.$search.find(".searchinput").on("input", function() {
			return t.lastQueruString = t.queryString, t.queryString = $(this).val().replace(/\s+$/, "").replace(/^\s+/, ""), t.queryString != t.lastQueruString && (t.queryString ? void t.getData() : (t.hide(), !1))
		}), this.$search.find(".searchbtn").on("click", function() {
			e()
		}), t.$search.find(".searchinput").on("keydown", function(t) {
			13 === t.keyCode && e()
		})
	},
	getData: function() {
		var e = this;
		$.ajax({
			url: "/modules/article/search.php",
			data: {
                searchkey: e.queryString,
                searchtype: 'all',
				ajax_gets: 1
			},
			type: "POST",
			success: function(t) {
				e.renderList(t)
			}
		})
	},
	renderList: function(e) {
		var t = this,
			i = "";
		if (!e || !e.book) return i;
		i += "<li>                <a class='product-title' href='/modules/article/search.php?searchkey=" + t.queryString + "'>                            <i></i>                            ??????<span>" + t.queryString + "</span>???????????????>>                        </a>                    </li>";
		for (var n = 0; n < e.book.length; n++) i += "<li>                    <a class='product' href='" + e.book[n].url_articleinfo + "'>                            <div class='imgbox'>                                <img src='" + e.book[n].url_image + "' alt=''>                            </div>                            <div class='detail'>                                <p class='book-name'>" + t.splitSearchText(e.book[n].articlename, t.queryString) + "</p>                                <p class='author'>" + t.splitSearchText(e.book[n].author, t.queryString) + "</p>                            </div>                        </a>                    </li>                    <li class='line'></li>";
		this.$search.find(".search-list").html(i).show()
	},
	show: function() {
		this.$search.find(".search-list").show()
	},
	hide: function() {
		this.$search.find(".search-list").hide()
	},
	splitSearchText: function(e, t) {
		if (e && t) {
			return e.split(t).join("<span>" + t + "</span>")
		}
		return e
	}
}, _config) {
	var bubbleAjax = function() {
			$.ajax({
				type: "get",
				url: "/ajax/bubble",
				success: function(e) {
					e = JSON.parse(e), !e.error && e && $(".bubbleNum").text(e.total)
				}
			})
		};
	bubbleAjax();
	var bubbleMod = function() {
			setInterval(bubbleAjax, 6e4)
		}()
}
var page_footer = function() {
		var e = $(window).height();
		$("body").height() + $(".footer-box").height() < e ? $(".footer-box").addClass("fix_bottom").addClass("show") : $(".footer-box").removeClass("fix_bottom").addClass("show")
	};
$(function() {
	page_index_header.header.init(), page_index_header.slideUpHd.init(), page_index_header.winEvent.init(), page_index_header.recentRead.init(), page_index_header.toolBar.init(), $(window).resize(function() {
		page_index_header.toolBar.init()
	});
	new search("#mod-search1"), new search("#mod-search2");
	page_footer(), topReturn(page_config.toTop_page)
});

