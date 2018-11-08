
$(document).ready(function(){

	$(".slider").slick({
		autoplay: true,
		dots: true,
		pauseOnHover: true,
		speed:1000,
		easing:"easeOutCubic",
		lazyLoad: 'ondemand',
		autoplaySpeed: 5000,
		asNavFor: '.sideSlider',
		prevArrow: '<div class="leftArrow"><img style="max-width:none;" src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/left_right_big.png" alt="Previous Article" /></div>',
		nextArrow: '<div class="rightArrow"><img style="max-width:none; right: 0px; position: absolute;" src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/left_right_big.png" alt="Next Article" /></div>'
	});
	$(".sideSlider").slick({
		autoplay: true,
		pauseOnHover: true,
		autoplaySpeed: 5000,
		speed:1000,
		easing:"easeOutCubic",
		fade: true,
		asNavFor: '.slider',
		prevArrow: '<div id="smallPrev"><img style="max-width:none;" src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/small_prev.png" alt="Previous Article" /></div>',
		nextArrow: '<div id="smallNext"><img style="max-width:none;" src="https://webresource.its.calpoly.edu/cpwebtemplate/5.0.0/common/images_html/rotator/small_next.png" alt="Next Article" /></div>'
	});
	$('.slider').on('lazyLoaded', function(slick) {
		$('.leftArrow').addClass('showArrow');
		$('.rightArrow').addClass('showArrow');
		console.log('here');
	});
	
	$('.leftArrow').addClass('showArrow');
		$('.rightArrow').addClass('showArrow');
	
	
});