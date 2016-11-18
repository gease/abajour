/**
 * Receives following parameters
 * @param autocomplete_url
 * @param recommended_id
 * @param not_recommended_id
 * @param form_name
 * @param form_name1
 * @param is_bound
 * @param corresponding
 * @param author
 * @param author_id
 * @param strings
 * @see submitSuccess.php
 */
$(document).ready(function(){	
	$('#author_autocomplete').autocomplete(autocomplete_url,
			{
				formatItem: formatItem,
				formatResult: formatItem
			});
	$("#author_autocomplete").result(function (event, data, formatted){
			addAuthor(data, true);
		});
	 $('#authors_list').sortable({
		 axis: 'y',
		 opacity: 0.5
		 });
	 $('form :submit').click(function(){
		$('#manuscript_user_manuscript_ref_list').empty();
		$('#authors_list > .sortable').each(function(){
			var id = $(this).attr('id');
			var new_auth_option = $("<option id='option_"+id+"' value='"+id+"' selected/>");
			$('#manuscript_user_manuscript_ref_list').append(new_auth_option);
		});		
		$('#favorite_reviewers > .reviewer').each(function(i){
			var name = $('<input type="text" name="'+form_name+'['+i+']'+'[name]" style="display:none" />').val($(this).children('.name').text());
			var inst = $('<input type="text" name="'+form_name+'['+i+']'+'[institution]" style="display:none" />').val($(this).children('.institution').text());
			var email = $('<input type="text" name="'+form_name+'['+i+']'+'[email]" style="display:none" />').val($(this).children('.email').text());
	        $('form').append(name).append(inst).append(email);
			});		
        $('#rejected_reviewers > .reviewer').each(function(i){
            var name = $('<input type="text" name="'+form_name1+'['+i+']'+'[name]" style="display:none" />').val($(this).children('.name').text());
            var inst = $('<input type="text" name="'+form_name1+'['+i+']'+'[institution]" style="display:none" />').val($(this).children('.institution').text());
            var email = $('<input type="text" name="'+form_name1+'['+i+']'+'[email]" style="display:none" />').val($(this).children('.email').text());
            $('form').append(name).append(inst).append(email);
            });
        $('form '+recommended_id).val($('#favorite_reviewers > .reviewer').length);
		$('form '+not_recommended_id).val($('#rejected_reviewers > .reviewer').length);
        $('form').submit();
	 });
	 if (is_bound){
		 $('#manuscript_user_manuscript_ref_list :selected').each(function(){
		    
		    addAuthor([$(this).val(), $(this).text()], !($(this).val() == author_id), (corresponding == $(this).val()));
		 });
	 }
	 else if (author!=null)
	 {
		 addAuthor([author_id,author], false, true);
	 }
});
function formatItem(row){
	return row[1];
}
function addAuthor(data, removable, corresponding){
	 var new_auth = $("<div class='sortable' id="+data[0]+"/>");
	 var auth_name = $("<div class='auth_name' />");
	 auth_name.html(data[1]);
	 new_auth.prepend(auth_name);
	 var input = $("<input type='radio' name='"+name_corr+"' value='"+data[0]+"'/>");
	 if (corresponding) input.attr('checked', 'checked');
	 new_auth.append(input);
	 $('#authors_list').append(new_auth);
	 if (removable){
		new_auth.append("<span class='remove' > - </span>");
	 	$('.remove').click(function(){
		 	$(this).btOff();
			 $(this).parent().remove();
	 		});
	 }
	 new_auth.find(':radio').bt(
			 strings.corresponding,
             {
             trigger: 'click',
             closeWhenOthersOpen: true,
             cssClass: 'tooltip',
             spikeGirth: 3,
             spikeLength: 15,
             fill: '#ffc',
             cornerRadius: 10
         });
	 new_auth.find('.remove').bt(
             strings.remove,
             {
            hoverIntentOpts: {
            	    interval: 500,
            	    timeout: 500
            	  },
             closeWhenOthersOpen: true,
             cssClass: 'tooltip',
             spikeGirth: 3,
             spikeLength: 15,
             fill: '#ffc',
             cornerRadius: 10
         });
}
/**
* data - array [[name, has_error], [email, has_error], [institution, has_error]]
 */
function append_reviewer (data, area_name){
    if ($.trim(data[0][0]).length == 0 ||
        $.trim(data[1][0]).length == 0 ||
        $.trim(data[2][0]).length == 0 )

            {alert (strings.error_empty); return ;}
        str = '<div class="reviewer"><div class="name">'+$.trim(data[0][0])+'</div>';
        str += '<div class="email">'+$.trim(data[1][0])+'</div>';
        str += '<div class="institution">'+$.trim(data[2][0])+'</div>';
        str += "<span class='remove' > - </span></div>";
        str = $(str);
        if (data[0][1]) $(str).find('.name').addClass('error');
        if (data[1][1]) $(str).find('.email').addClass('error');
        if (data[2][1]) $(str).find('.institution').addClass('error');
        $(area_name).append(str);
        $('.remove').click(function(){
            $(this).parent().remove();
           });
}