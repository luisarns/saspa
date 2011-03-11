<?php



class ContribucionFuenteExternaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ContribucionFuenteExternaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('contribucion_fuente_externa');
		$tMap->setPhpName('ContribucionFuenteExterna');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CFE_PIN_ID', 'CfePinId', 'int' , CreoleTypes::INTEGER, 'presupuesto_ingresos', 'PIN_ID', true, null);

		$tMap->addForeignPrimaryKey('CFE_FUE_ID', 'CfeFueId', 'int' , CreoleTypes::INTEGER, 'fuentes_externas', 'FUE_ID', true, null);

		$tMap->addPrimaryKey('CFE_PERIODO', 'CfePeriodo', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CFE_VALOR', 'CfeValor', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 