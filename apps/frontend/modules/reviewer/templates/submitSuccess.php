<?php
/**
 * Review submission.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: submitSuccess.php 151 2009-06-09 19:38:05Z я $
 */
?>
<?php slot('page_header');?>
<?php echo __('Submit review');?>
<?php end_slot();?>
<form action="<?php echo url_for(array('sf_route'=>'submit_review','user_id'=>$object->getUserId(), 'manuscript_id'=>$object->getManuscriptId()));?>" method="post"
  enctype="multipart/form-data">
<?php include_partial('reviewer/form', array('form'=>$form, 'disabled'=>false));?>
</form>
