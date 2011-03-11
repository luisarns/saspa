<?php



class ValorHoraDocenteMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ValorHoraDocenteMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('valor_hora_docente');
		$tMap->setPhpName('ValorHoraDocente');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('VHD_NIVEL_PROGRAMA', 'VhdNivelPrograma', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addPrimaryKey('VHD_CATEGORIA_DOCENTE', 'VhdCategoriaDocente', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('NOMBRADO_BONIFICADO', 'NombradoBonificado', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('NOMBRADO_CARGA_ACADEMICA', 'NombradoCargaAcademica', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('HORA_CATEDRA', 'HoraCatedra', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 