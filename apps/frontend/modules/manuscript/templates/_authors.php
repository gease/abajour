<?php
 /**
 * Authors rendering.
 *
 * Вывод списка авторов. Применяется повсеместно.
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _authors.php 147 2009-06-08 19:09:19Z я $
 */
?>
<?php $authors = $manuscript->getAuthors();?>
<?php for ($i = 0; $i<count($authors); $i++): ?>
<?php if ($manuscript->isCorresponding($authors[$i])) echo '<b>';?>
<?php echo $authors[$i];?>
<?php if ($manuscript->isCorresponding($authors[$i])) echo '</b>';?>
<?php if ($i<count($authors)-1) echo ', ';?>
<?php endfor;?>