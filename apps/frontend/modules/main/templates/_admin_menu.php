<?php
/**
 * admin menu.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _admin_menu.php 146 2009-06-08 17:30:21Z я $
 */
?>
<ul>
<li><a href="<?php echo url_for('guard_user')?>"><?php echo __('Users management');?></a></li>
<li><a href="<?php echo url_for('manuscript')?>"><?php echo __('Manuscripts management');?></a></li>
<li><a href="<?php echo url_for('stats/index')?>"><?php echo __('General statistics');?></a></li>
</ul>