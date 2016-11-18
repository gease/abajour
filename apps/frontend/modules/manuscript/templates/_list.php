<?php
/**
 * "Results number" line changed
 *
 * По сравнению с автоматически сгенерированным, изменена строка количества результатов, для нормального
 * её перевода на русский
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _list.php 147 2009-06-08 19:09:19Z я $
 */
?>
<div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result', array(), 'sf_admin') ?></p>
  <?php else: ?>
    <table cellspacing="0">
      <thead>
        <tr>
          <?php include_partial('manuscript/list_th_tabular', array('sort' => $sort)) ?>
          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="9">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('manuscript/pagination', array('pager' => $pager)) ?>
            <?php endif; ?>

            <?php echo format_number_choice('[0] no result|{n: n % 10 > 4} %1% results|{n: n % 10 > 1} %1% results|{n: n % 10 > 0} %1% results|{n: n % 10 > -1} %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($pager->getResults() as $i => $manuscript): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row <?php echo $odd ?>">
            <?php include_partial('manuscript/list_td_tabular', array('manuscript' => $manuscript, 'i'=>$i+$pager->getFirstIndice()-1)) ?>
            <?php include_partial('manuscript/list_td_actions', array('manuscript' => $manuscript, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(index in boxes) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
