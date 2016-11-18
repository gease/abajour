<?php



class PublicationMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PublicationMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PublicationPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PublicationPeer::TABLE_NAME);
		$tMap->setPhpName('Publication');
		$tMap->setClassname('Publication');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('MANUSCRIPT_ID', 'ManuscriptId', 'INTEGER' , 'manuscripts', 'ID', true, null);

		$tMap->addColumn('VOLUME', 'Volume', 'TINYINT', true, null);

		$tMap->addColumn('NUMBER', 'Number', 'TINYINT', true, null);

		$tMap->addColumn('FIRST_PAGE', 'FirstPage', 'SMALLINT', true, null);

		$tMap->addColumn('LAST_PAGE', 'LastPage', 'SMALLINT', true, null);

		$tMap->addColumn('YEAR', 'Year', 'SMALLINT', false, null);

	} 
} 