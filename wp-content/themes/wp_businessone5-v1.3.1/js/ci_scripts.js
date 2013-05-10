jQuery(document).ready( function($) {
	
	$(".sld-prev").hover(function() {
		$(this).animate({"left": "-42px"}, 100);
	}, function() {
		$(this).animate({"left": "-38px"}, 100);
	});

	$(".sld-next").hover(function() {
		$(this).animate({"right": "-42px"}, 100);
	}, function() {
		$(this).animate({"right": "-38px"}, 100);
	});

	var $slideshow = $(".slides");
	if($slideshow.length > 0) {
		$slideshow.cycle({
			prev: ".sld-prev",
			next: ".sld-next",
			fx: ThemeOption.slider_effect,
			timeout: Number(ThemeOption.slider_timeout),
			sync: ThemeOption.slider_sync,
			speed: Number(ThemeOption.slider_speed),
			pager: ".sld-pager"
		});
	}
	
	var $prodSld = $(".prod-sld");
	if($prodSld.length > 0) {
		$prodSld.cycle({
			fx: ThemeOption.product_slider_effect,
			timeout: Number(ThemeOption.product_slider_timeout),
			sync: ThemeOption.product_slider_sync,
			speed: Number(ThemeOption.product_slider_speed),
			pager:  '.prod-sld-thumbs', 
			pagerAnchorBuilder: function(idx, slide){
				return '.prod-sld-thumbs li:eq(' + idx + ') a';
			},
			after: function(curr, next, opts, fwd){
					var ht = $(this).height();
					$(this).parent().animate({height: ht});
			}
			
		});
	}


	var $menu = $("#navigation");
	$menu.superfish({
		animation: {
			opacity: "show"
		},
		speed: "fast",
		delay:250
	});

	

	//prettyPhoto
	$("a[rel^='prettyPhoto']").prettyPhoto({
		theme: 'pp_default',
		social_tools: ''
	});

	//Frontpage Testimonials Cycling
	$testimonialHold = $(".low-widget-area .widget_ci_testimonials");

	$testimonialHold.find(".tsm-inner").cycle({
		slideExpr: $testimonialHold.find(".testimonial"),
		fit: 1,
		width: 570,
		after: function(curr, next, opts, fwd){
				var ht = $(this).height() + 30;
				$(this).parent().animate({height: ht});
		}

	});
});
