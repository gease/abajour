$(document).ready(function(){
	$('.sf_admin_filter .head').click(function()
		{
			$(this).parents('.sf_admin_filter').find('.body').slideToggle('slow');		
		});
});