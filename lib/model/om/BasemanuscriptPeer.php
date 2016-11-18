<?php


abstract class BasemanuscriptPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'manuscripts';

	
	const CLASS_DEFAULT = 'lib.model.manuscript';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'manuscripts.ID';

	
	const TITLE = 'manuscripts.TITLE';

	
	const STATUS = 'manuscripts.STATUS';

	
	const PAGES = 'manuscripts.PAGES';

	
	const CITY_ID = 'manuscripts.CITY_ID';

	
	const COMMENT = 'manuscripts.COMMENT';

	
	const ANNOTATION = 'manuscripts.ANNOTATION';

	
	const LETTER = 'manuscripts.LETTER';

	
	const KEYWORDS_FREETEXT = 'manuscripts.KEYWORDS_FREETEXT';

	
	const REVIEWERS_REQUEST = 'manuscripts.REVIEWERS_REQUEST';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'Status', 'Pages', 'CityId', 'Comment', 'Annotation', 'Letter', 'KeywordsFreetext', 'ReviewersRequest', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'title', 'status', 'pages', 'cityId', 'comment', 'annotation', 'letter', 'keywordsFreetext', 'reviewersRequest', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::TITLE, self::STATUS, self::PAGES, self::CITY_ID, self::COMMENT, self::ANNOTATION, self::LETTER, self::KEYWORDS_FREETEXT, self::REVIEWERS_REQUEST, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'status', 'pages', 'city_id', 'comment', 'annotation', 'letter', 'keywords_freetext', 'reviewers_request', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'Status' => 2, 'Pages' => 3, 'CityId' => 4, 'Comment' => 5, 'Annotation' => 6, 'Letter' => 7, 'KeywordsFreetext' => 8, 'ReviewersRequest' => 9, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'title' => 1, 'status' => 2, 'pages' => 3, 'cityId' => 4, 'comment' => 5, 'annotation' => 6, 'letter' => 7, 'keywordsFreetext' => 8, 'reviewersRequest' => 9, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::TITLE => 1, self::STATUS => 2, self::PAGES => 3, self::CITY_ID => 4, self::COMMENT => 5, self::ANNOTATION => 6, self::LETTER => 7, self::KEYWORDS_FREETEXT => 8, self::REVIEWERS_REQUEST => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'status' => 2, 'pages' => 3, 'city_id' => 4, 'comment' => 5, 'annotation' => 6, 'letter' => 7, 'keywords_freetext' => 8, 'reviewers_request' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new manuscriptMapBuilder();
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
		return str_replace(manuscriptPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(manuscriptPeer::ID);

		$criteria->addSelectColumn(manuscriptPeer::TITLE);

		$criteria->addSelectColumn(manuscriptPeer::STATUS);

		$criteria->addSelectColumn(manuscriptPeer::PAGES);

		$criteria->addSelectColumn(manuscriptPeer::CITY_ID);

		$criteria->addSelectColumn(manuscriptPeer::COMMENT);

		$criteria->addSelectColumn(manuscriptPeer::ANNOTATION);

		$criteria->addSelectColumn(manuscriptPeer::LETTER);

		$criteria->addSelectColumn(manuscriptPeer::KEYWORDS_FREETEXT);

		$criteria->addSelectColumn(manuscriptPeer::REVIEWERS_REQUEST);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(manuscriptPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			manuscriptPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasemanuscriptPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasemanuscriptPeer', $criteria, $con);
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
		$objects = manuscriptPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return manuscriptPeer::populateObjects(manuscriptPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasemanuscriptPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasemanuscriptPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			manuscriptPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(manuscript $obj, $key = null)
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
			if (is_object($value) && $value instanceof manuscript) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or manuscript object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = manuscriptPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = manuscriptPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = manuscriptPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				manuscriptPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoincity(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(manuscriptPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			manuscriptPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(manuscriptPeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BasemanuscriptPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasemanuscriptPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BasemanuscriptPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasemanuscriptPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		manuscriptPeer::addSelectColumns($c);
		$startcol = (manuscriptPeer::NUM_COLUMNS - manuscriptPeer::NUM_LAZY_LOAD_COLUMNS);
		cityPeer::addSelectColumns($c);

		$c->addJoin(array(manuscriptPeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = manuscriptPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = manuscriptPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = manuscriptPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				manuscriptPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addmanuscript($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(manuscriptPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			manuscriptPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(manuscriptPeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BasemanuscriptPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasemanuscriptPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BasemanuscriptPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasemanuscriptPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		manuscriptPeer::addSelectColumns($c);
		$startcol2 = (manuscriptPeer::NUM_COLUMNS - manuscriptPeer::NUM_LAZY_LOAD_COLUMNS);

		cityPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (cityPeer::NUM_COLUMNS - cityPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(manuscriptPeer::CITY_ID,), array(cityPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = manuscriptPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = manuscriptPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = manuscriptPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				manuscriptPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addmanuscript($obj1);
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
		return manuscriptPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasemanuscriptPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasemanuscriptPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(manuscriptPeer::ID) && $criteria->keyContainsValue(manuscriptPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.manuscriptPeer::ID.')');
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

		
    foreach (sfMixer::getCallables('BasemanuscriptPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasemanuscriptPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasemanuscriptPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasemanuscriptPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(manuscriptPeer::ID);
			$selectCriteria->add(manuscriptPeer::ID, $criteria->remove(manuscriptPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasemanuscriptPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasemanuscriptPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += manuscriptPeer::doOnDeleteCascade(new Criteria(manuscriptPeer::DATABASE_NAME), $con);
			manuscriptPeer::doOnDeleteSetNull(new Criteria(manuscriptPeer::DATABASE_NAME), $con);
			$affectedRows += BasePeer::doDeleteAll(manuscriptPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												manuscriptPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof manuscript) {
						manuscriptPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(manuscriptPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								manuscriptPeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			$affectedRows += manuscriptPeer::doOnDeleteCascade($criteria, $con);
			manuscriptPeer::doOnDeleteSetNull($criteria, $con);
			
																if ($values instanceof Criteria) {
					manuscriptPeer::clearInstancePool();
				} else { 					manuscriptPeer::removeInstanceFromPool($values);
				}
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

						userManuscriptRefPeer::clearInstancePool();

						reviewPeer::clearInstancePool();

						actionPeer::clearInstancePool();

						KeywordManuscriptRefPeer::clearInstancePool();

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

				$objects = manuscriptPeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {


						$c = new Criteria(userManuscriptRefPeer::DATABASE_NAME);
			
			$c->add(userManuscriptRefPeer::MANUSCRIPT_ID, $obj->getId());
			$affectedRows += userManuscriptRefPeer::doDelete($c, $con);

						$c = new Criteria(actionPeer::DATABASE_NAME);
			
			$c->add(actionPeer::MANUSCRIPT_ID, $obj->getId());
			$affectedRows += actionPeer::doDelete($c, $con);

						$c = new Criteria(KeywordManuscriptRefPeer::DATABASE_NAME);
			
			$c->add(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $obj->getId());
			$affectedRows += KeywordManuscriptRefPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	protected static function doOnDeleteSetNull(Criteria $criteria, PropelPDO $con)
	{

				$objects = manuscriptPeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {

						$selectCriteria = new Criteria(manuscriptPeer::DATABASE_NAME);
			$updateValues = new Criteria(manuscriptPeer::DATABASE_NAME);
			$selectCriteria->add(reviewPeer::MANUSCRIPT_ID, $obj->getId());
			$updateValues->add(reviewPeer::MANUSCRIPT_ID, null);

					BasePeer::doUpdate($selectCriteria, $updateValues, $con); 
		}
	}

	
	public static function doValidate(manuscript $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(manuscriptPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(manuscriptPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(manuscriptPeer::DATABASE_NAME, manuscriptPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = manuscriptPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = manuscriptPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
		$criteria->add(manuscriptPeer::ID, $pk);

		$v = manuscriptPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(manuscriptPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(manuscriptPeer::DATABASE_NAME);
			$criteria->add(manuscriptPeer::ID, $pks, Criteria::IN);
			$objs = manuscriptPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BasemanuscriptPeer::DATABASE_NAME)->addTableBuilder(BasemanuscriptPeer::TABLE_NAME, BasemanuscriptPeer::getMapBuilder());

