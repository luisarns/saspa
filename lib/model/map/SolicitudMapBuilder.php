<?php



class SolicitudMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SolicitudMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('solicitud');
		$tMap->setPhpName('Solicitud');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('solicitud_SEQ');

		$tMap->addPrimaryKey('SOL_ID', 'SolId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SOL_NOMBRE', 'SolNombre', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('SOL_ESCUELA', 'SolEscuela', 'string', CreoleTypes::VARCHAR, false, 80);

		$tMap->addColumn('SOL_FACULTAD', 'SolFacultad', 'string', CreoleTypes::VARCHAR, false, 80);

		$tMap->addColumn('SOL_ARCHIVO', 'SolArchivo', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('SOL_ESTADO', 'SolEstado', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addForeignKey('SOL_USUARIO', 'SolUsuario', 'string', CreoleTypes::VARCHAR, 'usuario', 'USU_IDENTIFICADOR', false, 30);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 