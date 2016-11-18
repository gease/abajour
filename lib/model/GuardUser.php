<?php

class GuardUser extends BaseGuardUser
{
	public function getBirthday($format = 'U')
	{
		return parent::getBirthday($format);
	}
	public function __toString()
	{
		return $this->getLastName().' '.$this->getFirstName().' '.$this->getMiddleName();
	}
	
}
