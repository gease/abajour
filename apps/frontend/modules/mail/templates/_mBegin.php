<?php
/**
 * Mail beginning template partial.
 *
 * Шаблон начала писем.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _mRejected.php 146 2009-06-08 17:30:21Z я $
 */
?>
<?php echo format_number_choice('[0]Dear|[1]Dear', array(), ($to->getGender() == 'M') ? 0 : 1) . ' '; ?>
<?php if (sfContext::getInstance()->getI18N()->getCulture() == 'ru'): ?>
  <?php echo $to->getFirstName() . " "; ?>
  <?php if (mb_strlen($to->getMiddleName()) > 2): ?>
    <?php echo $to->getMiddleName(); ?>
  <?php endif; ?>
<?php else: ?>
  <?php echo 'Dr.' . $to->getFirstName() . " " . $to->getLastName(); ?>
<?php endif; ?>
<?php echo ",<br>";?>
