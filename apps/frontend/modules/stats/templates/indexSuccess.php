<?php
/**
 * stats page.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: indexSuccess.php 160 2009-06-18 19:33:01Z я $
 *
 * @todo переписать через partials
 */
?>
<form method="get" action="<?php echo url_for('stats/index')?>" >
<?php echo $form; ?>
<input type="submit">
</form>
<?php if (!empty($totals)):?>
<table>
<thead>
<th><?php echo __('Region');?></th>
<th><?php echo __('Submitted');?></th>
<th><?php echo __('of them');?></th>
<th><?php echo __('Published or accepted');?></th>
<th><?php echo __('Rejected');?></th>
<th><?php echo __('Under consideration');?></th>
</thead>
<tbody>
<?php foreach ($regions as $name => $value):?>
<tr>
<td><?php echo $name;?></td>
<td><?php echo $value['total'];?></td>
<td></td>
<td><?php echo $value['published'];?></td>
<td><?php echo $value['rejected'];?></td>
<td><?php echo $value['total'] - $value['rejected'] - $value['published'];?></td>
</tr>
<?php endforeach;?>
</tbody>
<tfoot>
<td><?php echo __('Total');?></td>
<td><?php echo $totals['total'];?></td>
<td></td>
<td><?php echo $totals['published'];?></td>
<td><?php echo $totals['rejected'];?></td>
<td><?php echo $totals['total'] - $totals['rejected'] - $totals['published'];?></td>
</tfoot>
</table>
<?php endif;?>
<?php if (!empty($ages)):?>
<h3><?php echo __('Age distribution');?></h3>
<p><?php echo __('Number of authors falling into coresponding age span.')?></p>
<table>
<thead>
<?php $lower = 0;?>
<?php foreach (sfConfig::get('app_age_split') as $limit):?>
<th><?php echo $lower.'-'.$limit;?></th>
<?php $lower = $limit;?>
<?php endforeach;?>
<th><?php echo $lower.'-';?></th>
</thead>
<tbody>
<tr>
<?php foreach ($ages as $n):?>
<td><?php echo $n;?></td>
<?php endforeach;?>
</tr>
</tbody>
</table>
<?php endif;?>
<?php if(!empty($numbers)):?>
<h3><?php echo __('Manuscripts per author')?></h3>
<table>
<thead>
<th><?php echo __('Sumbitted single manuscript')?></th>
<th><?php echo __('Sumbitted two manuscripts')?></th>
<th><?php echo __('Sumbitted 3 or more')?></th>
</thead>
<tbody>
<tr>
<?php foreach ($numbers as $n):?>
<td><?php echo $n;?></td>
<?php endforeach;?>
</tr>
</tbody>
</table>
<?php endif;?>
<?php if(!empty($return)):?>
<h3><?php echo __('Returning authors')?></h3>
<table>
<thead>
<th><?php echo __('Previously submitted manuscripts');?></th><th><?php echo __('Already published in JCT');?></th>
</thead>
<tbody>
<tr>
<?php foreach ($return as $r):?>
<td><?php echo $r;?></td>
<?php endforeach;?>
</tr>
</tbody>
</table>
<?php endif;?>