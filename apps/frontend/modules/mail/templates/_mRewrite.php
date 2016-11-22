<?php
/**
 * Rewrite mail template.
 *
 * Шаблон письма,направляемого авторам при отправлении рукописи на переработку
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _mRewrite.php 146 2009-06-08 17:30:21Z я $
 */
?>

<?php include_partial('mail/mBegin', array('to' => $to));?>
<?php echo __("I'm forwarding you reviewer's comments on your manuscript entitled \"%1\".", array('%1'=>$manuscript->getTitle()))."<br>";?>
<?php echo __("Your paper may be accepted for publication in the Journal of Structural Chemistry upon receipt of the final version. The decision will be taken by the Editors after a consultation with the reviewer.")."<br><br>";?>
<?php include_partial('mail/mSign');?>
