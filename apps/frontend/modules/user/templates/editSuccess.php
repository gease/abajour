<?php use_helper('RenderForm'); ?>
<div id="form">
<form id="register" method="post" action="<?php echo url_for('@edit_user?user_id='.$id); ?>">
<fieldset>
<legend><?php echo __('Login info');?></legend>
<?php  echo mark_required ($userForm);?>
</fieldset>
<fieldset>
<legend><?php echo __('Personal info');?></legend>
<?php  echo mark_required ($profileForm);?>
</fieldset>
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
<?php echo __('Edit personal data');?>
<?php end_slot();?>
<?php slot('page_title');?>
<?php echo __('Journal of Structural Chemistry');?>
<?php echo ' - ';?>
<?php echo __('Personal info');?>
<?php end_slot();?>
