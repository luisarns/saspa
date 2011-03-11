<?php


abstract class BasePresupuestoIngresosPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'presupuesto_ingresos';

	
	const CLASS_DEFAULT = 'lib.model.PresupuestoIngresos';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const PIN_ID = 'presupuesto_ingresos.PIN_ID';

	
	const PIN_SOL_ID = 'presupuesto_ingresos.PIN_SOL_ID';

	
	const PIN_NUMERO_INSCRITOS = 'presupuesto_ingresos.PIN_NUMERO_INSCRITOS';

	
	const PIN_NUMERO_MATRICULADOS = 'presupuesto_ingresos.PIN_NUMERO_MATRICULADOS';

	
	const PIN_EXENCIONES = 'presupuesto_ingresos.PIN_EXENCIONES';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('PinId', 'PinSolId', 'PinNumeroInscritos', 'PinNumeroMatriculados', 'PinExenciones', ),
		BasePeer::TYPE_COLNAME => array (PresupuestoIngresosPeer::PIN_ID, PresupuestoIngresosPeer::PIN_SOL_ID, PresupuestoIngresosPeer::PIN_NUMERO_INSCRITOS, PresupuestoIngresosPeer::PIN_NUMERO_MATRICULADOS, PresupuestoIngresosPeer::PIN_EXENCIONES, ),
		BasePeer::TYPE_FIELDNAME => array ('pin_id', 'pin_sol_id', 'pin_numero_inscritos', 'pin_numero_matriculados', 'pin_exenciones', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('PinId' => 0, 'PinSolId' => 1, 'PinNumeroInscritos' => 2, 'PinNumeroMatriculados' => 3, 'PinExenciones' => 4, ),
		BasePeer::TYPE_COLNAME => array (PresupuestoIngresosPeer::PIN_ID => 0, PresupuestoIngresosPeer::PIN_SOL_ID => 1, PresupuestoIngresosPeer::PIN_NUMERO_INSCRITOS => 2, PresupuestoIngresosPeer::PIN_NUMERO_MATRICULADOS => 3, PresupuestoIngresosPeer::PIN_EXENCIONES => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('pin_id' => 0, 'pin_sol_id' => 1, 'pin_numero_inscritos' => 2, 'pin_numero_matriculados' => 3, 'pin_exenciones' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PresupuestoIngresosMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PresupuestoIngresosMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PresupuestoIngresosPeer::getTableMap();
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
		return str_replace(PresupuestoIngresosPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PresupuestoIngresosPeer::PIN_ID);

		$criteria->addSelectColumn(PresupuestoIngresosPeer::PIN_SOL_ID);

		$criteria->addSelectColumn(PresupuestoIngresosPeer::PIN_NUMERO_INSCRITOS);

		$criteria->addSelectColumn(PresupuestoIngresosPeer::PIN_NUMERO_MATRICULADOS);

		$criteria->addSelectColumn(PresupuestoIngresosPeer::PIN_EXENCIONES);

	}

	const COUNT = 'COUNT(presupuesto_ingresos.PIN_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT presupuesto_ingresos.PIN_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PresupuestoIngresosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PresupuestoIngresosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PresupuestoIngresosPeer::doSelectRS($criteria, $con);
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
		$objects = PresupuestoIngresosPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PresupuestoIngresosPeer::populateObjects(PresupuestoIngresosPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PresupuestoIngresosPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PresupuestoIngresosPeer::getOMClass();
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
			$criteria->addSelectColumn(PresupuestoIngresosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PresupuestoIngresosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PresupuestoIngresosPeer::PIN_SOL_ID, SolicitudPeer::SOL_ID);

		$rs = PresupuestoIngresosPeer::doSelectRS($criteria, $con);
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

		PresupuestoIngresosPeer::addSelectColumns($c);
		$startcol = (PresupuestoIngresosPeer::NUM_COLUMNS - PresupuestoIngresosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SolicitudPeer::addSelectColumns($c);

		$c->addJoin(PresupuestoIngresosPeer::PIN_SOL_ID, SolicitudPeer::SOL_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PresupuestoIngresosPeer::getOMClass();

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
										$temp_obj2->addPresupuestoIngresos($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPresupuestoIngresoss();
				$obj2->addPresupuestoIngresos($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PresupuestoIngresosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PresupuestoIngresosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PresupuestoIngresosPeer::PIN_SOL_ID, SolicitudPeer::SOL_ID);

		$rs = PresupuestoIngresosPeer::doSelectRS($criteria, $con);
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

		PresupuestoIngresosPeer::addSelectColumns($c);
		$startcol2 = (PresupuestoIngresosPeer::NUM_COLUMNS - PresupuestoIngresosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SolicitudPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SolicitudPeer::NUM_COLUMNS;

		$c->addJoin(PresupuestoIngresosPeer::PIN_SOL_ID, SolicitudPeer::SOL_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PresupuestoIngresosPeer::getOMClass();


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
					$temp_obj2->addPresupuestoIngresos($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPresupuestoIngresoss();
				$obj2->addPresupuestoIngresos($obj1);
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
		return PresupuestoIngresosPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PresupuestoIngresosPeer::PIN_ID); 

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
			$comparison = $criteria->getComparison(PresupuestoIngresosPeer::PIN_ID);
			$selectCriteria->add(PresupuestoIngresosPeer::PIN_ID, $criteria->remove(PresupuestoIngresosPeer::PIN_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PresupuestoIngresosPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PresupuestoIngresosPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PresupuestoIngresos) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PresupuestoIngresosPeer::PIN_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PresupuestoIngresos $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PresupuestoIngresosPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PresupuestoIngresosPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PresupuestoIngresosPeer::DATABASE_NAME, PresupuestoIngresosPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PresupuestoIngresosPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PresupuestoIngresosPeer::DATABASE_NAME);

		$criteria->add(PresupuestoIngresosPeer::PIN_ID, $pk);


		$v = PresupuestoIngresosPeer::doSelect($criteria, $con);

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
			$criteria->add(PresupuestoIngresosPeer::PIN_ID, $pks, Criteria::IN);
			$objs = PresupuestoIngresosPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePresupuestoIngresosPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PresupuestoIngresosMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PresupuestoIngresosMapBuilder');
}
