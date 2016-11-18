<?php


abstract class BasePublication extends BaseObject  implements Persistent {


  const PEER = 'PublicationPeer';

	
	protected static $peer;

	
	protected $manuscript_id;

	
	protected $volume;

	
	protected $number;

	
	protected $first_page;

	
	protected $last_page;

	
	protected $year;

	
	protected $amanuscript;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
	}

	
	public function getManuscriptId()
	{
		return $this->manuscript_id;
	}

	
	public function getVolume()
	{
		return $this->volume;
	}

	
	public function getNumber()
	{
		return $this->number;
	}

	
	public function getFirstPage()
	{
		return $this->first_page;
	}

	
	public function getLastPage()
	{
		return $this->last_page;
	}

	
	public function getYear()
	{
		return $this->year;
	}

	
	public function setManuscriptId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->manuscript_id !== $v) {
			$this->manuscript_id = $v;
			$this->modifiedColumns[] = PublicationPeer::MANUSCRIPT_ID;
		}

		if ($this->amanuscript !== null && $this->amanuscript->getId() !== $v) {
			$this->amanuscript = null;
		}

		return $this;
	} 
	
	public function setVolume($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->volume !== $v) {
			$this->volume = $v;
			$this->modifiedColumns[] = PublicationPeer::VOLUME;
		}

		return $this;
	} 
	
	public function setNumber($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->number !== $v) {
			$this->number = $v;
			$this->modifiedColumns[] = PublicationPeer::NUMBER;
		}

		return $this;
	} 
	
	public function setFirstPage($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->first_page !== $v) {
			$this->first_page = $v;
			$this->modifiedColumns[] = PublicationPeer::FIRST_PAGE;
		}

		return $this;
	} 
	
	public function setLastPage($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->last_page !== $v) {
			$this->last_page = $v;
			$this->modifiedColumns[] = PublicationPeer::LAST_PAGE;
		}

		return $this;
	} 
	
	public function setYear($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->year !== $v) {
			$this->year = $v;
			$this->modifiedColumns[] = PublicationPeer::YEAR;
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

			$this->manuscript_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->volume = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->number = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->first_page = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->last_page = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->year = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Publication object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->amanuscript !== null && $this->manuscript_id !== $this->amanuscript->getId()) {
			$this->amanuscript = null;
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
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = PublicationPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->amanuscript = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePublication:delete:pre') as $callable)
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
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PublicationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePublication:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePublication:save:pre') as $callable)
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
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePublication:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PublicationPeer::addInstanceToPool($this);
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

												
			if ($this->amanuscript !== null) {
				if ($this->amanuscript->isModified() || $this->amanuscript->isNew()) {
					$affectedRows += $this->amanuscript->save($con);
				}
				$this->setmanuscript($this->amanuscript);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PublicationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PublicationPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

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


												
			if ($this->amanuscript !== null) {
				if (!$this->amanuscript->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->amanuscript->getValidationFailures());
				}
			}


			if (($retval = PublicationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PublicationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getManuscriptId();
				break;
			case 1:
				return $this->getVolume();
				break;
			case 2:
				return $this->getNumber();
				break;
			case 3:
				return $this->getFirstPage();
				break;
			case 4:
				return $this->getLastPage();
				break;
			case 5:
				return $this->getYear();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PublicationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getManuscriptId(),
			$keys[1] => $this->getVolume(),
			$keys[2] => $this->getNumber(),
			$keys[3] => $this->getFirstPage(),
			$keys[4] => $this->getLastPage(),
			$keys[5] => $this->getYear(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PublicationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setManuscriptId($value);
				break;
			case 1:
				$this->setVolume($value);
				break;
			case 2:
				$this->setNumber($value);
				break;
			case 3:
				$this->setFirstPage($value);
				break;
			case 4:
				$this->setLastPage($value);
				break;
			case 5:
				$this->setYear($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PublicationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setManuscriptId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setVolume($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNumber($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFirstPage($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLastPage($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setYear($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PublicationPeer::DATABASE_NAME);

		if ($this->isColumnModified(PublicationPeer::MANUSCRIPT_ID)) $criteria->add(PublicationPeer::MANUSCRIPT_ID, $this->manuscript_id);
		if ($this->isColumnModified(PublicationPeer::VOLUME)) $criteria->add(PublicationPeer::VOLUME, $this->volume);
		if ($this->isColumnModified(PublicationPeer::NUMBER)) $criteria->add(PublicationPeer::NUMBER, $this->number);
		if ($this->isColumnModified(PublicationPeer::FIRST_PAGE)) $criteria->add(PublicationPeer::FIRST_PAGE, $this->first_page);
		if ($this->isColumnModified(PublicationPeer::LAST_PAGE)) $criteria->add(PublicationPeer::LAST_PAGE, $this->last_page);
		if ($this->isColumnModified(PublicationPeer::YEAR)) $criteria->add(PublicationPeer::YEAR, $this->year);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PublicationPeer::DATABASE_NAME);

		$criteria->add(PublicationPeer::MANUSCRIPT_ID, $this->manuscript_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getManuscriptId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setManuscriptId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setManuscriptId($this->manuscript_id);

		$copyObj->setVolume($this->volume);

		$copyObj->setNumber($this->number);

		$copyObj->setFirstPage($this->first_page);

		$copyObj->setLastPage($this->last_page);

		$copyObj->setYear($this->year);


		$copyObj->setNew(true);

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
			self::$peer = new PublicationPeer();
		}
		return self::$peer;
	}

	
	public function setmanuscript(manuscript $v = null)
	{
		if ($v === null) {
			$this->setManuscriptId(NULL);
		} else {
			$this->setManuscriptId($v->getId());
		}

		$this->amanuscript = $v;

				if ($v !== null) {
			$v->setPublication($this);
		}

		return $this;
	}


	
	public function getmanuscript(PropelPDO $con = null)
	{
		if ($this->amanuscript === null && ($this->manuscript_id !== null)) {
			$c = new Criteria(manuscriptPeer::DATABASE_NAME);
			$c->add(manuscriptPeer::ID, $this->manuscript_id);
			$this->amanuscript = manuscriptPeer::doSelectOne($c, $con);
						$this->amanuscript->setPublication($this);
		}
		return $this->amanuscript;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->amanuscript = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePublication:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePublication::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 