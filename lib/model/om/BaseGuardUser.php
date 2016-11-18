<?php


abstract class BaseGuardUser extends BaseObject  implements Persistent {


  const PEER = 'GuardUserPeer';

	
	protected static $peer;

	
	protected $id;

	
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

	
	protected $qualification;

	
	protected $is_reviewer;

	
	protected $username;

	
	protected $created_at;

	
	protected $last_login;

	
	protected $is_active;

	
	protected $is_super_admin;

	
	protected $acity;

	
	protected $asfGuardUser;

	
	protected $asfGuardUserProfile;

	
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
		$this->email = 'jct@ict.nsc.ru';
		$this->is_reviewer = false;
		$this->is_active = true;
		$this->is_super_admin = false;
	}

	
	public function getId()
	{
		return $this->id;
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

	
	public function getQualification()
	{
		return $this->qualification;
	}

	
	public function getIsReviewer()
	{
		return $this->is_reviewer;
	}

	
	public function getUsername()
	{
		return $this->username;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
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

	
	public function getLastLogin($format = 'Y-m-d H:i:s')
	{
		if ($this->last_login === null) {
			return null;
		}


		if ($this->last_login === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->last_login);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_login, true), $x);
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

	
	public function getIsActive()
	{
		return $this->is_active;
	}

	
	public function getIsSuperAdmin()
	{
		return $this->is_super_admin;
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = GuardUserPeer::ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		if ($this->asfGuardUserProfile !== null && $this->asfGuardUserProfile->getUserId() !== $v) {
			$this->asfGuardUserProfile = null;
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
			$this->modifiedColumns[] = GuardUserPeer::LAST_NAME;
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
			$this->modifiedColumns[] = GuardUserPeer::FIRST_NAME;
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
			$this->modifiedColumns[] = GuardUserPeer::MIDDLE_NAME;
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
				$this->modifiedColumns[] = GuardUserPeer::BIRTHDAY;
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
			$this->modifiedColumns[] = GuardUserPeer::GENDER;
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
			$this->modifiedColumns[] = GuardUserPeer::COUNTRY;
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
			$this->modifiedColumns[] = GuardUserPeer::CITY_ID;
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
			$this->modifiedColumns[] = GuardUserPeer::INSTITUTION;
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
			$this->modifiedColumns[] = GuardUserPeer::ADDRESS;
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
			$this->modifiedColumns[] = GuardUserPeer::IS_ADDRESS_PRIVATE;
		}

		return $this;
	} 
	
	public function setEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email !== $v || $v === 'jct@ict.nsc.ru') {
			$this->email = $v;
			$this->modifiedColumns[] = GuardUserPeer::EMAIL;
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
			$this->modifiedColumns[] = GuardUserPeer::QUALIFICATION;
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
			$this->modifiedColumns[] = GuardUserPeer::IS_REVIEWER;
		}

		return $this;
	} 
	
	public function setUsername($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = GuardUserPeer::USERNAME;
		}

		return $this;
	} 
	
	public function setCreatedAt($v)
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

		if ( $this->created_at !== null || $dt !== null ) {
			
			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = GuardUserPeer::CREATED_AT;
			}
		} 
		return $this;
	} 
	
	public function setLastLogin($v)
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

		if ( $this->last_login !== null || $dt !== null ) {
			
			$currNorm = ($this->last_login !== null && $tmpDt = new DateTime($this->last_login)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->last_login = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = GuardUserPeer::LAST_LOGIN;
			}
		} 
		return $this;
	} 
	
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_active !== $v || $v === true) {
			$this->is_active = $v;
			$this->modifiedColumns[] = GuardUserPeer::IS_ACTIVE;
		}

		return $this;
	} 
	
	public function setIsSuperAdmin($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_super_admin !== $v || $v === false) {
			$this->is_super_admin = $v;
			$this->modifiedColumns[] = GuardUserPeer::IS_SUPER_ADMIN;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array(GuardUserPeer::GENDER,GuardUserPeer::COUNTRY,GuardUserPeer::ADDRESS,GuardUserPeer::IS_ADDRESS_PRIVATE,GuardUserPeer::EMAIL,GuardUserPeer::IS_REVIEWER,GuardUserPeer::IS_ACTIVE,GuardUserPeer::IS_SUPER_ADMIN))) {
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

			if ($this->email !== 'jct@ict.nsc.ru') {
				return false;
			}

			if ($this->is_reviewer !== false) {
				return false;
			}

			if ($this->is_active !== true) {
				return false;
			}

			if ($this->is_super_admin !== false) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
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
			$this->qualification = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->is_reviewer = ($row[$startcol + 13] !== null) ? (boolean) $row[$startcol + 13] : null;
			$this->username = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->created_at = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->last_login = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->is_active = ($row[$startcol + 17] !== null) ? (boolean) $row[$startcol + 17] : null;
			$this->is_super_admin = ($row[$startcol + 18] !== null) ? (boolean) $row[$startcol + 18] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 19; 
		} catch (Exception $e) {
			throw new PropelException("Error populating GuardUser object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->asfGuardUser !== null && $this->id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
		if ($this->asfGuardUserProfile !== null && $this->id !== $this->asfGuardUserProfile->getUserId()) {
			$this->asfGuardUserProfile = null;
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
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = GuardUserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->acity = null;
			$this->asfGuardUser = null;
			$this->asfGuardUserProfile = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseGuardUser:delete:pre') as $callable)
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
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			GuardUserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseGuardUser:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseGuardUser:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(GuardUserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseGuardUser:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			GuardUserPeer::addInstanceToPool($this);
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

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->asfGuardUserProfile !== null) {
				if ($this->asfGuardUserProfile->isModified() || $this->asfGuardUserProfile->isNew()) {
					$affectedRows += $this->asfGuardUserProfile->save($con);
				}
				$this->setsfGuardUserProfile($this->asfGuardUserProfile);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = GuardUserPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = GuardUserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += GuardUserPeer::doUpdate($this, $con);
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


												
			if ($this->acity !== null) {
				if (!$this->acity->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->acity->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->asfGuardUserProfile !== null) {
				if (!$this->asfGuardUserProfile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUserProfile->getValidationFailures());
				}
			}


			if (($retval = GuardUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GuardUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getQualification();
				break;
			case 13:
				return $this->getIsReviewer();
				break;
			case 14:
				return $this->getUsername();
				break;
			case 15:
				return $this->getCreatedAt();
				break;
			case 16:
				return $this->getLastLogin();
				break;
			case 17:
				return $this->getIsActive();
				break;
			case 18:
				return $this->getIsSuperAdmin();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = GuardUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
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
			$keys[12] => $this->getQualification(),
			$keys[13] => $this->getIsReviewer(),
			$keys[14] => $this->getUsername(),
			$keys[15] => $this->getCreatedAt(),
			$keys[16] => $this->getLastLogin(),
			$keys[17] => $this->getIsActive(),
			$keys[18] => $this->getIsSuperAdmin(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GuardUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
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
				$this->setQualification($value);
				break;
			case 13:
				$this->setIsReviewer($value);
				break;
			case 14:
				$this->setUsername($value);
				break;
			case 15:
				$this->setCreatedAt($value);
				break;
			case 16:
				$this->setLastLogin($value);
				break;
			case 17:
				$this->setIsActive($value);
				break;
			case 18:
				$this->setIsSuperAdmin($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GuardUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
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
		if (array_key_exists($keys[12], $arr)) $this->setQualification($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIsReviewer($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUsername($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCreatedAt($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setLastLogin($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setIsActive($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setIsSuperAdmin($arr[$keys[18]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(GuardUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(GuardUserPeer::ID)) $criteria->add(GuardUserPeer::ID, $this->id);
		if ($this->isColumnModified(GuardUserPeer::LAST_NAME)) $criteria->add(GuardUserPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(GuardUserPeer::FIRST_NAME)) $criteria->add(GuardUserPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(GuardUserPeer::MIDDLE_NAME)) $criteria->add(GuardUserPeer::MIDDLE_NAME, $this->middle_name);
		if ($this->isColumnModified(GuardUserPeer::BIRTHDAY)) $criteria->add(GuardUserPeer::BIRTHDAY, $this->birthday);
		if ($this->isColumnModified(GuardUserPeer::GENDER)) $criteria->add(GuardUserPeer::GENDER, $this->gender);
		if ($this->isColumnModified(GuardUserPeer::COUNTRY)) $criteria->add(GuardUserPeer::COUNTRY, $this->country);
		if ($this->isColumnModified(GuardUserPeer::CITY_ID)) $criteria->add(GuardUserPeer::CITY_ID, $this->city_id);
		if ($this->isColumnModified(GuardUserPeer::INSTITUTION)) $criteria->add(GuardUserPeer::INSTITUTION, $this->institution);
		if ($this->isColumnModified(GuardUserPeer::ADDRESS)) $criteria->add(GuardUserPeer::ADDRESS, $this->address);
		if ($this->isColumnModified(GuardUserPeer::IS_ADDRESS_PRIVATE)) $criteria->add(GuardUserPeer::IS_ADDRESS_PRIVATE, $this->is_address_private);
		if ($this->isColumnModified(GuardUserPeer::EMAIL)) $criteria->add(GuardUserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(GuardUserPeer::QUALIFICATION)) $criteria->add(GuardUserPeer::QUALIFICATION, $this->qualification);
		if ($this->isColumnModified(GuardUserPeer::IS_REVIEWER)) $criteria->add(GuardUserPeer::IS_REVIEWER, $this->is_reviewer);
		if ($this->isColumnModified(GuardUserPeer::USERNAME)) $criteria->add(GuardUserPeer::USERNAME, $this->username);
		if ($this->isColumnModified(GuardUserPeer::CREATED_AT)) $criteria->add(GuardUserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(GuardUserPeer::LAST_LOGIN)) $criteria->add(GuardUserPeer::LAST_LOGIN, $this->last_login);
		if ($this->isColumnModified(GuardUserPeer::IS_ACTIVE)) $criteria->add(GuardUserPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(GuardUserPeer::IS_SUPER_ADMIN)) $criteria->add(GuardUserPeer::IS_SUPER_ADMIN, $this->is_super_admin);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GuardUserPeer::DATABASE_NAME);

		$criteria->add(GuardUserPeer::ID, $this->id);

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

		$copyObj->setQualification($this->qualification);

		$copyObj->setIsReviewer($this->is_reviewer);

		$copyObj->setUsername($this->username);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastLogin($this->last_login);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIsSuperAdmin($this->is_super_admin);


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
			self::$peer = new GuardUserPeer();
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
			$v->addGuardUser($this);
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

	
	public function setsfGuardUser(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getId());
		}

		$this->asfGuardUser = $v;

				if ($v !== null) {
			$v->setGuardUser($this);
		}

		return $this;
	}


	
	public function getsfGuardUser(PropelPDO $con = null)
	{
		if ($this->asfGuardUser === null && ($this->id !== null)) {
			$c = new Criteria(sfGuardUserPeer::DATABASE_NAME);
			$c->add(sfGuardUserPeer::ID, $this->id);
			$this->asfGuardUser = sfGuardUserPeer::doSelectOne($c, $con);
						$this->asfGuardUser->setGuardUser($this);
		}
		return $this->asfGuardUser;
	}

	
	public function setsfGuardUserProfile(sfGuardUserProfile $v = null)
	{
		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getUserId());
		}

		$this->asfGuardUserProfile = $v;

				if ($v !== null) {
			$v->setGuardUser($this);
		}

		return $this;
	}


	
	public function getsfGuardUserProfile(PropelPDO $con = null)
	{
		if ($this->asfGuardUserProfile === null && ($this->id !== null)) {
			$c = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
			$c->add(sfGuardUserProfilePeer::USER_ID, $this->id);
			$this->asfGuardUserProfile = sfGuardUserProfilePeer::doSelectOne($c, $con);
						$this->asfGuardUserProfile->setGuardUser($this);
		}
		return $this->asfGuardUserProfile;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->acity = null;
			$this->asfGuardUser = null;
			$this->asfGuardUserProfile = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseGuardUser:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseGuardUser::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 