<?php



class DecersionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DecersionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('decersion');
		$tMap->setPhpName('Decersion');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('decersion_SEQ');

		$tMap->addPrimaryKey('DEC_ID', 'DecId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DEC_SEDE', 'DecSede', 'string', CreoleTypes::VARCHAR, false, 80);

		$tMap->addForeignKey('DEC_FACULTAD', 'DecFacultad', 'int', CreoleTypes::INTEGER, 'facultad', 'FAC_ID', false, null);

		$tMap->addColumn('DEC_TIPO_PROGAMA', 'DecTipoProgama', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('DEC_PERIODO', 'DecPeriodo', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 