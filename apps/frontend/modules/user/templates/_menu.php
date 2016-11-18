<ul>
<li <?php if(strstr($sf_context->getRouting()->getCurrentInternalUri(true),'@edit_user')) echo 'class="activ"'; ?> >
<?php echo link_to(__('Edit personal data'), '@edit_user?user_id='.$profile->getId()); ?></li>
<li <?php if (strstr($sf_context->getRouting()->getCurrentInternalUri(true),'@create_manuscript')) echo 'class="activ"';?> >
<?php echo link_to(__('Submit manuscript'), '@create_manuscript?user_id='.$profile->getId()); ?></li>
<li <?php if (strstr($sf_context->getRouting()->getCurrentInternalUri(true),'@user_papers')) echo 'class="activ"';?>
><?php echo link_to(__('List manuscripts'), '@user_papers?user_id='.$profile->getId()); ?></li>
<?php if ($profile->getIsReviewer()):?>
<li <?php if (strstr($sf_context->getRouting()->getCurrentInternalUri(true),'@list_reviews')) echo 'class="activ"';?>
><?php echo link_to(__('List reviews'), '@list_reviews?user_id='.$profile->getId());?></li>
<?php endif;?>
</ul>