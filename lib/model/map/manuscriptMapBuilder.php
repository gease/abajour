<?php



class manuscriptMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.manuscriptMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(manuscriptPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(manuscriptPeer::TABLE_NAME);
		$tMap->setPhpName('manuscript');
		$tMap->setClassname('manuscript');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', true, 1000);

		$tMap->addColumn('STATUS', 'Status', 'TINYINT', true, null);

		$tMap->addColumn('PAGES', 'Pages', 'TINYINT', false, null);

		$tMap->addForeignKey('CITY_ID', 'CityId', 'SMALLINT', 'cities', 'ID', false, null);

		$tMap->addColumn('COMMENT', 'Comment', 'LONGVARCHAR', false, null);

		$tMap->addColumn('ANNOTATION', 'Annotation', 'LONGVARCHAR', true, null);

		$tMap->addColumn('LETTER', 'Letter', 'LONGVARCHAR', false, null);

		$tMap->addColumn('KEYWORDS_FREETEXT', 'KeywordsFreetext', 'VARCHAR', true, 500);

		$tMap->addColumn('REVIEWERS_REQUEST', 'ReviewersRequest', 'VARCHAR', false, 1000);

	} 
} 