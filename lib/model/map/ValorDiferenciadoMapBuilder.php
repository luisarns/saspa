<?php



class ValorDiferenciadoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ValorDiferenciadoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('valor_diferenciado');
		$tMap->setPhpName('ValorDiferenciado');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('VAD_ING_ID', 'VadIngId', 'int' , CreoleTypes::INTEGER, 'informacion_general', 'ING_ID', true, null);

		$tMap->addPrimaryKey('VAD_PERIODO', 'VadPeriodo', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('VAD_VALOR', 'VadValor', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 