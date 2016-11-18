$(document).ready(
		function(){			
			$('form li .help_sign').bt(					
				{
				trigger: 'click',
				closeWhenOthersOpen: true,
				contentSelector: "$(this).next('.help').text()",
				cssClass: 'tooltip',
				spikeGirth: 3,
				spikeLength: 15,
				fill: '#ffc',
				cornerRadius: 10						
			});
			$('.help_sign').text('i');
			$('.tooltip').css('opacity', 0.8);
		});

$.fn.loadUsers = function(data)
{
	return $(this).each(function(){
		var el = $(this);
		$.each(data, function(i, val){
			var person_div = document.createElement('div');
		    person_div = $(person_div).addClass('user');
		    var last_name_span = document.createElement('span');
	        var first_name_span = document.createElement('span');
	        var middle_name_span = document.createElement('span');
	        var institution_span = document.createElement('span');
	        last_name_span = $(last_name_span).text(val.last_name).addClass('last_name');
	        first_name_span = $(first_name_span).text(val.first_name).addClass('first_name');
	        if (!empty(val.middle_name))
	        	   middle_name_span = $(middle_name_span).text(val.middle_name).addClass('middle_name');
	        else
	        	middle_name_span = $(middle_name_span).text('').addClass('middle_name');
	        if (!empty(val.institution))
                institution_span = $(institution_span).text(val.institution).addClass('institution');
	        else
	            institution_span = $(institution_span).text('').addClass('institution');
	        person_div.append(last_name_span).append(first_name_span).append(middle_name_span).append(institution_span);
			el.append(person_div);
			});
   });
}

function empty( mixed_var ) {
 
    var key;
    
    if (mixed_var === "" ||
        mixed_var === 0 ||
        mixed_var === "0" ||
        mixed_var === null ||
        mixed_var === false ||
        mixed_var === undefined
    ){
        return true;
    }

    if (typeof mixed_var == 'object') {
        for (key in mixed_var) {
            return false;
        }
        return true;
    }

    return false;
}
