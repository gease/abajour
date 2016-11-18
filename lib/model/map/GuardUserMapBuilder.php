<?php



class GuardUserMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.GuardUserMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(GuardUserPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(GuardUserPeer::TABLE_NAME);
		$tMap->setPhpName('GuardUser');
		$tMap->setClassname('GuardUser');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'sf_guard_user', 'ID', true, null);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'sf_guard_user_profile', 'USER_ID', true, null);

		$tMap->addColumn('LAST_NAME', 'LastName', 'VARCHAR', true, 20);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', true, 20);

		$tMap->addColumn('MIDDLE_NAME', 'MiddleName', 'VARCHAR', false, 20);

		$tMap->addColumn('BIRTHDAY', 'Birthday', 'DATE', false, null);

		$tMap->addColumn('GENDER', 'Gender', 'CHAR', true, 1);

		$tMap->addColumn('COUNTRY', 'Country', 'CHAR', true, 2);

		$tMap->addForeignKey('CITY_ID', 'CityId', 'SMALLINT', 'cities', 'ID', false, null);

		$tMap->addColumn('INSTITUTION', 'Institution', 'VARCHAR', false, 255);

		$tMap->addColumn('ADDRESS', 'Address', 'VARCHAR', true, 255);

		$tMap->addColumn('IS_ADDRESS_PRIVATE', 'IsAddressPrivate', 'BOOLEAN', true, null);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', true, 100);

		$tMap->addColumn('QUALIFICATION', 'Qualification', 'VARCHAR', false, 30);

		$tMap->addColumn('IS_REVIEWER', 'IsReviewer', 'BOOLEAN', true, null);

		$tMap->addColumn('USERNAME', 'Username', 'VARCHAR', true, 128);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('LAST_LOGIN', 'LastLogin', 'TIMESTAMP', false, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', true, null);

		$tMap->addColumn('IS_SUPER_ADMIN', 'IsSuperAdmin', 'BOOLEAN', true, null);

	} 
} 