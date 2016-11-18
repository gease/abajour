<?php slot('page_header');?>
<?php echo __('Reviews');?>
<?php end_slot();?>
<table>
<?php foreach ($reviews as $review):?>
<?php $manuscript = $review->getmanuscript();?>
<tr>
<td><?php echo $manuscript->getTitle();?></td>
<td><?php include_partial('manuscript/authors', array('manuscript'=>$manuscript));?></td>
<td><?php echo __($manuscript->getStatusString());?></td>
<td><?php echo format_datetime($review->getSubmitted('U'), 'D');?></td>
<td><a href="<?php echo url_for('@manuscript_info?id='.$review->getManuscriptId());?>"><?php echo __('Info');?></a></td>
<td>
<?php if ($review->getOutcome() == reviewPeer::UNREVIEWED):?>
<a href="<?php echo url_for('@edit_review?manuscript_id='.$review->getManuscriptId().'&user_id='.$review->getUserId());?>"><?php echo __('Submit review');?></a>
<a href="<?php echo url_for('@reject_review?manuscript_id='.$review->getManuscriptId().'&user_id='.$review->getUserId());?>"><?php echo __('Reject reviewing');?></a>
<?php endif;?>
<?php if ($review->getOutcome() != reviewPeer::UNREVIEWED && $review->getOutcome() != reviewPeer::REFUSED_REVIEW):?>
<a href="<?php echo url_for('@view_review?manuscript_id='.$review->getManuscriptId().'&user_id='.$review->getUserId());?>"><?php echo __('View review')?></a>
<?php endif;?>
<?php if ($review->getOutcome() != reviewPeer::UNREVIEWED && $manuscript->getStatus() == manuscriptPeer::REVIEW_FINAL):?>
<a href="<?php echo url_for('@edit_review_final?manuscript_id='.$review->getManuscriptId().'&user_id='.$review->getUserId());?>"><?php echo __('Take final decision')?></a>
<?php endif;?>
</td>
</tr>
<?php endforeach;?>
</table>