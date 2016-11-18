<?php
/**
 * Sorting ability added
 *
 * Перегрузка автоматически сгенерированного заголовка таблицы
 * Ко всем заголовкам добавлена возможность сортировки по соответствующему столбцу
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _list_th_tabular.php 147 2009-06-08 19:09:19Z я $
 */
?>
<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_comment">
 <?php echo __('#', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>
<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_authors">
  <?php if ('authors' == $sort[0]): ?>
    <?php echo link_to(__('Authors', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=authors&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Authors', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=authors&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_title">
  <?php if ('title' == $sort[0]): ?>
    <?php echo link_to(__('Title', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=title&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Title', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=title&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_foreignkey sf_admin_list_th_city_id">
  <?php if ('city' == $sort[0]): ?>
    <?php echo link_to(__('City', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=city&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('City', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=city&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_status">
  <?php if ('status' == $sort[0]): ?>
    <?php echo link_to(__('Status', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=status&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Status', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=status&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_submitted">
  <?php if ('submitted' == $sort[0]): ?>
    <?php echo link_to(__('Submitted', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=submitted&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Submitted', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=submitted&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_reviewer">
 <?php if ('reviewer' == $sort[0]): ?>
    <?php echo link_to(__('Reviewer', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=reviewer&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Reviewer', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=reviewer&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_last_action">
 <?php if ('action' == $sort[0]): ?>
    <?php echo link_to(__('Last action', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=action&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Last action', array(), 'messages'), 'manuscript', array(), array('query_string' => 'sort=action&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>