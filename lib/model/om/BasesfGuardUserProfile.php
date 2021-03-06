<?php


abstract class BasesfGuardUserProfile extends BaseObject  implements Persistent {


  const PEER = 'sfGuardUserProfilePeer';

	
	protected static $peer;

	
	protected $user_id;

	
	protected $last_name;

	
	protected $first_name;

	
	protected $middle_name;

	
	protected $birthday;

	
	protected $gender;

	
	protected $country;

	
	protected $city_id;

	
	protected $institution;

	
	protected $address;

	
	protected $is_address_private;

	
	protected $email;

	
	protected $phone_home;

	
	protected $phone_work;

	
	protected $qualification;

	
	protected $is_reviewer;

	
	protected $asfGuardUser;

	
	protected $acity;

	
	protected $singleGuardUser;

	
	protected $colluserManuscriptRefs;

	
	private $lastuserManuscriptRefCriteria = null;

	
	protected $collreviews;

	
	private $lastreviewCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
		$this->gender = 'M';
		$this->country = 'RU';
		$this->address = '';
		$this->is_address_private = false;
		$this->email = '';
		$this->is_reviewer = false;
	}

	
	public function getUserId()
	{
		return $this->user_id;
	}

	
	public function getLastName()
	{
		return $this->last_name;
	}

	
	public function getFirstName()
	{
		return $this->first_name;
	}

	
	public function getMiddleName()
	{
		return $this->middle_name;
	}

	
	public function getBirthday($format = '%x')
	{
		if ($this->birthday === null) {
			return null;
		}


		if ($this->birthday === '0000-00-00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->birthday);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->birthday, true), $x);
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

	
	public function getGender()
	{
		return $this->gender;
	}

	
	public function getCountry()
	{
		return $this->country;
	}

	
	public function getCityId()
	{
		return $this->city_id;
	}

	
	public function getInstitution()
	{
		return $this->institution;
	}

	
	public function getAddress()
	{
		return $this->address;
	}

	
	public function getIsAddressPrivate()
	{
		return $this->is_address_private;
	}

	
	public function getEmail()
	{
		return $this->email;
	}

	
	public function getPhoneHome()
	{
		return $this->phone_home;
	}

	
	public function getPhoneWork()
	{
		return $this->phone_work;
	}

	
	public function getQualification()
	{
		return $this->qualification;
	}

	
	public function getIsReviewer()
	{
		return $this->is_reviewer;
	}

	
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} 
	
	public function setLastName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::LAST_NAME;
		}

		return $this;
	} 
	
	public function setFirstName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::FIRST_NAME;
		}

		return $this;
	} 
	
	public function setMiddleName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->middle_name !== $v) {
			$this->middle_name = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::MIDDLE_NAME;
		}

		return $this;
	} 
	
	public function setBirthday($v)
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

		if ( $this->birthday !== null || $dt !== null ) {
			
			$currNorm = ($this->birthday !== null && $tmpDt = new DateTime($this->birthday)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->birthday = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = sfGuardUserProfilePeer::BIRTHDAY;
			}
		} 
		return $this;
	} 
	
	public function setGender($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->gender !== $v || $v === 'M') {
			$this->gender = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::GENDER;
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
			$this->modifiedColumns[] = sfGuardUserProfilePeer::COUNTRY;
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
			$this->modifiedColumns[] = sfGuardUserProfilePeer::CITY_ID;
		}

		if ($this->acity !== null && $this->acity->getId() !== $v) {
			$this->acity = null;
		}

		return $this;
	} 
	
	public function setInstitution($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->institution !== $v) {
			$this->institution = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::INSTITUTION;
		}

		return $this;
	} 
	
	public function setAddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->address !== $v || $v === '') {
			$this->address = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::ADDRESS;
		}

		return $this;
	} 
	
	public function setIsAddressPrivate($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_address_private !== $v || $v === false) {
			$this->is_address_private = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::IS_ADDRESS_PRIVATE;
		}

		return $this;
	} 
	
	public function setEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email !== $v || $v === 'jsc@niic.nsc.ru') {
			$this->email = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::EMAIL;
		}

		return $this;
	} 
	
	public function setPhoneHome($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->phone_home !== $v) {
			$this->phone_home = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::PHONE_HOME;
		}

		return $this;
	} 
	
	public function setPhoneWork($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->phone_work !== $v) {
			$this->phone_work = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::PHONE_WORK;
		}

		return $this;
	} 
	
	public function setQualification($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->qualification !== $v) {
			$this->qualification = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::QUALIFICATION;
		}

		return $this;
	} 
	
	public function setIsReviewer($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_reviewer !== $v || $v === false) {
			$this->is_reviewer = $v;
			$this->modifiedColumns[] = sfGuardUserProfilePeer::IS_REVIEWER;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(sfGuardUserProfilePeer::GENDER,sfGuardUserProfilePeer::COUNTRY,sfGuardUserProfilePeer::ADDRESS,sfGuardUserProfilePeer::IS_ADDRESS_PRIVATE,sfGuardUserProfilePeer::EMAIL,sfGuardUserProfilePeer::IS_REVIEWER))) {
				return false;
			}

			if ($this->gender !== 'M') {
				return false;
			}

			if ($this->country !== 'RU') {
				return false;
			}

			if ($this->address !== '') {
				return false;
			}

			if ($this->is_address_private !== false) {
				return false;
			}

			if ($this->email !== '') {
				return false;
			}

			if ($this->is_reviewer !== false) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->user_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->last_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->first_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->middle_name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->birthday = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->gender = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->country = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->city_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->institution = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->address = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->is_address_private = ($row[$startcol + 10] !== null) ? (boolean) $row[$startcol + 10] : null;
			$this->email = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->phone_home = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->phone_work = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->qualification = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->is_reviewer = ($row[$startcol + 15] !== null) ? (boolean) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfGuardUserProfile object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = sfGuardUserProfilePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->asfGuardUser = null;
			$this->acity = null;
			$this->singleGuardUser = null;

			$this->colluserManuscriptRefs = null;
			$this->lastuserManuscriptRefCriteria = null;

			$this->collreviews = null;
			$this->lastreviewCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasesfGuardUserProfile:delete:pre') as $callable)
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			sfGuardUserProfilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasesfGuardUserProfile:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasesfGuardUserProfile:save:pre') as $callable)
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
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasesfGuardUserProfile:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			sfGuardUserProfilePeer::addInstanceToPool($this);
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

												
			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->acity !== null) {
				if ($this->acity->isModified() || $this->acity->isNew()) {
					$affectedRows += $this->acity->save($con);
				}
				$this->setcity($this->acity);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfGuardUserProfilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += sfGuardUserProfilePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->singleGuardUser !== null) {
				if (!$this->singleGuardUser->isDeleted()) {
						$affectedRows += $this->singleGuardUser->save($con);
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


												
			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->acity !== null) {
				if (!$this->acity->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->acity->getValidationFailures());
				}
			}


			if (($retval = sfGuardUserProfilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->singleGuardUser !== null) {
					if (!$this->singleGuardUser->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleGuardUser->getValidationFailures());
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfGuardUserProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getLastName();
				break;
			case 2:
				return $this->getFirstName();
				break;
			case 3:
				return $this->getMiddleName();
				break;
			case 4:
				return $this->getBirthday();
				break;
			case 5:
				return $this->getGender();
				break;
			case 6:
				return $this->getCountry();
				break;
			case 7:
				return $this->getCityId();
				break;
			case 8:
				return $this->getInstitution();
				break;
			case 9:
				return $this->getAddress();
				break;
			case 10:
				return $this->getIsAddressPrivate();
				break;
			case 11:
				return $this->getEmail();
				break;
			case 12:
				return $this->getPhoneHome();
				break;
			case 13:
				return $this->getPhoneWork();
				break;
			case 14:
				return $this->getQualification();
				break;
			case 15:
				return $this->getIsReviewer();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = sfGuardUserProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUserId(),
			$keys[1] => $this->getLastName(),
			$keys[2] => $this->getFirstName(),
			$keys[3] => $this->getMiddleName(),
			$keys[4] => $this->getBirthday(),
			$keys[5] => $this->getGender(),
			$keys[6] => $this->getCountry(),
			$keys[7] => $this->getCityId(),
			$keys[8] => $this->getInstitution(),
			$keys[9] => $this->getAddress(),
			$keys[10] => $this->getIsAddressPrivate(),
			$keys[11] => $this->getEmail(),
			$keys[12] => $this->getPhoneHome(),
			$keys[13] => $this->getPhoneWork(),
			$keys[14] => $this->getQualification(),
			$keys[15] => $this->getIsReviewer(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfGuardUserProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUserId($value);
				break;
			case 1:
				$this->setLastName($value);
				break;
			case 2:
				$this->setFirstName($value);
				break;
			case 3:
				$this->setMiddleName($value);
				break;
			case 4:
				$this->setBirthday($value);
				break;
			case 5:
				$this->setGender($value);
				break;
			case 6:
				$this->setCountry($value);
				break;
			case 7:
				$this->setCityId($value);
				break;
			case 8:
				$this->setInstitution($value);
				break;
			case 9:
				$this->setAddress($value);
				break;
			case 10:
				$this->setIsAddressPrivate($value);
				break;
			case 11:
				$this->setEmail($value);
				break;
			case 12:
				$this->setPhoneHome($value);
				break;
			case 13:
				$this->setPhoneWork($value);
				break;
			case 14:
				$this->setQualification($value);
				break;
			case 15:
				$this->setIsReviewer($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfGuardUserProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setLastName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFirstName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMiddleName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setBirthday($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setGender($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCountry($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCityId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setInstitution($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAddress($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setIsAddressPrivate($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setEmail($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setPhoneHome($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPhoneWork($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setQualification($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setIsReviewer($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(sfGuardUserProfilePeer::USER_ID)) $criteria->add(sfGuardUserProfilePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(sfGuardUserProfilePeer::LAST_NAME)) $criteria->add(sfGuardUserProfilePeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(sfGuardUserProfilePeer::FIRST_NAME)) $criteria->add(sfGuardUserProfilePeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(sfGuardUserProfilePeer::MIDDLE_NAME)) $criteria->add(sfGuardUserProfilePeer::MIDDLE_NAME, $this->middle_name);
		if ($this->isColumnModified(sfGuardUserProfilePeer::BIRTHDAY)) $criteria->add(sfGuardUserProfilePeer::BIRTHDAY, $this->birthday);
		if ($this->isColumnModified(sfGuardUserProfilePeer::GENDER)) $criteria->add(sfGuardUserProfilePeer::GENDER, $this->gender);
		if ($this->isColumnModified(sfGuardUserProfilePeer::COUNTRY)) $criteria->add(sfGuardUserProfilePeer::COUNTRY, $this->country);
		if ($this->isColumnModified(sfGuardUserProfilePeer::CITY_ID)) $criteria->add(sfGuardUserProfilePeer::CITY_ID, $this->city_id);
		if ($this->isColumnModified(sfGuardUserProfilePeer::INSTITUTION)) $criteria->add(sfGuardUserProfilePeer::INSTITUTION, $this->institution);
		if ($this->isColumnModified(sfGuardUserProfilePeer::ADDRESS)) $criteria->add(sfGuardUserProfilePeer::ADDRESS, $this->address);
		if ($this->isColumnModified(sfGuardUserProfilePeer::IS_ADDRESS_PRIVATE)) $criteria->add(sfGuardUserProfilePeer::IS_ADDRESS_PRIVATE, $this->is_address_private);
		if ($this->isColumnModified(sfGuardUserProfilePeer::EMAIL)) $criteria->add(sfGuardUserProfilePeer::EMAIL, $this->email);
		if ($this->isColumnModified(sfGuardUserProfilePeer::PHONE_HOME)) $criteria->add(sfGuardUserProfilePeer::PHONE_HOME, $this->phone_home);
		if ($this->isColumnModified(sfGuardUserProfilePeer::PHONE_WORK)) $criteria->add(sfGuardUserProfilePeer::PHONE_WORK, $this->phone_work);
		if ($this->isColumnModified(sfGuardUserProfilePeer::QUALIFICATION)) $criteria->add(sfGuardUserProfilePeer::QUALIFICATION, $this->qualification);
		if ($this->isColumnModified(sfGuardUserProfilePeer::IS_REVIEWER)) $criteria->add(sfGuardUserProfilePeer::IS_REVIEWER, $this->is_reviewer);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);

		$criteria->add(sfGuardUserProfilePeer::USER_ID, $this->user_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getUserId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setUserId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setLastName($this->last_name);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setMiddleName($this->middle_name);

		$copyObj->setBirthday($this->birthday);

		$copyObj->setGender($this->gender);

		$copyObj->setCountry($this->country);

		$copyObj->setCityId($this->city_id);

		$copyObj->setInstitution($this->institution);

		$copyObj->setAddress($this->address);

		$copyObj->setIsAddressPrivate($this->is_address_private);

		$copyObj->setEmail($this->email);

		$copyObj->setPhoneHome($this->phone_home);

		$copyObj->setPhoneWork($this->phone_work);

		$copyObj->setQualification($this->qualification);

		$copyObj->setIsReviewer($this->is_reviewer);


		if ($deepCopy) {
									$copyObj->setNew(false);

			$relObj = $this->getGuardUser();
			if ($relObj) {
				$copyObj->setGuardUser($relObj->copy($deepCopy));
			}

			foreach ($this->getuserManuscriptRefs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->adduserManuscriptRef($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getreviews() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addreview($relObj->copy($deepCopy));
				}
			}

		} 

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
			self::$peer = new sfGuardUserProfilePeer();
		}
		return self::$peer;
	}

	
	public function setsfGuardUser(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}

		$this->asfGuardUser = $v;

				if ($v !== null) {
			$v->setsfGuardUserProfile($this);
		}

		return $this;
	}


	
	public function getsfGuardUser(PropelPDO $con = null)
	{
		if ($this->asfGuardUser === null && ($this->user_id !== null)) {
			$c = new Criteria(sfGuardUserPeer::DATABASE_NAME);
			$c->add(sfGuardUserPeer::ID, $this->user_id);
			$this->asfGuardUser = sfGuardUserPeer::doSelectOne($c, $con);
						$this->asfGuardUser->setsfGuardUserProfile($this);
		}
		return $this->asfGuardUser;
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
			$v->addsfGuardUserProfile($this);
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

	
	public function getGuardUser(PropelPDO $con = null)
	{

		if ($this->singleGuardUser === null && !$this->isNew()) {
			$this->singleGuardUser = GuardUserPeer::retrieveByPK($this->user_id, $con);
		}

		return $this->singleGuardUser;
	}

	
	public function setGuardUser(GuardUser $v)
	{
		$this->singleGuardUser = $v;

				if ($v->getsfGuardUserProfile() === null) {
			$v->setsfGuardUserProfile($this);
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
			$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserManuscriptRefs === null) {
			if ($this->isNew()) {
			   $this->colluserManuscriptRefs = array();
			} else {

				$criteria->add(userManuscriptRefPeer::USER_ID, $this->user_id);

				userManuscriptRefPeer::addSelectColumns($criteria);
				$this->colluserManuscriptRefs = userManuscriptRefPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(userManuscriptRefPeer::USER_ID, $this->user_id);

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
			$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
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

				$criteria->add(userManuscriptRefPeer::USER_ID, $this->user_id);

				$count = userManuscriptRefPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(userManuscriptRefPeer::USER_ID, $this->user_id);

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
			$l->setsfGuardUserProfile($this);
		}
	}


	
	public function getuserManuscriptRefsJoinmanuscript($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserManuscriptRefs === null) {
			if ($this->isNew()) {
				$this->colluserManuscriptRefs = array();
			} else {

				$criteria->add(userManuscriptRefPeer::USER_ID, $this->user_id);

				$this->colluserManuscriptRefs = userManuscriptRefPeer::doSelectJoinmanuscript($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(userManuscriptRefPeer::USER_ID, $this->user_id);

			if (!isset($this->lastuserManuscriptRefCriteria) || !$this->lastuserManuscriptRefCriteria->equals($criteria)) {
				$this->colluserManuscriptRefs = userManuscriptRefPeer::doSelectJoinmanuscript($criteria, $con, $join_behavior);
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
			$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collreviews === null) {
			if ($this->isNew()) {
			   $this->collreviews = array();
			} else {

				$criteria->add(reviewPeer::USER_ID, $this->user_id);

				reviewPeer::addSelectColumns($criteria);
				$this->collreviews = reviewPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(reviewPeer::USER_ID, $this->user_id);

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
			$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
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

				$criteria->add(reviewPeer::USER_ID, $this->user_id);

				$count = reviewPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(reviewPeer::USER_ID, $this->user_id);

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
			$l->setsfGuardUserProfile($this);
		}
	}


	
	public function getreviewsJoinmanuscript($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collreviews === null) {
			if ($this->isNew()) {
				$this->collreviews = array();
			} else {

				$criteria->add(reviewPeer::USER_ID, $this->user_id);

				$this->collreviews = reviewPeer::doSelectJoinmanuscript($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(reviewPeer::USER_ID, $this->user_id);

			if (!isset($this->lastreviewCriteria) || !$this->lastreviewCriteria->equals($criteria)) {
				$this->collreviews = reviewPeer::doSelectJoinmanuscript($criteria, $con, $join_behavior);
			}
		}
		$this->lastreviewCriteria = $criteria;

		return $this->collreviews;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->singleGuardUser) {
				$this->singleGuardUser->clearAllReferences($deep);
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
		} 
		$this->singleGuardUser = null;
		$this->colluserManuscriptRefs = null;
		$this->collreviews = null;
			$this->asfGuardUser = null;
			$this->acity = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasesfGuardUserProfile:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasesfGuardUserProfile::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 
