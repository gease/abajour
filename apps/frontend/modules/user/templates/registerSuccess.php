<?php use_helper('RenderForm'); ?>
<?php use_helper('sfCryptoCaptcha');?>
<div id="form">
<form id="register" method="post" action="<?php echo url_for('user/register')?>">
<fieldset>
<legend><?php echo __('Login info');?></legend>
<?php  echo mark_required ($userForm);?>
</fieldset>
<div id="existing_users"><h4><?php echo __('Attention!').' '.__('Following users already exist. Make sure you are not one of them.')?></h4></div>
<fieldset>
<legend><?php echo __('Personal info');?></legend>
<?php  echo mark_required ($profileForm);?>
</fieldset>
<?php echo mark_required($captchaForm)?>
<div id="captcha_image"><?php echo captcha_image(); echo captcha_reload_button(); ?></div>
<input type="submit"/>
</form>
</div>
<div id="text">
<?php if ($sf_user->getCulture()=='ru'):?>
<p>Для того, чтобы иметь возможность подать рукопись в Журнал структурной химии через веб-интерфейс,
все авторы рукописи должны быть зарегистрированы в системе. Регистрация позволяет также отслеживать статус своей рукописи,
просматривать замечания рецензента и отвечать на них, сообщать редакции свои требования и вопросы через веб-интерфейс.<br>
Для регистрации необходимо заполнить форму слева. Поля, выделенные жирным шрифтом, являются обязательными для заполнения.
Вся информация, сообщаемая при регистрации, охраняется законом о защите личной информации и не распространяется редакцией
ни при каких условиях. Перед заполнением формы убедитесь, что Вы не зарегистрированы в системе. Если Вы ранее публиковались
в Журнале структурной химии, то для Вас наверняка уже есть учётная запись, хотя она может быть деактивирована
редакцией. В таком случае обратитесь с письмом в редакцию.</p>
<?php else:?>
This text is not yet translated into English
<?php endif;?>
</div>
<?php slot('page_header');?>
<?php echo __('User registration');?>
<?php end_slot();?>
<?php slot('page_title');?>
<?php echo __('Journal of Structural Chemistry');?>
<?php echo ' - ';?>
<?php echo __('User registration');?>
<?php end_slot();?>

<script type="text/javascript">
$('#sf_guard_user_profile_last_name').change(function(){
	$.getJSON("<?php echo url_for('user/checkUsers');?>", {q: $(this).val(), limit: 10},
			function(data){
		    if (empty(data))
		    {
			   $('#existing_users').slideUp('slow');
			   $('existing_users .user').remove();
		    }
		   else
			   $('#existing_users').loadUsers(data).slideDown('slow');
			   var name = $.trim($('#sf_guard_user_profile_first_name').val());
			   if (!empty(name)) $('#sf_guard_user_profile_first_name').change();
		});
});
$('#sf_guard_user_profile_first_name').change(function(){
	var name = $.trim($(this).val()).toLowerCase();
	$('#existing_users .user').each(function(){
		   var user_name = $(this).find('.first_name').text();
		   if (name.indexOf(user_name.toLowerCase()) != 0) $(this).hide();
		   else
	       {
			   if ($('#existing_users').is(':hidden')) $('#existing_users').slideDown('slow');
			   $(this).show();
		   }
			   
		});
	if ($('#existing_users .user:visible').length == 0  && $('#existing_users').is(':visible')) $('#existing_users').slideUp('slow');});
</script>
