<?php
/**
 * Acceptance mail template.
 *
 * Шаблон письма, уведомляющего о приёме рукописи к публикации
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _mAccepted.php 146 2009-06-08 17:30:21Z я $
 */
?>
<?php include_partial('mail/mBegin');?>
<?php echo __('I am pleased to inform you that your manuscript entitled "%1" is accepted for publication in Journal of Structural Chemistry and will appear in due course.', array('%1'=>$manuscript->getTitle()))."<br><br>";?>
<?php include_partial('mail/mSign');?>
