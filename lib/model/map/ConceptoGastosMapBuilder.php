<?php



class ConceptoGastosMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ConceptoGastosMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('concepto_gastos');
		$tMap->setPhpName('ConceptoGastos');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('concepto_gastos_SEQ');

		$tMap->addPrimaryKey('COG_ID', 'CogId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('COG_SOL_ID', 'CogSolId', 'int', CreoleTypes::INTEGER, 'solicitud', 'SOL_ID', false, null);

		$tMap->addColumn('COG_CONCEPTO', 'CogConcepto', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('COG_TIPO', 'CogTipo', 'string', CreoleTypes::VARCHAR, true, 15);

	} 
} 