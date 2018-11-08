/*
 *  jQuery Section Scroll v2
 *  Contributor: https://github.com/sylvainbaronnet
 *
 *  Copyright (c) 2016 Danish Iqbal
 *  http://plugins.imdanishiqbal.com/section-scroll
 *
 *  Licensed under MIT
 *
 */
(function ($) {
    'use strict';

    $.fn.sectionScroll = function (options) {
      var $container = this,
          $window = $(window),
          $section_number = 1,
           f_lastId,
          lastId,
          settings = $.extend({
            bulletsClass: 'section-bullets',
            sectionsClass: 'scrollable-section',
            scrollDuration: 1000,
            titles: true,
            topOffset: 0,
            easing: '',
            id:'',
            position:'left'
          }, options);
          var tm_id=settings.id+'-navi';
   		     var cont_cls='';
        
      		var $sections2 =$("#"+settings.id).find('.' + settings.sectionsClass);
            var $sections =$('.' + settings.sectionsClass);
       
          if(settings.position=="left"||settings.position=="right"){
    		    cont_cls='ctl-bullets-container';
          }else if(settings.position=="bottom"){
    		    cont_cls='ctl-footer-bullets-container';
          }

         var $bullets  = $('<div id="'+ tm_id +'" class="'+ cont_cls +'"><ul class="'+ settings.bulletsClass +'"></ul></div>')
                      .prependTo($container)
                      .find('ul');
 		 
      /* Build navigation */
      var bullets_html = '';
   		$sections2.each(function () {
         var $this = $(this);
        // console.log($this.attr('id'));
        //console.log($sections2);
          var title = $this.data('section-title') || '';
          var cls='';
          $this.attr('id', 'scrollto-section-'+tm_id+'-'+title);

           cls= $this.data("cls");

          var bullet_title = settings.titles ? '<span>' + title + '</span>' : '';

          bullets_html += '<li class="year-' + title + " " + cls + ' "><a title="' + title + '" href="#scrollto-section-'+tm_id+'-'+title + '">' + bullet_title + '</a></li>';
          
          $section_number++;
      });
      
      var $bullets_items = $(bullets_html).appendTo($bullets);
    var scrollItems = $bullets_items.map(function () {
          var item = $($(this).find('a').attr('href'));
          if (item[0]) {
              return item;
          }
      });


    $bullets_items.on('click', function (e) {

          var href = $(this).find('a').attr('href'),
              offsetTop = href === '#' ? 0 : $(href).offset().top;

          $('html, body').stop().animate({

              scrollTop: offsetTop - settings.topOffset
          }, settings.scrollDuration, settings.easing, function(){
              $container.trigger('scrolled-to-section').stop();
          });
          e.preventDefault();
      } );


     $window.on('scroll', function () {
          var fromTop = $window.scrollTop() + ($window.height() / 2.5);

          var cur = scrollItems.map(function () {

              if ($(this).offset().top < fromTop) {
                  return this;
              }
          });
          cur = cur.length > 0 ? cur[cur.length - 1] : [];
          var id = cur[0] ? cur[0].id : '';

          if (lastId !== id) {
              $sections2.removeClass('active-section');
           $(cur).addClass('active-section');
              $bullets_items
                  .removeClass('active')
                  .find('a[href="#' + id + '"]')
                  .parent()
                  .addClass('active');

              lastId = id;
              $.fn.sectionScroll.activeSection = cur;
              $container.trigger('section-reached');
          }
		 });

      $(function() {
          $window.scroll();
      });

      return $container;
    };


}(jQuery));