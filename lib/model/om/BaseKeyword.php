<?php


abstract class BaseKeyword extends BaseObject  implements Persistent {


  const PEER = 'KeywordPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $keyword;

	
	protected $collKeywordManuscriptRefs;

	
	private $lastKeywordManuscriptRefCriteria = null;

	
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

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getKeyword()
	{
		return $this->keyword;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = KeywordPeer::ID;
		}

		return $this;
	} 
	
	public function setKeyword($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->keyword !== $v) {
			$this->keyword = $v;
			$this->modifiedColumns[] = KeywordPeer::KEYWORD;
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
			$this->keyword = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Keyword object", $e);
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
			$con = Propel::getConnection(KeywordPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = KeywordPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collKeywordManuscriptRefs = null;
			$this->lastKeywordManuscriptRefCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseKeyword:delete:pre') as $callable)
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
			$con = Propel::getConnection(KeywordPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			KeywordPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseKeyword:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseKeyword:save:pre') as $callable)
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
			$con = Propel::getConnection(KeywordPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseKeyword:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			KeywordPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = KeywordPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = KeywordPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += KeywordPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collKeywordManuscriptRefs !== null) {
				foreach ($this->collKeywordManuscriptRefs as $referrerFK) {
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


			if (($retval = KeywordPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collKeywordManuscriptRefs !== null) {
					foreach ($this->collKeywordManuscriptRefs as $referrerFK) {
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
		$pos = KeywordPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getKeyword();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = KeywordPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getKeyword(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KeywordPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setKeyword($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = KeywordPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKeyword($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(KeywordPeer::DATABASE_NAME);

		if ($this->isColumnModified(KeywordPeer::ID)) $criteria->add(KeywordPeer::ID, $this->id);
		if ($this->isColumnModified(KeywordPeer::KEYWORD)) $criteria->add(KeywordPeer::KEYWORD, $this->keyword);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(KeywordPeer::DATABASE_NAME);

		$criteria->add(KeywordPeer::ID, $this->id);

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

		$copyObj->setKeyword($this->keyword);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getKeywordManuscriptRefs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addKeywordManuscriptRef($relObj->copy($deepCopy));
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
			self::$peer = new KeywordPeer();
		}
		return self::$peer;
	}

	
	public function clearKeywordManuscriptRefs()
	{
		$this->collKeywordManuscriptRefs = null; 	}

	
	public function initKeywordManuscriptRefs()
	{
		$this->collKeywordManuscriptRefs = array();
	}

	
	public function getKeywordManuscriptRefs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(KeywordPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKeywordManuscriptRefs === null) {
			if ($this->isNew()) {
			   $this->collKeywordManuscriptRefs = array();
			} else {

				$criteria->add(KeywordManuscriptRefPeer::KEYWORD_ID, $this->id);

				KeywordManuscriptRefPeer::addSelectColumns($criteria);
				$this->collKeywordManuscriptRefs = KeywordManuscriptRefPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(KeywordManuscriptRefPeer::KEYWORD_ID, $this->id);

				KeywordManuscriptRefPeer::addSelectColumns($criteria);
				if (!isset($this->lastKeywordManuscriptRefCriteria) || !$this->lastKeywordManuscriptRefCriteria->equals($criteria)) {
					$this->collKeywordManuscriptRefs = KeywordManuscriptRefPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastKeywordManuscriptRefCriteria = $criteria;
		return $this->collKeywordManuscriptRefs;
	}

	
	public function countKeywordManuscriptRefs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(KeywordPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collKeywordManuscriptRefs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(KeywordManuscriptRefPeer::KEYWORD_ID, $this->id);

				$count = KeywordManuscriptRefPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(KeywordManuscriptRefPeer::KEYWORD_ID, $this->id);

				if (!isset($this->lastKeywordManuscriptRefCriteria) || !$this->lastKeywordManuscriptRefCriteria->equals($criteria)) {
					$count = KeywordManuscriptRefPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collKeywordManuscriptRefs);
				}
			} else {
				$count = count($this->collKeywordManuscriptRefs);
			}
		}
		return $count;
	}

	
	public function addKeywordManuscriptRef(KeywordManuscriptRef $l)
	{
		if ($this->collKeywordManuscriptRefs === null) {
			$this->initKeywordManuscriptRefs();
		}
		if (!in_array($l, $this->collKeywordManuscriptRefs, true)) { 			array_push($this->collKeywordManuscriptRefs, $l);
			$l->setKeyword($this);
		}
	}


	
	public function getKeywordManuscriptRefsJoinmanuscript($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(KeywordPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKeywordManuscriptRefs === null) {
			if ($this->isNew()) {
				$this->collKeywordManuscriptRefs = array();
			} else {

				$criteria->add(KeywordManuscriptRefPeer::KEYWORD_ID, $this->id);

				$this->collKeywordManuscriptRefs = KeywordManuscriptRefPeer::doSelectJoinmanuscript($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(KeywordManuscriptRefPeer::KEYWORD_ID, $this->id);

			if (!isset($this->lastKeywordManuscriptRefCriteria) || !$this->lastKeywordManuscriptRefCriteria->equals($criteria)) {
				$this->collKeywordManuscriptRefs = KeywordManuscriptRefPeer::doSelectJoinmanuscript($criteria, $con, $join_behavior);
			}
		}
		$this->lastKeywordManuscriptRefCriteria = $criteria;

		return $this->collKeywordManuscriptRefs;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collKeywordManuscriptRefs) {
				foreach ((array) $this->collKeywordManuscriptRefs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collKeywordManuscriptRefs = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseKeyword:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseKeyword::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 