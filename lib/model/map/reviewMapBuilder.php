<?php



class reviewMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.reviewMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(reviewPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(reviewPeer::TABLE_NAME);
		$tMap->setPhpName('review');
		$tMap->setClassname('review');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'sf_guard_user_profile', 'USER_ID', true, null);

		$tMap->addForeignPrimaryKey('MANUSCRIPT_ID', 'ManuscriptId', 'INTEGER' , 'manuscripts', 'ID', true, null);

		$tMap->addColumn('CONTENTS', 'Contents', 'LONGVARCHAR', false, null);

		$tMap->addColumn('OUTCOME', 'Outcome', 'TINYINT', true, null);

		$tMap->addColumn('SUBMITTED', 'Submitted', 'TIMESTAMP', true, null);

		$tMap->addColumn('DECISION', 'Decision', 'TINYINT', false, 1);

	} 
} 