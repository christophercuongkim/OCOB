//var console;
(function($) {
/*
	function setEqualHeight(selector, triggerContinusly) {

		var elements = $(selector);
		elements.css("height", "auto");
		var max = Number.NEGATIVE_INFINITY;

		$.each(elements, function(index, item) {
			if ($(item).height() > max) {
				max = $(item).height();
			}
		});

		$(selector).css("height", max + "px");

		if (!!triggerContinusly) {
			$(document).on("input", selector, function() {
				setEqualHeight(selector, false);
			});
			$(window).resize(function() {
				setEqualHeight(selector, false);
			});
	    }

	}
	setEqualHeight("#learn .page", true);
*/

	$(window).bind('scroll', function() {
		var navHeight = $( "#cal-poly-bar" ).height();
		if ($(window).scrollTop() > navHeight) {
			$('#top-bar').addClass('fixed');
			$('#home-hero, .binding.subpage').css('marginTop',72);
		} else {
			$('#top-bar').removeClass('fixed');
			$('#home-hero, .binding.subpage').css('marginTop',0);
		}
	});

	$(window).scroll(function(){
	    var scrollTop = $(window).scrollTop();
	    if(scrollTop > 5){
	        $('#top-bar').stop(true,true).animate({
	        	backgroundColor: 'rgba(255,255,255,1)'
	        }, 500);
	    }else{
	        $('#top-bar').stop(true,true).animate({
	        	backgroundColor: 'rgba(255,255,255,0.8)'
	        }, 500);
		}
	});


	$('#hamburger').click(function(){
		$('#hamburger').fadeOut(500);
		$('#mobile-menu').fadeIn(500,function(){
			$('#mobile-menu .close, #mobile-menu a').click(function(){
				$('#mobile-menu').fadeOut(500);
				$('#hamburger').fadeIn(500);
			});			
		});
	});

	$('.social-links a').click(function(event){
		event.preventDefault();
		window.open($(this).attr('href'), '_blank', 'width=500, height=500');
	});

    $(".home #top-bar .inner a img.logo").click(function(e){
        $("html,body").animate({scrollTop:0});
        e.preventDefault();
        return false;
    });

    $('.pullquote .read-more').on('click', function(){
        $(this).parent('.preview').css('display','none');
        $(this).parents('.pullquote').children('.full').css('display','block');
    });

    /* Home Page Slick Sliders */
    $('#home-hero .header-imagery').slick({
        dots: false,
        infinite: true,
        fade:true,
        arrows: false,
        autoplay: true,
        speed: 1500,
        autoplaySpeed: 4000,
        pauseOnHover: false
    });

    $('#news-slider').slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
        ]
    });

    $('#header-slider').slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });

	function slickEm(){
        // Sliders within this function become 'unslicked' at 767px. We'll bring them back when resizing the window
        $('#learn .pages').slick({
            dots: true,
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                  }
                },
                {
                  breakpoint: 767,
                  settings: "unslick"
                }
            ]
        });
        
        $('#launch .pages').slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive: [
                {
                  breakpoint: 767,
                  settings: "unslick"
                }
            ]
        });

        $('.subpage-footer .pages').slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive: [
                {
                  breakpoint: 767,
                  settings: "unslick"
                }
            ]
        }); 

        $('.fellows-extra-content .pages').slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive: [
                {
                  breakpoint: 767,
                  settings: "unslick"
                }
            ]
        });
    }
    
    slickEm();

    var slickDebouncer = false;
    $(window).resize(function(){
        clearTimeout(slickDebouncer);
        //check first slider
        if(!$('#learn-slider').hasClass('slick-initialized')) {
            //check window width
            if($(window).width > 767) {
                slickEm();
            }
        }
        slickDebouncer = setTimeout(slickEm,1000);
    });

    $('#coworking-form input[name=other_college]').keyup(function(){
        //console.log(other_college);
        if($(this).val().length === 0 ){
            $('#coworking-form input.other-college').attr('checked',false);
            console.log('empty');
        } else {
            $('#coworking-form input.other-college').attr('checked',true);
        }
        $('#coworking-form input.other-college').val('Other: ' + $(this).val());
    });

    $(window).load(function () {
        if($(window).width() > 640) {
            var in_view = new Waypoint.Inview({
                element: $('#stat-wrapper')[0],
                enter: function() {
                    $('#stat-wrapper .stat').addClass('start');
                },
                exit: function() {  // optionally
                    $('#stat-wrapper .stat').removeClass('start');
                    //$('#stat-wrapper .stat .icon, #stat-wrapper .stat .text').css('transition', 'none');
                }
            });
        }
        $(document).ready(function() {
          $("#stat-wrapper .stat").each(function() {
            $(this)
              .mouseover(function() {
                $(this).addClass('hover2');
              })
              .mouseleave(function() {
                $(this).removeClass('hover2');
              })
              .click(function() {
                if($(window).width() < 640) {
                  $(this).addClass('hover')
                }
              });
          })
        });
    });

})( jQuery );





