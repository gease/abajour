<?php



class KeywordMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.KeywordMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(KeywordPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(KeywordPeer::TABLE_NAME);
		$tMap->setPhpName('Keyword');
		$tMap->setClassname('Keyword');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('KEYWORD', 'Keyword', 'VARCHAR', true, 100);

	} 
} 