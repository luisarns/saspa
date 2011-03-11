<?php



class PresupuestoEgresosMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PresupuestoEgresosMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('presupuesto_egresos');
		$tMap->setPhpName('PresupuestoEgresos');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('presupuesto_egresos_SEQ');

		$tMap->addPrimaryKey('PEG_ID', 'PegId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PEG_SOL_ID', 'PegSolId', 'int', CreoleTypes::INTEGER, 'solicitud', 'SOL_ID', false, null);

		$tMap->addColumn('PEG_HSE_CORD_PROGRAMA', 'PegHseCordPrograma', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PEG_HSE_SECRETARIA', 'PegHseSecretaria', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PEG_HSE_AUX_ADMINISTRATIVO', 'PegHseAuxAdministrativo', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PEG_HSE_MONITORIAS', 'PegHseMonitorias', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PEG_SM_DIRECCION', 'PegSmDireccion', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PEG_SM_COORDINACION', 'PegSmCoordinacion', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PEG_SM_OTRO_NOMBRE', 'PegSmOtroNombre', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PEG_SM_OTRO_VALOR', 'PegSmOtroValor', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 