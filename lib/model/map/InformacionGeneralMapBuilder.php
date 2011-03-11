<?php



class InformacionGeneralMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.InformacionGeneralMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('informacion_general');
		$tMap->setPhpName('InformacionGeneral');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('informacion_general_SEQ');

		$tMap->addPrimaryKey('ING_ID', 'IngId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ING_SOL_ID', 'IngSolId', 'int', CreoleTypes::INTEGER, 'solicitud', 'SOL_ID', false, null);

		$tMap->addColumn('ING_FECHA', 'IngFecha', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('ING_SOLICITANTE', 'IngSolicitante', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('ING_FACULTAD', 'IngFacultad', 'string', CreoleTypes::VARCHAR, false, 80);

		$tMap->addColumn('ING_ESCUELA', 'IngEscuela', 'string', CreoleTypes::VARCHAR, false, 80);

		$tMap->addColumn('ING_NOMBRE_PROGRAMA', 'IngNombrePrograma', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('ING_TITULO_OTORGA', 'IngTituloOtorga', 'string', CreoleTypes::VARCHAR, false, 80);

		$tMap->addColumn('ING_MOTIVO_SOLICITUD', 'IngMotivoSolicitud', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('ING_CUAL_MOTIVO', 'IngCualMotivo', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ING_CIUDAD_SEDE', 'IngCiudadSede', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ING_NIVEL_ACADEMICO', 'IngNivelAcademico', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('ING_DURACION_PROGRAMA', 'IngDuracionPrograma', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ING_JORNADA', 'IngJornada', 'string', CreoleTypes::VARCHAR, false, 15);

		$tMap->addColumn('ING_TIPO_MODALIDAD', 'IngTipoModalidad', 'string', CreoleTypes::VARCHAR, false, 15);

		$tMap->addColumn('ING_TIPO_VALOR', 'IngTipoValor', 'string', CreoleTypes::VARCHAR, false, 25);

		$tMap->addColumn('ING_FORMA_PAGO', 'IngFormaPago', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('ING_VALOR', 'IngValor', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 