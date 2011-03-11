<?php



class GastosGeneralesMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.GastosGeneralesMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('inversiones_gastos_generales');
		$tMap->setPhpName('GastosGenerales');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('IGG_COG_ID', 'IggCogId', 'int' , CreoleTypes::INTEGER, 'concepto_gastos', 'COG_ID', true, null);

		$tMap->addPrimaryKey('IGG_PERIODO', 'IggPeriodo', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('IGG_COSTO', 'IggCosto', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 