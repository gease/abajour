
$(window).resize(fill);
function fill() {		
	//$('#content').height('auto');
	var h = $(window).height() - getFooterHeight() - $('#content').position().top - 20;	
    $('#content').css('min-height', h);   
    if ($.browser.msie && parseInt($.browser.version)<7)  $('#content').height(h); 
};

function getFooterHeight(){
	var top = 10000;
	var bottom = 0;
	$('#footer').children().each( function(i){
		top = Math.min($(this).position().top, top);
		bottom = Math.max($(this).position().top + $(this).height(), bottom);
	});
	return bottom-top;
};
$(document).ready(fill);
if ($.browser.safari) $(window).load(fill);

function str_rot13( str ) {
    return (str+'').replace(/[A-Za-z]/g, function (c) {
        return String.fromCharCode((((c = c.charCodeAt(0)) & 223) - 52) % 26 + (c & 32) + 65);
    });
}