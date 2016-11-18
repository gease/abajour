<?php


abstract class BaseKeywordManuscriptRef extends BaseObject  implements Persistent {


  const PEER = 'KeywordManuscriptRefPeer';

	
	protected static $peer;

	
	protected $keyword_id;

	
	protected $manuscript_id;

	
	protected $aKeyword;

	
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

	
	public function getKeywordId()
	{
		return $this->keyword_id;
	}

	
	public function getManuscriptId()
	{
		return $this->manuscript_id;
	}

	
	public function setKeywordId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->keyword_id !== $v) {
			$this->keyword_id = $v;
			$this->modifiedColumns[] = KeywordManuscriptRefPeer::KEYWORD_ID;
		}

		if ($this->aKeyword !== null && $this->aKeyword->getId() !== $v) {
			$this->aKeyword = null;
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
			$this->modifiedColumns[] = KeywordManuscriptRefPeer::MANUSCRIPT_ID;
		}

		if ($this->amanuscript !== null && $this->amanuscript->getId() !== $v) {
			$this->amanuscript = null;
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

			$this->keyword_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->manuscript_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating KeywordManuscriptRef object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aKeyword !== null && $this->keyword_id !== $this->aKeyword->getId()) {
			$this->aKeyword = null;
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
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = KeywordManuscriptRefPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aKeyword = null;
			$this->amanuscript = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRef:delete:pre') as $callable)
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
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			KeywordManuscriptRefPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRef:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRef:save:pre') as $callable)
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
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseKeywordManuscriptRef:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			KeywordManuscriptRefPeer::addInstanceToPool($this);
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

												
			if ($this->aKeyword !== null) {
				if ($this->aKeyword->isModified() || $this->aKeyword->isNew()) {
					$affectedRows += $this->aKeyword->save($con);
				}
				$this->setKeyword($this->aKeyword);
			}

			if ($this->amanuscript !== null) {
				if ($this->amanuscript->isModified() || $this->amanuscript->isNew()) {
					$affectedRows += $this->amanuscript->save($con);
				}
				$this->setmanuscript($this->amanuscript);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = KeywordManuscriptRefPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += KeywordManuscriptRefPeer::doUpdate($this, $con);
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


												
			if ($this->aKeyword !== null) {
				if (!$this->aKeyword->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aKeyword->getValidationFailures());
				}
			}

			if ($this->amanuscript !== null) {
				if (!$this->amanuscript->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->amanuscript->getValidationFailures());
				}
			}


			if (($retval = KeywordManuscriptRefPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KeywordManuscriptRefPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getKeywordId();
				break;
			case 1:
				return $this->getManuscriptId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = KeywordManuscriptRefPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getKeywordId(),
			$keys[1] => $this->getManuscriptId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KeywordManuscriptRefPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setKeywordId($value);
				break;
			case 1:
				$this->setManuscriptId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = KeywordManuscriptRefPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setKeywordId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setManuscriptId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(KeywordManuscriptRefPeer::DATABASE_NAME);

		if ($this->isColumnModified(KeywordManuscriptRefPeer::KEYWORD_ID)) $criteria->add(KeywordManuscriptRefPeer::KEYWORD_ID, $this->keyword_id);
		if ($this->isColumnModified(KeywordManuscriptRefPeer::MANUSCRIPT_ID)) $criteria->add(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $this->manuscript_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(KeywordManuscriptRefPeer::DATABASE_NAME);

		$criteria->add(KeywordManuscriptRefPeer::KEYWORD_ID, $this->keyword_id);
		$criteria->add(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $this->manuscript_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getKeywordId();

		$pks[1] = $this->getManuscriptId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setKeywordId($keys[0]);

		$this->setManuscriptId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setKeywordId($this->keyword_id);

		$copyObj->setManuscriptId($this->manuscript_id);


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
			self::$peer = new KeywordManuscriptRefPeer();
		}
		return self::$peer;
	}

	
	public function setKeyword(Keyword $v = null)
	{
		if ($v === null) {
			$this->setKeywordId(NULL);
		} else {
			$this->setKeywordId($v->getId());
		}

		$this->aKeyword = $v;

						if ($v !== null) {
			$v->addKeywordManuscriptRef($this);
		}

		return $this;
	}


	
	public function getKeyword(PropelPDO $con = null)
	{
		if ($this->aKeyword === null && ($this->keyword_id !== null)) {
			$c = new Criteria(KeywordPeer::DATABASE_NAME);
			$c->add(KeywordPeer::ID, $this->keyword_id);
			$this->aKeyword = KeywordPeer::doSelectOne($c, $con);
			
		}
		return $this->aKeyword;
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
			$v->addKeywordManuscriptRef($this);
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
			$this->aKeyword = null;
			$this->amanuscript = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseKeywordManuscriptRef:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseKeywordManuscriptRef::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 