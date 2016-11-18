<?php


abstract class BaseKeywordManuscriptRefPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'keywords_manuscripts_ref';

	
	const CLASS_DEFAULT = 'lib.model.KeywordManuscriptRef';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const KEYWORD_ID = 'keywords_manuscripts_ref.KEYWORD_ID';

	
	const MANUSCRIPT_ID = 'keywords_manuscripts_ref.MANUSCRIPT_ID';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('KeywordId', 'ManuscriptId', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('keywordId', 'manuscriptId', ),
		BasePeer::TYPE_COLNAME => array (self::KEYWORD_ID, self::MANUSCRIPT_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('keyword_id', 'manuscript_id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('KeywordId' => 0, 'ManuscriptId' => 1, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('keywordId' => 0, 'manuscriptId' => 1, ),
		BasePeer::TYPE_COLNAME => array (self::KEYWORD_ID => 0, self::MANUSCRIPT_ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('keyword_id' => 0, 'manuscript_id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new KeywordManuscriptRefMapBuilder();
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
		return str_replace(KeywordManuscriptRefPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(KeywordManuscriptRefPeer::KEYWORD_ID);

		$criteria->addSelectColumn(KeywordManuscriptRefPeer::MANUSCRIPT_ID);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(KeywordManuscriptRefPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			KeywordManuscriptRefPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $criteria, $con);
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
		$objects = KeywordManuscriptRefPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return KeywordManuscriptRefPeer::populateObjects(KeywordManuscriptRefPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			KeywordManuscriptRefPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(KeywordManuscriptRef $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getKeywordId(), (string) $obj->getManuscriptId()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof KeywordManuscriptRef) {
				$key = serialize(array((string) $value->getKeywordId(), (string) $value->getManuscriptId()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or KeywordManuscriptRef object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = KeywordManuscriptRefPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = KeywordManuscriptRefPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = KeywordManuscriptRefPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				KeywordManuscriptRefPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinKeyword(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(KeywordManuscriptRefPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			KeywordManuscriptRefPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(KeywordManuscriptRefPeer::KEYWORD_ID,), array(KeywordPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(KeywordManuscriptRefPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			KeywordManuscriptRefPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(KeywordManuscriptRefPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinKeyword(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		KeywordManuscriptRefPeer::addSelectColumns($c);
		$startcol = (KeywordManuscriptRefPeer::NUM_COLUMNS - KeywordManuscriptRefPeer::NUM_LAZY_LOAD_COLUMNS);
		KeywordPeer::addSelectColumns($c);

		$c->addJoin(array(KeywordManuscriptRefPeer::KEYWORD_ID,), array(KeywordPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = KeywordManuscriptRefPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = KeywordManuscriptRefPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = KeywordManuscriptRefPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				KeywordManuscriptRefPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = KeywordPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = KeywordPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = KeywordPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					KeywordPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addKeywordManuscriptRef($obj1);

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

		KeywordManuscriptRefPeer::addSelectColumns($c);
		$startcol = (KeywordManuscriptRefPeer::NUM_COLUMNS - KeywordManuscriptRefPeer::NUM_LAZY_LOAD_COLUMNS);
		manuscriptPeer::addSelectColumns($c);

		$c->addJoin(array(KeywordManuscriptRefPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = KeywordManuscriptRefPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = KeywordManuscriptRefPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = KeywordManuscriptRefPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				KeywordManuscriptRefPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addKeywordManuscriptRef($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(KeywordManuscriptRefPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			KeywordManuscriptRefPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(KeywordManuscriptRefPeer::KEYWORD_ID,), array(KeywordPeer::ID,), $join_behavior);
		$criteria->addJoin(array(KeywordManuscriptRefPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		KeywordManuscriptRefPeer::addSelectColumns($c);
		$startcol2 = (KeywordManuscriptRefPeer::NUM_COLUMNS - KeywordManuscriptRefPeer::NUM_LAZY_LOAD_COLUMNS);

		KeywordPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (KeywordPeer::NUM_COLUMNS - KeywordPeer::NUM_LAZY_LOAD_COLUMNS);

		manuscriptPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (manuscriptPeer::NUM_COLUMNS - manuscriptPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(KeywordManuscriptRefPeer::KEYWORD_ID,), array(KeywordPeer::ID,), $join_behavior);
		$c->addJoin(array(KeywordManuscriptRefPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = KeywordManuscriptRefPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = KeywordManuscriptRefPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = KeywordManuscriptRefPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				KeywordManuscriptRefPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = KeywordPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = KeywordPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = KeywordPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					KeywordPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addKeywordManuscriptRef($obj1);
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
								$obj3->addKeywordManuscriptRef($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptKeyword(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			KeywordManuscriptRefPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(KeywordManuscriptRefPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $criteria, $con);
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
			KeywordManuscriptRefPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(KeywordManuscriptRefPeer::KEYWORD_ID,), array(KeywordPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptKeyword(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		KeywordManuscriptRefPeer::addSelectColumns($c);
		$startcol2 = (KeywordManuscriptRefPeer::NUM_COLUMNS - KeywordManuscriptRefPeer::NUM_LAZY_LOAD_COLUMNS);

		manuscriptPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (manuscriptPeer::NUM_COLUMNS - manuscriptPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(KeywordManuscriptRefPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = KeywordManuscriptRefPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = KeywordManuscriptRefPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = KeywordManuscriptRefPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				KeywordManuscriptRefPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addKeywordManuscriptRef($obj1);

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

		KeywordManuscriptRefPeer::addSelectColumns($c);
		$startcol2 = (KeywordManuscriptRefPeer::NUM_COLUMNS - KeywordManuscriptRefPeer::NUM_LAZY_LOAD_COLUMNS);

		KeywordPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (KeywordPeer::NUM_COLUMNS - KeywordPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(KeywordManuscriptRefPeer::KEYWORD_ID,), array(KeywordPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = KeywordManuscriptRefPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = KeywordManuscriptRefPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = KeywordManuscriptRefPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				KeywordManuscriptRefPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = KeywordPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = KeywordPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = KeywordPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					KeywordPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addKeywordManuscriptRef($obj1);

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
		return KeywordManuscriptRefPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(KeywordManuscriptRefPeer::KEYWORD_ID);
			$selectCriteria->add(KeywordManuscriptRefPeer::KEYWORD_ID, $criteria->remove(KeywordManuscriptRefPeer::KEYWORD_ID), $comparison);

			$comparison = $criteria->getComparison(KeywordManuscriptRefPeer::MANUSCRIPT_ID);
			$selectCriteria->add(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $criteria->remove(KeywordManuscriptRefPeer::MANUSCRIPT_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseKeywordManuscriptRefPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseKeywordManuscriptRefPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(KeywordManuscriptRefPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												KeywordManuscriptRefPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof KeywordManuscriptRef) {
						KeywordManuscriptRefPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(KeywordManuscriptRefPeer::KEYWORD_ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $value[1]));
				$criteria->addOr($criterion);

								KeywordManuscriptRefPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(KeywordManuscriptRef $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(KeywordManuscriptRefPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(KeywordManuscriptRefPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(KeywordManuscriptRefPeer::DATABASE_NAME, KeywordManuscriptRefPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = KeywordManuscriptRefPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($keyword_id, $manuscript_id, PropelPDO $con = null) {
		$key = serialize(array((string) $keyword_id, (string) $manuscript_id));
 		if (null !== ($obj = KeywordManuscriptRefPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(KeywordManuscriptRefPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(KeywordManuscriptRefPeer::DATABASE_NAME);
		$criteria->add(KeywordManuscriptRefPeer::KEYWORD_ID, $keyword_id);
		$criteria->add(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $manuscript_id);
		$v = KeywordManuscriptRefPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseKeywordManuscriptRefPeer::DATABASE_NAME)->addTableBuilder(BaseKeywordManuscriptRefPeer::TABLE_NAME, BaseKeywordManuscriptRefPeer::getMapBuilder());

