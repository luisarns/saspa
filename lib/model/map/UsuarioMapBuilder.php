<?php



class UsuarioMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UsuarioMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('usuario');
		$tMap->setPhpName('Usuario');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('USU_IDENTIFICADOR', 'UsuIdentificador', 'string', CreoleTypes::VARCHAR, true, 30);

		$tMap->addColumn('USU_CONTRASENA', 'UsuContrasena', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('USU_NOMBRE', 'UsuNombre', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('USU_APELLIDOS', 'UsuApellidos', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('USU_ESTADO', 'UsuEstado', 'string', CreoleTypes::VARCHAR, false, 2);

		$tMap->addForeignKey('USU_ROL', 'UsuRol', 'string', CreoleTypes::VARCHAR, 'rol', 'ROL_IDENTIFICADOR', false, 10);

	} 
} 