<?php



class RegionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RegionMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(RegionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RegionPeer::TABLE_NAME);
		$tMap->setPhpName('Region');
		$tMap->setClassname('Region');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'SMALLINT', true, null);

	} 
} 