<?php
/**
 * keywords, to display where needed
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _keywords.php 147 2009-06-08 19:09:19Z я $
 */
?>
<?php
$keywords = $manuscript->getKeywords();
for ($i=0; $i<count($keywords); $i++)
{
	echo $keywords[$i];
	if ($i<count($keywords)-1) echo '; ';
}