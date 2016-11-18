<?php


abstract class BasePublicationPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'publications';

	
	const CLASS_DEFAULT = 'lib.model.Publication';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const MANUSCRIPT_ID = 'publications.MANUSCRIPT_ID';

	
	const VOLUME = 'publications.VOLUME';

	
	const NUMBER = 'publications.NUMBER';

	
	const FIRST_PAGE = 'publications.FIRST_PAGE';

	
	const LAST_PAGE = 'publications.LAST_PAGE';

	
	const YEAR = 'publications.YEAR';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ManuscriptId', 'Volume', 'Number', 'FirstPage', 'LastPage', 'Year', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('manuscriptId', 'volume', 'number', 'firstPage', 'lastPage', 'year', ),
		BasePeer::TYPE_COLNAME => array (self::MANUSCRIPT_ID, self::VOLUME, self::NUMBER, self::FIRST_PAGE, self::LAST_PAGE, self::YEAR, ),
		BasePeer::TYPE_FIELDNAME => array ('manuscript_id', 'volume', 'number', 'first_page', 'last_page', 'year', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ManuscriptId' => 0, 'Volume' => 1, 'Number' => 2, 'FirstPage' => 3, 'LastPage' => 4, 'Year' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('manuscriptId' => 0, 'volume' => 1, 'number' => 2, 'firstPage' => 3, 'lastPage' => 4, 'year' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::MANUSCRIPT_ID => 0, self::VOLUME => 1, self::NUMBER => 2, self::FIRST_PAGE => 3, self::LAST_PAGE => 4, self::YEAR => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('manuscript_id' => 0, 'volume' => 1, 'number' => 2, 'first_page' => 3, 'last_page' => 4, 'year' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PublicationMapBuilder();
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
		return str_replace(PublicationPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PublicationPeer::MANUSCRIPT_ID);

		$criteria->addSelectColumn(PublicationPeer::VOLUME);

		$criteria->addSelectColumn(PublicationPeer::NUMBER);

		$criteria->addSelectColumn(PublicationPeer::FIRST_PAGE);

		$criteria->addSelectColumn(PublicationPeer::LAST_PAGE);

		$criteria->addSelectColumn(PublicationPeer::YEAR);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PublicationPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PublicationPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasePublicationPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePublicationPeer', $criteria, $con);
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
		$objects = PublicationPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return PublicationPeer::populateObjects(PublicationPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePublicationPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasePublicationPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PublicationPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Publication $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getManuscriptId();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Publication) {
				$key = (string) $value->getManuscriptId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Publication object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = PublicationPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PublicationPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PublicationPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PublicationPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinmanuscript(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PublicationPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PublicationPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PublicationPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BasePublicationPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePublicationPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinmanuscript(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasePublicationPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasePublicationPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PublicationPeer::addSelectColumns($c);
		$startcol = (PublicationPeer::NUM_COLUMNS - PublicationPeer::NUM_LAZY_LOAD_COLUMNS);
		manuscriptPeer::addSelectColumns($c);

		$c->addJoin(array(PublicationPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PublicationPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PublicationPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PublicationPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PublicationPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->setPublication($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PublicationPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PublicationPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PublicationPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BasePublicationPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePublicationPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BasePublicationPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasePublicationPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PublicationPeer::addSelectColumns($c);
		$startcol2 = (PublicationPeer::NUM_COLUMNS - PublicationPeer::NUM_LAZY_LOAD_COLUMNS);

		manuscriptPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (manuscriptPeer::NUM_COLUMNS - manuscriptPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(PublicationPeer::MANUSCRIPT_ID,), array(manuscriptPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PublicationPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PublicationPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PublicationPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PublicationPeer::addInstanceToPool($obj1, $key1);
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
								$obj1->setmanuscript($obj2);
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
		return PublicationPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePublicationPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePublicationPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BasePublicationPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePublicationPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePublicationPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePublicationPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(PublicationPeer::MANUSCRIPT_ID);
			$selectCriteria->add(PublicationPeer::MANUSCRIPT_ID, $criteria->remove(PublicationPeer::MANUSCRIPT_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePublicationPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePublicationPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PublicationPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												PublicationPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Publication) {
						PublicationPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PublicationPeer::MANUSCRIPT_ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								PublicationPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Publication $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PublicationPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PublicationPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PublicationPeer::DATABASE_NAME, PublicationPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PublicationPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = PublicationPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(PublicationPeer::DATABASE_NAME);
		$criteria->add(PublicationPeer::MANUSCRIPT_ID, $pk);

		$v = PublicationPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PublicationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(PublicationPeer::DATABASE_NAME);
			$criteria->add(PublicationPeer::MANUSCRIPT_ID, $pks, Criteria::IN);
			$objs = PublicationPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BasePublicationPeer::DATABASE_NAME)->addTableBuilder(BasePublicationPeer::TABLE_NAME, BasePublicationPeer::getMapBuilder());

