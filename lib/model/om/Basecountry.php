<?php


abstract class Basecountry extends BaseObject  implements Persistent {


	
	protected static $peer;

	
	protected $id;

	
	protected $name;

	
	protected $collsfGuardUserProfiles;

	
	private $lastsfGuardUserProfileCriteria = null;

	
	protected $collcitys;

	
	private $lastcityCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
	}

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getName()
	{
		return $this->name;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = countryPeer::ID;
		}

		return $this;
	} 
	
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = countryPeer::NAME;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating country object", $e);
		}
	}

	
	public function ensureConsistency()
	{

	} 
	
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(countryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = countryPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collsfGuardUserProfiles = null;
			$this->lastsfGuardUserProfileCriteria = null;

			$this->collcitys = null;
			$this->lastcityCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('Basecountry:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(countryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		try {
			$con->beginTransaction();
			countryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('Basecountry:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('Basecountry:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(countryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		try {
			$con->beginTransaction();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('Basecountry:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			countryPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() ) {
				$this->modifiedColumns[] = countryPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = countryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += countryPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collsfGuardUserProfiles !== null) {
				foreach ($this->collsfGuardUserProfiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collcitys !== null) {
				foreach ($this->collcitys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = countryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfGuardUserProfiles !== null) {
					foreach ($this->collsfGuardUserProfiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collcitys !== null) {
					foreach ($this->collcitys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = countryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = countryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = countryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = countryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(countryPeer::DATABASE_NAME);

		if ($this->isColumnModified(countryPeer::ID)) $criteria->add(countryPeer::ID, $this->id);
		if ($this->isColumnModified(countryPeer::NAME)) $criteria->add(countryPeer::NAME, $this->name);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(countryPeer::DATABASE_NAME);

		$criteria->add(countryPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getsfGuardUserProfiles() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addsfGuardUserProfile($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getcitys() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addcity($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new countryPeer();
		}
		return self::$peer;
	}

	
	public function clearsfGuardUserProfiles()
	{
		$this->collsfGuardUserProfiles = null; 	}

	
	public function initsfGuardUserProfiles()
	{
		$this->collsfGuardUserProfiles = array();
	}

	
	public function getsfGuardUserProfiles($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(countryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::COUNTRY, $this->id);

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserProfilePeer::COUNTRY, $this->id);

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
					$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;
		return $this->collsfGuardUserProfiles;
	}

	
	public function countsfGuardUserProfiles(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(countryPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfGuardUserProfilePeer::COUNTRY, $this->id);

				$count = sfGuardUserProfilePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserProfilePeer::COUNTRY, $this->id);

				if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
					$count = sfGuardUserProfilePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collsfGuardUserProfiles);
				}
			} else {
				$count = count($this->collsfGuardUserProfiles);
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;
		return $count;
	}

	
	public function addsfGuardUserProfile(sfGuardUserProfile $l)
	{
		if ($this->collsfGuardUserProfiles === null) {
			$this->initsfGuardUserProfiles();
		}
		if (!in_array($l, $this->collsfGuardUserProfiles, true)) { 			array_push($this->collsfGuardUserProfiles, $l);
			$l->setcountry($this);
		}
	}


	
	public function getsfGuardUserProfilesJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(countryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::COUNTRY, $this->id);

				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(sfGuardUserProfilePeer::COUNTRY, $this->id);

			if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;

		return $this->collsfGuardUserProfiles;
	}


	
	public function getsfGuardUserProfilesJoincity($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(countryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::COUNTRY, $this->id);

				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelectJoincity($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(sfGuardUserProfilePeer::COUNTRY, $this->id);

			if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelectJoincity($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;

		return $this->collsfGuardUserProfiles;
	}

	
	public function clearcitys()
	{
		$this->collcitys = null; 	}

	
	public function initcitys()
	{
		$this->collcitys = array();
	}

	
	public function getcitys($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(countryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collcitys === null) {
			if ($this->isNew()) {
			   $this->collcitys = array();
			} else {

				$criteria->add(cityPeer::COUNTRY_ID, $this->id);

				cityPeer::addSelectColumns($criteria);
				$this->collcitys = cityPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(cityPeer::COUNTRY_ID, $this->id);

				cityPeer::addSelectColumns($criteria);
				if (!isset($this->lastcityCriteria) || !$this->lastcityCriteria->equals($criteria)) {
					$this->collcitys = cityPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastcityCriteria = $criteria;
		return $this->collcitys;
	}

	
	public function countcitys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(countryPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collcitys === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(cityPeer::COUNTRY_ID, $this->id);

				$count = cityPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(cityPeer::COUNTRY_ID, $this->id);

				if (!isset($this->lastcityCriteria) || !$this->lastcityCriteria->equals($criteria)) {
					$count = cityPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collcitys);
				}
			} else {
				$count = count($this->collcitys);
			}
		}
		$this->lastcityCriteria = $criteria;
		return $count;
	}

	
	public function addcity(city $l)
	{
		if ($this->collcitys === null) {
			$this->initcitys();
		}
		if (!in_array($l, $this->collcitys, true)) { 			array_push($this->collcitys, $l);
			$l->setcountry($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collsfGuardUserProfiles) {
				foreach ((array) $this->collsfGuardUserProfiles as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collcitys) {
				foreach ((array) $this->collcitys as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collsfGuardUserProfiles = null;
		$this->collcitys = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('Basecountry:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method Basecountry::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 