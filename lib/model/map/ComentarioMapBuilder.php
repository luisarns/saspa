<?php



class ComentarioMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ComentarioMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('comentario');
		$tMap->setPhpName('Comentario');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('comentario_SEQ');

		$tMap->addPrimaryKey('COM_ID', 'ComId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('COM_SOLICITUD', 'ComSolicitud', 'int', CreoleTypes::INTEGER, 'solicitud', 'SOL_ID', false, null);

		$tMap->addColumn('COM_DESCRIPCION', 'ComDescripcion', 'string', CreoleTypes::VARCHAR, false, 500);

		$tMap->addForeignKey('COM_USUARIO', 'ComUsuario', 'string', CreoleTypes::VARCHAR, 'usuario', 'USU_IDENTIFICADOR', false, 30);

		$tMap->addColumn('COM_SOL_ESTADO', 'ComSolEstado', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 