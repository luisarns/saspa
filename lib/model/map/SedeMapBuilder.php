<?php



class SedeMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SedeMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sede');
		$tMap->setPhpName('Sede');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('sede_SEQ');

		$tMap->addPrimaryKey('SED_CODIGO', 'SedCodigo', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SED_TIPO', 'SedTipo', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('SED_NOMBRE', 'SedNombre', 'string', CreoleTypes::VARCHAR, false, 80);

	} 
} 