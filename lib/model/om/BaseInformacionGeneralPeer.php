<?php


abstract class BaseInformacionGeneralPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'informacion_general';

	
	const CLASS_DEFAULT = 'lib.model.InformacionGeneral';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ING_ID = 'informacion_general.ING_ID';

	
	const ING_SOL_ID = 'informacion_general.ING_SOL_ID';

	
	const ING_FECHA = 'informacion_general.ING_FECHA';

	
	const ING_SOLICITANTE = 'informacion_general.ING_SOLICITANTE';

	
	const ING_FACULTAD = 'informacion_general.ING_FACULTAD';

	
	const ING_ESCUELA = 'informacion_general.ING_ESCUELA';

	
	const ING_NOMBRE_PROGRAMA = 'informacion_general.ING_NOMBRE_PROGRAMA';

	
	const ING_TITULO_OTORGA = 'informacion_general.ING_TITULO_OTORGA';

	
	const ING_MOTIVO_SOLICITUD = 'informacion_general.ING_MOTIVO_SOLICITUD';

	
	const ING_CUAL_MOTIVO = 'informacion_general.ING_CUAL_MOTIVO';

	
	const ING_CIUDAD_SEDE = 'informacion_general.ING_CIUDAD_SEDE';

	
	const ING_NIVEL_ACADEMICO = 'informacion_general.ING_NIVEL_ACADEMICO';

	
	const ING_DURACION_PROGRAMA = 'informacion_general.ING_DURACION_PROGRAMA';

	
	const ING_JORNADA = 'informacion_general.ING_JORNADA';

	
	const ING_TIPO_MODALIDAD = 'informacion_general.ING_TIPO_MODALIDAD';

	
	const ING_TIPO_VALOR = 'informacion_general.ING_TIPO_VALOR';

	
	const ING_FORMA_PAGO = 'informacion_general.ING_FORMA_PAGO';

	
	const ING_VALOR = 'informacion_general.ING_VALOR';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IngId', 'IngSolId', 'IngFecha', 'IngSolicitante', 'IngFacultad', 'IngEscuela', 'IngNombrePrograma', 'IngTituloOtorga', 'IngMotivoSolicitud', 'IngCualMotivo', 'IngCiudadSede', 'IngNivelAcademico', 'IngDuracionPrograma', 'IngJornada', 'IngTipoModalidad', 'IngTipoValor', 'IngFormaPago', 'IngValor', ),
		BasePeer::TYPE_COLNAME => array (InformacionGeneralPeer::ING_ID, InformacionGeneralPeer::ING_SOL_ID, InformacionGeneralPeer::ING_FECHA, InformacionGeneralPeer::ING_SOLICITANTE, InformacionGeneralPeer::ING_FACULTAD, InformacionGeneralPeer::ING_ESCUELA, InformacionGeneralPeer::ING_NOMBRE_PROGRAMA, InformacionGeneralPeer::ING_TITULO_OTORGA, InformacionGeneralPeer::ING_MOTIVO_SOLICITUD, InformacionGeneralPeer::ING_CUAL_MOTIVO, InformacionGeneralPeer::ING_CIUDAD_SEDE, InformacionGeneralPeer::ING_NIVEL_ACADEMICO, InformacionGeneralPeer::ING_DURACION_PROGRAMA, InformacionGeneralPeer::ING_JORNADA, InformacionGeneralPeer::ING_TIPO_MODALIDAD, InformacionGeneralPeer::ING_TIPO_VALOR, InformacionGeneralPeer::ING_FORMA_PAGO, InformacionGeneralPeer::ING_VALOR, ),
		BasePeer::TYPE_FIELDNAME => array ('ing_id', 'ing_sol_id', 'ing_fecha', 'ing_solicitante', 'ing_facultad', 'ing_escuela', 'ing_nombre_programa', 'ing_titulo_otorga', 'ing_motivo_solicitud', 'ing_cual_motivo', 'ing_ciudad_sede', 'ing_nivel_academico', 'ing_duracion_programa', 'ing_jornada', 'ing_tipo_modalidad', 'ing_tipo_valor', 'ing_forma_pago', 'ing_valor', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IngId' => 0, 'IngSolId' => 1, 'IngFecha' => 2, 'IngSolicitante' => 3, 'IngFacultad' => 4, 'IngEscuela' => 5, 'IngNombrePrograma' => 6, 'IngTituloOtorga' => 7, 'IngMotivoSolicitud' => 8, 'IngCualMotivo' => 9, 'IngCiudadSede' => 10, 'IngNivelAcademico' => 11, 'IngDuracionPrograma' => 12, 'IngJornada' => 13, 'IngTipoModalidad' => 14, 'IngTipoValor' => 15, 'IngFormaPago' => 16, 'IngValor' => 17, ),
		BasePeer::TYPE_COLNAME => array (InformacionGeneralPeer::ING_ID => 0, InformacionGeneralPeer::ING_SOL_ID => 1, InformacionGeneralPeer::ING_FECHA => 2, InformacionGeneralPeer::ING_SOLICITANTE => 3, InformacionGeneralPeer::ING_FACULTAD => 4, InformacionGeneralPeer::ING_ESCUELA => 5, InformacionGeneralPeer::ING_NOMBRE_PROGRAMA => 6, InformacionGeneralPeer::ING_TITULO_OTORGA => 7, InformacionGeneralPeer::ING_MOTIVO_SOLICITUD => 8, InformacionGeneralPeer::ING_CUAL_MOTIVO => 9, InformacionGeneralPeer::ING_CIUDAD_SEDE => 10, InformacionGeneralPeer::ING_NIVEL_ACADEMICO => 11, InformacionGeneralPeer::ING_DURACION_PROGRAMA => 12, InformacionGeneralPeer::ING_JORNADA => 13, InformacionGeneralPeer::ING_TIPO_MODALIDAD => 14, InformacionGeneralPeer::ING_TIPO_VALOR => 15, InformacionGeneralPeer::ING_FORMA_PAGO => 16, InformacionGeneralPeer::ING_VALOR => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('ing_id' => 0, 'ing_sol_id' => 1, 'ing_fecha' => 2, 'ing_solicitante' => 3, 'ing_facultad' => 4, 'ing_escuela' => 5, 'ing_nombre_programa' => 6, 'ing_titulo_otorga' => 7, 'ing_motivo_solicitud' => 8, 'ing_cual_motivo' => 9, 'ing_ciudad_sede' => 10, 'ing_nivel_academico' => 11, 'ing_duracion_programa' => 12, 'ing_jornada' => 13, 'ing_tipo_modalidad' => 14, 'ing_tipo_valor' => 15, 'ing_forma_pago' => 16, 'ing_valor' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/InformacionGeneralMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.InformacionGeneralMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = InformacionGeneralPeer::getTableMap();
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
		return str_replace(InformacionGeneralPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_ID);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_SOL_ID);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_FECHA);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_SOLICITANTE);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_FACULTAD);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_ESCUELA);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_NOMBRE_PROGRAMA);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_TITULO_OTORGA);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_MOTIVO_SOLICITUD);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_CUAL_MOTIVO);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_CIUDAD_SEDE);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_NIVEL_ACADEMICO);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_DURACION_PROGRAMA);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_JORNADA);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_TIPO_MODALIDAD);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_TIPO_VALOR);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_FORMA_PAGO);

		$criteria->addSelectColumn(InformacionGeneralPeer::ING_VALOR);

	}

	const COUNT = 'COUNT(informacion_general.ING_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT informacion_general.ING_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InformacionGeneralPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InformacionGeneralPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InformacionGeneralPeer::doSelectRS($criteria, $con);
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
		$objects = InformacionGeneralPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return InformacionGeneralPeer::populateObjects(InformacionGeneralPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			InformacionGeneralPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = InformacionGeneralPeer::getOMClass();
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
			$criteria->addSelectColumn(InformacionGeneralPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InformacionGeneralPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InformacionGeneralPeer::ING_SOL_ID, SolicitudPeer::SOL_ID);

		$rs = InformacionGeneralPeer::doSelectRS($criteria, $con);
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

		InformacionGeneralPeer::addSelectColumns($c);
		$startcol = (InformacionGeneralPeer::NUM_COLUMNS - InformacionGeneralPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SolicitudPeer::addSelectColumns($c);

		$c->addJoin(InformacionGeneralPeer::ING_SOL_ID, SolicitudPeer::SOL_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InformacionGeneralPeer::getOMClass();

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
										$temp_obj2->addInformacionGeneral($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInformacionGenerals();
				$obj2->addInformacionGeneral($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InformacionGeneralPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InformacionGeneralPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InformacionGeneralPeer::ING_SOL_ID, SolicitudPeer::SOL_ID);

		$rs = InformacionGeneralPeer::doSelectRS($criteria, $con);
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

		InformacionGeneralPeer::addSelectColumns($c);
		$startcol2 = (InformacionGeneralPeer::NUM_COLUMNS - InformacionGeneralPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SolicitudPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SolicitudPeer::NUM_COLUMNS;

		$c->addJoin(InformacionGeneralPeer::ING_SOL_ID, SolicitudPeer::SOL_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InformacionGeneralPeer::getOMClass();


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
					$temp_obj2->addInformacionGeneral($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initInformacionGenerals();
				$obj2->addInformacionGeneral($obj1);
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
		return InformacionGeneralPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(InformacionGeneralPeer::ING_ID); 

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
			$comparison = $criteria->getComparison(InformacionGeneralPeer::ING_ID);
			$selectCriteria->add(InformacionGeneralPeer::ING_ID, $criteria->remove(InformacionGeneralPeer::ING_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(InformacionGeneralPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InformacionGeneralPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof InformacionGeneral) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InformacionGeneralPeer::ING_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(InformacionGeneral $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InformacionGeneralPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InformacionGeneralPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InformacionGeneralPeer::DATABASE_NAME, InformacionGeneralPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InformacionGeneralPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(InformacionGeneralPeer::DATABASE_NAME);

		$criteria->add(InformacionGeneralPeer::ING_ID, $pk);


		$v = InformacionGeneralPeer::doSelect($criteria, $con);

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
			$criteria->add(InformacionGeneralPeer::ING_ID, $pks, Criteria::IN);
			$objs = InformacionGeneralPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseInformacionGeneralPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/InformacionGeneralMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.InformacionGeneralMapBuilder');
}
