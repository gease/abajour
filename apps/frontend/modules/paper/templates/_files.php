<?php
/**
 * List of files with manuscript versions
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _files.php 182 2010-03-17 14:48:45Z я $
 */
?>
<?php foreach ($files as $action_id=>$file): ?>
<?php echo link_to(__('File'), '@show_file?id='.$id.'&action_id='.$action_id, array('popup'=>true))."\t"; ?>
<?php echo __('size').' '.sprintf("%d",$file['size']/1024) .__('Kb')."\t"; ?>
<?php echo __('created').' '.format_datetime($file['date'], 'f')."<br>"; ?>
<?php endforeach;?>
<?php foreach ($extra_files as $action_id=>$file): ?>
<?php echo link_to(__('Zipped extra files'), '@show_extra_file?id='.$id.'&action_id='.$action_id, array('popup'=>true))."\t"; ?>
<?php echo __('size').' '.sprintf("%d",$file['size']/1024) .__('Kb')."\t"; ?>
<?php echo __('created').' '.format_datetime($file['date'], 'f')."<br>"; ?>
<?php endforeach;?>