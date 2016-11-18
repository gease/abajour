<?php
/**
 * Last action column in manuscrips pane.
 *
 * @link http://www.symfony-project.org/api/1_2/sfDateFormat#method_getpattern 'd' и прочие варианты представления
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _last_action.php 147 2009-06-08 19:09:19Z я $
 */
?>
<?php $actions = $manuscript->getactionsByDate(); ?>
<?php if (!isset($actions[count($actions)-1])):?>
<?php echo 'failure'; ?>
<?php else: ?>
<?php echo format_datetime($actions[count($actions)-1]->getDatetime('U'), 'd');?>
<?php endif; ?>