<?php

/**
 * user components.
 *
 * @package    CompTechnologies
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 142 2009-06-07 13:24:09Z я $
 */

class userComponents extends sfComponents
{
	public function executeMenu ($request)
	{
		$this->profile = $this->getUser()->getProfile();
	}
}
?>