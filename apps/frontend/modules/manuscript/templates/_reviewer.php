<?php
/**
 * Last reviewer
 *
 * Столбец "рецензент". Выводится последний рецензент - подразумевается, что либо рукопись
 * у него на рецензии, либо его решение было определяющим.
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _reviewer.php 147 2009-06-08 19:09:19Z я $
 */
?>
<?php $reviewers = $manuscript->getReviewers(); ?>
<?php if (!empty($reviewers)) echo $reviewers[count($reviewers)-1];?>