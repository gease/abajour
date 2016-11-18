<?php


abstract class BaseuserManuscriptRefPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'users_manuscripts_ref';

	
	const CLASS_DEFAULT = 'lib.model.userManuscriptRef';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const USER_ID = 'users_manuscripts_ref.USER_ID';

	
	const MANUSCRIPT_ID = 'users_manuscripts_ref.MANUSCRIPT_ID';

	
	const IS_CORRESPONDING_AUTHOR = 'users_manuscripts_ref.IS_CORRESPONDING_AUTHOR';

	
	const AUTHOR_ORDER = 'users_manuscripts_ref.AUTHOR_ORDER';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('UserId', 'ManuscriptId', 'IsCorrespondingAuthor', 'AuthorOrder', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('userId', 'manuscriptId', 'isCorrespondingAuthor', 'authorOrder', ),
		BasePeer::TYPE_COLNAME => array (self::USER_ID, self::MANUSCRIPT_ID, self::IS_CORRESPONDING_AUTHOR, self::AUTHOR_ORDER, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id', 'manuscript_id', 'is_corresponding_author', 'author_order', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('UserId' => 0, 'ManuscriptId' => 1, 'IsCorrespondingAuthor' => 2, 'AuthorOrder' => 3, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('userId' => 0, 'manuscriptId' => 1, 'isCorrespondingAuthor' => 2, 'authorOrder' => 3, ),
		BasePeer::TYPE_COLNAME => array (self::USER_ID => 0, self::MANUSCRIPT_ID => 1, self::IS_CORRESPONDING_AUTHOR => 2, self::AUTHOR_ORDER => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id' => 0, 'manuscript_id' => 1, 'is_corresponding_author' => 2, 'author_order' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new userManuscriptRefMapBuilder();
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
		return str_replace(userManuscriptRefPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(userManuscriptRefPeer::USER_ID);

		$criteria->addSelectColumn(userManuscriptRefPeer::MANUSCRIPT_ID);

		$criteria->addSelectColumn(userManuscriptRefPeer::IS_CORRESPONDING_AUTHOR);

		$criteria->addSelectColumn(userManuscriptRefPeer::AUTHOR_ORDER);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(userManuscriptRefPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			userManuscriptRefPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseuserManuscriptRefPeer', $criteria, $con);
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
		$objects = userManuscriptRefPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return userManuscriptRefPeer::populateObjects(userManuscriptRefPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseuserManuscriptRefPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			userManuscriptRefPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(userManuscriptRef $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getUserId(), (string) $obj->getManuscriptId()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof userManuscriptRef) {
				$key = serialize(array((string) $value->getUserId(), (string) $value->getManuscriptId()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or userManuscriptRef object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = userManuscriptRefPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = userManuscriptRefPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = userManuscriptRefPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				userManuscriptRefPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinsfGuardUserProfile(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(userManuscriptRefPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			userManuscriptRefPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(userManuscriptRefPeer::USER_ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseuserManuscriptRefPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinmanuscript(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(userManuscriptRefPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			userManuscriptRefPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(userManuscriptRefPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseuserManuscriptRefPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinsfGuardUserProfile(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseuserManuscriptRefPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		userManuscriptRefPeer::addSelectColumns($c);
		$startcol = (userManuscriptRefPeer::NUM_COLUMNS - userManuscriptRefPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserProfilePeer::addSelectColumns($c);

		$c->addJoin(array(userManuscriptRefPeer::USER_ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = userManuscriptRefPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = userManuscriptRefPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = userManuscriptRefPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				userManuscriptRefPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->adduserManuscriptRef($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinmanuscript(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		userManuscriptRefPeer::addSelectColumns($c);
		$startcol = (userManuscriptRefPeer::NUM_COLUMNS - userManuscriptRefPeer::NUM_LAZY_LOAD_COLUMNS);
		manuscriptPeer::addSelectColumns($c);

		$c->addJoin(array(userManuscriptRefPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = userManuscriptRefPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = userManuscriptRefPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = userManuscriptRefPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				userManuscriptRefPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = manuscriptPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = manuscriptPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = manuscriptPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					manuscriptPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->adduserManuscriptRef($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(userManuscriptRefPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			userManuscriptRefPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(userManuscriptRefPeer::USER_ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);
		$criteria->addJoin(array(userManuscriptRefPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseuserManuscriptRefPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseuserManuscriptRefPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		userManuscriptRefPeer::addSelectColumns($c);
		$startcol2 = (userManuscriptRefPeer::NUM_COLUMNS - userManuscriptRefPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

		manuscriptPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (manuscriptPeer::NUM_COLUMNS - manuscriptPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(userManuscriptRefPeer::USER_ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);
		$c->addJoin(array(userManuscriptRefPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = userManuscriptRefPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = userManuscriptRefPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = userManuscriptRefPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				userManuscriptRefPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = sfGuardUserProfilePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = sfGuardUserProfilePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserProfilePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->adduserManuscriptRef($obj1);
			} 
			
			$key3 = manuscriptPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = manuscriptPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = manuscriptPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					manuscriptPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->adduserManuscriptRef($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptsfGuardUserProfile(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			userManuscriptRefPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(userManuscriptRefPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseuserManuscriptRefPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptmanuscript(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			userManuscriptRefPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(userManuscriptRefPeer::USER_ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseuserManuscriptRefPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptsfGuardUserProfile(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseuserManuscriptRefPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		userManuscriptRefPeer::addSelectColumns($c);
		$startcol2 = (userManuscriptRefPeer::NUM_COLUMNS - userManuscriptRefPeer::NUM_LAZY_LOAD_COLUMNS);

		manuscriptPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (manuscriptPeer::NUM_COLUMNS - manuscriptPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(userManuscriptRefPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = userManuscriptRefPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = userManuscriptRefPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = userManuscriptRefPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				userManuscriptRefPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = manuscriptPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = manuscriptPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = manuscriptPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					manuscriptPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->adduserManuscriptRef($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptmanuscript(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		userManuscriptRefPeer::addSelectColumns($c);
		$startcol2 = (userManuscriptRefPeer::NUM_COLUMNS - userManuscriptRefPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfGuardUserProfilePeer::NUM_COLUMNS - sfGuardUserProfilePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(userManuscriptRefPeer::USER_ID,), array(sfGuardUserProfilePeer::USER_ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = userManuscriptRefPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = userManuscriptRefPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = userManuscriptRefPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				userManuscriptRefPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = sfGuardUserProfilePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = sfGuardUserProfilePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = sfGuardUserProfilePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfGuardUserProfilePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->adduserManuscriptRef($obj1);

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
		return userManuscriptRefPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseuserManuscriptRefPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseuserManuscriptRefPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseuserManuscriptRefPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(userManuscriptRefPeer::USER_ID);
			$selectCriteria->add(userManuscriptRefPeer::USER_ID, $criteria->remove(userManuscriptRefPeer::USER_ID), $comparison);

			$comparison = $criteria->getComparison(userManuscriptRefPeer::MANUSCRIPT_ID);
			$selectCriteria->add(userManuscriptRefPeer::MANUSCRIPT_ID, $criteria->remove(userManuscriptRefPeer::MANUSCRIPT_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseuserManuscriptRefPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseuserManuscriptRefPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(userManuscriptRefPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												userManuscriptRefPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof userManuscriptRef) {
						userManuscriptRefPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(userManuscriptRefPeer::USER_ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(userManuscriptRefPeer::MANUSCRIPT_ID, $value[1]));
				$criteria->addOr($criterion);

								userManuscriptRefPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(userManuscriptRef $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(userManuscriptRefPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(userManuscriptRefPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(userManuscriptRefPeer::DATABASE_NAME, userManuscriptRefPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = userManuscriptRefPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($user_id, $manuscript_id, PropelPDO $con = null) {
		$key = serialize(array((string) $user_id, (string) $manuscript_id));
 		if (null !== ($obj = userManuscriptRefPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(userManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(userManuscriptRefPeer::DATABASE_NAME);
		$criteria->add(userManuscriptRefPeer::USER_ID, $user_id);
		$criteria->add(userManuscriptRefPeer::MANUSCRIPT_ID, $manuscript_id);
		$v = userManuscriptRefPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseuserManuscriptRefPeer::DATABASE_NAME)->addTableBuilder(BaseuserManuscriptRefPeer::TABLE_NAME, BaseuserManuscriptRefPeer::getMapBuilder());

