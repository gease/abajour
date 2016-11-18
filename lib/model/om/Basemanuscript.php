<?php


abstract class Basemanuscript extends BaseObject  implements Persistent {


  const PEER = 'manuscriptPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $title;

	
	protected $status;

	
	protected $pages;

	
	protected $city_id;

	
	protected $comment;

	
	protected $annotation;

	
	protected $letter;

	
	protected $keywords_freetext;

	
	protected $reviewers_request;

	
	protected $acity;

	
	protected $singlePublication;

	
	protected $colluserManuscriptRefs;

	
	private $lastuserManuscriptRefCriteria = null;

	
	protected $collreviews;

	
	private $lastreviewCriteria = null;

	
	protected $collactions;

	
	private $lastactionCriteria = null;

	
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
		$this->status = 0;
	}

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getTitle()
	{
		return $this->title;
	}

	
	public function getStatus()
	{
		return $this->status;
	}

	
	public function getPages()
	{
		return $this->pages;
	}

	
	public function getCityId()
	{
		return $this->city_id;
	}

	
	public function getComment()
	{
		return $this->comment;
	}

	
	public function getAnnotation()
	{
		return $this->annotation;
	}

	
	public function getLetter()
	{
		return $this->letter;
	}

	
	public function getKeywordsFreetext()
	{
		return $this->keywords_freetext;
	}

	
	public function getReviewersRequest()
	{
		return $this->reviewers_request;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = manuscriptPeer::ID;
		}

		return $this;
	} 
	
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = manuscriptPeer::TITLE;
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
			$this->modifiedColumns[] = manuscriptPeer::STATUS;
		}

		return $this;
	} 
	
	public function setPages($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pages !== $v) {
			$this->pages = $v;
			$this->modifiedColumns[] = manuscriptPeer::PAGES;
		}

		return $this;
	} 
	
	public function setCityId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->city_id !== $v) {
			$this->city_id = $v;
			$this->modifiedColumns[] = manuscriptPeer::CITY_ID;
		}

		if ($this->acity !== null && $this->acity->getId() !== $v) {
			$this->acity = null;
		}

		return $this;
	} 
	
	public function setComment($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = manuscriptPeer::COMMENT;
		}

		return $this;
	} 
	
	public function setAnnotation($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->annotation !== $v) {
			$this->annotation = $v;
			$this->modifiedColumns[] = manuscriptPeer::ANNOTATION;
		}

		return $this;
	} 
	
	public function setLetter($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->letter !== $v) {
			$this->letter = $v;
			$this->modifiedColumns[] = manuscriptPeer::LETTER;
		}

		return $this;
	} 
	
	public function setKeywordsFreetext($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->keywords_freetext !== $v) {
			$this->keywords_freetext = $v;
			$this->modifiedColumns[] = manuscriptPeer::KEYWORDS_FREETEXT;
		}

		return $this;
	} 
	
	public function setReviewersRequest($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->reviewers_request !== $v) {
			$this->reviewers_request = $v;
			$this->modifiedColumns[] = manuscriptPeer::REVIEWERS_REQUEST;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(manuscriptPeer::STATUS))) {
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

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->status = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->pages = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->city_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->comment = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->annotation = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->letter = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->keywords_freetext = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->reviewers_request = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating manuscript object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->acity !== null && $this->city_id !== $this->acity->getId()) {
			$this->acity = null;
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
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = manuscriptPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->acity = null;
			$this->singlePublication = null;

			$this->colluserManuscriptRefs = null;
			$this->lastuserManuscriptRefCriteria = null;

			$this->collreviews = null;
			$this->lastreviewCriteria = null;

			$this->collactions = null;
			$this->lastactionCriteria = null;

			$this->collKeywordManuscriptRefs = null;
			$this->lastKeywordManuscriptRefCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('Basemanuscript:delete:pre') as $callable)
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
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			manuscriptPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('Basemanuscript:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('Basemanuscript:save:pre') as $callable)
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
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('Basemanuscript:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			manuscriptPeer::addInstanceToPool($this);
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

												
			if ($this->acity !== null) {
				if ($this->acity->isModified() || $this->acity->isNew()) {
					$affectedRows += $this->acity->save($con);
				}
				$this->setcity($this->acity);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = manuscriptPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = manuscriptPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += manuscriptPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->singlePublication !== null) {
				if (!$this->singlePublication->isDeleted()) {
						$affectedRows += $this->singlePublication->save($con);
				}
			}

			if ($this->colluserManuscriptRefs !== null) {
				foreach ($this->colluserManuscriptRefs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collreviews !== null) {
				foreach ($this->collreviews as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collactions !== null) {
				foreach ($this->collactions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


												
			if ($this->acity !== null) {
				if (!$this->acity->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->acity->getValidationFailures());
				}
			}


			if (($retval = manuscriptPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->singlePublication !== null) {
					if (!$this->singlePublication->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singlePublication->getValidationFailures());
					}
				}

				if ($this->colluserManuscriptRefs !== null) {
					foreach ($this->colluserManuscriptRefs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collreviews !== null) {
					foreach ($this->collreviews as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collactions !== null) {
					foreach ($this->collactions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = manuscriptPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTitle();
				break;
			case 2:
				return $this->getStatus();
				break;
			case 3:
				return $this->getPages();
				break;
			case 4:
				return $this->getCityId();
				break;
			case 5:
				return $this->getComment();
				break;
			case 6:
				return $this->getAnnotation();
				break;
			case 7:
				return $this->getLetter();
				break;
			case 8:
				return $this->getKeywordsFreetext();
				break;
			case 9:
				return $this->getReviewersRequest();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = manuscriptPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getStatus(),
			$keys[3] => $this->getPages(),
			$keys[4] => $this->getCityId(),
			$keys[5] => $this->getComment(),
			$keys[6] => $this->getAnnotation(),
			$keys[7] => $this->getLetter(),
			$keys[8] => $this->getKeywordsFreetext(),
			$keys[9] => $this->getReviewersRequest(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = manuscriptPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setStatus($value);
				break;
			case 3:
				$this->setPages($value);
				break;
			case 4:
				$this->setCityId($value);
				break;
			case 5:
				$this->setComment($value);
				break;
			case 6:
				$this->setAnnotation($value);
				break;
			case 7:
				$this->setLetter($value);
				break;
			case 8:
				$this->setKeywordsFreetext($value);
				break;
			case 9:
				$this->setReviewersRequest($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = manuscriptPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStatus($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPages($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCityId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setComment($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAnnotation($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLetter($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setKeywordsFreetext($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setReviewersRequest($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);

		if ($this->isColumnModified(manuscriptPeer::ID)) $criteria->add(manuscriptPeer::ID, $this->id);
		if ($this->isColumnModified(manuscriptPeer::TITLE)) $criteria->add(manuscriptPeer::TITLE, $this->title);
		if ($this->isColumnModified(manuscriptPeer::STATUS)) $criteria->add(manuscriptPeer::STATUS, $this->status);
		if ($this->isColumnModified(manuscriptPeer::PAGES)) $criteria->add(manuscriptPeer::PAGES, $this->pages);
		if ($this->isColumnModified(manuscriptPeer::CITY_ID)) $criteria->add(manuscriptPeer::CITY_ID, $this->city_id);
		if ($this->isColumnModified(manuscriptPeer::COMMENT)) $criteria->add(manuscriptPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(manuscriptPeer::ANNOTATION)) $criteria->add(manuscriptPeer::ANNOTATION, $this->annotation);
		if ($this->isColumnModified(manuscriptPeer::LETTER)) $criteria->add(manuscriptPeer::LETTER, $this->letter);
		if ($this->isColumnModified(manuscriptPeer::KEYWORDS_FREETEXT)) $criteria->add(manuscriptPeer::KEYWORDS_FREETEXT, $this->keywords_freetext);
		if ($this->isColumnModified(manuscriptPeer::REVIEWERS_REQUEST)) $criteria->add(manuscriptPeer::REVIEWERS_REQUEST, $this->reviewers_request);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);

		$criteria->add(manuscriptPeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setStatus($this->status);

		$copyObj->setPages($this->pages);

		$copyObj->setCityId($this->city_id);

		$copyObj->setComment($this->comment);

		$copyObj->setAnnotation($this->annotation);

		$copyObj->setLetter($this->letter);

		$copyObj->setKeywordsFreetext($this->keywords_freetext);

		$copyObj->setReviewersRequest($this->reviewers_request);


		if ($deepCopy) {
									$copyObj->setNew(false);

			$relObj = $this->getPublication();
			if ($relObj) {
				$copyObj->setPublication($relObj->copy($deepCopy));
			}

			foreach ($this->getuserManuscriptRefs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->adduserManuscriptRef($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getreviews() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addreview($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getactions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addaction($relObj->copy($deepCopy));
				}
			}

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
			self::$peer = new manuscriptPeer();
		}
		return self::$peer;
	}

	
	public function setcity(city $v = null)
	{
		if ($v === null) {
			$this->setCityId(NULL);
		} else {
			$this->setCityId($v->getId());
		}

		$this->acity = $v;

						if ($v !== null) {
			$v->addmanuscript($this);
		}

		return $this;
	}


	
	public function getcity(PropelPDO $con = null)
	{
		if ($this->acity === null && ($this->city_id !== null)) {
			$c = new Criteria(cityPeer::DATABASE_NAME);
			$c->add(cityPeer::ID, $this->city_id);
			$this->acity = cityPeer::doSelectOne($c, $con);
			
		}
		return $this->acity;
	}

	
	public function getPublication(PropelPDO $con = null)
	{

		if ($this->singlePublication === null && !$this->isNew()) {
			$this->singlePublication = PublicationPeer::retrieveByPK($this->id, $con);
		}

		return $this->singlePublication;
	}

	
	public function setPublication(Publication $v)
	{
		$this->singlePublication = $v;

				if ($v->getmanuscript() === null) {
			$v->setmanuscript($this);
		}

		return $this;
	}

	
	public function clearuserManuscriptRefs()
	{
		$this->colluserManuscriptRefs = null; 	}

	
	public function inituserManuscriptRefs()
	{
		$this->colluserManuscriptRefs = array();
	}

	
	public function getuserManuscriptRefs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserManuscriptRefs === null) {
			if ($this->isNew()) {
			   $this->colluserManuscriptRefs = array();
			} else {

				$criteria->add(userManuscriptRefPeer::MANUSCRIPT_ID, $this->id);

				userManuscriptRefPeer::addSelectColumns($criteria);
				$this->colluserManuscriptRefs = userManuscriptRefPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(userManuscriptRefPeer::MANUSCRIPT_ID, $this->id);

				userManuscriptRefPeer::addSelectColumns($criteria);
				if (!isset($this->lastuserManuscriptRefCriteria) || !$this->lastuserManuscriptRefCriteria->equals($criteria)) {
					$this->colluserManuscriptRefs = userManuscriptRefPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastuserManuscriptRefCriteria = $criteria;
		return $this->colluserManuscriptRefs;
	}

	
	public function countuserManuscriptRefs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->colluserManuscriptRefs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(userManuscriptRefPeer::MANUSCRIPT_ID, $this->id);

				$count = userManuscriptRefPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(userManuscriptRefPeer::MANUSCRIPT_ID, $this->id);

				if (!isset($this->lastuserManuscriptRefCriteria) || !$this->lastuserManuscriptRefCriteria->equals($criteria)) {
					$count = userManuscriptRefPeer::doCount($criteria, $con);
				} else {
					$count = count($this->colluserManuscriptRefs);
				}
			} else {
				$count = count($this->colluserManuscriptRefs);
			}
		}
		return $count;
	}

	
	public function adduserManuscriptRef(userManuscriptRef $l)
	{
		if ($this->colluserManuscriptRefs === null) {
			$this->inituserManuscriptRefs();
		}
		if (!in_array($l, $this->colluserManuscriptRefs, true)) { 			array_push($this->colluserManuscriptRefs, $l);
			$l->setmanuscript($this);
		}
	}


	
	public function getuserManuscriptRefsJoinsfGuardUserProfile($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserManuscriptRefs === null) {
			if ($this->isNew()) {
				$this->colluserManuscriptRefs = array();
			} else {

				$criteria->add(userManuscriptRefPeer::MANUSCRIPT_ID, $this->id);

				$this->colluserManuscriptRefs = userManuscriptRefPeer::doSelectJoinsfGuardUserProfile($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(userManuscriptRefPeer::MANUSCRIPT_ID, $this->id);

			if (!isset($this->lastuserManuscriptRefCriteria) || !$this->lastuserManuscriptRefCriteria->equals($criteria)) {
				$this->colluserManuscriptRefs = userManuscriptRefPeer::doSelectJoinsfGuardUserProfile($criteria, $con, $join_behavior);
			}
		}
		$this->lastuserManuscriptRefCriteria = $criteria;

		return $this->colluserManuscriptRefs;
	}

	
	public function clearreviews()
	{
		$this->collreviews = null; 	}

	
	public function initreviews()
	{
		$this->collreviews = array();
	}

	
	public function getreviews($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collreviews === null) {
			if ($this->isNew()) {
			   $this->collreviews = array();
			} else {

				$criteria->add(reviewPeer::MANUSCRIPT_ID, $this->id);

				reviewPeer::addSelectColumns($criteria);
				$this->collreviews = reviewPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(reviewPeer::MANUSCRIPT_ID, $this->id);

				reviewPeer::addSelectColumns($criteria);
				if (!isset($this->lastreviewCriteria) || !$this->lastreviewCriteria->equals($criteria)) {
					$this->collreviews = reviewPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastreviewCriteria = $criteria;
		return $this->collreviews;
	}

	
	public function countreviews(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collreviews === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(reviewPeer::MANUSCRIPT_ID, $this->id);

				$count = reviewPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(reviewPeer::MANUSCRIPT_ID, $this->id);

				if (!isset($this->lastreviewCriteria) || !$this->lastreviewCriteria->equals($criteria)) {
					$count = reviewPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collreviews);
				}
			} else {
				$count = count($this->collreviews);
			}
		}
		return $count;
	}

	
	public function addreview(review $l)
	{
		if ($this->collreviews === null) {
			$this->initreviews();
		}
		if (!in_array($l, $this->collreviews, true)) { 			array_push($this->collreviews, $l);
			$l->setmanuscript($this);
		}
	}


	
	public function getreviewsJoinsfGuardUserProfile($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collreviews === null) {
			if ($this->isNew()) {
				$this->collreviews = array();
			} else {

				$criteria->add(reviewPeer::MANUSCRIPT_ID, $this->id);

				$this->collreviews = reviewPeer::doSelectJoinsfGuardUserProfile($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(reviewPeer::MANUSCRIPT_ID, $this->id);

			if (!isset($this->lastreviewCriteria) || !$this->lastreviewCriteria->equals($criteria)) {
				$this->collreviews = reviewPeer::doSelectJoinsfGuardUserProfile($criteria, $con, $join_behavior);
			}
		}
		$this->lastreviewCriteria = $criteria;

		return $this->collreviews;
	}

	
	public function clearactions()
	{
		$this->collactions = null; 	}

	
	public function initactions()
	{
		$this->collactions = array();
	}

	
	public function getactions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collactions === null) {
			if ($this->isNew()) {
			   $this->collactions = array();
			} else {

				$criteria->add(actionPeer::MANUSCRIPT_ID, $this->id);

				actionPeer::addSelectColumns($criteria);
				$this->collactions = actionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(actionPeer::MANUSCRIPT_ID, $this->id);

				actionPeer::addSelectColumns($criteria);
				if (!isset($this->lastactionCriteria) || !$this->lastactionCriteria->equals($criteria)) {
					$this->collactions = actionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastactionCriteria = $criteria;
		return $this->collactions;
	}

	
	public function countactions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collactions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(actionPeer::MANUSCRIPT_ID, $this->id);

				$count = actionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(actionPeer::MANUSCRIPT_ID, $this->id);

				if (!isset($this->lastactionCriteria) || !$this->lastactionCriteria->equals($criteria)) {
					$count = actionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collactions);
				}
			} else {
				$count = count($this->collactions);
			}
		}
		return $count;
	}

	
	public function addaction(action $l)
	{
		if ($this->collactions === null) {
			$this->initactions();
		}
		if (!in_array($l, $this->collactions, true)) { 			array_push($this->collactions, $l);
			$l->setmanuscript($this);
		}
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
			$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKeywordManuscriptRefs === null) {
			if ($this->isNew()) {
			   $this->collKeywordManuscriptRefs = array();
			} else {

				$criteria->add(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $this->id);

				KeywordManuscriptRefPeer::addSelectColumns($criteria);
				$this->collKeywordManuscriptRefs = KeywordManuscriptRefPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $this->id);

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
			$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
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

				$criteria->add(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $this->id);

				$count = KeywordManuscriptRefPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $this->id);

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
			$l->setmanuscript($this);
		}
	}


	
	public function getKeywordManuscriptRefsJoinKeyword($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collKeywordManuscriptRefs === null) {
			if ($this->isNew()) {
				$this->collKeywordManuscriptRefs = array();
			} else {

				$criteria->add(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $this->id);

				$this->collKeywordManuscriptRefs = KeywordManuscriptRefPeer::doSelectJoinKeyword($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $this->id);

			if (!isset($this->lastKeywordManuscriptRefCriteria) || !$this->lastKeywordManuscriptRefCriteria->equals($criteria)) {
				$this->collKeywordManuscriptRefs = KeywordManuscriptRefPeer::doSelectJoinKeyword($criteria, $con, $join_behavior);
			}
		}
		$this->lastKeywordManuscriptRefCriteria = $criteria;

		return $this->collKeywordManuscriptRefs;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->singlePublication) {
				$this->singlePublication->clearAllReferences($deep);
			}
			if ($this->colluserManuscriptRefs) {
				foreach ((array) $this->colluserManuscriptRefs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collreviews) {
				foreach ((array) $this->collreviews as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collactions) {
				foreach ((array) $this->collactions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collKeywordManuscriptRefs) {
				foreach ((array) $this->collKeywordManuscriptRefs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->singlePublication = null;
		$this->colluserManuscriptRefs = null;
		$this->collreviews = null;
		$this->collactions = null;
		$this->collKeywordManuscriptRefs = null;
			$this->acity = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('Basemanuscript:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method Basemanuscript::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 