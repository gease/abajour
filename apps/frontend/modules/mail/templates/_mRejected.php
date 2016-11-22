<?php
/**
 * Rejection mail template.
 *
 * Шаблон письма, уведомляющего об отказе в публикации
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _mRejected.php 146 2009-06-08 17:30:21Z я $
 */
?>

<?php include_partial('mail/mBegin', array('to' => $to)); ?>
<?php echo __('I have to inform you that your manuscript entitled "%1" is rejected by editorial board of Journal of Structural Chemistry.', array('%1'=>$manuscript->getTitle()))."<br>";?>
<?php
$review = $manuscript->getLastReview();
if (!is_null($review)):?>
<?php echo __("Please find the copy of reviewer's remarks below")."<br><br>";?>
<?php endif;?>
<?php include_partial('mail/mSign');?>
