<?php
/**
 * View review
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: viewSuccess.php 167 2009-10-10 19:06:28Z я $
 */
?>

<?php slot('page_header');?>
<?php echo __("Review");?>
<?php end_slot();?>
<h4><?php echo __('Title').':';?></h4> <?php echo $review->getmanuscript();?>
<h4><?php echo __('Authors').':';?></h4>
<?php include_partial('manuscript/authors', array('manuscript'=>$review->getmanuscript()));?>
<?php if ($sf_user->hasCredential('admin') || $sf_user->getProfile()->getId() == $review->getsfGuardUserProfile()->getId()):?>
<h4><?php echo __('Reviewer').':';?></h4><?php echo $review->getsfGuardUserProfile();?></p>
<?php endif;?>
<?php include_partial('form', array('form'=>$form, 'disabled'=>true));?>
