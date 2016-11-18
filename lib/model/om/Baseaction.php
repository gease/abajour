<?php


abstract class Baseaction extends BaseObject  implements Persistent {


  const PEER = 'actionPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $manuscript_id;

	
	protected $status_before;

	
	protected $status_after;

	
	protected $datetime;

	
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
		$this->status_before = 0;
		$this->status_after = 0;
	}

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getManuscriptId()
	{
		return $this->manuscript_id;
	}

	
	public function getStatusBefore()
	{
		return $this->status_before;
	}

	
	public function getStatusAfter()
	{
		return $this->status_after;
	}

	
	public function getDatetime($format = 'Y-m-d H:i:s')
	{
		if ($this->datetime === null) {
			return null;
		}


		if ($this->datetime === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->datetime);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->datetime, true), $x);
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

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = actionPeer::ID;
		}

		return $this;
	} 
	
	public function setManuscriptId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->manuscript_id !== $v) {
			$this->manuscript_id = $v;
			$this->modifiedColumns[] = actionPeer::MANUSCRIPT_ID;
		}

		if ($this->amanuscript !== null && $this->amanuscript->getId() !== $v) {
			$this->amanuscript = null;
		}

		return $this;
	} 
	
	public function setStatusBefore($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status_before !== $v || $v === 0) {
			$this->status_before = $v;
			$this->modifiedColumns[] = actionPeer::STATUS_BEFORE;
		}

		return $this;
	} 
	
	public function setStatusAfter($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status_after !== $v || $v === 0) {
			$this->status_after = $v;
			$this->modifiedColumns[] = actionPeer::STATUS_AFTER;
		}

		return $this;
	} 
	
	public function setDatetime($v)
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

		if ( $this->datetime !== null || $dt !== null ) {
			
			$currNorm = ($this->datetime !== null && $tmpDt = new DateTime($this->datetime)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->datetime = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = actionPeer::DATETIME;
			}
		} 
		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(actionPeer::STATUS_BEFORE,actionPeer::STATUS_AFTER))) {
				return false;
			}

			if ($this->status_before !== 0) {
				return false;
			}

			if ($this->status_after !== 0) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->manuscript_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->status_before = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->status_after = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->datetime = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating action object", $e);
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
			$con = Propel::getConnection(actionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = actionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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

    foreach (sfMixer::getCallables('Baseaction:delete:pre') as $callable)
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
			$con = Propel::getConnection(actionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			actionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('Baseaction:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('Baseaction:save:pre') as $callable)
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
			$con = Propel::getConnection(actionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('Baseaction:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			actionPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = actionPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = actionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += actionPeer::doUpdate($this, $con);
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


			if (($retval = actionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = actionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getManuscriptId();
				break;
			case 2:
				return $this->getStatusBefore();
				break;
			case 3:
				return $this->getStatusAfter();
				break;
			case 4:
				return $this->getDatetime();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = actionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getManuscriptId(),
			$keys[2] => $this->getStatusBefore(),
			$keys[3] => $this->getStatusAfter(),
			$keys[4] => $this->getDatetime(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = actionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setManuscriptId($value);
				break;
			case 2:
				$this->setStatusBefore($value);
				break;
			case 3:
				$this->setStatusAfter($value);
				break;
			case 4:
				$this->setDatetime($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = actionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setManuscriptId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStatusBefore($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setStatusAfter($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDatetime($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(actionPeer::DATABASE_NAME);

		if ($this->isColumnModified(actionPeer::ID)) $criteria->add(actionPeer::ID, $this->id);
		if ($this->isColumnModified(actionPeer::MANUSCRIPT_ID)) $criteria->add(actionPeer::MANUSCRIPT_ID, $this->manuscript_id);
		if ($this->isColumnModified(actionPeer::STATUS_BEFORE)) $criteria->add(actionPeer::STATUS_BEFORE, $this->status_before);
		if ($this->isColumnModified(actionPeer::STATUS_AFTER)) $criteria->add(actionPeer::STATUS_AFTER, $this->status_after);
		if ($this->isColumnModified(actionPeer::DATETIME)) $criteria->add(actionPeer::DATETIME, $this->datetime);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(actionPeer::DATABASE_NAME);

		$criteria->add(actionPeer::ID, $this->id);

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

		$copyObj->setManuscriptId($this->manuscript_id);

		$copyObj->setStatusBefore($this->status_before);

		$copyObj->setStatusAfter($this->status_after);

		$copyObj->setDatetime($this->datetime);


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
			self::$peer = new actionPeer();
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
			$v->addaction($this);
		}

		return $this;
	}


	
	public function getmanuscript(PropelPDO $con = null)
	{
		if ($this->amanuscript === null && ($this->manuscript_id !== null)) {
			$c = new Criteria(manuscriptPeer::DATABASE_NAME);
			$c->add(manuscriptPeer::ID, $this->manuscript_id);
			$this->amanuscript = manuscriptPeer::doSelectOne($c, $con);
			
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
    if (!$callable = sfMixer::getCallable('Baseaction:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method Baseaction::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 