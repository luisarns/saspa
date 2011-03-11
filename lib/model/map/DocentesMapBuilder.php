<?php



class DocentesMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DocentesMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('docentes');
		$tMap->setPhpName('Docentes');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CEDULA', 'Cedula', 'string', CreoleTypes::VARCHAR, true, 40);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('APELLIDOS', 'Apellidos', 'string', CreoleTypes::VARCHAR, false, 80);

		$tMap->addColumn('FACULTAD', 'Facultad', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('DEPENDENCIA', 'Dependencia', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('CATEGORIA', 'Categoria', 'string', CreoleTypes::VARCHAR, false, 40);

	} 
} 