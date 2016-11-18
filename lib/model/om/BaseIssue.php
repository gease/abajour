<?php


abstract class BaseIssue extends BaseObject  implements Persistent {


  const PEER = 'IssuePeer';

	
	protected static $peer;

	
	protected $volume;

	
	protected $num;

	
	protected $status;

	
	protected $published_date;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
		$this->status = 0;
	}

	
	public function getVolume()
	{
		return $this->volume;
	}

	
	public function getNum()
	{
		return $this->num;
	}

	
	public function getStatus()
	{
		return $this->status;
	}

	
	public function getPublishedDate($format = '%x')
	{
		if ($this->published_date === null) {
			return null;
		}


		if ($this->published_date === '0000-00-00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->published_date);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->published_date, true), $x);
			}
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function setVolume($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->volume !== $v) {
			$this->volume = $v;
			$this->modifiedColumns[] = IssuePeer::VOLUME;
		}

		return $this;
	} 
	
	public function setNum($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->num !== $v) {
			$this->num = $v;
			$this->modifiedColumns[] = IssuePeer::NUM;
		}

		return $this;
	} 
	
	public function setStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status !== $v || $v === 0) {
			$this->status = $v;
			$this->modifiedColumns[] = IssuePeer::STATUS;
		}

		return $this;
	} 
	
	public function setPublishedDate($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->published_date !== null || $dt !== null ) {
			
			$currNorm = ($this->published_date !== null && $tmpDt = new DateTime($this->published_date)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->published_date = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = IssuePeer::PUBLISHED_DATE;
			}
		} 
		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(IssuePeer::STATUS))) {
				return false;
			}

			if ($this->status !== 0) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->volume = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->num = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->status = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->published_date = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Issue object", $e);
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
			$con = Propel::getConnection(IssuePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IssuePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIssue:delete:pre') as $callable)
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
			$con = Propel::getConnection(IssuePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IssuePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIssue:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIssue:save:pre') as $callable)
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
			$con = Propel::getConnection(IssuePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIssue:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IssuePeer::addInstanceToPool($this);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IssuePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += IssuePeer::doUpdate($this, $con);
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


			if (($retval = IssuePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IssuePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getVolume();
				break;
			case 1:
				return $this->getNum();
				break;
			case 2:
				return $this->getStatus();
				break;
			case 3:
				return $this->getPublishedDate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IssuePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getVolume(),
			$keys[1] => $this->getNum(),
			$keys[2] => $this->getStatus(),
			$keys[3] => $this->getPublishedDate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IssuePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setVolume($value);
				break;
			case 1:
				$this->setNum($value);
				break;
			case 2:
				$this->setStatus($value);
				break;
			case 3:
				$this->setPublishedDate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IssuePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setVolume($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNum($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStatus($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPublishedDate($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IssuePeer::DATABASE_NAME);

		if ($this->isColumnModified(IssuePeer::VOLUME)) $criteria->add(IssuePeer::VOLUME, $this->volume);
		if ($this->isColumnModified(IssuePeer::NUM)) $criteria->add(IssuePeer::NUM, $this->num);
		if ($this->isColumnModified(IssuePeer::STATUS)) $criteria->add(IssuePeer::STATUS, $this->status);
		if ($this->isColumnModified(IssuePeer::PUBLISHED_DATE)) $criteria->add(IssuePeer::PUBLISHED_DATE, $this->published_date);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IssuePeer::DATABASE_NAME);

		$criteria->add(IssuePeer::VOLUME, $this->volume);
		$criteria->add(IssuePeer::NUM, $this->num);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getVolume();

		$pks[1] = $this->getNum();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setVolume($keys[0]);

		$this->setNum($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setVolume($this->volume);

		$copyObj->setNum($this->num);

		$copyObj->setStatus($this->status);

		$copyObj->setPublishedDate($this->published_date);


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
			self::$peer = new IssuePeer();
		}
		return self::$peer;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseIssue:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIssue::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 