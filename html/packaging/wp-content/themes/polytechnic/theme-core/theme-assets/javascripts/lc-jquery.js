jQuery("#clickme").click(function () {
var msg = 'somestring='+lc_jqpost_info.somestring;
msg += ' post_id='+lc_jqpost_info.post_id;
msg += ' post_title='+lc_jqpost_info.post_title;
alert( msg );
});