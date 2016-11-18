<?php



class actionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.actionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(actionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(actionPeer::TABLE_NAME);
		$tMap->setPhpName('action');
		$tMap->setClassname('action');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('MANUSCRIPT_ID', 'ManuscriptId', 'INTEGER', 'manuscripts', 'ID', true, null);

		$tMap->addColumn('STATUS_BEFORE', 'StatusBefore', 'TINYINT', true, null);

		$tMap->addColumn('STATUS_AFTER', 'StatusAfter', 'TINYINT', true, null);

		$tMap->addColumn('DATETIME', 'Datetime', 'TIMESTAMP', true, null);

	} 
} 