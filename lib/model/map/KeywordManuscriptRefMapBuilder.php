<?php



class KeywordManuscriptRefMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.KeywordManuscriptRefMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(KeywordManuscriptRefPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(KeywordManuscriptRefPeer::TABLE_NAME);
		$tMap->setPhpName('KeywordManuscriptRef');
		$tMap->setClassname('KeywordManuscriptRef');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('KEYWORD_ID', 'KeywordId', 'INTEGER' , 'keywords', 'ID', true, null);

		$tMap->addForeignPrimaryKey('MANUSCRIPT_ID', 'ManuscriptId', 'INTEGER' , 'manuscripts', 'ID', true, null);

	} 
} 