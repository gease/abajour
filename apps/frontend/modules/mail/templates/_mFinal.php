<?php
/**
 * Final review mail template.
 *
 * Шаблон письма, направляемого рецензенту с исправленной версией рукописи.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _mFinal.php 146 2009-06-08 17:30:21Z я $
 */
?>

<?php include_partial('mail/mBegin');?>
<?php echo __('Please check the corrections made by authors of %1 %2 according to your remarks.', array('%1'=>get_partial('manuscript/authors', array('manuscript'=>$manuscript)),'%2'=>$manuscript->getTitle()))."<br><br>";?>
<?php echo __('Please reply with your final decision within two weeks if possible.').'<br><br>';?>
<?php include_partial('mail/mSign'); ?>
