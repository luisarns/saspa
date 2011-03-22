<?php



class MatriculaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MatriculaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('matricula_pregrado');
		$tMap->setPhpName('Matricula');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('matricula_pregrado_SEQ');

		$tMap->addPrimaryKey('MAT_ID', 'MatId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('MAT_ANO', 'MatAno', 'string', CreoleTypes::VARCHAR, false, 8);

		$tMap->addForeignKey('MAT_SEDE', 'MatSede', 'int', CreoleTypes::INTEGER, 'sede', 'SED_CODIGO', false, null);

		$tMap->addForeignKey('MAT_FACULTAD', 'MatFacultad', 'int', CreoleTypes::INTEGER, 'facultad', 'FAC_ID', false, null);

		$tMap->addColumn('MAT_VALOR', 'MatValor', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 