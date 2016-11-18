<?php
/**
 * Date submitted
 *
 * @link http://www.symfony-project.org/api/1_2/sfDateFormat#method_getpattern 'd' и прочие варианты представления
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _submitted.php 160 2009-06-18 19:33:01Z я $
 */
?>
<?php echo format_datetime($manuscript->getSubmittedDatetime('U'), 'd');?>