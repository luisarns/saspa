<?php



class InversionesGastosGeneralesMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.InversionesGastosGeneralesMapBuilder';

	
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
		$tMap->setPhpName('InversionesGastosGenerales');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignKey('IGG_PEG_ID', 'IggPegId', 'int', CreoleTypes::INTEGER, 'presupuesto_egresos', 'PEG_ID', false, null);

		$tMap->addForeignKey('IGG_CONCEPTO', 'IggConcepto', 'int', CreoleTypes::INTEGER, 'concepto_gastos', 'COG_ID', false, null);

		$tMap->addColumn('IGG_PERIODO', 'IggPeriodo', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IGG_COSTO', 'IggCosto', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 