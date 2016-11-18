<?php
/**
 * Acceptance mail template.
 *
 * Шаблон письма, уведомляющего о приёме рукописи на рецензию
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _mReceived.php 146 2009-06-08 17:30:21Z я $
 */
?>

<?php include_partial('mail/mBegin');?>
<?php echo __('We have received your manuscript entitled "%1" and will forward it to reviewer soon.', array('%1'=>$manuscript->getTitle()))."<br><br>";?>
<?php include_partial('mail/mSign');?>
