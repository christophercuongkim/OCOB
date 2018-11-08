jQuery( window ).ready( function() {

  ts_isotope_process();

});



jQuery(document).ajaxSuccess(function() {
  
  ts_isotope_process();

});

function ts_isotope_process() {


  jQuery( "div[id*='tshowcase_id_']" ).each(function( index ) {
    
    

    // init Isotope
    var $container = jQuery(this).find('.tshowcase-isotope-wrap').isotope({
      itemSelector: '.tshowcase-isotope',
      layoutMode: 'fitRows',
        
      });

    // init Isotope

    // layout Isotope after each image loads
    $container.imagesLoaded().progress( function() {
      $container.isotope('layout');
    });

    jQuery(this).find('ul#ts-isotope-filter-nav li#ts-all').addClass('ts-current-li');
    
    jQuery(this).find('ul#ts-isotope-filter-nav > li').on( 'click', function() {
      
      var filterValue = jQuery(this).attr('data-filter');

       //jQuery(this).find('#ts-isotope-filter-nav > li')
       jQuery(this).siblings().removeClass('ts-current-li');
       jQuery(this).addClass('ts-current-li');

       jQuery(this).siblings().find("ul").click(function(e) {
          e.stopPropagation();
        });

      $container.isotope({ filter: filterValue });
    });

    jQuery( this ).find('ul#ts-isotope-filter-nav > li > ul > li').on( 'click', function() {
      var filterValue = jQuery(this).attr('data-filter');

       jQuery( this ).find('#ts-isotope-filter-nav > li').removeClass('ts-current-li');
       jQuery(this).addClass('ts-current-li');

      $container.isotope({ filter: filterValue });
    });

  
  });


  

}

