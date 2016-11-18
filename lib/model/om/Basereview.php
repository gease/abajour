<?php


abstract class Basereview extends BaseObject  implements Persistent {


  const PEER = 'reviewPeer';

	
	protected static $peer;

	
	protected $user_id;

	
	protected $manuscript_id;

	
	protected $contents;

	
	protected $outcome;

	
	protected $submitted;

	
	protected $decision;

	
	protected $asfGuardUserProfile;

	
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
		$this->outcome = 0;
	}

	
	public function getUserId()
	{
		return $this->user_id;
	}

	
	public function getManuscriptId()
	{
		return $this->manuscript_id;
	}

	
	public function getContents()
	{
		return $this->contents;
	}

	
	public function getOutcome()
	{
		return $this->outcome;
	}

	
	public function getSubmitted($format = 'Y-m-d H:i:s')
	{
		if ($this->submitted === null) {
			return null;
		}


		if ($this->submitted === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->submitted);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->submitted, true), $x);
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

	
	public function getDecision()
	{
		return $this->decision;
	}

	
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = reviewPeer::USER_ID;
		}

		if ($this->asfGuardUserProfile !== null && $this->asfGuardUserProfile->getUserId() !== $v) {
			$this->asfGuardUserProfile = null;
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
			$this->modifiedColumns[] = reviewPeer::MANUSCRIPT_ID;
		}

		if ($this->amanuscript !== null && $this->amanuscript->getId() !== $v) {
			$this->amanuscript = null;
		}

		return $this;
	} 
	
	public function setContents($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->contents !== $v) {
			$this->contents = $v;
			$this->modifiedColumns[] = reviewPeer::CONTENTS;
		}

		return $this;
	} 
	
	public function setOutcome($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->outcome !== $v || $v === 0) {
			$this->outcome = $v;
			$this->modifiedColumns[] = reviewPeer::OUTCOME;
		}

		return $this;
	} 
	
	public function setSubmitted($v)
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

		if ( $this->submitted !== null || $dt !== null ) {
			
			$currNorm = ($this->submitted !== null && $tmpDt = new DateTime($this->submitted)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->submitted = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = reviewPeer::SUBMITTED;
			}
		} 
		return $this;
	} 
	
	public function setDecision($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->decision !== $v) {
			$this->decision = $v;
			$this->modifiedColumns[] = reviewPeer::DECISION;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(reviewPeer::OUTCOME))) {
				return false;
			}

			if ($this->outcome !== 0) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->user_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->manuscript_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->contents = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->outcome = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->submitted = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->decision = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating review object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->asfGuardUserProfile !== null && $this->user_id !== $this->asfGuardUserProfile->getUserId()) {
			$this->asfGuardUserProfile = null;
		}
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
			$con = Propel::getConnection(reviewPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = reviewPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->asfGuardUserProfile = null;
			$this->amanuscript = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('Basereview:delete:pre') as $callable)
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
			$con = Propel::getConnection(reviewPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			reviewPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('Basereview:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('Basereview:save:pre') as $callable)
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
			$con = Propel::getConnection(reviewPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('Basereview:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			reviewPeer::addInstanceToPool($this);
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

												
			if ($this->asfGuardUserProfile !== null) {
				if ($this->asfGuardUserProfile->isModified() || $this->asfGuardUserProfile->isNew()) {
					$affectedRows += $this->asfGuardUserProfile->save($con);
				}
				$this->setsfGuardUserProfile($this->asfGuardUserProfile);
			}

			if ($this->amanuscript !== null) {
				if ($this->amanuscript->isModified() || $this->amanuscript->isNew()) {
					$affectedRows += $this->amanuscript->save($con);
				}
				$this->setmanuscript($this->amanuscript);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = reviewPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += reviewPeer::doUpdate($this, $con);
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


												
			if ($this->asfGuardUserProfile !== null) {
				if (!$this->asfGuardUserProfile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUserProfile->getValidationFailures());
				}
			}

			if ($this->amanuscript !== null) {
				if (!$this->amanuscript->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->amanuscript->getValidationFailures());
				}
			}


			if (($retval = reviewPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = reviewPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUserId();
				break;
			case 1:
				return $this->getManuscriptId();
				break;
			case 2:
				return $this->getContents();
				break;
			case 3:
				return $this->getOutcome();
				break;
			case 4:
				return $this->getSubmitted();
				break;
			case 5:
				return $this->getDecision();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = reviewPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUserId(),
			$keys[1] => $this->getManuscriptId(),
			$keys[2] => $this->getContents(),
			$keys[3] => $this->getOutcome(),
			$keys[4] => $this->getSubmitted(),
			$keys[5] => $this->getDecision(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = reviewPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUserId($value);
				break;
			case 1:
				$this->setManuscriptId($value);
				break;
			case 2:
				$this->setContents($value);
				break;
			case 3:
				$this->setOutcome($value);
				break;
			case 4:
				$this->setSubmitted($value);
				break;
			case 5:
				$this->setDecision($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = reviewPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setManuscriptId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContents($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setOutcome($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSubmitted($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDecision($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(reviewPeer::DATABASE_NAME);

		if ($this->isColumnModified(reviewPeer::USER_ID)) $criteria->add(reviewPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(reviewPeer::MANUSCRIPT_ID)) $criteria->add(reviewPeer::MANUSCRIPT_ID, $this->manuscript_id);
		if ($this->isColumnModified(reviewPeer::CONTENTS)) $criteria->add(reviewPeer::CONTENTS, $this->contents);
		if ($this->isColumnModified(reviewPeer::OUTCOME)) $criteria->add(reviewPeer::OUTCOME, $this->outcome);
		if ($this->isColumnModified(reviewPeer::SUBMITTED)) $criteria->add(reviewPeer::SUBMITTED, $this->submitted);
		if ($this->isColumnModified(reviewPeer::DECISION)) $criteria->add(reviewPeer::DECISION, $this->decision);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(reviewPeer::DATABASE_NAME);

		$criteria->add(reviewPeer::USER_ID, $this->user_id);
		$criteria->add(reviewPeer::MANUSCRIPT_ID, $this->manuscript_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getUserId();

		$pks[1] = $this->getManuscriptId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setUserId($keys[0]);

		$this->setManuscriptId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setManuscriptId($this->manuscript_id);

		$copyObj->setContents($this->contents);

		$copyObj->setOutcome($this->outcome);

		$copyObj->setSubmitted($this->submitted);

		$copyObj->setDecision($this->decision);


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
			self::$peer = new reviewPeer();
		}
		return self::$peer;
	}

	
	public function setsfGuardUserProfile(sfGuardUserProfile $v = null)
	{
		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getUserId());
		}

		$this->asfGuardUserProfile = $v;

						if ($v !== null) {
			$v->addreview($this);
		}

		return $this;
	}


	
	public function getsfGuardUserProfile(PropelPDO $con = null)
	{
		if ($this->asfGuardUserProfile === null && ($this->user_id !== null)) {
			$c = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
			$c->add(sfGuardUserProfilePeer::USER_ID, $this->user_id);
			$this->asfGuardUserProfile = sfGuardUserProfilePeer::doSelectOne($c, $con);
			
		}
		return $this->asfGuardUserProfile;
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
			$v->addreview($this);
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
			$this->asfGuardUserProfile = null;
			$this->amanuscript = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('Basereview:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method Basereview::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 