<?php



class cityMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.cityMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(cityPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(cityPeer::TABLE_NAME);
		$tMap->setPhpName('city');
		$tMap->setClassname('city');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'SMALLINT', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 30);

		$tMap->addForeignKey('REGION_ID', 'RegionId', 'SMALLINT', 'regions', 'ID', false, null);

		$tMap->addColumn('COUNTRY', 'Country', 'CHAR', true, 2);

	} 
} 