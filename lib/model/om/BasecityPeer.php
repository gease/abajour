<?php


abstract class BasecityPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'cities';

	
	const CLASS_DEFAULT = 'lib.model.city';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const ID = 'cities.ID';

	
	const NAME = 'cities.NAME';

	
	const REGION_ID = 'cities.REGION_ID';

	
	const COUNTRY = 'cities.COUNTRY';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'RegionId', 'Country', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'name', 'regionId', 'country', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::NAME, self::REGION_ID, self::COUNTRY, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'region_id', 'country', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'RegionId' => 2, 'Country' => 3, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'name' => 1, 'regionId' => 2, 'country' => 3, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::NAME => 1, self::REGION_ID => 2, self::COUNTRY => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'region_id' => 2, 'country' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new cityMapBuilder();
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
		return str_replace(cityPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(cityPeer::ID);

		$criteria->addSelectColumn(cityPeer::NAME);

		$criteria->addSelectColumn(cityPeer::REGION_ID);

		$criteria->addSelectColumn(cityPeer::COUNTRY);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(cityPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			cityPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasecityPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasecityPeer', $criteria, $con);
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
		$objects = cityPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return cityPeer::populateObjects(cityPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasecityPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasecityPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			cityPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(city $obj, $key = null)
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
			if (is_object($value) && $value instanceof city) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or city object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = cityPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = cityPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = cityPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				cityPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinRegion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(cityPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			cityPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(cityPeer::REGION_ID,), array(RegionPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BasecityPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasecityPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinRegion(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasecityPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasecityPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		cityPeer::addSelectColumns($c);
		$startcol = (cityPeer::NUM_COLUMNS - cityPeer::NUM_LAZY_LOAD_COLUMNS);
		RegionPeer::addSelectColumns($c);

		$c->addJoin(array(cityPeer::REGION_ID,), array(RegionPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = cityPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = cityPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = cityPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				cityPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = RegionPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = RegionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = RegionPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					RegionPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addcity($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(cityPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			cityPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(cityPeer::REGION_ID,), array(RegionPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BasecityPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasecityPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BasecityPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasecityPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		cityPeer::addSelectColumns($c);
		$startcol2 = (cityPeer::NUM_COLUMNS - cityPeer::NUM_LAZY_LOAD_COLUMNS);

		RegionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (RegionPeer::NUM_COLUMNS - RegionPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(cityPeer::REGION_ID,), array(RegionPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = cityPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = cityPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = cityPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				cityPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = RegionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = RegionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = RegionPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					RegionPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addcity($obj1);
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
		return cityPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasecityPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasecityPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(cityPeer::ID) && $criteria->keyContainsValue(cityPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.cityPeer::ID.')');
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

		
    foreach (sfMixer::getCallables('BasecityPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasecityPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasecityPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasecityPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(cityPeer::ID);
			$selectCriteria->add(cityPeer::ID, $criteria->remove(cityPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasecityPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasecityPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			cityPeer::doOnDeleteSetNull(new Criteria(cityPeer::DATABASE_NAME), $con);
			$affectedRows += BasePeer::doDeleteAll(cityPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												cityPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof city) {
						cityPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(cityPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								cityPeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			cityPeer::doOnDeleteSetNull($criteria, $con);
			
																if ($values instanceof Criteria) {
					cityPeer::clearInstancePool();
				} else { 					cityPeer::removeInstanceFromPool($values);
				}
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

						sfGuardUserProfilePeer::clearInstancePool();

						GuardUserPeer::clearInstancePool();

						manuscriptPeer::clearInstancePool();

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected static function doOnDeleteSetNull(Criteria $criteria, PropelPDO $con)
	{

				$objects = cityPeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {

						$selectCriteria = new Criteria(cityPeer::DATABASE_NAME);
			$updateValues = new Criteria(cityPeer::DATABASE_NAME);
			$selectCriteria->add(sfGuardUserProfilePeer::CITY_ID, $obj->getId());
			$updateValues->add(sfGuardUserProfilePeer::CITY_ID, null);

					BasePeer::doUpdate($selectCriteria, $updateValues, $con); 
						$selectCriteria = new Criteria(cityPeer::DATABASE_NAME);
			$updateValues = new Criteria(cityPeer::DATABASE_NAME);
			$selectCriteria->add(GuardUserPeer::CITY_ID, $obj->getId());
			$updateValues->add(GuardUserPeer::CITY_ID, null);

					BasePeer::doUpdate($selectCriteria, $updateValues, $con); 
						$selectCriteria = new Criteria(cityPeer::DATABASE_NAME);
			$updateValues = new Criteria(cityPeer::DATABASE_NAME);
			$selectCriteria->add(manuscriptPeer::CITY_ID, $obj->getId());
			$updateValues->add(manuscriptPeer::CITY_ID, null);

					BasePeer::doUpdate($selectCriteria, $updateValues, $con); 
		}
	}

	
	public static function doValidate(city $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(cityPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(cityPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(cityPeer::DATABASE_NAME, cityPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = cityPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = cityPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(cityPeer::DATABASE_NAME);
		$criteria->add(cityPeer::ID, $pk);

		$v = cityPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(cityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(cityPeer::DATABASE_NAME);
			$criteria->add(cityPeer::ID, $pks, Criteria::IN);
			$objs = cityPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BasecityPeer::DATABASE_NAME)->addTableBuilder(BasecityPeer::TABLE_NAME, BasecityPeer::getMapBuilder());

