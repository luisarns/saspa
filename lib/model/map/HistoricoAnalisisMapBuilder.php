<?php



class HistoricoAnalisisMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.HistoricoAnalisisMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('historico_analisis');
		$tMap->setPhpName('HistoricoAnalisis');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('historico_analisis_SEQ');

		$tMap->addColumn('HIA_ESTADO', 'HiaEstado', 'string', CreoleTypes::VARCHAR, true, 25);

		$tMap->addForeignKey('HIA_SOLICITUD', 'HiaSolicitud', 'int', CreoleTypes::INTEGER, 'solicitud', 'SOL_ID', false, null);

		$tMap->addForeignKey('HIA_USUARIO', 'HiaUsuario', 'string', CreoleTypes::VARCHAR, 'usuario', 'USU_IDENTIFICADOR', false, 30);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 