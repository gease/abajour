<?php
/**
 * review form
 *
 * @todo переписать через RenderFormHelper, только для этого нужно сам хелпер изрядно доработать
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _form.php 175 2009-11-29 14:44:42Z я $
 */
?>
<?php use_helper('RenderForm');?>
<?php if (!$disabled):?>
<?php foreach ($form->getJavascripts() as $js) echo javascript_include_tag($js);?>
<script type="text/javascript">
tinyMCE.init({
    mode : "textareas",
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
    paste_strip_class_attributes: "all"
});
</script>
<?php endif;?>
<table id = "review_form" class="review_form">
<?php if (!$disabled):?>
<tfoot>
<tr><td colspan="2">
<input type="submit" />
</td></tr>
</tfoot>
<?php endif;?>
<tbody>
<?php if ($disabled):?>
<?php echo $form->renderDisabled(true, $sf_user->hasCredential('admin'));?>
<?php else:?>
<?php echo $form->render();?>
<?php endif;?>
<?php if (!$disabled):?>
<input type="hidden" name="sf_method" value="put" />
<?php endif;?>
</tbody>
</table>