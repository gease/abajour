<?php
/**
 * Actions list
 *
 * @link http://www.symfony-project.org/api/1_2/sfDateFormat#method_getpattern 'D' и прочие варианты представления
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _actions.php 149 2009-06-09 17:53:40Z я $
 */
?>
<?php foreach ($actions as $action): ?>
<div>
<span><?php echo __(manuscriptPeer::statusString($action->getStatusAfter()))?>&nbsp;</span>
<span><?php echo format_datetime($action->getDatetime('U'), 'D');?></span>
</div>
<?php endforeach;?>