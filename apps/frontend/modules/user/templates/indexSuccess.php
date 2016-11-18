<p> <?php echo __('Welcome, '). $profile; ?></p>
<p><?php echo link_to(__('Edit personal data'), '@edit_user?user_id='.$profile->getId()); ?></p>
<p><?php echo link_to(__('Submit manuscript'), '@create_manuscript?user_id='.$profile->getId()); ?></p>
<p><?php echo link_to(__('List manuscripts'), '@user_papers?user_id='.$profile->getId()); ?></p>
<?php if ($profile->getIsReviewer()):?>
<p><?php echo link_to(__('List reviews'), '@list_reviews?user_id='.$profile->getId());?>
<?php endif;?>