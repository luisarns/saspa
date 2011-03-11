<?php



class FuentesExternasMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FuentesExternasMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('fuentes_externas');
		$tMap->setPhpName('FuentesExternas');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('fuentes_externas_SEQ');

		$tMap->addPrimaryKey('FUE_ID', 'FueId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('FUE_SOL_ID', 'FueSolId', 'int', CreoleTypes::INTEGER, 'solicitud', 'SOL_ID', false, null);

		$tMap->addColumn('FUE_NOMBRE', 'FueNombre', 'string', CreoleTypes::VARCHAR, false, 100);

	} 
} 