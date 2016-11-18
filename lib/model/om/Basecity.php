<?php


abstract class Basecity extends BaseObject  implements Persistent {


  const PEER = 'cityPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $name;

	
	protected $region_id;

	
	protected $country;

	
	protected $aRegion;

	
	protected $collsfGuardUserProfiles;

	
	private $lastsfGuardUserProfileCriteria = null;

	
	protected $collGuardUsers;

	
	private $lastGuardUserCriteria = null;

	
	protected $collmanuscripts;

	
	private $lastmanuscriptCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
		$this->country = 'RU';
	}

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getName()
	{
		return $this->name;
	}

	
	public function getRegionId()
	{
		return $this->region_id;
	}

	
	public function getCountry()
	{
		return $this->country;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = cityPeer::ID;
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
			$this->modifiedColumns[] = cityPeer::NAME;
		}

		return $this;
	} 
	
	public function setRegionId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->region_id !== $v) {
			$this->region_id = $v;
			$this->modifiedColumns[] = cityPeer::REGION_ID;
		}

		if ($this->aRegion !== null && $this->aRegion->getId() !== $v) {
			$this->aRegion = null;
		}

		return $this;
	} 
	
	public function setCountry($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->country !== $v || $v === 'RU') {
			$this->country = $v;
			$this->modifiedColumns[] = cityPeer::COUNTRY;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(cityPeer::COUNTRY))) {
				return false;
			}

			if ($this->country !== 'RU') {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->region_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->country = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating city object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aRegion !== null && $this->region_id !== $this->aRegion->getId()) {
			$this->aRegion = null;
		}
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
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = cityPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aRegion = null;
			$this->collsfGuardUserProfiles = null;
			$this->lastsfGuardUserProfileCriteria = null;

			$this->collGuardUsers = null;
			$this->lastGuardUserCriteria = null;

			$this->collmanuscripts = null;
			$this->lastmanuscriptCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('Basecity:delete:pre') as $callable)
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
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			cityPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('Basecity:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('Basecity:save:pre') as $callable)
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
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('Basecity:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			cityPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

												
			if ($this->aRegion !== null) {
				if ($this->aRegion->isModified() || ($this->aRegion->getCulture() && $this->aRegion->getCurrentRegionI18n()->isModified()) || $this->aRegion->isNew()) {
					$affectedRows += $this->aRegion->save($con);
				}
				$this->setRegion($this->aRegion);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = cityPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = cityPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += cityPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collsfGuardUserProfiles !== null) {
				foreach ($this->collsfGuardUserProfiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGuardUsers !== null) {
				foreach ($this->collGuardUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collmanuscripts !== null) {
				foreach ($this->collmanuscripts as $referrerFK) {
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


												
			if ($this->aRegion !== null) {
				if (!$this->aRegion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRegion->getValidationFailures());
				}
			}


			if (($retval = cityPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfGuardUserProfiles !== null) {
					foreach ($this->collsfGuardUserProfiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGuardUsers !== null) {
					foreach ($this->collGuardUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collmanuscripts !== null) {
					foreach ($this->collmanuscripts as $referrerFK) {
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
		$pos = cityPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 2:
				return $this->getRegionId();
				break;
			case 3:
				return $this->getCountry();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = cityPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getRegionId(),
			$keys[3] => $this->getCountry(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = cityPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 2:
				$this->setRegionId($value);
				break;
			case 3:
				$this->setCountry($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = cityPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRegionId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCountry($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(cityPeer::DATABASE_NAME);

		if ($this->isColumnModified(cityPeer::ID)) $criteria->add(cityPeer::ID, $this->id);
		if ($this->isColumnModified(cityPeer::NAME)) $criteria->add(cityPeer::NAME, $this->name);
		if ($this->isColumnModified(cityPeer::REGION_ID)) $criteria->add(cityPeer::REGION_ID, $this->region_id);
		if ($this->isColumnModified(cityPeer::COUNTRY)) $criteria->add(cityPeer::COUNTRY, $this->country);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(cityPeer::DATABASE_NAME);

		$criteria->add(cityPeer::ID, $this->id);

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

		$copyObj->setRegionId($this->region_id);

		$copyObj->setCountry($this->country);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getsfGuardUserProfiles() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addsfGuardUserProfile($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getGuardUsers() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addGuardUser($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getmanuscripts() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addmanuscript($relObj->copy($deepCopy));
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
			self::$peer = new cityPeer();
		}
		return self::$peer;
	}

	
	public function setRegion(Region $v = null)
	{
		if ($v === null) {
			$this->setRegionId(NULL);
		} else {
			$this->setRegionId($v->getId());
		}

		$this->aRegion = $v;

						if ($v !== null) {
			$v->addcity($this);
		}

		return $this;
	}


	
	public function getRegion(PropelPDO $con = null)
	{
		if ($this->aRegion === null && ($this->region_id !== null)) {
			$c = new Criteria(RegionPeer::DATABASE_NAME);
			$c->add(RegionPeer::ID, $this->region_id);
			$this->aRegion = RegionPeer::doSelectOne($c, $con);
			
		}
		return $this->aRegion;
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
			$criteria = new Criteria(cityPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
			   $this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::CITY_ID, $this->id);

				sfGuardUserProfilePeer::addSelectColumns($criteria);
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserProfilePeer::CITY_ID, $this->id);

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
			$criteria = new Criteria(cityPeer::DATABASE_NAME);
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

				$criteria->add(sfGuardUserProfilePeer::CITY_ID, $this->id);

				$count = sfGuardUserProfilePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfGuardUserProfilePeer::CITY_ID, $this->id);

				if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
					$count = sfGuardUserProfilePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collsfGuardUserProfiles);
				}
			} else {
				$count = count($this->collsfGuardUserProfiles);
			}
		}
		return $count;
	}

	
	public function addsfGuardUserProfile(sfGuardUserProfile $l)
	{
		if ($this->collsfGuardUserProfiles === null) {
			$this->initsfGuardUserProfiles();
		}
		if (!in_array($l, $this->collsfGuardUserProfiles, true)) { 			array_push($this->collsfGuardUserProfiles, $l);
			$l->setcity($this);
		}
	}


	
	public function getsfGuardUserProfilesJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(cityPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfGuardUserProfiles === null) {
			if ($this->isNew()) {
				$this->collsfGuardUserProfiles = array();
			} else {

				$criteria->add(sfGuardUserProfilePeer::CITY_ID, $this->id);

				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(sfGuardUserProfilePeer::CITY_ID, $this->id);

			if (!isset($this->lastsfGuardUserProfileCriteria) || !$this->lastsfGuardUserProfileCriteria->equals($criteria)) {
				$this->collsfGuardUserProfiles = sfGuardUserProfilePeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfGuardUserProfileCriteria = $criteria;

		return $this->collsfGuardUserProfiles;
	}

	
	public function clearGuardUsers()
	{
		$this->collGuardUsers = null; 	}

	
	public function initGuardUsers()
	{
		$this->collGuardUsers = array();
	}

	
	public function getGuardUsers($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(cityPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGuardUsers === null) {
			if ($this->isNew()) {
			   $this->collGuardUsers = array();
			} else {

				$criteria->add(GuardUserPeer::CITY_ID, $this->id);

				GuardUserPeer::addSelectColumns($criteria);
				$this->collGuardUsers = GuardUserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GuardUserPeer::CITY_ID, $this->id);

				GuardUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastGuardUserCriteria) || !$this->lastGuardUserCriteria->equals($criteria)) {
					$this->collGuardUsers = GuardUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGuardUserCriteria = $criteria;
		return $this->collGuardUsers;
	}

	
	public function countGuardUsers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(cityPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collGuardUsers === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(GuardUserPeer::CITY_ID, $this->id);

				$count = GuardUserPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GuardUserPeer::CITY_ID, $this->id);

				if (!isset($this->lastGuardUserCriteria) || !$this->lastGuardUserCriteria->equals($criteria)) {
					$count = GuardUserPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collGuardUsers);
				}
			} else {
				$count = count($this->collGuardUsers);
			}
		}
		return $count;
	}

	
	public function addGuardUser(GuardUser $l)
	{
		if ($this->collGuardUsers === null) {
			$this->initGuardUsers();
		}
		if (!in_array($l, $this->collGuardUsers, true)) { 			array_push($this->collGuardUsers, $l);
			$l->setcity($this);
		}
	}


	
	public function getGuardUsersJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(cityPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGuardUsers === null) {
			if ($this->isNew()) {
				$this->collGuardUsers = array();
			} else {

				$criteria->add(GuardUserPeer::CITY_ID, $this->id);

				$this->collGuardUsers = GuardUserPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(GuardUserPeer::CITY_ID, $this->id);

			if (!isset($this->lastGuardUserCriteria) || !$this->lastGuardUserCriteria->equals($criteria)) {
				$this->collGuardUsers = GuardUserPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastGuardUserCriteria = $criteria;

		return $this->collGuardUsers;
	}


	
	public function getGuardUsersJoinsfGuardUserProfile($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(cityPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGuardUsers === null) {
			if ($this->isNew()) {
				$this->collGuardUsers = array();
			} else {

				$criteria->add(GuardUserPeer::CITY_ID, $this->id);

				$this->collGuardUsers = GuardUserPeer::doSelectJoinsfGuardUserProfile($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(GuardUserPeer::CITY_ID, $this->id);

			if (!isset($this->lastGuardUserCriteria) || !$this->lastGuardUserCriteria->equals($criteria)) {
				$this->collGuardUsers = GuardUserPeer::doSelectJoinsfGuardUserProfile($criteria, $con, $join_behavior);
			}
		}
		$this->lastGuardUserCriteria = $criteria;

		return $this->collGuardUsers;
	}

	
	public function clearmanuscripts()
	{
		$this->collmanuscripts = null; 	}

	
	public function initmanuscripts()
	{
		$this->collmanuscripts = array();
	}

	
	public function getmanuscripts($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(cityPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collmanuscripts === null) {
			if ($this->isNew()) {
			   $this->collmanuscripts = array();
			} else {

				$criteria->add(manuscriptPeer::CITY_ID, $this->id);

				manuscriptPeer::addSelectColumns($criteria);
				$this->collmanuscripts = manuscriptPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(manuscriptPeer::CITY_ID, $this->id);

				manuscriptPeer::addSelectColumns($criteria);
				if (!isset($this->lastmanuscriptCriteria) || !$this->lastmanuscriptCriteria->equals($criteria)) {
					$this->collmanuscripts = manuscriptPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastmanuscriptCriteria = $criteria;
		return $this->collmanuscripts;
	}

	
	public function countmanuscripts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(cityPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collmanuscripts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(manuscriptPeer::CITY_ID, $this->id);

				$count = manuscriptPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(manuscriptPeer::CITY_ID, $this->id);

				if (!isset($this->lastmanuscriptCriteria) || !$this->lastmanuscriptCriteria->equals($criteria)) {
					$count = manuscriptPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collmanuscripts);
				}
			} else {
				$count = count($this->collmanuscripts);
			}
		}
		return $count;
	}

	
	public function addmanuscript(manuscript $l)
	{
		if ($this->collmanuscripts === null) {
			$this->initmanuscripts();
		}
		if (!in_array($l, $this->collmanuscripts, true)) { 			array_push($this->collmanuscripts, $l);
			$l->setcity($this);
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
			if ($this->collGuardUsers) {
				foreach ((array) $this->collGuardUsers as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collmanuscripts) {
				foreach ((array) $this->collmanuscripts as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collsfGuardUserProfiles = null;
		$this->collGuardUsers = null;
		$this->collmanuscripts = null;
			$this->aRegion = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('Basecity:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method Basecity::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 