<?php


abstract class BaseExtructuraCurricularPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'extructura_curricular';

	
	const CLASS_DEFAULT = 'lib.model.ExtructuraCurricular';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ECU_ID = 'extructura_curricular.ECU_ID';

	
	const ECU_SOL_ID = 'extructura_curricular.ECU_SOL_ID';

	
	const ECU_PERIODO_ACADEMICO = 'extructura_curricular.ECU_PERIODO_ACADEMICO';

	
	const ECU_ASIGNATURA = 'extructura_curricular.ECU_ASIGNATURA';

	
	const ECU_NUM_CREDITOS = 'extructura_curricular.ECU_NUM_CREDITOS';

	
	const ECU_TOTAL_HORAS = 'extructura_curricular.ECU_TOTAL_HORAS';

	
	const ECU_NUM_PROGRAMA_COMPARTE = 'extructura_curricular.ECU_NUM_PROGRAMA_COMPARTE';

	
	const ECU_CATEGORIA_DOCENTE = 'extructura_curricular.ECU_CATEGORIA_DOCENTE';

	
	const ECU_HORAS_DICTADAS_COMO = 'extructura_curricular.ECU_HORAS_DICTADAS_COMO';

	
	const ECU_VALOR_HORA = 'extructura_curricular.ECU_VALOR_HORA';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('EcuId', 'EcuSolId', 'EcuPeriodoAcademico', 'EcuAsignatura', 'EcuNumCreditos', 'EcuTotalHoras', 'EcuNumProgramaComparte', 'EcuCategoriaDocente', 'EcuHorasDictadasComo', 'EcuValorHora', ),
		BasePeer::TYPE_COLNAME => array (ExtructuraCurricularPeer::ECU_ID, ExtructuraCurricularPeer::ECU_SOL_ID, ExtructuraCurricularPeer::ECU_PERIODO_ACADEMICO, ExtructuraCurricularPeer::ECU_ASIGNATURA, ExtructuraCurricularPeer::ECU_NUM_CREDITOS, ExtructuraCurricularPeer::ECU_TOTAL_HORAS, ExtructuraCurricularPeer::ECU_NUM_PROGRAMA_COMPARTE, ExtructuraCurricularPeer::ECU_CATEGORIA_DOCENTE, ExtructuraCurricularPeer::ECU_HORAS_DICTADAS_COMO, ExtructuraCurricularPeer::ECU_VALOR_HORA, ),
		BasePeer::TYPE_FIELDNAME => array ('ecu_id', 'ecu_sol_id', 'ecu_periodo_academico', 'ecu_asignatura', 'ecu_num_creditos', 'ecu_total_horas', 'ecu_num_programa_comparte', 'ecu_categoria_docente', 'ecu_horas_dictadas_como', 'ecu_valor_hora', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('EcuId' => 0, 'EcuSolId' => 1, 'EcuPeriodoAcademico' => 2, 'EcuAsignatura' => 3, 'EcuNumCreditos' => 4, 'EcuTotalHoras' => 5, 'EcuNumProgramaComparte' => 6, 'EcuCategoriaDocente' => 7, 'EcuHorasDictadasComo' => 8, 'EcuValorHora' => 9, ),
		BasePeer::TYPE_COLNAME => array (ExtructuraCurricularPeer::ECU_ID => 0, ExtructuraCurricularPeer::ECU_SOL_ID => 1, ExtructuraCurricularPeer::ECU_PERIODO_ACADEMICO => 2, ExtructuraCurricularPeer::ECU_ASIGNATURA => 3, ExtructuraCurricularPeer::ECU_NUM_CREDITOS => 4, ExtructuraCurricularPeer::ECU_TOTAL_HORAS => 5, ExtructuraCurricularPeer::ECU_NUM_PROGRAMA_COMPARTE => 6, ExtructuraCurricularPeer::ECU_CATEGORIA_DOCENTE => 7, ExtructuraCurricularPeer::ECU_HORAS_DICTADAS_COMO => 8, ExtructuraCurricularPeer::ECU_VALOR_HORA => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('ecu_id' => 0, 'ecu_sol_id' => 1, 'ecu_periodo_academico' => 2, 'ecu_asignatura' => 3, 'ecu_num_creditos' => 4, 'ecu_total_horas' => 5, 'ecu_num_programa_comparte' => 6, 'ecu_categoria_docente' => 7, 'ecu_horas_dictadas_como' => 8, 'ecu_valor_hora' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ExtructuraCurricularMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ExtructuraCurricularMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ExtructuraCurricularPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(ExtructuraCurricularPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ExtructuraCurricularPeer::ECU_ID);

		$criteria->addSelectColumn(ExtructuraCurricularPeer::ECU_SOL_ID);

		$criteria->addSelectColumn(ExtructuraCurricularPeer::ECU_PERIODO_ACADEMICO);

		$criteria->addSelectColumn(ExtructuraCurricularPeer::ECU_ASIGNATURA);

		$criteria->addSelectColumn(ExtructuraCurricularPeer::ECU_NUM_CREDITOS);

		$criteria->addSelectColumn(ExtructuraCurricularPeer::ECU_TOTAL_HORAS);

		$criteria->addSelectColumn(ExtructuraCurricularPeer::ECU_NUM_PROGRAMA_COMPARTE);

		$criteria->addSelectColumn(ExtructuraCurricularPeer::ECU_CATEGORIA_DOCENTE);

		$criteria->addSelectColumn(ExtructuraCurricularPeer::ECU_HORAS_DICTADAS_COMO);

		$criteria->addSelectColumn(ExtructuraCurricularPeer::ECU_VALOR_HORA);

	}

	const COUNT = 'COUNT(extructura_curricular.ECU_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT extructura_curricular.ECU_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ExtructuraCurricularPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExtructuraCurricularPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ExtructuraCurricularPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ExtructuraCurricularPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ExtructuraCurricularPeer::populateObjects(ExtructuraCurricularPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ExtructuraCurricularPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ExtructuraCurricularPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinSolicitud(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ExtructuraCurricularPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExtructuraCurricularPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExtructuraCurricularPeer::ECU_SOL_ID, SolicitudPeer::SOL_ID);

		$rs = ExtructuraCurricularPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinSolicitud(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ExtructuraCurricularPeer::addSelectColumns($c);
		$startcol = (ExtructuraCurricularPeer::NUM_COLUMNS - ExtructuraCurricularPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SolicitudPeer::addSelectColumns($c);

		$c->addJoin(ExtructuraCurricularPeer::ECU_SOL_ID, SolicitudPeer::SOL_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExtructuraCurricularPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SolicitudPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSolicitud(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addExtructuraCurricular($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initExtructuraCurriculars();
				$obj2->addExtructuraCurricular($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ExtructuraCurricularPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExtructuraCurricularPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExtructuraCurricularPeer::ECU_SOL_ID, SolicitudPeer::SOL_ID);

		$rs = ExtructuraCurricularPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ExtructuraCurricularPeer::addSelectColumns($c);
		$startcol2 = (ExtructuraCurricularPeer::NUM_COLUMNS - ExtructuraCurricularPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SolicitudPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SolicitudPeer::NUM_COLUMNS;

		$c->addJoin(ExtructuraCurricularPeer::ECU_SOL_ID, SolicitudPeer::SOL_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExtructuraCurricularPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = SolicitudPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSolicitud(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addExtructuraCurricular($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initExtructuraCurriculars();
				$obj2->addExtructuraCurricular($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return ExtructuraCurricularPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ExtructuraCurricularPeer::ECU_ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ExtructuraCurricularPeer::ECU_ID);
			$selectCriteria->add(ExtructuraCurricularPeer::ECU_ID, $criteria->remove(ExtructuraCurricularPeer::ECU_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(ExtructuraCurricularPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ExtructuraCurricularPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ExtructuraCurricular) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ExtructuraCurricularPeer::ECU_ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(ExtructuraCurricular $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ExtructuraCurricularPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ExtructuraCurricularPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(ExtructuraCurricularPeer::DATABASE_NAME, ExtructuraCurricularPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ExtructuraCurricularPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ExtructuraCurricularPeer::DATABASE_NAME);

		$criteria->add(ExtructuraCurricularPeer::ECU_ID, $pk);


		$v = ExtructuraCurricularPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(ExtructuraCurricularPeer::ECU_ID, $pks, Criteria::IN);
			$objs = ExtructuraCurricularPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseExtructuraCurricularPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ExtructuraCurricularMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ExtructuraCurricularMapBuilder');
}
