<?php slot('page_header');?>
<?php echo __('Manuscripts list');?>
<?php end_slot();?>
<table>
<?php foreach ($user->getmanuscripts() as $manuscript):?>
<tr>
<td><?php echo link_to( $manuscript->getTitle(), '@manuscript_info?id='.$manuscript->getId()); ?></td>
<td><?php echo __($manuscript->getStatusString()); ?>
<td><?php include_partial ('manuscript/authors', array('manuscript'=>$manuscript)) ?></td>
<td><?php if ($manuscript->getStatus() == manuscriptPeer::UNDER_REWRITE):?>
<?php echo link_to(__('Submit reply'), '@create_reply?id='.$manuscript->getId())?>
<?php endif;?>
</td>
</tr>
<?php endforeach;?>
</table>