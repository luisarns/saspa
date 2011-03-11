<?php



class BecasMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.BecasMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('becas');
		$tMap->setPhpName('Becas');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('becas_SEQ');

		$tMap->addPrimaryKey('BEC_ID', 'BecId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('BEC_SOL_ID', 'BecSolId', 'int', CreoleTypes::INTEGER, 'solicitud', 'SOL_ID', false, null);

		$tMap->addColumn('BEC_CONCEPTO', 'BecConcepto', 'string', CreoleTypes::VARCHAR, false, 80);

	} 
} 