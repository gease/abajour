<?php
/**
 * change language template.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _language.php 146 2009-06-08 17:30:21Z я $
 */
?>

<span><?php echo link_to('Eng', '@change_language?language=en', array('post'=>true,'query_string'=>'language=en'));?></span>
<span><?php echo link_to('Рус', '@change_language?language=ru', array('post'=>true,'query_string'=>'language=ru'));?></span>