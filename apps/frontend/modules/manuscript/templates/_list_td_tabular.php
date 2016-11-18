<?php
/**
 * Reloading generated from cache
 *
 * Перегрузка автоматически генерируемого, чтобы добавить порядковый номер ($i)
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _list_td_tabular.php 147 2009-06-08 19:09:19Z я $
 */
?>
<td class="sf_admin_text sf_admin_list_th_number">
  <?php echo get_partial('number', array('type' => 'list', 'manuscript' => $manuscript, 'i' => $i)) ?>
</td>
<td class="sf_admin_text sf_admin_list_th_authors">
  <?php echo get_partial('authors', array('type' => 'list', 'manuscript' => $manuscript)) ?>
</td>
<td class="sf_admin_text sf_admin_list_th_title">
  <?php echo $manuscript->getTitle() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_th_city_id">
  <?php echo get_partial('city', array('type' => 'list', 'manuscript' => $manuscript)) ?>
</td>
<td class="sf_admin_text sf_admin_list_th_status">
  <?php echo get_partial('status', array('type' => 'list', 'manuscript' => $manuscript)) ?>
</td>
<td class="sf_admin_text sf_admin_list_th_submitted">
  <?php echo get_partial('submitted', array('type' => 'list', 'manuscript' => $manuscript)) ?>
</td>
<td class="sf_admin_text sf_admin_list_th_reviewer">
  <?php echo get_partial('reviewer', array('type' => 'list', 'manuscript' => $manuscript)) ?>
</td>
<td class="sf_admin_text sf_admin_list_th_last_action">
  <?php echo get_partial('last_action', array('type' => 'list', 'manuscript' => $manuscript)) ?>
</td>
