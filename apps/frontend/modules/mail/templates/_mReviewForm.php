<?php
/**
 * Review form mail template.
 *
 * Шаблон формы рецензии, посылаемый автору.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _mRewrite.php 146 2009-06-08 17:30:21Z я $
 */
?>
<?php $form = reviewPeer::getForm($review);?>
<table>
<tbody>
<?php echo $form->renderDisabled(false, false);?>
</tbody>
</table>