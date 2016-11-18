<?php
/**
 * Paper submit page
 *
 * Страница подачи рукописи. В количестве использует яваскрипт.
 *
 * @todo Структурировать, по возможности вынести яваскрипт в форму или виджеты, или хотя бы
 * в отдельный файл
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: submitSuccess.php 185 2010-03-23 15:42:48Z я $
 */
?>

<?php use_helper('RenderForm'); ?>
<?php use_javascript('submit');?>
<script type="text/javascript">
<!--

var name_corr = "<?php echo sprintf($form->getWidgetSchema()->getNameFormat(), 'corresponding'); ?>";
var autocomplete_url = '<?php echo url_for('user/autocomplete', true); ?>';
var recommended_id = '#<?php echo $form['number_recommended']->renderId();?>';
var not_recommended_id = '#<?php echo $form['number_not_recommended']->renderId();?>';
var form_name = "<?php echo sprintf($form->getWidgetSchema()->getNameFormat(), 'recommended'); ?>";
var form_name1 = "<?php echo sprintf($form->getWidgetSchema()->getNameFormat(), 'not_recommended'); ?>";
var is_bound = <?php echo $form->isBound()?'true':'false'; ?>;
<?php if ($form->isBound()):?>
<?php $corr = $form['corresponding']->getValue();?>
var corresponding = <?php if (!empty($corr)) echo $corr; else echo "''";?>;
var author = '';
var author_id = '';
<?php endif; ?>
<?php if (isset($author)):?>
var author = '<?php echo $author;?>';
var author_id = <?php echo $author->getId();?>;
<?php endif;?>

var strings = {remove: "<?php echo __('Remove')?>",
		       corresponding: "<?php echo __('Corresponding author')?>",
			   error_empty: "<?php echo __('Fields cannot be empty')?>"};

//-->
</script>
<div id="form_submit">
<?php $user_id = isset($author)? $author->getId() : '';?>
<form action="<?php echo url_for('@submit_manuscript?user_id='.$user_id); ?>" method="post" enctype="multipart/form-data">
<?php if ($form->hasGlobalErrors()) echo $form->renderGlobalErrors();?>
<ul>
<fieldset>
<legend><?php echo __('Manuscript');?></legend>
<?php echo show_field($form, 'title'); ?>
<li class="required <?php if ($form['user_manuscript_ref_list']->hasError() || $form['corresponding']->hasError()) echo 'error';?>">
<?php if ($form['user_manuscript_ref_list']->hasError() || $form['corresponding']->hasError()):?>
<?php echo $form['user_manuscript_ref_list']->renderError();?>
<?php echo $form['corresponding']->renderError();?>
<?php endif;?>
<?php echo $form['user_manuscript_ref_list']->renderLabel();?>
<input type="text" id="author_autocomplete" size="50"/><?php echo show_help($form, 'user_manuscript_ref_list')?></li>
<div style="display:none"><?php echo $form['user_manuscript_ref_list']->render();?></div>
<div id="authors_list"></div>
<?php //echo show_field($form, 'keyword_manuscript_ref_list'); ?>
<?php echo show_field($form, 'keywords_freetext'); ?>
<?php echo show_field($form, 'annotation'); ?>
<?php echo show_field($form, 'letter'); ?>
<?php echo show_field($form, 'file'); ?>
<?php if (isset($form['archive_file'])):?>
<?php echo show_field($form, 'archive_file'); ?>
<?php endif;?>
<input type="hidden" name="sf_method" value="PUT" />
</fieldset>
<fieldset>
<legend><?php echo __('Suggested reviewers');?></legend>
<?php echo show_embedded_form($form, 'recommended_fields');?>
<div class="submit_button"><input type="button" id="but_favorite" value="<?php echo __('add to favorites');?>"/>
<input type="button" id="but_undesirable" value="<?php echo __('add to rejected');?>"/>
</div>
<div id="favorite_reviewers">
<h4><?php echo __('Favorite reviewers');?></h4></div>
<div id="rejected_reviewers"><h4><?php echo __('Rejected reviewers');?></h4></div>
</fieldset>
<?php echo $form->renderHiddenFields();?>
<div class="submit_button"><input type="submit" value="<?php echo __('Submit article'); ?>"/></div>
</ul>
</form>
</div>
<div id="text_submit">
<?php if ($sf_user->getCulture()=='ru'):?>
Заполните форму слева, чтобы подать статью в редакцию Журнала структурной химии. Рукопись должна
быть выполнена в формате Word Document (doc или docx) <!--LaTeX, и запакована в zip-архив вместе с файлами рисунков (не более 8ми).-->
Все авторы подаваемой рукописи должны быть зарегистрированы в системе. В поле "Авторы" всплывает подсказка по мере
ввода символов. Если среди перечисленных в подсказке людей нет Вашего соавтора, ему необходимо зарегистрироваться в системе
(или Вы это можете сделать за него). Для этого нужно выйти из системы (кнопка в правом верхнем углу) и пойти по ссылке "Зарегистрироваться".
Порядок авторов рукописи устанавливается перетаскиванием фамилий мышкой, автор для переписки отмечается переключателем справа от фамилии.<br>
Кроме необходимой информации, Вы можете указать желаемых рецензентов и тех, кому бы Вы не хотели доверять рецензирование Вашей рукописи.
Подав рукопись, Вы сможете наблюдать за её состоянием в разделе "Список статей", кроме того, по получении рецензии Вы будете извещены по электроннй почте.
<?php else:?>
Please fill in the form to the left.
<?php endif;?></div>
<script type="text/javascript">
<?php if (isset($form['recommended'])):?>
<?php foreach ($form['recommended'] as $reviewer):?>
append_reviewer([["<?php echo $reviewer['name']->getValue();?>", <?php echo $reviewer['name']->hasError();?>], ["<?php echo $reviewer['email']->getValue();?>",<?php echo $reviewer['email']->hasError();?>], ["<?php echo $reviewer['institution']->getValue();?>",<?php echo $reviewer['institution']->hasError();?>]],'#favorite_reviewers');
<?php endforeach;?>
<?php endif;?>
<?php if (isset($form['not_recommended'])):?>
<?php foreach ($form['not_recommended'] as $reviewer):?>
append_reviewer([["<?php echo $reviewer['name']->getValue();?>", <?php echo $reviewer['name']->hasError();?>], ["<?php echo $reviewer['email']->getValue();?>",<?php echo $reviewer['email']->hasError();?>], ["<?php echo $reviewer['institution']->getValue();?>",<?php echo $reviewer['institution']->hasError();?>]],'#rejected_reviewers');
<?php endforeach;?>
<?php endif;?>
$('#but_favorite').click( function(){append_reviewer([[$('#name').val(), false], [$('#email').val(), false], [$('#institution').val(), false]],'#favorite_reviewers');});
$('#but_undesirable').click( function(){append_reviewer([[$('#name').val(), false], [$('#email').val(), false], [$('#institution').val(), false]],'#rejected_reviewers');});
tinyMCE.init({
    mode : "exact",
    elements: "manuscript_title",
    theme: "advanced",
    language: "<?php echo $sf_user->getCulture();?>",
    plugins : "inlinepopups, paste, safari",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,
    theme_advanced_resize_horizontal : false,
    theme_advanced_path: false,
    theme_advanced_disable: "image, cleanup, code, help, styleselect, formatselect, removeformat, visualaid, anchor, hr",
    theme_advanced_buttons1: "bold, italic, underline, strikethrough, separator, sub, sup, charmap, separator,pastetext,pasteword,selectall",
    theme_advanced_buttons2: "",
    theme_advanced_buttons3: "",
    paste_retain_style_properties: "font-size, font-style, font-family, font-weight, color",
    paste_strip_class_attributes: "all",
    paste_remove_styles_if_webkit: false,
    force_p_newlines: false
});
tinyMCE.init({
	mode : "exact",
    elements: "manuscript_annotation,manuscript_letter",
    theme: "advanced",
    language: "<?php echo $sf_user->getCulture();?>",
    plugins : "inlinepopups, paste, safari",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,
    theme_advanced_resize_horizontal : false,
    theme_advanced_path: false,
    theme_advanced_disable: "image, cleanup, code, help, styleselect, formatselect, removeformat, visualaid, anchor, hr",
    theme_advanced_buttons1: "bold, italic, underline, strikethrough, separator, justifyleft, justifycenter, justifyright, justifyfull, separator, bullist, numlist, separator,indent, outdent, separator, link, unlink, separator, sub, sup, charmap",
    theme_advanced_buttons2: "pastetext,pasteword,selectall",
    theme_advanced_buttons3: "",
    paste_retain_style_properties: "font-size, font-style, font-family, font-weight, color",
    paste_strip_class_attributes: "all",
    paste_remove_styles_if_webkit: false
});
</script>
<?php slot('page_header');?>
<?php echo __('Submit manuscript');?>
<?php end_slot();?>
