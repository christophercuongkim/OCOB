// Smooth scroll for in page links - http://wibblystuff.blogspot.in/2014/04/in-page-smooth-scroll-using-css3.html
// Improvements from - http://codepen.io/kayhadrin/pen/KbalA
// Improvements made by Bo form OCOB to get rid of all slashes

(function($) {
	var $window = $(window), $document = $(document),
		transitionSupported = typeof document.body.style.transitionProperty === "string", // detect CSS transition support
		scrollTime = 1; // scroll time in seconds


    //offset by the bar when they come in
    $(document).ready(function(){
        setTimeout(function(){
            if(window.location.hash.length > 1){
                var id = window.location.hash.substring(1);
                $(window).scrollTop($("#"+id).offset().top - $("#top-bar").height() + 2);
            }
        },100);
    });

	$(document).on("click", "a[href*=#]:not([href=#])", function(e) {
		var target, avail, scroll, deltaScroll;

		// Make top bar opaque on click
		$('#top-bar').css('background-color','rgba(255,255,255,1)');
		if (location.pathname.split("\/").join("") == this.pathname.split("\/").join("") && location.hostname == this.hostname) {
			target = $(this.hash);
			target = target.length ? target : $("[id=" + this.hash.slice(1) + "]");

			if (target.length) {
				avail = $document.height() - $window.height();

				if (avail > 0) {
					scroll = target.offset().top - $("#top-bar").height() + 2;

					if (scroll > avail) {
						scroll = avail;
					}
				} else {
					scroll = 0;
				}

				deltaScroll = $window.scrollTop() - scroll;

				e.preventDefault();

				// if we don't have to scroll because we're already at the right scrolling level,
				if (!deltaScroll) {
					return; // do nothing
				}

				$("html, body").stop(true, true) // stop potential other jQuery animation (assuming we're the only one doing it)
				.animate({
					scrollTop: scroll + "px"
				}, scrollTime * 1000);
			}
		}
	});
})( jQuery );