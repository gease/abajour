<?php
/**
 * Peer class for journal issues
 *
 * @package    magazine
 * @subpackage lib
 * @author     Vadim Valuev
 * @version    SVN: $Id: IssuePeer.php 170 2009-11-08 20:38:51Z я $
 */
class IssuePeer extends BaseIssuePeer
{
	/**
	 * В процессе формирования
	 */
	const OPEN      = 0;
	/**
	 * Сформирован, но не опубликован
	 */
	const CLOSED    = 1;
	/**
	 * Опубликован
	 */
	const PUBLISHED = 2;
}
