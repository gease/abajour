<?php


abstract class BaseuserManuscriptRef extends BaseObject  implements Persistent {


  const PEER = 'userManuscriptRefPeer';

	
	protected static $peer;

	
	protected $user_id;

	
	protected $manuscript_id;

	
	protected $is_corresponding_author;

	
	protected $author_order;

	
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
		$this->is_corresponding_author = false;
		$this->author_order = 0;
	}

	
	public function getUserId()
	{
		return $this->user_id;
	}

	
	public function getManuscriptId()
	{
		return $this->manuscript_id;
	}

	
	public function getIsCorrespondingAuthor()
	{
		return $this->is_corresponding_author;
	}

	
	public function getAuthorOrder()
	{
		return $this->author_order;
	}

	
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = userManuscriptRefPeer::USER_ID;
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
			$this->modifiedColumns[] = userManuscriptRefPeer::MANUSCRIPT_ID;
		}

		if ($this->amanuscript !== null && $this->amanuscript->getId() !== $v) {
			$this->amanuscript = null;
		}

		return $this;
	} 
	
	public function setIsCorrespondingAuthor($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_corresponding_author !== $v || $v === false) {
			$this->is_corresponding_author = $v;
			$this->modifiedColumns[] = userManuscriptRefPeer::IS_CORRESPONDING_AUTHOR;
		}

		return $this;
	} 
	
	public function setAuthorOrder($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->author_order !== $v || $v === 0) {
			$this->author_order = $v;
			$this->modifiedColumns[] = userManuscriptRefPeer::AUTHOR_ORDER;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(userManuscriptRefPeer::IS_CORRESPONDING_AUTHOR,userManuscriptRefPeer::AUTHOR_ORDER))) {
				return false;
			}

			if ($this->is_corresponding_author !== false) {
				return false;
			}

			if ($this->author_order !== 0) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->user_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->manuscript_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->is_corresponding_author = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->author_order = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating userManuscriptRef object", $e);
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
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = userManuscriptRefPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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

    foreach (sfMixer::getCallables('BaseuserManuscriptRef:delete:pre') as $callable)
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
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			userManuscriptRefPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseuserManuscriptRef:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseuserManuscriptRef:save:pre') as $callable)
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
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseuserManuscriptRef:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			userManuscriptRefPeer::addInstanceToPool($this);
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
					$pk = userManuscriptRefPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += userManuscriptRefPeer::doUpdate($this, $con);
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


			if (($retval = userManuscriptRefPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = userManuscriptRefPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIsCorrespondingAuthor();
				break;
			case 3:
				return $this->getAuthorOrder();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = userManuscriptRefPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUserId(),
			$keys[1] => $this->getManuscriptId(),
			$keys[2] => $this->getIsCorrespondingAuthor(),
			$keys[3] => $this->getAuthorOrder(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = userManuscriptRefPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setIsCorrespondingAuthor($value);
				break;
			case 3:
				$this->setAuthorOrder($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = userManuscriptRefPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setManuscriptId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsCorrespondingAuthor($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAuthorOrder($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(userManuscriptRefPeer::DATABASE_NAME);

		if ($this->isColumnModified(userManuscriptRefPeer::USER_ID)) $criteria->add(userManuscriptRefPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(userManuscriptRefPeer::MANUSCRIPT_ID)) $criteria->add(userManuscriptRefPeer::MANUSCRIPT_ID, $this->manuscript_id);
		if ($this->isColumnModified(userManuscriptRefPeer::IS_CORRESPONDING_AUTHOR)) $criteria->add(userManuscriptRefPeer::IS_CORRESPONDING_AUTHOR, $this->is_corresponding_author);
		if ($this->isColumnModified(userManuscriptRefPeer::AUTHOR_ORDER)) $criteria->add(userManuscriptRefPeer::AUTHOR_ORDER, $this->author_order);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(userManuscriptRefPeer::DATABASE_NAME);

		$criteria->add(userManuscriptRefPeer::USER_ID, $this->user_id);
		$criteria->add(userManuscriptRefPeer::MANUSCRIPT_ID, $this->manuscript_id);

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

		$copyObj->setIsCorrespondingAuthor($this->is_corresponding_author);

		$copyObj->setAuthorOrder($this->author_order);


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
			self::$peer = new userManuscriptRefPeer();
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
			$v->adduserManuscriptRef($this);
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
			$v->adduserManuscriptRef($this);
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
    if (!$callable = sfMixer::getCallable('BaseuserManuscriptRef:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseuserManuscriptRef::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 