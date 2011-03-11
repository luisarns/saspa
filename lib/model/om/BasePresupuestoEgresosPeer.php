<?php


abstract class BasePresupuestoEgresosPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'presupuesto_egresos';

	
	const CLASS_DEFAULT = 'lib.model.PresupuestoEgresos';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const PEG_ID = 'presupuesto_egresos.PEG_ID';

	
	const PEG_SOL_ID = 'presupuesto_egresos.PEG_SOL_ID';

	
	const PEG_HSE_CORD_PROGRAMA = 'presupuesto_egresos.PEG_HSE_CORD_PROGRAMA';

	
	const PEG_HSE_SECRETARIA = 'presupuesto_egresos.PEG_HSE_SECRETARIA';

	
	const PEG_HSE_AUX_ADMINISTRATIVO = 'presupuesto_egresos.PEG_HSE_AUX_ADMINISTRATIVO';

	
	const PEG_HSE_MONITORIAS = 'presupuesto_egresos.PEG_HSE_MONITORIAS';

	
	const PEG_SM_DIRECCION = 'presupuesto_egresos.PEG_SM_DIRECCION';

	
	const PEG_SM_COORDINACION = 'presupuesto_egresos.PEG_SM_COORDINACION';

	
	const PEG_SM_OTRO_NOMBRE = 'presupuesto_egresos.PEG_SM_OTRO_NOMBRE';

	
	const PEG_SM_OTRO_VALOR = 'presupuesto_egresos.PEG_SM_OTRO_VALOR';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('PegId', 'PegSolId', 'PegHseCordPrograma', 'PegHseSecretaria', 'PegHseAuxAdministrativo', 'PegHseMonitorias', 'PegSmDireccion', 'PegSmCoordinacion', 'PegSmOtroNombre', 'PegSmOtroValor', ),
		BasePeer::TYPE_COLNAME => array (PresupuestoEgresosPeer::PEG_ID, PresupuestoEgresosPeer::PEG_SOL_ID, PresupuestoEgresosPeer::PEG_HSE_CORD_PROGRAMA, PresupuestoEgresosPeer::PEG_HSE_SECRETARIA, PresupuestoEgresosPeer::PEG_HSE_AUX_ADMINISTRATIVO, PresupuestoEgresosPeer::PEG_HSE_MONITORIAS, PresupuestoEgresosPeer::PEG_SM_DIRECCION, PresupuestoEgresosPeer::PEG_SM_COORDINACION, PresupuestoEgresosPeer::PEG_SM_OTRO_NOMBRE, PresupuestoEgresosPeer::PEG_SM_OTRO_VALOR, ),
		BasePeer::TYPE_FIELDNAME => array ('peg_id', 'peg_sol_id', 'peg_hse_cord_programa', 'peg_hse_secretaria', 'peg_hse_aux_administrativo', 'peg_hse_monitorias', 'peg_sm_direccion', 'peg_sm_coordinacion', 'peg_sm_otro_nombre', 'peg_sm_otro_valor', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('PegId' => 0, 'PegSolId' => 1, 'PegHseCordPrograma' => 2, 'PegHseSecretaria' => 3, 'PegHseAuxAdministrativo' => 4, 'PegHseMonitorias' => 5, 'PegSmDireccion' => 6, 'PegSmCoordinacion' => 7, 'PegSmOtroNombre' => 8, 'PegSmOtroValor' => 9, ),
		BasePeer::TYPE_COLNAME => array (PresupuestoEgresosPeer::PEG_ID => 0, PresupuestoEgresosPeer::PEG_SOL_ID => 1, PresupuestoEgresosPeer::PEG_HSE_CORD_PROGRAMA => 2, PresupuestoEgresosPeer::PEG_HSE_SECRETARIA => 3, PresupuestoEgresosPeer::PEG_HSE_AUX_ADMINISTRATIVO => 4, PresupuestoEgresosPeer::PEG_HSE_MONITORIAS => 5, PresupuestoEgresosPeer::PEG_SM_DIRECCION => 6, PresupuestoEgresosPeer::PEG_SM_COORDINACION => 7, PresupuestoEgresosPeer::PEG_SM_OTRO_NOMBRE => 8, PresupuestoEgresosPeer::PEG_SM_OTRO_VALOR => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('peg_id' => 0, 'peg_sol_id' => 1, 'peg_hse_cord_programa' => 2, 'peg_hse_secretaria' => 3, 'peg_hse_aux_administrativo' => 4, 'peg_hse_monitorias' => 5, 'peg_sm_direccion' => 6, 'peg_sm_coordinacion' => 7, 'peg_sm_otro_nombre' => 8, 'peg_sm_otro_valor' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PresupuestoEgresosMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PresupuestoEgresosMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PresupuestoEgresosPeer::getTableMap();
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
		return str_replace(PresupuestoEgresosPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PresupuestoEgresosPeer::PEG_ID);

		$criteria->addSelectColumn(PresupuestoEgresosPeer::PEG_SOL_ID);

		$criteria->addSelectColumn(PresupuestoEgresosPeer::PEG_HSE_CORD_PROGRAMA);

		$criteria->addSelectColumn(PresupuestoEgresosPeer::PEG_HSE_SECRETARIA);

		$criteria->addSelectColumn(PresupuestoEgresosPeer::PEG_HSE_AUX_ADMINISTRATIVO);

		$criteria->addSelectColumn(PresupuestoEgresosPeer::PEG_HSE_MONITORIAS);

		$criteria->addSelectColumn(PresupuestoEgresosPeer::PEG_SM_DIRECCION);

		$criteria->addSelectColumn(PresupuestoEgresosPeer::PEG_SM_COORDINACION);

		$criteria->addSelectColumn(PresupuestoEgresosPeer::PEG_SM_OTRO_NOMBRE);

		$criteria->addSelectColumn(PresupuestoEgresosPeer::PEG_SM_OTRO_VALOR);

	}

	const COUNT = 'COUNT(presupuesto_egresos.PEG_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT presupuesto_egresos.PEG_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PresupuestoEgresosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PresupuestoEgresosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PresupuestoEgresosPeer::doSelectRS($criteria, $con);
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
		$objects = PresupuestoEgresosPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PresupuestoEgresosPeer::populateObjects(PresupuestoEgresosPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PresupuestoEgresosPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PresupuestoEgresosPeer::getOMClass();
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
			$criteria->addSelectColumn(PresupuestoEgresosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PresupuestoEgresosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PresupuestoEgresosPeer::PEG_SOL_ID, SolicitudPeer::SOL_ID);

		$rs = PresupuestoEgresosPeer::doSelectRS($criteria, $con);
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

		PresupuestoEgresosPeer::addSelectColumns($c);
		$startcol = (PresupuestoEgresosPeer::NUM_COLUMNS - PresupuestoEgresosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SolicitudPeer::addSelectColumns($c);

		$c->addJoin(PresupuestoEgresosPeer::PEG_SOL_ID, SolicitudPeer::SOL_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PresupuestoEgresosPeer::getOMClass();

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
										$temp_obj2->addPresupuestoEgresos($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPresupuestoEgresoss();
				$obj2->addPresupuestoEgresos($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PresupuestoEgresosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PresupuestoEgresosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PresupuestoEgresosPeer::PEG_SOL_ID, SolicitudPeer::SOL_ID);

		$rs = PresupuestoEgresosPeer::doSelectRS($criteria, $con);
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

		PresupuestoEgresosPeer::addSelectColumns($c);
		$startcol2 = (PresupuestoEgresosPeer::NUM_COLUMNS - PresupuestoEgresosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SolicitudPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SolicitudPeer::NUM_COLUMNS;

		$c->addJoin(PresupuestoEgresosPeer::PEG_SOL_ID, SolicitudPeer::SOL_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PresupuestoEgresosPeer::getOMClass();


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
					$temp_obj2->addPresupuestoEgresos($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPresupuestoEgresoss();
				$obj2->addPresupuestoEgresos($obj1);
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
		return PresupuestoEgresosPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PresupuestoEgresosPeer::PEG_ID); 

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
			$comparison = $criteria->getComparison(PresupuestoEgresosPeer::PEG_ID);
			$selectCriteria->add(PresupuestoEgresosPeer::PEG_ID, $criteria->remove(PresupuestoEgresosPeer::PEG_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PresupuestoEgresosPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PresupuestoEgresosPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PresupuestoEgresos) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PresupuestoEgresosPeer::PEG_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PresupuestoEgresos $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PresupuestoEgresosPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PresupuestoEgresosPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PresupuestoEgresosPeer::DATABASE_NAME, PresupuestoEgresosPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PresupuestoEgresosPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PresupuestoEgresosPeer::DATABASE_NAME);

		$criteria->add(PresupuestoEgresosPeer::PEG_ID, $pk);


		$v = PresupuestoEgresosPeer::doSelect($criteria, $con);

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
			$criteria->add(PresupuestoEgresosPeer::PEG_ID, $pks, Criteria::IN);
			$objs = PresupuestoEgresosPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePresupuestoEgresosPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PresupuestoEgresosMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PresupuestoEgresosMapBuilder');
}
