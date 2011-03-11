<?php



class DependenciaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DependenciaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('dependencia');
		$tMap->setPhpName('Dependencia');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('DEP_CODIGO', 'DepCodigo', 'string', CreoleTypes::VARCHAR, true, 40);

		$tMap->addForeignKey('DEP_FACULTAD', 'DepFacultad', 'int', CreoleTypes::INTEGER, 'facultad', 'FAC_ID', false, null);

		$tMap->addColumn('DEP_NOMBRE', 'DepNombre', 'string', CreoleTypes::VARCHAR, false, 100);

	} 
} 