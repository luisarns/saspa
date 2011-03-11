<?php



class FacultadMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FacultadMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('facultad');
		$tMap->setPhpName('Facultad');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('facultad_SEQ');

		$tMap->addPrimaryKey('FAC_ID', 'FacId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('FAC_NOMBRE', 'FacNombre', 'string', CreoleTypes::VARCHAR, false, 100);

	} 
} 