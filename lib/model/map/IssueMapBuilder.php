<?php



class IssueMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.IssueMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IssuePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IssuePeer::TABLE_NAME);
		$tMap->setPhpName('Issue');
		$tMap->setClassname('Issue');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('VOLUME', 'Volume', 'SMALLINT', true, null);

		$tMap->addPrimaryKey('NUM', 'Num', 'SMALLINT', true, null);

		$tMap->addColumn('STATUS', 'Status', 'TINYINT', true, null);

		$tMap->addColumn('PUBLISHED_DATE', 'PublishedDate', 'DATE', false, null);

	} 
} 