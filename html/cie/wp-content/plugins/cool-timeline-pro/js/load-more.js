jQuery(function($){

  if(typeof ctlloadmore != 'undefined' && typeof ctlloadmore.attribute != 'undefined') 
    {   
    var page =2;
    var loading = false;
    $('body').on('click', '.ctl_load_more', function(){
       var timeline_wrp= $(this).parents('.cool_timeline');
       var org_label=$(this).text();
       var loading_text=$(this).attr("data-loading-text");
       var button = timeline_wrp.find('.ctl_load_more');
       var type=$(this).attr("data-timeline-type");
        if(type=="compact"){
            var last_year = timeline_wrp.find('.compact-year:last').data('section-title');
         }else{
        var last_year = timeline_wrp.find('.timeline-year:last').data('section-title');
         }

       var last_year = timeline_wrp.find('.timeline-year:last').data('section-title');
       var alternate = timeline_wrp.find('.timeline-post:last').data('alternate');
    
        if( ! loading ) {
           $(this).html(loading_text);
          var max_pages= $(this).attr("data-max-num-pages");
          var max_page_num=parseInt(max_pages)+1;
        
           console.log(type);
             loading = true;
                var data = {
                    action: 'ctl_ajax_load_more',
                    page: page,
                    last_year:last_year,
                    alternate:alternate,
                    attribute: ctlloadmore.attribute
                };
                $.post(ctlloadmore.url, data, function(res) {
                    if( res.success) {
                    if(type=="compact"){
                        var $grid= timeline_wrp.find('.clt-compact-cont').append( res.data );
                        ctl_compact_settings($grid);
                    }else{
                       timeline_wrp.find('.cooltimeline_cont').append( res.data );
                    }
                 
                    enable_navi(timeline_wrp);
                    re_enable_pp(timeline_wrp);
                      
                       button.html(org_label);
                       page = page + 1;
                         loading = false;
                       if(page>=max_page_num){
                            button.hide();
                          }

                    } else {
                        // console.log(res);
                    }
                }).fail(function(xhr, textStatus, e) {
                   console.log(xhr.responseText);
                });

            }
        });
  }


if(typeof ct_load_more != 'undefined' && typeof ct_load_more.attribute != 'undefined') 
    {   

     var page =2;
    var loading = false;
    $('body').on('click', '.ctl_load_more', function(){
       var timeline_wrp= $(this).parents('.cool_timeline');
       var button = timeline_wrp.find('.ctl_load_more');
         var type=$(this).attr("data-timeline-type");
         if(type=="compact"){
            var last_year = timeline_wrp.find('.compact-year:last').data('section-title');
         }else{
        var last_year = timeline_wrp.find('.timeline-year:last').data('section-title');
         }
 
       var alternate = timeline_wrp.find('.timeline-post:last').data('alternate');
       var org_label=$(this).text();
       var loading_text=$(this).attr("data-loading-text");

        if( ! loading ) {
          $(this).html(loading_text);
          var max_pages= $(this).attr("data-max-num-pages");
          var max_page_num=parseInt(max_pages)+1;
         
             loading = true;
                var data = {
                    action: 'ct_ajax_load_more',
                    page: page,
                    last_year:last_year,
                    alternate:alternate,
                    attribute: ct_load_more.attribute
                };

             $.post(ct_load_more.url, data, function(res) {
                    if( res.success) {
                     if(type=="compact"){
                        var $grid= timeline_wrp.find('.clt-compact-cont').append( res.data );
                        ctl_compact_settings($grid);
                    }else{
                       timeline_wrp.find('.cooltimeline_cont').append( res.data );
                    }
                       enable_navi(timeline_wrp);
                       re_enable_pp(timeline_wrp);

                         page = page + 1;
                         loading = false;
                        button.html(org_label);
                         timeline_wrp.find("a[class^='ctl_prettyPhoto']").prettyPhoto({
                             social_tools: false 
                             });
                           timeline_wrp.find("a[rel^='ctl_prettyPhoto']").prettyPhoto({
                              social_tools: false
                            });
                       if(page>=max_page_num){
                            button.hide();
                          }

                    } else {
                        // console.log(res);
                    }
                }).fail(function(xhr, textStatus, e) {
                   console.log(xhr.responseText);
                });

            }
       });
   }

    $(".ct-cat-filters").on("click",function($event){
        $event.preventDefault();
        
      $(".cat-filter-wrp ul li a").removeClass('active-category');
      $(this).addClass('active-category');
       var cat_name=$(this).text();
       var parent_wrp= $(this).parents(".cool_timeline");
       var preloader= parent_wrp.find('.filter-preloaders');
       parent_wrp.find(".custom-pagination").hide();
       parent_wrp.find(".ctl_load_more").hide();
       preloader.show();
       var parent_id=parent_wrp.attr("id");
       var navigation="#"+parent_id+"-navi";
       var termSlug=$(this).data("term-slug");
        var action=$(this).data("action");
        var tm_type=$(this).data("tm-type");
        var type=$(this).data("type"); 
       var loading = false;
       var org_label=$(this).text();
       var loading_text=$(this).attr("data-loading-text");
        
        if(tm_type=="story-tm"){
           var all_attrs= ctlloadmore.attribute;
           var ajax_url= ctlloadmore.url;
        }else{
         var all_attrs= ct_load_more.attribute;
         var ajax_url= ct_load_more.url;
        }
     
        if( ! loading ) {
            if(type=="compact"){
                 parent_wrp.find('.clt-compact-cont').html(' ');
            }else{
                 parent_wrp.find('.cooltimeline_cont').html(' ');
            }
               loading = true;
                var data = {
                    action:action,
                    termslug:termSlug,
                    attribute:all_attrs
                };
                $.post(ajax_url, data, function(res) {
                    if( res.success) {
                        if(type=="compact"){
                        parent_wrp.find('.clt-compact-cont').append('<div class="center-line"></div>');
                       var $grid= parent_wrp.find('.clt-compact-cont').append( res.data );
                        ctl_compact_settings($grid);
                    }else{
                       parent_wrp.find('.cooltimeline_cont').append( res.data );
                    }   
                          loading = false;
                           preloader.hide();
                           $(navigation).remove();
                          $(parent_wrp).find(".timeline-main-title").text(cat_name);
                          $(parent_wrp).find(".no-content").hide();
                         //  re_enable_pp(parent_wrp);

                    } else {
                        // console.log(res);
                    }
                }).fail(function(xhr, textStatus, e) {
                   console.log(xhr.responseText);
                });
          }      
       });

    /*
      Helper funcitons
    */


  // re-enable compact layout grid
  function ctl_compact_settings($grid){
     if($grid !=undefined){
     $grid.masonry( 'reloadItems' );
  // layout Masonry after each image loads
    $grid.masonry('layout');
    $grid.on( 'layoutComplete',
     function( event, laidOutItems ) {
         var elems = $grid.masonry('getItemElements');
         $.each(elems,function(index,value){
            var firstPos=$(this).position();
           if($(this).next('.timeline-post').length>0){
                var secondPos=$(this).next().position();
                var gap=secondPos.top-firstPos.top;
                 new_pos=secondPos.top+70;
                  if(gap<=35){
                 $(this).next().css({'top':new_pos+'px','margin-top':'0px'});
                  }
              }
              var pos=$(document).find(this).position().left;
                var leftPos=parseInt(pos);
                if(leftPos<=0){
                    $(this).addClass('ctl-left');
                  } else{
                      $(this).addClass('ctl-right');
                     }
                });
          }
        );
      }
  }
    // re-enable pretty photo
  function re_enable_pp(timeline_wrp){
     if(timeline_wrp !=undefined){
    timeline_wrp.find("a[class^='ctl_prettyPhoto']").prettyPhoto({
     social_tools: false 
     });
    timeline_wrp.find("a[rel^='ctl_prettyPhoto']").prettyPhoto({
      social_tools: false
    });
    }     
  }

  // re-enable scrolling navigation 
function enable_navi(timeline_wrp){
      if(timeline_wrp !=undefined){
      var wrp_id= timeline_wrp.attr("id");
      $("#"+wrp_id+'-navi').remove();

      var pagination= timeline_wrp.attr('data-pagination');
              var pagination_position= timeline_wrp.attr('data-pagination-position');
              var bull_cls='';
              var position='';
              if(pagination_position=="left"){
                 bull_cls='section-bullets-left';
                position='left';
              }else if(pagination_position=="right"){
                 bull_cls='section-bullets-right';
                position='right';
              }else if(pagination_position=="bottom"){
                 bull_cls='section-bullets-bottom';
                position='bottom';
              } 
            $('body').sectionScroll({
                // CSS class for bullet navigation
                bulletsClass:bull_cls,
               // CSS class for sectioned content
                sectionsClass:'scrollable-section',
                // scroll duration in ms
                scrollDuration: 1500,
               // displays titles on hover
                titles: true,
                 // top offset in pixels
                topOffset:2,
              // easing opiton
                easing: '',
                id:wrp_id,
                position:position,
              });
              }
      }


});
