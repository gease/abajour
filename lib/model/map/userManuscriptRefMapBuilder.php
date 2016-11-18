<?php



class userManuscriptRefMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.userManuscriptRefMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(userManuscriptRefPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(userManuscriptRefPeer::TABLE_NAME);
		$tMap->setPhpName('userManuscriptRef');
		$tMap->setClassname('userManuscriptRef');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'sf_guard_user_profile', 'USER_ID', true, null);

		$tMap->addForeignPrimaryKey('MANUSCRIPT_ID', 'ManuscriptId', 'INTEGER' , 'manuscripts', 'ID', true, null);

		$tMap->addColumn('IS_CORRESPONDING_AUTHOR', 'IsCorrespondingAuthor', 'BOOLEAN', true, null);

		$tMap->addColumn('AUTHOR_ORDER', 'AuthorOrder', 'TINYINT', true, null);

	} 
} 