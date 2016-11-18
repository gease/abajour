<?php
/**
 * Manuscript change status page
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: changeStatusSuccess.php 147 2009-06-08 19:09:19Z я $
 */
?>
<?php include_partial('manuscript/assets') ?>
<?php slot ('page_header');?>
<?php echo __('Change status');?>
<?php end_slot();?>
<p><?php echo $manuscript->getTitle(); ?></p>
<p>
<?php include_partial('manuscript/authors', array('manuscript'=>$manuscript));?>
</p>
<form method="post" action="<?php echo url_for('@changed_status?id='.$manuscript->getId());?>" >
<?php echo $form; ?>
<input type="hidden" name="sf_method" value="put" />
<input type="submit" />
</form>
