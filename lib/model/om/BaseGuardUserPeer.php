<?php


abstract class BaseGuardUserPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'guard_user';

	
	const CLASS_DEFAULT = 'lib.model.GuardUser';

	
	const NUM_COLUMNS = 19;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'guard_user.ID';

	
	const LAST_NAME = 'guard_user.LAST_NAME';

	
	const FIRST_NAME = 'guard_user.FIRST_NAME';

	
	const MIDDLE_NAME = 'guard_user.MIDDLE_NAME';

	
	const BIRTHDAY = 'guard_user.BIRTHDAY';

	
	const GENDER = 'guard_user.GENDER';

	
	const COUNTRY = 'guard_user.COUNTRY';

	
	const CITY_ID = 'guard_user.CITY_ID';

	
	const INSTITUTION = 'guard_user.INSTITUTION';

	
	const ADDRESS = 'guard_user.ADDRESS';

	
	const IS_ADDRESS_PRIVATE = 'guard_user.IS_ADDRESS_PRIVATE';

	
	const EMAIL = 'guard_user.EMAIL';

	
	const QUALIFICATION = 'guard_user.QUALIFICATION';

	
	const IS_REVIEWER = 'guard_user.IS_REVIEWER';

	
	const USERNAME = 'guard_user.USERNAME';

	
	const CREATED_AT = 'guard_user.CREATED_AT';

	
	const LAST_LOGIN = 'guard_user.LAST_LOGIN';

	
	const IS_ACTIVE = 'guard_user.IS_ACTIVE';

	
	const IS_SUPER_ADMIN = 'guard_user.IS_SUPER_ADMIN';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'LastName', 'FirstName', 'MiddleName', 'Birthday', 'Gender', 'Country', 'CityId', 'Institution', 'Address', 'IsAddressPrivate', 'Email', 'Qualification', 'IsReviewer', 'Username', 'CreatedAt', 'LastLogin', 'IsActive', 'IsSuperAdmin', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'lastName', 'firstName', 'middleName', 'birthday', 'gender', 'country', 'cityId', 'institution', 'address', 'isAddressPrivate', 'email', 'qualification', 'isReviewer', 'username', 'createdAt', 'lastLogin', 'isActive', 'isSuperAdmin', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::LAST_NAME, self::FIRST_NAME, self::MIDDLE_NAME, self::BIRTHDAY, self::GENDER, self::COUNTRY, self::CITY_ID, self::INSTITUTION, self::ADDRESS, self::IS_ADDRESS_PRIVATE, self::EMAIL, self::QUALIFICATION, self::IS_REVIEWER, self::USERNAME, self::CREATED_AT, self::LAST_LOGIN, self::IS_ACTIVE, self::IS_SUPER_ADMIN, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'last_name', 'first_name', 'middle_name', 'birthday', 'gender', 'country', 'city_id', 'institution', 'address', 'is_address_private', 'email', 'qualification', 'is_reviewer', 'username', 'created_at', 'last_login', 'is_active', 'is_super_admin', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'LastName' => 1, 'FirstName' => 2, 'MiddleName' => 3, 'Birthday' => 4, 'Gender' => 5, 'Country' => 6, 'CityId' => 7, 'Institution' => 8, 'Address' => 9, 'IsAddressPrivate' => 10, 'Email' => 11, 'Qualification' => 12, 'IsReviewer' => 13, 'Username' => 14, 'CreatedAt' => 15, 'LastLogin' => 16, 'IsActive' => 17, 'IsSuperAdmin' => 18, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'lastName' => 1, 'firstName' => 2, 'middleName' => 3, 'birthday' => 4, 'gender' => 5, 'country' => 6, 'cityId' => 7, 'institution' => 8, 'address' => 9, 'isAddressPrivate' => 10, 'email' => 11, 'qualification' => 12, 'isReviewer' => 13, 'username' => 14, 'createdAt' => 15, 'lastLogin' => 16, 'isActive' => 17, 'isSuperAdmin' => 18, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::LAST_NAME => 1, self::FIRST_NAME => 2, self::MIDDLE_NAME => 3, self::BIRTHDAY => 4, self::GENDER => 5, self::COUNTRY => 6, self::CITY_ID => 7, self::INSTITUTION => 8, self::ADDRESS => 9, self::IS_ADDRESS_PRIVATE => 10, self::EMAIL => 11, self::QUALIFICATION => 12, self::IS_REVIEWER => 13, self::USERNAME => 14, self::CREATED_AT => 15, self::LAST_LOGIN => 16, self::IS_ACTIVE => 17, self::IS_SUPER_ADMIN => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'last_name' => 1, 'first_name' => 2, 'middle_name' => 3, 'birthday' => 4, 'gender' => 5, 'country' => 6, 'city_id' => 7, 'institution' => 8, 'address' => 9, 'is_address_private' => 10, 'email' => 11, 'qualification' => 12, 'is_reviewer' => 13, 'username' => 14, 'created_at' => 15, 'last_login' => 16, 'is_active' => 17, 'is_super_admin' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new GuardUserMapBuilder();
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
		return str_replace(GuardUserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(GuardUserPeer::ID);

		$criteria->addSelectColumn(GuardUserPeer::LAST_NAME);

		$criteria->addSelectColumn(GuardUserPeer::FIRST_NAME);

		$criteria->addSelectColumn(GuardUserPeer::MIDDLE_NAME);

		$criteria->addSelectColumn(GuardUserPeer::BIRTHDAY);

		$criteria->addSelectColumn(GuardUserPeer::GENDER);

		$criteria->addSelectColumn(GuardUserPeer::COUNTRY);

		$criteria->addSelectColumn(GuardUserPeer::CITY_ID);

		$criteria->addSelectColumn(GuardUserPeer::INSTITUTION);

		$criteria->addSelectColumn(GuardUserPeer::ADDRESS);

		$criteria->addSelectColumn(GuardUserPeer::IS_ADDRESS_PRIVATE);

		$criteria->addSelectColumn(GuardUserPeer::EMAIL);

		$criteria->addSelectColumn(GuardUserPeer::QUALIFICATION);

		$criteria->addSelectColumn(GuardUserPeer::IS_REVIEWER);

		$criteria->addSelectColumn(GuardUserPeer::USERNAME);

		$criteria->addSelectColumn(GuardUserPeer::CREATED_AT);

		$criteria->addSelectColumn(GuardUserPeer::LAST_LOGIN);

		$criteria->addSelectColumn(GuardUserPeer::IS_ACTIVE);

		$criteria->addSelectColumn(GuardUserPeer::IS_SUPER_ADMIN);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(GuardUserPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GuardUserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseGuardUserPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $criteria, $con);
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
		$objects = GuardUserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return GuardUserPeer::populateObjects(GuardUserPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseGuardUserPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			GuardUserPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(GuardUser $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof GuardUser) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or GuardUser object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = GuardUserPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = GuardUserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = GuardUserPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				GuardUserPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoincity(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(GuardUserPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GuardUserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(GuardUserPeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseGuardUserPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(GuardUserPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GuardUserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseGuardUserPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinsfGuardUserProfile(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(GuardUserPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GuardUserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseGuardUserPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoincity(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseGuardUserPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GuardUserPeer::addSelectColumns($c);
		$startcol = (GuardUserPeer::NUM_COLUMNS - GuardUserPeer::NUM_LAZY_LOAD_COLUMNS);
		cityPeer::addSelectColumns($c);

		$c->addJoin(array(GuardUserPeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = GuardUserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = GuardUserPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = GuardUserPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				GuardUserPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addGuardUser($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinsfGuardUser(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GuardUserPeer::addSelectColumns($c);
		$startcol = (GuardUserPeer::NUM_COLUMNS - GuardUserPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($c);

		$c->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = GuardUserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = GuardUserPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = GuardUserPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				GuardUserPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->setGuardUser($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinsfGuardUserProfile(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GuardUserPeer::addSelectColumns($c);
		$startcol = (GuardUserPeer::NUM_COLUMNS - GuardUserPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserProfilePeer::addSelectColumns($c);

		$c->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = GuardUserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = GuardUserPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = GuardUserPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				GuardUserPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = sfGuardUserProfilePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = sfGuardUserProfilePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					sfGuardUserProfilePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->setGuardUser($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(GuardUserPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GuardUserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(GuardUserPeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);
		$criteria->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$criteria->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseGuardUserPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseGuardUserPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GuardUserPeer::addSelectColumns($c);
		$startcol2 = (GuardUserPeer::NUM_COLUMNS - GuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		cityPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (cityPeer::NUM_COLUMNS - cityPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(GuardUserPeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);
		$c->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$c->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = GuardUserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = GuardUserPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = GuardUserPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				GuardUserPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addGuardUser($obj1);
			} 
			
			$key3 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = sfGuardUserPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = sfGuardUserPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					sfGuardUserPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj1->setsfGuardUser($obj3);
			} 
			
			$key4 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = sfGuardUserProfilePeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = sfGuardUserProfilePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					sfGuardUserProfilePeer::addInstanceToPool($obj4, $key4);
				} 
								$obj1->setsfGuardUserProfile($obj4);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptcity(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GuardUserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserPeer::ID,), $join_behavior);
				$criteria->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseGuardUserPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GuardUserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(GuardUserPeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);
				$criteria->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseGuardUserPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptsfGuardUserProfile(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			GuardUserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(GuardUserPeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);
				$criteria->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseGuardUserPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptcity(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseGuardUserPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GuardUserPeer::addSelectColumns($c);
		$startcol2 = (GuardUserPeer::NUM_COLUMNS - GuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserPeer::ID,), $join_behavior);
				$c->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = GuardUserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = GuardUserPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = GuardUserPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				GuardUserPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->setGuardUser($obj1);

			} 
				
				$key3 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = sfGuardUserProfilePeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = sfGuardUserProfilePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					sfGuardUserProfilePeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->setGuardUser($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptsfGuardUser(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GuardUserPeer::addSelectColumns($c);
		$startcol2 = (GuardUserPeer::NUM_COLUMNS - GuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		cityPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (cityPeer::NUM_COLUMNS - cityPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(GuardUserPeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);
				$c->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = GuardUserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = GuardUserPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = GuardUserPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				GuardUserPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addGuardUser($obj1);

			} 
				
				$key3 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = sfGuardUserProfilePeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = sfGuardUserProfilePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					sfGuardUserProfilePeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->setGuardUser($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptsfGuardUserProfile(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GuardUserPeer::addSelectColumns($c);
		$startcol2 = (GuardUserPeer::NUM_COLUMNS - GuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		cityPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (cityPeer::NUM_COLUMNS - cityPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(GuardUserPeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);
				$c->addJoin(array(GuardUserPeer::ID,), array(sfGuardUserPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = GuardUserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = GuardUserPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = GuardUserPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				GuardUserPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addGuardUser($obj1);

			} 
				
				$key3 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = sfGuardUserPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = sfGuardUserPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					sfGuardUserPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->setGuardUser($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array(array('username'));
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return GuardUserPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseGuardUserPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseGuardUserPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(GuardUserPeer::ID) && $criteria->keyContainsValue(GuardUserPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.GuardUserPeer::ID.')');
		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseGuardUserPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseGuardUserPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseGuardUserPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(GuardUserPeer::ID);
			$selectCriteria->add(GuardUserPeer::ID, $criteria->remove(GuardUserPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseGuardUserPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseGuardUserPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(GuardUserPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												GuardUserPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof GuardUser) {
						GuardUserPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(GuardUserPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								GuardUserPeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public static function doValidate(GuardUser $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(GuardUserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(GuardUserPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(GuardUserPeer::DATABASE_NAME, GuardUserPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = GuardUserPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = GuardUserPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(GuardUserPeer::DATABASE_NAME);
		$criteria->add(GuardUserPeer::ID, $pk);

		$v = GuardUserPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(GuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(GuardUserPeer::DATABASE_NAME);
			$criteria->add(GuardUserPeer::ID, $pks, Criteria::IN);
			$objs = GuardUserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseGuardUserPeer::DATABASE_NAME)->addTableBuilder(BaseGuardUserPeer::TABLE_NAME, BaseGuardUserPeer::getMapBuilder());

