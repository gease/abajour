<?php
/**
 * Comments column, now disabled, in manuscrips list.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _comment.php 147 2009-06-08 19:09:19Z я $
 */
?>
<?php use_helper('Text');?>
<?php if ($comment = $manuscript->getComment()):?>
<?php echo truncate_text($comment);?>
<?php endif;?>