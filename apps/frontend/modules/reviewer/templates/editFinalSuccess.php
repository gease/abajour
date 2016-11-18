<?php
/**
 * Final reviewer's decision.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: editFinalSuccess.php 151 2009-06-09 19:38:05Z я $
 */
?>
<form action="<?php echo url_for(array('sf_route'=>'submit_review_final','user_id'=>$object->getUserId(), 'manuscript_id'=>$object->getManuscriptId()));?>" method="post"
  enctype="multipart/form-data">
<input type="hidden" name="sf_method" value="put" />
<?php echo $form;?>
<input type="submit" />
</form>