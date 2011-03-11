<?php



class ExtructuraCurricularMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ExtructuraCurricularMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('extructura_curricular');
		$tMap->setPhpName('ExtructuraCurricular');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('extructura_curricular_SEQ');

		$tMap->addPrimaryKey('ECU_ID', 'EcuId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ECU_SOL_ID', 'EcuSolId', 'int', CreoleTypes::INTEGER, 'solicitud', 'SOL_ID', false, null);

		$tMap->addColumn('ECU_PERIODO_ACADEMICO', 'EcuPeriodoAcademico', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ECU_ASIGNATURA', 'EcuAsignatura', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('ECU_NUM_CREDITOS', 'EcuNumCreditos', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ECU_TOTAL_HORAS', 'EcuTotalHoras', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ECU_NUM_PROGRAMA_COMPARTE', 'EcuNumProgramaComparte', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ECU_CATEGORIA_DOCENTE', 'EcuCategoriaDocente', 'string', CreoleTypes::VARCHAR, false, 15);

		$tMap->addColumn('ECU_HORAS_DICTADAS_COMO', 'EcuHorasDictadasComo', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('ECU_VALOR_HORA', 'EcuValorHora', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 