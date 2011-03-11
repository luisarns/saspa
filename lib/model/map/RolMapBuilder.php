<?php



class RolMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RolMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rol');
		$tMap->setPhpName('Rol');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('ROL_IDENTIFICADOR', 'RolIdentificador', 'string', CreoleTypes::VARCHAR, true, 10);

		$tMap->addColumn('ROL_NOMBRE', 'RolNombre', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ROL_URL_MENU', 'RolUrlMenu', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ROL_URL_INICIO', 'RolUrlInicio', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 