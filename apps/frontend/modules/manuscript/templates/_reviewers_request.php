<?php
/**
 * Suggested reviewers
 *
 * Предлагаемые рецензенты
 * @see submitSuccess.php
 * @see infoSuccess.php
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _reviewers_request.php 147 2009-06-08 19:09:19Z я $
 */
?>
<?php
/* @var $manuscript manuscript */
$reviewers = unserialize($manuscript->getReviewersRequest());
if (!empty($reviewers['recommended'])):?>
<div id="favorite_reviewers"><h4><?php echo __('Favorite reviewers');?></h4>
<?php foreach ($reviewers['recommended'] as $rev):?>
<div class="reviewer">
    <div class="name"><?php echo $rev['name'];?></div>
    <div class="email"><?php echo $rev['email'];?></div>
    <div class="institution"><?php echo $rev['institution'];?></div>
</div>
<?php endforeach;?>
</div>
<?php endif;?>
<?php if (!empty($reviewers['not_recommended'])):?>
<div id="rejected_reviewers"><h4><?php echo __('Rejected reviewers');?></h4>
<?php foreach ($reviewers['not_recommended'] as $rev):?>
<div class="reviewer">
    <div class="name"><?php echo $rev['name'];?></div>
    <div class="email"><?php echo $rev['email'];?></div>
    <div class="institution"><?php echo $rev['institution'];?></div>
</div>
<?php endforeach;?>
</div>
<?php endif;?>