<?php
/**
 * Reviewer mail template.
 *
 * Шаблон письма, направляемого рецензенту
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _mReview.php 146 2009-06-08 17:30:21Z я $
 */
?>

<?php include_partial('mail/mBegin');?>
<?php echo __('Editorial board of Journal of Structural Chemistry would like to ask you to write a review on manuscript entitled "%1" by %2.', array('%1'=>$manuscript->getTitle(), '%2'=>get_partial('manuscript/authors', array('manuscript'=>$manuscript))))."<br>";?>
<?php echo __("We would appreciate if you could provide your review within 2 weeks. Thank you in advance for your assistance.")."<br><br>";?>
<?php include_partial('mail/mSign');?>

