<?php



class ParametrosMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ParametrosMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('parametros');
		$tMap->setPhpName('Parametros');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('PAR_NOMBRE', 'ParNombre', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addPrimaryKey('PAR_ANO', 'ParAno', 'string', CreoleTypes::VARCHAR, true, 4);

		$tMap->addColumn('PAR_VALOR', 'ParValor', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 