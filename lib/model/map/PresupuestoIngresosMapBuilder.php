<?php



class PresupuestoIngresosMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PresupuestoIngresosMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('presupuesto_ingresos');
		$tMap->setPhpName('PresupuestoIngresos');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('presupuesto_ingresos_SEQ');

		$tMap->addPrimaryKey('PIN_ID', 'PinId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PIN_SOL_ID', 'PinSolId', 'int', CreoleTypes::INTEGER, 'solicitud', 'SOL_ID', false, null);

		$tMap->addColumn('PIN_NUMERO_INSCRITOS', 'PinNumeroInscritos', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PIN_NUMERO_MATRICULADOS', 'PinNumeroMatriculados', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PIN_EXENCIONES', 'PinExenciones', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 