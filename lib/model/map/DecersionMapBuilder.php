<?php



class DecersionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DecersionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('decersion');
		$tMap->setPhpName('Decersion');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('decersion_SEQ');

		$tMap->addPrimaryKey('DEC_ID', 'DecId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('DEC_SEDE', 'DecSede', 'int', CreoleTypes::INTEGER, 'sede', 'SED_CODIGO', false, null);

		$tMap->addForeignKey('DEC_FACULTAD', 'DecFacultad', 'int', CreoleTypes::INTEGER, 'facultad', 'FAC_ID', false, null);

		$tMap->addColumn('DEC_TIPO_PROGRAMA', 'DecTipoPrograma', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('DEC_PERIODO', 'DecPeriodo', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DEC_VALOR', 'DecValor', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 