<?php
/**
 * Class for journal issues
 *
 * @package    magazine
 * @subpackage lib
 * @author     Vadim Valuev
 * @version    SVN: $Id: Issue.php 170 2009-11-08 20:38:51Z я $
 */
class Issue extends BaseIssue
{
	public function getStatusString()
	{
		switch ($this->getStatus())
		{
			case IssuePeer::OPEN:     $r = "Open";     break;
			case IssuePeer::CLOSED:   $r = "Closed";   break;
			case IssuePeer::PUBLISHED:$r = "Published";break;
		}
		return $r;
	}
}
