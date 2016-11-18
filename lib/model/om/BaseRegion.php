<?php


abstract class BaseRegion extends BaseObject  implements Persistent {


  const PEER = 'RegionPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $collcitys;

	
	private $lastcityCriteria = null;

	
	protected $collRegionI18ns;

	
	private $lastRegionI18nCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
	}

	
	public function getId()
	{
		return $this->id;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = RegionPeer::ID;
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
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 1; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Region object", $e);
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
			$con = Propel::getConnection(RegionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RegionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collcitys = null;
			$this->lastcityCriteria = null;

			$this->collRegionI18ns = null;
			$this->lastRegionI18nCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRegion:delete:pre') as $callable)
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
			$con = Propel::getConnection(RegionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RegionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRegion:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRegion:save:pre') as $callable)
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
			$con = Propel::getConnection(RegionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRegion:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RegionPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = RegionPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RegionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RegionPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collcitys !== null) {
				foreach ($this->collcitys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRegionI18ns !== null) {
				foreach ($this->collRegionI18ns as $referrerFK) {
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


			if (($retval = RegionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collcitys !== null) {
					foreach ($this->collcitys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRegionI18ns !== null) {
					foreach ($this->collRegionI18ns as $referrerFK) {
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
		$pos = RegionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RegionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RegionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RegionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RegionPeer::DATABASE_NAME);

		if ($this->isColumnModified(RegionPeer::ID)) $criteria->add(RegionPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RegionPeer::DATABASE_NAME);

		$criteria->add(RegionPeer::ID, $this->id);

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


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getcitys() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addcity($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRegionI18ns() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRegionI18n($relObj->copy($deepCopy));
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
			self::$peer = new RegionPeer();
		}
		return self::$peer;
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
			$criteria = new Criteria(RegionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collcitys === null) {
			if ($this->isNew()) {
			   $this->collcitys = array();
			} else {

				$criteria->add(cityPeer::REGION_ID, $this->id);

				cityPeer::addSelectColumns($criteria);
				$this->collcitys = cityPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(cityPeer::REGION_ID, $this->id);

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
			$criteria = new Criteria(RegionPeer::DATABASE_NAME);
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

				$criteria->add(cityPeer::REGION_ID, $this->id);

				$count = cityPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(cityPeer::REGION_ID, $this->id);

				if (!isset($this->lastcityCriteria) || !$this->lastcityCriteria->equals($criteria)) {
					$count = cityPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collcitys);
				}
			} else {
				$count = count($this->collcitys);
			}
		}
		return $count;
	}

	
	public function addcity(city $l)
	{
		if ($this->collcitys === null) {
			$this->initcitys();
		}
		if (!in_array($l, $this->collcitys, true)) { 			array_push($this->collcitys, $l);
			$l->setRegion($this);
		}
	}

	
	public function clearRegionI18ns()
	{
		$this->collRegionI18ns = null; 	}

	
	public function initRegionI18ns()
	{
		$this->collRegionI18ns = array();
	}

	
	public function getRegionI18ns($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RegionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRegionI18ns === null) {
			if ($this->isNew()) {
			   $this->collRegionI18ns = array();
			} else {

				$criteria->add(RegionI18nPeer::ID, $this->id);

				RegionI18nPeer::addSelectColumns($criteria);
				$this->collRegionI18ns = RegionI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RegionI18nPeer::ID, $this->id);

				RegionI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastRegionI18nCriteria) || !$this->lastRegionI18nCriteria->equals($criteria)) {
					$this->collRegionI18ns = RegionI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRegionI18nCriteria = $criteria;
		return $this->collRegionI18ns;
	}

	
	public function countRegionI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RegionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRegionI18ns === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RegionI18nPeer::ID, $this->id);

				$count = RegionI18nPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RegionI18nPeer::ID, $this->id);

				if (!isset($this->lastRegionI18nCriteria) || !$this->lastRegionI18nCriteria->equals($criteria)) {
					$count = RegionI18nPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRegionI18ns);
				}
			} else {
				$count = count($this->collRegionI18ns);
			}
		}
		return $count;
	}

	
	public function addRegionI18n(RegionI18n $l)
	{
		if ($this->collRegionI18ns === null) {
			$this->initRegionI18ns();
		}
		if (!in_array($l, $this->collRegionI18ns, true)) { 			array_push($this->collRegionI18ns, $l);
			$l->setRegion($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collcitys) {
				foreach ((array) $this->collcitys as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRegionI18ns) {
				foreach ((array) $this->collRegionI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collcitys = null;
		$this->collRegionI18ns = null;
	}


  
  public function getCulture()
  {
    return $this->culture;
  }

  
  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getName($culture = null)
  {
    return $this->getCurrentRegionI18n($culture)->getName();
  }

  public function setName($value, $culture = null)
  {
    $this->getCurrentRegionI18n($culture)->setName($value);
  }

  protected $current_i18n = array();

  public function getCurrentRegionI18n($culture = null)
  {
    if (is_null($culture))
    {
      $culture = is_null($this->culture) ? sfPropel::getDefaultCulture() : $this->culture;
    }

    if (!isset($this->current_i18n[$culture]))
    {
      $obj = RegionI18nPeer::retrieveByPK($this->getId(), $culture);
      if ($obj)
      {
        $this->setRegionI18nForCulture($obj, $culture);
      }
      else
      {
        $this->setRegionI18nForCulture(new RegionI18n(), $culture);
        $this->current_i18n[$culture]->setCulture($culture);
      }
    }

    return $this->current_i18n[$culture];
  }

  public function setRegionI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addRegionI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRegion:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRegion::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 