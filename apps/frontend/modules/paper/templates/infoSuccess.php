<?php
/**
 * Full info about manuscript
 *
 * @see manuscript методы - откуда, как и что берётся
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: infoSuccess.php 177 2010-03-06 20:11:45Z я $
 */
?>

<?php slot('page_header');?>
<?php echo __('Manuscript');?>
<?php end_slot();?>
<div id="form_submit">
<h4><?php echo __('Title');?>:</h4> <?php echo $manuscript->getTitle(); ?>
<h4><?php echo __('Authors')?>:</h4>
<?php include_partial('manuscript/authors', array('manuscript'=>$manuscript));?>
<?php if ($sf_user->hasCredential('admin') || $manuscript->isAuthor($sf_user->getProfile())):?>
<h4><?php echo __('Accompanying letter')?>:</h4><?php echo $manuscript->getLetter();?>
<?php include_partial('manuscript/reviewers_request', array ('manuscript'=>$manuscript));?>
<?php endif;?>
<h4><?php echo __('Annotation')?>:</h4><?php echo $manuscript->getAnnotation();?>
<h4><?php echo __('Keywords')?>:</h4><?php include_partial('manuscript/keywords', array('manuscript'=>$manuscript));?>
<h4><?php echo __('Keywords freetext')?>:</h4><?php echo $manuscript->getKeywordsFreetext();?>
<h4><?php echo __('Status');?>:</h4><?php echo __($manuscript->getStatusString());?>
<p> <?php include_partial('files',array('files'=> $files, 'extra_files'=>$extra_files, 'id'=>$manuscript->getId())); ?></p>
<h4><?php echo __('Reviews');?>:</h4>
<?php foreach ($reviews as $review):?>
    <?php if ($sf_user->hasCredential('admin')) echo '<p>'.__('Reviewer').':  '.$review->getsfGuardUserProfile().'</p>';?>
    <?php if ($review->getContents()):?>
        <p><?php echo link_to1(__('Review'), url_for('@view_review?manuscript_id='.$manuscript->getId().'&user_id='.$review->getUserId()));?>
        </p>
     <?php endif;?>
<p>  <?php echo format_datetime($review->getSubmitted('U'), 'D').'  ';?>
     <?php echo __($review->getOutcomeString());?>
     <?php if (!is_null($review->getDecision())):?>
        <?php echo __('Final decision').':  ';?>
        <?php echo $review->getDecision()?__('Accepted'):__('Declined'); ?>
     <?php endif;?></p>
<?php endforeach;?>
<?php if (!is_null($p = $manuscript->getPublication())):?>
<?php echo '<br>'.__('Volume').'  '.$p->getVolume().' '.__('Issue').'  '.$p->getNumber().' '.__('Pages').'  '.$p->getFirstPage().'-'.$p->getLastPage();?>
<?php endif;?>
</div>
<div id="text_submit">
<?php $actions = $manuscript->getactionsByDate();?>
<?php  include_partial('actions', array('actions'=>$actions));?>
</div>