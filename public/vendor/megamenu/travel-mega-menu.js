!function (e) {
	"use strict";
	e(document).ready(function () {
		jQuery('[data-toggle="popover"]').popover();
		var o = e("#mobile-menu-01 li.line-mini-menu");
		o.on("click", function () {
			e(this).children("div").addClass("active"),
			e(this).children("div").toggle(1e3) 
		});
		var t = e("#mobile-menu-01 .line-logo i.fa-bars");
		t.on("click", function () {
			e("#mobile-menu-01 .travel-mega-menu-mobile").toggle(1e3)
		}), 
		e(".header-lang").on("hover", function () {
			e(".langs-drop").fadeIn()
		},
		function () { e(".langs-drop").hide() }),
		Modernizr.touch ? (e(".close-overlay").removeClass("hidden"),
		e(".img").on("click", function (o) {
			e(this).hasClass("hover") || e(this).addClass("hover") 
		}),
		e(".close-overlay").on("click", function (o) {
			o.preventDefault(),
			o.stopPropagation(),
			e(this).closest(".img").hasClass("hover") && e(this).closest(".img").removeClass("hover") 
		})) : e(".img").mouseenter(function () { e(this).addClass("hover") }).mouseleave(function () { 
			e(this).removeClass("hover") 
		}),
		e(".price-color-log .content-red").on("hover", function () {
			e(".price-color-log .content-green").addClass("circle-opacity")
		},
		function () { 
			e(".price-color-log .content-green").removeClass("circle-opacity") 
		}), e(".price-color-log .content-blue").on("hover", function () {
		 e(".price-color-log .content-green").addClass("circle-opacity") 
		}, function () { e(".price-color-log .content-green").removeClass("circle-opacity") });
		var a = e(".top-mega-menu"); e(window).scroll(function () { e(this).scrollTop() > 50 ? a.addClass("push-top") : a.removeClass("push-top") }); try { e(".animated")[0] && e(".animated").css("opacity", "0"), e(".triggerAnimation").waypoint(function () { var o = e(this).attr("data-animate"); e(this).css("opacity", ""), e(this).addClass("animated " + o) }, { offset: "80%", triggerOnce: !0 }) } catch (n) { } e("#contact_form").submit(function (o) { function t(e) { var o = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i); return o.test(e) } o.preventDefault(); var a = (e(this), e("#name").val()), n = e("#email").val(), i = e("#message").val(), u = "name=" + a + "&email=" + n + "&message=" + i; t(n) && i.length > 20 && a.length > 1 ? e.ajax({ type: "POST", url: "contact_form/contact_process.php", data: u, success: function () { e(".success").fadeIn(1e3), e("#name").val(""), e("#email").val(""), e("#message").val("") } }) : e(".error").fadeIn(1e3) }), e(".ac-container article div").on("click", function (o) { e(this).toggleClass("active") }), e(".blog-category .cc-check").on("click", function (o) { o.preventDefault(), e(this).toggleClass("active"), o.stopPropagation() }), e(".skillbar").each(function () { e(this).find(".skillbar-bar").width(0) }), e(".skillbar").each(function () { e(this).find(".skillbar-bar").animate({ width: e(this).attr("data-percent") }, 2e3) }) }) } (window.jQuery);