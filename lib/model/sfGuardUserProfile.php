<?php

/**
 * Subclass for representing a row from the 'sf_guard_user_profile' table.
 *
 *
 *
 * @package lib.model
 */
class sfGuardUserProfile extends BasesfGuardUserProfile
{
    public function getBirthday($format = 'U')
    {
        return parent::getBirthday($format);
    }
    
	public function __toString()
	{
		return $this->getLastName().' '.$this->getFirstName().' '.$this->getMiddleName();
	}
		
	public function getManuscripts(Criteria $c = null)
	{
		if ($c === null) {
			$c = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
		}
		elseif ($c instanceof Criteria)
		{
			$c = clone $c;
		}
		$c->add(userManuscriptRefPeer::USER_ID, $this->getUserId());
		$xrefs = userManuscriptRefPeer::doSelectJoinmanuscript($c);
		$manuscripts = array();
		foreach ($xrefs as $xref){
			$manuscripts[] = $xref->getmanuscript();
		}
		return $manuscripts;
	}
	
	public function getId()
	{
		return $this->getUserId();
	}
	
    public function generateUsername()
    {
        $last_name = $this->getLastName();
        $first_name = $this->getFirstName();
        $last_name = mb_ereg_replace('[\' ]', '', $last_name);
        $last_name = mb_strtolower($last_name);
        $l = mb_strlen($last_name) > 3 ? 4 : mb_strlen($last_name);
        $username = mb_substr($last_name, 0, $l).mb_substr(mb_strtolower($first_name), 0, 1);
        $i = 0;
        while (sfGuardUserPeer::retrieveByUsername($username.sprintf("%02d",$i)))
        {
            $i++;
        }
        return $username.sprintf("%02d",$i);
    }
    
    
}
