<?php


abstract class BasesfGuardUserProfilePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sf_guard_user_profile';

	
	const CLASS_DEFAULT = 'lib.model.sfGuardUserProfile';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const USER_ID = 'sf_guard_user_profile.USER_ID';

	
	const LAST_NAME = 'sf_guard_user_profile.LAST_NAME';

	
	const FIRST_NAME = 'sf_guard_user_profile.FIRST_NAME';

	
	const MIDDLE_NAME = 'sf_guard_user_profile.MIDDLE_NAME';

	
	const BIRTHDAY = 'sf_guard_user_profile.BIRTHDAY';

	
	const GENDER = 'sf_guard_user_profile.GENDER';

	
	const COUNTRY = 'sf_guard_user_profile.COUNTRY';

	
	const CITY_ID = 'sf_guard_user_profile.CITY_ID';

	
	const INSTITUTION = 'sf_guard_user_profile.INSTITUTION';

	
	const ADDRESS = 'sf_guard_user_profile.ADDRESS';

	
	const IS_ADDRESS_PRIVATE = 'sf_guard_user_profile.IS_ADDRESS_PRIVATE';

	
	const EMAIL = 'sf_guard_user_profile.EMAIL';

	
	const PHONE_HOME = 'sf_guard_user_profile.PHONE_HOME';

	
	const PHONE_WORK = 'sf_guard_user_profile.PHONE_WORK';

	
	const QUALIFICATION = 'sf_guard_user_profile.QUALIFICATION';

	
	const IS_REVIEWER = 'sf_guard_user_profile.IS_REVIEWER';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('UserId', 'LastName', 'FirstName', 'MiddleName', 'Birthday', 'Gender', 'Country', 'CityId', 'Institution', 'Address', 'IsAddressPrivate', 'Email', 'PhoneHome', 'PhoneWork', 'Qualification', 'IsReviewer', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('userId', 'lastName', 'firstName', 'middleName', 'birthday', 'gender', 'country', 'cityId', 'institution', 'address', 'isAddressPrivate', 'email', 'phoneHome', 'phoneWork', 'qualification', 'isReviewer', ),
		BasePeer::TYPE_COLNAME => array (self::USER_ID, self::LAST_NAME, self::FIRST_NAME, self::MIDDLE_NAME, self::BIRTHDAY, self::GENDER, self::COUNTRY, self::CITY_ID, self::INSTITUTION, self::ADDRESS, self::IS_ADDRESS_PRIVATE, self::EMAIL, self::PHONE_HOME, self::PHONE_WORK, self::QUALIFICATION, self::IS_REVIEWER, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id', 'last_name', 'first_name', 'middle_name', 'birthday', 'gender', 'country', 'city_id', 'institution', 'address', 'is_address_private', 'email', 'phone_home', 'phone_work', 'qualification', 'is_reviewer', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('UserId' => 0, 'LastName' => 1, 'FirstName' => 2, 'MiddleName' => 3, 'Birthday' => 4, 'Gender' => 5, 'Country' => 6, 'CityId' => 7, 'Institution' => 8, 'Address' => 9, 'IsAddressPrivate' => 10, 'Email' => 11, 'PhoneHome' => 12, 'PhoneWork' => 13, 'Qualification' => 14, 'IsReviewer' => 15, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('userId' => 0, 'lastName' => 1, 'firstName' => 2, 'middleName' => 3, 'birthday' => 4, 'gender' => 5, 'country' => 6, 'cityId' => 7, 'institution' => 8, 'address' => 9, 'isAddressPrivate' => 10, 'email' => 11, 'phoneHome' => 12, 'phoneWork' => 13, 'qualification' => 14, 'isReviewer' => 15, ),
		BasePeer::TYPE_COLNAME => array (self::USER_ID => 0, self::LAST_NAME => 1, self::FIRST_NAME => 2, self::MIDDLE_NAME => 3, self::BIRTHDAY => 4, self::GENDER => 5, self::COUNTRY => 6, self::CITY_ID => 7, self::INSTITUTION => 8, self::ADDRESS => 9, self::IS_ADDRESS_PRIVATE => 10, self::EMAIL => 11, self::PHONE_HOME => 12, self::PHONE_WORK => 13, self::QUALIFICATION => 14, self::IS_REVIEWER => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id' => 0, 'last_name' => 1, 'first_name' => 2, 'middle_name' => 3, 'birthday' => 4, 'gender' => 5, 'country' => 6, 'city_id' => 7, 'institution' => 8, 'address' => 9, 'is_address_private' => 10, 'email' => 11, 'phone_home' => 12, 'phone_work' => 13, 'qualification' => 14, 'is_reviewer' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new sfGuardUserProfileMapBuilder();
		}
		return self::$mapBuilder;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(sfGuardUserProfilePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(sfGuardUserProfilePeer::USER_ID);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::LAST_NAME);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::FIRST_NAME);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::MIDDLE_NAME);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::BIRTHDAY);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::GENDER);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::COUNTRY);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::CITY_ID);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::INSTITUTION);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::ADDRESS);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::IS_ADDRESS_PRIVATE);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::EMAIL);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::PHONE_HOME);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::PHONE_WORK);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::QUALIFICATION);

		$criteria->addSelectColumn(sfGuardUserProfilePeer::IS_REVIEWER);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfGuardUserProfilePeer', $criteria, $con);
    }


				$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}
	
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = sfGuardUserProfilePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return sfGuardUserProfilePeer::populateObjects(sfGuardUserProfilePeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasesfGuardUserProfilePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(sfGuardUserProfile $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getUserId();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof sfGuardUserProfile) {
				$key = (string) $value->getUserId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or sfGuardUserProfile object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} 
	
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; 	}
	
	
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
				if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = sfGuardUserProfilePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = sfGuardUserProfilePeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				sfGuardUserProfilePeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(sfGuardUserProfilePeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfGuardUserProfilePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoincity(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(sfGuardUserProfilePeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfGuardUserProfilePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinsfGuardUser(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasesfGuardUserProfilePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($c);

		$c->addJoin(array(sfGuardUserProfilePeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = sfGuardUserProfilePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = sfGuardUserPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->setsfGuardUserProfile($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoincity(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);
		cityPeer::addSelectColumns($c);

		$c->addJoin(array(sfGuardUserProfilePeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = sfGuardUserProfilePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = cityPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = cityPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = cityPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					cityPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addsfGuardUserProfile($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(sfGuardUserProfilePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(sfGuardUserProfilePeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$criteria->addJoin(array(sfGuardUserProfilePeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfGuardUserProfilePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}

	
	public static function doSelectJoinAll(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasesfGuardUserProfilePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol2 = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		cityPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (cityPeer::NUM_COLUMNS - cityPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(sfGuardUserProfilePeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$c->addJoin(array(sfGuardUserProfilePeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = sfGuardUserProfilePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = sfGuardUserPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj1->setsfGuardUser($obj2);
			} 
			
			$key3 = cityPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = cityPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = cityPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					cityPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addsfGuardUserProfile($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(sfGuardUserProfilePeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfGuardUserProfilePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptcity(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfGuardUserProfilePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(sfGuardUserProfilePeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfGuardUserProfilePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptsfGuardUser(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BasesfGuardUserProfilePeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol2 = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

		cityPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (cityPeer::NUM_COLUMNS - cityPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(sfGuardUserProfilePeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = sfGuardUserProfilePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = cityPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = cityPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = cityPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					cityPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addsfGuardUserProfile($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptcity(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol2 = (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(sfGuardUserProfilePeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfGuardUserProfilePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = sfGuardUserProfilePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfGuardUserProfilePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = sfGuardUserPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->setsfGuardUserProfile($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return sfGuardUserProfilePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasesfGuardUserProfilePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasesfGuardUserProfilePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasesfGuardUserProfilePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(sfGuardUserProfilePeer::USER_ID);
			$selectCriteria->add(sfGuardUserProfilePeer::USER_ID, $criteria->remove(sfGuardUserProfilePeer::USER_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasesfGuardUserProfilePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasesfGuardUserProfilePeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += sfGuardUserProfilePeer::doOnDeleteCascade(new Criteria(sfGuardUserProfilePeer::DATABASE_NAME), $con);
			sfGuardUserProfilePeer::doOnDeleteSetNull(new Criteria(sfGuardUserProfilePeer::DATABASE_NAME), $con);
			$affectedRows += BasePeer::doDeleteAll(sfGuardUserProfilePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												sfGuardUserProfilePeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof sfGuardUserProfile) {
						sfGuardUserProfilePeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(sfGuardUserProfilePeer::USER_ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								sfGuardUserProfilePeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			$affectedRows += sfGuardUserProfilePeer::doOnDeleteCascade($criteria, $con);
			sfGuardUserProfilePeer::doOnDeleteSetNull($criteria, $con);
			
																if ($values instanceof Criteria) {
					sfGuardUserProfilePeer::clearInstancePool();
				} else { 					sfGuardUserProfilePeer::removeInstanceFromPool($values);
				}
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

						userManuscriptRefPeer::clearInstancePool();

						reviewPeer::clearInstancePool();

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected static function doOnDeleteCascade(Criteria $criteria, PropelPDO $con)
	{
				$affectedRows = 0;

				$objects = sfGuardUserProfilePeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {


						$c = new Criteria(userManuscriptRefPeer::DATABASE_NAME);
			
			$c->add(userManuscriptRefPeer::USER_ID, $obj->getUserId());
			$affectedRows += userManuscriptRefPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	protected static function doOnDeleteSetNull(Criteria $criteria, PropelPDO $con)
	{

				$objects = sfGuardUserProfilePeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {

						$selectCriteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
			$updateValues = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
			$selectCriteria->add(reviewPeer::USER_ID, $obj->getUserId());
			$updateValues->add(reviewPeer::USER_ID, null);

					BasePeer::doUpdate($selectCriteria, $updateValues, $con); 
		}
	}

	
	public static function doValidate(sfGuardUserProfile $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(sfGuardUserProfilePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(sfGuardUserProfilePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(sfGuardUserProfilePeer::DATABASE_NAME, sfGuardUserProfilePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = sfGuardUserProfilePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = sfGuardUserProfilePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
		$criteria->add(sfGuardUserProfilePeer::USER_ID, $pk);

		$v = sfGuardUserProfilePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(sfGuardUserProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(sfGuardUserProfilePeer::DATABASE_NAME);
			$criteria->add(sfGuardUserProfilePeer::USER_ID, $pks, Criteria::IN);
			$objs = sfGuardUserProfilePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BasesfGuardUserProfilePeer::DATABASE_NAME)->addTableBuilder(BasesfGuardUserProfilePeer::TABLE_NAME, BasesfGuardUserProfilePeer::getMapBuilder());

