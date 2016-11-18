<?php



class RegionI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RegionI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RegionI18nPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RegionI18nPeer::TABLE_NAME);
		$tMap->setPhpName('RegionI18n');
		$tMap->setClassname('RegionI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'SMALLINT' , 'regions', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'VARCHAR', true, 7);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', false, 50);

	} 
} 