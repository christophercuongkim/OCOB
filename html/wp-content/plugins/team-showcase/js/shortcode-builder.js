

function tshowcaseshortcodegenerate() {
	
	
	var order = document.getElementById('orderby').value;

	if(document.getElementById('multiple').checked) { 
		document.getElementById('category').setAttribute("multiple","multiple");
		document.getElementById('taxonomy').setAttribute("multiple","multiple");
		document.getElementById('multiplemsg').innerHTML = "<ul><li>For windows: Hold down the control (ctrl) button to select multiple categories</li><li>For Mac: Hold down the command button to select multiple categories</li></ul>";

	} else {
		document.getElementById('category').removeAttribute("multiple","multiple");
		document.getElementById('taxonomy').removeAttribute("multiple","multiple");
		document.getElementById('multiplemsg').innerHTML = "";

	}

	var category = tshowcase_getSelectValues(document.getElementById('category'));
	var taxonomy = tshowcase_getSelectValues(document.getElementById('taxonomy'));
	var relation = tshowcase_getSelectValues(document.getElementById('relation'));

	//console.log(category);


	var url = document.getElementById('singleurl').value;
	var imgstyle = document.getElementById('imgstyle').value;
	var columns = document.getElementById('columns').value;
	var imgeffect = document.getElementById('imgeffect').value;
	var textalign = document.getElementById('textalign').value;
	var composition = document.getElementById('composition').value;
	var layout = document.getElementById('layout').value;
	var limit = document.getElementById('limit').value;
	var pagination = document.getElementById('pagination').value;
	var exclude = document.getElementById('exclude').value;
	var idsfilter = document.getElementById('idsfilter').value;
	var tablestyling = document.getElementById('table-styling').value;
	var gridstyling = document.getElementById('grid-styling').value;
	var hoverstyling = document.getElementById('hover-styling').value;
	var pagerstyling = document.getElementById('pager-styling').value;
	var pagercomposition = document.getElementById('pagercomposition').value;
	var pagerimgcomposition = document.getElementById('pagerimgcomposition').value;
	var img = document.getElementById('img').value;
	var filtergrid = document.getElementById('filtergrid').value;
	var filterhover = document.getElementById('filterhover').value;
	var filterpager = document.getElementById('filterpager').value;
	
	if(layout=="grid") {
		gridop();
	}
	if(layout=="pager" ) {
		pagerop();
	}
	if(layout=="table" ) {
		tableop();
	}
	if(layout=="hover" ) {
		hoverop();
	}
	
	//display
	var display = "";
	if(document.getElementById('photo').checked) { display=display+'photo,'; imgopshow();} else { imgophide(); }
	if(document.getElementById('website').checked) { display=display+'website,';}
	if(document.getElementById('position').checked) { display=display+'position,';}
	if(document.getElementById('social').checked) { display=display+'social,';}
	if(document.getElementById('freehtml').checked) { display=display+'freehtml,';}
	if(document.getElementById('location').checked) { display=display+'location,';}
	if(document.getElementById('email').checked) { display=display+'email,';}
	if(document.getElementById('telephone').checked) { display=display+'telephone,';}
	if(document.getElementById('smallicons').checked) { display=display+'smallicons,';}
	if(document.getElementById('name').checked) { display=display+'name,';}
	if(document.getElementById('dgroups').checked) { display=display+'groups,';}

	if(document.getElementById('dgroups2').checked) { display=display+'taxonomy,';}
	
	if(display.length >= 1) { display = display.slice(0, - 1);}
	
	var shortcode = document.getElementById('shortcode');
	//var shortcode2 = document.getElementById('shortcode2');
	var php = document.getElementById('phpcode');
	var preview = document.getElementById('tshowcase_id_0');
	
	var shortcodeinner = "[show-team ";
	
	if(order!="none") {
		shortcodeinner += " orderby='"+order+"'";
		}
	if(limit!="0" && limit !="") {
		shortcodeinner += " limit='"+limit+"'";
	}

	if(document.getElementById('pagination').checked) {
		shortcodeinner += " pagination='true'";
	}

	if(idsfilter!="0" && idsfilter !="") {
		shortcodeinner += " ids='"+idsfilter+"'";
	}

	if(exclude!="0" && exclude !="") {
		shortcodeinner += " exclude='"+exclude+"'";
	}

	if(category!="0" && category!="") {
	 	shortcodeinner += " category='"+category+"'";	
	}

	if(taxonomy!="0" && taxonomy!="") {
	 	shortcodeinner += " taxonomy='"+taxonomy+"'";	
	}

	if(relation!="0" && relation!="") {
	 	shortcodeinner += " relation='"+relation+"'";	
	}

	if(url!="inactive") {
	 	shortcodeinner += " url='"+url+"'";	
	}
	
	if(layout!="") {
	 	shortcodeinner += " layout='"+layout+"'";	
	}
	
	var style ="";
	
	
	//Image and Text Styles
	if(document.getElementById('photo').checked) {
		if(imgstyle!="") {
			style += imgstyle;	
		}
		
		if(imgeffect!="") {
			style += ","+imgeffect;	
		}
	}
	
	if(textalign!="") {
	 	style += ","+textalign;	
	}
	
	
	//layout dependent styles
	
	if(layout=="grid") {
	
		if(composition!="") {
			style += ","+composition;	
		}
		
		if(columns!="") {
			style += ","+columns;	
		}
		
		if(gridstyling!="" && gridstyling!="default" ) {
			style += ","+gridstyling;
		}
		
		if(filtergrid!="" && filtergrid!="inactive") {
			display += ","+filtergrid;
		}
		
	}
	
	if(layout=="hover") {
	
		if(columns!="") {
			style += ","+columns;	
		}
		if(hoverstyling!="" && hoverstyling!="default" ) {
			style += ","+hoverstyling;
		}
		
		if(filterhover!="" && filterhover!="inactive" ) {
			display += ","+filterhover;
		}
		
	}
	
	if(layout=="table") {
		if(tablestyling!="" && tablestyling!="default" ) {
			style += ","+tablestyling;
		}
	}
	
	if(layout=="pager") {
		if(pagerstyling!="" && pagerstyling!="default" ) {
			style += ","+pagerstyling;
		}
		
		if(pagercomposition!="") {
			style += ","+pagercomposition;	
		}
		if(pagerimgcomposition!="") {
			style += ","+pagerimgcomposition;	
		}

		if(filterpager!="" && filterpager!="inactive") {
			display += ","+filterpager;
		}
		
	}
	
	
	//Final composition for style
	if(style!="") {
	 	shortcodeinner += " style='"+style+"'";	
	}
	 
	 if(display!="") {
	 	shortcodeinner += " display='"+display+"'";	
	}
	
	if (img!="" && layout!="table") {
		shortcodeinner += " img='"+img+"'";
	}
	 
	 shortcodeinner += "]";
		
	shortcode.innerHTML = shortcodeinner;
	document.getElementById('current_shortcode').value = shortcodeinner;
	//shortcode2.innerHTML = shortcodeinner;
	
	php.innerHTML = "&lt;?php echo do_shortcode(\""+shortcodeinner+"\"); ?&gt; ";
	

var data = {
		action: 'tshowcase',
		porder: order,
		plimit: limit,
		pidsfilter: idsfilter,
		pexclude: exclude,
		pcategory:category,
		ptax:taxonomy,
		prelation: relation,
		purl:url,
		playout:layout,
		pstyle:style,
		pdisplay:display,
		pimg:img,

	};
	
	
jQuery.post(ajax_object.ajax_url, data, function(response) {
		preview.innerHTML=response;
		
		checkscripts();
		
	});
	
	
	
	
	
}

function  gridop() {
		var e = document.getElementById('pagerdiv');
        e.style.display = 'none';
		var e = document.getElementById('tablediv');
        e.style.display = 'none';
		var e = document.getElementById('hoverdiv');
        e.style.display = 'none';
		var a = document.getElementById('griddiv');
        a.style.display = 'block';
		var e = document.getElementById('imgsize');
        e.style.display = 'block';
		var e = document.getElementById('columnsdiv');
        e.style.display = 'block';
	}

function  pagerop() {
		var e = document.getElementById('pagerdiv');
        e.style.display = 'block';
		var a = document.getElementById('griddiv');
        a.style.display = 'none';
		var e = document.getElementById('tablediv');
        e.style.display = 'none';
		var e = document.getElementById('hoverdiv');
        e.style.display = 'none';
		var e = document.getElementById('imgsize');
        e.style.display = 'block';
		var e = document.getElementById('columnsdiv');
        e.style.display = 'none';
	}

function  tableop() {
		var a = document.getElementById('tablediv');
        a.style.display = 'block';
		var b = document.getElementById('hoverdiv');
        b.style.display = 'none';
		var c = document.getElementById('pagerdiv');
        c.style.display = 'none';
		var d = document.getElementById('griddiv');
        d.style.display = 'none';
		var e = document.getElementById('imgsize');
        e.style.display = 'none';
		var e = document.getElementById('columnsdiv');
        e.style.display = 'none';
		
		
	}

function  hoverop() {
		var e = document.getElementById('tablediv');
        e.style.display = 'none';
		var e = document.getElementById('hoverdiv');
        e.style.display = 'block';
		var e = document.getElementById('pagerdiv');
        e.style.display = 'none';
		var a = document.getElementById('griddiv');
        a.style.display = 'none';
		var e = document.getElementById('imgsize');
        e.style.display = 'block';
		var e = document.getElementById('columnsdiv');
        e.style.display = 'block';
	}

function imgophide() {
		var e = document.getElementById('imgdiv');
        e.style.display = 'none';
}

function imgopshow() {
		var e = document.getElementById('imgdiv');
        e.style.display = 'block';
}

function checkscripts() {
	
	var layout = document.getElementById('layout').value;
	var filtergrid = document.getElementById('filtergrid').value;
	var filterhover = document.getElementById('filterhover').value;
	var filterpager = document.getElementById('filterpager').value;
	
	if(layout=="pager") {

		var teamDiv = jQuery('.tshowcase-pager-wrap');
		teamDiv.fadeIn('slow');
		
		jQuery('.tshowcase-bxslider-0').bxSlider({
			  pagerCustom: '#tshowcase-bx-pager-0',
			  controls:false,
			  mode:'fade'
		});	

		if(filterpager == "filter") { 
		
			jQuery("#ts-filter-nav > li").off('click');
	
			jQuery('#ts-all').addClass('ts-current-li');
			jQuery("#ts-filter-nav > li").click(function(){
				ts_show(this.id);
			});
		}
		if(filterpager == "enhance-filter") { 
	
			jQuery("#ts-enhance-filter-nav > li").off('click');
			
			jQuery('#ts-all').addClass('ts-current-li');
			jQuery("#ts-enhance-filter-nav > li").click(function(){
				ts_show_enhance(this.id);
			});
		}	
		
	}
	
	if (layout=="grid") {
	
		if(filtergrid == "filter") { 
		
			jQuery("#ts-filter-nav > li").off('click');
	
			jQuery('#ts-all').addClass('ts-current-li');
			jQuery("#ts-filter-nav > li").click(function(){
				ts_show(this.id);
			});
		}
		if(filtergrid == "enhance-filter") { 
	
			jQuery("#ts-enhance-filter-nav > li").off('click');
			
			jQuery('#ts-all').addClass('ts-current-li');
			jQuery("#ts-enhance-filter-nav > li").click(function(){
				ts_show_enhance(this.id);
			});
		}	
	}
	
	if (layout=="hover") {
		//Filter Code
		if(filterhover == "filter"  ) {
			
			jQuery("#ts-filter-nav > li").off('click');
			
			jQuery('#ts-all').addClass('ts-current-li');
			jQuery("#ts-filter-nav > li").click(function(){
				ts_show(this.id);
			});
		}
	
		if(filterhover == "enhance-filter"  ) {
			
					
			jQuery("#ts-enhance-filter-nav > li").off('click');
			
			jQuery('#ts-all').addClass('ts-current-li');
			jQuery("#ts-enhance-filter-nav > li").click(function(){
				ts_show_enhance(this.id);
			});
		}	
	}
}

//tshowcaseshortcodegenerate();
//tshowcasepreset();


//Still in development
function loadshortcode() {
	var shortcode = document.getElementById('loadshortcode').value;
	var result = document.getElementById('result');
	
   var params = shortcode.match(/\b\w+='[^']+'/g);
   for (var i = 0; i < params.length; i++)
      result.innerHTML += params[i]+"<br>";
	  
	 }

function tshowcasepreset() {
	
	var preset = document.getElementById('preset').value;
	
	var imgstyle = document.getElementById('imgstyle');
	var columns = document.getElementById('columns');
	var imgeffect = document.getElementById('imgeffect');
	var textalign = document.getElementById('textalign');
	var composition = document.getElementById('composition');
	var layout = document.getElementById('layout');
	var tablestyling = document.getElementById('table-styling');
	var gridstyling = document.getElementById('grid-styling');
	var hoverstyling = document.getElementById('hover-styling');
	var pagerstyling = document.getElementById('pager-styling');
	var pagercomposition = document.getElementById('pagercomposition');
	var pagerimgcomposition = document.getElementById('pagerimgcomposition');
	var filtergrid = document.getElementById('filtergrid');
	var filterhover = document.getElementById('filterhover');
	
	var img = document.getElementById('img').value;
	
	if(preset=='polaroid') {
		layout.value = "grid";
		imgstyle.value = "img-square";
		gridstyling.value = "retro-box-theme";
		composition.value = "img-above";
		imgeffect.value = "";
		textalign.value = "text-left";
		columns.value = "3-columns";
		filtergrid.value ="inactive";
	}
	
	if(preset=='white-polaroid') {
		layout.value = "grid";
		imgstyle.value = "img-square";
		gridstyling.value = "white-box-theme";
		composition.value = "img-above";
		imgeffect.value = "";
		textalign.value = "text-left";
		columns.value = "3-columns";
		filtergrid.value ="inactive";
	}
	
	if(preset=='gray-card-grid') {
		layout.value = "grid";
		imgstyle.value = "img-square";
		gridstyling.value = "card-theme";
		composition.value = "img-above";
		imgeffect.value = "";
		textalign.value = "text-left";
		columns.value = "3-columns";
		filtergrid.value ="inactive";
	}
	
	if(preset=='circle-grid') {
		layout.value = "grid";
		imgstyle.value = "img-circle";
		gridstyling.value = "default";
		composition.value = "img-above";
		imgeffect.value = "img-white-border";
		textalign.value = "text-center";
		columns.value = "3-columns";
		filtergrid.value ="inactive";
	}
	
	if(preset=='content-right-simple-grid') {
		layout.value = "grid";
		imgstyle.value = "img-square";
		gridstyling.value = "default";
		composition.value = "img-left";
		imgeffect.value = "img-white-border";
		textalign.value = "text-left";
		columns.value = "2-columns";
		filtergrid.value ="inactive";
	}
	
	if(preset=='content-below-simple-grid') {
		layout.value = "grid";
		imgstyle.value = "img-rounded";
		gridstyling.value = "default";
		composition.value = "img-above";
		imgeffect.value = "img-white-border";
		textalign.value = "text-left";
		columns.value = "3-columns";
		filtergrid.value ="inactive";
	}
	
	if(preset=='hover-circle-white-grid') {
		layout.value = "hover";
		imgstyle.value = "img-circle";
		hoverstyling.value = "white-hover";
		imgeffect.value = "";
		textalign.value = "text-center";
		columns.value = "3-columns";
		filterhover.value ="inactive";
	}
	
	if(preset=='hover-circle-grid') {
		layout.value = "hover";
		imgstyle.value = "img-circle";
		hoverstyling.value = "default";
		imgeffect.value = "img-white-border";
		textalign.value = "text-center";
		columns.value = "3-columns";
		filterhover.value ="inactive";
	}
	if(preset=='hover-square-grid') {
		layout.value = "hover";
		imgstyle.value = "img-square";
		hoverstyling.value = "default";
		imgeffect.value = "img-white-border";
		textalign.value = "text-left";
		columns.value = "4-columns";
		filterhover.value ="inactive";
	}
	if(preset=='simple-table') {
		layout.value = "table";
		imgstyle.value = "img-square";
		tablestyling.value = "odd-colored";
		imgeffect.value = "";
		textalign.value = "text-left";
		
	}
	
	if(preset=='simple-pager') {
		layout.value = "pager";
		imgstyle.value = "img-square";
		pagerstyling.value = "default";
		imgeffect.value = "img-white-border";
		textalign.value = "text-left";
		pagercomposition.value = "thumbs-left";
		pagerimgcomposition.value = "img-above";
		
	}
	
	if(preset=='circle-pager') {
		layout.value = "pager";
		imgstyle.value = "img-circle";
		pagerstyling.value = "default";
		imgeffect.value = "img-white-border";
		textalign.value = "text-center";
		pagercomposition.value = "thumbs-left";
		pagerimgcomposition.value = "img-above";
		
	}
	
	if(preset=='gallery-pager') {
		layout.value = "pager";
		imgstyle.value = "img-square";
		pagerstyling.value = "default";
		imgeffect.value = "img-white-border";
		textalign.value = "text-left";
		pagercomposition.value = "thumbs-below";
		pagerimgcomposition.value = "img-left";
		
	}
	
	
	tshowcaseshortcodegenerate();
}

// Return an array of the selected opion values
// select is an HTML select element
function tshowcase_getSelectValues(select) {
  var result = "";
  var options = select && select.options;
  var opt;



  //if(jQuery.isArray(options)) {
  if(options && options.length>=1) {

  	for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

	    if (opt.selected) {
	      result += opt.value + ",";
	    }
	  }

  }

  
  
  result = result.substring(0, result.length - 1);
  return result;
}

function tshowcase_save_shortcode_settings() {

	//var formdata = JSON.stringify(jQuery('#shortcode_generator').serializeArray());
	var formdata = jQuery('#shortcode_generator').serializeArray();
	
	var shortcode = document.getElementById('current_shortcode').value;
	console.log(shortcode);

	var data = {
			action: 'tshowcase_save_shortcode_data',
			shortcode: shortcode,
			options: formdata
		};
		
	jQuery.post(ajax_object.ajax_url, data, function(response) {
			
			console.log(response);

			var message_div = jQuery('.tshowcase_message_area');

			message_div.show();

			message_div.html('<div class="updated">Options Saved!</div>');

			message_div.delay(4000).fadeOut('slow');



		});

}

