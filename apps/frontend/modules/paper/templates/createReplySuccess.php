<?php
/**
 * Submit reply to reviewer's comment
 *
 * @todo написать текст и оформить
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: createReplySuccess.php 177 2010-03-06 20:11:45Z я $
 */
?>
<form method="post" action="<?php echo url_for('@submit_reply?id='.$form->getObject()->getId());?>"
                                        enctype="multipart/form-data" >
<input type="hidden" name="sf_method" value="put">
<table>
<?php echo $form->render();?>
<tr><td><input type="submit" /></td></tr>
</table>
</form>