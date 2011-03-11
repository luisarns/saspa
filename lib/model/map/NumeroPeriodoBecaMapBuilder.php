<?php



class NumeroPeriodoBecaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.NumeroPeriodoBecaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('num_periodo_beca');
		$tMap->setPhpName('NumeroPeriodoBeca');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('NUP_BEC_ID', 'NupBecId', 'int' , CreoleTypes::INTEGER, 'becas', 'BEC_ID', true, null);

		$tMap->addPrimaryKey('NUP_PERIODO', 'NupPeriodo', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NUP_NUMERO', 'NupNumero', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 